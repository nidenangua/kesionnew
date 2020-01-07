<template>
  <div class="minute" v-if="loading">
    <h2 class="ks-text-center" v-if="detail.astatus == 1">活动进行中</h2>
    <h2 class="ks-text-center" v-else-if="detail.astatus == 2">活动未开始</h2>
    <h2 class="ks-text-center"  v-else-if="detail.astatus == 3">活动已结束</h2>
    <div v-for="(item,index) in detail.json.number" :key="index" class="detail-item">
      <div class="minute-top">
        <div class="minute-top__title ks-text-center ks-fz16">课堂活动：{{detail.course_title}}</div>
        <div class="minute-top__txt ks-text-center ks-fz14 ks-color-info ks-pt20">
          <div
            class="minute-top__txt__time ks-pt20"
          >参加活动时间：{{formatTimestamp(detail.setting.begindate)}} - {{formatTimestamp(detail.setting.enddate)}}</div>
          <div class="minute-top__txt__site ks-pt20">{{detail.setting.address}}</div>
        </div>
      </div>
      <!-- 圆角分割线 -->
      <div class="minute-split__line">
        <div class="minute-left__cirle"></div>
        <div class="minute-right__cirle"></div>
        <div class="minute-middle__line ks-line"></div>
      </div>
      <div class="minute-bottom">
        <div class="ks-color-info ks-fz14">票种：</div>
        <div class="ks-mt10 ks-fz16">{{detail.ticket_info.title}}</div>
        <div class="ks-color-info ks-fz14 ks-mt10">票号：</div>
        <div class="ks-mt10 ks-fz22">{{item}}</div>
        <div class="ks-text-center ks-mt20">
          <ks-button class="minute-btn" @click="goback">返回</ks-button>
        </div>
      </div>
    </div>
    <div style="height:30px"></div>
  </div>
</template>

<script>
import { getTicketDetail } from "@/api/microportal";
export default {
  name: "CheckTickets",
  data() {
    return {
      loading: false,
      /**报名成功之后返回的报名表id */
      id: 0,
      /**票券详情 */
      detail: null
    };
  },
  computed: {
    /**格式化时间 */
    formatTimestamp() {
      /**
       * @param {Number} 时间戳
       * @param {String} 需要返回的格式
       */
      return function(time) {
        let data = new Date(parseInt(time));
        let y = data.getFullYear();
        let m = data.getMonth() + 1;
        let d = data.getDate();
        let h = data.getHours();
        let mm = data.getMinutes();
        m = m < 10 ? "0" + m : m;
        d = d < 10 ? "0" + d : d;
        h = h < 10 ? "0" + h : h;
        mm = mm < 10 ? "0" + mm : mm;
        return m + "." + d + " " + h + ":" + mm;
      };
    }
  },
  activated() {
    document.title = "查看票券"
    this.loading = false;
    this.id = this.$route.query.id;
    getTicketDetail({ id: this.id }).then(res => {
      console.log(res)
      if (res.result == "success") {
        this.detail = res.detail;
        this.loading = true;
      }
    });
  },
  methods: {
    goback() {
      this.$navigateBack()
    }
  }
};
</script>

<style scoped>
/* 背景斜线渐变 */
.minute {
  background: -webkit-linear-gradient(
    left top,
    #a5adb8,
    #77848d
  ); /* Safari 5.1 - 6.0 */
  background: linear-gradient(
    to bottom right,
    #a5adb8,
    #77848d
  ); /* 标准的语法（必须放在最后） */
  min-height: 100vh;
}
.minute h2 {
  color: #fff;
  line-height: 44px;
  padding: 20px 0;
  font-weight: normal;
}
.minute .detail-item {
  margin-bottom: 20px;
}
.minute-top {
  background-color: #fff;
  padding: 20px;
  margin: 0 10px;
  border-radius: 5px 5px 0 0;
}
.minute-top__title {
  font-weight: bold;
}
.minute-bottom {
  background-color: #fff;
  padding: 20px;
  margin: 0 10px 0 10px;
  border-radius: 0 0 5px 5px;
}
.minute-btn {
  text-align: center;
  border-radius: 50px;
  width: 100px;
  font-weight: normal;
}
/* 圆角分割线样式 */
.minute-split__line {
  margin-top: -1px;
  margin-bottom: -1px;
  overflow: hidden;
  position: relative;
  z-index: 10;
  height: 18px;
  -webkit-top-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
  margin: 0 10px 0 10px;
}
.minute-split__line .minute-left__cirle {
  float: left;
  width: 16px;
  height: 18px;
  background-repeat: no-repeat;
  background-size: 100% auto;
  background-position: 50%;
  background-image: url(../../assets/activity/yleft.svg);
}
.minute-split__line .minute-right__cirle {
  float: right;
  width: 16px;
  height: 18px;
  background-repeat: no-repeat;
  background-size: 100% auto;
  background-position: 50%;
  background-image: url(../../assets/activity/yright.svg);
}
.minute-split__line .minute-middle__line {
  left: 15px;
  right: 15px;
  background-color: #fff;
  height: 18px;
  top: 50%;
  margin-top: -9px;
  position: absolute;
}
.ks-line::after {
  content: "";
  display: block;
  position: absolute;
  border-bottom: 1px dashed #e2e2e2;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}
</style>
