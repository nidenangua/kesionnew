<template>
  <view class="plv-player-live">
    <!-- 播放限制 -->
    <cover-view v-if="!canWatch" class="plv-player-live__canot__watch">
      <cover-image src="https://livestatic.videocc.net/v_84/assets/wimages/icon.png"></cover-image>
      <cover-view>当前直播无法播放</cover-view>
      <cover-view>请刷新重试或向管理员反馈{{ errorCode }}</cover-view>
    </cover-view>
    <!-- 直播播放 当forceVideo为true则强制使用video组件直播 -->
    <live-player
      v-if="liveMode === 1 && !forceVideo"
      class="plv-player-live__player plv-player-live__player__live"
      id="plvLivePlayer"
      :src="videoSrc"
      min-cache="1"
      max-cache="1"
      autoplay="true"
      @statechange="onStateChange"
    >
      <cover-view v-if="isBrokenNet" class="plv-player-live__player__tips">{{ networkTips }}</cover-view>
    </live-player>
    <!-- 暂存|回放列表| 暖场视频 -->
    <video
      v-else-if="liveMode === 2 || (liveMode !== 0 && forceVideo)"
      class="plv-player-live__player plv-player-live__player__vod"
      id="plvLiveVodPlayer"
      :src="videoSrc"
	  :show-progress="false"
	  :enable-progress-gesture="false"
      :loop="isWarm"
      autoplay
      @ended="onLiveVodEnded"
      @error="onLiveVodError"
      @timeupdate="onLiveTimeUpdate"
    />
    <!-- 暖场图片 | 当前暂无直播 -->
    <image
      v-else
      :src="imgSrc"
      class="plv-player-live__player plv-player-live__player__image"
      mode="aspectFill"
    />
  </view>
</template>
<script>
import PolyvLive from "../../common/player/polyvlive.min";
export default {
  props: {
    videoOption: {
      type: Object
    },
    skin: {
      type: String,
      default: "black"
    }
  },
  watch: {
    videoOption: {
      handler(e) {
        this._setData(e);
        2 === e.liveMode ? (this.isVod = !0) : (this.isVod = !1), this.init();
      },
      deep: true,
      immediate:true
    }
  },
  data(){
    return {
      liveMode: 1,
      videoSrc: "",
      isVod: !1,
      statistics: {},
      plvLiveType: "live",
      loop: !1,
      isWarm: !1,
      isAutoChange: !1,
      forceVideo: 1,
      isOffNetwork: !1,
      isOffLive: !1,
      isBrokenNet: !1,
      networkTips: "网络异常，请退出后重试",
      canWatch: !0,
      imgSrc: ""
    }
  },
  mounted() {
    this.liveVideoContext = uni.createLivePlayerContext("plvLivePlayer", this);
    this.liveVodVideoContext = uni.createVideoContext("plvLiveVodPlayer", this);
  },
  destroyed() {
    this.polyvLive && this.polyvLive.destroy();
  },
  methods: {
    init() {
      /**如果存在PolyvLive实例则先销毁再创建 */
      this.polyvLive && this.polyvLive.destroy && this.polyvLive.destroy(),
        (this.polyvLive = new PolyvLive()),
        this.initLiveType(),
        this.initLivePlayer();
    },
    _setData(data) {
      let keys = Object.keys(data);
      keys.map(k => {
        this[k] = data[k];
      });
    },
    initLivePlayer() {
      let e = this.uid,
          t = this.cid,
          i = this.statistics,
          s = this.isOffNetwork,
          o = this.forceVideo,
          a = this.skin,
          r = this.isVod,
          v = this.vodsrc,
          d = "white" === a;
      this.polyvLive.getVideo({
        uid: e,
        vid: t,
        isSkinWhite: d,
        statistics: i,
        vodsrc: r ? v : "",
        success: e => {
          if (e.errorCode)
            return void this._setData({ canWatch: !1, errorCode: e.errorCode });
          if (1 !== this.liveMode) return;
          const t = o ? e.src : e.flvSrc;
          this.setVideoSrc(t);
        },
        onChangeType: (e, t, i) => {
          let s = this.liveMode,
            o = this.videoSrc,
            a = this.forceVideo;
          ("live" === e && 1 === s) ||
            (this._setData({ plvLiveType: e }), this.setLiveType(e, t));
        },
        onNetWorkChange: e => {
          s !== e && this._setData({ isOffNetwork: e }), this.showNetWorkTips();
        },
        onApiStatus: e => {
          this.$emit("onLiveStatusChange", { status: e });
        }
      });
    },
    initLiveType() {
      this.liveType = new Map([
        [
          "live",
          e => {
            this.setLiveMode(1), this.setVideoSrc(e);
          }
        ],
        [
          "warmImage",
          e => {
            this.setLiveMode(0), this.setWarmImg(e);
          }
        ],
        [
          "warmVideo",
          e => {
            this.setLiveMode(2), this.setVideoSrc(e, !0, !1);
          }
        ],
        [
          "vod",
          e => {
            this.setLiveMode(2), this.setVideoSrc(e);
          }
        ],
        ["default", () => {}]
      ]);
    },
    setLiveType(e, t) {
      this.liveType.get(e)(t) || this.liveType.get("default")();
    },
    setLiveMode(e) {
      this.liveMode !== e && this._setData({ liveMode: e });
    },
    setVideoSrc(e, t = !1) {
      this._setData({ videoSrc: e, isWarm: t });
    },
    setWarmImg(e) {
      this._setData({ imgSrc: e });
    },
    onLiveTimeUpdate(e) {
      const t = e.detail.currentTime;
      this.polyvLive.updateTime(t),
        this.$emit("onLiveStorageProgress", { currentTime: t });
    },
    onLiveVodEnded() {
      this.$emit("onLiveVodEnd");
    },
    onLiveVodError() {},
    onStateChange(e) {
      const t = /-2301|-2302/i.test(e.detail.code);
      t &&
        (this.polyvLive.getReconnectSrc(e => {
          this.setVideoSrc(e);
        }),
        this._setData({ isOffLive: t })),
        2005 === e.detail.code &&
          this.isBrokenNet &&
          this._setData({ isBrokenNet: !1 }),
        this.showNetWorkTips();
    },
    showNetWorkTips(e, t) {
      this.isOffNetwork &&
        this.isOffLive &&
        !this.isBrokenNet &&
        this._setData({ isBrokenNet: !0 });
    }
  }
};
</script>
<style scoped>
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
.plv-player-live__canot__watch {
  position: absolute;
  z-index: 1;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  box-sizing: border-box;
  color: #fff;
  background-color: #000;
}
.plv-player-live__canot__watch cover-view {
  line-height: 1.5;
}
.plv-player-live__canot__watch cover-image {
  width: 60px;
  height: 60px;
  margin: 0 auto;
}
</style>