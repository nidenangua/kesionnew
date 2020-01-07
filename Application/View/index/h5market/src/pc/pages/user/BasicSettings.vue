<template>
  <div class="basicSettings">
    <!-- 头部分页区 -->
    <div class="basicSettings-top">
      <h1>基本设置</h1>
    </div>
    <!-- 内容区 -->
    <div class="basicSettings-main">
      <div class="basicSettings-main__avatar">
        <ks-image :src="$store.state.userInfo.headimg" type="user" fit="cover" />
        <el-button size="medium" @click="changeAvatar">更换头像</el-button>
        <input style="display: none;" type="file" ref="file_avatar" @change="uploadAvatar" />
      </div>
      <div class="basicSettings-main__item">
        <p>账号：</p>
        <span>{{$store.state.userInfo.username}}</span>
        <span class="ks-color-info" @click="editorialMaterials">编辑资料</span>
      </div>
      <div class="basicSettings-main__item">
        <p>昵称：</p>
        <el-input v-if="changeInfo" v-model="name" placeholder="请输入内容"></el-input>
        <span v-else>{{$store.state.userInfo.name}}</span>
      </div>
      <div class="basicSettings-main__item">
        <p>邮箱：</p>
        <el-input v-if="changeInfo" v-model="eMail" placeholder="请输入内容"></el-input>
        <span v-else>{{$store.state.userInfo.email}}</span>
      </div>
      <div class="basicSettings-main__item">
        <p>手机号：</p>
        <el-input v-if="changeInfo" v-model="phone" placeholder="请输入内容"></el-input>
        <span v-else>{{$store.state.userInfo.mobile}}</span>
      </div>
      <div class="basicSettings-main__item" v-if="!changePwd">
        <p>密码：</p>
        <span>********</span>
        <span class="ks-color-info" @click="changePassword">修改密码</span>
      </div>
      <div v-if="changePwd" class="basicSettings-main__item">
        <p>旧密码：</p>
        <el-input
          v-model="oldpwd"
          type="password"
          placeholder="请输入旧密码"
          style="width: 120px;"
          @keyup.enter.native="submit"
        ></el-input>
      </div>
      <div v-if="changePwd" class="basicSettings-main__item">
        <p>新密码：</p>
        <el-input
          v-model="newpwd"
          type="password"
          placeholder="请输入新密码"
          style="width: 120px;"
          @keyup.enter.native="submit"
        ></el-input>
      </div>
      <div class="basicSettings-main__btn" v-if="changeInfo">
        <el-button type="primary" @click="submitInfo">确定</el-button>
        <el-button @click="closeBtn">取消</el-button>
      </div>
      <div class="basicSettings-main__btn" v-if="changePwd">
        <el-button type="primary" @click="submitPwd">确定</el-button>
        <el-button @click="closeBtn">取消</el-button>
      </div>
    </div>
  </div>
</template>

<script>
import { compressImg } from "@/utils";
import { getUserInfo, savePersonMsg, changeHead } from "@/api/user";
export default {
  name: "BasicSettings",
  data() {
    return {
      changeInfo: false,
      changePwd: false,
      oldpwd: "",
      newpwd: "",
      name: "",
      eMail: "",
      phone: ""
    };
  },
  methods: {
    editorialMaterials() {
      //修改资料
      this.changeInfo = true;
      this.changePwd = false;
    },
    changePassword() {
      //修改密码
      this.changePwd = true;
      this.changeInfo = false;
    },
    /*
     * 获取用户信息
     *
     * */
    getUserInfo() {
      getUserInfo({}).then(res => {
        if (res.result == "success") {
          this.name = res.memberinfo.name;
          this.eMail = res.memberinfo.email;
          this.phone = res.memberinfo.mobile;
        } else {
          this.$toast("请先登录");
        }
      });
    },
    /*
     * 取消编辑
     *
     * */
    closeBtn() {
      this.changeInfo = false;
      this.changePwd = false;
    },
    submit(e) {
      if (e.keyCode === 13) {
        this.submitPwd();
      }
    },
    /*
     * 提交修改资料
     *
     * */
    submitInfo() {
      if (this.name == "") {
        this.$toast("请输入昵称");
        return false;
      } else if (this.phone == "") {
        this.$toast("请输入手机号");
        return false;
      }
      savePersonMsg({
        mobile: this.phone,
        email: this.eMail,
        name: this.name,
        type: 1
      }).then(res => {
        if (res.result == "success") {
          this.$store.dispatch("updateUserInfo");
          this.changeInfo = false;
          this.$toast(res.msg, "success");
          this.$store.ready(state => {
            this.isLogin = state.isLogin;
            if (this.isLogin != 1) {
              this.$toast("请登录");
              return;
            } else {
              this.name = state.userInfo.name;
              this.eMail = state.userInfo.email;
              this.phone = state.userInfo.mobile;
            }
          });
        } else {
          this.$toast(res.msg);
        }
      });
    },
    /*
     * 提交修改密码
     *
     * */
    submitPwd() {
      if (this.oldpwd == "" || this.newpwd == "") {
        this.$toast("内容不能为空");
        return;
      }
      if (this.newpwd == this.oldpwd) {
        this.$toast("新旧密码一致");
        return;
      }

      savePersonMsg({
        oldpwd: this.oldpwd,
        newpwd: this.newpwd,
        type: 2
      }).then(res => {
        if (res.result == "success") {
          this.$store.dispatch("updateUserInfo").then(() => {
            this.$toast("修改成功", "success").then(() => {
              this.$router.push({
                name: "UserLogin"
              });
            });
          });
        } else {
          this.$toast(res.msg);
        }
      });
    },
    /**
     * 选择头像
     */
    changeAvatar() {
      this.$refs.file_avatar.click();
    },
    /**
     * 更新头像
     */
    uploadAvatar(e) {
      this.$showLoading();
      compressImg(this.$refs.file_avatar.files[0],{
        w:480,
        h:480
      }).then(file=>{
        let formData = new FormData();
        formData.append('file',file)
        changeHead(formData).then(res => {
          if (res.result === "success") {
            this.$store.dispatch("updateUserInfo").then(() => {
              this.$hideLoading();
            });
          }
        });
      });
    }
  },

  activated() {
    this.$store.ready(state => {
      this.isLogin = state.isLogin;
      if (this.isLogin != 1) {
        this.$toast("请登录");
        return;
      } else {
        this.name = state.userInfo.name;
        this.eMail = state.userInfo.email;
        this.phone = state.userInfo.mobile;
      }
    });
  }
};
</script>

<style scoped>
.el-input {
  width: 200px;
  margin-right: 10px;
}
.basicSettings {
  width: 100%;
}
.basicSettings-top {
  width: 100%;
  border-bottom: 1px solid #eee;
}
.basicSettings-top h1 {
  font-size: 20px;
  color: #2d3336;
  font-weight: 400;
  padding: 21px 24px;
}
.basicSettings-main__avatar {
  padding-top: 50px;
  width: 120px;
  margin: 0 auto 20px auto;
  text-align: center;
}
.basicSettings-main__avatar .ks-image {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  overflow: hidden;
}
.basicSettings-main__avatar .el-button{
	margin-top:15px;
}
.basicSettings-main__left {
  width: 392px;
  text-align: right;
}
.basicSettings-main__item {
  height: 50px;
  line-height: 50px;
  font-size: 15px;
}
.basicSettings-main__item .el-input {
  margin-left: 20px;
}
.basicSettings-main__item p {
  width: 392px;
  text-align: right;
  float: left;
  color: #929a9e;
}
.basicSettings-main__item span {
  margin-left: 20px;
  float: left;
  color: #585e61;
}
.basicSettings-main__btn {
  height: 50px;
  line-height: 50px;
  text-align: center;
}
.info {
  background: #2e84ee;
  border-color: #2e84ee !important;
  color: #fff !important;
}
.ks-color-info {
  color: #2e84ee !important;
  cursor: pointer;
}
</style>
