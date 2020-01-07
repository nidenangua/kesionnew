<template>
	<view class="uregister">
			<input type="number" v-model="mobile" placeholder="请输入您的手机号" />
			<view class="uregister-code">
				<input type="number" placeholder="验证码" v-model="smsCode" />
				<button :style="{background: sandStatus && '#B2B2B2'}" @click="sendCode">{{sandStatus?`${second}s后重新发送`:'发送验证码'}}</button>
			</view>
			<button class="uregister-next" :style="{background:nextStatus && '#FF9500'}" @click="next(`/pages/user/login/register?mobile=${mobile}`)">下一步</button>
	</view>
</template>

<script>
	import {SendSmsCode} from 'api/user'
	export default{
		name:'UserRegister',
		data(){
			return {
				/*手机号*/
				mobile:'',
				/*下一步*/
				nextStatus:false,
				/*发送验证码*/
				sandStatus:false,
				/*倒计时*/
				second:0,
				/*验证码*/
				code:'',
				/*输入验证码*/
				smsCode:'',
			}
		},
		watch:{
			'smsCode'(value){
				if(value == this.code && value){
					this.nextStatus = true
				}else{
					this.nextStatus = false
				}
			}
		},
		methods:{
			/*发送二维码*/
			sendCode(){
				if(!this.sandStatus){
					SendSmsCode({
						mobile:this.mobile
					}).then(res=>{
						this.code = res.code
						if(res.result){
							uni.showToast({
								icon:'success',
								title: '发送成功'
							})
							this.sandStatus = true
							this.second = res.seconds
							setInterval(()=>{
								if(this.second > 0){
									this.second--
								}else{
									this.sandStatus = false
									clearInterval()
								}
							},1000)
						}else{
							uni.showToast({
								title: res.msg,
								icon:'none'
							})
						}
					})	
				}
				
			},
			/*下一步*/
			next(url){
				if(this.nextStatus){
					uni.redirectTo({
					    url: url
					});
				}else{
					uni.showToast({
						title: '验证码错误',
						icon:'none'
					})
				}
			}
		}
	}
</script>

<style scoped>
	.uregister{
		height: calc(100vh - 44px);
		padding: 20px;
		box-sizing: border-box;
		background: #fff;
	}
	.uregister input{
		height: 48px;
		line-height: 48px;
		background: #f6f6f6;
		font-size: 16px;
		flex: 1;
		padding-left: 5px;
		box-sizing: border-box;
	}
	.uregister-code{
		display: flex;
		margin-top: 20px;
		align-items: flex-end;
	}
	.uregister-code button{
		margin-left: 10px;
		background: #FF9500;
		color:#fff;
	}
	.uregister-next{
		background: #B2B2B2;
		color:#fff;
		width: 210px;
		margin: 35px auto;
	}

</style>
