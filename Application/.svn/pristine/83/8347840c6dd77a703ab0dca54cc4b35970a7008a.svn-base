<template>
  <ks-container v-if="detail">
    <ks-title name="电脑端店铺" border="none">
      <div class="ks-fr pcstore-help">
        <a target="_blank" href="/home/help#anchor32">？</a>
      </div>
    </ks-title>
    <el-alert type="warning" :closable="false" v-if="diy.isopen == 0 && menuAuth.diy">
      <span class="ks-fz14">您暂未开通电脑端编辑功能</span>
      <el-button type="primary" class="ks-ml20" @click="diyStore">立即试用</el-button>
    </el-alert>
    <el-alert type="warning" :closable="false" v-else-if="diy.isopen == 1 && menuAuth.diy">
      <span class="ks-fz14">您已开通电脑端编辑功能</span>
      <el-button type="primary" class="ks-ml20" @click="diyStore">装修店铺</el-button>
    </el-alert>
    <el-card class="ks-mt20">
      <div slot="header" class="clearfix">
        <span class="ks-fz16">电脑端店铺信息</span>
      </div>
      
      <div class="pcstore-main">
        <el-tabs v-model="activeName">
          <el-tab-pane label="基本设置" name="base">
            <div class="pcstore-main__list">
              <span class="ks-fz14 ks-mr30">网站开通状态</span>
              <!--status 0关闭 1开启电脑  2开启手机  3开启电脑&手机-->
              <el-radio v-model="detail.status" label="3">正常</el-radio>
              <el-radio v-model="detail.status" label="2">关闭</el-radio>
            </div>
            <div class="pcstore-main__list">
              <span class="ks-fz14 ks-mr30">店铺logo</span>
              <ks-image fit="contain" class="logo" :src="detail.pclogo" />
              <span class="ks-tips ks-mt15 uploadIMG">
                <el-button class="ks-mt20 ks-red-btn" @click="$uploadImages(detail,'pclogo')">上传图片</el-button>
                <br>
                限制：2MB，支持jpg|png|gif
              </span>
            </div>
            <div class="pcstore-main__list">
              <span class="ks-fz14 ks-mr30">网站二级域名：</span>
              <div class="pcstore-main__list-url ks-mr20 ks-fz16">{{detail.domain}}</div>
              <el-button
                type="primary"
                class="ks-blue-btn ks-normal-btn"
                @click="openNew(detail.domain)"
              >访问网站</el-button>
            </div>
            <!-- 独立域名权限 -->
            <div class="pcstore-main__list">
              <span class="ks-fz14 ks-mr30 ks-fl" style="line-height: 44px;">独立域名</span>
              
              <!-- 有权限显示 -->
              <div class="pcstore-main__auth ks-mt5" v-if="detail.is_vip==true">
                <div class="pcstore-main__auth-top">
                  <el-input
                    v-model="detail.predomain"
                    size="medium"
                    placeholder="请设置域名"
                    v-if="detail.check==-1"
                  ></el-input>
                  <el-input
                    v-model="detail.predomain"
                    disabled
                    size="medium"
                    placeholder="请设置域名"
                    v-else
                  ></el-input>
                  <div style="display: inline-block;" v-if="detail.check == 0">
                    <i class="ks-ml15 ks-color-red">未提交审核</i>
                  </div>
                  <div style="display: inline-block;" v-else-if="detail.check==1">
                    <i class="ks-ml15 ks-color-primary ks-mr15">审核中</i>
                  </div>
                  <div style="display: inline-block;" v-if="detail.check == 2">
                    <i class="ks-ml15 ks-color-success">审核通过</i>
                    <el-button
                      type="primary"
                      class="ks-blue-btn ks-normal-btn"
                      @click="openNew(detail.predomain)"
                    >访问网站</el-button>
                  </div>
                </div>
                <div class="pcstore-main__auth-bottom ks-mt20">
                  <p>设置说明：</p>
                  <p>1、先到您的域名控制面板，将您的域名做CNAME解释到： cname.kesion.com</p>
                  <p>2、所绑定的域名，必须先做好备案工作。具体备案流程，请联系您的业务代表；</p>
                </div>
              </div>
                <!-- 无权限显示 -->
              <div class="pcstore-main__auth ks-mt10" v-else>
                   
                  <div class="pcstore-main__auth-bottom">
                    <p>您当前版本不支持独立域名配置，建议升级至钻石版，享受更多特权 &nbsp; <router-link to="/?url=%2Fhome.html%2Fdefault%2FService%2Fupgrade" style="font-weight:bold;" class="ks-color-primary">去升级</router-link></p>
                  </div>
              </div>
            </div>
            

          </el-tab-pane>
          <el-tab-pane label="高级设置" name="advanced">
            <el-form label-width="180px">
              <el-form-item label="网站ico">
                <div style="border:1px solid #eee;padding:3px;width:32px;height:32px"><ks-image type="logo" :src="detail.favicon" /></div>
                <img src="@/assets/store/WX20191223.png" class="ico-image-demo" />
                <el-button class="ks-mt20 ks-red-btn" @click="$uploadImages(detail,'favicon','ico')">上传ico文件</el-button>
                <div class="ks-tips ks-mt15">
                  建议32*32px的.ico格式文件<br />
                  ico文件可到 <a href="https://tool.lu/favicon/" type="primary" target="_blank" class="ks-color-primary" style="font-size:14px;font-weight:bold;">在线工具</a> 生成
                </div>
              </el-form-item>
              <el-form-item label="版权信息">
                <el-input
                type="textarea"
                class="pcstore-main__textarea"
                :rows="2"
                placeholder
                v-model="detail.copyright"
              ></el-input>
              </el-form-item>
              <el-form-item label="SEO选项">
                  <div class="pcstore-main__seo">
                    <div class="pcstore-main__box">
                      <h2>站点标题</h2>
                      <el-input v-model="detail.seotitle" size="medium" placeholder="请输入标题"></el-input>
                    </div>
                    <div class="pcstore-main__box">
                      <h2>
                        网站 META 关键词（<i>针对搜索引擎设置的网页关键词，多个关键词请用,号分隔</i>）
                      </h2>
                      <el-input
                        type="textarea"
                        class="pcstore-main__textarea"
                        :rows="2"
                        placeholder
                        v-model="detail.metakeywords"
                      ></el-input>
                    </div>
                    <div class="pcstore-main__box">
                      <h2>
                        网站 META 网页描述 （
                        <i>针对搜索引擎设置的网页描述，多个描述请用,号分隔</i>）
                      </h2>
                      <el-input
                        type="textarea"
                        class="pcstore-main__textarea"
                        :rows="2"
                        placeholder
                        v-model="detail.metadescription"
                      ></el-input>
                    </div>
                  </div>
              </el-form-item>
            </el-form>
           
          </el-tab-pane>
        </el-tabs>
        
        
        <div class="pcstore-main__line" v-if="menuAuth.saveSetup"></div>
        <div class="pcstore-main__btn" v-if="menuAuth.saveSetup">
          <el-button type="primary" @click="save">保存设置</el-button>
        </div>
      </div>
    </el-card>
  </ks-container>
</template>

<script>
import { checkModuleHasOpen } from "@/api/store";
import { editWxDomain, getWxDomainInfo } from "@/api/home";
export default {
  name: "PcStore",
  data() {
    return {
      activeName:'base',
      diy: {
        isopen: -1
      },
      /**菜单权限 */
      menuAuth:{},
      /*用户数据详情*/
      detail: null,
      /*用户是否拥有权限,1无权限,2有权限*/
      auth: "1"
    };
  },
  activated() {
    this.menuAuth = {
      diy:false,
      saveSetup:false
    }
    this.getMenuAuthorityByKey('pc_store').then(authority=>{
      if(authority.childs){
        authority.childs.map(item=>{
          switch(item.action){
            case '1':
              this.menuAuth.diy = item.power
              break
            case '2':
              this.menuAuth.saveSetup = item.power
              break
          }
        })
        
      }
      
    })
    
    this.getWxDomainInfo();
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
  },
  methods: {
    /*
     * 提交保存用户设置
     */
    editWxDomain() {
      editWxDomain(this.detail).then(res => {
        if (res.result == "success") {
          this.$msg("保存成功", "success");
        } else {
          this.$msg("保存失败请重试");
        }
      });
    },
    /*
     * 获取用户设置信息
     * */
    getWxDomainInfo() {
      getWxDomainInfo({}).then(res => {
        this.detail = res.detail;
      });
    },
    /*
     * 跳转页面
     */
    open(url) {
      this.$router.push(url);
    },
    /*
     * 跳转外部链接
     */
    openNew(url) {
      window.open(url+'?f=pc');
    },
    diyStore() {
      let routeData = this.$router.resolve({
        name: "DragPC"
      });
      window.open(routeData.href);
    },
    /*
     * 保存
     */
    save() {
      this.editWxDomain();
    }
  }
};
</script>

<style scoped>
.pcstore-help {
  width: 30px;
  height: 30px;
  border: 1px solid #ddd;
  border-radius: 5px;
  text-align: center;
  line-height: 30px;
}
.pcstore-help a {
  color: #606266;
  font-size: 14px;
  font-family: MicrosoftYaHei;
}
.pcstore-help a:hover {
  color: #488bff;
}

.pcstore-main__list {
  margin-bottom: 45px;
}
.pcstore-main__list span {
  display: inline-block;
  font-family: MicrosoftYaHei;
  font-weight: 400;
  color: #666;
  width: 165px;
  text-align: right;
}
.pcstore-main__list-url {
  display: inline-block;
  color: #929292;
}

.pcstore-main__alert {
  display: inline-block;
  width: 285px;
  height: 44px;
  line-height: 44px;
  background: #fdf6ec;
  border-radius: 4px;
  padding: 0 20px 0 24px;
}
.pcstore-main__alert i {
  font-style: normal;
  color: #e6a23c;
  display: inline-block;
  margin-right: 20px;
}
.pcstore-main__auth {
  display: inline-block;
}
.pcstore-main__auth-top p {
  display: inline-block;
  color: #929292;
}
.pcstore-main__auth-top i {
  font-style: normal;
  font-size: 16px;
}
.pcstore-main__auth-top .el-input {
  display: inline-block;
  width: 300px;
}
.pcstore-main__auth-bottom {
  font-size: 14px;
  color: #e6a23c;
}
.pcstore-main__textarea {
  width: 720px !important;
}
.pcstore-main__seo {
  display: inline-block;
}
.pcstore-main__box {
  width: 500px;
  margin-bottom: 40px;
}
.pcstore-main__box h2 {
  font-weight: 400;
  color: #666;
  font-size: 14px;
  margin-bottom: 8px;
}
.pcstore-main__box h2 i {
  font-style: normal;
  color: #488bff;
}
.pcstore-main__line {
  width: 100%;
  height: 1px;
  border-bottom: 1px solid #e6e6e6;
}
.pcstore-main__btn {
  text-align: center;
  padding-top: 20px;
}
.logo {
  vertical-align: top;
  display: inline-block;
  width: 150px;
  height: 150px;
  border: 1px solid #eee;
  border-radius: 4px;
  background: #fff !important;
  margin-right: 20px;
}
.uploadIMG{
  text-align: left !important;
  color: #999 !important;
  font-size: 12px;
  line-height: 22px;
}
.ico-image-demo{
  position: absolute;
  left: 150px;
  top: 0px;
}
</style>
