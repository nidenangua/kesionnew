<template>
  <div>
    <kd-search @enter="getList()"/>
    <ks-page-scroll-container
      :page.sync="page"
      :page-count="pageCount"
      @page-change="getList"
      v-if="list.length"
    >
      <div class="data-list">
        <div
          class="data-list__item"
          v-for="(item,index) in list"
          :key="item.id"
          @click="open(item.id)"
          :class="index < list.length-1 && 'ks-line'"
        >
          <data-format class="data-list__format" height="48px" :type="item.type"/>
          <ks-text font-size="14px">{{item.title}}</ks-text>
          <div class="data-list__info clearfix">
            <span class="ks-fr ks-color-info">{{item.down_num}}次下载</span>
            <span
              class="data-list__price ks-color-primary"
              v-if="item.chargetype == 1 && item.price !== '0.00' && $store.state.miniProgramReview === 0"
            >
              <i>¥</i>
              {{item.price}}
            </span>
            <span
              class="data-list__price ks-color-success"
            >免费</span>
          </div>
        </div>
      </div>
    </ks-page-scroll-container>
    <ks-empty msg="暂时没有任何资料~" v-else-if="loaded"/>
    <store-footer/>
  </div>
</template>
<script>
import DataFormat from "./components/DataFormat";
import { getMaterialsList } from "@/api/data";
export default {
  name: "DataList",
  data() {
    return {
      loaded: false,
      page: 1,
      pageCount: null,
      list: []
    };
  },
  methods: {
    getList(page = 1) {
      this.$showLoading();
      if (page == 1) {
        this.list = [];
      }
      getMaterialsList({
        p: page,
        keyword: this.$route.query.key || "",
        maxperpage: 10
      }).then(res => {
        res.list.map(item => {
          let typeMatch = item.file_name.split(".");
          let _type = typeMatch ? typeMatch[typeMatch.length - 1] : "";
          item.type = _type;
        });
        this.list = this.list.concat(res.list);
        this.pageCount = res.page.total_pages;
        this.loaded = true;
        this.$hideLoading();
      });
    },
    open(_id) {
      this.$router.push("/data/" + _id);
    }
  },
  mounted() {
    this.getList();
  },
  activated() {
    document.title = "资料列表";
  },
  components: {
    DataFormat
  }
};
</script>
<style scoped>
.data-list__item {
  background: #fff;
  padding: 15px 20px 15px 85px;
  position: relative;
}
.data-list__title {
  font-size: 16px;
}
.data-list__info {
  margin-top: 5px;
}
.data-list__price {
  font-size: 16px;
}
.data-list__price i {
  font-size: 10px;
  margin-right: 2px;
  font-style: normal;
}
.data-list__format {
  position: absolute;
  left: 20px;
  top: 15px;
}
</style>

