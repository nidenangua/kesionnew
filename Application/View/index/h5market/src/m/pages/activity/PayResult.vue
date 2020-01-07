<template>
  <div class="ks-bg-white result" v-if="loading">
    <div class="ks-text-center result-container">
      <div class="checkmark" :class="payResult?'':'checkmark__fail'">
        <i class="ks-icon" :class="payResult?'ks-icon-checkmark-circle-':'ks-icon-alert-circle'"></i>
      </div>
      <div class="ks-fz16 title" v-if="$route.query.status == 0">等待审核</div>
      <div class="ks-fz16 title" v-else>{{payResult?"报名成功":"支付失败"}}</div>
      <template v-if="payResult">
        <div class="ks-color-info ks-fz14 gray">
          <span>您购买的票种为</span>
          <span class="ticket-cate">{{detail.ticket_info.title}}</span>
        </div>
        <div class="ks-color-info ks-fz14 gray">
          <span>有效期为:</span>
          <span>{{formatTimestamp(detail.ticket_info.effective_date[0])}}-{{formatTimestamp(detail.ticket_info.effective_date[1])}}</span>
        </div>
      </template>
      <div class="ks-color-info ks-fz14 gray" :class="payResult?'':'gray__fail'" v-else>
        支付出现问题, 您可以选择继续支付, 或者到
        <span class="nopay">未支付订单</span>页面完成支付
      </div>
      <ks-button
        type="success"
        width="100%"
        class="ks-mt20 success-btn"
        @click="checkTicket"
        v-if="$route.query.status !=0"
      >{{payResult?"查看票券":"继续支付"}}</ks-button>
      <ks-button
        v-if="$route.query.miniprogram != 1"
        width="100%"
        class="ks-mt20 back-btn"
        @click="backHomePage"
      >{{payResult?"查看活动详情":"返回首页"}}</ks-button>
    </div>
    <store-footer class="footer"/>
  </div>
</template>

<script>
import { getTicketDetail } from "@/api/microportal";
export default {
  name: "PayResult",
  data() {
    return {
      loading: false,
      /**判断支付成功还是失败 */
      payResult: true,
      /**票券详情 */
      detail: null,
      /**票是否审核 */
      status:''
    };
  },
  computed: {
    /**格式化时间 */
    formatTimestamp() {
      /**
       * @param {Number} 时间戳
       * @param {String} 需要返回的格式
       */
      return function(time) {
        let data = new Date(parseInt(time));
        let y = data.getFullYear();
        let m = data.getMonth() + 1;
        let d = data.getDate();
        let h = data.getHours();
        let mm = data.getMinutes();
        m = m < 10 ? "0" + m : m;
        d = d < 10 ? "0" + d : d;
        h = h < 10 ? "0" + h : h;
        mm = mm < 10 ? "0" + mm : mm;
        return y + "." + m + "." + d + " " + h + ":" + mm;
      };
    }
  },
  activated() {
    document.title = "报名结果"
    this.status = this.$route.params.status
    this.loading = false;
    getTicketDetail({ id: this.$route.query.id }).then(res => {
      if ((res.result = "success")) {
        this.detail = res.detail;
        if (res.detail.ticket_info.chargetype == 0) {
          this.payResult = true;
        } else {
          if (res.detail.status == 3 || res.detail.status == 1) {
            this.payResult = true;
          } else {
            this.payResult = false;
          }
        }
        this.loading = true;
      }
    });
  },
  methods: {
    /**查看票券或继续支付 */
    checkTicket() {
      if (this.payResult) {
        this.$router.push({
          name: "CheckTickets",
          params: { id: this.activityId },
          query: { id: this.$route.query.id }
        });
      } else {
        console.log("继续支付");
      }
    },
    /**查看活动详情或返回首页 */
    backHomePage() {
      if (this.payResult) {
        this.$router.push({ name: "ActivityDetail" });
      } else {
        this.$router.push('/')
      }
    }
  }
};
</script>

<style scoped>
.result {
  min-height: 100vh;
}
.result-container {
  padding: 15px;
}
.checkmark {
  padding-top: 50px;
}
.checkmark i {
  font-size: 100px;
  color: #09bb07;
}
.checkmark__fail i {
  color: #f76260;
}

.title {
  color: #000;
  line-height: 2;
}
.gray {
  line-height: 2;
}
.gray__fail {
  padding: 0 50px;
}
.ticket-cate {
  color: #09bb07;
}
.nopay {
  color: #576b95;
}
.success-btn {
  font-weight: normal;
  background-color: #09bb07;
}
.back-btn {
  font-weight: normal;
  color: #000;
  background-color: #fbfafc;
  border-color: #d6d5d6;
}
.footer {
  margin-top: 100px;
}
</style>
