<template>
<div class="page">
  <div class="page-header" v-if="$store.state.style.id == 4 || $store.state.style.id == 5">
    <kd-big-title title="朋友圈" />
  </div>
  <ks-page-scroll-container :page="page" :page-count="pageCount" @page-change="onPageChange">
      <div class="bubble" v-if="oldfriendList.new_reply > 0">
        <a class="bubble-info" @click="newlist">{{oldfriendList.new_reply}}条新的回复</a>
      </div>
      <!-- 发布者信息部分 -->
      <div class="friend" v-for="(item) in friendList" :key="item.id">
        <ks-image type="teacher" class="friend-head" :src="item.head"/>
        <div class="friend-name">{{item.name}}</div>
        <p class="friend-time">{{item.adddate}}</p>
        
        <p class="friend-content" @click="firendsDet(item.id)">{{item.json.content}}</p>
        <media-Preview :type="item.json.$type" :info="item.json.$info"/>
        <div class="friend-tool">
          <span
            class="friend-tool__delete"
            @click="deleteFrinden(item.id,item.userid)"
            v-if="is_teacher > 0"
          >删除</span>
          <span class="friend-tool__comment" @click="comment($event,item.id)">
            <i class="ks-icon ks-icon-message-square-outline"></i>
            {{item.reply_num}}
          </span>
          <span class="friend-tool__like" @click="friendsZan(item.id)">
            <i class="ks-icon ks-icon-dianzan" v-if="item.is_zan"></i>
            <i class="ks-icon ks-icon-dianzan-outline" v-else></i>
            {{item.zan_num}}
          </span>
        </div>
        <div class="clearfix"></div>
        <!-- 回复信息 -->
        <div class="comment" v-if="item.$reply_list && item.$reply_list.length">
          <div
            v-for="(reply,i) in item.$reply_list"
            v-show="i < 4 || item.$show_more_reply"
            :key="reply.$id"
            @click="replyCom(item.id,reply.userid,reply.name,reply.id,$event)"
            class="comment-foot"
          >
            <div v-if="reply.reply_name === false">
              <a>{{reply.name}}</a>
              : {{reply.json}}
            </div>
            <div v-else>
              <a>{{reply.name}}</a>回复
              <a>{{reply.reply_name}}</a>
              : {{reply.json}}
            </div>
          </div>
          <div
            class="comment-reply"
            v-if="item.$reply_list.length > 4"
            @click="item.$show_more_reply = !item.$show_more_reply"
          >
            <span v-if="item.$show_more_reply">收起回复</span>
            <span v-else>共{{item.reply_num}}条回复</span>
          </div>
        </div>
        <div class="gridClass"></div>
        <div class="gridClass"></div>
      </div>
      <div v-show="commentShow" class="replyBox" @click="stopbubb($event)">
        <ks-input line :placeholder="placeholder" v-model="replyContent" ref="sendreply"/>
        <ks-button type="primary" size="medium" @click="send">发送</ks-button>
      </div>
      <!-- 发布入口 -->
      <div class="issue" @click="goissue" v-if="is_teacher>0"></div>
      <!-- 用户提示 -->
      <ks-empty type="nolesson" :msg="'老师还没有发表动态，去其他地方逛逛吧~'" v-if="empty_show"/>

  </ks-page-scroll-container>
  <store-footer-bar />
</div>
</template>
<script>
import MediaPreview from "../../components/media-preview";
import {
  friendsList,
  friendsaddReply,
  friendsDel,
  friendsZan
} from "@/api/friend";

export default {
  components: {
    MediaPreview
  },
  data() {
    return {
      empty_show: false,
      /**p分页 m一页几条 */
      page: 1,
      pageCount: 0,
      /**话题列表数据 */
      friendList: [],
      /**评论显示行藏 */
      commentShow: false,
      /**回复内容 */
      replyContent: "",
      /**话题ID */
      id: "",
      /**回复对象ID */
      replyId: "",
      /**节流阀 */
      flag: true,
      /**提示信息 */
      placeholder: "请输入你的回复",
      /**评论ID */
      commentId: null,
      /**新回复 */
      oldfriendList: {},
      /**info地址类型 */
      type: "",
      /**是否为老师 */
      is_teacher: ""
    };
  },
  activated() {
    document.title = "朋友圈动态"
    document.addEventListener("click", this.onDocClick);
    this.getlist();
  },
  deactivated() {
    document.removeEventListener("click", this.onDocClick);
  },
  methods: {
    onDocClick() {
      this.commentShow = false;
    },
    /**话题列表数据 */
    getlist(page = 1) {
      this.$showLoading();
      this.page = page;
      friendsList({
        p: page,
        maxperpage: 10
      }).then(res => {
        res.list.map(item => {
          this.resetJson(item.json);
          if (item.reply_list && item.reply_list.length) {
            item.$reply_list = [];
            item.$show_more_reply = false;
            item.reply_list.map(comment => {
              item.$reply_list.push({
                topicid: item.id,
                id: comment.id,
                json: comment.json,
                head: comment.head,
                name: comment.name,
                reply_name: false,
                userid: comment.userid
              });
              if (comment.reply_list && item.reply_list.length) {
                comment.reply_list.map(reply => {
                  item.$reply_list.push({
                    topicid: item.id,
                    id: reply.parentid,
                    $id: reply.id,
                    json: reply.json,
                    head: reply.head,
                    name: reply.name,
                    reply_name: reply.reply_name,
                    userid: reply.userid
                  });
                });
              }
            });
          }
        });
        this.pageCount = res.page.total_pages;
        this.friendList =
          page == 1 ? res.list : this.friendList.concat(res.list);
        this.oldfriendList.new_reply = res.new_reply;
        this.$store.ready(state => {
          this.is_teacher = state.userInfo.usertype;
        });
        res.list.length == 0
          ? (this.empty_show = true)
          : (this.empty_show = false);
        this.$hideLoading();
      });
    },
    /**拿到话题ID */

    comment(event, id) {
      event.stopPropagation();
      this.flag = true;
      this.id = id;
      this.commentShow = true;
      this.$nextTick(() => {
        this.$refs.sendreply.focus();
      });
    },
    /**判断 */
    resetJson(json = {}) {
      json.$info = {};
      switch (Number(json.type)) {
        case 1:
          json.$type = "image";
          let _list = [];
          if (json.info instanceof Array) {
            json.info.map(src => {
              _list.push({
                src: src
              });
            });
          }
          // 给list加json.$info节点
          json.$info = {
            list: _list
          };
          break;
        case 2:
          json.$type = "video";
          json.$info = {
            src: json.info[0] || ""
          };
          break;
        case 3:
          json.$type = "audio";
          json.$info = {
            src: json.info[0] || ""
          };
          break;
      }
    },
    /**发表评论 */
    send() {
      if (this.flag) {
        let params = { socialid: this.id, content: this.replyContent };
        if (this.replyContent === "") {
          return this.$toast("请输入内容");
        } else {
          friendsaddReply(params).then(res => {
            if (res.result == "success") {
              this.$toast("评论成功", "success");
              this.commentShow = false;
              this.replyContent = "";
              this.getlist();
            }
          });
        }
      } else {
        let paramss = {
          socialid: this.id,
          content: this.replyContent,
          reply_uid: this.replyId,
          parentid: this.commentId
        };
        if (this.replyContent === "") {
          return this.$toast("请输入内容");
        } else {
          friendsaddReply(paramss).then(res => {
            if (res.result == "success") {
              this.$toast("回复成功", "success");
              this.commentShow = false;
              this.replyContent = "";
              this.getlist();
            }
          });
        }
      }
    },
    /**回复发表评论 */
    replyCom(id, useid, name, comid, e) {
      event.stopPropagation();
      this.id = id;
      this.replyId = useid;
      this.flag = false;
      this.commentShow = true;
      this.$nextTick(() => {
        this.$refs.sendreply.focus();
      });
      this.commentId = comid;
      let usersid = this.$store.state.userInfo.userid;
      if (usersid === this.replyId) {
        this.commentShow = false;
        return this.$toast("不能自己回复自己");
      }
      this.placeholder = `回复： ${name}`;
    },
    /**删除朋友圈 */
    deleteFrinden(id, userid) {
      this.$store.ready(state => {
        /**是否为老师 */
        let isteacher = state.userInfo.usertype;
        /**当前登录人ID */
        let comid = state.userInfo.userid;
        if (isteacher > 0) {
          this.$confirm("是否确认删除？").then(() => {
            friendsDel({ type: 1, id: id }).then(res => {
              this.getlist(), this.$toast("删除成功", "success");
            });
          });
        } else if (userid === comid) {
          this.$confirm("是否确认删除？").then(() => {
            friendsDel({ type: 1, id: id }).then(res => {
              this.getlist(), this.$toast("删除成功", "success");
            });
          });
        } 
      });
    },
    /**点赞 */
    friendsZan(id) {
      friendsZan({ id: id }).then(res => {
        this.getlist();
      });
    },
    /**跳转朋友圈 */
    firendsDet(id) {
      this.$router.push(`/friend/${id}`);
    },
    /**跳转新回复列表 */
    newlist() {
      this.$router.push(`/friendlist`);
    },
    onPageChange: function(page) {
      this.getlist(page);
    },
    /**跳转发布页 */
    goissue() {
      this.$router.push("/friendIssue");
    },
    handleClose(e) {
      this.commentShow = false;
    },
    stopbubb(e) {
      event.stopPropagation();
    }
  }
};
</script>
<style scoped>
.page{
  background: #fff;
}
.friend {
  padding: 30px 20px 20px 60px;
  position: relative;
}
.friend-name {
  font-size: 14px;
}
.friend .friend-head {
  border-radius: 50%;
  width: 35px;
  position: absolute;
  top: 32px;
  left: 15px;
  height: 35px;
}
.friend-time {
  font-size: 12px;
  padding-top: 5px;
  color: var(--prompt-color);;
}
.friend-content {
  font-size: 16px;
  text-align: justify;
  padding: 5px 0;
  line-height: 22px;
  padding-right: 5px;
}
.friend-tool {
  font-size: 13px;
  margin-top: 10px;
  height: 24px;
  line-height: 24px;
  overflow: hidden;
  color:var(--secondary_text-color);
}
.friend-tool .ks-icon{
  font-size: 15px;
}
.friend-tool__delete {
  color: var(--prompt-color);;
}
.friend-tool__like {
  float: right;
}
.friend-tool__comment {
  float: right;
  margin-left: 14px;
}

.friend-tool i.ks-icon-dianzan {
  color: var(--ornament-color);
}
.comment {
  padding: 10px;
  font-size: 12px;
  line-height: 18px;
  background-color: #f7f7f7;
  margin-top: 10px;
}
.comment a {
  color: #4c8bf8;
}
.comment p {
  padding-bottom: 5px;
}
/* .comment-reply{border-radius: 3px;padding: 5px 20px;margin-top: 10px;width: 20%;margin: 5px auto;background-color: #fff;box-shadow: 0 0px 4px 0 rgba(7,17,27,.1);} */
.gridClass {
  position: relative;
  width: 100%;
  margin: 0 auto;
  margin-top: 20px;
}
.gridClass:after {
  content: " ";
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 1px;
  border-top: 1px solid #ddd;
  -webkit-transform: scaleY(0.5);
  transform: scaleY(0.5);
}
.bubble {
  padding: 15px;
}
.bubble-info {
  background-color: var(--prompt-color);;
  color: #fff;
  font-size: 14px;
  line-height: 32px;
  border-radius: 20px;
  text-align: center;
  padding: 0 10px;
  display: table;
  margin: 0 auto;
}
.comment-reply {
  padding: 5px;
  text-align: center;
  background: #ffffff;
  width: 130px;
  border: 1px solid #eee;
  border-radius: 3px;
  margin: 0 auto;
  margin-top: 10px;
}
.comment-reply a {
  background-color: #fff;
  color: #000;
  font-size: 12px;
  line-height: 28px;
  border-radius: 3px;
  text-align: center;
  padding: 0 10px;
  display: table;
  margin: 0 auto;
  box-shadow: 0 0px 4px 0 rgba(7, 17, 27, 0.1);
}
.replyBox {
  position: fixed;
  bottom: 49px;
  width: 100%;
  background-color: #fff;
  height: 46px;
  padding-top: 5px;
  z-index:var(--prompt-color);;
}
.issue {
  position: fixed;
  bottom: 115px;
  right: 20px;
  border-radius: 50%;
  width: 45px;
  height: 45px;
  background-color: var(--primary-color);
}
.issue:before,
.issue:after {
  content: "";
  position: absolute;
  background: #fff;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.issue:before {
  width: 2px;
  height: 20px;
}
.issue:after {
  width: 20px;
  height: 2px;
}

.clearfix:after {
  /*伪元素是行内元素 正常浏览器清除浮动方法*/
  content: "";
  display: block;
  height: 0;
  clear: both;
  visibility: hidden;
}
.clearfix {
  *zoom: 1; /*ie6清除浮动的方式 *号只有IE6-IE7执行，其他浏览器不执行*/
}
.comment-foot {
  text-align: justify;
}
.message {
  color: var(--prompt-color);;
}
.message {
  padding-top: 30px;
  text-align: center;
}
</style>