<template>
  <div>
    <iframe
      v-if="act"
      :src="'/home.html/wechat/Index/'+act+'?appid-23'"
      class="frame"
      name="frame"
      @load="frameLoaded"
      :style="{height:frameHeight+'px'}"
    ></iframe>
  </div>
</template>
<script>
export default {
  name: "More",
  data() {
    return {
      act: this.$route.query.act,
      frameHeight: null
    };
  },
  watch: {
    "$route.query.act"(act) {
      this.act = act;
    }
  },
  methods: {
    frameLoaded() {
      this.frameHeight = frames.frame.document.body.offsetHeight;
    }
  }
};
</script>
<style scoped>
.frame {
  width: 100%;
  border: 0px;
}
</style>
