<template>
  <div v-if="loading && showGiftInfo.is_me==0" class="ks-text-center show-gift" @click="isshowLayer">
    <header>
      <div>
        <h2>{{showGiftInfo.single_content_num!=showGiftInfo.json.length?"你收到一份礼物":"礼物被抢光了"}}</h2>
      </div>
      <p v-if="showGiftInfo.single_content_num!=showGiftInfo.json.length">快领取吧</p>
    </header>
    <main>
      <div class="radio-box show-box">
        <ks-image :src="showGiftInfo.defaultpic" class="show-box-pic"/>
        <div class="show-box-content">
          <h3>{{showGiftInfo.title}}</h3>
          <p>{{showGiftInfo.shortdesc}}</p>
          <p v-if="showGiftInfo.teacher_name">授课老师: {{showGiftInfo.teacher_name}}</p>
          <div class="show-box-source">
            <ks-image
              :src="showGiftInfo.gifthead || showGiftInfo.head"
              type="user"
              class="show-box-avatar"
            ></ks-image>
            <div class="show-box-name">
              来自
              <span>{{showGiftInfo.giftname || showGiftInfo.nickname}}</span>的礼物
            </div>
          </div>
          <img class="show-box-send-gift" src="../../assets/course/send_gift.png">
          <img
            v-if="showGiftInfo.single_content_num==showGiftInfo.json.length && showGiftInfo.is_receive==0"
            class="show-box-no-gift"
            src="../../assets/course/no_gift.png"
          >
          <div class="show-box-course-type" v-if="showGiftInfo.courseType==1">点播</div>
          <div class="show-box-course-type" v-else-if="showGiftInfo.courseType==2">直播</div>
          <div class="show-box-course-type" v-else-if="showGiftInfo.courseType==3">音频</div>
          <div class="show-box-course-type" v-else-if="showGiftInfo.courseType==4">图文</div>
          <div class="show-box-course-type" v-else-if="showGiftInfo.courseType==5">面授</div>
          <div class="show-box-course-type" v-else-if="showGiftInfo.courseType==6">活动</div>
        </div>
      </div>
      <div class="radio-box hide-box-middle"></div>
      <div class="radio-box hide-box-floor"></div>
    </main>
    <div
      class="send-box"
      v-if="showGiftInfo.single_content_num==showGiftInfo.json.length && showGiftInfo.is_receive==0"
    >
      <div class="ks-mt10">
        <ks-button type="primary" width="100%" @click="IWantToo">我也要</ks-button>
      </div>
      <p class="ks-mt10">仅限{{showGiftInfo.single_content_num}}个名额，先到先得</p>
    </div>
    <div
      class="send-box"
      v-else-if="(showGiftInfo.is_receive==0 && showGiftInfo.is_end==0)||showGiftInfo.numb>0"
    >
      <div class="ks-mt10">
        <ks-button type="primary" width="100%" @click="freeGet">免费领取</ks-button>
      </div>
      <p class="ks-mt10">仅限{{showGiftInfo.single_content_num}}个名额，先到先得</p>
    </div>
    <div class="send-box" v-else-if="showGiftInfo.is_receive==0 && showGiftInfo.is_end==1">
      <div class="ks-mt10">
        <ks-button type="primary" width="100%">活动已结束</ks-button>
      </div>
    </div>
    <div class="send-box" v-else-if="showGiftInfo.is_receive==1 || showGiftInfo.numb<=0">
      <div class="ks-mt10">
        <ks-button type="primary" width="100%" @click="goStudy">立即去学习</ks-button>
      </div>
      <p class="ks-mt10">领取成功!</p>
    </div>
    <footer>
      <div class="get-record">
        <span>领取记录</span>
      </div>
      <div class="ks-mt20">
        <img
          v-if="!showGiftInfo.json || showGiftInfo.json.length == 0"
          src="../../assets/course/gift.png"
          type="logo"
          class="get-record-logo"
        >
        <div v-else class="get-record-list">
          <div class="ks-row" v-for="(item,index) in showGiftInfo.json" :key="index">
            <div class="ks-col-4 get-record-text-left">
              <ks-image :src="item.portrait" type="user" class="get-record-avatar"></ks-image>
            </div>
            <div class="ks-col-18 get-record-text-left">
              <div>
                <span>{{item.nickname}}</span>
                <span class="get-record-text-date">{{formatTimestamp(item.addtime*1000)}}</span>
              </div>
              <p>谢谢~</p>
            </div>
            <div class="ks-col-2 get-record-num">x1</div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <div v-else-if="loading" class="ks-text-center show-gift" @click="isshowLayer">
    <header>
      <div>
        <h2>礼物已经准备好</h2>
      </div>
      <p>快去喊好友收礼吧</p>
    </header>
    <main>
      <div class="radio-box show-box">
        <ks-image :src="showGiftInfo.defaultpic" class="show-box-pic"/>
        <div class="show-box-content">
          <h3>{{showGiftInfo.title}}</h3>
          <p>{{showGiftInfo.shortdesc}}</p>
          <p v-if="showGiftInfo.teacher_name">授课老师: {{showGiftInfo.teacher_name}}</p>
          <div class="show-box-source">
            <ks-image :src="showGiftInfo.head" type="user" class="show-box-avatar"></ks-image>
            <div class="show-box-name">
              来自
              <span>{{showGiftInfo.nickname}}</span>的礼物
            </div>
          </div>
          <img class="show-box-send-gift" src="../../assets/course/send_gift.png">
          <img
            v-if="$route.query.ordersn && showGiftInfo.is_receive==1"
            class="show-box-no-gift"
            src="../../assets/course/no_gift.png"
          >
          <div class="show-box-course-type" v-if="showGiftInfo.courseType==1">点播</div>
          <div class="show-box-course-type" v-else-if="showGiftInfo.courseType==2">直播</div>
          <div class="show-box-course-type" v-else-if="showGiftInfo.courseType==3">音频</div>
          <div class="show-box-course-type" v-else-if="showGiftInfo.courseType==4">图文</div>
          <div class="show-box-course-type" v-else-if="showGiftInfo.courseType==5">面授</div>
          <div class="show-box-course-type" v-else-if="showGiftInfo.courseType==6">活动</div>
        </div>
      </div>
      <div class="radio-box hide-box-middle"></div>
      <div class="radio-box hide-box-floor"></div>
    </main>
    <div class="send-box">
      <div v-if="showGiftInfo.courseType == 4 && $route.query.gostudy && !showLayer">
        <ks-button type="primary" width="100%" @click="goStudy">立即去学习</ks-button>
      </div>
      <div v-else-if="$route.query.ordersn">
        <ks-button
          v-if="showGiftInfo.numb>0"
          type="primary"
          width="100%"
          @click="receiveGift"
        >喊好友来收礼</ks-button>
        <ks-button v-else type="primary" class="send-box-more-than" width="100%">好友已领取~</ks-button>
      </div>
      <div v-else>
        <div v-if="$route.query.chapterid && $route.query.free_id && isbuy">
          <ks-button
            type="primary"
            width="100%"
            class="send-box-free-btn"
            @click="freeOfCost"
          >单课时免费赠送</ks-button>
        </div>
        <div class="ks-mt10" @click.stop="payPresent">
          <ks-button type="primary" width="100%">付费赠送课程给好友</ks-button>
        </div>
      </div>
      <p class="ks-mt10" v-if="showGiftInfo.courseType == 4 && $route.query.gostudy && !showLayer">领取成功!</p>
      <p class="ks-mt10" v-else>超过7天未被领取的的礼物，将会自动原路退款至付款账户。</p>
    </div>
    <footer>
      <div class="get-record">
        <span>领取记录</span>
      </div>
      <div class="ks-mt20">
        <img
          v-if="!showGiftInfo.json"
          src="../../assets/course/gift.png"
          type="logo"
          class="get-record-logo"
        >
        <div v-else class="get-record-list">
          <div class="ks-row" v-for="(item,index) in showGiftInfo.json" :key="index">
            <div class="ks-col-4 get-record-text-left">
              <ks-image :src="item.portrait" type="user" class="get-record-avatar"></ks-image>
            </div>
            <div class="ks-col-18 get-record-text-left">
              <div>
                <span>{{item.nickname}}</span>
                <span class="get-record-text-date">{{formatTimestamp(item.addtime*1000)}}</span>
              </div>
              <p>谢谢~</p>
            </div>
            <div class="ks-col-2 get-record-num">x1</div>
          </div>
        </div>
      </div>
    </footer>
    <div class="share-box" v-if="showLayer">
      <template v-if="orderInfo">
        <img class="share-line" src="../../assets/course/share_line.png">
        <div class="share-box-content">
          <h3>免费请好友学习</h3>
          <p>前{{orderInfo.single_content_num}}名好友可免费领取该内容</p>
          <p>
            已有
            <span class="share-box-already-get">{{orderInfo.receive_count}}</span>名好友领取
          </p>
        </div>
      </template>
      <template v-if="$route.query.ordersn || $route.query.gostudy">
        <img class="share-line" src="../../assets/course/share_line.png">
        <div class="share-box-content">
          <h3>喊好友来收礼</h3>
          <p>分享链接给好友，让好友来收礼吧</p>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
import { addGive, showGift, getFreeShare, orderFree } from "@/api/free.look";
import { receiveGifts } from "@/api/user";
export default {
  name: "ShowGift",
  data() {
    return {
      loading: false,
      /**当前课程id */
      courseid: this.$route.params.id,
      /**用户是否已购买该课程 */
      isbuy: 0,
      /**页面信息 */
      showGiftInfo: null,
      /**显示分享遮罩层 */
      showLayer: false,
      /**免费请好友看订单信息 */
      orderInfo: null,
      /**购买之后返回ordersn */
      ordersn: null,
      /**订单id */
      orderid: null
    };
  },
  computed: {
    /**格式化时间 */
    formatTimestamp() {
      /**
       * @param {Number} 时间戳
       */
      return function(time) {
        let data = new Date(parseInt(time));
        let y = data.getFullYear();
        let m = data.getMonth() + 1;
        let d = data.getDate();
        let h = data.getHours();
        let mm = data.getMinutes();
        let s = data.getSeconds();
        m = m < 10 ? "0" + m : m;
        d = d < 10 ? "0" + d : d;
        h = h < 10 ? "0" + h : h;
        mm = mm < 10 ? "0" + mm : mm;
        s = s < 10 ? "0" + s : s;
        return m + "-" + d + " " + h + ":" + mm;
      };
    }
  },
  watch: {
    $route(to, form) {
      if ((form.query.orderid && !to.query.orderid) || (form.query.gostudy && !to.query.gostudy)) {
        this.showLayer = false;
      }
    }
  },
  activated() {
    this.loading = false;
    this.getShowGift();
  },
  methods: {
    isshowLayer() {
      this.showLayer = false
    },
    /**获取页面数据 */
    getShowGift() {
      this.showLayer = false;
      this.orderInfo = null;
      this.courseid = this.$route.params.id;
      let courseid = this.courseid;
      this.isbuy = 0;

      let params = { courseid };
      if (this.$route.query.ordersn) {
        params.ordersn = this.$route.query.ordersn;
      } else {
        params.chapterid = this.$route.query.chapterid;

        if (this.$route.query.chapterid) {
          params.orderid = this.$route.query.orderid;
        }
      }

      showGift(params).then(res => {
        if (res.is_me == 0 && !this.$route.query.ordersn) {
          getFreeShare({ id: this.$route.query.orderid }).then(res => {
            this.showGiftInfo = res;
            this.setShare();
            this.loading = true;
          });
        } else {
          this.showGiftInfo = res;
          this.isbuy = res.isbuy;
          if (res.isbuy) {
            let courseid = this.courseid;
            let chapterid = this.$route.query.chapterid;
            let free_id = this.$route.query.free_id;
            //课时情况
            if (chapterid && free_id) {
              addGive({ courseid, chapterid, free_id }).then(res => {
                this.orderInfo = res;
                this.setShare();
                this.orderid = res.id;
                this.loading = true;
              });
            } else {
              this.loading = true;
            }
          } else {
            this.loading = true;
          }
          this.setShare();
        }
      });
    },
    /**单课时免费赠送 */
    freeOfCost() {
      let courseid = this.courseid;
      let chapterid = this.$route.query.chapterid;
      let free_id = this.$route.query.free_id;

      let orderid = this.orderid;
      this.$router.push({
        name: "ShowGift",
        params: {
          id: courseid
        },
        query: {
          chapterid,
          orderid,
          free_id
        }
      });
      this.showLayer = true;
    },
    /**付费赠送课程给好友 */
    payPresent() {
      if (
        this.showGiftInfo.courseType == 4 &&
        this.showGiftInfo.chargetype == 0
      ) {
        this.$router.push({
          name: "ShowGift",
          params: {
            id: this.courseid
          },
          query: {
            chapterid: this.$route.query.chapterid,
            gostudy: true
          }
        });
        this.showLayer = true;
      } else {
        this.$showPay({
          payid: this.courseid,
          price: this.showGiftInfo.price,
          type: "course",
          giftNum: 1,
          isgive:1,
        });
      }
    },
    /**免费领取 */
    freeGet() {
      let params = {};
      if (this.$route.query.ordersn) {
        params.ordersn = this.$route.query.ordersn;
        receiveGifts(params).then(res => {
          this.getShowGift();
        });
      } else {
        params.courseid = this.courseid;
        params.chapterid = this.$route.query.chapterid;
        params.id = this.$route.query.orderid;
        orderFree(params).then(res => {
          this.getShowGift();
        });
      }
    },
    /** 立即去学习 */
    goStudy() {
      this.$router.push({
        name: "CourseView",
        params: {
          id: this.courseid
        }
      });
    },
    /**我也要 */
    IWantToo() {
      this.$router.push({
        name: "CourseView",
        params: {
          id: this.courseid
        }
      });
    },
    /**喊好友来收礼 */
    receiveGift() {
      this.showLayer = true;
    },
    /**配置微信分享 */
    createShare() {
      return new Promise(resolve => {
        let courseid = this.courseid;
        let chapterid = this.$route.query.chapterid;
        let free_id = this.$route.query.free_id;
        if (chapterid && free_id) {
          addGive({ courseid, chapterid, free_id }).then(res => {
            this.orderInfo = res;
            this.setShare();
            this.orderid = res.id;
          });
        }
        this.loading = true;
        resolve();
      });
    },
    /**设置分享 */
    setShare() {
      /**配置微信分享 */
      let shareTitle = this.$route.query.ordersn
        ? "送你一个课程 | " + this.showGiftInfo.title
        : "送你一个课时 | " + this.showGiftInfo.chapter_title;

      this.$wxShare({
        title: shareTitle,
        desc: this.showGiftInfo.shortdesc,
        imgUrl: this.showGiftInfo.defaultpic
      });
      /** 分享配置end */
    }
  }
};
</script>

<style scoped>
.show-gift {
  background-color: #fff9ed;
  min-height: 100vh;
}
header {
  color: #ca9e6f;
  padding: 30px 0;
}
header h2 {
  position: relative;
  display: inline-block;
}
header h2::before,
header h2::after {
  content: "";
  display: inline-block;
  width: 50px;
  height: 1px;
  /* background-color: #ca9e6f; */
  position: absolute;
  top: 50%;
}
header h2::before {
  left: -60px;
  background: linear-gradient(to right, #d8b1881a, #ca9e6f);
}
header h2::after {
  right: -60px;
  background: linear-gradient(to left, #d8b1881a, #ca9e6f);
}
main {
  width: 300px;
  margin: 0 auto;
  position: relative;
}
.radio-box {
  border-radius: 5px;
  background-color: white;
  box-shadow: 0 0 3px 3px rgba(0, 0, 0, 0.1);
}
.hide-box-middle {
  width: calc(100% - 30px);
  height: 100%;
  position: absolute;
  top: 12px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 2;
  /* background-color: bacoco; */
}
.hide-box-floor {
  width: calc(100% - 60px);
  height: 100%;
  position: absolute;
  top: 24px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 1;
}
.show-box {
  position: relative;
  padding: 10px;
  text-align: left;
  margin-bottom: 60px;
  z-index: 3;
}
.show-box-pic {
  height: 180px;
  border-radius: 5px;
}
.show-box-content {
  text-align: left;
  padding: 20px 15px;
}
.show-box-content h3 {
  font-size: 16px;
  line-height: 1.5;
}
.show-box-content p {
  color: #969696;
  line-height: 1.8;
}
.show-box-source {
  margin-top: 40px;
  text-align: right;
}
.show-box-avatar {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  display: inline-block;
}
.show-box-name {
  color: #969696;
  vertical-align: top;
  margin-left: 10px;
  display: inline-block;
  height: 30px;
  line-height: 30px;
}
.show-box-name span {
  color: black;
}
.show-box-send-gift {
  position: absolute;
  top: 0px;
  left: 0px;
  width: 60px;
  height: 60px;
}
.show-box-no-gift {
  width: 70px;
  height: 70px;
  position: absolute;
  top: 50%;
  right: -20px;
  transform: translateY(-50%);
}
.show-box-course-type {
  display: inline-block;
  color: #fff;
  padding: 2px 10px;
  border-top-left-radius: 20px;
  border-bottom-left-radius: 20px;
  background-color: rgba(0, 0, 0, 0.6);
  position: absolute;
  right: 10px;
  top: 20px;
}
.send-box {
  width: 320px;
  margin: 0 auto 20px;
  text-align: center;
  color: #969696;
}
.send-box .send-box-free-btn {
  background-color: #e69c3b;
  border: 1px solid #e69c3b;
}
.send-box .send-box-more-than {
  background-color: #999999;
  border: 1px solid #999999;
}
footer {
  width: 320px;
  margin: 0 auto;
  padding-bottom: 20px;
}
.get-record {
  position: relative;
}
.get-record::before {
  content: "";
  display: inline-block;
  width: 100%;
  height: 1px;
  background-color: #cdccc7;
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  z-index: 1;
}
.get-record span {
  position: relative;
  padding: 0 20px;
  background-color: #fff9ed;
  z-index: 5;
}
.get-record-logo {
  width: 100px;
  height: 80px;
  margin: 0 auto;
}
.get-record-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: inline-block;
}
.get-record-text-left {
  text-align: left;
}
.get-record-text-date {
  color: #969696;
}
.get-record-text-left p {
  line-height: 2;
}
.get-record-num {
  color: #e75344;
}
.share-box {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 100;
}
.share-line {
  width: 100px;
  height: 145px;
  position: absolute;
  top: 20px;
  right: 20px;
}
.share-box-content {
  color: #fff;
}
.share-box-content {
  position: absolute;
  top: 160px;
  left: 50%;
  transform: translate(-50%);
}
.share-box-content h3 {
  font-size: 16px;
  line-height: 1.5;
}
.share-box-content p {
  line-height: 1.5;
}
.share-box-already-get {
  color: var(--ornament-color);
}
.buy-course {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 101;
}
.buy-course-container {
  width: 320px;
  margin: 30px auto 0;
  background-color: #fff;
  position: relative;
}
.buy-course-type {
  display: inline-block;
  color: #fff;
  padding: 2px 10px;
  border-top-left-radius: 20px;
  border-bottom-left-radius: 20px;
  background-color: rgba(0, 0, 0, 0.6);
  position: absolute;
  right: 0px;
  top: 20px;
}
.show-box-send {
  padding: 0 15px;
  padding-bottom: 30px;
}
.show-box-send p {
  color: #969696;
}
.buy-course-close {
  color: #fff;
  font-size: 30px;
}
</style>
