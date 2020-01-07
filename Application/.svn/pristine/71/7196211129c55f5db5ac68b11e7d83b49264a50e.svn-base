<template>
	<!-- 领券中心 -->
	<div class="kd-coupon">
		<div class="kd-coupon__box">
			<el-row :gutter="20">
				<el-col :span="4" v-for="(item,i) in list" :key="i">
					<div class="kd-coupon__item" @click="getVoucher(item)">
						<ks-image :src="imageUrl" fit="cover"></ks-image>
						<div class="kd-coupon__text">
							<p><i>￥</i>{{item.money}}</p>
							<span v-if="item.term==0">满任意金额可用</span>
							<span v-else>满{{item.term}}元可用</span>
						</div>
						<div class="kd-coupon__receive" v-if="item.counts == item.number">
							已被领完
						</div>
						<div class="kd-coupon__receive" v-else-if="item.lqzt > 0">
							已经领取
						</div>
						<div class="kd-coupon__receive" v-else-if="item.lqzt == 0">
							立即领取
						</div>
					</div>
				</el-col>
			</el-row>
		</div>
	</div>
</template>

<script>
	import { getVoucherList } from "@/api/store"
	import { getVoucher } from "@/api/user"
	export default({
		name:"KdCoupon",
		data() {
			return {
				list: [],
				page: 1,
				pageCount: null,
				loaded: false,
				imageUrl:require('./common_bg_coupon2.png'),
			}
		},
		methods:{
			getVoucherList(p=1){
				this.$showLoading();
				this.page = p;
				this.loaded = false;
				if (p == 1) {
				  this.list = [];
				}
				let params = {
				  p: p,
				  maxperpage: 5
				};
				let _id = this.$route.query.id;
				if (_id) {
				  params.id = _id;
				}
				getVoucherList(params).then(res => {
					res.list.map(item => {
					  item.money = parseFloat(item.money).toString();
					});
					this.list = res.list
					this.pageCount = res.page.total_pages * 10;
					this.loaded = true;
					this.$hideLoading();	
				});
			},
			getVoucher(item){
				getVoucher({
				  id: item.id
				}).then(res => {
				  if (res.result === "success") {
				    this.$toast("领取成功","success");
				    item.lqzt += 1;
				  }
				});
			}
		},
		mounted() {
			this.getVoucherList()
		}
	})
</script>

<style scoped>
	.kd-coupon{
		width: 1160px;
		padding: 20px;
		margin: 0 auto;
		background: #fff;
	}
	.kd-coupon__box{
		width: 100%;
	}
	.el-col{
		width: 20%;
	}
	.kd-coupon__item{
		width: 100%;
		height: 104px;
		position: relative;
		cursor: pointer;
	}
	.ks-image{
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}
	.kd-coupon__text{
		position: absolute;
		top: 0;
		left: 0;
	}
	.kd-coupon__text p{
		font-size: 52px;
		color: #F21F3D;
		margin-top: 2px;
		margin-left: 20px;
	}
	.kd-coupon__text p i{
		font-style: normal;
		font-size: 16px;
	}
	.kd-coupon__text span{
		width: 135px;
		display: block;
		text-align: center;
		font-weight: 500;
		font-size: 20px;
		color: #808080;
		margin-left: 7px;
	}  
	.kd-coupon__receive{
		width: 44px;
		position: absolute;
		top: 17px;
		right: 20px;
		font-size: 22px;
		line-height:23px;
		color: #fff;
	}
</style>
