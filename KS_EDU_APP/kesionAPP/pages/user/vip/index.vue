<template>
	<view style="position: relative;">
		  <view class="vip-info">
			<view class='vip-username'>{{userInfo.UserName}},你好!</view>
			<view>
				<text>当前会员：{{data.level}}</text>
				<text style="margin-left:20px;" v-if="data.is_vip==1">有效截止时间:{{data.vip_enddate}}</text>
			</view>
		  </view>
		  <view class="vip-equity">
		    <view class="vip-equity__title">
		      <image mode="aspectFit"
		        style="width: 100%;"
		        :src="baseUrl+'/static/images/vip/me_vip_title.png'"
		      />
		    </view>
		
		    <view class="equity-list">
		      <view class="equity-item">
		        <image mode="aspectFit"
		          :src="baseUrl+'/static/images/vip/me_vip_icon1.png'"
		        />
		        <view >好课畅学</view>
		      </view>
		      <view class="equity-item">
		        <image mode="aspectFit"
		          :src="baseUrl+'/static/images/vip/me_vip_icon2.png'"
		        />
		        <view >会员折扣</view>
		      </view>
		      <view class="equity-item">
		        <image mode="aspectFit"
		          :src="baseUrl+'/static/images/vip/me_vip_icon3.png'"
		        />
		        <view >免费试题</view>
		      </view>
		      <view class="equity-item">
		        <image mode="aspectFit"
		          :src="baseUrl+'/static/images/vip/me_vip_icon4.png'"
		        />
		        <view >会员标识</view>
		      </view>
		    </view>
		  </view>
		  <view class="vip-list">
		  	<view class="vip-item" :class="{curr:i==active}" v-for="(item,i) in data.data" :key="i" @click="changeList(i,item)">
		  		<view style="line-height: 23px;">{{item.power_title}}</view>
				<view style="line-height: 32px;"><text style="font-size: 18px;">{{item.power_money}}</text>元</view>
		  	</view>
		  
		  </view>
		  <view class="vip-explain">
		    <view style="width: 100%;height: 65px;">
		      <image
			   mode="aspectFit"
		        style="width: 100%;height: 65px;"
		        :src="baseUrl+'/static/images/vip/me_vip_title2.png'"
		      />
		    </view>
		    <view class="explain-list" v-html="data.intro"></view>
		  </view>
		  <view class="vip-btn" @click="pay">
		    立即开通
		  </view>
		  <view class="vip-dialog" style="display: none">
		    <view class="dialog-box"></view>
		  </view>
		<uni-popup ref="popup" :show="show" type="bottom" @change="close">
			<view style="text-align: center;font-size:16px;font-weight:500;color:rgba(51,51,51,1);line-height:20px;">
				<text>支付金额：￥ {{payData.power_money}}</text>
				<image style="width: 15px;height: 15px;float: right;" :src="baseUrl+'/static/images/common/close.png'"  @click="show = false"></image>
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
							<input type="number" style="background: #fff;width: 80px;height:28px;color:#333" v-model="money"  />
							
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
			                  {{payData.power_money - money}}元
			              </text>
			          </view>
			        </view>
			        
			    <view class="pay-btnbox">
			      <view class="pay-btn"  @click="buyPackage(payData)">确认支付</view>
			    </view>
			</view>
		</uni-popup>
	</view>
</template>

<script>
	import {UniPopup} from 'components/uni/uni-popup/uni-popup'
	import {GetUserUpgradeVIP,PayUserUpgradeVIP} from 'api/user'
	export default {
		components:{
			UniPopup
		},
		data() {
			return {
				data:{},
				userInfo:{},
				active:0,
				payData:{},
				show:false,
				money:0,
				paymentList:[],
				activePay:-1,
				payId:0,
				vipId:'',
				baseUrl:this.$store.state.SRC+"/config/app"
			}
		},
		watch: {
		  money(money) {
		    if (money - this.payData.power_money >= 0) {
		      this.money = this.payData.power_money;
		      this.activePay = -1;
		      this.payId = 0;
		    }else{
		      this.activePay = 0;
		        this.payId = this.paymentList[0].payid;
		    }
		    if (money - this.userInfo.Money > 0) {
		      this.money = this.userInfo.money;
		    }
		    if (this.payData.power_money > this.userInfo.Money) {
		      if (this.activePay == -1) {
		        this.activePay = 0;
		        this.money = 0;
		        this.payId = this.paymentList[0].payid;
		      }
		    }
		  }
		},
		onLoad() {
			this.$store.ready(state=>{
				this.userInfo = state.userInfo
				this.getList()
			})
		},
		methods: {
			getList(){
				GetUserUpgradeVIP().then(res=>{
					this.data = res
					this.payData = this.data.data[0]
					this.paymentList = res.payment_list
					this.money = this.payData.power_money;
					this.vipId = res.data[0].power_id
				})
			},
			changeList(i,item){
				this.active = i
				this.payData = item
				this.vipId = item.power_id
				this.money = this.payData.power_money
			},
			pay(){
				this.show = true
			},
			close(e){
				this.show = e.show

			},
			buyPackage(){
				PayUserUpgradeVIP({
					usertype: this.vipId,
					payid: this.payId,
					user_pay_money: this.money,
				}).then(res=>{
					if(this.payId == 0){
					  if(res.result == true){  
						this.getList()
						  uni.showToast({
						  	title: '升级会员成功',
						  	icon:'none'
						  });
						  this.show = false
							
					  }
					}else{
					  if(res.result == false){
						  uni.navigateTo({
						  	url:'/pages/payment/payment?orderid='+res.orderid+'&ordertype='+res.ordertype
						  })
					
					  }
					}
				})
			},
			/**选择支付类型 */
			payType(i) {
			  this.activePay = i;
			  if (i == -1) {
			    this.payId = "0";
			    this.money = this.payData.power_money;
			  } else {
			    this.money = 0;
			    this.payId = this.paymentList[i].payid;
			  }
			}
		}
	}
</script>

<style scoped>
	.vip-info {
	    font-size: 13px;
	    color: #fff;
	    padding-left: 12px;
	    background: rgb(222, 188, 145);
	    height: 140px;
	    position: relative;
	}
	.vip-username {
	  font-size: 18px;
	  padding: 10px 0 6px 0;
	}

	.vip-equity {
	  margin: 70px 10px 0 10px;
	  border-radius: 10px;
	}
	.vip-equity__title{
		width: 100%;
		height: 65px;
	}
	.vip-equity__title image{
		width: 100%;
		height: 65px;
	}
	.equity-list {
	  width: 100%;
	  background: #fff;
	  padding-top: 10px;
	  margin-top: -10px;
	  border-radius: 0 0 10px 10px;
	  display: flex;
	  color: #787c82;
	  font-size: 12px;
	}
	.equity-item {
		display: flex;
		flex-direction: column;
	  text-align: center;
	  width: 25%;
	  padding: 10px 10px 20px 10px;
	  overflow: hidden;
	  justify-content: space-between;
	  align-items: center;
	  height: 85px;
	}
	.equity-item image{
		width: 55px;
		height: 55px;
	}
	
	.vip-explain {
	  margin: 20px 10px 0 10px;
	  border-radius: 10px;
	  color: #787c82;
	}
	.explain-list {
	  background: #fff;
	  border-radius: 0 0 10px 10px;
	  color: #787c82;
	  padding: 10px 20px 20px 20px;
	  margin-top: -10px;
	  line-height: 2;
	  margin-bottom: 80px;
	  font-size: 12px;
	}
	.vip-btn {
	  width: 100%;
	  height: 50px;
	  background: rgb(222, 188, 145);
	  text-align: center;
	  color: #fff;
	  font-size: 16px;
	  line-height: 50px;
	  position: fixed;
	  bottom: 0;
	  left: 0;
	  cursor: pointer;
	}
	.vip-dialog {
	  width: 100%;
	  height: 100vh;
	  position: fixed;
	  top: 0;
	  left: 0;
	  background: rgba(0, 0, 0, 0.4);
	  z-index: 1000;
	}
	.dialog-box {
	  position: fixed;
	  bottom: 0;
	  width: 100%;
	  border-radius: 10px 10px 0 0;
	  background: #fff;
	}
	
	
	.money-pay input {
	  background: none;
	  outline: none;
	}
	.pay-left {
	  font-size:14px;
	  color:rgba(51,51,51,1);
	  line-height:20px;
	}

	.pay-item {
	  width: 90px;
	  height: 44px;
	  border: 1px solid #CCCCCC;
	  margin-bottom: 1rem;
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
	  color:#fff;
	}
	.vip-list{
		white-space :nowrap;
		overflow:auto;
		position: absolute;
		top: 60px;
		padding: 20px 0;
		color: #2f3133;
		text-align: center;
		font-size: 13px;
		width: 100%;
	}
	.vip-item{
		width: 30%;
		height: 100px;
		display: inline-block;
		margin-left: 20px;
		padding: 20px 15px;
		box-sizing: border-box;
		box-shadow: 0 1px 10px rgba(0,0,0,0.15);
		border-radius: 5px;
		background: #fff;
	}
	.curr {
	  color: rgb(255, 102, 61);
	  box-shadow: 0 1px 10px rgba(255, 102, 61, 1);
	}
	.popup {
	  font-size: 0.7rem;
	  color: #273035;
	}
	.popup-title {
	  text-align: center;
	  font-size: 0.8rem;
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
