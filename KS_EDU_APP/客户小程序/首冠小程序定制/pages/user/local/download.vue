<template>
	<view>
		<view class="list">
			<view class="item">
				<view class="item-title" @click="showkeshi= showkeshi?false:true">
					<view>{{courseName}}</view>
					<image style="width: 20px;height: 20px;" :src="baseUrl+'/static/images/common/uparrow.png'" v-if="showkeshi"></image>
					<image style="width: 20px;height: 20px;" :src="baseUrl+'/static/images/common/downarrow.png'" v-else></image>
				</view>
				<view style="background: #fff;" v-if="showkeshi">
					<view class="keshi" v-for="(item,i) in list" :key="i" @click="select(item.periodid)" :class="item.isfinish&&'noclick'">
						<view class="bg" v-if="item.isfinish"></view>
						<view class="circle" style="position: relative;">
							<image style="width: 100%;height: 100%;position: absolute;top: 0;left: 0;" :src="baseUrl+'/static/images/common/active.png'" v-if="activeList.indexOf(item.periodid)!=-1||item.isfinish"></image>
						</view>
						<text class="type">视频</text>
						<view class="keshi-title">{{i+1}}.&nbsp{{item.periodname}}</view>
						<view v-if="item.isfinish" style="font-size: 12px;">{{item.state == 5 ? '缓存中':'已缓存'}}</view>
					</view>
				</view>	
			</view>
		</view>
		<view class="btn-box">
			<view style="display: flex;align-items: center;padding-left: 15px;">
				<view class="circle" style="margin-top: -2px;position: relative;" @click="allSelect()">
					<image style="width: 100%;height: 100%;position: absolute;top: 0;left: 0;" :src="baseUrl+'/static/images/common/active.png'" v-if="all"></image>
				</view>
				<view style="margin-left: 10px;" @click="allSelect()">全选</view>
				
			</view>
			<view class="btn" v-if="activeList.length> 0" style="background:#5FBF82" @click="open()">确定缓存</view>
			<view class="btn" v-else>确定缓存</view>
		</view>
	</view>
</template>

<script>
	import {getCourseCatalog} from 'api/course'
	export default {
		data(){
			return {
				courseId:'',
				list:[],
				showkeshi:true,
				courseName:'',
				activeList:[],
				state:{},
				all:false,
				//未缓存过的课时列表
				noFinishList:[],
				baseUrl:this.$store.state.SRC+"/config/app"
			}
		},
		/*导航栏方法*/
		onNavigationBarButtonTap(){
			uni.navigateTo({
				url: `/pages/user/local/index?courseid=${this.courseId}&title=${this.courseName}`
			})
		},
		methods:{
			open(){
				uni.navigateTo({
					url: `/pages/user/local/index?courseid=${this.courseId}&periodids=${this.activeList}&title=${this.courseName}`
				})
			},
			allSelect(){
				if(this.noFinishList.length>0){
					this.all = !this.all
					if(this.all){
						for(var i=0;i<this.list.length;i++){
							//state,0没下载过，5下载暂停，4下载完成
							if(this.list[i].state == 0){
								this.activeList.push(this.list[i].periodid);
							}	
						}
					}else{
						this.activeList = []
					}
				}
			},
			getList(){
				getCourseCatalog({
					courseid:this.courseId
				}).then(res=>{
					console.log(res)
					this.courseName = res.catalogData.CourseName
					this.list = res.periods.filter(item=>{
						if(item.$isCanLearn == 1 && item.type == 0 && item.teachWay == 1){
							item.isfinish = false
							item.state = 0
							return item;
						}
					})
					if(this.list.length>0){
						this.getJsonTxt()
					}else{
						uni.showToast({
							title:'没有可缓存课件',
							icon:'none'
						})
						setTimeout(()=>{
							uni.navigateBack()
						},2000)
					}	
				})
			},
			select(id){
				if(this.activeList.indexOf(id)==-1){
					this.activeList.push(id)
				}else{
					this.activeList = this.activeList.filter(item=>{
						if (item != id) {
						    return item;
						}
					})
				}
				
				this.all = this.noFinishList.length == this.activeList.length?true:false
				console.log(this.activeList,this.activeList.length)
			},
			getJsonTxt(){
				//获取之前存储的txt数据,
			
				plus.io.resolveLocalFileSystemURL(`_doc/cache/${this.state.userId}.txt`, (entry)=> {
					let reader = new plus.io.FileReader();
					reader.readAsText(entry);
					reader.onload = (e)=> {
						var jsonList = JSON.parse(e.target.result)
						var courseids = []
						courseids = jsonList.map(item=>{
							return item.courseid
						})
						var i = courseids.indexOf(this.courseId)
						var finishList = []
						if(i!=-1){
							finishList = jsonList[i].taskList 
						}
						this.list.map(item=>{
							finishList.map(site=>{
								if(item.periodid == site.periodid){
									item.isfinish = true
									item.state = site.state
								}
							})	
						})	
						console.log(JSON.stringify(this.list))
						this.noFinishList = this.list.filter(item=>{
							console.log(item.state)
							if(item.state == 0){
								return item
							}
						})
					
					}
				}, (e)=> {
					this.noFinishList = this.list
					console.log(e.message)
				})	
			},
			plusReady(){
				this.getList()		
			},
			ready(){
				//plus加载后在执行plus方法	
				if(typeof plus === 'object'){
					this.plusReady(); 
				}else{
					setTimeout(() => {
					    this.ready()
					}, 100)
				}
			}
		},
		onLoad(query){
			this.query = query
		},
		onShow(){
			this.activeList = []
			this.$store.ready(state=>{
				this.state = state
				this.courseId = this.query.courseid
				this.ready()
			})	
		}
	}
</script>

<style scoped>
	.item-title{
		height: 50px;
		line-height: 50px;
		display: flex;
		justify-content: space-between;
		background: #F7F8FC;
		align-items: center;
		padding: 0 20px 0 15px;
		font-size: 16px;
		color:#333;
	}
	.keshi{
		display: flex;
		align-items: center;
		padding: 15px 30px 15px 15px;
		position: relative;
	}
	.bg{
		position: absolute;
		height: 100%;
		width: 100%;
		background: rgba(255,255,255,0.3);
	}
	.circle{
		width: 17px;
		height: 17px;
		border-radius: 50%;
		border: 1px solid #aaaaaa;
	}
	.type{
		display: block;
		border: 1px solid #333;
		color: #333;
		border-radius: 2px;
		font-size: 10px;
		margin-left: 20px;
		width: 22px;
		height: 12px;
		text-align: center;
		line-height: 14px;
	}
	.keshi-title{
		flex: 1;
		color:#333;
		font-size: 16px;
		margin-left: 10px;
		line-height: 20px;
	}
	.btn-box{
		width: 100%;
		height: 50px;
		line-height: 50px;
		display: flex;
		justify-content: space-between;
		background: #F7F8FC;
		align-items: center;
		font-size: 16px;
		color:#333;
		position: fixed;
		bottom: 0;
		left: 0;
		z-index: 1000;
	}
	.btn{
		width: 120px;
		height: 100%;
		line-height: 50px;
		text-align: center;
		color:#fff;
		background:#C1C4CB;
	}
	.noclick{
		pointer-events: none;
		
	}
</style>
