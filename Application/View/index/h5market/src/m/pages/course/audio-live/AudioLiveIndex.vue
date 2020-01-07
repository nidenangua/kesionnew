<template>
  <div class="audio-live">
    <!-- @touchmove.prevent -->
    <div ref="courseCover" v-show="isShowCourseCover">
      <ks-image :src="courseCover" class="audio-live-cover" />
    </div>
    <div v-if="step === 1">
      <sign-form :form-data="formData" />
    </div>
    <div v-if="step === 2">
      <div class="audio-live-header line">
        <div
          class="audio-live-header__packup"
          @touchstart="isShowCourseCover = !isShowCourseCover"
        >{{isShowCourseCover ? '收起' : '展开'}}</div>
        {{liveState == 1 ? Math.ceil(signUpCount/2) + studentList.length+'人在线' : signUpCount+'人次'}}
        <span
          class="ks-color-success"
          v-if="liveState == 1"
        >正在直播</span>
        <span class="ks-color-success" v-else>{{getSatrtTime(begindate,enddate)}}</span>
      </div>
      <div class="audio-live-reward" @click="admireFlag = true">
        <span>赏</span>
      </div>
      <audio-live-chat
        :height="isShowCourseCover ? windowHeight-courseCoverHeight-44-49 : windowHeight-44-49"
        :current-time="currentTime"
        :teacherid="teacherInfo.teacherid"
        :userid="userInfo.userid"
        :chat-data="chatData"
        :page="chatPage"
        :total-page="chatTotalPage"
        @withdraw="handleWithdraw"
        @scrollToUpper="chatScrollToUpper"
      />
      <transition name="fade">
        <div class="audio-live-talk-mask" v-show="talkVisible"></div>
      </transition>
      <transition name="fade-down">
        <div class="audio-live-talk" v-show="talkVisible">
          <div class="audio-live-talk__title line">
            <div class="audio-live-talk__packup" @touchstart="hideTalkBox">
              <i class="ks-icon ks-icon-arrow-ios-downward-outline"></i>收起
            </div>
            讨论（{{liveState == 1 ? talkList.length : totalTalkPut}}）
          </div>
          <audio-live-chat
            class="audio-live-talk__body"
            action="talk"
            :current-time="currentTime"
            :teacherid="teacherInfo.teacherid"
            :userid="userInfo.userid"
            :height="windowHeight-64-49"
            :chat-data="talkList"
            :page="talkPage"
            :total-page="talkTotalPage"
            @reply-selected="handleReplySelected"
            @withdraw="handleWithdraw"
            @scrollToUpper="talkScrollToUpper"
          />
        </div>
      </transition>
      <!--弹幕-->
      <audio-live-bullet
        :current-time="currentTime"
        :bullet-list="latestTalkList"
        :visible="bulletScreenSwitch"
      />
      <!--弹幕结束-->
      <div class="audio-live-btns">
        <div
          class="audio-live-btn"
          :class="!bulletScreenSwitch && 'audio-live-btn--forbid'"
          @touchstart="bulletScreenSwitch = !bulletScreenSwitch"
        >弹</div>
        <div class="audio-live-btn" @touchstart="showTalkBox">讨论</div>
      </div>
      <div class="audio-live-footer line line-top" @touchstart.stop>
        <div class="audio-live-footer__input">
          <!-- <div class="audio-live-footer__ask">
            <i></i>提问
          </div>-->
          <input
            ref="talkTextArea"
            :disabled="getIsBanned(this.userInfo.userid) || (setting.chat && !isAdmin)"
            :placeholder="(getIsBanned(this.userInfo.userid) && '你已被管理员禁言') || ((setting.chat && !isAdmin) && '当前为禁言状态，只允许管理员可发言') || talkTextAreaPlace"
            v-model="talkTextAreaContent"
            @focus="onTalkTextFocus"
            @blur="onTalkTextBlur"
          />
        </div>
        <div
          class="audio-live-footer__send audio-live-footer__send--disabled"
          v-if="getIsBanned(this.userInfo.userid) || (setting.chat && !isAdmin)"
        >发送</div>
        <div
          class="audio-live-footer__send"
          @touchstart="sendTalkMsg"
          v-else
        >{{sending ? '发送中...' : '发送'}}</div>
      </div>
      <ks-dialog title="打赏" :visible.sync="admireFlag">
        <reward-select type="courseReward" :info-id="$route.query.id" />
      </ks-dialog>
    </div>
  </div>
</template>
<script>
/**登录信令部分代码 */
import live_sig from "@/mixins/live.sig";
/**与home端共用的音频直播部分代码 */
import live_chat from "@/mixins/live.chat";
/**报名表单 */
import SignForm from "../components/SignForm";
/**聊天组件 */
import AudioLiveChat from "./AudioLiveChat";
/**弹幕组件 */
import AudioLiveBullet from "./AudioLiveBullet";
/**打赏组件 */
import RewardSelect from "../components/RewardSelect";
export default {
  /**音频直播 */
  name: "AudioLive",
  components: {
    SignForm,
    AudioLiveChat,
    AudioLiveBullet,
    RewardSelect
  },
  mixins: [live_sig, live_chat],
  data() {
    return {
      /**步骤 1填写报名 2进入直播 */
      step: 0,
      /**报名表单 */
      formData: [],
      /**课程封面 */
      courseCover: "",
      /**课程封面高度 */
      courseCoverHeight: 0,
      /**是否显示课程封面 */
      isShowCourseCover: true,
      /**显示区域高度 */
      windowHeight: window.innerHeight,
      /**显示讨论区域 */
      talkVisible: false,
      /**弹幕开关 */
      bulletScreenSwitch: true,
      /**最新的讨论记录（前三） */
      latestTalkList: [],
      /**报名人数 */
      signUpCount: 0,
      /**打赏开关 */
      admireFlag: false,
      /**开始时间 */
      begindate: 0,
      /**结束时间 */
      enddate: 0
    };
  },
  watch: {
    talkList: {
      handler() {
        this.updateLatestTalk();
      },
      deep: true
    }
  },
  activated() {
    this.getSigKeyInfo();
    this.courseCoverHeight = this.$refs.courseCover.offsetHeight;
  },
  deactivated() {
    this.resetSigKeyInfo();
    this.resetChatData();
  },
  methods: {
    /**
     * 获取直播key成功后回调
     */
    onGetKeySuccesed(res) {
      this.courseCover = res.defaultpic;
      this.signUpCount = res.studentcount;
      this.begindate = Number(res.begindate);
      this.enddate = Number(res.enddate);
      this.step = 2;
      this.getChatData(res.userid);
      this.getTalkData();
      /**配置微信分享 */
      this.$wxShare({
        title: res.course_title,
        desc: "这门课程不错，邀请你来看看~",
        imgUrl: res.defaultpic
      });
    },
    /**
     * 获取key失败回调
     */
    onGetKeyError(res) {
      switch (res.code) {
        case "qrcode":
          this.$toast("请先登录").then(() => {
            this.$router.push({
              name: "UserLogin"
            });
          });
          break;
        case "unbuy":
          this.$toast(res.msg).then(() => {
            this.$router.push({
              name: "CourseView",
              params: {
                id: this.$route.query.id
              }
            });
          });
          break;
        case "signform":
          this.courseCover = res.defaultpic;
          this.step = 1;
          res.form.map(item => {
            if (item.type === "checkbox") {
              item.value = [];
            } else {
              item.value = "";
            }
          });
          this.formData = res.form;
          break;
      }
    },
    /**
     * 加入聊天频道成功
     * @param {String} 当前用户id（系统信令id）
     * @param {String} 当前用户id（系统用户id）
     */
    onChannelJoined(account, uid) {
      if (this.$route.query.ordersn) {
        this.sendReward(this.$route.query.ordersn);
      }
    },
    /**
     * 接收到频道消息
     * @param {String} 发送者的用户id（信令id）
     * @param {String} 发送者的用户id（系统用户id）
     * @param {Object} 返回的消息，已转为json类型
     */
    onMessageChannelReceive(account, uid, msg) {
      switch (msg.action) {
        /**聊天讨论相关的消息 */
        case "chat":
        case "talk":
        case "withdraw":
          this.handleReceiveChatMsg(msg);
          break;
        case "liveState":
          this.liveState = msg.data.value;
          break;
        case "setting":
          this.setting = msg.data;
          break;
      }
    },
    /**
     * 更新最新的三条消息
     */
    updateLatestTalk() {
      let latestTalk = this.talkList.filter((item, i) => {
        if (i >= this.talkList.length - 3 && item.content.msg_type !== "tips") {
          return item;
        }
      });
      this.latestTalkList = latestTalk;
    },
    /**
     * 显示讨论区域
     */
    showTalkBox() {
      this.talkVisible = true;
    },
    /**
     * 关闭讨论区域
     */
    hideTalkBox() {
      this.talkVisible = false;
    },
    /**
     * 讨论区域焦点事件,兼容微信浏览器焦点事件离开后页面位置错位问题
     */
    onTalkTextFocus() {
      this.WINDOW_TOP = document.body.scrollTop;
    },
    /**
     * 讨论区域焦点离开,兼容微信浏览器焦点事件离开后页面位置错位问题
     */
    onTalkTextBlur() {
      window.scrollTo(0, this.WINDOW_TOP);
    },
    /**
     * 获取开始时间
     */
    getSatrtTime(begindate, enddate) {
      if (this.currentTime > 0) {
        if (this.currentTime > enddate) {
          return "直播已结束";
        } else {
          let time = begindate - this.currentTime;
          if (time > 0) {
            let day = Math.floor(time / 86400);
            if (day > 0) {
              if (day < 30) {
                return `倒计时 ${day}天后`;
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
                return `倒计时 ${hour}小时后`;
              } else {
                let minute = Math.floor(time / 60);
                if (minute > 0) {
                  return `倒计时 ${minute}分钟后`;
                } else {
                  return `倒计时 ${time}秒后`;
                }
              }
            }
          } else {
            return "直播即将开始";
          }
        }
      }
    }
  }
};
</script>
<style scoped>
.audio-live-cover {
  height: 10.54rem;
}
.audio-live-reward {
  width: 30px;
  height: 22px;
  background: #fff;
  padding: 5px;
  background: #fff;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
  position: fixed;
  right: 0;
  top: 50%;
  margin-top: -18px;
  border-radius: 30px 0 0 30px;
  z-index: 9;
}
.audio-live-reward span {
  width: 22px;
  height: 22px;
  font-size: 14px;
  border-radius: 50%;
  display: block;
  background: #f5c717;
  text-align: center;
  line-height: 22px;
  color: #fff;
}
/*头部*/
.audio-live-header {
  height: 44px;
  line-height: 44px;
  background: #fff;
  text-align: center;
  font-weight: bold;
  color: #818996;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
  position: relative;
}
.audio-live-header span {
  position: relative;
  margin-left: 15px;
}
.audio-live-header span::after {
  content: "";
  width: 4px;
  height: 4px;
  background: #72c14b;
  position: absolute;
  left: -10px;
  top: 50%;
  margin-top: -3px;
  border-radius: 50%;
}

.audio-live-header__packup {
  position: absolute;
  right: 0;
  top: 50%;
  line-height: 22px;
  height: 22px;
  border: 1px solid #ddd;
  border-right: 0px;
  padding: 0 10px;
  border-radius: 22px 0 0 22px;
  margin-top: -11px;
}

/*弹幕、讨论按钮*/
.audio-live-btns {
  position: fixed;
  right: 0;
  bottom: 58px;
}
.audio-live-btn {
  width: 36px;
  height: 36px;
  position: relative;
  border: 1px solid #72c14b;
  box-sizing: border-box;
  float: left;
  border-radius: 50%;
  font-size: 13px;
  color: #72c14b;
  background: #fff;
  margin-right: 10px;
  text-align: center;
  line-height: 36px;
  box-shadow: 0 1px 4px rgba(175, 220, 152, 0.6);
}
.audio-live-btn--forbid::after {
  content: "";
  width: 100%;
  height: 1px;
  background: #72c14b;
  position: absolute;
  left: 0;
  top: 50%;
  transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
  -o-transform: rotate(45deg);
}
/*底部*/
.audio-live-footer {
  height: 49px;
  background: #fff;
  box-sizing: border-box;
  position: fixed;
  width: 100%;
  left: 0;
  bottom: 0;
  padding: 7px;
  box-sizing: border-box;
  display: flex;
  z-index: 9;
}
.audio-live-footer__input {
  height: 35px;
  line-height: 35px;
  background: #f6f6f6;
  border: 0px;
  border-radius: 4px;
  padding: 0 10px;
  width: 100%;
  box-sizing: border-box;
  position: relative;
}
.audio-live-footer__input input {
  width: 100%;
  border: 0px;
  background: none;
  height: 100%;
  font-size: 14px;
}
.audio-live-footer__ask {
  position: absolute;
  right: 10px;
  top: 0;
  color: #999;
}
.audio-live-footer__ask i {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  border: 1px solid #c9c9c9;
  float: left;
  margin: 10px 5px 0 0;
}
.audio-live-footer__icon {
  width: 45px;
  text-align: center;
  line-height: 35px;
  color: #a9a9a9;
}
.audio-live-footer__icon i {
  font-size: 24px;
  display: block;
}
.audio-live-footer__send {
  width: 70px;
  text-align: center;
  border-radius: 4px;
  height: 35px;
  line-height: 35px;
  background: #72c14b;
  color: #fff;
  margin-left: 15px;
}
.audio-live-footer__send--disabled {
  cursor: no-drop;
  opacity: 0.6;
}
/**讨论区域*/
.audio-live-talk-mask {
  width: 100%;
  height: 100%;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 8;
  background: rgba(0, 0, 0, 0.6);
}
.audio-live-talk {
  position: fixed;
  bottom: 49px;
  width: 100%;
  left: 0;
  z-index: 9;
  background: #fff;
}
.audio-live-talk__title {
  height: 44px;
  line-height: 44px;
  text-align: center;
  position: relative;
  font-size: 16px;
}
.audio-live-talk__packup {
  width: 44px;
  height: 44px;
  line-height: 44px;
  position: absolute;
  left: 15px;
  top: 0;
  font-size: 14px;
}
</style>
