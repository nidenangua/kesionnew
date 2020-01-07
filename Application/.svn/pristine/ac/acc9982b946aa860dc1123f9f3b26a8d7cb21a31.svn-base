<template>
  <div>
    
    <ks-tabs v-model="type" @tab-click="getlist()">
      <ks-tab-pane label="整卷练习" :name="1"></ks-tab-pane>
      <ks-tab-pane label="随机练习" :name="2"></ks-tab-pane>
    </ks-tabs>

    <ks-page-scroll-container
      v-if="recodeList.length"
      :page="p"
      :page-count="pageCount"
      @page-change="getlist"
    >
      <div class="paper-record">
        <div
          class="paper-record__item"
          :class="i < recodeList.length-1 && 'ks-line'"
          v-for="(item,i) in recodeList"
          :key="i"
          @click="doRecode(item)"
        >
          <div class="paper-record__title" v-if="type==1">
            <span
              class="paper-record__status"
              :class="{iscorrected:item.iscorrect == 1}"
              v-if="type==1"
            >{{(item.iscorrect == 0 && '未批改') || (item.iscorrect == 1 && '已批改')}}</span>
            {{item.title}}
          </div>
          <div class="paper-record__title" v-if="type==2">{{item.type}}</div>
          <div class="paper-record__text">
            <span>{{item.adddate}}</span>
            <span>用时 {{item.time || 0}}</span>
            <span v-if="item.iscorrect == 1">
              正确率
              <font class="accuracy">{{item.accuracy}}%</font>
            </span>
          </div>
        </div>
      </div>
    </ks-page-scroll-container>
    <ks-empty msg="暂无数据~" v-else-if="!recodeList.length && loaded"/>
    <store-footer/>
  </div>
</template>
<script>
import { getExamRecordList, getTestRecordList } from "@/api/exam";
export default {
  name: "",
  data() {
    return {
      p: 1,
      pageCount: null,
      categoryid: this.$route.query.categoryid,
      /**试卷类型 1整卷 2随机 */
      type: 1,
      recodeList: [],
      loaded: false
    };
  },
  methods: {
    getlist(p = 1) {
      let API;
      this.$showLoading();
      this.p = p;
      if (this.p == 1) {
        this.recodeList = [];
      }
      if (this.type == 1) {
        API = getExamRecordList;
      } else {
        API = getTestRecordList;
      }
      API({
        categoryid: this.categoryid,
        p: p
      }).then(res => {
        this.recodeList = this.recodeList.concat(res.list);
        this.pageCount = res.page.total_pages;
        this.loaded = true;
        this.$hideLoading();
      });
    },
    doRecode(arr) {
      this.$router.push({
        path: "/exam/result",
        query: {
          id: arr.id,
          categoryid: this.categoryid,
          type: this.type
        }
      });
    }
  },
  activated() {
    this.pageCount = null;
    this.categoryid = this.$route.query.categoryid;
    this.type = 1;
    this.recodeList = [];
    this.getlist();
    document.title = "做题记录";
  }
};
</script>
<style scoped>
.paper-record {
  padding: 0 10px;
  background: #fff;
}
.paper-record__item {
  padding: 20px 0;
}
.paper-record__title {
  font-size: 14px;
}
.paper-record__text span {
  font-size: 12px;
  color: #97a0ab;
  margin-right: 15px;
}
.paper-record__text .accuracy {
  font-size: 18px;
  color: #5185f7;
}

.paper-record__status {
  display: inline-block;
  padding: 1px 8px;
  font-size: 10px;
  line-height: 16px;
  text-align: center;
  color: #fff;
  border-radius: 3px;
  background: #f58c43;
  margin-right: 5px;
  border-radius: 10px 10px 0 10px;
  position: relative;
  top:-2px;
}
.paper-record__status.iscorrected {
  background: #749efb;
}
</style>