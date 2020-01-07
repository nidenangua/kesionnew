<template>
  <div class="store-footer">
    <div class="store-footer__link" v-if="$route.query.miniprogram != 1">
      <span @click="$router.push('/')">店铺主页</span>
      <span @click="$router.push('/course')">{{$store.state.userInfo.schoolinfo && $store.state.userInfo.schoolinfo.websiteinfo.isattention == 0 ? "课程" :"发现"}}</span>
      <span @click="visible = true" v-if="$store.state.info && $store.state.info.isattention == 1">关注我们</span>
      <span @click="$router.push('/user')">个人中心</span>
    </div>
    <div class="store-footer__copyright" v-if="$store.state.info.domain_status">
      {{$store.state.info.copyright}}
    </div>
    <div class="store-footer__copyright" v-else>
      科汛提供技术支持
      <br>www.kesion.com
    </div>
    <ks-dialog width="70%" :visible.sync="visible" :title="$store.state.info.sitename">
      <img width="100%" style="display:block;" :src="$store.state.info.weixinqr"/>
      长按识别二维码关注公众号
    </ks-dialog>
  </div>
</template>
<script>
export default {
  name: "StoreFooter",
  data(){
    return {
      visible:false
    }
  }
};
</script>
<style scoped>
.store-footer {
  padding: 15px 10px;
  text-align: center;
  line-height: 20px;
  color:var(--prompt-color)
}
.store-footer__copyright{
  line-height: 18px;
  margin-top: 6px;
}
.store-footer__link span {
  padding: 0 8px;
  position: relative;
}
.store-footer__link span::before {
  content: "";
  width: 1px;
  height: 12px;
  background: var(--prompt-color);
  position: absolute;
  left: -2px;
  top: 50%;
  margin-top: -6px;
}
.store-footer__link span:first-child::before {
  display: none;
}
</style>
