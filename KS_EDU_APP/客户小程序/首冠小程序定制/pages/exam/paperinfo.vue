<template>
    <view class="paper-info">
      <!-- 考试题库列表 -->
      <view class="paper-info-item">
        <view class="border-bottom bottom-line">
          <view text="24" class="center-align">{{paperInfo.title}}</view>
        </view>
        <view class="border-bottom bottom-line" style="display: flex;">
          <view style="width:50%;" class="right-align">试卷总分：{{paperInfo.sumscore}}分</view>
          <view style="width:50%;" class="left-align left-line">试卷难度：{{paperInfo.paper_level_name}}</view>
        </view>
        <view class="border-bottom bottom-line" style="display: flex;">
          <view style="width:50%;" class="right-align">试卷类型：{{paperInfo.exam_typename}}</view>
          <view style="width:50%;" class="left-align left-line">考试人数：{{paperInfo.studentcount}}人</view>
        </view>
        <view class="border-bottom bottom-line" style="display: flex;">
          <view style="width:50%;" class="right-align">
            <text class="first-child line-height26" v-if="!paperInfo.isfree">
              试卷价格：
              <text class="green-font f15">免费</text>
            </text>
            <text
              class="first-child line-height26"
              v-else-if="paperInfo.isfree&&paperInfo.is_singlebuy"
            >
              试卷价格：
              <text>{{paperInfo.price}}{{paperInfo.chargetype_unit}}</text>
            </text>
            <text class="first-child line-height26" v-else>
              试卷价格：
              <text class="red-font f15">不允许单购</text>
            </text>
          </view>
          <view style="width:50%;" class="left-align left-line">答题时间：{{paperInfo.exam_time||'暂无'}}</view>
        </view>
      </view>
      <view class="center-align p15">
        <button
          class="w95 mr10 collect-btn vertical-align"
       
		   plain
		   style="border-radius: 20px;border-color: #ff663d;color:#ff663d"
          @click="collectionPaper"
          v-if="state.userInfo.UserID"
        >
          <i
            class="iconfont mr5"
            :class="collect==0?'icon-shoucang':'yellow-font icon-shoucang1'"
          ></i>
          {{collect == 0 ? '收藏试卷':'取消收藏'}}
        </button>
        <button
  
          class="w95 mr10 vertical-align"
		  style="border-radius: 20px;color:#fff"
		  @click="open(paperInfo)"
        >进入做题</button>
      </view>
    </view>
</template>

<script>
	import {SetPaperCollect,PaperDesc} from 'api/exam'
export default {
  name: "paperinfo",
  data() {
    return {
      classes: "未选择",
      //选中课程
      searchText: "",
      //搜索内容
      value: null,
      size: 9,
      readonly: true,
      paperInfo: {},
      //接口返回数组
      onshow: false,
      active: null,
      id: null,
      typeData: [],
      typeid: 0,
      paperid: 0,
      categoryid: 0,
      isPayPaper: false,
      collect: 1,
	  courseid:'',
	  workid:'',
	  stu:'',
	  state:{}
    };
  },
  methods: {
	open(item){
		uni.navigateTo({
			url:`/pages/exam/testpage?name=testpage&paperid=${this.paperid}&courseid=${this.courseid}&categoryid=${this.categoryid}&workid=${this.workid}&stu=${this.stu}&title=${item.title}`
		})
	},
    // 弹出层开关
    popup() {
      this.onshow = true;
    },
    newClass(classes) {
      this.classes = classes;
    },
    getPaperInfo() {
      
      this.onshow = false;
      PaperDesc({
        paperid: this.paperid,
        categoryid: this.categoryid
      }).then(res=> {
        if (res.result) {
          this.paperInfo = res.data;
          this.collect = res.data.collect;
        } else {
		  uni.showToast({
		  	title:res.msg,
			icon:'none'
		  })
        }
        
      });
    },
  

    /**收藏试卷 */
    collectionPaper () {
		this.collect ? this.collect = 0 : this.collect = 1;
		
     SetPaperCollect({
        type: 1,
        infoid: this.paperid,
        categoryid: this.categoryid,
        collect: this.collect
      }).then(res=> {
        if (res.result) {
			var tipstext = "";
			if (this.collect == 1) {
			  tipstext = "收藏成功";
			} else {
			  tipstext = "取消收藏";
			}
			uni.showToast({
				title:tipstext
			})
        } else {
			uni.showToast({
				title:res.msg,
				icon:'none'
			})
        }
      });
    }
  },
  onLoad(query) {
		console.log(query)
		this.categoryid = query.categoryid
		this.paperid = query.paperid
		this.courseid = query.courseid || ''
		this.workid = query.workid || ''
		this.stu = query.stu || ''
  },
  onShow() {
    this.$store.ready(state=> {
		this.state = state
		if (uni.getStorageSync('classes_'+state.userInfo.UserID)) {
		  this.classes = uni.getStorageSync('classes_'+state.userInfo.UserID);
		} 
		this.getPaperInfo();
	})
    
  }
};
</script>

<style>
	
.van-icon-arrow-left {
  color: #4d4c4c !important;
}
.active {
  background: #ff663d !important;
  color: #fff !important;
}
.navtitle img {
  width: 10px;
  height: 10px;
  margin-left: 5px;
}
.paper-info {
  width: 100%;
  min-height: 100vh;
  background: #f5f5f5;
}
/* 导航 */
.paper-info-nav {
  border-bottom: 1px solid #ebebeb;
  font-size: 14px;
  font-family: PingFang-SC-Regular;
  font-weight: 400;
  background: #f0f4f7;
  width: 90%;
  padding: 0 5% 10px 5%;
}
.paper-info-nav text {
  margin-right: 10px;
  display: inline-block;
  height: 28px;
  width: 74px;
  font-size: 14px;
  font-family: PingFang-SC-Regular;
  font-weight: 400;
  color: #010c17;
  line-height: 28px;
  text-align: center;
  background: #fff;
  border-radius: 4px;
  border: 1px solid #ff663d;
  margin-top: 10px;
}
/* 考试题库列表 */
.paper-info-item {
  width: 100%;
  margin: 0.5rem 0 0;
  background: #fff;
}
.paper-info-box {
  margin-bottom: 13px;
  border-bottom: 1px solid #ebedef;
}
.paper-info-box_top {
  display: flex;
  justify-content: space-between;
}
.paper-info-box_bottom {
  margin-top: 6px;
  width: 100%;
  height: 31px;
  display: flex;
  justify-content: space-between;
  font-size: 10px;
  font-family: PingFangSC-Light;
  font-weight: 300;
  color: #999;
}
.paper-info-box_title {
  width: 75%;
  font-size: 11px;
  font-family: PingFang-SC-Medium;
  font-weight: 500;
  color: #333;
  float: left;
}
.paper-info-box_title ul li {
  list-style: disc inside none;
}
.paper-info-box_score {
  width: 25%;
  float: right;
  text-align: right;
}
.paper-info-box_difficulty {
  width: 50%;
  font-size: 10px;
  color: #999;
  display: flex;
  justify-content: space-between;
}
.paper-info-box_again {
  font-size: 11px;
  font-family: PingFangSC-Semibold;
  font-weight: 600;
  color: #fff;
  width: 58px;
  height: 18px;
  border-radius: 9px;
  background: #ff663d;
  text-align: center;
  line-height: 18px;
}
.difficulty-flex {
  display: flex;
}
.difficulty-flex text {
  float: left;
}
.van-rate {
  float: left;
  margin-top: 1px;
}
.center-align,
.left-align,
.right-align {
  padding: 10px;
  font-size: 14px;
}
.left-line {
  border-left: 1px solid #eee;
}
.right-line {
  border-right: 1px solid #eee;
}
.bottom-line {
  border-bottom: 1px solid #eee;
}
.center-align {
  text-align: center;
}
.left-align {
  text-align: left;
}
.right-align {
  text-align: right;
}
.w95 {
  width: 95%;
  font-size: 16px;
  background: #ff663d;
}
.p15 {
  padding: 15px 10px;
}
.green-font {
  color: #4caf50;
}
.red-font {
  color: #ff663d;
}
.collect-btn{
  margin-bottom: 0.8rem;
}
</style>

