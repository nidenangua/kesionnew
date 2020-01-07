<template>
  <div>
    <transition name="fade-up">
      <div
        class="ks-dialog"
        :style="getStyle()"
        :class="position && 'ks-dialog--'+position"
        v-show="visible"
      >
        <div class="ks-dialog__title" v-if="!curtain">
          <div
            class="ks-dialog__close ks-info-color ks-fr"
            @click="$emit('update:visible',false)"
            v-if="showClose"
          >
            <i class="ks-icon ks-icon-close"></i>
          </div>
          {{title}}
        </div>
        <div class="ks-dialog__body">
          <slot/>
        </div>
        <div
            class="ks-dialog__ft-close"
            @click="$emit('update:visible',false)"
            v-if="showClose"
          >
            <i class="ks-icon ks-icon-close"></i>
          </div>
      </div>
    </transition>
    <transition name="fade">
        <div class="ks-masked" @click="maskedClick" v-if="visible"></div>
    </transition>
  </div>
</template>
<script>
export default {
  name: "KsDialog",
  props: {
    visible: Boolean,
    title: String,
    width: String,
    position: String,
    boxShadow: String,
    borderRadius: String,
    curtain:Boolean,
    showClose:{
      type:Boolean,
      default:true
    }
  },
  watch:{
      "$route.path"(){
          this.$emit('update:visible',false)
      }
  },
  methods: {
    getStyle() {
      let style = {};
      if (this.width) {
        style.width = this.width;
      }
      if (this.boxShadow) {
        style.boxShadow = this.boxShadow;
      }
      if (this.borderRadius) {
        style.borderRadius = this.borderRadius;
      }
      return style;
    },
    maskedClick(){
      if(this.showClose){
        this.$emit('update:visible',false)
      }
    }
  }
};
</script>
<style scoped>
.ks-dialog {
  position: fixed;
  top: 25%;
  left: 0;
  right: 0;
  max-width: 400px;
  margin: 0 auto;
  transition: all 0.2s linear;
  width: 90%;
  border-radius: 4px;
  box-shadow: 0 2px 18px rgba(25, 25, 25, 0.1);
  background: #fff;
  z-index: 150;
}
.ks-dialog--bottom {
  top: inherit;
  bottom: 0;
}
.ks-dialog__title {
  height: 49px;
  line-height: 49px;
  font-size: 16px;
  padding: 0 10px 0 15px;
}
.ks-dialog__close {
  width: 32px;
  text-align: center;
}
.ks-dialog__close .ks-icon-close {
  font-size: 22px;
  color: var(--prompt-color);
}
.ks-dialog__body {
  padding: 10px 20px 20px 20px;
}
.ks-dialog__ft-close{
  width: 32px;
  height: 32px;
  position: absolute;
  left: 50%;
  bottom: -56px;
  margin-left: -18px;
  border: 1px solid #fff;
  border-radius: 50%;
  text-align: center;
  line-height: 32px;
  color:#fff;
}
.ks-dialog__ft-close::before{
  content: '';
  width: 0px;
  border-left: 1px dashed #fff;
  position: absolute;
  left: 50%;
  height: 20px;
  top: -20px;
}
.ks-dialog__ft-close .ks-icon{
  font-size: 20px;
}
</style>


