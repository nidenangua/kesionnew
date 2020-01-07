<template>
  <!-- 商品详情 -->
  <div>
    <div>
      <!--轮播图-->
      <!-- <kd-carousel
                :data-list="bannerList"
                :data-ratio="0.56"
      />-->
      <ks-swiper :options="swiperOption" :style="{height:swiperHeight+'px'}">
        <ks-swiper-slide v-for="(item,index) in dataList" :key="index">
          <ks-create-bg style="height:100%;" :src="item.img"  @click="$preview(imglist,index)" />
        </ks-swiper-slide>
        <div class="swiper-pagination" slot="pagination"></div>
      </ks-swiper>
    </div>
    <div class="comd">
      <div class="comd-title">{{title}}</div>
      <div class="comd-sales">
        <span class="comd-sales__price">￥{{min_price}}<a v-if="max_price">~{{max_price}}</a></span>
        <s>￥{{uprice}}</s>
        <span class="ks-fr">已售{{studentcount}}件</span>
      </div>
    </div>
    <div class="cell">
      <div class="ks-cell ks-cell--clickable">
        <div class="ks-cell__title">
          <span class="ks-cell--left">发货</span>
          <span class="ks-cell--center">快递费：￥{{freight}}</span>
        </div>
      </div>
      <div @click="serve" class="ks-cell ks-cell--clickable">
        <div class="ks-cell__title">
          <span class="ks-cell--left">服务</span>
          <span class="ks-cell--center">
            <span v-for="(item,id) in service" :key="id">{{item.name}}<a v-if="service.length-1 != id"> · </a></span>
          </span>
        </div>
        <i class="ks-icon ks-icon-chevron-right-outline"></i>
      </div>
      <div @click="property" class="ks-cell ks-cell--clickable">
        <div class="ks-cell__title">
          <span class="ks-cell--left">属性</span>
          <span class="ks-cell--center">
            <span v-for="(item,id) in attribute" :key="id">{{item.name}} </span>
          </span>
        </div>
        <i class="ks-icon ks-icon-chevron-right-outline"></i>
      </div>
    </div>
    <div class="comdinfo">
      <div class="comdinfo-title">商品详情</div>
      <p v-html="content" class="content">{{content}}</p>
    </div>
    <!-- 底部弹框 -->
    <div v-if="popbottom">
      <div @click="bouncedoff" class="popcontainer"></div>
      <div style="position:relative;">
        <div class="popbox">
          <img @click="bouncedoff" class="popimg" src="../../assets/mall/common_ctn_close_g.png" />
          <div class="ks-row">
            <ks-image
              v-for="(item,index) in dataList"
              :key="index"
              v-if="index < 1"
              class="ks-col-8 pop"
              :src="item.img"
            />
            <div class="ks-col-16 pop-repertory">
              <div class="pop-price">
                ￥{{price}}
                <s>￥{{uprice}}</s>
              </div>
              <div>库存{{stock}}件</div>
              <div class="pop-choice">
                已选：
                <a class="pop-edition">{{title}}</a>
              </div>
            </div>
          </div>
          <!-- <div class="pop-versions"  v-for="(item,id) in group" :key="id">
                        <div>{{item.name}}</div>
                        <div class="pop-versions__elect">
                            <a class="pop-ver" :class="idx==index?'hover':''" v-for="(items,idx) in item.attr" :key="idx" @click="son(items,idx)">{{items}}</a>
                        </div>
          </div>-->
          <div class="mallmore" v-for="(item,index) in specteam.standdata" :key="index" v-if="sell == 2">
            <p>{{item.title}}</p>
            <div class="mallmore_value">
              <div v-for="(_item,i) in item.attrs" :key="i" @click="getspecteamIndex(index,i)" :class="['mallmore_value--ervey',specteam.standdata[index].activeIndex == i ? 'mall-active' :'']">
                <span>{{_item.attr}}</span>
              </div>
              <!-- <div class="mallmore_value--ervey mall-active">
                平装本
              </div> -->
            </div>
          </div>
          <div class="ks-line"></div>
          <div class="pop-versions">
            <div class="ks-fl">购买数量</div>
            <div class="ks-fr pop-versions__poa">
              <img
                @click="prepnumber"
                class="pop-versions__left"
                src="../../assets/mall/common_btn_minus.png"
              />
              <input type="number" v-model="number" />
              <img
                @click="addnumber"
                class="pop-versions__right"
                src="../../assets/mall/common_btn_add.png"
              />
            </div>
          </div>
          <ks-button @click="buyaffirm" class="ks-mt15" width="100%" type="primary">确定</ks-button>
        </div>
      </div>
    </div>
    <div v-if="popserve">
      <div @click="bouncedoff" class="popcontainer"></div>
      <div style="position:relative;">
        <div class="popbox">
          <div style="textAlign: center;fontSize: 18px;lineHeight: 34px;">服务说明</div>
          <div class="popbox-info">
            <div class="popbox-serve" v-for="(item,id) in service" :key="id">
              <img src="../../assets/mall/shop_icon_description.png" />
              <span>{{item.name}}</span>
            </div>
          </div>
          <ks-button @click="bouncedoff" class="ks-mt15" width="100%" type="primary">确定</ks-button>
        </div>
      </div>
    </div>
    <div v-if="propop">
      <div @click="bouncedoff" class="popcontainer"></div>
      <div style="position:relative;">
        <div class="popbox">
          <div style="textAlign: center;fontSize: 18px;lineHeight: 34px;">属性</div>
          <ul>
            <li v-for="(item,id) in attribute" :key="id" class="ks-row">
              <span class="ks-col-6">{{item.name}}</span>
              <span class="ks-col-18 popbox-right">{{item.content}}</span>
              <div class="ks-line"></div>
            </li>
          </ul>
          <ks-button @click="bouncedoff" class="ks-mt15" width="100%" type="primary">确定</ks-button>
        </div>
      </div>
    </div>
    <store-footer />
    <div style="height:50px;"></div>
    <div class="ks-goods-action">
      <div role="button" tabindex="0" class="ks-goods-action-icon">
        <div class="ks-icon ks-icon-share-outline" @click="share"></div>分享
      </div>
      <div @click="car" role="button" tabindex="0" class="ks-goods-action-icon">
        <div class="ks-icon ks-icon-shopping-cart-outline">
          <div class="ks-info" v-if="cart_num != 0">{{cart_num}}</div>
        </div>购物车
      </div>
        <div @click="shoppingcart" class="shoppingcart">加入购物车</div>
        <div @click="buynow" class="buynowclass">立即购买</div>
    </div>
  </div>
</template>
<script>
import { courseDetail, addCart } from "@/api/mall.js";
export default {
  name: "Commodity",
  data() {
    return {
      is_buy:0,
      /**属性ID */
      attr_id:'',
      /**价格组数据 */
      specteam:{
        standdata:[]
      },
      info:[],
      index: 0,
      visible: true,
      dataList: [],
      title: "", //商品名称
      price: "", //价格
      uprice: "", //划线价格
      min_price: "", 
      max_price: "", 
      freight: "", //运费
      number: "1", //购买数量
      popbottom: false, //底部弹框
      propop: false,
      popserve: false,
      studentcount: "",
      stock: "", //商品库存
      content: "",
      cart_num: "", //购物车数量
      sell: "", //组别
      group: {}, //版本信息
      service: [], //服务信息
      attribute: [], //属性
      imglist:[],
      //  商品相册
      swiperHeight: document.body.offsetWidth * parseFloat(0.56),
      swiperOption: {
        pagination: {
          el: ".swiper-pagination",
          type: "custom",
          renderCustom: function(swiper, current, total) {
            return current + " / " + total;
          }
        }
      }
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
      console.log(this.specteam.standdata)
      let currSelected = []
      standdata.map(item=>{
        currSelected.push(item.attrs[item.activeIndex].attr)
      })
      // console.log(currSelected)
      let msg = {}
      this.info.map(item=>{
        if(currSelected.toString() === item.attr.toString()) return msg = item
      })
      let {price,uprice,stock,attr_id,number} = msg
      this.price = price
      this.uprice = uprice
      this.stock = stock
      this.attr_id = attr_id
    },
    share() {
      this.$showShareBg();
    },
    // 点击购买，如果为多选项组2 则弹出
    // 如果为固定值则直接购买
    buynow() {
      this.is_buy = 1
      this.popbottom = true;
    },
    serve() {
      this.popserve = true;
    },
    property() {
      this.propop = true;
    },
    //弹框关闭
    bouncedoff() {
      this.popbottom = false;
      this.propop = false;
      this.popserve = false;
    },
    //弹框选中样式处理
    son(items, idx) {
      this.index = idx;
    },
    //加入购物车
    shoppingcart() {
      if(this.sell == 1) {
        let goodsid = this.$route.query.id; //商品ID
        let num = this.number; //商品数
        let attributeid = 0; //商品属性（有必传，没有传0）
        let type = 2;
        addCart({ goodsid, num, attributeid, type }).then(res => {
          this.cart_num = res.cart_num;
          this.$toast("添加成功","success")
        });
      }else{
        this.popbottom = true;
        this.is_buy = 0
      }
    },
    //添加数量
    addnumber() {
      this.number++;
      if (this.number > this.stock) {
        this.number = this.stock;
      }
    },
    prepnumber() {
      if (this.number > 1) {
        this.number--;
      }
    },
    //点击进入购物车
    car() {
      this.$router.push("/cart");
    },
    //确认购买
    buyaffirm() {
      if(this.is_buy) {
          if (this.stock <= 0) {
          this.$confirm("库存不足").then(() => {});
        } else {
          if (this.number < 1) {
            this.number = 1;
          } else if (this.number > this.stock) {
            this.number = this.stock;
          }
          let params = {
            id: this.$route.query.id,
            num: this.number,
            type: 1,
            attr_id:this.attr_id
          };
          this.$router.push({
            path: "/shop/confirm",
            query: params
          });
        }
      }else{
        let goodsid = this.$route.query.id; //商品ID
        let num = this.number; //商品数
        let attributeid = this.attr_id || 0; //商品属性（有必传，没有传0）
        let type = 2;
        addCart({ goodsid, num, attributeid, type}).then(res => {
          this.cart_num = res.cart_num;
          this.$toast("添加成功","success")
        });
      }
    },
  },
  mounted() {
   
    // this.$nextTick(document.querySelector(".img_wrapper").style = "")
  },
  activated() {
     let id = this.$route.query.id; //获取地址里的id传入
      courseDetail({ id }).then(res => {
      this.dataList = res.courseinfo.json.details_img;
      let imgmsg = []
      this.dataList.map(item=>{
        imgmsg.push({src:item.img})
      })
      this.imglist = imgmsg
      this.title = res.courseinfo.title;
      // this.price = Math.max(res.courseinfo.price,res.courseinfo.price);
      let {
        price,
        uprice,
        group,
        stock,
        info,
        freight
      } = res.courseinfo.json.goods.specteam
      this.price = price
      this.uprice = uprice
      this.group = group
      this.stock = stock
      this.freight = freight
      this.info = info

      this.min_price = res.courseinfo.price
      this.max_price = res.courseinfo.max_price
      this.studentcount = res.courseinfo.studentcount;
      this.content = res.courseinfo.content;
      this.cart_num = res.courseinfo.cart_num;
      this.sell = res.courseinfo.json.goods.sell;
      console.log(this.sell)
      this.service = res.courseinfo.json.service;
      this.attribute = res.courseinfo.json.attribute;

      console.log(res.courseinfo.json.goods.specteam.standdata)
      if(this.sell == 2) {
        // res.courseinfo.json.goods.specteam.standdata.map((item,index)=>{
        //   if(!item.content) {
        //     res.courseinfo.json.goods.specteam.standdata.splice(index,1)
        //   }
        //   item.attrs.map((_item,i) =>{
        //     if(_item.json === undefined){
        //       item.attrs.splice(i,1)
        //     }
        //   })
        // })
        this.specteam.standdata = res.courseinfo.json.goods.specteam.standdata
        this.specteam.standdata.map((item,i)=>{
          this.$set(item,'activeIndex',0)
          // this.$set(this.spec.sta[i],'activeIndex',0)
        })
        this.getspecteamIndex()
      }
      /**配置微信分享 */
      this.$wxShare({
        title: res.courseinfo.title,
        desc: res.courseinfo.shortdesc,
        imgUrl: res.courseinfo.defaultpic
      });
    });
    
  },
  watch: {
    $route(to, from) {
      this.$router.go(0);
    }
  }
};
</script>
<style scoped>
.comd,
.comdinfo {
  background-color: #fff;
  padding: 10px;
  overflow: hidden;
}
.comd-picture {
  height: 376px;
  background-color: antiquewhite;
}
.comd-title {
  font-size: 16px;
  font-weight: initial;
  line-height: 26px;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2; /* 设置行数 */
  -webkit-box-orient: vertical;
}
.comd-sales {
  margin-top: 5px;
  font-size: 14px;
  color: #999;
}
.comd-sales s {
  font-size: 12px;
}
.comd-sales__price {
  color: #e64340;
  font-size: 16px;
  margin-right: 5px;
}
.cell,
.comdinfo {
  margin-top: 10px;
}
/* 商品详情 */
.comdinfo-title {
  font-size: 16px;
  font-weight: 600;
}
.comdinfo p {
  font-size: 16px;
  color: #999;
  margin: 10px 0;
  text-align: justify;
  text-justify: inter-character;
}
/* 弹框 */
.ks-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
}
.ks-popup--bottom.ks-popup--round {
  border-radius: 20px 20px 0 0;
}
.ks-action-sheet {
  max-height: 90%;
  color: #323233;
}

.ks-popup--safe-area-inset-bottom {
  padding-bottom: constant(safe-area-inset-bottom);
  padding-bottom: env(safe-area-inset-bottom);
}
.ks-popup--bottom {
  bottom: 0;
  left: 0;
  width: 100%;
}
.ks-popup {
  position: fixed;
  max-height: 100%;
  overflow-y: auto;
  background-color: #fff;
  -webkit-transition: -webkit-transform 0.3s ease-out;
  transition: -webkit-transform 0.3s ease-out;
  transition: transform 0.3s ease-out;
  transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
  -webkit-overflow-scrolling: touch;
}
.ks-action-sheet__header {
  font-weight: 500;
  font-size: 16px;
  line-height: 44px;
  text-align: center;
}
.ks-action-sheet {
  max-height: 90%;
  color: #323233;
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
  color: #323233;
  font-size: 14px;
  line-height: 24px;
  background-color: #fff;
  margin-bottom: 5px;
}
.ks-cell--left {
  color: #969799;
  margin-right: 10px;
}
.ks-cell--center {
  color: #333;
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
.ks-icon-chevron-right-outline {
  margin-left: 5px;
  color: #969799;
}
.ks-cell:not(:last-child)::after {
  position: absolute;
  box-sizing: border-box;
  content: " ";
  pointer-events: none;
  right: 0;
  bottom: 0;
  left: 16px;
  border-bottom: 1px solid #ebedf0;
  -webkit-transform: scaleY(0.5);
  transform: scaleY(0.5);
}
.demo-goods-action .ks-goods-action {
  position: relative;
}
.ks-goods-action {
  position: fixed;
  right: 0;
  bottom: 0;
  left: 0;
  display: -webkit-box;
  display: -webkit-flex;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  align-items: center;
  background-color: #fff;
}
.ks-goods-action-icon {
  display: -webkit-box;
  display: -webkit-flex;
  display: flex;
  width: 15%;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
  flex-direction: column;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
  justify-content: center;
  min-width: 48px;
  height: 50px;
  color: #7d7e80;
  font-size: 10px;
  line-height: 1;
  text-align: center;
  background-color: #fff;
  z-index: 10;
  outline: none;
}
.ks-goods-action-icon__icon {
  width: 1em;
  margin: 0 auto 5px;
  color: #323233;
  font-size: 18px;
}
.ks-goods-action-button--warning {
  background: -webkit-linear-gradient(left, #ffd01e, #ff8917);
  background: linear-gradient(to right, #ffd01e, #ff8917);
}
.ks-goods-action-button--first {
  margin-left: 20px;
  border-top-left-radius: 20px;
  border-bottom-left-radius: 20px;
}
.ks-info {
  position: absolute;
  top: 5px;
  right: 5px;
  box-sizing: border-box;
  min-width: 16px;
  padding: 0 3px;
  color: #fff;
  font-weight: 500;
  font-size: 12px;
  font-family: PingFang SC, Helvetica Neue, Arial, sans-serif;
  line-height: 14px;
  text-align: center;
  background-color: #ee0a24;
  border: 1px solid #fff;
  border-radius: 16px;
  -webkit-transform: translate(50%, -50%);
  transform: translate(50%, -50%);
  -webkit-transform-origin: 100%;
  transform-origin: 100%;
  z-index: 10;
}
/* .ks-button::before {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 100%;
  height: 100%;
  background-color: #000;
  border: inherit;
  border-color: #000;
  border-radius: inherit;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  opacity: 0;
  content: " ";
} */
.ks-goods-action-button--last {
  margin-right: 5px;
  border-top-right-radius: 18px;
  border-bottom-right-radius: 18px;
}
.ks-goods-action-button {
  -webkit-box-flex: 1;
  -webkit-flex: 1;
  flex: 1;
  height: 40px;
  font-weight: 500;
  font-size: 14px;
  line-height: normal;
  border: none;
}
/*底部按钮*/
.shoppingcart {
  background: -webkit-linear-gradient(left, #ffd01e, #ff8917);
  background: linear-gradient(to right, #ffd01e, #ff8917);
  font-size: 13px;
  color: #fff;
  padding: 8px 4%;
  border-radius: 20px 0 0 20px;
  margin-left: 10px;
  position: fixed;
  width: 22%;
  right: 35%;
  text-align: center;
}
.buynowclass {
  background: -webkit-linear-gradient(left, #ff6034, #ee0a24);
  background: linear-gradient(to right, #ff6034, #ee0a24);
  font-size: 13px;
  color: #fff;
  padding: 8px 4%;
  width: 22%;
  border-radius: 0 20px 20px 0;
  text-align: center;
  margin-right: 5%;
}
/* 弹窗 */
.pop {
  border: 1px solid #999;
  display: flex;
  object-fit: scale-down;
  height: 105px;
}
.pop-price {
  font-size: 16px;
  color: #e64a3b;
}
.pop-price s {
  font-size: 15px;
  color: #999;
}
.pop-repertory {
  font-size: 16px;
  color: #999;
  line-height: 22px;
  margin-top: 40px;
  padding-left: 10px;
}
.pop-edition {
  color: #666;
}
.pop-choice {
  overflow: hidden;
  text-overflow: ellipsis;
  -o-text-overflow: ellipsis;
  white-space: nowrap;
  margin-bottom: 10px;
}
.pop-versions {
  margin-top: 10px;
  font-size: 16px;
  z-index: 20;
  position: relative;
  clear: both;
  overflow: hidden;
  margin-bottom: 20px;
}
.pop-ver {
  background-color: #fff;
  color: #666;
  padding: 6px 10px;
  border-radius: 3px;
  border: 1px solid #e0e0e0;
  margin-right: 10px;
  z-index: 21;
}
/* 点击改变样式 */
.pop-ver.hover {
  background-color: #ffedeb;
  color: #d86459;
  border: 1px solid #d86459;
  z-index: 21;
}
.pop-versions__elect {
  padding: 15px 0;
}
.popcontainer {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.3);
  z-index: 1;
}
.popimg {
  position: absolute;
  top: 5px;
  right: 5px;
  width: 25px;
  z-index: 20;
}
.popbox {
  padding: 10px 15px;
  background-color: #fff;
  border-radius: 10px 10px 0 0;
  position: fixed;
  z-index: 1;
  bottom: 0;
  width: 92%;
}
.popbox-info {
  font-size: 18px;
  height: 300px;
}
.popbox-info img {
  width: 20px;
  height: 20px;
  margin-right: 10px;
}
.popbox-serve {
  margin-bottom: 10px;
}
.popbox ul li {
  font-size: 16px;
  line-height: 42px;
}
.popbox-right {
  color: #999;
}
.pop-versions__left {
  width: 15px;
  position: absolute;
  left: -22px;
  margin-top: 4px;
}
.pop-versions__right {
  width: 15px;
  position: absolute;
  right: 0;
  top: 4px;
}
.pop-versions__poa {
  position: relative;
}
.pop-versions__poa input {
  width: 60px;
  margin-right: 20px;
  border: 1px solid #dbdbdb;
  text-align: center;
}
.buynowclass{
  position: fixed;
  right: 0px;
}
.content /deep/ img {
  width: 100% !important;
}
.ks-row /deep/ .ks-col-6 {
  white-space : nowrap;
  overflow: hidden;
  text-overflow:ellipsis;
}
.ks-row /deep/ .ks-col-18 {
  margin-top: 8.5px;
  line-height: 25px
}
.ks-cell__title{
  white-space : nowrap;
  overflow:hidden;
  text-overflow:ellipsis; 
}
.mallmore {
  margin-bottom: 10px;
}
.mallmore p{
  font-size: 14px;
  padding: 3px 0;
}
.mallmore_value{
  display: flex;
}
.mallmore_value--ervey{
 padding: 5px 10px;
 margin-right: 10px; 
 border: 1px solid #dedede;
}
.mall-active{
  background-color: #ffedeb;
  color: #ea6a5f;
  border: 1px solid #f08c82;
}
/* .content /deep/ div{
  width: 100%;
} */
</style>