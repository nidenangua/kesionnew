<template>
  <div v-if="$route.name">
    <div class="manage" :class="isAlone && 'manage-alone'">
      <div class="manage-header">
        <div class="ks-fl">
          <img src="./assets/logo.png" class="manage-header__logo" v-if="usertype == 1" />
          <img src="./assets/store-logo.png" v-else-if="usertype == 2" class="manage-header__logo" />
        </div>
        <div class="ks-fr">
          <el-dropdown class="ks-fl manage-header__item" @command="openFrameUrl">
            <span class="el-dropdown-link">
              订购服务
              <i class="iconfont icon-arrow-ios-downward-outline"></i>
            </span>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item command="/home.html/default/Service/myapp">我的应用</el-dropdown-item>
              <el-dropdown-item command="/home.html/default/Service/upgrade">升级套餐</el-dropdown-item>
              <el-dropdown-item command="/home.html/default/Shop/CapacityService">扩容服务</el-dropdown-item>
              <el-dropdown-item command="/home.html/default/Service/orderList">我的订单</el-dropdown-item>
              <el-dropdown-item command="/home.html/default/Service/Cart">购 物 车</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
          <div
            class="ks-fl manage-header__item ks-cursor-pointer"
            @click="openFrameUrl('/home.html/default/Massage/problemlist')"
          >问题反馈</div>
          <div
            class="ks-fl manage-header__item"
            @click="openFrameUrl('/home.html/default/Massage/index')"
          >
            <span class="manage-header__msgnum ks-bg-warning" v-if="msgNum != 0">{{msgNum}}</span>
            <i class="iconfont icon-email-outline"></i>
          </div>
          <el-dropdown class="ks-fl manage-header__item" @command="openFrameUrl">
            <span class="el-dropdown-link">
              <ks-create-bg
                class="manage-header__avatar"
                :src="$store.state.userInfo.headimg"
                type="user"
              />
              {{$store.state.userInfo.username}}
              <i class="iconfont icon-arrow-ios-downward-outline"></i>
            </span>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item :command="item.url" v-for="(item,i) in $store.state.accountMenu" :key="i">{{item.title}}</el-dropdown-item>
              <el-dropdown-item command="/home.html/default/User/logout">退出</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </div>
      </div>
      <div
        class="manage-container"
        :style="{height:isAlone ? '' : windowHeight - 50 + 'px',paddingLeft:isAlone ? '' : '180px'}"
      >
        <div class="manage-menu">
          <div class="manage-menu__item" v-for="(item,i) in menu" :key="i">
            <div
              class="manage-menu__name"
              @click="item.unfold = !item.unfold"
              :class="item.id === active && 'manage-menu__active'"
            >
              <i
                class="iconfont icon-chevron-down-outline"
                :class="item.unfold && 'manage-menu__icon_unfold'"
                v-if="item.subtopic && item.subtopic.length"
              ></i>

              <span @click="openRoute(item.url)">{{item.title}}</span>
            </div>
            <el-collapse-transition>
              <div
                class="manage-menu__child clearfix"
                v-if="item.subtopic && item.subtopic.length"
                v-show="item.unfold"
                :class="item.typesetting && 'manage-menu__child_typesetting'+item.typesetting"
              >
                <div
                  class="manage-menu__child__item"
                  v-for="(childItem,c) in item.subtopic"
                  :key="c"
                  :class="childItem.id === active && 'manage-menu__active'"
                >
                  <span @click="openRoute(childItem.url)">{{childItem.title}}</span>
                </div>
              </div>
            </el-collapse-transition>
          </div>
        </div>
        <div class="manage-main">
          <div class="manage-frame" v-if="$route.query.url">
            <iframe name="main" id="main" :src="$route.query.url" v-if="!reload" ref="mainFrame" />
          </div>
          <!--routeLoaded 为true 隐藏路由内容，不做销毁，提高页面加载性能-->
          <div v-show="!$route.query.url" v-if="!$route.query.url || routeLoaded">
            <keep-alive>
              <router-view></router-view>
            </keep-alive>
          </div>
        </div>
      </div>
    </div>

    <popup />
    <!-- <el-dialog :visible.sync="dialogVisible" title="选择您的注册类型" width="1000px" :close-on-click-modal="false" :show-close="false">
      <div class="lecturer-box">
        <div class="lecturer" @click="radio='1'" :class="radio=='1' && 'active'">
          <img src="./assets/lecturer.png">
          <div><el-radio v-model="radio" label="1">&nbsp;</el-radio></div>
          <div class="dia-title">个体讲师、网红大V、自媒体等个人用户</div>
          <div>(立即实名认证，享受万人名师扶持计划，免平台使用费)</div>
        </div>
        <div class="train" @click="radio='2'" :class="radio=='2' && 'active'">
          <img src="./assets/train.png">
          <div><el-radio v-model="radio" label="2">&nbsp;</el-radio></div>
          <div class="dia-title">培训机构、学校、企事业单位</div>
          <div>(拥有自己的独立门户，享受独立域名、独立公众号、独立收款等特权)</div>
        </div>      
      <el-button @click="hide()" class="info-btn" type="primary">确 定 选 择</el-button>
      </div>
    </el-dialog> -->
    <!-- <el-dialog :visible.sync="audit" width="800px" class="lecturer-box">
      <h2>正在审核中...</h2>
      <div class="audit">
        <img src="./assets/audit.png">
        <div>1-2个工作日完成审核<span  v-if="this.usertype == 1">，先花个3分钟，全面了解万人名师扶持计划</span></div>
      </div>
      <el-button  v-if="this.usertype == 1" @click="hidedetails()" class="info-btn" type="primary">了 解 详 情</el-button>
    </el-dialog> -->
  </div>
</template>

<script>
import Popup from "./plugins/popup/Popup";
import { getAppInfo } from "@/api/home";
import { getMsgNum } from "@/api/user";
import { cloneData } from "@/utils";
export default {
  name: "App",
  components: {
    Popup
  },
  data() {
    return {
      isAlone: false,
      routeLoaded: false,
      reload: false,
      active: 0,
      menu: [],
      msgNum: 0,
      windowHeight: window.innerHeight,
      // dialogVisible: false,
      // audit:false,
      // dialogTitle: "",
      // radio: '1',
      usertype:'',
    };
  },
  watch: {
    $route: {
      handler(route) {
        this.setMenuActive();
      },
      deep: true
    }
  },
  mounted() {
    /**获取消息数量 */
    getMsgNum().then(res => {
      this.msgNum = res.num > 99 ? "99+" : res.num;
    });
    window.onresize = () => {
      this.windowHeight = window.innerHeight;
    };

    /**判断用户微信关注状态 */
    this.$store.ready(state => {
      // if(state.info.is_real === true){
      //   if(state.info.teacher_info && state.info.teacher_info.status === '0'){
      //     this.audit = true
      //   }if(state.info.teacher_info && state.info.teacher_info.status === '1'){
      //     this.audit = false
      //   }
      // }else{
      //   this.dialogVisible = true
      // };
      
      // if (
      //   this.$route.name === "Index" &&
      //   state.userInfo.schoolinfo &&
      //   state.userInfo.schoolinfo.websiteinfo &&
      //   state.userInfo.schoolinfo.websiteinfo.initial == 0
      // ) {
      //   popup.open("/home.html/default/Index/initial", {
      //     area: ["800px", "500px"]
      //   });
      // }
      this.usertype = state.info.teacher_info.usertype;
      let manageMenu = cloneData(state.menu);
      let id = 0;
      manageMenu.map((item, i) => {
        id++;
        item.id = id;
        if (item.subtopic && item.subtopic.length) {
          item.unfold = i < 2;
          item.subtopic.map(item=>{
            id++;
            item.id = id;
          })
        }
      });
      let menu = [
        {
          title: "主页",
          url: "/",
          id:0
        }
      ];
      menu = menu.concat(manageMenu);
      this.menu = menu;
      this.setMenuActive();
    });
  },
  methods: {
    setMenuActive() {
      let route = this.$route;
      let fullPath = decodeURIComponent(route.fullPath);
      if (route.name && !route.query.url) {
        this.routeLoaded = true;
      }
      if (
        route.name === "Login" ||
        route.name === "Register" ||
        route.name === "ForgetPassword" ||
        route.name === "Drag" ||
        route.name === "DragPC" ||
        route.name === "DragApplet" || 
        route.name === "CourseKeshi" ||
        (route.name === "GetVodList" && route.query.action !== "list")
      ) {
        this.isAlone = true;
      } else {
        this.isAlone = false;
      }
      this.menu.map(item => {
        if (item.url === fullPath) {
          item.unfold = true;
          this.active = item.id;
        } else if (item.subtopic) {
          item.subtopic.map(child => {
            if (child.url === fullPath) {
              item.unfold = true;
              this.active = child.id;
            }
          });
        }
      });
    },
    /**
     * 打开路由地址
     * @param {String}
     */
    openRoute(url) {
      if (url) {
        if (
          url.indexOf("/?url=") !== -1 &&
          url.split("/?url=")[1] === this.$route.query.url
        ) {
          /**重新加载iframe */
          this.reload = true;
          this.$nextTick(() => {
            this.reload = false;
          });
        } else {
          this.$router.push(url);
        }
      }
    },
    /**
     * 打开iframe页面
     * @param {String}
     */
    openFrameUrl(_url) {
      if(_url.indexOf('/home.html') === 0){
        this.$router.push({
          path:'/',
          query:{
            url:_url
          }
        })
      }else{
        this.$router.push(_url)
      }
    },
    setMenuEnableStatus(item, arr) {
      arr.map(appEnableInfo => {
        if (item.appid == appEnableInfo.appid) {
          if (item.subappid && item.subappid == appEnableInfo.subappid) {
            item.enable = appEnableInfo.enable;
          } else if (!item.subappid) {
            item.enable = appEnableInfo.enable;
          }
        }
      });
    },
    
    // hide(){
    //   this.dialogVisible = false;
    //   if(this.radio === '1'){
    //     this.$router.push('ApplyFor')
    //   }else{
    //     this.$router.push('/?url=/home.html/default/User/realName')
    //   }
    // },
    // hidedetails(){
    //   window.open('https://www.kesion.com/lecturer/')
    // }
  }
};
</script>

<style>
@import url("/assets/reset/reset.css");
@import url("//at.alicdn.com/t/font_1066955_s4o30vin7kr.css");

/*框架样式*/
.manage-header {
  height: 50px;
  overflow: hidden;
  background: #fff;
  box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
  position: relative;
  z-index: 2;
}
.manage-header__logo {
  height: 34px;
  position: relative;
  top: 8px;
  margin-left: 20px;
}
.manage-header__item {
  margin: 0 20px;
  font-size: 14px;
  position: relative;
}
.manage-header__msgnum {
  position: absolute;
  right: -10px;
  top: 0px;
  color: #fff;
  height: 18px;
  line-height: 18px;
  padding: 0 4px;
  font-size: 12px;
  min-width: 10px;
  border-radius: 30px;
}
.manage-header__item .icon-email-outline {
  font-size: 22px;
  color: #666;
  cursor: pointer;
}
.manage-header .ks-fr {
  line-height: 34px;
  position: relative;
  top: 8px;
}

.manage-header__avatar {
  width: 34px;
  height: 34px;
  float: left;
  margin-right: 10px;
  border-radius: 50% !important;
}
.manage-container {
  position: relative;
}
.manage-menu {
  width: 180px;
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  box-sizing: border-box;
  padding-top: 15px;
  z-index: 1;
  overflow-y: auto;
  background: #fff;
}

.manage-menu::-webkit-scrollbar-thumb {
  background: rgba(0, 0, 0, 0.1);
}

.manage-menu__name,
.manage-menu__child__item {
  height: 40px;
  line-height: 40px;
  font-size: 14px;
}
.manage-menu__name {
  position: relative;
}
.manage-menu__name .iconfont {
  position: absolute;
  right: 15px;
  top: 50%;
  height: 20px;
  line-height: 20px;
  margin-top: -10px;
  color: #aaa;
  font-size: 18px;
  transition: 0.3s;
}
.manage-menu__name .manage-menu__icon_unfold {
  transform: rotate(-180deg);
  -ms-transform: rotate(-180deg); /* IE 9 */
  -moz-transform: rotate(-180deg); /* Firefox */
  -webkit-transform: rotate(-180deg); /* Safari 和 Chrome */
  -o-transform: rotate(-180deg); /* Opera */
}
.manage-menu__name span {
  padding-left: 20px;
  display: block;
  cursor: pointer;
}

.manage-menu__child__item span {
  display: block;
  color: #85898d;
  padding-left: 40px;
  cursor: pointer;
}
.manage-menu__name:hover,
.manage-menu__child__item:hover {
  background: #f9f9f9;
}

.manage-menu__active,
.manage-menu__active:hover {
  background: #488bff;
  color: #fff;
}
.manage-menu__active span {
  color: #fff;
}
.manage-menu__child_typesetting2 {
  padding: 0 20px 0 28px;
}
.manage-menu__child_typesetting2 .manage-menu__child__item {
  display: inline-block;
  height: 32px;
  line-height: 32px;
  margin: 4px 5px 4px 0;
  border-radius: 3px;
}
.manage-menu__child_typesetting2 .manage-menu__child__item span {
  padding: 0 12px;
}

.manage-container {
  overflow: hidden;
}

.manage-main {
  width: 100%;
  height: 100%;
  position: relative;
  overflow-x: hidden;
  overflow-y: auto;
}
.manage-frame {
  width: 100%;
  height: 100%;
  position: relative;
  overflow: hidden;
}
.manage-frame iframe {
  width: 100%;
  height: 100%;
  position: relative;
  border: 0px;
}

.manage-alone .manage-header,
.manage-alone .manage-menu {
  display: none;
}

/*旧版应用设置 样式兼容*/
/*----------设置--------------*/
.app-setbox {
  padding-bottom: 15px;
  color: #5a5e65;
  margin-top: -15px;
}
.app-setbox .leftTd {
  padding-right: 10px;
  font-size: 14px;
  white-space: nowrap;
}
.app-setbox td {
  padding: 5px 0;
}
.app-setbox .form-switch label {
  display: none;
}
.app-setbox .switch {
  width: 46px;
  height: 28px;
  background: #d2d2d2;
  border-radius: 50px;
  position: relative;
  cursor: pointer;
  -webkit-transition: 0.3s;
  transition: 0.3s;
  float: left;
}
.app-setbox .switch:before {
  content: "";
  width: 24px;
  height: 24px;
  background: #fff;
  border-radius: 50%;
  box-shadow: 0 0 6px rgba(0, 0, 0, 0.2);
  position: absolute;
  top: 2px;
  right: 20px;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}
.app-setbox .switch-on {
  background: #44d58e;
}
.app-setbox .switch-on:before {
  right: 2px;
}
.app-footer {
  padding-top: 15px;
  border-top: 1px solid #e3e6ea;
  text-align: center;
  height: 34px;
}

.app-setbox input[type="checkbox"],
.app-setbox input[type="radio"] {
  width: 18px;
  height: 18px;
  border: 0px;
  -webkit-appearance: none;
  outline: none;
  cursor: pointer;
  position: relative;
  float: left;
  margin: 5px 5px 0 0;
  background-image: url(./assets/old/check.png);
  background-repeat: no-repeat;
}
.app-setbox input[type="checkbox"] {
  background-position: -18px -18px;
}
.app-setbox input[type="checkbox"]:checked {
  background-position: 0 -18px;
}
.app-setbox input[type="radio"] {
  background-position: -18px 0;
}
.app-setbox input[type="radio"]:checked {
  background-position: 0 0;
}
.app-setbox input[type="checkbox"]:disabled,
.app-setbox input[type="radio"]:disabled {
  filter: alpha(opacity=50);
  -moz-opacity: 0.5;
  -khtml-opacity: 0.5;
  opacity: 0.5;
}
.app-setbox label {
  float: left;
  margin-right: 15px;
  line-height: 28px;
  cursor: pointer;
  color: #666;
  font-size: 14px;
}
.app-setbox .label-on {
  color: #488bff;
}
.app-setbox select,
.app-setbox textarea,
.app-setbox input[type="text"] {
  padding: 8px 10px;
  outline: none;
  -webkit-transition: 0.3s;
  transition: 0.3s;
  border: 1px solid #e6e6e6;
  border-radius: 4px;
  font-size: 14px;
  line-height: 20px;
  width: 288px;
  box-sizing: border-box;
}
.app-setbox textarea:focus,
.app-setbox input[type="text"]:focus {
  border: 1px solid #488bff;
}
.app-setbox textarea {
  height: 140px;
}

/*名师认证*/
.lecturer{
  width: 50%;
  float: left;
  padding: 10px 0;
}
.train img{
  width: 214px;
  height: 206px;
}
.train{
  width: 50%;
  float: right;
  padding: 10px 0;
}
.dia-title{
  color: #000;
  font-weight: 600;
  font-size: 15px;
  line-height: 36px;
}
.audit{
  text-align: center;
  margin-top: 20px;
}
.lecturer-box{
  text-align: center;
  margin: 0 auto;
}
.info-btn{
  margin-top: 20px;
}
.lecturer-box .active{
    background-color: #edf6ff;
    border-radius: 5px;
  }
</style>
