<template>
  <!-- 确认订单 -->
  <div>
    <div class="confirm">
      <!-- 收货地址 -->
      <div @click="siteset" class="ks-row confirm-site">
        <div class="ks-col-3">
          <i class="ks-icon ks-icon-pin-outline"></i>
        </div>
        <div class="ks-col-19">
          <div class="confirm-item">{{list.realname}}&nbsp;{{list.telphone}}</div>
          <div class="confirm-size">{{list.province}}{{list.city}}{{list.area}}{{list.street}}</div>
        </div>
        <div class="ks-col-2">
          <i class="ks-icon ks-icon-chevron-right-outline"></i>
        </div>
      </div>
      <!-- 添加的商品 -->
      <div class="ks-row order" v-for="(item,id) in date" :key="id">
        <div class="ks-col-7">
          <ks-image style="height: 95px;" :src="item.defaultpic" />
        </div>
        <div class="ks-col-17 order-right">
          <div class="order-title">{{item.title}}</div>
          <a v-if="item.json.date" class="versions">{{item.json.date}}</a>
          <div class="order-price"></div>
          <div class="ks-row order-bottom">
            <div class="ks-col-15">
              <li class="ks-color-info">
                <s>￥{{item.json.uprice}}</s>
              </li>
            </div>
            <div class="ks-col-9">
              <li>
                <span>￥{{item.json.price}}</span>
                <a>x{{item.num}}</a>
              </li>
            </div>
          </div>
        </div>
      </div>
      <div class="coupon">
        <div class="ks-cell ks-cell--clickable" v-if="vipdiscount == {} || (vipdiscount && vipdiscount.other == 1)">
          <div class="ks-line activity-row">
            <span>优惠券</span>
            <div v-if="vouceherList && vouceherList.length" style="width:100px;text-align:right;">
              <select v-model="vouceher" class="activity-row-vouceher" @change="vouceherChange">
                <option value="-1">选择优惠券</option>
                <option
                  v-for="(item,i) in vouceherList"
                  :value="i"
                  :key="i"
                >{{parseInt(item.money)}}元优惠券</option>
              </select>
            </div>
            <span v-else>&nbsp;&nbsp;暂无可用优惠券</span>
          </div>
          <!-- <div class="ks-cell__title">
                    <span class="ks-cell--left">优惠券</span>
                    <span class="ks-cell--center">-￥1.00</span>
          </div> -->
          <!-- <i class="ks-icon ks-icon-chevron-right-outline"></i> -->
        </div>
        <div style="lineHeight: 15px;" class="coupon-bottom">
          买家留言
          <input v-model="json.mark" placeholder="选填，对本次交易的说明" class="control" />
        </div>
      <div class="expressage">快递费：<span>￥{{freight}}</span></div>
      </div>
      <store-footer />
    </div>
    <!-- 底部合计 -->
    <div class="cart-btn">
      <span class="ks-fr">
        <span class="cart-btn__freight">共计{{num}}件</span>
        <span class="cart-total">合计：</span>
        <span class="cart-sum">￥
            <a class="cart-sum" v-if="(all_price-vouceherValue)<=0">0</a>
            <a class="cart-sum" v-if="(all_price-vouceherValue)>0">{{(all_price-vouceherValue).toFixed(2)}}</a>
        </span>
        <ks-button
          @click="onClickpresent"
          style="height: 38px;lineHeight: 30px;marginLeft: 10px;"
          class="ks-fr"
          type="primary"
          ref="tjbtn"
          :disabled="flag"
        >提交订单</ks-button>
      </span>
    </div>
  </div>
</template>
<script>
import { confirmOrder, addressList } from "@/api/mall.js";
import { getOrderNow } from "@/api/course";
import { getUserWealth } from "@/api/user";
export default {
  name: "confirm",
  data() {
    return {
      /**版本信息 */
      //versionsmsg:'',
      /**优惠券信息 */
      vipdiscount:{},
      /**优惠券列表 */
      vouceherList: [],
      /**优惠券id */
      vouceher: -1,
      /**优惠券大小 */
      vouceherValue:0,
      json: {
        mark: "" //备注
      },
      date: [],
      list: {
        realname: "请添加收货地址",
        province: "你还没添加任何地址，点击添加",
        city: "",
        area: "",
        street: "",
        id: "0"
      },
      sumto: "",
      all_price: "",
      num: "",
      index:0,
      commodityId:'',
      freight:'',
      flag:false
    };
  },
  methods: {
    //提交订单
    onClickpresent() {
      let params;
      if (this.json.mark.length>20) {
        return this.$toast("备注最多自能填写20个字","success");
      }
      if (this.$route.query.type == 1) {
        //直接下单
        params = {
          id: this.$route.query.id, //商品id
          type: "14", //下单类型：14：直接下单；15：购物车下单
          couponid: this.vouceher!=-1?this.vouceherList[this.vouceher].id:"",
          json: {
            mark: this.json.mark, //备注
            attr_id:this.$route.query.attr_id,              //属性id，type等于14才有，选题
            num: this.$route.query.num, //购买数量，type等于14才有，必填
            address_id: this.list.id //收货地址id
          }
        };
      } else {
        //购物车下单
        params = {
          couponid: this.vouceher!=-1?this.vouceherList[this.vouceher].id:"",
          type: "15", //下单类型：14：直接下单；15：购物车下单
          json: {
            mark: this.json.mark, //备注
            address_id: this.list.id, //收货地址id
            cart_id: this.$route.query.id.split(",") //购物车id，type等于15才有，必填
          }
        };
      }
      getOrderNow(params).then(res => {
        this.flag = true
        location.href = res.url
        setTimeout(() => {
          this.flag = false
        }, 5000);
      });
    },
    siteset() {
      if (this.list == "") {
        this.$router.push("/editaddress");
      } else {
        this.$router.push("/shipping");
      }
    },
    /**优惠券改变时触发 */
    vouceherChange(){
      let ind = this.vouceher;
      if(ind!=-1){
        this.vouceherValue = parseInt(this.vouceherList[ind].money);
        // console.log(this.vouceherList[this.vouceher].id);
      }else{
        this.vouceherValue = 0;
      }
    }
  },
  activated() {
    let params;
    if (this.$route.query.type == 1) {
      params = {
        type: this.$route.query.type, //类型
        num: this.$route.query.num, //数量
        id: this.$route.query.id,//商品ID
        attr_id:this.$route.query.attr_id
      };
    } else {
      params = {
        type: 2, //类型
        cart_id: this.$route.query.id.split(",")
      };
    }
    confirmOrder(params).then(res => {
      //this.versionsmsg = res.data.json.date
      if(res.msg == "请求出错") {
        this.$router.push('/cart')
      }
      if (params.type == 1) {
        /**立即购买 */
        this.date = [res.data];
        this.commodityId = this.$route.query.id
      } else {
        /**购物车点击 */
        this.date = res.data;
        if(res.length) {
          res.data.length == 1 ? this.commodityId = res.data[0].goodsid : this.commodityId = ""
        }
      }
      this.freight = res.freight;
      // this.all_price = res.all_price ;
      this.num = res.num;
      let all_price = res.all_price;
      getUserWealth({type: 14,all_price,id:this.commodityId}).then(res => {
      if ((res.resule = "success")) {
        this.vouceherList = res.list;
        this.vipdiscount = res.vipdiscount
        if(res.vipdiscount.discount) {
          this.all_price = all_price * this.vipdiscount.discount / 10
        }else {
          this.all_price = all_price
        }
      }
    });
    }),
      addressList().then(res => {
        let id = sessionStorage.getItem('index')
        id == undefined ? id = 0 : id 
        if (res.list != "") {
          this.list = res.list[id];
        } else if (res.list.length == 0) {
          this.$confirm("请填写收货地址").then(() => {
            this.$router.push("/editaddress");
          });
        }
      });
    // this.getList();
    document.title = "确认订单";
  },
};
</script>
<style scoped>
.activity-row {
  padding: 15px 20px 15px 0px;
  background-color: #ffffff;
  font-size: 14px;
  color: #4b4b4b;
  display: flex;
  justify-content: space-between;
}
.activity-row-vouceher{
  border: none;
  background-color: #ffffff;
}
.confirm {
  padding: 10px;
}
.confirm-site {
  background-color: #fff;
  border-radius: 5px;
  padding: 15px 10px;
}
.confirm-site .ks-col-3 i,
.confirm-site .ks-col-2 i {
  color: #999;
  font-size: 24px;
}
.confirm-site .confirm-item {
  font-size: 16px;
  font-weight: 600;
}
.confirm-site .confirm-size {
  font-size: 14px;
  color: #999;
  margin-top: 10px;
}
.order {
  background-color: #fff;
  margin-top: 10px;
  padding: 10px;
  border-radius: 5px;
}
.order-right {
  padding-left: 10px;
  font-size: 14px;
}
.order-bottom {
  text-align: right;
}
.order-bottom li {
  padding-top: 10px;
}
.order-bottom span {
  font-size: 15px;
  color: black;
  padding-right: 5px;
}
.order-bottom a {
  font-size: 13px;
  color: #888f9d;
}
.versions {
  background-color: #eee;
  font-size: 12px;
  color: #999;
  padding: 3px;
  border-radius: 5px;
}
.order-title {
  margin-bottom: 10px;
  font-size: 16px;
}
/* cell单元格 */
.ks-cell {
  position: relative;
  display: -webkit-box;
  display: -webkit-flex;
  display: flex;
  box-sizing: border-box;
  width: 100%;
  padding: 10px 16px;
  overflow: hidden;
  color: #666;
  font-size: 14px;
  line-height: 24px;
  background-color: #fff;
}
.ks-cell--left {
  color: #666;
  margin-right: 10px;
}
.ks-cell--center {
  color: #333;
  float: right;
}
.ks-cell__title,
.ks-cell__value {
  -webkit-box-flex: 1;
  -webkit-flex: 1;
  flex: 1;
}
.ks-icon {
  position: relative;
  font-size: 24px;
}
.coupon {
  margin-top: 10px;
  border-radius: 5px;
  overflow: hidden;
  background-color: #fff;
  font-size: 14px;
}
.coupon-bottom {
  padding: 10px 16px;
  color: #666;
}
.total {
  height: 50px;
  background-color: #fff;
  margin-left: -10px;
  margin-right: -10px;
  position: fixed;
  bottom: 0;
  left: 0;
}
.cart-sum {
  font-size: 16px;
  color: red;
}
.cart-btn {
  background-color: #fff;
  overflow: hidden;
  padding: 10px;
  font-size: 14px;
  line-height: 28px;
  position: fixed;
  bottom: 0;
  width: 94.5%;
}
.cart-btn__freight {
  color: #9a9a9a;
}
.cart-btn /deep/ .ks-button {
  border-radius: 25px;
}
body .ks-fr {
  line-height: 38px;
}
.control {
  width: 77%;
  color: #323233;
  text-align: left;
  border: 0;
  float: right;
}
.expressage{
    background-color: #fff;
    text-align: right;
    padding: 10px;
    border-radius: 5px;
    font-size: 14px;
}
</style>