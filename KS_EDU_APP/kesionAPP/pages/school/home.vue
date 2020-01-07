<template>
	<ks-page-scroller :page="getParameters.pageindex" :refresh-status.sync="refreshStatus" @refresh="onRefresh" :height="height+'px'" v-if="courseList.length">
		<view class="title">热门课程</view>
		<!-- 课程列表 -->
		<view class="filter scroll-view_H clearfix">
			<scroll-view class="scroll-view-item_H" scroll-x="true">
				<view v-for="item in courseListHot" :key="item.courseid" class="hot-course-item">
					<view class="item-box withe-bg" @click="open(item)">
						<view class="item-box__img"><ks-image :src="item.photo" class="courseimg__img"></ks-image></view>
						<view class="course__info">
							<view class="title">{{item.name}}</view>
							<view class="money" v-if="isshowprice" :class="item.price=='0.00'&&'free-money'">{{item.price=='0.00'?'免费':'￥'+item.price}}</view>
						</view>
					</view>
				</view>
				
			</scroll-view>
		</view>
		<!-- 课程列表 -->
		<view class="title">主打课程</view>
		<!-- 课程列表 -->
		<view class="courselist clearfix">
			<view v-for="item in courseList" :key="item.courseid" class="course-item">
				<view class="item-box withe-bg" @click="open(item)">
					<view class="item-box__img"><ks-image :src="item.photo" class="courseimg__img"></ks-image></view>
					<view class="course__info">
						<view class="title">{{item.name}}</view>
						<view class="money" v-if="isshowprice" :class="item.price=='0.00'&&'free-money'">{{item.price=='0.00'?'免费':'￥'+item.price}}</view>
					</view>
				</view>
			</view>
		</view>
		
		<!-- 课程列表 -->
	</ks-page-scroller>
	<ks-empty type="list" v-else>暂无数据</ks-empty>
</template>

<script>
	import {GetSchoolInfo} from '@/api/school'
	export default {
		props:{
			schoolid:Number,
			show:false
		},
		data(){
			return{
				courseList:[],//新闻列表
				courseListHot:[],
				getParameters:{
					schoolid:this.schoolid
				},
				refreshStatus:false,
				height:0,
				isshowprice:false
			}
		},
		mounted(){
			uni.showLoading({
			    title: '加载中'
			});
			uni.getSystemInfo({
				success:res=>{
					this.height = res.windowHeight-226
				}
			})
			this.loadPage()
		},
		methods: {
			onRefresh(){
				this.loadPage()
			},
			open(item){
				var url = encodeURIComponent(item.weburl)
				uni.navigateTo({
					url:'/pages/web/web?title='+item.name+'&photo='+item.photo+'&url='+url
				})
				
			},
			//初始数据的请求
			loadPage(){
				this.isshowprice = this.$store.state.isshowprice
				if(this.loading){
					return
				}
				this.loading = true
				GetSchoolInfo(this.getParameters).then(res=>{
					if(res.result){
						this.courseList = res.courseList
						this.courseListHot = res.courseListHot
					}else{
						this.courseList = []
						this.courseListHot = []
					}
					uni.hideLoading();
					this.loading = false
					setTimeout(()=>{
						this.refreshStatus = false
					},1000)
				})
			}
			
		}
	}
</script>

<style lang="scss" scoped>
	.title{
		padding: 0 10px;
		font-size: 16px;
		margin-top: 10px;
	}
	.filter{
		box-sizing: border-box;
		height: 150px;
		margin-top: 10px;
		.hot-course-item{
			display: inline-block;
			width: 150px;
			.item-box{
				width: 90%;
				margin: 0px auto 10px;
				border-radius: 5px;
				overflow: hidden;
				.course__info{
					box-sizing: border-box;
					.title{
						font-size:15px;
						color:#010E16;
						line-height: 20px;
						height: 20px;
						white-space: nowrap;
						text-overflow: ellipsis;
						overflow: hidden;
						margin:10px 10px 5px;
					}
					.money{
						display: inline-block;
						color: #ff663d;
						font-size: 14px;
						line-height: 14px;
						margin:0 10px 10px;
					}
				}
				.item-box__img{
					width: 100%;
					height: 80px;
					.courseimg__img{
						width: 100%;
						height: 80px;
					}
				}
				
			}
		}
	}
	.scroll-view_H{
		white-space: nowrap;
		width: 100%;
	}
	
	//课程列表样式
	.courselist{
		margin-top: 10px;
	
		.course-item{
			float: left;
			width: 50%;
			.item-box{
				width: 90%;
				margin: 0px auto 10px;
				border-radius: 5px;
				overflow: hidden;
				.course__info{
					box-sizing: border-box;
					.title{
						font-size:15px;
						color:#010E16;
						line-height: 20px;
						height: 40px;
						overflow: hidden;
						margin:10px 10px 5px;
					}
					.money{
						display: inline-block;
						color: #ff663d;
						font-size: 14px;
						line-height: 14px;
						margin:0 10px 10px;
					}
				}
				.item-box__img{
					width: 100%;
					height: 120px;
					.courseimg__img{
						width: 100%;
						height: 120px;
					}
				}
				
			}
			
			
		}
	}
	.free-money{
		color: #1AAD19 !important;
	}
</style>
