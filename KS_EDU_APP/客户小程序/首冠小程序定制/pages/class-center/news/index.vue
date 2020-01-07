<template>
	<ks-page-scroller :page="getParameters.pageindex" :refresh-status.sync="refreshStatus" @refresh="onRefresh" :height="height+'px'" :page-count="pageCount" v-if="newsList.length">
		<!-- 资讯列表 -->
		<view class="newslist">
			<view class="withe-bg">
				<view v-for="item in newsList" :key="item.infoid" class="news-item clearfix" @click="open(item)">
					<view class="news__info">
						<view class="title">{{item.title}}</view>
						<view class="intro">
						  <view class="addtime">{{item.adddate}}</view>
						  <view class="comment">{{item.commentnum||0}}个评论</view>
						</view>
					</view>
					<ks-image :src="item.defaultpic" class="newsimg__img" radius="4px"></ks-image>
				</view>
			</view>
		</view>
		<!-- 资讯列表 -->
	</ks-page-scroller>
	<ks-empty type="list" v-else>暂无数据</ks-empty>
</template>

<script>
	import {GetDataList} from '@/api/class-center'
	export default {
		props:{
			infoclassid:Number,
			orderid:Number
		},
		data(){
			return{
				newsList:[],//新闻列表
				getParameters:{
					a:'getplaytime',
					playtime:'information',//小组‘group’，问答‘ask’，作品‘works’，资讯‘information’
					pageindex:1,
					pagesize:10,
					key:'',
					infoclassid:0,//资讯的分类id
					orderid:0//资讯的筛选类型id
				},
				pageCount:0,
				refreshStatus:false,
				height:0,
			}
		},
		watch:{
			'infoclassid':{
				handler(infoclassid){
					this.getParameters.infoclassid = this.infoclassid
					this.loadPage()
				},
				deep:true
			},
			'orderid':{
				handler(orderid){
					this.getParameters.orderid = this.orderid
					this.loadPage()
				},
				deep:true
			}
		},
		mounted(){
			uni.showLoading({
			    title: '加载中'
			});
			uni.getSystemInfo({
				success:res=>{
					this.height = res.windowHeight-88
				}
			})
			this.loadPage()
		},
		methods: {
			onRefresh(){
				this.loadPage()
			},
			openUrl(url){
				uni.navigateTo({
				    url:url
				});
			},
			open(item){
				
				if(item.ischarge){
					uni.showToast({
					    title: '暂不支持观看付费资讯，请到h5或pc端查看',
					    duration: 2000,
						icon:'none',
					});
				}else{
					var url = encodeURIComponent(item.weburl)
					uni.navigateTo({
						url:'/pages/web/web?title='+item.title+'&photo='+item.defaultpic+'&url='+url
					})
				}
				
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
					GetDataList(this.getParameters).then(res=>{
						if(res.result){
							this.newsList = this.askList.concat(res.informationmodel.data)
						}
						this.loading = false
					})
				}else{
					this.getParameters.pageindex=1
					GetDataList(this.getParameters).then(res=>{
						if(res.result){
							this.pageCount = res.informationmodel.pageCount
							this.newsList = res.informationmodel.data
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
