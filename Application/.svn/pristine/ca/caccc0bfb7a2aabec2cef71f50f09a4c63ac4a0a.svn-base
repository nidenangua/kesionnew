<template>
  <div class="page" :class="'page--style'+$store.state.style.id" v-if="loaded">
    <!-- 头部色块 -->
    <div class="tophead" v-if="$store.state.style.id == 4"></div>
    <div
      class="component-box"
      v-for="(item,i) in components"
      :key="i"
      :drag="item.type"
      :drag-index="i"
      :class="(item.title && item.title.style == 3 && item.title.more && item.title.more.length) ? 'component-by-FT component-box--'+item.type : 'component-box--'+item.type"
      v-show="!item.api || item.list.length || $store.state.drag"
    >
      <!--标题-->
      <kd-title v-if="item.title" :data-title="item.title" />

      <kd-store-info v-if="item.type === 'storeinfo'" />
      <kd-teacher-intro v-else-if="item.type === 'teacherIntro'" />
      
      <!-- 导航 -->
      <div class="topnav" v-else-if="item.type === 'topnav'">
        <ul>
           <li class="active">推荐</li>
          <li v-for="(item,index) in dataList" :key="index" @click="gotoMenu(item.categoryid)">{{item.categoryname}}</li>
        </ul>
      </div>

      <!--搜索条-->
      <kd-search v-else-if="item.type === 'search'" :padding="item.padding || '10px'" :bg="item.style == 2 ? 'gray' : ''" @enter="goSearch" />

      <!--轮播图-->
      <kd-carousel
        v-else-if="item.type === 'swiper'"
        :radius="item.radius"
        :pagination="item.pagination"
        :centered-slides="item.centeredSlides"
        :slides-per-view="item.slidesPerView"
        :data-list="item.list"
        :data-ratio="item.ratio"
        :style="item.style"
      />

      <!--富文本-->
      <kd-richtext v-else-if="item.type === 'richtext'" :data-code="item.code" />

      <!--banner-->
      <kd-banner v-else-if="item.type === 'banner'" :data-src="item.src" :data-url="item.url" />

      <!--导航-->
      <kd-nav v-else-if="item.type === 'nav'" :data-list="item.list" :data-style="item.style" />

      <!--会员卡-->
      <kd-vip-card
        v-else-if="item.type === 'vipcard'"
        :data-list="item.list"
        :data-style="item.style"
      />

      <!--新闻-->
      <kd-news v-else-if="item.type === 'news'" :data-list="item.list" :data-style="item.style" />

      <!--排行榜-->
      <kd-leaderboard v-else-if="item.type === 'leaderboard'" :top-list="item.topList" :data-style="item.style" />
      
      <!-- 名师大咖 -->
      <kd-teacher
        v-else-if="item.type === 'teacher'"
        :data-list="item.list"
        :data-style="item.style"
      />

      <!--课程、直播、专栏-->
      <kd-course
        v-else-if="item.type === 'course' || item.type === 'class' || item.type === 'column'"
        :data-type="item.type"
        :data-list="item.list"
        :data-style="item.style"
      />
    </div>
    <store-footer />
    <store-footer-bar />
  </div>
</template>

<script>
import { getStoreData, getStoreInfo } from "@/api/store";
import {courseCategory} from "@/api/courseManage";
export default {
  name: "index",
  data() {
    return {
      loaded: false,
      components: [],
      dataList:[],
      swiperOption: {
        slidesPerView: 3.2,
        spaceBetween: 15
      },
    };
  },
  methods: {
    gotoMenu(id){
      this.$router.replace('/course?categoryid='+id)
    },
    goSearch(key) {
      this.$router.push({
        path: "/course",
        query: {
          key: key
        }
      });
    },
    loadComponents() {
      this.loaded = false;
      this.$showLoading();

      /**
       * 获取配置信息
       */
      this.$store.ready(() => {
        /**
         * 请求对应数据
         */
        let params = [];
        let components = []; 
        
      this.$store.state.configjson.map(item => {
      // configjson.map(item => {
          let keys = Object.keys(item);
          let obj = {};
          keys.map(k => {
            obj[k] = item[k];
          });
          components.push(obj);
          if (item.api) {
            params.push(item.api);
          }else if(item.type === 'leaderboard'){
            item.topList.map(t=>{
              params.push(t.api)
            })
          }
        });
        /**
         * 获取数据
         */
        getStoreData(params).then(res => {
          let keys = Object.keys(res);
          keys.map(k => {
            components.map(item => {
              if (item.api && item.api.callKeyName === k) {
                item.list = res[k].list;
              }else if(item.type === 'leaderboard'){
                item.topList.map(t=>{
                  if(t.api.callKeyName === k){
                    if(res[k].page){
                      t.totalput = res[k].page.totalput
                    }else{
                      t.totalput = res[k].list.length
                    }
                    
                    t.list = res[k].list
                  }
                })
              }
            })
          })
          this.components = components;
          this.loaded = true;
          this.$hideLoading();
        });
         courseCategory(params).then(res =>{
            this.dataList = res;
            
        });
      });
    }
  },
  mounted() {
    this.loadComponents();
    if (window.name === "mphone") {
      window.APP = this;
    }
  },
  activated() {
    if (this.$route.query.reload == 1 && this.loaded) {
      this.loadComponents();
    }
    this.$store.ready(state => {
      document.title = state.info.sitename;
      /**
       * 配置微信分享
       */
      this.$wxShare({
        title: state.info.sharetitle || state.info.sitename,
        desc: state.info.sharedesc || state.info.tel,
        imgUrl: state.info.sharepic || state.info.logo
      });
    });
  }
};
</script>
<style lang="scss" scoped>
.component-by-FT {
  position: relative;
  padding-bottom: 44px;
}
.tophead{
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  max-width: 480px;
  margin: 0 auto;
  height: 200px;
  width: 100%;
  background: #4925D2;
}
.topnav{
    color: #fff;
    font-size: 14px;
    overflow-y:hidden;
    overflow-x: auto;
    height: 44px;
    line-height: 44px;
    white-space: nowrap;
    position: relative;
    z-index: 1;
    padding-right: 20px;
  li{
    display: inline-block;
    color: #fff;
    opacity: 0.8;
    font-size: 14px;
    margin-left: 20px;
  }
  .active{
    font-size: 18px;
    font-weight: bold;
    opacity: 1;
  }
  ul{
    overflow-y: scroll;
  }
}
.page--style4 {
  .component-box--swiper{
      border-radius: 8px;
      box-shadow: 0px 2px 14px 0px rgba(73,37,210,0.5);
      margin: 0 15px 20px 15px;
      overflow: hidden;
      position: relative;
      z-index: 1;
  }
  .component-box--course,
  .component-box--column{
    margin: 0 15px;
    border-radius: 8px;
    overflow: hidden;
  }
  .component-box--column{
    margin-top: 20px;
    margin-bottom: 10px;
    background: #fff;
  }
  .component-box /deep/ .drag-title{
    border-radius: 8px 8px 0 0;
      overflow: hidden;
  }
  .topnav /deep/ .swiper-slide:first-child{
      font-size: 18px;
      color: #fff;
      margin:0 10px;
      font-weight: bold;
  }
 
} 
</style>
