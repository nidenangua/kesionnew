<template>
	<view class="content" v-if="loaded">
		<view class="search">
			<view class="search-input">
				<icon type="search" size="18" @click="search"/>
				<input v-model="getParameters.key" placeholder="搜索你想要的内容" confirm-type="search" @confirm="search" />				
			</view>
		</view>
		<view class="heightbg"></view>
		<view class="grouplist" v-if="grouplist.length">
			<view class="withe-bg">
				<view v-for="item in grouplist" :key="item.roomId" class="news-item clearfix" @click="openUrl(item)">
					<ks-image :src="item.photoUrl" class="newsimg__img" radius="4px"></ks-image>
					<view class="news__info">
						<view class="title">{{item.title}}</view>
						<view class="intro">
						  {{item.info}}
						</view>
						<view class="info">
						  <view class="peoplenum">{{item.studentCount||0}}人加入</view>
						  <view class="dot"></view>
						  <view class="comment">{{item.courseCount||0}}门课程</view>
						</view>
					</view>
				</view>
			</view>
			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
		</view>
		<ks-empty type="list" v-else-if="!grouplist.length">暂无数据</ks-empty>

	</view>
</template>

<script>
	import {GetAppOtherConf} from '@/api/app'
	import {GetAllClassList} from '@/api/class-center'
	import KsFilter from '@/components/ks-components/filter/filter.vue'
	import UniLoadMore from '@/components/uni/uni-load-more/uni-load-more.vue'
	import UniIcons from '@/components/uni/uni-icons/uni-icons.vue'
	export default {
		data(){
			return{
				loaded:false,
				getParameters:{
					pageindex:1,
					pagesize:10,
					key:'',
				},
				sortList:[],//筛选列表
				grouplist:[],//班级列表
				pageCount:0,
				moreStatus:'more'
			}
		},
		components:{
			KsFilter,
			UniLoadMore,
			UniIcons
		},
		onLoad() {
			uni.showLoading({
			    title: '加载中'
			});
			uni.getSystemInfo({
				success:res=>{
					this.height = res.windowHeight
				}
			})
			this.loadPage()
		},
		onReachBottom(e){
			this.getParameters.pageindex++
			this.moreList()
		},
		onPullDownRefresh() {
			this.loadPage()
		},
		onShareAppMessage(){
		　　var shareObj = {
		　　　　	title: this.$store.state.siteName + ' - 班级列表',
				path: '/pages/class/index',
		　　　　	imageUrl: ''
		　　}
		　　return shareObj
		},
		methods: {
			open(){
				uni.navigateTo({
				    url: '../course/search'
				});
			},
			search(){
				if(this.getParameters.key){
					uni.navigateTo({
						url:'/pages/course/search?key='+this.getParameters.key
					})
				}
			},
			openUrl(item){
				var url = encodeURIComponent(item.weburl)
				uni.navigateTo({
					url:'/pages/web/web?title='+item.title+'&photo='+item.photoUrl+'&url='+url
				})
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
				GetAppOtherConf().then(res=>{
					this.getParameters.clearschcont = res.clearschcont
					if(status=='more'){
						GetAllClassList(this.getParameters).then(res=>{
							this.moreStatus = 'more'
							if(res.result){
								this.grouplist = this.grouplist.concat(res.data)
							}
							this.loaded = true
						})
					}else{
						this.getParameters.pageindex = 1
						GetAllClassList(this.getParameters).then(res=>{
							if(res.result){
								this.pageCount = res.pageCount
								this.grouplist = res.data
								if(this.pageCount==1){
									this.moreStatus = 'noMore'
								}else{
									this.moreStatus = 'more'
								}
							}else{
								this.grouplist = []
								this.pageCount = 0
							}
							this.loaded = true
							uni.stopPullDownRefresh();
							uni.hideLoading();
						})
					}
				})
				
			}
			
		}
	}
</script>

<style lang="scss" scoped>
	.search{
		width: 100%;
		display: flex;
		background: #fff;
		height: 44px;
		align-items: center;
		justify-content: center;
		position: fixed;
		top: 0;
		z-index: 10;
	}
	.search image{
		width: 30px;
		height: 30px;
		margin: 0 10px;
	}
	.search-input{
		width: calc(100% - 20px);
		height: 32px;
		background: #F7F7F7;
		border-radius: 12px;
		display: flex;
		align-items: center;
	}
	.search-input icon{
		 margin: 0 10px;
	}
	.search-input input{
		flex: 1;
		height: 100%;
		line-height: 20px;
		placeholder-color: #888888;
		font-size: 13px;
		min-height: 20px;
		height: 20px;
	}
	.heightbg{
		height:44px ;
	}
	
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
	.fab{
		position: fixed;
		right: 10px;
		bottom: 30px;
		.fab-button{
			width: 44px;
			height: 44px;
			// background: url(../../static/common/asksubmit.png) center #007AFF;
			background-size: 100% 100%;
			position:absolute;
			z-index: 100;
			left: 0;
			bottom: 0;
			border-radius: 44px;
		}
		.fab-box{
			position: relative;
			width: 44px;
			height: 44px;
			border-radius: 44px;
			z-index: 99;
			overflow: hidden;
			-webkit-transition: .3s;
			transition: .3s;
			box-sizing: border-box;
			border: 1px solid #007AFF;
			line-height: 44px;
			font-size: 16px;
			color: #010C17;
			background: #fff;
		}
		.curr{
			width: auto;
			padding:0 10px 0 54px ;
		}
	}
	
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
	.filter{
		position: fixed;
		top:44px;
		z-index: 1;
		padding-top: 11px;
		padding-left: 10px;
		padding-bottom: 11px;
		box-sizing: border-box;
		background: #f6f6f6;
		height: 50px;
		
		.filter-view-item{
			display: inline-block;
			text-align: center;
			padding: 4px 12px;
			background: #fff;
			margin-right: 10px;
			border-radius: 3px;
			font-size: 14px;
		}
		.on{
			color: #fff;
			background: #007AFF;
		}
	}
	.scroll-view_H{
		white-space: nowrap;
		width: 100%;
	}
	
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
