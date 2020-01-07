<template>
  <div>
    <transition name="fade">
      <div class="ks-masked" v-show="visible" :style="{zIndex:zIndex}"></div>
    </transition>
    <transition name="fade">
      <div class="ks-dialog" ref="dialog" v-show="visible" :style="{zIndex:zIndex+1,width:width,marginTop:marginTop}">
        <div class="ks-dialog__title"></div>
        <div class="ks-dialog__body">
          <slot/>
        </div>
      </div>
    </transition>
  </div>
</template>
<script>
let dialogZindex = 99;
export default {
  name: "Dialog",
  props: {
    /**窗口是否可见 */
    visible: {
      type: Boolean,
      default: false
    },
    /**窗口宽度 */
    width:{
        type:String,
        default:'60%'
    }
  },
  data() {
    return {
      zIndex: 0,
      marginTop:0
    };
  },
  mounted() {
    dialogZindex += 1;
    this.zIndex = dialogZindex;
    this.marginTop = - this.$refs.dialog.offsetHeight / 2 + 'px'
  }
};
</script>
<style scoped>
.ks-dialog {
  position: fixed;
  top:50%;
  left: 0;
  right: 0;
  margin: 0 auto;
  background: #fff;
}
.ks-dialog__title {
  height: 44px;
  line-height: 44px;
  overflow: hidden;
}
.ks-dialog__body {
  padding: 20px;
}
</style>

