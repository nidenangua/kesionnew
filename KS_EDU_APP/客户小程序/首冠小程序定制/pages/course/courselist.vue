<template>
	<view style="background: #fff;">
		<ks-dropdown-menu />
		<view class="tabs-header ks-line">
			<view class="tabs-header__item" @click="slideTabs(0)">
				<text :class="activeTab == 0 && 'active'">{{typeText}}</text>
				<image :src="baseUrl+'/static/images/choose-cade/choose-Cades.png?2.0'" v-if="activeTab==0"></image>
				<image :src="baseUrl+'/static/images/choose-cade/choose-Cadex.png?2.0'" v-else></image>
			</view>
			<view class="tabs-header__item" @click="slideTabs(1)">
				<text :class="activeTab == 1&&'active'">{{className}}</text>
				<image :src="baseUrl+'/static/images/choose-cade/choose-Cades.png?2.0'" v-if="activeTab==1"></image>
				<image :src="baseUrl+'/static/images/choose-cade/choose-Cadex.png?2.0'" v-else></image>
			</view>
		</view>
		<view :class="visible?'popup-box':'hide-box'"  @click="visible=false,activeTab=null"  @touchmove.stop >
			<view style="background: #fff;color:rgba(53,53,53,1);" v-if="activeTab == 0">
				<view class="flex-box__space type-item" :class="activeType === item.type&&'active'" v-for="(item,i) in typeList" :key="i" @click.stop="slideType(item.type)">
					<text>{{item.name}}</text>
					<image :src="baseUrl+'/static/images/choose-cade/lesson_icon_select@2x.png?2.0'" v-if="activeType == item.type"></image>
				</view>
			</view>
			
			<view class="flex-box class-list" v-else-if="activeTab == 1" >
				<scroll-view scroll-y="true" class="class-item" style="background: #F5F5F5;">
					<view class="sub-item" :class="activeIdList[0] == item.classId && 'active'"  v-for="(item,i) in yjList" :key="i" @click.stop="clickYjClass(item,i)">
						{{item.className}}
					</view>
					
				</scroll-view>
				<scroll-view scroll-y="true" class="class-item" style="background: #FAFAFA;">
					<view class="sub-item" :class="activeIdList[1] == item.classId&&'active'" v-for="(item,i) in ejList" :key="i" @click.stop="clickEjClass(item,i)">
						{{item.className}}
					</view>
				</scroll-view>
				<scroll-view scroll-y="true" class="class-item" style="background: #fff;">
					<view class="sub-item" :class="activeIdList[2] == item.classId&&'active'" v-for="(item,i) in sjList" :key="i" @click.stop="clickSjClass(item,i)">
						{{item.className}}
					</view>
				</scroll-view>
			</view>
		</view>
		<view class="ks-course__list" style="margin-top: 44px;">
			<view class="ks-course__item" v-for="(item,i) in list" :key="i" @click="open(item)">
				<ks-image radius="5px"  class="ks-image" :src="item.courseImg"></ks-image>
				<view style="display: flex;flex-direction: column;justify-content: space-between;height: 100px;">
					<view style="height: 70px;">
						<view class="ks-course__title--2">{{item.courseName}}</view>
						<view class="flex-box__space" style="font-size: 12px;margin-top: 10px;">
							<view class="flex-box" style="height:16px;">
								<uni-rate disabled="true" :value="Number(item.coursepf)" size="16" active-color="#ff663d"></uni-rate>
								<span style="color:#ff663d;margin-left:10px;">{{item.coursepf}}分</span>
							</view>
							<view>{{item.buyNum}}人学习</view>
						</view>
					</view>
					<view class="flex-box" v-if="isshowprice">
						<view  class="ks-course__price">{{item.pricetext}}</view>
						<text class="ks-course__marketprice">￥{{item.money}}</text>
					</view>
				</view>
			</view>
			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
			<ks-empty type="list" v-else>暂无数据</ks-empty>
		</view>
		
		
	</view>
</template>

<script>
	import {UniRate} from 'components/uni/uni-rate/uni-rate'
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {GetCourseTypeList,GetCourseClass,GetVodList} from 'api/course'
	export default {
		components:{
			UniLoadMore,
			UniRate
		},
		data() {
			return {
				baseUrl:this.$store.state.SRC+"/config/app",
				activeTab:Number,
				visible:false,
				typeList:[],
				activeType:1,
				typeText:'',
				className:'',
				yjList:[],
				ejList:[],
				sjList:[],
				activeIdList:[],
				list:[],
				page:1,
				pageCount:1,
				moreStatus:'more',
				url:'/pages/course/courselist',
				type:'',
				isshowprice:false
			}
		},
		onPullDownRefresh() {
			this.getList() 
		},
		/*滚动加载*/
		onReachBottom(){
			this.page++
			if(this.page<=this.pageCount){
				this.getList(this.page)
			}	
		},
		/*导航栏方法*/
		onNavigationBarButtonTap(){
			uni.redirectTo({
			    url: '/pages/course/search'
			});
		},
		onLoad(query) {
			console.log(query)
			this.$store.ready(state=>{
				this.isshowprice = state.isshowprice
				this.activeType = query.type || 1
				if(query.yjId){
					this.activeIdList[0] = query.yjId
					if(query.ejId){
						this.activeIdList[1] = query.ejId
						if(query.sjId){
							this.activeIdList[2] = query.sjId
						}
					}
				}else{
					this.activeIdList = [0]
				}
				GetCourseTypeList().then(res=>{
					if(!state.isshowprice){
						res.data.map((item,i)=>{
							if(item.type == 5){
								res.data.splice(i,1)
							}
						})
					}
					this.typeList = res.data
					this.getTypeText()
					this.updateClass().then(()=>{
						this.getList()
					})
					
				})
			})
		},
		onShareAppMessage(){
			var that = this
		　　// 设置菜单中的转发按钮触发转发事件时的转发内容
		　　var shareObj = {
		　　　　 title: this.$store.state.siteName + ' - 课程',
				path: '/pages/course/courselist',
		　　　　 imageUrl: ''
		　　};
		　　return shareObj;
		},
		methods: {
			/**
			 * 更新分类
			 */
			updateClass(){
				return new Promise(resolve=>{
					let costype = -1
					this.typeList.map(item=>{
						if(item.type == this.activeType){
							costype = item.costype
						}
					})
					GetCourseClass({
						costype
					}).then(res=>{
						let defaultyj = [{
							classId:0,
							className:'全部'
						}]
						this.yjList = defaultyj.concat(res.data)
						this.getClassName()
						resolve()
					})
				})
			},
			open(item){
				if(this.isshowprice){
					var url = item.getViewUrl
					url = encodeURIComponent(url)
					uni.navigateTo({
						url:'/pages/web/web?title='+item.courseName+'&photo='+item.courseImg+'&url='+url
					})
				}
				
			},
			slideTabs(i){
				if(this.activeTab == i){
					this.activeTab = null
					this.visible = false
				}else{
					this.activeTab = i
					this.visible = true
				}	
			},
			slideType(i){
				this.activeTab = null
				this.activeType = i
				this.visible = false
				this.updateClass().then(()=>{
					this.getList()
				})
				this.getTypeText()
				
			},
			getTypeText(){
				for(var i = 0;i<this.typeList.length;i++){
					if(this.typeList[i].type == this.activeType){
						this.typeText = this.typeList[i].name
					}	
				}
			},
			getClassName(){
				if(this.activeIdList.length == 0){
					this.className = '全部分类'
					this.activeIdList = [0]
				}else if(this.activeIdList.length == 1){
					if(this.activeIdList[0] == 0){
						this.className = '全部分类'
						this.activeIdList = [0]
					}else{
						for(var i = 0;i<this.yjList.length;i++){
							if(this.yjList[i].classId == this.activeIdList[0]){
								this.className = this.yjList[i].className	
							}	
						}
					}
				}else if(this.activeIdList.length == 2){
					for(var i = 0;i<this.yjList.length;i++){
						if(this.yjList[i].classId == this.activeIdList[0]){
							this.ejList = [{className:'全部',classId:this.yjList[i].classId}]
							if(this.yjList[i].childs){
								this.ejList = this.ejList.concat(this.yjList[i].childs)
							}
							for(var n = 0;n<this.ejList.length;n++){
								if(this.ejList[n].classId == this.activeIdList[1]){
									this.className = this.ejList[n].className
								}	
							}
						}	
					}
				}else if(this.activeIdList.length == 3){
					for(var i = 0;i<this.yjList.length;i++){
						if(this.yjList[i].classId == this.activeIdList[0]){
							this.ejList = [{className:'全部',classId:this.yjList[i].classId}]
							if(this.yjList[i].childs){
								this.ejList = this.ejList.concat(this.yjList[i].childs)
							}
							for(var n = 0;n<this.ejList.length;n++){
								if(this.ejList[n].classId == this.activeIdList[1]){
									this.sjList = [{className:'全部',classId:this.ejList[n].classId}]
									if(this.ejList[n].childs){
										this.sjList = this.sjList.concat(this.ejList[n].childs)
									}
									for(var m = 0;m<this.sjList.length;m++){
										if(this.sjList[m].classId == this.activeIdList[2]){
											this.className = this.sjList[m].className
										}	
									}
								}	
							}
						}	
					}
				}
			},
			getList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.moreStatus = 'loading'
				GetVodList({
					teachWay:this.activeType,
					page:this.page,
					pagesize:10,
					classid:this.activeIdList[this.activeIdList.length - 1],
				}).then(res=>{
					uni.stopPullDownRefresh();
					this.pageCount = res.pageCount
					if(this.page >= this.pageCount){
						this.moreStatus = 'noMore'
					}else{
						this.moreStatus = 'more'
					}
					if(res.result){
						this.list = this.list.concat(res.data)
					}
					
				})		
			},
			clickYjClass(item,m){
				if(m == 0){
					this.activeIdList = []
					this.activeIdList.push(item.classId)
					this.className = item.className
					this.visible = false
					this.activeTab = null
					this.getList()
				}else{
					this.activeIdList = []
					this.activeIdList[0] = item.classId
					for(var i = 0;i<this.yjList.length;i++){
						if(this.yjList[i].classId == this.activeIdList[0]){
							this.className = this.yjList[i].className
							this.ejList = [{className:'全部',classId:this.yjList[i].classId}]
							if(this.yjList[i].childs){
								this.ejList = this.ejList.concat(this.yjList[i].childs)	
							}
							this.sjList = []
						}	
					}
				}
			},
			clickEjClass(item,m){
				if(m == 0){
					for(var i = 0;i<this.yjList.length;i++){
						if(this.yjList[i].classId == this.activeIdList[0]){
							this.className = this.yjList[i].className
							this.visible = false
							this.activeTab = null
							this.activeIdList = [this.yjList[i].classId]
							
							
							this.getList()
						}	
					}	
				}else{
					this.activeIdList[1] = item.classId
					for(var i = 0;i<this.ejList.length;i++){
						if(this.ejList[i].classId == this.activeIdList[1]){
							this.className = this.ejList[i].className
							this.sjList = [{className:'全部',classId:this.ejList[i].classId}]
							if(this.ejList[i].childs){
								this.sjList = this.sjList.concat(this.ejList[i].childs)
							}
						}	
					}
				}
			},
			clickSjClass(item,m){
				if(m == 0){
					for(var i = 0;i<this.ejList.length;i++){
						if(this.ejList[i].classId == this.activeIdList[1]){
							this.className = this.ejList[i].className
							this.visible = false
							this.activeTab = null
							this.getList()
						}	
					}	
				}else{
					this.activeIdList[2] = item.classId
					this.className = item.className
					this.visible = false
					this.activeTab = null
					this.getList()
				}
			}
		}
	}
</script>

<style lang="scss" scoped>
	.tabs-header{
		height: 44px;
		width:100%;
		background: #fff;
		position: fixed;
		top: 0;
		z-index: 1000;
		display: flex;
		overflow: hidden;
		align-items: center;
	}
	.tabs-header__item{
		flex: 1;
		font-size:14px;
		color:rgba(26,26,26,1);
		text-align: center;
	}
	.tabs-header__item image{
		width: 6px;
		height: 5px;
		margin-left: 5px;
		position: relative;
		top:-2px;
	}
	.active{
		color:$uni-color-primary;
	}
	.popup-box{
		background-color: rgba(84, 80, 80, 0.48);
		position: fixed;
		height: calc(100%);
		width: 100%;
		z-index: 99;
		transform: translateY(0);
		transition: all .5s;
	}
	.hide-box{
		background-color: rgba(84, 80, 80, 0.48);
		position: fixed;
		height: calc(100%);
		width: 100%;
		z-index: 9;
		transition: all .5s;
		transform: translateY(-120%);
	}
	.type-item{
		border-bottom: 1px solid #eee;
		height: 44px;
		line-height: 44px;
		padding: 0 10px;
		font-size:14px;
	
	}
	.type-item image{
		width: 18px;
		height: 18px;
	}
	.class-list{
		background: #fff;
		color:rgba(53,53,53,1);
		height: 50vh;
		font-size:14px;
		color:rgba(1,14,22,1);
		text-align: center;
		overflow: auto;
	}
	.class-item{
		width: calc(100% / 3);
		height: 100%;
		overflow: auto;
	}
	.sub-item{
		height: 44px;
		line-height: 44px;
	}
	.ks-course__marketprice{
		font-size:12px;
		color:$uni-color-prompt;
		text-decoration: line-through;
		margin-left: 10px;
		
	}
	.ks-course__price{
		color:$uni-color-danger;
		font-size:16px;
	}
	.ks-course__title--1{
		overflow: hidden;
		white-space: nowrap;
		word-wrap:break-word;
		text-overflow: ellipsis;
		font-size:16px;
		font-weight:500;
		color:rgba(26,26,26,1);
		line-height: 24px;
	}
	.ks-course__title--2{
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		word-wrap:break-word;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		font-size:16px;
		font-weight:500;
		color:rgba(26,26,26,1);
		line-height: 24px;
		max-height: 48px;
	}
	.ks-course__item{
		border-radius: 8px;
		padding: 15px 10px 10px 170px;
		min-height: 100px;
		position: relative;	
	}
	
	.ks-course__item .ks-image{
		width: 150px;
		height: 100px;
		position: absolute;
		left: 10px;
		top: 15px;
		border-radius: 5px;
		overflow: hidden;
	}
</style>

