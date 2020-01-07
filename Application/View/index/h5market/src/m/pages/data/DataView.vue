<template>
  <div class="data-view" v-if="loaded">
    <div class="data-view__format">
      <data-format :type="detail.type" height="80px"/>
      资料大小：{{detail.size || '未知'}}
    </div>
    <ks-form>
      <ks-form-item label="资料名称">
        {{detail.title}}
        <span
          class="ks-tag"
          style="position: relative;top: -3px;"
          v-if="detail.chargetype == 1 && detail.isbuy == 1"
        >已购买</span>
      </ks-form-item>
      <ks-form-item label="下载次数">{{detail.down_num}}</ks-form-item>
      <ks-form-item label="资料介绍">{{detail.intro || '暂无介绍'}}</ks-form-item>
      <ks-form-item label="价格">
        <span
          class="ks-color-primary ks-fz18 data-view__price"
          v-if="detail.chargetype == 1 && detail.price !== '0.00'"
        >
          <i>¥</i>
          {{detail.price}}
        </span>
        <span class="ks-color-success" v-else>免费</span>
      </ks-form-item>
    </ks-form>
    <div class="data-view__download">
      <ks-button width="100%" @click="download" type="success" v-if="detail.isCanDownload">下载资料</ks-button>
      <ks-button width="100%" @click="buyData" type="primary" v-else>购买资料</ks-button>
    </div>
    <store-footer/>
  </div>
</template>
<script>
import DataFormat from "./components/DataFormat";
import { getMaterialsDetail, getDownPath } from "@/api/data";
export default {
  name: "DataView",
  data() {
    return {
      loaded: false,
      detail: {}
    };
  },
  methods: {
    /**
     * 下载
     */
    download() {
      getDownPath({
        id: this.$route.params.id
      }).then(res => {
        if (res.result === "success") {
          location.href = res.file_path;
        }
      });
    },
    /**
     * 购买资料
     */
    buyData() {
      this.$showPay({
        payid: this.$route.params.id,
        price: this.detail.price,
        msg: "购买资料",
        type: "data"
      });
    }
  },
  activated() {
    this.$showLoading();
    this.loaded = false;
    this.detail = {};
    getMaterialsDetail({
      id: this.$route.params.id
    }).then(res => {
      if (res.result === "success") {
        if (
          res.detail.isbuy == 1 ||
          res.detail.chargetype == 0 ||
          res.detail.price === "0.00"
        ) {
          res.detail.isCanDownload = true;
        } else {
          res.detail.isCanDownload = false;
        }
        let typeMatch = res.detail.file_name.split(".");
        let _type = typeMatch ? typeMatch[typeMatch.length - 1] : "";
        res.detail.type = _type;
        this.detail = res.detail;
        this.loaded = true;
        this.$hideLoading();
      }
    });
  },
  components: {
    DataFormat
  }
};
</script>
<style scoped>
.data-view__format {
  padding: 2rem 0;
  box-sizing: border-box;
  background: url(../../assets/data/bg-blurry.jpg) no-repeat;
  background-size: cover;
  text-align: center;
  color: #fff;
  font-size: 14px;
  line-height: 28px;
}
.data-view__price i {
  font-style: normal;
  font-size: 10px;
  margin-right: 2px;
}
.data-view__download {
  text-align: center;
  margin-top: 20px;
  padding: 0 20px;
}
</style>
