<template>
  <div>
    <ks-container v-if="loaded">
      <ks-title name="收款设置" border="none"/>
      <div class="pay__container">
        <div class="pay__container-title">
          当前收款方式：{{(usering=='school'&& '微信支付-自有账户') || (usering=='plat'&& '微信支付-平台代收')}}
          <span class="pay__container-change" @click="ChangeVisible= true" v-if="changeFlag">切换</span>
        </div>
        <div class="pay__container-content">
          <div class="pay__container-item">
            <div class="pay__container-stit">
              微信支付-平台代收
              <span class="pay__container-user" v-if="usering=='plat'">正在使用</span>
            </div>您的店铺收入可以暂存于“{{$store.state.siteName}}平台支付”微信支付对应的账户，你可随时向科汛微门户发起提现申请。
            <br>微信收取0.6%交易手续费，通过科汛微门户完成代缴
            <br>提现人工审核周期：当前18点前申请提现，3个工作日内到账，实际到账时间以微信入账时间为准
          </div>

          <div class="pay__container-item">
            <div class="pay__container-stit">
              微信支付-自有账户
              <span class="pay__container-user" v-if="usering=='school'">正在使用</span>
              <!--<span class="pay__container-limit"><i>2019-03-25</i>到期</span>-->
            </div>前提条件：你需要在微信公众平台申请开通“微信认证服务号”，且此服务号需要向微信申请开通“微信支付权限”；
            <br>你可以在此配置，使用自己的微信支付。收入直接进入你的微信支付对应的帐号。微信将收取每笔0.6%的交易手续费。
            <br>
            <a
              class="pay__container-watcher"
              href="https://www.kesion.com/store_help_jinjie/47506"
              target="_blank"
            >查看配置教程</a>
            <el-button
              type="primary"
              class="pay__container-fr"
              @click="getFlag"
            >{{(word == 0 && '查看配置') || (word == 1 && '配置中') }}</el-button>
          </div>
        </div>
      </div>
    </ks-container>

    <el-dialog title="切换收款方式" :visible.sync="ChangeVisible" width="300px" :type.sync="type" center>
      <div class="pay__container-dialog">
        <el-radio v-model="type" :disabled="radioFlag1" label="plat">微信支付-平台代收</el-radio>
      </div>
      <div class="pay__container-dialog">
        <el-radio v-model="type" :disabled="radioFlag2" label="school">微信支付-自有账户</el-radio>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="changeType">确 定</el-button>
        <el-button @click="ChangeVisible = false">取 消</el-button>
      </span>
    </el-dialog>
    <el-dialog title="提示" :visible.sync="AskVisible" center width="800px">
      <receipt-ask @sure="openFlag = true;AskVisible = false;judge(1)"/>
    </el-dialog>
    <el-dialog title="提示" :visible.sync="ProptVisible" center width="500px">
      <receipt-propt :ProptVisible.sync="ProptVisible" :opeartArr="opeartArr"/>
    </el-dialog>
  </div>
</template>
<script>
import ReceiptAsk from "./ReceiptAsk.vue";
import ReceiptPropt from "./ReceiptPropt.vue";
import { checkModuleHasOpen, setStorePayStatus } from "@/api/setting";
export default {
  name: "set",
  data() {
    return {
      loaded: true,
      ChangeVisible: false,
      AskVisible: false,
      ProptVisible: false,
      type: "plat",
      /**
       * 平台代收 plat
       * 自有账户 school
       */
      usering: "plat",
      opeartArr: [],
      /**
       *切换状态
       */
      changeFlag: false,
      /**
       *配置文字
       */
      word: 0,
      /**
       * 是否开启自有账户
       */
      openFlag: false,
      /**
       * radio 是否可以切换
       */
      radioFlag1: false,
      radioFlag2: false
    };
  },
  methods: {
    changeType() {
      // this.tusering = this.type
      let type = 0;
      if (this.type == "school") {
        type = 1;
      } else {
        type = 0;
      }
      if (type == 0) {
        this.judge(0);
      }

      if (this.type == "school") {
        this.AskVisible = true;
      }
      this.ChangeVisible = false;
    },
    checkSet() {
      this.$router.push({
        path: "/receipt/set"
      });
    },
    getsetting() {
      checkModuleHasOpen({
        appid: 19
      }).then(res => {
        if (res.result == "success") {
          this.word = 1;
        }
        if (res.setting) {
          this.word = 0;
          this.changeFlag = true;
          this.usering = res.status;
          this.type = res.status;
          if (this.type == "plat") {
            this.radioFlag1 = true;
            this.radioFlag2 = false;
          } else {
            this.radioFlag2 = true;
            this.radioFlag1 = false;
          }
        }
      });
    },

    getFlag() {
      checkModuleHasOpen({
        appid: 19
      }).then(res => {
        this.opeartArr = res;
        if (res.result == "error") {
          this.ProptVisible = true;
          this.usering = this.type;
        } else if (res.result == "success") {
          if (res.setting) {
            this.$router.push({
              path: "/receipt/set"
            });
          } else {
            this.$router.push({
              path: "/",
              query: {
                url: res.url
              }
            });
          }
        }
      });
    },
    judge(type) {
      setStorePayStatus({
        isuse: type
      }).then(res => {
        this.getsetting();
      });
    }
  },
  mounted() {
    this.getsetting();
  },
  components: {
    ReceiptAsk,
    ReceiptPropt
  }
};
</script>
<style scoped>
.pay__container {
  border: 1px solid #eee;
  margin-top: 30px;
}
.pay__container-title {
  background: #f5f5f5;
  padding: 20px;
  font-size: 16px;
  color: #333;
}
.pay__container-item {
  padding: 30px 40px;
  font-size: 14px;
  color: #666;
  border-bottom: 1px solid #eee;
  position: relative;
}
.pay__container-item:last-child {
  border-bottom: 0;
}

.pay__container-stit {
  font-size: 16px;
  color: #454545;
  margin-bottom: 10px;
}
.pay__container-user {
  width: 80px;
  height: 20px;
  line-height: 20px;
  text-align: center;
  color: #e5412c;
  border: 1px solid #e5412c;
  display: inline-block;
  font-size: 12px;
  margin: 0 5px;
}
.pay__container-limit {
  display: inline-block;
  background: #fdf6ec;
  color: #666;
  font-size: 12px;
  padding: 1px 10px;
}
.pay__container-limit i {
  color: #e5412c;
  font-style: normal;
}
.pay__container-watcher {
  color: #e5412c;
  font-size: 14px;
  margin-top: 15px;
  display: block;
}
.pay__container-fr {
  position: absolute;
  top: 50%;
  right: 40px;
  margin-top: -20px;
}
.pay__container-change {
  color: #e5412c;
  font-weight: 600;
  padding-left: 10px;
  cursor: pointer;
}
.pay__container-dialog {
  margin-bottom: 15px;
}
</style>


