<template>
  <ks-container v-if="loaded">
    <el-breadcrumb class="line">
      <el-breadcrumb-item>
        <router-link to="/?url=/home.html/team/Index?appid-35">社群管理</router-link>
      </el-breadcrumb-item>
      <el-breadcrumb-item>管理社群</el-breadcrumb-item>
    </el-breadcrumb>
    <div class="group-detail">
      <ks-create-bg class="group-img" :src="detail.defaultpic"/>
      <div class="group-txt">
        <div class="group-tit">{{detail.title || '社群标题'}}</div>
        <div class="group-join">{{detail.description || '未填写社群描述'}}</div>
        <div class="group-staus">
          <span>学员共{{detail.member_num || 0}}人</span> 丨
          <span>帖子共{{detail.topic_num || 0}}篇</span>
        </div>
      </div>
      <div class="group-right">
        <div class="group-name group-pd">是否开放社群</div>
        <div class="group-name">
          <el-switch
            v-model="groupSwitch"
            @change="setStatue"
            :active-color="$store.state.switch_on"
            :inactive-color="$store.state.switch_off"
            active-value="1"
            inactive-value="2"
          ></el-switch>
        </div>
      </div>
      <div class="group-code">
        <el-dropdown>
          <span class="el-dropdown-link">
            <img src="@/assets/group/code.png">
          </span>
          <el-dropdown-menu slot="dropdown">
            <img
              src="https://443001742.ketangjie.com/Images/QRcode/weimenhueb800a4f72d34e8d892c2c85445cf324.png"
            >
          </el-dropdown-menu>
        </el-dropdown>
      </div>
    </div>
    <div class="ks-mt25">
      <el-tabs v-model="tabActiveName" type="card" @tab-click="handleClick">
        <el-tab-pane label="动态列表" name="topList">
          <top-list v-if="loadTopList"/>
        </el-tab-pane>
        <el-tab-pane label="成员列表" name="memberList">
          <member-list v-if="loadMemberList"/>
        </el-tab-pane>
        <el-tab-pane label="动态公告" name="noticList">
          <top-list :datatype="1" v-if="loadNotic"/>
        </el-tab-pane>
        <el-tab-pane label="申请名单" name="application">
          <apply-list v-if="loadAppList"/>
        </el-tab-pane>
      </el-tabs>
    </div>
  </ks-container>
</template>
<script>
import { checkModuleHasOpen } from "@/api/store";
import { getTeamDetail, updateStatus } from "@/api/group";
import TopList from "./TopList";
import MemberList from "./MemberList";
import ApplyList from "./ApplyList";
export default {
  name: "StoreSetup",
  data() {
    return {
      /**
       * 接口加载加载
       */
      loaded: false,
      /**
       * 加载模块开关（按需）
       */
      loadTopList: false,
      loadMemberList: false,
      loadNotic: false,
      loadAppList: false,
      /**
       * 社群开关 1开启 2关闭
       */
      groupSwitch: 0,
      /**
       * 当前选项卡选中信息
       */
      tabActiveName: "",
      /**
       * 社群信息
       */
      grouopId: this.$route.params.id,
      detail: {}
    };
  },

  methods: {
    /**
     * 模块加载
     */
    loadModel() {
      let action = this.$route.query.action || "topList";
      this.tabActiveName = action;
      switch (action) {
        case "topList":
          this.loadTopList = true;
          break;
        case "memberList":
          this.loadMemberList = true;
          break;
        case "noticList":
          this.loadNotic = true;
          break;
        case "application":
          this.loadAppList = true;
          break;
      }
    },
    /**
     * 选项卡变化
     */
    handleClick() {
      this.$router.push({
        name: "GroupDetail",
        query: {
          action: this.tabActiveName
        }
      });
      this.loadModel();
    },

    /**
     * 关闭信息
     * type 1 社群 2动态 3组员
     */
    setStatue() {
      updateStatus({
        type: 1,
        id: this.grouopId
      }).then(res => {
        //...
      });
    }
  },
  activated() {
    /**
     * 数据初始化
     */
    this.loaded = false;
    this.loadTopList = false;
    this.loadMemberList = false;
    this.loadNotic = false;
    this.loadAppList = false;
    this.groupSwitch = 0;
    this.grouopId = this.$route.params.id;
    this.detail = {};
    this.$showLoading();
    /**
     * 获取社群详情
     */
    getTeamDetail({
      id: this.grouopId
    }).then(res => {
      if (res.result === "error") {
        this.$msg(res.msg);
      } else {
        this.detail = res;
        this.groupSwitch = res.status;
      }
      this.loaded = true;
      this.$hideLoading();
    });
    this.loadModel();
  },
  components: {
    TopList,
    MemberList,
    ApplyList
  }
};
</script>
<style scoped>
.group-detail {
  padding: 20px;
  border: 1px solid #eee;
  margin-top: 20px;
  border-radius: 2px;
  position: relative;
  padding-left: 155px;
  min-height: 120px;
}
.group-detail .group-img {
  width: 120px;
  height: 120px;
  border-radius: 2px;
  position: absolute;
  left: 20px;
  background-size: cover;
  background-repeat: no-repeat;
}
.group-tit {
  font-size: 18px;
}
.group-join {
  font-size: 14px;
  color: #999;
  margin-top: 5px;
}
.group-staus {
  margin-top: 15px;
}

.group-staus {
  font-size: 14px;
  color: #999;
}
.group-right {
  position: absolute;
  right: 20px;
  top: 20px;
}
.group-name {
  display: inline-block;
}
.group-code {
  position: absolute;
  right: 20px;
  bottom: 20px;
}
.group-code img {
  width: 18px;
  height: 18px;
}
.group-pd {
  padding-right: 10px;
  position: relative;
  top: 2px;
}
</style>
<style>
body .el-table__header tr th {
  background: #f6f7fb;
}
body .el-tab-pane {
  padding: 0;
}
.el-table__empty-text {
  text-align: center;
  padding: 180px 0px 40px 0px;
  color: #ccc;
  font-size: 14px;
  background: url(../../assets/group/empty.png) center 45px no-repeat;
}
</style>



