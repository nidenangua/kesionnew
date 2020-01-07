<template>
  <div class="wx-msg-reply">
    <div class="wx-msg-reply_user_tip">
      与
      <span class="ks-red">{{replyUser.nickname}}</span>的聊天记录
    </div>
    <div class="wx-msg-reply__chat">
      <div class="wx-msg-reply__chat__list clearfix" ref="chatScrollView">
        <ks-loading v-show="loading"/>
        <div
          class="clearfix"
          :class="item.nickname ? 'wx-msg-reply__chat__item' : 'wx-msg-reply__chat__item_me'"
          v-for="item in chatList"
          :key="item.id"
        >
          <ks-create-bg class="wx-msg-reply__chat__avatar" type="user" :src="item.headimgurl"/>
          <div class="wx-msg-reply__chat__cont" v-html="item.content"></div>
        </div>
      </div>
      <wx-editor ref="wxEditor" height="120px" class="wx-msg-reply__reply"/>
      <div class="clearfix ks-mt10">
        <el-button class="ks-fr" type="primary" @click="sendMsg">确认发送</el-button>
      </div>
    </div>
  </div>
</template>
<script>
/**
 * 留言管理-消息回复
 */
import { getReplyNews, setReplyNews } from "@/api/wechat";
import WxEditor from "./compoents/WxEditor";
export default {
  name: "WxMsgReply",
  props: ["replyUser"],
  data() {
    return {
      chatList: [],
      loading: true
    };
  },
  methods: {
    /**
     * 获取聊天记录
     */
    getChatList() {
      getReplyNews({
        fromusername: this.replyUser.fromusername
      }).then(res => {
        if (res.result === "success") {
          res.list.map(item => {
            item.content = this.$refs.wxEditor.codeReplaceToEmotion(
              item.content
            );
          });
          this.chatList = res.list;
          this.$nextTick(() => {
            this.$refs.chatScrollView.scrollTop = this.$refs.chatScrollView.scrollHeight;
          });
        } else {
          this.$msg(res.msg);
        }
        this.loading = false;
      });
    },
    /**
     * 发送消息
     */
    sendMsg() {
      let content = this.$refs.wxEditor.getContent();
      if (!content) {
        this.$msg("请先输入回复内容");
        return false;
      }
      setReplyNews({
        fromusername: this.replyUser.tousername,
        content: content,
        tousername: this.replyUser.fromusername
      }).then(res => {
        if (res.result === "success") {
          this.getChatList();
          this.$refs.wxEditor.setContent("");
        } else {
          this.$msg("该会话已超过时间限制，回复失败");
        }
      });
    }
  },
  mounted() {
    this.getChatList();
  },
  components: {
    WxEditor
  }
};
</script>

<style scoped>
.wx-msg-reply_user_tip {
  padding-bottom: 15px;
}

.wx-msg-reply__chat {
  background: #f6f6f6;
  padding: 20px;
}

.wx-msg-reply__chat__list {
  height: 300px;
  overflow-y: auto;
  overflow-x: hidden;
  position: relative;
}

.wx-msg-reply__chat__item,
.wx-msg-reply__chat__item_me {
  position: relative;
  padding: 10px 0;
  min-height: 60px;
}

.wx-msg-reply__chat__item {
  padding-left: 55px;
  margin-right: 30px;
}
.wx-msg-reply__chat__cont {
  position: relative;
}
.wx-msg-reply__chat__cont::before {
  content: "";
  width: 6px;
  height: 10px;
  position: absolute;
  left: -6px;
  top: 5px;
  background-image: url(../../assets/store/chat-arrow.png);
  background-repeat: no-repeat;
}
.wx-msg-reply__chat__avatar {
  width: 40px;
  height: 40px;
  position: absolute !important;
  left: 0;
  top: 10px;
}
.wx-msg-reply__chat__item_me {
  padding-right: 55px;
  margin-left: 30px;
}
.wx-msg-reply__chat__cont {
  background: #fff;
  display: inline-block;
  padding: 6px 12px;
  border-radius: 4px;
}

.wx-msg-reply__chat__item_me .wx-msg-reply__chat__avatar {
  left: inherit;
  right: 0;
}
.wx-msg-reply__chat__item_me .wx-msg-reply__chat__cont {
  background: #e5412c;
  color: #fff;
  float: right;
}
.wx-msg-reply__chat__item_me .wx-msg-reply__chat__cont::before {
  left: inherit;
  right: -6px;
  background-position: 0 -13px;
}
.wx-msg-reply__reply {
  background: #fff;
}
</style>
