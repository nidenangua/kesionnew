<template>
  <div>
    <store-info v-if="$route.query.miniprogram != 1"/>
    <ks-page-scroll-container
      :pagination="false"
      :page="page"
      :page-count="pageCount"
      class="voucher-list"
      v-if="list.length > 0"
      @page-change="getList"
    >
      <vouceher-item :item="item" v-for="(item,i) in list" :key="i"/>
    </ks-page-scroll-container>
    <ks-empty msg="没有找到相关优惠券~" type="nocoupon" v-else-if="loaded"/>
  </div>
</template>

<script>
import VouceherItem from "./VouceherItem";
import { getVoucherList } from "@/api/store";
export default {
  name: "vouceher",
  data() {
    return {
      list: [],
      page: 1,
      pageCount: null,
      loaded: false
    };
  },
  methods: {
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
      let params = {
        p: p,
        maxperpage: 10
      };
      let _id = this.$route.query.id;
      if (_id) {
        params.id = _id;
      }
      getVoucherList(params).then(res => {
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
  activated() {
    document.title = "领取优惠券";
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
