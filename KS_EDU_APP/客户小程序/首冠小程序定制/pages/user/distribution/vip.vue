<template>
	<view class="list">
		<view class="item" v-for="(item,i) in list" :key="i">
			<view class="item-top">
				<ks-image class="ks-image" :src="item.UserFace" radius="50%" type="user"></ks-image>
				<view class="name">
					<view><text class="username">{{item.username}}</text>（推荐人：{{item.tjname}}）</view>
					<view class="margintop10">最后登录时间：{{item.LastLoginTime}}</view>
				</view>
			</view>
			<view style="display: flex;">
				<view class="site">
					<text>{{item.tjnum}}</text>
					<text class="site-text">已推荐人数</text>
				</view>
				<view class="site">
					<text>{{item.BuyTotalMoney}}</text>
					<text class="site-text">购课金额（已付款）</text>
				</view>
				<view class="site">
					<text>{{item.LoginTimes}}</text>
					<text class="site-text">登录次数</text>
				</view>
			</view>
		</view>
		<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
		<ks-empty type="list" v-else>暂无数据</ks-empty>
	</view>
</template>

<script>
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {ApplyDistriMember} from 'api/user'
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
		onPullDownRefresh() {
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
				ApplyDistriMember({
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
	.site-text{
		font-size:12px;
		color:rgba(136,136,136,1);
		margin-top: 7px;
	}
</style>
