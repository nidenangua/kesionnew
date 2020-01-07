<template>
  <view class="ks-image__box" :class="hover && 'ks-image--hover-'+hover" @click="$emit('click',$event)">
    <image class="ks-image__img" :style="{'borderRadius': radius}" :src="imgSrc" @error="onerror" :mode="aspect" v-if="src" />
    <image class="ks-image__img" :style="{'borderRadius': radius}" :src="defaultImg" @error="onerror" :mode="aspect"  v-else>
    <slot />
  </view>
</template>
<script>
export default {
  name: "ks-image",
  props: {
	 radius:{
		 type:String,
		 default:'0'
	 },
    /**图片地址 */
    src: String,
    /**图片类型 defailt | user | logo */
    type: String,
    /*图片如何适应到容器框*/
    aspect: {
      type: String,
      default: "aspectFill"
    },
    /**经过效果 scale */
    hover:String
  },
  data() {
	  var baseUrl = this.$store.state.SRC+"/config/app"
    var _defaultImg = baseUrl+"/static/images/common/default-img.png";
    switch (this.type) {
      case "user":
        _defaultImg = baseUrl+"/static/images/common/default-avatar.png";
        break;
      case "logo":
        _defaultImg = baseUrl+"/static/images/common/shouguan.png?2.0";
        break;
		case "teacher":
		  _defaultImg = baseUrl+"/static/images/common/default-teacher.png";
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
.ks-image__box {
  position: relative;
  overflow: hidden;
  width: 100%;
  height: 100%;
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
