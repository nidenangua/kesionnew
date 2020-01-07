<template>
	<view class="content" v-if="loaded">
		<view class="group-details-top">
			<ks-image :src="groupData.ico" class="group-img"></ks-image>
			<view class="group-info">
				<view class="group-h3">{{groupData.boardname}}</view>
				<view class="info-con">
				  <view class="num">{{groupData.studentnum||0}}人加入</view>
				  <view class="dot"></view>
				  <view class="num">{{groupData.topicnum||0}}个帖子</view>
				  <view class="dot"></view>
				  <view class="num">{{groupData.hits||0}}人浏览</view>
				</view>
			</view>
		</view>
		<view class="group-details-bottom withe-bg">
			<view class="con" v-if="groupData.intro">
				{{groupData.intro}}
			</view>
			<view class="notice">
				公告：{{groupData.boardrules}}
			</view>
		</view>
		<view class="group-tab clearfix withe-bg mt10">
			<view class="item" :class="getParameters.type=='0'?'on':''" @click="setTabIndex('0')">全部话题</view>
			<view class="item" :class="getParameters.type=='1'?'on':''" @click="setTabIndex('1')">热门话题</view>
		</view>
		<!-- <view v-if="groupData.is_allowscan ==0 && !groupData.isJoin" style="font-size: 14px;color:#333;line-height: 20px;margin: 10px;">
			加入小组后可浏览内容
		</view> -->
		<ks-empty type="list" v-if="groupData.is_allowscan ==0 && !groupData.isJoin">加入小组后可浏览内容</ks-empty>
		<view v-else>
			<view class="grouplist" v-if="grouplist.length">
				<view class="withe-bg">
					<view v-for="item in grouplist" :key="item.id" class="grouplist-item clearfix" @click="open('./topicview?topicid='+item.topicId)">
						<view class="clearfix">
							<view class="ks-col-3">
								<view class="img">
									<ks-image :src="item.userFace" type="user" radius="30px"></ks-image>
								</view>
							</view>
							<view class="grouplist_info ks-col-21">
								<view class="name">{{item.usserName}}</view>
								<view class="time">{{item.adddate}}</view>
							</view>
						</view>
						<view class="intro">
							{{item.content}}
						</view>
						<view class="imglist" v-if="item.imgList.length" v-on:click.stop="open">
							<!-- <ks-image :src="item.imgList[0]" aspect="widthFix" class="mb10 imglist_item"></ks-image> -->
							<view v-for="(citem,c) in item.imgList" :key="c" class="imglist_item">
								<ks-image :src="citem" @click="previewImage(item.imgList,citem,c)" class="mb10 img"></ks-image>
								
							</view>
						</view>
						<view class="info clearfix">
							<view class="browse ks-col-8">
								{{item.hits}}人浏览
							</view>
							<view class="info__num ks-col-16" v-on:click.stop="open">
								<ks-collect modelid="-16" :infoid="item.topicId" :event="1" :iszan="item.zanstatus" @result="setResult">{{item.digg||0}}</ks-collect>
								<view class="comment" @click="replyTopic(Number(item.topicId))" :style="'background: url('+baseUrl+'/static/images/class-center/topic_btn_comment@2x.png) no-repeat center left;background-size: 18px;'">{{item.postNum||0}}</view>
							</view>
						</view>		  
					</view>
				</view>
				<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
			</view>
			<ks-empty type="list" v-else>暂无数据</ks-empty>
		</view>
		
		<view class="join withe-bg" v-if="!showReply">
			<view v-if="!groupData.isJoin">
				<button type="primary" @click="joinGroup" class="join-btn" v-if="groupData.jointype==0">
					申请加入
				</button>
				<button type="primary" @click="submit" class="join-btn" v-else-if="groupData.jointype==1">
					免费加入
				</button>
				<button type="primary" @click="submit(1,groupData)" class="join-btn" v-else>
					
					立即加入（￥{{groupData.price}},会员价:{{groupData.vip_ischarge==0?'免费':'￥'+groupData.vip_price}}）
				</button>
			</view>
				<button type="primary" class="topic-btn" @click="openTopic('./topic?boardid='+getParameters.boardid)" v-else>发表话题</button>
		</view>
		<view class="reply-box" :style="'bottom:'+bottomHeight+'px'">
			<input class="uni-input reply-text withe-bg" :adjust-position="false" :focus="false" @focus="setBottomHeight" @blur="setNoHeight" placeholder="我来说两句..." placeholder-style="color:#B2B2B2;font-size:14px" v-model="content"/>
			<button type="primary" class="reply-button" @click="reply">回复</button>
		</view>
		<view class="reply-shadow" :class="showReply?'show-bg':''" @click="closeReply('reply')" @touchmove.stop.prevent></view>
		<view class="join-bg"></view>
		<view class="reply-question withe-bg" :style="'bottom:'+bottomHeight2+'px'" @touchmove.stop.prevent>
			<view class="reply-top clearfix">
				<view class="cancel" @click="cancel">取消</view>
				<view class="submit" @click="submit">提交</view>
			</view>
			<view class="textarea f14">
				<textarea placeholder-style="color:#B2B2B2" :adjust-position="false" :focus="false" fixed="true" @focus="setBottomHeight2" @blur="setNoHeight2" class="reply-textarea" placeholder="请输入的申请理由~" v-model="remark" maxlength="255"/>
			</view>
		</view>
		<view class="reply-shadow" :class="isJoin?'show-bg':''" @click="closeReply" @touchmove.stop.prevent></view>
	</view>
</template>

<script>
	import {GetGroupListView,JoinGroup,ReplyTopic} from '@/api/class-center'
	import KsImage from '@/components/ks-components/image/Image.vue'
	import KsCollect from '@/components/ks-components/collect/collect.vue'
	import KsEmpty from '@/components/ks-components/empty/empty.vue'
	import UniLoadMore from '@/components/uni/uni-load-more/uni-load-more.vue'
	export default {
		data(){
			return{
				baseUrl:this.$store.state.SRC+"/config/app",
				loaded:false,
				groupData:{},
				isJoin:false,
				// isFocus:false,
				showReply:false,
				grouplist:[],
				getParameters:{
					boardid:0,
					type:'0',
					pageindex:1,
					pagesize:10,
				},
				topicid:0,
				remark:'',
				content:'',
				pageCount:0,
				moreStatus:'more',
				isFocus:false,
				bottomHeight:-46,
				isFocus2:false,
				bottomHeight2:-243,
				refresh:false
			}
		},
		components:{
			KsImage,
			KsCollect,
			KsEmpty,
			UniLoadMore
		},
		onLoad: function(option) {
			this.getParameters.boardid = option.boardid
			uni.showLoading({
			    title: '加载中'
			});
			this.loadPage()
		},
		onShow(){
			if(this.refresh){
				this.refresh = false
				//执行刷新操作
				this.loadPage()
				
			}
		},
		onReachBottom(e){
			this.getParameters.pageindex++
			this.moreList()
		},
		onShareAppMessage(){
			var that = this
		　　// 设置菜单中的转发按钮触发转发事件时的转发内容
		　　var shareObj = {
		　　　　title: that.groupData.boardname,
				path: '/pages/class-center/group/details?boardid='+that.getParameters.boardid,
		　　　　imageUrl: that.groupData.ico||this.baseUrl+'/static/images/common/default-logo.png', 
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
			previewImage(imgArr,src,index){
				if(src){
					// 预览图片
					uni.previewImage({
						urls: imgArr,
						current:index,
						longPressActions: {
							itemList: ['发送给朋友', '保存图片', '收藏'],
							itemColor:'#fff',
							success: function(data) {
							},
							fail: function(err) {
								console.log(err.errMsg);
							}
						},
						success:function(data){
							
						},
						fail: function(err) {
							uni.showToast({
								title: 'err.errMsg',
								icon:'none'
							});
						}
					});
				}else{
					uni.showToast({
						title: '没有找到图片',
						icon:'none'
					});
				}
				
			},
			open(url){
				uni.navigateTo({
					url:url
				})
			},
			openTopic(url){
				this.refresh=true
				if(this.groupData.Status == 1){
					
				}else{
					
				}
				if(this.groupData.Status == 0){
					uni.showToast({
						title: '你的申请正在审核',
						icon:'none'
					})
				}else if(this.groupData.Status == 2){
					uni.showToast({
						title: '你的申请已被拒绝',
						icon:'none'
					})
				}else if(this.groupData.istrue == 1){
					uni.navigateTo({
						url:url
					})
				}else if(this.groupData.Status == 1)(
					uni.navigateTo({
						url:url
					})
				)
					
				
				
			},
			setBottomHeight(e){
				this.isFocus = true
				if(this.showReply){
					this.bottomHeight = e.detail.height 
				}
			},
			setBottomHeight2(e){
				this.isFocus2 = true
				if(this.isJoin){
					this.bottomHeight2 = e.detail.height 
				}
			},
			setNoHeight(){
				this.isFocus = false
				if(this.showReply){
					this.bottomHeight = 0
				}else{
					this.bottomHeight = -46
				}
				
			},
			setNoHeight2(){
				this.isFocus2 = false
				if(this.isJoin){
					this.bottomHeight2 = 0
				}else{
					this.bottomHeight2 = -243
				}
				
			},
			closeReply(type){
				if(type=="reply"){
					this.showReply=false
					this.isFocus=false
					this.bottomHeight = -46
					this.content = ''
				}else{
					this.isJoin=false
					this.isFocus2=false
					this.bottomHeight2 = -243
					this.remark = ''
				}
				
			},
			setResult(e){
				if(e==1){
					this.loadPage()
				}
			},
			replyTopic(id){
				this.cancel()
				this.showReply = true
				this.bottomHeight = 0
				this.topicid = id
				
			},
			reply(){
				if(this.groupData.isTourist){
					if(this.content){
						uni.showLoading({
							title: '正在提交中'
						});
						ReplyTopic({
							content:this.content,
							topicid:this.topicid
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
							this.topicid = 0
							this.showReply = false
							this.isFocus = false
							this.bottomHeight = -46
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
							console.log(state.isLogin)
							if(that.content){
								uni.showLoading({
									title: '正在提交中'
								});
								ReplyTopic({
									content:that.content,
									topicid:that.topicid
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
									that.topicid = 0
									that.showReply = false
									that.isFocus = false
									that.bottomHeight = -46
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
							that.topicid = 0
							that.showReply = false
							that.isFocus = false
							that.bottomHeight = -46
						}
						
					})
				}
				
			},
			setTabIndex(index){
				this.getParameters.type = index
				
				this.loadPage()
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
					GetGroupListView(this.getParameters).then(res=>{
						this.moreStatus = 'more'
						if(res.result){
							this.grouplist = this.grouplist.concat(res.data)
						}
						this.loaded = true
					})
				}else{
					
					this.getParameters.pageindex = 1
					GetGroupListView(this.getParameters).then(res=>{
						if(res.result){
							this.groupData = res
							this.pageCount = res.pageCount
							if(this.pageCount==1){
								this.moreStatus = 'noMore'
							}else{
								this.moreStatus = 'more'
							}
							this.grouplist = res.data
						}else{
							this.grouplist = []
							this.pageCount = 0
						}
						this.loaded = true
						uni.hideLoading();
					})
				}
			},
			cancel(){
				this.isJoin=false
				this.isFocus2 = false
				this.bottomHeight2 = -243
				this.remark = ''
			},
			joinGroup(){
				this.isJoin = true
				this.bottomHeight2 = 0
				// this.isFocus = true
			},
			submit(type,item){
				this.$store.ready(state=>{
					if(state.isLogin == 1){
						if(type==1){
							if(item.isVip == 1 && item.vip_ischarge==0){
								this.submitFree()
							}else{
								this.submitNoFree()
							}
						}else{
							this.submitFree()
						}
						
					}else{
						this.refresh = true
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
						this.remark = ''
						this.isJoin = false
						this.isFocus2 = false
						this.bottomHeight2 = -243
					}
				})
				
			},
			submitFree(){
				uni.showLoading({
				    title: '正在提交中'
				});
				JoinGroup({
					boardid:this.getParameters.boardid,
					remark:this.remark
				}).then(res=>{
					uni.hideLoading();
					if(res.result){
						this.$store.dispatch('getUserInfo').then(_=>{
							uni.showToast({
							    title: res.msg,
							    duration: 2000,
								icon:'none'
							});
							this.loadPage()
						})
						
					}else{
						uni.showToast({
						    title: res.msg,
						    duration: 2000,
							icon:'none'
						});
					}
					this.remark = ''
					this.isJoin = false
					this.isFocus2 = false
					this.bottomHeight2 = -243
				})
			},
			submitNoFree(){
				var that = this
				uni.showModal({
				    title: '提示',
				    content: '您是否确定支付，确认支付后将对您的余额进行扣款？',
				    success: function (res) {
				        if (res.confirm) {
							uni.showLoading({
							    title: '正在提交中'
							});
							JoinGroup({
								boardid:that.getParameters.boardid,
								remark:that.remark
							}).then(res=>{
								uni.hideLoading();
								if(res.result){
									that.$store.dispatch('getUserInfo').then(_=>{
										uni.showToast({
										    title: res.msg,
										    duration: 2000,
											icon:'none'
										});
										setTimeout(function () {
										    that.loadPage()
										}, 2000);
										
									})
									
								}else{
									uni.showToast({
									    title: res.msg,
									    duration: 2000,
										icon:'none'
									});
								}
								that.remark = ''
								that.isJoin = false
								that.isFocus2 = false
								that.bottomHeight2 = -243
							})
				            
				        } else if (res.cancel) {
				            
				        }
				    }
				});
			}
		}
	}
</script>

<style lang="scss" scoped>
	.mb10{
		margin-bottom: 10px;
	}
	.group-details-top{
		position:relative;
		height: 160px;
		.group-img{
			height: 160px;
		}
		.group-info{
			position: absolute;
			width: 100%;
			left: 0;
			bottom: 0;
			z-index: 10;
			padding: 12px;
			box-sizing: border-box;
			.group-h3{
				color: #fff;
				font-size: 16px;
			}
			.info-con{
				margin-top:10px;
				line-height: 12px;
				padding-bottom: 3px;
				.num{
					display: inline-block;
					color:#FFFFFF;
					font-size: 12px;
				}
				.dot{
					display: inline-block;
					vertical-align: middle;
					width: 2px;
					height: 2px;
					border-radius: 2px;
					background: #fff;
					margin: 0 4px;
				}
			}
		}
		
	}
	.group-details-bottom{
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
	.group-tab{
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
	.group-details-top:after{
		content: '';
		position: absolute;
		left: 0;
		top:0;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.4);
		z-index: 1;
	}
	.grouplist{
		.withe-bg{
			padding: 0 15px;
		}
		.grouplist-item{
			padding:15px 0;
			border-bottom: 1px solid #eee;
			.img {
				width: 30px;
				height: 30px;
				border-radius: 30px;
				overflow: hidden;
			}
			.grouplist_info{
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
				margin-top: 10px;
				.imglist_item{
					width:80px;
					height: 80px;
					border:1px solid #eee;
					padding: 5px;
					margin-right: 10px;
					.img{
						width: 70px;
						height: 70px;
					}
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
						// background: url(../../../static/class-center/topic_btn_like_n@2x.png) no-repeat center left;
						background-size: 18px;
					}
					.comment{
						
						background-size: 18px;
					}
				}
				
			}
		}
		.grouplist-item:last-child{
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
	.reply-box{
		background: #F7F7F7;
		position: fixed;
		width: 100%;
		left: 0;
		bottom: -46px;
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
			background: #ff663d;
			font-size: 14px;
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
	.show-reply{
		bottom: 0;
	}
	.reply-shadow{
		position: fixed;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.5);
		left: 0;
		top: 0;
		z-index: 100;
		display: none;
	}
	.show-bg{
		display: block;
	}
	.join-bg{
		height: 56px;
	}
	.reply-question{
		position: fixed;
		width: 100%;
		bottom: -243px;
		z-index: 102;
		border-top: 1px solid #eee;
		padding-bottom: 10px;
		-webkit-transition: .2s;
		-o-transition: .2s;
		transition: .2s;
		.reply-top{
			padding: 15px;
			.cancel{
				float: left;
				font-size: 16px;
			}
			.submit{
				float: right;
				font-size: 16px;
				color: #ff663d;
			}
		}
		
		.textarea{
			font-size: 14px;
			line-height: 1.8;
			padding: 10px;
			margin: 0 10px;
			box-sizing:border-box;
			border: 1px solid #eee;
			border-radius: 2px;
			height: 180px;
			overflow: hidden;
			.reply-textarea{
				width: 100%;
				height: 100%;
			}
			
		}
	}
	.topic-btn{
		background: #ff663d;
	}
	.reply-show{
		bottom: 0;
	}
</style>
