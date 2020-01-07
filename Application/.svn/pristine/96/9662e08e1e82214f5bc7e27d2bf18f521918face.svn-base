<template >
  <div :style="{minHeight:minHeight+'px',background:'#fff'}">
    <!-- 发布者信息部分 -->
    <div class="friend">
      <div class="friend-name">{{friendDet.name}}</div>
      <p class="friend-time">{{friendDet.adddate}}</p>
      <ks-image :src="friendDet.head" class=" friend-head"/>
      <p class="friend-content">{{friendDet.json.content}}</p>
      <media-Preview :type="friendDet.json.$type" :info="friendDet.json.$info"/>
      <div class="friend-tool">
        <span
          class="friend-tool__delete"
          @click="topicdel(friendDet.id,friendDet.userid)"
          v-if="is_teacher > 0"
        >删除</span>
        <span class="friend-tool__comment" @click="com($event)">
          <i class="ks-icon ks-icon-message-square-outline"></i>
          {{friendDet.reply_num}}
        </span>
        <span class="friend-tool__like" @click="dianzan(friendDet.id)">
          <i class="ks-icon ks-icon-dianzan" v-if="friendDet.is_zan"></i>
          <i class="ks-icon ks-icon-dianzan-outline" v-else></i>
          {{friendDet.zan_num}}
        </span>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="gridClass"></div>
    <div class="friend" v-for="(item,i) in friendList" :key="item.id" v-show="i < 4 || flag">
      <div class="friend-name">{{item.name}}</div> 
      <p class="friend-time">{{item.adddate}}</p>
       <ks-image :src="item.head" class=" friend-head"/>
      <p class="friend-content">{{item.json}}</p>
      <div class="critic-tool">
        <span class="critic" @click="reply($event,item.name,item.id,item.userid)">回复</span>
        <span
          class="critic-tool__delete"
          @click="delcom(item.id,item.userid)"
          v-if="is_teacher > 0 || comId == item.userid"
        >删除</span>
      </div>
      <div class="comment" v-for="commentlist in item.reply_list" :key="commentlist.id">
        <div class="friend">
          <div class="friend-name"><span>{{commentlist.name}}</span>  回复  <span>{{commentlist.reply_name}}</span></div>
          <p class="friend-time">{{commentlist.adddate}}</p>
          <ks-image :src="commentlist.head" class=" friend-head"/>
          <p class="friend-content">{{commentlist.json}}</p>
          <div class="critic-tool">
            <span class="critic" @click="replyreply($event,commentlist.userid,commentlist.name,item.id)">回复</span>
            <span class="critic-tool__delete" @click="delcom(commentlist.id,commentlist.userid)" v-if="is_teacher > 0 || comId == commentlist.userid">删除</span>
          </div>
          <div class="gridClass"></div>
        </div>
      </div>
    </div>
    <div class="gridClass"></div>
    <div class="more" v-if="friendList.length > 4">
      <a class="more-reply" v-if="flag">已经显示全部回复</a>
      <a class="more-reply" v-else @click="flag= !flag">加载更多回复</a>
    </div>
    <!-- 底部回复框 -->
    <div class="publish" v-show="publishCom" @click="comshow($event)">
      <input type="text" :placeholder="comcontent" v-model="content" ref="sendreply">
      <button @click="commentpub">发送</button>
    </div>
    <store-footer/>
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
      minHeight: window.innerHeight,
      /**朋友圈详情 */
      friendDet: { json: {} },
      /**回复列表 */
      friendList: [],
      /**评论显示 */
      publishCom: false,
      /**节流阀 */
      flag: true,
      /**评论内容显示 */
      comcontent: "请输入你的评论",
      /**评论内容 */
      content: "",
      /**评论id */
      id: Number,
      /**回复对象id */
      uid: Number,
      /**加载内容按钮 */
      flag: false,
      /**是否为老师 */
      is_teacher: "",
      /**当前登录人ID */
      comId: "",
      /**判断用户是否点击的回复回复评论人 */
      replyflag:false,
      /**回复回复评论对象UID */
      replyuid:"",
      /**回复回复评论对象评论ID */
      replyid:""
    };
  },
  activated() {
    document.title = "动态详情"
    document.addEventListener('click',this.onDocClick)
    this.getfriendsDet();
  },
  deactivated() {
     document.removeEventListener('click',this.onDocClick)
  },
  methods: {
    onDocClick() {
      this.publishCom = false
    },
    getfriendsDet() {
      this.$showLoading();
      let id = this.$route.params.id
      friendsDet({ id: id }).then(res => {
        console.log(res);
        this.friendDet = res.detail;
        this.friendList = res.list;
        this.resetJson(this.friendDet.json);
        this.$hideLoading();
      });
      this.$store.ready(state => {
        this.is_teacher = state.userInfo.usertype;
        this.comId = state.userInfo.userid;
      });
    },
    /**删除评论 */
    delcom(comid, userid) {
      this.$store.ready(state => {
        /**是否为老师 */
        let isteacher = state.userInfo.usertype;
        /**当前登录人ID */
        let commentid = state.userInfo.userid;
        if (isteacher > 0) {
          this.$confirm("是否确认删除？").then(() => {
            friendsDel({ id: comid, type: 2 }).then(res => {
              this.$toast("删除成功");
              this.getfriendsDet();
            });
          });
        } else if (commentid === userid) {
          this.$confirm("是否确认删除？").then(() => {
            friendsDel({ id: comid, type: 2 }).then(res => {
              this.$toast("删除成功");
              this.getfriendsDet();
            });
          });
        }
      });
    },
    /**话题删除 */
    topicdel(topicid, userid) {
      this.$store.ready(state => {
        /**是否为老师 */
        let isteacher = state.userInfo.usertype;
        /**当前登录人ID */
        let commentid = state.userInfo.userid;
        if (isteacher > 0) {
          this.$confirm("是否确认删除？").then(() => {
            friendsDel({ id: topicid, type: 1 }).then(res => {
              this.$toast("删除成功","success").then(()=>{
                this.$navigateBack()
              });
            });
          });
        } else if (commentid === userid) {
          this.$confirm("是否确认删除？").then(() => {
            friendsDel({ id: topicid, type: 1 }).then(res => {
              this.$toast("删除成功","success").then(()=>{
                this.$navigateBack()
              });
              
            });
          });
        }
      });
      // this.$navigateBack()
    },
    com(e) {
      event.stopPropagation();
      this.flag = true;
      this.publishCom = true;
      this.comcontent = `请输入你的评论`;
      this.$nextTick(()=>{
        this.$refs.sendreply.focus()
      })
    },
    reply(e,name, id, userid) {
      this.replyflag = false;
      this.flag = false;
      this.publishCom = true;
      this.$nextTick(()=>{
        this.$refs.sendreply.focus()
      })
      event.stopPropagation();
      this.comcontent = `回复 : ${name}`;
      this.id = id;
      this.uid = userid;
      /**当前登录人ID */
      let commentid = this.$store.state.userInfo.userid;
      if (commentid === this.uid) {
        this.publishCom = false;
        return this.$toast("不能自己回复自己哦");
      }
    },
    /**回复评论 */
    commentpub() {
      if (this.flag == true) {
        friendsaddReply({
          socialid: this.friendDet.id,
          content: this.content
        }).then(res => {
          this.$toast("评论成功", "success");
          this.getfriendsDet();
          this.content = "";
        });
      } else {
        if(this.replyflag == true) {
          friendsaddReply({
          socialid: this.friendDet.id,
          content: this.content,
          reply_uid: this.reply_uid,
          parentid: this.id
          }).then(res => {
          this.$toast("评论成功", "success");
          this.getfriendsDet();
          this.content = "";
          });
          return
        }else {
          friendsaddReply({
          socialid: this.friendDet.id,
          content: this.content,
          reply_uid: this.uid,
          parentid: this.id
        }).then(res => {
          this.$toast("评论成功", "success");
          this.getfriendsDet();
          this.content = "";
        });
        }
      }
    },
    /**朋友圈点赞 */
    dianzan(id) {
      friendsZan({ id }).then(res => {
        this.getfriendsDet();
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
    handleClose(e){
      this.publishCom = false
    },
    comshow(e) {
      event.stopPropagation()
    },
    /**回复回复评论的人 */
    replyreply(e,userid,name,id) {
      this.id = id
      this.reply_uid = userid
      console.log(userid);
      this.flag = false;
      event.stopPropagation();
      let commentid = this.$store.state.userInfo.userid;
      if (commentid === userid) {
        this.publishCom = false;
        return this.$toast("不能自己回复自己哦");
      }
      this.publishCom = true;
     this.$nextTick(()=>{
        this.$refs.sendreply.focus()
      })
      this.comcontent = `回复 : ${name}`;
      this.replyflag = true
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
.friend {
  padding: 20px 20px 10px 60px;
  position: relative;
}
.friend-name {
  font-size: 14px;
}
.friend-head {
  border-radius: 50%;
  width: 35px;
  position: absolute;
  top: 22px;
  left: 15px;
  height: 35px;
}
.friend-time {
  font-size: 12px;
  padding-top: 5px;
  color: #999;
}
.friend-content {
  font-size: 14px;
  text-align: justify;
  padding: 5px 0;
  line-height: 22px;
}
.friend-tool {
  font-size: 14px;
  margin-top: 10px;
}
.friend-tool__delete {
  color: #999;
}
.friend-tool__like {
  float: right;
}
.friend-tool__comment {
  float: right;
  margin-left: 14px;
}
.friend-tool i {
  padding-right: 5px;
}
.critic-tool {
  font-size: 14px;
  margin-top: 6px;
}
.critic {
  color: #4c8bf8;
}
.critic-tool__delete {
  float: right;
  color: #999;
}
.comment {
  padding: 10px;
  font-size: 12px;
  line-height: 18px;
  background-color: #f7f7f7;
  padding-bottom: 0;
}
.comment a {
  color: #4c8bf8;
}
.comment p {
  padding-bottom: 5px;
}
.comment-reply {
  border-radius: 3px;
  padding: 5px 20px;
  margin-top: 10px;
  width: 20%;
  margin: 5px auto;
  background-color: #fff;
  box-shadow: 0 0px 4px 0 rgba(7, 17, 27, 0.1);
}
.gridClass {
  position: relative;
  width: 90%;
  margin: 0 auto;
}
.gridClass:after {
  content: " ";
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 1px;
  border-top: 1px solid #e9e9e9 !important;
  -webkit-transform: scaleY(0.5);
  transform: scaleY(0.5);
}
.bubble {
  background-color: #999;
  color: #fff;
  font-size: 14px;
  line-height: 32px;
  border-radius: 20px;
  text-align: center;
  padding: 0 10px;
  display: table;
  margin: 0 auto;
}
.comment .friend {
  padding: 0 0 0 45px;
  position: relative;
}
.comment .friend-head {
  position: absolute;
  top: 2px;
  left: 2px;
}
.comment .gridClass {
  clear: both;
}
.comment .critic-tool {
  margin-top: 0px;
}
.comment .friend-content {
  padding-top: 4px;
}
.comment .critic-tool__delete {
  margin-bottom: 5px;
}
.more {
  padding: 15px;
}
.more .more-reply {
  background-color: #fff;
  color: #666;
  font-size: 12px;
  line-height: 25px;
  border-radius: 5px;
  text-align: center;
  padding: 0 20px;
  display: table;
  margin: 0 auto;
  border: 1px solid #e5e5e5;
}
.publish {
  padding: 5px 5px 0 5px;
  position: fixed;
  bottom: 0;
  width: 100%;
  height: 46px;
  background-color: #fff;
  z-index: 999;
}
.publish input {
  border: 1px solid #e5e5e5;
  font-size: 16px;
  line-height: 24px;
  padding: 5px 10px;
  width: 80%;
  border-radius: 3px;
}
.publish button {
  width: 15%;
  margin-left: 1%;
  padding: 9px;
  background-color:var(--ornament-color);
  color: #fff;
  border: 1px;
  border-radius: 3px;
  outline: none;
}
.ks-icon-dianzan {
  color: var(--ornament-color);
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
.friend-name span{
  color: var(--primary-color);
}
.ks-image /deep/ img {
  border-radius: 50%;
}
</style>