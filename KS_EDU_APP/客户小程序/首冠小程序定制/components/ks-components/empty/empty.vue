<template>
	<view class="ks-empty" :class="type" :style="{background: 'url('+url+') no-repeat center 20%',
		backgroundSize: type=='tips'?'10%':'80%',paddingTop:type=='tips'?'20%':'80%'}">
		<text><slot /></text>
		<view class="refresh" v-if="type=='error'">
			<button class="mini-btn refresh-btn" type="primary" size="mini">刷新</button>
		</view>
		<view class="refresh" v-if="type=='login'">
			<button class="mini-btn login-btn" type="primary" size="mini" @click="open">我要登录</button>
		</view>
	</view>
</template>

<script>
	export default {
		name:'ks-empty',
		props:{
			
			//article内容页，list列表页，redenvelope红包页，coupon优惠券，nointernet没有网络，error错误，login未登录的
			type:{
				type:String,
				default:'list'
			}
		},
		data() {
			return {
				state:{},
				url:''
			};
		},
		methods:{
			open(){
				uni.navigateTo({
					url:'/pages/user/login/index'
				})
			}
		},
		mounted() {
			this.$store.ready(state=>{
				this.url = (this.type === 'article'&&state.SRC+'/Config/APP/static/common/images/common_nocontent.png?1.0')||
					(this.type === 'tips'&&state.SRC+'/Config/APP/static/common/images/tips.png?1.0')||
					(this.type === 'redenvelope'&&state.SRC+'/Config/APP/static/common/images/common_nopocket.png?1.0')||
					(this.type === 'coupon'&&state.SRC+'/Config/APP/static/common/images/common_nocoupon.png?1.0')||
					(this.type === 'nointernet'&&state.SRC+'/Config/APP/static/common/images/common_nonet.png?1.0')||
					(this.type === 'error'&&state.SRC+'/Config/APP/static/common/images/common_noconnect.png?1.0')||
					(this.type === 'list'&&state.SRC+'/Config/APP/static/common/images/common_nolist.png?1.0')||
					(this.type === 'login' &&state.SRC+'/Config/APP/static/common/images/common_nologin.png?1.0' )||
					state.SRC+'/Config/APP/static/common/images/common_nolist.png?1.0'
			})
		}
	}
</script>
<style scoped>
	.ks-empty{
		text-align: center;
		font-size: 14px;
		padding-top: 80%;
		color: #888888;
		margin-bottom: 20px;
		padding-bottom: 20px;
	}

	.login-btn{
		background: #ff663d;
		width: 120px;
		height: 36px;
		line-height: 36px;
		border-radius: 36px;
		font-size: 14px;
		margin-top: 35.5px;
	}
	.refresh-btn{
		margin-top: 19.5px;
		height: 28px;
		width: 74px;
		line-height: 28px;
		font-size: 14px;
		color: #3C81FA;
		background: #fff;
		border: 1px solid #3C81FA;
		box-sizing: border-box;
	}
</style>
