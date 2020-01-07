<template>
  <div>
    <!--头部-->
    <div class="header">
      <div class="header-logo">
        <img src="@/assets/logo-icon.png" />
      </div>
      <div class="header-left" v-if="isTeacher">
        <div class="header-left__btn" @click="setLiveState" v-if="liveState == 1">结束直播</div>
        <div class="header-left__btn header-left__btn--start" @click="setLiveState" v-else>开始直播</div>
        <div class="header-left__text">{{studentList.length}}人进入</div>
        <div class="header-left__staus" v-if="liveState == 1">直播中</div>
        <div class="header-left__staus unstaus" v-else>未开始</div>
      </div>
      <div class="header-left" style="left:160px;top:10px;" v-else>
        <div class="header-left__staus" v-if="liveState == 1">正在直播中</div>
        <div class="header-left__staus unstaus" v-else>直播未开始</div>
      </div>
      <div class="header-icon-menu" v-if="isAlreadyLogged === 1">
        <span @click="phonePreview">
          <i class="iconfont icon-shouji"></i>
        </span>
        <span @click="$stop($event);settingFlag = !settingFlag" v-if="isTeacher">
          <i class="iconfont icon-quanjushezhi"></i>
        </span>
      </div>
      <transition name="fade-up">
        <div class="header-setup-menu" v-show="settingFlag" @click="$stop($event);">
          <ul>
            <!-- <li>
            <span
              class="ks-switch"
              @click="setConfSwitch('upperwall')"
              :class="setting.upperwall && 'ks-switch--on'"
            ></span>
            用户上墙讨论
          </li>
          <li>
            <span
              class="ks-switch"
              @click="setConfSwitch('audio')"
              :class="setting.audio && 'ks-switch--on'"
            ></span>
            用户语音讨论
            </li>-->
            <li>
              <span
                class="ks-switch"
                @click="setConfSwitch('chat')"
                :class="setting.chat && 'ks-switch--on'"
              ></span>
              禁言模式
            </li>
          </ul>
        </div>
      </transition>
      <div class="header-title">{{title}}</div>
    </div>

    <!--主体内容-->
    <div
      class="main ks-row"
      :class="isAdmin && 'main--admin'"
      :style="{height:windowHeight-49+'px'}"
      v-if="isAlreadyLogged === 1"
    >
      <div class="main-aside-bar" v-if="isAdmin">
        <div class="main-aside-bar__tool">
          <span @click="selectServerFile('img')">
            <div class="main-aside-bar__popover">选择图片</div>
            <i class="iconfont icon-tupian"></i>
          </span>
          <span @click="selectServerFile('audio')">
            <div class="main-aside-bar__popover">选择文件</div>
            <i class="iconfont icon-wenjianjia"></i>
          </span>
        </div>
      </div>
      <div class="ks-col-20">
        <instant-chat
          :height="isAdmin ? windowHeight-149 : windowHeight-49"
          :current-time="currentTime"
          :teacherid="teacherInfo.teacherid"
          :page="chatPage"
          :total-page="chatTotalPage"
          :userid="userInfo.userid"
          :chat-data="chatData"
          @withdraw="handleWithdraw"
          @scrollToUpper="chatScrollToUpper"
        />
        <div class="main-send" v-if="isAdmin">
          <div v-if="liveState == 1">
            <div class="main-send__recorder" v-show="recorderBoxVisible">
              <i class="iconfont icon-guanbi" @click="recorderBoxVisible = false"></i>
              <recorder-box @send="sendAudioMsg" />
            </div>
            <div
              class="main-send__audio"
              @click.stop="askRecorder = false;recorderBoxVisible = !recorderBoxVisible"
            >
              <i class="iconfont icon-yuyin"></i>
            </div>
            <div class="main-send__button" @click="sendChatMsg()">发送</div>
            <textarea
              ref="chatTextarea"
              v-model="chatTextareaContent"
              class="main-send__textarea"
              placeholder="请在此输入聊天内容..."
            ></textarea>
          </div>
          <div class="main-send__state" v-else>您未开启直播</div>
        </div>
      </div>
      <div class="ks-col-4">
        <div class="main-teacher">
          <div class="main-teacher__name">{{teacherInfo.name}}</div>
          <div class="ks-image">
            <img :src="teacherInfo.avatar || defaultTeacherAvatar" />
          </div>
        </div>
        <ks-tabs v-model="tabActive" :average="2" style="background:#ecedf1">
          <ks-tab-pane label="在线成员" name="student">
            <online-students
              :height="windowHeight-349"
              :teacherid="teacherInfo.teacherid"
              :students="studentList"
              :banned-list="bannedList"
              :is-teacher="isTeacher"
              @banned="banned"
            />
          </ks-tab-pane>
          <ks-tab-pane :label="'讨论 '+(liveState == 1 ? talkList.length : totalTalkPut)" name="talk">
            <instant-chat
              class="main-talk"
              action="talk"
              :current-time="currentTime"
              :teacherid="teacherInfo.teacherid"
              :userid="userInfo.userid"
              :height="windowHeight-429"
              :chat-data="talkList"
              :page="talkPage"
              :total-page="talkTotalPage"
              @reply-selected="handleReplySelected"
              @withdraw="handleWithdraw"
              @scrollToUpper="talkScrollToUpper"
            />
            <div class="main-talk-sendbox" @click="$stop($event)">
              <textarea
                ref="talkTextArea"
                :disabled="getIsBanned(this.userInfo.userid) || (setting.chat && !isAdmin)"
                :placeholder="(getIsBanned(this.userInfo.userid) && '你已被管理员禁言') || ((setting.chat && !isAdmin) && '当前为禁言状态，只允许管理员可发言') || talkTextAreaPlace"
                class="main-talk-sendbox__textarea"
                v-model="talkTextAreaContent"
              ></textarea>
              <div
                class="main-talk-sendbox__btn main-talk-sendbox__btn--disabled"
                v-if="getIsBanned(this.userInfo.userid) || (setting.chat && !isAdmin)"
              >发送</div>
              <div class="main-talk-sendbox__btn" @click="sendTalkMsg" v-else>发送</div>
            </div>
          </ks-tab-pane>
        </ks-tabs>
      </div>
    </div>
    <login-qrcode v-else-if="isAlreadyLogged === 2" :token="token" :url="qrCodeUrl" />
    <course-box :info="courseInfo" v-else-if="isAlreadyLogged === 3" />
    <sign-form :form-data="formData" v-else-if="isAlreadyLogged === 4" />
  </div>
</template>
<script>
import LoginQrcode from "@/components/LoginQrcode";
import CourseBox from "@/components/CourseBox";
import SignForm from "@/components/SignForm";
import ShareToPhone from "@/components/ShareToPhone";
import InstantChat from "@/components/InstantChat";
import SelectFile from "@/components/select-file";
import RecorderBox from "./RecorderBox";
import OnlineStudents from "@/components/OnlineStudents";
import live_sig from "@/mixins/live.sig";
import live_chat from "@/mixins/live.chat";
import { liveStatus } from "@/api/live";
let MobileQrcode, MobileShortLink;
export default {
  name: "AudioLive",
  components: {
    LoginQrcode,
    CourseBox,
    SignForm,
    InstantChat,
    OnlineStudents,
    RecorderBox
  },
  mixins: [live_sig, live_chat],
  data() {
    return {
      /**登录状态 1已登录 2未登录 3未购买 4未填写报名表单*/
      isAlreadyLogged: 0,
      /**扫码登录的二维码地址 */
      qrCodeUrl: "",
      /**登录验证token */
      token: "",
      /**报名表单 */
      formData: [],
      /**直播间标题 */
      title: "",
      /**老师默认头像 */
      defaultTeacherAvatar: require("@/kesion-ui/image/default-avatar.jpg"),
      /**直播间设置窗口开关 */
      settingFlag: false,
      /**显示区域高度 */
      windowHeight: window.innerHeight,
      /**显示聊天区域的录音窗口 */
      recorderBoxVisible: false,
      /**选项卡选中值 */
      tabActive: "student",
      /**显示问答的录音操作区域 */
      askRecorder: false,
      /**聊天文本区域内容 */
      chatTextareaContent: ""
    };
  },
  mounted() {
    this.getSigKeyInfo();
    document.addEventListener("click", () => {
      this.settingFlag = false;
    });
  },
  methods: {
    /**
     * key获取成功回调
     */
    onGetKeySuccesed(res) {
      this.getChatData(res.userid);
      this.getTalkData();
      this.MobileQrcode = res.qrcode;
      this.MobileShortLink = res.qrcode_shortchain;
      this.isAlreadyLogged = 1;
    },
    /**
     * 获取key失败回调
     */
    onGetKeyError(res) {
      if (res.code === "qrcode") {
        this.isAlreadyLogged = 2;
        this.qrCodeUrl = res.url;
        this.token = res.token;
      } else if (res.code === "unbuy") {
        this.isAlreadyLogged = 3;
        this.qrCodeUrl = res.url;
        this.courseInfo = {
          title: res.course_title,
          defaultpic: res.defaultpic,
          price: res.price,
          qrcode: res.url,
          content: res.content
        };
      } else if (res.code === "signform") {
        this.isAlreadyLogged = 4;
        res.form.map(item => {
          if (item.type === "checkbox") {
            item.value = [];
          } else {
            item.value = "";
          }
        });
        this.formData = res.form;
      } else {
        this.$layer.msg(res.msg);
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
     * 修改直播状态
     */
    setLiveState() {
      let _liveState = this.liveState == 1 ? 0 : 1;
      liveStatus({
        courseid: this.$route.query.id,
        chapterid: this.$route.query.chapterid,
        status: _liveState
      }).then(res => {
        if (res.result === "success") {
          this.sendSigMsg({
            action: "liveState",
            data: {
              value: _liveState
            }
          });
        } else {
          this.$layer.msg(res.msg);
        }
      });
    },
    /**
     * 分享到手机
     */
    phonePreview() {
      if (this.MobileQrcode && this.MobileShortLink) {
        this.$layer.iframe({
          content: {
            content: ShareToPhone,
            parent: this,
            data: {
              code: this.MobileQrcode,
              link: this.MobileShortLink
            }
          },
          area: ["640px", "320px"],
          title: "分享到手机"
        });
      }
    },
    /**
     * 选择文件回调
     * @param {Array}  选择的文件数组
     * @param {String} 文件类别
     */
    selectServerCall(selectedItem, fileType) {
      let item = selectedItem[0];
      if (item) {
        if (fileType === "audio") {
          let audio = document.createElement("audio");
          audio.src = item.file_path;
          audio.onloadeddata = e => {
            this.addChatMsg("chat", {
              msg: item.file_path,
              msg_type: fileType,
              audio_time: Math.floor(audio.duration)
            });
          };
          audio.onerror = e => {
            this.$layer.msg("音频地址无效");
          };
        } else {
          this.addChatMsg("chat", {
            msg_type: fileType,
            msg: item.file_path
          });
        }
      }
      this.$layer.closeAll();
    },
    /**
     * 选择文件
     * @param {String} 文件类别
     */
    selectServerFile(_fileType) {
      this.$layer.iframe({
        content: {
          content: SelectFile, //传递的组件对象
          parent: this, //当前的vue对象
          data: {
            fileType: _fileType,
            courseid: this.$route.query.id
          }
        },
        area: ["900px", "600px"],
        title:
          (_fileType == "img" && "选择图片") ||
          (_fileType == "audio" && "选择音频")
      });
    },

    /**
     * 发送聊天消息
     */
    sendChatMsg() {
      if (!this.chatTextareaContent) {
        this.$layer.msg("请先输入聊天内容");
        this.$refs.chatTextarea.focus();
        return;
      }
      this.addChatMsg("chat", {
        msg_type: "text",
        msg: this.chatTextareaContent
      }).then(() => {
        this.chatTextareaContent = "";
      });
    },

    /**
     * 发送音频消息
     * @param {String} 音频地址
     */
    sendAudioMsg(src) {
      this.recorderBoxVisible = false;
      let audio = document.createElement("audio");
      audio.src = src;
      audio.onloadeddata = e => {
        this.addChatMsg("chat", {
          msg: src,
          msg_type: "audio",
          audio_time: Math.floor(audio.duration)
        });
      };
      audio.onerror = e => {
        this.$layer.msg("音频地址无效");
      };
    }
  }
};
</script>
<style scoped>
/*头部*/
.header {
  height: 49px;
  background: #fff;
  color: #333;
  box-shadow: 0 2px 16px rgba(0, 0, 0, 0.07);
  position: relative;
  z-index: 9;
}
.header-logo {
  width: 44px;
  background: #4687fa;
  position: absolute;
  left: 0;
  text-align: center;
  height: 49px;
  top: 0;
}
.header-logo img {
  height: 23px;
  position: relative;
  top: 13px;
}
.header-left {
  position: absolute;
  left: 260px;
  top: 5px;
  width: 200px;
  padding-left: 150px;
}
.header-left__btn {
  width: 130px;
  height: 40px;
  background: #e6412d;
  color: #fff;
  text-align: center;
  border-radius: 4px;
  line-height: 40px;
  position: absolute;
  left: 0;
  top: 0;
  font-size: 14px;
  cursor: pointer;
}
.header-left__btn--start {
  background: #4687fa;
}
.header-left__text {
  font-size: 14px;
  line-height: 18px;
}
.header-left__staus {
  font-size: 14px;
  color: #e6412d;
  position: relative;
  padding-left: 12px;
}
.header-left__staus::before {
  content: "";
  width: 6px;
  height: 6px;
  background: #e6412d;
  border-radius: 50%;
  position: absolute;
  left: 0;
  top: 50%;
  margin-top: -3px;
}
.header-left__staus.unstaus {
  color: #37a7ed;
}
.header-left__staus.unstaus::before {
  background: #37a7ed;
}
.header-title {
  line-height: 49px;
  text-align: center;
  font-size: 16px;
}
.header-icon-menu {
  position: absolute;
  right: 20px;
  top: 0;
  line-height: 49px;
}
.header-icon-menu span {
  width: 49px;
  height: 49px;
  cursor: pointer;
  float: left;
  text-align: center;
}
.header-icon-menu i {
  font-size: 22px;
}

.header-setup-menu {
  width: 290px;
  position: absolute;
  right: 10px;
  top: 49px;
  z-index: 9;
  background: #fff;
  border-radius: 4px;
  box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
  font-size: 14px;
  padding-left: 15px;
}
.header-setup-menu li {
  height: 44px;
  line-height: 44px;
  overflow: hidden;
  color: #2a343e;
  padding-right: 15px;
  border-top: 1px solid #eee;
}
.header-setup-menu li:first-child {
  border-top: 0px;
}
.header-setup-menu li .ks-switch {
  float: right;
  margin-top: 10px;
}

/*主体内容*/
.main {
  position: relative;
}
.main--admin {
  padding-left: 44px;
}
/*消息发送区域*/
.main-send {
  height: 100px;
  position: relative;
  background: #fff;
}
.main-send__state {
  text-align: center;
  line-height: 100px;
  font-size: 16px;
  color: #aaa;
  z-index: 9;
}
.main-send__audio {
  width: 36px;
  text-align: center;
  position: absolute;
  right: 140px;
  top: 50%;
  height: 36px;
  line-height: 36px;
  margin-top: -18px;
  cursor: pointer;
  color: #808796;
  border: 1px solid #eee;
  border-radius: 4px;
}
.main-send__audio i {
  font-size: 22px;
}
.main-send__textarea {
  width: 100%;
  height: 100px;
  border: 0px;
  box-sizing: border-box;
  padding: 20px 150px 20px 20px;
  font-size: 14px;
}
.main-send__button {
  width: 82px;
  height: 36px;
  background: #4687fa;
  color: #fff;
  position: absolute;
  right: 20px;
  top: 50%;
  margin-top: -18px;
  text-align: center;
  font-size: 14px;
  line-height: 36px;
  cursor: pointer;
  border-radius: 4px;
}
.main-send__recorder {
  width: 340px;
  position: absolute;
  top: -210px;
  right: 10px;
  background: #fff;
  box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}
.main-send__recorder .icon-guanbi {
  position: absolute;
  right: 0;
  top: 0;
  width: 44px;
  height: 44px;
  line-height: 44px;
  text-align: center;
  color: #666f7f;
  cursor: pointer;
}
.main-send__recorder .icon-guanbi:hover {
  color: #4687fa;
}

.main-aside-bar {
  width: 44px;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  background: #373f4e;
  z-index: 9;
}
.main-aside-bar__tool {
  top: 50%;
  position: absolute;
  width: 100%;
  left: 0;
  top: 50%;
  margin-top: -105px;
}
.main-aside-bar__tool span {
  width: 44px;
  height: 44px;
  display: block;
  text-align: center;
  line-height: 44px;
  cursor: pointer;
  color: #fff;
  position: relative;
}
.main-aside-bar__tool span:hover {
  background: #1f242a;
}
.main-aside-bar__tool span i {
  font-size: 24px;
}
.main-aside-bar__popover {
  position: absolute;
  display: none;
  left: 54px;
  height: 22px;
  background: rgba(0, 0, 0, 0.6);
  color: #fff;
  text-align: center;
  line-height: 22px;
  width: 80px;
  top: 50%;
  border-radius: 4px;
  margin-top: -11px;
}
.main-aside-bar__tool span:hover .main-aside-bar__popover {
  display: block;
}

.main-teacher {
  height: 260px;
  overflow: hidden;
  position: relative;
}
.main-teacher .ks-image {
  height: 100%;
}
.main-teacher__name {
  position: absolute;
  width: 100%;
  box-sizing: border-box;
  height: 24px;
  line-height: 24px;
  background: rgba(0, 0, 0, 0.6);
  bottom: 0;
  left: 0;
  color: #fff;
  padding: 0 15px;
}

.main .main-talk {
  background: none;
  padding: 15px;
}
.main-talk-sendbox {
  position: relative;
  margin: 0 10px;
  height: 80px;
  overflow: hidden;
}
.main-talk-sendbox__textarea {
  width: 100%;
  height: 70px;
  box-sizing: border-box;
  background: none;
  border: 0px;
  padding: 10px 90px 10px 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  background: #fff;
  font-size: 14px;
  line-height: 18px;
}

.main-talk-sendbox__textarea:focus {
  border: 1px solid #80a8ef;
}
.main-talk-sendbox__btn {
  width: 70px;
  border-left: 1px solid #e9e9e9;
  height: 50px;
  position: absolute;
  right: 0;
  top: 10px;
  font-size: 14px;
  text-align: center;
  line-height: 50px;
  color: #595959;
  cursor: pointer;
}
.main-talk-sendbox__btn:hover {
  color: #4687fa;
}
.main-talk-sendbox__btn--disabled,
.main-talk-sendbox__btn--disabled:hover {
  color: #a9a9a9;
  cursor: no-drop;
}
</style>

