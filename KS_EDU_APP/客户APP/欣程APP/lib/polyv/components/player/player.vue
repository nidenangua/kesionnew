<template>
  <view class="plv-player">
    <!-- 直播播放器 -->
    <plv-live-player
      v-if="mode === 'live'"
      :skin="skin"
      :video-option="videoOption"
      @onLiveStorageProgress="onLiveStorageProgress"
      @onLiveVodEnd="onLiveVodEnd"
      @onLiveStatusChange="onLiveStatusChange"
    />
    <!-- 点播播放器 -->
    <view class="plv-mp-vod-player-box" v-else>
      <video
        class="plv-mp-vod-player-box-video"
        id="plvVodPlayer"
        :src="vodSrc"
        autoplay
        object-fit="contain"
        @timeupdate="onVodTimeUpdate"
        @play="onVodPlay"
        @pause="onVodPause"
        @waiting="onVodWaiting"
        @ended="onVodEnded"
        @error="onVodError"
      >
        <cover-image
          v-if="isCamClosed === 1"
          src="https://playertest.polyv.net/player2/test/nong/nocamera_ppt.jpg"
        ></cover-image>
      </video>
    </view>
  </view>
</template>
<script>
import PlvLivePlayer from '../live-player/live-player'
import Polyv from "../../common/player/polyv.min";
export default {
  components:{
    PlvLivePlayer
  },
  props:{
    videoOption:{
      type:Object
    },
    vodSeek:{
      type: Number,
      default:0
    },
    skin: {
      type: String,
      default: "black"
    }
  },
  watch:{
    videoOption:{
      handler(e){
        const { mode: o } = e;
        (e.liveMode = e.liveMode >= 0 ? e.liveMode : 1);
        let keys = Object.keys(e);
        keys.map(k=>{
          this[k] = e[k]
        });
        "vod" === o && this.changeVid(e);
      },
      deep:true,
      immediate:true
    },
    vodSeek(e){
      e > -1 && this.seek(e);
    }
  },
  data(){
    return {
      uid: "",
      cid: "",
      mode: "",
      vodVid: "",
      vodSrc: "",
      isCamClosed: !1
    }
  },
  methods: {
    changeVid(par = {}) {
      Polyv.getVideo({
        vid: par.vid,
        ts: par.ts || "",
        sign: par.sign || "",
        sid: par.sid || "",
        callback: e => {
          const { error: o, src: t, outflow: i, timeoutflow: r } = e,
            d = {};
          if (o)
            switch (((d.msg = o), o)) {
              case "视频数据获取失败":
                d.errorCode = "31000";
                break;
              case "vid不能为空":
                d.errorCode = "31001";
            }
          i && ((d.msg = "点播过期"), (d.errorCode = "31002")),
            r && ((d.msg = "账户没流量"), (d.errorCode = "31003"));
            if(d.msg){
              console.log("error", d)
              this.$emit("onError", d)
            }else{
              this.vodSrc = t[0]
              this.$nextTick(()=>{
                this.vodContext = uni.createVideoContext("plvVodPlayer", this)
                this.$emit('onVodContextChange',{
                  videoContext:this.vodContext
                })
              })
            } 
        }
      });
    },
    seek(e) {
      "vod" === this.mode && this.vodContext.seek(e);
    },
    onVodTimeUpdate(e) {
      this.$emit("onVodTimeUpdate", e),
        Polyv.timeUpdate(e);
    },
    onVodPlay(e) {
      this.$emit("onVodPlay", e)
    },
    onVodPause(e) {
      this.$emit("onVodPause", e)
    },
    onVodWaiting() {},
    onVodEnded(e) {
      this.$emit("onVodEnd", e);
    },
    onVodError() {},
    onLiveVodEnded() {
      this.$emit("onLiveVodEnd", { curVodVid: this.videoSrc });
    },
    onLiveStorageProgress(e) {
      this.$emit("onLiveStorageProgress", e.detail);
    },
    onLiveStatusChange(e) {
      this.$emit("onLiveStatusChange", e.detail);
    }
  }
}
</script>
<style scoped>
.plv-player,
.plv-player-live,
.plv-player-live__player {
  width: 100%;
  height: 100%;
}
.plv-player-live__player__tips {
  position: absolute;
  bottom: 20rpx;
  left: 10rpx;
  font-size: 14px;
}
.plv-player-vod {
  width: 100%;
  display: none;
}
video {
  width: 100%;
}
.plv-mp-vod-player-box,
.plv-mp-vod-player-box-video {
  width: 100%;
  height: 100%;
}
</style>