<template>
	<view class="content" v-if="loaded">
		<view class="ask-details withe-bg">
			<view class="top-info clearfix">
				<view class="info-left ks-col-12">
					<ks-image :src="askData.userFace" type="user" class="image-img" radius="30px"></ks-image>
					<view class="info f12 clearfix">
						<view class="source">{{askData.userName}}</view>
						<view class="addtime">{{askData.adddate}}</view>
					</view>
				</view>
				<view class="info-right f12 ks-col-12">
					<view class="integral" :style="'background: url('+baseUrl+'/static/images/class-center/ask_icon_score.png) no-repeat center left;background-size: 14px;'">{{askData.reward||0}}分</view>
					<!-- <view class="integral" v-if="isMyself">{{rewardArry[rewardIndex]}}分</view>
					<view class="integral" v-else>{{askData.reward||0}}分</view> -->
					<view class="status" v-if="askData.issolve!='0'" :class="askData.issolve=='1'?'green-font':'gray-font'">{{askData.issolve=='1'?'已解决':'关闭'}}</view>
					<view class="status gray-font" v-else>未解决</view>
				</view>
			</view>
			<view class="title">{{askData.title}}</view>
			<view class="ask-content withe-bg" :class="conIsShow?'height-auto':''">
				<view v-html="askData.content" id="ask-con-show"></view>
			</view>
			
			<view class="ask-con-show f12" v-if="overHeight">
				<view class="icon" @click="setShow()">{{conIsShow?'收起部分↑':'展开全部↓'}}</view>
			</view>
		</view>
		<view class="ask-list" v-if="askData.replyList&&askData.replyList.length">
			<view class="title withe-bg">
				<view class="inner">
					{{askData.recordCount}}个答案
				</view>
			</view>
			<view class="item withe-bg" v-for="(item,i) in askData.replyList" :key="item.postid" :style="i==0?'margin-top:0':''">
				<view class="is-bast-answer" v-if="item.isbest=='1'">
					<view class="item__top clearfix">
						<view class="info-left ks-col-16">
							<ks-image :src="item.userFace" type="user" class="image-img" radius="30px"></ks-image>
							<view class="info f12 clearfix">
								<view class="source">{{item.username}}</view>
								<view class="addtime">{{item.adddate}}</view>
							</view>
						</view>
						<view class="info-right ks-col-8">
							<view class="answer-status f12" :style="'background: url('+baseUrl+'/static/images/class-center/ask_bg_best.png) no-repeat center left;background-size: 20px;'">最佳答案</view>
						</view>
					</view>
					<view class="item__bottom" :id="'bottom'+i" :class="item.isShow?'height-auto':''">
						<view class="item__content" v-html="item.content" :id="'reply'+i"></view>
						<view class="item__expand withe-bg" @click="setShow('reply',i)" v-if="item.overHeight">{{item.isShow?'收起部分内容↑':'展开阅读全文↓'}}</view>
					</view>
				</view>
				<view class="is-no-bast" v-else>
					<view class="item__top clearfix">
						<view class="info-left ks-col-16">
							<ks-image :src="item.userFace" type="user" class="image-img" radius="30px"></ks-image>
							<view class="info f12 clearfix">
								<view class="source">{{item.username}}</view>
								<view class="addtime">{{item.adddate}}</view>
							</view>
						</view>
						<view class="delete-icon" :style="'background: url('+baseUrl+'/static/images/class-center/topic_btn_delete2.png) no-repeat center;background-size: 20px;'" v-if="isMyself&&askData.issolve!='2'&&!isHaveBest" @click="deleteReply(item.topicid,item.postid)"></view>
					</view>
					<view class="item__bottom" :id="'bottom'+i" :class="item.isShow?'height-auto':''">
						<view class="item__content" v-html="item.content" :id="'reply'+i"></view>
						<view v-if="isMyself&&!isHaveBest&&askData.issolve!='2'">
							<button type="primary" plain="true" class="add-ask" @click="setBestAsk(item.topicid,item.postid)">采纳为最佳</button>
						</view>
						<view class="item__expand withe-bg" @click="setShow('reply',i)" v-if="item.overHeight">{{item.isShow?'收起部分内容↑':'展开阅读全文↓'}}</view>
					</view>
				</view>
			</view>
			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
		</view>
		<view class="empty-box withe-bg" v-else>
			<ks-empty type="list">暂无回复</ks-empty>
			<!-- <view class="empty">
				暂无回复
			</view> -->
		</view>
	
		<view class="heightbg"></view>
		<view class="ask-bottom withe-bg" :class="askData.issolve=='0'?'clearfix':''">
			<!-- v-if="isMyself" -->
			<view class="ask-collect ks-col-5" v-if="askData.issolve=='0'&&isMyself" @click="setNoSatisfaction">
				<image class="satisfied-answer" :src="baseUrl+'/static/images/class-center/answwer_nav_btn_none.png'"></image>
				<view class="f12">无满意答案</view>
			</view>
			<view class="ask-collect ks-col-5" v-if="askData.issolve=='0'&&isMyself" >
				<picker @change="bindPickerChange" :value="rewardIndex" :range="rewardArry">
					<image class="reward" :src="baseUrl+'/static/images/class-center/answwer_nav_btn_add.png'"></image>
					<view class="f12">提高悬赏</view>
				</picker>
			</view>
			<view class="ask-collect" :class="collectClass">
				<ks-collect modelid="998" :infoid="getParameters.topicId" :action="1" :iscollect="iscollect"></ks-collect>
			</view>
			<!-- <view class="question " v-if="askData.issolve=='0'" :class="isMyself?'ks-col-9':'ks-col-18'">
				<button class="ks-button" type="primary" @click="replyQuestion">我来回答</button>
			</view> -->
			<view class="question " :class="(isMyself&&askData.issolve=='0')?'ks-col-9':'ks-col-18'">
				<button class="ks-button" type="primary" @click="replyQuestion" :class="askData.issolve=='1'&&'gray-bg'">{{askData.issolve=='0'?'我来回答':'已解决'}}</button>
			</view>
		</view>
		<view class="reply-question withe-bg" :style="'bottom:'+bottomHeight+'px'" @touchmove.stop.prevent>
			<view class="reply-top clearfix">
				<view class="cancel" @click="cancel">取消</view>
				<view class="submit" @click="submit">提交</view>
			</view>
			<view class="textarea f14">
				<textarea placeholder-style="color:#B2B2B2" :adjust-position="false" :focus="false" fixed="true" @focus="setBottomHeight" @blur="setNoHeight" class="reply-textarea" placeholder="我的回答是...." v-model="content" maxlength="255"/>
			</view>
		</view>
		<view class="reply-shadow" :class="isReply?'show-bg':''" @click="closeReply" @touchmove.stop.prevent></view>
	</view>
</template>

<script>
	import {GetAskView,ReplyAskTopic,CloseAsk,SetAskSatisfied,AddReward,DeleteAnswer} from '@/api/class-center'
	import KsImage from '@/components/ks-components/image/Image.vue'
	import KsCollect from '@/components/ks-components/collect/collect.vue'
	import KsEmpty from '@/components/ks-components/empty/empty.vue'
	import UniLoadMore from '@/components/uni/uni-load-more/uni-load-more.vue'
	export default {
		data(){
			return{
				baseUrl:this.$store.state.SRC+"/config/app",
				loaded:false,
				askData:{},
				getParameters:{
					topicId:0,
					pageindex:1,
					pagesize:10,
				},
				rewardArry:['无悬赏分','1分','5分','10分','15分','20分','30分','50分','80分','100分'],
				isCollect:false,
				conIsShow:false,
				pageCount:0,
				moreStatus:'more',
				isReply:false,
				isFocus:false,
				content:'',
				isMyself:false,
				collectClass:'',
				overHeight:false,
				iscollect:false,
				isHaveBest:false,
				rewardIndex:0,
				bottomHeight:-243
			}
		},
		components:{
			KsImage,
			KsCollect,
			KsEmpty,
			UniLoadMore
		},
		onLoad: function(option) {
			this.getParameters.topicId = option.topicid
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
		　　　　title: that.askData.title,
				path: '/pages/class-center/ask/details?topicid='+that.getParameters.topicId,
		　　　　imageUrl: that.askData.imgList[0]||this.baseUrl+'/static/images/common/default-img.png', 
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
			bindPickerChange(e){
				this.rewardIndex = e.target.value
				let scoreValue = this.rewardArry[e.target.value]
				let score
				if(scoreValue=='无悬赏分'){
					score = 0
				}else{
					score = Number(scoreValue.split('分')[0])
				}
				uni.showLoading({
				    title: '正在提交中'
				});
				AddReward({
					topicid:this.getParameters.topicId,
					score:score
				}).then(res=>{
					uni.hideLoading();
					if(res.result){
						uni.showToast({
						    title: '设置成功',
						    duration: 2000,
							icon:'none',
						});
						this.loadPage()
					}else{
						uni.showToast({
						    title: res.msg,
						    duration: 2000,
							icon:'none',
						});
					}
				})
			},
			setBottomHeight(e){
				this.isFocus = true
				if(this.isReply){
					this.bottomHeight = e.detail.height 
				}
			},
			setNoHeight(){
				this.isFocus = false
				if(this.isReply){
					this.bottomHeight = 0
				}else{
					this.bottomHeight = -243
				}
				
			},
			closeReply(){
				this.isReply=false
				this.isFocus=false
				this.bottomHeight = -243
				this.content = ''
			},
			deleteReply(topicid,postid){
				uni.showLoading({
				    title: '正在提交中'
				});
				DeleteAnswer({
					topicid:topicid,
					postid:postid
				}).then(res=>{
					uni.hideLoading();
					if(res.result){
						uni.showToast({
						    title: '删除成功',
						    duration: 2000,
							icon:'none',
						});
						this.loadPage()
					}else{
						uni.showToast({
						    title: res.msg,
						    duration: 2000,
							icon:'none',
						});
					}
				})
			},
			setBestAsk(topicid,postid){
				uni.showLoading({
				    title: '正在提交中'
				});
				SetAskSatisfied({
					topicid:topicid,
					postid:postid
				}).then(res=>{
					uni.hideLoading();
					if(res.result){
						uni.showToast({
						    title: '设置成功',
						    duration: 2000,
							icon:'none',
						});
						this.loadPage()
					}else{
						uni.showToast({
						    title: res.msg,
						    duration: 2000,
							icon:'none',
						});
					}
				})
			},
			setNoSatisfaction(){
				let _this = this
				uni.showModal({
				    title: '无满意答案',
				    content: '如果没有满意的回答，可点击“关闭问题”按钮结束提问',
				    success: function (res) {
				        if (res.confirm) {
				            _this.closeAsk()
				        } else if (res.cancel) {
				            console.log('用户点击取消');
				        }
				    }
				});
			},
			closeAsk(){
				uni.showLoading({
				    title: '正在提交中'
				});
				CloseAsk({
					topicid:this.getParameters.topicId
				}).then(res=>{
					uni.hideLoading();
					if(res.result){
						uni.showToast({
						    title: '关闭成功',
						    duration: 2000,
							icon:'none',
						});
						this.loadPage()
					}else{
						uni.showToast({
						    title: res.msg,
						    duration: 2000,
							icon:'none',
						});
					}
				})
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
					GetAskView(this.getParameters).then(res=>{
						this.moreStatus = 'more'
						if(res.result){
							res.replyList.map((item,i)=>{
								item.isShow = false
							})
							this.askData.replyList = this.askData.replyList.concat(res.replyList)
						}
						this.loaded = true
					})
				}else{
					this.getParameters.pageindex = 1
					GetAskView(this.getParameters).then(res=>{
						if(res.result){
							this.pageCount = res.pageCount
							if(this.pageCount==1){
								this.moreStatus = 'noMore'
							}else{
								this.moreStatus = 'more'
							}
							this.isMyself = res.ismine
							this.iscollect = res.iscollect
							if(res.bestusername){
								this.isHaveBest = true
							}else{
								this.isHaveBest = false
							}
							res.replyList.map((item,i)=>{
								item.overHeight = false
								item.isShow = false
							})
							this.askData = res
							if(this.askData.issolve=='0'){
								if(this.isMyself){
									this.collectClass = 'ks-col-5'
								}else{
									this.collectClass = 'ks-col-6'
								}
							}else{
								this.collectClass = 'ks-col-6'
								
							}
						}else{
							this.pageCount = 0
						}
						this.loaded = true
						uni.hideLoading();
						this.$nextTick(function(){
							const query = uni.createSelectorQuery().in(this);
							query.select('#ask-con-show').boundingClientRect(data => {  
							  if(data.height>40){
								  this.overHeight = true
							  }else{
								  this.overHeight = false
							  }
							}).exec();
							this.askData.replyList.map((item,i)=>{
								const query = uni.createSelectorQuery().in(this);
								query.select('#reply'+i).boundingClientRect(data => {  
								  if(data.height>40){
									  item.overHeight = true
								  }else{
									  item.overHeight = false
								  }
								}).exec();
							})
						})
					})
					
				}
			},
			setShow(action,index){
				if(action=='reply'){
					this.askData.replyList[index].isShow = this.askData.replyList[index].isShow==false?true:false
				}else{
					this.conIsShow = this.conIsShow==false?true:false
				}
			},
			replyQuestion(){
				this.isReply = true
				this.bottomHeight = 0
			},
			cancel(){
				this.isReply=false
				this.isFocus = false
				this.bottomHeight = -243
				this.content = ''
			},
			submit(){
				if(this.content){
					uni.showLoading({
					    title: '正在提交中'
					});
					ReplyAskTopic({
						topicid:this.getParameters.topicId,
						content:this.content
					}).then(res=>{
						uni.hideLoading();
						if(res.result){
							uni.showToast({
							    title: '提交回答成功',
							    duration: 2000,
								icon:'none',
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
						this.isReply = false
						this.isFocus = false
						this.bottomHeight = -243
					})
				}else{
					uni.showToast({
					    title: '请输入回答内容',
					    duration: 10000,
						icon:'none'
					});
				}
			}
		}
	}
</script>

<style lang="scss" scoped>
	.ask-details{
		padding: 15px;
		.top-info{
			margin-bottom: 14px;
			.info-left{
				position:relative;
				.image-img{
					width: 35px;
					height: 35px;
					position:absolute;
					left: 0;
					top: 0;
					overflow: hidden;
					border-radius: 35px;
				}
				.info{
					padding-left: 45px;
					.source{
						color: #1A1A1A;
					}
					.addtime{
						color: #999;
						margin-top:5px;
					}
					
				}
			}
			.info-right{
				text-align: right;
				.integral{
					
					background-size:14px ;
					padding-left: 19px;
					display: inline-block;
					color: #FF9500;
				}
				.status{
					display: inline-block;
					margin-left: 10px;
				}
				.green-font{
					color: #25D045;
				}
				.gray-font{
					color: #999;
				}
			}
		}
		.title{
			font-size: 16px;
			font-weight: 600;
			margin-bottom: 5px;
			color: #303030;
		}
		.ask-content{
			font-size: 14px;
			line-height: 20px;
			max-height: 40px;
			overflow: hidden;
		}
		.height-auto{
			max-height:none;
		}
		.ask-con-show{
			color: #ff663d;
			text-align: right;
			margin-top: 10px;
			.icon{
				display: inline-block;
			}
		}
	}
	.ask-list{
		.title .inner{
			margin: 10px 10px 0;
			line-height: 38px;
			font-size: 14px;
			border-bottom: 1px solid #eee;
			color: #1A1A1A;
		}
		.item{
			margin-top: 10px;
			padding: 0 15px;
			position: relative;
			.info-left{
				position:relative;
				margin-bottom: 12px;
				margin-top: 10px;
				.image-img{
					width: 35px;
					height: 35px;
					position: absolute;
					left: 0;
					top: 0;
					overflow: hidden;
					border-radius: 30px;
				}
				.info{
					padding-left: 45px;
					.addtime{
						color: #999;
						margin-top:5px;
					}
					.source{
						color: #1A1A1A;
					}
					
				}
			}
			.info-right{
				text-align: right;
				.answer-status{
					margin-top: 16px;
					text-align: right;
					
					background-size:20px;
					line-height: 20px;
					display: inline-block;
					padding-left: 25px;
					color: #ff9500;
				}
			}
			
			.item__bottom{
				max-height: 198px;
				padding-bottom: 40px;
				overflow: hidden;
				.item__content{
					line-height: 23px;
					font-size: 14px;
				}
				.item__expand{
					height: 40px;
					position: absolute;
					width: 100%;
					bottom: 0;
					text-align: center;
					line-height: 40px;
					font-size: 14px;
					color: #ff663d;
					z-index: 10;
					left: 0;
					letter-spacing: 1px;
					box-shadow: 0 -10px 20px 0px rgba(255, 255, 255, 1);
				}
			} 
			.height-auto{
				max-height:none;
				padding-bottom: 45px;
			}
		}
	}
	.heightbg{
		height: 50px;
	}
	.ask-bottom{
		position: fixed;
		width: 100%;
		height: 50px;
		bottom: 0;
		left: 0;
		z-index: 11;
		text-align: center;
		.collect-icon,.reward,.satisfied-answer{
			width: 23px;
			height: 23px;
			display: block;
			margin: 7px auto 0;
		}
		.ask-collect,.question{
			display: inline-block;
		}
		.ask-collect .ks-collect2{
			margin-top: 6px;
		}
		.question .ks-button{
			height:36px ;
			line-height: 36px;
			font-size: 16px;
			margin-top: 7px;
			border-radius: 3px;
			margin-right: 10px;
		}
		.question .ks-button:after{
			display: none;
		}
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
	.reply-show{
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
	.add-ask{
		height: 28px;
		font-size: 13px;
		line-height: 28px;
		display: inline-block;
		border-radius: 2px;
		margin-top: 10px;
	}
	.delete-icon{
		
		background-size: 20px;
		width: 20px;
		height: 20px;
		float: right;
		margin-top: 10px;
	}
	.gray-bg{
		background: #E3E3E3 !important;
		pointer-events: none;
	}
</style>