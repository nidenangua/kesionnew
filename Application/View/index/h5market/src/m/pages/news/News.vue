<template>
  <div>
    <ks-page-scroll-container
      v-if="list.length"
      :page="p"
      :page-count="pageCount"
      @page-change="getList"
      class="newslist"
    >
      <a class="newslist-item line" @click="open(item.id)" v-for="(item,i) in list" :key="i">
        <div class="img-wrap">
          <img :src="item.defaultpic">
        </div>
        <div class="info">
          <div class="title">{{item.title}}</div>
          <div class="infos">{{item.abstract}}</div>
        </div>
      </a>
    </ks-page-scroll-container>
    <ks-empty msg="暂时没有找到相关的文章~" type="notest" v-else-if="loaded"/>
    <store-footer/>
  </div>
</template>

<script>
import { getIsScrolltolower } from "@/utils";
import { getNews } from "@/api/news";
export default {
  name: "news",
  data() {
    return {
      pageCount: null,
      loaded: false,
      p: 1,
      list: []
    };
  },
  methods: {
    getList(_p = 1) {
      this.$showLoading();
      if (_p == 1) {
        this.list = [];
      }
      getNews({
        p: _p,
        maxperpage: 10
      }).then(res => {
        this.pageCount = res.page.total_pages;
        this.list = this.list.concat(res.list);
        this.loaded = true;
        this.$hideLoading();
      });
    },
    open(id) {
      this.$router.push(`/news/${id}`);
    }
  },
  mounted() {
    this.getList();
  },
  activated() {
    document.title = "新闻";
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.newslist-item {
  display: flex;
  padding: 15px;
  background: #fff;
}
.newslist-item:first-child {
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}
.newslist-item:last-child::after {
  display: none;
}
.newslist-item .img-wrap {
  width: 110px;
  height: 80px;
  margin-right: 10px;
}
.newslist-item .img-wrap img {
  width: 100%;
  height: 100%;
  display: block;
  border-radius: 5px;
}
.newslist-item .info {
  flex: 1;
  overflow: hidden;
  height: 80px;
  position: relative;
}
.newslist-item .info .title {
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  width: 100%;
  font-size: 16px;
  font-weight: bold;
  line-height: 24px;
}
.newslist-item .info .infos {
  width: 100%;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  overflow: hidden;
  font-size: 12px;
  color: #aaa;
  line-height: 1.8;
  margin-top: 10px;
}
</style>
