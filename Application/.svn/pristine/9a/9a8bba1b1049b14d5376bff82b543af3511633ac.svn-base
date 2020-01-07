<template>
  <div class="store-reg">
    <div class="store-reg__logo">
      <img src="../../assets/store/logo.png">
    </div>
    <div class="store-reg__body">
      <ks-form>
        <ks-form-item label="微门户名称">
          <input
            class="ks-input"
            ref="name"
            v-model="form.name"
            type="text"
            placeholder="例：机构名称、教师名称"
          >
        </ks-form-item>
        <ks-form-item label="手机号码">
          <input class="ks-input" ref="tel" v-model="form.tel" type="text" placeholder="请输入手机号">
        </ks-form-item>
        <ks-form-item label="图形验证码">
          <input
            class="ks-input"
            ref="imgCode"
            v-model="form.imgCode"
            type="text"
            placeholder="请输入右侧验证码"
          >
          <img src="/home.html/default/Register/Verify" height="40px">
        </ks-form-item>
        <ks-form-item label="手机验证码">
          <input class="ks-input" v-model="form.code" type="text" placeholder="请输入收到的验证码">
        </ks-form-item>
        <ks-form-item label="设置密码">
          <input class="ks-input" v-model="form.password" type="text" placeholder="请设置您的密码">
        </ks-form-item>
      </ks-form>
    </div>

    <div class="store-reg__foot">
      <div class="store-reg__protocol">
        <ks-checkbox v-model="protocolChecked"/>我已阅读并同意
        <span class="ks-color-link">《课堂街平台协议》</span>
      </div>
      <ks-button width="100%" class="ks-mt20" type="primary" @click="reg">开启我的微门户</ks-button>
    </div>
  </div>
</template>
<script>
import { doRegister } from "@/api/store";
export default {
  name: "Register",
  data() {
    return {
      protocolChecked: false,
      form: {
        name: "",
        tel: "",
        imgCode: "",
        code: "",
        password: ""
      }
    };
  },
  methods: {
    /**
     * 注册
     */
    reg() {
      if (!this.form.name) {
        this.$toast("请输入微门户名称");
        this.$refs.name.focus();
        return false;
      } else if (!this.form.tel) {
        this.$toast("请输入手机号码");
        this.$refs.tel.focus();
        return false;
      }
    }
  },
  activated() {
    document.title = "免费开通微门户";
  }
};
</script>
<style lang="scss" scoped>
.store-reg__logo {
  padding: 30px 0;
}
.store-reg__logo img {
  display: block;
  margin: 0 auto;
  height: 40px;
}
.store-reg__body {
  background: #fff;
  padding: 30px 15px;
  margin: 0 15px;
  border-radius: 4px;
}
.store-reg__foot {
  padding: 30px 15px;
}
.store-reg__protocol {
  font-size: 14px;
  color: #666;
}
.store-reg__protocol .ks-checkbox {
  position: relative;
  top: 3px;
  margin-right: 5px;
}
</style>

