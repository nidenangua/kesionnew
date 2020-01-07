<template>
  <div v-if="loaded">
    <div class="order-pay-status">
      <div class="order-pay-status__text" v-if="info.type != 14 && info.type != 15">
        <span v-if="info.paystatus==0">待付款</span>
        <span v-else-if="info.paystatus==1">已付款</span>
        <span v-else-if="info.paystatus==3">退款中</span>
        <span v-else-if="info.paystatus==4">已退款</span>
      </div>
      <div class="order-pay-status__text" v-else-if="info.type == 14 || info.type == 15">
        <span v-if="info.orderstatus==0 && info.paystatus==1">已付款</span>
        <span v-else-if="info.paystatus==0">待付款</span>
        <span v-else-if="info.orderstatus==1">待收货</span>
        <span v-else-if="info.orderstatus==2">已收货</span>
      </div>
      <div v-if="info.type != 14 && info.type != 15">
        <div class="order-pay-status__tip" v-if="info.paystatus == 0">赶快去付款吧~</div>
        <div class="order-pay-status__tip" v-else-if="info.paystatus == 1">赶快去吸取知识养分吧~</div>
      </div>
      <div v-else-if="info.type == 14 || info.type == 15">
        <div class="order-pay-status__tip" v-if="info.paystatus == 0">小主，您订购的商品还未付款~</div>
        <div
          class="order-pay-status__tip"
          v-else-if="info.orderstatus==0 && info.paystatus==1"
        >等待卖家发货啦~</div>
        <div class="order-pay-status__tip" v-else-if="info.orderstatus==1">小主，您订购的商品正在快马加鞭的路上~</div>
        <div class="order-pay-status__tip" v-else-if="info.orderstatus==2">恭喜你收到欢喜之物啦~</div>
      </div>
    </div>
    <div class="order-express" v-if="info.type == 14 || info.type == 15">
      <div class="order-express__left">
        <img src="@/m/assets/user/shop_icon_addresss.png" />
      </div>
      <div class="order-express__right">
        {{info.json.address_info.realname}} {{info.json.address_info.telphone}}
        <br />
        {{info.json.address_info.street}}
      </div>
    </div>

    <div class="order-info ks-mt10">
      <div
        class="order-info__store ks-line"
        @click="open(storeInfo.storeurl)"
        v-if="hasToken == 1"
      >
        <i class="ks-icon ks-icon-arrow-ios-forward-outline"></i>
        <ks-create-bg class="order-info__store_logo" :src="storeInfo.storelogo" type="logo" />
        {{storeInfo.storename}}
      </div>
      <div class="order-info__cont" v-for="item in values" :key="item.id" @click="openView(item)">
        <ks-create-bg :src="item.defaultpic" class="order-info__image" />
        <div class="order-info__title">
          {{item.title}}
          <span
            v-if="item.coursetype==5 && JSON.parse(item.json).paymodel==0"
            class="order-info__paymodel"
          >订金</span>
        </div>
        <a v-if="(item.type == 14 || item.type == 15)&& item.json.attr" class="versions"><a v-for="(attr,index) in item.json.attr" :key="index">{{attr}};</a></a>
        <div class="order-info__type" v-if="item.type == 0 && item.coursetype == 1">点播课程</div>
        <div class="order-info__type" v-else-if="item.type == 0 && item.coursetype == 2">直播课程</div>
        <div class="order-info__type" v-else-if="item.type == 0 && item.coursetype == 3">音频课程</div>
        <div class="order-info__type" v-else-if="item.type == 0 && item.coursetype == 4">图文课程</div>
        <div class="order-info__type" v-else-if="item.type == 1">直播课程</div>
        <div class="order-info__type" v-else-if="item.type == 7">专栏</div>
        <div class="order-info__type" v-else-if="item.type == 10">社群</div>
        <div class="order-info__type" v-else-if="item.type == 11">资料</div>
        <div class="order-info__price">
          ¥{{item.price}}
          <a v-if="item.type == 14 || item.type == 15">X{{item.numb}}</a>
        </div>
      </div>

      <div v-if="info.type == 14 || info.type == 15" class="order-fast">
        <span style="margin-left:70%">快递费：¥{{info.json.address_info.freight}}</span>
      </div>

      <ks-list class="order-info__list ks-mt10">
        <ks-list-item title="总价">¥{{info.original_amount}}</ks-list-item>
        <ks-list-item title="优惠券">-¥{{info.vouchermoney || '0.00'}}</ks-list-item>
        <ks-list-item title="会员折扣" v-if="info.discount !== null">{{info.discount+'折'}}</ks-list-item>
        <ks-list-item title="会员折扣" v-else>无折扣</ks-list-item>
        <ks-list-item title="实付款">
          <span class="ks-color-primary ks-fz18">¥{{info.order_amount}}</span>
        </ks-list-item>
      </ks-list>
      <div class="order-info__other ks-mt10">
        <div>
          下单时间：{{info.adddate}}
        <br />
        订单编号：{{info.ordersn}}
        <div v-if="info.type === '14' || info.type === '15'">
          买家留言：{{info.mark}}
          <br />
          物流快递：{{info.json.logistics}}
          <br />
          快递单号：{{info.json.expressNumber}}
          <br />|
        </div>
        <div>订单来源：{{info.order_source}}</div>
        <div>购买账号：{{info.username}}</div>
        <div>购买姓名：{{info.name}}</div>
        <div class="goback">
          <div v-if="usertype != 0" class="kt_list">
            <ks-button class="ks-ml5" size="small" @click="list">返回列表</ks-button>
            <ks-button class="ks-ml5" size="small" @click="logistics(info.ordersn)" v-if="(info.type == 14 || info.type == 15) && (info.orderstatus==1 || info.orderstatus==2)">查看物流</ks-button>
            <ks-button class="ks-ml5" size="small" v-if="info.paystatus==0" @click="showbox(2,info.orderid)">确认支付</ks-button>
            <ks-button class="ks-ml5" size="small" @click="showbox(1,info.orderid,info.order_amount)" v-if="info.paystatus==0">修改价格</ks-button>
            <ks-button class="ks-ml5" size="small" @click="showbox(3,info.orderid)" v-if="(info.type == 14 || info.type == 15) && info.orderstatus==0 && info.paystatus==1">发&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;货</ks-button>
          </div>
        </div>
        </div>
        
      </div>
    </div>
    <store-footer v-if="hasToken === 0" />
 <ks-dialog
      :title="(action==1 && '修改价格') || (action==2 && '确认支付') || (action==3 && '发货')"
      :visible.sync="showFlag"
    >
      <ks-form label-width="80px" v-if="action==1">
        <ks-form-item label="原待支付价格">
          <a class="zf_left">￥{{yorder_amount}}</a>
        </ks-form-item>
        <ks-form-item label="修改价格">
          <input class="ks-input" type="number" v-model="order_amount" placeholder="请输入修改后价格" />
        </ks-form-item>
      </ks-form>

      <ks-form label-width="80px" v-if="action==2">
        <ks-radio v-model="isprice" :label="0">银行转账</ks-radio>
        <ks-radio v-model="isprice" :label="1">现金支付</ks-radio>
        <ks-form-item label="备注：">
          <textarea v-model="mark" class="ks-textarea" />
        </ks-form-item>
      </ks-form>

      <ks-form label-width="80px" v-if="action==3">
        <ks-form-item label="物流名称：">
          <select class="select" v-model="one">
            <option v-for="(item,i) in express" :key="i" :value="item">{{item.logistics}}</option>
          </select>
        </ks-form-item>
        <ks-form-item label="快递单号：">
          <input class="ks-input" type="number" v-model="expressNumber" placeholder="请输快递单号" />
        </ks-form-item>
      </ks-form>

      <div class="confirm-btn-wrap">
        <ks-button @click="showFlag = false" size="medium">取消</ks-button>
        <ks-button class="ks-ml10" @click="sure" size="medium" type="primary">确定</ks-button>
      </div>
    </ks-dialog>

  </div>
</template>
<script>
import { getParams, getViewRoute } from "@/utils";
import { getOrderDetail,editPrice,orderPayment,mallSend } from "@/api/user";
export default {
  name: "UserOrderInfo",
  data() {
    return {
      loaded: false,
      hasToken: -1,
      info: {},
      storeInfo: {},
      values: [],
      usertype:'0',
      /**修改窗口显示开关 */
      showFlag: false,
      /**当前行为 1 2 3 */
      action: 1,
      // 角色类型
      usertype: 0,
      // 订单总价
      yorder_amount: 0,
      //修改后价格
      order_amount: "",
      //订单id
      orderid: "",
      isprice: 0,
      //确认支付备注
      mark: "",
      //快递列表
      express: [{ abridge: "rrs", logistics: "日日顺" },{ abridge: "shunfeng", logistics: "顺丰" },{ abridge: "ems", logistics: "EMS" },{ abridge: "zhongtong", logistics: "中通" },{ abridge: "yuantong", logistics: "圆通" },{ abridge: "yuantong", logistics: "百世快递" }],
      //快递信息
      one: "",
      //快递单号
      expressNumber:"",
    };
  },
   deactivated() {
    this.showFlag = false;
  },
  methods: {
    /**
     * 确认修改 1修改价格 2确认支付 3发货
     */
    sure() {
      if (this.action == 1) {
        if (this.order_amount == "") {
          this.$toast("请输入修改后价格");
          return false;
        }
        editPrice({
          order_amount: this.order_amount,
          orderid: this.orderid
        }).then(res => {
          if (res.result === "success") {
            this.$toast("修改成功", "success");
            this.showFlag = false;
            this.getOrderList();
          }
        });
      } else if (this.action == 2) {
        orderPayment({ mark: this.mark, orderid: this.orderid }).then(res => {
          if (res.result === "success") {
            this.$toast("确认支付成功", "success");
            this.showFlag = false;
            this.getOrderList();
          }
        });
      } else if (this.action == 3) {
        mallSend({ expressNumber: this.expressNumber, orderid: this.orderid,abridge: this.one.abridge,logistics:this.one.logistics}).then(res => {
          if (res.result === "success") {
            this.$toast("确认发货成功", "success");
            this.showFlag = false;
            this.getOrderList();
          }
        });
      }
    },
    /**
     * 显示修改窗口
     * @param {Number} 1修改价格 2确认支付 3发货
     */
    showbox(action, orderid, order_amount) {
      this.action = action;
      this.orderid = orderid;
      this.yorder_amount = order_amount;
      this.showFlag = true;
    },
    /**
     * 查看物流
     */
    list() {
      this.$router.push("/user/order");
    },
    /**
     * 查看物流
     */
    logistics(sn) {
      this.$router.push("/logistics?sn=" + sn);
    },
    /**
     * 跳链接
     */
    open(url) {
      location.href = url;
    },
    /**
     * 打开详情页
     */
    openView(item) {
      let storeUrl = this.storeInfo.storeurl;
      let params = getViewRoute(item);
      location.href = storeUrl + "/#" + params;
    }
  },
  activated() {
    this.$store.ready(state => {
      this.usertype = state.userInfo.usertype;
    });

    this.$showLoading();
    this.loaded = false;
    let params = {
      ordersn: this.$route.params.id
    };
    let par = getParams();
    if (par.h5token) {
      params.h5token = par.h5token;
      this.hasToken = 1;
    } else {
      this.hasToken = 0;
    }
    getOrderDetail(params).then(res => {
      this.info = res.info;
      this.storeInfo = res.storeinfo;
      this.values = res.values;
      this.loaded = true;
      this.$hideLoading();
    });
  }
};
</script>
<style scoped>
.order-pay-status {
  padding: 15px;
  color: #fff;
  background: linear-gradient(to right, #e85b45, #ee7246);
}
.order-pay-status__text {
  font-size: 18px;
}

.order-pay-info,
.order-info__store,
.order-info__cont,
.order-info__list,
.order-info__other {
  background: #fff;
}

.order-info__store {
  height: 44px;
  line-height: 44px;
  font-size: 14px;
  overflow: hidden;
  padding: 0 10px;
}
.order-info__store .ks-icon {
  float: right;
  color: #999;
}
.order-info__store .order-info__store_logo {
  width: 28px;
  height: 28px;
  float: left;
  border-radius: 50%;
  margin: 8px 7px 0 0;
}
.order-info__cont {
  padding: 10px 10px 10px 170px;
  min-height: 90px;
  position: relative;
}
.order-info__cont .order-info__image {
  width: 140px;
  height: 80px;
  position: absolute;
  left: 10px;
  top: 10px;
}
.order-info__title {
  font-size: 14px;
  line-height: 20px;
  /* height: 40px; */
  /* overflow: hidden; */
}
.order-info__paymodel {
  display: inline-block;
  color: #e5412c;
  font-size: 12px;
  padding: 0px 3px;
  border: 1px solid #e5412c;
}
.order-info__type {
  color: #999;
  margin-top: 6px;
}
.order-info__price {
  font-size: 16px;
  text-align: right;
  margin-top: 6px;
}

.order-info__other {
  line-height: 24px;
  font-size: 14px;
  padding: 15px;
  color: #999;
}
.order-express {
  background: #fff;
  height: 70px;
  margin-top: 9px;
}
.order-express__left {
  float: left;
  margin: 10px;
}
.order-express__left img {
  width: 24px;
  height: 24px;
  margin-top: 10px;
}
.order-express__right {
  /* float: left; */
  margin-top: 17px;
  font-size: 14px;
  padding-top: 5px
}
.order-fast {
  background: #fff;
  height: 30px;
  line-height: 30px;
  font-size: 14px;
}
.ks-button{
  border: 1px solid #aaa !important;
}
  .zf_left {
  padding-left: 15px;
}
.confirm-btn-wrap {
  padding-top: 9px;
  text-align: center;
}
.ks-textarea {
  border: 1px solid #ccc;
  /* margin-left: -33px; */
  margin-top: 12px;
}
.select{
  -webkit-appearance:menulist;
  width: 155px;
  height: 29px;
}
.kt_list{
  float: right;
}
.goback{
  height: 32px;
}
.versions {
  background-color: #eee;
  font-size: 12px;
  color: #999;
  padding: 3px;
  border-radius: 5px;
}
</style>

