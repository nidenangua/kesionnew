<template>
  <div class="order">
    <div>
      <div class="affirmord">
        <h1>确认订单</h1>
        <p class="affirmord-msg">收货信息</p>
        <div
          :class="['affirmord-site',index == i ? 'actives' :'']"
          v-for="(item,i) in siteList"
          :key="i"
          v-if="i < 3 || flag"
          @click="changei(i)"
        >
          <div class="shipping">
            <span class="affirmord-site__name">{{item.realname}}(收)</span>
            <span class="affirmord-tel">{{item.telphone}}</span>
            <span class="affirmord-wz">{{item.province}}{{item.city}}</span>
          </div>
          <div class="affirmord-site__del">{{item.province}}{{item.city}}{{item.area}}{{item.street}}</div>
          <div class="affirmord-site__affirmord-site">
            <span @click.stop="showLog('edit',item)">编辑</span>
            <span @click.stop="del(item.id,i)">删除</span>
          </div>
          <div class="default" v-if="item.is_address == 1">默认地址</div>
        </div>
        <!-- 新增收货地址 -->
        <div class="affirmord-site actives" v-if="!siteList.length">
          <div class="newly" @click="showLog('add')">
            <img src="../../assets/mall/address_icon_add.png" alt />
            新增收货地址
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="affirmord-newly">
          <span @click="flag = true" v-if="!flag">显示更多地址</span>
          <span v-else @click="flag = false">收起更多地址</span>
          <span @click="showLog('add')">新增收货地址</span>
        </div>
      </div>
      <div class="ordermsg">
        <p>订单详情</p>
        <div class="ordermsg-title">
          <span class="ordermsg-title__shop">商品</span>
          <span class="ordermsg-title__price">单价</span>
          <span class="ordermsg-title__num">数量</span>
          <span class="ordermsg-title__total">小计</span>
        </div>
        <div class="ordermsg-shop" v-for="(item,i) in delList" :key="i">
          <ul>
            <li class="ordermsg-shop__shop">
              <div>
                <img :src="item.defaultpic" alt class="shopImg" />
              </div>
              <div>
                <p class="ordermsg-shop__shop--title">{{item.title}}</p>
                <p class="ordermsg-shop__shop--value">{{item.json.date}}</p>
              </div>
            </li>
            <li class="ordermsg-shop__price">￥{{item.json.price}}</li>
            <li class="ordermsg-shop__num">{{item.num}}</li>
            <li class="ordermsg-shop__total">￥{{(item.json.price*item.num).toFixed(2)}}</li>
          </ul>
        </div>
        <div class="submit">
          <div class="submit-leave">
            <span>给卖家留言：</span>
            <el-input
              class="eltext"
              type="textarea"
              placeholder="请输入内容"
              v-model="text"
              maxlength="100"
              resize="none"
              show-word-limit
            ></el-input>
          </div>
          <div class="submit-price">
            <div>
              <span class="submit-price__left">会员折扣：</span>
              <span class="submit-price__msg" v-if="discount != 10">{{discount}} 折</span>
              <span class="submit-price__msg" v-else>当前无折扣</span>
            </div>
            <div>
              <span class="submit-price__left">运费：</span>
              <span class="submit-price__msg">￥{{msg.freight}}</span>
            </div>
            <div v-if="discountShow">
              <span class="submit-price__left">
                选择优惠券(可用
                <span class="yhj">{{couponList.length || 0}}</span>张)：
              </span>
              <span class="submit-price__msg">
                <el-select
                  v-model="value"
                  placeholder="请选择优惠券"
                  clearable
                  no-data-text="无可用优惠券"
                  @change="coupon"
                >
                  <el-option
                    v-for="(item,i) in couponList"
                    :key="i.addtime"
                    :label="item.title"
                    :value="item.id"
                  ></el-option>
                </el-select>
              </span>
            </div>
          </div>
        </div>
        <div class="sumibord">
          <div class="sumibord-msg">
            <div>
              实付款：
              <span class="practicalprice">￥{{totalprice}}</span>
            </div>
            <div>
              寄送至：
              <span
                v-if="siteList.length"
              >{{siteList[index].province}}{{siteList[index].city}}{{siteList[index].area}}{{siteList[index].street}}</span>
            </div>
            <div>
              收货人：
              <span
                v-if="siteList.length"
              >{{siteList[index].realname}} {{siteList[index].telphone}}</span>
            </div>
          </div>
          <div class="payment">
            <span class="goback" @click="gotocar()">返回购物车</span>
            <span class="payment-ord" @click="onClickpresent">提交订单</span>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <el-dialog :title="title" :visible.sync="dialogVisible" width="35%" :center="true">
      <span>
        <el-form ref="form" :model="form" label-width="90px">
          <el-form-item label="收货人:">
            <el-input v-model="form.realname"></el-input>
          </el-form-item>
          <el-form-item label="收货人手机:">
            <el-input v-model="form.telphone"></el-input>
          </el-form-item>
          <el-form-item label="地区:" prop="areaid" class="divwrap">
            <v-distpicker
              @selected="onSelected"
              :province="form.province"
              :city="form.city"
              :area="form.area"
            ></v-distpicker>
          </el-form-item>
          <el-form-item label="收货地址:">
            <el-input type="textarea" v-model="form.street"></el-input>
          </el-form-item>
          <el-form-item label>
            <el-checkbox-group v-model="form.type">
              <el-checkbox label="设为默认地址" name="type"></el-checkbox>
            </el-checkbox-group>
          </el-form-item>
        </el-form>
      </span>
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="confirmAdd">保 存</el-button>
      </span>
    </el-dialog>
  </div>
</template>
<script>
import { confirmOrder, addressList, delAddress } from "@/api/mall.js";
import { getOrderNow } from "@/api/course";
import { getUserWealth } from "@/api/user";

import VDistpicker from "v-distpicker";
import { editAddress, showAddress } from "@/api/mall.js";
export default {
  name: "",
  components: { VDistpicker },
  activated() {
    this.getList()
    let params;
    if (this.$route.query.type == 1) {
      params = {
        id: this.$route.query.id,
        type: this.$route.query.type,
        num: this.$route.query.num,
        attr_id:this.$route.query.attr_id
      };
    } else {
      params = {
        cart_id: [this.$route.query.id],
        type: this.$route.query.type,
        num: this.$route.query.num
      };
    }
    confirmOrder(params).then(res => {
      if (params.type == 1) {
        this.delList = [res.data];
        let ids = this.$route.query.id;
        this.msg = res;
        getUserWealth({ type: 14, all_price: res.all_price, id: ids }).then(
          res => {
            res.vipdiscount.length == 0 ? this.discount = 10 : this.discount = parseInt(res.vipdiscount.discount)
            this.couponList = res.list;
            res.vipdiscount.length == 0 ? this.discountShow = 1 : this.discountShow = res.vipdiscount.other
            this.totalprice = (this.msg.all_price * (this.discount / 10)).toFixed(2);
          }
        );
      } else {
        this.delList = res.data;
        this.msg = res;
        getUserWealth({ type: 14, all_price: this.msg.all_price }).then(res => {
          res.vipdiscount.length == 0 ? this.discount = 10 : this.discount = parseInt(res.vipdiscount.discount)
          this.couponList = res.list;
          res.vipdiscount.length == 0 ? this.discountShow = 1 : this.discountShow = res.vipdiscount.other
          this.totalprice = (this.msg.all_price * (this.discount / 10)).toFixed(2);
        });
      }
    });
  },
  data() {
    return {
      /**优惠券是否显示 */
      discountShow:0,
      /**折扣 */
      discount:0,
      /**总价格 */
      totalprice: 0,
      /**优惠券信息 */
      couponList: [],
      /**收货地址 */
      index: 0,
      /**列表数据 */
      msg: [],
      /**订单列表 */
      delList: [],
      /**节流阀 */
      flag: false,
      /**订单详情数据 */
      ordList: [],
      /**收货地址列表 */
      siteList: [],
      value: "",
      text: "",
      dialogVisible: false,
      title: "新增收货地址",
      handleChange: "",
      form: {
        realname: "",
        telphone: "",
        street: "",
        type: false,
        province: "",
        city: "",
        area: "",
        id: ""
      },
      citys: [],
      isreal: false,
      cityName: "",
      areaProps: {
        value: "id",
        label: "city",
        children: "cities"
      }
    };
  },
  methods: {
    getList() {
      addressList().then(res => {
        this.siteList = res.list;
      });
    },
    onSelected(data) {
      this.form.province = data.province.value;
      this.form.city = data.city.value;
      this.form.area = data.area.value;
    },
    /**确定添加*/
    confirmAdd() {
      let params = {
        realname: this.form.realname,
        telphone: this.form.telphone,
        street: this.form.street,
        province: this.form.province,
        city: this.form.city,
        area: this.form.area,
        is_address: this.form.type
      };
      if (this.form.id != "") {
        params.id = this.form.id;
      }
      editAddress(params).then(res => {
        this.getList()
        this.dialogVisible = false;
      });
    },
    showLog(value = "add", item) {
      if (value == "add") {
        this.title = "新增收货地址";
        this.form.realname = "";
        this.form.telphone = "";
        this.form.street = "";
        this.form.province = "";
        this.form.city = "";
        this.form.area = "";
        this.form.id = "";
      } else if ((value = "edit")) {
        this.title = "编辑收货地址";
        this.form.realname = item.realname;
        this.form.telphone = item.telphone;
        this.form.street = item.street;
        this.form.province = item.province;
        this.form.city = item.city;
        this.form.area = item.area;
        this.form.id = item.id;
        if (item.is_address == 0) {
          this.form.type = false;
        } else {
          this.form.type = true;
        }
      }
      this.dialogVisible = true;
    },
    /**删除地址 */
    del(id, index) {
      delAddress({ id }).then(res => {
        if (res.result == "success") {
          this.$message({ message: "删除成功", type: "success" });
          this.siteList.splice(index, 1);
        }
      });
    },
    /**更换地址 */
    changei(index) {
      this.index = index;
    },
    /**返回购物车 */
    gotocar() {
      this.$router.push("/mall/shopcar");
    },
    /**提交订单 */
    onClickpresent() {
      if(this.siteList.length == 0) return this.$message.error("请先添加收货地址")
      let params;
      if (this.$route.query.type == 1) {
        if (this.siteList.length ==0) {
          return this.$message({ message: "请先添加收货地址", type: "error" });
        }
        //直接下单
        params = {
          id: this.$route.query.id, //商品id
          type: "14", //下单类型：14：直接下单；15：购物车下单
          couponid: this.value != -1 ? this.value : "",
          json: {
            mark: this.text, //备注
            // attr_id:2,              //属性id，type等于14才有，选题
            num: this.$route.query.num, //购买数量，type等于14才有，必填
            address_id: this.siteList[this.index].id, //收货地址id
            attr_id:this.$route.query.attr_id,   
          }
        };
      } else {
        //购物车下单
        params = {
          couponid: this.value != -1 ? this.value : "",
          type: "15", //下单类型：14：直接下单；15：购物车下单
          json: {
            mark: this.text, //备注
            address_id: this.siteList[this.index].id, //收货地址id
            cart_id: this.$route.query.id.split(",") //购物车id，type等于15才有，必填
          }
        };
      }
      getOrderNow(params).then(res => {
          this.$pay(res.qrcode, res.ordersn, this.totalprice).then(()=>{
            setTimeout(() => {
              this.$router.push('/user/order')
            }, 3000);
          })
      });
    },
    /**选择优惠券 */
    coupon(e) {
      this.couponList.map(item => {
        if (item.id == e) {
          this.totalprice = (this.msg.all_price * (this.discount / 10)- item.money).toFixed(2);
        }
        if (!e) {
          this.totalprice = (this.msg.all_price * (this.discount / 10)).toFixed(2);
        }
        this.totalprice < 0
          ? (this.totalprice = 0)
          : (this.totalprice = this.totalprice);
      });
    }
  },
  mounted() {}
};
</script>
<style scoped>
.clearfix:after {
  /*伪元素是行内元素 正常浏览器清除浮动方法*/
  content: "";
  display: block;
  height: 0;
  clear: both;
  visibility: hidden;
}
.clearfix {
  *zoom: 1; /*ie6清除浮动的方式 *号只有IE6-IE7执行，其他浏览器不执行*/
}
.order {
  width: 1200px;
  margin: 0 auto;
}
.divwrap >>> .distpicker-address-wrapper select {
  height: 42px;
  font-size: 12px;
}
h1 {
  font-weight: 400;
  margin: 15px 0;
}
.affirmord {
  padding: 10px;
  background-color: #fff;
}
.affirmord-msg {
  font-size: 15px;
}
.affirmord-site {
  height: 122px;
  position: relative;
  float: left;
  width: 365px;
  background: url("../../assets/mall/adderss_bg_n.png") no-repeat;
  padding: 15px 15px 15px 20px;
  box-sizing: border-box;
  margin: 15px;
  margin-left: 0;
}
.affirmord-site__name {
  display: inline-block;
  font-size: 18px;
  font-weight: 500;
  width: 90px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.affirmord-wz {
  display: inline-block;
  width: 100px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.affirmord-tel,
.affirmord-wz,
.affirmord-site__del {
  font-size: 14px;
}
.affirmord-tel {
  /* padding-top: 2px; */
  margin: 0 20px 0 5px;
}
.affirmord-site div {
  margin-top: 10px;
}
.affirmord-site__affirmord-site,
.affirmord-newly {
  font-size: 14px;
  color: #2e84ee;
}
.affirmord-newly span {
  margin-right: 20px;
  cursor: pointer;
}
.affirmord-site__affirmord-site span {
  margin-right: 15px;
  cursor: pointer;
}
.actives {
  background-image: url("../../assets/mall/adderss_bg_s.png");
}
.default {
  position: absolute;
  right: 9px;
  bottom: 6px;
  background-color: #999999;
  color: #fff;
  padding: 4px;
  border-radius: 7px;
}
.newly {
  cursor: pointer;
  width: 100px;
  margin: 0 auto;
  padding-top: 25px;
}
.newly img {
  width: 16px;
  height: 16px;
  vertical-align: text-bottom;
}
.ordermsg {
  margin-top: 15px;
  padding: 15px;
  padding-bottom: 40px;
  background-color: #fff;
}
.ordermsg p {
  font-size: 14px;
}
.ordermsg-title {
  margin: 10px 0;
  background-color: #f4f6fa;
  padding: 10px;
  font-size: 14px;
  color: #929a9e;
}
.ordermsg-title__shop {
  margin: 0 320px 0 160px;
}
.ordermsg-title__price {
  margin-right: 170px;
}
.ordermsg-title__num {
  margin-right: 170px;
}
.ordermsg-shop {
  margin-top: 20px;
  height: 105px;
  border: 1px solid #eeeeee;
  /* line-height: 105px; */
}
.shopImg {
  width: 65px;
  height: 80px;
  vertical-align: middle;
}
.ordermsg-shop__shop {
  display: flex;
  width: 390px;
  margin-left: 20px;
  margin-top: 12px;
}
.ordermsg-shop__shop span {
  font-size: 14px;
  padding: 20px 0 0 20px;
}
.ordermsg-shop li {
  float: left;
}
.ordermsg-shop__price {
  width: 140px;
  text-align: right;
  line-height: 105px;
  font-size: 14px;
}
.ordermsg-shop__num {
  width: 190px;
  text-align: right;
  line-height: 105px;
  font-size: 14px;
}
.ordermsg-shop__total {
  width: 220px;
  text-align: right;
  line-height: 105px;
  font-size: 14px;
}
.submit {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
  padding: 15px 0;
  border-top: 1px dashed #eee;
  border-bottom: 1px dashed #eee;
}
.submit-leave {
  display: flex;
  width: 500px;
}
.el-textarea {
  width: 80%;
  height: 54px;
}
.submit-leave span {
  font-size: 14px;
  color: #929a9e;
  padding-top: 2px;
}
.submit-price {
  text-align: right;
  margin-right: 60px;
  font-size: 14px;
}
.submit-price__msg {
  display: inline-block;
  width: 180px;
}
.submit-price div {
  margin-bottom: 10px;
}
.submit-price__left {
  color: #929a9e;
}
.yhj {
  color: #ef6c69;
}
.sumibord {
  float: right;
  margin-right: 60px;
  margin-top: 30px;
}
.sumibord-msg {
  text-align: right;
  font-size: 14px;
  border: 1px solid #ff6c00;
  padding: 10px;
}
.sumibord-msg div {
  margin-bottom: 10px;
}
.practicalprice {
  font-size: 16px;
  color: #ff6c00;
}
.payment {
  float: right;
  /* margin-top: 17px; */
}
.payment-ord,
.goback {
  display: inline-block;
  width: 100px;
  height: 45px;
  line-height: 45px;
  text-align: center;
}
.payment-ord {
  color: #fff;
  background-color: #ff6c00;
  font-size: 16px;
  cursor: pointer;
}
.goback {
  color: #2e84ee;
  background-color: #fff;
  font-size: 14px;
  cursor: pointer;
}
.shipping {
  display: inline-flex;
  align-items: baseline;
}
.eltext,
.eltext /deep/ textarea {
  height: 100px;
}
.ordermsg-shop__shop--title{
  margin: 15px 15px 8px 15px;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  overflow: hidden;
}
.ordermsg-shop__shop--value{
  padding: 0 15px;
  color: #aaa;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 1;
  overflow: hidden;
}
</style>