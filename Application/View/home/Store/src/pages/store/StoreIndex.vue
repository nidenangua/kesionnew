<template>
  <ks-container>
    <ks-title name="公众号店铺" border="none">
      <span class="ks-red ks-fz14 ks-ml10" v-if="wechat.isopen == 1">(高级版)</span>
      <div class="ks-fr">
        <el-button
          @click="diyStore"
          type="primary"
          plain
          class="ks-red-btn"
          v-if="diy.isopen == 1 && wechatMenu.diy"
        >装修店铺</el-button>
      </div>
    </ks-title>
    <el-alert type="warning" :closable="false" v-if="diy.isopen == 0 && wechatMenu.diy">
      <span class="ks-fz14">您暂未开通微门户编辑功能</span>
      <el-button type="primary" class="ks-ml20" @click="diyStore">立即试用</el-button>
    </el-alert>
    <el-card class="ks-mt20">
      <div slot="header" class="clearfix">
        <span class="ks-fz16" v-if="wechat.isopen == 1">高级版</span>
        <span class="ks-fz16" v-else>体验版</span>
        <span class="ks-tips ks-ml10" v-if="wechat.isopen == 1">将店铺设置在自己的平台公众号</span>
        <span class="ks-tips ks-ml10" v-else>将店铺设置在微门户平台公众号，无需注册公众号</span>
        <el-button
          class="ks-fr"
          type="text"
          style="padding: 3px 0"
          @click="$router.push('/?url=/home.html/default/Website/websitetemplate/1')"
          v-if="wechatMenu.diy"
        >切换风格</el-button>
      </div>

      <el-menu
        :default-active="$route.fullPath"
        class="el-menu-demo"
        mode="horizontal"
        @select="menuSelect"
      >
        <el-menu-item index="/store">店铺信息</el-menu-item>
        <el-menu-item index="/store/menu" v-if="wechat.isopen == 1 && wechatMenu.customize">自定义菜单</el-menu-item>
        <el-submenu index="autoreply" v-if="wechat.isopen == 1 && wechatMenu.autoReply">
          <template slot="title">自动回复</template>
          <el-menu-item index="/store/autoreply?action=smartreply">关键词回复</el-menu-item>
          <el-menu-item index="/store/autoreply?action=autoreply">收到消息回复</el-menu-item>
          <el-menu-item index="/store/autoreply?action=beadded">被关注回复</el-menu-item>
        </el-submenu>
        <el-menu-item
          index="/store/msgtemplate"
          v-if="wechat.isopen == 1 && wechatMenu.msgTemplate"
        >消息模板管理</el-menu-item>
        <el-submenu index="more" v-if="wechat.isopen == 1">
          <template slot="title">更多模块</template>
          <el-menu-item
            v-for="item in other"
            :key="item.name"
            :index="item.url"
            @click="$router.push(item.url)"
          >{{item.name}}</el-menu-item>
        </el-submenu>
      </el-menu>
      <div class="store-config" v-show="$route.path === '/store'">
        <div class="iphone">
          <div class="h5-name" id="h5Name">{{$store.state.info.sitename}}</div>
          <iframe src="/Application/View/index/h5market/dist/m/index.html"></iframe>
        </div>

        <el-form class="store-form" label-width="160px">
          <div class="store-title" v-if="wechat.isopen == 1 || wechat.isopen == 2">店铺信息</div>
          <el-form-item label="店铺名称">
            <span class="ks-ml20">{{$store.state.info.sitename}}</span>
          </el-form-item>
          <el-form-item label="店铺地址">
            <span class="ks-ml20 ks-link-color">{{$store.state.info.url}}</span>
            <el-button class="ks-red-btn ks-ml20" @click="$copyUrl('storeLink')">复制链接</el-button>
            <input id="storeLink" class="ks-copy-link" :value="$store.state.info.url" type="text" />
          </el-form-item>
          <el-form-item label="到期时间" v-if="wechat.isopen == 1 && wechat.enddate">
            <div class="ks-ml20">
              {{wechat.enddate}}
              <router-link
                to="/?url=home.html/default/Shop/appDetail/23"
                class="ks-ml10 ks-red"
              >续费</router-link>
            </div>
          </el-form-item>
          <el-form-item label="店铺二维码">
            <div class="code-img ks-ml20">
              <img :src="$store.state.info.qrcode" />
            </div>
          </el-form-item>
        </el-form>

        <el-form class="store-form" label-width="160px" v-if="wechat.isopen == 1">
          <div class="store-title">公众号信息</div>
          <el-form-item label="公众号主体名称">
            <span class="ks-ml20">{{wechat.authorizer_info.principal_name}}</span>
          </el-form-item>
          <el-form-item label="公众号简要介绍">
            <span class="ks-ml20">{{wechat.authorizer_info.signature}}</span>
          </el-form-item>
          <el-form-item label="公众号类型" v-if="wechat.authorizer_info.service_type_info">
            <span class="ks-ml20" v-if="wechat.authorizer_info.service_type_info.id == 0">订阅号</span>
            <span
              class="ks-ml20"
              v-if="wechat.authorizer_info.service_type_info.id == 1"
            >历史老帐号升级后的订阅号</span>
            <span class="ks-ml20" v-if="wechat.authorizer_info.service_type_info.id == 2">服务号</span>
          </el-form-item>
          <el-form-item label="公众号功能开通情况" v-if="wechat.authorizer_info.business_info">
            <div class="wechat-authorize-list ks-ml20">
              <ul>
                <li :class="wechat.authorizer_info.business_info.open_pay && 'open'">
                  <i class="iconfont icon-chenggong"></i>是否开通微信支付功能
                </li>
                <li :class="wechat.authorizer_info.business_info.open_store && 'open'">
                  <i class="iconfont icon-chenggong"></i>是否开通微信门店功能
                </li>
                <li :class="wechat.authorizer_info.business_info.open_scan && 'open'">
                  <i class="iconfont icon-chenggong"></i>是否开通微信扫商品功能
                </li>
                <li :class="wechat.authorizer_info.business_info.open_card && 'open'">
                  <i class="iconfont icon-chenggong"></i>是否开通微信卡券功能
                </li>
                <li :class="wechat.authorizer_info.business_info.open_shake && 'open'">
                  <i class="iconfont icon-chenggong"></i>是否开通微信摇一摇功能
                </li>
              </ul>
            </div>
          </el-form-item>
          <el-form-item label="公众号已授权权限集">
            <div class="wechat-authorize-set ks-ml20" v-if="wechat.func_info.length">
              <span
                v-for="(item,index) in wechat.func_info"
                :key="item.id"
                :class="item.open && 'open'"
              >{{index+1}}、{{item.name}}</span>
            </div>
            <div class="wechat-authorize-set ks-ml20" v-else>暂无授权项</div>
          </el-form-item>
          <el-form-item label="公众号二维码">
            <div class="code-img ks-ml20">
              <img :src="wechat.authorizer_info.qrcode_url" />
            </div>
          </el-form-item>
          <el-form-item v-if="wechatMenu.bind">
            <el-button
              class="ks-red-btn ks-ml20"
              @click="$router.push('/?url=/home.html/wechat/Index/wechatConfig?appid-23')"
            >重新绑定公众号</el-button>
          </el-form-item>
        </el-form>
      </div>

      <keep-alive>
        <router-view></router-view>
      </keep-alive>
    </el-card>
    <el-card class="ks-mt20" v-if="wechat.isopen != 1">
      <div slot="header" class="clearfix">
        <span class="ks-fz16">升级版</span>
        <span class="ks-tips ks-ml10">将店铺设置在您自己的公众号，收入直接进入您的微信支付对应的收款账户</span>
      </div>

      <div class="advanced-version">
        <p>
          绑定高级版公众号：
          <br />1.前提条件：你需要在微信公众平台申请开通“微信认证服务号”，且此服务号需要向微信申请开通“微信支付权限”；
          <br />2.服务号一经绑定不可更换，绑定后您可以使用自己服务号的微信支付；
          <br />3.收入直接进入您的微信支付对应的收款账户，且不用经过平台，免去交易手续费；
          <br />4. 您还可以通过此服务号给用户发送服务号通知。
        </p>

        <el-button class="ks-mt30" type="primary" @click="openWechat()" v-if="wechatMenu.bind">绑定公众号</el-button>
        <div
          class="ks-mt10 ks-fz14 ks-color-primary"
          v-if="$store.state.info.version === 'testv1'"
        >{{$store.state.info.version_msg}}</div>
      </div>
    </el-card>
  </ks-container>
</template>
<script>
import { checkModuleHasOpen } from "@/api/store";
export default {
  name: "StoreSetup",
  data() {
    return {
      diy: {
        isopen: -1
      },
      wechat: {
        enddate: "",
        price: null,
        /**0未开通 1已开通 2已开通未授权 */
        isopen: 1,
        func_info: [],
        authorizer_info: {}
      },
      /**菜单权限 */
      wechatMenu: {},
      other: []
    };
  },
  activated() {
    this.wechatMenu = {
      customize: false,
      diy: false,
      autoReply: false,
      msgTemplate: false,
      material: false,
      msgManage: false,
      data: false,
      bind:false
    };
    this.other = [];
    this.getMenuAuthorityByKey("store").then(authority => {
      if (authority.childs) {
        authority.childs.map(item => {
          item.action = item.action.toString();
          switch (item.action) {
            case "1":
              /**绑定公众号 */
              this.wechatMenu.bind = item.power;
              break
            case "2":
              /**自定义菜单 */
              this.wechatMenu.customize = item.power;
              break;
            case "3":
              /**自动回复 */
              this.wechatMenu.autoReply = item.power;
              break;
            case "4":
              /**店铺装修 */
              this.wechatMenu.diy = item.power;
              break;
            case "5":
              /**素材管理 */
              this.other.push({
                url: "/store/material",
                name: "素材管理"
              });
              break;
            case "6":
              /**留言管理 */
              this.other.push({
                url: "/store/msgmanage",
                name: "留言管理"
              });
              break;
            case "7":
              /**数据统计 */
              this.other.push({
                url: "/store/more?act=index",
                name: "数据统计"
              });
              break;
            case "8":
              /**消息模板 */
              this.wechatMenu.msgTemplate = item.power;
              break;
          }
        });
      }
    });
    this.$showLoading();
    /**
     * 获取装修插件开通情况
     */
    checkModuleHasOpen({
      appid: 102
    }).then(res => {
      if (res.result === "success") {
        this.diy.isopen = 1;
      } else {
        this.diy.isopen = 0;
      }
    });
    /**
     * 获取公众号开通情况
     */
    checkModuleHasOpen({
      appid: 23
    }).then(res => {
      if (res.result === "success") {
        this.wechat.enddate = res.enddate;
        if (res.code === "unbind") {
          this.wechat.isopen = 2;
        } else {
          this.wechat.isopen = 1;
        }
        if (res.weixininfo) {
          this.wechat.authorizer_info = res.weixininfo.authorizer_info;
          let arr = new Array();
          let func_info = res.weixininfo.authorization_info.func_info;
          func_info.map(item => {
            let name;
            switch (item.funcscope_category.id) {
              case 1:
                name = "消息管理权限";
                break;
              case 2:
                name = "用户管理权限";
                break;
              case 3:
                name = "帐号服务权限";
                break;
              case 4:
                name = "网页服务权限";
                break;
              case 5:
                name = "微信小店权限";
                break;
              case 6:
                name = "微信多客服权限";
                break;
              case 7:
                name = "群发与通知权限";
                break;
              case 8:
                name = "微信卡券权限";
                break;
              case 9:
                name = "微信扫一扫权限";
                break;
              case 10:
                name = "微信连WIFI权限";
                break;
              case 11:
                name = "素材管理权限";
                break;
              case 12:
                name = "微信摇周边权限";
                break;
              case 13:
                name = "微信门店权限";
                break;
              case 14:
                name = "微信支付权限";
                break;
              case 15:
                name = "自定义菜单权限";
                break;
            }
            if (name) {
              arr.push({
                id: item.funcscope_category.id,
                name: name
              });
              this.wechat.func_info = arr;
            }
          });
        }
      } else {
        this.wechat.isopen = 0;
        if (res.appinfo) {
          this.wechat.price = res.appinfo.price;
        }
      }

      this.$hideLoading();
    });
  },
  methods: {
    /**
     * 选择菜单
     */
    menuSelect(url) {
      this.$router.push(url);
    },
    /**
     * 装修
     */
    diyStore() {
      this.$store.ready(state=>{
        if(state.info.version > 0 && state.info.version<=10) {
          let routeData = this.$router.resolve({
            name: "Drag"
          });
          window.open(routeData.href);
        }else {
          this.$tipsDialog(state.info.version_msg, {
              buttons: [
                {
                  name: "升级为高级运营版",
                  url: state.info.version_url
                }
              ]
            })
        }
      })
    },
    openWechat() {
      this.$store.ready(state => {
        let msg, buttonText;

        if (state.info.version == 100) {
            this.$tipsDialog(state.info.version_msg, {
              buttons: [
                // {
                //   name: "去绑定",
                //   type: "primary",
                //   url: state.info.auth_url
                // },
                {
                  name: "升级为高级运营版",
                  url: state.info.version_url
                }
              ]
            })
        }else if(state.info.version > 0){
          /**vip版本跳到授权页 */
          KTJ_FrameRouteJump(state.info.auth_url)
        }else{
          this.$tipsDialog(state.info.version_msg, {
            buttons: [
              {
                name: "去升级",
                type: "primary",
                url: state.info.version_url
              }
            ]
          })
        }
      })
    }
  }
};
</script>
<style scoped>
.store-config {
  position: relative;
  padding: 0 30px 30px 440px;
  min-height: 760px;
  margin-top: 30px;
}
.store-config .iphone {
  width: 325px;
  padding: 0 16px;
  height: 614px;
  left: 30px;
  top: 0;
  padding-top: 136px;
  background: url(../../assets/store/phone.png) no-repeat;
  position: absolute;
}
.store-config .iphone .h5-name {
  height: 32px;
  width: 200px;
  line-height: 32px;
  position: absolute;
  top: 100px;
  left: 50%;
  margin-left: -100px;
  font-size: 15px;
  color: #fff;
  text-align: center;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}

.store-config .iphone iframe {
  width: 100%;
  height: 533px;
  border: 0px;
}
.store-config .store-form {
  padding: 20px 0;
}
.store-config .store-title {
  font-size: 14px;
  height: 44px;
  line-height: 44px;
  border-bottom: 1px solid #eee;
  position: relative;
  margin-bottom: 20px;
  padding-left: 15px;
}
.store-config .store-title::before {
  content: "";
  width: 3px;
  height: 18px;
  position: absolute;
  left: 0;
  top: 50%;
  margin-top: -9px;
  background: #409eff;
}
.store-config .code-img {
  width: 130px;
  height: 130px;
  border: 1px solid #eee;
}
.store-config .code-img img {
  display: block;
  width: 100%;
  height: 100%;
}

.store-config .logo {
  width: 150px;
  height: 150px;
  border: 1px solid #eee;
  border-radius: 4px;
  background: #fff !important;
  float: left;
  margin-right: 20px;
}

/*公众号授权信息*/
.wechat-authorize-list li {
  color: #aaa;
}

.wechat-authorize-list li i {
  margin-right: 10px;
  color: #ccc;
}
.wechat-authorize-list li.open {
  color: #333;
}
.wechat-authorize-list li.open i {
  color: #5fc31c;
}
.wechat-authorize-set span {
  margin-right: 20px;
}

.advanced-version {
  line-height: 26px;
  padding: 20px;
}
.advanced-version .price {
  color: #666;
  margin-top: 10px;
}
</style>


