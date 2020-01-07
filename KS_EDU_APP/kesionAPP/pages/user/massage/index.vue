<template>
	<view>
		<view class="msg-list">
			<block v-for="(item,i) in list" :key="i">
				<uni-swipe-action style="margin-top: 10px;" :options="options" @click="delItem(item)">
					<view class="msg-item" @click="open(item)">
						<view class="ks-course__title--2">{{item.msgtitle}}</view>
						<view class="flex-box__space" style="margin-top: 10px;">
							<view>{{item.adddate}}</view>
							<view :style="{color:item.readtf_str == '未读'?'#FF3B30':''}">{{item.readtf_str}}</view>
						</view>
					</view>
				</uni-swipe-action>
			</block>
			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
			<ks-empty type="list" v-else>暂无数据</ks-empty>
		</view>
			<uni-popup ref="popup" :custom="true"  :show="show" type="center" @change="close" >
					<view class="content-box">
							<view class="title" style="padding: 20px 30px 10px 30px;">{{data.msgTitle}}</view>
							<view style="min-height: 160px;max-height: 350px;overflow: auto;padding: 0 30px;" >
								<view v-html="data.msgContent" class="content"></view>
							</view>
							<view class="return-btn" @click="show=false">返回</view>	
					</view>
			</uni-popup>
			
		
	</view>
</template>

<script>
	import {UniSwipeAction} from 'components/uni/uni-swipe-action/uni-swipe-action'
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {UniPopup} from 'components/uni/uni-popup/uni-popup'
	import {KsEmpty} from 'components/ks-components/empty/empty'
	import {GetUserMessageReciveList,DoUserSiteMsg,GetOneSiteMsgInfo} from 'api/user'
	export default{
		components:{
			UniPopup,
			KsEmpty,
			UniLoadMore,
			UniSwipeAction
		},
		data(){
			return {
				options:[
					{
				        text: '删除',
				        style: {
				            backgroundColor: '#FF3B30'
				        }
				    }    
				],
				page:1,
				list:[],
				pageCount:0,
				moreStatus:"",
				data:{},
				show:false,
			}
		},
		onLoad() {
			this.getList()
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
			close(e){
				this.show = e.show
				console.log(e)
			},
			getList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.moreStatus = 'loading'
				GetUserMessageReciveList({
					page:this.page,
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
			},
			open(item){
				
				GetOneSiteMsgInfo({
				    actiontype: 0,
				    id: item.id,
				}).then(res=> {
					this.show = true
				    if (res.result) {
				    	this.data = res.data[0]
						this.$store.dispatch('getUserInfo').then(_=>{
							this.getList()	
						})
					}
				})
			},            
			delItem(item) {
				console.log(item)
				uni.showModal({
				    title: '',
				    content: '确定删除吗？',
				    success(res) {
				        if (res.confirm) {
				            DoUserSiteMsg({
				                actiontype: 0,
				                do: 'delete',
				                ids: item.id,
				            }).then(res=> {
				                if (res.result) {
				                    this.getList()
				                } else {
				                    uni.showToast({
				                    	title: res.msg,
				                    	icon:none
				                    })
				                }
				            })
				        }
				    }
				});
				    
			},
		}
	}
</script>

<style scoped>
	.content-box{
		width: 80vw;
		background: #fff;
		position: relative;
		border-radius: 12px;
		overflow: hidden;
	}
	.msg-item{
		padding: 10px;
		background: #fff;
		font-size:12px;
		color:rgba(136,136,136,1);
	}
	.uni-popup__wrapper-box{
		border-radius: 12px !important;
	}
	.title{
		text-align: center;
		font-size:16px;
		font-weight:500;
		color:rgba(26,26,26,1);
		line-height:24px;
	}
	.content{
		margin-top: 15px;
		font-size:14px;
		color:rgba(77,77,77,1);
		line-height:24px;
	}
	.return-btn{
		width: 100%;
		height: 44px;
		text-align: center;
		color:#2987EE;
		font-size:17px;
		font-family:PingFang SC;
		font-weight:500;
		line-height:44px;
		border-top: 1px solid #eee;
		background: #fff;
	}
</style>
