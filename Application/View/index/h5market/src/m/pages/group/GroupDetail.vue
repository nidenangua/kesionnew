<template>
  <div v-if="detailLoaded">
    <ks-create-bg border-radius="0px" class="group-banner" :src="detail.banner">
      <div class="group-header">
        <div class="group-icon">
          <span class="group-img"></span>
          <span class="group-name">{{$store.state.info.sitename}}</span>
        </div>
        <router-link class="group-btn" to="/">店铺首页</router-link>
      </div>
    </ks-create-bg>

    <div class="group-detail">
      <div class="group-tit">{{detail.title}}</div>
      <div class="group-staus">
        <span>{{detail.member || 0}}人加入</span>
        <span>{{detail.staus || 0}}动态</span>
      </div>
      <ks-button
        class="group-manage"
        type="primary"
        size="small"
        v-if="loginUser.is_join == 1"
        @click="manage()"
        plain
      >管理我的社群</ks-button>
    </div>
    <div class="group-detail" v-if="detail.intro">
      <div class="group-tit">社群介绍</div>
      <div class="group-info">{{detail.intro}}</div>
    </div>

    <div class="group-detail" v-if="loginUser.is_join == 0 && memberList.length">
      <div class="group-tit">
        社群学员
        <span class="group-count">（{{memberList.length}}人）</span>
      </div>
      <div class="group-photo">
        <ul class="clearfix" id="member">
          <li v-for="(item,i) in memberList" :key="i">
            <ks-create-bg class="group-wid" :src="item.userinfo.head" type="user"/>
          </li>
          <li @click="goMember()" v-if="memberList.length > 13">
            <img class="group-wid" src="@/m/assets/group/group_btn_more.png">
          </li>
        </ul>
      </div>
    </div>

    <div class="group-detail" v-if="loginUser.is_join == 1 || detail.nojoin == 1">
      <div class="group-tit" v-if="loginUser.is_join == 0">最新动态</div>
      <ks-tab :tab-info="tabInfo" @change="changeTab" v-else-if="loginUser.is_join == 1"/>
      <ks-page-scroll-container
        :page="p"
        :page-count="pageCount"
        v-if="dynamic.length"
        @page-change="getList"
      >
        <topic-item
          :jump-link="true"
          :item="item"
          :role="loginUser.role"
          :group-id="groupId"
          :is-join="loginUser.is_join"
          :class="i < dynamic.length-1 && 'line'"
          v-for="(item,i) in dynamic"
          :key="i"
          @change="getList()"
        />
      </ks-page-scroll-container>

      <ks-empty msg="没有找到任何动态~" type="notest" v-else-if="dynamicLoaded">
        <div class="ks-mt15">
          <ks-button
            type="primary"
            size="medium"
            v-if="dynamic.length == 0 && loginUser.is_join == 1 && key== 'new' "
            @click="release(groupId)"
          >发表动态</ks-button>
        </div>
      </ks-empty>

      <ks-button
        class="reply-edit"
        size="medium"
        icon="ks-icon-edit--outline"
        type="primary"
        @click="release(groupId)"
        v-if="loginUser.is_ok == 1"
        round
      >动态</ks-button>
    </div>

    <store-footer/>
    <div class="group-join" v-if="loginUser.is_join == 0">
      <ks-button
        class="group-join__button"
        type="primary"
        @click="join"
        v-if="chargetype == 1"
      >立即加入 &nbsp;|&nbsp; ¥{{detail.price}}</ks-button>
      <ks-button class="group-join__button" type="success" @click="join" v-else>免费加入</ks-button>
    </div>
  
    <!--申请恢复-->
    <ks-dialog title="申请加入" :visible.sync="messageMask">
      <div class="message-content">
        <textarea placeholder="请输入您的申请理由" v-model="message"></textarea>
      </div>
      <div class="message-btn ks-color-primary" @click="applist">提交</div>
    </ks-dialog>
  </div>
</template>

<script>
import TopicItem from "./components/TopicItem";
import {
  getTeamDetail,
  getTeamTopicList,
  getTeamMemberList,
  teamAddMember,
  application
} from "@/api/group";

export default {
  name: "GroupDetail",
  data() {
    return {
      /**
       * 
       * 是否为社群会员
      */
      is_vip:'',
      /**
       * 社群id
       */
      groupId: null,
      /**
       * 选项卡信息
       */
      tabInfo: {
        options: ["最新动态", "精选动态", "我的动态", "公告"],
        current: 0,
        values: ["new", "is_hot", "userid", "is_notice"]
      },
      /**
       * 当前登录的用户身份信息
       * role    2为群主
       * is_ok   发表话题权限
       * is_join 是否已加入该社群
       */
      loginUser: {},
      /**
       * 社群信息
       */
      detailLoaded: false,
      detail: {},
      /**
       * 社群成员
       */
      memberList: [],
      /**
       * 社群动态列表
       */
      dynamicLoaded: false,
      dynamic: [],
      type: 1,
      p: 1,
      pageCount: null,
      key: "new",
      chargetype: -1, // 判断申请加入 0 免费 1 收费 2申请加入
      message: null, // 申请加入
      messageMask: false
    };
  },
  methods: {
    /**
     * 选项卡切换回调
     */
    changeTab(key) {
      this.key = key;
      this.getList();
    },
    /**
     * 获取动态列表
     */
    getList(p = 1) {
      let params = {
        p: p,
        data: {
          team_id: this.groupId
        },
        maxperpage: 10
      };

      if (this.key === "userid") {
        this.$store.ready(state => {
          let uid = state.userInfo.userid;
          if (uid === undefined) {
            this.$toast("请先登录").then(() => {
              this.$router.push({
                name: "UserLogin"
              });
            });
            return false;
          }
          params.data.userid = uid;
          this.getTopicList(params);
        });
      } else if (this.key) {
        params.data[this.key] = 1;
        this.getTopicList(params);
      } else {
        this.getTopicList(params);
      }
    },
    getTopicList(params) {
      this.dynamicLoaded = false;
      this.$showLoading();
      getTeamTopicList(params).then(res => {
        this.p = res.page.now_page;
        this.pageCount = res.page.total_pages;
        res.list.map(item => {
          let filePath = [];
          if (item.file_path) {
            item.file_path.map(src => {
              filePath.push({
                src: src
              });
            });
            item.file_path = filePath;
          }
        });
        if (res.page.now_page == 1) {
          this.dynamic = res.list;
        } else {
          this.dynamic = this.dynamic.concat(res.list);
        }
        this.dynamicLoaded = true;
        this.$hideLoading();
      });
    },

    manage() {
      this.$router.push({
        path: "/group/manage",
        query: {
          groupid: this.groupId
        }
      });
    },
    release(id) {
      this.$router.push({
        path: "/group/dynamic",
        query: {
          groupid: id
        }
      });
    },
    /**
     * 跳转会员列表
     */
    goMember() {
      this.$router.push({
        path: "/group/member",
        query: {
          groupid: this.groupId
        }
      });
      this.$store.ready(state=>{
        console.log(state.userInfo)
      })
    },

    /**
     * 跳转加入
     */
    join() {
      if (this.chargetype == 0) {
        teamAddMember({
          id: this.groupId
        }).then(res => {
          if (res.result === "success") {
            this.$toast("加入成功", "success");
            this.getDetail();
          }
        });
      } else if (this.chargetype == 1) {
        this.$showPay({
          payid: this.groupId,
          msg: "加入社群",
          price: this.detail.price,
          type: "group"
        });
      } else if (this.chargetype == 2) {
        this.messageMask = true;
      }
    },
    applist() {
      let params = {
        team_id: this.groupId,
        content: this.message
      };
      this.$store.ready(state => {
        params.mobile = state.userInfo.mobile;
      });
      application(params).then(res => {
        this.$toast("申请已提交", "success");
        this.messageMask = false;
      });
    },
    /**
     * 获取默认社群信息
     */
    getDetail() {
      this.detailLoaded = false;
      this.$showLoading();
      getTeamDetail({
        id: this.groupId
      }).then(res => {
        this.is_vip = res.is_vip
        this.chargetype = res.chargetype;
        this.loginUser = res.loginUser;
        this.detail = {
          price: res.price,
          banner: res.defaultpic,
          member: res.member_num,
          staus: res.topic_num,
          intro: res.description,
          title: res.title,
          nojoin: res.nojoin //为1时未加入也可以浏览社群话题
        };

        /**
         * 获取话题列表
         * 条件：未加入可浏览话题的社群，已加入社群
         */
        if (res.nojoin == 1 || res.loginUser.is_join == 1) {
          this.getList();
        }

        /**
         * 获取社群成员
         */
        getTeamMemberList({
          id: this.groupId
        }).then(res => {
          this.memberList = res.list;
        });

        this.detailLoaded = true;
        this.$hideLoading();
      });
    }
  },
  activated() {
    document.title = "社群详情";
    this.groupId = this.$route.params.id;
    this.detail = {};
    this.getDetail();
  },
  components: {
    TopicItem
  }
};
</script>
<style scoped>
.group-banner {
  height: 11rem;
}
.group-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: rgba(0, 0, 0, 0.4);
  color: #fff;
  padding: 10px;
  font-size: 14px;
  position: relative;
  z-index: 10;
}
.group-header a {
  color: #fff;
  display: block;
  width: 70px;
  height: 27px;
  line-height: 27px;
  text-align: center;
  border: 1px solid #fff;
  border-radius: 4px;
}
.group-icon .group-img {
  width: 27px;
  height: 27px;
  border-radius: 50%;
}
.group-detail {
  padding: 10px;
  background: #fff;
  margin-bottom: 10px;
  position: relative;
}
.group-detail .group-tit {
  font-size: 16px;
  height: 34px;
  line-height: 34px;
  overflow: hidden;
  font-weight: 500;
}
.group-detail .group-manage {
  position: absolute;
  right: 15px;
  top: 50%;
  margin-top: -14px;
}

.group-staus {
  font-size: 14px;
  color: #999;
  padding-bottom: 10px;
}
.group-staus span {
  padding-right: 15px;
}
.group-detail .group-info {
  font-size: 14px;
  color: #666;
  line-height: 22px;
  padding-bottom: 10px;
}
.group-photo ul {
  margin-top: 10px;
}
.group-photo li {
  float: left;
  width: 14%;
}
.group-photo .group-wid {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  margin: 10px auto;
  display: block;
}
.group-tab ul {
  display: flex;
}
.group-tab li {
  font-size: 14px;
  line-height: 18px;
  color: #666;
  flex: 1;
  text-align: left;
  padding-bottom: 10px;
  cursor: pointer;
}
.group-tab .active a {
  color: #e64a3b;
  font-size: 15px;
  position: relative;
}
.group-tab .active a {
  border-bottom: 2px solid #e64a3b;
  padding-bottom: 10px;
}

.reply-edit {
  right: 10px;
  position: fixed;
  bottom: 10%;
  box-shadow: 0px 3px 15px 0px rgba(230, 74, 59, 0.2);
  z-index: 99;
  opacity: 0.8;
}

.group-join {
  height: 44px;
}
.group-join__button {
  position: fixed;
  bottom: 0;
  left: auto;
  right: auto;
  margin: 0 auto;
  width: 100%;
  max-width: 480px;
  border-radius: 0px !important;
  z-index: 9;
}
.message-content{
  height: 90px;
}
.message-content textarea {
  display: block;
  resize: vertical;
  padding: 10px 15px;
  font-size: 14px !important;
  line-height: 1.5;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  width: 95%;
  /* margin: 0 auto; */
  margin-left: 8px;
  margin-top: 50px;
  font-size: inherit;
  color: #606266;
  background-color: #f1f5f8;
  background-image: none;
  border: 1px solid #f1f5f8;
  height: 100px;
  border-radius: 4px;
  -webkit-transition: border-color 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
  transition: border-color 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
  resize: none;
}
.message-content textarea::-webkit-input-placeholder {
  font-size: 14px;
  color: #888;
}
.message-btn {
  text-align: center;
  font-size: 16px;
  padding: 10px 0 0;
}
</style>
