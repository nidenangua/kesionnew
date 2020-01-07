<template>

		<view class="coupon-box">
			<view class="coupon-item" v-for="(item,i) in list" :key="i">
				<view class="coupon-left">
					<text style="font-size: 14px;">￥</text>{{item.price}}
				</view>
				<view class="coupon-right" style="color:#B2B2B2;font-size:12px;padding-left: 15px;box-sizing: border-box;">
					<view style="font-size:14px;margin-top: 10px;">{{item.minamount == 0?'无金额门槛限制':'满'+item.minamount+'元使用'}}</view>
					<view style="margin-top: 5px;">{{item.use_condition ? item.use_condition : '无限制'}}</view>
					<view style="margin-top: 5px;">有效期：<text>{{item.begindate}}- -{{item.enddate}}</text></view>
				</view>
			</view>
			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
			<view class="empty" v-else>没内容</view>
		</view>
</template>

<script>
	import {GetUserCouponList} from 'api/user'
	export default{
		data(){
			return {
				page:1,
				pageCount:0,
				moreStatus:"",
				list:[]
			}
		},
		onLoad() {
			
		},
		onShow() {
			this.getList()
		},
		/*滚动加载*/
		onReachBottom(){
			this.page++
			if(this.page<=this.pageCount){
				this.getList(this.page)			
			}	
		},
		methods:{
			getList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.moreStatus = 'loading'
				GetUserCouponList({
					page:this.page,
					pagesize:10,
				}).then(res=>{
					this.pageCount = res.pagecount
					if(this.page >= this.pageCount){
						this.moreStatus = 'noMore'
					}else{
						this.moreStatus = 'more'
					}
					if(res.result){
						this.list = this.list.concat(res.data)
					}
				})		
			}
		}
	}
</script>

<style scoped>
	.coupon-box{
		padding: 10px;
		background: #fff;
	}
	.coupon-item{
		background:rgba(255,255,255,1);
		display: flex;
		border-radius:4px;
		height: 85px;
		margin-top: 10px;
	}
	.coupon-left{
		width: 85px;
		height: 85px;
		box-shadow:-3px 0px 5px 0px rgba(1,12,23,0.08);
		border-radius:4px;
		border-right: 1px dashed #010C17;
		text-align: center;
		line-height: 85px;
		font-size:24px;
		font-weight:500;
		color:rgba(1,12,23,1);
	}
	.coupon-right{
		flex: 1;
		box-shadow:3px 0px 5px 0px rgba(1,12,23,0.08);
		border-radius:4px;
	}
</style>


