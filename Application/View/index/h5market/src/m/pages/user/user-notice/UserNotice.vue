<template>
  <div>
    <ks-tabs v-model="tabActive" @tab-click="slideTab">
      <ks-tab-pane label="公告" :name="1" :info="noticeNum"></ks-tab-pane>
      <ks-tab-pane label="消息" :name="0" :info="informationNum"></ks-tab-pane>
    </ks-tabs>
    <ks-page-scroll-container
      class="myMsg-list"
      v-if="list.length"
      :page="p"
      :page-count="pageCount"
      @page-change="getList"
    >
      <ul>
        <li
          class="myMsg-lstbox"
          v-for="(item, i) in list"
          :key="i"
          @click="getDetail(item)"
          :class="{'isread':item.isread}"
        >
          <div class="myMsg-title" :class="current_id == item.id && 'active'">
            <span class="myMsg-time">{{item.adddate}}</span>
            {{item.title}}
            <i class="myicon"></i>
          </div>
          <div class="myMsg-content" v-show="current_id == item.id && flag" v-html="item.content"></div>
        </li>
      </ul>
    </ks-page-scroll-container>

    <ks-empty type="nomessage" msg="还没有任何消息呢~" v-else-if="loaded"/>

    <store-footer/>
  </div>
</template>

<script>
import { filterHtml } from "@/utils";
import {
  getMessageNum,
  getInformationList,
  getNoticeList,
  getNoticeDetail,
  getInformationDetail
} from "@/api/user";
export default {
  name: "vouceher",
  data() {
    return {
      flag:false,
      list: [],
      loaded: false,
      current_id: 0,
      p: 1,
      tabActive: 1,
      pageCount: null,
      informationNum: 0,
      noticeNum: 0
    };
  },
  methods: {
    /**
     * 选项卡切换回调
     */
    slideTab(tab) {
      this.current_id = 0;
      this.pageCount = null;
      this.loaded = false;
      this.getList();
    },
    /**
     * 获取数据列表
     */
    getList(p = 1) {
      this.$showLoading();
      this.p = p;
      if (p == 1) {
        this.list = [];
      }
      let api = this.tabActive == 0 ? getInformationList : getNoticeList;
      api({
        p: this.p,
        maxperpage: 15
      }).then(res => {
        let list = res.list;
        list.map(item => {
          item.content = "";
          item.getDetail = false;
        });
        this.list = this.list.concat(list);
        this.pageCount = res.page.total_pages;
        this.loaded = true;
        this.$hideLoading();
      });
    },
    getDetail(item) {
      if(this.current_id == item.id) {
        this.flag = !this.flag
      }else {
        this.flag = true
      }
      if (item.getDetail) {
        this.current_id = item.id;
      } else {
        item.getDetail = true;
        let api = this.tabActive == 0 ? getInformationDetail : getNoticeDetail;
        api({
          id: item.id
        }).then(res => {
          if (res.result === "success") {
            if (item.isread == 0) {
              if (this.tabActive == 0) {
                this.informationNum--;
              } else {
                this.noticeNum--;
              }
              item.isread = 1;
            }
            item.content = filterHtml(res.detail.content);
            this.current_id = item.id;
          }
        });
      }
    }
  },

  activated() {
    document.title = "消息";
    this.getList();
    getMessageNum().then(res => {
      if (res.result === "success") {
        this.informationNum = res.informationNum;
        this.noticeNum = res.noticeNum;
      }
    });
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style scoped>
.myMsg-list {
  padding: 10px;
}
.myMsg-title {
  line-height: 22px;
  font-size: 14px;
}
.myMsg-time {
  float: right;
  font-size: 12px;
  color: #999;
  padding: 0 15px 0 10px;
}
.myMsg-lstbox {
  background: #fff;
  position: relative;
  padding: 15px;
  margin-bottom: 10px;
  font-size: 12px;
  border-radius: 4px;
  position: relative;
}

.myMsg-time span {
  height: 16px;
  margin-top: -4px;
}
.myMsg-lstbox .myicon {
  background: url("../../../assets/user/down.png") no-repeat right 0;
  background-size: 16px 16px;
  color: #999;
  display: block;
  width: 20px;
  height: 20px;
  position: absolute;
  right: 10px;
  top: 19px;
  transition: all 0s ease-in;
}
.active .myicon {
  transform: rotateX(180deg);
  top: 14px;
}
.isread,
.isread .active {
  color: #999;
}

.myMsg-content {
  line-height: 1.6;
  font-size: 14px;
  color: #999;
  padding: 5px 0;
}
</style>
