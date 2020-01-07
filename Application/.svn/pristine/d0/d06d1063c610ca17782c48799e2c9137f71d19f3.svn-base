<template>
    <div class="page">
        <div class="myOrder-top">
            <h1 class="viptitle">我的订单</h1>
            <div class="myOrder-top__box">
                <div class="myOrder-top__tab">
                    <span :class="{active:paystatus==0}" @click="changeTab(0)">VIP套餐</span>
                    <span :class="{active:paystatus==1}" @click="changeTab(1)">SVIP套餐</span>
                </div>
            </div>
        </div>
        <!-- vip内容 -->
        <div  v-if="msg.list && msg.list.length">
          <div class="vipcon">
            <div class="vipcon-title">
                <span class="vipcon-title__status">当前VIP开通状态：</span>
                <span class="vipcon-title__open" v-if="msg.status == -1">暂未开通</span>
                <span class="vipcon-title__open" v-else-if="msg.status == 1">已开通</span>
                <span class="vipcon-title__open" v-else>已过期</span> 
                <span class="vipcon-title__time" v-if="msg.status == 1">
                  <span>到期时间：</span>
                  <span class="vipcon-title__open">{{msg.expiretime}}</span>
                </span>
            </div>
            <div class="viptype">
                <p class="viptype-title">选择套餐类型：</p>
                <div class="vipList">
                    <div :class="['viptype-list', index == i ? 'vipactive' :'']" v-for="(item,i) in msg.list" :key="i" @click="getvip(i,item)">
                        <div class="viptype-list__msg--time">
                          {{item.time}}
                          <span v-if="item.timetype ==  0">天</span>
                          <span v-else-if="item.timetype ==  1">个月</span>
                          <span v-else >年</span>
                        </div>
                        <div class="viptype-list__msg--price">￥{{item.price}}</div>
                        <div class="viptype-list__msg--total">
                          <a v-if="item.timetype==0">{{(item.price/item.time).toFixed(2)}}元/天</a>
                          <a v-if="item.timetype==1">{{(item.price/item.time).toFixed(2)}}元/月</a>
                          <a v-if="item.timetype==2">{{(item.price/(item.time*12)).toFixed(2)}}元/月</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vip-yhj">
                <span>选择优惠券:</span> 
                <span class="submit-price__msg">
                    <el-select
                      v-model="value"
                      placeholder="请选择优惠券"
                      clearable
                      no-data-text="无可用优惠券"
                      @change="coupon"
                    >
                      <el-option
                        v-for="(item,i) in discountList"
                        :key="i.addtime"
                        :label="item.title"
                        :value="item.id"
                      ></el-option>
                    </el-select>
                  </span>
            </div>
            <div class="vip-pay">
                <span>支付金额:</span> 
                <span class="vip-pay__price">￥{{getprice}}</span>
            </div>
            <div>
                <button class="buynow" @click="buynow">立即购买</button>
            </div>
          </div>
          <!-- vip说明 -->
          <div class="vipexplain">
            <p>会员权益说明：</p>
            <div v-html="content"></div>
          </div>
        </div>
        <ks-empty msg="当前没有会员卡信息" v-else />
    </div>
</template>

<script>
import {vipInfo} from '@/api/user'
import { getUserWealth } from "@/api/user";
import { getOrderNow } from "@/api/course";
export default {
  data() {
    return {
      /** */
      /**当前选中价格 */
      vipprice:'',
      /**选中优惠券价格 */
      yhjprice:'',
      /**选中优惠券ID */
      yhjId:'',
      /**选中vipid */
      vipId:'',
      value:'',
      index:0,
      paystatus: 0,
      content:'',
      msg:{},
      /**优惠券列表 */
      discountList:[]
    };
  },
  methods: {
    /**
     * 选项卡切换回调
     */
    async changeTab(pay) {
      if (pay == 0) {
        this.paystatus = 0;
      } 
      if (pay == 1) {
        this.paystatus = 1;
      }
      this.index = 0
      await this.getmsg()
      if(this.msg.list && this.msg.list.length) {
        this.vipprice = this.msg.list[0].price
        this.vipId = this.msg.list[0].id
      }
    },
    async getmsg() {
      const msg =   await vipInfo({type:this.paystatus})
      this.content = this.paystatus == 0 ?  msg.vip_content : msg.svip_content 
      this.msg = msg
    },
    getvip(i,item) {
      this.vipId = item.id
      this.index = i 
      this.vipprice = item.price;
      this.getDiscount()
    },
    /**获取优惠券 */
    async getDiscount() {
      const msg = await getUserWealth({type:'3',price:this.vipprice})
      this.discountList = msg.list
    },
    coupon(value) {
      this.yhjId = value
      this.discountList.map(item=>{
        if(item.id == value) return this.yhjprice = item.money
      })
      if(!value) return this.yhjprice = 0
    },
    /**购买 */
    async buynow() {
      const res = await getOrderNow({type:'16',id:this.vipId,couponid:this.yhjId})
      console.log(res)
      this.$pay(res.qrcode,res.ordersn,this.getprice).then(()=>{
        /**支付成功 */
        this.$router.go(0)
      })
    }
  },
  computed: {
    /**支付价格 */
    getprice() {
      const price =  this.vipprice -  this.yhjprice >= 0 ? this.vipprice -  this.yhjprice : 0
      return price.toFixed(2)
    }
  },
  async created() {
    document.title = "升级会员";
    if(this.$route.query.type == 1) {
             this.paystatus = '1'
         }
    await this.getmsg()
    if(this.msg.list && this.msg.list.length) {
      this.vipprice = this.msg.list[0].price
      this.vipId = this.msg.list[0].id
    }
    await this.getDiscount()
  },
};
</script>

<style scoped>
.page {
  font-size: 14px;
}
.viptitle {
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
  width: 80px;
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
.myOrder-top {
  width: 100%;
  border-bottom: 1px solid #eee;
}
.vipcon {
  padding: 21px 0px;
  margin: 0 40px;
  border-bottom: 1px solid #eee;
}
.vipcon-title {
  margin-bottom: 20px;
}
.vipcon-title__open {
  color: #ed514d;
}
.viptype-title {
  margin-bottom: 15px;
}
.viptype-list{
    width: 18%;
    margin-right: 2%;
    text-align: center;
    padding: 10px 0;
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 15px;
}
.viptype-list:nth-child(5n) {
    margin-right: 0;
}
.viptype-list__msg--time,
.viptype-list__msg--price {
  margin-bottom: 10px;
}
.viptype-list__msg--price {
  font-size: 20px;
  color: #ff6c00;
  font-weight: 700;
}
.viptype-list__msg--total {
  color: #ff720a;
  /* text-decoration:line-through */
}
.vipList{
    display: flex;
    flex-wrap: wrap;
}
.vipactive{
    border-color: #ff7917;
    background-color:#fff6f0;
}
.vip-yhj{
    margin: 15px 0 30px 0;
}
.vip-yhj__none{
    color: #bbbdbe
}
.vip-pay{
    margin-bottom: 30px;
}
.vip-pay__price{
    font-size: 16px;
    color: #ff6c00;
    font-weight: 700
}
.buynow{
    background-color: #ff6c00;
    padding: 8px 50px;
    text-align: center;
    color: #fff;
    list-style: none;
    border: none;
    outline: none;
    border-radius: 3px;
    cursor: pointer;
}
.vipexplain{
  margin-top: 20px;
  padding: 0 40px;
}
.vipexplain p {
  margin-bottom: 8px; 
}
.vipcon-title__time{
  padding-left: 30px;
}
</style>
