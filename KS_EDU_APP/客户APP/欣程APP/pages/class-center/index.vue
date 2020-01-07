<template>
	<view class="content" v-if="loaded">
		
		<!-- 头部切换 -->
		<view class="withe-bg class-top">
			<view class="class-top__tab">
				<view class="layout">
					<view v-for="(item,index) in tabBars" :key="index" class="layout__col" :class="index==tabIndex ? 'on':''" @click="setIndex(index,item.type)">
						{{item.title}}
					</view>
				</view>
			</view>
			
			<view class="class-top__search">
				<uni-icons type="search" size="26" color="#333" class="search__icon" @click="open" />
			</view>
		</view>
	
		<!-- 头部切换 -->
		
		<!-- 问答的筛选 -->
		<ks-filter v-if="currentNav=='ask'" :classList="classList" :sortList="sortList" @getOrderid="getOrderid" @getClassid="getClassid"></ks-filter>
		<!-- 问答的筛选 -->
		
		<!-- 作品的分类列表筛选 -->
		<view class="filter scroll-view_H clearfix" v-if="currentNav=='works'">
			<scroll-view class="scroll-view-item_H" scroll-x="true">
				<view class="scroll-view-item_H filter-view-item" :class="getParameters.workclassid==0 ? 'on':''" @click="setClassIndex(0)">全部</view>
				<view class="scroll-view-item_H filter-view-item" v-for="item in classList2" :key="item.classID" :class="item.classID==getParameters.workclassid ? 'on':''" @click="setClassIndex(item.classID)">{{item.className}}</view>
			</scroll-view>
		</view>
		<!-- 作品的分类列表筛选 -->
		
		<!-- 资讯的筛选 -->
		<ks-filter v-if="currentNav=='information'" :classList="classList3" :sortList="sortList3" @getOrderid="getOrderid" @getClassid="getClassid"></ks-filter>
		<!-- 资讯的筛选 -->
		
		<view :class="currentNav=='group'?'heightbg':'height-auto-bg'"></view>
		
		<swiper class="swiper" :duration="500" :current="tabIndex" @change="getIndex" :style="currentNav=='group'?'height:'+height+'px':'height:'+height2+'px'">
			<swiper-item v-if="tabBarString.indexOf('group')>-1"><group-list></group-list></swiper-item>
			<swiper-item v-if="tabBarString.indexOf('ask')>-1"><ask-list :askclassid="getParameters.askclassid" :selectid="getParameters.selectid" ref="askList"></ask-list></swiper-item>
			<swiper-item v-if="tabBarString.indexOf('works')>-1"><photo-list :workclassid="getParameters.workclassid"></photo-list></swiper-item>
			<swiper-item v-if="tabBarString.indexOf('information')>-1"><news-list :infoclassid="getParameters.infoclassid" :orderid="getParameters.orderid"></news-list></swiper-item>
		</swiper>
		<!-- 问答的发表提问入口 -->
		<view class="fab" v-if="currentNav=='ask'">
			<view class="fab-button" :style="'background: url('+baseUrl+'/static/images/common/asksubmit.png) center #007AFF;background-size: 100% 100%;'" @click="askShow"></view>
			<view class="fab-box" :class="isShow?'curr':''" @click="askSubmit">我要发表提问</view>
		</view>
		<!-- 问答的发表提问入口 -->
	</view>
</template>

<script>
	import {GetDataList} from '@/api/class-center'
	import KsFilter from '@/components/ks-components/filter/filter.vue'
	import UniLoadMore from '@/components/uni/uni-load-more/uni-load-more.vue'
	import UniIcons from '@/components/uni/uni-icons/uni-icons.vue'
	import GroupList from '@/pages/class-center/group/index.vue'
	import AskList from '@/pages/class-center/ask/index.vue'
	import PhotoList from '@/pages/class-center/photo/index.vue'
	import NewsList from '@/pages/class-center/news/index.vue'
	export default {
		data(){
			return{
				baseUrl:this.$store.state.SRC+"/config/app",
				loaded:false,
				tabIndex:0,//0小组，1问答，2作品，3资讯
				tabBars: ['小组','问答','作品','资讯'],
				currentNav:'',
				tabBarString:'',
				askList:[],//问答列表
				classList: [],//问答分类列表
				classList2: [],//作品分类列表
				classList3: [],//资讯分类列表
				sortList:[],//筛选列表
				sortList3:[],//资讯筛选列表
				isShow:false,//问答发表提问按钮的显示
				grouplist:[],//小组列表
				photoList:[],//作品列表
				newsList:[],//新闻列表
				getParameters:{
					askclassid:0,//问答的分类id
					selectid:0,//问答的筛选类型id
					workclassid:0,//作品的分类id
					infoclassid:0,//资讯的分类id
					orderid:0//资讯的筛选类型id
				},
				pageCount:0,
				height:0,
				height2:0,
				refresh:false,
				state:{}
			}
		},
		components:{
			KsFilter,
			UniLoadMore,
			UniIcons,
			GroupList,
			AskList,
			PhotoList,
			NewsList
		},
		onLoad() {
			this.$store.ready(state=>{
				this.state = state
				uni.showLoading({
				    title: '加载中'
				});
				uni.getSystemInfo({
					success:res=>{
						
						this.height = res.windowHeight-44
						this.height2 = res.windowHeight-88
					}
				})
				this.loadPage()
			})
			
		},
		onShow(){
			
			if(this.refresh){
				this.refresh = false
				//执行刷新操作
				if(this.currentNav=='ask'){
					this.isShow = false
					this.$refs.askList.loadPage()
				}
				
			}
		},
		onShareAppMessage(){
			var that = this,
			title = ''
			if(this.currentNav=='ask'){
				title = '科汛网校7.0问答分享'
			}else if(this.currentNav=='works'){
				title = '科汛网校7.0的作品分享'
			}else if(this.currentNav=='information'){
				title = '科汛网校7.0的资讯分享'
			}else{
				title = '科汛网校7.0的小组分享'
			}
		　　// 设置菜单中的转发按钮触发转发事件时的转发内容
		　　var shareObj = {
		　　　　title: title,
				path: '/pages/class-center/index',
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
			open(){
				uni.navigateTo({
				    url: '../course/search'
				});
			},
			openUrl(url){
				uni.navigateTo({
				    url:url
				});
			},
			setIndex(index,type){
				this.tabIndex = index
				this.currentNav = type
			},
			// 问答和资讯的筛选
			getOrderid(selectid){
				if(this.currentNav=='ask'){
					this.getParameters.selectid = selectid
				}else if(this.currentNav=='information'){
					this.getParameters.orderid = selectid
				}
				
			},
			//问答和资讯的分类筛选
			getClassid(askclassid){
				if(this.currentNav=='ask'){
					this.getParameters.askclassid = askclassid
				}else if(this.currentNav=='information'){
					this.getParameters.infoclassid = askclassid
				}
			},
			getIndex(e){
				this.tabIndex = e.detail.current
				this.currentNav = this.tabBars[e.detail.current].type
			},
			//作品的分类筛选
			setClassIndex(classid){
				this.getParameters.workclassid = classid
			},
			//设置问答的发表问题的按钮是否显示
			askShow(){
				this.isShow==true ? this.isShow = false:this.isShow = true
			},
			//进入发表问题的界面
			askSubmit(){
				this.refresh = true
				uni.navigateTo({
				    url: '/pages/class-center/ask/question'
				});
			},
			loadPage(){
				GetDataList({
					a:'getplaytime',
					playtime:'ask'
				}).then(res=>{
					if(res.result){
						console.log(!this.state.isshowprice)
						if(!this.state.isshowprice){
							let newNav = []
							res.playtime.map(item=>{
								if(item.type!='group'){
									newNav.push(item)
								}
							})
							this.tabBars = newNav
							this.currentNav = newNav[0].type
						}else{
							this.tabBars = res.playtime
							this.currentNav = res.playtime[0].type
						}
						console.log(JSON.stringify(this.tabBars))
						let newArr = []
						if(res.playtime.length){
							res.playtime.map(item=>{
								newArr.push(item.type)
							})
						}
						this.tabBarString = newArr.toString()
						let refactoringClass = [{childList: [], classID: "0", className: "全部"}]
						res.askmodel.classList.map(item=>{
							refactoringClass.push(item)
						})
						this.classList = refactoringClass
						this.sortList = res.askmodel.selectList
					}else{
						this.classList = []
						this.sortList = []
					}
					this.isShow = false
					this.loaded = true
					uni.hideLoading();
				})
				GetDataList({
					a:'getplaytime',
					playtime:'works'
				}).then(res=>{
					if(res.result){
						this.classList2 = res.worksmodel.classlist
					}else{
						this.classList2 = []
					}
					this.loaded = true
					uni.hideLoading();
				})
				GetDataList({
					a:'getplaytime',
					playtime:'information'
				}).then(res=>{
					if(res.result){
						let refactoringClass = [{childList:[],classID: "0", className: "全部"}]
						res.informationmodel.classlist.map(item=>{
							refactoringClass.push(item)
						})
						this.classList3 = refactoringClass
						this.sortList3 = res.informationmodel.orderList
					}else{
						this.classList3 = []
						this.sortList3 = []
					}
					this.loaded = true
					uni.hideLoading();
				})
			}
		}
	}
</script>

<style lang="scss" scoped>
	.heightbg{
		height:44px ;
	}
	.height-auto-bg{
		height:88px ;
	}
	.class-top{
		position: fixed;
		width: 100%;
		display: flex;
		top: 0px;
		z-index: 11;
		.class-top__tab{
			flex-flow: row;
			width: 80%;
			.layout{
				display: flex;
				.layout__col{
					flex-flow: row;
					line-height: 44px;
					height: 44px;
					width: 25%;
					text-align: center;
					font-size:15px ;
					position: relative;
					color: #666666;
					
					
				}
				.layout__col:after{
					position:absolute;
					content: '';
					width: 40%;
					height: 2px;
					background: #007AFF;
					display: none;
					bottom: 0;
					left: 50%;
					margin-left: -20%;
					border-radius: 2px;
				}
				.on{
					color: #000;
					font-size: 17px;
				}
				.on:after{
					display: block;
				}
			}
			
		}
		.class-top__search{
			flex-flow: row;
			width: 20%;
			text-align: center;
			.search__icon{
				display: inline-block;
				color: #000;
				margin-top: 10px;
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
</style>
