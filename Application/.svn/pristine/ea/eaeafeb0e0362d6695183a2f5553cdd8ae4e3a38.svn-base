<template>
  <div>
    <div class="news-detail">
      <div class="title">{{newsInfo.title}}</div>
      <div class="time">{{newsInfo.inputer}} &nbsp;&nbsp; {{newsInfo.adddate}}</div>
      <div class="ks-content ks-pt15" v-html="newsInfo.content" ref="content"></div>
      <div class="hits">阅读 {{newsInfo.hits}}</div>
    </div>
    <comment class="news-comment" :comment-switch="true" appid="101" :info-id="infoId" v-if="flag"/>
    <store-footer/>
  </div>
</template>
<script>
import Comment from "../comment/Comment";
import { newsDetail } from "@/api/news";
export default {
  name: "NewsContent",
  data() {
    return {
      infoId: this.$route.params.id,
      newsInfo: {},
      flag:false
    };
  },
  activated() {
    this.$showLoading();
    this.flag = true
    document.title = "";
    this.infoId = this.$route.params.id;
    newsDetail({
      id: this.infoId
    }).then(res => {
      this.newsInfo = res;
      document.title = res.title;
      this.$nextTick(() => {
        let tables = this.$refs.content.querySelectorAll('table');
        for(let t=0;t<tables.length;t++){
          tables[t].outerHTML =  `<div style="overflow-x:auto;over-flow:hidden;">${tables[t].outerHTML}</div>`
        }
        this.$setPreview(this.$refs.content);
      });
      this.$hideLoading();
    });
  },
  deactivated() {
    this.flag = false
  },
  components: {
    Comment
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.news-detail {
  padding: 20px;
  background: #fff;
}
.news-detail .title {
  font-size: 22px;
  line-height: 32px;
  font-weight: bold;
}
.news-detail .time {
  font-size: 12px;
  color: #aaa;
  margin-top: 10px;
}
.news-detail .content {
  margin-top: 30px;
}
.news-detail .hits {
  font-size: 14px;
  color: rgb(191, 188, 188);
  display: flex;
}
.news-comment {
  margin-top: 10px;
  background: #fff;
  padding: 10px 15px;
}
</style>
