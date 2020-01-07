<template>
	<div class="myCoupon">
		<!-- 头部分页区 -->
		<div class="myCoupon-top">
			<h1>我的优惠券</h1>
			<div class="myCoupon-top__box">
				<div class="myCoupon-top__tab">
					<span :class="{active:type==0}" @click="slideTab(0)">可使用</span>
					<span :class="{active:type==1}" @click="slideTab(1)">已使用</span>
					<span :class="{active:type==3}" @click="slideTab(3)">已过期</span>
				</div>
				<!-- <div class="myCoupon-top__input">
					<p>兑换</p>
					<input type="number" placeholder="请输入优惠码" />					
				</div> -->
			</div>
		</div>
		<!-- 内容区 -->
		<div class="myCoupon-list">
			<el-row :gutter="92" >
				<el-col :span="12" v-for="(item,i) in list" :key="i">
					<div class="myVip-list__box" :class="{bg:type != 0 }">
						<div class="myVip-list__top">
							<div class="myVip-list__left">
								¥<span>{{item.money}}</span>
							</div>
							<div class="myVip-list__right">
								<h2>{{item.title}}</h2>
								<h3 v-if="item.awarddate==0">无使用时间限制</h3>
								<h3 v-else-if="item.awarddate==1">{{item.time}}</h3>
								<p v-if="item.term==0">满任意金额可用</p>
								<p v-else>满￥{{item.term}}元可用</p>
								<span v-if="item.isuse == 0" @click="goUse(item)">去使用</span>
							</div>
						</div>
						<div class="myVip-list__bottom">
							<p v-if="item.infoid != 0">限{{voucherTypeName(item.type)}}《{{item.infotitle}}》可用</p>
              				<p v-else>全站通用</p>
						</div>
					</div>
				</el-col>
			</el-row>
		</div>
		<div style="text-align: center;" >
			<el-pagination background layout="prev, pager, next" :total="pageCount" @current-change="getList" v-if="pageCount>0" />
			<ks-empty msg="该分类下暂无优惠券" v-else />
		</div>
	</div>
</template>

<script>
	import { getUserVouceher } from "@/api/user"
	import { getViewRoute, getTypeName } from "@/utils"
	export default {
	  name: "MyCoupon",
	  data() {
	    return {
	      list: [],
	      type: 0,
	      tab: {
	        current: 0,
	        options: ["全部", "已过期"],
	        values: [0, 3]
	      },
	      page: 1,
	      pageCount: null,
	      loaded: false,
		  count: 0,
	    };
	  },
	  methods: {
		/**
		 * 去使用优惠券
		 */
		goUse(item) {
			if(item.infoid == 0){
				this.$router.push({
					name:'CourseList'
				})
			}else{
				let route = getViewRoute(item, "infoid");
				this.$router.push(route);
			}
			
		},
	    /**
	     * 选项卡切换
	     */
	    slideTab(val) {
	      this.type = val;
	      this.getList();
	    },
	    /**
	     * 获取优惠券列表
	     */
	    getList(p = 1) {
	      this.$showLoading();
	      this.page = p;
	      this.loaded = false;
	      if (p == 1) {
	        this.list = [];
	      }
	      getUserVouceher({
	        type: this.type,
	        p: p,
	        maxperpage: 6
	      }).then(res => {
	        res.list.map(item => {
	          item.money = parseFloat(item.money).toString();
	        });
	        this.list = res.list;
			if(this.type == 0){
				this.count = res.list.length
			}
	        this.pageCount = res.page.total_pages * 10;
	        this.loaded = true;
	        this.$hideLoading();
	      });
		},
		voucherTypeName(type) {
			return getTypeName(type);
		}
	  },
	  activated() {
	    this.getList();
	  }
	}
</script>

<style scoped>
	.myCoupon{
		width: 100%;
	}
	.myCoupon-top{
		width: 100%;
		border-bottom: 1px solid #eee;
	}
	.myCoupon-top h1{
		font-size: 20px;
		color: #2D3336;
		font-weight: 400;
		padding: 21px 24px;
	}
	.myCoupon-top__box{
		height: 44px;
		width: 100%;
		position: relative;
	}
	.myCoupon-top__tab{
		height: 44px;
		line-height: 44px;
		position: absolute;
		top: 0;
		left: 0;
	}
	.myCoupon-top__tab span{
		display: inline-block;
		min-width: 64px;
		height: 100%;
		text-align: center;
		margin-left: 40px;
		font-size: 16px;
		color: #585E61;
		cursor: pointer;
	}
	.myCoupon-top__tab i{
		display: inline-block;
		width: 1px;
		height: 20px;
		background: #ddd;
		margin-left: 40px;
		margin-bottom: -5px;
	}
	.active{
		border-bottom: 2px solid #2E84EE;
		color: #2E84EE !important;
	}
	.myCoupon-top__input{
		float: right;
		height: 32px;
		margin-top: 5px;
	}
	.myCoupon-top__input input{
		width: 195px;
		height: 32px;
		outline: none;
		border: 1px solid #eee;
		padding-left: 10px;
		float: right;
	}
	.myCoupon-top__input input::placeholder{
		color: #A1A4A6;
		font-size: 14px;
	}
	.myCoupon-top__input p{
		display: inline-block;
		width: 57px;
		height: 32px;
		background: #CCCCCC;
		line-height: 32px;
		text-align: center;
		font-size: 14px;
		color: #fff;
		margin-right: 20px;
		float: right;
	}
	/* 内容区 */
	.myCoupon-list{
		padding: 0 80px 40px 80px;
		color: #fff;
	}
	.myVip-list__box{
		width: 100%;
		height: 136px;
		background: url(../../assets/user/me_bg_coupon.png);
		margin-top: 30px;
	}
	.bg{
		background: url(../../assets/user/me_bg_coupon_o.png);
	}
	.myVip-list__top{
		width: 100%;
		height: 106px;
	}
	.myVip-list__left{
		width: 106px;
		height: 106px;
		text-align: center;
		line-height: 106px;
		font-size: 20px;
		float: left;
	}
	.myVip-list__left span{
		font-size: 36px;
		margin-left: 5px;
	}
	.myVip-list__right{
		width: 232px;
		padding-right: 16px;
		height: 106px;
		float: left;
	}
	.myVip-list__right h2{
		font-size: 16px;
		font-weight: 400;
		margin-top: 10px;
	}
	.myVip-list__right h3{
		font-size: 12px;
		font-weight: 400;
		margin-top: 10px;
	}
	.myVip-list__right p{
		font-size: 12px;
		margin-top: 6px;
	}
	.myVip-list__right span{
		display: inline-block;
		width: 46px;
		height: 18px;
		border: 1px solid #fff;
		color: #fff;
		line-height: 18px;
		text-align: center;
		font-size: 12px;
		border-radius:4px;
		float: right;
		cursor: pointer;
	}
	.myVip-list__bottom{
		height: 30px;
		padding-left: 16px;
		line-height: 30px;
		font-size: 12px;
		color: #A1A4A6;
	}
	.myVip-list__bottom p {
		overflow: hidden;
  		white-space:nowrap;
  		text-overflow:ellipsis;
	}
</style>
