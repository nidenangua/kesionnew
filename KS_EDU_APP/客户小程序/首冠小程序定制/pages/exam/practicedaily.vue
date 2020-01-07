<template>

    <view class="practice-record">
  
      <!-- 间距 -->
      <view class="margin20"></view>

      <!-- 练习记录列表 -->
      <view class="practice-record-item" style="padding-top:10px;">
        <view class="practice-record-box" v-for="(item, i) in list" :key="i">
          <view class="practice-record-box_top">
            <view class="practice-record-box_title">{{ item.time }}</view>
            <!-- <text>正确率：{{item.zhunquelv}}%</text> -->
          </view>
          <view class="practice-record-box_bottom">
            <view class="practice-record-box_type">
              <view>练习时间：{{ item.week }}</view>
              <view class="practice-record-box__type-flex">练习类型：每日一练</view>
            </view>
            
			<navigator class="practice-record-box_see" :url="`/pages/exam/testpage?day=${item.day}&categoryid=${categoryid}&title=${item.time}&type=6&name=exercise`" open-type="navigate">
			  开始做题
			</navigator>
          </view>
        </view>
      </view>
		<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
     	<ks-empty type="list" v-else>暂无数据</ks-empty>
    </view>

</template>

<script>
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {GetDailyTestDateList} from 'api/exam'
export default {
	components:{
		UniLoadMore
	},
  data() {
    return {
      list: [],
      pageCount: 0,
      page: 0,
		moreStatus:"",
		categoryid:0,
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
	getList(p=1){
		this.page = p
		if(this.page==1){
			this.list = []
		}
		this.moreStatus = 'loading'
		GetDailyTestDateList({
			categoryid: this.categoryid,
			page: p,
			pagesize: 15
		}).then(res=>{
			
			this.moreStatus = 'noMore'
			if(res.result){
				this.pageCount = 1
				this.list = this.list.concat(res.data)
			}
		})		
	}
 
  },
  onLoad(query) {
  	this.categoryid = query.categoryid
  },
  onShow() {
    this.getList();
  }
};
</script>

<style scoped>
.van-icon-arrow-left {
  color: #4d4c4c !important;
}
.practice-record {
  width: 100%;
  min-height: 100vh;
  background: #fff;
}
/* 间距 */
.practice-record .margin20 {
  width: 100%;
  height: 10px;
  background: #f5f5f5;
}

/* 练习记录列表 */
.practice-record-item {
  width: 90%;
  margin: 0 auto;
  background: #fff;
}
.practice-record-box {
  margin-bottom: 13px;
  border-bottom: 1px solid #ebedef;
}
.practice-record-box_top {
  margin-top: 3px;
  width: 100%;
  min-height: 16px;
}
.practice-record-box_title {
  width: 75%;
  font-size: 14px;
  color: #333;
  float: left;
}
.practice-record-box_title ul li {
  list-style: disc inside none;
}
.practice-record-box_top text {
  width: 25%;
  float: right;
  text-align: right;
}
.practice-record-box_bottom {
  margin-top: 6px;
  width: 100%;
  height: 32px;
  display: flex;
  justify-content: space-between;
}

.practice-record-box_type {
  width: 75%;
  font-size: 10px;
  color: #999;
  display: flex;
  justify-content: space-between;
}
.practice-record-box_see {
  font-size: 11px;
  color: #fff;
  width: 58px;
  height: 18px;
  border-radius: 9px;
  background: #ff663d;
  text-align: center;
  line-height: 18px;
}
.practice-record-box__type-flex {
  display: flex;
}
</style>
