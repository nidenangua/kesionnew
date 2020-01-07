<template>
  <div>
    <div v-show="admireTab == 1">
      <div class="admire-options clearfix">
        <div class="item" v-for="(money,i) in moneySelectList" :key="i">
          <div class="inner" @click="finallyMoney = money" :class="finallyMoney == money && 'actived'">
            <span>{{money}}</span>元
          </div>
        </div>
      </div>
      <div align="center">
        <ks-button
          class="ks-mt15"
          width="100%"
          type="primary"
          @click="selectMoneyed(finallyMoney)"
        >确定</ks-button>
        <div class="admire__text_btn ks-mt10 ks-color-primary" @click="other">其他金额</div>
      </div>
    </div>
    <div class="clearfix" v-show="admireTab == 2">
      <div class="ks-mt30 input-wrap">
        <span>￥</span>
        <input type="number" v-model="finallyMoney" @keyup="finallyMoneyCheck" @focus="onTextFocus"
          @blur="onTextBlur" ref="monryInput">
      </div>
      <ks-button
        class="ks-mt30"
        width="100%"
        type="primary"
        @click="selectMoneyed(finallyMoney)"
      >确定</ks-button>
      <div align="center">
        <div class="admire__text_btn ks-mt10 ks-color-primary" @click="admireTab = 1">固定金额</div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "RewardSelect",
  props: {
    /**打赏类型 */
    type: String,
    /**唯一id，信息id */
    infoId: [String, Number]
  },
  data() {
    return {
      admireTab: 1,
      finallyMoney: 0,
      moneySelectList: [1, 2, 5, 10, 20, 50]
    };
  },
  methods: {
    /**
     * 确定打赏
     */
    selectMoneyed(price) {
      if (!price) {
        this.$toast("请输入打赏金额");
        return false;
      }
      let payInfo = {
        payid: this.infoId,
        price: price,
        msg: "打赏",
        type: this.type
      };
      this.$showPay(payInfo, false);
    },
    /**
     * 快速打赏
     */
    rewardPay(price) {
      this.selectMoneyed(price);
    },
    /**
     * 选择其他金额
     */
    other() {
      this.admireTab = 2;
      this.$nextTick(() => {
        this.$refs.monryInput.focus();
      });
    },
    /**
     * 价格校验，保留小数点后两位
     */
    finallyMoneyCheck() {
      let check = this.finallyMoney.toString().match(/\d+\.?\d{0,2}/);
      if (check) {
        this.finallyMoney = check[0];
      }
    },
    /**
     * 文本区域焦点事件,兼容微信浏览器焦点事件离开后页面位置错位问题
     */
    onTextFocus() {
      this.WINDOW_TOP = document.body.scrollTop;
    },
    /**
     * 文本区域焦点离开,兼容微信浏览器焦点事件离开后页面位置错位问题
     */
    onTextBlur() {
      window.scrollTo(0, this.WINDOW_TOP);
    },
  }
};
</script>

<style scoped>
.admire-options .head > img {
  display: inline-block;
  height: 24px;
}
.admire-options .item {
  width: 33.3%;
  float: left;
  margin-bottom: 10px;
}
.admire-options .item .inner {
  margin: 0 5px;
  overflow: hidden;
  border: 1px solid #eee;
  border-radius: 5px;
  color: #555;
  text-align: center;
  font-size: 14px;
  padding: 7px 0;
}
.admire-options .item .inner.actived{
  color: #e85c4a;
  border:1px solid #e85c4a;
}
.admire-options .item .inner span {
  font-size: 24px;
  margin-right: 3px;
  font-weight: bold;
}
.admire__text_btn{
    line-height: 36px;
}
.input-wrap {
  display: flex;
  justify-content: center;
  position: relative;
}
.input-wrap span {
  font-weight: bold;
  font-size: 24px;
  line-height: 44px;
}
.input-wrap input {
  height: 44px;
  font-size: 36px;
  border: 0;
  box-sizing: border-box;
  width: 120px;
  border-radius: 4px;
  background: none;
}
</style>
