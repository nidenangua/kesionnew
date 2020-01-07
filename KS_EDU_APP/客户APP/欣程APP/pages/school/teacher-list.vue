<template>
	<ks-page-scroller :page="getParameters.pageindex" :refresh-status.sync="refreshStatus" @refresh="onRefresh" :height="height+'px'" :page-count="pageCount" v-if="teacherList.length">
		<!-- 教师列表 -->
		<view class="teacherlist" v-if="teacherList.length">
			<view class="box">
				<view v-for="item in teacherList" :key="item.tcid" class="teacher-item withe-bg" @click="open(item)">
					<ks-image :src="item.photo" type="teacher" class="teacherimg__img" radius="90px"></ks-image>
					<view class="teacher__info">
					  <view class="title">{{item.tname}}</view>
					  <view class="intro" v-html="item.tintro"></view>
					  <view class="info">
						  <view class="peoplenum">{{item.coursetotal||0}}门课程</view>
						  <view class="suline"></view>
						  <view class="comment">{{item.lookcount||0}}人浏览</view>
					  </view>
					</view>
				</view>
			</view>
		</view>
		<!-- 教师列表 -->
	</ks-page-scroller>
	<ks-empty type="list" v-else>暂无数据</ks-empty>
</template>

<script>
	import {GetSchoolTeacherList} from '@/api/school'
	export default {
		props:{
			schoolid:Number
		},
		data(){
			return{
				teacherList:[],//教师列表
				getParameters:{
					schoolid:this.schoolid,
					pageindex:1,
					pagesize:10
				},
				pageCount:0,
				refreshStatus:false,
				height:0,
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
				uni.navigateTo({
					url:'/pages/teacher/details?tcid='+item.tcid
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
				if(this.loading){
					return
				}
				this.loading = true
				if(status=='more'){
					GetSchoolTeacherList(this.getParameters).then(res=>{
						if(res.result){
							this.teacherList = this.askList.concat(res.data)
						}
						this.loading = false
					})
				}else{
					this.getParameters.pageindex=1
					GetSchoolTeacherList(this.getParameters).then(res=>{
						if(res.result){
							this.pageCount = res.pageCount
							this.teacherList = res.data
						}else{
							this.teacherList = []
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
	.teacherlist .box{
		padding:9px 10px 5px;
		.teacher-item{
			margin-bottom: 10px;
			box-shadow: 0px 2px 10px 2px rgba(0, 0, 0, 0.05);
			border-radius: 3px;
			padding: 10px 10px 10px 111px;
			position: relative;
			min-height: 90px;
			.teacherimg__img{
				position: absolute;
				left:10px;
				top: 10px;
				width: 90px;
				height: 90px;
				border-radius: 90px;
				overflow: hidden;
			}
			
			.teacher__info{
				.title{
					color:#1A1A1A;
					font-size: 16px;
					margin-bottom: 5px;
					line-height: 20px;
					max-height: 40px;
					overflow: hidden;
				}
				.intro{
					font-size: 12px;
					color: #666666;
					line-height: 18px;
					max-height: 36px;
					overflow: hidden;
				}
				.info{
					color:#666666;
					line-height: 13px;
					margin-top: 10px;
					.peoplenum,.suline,.comment,{
						display: inline-block;
						font-size: 12px;
						color: #666;
						vertical-align: middle;
					}
					.suline{
						width: 1px;
						height: 13px;
						background: #666666;
						margin: 0 10px;
					}
				}
			}
		}
	}
</style>
