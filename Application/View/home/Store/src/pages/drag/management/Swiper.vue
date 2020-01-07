<template>
  <div>
    <div class="slide">
      <ul>
        <li v-for="(item,index) in list" :key="index">
          <div class="img">
            <img :src="item.img">
            <div class="select-img" @click="$uploadImages(item,'img')">替换图片</div>
          </div>
          <div class="clearfix">
            <span class="ks-fl">设置链接：</span>
            <span
              class="ks-switch ks-fl ks-ml10"
              @click="item.flag = item.flag ? false : true"
              :class="item.flag && 'open'"
            ></span>
          </div>
          <div v-show="item.flag" class="ks-mt10">
            <input class="form-textbox ks-fl" style="width:155px;" type="text" v-model="item.url">
            <div class="ks-bt ks-link-bt ks-fl ks-ml10" @click.stop="$selectLink(item)"></div>
          </div>
          <div class="ks-delete" @click="deleteInfo(index)"></div>
        </li>
      </ul>
    </div>
    <div align="center">
      <div class="ks-bt ks-bt-pur fn" @click="addInfoData()">添加banner</div>
    </div>
  </div>
</template>
<script>
import { domap, deleteArray, cloneArray } from "@/utils";
export default {
  name: "Swiper",
  props: ["list"],
  methods: {
    /**
     * 删除banner
     */
    deleteInfo(index) {
      if (this.list.length <= 1) {
        this.$alert("至少保留一条");
        return false;
      }
      this.$parent.moduleManagement.list = deleteArray(this.list, index);
    },
    /**
     * 添加banner
     */
    addInfoData() {
      if (this.list.length >= 10) {
        this.$alert("您最多可添加10张轮播图");
        return false;
      }
      let arr = cloneArray(this.list);
      arr.push({
        flag: false,
        url: "",
        img: `/Images/images/201806/5b189d39c63a7.png`
      });
      this.$parent.moduleManagement.list = arr;
    }
  },
  mounted() {
    let arr = cloneArray(this.list);
    domap(arr, item => {
      if (item.flag === undefined) {
        item.flag = item.url ? true : false;
      }
    });
    this.$parent.moduleManagement.list = arr;
  }
};
</script>
<style scoped>
/*轮播图*/
.slide ul {
  padding-bottom: 20px;
}
.slide li {
  position: relative;
  min-height: 70px;
  padding: 0 0 20px 135px;
  margin-top: 20px;
  border-bottom: 1px solid #eee;
}
.slide li .img {
  width: 120px;
  height: 70px;
  position: absolute;
  left: 0;
  top: 0;
  border-radius: 4px;
  overflow: hidden;
}
.slide li .img img {
  width: 100%;
  height: 100%;
}
.slide .select-img {
  height: 22px;
  line-height: 22px;
  position: absolute;
  width: 100%;
  left: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.4);
  color: #fff;
  text-align: center;
  cursor: pointer;
}
.ks-delete {
  top: 0;
  margin-top: -7px;
}
</style>
