<template>
	<view style="background: #F1F1F1;min-height: 100vh;font-size: 16px;">
		<view style="padding: 20px;">
			<view class="money-bg" :style="'background: url('+baseUrl+'/static/images/account/money_bg.png);background-size: 100% 100%;'">
				
				<view >
					<view style="font-size: 16px;line-height: 20px;">账户余额</view>
					<view style="font-size: 30px;line-height: 30px;margin-top: 10px;">{{state.userInfo.Money}}</view>
				</view>
				
			</view>
		</view>
		<view style="height: 60px;line-height: 60px;padding-left: 20px;background: #fff;font-weight: 500;color:#2F3133">
			充值金额
		</view>
		<view style="padding: 10px 20px 20px;text-align: center;">
			<view style="display: flex;flex-wrap: wrap;width: 100%;justify-content: space-between;">
				<view  class="item" v-for="(item,i) in list" @click="pay(item)">￥<text>{{item}}</text></view>
				<view  class="item">
					<input style="font-size: 14px;color:#888;" v-model="value" placeholder="自定义金额" @blur="change" type="number" />
				</view>
			</view>
		</view>
		<view style="height: 60px;line-height: 60px;padding-left: 20px;background: #fff;font-weight: 500;color:#2F3133">
			充值方式
		</view>
		<view style="padding: 10px 20px;">
			<view style="background: #fff;border-radius: 10px;padding: 15px;display: flex;justify-content: space-between;align-items: center;">
				<view style="display: flex;align-items: center;">
					<image style="width: 24px;height: 24px;" :src="baseUrl+'/static/images/account/wepay.png'"></image>
					<text style="margin-left: 10px;">微信支付</text>
				</view>
		
				<image style="width: 20px;height: 20px;" :src="baseUrl+'/static/images/account/active.png'"></image>
			</view>
			<!-- <view style="background: #fff;border-radius: 10px;padding:15px;display: flex;justify-content: space-between;align-items: center;margin-top: 10px;">
				<view style="display: flex;align-items: center;">
					<image style="width: 26px;height: 26px;" src=""></image>
					<text>支付宝支付</text>
					
				</view>
				<view style="width: 18px;height: 18px;border-radius: 50%;border: 2px solid #ff663d;"></view>
			</view> -->
		</view>
		<view style="height: 60px;line-height: 60px;padding-left: 20px;background: #fff;font-weight: 500;color:#2F3133">
			充值记录
		</view>
		<view style="padding: 10px 20px;">
			<view style="background: #fff;border-radius: 10px;padding: 15px;text-align: center;background: #ff663d;color:#fff;cursor: pointer;" @click="open('/pages/user/account/record')">
				查看充值记录
			</view>
		</view>
	</view>
</template>

<script>
	import {DoPay} from 'api/user'
	export default{
		data(){
			return {
				baseUrl:this.$store.state.SRC+'/config/app',
				list:[20,30,50,80,100],
				moeny:0,
				value:'',
				state:{}
			}
		},
		methods:{
			open(url){
				uni.navigateTo({
					url:url
				})
			},
			pay(val){
				this.money = val
				if(this.money){
					DoPay({
						rechargemoney: this.money,
						payid: 15,//微信支付id：15
					}).then(res=>{
						if (res.result) {
							uni.navigateTo({
								url: '/pages/payment/payment?orderid=' + res.orderid + '&ordertype=' + res.ordertype
							})
						
						} else {
						     uni.showToast({
						     	title:res.msg,
								icon:'none'
						     })
						}
					})
				}
				
			},
			change(){
				this.money = this.value
				if(this.money){
					DoPay({
						rechargemoney: this.money,
						payid: 15,//微信支付id：15
					}).then(res=>{
						if (res.result) {
						
							 uni.navigateTo({
							 	url: '/pages/payment/payment?orderid=' + res.orderid + '&ordertype=' + res.ordertype
							 })
						} else {
						     uni.showToast({
						     	title:res.msg,
								icon:'none'
						     })
						}
					})
				}
			},	
		},
		onLoad() {
			this.$store.ready(state=>{
				this.state = state
			})
		}
	}
</script>

<style scoped>
	.money-bg{
		border-radius: 20px;
		height: 130px;
		background: #ff663d;
		text-align: center;
		align-items: center;
		justify-content: center;
		color: #fff;
		display: flex;
		
	}
	.item{
		color:#ff663d;
		width: calc((100% - 40px) / 3);
		background: #fff;
		padding: 20px 0;
		border-radius: 10px;
		margin: 10px 0;
		font-size: 16px;
		box-shadow: 0px 15px 20px 0px rgba(255, 102, 61, 0.1);
		line-height: 30px;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.item text{
		font-size: 28px;
		font-weight: 500;
		
	}
</style>
