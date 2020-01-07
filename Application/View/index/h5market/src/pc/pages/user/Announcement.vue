<template>
  <div class="announcement">
    <!-- 头部分页区 -->
    <div class="announcement-top">
      <h1>消息公告</h1>
      <div class="announcement-top__box">
        <div class="announcement-top__tab">
          <!-- <span :class="{active:tab==0}" @click="showTab(0)">消息</span> -->
          <span :class="{active:tab==1}" @click="showTab(1)">公告</span>
        </div>
      </div>
    </div>
    <!-- 内容区 -->
    <el-collapse v-model="activeNames" v-if="reload">
      <el-collapse-item :name="i" v-for="(item,i) in list" :key="i">
        <template slot="title">
          <div class="announcement-item" @click="getNoticeDetail(item)">
            <span class="fl">{{item.title}}</span>
            <i class="fr">{{item.adddate}}</i>
          </div>
        </template>
        <div class="ks-ml20 ks-mr20" id="noticeDetail">{{item.noticeDetail}}</div>
      </el-collapse-item>
    </el-collapse>
    <div style="text-align: center;">
      <el-pagination
        background
        layout="prev, pager, next"
        :total="pageCount"
        @current-change="getNoticeList"
        v-if="pageCount>0"
      />
      <ks-empty msg="该分类下暂无消息公告" v-else />
    </div>
  </div>
</template>

<script>
import { getNoticeList, getNoticeDetail } from "@/api/user";
export default {
  name: "Announcement",
  data() {
    return {
      reload: true,
      tab: 0, //默认消息
      activeNames: [],
      list: [],
      noticeDetail: "",
      pageCount: null
    };
  },
  methods: {
    /*
     * 切换分页
     *
     * */
    showTab(i) {
      this.tab = i;
    },
    handleChange(i) {
      console.log(i);
    },
    /*
     * 获取公告列表
     *
     * */
    getNoticeList() {
      this.$showLoading("#user");
      getNoticeList({
        p: 1,
        maxperpage: 10
      }).then(res => {
        console.log(res);
        res.list.map(item => {
          item.noticeDetail = "";
          item.loaded = false;
        });
        this.list = res.list;
        this.pageCount = res.page.total_pages * 10;
        this.$hideLoading("#user");
      });
    },
    /*
     * 获取公告详情
     *
     * */
    getNoticeDetail(item) {
      if (item.noticeDetail == "") {
        this.$showLoading("#noticeDetail");
        getNoticeDetail({
          id: item.id
        }).then(res => {
          console.log(res);
          if (res.result == "success") {
            item.noticeDetail = res.detail.content;
            item.loaded = true;
            this.$hideLoading("#noticeDetail");
          }
        });
      }
    }
  },

  mounted() {
    this.getNoticeList();
  }
};
</script>

<style scoped>
.announcement {
  width: 100%;
}
.announcement-top {
  width: 100%;
  border-bottom: 1px solid #eee;
}
.announcement-top h1 {
  font-size: 20px;
  color: #2d3336;
  font-weight: 400;
  padding: 21px 24px;
}
.announcement-top__box {
  height: 44px;
  width: 100%;
  position: relative;
}
.announcement-top__tab {
  height: 44px;
  line-height: 44px;
  position: absolute;
  top: 0;
  left: 0;
}
.announcement-top__tab span {
  display: inline-block;
  min-width: 64px;
  height: 100%;
  text-align: center;
  margin-left: 40px;
  font-size: 16px;
  color: #585e61;
  cursor: pointer;
}
.announcement-top__tab i {
  display: inline-block;
  width: 1px;
  height: 20px;
  background: #ddd;
  margin-left: 40px;
  margin-bottom: -5px;
}
.active {
  border-bottom: 2px solid #2e84ee;
  color: #2e84ee !important;
}
/* 内容区 */
.announcement-list {
  padding: 0 20px 30px 20px;
}
.announcement-list__item {
  width: 100%;
  height: 48px;
  background: rgba(255, 255, 255, 1);
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.05);
  border-radius: 4px;
  margin-top: 10px;
  line-height: 48px;
}
.announcement-list__item h2 {
  font-size: 14px;
  color: #585e61;
  font-weight: 400;
  margin-left: 20px;
  float: left;
}
.announcement-list__item p {
  font-size: 14px;
  color: #929a9e;
  float: right;
  margin-right: 20px;
}
.el-collapse {
  padding: 0 20px 30px 20px;
  border: none;
}
.el-collapse-item {
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.05);
  margin-top: 10px;
}
.template {
  width: 100%;
  height: 48px;
  background: rgba(255, 255, 255, 1);

  border-radius: 4px;
  margin-top: 10px;
  line-height: 48px;
  font-size: 14px;
}
.announcement-item {
  width: 100%;
  height: 100%;
}
.fr {
  width: 120px;
  display: inline-block;
  float: right;
  text-align: right;
  font-style: normal;
  color: #929a9e;
  margin-right: 10px;
}
.fl {
  width: calc(100% - 150px);
  display: inline-block;
  float: left;
  margin-left: 20px;
  color: #585e61;
}
.ks-ml20 {
  margin-left: 20px;
  color: #929a9e;
}
.ks-mr20 {
  margin-right: 20px;
}
</style>
