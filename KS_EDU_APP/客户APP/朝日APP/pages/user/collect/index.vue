<template>
	<view>
		<ks-tabs :value.sync="index" :tabList="tabs" @change="changeTabs" style="border-bottom: 1px solid #eee;position: fixed;top: 0;width: 100%;z-index: 100;"></ks-tabs>
		
		<view style="margin-top: 44px;z-index: 10;">
			<ks-tabs style="margin: 10px 0;" :value.sync="active" :tabList="tabList" @change="changeList" :scroll="true" rangeKey="name" v-if="index == 0"></ks-tabs>
			<view class="collect-list" v-if="index == 0">
				<view class="collect-item" v-for="(item,i) in list" :key="i" @click="open(item)">
					<view class="collect-image">
						<ks-image radius="5px" class="ks-image" :type="item.favorite_type_str=='教师'?'teacher':''" :aspect="item.favorite_type_str=='试卷'?'aspectFit':'aspectFill'" :src="item.photourl"></ks-image>
						<view style="text-align: left;display: flex;flex-direction: column;justify-content: space-between;" >
							<view style="height: 62px;">
								<view class="ks-course__title--2" style="line-height: 20px;">{{item.title}}</view>
								<view class="course-costype" style="margin-top: 10px;">
									{{item.favorite_type_str}}
								</view>
							</view>
						</view>
					</view>	
				</view>
				<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
				<ks-empty type="list" v-else>暂无数据</ks-empty>
			</view>
			<view class="collect-list" v-else-if="index == 1">
				<view class="collect-item" v-for="(item,i) in list" :key="i" style="margin-top: 10px;" @click="openAsk(item)">
					<view class="ks-course__title--1">{{item.title}}</view>
					<view class="flex-box__space">
						<view class="item-date" style="margin-top: 10px;">{{item.adddate}}</view>
						<view :style="{color:item.issolve_str == '未解决'?'#FF3B30':'#00AB68'}" style="font-size:12px">{{item.issolve_str}}</view>
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
	import {GetUserFavoriteList,GetUserAskFavriteList} from 'api/user'
	export default {
		components:{
			UniLoadMore
		},
		data() {
			return {
				tabs:['我的收藏','问题收藏'],
				active:0,
				index:0,
				tabList:[],
				list:[],
				status:-1,
				page:1,
				pageCount:0,
				moreStatus:"",
			}
		},
		onPullDownRefresh() {
			if(this.index == 0){
				this.getList()
			}else{
				this.getAskList()
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
			this.$store.ready(state=> {
				console.log(state)
			    var modelList = [
			    {
			      value: -1,
			      name: "全部"
			    },
			    {
			      value: 1,
			      name: "文章"
			    }
			  ];
			  // if (state.model.mall) {
			  //   modelList.push({
			  //     value: 4,
			  //     name: "商城"
			  //   });
			  // }
			  if (state.userInfo.model.teacher) {
			    modelList.push({
			      value: 0,
			      name: "教师"
			    });
			  }
			  if (state.userInfo.model.exam) {
			    modelList.push({
			      value: 50,
			      name: "试卷"
			    });
			  }
			  if (state.userInfo.model.edu) {
				if(!state.isshowprice){
					modelList.push(
					  {
					    value: -10,
					    name: "点播"
					  },
					  {
					    value: -11,
					    name: "面授"
					  }
					);
				}else{
					modelList.push(
					  {
					    value: -10,
					    name: "点播"
					  },
					  {
					    value: -11,
					    name: "面授"
					  },
					  {
					    value: -12,
					    name: "直播"
					  }
					);
				}
			    
			  }
			  this.tabList = modelList;
			  
			})

		},
		onShow() {
			this.getList(); 
		},
		methods: {
			openAsk(item){
				uni.navigateTo({
					url:'/pages/class-center/ask/details?topicid='+item.topicid
				})
			},
			open(item){
				
				var url = ''
				if(item.favorite_type_str=='面授'||item.favorite_type_str=='点播'||item.favorite_type_str=='直播'){
					url = '/pages/web/web?title='+item.title+'&photo='+item.photourl+'&url='+encodeURIComponent('/course/'+item.InfoID)
				}else if(item.favorite_type_str=='文章'){
					url = '/pages/web/web?title='+item.title+'&photo='+item.photourl+'&url='+encodeURIComponent(item.view_url)
				}else if(item.favorite_type_str=='教师'){
					url = '/pages/teacher/details?tcid='+item.InfoID
				}else if(item.favorite_type_str=='试卷'){
					url = '/pages/web/web?title=试卷介绍'+'&url='+encodeURIComponent('/config/app/#/exam/paperinfo?paperid='+item.InfoID)
				}
				uni.navigateTo({
					url:url
				})
			},
			changeTabs(e){
			
				if(e.tab === '问题收藏'){
					this.getAskList()
				}else{
					this.getList()
				}
			},
			changeList(e){
				this.status = e.tab.value
				this.getList()
			},
			/**请求收藏列表*/
			getList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.moreStatus = 'loading'
				GetUserFavoriteList({
					channelid: this.status,
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
			},/**请求问题收藏列表*/
			getAskList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.moreStatus = 'loading'
				GetUserAskFavriteList({
					channelid: this.status,
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
			}
		}
	}
</script>

<style scoped>
	.collect-item{
		background: #fff;
		padding: 10px;
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
	}
</style>

