<template>
	<view>
		<ks-tabs :value.sync="index" :tabList="tabs" rangeKey="name" @change="changeTabs" class="tabs" ></ks-tabs>
		<view class="top">
			<view class="top-list">
				<view class="top-item">
					<view  class="number">{{data.OrderNumS}}</view>
					<view class="margintop10">订单数</view>
				</view>
				<view class="top-item">
					<view class="number">{{data.SalesTotal}}</view>
					<view class="margintop10">总金额（元）</view>
				</view>
				<view class="top-item">
					<view  class="number">{{data.SalesTotalYJ}}</view>
					<view class="margintop10">佣金（元）</view>
				</view>
			</view>
			<view class="btn">
				<view class="btn-item " :class="from==1?'active':''" @click="changeList(1)">全部订单({{data.OrderNum}})</view>
				<view class="btn-item" :class="from==2?'active':''" @click="changeList(2)">已付({{data.OrderNum}})</view>
			</view>
			<view class="list">
				<view class="item" v-for="(item,i) in list" :key="i">
					<view class="title">
						<text>
							订单号：{{item.orderid}}
						</text>
						<text class="flex-1">购买学员：{{item.username}}</text>
					</view>
					<view class="order">
						<view class="order-item" v-for="(site,s) in item.courselist" :key="s">
							<ks-image :src="site.PicUrl" class="ks-image" radius="4px"></ks-image>
							<view class="text">
								<view class="ks-course__title--1">{{site.Cname}}</view>
								<view class="margintop5">价格：<text class="money-color">￥{{site.OrderTotalPrice}}</text></view>
								<view class="margintop5">佣金：<text class="money-color">￥{{site.ReturnShopPrice}}</text></view>
							</view>
						</view>
						
					</view>
				</view>
				<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
				<ks-empty type="list" v-else>暂无数据</ks-empty>
			</view>
		</view>
	</view>
</template>

<script>
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {ApplySalesorderlist} from 'api/user'
	export default{
		components:{
			UniLoadMore
		},
		data(){
			return {
				tabs:[
					{
					  value: 2,
					  name: "课程"
					},{
					  value: 1,
					  name: "商品"
					},{
					  value: 3,
					  name: "套餐"
					},{
					  value: 4,
					  name: "VIP"
					}],
				index:0,
				type:2,
				query:{},
				from:1,
				list:[],
				data:{},
				page:1,
				pageCount:1,
				moreStatus:''
			}
		},
		methods:{
			changeList(i){
				this.from = i
				this.getList()
			},
			changeTabs(e){
				this.type = e.tab.value
				this.getList()
				
			},
			getList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.moreStatus = 'loading'
				ApplySalesorderlist({
					flag:this.query.flag,
					type:this.type,
					from:this.from,
					pageindex:this.page,
					pagesize:10,
				}).then(res=>{
					uni.stopPullDownRefresh();
					this.pageCount = res.pageCount
					if(this.page >= this.pageCount){
						this.moreStatus = 'noMore'
					}else{
						this.moreStatus = 'more'
					}
					if(res.result){
						this.data = res
						this.list = this.list.concat(res.data)
					}
				})
				
			}
		},
		onLoad(query) {
			this.query = query
			this.getList()
		}
	}
</script>

<style scoped>
	.money-color{
		color:#FF3B30
	}
	.margintop10{
		margin-top: 10px;
	}
	.margintop5{
		margin-top: 5px;
	}
	.tabs{
		border-bottom: 1px solid #eee;position: fixed;top: 0;width: 100%;z-index: 100;
	}
	.top{
		padding: 10px;
		margin-top: 44px;
	}
	.top-list{
		height: 80px;
		background:rgba(255,255,255,1);
		box-shadow:0px 2px 2px 0px rgba(26,26,26,0.05);
		border-radius:8px;
		display: flex;
		
	}
	.top-item{
		width: calc(100% / 3);
		font-size:12px;
		color:rgba(136,136,136,1);
		text-align: center;
	}
	.number{
		color:#1A1A1A;font-size: 16px;margin-top: 20px;
	}
	.btn{
		height:36px;
		background:rgba(255,255,255,1);
		border:1px solid #ff663d;
		border-radius:4px;
		line-height: 36px;
		text-align: center;
		display: flex;
		font-size: 14px;
		margin-top: 10px;
	}
	.btn-item{
		width: 50%;
		height: 100%;
	}
	.active{
		background: #ff663d;
		color:#fff;
	}
	/*  */
	.item{
		background: #fff;
		margin-top: 10px;
		padding: 0 10px;
	}
	.title{
		padding: 8px 0;
		line-height: 1.3;
		display: flex;
		align-items: center;
		font-size: 12px;
		color: #888;
	}
	.flex-1{
		flex: 1;
		text-align: right;
	}
	.order{
		width: 100%;
	}
	.order-item{
		padding: 20px 0;
		display: flex;			
		border-bottom: 1px solid #eee;
	}
	.ks-image{
		width:120px;
		height:80px;
		margin-right: 10px;
	}
	.text{
		font-size:12px;
		color:rgba(136,136,136,1);
		width: calc(100% - 130px);
	}
	.text text{
		font-size:14px;
		color:rgba(26,26,26,1);
		margin-top: 7px;
	}
</style>
