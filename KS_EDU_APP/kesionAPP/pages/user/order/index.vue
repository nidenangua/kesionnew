<template>
	<view>
		<ks-tabs position="fixed" :value.sync="index" :tab-list="tabList" @change="changeList" rangeKey="name"></ks-tabs>
		<view class="order-list" style="margin-top: 10px;">
			<view class="order-item" v-for="(item,i) in list" :key="i">
				<view class="order-id">
					<text>{{item.inputtime}}</text>
					<text style="margin-left: 10px;">订单号:{{item.orderid}}</text>
				</view>
				<view class="order-image" v-for="(site,s) in item.itemlist" :key="s" @click="open(site)">
					<ks-image class="ks-image" radius="5px" :src="site.photourl"></ks-image>
					<view style="text-align: left;display: flex;flex-direction: column;justify-content: space-between;" >
						<view style="height: 62px;">
							<view class="ks-course__title--2" style="line-height: 20px;">{{site.coursename}}</view>
							<view class="course-costype">
								{{site.costype}}
							</view>
						</view>
						<view class="course-price">
						{{site.price}}
						
						</view>
					</view>
					
				</view>
				<view class="item-bottom">
					<view style="text-align: right;margin-bottom: 5px;" v-if="item.use_couponmoney - 0 > 0">抵扣:<text class="item-bottom__highlight">￥{{item.use_couponmoney}}</text></view>
					<view style="text-align: right;">实付:<text class="item-bottom__highlight">{{item.pay_amount}}</text></view>
					<view class="flex-box__space" style="color:rgba(102,102,102,1);margin-top: 10px;">
						<view :style="{color:item.status_str=='未付款' ? '#FF3B30':''}">{{item.status_str}}</view>
						<view>
							<button size="mini" v-if="item.del_button"  style="margin-left: 10px;" @click="deleteUserCourseOrder(item)">删除订单</button>
							<button size="mini" v-if="item.pay_button" type="warn" style="margin-left: 10px;" @click="pay(item)">立即付款</button>
						</view>
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
	import {UniPopup} from 'components/uni/uni-popup/uni-popup'
	import {GetUserCourseOrderList,InitialUserPayCourse,DoUserPayCourse,DeleteUserCourseOrder} from 'api/user'
	export default {
		components:{
			UniPopup,
			UniLoadMore
		},
		data() {
			return {
				userInfo:{},
				index:0, 
				tabList:[
					{value:-1,name:'全部'},
					{value:1,name:'已付款'},
					{value:0,name:'未付款'}
				],
				list:[],
				status:-1,
				page:1,
				pageCount:0,
				moreStatus:"",
				payData:{},
				price:'',
				show:false,
				money:0,
				paymentList:[],
				activePay:-1,
				payId:0,
				id:''
			}
		},
		
		/*滚动加载*/
		onReachBottom(){
			this.page++
			if(this.page<=this.pageCount){
				if(this.index == 0){
					this.getList(this.page)
				}else{
					this.getAskList(this.page)
				}				
			}	
		},
		onLoad() {
			this.$store.ready(state=>{
				this.userInfo = state.userInfo
				this.getList()
			})	
		},
		onPullDownRefresh() {
			this.getList() 
		},
		methods: {
			changeList(e){
				this.status = e.tab.value
				this.getList()
			},
			open(item){
				if(item.costype == '社群'){
					uni.navigateTo({
						url:'/pages/class-center/group/details?boardid='+item.courseid
					})
				}else{
					var url = item.view_url
					url = encodeURIComponent(url)
					uni.navigateTo({
						url:'/pages/web/web?title='+item.coursename+'&photo='+item.photourl+'&url='+url
					})
				}
				
			},
			/**请求课程订单数据列表*/
			getList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.moreStatus = 'loading'
				GetUserCourseOrderList({
					show: this.status,
					page:this.page,
					pagesize:10,
				}).then(res=>{
					uni.stopPullDownRefresh()
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
			pay(item){
				uni.navigateTo({
					url:'/pages/payment/payment?orderid='+item.orderid
				})	
			},
			
			/**删除课程订单
			 */
			deleteUserCourseOrder(item) {
				var that = this
				uni.showModal({
				    title: '提示',
				    content: '确认删除该订单吗？',
				    success:function (res) {
				        if (res.confirm) {
							DeleteUserCourseOrder({
							    ids: item.id,
							}).then(res=> {
							    if (res.result) {
							        that.getList()
							    }else{
									uni.showToast({
										title: res.msg,
										icon:'none'
									}); 
								}
							})
				        } else if (res.cancel) {
				            console.log('用户点击取消')
				        }
				    }
				})
			}
		}
	}
</script>

<style lang="scss" scoped>
	.order-item{
		margin-top: 10px;
		background: #fff;
		padding: 0 10px 10px 10px;
	}
	.order-id{
		height: 30px;
		line-height: 30px;
		border-bottom: 1px solid #EEE;
		font-size:12px;
		color:rgba(102,102,102,1);
		overflow: hidden;
		white-space: nowrap;
		word-wrap:break-word;
		text-overflow: ellipsis;
	}
	.order-image{
		padding: 15px 10px 15px 130px;
		position: relative;
		min-height: 80px;
		border-radius:4px;
	}
	.order-image .ks-image{
		position: absolute;
		top:15px;
		left: 0;
		height: 80px;
		width: 120px;
	}
	.course-costype{	
		font-size:14px;
		color:rgba(136,136,136,1);
	}
	.course-price{
		font-size:14px;
		color:rgba(26,26,26,1);
	}
	uni-button[type=warn]{
		background-color: #FF9500;
	}
	.item-bottom{
		padding-top: 10px;
		border-top: 1px solid #eee;
		font-size:14px;
		color:rgba(26,26,26,1);
	}
	.item-bottom__highlight{
		color:$uni-color-danger;
	}
	/***************/
	.popup {
	  font-size: 0.7rem;
	  color: #273035;
	}
	.popup-title {
	  text-align: center;
	  font-size: 0.8rem;
	}
	.popup-item {
	  color: #787c82;
	  border-bottom: 1px solid #eee;
	  padding: 1vh 0;
	}
	.vip-money {
	  text-align: center;
	  font-size: 20px;
	  color: rgb(255, 102, 61);
	  margin-top: 10px;
	}
	.money-pay {
	  display: flex;
	}
	.money-pay input {
	  background: none;
	  outline: none;
	}
	.pay-left {
	  width: 30vw;
	  text-align: right;
	  font-size: 0.8rem;
	}
	.pay-right {
	  width: 60vw;
	  padding-left: 10vw;
	  color: #787c82;
	  font-size: 0.7rem;
	}
	.pay-item {
	  width: 150px;
	  height: 2.2rem;
	  border: 2px solid #bbbbbb;
	  margin-bottom: 1rem;
	  cursor: pointer;
	}
	
	.curr-pay {
	  border: 2px solid rgb(255, 102, 61);
	}
	.pay-btnbox {
	  margin: 1rem 1rem 0 1rem;
	  padding: 1rem;
	  border-top: 1px solid #e6e9e6;
	}
	.pay-btn {
	  height: 2.2rem;
	  border-radius: 0.2rem;
	  line-height: 2.2rem;
	  font-size: 0.8rem;
	  text-align: center;
	  background: #ff663d;
	    color: #fff ;
	    border: 1px solid #ff663d;
	}
</style>
