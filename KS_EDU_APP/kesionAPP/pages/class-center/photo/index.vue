<template>
	<ks-page-scroller :page="getParameters.pageindex" :refresh-status.sync="refreshStatus" @refresh="onRefresh" @scrolltolower="scrolltolower" :height="height+'px'" :page-count="pageCount" v-if="photoList.length">
		<!-- 作品列表 -->
		<view class="photolist">
			<view v-for="item in photoList" :key="item.infoid" class="photo-item clearfix withe-bg" @click="openUrl('/pages/class-center/photo/details?infoid='+item.infoid)">
				<view class="photoimg__img">
					<ks-image :src="item.defaultpic" radius="4px"></ks-image>
				</view>
				<view class="photo__info">
					<view class="title">{{item.title}}</view>
					<view class="intro">{{item.intro}}</view>
					<view class="info">
					  <image :src="baseUrl+'/static/images/common/read.png'" class="read"><view class="comment">{{item.hits}}</view>
					</view>
				</view>
			</view>
		</view>
		<!-- 作品列表 -->
		
	</ks-page-scroller>
	<ks-empty type="list" v-else>暂无数据</ks-empty>
</template>

<script>
	import {GetDataList} from '@/api/class-center'
	export default {
		props:{
			workclassid:Number
		},
		data(){
			return{
				baseUrl:this.$store.state.SRC+"/config/app",
				photoList:[],//作品列表
				getParameters:{
					a:'getplaytime',
					playtime:'works',//小组‘group’，问答‘ask’，作品‘works’，资讯‘information’
					pageindex:1,
					pagesize:10,
					key:'',
					workclassid:0,//作品的分类id
				},
				pageCount:0,
				refreshStatus:false,
				height:0
			}
		},
		watch:{
			'workclassid':{
				handler(workclassid){
					this.getParameters.workclassid = this.workclassid
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
							this.photoList = this.askList.concat(res.worksmodel.data)
						}
						this.loading = false
					})
				}else{
					this.getParameters.pageindex=1
					GetDataList(this.getParameters).then(res=>{
						if(res.result){
							this.pageCount = res.worksmodel.pageCount
							this.photoList = res.worksmodel.data
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
	
	//作品列表样式
	.photolist{
		margin-top: 9px;
		.photo-item{
			padding:15px 10px;
			border-bottom: 1px solid #eee;
			.photo__info{
				box-sizing: border-box;
				padding-right: 15px;
				.title{
					font-size:16px;
					color:#010E16;
					line-height: 24px;
					max-height: 72px;
					overflow: hidden;
				}
				.intro{
					margin-top: 7.5px;
					line-height: 21px;
					height: 21px;
					overflow: hidden;
					white-space: nowrap;
					text-overflow: ellipsis;
					font-size: 14px;
					color:#888888;
				}
				.info{
					margin-top:6px;
					.read{
						width: 20px;
						height: 20px;
						display: inline-block;
						margin-right: 4px;
						vertical-align: middle;
					}
					.comment{
						display: inline-block;
						color: #888888;
						font-size: 11px;
						line-height: 11px;
						vertical-align: middle;
					}
				}
			}
			.photoimg__img{
				position:relative;
				height: 200px;
				width: 100%;
				margin-bottom: 15px;
			}
		}
	}
	
</style>
