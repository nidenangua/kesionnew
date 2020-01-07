<template>
	<view class="content" v-if="loaded">
		<view class="topic-top clearfix withe-bg">
			<view class="clearfix">
				<view class="ks-col-3">
					<view class="img">
						<ks-image :src="topicData.userFace" type="user" radius="30px"></ks-image>
					</view>
				</view>
				<view class="topiclist_info ks-col-21">
					<view class="name">{{topicData.userName}}</view>
					<view class="time">{{topicData.adddate}}</view>
				</view>
			</view>
			<view class="intro">
				{{topicData.content}}
				<view class="imglist" v-if="topicData.imgList.length">
					<ks-image :src="item" v-for="(item,i) in topicData.imgList" aspect="widthFix" :key="i" class="mb10 imglist_item"></ks-image>
				</view>
			</view>
			
			<view class="info clearfix">
				<view class="browse ks-col-8">
					{{topicData.hits||0}}人浏览
				</view>
				<view class="info__num ks-col-16">
					<ks-collect modelid="-16" :infoid="getParameters.topicid" :event="1" :iszan="topicData.zanstatus" @result="setResult">{{topicData.zannum||0}}</ks-collect>
					<view class="comment" :style="'background: url('+baseUrl+'/static/images/class-center/topic_btn_comment@2x.png) no-repeat center left;background-size: 18px;'">{{topicData.replyNum||0}}</view>
				</view>
			</view>	
		</view>
		<view class="topic-title clearfix withe-bg mt10">
			话题回复
		</view>
		<view class="topiclist" v-if="topiclist.length">
			<view class="withe-bg">
				<view v-for="item in topiclist" :key="item.id" class="topiclist-item clearfix">
					<view class="clearfix">
						<view class="ks-col-3">
							<view class="img">
								<ks-image :src="item.userFace" type="user" radius="30px"></ks-image>
							</view>
						</view>
						<view class="ks-col-21">
							<view class="topiclist_info">
								<view class="name">{{item.username}}</view>
								<view class="time">{{item.adddate}}</view>
							</view>
							<view class="intro">
								{{item.content}}
							</view>
						</view>
					</view>  
				</view>
			</view>
			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
		</view>
		<ks-empty type="list" v-else>暂无数据</ks-empty>
		<view class="reply-box" :style="'bottom:'+bottomHeight+'px'">
			<input class="uni-input reply-text withe-bg" :adjust-position="false"  @focus="setBottomHeight" @blur="setNoHeight" :focus="false" placeholder="我来说两句..." placeholder-style="color:#B2B2B2;font-size:14px"  v-model="content"/>
			<button type="primary" class="reply-button" @click="reply">回复</button>
		</view>
		<view class="join-bg"></view>
	</view>
</template>

<script>
	import {GetTopicView,ReplyTopic} from '@/api/class-center'
	import KsImage from '@/components/ks-components/image/Image.vue'
	import KsCollect from '@/components/ks-components/collect/collect.vue'
	import KsEmpty from '@/components/ks-components/empty/empty.vue'
	import UniLoadMore from '@/components/uni/uni-load-more/uni-load-more.vue'
	export default {
		data(){
			return{
				baseUrl:this.$store.state.SRC+"/config/app",
				loaded:false,
				topicData:{},
				topiclist:[],
				getParameters:{
					topicid:0,
					pageindex:1,
					pagesize:10,
				},
				content:'',
				pageCount:0,
				moreStatus:'more',
				isFocus:false,
				bottomHeight:0
			}
		},
		components:{
			KsImage,
			KsEmpty,
			KsCollect,
			UniLoadMore
		},
		onLoad: function(option) {
			this.getParameters.topicid = option.topicid
			uni.showLoading({
			    title: '加载中'
			});
			this.loadPage()
		},
		onReachBottom(e){
			this.getParameters.pageindex++
			this.moreList()
		},
		onShareAppMessage(){
			var that = this
		　　// 设置菜单中的转发按钮触发转发事件时的转发内容
		　　var shareObj = {
		　　　　title: that.topicData.content,
				path: '/pages/class-center/group/topicview?topicid='+that.getParameters.topicid,
		　　　　imageUrl: that.topicData.imgList[0]||this.baseUrl+'/static/images/common/default-img.png', 
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
			setBottomHeight(e){
				this.isFocus = true
				this.bottomHeight = e.detail.height 
			},
			setNoHeight(){
				this.isFocus = false
				this.bottomHeight = 0
			},
			setResult(e){
				if(e==1){
					this.loadPage()
				}
			},
			reply(){
				if(this.topicData.isTourist){
					if(this.content){
						uni.showLoading({
						    title: '正在提交中'
						});
						ReplyTopic({
							content:this.content,
							topicid:this.getParameters.topicid
						}).then(res=>{
							uni.hideLoading();
							if(res.result){
								uni.showToast({
								    title: res.msg,
								    duration: 2000,
									icon:'none'
								});
								this.loadPage()
							}else{
								uni.showToast({
								    title: res.msg,
								    duration: 2000,
									icon:'none'
								});
							}
							this.content = ''
						})
					}else{
						uni.showToast({
						    title: '请输入回复内容',
						    duration: 2000,
							icon:'none'
						});
					}
				}else{
					var that = this
					that.$store.ready(state=>{
						if(state.isLogin == 1){
							if(that.content){
								uni.showLoading({
									title: '正在提交中'
								});
								ReplyTopic({
									content:that.content,
									topicid:that.getParameters.topicid
								}).then(res=>{
									uni.hideLoading();
									if(res.result){
										uni.showToast({
										    title: res.msg,
										    duration: 2000,
											icon:'none'
										});
										that.loadPage()
									}else{
										uni.showToast({
										    title: res.msg,
										    duration: 2000,
											icon:'none'
										});
									}
									that.content = ''
								})
							}else{
								uni.showToast({
									title: '请输入回复内容',
									duration: 2000,
									icon:'none'
								});
							}
						}else{
							uni.showToast({
								title: '您未登录，请先登录',
								duration: 1500,
								icon:'none'
							});
							setTimeout(function () {
							    uni.navigateTo({
							    	url:'/pages/user/login/index'
							    })
							}, 1500);
							that.content = ''
						}
						
					})
				}
				
				
			},
			moreList(){
				if(this.getParameters.pageindex > this.pageCount){
					this.moreStatus = 'noMore'
				}else{
					this.moreStatus = 'loading'
					this.loadPage('more')
				}
			},
			loadPage(status){
				if(status=='more'){
					GetTopicView(this.getParameters).then(res=>{
						this.moreStatus = 'more'
						if(res.result){
							this.topiclist = this.topiclist.concat(res.replyList)
						}
						this.loaded = true
					})
				}else{
					this.getParameters.pageindex = 1
					GetTopicView(this.getParameters).then(res=>{
						if(res.result){
							this.topicData = res
							this.pageCount = res.pageCount
							if(this.pageCount==1){
								this.moreStatus = 'noMore'
							}else{
								this.moreStatus = 'more'
							}
							this.topiclist = res.replyList
						}else{
							this.topiclist = []
							this.pageCount = 0
						}
						this.loaded = true
						uni.hideLoading();
					})
				}
			},
		}
	}
</script>

<style lang="scss" scoped>
	.topic-top{
		padding:15px 12px;
		.img{
			width: 30px;
			height: 30px;
			border-radius: 30px;
			overflow: hidden;
		}
		.topiclist_info{
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
					// background: url(../../../static/class-center/topic_btn_like_n@2x.png) no-repeat center left;
					background-size: 18px;
				}
				.comment{
					
					background-size: 18px;
				}
			}
			
		}
	}
	.topic-title{
		padding: 15px 12px 10px;
		font-size: 16px;
		color: #1A1A1A;
		line-height: 16px;
	}
	.topiclist{
		.withe-bg{
			padding: 0 15px;
		}
		.topiclist-item{
			padding:15px 0 0;
			
			.img{
				width: 30px;
				height: 30px;
				border-radius: 30px;
				overflow: hidden;
			}
			.topiclist_info{
				margin-bottom: 12px;
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
				border-bottom: 1px solid #eee;
				padding-bottom: 10px;
			}
		}
		.topiclist-item:last-child{
			.intro{
				border-bottom: 0;
			}
		}
	}
	.reply-box{
		background: #fff;
		position: fixed;
		width: 100%;
		left: 0;
		bottom: 0px;
		padding: 5px 10px;
		height: 46px;
		box-sizing:border-box;
		-webkit-transition: .2s;
		-o-transition: .2s;
		transition: .2s;
		z-index: 101;
		.reply-button{
			display: inline-block;
			width: 20%;
			height: 36px;
			line-height: 36px;
			background:#ff663d ;
			font-size: 16px;
			vertical-align: middle;
		}
		.reply-text{
			height: 36px;
			display: inline-block;
			width: 77%;
			margin-right: 3%;
			padding: 5px 10px;
			border: 1px solid #eee;
			box-sizing: border-box;
			border-radius: 3px;
			vertical-align: middle;
			font-size: 14px;
		}
	}
	.join-bg{
		height: 56px;
	}
</style>
