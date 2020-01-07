<template>
	<view class="main-box" >

		<view class="main">
			<view class="item">
				<view class="title">开户银行名称</view>
				<input v-model="name" placeholder="开户银行" class="text" />
			</view>
			<view class="item">
				<view class="title">开户人姓名</view>
				<input v-model="realName" placeholder="请输入真实姓名" class="text" />
			</view>
			<view class="item">
				<view class="title">银行卡号</view>
				<input v-model="bankId" type="number" placeholder="请输入银行卡号" class="text" />
			</view>
			<view class="item">
				<view class="title">支付宝账号</view>
				<input v-model="aliId" placeholder="请输入支付宝账号" class="text" />
			</view>
			<view class="item">
				<view class="title">微信支付账号</view>
				<input v-model="wechatId" placeholder="请输入微信支付账号" class="text" />
			</view>
		</view>
		<view class="btn">
			<button class="btn-buttons" v-if="name&&realName&&bankId&&aliId&&wechatId" @click="save()">保存设置</button>
			<button class="btn-buttonn" v-else>保存设置</button>
		</view>

	</view>
</template>

<script>
	import {ApplyDrawing,ApplyDrawingSave} from 'api/user'
	export default {
		data() {
			return {
				name: '',
				realName: '',
				bankId: '',
				aliId: '',
				wechatId: '',
				
			}
		},
		watch: {
			bankId(val) {
				if (val.length == 3 || val.length == 8 || val.length == 13 || val.length == 18) {
					this.bankId = val + ' ';
				}
				if (val.length >= 24) {
					this.bankId = val.slice(0, 22)
				}
			}
		},
		methods: {
			save(){
				ApplyDrawingSave({
					bankname:this.name,
					realname:this.realName,
					bankcard:this.bankId,
					alipayno:this.aliId,
					weipayno:this.wechatId
				}).then(res=>{
					if(res.result){
						uni.showToast({
							title:'保存成功'
						})
					}
				})
			}
		},
		onLoad(){
			
			ApplyDrawing().then(res=>{
				if(res.result){
					this.name = res.data[0].BankName
					this.realName = res.data[0].RealName
					this.bankId = res.data[0].BankCard
					this.aliId = res.data[0].AlipayNo
					this.wechatId = res.data[0].WeiPayNo
				}
			})
		}
	}
</script>

<style scoped>
	
	.main-box{
		background: #fff;height: 100vh;
	}
	.main {
		padding: 0 20px 70px 20px;
	}

	.item {
		padding: 30px 0 15px 0;
		line-height: 1;
		border-bottom: 1px solid #D9D9D9;
	}

	.title {
		font-size: 16px;
		font-weight: 500;
		color: rgba(26, 26, 26, 1);
	}

	.text {
		margin-top: 20px;
		font-size: 14px;
		font-weight: 400;
		color: rgba(178, 178, 178, 1);

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

	button::after {
		border: 1px solid rgba(255, 255, 255, 1);
	}
	.btn-buttons{
		background:#ff663d;color:#fff;
	}
	.btn-buttonn{
	 	background:#B2B2B2;color:#fff;
	}
</style>
