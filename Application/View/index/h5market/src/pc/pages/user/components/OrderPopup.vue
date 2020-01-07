<template>
  <el-dialog title="订单详情" :visible.sync="visible" width="826px" :before-close="handleClose" center>
    <div :class="!loaded && 'orderPopup--noopacity'">
      
      <div class="orderPopup-box">
        <div class="orderPopup-date">
          <span>下单时间：{{info.adddate}}</span>
          <span>订单编号：{{info.ordersn}}</span>
        </div>
        <div class="orderPopup-order">
          <div class="orderPopup-subTitle">
            <div class="orderPopup-subTitle__goods">商品</div>
            <div class="orderPopup-subTitle__price">价格</div>
            <div class="orderPopup-subTitle__state">状态</div>
          </div>
          <div class="orderPopup-order__box" v-for="(item,i) in values" :key="i">
            <div class="orderPopup-order__goods">
              <ks-image :src="item.defaultpic" fit="cover" />
              <div class="orderPopup-order__right">
                <h1>{{item.title}}</h1>
                <span v-if="item.type == 0 && item.coursetype == 1">点播课程</span>
                <span v-else-if="item.type == 0 && item.coursetype == 2">直播课程</span>
                <span v-else-if="item.type == 0 && item.coursetype == 3">音频课程</span>
                <span v-else-if="item.type == 0 && item.coursetype == 4">图文课程</span>
                <span v-else-if="item.type == 7">专栏</span>
                <span v-else-if="item.type == 10">社群</span>
                <span v-else-if="item.type == 11">资料</span>
                <span v-else-if="item.type == 15 || item.type == 14">教辅周边 <span style="float: right;">X{{item.numb}}</span></span>
              </div>
            </div>
            <div class="orderPopup-order__price">￥{{item.price}}</div>
            <div class="orderPopup-order__state" v-if="(info.type !=14 && info.type !=15) || info.paystatus==0">
                {{(info.paystatus == 0 && '待付款') || (info.paystatus == 1 && '已付款') || (info.paystatus == 2 && '退款中') || (info.paystatus == 3 && '已退款')}}
            </div>
            <div class="orderPopup-order__state" v-else-if="(item.type ==14 || item.type ==15) && item.paystatus==1">
                {{(info.orderstatus == 0 && '待发货') || (info.orderstatus == 1 && '待收货') || (info.orderstatus == 2 && '已收货')}}
            </div>
          </div>
        </div>
      </div>
      <div class="orderPopup-detail">
        <div class="orderPopup-detail__item" v-if="info.type == 14 || info.type == 15">
          <span>￥{{info.json.address_info.freight}}</span>
          <p>运费：</p>
        </div>
        <div class="orderPopup-detail__item">
          <span>￥{{info.original_amount ? info.original_amount : '0.00'}}</span>
          <p>总金额：</p>
        </div>
        <div class="orderPopup-detail__item" v-if="info.discount !== null">
          <span>{{info.discount+'折'}}</span>
          <p>会员折扣：</p>
        </div>
        <div class="orderPopup-detail__item" v-else>
          <span>无折扣</span>
          <p>会员折扣：</p>
        </div>
        <div class="orderPopup-detail__item">
          <span>-￥{{info.vouchermoney || '0.00'}}</span>
          <p>优惠券：</p>
        </div>
        <div class="orderPopup-detail__item">
          <span>￥{{info.order_amount}}</span>
          <p>实际支付金额：</p>
        </div>
      </div>
      <div class="orderPopup-detail__retrun">
        <span @click="handleClose">返回</span>
      </div>
    </div>
  </el-dialog>
</template>

<script>
import { getOrderDetail } from "@/api/user";
export default {
  name: "OrderPopup",
  props: {
    /**订单编号 */
    ordersn: String,
    /**窗口开关 */
    visible: Boolean
  },
  data() {
    return {
      loaded: false,
      /**订单信息 */
      info: {},
      /**订单商品列表 */
      values: []
    };
  },
  watch: {
    ordersn() {
      this.getDetail();
    }
  },
  mounted() {
    this.getDetail();
  },
  methods: {
    handleClose() {
      this.$emit("update:visible", false);
    },
    getDetail() {
      this.loaded = false;
      getOrderDetail({
        ordersn: this.ordersn
      }).then(res => {
        this.info = res.info;
        this.values = res.values;
        this.loaded = true;
      });
    }
  }
};
</script>

<style scoped>
.orderPopup--noopacity{
	opacity: 0;
}
.orderPopup-title {
  margin: 0 20px;
  height: 55px;
  border-bottom: 1px solid #eee;
  text-align: center;
  line-height: 55px;
  font-size: 16px;
  color: #2d3336;
}
.orderPopup-title img {
  width: 14px;
  height: 14px;
  float: right;
  margin: 20px 10px;
}
.orderPopup-date {
  height: 48px;
  line-height: 48px;
  text-align: left;
}
.orderPopup-date span {
  font-size: 14px;
  color: #929a9e;
  margin: 0 20px;
}
.orderPopup-order {
  border: 1px solid #eee;
}
.orderPopup-subTitle {
  font-size: 14px;
  height: 40px;
  line-height: 40px;
  background: #f4f6fa;
  text-align: center;
}
.orderPopup-subTitle__goods {
  width: 316px;
  float: left;
  padding-left: 152px;
  text-align: left;
}
.orderPopup-subTitle__price {
  width: 139px;
  float: left;
}
.orderPopup-subTitle__state {
  width: 139px;
  float: left;
}
.orderPopup-order__box {
  width: 100%;
  height: 126px;
}
.orderPopup-order__goods {
  width: 388px;
  margin: 16px 62px 20px 19px;
  height: 90px;
  float: left;
}
.orderPopup-order__goods .ks-image {
  width: 160px;
  height: 100%;
  float: left;
}
.orderPopup-order__right {
  float: left;
  margin-left: 10px;
}
.orderPopup-order__right h1 {
  font-size: 14px;
  font-weight: 400;
  line-height: 24px;
  color: #2d3336;
  width: 217px;
  text-align: left;
}
.orderPopup-order__right span {
  display: block;
  font-size: 14px;
  color: #929a9e;
  margin-top: 10px;
  text-align: left;
  padding-left: 3px;
}
.orderPopup-order__price {
  width: 139px;
  float: left;
  font-size: 18px;
  color: #ec4a46;
  text-align: center;
  line-height: 126px;
}
.orderPopup-order__state {
  width: 139px;
  float: left;
  font-size: 14px;
  color: #2d3336;
  text-align: center;
  line-height: 126px;
}
.orderPopup-detail {
  margin: 22px 0 0 0;
  padding-right: 20px;
  border-bottom: 1px solid #eee;
}
.orderPopup-detail__item {
  width: 100%;
  font-size: 14px;
  height: 38px;
}
.orderPopup-detail__item span {
  display: inline-block;
  width: 138px;
  color: #2d3336;
  float: right;
  text-align: right;
}
.orderPopup-detail__item p {
  color: #929a9e;
  float: right;
}
.orderPopup-detail__retrun {
  text-align: center;
}
.orderPopup-detail__retrun span {
  display: inline-block;
  width: 100px;
  height: 30px;
  border: 1px solid #ccc;
  border-radius: 15px;
  line-height: 30px;
  text-align: center;
  font-size: 14px;
  color: #585e61;
  margin-top: 18px;
  cursor: pointer;
}
</style>
