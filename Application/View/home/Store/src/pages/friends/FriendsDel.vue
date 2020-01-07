<template>
  <div class="container">
    <!-- 导航部分 -->
    <div class="nav">
      <el-breadcrumb separator="/" class="navbar">
        <el-breadcrumb-item
          :to="{path:'/?url=%2Fhome.html%2Ffriends%2FIndex%2FIndex%3F'}"
          class="nav-friend"
        >朋友圈动态</el-breadcrumb-item>
        <el-breadcrumb-item>查看动态</el-breadcrumb-item>
      </el-breadcrumb>
      <el-button class="goback" @click="goback">返回</el-button>
    </div>
    <!-- 内容部分 -->
    <div class="content">
      <div class="content-nav">
        <ks-image :src="friendsDet.head" class="content-nav__head"/>
        <span class="content-nav__name">{{friendsDet.name}}</span>
        <span class="content-nav__time">{{friendsDet.adddate}}</span>
      </div>
      <div class="content-con">
        <div class="content-con__head">{{friendsDet.json.content}}</div>
        <div class="content-con__image">
          <media-Preview
            :type="friendsDet.json.$type"
            :info="friendsDet.json.$info"
            class="Preview"
          />
        </div>
        <div class="content-con__footer">
          <span class="icon_zan" @click="dianzan(friendsDet.id)">
            <i class="iconfont icon-dianzan" v-if="friendsDet.is_zan"></i>
            <i class="iconfont icon-dianzan-outline" v-else></i>
            {{friendsDet.zan_num}}
          </span>
          <span @click="comment" class="is_relpy">
            <i class="iconfont icon-message-circle-outline"></i>
            {{friendsDet.reply_num}}
          </span>
          <i class="iconfont icon-shanchu1 del" @click="deltopic()"></i>
        </div>
      </div>
      <!-- 评论 -->
      <div
        class="comment"
        v-for="(item,i) in friendsList"
        :key="item.id"
        v-show="i < 4 || list_show"
      >
        <ks-image type="user" :src="item.head" class="content-nav__head"/>
        <span class="content-nav__name">{{item.name}}</span>
        <span class="content-nav__time">{{item.adddate}}</span>
        <div class="comment-con">{{item.json}}</div>
        <div class="comment-footer">
          <span @click="reply(item.id,item.userid,item.name)" v-if="item.userid !== userID">回复</span>
          <i class="iconfont icon-shanchu1 del replydel" @click="delcom(item.id)"></i>
          <div v-if="comidd == item.id">
            <el-input v-model="replymsg" :placeholder="placeholder"/>
            <el-button type="primary" @click="reply_send">发送</el-button>
          </div>
        </div>
        <!-- 回复 -->
        <div class="reply" v-for="(reply,i) in item.reply_list" :key="reply.id">
          <ks-image type="user" :src="reply.head" class="content-nav__head"/>
          <span class="content-nav__name--reply">
            <span>{{reply.name}}</span>回复
            <span>{{reply.reply_name}}</span>
          </span>
          <span class="content-nav__time--reply">{{reply.adddate}}</span>
          <i class="iconfont icon-shanchu1 del del-reply" @click="delreply(reply.id)"></i>
          <div class="reply-content">{{reply.json}}</div>
          <!-- {{reply}} -->
          <span class="reply-reply" @click="replyreply(reply.name,reply.userid,item.id,reply.id)" v-if="reply.userid !==userID">回复</span>
          <div v-if="replyID == reply.id" class="el_input">
            <el-input v-model="replymsg" :placeholder="placeholder"/>
            <el-button type="primary" @click="reply_sends">发送</el-button>
          </div>
          <div class="gridClass" v-if="i<(item.reply_list.length - 1)"></div>
        </div>
        <div class="gridClass gridClasss" v-if=" i<(friendsList.length - 1)"></div>
      </div>
    </div>
    <!-- 底部 -->
    <div class="footer" ref="foot">
      <div class="footer-content">
        <el-input
          placeholder="请输入评论内容"
          :show-word-limit="show"
          resize="none"
          type="textarea"
          :rows="10"
          v-model="textarea"
          class="footer-reply"
        ></el-input>
      </div>
      <el-button type="primary" class="footer-button" @click="send">发表评论</el-button>
      <div class="gridClass footergrid"></div>
      <!-- <div class="gridClass"></div> -->
      <div v-if="friendsList.length > 4">
        <el-button class="footer-button__load" v-if="list_show">数据显示完毕</el-button>
        <el-button class="footer-button__load" @click="list_show = !list_show" v-else>加载回复更多</el-button>
      </div>
    </div>
  </div>
</template>
<script>
import {
  friendsDet,
  friendsDel,
  friendsaddReply,
  friendsZan
} from "@/api/friend";
import { setTimeout } from "timers";
import MediaPreview from "../../components/media-preview";
export default {
  components: {
    MediaPreview
  },
  data() {
    return {
      replyID: 0,
      comidd: 0,
      /**回复数据 */
      textarea: "",
      /**详情数据 */
      friendsDet: { json: {} },
      /**评论数据 */
      friendsList: "",
      show: true,
      /**判断评论还是回复 */
      is_comment: Boolean,
      /**回复对象uid */
      uid: "",
      /**评论id */
      comid: "",
      /**表单显示内容 */
      placeholder: "请输入评论内容",
      /**列表显示 */
      list_show: false,
      /**评论id */
      comid: Number,
      /**节流阀 */
      flag: false,
      /**回复回复评论人uid */
      reply_userid: "",
      replyflag: true,
      /**当前登录人ID */
      userID: "",
      /**回复内容 */
      replymsg: ""
    };
  },
  created() {
    this.getfriendsDet();
  },
  methods: {
    /**获取详情信息 */
    getfriendsDet() {
      let length = location.hash.split("/").length - 1;
      let id = location.hash.split("/")[length];
      this.$store.ready(res => {
        this.userID = res.userInfo.userid;
      });
      friendsDet({ id: id }).then(res => {
        this.friendsDet = res.detail;
        this.friendsList = res.list;
        this.resetJson(this.friendsDet.json);
      });
    },
    /**返回功能 */
    goback() {
      this.$router.go(-1);
    },
    /**点赞 */
    dianzan(id) {
      friendsZan({ id }).then(res => {
        this.getfriendsDet();
      });
    },
    /**评论功能 */
    comment() {
      this.placeholder = "请输入评论内容";
      this.is_comment = true;
      this.$refs.foot.scrollIntoView(true);
    },
    /**回复功能 */
    reply(id, userid, name) {
      this.comidd = id;
      this.replyflag = true;
      this.placeholder = `回复 ：${name}`;
      (this.comid = id), (this.uid = userid);
      this.is_comment = false;
    },
    /**发表评论回复 */
    send() {
      /**评论 */
      friendsaddReply({
        socialid: this.friendsDet.id,
        content: this.textarea
      }).then(res => {
        this.$message({ message: "评论成功", type: "success" });
        this.textarea = "";
        this.getfriendsDet();
      });
    },
    /**删除操作 */
    del(type, id) {
      this.$store.ready(state => {
        /**是否为老师 */
        let is_teacher = state.userInfo.usertype;
        /**发布人评论人ID */
        let comid = state.userInfo.userid;
        if (is_teacher > 0 || id === comid) {
          this.$confirm("确认删除吗？该操作不可逆", {
            confirmButtonText: "确定",
            cancelButtonText: "取消",
            type: "warning"
          }).then(() => {
            friendsDel({ type: type, id: id }).then(res => {
              if (type == 1) {
                this.$message({
                  type: "success",
                  message: "删除成功!"
                });
                setTimeout(() => {
                  this.$router.go(-1);
                }, 1000);
              } else {
                this.$message({
                  type: "success",
                  message: "删除成功!"
                });
                this.getfriendsDet();
              }
            });
          });
        } else {
          return this.$message({ message: "您没有权限", type: "error" });
        }
      });
    },
    /**话题删除 */
    deltopic() {
      this.del(1, this.friendsDet.id);
    },
    /**回复删除 */
    delcom(id) {
      this.del(2, id);
    },
    /**评论删除 */
    delreply(id) {
      this.del(2, id);
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
    /**回复回复的人 */
    replyreply(name, userid, id,replyid) {
      this.replyID = replyid;
      this.comid = id;
      this.is_comment = false;
      this.replyflag = false;
      this.replyid = userid;
      this.placeholder = `回复：${name}`;
      this.reply_userid = userid;
      this.flag = true;
    },
    /**回复 */
    reply_send() {
      friendsaddReply({
        socialid: this.friendsDet.id,
        content: this.replymsg,
        reply_uid: this.uid,
        parentid: this.comid
      }).then(res => {
        this.$message({ message: "回复成功", type: "success" });
        this.replymsg = "";
        this.getfriendsDet();
        this.comidd = 0;
      });
    },
    /**回复回复的人 */
    reply_sends() {
      friendsaddReply({
        socialid: this.friendsDet.id,
        content: this.replymsg,
        reply_uid: this.reply_userid,
        parentid: this.comid
      }).then(res => {
        this.$message({ message: "回复成功", type: "success" });
        this.replymsg = "";
        this.getfriendsDet();
        this.replyID = 0;
      });
    }
  },
  watch: {
    $route(to, from) {
      this.$router.go(0);
    }
  }
};
</script>
<style scoped>
.container {
  background-color: #fff;
  margin: 20px;
  border-radius: 10px;
  /* margin-left: 20px; */
}
.nav {
  padding: 15px;
}
.navbar {
  line-height: 40px;
}
.goback {
  float: right;
  margin-top: -40px;
}
.content {
  padding-left: 60px;
  width: 900px;
}
.content-nav,
.comment {
  position: relative;
}
.content-nav__head {
  width: 45px;
  height: 45px;
  border-radius: 50%;
}
.content-nav__name {
  position: absolute;
  top: 0;
  left: 53px;
  font-size: 14px;
}
.content-nav__time {
  position: absolute;
  top: 24px;
  left: 53px;
  font-size: 13px;
  color: #63666a;
}
.content-con {
  margin-left: 53px;
  border-bottom: 1px solid #e8eaeb;
}
.content-con__image {
  margin: 8px 0;
}
.content-con__image img {
  width: 100px;
  margin-right: 10px;
  padding: 5px 0;
}
.ks-icon-dianzan {
  width: 20px;
  height: 20px;
}
.comment {
  margin: 18px 0 10px 55px;
}
.comment-footer {
  padding: 4px 0 2px 0;
}
.comment-footer span {
  color: #3c81f9;
}
.comment-footer span:hover {
  cursor: pointer;
}
.comment-con,
.comment-footer {
  padding-left: 53px;
}
.reply {
  position: relative;
  background-color: #f6f9fb;
  margin-left: 53px;
  padding: 15px 20px 5px 20px;
}
.content-nav__name--reply,
.content-nav__time--reply {
  position: absolute;
}
.content-nav__name--reply {
  top: 20px;
  left: 73px;
}
.content-nav__time--reply {
  top: 43px;
  left: 73px;
  font-size: 13px;
  color: #63666a;
}
.gridClass {
  position: relative;
  width: 80%;
  margin: 0 auto;
}
.gridClass:after {
  content: " ";
  position: absolute;
  left: -25px;
  top: 4px;
  width: 117%;
  height: 1px;
  border-top: 1px solid #ccc !important;
  -webkit-transform: scaleY(0.5);
  transform: scaleY(0.5);
}
.gridClass {
  clear: both;
}
.reply-content {
  padding-top: 6px;
  padding-bottom: 10px;
  padding-left: 53px;
}
.footer {
  width: 793px;
  margin-top: 22px;
  margin-left: 167px;
  text-align: center;
}
.footer-button {
  margin: 10px 0;
  float: right;
}
.footer-button__load {
  width: 200px;
  height: 30px;
  line-height: 7px;
  margin: 20px 0;
}
.del {
  float: right;
  margin-right: 10px;
}
.icon_zan {
  padding-right: 15px;
}
.icon-dianzan {
  color: #e64a3b;
}
.del-reply {
  margin-right: -9px;
}
.content-con__footer {
  padding: 8px 0;
}
.gridClass-head {
  width: 90%;
}
.gridClasss:after {
  left: -30px;
  top: 10px;
  width: 117%;
}
.replydel {
  position: absolute;
  top: 7px;
  right: 0;
}
.comment-con {
  line-height: 15px;
  font-size: 14px;
  line-height: 22px;
}
.el-textarea /deep/ .el-textarea__inner {
  width: 796px !important;
  height: 140px;
  margin-left: -100px;
}
.footergrid:after {
  left: -80px;
  width: 125%;
}
.content-con__head {
  line-height: 22px;
  font-size: 14px;
}
.nav-friend /deep/ .el-breadcrumb__inner:hover {
  cursor: pointer;
  color: #3c81f9;
}
.reply-reply {
  color: #3c81f9;
  cursor: pointer;
  padding-left: 52px;
}
.content-nav__name--reply span {
  color: #3c81f9;
}
.ks-image /deep/ img {
  border-radius: 50%;
}
.audio-wrapper {
  width: 600px;
}
.icon_zan,
.is_relpy {
  cursor: pointer;
}
.el_input{
  padding-left: 50px;
}
</style>