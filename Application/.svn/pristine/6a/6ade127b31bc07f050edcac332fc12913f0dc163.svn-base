<template>
  <div>
    <ks-page-scroll-container
      :page="page"
      :page-count="pageCount"
      class="withdrawals-record"
      @page-change="getList"
      v-if="record.length"
    >
      <div class="withdrawals-record__item line" v-for="item in record" :key="item.id">
        <div class="withdrawals-record__info">
          提现日期：{{item.adddate}}
          <br>
          备注：{{item.mark}}
          <br>提现状态：
          <span class="ks-color-error" v-if="item.status == 0">未到账</span>
          <span class="ks-color-success" v-else>已到账</span>
        </div>
        <div class="withdrawals-record__balance">
          <span class="ks-color-primary">{{item.actualmoney}}</span>提现金额
        </div>
      </div>
    </ks-page-scroll-container>
    <ks-empty msg="没有找到任何提现记录哦~" v-else-if="laoded"></ks-empty>
  </div>
</template>
<script>
import { myDistributeWithdrawalRecord } from "@/api/distribution";
export default {
  name: "WithdrawalsRecord",
  data() {
    return {
      page: 1,
      pageCount: null,
      laoded: false,
      record: []
    };
  },
  methods: {
    getList(_p = 1) {
      this.page = _p;
      if (_p == 1) {
        this.record = [];
      }
      myDistributeWithdrawalRecord({
        p: _p,
        maxperpage: 10
      }).then(res => {
        this.record = this.record.concat(res.list);
        this.pageCount = res.page.total_pages;
        this.laoded = true;
      });
    }
  },
  mounted() {
    this.getList();
  }
};
</script>
<style scoped>
.withdrawals-record__item {
  background: #fff;
  padding: 15px;
  display: flex;
  line-height: 24px;
}
.withdrawals-record__balance {
  flex: 1;
  min-width: 80px;
  line-height: 24px;
  color: #999;
  text-align: right;
}
.withdrawals-record__balance span {
  display: block;
  font-size: 24px;
}
</style>


