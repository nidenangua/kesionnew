<template>
  <div class="recorder-box">
    <div class="recorder-box__loading" v-show="audioLoading">
      <span>音频上传中...</span>
    </div>
    <p v-if="recorderState === 'start'">每条语音不超过{{max}}s</p>
    <p v-else-if="recorderState === 'recording'">{{time}}s/{{max}}s</p>
    <p v-else>
      {{currentTime}}s/
      {{duration}}s
    </p>
    <span class="recorder-box__btn" @click="recordTrigger">
      <i class="iconfont icon-yuyin" v-if="recorderState === 'start'"></i>
      <i class="iconfont icon-jiazai_shuang" v-else-if="recorderState === 'loading'"></i>
      <i class="suspend" v-else-if="recorderState === 'recording'"></i>
      <i class="iconfont icon-bofang" v-else-if="recorderState === 'end'"></i>
      <i class="iconfont icon-zanting" v-else-if="recorderState === 'play'"></i>
    </span>

    <p v-if="recorderState === 'start'">点击图标开始录音</p>
    <p v-else-if="recorderState === 'recording'">点击图标结束录音</p>
    <p v-else>点击图标播放录音</p>
    <div v-if="recorderState === 'end' || recorderState === 'play'">
      <div @click="recorderCancel" class="recorder-box__cancel">取消</div>
      <div @click="recorderSend" class="recorder-box__send">发送</div>
    </div>
  </div>
</template>
<script>
import Recorder from "recorder-js";
let blob = null;
let recorder = null;
let audio = document.createElement("audio");
export default {
  /**录音功能 */
  name: "RecorderBox",
  props: {
    max: {
      type: Number,
      default: 60
    }
  },
  data() {
    return {
      /**当前录音时间 */
      time: 0,
      /**录音加载状态 */
      audioLoading: false,
      /**录音状态 */
      recorderState: "start",
      currentTime: 0,
      duration: 0
    };
  },
  mounted() {
    /**监听音频播放状态 */
    setInterval(() => {
      if (audio.duration) {
        this.currentTime = Math.floor(audio.currentTime);
        this.duration = Math.floor(audio.duration);
      }
    }, 500);
  },
  methods: {
    /**
     * 取消录音
     */
    recorderCancel() {
      audio.pause();
      recorder.stop();
      this.recorderState = "start";
      this.time = 0;
      this.currentTime = 0;
      this.duration = 0;
    },
    /**
     * 发送语音
     */
    recorderSend() {
      if (!audio.duration || !blob || this.audioLoading) {
        return;
      }
      blob.name = `record${new Date().getTime()}.wav`;
      this.$store.ready(state => {
        this.audioLoading = true;
        this.$addFile(
          {
            type: "recorder",
            wxid: state.info.wxid,
            uploaded: info => {
              this.audioLoading = false;
              this.recorderCancel();
              this.$emit("send", info.path);
            }
          },
          blob
        );
      });
    },
    /**
     * 触发录音按钮
     */
    recordTrigger() {
      if(this.recorderState === 'loading'){
        return
      }
      switch (this.recorderState) {
        case "start":
          if (!recorder) {
            /**调起录音设备 */
            navigator.mediaDevices
              .getUserMedia({ audio: true })
              .then(stream => recorder.init(stream))
              .catch(err =>
                console.log("Uh oh... unable to get stream...", err)
              );
            const audioContext = new (window.AudioContext ||
              window.webkitAudioContext)();
            recorder = new Recorder(audioContext, {
              /** 255个数字的数组，可以用它来可视化音频流*/
              onAnalysed: data => {}
            });
            this.recorderState = "loading";
            setTimeout(() => {
              this.startRecording();
              this.recorderState = "recording";
              this.updateRecordTime();
            }, 1000);
          } else {
            this.startRecording();
            this.recorderState = "recording";
            this.updateRecordTime();
          }

          break;
        case "recording":
          this.stopRecording();
          this.recorderState = "end";
          break;
        case "play":
          audio.pause();
          this.recorderState = "end";
          break;
        case "end":
          audio.play();
          this.recorderState = "play";
          audio.addEventListener("ended", e => {
            this.recorderState = "end";
          });
          break;
      }
    },
    /**
     * 开始录音
     */
    startRecording() {
      recorder.start();
    },
    /**
     * 停止录音
     */
    stopRecording() {
      recorder.stop().then(res => {
        blob = res.blob;
        var url = URL.createObjectURL(blob);
        audio.src = url;
        audio.load();
      });
    },
    /**
     * 更新当前录音时间
     */
    updateRecordTime() {
      setTimeout(() => {
        if (this.recorderState === "recording") {
          this.time++;
          if (this.time < this.max) {
            this.updateRecordTime();
          } else {
            this.recordTrigger();
          }
        }
      }, 1000);
    }
  }
};
</script>

<style scoped>
.recorder-box {
  text-align: center;
  line-height: 30px;
  padding: 30px 15px;
  color: #666;
  font-size: 13px;
}

.recorder-box__loading {
  width: 100%;
  height: 100%;
  position: absolute;
  background: rgba(0, 0, 0, 0.4);
  color: #fff;
  left: 0;
  top: 0;
  z-index: 99;
  text-align: center;
  font-size: 14px;
}
.recorder-box__loading span {
  position: absolute;
  left: 0;
  width: 100%;
  height: 44px;
  line-height: 44px;
  top: 50%;
  margin-top: -22px;
}
.recorder-box__btn {
  width: 60px;
  height: 60px;
  display: block;
  background: #6199fb;
  border-radius: 50%;
  margin: 5px auto;
  border: 4px solid #cbdbf9;
  line-height: 60px;
  cursor: pointer;
  position: relative;
}
.recorder-box__btn i {
  font-size: 30px;
  width: 40px;
  height: 40px;
  line-height: 40px;
  text-align: center;
  color: #fff;
  text-align: center;
  -webkit-transition: 0.3s;
  transition: 0.3s;
  position: absolute;
  left: 50%;
  top: 50%;
  margin-left: -20px;
  margin-top: -20px;
}
.recorder-box__btn .icon-jiazai_shuang{
  -webkit-animation:zhuan .8s linear infinite;
}
@-webkit-keyframes zhuan{
 
  0%{-webkit-transform:rotate(0deg);}

  25%{-webkit-transform:rotate(90deg);}

  50%{-webkit-transform:rotate(180deg);}

  75%{-webkit-transform:rotate(270deg);}

  100%{-webkit-transform:rotate(360deg);}

}
.recorder-box__btn:hover i {
  transform: scale(1.2);
  -ms-transform: scale(1.2);
  -moz-transform: scale(1.2);
  -webkit-transform: scale(1.2);
  -o-transform: scale(1.2);
}
.recorder-box__btn .suspend {
  background: #fff;
  border-radius: 4px;
  width: 20px;
  height: 20px;
  margin-left: -10px;
  margin-top: -10px;
}
.recorder-box__cancel,
.recorder-box__send {
  width: 68px;
  height: 34px;
  position: absolute;
  top: 50%;
  margin-top: -18px;
  text-align: center;
  box-sizing: border-box;
  line-height: 34px;
  border-radius: 4px;
  cursor: pointer;
}
.recorder-box__cancel {
  border: 1px solid #e6e6e6;
  left: 40px;
}
.recorder-box__send {
  right: 40px;
  background: #e6412d;
  color: #fff;
}
</style>
