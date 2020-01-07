<template>
	<view style="color:#333">
		<view class="detail-top">
			<view class="detail-image" :style="{backgroundImage:'url('+detailData.PhotoUrl+'),'+(detailData.cardtype_str==='套餐卡')?'url('+state.SRC+'/Config/APP/static/user/images/myacoount_pack_bg.png)':'url('+state.SRC+'/Config/APP/static/user/images/myacoount_recharge_bg.png)'}">

				<view v-if="detailData.cardtype == 0 && type == 0">
					<text class="exam-tab" style="background: #2987EE;margin-top: 1rem;color:#fff" v-if="detailData.is_exprise == 0">使用中</text>
					<text class="exam-tab" style="background: #eee;margin-top: 1rem;color:#999" v-else>已过期</text>
				</view>
			</view>
			<view class="detail-title">{{detailData.title}}</view>
			<view class="detail-price">价格：<text style="color:#2987EE">￥{{detailData.price}}</text><text style="text-decoration: line-through;font-size: 14px;">
					<!-- (原价：￥{{detailData.price_market}}) --></text></view>
			<view class="detail__used" v-if="detailData.cardtype == 0 && type == 0">
				<text :style="{color:detailData.is_exprise == 0 ? '#2BC152' :'#BCC3CC' }">（{{(detailData.is_exprise == 0 ? '使用中' : '已过期')}}
					激活时间：{{detailData.packbegindate}} <i style="font-style: normal" v-if="detailData.givevipday >= 1">(赠送VIP:{{detailData.givevipday}}天)</i>）</text>
			</view>
		</view>

		<view class="detail-middle">
			<view class="detail-row">
				<view>营销卡有效天数</view>
				<view style="text-align: right;color:#787c82;font-size: 14px;flex: 1;">{{detailData.packdays}}天</view>
			</view>
			<view v-if="detailData.cardtype == 0">
				<view class="detail-row">
					<view>权限设置</view>
					<view class="detail-item">{{detailData.use_condition}}</view>
				</view>

				<view class="detail-row">
					<view>内容权限</view>
					<view v-if="detailData.content_list.length>0" class="detail-item" @click="openDialog(detailData.content_list)">{{detailData.content_use_condition}}
						<image style="margin-top: 12px;width: 20px;height: 20px;" :src="baseUrl+'/static/images/common/right_arrowed.png'" />
					</view>
					<view v-else class="detail-item">{{detailData.content_use_condition}}</view>
				</view>
				<view class="detail-row">
					<view>考试权限</view>
					<view v-if="detailData.paper_list.length>0" class="detail-item" @click="openDialog(detailData.paper_list)">{{detailData.exam_use_condition}}
						<image style="margin-top: 12px;width: 20px;height: 20px;" :src="baseUrl+'/static/images/common/right_arrowed.png'" />
					</view>
					<view v-else class="detail-item">{{detailData.exam_use_condition}}</view>
				</view>
				<view class="detail-row">
					<view>练习权限</view>

					<view v-if="detailData.practice_list.length>0" @click="openDialog(detailData.practice_list)" class="detail-item">{{detailData.practice_use_condition}}
						<image style="margin-top: 12px;width: 20px;height: 20px;" :src="baseUrl+'/static/images/common/right_arrowed.png'" />
					</view>
					<view v-else class="detail-item">{{detailData.practice_use_condition}}</view>

				</view>
				<view class="detail-row">
					<view>课程权限</view>

					<view v-if="detailData.course_list.length>0" @click="openDialog(detailData.course_list)" class="detail-item">{{detailData.course_use_condition}}
						<image style="margin-top: 12px;width: 20px;height: 20px;" :src="baseUrl+'/static/images/common/right_arrowed.png'" />
					</view>
					<view v-else class="detail-item">{{detailData.course_use_condition}}</view>

				</view>
			</view>
			<view v-else style="background: #fff;">
				<view class="detail-row">
					<view>使用升级</view>
					<view style="text-align: right;color:#787c82;font-size: 14px;flex: 1;">{{detailData.user_up_groupname}}</view>
				</view>
				<view class="detail-row">
					<view>到期降级</view>
					<view style="text-align: right;color:#787c82;font-size: 14px;flex: 1;">{{detailData.user_down_groupname}}</view>
				</view>
			</view>
		</view>
		<view class="detail-bottom">
			<view class="bottom-title">营销卡简介</view>
			<view style="line-height: 20px;margin-top: 10px;font-size: 14px;color:#787c82;">
				{{detailData.descript?detailData.descript:'无'}}
			</view>
		</view>
		<view class="detail-btn" v-if="detailData.is_exprise != 0 && type==0" @click="initPay(detailData)">
			重新购买
		</view>
		<view class="detail-btn" v-if="type==1" @click="initPay(detailData)">
			立即购买
		</view>
		<uni-popup ref="popup" :show="show" type="bottom" @change="close">
			<view style="text-align: center;font-size:16px;font-weight:500;color:rgba(51,51,51,1);line-height:20px;">
				<text>支付金额：￥ {{initBuyData.price}}</text>
				<image style="width: 15px;height: 15px;float: right;" :src="baseUrl+'/static/images/common/close.png'" @click="show = false"></image>
			</view>
			<view class="popup" style="margin-top: 22px;">
				<view class="money-pay">
					<view>
						<text style="color:#333333;font-size: 14px;">余额支付</text>
						<text style="margin-left: 5px;font-size: 12px;color:#888888">可用余额：￥{{userInfo.Money}}</text>
					</view>
					<view style="overflow: hidden;font-size:14px;color:rgba(102,102,102,1);line-height:32px;margin-top: 20px;">
						<view style="float:left;">输入用于支付的金额</view>
						<view style="text-align:center;width: 80px;height:28px;border-radius:1px;border:1px solid rgba(204,204,204,1);float:left;margin: 0 5px;">
							<input type="number" style="background: #fff;width: 80px;height:28px;color:#333" v-model="money" />

						</view>

						<view style="float:left;">元</view>

					</view>
				</view>
				<view id="payType" v-if="activePay != -1">
					<view class="money-pay" style="margin-top: 20px;">
						<view class="pay-left">选择支付类型</view>
						<view class="pay-right" id="select" style="margin-top: 20px;display: flex;flex-wrap: wrap;">
							<view class="pay-item" :class="activePay==i&&'curr-pay'" v-for="(item,i) in paymentList" :key="i" @click="payType(i)">
								<image style="width: 100%;height: 100%;" mode="aspectFit" :src="item.logo" :alt="item.payname" />
							</view>
						</view>
					</view>
					<view style="text-align: right;margin-right: 20px; ">
						<text id="realPrice" style="color:#F68439;font-size:16px">
							{{initBuyData.price - money}}元
						</text>
					</view>
				</view>

				<view class="pay-btnbox">
					<view class="pay-btn" @click="buyCard(initBuyData)">确认支付</view>
				</view>
			</view>
		</uni-popup>
		<uni-popup ref="dialog" :custom="true" :show="dialog" type="center" @change="closeDialog">
			<view class="content-box">
				<view class="title" style="padding: 20px 30px 10px 30px;text-align: center;color:#333;font-size: 18px;">详情</view>
				<view style="min-height: 160px;max-height: 350px;overflow: auto;padding: 0 20px;" v-for="(item,i) in list" :key="i">
					<view style="line-height: 24px;border-bottom: 1px dashed #eee;padding:10px 0;">{{item.title}}</view>
				</view>
				<view class="return-btn">
					<view class="btn" @click="dialog=false">确定</view>
				</view>

			</view>
		</uni-popup>
	</view>
</template>

<script>
	import {
		UniPopup
	} from 'components/uni/uni-popup/uni-popup'
	import {
		GetUserFeePackageDetail,
		GetUserFeePackageBuyDetail,
		InitialPayUserFeePackage,
		PayUserFeePackage
	} from 'api/user'
	export default {
		components: {
			UniPopup
		},
		data() {
			return {
				type: 0,
				detailData: {},
				id: 0,
				packid: 0,
				state: {},
				money: 0,
				paymentList: [],
				activePay: -1,
				payId: 0,
				initBuyData: {},
				show: false,
				userInfo: {},
				list: [],
				dialog: false,
				baseUrl:this.$store.state.SRC+"/config/app"
			}
		},
		watch: {
			money(money) {
				if (money - this.initBuyData.price >= 0) {
					this.money = this.initBuyData.price;
					this.activePay = -1;
					this.payId = 0;
				} else {
					this.activePay = 0;
					this.payId = this.paymentList[0].payid;
				}
				if (money - this.userInfo.Money > 0) {
					this.money = this.userInfo.money;
				}
				if (this.initBuyData.price > this.userInfo.Money) {
					if (this.activePay == -1) {
						this.activePay = 0;
						this.money = 0;
						this.payId = this.paymentList[0].payid;
					}
				}
			}
		},
		methods: {
			/**打开会话 */
			openDialog(list) {
				this.dialog = true;
				if (list) {
					this.list = list;
				} else {
					this.list = [];
				}
			},
			/**获取我的套餐包详情 */
			getMyData() {

				this.detailData = {};
				GetUserFeePackageDetail({
					id: this.id,
					packid: this.packid
				}).then(res => {
					if (res.result == true) {
						this.detailData = res.data;
					}
				})
			},
			/**获取全部套餐包详情 */
			getAllData() {

				this.detailData = {};
				GetUserFeePackageBuyDetail({
					id: this.id,
					packid: this.packid
				}).then(res => {
					if (res.result == true) {
						this.detailData = res.data;
					}
				})

			},
			buyCard(item) {
				if (this.activePay == -1) {
					PayUserFeePackage({
						packid: item.packid,
						payid: this.payId,
						userpaymoney: this.money,
					}).then(res => {
						if (res.result) {

							this.$store.dispatch("getUserInfo").then(_ => {
								this.$store.ready(state => {
									this.userInfo = state.userInfo;
									this.show = false;
									uni.showToast({
										title: '购买成功',
									})
								});
							})
						} else {
							uni.showToast({
								title: res.msg,
								icon: 'none'
							})
						}
					});
				} else {
					PayUserFeePackage({
						packid: item.packid,
						payid: this.payId,
						userpaymoney: this.money,
					}).then(res => {
						if (res.result) {
							uni.navigateTo({
								url: '/pages/payment/payment?orderid=' + res.orderid + '&ordertype=' + res.ordertype
							})
						} else {
							uni.showToast({
								title: res.msg,
								icon: 'none'
							})
						}
					});
				}
			},
			initPay(item) {

				InitialPayUserFeePackage({
					packid: item.packid,
				}).then(res => {
					if (res.result) {
						this.initBuyData = res.data;
						this.money = this.initBuyData.price;
						this.paymentList = res.data.payment_list;
						this.show = true
					}
				});
			},
			pay() {
				this.show = true
			},
			close(e) {
				this.show = e.show

			}
		},
		onShow() {
			if (this.type == 0) {
				this.getMyData();
			} else {
				this.getAllData();
			}
		},
		onLoad(query) {

			this.type = query.type
			this.id = query.id
			this.packid = query.packid
			this.$store.ready(state => {
				this.state = state
				this.userInfo = state.userInfo
			})

		}
	}
</script>

<style scoped>
	.content-box {
		width: 80vw;
		background: #fff;
		position: relative;
		border-radius: 6px;
		overflow: hidden;
	}

	.return-btn {
		padding: 10px 40px 10px 40px;

		text-align: center;
		color: #fff;
		font-size: 17px;
		font-family: PingFang SC;
		font-weight: 500;

		border-top: 1px solid #eee;

	}

	.btn {
		background: #2987EE;
		line-height: 44px;
		height: 44px;
		border-radius: 4px;
	}

	.exam-tab {
		display: block;
		width: 42px;
		padding: 0 8px;
		height: 24px;
		border-radius: 0 10px 10px 0;
		line-height: 24px;
		color: #fff;
		font-size: 14px;
		background: #2987EE;
	}

	.detail-top {
		background: #fff;
		padding: 2vh 0 1vh 0;
	}

	.detail-image {
		margin: 0 10px;
		height: 30vh;
		border-radius: 4px;
		background-size: cover;
		background-position: 50% 50%;
		box-sizing: border-box;
		position: relative;
		overflow: hidden;
	}

	.detail-title {
		text-align: center;
		font-size: 16px;
		color: #273035;
		margin-top: 1vh;
	}

	.detail-price {
		text-align: center;
		color: #787c82;
		line-height: 28px;
	}

	.detail-price text {
		font-size: 18px;
	}

	.detail-row {
		display: flex;
		line-height: 44px;
		height: 44px;
		border-top: 1px solid #eee;
		padding: 0 15px;
	}

	.detail-middle {
		background: #fff;
		margin-top: 2vh;
		font-size: 16px;
	}

	.detail-middle .van-row {
		padding: 1vh 0;
		border-bottom: 1px solid #eeeeee;
	}

	.item-right {
		text-align: right;
		font-size: 14px;
		color: #e6e9e6;
	}

	.detail-item {
		flex: 1;
		display: flex;
		justify-content: flex-end;
		color: #787c82;
		font-size: 14px;
	}

	.detail-bottom {
		margin-top: 2vh;
		background: #fff;
		padding: 15px;
		margin-bottom: 80px;
	}

	.bottom-title {
		font-size: 16px;
		color: #273035;
	}

	.detail-btn {
		height: 50px;
		line-height: 50px;
		text-align: center;
		position: fixed;
		bottom: 0;
		left: 0;
		width: 100%;
		color: #fff;
		font-size: 16px;
		background: #2987EE;
	}

	.detail__used {
		text-align: center;
		font-size: 12px;
		font-family: MicrosoftYaHei;
		font-weight: 400;
		color: rgba(43, 193, 82, 1);
		line-height: 20px;
	}

	/* zhifu */
	.pay-left {
		font-size: 14px;
		color: rgba(51, 51, 51, 1);
		line-height: 20px;
	}

	.pay-item {
		width: 90px;
		height: 44px;
		border: 1px solid #CCCCCC;
		margin-bottom: 20px;
		cursor: pointer;
		margin-right: 20px;
	}

	.curr-pay {
		border: 1px solid #F68439;
	}

	.pay-btnbox {
		margin: 20px 0 0 0;
		border-top: 1px solid #eee;
	}

	.pay-btn {
		height: 44px;
		border-radius: 4px;
		line-height: 44px;
		font-size: 16px;
		text-align: center;
		background: #F68439;
		color: #fff;
	}

	.vip-list {
		white-space: nowrap;
		overflow: auto;
		position: absolute;
		top: 60px;
		padding: 20px 0;
		color: #2f3133;
		text-align: center;
		font-size: 13px;
		width: 100%;
	}

	.vip-item {
		width: 30%;
		height: 100px;
		display: inline-block;
		margin-left: 20px;
		padding: 20px 15px;
		box-sizing: border-box;
		box-shadow: 0 1px 10px rgba(0, 0, 0, 0.15);
		border-radius: 5px;
		background: #fff;
	}

	.curr {
		color: rgb(255, 102, 61);
		box-shadow: 0 1px 10px rgba(255, 102, 61, 1);
	}

	.popup {
		font-size: 14px;
		color: #273035;
	}

	.popup-title {
		text-align: center;
		font-size: 16px;
	}

	.popup-item {
		color: #787c82;
		border-bottom: 1px solid #eee;
		padding: 1vh 0;
	}

	.vip-money {
		text-align: center;
		font-size: 20px;
		color: rgb(255, 102, 61);
		margin-top: 10px;
	}

	.money-pay input {
		background: none;
		outline: none;
	}
</style>
