<template>
	<view class="main">
		<view class="list">
			<view class="item" v-for="(item,i) in list" :key="i">
				<view class="top">
					<text>{{item.Accountname}}</text>
					<text :style="(item.Status=='已付款'&&'color:#32BC4C')||(item.Status=='审核中'&&'color:#FF9500')||(item.Status=='审核不通过'&&'color:#FF3B30')" >{{item.Status}}</text>
				</view>
				<view class="box" >
					<view class="number">￥{{item.Money}}</view>
					<view class="margintop10">提现金额</view>
				</view>
				<view class="box-padding" >
					<view class="site" v-if="item.flag == 0">
						<view class="left">提现银行</view>
						<view class="right">{{item.BankName}}</view>
					</view>
					<view class="site"  v-if="item.flag != 3">
						<view class="left">提现账号</view>
						<view class="right">{{item.Accountnumber}}</view>
					</view>
					<view class="site">
						<view class="left">提现时间</view>
						<view class="right">{{item.adddate}}</view>
					</view>
					<view class="site">
						<view class="left">申请人</view>
						<view class="right">{{item.UserName}}</view>
					</view>
					<view class="site">
						<view class="left">审核意见</view>
						<view class="right">{{item.reply?item.reply:'- -'}}</view>
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
	import {ApplyTxrecord} from 'api/user'
	export default{
		components:{
			UniLoadMore
		},
		data(){
			return{
				page:1,
				pageCount:1,
				moreStatus:"",
				list:[]
			}
		},
		methods:{
			getList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.moreStatus = 'loading'
				ApplyTxrecord({
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
						this.list = this.list.concat(res.data)
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
	.main{
		padding: 0 10px;
		font-size: 14px;
		color:#888;
	}

	.item{
		margin-top: 10px;
		border-radius:8px;
		background: #fff;
	}
	.box{
		text-align: center;
	}
	.box-padding{
		padding: 10px 10px 10px 20px;
	}
	.top{
		padding: 17px 20px;
		display: flex;
		justify-content: space-between;
	}
	.number{
		font-size:24px;
		font-weight:bold;
		color:rgba(26,26,26,1);
	}
	.site{
		display: flex;
		line-height: 36px;
		height: 36px;
	}
	.right{
		flex: 1;
		text-align: right;
	}
</style>
