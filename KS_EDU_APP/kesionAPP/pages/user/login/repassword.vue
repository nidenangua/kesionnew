<template>
	<view class="uregister">
			<input type="number" v-model="password" placeholder="请设置您的密码" password />
			<view class="uregister-code">
				<input type="number" placeholder="重复上面的密码" v-model="rePassword" password />
			</view>
			<button class="uregister-next" :style="{background:status && '#FF9500'}" @click="next('/pages/user/login/index')">完成</button>
	</view>
</template>

<script>
	import {SendSmsCode,GetPassByMobile} from 'api/user'
	export default{
		name:'UserRegister',
		data(){
			return {
				/*密码*/
				password:'',
				/*再次输入*/
				rePassword:'',
				/*状态*/
				status:false,
				mobile:'',
				code:'',
			}
		},
		watch:{
			'rePassword'(value){
				if(value == this.password&&value){
					this.status = true
				}else{
					this.status = false
				}
			}
		},
		methods:{
			
			/*完成*/
			next(url){
				if(this.status){
					GetPassByMobile({
						passWord:this.password,
						repassword:this.rePassword,
						Code:this.code,
						UserName:this.mobile,
					}).then(res=>{
						if(res.result){
							uni.showToast({
								icon:'success',
								title: '重置成功'
							})
							uni.navigateTo({
							    url: url
							});
						}else{
							uni.showToast({
								title: res.msg
							})
						}
					})	
				}else{
					uni.showToast({
						icon:'none',
						title: '输入相同密码'
					})
				}
			}
		},
		onLoad (query) { 
		    this.mobile = query.mobile
			this.code = query.code
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
