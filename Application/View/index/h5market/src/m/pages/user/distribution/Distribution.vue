<template>
  <div class="distributton-card-wrap" :style="{minHeight:windowHeight+'px'}">
    <transition name="fade-up">
      <div class="share-confirm" v-show="shareFlag">
        <div class="share-confirm-img">
          <img src="@/m/assets/distribution/share-img.png">
        </div>
        <div class="share-confirm-content">
          <h5>分享赚钱</h5>
          <div class="share-confirm-del">推荐课程给好友,赚{{currentIncome}}元学费</div>
          <div class="share-confirm-share">点击右上角分享按钮即可以完成分享</div>
        </div>
      </div>
    </transition>

    <div class="distributton-card">
      <div class="distributton-card__body clearfix">
        <ul>
          <li>
            <p>累计收益（元）</p>
            <p class="price">{{allMoney}}</p>

            <p>
              <router-link
                to="/user/distribution/withdrawalsRecord"
                class="distributton-card__withdraw"
              >
                提现记录
                <i class="ks-icon ks-icon-arrow-ios-forward-outline"></i>
              </router-link>
            </p>
          </li>
          <li>
            <p>未入账</p>
            <p class="price">{{wrz}}</p>
          </li>
        </ul>
      </div>
      <div class="distributton-card__footer">
        <ks-button class="ks-fr" type="primary" size="small" @click="goWithdrawal" round>去提现</ks-button>
        可提现金额（元）：{{kjs}}
      </div>
    </div>

    <ks-page-scroll-container
      :page="tabActive == 0 ? distributeList.p : myDistributton.p"
      :page-count="tabActive == 0 ? distributeList.pageCount : myDistributton.pageCount"
      @page-change="getLst"
      class="distributton-list ks-mt15"
    >
      <ks-tabs v-model="tabActive" @tab-click="handleClick">
        <ks-tab-pane label="我要分销" :name="0">
          <kd-search bg="gray" style="margin:5px 5px 0 5px;" @enter="getLst()"/>
          <div v-if="distributeList.list.length">
            <div
              class="distributton-list__item"
              v-for="item in distributeList.list"
              :key="item.id"
              @click="open(item)"
            >
              <ks-create-bg class="distributton-list__item_img" :src="item.defaultpic"/>
              <div class="distributton-list__item_title">{{item.title}}</div>
              <div class="distributton-list__item_income">
                <ks-button class="ks-fr" size="mini" plain @click.stop.native="share(item)">推广</ks-button>
                预计收益：{{item.commission}}元
              </div>
            </div>
          </div>
          <ks-empty msg="暂时没有任何数据~" v-else-if="distributeList.loaded"/>
        </ks-tab-pane>
        <ks-tab-pane label="我的收益" :name="1">
          <div v-if="myDistributton.list.length">
            <div class="distributton-list__item" v-for="item in myDistributton.list" :key="item.id">
              <ks-create-bg class="distributton-list__item_img" :src="item.defaultpic"/>

              <div class="distributton-list__item_title">{{item.title}}</div>
              <div class="distributton-list__item_income">
                <span class="ks-fr">{{item.paydate}}</span>
                +{{item.distribute_amount}}元
              </div>
            </div>
          </div>
          <ks-empty msg="暂时没有任何数据~" v-else-if="myDistributton.loaded"/>
        </ks-tab-pane>
      </ks-tabs>
    </ks-page-scroll-container>

    <!--申请提现-->
    <ks-dialog title="微信提现" :visible.sync="withdrawalVisible">
      <div class="withdrawal-tips">
        此次您提现的金额为
        <strong class="ks-color-primary">{{kjs}}元</strong>，
        <br>微信转账需要验证您微信所绑定银行卡的真实姓名
      </div>

      <ks-form class="ks-mt10" label-width="80px">
        <ks-form-item label="真实姓名" required>
          <input class="ks-input" type="text" placeholder="请输入真实姓名" v-model="realyname">
        </ks-form-item>
      </ks-form>

      <div class="ks-mt20" align="center">
        <ks-button type="primary" size="medium" @click="withdrawalSubmit">确认提交</ks-button>
        <ks-button size="medium" class="ks-ml5" @click="withdrawalVisible = false">取消</ks-button>
      </div>
    </ks-dialog>

    <store-footer/>
  </div>
</template>
<script>
/**
 * 分销
 */
import { getTypeName, getViewRoute } from "@/utils";
import {
  myDistributeList,
  distributionList,
  applyDistributeWithdrawal,
  checkApplyBindWechat
} from "@/api/distribution";
export default {
  name: "Distribution",
  data() {
    return {
      windowHeight: window.innerHeight,
      /**
       * 分享开关
       */
      shareFlag: false,
      /**
       * 提现开关
       */
      openid: "",
      realyname: "",
      withdrawalVisible: false,
      tabActive: 0,
      currentIncome: "",
      wrz: "",
      allMoney: "",
      kjs: "",
      /**
       * 我的分销
       */
      myDistributton: {
        p: 1,
        pageCount: null,
        loaded: false,
        list: []
      },
      /**
       * 分销列表
       */
      distributeList: {
        p: 1,
        pageCount: null,
        loaded: false,
        list: []
      }
    };
  },
  methods: {
    /**
     * 处理选项卡点击
     */
    handleClick(active) {
      let dataNode = active == 0 ? "distributeList" : "myDistributton";
      if (!this[dataNode].loaded) {
        this.getLst();
      }
    },
    /**
     * 去提现
     */
    goWithdrawal() {
      if (parseFloat(this.kjs) > 0) {
        this.$store.ready(state => {
          checkApplyBindWechat().then(res => {
            if (res.result === "success") {
              this.openid = res.openid;
              this.realyname = res.name;
              this.withdrawalVisible = true;
            } else {
              this.$toast(res.msg).then(() => {
                let path = location.href.split("#")[1];
                res.authorurl += `&wxid=${state.info.wxid}&turnurl=${path}`;
                location.href = res.authorurl;
              });
            }
          });
        });
      } else {
        this.$toast("没有可结算的余额！", "tips", 2000);
      }
    },
    /**
     * 提交提现申请
     */
    withdrawalSubmit() {
      applyDistributeWithdrawal({
        realyname: this.realyname,
        openid: this.openid
      }).then(res => {
        if (res.result === "success") {
          this.$toast("提交成功", "success").then(() => {
            this.kjs = res.balance;
            this.withdrawalVisible = false;
          });
        }
      });
    },
    /**
     * 分享
     */
    share(item) {
      this.$store.ready(state => {
        if (state.isLogin == 0) {
          this.$toast("请先登录").then(() => {
            this.$router.push({
              name: "UserLogin"
            });
          });
        } else {
          let typeName = getTypeName(item.type);
          let company = typeName === "课程" ? "门" : "个";
          this.currentIncome = item.commission;

          let path = getViewRoute(item, "id");
          let _link = `${
            location.href.split("#")[0]
          }#${path}?distributeUserId=${state.userInfo.userid}`;

          this.$wxShare({
            title: item.title,
            desc: `这${company}${typeName}不错，快来跟我一起学~`,
            imgUrl: item.defaultpic,
            link: _link
          });
          this.$showMask({
            click: () => {
              this.shareFlag = false;
              this.$hideMask();
            }
          });
          this.shareFlag = true;
        }
      });
    },
    /**
     * 查看详情
     */
    open(item) {
      let _path = getViewRoute(item, "id");
      this.$router.push({
        path: _path
      });
    },
    /**
     * 获取数据列表
     */
    getLst(p = 1, loadMyDistribute) {
      this.$showLoading();
      let dataNode = this.tabActive == 0 ? "distributeList" : "myDistributton";
      this[dataNode].p = p;
      if (p == 1) {
        this[dataNode].loaded = false;
        this[dataNode].list = [];
      }
      if (this.tabActive == 0) {
        distributionList({
          p: p,
          maxperpage: 10,
          title: this.$route.query.key || ""
        }).then(res => {
          this.distributeList.pageCount = res.page.total_pages;
          this.distributeList.list = this.distributeList.list.concat(res.list);
          this.distributeList.loaded = true;
          this.$hideLoading();
        });
      }
      if (this.tabActive == 1 || loadMyDistribute) {
        myDistributeList({
          p: p,
          maxperpage: 10
        }).then(res => {
          this.wrz = res.djs || "0.00";
          this.allMoney = res.allmoney || "0.00";
          this.kjs = res.kjs || "0.00";
          this.myDistributton.pageCount = res.page.total_pages;
          this.myDistributton.list = this.myDistributton.list.concat(res.list);
          this.myDistributton.loaded = true;
          this.$hideLoading();
        });
      }
    }
  },
  mounted() {
    window.addEventListener("resize", () => {
      this.windowHeight = window.innerHeight;
    });
  },
  activated() {
    document.title = "我的分销";
    this.getLst(1, true);
  }
};
</script>
<style scoped>
.distributton-card-wrap {
  background: #fff;
  padding-top: 15px;
  box-sizing: border-box;
}
.distributton-card {
  box-shadow: 0 2px 18px rgba(0, 0, 0, 0.1);
  border-radius: 4px;
  overflow: hidden;
  margin: 0 15px;
}
.distributton-card__withdraw {
  font-weight: bold;
}
.distributton-card__withdraw .ks-icon {
  position: relative;
  top: 2px;
  font-weight: normal;
}
.distributton-card__body {
  padding: 20px;
  background: -webkit-linear-gradient(right, #fbb762, #ea624a);
}
.distributton-card__body li {
  width: 50%;
  float: left;
  color: #fff;
}
.distributton-card__body p {
  line-height: 1.7;
}

.distributton-card__body .price {
  font-size: 26px;
  font-weight: bold;
}
.distributton-card__body a {
  color: #fff;
}
.distributton-card__footer {
  height: 52px;
  line-height: 52px;
  color: #666;
  background: #fff;
  padding: 0 20px;
  font-size: 14px;
}
.distributton-card__footer .ks-button {
  position: relative;
  top: 10px;
}

.distributton-list__item {
  background: #fff;
  padding: 15px 15px 15px 170px;
  position: relative;
  min-height: 80px;
}
.distributton-list__item .distributton-list__item_img {
  width: 140px;
  height: 80px;
  position: absolute;
  left: 15px;
  top: 15px;
}
.distributton-list__item_title {
  font-size: 16px;
  line-height: 24px;
  max-height: 48px;
  font-weight: bold;
  overflow: hidden;
}
.distributton-list__item_income {
  font-size: 14px;
  color: #ea624a;
  margin-top: 5px;
  height: 28px;
  line-height: 28px;
  overflow: hidden;
}
.distributton-list__item_income span {
  color: #999;
  font-size: 12px;
}
/*分享*/
.share-confirm {
  position: fixed;
  top: 50%;
  left: 50%;
  transition: all 0.2s linear;
  width: 85%;
  border-radius: 10px;
  background: #fff;
  z-index: 150;
  padding-top: 45px;
  padding-bottom: 15px;
  max-width: 320px;
  margin-left: -160px;
  margin-top: -160px;
}
.share-confirm-img {
  position: absolute;
  width: 30%;
  left: 50%;
  margin-left: -15%;
  top: -20%;
}
.share-confirm-img img {
  max-width: 100%;
}
.share-confirm-content h5 {
  letter-spacing: 2px;
  color: #616161;
  font-weight: normal;
  font-size: 23px;
  line-height: 40px;
}
.share-confirm-content .share-confirm-del {
  color: #f88e06;
  font-size: 18px;
  margin-bottom: 5px;
}
.share-confirm-content .share-confirm-share {
  background-color: #f0f0f0;
  line-height: 32px;
  border-radius: 4px;
  margin-top: 10px;
  color: #8f8f8f;
  font-size: 14px;
}
.share-confirm-header {
  padding-top: 10px;
  text-align: center;
  font-size: 16px;
  color: #333;
  font-weight: 700;
}
.share-confirm-content {
  padding: 10px 20px 15px;

  min-height: 36px;
  position: relative;
  font-size: 16px;
  text-align: center;
  color: #666;
}

/*提现*/
.withdrawal-tips {
  font-size: 14px;
  line-height: 28px;
  color: #999;
}
</style>

