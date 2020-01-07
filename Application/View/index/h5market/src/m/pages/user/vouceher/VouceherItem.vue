<template>
  <div class="vouceher-item" :class="item.isuse == 2 && 'vouceher-item-expired'">
    <div
      class="vouceher-item-l"
      :class="(item.money.length > 3 && 'vouceher-item-l-sm') || item.money.length > 2 && 'vouceher-item-l-s'"
    >
      <span>￥</span>
      {{item.money}}
    </div>
    <div class="vouceher-item-r">
      <div class="vouceher-item-title">{{item.title}}</div>
      <div class="vouceher-item-desc">
        *{{voucherQuota(item.term)}}
        <br>
        *{{voucherTime(item.awarddate,item.time)}}
        <br>
        <span v-if="item.infoid != 0">*限{{voucherTypeName(item.type)}}《{{item.infotitle}}》可用</span>
        <span v-else>*全站通用</span>
        <br>
        <span v-if="item.oneusers > 1">已领取{{item.lqzt}}/{{item.oneusers}}张</span>
      </div>
    </div>
    <div class="vouceher-item-btn" v-if="itemType === 'use'">
      <ks-button v-if="item.isuse == 2" type="gray" :disabled="true" size="mini" round>已过期</ks-button>
      <ks-button
        @click="goUse(item)"
        v-else-if="item.infoid != 0"
        type="primary"
        size="mini"
        round
      >去使用</ks-button>
      <ks-button
        @click="$router.push({name:'CourseList'})"
        v-else
        type="primary"
        size="mini"
        round
      >去选课</ks-button>
    </div>
    <div class="vouceher-item-btn" v-else>
      <ks-button
        v-if="item.lqzt == item.oneusers"
        type="primary"
        :disabled="true"
        size="mini"
        round
      >已领取</ks-button>
      <ks-button v-else-if="item.isuse == 1" :disabled="true" type="gray" size="mini" round>已被领完</ks-button>
      <ks-button
        v-else
        @click="receive(item)"
        type="primary"
        size="mini"
        round
      >{{item.lqzt == 0 ? '领取' : '继续领取'}}</ks-button>
    </div>
  </div>
</template>
<script>
import { getVoucher } from "@/api/user";
import { getViewRoute, getTypeName } from "@/utils";
export default {
  name: "VouceherItem",
  props: {
    item: Object,
    itemType: String
  },
  methods: {
    /**
     * 获取时间限制
     */
    voucherTime(type, time) {
      if (type == 1) {
        return time;
      } else {
        return "无时间限制";
      }
    },
    /**
     * 获取消费额度限制
     */
    voucherQuota(type) {
      if (type != 0) {
        return "满￥" + type + ".00元可用";
      } else {
        return "无门槛使用";
      }
    },
    voucherTypeName(type) {
      return getTypeName(type);
    },
    /**
     * 去使用优惠券
     */
    goUse(item) {
      if (item.isuse == 2) {
        return false;
      }
      let route = getViewRoute(item, "infoid");
      this.$router.push(route);
    },
    /**
     * 领取优惠券
     */
    receive(item) {
      getVoucher({
        id: item.id
      }).then(res => {
        if (res.result === "success") {
          this.$toast("领取成功");
          item.lqzt += 1;
        }
      });
    }
  }
};
</script>
<style scoped>
.vouceher-item {
  display: flex;
  margin-bottom: 10px;
  background: #fff;
  position: relative;
  line-height: 1.7;
}
.vouceher-item-btn {
  display: flex;
  align-items: center;
  justify-content: center;
}
.vouceher-item-btn .ks-button {
  height: 24px;
  line-height: 23px;
  padding: 0 12px;
  font-size: 11px;
  font-weight: bold;
  margin-right: 10px;
}
.vouceher-item-l {
  width: 90px;
  height: 120px;
  position: relative;
  font-size: 34px;
  color: #fff;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  background-image: url(../../../assets/user/discount_bg.png);
  background-repeat: no-repeat;
  background-size: 140% 140%;
  left: -3px;
}

.vouceher-item-l span {
  font-size: 16px;
  position: relative;
  top: 5px;
}
.vouceher-item-l-s {
  font-size: 28px;
}
.vouceher-item-l-s span {
  font-size: 15px;
}
.vouceher-item-l-sm {
  font-size: 24px;
}
.vouceher-item-l-sm span {
  top: 3px;
  font-size: 14px;
}
.vouceher-item-r {
  flex: 1;
  overflow: hidden;
  background: #fff;
  padding: 10px;
  box-sizing: border-box;
  position: relative;
}

.vouceher-item-title {
  font-size: 16px;
  font-weight: bold;
  width: 100%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.vouceher-item-desc {
  color: #999;
  margin-top: 5px;
}

/*已过期*/

.vouceher-item-expired {
  color: #999;
}
.vouceher-item-expired .vouceher-item-l {
  background-image: url(../../../assets/user/discount_bg_expired.png);
}
</style>


