<template>
  <div>
    <el-dialog title="用户登录" :visible.sync="visible" width="360px" center>
      <el-tabs v-model="loginType">
        <el-tab-pane name="account" label="账号登录">
          <form>
            <div class="account-login" v-if="reg">
              <ul>
                <li>
                  <el-input
                    type="text"
                    v-model="regForm.nickname"
                    placeholder="请输入昵称"
                    ref="nickname"
                  />
                </li>
                <li>
                  <el-input
                    autocomplete="off"
                    v-model="regForm.mobile"
                    placeholder="请输入手机号码"
                    ref="mobile"
                  />
                </li>
                <li>
                  <el-button plain type="primary" :disabled="second > 0" class="getcode" @click="getCode" size="mini">{{(second == -1 && '获取验证码') || (second == 0 && '重新获取') || (second > 0 && second + '秒后重新获取')}}</el-button>
                  <el-input
                    type="text"
                    maxlength="6"
                    v-model="regForm.code"
                    placeholder="请输入验证码"
                    ref="code"
                  />
                </li>
                <li>
                  <el-input
                    autocomplete="off"
                    type="password"
                    v-model="regForm.password"
                    placeholder="请输入登录密码"
                    ref="password"
                  />
                </li>
                <li>
                  <el-input
                    autocomplete="off"
                    type="password"
                    v-model="regForm.repassword"
                    placeholder="请再次输入登录密码"
                    ref="repassword"
                  />
                </li>
              </ul>
              <div>
                <el-button type="primary" @click="userReg" style="width:100%">注册</el-button>
              </div>
              <div style="margin-top:10px;">
                <el-button style="width:100%" @click="reg = false">返回登录</el-button>
              </div>
            </div>
            <div class="account-login" v-else>
              <ul>
                <li>
                  <el-input
                    prefix-icon="el-icon-user"
                    type="text"
                    v-model="username"
                    placeholder="请输入用户名/手机号"
                    ref="username"
                  />
                </li>
                <li>
                  <el-input
                    prefix-icon="el-icon-key"
                    type="password"
                    autocomplete="off"
                    v-model="password"
                    placeholder="请输入登录密码"
                    ref="password"
                  />
                </li>
              </ul>
              <div>
                <el-button type="primary" @click="login" style="width:100%">登录</el-button>
              </div>
              <div style="margin-top:10px;" v-if="is_register">
                <el-button style="width:100%" @click="reg = true">立即注册</el-button>
              </div>
            </div>
            
          </form>
        </el-tab-pane>
        <el-tab-pane name="qrcode" label="微信扫码登录" v-if="is_wechatlogin">
          <div class="qrcode">
            <div class="qrcode__img">
              <div class="qrcode__state qrcode__state--success" v-if="sweepYardRes === 1">
                <i class="el-icon-check"></i>
                登录成功
              </div>
              <div class="qrcode__state qrcode__state--error" v-else-if="sweepYardRes === 2">
                <i class="el-icon-close"></i>
                二维码已过期
              </div>
              <img :src="qrCode" />
            </div>
            <div class="qrcode__text">使用微信扫码登录</div>
          </div>
        </el-tab-pane>
      </el-tabs>
    </el-dialog>
  </div>
</template>
<script>
import store from '@/store'
import {isPoneAvailable} from '@/utils'
import { doPcLogin, scanQrCode, sendSms,register,checkLogin } from "@/api/user";
export default {
  name: "LoginQrcode",
  data() {
    return {
      /**扫码状态 1登录成功 2二维码过期 */
      sweepYardRes: 0,
      /**窗口开关 */
      visible: false,
      reg:false,
      /**二维码地址 */
      qrCode: "",
      /**验证登录的token */
      token: "",
      loginType: "",
      username: "",
      password: "",
      second:-1,
      regForm:{
        mobile:'',
        code:'',
        nickname:'',
        password:'',
        repassword:''
      },
      is_register:false,
      is_wechatlogin:false
    };
  },
  mounted() {
    store.ready(state=>{
      this.is_register = state.is_register
      this.is_wechatlogin = state.is_wechatlogin
      this.loginType = state.is_wechatlogin ?  "qrcode" : "account"
      setInterval(() => {
        if (this.visible && this.qrCode && this.token && this.sweepYardRes == 0 && this.loginType === 'qrcode') {
          this.getSweepYardResult();
        }
      }, 2000);
    })
    
  },
  methods: {
    /**
     * 获取微信扫码结果
     */
    getSweepYardResult() {
      doPcLogin({ token: this.token }, { isErrorCall: true }).then(res => {
        if (res.result === "success") {
          this.sweepYardRes = 1;
          setTimeout(() => {
            location.reload();
          }, 1000);
        } else if (res.code === "expired") {
          this.sweepYardRes = 2;
        }
      });
    },
    /**
     * 用户登录
     */
    login() {
      if (!this.username) {
        this.$toast("请输入账户名");
        this.$refs.username.focus();
        return false;
      } else if (!this.password) {
        this.$toast("请输入密码");
        this.$refs.password.focus();
        return false;
      }
      checkLogin({
        username: this.username,
        password: this.password
      }).then(res => {
        this.$notify({
          title: '成功',
          message: '登录成功',
          type: 'success'
        });
        setTimeout(()=>{
          location.reload();
        },1000)
      });
    },
    /**
     * 用户注册
     */
    userReg(){
      if(!this.regForm.nickname){
          this.$msg('请输入昵称')
          this.$refs.nickname.focus()
          return
      }

      if(!this.verifyPhone()){
          return
      }
      if(!this.regForm.code){
          this.$msg('请输入验证码')
          this.$refs.code.focus()
          return
      }
      if(!this.regForm.password){
          this.$msg('请输入登录密码')
          this.$refs.password.focus()
          return
      }
      if(!this.regForm.repassword){
          this.$msg('请再次输入登录密码')
          this.$refs.repassword.focus()
          return
      }
      if(this.regForm.password !== this.regForm.repassword){
          this.$msg('两次输入的密码不一致')
          return
      }
      register(this.regForm).then(res=>{
          if(res.result === 'success'){
              store.ready(state=>{
                  this.$notify({
                    title: '成功',
                    message: '注册成功',
                    type: 'success'
                  })
                  if(state.is_rlogon){
                      checkLogin({
                          username: this.regForm.mobile,
                          password: this.regForm.password
                      }).then(res => {
                          store.dispatch("updateUserInfo").then(() => {
                              location.reload()
                          })
                      })
                  }else{
                      this.reg = false
                  }
              })
          }else{
              this.$msg(res.msg)
          }
      })
    },
    /**
     * 校验手机号码
     */
    verifyPhone(){
        let _mobile = this.regForm.mobile
        if(!_mobile){
            this.$msg('请输入手机号')
            this.$refs.mobile.focus()
            return false
        }
        if(_mobile.length < 11){
            this.$msg('请输入11位手机号')
            this.$refs.mobile.focus()
            return false
        }
        if(!isPoneAvailable(_mobile)){
            this.$msg('请输入有效的手机号')
            this.$refs.mobile.focus()
            return false
        }
        return true
    },
    /**
     * 获取验证码
     */
    getCode(){
        if(this.timer){
            return
        }
        if(this.verifyPhone()){
            sendSms({
                mobile:this.regForm.mobile,
                type:5
            }).then(res=>{
                if(res.result === 'success'){
                    this.second = 60
                    this.timer = setInterval(()=>{
                        this.second--
                        if(this.second == 0){
                            clearInterval(this.timer)
                            this.timer = null
                        }
                    },1000)
                }
                
            })
            
        }
    },
    update() {
      // this.loginType = 'qrcode';
      this.visible = true;
      this.sweepYardRes = 0;
      scanQrCode().then(res => {
        if (res.result === "success") {
          this.qrCode = res.url;
          this.token = res.token;
        } else {
          this.$toast(res.msg);
        }
      });
    }
  }
};
</script>

<style scoped>
/*二维码预览 登录*/
.qrcode {
  text-align: center;
}
.qrcode__img {
  width: 230px;
  height: 230px;
  display: block;
  margin: 0 auto;
  position: relative;
}
.qrcode__restip {
  position: absolute;
  width: 100%;
  height: 230px;
  box-sizing: border-box;
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

.qrcode__state {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.9);
  z-index: 1;
  text-align: center;
  font-size: 14px;
  line-height: 44px;
}
.qrcode__state i {
  width: 44px;
  height: 44px;
  font-size: 44px;
  display: block;
  padding: 8px;
  border: 2px solid #ccc;
  border-radius: 50%;
  margin: 0 auto;
  margin-top: 55px;
}
.qrcode__state--success {
  color: #42c642;
}
.qrcode__state--success i {
  border: 2px solid #42c642;
}

.qrcode__state--error {
  color: #f74f67;
}
.qrcode__state--error i {
  border: 2px solid #f74f67;
}
.account-login ul {
  padding: 10px 0;
}
.account-login li {
  padding: 10px 0;
  position: relative;
}
.account-login .getcode{
  position: absolute;
  right: 10px;
  top: 50%;
  z-index: 100;
  margin-top: -14px;
}
</style>
