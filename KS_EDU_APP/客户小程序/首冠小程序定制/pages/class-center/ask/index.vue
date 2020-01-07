<template>
	<ks-page-scroller :page="getParameters.pageindex" :refresh-status.sync="refreshStatus" @refresh="onRefresh" @scrolltolower="scrolltolower" :height="height+'px'" :page-count="pageCount" v-if="askList.length">
		<!-- 问答列表 -->
		<view class="asklist">
			<view class="withe-bg">
				<view v-for="item in askList" :key="item.topicId" class="ask-item clearfix" @click="openUrl('/pages/class-center/ask/details?topicid='+item.topicId)">
					<view class="ask__info">
						<view class="title">{{item.title}}</view>
						<view class="intro" v-html="item.content"></view>
					</view>
					<view class="clearfix">
						<view class="askimg  ks-col-12">
						  <ks-image :src="item.userFace" type="user" class="askimg__img" radius="30px"></ks-image>
						  <text class="user-name f12">{{item.userName}}</text>
						</view>
						<view class="info ks-col-12">
						  <view class="comment">{{item.hits}}人浏览</view><view class="dot"></view>
						  <view class="collect">{{item.postNum}}人回复</view>
						</view>
					</view>
				</view>
			</view>
		</view>
		<!-- 问答列表 -->
	</ks-page-scroller>
	<ks-empty type="list" v-else>暂无数据</ks-empty>
</template>

<script>
	import {GetDataList} from '@/api/class-center'
	export default {
		props:{
			askclassid:Number,
			selectid:Number
		},
		data(){
			return{
				askList:[],//问答列表
				getParameters:{
					a:'getplaytime',
					playtime:'ask',//小组‘group’，问答‘ask’，作品‘works’，资讯‘information’
					pageindex:1,
					pagesize:10,
					key:'',
					askclassid:0,//问答的分类id
					selectid:0,//问答的筛选类型id
				},
				pageCount:0,
				refreshStatus:false,
				height:0
			}
		},
		watch:{
			'askclassid':{
				handler(askclassid){
					this.getParameters.askclassid = this.askclassid
					this.loadPage()
				},
				
				deep:true
			},
			'selectid':{
				handler(selectid){
					this.getParameters.selectid = this.selectid
					this.loadPage()
				},
				
				deep:true
			},
		},
		mounted(){
			if(this.isrefresh){
				//console.log(111)
				this.loadPage()
			}
			uni.showLoading({
			    title: '加载中'
			});
			uni.getSystemInfo({
				success:res=>{
					this.height= res.windowHeight-88
				}
			})
			this.getParameters.askclassid = this.askclassid
			this.getParameters.selectid = this.selectid
			this.loadPage()
		},
		methods: {
			onRefresh(){
				this.loadPage()
				// setTimeout(()=>{
				// 	this.refreshStatus = false
				// },2000)
			},
			openUrl(url){
				uni.navigateTo({
				    url:url
				});
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
							this.askList = this.askList.concat(res.askmodel.data)
						}
						this.loading = false
					})
				}else{
					this.getParameters.pageindex=1
					GetDataList(this.getParameters).then(res=>{
						if(res.result){
							this.pageCount = res.askmodel.pageCount
							this.askList = res.askmodel.data
						}else{
							this.askList = []
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
	
	//问答列表样式
	.asklist{
		margin-top: 9px;
		.ask-item{
			padding:15px 10px;
			border-bottom: 1px solid #eee;
			.ask__info{
				box-sizing: border-box;
				.title{
					font-size:16px;
					color:#010E16;
					line-height: 24px;
					overflow: hidden;
				}
				.intro{
					color: #666666;
					line-height: 21px;
					font-size: 14px;
					margin-top: 15px;
					margin-bottom: 15px;
					overflow-x: hidden;
				}
			}
			.askimg__img{
				position:relative;
				width: 27px;
				height: 27px;
				border-radius: 27px;
				overflow: hidden;
				display:inline-block;
				vertical-align: middle;
				margin-right: 5px;
			}
			.info{
				margin-top:6px;
				text-align:right;
				.collect,.comment{
					display: inline-block;
					color: #888888;
					font-size: 11px;
					line-height: 11px;
				}
				.dot{
					display: inline-block;
					vertical-align: middle;
					width: 2px;
					height: 2px;
					border-radius: 2px;
					background: #888;
					margin: 0 4px;
				}
				.addtime{
					margin-right:16px;
				}
			}
		}
	}

</style>
