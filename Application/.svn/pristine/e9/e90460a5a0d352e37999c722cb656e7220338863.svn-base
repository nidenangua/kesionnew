<template>
  <div class="user-setting">
    <ks-list item-height="49px">
      <ks-list-item title="头像" @click="changeAvatar" show-arrow>
        <input type="file" ref="file_avatar" class="ks-none" @change="uploadAvatar">
        <ks-create-bg
          type="user"
          class="user-image"
          :src="$store.state.userInfo.headimg"
          tpye="user"
        />
      </ks-list-item>
    </ks-list>
    <ks-list class="ks-pt10" item-height="49px">
      <ks-list-item title="昵称">{{$store.state.userInfo.name || '暂无'}}</ks-list-item>
      <ks-list-item title="手机号">{{$store.state.userInfo.mobile || '未填写'}}</ks-list-item>
      <ks-list-item title="账号">{{$store.state.userInfo.username || '暂无'}}</ks-list-item>
      <ks-list-item title="密码">
        ******
        <span class="user-updata" @click="showbox(2)">点击修改</span>
      </ks-list-item>
      <ks-list-item title="邮箱">{{$store.state.userInfo.email || '未填写'}}</ks-list-item>
    </ks-list>

    <div class="user-btn-box">
      <div class="btn" @click="showbox(1)">修改资料</div>
      <div class="btn btn-lgout" @click="loginout">退出登录</div>
    </div>

    <ks-dialog :title="(action==1 && '修改资料') || (action==2 && '修改密码')" :visible.sync="showFlag">
      <ks-form label-width="80px" v-if="action==1">
        <ks-form-item label="昵称">
          <input class="ks-input" type="text" v-model="name" placeholder="请输入昵称">
        </ks-form-item>
        <ks-form-item label="手机号">
          <input class="ks-input" type="number" v-model="phone" placeholder="请输入手机号码">
        </ks-form-item>
        <ks-form-item label="邮箱">
          <input class="ks-input" type="text" v-model="email" placeholder="请输入邮箱">
        </ks-form-item>
      </ks-form>

      <ks-form label-width="80px" v-if="action==2">
        <ks-form-item label="旧密码">
          <input
            class="ks-input"
            type="password"
            autocomplete="off"
            v-model="oldpwd"
            placeholder="请输入旧密码"
          >
        </ks-form-item>
        <ks-form-item label="新密码">
          <input
            class="ks-input"
            type="password"
            autocomplete="off"
            v-model="newpwd"
            placeholder="请输入新密码"
          >
        </ks-form-item>
        <ks-form-item label="确认新密码">
          <input
            class="ks-input"
            type="password"
            autocomplete="off"
            v-model="surepwd"
            placeholder="重复输入新密码"
          >
        </ks-form-item>
      </ks-form>

      <div class="confirm-btn-wrap">
        <ks-button @click="showFlag = false" size="medium">取消</ks-button>
        <ks-button class="ks-ml10" @click="sure" size="medium" type="primary">确定</ks-button>
      </div>
    </ks-dialog>
    <store-footer/>
  </div>
</template>

<script>
import {compressImg} from '@/utils';
import { savePersonMsg, changeHead, loginOut } from "@/api/user";
export default {
  name: "UserSetting",
  data() {
    return {
      /**用户手机号 */
      phone: "",
      /**用户名 */
      name: "",
      /**修改窗口显示开关 */
      showFlag: false,
      email: "",
      /**当前行为 1修改资料 2修改密码 */
      action: 1,
      /**旧密码 */
      oldpwd: "",
      /**新密码 */
      newpwd: "",
      /**重复密码 */
      surepwd: ""
    };
  },
  activated() {
    this.$showLoading();
    document.title = "设置";
    this.$store.ready(state => {
      if (state.isLogin == 1) {
        this.phone = state.userInfo.mobile;
        this.email = state.userInfo.email;
        this.name = state.userInfo.name;
      }

      this.$hideLoading();
    });
  },
  deactivated() {
    this.showFlag = false;
  },
  methods: {
    /**
     * 确认修改
     */
    sure() {
      if (this.action == 1) {
        this.confirm();
      } else {
        this.cp();
      }
    },
    /**
     * 保存用户基本资料
     */
    confirm() {
      if (this.name == "") {
        this.$toast("请输入昵称");
        return false;
      } else if (this.phone == "") {
        this.$toast("请输入手机号");
        return false;
      }
      this.$showLoading();
      savePersonMsg({
        email: this.email,
        mobile: this.phone,
        name: this.name,
        type: 1
      }).then(res => {
        if (res.result === "success") {
          this.$store.dispatch("updateUserInfo").then(() => {
            this.$hideLoading();
            this.$toast("修改成功", "success");
            this.showFlag = false;
          });
        }
      });
    },

    /**
     * 退出登录
     */
    loginout() {
      this.$confirm("确认退出吗？").then(() => {
        this.$showLoading("正在退出");
        loginOut().then(res => {
          this.$toast("退出成功", "success");
          this.$store.dispatch("updateUserInfo").then(() => {
            this.$hideLoading();
            this.$navigateBack();
          });
        });
      });
    },
    /**
     * 显示修改窗口
     * @param {Number} 1修改资料 2修改密码
     */
    showbox(action) {
      this.action = action;
      this.showFlag = true;
    },
    cp() {
      if (this.oldpwd == "" || this.newpwd == "" || this.surepwd == "") {
        this.$toast("内容不能为空");
        return;
      }
      if (this.newpwd != this.surepwd) {
        this.$toast("修改密码不一致");
        return;
      }

      savePersonMsg({
        oldpwd: this.oldpwd,
        newpwd: this.newpwd,
        type: 2
      }).then(res => {
        if (res.result == "success") {
          this.showFlag = false;
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
  }
};
</script>
<style scoped>
.user-setting .user-image {
  width: 36px;
  height: 36px;
  border-radius: 50%;
}

.user-btn-box .btn {
  line-height: 49px;
  height: 49px;
  text-align: center;
  background: #fff;
  margin-top: 10px;
  font-size: 16px;
}
.user-btn-box .btn-lgout {
  color: var(--ornament-color);
}

.user-updata {
  color: var(--ornament-color);
  font-size: 14px;
  margin-left: 15px;
}

.confirm-btn-wrap {
  text-align: center;
  padding: 15px 0 5px 0;
}
</style>
