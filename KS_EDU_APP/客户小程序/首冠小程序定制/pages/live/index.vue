<template>
	<!-- 暂时没用 -->
	<view style="background: #fff;">
		<view class="flex-box" style="height: 44px;width:100%;background: #fff;border-bottom: 1px solid #eee;position: fixed;top: 0;z-index: 1000;">
			
			<view class="tabs" @click="slideTabs(1)">
				<text>{{className}}</text>
				<image :src="baseUrl+'/static/images/choose-cade/choose-Cadex.png'"></image>
			</view>
		</view>
		<view :class="visible?'popup-box':'hide-box'"  @click="visible=false,this.activeTab=null"  @touchmove.stop >
		
			
			<view class="flex-box class-list" >
				<scroll-view scroll-y="true" class="class-item" style="background: #F5F5F5;">
					<view class="sub-item" :class="activeIdList[0] == item.classId&&'active'"  v-for="(item,i) in yjList" :key="i" @click.stop="clickYjClass(item,i)">
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
								<uni-rate disabled="true" :value="Number(item.coursepf)" size="14" active-color="#ff663d"></uni-rate>
								<span style="color:#ff663d;margin-left:10px;">{{item.coursepf}}分</span>
							</view>
							<view>{{item.buyNum}}人学习</view>
						</view>
					</view>
					<view class="flex-box" v-if="isshowprice">
						<view  class="ks-course__price">{{item.jiFen - 0 > 0?(item.prices - 0 >0?item.jiFen+'积分+￥'+item.prices:item.jiFen+'积分'):(item.prices - 0 >0?'￥'+item.prices:'免费')}}</view>
						<text class="ks-course__marketprice" style="margin-left:5px;text-decoration: line-through;">￥{{item.money}}</text>
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
		components:{UniLoadMore,UniRate},
		data() {
			return {
				baseUrl:this.$store.state.SRC+"/config/app",
				activeTab:1,
				visible:false,
				typeList:[],
				activeType:5,
				typeText:'',
				className:'',
				yjList:[{
					classId:0,
					className:'全部'
				}],
				ejList:[],
				sjList:[],
				activeIdList:[],
				list:[],
				page:1,
				pageCount:1,
				moreStatus:'more',
				url:'/pages/live/index',
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
			
			this.isshowprice = this.$store.state.isshowprice
			
			this.activeType = query.type || 5
			if(!this.isshowprice){
				uni.setNavigationBarTitle({
					title: '专栏列表'
				});
				this.activeType = 1
			}else{
				uni.setNavigationBarTitle({
					title: '直播列表'
				});
			}
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
		
			GetCourseTypeList({
				
			}).then(res=>{
				if(!this.$store.state.isshowprice){
					let newNav = []
					res.data.map(item=>{
						if(item.type!='5'){
							newNav.push(item)
						}
					})
					this.typeList = newNav
				}else{
					this.typeList = res.data
				}
				// this.typeList = res.data
				this.getTypeText()
				GetCourseClass({
					costype:1
				}).then(res=>{
					this.yjList = this.yjList.concat(res.data)
					this.getClassName()
					this.getList()
				})
				
			})
			
		},
		onShareAppMessage(){
			var that = this
		　　// 设置菜单中的转发按钮触发转发事件时的转发内容
		　　var shareObj = {
		　　　　title: this.$store.state.siteName,
				path: '/pages/course/courselist',
		　　　　imageUrl: '', 
		　　　　success: function(res){
		　　　　　　// 转发成功之后的回调
		　　　　　　if(res.errMsg == 'shareAppMessage:ok'){
		　　　　　　}
		　　　　},
		　　　　fail: function(){
		　　　　　　// 转发失败之后的回调
		　　　　　　if(res.errMsg == 'shareAppMessage:fail cancel'){
		　　　　　　　　// 用户取消转发
		　　　　　　}else if(res.errMsg == 'shareAppMessage:fail'){
		　　　　　　　　// 转发失败，其中 detail message 为详细失败信息
		　　　　　　}
		　　　　}
		　　};
		　　// 返回shareObj
		　　return shareObj;
		},
		methods: {
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
			
				this.visible = !this.visible
			
			},
			slideType(i){
				this.activeTab = null
				this.activeType = i
				this.getTypeText()
				if(this.activeIdList.length < 2){
					uni.redirectTo({
					    url: this.url+'?type='+this.activeType+'&yjId='+this.activeIdList[0]||0
					});
				}else if(this.activeIdList.length == 2){
				
					uni.redirectTo({
					    url: this.url+'?type='+this.activeType+'&yjId='+this.activeIdList[0]+'&ejId='+this.activeIdList[1]
					});
				}else if(this.activeIdList.length == 3){
		
					uni.redirectTo({
					    url: this.url+'?type='+this.activeType+'&yjId='+this.activeIdList[0]+'&ejId='+this.activeIdList[1]+'&sjId='+this.activeIdList[2]
					});
				}
				this.visible = false
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
							this.activeIdList = [this.yjList[i].classId]
							this.visible = false
							this.activeTab = null
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
							console.log(this.activeIdList)
							this.getList()
						}	
					}	
				}else{
					this.activeIdList[2] = item.classId
					this.className = item.className
					this.visible = false
					this.activeTab = null
					console.log(this.activeIdList)
					this.getList()
				}
			}
		}
	}
</script>

<style scoped>
	.tabs{
		width: 100%;
		font-size:14px;
		color:rgba(26,26,26,1);
		text-align: center;
	}
	.tabs image{
		width: 7px;
		height: 7px;
		margin-left: 5px;
	}
	.active{
		color:#ff663d;
		background: #fff;
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
		color:#888888;
	}
	.ks-course__price{
		color:#FF3B30;
		font-size:16px;
	}
	.ks-course__title--1{
		overflow: hidden;
		white-space: nowrap;
		word-wrap:break-word;
		text-overflow: ellipsis;
		font-size:16px;
		font-family:PingFang SC;
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
		font-family:PingFang SC;
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

