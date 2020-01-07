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
        <el-button
          class="admire__text_btn"
          type="primary"
          @click="selectMoneyed(finallyMoney)"
        >确定</el-button>
        <el-button class="admire__text_btn" @click="other">其他金额</el-button>
      </div>
    </div>
    <div class="clearfix" v-show="admireTab == 2">
      <div class="input-wrap">
        <span>￥</span>
        <input type="number" v-model="finallyMoney" @keyup="finallyMoneyCheck" @focus="onTextFocus"
          @blur="onTextBlur" ref="monryInput">
      </div>
      
      <div align="center">
        <el-button
        class="admire__text_btn"
        width="100%"
        type="primary"
        @click="selectMoneyed(finallyMoney)"
      >确定</el-button>
        <el-button class="admire__text_btn" @click="admireTab = 1">固定金额</el-button>
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
      this.$order({
        payid: this.infoId,
        price: price,
        type: this.type
      });
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
.admire-options{
  margin-top:-10px;
}
.admire-options .head > img {
  display: inline-block;
  height: 24px;
}
.admire-options .item {
  width: 33.3%;
  float: left;
  padding: 10px 0;
}
.admire-options .item .inner {
  margin: 0 10px;
  overflow: hidden;
  border: 1px solid #eee;
  border-radius: 4px;
  color: #555;
  text-align: center;
  font-size: 14px;
  padding: 7px 0;
  cursor: pointer;
}
.admire-options .item .inner.actived{
  color: #409EFF;
  border:1px solid #409EFF;
}
.admire-options .item .inner span {
  font-size: 24px;
  margin-right: 3px;
  font-weight: bold;
}
.admire__text_btn{
   margin-top:15px;
}
.input-wrap {
  padding:30px 0 40px 0;
  position: relative;
  text-align: center;
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
