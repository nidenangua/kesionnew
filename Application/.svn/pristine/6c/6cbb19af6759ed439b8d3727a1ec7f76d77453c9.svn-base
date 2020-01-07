<template>
  <div class="preview-image" v-if="type === 'image'">
    <!-- 点击放大 -->
    <div
      class=""
      v-for="(img,i) in info.list"
      :class="info.list.length === 1 && 'atlas'"
      :key="i"
      @click="$preview(info.list,i)"
    >
      <ks-image class="preview" :src="img.src"/>
    </div>
  </div>
  <div class="preview-video" v-else-if="type === 'video'">
    <video
      class="video"
      :src="info.src"
      controls
      controlslist="nodownload"
      ref="video"
      v-show="is_show"
    />
    <div v-show="!is_show">
      <img :src="videoCover" v-if="videoCover" class="video-cover">
      <img class="video-play" src="./assets/common_btn_play.png" @click="play" alt="">
    </div>
  </div>
  <div class="audio-wrapper" v-else-if="type === 'audio'">
    <audio ref="audio" style="display:none"></audio>
    <div
      class="audio-left"
      :class="(isPlay == 1 && 'audio-left--playing') || (isPlay == 2 && 'audio-left--pause')"
      @click="audioPlay"
    >
      <i class="audio-left__icon"></i>
    </div>
    <div class="audio-right">
      <span id="ad" class="audio-length-total">{{time}}</span>
      <div style="width: 80%;paddingTop: 5px;">
        <ks-progress
          :percentage="percentage"
          :show-text="false"
          bg-color="#fff"
          border="1px solid #f0f0f0"
        />
      </div>
    </div>
  </div>
</template>
<script>
let audioList = [];
let audioID = 0;
import { secondsConversion } from "@/utils";
export default {
  name: "MediaPreview",
  props: {
    /**查看类型 image | video | audio */
    type: String,
    info: {
      type: Object,
      default() {
        return {};
      }
    }
  },
  data() {
    audioID++;
    return {
      id: audioID,
      time: "00:00",
      duration: 0,
      isPlay: 0,
      percentage: 0,
      videoCover: "",
      is_show: false
    };
  },
  watch:{
    type(){
      this.$nextTick(()=>{
        this.createComponent();
      })
    },
    info:{
      handler(){
        this.$nextTick(()=>{
          this.createComponent();
        })
      },
      deep:true
    }
  },
  methods: {
    createComponent() {
      if (this.type === "audio") {
        var audio = this.$refs.audio;
        audio.src = this.info.src;
        audio.onloadeddata = e => {
          audio.loaded = true;
          let duration = Math.floor(audio.duration);
          this.duration = duration;
          this.time = secondsConversion(duration);
        };
        audio.onplay = e=>{
          this.isPlay = 1;
        }
        audio.onpause = e=>{
          this.isPlay = 2;
        }
        audio.onended = e=>{
          this.isPlay = 0;
        }
      
        audio.ontimeupdate = e => {
          let currentTime = Math.floor(audio.currentTime);
          let percentage = (currentTime / this.duration) * 100;
          this.percentage = percentage || 0;
        };
        audioList.push({
          id: this.id,
          audio: audio
        });
      } else if (this.type === "video") {
        var video = this.$refs.video;
        video.currentTime = 0.01;
        video.onended = e=>{
          this.is_show = false;
        }
        var canvas = document.createElement("canvas");
        video.setAttribute("crossOrigin", "anonymous");
        canvas.width = 160 * 4;
        canvas.height = 90 * 4;
        video.onpause = () => {
           canvas
            .getContext("2d")
            .drawImage(video, 0, 0, canvas.width, canvas.height);
          var dataURL = canvas.toDataURL("image/png");
          this.videoCover = dataURL;
          this.is_show = false;
        }
        video.onloadeddata = () => {
          canvas
            .getContext("2d")
            .drawImage(video, 0, 0, canvas.width, canvas.height);
          var dataURL = canvas.toDataURL("image/png");
          this.videoCover = dataURL;
          this.is_show = false;
        };
      }
    },
    audioPlay() {
      let audio = {};
      audioList.map(item => {
        if (item.audio.loaded) {
          item.audio.pause();
        }
        if (item.id === this.id) {
          audio = item.audio;
        }
      });
      if (this.isPlay == 1) {
        audio.pause();
      } else {
        audio.play();
      }
    },
    play() {
      this.is_show = true;
      this.$refs.video.play();
    }
  },
  mounted() {
    this.createComponent();
  }
};
</script>
<style scoped>
video::-internal-media-controls-download-button {
  display: none;
}
video::-webkit-media-controls-enclosure {
  overflow: hidden;
}
video::-webkit-media-controls-panel {
  width: calc(100%);
}
.preview-image .atlas .ks-image img {
  width: 100%;
  height: 10rem;
  object-fit: cover;
  margin-top: 5px;
}
.preview-image {
  overflow: hidden;
}
.preview-image .ks-image {
  float: left;
}
.preview-image .ks-image img {
  width: 4.5rem;
  height: 4.5rem;
  margin: 5px 8px 5px 0;
}
.preview-vodeo .video {
  width: 14.5rem;
  margin-top: 5px;
}

.audio-wrapper {
  background-color: #f7f7f7;
  /* margin: 10px auto;
  height: 60px; 
  padding: 15px;*/
  border-radius: 4px;
  display: flex;
  padding: 5px;
  border-radius: 4px;
  display: -webkit-box;
  display: -ms-flexbox;
}

.audio-left {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  /* background-color: #e64a3b; */
  text-align: center;
  line-height: 60px;
  color: #fff;
  background-image: url(../../assets/wx-audio/play.png);
  background-repeat: no-repeat;
  background-size: 30px 30px;
  background-position: 50% 50%;
}
.audio-left--playing {
  background-image: url(./assets/icon-pause.png);
}

.audio-right {
  padding-left: 15px;
  -webkit-box-flex: 1;
  -ms-flex: 1;
  flex: 1;
  position: relative;
}
.audio-right__name {
  font-weight: bold;
  line-height: 24px;
  height: 24px;
  font-size: 14px;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}

.audio-right__time {
  line-height: 20px;
  height: 20px;
  color: #e64a3b;
  font-size: 10px;
}

.audio-length-current {
  float: left;
  font-size: 12px;
}
.ks-action-sheet__list {
  border-radius: 5px;
  overflow: hidden;
}
.ks-action-sheet {
  width: 96%;
  left: 2%;
}
.ks-action-sheet__cancel {
  border-radius: 5px;
  overflow: hidden;
  margin-bottom: 10px;
}

/* 图片样式 */
.preview {
  width: 30%;
  height: 4.0rem;
  margin-right: 0.4rem;
  margin-top: 5px;
  border-radius: 4px;
}
.preview-image .atlas .preview {
  width: 100%;
  height: 10rem;
  border-radius: 4px;
  margin-top: 5px;
}
.audio-length-total {
  position: absolute;
  right: 0;
  top: 7px;
}
.preview-video {
  width: 100%;
  height: 9rem;
  position: relative;
  background: #000;
  border-radius: 5px;
}
.preview-video video {
  width: 100%;
  border-radius: 5px;
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  background-color: black;
}
.video-cover {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 5px;
  position: absolute;
  left: 0;
  top: 0;
}
.audio-left--playing {
  background-image: url(../../assets/wx-audio/playing.gif);
}
.video-play {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 64px;
  height: 64px;
  transform: translate(-50%, -50%);
}
</style>