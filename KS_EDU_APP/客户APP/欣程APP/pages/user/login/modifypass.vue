<template>
	<view class="uregister">
		<input type="number" v-model="oldpassword" placeholder="请输入旧密码" password />
		<view class="uregister-code">
			<input type="number" v-model="password" placeholder="请输入新密码" password />
			</view>
			<view class="uregister-code">
				<input type="number" placeholder="重复新密码" v-model="rePassword" password />
			</view>
			<button class="uregister-next" :style="{background:status && '#FF9500'}" @click="next('/pages/user/login/index')">完成</button>
	</view>
</template>

<script>
	import {ModifyPass} from 'api/user'
	export default{
		data(){
			return {
				oldpassword:'',
				/*密码*/
				password:'',
				/*再次输入*/
				rePassword:'',
				/*状态*/
				status:false,
				mobile:''
			}
		},
		watch:{
			'rePassword'(value){
				if(value == this.password){
					this.status = true
				}
			}
		},
		methods:{
			
			/*完成*/
			next(url){
				if(this.status){
					ModifyPass({
						oldpass: this.oldpassword,
						password: this.password,
						repassword: this.rePassword,
					}).then(res=>{
						if(res.result){
							uni.showToast({
								icon:'success',
								title: '修改成功'
							})
							setTimeout(()=>{
								this.$store.dispatch('getUserInfo').then(_=>{
									uni.navigateTo({
										url:'/pages/user/login/index'
									})
								})
							},2000)
							
							
						}else{
							uni.showToast({
								title: res.msg,
								icon:'none'
							})
						}
					})	
				}else{
					uni.showToast({
						title: '密码输入不一致',
						icon:'none'
					})
				}
			}
		},
		onLoad (query) { 
		    this.mobile = query.mobile
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

