<template>
	<div class="myvip">
		<!-- 头部分页区 -->
		<div class="myvip-top">
			<h1>我的折扣卡</h1>
			<div class="myvip-top__box">
				<div class="myvip-top__tab">
					<span :class="{active:tab==0}" @click="showTab(0)">折扣卡中心</span>
					<!-- <span :class="{active:tab==1}" @click="showTab(1)">已拥有的会员卡</span> -->
				</div>
			</div>
		</div>
		<!-- 内容区 -->
		<div class="myvip-list" v-if="groupList.length">
			<el-row :gutter="140" >
				<el-col :span="12" v-for="item in groupList" :key="item.id">
					<div class="myvip-list__box">
						<div class="myvip-list__image" :style="{backgroundImage:'url(' + item.defaultpic + ')'}">
							<img v-if="item.hasbuy == 1" src="../../assets/user/me_icon_own.png" />
							<div
							class="discount"
							v-if="item.other == 1"
							>*享受其他优惠</div>
							<div class="discount" v-else>*不享受其他优惠</div>
							<div class="name">{{item.name}}</div>
							<div class="price" v-if="item.hasbuy == 1">
							{{item.type==2 ?`全站免费` : `全场${item.discount}折优惠`}}
							<br>
							有效期至：{{item.expiretime}}
							</div>
							<div class="price" v-else>
							{{item.type==2 ?`全站免费` : `全场${item.discount}折优惠`}}
							<br>
							￥{{item.price}} / {{item.effectivemonth}}个月
							</div>
							<div class="myvip-list__detailintro">
								<h4>会员卡简介：</h4>
								<div class="intro">
								1、购买该卡后，有效期为{{item.effectivemonth}}个月
								<br>
								2、该会员卡享{{ (item.type == 2 || item.discount == 0) ?  `全站免费` : `全场${item.discount}折优惠`}}
								<br>
								3、使用该卡{{item.type == 2 ? `不限消费额度` : `消费额度最高${item.costlevel}元，超出后不享受该优惠`}}
								</div>
							</div>
						</div>
						<p v-if="Number(item.price) > 0">售价：<span class="ks-color--error">￥{{item.price}}</span></p>
						<p v-else><span class="ks-color--success">免费</span></p>
						<el-button size="medium" round type="primary" v-if="item.hasbuy == 0" @click="cardPay(item.id,item.price)">立即开通</el-button>
						<el-button disabled size="medium" round v-else-if="item.hasbuy == 1">已开通</el-button>
						<h2 v-if="item.hasbuy == 1">有效期至：<i>{{item.expiretime}}</i></h2>
						<h2 v-else></h2>
					</div>	
					
				</el-col>
			</el-row>
		</div>
		<ks-empty msg="该分类下暂无会员卡信息" v-else />
		<!-- <el-pagination background layout="prev, pager, next" :page-count="pageCount" @current-change="getCardList" v-if="pageCount>0" /> -->
	</div>
</template>

<script>
	import userCardMixin from '@/mixins/user/user.card'
	import { getUserCards } from "@/api/user"
	export default({
		name:"MyVip",
		mixins:[userCardMixin],
		data() {
			return {
				tab:0,//默认显示全部
			}
		},
		methods:{
			/*
			* 切换分页
			*/
			showTab(i){
				this.tab = i
			}
		},
		mounted() {
			this.getCardList()
		}
	})
</script>

<style scoped>

	.myvip-top{
		width: 100%;
		border-bottom: 1px solid #eee;
	}
	.myvip-top h1{
		font-size: 20px;
		color: #2D3336;
		font-weight: 400;
		padding: 21px 24px;
	}
	.myvip-top__box{
		height: 44px;
		width: 100%;
		position: relative;
	}
	.myvip-top__tab{
		height: 44px;
		line-height: 44px;
		position: absolute;
		top: 0;
		left: 0;
	}
	.myvip-top__tab span{
		display: inline-block;
		height: 100%;
		text-align: center;
		margin-left: 40px;
		font-size: 16px;
		color: #585E61;
		cursor: pointer;
	}
	.active{
		border-bottom: 2px solid #2E84EE;
		color: #2E84EE !important;
	}
	/* 内容区 */
	.myvip-list{
		padding: 0 90px 40px 90px;
	}
	.myvip-list__box{
		padding-top: 30px;
		text-align: center;
	}
	.myvip-list__image{
		height: 190px;
		width: 100%;
		border-radius:10px;
		overflow: hidden;
		position: relative;
		cursor: pointer;
		background-size: cover;
	}

	.myvip-list__detailintro{
		width: 100%;
		height: 100%;
		box-sizing: border-box;
		padding: 20px 30px;
		position: absolute;
		top: 0;
		display: none;
		background: rgba(0,0,0,0.6);
		color: #fff;
		font-size: 14px;
		text-align: left;
		line-height: 2;
	}
	.myvip-list__detailintro h4 {
	  font-size: 16px;
	  font-weight: normal;
	}
	.myvip-list__detailintro .intro {
	  font-size: 14px;
	  color: #fff;
	}
	.myvip-list__image:hover .myvip-list__detailintro{
		display: block;
	}
	.myvip-list__image img{
		position: absolute;
		top: 0;
		z-index: 2;
		left: 0;
	}
	.myvip-list__image .ks-image{
		position: absolute;
		top: 0;
		height: 100%;
		width: 100%;
		background:linear-gradient(90deg,rgba(213,193,176,1),rgba(175,154,136,1));
		z-index: 1;
	}
	.myvip-list__box p{
		margin: 10px 0;
		color: #929A9E;
		font-size: 14px;
	}
	
	.myvip-list__box h2{
		color: #929A9E;
		font-size: 14px;
		margin-top: 10px;
		height: 21px;
		line-height: 21px;
		font-weight: normal;
	}
	.myvip-list__box h2 i{
		color: #2E84EE;
		font-style: normal;
		
	}

	.myvip-list__image::after {
	  content: "";
	  width: 60px;
	  height: 60px;
	  background: url(../../assets/user/card-icon.png) no-repeat;
	  background-size: 100%;
	  position: absolute;
	  bottom: 10px;
	  right: 15px;
	}
	.myvip-list__image .discount {
	  text-align: right;
	  margin-top: 10px;
	  margin-right: 10px;
	  color: rgba(255, 255, 255, 0.7);
	}
	.myvip-list__image .name {
	  font-size: 20px;
	  line-height: 32px;
	  color: #fff;
	  background-repeat: no-repeat;
	  background-position: 0 6px;
	  background-image: url(../../assets/user/v1.png);
	  padding-left: 34px;
	  background-size: auto 24px;
	  text-align: left;
	  margin-left: 30px;
	}
	.myvip-list__image .price {
	  color: rgba(255, 255, 255, 0.7);
	  font-size: 14px;
	  line-height: 24px;
	  position: absolute;
	  bottom: 20px;
	  left: 20px;
	  text-align: left;
	}


</style>
