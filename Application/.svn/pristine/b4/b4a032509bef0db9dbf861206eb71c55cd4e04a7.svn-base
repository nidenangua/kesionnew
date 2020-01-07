<template>
  <div>
    <ks-container>
      <ks-title name="店铺设置" border="none"/>
      <el-tabs v-model="activeName">
        <el-tab-pane label="基本信息" name="base">
          <el-form
            ref="baseInfoForm"
            :rules="rules"
            :model="form"
            label-width="140px"
            v-if="formLoaded"
          >
            <el-form-item label="店铺名称" prop="sitename" required>
              <el-input v-model="form.sitename"></el-input>
            </el-form-item>
            <el-form-item label="店铺logo" required>
              <ks-create-bg class="logo" type="logo" :src="form.logo"/>
              <el-button class="ks-mt20 ks-red-btn" @click="$uploadImages(form,'logo')">上传图片</el-button>
              <div class="ks-tips ks-mt15">限制：2MB，支持jpg|png|gif
                <br>图片建议比例 1:1
              </div>
            </el-form-item>
            <el-form-item label="联系地址">
              <el-input v-model="form.address"></el-input>
            </el-form-item>
            <el-form-item label="联系电话">
              <el-input v-model="form.tel"></el-input>
            </el-form-item>
            <el-form-item label="关注公众号">
              <el-switch
                v-model="form.isattention"
                :active-color="$store.state.switch_on"
                :inactive-color="$store.state.switch_off"
              ></el-switch>
            </el-form-item>
            <el-form-item label="公众号二维码" v-if="form.isattention">
              <ks-create-bg class="logo" type="logo" :src="form.weixinqr"/>
              <el-button class="ks-mt20 ks-red-btn" @click="$uploadImages(form,'weixinqr')">上传图片</el-button>
              <div class="ks-tips ks-mt15">限制：2MB，支持jpg|png|gif
                <br>图片建议比例 1:1
              </div>
            </el-form-item>
            <el-form-item label="班主任微信号">
              <el-input v-model="form.teacher_wechat" />
            </el-form-item>
            <el-form-item label="班主任微信二维码">
              <ks-create-bg class="logo" type="logo" :src="form.teacher_wechat_code"/>
              <el-button class="ks-mt20 ks-red-btn" @click="$uploadImages(form,'teacher_wechat_code')">上传图片</el-button>
              <div class="ks-tips ks-mt15">限制：2MB，支持jpg|png|gif
                <br>图片建议比例 1:1
              </div>
            </el-form-item>
            <el-form-item label="网站客服">
              <el-select v-model="form.service_type" placeholder="请选择">
                <el-option
                  v-for="item in serveroptions"
                  :key="item.value"
                  :label="item.label"
                  :value="item.value">
                </el-option>
              </el-select>
            </el-form-item>
            <el-form-item label="客服脚本地址" v-show="form.service_type == '53kf'">
              <el-input v-model="form.service_url" placeholder="请输入脚本地址"><template slot="prepend">https://tb.53kf.com/</template></el-input>
            </el-form-item>
            <el-form-item>
              <el-button type="primary" @click="onSubmit()">保存设置</el-button>
              <el-button>取消</el-button>
            </el-form-item>
          </el-form>
        </el-tab-pane>
        <el-tab-pane label="公众号轮播图设置" name="banner">
          <div class="ks-tips">提示：用于设置微信公众号与小程序的轮播图</div>
          <div class="ks-tips">
            <i>*</i>轮播图设置（图片建议比例 16：9）
          </div>
          <el-table :data="tableData" class="ks-mt20">
            <el-table-column label="图片" width="260">
              <ks-create-bg slot-scope="scope" class="banner" :src="scope.row.img">
                <div class="masked" @click="$uploadImages(scope.row,'img')">点击修改图片</div>
              </ks-create-bg>
            </el-table-column>
            <el-table-column label="设置连接">
              <template slot-scope="scope">
                <div class="ks-link">
                  <el-input class="ks-fl ks-link-input" :disabled="true" v-if="scope.row.title"/>
                  <el-input class="ks-fl ks-link-input" v-model="scope.row.url" v-else/>
                  <div class="ks-link-title" v-if="scope.row.title">
                    <i class="el-icon-close" @click="scope.row.title = '';scope.row.url = '';"></i>
                    {{scope.row.title}}
                  </div>
                </div>
                <el-button class="ks-ml10" @click="$selectLink(scope.row)">设置链接</el-button>
              </template>
            </el-table-column>
            <el-table-column label="操作" width="200">
              <div class="operat-icon" slot-scope="scope">
                <el-tooltip
                  class="item"
                  effect="dark"
                  content="上移"
                  placement="top"
                  v-if="scope.$index > 0"
                >
                  <i class="iconfont icon-top" @click="moveUp(scope.$index)"></i>
                </el-tooltip>
                <el-tooltip
                  class="item"
                  effect="dark"
                  content="下移"
                  placement="top"
                  v-if="tableData.length > 1"
                >
                  <i class="iconfont icon-bottom" @click="moveDown(scope.$index)"></i>
                </el-tooltip>
                <el-tooltip class="item" effect="dark" content="删除" placement="top">
                  <i class="iconfont icon-shanchu1" @click="deleteBanner(scope.$index)"></i>
                </el-tooltip>
              </div>
            </el-table-column>
          </el-table>
          <el-button class="ks-mt20 ks-red-btn" icon="el-icon-plus" @click="addBanner">添加banner</el-button>
          <el-button type="primary" class="ks-mt20" @click="saveBanner">保存设置</el-button>
        </el-tab-pane>
        <el-tab-pane label="移动端教辅周边轮播图设置" name="mrimbanner">
          <div class="ks-tips">提示：用于设置移动端教辅周边轮播图</div>
          <div class="ks-tips">
            <i>*</i>轮播图设置（图片建议尺寸比例 16:9）
          </div>
          <el-table :data="mrimTableData" class="ks-mt20">
            <el-table-column label="图片" width="260">
              <ks-create-bg slot-scope="scope" class="banner" :src="scope.row.img">
                <div class="masked" @click="$uploadImages(scope.row,'img')">点击修改图片</div>
              </ks-create-bg>
            </el-table-column>
            <el-table-column label="设置连接">
              <template slot-scope="scope">
                <div class="ks-link">
                  <el-input class="ks-fl ks-link-input" :disabled="true" v-if="scope.row.title"/>
                  <el-input class="ks-fl ks-link-input" v-model="scope.row.url" v-else/>
                  <div class="ks-link-title" v-if="scope.row.title">
                    <i class="el-icon-close" @click="scope.row.title = '';scope.row.url = '';"></i>
                    {{scope.row.title}}
                  </div>
                </div>
                <el-button class="ks-ml10" @click="$selectLink(scope.row)">设置链接</el-button>
              </template>
            </el-table-column>
            <el-table-column label="操作" width="200">
              <div class="operat-icon" slot-scope="scope">
                <el-tooltip
                  class="item"
                  effect="dark"
                  content="上移"
                  placement="top"
                  v-if="scope.$index > 0"
                >
                  <i class="iconfont icon-top" @click="moveUp(scope.$index,'mrim')"></i>
                </el-tooltip>
                <el-tooltip
                  class="item"
                  effect="dark"
                  content="下移"
                  placement="top"
                  v-if="mrimTableData.length > 1"
                >
                  <i class="iconfont icon-bottom" @click="moveDown(scope.$index,'mrim')"></i>
                </el-tooltip>
                <el-tooltip class="item" effect="dark" content="删除" placement="top">
                  <i class="iconfont icon-shanchu1" @click="deleteBanner(scope.$index,'mrim')"></i>
                </el-tooltip>
              </div>
            </el-table-column>
          </el-table>
          <el-button
            class="ks-mt20 ks-red-btn"
            icon="el-icon-plus"
            @click="addBanner('mrim')"
          >添加banner</el-button>
          <el-button type="primary" class="ks-mt20" @click="saveBanner('mrim')">保存设置</el-button>
        </el-tab-pane>
        <el-tab-pane label="PC端轮播图设置" name="pcbanner" v-if="showPC">
          <div class="ks-tips">提示：用于设置PC端轮播图</div>
          <div class="ks-tips">
            <i>*</i>轮播图设置（图片建议尺寸 1920*420）
          </div>
          <el-table :data="pcTableData" class="ks-mt20">
            <el-table-column label="图片" width="260">
              <ks-create-bg slot-scope="scope" class="banner" :src="scope.row.img">
                <div class="masked" @click="$uploadImages(scope.row,'img')">点击修改图片</div>
              </ks-create-bg>
            </el-table-column>
            <el-table-column label="设置连接">
              <template slot-scope="scope">
                <div class="ks-link">
                  <el-input class="ks-fl ks-link-input" :disabled="true" v-if="scope.row.title"/>
                  <el-input class="ks-fl ks-link-input" v-model="scope.row.url" v-else/>
                  <div class="ks-link-title" v-if="scope.row.title">
                    <i class="el-icon-close" @click="scope.row.title = '';scope.row.url = '';"></i>
                    {{scope.row.title}}
                  </div>
                </div>
                <el-button class="ks-ml10" @click="$selectLink(scope.row)">设置链接</el-button>
              </template>
            </el-table-column>
            <el-table-column label="操作" width="200">
              <div class="operat-icon" slot-scope="scope">
                <el-tooltip
                  class="item"
                  effect="dark"
                  content="上移"
                  placement="top"
                  v-if="scope.$index > 0"
                >
                  <i class="iconfont icon-top" @click="moveUp(scope.$index,'pc')"></i>
                </el-tooltip>
                <el-tooltip
                  class="item"
                  effect="dark"
                  content="下移"
                  placement="top"
                  v-if="pcTableData.length > 1"
                >
                  <i class="iconfont icon-bottom" @click="moveDown(scope.$index,'pc')"></i>
                </el-tooltip>
                <el-tooltip class="item" effect="dark" content="删除" placement="top">
                  <i class="iconfont icon-shanchu1" @click="deleteBanner(scope.$index,'pc')"></i>
                </el-tooltip>
              </div>
            </el-table-column>
          </el-table>
          <el-button
            class="ks-mt20 ks-red-btn"
            icon="el-icon-plus"
            @click="addBanner('pc')"
          >添加banner</el-button>
          <el-button type="primary" class="ks-mt20" @click="saveBanner('pc')">保存设置</el-button>
        </el-tab-pane>
        <el-tab-pane label="分享设置" name="share">
          <el-form ref="shareForm" :rules="shareRules" :model="shareForm" label-width="100px">
            <el-form-item label="分享标题" prop="sharetitle" required>
              <el-input v-model="shareForm.sharetitle"></el-input>
            </el-form-item>
            <el-form-item label="分享图片">
              <ks-create-bg class="logo" type="logo" :src="shareForm.sharepic"/>
              <el-button
                class="ks-mt20 ks-red-btn"
                @click="$uploadImages(shareForm,'sharepic')"
              >上传图片</el-button>
              <div class="ks-tips">注意：建议比例1:1, 200px * 200px</div>
            </el-form-item>
            <el-form-item label="店铺简介">
              <el-input type="textarea" v-model="shareForm.sharedesc"></el-input>
            </el-form-item>
            <el-form-item>
              <el-button type="primary" @click="saveShare()">保存设置</el-button>
            </el-form-item>
          </el-form>
        </el-tab-pane>
        <el-tab-pane label="店铺介绍" name="intro">
          <el-form label-width="80px">
            <el-form-item label="店铺介绍" prop="intro">
              <el-input type="textarea" v-model="introForm.intro"></el-input>
            </el-form-item>
            <el-form-item>
              <el-button type="primary" @click="onIntroSubmit()">保存设置</el-button>
            </el-form-item>
          </el-form>
        </el-tab-pane>
      </el-tabs>
    </ks-container>
  </div>
</template>
<script>
import { deleteArray, cloneData, domap } from "@/utils";
import {
  getStoreData,
  saveSiteConfig,
  saveSiteShare,
  saveMobileBanner,
  savePcBanner,
  saveSiteIntro,
  saveLearnBanner
} from "@/api/store";
export default {
  name: "StoreSetup",
  data() {
    return {
      activeName: "base",
      server:'',
      /**客服类型 */
      serveroptions:[{
        label:'53快服',
        value:'53kf'
      }],
      openHeadTeacher:false,
      /**
       * 基本信息
       */
      formLoaded: false,
      form: {},
      showPC:false,
      /**
       * banner列表
       */
      tableData: [],
      pcTableData: [],
      mrimTableData: [],
      /**
       * 店铺介绍
       */
      introForm: {
        intro: this.$store.state.info.intro
      },
      /**
       * 分享设置
       */
      shareForm: {},
      /**
       * 基本信息表单验证
       */
      rules: {
        sitename: [{ required: true, message: "请输入店铺名称" }]
      },
      /**
       * 分享信息表单验证
       */
      shareRules: {
        sharetitle: [{ required: true, message: "请输入分享标题" }]
      }
    };
  },
  methods: {
    /**
     * 提交基本信息表单
     */
    onSubmit() {
      this.$refs.baseInfoForm.validate(valid => {
        if (valid) {
          if (!this.form.logo) {
            this.$msg("请先选择logo");
            return false;
          }
          if (this.form.isattention&&!this.form.weixinqr){
            this.$msg("请先选择二维码");
            return false;
          }
          saveSiteConfig(this.form).then(res => {
            if (res.result === "success") {
              this.$msg("保存成功", "success");
              this.$store.dispatch("updateStoreState");
            }
          });
        }
      });
    },
    /**
     * 提交介绍表单
     */
    onIntroSubmit() {
      saveSiteIntro(this.introForm).then(res => {
        if (res.result === "success") {
          this.$msg("保存成功", "success");
        }
      });
    },
    /**
     * 保存轮播图
     */
    saveBanner(type) {
      if (type === "pc") {
        savePcBanner(this.pcTableData).then(res => {
          if (res.result === "success") {
            this.$msg("保存成功", "success");
          }
        });
      } else if (type === "mrim") {
        saveLearnBanner(this.mrimTableData).then(res => {
          if (res.result == "success") {
            this.$msg("保存成功", "success");
          }
        });
      } else {
        saveMobileBanner(this.tableData).then(res => {
          if (res.result === "success") {
            this.$msg("保存成功", "success");
          }
        });
      }
    },
    /**
     * 删除banner
     */
    deleteBanner(index, type) {
      if (type === "pc") {
        let newArr = deleteArray(this.pcTableData, index);
        this.pcTableData = newArr;
      } else if (type === "mrim") {
        let newArr = deleteArray(this.mrimTableData, index);
        this.mrimTableData = newArr;
      } else {
        let newArr = deleteArray(this.tableData, index);
        this.tableData = newArr;
      }
    },
    /**
     * 添加banner
     */
    addBanner(type) {
      if (type === "pc") {
        this.pcTableData.push({
          img: "/Public/app/images/cover_default.png",
          url: "",
          title: ""
        });
      } else if (type === "mrim") {
        this.mrimTableData.push({
          img: "/Public/app/images/cover_default.png",
          url: "",
          title: ""
        });
      } else {
        this.tableData.push({
          img: "/Public/app/images/cover_default.png",
          url: "",
          title: ""
        });
      }
    },
    /**
     * 上移
     */
    moveUp(index, type) {
      let newArr = new Array();
      if (type === "pc") {
        domap(this.pcTableData, (item, i) => {
          if (i === index - 1) {
            newArr.push(this.pcTableData[index]);
          }
          if (i !== index) {
            newArr.push(item);
          }
        });
        this.pcTableData = newArr;
      } else if (type === "mrim") {
        domap(this.mrimTableData, (item, i) => {
          if (i === index - 1) {
            newArr.push(this.mrimTableData[index]);
          }
          if (i !== index) {
            newArr.push(item);
          }
        });
        this.mrimTableData = newArr;
      } else {
        domap(this.tableData, (item, i) => {
          if (i === index - 1) {
            newArr.push(this.tableData[index]);
          }
          if (i !== index) {
            newArr.push(item);
          }
        });
        this.tableData = newArr;
      }
    },
    /**
     * 下移
     */
    moveDown(index, type) {
      let newArr = new Array();
      if (type === "pc") {
        domap(this.pcTableData, (item, i) => {
          if (i !== index) {
            newArr.push(item);
          }
          if (i === index + 1) {
            newArr.push(this.pcTableData[index]);
          }
        });
      } else if (type === "mrim") {
        domap(this.mrimTableData, (item, i) => {
          if (i !== index) {
            newArr.push(item);
          }
          if (i === index + 1) {
            newArr.push(this.mrimTableData[index]);
          }
        });
        this.mrimTableData = newArr;
      } else {
        domap(this.tableData, (item, i) => {
          if (i !== index) {
            newArr.push(item);
          }
          if (i === index + 1) {
            newArr.push(this.tableData[index]);
          }
        });
        this.tableData = newArr;
      }
    },
    /**
     * 保存分享配置
     */
    saveShare() {
      this.$refs.shareForm.validate(valid => {
        if (valid) {
          saveSiteShare(this.shareForm).then(res => {
            if (res.result === "success") {
              this.$msg("保存成功", "success");
              this.$store.dispatch("updateStoreState");
            }
          })
        }
      })
    }
  },
  mounted() {
    this.$showLoading();
    this.getMenuAuthorityByKey("pc_store").then(authority => {
      if(authority.key){
        this.showPC = true
      }
    })
    this.$store.ready(state => {
      this.form = {
        sitename: state.info.sitename,
        address: state.info.address,
        logo: state.info.logo,
        tel: state.info.tel,
        isattention:state.info.isattention == 1,
        weixinqr:state.info.weixinqr,
        service_type: state.info.json.service_type || '',
        service_url: state.info.json.service_url || '',
        teacher_wechat_code:state.info.json.teacher_wechat_code,
        teacher_wechat:state.info.json.teacher_wechat
      };
      this.shareForm = {
        sharetitle: state.info.sharetitle,
        sharepic: state.info.sharepic,
        sharedesc: state.info.sharedesc
      };
      this.formLoaded = true;
      this.$hideLoading();
    });
    getStoreData([
      {
        act: "appCarousel",
        callKeyName: "carousel"
      },
      {
        act: "appPcCarousel",
        callKeyName: "pcCarousel"
      },
      {
        act: "appTeCarousel",
        callKeyName: "mrimCarousel"
      }
    ]).then(res => {
      this.pcTableData = res.pcCarousel.list;
      this.tableData = res.carousel.list;
      this.mrimTableData = res.mrimCarousel.list;
    });
  }
};
</script>
<style scoped>
.logo {
  width: 150px;
  height: 150px;
  border: 1px solid #eee;
  border-radius: 4px;
  background: #fff !important;
  float: left;
  margin-right: 20px;
}
.banner {
  width: 200px;
  height: 112px;
}
.banner .masked {
  height: 32px;
  line-height: 32px;
  position: absolute;
  left: 0;
  color: #fff;
  text-align: center;
  bottom: 0;
  width: 100%;
  z-index: 9;
  background: rgba(0, 0, 0, 0.6);
  cursor: pointer;
}
.operat-icon i {
  width: 44px;
  height: 34px;
  display: inline-block;
  line-height: 34px;
  color: #aaa;
  cursor: pointer;
  text-align: center;
}
.operat-icon i:hover {
  color: #fc6b32;
}

.ks-link {
  position: relative;
}
.ks-link-input {
  max-width: 400px;
}
.ks-link-title {
  height: 32px;
  line-height: 32px;
  border: 1px solid #ddd;
  box-sizing: border-box;
  border-radius: 3px;
  padding: 0 30px 0 10px;
  position: absolute;
  left: 5px;
  background: #fff;
  max-width: 360px;
  top: 4px;
}
.ks-link-title .el-icon-close {
  position: absolute;
  right: 0;
  top: 0;
  width: 32px;
  height: 32px;
  text-align: center;
  line-height: 32px;
  cursor: pointer;
}
.ks-link-title .el-icon-close:hover {
  color: #fc6b32;
}
</style>


