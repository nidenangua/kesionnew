<template>
  <ks-container>
    <ks-title name="小程序店铺">
      <div class="ks-fr">
        <el-button @click="diyStore" class="ks-red-btn">装修店铺</el-button>
      </div>
    </ks-title>
    <el-card class="ks-mt20">
      <div slot="header" class="clearfix">
        <span class="ks-fz16">体验版</span>
        <span class="ks-tips ks-ml10">将店铺设置在V名片小程序，无需注册小程序</span>
        <!-- <el-button
          class="ks-fr"
          type="text"
          style="padding: 3px 0"
          @click="$router.push({name:'MiniprogramStyle'})"
        >切换风格</el-button> -->
      </div>
      <div class="miniprogram-code">
        <el-image
          v-if="generatecode"
          class="miniprogram-code__image"
          fit="cover"
          :src="generatecode"
        />
        <p class="ks-fz14 ks-mt10 ks-color-info">扫码即可查看小程序店铺</p>
      </div>
    </el-card>
    <!-- <el-card class="ks-mt20">
      <div slot="header" class="clearfix">
        <span class="ks-fz16">升级版</span>
      </div>
      <div class="miniprogram-vesion">
        <strong>开通高级版小程序，您可以：</strong>
        <br>1. 将自己的小程序绑定店铺；
        <br>2. 服务号一经绑定不可更换，绑定后您可以使用自己服务号的微信支付；
        <br>3. 收入直接进入您的微信支付对应的收款账户，且不用经过平台，免去交易手续费；
        <br>4. 您还可以通过此服务号给用户发送服务号通知。
        <br>
        <el-button class="ks-mt20" type="primary">立即开通</el-button>
      </div>
    </el-card> -->
  </ks-container>
</template>
<script>
import { generateCode } from '@/api/applet'
export default {
  name: "MiniprogramIndex",
  data() {
    return {
      generatecode:""
    };
  },
  methods: {
    diyStore() {
      let routeData = this.$router.resolve({
        name: "DragApplet"
      });
      window.open(routeData.href);
    }
  },
  mounted() {
    this.$store.ready(state=>{
      generateCode({
        page:'pages/store/index/index',
        scene:`teacherid-${state.userInfo.userid}`,
        wxid:state.info.wxid,
      }).then(res=>{
        this.generatecode = res.generatecode
      })
    })
  }
};
</script>
<style scoped>
.miniprogram-code {
  text-align: center;
  padding: 15px 0;
}
.miniprogram-code__image {
  width: 200px;
  height: 200px;
}
.miniprogram-vesion strong {
  color: #444;
}
.miniprogram-vesion {
  padding: 15px 30px;
  font-size: 14px;
  line-height: 30px;
  color: #666;
}
</style>

