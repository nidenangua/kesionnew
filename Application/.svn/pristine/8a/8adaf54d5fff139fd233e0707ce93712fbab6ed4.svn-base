<template>
<div class="audio-player">
  <audio ref="audio" :src="src" style="display:none"></audio>
  <div v-if="state && state.isLogin == 0 && state.is_onloginbrowse == 1">
    <div class="audio-player__bg" :style="{backgroundImage:'url('+(list[current] ? list[current].cover : '')+')'}"></div>
    <div class="audio-player__body" style="text-align:center;">
      <div class="audio-player__title" style="margin-top:1.25rem;">此内容需要登录后才可收听</div>
      <ks-button size="medium" type="primary" @click="login">立即登录</ks-button>
    </div>
  </div>
  <div v-else-if="state !== null">
    <div class="audio-player__bg" :style="{backgroundImage:'url('+(list[current] ? list[current].cover : '')+')'}"></div>
    <div class="audio-player__body">
      <div class="audio-player__title">{{list[current] ? list[current].title : ''}}</div>
      <div class="audio-player__probar">
        <div class="audio-player__time">
            {{getTime(currentTime)}}
        </div>
        <div class="audio-player__progress" ref="progress" @touchstart="onBarTouchStart" @touchmove="onBarTouchMove" @touchup="onBarTouchUp">
            <div class="audio-player__progress--completed" :style="{width:progress+'%'}">
                <i class="audio-player__progress-dot" @touchstart="onTouchStart"></i>
            </div>
        </div>
        <div class="audio-player__time">
            {{getTime(duration)}}
        </div>
      </div>
      <div class="audio-player__msg">
          {{errMsg}}
      </div>
      <div class="audio-player__menu">
        <div class="audio-player__menu-item audio-player__menu-item--prev" @click="prev" :class="!prevAudio && 'audio-player__menu-item--disabled'">
            <span class="audio-player__menu-buy" v-if="prevAudio && prevAudio.is_try_see == 0">需购买</span>
        </div>
        <div class="audio-player__menu-item" :class="isPlaying ? 'audio-player__menu-item--pause' : 'audio-player__menu-item--play'" @click="changePlayState"></div>
        <div class="audio-player__menu-item audio-player__menu-item--next" @click="next" :class="!nextAudio && 'audio-player__menu-item--disabled'">
            <span class="audio-player__menu-buy" v-if="nextAudio && nextAudio.is_try_see == 0">需购买</span>
        </div>
      </div>
    </div>
  </div>
</div>
</template>
<script>
export default {
  name: "AudioPlayer",
  props: {
    /**是否购买 */
    isbuy:Number,
    /**是否自动播放 */
    slide:[Number,String],
    list:{
        type:Array,
        default(){
            return []
        }
    },
    current:{
        type:Number,
        default:0
    },
    title: String,
  },
  data() {
    return {
        state:null,
        src:'',
        errMsg:'',
        prevAudio:null,
        nextAudio:null,
        isPlaying: false,
        duration:0,
        currentTime:0,
        progress:0,
        /**可试看时间，0为不限 */
        audition_time:0
    };
  },
  watch:{
      current(current){
          this.updateSrc(current)
          this.$emit('change',this.list[current])
      }
  },
  mounted() {
    let audio = this.$refs.audio;
    audio.onloadeddata = e => {
      this.duration = Math.max(Math.round(audio.duration),1);
    };
    /**开始播放 */
    audio.onplay = e => {
      this.errMsg = ""
      this.isPlaying = true
    }
    /**暂停 */
    audio.onpause = e => {
      if(!this.isbuy) {
        if(this.audition_time > 0 && this.currentTime >= this.audition_time){
          this.errMsg = '试听已结束，请购买课程'
        }else{
          this.errMsg = ""
        }
      }
      this.isPlaying = false
    }
    /**播放中 */
    audio.ontimeupdate = e => {
      this.currentTime = Math.round(audio.currentTime)
      let progress = Math.round((this.currentTime / this.duration) * 100)
      this.progress = progress
      if(!this.isbuy) {
        if(this.audition_time > 0 && this.currentTime >= this.audition_time){
          audio.pause()
        }
      }
    };
    /**播放错误 */
    audio.onerror = e => {
      this.errMsg = '播放时遇到错误'
      this.isPlaying = false
    };
    /**播放结束 */
    audio.onended = e => {
      this.isPlaying = false;
    };
    this.$store.ready(state=>{
      this.state = state
      if(state.isLogin == 0 && state.is_onloginbrowse == 1){

      }else{
        this.updateSrc(0)
      }
    })
    
    
  },
  methods: {
    /**
     * 登录
     */
    login(){
      this.$router.push('/user/login')
    },
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
    },
    /**
     * 播放音频
     */
    playAudio() {
      if(!this.isbuy) {
        if(this.audition_time > 0 && this.currentTime >= this.audition_time){
          return
        }
      }
      this.$refs.audio.play()
      
    },
    /**
     * 改变播放状态
     */
    changePlayState() {
      this.isPlaying ? this.pauseAudio() : this.playAudio();
    },
    /**
     * 圆点触发触摸点击事件
     */
    onTouchStart(e){
        e.stopPropagation()
        this.seekFlag = true
    },
    /**进度条触摸点击事件 */
    onBarTouchStart(e){
        this.$antiCopy(true)
        this.updateProgress(e)
    },
    /**
     * 进度条拖动事件
     */
    onBarTouchMove(e){
        if(this.seekFlag){
            this.updateProgress(e)
        }
    },
    /**
     * 进度条拖动结束
     */
    onBarTouchUp(e){
        this.$antiCopy(false)
        this.seekFlag = false
    },
    /**
     * 更新进度信息
     */
    updateProgress(e){
        let x = e.targetTouches[0].clientX 
        let a = x - this.$refs.progress.offsetLeft
        let b = this.$refs.progress.offsetWidth
        let c = Math.min(Math.round(a / b * 100),100)
        let d = Math.round(this.duration * (c / 100))
        this.progress = c
        this.currentTime = d
        this.$refs.audio.currentTime = d
    },
    /**
     * 上一条
     */
    prev(){
        if(this.prevAudio){
            if(this.prevAudio.is_try_see == 0){
                this.$confirm('需要购买课程才能收听，是否前往购买？').then(()=>{
                    this.$emit('buy')
                })
            }else{
                this.$emit('update:current',this.current - 1)
            }
        }
    },
    /**
     * 下一条
     */
    next(){
        if(this.nextAudio){
            if(this.nextAudio.is_try_see == 0){
                this.$confirm('需要购买课程才能收听，是否前往购买？').then(()=>{
                    this.$emit('buy')
                })
            }else{
                this.$emit('update:current',this.current + 1)
            }
            
        }
    },
    /**
     * 判断是否是在微信环境
     */
    isWeiXin() {
      var ua = window.navigator.userAgent.toLowerCase();
      if (ua.match(/MicroMessenger/i) == "micromessenger") {
        return true;
      } else {
        return false;
      }
    },
    /**
     * 更新播放地址
     */
    updateSrc(current){
        let currentAudio = this.list[current]
        if(currentAudio){
            this.duration = 0
            this.currentTime = 0
            this.progress = 0
            this.audition_time = currentAudio.audition_time || 0
            this.src = currentAudio.src
            if(currentAudio.is_try_see == 2 && currentAudio.audition_time > 0){
                this.errMsg = '您可试听'+currentAudio.audition_time+'秒'
            }else{
                this.errMsg = ''
            }
            this.isPlaying = false
            if(this.slide == 1) {
                this.$nextTick(()=>{
                  if(this.isWeiXin()){
                      this.$wx.ready(()=>{
                          this.$refs.audio.play()
                      })
                  }else{
                      this.$refs.audio.play()
                  }
                  
              })
            }
        }
        if(this.list[current+1]){
            this.nextAudio = this.list[current + 1]
        }else{
            this.nextAudio = null
        }
        if(this.list[current-1]){
            this.prevAudio = this.list[current - 1]
        }else{
            this.prevAudio = null
        }
        
    }
  }
};
</script>
<style scoped>
.audio-player {
  position: relative;
  width: 100%;
  height: 100%;
}
.audio-player::after {
  content: "";
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  z-index: 1;
  background: rgba(0, 0, 0, 0.4);
}
.audio-player__bg {
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  background-size: cover;
  background-position: 50% 50%;
  filter: blur(45px);
}
.audio-player__body {
  position: relative;
  z-index: 10;
  padding: 20px 15px;
}
.audio-player__title {
  color: #fff;
  height: 72px;
  font-size: 16px;
  padding: 0 30px;
  align-items: center;
  overflow: hidden;
  line-height: 24px;
  display: flex;
  justify-content: center;
}
.audio-player__probar{
    display: flex;
    margin-top: 10px;
}
.audio-player__time{
    color:#fff;
    padding: 0 15px;
    line-height: 24px;
    min-width: 62px;
    text-align: center;
    box-sizing: border-box;
}
.audio-player__progress {
  height: 24px;
  position: relative;
  flex: 1;
}
.audio-player__progress::after{
    content: '';
    background: rgba(0, 0, 0, 0.3);
    border-radius: 3px;
    height: 3px;
    position:absolute;
    left:0;
    top:50%;
    margin-top: -1px;
    width: 100%;
}

.audio-player__progress--completed {
  height: 100%;
  position: absolute;
  width: 0%;
  top: 0;
  left: 0;
  z-index:1;
}
.audio-player__progress-dot{
    width: 16px;
    height: 16px;
    position: absolute;
    right: 0;
    top: 50%;
    margin-right: -8px;
    margin-top: -8px;
    border-radius: 50%;
    background:rgba(255,255,255,0.2);
    z-index: 2;
}
.audio-player__progress-dot::after{
    content: '';
    width: 6px;
    height: 6px;
    background: rgba(255, 255, 255, 0.7);
    position:absolute;
    left: 50%;
    margin-left: -3px;
    top: 50%;
    margin-top: -3px;
    border-radius: 50%;
}
.audio-player__progress--completed::after{
    content: '';
    background: rgba(255,255,255,0.7);
    border-radius: 3px;
    height: 3px;
    position:absolute;
    left:0;
    top:50%;
    margin-top: -1px;
    width: 100%;
}
.audio-player__msg{
    color:#e64a3b;
    line-height: 24px;
    height:24px;
    overflow: hidden;
    text-align: center;
}
.audio-player__menu {
  color: #fff;
  display: flex;
  padding: 0 15%;
  margin-top: 10px;
  justify-content: center;
  align-items: center;
}
.audio-player__menu-item {
  flex: 1;
  text-align: center;
  background-repeat: no-repeat;
  background-size: 50px 50px;
  width: 50px;
  height: 50px;
  background-position: 50% 50%;
  position: relative;
}
.audio-player__menu-item--prev {
  background-image: url(../../assets/audio-player/icon-prev.png);
}
.audio-player__menu-item--play {
  background-image: url(../../assets/audio-player/icon-play.png);
}
.audio-player__menu-item--pause {
  background-image: url(../../assets/audio-player/icon-pause.png);
}
.audio-player__menu-item--next {
  background-image: url(../../assets/audio-player/icon-next.png);
}
.audio-player__menu-item--disabled{
    opacity: 0.5;
}
.audio-player__menu-buy{
    height: 18px;
    line-height: 18px;
    padding: 0 8px;
    font-size: 10px;
    border: 1px solid #e64a3b;
    color:#e64a3b;
    border-radius: 18px;
    position:absolute;
    left: 50%;
    margin-left: -23px;
    top: -10px;
}
</style>