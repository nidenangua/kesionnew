<template>
	<view>
		<view class="list" style="background: #fff;">
			<view class="item" v-for="(item,i) in list" :key="i">
				<view class="ks-course__title--2">{{item.remark}}</view>
				<view style="display: flex;align-items: center;margin-top: 5px;">
					<view style="flex: 1;font-size: 12px;color: #888;">
						<text style="margin-right: 20px;">余额：{{item.curr_money}}元</text>
						<text>时间：{{item.adddate}}</text>
					</view>
					<view style="font-size: 22px;color:#ff663d;">{{item.operate_type==1?'+':'-'}}{{item.operate_type==1?item.income:item.expend}}</view>
				</view>
				
			</view>
			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
			<ks-empty type="list" v-else>暂无数据</ks-empty>
		</view>
	</view>
</template>

<script>
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {GetUserLogMoneyList} from 'api/user'
	export default{
		components:{
			UniLoadMore
		},
		data(){
			return {
				list: [],
				page: 1,
				pageCount: 1,
				moreStatus:"",
			}
		},
		methods:{
			getList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.moreStatus = 'loading'
				GetUserLogMoneyList({
					page:this.page,
					pagesize:15,
				}).then(res=>{
					uni.stopPullDownRefresh();
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
		},
		onLoad() {
			this.getList()
		}
	}
</script>

<style scoped>
	.item{
		padding: 20px;
	}
</style>
