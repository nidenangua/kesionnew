<template>
	<view>
		<ks-tabs :value.sync="index" :tabList="tabs" @change="changeTabs" style="border-bottom: 1px solid #eee;position: fixed;top: 0;width: 100%;z-index: 100;"></ks-tabs>
		
		<view style="margin-top: 44px;z-index: 10;">
			<view class="card-list" v-if="index == 0">
				
				<view @click="openDetail(item)" class="card-item" v-for="(item,i) in list" :key="i" :style="{backgroundImage:'url('+item.PhotoUrl+'),'+(item.cardtype==0)?'url('+state.SRC+'/Config/APP/static/user/images/myacoount_pack_bg.png)':'url('+state.SRC+'/Config/APP/static/user/images/myacoount_recharge_bg.png)'}">
				          <view class="card-expiredate">*有效期至：{{ item.packenddate }}</view>
				          <view class="card-tab" :class="{disabled:item.use_flag == 2}">
				            {{ item.user_title }}
				          </view>
				          <view class="card-title">
				            {{ item.title }}
				          </view>
				        </view>
				<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
				<ks-empty type="list" v-else>暂无数据</ks-empty>
			</view>
			<view class="card-list" v-else-if="index == 1">
				
				<view @click="openDetail(item)"  class="card-item"  v-for="(item,i) in list"  :key="i"  :style="{backgroundImage:'url('+item.PhotoUrl+'),'+(item.cardtype==0)?'url('+state.SRC+'/Config/APP/static/user/images/myacoount_pack_bg.png)':'url('+state.SRC+'/Config/APP/static/user/images/myacoount_recharge_bg.png)'}">
				          <view
				            class="card-tab"
				            style="background: #ff663d;margin-top: 1rem;color:#fff"
				            v-if="item.isuser == 1"
				          >
				            已拥有
				          </view>
				          <view class="card-title" style="display: flex;justify-content: space-between;">
				            <view>{{ item.title }}</view>
							<view style="margin-right: 10px;">￥{{ item.price }}</view>
				          </view>
				        </view>
				<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
				<ks-empty type="list" v-else>暂无数据</ks-empty>
			</view>
			<view v-else style="background: #fff;font-size: 14px;padding: 20px;">
				<view style="line-height: 40px;">
					卡号：
				</view>
				<input v-model="cardId" style="border: 1px solid #eee;padding-left: 10px;height: 30px;line-height: 30px;" />
				<view style="line-height: 40px;">
					密码：
				</view>
				<input :password="true" v-model="cardPwd" style="border: 1px solid #eee;padding-left: 10px;height: 30px;line-height: 30px;" />
				<button type="primary" style="margin-top: 30px;" @click="onActive()">确认激活</button>
			</view>
		</view>
		
	</view>
</template>

<script>
	
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {GetUserFeePackageList,GetUserFeePackageBuyList,ActivateUserFeePackage,InitialPayUserFeePackage,PayUserFeePackage} from 'api/user'
	export default {
		components:{
			UniLoadMore
		},
		data() {
			return {
				tabs:['我的营销卡','购买营销卡','开通营销卡'],
				index:0,
				list:[],
				page:1,
				pageCount:0,
				moreStatus:"",
				cardId:'',
				cardPwd:'',
				
				userInfo:{},
				state:{}
			}
		},
		
		onPullDownRefresh() {
			if(this.index == 0){
				this.getList()
			}else if(this.index == 1){
				this.getAllList()
			}	 
		},
		/*滚动加载*/
		onReachBottom(){
			this.page++
			if(this.page<=this.pageCount){
				if(this.index == 0){
					this.getList(this.page)
				}else if(this.index == 1){
					this.getAllList(this.page)
				}
				
			}	
		},
		onLoad() {
			this.$store.ready(state=>{
				this.state = state
				this.userInfo = state.userInfo
			
			})
		},
		onShow() {
			if(this.index == 0){
				this.getList()
			}else if(this.index == 1){
				this.getAllList()
			}
			
		},
		methods: {
			openDetail(item){
				uni.navigateTo({
					url:'/pages/user/card/detail?type='+this.index+'&id='+item.id+'&packid='+item.packid
				})
			},
			changeTabs(e){
				if(e.tab === '购买营销卡'){
					this.getAllList()
				}else if(e.tab === '我的营销卡'){
					this.getList()
				}
			},
	
			/**我的营销卡列表*/
			getList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.moreStatus = 'loading'
				GetUserFeePackageList({
					page:this.page,
					pagesize:10,
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
			},/**购买营销卡*/
			getAllList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.moreStatus = 'loading'
				GetUserFeePackageBuyList({
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
			},
			onActive(){
				ActivateUserFeePackage({
					couponnum: this.cardId,
					couponpassword: this.cardPwd,
				 			
				 }).then(res=> {
				   if (res.result) {
				     uni.showToast({
				     	title: '激活成功',
				     	
				     })
				   } else {
			
				     uni.showToast({
				     	title: res.msg,
				     	icon:'none'
				     })
				   }
				 });       
			}
		}
	}
</script>

<style scoped>
	.card-list{
		padding: 1px 15px 0 15px;
	}
	.card-item {
	    border-radius: 10px;
	    background-size: cover;
	    background-position: 50% 50%;
	    height: 30vh;
	    margin-top:15px;
	    position: relative;
	    overflow: hidden;
	    cursor: pointer;
	  }
	  .card-expiredate {
	    text-align: right;
	    color: #fff;
	    font-size: 12px;
	    line-height: 2.5;
	    margin-right: 10px;
	    background: rgba(0, 0, 0, 0.4);
	    height: 24px;
	    line-height: 24px;
	    padding-right: 10px;
	    box-sizing: border-box;
	    width: 100%;
	  }
	  .card-title {
	    position: absolute;
	    bottom: 0;
	    left: 0;
	    height: 30px;
	    background: rgba(0, 0, 0, 0.4);
	    color: #fff;
	    font-size: 16px;
	    padding-left: 10px;
	    box-sizing: border-box;
	    width: 100%;
	    line-height: 30px;
	  }
	  .card-tab {
	    width: 42px;
	    padding: 0 8px;
	    height: 24px;
	    border-radius: 0 10px 10px 0;
	    line-height: 24px;
	    color: #fff;
	    font-size: 14px;
	    background: #ff663d;
	  }
	  .disabled {
	      color: #999;
	      background: #eee;
	    }
	
</style>


