<template>
  <div v-if="loading">
    <div class="ks-line activity-info">
      <img :src="courseInfo.defaultpic" class="activity-cover">
      <div class="activity-info__content">
        <div class="title">课程活动: {{courseInfo.title}}</div>
        <div class="count-price">
          <div
            class="count"
          >{{formatTimestamp(courseInfo.json.content.ticket_info[currentTickets].order_date[0],"style3")}}</div>
          <div class="price">￥ {{getMinPrice}}起</div>
        </div>
      </div>
    </div>
    <div class="ks-line activity-row user-info">
      <span>{{realname}}</span>
      <span>{{tel}}</span>
    </div>
    <div class="ks-line activity-row" v-if="paymodel=='1'">
      <span>{{courseInfo.json.content.ticket_info[currentTickets].title}}</span>
      <span
        class="price"
      >￥ {{courseInfo.json.content.ticket_info[currentTickets].chargetype==1?courseInfo.json.content.ticket_info[currentTickets].price:0}} {{ticket_num>1?" * "+(+ticket_num)+"张":""}}</span>
    </div>
    <div class="ks-line activity-row" v-if="courseInfo.json.setting.is_pledge==1">
      <span>
        预付保证金
        <span class="gray">( 签到后可线下退 )</span>
      </span>
      <span
        class="price"
      >￥ {{courseInfo.json.content.ticket_info[currentTickets].cash_deposit}} {{ticket_num>1?" * "+(+ticket_num)+"张":""}}</span>
    </div>
    <div class="ks-line activity-row">
      <span>可用优惠券</span>
      <div v-if="vouceherList&&vouceherList.length" style="width:100px;text-align:right;">
        <select v-model="vouceher" class="activity-row-vouceher" @change="vouceherChange">
          <option value="-1">选择优惠券</option>
          <option v-for="(item,i) in vouceherList" :value="i" :key="i">{{parseInt(item.money)}}元优惠券</option>
        </select>
      </div>
      <span v-else>暂无可用优惠券</span>
    </div>
    <div class="ks-line activity-row">
      <span>总计金额</span>
      <span
        class="price"
      >￥ {{totalMoney}}</span>
        <!-- v-if="paymodel=='0'" -->
      <!-- <span
        v-else-if="paymodel=='1' && courseInfo.json.setting.is_pledge==1"
        class="price"
      >￥ {{(courseInfo.json.content.ticket_info[currentTickets].chargetype==1?+courseInfo.json.content.ticket_info[currentTickets].price + +courseInfo.json.content.ticket_info[currentTickets].cash_deposit:+courseInfo.json.content.ticket_info[currentTickets].cash_deposit)*ticket_num - vouceherValue > 0 ? (courseInfo.json.content.ticket_info[currentTickets].chargetype==1?+courseInfo.json.content.ticket_info[currentTickets].price + +courseInfo.json.content.ticket_info[currentTickets].cash_deposit:+courseInfo.json.content.ticket_info[currentTickets].cash_deposit)*ticket_num - vouceherValue : 0}}</span>
      <span
        v-else-if="paymodel=='1' && courseInfo.json.setting.is_pledge==0"
        class="price"
      >￥ {{totalMoney}}</span> -->
    </div>
    <div class="placeholder"></div>
    <ks-button type="primary" width="100%" class="pay-btn" @click="payNow">立即支付</ks-button>
  </div>
</template>

<script>
import activity_detail from "@/mixins/activity/activity.detail";
import { getUserWealth } from "@/api/user";
export default {
  name: "ConfirmTicket",
  mixins: [activity_detail],
  data() {
    return {
      /**姓名 */
      realname: "",
      /**手机号 */
      tel: "",
      /**支付方式(先付保证金||全额) 当payWay为 'payPledge' 时为先付保证金 */
      paymodel: "",
      /**购买票张数 */
      ticket_num: 1,
      /**选中票索引 加了个s */
      currentTickets: -1,
      /**优惠券列表 */
      vouceherList: [],
      /**优惠券id */
      vouceher: -1,
      /**优惠券大小 */
      vouceherValue:0,
      /**折扣信息 */
      discount:{}
    };
  },
  methods: {
    /**立即支付 */
    payNow() {
      this.$showPay({
        id: this.$route.params.id,
        // price: this.courseInfo.json.content.ticket_info[this.currentTickets]
        //   .price,
        price: this.totalMoney,
        type: "activity",
        couponid: this.vouceher!=-1?this.vouceherList[this.vouceher].id:"",
        json: {
          id: this.$route.query.id
        },
        url: `${location.href.split("#")[0]}#/activity/${
          this.$route.params.id
        }/payresult?id=${this.$route.query.id}`
        })
      if(this.totalMoney == 0) {
        let id = this.$route.params.id
        let tickedID = this.$route.query.id
        this.$router.push(`/activity/${id}/payresult?payResult=true&id=${tickedID}&ticketIndex=${this.currentTickets}`) 
      }
    },
    /**优惠券改变时触发 */
    vouceherChange(){
      let ind = this.vouceher;
      if(ind!=-1){
        this.vouceherValue = parseInt(this.vouceherList[ind].money);
        // console.log(this.vouceherList[this.vouceher].id);
      }else{
        this.vouceherValue = 0;
      }
    }
  },
  computed: {
    totalMoney() {
      let money
      if(this.paymodel == 0) {
          money = this.courseInfo.json.content.ticket_info[this.currentTickets].cash_deposit * this.ticket_num - this.vouceherValue
          return money =  money > 0 ? money.toFixed(2) : 0
      }
      if(this.paymodel=='1' && this.courseInfo.json.setting.is_pledge==0){
          money = (this.courseInfo.json.content.ticket_info[this.currentTickets].price)*this.ticket_num - this.vouceherValue
          return money = money > 0 ? money.toFixed(2) : 0
      }
      if(this.paymodel=='1' && this.courseInfo.json.setting.is_pledge==1){
        money = (this.courseInfo.json.content.ticket_info[this.currentTickets].chargetype==1?+this.courseInfo.json.content.ticket_info[this.currentTickets].price + +this.courseInfo.json.content.ticket_info[this.currentTickets].cash_deposit:+this.courseInfo.json.content.ticket_info[this.currentTickets].cash_deposit)*this.ticket_num - this.vouceherValue
        return money = money > 0 ? money.toFixed(2) : 0
      }
    }
  },
};
</script>

<style scoped>
.activity-info {
  padding: 10px;
  display: flex;
  background-color: #ffffff;
}
.activity-cover {
  width: 7rem;
  height: 4.3rem;
  margin-right: 10px;
}
.activity-info__content {
  flex-grow: 1;
  padding-bottom: 10px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.activity-info__content .title {
  font-size: 14px;
}
.activity-info__content .count-price {
  display: flex;
  justify-content: space-between;
}
.activity-info__content .count {
  color: #bebebe;
}
.activity-info__content .price {
  color: #e64a3b;
  font-size: 14px;
}
.activity-row {
  padding: 15px 10px;
  background-color: #ffffff;
  font-size: 14px;
  color: #4b4b4b;
  display: flex;
  justify-content: space-between;
}
.activity-row-vouceher{
  border: none;
  background-color: #ffffff;
}
.user-info {
  margin-bottom: 10px;
}
.activity-row .price {
  color: #e64a3b;
}
.activity-row .coupon {
  color: #999999;
}
.activity-row .gray {
  font-size: 12px;
  font-weight: normal;
  color: #888888;
}
.placeholder {
  height: 44px;
}
.pay-btn {
  width: 100%;
  border-radius: 0;
  position: fixed;
  bottom: 0;
}
</style>

