<template>
    <div class="ks-image">
        <img :src="imgSrc" @error="onerror" :style="{objectFit: fit}" />
    </div>
</template>
<script>
export default {
  name: "KsImage",
  props: {
    src: String,
    type: String,
    fit:{
      type:String,
      default:'cover'
    }
  },
  data() {
    let _defaultImg = require("./assets/default-img.png");
    switch (this.type) {
      case "user":
        _defaultImg = require("./assets/default-avatar.jpg");
        break;
      case "logo":
        _defaultImg = require("./assets/default-logo.png");
        break;
    }
    return {
      imgSrc: this.src,
      defaultImg: _defaultImg
    };
  },
  watch: {
    src(_imgSrc) {
      this.imgSrc = _imgSrc;
    }
  },
  methods: {
    /**
     * 处理图片加载出错
     */
    onerror() {
      this.imgSrc = this.defaultImg;
    }
  }
};
</script>
<style scoped>
.ks-image img {
  width: 100%;
  height: 100%;
}
</style>
