<template>
	<view class="main" v-if="load">
		<view class="title">提现金额</view>
		<view class="item">
			<view class="left">
				<view class="symbol">￥</view>
				<input class="money" placeholder="0.00" type="number" v-model="money" />
			</view>
			
			<view class="right" @click="money=data.ktx">全部提现</view>
		</view>
		<view class="tips">本次最多可提现{{data.ktx}}元</view>
		<view class="title">提现方式</view>
		<view class="item" @click="changeData(0)">
			<view class="left">
				<image class="left-image"  :src="baseUrl+'/static/images/my/common_icon_wechatpay.png'"></image>
				<text>微信支付</text>
			</view>
			<view class="right">
				<image class="right-image" :src="baseUrl+'/static/images/my/common_icon_select_s.png'" v-if="index==0"></image>
				<image class="right-image" :src="baseUrl+'/static/images/my/common_icon_select_n.png'" v-else></image>
			</view>
		</view>
		<view class="item" @click="changeData(1)">
			<view class="left">
				<image class="left-image"  :src="baseUrl+'/static/images/my/common_icon_alipay.png'"></image>
				<text>支付宝</text>
			</view>
			<view class="right">
				<image class="right-image" :src="baseUrl+'/static/images/my/common_icon_select_s.png'" v-if="index==1"></image>
				<image class="right-image" :src="baseUrl+'/static/images/my/common_icon_select_n.png'" v-else></image>
			</view>
		</view>
		<view class="item" @click="changeData(2)">
			<view class="left">
				<image class="left-image" :src="baseUrl+'/static/images/my/common_icon_bankcard.png'"></image>
				<text>银行打款</text>
			</view>
			<view class="right">
				<image class="right-image" :src="baseUrl+'/static/images/my/common_icon_select_s.png'" v-if="index==2"></image>
				<image class="right-image" :src="baseUrl+'/static/images/my/common_icon_select_n.png'" v-else></image>
			</view>
		</view>
		<view class="item" @click="changeData(3)">
			<view class="left">
				<text>转入我的账户</text>
			</view>
			<view class="right">
				<image class="right-image" :src="baseUrl+'/static/images/my/common_icon_select_s.png'" v-if="index==3"></image>
				<image class="right-image" :src="baseUrl+'/static/images/my/common_icon_select_n.png'" v-else></image>
			</view>
		</view>
		<view class="card" v-if="index!=3">
			<view  class="paddingtop17">{{title}}</view>
			<view class="card-bottom">
				<text>{{data.RealName}}</text>
				<text class="cardid">{{account}}</text>
			</view>
		</view>
		<view class="btn">
			<button class="btn-buttons"  v-if="Number(money)" @click="save()">提交申请</button>
			<button class="btn-buttonn"  v-else>提交申请</button>
		</view>
	</view>
</template>

<script>
	import {ApplyCash,ApplyDrawing} from 'api/user'
	export default{
		data(){
			return{
				baseUrl: this.$store.state.SRC + '/config/app',
				money:'',
				data:{},
				load:false,
				index:0,
				title:'',
				account:''
			}
		},
		methods:{
			save(){
				ApplyCash({
					flag:(this.index==0&&2)||(this.index==1&&1)||(this.index==2&&0)||(this.index==3&&3),
					money:this.money
				}).then(res=>{
					uni.showToast({
						title:res.msg,
						icon:'none'
					})
				})
			},
			changeData(i){
				if(i == 0){
					this.title = '微信支付'
					this.account = this.data.WeiPayNo
				}else if(i==1){
					this.title = '支付宝'
					this.account = this.data.AlipayNo
				}else if(i==2){
					this.title = this.data.BankName
					this.account = this.data.BankCard
				}
				this.index = i	
			},
			initData(){
				ApplyDrawing().then(res=>{
					this.data = res.data[0]
					this.title = '微信支付'
					this.account = this.data.WeiPayNo
					this.load = true
				})
			}
		},
		onLoad() {
			this.initData()
		}
	}
</script>

<style scoped>
	.paddingtop17{
		padding-top: 17px;
	}
	.main{
		min-height: 100vh;
		background: #fff;
		padding: 0 20px;
	}
	.title{
		font-size:16px;
		font-weight:500;
		color:rgba(26,26,26,1);
		padding-top: 30px;
	}
	.item{
		padding:12px 0;
		border-bottom: 1px solid #D9D9D9;
		display: flex;
		align-items: center;
		line-height: 1;
	}
	.left{
		display: flex;
		align-items: center;
	}
	.right{
		flex: 1;
		text-align: right;
		color:#ff663d;
	}
	.money{
		min-width: 100px;
		max-width: 160px;
		font-size:30px;
		font-weight:500;
		color:rgba(178,178,178,1);
		height: 36px;
		line-height: 36px;
	}
	.symbol{
		font-size:18px;
		font-weight:500;
		color:rgba(26,26,26,1);
	}
	.tips{
		font-size:12px;
		color:rgba(102,102,102,1);
		margin-top: 5px;
	}
	.left-image{
		width: 24px;
		height: 24px;
		margin-right: 5px;
	}
	.right-image{
		width: 18px;
		height: 18px;
	}
	.card{
		height:80px;
		background:#ff663d;
		border-radius:4px;
		margin: 20px 0 50px 0;
		padding: 0 15px;
		font-size:14px;
		color:rgba(255,255,255,1);
	}
	.btn {
		width: calc(100% - 20px);
		position: fixed;
		bottom: 0;
		left: 0;
		padding: 5px 10px;
		background: #fff;
		z-index: 99;
	}
	.btn-buttons{
		background:#FF9500;color:#fff;
	}
	.btn-buttonn{
		background:#B2B2B2;color:#fff;
	}
	button::after {
		border: 1px solid rgba(255, 255, 255, 1);
	}
	.card-bottom{
		margin-top: 10px;
		display: flex;
	}
	.cardid{
		text-align: right;flex: 1;
	}
</style>
