<template>
  <div class="stream-seat">
    
    <div class="stream-seat__leave" v-if="leave">
        <div class="stream-seat__leave-text">
            用户暂时离开
        </div>
    </div>
    <div class="stream-seat__novideo" v-if="video === 2">   
    </div>
    <div class="stream-seat__player" :id="`STREAM_PLAYER${sid}`" v-if="video > 0"></div>
    <div class="ks-image">
      <img :src="avatar" />
    </div>
    <div class="stream-seat__speaking" v-if="voice > 0">
      <div class="stream-seat__voice">
        <div class="stream-seat__voice-on" :style="{height:voice+'%'}"></div>
      </div>
    </div>
    <div class="stream-seat__name">
      <div class="stream-seat__audio" v-if="showMediaState" :class="{'stream-seat__audio--on':audio === 1,'stream-seat__audio--authority':authority}" @click="authority && $emit('audio-click',{
          sid:sid,
          value:audio !== 1
      })">
        <i class="iconfont icon-tubiaozhizuomoban"></i>
      </div>
      <div class="stream-seat__video" v-if="showMediaState" :class="{'stream-seat__video--on':video === 1,'stream-seat__video--authority':authority}" @click="authority && $emit('video-click',{
          sid:sid,
          value:video !== 1
      })">
        <i class="iconfont icon-shipin"></i>
      </div>
      {{name}}
    </div>
  </div>
</template>
<script>
export default {
  name: "StreamSeat",
  props: {
    /**id（唯一，信令id） */
    sid: {
        type:Number,
        default:0
    },
    /**用户头像 */
    avatar: String,
    /**用户名 */
    name: String,
    /**音频状态 0无音频 1存在音频 2音频通道禁止 */
    audio:{
        type:Number,
        default:0
    },
    /**视频状态 0无视频 1存在视频 2视频通道禁止 */
    video:{
        type:Number,
        default:0
    },
    /**用户离开状态 */
    leave:{
        type:Boolean,
        default:false
    },
    /**声音 */
    voice:{
      type:Number,
      default:0
    },
    /**操作视频、音频开关权限 */
    authority:{
      type:Boolean,
      default:false
    },
    /**显示用户的媒体状态 */
    showMediaState:{
      type:Boolean,
      default:false
    }
  }
};
</script>

<style scoped>
.stream-seat{
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 100%;
}
.stream-seat__leave{
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 9;
    background: rgba(0, 0, 0, 0.6);
    
}
.stream-seat__leave-text{
    height: 44px;
    line-height: 44px;
    position: absolute;
    top:50%;
    margin-top:-22px;
    text-align: center;
    font-size: 14px;
    color:rgba(255, 255, 255, 0.6);
    width: 100%;
}
.stream-seat__player {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
}
.stream-seat__name {
  position: absolute;
  width: 100%;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  height: 24px;
  line-height: 24px;
  background: rgba(0, 0, 0, 0.6);
  bottom: 0;
  left: 0;
  color: #fff;
  padding: 0 15px;
  z-index: 10;
  transition: .3s;
}
.stream-seat:hover .stream-seat__name{
  bottom: 0;
}
.stream-seat__audio,
.stream-seat__video {
  width: 20px;
  height: 20px;
  line-height: 20px;
  position: absolute;
  color: rgba(255, 255, 255, 0.6);
  top: 3px;
  text-align: center;
}
.stream-seat__audio {
  right: 10px;
}
.stream-seat__video {
  right: 34px;
}
.stream-seat__audio i,
.stream-seat__video i{
    font-size: 14px;
}
.stream-seat__audio--on,
.stream-seat__video--on{
    color:#4687fa;
}
.stream-seat__audio--authority:hover,
.stream-seat__video--authority:hover{
    background: #4687fa;
    cursor: pointer;
    border-radius: 4px;
    color:#fff;

}

.stream-seat__novideo{
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 9;
    background:url(../../assets/video-live/novideo.png) no-repeat 50% 50%;
    background-size: cover;
}
.stream-seat__speaking{
  width:10px;
  height: 19px;
  padding: 5px 0;
  background: rgba(0, 0, 0, 0.3);
  border-radius: 40px;
  position: absolute;
  bottom: 36px;
  right: 16px;
  z-index: 10;
}
.stream-seat__voice{
  position: absolute;
  width: 100%;
  height: 19px;
  left:0;
  bottom:5px;
  
}
.stream-seat__voice::after{
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  left:0;
  opacity: 0.5;
  bottom:0;
  background: url(../../assets/video-live/voice.png) no-repeat 50% 100%;
}
.stream-seat__voice-on{
  position: absolute;
  width: 100%;
  height: 0%;
  left:0;
  bottom:0;
  background: url(../../assets/video-live/voice-on.png) no-repeat 50% 100%;
  z-index: 9;
}
</style>
