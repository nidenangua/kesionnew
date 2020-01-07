<template>
  <form>
    <div class="login">
      <div class="title">用户登录</div>
      <ul>
        <li class="line">
          <input type="text" v-model="username" placeholder="请输入用户名/手机号" ref="username">
        </li>
        <li>
          <input
            type="password"
            autocomplete="off"
            v-model="password"
            placeholder="请输入登录密码"
            ref="password"
          >
        </li>
      </ul>
    </div>
    <div class="buttons">
        <ks-button type="primary" @click="login">登录</ks-button>
    </div>
    <div class="buttons" v-if="$store.state.is_register">
        <ks-button  @click="$router.push('/user/reg')">立即注册</ks-button>
    </div>
    <store-footer/>
  </form>
</template>
<script>
import { checkLogin } from "@/api/user";
export default {
  name: "UserLogin",
  data() {
    return {
      username: "",
      password: ""
    };
  },
  methods: {
    reg(){

    },
    login() {
      if (!this.username) {
        this.$toast("请输入账户名")
        this.$refs.username.focus()
        return false
      } else if (!this.password) {
        this.$toast("请输入密码")
        this.$refs.password.focus()
        return false
      }
      this.$showLoading("正在登录");
      checkLogin({
        username: this.username,
        password: this.password
      }).then(res => {
        this.$store.dispatch("updateUserInfo").then(() => {
          this.$hideLoading();
          this.$toast("登录成功", "success");
          this.$navigateBack();
        });
      });
    }
  },
  activated() {
    document.title = "登录";
  }
};
</script>
<style scoped>
.login .title {
  height: 49px;
  line-height: 49px;
  overflow: hidden;
  padding: 0 15px;
  font-size: 16px;
}
.login li {
  height: 49px;
  background: #fff;
  padding: 0 15px;
  position: relative;
}
.login li .eva-icon {
  width: 49px;
  height: 49px;
  position: absolute;
  left: 0;
  top: 0;
  background-repeat: no-repeat;
  background-size: 24px;
  background-position: 50% 50%;
}

.login li input {
  width: 100%;
  height: 39px;
  position: relative;
  top: 5px;
  background: none;
  font-size: 14px;
  border: 0px;
}


.buttons {
  margin: 15px;
}
.buttons .ks-button{
    width: 100%;
}
</style>


