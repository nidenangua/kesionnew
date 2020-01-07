<template>
<div>
   <div class="search" @enter="goSearch">
      <kd-search />
   </div>
   <div>
     <!--轮播图-->
      <kd-carousel
        :data-list="bannerList"
        :data-ratio="0.56"
      />
   </div>
   <div>
       <!--导航-->
       <kd-nav :data-list="navList"/>
   </div>
   <div class="new">
       <!--新品上架-->
      <div class="new__writ"><a class ="new__left">新品上架</a><a class="new__right" @click="jumpList()">查看更多>></a></div>
      <div class="ks-row">
          <div class="ks-col-12" v-for="(item,i) in new_goods" :key="i" @click="open(item.courseid)">
              <div class="div_img">
                <!-- <ks-image class="new_img" :src="item.defaultpic" /> -->
                <img class="new_img" :src="item.defaultpic" alt="">
              </div>
              <div class="ks-ellipsis">{{item.title}}</div>
              <span class="row_left">￥{{item.price}}</span><span class="row_right">{{item.studentcount}}人购买</span>
          </div>
      </div>
   </div>
   <div class="hot">
       <!--热卖商品-->
      <div class="new__writ"><a class ="new__left">热卖商品</a><a class="new__right" @click="jumpList()">查看更多>></a></div>
      <div class="hot__row" v-for="(item,i) in hot_goods" :key="i" @click="open(item.courseid)">
        <div class = "hot__left">
            <ks-image class="hot__img" :src="item.defaultpic"/>
        </div>  
        <div class="hot__right">
            <div class="hot__font">{{item.title}}</div>
            <span class="hot__deta">{{item.shortdesc}}</span><br/>
            <div><span class="hot__det">{{item.studentcount}}人购买</span><span class="hot__price">￥{{item.price}}</span></div>
        </div>
      </div>
   </div>
    <div class="malist-icon">
            <i class="ks-icon ks-icon-shopping-cart" @click="jumpCart()"></i>
          </div>
   <store-footer/>
</div>    
</template>
<script>
import { teachMall } from "@/api/mall.js";
export default {
    data(){
        return{
          filterType: "",
          bannerList:[],
          new_goods:[],
          hot_goods:[],
          navList:[
        {
          icon:require("@/m/assets/mall/shop_icon_new.png"),
          name:'新品',
          url:'#/malist?rank=1'
        },
        {
          icon:require("@/m/assets/mall/shop_icon_hot.png"),
          name:'热卖',
          url:'#/malist?rank=2'
        },
        {
          icon:require("@/m/assets/mall/shop_icon_order.png"),
          name:'订单',
          url:'#/user/order'
        },
        {
          icon:require("@/m/assets/mall/shop_icon_all.png"),
          name:'全部',
          url:'#/malist'
        }
      ]
        };
    },
    methods:{
    /**
     * 搜索
     * @param {String} 搜索关键词
     */
    goSearch(key) {
      this.params = key;
      this.resetParams();
      this.activated();
    },
     /**
     * 重置参数
     */
    resetParams(params) {
      params = params || {};
      this.pageCount = params.pageCount || null;
      this.params.p = params.p || 1;
      this.list = params.list || [];
    },
      open(id) {
        this.$router.push('/commodity?id='+id)
      },
      jumpCart(){
        this.$router.push('/cart')
      },
      jumpList(){
        this.$router.push('/malist')
      },
       /**
     * 筛选
     * @param {Object}
     */
    filter(data) {
      let query = cloneData(this.$route.query);
      let keys = Object.keys(data);
      keys.map(key => {
        query[key] = data[key];
      });
      this.$router.push({
        name: this.$route.name,
        query: query
      });
      this.filterType = "";
      this.teachMall()
    },
    },
    activated() {
       teachMall().then(res=>{
          this.bannerList = res.banner;
          this.new_goods = res.new_goods;
          this.hot_goods = res.hot_goods;
      });
      document.title = "教辅周边";
  },
}
</script>
<style scoped>
.search {
  background: #f5f5f5;
}
.new{
    background: #fff;
    margin-top: 10px;
}
.new__writ{
    height: 50px;
}
.new__left{
    float: left;
    font-size: 14px;
    margin-top: 10px;
    margin-left: 13px;
    font-size: 17px;
    color: #000;
}
.new__right{
    float: right;
    margin-right: 13px;
    font-size: 14px;
    margin-top: 10px;
    color: #666;
}
.row_left{
    float: left;
    color: red;
    font-size: 12px;
}
.row_right{
    float: right;
    font-size: 12px;
}
.ks-col-12{
    padding: 2.5%;
    padding-left: 17px;
    padding-right: 15px;
    /* padding-bottom: 10px; */
}
.ks-row .ks-col-12{
  border-bottom: .5px solid rgba(0, 0, 0, 0.1);
}
/* .ks-row .ks-col-12:nth-child(1),
.ks-row .ks-col-12:nth-child(2) {
  border: none;
} */
.ks-row .ks-col-12:nth-child(2n-1) {
  border-right: .5px solid rgba(0, 0, 0, 0.1);
}
/* .new_img{
   position: absolute;
   top:50%; 
   left:50%;
   transform: translate(-50%,-50%);
   width: 62%;
} */
.new_img{
  width: 100%;
  height: 100%
}
.ks-ellipsis{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 14px;
    line-height: 32px;
}
.ks-ellipsis--tow{
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
}
.hot{
  margin-top: 10px;
  background: #fff;
}
.hot__row{
    clear: both;
    padding: 10px 0;
    overflow: hidden;
}
.hot__left{
   width: 40%; 
   height: 100px;
   float: left;
   position: relative;
}
.hot__right{
    width: 57%;
    float: left;
}
.hot__img{
    width: 65%;
    position: absolute;
    top:50%;
    left: 50%;
    transform: translate(-50%,-50%)
}
.hot__font{
  font-size: 16px;
  margin-bottom: 5px;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}
.hot__deta{
  font-size: 12px;
  color: #999;
  line-height: 20px;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}
.hot__det{
  font-size: 12px;
  color: #999;
  line-height: 20px;
}
.hot__price{
  float: right;
  margin-right: 10px;
  font-size: 16px;
  color: red;
  line-height: 16px;
}
.malist-icon{
    position: fixed;
    clear: both;
    overflow: hidden;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background-color: #fff;
    padding: 6px;
    text-align: center;
    box-shadow: -1px 1px 3px 0 rgb(230, 74, 59);
    bottom: 60px;
    right: 10px;
}
.malist-icon i{
    color: #e64a3b;
    font-size: 20px;
}
.div_img{
  position: relative;
  height: 7.5rem;
}
</style>