<template>
  <div class="v-live-index">
    <div v-if="step === 1">
      <ks-image :src="courseCover" class="v-live-cover" />
      <sign-form :form-data="formData" />
    </div>
    <div v-else-if="step === 2">
      <div class="v-live-index__player" ref="player"></div>
      <div id="polyv-chat" :style="{height:polyvChatHeight + 'px'}"></div>
    </div>
  </div>
</template>
<script>
import SignForm from "../components/SignForm";
import { getLiveKey,joinLive,getLiveStatus,pollThousand } from "@/api/live";
let VPolyvObject = null;
let VPolyvChatRoom = null;
export default {
  name: "VLiveIndex",
  components: {
    SignForm
  },
  data() {
    return {
      /**步骤 1填写报名 2进入直播 */
      step: 0,
      /**课程封面 */
      courseCover: "",
      /**报名表单 */
      formData: [],
      /**聊天区域的高度 */
      polyvChatHeight: 0,
      userid:0,
      liveType:0
    };
  },
  mounted(){
    setInterval(()=>{
      if(this.liveState == 1 && this.liveType == 3){
        pollThousand({
          courseid: this.$route.query.id,
          chapterid: this.$route.query.chapterid,
          userid:this.userid
        }).then(res=>{
          //...
        })
      }
    },300000)
    window.onbeforeunload = e=>{
      if(this.liveState == 1){
        this.streamBilling(this.userid, 2);
      }
    }
  },
  activated() {
    
    document.title = "";
    this.liveType = 0;
    this.step = 0;
    this.userid = 0;
    this.$nextTick(() => {
      getLiveKey({
        courseid: this.$route.query.id,
        chapterid: this.$route.query.chapterid
      }).then(res => {
        document.title = res.course_title;
        if (res.result === "success") {
          this.step = 2;
          this.userid = res.userid;
          this.liveType = res.livetype;
          this.$nextTick(() => {
            /**调取保利威直播视频播放器 */
            if (VPolyvObject) {
              this.createPolyvPlayer(res.userid, {
                uid: res.polyv.uid,
                vid: res.polyv.vid
              });
              
            } else {
              let polyvScript = document.createElement("script");
              polyvScript.src = "//player.polyv.net/livescript/liveplayer.js";
              document.body.appendChild(polyvScript);
              polyvScript.onload = () => {
                VPolyvObject = polyvObject;
                this.createPolyvPlayer(res.userid, {
                  uid: res.polyv.uid,
                  vid: res.polyv.vid
                });
              };
            }
            /**调取保利威直播聊天区域 */
            if (VPolyvChatRoom) {
              this.createPolyvChatRoom({
                vid: res.polyv.vid,
                userid: res.userid,
                username: res.username,
                avatar: res.avatar,
                token: res.polyv.token
              });
            } else {
              let polyvChatRoomLink = document.createElement("link");
              polyvChatRoomLink.setAttribute("rel", "stylesheet");
              polyvChatRoomLink.href =
                "//player.polyv.net/jssdk/polyv-chatroom.min.css";
              document.head.appendChild(polyvChatRoomLink);
              polyvChatRoomLink.onload = () => {
                let polyvChatRoomScript = document.createElement("script");
                polyvChatRoomScript.src =
                  "//player.polyv.net/jssdk/polyv-chatroom.min.js";
                document.body.appendChild(polyvChatRoomScript);
                polyvChatRoomScript.onload = () => {
                  VPolyvChatRoom = PolyvChatRoom;
                  this.createPolyvChatRoom({
                    vid: res.polyv.vid,
                    userid: res.userid,
                    username: res.username,
                    avatar: res.avatar,
                    token: res.polyv.token
                  });
                };
              };
            }
          });
        } else {
          switch (res.code) {
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
        }
      });
    });
  },
  methods: {

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
     * 创建保利威直播播放器
     */
    createPolyvPlayer(userid, params) {
      let player = VPolyvObject(this.$refs.player).livePlayer({
        width: "100%",
        height: "100%",
        uid: params.uid,
        vid: params.vid,
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
            this.streamBilling(userid, 1);
            setTimeout(() => {
              billingFlag = false;
            }, 1000);
          }
        });
        player.on("s2j_onPause", () => {
          if (!billingEndFlag) {
            this.updateLiveState();
            billingEndFlag = true;
            this.streamBilling(userid, 2);
            setTimeout(() => {
              billingEndFlag = false;
            }, 1000);
          }
        });
      };
    },
    /**
     * 创建保利威的聊天区域
     */
    createPolyvChatRoom(params) {
      this.polyvChatHeight =
        window.innerHeight - this.$refs.player.offsetHeight;

      new VPolyvChatRoom({
        roomId: params.vid, //直播房间id
        userId: params.userid, //当前用户信息
        nick: params.username, //当前用户名
        pic: params.avatar, //当前的用户头像
        token: params.token, //聊天的token令牌
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
        if (res.result === "error") {
          this.$toast("计费失败，请尽快联系管理员");
        }
      });
    }
  }
};
</script>
<style scoped>
.v-live-index__player {
  height: 10.54rem;
  background: #f6f9fa;
}
.v-live-cover {
  height: 10.54rem;
}
</style>
