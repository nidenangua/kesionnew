<template>
  <div>
    <div
      v-for="(item,i) in components"
      :drag="item.type"
      :drag-index="i"
      :key="i"
      v-show="!item.api || (item.list && item.list.length) || $store.state.drag"
    >
      <!-- 标题 -->
      <kd-title v-if="item.title" :data-title="item.title"></kd-title>
      <kd-header :data-item="item" v-if="item.type === 'header'" />
      <!-- banner -->
      <kd-banner
        v-else-if="item.type=='swiper'"
        :data-list="item.list"
        :style="{height: item.height}"
        :banner-height="item.height"
      ></kd-banner>
      <kd-navnew :data-list="item.list" v-else-if="item.type=='navnew'"></kd-navnew>
      <kd-navbanner :data-list="item.list" v-else-if="item.type=='navbanner'"></kd-navbanner>
      <kd-synthesize :tabs-data="item.list.tabsData" :ranking="item.list.ranking" v-else-if="item.type=='synthesize'"></kd-synthesize>
      <!-- 领券中心 -->
      <kd-coupon v-else-if="item.type=='coupon'"></kd-coupon>
      <!-- 最新直播 -->
      <kd-course
        :data-style="item.style"
        :data-type="item.type"
        :other="item.other"
        :data-list="item.list"
        v-else-if="item.type == 'course' ||item.type=='class' || item.type=='column'"
      ></kd-course>
      <!-- 精英名师 -->
      <kd-teacher :data-list="item.list" v-else-if="item.type=='teacher'"></kd-teacher>
      <!-- 社群讨论 -->
      <kd-group :data-list="item.list" v-else-if="item.type=='group'"></kd-group>
      <!-- 最新资讯 -->
      <kd-news :data-list="item.list" v-else-if="item.type=='news'"></kd-news>
      <!--富文本-->
      <kd-richtext v-else-if="item.type === 'richtext'" :data-code="item.code" />
    </div>
    <kd-footer/>
  </div>
</template>

<script>
import { cloneData } from "@/utils";
import { getStoreData, getStoreInfo } from "@/api/store";
export default {
  name: "Index",
  data() {
    return {
      components: []
    };
  },

  methods: {
    loadComponents() {
      this.$showLoading();
      /**
       * 获取配置信息
       */
      this.$store.ready(state => {
        /**
         * 请求对应数据
         */
        let params = [];
        let components = cloneData(state.configjson);
        components.map(item => {
          if (item.type === "header") {
            item.other = state.headjson.other;
            item.navList = state.headjson.navList;
            item.style = state.headjson.style;
          }
          /**存在api，说明需要请求数据，将API信息放到数组，在下一步进行数据请求 */
          if (item.api) {
              params.push(item.api)
          }
          if(item.api_list){
            item.api_list.map(t=>{
              params.push(t.api)
            })
          }
        });
        /**
         * 获取数据
         */
        getStoreData(params).then(res => {
          let keys = Object.keys(res);
          components.map(item=>{
            if(item.api){
              keys.map(k=>{
                if(item.api.callKeyName === k){
                  item.list = res[k].list
                }
              })
            }else if(item.api_list){
              item.list = {}
              item.api_list.map(t=>{
                keys.map(k=>{
                  if(t.api.callKeyName === k){
                    let related = cloneData(t.related || {})
                    related.list = res[k].list
                    if(item.list[t.belong]){
                      if(item.list[t.belong] instanceof Array){
                        item.list[t.belong].push(related)
                      }else{
                        let arr = [item.list[t.belong]]
                        arr.push(related)
                        item.list[t.belong] = arr
                      }
                    }else{
                      item.list[t.belong] = related
                    }
                  }
                })
                
              })
            }
          })
          this.components = components;
          this.$nextTick(() => {
            this.$hideLoading();
          });
        });
      });
    }
  },
  mounted() {
    if (window.name === "mphone") {
      window.APP = this;
    }
    this.loadComponents();
  }
};
</script>

