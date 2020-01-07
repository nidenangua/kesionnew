<template>
	<view class="content" v-if="loaded">
		<ks-tabs :value.sync="index" :tabList="tabs" @change="changeTabs"></ks-tabs>
		<view class="filter scroll-view_H clearfix">
			<scroll-view class="scroll-view-item_H" scroll-x="true">
				<view class="scroll-view-item_H filter-view-item" v-for="item in classList" :key="item.id" :class="item.id==getParameters.flag ? 'on':''" @click="setClassIndex(item.id)">{{item.name}}</view>
			</scroll-view>
		</view>
		<view class="collect-list" v-if="list.length">
			<view class="box">
				<view class="collect-item withe-bg" v-for="(item,i) in list" :key="i" @click="open(item)">
					<view class="ks-course__title--1">{{item.title}}</view>
					<view class="ask-con">{{item.content}}</view>
					<view class="flex-box__space">
						<view class="item-date">
							<view class="item-col">{{item.adddate}}</view>
							<view class="item-col">{{item.postnum}}个回答</view>
						</view>
						<view :style="{color:item.issolve_str == '未解决'?'#FF3B30':'#00AB68'}" style="font-size:12px">{{item.issolve_str}}</view>
					</view>
				</view>
			</view>
			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
		</view>
		<ks-empty type="list" v-else>暂无数据</ks-empty>
	</view>
</template>

<script>
	import {GetUserAskTopList} from 'api/user'
	import UniLoadMore from '@/components/uni/uni-load-more/uni-load-more.vue'
	
	export default {
		data() {
			return {
				loaded:false,
				tabs:['全部','未解决','已解决'],
				index:0,
				list:[],
				getParameters:{
					flag:-1,
					showstatus:-1,
					page:1,
					pagesize:10,
					channelid:-1,
					mytype:1
				},
				pageCount:0,
				moreStatus:'more',
				classList:[
					{id:-1,name:'全部'},
					{id:1,name:'文章'},
					{id:10000,name:'问答'},
					{id:10001,name:'班级'},
					{id:10002,name:'课程'},
					{id:10003,name:'教师'},
					{id:10004,name:'播放页'}
				]
			}
		},
		components:{
			UniLoadMore
		},
		onReachBottom(e){
			this.getParameters.page++
			this.moreList()
		},
		onPullDownRefresh() {
			this.loadPage()
		},
		onLoad() {
			uni.showLoading({
			    title: '加载中'
			});
			this.$store.ready(state=> {
				this.loadPage(); 
			})
		},
		methods: {
			changeTabs(e){
				if(e.tab=='全部'){
					this.getParameters.showstatus = -1
				}else if(e.tab=='未解决'){
					this.getParameters.showstatus = 0
				}else{
					this.getParameters.showstatus = 1
				}
				
				this.loadPage()
			},
			setClassIndex(id){
				this.getParameters.flag = id
				this.getParameters.channelid = id
				this.loadPage()
			},
			open(item){
				var url = encodeURIComponent(item.view_url)
				if(item.flagid==1||item.flagid==10001||item.flagid==10002||item.flagid==10004){
					uni.navigateTo({
						url:'/pages/web/web?title='+item.title+'&photo='+item.defaultpic+'&url='+url
					})
				}else if(item.flagid==10000){
					uni.navigateTo({
						url:'/pages/class-center/ask/details?topicid='+item.topicid
					})
				}else if(item.flagid==10003){
					uni.navigateTo({
						url:'/pages/teacher/details?tcid='+item.topicid
					})
				}
				
			},
			moreList(){
				if(this.getParameters.page > this.pageCount){
					this.moreStatus = 'noMore'
				}else{
					this.moreStatus = 'loading'
					this.loadPage('more')
				}
				
			},
			loadPage(status){
				if(status=='more'){
					GetUserAskTopList(this.getParameters).then(res=>{
						this.moreStatus = 'more'
						if(res.result){
							res.data = res.data.filter(item=>{//下载先隐藏
								if(item.flag_str!='下载'){
									return item
								}
							})
							this.list = this.list.concat(res.data)
						}
						this.loaded = true
					})
				}else{
					this.getParameters.page = 1
					GetUserAskTopList(this.getParameters).then(res=>{
						if(res.result){
							this.pageCount = res.pagecount
							if(this.pageCount==1){
								this.moreStatus = 'noMore'
							}else{
								this.moreStatus = 'more'
							}
							this.list = res.data.filter(item=>{
								if(item.flag_str!='下载'){
									return item
								}
							})
						}else{
							this.list = []
							this.pageCount = 0
						}
						this.loaded = true
						uni.stopPullDownRefresh();
						uni.hideLoading();
					})
				}
			}
		}
	}
</script>

<style lang="scss" scoped>
	.filter{
		padding-top: 11px;
		padding-left: 10px;
		box-sizing: border-box;
		background: #f6f6f6;
		
		.filter-view-item{
			display: inline-block;
			text-align: center;
			padding: 4px 12px;
			background: #fff;
			margin-right: 10px;
			border-radius: 3px;
			font-size: 14px;
		}
		.on{
			color: #fff;
			background: #007AFF;
		}
	}
	.scroll-view_H{
		white-space: nowrap;
		width: 100%;
	}
	.collect-item{
		background: #fff;
		padding: 10px;
		margin-top: 10px;
	}

	.collect-image{
		padding: 0 0 0 130px;
		position: relative;
		min-height: 80px;
	}
	.collect-image .ks-image{
		position: absolute;
		top:0;
		left: 0;
		height: 80px;
		width: 120px;
		border-radius:4px;
	}
	.course-costype{	
		font-size:14px;
		color:rgba(136,136,136,1);
	}
	.item-date{
		font-size:12px;
		color:rgba(146,150,153,1);
		.item-col{
			display: inline-block;
			margin-right: 10px;
		}
	}
	.ask-con{
		font-size: 12px;
		color: #666666;
		line-height: 21px;
		margin-top: 7px;
		margin-bottom: 17px;
	}
</style>

