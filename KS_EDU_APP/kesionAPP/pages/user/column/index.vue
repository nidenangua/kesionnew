<template>
  <view>
	<view class="course-item" v-for="(item,i) in list" :key="i" @click="open(item)">
		<view class="course-image">
			<ks-image radius="5px" class="ks-image" :src="item.photourl"></ks-image>
			<view style="text-align: left;display: flex;flex-direction: column;justify-content: space-between;" >
				<view style="height: 62px;">
					<view class="ks-course__title--1" style="line-height: 20px;">{{item.name}}</view>
					<view class="course-costype" style="margin-top: 10px;">
						共{{ item.course_count }}门课程&nbsp;|&nbsp;{{
						  item.paper_count
						}}份试卷&nbsp;|&nbsp;{{ item.shop_count }}件商品
					</view>
				</view>
				<view  style="display: flex;justify-content: space-between;align-items: center;font-size: 14px;">
					授课老师：{{ item.teacher_name }}
				</view>
				
			</view>
		</view>	
	</view>
	<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
    <ks-empty type="list" v-else>暂无专栏</ks-empty>
  </view>
</template>
<script>
	import {GetUserSpecialList} from 'api/user'
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
  export default {
	  components:{
	  	UniLoadMore
	  },
    data() {
      return {
        active: 0,
        list: [],
		moreStatus:"",
        page: 1,
        pageCount: 0,
      };
    },
	onPullDownRefresh() {
		this.getList() 
	},
    onLoad() {
      this.getList();
    },
	/*滚动加载*/
	onReachBottom(){
		this.page++
		if(this.page<=this.pageCount){
			this.getList(this.page)
		}	
	},
    methods: {
      /*滚动加载*/
      onLoad() {
        this.page += 1;
        this.getList(this.page);
      },

      open(item) {
        uni.navigateTo({
        	url:'/pages/web/web?url='+encodeURIComponent('/course/'+item.courseid)+'&title='+item.name
        })
      },
      /*获取列表*/
      getList(p=1) {
		this.page = p
		if(this.page==1){
			this.list = []
		}
		this.moreStatus = 'loading'
		GetUserSpecialList({
			channelid: this.channelid,
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
  };
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
