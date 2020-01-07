<template>
  <div class="course_container" v-if="loaded">
    <div class="course_content">
      <item-header
        :info="courseInfo"
        :now-time.sync="nowTime"
        :begin-date="beginDate"
        :end-date="endDate"
        :err-tips="errTips"
        :chapter-info="chapter"
        :chapterid="chapterid"
        :freeid="free_id"
        :is_join="is_join"
        info-type="course"
        @audioChange="onAudioChange"
        ref="itemHeader"
      >
      </item-header>
      <!-- tab -->
      <div class="tab line">
        <div class="tab-item on-log" :class="tab == 0 && 'active'" @click="tab = 0">详情</div>
        <div
          class="tab-item on-log"
          :class="tab == 1 && 'active'"
          @click="tab = 1"
          v-if="courseInfo.coursehour == 1"
        >目录</div>
        <div class="tab-item on-log" :class="tab == 2 && 'active'" @click="tab = 2">评论</div>
        <div class="tab-item on-log" :class="tab == 3 && 'active'" @click="tab = 3">资料</div>
      </div>
      <!-- tab -->
      <div class="intro-anchor" v-show="tab == 0">
        <!--图文-->
        <div class="intro-anchor__body" v-if="courseInfo.courseType == 4">
          <!--连载图文、免费、已购买显示详细内容-->
          <div
            class="ks-content"
            v-if="courseInfo.coursehour == 1 || isCanLearn && is_join"
            v-html="courseInfo.content"
            ref="content"
          ></div>
          <!--未购买-->
          <div v-else>
            <div
              v-show="courseInfo.announce"
              v-html="courseInfo.announce"
              class="ks-content ks-line"
              ref="skContent"
              style="padding-bottom:15px;"
            ></div>
            <div class="buy-article-tips">本内容需要{{is_chargetype == 0 ? "加入学习" :"购买"}}之后才能阅读全文</div>
          </div>
        </div>
        <div v-else>
          <div class="intro-anchor__body ks-content" v-html="courseInfo.content"></div>
        </div>
        <!--打赏-->
        <reward type="courseReward" :info-id="courseid" v-if="courseInfo.chargetype == 2"/>
      </div>
      <!--课程目录-->
      <div class="catalog-anchor" v-if="courseInfo.coursehour == 1" v-show="tab == 1">
        <course-catalog
          :course-type="courseInfo.courseType"
          :current-play-id="currentPlayId"
          :chapter="chapter"
          :chapter-type="chapterType"
          @play="play"
          :isbuy="isbuy"
        />
      </div>
      <!--评论-->
      <div class="comment-anchor" v-show="tab == 2">
        <comment :comment-switch="isCanLearn" appid="6" :info-id="courseid" v-if="courseid"/>
      </div>
      <div class="course-data" v-show="tab == 3">
        <course-data :courseid="courseid"/>
      </div>
    </div>
    <transition name="fade">
      <div class="ks-masked" v-if="isCanLearn" v-show="codeFlag" @click="codeFlag = false"></div>
    </transition>
    <transition name="fade-up">
      <div class="codewrap" v-if="isCanLearn" v-show="codeFlag">
        <img :src="codeImg">
        <p>长按识别二维码进入小程序学习</p>
      </div>
    </transition>
    <!--店铺信息-->
    <store-info class="ks-mt10" v-if="$route.query.miniprogram != 1"/>
    <!--底部-->
    <store-footer/>
    <div class="footer-button" v-if="!isCanLearn">
      <div
        class="footer-button__fixed"
        :class="courseInfo.courseType==5 && getBtnStatus==2 && courseInfo.json.is_dingjin==1 && 'footer-button__fixed-buy'"
      >
        <div v-if="courseInfo.courseType==5" class="ks-row">
          <div class="ks-col-24" v-if="getBtnStatus==0">
            <ks-button
              type="primary"
              class="regist-btn"
            >{{formatTimestamp(courseInfo.json.date1*1000)}} 开始报名</ks-button>
          </div>
          <div class="ks-col-24" v-else-if="getBtnStatus==1">
            <ks-button
              type="primary"
              class="regist-btn"
              style="background-color:#999;border:1px solid #999;"
            >报名已截止</ks-button>
          </div>
          <div class="ks-col-24" v-else-if="getBtnStatus==2 && courseInfo.chargetype!= 1">
            <ks-button type="primary" class="regist-btn" @click="nowRegist">立即报名</ks-button>
          </div>
          <div v-else-if="getBtnStatus==2 && courseInfo.json.is_dingjin==1">
            <div class="ks-col-12" style="padding:6px 5px 6px 10px;">
              <ks-button
                type="primary"
                class="regist-btn"
                style="background-color:#FD7C3E;border:1px solid #FD7C3E;"
                @click="payNow(0)"
              >预付定金(￥{{courseInfo.json.dingjin}})</ks-button>
            </div>
            <div class="ks-col-12" style="padding:6px 10px 6px 5px;">
              <ks-button
                type="primary"
                class="regist-btn"
                @click="payNow(1)"
              >立即购买(￥{{+courseInfo.price}})</ks-button>
            </div>
          </div>
          <div class="ks-col-24" v-else-if="getBtnStatus==2 && courseInfo.json.is_dingjin==0">
            <ks-button
              type="primary"
              class="regist-btn"
              @click="payNow(1)"
            >立即购买(￥{{courseInfo.price*1}})</ks-button>
          </div>
        </div>
        <div v-else-if="market_id && num" class="ks-row">
          <div class="ks-col-12">
            <ks-button
              type="primary"
              :desc="num+'个好友助力'"
              class="footer-button__fixed-free"
              @click="free"
            >免费听课</ks-button>
          </div>
          <div class="ks-col-12">
            <ks-button type="primary" @click="buy">购买课程</ks-button>
          </div>
        </div>
        <div v-else class="ks-row">
          <div class="ks-col-24">
            <ks-button type="primary" @click="buy">购买课程</ks-button>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-button" v-else-if="isCanLearn">
      
      <div
        class="footer-button__fixed"
        v-if="courseInfo.chargetype !=1 && !is_join"
      >
        <ks-button type="primary" @click="joinStudey">加入学习</ks-button>
      </div>
      <div class="footer-button__fixed" v-else-if="courseInfo.courseType == 2">
        <ks-button type="primary" @click="open(courseInfo.courseid)">进入直播</ks-button>
      </div>
      
    </div>
  </div>
</template>

<script>
import CourseData from "./components/CourseData";
import ItemHeader from "./components/ItemHeader";
import CourseCatalog from "./components/CourseCatalog";
import Reward from "./components/Reward";
import Comment from "../comment/Comment";
import { getCourseDetail, getCoursePlayVod } from "@/api/course";
import { addTutorial, joinLearning } from "@/api/microportal";
import { addHelp } from "@/api/friends.help.js";
export default {
  name: "CourseView",
  components: {
    ItemHeader,
    Reward,
    CourseCatalog,
    Comment,
    CourseData
  },
  data() {
    return {
      /**是否购买 */
      isbuy:0,
      /**试听时间 */
      audition_time:[],
      /**是否收费 */
      is_chargetype:'',
      /**类型为点播时 是否有已经加入学习 */
      is_join: null,
      /**请好友看活动id */
      free_id: null,
      /**请好友看课时id */
      chapterid: null,
      /** 为好友助力活动id */
      market_id: null,
      /**助力人数 */
      num: 0,
      /**助力id */
      helpId: null,
      /**是否显示助力弹框 */
      showHelp: false,
      /**课程详情接口加载状态 */
      loaded: false,
      /**当前课程id */
      courseid: 0,
      /**失败提示 */
      errTips: null,
      /**当前时间 */
      nowTime: 0,
      /**开始时间 */
      beginDate: 0,
      /**结束时间 */
      endDate: 0,
      h5Info: {},
      courseInfo: {},
      tab: 0,
      isFree: false,
      isCanLearn: false,
      currentPlayId: null,
      chapter: [],
      codeImg: "//store.kesion.com/Tp/PC/ketangjie/Public/images/code.png",
      codeFlag: false,
      chapterType: null,
      /**是否为老师 */
      is_teacher:''
    };
  },
  computed: {
    /** 判断按钮状态 */
    getBtnStatus() {
      let time = new Date().getTime();
      if (this.courseInfo.json.date1 * 1000 > time) {
        return 0; // 报名未开始
      } else if (this.courseInfo.json.date2 * 1000 < time) {
        return 1; // 报名已截止
      } else {
        return 2; // 报名进行中
      }
    },
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
        return m + "月" + d + "日" + " " + h + ":" + mm;
      };
    }
  },
  activated() {
    this.dataInit();
    this.$showLoading();
    this.showHelp = false;
    this.market_id = 0;
    this.num = 0;
    getCourseDetail({
      id: this.courseid
    }).then(res => {
      this.audition_time = res.chapter.chapter
      this.is_chargetype = res.courseinfo.chargetype
      this.is_join = res.is_join;
      this.isbuy = res.courseinfo.isbuy
      /**助力部分 */
      if (res.market_id && res.num) {
        this.market_id = res.market_id;
        this.num = res.num;
      }
      if (this.$route.query.helpid) {
        this.helpId = this.$route.query.helpid;
        this.showHelp = true;
      }

      /**请好友看 */
      if (
        res.courseinfo.hourcount == 1 &&
        res.free_id &&
        res.chapter.chapter.length > 0
      ) {
        this.chapterid = res.chapter.chapter[0].chapterid;
        this.free_id = res.free_id;
      } else {
        this.chapterid = null;
        this.free_id = null;
      }
      /** */

      let courseInfo = res.courseinfo;
      document.title = courseInfo.title;
      courseInfo.studentcount = parseInt(courseInfo.studentcount);
      courseInfo.hourcount = parseInt(courseInfo.hourcount);
      courseInfo.expecthour = parseInt(courseInfo.expecthour);
      courseInfo.countdownText = "";
      if (courseInfo.iscopy == 1) {
        /**开启防复制 */
        this.$antiCopy(true);
      }
      this.nowTime = res.now_time;
      this.courseInfo = courseInfo;
      this.h5Info = res.h5info;
      let chapterData = res.chapter.chapter;
      this.setChapterData(chapterData);
      this.chapter = chapterData;
      this.chapterType = res.chapter.istype;
      if (courseInfo.chargetype != 1) {
        this.isFree = true;
      }
      if (
        (courseInfo.isbuy == 1 || courseInfo.chargetype != 1) &&
        (courseInfo.hourcount == 1 || courseInfo.gift != 3)
      ) {
        this.isCanLearn = true;
        if (courseInfo.courseType == 5) {
          this.isCanLearn = courseInfo.json.is_sign == 1 ? true : false;
        } else {
          this.isCanLearn = true;
        }
      }
      /**配置微信分享 */
      this.$wxShare({
        title: courseInfo.title,
        desc: courseInfo.shortdesc,
        imgUrl: courseInfo.defaultpic
      });
      let firstKeshi;
      let firstKeshiParent;
      if (`${courseInfo.coursehour}` === "1") {
        /**多课时课程，获取第一个课时 */
        if (!this.chapter) {
          return false;
        }
        /**chapterType 0 章节时结构 1 章节 2 纯课时 */
        if (this.chapterType == 2) {
          firstKeshi = this.chapter[0];
        } else {
          for (let i = 0; i < this.chapter.length; i++) {
            let c = this.chapter[i];
            if (c.Section) {
              for (let ii = 0; ii < c.Section.length; ii++) {
                let s = c.Section[ii];
                if (s.keshi && !firstKeshi) {
                  firstKeshi = s.keshi[0];
                  firstKeshiParent = s;
                  break;
                }
              }
            } else if (c.keshi) {
              if (!firstKeshi) {
                firstKeshi = c.keshi[0];
                firstKeshiParent = c;
                break;
              }
            }
          }
        }
      } else {
        /**单课时课程 */
        firstKeshi = this.chapter[0];
      }
      if (firstKeshi) {
        this.beginDate = Number(firstKeshi.begindate);
        this.endDate = Number(firstKeshi.enddate);
      }
      this.loaded = true;
      
      this.$nextTick(() => {
        if (
          (this.isCanLearn || courseInfo.json.is_audition == 1) &&
          this.chapter &&
          firstKeshi
        ) {
          if (`${courseInfo.coursehour}` === "1") {
            this.tab = 1;
          }
          if (
            courseInfo.courseType == 1 &&
            `${courseInfo.coursehour}` === "0"
          ) {
            /**单课时直接播放 */
            this.play(firstKeshi, firstKeshiParent);
          }
        }
        /**图片放大 */
        if (this.$refs.skContent) {
          this.$setPreview(this.$refs.skContent);
        } else if (this.$refs.content) {
          this.$setPreview(this.$refs.content);
        }
        this.$hideLoading();
      });
    });
    this.$store.ready(state=>{
      this.is_teacher = state.userInfo.usertype;
    })
  },
  deactivated() {
    this.loaded = false
    /**取消防复制 */
    this.$antiCopy(false);
  },
  methods: {
    /**
     * 初始化数据
     */
    dataInit() {
      document.title = "";
      this.loaded = true;
      this.tab = 0;
      this.isCanLearn = false;
      this.isFree = false;
      this.courseid = this.$route.params.id;
    },
    /**加入学习 */
    joinStudey() {
      joinLearning({
        courseid: this.courseid,
        type: this.courseInfo.courseType
      }).then(res => {
        if (res.result == "success") {
          this.$toast(res.msg, "success").then(() => {
            location.reload();
          });
        }
      });
    },
    /**免费听课 */
    free() {
      addHelp({
        marketid: this.market_id,
        goodsid: this.courseid,
        type: this.courseInfo.courseType
      }).then(res => {
        this.$router.push({
          name: "HelpYourFriends",
          params: {
            id: this.$route.params.id
          },
          query: {
            id: res.id
          }
        });
      });
    },
    /**
     * 购买
     */
    buy() {
      this.$showPay({
        payid: this.courseid,
        msg: "购买课程",
        price: this.courseInfo.price,
        type: "course"
      });
    },
    /**
     * 面授购买
     * @param {Number} //购买方式 0预付定金  1直接购买
     **/
    payNow(paymodel) {
      if (this.courseInfo.json.surplus_num <= 0) {
        this.$toast("没有名额了~");
        return false;
      }
      this.$showPay({
        payid: this.courseid,
        msg: "购买课程",
        price:
          paymodel == 0
            ? this.courseInfo.json.dingjin
            : this.courseInfo.price * 1,
        json: {
          paymodel
        },
        type: "faceTeach"
      });
    },
    /**面授免费报名 */
    nowRegist() {
      addTutorial({ courseid: this.courseid }).then(res => {
        if (res.result == "success" && res.msg == "报名成功") {
          this.$toast("报名成功", "success").then(data => {
            location.reload();
          });
        }
      });
    },
    /**
     * 播放
     */
    play(period, parentItem) {
      
      /**请好友看 */
      let can_see = null; // 判断是否是已领取的课时
      if (this.courseInfo.order_json && this.courseInfo.order_json.length > 0) {
        can_see = this.courseInfo.order_json.some(el => {
          return el == period.chapterid;
        });
      }
      /**可试听时间 */
      let auditionTime = 0;
      if (period.json && period.json.is_audition == 1) {
        auditionTime = period.json.audition_time;
      }
      this.errTips = "";
      let chapterid = period.chapterid; //课时唯一id
      let courseType = this.courseInfo.courseType; //课程类型 1点播 2直播 3音频 4图文
      if (
        !this.isCanLearn &&
        auditionTime == 0 &&
        !can_see
      ) {
        this.$toast("请先购买");
        return false;
      }
      if (courseType == 1) {
        if (this.courseInfo.coursehour == 1) {
          /**连载课程跳到对应的学习页播放 */
          this.$router.push({
            name: "CoursePlay",
            params: {
              id: this.courseid
            },
            query: {
              chapterid: chapterid
            }
          });
        } else {
          /**单课时课程，当前页播放 */
          getCoursePlayVod({
            courseid: this.courseid,
            chapterid: chapterid
          }).then(res => {
            if (res.errcode == 10002) {
              this.$toast("请先登录").then(() => {
                this.$router.push({
                  name: "UserLogin"
                });
              });
              return false;
            } else if (res.code == 10005) {
              this.$toast(res.msg);
              return false;
            } else if (res.msg == "系统出错") {
              this.errTips = "暂无视频";
              return false;
            }
            let mediaInfo = res;
            mediaInfo.mediaType = "video";
            mediaInfo.cover = this.courseInfo.defaultpic;
            mediaInfo.courseid = period.courseid;
            mediaInfo.chapterid = period.chapterid;
            /**试听课程增加试听相关参数 */
            if (!this.isCanLearn && !can_see && auditionTime > 0) {
              mediaInfo.price = this.courseInfo.price;
              mediaInfo.auditionTime = auditionTime;
            }
            this.$refs.itemHeader.playMedia(mediaInfo);
            this.currentPlayId = chapterid;
          });
        }
      } else if(courseType == 2){
         if (this.courseInfo.livetype == 3) {
            this.$router.push("/videolive?id=" + this.courseid + "&chapterid=" + chapterid);
          } else if (this.courseInfo.livetype == 4) {
            this.$router.push("/audiolive?id=" + this.courseid + "&chapterid=" + chapterid);
          }
      } else if (courseType == 3) {
        /**音频课 */
        let mediaInfo = {
          chapterid: period.chapterid,
          mediaType: "audio"
        };
        this.$refs.itemHeader.playMedia(mediaInfo);
        this.currentPlayId = chapterid;
      }
    },
    /**
     * 当前播放的音频发生变化
     */
    onAudioChange(e){
      this.currentPlayId = e.chapterid
    },
    /**
     * 给章、节增加slideShow字段
     * @param {Object} 章或节的数据对象
     */
    setChapterData(data) {
      data.map(item => {
        if (item.depth == 1 || item.depth == 2) {
          item.slideShow = true
        }else if(item.depth == 3){
          this.resetPeriodData(item)
        }
        if (item.Section) {
          this.setChapterData(item.Section)
        }else if(item.keshi){
          this.setChapterData(item.keshi)
        }
      })
    },
    /**
     * 进入直播间
     * @param {String} 课程id
     */
    open(courseid) {
      if (this.courseInfo.livetype == 3) {
        this.$router.push("/videolive?id=" + courseid);
      } else if (this.courseInfo.livetype == 4) {
        this.$router.push("/audiolive?id=" + courseid);
      } else {
        this.$alert("暂不支持手机版观看，您可以在pc版打开本页链接直播间观看",{
          title:'暂不支持',
          sureButtonText:'好的'
        });
      }
    },
    /**
     * 判断课时是否可观看
     */
    resetPeriodData(ele) {
      /**
       * 课时可观看的3种条件
       * 第一种：当前课时是免费试听
       * 第二种：当前课程为免费请好友看，并且当前的课时id存在可免费看的课时数组里
       * 第三种：该课程免费或我已购买
       */
      let caseType = 0;
      if (ele.freeplay == 1) {
        caseType = 1;
      } else if (this.courseInfo.isbuy == 1 && this.courseInfo.gift == 3) {
        caseType = 2;
      } else if (this.courseInfo.isbuy == 1 && this.courseInfo.gift != 3) {
        caseType = 3;
      }
      switch (caseType) {
        case 0:
          ele.is_try_see = 0;
          break;
        case 1:
        case 3:
          ele.is_try_see = 1; //可以观看
          break;
        case 2:
          let trySee = this.courseInfo.order_json.some(el => {
            return el == ele.chapterid;
          });
          ele.is_try_see = trySee ? 1 : 0;
          break;
      }
      
      if (ele.is_try_see === 0) {
        /**可试看 */
        if (ele.json && ele.json.is_audition == 1) {
          ele.is_try_see = 2;
        }
      }
    }
  }
};
</script>
<style scoped>
.course_container {
  position: relative;
}

/*选项卡*/
.tab {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -moz-box-align: center;
  align-items: center;
  -webkit-justify-content: space-around;
  justify-content: space-around;
  height: 49px;
  background-color: #fff;
  margin-top: 10px;
  width: 100%;
}
.tab .tab-item {
  -webkit-box-flex: 1;
  -webkit-flex: 1;
  -moz-box-flex: 1;
  flex: 1;
  color: var(--auxiliary_text-color);
  text-align: center;
  height: 100%;
  position: relative;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -moz-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
  -moz-box-pack: center;
  justify-content: center;
  font-size: 16px;
  transition: 0.3s;
}
.tab .tab-item.active {
  color: var(--secondary_text-color);
  font-weight: bolder;
  font-size: 18px;
}
.tab .tab-item.active {
  font-size: 18px;
}
.tab .tab-item.active:after {
  content: "";
  display: block;
  height: 3px;
  border-radius: 3px;
  background-color: var(--primary-color);
  width: 40px;
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
}
.intro-anchor,
.catalog-anchor,
.comment-anchor {
  background: #fff;
}
.intro-anchor__head {
  height: 36px;
  line-height: 36px;
  font-size: 16px;
  padding: 0 20px 0 30px;
  font-weight: bold;
  overflow: hidden;
  position: relative;
}
.intro-anchor__head::after {
  content: "";
  width: 3px;
  height: 16px;
  border-radius: 3px;
  background: var(--ornament-color);
  position: absolute;
  left: 15px;
  top: 50%;
  margin-top: -9px;
}
.intro-anchor__body {
  padding: 20px;
}

.intro-anchor .empty {
  margin-top: 0px;
}

.footer-button {
  height: 49px;
  overflow: hidden;
}
.footer-button__fixed {
  width: 100%;
  max-width: 480px;
  position: fixed;
  left: 0;
  margin: 0 auto;
  right: 0;
  bottom: 0;
  z-index: 9;
  height: 49px;
  background-color: #fff;
  box-sizing: border-box;
}
.footer-button__fixed-buy {
  height: 61px;
}
.footer-button__fixed .icon-button {
  text-align: center;
  font-size: 10px;
  color: var(--secondary_text-color);
  position: relative;
}
.footer-button__fixed .icon-button__num {
  height: 12px;
  line-height: 12px;
  font-size: 10px;
  background: var(--ornament-color);
  color: #fff;
  border-radius: 12px;
  position: absolute;
  left: 14px;
  font-style: normal;
  padding: 0 5px;
  white-space: nowrap;
  top: 0;
}
.footer-button__fixed .ks-icon {
  display: block;
  margin: 0 auto;
  width: 24px;
  text-align: center;
  font-size: 24px;
  margin-top: 5px;
  position: relative;
}
.footer-button__fixed .ks-button {
  width: 100%;
  height: 49px;
  line-height: 49px;
  border-radius: 0px;
}
.footer-button__fixed .regist-btn {
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}
.footer-button__fixed-buy .regist-btn {
  border-radius: 5px;
}
.footer-button__fixed .footer-button__fixed-free {
  background-color: #e69c3b;
  border: 1px solid #e69c3b;
}
.buy-article-tips {
  text-align: center;
  padding: 75px 0 30px 0;
  font-size: 14px;
  letter-spacing: 1px;
  background: url(../../assets/course/money.png) no-repeat 50% 30px;
  background-size: auto 34px;
  margin-top: 15px;
}
.codewrap {
  padding: 10px;
  text-align: center;
  width: 200px;
  background: #fff;
  left: 0;
  right: 0;
  margin: 0 auto;
  top: 50%;
  margin-top: -140px;
  position: fixed;
  z-index: 100;
}
.codewrap img {
  width: 100%;
  display: block;
}
.codewrap p {
  height: 32px;
  line-height: 32px;
  overflow: hidden;
  font-weight: bold;
  font-size: 14px;
}
</style>
