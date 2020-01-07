<template>
	<view class="ulogin">
		<view class="ulogin-bg__blue">
			<view class="ulogin-position">
				<ks-image radius="15px" class="ks-image" type="logo" src="1"></ks-image>
				<view class="ulogin-box">
					<view class="ulogin-box__item">
						<image class="ulogin-box__icon" :src="baseUrl+'/static/images/login/sign_icon_account_s.png?1.0'"></image>
						<input class="ulogin-box__input" v-model="username" placeholder="用户名" />
					</view>
					<view class="ulogin-box__item">
						<image class="ulogin-box__icon" :src="baseUrl+'/static/images/login/sign_icon_password_s.png?1.0'"></image>
						<input class="ulogin-box__input" v-model="password" placeholder="密码" :password="pswStatus" />						
						<image class="ulogin-box__icon" style="margin-right: 5px;"  :src="pswStatus?baseUrl+'/static/images/login/sign_icon_hide@2x.png':baseUrl+'/static/images/login/sign_icon_show.png'" @click="pswStatus = pswStatus?false:true"></image>
					</view>
					<view class="ulogin-btn">
						<button style="background:#ff663d;color:#fff;cursor: pointer;" @click="login">登录</button>
					</view>
					<view class="ulogin-forget" >
						<navigator url="forgetcode" hover-class="none">忘记密码了</navigator>
					</view>
				</view>
				<view class="ulogin-register">
					还没有账户？
					<navigator url="registercode"><span>点此注册</span></navigator>
				</view>
			</view>
			
		</view>	
	</view>
</template>

<script>
	export default{
		name:'UserLogin',
		data(){
			return {
				username:'',
				password:'',
				pswStatus:true,
				baseUrl:this.$store.state.SRC+"/config/app"
			}
		},
		onLoad() {
			uni.setNavigationBarColor({
				frontColor:'#ff663d',
				backgroundColor:'#ff663d'
			})
		},
		methods:{
			login(){
				this.$store.dispatch('login',{
					username:this.username,
					password:this.password
				}).then(res=>{
					if(res.result){
						let pages = getCurrentPages()
						console.log(pages)
						let prevPage = pages[pages.length-2]
						console.log(prevPage.route)
						if(prevPage.route === 'pages/user/login/index'||prevPage.route === 'pages/user/login/modifypass'||prevPage.route === 'pages/user/login/register'||prevPage.route === 'pages/user/login/repassword'){
							uni.switchTab({
								url:'/pages/user/index'
							})
						}else if(prevPage.route === 'pages/web/web'){
							prevPage.$vm.refresh = false
							uni.navigateBack()
						}else{
							uni.navigateBack()
						}
						
						
					}else{
						uni.showToast({
							icon:'none',
							title: res.msg
						})
					}
				})	
			}
		}
	}
</script>

<style scoped>
	.ulogin{
		background:#F0F4F7;
		height: calc(100vh - 44px);
		position: relative;
	}
	.ulogin-bg__blue{
		height:240px;
		background:#ff663d;	
	}
	.ulogin-position{
		width: 100%;
		position: absolute;
		top: 35px;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;	
	}
	.ulogin-position .ks-image{
		width:100px;
		height:100px;
		background:rgba(255,255,255,1);
		box-shadow:0px 2px 2px 0px rgba(1,12,23,0.05);
		border-radius:15px;
		overflow: hidden;
	}
	.ulogin-box{
		background: #fff;	
		height:269px;	
		box-shadow:0px 2px 2px 0px rgba(1,12,23,0.05);
		border-radius:5px;
		width: calc(100% - 30px);		
		margin: 35px auto 0 auto;
		padding: 30px 18px 12px 18px;
		box-sizing: border-box;
	}
	.ulogin-box__item{
		margin-top: 10px;
		display: flex;
		align-items: center;
		background: #f6f6f6;
		height: 44px;
	}
	.ulogin-box__icon{
		width:30px;
		height: 30px;
		margin-left: 5px;
	}
	.ulogin-box__input{
		height: 28px;
		line-height: 28px;
		background: #f6f6f6;
		font-size: 14px;
		flex: 1;
	}
	.ulogin-btn{
		margin-top: 36px;
	}
	.ulogin-btn button{
		width: calc(100% - 100px);
		margin: 0 auto;
	}
	.ulogin-forget{
		font-size:14px;
		text-decoration:underline;
		color:rgba(102,102,102,1);
		text-align: center;
		margin-top: 10px;
	}
	.ulogin-register{
		font-size:14px;
		color:rgba(102,102,102,1);
		margin-top: 40px;
	}
	.ulogin-register navigator{
		display: inline-block;
	}
	.ulogin-register span{	
		font-size:14px;
		color:#ff663d;
	}
</style>
