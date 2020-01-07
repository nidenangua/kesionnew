<template>
  <div class="audio-player" :class="size && 'audio-player--'+size">
    <audio ref="audio" style="display:none"></audio>
    <div class="audio-player__bg" :style="{backgroundImage:'url('+cover+')'}"></div>
    <div class="audio-player__box">
      <div class="audio-player__cover" :class="isPlaying && 'audio-player__cover--rotation'">
        <ks-image :src="cover" />
      </div>
      <div class="audio-player__btns">
        <div class="audio-player__btn audio-player__btn-left"></div>
        <div
          class="audio-player__btn"
          @click="changePlayState"
          :class="isPlaying ? 'audio-player__btn-pause' : 'audio-player__btn-play'"
        ></div>
        <div class="audio-player__btn audio-player__btn-right"></div>
      </div>
      <div class="audio-player__schedule" ref="schedule">
        <div class="audio-player__now-time">{{getTime(currentTime)}}</div>
        <div class="audio-player__total-time">{{getTime(duration)}}</div>
        <el-slider
          v-model="currentTime"
          :format-tooltip="getTime"
          :max="duration"
          @change="onSliderChange"
        />
      </div>
      <div class="audio-player__title audio-player__title--error" v-if="errMsg">{{errMsg}}</div>
      <div class="audio-player__title" v-else-if="title">正在播放：{{title}}</div>
    </div>
  </div>
</template>
<script>
export default {
  name: "AudioPlayer",
  props: {
    /**当前播放文件标题 */
    title: String,
    /**封面地址 */
    cover: String,
    /**音频地址 */
    src: String,
    /**播放器大小 */
    size:String
  },
  data() {
    return {
      /**失败提示 */
      errMsg: "",
      /**是否在播放状态 */
      isPlaying: false,
      /**总时长 */
      duration: 0,
      /**当前播放时间 */
      currentTime: 0
    };
  },
  watch: {
    src() {
      this.play();
    }
  },
  mounted() {
    let audio = this.$refs.audio;
    this.play();
    audio.onloadeddata = e => {
      this.duration = Math.floor(audio.duration);
      audio.play();
    };
    /**开始播放 */
    audio.onplay = e => {
      this.errMsg = "";
      this.isPlaying = true;
    };
    /**播放中 */
    audio.ontimeupdate = e => {
      this.currentTime = Math.floor(audio.currentTime);
    };
    /**播放错误 */
    audio.onerror = e => {
      this.errMsg = "播放时遇到错误";
      this.isPlaying = false;
    };
    /**播放结束 */
    audio.onended = e => {
      this.isPlaying = false;
    };
    this.$refs.schedule
      .querySelector(".el-slider__runway")
      .addEventListener("mousedown", e => {
        this.pauseAudio();
      });
  },
  methods: {
    /**
     * 获取时间
     * @param {Number} 秒
     */
    getTime(time) {
      if (time > 0) {
        let hour = Math.floor(time / 3600);
        time -= hour * 3600;
        let minute = Math.floor(time / 60);
        time -= minute * 60;
        if (hour > 0) {
          return `${hour > 9 ? hour : "0" + hour}:${
            minute > 9 ? minute : "0" + minute
          }:${time > 9 ? time : "0" + time}`;
        } else {
          return `${minute > 9 ? minute : "0" + minute}:${
            time > 9 ? time : "0" + time
          }`;
        }
      } else {
        return "00:00";
      }
    },
    /**
     * 暂停音频
     */
    pauseAudio() {
      this.$refs.audio.pause();
      this.isPlaying = false;
    },
    /**
     * 播放音频
     */
    playAudio() {
      this.$refs.audio.play();
      this.isPlaying = true;
    },
    /**
     * 播放按钮
     */
    play() {
      let audio = this.$refs.audio;
      audio.currentTime = 0;
      audio.src = this.src;
    },
    /**
     * 改变播放状态
     */
    changePlayState() {
      this.isPlaying ? this.pauseAudio() : this.playAudio();
    },
    /**
     * 改变进度条位置
     */
    onSliderChange(v) {
      this.$refs.audio.currentTime = v;
      this.playAudio();
    }
  }
};
</script>
<style scoped>
.audio-player {
  position: relative;
  overflow: hidden;
  padding:40px 0;
  min-height: 570px;
  box-sizing: border-box;
}
.audio-player__bg {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  filter: blur(50px);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: 50% 50%;
}
.audio-player::after {
  content: "";
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  z-index: 9;
  background: rgba(0, 0, 0, 0.5);
}
.audio-player__box {
  position: absolute;
  z-index: 10;
  width: 100%;
  height: 490px;
  top:50%;
  left:0;
  margin-top:-245px;
}
.audio-player__cover {
  width: 286px;
  height: 286px;
  position: relative;
  margin: 0 auto;
  z-index: 10;
  overflow: hidden;
  background: url(./assets/disc-bg.png) no-repeat;
  background-size: cover;
}
.audio-player__cover--rotation {
  animation: rotation 6s linear infinite;
}
.audio-player__cover .ks-image {
  width: 110px;
  height: 110px;
  border-radius: 50%;
  overflow: hidden;
  left: 50%;
  margin-left: -55px;
  top: 50%;
  margin-top: -55px;
}
@keyframes rotation {
  from {
    -webkit-transform: rotate(0deg);
  }
  to {
    -webkit-transform: rotate(360deg);
  }
}
.audio-player__title {
  color: #fff;
  font-size: 14px;
  opacity: 0.6;
  text-align: center;
  margin-top: 20px;
}
.audio-player__title--error {
  color: #e00;
}
.audio-player__btns {
  width: 440px;
  margin: 0 auto;
  text-align: center;
  margin-top: 30px;
}
.audio-player__btn {
  display: inline-block;
  margin: 0 20px;
  background-position: 50% 50%;
  background-repeat: no-repeat;
  transition: 0.3s;
}
.audio-player__btn-left,
.audio-player__btn-right {
  width: 48px;
  height: 48px;
  opacity: 0.4;
  top: -5px;
  border-radius: 50%;
}
.audio-player__btn-left {
  background-image: url(./assets/24gl-previousFrameCircle.png);
}
.audio-player__btn-pause,
.audio-player__btn-play {
  width: 64px;
  height: 64px;
  background-color: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  cursor: pointer;
}
.audio-player__btn-pause:hover,
.audio-player__btn-play:hover {
  background-color: rgba(255, 255, 255, 0.3);
}
.audio-player__btn-play {
  background-image: url(./assets/play.png);
}
.audio-player__btn-pause {
  background-image: url(./assets/pause.png);
}
.audio-player__btn-right {
  background-image: url(./assets/next.png);
}

/* .audio-player__btn-left:hover,
.audio-player__btn-right:hover {
  opacity: 0.8;
} */
.audio-player__schedule {
  width: 70%;
  margin: 0 auto;
  margin-top: 30px;
  position: relative;
}
.audio-player__now-time,
.audio-player__total-time {
  position: absolute;
  font-size: 14px;
  color: #fff;
  font-weight: bold;
  top: 8px;
  line-height: 20px;
  width: 80px;
}
.audio-player__now-time {
  left: -95px;
  text-align: right;
}
.audio-player__total-time {
  right: -95px;
  text-align: left;
}

.audio-player--medium{
    min-height: 520px;
}
.audio-player--medium .audio-player__cover{
    width: 236px;
    height: 236px;
}
.audio-player--medium .audio-player__box{
    height:440px;
    margin-top:-220px;
}
.audio-player--medium .audio-player__cover .ks-image{
    width: 90px;
    height: 90px;
    margin-left: -45px;
    margin-top: -45px;
}
</style>
<style>
.audio-player__schedule .el-slider__runway {
  background: rgba(255, 255, 255, 0.3);
}
.audio-player__schedule .el-slider__bar {
  background: #f69e5c;
}
.audio-player__schedule .el-slider__button {
  border: 0px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
}
</style>
