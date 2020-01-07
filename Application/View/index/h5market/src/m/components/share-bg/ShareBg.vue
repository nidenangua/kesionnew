<template>
  <div class="share-bg" :class="type && 'share-bg-'+type" v-if="shareFlag" @click="shareFlag=false"></div>
</template>
<script>
export default {
  name: "ShareBg",
  data() {
    return {
      shareFlag: false,
      type: ""
    };
  }
};
</script>

<style scoped>
.share-bg {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  margin: 0 auto;
  width: 100%;
  max-width: 480px;
  height: 100%;
  z-index: 99;
  background-color: rgba(0, 0, 0, 0.3);
  background-image: url(./assets/share-bg.png);
  background-repeat: no-repeat;
  background-position: center 10px;
  background-size: 80% auto;
}
.share-bg-gift {
  background-image: url(./assets/gift_img_give.png);
}
</style>
