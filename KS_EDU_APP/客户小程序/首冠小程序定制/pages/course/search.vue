<template>
	<view style="background: #fff;min-height: 100vh;">
		<view style="position: fixed;top: 0;background: #fff;width:calc(100% - 20px);padding:0 10px;height: 44px;display: flex;justify-content: center;align-items: center;z-index: 100;">
				<view class="search-input">
					<icon type="search" size="18"/>
					<input v-model="key" placeholder="搜索你想要的内容" :focus="focus" confirm-type="search" @confirm="goGetList()" />				
				</view>
		</view>
		<view style="padding: 0 10px;">
			<!-- <view class="flex-box__space" style="margin-top: 20px;font-size:14px;color:rgba(1,12,23,1);">
				<view>历史记录</view>
				<view style="font-size:12px;color:rgba(41,135,238,1);">清除记录</view>
			</view>
			<view style="margin-top: 5px;">
				<button style="margin: 10px 10px 0 0;" size="mini" plain>按钮</button>
			</view> -->
			<view class="ks-course__list" style="margin-top: 44px;padding-top: 10px;">
				<view class="title" v-if="pageCount > 0">相关内容</view>
				<block v-for="(item,i) in list">
					<view class="ks-course__item" :key="i" @click="open(item)" v-if="item.ModuleType!=4">
						<ks-image class="ks-image" radius="5px" :src="item.defaultPic" :aspect="item.ModuleType==6?'aspectFit':'aspectFill'"></ks-image>
						<view style="display: flex;flex-direction: column;height: 100px;">
								<view class="ks-course__title--2" style="height: 50px;">{{item.Title}}</view>
							<view class="flex-box__space" style="font-size: 12px;margin-top: 10px;">
								{{(item.ModuleType==1&&'文章')||(item.ModuleType==2&&'课程')||(item.ModuleType==3&&'班级')||(item.ModuleType==4&&'机构')||(item.ModuleType==5&&'老师')||(item.ModuleType==6&&'试卷')}}
							</view>
						</view>	
					</view>
				</block>
				
				<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
				<ks-empty type="list" v-else>暂无相关数据</ks-empty>
			</view>
		</view>
	</view>
	
</template>

<script>
	import {UniRate} from 'components/uni/uni-rate/uni-rate'
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {Generalquery} from 'api/index'
	export default {
		components:{UniLoadMore,UniRate},
		data() {
			return {
				key:'',
				page:1,
				pageCount:1,
				moreStatus:'',
				list:[],
				focus:false
			}
		},
		onPullDownRefresh() {
			if(this.key){
				this.getList() 
			}
			
		},
		/*滚动加载*/
		onReachBottom(){
			this.page++
			if(this.page<=this.pageCount){
				this.getList(this.page)
			}	
		},
		onLoad(query) {
			if(query.key){
				this.key = query.key
				this.getList()
			}else{
				this.focus = true
			}
		},
		methods: {
			open(item){
			
				var url
				if(item.ModuleType==1){
					if(item.readpoint - 0 >0){
						uni.showToast({
						    title: '暂不支持观看付费资讯，请到h5或pc端查看',
						    duration: 2000,
							icon:'none',
						});
						return
					}else{
						url='/pages/web/web?title='+item.Title+'&photo='+item.defaultPic+'&url='+encodeURIComponent(item.weburl)
					}
					
				}else if(item.ModuleType==2){
					url="/pages/web/web?title="+item.Title+'&photo='+item.defaultPic+'&url='+encodeURIComponent(item.weburl)
				}else if(item.ModuleType==3){
					url="/pages/web/web?title="+item.Title+'&photo='+item.defaultPic+'&url='+encodeURIComponent(item.weburl)
				}else if(item.ModuleType==4){
					url="/pages/school/details?schoolid="+item.InfoID
				}else if(item.ModuleType==5){
					url="/pages/teacher/details?tcid="+item.InfoID
				}else if(item.ModuleType==6){
					url='/pages/web/web?url='+encodeURIComponent('/config/app/#/exam/paperinfo?paperid='+item.InfoID)+'&title=试卷介绍'
				}
				uni.navigateTo({
					url:url
				})
			},
			goGetList(){
				if(this.key){
					this.getList()
				}
			},
			getList(p=1){
				
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.moreStatus = 'loading'
			
				Generalquery({
					currpage:this.page,
					pagesize:10,
					key:this.key
				}).then(res=>{
					uni.stopPullDownRefresh();
					this.pageCount = res.pagecount
					if(this.page >= this.pageCount){
						this.moreStatus = 'noMore'
					}else{
						this.moreStatus = 'more'
					}
					if(res.result){
						this.list = this.list.concat(res.GeneralqueryList)
					}
				})		
			}
		}
	}
</script>

<style>
	.search-input{
		flex: 1;
		height: 32px;
		background: #F7F7F7;
		border-radius: 12px;
		display: flex;
		align-items: center;
	}
	.search-input icon{
		 margin: 0 10px;
	}
	.search-input input{
		height: 100%;
		line-height: 20px;
		placeholder-color: #888888;
		font-size: 13px;
		flex: 1;
		min-height: 20px;
		height: 20px;
	}
	.search{
		font-size:16px;
		color:rgba(1,12,23,1);
		margin-left: 10px;
	}
	.title{
		margin: 10px 0 5px 0;
		font-size:16px;
		font-weight:500;
		color:rgba(1,12,23,1);
	}
	.ks-course__marketprice{
		font-size:12px;
		color:#888888;
	}
	.ks-course__price{
		color:#FF3B30;
		font-size:16px;
	}
	.ks-course__title--1{
		overflow: hidden;
		white-space: nowrap;
		word-wrap:break-word;
		text-overflow: ellipsis;
		font-size:16px;
		font-family:PingFang SC;
		font-weight:500;
		color:rgba(26,26,26,1);
		line-height: 24px;
	}
	.ks-course__title--2{
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		word-wrap:break-word;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		font-size:16px;
		font-family:PingFang SC;
		font-weight:500;
		color:rgba(26,26,26,1);
		line-height: 24px;
		max-height: 48px;
	}
	.ks-course__item{
		border-radius: 8px;
		padding: 15px 10px 10px 170px;
		min-height: 100px;
		position: relative;	
	}
	
	.ks-course__item .ks-image{
		width: 150px;
		height: 100px;
		position: absolute;
		left: 10px;
		top: 15px;
		border-radius: 5px;
		overflow: hidden;
	}
</style>
