<template>
  <el-row class="index" :gutter="25">
    <el-col :lg="19">
      <div class="index-school-info">
        <div class="index-school-info__name">
          <el-popover placement="top-start" width="140" trigger="hover">
            <div class="index-scholl-info__code">
              
              <h4>微信扫一扫访问</h4>
              <img :src="wxinfo.QRcode" v-if="wxinfo.QRcode">
              <el-button size="small" @click="copyStoreUrl">复制页面链接</el-button>
              <input
                type="text"
                style="height:0px;border:0px;"
                ref="storeUrl"
                :value="$store.state.info.url"
              >
            </div>
            <el-button class="ks-fr" style="margin-left:20px;" size="medium" slot="reference">访问微门户</el-button>
          </el-popover>
          <el-link class="ks-fr" :underline="false" type="primary" size="medium" @click="openPC" v-if="showPC">访问PC版</el-link>
          {{$store.state.info.sitename}}
          <span class="index-school-info__version">{{wxinfo.version}}</span>
          <span class="index-school-info__version_tip" v-html="wxinfo.version_tips"></span>
        </div>
        <div class="index-school-info__data">
          <ul class="clearfix">
            <li>
              <span>{{marke.payorderuser}}</span>
              总付费学员
            </li>
            <li>
              <span>{{marke.daypayuser}}</span>
              今日付费学员
            </li>
            <li>
              <span>{{marke.dhits}}</span>
              昨日新增学员
            </li>
            <li>
              <span>{{marke.ordernum}}</span>
              今日线上销售额（元）
            </li>
            <li>
              <span>{{marke.withdrawmoney}}</span>
              可提现余额（元）
            </li>
          </ul>
        </div>
        <div class="index-school-info__title">常用功能</div>
        <div class="index-school-info__module">
          <ul class="clearfix">
            <li v-for="(item,i) in commonMenu" :key="i" v-show="item.is_open == 1">
              <div class="index-school-info__module__item" @click="$router.push(item.url)">
                <img :src="item.icon">
                {{item.title}}
              </div>
            </li>
            <li>
              <div class="index-school-info__module__add" @click="commonlyUsedVisible = true">
                <span>
                  <i class="iconfont icon-plus-outline"></i>
                  添加模块
                </span>
              </div>
            </li>
          </ul>
        </div>
        <el-dialog :visible.sync="commonlyUsedVisible" title="常用功能" width="900px">
          <el-tabs v-model="commonlyUsedActiveName">
            <el-tab-pane
              :label="item.title"
              :name="'tab'+index"
              v-for="(item,index) in commonlyUsedList"
              :key="index"
            >
              <el-form class="commonly-used-form" label-width="100px">
                <el-form-item :label="sub.title" v-for="sub in item.subtopic" :key="sub.appid">
                  <el-switch
                    v-model="sub.is_open"
                    :active-color="$store.state.switch_on"
                    :inactive-color="$store.state.switch_off"
                  ></el-switch>
                </el-form-item>
              </el-form>
            </el-tab-pane>
          </el-tabs>
          <div slot="footer">
            <el-button type="primary" @click="saveCommonlyUsed">确定</el-button>
            <el-button @click="commonlyUsedVisible = false">取消</el-button>
          </div>
        </el-dialog>

        <div class="index-school-info__title">热门功能</div>
        <div class="index-school-info__hot">
          <el-row :gutter="20">
            <el-col :span="6">
              <div
                class="index-school-info__hot__item"
                @click="$router.push('/?url=/home.html/voucher/Index?appid-31')"
              >
                <div class="index-school-info__hot__name">
                  优惠券
                  <span>COUPON</span>
                </div>
                <img src="../assets/index/bg3.png">
              </div>
            </el-col>
            <el-col :span="6">
              <div
                class="index-school-info__hot__item"
                @click="$router.push('/?url=/home.html/users/Index/showgroup?appid-3')"
              >
                <div class="index-school-info__hot__name">
                  学员分组（VIP）
                  <span>USER GROUP</span>
                </div>
                <img src="../assets/index/bg2.png">
              </div>
            </el-col>
            <el-col :span="6">
              <div
                class="index-school-info__hot__item"
                @click="$router.push('/?url=/home.html/team/Index?appid-35')"
              >
                <div class="index-school-info__hot__name">
                  社群管理
                  <span>GROUP</span>
                </div>
                <img src="../assets/index/bg1.png">
              </div>
            </el-col>
            <el-col :span="6">
              <div
                class="index-school-info__hot__item"
                @click="$router.push('/?url=/home.html/column/Index?appid-104')"
              >
                <div class="index-school-info__hot__name">
                  专栏管理
                  <span>COLUMN</span>
                </div>
                <img src="../assets/index/bg4.png">
              </div>
            </el-col>
          </el-row>
        </div>
        <div class="index-school-info__title">
          <el-radio-group v-model="dataRange" class="ks-fr" @change="getOrderStatistics">
            <el-radio-button label="1">上周</el-radio-button>
            <el-radio-button label="2">本周</el-radio-button>
            <el-radio-button label="3">本月</el-radio-button>
            <el-radio-button label="4">本季度</el-radio-button>
            <el-radio-button label="5">本年</el-radio-button>
          </el-radio-group>数据统计
        </div>
        <div class="ks-mt30">
          <canvas ref="dataChart"></canvas>
        </div>
        <!--  <div class="index-school-info__title">
                  他们做的不错
              </div>
              <div class="index-school-info__case">
                  <el-row :gutter="20">
                      <el-col :lg="4" :md="6" v-for="item in caseList" :key="item.id">
                          <div class="index-school-info__case__item">
                              <img class="index-school-info__case__logo" :src="item.logo" />
                              <div class="index-school-info__case__name">
                                  {{item.name}}
                              </div>
                          </div>
                      </el-col>
                  </el-row>
              </div>
         -->
      </div>
    </el-col>
    <el-col :md="5">
      <ks-box title="行业资讯" :more="{url:'//www.kesion.com/industry_news/',target:'_blank'}">
        <el-carousel indicator-position="outside" height="160px">
          <el-carousel-item
            class="index-carousel__item"
            v-for="item in newsList"
            :key="item.id"
            :style="{backgroundImage:'url('+item.defaultpic+')'}"
            @click.native="openWindowUrl(item.url)"
          >
            <div class="index-carousel__title">
              <span>{{item.title}}</span>
            </div>
          </el-carousel-item>
        </el-carousel>
      </ks-box>
      <ks-box class="index-dev-news ks-mt15" title="开发动态" :more="{url:'//edu.kesion.com/store_news/',target:'_blank'}">
        <ul>
          <li v-for="item in dlopval" :key="item.id">
            <a :href="item.url" :title="item.title" target="_blank">{{item.title}}</a>
          </li>
        </ul>
      </ks-box>
      <ks-box class="index-ks-wechat ks-mt15">
        <img :src="$store.state.info.wechat_qrcode" />
        <h4>{{$store.state.info.wechat_name}}微信公众号</h4>
        <p>扫码关注及时了解产品动态，优惠活动，获取门户大咖的在线教育运营经验</p>
      </ks-box>
      <ks-box class="index-dev-news ks-mt15" title="常见问题" :more="{url:'//www.kesion.com/store_question/',target:'_blank'}">
        <ul>
          <li v-for="item in help" :key="item.id">
            <a :href="item.url" :title="item.title" target="_blank">{{item.title}}</a>
          </li>
        </ul>
      </ks-box>
      <ks-box title="有问题找我们" class="index-contact-us ks-mt15">
        <p>
          电话客服：400-101-1760
          <br>
          客服邮箱：kesioncms@hotmail.com
        </p>
        <el-button class="ks-red-btn ks-mt10" size="medium" @click="contactQQ">
          <i class="iconfont icon-qq ks-mr5 ks-fl"></i>QQ咨询
        </el-button>
      </ks-box>
    </el-col>
  </el-row>
</template>
<script>
import { cloneData } from "@/utils";
import { getHomeData, saveNav, orderStatistics } from "@/api/home";
import Chart from "Chart";
let myChart;
export default {
  name: "Index",
  data() {
    return {
      windowWidth: window.innerWidth,
      dataRange: "1",
      showPC:false,
      /**
       * 网校信息
       */
      wxinfo: {},
      marke: {},
      dlopval: [],
      help: [],
      /**
       * 常用功能设置窗口
       */
      commonlyUsedVisible: false,
      commonlyUsedActiveName: "tab0",
      /**
       * 常用功能列表
       */
      commonlyUsedList: [],
      /**
       * 常用功能列表（已开启的）
       */
      commonMenu: [],
      caseList: [],
      newsList: []
    };
  },
  methods: {
    /**
     * 保存常用功能
     */
    saveCommonlyUsed() {
      let _appids = [];
      this.commonlyUsedList.map(item => {
        if (item.subtopic) {
          item.subtopic.map(sub => {
            if (sub.is_open) {
              _appids.push(sub.appid);
            }
          });
        }
      });
      saveNav({
        appids: _appids
      }).then(res => {
        if (res.result === "success") {
          this.$msg("保存成功", "success");
          this.commonMenu.map(item => {
            let has = false;
            _appids.map(appid => {
              if (appid == item.appid) {
                has = true;
              }
            });
            item.is_open = has ? true : false;
          });
          this.commonlyUsedVisible = false;
        }
      });
    },
    openWindowUrl(url) {
      window.open(url);
    },
    /**
     * 复制链接
     */
    copyStoreUrl() {
      var Url = this.$refs.storeUrl;
      Url.select(); // 选择对象
      document.execCommand("Copy"); // 执行浏览器复制命令
      this.$msg("复制成功！您可在微信或浏览器打开", "success");
    },
    /**
     * 联系qq
     */
    contactQQ() {
      let qdframe_id = "qidian_wpa_2852156247_26";
      if (document.getElementById(qdframe_id)) {
        frames[qdframe_id].contentDocument.querySelector(".btn-area").click();
      } else {
        let qd = document.createElement("script");
        qd.src =
          "https://wp.qiye.qq.com/qidian/2852156247/870ef0e1cfd76ace1039a88b9b19b74e";
        qd.id = "qd2852156247870ef0e1cfd76ace1039a88b9b19b74e";
        document.getElementsByTagName("body")[0].appendChild(qd);
        qd.onload = function() {
          monitor();
          //监听客服加载情况
          function monitor() {
            var iframe = document.getElementsByTagName("iframe");
            var qdframe;

            for (var i = 0; i < iframe.length; i++) {
              iframe[i].id === qdframe_id && (qdframe = iframe[i]);
            }
            if (qdframe) {
              frames[qdframe_id].contentDocument
                .querySelector(".btn-area")
                .click();
            } else {
              setTimeout(function() {
                monitor();
              }, 100);
            }
          }
        };
      }
    },
    openPC(){
      window.open(this.$store.state.info.pc_url)
    },
    /**
     * 数据统计
     * type  //1 上周 2 本周 3 本月 4 本季度5本年
     */
    getOrderStatistics() {
      orderStatistics({
        type: this.dataRange
      }).then(res => {
        let _data = {
          labels: res.list.date,
          datasets: [
            {
              label: "订单金额（元）",
              data: res.list.money,
              backgroundColor: ["rgba(255, 99, 132, 0.2)"],
              borderColor: ["rgba(255, 99, 132, 1)"],
              borderWidth: 4
            }
          ]
        };
        if (myChart) {
          myChart.data = _data;
          myChart.update();
        } else {
          myChart = new Chart(this.$refs.dataChart, {
            type: "line",
            data: _data,
            options: {
              scales: {
                yAxes: [
                  {
                    ticks: {
                      beginAtZero: true
                    }
                  }
                ]
              }
            }
          });
        }
      });
    }
  },
  mounted() {
    /**
     * 加载首页数据
     */
    this.$showLoading();

    window.addEventListener("resize", () => {
      this.windowWidth = window.innerWidth;
    });
    this.getMenuAuthorityByKey("pc_store").then(authority => {
      if(authority.key){
        this.showPC = true
      }
    })
    getHomeData().then(res => {
      let navList = cloneData(res.navList);
      let list = [];
      navList.map(item => {
        if (item.subtopic) {
          item.subtopic.map(sub => {
            list.push(sub);
          });
        }
      });
      this.commonMenu = list;
      this.commonlyUsedList = res.navList;
      this.wxinfo = res.wxinfo;
      this.marke = res.marke;
      this.newsList = res.news;
      this.dlopval = res.dlopval;
      this.help = res.help;
      this.$hideLoading();
    });

    this.getOrderStatistics();
  }
};
</script>
<style scoped>
.index {
  padding: 25px;
}
.index-school-info {
  background: #fff;
  padding: 25px;
  border-radius: 4px;
}
.index-school-info__name {
  height: 36px;
  line-height: 36px;
  font-size: 16px;
}
.index-school-info__version {
  height: 20px;
  line-height: 20px;
  background: #84c2f1;
  border-radius: 3px;
  font-size: 12px;
  display: inline-block;
  padding: 0 6px;
  color: #fff;
  margin-left: 10px;
  position: relative;
  top: -2px;
}
.index-school-info__version_tip {
  margin-left: 15px;
  background-color: #fdf6ec;
  color: #e6a23c;
  height: 32px;
  line-height: 32px;
  padding: 0 15px;
  border-radius: 3px;
  font-size: 12px;
  position: relative;
  display: inline-block;
  top: -2px;
}
.index-school-info__version_tip a {
  color: #e5412c;
  margin-left: 10px;
}

.index-scholl-info__code {
  text-align: center;
}
.index-scholl-info__code h4 {
  color: #e5412c;
  font-weight: normal;
}
.index-scholl-info__code img {
  width: 100%;
  display: block;
}

.index-school-info__title {
  height: 40px;
  line-height: 40px;
  overflow: hidden;
  color: #999;
  font-size: 14px;
  margin-top: 40px;
}

.index-school-info__data {
  background: #f6f6f6;
  padding: 15px 10px 20px 10px;
  margin-top: 30px;
  border-radius: 4px;
}
.index-school-info__data li {
  width: 20%;
  float: left;
  text-align: center;
  color: #999;
}
.index-school-info__data li span {
  display: block;
  font-size: 24px;
  color: #333;
}

.index-school-info__module ul {
  margin-left: -20px;
}
.index-school-info__module li {
  width: 20%;
  float: left;
}

.commonly-used-form .el-form-item {
  margin-bottom: 0;
}

.index-school-info__module__item {
  background: #f6f6f6;
  padding: 15px 20px;
  margin: 10px 0 0 20px;
  font-size: 14px;
  line-height: 32px;
  color: #555;
  border-radius: 4px;
  cursor: pointer;
  position: relative;
  top: 0;
  transition: 0.3s;
}
.index-school-info__module__item:hover {
  background: #fff;
  box-shadow: 0 2px 24px rgba(0, 0, 0, 0.1);
  top: -5px;
}
.index-school-info__module__item img {
  height: 32px;
  float: left;
  margin-right: 5px;
}
.index-school-info__module__add {
  background: #f6f6f6;
  padding: 5px;
  margin: 10px 0 0 20px;
  font-size: 14px;
  height: 52px;
  color: #555;
  border-radius: 4px;
  text-align: center;
  font-size: 12px;
  color: #aaa;
  overflow: hidden;
}
.index-school-info__module__add span {
  display: block;
  border: 1px dashed #ddd;
  padding: 5px;
  height: 52px;
  line-height: 20px;
  box-sizing: border-box;
  cursor: pointer;
}
.index-school-info__module__add .icon-plus-outline {
  display: block;
  font-size: 24px;
}
.index-school-info__module__add span:hover {
  background: #fff;
}

.index-school-info__hot img {
  width: 100%;
  display: block;
}
.index-school-info__hot__item {
  position: relative;
  cursor: pointer;
}
.index-school-info__hot__name {
  position: absolute;
  left: 30px;
  top: 50%;
  margin-top: -20px;
  color: #fff;
  font-size: 18px;
  font-weight: bold;
}
.index-school-info__hot__name span {
  display: block;
  font-size: 12px;
  color: rgba(255, 255, 255, 0.5);
}
.index-school-info__case {
  padding-bottom: 20px;
}
.index-school-info__case__item {
  text-align: center;
  border: 1px solid #f3f3f3;
  padding: 15px;
  margin-top: 20px;
  transition: 0.3s;
  position: relative;
  top: 0px;
  cursor: pointer;
}
.index-school-info__case__item:hover {
  box-shadow: 0 2px 24px rgba(0, 0, 0, 0.15);
  border: 1px solid #fff;
  top: -10px;
}
.index-school-info__case__logo {
  height: 80px;
  display: block;
  margin: 0 auto;
}
.index-school-info__case__name {
  font-size: 14px;
  height: 34px;
  line-height: 34px;
  margin-top: 10px;
  color: #666;
  overflow: hidden;
}

/*右侧*/
.index-carousel__item {
  background-size: cover;
  background-position: 50% 50%;
  background-repeat: no-repeat;
}

.index-carousel__title {
  background: url(../assets/index/linear-gray.png);
  background-size: 100% 100%;
  position: absolute;
  width: 100%;
  left: 0;
  bottom: 0;
  box-sizing: border-box;
  padding: 30px 15px 15px 15px;
}
.index-carousel__title span {
  display: block;
  font-size: 14px;
  color: #fff;
  line-height: 22px;
  max-height: 44px;
  overflow: hidden;
}

.index-dev-news li {
  height: 32px;
  line-height: 32px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  font-size: 13px;
}
.index-ks-wechat {
  text-align: center;
  color: #85898d;
}
.index-ks-wechat img {
  display: block;
  width: 80%;
  margin: 0 auto;
  max-width: 150px;
  border: 5px solid #fff;
}
.index-ks-wechat h4 {
  font-size: 14px;
  color: #333;
}
.index-ks-wechat p,
h4 {
  padding: 0 20px;
}

.index-contact-us p {
  line-height: 24px;
  font-size: 13px;
  color: #666;
}

@media screen and (max-width: 1440px) {
  .index-school-info__module li {
    width: 25%;
  }
}
@media screen and (max-width: 1280px) {
  .index-school-info__module li {
    width: 33.3%;
  }
}
</style>
