<template>
	<ks-page-scroller :page="getParameters.pageindex" :refresh-status.sync="refreshStatus" @scrolltolower="scrolltolower" @refresh="onRefresh" :height="height+'px'" :page-count="pageCount" v-if="grouplist.length">
		<!-- 小组列表 -->
		<view class="grouplist">
			<view class="withe-bg">
				<view v-for="item in grouplist" :key="item.boardId" class="news-item clearfix" @click="openUrl('/pages/class-center/group/details?boardid='+item.boardId)">
					<ks-image :src="item.photoUrl" class="newsimg__img" radius="4px"></ks-image>
					<view class="news__info">
						<view class="title">{{item.name}}</view>
						<view class="intro">
						  <!-- {{item.intro}} -->
						</view>
						<view class="info">
						  <view class="peoplenum">{{item.studentNum||0}}人加入</view>
						  <view class="dot"></view>
						  <view class="comment">{{item.topicNum||0}}个帖子</view>
						</view>
					</view>
				</view>
			</view>
		</view>
		<!-- 小组列表 -->
		
	</ks-page-scroller>
	<ks-empty type="list" v-else>暂无数据</ks-empty>
</template>

<script>
	import {GetDataList} from '@/api/class-center'
	export default {
		data(){
			return{
				grouplist:[],//小组列表
				getParameters:{
					a:'getplaytime',
					playtime:'group',//小组‘group’，问答‘ask’，作品‘works’，资讯‘information’
					pageindex:1,
					pagesize:10
				},
				pageCount:0,
				refreshStatus:false,
				height:0
			}
		},
		mounted(){
			uni.showLoading({
			    title: '加载中'
			});
			uni.getSystemInfo({
				success:res=>{
					this.height = res.windowHeight-44
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
							this.grouplist = this.grouplist.concat(res.groupmodel.groupList)
						}
						this.loading = false
					})
				}else{
					this.getParameters.pageindex=1
					GetDataList(this.getParameters).then(res=>{
						if(res.result){
							this.pageCount = res.groupmodel.pageCount
							this.grouplist = res.groupmodel.groupList
						}else{
							this.grouplist = []
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
	
	//小组列表样式
	.grouplist{
		margin-top: 9px;
		.news-item{
			padding:10px 10px 10px 145px;
			position: relative;
			min-height: 90px;
			.newsimg__img{
				position:absolute;
				left: 10px;
				top:10px;
				width: 120px;
				height: 90px;
				border-radius: 3px;
			}
			.news__info{
				box-sizing: border-box;
				.title{
					font-size:16px;
					color:#010E16;
					line-height: 24px;
					height: 24px;
					overflow: hidden;
					white-space: nowrap;
					text-overflow: ellipsis;
				}
				.intro{
					margin-top: 6px;
					line-height: 21px;
					height: 21px;
					overflow: hidden;
					white-space: nowrap;
					text-overflow: ellipsis;
					font-size: 14px;
					color:#888888;
				}
				.info{
					margin-top:13px;
					.peoplenum,.comment{
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
				}
			}
			
		}
	}
</style>
