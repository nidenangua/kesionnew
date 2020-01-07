<template>
  <div class="ks-progress-bar" :style="{paddingRight:showText ? '33px' : '0px'}">
    <div class="ks-progress-bar__outer" :style="{backgroundColor:bgColor,border:border}">
      <div class="ks-progress-bar__inner" :style="barInnerStyle"></div>
    </div>
    <div class="ks-progress__text" v-if="showText">{{percentage.toFixed(0)}}%</div>
  </div>
</template>
<script>
export default {
  name: "KsProgress",
  props: {
    /**百分比 */
    percentage: {
      type: Number,
      default: 0,
      validator: val => val >= 0 && val <= 100
    },
    /**进度颜色 */
    color: {
      type: String,
      default: "#e64a3b"
    },
    /**进度条背景色 */
    bgColor:{
      type:String,
      default:"#ebeef5"
    },
    /**是否显示进度条文字内容 */
    showText: {
      type: Boolean,
      default: true
    },
    /**边框颜色 */
    border:String
  },
  computed: {
    barInnerStyle() {
      const style = {};
      style.width = this.percentage > 100 ? 100 : this.percentage + "%";
      style.backgroundColor = this.color;
      return style;
    }
  }
};
</script>
<style scoped>
.ks-progress-bar {
  width: 100%;
  position: relative;
  padding: 12px 0;
  box-sizing: border-box;
}
.ks-progress-bar__outer {
  height: 5px;
  background-color: #ebeef5;
  border-radius: 5px;
}
.ks-progress-bar__inner {
  height: 100%;
  border-radius: 5px;
}
.ks-progress__text {
  position: absolute;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
}
</style>


