<template>
  <div class="order-pay">
    <el-dialog :title="title" width="500px" :visible.sync="visible">
      <div v-if="step === 1">
        <el-form label-width="100px">
          <el-form-item label="支付金额">
            <div align="right">¥ {{payInfo.price}}</div>
          </el-form-item>
          <el-form-item label="可用优惠券" v-if="isCanUseVouceher">
            <div align="right">
              <el-select v-model="vouceher" placeholder="选择可用优惠券" v-if="vouceherList.length > 0">
                <el-option label="选择优惠券" :value="-1"></el-option>
                <el-option
                  :label="parseFloat(item.money)+'元优惠券'"
                  :value="i"
                  v-for="(item,i) in vouceherList"
                  :key="i"
                ></el-option>
              </el-select>
              <span v-else>暂无可用优惠券</span>
            </div>
          </el-form-item>
          <el-form-item label="会员卡折扣" v-if="!payInfo.giftNum && vipdiscount.discount && payInfo.type !== 'vipCard'">
            <div align="right" class="ks-color--error" v-if="parseFloat(payInfo.price) >= 0.1">{{vipdiscount.discount}}折</div>
            <div align="right" class="ks-color--error" v-else>价格不小于0.1元才可参与折扣</div>
          </el-form-item>
          <el-form-item label="实付金额">
            <div align="right" class="order-pay__price ks-color--error">¥ {{price}}</div>
          </el-form-item>
        </el-form>
        <div class="order-pay-footer" align="center">
          <el-button type="primary" @click="sure">确认购买</el-button>
          <el-button @click="visible = false">取消</el-button>
        </div>
      </div>
      <div class="order-pay-qrcode" v-else-if="step === 2">
        <div class="order-pay-qrcode__img">
          <div class="order-pay-qrcode__state--success" v-if="payState === 1">
            <i class="el-icon-check"></i>
            支付成功
          </div>
          <img :src="qrcode" v-if="qrcode" />
        </div>
        <div class="order-pay-qrcode__text">请扫描上面的二维码进行支付</div>
        <div class="order-pay-qrcode__text"  v-if="price">支付金额： <span class="ks-color--error">¥ {{price}}</span></div>
      </div>
    </el-dialog>
  </div>
</template>
<script>
import { checkOrderPay } from "@/api/microportal";
import { getOrderNow, getCollageoOderNow } from "@/api/course";
import { getUserWealth } from "@/api/user";
let TotalTime = 0;
export default {
  name: "OrderPay",
  data() {
    return {
      /**窗口开关 */
      visible: false,
      /**当前步骤 1 支付准备 2 扫码支付 */
      step: 1,
      /**二维码 */
      qrcode: "",
      /**窗口标题 */
      title: "订单支付",
      /**价格 */
      price: "",
      /**当前选择的优惠券id */
      couponid: 0,
      /**当前选中的优惠券索引值 */
      vouceher: -1,
      /**可用的优惠券列表 */
      vouceherList: [],
      /**会员折扣信息 */
      vipdiscount: {},
      /**是否可以使用优惠券 */
      isCanUseVouceher: false,
      /**支付状态 1支付成功 */
      payState: 0,
      /**支付信息 */
      payInfo:{}
    };
  },
  watch:{
    vouceher() {
      this.setPrice();
    }
  },
  methods: {
    /**
     * 设置价格
     */
    setPrice() {
      let v = this.vouceher;
      let _price = parseFloat(this.payInfo.price);
      if (this.vipdiscount.discount && !this.payInfo.giftNum && this.payInfo.type !== 'vipCard' && _price >= 0.1) {
        _price = (_price * this.vipdiscount.discount) / 10;
      }
      if (v == -1) {
        this.couponid = 0;
      } else {
        let item = this.vouceherList[v];
        let vouceherValue = parseFloat(item.money);
        _price = Math.max(_price - vouceherValue, 0);
        this.couponid = item.id;
      }
      this.price = _price.toFixed(2);
    },
    /**
     * 初始化数据
     */
    resetData(data = {}) {
      this.payInfo = data;
      this.payState = 0;
      this.step = data.step || 1;
      this.couponid = 0;
      this.vouceher = -1;
      this.vouceherList = [];
      this.vipdiscount = {};
      this.isCanUseVouceher = false;
      this.price = data.price ? Number(data.price).toFixed(2) : "0.00";
      this.title = data.title || "订单支付";
      this.visible = true;
    },
    getTypeId(enType) {
      let typeId = null;
      switch (enType) {
        case "course":
          typeId = 0;
          break;
        case "class":
          typeId = 1;
          break;
        case "recharge":
          typeId = 2;
          break;
        case "examReward":
          typeId = 3;
          break;
        case "courseReward":
          typeId = 4;
          break;
        case "exam":
          typeId = 5;
          break;
        case "classReward":
          typeId = 6;
          break;
        case "column":
          typeId = 7;
          break;
        case "columnReward":
          typeId = 8;
          break;
        case "vipCard":
          typeId = 9;
          break;
        case "group":
          typeId = 10;
          break;
        case "data":
          typeId = 11;
          break;
        case "activity":
          typeId = 12;
          break;
      }
      return typeId;
    },
    /**
     * 更新支付信息
     */
    update(payInfo) {
      TotalTime = 0;
      this.step = 1;
      this.resetData(payInfo);
      let typeId = this.getTypeId(payInfo.type);
      getUserWealth({
        id: payInfo.payid,
        type: typeId
      }).then(res => {
        if (res.result === "success") {
          this.vouceherList = res.list;
          this.vipdiscount = res.vipdiscount;
          /**
           * 优惠券是否可使用说明
           * 会员卡不可用于会员卡购买（type等于9）
           * 第一种：当前会员卡可参与其他优惠，但不可用于赠送（赠送不可使用会员卡折扣）
           * 第二种：当前没购买过会员卡
           * 第三种：赠送好友，用原价抵优惠券
           */
          if (
            this.giftNum ||
            (res.vipdiscount.other == 1 && typeId !== 9 && !this.giftNum) ||
            (typeId !== 9 && res.vipdiscount.other === undefined)
          ) {
            this.isCanUseVouceher = true;
          }
          this.setPrice();
        }
      });
    },
    /**
     * 确认购买
     */
    sure() {
      let params = {
        id: this.payInfo.payid,
        price: this.price,
        type: this.getTypeId(this.payInfo.type)
      };
      /**使用的优惠券id */
      if (this.couponid) {
        params.couponid = this.couponid;
      }
      /**赠送数量 */
      if (this.payInfo.giftNum) {
        params.giftNum = this.payInfo.giftNum;
      }
      this.pay(params);
    },
    /**
     * 支付
     * @param {Object} 下单的一些参数
     */
    pay(params) {
      params.balanceType = params.balanceType || 0; //是否使用余额支付 0 1 (固定0，后端已去除余额支付)
      getOrderNow(params).then(res => {
        this.handleOrderRes(res);
      });
    },
		/*
		* 显示支付二维码
		* @param {String} 二维码地址
		* @param {String} 订单号
		*/
	  showPayQrCode(qrcode,ordersn){
			this.visible = true;
			this.qrcode = qrcode;
			this.step = 2;
			this.getOrderPayState(ordersn);
		},
    /**
     * 处理订单结果
     * @param {Object} 下单返回结果
     */
    handleOrderRes(res) {
      let errCode = res.errCode;
      switch (errCode) {
        case 1000:
          this.$toast(res.msg);
          break;
        case 1002:
          this.$toast(res.msg);
          break;
        case 1003:
          this.showPayQrCode(res.qrcode,res.ordersn);
          break
        case 1005:
          this.showPayQrCode(res.qrcode,res.ordersn);
          break;
        case 1004:
          this.$toast(res.msg);
          break;
          break;
        case 1006:
          this.$toast("购买成功", "success").then(() => {
            this.handlerPaySuccess()
          });
          break;
        case 1007:
          this.$toast("赠送成功", "success").then(() => {
            this.handlerPaySuccess()
          });
          break;
        case 1010:
          this.$toast(res.msg);
          break;
      }
    },
    handlerPaySuccess(time = 0){
      if(typeof this.payInfo.success === 'function'){
        this.payInfo.success()
      }else{
        setTimeout(()=>{
            location.reload()
        },time)
  
      }
    },
    /**
     * 获取订单支付状态
     */
    getOrderPayState(ordersn) {
      setTimeout(() => {
        checkOrderPay({
          ordersn: ordersn
        }).then(res => {
          if (res.result === "success") {
            this.payState = 1;
            this.handlerPaySuccess(1000)
            setTimeout(() => {
            this.visible = false              
            }, 2000);
          } else {
              TotalTime += 3;
              if(TotalTime <= 120 && this.visible){
                  this.getOrderPayState(ordersn)
              }
          }
        });
      },3000);
    }
  }
};
</script>

<style scoped>
.order-pay-footer {
  border-top: 1px solid #eee;
  padding-top: 20px;
}
.order-pay__price{
  font-size: 18px;
}
.order-pay-qrcode {
  text-align: center;
}
.order-pay-qrcode img {
  height: 200px;
  display: block;
  margin: 0 auto;
}
.order-pay-qrcode__text {
  line-height: 34px;
}
.order-pay-qrcode__img {
  position: relative;
  width: 200px;
  height: 200px;
  margin: 0 auto;
}
.order-pay-qrcode__img img {
  width: 100%;
  height: 100%;
}
.order-pay-qrcode__state--success {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.9);
  z-index: 1;
  text-align: center;
  font-size: 14px;
  color: #42c642;
  line-height: 44px;
}
.order-pay-qrcode__state--success i {
  width: 44px;
  height: 44px;
  font-size: 44px;
  display: block;
  padding: 8px;
  border: 2px solid #42c642;
  border-radius: 50%;
  margin: 0 auto;
  margin-top: 55px;
}
</style>
