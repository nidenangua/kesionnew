<template>
	<ks-page-scroller :page="getParameters.pageindex" :refresh-status.sync="refreshStatus" @refresh="onRefresh" :height="height+'px'" :page-count="pageCount" v-if="newsList.length">
		<!-- 资讯列表 -->
		<view class="newslist">
			<view class="withe-bg">
				<view v-for="item in newsList" :key="item.id" class="news-item clearfix" @click="open(item)">
					<view class="news__info">
						<view class="title">{{item.title}}</view>
						<view class="intro">
						  <view class="addtime">{{item.adddate}}</view>
						  <view class="comment">{{item.hits||0}}人浏览</view>
						</view>
					</view>
					<ks-image :src="item.photo" class="newsimg__img" radius="4px"></ks-image>
				</view>
			</view>
		</view>
		<!-- 资讯列表 -->
	</ks-page-scroller>
	<ks-empty type="list" v-else>暂无数据</ks-empty>
</template>

<script>
	import {GetSchoolInfomation} from '@/api/school'
	export default {
		props:{
			schoolid:Number
		},
		data(){
			return{
				newsList:[],//新闻列表
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
				var url = encodeURIComponent(item.weburl)
				uni.navigateTo({
					url:'/pages/web/web?title='+item.title+'&photo='+item.photo+'&url='+url
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
					GetSchoolInfomation(this.getParameters).then(res=>{
						if(res.result){
							this.newsList = this.askList.concat(res.data)
						}
						this.loading = false
					})
				}else{
					this.getParameters.pageindex=1
					GetSchoolInfomation(this.getParameters).then(res=>{
						if(res.result){
							this.pageCount = res.pageCount
							this.newsList = res.data
						}else{
							this.newsList = []
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
	
	//资讯列表样式
	.newslist{
		margin-top: 9px;
		.news-item{
			padding:15px 145px 15px 10px;
			border-bottom: 1px solid #eee;
			position: relative;
			.news__info{
				box-sizing: border-box;
				.title{
					font-size:16px;
					color:#010E16;
					line-height: 24px;
					height: 72px;
					overflow: hidden;
				}
				.intro{
					margin-top:6px;
					.addtime,.comment{
						display: inline-block;
						color: #888888;
						font-size: 11px;
						line-height: 11px;
					}
					.addtime{
						margin-right:16px;
					}
				}
			}
			.newsimg__img{
				position:absolute;
				right: 10px;
				top: 15px;
				width: 120px;
				height: 90px;
			}
			
		}
	}
</style>
