<template>
	<view v-show="load">
		<ks-tabs :value.sync="index" :tabList="tabs" @change="changeTabs" class="tabs" ></ks-tabs>
		<view class="top">
			<view class="top-list border-bottom">
				<view class="top-item width-33" >
					<view class="font16">{{data.fxnum1}}</view>
					<view class="margintop10">一级分销商数</view>
				</view>
				<view class="top-item width-33" >
					<view class="font16">{{data.SalesTotalOrderNum1}}</view>
					<view class="margintop10">累计订单数</view>
				</view>
				<view class="top-item width-33" >
					<view class="font16">{{data.FXS1UserNum1}}</view>
					<view class="margintop10">累计会员数</view>
				</view>
			</view>
			<view class="top-list">
				<view class="top-item width-50" >
					<view class="font16">{{data.salestotal1}}</view>
					<view class="margintop10">累计已结单销售（元）</view>
				</view>
				<view class="top-item width-50" >
					<view class="font16">{{data.YJ1}}</view>
					<view class="margintop10">为我带来佣金（元）</view>
				</view>
			
			</view>
		</view>
		<view class="list">
			<view class="item" v-for="(item,i) in list" :key="i">
				<view class="item-top">
					<ks-image class="ks-image" :src="item.UserFace" radius="50%" type="user"></ks-image>
					<view class="name">
						<view><text class="username" >{{item.title}}</text>（推荐人：{{item.tjname}}）</view>
						<view class="margintop10">用户名：{{item.username}}</view>
					</view>
				</view>
				<view class="box-flex" >
					<view class="site">
						<text>{{item.tjnum}}</text>
						<text class="site-text">已推荐人数</text>
					</view>
					<view class="site">
						<text>{{item.FXS1UserNum}}</text>
						<text class="site-text">累计订单数</text>
					</view>
					<view class="site">
						<text>{{item.LoginTimes}}</text>
						<text class="site-text">登录次数</text>
					</view>
					<view class="site">
						<text>{{item.salestotal}}</text>
						<text class="site-text">累计销售额(元)</text>
					</view>
					<view class="site">
						<text>{{item.yj}}</text>
						<text class="site-text">为我带来佣金(元)</text>
					</view>
				</view>
			</view>
			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
			<ks-empty type="list" v-else>暂无数据</ks-empty>
		</view>
	</view>
</template>

<script>

	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {ApplyDistributorsonlist} from 'api/user'
	export default{
		components:{
			UniLoadMore
		},
		data(){
			return{
				index:0,
				tabs:['一级分销','二级分销'],
				page:1,
				pageCount:1,
				moreStatus:"",
				list:[],
				data:{},
				load:false,
				flag:0
			}
		},
		methods:{
			changeTabs(e){
				if(e.tab == '一级分销'){
					this.flag = 0
				}else{
					this.flag = 1
				}
				this.getList()
			},
			getList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
					this.data = {}
				}
				this.moreStatus = 'loading'
				ApplyDistributorsonlist({
					pageindex:this.page,
					pagesize:10,
					flag:this.flag
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
						this.load = true
					}
				})		
			}
		},
		onLoad() {
			this.getList()
		}
	}
</script>

<style scoped>
	.margintop10{
		margin-top: 10px;
	}
	.font16{
		color:#1A1A1A;font-size: 16px;
	}
	.tabs{
		border-bottom: 1px solid #eee;position: fixed;top: 0;width: 100%;z-index: 100;
	}
	.top{
		margin: 54px 10px 0 10px;
		padding: 0 10px;
		background:rgba(255,255,255,1);
		border-radius:8px;
	}
	.top-list{
		padding: 25px 0 20px 0;
		display: flex;
		
	}
	.border-bottom{
		border-bottom: 1px solid #eee;
	}
	.top-item{
		text-align: center;
		font-size: 12px;
		color: #888888;
	}
	/*  */
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
	.width-33{
		width: calc(100% /3);
	}
	.width-50{
		width: 50%;
	}
	.item-top{
		display: flex;
	}
	.ks-image{
		width: 44px;
		height: 44px;
		border-radius: 50%;
		overflow: hidden;
		margin-right: 10px;
	}
	.name{
		font-size:12px;
		color:rgba(136,136,136,1);
		
	}
	.username{
		margin-right: 5px;font-size: 16px;color:#1A1A1A;
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
	.box-flex{
		display: flex;flex-wrap: wrap;
	}
	.site-text{
		font-size:12px;
		color:rgba(136,136,136,1);
		margin-top: 7px;
	}
</style>
