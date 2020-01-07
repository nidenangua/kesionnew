<template>
	<view>
		<view class="coupon-box">
			<view class="flex-box__space"  @click="open('/pages/user/coupon/coupon')" style="font-size:16px;color:rgba(26,26,26,1);height: 49px;line-height: 49px;">
				<text>优惠券</text>
				<view class="flex-box">
					<text style="font-size: 14px;color:#888">查看全部({{couponList.length}})</text>
					<image :src="baseUrl+'/static/images/my/me_icon_more@2x.png'"></image>
				</view>
			</view>
			<view  style="padding-bottom: 20px;" v-if="couponList.length>0">
				<view class="coupon-item" v-for="(item,i) in couponList" :key="i">
					<view class="coupon-left">
						<text style="font-size: 14px;">￥</text>{{item.price}}
					</view>
					<view class="coupon-right" style="color:rgba(1,12,23,1);font-size:12px;padding-left: 15px;box-sizing: border-box;">
						<view style="font-size:14px;margin-top: 10px;">{{item.minamount == 0 ? '无金额门槛限制':'满'+item.minamount+'元使用'}}</view>
						<view style="color:rgba(136,136,136,1);margin-top: 5px;">{{item.use_condition ? item.use_condition : '无限制'}}</view>
						<view style="margin-top: 5px;">有效期：<text style="color:#EC3D26;">{{item.begindate}}- -{{item.enddate}}</text></view>
					</view>
				</view>
			</view>
		</view>
		<view class="coupon-box">
			<view class="flex-box__space" @click="open('/pages/user/coupon/redpackage')" style="font-size:16px;color:rgba(26,26,26,1);height: 49px;line-height: 49px;">
				<text>红包</text>
				<view class="flex-box">
					<text style="font-size: 14px;color:#888">查看全部({{redList.length}})</text>
					<image :src="baseUrl+'/static/images/my/me_icon_more@2x.png'"></image>
				</view>
			</view>
			<view style="padding-bottom: 20px;" v-if="redList.length>0">
				<view class="coupon-item" v-for="(item,i) in redList" :key="i">
					<view class="coupon-left">
						<text style="font-size: 14px;">￥</text>{{item.price}}
					</view>
					<view class="coupon-right" style="color:rgba(1,12,23,1);font-size:12px;padding-left: 15px;box-sizing: border-box;">
						<view style="font-size:14px;margin-top: 10px;">{{item.minamount == 0?'无金额门槛限制':'满'+item.minamount+'元使用'}}</view>
						<view style="color:rgba(136,136,136,1);margin-top: 5px;">{{item.use_condition ? item.use_condition : '无限制'}}</view>
						<view style="margin-top: 5px;">有效期：<text style="color:#EC3D26;">{{item.begindate}}- -{{item.enddate}}</text></view>
					</view>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	import {GetUserCouponList,GetUserRedPacketList} from 'api/user'
	export default {
		data() {
			return {
				userInfo:{},
				state:{},
				couponList:[],
				redList:[],
				baseUrl:this.$store.state.SRC+"/config/app"
			}
		},
		onLoad() {
			
		},
		onShow() {
			this.$store.ready(state=>{
				this.state = state
				this.userInfo = state.userInfo
				GetUserCouponList({
					page: 1,
					pagesize: 4,
				}).then(res=>{
					this.couponList = res.data
				})
				GetUserRedPacketList({
					page: 1,
					pagesize: 4,
				}).then(res=>{
					this.redList = res.data
				})
			})
		},
		methods: {
			open(url){
				uni.navigateTo({
					url:url
				})
			}
		}
	}
</script>

<style scoped>
	.coupon-box{
		padding: 0 10px 0 10px;
		background: #fff;
		margin-top: 10px;
	}
	.flex-box image{
		width: 15px;
		height: 15px;
	}
	.coupon-item{
		background:rgba(255,255,255,1);
		display: flex;
		border-radius:4px;
		height: 85px;
		margin-top: 10px;
	}
	.coupon-left{
		width: 85px;
		height: 85px;
		box-shadow:-3px 0px 5px 0px rgba(1,12,23,0.08);
		border-radius:4px;
		border-right: 1px dashed #010C17;
		text-align: center;
		line-height: 85px;
		font-size:24px;
		font-weight:500;
		color:rgba(1,12,23,1);
	}
	.coupon-right{
		flex: 1;
		box-shadow:3px 0px 5px 0px rgba(1,12,23,0.08);
		border-radius:4px;
	}
</style>
