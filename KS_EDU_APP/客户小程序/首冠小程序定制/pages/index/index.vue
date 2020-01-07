<template>
	<view v-if="loaded">
		<!-- 搜索区 -->
		<!-- 仅在微信小程序编译 -->
		<!-- #ifdef MP-WEIXIN -->
		<view class="search">
			<view class="search-input">
				<icon type="search" size="18" @click="search" />
				<input v-model="key" placeholder="搜索你想要的内容" confirm-type="search" @confirm="search" />
			</view>
		</view>
		<!-- #endif -->
		<!-- 仅在app编译 -->
		<!-- #ifdef APP-PLUS -->
		<view class="status_bar">
			<!-- 这里是状态栏 -->
		</view>
		<!-- #endif -->
		<!-- <image :src="baseUrl+'/static/images/index/index_btn_shop@2x.png'" @click="openView('/pages/web/web?title=购物车&url='+encodeURIComponent('/cshoppingcart'))"></image> -->
		<!-- <image @click="openTestPage" :src="baseUrl+'/static/images/index/index_btn_download@2x.png'"></image> -->

		<!-- 轮播区 -->
		<swiper class="swiper" :indicator-dots="true" :autoplay="true" indicator-active-color="#ffffff" :interval="2000"
		 :duration="500" style="height:200px;margin-top: 44px;">
			<block v-for="(item,i) in bannerList">
				<swiper-item class="index-swiper-item" v-if="item.photo" :key="i" :style="'background-image:url('+item.photo+')'">
				</swiper-item>
			</block>
		</swiper>

		<!-- 导航区 -->
		<view v-if="moduleList.length>0" class="nav" :class="moduleList.length<8?'nowarp':'warp'">
			<view class="nav-item" v-for="(item,i) in moduleList" :key="i" @click="openNav(item)">
				<ks-image radius="50%" class="ks-image" :src="item.logo"></ks-image>
				<text>{{item.title}}</text>
			</view>
		</view>
		<view v-for="(item,i) in courseList" :key="i">
			<!-- type 1 限时抢购 ， 2 课堂直播 3 课程套餐 4 精选课程 5 精品班级-->
			<ks-box title="限时抢购" url="/pages/course/courselist?type=101" v-if="item.title == '限时抢购' && (state.isshowprice&&item.list.length>0)">
				<ks-course-list :type="1" :list="item.list"></ks-course-list>
			</ks-box>
			<ks-box title="直播课堂" url="/pages/course/courselist?type=5" v-else-if="item.title == '课堂直播'&&(state.isshowprice&&item.list.length>0)">
				<ks-course-list :type="2" :list="item.list"></ks-course-list>
			</ks-box>
			<ks-box title="课程专栏" url="/pages/course/courselist?type=3" v-else-if="item.title == '专栏'&&item.list.length>0">
				<ks-course-list :type="3" :list="item.list"></ks-course-list>
			</ks-box>

			<ks-box title="精品班级" url="/pages/class/index" v-else-if="item.title == '精品班级'&&item.list.length>0">
				<ks-course-list :type="5" :list="item.list"></ks-course-list>
			</ks-box>
			<ks-box title="资深讲师" url="/pages/teacher/index" v-else-if="item.title == '资深讲师'&&item.list.length>0">
				<scroll-view class="scroll-view_teacher" scroll-x="true" @scroll="scroll">
					<view :id="'demo'+s" class="scroll-view-item_teacher" v-for="(site,s) in item.list" :key="s" @click="openView('/pages/teacher/details?tcid='+site.id)">
						<view style="display: flex;flex-direction: column;">
							<ks-image class="ks-image" :src="site.photo" type="teacher"></ks-image>
							<view style="padding: 10px 5px;text-align: left;">
								<view class="teacher-name">{{site.name}}</view>
								<view class="teacher-introduction">{{site.info}}</view>
							</view>
						</view>
					</view>
				</scroll-view>
			</ks-box>

		</view>
		<view style="background: #fff;margin-top: 10px;">
			<view style="padding: 10px 0;display: flex;justify-content: space-between;">
				<view v-for="(item,i) in tabs" :key="i" style="margin: 0 20px;" :style="i==index?'color:#ff663d;':''" @click="getList(i)">
					{{item}}
				</view>
			</view>
			<view class="ks-course__list" style="display: flex;justify-content: space-between;flex-wrap:wrap;padding: 0 10px 20px 10px;" >
				<view class="concentration-course__item" v-for="(item,i) in clist" :key="i" @click="open(item)">
					<view style="display: flex;flex-direction: column;">
						<ks-image class="ks-image" :src="item.courseImg"></ks-image>
						<view class="ks-course__title--1">{{item.courseName}}</view>
						<view class="flex-box__space" style="font-size: 12px;margin: 5px 0;">
							<view class="flex-box" style="height:16px;">
								<uni-rate disabled="true" :value="item.coursepf" size="14" active-color="#ff663d"></uni-rate>
								<text style="color:#ff663d;margin-left:10px;">{{item.coursepf}}分</text>
							</view>

						</view>
						<view class="flex-box__space" style="font-size: 12px;">
							<view class="ks-course__price" v-if="state.isshowprice">{{item.pricetext}}</view>
							<view>{{item.buyNum}}人学习</view>
						</view>
						
					</view>

				</view>
				
			</view>
			<ks-empty type="tips" v-if="pageCount<=0">暂无数据</ks-empty>
		</view>
		<ks-box title="新闻资讯" url="/pages/class-center/index?index=3&type=information">
			<!-- 资讯列表 -->
			<view class="newslist">
				<view class="withe-bg">
					<view v-for="item in newsList" :key="item.infoid" class="news-item clearfix" @click="openNews(item)">
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
		</ks-box>


	</view>
</template>

<script>
	import {
		GetVodList
	} from '@/api/course'
	import {
		GetDataList
	} from '@/api/class-center'
	import {
		KsCourseList
	} from 'components/ks-components/course-list/course-list'
	import {
		GET
	} from 'api/main.entrance.js'
	import {
		GetHome
	} from 'api/index'
	import {
		UniRate
	} from 'components/uni/uni-rate/uni-rate'
	export default {
		components: {
			KsCourseList,
			UniRate
		},
		data() {
			return {
				courseList: [],
				bannerList: [],
				moduleList: [],
				newsList: [],
				key: '',
				state: {},
				isApp: false,
				appInitPic: false,
				baseUrl: this.$store.state.SRC + "/config/app",
				configData: {},
				tabs: ['精选好课', '新课推荐', '免费好课'],
				clist: [],
				index: 0,
				loaded:false,
				pageCount:1
			}
		},
		onShow() {

		},
		onLoad() {
			
			
			//首冠定制导航
			GET('/config/app/nav.txt').then(res => {
				this.configData = res.data
			
				if (!uni.getStorageSync('appInitPic')) {
					this.appInitPic = true
				}
				this.$store.ready(state => {
					this.state = state
					if(!state.isshowprice){
						uni.setTabBarItem({
						  index: 2,
						  text: '专栏',
						  iconPath: '/static/tabbar/msn.png',
						  selectedIconPath: '/static/tabbar/mss.png'
						})
					}
					this.initData()
				})
			})


		},
		onNavigationBarSearchInputConfirmed(query) {
			uni.navigateTo({
				url: '/pages/course/search?key=' + query.text
			})
			this.key = ''
		},
		onPullDownRefresh() {
			this.initData()
		},
		onShareAppMessage() {
			var that = this
			// 设置菜单中的转发按钮触发转发事件时的转发内容
			var shareObj = {
				title: this.state.siteName,
				path: '/pages/index/index',
				imageUrl: '',
				success: function(res) {
					// 转发成功之后的回调
					if (res.errMsg == 'shareAppMessage:ok') {}
				},
				fail: function() {
					// 转发失败之后的回调
					if (res.errMsg == 'shareAppMessage:fail cancel') {
						// 用户取消转发
					} else if (res.errMsg == 'shareAppMessage:fail') {
						// 转发失败，其中 detail message 为详细失败信息
					}
				}
			};
			// 返回shareObj
			return shareObj;
		},
		methods: {

			getList(i = 0) {
				this.index = i
				this.clist = []
				GetVodList({
					page: 1,
					pagesize: 6,
					popular: i == 0 ? 1 : '',
					recommend: i == 1 ? 1 : '',
					isfree: i == 2 ? 1 : '',
				}).then(res => {
					this.pageCount = res.pageCount
					if (res.result) {
						this.clist = res.data
					}
				})
			},
			openIndex(index) {
				// console.log(index)
			},
			initData() {
				this.$store.ready(state => {
					
					uni.showLoading({
						title: '加载中'
					});
					this.state = state
					GetHome().then(res => {
						
						this.bannerList = res.chart

						this.moduleList = this.configData.list

						//把专栏课程放到底部
						var obj
						this.courseList = res.showinfo.filter(item => {
							if (item.title != '专栏') {
								return item
							} else {
								obj = item
							}
						})

						this.courseList.push(obj)
						//获取课程数据
						this.getList()
						// 获取新闻列表
						GetDataList({
							a: 'getplaytime',
							playtime: 'information', //小组‘group’，问答‘ask’，作品‘works’，资讯‘information’
							pageindex: 1,
							pagesize: 5,
							key: '',
							infoclassid: 0, //资讯的分类id
							orderid: 0 //资讯的筛选类型id
						}).then(res => {
							if (res.result) {
								this.newsList = res.informationmodel.data
							}
						})
						this.$nextTick(() => {
							uni.hideLoading()
							this.loaded = true
							uni.stopPullDownRefresh();
						})
					})

				})

			},
			openTestPage() {
				uni.navigateTo({
					url: '/pages/order-pay/order-pay'
				})
			},
			scroll: function(e) {
				// console.log(e)
			},
			search() {
				if (this.key) {
					var title = this.key
					this.key = ''
					uni.navigateTo({
						url: '/pages/course/search?key=' + title
					})
				}
			},
			open(item){
				if(this.state.isshowprice){
					var url = item.getViewUrl
					url = encodeURIComponent(url)
					uni.navigateTo({
						url:'/pages/web/web?title='+item.courseName+'&photo='+item.courseImg+'&url='+url
					})
				}
					
				
			},
			openNews(item){
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
			openNav(item) {

				if (item.id.length == 1) {
					uni.navigateTo({
						url: '/pages/course/courselist?type=1&yjId=' + item.id[0]
					})
				} else if (item.id.length == 2) {
					uni.navigateTo({
						url: '/pages/course/courselist?type=1&yjId=' + item.id[0] + '&ejId=' + item.id[1]
					})
				} else {
					uni.navigateTo({
						url: '/pages/course/courselist?type=1&yjId=' + item.id[0] + '&ejId=' + item.id[1] + '&sjId=' + item.id[2]
					})
				}

			},
			openView(url) {
				uni.navigateTo({
					url: url
				});
			}
		}
	}
</script>

<style lang="scss" scoped>
	.status_bar {
		height: var(--status-bar-height);
		width: 100%;
	}

	.search {
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

	.search image {
		width: 30px;
		height: 30px;
		margin: 0 10px;
	}

	.search-input {
		width: calc(100% - 20px);
		height: 32px;
		background: #F7F7F7;
		border-radius: 12px;
		display: flex;
		align-items: center;
	}

	.search-input icon {
		margin: 0 10px;
	}

	.search-input input {
		flex: 1;
		height: 100%;
		line-height: 20px;
		placeholder-color: #888888;
		font-size: 13px;
		min-height: 20px;
		height: 20px;
	}

	.index-swiper-item {
		background-size: cover;
		background-position: 50% 50%;
	}

	.nav {
		padding: 2px 12px 17px 12px;
		background: #fff;
		font-size: 12px;
	}

	.nav-item {
		width: 25%;
		display: inline-block;
		text-align: center;
		position: relative;
		padding-top: 40px;
		margin-top: 15px;
	}

	.nav-item .ks-image {
		display: block;
		width: 36px;
		height: 36px;
		overflow: hidden;
		position: absolute;
		top: 0;
		left: 50%;
		margin-left: -18px;
	}

	.nav-item text {
		padding-top: 10px;
	}

	.nowarp {
		white-space: nowrap;
		overflow: auto;
	}

	.ks-course__price {
		color: #FF3B30;
		font-size: 14px;
	}

	/*教师滑块*/
	.scroll-view_teacher {
		white-space: nowrap;
		width: 100%;
		padding-bottom: 10px;
	}

	.scroll-view-item_teacher {
		width: 135px;
		display: inline-block;
		text-align: center;
		font-size: 18px;
		box-shadow: 0px 1px 4px 0px rgba(3, 14, 26, 0.1);
		border-radius: 3px;
		margin-right: 10px;
		margin-bottom: 10px;

	}

	.scroll-view-item_teacher .ks-image {
		height: 100px;
		width: 100%;

	}

	.teacher-name {
		overflow: hidden;
		white-space: nowrap;
		word-wrap: break-word;
		text-overflow: ellipsis;
		font-size: 16px;
		font-family: PingFang SC;
		font-weight: 500;
		color: rgba(26, 26, 26, 1);
		line-height: 24px;
	}

	.teacher-introduction {
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		word-wrap: break-word;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		font-size: 12px;
		color: rgba(26, 26, 26, 1);
		line-height: 18px;
		height: 36px;
		margin-top: 5px;
		white-space: pre-wrap;
	}

	/* 新闻模块 */
	//资讯列表样式
	.newslist {
		margin-top: 9px;

		.news-item {
			padding: 15px 145px 15px 10px;
			border-bottom: 1px solid #eee;
			position: relative;

			.news__info {
				box-sizing: border-box;

				.title {
					font-size: 16px;
					color: #010E16;
					line-height: 24px;
					height: 72px;
					overflow: hidden;
				}

				.intro {
					margin-top: 6px;

					.addtime,
					.comment {
						display: inline-block;
						color: #888888;
						font-size: 11px;
						line-height: 11px;
					}

					.addtime {
						margin-right: 16px;
					}
				}
			}

			.newsimg__img {
				position: absolute;
				right: 10px;
				top: 15px;
				width: 120px;
				height: 90px;
			}

		}
	}

	/*精选课程*/
	.concentration-course__item {
		width: calc(50% - 10px);
		padding: 15px 0 10px 0;
	}

	.concentration-course__item .ks-image {
		width: 100%;
		height: 114px;
		border-radius: 5px;
		overflow: hidden;
	}
</style>
