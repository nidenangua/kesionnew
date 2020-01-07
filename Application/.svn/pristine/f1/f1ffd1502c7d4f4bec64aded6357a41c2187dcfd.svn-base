<template>
  <div class="fight-group">
    <!--拼团-->
    <div class="fight-group__info" v-if="view === 'info'">
      <div v-if="day == 0 && hour == 0 && min == 0 && sec == 0">拼团活动已结束</div>
      <div v-else>
        <div class="fight-group__countdown">
          离拼团活动还剩
          <span v-if="day">
            <em>{{day}}</em>天
          </span>
          <span v-if="hour">
            <em>{{hour}}</em>小时
          </span>
          <span>
            <em>{{min}}</em>分
          </span>
          <span>
            <em>{{sec}}</em>秒
          </span>结束
        </div>
        <div class="fight-group__tip">还没有小伙伴参与拼团哦，快来抢占第一名!</div>
      </div>
    </div>
    <div class="fight-group__button" v-else-if="view === 'button'">
      <div class="fight-group__button__original" @click="buy">￥{{info.price}}</div>
      <div class="fight-group__button__group" @click="goPay">
        <span class="price">￥{{info.setting.teammoney}}</span>
        发起{{info.setting.rewardpeple}}人拼团
      </div>
    </div>
  </div>
</template>
<script>
import { countdown } from "@/utils";
export default {
  name: "FightGroup",
  props: ["info", "view", "type"],
  data() {
    return {
      day: 0,
      hour: 0,
      min: 0,
      sec: 0
    };
  },
  methods: {
    /**
     * 更新时间
     */
    getTime(nowTime, endTime) {
      let time = countdown(nowTime, endTime);
      if (
        parseInt(time.day) > 0 ||
        parseInt(time.hour) > 0 ||
        parseInt(time.min) > 0 ||
        parseInt(time.sec) > 0
      ) {
        this.day = time.day;
        this.hour = time.hour;
        this.min = time.min;
        this.sec = time.sec;
        setTimeout(() => {
          this.getTime(nowTime + 1000, endTime);
        }, 1000);
      } else {
        this.day = 0;
        this.hour = 0;
        this.min = 0;
        this.sec = 0;
      }
    },
    /**
     * 原价购买
     */
    buy() {
      this.$showPay({
        payid: this.info.infoid,
        msg: "购买课程",
        price: this.info.price,
        type: "course"
      });
    },
    /**
     * 支付
     */
    goPay() {
      this.$router.push({
        name: "FightGroupView",
        params: {
          id: this.info.infoid
        },
        query: {
          sellid: this.info.id
        }
      });
    }
  },
  mounted() {
    if (this.view === "info") {
      this.getTime(
        parseInt(this.info.nowTime) * 1000,
        parseInt(this.info.endtime) * 1000
      );
    }
  }
};
</script>
<style scoped>
/*拼团*/
.fight-group__info {
  background: #fff;
  padding: 5px 15px 15px 15px;
  margin-bottom: 10px;
}
.fight-group__countdown {
  font-size: 14px;
  color: #555;
}
.fight-group__countdown em {
  padding: 3px 4px;
  background: #fee7e5;
  color: #e64a3b;
  border-radius: 4px;
  margin: 0 5px;
  font-style: normal;
}
.fight-group__tip {
  line-height: 34px;
  margin-top: 10px;
  color: #999;
  font-size: 14px;
}

.fight-group__button__original,
.fight-group__button__group {
  width: 50%;
  float: left;
  height: 49px;
  text-align: center;
}

.fight-group__button__original {
  background: #2eb249;
  color: #fff;
  font-size: 18px;
  line-height: 49px;
}

.fight-group__button__group {
  background: #e64a3b;
  color: #fff;
  font-size: 14px;
  line-height: 21px;
}
.fight-group__button__group span {
  display: block;
  font-size: 18px;
  margin-top: 3px;
}
</style>

