<template>
  <div v-if="$store.state.style.id">
    <keep-alive>
      <router-view></router-view>
    </keep-alive>
    <ks-dialog :visible.sync="bindMobile" :show-close="false" title="绑定手机">
      <ks-form label-width="80px">
        <ks-form-item label="手机号码">
          <ks-input v-model="mobile" ref="mobile" placeholder="请输入手机号码" />
        </ks-form-item>
        <ks-form-item label="验证码" v-if="isNote" style="padding-right:100px;">
          <ks-input v-model="code" ref="code" placeholder="请输入验证码" />
          <ks-button class="bind-mobile__codebtn" size="mini" v-if="time">重新获取{{time}}s</ks-button>
          <ks-button
            class="bind-mobile__codebtn"
            size="mini"
            @click="getMobileCode"
            plain
            v-else
          >获取验证码</ks-button>
        </ks-form-item>
      </ks-form>
      <ks-button type="primary" class="ks-mt15" @click="saveMobile" width="100%">确认绑定</ks-button>
    </ks-dialog>
  </div>
</template>

<script>
import { sendSms, popupMobile } from "@/api/user";
import { getParams, isPoneAvailable } from "@/utils";
export default {
  name: "App",
  data() {
    return {
      /**绑定手机号码开关，为true时会弹出绑定手机号窗口 */
      bindMobile: false,
      /**是否启用验证码 */
      isNote: false,
      /**手机号码 */
      mobile: "",
      /**验证码 */
      code: "",
      /**倒计时 */
      time: 0
    };
  },
  watch: {
    "$route.name"() {
      /**
       * 监听页面跳转，关闭可能未执行完的进程
       */
      this.$hideLoading();
      this.$hidePay();
    }
  },
  mounted() {
    /**
     * 调取微信自动登录
     */
    this.$store.ready(state => {

      /**加载客服 */
      if(state.info.json){
        switch(state.info.json.service_type){
          case '53kf':
            if(state.info.json.service_url){
              let _53code = document.createElement("script")
              _53code.src = `https://tb.53kf.com/${state.info.json.service_url}`;
              document.getElementsByTagName('head')[0].appendChild(_53code)
            }
            break
        }
      }
      if (state.isLogin == 1 && window.__wxjs_environment !== "miniprogram") {
        this.isNote = state.userInfo.is_note;
        this.bindMobile = state.userInfo.is_mobile;
      } else {
        /**判断是否是在测试环境 */
        let par = getParams();
        if (
          !par.h5token &&
          this.isWeiXin() &&
          !par.testenv &&
          window.__wxjs_environment !== "miniprogram" &&
          state.is_wechatlogin
          
        ) {
          let turnurl = encodeURIComponent(location.href);
          location.href =
            "/Json/index.php?act=Users.Common.doWechatLogin&turnurl=" + turnurl;
        }
      }
    });
  },
  methods: {
    /**
     * 判断是否是在微信环境
     */
    isWeiXin() {
      var ua = window.navigator.userAgent.toLowerCase();
      if (ua.match(/MicroMessenger/i) == "micromessenger") {
        return true;
      } else {
        return false;
      }
    },
    /**
     * 验证输入
     */
    verification(){
      if (!this.mobile) {
        this.$toast("请输入手机号码");
        this.$refs.mobile.focus();
        return false;
      }
      if (!isPoneAvailable(this.mobile)) {
        this.$toast("手机号码格式错误");
        this.$refs.mobile.focus();
        return false;
      }
      return true
    },
    /**
     * 获取手机验证码
     */
    getMobileCode() {
      if(this.verification()){
        sendSms({
          mobile: this.mobile
        }).then(res => {
          if (res.result === "success") {
            this.time = 60;
            this.updateTime();
          }
        });
      }
    },
    /**
     * 保存手机号绑定
     */
    saveMobile(){
      if(this.verification()){
        if (this.isNote && !this.code) {
          this.$toast("请输入验证码");
          this.$refs.code.focus();
          return;
        }
        let params = {
          mobile: this.mobile
        };
        if (this.isNote) {
          params.code = this.code;
        }
        popupMobile(params).then(res=>{
          if (res.result === "success") {
            this.$toast('保存成功','success');
            this.$store.dispatch("updateUserInfo").then(()=>{
              this.bindMobile = false;
            })
          }
        })
      }
    },
    /**
     * 更新倒计时
     */
    updateTime() {
      setTimeout(() => {
        if (this.time > 0) {
          this.time -= 1;
          this.updateTime();
        }
      }, 1000);
    }
  }
};
</script>

<style>
@import url("./assets/reset/reset.css");
body .page{
  min-height: 100vh;
  box-sizing: border-box;
  background-color: var(--page_background-color);
}
/*通用*/
.line {
  position: relative;
}
.line:after {
  display: block;
  content: " ";
  height: 0px;
  width: 100%;
  box-sizing: border-box;
  border-bottom: 1px solid #e3e3e3;
  -webkit-transform: scaleY(0.5);
  -ms-transform: scaleY(0.5);
  transform: scaleY(0.5);
  -webkit-transform-origin: 0 100%;
  -ms-transform-origin: 0 100%;
  transform-origin: 0 100%;
  position: absolute;
  bottom: 0px;
  left: 0;
  right: 0;
  z-index: 1;
}
.line-top:after {
  top: 0;
  bottom: inherit;
  -webkit-transform-origin: 0 0;
  -ms-transform-origin: 0 0;
  transform-origin: 0 0;
}
.prism-player .prism-cover {
  background-size: cover !important;
}

.prism-player {
  position: absolute !important;
}

/*绑定手机号*/
.bind-mobile__codebtn {
  position: absolute;
  right: 0;
  top: 7px;
}
</style>
