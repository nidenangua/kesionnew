<template>
	<view class="content" v-if="loaded">
		<view class="search">
			<view class="search-input">
				<icon type="search" size="18" @click="search"/>
				<input v-model="getParameters.key" placeholder="搜索你想要的内容" confirm-type="search" @confirm="search" />				
			</view>
		</view>
		<view class="heightbg"></view>
		<ks-filter :sortList="sortList" class="filter-Box" :sortLists="sortLists" @getOrderid="getOrderid" @getOrderids="getOrderids" :action="1"></ks-filter>
		<!-- 小组列表 -->
		<view class="schoollist" v-if="schoollist.length&&tabIndex==0">
			<view>
				<view v-for="item in schoollist" :key="item.id" class="schoollist__item withe-bg">
					<view class="news-item clearfix" @click="openUrl(item.id)">
						<ks-image :src="item.logo" class="newsimg__img" radius="40px"></ks-image>
						<view class="entrance">详情</view>
						<view class="news__info">
							<view class="title">{{item.companyname}}</view>
							<view class="info">
								<view class="peoplenum">{{item.hits||0}}人浏览</view>
								<view class="dot"></view>
								<view class="comment">{{item.zannum||0}}人点赞</view>
							</view>
						</view>
					</view>
					<view class="school__course-list" v-if="item.courseList.length">
						<view v-for="citem in item.courseList" :key="citem.courseid" class="citem">
							<view class="course__item" @click="openCourse(citem)">
								<ks-image :src="citem.photo" class="course-list__img" radius="4px"></ks-image>
								<text class="course-price" v-if="isshowprice">{{citem.price=='0.00'?'免费':'￥'+citem.price}}</text>
							</view>
						</view>
					</view>
				</view>
			</view>
			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
		</view>
		<!-- 小组列表 -->
		
		<ks-empty type="list" v-else-if="(!schoollist.length&&tabIndex==0)||(!askList.length&&tabIndex==1)||(!photoList.length&&tabIndex==2)||(!newsList.length&&tabIndex==3)">暂无数据</ks-empty>

	</view>
</template>

<script>
	import {GetSchoolList} from '@/api/school'
	import KsImage from '@/components/ks-components/image/Image.vue'
	import KsFilter from '@/components/ks-components/filter/filter.vue'
	import KsEmpty from '@/components/ks-components/empty/empty.vue'
	import UniLoadMore from '@/components/uni/uni-load-more/uni-load-more.vue'
	import UniIcons from '@/components/uni/uni-icons/uni-icons.vue'
	export default {
		data(){
			return{
				loaded:false,
				tabIndex:0,//0小组，1问答，2作品，3资讯
				tabBars: ['小组','问答','作品','资讯'],
				getParameters:{
					pageindex:1,
					pagesize:10,
					key:'',
					orderid:0,
					type:0
				},
				sortList:[
					{type:0,name:'浏览量降序'},
					{type:1,name:'浏览量升序'},
					{type:2,name:'综合排序'}
				],//筛选列表
				sortLists:[
					{type:0,name:'全部'},
					{type:1,name:'已认证'},
					{type:2,name:'未认证'},
					{type:3,name:'最新一周'}
				],
				schoollist:[],//小组列表
				pageCount:0,
				moreStatus:'more',
				isshowprice:false
			}
		},
		components:{
			KsImage,
			KsEmpty,
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
			var that = this
		　　// 设置菜单中的转发按钮触发转发事件时的转发内容
		　　var shareObj = {
		　　　　title: '科汛网校7.0的机构列表',
				path: '/pages/school/index',
		　　　　imageUrl: '',     //自定义图片路径，可以是本地文件路径、代码包文件路径或者网络图片路径，支持PNG及JPG，不传入 imageUrl 则使用默认截图。显示图片长宽比是 5:4
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
			getOrderid(id){
				this.getParameters.orderid = id
				this.loadPage()
			},
			getOrderids(id){
				this.getParameters.type = id
				this.loadPage()
			},
			openUrl(id){
				uni.navigateTo({
					url:'/pages/school/details?schoolid='+id
				})
			},
			openCourse(item){
				uni.navigateTo({
					url:'/pages/web/web?title='+item.name+'&photo='+item.photo+'&url='+encodeURIComponent(item.weburl)
				})
			},
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
				this.isshowprice = this.$store.state.isshowprice
				if(status=='more'){
					GetSchoolList(this.getParameters).then(res=>{
						this.moreStatus = 'more'
						if(res.result){
							this.schoollist = this.schoollist.concat(res.data)
							
						}
						this.loaded = true
					})
				}else{
					this.getParameters.pageindex = 1
					GetSchoolList(this.getParameters).then(res=>{
						if(res.result){
							this.pageCount = res.pageCount
							this.schoollist = res.data
							if(this.pageCount==1){
								this.moreStatus = 'noMore'
							}else{
								this.moreStatus = 'more'
							}
						}else{
							this.schoollist = []
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
	.schoollist{
		.schoollist__item{
			padding:15px 10px;
			margin: 10px;
			border-radius: 4px;
			.news-item{
				padding-left:50px;
				position: relative;
				min-height: 40px;
				.newsimg__img{
					position:absolute;
					left: 0px;
					top:0px;
					width: 40px;
					height: 40px;
					border-radius: 40px;
					overflow: hidden;
				}
				.entrance{
					float: right;
					font-size: 12px;
					color: #2987EE;
					border-radius: 12px;
					padding: 2px 8px;
					border: 1px solid #2987EE;
				}
				.news__info{
					box-sizing: border-box;
					.title{
						font-size:14px;
						color:#010E16;
						line-height: 20px;
						height: 20px;
						overflow: hidden;
						white-space: nowrap;
						text-overflow: ellipsis;
					}
					.info{
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
			.school__course-list{
				margin-top: 10px;
				display: flex;
				margin-left: -5px;
				margin-right: -5px;
				.citem{
					display: flex;
					flex-direction: column;
					justify-content: center;
					align-items: center;
					width:calc(100%/3);
					.course__item{
						width: 90%;
						height:100px;
						position: relative;
					}
					.course-list__img{
						width: 100%;
						height:100px;
					}
					.course-price{
						position:absolute;
						padding: 2px 5px;
						background:rgba(0, 0, 0, 0.5);;
						color: #fff;
						font-size: 12px;
						bottom: 0;
						left: 0;
						z-index: 9;
					}
				}
			}
		}
	}
	
	
</style>
