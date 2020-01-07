<template>
	<view class="">
		<!-- 这里是状态栏 -->
		<view class="top">
			<view class="user-info" style="background: #fff;">
				<view class="flex-box__space" style="padding-top: 5px;">
					<view class="unread-msg" @click="open('/pages/user/massage/index')">
						<image :src="baseUrl+'/static/images/my/me_btn_message@2x.png'"></image>
						<uni-badge style="position: absolute;right: -7px;top:-7px" :text="msgNum" type="error" size="small" @click="openMsg" v-if="msgNum>0"></uni-badge>
					</view>
					<image :src="baseUrl+'/static/images/my/me_btn_setting@2x.png'" @click="open('/pages/user/settings/index')"></image>
				</view>
				<view class="flex-box" style="padding: 20px 0;">
					<ks-image radius="50%" class="ks-image" :src="userFace" type="user" @click="open('/pages/user/settings/basicinfo')"></ks-image>
					<view style="margin-left: 10px;" v-if="isLogin==1" @click="open('/pages/user/settings/basicinfo')">
						<view class="user-name">{{userInfo.RealName?userInfo.RealName:userInfo.UserName}}</view>
						<uni-tag :circle="true" :text="(userInfo.GroupID == 2 && '学员')||(userInfo.GroupID == 3 && '学校')||(userInfo.GroupID == 4 && '教师')||''" type="primary" size="small"></uni-tag>
					</view>
					<view style="margin-left: 10px;" v-else  @click="login('/pages/user/login/index')">
						登录/注册
					</view>
				</view>
			</view>
			<view class="flex-box ks-line" style="padding-bottom: 20px;background: #fff;" v-if="isLogin==1&&state.isshowprice">
				<view class="account-item flex-box__column" @click="open('/pages/user/account/index')">
					<text>余额</text>
					<text style="color:#1A1A1A;margin-top: 10px;">￥{{userInfo.Money}}</text>
				</view>
				<view class="account-item flex-box__column" @click="open('/pages/user/account/exchangepoint')">
					<text>点券</text>
					<text style="color:#1A1A1A;margin-top: 10px;">{{userInfo.Point}}</text>
				</view>
				<view class="account-item flex-box__column" @click="open('/pages/user/account/logscore')">
					<text>积分</text>
					<text style="color:#1A1A1A;margin-top: 10px;">{{userInfo.Score}}</text>
				</view>
			</view>
			<view class="flex-box" style="padding: 5px 10px;flex-wrap:wrap;margin-top: 10px;background: #fff;">
				<view class="tabs-item flex-box__column" @click="open('/pages/user/course/index')">
					<image :src="baseUrl+'/static/images/my/me_icon_record.png'"></image>
					<text>我的课程</text>
				</view>
				<view class="tabs-item flex-box__column" @click="open('/pages/user/class/index')">
					<image :src="baseUrl+'/static/images/my/me_icon_class.png'"></image>
					<text>我的班级</text>
				</view>
				
				<view class="tabs-item flex-box__column" @click="open('/pages/user/order/index')" v-if="state.isshowprice">
					<image :src="baseUrl+'/static/images/my/me_icon_classorder.png'"></image>
					<text>我的订单</text>
				</view>
				<view class="tabs-item flex-box__column" @click="open('/pages/user/vip/index')"  v-if="state.isshowprice">
					<image :src="baseUrl+'/static/images/my/me_icon_vip.png'"></image>
					<text>升级会员</text>
				</view>
				<view class="tabs-item flex-box__column" @click="open('/pages/user/column/index')">
					<image :src="baseUrl+'/static/images/my/me_icon_column.png'"></image>
					<text>我的专栏</text>
				</view>
				<view v-if="state.isshowprice" class="tabs-item flex-box__column" @click="open('/pages/user/card/index')">
					<image :src="baseUrl+'/static/images/my/me_icon_recard.png'"></image>
					<text>我的营销卡</text>
				</view>
				<view v-if="state.isshowprice" class="tabs-item flex-box__column" @click="open('/pages/user/coupon/index')">
					<image :src="baseUrl+'/static/images/my/me_icon_coupon.png'"></image>
					<text>我的卡券包</text>
				</view>
				<view class="tabs-item flex-box__column" @click="open('/pages/user/ask/index')"  v-if="state.isshowprice">
					<image :src="baseUrl+'/static/images/my/me_icon_interaction.png'"></image>
					<text>我的提问</text>
				</view>
				<view class="tabs-item flex-box__column" @click="open('/pages/user/collect/index')">
					<image :src="baseUrl+'/static/images/my/me_icon_mark.png'"></image>
					<text>我的收藏</text>
				</view>
	
				<view class="tabs-item flex-box__column" @click="open('/pages/user/share/index')">
					<image :src="baseUrl+'/static/images/my/me_icon_friend.png'"></image>
					<text>邀请好友</text>
				</view>
				<view class="tabs-item flex-box__column" @click="open('/pages/exam/index')">
					<image :src="baseUrl+'/static/images/my/me_icon_test.png'"></image>
					<text>我的考试</text>
				</view>
				
				<view class="tabs-item flex-box__column" @click="open('/pages/user/error/index')">
					<image :src="baseUrl+'/static/images/my/me_icon_error.png'"></image>
					<text>试题纠错</text>
				</view>
				<view v-if="state.isshowprice" class="tabs-item flex-box__column" @click="open('/pages/web/web?url='+ encodeURIComponent('/config/app/#/user/package')+'&title=考试套餐包')">
					<image :src="baseUrl+'/static/images/my/me_icon_testitem.png'"></image>
					<text>题库购买</text>
				</view>
				<view v-if="!state.isshowprice" class="tabs-item flex-box__column" @click="open('/pages/user/proposal/index')">
					<image :src="baseUrl+'/static/images/my/jy.png'"></image>
					<text>举报/建议</text>
				</view>
				<view class="tabs-item flex-box__column" @click="openFenxiao(fenxiaoUrl)">
					<image :src="baseUrl+'/static/images/my/me_icon_distributor.png'"></image>
					<text>分销商</text>
				</view>
				
			</view>
		</view>


		
		
	</view>
</template>

<script>
	import {IsDistributor} from 'api/user'
	import {UniTag} from 'components/uni/uni-tag/uni-tag'
	import {UniBadge} from 'components/uni/uni-badge/uni-badge'
	export default {
		components:{
			UniTag,
			UniBadge
		},
		data() {
			return {
				/*消息数*/
				msgNum:'0',
				userInfo:{},
				state:{},
				isLogin:0,
				userFace:'',
				baseUrl:this.$store.state.SRC+"/config/app",
				fenxiaoUrl:'',
				fenxiaoMsg:''
			}
		},
		onLoad() {	
			
		},
		onPullDownRefresh() {
			this.$store.dispatch('getUserInfo').then(()=>{
				uni.stopPullDownRefresh();
				this.initData()
			})
		},
		onShow() {
			IsDistributor().then(res=>{
				this.fenxiaoMsg = ''
				if(res.result){
					 if (res.code == 3){
						this.fenxiaoUrl = '/pages/user/distribution/index'
					}else if(res.code == 4){
						this.fenxiaoUrl = '/pages/user/distribution/apply'
					}
				}else{
					if(res.code == 2){
						this.fenxiaoMsg = res.msg
					}
				}
				this.initData()	
			})
			
		},
		methods: {
			initData(){
				this.$store.ready(state=>{
					this.state = state
					this.isLogin = state.isLogin
					this.userInfo = state.userInfo
					this.msgNum = state.userInfo.ReadTF || 0
					this.userFace = state.userInfo.UserFace
				})
			},
			login(url){
				uni.navigateTo({
					url:url
				})
			},
			open(url){
				console.log(url)
				if(this.isLogin == 1){
					uni.navigateTo({
						url:url
					})
				}else{
					uni.navigateTo({
						url:'/pages/user/login/index'
					})
				}	
			},
			openFenxiao(url){
				console.log(this.fenxiaoMsg)
				if(this.fenxiaoMsg){
					uni.showToast({
						title:this.fenxiaoMsg,
						icon:'none'
					})
				}else{
					if(this.isLogin == 1){
						uni.navigateTo({
							url:url
						})
					}else{
						uni.navigateTo({
							url:'/pages/user/login/index'
						})
					}
				}
				
			}
		}
	}
</script>

<style scoped>
.status_bar {
      height: var(--status-bar-height);
      width: 100%;
  }
	.flex-box__space image{
		width: 30px;
		height: 30px;
	}

	.user-info{
		padding: 0 10px;	
	}
	.unread-msg{
		width: 30px;
		height: 30px;
		position: relative;
	}
	.unread-msg iamge{
		position: absolute;
		top: 0;
	}
	.flex-box .ks-image{
		width: 60px;
		height: 60px;
		overflow: hidden;
		border-radius: 50%;
	}
	.user-name{
		font-size:17px;
		font-weight:500;
		color:rgba(26,26,26,1);
		line-height: 26px;
		height: 26px;
	}
	.account-item{
		width:calc(100% / 3);
		font-size:16px;
		color:rgba(102,102,102,1);
	}
	.tabs-item{
		width:calc(100% / 3);
		font-size:11px;
		color:rgba(26,26,26,1);
		padding: 20px 0;
	
	}
	.tabs-item image{
		width:24px;
		height:24px;
	}
	.tabs-item text{
		margin-top:5px;
	}
	.user-list{
		margin-top:10px;
		background:#fff;
	}
	.user-item{
		padding:14px 10px 14px 15px;
		font-size:16px;
		color:rgba(26,26,26,1);
	}
	.user-item image{
		width:15px;
		height:15px;
	}
</style>
