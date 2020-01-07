<template>
	<view class="list">
		<view class="item">
			<view class="title">本店销售订单</view>
			<view class="item-flex" >
				<view class="site">
					<text>{{data.salestotal1}}</text>
					<text class="site-text">总金额（元）</text>
				</view>
				<view class="site">
					<text>{{data.SalesTotalYJ1}}</text>
					<text class="site-text">已成交（元）</text>
				</view>
				<view class="site">
					<text>{{data.YJ1}}</text>
					<text class="site-text">佣金（元）</text>
				</view>
			</view>
			<view class="detail-btn" >
				<view class="btn" @click="open(1)">查看明细</view>
			</view>
		</view>
		<view class="item">
			<view class="title">一级分销商订单</view>
			<view class="item-flex">
				<view class="site">
					<text>{{data.salestotal2}}</text>
					<text class="site-text">总金额（元）</text>
				</view>
				<view class="site">
					<text>{{data.SalesTotalYJ2}}</text>
					<text class="site-text">已成交（元）</text>
				</view>
				<view class="site">
					<text>{{data.YJ2}}</text>
					<text class="site-text">佣金（元）</text>
				</view>
			</view>
			<view class="detail-btn">
				<view class="btn" @click="open(2)">查看明细</view>
			</view>
		</view>
		<view class="item">
			<view class="title">二级分销商订单</view>
			<view class="item-flex">
				<view class="site">
					<text>{{data.salestotal3}}</text>
					<text class="site-text">总金额（元）</text>
				</view>
				<view class="site">
					<text>{{data.SalesTotalYJ3}}</text>
					<text class="site-text">已成交（元）</text>
				</view>
				<view class="site">
					<text>{{data.YJ3}}</text>
					<text class="site-text">佣金（元）</text>
				</view>
			</view>
			<view class="detail-btn">
				<view class="btn" @click="open(3)">查看明细</view>
			</view>
		</view>
	</view>
</template>

<script>
	import {ApplySalesorder} from 'api/user'
	export default{
		data(){
			return{
				data:{}
			}
		},
		methods:{
			open(flag){
				uni.navigateTo({
					url:'/pages/user/distribution/orderdetail?flag='+flag
				})
			},
			initData(){
				ApplySalesorder({
					
				}).then(res=>{
					if(res.result){
						this.data = res
					}	
				})
			}
		},
		onLoad() {
			this.initData()
		}
		
		
	}
</script>

<style scoped>
	.list{
		padding: 0 10px;
	}
	.item{
		padding: 10px;
		border-radius:8px;
		background: #fff;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		margin-top: 10px;
	}
	.item-flex{
		display: flex;
	}
	.title{
		font-size:17px;
		font-weight:500;
		color:rgba(26,26,26,1);
		padding: 10px;
	}
	.site{
		width: calc(100% / 3);
		display: flex;
		flex-direction: column;
		align-items: center;
		font-size:16px;
		font-weight:500;
		color:rgba(26,26,26,1);
		margin-top: 15px;
	}
	.site-text{
		font-size:12px;
		color:rgba(136,136,136,1);
		margin-top: 7px;
	}
	.btn{
		border-radius:2px;
		height: 28px;
		border: 1px solid #ff663d;
		line-height: 28px;
		text-align: center;
		color: #ff663d;
		font-size: 14px;
		cursor: pointer;
	}
	.detail-btn{
		padding: 25px 10px 10px 10px;
	}
</style>
