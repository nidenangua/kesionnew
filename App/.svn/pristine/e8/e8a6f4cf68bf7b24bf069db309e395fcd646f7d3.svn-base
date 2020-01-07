<template>
  <div class="qrcode">
    <div class="qrcode__img">
      <div class="qrcode__restip ks-color--success" v-if="sweepYardRes === 1">
        <i class="iconfont icon-anniu_xuanzhong_o"></i>
        登录成功
      </div>
      <div class="qrcode__restip ks-color--error" v-else-if="sweepYardRes === 2">
        <i class="iconfont icon-tishi_o"></i>
        二维码已过期
      </div>
      <img :src="url" />
    </div>
    <div class="qrcode__text">使用微信扫码登录</div>
  </div>
</template>
<script>
import { doPcLogin } from "@/api/users";
export default {
  name: "LoginQrcode",
  props: {
    /**二维码地址 */
    url: String,
    /**验证登录的token */
    token: String
  },
  data() {
    return {
      /**扫码状态 1登录成功 2二维码过期 */
      sweepYardRes: 0
    };
  },
  methods: {
    /**
     * 获取微信扫码结果
     */
    getSweepYardResult() {
      setTimeout(() => {
        doPcLogin({
          token: this.token
        }).then(res => {
          if (res.result === "success") {
            this.sweepYardRes = 1;
            setTimeout(() => {
              location.reload();
            }, 1000);
          } else if (res.code === "expired") {
            this.sweepYardRes = 2;
          } else {
            this.getSweepYardResult();
          }
        });
      }, 2000);
    }
  },
  mounted() {
    this.getSweepYardResult();
  }
};
</script>

<style scoped>
/*二维码预览 登录*/
.qrcode {
  text-align: center;
  padding: 100px 0;
}
.qrcode__img {
  width: 300px;
  height: 300px;
  display: block;
  margin: 0 auto;
  position: relative;
}
.qrcode__restip {
  position: absolute;
  width: 100%;
  height: 300px;
  box-sizing: border-box;
  padding-top: 120px;
  text-align: center;
  font-size: 16px;
  background: rgba(255, 255, 255, 0.9);
}
.qrcode__restip .iconfont {
  display: block;
  font-size: 60px;
  line-height: 60px;
}
.qrcode__img img {
  width: 100%;
  height: 100%;
}
.qrcode__text {
  text-align: center;
  font-size: 16px;
  line-height: 34px;
  margin-top: 15px;
}
</style>
