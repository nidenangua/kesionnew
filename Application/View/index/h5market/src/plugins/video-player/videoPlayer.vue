<template>
  <div class="video-player" v-if="state && state.isLogin == 0 && state.is_onloginbrowse == 1">
    <div class="video-player__text">
        <p>此内容需要登录后才可观看</p>
        <ks-button size="medium" type="primary" @click="$showLogin()">立即登录</ks-button>
      </div>
  </div>
  <div class="video-player" v-else-if="state !== null">
    <div ref="videoContainer" v-if="flag"></div>
    <div class="video-player__audition-time" v-if="playInfo.auditionTime > 0 && tipsTime <= 5">
      <i class="ks-icon ks-icon-lock-outline"></i>
      此内容付费，可试看{{playInfo.auditionTime}}秒
    </div>
    <div class="video-player__audition" v-if="auditionEnd">
      <div class="video-player__text">
        <p>试听结束，购买后可查看完整内容</p>
        <ks-button size="medium" type="primary" @click="buy">{{playInfo.price}}元 购买课程</ks-button>
      </div>
    </div>
  </div>
</template>
<script>

import playerMonitor from "./player.monitor";
import { chapterRate, updateCourse } from "@/api/user";
export default {
  props:{
    idmotion:{
      type:Number,
      default:1
    }
  },
  name: "VideoPlayer",
  data() {
    return {
      state:null,
      tipsTime: 0,
      auditionEnd: false,
      playInfo: {},
      /**是否停止播放器 */
      stop: true,
      monitor:null,
      flag:true,
    };
  },
  mounted() {
    setInterval(() => {
      if (!this.monitor || this.stop) {
        return;
      }
      let currentTime = this.monitor.getCurrentTime();
      if (this.tipsTime > 0 && this.tipsTime % 5 == 0) {
        this.writeChapterRate();
      }
      if (this.tipsTime > 0 && this.tipsTime % 300 == 0) {
        updateCourse({
          courseid: this.playInfo.courseid,
          chapterid: this.playInfo.chapterid
        }).then(res => {
          // ...
        });
      }
      this.tipsTime += 1;
      if (currentTime > this.playInfo.auditionTime) {
        this.monitor.seek(this.playInfo.auditionTime);
        this.monitor.pause();
        this.playInfo.auditionTime = 0;
        this.auditionEnd = true;
        this.flag = false
      }
    }, 1000);
  },
  methods: {
    /**
     * 播放视频
     * @param {Object} playInfo
     */
    play(playInfo) {
      this.playInfo = playInfo;
      this.$store.ready(state=>{
        this.state = state
        this.$nextTick(()=>{
          if(!this.$refs.videoContainer){
            return
          }
          switch (playInfo.vdoService) {
            case "tencent":
              this.$refs.videoContainer.innerHTML =
                '<video id="player-container-id" preload="auto"  style="position: absolute; width: 100%;height: 100%;left: 0;top: 0;" webkit-playsinline playsinline x5-playsinline></video>';
              break;
            case "aliyun":
              this.$refs.videoContainer.innerHTML =
                '<div class="prism-player" style="position: absolute; width: 100%;height: 100%;left: 0;top: 0;" id="playercontainer"></div>';
              break;
          }
          if (
            (playInfo.vdoService === "aliyun" &&
              !document.getElementById("prismplayer")) ||
            (playInfo.vdoService === "tencent" &&
              !document.getElementById("tencent"))
          ) {
            let script = document.createElement("script");
            let style = document.createElement("link");
            style.rel = "stylesheet";
            switch (playInfo.vdoService) {
              case "aliyun":
                script.id = "prismplayer";
                script.src = "//g.alicdn.com/de/prismplayer/2.8.1/aliplayer-min.js";
                style.href =
                  "//g.alicdn.com/de/prismplayer/2.8.1/skins/default/aliplayer-min.css";

                break;
              case "tencent":
                script.id = "tcplayer";
                script.src =
                  "//imgcache.qq.com/open/qcloud/video/tcplayer/tcplayer.min.js";
                style.href =
                  "//imgcache.qq.com/open/qcloud/video/tcplayer/tcplayer.css";
                break;
            }
            script.addEventListener("load", () => {
              this.createPlayer(playInfo)
            });
            style.addEventListener("load", e => {
              document.body.appendChild(script);
            });
            document.head.appendChild(style);
            
          } else {
            this.createPlayer(playInfo)
          }
        })
      })
    },
    /**
     * 点击购买
     */
    buy() {
      this.$emit("buy");
    },
    /**
     * 创建播放器
     */
    createPlayer(playInfo){
      let player;
      switch (playInfo.vdoService) {
        case 'aliyun':
          player = new Aliplayer(playInfo.play);
          break
        case "tencent":
          player =  new TCPlayer('player-container-id',playInfo.play);
          break
      }
      if(player){
        this.createPlayerMonitor(player, playInfo.vdoService);
      }
      this.tipsTime = 0;
    },
    /*监听视频播放 */
    createPlayerMonitor(player, type) {
      
      this.monitor = new playerMonitor(player, {
        type: type,
        on: {
          ready: () => {
            this.stop = false;
          },
          play: () => {
            this.stop = false;
          },
          pause: () => {
            this.stop = true;
            updateCourse({
              courseid: this.playInfo.courseid,
              chapterid: this.playInfo.chapterid
            }).then(res => {
              //...
            });
          },
          ended:()=>{
            this.stop = true;
            this.writeChapterRate();
          }
        }
      });
    },
    /**写入课程进度 */
    writeChapterRate() {
      this.monitor.getDuration(duration => {
        let defaultParams = {
          courseid: this.playInfo.courseid,
          chapterid: this.playInfo.chapterid,
          total_time: duration,
          finish_time: this.monitor.getCurrentTime(),
          type: 1
        };
        chapterRate(defaultParams).then(res => {
          //...
        });
      });
    }
  }
};
</script>

<style scoped>
.video-player {
  position: relative;
  background: #000;
}

.video-player__audition {
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  z-index: 99;
  background: rgba(0, 0, 0, 0.6);
}
.video-player__text {
  text-align: center;
  font-size: 12px;
  position: absolute;
  top: 50%;
  left: 0;
  margin-top: -41px;
  width: 100%;
  z-index: 9;
  font-size: 14px;
  color: rgba(255, 255, 255, 0.6);
  line-height: 32px;
}
.video-player__text .ks-button {
  margin-top: 10px;
}

.video-player__audition-time {
  position: absolute;
  left: 10px;
  top: 10px;
  height: 24px;
  line-height: 24px;
  color: rgba(255, 255, 255, 0.6);
  z-index: 99;
}
.video-player__audition-time .ks-icon {
  font-size: 14px;
  position: relative;
  top: 0;
}
</style>

