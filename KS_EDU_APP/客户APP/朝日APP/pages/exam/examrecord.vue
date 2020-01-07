<template>

    <view class="contianer">

      <!-- 考试记录列表 -->
      <view class="examRecord-item" >
        <view class="examRecord-box" v-for="(item,i) in list" :key="i">
          <view class="examRecord-box_top">
            <view class="examRecord-box_title">
			{{item.title}}
            </view>
            <text v-if="item.batch==0">- -</text>

            <text v-else-if="item.iscorrect==0">待批卷</text>
            <text v-else-if="item.is_publish==0">待公布</text>
            <text v-else>{{item.sumscore}}分</text>
          </view>
          <view class="examRecord-box_bottom">
            <view class="examRecord-box_type">
              练习时间：{{
              Math.floor(item.time / 3600) >= 10
              ? Math.floor(item.time / 60)
              : "0" + Math.floor(item.time / 60)
              }}:{{
              Math.floor(item.time / 60) >= 10
              ? Math.floor(item.time / 60)
              : "0" + Math.floor(item.time / 60)
              }}:{{
              item.time % 60 >= 10 ? item.time % 60 : "0" + (item.time % 60)
              }}
            </view>
            <view class="examRecord-box_method">
              <view
                class="examRecord-box_see"
                v-if="item.is_delrecord == 1"
                style="margin-right:10px;"
                @click="delrecord(item.id)"
              >删除记录</view>
             <navigator class="examRecord-box_see" :url="`/pages/exam/analysis?name=analysis&paperid=${item.paperid}&categoryid=${categoryid}&id=${item.id}&type=1&title=${item.title}`"  v-if="item.show_analysis&&item.batch==1"  open-type="navigate">
               查看解析
             </navigator>
			  <navigator class="examRecord-box_see" :url="`/pages/exam/paperinfo?paperid=${item.paperid}&categoryid=${categoryid}`"  v-if="item.is_repractice != 0"  open-type="navigate">
			    {{item.is_repractice==2?'继续练习':'重新练习'}}
			  </navigator>
            </view>
          </view>
        </view>
      </view>
      <uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
      	<ks-empty type="list" v-else>暂无数据</ks-empty>
    </view>

</template>

<script>
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {GetPaperRecordList,DeletePaperRecord} from 'api/exam'
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
 
    delrecord(id) {
     DeletePaperRecord({
        ids: id,
        categoryid: this.categoryid
      }).then(res=> {
        this.getList();
      });
    },
	getList(p=1){
		this.page = p
		if(this.page==1){
			this.list = []
		}
		this.moreStatus = 'loading'
		GetPaperRecordList({
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
.contianer {
  width: 100%;
  min-height: 100vh;
  background: #fff;
}
/* 间距 */
.margin20 {
  width: 100%;
  height: 0.5rem;
  background: #f5f5f5;
}

/* 考试记录列表 */
.examRecord-item {
  width: 90%;
  margin: 0 auto;
  background: #fff;
}
.examRecord-box {
	padding-top: 13px;
  border-bottom: 1px solid #ebedef;
}
.examRecord-box_top {
  display: flex;
  justify-content: space-between;
  margin-top: 3px;
}
.examRecord-box_top text {
  font-size: 14px;
  color: #2987ee;
}
.examRecord-box_title {
  width: 75%;
  font-size: 14px;
  color: #333;
  float: left;
}
.examRecord-box_title ul li {
  list-style: disc inside none;
}
.examRecord-box_top text {
  width: 25%;
  float: right;
  text-align: right;
}
.examRecord-box_bottom {
  margin-top: 6px;
  width: 100%;
  height: 32px;
  display: flex;
  justify-content: space-between;
}
.examRecord-box_type {
  width: 40%;
  font-size: 10px;
  font-family: PingFangSC-Light;
  font-weight: 300;
  color: #999;
  display: flex;
  justify-content: space-between;
}
.examRecord-box_method {
  flex: 1;
  display: flex;
  justify-content: flex-end;
}
.examRecord-box_see {
  font-size: 12px;
  color: #fff;
  width: 65px;
  height: 20px;
  border-radius: 10px;
  background: #2987ee;
  text-align: center;
  line-height: 20px;
  margin-left: 10px;
}
.type-flex {
  display: flex;
}
</style>
