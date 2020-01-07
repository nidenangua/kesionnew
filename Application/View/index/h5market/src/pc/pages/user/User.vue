<template>
	<div class="user">
		<div class="user-box">
			<div  class="user-left">
				<div class="user-left__userName">
					<ks-image :src="$store.state.userInfo.headimg" type="user"  @click="showMenu('/user/basicsettings')" />
					<span v-if="$store.state.isLogin == 1"  @click="showMenu('/user/basicsettings')">{{$store.state.userInfo.name}}</span>
					<span v-else>请登录</span>
				</div>
				<div class="user-left__item">
					<div class="user-left__title">
						<img src="../../assets/user/me_icon_learn.png" />
						<span>学习中心</span>
					</div>
					<div class="user-left__menu" :class="{activeMenu:$route.name==='MyCourse'}" @click="showMenu('/user/course')">我的课程</div>
					<div class="user-left__menu" :class="{activeMenu:$route.name==='MyColumn'}" @click="showMenu('/user/column')">我的专栏</div>
					<!-- <div class="user-left__menu" :class="{activeMenu:menu==2}" @click="showMenu(2)">我的社群</div> -->
				</div>
				<div class="user-left__item">
					<div class="user-left__title">
						<img src="../../assets/user/me_icon_account.png" />
						<span>账户中心</span>
					</div>
					<div class="user-left__menu" :class="{activeMenu:$route.name==='MyOrder'}" @click="showMenu('/user/order')">我的订单</div>
					<div class="user-left__menu" :class="{activeMenu:$route.name==='UserVip'}" @click="showMenu('/user/vip')">升级会员</div>
					<!-- <div class="user-left__menu" :class="{activeMenu:$route.name==='shopcar'}" @click="showMenu('/user/shopcar')">购物车</div> -->
					<div class="user-left__menu" :class="{activeMenu:$route.name==='MyVip'}" @click="showMenu('/user/card')">我的折扣卡</div>
					<div class="user-left__menu" :class="{activeMenu:$route.name==='MyCoupon'}" @click="showMenu('/user/coupon')">我的优惠券</div>
				</div>
				<div class="user-left__item">
					<div class="user-left__title">
						<img src="../../assets/user/me_icon_serve.png" />
						<span>服务中心</span>
					</div>
					<div class="user-left__menu" :class="{activeMenu:$route.name==='CouponHome'}" @click="showMenu('/user/couponhome')">领券中心</div>
					<div class="user-left__menu" :class="{activeMenu:$route.name==='GiftRecord'}" @click="showMenu('/user/giftrecord')">赠送记录</div>
					<!-- <div class="user-left__menu" :class="{activeMenu:$route.name==='MyDistribution'}" @click="showMenu(8,'/user/distribution')">我的分销</div> -->
					<div class="user-left__menu" :class="{activeMenu:$route.name==='BasicSettings'}" @click="showMenu('/user/basicsettings')">基本设置</div>
					<div class="user-left__menu" :class="{activeMenu:$route.name==='Announcement'}" @click="showMenu('/user/announcement')">消息公告</div>
				</div>
			</div>
			<div class="user-right" v-if="$store.state.isLogin == 1">
				<keep-alive>
					<router-view></router-view>
				</keep-alive>
			</div>
			<div class="user-right" v-else>
				<div class="user-right__logintip">
					<p>您还没有登录哦，请先登录</p>
					<el-button type="primary" @click="$showLogin()">立即登录</el-button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import {getUserInfo} from '@/api/user'
	export default({
		name:"User",
		methods:{
			/*
			* 切换菜单显示
			*/
			showMenu(url){
				this.$router.push(url)
			}
		}
	})
</script>

<style scoped>
	.user-box{
		width: 1200px;
		margin: 30px auto 0 auto;
		overflow: hidden;
	}
	.user-left{
		width: 216px;
		background: #fff;
		margin-right: 24px;
		float: left;
	}
	.user-left__userName{
		padding: 0 20px;
		padding-top: 20px;
		height: 140px;
		background: url(../../assets/user/me_bg.png) no-repeat center center;
		background-size: cover;
		position: relative;
		border-bottom: 1px solid #eee;
	}
	.user-left__userName .ks-image{
		width: 80px;
		height: 80px;
		border-radius: 50%;
		overflow: hidden;
		margin:0 auto;
		cursor: pointer;
	}
	.user-left__userName span{
		display: block;
		height: 24px;
		line-height: 24px;
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
		margin:0 auto;
		top: 117px;
		text-align: center;
		font-size: 16px;
		color: #585E61;
		margin-top: 10px;
		cursor: pointer;
	}
	.user-left__item{
		width: 100%;
	}
	.user-left__title{
		height: 52px;
		width: 100%;
		line-height: 52px;
		font-size: 16px;
		color: #585E61;
	}
	.user-left__title img{
		margin-left: 24px;
		margin-right: 2px;
		margin-bottom: -3px;
	}
	.user-left__menu{
		height: 44px;
		line-height: 44px;
		padding-left: 48px;
		font-size: 14px;
		color: #929A9E;
		cursor: pointer;
	}
	.activeMenu{
		background: #FAFAFA;
		color: #2E84EE;
	}
	/* 右边部分 */
	.user-right{
		width: 960px;
		background: #fff;
		float: right;
		overflow: hidden;
		padding-bottom: 30px;
	}
	
	.user-right__logintip{
		padding: 100px 0;
		text-align: center;
		font-size: 16px;
	}
	.user-right__logintip .el-button{
		margin-top:30px;
	}
</style>
