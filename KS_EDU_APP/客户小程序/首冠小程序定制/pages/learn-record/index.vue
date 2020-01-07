<template>
	<view class="content" v-if="loaded">
		<view v-if="islogin">
			<!-- 筛选 -->
			<ks-filter :sortList="sortList" class="filter-Box" :sortLists="sortLists" @getOrderid="getOrderid" @getOrderids="getOrderids" :action="1"></ks-filter>
			<!-- 筛选 -->
			<view class="height-auto-bg"></view>
			<!-- 记录列表 -->
			<view class="courseList" v-if="courseList.length">
				<view class="withe-bg course-box">
					<view v-for="item in courseList" :key="item.courseId" class="course-item clearfix" @click="open(item)">
						<view class="courseimg">
						  <text class="course-tab" v-if="item.teachway=='0'">
								面授
						  </text>
						  <text class="course-tab" v-else-if="item.teachway=='1'">
								点播
						  </text>
						  <text class="course-tab" v-else-if="item.teachway=='2'">
								混合
						  </text>
						  <text class="course-tab" v-else-if="item.teachway=='3'">
								专栏
						  </text>
						  <text class="course-tab" v-else-if="item.teachway=='5'">
								直播
						  </text>
						  <text class="course-tab" v-else-if="item.teachway=='6'">
								活动
						  </text>
						  <text class="course-tab" v-else-if="item.teachway=='7'">
								训练营
						  </text>
						  <ks-image :src="item.courseImg" class="courseimg__img" radius="3px"></ks-image>
						</view>
						<view class="course__info">
						  <view class="title">{{item.courseName}}</view>
						  <view class="info">
							  <view  v-if="item.teachway=='1'" class="percent-box">
								  <view class="tips">{{item.hasLearnPercent==0?'开始学习':'已学习'+item.hasLearnPercent+'%'}}</view>
								  <view class="percent">
									  <view :style="'width:'+item.hasLearnPercent+'%'" class="percented"></view>
								  </view>
							  </view>
							  <view v-else-if="item.teachway=='5'" class="live-status">
								  <text v-if="item.livestatus==0">最新直播：{{item.liveBeginTime}}</text>
								  <text v-else-if="item.livestatus==1" class="green-font">正在直播中</text>
								  <text v-else>直播已结束</text>
							  </view>
						  </view>
						</view>
					</view>
				</view>
				<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
			</view>
			<!-- 记录列表 -->
			
			<ks-empty type="list" v-else>暂无数据</ks-empty>
		</view>
		<ks-empty type="login" v-else>尚未登录，无法查看</ks-empty>
	</view>
</template>
<script>
	import {MyCourseList} from '@/api/learn-record'
	import KsFilter from '@/components/ks-components/filter/filter.vue'
	import UniLoadMore from '@/components/uni/uni-load-more/uni-load-more.vue'
	export default {
		data(){
			return{
				loaded:false,
				tabIndex:0,
				sortLists:[
					{name:'全部学习进度',type:0},
					{name:'未开始学习',type:1},
					{name:'学习中',type:2},
					{name:'已完成学习',type:3}
				],
				sortList:[
					{name:'按最新加入排序',type:0},
					{name:'按最近学习排序',type:1}
				],
				courseList:[],
				getParameters:{
					from:'app',
					sort:'0',//排序条件0,1
					screen:'0',//筛选条件0,1，2，3
					pageindex:1,
					pagesize:10,
				},
				pageCount:0,
				moreStatus:'more',
				islogin:false,
				state:{}
			}
		},
		components:{
			KsFilter,
			UniLoadMore
		},
		onLoad() {
			this.$store.ready(state=>{
				this.state = state
			})
		},
		onPullDownRefresh() {
			this.loadPage()
		},
		onShow() {
			uni.showLoading({
			    title: '加载中'
			});
			this.$store.ready(state=>{
				
				if(state.isLogin == 1){
					this.islogin = true
					this.loadPage()
				}else{
					uni.hideLoading();
					this.islogin = false
					this.loaded = true
				}
			})
		},
		onReachBottom(e){
			this.getParameters.pageindex++
			this.moreList()
		},
		methods:{
			open(item){
				if(this.state.isshowprice){
					var url = encodeURIComponent(item.playurl)
					uni.navigateTo({
						url:'/pages/course/courseplay?photo='+item.courseImg+'&courseid='+item.courseId+'&periodid='+item.lastLearnPeriodId,
					});
				}
				
			},
			getOrderid(id){
				this.getParameters.sort = id
				this.loadPage()
			},
			getOrderids(id){
				this.getParameters.screen = id
				this.loadPage()
			},
			//滚动加载更多的方法
			moreList(){
				if(this.getParameters.pageindex > this.pageCount){
					this.moreStatus = 'noMore'
				}else{
					this.moreStatus = 'loading'
					this.loadPage('more')
				}
				
			},
			//初始数据的请求
			loadPage(status){
				if(status=='more'){
					MyCourseList(this.getParameters).then(res=>{
						this.moreStatus = 'more'
						if(res.result){
							this.courseList = this.courseList.concat(res.data)
						}
						this.loaded = true
					})
				}else{
					this.getParameters.pageindex = 1
					MyCourseList(this.getParameters).then(res=>{
						if(res.result){
							this.pageCount = res.pageCount
							this.courseList = res.data
							if(this.pageCount==1){
								this.moreStatus = 'noMore'
							}else{
								this.moreStatus = 'more'
							}
							if(this.pageCount==1){
								this.moreStatus = 'noMore'
							}else{
								this.moreStatus = 'more'
							}
						}else{
							this.courseList = []
							this.pageCount = 0
						}
						this.loaded = true
						uni.stopPullDownRefresh();
						uni.hideLoading();
					})
				}
			}
		}
	}
</script>
<style lang="scss" scoped>
	.height-auto-bg{
		height:45px ;
	}
	.courseList{
		border-top: 1px solid #eee;
		.course-box{
			padding:20px;
			.course-item{
				position:relative;
				padding-right:110px;
				margin-bottom:20px;
				min-height: 75px;
				.courseimg{
					position: absolute;
					right: 0;
					top: 0px;
					width: 100px;
					height: 75px;
					.courseimg__img{
						width: 100%;
						height: 100%;
						border-radius: 3px;
						overflow: hidden;
					}
					.course-tab{
						position:absolute;
						font-size: 12px;
						width: 28px;
						height: 17px;
						overflow: hidden;
						border-radius: 2px;
						background: rgba(0, 0, 0, 0.5);
						text-align: center;
						color: #fff;
						line-height: 17px;
						left: 4px;
						top:4px;
						z-index: 1;
					}
				}
				.course__info{
					.title{
						font-size: 16px;
						color: rgb(26,26,26);
						font-weight: 500;
						line-height: 20px;
						height: 40px;
					}
					.percent-box{
						font-size: 14px;
						color: #B2B2B2;
						.tips{
							text-align: right;
							margin-bottom: 5px;
							margin-top: 2px;
						}
						.percent{
							width: 100%;
							height: 2px;
							background: #D9D9D9;
							border-radius: 2px;
							overflow: hidden;
							.percented{
								height: 2px;
								background: #ff663d;
							}
						}
					}
					.live-status{
						font-size: 14px;
						color: #B2B2B2;
						margin-top: 10px;
						.green-font{
							color: #25D045;
						}
					}
				}
			}
			.course-item:last-child{
				margin-bottom: 0;
			}
		}
		
	}
</style>
