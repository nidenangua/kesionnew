<template>
  <view class="plv-mp-chatroom-wrap" :class="'plv-mp-skin__'+skin">
    <scroll-view
      class="plv-mp-chatroom-scroll-view"
      :scroll-top="scrollTop"
      @scroll="onChatListScroll"
      scroll-y
    >
      <chat-list
        id="chatList"
        :is-only-host="isOnlyHost"
        :chat-list="chatList"
        :has-more="hasMore"
        @seemore="handleSeeMore"
        :skin="skin"
      />
    </scroll-view>
    <view v-if="comeMore" class="plv-mp-chatroom-more" @click="handleSeeMoreMsg">有更多新消息，点击查看</view>
    <chat-edit
      :skin="skin"
      @like="handleLike"
      @sengmsg="handleSendMsg"
      @onlyhost="handleOnlyHost"
      @showbulletin="handleShowBulletin"
      :show-bulletin="showBulletin"
    />
  </view>
</template>

<script>
import ChatList from '../chat-list/chat-list'
import ChatEdit from '../chat-edit/chat-edit'
import Event from "../../common/chat/eventTypes";
import util from "../../common/utils/utils";
import store from "../../store/index";
const MAX_MSG_COUNT = 200;

export default {
  components:{
    ChatList,
    ChatEdit
  },
	props:{
		showBulletin: {
			type: Boolean,
			default: !1
		},
		skin: {
			type: String,
			default: "black"
		}
	},
	data(){
		return {
			chatList: [],
			hasMore: !1,
			scrollTop: 0,
			isOnlyHost: !1,
			comeMore: !1
		}
	},
  created() {
      (this.chatEvent = this.getChatEvent()),
        (this.notJoinLists = []),
        (this.clock = null),
        (this.chat = null),
        (this.chatTop = 0),
        (this.scrollHeight = 0),
        (this.chatListHeight = 0);
  },
  beforeMount(){
	  util
        .getDomRect(".plv-mp-chatroom-scroll-view", this)
        .then(({ height: t }) => {
          this.scrollHeight = t;
        });
  },
  mounted(){
	  this.unsub = store.get({
        "main.chat": t => {
          (this.chat = t),
            t &&
              (this.bindEvent(this.chatEvent),
              this.chat.getHistoryMessage(20, 0),
              this.initChatListQueue());
        }
      });
  },
  destroyed(){
	  if ((this.unsub(), clearInterval(this.clock), !this.chat)) return;
      const t = this.chatEvent;
      Object.keys(t).forEach(s => {
        this.chat.off(s, t[s]);
      }),
        (this.chat = null);
  },
  methods: {
    handleSeeMore() {
      this.chat.hasMoreHistory() && this.chat.getHistoryMessage();
    },
    handleLike() {
      this.chat.sendLike(1);
    },
    handleSendMsg(t) {
      const s = t.chatTitle;
      this.chat.send(s), (this.isSelfMsg = !0);
    },
    handleOnlyHost(t) {
	  const s = t.isOnlyHost;
	  this.isOnlyHost = s
    },
    handleSeeMoreMsg() {
		this.comeMore = !1;
		this.chatScrollToBottom();
    },
    onChatListScroll(t) {
      if (((this.chatTop = t.scrollTop), this.comeMore)) {
        this.chatTop + this.scrollHeight + 10 >= this.chatListHeight &&
          (this.comeMore = !1);
      }
    },
    handleShowBulletin() {
      this.$emit("onTapBulletin");
    },
    bindEvent(t) {
      const s = this.chat;
      s &&
        Object.keys(t).forEach(i => {
          s.on(i, t[i]);
        });
    },
    getChatEvent() {
      const t = this;
      return {
        [Event.HISTORY_MESSAGE](s, i) {
          const e = 0 === t.chatList.length,
			h = [...i, ...t.chatList];
		  t.chatList = h;
		  t.hasMore = t.chat.hasMoreHistory();
		  t.$nextTick(()=>{
			  e && t.chatScrollToBottom();
		  })
         
        },
        [Event.SPEAK](s, i) {
          let e = !1;
          try {
            t.chatList.forEach(t => {
              if (t.id === i.id) throw ((e = !0), Error("same id"));
            });
          } catch (t) {}
          !e && t.notJoinLists.push(i);
        },
        [Event.CHAT_IMG](s, i) {
          (i.content = i.values[0]), t.notJoinLists.push(i);
        },
        [Event.REMOVE_HISTORY]() {
			t.chatList = [];
			t.hasMore = !1;
        },
        [Event.REMOVE_CONTENT](s, i) {
          const e = [...t.chatList];
          e.forEach((s, h) => {
            s.id === i.id && (e.splice(h, 1), ( t.chatList = e));
          });
        },
        [Event.SYSTEM_MESSAGE](s, i) {
          t.notJoinLists.push(i);
        },
        [Event.SPEAK_ERROR](s, i) {
          t.notJoinLists.push(i);
        },
        [Event.SEND_MESSAGE](s, i) {
			t.chatList = [...t.chatList, i]
			t.$nextTick(()=>{
				t.chatScrollToBottom();
			})
          
        },
        [Event.SPEAK_CENSOR](s, i) {
		  const e = `chatList[${t.chatList.length - 1}].id`;
		  t[e] = i.id;
        },
        [Event.REWARD](s, i) {
          t.notJoinLists.push({ ...i, id: Math.floor(1e7 * Math.random()) });
        },
        [Event.LIKES](s, i) {
          t.notJoinLists.push({ ...i, id: Math.floor(1e7 * Math.random()) });
        },
        [Event.FLOWERS](s, i) {
          t.notJoinLists.push({ ...i, id: Math.floor(1e7 * Math.random()) });
        },
        [Event.CLOSE_ROOM]() {
          t.notJoinLists.push({
            id: Math.floor(1e7 * Math.random()),
            system: !0,
            content: "房间暂时关闭"
          });
        },
        [Event.OPEN_ROOM]() {
          t.notJoinLists.push({
            id: Math.floor(1e7 * Math.random()),
            system: !0,
            content: "房间已经打开"
          });
        },
        [Event.KICK_USER](s, i) {
          t.notJoinLists.push({
            system: !0,
            content: `${i.user.nick}[被踢出房间]`
          })
        }
      }
    },
    initChatListQueue() {
      this.clock = setInterval(() => {
        if (this.notJoinLists.length) {
          const t = this.chatListHeight - 2 * this.scrollHeight <= this.chatTop;
          let s = [...this.chatList, ...this.notJoinLists];
          s.length > 200 && (s = s.slice(200)),
			(this.chatList = s),
            (this.notJoinLists = []),
            this.$nextTick(() => {
              t
                ? this.chatScrollToBottom()
                : (util.getDomRect("#chatList", this).then(({ height: t }) => {
                    this.chatListHeight = t;
				  }),
				  (this.comeMore = !this.isSelfMsg),
				  (this.isSelfMsg = !1));
            });
        }
      }, 600);
    },
    chatScrollToBottom() {
      util.getDomRect("#chatList", this).then(({ height: t }) => {
        (this.chatListHeight = t), (this.scrollTop = t);
      });
    }
  }
};
</script>

<style scoped>
.plv-mp-chatroom-wrap {
  height: 100%;
  position: relative;
  padding-bottom: 100rpx;
  box-sizing: border-box;
  background: #44434f;
}
.plv-mp-chatroom-scroll-view {
  height: 100%;
}
.plv-mp-chatroom-more {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 100rpx;
  height: 64rpx;
  line-height: 64rpx;
  color: #fff;
  font-size: 26rpx;
  background: #6ebbf7;
  text-align: center;
}
.plv-mp-skin__white {
  background: #f5f9fa;
}

</style>
