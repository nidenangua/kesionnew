<template>
	<view>
		<view class="payment" v-if="payStatus == 1">
			<view class="payment__status">
				<image :src="baseUrl+'/static/images/icon/success.gif'"></image>
			</view>
			<view class="payment__msg">
				支付成功，赶紧去学习吧~
			</view>
			<view class="payment__footer">
				<button size="medium" @click="open()">查看订单</button>
				<button size="medium" type="primary" @click="goBack">返回</button>
			</view>
		</view>
		<view class="payment" v-else-if="payStatus == 2">
			<view class="payment__status">
				<image :src="baseUrl+'/static/images/icon/fail.gif'"></image>
			</view>
			<view class="payment__msg">
				订单支付失败，请重新支付~
			</view>
			<view class="payment__footer">
				<button size="medium" @click="openOrder">查看订单</button>
				<button size="medium" type="warning" @click="orderPay">重新支付</button>
			</view>
		</view>
		<view class="payment" v-else-if="payStatus == 3">
			<view class="payment__msg">
				正在支付中，请稍候...
			</view>
		</view>
	</view>
</template>
<script>
	import {GetWeiPaySign,WechatPay,XiaDanWeiPay,XiaDanAliPay} from '@/api/pay'
	import {CheckOrder} from '@/api/app'
	export default{
		name:'payment',
		data(){
			return {
				baseUrl:this.$store.state.SRC+"/config/app",
				payStatus:0,
				webUrl:'',
				webTitle:'',
				defaultPaymentid:0,
				orderInfo:{}
			}
		},
		onLoad(options){
			let pages = getCurrentPages()
			let prevPage = pages[pages.length-2]
			if(prevPage.route === 'pages/web/web'){
				prevPage.$vm.refresh = false
			}
			let orderid = options.orderid
		
			/**
			 * 获取订单详细信息
			 */
			CheckOrder({
				orderid:orderid,
				ordertype:options.ordertype || 0
			}).then(res=>{
				if(res.result){
					this.defaultPaymentid = res.paymentid
					switch(Number(res.status)){
						case 1:
							this.webUrl = res.weburl
							this.webTitle = res.title
							this.onPaySuccess()
							break
						default:
							this.orderInfo = res
							this.orderPay()
					}
					
				}else{
					this.$msg(res.msg).then(()=>{
						uni.navigateBack()
					})
				}
			})
		},
		methods:{
			open(){
				uni.navigateTo({
					url:'/pages/user/order/index'
				})
			},
			/*返回*/
			goBack(){
				uni.navigateBack()
			},
			onPaySuccess(){
				this.$store.dispatch('getUserInfo').then(()=>{
					this.payStatus = 1
				})
			},

			/**
			 * 查看订单
			 */
			openOrder(){
				uni.navigateTo({
					url:'/pages/user/order/index'
				})
			},
		
			/**
			 * 订单支付
			 */
			orderPay(){
				let orderInfo = this.orderInfo
				// #ifdef  MP-WEIXIN
				//在小程序环境下调用微信支付
				this.mpWechatPay(orderInfo)
				return
				// #endif
				switch(Number(orderInfo.payment)){
					/*余额支付*/
					case 0:
						if(this.defaultPaymentid == 15){
							this.aliPay(orderInfo)
						}else{
							this.appWechatPay(orderInfo)
						}
						break
					/*微信支付*/
					case 15:
						this.appWechatPay(orderInfo)
						break
					/*支付宝支付*/
					case 8:
						this.aliPay(orderInfo)
						break
				}
			},
			/**
			 * 阿里支付
			 * 文档：https://docs.open.alipay.com/api_1/alipay.trade.app.pay
			 */
			aliPay(orderInfo){
				this.payStatus = 3
				XiaDanAliPay({
					ordertype:1,
					orderid:orderInfo.courseorder
				}).then(res=>{
					if(!res.result){
						this.$msg(res.msg)
						return
					}
					uni.requestPayment({
					  provider: 'alipay',
					  orderInfo:res.data,
					  success: res=> {
						this.onPaySuccess()
					  },
					  fail:res=> {
						console.log(JSON.stringify(res))
						this.payStatus = 2
					  }
					})
				})
			},
			/**
			 * app微信支付
			 */
			appWechatPay(orderInfo){
				this.payStatus = 3
				WechatPay({
					money: orderInfo.ordertotalprice,
					payorderid: orderInfo.courseorder,
					ordertype: 1,
					platid: 15
				}).then(signInfo=>{
					if(!signInfo.result){
						this.$msg(signInfo.msg)
						this.payStatus = 2
						return
					}
					//APP微信支付参数详见：https://pay.weixin.qq.com/wiki/doc/api/app/app.php?chapter=9_12&index=2
					uni.requestPayment({
					  provider: 'wxpay',
					  orderInfo:{
						  appid:signInfo.appid,
						  partnerid:signInfo.partnerid,
						  prepayid:signInfo.prepayid,
						  package:'Sign=WXPay',
						  noncestr:signInfo.noncestr,
						  timestamp:signInfo.timestamp,
						  sign:signInfo.sign
					  },
					  success: res=> {
						this.onPaySuccess()
					  },
					  fail:res=> {
						this.payStatus = 2
					  }
					})
					
				})
			},
			/**
			 * 微信小程序微信支付
			 */
			mpWechatPay(orderInfo){
				console.log(orderInfo)
				this.payStatus = 3
				this.$store.dispatch('getWechatOpenID').then(openID=>{
					if(openID === 'unableget'){
						this.$msg('获取openId出错，请联系管理员')
					}else{
						
						XiaDanWeiPay({
							money: orderInfo.ordertotalprice,
							openid: openID,
							ordertype: 1,
							payorderid: orderInfo.courseorder,
							platid: 15
						}).then(res=>{
							if(!res.result){
								this.$msg(res.msg)
								return
							}
							this.getSignToWeiPay(res.prepay_id).then(res=>{
								//小程序支付参数说明：https://pay.weixin.qq.com/wiki/doc/api/wxa/wxa_api.php?chapter=7_7&index=5
								wx.requestPayment({
								  timeStamp: res.timeStamp,
								  nonceStr: res.nonceStr,
								  package: res.package,
								  signType: res.signType,
								  paySign: res.paySign,
								  success: res=> {
									this.onPaySuccess()
								  },
								  fail:res=> {
									this.payStatus = 2
								  }
								})
							})
							
							
						})
					}
				})
			},
			/**
			 * 获取微信支付签名
			 */
			getSignToWeiPay(prepay_id,type){
				return new Promise(resolve=>{
					GetWeiPaySign({
						repay_id:prepay_id,
						type:type
					}).then(res=>{
						if(res.result){
							resolve(res)
						}else{
							this.$msg(res.msg)
						}
					})
				})
			}
		}
	}
</script>

<style lang="scss" scoped>
	
	.payment{
		background: #fff;
		padding: 30px 20px;
		text-align: center;
		box-sizing: border-box;
		min-height: 100vh;
		
	}
	.payment__status image{
		width: 100px;
		height: 100px;
	}
	.payment__msg{
		font-size: 14px;
		line-height: 24px;
		margin-top: 10px;
	}
	.payment__footer{
		display: flex;
		padding: 20px 0;
		margin-top: 20px;
	}
	.payment__footer button{
		flex: 1;
		margin: 0 10px;
	}
</style>
