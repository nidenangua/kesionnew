<template>
  <div class="preview-image" v-if="type === 'image'">
    <!-- 点击放大 -->
    <div class v-for="(img,i) in info.list" :class="info.list.length === 1 && 'atlas'" :key="i" @click="$preview(info.list,i)">
      <ks-image class="preview" :src="img.src" />
    </div>
  
  </div>
  <div class="preview-video" v-else-if="type === 'video'">
    <video class="video" :src="info.src" controls controlslist="nodownload" />
  </div>
  <div class="audio-wrapper" v-else-if="type === 'audio'" >
    <div class="audio-left" :class="(isPlay == 1 && 'audio-left--playing')  || (isPlay == 2 && 'audio-left--pause')" @click="audioPlay">
        <i class="audio-left__icon"></i>
    </div>
    <div class="audio-right">
      <span class="audio-length-total">{{time}}</span>
      <div style="width: 80%;paddingTop: 5px;">
        <ks-progress :percentage="percentage" :show-text="false" bg-color="#fff" border="1px solid #f0f0f0" />
      </div>
    </div>
  </div>
</template>
<script>
let audioList = [];
let audioID = 0;
import { secondsConversion } from '@/utils'
import KsProgress from '@/components/ui/progress'
export default {
  name: "MediaPreview",
  components:{
    KsProgress
  },
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
  watch:{
    type(){
      this.addAudio()
    }
  },
  data() {
    audioID ++;
    return {
        id:audioID,
        time:'00:00',
        duration: 0,
        isPlay:0,
        percentage:0
    }
  },
  mounted() {
   this.addAudio();
  },
  destroyed(){
    audioList.map((item,i)=>{
      if(item.id === this.id){
        item.audio.pause();
        audioList.splice(i,1)
      }
    });
  },
  methods: {
     addAudio(){
       if(this.type === 'audio'){
        var audio = document.createElement('audio');
        audio.src = this.info.src;
        audio.onloadeddata = e => {
            audio.loaded = true;
            let duration = Math.floor(audio.duration);
            this.duration = duration;
            this.time = secondsConversion(duration);
        };
        audio.addEventListener('play',e=>{
            this.isPlay = 1;
        });
        audio.addEventListener('pause',e=>{
            this.isPlay = 2;
        });
        audio.addEventListener('ended',e=>{
            this.isPlay = 0;
        });
        audio.ontimeupdate = e => {
            let currentTime = Math.floor(audio.currentTime);
            let percentage = currentTime / this.duration * 100;
            this.percentage = percentage;
        };
        audioList.map((item,i)=>{
          if(item.id === this.id){
            audioList.splice(i,1)
          }
        })
        audioList.push({
          id:this.id,
          audio:audio
        });
      }
     },
     audioPlay() {
      let audio = {}
      audioList.map(item=>{
        if(item.audio.loaded){
          item.audio.pause();
        }
        if(item.id === this.id){
          audio = item.audio
        }
      });
      if(this.isPlay == 1){
        audio.pause()
      }else{
        
        audio.play() 
      }
      
    }
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
.preview-image .atlas .ks-image img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  margin-top: 5px;
}
.preview-image{
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
  border-radius: 4px;
  display: flex;
  padding: 5px;
  border-radius: 4px;
  display: -webkit-box;
  display: -ms-flexbox;
}

.audio-left {
    width: 40px;
    height: 40px;
    text-align: center;
    color: #fff;
    background-image: url(./assets/play.png);
    background-repeat: no-repeat;
    background-size: 100% 100%;
}
.audio-left--playing{
    /* animation: rotation 3s linear infinite;*/
    background-image: url(./assets/playing_gr.gif);
} 
@keyframes rotation {
  from {
    -webkit-transform: rotate(0deg);
  }
  to {
    -webkit-transform: rotate(360deg);
  }
}
.audio-left--pause{
    background-image: url(./assets/playing_gr.gif);
}

.audio-right {
  width: 400px;
  padding-left: 15px;
  flex: 1;
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
.ks-action-sheet__list{border-radius: 5px;overflow: hidden;}
.ks-action-sheet{width: 96%;left: 2%;}
.ks-action-sheet__cancel{border-radius: 5px;overflow: hidden;margin-bottom: 10px;}
.audio-length-total{position: absolute;right: 18px;top: 10px;font-size: 16px}
/* 图片样式 */
.preview{
  width: 10rem;
  height: 10rem;
  margin-right: .5rem;
  margin-top: 5px;
  border-radius: 4px;
}
.preview-image .atlas .preview{
  width: 100%;
  height: 23rem;
  border-radius: 4px;
  margin-top: 5px;
}
.preview-video{width: 100%;}
.atlas{
  width: 550px;
}
.audio-wrapper {
  position: relative;
}
.audio-left {
     background-image: url(./assets/play.png);
}
.audio-left--playing{
    background-image: url(./assets/playing_gr.gif);
}
</style>