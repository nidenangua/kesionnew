<template>
	<view v-show="load">
		<ks-tabs :value.sync="index" :tabList="tabs" @change="changeTabs" class="ks-tabs" ></ks-tabs>
		<view class="bg" v-if="index==0">
			<image class="bg-image" mode="aspectFit" :src="baseUrl+'/static/images/my/rank_bg.png'"></image>
			<view class="position-bg">
				<view class="rank-text">分销商佣金排行榜</view>
				<view class="look">快来看看你的佣金排名</view>
			</view>
			<view class="rank">
				<view class="my">
					<view class="left">
						<view>我的排名</view>
						<view class="rank-number">{{data.ranking}}</view>
					</view>
					<view class="middle">
						<ks-image radius="50%" class="ks-image" type="user" :src="state.userInfo.UserFace"></ks-image>
						<view class="name">{{state.userInfo.UserName}}</view>
					</view>
					<view class="right">
						<view>我的佣金(元)</view>
						<view class="rank-number">{{data.rankingyj}}</view>
					</view>
				</view>
				<view class="list">
					<view class="item line">
						<view class="number">排名</view>
						<view class="username paddingleft50">用户</view>
						<view class="money">佣金(元)</view>
					</view>
					<view class="item" v-for="(item,i) in list" :key="i">
						<view class="number">
							<image class="rank-image" :src="baseUrl+'/static/images/my/rank_icon_first.png'" v-if="i==0"></image>
							<image class="rank-image" :src="baseUrl+'/static/images/my/rank_icon_second.png'" v-else-if="i==1"></image>
							<image class="rank-image" :src="baseUrl+'/static/images/my/rank_icon_third.png'" v-else-if="i==2"></image>
							<view class="rank-image"  v-else>{{i}}</view>
						</view>
						<view class="username">
							<ks-image class="userimage" :src="item.UserFace" radius="50%"  type="user"></ks-image>
							<text>{{item.username}}</text>
						</view>
						<view class="money color">{{item.totalYJSS}}</view>
					</view>
					<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
					<ks-empty type="list" v-else>暂无数据</ks-empty>
				</view>
			</view>
		</view>
		<view class="bg" v-else-if="index==1">
			<image class="bg-image" mode="aspectFit" :src="baseUrl+'/static/images/my/rank_bg.png'"></image>
			<view class="position-bg">
				<view class="rank-text">子分销商数排行榜</view>
				<view class="look">快来看看你的子分销商数排名</view>
			</view>
			<view class="rank">
				<view class="my">
					<view class="left">
						<view>我的排名</view>
						<view class="rank-number">{{data.ranking}}</view>
					</view>
					<view class="middle">
						<ks-image radius="50%" class="ks-image" type="user"  :src="state.userInfo.UserFace"></ks-image>
						<view class="name">{{state.userInfo.UserName}}</view>
					</view>
					<view class="right">
						<view>我的分销商数</view>
						<view class="rank-number">{{data.rankingyj}}</view>
					</view>
				</view>
				<view class="list">
					<view class="item line">
						<view class="number">排名</view>
						<view class="username paddingleft50" >用户</view>
						<view class="money">子分销商数(家)</view>
					</view>
					<view class="item" v-for="(item,i) in list" :key="i">
						<view class="number">
							<image class="rank-image" :src="baseUrl+'/static/images/my/rank_icon_first.png'" v-if="i==0"></image>
							<image class="rank-image" :src="baseUrl+'/static/images/my/rank_icon_second.png'" v-else-if="i==1"></image>
							<image class="rank-image" :src="baseUrl+'/static/images/my/rank_icon_third.png'" v-else-if="i==2"></image>
							<view class="rank-image"  v-else>{{i}}</view>
						</view>
						<view class="username">
							<ks-image class="userimage" :src="item.UserFace" radius="50%"  type="user"></ks-image>
							<text>{{item.username}}</text>
						</view>
						<view class="money color">{{item.FXNum}}</view>
					</view>
					<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
					<ks-empty type="list" v-else>暂无数据</ks-empty>
				</view>
			</view>
		</view>
		
	</view>
</template>

<script>
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {ApplyRanking,ApplySon} from 'api/user'
	export default{
		components:{
			UniLoadMore
		},
		data(){
			return{
				tabs:['分销商佣金排名','子分销商数排名'],
				index: 0,
				baseUrl:this.$store.state.SRC+"/config/app",
				list:[],
				data:{},
				state:{},
				page:1,
				pageCount:1,
				moreStatus:'',
				load:false
			}
		},
		onPullDownRefresh() {
			if(this.index == 0){
				this.getList()	
			}else{
				this.getListSon()	
			}
		},
		/*滚动加载*/
		onReachBottom(){
			this.page++
			if(this.page<=this.pageCount){
				if(this.index == 0){
					this.getList(this.page)	
				}else{
					this.getListSon(this.page)	
				}	
			}	
		},
		methods:{
			changeTabs(e){
				if(e.tab === '分销商佣金排名'){
					this.getList()
				}else if(e.tab === '子分销商数排名'){
					this.getListSon()
				}
			},
			getListSon(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.data = {}
				this.moreStatus = 'loading'
				ApplySon({
					pageindex:this.page,
					pagesize:15,
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
			},
			getList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.data = {}
				this.moreStatus = 'loading'
				ApplyRanking({
					pageindex:this.page,
					pagesize:15,
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
			this.$store.ready(state=>{
				this.state = state
				this.getList()
			})
			
			
		}
	}
</script>

<style scoped>
	.paddingleft50{
		padding-left: 50px;
	}
	.ks-tabs{
		border-bottom: 1px solid #eee;position: fixed;top: 0;width: 100%;z-index: 100;
	}
	.bg{
		width: 100%;
		height: 160px;
		margin-top: 44px;
		position: relative;
	}
	.bg-image{
		width: 100%;
		height: 100%;
	}
	.position-bg{
		position: absolute;
		top: 0;
		left: 20px;
	}
	.rank-text{
		font-size:24px;
		font-family:Source Han Sans CN;
		font-weight:500;
		color:rgba(254,254,254,1);
		margin-top: 26px;
	}
	.look{
		font-size:12px;
		font-family:Source Han Sans CN;
		color:rgba(254,254,254,1);
		opacity:0.8;
		margin-top: 12px;
	}
	.rank{
		position: absolute;
		top:110px;
		width: 100%;
	}
	.my{
		margin: 0 15px;
		height:100px;
		background:rgba(255,255,255,1);
		border-radius:5px;
		font-size:16px;
		font-weight:500;
		color:rgba(102,102,102,1);
		text-align: center;
		overflow: hidden;
		position: relative;
	}
	.rank-number{
		font-size:21px;
		color:rgba(255,149,0,1);
		margin-top: 15px;
	}
	.left{
		float: left;
		margin-top: 20px;
		padding: 0 20px;
	}
	.right{
		float: right;
		margin-top: 20px;
		padding: 0 20px;
	}
	.middle{
		position: absolute;
		left: 50%;
		margin-left: -30px;
		width: 60px;
		height: 60px;
		margin-top: 5px;
	}
	.name{
		margin-top: 5px;
	}
	.ks-image{
		width:100%;
		height:100%;
		overflow: hidden;
	}
	.list{
		background:rgba(255,255,255,1);
		border-radius:5px;
		margin: 10px 15px 0 15px;
		padding: 0 15px 10px 15px;
	}
	.item{
		display: flex;
		padding: 10px 0;
		font-size:14px;
		font-weight:500;
		color:rgba(102,102,102,1);
		justify-content: center;
		align-items: center;
	}
	.line{
		border-bottom: 1px solid #D9D9D9;
	}
	.number{
		width:15%;
		text-align: center;	
		margin-right: 10px;
	}
	.money{
		width: 30%;
		text-align: center;
	}
	.username{
		flex: 1;
		display: flex;
		align-items: center;
	}
	.userimage{
		width:36px;
		height:36px;
		overflow: hidden;
		margin-right: 10px;
	}
	.color{
		color:rgba(255,149,0,1);
		font-size: 16px;
	}
	.rank-image{
		width: 32px;
		height: 32px;
		line-height: 32px;
		text-align: center;
		font-size: 16px;
		color:#333;
		display: inline-block;
	}
</style>
