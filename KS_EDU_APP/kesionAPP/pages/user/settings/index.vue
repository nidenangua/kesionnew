<template>
	<view class="ba">
		<ks-cell-group>
			<ks-cell line label="个人资料" @click="open('/pages/user/settings/basicinfo')" show-arrow></ks-cell>
			<ks-cell line label="修改密码" @click="open('/pages/user/login/modifypass')" show-arrow></ks-cell>
			<ks-cell label="关于我们" @click="open('/pages/user/settings/about')" show-arrow></ks-cell>
		</ks-cell-group>

		<view class="ulogin-out">
			<button class="button--plain" @click="loginOut">退出登录</button>
		</view>
		
	</view>
</template>

<script>
	import {LoginOut} from 'api/user'
	export default {
		data() {
			return {
				userId:''
			}
		},
		onLoad() {
			this.$store.ready(state=>{
				this.userId = state.userId
			})
		},
		onShow(){
	
		},
		methods: {
			open(url){
				uni.navigateTo({
					url:url
				})
			},
			loginOut(){
				uni.showModal({
				    title: '提示',
				    content: '确定要退出吗？',
				    success: res=> {
				        if (res.confirm) {
							this.$store.dispatch('loginout').then(res=>{
								uni.switchTab({
									url:'/pages/user/index'
								})
							})
				            
				        }
				    }
				});
				
				
			}
			
		}
	}
</script>

<style scoped>
	.user-list{
		background: #fff;
	}
	.user-item{
		padding:14px 10px 14px 15px;
		font-size:16px;
		color:rgba(26,26,26,1);
		border-top: 1px solid #eee;
	}
	.user-item image{
		width:15px;
		height:15px;
	}
	.ulogin-out{
		padding: 40px 20px;
	}
		
	.ulogin-out uni-button[plain]{
		color:#2987EE;
		border: 1px solid #2987EE;
	}
</style>

