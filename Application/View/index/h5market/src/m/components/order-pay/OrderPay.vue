<template>
  <div class="order-pay" v-show="show">
    <div class="order-pay__title">
      <div class="order-pay__close ks-fr" @click="show = false">
        <i class="ks-icon ks-icon-close ks-fz22"></i>
      </div>
      {{payInfo.msg || '支付'}}
    </div>
    <div class="order-pay__body">
      <ks-list item-height="49px">
        <ks-list-item title="可用优惠券" v-if="isCanUseVouceher" :show-arrow="vouceherList.length > 0">
          <div v-if="vouceherList.length">
            <select class="vouceher-select" v-model="vouceher">
              <option value="-1">选择优惠券</option>
              <option
                v-for="(item,i) in vouceherList"
                :value="i"
                :key="i"
              >{{item.money | getnum}}元优惠券</option>
            </select>
          </div>
          <span v-else>暂无可用优惠券</span>
        </ks-list-item>
        <ks-list-item title="会员卡折扣" v-if="!payInfo.giftNum && vipdiscount.discount">
          <span class="ks-color-primary">{{vipdiscount.discount}}折</span>
        </ks-list-item>
        <ks-list-item title="支付金额">
          <span class="ks-fz16 ks-color-primary" v-if="price !== null">¥{{price}}</span>
        </ks-list-item>
      </ks-list>
      <ks-button class="ks-mt15" width="100%" type="primary" @click="sure">确认支付</ks-button>
    </div>
  </div>
</template>
<script>
import store from '@/store'
import wx from 'weixin-js-sdk'
import { getOrderNow, getCollageoOderNow } from "@/api/course";
import { getUserWealth } from "@/api/user";
export default {
  name: "OrderPay",
  data() {
    return {
      payInfo: {},
      show: false,
      price: null,
      vouceher: -1,
      couponid: 0,
      vouceherList: [],
      orderurl: "",
      isCanUseVouceher: false,
      vipdiscount: {}
    };
  },
  watch: {
    show(v) {
      if (v) {
        this.$showMask({
          click: () => {
            this.show = false;
          }
        });
      } else {
        this.$hideMask();
      }
    },
    vouceher() {
      this.setPrice();
    }
  },
  methods: {
    /**
     * 设置价格
     */
    setPrice() {
      let v = this.vouceher;
      let _price = parseFloat(this.payInfo.price);
      if (this.vipdiscount.discount && !this.payInfo.giftNum) {
        _price = (_price * this.vipdiscount.discount) / 10;
      }
      if (v == -1) {
        this.couponid = 0;
      } else {
        let item = this.vouceherList[v];
        let vouceherValue = parseFloat(item.money);
        _price = Math.max(_price - vouceherValue, 0);
        this.couponid = item.id;
      }
      this.price = _price.toFixed(2);
    },
    /**
     * 拼团支付
     */
    fightGroupPay(params) {
      getCollageoOderNow(params).then(res => {
        this.orderHandle(res);
      });
    },
    /**
     * 打赏
     */
    reward(payInfo) {
      let params = {
        id: payInfo.payid,
        price: payInfo.price,
        type: payInfo.type,
        url: location.href.replace(/[?&]ordersn=[^&]+/g, "")
      };
      this.pay(params);
    },

    /**
     * 确认支付
     * params 自定义post内容
     */
    sure() {
      /**
       * @param id 信息id
       * @param couponid 选择的优惠券id
       * @param price 价格
       * @param type 信息类别
       */
      let params = {
        id: this.payInfo.payid,
        price: this.price,
        type: this.payInfo.type
      };

      /**
       * 使用的优惠券id
       */
      if (this.couponid) {
        params.couponid = this.couponid;
      }
      /**
       * 赠送数量
       */
      if (this.payInfo.giftNum) {
        params.giftNum = this.payInfo.giftNum;
      }
      if (this.payInfo.json) {
        params.json = this.payInfo.json;
      }
      
      this.pay(params);
    },
    /**
     * 支付
     * @param {Object} 下单的一些参数
     */
    pay(params) {
      params.balanceType = params.balanceType || 0; //是否使用余额支付 0 1 (固定0，后端已去除余额支付)
      if (window.__wxjs_environment === 'miniprogram') {
        params = JSON.stringify(params);
        params = encodeURIComponent(params);
        store.ready(state=>{
          wx.miniProgram.navigateTo({
            url: `/pages/pay/pay?wxid=${state.info.wxid}&params=${params}`
          })
        })
        
      }else{
        getOrderNow(params).then(res => {
          this.orderHandle(res);
        });
      }
      
    },
    /**
     * 处理订单结果
     * @param {Object} 下单返回结果
     */
    orderHandle(res) {
      let errCode = res.errCode;
      switch (errCode) {
        case 1000:
          this.$toast(res.msg).then(() => {
            this.$router.push({
              name: "UserLogin"
            });
          });
          break;
        case 1002:
          this.$toast(res.msg);
          break;
        case 1003:
          //订单已存在
          location.href = res.url;
          break;
        case 1004:
          this.$toast(res.msg);
          break;
        case 1005:
          location.href = res.url;
          break;
        case 1006:
          this.$toast("购买成功", "success").then(() => {
            if(this.payInfo.isgive) {
              let href = location.href
              location.href =  `${href.split("#",1)[0]}#/user/toGift?id=${this.payInfo.payid}&type=${this.payInfo.type}&ordersn=${res.ordersn}`        
            }else {
              location.reload()
            }   
          });
          break;
        case 1007:
          this.$toast("赠送成功", "success").then(() => {
            location.reload();
          });
          break;
        case 1010:
          this.$toast(res.msg);
          break;
      }
    },
    /**
     * 更新数据
     */
    updateData(payInfo) {
      return new Promise(resolve => {
        this.payInfo = payInfo;
        getUserWealth({
          id: payInfo.payid,
          type: payInfo.type
        }).then(res => {
          if (res.result === "success") {
            /**如果 支付方式 是先付定金则不能使用优惠券 */
            if (this.payInfo.json && this.payInfo.json.paymodel == 0) {
              this.vouceherList = [];
              this.vipdiscount = {};
            } else {
              this.vouceherList = res.list;
              this.vipdiscount = res.vipdiscount;
            }
            /**
             * 优惠券是否可使用说明
             * 会员卡不可用于会员卡购买（type等于9）
             * 第一种：当前会员卡可参与其他优惠，但不可用于赠送（赠送不可使用会员卡折扣）
             * 第二种：当前没购买过会员卡
             * 第三种：赠送好友，用原价抵优惠券
             */
            if (
              payInfo.giftNum ||
              (res.vipdiscount.other == 1 &&
                payInfo.type !== 9 &&
                !payInfo.giftNum) ||
              (payInfo.type !== 9 && res.vipdiscount.other === undefined) ||
              (this.payInfo.json && this.payInfo.json.paymodel == 0)
            ) {
              this.isCanUseVouceher = true;
            }

            this.setPrice();
            resolve();
          }
        });
      });
    },
    /**
     * 重置数据
     */
    resetData() {
      this.payInfo = {};
      this.price = null;
      this.vouceher = -1;
      this.couponid = 0;
      this.vouceherList = [];
      this.vipdiscount = {};
      this.isCanUseVouceher = false;
    }
  },
  filters:{
    getnum(val) {
      let num = val.split(".")[1]
      return val = num == "00" ? parseInt(val) : Number(val).toFixed(2)
    }
  }
};
</script>
<style scoped>
.order-pay {
  width: 100%;
  max-width: 480px;
  position: fixed;
  bottom: 0;
  z-index: 101;
  background: #fff;
  padding-top: 5px;
  left: 0;
  right: 0;
  margin: 0 auto;
}
.order-pay__title {
  height: 49px;
  line-height: 49px;
  padding: 0 15px;
  font-size: 16px;
  font-weight: bold;
}
.order-pay__close {
  width: 32px;
  text-align: center;
  font-weight: normal;
}

.order-pay__body {
  padding: 10px 20px 20px;
}

.vouceher-select {
  border: 0px;
  background: none;
  -webkit-appearance: none;
  outline: none;
  font-size: 14px;
}
</style>

