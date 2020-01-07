<template>
	<view v-show="load">
		<view class="top" :style="'background:url('+baseUrl+'/static/images/user/districenter_bg.png);background-size:100% 100%;'">
			<view class="top-flex">
				<ks-image class="ks-image" :src="data.Logo"  radius="50%" type="user"></ks-image>
				<view class="name">
					<view ><text>{{data.Title}}的小店</text>(UID:{{state.userId}})</view>
					<view class="margintop12">开通时间：{{data.adddate}}</view>
				</view>
			</view>
		</view>
		<view class="list">
			<view class="item">
				<text class="number">{{data.fxnum}}</text>
				<text class="item-title">分销商数</text>
			</view>
			<view class="item">
				<text class="number">{{data.thnum}}</text>
				<text class="item-title">推荐会员数</text>
			</view>
			<view class="item">
				<text class="number">{{data.totalyj}}</text>
				<text class="item-title">总佣金(元)</text>
			</view>
			<view class="item">
				<text class="number">{{data.wtxyj}}</text>
				<text class="item-title">未提现(元)</text>
			</view>
		</view>
			<ks-cell-group>
				<ks-cell show-arrow line label="小店会员" @click="open('/pages/user/distribution/vip')" 
				:value="Number(data.newmember)?'<div style=font-size:12px;color:#888>新增<span style=color:#FF3B30;>'+data.newmember+'</span>名会员</div>':''"></ks-cell>
				<ks-cell show-arrow line label="子分销商" @click="open('/pages/user/distribution/secondary')" :value="Number(data.newfmember)?'<div style=font-size:12px;color:#888>新增<span style=color:#FF3B30;>'+data.newfmember+'</span>名子分销商</div>':''"></ks-cell>
				<ks-cell show-arrow label="小店销售订单" @click="open('/pages/user/distribution/order')"></ks-cell>
			</ks-cell-group>
			<ks-cell-group>
				<ks-cell label="设置提现账号" line show-arrow @click="open('/pages/user/distribution/setaccount')"></ks-cell>
				<ks-cell label="佣金提现" line show-arrow @click="open('/pages/user/distribution/cash')" :value="Number(data.wtxyj)?'<div style=font-size:12px;color:#888>可提现金额<span style=color:#FF3B30;>'+data.wtxyj+'</span>元</div>':''"></ks-cell>
				<ks-cell label="提现记录" show-arrow @click="open('/pages/user/distribution/record')"></ks-cell>
			</ks-cell-group>
			<ks-cell-group>
				<ks-cell show-arrow line label="店铺资料" @click="open('/pages/user/distribution/info')"></ks-cell>
				<ks-cell show-arrow line label="分销商排名" @click="open('/pages/user/distribution/rank')" ></ks-cell>
				<ks-cell show-arrow label="店铺二维码" @click="open('/pages/user/distribution/qrcode')"></ks-cell>
			</ks-cell-group>
	</view>
</template>

<script>
	import {IsDistributor,ApplyDistributorlist} from 'api/user'
	export default{
		data(){
			return{
				baseUrl:this.$store.state.SRC+"/config/app",
				data:{},
				state:{},
				load:false
			}
			
		},
		onPullDownRefresh() {
			this.initData()	
		},
		methods:{
			open(url){
				uni.navigateTo({
					url:url
				})
			},
			initData(){
				ApplyDistributorlist().then(res=>{
					if(res.result){
						this.data = res
						this.load = true
					}
				})
			}
		},
		onShow() {
			this.$store.ready(state=>{
				this.state = state
				this.initData()
			})	
		}
	}
</script>

<style scoped>
	.top{
		padding: 45px 0 35px 10px;
		height: 60px;
	}
	.top-flex{
		display: flex;
	}
	.top .ks-image{
		width: 60px;
		height: 60px;
		border-radius: 50%;
		overflow: hidden;
		
	}
	.name{
		font-size:12px;
		color:rgba(255,255,255,1);
		margin-left: 10px;
	}
	.name text{
		margin-right: 6px;
		font-size:17px;
		font-weight:500;
		color:rgba(255,255,255,1);
	}
	.margintop12{
		margin-top: 12px;
	}
	.list{
		padding: 10px 0;
		display: flex;
		background: #fff;
	}
	.item{
		width: 25%;
		text-align: center;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}
	.number{
		font-size:18px;
		font-weight:500;
		color:rgba(26,26,26,1);
	}
	.item-title{
		font-size:12px;
		color:rgba(102,102,102,1);
		margin-top: 10px;
	}
</style>
