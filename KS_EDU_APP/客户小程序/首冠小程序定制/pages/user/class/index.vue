<template>
    <view>
        <view style="padding:0 15px">
            <view
                class="myclass"
                v-for="(item,i) in list"
                :key="item.roomid"
                @click="open(item)"
            >
                <view class="myclass-content">
                    <view class="myclass-content__title">{{item.title}}</view>
                    <view class="myclass-content__statistical">
                        已学习
                        <text class="myclass-content__statistical__span">{{item.has_coursecount}}</text>
                        门/共{{item.coursecount}}门
                    </view>
                    
					<progress class="myclass-content__progress" :percent="parseInt(item.has_learnpercent*100)" stroke-width="3" activeColor="#ff663d" />
                </view>
            </view>
			<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
            <ks-empty type="list" v-else>暂无数据</ks-empty>
        </view>
    </view>
    
</template>
<script>
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {GetMyRoomList} from 'api/user'
export default {
	components:{
		UniLoadMore
	},
    data() {
        return {
            list: [],
            page: 1,
            pageCount: 0,
			moreStatus:"",
        };
    },
	/*下拉刷新*/
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
    methods: {
   
		/**请求收藏列表*/
		getList(p=1){
			this.page = p
			if(this.page==1){
				this.list = []
			}
			this.moreStatus = 'loading'
			GetMyRoomList({
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
		},
        open(item) {
			if(this.$store.state.isshowprice){
				uni.navigateTo({
					url:'/pages/web/web?url='+encodeURIComponent('/room/'+item.roomid)+'&title='+item.title
				})
			}
            
        }
    },
    onShow() {
        this.getList();
    }
}
</script>
<style scoped>
.myclass {
  margin-top: 10px;
  background-color: #fff;
  width: 100%;
  height: 100px;
  border-radius: 5px;
}
.myclass-content {
  padding: 15px;
}
.myclass-content__title {
  font-size: 15px;
  float: left;
  font-weight: bold;
}
.myclass-content__vtitle {
  font-size: 13px;
  float: right;
  margin-top: 2.7px;
}
.myclass-content__statistical {
  margin-top: 30px;
  clear: both;
  font-size: 13px;
  color: rgba(153, 153, 153, 1);
}
.myclass-content__progress {
  margin-top: 10px;
}
.myclass-content__statistical__span {
  color: #f45050;
  font-size: 13px;
}
</style>
