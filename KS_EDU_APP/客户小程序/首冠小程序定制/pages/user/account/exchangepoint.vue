<template>
	<view style="font-size: 14px;color:#2F3133">
		<ks-tabs :value.sync="index" :tabList="tabs" @change="changeTabs" style="border-bottom: 1px solid #eee;position: fixed;top: 0;width: 100%;z-index: 100;"></ks-tabs>
		<view style="margin-top: 70px;" v-if="index == 0&& data">
			<view style="height: 30px;line-height: 30px;padding-left: 20px;font-size: 16px;">您好,{{state.userInfo.UserName}}！您的身份级别：{{(state.userInfo.GroupID == 2 && '学员')||(state.userInfo.GroupID == 3 && '学校')||(state.userInfo.GroupID == 4 && '教师')}}</view>
			<view style="padding: 0 20px;background: #fff;">
				<view style="display: flex;height: 44px;line-height: 44px;border-bottom: 1px solid #eee;">
					<view style="width:90px;">可用预存款</view>
					<view>{{state.userInfo.Money}}元</view>
				</view>
				<view style="display: flex;height: 44px;line-height: 44px;border-bottom: 1px solid #eee;">
					<view style="width:90px;">可用点券</view>
					<view>{{data.available_point}}个</view>
				</view>
				<view style="display: flex;height: 44px;line-height: 44px;align-items: center;">
					<view style="width:90px;">兑换个数</view>
					<input type="number" v-model="value" placeholder="输入兑换数量" />
				</view>
			</view>
			<view style="padding: 20px;font-size: 12px;color:#888;line-height: 20px;">
				<view>兑换比率：</view>
				<view>1元兑换1个点券，您当前可用预存款为{{state.userInfo.Money}}元，您最多可以兑换<text style="color:#ff663d">{{data.available_balance}}</text>个点券。</view>
			</view>
			<view style="padding: 0 20px;">
				<button type="warn" @click="exchange()">确认兑换</button>
			</view>
			
		</view>
		<view style="margin-top: 70px;" v-else-if="index == 1 && data">
			<view style="height: 30px;line-height: 30px;padding-left: 20px;font-size: 16px;">您好,{{state.userInfo.UserName}}！您的身份级别：{{(state.userInfo.GroupID == 2 && '学员')||(state.userInfo.GroupID == 3 && '学校')||(state.userInfo.GroupID == 4 && '教师')}}</view>
			<view style="padding: 0 20px;background: #fff;">
				<view style="display: flex;height: 44px;line-height: 44px;border-bottom: 1px solid #eee;">
					<view style="width:90px;">可用积分</view>
					<view>{{data.available_score}}{{data.score_unit}}</view>
				</view>
				<view style="display: flex;height: 44px;line-height: 44px;border-bottom: 1px solid #eee;">
					<view style="width:90px;">可用点券</view>
					<view>{{data.point}}{{data.point_unit}}</view>
				</view>
				<view style="display: flex;height: 44px;line-height: 44px;align-items: center;">
					<view style="width:90px;">兑换个数</view>
					<input type="number" v-model="value" placeholder="输入兑换数量" />
				</view>
			</view>
			<view style="padding: 20px;font-size: 12px;color:#888;line-height: 20px;">
				<view>兑换比率：</view>
				<view>{{data.scoretopoint_rate}}个积分兑换1个点券，您当前可用积分为{{data.available_score}}个，您最多可以兑换 <text style="color: #ff663d">{{data.most_point}}</text>个点券。</view>
			</view>
			<view style="padding: 0 20px;">
				<button type="warn" @click="scoreexchange()">确认兑换</button>
			</view>	
		</view>
		<view v-else-if="index == 2" style="margin-top: 44px;background: #fff;">
			<view class="list" >
				<view class="item" v-for="(item,i) in list" :key="i">
					<view class="ks-course__title--2">{{item.remark}}</view>
					<view style="display: flex;align-items: center;margin-top: 5px;">
						<view style="flex: 1;font-size: 12px;color: #888;">
							<text style="margin-right: 20px;">余额：{{item.curr_point}}点券</text>
							<text>时间：{{item.adddate}}</text>
						</view>
						<view style="font-size: 22px;color:#ff663d;">{{item.operate_type==1?'+':'-'}}{{item.operate_type==1?item.income:item.expend}}</view>
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
	import {MoneyExchangePoint,SaveMoneyExchangePoint,ScoreExchangePoint,GetUserLogPointList,SaveScoreExchangePoint} from 'api/user'
	export default{
		components:{
			UniLoadMore
		},
		data(){
			return{
				tabs:['余额兑换','积分兑换','点券明细'],
				index: 0,
				state:{},
				data:{},
				value:'',
				list: [],
				page: 1,
				pageCount: 1,
				moreStatus:"",
			}
		},
		watch:{
			value(val){
				if(this.index == 0){
					if(val>this.data.available_balance){
						this.value = this.data.available_balance
					}
				}else if(this.index == 1){
					if(val>this.data.most_point){
						this.value = this.data.most_point
					}
				}
				
			}
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
				GetUserLogPointList({
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
			},
			changeTabs(e){
				this.value = ''
				if(this.index==0){
					this.getData()
				}else if(this.index == 1){
					this.getScoreData()
				}else{
					this.getList()
				}
			},
			getData(){
				MoneyExchangePoint().then(res=>{
					if(res.result){
						this.data = res.data
					}
				})
			},
			getScoreData(){
				ScoreExchangePoint().then(res=>{
					if(res.result){
						this.data = res.data
					}
				})
			},
			//余额兑换
			exchange(){
				if(this.state.userInfo.Money - 1 > 0){
					if(this.value>0){
						SaveMoneyExchangePoint({
							point:this.value
						}).then(res=>{
							if(res.result){
								uni.showToast({
									title:'兑换成功',
									icon:'none'
								})
								this.getData()
							}else{
								uni.showToast({
									title:res.msg,
									icon:'none'
								})
							}
						})
					}else{
						uni.showToast({
							title:'输入兑换数量',
							icon:'none'
						})
					}
				}else{
					uni.showToast({
						title:'余额不足',
						icon:'none'
					})
				}
			},
			//积分兑换
			scoreexchange(){
				
					if(this.value>0){
						SaveScoreExchangePoint({
							scorepoint:this.value
						}).then(res=>{
							if(res.result){
								uni.showToast({
									title:'兑换成功',
									icon:'none'
								})
								this.getScoreData()
							}else{
								uni.showToast({
									title:res.msg,
									icon:'none'
								})
							}
						})
					}else{
						uni.showToast({
							title:'输入兑换数量',
							icon:'none'
						})
					}
			
			}
		},
		onLoad() {
			this.$store.ready(state=>{
				this.state=  state
				this.getData()
			})
		}
	}
</script>

<style scoped>
	button[type=warn]{
		background-color: #ff663d !important;
	}
	.item{
		padding: 15px 20px;
		border-bottom: 1px solid #eee;
	}
</style>
