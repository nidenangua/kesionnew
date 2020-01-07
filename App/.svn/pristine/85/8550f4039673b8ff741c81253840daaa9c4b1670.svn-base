<template>
  <div :class="isFullScreen && 'fullScreen'">
    <div class="header" ref="header" v-show="!isFullScreen">
      <div class="header-logo">
        <img src="@/assets/logo-icon.png" />
      </div>
      <div class="header-left" v-if="isTeacher && liveType != 3">
        <div class="header-left__btn" @click="setLiveState" v-if="liveState == 1">结束直播</div>
        <div class="header-left__btn header-left__btn--start" @click="setLiveState" v-else>开始直播</div>
        <div class="header-left__text">{{studentList.length}}人进入</div>
        <div class="header-left__staus" v-if="liveState == 1">直播中，剩余连麦币{{domainbilling}}</div>
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

    <transition name="fade">
      <div class="main-mask" @click="currentPopup = ''" v-show="currentPopup === 'img'"></div>
    </transition>
    <div
      class="ks-row main"
      v-if="isAlreadyLogged === 1"
      :style="{height:windowHeight-($refs.header ? $refs.header.offsetHeight : 0)+'px',paddingLeft:$refs.mainAsideBar && $refs.mainAsideBar.offsetWidth+'px'}"
    >
      <div
        class="main-aside-bar"
        ref="mainAsideBar"
        v-if="liveType != 3 && isAdmin"
        @click="currentPopup = ''"
        v-show="!isFullScreen"
      >
        <div class="main-aside-bar__tool">
          <span
            @click="$stop($event);selectServerFile('img')"
            :class="currentPopup === 'img' && 'active'"
          >
            <div class="main-aside-bar__popover">选择资料</div>
            <i class="iconfont icon-wenjian1"></i>
          </span>
          <!-- <span
            @click="$stop($event);selectServerFile('audio')"
            :class="currentPopup === 'audio' && 'active'"
          >
            <div class="main-aside-bar__popover">选择文件</div>
            <i class="iconfont icon-shipin1"></i>
          </span>-->
        </div>
        <transition name="fade-right">
          <whiteboard-files
            class="main-files"
            v-show="currentPopup === 'img'"
            title="图文材料"
            :selected="selectedCanvasId"
            @item-click="onFileItemClick"
            @click.native="$stop($event);"
            ref="files"
          />
        </transition>
      </div>
      <div class="ks-col-20">
        <div
          class="main-player"
          ref="player"
          :style="{height:windowHeight - ($refs.header ? $refs.header.offsetHeight : 0) +'px'}"
          v-if="liveType == 3"
        ></div>
        <div v-else>
          <div class="main-seats clearfix" ref="mainSeats" v-if="liveType == 2">
            <div class="main-seat-item" v-for="item in audienceList" :key="item.uid">
              <stream-seat
                :audio="item.audio"
                :video="item.video"
                :sid="Number(item.sid)"
                :avatar="defaultAvatar"
                :name="item.uname"
                :leave="item.leave"
                :voice="item.voice"
                :authority="isTeacher"
                :show-media-state="liveType != 3"
                @audio-click="handleAudioChange"
                @video-click="handleVideoChange"
              />
            </div>
          </div>
          <whiteboard
            :selected.sync="selectedCanvasId"
            :canvas-list="canvasList"
            :is-teacher="isTeacher"
            :is-full-screen.sync="isFullScreen"
            :tool-authority="isTeacher"
            :height="windowHeight - ($refs.header ? $refs.header.offsetHeight : 0) - ($refs.mainSeats ? $refs.mainSeats.offsetHeight : 0)"
            @change="onWhiteboardChange"
            @canvasLoaded="onWhiteboardLoaded"
            ref="whiteboard"
          />
        </div>
      </div>
      <div class="ks-col-4">
        
        <div class="main-right-seat" ref="teacherSeat">
          <stream-seat
            :audio="hostConf.audio"
            :video="hostConf.video"
            :sid="Number(hostConf.sid)"
            :avatar="teacherInfo.avatar || defaultAvatar"
            :name="teacherInfo.name"
            :leave="hostConf.leave"
            :voice="hostConf.voice"
            :authority="isTeacher"
            :show-media-state="liveType != 3"
            @audio-click="handleAudioChange"
            @video-click="handleVideoChange"
          />
        </div>
        <div class="main-right-seat" ref="studentSeat" v-if="liveType == 1">
          <stream-seat
            :audio="audienceList[0] ? audienceList[0].audio : 0"
            :video="audienceList[0] ? audienceList[0].video : 0"
            :sid="Number(audienceList[0] ? audienceList[0].sid : 0)"
            :avatar="defaultAvatar"
            :name="audienceList[0] ? audienceList[0].uname : '未加入'"
            :leave="audienceList[0] ? audienceList[0].leave : false"
            :voice="audienceList[0] ? audienceList[0].voice : 0"
            :authority="isTeacher"
            :show-media-state="liveType != 3"
            @audio-click="handleAudioChange"
            @video-click="handleVideoChange"
          />
        </div>

        <!--一对一-->
        <div v-if="liveType == 1">
          <div class="main-talk-title">聊天 （{{liveState == 1 ? talkList.length : totalTalkPut}}）</div>
          <instant-chat
            class="main-talk"
            action="talk"
            :current-time="currentTime"
            :teacherid="teacherInfo.teacherid"
            :userid="userInfo.userid"
            :height="windowHeight - 135 - ($refs.header ? $refs.header.offsetHeight : 0) - ($refs.teacherSeat ? $refs.teacherSeat.offsetHeight : 0) - ($refs.studentSeat ? $refs.studentSeat.offsetHeight : 0) "
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
        </div>

        <!--小班课-->
        <div v-else-if="liveType == 2">
          <ks-tabs v-model="tabActive" :average="2">
            <ks-tab-pane label="在线成员" name="student">
              <online-students
                :height="windowHeight - 40 - ($refs.header ? $refs.header.offsetHeight : 0) - ($refs.teacherSeat ? $refs.teacherSeat.offsetHeight : 0) - ($refs.studentSeat ? $refs.studentSeat.offsetHeight : 0) "
                :teacherid="teacherInfo.teacherid"
                :students="studentList"
                :banned-list="bannedList"
                :is-teacher="isTeacher"
                @banned="banned"
              />
            </ks-tab-pane>
            <ks-tab-pane
              :label="'讨论 '+(liveState == 1 ? talkList.length : totalTalkPut)"
              name="talk"
            >
              <instant-chat
                class="main-talk"
                action="talk"
                :current-time="currentTime"
                :teacherid="teacherInfo.teacherid"
                :userid="userInfo.userid"
                :height="windowHeight - 135 - ($refs.header ? $refs.header.offsetHeight : 0) - ($refs.teacherSeat ? $refs.teacherSeat.offsetHeight : 0) - ($refs.studentSeat ? $refs.studentSeat.offsetHeight : 0) "
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
        <!--千人直播-->
        
        <div v-else-if="liveType == 3">
          <div
            id="polyv-chat"
            :style="{height:polyvChatHeight +'px'}"
          ></div>
        </div>
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
import OnlineStudents from "@/components/OnlineStudents";
import WhiteboardFiles from "./WhiteboardFiles";
import Whiteboard from "./Whiteboard";
import StreamSeat from "./StreamSeat";
import live_sig from "@/mixins/live.sig";
import live_RTC from "@/mixins/live.RTC";
import live_chat from "@/mixins/live.chat";
import { liveStatus, poll, joinLive, pollThousand, getLiveStatus } from "@/api/live";
let mediaPlayer;
let MobileQrcode, MobileShortLink;
export default {
  name: "VideoLive",
  components: {
    LoginQrcode,
    CourseBox,
    SignForm,
    InstantChat,
    OnlineStudents,
    WhiteboardFiles,
    StreamSeat,
    Whiteboard
  },
  mixins: [live_sig, live_RTC, live_chat],
  data() {
    return {
      /**选项卡选中值 */
      tabActive: "student",
      /**登录状态 1已登录 2未登录*/
      isAlreadyLogged: 0,
      /**扫码登录的二维码地址 */
      qrCodeUrl: "",
      /**登录验证token */
      token: "",
      /**课程的基本信息 */
      courseInfo: {},
      polyvChatHeight:0,
      /**窗口高度 */
      windowHeight: window.innerHeight,
      /**当前选择的画布 */
      selectedCanvasId: 0,
      /**画布列表 */
      canvasList: [],
      /**选项卡选中值 */
      tabActive: "student",
      /**媒体 */
      media: {
        selected: 0,
        className: null,
        flag: false,
        list: [
          {
            id: 0,
            name: "不播放媒体"
          }
        ]
      },
      /**直播间设置窗口开关 */
      settingFlag: false,
      /**当前显示的窗口 */
      currentPopup: "",
      /**是否全屏*/
      isFullScreen: false,
      /**默认头像 */
      defaultAvatar: require("../../assets/video-live/seat.png"),
      /**保利威直播的一些参数 */
      polyv: {},
      /**剩余连麦币 */
      domainbilling: 0
    };
  },
  mounted() {
    this.getSigKeyInfo();
    window.addEventListener("resize", e => {
      this.windowHeight = window.innerHeight;
    });
    setInterval(() => {
      /**直播中，老师每5分钟向后端通知当前老师在活动中，如停止发送说明已停止直播或退出直播 */
      if (this.isTeacher && this.liveState == 1) {
        poll({
          courseid: this.$route.query.id,
          chapterid: this.$route.query.chapterid
        }).then(res => {
          //...
        });
      }
      if(this.liveState == 1 && this.liveType == 3){
        pollThousand({
          courseid: this.$route.query.id,
          chapterid: this.$route.query.chapterid,
          userid:this.userInfo.userid
        }).then(res=>{
          //...
        })
      }
    }, 300000);
    
  },
  methods: {
    /**
     * 获取key成功回调
     */
    onGetKeySuccesed(res) {
      if (res.livetype == 3) {
        this.polyv = res.polyv;
      }
      this.isAlreadyLogged = 1;
      MobileQrcode = res.qrcode;
      MobileShortLink = res.qrcode_shortchain;
      this.domainbilling = res.domainbilling || 0;
      /**获取聊天数据 */
      this.getTalkData();
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
     * 更新直播状态
     */
    updateLiveState(){
      getLiveStatus({
        courseid: this.$route.query.id,
        chapterid: this.$route.query.chapterid
      }).then(res=>{
        if(res.result === 'success'){
          this.liveState = res.status
        }
      })
    },
    /**
     * 修改直播状态
     */
    setLiveState() {
      let _status = this.liveState == 1 ? 0 : 1;
      let params = {
        courseid: this.$route.query.id,
        chapterid: this.$route.query.chapterid,
        status: _status
      };
      if (_status == 1) {
        let uids = [];
        this.studentList.map(item => {
          uids.push(item.memberid);
        });
        params.userid = uids;
      }
      liveStatus(params).then(res => {
        if (res.result === "success") {
          this.sendSigMsg({
            action: "liveState",
            data: {
              value: _status
            }
          });
        } else {
          this.$layer.msg(res.msg);
        }
      });
    },
    /**
     * 计算互动推拉流费用
     */
    streamBilling(uid, _type) {
        joinLive({
            courseid: this.$route.query.id,
            chapterid: this.$route.query.chapterid,
            userid: uid,
            type: _type //1进入 2离开
        }).then(res => {
            if (res.result === 'error') {
                this.$layer.msg('计费失败，请尽快联系管理员')
            }
        })
    },
    /**
     * 加入频道成功
     * @param {String} 当前用户id（系统信令id）
     * @param {String} 当前用户id（系统用户id）
     */
    onChannelJoined(account, uid) {
      if (this.isTeacher) {
        /**设置初始白板与白板大小 */
        if (this.liveType != 3) {
          this.$refs.whiteboard.addFile(this.$refs.files.fileList[0]);
        }
      }
      if (this.liveType == 3) {
        this.$nextTick(() => {

          this.polyvChatHeight = window.innerHeight - this.$refs.header.offsetHeight - this.$refs.teacherSeat.offsetHeight;
          
          /**调取保利威直播视频播放器 */
          let player = polyvObject(this.$refs.player).livePlayer({
            width: "100%",
            height: "100%",
            uid: this.polyv.uid,
            vid: this.polyv.vid,
            forceH5: true
          });

          /**增加1秒开关限制，防止多次连续请求 */
          let billingFlag = false;
          let billingEndFlag = false;
          window.s2j_onInitOver = vid => {
            player.on("s2j_onPlay", () => {
              if (!billingFlag) {
                this.updateLiveState();
                billingFlag = true;
                this.streamBilling(this.userInfo.userid, 1);
                setTimeout(() => {
                  billingFlag = false;
                }, 1000);
              }
            });
            player.on("s2j_onPause", () => {
              if (!billingEndFlag) {
                this.updateLiveState();
                billingEndFlag = true;
                this.streamBilling(this.userInfo.userid, 2);
                setTimeout(() => {
                  billingEndFlag = false;
                }, 1000);
              }
            });
          };

          /**调取保利威直播聊天区域 */
          let chatroom = new PolyvChatRoom({
            roomId: this.polyv.vid, //直播房间id
            userId: this.userInfo.userid, //当前用户信息
            nick: this.userInfo.username, //当前用户名
            pic: this.userInfo.avatar, //当前的用户头像
            token: this.polyv.token, //聊天的token令牌
            container: "#polyv-chat",
            width: "100%",
            height: "100%",
            userType: "",
            roomMessage: data => {
              //...
            },
            enableSetNickname: true,
            enableFlower: false,
            enableLike: false,
            tabData: [
              {
                name: "聊天",
                type: "chat"
              },
              {
                name: "在线",
                type: "user-list"
              }
            ]
          });

        });
      } else {
        /**当前正在直播 */
        if (this.liveState == 1) {
          /**一对一，并且当前连麦数大于0，不允许再次加入视频互动 */
          if (this.liveType == 1 && this.audienceList.length > 0) {
            return;
          }
          this.createClient(this.getKeyInfo());
        }
      }
      
    },

    /**
     * 其他用户加入
     * @param {String} 加入者id（系统分配的信令id）
     * @param {String} 加入者id（系统的用户id）
     */
    onChannelUserJoined(account, uid) {
      if (`${account}` === `${this.teacherInfo.teacherid}`) {
        this.$layer.msg("老师进入房间");
      } else {
        /**
         * 监听到学员加入
         * 教师端向新加入学员发送点对点消息，告知当前上课信息
         */
        if (this.isTeacher) {
          /**
           * 发送白板信息
           * 条件：一对一或小班课
           */
          if (this.liveType == 1 || this.liveType == 2) {
            let canvasItem,
              selectedCanvasIdMsg = {};
            this.canvasList.map(item => {
              if (`${item.id}` === `${this.selectedCanvasId}`) {
                canvasItem = item;
              }
            });
            Object.keys(canvasItem).map(key => {
              if (key !== "width" && key !== "height" && key !== "list") {
                selectedCanvasIdMsg[key] = canvasItem[key];
              }
            });
            selectedCanvasIdMsg.action = "whiteboard";
            selectedCanvasIdMsg.type = "selectedCanvasId";
            selectedCanvasIdMsg.canvasId = this.selectedCanvasId;
            this.messageInstantSend(
              account,
              JSON.stringify(selectedCanvasIdMsg)
            );
          }

          /**
           * 当前正在播放视频
           */
          if (this.media.selected > 0 && mediaPlayer) {
            let method =
              mediaPlayer.getStatus() === "pause" ? "pause" : "completeSeek";
            let mediaMsg = {
              action: "media",
              method: method,
              paramData: mediaPlayer.getCurrentTime(),
              vid: mediaPlayer.vid,
              playauth: mediaPlayer.playauth
            };
            this.messageInstantSend(account, JSON.stringify(mediaMsg));
          }
        }
      }
    },
    /**
     * 加入RTC客户端成功
     */
    onChientJoined(account, uid){
      /**发起开始计费 */
      this.streamBilling(uid, 1);
    },

    /**
     * 频道其他用户离开
     * @param {String} 离开者id（信令id）
     * @param {String} 离开者id（系统用户id）
     */
    onChannelUserLeaved(account, uid) {
      if (`${uid}` === `${this.teacherInfo.teacherid}`) {
        /**老师离开，并且当前房间为一对一或小班 */
        if (this.liveType == 1 || this.liveType == 2) {
          /**所有画布重置 */
          this.$refs.whiteboard.clearAllCanvas();
          /**切回主白板 */
          this.selectedCanvasId = 0;
          this.$layer.msg("老师离开了房间");
        }
      }else{
        /**由老师向程序通知 */
        if (this.isTeacher && this.liveState == 1) {
          this.streamBilling(uid, 2)
        }
      }
    },

    /**
     * 接收到点对点消息
     * @param {String} 发送者的用户id（信令id）
     * @param {String} 发送者的用户id（系统用户id）
     * @param {String} 返回的消息，已转成json格式
     */
    onMessageInstantReceive(account, uid, msg) {
      
      switch (msg.action) {
        /**
         * 绘制白板
         * @description 此为白板消息，收到后按消息信息绘制\设置白板
         */
        case "whiteboard":
          this.$refs.whiteboard.drawCanvas(msg);
          break;
        /**
         * 获取画布信息
         * @description 教师才会收到此信息，按此信令返回对应画布信息
         */
        case "getDrawingInfo":
          var drawingRecord = this.$refs.whiteboard.drawingRecord[msg.key];
          if (drawingRecord) {
            drawingRecord.map(record => {
              this.messageInstantSend(account, JSON.stringify(record));
            });
          }
          /**
           * 发送画布位置信息与缩放比例
           */
          let canvasData = this.$refs.whiteboard.getSelectedCanvas(
            msg.key.toString().match(/\d+/)[0]
          );
          let zoomMsg = this.$refs.whiteboard.getWhiteboardBaseMsg(canvasData);
          zoomMsg.type = "zoom";
          zoomMsg.scale = canvasData.canvasItem.scale;
          this.messageInstantSend(account, JSON.stringify(zoomMsg));

          let grabMsg = this.$refs.whiteboard.getWhiteboardBaseMsg(canvasData);
          grabMsg.type = "grab";
          grabMsg.left = canvasData.canvas.x;
          grabMsg.top = canvasData.canvas.y;
          this.messageInstantSend(account, JSON.stringify(grabMsg));
          break;
        case "media":
          this.handleMedia(msg);
          break;
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
        /**开启音频 */
        case "8":
          this.setStreamConf(msg.streamId, true, "audio");
          break;
        /**禁止音频 */
        case "9":
          this.setStreamConf(msg.streamId, false, "audio");
          break;
        /**学员举手 */
        case "20":
          this.streamList.map(item => {
            if (`${item.userid}` === `${msg.memberid}`) {
              item.putUpHands = true;
            }
          });
          break;
        /**学员松开举手 */
        case "21":
          this.streamList.map(item => {
            if (`${item.userid}` === `${msg.memberid}`) {
              item.putUpHands = false;
            }
          });
          break;
        /**开启指定视频流 */
        case "22":
          this.setStreamConf(msg.streamId, true, "video");
          break;

        /**关闭指定视频流 */
        case "23":
          this.setStreamConf(msg.streamId, false, "video");
          break;

        /**接收到白板消息 */
        case "whiteboard":
          /**如果是自己发送到绘图消息，则不接收 */
          if (`${uid}` !== `${this.userInfo.userid}`) {
            this.$refs.whiteboard.drawCanvas(msg);
          }
          break;
        /**白板授权 */
        case "whiteboardAuthorization":
          if (`${msg.authorizedUserId}` === `${this.userInfo.userid}`) {
            msg.flag
              ? this.$layer.msg("老师允许了你使用白板")
              : this.$layer.msg("老师禁止了你使用白板");
            this.whiteboard.toolFlag = msg.flag;
            this.setPageArea();
          }
          this.studentList.map(user => {
            if (`${user.memberid}` === `${msg.authorizedUserId}`) {
              user.whiteboardPermission = msg.flag;
            }
          });
          break;
        /**直播状态切换 */
        case "liveState":
          this.liveState = msg.data.value;
          if (this.liveState == 1) {
            if (this.liveType == 1 && this.audienceList.length > 0) {
              return;
            }
            /**开始上课 */
            this.createClient(this.getKeyInfo());
          } else {
            this.closeClient();
          }
          break;
        /**播放媒体设备 */
        case "media":
          this.handleMedia(msg);
          break;
        /**聊天讨论相关的消息 */
        case "chat":
        case "talk":
        case "withdraw":
          this.handleReceiveChatMsg(msg);
          break;
      }
    },
    /**
     * 音频开关变化
     */
    handleAudioChange(data) {
      if (!data.sid || !this.isTeacher) {
        return;
      }
      if (this.liveState != 1) {
        this.$layer.msg("请先开启直播");
        return;
      }
      if (data.value) {
        this.sendUserMsg(8, {
          streamId: data.sid
        });
      } else {
        this.sendUserMsg(9, {
          streamId: data.sid
        });
      }
    },
    /**
     * 视频开关变化
     */
    handleVideoChange(data) {
      if (!data.sid || !this.isTeacher) {
        return;
      }
      if (this.liveState != 1) {
        this.$layer.msg("请先开启直播");
        return;
      }
      if (data.value) {
        this.sendUserMsg(22, {
          streamId: data.sid
        });
      } else {
        this.sendUserMsg(23, {
          streamId: data.sid
        });
      }
    },
    /**
     * 提示窗口
     */
    alert(msg, title) {
      this.$layer.closeAll();
      this.$layer.alert(msg, {
        title: title || "出错了"
      });
    },
    /**
     * 选择图文材料
     * @param {Object} 图文材料对象
     */
    onFileItemClick(item) {
      this.$refs.whiteboard.addFile(item);
    },
    /**
     * 白板内容变化
     */
    onWhiteboardChange(data) {
      if (this.isTeacher) {
        this.sendSigMsg(data);
      }
    },
    /**
     * 画布加载完成，请求绘图记录(用于学生)
     */
    onWhiteboardLoaded(id) {
      if (!this.isTeacher) {
        this.sendMsgToTeacher({
          action: "getDrawingInfo",
          key: id
        });
      }
    },
    /**
     * 分享到手机
     */
    phonePreview() {
      if (MobileQrcode && MobileShortLink) {
        this.$layer.iframe({
          content: {
            content: ShareToPhone,
            parent: this,
            data: {
              code: MobileQrcode,
              link: MobileShortLink
            }
          },
          area: ["640px", "320px"],
          title: "分享到手机"
        });
      }
    },
    /**
     * 选择资料
     */
    selectServerFile(name) {
      this.currentPopup = name;
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
  background: #d7dbe2;
}
.main-mask {
  width: 100%;
  height: 100%;
  position: fixed;
  left: 0;
  top: 0;
  background: rgba(0, 0, 0, 0.2);
  z-index: 99;
}
.main-files {
  height: 100%;
  position: absolute;
  left: 44px;
  top: 0;
}

.main-aside-bar {
  width: 44px;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  background: #373f4e;
  z-index: 100;
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
.main-aside-bar__tool .active,
.main-aside-bar__tool span:hover {
  background: #2b3038;
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
.main-player {
  width: 100%;
  height: 100%;
  position: relative;
  background: #000;
}
.main-seats {
  background: #fff;
}
.main-seat-item {
  width: 11rem;
  height: 7.5rem;
  float: left;
}

.main-right-seat {
  height: 12rem;
  overflow: hidden;
  position: relative;
}

/*讨论的文本录入框*/
.main-talk-title {
  height: 44px;
  line-height: 44px;
  font-size: 14px;
  padding: 0 20px;
  font-weight: bold;
}
.main .main-talk {
  background: none;
  padding: 0 20px;
}
.main-talk-sendbox {
  position: relative;
  margin: 10px 10px 0 10px;
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
