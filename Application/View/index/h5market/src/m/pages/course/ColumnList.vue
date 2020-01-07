<template>
  <div>
    <kd-search @enter="goSearch"/>
    <div v-if="list.length">
      <kd-course data-type="column" :data-list="list"/>
      <div class="ks-nomore" v-if="pageCount !== null && params.p >= pageCount">没有更多课程了~</div>
      <div class="ks-nomore" v-else>上拉加载更多</div>
    </div>
    <ks-empty msg="没有找到任何专栏~" type="nogift" v-else-if="loaded"/>
    <store-footer/>
  </div>
</template>

<script>
import { getColumnList } from "@/api/course";
import { getIsScrolltolower } from "@/utils";
export default {
  name: "ColumnList",
  data() {
    return {
      loaded: false,
      pageCount: null,
      params: {
        p: 1,
        maxperpage: 10,
        data: {
          sql_or_like: {
            title: ""
          }
        }
      },
      list: []
    };
  },
  methods: {
    /**
     * 搜索
     * @param {String} 搜索关键词
     */
    goSearch(key) {
      this.params.data.sql_or_like.title = key;
      this.resetParams();
      this.getList();
    },
    /**
     * 重置参数
     */
    resetParams(params) {
      params = params || {};
      this.pageCount = params.pageCount || null;
      this.params.p = params.p || 1;
      this.list = params.list || [];
    },
    /**
     * 获取数据列表
     */
    getList() {
      this.$showLoading();
      getColumnList(this.params).then(res => {
        this.pageCount = res.page.total_pages;
        this.list = this.list.length ? this.list.concat(res.list) : res.list;
        this.loaded = true;
        this.$hideLoading();
      });
      
    }
  },
  activated() {
    document.title = "专栏";
    this.$store.ready(state => {
      this.$wxShare({
        title: "专栏列表",
        desc: "这些专栏还不错，你也一起来看看吧",
        imgUrl: state.info.sharepic || state.info.logo
      });
    });
  },
  mounted() {
    this.getList();
    window.addEventListener("scroll", e => {
      let scrollFlag = getIsScrolltolower();
      if (scrollFlag && this.params.p < this.pageCount) {
        this.params.p++;
        this.getList();
      }
    });
  }
};
</script>

