<template>
  <div>
    <div class="store-config">
      <div class="iphone">
        <div class="h5-name" id="h5Name">{{$store.state.info.sitename}}</div>

        <div class="wechat-menu">
          <div class="item" v-for="(item,index) in menu" :key="item.id">
            <div class="name" @click="setMenu(item,index)" :class="item.id == current && 'active'">
              <i class="iconfont icon-list" v-if="item.list && item.list.length"></i>
              {{item.name}}
            </div>
            <div class="drop-box" v-if="item.list && item.list.length" v-show="index === selected">
              <span
                v-for="sub in item.list"
                :key="sub.id"
                @click="setMenu(sub,index)"
                :class="sub.id == current && 'active'"
              >{{sub.name}}</span>
            </div>
          </div>

          <div class="item" v-if="loaded && menu.length < 3">
            <div class="name" @click="addFirstMenu" :class="current == 0 && 'active'">
              <i class="el-icon-plus"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- <el-alert class="ks-mt20" title="你已将自定义菜单权限授权给课堂街帮助你管理公众号菜单" type="success" v-if="authorization == 1" :closable="false" show-icon></el-alert>
      <el-alert class="ks-mt20" title="请先将自定义菜单权限授权给课堂街，以便帮助你管理公众号菜单" type="error" v-else-if="authorization == 0" :closable="false" show-icon></el-alert>-->

      <div class="edit-menu-info ks-mt20">
        <p>由于微信缓存，如同步微信菜单后无变化，请取消关注公众号后重新关注。</p>
        <div class="ks-mt15">
          <el-button type="primary" @click="sortVisible = true">菜单排序</el-button>
          <el-button type="primary" @click="syncWechatMenu">同步菜单到微信</el-button>
        </div>
      </div>
      <div class="edit-menu-form ks-mt20">
        <div class="menu-operate-tips" v-if="setMenuStep === 'none'">点击左侧菜单进行编辑操作</div>
        <div v-else>
          <div class="set-menu-title">
            <span
              class="ks-link-color"
              @click="deleteClass(selectedMenu)"
              v-if="setMenuStep === 'modifyNoChildMenu' || setMenuStep === 'modifyFirstMenu'"
            >删除菜单</span>
            <span
              class="ks-link-color"
              @click="deleteClass(selectedMenu)"
              v-else-if="setMenuStep === 'modifyChildMenu'"
            >删除子菜单</span>
            <span
              class="ks-link-color"
              @click="addChildMenu()"
              v-if="(setMenuStep === 'modifyNoChildMenu' || setMenuStep === 'modifyFirstMenu') && selectedMenu.list.length < 5"
            >创建子菜单</span>
            {{setMenuStep === 'modifyFirstMenu' ? '添加菜单' : selectedMenuName}}
          </div>
          <el-form
            label-width="110px"
            class="ks-mt30"
            :model="selectedMenu"
            :rules="(setMenuStep === 'modifyNoChildMenu' || setMenuStep === 'modifyFirstMenu' || setMenuStep === 'addFirstMenu') ? rules_name : rules_name2"
            ref="form_name"
          >
            <div
              class="ks-tips ks-fz14 ks-pd20"
              v-if="setMenuStep === 'modifyFirstMenu'"
            >已添加子菜单，仅可设置菜单名称。</div>
            <el-form-item
              label="菜单名称"
              prop="name"
              v-if="setMenuStep === 'addFirstMenu' || setMenuStep === 'addChildMenu'"
            >
              <el-input v-model="selectedMenu.name" placeholder="请输入菜单名称"/>
            </el-form-item>
            <el-form-item label="菜单名称" prop="name" v-else>
              <el-input
                v-model="selectedMenu.name"
                @blur="modifyMenu(selectedMenu)"
                placeholder="请输入菜单名称"
              />
            </el-form-item>
            <el-form-item>
              <div
                class="ks-tips"
                style="margin-top:-15px;"
                v-if="setMenuStep === 'modifyChildMenu' || setMenuStep === 'addChildMenu'"
              >子菜单名称不多于8个汉字或16个字母</div>
              <div class="ks-tips" style="margin-top:-15px;" v-else>菜单名称不多于4个汉字或8个字母</div>
            </el-form-item>
            <el-form-item v-if="setMenuStep === 'addFirstMenu' || setMenuStep === 'addChildMenu'">
              <el-button @click="confirmAddMenu(selectedMenu)">确认添加</el-button>
              <div
                class="ks-red"
                v-if="setMenuStep === 'addChildMenu'"
              >您还可以创建{{(5-selectedMenu.list.length)}}个子菜单</div>
            </el-form-item>

            <!--子菜单或无子菜单的一级菜单可绑定菜单内容-->
            <div v-if="setMenuStep === 'modifyNoChildMenu' || setMenuStep === 'modifyChildMenu'">
              <el-form-item :label="setMenuStep === 'modifyNoChildMenu' ? '菜单内容' : '子菜单内容'">
                <el-radio v-model="menuContent" label="3">发送消息</el-radio>
                <el-radio v-model="menuContent" label="2">跳转网页</el-radio>
              </el-form-item>
            </div>
          </el-form>

          <el-form
            :model="selectedMenu"
            label-width="110px"
            :rules="rules_url"
            ref="form_url"
            v-if="menuContent == 2 && (setMenuStep === 'modifyNoChildMenu' || setMenuStep === 'modifyChildMenu')"
          >
            <el-form-item>
              <div class="edit-menu-item">
                <div class="ks-tips ks-fz14 ks-pt10 ks-pd10">订阅者点击该菜单会跳到以下链接</div>
                <el-form-item prop="url">
                  <el-input
                    v-model="selectedMenu.url"
                    @blur="saveMenuUrl(selectedMenu)"
                    placeholder="请输入栏目链接"
                  />
                </el-form-item>

                <div class="ks-tips ks-fz14" v-if="selectedMenu.title">来自{{selectedMenu.title}}</div>
                <el-button
                  @click="selectUrl(selectedMenu)"
                  :class="!selectedMenu.title && 'ks-mt10'"
                >{{selectedMenu.url ? '重新选择' : '选择链接'}}</el-button>
              </div>
            </el-form-item>
          </el-form>
          <el-form
            label-width="110px"
            v-if="menuContent == 3 && (setMenuStep === 'modifyNoChildMenu' || setMenuStep === 'modifyChildMenu')"
          >
            <el-form-item>
              <wx-reply-select ref="wxReplySelect" style="background:#fff;"/>
              <el-button type="primary" class="ks-mt10" @click="setMsgMenu(selectedMenu)">保存</el-button>
            </el-form-item>
          </el-form>
        </div>
      </div>
    </div>

    <el-dialog title="菜单排序" :visible.sync="sortVisible">
      <div class="wechat-menu-sort">
        <div class="item" v-for="(item,index) in menu" :key="item.id">
          <div class="name" @click="menuUnfold = menuUnfold == index ? -1 : index">
            <div class="operate">
              <span>
                <i class="iconfont icon-top" @click.stop="menuMoveUp(item.id)" v-if="index > 0"></i>
              </span>
              <span>
                <i
                  class="iconfont icon-bottom"
                  @click.stop="menuMoveDown(item.id)"
                  v-if="index+1 < menu.length"
                ></i>
              </span>
            </div>
            <i class="iconfont icon-list" v-if="item.list && item.list.length"></i>
            {{item.name}}
          </div>
          <div class="childs" v-if="item.list" v-show="menuUnfold == index">
            <div class="childs-list">
              <div class="child-item" v-for="(child,c) in item.list" :key="child.id">
                <div class="operate">
                  <span>
                    <i class="iconfont icon-top" @click="menuMoveUp(child.id)" v-if="c > 0"></i>
                  </span>
                  <span>
                    <i
                      class="iconfont icon-bottom"
                      @click="menuMoveDown(child.id)"
                      v-if="c+1 < item.list.length"
                    ></i>
                  </span>
                </div>
                {{child.name}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </el-dialog>
  </div>
</template>
<script>
import WxReplySelect from "./compoents/WxReplySelect";
import { cloneData } from "@/utils";
import {
  getWechatMenu,
  saveWechatMenu,
  deleteWechatMenu,
  getWechatKeyWords,
  upWechatMenu,
  downWechatMenu,
  synchroWechatMenu
} from "@/api/wechat";
export default {
  name: "CustomizeMenu",
  data() {
    let verificationRule = (value, lengthLimit) => {
      if (!value) {
        return "菜单名称不能为空";
      }
      /**
       * 匹配中文字符
       */
      let zh = value.match(/[\u4e00-\u9fa5]/g) || [];
      /**
       * 匹配英文字符
       */
      let en = value.match(/[a-z0-9]/g) || [];
      if (zh.length + en.length / 2 > lengthLimit) {
        return "长度超过限制";
      }
      /**
       * 匹配特殊字符
       * 匹配输入文本前是否包含空格
       *
       */
      let spaceStart = /^\s+[\u4e00-\u9fa50-9a-z\-+&.]*$/;
      if (spaceStart.test(value)) {
        return "菜单名称前不可包含空格";
      }
      /**
       * 匹配特殊字符
       * 匹配输入文本后是否包含空格
       *
       */
      let spaceEnd = /^[\u4e00-\u9fa50-9a-z\-+&.]+\s+$/;
      if (spaceEnd.test(value)) {
        return "菜单名称后不可包含空格";
      }

      /**
       * 匹配特殊字符
       * 匹配输入文本后是否包含连续空格
       *
       */
      if (value.match(/\s{2}/g)) {
        return "菜单名称空格不可连续使用";
      }

      /**
       * 匹配特殊字符
       * 匹配输入文本后是否包含连续空格
       *
       */
      if (value.match(/\s/g) && value.match(/\s/g).length > 2) {
        return "菜单名称空格至多两个";
      }

      /**
       * 匹配特殊字符
       * 1、特殊字符可支持“-” “+” “&” “.”以及空格，特殊字符占一个字符。
       * 2、空格至多两个且不可连续使用，不可放在菜单名称前或菜单名称后。
       */
      let characterReg = /^[\u4e00-\u9fa50-9a-z\-+&.\s]+$/;
      if (!characterReg.test(value)) {
        return "名称仅包含中英文、数字、特殊符号。";
      }
    };

    let checkName = (rule, value, callback) => {
      let errorMsg = verificationRule(value, 4);
      if (errorMsg) {
        return callback(new Error(errorMsg));
      } else {
        callback();
      }
    };
    let checkName2 = (rule, value, callback) => {
      let errorMsg = verificationRule(value, 8);
      if (errorMsg) {
        return callback(new Error(errorMsg));
      } else {
        callback();
      }
    };
    return {
      authorization: -1,
      loaded: false,
      /**
       * 微信菜单
       */
      selected: 0,
      current: -1,
      menu: [],

      /**
       * 当前要设置的
       */
      menuContent: "3",
      setMenuStep: "none",
      selectedMenuName: "",
      selectedMenu: {},
      msgKeyWords: [],
      /**
       * 菜单排序
       */
      sortVisible: false,
      menuUnfold: 0,
      rules_name: {
        name: [{ required: true, validator: checkName, trigger: "blur" }]
      },
      rules_name2: {
        name: [{ required: true, validator: checkName2, trigger: "blur" }]
      },
      rules_url: {
        url: [{ required: true, message: "请输入菜单链接" }]
      }
    };
  },
  methods: {
    /**
     * 分类设置
     */
    setMenu(item, index) {
      this.selected = index;
      this.current = item.id;
      this.selectedMenuName = item.name;
      this.selectedMenu = cloneData(item);
      if (item.parentid == 0 && (!item.list || !item.list.length)) {
        this.setMenuStep = "modifyNoChildMenu";
        this.menuContent = this.selectedMenu.type || "3";
        this.$nextTick(() => {
          if (
            item.contents &&
            item.contents[0] &&
            this.selectedMenu.type == 3
          ) {
            this.$refs.wxReplySelect.setInfo(item.contents[0]);
          }
        });
      } else if (item.parentid == 0 && item.list && item.list.length) {
        this.setMenuStep = "modifyFirstMenu";
      } else if (item.parentid != 0) {
        this.setMenuStep = "modifyChildMenu";
        this.menuContent = this.selectedMenu.type || "3";
        this.$nextTick(() => {
          if (
            item.contents &&
            item.contents[0] &&
            this.selectedMenu.type == 3
          ) {
            this.$refs.wxReplySelect.setInfo(item.contents[0]);
          }
        });
      }
    },
    /**
     * 创建二级栏目
     */
    addChildMenu() {
      this.setMenuStep = "addChildMenu";
      this.selectedMenu.name = "";
    },
    /**
     * 添加一级栏目
     */
    addFirstMenu() {
      this.selected = -1;
      this.current = 0;
      this.selectedMenu = {
        name: "",
        parentid: -1
      };
      this.setMenuStep = "addFirstMenu";
    },
    /**
     * 修改分类
     */
    modifyMenu(selectedMenu) {
      this.$refs.form_name.validate(valid => {
        if (valid) {
          saveWechatMenu({
            name: selectedMenu.name,
            id: selectedMenu.id,
            type: 1
          }).then(res => {
            this.selectedMenuName = selectedMenu.name;
            this.updateWechatMenu();
          });
        }
      });
    },
    /**
     * 添加菜单（包括子菜单）
     */
    confirmAddMenu(selectedMenu) {
      this.$refs.form_name.validate(valid => {
        console.log(valid);
        if (valid) {
          let params = {
            name: selectedMenu.name,
            type: 0
          };

          if (this.setMenuStep === "addFirstMenu" && this.menu.length >= 3) {
            this.$msg("您最多可添加3个一级栏目");
            return false;
          } else if (
            this.setMenuStep === "addChildMenu" &&
            selectedMenu.list.length >= 5
          ) {
            this.$msg("您最多可添加5个二级栏目");
            return false;
          } else if (selectedMenu.id) {
            params.id = selectedMenu.id;
          }
          saveWechatMenu(params).then(res => {
            if (res.result === "success") {
              this.$msg("添加成功", "success");
              this.updateWechatMenu().then(res => {
                if (this.setMenuStep === "addFirstMenu") {
                  this.selectedMenu = cloneData(
                    this.menu[this.menu.length - 1]
                  );
                  this.selected = this.menu.length - 1;
                  this.current = this.selectedMenu.id;
                  this.setMenuStep = "modifyNoChildMenu";
                  this.selectedMenuName = this.selectedMenu.name;
                } else {
                  this.selectedMenu = cloneData(this.menu[this.selected]);

                  if (this.selectedMenu.list.length >= 5) {
                    this.setMenuStep = "modifyFirstMenu";
                  } else {
                    /**
                     * 将栏目名称清空，可继续添加
                     */
                    this.selectedMenu.name = "";
                  }
                }
              });
            } else {
              this.$msg(res.msg);
            }
          });
        }
      });
    },
    /**
     * 删除栏目
     */
    deleteClass(item) {
      deleteWechatMenu({
        id: item.id
      }).then(res => {
        if (res.result === "success") {
          this.$msg("删除成功", "success");
          this.setMenuStep = "none";
          this.updateWechatMenu();
        }
      });
    },
    /**
     * 更新微信栏目
     */
    updateWechatMenu() {
      return new Promise(resolve => {
        getWechatMenu().then(res => {
          if (res.result === "success") {
            res.menu.map(item => {
              item.visible = false;
              item.unfold = false;
            });
            this.menu = res.menu;
          }
          resolve(res);
        });
      });
    },
    /**
     * 选择跳转链接
     */
    selectUrl(selectedMenu) {
      this.$selectLink((title, url) => {
        selectedMenu.title = title;
        selectedMenu.url = url;
        this.saveMenuUrl(selectedMenu);
      });
    },
    /**
     * 修改栏目链接
     */
    saveMenuUrl(selectedMenu) {
      this.$refs.form_url.validate(valid => {
        if (valid) {
          saveWechatMenu({
            id: selectedMenu.id,
            url: selectedMenu.url,
            title: selectedMenu.title,
            type: 2
          }).then(res => {
            if (res.result === "success") {
              this.updateWechatMenu();
            } else {
              this.$msg(res.msg);
            }
          });
        }
      });
    },
    /**
     * 修改栏目发送消息设置
     */
    setMsgMenu(selectedMenu) {
      let info = this.$refs.wxReplySelect.getInfo();
      if (!info) {
        return false;
      }
      saveWechatMenu({
        id: selectedMenu.id,
        type: 3,
        contents: JSON.stringify([info])
      }).then(res => {
        if (res.result === "success") {
          this.$msg(res.msg, "success");
          this.updateWechatMenu();
        } else {
          this.$msg(res.msg);
        }
      });
    },

    /**
     * 栏目向上移动
     */
    menuMoveUp(id) {
      upWechatMenu({
        id: id
      }).then(res => {
        if (res.result === "success") {
          this.$msg(res.msg, "success");
          this.updateWechatMenu();
        } else {
          this.$msg(res.msg);
        }
      });
    },
    /**
     * 栏目向下移动
     */
    menuMoveDown(id) {
      downWechatMenu({
        id: id
      }).then(res => {
        if (res.result === "success") {
          this.$msg(res.msg, "success");
          this.updateWechatMenu();
        } else {
          this.$msg(res.msg);
        }
      });
    },
    /**
     * 同步菜单到微信
     */
    syncWechatMenu() {
      // for(var i=0;i<this.menu.length;i++){
      //     let item = this.menu[i];

      //     if(!item.list || !item.list.length){
      //         break
      //     }else{
      //         for(var a=0;a<item.list.length;a++){
      //             let child = item.list[a];
      //             if(!child.type){
      //                 this.selectedMenu = child;
      //                 this.selected = i;
      //                 this.current = child.id;
      //                 this.setMenuStep = 'editClass'
      //                 return false
      //             }
      //         }
      //     }
      // }
      synchroWechatMenu().then(res => {
        console.log(222);
        if (res.result === "success") {
          this.$msg(res.msg, "success");
        } else {
          this.$msg(res.msg);
        }
      });
    },
    open(url) {
      location.href = url;
    }
  },
  mounted() {
    this.$showLoading();
    this.updateWechatMenu().then(() => {
      this.loaded = true;
      this.$hideLoading();
    });
    getWechatKeyWords().then(res => {
      this.msgKeyWords = res.keywords;
    });
    // let isSatisfy = false;
    // domap(this.funcInfo,item=>{
    //     if(item.id == 1){
    //         isSatisfy = true
    //     }
    // })
    // this.authorization = isSatisfy ? 1 : 0;
  },
  components: {
    WxReplySelect
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
  width: 357px;
  padding: 0 16px;
  height: 742px;
  left: 30px;
  top: 0;
  padding-top: 136px;
  box-sizing: border-box;
  background: url(../../assets/store/wechat-phone.png) no-repeat;
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
  text-align: center;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}

.wechat-menu {
  width: 283px;
  height: 48px;
  position: absolute;
  bottom: 81px;
  right: 16px;
}

.wechat-menu .item .name {
  height: 48px;
  line-height: 46px;
  border: 1px solid #f7f7f7;
  border-left: 1px solid #e3e3e3;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  padding: 0 5px;
  box-sizing: border-box;
}
.wechat-menu .item .active {
  border: 1px solid #e5412c;
  background: #fff;
  color: #e5412c;
}
.wechat-menu .item .name i {
  font-size: 12px;
  margin-right: 5px;
}
.wechat-menu .item .name i.el-icon-plus {
  font-size: 18px;
  color: #999;
}
.wechat-menu .item {
  width: 33.3%;
  float: left;
  position: relative;
  cursor: pointer;
  font-size: 14px;
  text-align: center;
}

.wechat-menu .drop-box {
  position: absolute;
  bottom: 63px;
  background: #f7f7f7;
  left: 0;
  width: 100%;
  border: 1px solid #e3e3e3;
  border-radius: 5px;
  box-sizing: border-box;
}
.wechat-menu .drop-box::after {
  content: "";
  width: 8px;
  height: 8px;
  background: url(../../assets/store/drop.png) no-repeat;
  background-size: 100% 100%;
  position: absolute;
  bottom: -8px;
  left: 50%;
  margin-left: -4px;
}
.wechat-menu .drop-box span {
  display: block;
  height: 40px;
  line-height: 40px;
  border-top: 1px solid #e3e3e3;
  overflow: hidden;
}
.edit-menu-form,
.edit-menu-info {
  border: 1px solid #eee;
  border-radius: 4px;
  background: #f9f9f9;
}
.edit-menu-form {
  min-height: 350px;
}
.edit-menu-form .el-form {
  padding: 0 20px;
}
.edit-menu-info {
  color: #666;
  padding: 20px;
}
.edit-menu-form .set-menu-title {
  height: 44px;
  line-height: 44px;
  font-size: 14px;
  border-bottom: 1px solid #eee;
  padding: 0 15px;
}

.edit-menu-form .set-menu-title span {
  float: right;
  margin-left: 20px;
  cursor: pointer;
}

.edit-menu-item {
  background: #fff;
  padding: 0 15px 15px 15px;
  border-radius: 4px;
  border: 1px solid #eee;
  margin-top: -10px;
}

/*栏目设置*/
.menu-operate-tips {
  text-align: center;
  font-size: 14px;
  padding: 120px 0;
  color: #999;
}
.menu-operate .item {
  float: left;
  width: 90px;
  margin-right: 20px;
  text-align: center;
  cursor: pointer;
}
.menu-operate .item .icon {
  width: 80px;
  height: 80px;
  background: #e2a183;
  display: block;
  margin: 0 auto;
  border-radius: 50%;
  background-repeat: no-repeat;
  background-position: 50% 50%;
  background-size: 44px;
}
.menu-operate .item .new-subnav {
  background-image: url(../../assets/store/menu.png);
}
.menu-operate .item .wechat-send {
  background-image: url(../../assets/store/message.png);
}
.menu-operate .item .uptoweb {
  background-image: url(../../assets/store/web.png);
}
.menu-operate .item .delete {
  background-image: url(../../assets/store/delete.png);
}
.menu-operate .item p {
  font-size: 12px;
  color: #e5412c;
  line-height: 18px;
}

/*菜单排序*/
.wechat-menu-sort {
  max-height: 400px;
  overflow-y: auto;
}
.wechat-menu-sort .item .name {
  background: #eee;
  position: relative;
}
.wechat-menu-sort .operate {
  position: absolute;
  right: 0;
  top: 0;
}
.wechat-menu-sort .operate span {
  width: 44px;
  float: left;
  height: 44px;
  text-align: center;
}
.wechat-menu-sort .operate span i {
  display: block;
  font-size: 14px;
  color: #999;
  cursor: pointer;
}
.wechat-menu-sort .operate i:hover {
  color: #e5412c;
}
.wechat-menu-sort .item .name .icon-list {
  position: relative;
  top: 1px;
  margin-right: 10px;
}
.wechat-menu-sort .item:first-child .name {
  margin-top: 0px;
}
.wechat-menu-sort .item .name,
.wechat-menu-sort .item .child-item {
  height: 44px;
  line-height: 44px;
  overflow: hidden;
  padding: 0 15px;
  margin-top: 10px;
  position: relative;
}
.wechat-menu-sort .item .child-item {
  height: 44px;
  line-height: 44px;
  overflow: hidden;
  padding-left: 30px;
  background: #f9f9f9;
}
</style>

