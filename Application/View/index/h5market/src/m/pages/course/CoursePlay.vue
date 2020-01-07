<template>
  <div v-if="loading">
    <header>
      <ks-image :src="courseinfo.defaultpic" class="player">
        <video-player ref="player" @buy="buyCourse"/>
      </ks-image>
      <div class="ks-row course-title-box">
        <div class="ks-col-19">
          <h3>{{courseinfo.title}}</h3>
          <p>共{{courseinfo.hourcount}}个课时</p>
        </div>
        <div class="ks-col-5 ks-text-center" @click="sendFriend">
          <p class="course-title-tag">免费送好友</p>
          <i class="ks-icon ks-icon-gift-outline"></i>
          <p>送好友</p>
        </div>
      </div>
      <div class="ks-line"></div>
    </header>
    <ks-swiper :options="swiperOption" class="course-swiper" ref="courseSwiper">
      <ks-swiper-slide v-for="(item,index) in keshiList" :key="index">
        <div
          class="course-item"
          :class="index==activeKeShiIndex && 'course-item-active'"
          @click="changeActiveKeShiIndex(index)"
        >
          <ks-text
            class="course-item-title"
            :lineClamp="2"
            font-size="16px"
          >{{index+1}}.{{item.title}}</ks-text>
          <div class="course-item-des">{{item.content}}</div>
          <div class="course-item-type">视频</div>
          <div class="course-item-try-see">
            <i v-if="item.is_try_see == 2" class="course-item-try-see__text ks-color-success">试看</i>
            <i v-else-if="item.is_try_see != 1" class="ks-icon ks-icon-lock-outline"></i>
          </div>
        </div>
      </ks-swiper-slide>
    </ks-swiper>
    <div class="comment">
      <comment :comment-switch="isCanLearn" appid="6" :info-id="courseid" v-if="courseid"/>
    </div>
    <!--店铺信息-->
    <store-info class="ks-mt10" v-if="$route.query.miniprogram != 1"/>
    <!--底部-->
    <store-footer/>
  </div>
</template>

<script>
// import VideoPlayer from "@/m/components/video-player";
import VideoPlayer from "@/plugins/video-player";
import { getCourseDetail, getCoursePlayVod } from "@/api/course";
import Comment from "../comment/Comment";
export default {
  name: "CoursePlay",
  components: {
    Comment,
    VideoPlayer
  },
  data() {
    return {
      loading: false,
      /**是否开启活动 */
      free_id: null,
      /**当前课程id */
      courseid: this.$route.params.id,
      /**课程信息 */
      courseinfo: null,
      /**课时信息 */
      chapter: null,
      /**所有课时列表 */
      keshiList: [],
      /**当前选中课时索引 */
      activeKeShiIndex: 0,
      /**轮播图配置信息 */
      swiperOption: {
        slidesPerView: 2.3,
        preventClicksPropagation: true,
        slideToClickedSlide: true,
        on: {
          transitionEnd: () => {}
        }
      },
      /**是否可以评论 */
      isCanLearn: false
    };
  },
  activated() {
    this.loading = false;
    this.keshiList = [];

    getCourseDetail({ id: this.$route.params.id }).then(res => {
      this.free_id = res.free_id ? res.free_id : null;
      this.courseinfo = res.courseinfo;
      this.chapter = res.chapter;
      this.getKeshiList(res.chapter);
      this.loading = true;
    });
  },
  methods: {
    /**获取所有课时列表 */
    getKeshiList(res) {
      if (res.istype != 2) {
        if (res.istype == 0) {
          this.$map(res.chapter,el_chapter=>{
            this.$map(el_chapter.Section,el_keshi=>{
              this.$map(el_keshi.keshi,el=>{
                this.resetKeshiData(el);
                this.keshiList.push(el);
              });
            });
          });
        } else {

          this.$map(res.chapter,el_chapter=>{
            this.$map(el_chapter.keshi,ele=>{
              this.resetKeshiData(ele);
              this.keshiList.push(ele);
            });
          });
        }
      } else {
        this.$map(res.chapter,ele=>{
          this.resetKeshiData(ele);
          this.keshiList.push(ele);
        });
      }

      let chapterid = this.$route.query.chapterid;
      this.activeKeShiIndex = this.keshiList.findIndex(el => {
        return chapterid == el.chapterid;
      });
      this.changeActiveKeShiIndex(this.activeKeShiIndex);
    },
    /** 判断课时是否可观看 */
    resetKeshiData(ele) {
      /**
       * 课时可观看的3种条件
       * 第一种：当前课时是免费试听
       * 第二种：当前课程为免费请好友看，并且当前的课时id存在可免费看的课时数组里
       * 第三种：该课程免费或我已购买
       */
      let caseType = 0;
      if (ele.freeplay == 1) {
        caseType = 1;
      } else if (this.courseinfo.isbuy == 1 && this.courseinfo.gift == 3) {
        caseType = 2;
      } else if (this.courseinfo.isbuy == 1 && this.courseinfo.gift != 3) {
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
          let trySee = this.courseinfo.order_json.some(el => {
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
    },
    /** 改变课时索引 */
    changeActiveKeShiIndex(index) {
      let period = this.keshiList[index];
      let isTrySee = period.is_try_see;
      if (!isTrySee) {
        this.$toast("请先购买");
        return false;
      }
      this.activeKeShiIndex = index;
      /**播放器 */
      let chapterid = period.chapterid;
      getCoursePlayVod({
        courseid: this.courseid,
        chapterid: chapterid
      }).then(res => {
        if (res.errcode === "10002") {
          this.$toast("请先登录").then(() => {
            this.$router.push({
              name: "UserLogin"
            });
          });
          return false;
        }
        if (res.code == 10005) {
          this.$toast(res.msg);
          return false;
        }
        if (res.msg == "系统出错") {
          this.errTips = "暂无视频";
          return false;
        }
        if (res.play) {
          if (isTrySee == 2) {
            res.auditionTime = period.json.audition_time;
            res.price = this.courseinfo.price;
          }
          res.cover = this.courseinfo.defaultpic;
          res.courseid = period.courseid;
          res.chapterid = period.chapterid;
          this.$refs.player.play(res);
        }
      });
    },
    /** 送好友 */
    sendFriend() {
      let chapterid = this.keshiList[this.activeKeShiIndex].chapterid;
      let queryObj = { chapterid };
      if (this.free_id) {
        queryObj.free_id = this.free_id;
      }
      this.$router.push({
        name: "ShowGift",
        params: {
          id: this.courseid
        },
        query: queryObj
      });
    },
    /**点击购买 */
    buyCourse() {
      this.$showPay({
        payid:this.courseinfo.courseid,
        type:"course",
        msg:"购买课程",
        price:this.courseinfo.price
      })
    },
  }
};
</script>

<style scoped>
header {
  background-color: #fff;
}
.player {
  width: 100%;
  height: 11.5rem;
  background-color: rgba(0, 0, 0, 0.7);
}
.player .video-player {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.video-container {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.course-title-box {
  padding: 15px 15px 0px 15px;
  padding-bottom: 10px;
}
.course-title-box h3 {
  font-size: 16px;
}
.course-title-box .course-title-tag {
  padding: 2px 3px;
  background-color: var(--ornament-color);
  border-radius: 10px;
  color: #f6fffe;
  position: relative;
  bottom: 5px;
}
.course-title-tag::after {
  content: "";
  border-left: 7px solid transparent;
  border-right: 7px solid transparent;
  border-top: 7px solid var(--ornament-color);
  border-bottom: 7px solid transparent;
  position: absolute;
  left: 50%;
  transform: translate(-50%);
  bottom: -14px;
}
.course-detail-btn {
  position: relative;
  top: 3px;
  color: #656565;
}
.ks-icon-gift-outline {
  font-size: 28px;
  color: var(--ornament-color);
}
.course-title-box p {
  color: #9b9b9b;
}
.course-swiper {
  padding: 15px 0 15px 15px;
  background-color: #fff;
}
.course-item {
  border: 1px solid transparent;
  background-color: #f3f8fb;
  padding: 10px;
  border-radius: 5px;
  margin-right: 10px;
  position: relative;
}
.course-item-active {
  border: 1px solid var(--ornament-color);
  background-color: #fff;
}
.course-item-title {
  margin-top: 30px;
}
.course-item-active .course-item-title {
  color: var(--ornament-color);
}
.course-item-des {
  color: #9b9b9b;
  line-height: 1.4;
}
.course-item-type {
  background-color: #9da0af;
  color: #fff;
  padding: 3px 7px 3px 10px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
  position: absolute;
  left: 0;
  top: 10px;
}
.course-item-active .course-item-type {
  background-color: var(--ornament-color);
}
.course-item-try-see {
  position: absolute;
  right: 5px;
  top: 12px;
  color: #9c9c9c;
}
.course-item-try-see__text{
  font-style: normal;
}
.comment {
  padding: 0 15px;
  background-color: #fff;
}
</style>
