<template>
  <div class="page">
    <ks-tabs v-model="paystatus" @tab-click="changeTab">
      <ks-tab-pane label="全部" :name="-1"></ks-tab-pane>
      <ks-tab-pane label="未付款" :name="2"></ks-tab-pane>
      <ks-tab-pane label="已付款" :name="1"></ks-tab-pane>
      <ks-tab-pane label="待发货" :name="5"></ks-tab-pane>
      <ks-tab-pane label="待收货" :name="3"></ks-tab-pane>
      <ks-tab-pane label="已收货" :name="4"></ks-tab-pane>
    </ks-tabs>
    <van-dropdown-menu v-if="usertype > 0">
        <van-dropdown-item v-model="value1" :options="option1" @change="dropdown" class="option1"/>
    </van-dropdown-menu>
    <ks-page-scroll-container
      class="my-order-list"
      :page="page"
      :page-count="pageCount"
      @page-change="getOrderList"
      v-if="datas.length"
    >
      <div class="item" v-for="(item,i) in datas" :key="i">
        <div class="myList-time line">
          <span
            v-if="(item.type !=14 && item.type !=15) || item.paystatus==0"
            class="status"
            :class="item.paystatus == 0 && 'ks-color-error'"
          >{{(item.paystatus == 0 && '待付款') || (item.paystatus == 1 && '已付款') || (item.paystatus == 2 && '退款中') || (item.paystatus == 3 && '已退款')}}</span>
          <span
            v-if="(item.type ==14 || item.type ==15) && item.paystatus==1"
            class="status"
            :class="item.orderstatus == 0 && 'ks-color-error'"
          >{{(item.orderstatus == 0 && '待发货') || (item.orderstatus == 1 && '待收货') || (item.orderstatus == 2 && '已收货')}}</span>

          <span class="order-time" v-if="item.paystatus == 0">下单时间：{{item.adddate}}</span>
          <span class="order-time" v-else-if="item.paystatus == 1">付款时间：{{item.paydate}}</span>
        </div>
        <div
          class="order-body line"
          v-for="(order,index) in item.courseOrder"
          :key="index"
          @click="openView(order,item.storeinfo.storeurl)"
        >
          <div class="ks-bg">
            <ks-create-bg :src="order.defaultpic" class="defaultpic" />
            <span class="bg-type" v-if="item.type == 14 || item.type == 15">商品</span>
            <span class="bg-type" v-if="item.type == 0">课程</span>
          </div>
          <div class="order-body-info">
            <div class="order-body-info-title">
              {{order.title}}
              <span
                v-if="order.coursetype==5 && JSON.parse(order.json) && JSON.parse(order.json).paymodel==0"
                class="order-info__paymodel"
              >订金</span>
            </div>
            <a v-if="(item.type == 14 || item.type == 15)&& order.json.attr" class="versions"><a v-for="(attr,index) in order.json.attr" :key="index">{{attr}};</a></a>
            <div class="order-info__type" v-if="order.type == 0 && order.coursetype == 1">点播课程</div>
            <div class="order-info__type" v-else-if="order.type == 0 && order.coursetype == 2">语音直播</div>
            <div class="order-info__type" v-else-if="order.type == 0 && order.coursetype == 3">音频课程</div>
            <div class="order-info__type" v-else-if="order.type == 0 && order.coursetype == 4">图文课程</div>
            <div class="order-info__type" v-else-if="order.type == 1">直播课程</div>
            <div class="order-info__type" v-else-if="order.type == 7">专栏</div>
            <div class="order-info__type" v-else-if="order.type == 9">会员卡</div>
            <div class="order-info__type" v-else-if="order.type == 10">社群</div>
            <div class="price">
              <span class="ks-color-error">
                ￥{{order.price}}
                <a
                  style="color:red;"
                  v-if="item.type == 14 || item.type == 15"
                >X{{order.numb}}</a>
              </span>
            </div>
          </div>
        </div>
        <div class="order-mall" v-if="item.type == 14 || item.type == 15">
          共{{item.all_num}}件商品，
          <a>原价:{{item.original_amount}}</a>
          合计￥{{item.order_amount}}（含运费￥{{item.freight}}）
        </div>
        <div class="order-bottom">
          <div class="ks-fr">
            <ks-button
              class="ks-ml5"
              size="small"
              v-if="(item.type == 14 || item.type == 15) && (item.orderstatus == 1 || item.orderstatus == 2)"
              @click="logistics(item.ordersn)"
            >查看物流</ks-button>
            <ks-button
              class="ks-ml5"
              size="small"
              v-if="(item.type == 14 || item.type == 15) && item.orderstatus == 1 && usertype !=1"
              @click="confirmReceip(item.ordersn)"
            >确认收货</ks-button>
            <ks-button
              class="ks-ml5"
              size="small"
              v-if="item.paystatus == 0"
              @click="delorder(i,item.ordersn)"
            >删除订单</ks-button>
            <ks-button
              class="ks-ml5"
              size="small"
              type="primary"
              v-if="item.paystatus==0 && usertype==0"
              @click="pay(item.payurl,item.ordersn)"
            >立即付款</ks-button>
            <ks-button
              class="ks-ml5"
              size="small"
              v-if="item.paystatus == 1 ||item.paystatus==3"
              @click="chakanDetail(item.ordersn)"
            >查看订单</ks-button>
            <ks-button
              class="ks-ml5"
              size="small"
              v-if="item.paystatus == 0 && usertype != 0"
              @click="showbox(2,item.orderid)"
            >确认支付</ks-button>
            <ks-button
              class="ks-ml5"
              size="small"
              v-if="item.paystatus == 0 && usertype!=0 && (item.type == 14 || item.type == 15)"
              @click="showbox(1,item.orderid,item.order_amount)"
            >修改价格</ks-button>
            <ks-button
              class="ks-ml5"
              size="small"
              v-if="item.paystatus == 1 && item.orderstatus == 0 && usertype!=0 && (item.type ==14 || item.type == 15)"
              @click="showbox(3,item.orderid)"
            >发货</ks-button>
            <!-- <ks-button class="ks-ml5" size="medium" v-if="items.groupid  && item.paystatus==1" @click="mycollage(item.lookurl)">我的拼团</ks-button>
						<ks-button class="ks-ml5" size="medium" v-if="items.groupid && item.paystatus==1 && item.successful==0" @click="tuikuan(index,item.ordersn)">等待退款</ks-button>
            <ks-button class="ks-ml5" size="medium" v-else-if="items.groupid && item.paystatus==1 && item.successful==2" @click="tuikuan(index,item.ordersn)">拼团中</ks-button>-->
          </div>
          <div v-if="hasToken === 1" @click="open(item.storeinfo.storeurl)">
            <ks-create-bg :src="item.storeinfo.storelogo" class="ks-fl" type="logo" />
            {{item.storeinfo.storename}}
          </div>
        </div>
      </div>
    </ks-page-scroll-container>
    <ks-empty type="noorder" msg="暂时没有订单~" v-else-if="loaded" />
    <!-- <ks-dialog title="申请退款" :visible.sync="refund">
			<div class="ks-alert">为保证您的资金安全，请填写以下信息，我们到时候会与您联系确认。</div>
			<ks-form label-width="70px">
				<ks-form-item label="手机号">
					<input class="ks-input" ref="tel" type="number" v-model="tel" placeholder="请输入您的手机号">
				</ks-form-item>
				<ks-form-item label="微信号">
				<input class="ks-input" type="text" ref="wechat" v-model="wechat" placeholder="请输入您的微信号">
				</ks-form-item>
			</ks-form>
			<div class="ks-text-center ks-mt15">
				<ks-button size="medium" @click="refund = false">取消</ks-button>
				<ks-button size="medium" type="primary" @click="confirmsure">确认</ks-button>
				
			</div>
    </ks-dialog>-->
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

      <ks-form label-width="80px" v-if="action==2" class="ktj__form">
        <ks-radio v-model="isprice" :label="0">银行转账</ks-radio>
        <ks-radio v-model="isprice" :label="1">现金支付</ks-radio>
        <ks-form-item label="备注：">
          <!-- <input v-model="mark" class="ks-textarea" /> -->
          <textarea name="" id="" cols="30" rows="10" v-model="mark" class="ks-textarea">

          </textarea>
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
import wx from "weixin-js-sdk";
import { getParams, getViewRoute } from "@/utils";
import {
  getUserCourseOrder,
  deleteOrder,
  confirmReceip,
  editPrice,
  orderPayment,
  mallSend,
  showSub
} from "@/api/user";
export default {
  name: "CourseOrder",
  data() {
    return {
      value1:0,
      option1: [
        { text: "全部订单", value: 0 },
      ],
      //快递列表
      express: [{ abridge: "rrs", logistics: "日日顺" },{ abridge: "shunfeng", logistics: "顺丰" },{ abridge: "ems", logistics: "EMS" },{ abridge: "zhongtong", logistics: "中通" },{ abridge: "yuantong", logistics: "圆通" },{ abridge: "yuantong", logistics: "百世快递" }],
      //快递信息
      one: "",
      //快递单号
      expressNumber:"",
      hasToken: -1,
      /**
       * 分页信息
       */
      page: 1,
      pageCount: 1,
      /**
       * 当前筛选类型
       */
      paystatus: -1,

      /**
       * 数据信息
       */
      loaded: false,
      datas: [],
      /**
       * 退款信息
       */
      refund: false,
      tel: "",
      wechat: "",
      tuikuanindex: -1,
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
      extuserid:'0'
    };
  },
  deactivated() {
    this.showFlag = false;
  },
  methods: {
    dropdown(val) {
      this.extuserid = val
      this.getOrderList()
    },
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
      this.one = '';
      this.order_amount = '';
      this.expressNumber = '';
      this.action = action;
      this.orderid = orderid;
      this.yorder_amount = order_amount;
      this.showFlag = true;
    },
    /**
     * 选项卡切换回调
     */
    changeTab(pay) {
      if (pay == 3) {
        this.orderstatus = 1;
        this.paystatus = 3;
      }
      if (pay == 4) {
        this.orderstatus = 2;
        this.paystatus = 4;
      }
      if (pay == 5) {
        this.orderstatus = 3;
        this.paystatus = 5;
      }
      if (pay == -1 || pay == 1 || pay == 2) {
        this.paystatus = pay;
        this.orderstatus = -1;
      }
      //this.paystatus = pay;
      this.pageCount = null;
      this.loaded = false;
      this.getOrderList();
    },

    /**
     * 删除订单
     */
    delorder(index, sn) {
      this.$confirm("确定要删除该订单吗？").then(() => {
        let params = {
          ordersn: sn
        };
        
        deleteOrder(params).then(res => {
          this.$toast(res.msg, "success").then(() => {
            this.datas.splice(index, 1);
          });
        });
      });
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
    openView(item, storeUrl) {
      if (item.type == 14 || item.type == 15) {
        this.$router.push(`/commodity?id=${item.courseid}`);
      } else if(item.type == 12){
        this.$router.push(`/activity/${item.courseid}`);
      }else {
        this.$router.push(`/course/${item.courseid}`);
      }

      // if (item.type != 9) {
      //   let params = getViewRoute(item, "courseid");
      //   location.href = storeUrl + "/#" + params;
      // }
    },
    /**
     * 查看订单
     */
    chakanDetail(sn) {
      this.$router.push({
        name: "UserOrderInfo",
        params: {
          id: sn
        }
      });
    },
    /**
     * 确认收货
     */
    confirmReceip(sn) {
      this.$confirm("是否确认收货？").then(() => {
        let params = {
          ordersn: sn
        };
        confirmReceip(params).then(res => {
          this.$toast(res.msg, "success").then(() => {
            this.getOrderList();
          });
        });
      });
    },
    /**
     * 查看物流
     */
    logistics(sn) {
      this.$router.push("/logistics?sn=" + sn);
    },
    /**
     * 支付
     */
    pay(url, ordersn) {
      if (window.__wxjs_environment === 'miniprogram') {
        this.$store.ready(state=>{
          wx.miniProgram.navigateTo({
            url: `/pages/pay/pay?wxid=${state.info.wxid}&ordersn=${ordersn}`
          });
        })
      } else {
        location.href = url;
      }
    },
    /**
     * 获取订单列表
     */
    getOrderList(page = 1) {
      this.$showLoading();
      this.page = page;
      let params = {
        paystatus: this.paystatus,
        orderstatus: this.orderstatus,
        p: this.page,
        maxperpage: 10,
        extuserid:this.extuserid
      };
      
      getUserCourseOrder(params).then(res => {
        if (this.page === 1) {
          this.datas = res.values;
        } else {
          this.datas = this.datas.concat(res.values);
        }
        this.pageCount = res.page.total_pages;
        this.loaded = true;
        this.$hideLoading();
      });
    }
  },
  computed: {
    id() {
      return this.$route.query.id
    }
  },
  watch: {
    id(){
      this.$route.query.id == undefined ? this.value1 = 0 : this.value1 = this.$route.query.id
      this.$route.query.id == undefined ? this.extuserid = '0' : this.extuserid = this.$route.query.id
    }
  },

  activated() {
    document.title = "我的订单";
    this.$route.query.id == undefined ? this.value1 = 0 : this.value1 = this.$route.query.id
    this.$route.query.id == undefined ? this.extuserid = '0' : this.extuserid = this.$route.query.id
    this.$store.ready(state => {
      this.usertype = state.userInfo.usertype || 0 
      let par = getParams();
      if (par.h5token) {
        this.hasToken = 1
        this.getOrderList()
        return
      }
      this.hasToken = 0
      if (state.isLogin == 0) {
        this.$router.push("/user/login");
      }else{
        this.getOrderList();
        if(this.usertype != 0){
          showSub().then(res=>{
            if(this.usertype != 0) {
              res.list.map(item=>{
                this.option1.push({text:item.username,value:item.userid})
              })
            }
          })
        }
      }
      
    });
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style scoped>
.my-order-list .item {
  width: 100%;
  font-size: 14px;
  color: #353535;
  margin-top: 10px;
  background: #fff;
  padding-left: 10px;
  box-sizing: border-box;
}
.my-order-list .item:last-child {
  margin-bottom: 10px;
}
.my-order-list .item .i-head {
  flex: 1;
  overflow: hidden;
}
.my-order-list .item .i-body {
  margin-left: 10px;
}
.my-order-list .item .teacher {
  font-size: 16px;
  color: #353535;
}

.myList-time {
  font-size: 12px;
  color: #999;
  height: 36px;
  line-height: 36px;
  overflow: hidden;
  padding-right: 10px;
}
.myList-time .status {
  float: right;
}

.order-body {
  display: flex;
  align-items: flex-start;
  padding: 10px 10px 10px 0;
}
.order-body .defaultpic {
  width: 140px;
  height: 80px;
  display: block;
  margin-right: 10px;
  border-radius: 5px;
  position: relative;
}

.order-body .defaultpic .status {
  width: 40px;
  height: 20px;
  line-height: 20px;
  font-size: 13px;
  color: #fff;
  background: rgba(0, 0, 0, 0.3);
  position: absolute;
  top: 2px;
  right: 2px;
  text-align: center;
  border-radius: 4px;
}
.order-body .order-body-info {
  flex: 1;
  height: 80px;
  position: relative;
  overflow: hidden;
}
.order-body-info-title {
  font-size: 14px;

  line-height: 20px;
  /* height: 40px; */
  margin-bottom: 5px;
  /* overflow: hidden; */
}
.order-info__paymodel {
  display: inline-block;
  color: #e5412c;
  font-size: 12px;
  padding: 0px 3px;
  border: 1px solid #e5412c;
}
.price {
  position: absolute;
  bottom: 0;
  right: 0;
}

.order-info__type {
  color: #999;
  margin-top: 6px;
  font-size: 12px;
}
.order-bottom {
  padding: 6px 10px 6px 0;
  height: 32px;
  line-height: 32px;
  font-size: 13px;
  overflow: hidden;
}
.order-bottom .ks-create-bg {
  width: 26px;
  height: 26px;
  position: relative;
  top: 3px;
  margin-right: 10px;
  border-radius: 50%;
}
.order-mall {
  text-align: right;
  margin-top: 8px;
}
.zf_left {
  padding-left: 15px;
}
.confirm-btn-wrap {
  padding-top: 9px;
  text-align: center;
}
.ks-textarea {
    /* margin-left: 46px; */
    border: 1px solid #ccc;
    margin-top: 6px;
    width: 192px;
    height: 60px;
    line-height: 16px;
    padding: 5px;
}
.select{
  -webkit-appearance:menulist;
  width: 155px;
  height: 29px;
}
.page {
  background: #f5f5f5;
}
.page /deep/ .van-dropdown-menu__item{
  justify-content:flex-end;
}
.page /deep/ .van-dropdown-menu__title {
  margin-right: 15px;
}
.ks-bg{
  position: relative;
}
.bg-type{
  position: absolute;
  top:0;
  left: 3px;
  color: #fff;
  padding: 3px 8px;
  border-radius: 10px;
  background-color: rgba(0, 0, 0, 0.5);
  font-size: 12px;
}
.ktj__form{
  height: 90px !important;
}
.versions {
  background-color: #eee;
  font-size: 12px;
  color: #999;
  padding: 3px;
  border-radius: 5px;
}
</style>
