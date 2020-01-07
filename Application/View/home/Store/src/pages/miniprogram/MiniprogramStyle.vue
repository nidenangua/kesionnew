<template>
  <ks-container>
    <ks-title name="选择小程序风格">
      <span class="ks-fz14 ks-color-info ks-ml20">选择风格后即可体验店铺小程序</span>
    </ks-title>
    <el-row :gutter="20" class="miniprogram-style">
      <el-col
        :lg="6"
        :md="8"
        :sm="12"
        class="miniprogram-style__item"
        v-for="item in list"
        :key="item.tempid"
      >
        <div
          class="miniprogram-style__phone"
          @mouseenter="item.showCode = true"
          @mouseleave="item.showCode = false"
        >
          <div class="miniprogram-style__img">
            <transition name="el-fade-in">
              <div class="miniprogram-style__mask" v-show="item.showCode"></div>
            </transition>
            <transition name="el-zoom-in-center">
              <el-image src fit="cover" class="miniprogram-style__code" v-show="item.showCode"></el-image>
            </transition>
            <el-image :src="item.defaultpic" class="miniprogram-style__defaultpic"/>
          </div>
        </div>
        <div class="ks-mt20 ks-cursor-pointer" align="center">
          <el-button @click="useStyle" class="ks-red-btn" size="medium">立即使用</el-button>
        </div>
      </el-col>
    </el-row>
  </ks-container>
</template>
<script>
import { getTemplist } from "@/api/drag";
export default {
  name: "MiniprogramStyle",
  data() {
    return {
      list: []
    };
  },
  methods: {
    useStyle() {
      this.$router.push({ name: "MiniprogramIndex" });
    }
  },
  mounted() {
    this.$showLoading();
    getTemplist({
      temptype: 3
    }).then(res => {
      res.values.map(item => {
        item.showCode = false;
      });
      this.list = res.values;
      this.$hideLoading();
    });
  }
};
</script>
<style scoped>
.miniprogram-style__item {
  margin-top: 30px;
}
.miniprogram-style__phone {
  background: url(../../assets/store/iphone.png) no-repeat;
  width: 280px;
  height: 553px;
  background-position: left;
  margin: 0 auto;
  position: relative;
}
.miniprogram-style__img {
  width: 243px;
  height: 405px;
  position: absolute;
  left: 15px;
  top: 70px;
}
.miniprogram-style__defaultpic {
  width: 100%;
  height: 100%;
}
.miniprogram-style__mask {
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  background: rgba(0, 0, 0, 0.6);
}
.miniprogram-style__code {
  width: 140px;
  height: 140px;
  position: absolute;
  border: 10px solid #fff;
  left: 50%;
  top: 50%;
  margin-left: -80px;
  margin-top: -80px;
  z-index: 9;
}
</style>

