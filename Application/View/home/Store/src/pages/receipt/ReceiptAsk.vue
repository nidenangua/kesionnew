<template>
  <div>
    <div class="recepit__title">您的课堂街店铺在成功开通自有账户支付后，将通过您授权的服务号的微信支付功能和高级接口能力，实现以下高级功能：</div>
    <div class="recepit__info">
      <p>&nbsp; &nbsp; ·&nbsp; 用户通过点击您的课堂街店铺的服务号链接地址进入购买所产生的收入，可以直接进入您的微信支付商户平台账户（可设置自动转账到您的微信支付对应的银行对公账户），不需要提现</p>
      <p>
        <br>
      </p>
      <p>&nbsp; &nbsp; ·&nbsp; 在课堂街平台，订单管理可查询对应订单收入</p>
      <p>
        <br>
      </p>
      <p>&nbsp; &nbsp; ·&nbsp; 更多功能正在陆续开发中...</p>
      <p>
        <br>
      </p>
      <p>
        <br>
      </p>
      <p>请注意一下事项：</p>
      <p>
        <br>
      </p>
      <p>&nbsp; &nbsp; ·&nbsp; 您的店铺一单使用自有账户支付，推广员功能将无法使用，生效后推广链接将不再产生推广收益，已经产生收益的提现不受影响</p>
      <p>
        <br>
      </p>
      <p>&nbsp; &nbsp; ·&nbsp; 切换为自有支付后，将不能切回课堂街平台支付</p>
      <p>
        <br>
      </p>
      <div class="recepit__checkbox">
        <el-checkbox v-model="checked" @change="confirm">我已仔细阅读以上文字，并已知晓可能带来的影响和风险</el-checkbox>
      </div>
      <div class="recepit__btn">
        <el-button type="primary" :disabled="disabled" @click="sure">确定切换</el-button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "set",
  data() {
    return {
      loaded: true,
      checked: false,
      disabled: true
    };
  },
  methods: {
    confirm(val) {
      if (this.checked) {
        this.disabled = false;
      } else {
        this.disabled = true;
      }
    },
    sure() {
      this.$emit("sure");
    }
  }
};
</script>
<style scoped>
.recepit__title {
  font-size: 14px;
  color: #000;
  margin-bottom: 20px;
}
.recepit__info {
  font-size: 14px;
  color: #666;
}
.recepit__btn {
  margin-top: 30px;
  text-align: center;
}
.recepit__checkbox {
  text-align: center;
}
</style>


