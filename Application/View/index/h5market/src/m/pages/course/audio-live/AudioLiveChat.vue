<template>
  <div class="chat" ref="chat" :style="{height:height+'px'}" @scroll="chatSroll" @touchmove.stop>
    <div class="chat-pull-loading" v-if="isShowLoading"></div>
    <div class="chat-pull-up" v-else-if="page < totalPage">上拉加载更多消息</div>
    <div v-for="(item,index) in chatData" :key="item.redisid">
      <div class="chat-reward" v-if="item.content && item.content.msg_type === 'reward'">
        <div class="chat-reward__text">
          {{item.membername}}打赏了一个
          <span>{{item.content.reward_number}}</span>元红包
        </div>
      </div>
      <div class="chat-tips" v-else-if="item.content && item.content.msg_type === 'tips'">
        <div class="chat-tips__text">{{item.content.msg}}</div>
      </div>
      <div v-else>
        <div class="chat-time" v-if="item.adddate">{{item.adddate}}</div>
        <div class="chat-item clearfix">
          <ks-image class="chat-item__avatar" :src="item.avatar" type="user" />
          <div class="chat-item__name">
            {{item.membername}}
            <span
              class="chat-item__level"
              v-if="item.memberid && item.memberid == teacherid"
            >主讲老师</span>
            <span
              @touchstart="withdraw(item,index)"
              v-if="item.redisid && item.memberid == userid && currentTime < Number(item.time) + 120"
            >撤回</span>
            <span
              @touchstart.stop="replyMsg(item)"
              v-if="item.memberid && item.memberid != userid && item.chattype == 2"
            >回复</span>
          </div>
          <template v-if="item.content">
            <template v-if="item.content.msg_action === 'reply'">
              <div class="chat-item__reply">
                <div class="chat-item__reply-content" v-html="item.content.msg"></div>
                <div class="chat-item__reply-source" v-if="item.content.reply_source">
                  <div
                    v-html="`<span style='color:#5171a9;'>@${item.content.reply_source.membername}：</span>${item.content.reply_source.content.msg}`"
                  ></div>
                </div>
              </div>
            </template>
            <template v-else>
              <div
                class="chat-item__interact"
                v-html="item.content.msg"
                v-if="item.content.msg_type === 'text'"
              ></div>
              <div class="chat-item__interact" v-else-if="item.content.msg_type === 'img'">
                <img
                  :src="item.content.msg"
                  :style="{maxWidth:maxArea+'px',maxHeight:maxArea+'px'}"
                  @click="openPrevImg(item.redisid)"
                />
              </div>
              <div
                class="chat-item__audio"
                :class="item.playing && 'playing'"
                @touchstart="playAudio(item)"
                v-else-if="item.content.msg_type === 'audio'"
              >
                <i v-if="item.unread"></i>
                <span>{{item.content.audio_time}}"</span>
              </div>
            </template>
          </template>
          <template v-else>
            <div class="chat-item__interact chat-item__interact--error">不支持该内容格式</div>
          </template>
        </div>
      </div>
    </div>
    <div
      class="chat-msg-tips"
      @touchstart="scrollToLower"
      :style="{width:chatWidth+'px',bottom:'49px',left:chatOffsetLeft+'px'}"
      v-if="showChatMsgTips"
    >收到{{chatData.length-oldChatDataLength}}条新消息</div>
  </div>
</template>
<script>
let chatAudio = document.createElement("audio");
import { delChat } from "@/api/live";
export default {
  /**聊天区域 */
  name: "AudioLiveChat",
  props: {
    action: String,
    /**当前页码 */
    page: {
      type: Number,
      default: 0
    },
    /**总页码 */
    totalPage: {
      type: Number,
      default: 0
    },
    /**当前时间（时间戳，单位：秒） */
    currentTime: {
      type: Number,
      required: true
    },
    /**文本默认内容，点击回复会改变 */
    placeholder: String,
    /**容器高度 */
    height: Number,
    /**是否是老师 */
    teacherid: [String, Number],
    /**用户id */
    userid: [String, Number],
    /**聊天记录 */
    chatData: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  data() {
    return {
      chatOffsetLeft: 0,
      chatWidth: 0,
      chatHeight: 0,
      maxArea: 0,
      /**是否显示加载 */
      isShowLoading: false,
      /**可预览的图片数组 */
      prevImgList: [],
      /**旧数据的第一条数据的id，如果新数据的第一条id与旧数据不同，则说明当前是上拉加载出来的消息数据，反之是新消息 */
      oldFirstChatId: 0,
      /**旧的聊天记录长度 */
      oldChatDataLength: 0,
      /**新消息数量 */
      newMsgNumber: 0,
      /**当前时间 */
      nowTime: 0,
      /**显示新消息提示 */
      showChatMsgTips: false,
      /**计算自动滚动至最底部的次数 */
      autoScrollToLowerNumber: 0
    };
  },
  watch: {
    page() {
      this.isShowLoading = true;
    },
    chatData: {
      handler(data) {
        /**提取图片消息部分 */
        let _prevImgList = [];
        data.map(item => {
          if (item.content && item.content.msg_type === "img") {
            _prevImgList.push({
              redisid: item.redisid,
              src: item.content.msg
            });
          }
        });
        this.prevImgList = _prevImgList;
        let $chat = this.$refs.chat;
        /**处理数据上拉加载情况 */
        if (
          (data[0] && this.oldFirstChatId != data[0].redisid) ||
          data.length <= this.oldChatDataLength
        ) {
          if (data[0] && this.oldFirstChatId != data[0].redisid) {
            this.$nextTick(() => {
              $chat.scrollTop = $chat.offsetHeight;
            });
          }
          this.updateOldData();
        } else {
          /**is判断要放在$nextTick前，这样才能有效判断 */
          let is = this.isScorllBottomDistanceMeet($chat);
          this.$nextTick(() => {
            if (this.autoScrollToLowerNumber === 0 || is) {
              /**自动滚动至容器底部 */
              this.scrollToLower();
              this.autoScrollToLowerNumber++;
              this.updateOldData();
            } else {
              let chatOffsetTop = this.getOffset($chat).top;
              this.chatOffsetLeft = this.getOffset($chat).left;
              this.chatWidth = $chat.offsetWidth;
              this.chatHeight = $chat.offsetHeight + chatOffsetTop;
              this.showChatMsgTips = true;
            }
          });
        }
      },
      deep: true
    }
  },
  mounted() {
    /**更新时间 */
    setTimeout(() => {
      this.nowTime += 1000;
    }, 1000);
    let $chat = this.$refs.chat;
    this.maxArea = Math.min($chat.offsetWidth / 2, 260);
  },
  methods: {
    /**
     * 打开图片预览
     * @param {String} 消息id
     */
    openPrevImg(id) {
      let prevIndex = this.getPrevImgIndex(id);
      this.$preview(this.prevImgList, prevIndex);
    },
    /**
     * 根据id获取对应图片预览对象的index
     * @param {String} 图片绑定的id(消息id)
     */
    getPrevImgIndex(id) {
      let index;
      this.prevImgList.map((item, i) => {
        if (item.redisid == id) {
          index = i;
        }
      });
      return index;
    },
    /**
     * 更新旧聊天记录数长度
     * oldChatDataLength 用于计算新消息数量
     */
    updateOldData() {
      this.oldFirstChatId = this.chatData[0] ? this.chatData[0].redisid : 0;
      this.oldChatDataLength = this.chatData.length;
      this.isShowLoading = false;
    },
    /**
     * 滚动至最底部
     */
    scrollToLower() {
      let $chat = this.$refs.chat;
      $chat.scrollTop = $chat.scrollHeight;
    },
    /**
     * 滚动容器滚动
     */
    chatSroll(e) {
      if (this.isScorllBottomDistanceMeet(e.target)) {
        this.showChatMsgTips = false;
        this.updateOldData();
      } else {
        if (e.target.scrollTop === 0) {
          this.$emit("scrollToUpper");
        }
      }
    },
    /**
     * 撤回消息
     * @param {Number,String} 消息id
     */
    withdraw(item) {
      delChat({
        courseid: this.$route.query.id,
        cid: this.$route.query.chapterid,
        chattype: item.chattype,
        redisid: item.redisid
      }).then(res => {
        if (res.result === "success") {
          this.$emit("withdraw", {
            memberid: item.memberid,
            membername: item.membername,
            chattype: item.chattype,
            redisid: item.redisid
          });
        } else {
          this.$layer.msg("撤回失败");
        }
      });
    },
    /**
     * 当前聊天区域滚动条位置与滚动容器页底的距离是否小于32 (32是新消息提示层的高度)
     * @param {Object} 容器dom对象
     */
    isScorllBottomDistanceMeet($chat) {
      let is = false;
      if ($chat.scrollHeight - $chat.offsetHeight - $chat.scrollTop < 32) {
        is = true;
      }
      return is;
    },
    /**
     * 播放音频
     * @param {Object}
     */
    playAudio(item) {
      if (item.playing) {
        item.playing = false;
        chatAudio.pause();
        return false;
      }
      localStorage[`AUDIO_READ_STATE${this.userid}${item.redisid}`] = 1;
      this.chatData.map(chatItem => {
        if (chatItem.content && chatItem.content.msg_type === "audio") {
          chatItem.playing = false;
        }
      });
      chatAudio.src = item.content.msg;
      chatAudio.load();
      chatAudio.play();
      item.unread = false;
      /**开始播放 */
      chatAudio.onplay = e => {
        item.playing = true;
      };
      /**播放错误 */
      chatAudio.onerror = e => {
        this.$toast("播放时遇到错误");
        item.playing = false;
      };
      /**播放结束 */
      chatAudio.onended = e => {
        item.playing = false;
        let currentIndex = 0;
        this.chatData.map((chatItem, i) => {
          if (chatItem.redisid == item.redisid) {
            currentIndex = i;
          }
        });
        let nextItem = this.chatData[currentIndex + 1];
        if (
          nextItem &&
          nextItem.content.msg_type === "audio" &&
          nextItem.unread
        ) {
          this.playAudio(nextItem);
        }
      };
    },
    /**
     * 回复消息
     * @param {Object} 消息对象
     */
    replyMsg(item) {
      this.$emit("reply-selected", {
        memberid: item.memberid,
        membername: item.membername,
        content: item.content
      });
    },
    /**
     * 获取dom距离页面顶部的高度
     */
    getOffset($el) {
      let offsetTop = 0;
      let offsetLeft = 0;
      do {
        offsetTop += $el.offsetTop;
        offsetLeft += $el.offsetLeft;
        $el = $el.offsetParent;
      } while ($el.offsetParent);
      return {
        top: offsetTop,
        left: offsetLeft
      };
    }
  }
};
</script>
<style scoped>
.chat {
  overflow-y: auto;
  position: relative;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  box-sizing: border-box;
  padding: 15px 30px;
  background: #f3f5f9;
  -webkit-overflow-scrolling: touch;
}
.chat-pull-loading {
  height: 25px;
  line-height: 25px;
  overflow: hidden;
  background: url(../../../assets/audio-live/loading.gif) no-repeat 50% 50%;
  background-size: auto 25px;
}
.chat-pull-up {
  text-align: center;
  height: 25px;
  line-height: 25px;
  overflow: hidden;
  text-align: center;
  color: #999;
}
.chat-item {
  padding: 15px 15px 15px 42px;
  position: relative;
  min-height: 36px;
  font-size: 13px;
}
.chat-item__avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  overflow: hidden;
  position: absolute !important;
  left: 0px;
  top: 15px;
}

.chat-item__name span {
  margin-left: 10px;
  color: #37a7ed;
  font-size: 12px;
  cursor: pointer;
}
.chat-item__name .chat-item__level {
  color: #989da7;
}
.chat-item__interact {
  float: left;
  background: #fff;
  padding: 7px 10px;
  border-radius: 5px;
  line-height: 22px;
  margin-top: 5px;
}
.chat-item__interact img {
  max-width: 260px;
  max-height: 260px;
  display: block;
  padding: 3px 0;
}
/*回复样式*/
.chat-item__reply {
  float: left;
  background: #fff;
  padding: 9px 10px;
  border-radius: 5px;
  margin-top: 5px;
}
.chat-item__reply-content {
  border-bottom: 1px solid #eee;
  padding-bottom: 5px;
}
.chat-item__reply-source {
  padding-top: 5px;
}
.chat-item__audio {
  width: 180px;
  height: 36px;
  background-color: #fff;
  background-image: url(../../../assets/audio-live/audiolive_icon_audiodoc.png);
  background-repeat: no-repeat;
  background-position: 10px 50%;
  position: relative;
  cursor: pointer;
  border-radius: 5px;
  line-height: 36px;
  background-size: 24px 24px;
  margin-top: 5px;
}
.chat-item__audio.playing {
  background-image: url(../../../assets/audio-live/audiolive_icon_audiodoc.gif);
}
.chat-item__audio span {
  float: right;
  padding-right: 10px;
  color: #3a3d89;
}
.chat-item__audio i {
  width: 7px;
  height: 7px;
  position: absolute;
  right: -2px;
  top: -2px;
  background: #e6412d;
  border-radius: 50%;
}

.chat-time {
  text-align: center;
  color: #818996;
  margin-top: 10px;
}
.chat-reward {
  text-align: center;
  padding: 5px 0;
}
.chat-reward__text {
  background: #ffe8bb;
  text-align: center;
  display: inline-block;
  color: #e98c21;
  font-size: 12px;
  border-radius: 10px;
  position: relative;
  padding: 6px 14px;
  line-height: 12px;
}
.chat-reward__text sapn {
  color: #e64a3b;
}
.chat-tips {
  text-align: center;
  margin-top: 10px;
}
.chat-tips__text {
  height: 24px;
  line-height: 24px;
  overflow: hidden;
  padding: 0 15px;
  background: rgba(0, 0, 0, 0.2);
  color: #fff;
  border-radius: 24px;
  display: inline-block;
  margin: 0 auto;
}
.chat-msg-tips {
  height: 32px;
  line-height: 32px;
  background: rgba(253, 246, 236, 0.9);
  color: #e6a23c;
  position: fixed;
  left: 0;
  text-align: center;
  z-index: 9;
  cursor: pointer;
}
</style>

