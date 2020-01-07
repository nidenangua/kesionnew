<template>
	<view>
		<ks-tabs :value.sync="index" :tabList="tabList" @change="changeTabs" rangeKey="name" style="border-bottom: 1px solid #eee;position: fixed;top: 0;width: 100%;z-index: 1000;"></ks-tabs>
		
		<view style="margin-top: 44px;">
			<view class="course-list">
				<view class="course-item" v-for="(item,i) in list" :key="i" @click="open(item)">
					<view class="course-image">
						<ks-image radius="5px" class="ks-image" :src="item.photourl"></ks-image>
						<view style="text-align: left;display: flex;flex-direction: column;justify-content: space-between;" >
							<view style="height: 62px;">
								<view class="ks-course__title--1" style="line-height: 20px;">{{item.name}}</view>
								<view class="course-costype" style="margin-top: 10px;">
									{{(item.teachWay == 0 && "面授")||(item.teachWay == 1 && "点播")||(item.teachWay == 2 && "组合")||(item.teachWay == 5 && "直播")}}
								</view>
							</view>
							<view  style="display: flex;justify-content: space-between;align-items: center;">
								<progress style="flex: 1;" :percent="item.has_learnpercent" activeColor="#2987EE" stroke-width="3" />
								<text style="color:#999;font-size: 12px;margin-left: 10px;">已学{{item.has_learnpercent}}%</text>
							</view>
							
						</view>
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
	import {GetUserCourseList} from 'api/user'
	export default {
		components:{
			UniLoadMore
		},
		data() {
			return {
				tabList:[],
				index:0,
				list:[],
				costype:-1,
				page:1,
				pageCount:1,
				moreStatus:"",
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
		onLoad() {
			if(!this.$store.state.isshowprice){
				this.tabList=[{
					name:'全部',
					value:-1
				},{
					name:'点播',
					value:1
				},{
					name:'面授',
					value:0
				}]
			}else{
				this.tabList=[{
					name:'全部',
					value:-1
				},{
					name:'点播',
					value:1
				},{
					name:'直播',
					value:5
				},{
					name:'面授',
					value:0
				}]
			}
			this.getList(); 
		},
		methods: {
			changeTabs(e){
				this.costype = e.tab.value
				this.getList()	
			},
			open(item){
				uni.navigateTo({
					url:'/pages/web/web?title='+item.name+'&photo='+item.photourl+'&url='+encodeURIComponent(item.view_url)
				})
			},
			/**请求课程列表*/
			getList(p=1){
				this.page = p
				if(this.page==1){
					this.list = []
				}
				this.moreStatus = 'loading'
				GetUserCourseList({
					costype: (this.index == 0 && -1)||(this.index == 1 && 1)||(this.index == 2 && 5)||(this.index == 3 && 0),
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
			}
		}
	}
</script>

<style scoped>
	.course-item{
		background: #fff;
		padding: 10px;
	}

	.course-image{
		padding: 0 0 0 130px;
		position: relative;
		min-height: 80px;
	}
	.course-image .ks-image{
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

