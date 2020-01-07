<template>
  <ks-container v-if="loaded">
    <el-header height="auto">
      <el-breadcrumb separator="/">
        <el-breadcrumb-item :to="{ path: '/receipt' }">收款设置</el-breadcrumb-item>
        <el-breadcrumb-item>配置信息</el-breadcrumb-item>
      </el-breadcrumb>
    </el-header>
    <div class="recepit__box">
      <div class="recepit__box-item">
        <div class="recepit__box-title">基本信息</div>
        <div class="recepit__box-info recepit__box-mt30">
          <div class="recepit__box-label">当前状态：</div>
          <div
            class="recepot__box-content"
          >{{(status=='plat'&& '未开启') ||(status=='school'&& '已开启')}}</div>
        </div>
     
      </div>
      <div class="recepit__box-item">
        <div class="recepit__box-title">公众号授权信息</div>
        <div class="recepit__box-info recepit__box-mt30">
          <div class="recepit__box-label">微信公众号：</div>
          <div class="recepot__box-content">{{setting.weixinname}}</div>
        </div>
        <div class="recepit__box-info">
          <div class="recepit__box-label">微信账户类型：</div>
          <div class="recepot__box-content">已认证服务号</div>
        </div>
      </div>
      <div class="recepit__box-item" style="display:none">
        <div class="recepit__box-title">业务域名设置</div>
        <div class="recepit__box-tit recepit__box-info">需要登录微信公众号平台将以下URL配置到对应位置</div>
        <div class="recepit__box-info">
          <div class="recepit__box-label">业务域名设置</div>
          <div class="recepot__box-content">

          </div>
        </div>
        <div class="recepit__box-info">
          <div class="recepit__box-label">业务域名：</div>
          <input type="hidden" ref="appurl" v-model="apptxt">
          <div class="recepot__box-content">
            <el-button type="primary" size="small" @click="geturl()">点击获取</el-button>
          </div>
        </div>
      </div>
      <div class="recepit__box-item">
        <div class="recepit__box-title">支付设置</div>
        <div class="recepit__box-tit recepit__box-info">需要登录微信公众号平台将以下URL配置到对应位置</div>
        <div class="recepit__box-info">
          <div class="recepit__box-label">商务号(MchId)：</div>
          <div class="recepot__box-content">
            {{setting.MchId}}
            <a>如何获取微信商户号</a>
          </div>
        </div>
        <div class="recepit__box-info">
          <div class="recepit__box-label">应用id(AppId)：</div>
          <div class="recepot__box-content">{{setting.AppId}}</div>
        </div>
        <div class="recepit__box-info">
          <div class="recepit__box-label">支付API KEY(AppSecret):</div>
          <div class="recepot__box-content">
            {{setting.AppSecret}}
            <a>如何获取微信商户API秘钥？</a>
          </div>
        </div>
        <div class="recepit__box-info">
          <el-button type="primary" class="geturl" size="small" @click="geturl()">重新绑定微信收款账号</el-button>
        </div>
      </div>
    </div>
  </ks-container>
</template>
<script>
import { checkModuleHasOpen } from "@/api/setting";
export default {
  name: "set",
  data() {
    return {
      loaded: true,
      setting: {},
      apptxt: "sdasdasdad",
      status: ""
    };
  },
  methods: {
    geturl() {
      this.$refs.appurl.select(); // 选择对象
      document.execCommand("Copy"); // 执行浏览器复制命令
    },
    geturl() {
      this.$router.push(
        "/?url=/home.html/pay/Index/wechatservice?appid-19,type-wx,do-rebind"
      );
    }
  },
  activated() {
    checkModuleHasOpen({
      appid: 19
    }).then(res => {
      if (res.setting) {
        this.setting = res.setting;
        this.appurl = res.setting.applyurl;
        this.status = res.status;
      } else {
        this.$router.push("/receipt");
      }
    });
  }
};
</script>
<style scoped>
.recepit__box {
  padding: 30px;
}
.recepit__box-item {
  margin-bottom: 30px;
}
.recepit__box-title {
  color: #1f2f3d;
  position: relative;
  padding-left: 10px;
  font-weight: 400;
  font-size: 20px;
  font-family: Helvetica Neue, Helvetica, PingFang SC, Hiragino Sans GB,
    Microsoft YaHei, SimSun, sans-serif;
}
.recepit__box-title::before {
  position: absolute;
  width: 3px;
  height: 18px;
  background: #e5412c;
  content: "";
  display: block;
  left: 0;
  top: 50%;
  margin-top: -9px;
}
.recepit__box-label {
  text-align: right;
  vertical-align: middle;
  float: left;
  font-size: 14px;
  color: #606266;
  line-height: 40px;
  padding: 0 12px 0 0;
  box-sizing: border-box;
  padding-left: 10px;
}
.recepot__box-content {
  margin-left: 160px;
  line-height: 40px;
  position: relative;
  font-size: 14px;
  max-width: 700px;
}
.recepit__box-mt30 {
  margin-top: 30px;
}
.recepit__box-mb30 {
  margin-bottom: 30px;
}
.recepit__box-case {
  color: #e5412c;
  display: block;
  padding-left: 0 !important;
}
.recepit__box-tit {
  font-size: 14px;
  color: #999;
  line-height: 40px;
  margin-top: 30px;
  padding-left: 10px;
}
.recepot__box-content a {
  color: #ed512a;
  padding-left: 30px;
}
.recepit__box-edit {
  font-size: 14px;
  color: #e5412c;
  font-style: normal;
  padding-left: 10px;
}
.geturl {
  margin-left: 10px;
  margin-top: 10px;
}
</style>


