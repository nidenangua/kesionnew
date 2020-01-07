<template>
  <div v-if="loading">
    <div class="activity-info">
      <img :src="courseInfo.defaultpic" class="activity-cover">
      <div class="activity-info__content">
        <div class="title">课程活动: {{courseInfo.title}}</div>
        <div class="count-price">
          <div class="count">已有 {{courseInfo.json.count_active}}人报名</div>
          <div class="price">￥ {{getMinPrice}}起</div>
        </div>
      </div>
    </div>
    <div>
      <div class="ticket-item">
        <div class="top">
          <span class="title">{{courseInfo.json.content.ticket_info[now_currentTicket].title}}</span>
        </div>
        <div class="ks-line ticket-item__row price">
          <span v-if="courseInfo.json.content.ticket_info[now_currentTicket].chargetype==0">免费</span>
          <span v-else>￥ {{courseInfo.json.content.ticket_info[now_currentTicket].price}}</span>
        </div>
        <div class="ks-line ticket-item__row" v-if="courseInfo.json.setting.is_pledge!=0">
          <span>保证金 (签到后可退) :</span>
          <span class="price">￥{{courseInfo.json.content.ticket_info[now_currentTicket].cash_deposit}}</span>
        </div>
        <div
          class="ks-line ticket-item__row check__row"
          v-if="courseInfo.json.content.ticket_info[now_currentTicket].check==1"
        >
          <span class="flag">审</span>
          <span>报名此票种需要经过主办方审核</span>
        </div>
        <div
          class="ks-line ticket-item__row"
        >售票时间:{{formatTimestamp(courseInfo.json.content.ticket_info[now_currentTicket].order_date[0])}} - {{formatTimestamp(courseInfo.json.content.ticket_info[now_currentTicket].order_date[1])}}</div>
        <div
          class="ks-line ticket-item__row"
          v-if="courseInfo.json.content.ticket_info[now_currentTicket].effective_date_type==1"
        >有效期: {{formatTimestamp(courseInfo.json.content.ticket_info[now_currentTicket].effective_date[0])}} - {{formatTimestamp(courseInfo.json.content.ticket_info[now_currentTicket].effective_date[1])}}</div>
        <div
          class="ticket-item__row"
        >备注说明: {{courseInfo.json.content.ticket_info[now_currentTicket].explain}}</div>
        <div class="select_current">
          <i class="ks-icon ks-icon-checkmark-outline"></i>
        </div>
      </div>
    </div>
    <div class="explain">
      <div class="title">说明</div>
      <div class="explain__row">1 、选择先付保证金, 在活动中签到后需补齐剩余款项, 如未签到, 保证金将不可退;</div>
      <div class="explain__row">2 、选择全额支付, 签到后保证金可退。</div>
    </div>
    <div class="placeholder"></div>
    <div class="pay-way" v-if="courseInfo.json.setting.paymodel==0">
      <ks-button type="primary" width="100%" class="pay-all-btn" @click="paymodel('1')">全额支付</ks-button>
    </div>
    <div class="pay-way" v-else>
      <ks-button type="plain" width="50%" class="pay-pledge-btn" @click="paymodel('0')">先付保证金</ks-button>
      <ks-button type="primary" width="50%" class="pay-all-btn" @click="paymodel('1')">全额支付</ks-button>
    </div>
  </div>
</template>

<script>
import activity_detail from "@/mixins/activity/activity.detail";
export default {
  name: "PayModel",
  mixins: [activity_detail],
  data() {
    return {
      /**当前选中的票 */
      now_currentTicket: -1
    };
  },
  methods: {
    /**选择 全额支付 或者 先付保证金 */
    paymodel(way) {
      if (way == "0") {
        this.$router.push({
          name: "RegistrationForm",
          params: { id: this.$route.params.id },
          query: {
            // ticketIndex: this.now_currentTicket,
            num: this.$route.query.num,
            paymodel: "0",
            ticketIndex:this.$route.query.ticketIndex
          }
        });
      } else if (way == "1") {
        this.$router.push({
          name: "RegistrationForm",
          params: { id: this.$route.params.id },
          query: {
            // ticketIndex: this.now_currentTicket,
            num: this.$route.query.num,
            paymodel: "1",
            ticketIndex:this.$route.query.ticketIndex
          }
        });
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
  margin-bottom: 20px;
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
.ticket-item {
  margin: 0 10px 10px;
  background-color: #ffffff;
  /* min-height: 100px; */
  margin-bottom: 10px;
  border-radius: 5px;
  padding: 15px;
  position: relative;
  overflow: hidden;
  border: 1px solid #e64a3b;
}
.ticket-item .top {
  display: flex;
  justify-content: space-between;
}
.ticket-item .title {
  font-size: 14px;
  font-weight: bold;
}
.ticket-item .price {
  font-size: 14px;
  color: #e64a3b;
  margin-top: 10px;
}
.ticket-item .check {
  width: 0;
  height: 0;
  border-left: 30px solid transparent;
  border-right: 30px solid transparent;
  border-top: 30px solid transparent;
  border-bottom: 30px solid #43b747;
  color: #ffffff;
  position: absolute;
  transform: rotate(-45deg);
  left: -41px;
  top: -33px;
}
.ticket-item .check::after {
  content: "审";
  color: #ffffff;
  position: absolute;
  left: 50%;
  top: 13px;
  transform: translateX(-50%);
  transform: rotate(45deg);
}
.ticket-item .ticket-item__row {
  color: #888888;
}
.ticket-item .price {
  color: #e64a3b;
}
.ticket-item .select_current {
  width: 0;
  height: 0;
  border-left: 30px solid transparent;
  border-right: 30px solid transparent;
  border-top: 30px solid transparent;
  border-bottom: 30px solid #e64a3b;
  color: #ffffff;
  position: absolute;
  top: -42px;
  right: -31px;
  transform: rotate(45deg);
}
.ticket-item .select_current i {
  position: absolute;
  left: 50%;
  top: 13px;
  transform: translateX(-50%);
  transform: rotate(-45deg);
}
.ticket-item .ticket-item__row {
  margin: 0;
  padding: 8px 10px;
}
.ticket-item .check__row .flag {
  background-color: #43b747;
  color: #ffffff;
  padding: 2px;
}
.explain {
  padding: 10px;
}
.explain .title {
  font-size: 14px;
  font-weight: bold;
  margin-bottom: 5px;
}
.explain__row {
  color: #888888;
  line-height: 1.8;
}
.placeholder {
  height: 44px;
}
.pay-way {
  display: flex;
  position: fixed;
  bottom: 0;
  width: 100%;
}
.pay-way .pay-pledge-btn,
.pay-way .pay-all-btn {
  border: none;
  font-weight: normal;
  color: #ffffff;
  border-radius: 0;
}
.pay-way .pay-pledge-btn {
  background-color: #f28550;
}
</style>
