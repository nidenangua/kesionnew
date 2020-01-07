<template>
  <div class="bg-white" :style="{minHeight:windowHeight+'px'}">
    <ks-page-scroll-container
      class="paper-list"
      v-if="tklist.length"
      :page="p"
      :page-count="pageCount"
      @page-change="getlist"
    >
      <ul>
        <li class="ks-line" v-for="(item,i) in tklist" :key="i" @click="doExerciese(item.paperid)">
          <div class="paper-list__title">{{item.title}}</div>
          <div class="paper-list__p">总分：{{item.sumscore}}分 &nbsp; 时间：{{item.exam_time}}分 &nbsp; &nbsp; 难度：{{item.paper_level}}</div>
          <span>做</span>
        </li>
      </ul>
    </ks-page-scroll-container>
    <ks-empty msg="暂时还未有相关试卷" v-else-if=" !tklist.length && loaded"/>
  </div>
</template>

<script>
import { getIsScrolltolower } from "@/utils";
import { getPaperList } from "@/api/exam";
export default {
  /**试卷列表 */
  name: "PaperList",
  data() {
    return {
      tklist: [],
      windowHeight: window.innerHeight,
      categoryid: this.$route.query.categoryid,
      pageCount: null,
      p: 1,
      loaded: false
    };
  },
  activated() {
    this.categoryid = this.$route.query.categoryid;
    this.getlist();
    document.title = "整卷列表";
  },
  methods: {
    doExerciese(id) {
      this.$router.push({
        path: "/exam/DoExercise",
        query: {
          paperId: id,
          categoryid: this.categoryid
        }
      });
    },
    getlist(p = 1) {
      this.$showLoading();
      this.p = p;
      if (this.p == 1) {
        this.tklist = [];
      }
      getPaperList({
        categoryid: this.categoryid,
        userid: this.$store.state.userInfo.userid
      }).then(res => {
        this.tklist = this.tklist.concat(res.list);
        this.loaded = true;
        this.p = res.page.now_page;
        this.pageCount = res.page.total_pages;
        this.$hideLoading();
      });
    }
  }
};
</script>
<style scoped>
.paper-list {
  padding: 0 10px;
}

.paper-list li {
  font-size: 14px;
  padding: 20px 0;
}
.paper-list__title{
  line-height: 22px;
  max-height: 44px;
  overflow: hidden;
}
.paper-list__p {
  font-size: 12px;
  color: #999;
  margin-top:5px;
}
.paper-list li span {
  border: 1px solid #80c269;
  width: 36px;
  height: 36px;
  line-height: 36px;
  text-align: center;
  color: #80c269;
  border-radius: 50%;
  font-size: 14px;
  position: absolute;
  right: 0;
  top: 50%;
  margin-top: -19px;
}
.bg-white {
  background: #fff;
}
</style>

