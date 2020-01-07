<template>
  <div>
    <kd-search @enter="getList()" :value="key"/>
    <ks-page-scroll-container
      v-if="list.length"
      :page="p"
      :page-count="pageCount"
      @page-change="getList"
    >
      <kd-group :data-list="list"/>
    </ks-page-scroll-container>
    <ks-empty msg="没有找到任何社群~" v-else-if="!list.length && loaded"/>
    <store-footer/>
  </div>
</template>

<script>
import { getIsScrolltolower } from "@/utils";
import { getGroupList } from "@/api/group";

export default {
  name: "GroupIndex",
  data() {
    return {
      loaded: false,
      list: [],
      pageCount: null,
      key: this.$route.query.key,
      p: 1
    };
  },
  watch: {
    "$route.query.key"() {
      this.getList();
    }
  },
  methods: {
    getList(p = 1) {
      this.$showLoading();
      this.key = this.$route.query.key;
      let params = {
        p: p,
        maxperpage: 10,
        data: {
          sql_or_like: {
            status: 1
          }
        }
      };
      if (this.key) {
        params.data.sql_or_like.title = this.key;
      }
      /**
       * 获取社群列表
       */
      getGroupList(params).then(res => {
        if (res && res.list) {
          if (p === 1) {
            this.list = res.list;
          } else {
            this.list = this.list.concat(res.list);
          }
          this.pageCount = res.page.total_pages;
        }
        this.loaded = true;
        this.$hideLoading();
      });
    }
  },
  mounted() {
    this.getList();
  },

  activated() {
    document.title = "社群中心";
    this.$store.ready(state => {
      /**
       * 配置微信分享
       */
      this.$wxShare({
        title: "社群中心",
        desc: "这些社群还不错，你也一起来看看吧",
        imgUrl: state.info.sharepic || state.info.logo
      });
    });
  }
};
</script>
