<template>
	<view class="content" v-if="loaded">
		<view class="school-details-top">
			<ks-image :src="baseUrl+'/static/images/school/scbg.jpg'" class="school-img"></ks-image>
			<view class="school-info clearfix">
				<ks-image :src="schoolData.logo" class="school__img"></ks-image>
				<view class="school-info__right">
					<view class="school-h3">{{schoolData.companyname}}<ks-image :src="baseUrl+'/static/images/school/rz.png'" class="rz__img" v-if="schoolData.verify!='0'"></ks-image></view>
					<view class="info-con" v-if="schoolData.vip!='-1'">
					  <view class="ScXyd" :style="'background:url('+schoolData.scoreimg+') no-repeat center left'"></view>
					  <view class="ScVip" :style="'background: url('+baseUrl+'/static/images/school/vip.png) no-repeat left center;background-size: auto 100%;'">{{schoolData.vip}}</view>
					</view>
				</view>
				
			</view>
		</view>
		<view class="filter scroll-view_H clearfix withe-bg">
			<scroll-view class="scroll-view-item_H" scroll-x="true">
				<view class="scroll-view-item_H filter-view-item" v-for="(item,i) in schoolnav" :key="i" :class="i==navIndex ? 'on':''" @click="setTabIndex(i)">{{item}}</view>
			</scroll-view>
		</view>
		<swiper class="swiper" :duration="500" :current="navIndex" @change="getIndex" :style="'height:'+height+'px'">
			<swiper-item><school-index :schoolid="getParameters.schoolid"></school-index></swiper-item>
			<swiper-item><course-list :schoolid="getParameters.schoolid" :costype="1"></course-list></swiper-item>
			<swiper-item><course-list :schoolid="getParameters.schoolid" :costype="0"></course-list></swiper-item>
			<swiper-item><course-list :schoolid="getParameters.schoolid" :costype="5"></course-list></swiper-item>
			<swiper-item><teacher-list :schoolid="getParameters.schoolid"></teacher-list></swiper-item>
			<swiper-item><class-list :schoolid="getParameters.schoolid" :selectid="getParameters.selectid"></class-list></swiper-item>
			<swiper-item><news-list :schoolid="getParameters.schoolid"></news-list></swiper-item>
		</swiper>
		<!-- <view class="join withe-bg">
			<navigator :url="'./topic?boardid='+getParameters.boardid" open-type="navigate" @click="refresh=true">
				<button type="primary" class="topic-btn">发表话题</button>
			</navigator>
		</view> -->
	</view>
</template>

<script>
	import {GetSchoolInfo} from '@/api/school'
	import KsCollect from '@/components/ks-components/collect/collect.vue'
	import UniLoadMore from '@/components/uni/uni-load-more/uni-load-more.vue'
	import SchoolIndex from '@/pages/school/home.vue'
	import ClassList from '@/pages/school/class-list.vue'
	import TeacherList from '@/pages/school/teacher-list.vue'
	import CourseList from '@/pages/school/course-list.vue'
	import NewsList from '@/pages/school/news-list.vue'
	export default {
		data(){
			return{
				loaded:false,
				schoolData:{},
				navIndex:0,
				schoolnav:['首页','网授','面授','直播','师资','班级','新闻'],
				schoollist:[],
				getParameters:{
					schoolid:0
				},
				refresh:false,
				height:0,
				baseUrl:this.$store.state.SRC+"/config/app"
			}
		},
		components:{
			KsCollect,
			UniLoadMore,
			ClassList,
			TeacherList,
			CourseList,
			NewsList,
			SchoolIndex
		},
		onLoad: function(option) {
			this.getParameters.schoolid = option.schoolid
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
		onShow(){
			if(this.refresh){
				this.refresh = false
				//执行刷新操作
				this.loadPage()
				
			}
		},
		onShareAppMessage(){
			var that = this
		　　// 设置菜单中的转发按钮触发转发事件时的转发内容
		　　var shareObj = {
		　　　　title: that.schoolData.boardname,
				path: '/pages/class-center/school/details?boardid='+that.getParameters.boardid,
		　　　　imageUrl: that.schoolData.ico||'/static/common/default-logo.png', 
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
			setTabIndex(index){
				this.navIndex = index
			},
			getIndex(e){
				this.navIndex = e.detail.current
			},
			loadPage(){
				GetSchoolInfo(this.getParameters).then(res=>{
					if(res.result){
						this.schoolData = res
					}else{
						this.schoolData={}
					}
					this.loaded = true
					uni.hideLoading();
				})
			}
		}
	}
</script>

<style lang="scss" scoped>
	.filter{
		padding-left: 10px;
		box-sizing: border-box;
		height: 50px;
		line-height: 50px;

		.filter-view-item{
			display: inline-block;
			text-align: center;
			margin: 0px 22px 0px 12px;
			font-size: 14px;
		}
		.on{
			color: #ff663d;
			border-bottom:1px solid #ff663d;
		}
	}
	.school-details-top{
		position:relative;
		height: 176px;
		.school-img{
			height: 176px;
		}
		.school-info{
			position: absolute;
			width: 100%;
			left: 0;
			bottom: 0;
			z-index: 10;
			padding: 20px 12px;
			box-sizing: border-box;
			.school__img{
				width: 70px;
				height: 70px;
				float: left;
				margin-right: 10px;
			}
			.school-info__right{
				.school-h3{
					color: #fff;
					font-size: 16px;
					.rz__img{
						width: 16px;
						height: 16px;
						display: inline-block;
						vertical-align:middle;
						margin-left: 5px;
					}
				}
				.info-con{
					margin-top:10px;
					line-height: 12px;
					padding-bottom: 3px;
					.ScXyd{
						display: inline-block;
						width: 100px;
						height: 20px;
						background-size: cover;
						vertical-align: middle;
					}
					.ScVip{
						width: 13px;
						display: inline-block;
						padding-left: 13px;
						color: #f8eb2a;
						display: inline-block;
						
						background-size: auto 100%;
						height: 13px;
						font-size: 12px;
						margin-left: 4px;
						vertical-align: middle;
					}
				}
			}
			
		}
		
	}
	.school-details-bottom{
		padding: 10px 12px 0;
		.con{
			font-size: 14px;
			line-height: 23px;
			color: #1A1A1A;
			padding-bottom: 10px;
		}
		.notice{
			padding:11px 0;
			font-size:14px;
			color:#666666;
			border-top: 1px solid #eee;
		}
	}
	.school-tab{
		border-bottom: 1px solid #F0F4F7;
		.item{
			font-size: 16px;
			padding: 14px 0;
			text-align: center;
			width: 50%;
			float: left;
		}
		.on{
			color: #ff663d;
		}
	}
	.schoollist{
		.withe-bg{
			padding: 0 15px;
		}
		.schoollist-item{
			padding:15px 0;
			border-bottom: 1px solid #eee;
			.img {
				width: 30px;
				height: 30px;
				border-radius: 30px;
				overflow: hidden;
			}
			.schoollist_info{
				margin-bottom: 10px;
				.name{
					font-size: 14px;
					color: #1A1A1A;
					line-height: 14px;
					margin-bottom: 4px;
				}
				.time{
					font-size: 12px;
					color: #888888;
				}
			}
			.intro{
				font-size:16px ;
				color: #1A1A1A;
				line-height: 24px;
			}
			.imglist{
				.imglist_item{
					width:100%;
				}
			}
			.info{
				margin-top: 15px;
				.browse{
					font-size: 12px;
					line-height: 18px;
					color: #888888;
				}
				.info__num{
					text-align: right;
					line-height: 18px;
					height: 18px;
					.zannum,.comment{
						display: inline-block;
						font-size: 14px;
						color: #666666;
						margin-left: 12px;
						padding-left: 23px;
					}
					.zannum{
						background: url(/static/class-center/topic_btn_like_n@2x.png) no-repeat center left;
						background-size: 18px;
					}
					.comment{
						background: url(/static/class-center/topic_btn_comment@2x.png) no-repeat center left;
						background-size: 18px;
					}
				}
				
			}
		}
		.schoollist-item:last-child{
			border-bottom: 0;
		}
	}
	.join{
		position: fixed;
		width: 100%;
		left: 0;
		bottom: 0;
		padding: 5px 10px;
		box-sizing:border-box;
		.join-btn{
			background: #ff663d;
			font-size: 16px;
		}
	}

	.topic-btn{
		background: #ff663d;
	}
	.reply-show{
		bottom: 0;
	}
	.scroll-view_H{
		white-space: nowrap;
		width: 100%;
	}
</style>
