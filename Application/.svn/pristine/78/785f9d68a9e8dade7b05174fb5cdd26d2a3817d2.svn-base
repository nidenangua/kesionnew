<template>
  <div>
    <ks-tab :tab-info="tab" @change="slideTab"/>
    <ks-page-scroll-container
      :page="page"
      :page-count="pageCount"
      class="voucher-list"
      v-if="list.length > 0"
      @page-change="getList"
    >
      <vouceherItem v-for="(item,i) in list" :item="item" item-type="use" :key="i"/>
    </ks-page-scroll-container>
    <ks-empty msg="没有找到相关优惠券~" type="nocoupon" v-else-if="loaded"/>
  </div>
</template>

<script>
import VouceherItem from "./VouceherItem";
import { getUserVouceher } from "@/api/user";
export default {
  name: "vouceher",
  data() {
    return {
      list: [],
      type: 0,
      tab: {
        current: 0,
        options: ["全部", "已过期"],
        values: [0, 3]
      },
      page: 1,
      pageCount: null,
      loaded: false
    };
  },
  methods: {
    /**
     * 选项卡切换
     */
    slideTab(val) {
      this.type = val;
      this.getList();
    },
    /**
     * 获取优惠券列表
     */
    getList(p = 1) {
      this.$showLoading();
      this.page = p;
      this.loaded = false;
      if (p == 1) {
        this.list = [];
      }
      getUserVouceher({
        type: this.type,
        p: p,
        maxperpage: 10
      }).then(res => {
        res.list.map(item => {
          item.money = parseFloat(item.money).toString();
        });
        this.list = this.list.concat(res.list);
        this.pageCount = res.page.total_pages;
        this.loaded = true;
        this.$hideLoading();
      });
    }
  },

  mounted() {
    
  },
  activated() {
    document.title = "我的优惠券";
    this.getList();
  },
  components: {
    VouceherItem
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.voucher-list {
  padding: 15px;
}
</style>
