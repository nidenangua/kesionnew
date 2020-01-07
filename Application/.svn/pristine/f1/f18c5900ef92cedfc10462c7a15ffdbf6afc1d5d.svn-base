<template>
  <div class="login-state">
    <div class="login-state__warp" v-if="isLogin === 1">
      <div class="login-state__icon ks-icon ks-icon-checkmark-circle- ks-color-success"></div>
      <div class="login-state__text">登录成功</div>
    </div>
    <div class="login-state__warp" v-if="isLogin === 0">
      <div class="login-state__icon ks-icon ks-icon-info ks-color-error"></div>
      <div class="login-state__text">登录失败</div>
    </div>
  </div>
</template>
<script>
import {doPhoneLogin} from '@/api/user'
export default {
    /**登录状态 */
    name:'LoginState',
    data(){
        return {
            isLogin:-1
        }
    },
    mounted(){
        this.$store.ready(state=>{
            this.isLogin = state.isLogin;
            if(state.isLogin === 1){
                let params = this.$route.query;
                params.unionid = state.userInfo.unionid;
                doPhoneLogin(params).then(res=>{
                    //...
                })
            }
        })
    }
}
</script>

<style scoped>
.login-state {
  text-align: center;
  display: flex;
  align-items: center;
  position: absolute;
  left: 0;
  top:0;
  width: 100%;
  height: 100%;
  max-width: 480px;
  left:0;
  right: 0;
  margin:auto;
  background: #fff;
}
.login-state__warp{
    width: 100%;
}
.login-state__icon {
  font-size: 96px;
}
.login-state__text {
  font-size: 18px;
  margin-top:10px;
  color:#666;
}
</style>
