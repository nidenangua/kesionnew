<template>
  <div class="kd-header kd-header--style2" v-if="dataItem.style == 2">
    <div class="kd-head">
        <!-- logo图 -->
        <div class="kd-head__logo  kd-head__logo--auto" @click="$router.push('/')" v-if="$store.state.info.logo">
          <ks-image type="logo" :src="$store.state.info.pclogo" fit="contain" />
        </div>
        <div class="kd-head__logo" @click="$router.push('/')" v-else>
          <ks-image type="logo" :src="$store.state.info.logo" fit="contain" />
          {{$store.state.info.sitename}}
        </div>
        <!-- 导航栏 -->
        <kd-nav :nav-list="dataItem.navList" :styleid="dataItem.style" :other="dataItem.other"></kd-nav>
        <!-- 搜索框 -->
        <div class="kd-head__search">
          <input type="text" placeholder="请输入您要搜索的课程" v-model="keyword" @change="goSearch" />
          <img src="./sousuo.png" />
        </div>
        <!-- login -->
        <div class="kd-head__login">
          <a @click="$showLogin()" v-if="$store.state.isLogin != 1">登录</a>
          <el-dropdown v-else @command="handleCommand">
            <div class="kd-head__uname"><ks-image :src="$store.state.userInfo.headimg" type="user" /><span>{{$store.state.userInfo.name}}</span></div>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item command="/user/course">我的课程</el-dropdown-item>
              <el-dropdown-item command="/user/coupon">
                我的优惠券
                <i style="font-style: normal;margin-left: 40px;color: #2e84ee;" @click.stop="$router.push('/user/couponhome')">去领取</i>
              </el-dropdown-item>
              <el-dropdown-item command="/user/order">我的订单</el-dropdown-item>
              <el-dropdown-item command="/user/basicSettings">设置</el-dropdown-item>
              <el-dropdown-item command="outLogin" divided>退出</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </div>
      </div>
  </div>
  <div v-else>
    <div class="box">
      <div class="kd-head">
        <!-- logo图 -->
        <div class="kd-head__logo kd-head__logo--auto" @click="$router.push('/')" v-if="$store.state.info.pclogo">
          <ks-image type="logo" :src="$store.state.info.pclogo" fit="contain" />
        </div>
        <div class="kd-head__logo" @click="$router.push('/')" v-else>
          <ks-image type="logo" :src="$store.state.info.logo" fit="contain" />
          {{$store.state.info.sitename}}
        </div>
        <!-- 搜索框 -->
        <div class="kd-head__search">
          <input type="text" placeholder="请输入您要搜索的课程" v-model="keyword" @change="goSearch" />
          <img src="./sousuo.png" />
        </div>
        <!-- login -->
        <div class="kd-head__login">
          <a @click="$showLogin()" v-if="$store.state.isLogin != 1">登录</a>
          <el-dropdown v-else @command="handleCommand">
            <div class="kd-head__uname"><ks-image :src="$store.state.userInfo.headimg" type="user" /><span>{{$store.state.userInfo.name}}</span></div>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item command="/user/course">我的课程</el-dropdown-item>
              <el-dropdown-item command="/user/coupon">
                我的优惠券
                <i style="font-style: normal;margin-left: 40px;color: #2e84ee;" @click.stop="$router.push('/user/couponhome')">去领取</i>
              </el-dropdown-item>
              <el-dropdown-item command="/user/order">我的订单</el-dropdown-item>
              <el-dropdown-item command="/user/basicSettings">设置</el-dropdown-item>
              <el-dropdown-item command="outLogin" divided>退出</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
          <a @click="open('/user/course')">我的学习</a>
          <a @click="open('/user/couponhome')">领券中心</a>
          <a class="kd-head__login-red" @click="open('/user/vip')">开通会员</a>
        </div>
      </div>
    </div>
    <!-- 导航栏 -->
    <kd-nav :nav-list="dataItem.navList" :other="dataItem.other"></kd-nav>
  </div>
</template>

<script>
import { checkLogin, loginOut } from "@/api/user";
import { cloneData } from "@/utils";
export default {
  name: "KdHeader",
  props: {
    dataItem: {
      type: Object,
      default() {
        return {};
      }
    }
  },
  data() {
    return {
      centerDialogVisible: false,
      keyword: ""
    };
  },
  watch:{
    "$route.query.key"(key){
      this.keyword = key
    }
  },
  methods: {
    goSearch() {
      let query = cloneData(this.$route.query);
      query.key = this.keyword;
      let name = this.$route.name;
      if(name !== 'CourseList' && name !== 'LiveList' && name !== 'ColumnList'){
        name = "CourseList"
      }
      this.$router.push({
        name:name,
        params:this.$route.params,
        query:query
      })
    },
    /*
     * 打开页面
     * */
    open(url) {
      this.$store.ready(state => {
        if (state.isLogin != 1) {
          this.$showLogin();
        } else {
          this.$router.push(url);
        }
      });
    },

    /*
     * 菜单跳转
     * */
    handleCommand(msg) {
      if (msg === "outLogin") {
        this.$confirm("是否确定退出", "提示", {
          confirmButtonText: "确定",
          cancelButtonText: "取消",
          type: "warning"
        }).then(() => {
          loginOut({}).then(res => {
            if (res.result == "success") {
              this.$store.dispatch("updateUserInfo")
            }
          });
        });
      } else {
        this.open(msg);
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.box {
  width: 100%;
  height: 40px;
  background: #fff;
  padding: 30px 0;
}
.kd-head {
  width: 1200px;
  height: 44px;
  margin: 0 auto;
  position: relative;
}
/* 头部logo */
.kd-head__logo {
  height: 40px;
  float: left;
  line-height: 40px;
  cursor: pointer;
  font-size: 20px;
  font-weight: bold;
  color: #555;
  width: 220px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.kd-head__logo .ks-image {
  width: 36px;
  height: 36px;
  float: left;
  margin: 2px 15px 0 0;
  overflow: hidden;
}

.kd-head__logo--auto .ks-image {
  width: auto;
  height: 44px;
}
/* 搜素框 */
.kd-head__search {
  width: 400px;
  height: 44px;
  border-radius: 22px;
  background: #fafafa;
  margin-left: 20px;
  float: left;
  box-sizing: border-box;
}
.kd-head__search input {
  border: none;
  outline: none;
  background:none;
  margin:5px 0 0 15px;
  height: 34px;
  width: 280px;
  line-height: 34px;
  box-sizing: border-box;
}
.kd-head__search input::placeholder {
  font-size: 14px;
  color: #a1a4a6;
}
.kd-head__search img {
  width: 20px;
  height: 20px;
  margin-right: 15px;
  float: right;
  margin-top: 12px;
}
/* 登陆 */
.kd-head__login {
  height: 44px;
  float: right;
  font-size: 14px;
  line-height: 44px;
  color: #2d3336;
}
.kd-head__login a {
  margin-left: 30px;
  cursor: pointer;
  float: right;
}
.kd-head__uname{
  max-width: 150px;
  display: inline-block;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.kd-head__login-red {
  color: #2e84ee;
}
.el-dropdown {
  margin-left: 30px;
  cursor: pointer;
  float: right;
  height: 44px;
}
.el-dropdown .ks-image {
  height: 32px;
  width: 32px;
  border-radius: 50%;
  overflow: hidden;
  float: right;
  margin-top: 6px;
  margin-left: 6px;
}
.el-dropdown i {
  font-size: 14px;
  font-style: normal;
  color: #36404a;
  display: inline-block;
  max-width: 70px;
  height: 44px;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}
.kd-header--style2{
  padding: 28px 0;
  background: #fff;
  .kd-nav{
    width: 560px;
    float: left;
  }
  /deep/ .kd-nav--box{
    width: auto;
  }
  /deep/ .kd-menu{
    width: auto;
  }
  .kd-head__search{
    margin-left: 0px;
    width: 300px;
    background: #f9f9f9;
    border:1px solid #e3e3e3;
    input{
      width: 240px;
    }
  }

  
}
</style>
