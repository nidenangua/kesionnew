<template>
  <div class="all">
    <div class="com">
      <div class="com-image">
        <div class="block">
          <el-carousel
            trigger="click"
            height="150px"
            :autoplay="false"
            :initial-index="index"
            ref="carousel"
          >
            <el-carousel-item v-for="(item,i) in img" :key="i">
              <!-- <img :src="item.img" alt /> -->
              <div class="pic-box" style="width: 260px;height: 280px;">
                <!--pic-box:width:500px;height:500px-->
                <pic-zoom :url="item.img" :scale="2"></pic-zoom>
              </div>
            </el-carousel-item>
          </el-carousel>
        </div>
        <div class="clearfix"></div>
        <div class="cutImg">
          <div
          :class="['com-image__all--small', index == i ? 'active_is' :'']"
          v-for="(item,i) in img"
          :key="i"
          @click="cutimg(i)"
        >
          <img :src="item.img" alt="">
        </div>
        </div>
      </div>
      <!-- 商品详情内容 -->
      <div class="com-content">
        <div class="com-content__title">{{msg.title}}</div>
        <div class="com-content__introd">{{msg.shortdesc}}</div>
        <div class="com-content__msg">
          <div class="com-content__deliver">
            <!-- 发货：&nbsp;&nbsp;&nbsp;福建厦门&nbsp;&nbsp;&nbsp; -->
            <span class="com-content__deliver--price">快递费：</span> ￥{{freight}}
          </div>
          <div class="com-content__serve">
            <span class="com-content__deliver--price">服务：</span>
            <span v-for="(item,i) in service" :key="i">{{item.name}}</span>
          </div>
        </div>
        <div class="mallpar" v-if="sell == 2">
          <div class="mallcate" v-for="(item,index) in specteam.standdata" :key="index">
          <div class="mallcate-cate">
            {{item.title}}
          </div>
          <div class="mallcate-value">
            <span :class="['mallcate-value__erver',specteam.standdata[index].activeIndex == i ?'mall_active' : '']" v-for="(_item,i) in item.attrs" :key="i" @click="getspecteamIndex(index,i)">{{_item.attr}}</span>
          </div>
        </div>
        </div>
        <div class="com-content__price">
          价格：&nbsp;&nbsp;&nbsp;
          <span class="price">￥{{price.price}}</span>
          <del class="delprice">原价：{{(price.uprice * 1).toFixed(2)}}</del>
        </div>
        <div class="shopnum">
          <img
            class="pop-versions__left"
            src="../../assets/mall/common_btn_minus.png"
            @click="reducenum()"
          >
          <input type="number" v-model="num" @input="totalmsg()" class="shopnumInput">
          <img
            class="pop-versions__right"
            src="../../assets/mall/common_btn_add.png"
            @click="addnum()"
          >
          <span class="inventory">( 库存{{stock}}件 )</span>
        </div>
        <div class="com-content__buy">
          <button class="com-content__buy--go" @click="gotoord">立即购买</button>
          <button class="com-content__buy--car" @click="joincar" :disabled="flag">加入购物车</button>
        </div>
        <div class="com-content__footer">
          <span class="com-content__footer--buynum">{{msg.studentcount}}人购买</span>
          <!-- <span class="com-content__footer--buyewm">
                        <img src="../../assets/mall/item_icon_qrcode.png" alt="">
          手机扫码购买</span>-->
          <el-popover placement="bottom-start" width="200" trigger="hover">
            <img width="200px" :src="msg.qrcode">
            <span slot="reference">
              <img src="../../assets/mall/item_icon_qrcode.png">&nbsp; 手机扫码购买
            </span>
          </el-popover>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="shop">
      <div class="shop-del">
        <div class="shop-del__title">
          <span class="active-sx">商品详情</span>
        </div>
        <div class="shop-del__property">
          <div class="shop-del__property--title">商品属性</div>
          <div class="shop-del__property--con">
            <span v-for="(item,i) in attr" :key="i" class="attr">{{item.name}}：{{item.content}}</span>
          </div>
        </div>
        <div v-html="msg.content" class="content">{{msg.content}}</div>
      </div>
      <div class="shop-recom">
        <div class="shop-recom__title">推荐商品
          <div
            class="shop-recom__title--recom"
            v-for="(item,i) in recomlist"
            :key="i"
            @click="open(item.courseid)"
          >
            <div class="tj_img">
              <img :src="item.defaultpic" alt="">
            </div>
            <div class="tj_title">
              <span>{{item.title}}</span>
              <div class="buypeople">{{item.studentcount}}人购买</div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <ul class="share">
      <li>
        <img src="../../assets/mall/shop_btn_order.png" @click="gotoorder()">我的订单
      </li>
      <li class="goshop" @click="gotoshop">
        <img src="../../assets/mall/shop_btn_shopcart.png">
        <span class="goshop-num">{{shopnum}}</span>
        购物车
      </li>
      <li>
        <img src="../../assets/mall/shop_btn_up.png" @click="backTop">返回顶部
      </li>
    </ul>
  </div>
</template>

<script>
import PicZoom from "vue-piczoom";
import { courseDetail, addCart, mallList } from "@/api/mall.js";
export default {
  activated() {
    this.num = 1
  },
  components: { PicZoom },
  data() {
    return {
      /**价格 */
      price:0,
      /**图片索引 */
      index: 0,
      /**购买数量 */
      num: 1,
      /**详情数据 */
      msg: "",
      /**服务 */
      service: [],
      /**快递费 */
      freight: 0,
      /**图片 */
      img: [],
      /**属性 */
      attr: [],
      /**推荐商品数据 */
      recomlist: [],
      flag: false,
      /**购物车数量 */
      shopnum: 0,
      /**库存 */
      stock:'',
      specteam:{},
      sell:'',
      info:[],
      attr_id:''
    };
  },
  methods: {
    /**选择规格组 */
    getspecteamIndex(index,i) {
      // this.$set(this.specteam.standdata[index], 'activeIndex', i)
      if(index == undefined || i == undefined){
        index = 0
        i = 0
      }
      let standdata = this.specteam.standdata
      standdata[index].activeIndex = i
      console.log(standdata,i)
      this.handlerSelectedAttr()
    },
    handlerSelectedAttr(){
      let standdata = this.specteam.standdata
      let currSelected = []
      standdata.map(item=>{
        currSelected.push(item.attrs[item.activeIndex].attr)
      })
      // console.log(currSelected)
      let msg = {}
      this.info.map(item=>{
        if(currSelected.toString() === item.attr.toString()) return msg = item
      })
      console.log(msg)
      let {price,uprice,stock,attr_id,number} = msg
      this.price.price = price
      this.price.uprice = uprice
      this.stock = stock
      this.attr_id = attr_id
    },
    open(id) {
      this.$router.push(`commodity?id=${id}`);
    },
    getlist() {
      let id = this.$route.query.id;
      courseDetail({ id }).then(res => {
        this.msg = res.courseinfo;
        this.price = res.courseinfo.json.goods.specteam;
        this.service = res.courseinfo.json.service;
        this.freight = res.courseinfo.json.goods.specteam.freight;
        this.img = res.courseinfo.json.details_img;
        this.attr = res.courseinfo.json.attribute;
        this.shopnum = res.courseinfo.cart_num;
        
        this.stock = res.courseinfo.json.goods.specteam.stock;
        this.sell = res.courseinfo.json.goods.sell;
        this.specteam = res.courseinfo.json.goods.specteam
        this.info = res.courseinfo.json.goods.specteam.info
        if(this.sell == 2) {
        this.specteam.standdata = res.courseinfo.json.goods.specteam.standdata
        this.specteam.standdata.map((item,i)=>{
          this.$set(item,'activeIndex',0)
        })
        this.getspecteamIndex()
      }
        console.log(this.info)
      });
    },
    reducenum() {
      if (this.num == 1) {
        return;
      } else {
        this.num--;
      }
    },
    addnum() {
      let nums = this.msg.json.goods.specteam.stock;
      if (this.num >= nums) {
        return this.$message({ message: "该商品不能购买更多", type: "error" });
      } else {
        this.num++;
      }
    },
    totalmsg() {
      if (this.num <= 1) {
        this.num = 1;
      }
      if (this.num >= this.msg.json.goods.specteam.stock) {
        this.num = this.msg.json.goods.specteam.stock;
      }
    },
    /**获取推荐商品信息 */
    getmsg() {
      mallList({ p: 1, maxperpage: 5, rank: 2 }).then(res => {
        this.recomlist = res.list;
      });
    },
    /**加入购物车 */
    joincar() {
      let params = {
        num: this.num,
        goodsid: this.msg.courseid,
        attributeid: 0,
        type: 2,
        attributeid:this.attr_id
      };
      addCart(params).then(res => {
        if (res.result == "success") {
          this.shopnum = res.cart_num;
          this.$message({ message: "加入购物车成功", type: "success" });
          this.flag = true;
          setTimeout(() => {
            this.flag = false;
          }, 3000);
        }
      });
    },
    /**进入购物车页面 */
    gotoshop() {
      this.$router.push("/mall/shopcar");
    },
    /**进入订单页面 */
    gotoorder() {
      this.$router.push("/user/order");
    },
    /**页面滚到顶部 */
    backTop() {
      const that = this;
      let timer = setTimeout(() => {
        let ispeed = Math.floor(-that.scrollTop / 5);
        document.documentElement.scrollTop = document.body.scrollTop =
          that.scrollTop + ispeed;
        if (that.scrollTop === 0) {
          clearInterval(timer);
        }
      }, 16);
    },
    gotoord() {
      if (this.msg.json.goods.specteam.stock < this.num) {
        return this.$message({
          message: "该商品不能购买再多了",
          type: "error"
        });
      }
      let id = this.$route.query.id;
      let num = this.num;
      this.$router.push(`/mall/confirm?id=${id}&num=${num}&type=1&attr_id=${this.attr_id}`);
    },
    /**切换图片 */
    cutimg(index) {
      this.index = index;
      this.$refs.carousel.setActiveItem(index);
    }
  },
  created() {
    this.getlist();
    this.getmsg();
  },
  mounted() {
    window.addEventListener("scroll", this.scrollToTop);
  },
  destroyed() {
    window.removeEventListener("scroll", this.scrollToTop);
  },
  watch: {
    $route: {
      handler() {
        if (this.$route.query.id && this.$route.name == "malldel") {
          this.getlist();
        }
      }
    }
  }
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
.all {
  width: 1200px;
  margin: 0 auto;
}
.com {
  padding: 30px 10px;
  margin: 40px 0;
  background-color: #fff;
}
.com-image {
  text-align: center;
  width: 350px;
  float: left;
}
.com-content {
  margin-left: 340px;
  width: 840px;
}
.com-image__big {
  width: 260px;
  height: 280px;
}
.com-image__all {
  padding: 0 15px;
  margin-top: 5px;
}
.com-image__all--small {
  border: 2px solid transparent;
  cursor: pointer;
  float: left;
  width: 18%;
  height: 50px;
  box-sizing: inherit;
}
.active_is {
  border: 2px solid #0081bd;
}
.com-image__all--small img {
  width: 55px;
  height: 100%;
}
.com-content__title {
  height: 42px;
  font-size: 16px;
  letter-spacing: 1px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  overflow: hidden;
  text-overflow: ellipsis;
  -webkit-box-orient: vertical;
}
.com-content__introd {
  font-size: 14px;
  margin: 10px 0;
  letter-spacing: 0.5px;
  height: 38px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  overflow: hidden;
  text-overflow: ellipsis;
  -webkit-box-orient: vertical;
}
.com-content__msg {
  font-size: 14px;
  padding: 15px 0;
  border-top: 1px solid #f2f2f2;
  border-bottom: 1px solid #f2f2f2;
}
.com-content__deliver {
  margin-bottom: 10px;
}
.com-content__price {
  padding: 15px 0;
}
.price {
  font-size: 16px;
  color: #e64b3c;
}
.shopnum {
  margin: 10px 0;
  position: relative;
}
.shopnum img {
  position: absolute;
  top: 3px;
}
.shopnumInput {
  border: 1px solid #f2f2f2;
  padding-left: 3px;
  text-align: center;
  width: 80px;
  height: 30px;
  margin: 0 10px 0 30px;
}
.com-content__buy {
  padding: 20px 10px;
}
.com-content__buy--go {
  cursor: pointer;
  font-size: 14px;
  padding: 10px 18px;
  color: #fff;
  background-color: #ff6c00;
  border-radius: 20px;
  margin-right: 20px;
}
.com-content__buy--car {
  cursor: pointer;
  font-size: 14px;
  padding: 10px 18px;
  color: black;
  background-color: #fff;
  border-radius: 20px;
  border: 1px solid #f2f2f2;
}
.com-content__footer {
  float: right;
  color: #aaa;
  font-size: 14px;
}
.com-content__footer--buynum {
  margin-right: 20px;
}
.com-content__footer--buyewm img {
  width: 12px;
  height: 12px;
}
.shop-del {
  width: 870px;
  float: left;
  background-color: #fff;
  padding-bottom: 20px;
  box-sizing: border-box;
}
.shop-recom {
  width: 300px;
  float: right;
  background-color: #fff;
}
.shop-recom {
  padding: 10px 10px 0 10px;
  box-sizing: border-box;
}
.shop-del__title {
  font-size: 14px;
  padding: 15px;
  border-bottom: 1px solid #eee;
}
.shop-del__title span {
  padding-bottom: 14px;
}
.active-sx {
  color: #2e84ee;
  font-size: 15px;
  border-bottom: 2px solid #2e84ee;
}
.shop-del__property {
  padding: 15px 0;
  margin: 0 30px;
  border-bottom: 1px dashed #eee;
}
.shop-del__property--con span {
  display: inline-block;
  width: 33%;
  margin-bottom: 10px;
}
.shop-del__property--title {
  font-size: 15px;
  color: #929a9e;
  margin-bottom: 15px;
}
.shop-recom__title {
  font-size: 15px;
  font-weight: 500;
}
.shop-recom__title--recom {
  /* display: flex;
    justify-content: space-between; */
  padding-top: 11px;
}
.shop-recom__title--recom span {
  display: block;
  height: 57px;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  margin-bottom: 2px;
  letter-spacing: 0.5px;
}
.shop-recom__title--recom img {
  width: 60px;
  height: 75px;
  margin: 10px;
  margin-top: 0;
}
.buypeople {
  font-size: 14px;
  color: #aaa;
}
.attr {
  font-size: 14px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.content {
  padding: 0 30px;
}
.share {
  position: fixed;
  text-align: center;
  top: 40%;
  right: 14%;
  box-shadow: 0px 2px 6px 0px rgba(0, 67, 184, 0.1);
  background-color: #fff;
}
.share li {
  width: 60px;
  height: 60px;
  box-shadow: 0px 2px 2px 0px rgba(0, 67, 184, 0.1);
}
.share li img {
  padding: 8px 17px 5px;
}
.shopnum img {
  cursor: pointer;
}
.tj_img {
  float: left;
}
button {
  border: none;
  outline: none;
}
.goshop {
  position: relative;
}
.goshop-num {
  position: absolute;
  top: 2px;
  right: 4px;
  background-color: #ec4a46;
  padding: 2px 5px;
  border-radius: 8px;
  color: #fff;
  text-align: center;
}
.share li {
  cursor: pointer;
}
.el-carousel {
  width: 250px;
  height: 280px;
  float: left;
  margin-left: 25px;
}
.el-carousel /deep/ li,
.el-carousel /deep/ .el-carousel__container  button {
  display: none;
}
.el-carousel /deep/ .el-carousel__container {
  height: 280px !important;
}
.el-carousel img {
  width: 100%;
  height: 100%;
}
.magnifier-box {
  cursor: pointer;
}
.mouse-cover {
  display: none !important;
}
.magnifier-box{
  position: relative;
}
.magnifier-box /deep/ img{
  height: 100%;
}
.cutImg{
  margin-top: 5px;
}
.delprice{
  color:#aaa;
  margin-left:10px;
}
</style>
<style>
.mouse-cover-canvas {
  left: 34% !important;
  top: 250px !important;
  width: 250px;
  height: 250px;
  background-color: #ccc;
  display: block;
}
.inventory{
  padding-left:30px;
}
.mallpar{
  padding: 15px 0;
  border-bottom: 1px solid #f2f2f2;
}
.mallcate{
  display:flex;
  font-size:14px;
  padding:8px 0;
}
.mallcate-cate{
  width: 60px;
}
.com-content__deliver--price{
  display: inline-block;
  width: 60px;
}

.mallcate-value__erver{
  padding:5px;
  border:1px solid #dcdcdc;
  margin-right:10px;
  cursor: pointer;
}
.mall_active{
  border:2px solid #ff6c00
}
</style>

