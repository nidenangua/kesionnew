<template>
	<ks-page-scroller :page="getParameters.pageindex" :refresh-status.sync="refreshStatus" @refresh="onRefresh" :height="height+'px'" :page-count="pageCount" v-if="courseList.length">
		<!-- 课程列表 -->
		<view class="courselist clearfix">
			<view v-for="item in courseList" :key="item.courseId" class="course-item">
				<view class="item-box withe-bg" @click="open(item)">
					<view class="item-box__img"><ks-image :src="item.photoUrl" class="courseimg__img"></ks-image></view>
					<view class="course__info">
						<view class="title">{{item.courseName}}</view>
						<view class="money" v-if="isshowprice" :class="item.money=='0.00'&&'free-money'">{{item.money=='0.00'?'免费':'￥'+item.money}}</view>
					</view>
				</view>
			</view>
		</view>
		<!-- 课程列表 -->
	</ks-page-scroller>
	<ks-empty type="list" v-else>暂无数据</ks-empty>
</template>

<script>
	import {GetSchoolCourseList} from '@/api/school'
	export default {
		props:{
			schoolid:Number,
			costype:Number
		},
		data(){
			return{
				courseList:[],
				getParameters:{
					schoolid:this.schoolid,
					pageindex:1,
					pagesize:10,
					costype:this.costype//	课程类型
				},
				pageCount:0,
				refreshStatus:false,
				height:0,
				isshowprice:false
			}
		},
		watch:{
			'costype':{
				handler(costype){
					this.getParameters.costype = this.costype
					this.loadPage()
				},
				deep:true
			},
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
					url:'/pages/web/web?title='+item.courseName+'&photo='+item.photoUrl+'&url='+url
				})
			},
			scrolltolower(){
				this.getParameters.pageindex++
				if(this.getParameters.pageindex <= this.pageCount){
					this.loadPage('more')
				}
			},
			//初始数据的请求
			loadPage(status){
				this.isshowprice = this.$store.state.isshowprice
				if(this.loading){
					return
				}
				this.loading = true
				if(status=='more'){
					GetSchoolCourseList(this.getParameters).then(res=>{
						if(res.result){
							this.courseList = this.askList.concat(res.data)
						}
						this.loading = false
					})
				}else{
					this.getParameters.pageindex=1
					GetSchoolCourseList(this.getParameters).then(res=>{
						if(res.result){
							this.pageCount = res.pageCount
							this.courseList = res.data
						}else{
							this.courseList = []
							this.pageCount = 0
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
	}
</script>

<style lang="scss" scoped>
	
	//课程列表样式
	.courselist{
		margin-top: 15px;

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
