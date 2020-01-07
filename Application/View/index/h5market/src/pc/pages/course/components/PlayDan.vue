<template>
  <div class="play-dan">
    <ks-container margin-top="0px" v-if="info!=null">
      <el-row class="play-dan__bottom">
        <el-col :span="20" class="play-dan__bottom-left">
          <div class="play-dan__bottom-top">
            <el-tag size="small" v-if="info.courseType==1">点播</el-tag>
            <el-tag
              size="small"
              v-else-if="info.courseType==2"
            >{{(info.livetype == 1 && '一对一') || (info.livetype == 2 && '小班课') || (info.livetype == 3 && '千人直播') || (info.livetype == 4 && '语音直播') || '直播'}}</el-tag>
            <el-tag size="small" v-else-if="info.courseType==3">音频</el-tag>
            <el-tag size="small" v-else-if="info.courseType==4">图文</el-tag>
            <h1>{{info.title}}</h1>
            <span
              class="play-dan__bottom-price"
              v-if="info.isbuy == 1"
              :class="info.chargetype == 1 ? 'ks-color--error' : 'ks-color--success'"
            >{{info.chargetype == 1 ? '¥'+info.price : '免费'}}</span>
          </div>
          <div class="play-dan__bottom-bottom">
            <img src="@/pc/assets/play/lesson_icon_member.png">
            <span>{{info.soldnum}}人学习</span>
            <span v-if="$route.name === 'ColumnDetail'">
              <i class="el-icon-reading"></i>
              &nbsp; 已更新{{info.qs}}期
            </span>
            <el-popover placement="top-start" width="200" trigger="hover" v-if="info.qrcode">
              <img width="200px" :src="info.qrcode">
              <span slot="reference">
                <img src="@/pc/assets/play/lesson_icon_qrcode.png">&nbsp; 手机扫码观看
              </span>
            </el-popover>
          </div>
        </el-col>
        <el-col :span="4" class="play-dan__bottom-right">
          <el-tag
            class="purchased"
            type="success"
            size="medium"
            v-if="info.chargetype == 1 && info.isbuy == 1"
          >{{(info.buytype == 1 && '享全站免费特权') || (info.buytype == 2 && '专栏免费') || '已购买'}}</el-tag>
        </el-col>
      </el-row>
      <div class="play-dan__top">
        <!-- 播放器 -->
        <video-player
          ref="player"
          v-if="playMediaType === 'video'"
          style="width:100%;height:560px;"
          @buy="openBuy"
        />
        <!--播放器结束-->
        <audio-player
          v-else-if="playMediaType === 'audio'"
          :title="audioInfo.title"
          :cover="info.defaultpic"
          :src="audioInfo.src"
        />
        <div
          class="course-cover"
          :class="info.isbuy == 1 && info.courseType != 2 && 'course-cover--noafter'"
          :style="{backgroundImage:'url('+info.defaultpic+')'}"
          v-else
        >
          <div class="course-cover__box" v-if="info.isbuy == 1">
            <div v-if="info.courseType == 2">
              <div class="course-cover__text">{{time}}</div>
              <el-button type="primary" @click="goToLiveRoom" round>进入直播间</el-button>
            </div>
          </div>
          <div class="course-cover__box" v-else>
            <img v-if="info.courseType == 1" src="../../../assets/course/video_btn_video.png">
            <img v-else-if="info.courseType == 2" src="../../../assets/course/lesson_icon_live.png">
            <img
              v-else-if="info.courseType == 3"
              src="../../../assets/course/lesson_icon_audio_b.png"
            >
            <img v-else-if="info.courseType == 4" src="../../../assets/course/lesson_icon_text.png">
            <el-button
              class="course-cover__buy"
              v-if="info.isbuy == 0"
              @click="openBuy"
              round
            >立即购买(￥{{info.price}})</el-button>
          </div>
        </div>
      </div>
    </ks-container>
  </div>
</template>

<script>
import AudioPlayer from "@/pc/components/audio-player";
import VideoPlayer from "@/plugins/video-player";
export default {
  name: "PlayDan",
  components: {
    AudioPlayer,
    VideoPlayer
  },

  props: {
    /**基本信息 */
    info: {
      type: Object,
      default() {
        return {};
      }
    },
    /**信息类型 course | column ... */
    infoType: {
      type: String,
      default: "course"
    },
    /**错误提示 */
    errTips: String,
    /**当前时间 */
    nowTime: Number,
    /**课时信息 */
    periodData: {
      type: Object,
      default() {
        return {};
      }
    }
  },
  data() {
    return {
      /**播放媒体类型 */
      playMediaType: "",
      /**倒计时时间 */
      time: "",
      /**音频信息 */
      audioInfo: {}
    };
  },
  mounted() {
    /**直播课程，开启倒计时 */
    if (this.info.courseType == 2) {
      this.time = this.getLiveSatrtTime(
        this.periodData.begindate,
        this.periodData.enddate
      );
      setInterval(() => {
        this.$emit("update:nowTime", this.nowTime + 1);
        this.time = this.getLiveSatrtTime(
          this.periodData.begindate,
          this.periodData.enddate
        );
      }, 1000);
    }
  },
  methods: {
    /**
     * 打开购买窗口
     */
    openBuy() {
      this.$store.ready(state => {
        if (state.isLogin != 1) {
          this.$showLogin();
        } else {
          let id =
            (this.infoType === "course" && this.info.courseid) ||
            (this.infoType === "column" && this.info.columnid);
          this.$showPay({
            price: this.info.price,
            payid: id,
            type: this.infoType
          });
        }
      });
    },
    /**
     * 进入直播间
     */
    goToLiveRoom() {
      let action;
      switch (Number(this.info.livetype)) {
        case 1:
        case 2:
        case 3:
          action = "videolive";
          break;
        case 4:
          action = "audiolive";
          break;
      }
      window.open(`/course/live#/${action}?id=${this.info.courseid}`);
    },
    /**
     * 播放媒体
     * @param {Object}
     */
    playMedia(info) {
      this.playMediaType = info.mediaType;
      this.$nextTick(() => {
        if (info.mediaType === "video") {
          this.$refs.player.play(info, info.period);
        } else if (info.mediaType === "audio") {
          this.audioInfo = {
            src: info.videoid,
            title: info.title
          };
        }
      });
    },

    /**
     * 获取直播开始时间
     * @param {Number} 开始时间
     * @param {Number} 结束时间
     */
    getLiveSatrtTime(begindate, enddate) {
      if (this.nowTime > 0) {
        if (this.nowTime > enddate) {
          return "直播已经结束了";
        } else {
          let time = begindate - this.nowTime;
          if (time > 0) {
            let day = Math.floor(time / 86400);
            if (day > 0) {
              if (day < 30) {
                return `直播时间：倒计时 ${day} 天后`;
              } else {
                let date = new Date(begindate * 1000);
                let y = date.getFullYear();
                let m = date.getMonth();
                let d = date.getDay();
                let mm = date.getMinutes();
                let ss = date.getSeconds();
                return `${y}年${m}月${d}日 ${mm > 9 ? mm : "0" + mm}:${
                  ss > 9 ? ss : "0" + ss
                }`;
              }
            } else {
              let hour = Math.floor(time / 3600);
              if (hour > 0) {
                return `直播时间：倒计时 ${hour}小时后`;
              } else {
                let minute = Math.floor(time / 60);
                if (minute > 0) {
                  return `直播时间：倒计时 ${minute} 分钟 ${time -
                    minute * 60} 秒后`;
                } else {
                  return `直播时间：倒计时 ${time} 秒后`;
                }
              }
            }
          } else {
            return "当前正在直播中...";
          }
        }
      }
    }
  }
};
</script>

<style scoped>
.play-dan {
  margin-top: 15px;
}
.play-dan__bottom-left {
  padding: 20px 0 24px 20px;
}
.play-dan__bottom-top {
  font-size: 16px;
}

.play-dan__bottom-top h1 {
  display: inline-block;
  font-size: 16px;
  font-weight: normal;
  margin-left: 5px;
}
.play-dan__bottom-price {
  margin-left: 25px;
}
.play-dan__bottom-bottom {
  font-size: 14px;
  color: #aaa;
  line-height: 20px;
  height: 20px;
  margin-top: 16px;
}
.play-dan__bottom-bottom i {
  font-size: 16px;
  position: relative;
  top: 1px;
}
.play-dan__bottom-bottom img {
  float: left;
  margin-top: 3px;
}
.play-dan__bottom-bottom span {
  margin-right: 47px;
  margin-left: 3px;
  float: left;
}
.bdsharebuttonbox {
  float: left;
  margin-top: -4px;
}
.bds_more {
  font-size: 14px !important;
  color: #babdbf !important;
}
.play-dan__bottom-right {
  padding: 30px 20px 0 0;
}
.play-dan__bottom-right .purchased {
  float: right;
}

.play-dan__top {
  margin-top: 15px;
  position: relative;
}

.play-dan__bottom {
  height: 98px;
  background: #fff;
}

.course-player {
  width: 100%;
  height: 560px;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: 50% 50%;
}

.course-cover {
  width: 100%;
  height: 560px;
  position: relative;
  background-size: cover;
  background-position: 50% 50%;
  background-repeat: no-repeat;
}
.course-cover::after {
  content: "";
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  position: absolute;
  left: 0;
  top: 0;
}
.course-cover--noafter::after {
  display: none;
}
.course-cover__text {
  font-size: 16px;
  color: #fff;
  line-height: 36px;
  padding-bottom: 15px;
}
.course-cover__box {
  position: absolute;
  width: 300px;
  height: 120px;
  left: 50%;
  top: 50%;
  margin-left: -150px;
  margin-top: -60px;
  text-align: center;
  z-index: 9;
}
.course-cover__box img {
  margin: 0 auto;
  display: block;
}
.course-cover .course-cover__buy {
  background: none;
  margin-top: 30px;
  border: 1px solid #fff;
  color: #fff;
}
</style>

