<template>
	<view class="">
		<!-- 这里是状态栏 -->
		<view class="top">
			<view class="user-info">
				<view class="flex-box__space" style="padding-top: 5px;">
					<view class="unread-msg" @click="open('/pages/user/massage/index')">
						<image :src="baseUrl+'/static/images/my/me_btn_message@2x.png'"></image>
						<uni-badge style="position: absolute;right: -7px;top:-7px" :text="msgNum" type="error" size="small" @click="openMsg" v-if="msgNum>0"></uni-badge>
					</view>
					<image :src="baseUrl+'/static/images/my/me_btn_setting@2x.png'" @click="open('/pages/user/settings/index')"></image>
				</view>
				<view class="flex-box" style="margin-top: 20px;">
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
			<view class="flex-box ks-line" style="padding: 20px 0;" v-if="isLogin==1&&state.isshowprice">
				<view class="account-item flex-box__column">
					<text>余额</text>
					<text style="color:#1A1A1A;margin-top: 10px;">￥{{userInfo.Money}}</text>
				</view>
				<view class="account-item flex-box__column">
					<text>点券</text>
					<text style="color:#1A1A1A;margin-top: 10px;">{{userInfo.Point}}</text>
				</view>
				<view class="account-item flex-box__column">
					<text>积分</text>
					<text style="color:#1A1A1A;margin-top: 10px;">{{userInfo.Score}}</text>
				</view>
			</view>
			<view class="flex-box__space" style="padding: 5px 10px;flex-wrap:wrap;">
				
				<view class="tabs-item flex-box__column" @click="open('/pages/user/class/index')">
					<image :src="baseUrl+'/static/images/my/me_btn_class@2x.png'"></image>
					<text>我的班级</text>
				</view>
				<view class="tabs-item flex-box__column" @click="open('/pages/user/course/index')">
					<image :src="baseUrl+'/static/images/my/me_btn_lesson@2x.png'"></image>
					<text>我的课程</text>
				</view>
				<view class="tabs-item flex-box__column" @click="open('/pages/user/order/index')" v-if="state.isshowprice">
					<image :src="baseUrl+'/static/images/my/me_btn_order@2x.png'"></image>
					<text>我的订单</text>
				</view>
			
				<view class="tabs-item flex-box__column" @click="open('/pages/user/column/index')">
					<image :src="baseUrl+'/static/images/my/me_btn_column.png'"></image>
					<text>我的专栏</text>
				</view>
			</view>
		</view>
		<ks-cell-group>
			<ks-cell show-arrow line label="我的收藏" @click="open('/pages/user/collect/index')"></ks-cell>
			<ks-cell show-arrow line label="我的卡券包" @click="open('/pages/user/coupon/index')" v-if="state.isshowprice"></ks-cell>
			<ks-cell show-arrow line label="我的提问" @click="open('/pages/user/ask/index')"></ks-cell>
			<ks-cell show-arrow label="我的营销卡" @click="open('/pages/user/card/index')"></ks-cell>
		</ks-cell-group>
		<ks-cell-group>
			<ks-cell label="考试记录" line show-arrow @click="open('/pages/exam/examrecord?categoryid=0')"></ks-cell>
			<ks-cell label="错题本" line show-arrow @click="open('/pages/exam/errorbank?categoryid=0')"></ks-cell>
			<ks-cell label="考试套餐包" show-arrow @click="open('/pages/web/web?url='+ encodeURIComponent('/config/app/#/user/package')+'&title=考试套餐包')"></ks-cell>
		</ks-cell-group>
		<ks-cell-group>
			<!-- #ifdef APP-PLUS -->
			<ks-cell show-arrow line label="离线缓存" @click="open('/pages/user/local/courselist')" v-if="state.isCache"></ks-cell>
			<!-- #endif -->
			<ks-cell show-arrow line label="VIP会员" @click="open('/pages/user/vip/index')" v-if="state.isshowprice"></ks-cell>
			<ks-cell show-arrow label="推广赚钱" @click="open('/pages/user/share/index')"></ks-cell>
			<!-- #ifdef MP-WEIXIN -->
			<ks-cell show-arrow label="举报/建议" @click="open('/pages/user/proposal/index')" v-if="!state.isshowprice"></ks-cell>
			<!-- #endif -->
		</ks-cell-group>

		
		
	</view>
</template>

<script>
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
				baseUrl:this.$store.state.SRC+"/config/app"
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
			this.initData()	
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
	.top{
		background: #fff;
		
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
		width:calc(100% / 4);
		font-size:11px;
		color:rgba(26,26,26,1);
		padding: 10px 0;
	}
	.tabs-item image{
		width:36px;
		height:36px;
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
