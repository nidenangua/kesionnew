<template>
	<view class="content" v-if="loaded">
		<view class="teacher-info">
			<view class="box withe-bg">
				<view class="img">
					<ks-image :src="teacherData.photo" type="teacher"></ks-image>
				</view>
				<view class="name">{{teacherData.tname}}</view>
				<view class="intro">{{teacherData.tlevel}}</view>
				<view class="info">
					{{teacherData.coursetotal||0}}门课程 | {{teacherData.buyCount||0}}位学员
				</view>
				<view class="con">
					<view class="title">讲师介绍</view>
					<view class="con__intro" :class="isShowAll?'all-show':''">
						<view id="con__intro" ref="con__intro">
							<rich-text :nodes="teacherData.tintro"></rich-text>
						</view>
						
					</view>
					<view class="isshow" @click="setIsshow" v-if="overHeight">
						{{isShowAll?'收起部分↑':'展开全部↓'}}
					</view>
				</view>
			</view>
			<view class="bg"></view>
		</view>
		<view class="courselist" v-if="courselist.length">
			<view class="title">讲师课程</view>
			<view class="course__item" v-for="(item,i) in courselist" :key="i" @click="open(item)">
				<ks-image :src="item.photoUrl" class="img" radius="4px"></ks-image>
				<view class="info">
					<view class="info__con">
						<view class="course__title">{{item.name}}</view>
						<view class="flex-box__space info__data">
							<view class="flex-box">
								<uni-rate disabled="true" :value="Number(item.coursepf)" size="14" active-color="#ff663d"></uni-rate>
								<span class="score">{{item.coursepf}}分</span>
							</view>
							<view class="count">{{item.buyCount}}人学习</view>
						</view>
					</view>
					<view class="flex-box" v-if="isshowprice">
						<view  class="course__price">{{item.price_member=='0.00'?'免费':'￥'+item.price_member}}</view>
						<s class="course__marketprice">￥{{item.price}}</s>
					</view>
				</view>	
			</view>
		</view>
		<ks-empty type="list" v-else>暂无数据</ks-empty>
		<view class="bottom-box clearfix withe-bg">
			<navigator :url="'./evaluation?tcid='+teacherData.tcid+'&tname='+teacherData.tname" v-if="!teacherData.ispj&&$store.state.isLogin" open-type="navigate"
			:style="'background: url('+baseUrl+'/static/images/teacher/lesson_nav_btn_require@2x.png) no-repeat center top;background-size: 23px;'" class="item icon1 ks-col-8">
				评价
			</navigator>
			<!-- <navigator :url="'./question?tcid='+teacherData.tcid" open-type="navigate" class="item icon2" :class="teacherData.ispj||!$store.state.isLogin?'ks-col-12':' ks-col-8'">
				提问
			</navigator> -->
			<view class="item icon2" :style="'background: url('+baseUrl+'/static/images/teacher/lesson_nav_btn_shop@2x.png) no-repeat center top;background-size: 23px;'" :class="teacherData.ispj||!$store.state.isLogin?'ks-col-12':' ks-col-8'" @click="openAsk">提问</view>
			<view :class="teacherData.ispj||!$store.state.isLogin?'ks-col-12':' ks-col-8'">
				<ks-collect modelid="0" :infoid="tcid" :iscollect="iscollect"></ks-collect>
			</view>
			
		</view>
		<view class="bottom-bg"></view>
	</view>
</template>

<script>
	import {GetTeacherInfo} from '@/api/teacher'
	import KsCollect from '@/components/ks-components/collect/collect.vue'
	import UniRate from '@/components/uni/uni-rate/uni-rate.vue'
	export default {
		data(){
			return{
				baseUrl:this.$store.state.SRC+"/config/app",
				loaded:false,
				isShowAll:false,
				isCollect:false,
				teacherData:{},
				courselist:[],
				tcid:0,
				overHeight:false,
				iscollect:false,
				isshowprice:false
			}
		},
		components:{
			KsCollect,
			UniRate
		},
		onShow(){
			uni.showLoading({
			    title: '加载中'
			});
			this.loadPage()
		},
		onLoad: function(option) {
			this.tcid = option.tcid
			// uni.showLoading({
			//     title: '加载中'
			// });
			// this.loadPage()
		},
		onShareAppMessage(){
			var that = this
		　　// 设置菜单中的转发按钮触发转发事件时的转发内容
		　　var shareObj = {
		　　　　title: that.teacherData.tname,
				path: '/pages/teacher/details?tcid='+that.tcid,
		　　　　imageUrl: that.teacherData.photo||'/static/common/default-img.png', 
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
			setIsshow(){
				this.isShowAll = this.isShowAll?false:true
			},
			setCollect(){
				this.isCollect = this.isCollect?false:true
			},
			openAsk(){
				if(!this.$store.state.isLogin){
					uni.showToast({
					    title: '您未登录，请先登录',
					    duration: 1500,
						icon:'none'
					});
					setTimeout(function(){
						uni.navigateTo({
							url:'/pages/user/login/index'
						})
					},1500)
				}else{
					uni.navigateTo({
						url:'/pages/teacher/question?tcid='+this.teacherData.tcid
					})
				}
			},
			open(item){
				if(this.isshowprice){
					var url = '/course/'+item.courseId
					url = encodeURIComponent(url)
					uni.navigateTo({
						url:'/pages/web/web?title='+item.name+'&photo='+item.photoUrl+'&url='+url
					})
				}
				
			},
			countHeight(){
				const query = uni.createSelectorQuery().in(this);
				query.select('#con__intro').boundingClientRect(data => {  
				  if(data.height>63){
					  this.overHeight = true
				  }else{
					  this.overHeight = false
				  }
				}).exec();
			},
			loadPage(){
				this.isshowprice = this.$store.state.isshowprice
				GetTeacherInfo({
					tcid:this.tcid
				}).then(res=>{
					if(res.result){
						if(res.data.tintro){
							res.data.tintro = res.data.tintro.replace(/src="\//gi,'src="'+this.$store.state.SRC+'/')
						}
						this.teacherData = res.data
						this.iscollect = res.data.iscollect
						this.courselist = res.courseList
					}else{
						this.courselist = []
					}
					this.loaded = true
					this.$nextTick(function(){
						this.countHeight()
					})
					var that = this
					setInterval(function(){
						that.countHeight()
						
					},500)
					uni.hideLoading();
				})
			},
			
		}
	}
</script>

<style lang="scss" scoped>

	.teacher-info{
		position: relative;
		padding-top: 5px;
		.box{
			position: relative;
			z-index: 1;
			margin:0 18px;
			border-radius: 5px;
			padding: 20px 11px 15px;
			.img{
				width: 240px;
				height: 180px;
				margin: auto;
			}
			.name{
				text-align: center;
				font-size: 16px;
				margin: 15px 0 12px;
				line-height: 16px;
				color: #1A1A1A;
			}
			.intro{
				text-align: center;
				line-height: 18px;
				font-size: 12px;
				color: #666;
			}
			.info{
				margin: 9px 0 13px;
				font-size: 14px;
				line-height: 18px;
				color: #010C17;
				text-align: center;
			}
			.con{
				border-top: 1px solid #eee;
				padding-top: 10px;
				.title{
					font-size: 14px;
					line-height: 18px;
					color: #010C17;
					margin-bottom: 6px;
				}
				.con__intro{
					font-size: 14px;
					line-height: 21px;
					color: #666;
					max-height: 63px;
					overflow: hidden;
				}
				.all-show{
					max-height:inherit;
				}
				.isshow{
					line-height:18px;
					font-size: 12px;
					color: #ff663d;
					margin-top: 5px;
					text-align: right;
				}
			}
		}
		.bg{
			content: '';
			height: 135px;
			position: absolute;
			width: 100%;
			background: #ff663d;
			top: 0;
			left: 0;
		}
	}
	
	.courselist{
		padding:20px 10px;
		.title{
			font-size: 16px;
			color: #010C17;
			margin-bottom: 15px;
		}
		.course__item{
			position: relative;
			padding-left: 161px;
			margin-bottom: 20px;
			.img{
				width: 150px;
				height: 100px;
				position: absolute;
				left: 0;
				top: 0;
			}
			.info{
				display: flex;
				flex-direction: column;
				justify-content: space-between;
				height: 100px;
				
				.info__con{
					height: 70px;
					.course__title{
						font-size: 16px;
						color: #1A1A1A;
						line-height: 24px;
						max-height: 48px;
						overflow: hidden;
					}
					.info__data{
						font-size: 12px;
						margin-top: 6px;
						.flex-box{
							height:16px;
							.score{
								color:#ff663d;
								margin-left:10px;
							}
						}
					}
				}
				.flex-box{
					.course__price{
						color: #FF663D;
						font-size: 16px;
					}
					.course__marketprice{
						color:#888888;
						margin-left:5px;
						font-size: 12px;
						text-decoration: line-through;
					}
				}
			}
		}
	}
	.bottom-box{
		position: fixed;
		left: 0;
		bottom: 0;
		width: 100%;
		height: 50px;
		text-align: center;
		font-size: 12px;
		padding-top: 7px;
		box-sizing: border-box;
		.item{
			padding-top: 23px;
		}
		.icon1{
			
			background-size: 23px;
		}
		.icon2{
			
			background-size: 23px;
		}
		.icon3{
			// background: url(../../static/teacher/lesson_nav_btn_collect@2x.png) no-repeat center top;
			background-size: 23px;
		}
		.collected{
			// background: url(../../static/class-center/collected.png) no-repeat center top;
			background-size: 23px;
		}
	}
	.bottom-bg{
		height: 60px;
	}
</style>
