<template>
  <div v-if="loading">
    <div class="ks-bg-white activity-info">
      <img :src="courseInfo.defaultpic" class="activity-cover">
      <div class="activity-info__content">
        <div class="ks-fz14">课程活动: {{courseInfo.title}}</div>
        <div class="count-price">
          <div class="count">已有 {{courseInfo.json.count_active}}人报名</div>
          <!-- <div class="ks-fz14 price">￥ {{getPrice(courseInfo)}}起</div> -->
          <div class="ks-fz14 price">￥ {{courseInfo.json.min_price}}起</div>
        </div>
      </div>
    </div>
    <div>
      <div v-for="(item,index) in courseInfo.json.content.ticket_info" :key="index">
        <div class="ticket-item" v-if="currentTicket!=index || item.order_date[0] > time || item.residue == 0" @click="selectTicket(index)">
          <div class="top">
            <span class="title">{{item.title}}</span>
            <span class="state__stop-robbing" v-if="item.status==0 && item.residue!=0">未开始</span>
            <span class="state__robbing" v-else-if="item.status==1 && item.residue!=0">抢票中</span>
            <span class="state__stop-robbing" v-else>已停售</span>
          </div>
            <span v-if="item.status==0 && item.residue!=0" class="order-date">售票时间:{{formatTimestamp(item.order_date[0])}} - {{formatTimestamp(item.order_date[1])}}</span>
          <div class="price">
            <span v-if="item.chargetype==0">免费</span>
            <span v-else>￥ {{item.price}}</span>
          </div>
          <div class="check" v-if="item.check==1"></div>
        </div>
        <div class="ticket-item ticket-item__select" v-else>
          <div class="top">
            <span class="title">{{item.title}}</span>
          </div>
          <div class="ks-line ticket-item__row price">
            <span v-if="item.chargetype==0">免费</span>
            <span v-else>￥ {{item.price}}</span>
          </div>
          <div class="ks-line ticket-item__row" v-if="courseInfo.json.setting.is_pledge!=0">
            <span>保证金 (签到后可退) :</span>
            <span class="price">￥{{item.cash_deposit}}</span>
          </div>
          <div class="ks-line ticket-item__row check__row" v-if="item.check==1">
            <span class="flag">审</span>
            <span>报名此票种需要经过主办方审核</span>
          </div>
          <div
            class="ks-line ticket-item__row"
          >售票时间:{{formatTimestamp(item.order_date[0])}} - {{formatTimestamp(item.order_date[1])}}</div>
          <div
            class="ks-line ticket-item__row"
          >有效期: {{formatTimestamp(item.effective_date[0])}} - {{formatTimestamp(item.effective_date[1])}}</div>
          <div class="ticket-item__row">最大可购: {{item.purchase_limit}}</div>
          <div class="ticket-item__row">剩余票数: {{item.residue}}</div>
          <div class="ticket-item__row">备注说明: {{item.explain}}</div>
          <div class="select_current">
            <i class="ks-icon ks-icon-checkmark-outline"></i>
          </div>
          <div class="check" v-if="item.check==1"></div>
        </div>
      </div>
    </div>
    <div class="placeholder"></div>
    <div class="bottom">
      <div class="bottom-left">
        <span>数量:</span>&nbsp;
        <i class="ks-icon ks-icon-minus-circle-outline" @click="minusNum" v-if="canMinus"></i>
        <i class="ks-icon ks-icon-minus-circle minus-disable" v-else></i>
        <span class="num">&nbsp;{{payNum}}&nbsp;</span>
        <i class="ks-icon ks-icon-plus-circle-outline" @click="plusNum" v-if="canPlus"></i>
        <i class="ks-icon ks-icon-plus-circle plus-disable" v-else></i>
      </div>
      <div class="bottom-right">
        <ks-button
          :type="currentTicket!=-1?'primary':''"
          width="100%"
          class="next-step-btn"
          @click="nextStep"
        >下一步</ks-button>
      </div>
    </div>
  </div>
</template>

<script>
import activity_detail from "@/mixins/activity/activity.detail";
import { checkBuy } from "@/api/microportal";

export default {
  name: "SelectTicket",
  mixins: [activity_detail],
  data() {
    return {
      /**当前时间戳 */
      time:'',
      /**购买数量 */
      payNum: "1"
      /**当前选中票的索引 */
      // currentTicket: -1
    };
  },
  computed: {
    /**是否允许继续增加购买数量 */
    canPlus() {
      if (this.currentTicket == -1) {
        return false;
      }
      if (
        this.payNum <
        this.courseInfo.json.content.ticket_info[this.currentTicket].purchase_limit  && this.payNum < this.courseInfo.json.content.ticket_info[this.currentTicket].residue
      ) {
        return true;
      } else {
        return false;
      }
    },
    /**是否允许继续减少购买数量 */
    canMinus() {
      if (this.currentTicket == -1) {
        return false;
      }
      if (this.payNum > 1) {
        return true;
      } else {
        return false;
      }
    },
  },
  methods: {
    /**选择票种 */
    selectTicket(index) {
      if (this.courseInfo.json.content.ticket_info[index].status == 1) {
        this.currentTicket = index;
        localStorage.setItem("currentTicket", index);
        this.payNum = "1";
      }
    },
    /**减少数量 */
    minusNum() {
      if (this.payNum > 1) {
        this.payNum--;
      }
    },
    /**增加数量 */
    plusNum() {
      if (
        this.payNum <
        this.courseInfo.json.content.ticket_info[this.currentTicket].purchase_limit && this.payNum < this.courseInfo.json.content.ticket_info[this.currentTicket].residue
      ) {
        this.payNum++;
      }
    },
    /**下一步 */
    nextStep() {
      if (this.currentTicket != -1) {
        let nowTime = new Date().getTime();
        if (
          nowTime >
          this.courseInfo.json.content.ticket_info[this.currentTicket]
            .order_date[1]
        ) {
          this.$toast("报名时间已过");
          return false;
        }
        let receive = this.courseInfo.json.content.ticket_info[
          this.currentTicket
        ].receive;
        let num = this.courseInfo.json.content.ticket_info[this.currentTicket]
          .num;
        let residueTicket = num - receive;

        residueTicket = residueTicket < 0 ? 0 : residueTicket;
        if (residueTicket == 0) {
          this.$toast("已售完没票了");
          return false;
        }
        if (this.payNum > residueTicket) {
          this.$toast(`还剩${residueTicket}张票`);
          return false;
        }


        let courseid = this.$route.params.id;
        let ticketid = this.courseInfo.json.content.ticket_info[this.currentTicket].ticketid;

        let time = this.courseInfo.json.content.ticket_info[this.currentTicket].order_date[0];
        let nowtime = new Date().valueOf()
        if(nowtime < time) {
          this.$toast(`该活动还未开始`)
          return false;
        }
        checkBuy({ courseid, ticketid, num: this.payNum }).then(res => {
          if(res.code === "nologin") {
            setTimeout(() => {
              this.$router.push('/user/login')
            }, 500);
          }
          if (res.result == "error") {
            this.$toast(res.msg);
            return false;
          }
          if (this.courseInfo.json.setting.is_pledge == 0) {
            this.$router.push({
              name: "RegistrationForm",
              params: { id: this.$route.params.id },
              query: {
                ticketIndex: this.currentTicket,
                num: this.payNum,
                paymodel: "1"
              }
            });
          } else {
            this.$router.push({
              name: "PayModel",
              params: { id: this.$route.params.id },
              query: {
                ticketIndex: this.currentTicket,
                num: this.payNum
              }
            });
          }
        });
      }
    },
  },
};
</script>

<style scoped>
.activity-info {
  padding: 10px;
  display: flex;
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
.activity-info__content .count-price {
  display: flex;
  justify-content: space-between;
}
.activity-info__content .count {
  color: #bebebe;
}
.activity-info__content .price {
  color: #e64a3b;
}
.ticket-item {
  margin: 0 10px 10px;
  background-color: #ffffff;
  margin-bottom: 10px;
  border-radius: 5px;
  padding: 15px;
  position: relative;
  overflow: hidden;
}
.ticket-item .top {
  display: flex;
  justify-content: space-between;
}
.ticket-item .title {
  font-size: 14px;
  font-weight: bold;
}
.ticket-item .state__robbing {
  border: 1px solid #e64a3b;
  color: #e64a3b;
  padding: 0 3px;
}
.ticket-item .state__stop-robbing {
  color: #cccccc;
  border: 1px solid #cccccc;
  padding: 0 3px;
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
.ticket-item__select {
  border: 1px solid #e64a3b;
}
.ticket-item__select .ticket-item__row {
  color: #888888;
}
.ticket-item__select .price {
  color: #e64a3b;
}
.ticket-item__select .select_current {
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
.ticket-item__select .select_current i {
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
.placeholder {
  height: 54px;
}
.bottom {
  width: 100%;
  position: fixed;
  bottom: 0;
  display: flex;
  height: 54px;
  background-color: #ffffff;
  padding: 5px 10px;
  box-sizing: border-box;
}
.bottom-left,
.bottom-right {
  width: 50%;
}
.bottom-left {
  display: flex;
  justify-content: center;
  align-items: center;
}
.bottom-left i {
  font-size: 25px;
  color: #e64a3b;
}
.bottom-left .num {
  font-size: 16px;
  color: #e64a3b;
  position: relative;
  top: 1px;
}
.bottom-left .plus-disable,
.bottom-left .minus-disable {
  color: #bebebe;
}
.next-step-btn {
  border-radius: 50px;
}
.order-date{
  padding: 8px 0px;
  color: #888;
}
</style>
