<template>
	<view class="content" v-if="loaded">
		<view class="teacherlist" v-if="teacherlist.length">
			<view class="box withe-bg">
				<view v-for="item in teacherlist" :key="item.tcId" class="teacher-item" @click="open('/pages/teacher/details?tcid='+item.tcId)">
					<ks-image :src="item.photoUrl" type="teacher" class="teacherimg__img" radius="90px"></ks-image>
					<view class="teacher__info">
					  <view class="title">{{item.name}}</view>
					  <view class="intro" v-html="item.intro"></view>
					  <view class="info">
						  <view class="peoplenum">{{item.courseTotal||0}}门课程</view>
						  <view class="suline"></view>
						  <view class="comment">{{item.lookCount||0}}人浏览</view>
					  </view>
					</view>
				</view>
			</view>
			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
		</view>
		<ks-empty type="list" v-else>暂无数据</ks-empty>
	</view>
</template>

<script>
	import {GetAllTeacherList} from '@/api/teacher'
	import UniLoadMore from '@/components/uni/uni-load-more/uni-load-more.vue'
	export default {
		data(){
			return{
				loaded:false,
				teacherlist:[],
				getParameters:{
					pageindex:1,
					pagesize:10,
					key:'',
				},
				pageCount:0,
				moreStatus:'more'
			}
		},
		components:{
			UniLoadMore
		},
		onLoad: function() {
			uni.showLoading({
			    title: '加载中'
			});
			this.loadPage()
		},
		onPullDownRefresh() {
			this.loadPage()
		},
		onReachBottom(e){
			this.getParameters.pageindex++
			this.moreList()
		},
		onShareAppMessage(){
			var that = this
		　　// 设置菜单中的转发按钮触发转发事件时的转发内容
		　　var shareObj = {
		　　　　title: '科汛网校7.0的名师分享',
				path: '/pages/teacher/index',
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
			open(url){
				uni.navigateTo({
				    url:url
				});
			},
			moreList(){
				if(this.getParameters.pageindex > this.pageCount){
					this.moreStatus = 'noMore'
				}else{
					this.moreStatus = 'loading'
					this.loadPage('more')
				}
				
			},
			loadPage(status){
				if(status=='more'){
					GetAllTeacherList(this.getParameters).then(res=>{
						this.moreStatus = 'more'
						if(res.result){
							this.teacherlist = this.teacherlist.concat(res.data)
						}
						this.loaded = true
					})
				}else{
					this.getParameters.pageindex = 1
					GetAllTeacherList(this.getParameters).then(res=>{
						if(res.result){
							this.pageCount = res.pageCount
							if(this.pageCount==1){
								this.moreStatus = 'noMore'
							}else{
								this.moreStatus = 'more'
							}
							this.teacherlist = res.data
						}else{
							this.teacherlist = []
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
	.teacherlist .box{
		padding:15px 10px 5px;
		.teacher-item{
			margin-bottom: 15px;
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
