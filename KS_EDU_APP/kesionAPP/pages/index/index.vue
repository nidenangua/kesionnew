<template>
	<view>
		<!-- 搜索区 -->
		<!-- 仅在微信小程序编译 -->
		<!-- #ifdef MP-WEIXIN -->
		<view class="search">
			<view class="search-input">
				<icon type="search" size="18" @click="search"/>
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
			<swiper class="swiper" :indicator-dots="true" :autoplay="true" indicator-active-color="#ffffff" :interval="2000" :duration="500" style="height:200px;margin-top: 44px;">
				<block v-for="(item,i) in bannerList">
					<swiper-item class="index-swiper-item" v-if="item.photo" :key="i" :style="'background-image:url('+item.photo+')'">
					</swiper-item>
				</block>
			</swiper>
		
			<!-- 导航区 -->
			<view v-if="moduleList.length>0" class="nav" :class="moduleList.length<8?'nowarp':'warp'">
				<view  class="nav-item"  v-for="(item,i) in moduleList" :key="i" @click="open(item)">
					<ks-image radius="50%" class="ks-image" :src="item.logo"></ks-image>
					<text>{{item.title}}</text>
				</view>
			</view>
			<view v-for="(item,i) in courseList" :key="i">
				<!-- type 1 限时抢购 ， 2 课堂直播 3 课程套餐 4 精选课程 5 精品班级-->
				<ks-box title="限时抢购" url="/pages/course/courselist?type=101" v-if="item.title == '限时抢购' && (isshowprice&&item.list.length>0)">
					<ks-course-list :type="1" :list="item.list"></ks-course-list>
				</ks-box>
				<ks-box title="课堂直播" url="/pages/course/courselist?type=5" v-else-if="item.title == '课堂直播'&&(isshowprice&&item.list.length>0)" >
					<ks-course-list :type="2" :list="item.list"></ks-course-list>
				</ks-box>
				<ks-box title="课程套餐" url="/pages/course/courselist?type=3" v-else-if="item.title == '专栏'&&item.list.length>0">
					<ks-course-list :type="3" :list="item.list"></ks-course-list>
				</ks-box>
				<ks-box title="精选课程" url="/pages/course/courselist?type=1" v-else-if="item.title == '精选课程'&&item.list.length>0">
					<ks-course-list :type="4" :list="item.list"></ks-course-list>
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
			
	</view>
</template>

<script>
	import {KsCourseList} from 'components/ks-components/course-list/course-list'

	import {GetHome} from 'api/index'
	export default {
		components:{KsCourseList},
		data() {
			return {
				courseList:[],
				bannerList:[],
				moduleList:[],
				key:'',
				state:{},
				isApp:false,
				appInitPic:false,
				isshowprice:false,
				baseUrl:this.$store.state.SRC+"/config/app"
			}
		},
		onShow() {
			
		},
		onLoad() {
			if(!uni.getStorageSync('appInitPic')){
				this.appInitPic = true
			}
			this.$store.ready(state=>{
				this.isshowprice = state.isshowprice
				this.initData()	
			})
			
		},
		onNavigationBarSearchInputConfirmed(query){
			uni.navigateTo({
				url:'/pages/course/search?key='+query.text
			})
			this.key = ''
		},
		onPullDownRefresh() {
			this.initData() 
		},
		onShareAppMessage(){
			var that = this
		　　// 设置菜单中的转发按钮触发转发事件时的转发内容
		　　var shareObj = {
		　　　 　title: '科汛网校v7.0',
				path: '/pages/index/index',
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
			openIndex(index){
				// console.log(index)
			},
			initData(){
				this.$store.ready(state=>{
					uni.showLoading({
						title:'加载中'
					});
					this.state = state
					GetHome().then(res=>{
						this.bannerList = res.chart
						this.moduleList = res.modulelist
						this.courseList = res.showinfo
						this.$nextTick(()=>{
							uni.hideLoading()
							uni.stopPullDownRefresh();
						})
					})
				})
				
			},
			openTestPage(){
				uni.navigateTo({
					url:'/pages/order-pay/order-pay'
				})
			},
			scroll: function(e) {
				// console.log(e)
			},
			search(){
				if(this.key){
					var title = this.key
					this.key = ''
					uni.navigateTo({
						url:'/pages/course/search?key='+title
					})
				}
			},
			open(item){
				let url
				if(item.type=='teacher'){
					url = '/pages/teacher/index'
				}else if(item.type=='class'){
					url = '/pages/class/index'
				}else if(item.type=='sj'){
					url = '/pages/exam/index'
				}else if(item.type=='school'){
					url = '/pages/school/index'
				}
			
				uni.navigateTo({
				    url: url
				});
			},
			openView(url){
				uni.navigateTo({
				    url: url
				});
			}
		}
	}
</script>

<style lang="scss">
	
	.status_bar {
	      height: var(--status-bar-height);
	      width: 100%;
	  }
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
	.index-swiper-item{
		background-size: cover;
		background-position: 50% 50%;	
	}
	.nav{
		padding: 2px 12px 17px 12px;
		background: #fff;
		font-size: 12px;
	}
	.nav-item{
		width: 25%;
		display: inline-block;
		text-align: center;
		position: relative;
		padding-top: 40px;
		margin-top: 15px;
	}
	.nav-item .ks-image{
		display: block;
		width: 36px;
		height: 36px;
		overflow:hidden;
		position: absolute;
		top: 0;
		left: 50%;
		margin-left: -18px;
	}	
	.nav-item text{
		padding-top: 5px;
	}
	.nowarp{
		white-space: nowrap;
		overflow: auto;
	}

	/*教师滑块*/
	.scroll-view_teacher{
		white-space: nowrap;
		width: 100%;
		padding-bottom: 10px;
	}
	.scroll-view-item_teacher{
		width:135px;
		display: inline-block;
		text-align: center;
		font-size: 18px;
		box-shadow:0px 1px 4px 0px rgba(3,14,26,0.1);
		border-radius:3px;
		margin-right: 10px;
		margin-bottom: 10px;
		overflow: hidden;
		position: relative;
	}
	.scroll-view-item_teacher .ks-image{
		height: 100px;
		width: 100%;

	}
	.teacher-name{
		overflow: hidden;
		white-space: nowrap;
		word-wrap:break-word;
		text-overflow: ellipsis;
		font-size:16px;
		font-weight:500;
		color:rgba(26,26,26,1);
		line-height: 24px;
	}
	.teacher-introduction{
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		word-wrap:break-word;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		font-size:12px;
		color:$uni-color-grey;
		line-height: 18px;
		height: 36px;
		margin-top: 5px;
		white-space:pre-wrap;
	}
</style>
