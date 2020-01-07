<template>
  <div>
    <div class="myOrder">
      <!-- 头部分页区 -->
      <div class="myOrder-top">
        <h1>我的订单</h1>
        <div class="myOrder-top__box">
          <div class="myOrder-top__tab">
            <span :class="{active:paystatus==-1}" @click="changeTab(-1)">全部</span>
            <span :class="{active:paystatus==2}" @click="changeTab(2)">待支付</span>
            <span :class="{active:paystatus==1}" @click="changeTab(1)">已付款</span>
            <span :class="{active:paystatus==3}" @click="changeTab(3)">待收货</span>
            <span :class="{active:paystatus==4}" @click="changeTab(4)">已收货</span>
          </div>
        </div>
      </div>
      <!-- 内容区 -->
      <div class="myOrder-main">
        <div class="myOrder-title">
          <div class="myOrder-title__goods">商品</div>
          <div class="myOrder-title__price">合计金额</div>
          <div class="myOrder-title__state">状态</div>
          <div class="myOrder-title__operate">操作</div>
        </div>
        <div class="myOrder-list" v-for="(item,i) in datas" :key="i">
          <div class="myOrder-list__top">
            <span>下单时间：{{item.adddate}}</span>
            <p>订单编号：{{item.ordersn}}</p>
          </div>
          <div class="myOrder-list__bottom" v-for="(order,n) in item.courseOrder" :key="n">
            <div class="myOrder-list__goods">
              <ks-image :src="order.defaultpic" @click="open(order)" />
              <div class="myOrder-list__right">
                <h1 @click="open(order)">{{order.title}}</h1>
                <span v-if="order.type == 0 && order.coursetype == 1">点播课程</span>
                <span v-else-if="order.type == 0 && order.coursetype == 2">直播课程</span>
                <span v-else-if="order.type == 0 && order.coursetype == 3">音频课程</span>
                <span v-else-if="order.type == 0 && order.coursetype == 4">图文课程</span>
                <span v-else-if="order.type == 7">专栏</span>
                <span v-else-if="order.type == 9">会员卡</span>
                <span v-else-if="order.type == 10">社群</span>
                <span v-else-if="order.type == 11">资料</span>
                <span v-else>{{order.buytype}}</span>
              </div>
            </div>
            <!-- <i></i>
            <div class="myOrder-list__price">￥{{order.price}}</div>
            <i></i>
            <div class="myOrder-list__state" v-if="(item.type !=14 && item.type !=15) || item.paystatus==0">
                {{(item.paystatus == 0 && '待付款') || (item.paystatus == 1 && '已付款') || (item.paystatus == 2 && '退款中') || (item.paystatus == 3 && '已退款')}}
            </div>
            <div class="myOrder-list__state" v-else-if="(item.type ==14 || item.type ==15) && item.paystatus==1">
             {{(item.orderstatus == 0 && '待发货') || (item.orderstatus == 1 && '待收货') || (item.orderstatus == 2 && '已收货')}}
            </div>
            <i></i>
            <div class="myOrder-list__operate" v-if="order.paystatus==1">
              <span @click="popup(item.ordersn)">订单详情</span>
            </div>
            <div class="myOrder-list__nopay" v-else-if="order.paystatus==0">
              <el-button
                style="margin-top: 35px;"
                size="medium"
                type="warning"
                @click="$pay(item.qrcode,item.ordersn,order.price)"
              >立即支付</el-button>
              <p @click="delorder(i,item.ordersn)">删除订单</p>
            </div>-->
          </div>
          <div class="order_list" style>
            <div class="myOrder-list__price">￥{{item.order_amount}}</div>
            <i></i>
            <div
              class="myOrder-list__state"
              v-if="(item.type !=14 && item.type !=15) || item.paystatus==0"
            >{{(item.paystatus == 0 && '待付款') || (item.paystatus == 1 && '已付款') || (item.paystatus == 2 && '退款中') || (item.paystatus == 3 && '已退款')}}</div>
            <div
              class="myOrder-list__state"
              v-else-if="(item.type ==14 || item.type ==15) && item.paystatus==1"
            >{{(item.orderstatus == 0 && '待发货') || (item.orderstatus == 1 && '待收货') || (item.orderstatus == 2 && '已收货')}}</div>
            <i></i>
            <div class="myOrder-list__operate" v-if="item.paystatus==1 ">
              <span @click="popup(item.ordersn)">订单详情</span>
              <span
                v-if="item.orderstatus == 1 || item.orderstatus == 2"
                @click="showLog(item.ordersn)"
              >查看物流</span>
              <span
                v-if="item.orderstatus == 1"
                class="order__take"
                @click="confirmReceip(i,item.ordersn)"
              >确认收货</span>
            </div>

            <div class="myOrder-list__nopay" v-else-if="item.paystatus==0">
              <el-button
                size="medium"
                type="warning"
                @click="$pay(item.qrcode,item.ordersn,item.order_amount)"
              >立即支付</el-button>
              <p @click="delorder(i,item.ordersn)">删除订单</p>
              <p @click="popup(item.ordersn)" v-if="item.type == 14 ||item.type == 15">订单详情</p>
            </div>
          </div>
        </div>
        <div style="text-align: center;">
          <el-pagination
            background
            layout="prev, pager, next"
            :total="pageCount"
            @current-change="getOrderList"
            v-if="pageCount>0"
          />
          <ks-empty msg="该分类暂无订单" v-else />
        </div>
      </div>
    </div>
    <el-dialog title="查看物流" :visible.sync="dialogVisible" width="35%" :center="true">
      <div class="showlog__hx"></div>
      <div class="showlog"> 下单时间:{{info.adddate}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 物流快递:{{info.logistics}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 快递单号:{{info.expressNumber}}</div>
      <span>
        <el-timeline :reverse="reverse">
          <el-timeline-item
            v-for="(activity, index) in activities"
            :key="index"
            :timestamp="activity.context"
          >{{activity.time}}</el-timeline-item>
        </el-timeline>
        <a style="margin-left: 40%;" v-if="message != 'ok'">还没有物流信息</a>
      </span>
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="dialogVisible = false">确 定</el-button>
      </span>
    </el-dialog>
    <order-popup :visible.sync="visible" :ordersn="ordersn" v-if="ordersn" />
  </div>
</template>

<script>
import OrderPopup from "./components/OrderPopup";
import userOrderMixin from "@/mixins/user/user.order";
import { showLogistics } from "@/api/mall.js";
export default {
  name: "MyOrder",
  components: {
    OrderPopup
  },
  mixins: [userOrderMixin],
  data() {
    return {
      dialogVisible: false,
      tab: -1, //默认显示全部
      visible: false,
      ordersn: null,
      reverse: true,
      activities: [],
      info:[],
      message:''
    };
  },
  methods: {
     /**查看物流 */
    showLog(ordersn) {
        showLogistics({ordersn}).then(res=>{
            this.info = res.info;
            this.info.title = res.info.title.substring(0,5);
            this.activities = res.data;
            this.message = res.message;
        });
        this.dialogVisible = true;
      },
    /**
     * 打开订单详情
     * @param {String} 当前订单编号
     */
    popup(ordersn) {
      this.ordersn = ordersn;
      this.visible = true;
    },
    /**
     * 打开
     */
    open(item) {
      let name;
      if (item.type == (1 || 2 || 3 || 4)) {
        this.$router.push({
          name: "CourseDetail",
          params: {
            id: item.courseid
          }
        });
      } else if (item.type == 7) {
        this.$router.push({
          name: "ColumnDetail",
          params: {
            id: item.columnid
          }
        });
      } else if(item.type == 14 || item.type == 15) {
        this.$router.push(`/commodity?id=${item.courseid}`)
      }
    }
  },
  mounted() {
    this.getOrderList();  
  }
};
</script>

<style scoped>
.myOrder {
  width: 100%;
}
.myOrder-top {
  width: 100%;
  border-bottom: 1px solid #eee;
}
.myOrder-top h1 {
  font-size: 20px;
  color: #2d3336;
  font-weight: 400;
  padding: 21px 24px;
}
.myOrder-top__box {
  height: 44px;
  width: 100%;
  position: relative;
}
.myOrder-top__tab {
  height: 44px;
  line-height: 44px;
  position: absolute;
  top: 0;
  left: 0;
}
.myOrder-top__tab span {
  display: inline-block;
  width: 64px;
  height: 100%;
  text-align: center;
  margin-left: 40px;
  font-size: 16px;
  color: #585e61;
  cursor: pointer;
}
.active {
  border-bottom: 2px solid #2e84ee;
  color: #2e84ee !important;
}
/* 内容区 */
.myOrder-title {
  height: 40px;
  margin: 20px;
  background: #f4f6fa;
  font-size: 14px;
  color: #929a9e;
  line-height: 40px;
  text-align: center;
}
.myOrder-title__goods {
  width: 304px;
  float: left;
  padding-left: 160px;
  text-align: left;
}
.myOrder-title__price {
  width: 163px;
  float: left;
}
.myOrder-title__state {
  width: 143px;
  float: left;
}
.myOrder-title__operate {
  width: 150px;
  float: left;
}
.myOrder-list {
  position: relative;
  margin: 0 19px 20px 19px;
  border: 1px solid #eee;
}
.myOrder-list__top {
  height: 38px;
  line-height: 38px;
  font-size: 12px;
  color: #929a9e;
  border-bottom: 1px solid #eee;
}
.myOrder-list__top span {
  float: left;
  margin-left: 20px;
}
.myOrder-list__top p {
  float: left;
  margin-left: 10px;
}
.myOrder-list__bottom {
  height: 126px;
  width: 497px;
}
.myOrder-list__bottom i {
  display: inline-block;
  width: 1px;
  height: 70px;
  background: #eee;
  float: left;
  margin-top: 30px;
}
.myOrder-list__goods {
  width: 387px;
  margin: 16px 60px 20px 16px;
  height: 90px;
  float: left;
}
.myOrder-list__goods .ks-image {
  width: 160px;
  height: 100%;
  float: left;
  cursor: pointer;
}
.myOrder-list__right {
  float: left;
  margin-left: 10px;
}
.myOrder-list__right h1 {
  font-size: 14px;
  font-weight: 400;
  line-height: 24px;
  color: #2d3336;
  width: 217px;
  cursor: pointer;
}
.myOrder-list__right span {
  display: inline-block;
  font-size: 14px;
  color: #929a9e;
  margin-top: 10px;
}
.myOrder-list__price {
  width: 163px;
  float: left;
  font-size: 18px;
  color: #ec4a46;
  text-align: center;
}
.myOrder-list__state {
  width: 143px;
  float: left;
  font-size: 14px;
  color: #2d3336;
  text-align: center;
}
.myOrder-list__operate {
  width: 148px;
  float: left;
  font-size: 14px;
  color: #585e61;
  text-align: center;
}
.myOrder-list__operate p {
  margin-top: 40px;
  cursor: pointer;
}
.myOrder-list__operate span {
  display: block;
  cursor: pointer;
  margin-bottom: 4px;
}
.myOrder-list__nopay {
  width: 148px;
  float: left;
  font-size: 14px;
  color: #585e61;
  text-align: center;
}
.myOrder-list__nopay span {
  cursor: pointer;
  margin-top: 40px;
  display: block;
}
.myOrder-list__nopay p {
  cursor: pointer;
  margin-top: 10px;
}
.myOrder-orderDetail {
  position: fixed;
  top: 0;
  height: 100vh;
  background: rgba(0, 0, 0, 0.3);
}
.order_list {
  width: 465px;
  position: absolute;
  right: 0px;
  top: 40%;
}
.order__take {
  border: 2px solid #e6a23c;
  line-height: 30px;
  margin-left: 22px;
  width: 101px;
  color: #e6a23c;
}
.showlog{
  margin-bottom: 20px;
  background-color: #f7f5f1;
  line-height: 45px;
  padding-left: 10px
}
.showlog__hx{
  border-top: 1px solid #d8cece;
  margin-top: -20px;
  margin-bottom: 17px;
}
</style>
