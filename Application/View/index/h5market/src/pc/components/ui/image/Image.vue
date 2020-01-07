<template>
  <div class="ks-image" :class="hover && 'ks-image--hover-'+hover" @click="$emit('click',$event)">
    <img class="ks-image__img" :src="imgSrc" @error="onerror" :style="{objectFit:fit}" v-if="src" />
    <img class="ks-image__img" :src="defaultImg" @error="onerror" :style="{objectFit:fit}"  v-else>
    <slot />
  </div>
</template>
<script>
export default {
  name: "KsImage",
  props: {
    /**图片地址 */
    src: String,
    /**图片类型 defailt | user | logo */
    type: String,
    /*图片如何适应到容器框*/
    fit: {
      type: String,
      default: "cover"
    },
    /**经过效果 scale */
    hover:String
  },
  data() {
    let _defaultImg = require("./default-img.png");
    switch (this.type) {
      case "user":
        _defaultImg = require("./default-avatar.jpg");
        break;
      case "logo":
        _defaultImg = require("./default-logo.png");
        break;
    }
    return {
      imgSrc: this.src,
      defaultImg: _defaultImg
    };
  },
  methods: {
    /**
     * 处理图片加载出错
     */
    onerror() {
      this.imgSrc = this.defaultImg;
    }
  },
  watch: {
    src(_imgSrc) {
      this.imgSrc = _imgSrc;
    }
  }
};
</script>
<style scoped>
.ks-image {
  position: relative;
  overflow: hidden;
}
.ks-image__img {
  width: 100%;
  height: 100%;
}
.ks-image--hover-scale .ks-image__img{
  transition: all 0.6s;
  -webkit-transition: all 0.6s;
  -o-transition: all 0.6s;
  -moz-transition: all 0.6s;
  -ms-transition: all 0.6s;
}
.ks-image--hover-scale:hover .ks-image__img {
  transform: scale(1.1);
  -webkit-transform: scale(1.1);
  -o-transform: scale(1.1);
  -moz-transform: scale(1.1);
  -ms-transform: scale(1.1);
}
</style>