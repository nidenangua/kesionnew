<template>
  <div v-if="loaded">
    <div class="group-banner" :style="{backgroundImage:'url('+detail.defaultpic+')'}">
      <div class="mask"></div>
      <div class="group-detail">
        <div class="group-tit">{{detail.title}}</div>
        <div class="group-staus">
          {{detail.member}}
          <span>人加入</span>
          {{detail.staus}}
          <span>动态</span>
        </div>
      </div>
    </div>
    <ks-list item-height="49px">
      <ks-list-item title="我的群昵称" v-if="loginUser.role != 0">
        <input type="text" class="group-input" v-model="name" placeholder="修改昵称" @blur="editName">
      </ks-list-item>
      <ks-list-item title="成员列表" @click="memberList()" show-arrow></ks-list-item>
      <ks-list-item
        title="发帖权限"
        @click="setPermission"
        v-if="loginUser.role == 0 || loginUser.role == 2"
        show-arrow
      >{{(detail.jurisdiction == 1 && '所有成员可发') || (detail.jurisdiction == 2 && '仅限群主可发')}}</ks-list-item>
    </ks-list>
  </div>
</template>

<script>
import { getIsScrolltolower } from "@/utils";
import { getTeamDetail, editJurisdiction, editRealName } from "@/api/group";

export default {
  name: "GroupManage",
  data() {
    return {
      /**
       * 社群id
       */
      groupId: this.$route.query.groupid,
      loaded: false,

      /**
       * 群昵称
       */
      name: "",
      oldName: "",
      /**
       * 社群信息
       */
      detail: {
        defaultpic: null,
        title: null,
        member: null,
        staus: null,
        jurisdiction: ""
      },
      loginUser: {}
    };
  },
  methods: {
    /**
     * 打开学员列表
     */
    memberList() {
      this.$router.push({
        path: "/group/member",
        query: {
          groupid: this.groupId
        }
      });
    },

    /**
     * 修改群昵称
     */
    editName() {
      if (this.oldName === this.name) {
        return false;
      }
      this.oldName = this.name;
      editRealName({
        realname: this.name,
        id: this.groupId
      }).then(res => {
        //...
      });
    },
    /**
     * 设置发帖权限
     */
    setPermission() {
      this.$actionSheet({
        list: [
          {
            name: "所有成员可发",
            jurisdiction: 1
          },
          {
            name: "仅限群主可发",
            jurisdiction: 2
          }
        ]
      }).then(info => {
        editJurisdiction({
          jurisdiction: info.jurisdiction,
          id: this.groupId
        }).then(res => {
          this.$toast("修改成功", "success");
          this.detail.jurisdiction = info.jurisdiction;
        });
      });
    }
  },
  activated() {
    document.title = "管理详情";
    this.loaded = false;
    this.$showLoading();
    /**
     * 获取默认社群信息
     */
    this.groupId = this.$route.query.groupid;
    getTeamDetail({
      id: this.groupId
    }).then(res => {
      this.detail.defaultpic = res.defaultpic;
      this.detail.member = res.member_num;
      this.detail.staus = res.topic_num;
      this.detail.title = res.title;
      this.detail.jurisdiction = res.jurisdiction;
      this.loginUser = res.loginUser;
      this.name = res.name;
      this.oldName = res.name;
      this.loaded = true;
      this.$hideLoading();
    });
  }
};
</script>
<style scoped>
.group-banner {
  height: 11rem;
  background: url(../../assets/group/bg.png) no-repeat center;
  background-size: cover;
  position: relative;
}
.group-header {
  display: flex;
  justify-content: space-between;
  align-items: center;

  background: rgba(0, 0, 0, 0.4);
  color: #fff;
  padding: 10px;
  font-size: 14px;
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
  position: absolute;
  z-index: 9;
  bottom: 0;
  box-sizing: border-box;
  width: 100%;
  color: #fff;
}
.group-detail .group-tit {
  font-size: 16px;
  color: #fff;
  font-weight: 500;
}
.group-staus {
  font-size: 14px;
  color: #fff;
  margin: 10px 0;
}
.group-staus span {
  padding-right: 10px;
}
.group-banner .mask {
  width: 100%;
  z-index: 100;
  height: 100%;
  background-color: black;
  filter: alpha(Opacity=40);
  -moz-opacity: 0.4;
  opacity: 0.4;
  position: absolute;
  top: 0px;
  left: 0px;
  z-index: 8;
}

.group-15 {
  margin-bottom: 15px;
}

.group-input {
  -webkit-appearance: none;
  background-color: #fff;
  background-image: none;
  border-radius: 4px;
  border: 0;
  box-sizing: border-box;
  color: #606266;
  display: inline-block;
  font-size: inherit;
  height: 40px;
  line-height: 40px;
  outline: none;
  padding: 0 15px;
  transition: border-color 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
  width: 100%;
  text-align: right;
  font-size: 14px;
}
</style>
