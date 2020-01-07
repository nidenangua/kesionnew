<template>
  <div class="page">
    <div class="deposit">
      <div class="deposit-num">
        <div class="deposit-num__total">
          <p class="deposit-num__total--price">
            <span class="price">￥</span>
            {{total}}
          </p>
          <p class="total">总收入</p>
        </div>
        <div class="deposit-num__maybe">
          <p class="deposit-num__maybe--price">
            <span class="price">￥</span>
            {{withdrawmoney}}
          </p>
          <p class="total">可提现金额</p>
        </div>
      </div>
      <ks-button width="140px" type="success" class="deposit-wx" @click="open(withdrawmoney)">提现到微信</ks-button>
    </div>
    <div class="withdraw">提现记录</div>
    <ks-page-scroll-container :page="page" :page-count="pageCount" @page-change="onPageChange">
      <div class="record" v-for="(item,i) in list" :key="i">
        <div class="record-head">
          <div class="record-head__time">时间：{{item.adddate}}</div>
          <div>
            <span class="applying">
              <a v-if="item.status == 0">已申请</a>
              <a v-if="item.status == 1">已结算</a>
            </span>
            <!-- <span class="success">提现成功</span> -->
          </div>
        </div>
        <div class="record-msg">
          <div class="record-msg__message">
            <div class="record-msg__message--name">用户： {{item.username}}</div>
            <div class="record-msg__message--account">账号： {{item.banknum}}</div>
            <div class="record-msg__message--way">
              提现方式：
              <a v-if="item.paytype == 0">银行卡</a>
              <a v-if="item.paytype == 1">支付宝</a>
              <a v-if="item.paytype == 2">微信</a>
            </div>
          </div>
          <div class="record-msg__price">￥{{item.cmoney}}</div>
        </div>
      </div>
    </ks-page-scroll-container>
  </div>
</template>

<script>
import { cashManage } from "@/api/user";
export default {
  data() {
    return {
      /**分页 */
      page: 1,
      /**总条数 */
      pageCount: 1,
      /**列表数据 */
      list: [],
      withdrawmoney: "0",
      total: "",
      is_real: "3"
    };
  },
  activated() {
    this.getList();
  },
  methods: {
    /**获取列表数据 */
    getList(page = 1) {
      this.page = page;
      cashManage({
        p: page,
        maxperpage: 10
      }).then(res => {
        this.pageCount = res.page.total_pages;
        this.list = page == 1 ? res.list : this.list.concat(res.list);
        this.total = res.total;
        this.withdrawmoney = res.withdrawmoney;
        this.is_real = res.is_real;
      });
    },
    onPageChange(page) {
      this.getList(page);
    },
    //提现跳转
    open(withdrawmoney) {
      if (this.is_real == 3) {
        this.$router.push("/user/extractWay");
      } else if (this.is_real == 2) {
        this.$toast("实名认证审核中，请耐心等待", "success");
      } else if (this.is_real == 1) {
        this.$router.push("/user/extract?money="+withdrawmoney);
      }
    }
  }
};
</script>

<style scoped>
.page {
  background-color: #f7fcff;
  font-size: 14px;
}
.deposit {
  box-shadow: 2px 5px 10px #e3f3fd;
  padding: 15px;
  background-color: #fff;
  text-align: center;
}
.deposit-num {
  display: flex;
}
.deposit-num__total,
.deposit-num__maybe {
  width: 50%;
  text-align: center;
  height: 70px;
}
.deposit-num__total {
  border-right: 0.5px solid #c3c3c3;
}
.deposit-wx {
  margin-top: 20px;
}
.deposit-num__total--price {
  margin: 10px 0;
  color: #37a7ed;
  font-size: 16px;
}
.deposit-num__maybe--price {
  margin: 10px 0;
  color: #e85a4d;
  font-size: 18px;
}
.price {
  font-size: 14px;
}
.total {
  font-size: 14px;
}
.withdraw {
  font-size: 14px;
  padding: 15px 8px;
}
.record {
  padding: 0 8px;
  background-color: #fff;
  box-shadow: 2px 5px 10px #e3f3fd;
}
.record-head {
  display: flex;
  padding: 5px 0;
  justify-content: space-between;
}
.record-head__time {
  color: #888888;
  font-size: 14px;
}
.applying {
  color: #e85a4d;
}
.success {
  color: #37a7ed;
}
.record-msg {
  display: flex;
  justify-content: space-between;
  padding-left: 10px;
  padding-top: 5px;
  margin-bottom: 5px;
}
.record-msg__message div {
  margin-bottom: 5px;
}
.record-msg__price {
  line-height: 63px;
  color: #e85a4d;
}
</style>
