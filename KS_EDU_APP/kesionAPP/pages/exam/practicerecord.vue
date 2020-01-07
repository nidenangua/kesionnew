<template>

    <view class="practice-record">
      <!-- 练习记录列表 -->
      <view class="practice-record-item">
        <view class="practice-record-box" v-for="(item, i) in list" :key="i">
          <view class="practice-record-box_top">
            <view class="practice-record-box_title">
			{{ item.title }}
            </view>
            <text>正确率：{{ item.zhunquelv }}%</text>
          </view>
          <view class="practice-record-box_bottom">
            <view class="practice-record-box_type">
              <view>
                练习时间：{{
                Math.floor(item.exam_time / 3600) >= 10
                ? Math.floor(item.exam_time / 60)
                : "0" + Math.floor(item.exam_time / 60)
                }}:{{
                Math.floor(item.exam_time / 60) >= 10
                ? Math.floor(item.exam_time / 60)
                : "0" + Math.floor(item.exam_time / 60)
                }}:{{
                item.exam_time % 60 >= 10
                ? item.exam_time % 60
                : "0" + (item.exam_time % 60)
                }}
              </view>
              <view class="practice-record__type-flex">练习类型：{{ item.type_name }}</view>
            </view>
            <view
              class="practice-record-box_see"
              @click="
                open(item)
              "
              v-if="item.show_analysis"
            >查看详情</view>
          </view>
        </view>
      </view>
      <uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
      		<ks-empty type="list" v-else>暂无数据</ks-empty>
    </view>

</template>

<script>
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {GetTestRecordList} from 'api/exam'
export default {
	components:{
		UniLoadMore
	},
  data() {
    return {
      value: null,
      list: [],
      pageCount: 0,
      page: 0,
	  moreStatus:"",
	  categoryid:0,
    }
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
		GetTestRecordList({
			categoryid: this.categoryid,
			page: p,
			pagesize: 15
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
    open(item) {
	  uni.navigateTo({
	  	url:`/pages/exam/analysis?name=analysis&id=${item.id}&type=2&paperid=0&categoryid=${item.categoryid}&title=${item.title}`
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
  padding: 0 15px;
  background: #fff;
}
.practice-record-box {
  padding-top: 13px;
  border-bottom: 1px solid #ebedef;
}
.practice-record-box_top {
  margin-top: 3px;
  width: 100%;
  min-height: 16px;
  display: flex;
  justify-content: space-between;
}
.practice-record-box_title {
	flex: 1;
  font-size: 14px;
  color: #333;

}
.practice-record-box_title ul li {
  list-style: disc inside none;
}
.practice-record-box_top text {
 
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
  background: #2987ee;
  text-align: center;
  line-height: 18px;
}
.practice-record__type-flex {
  display: flex;
}
</style>

