<template>
  <div
    class="ks-create-bg"
    :class="type && `ks-create-bg-${type}`"
    :style="style"
    @click="click"
    ref="ktjCreateBg"
  >
    <div class="ks-create-bg__image" :style="{backgroundImage:`url('${src}')`}">
      <slot/>
    </div>
  </div>
</template>
<script>
export default {
  name: "KsCreateBg",
  props: {
    src: String,
    type: String,
    ratio: Number,
    borderRadius: String,
    position: String
  },
  data() {
    return {
      style: {}
    };
  },
  methods: {
    /**
     * 添加事件
     */
    click() {
      this.$emit("click");
    }
  },
  mounted() {
    let style = {};
    if (this.ratio && this.$refs.ktjCreateBg) {
      let width = this.$refs.ktjCreateBg.offsetWidth;
      style.height = width * this.ratio + "px";
    }
    if (this.borderRadius) {
      style.borderRadius = this.borderRadius;
    }
    if (this.position) {
      style.position = this.position;
    }
    this.style = style;
    window.addEventListener("resize", e => {
      if (this.$refs.ktjCreateBg) {
        let width = this.$refs.ktjCreateBg.offsetWidth;
        this.style.height = width * this.ratio + "px";
      }
    });
  }
};
</script>
<style scoped>
.ks-create-bg {
  position: relative;
  overflow: hidden;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: 50% 50%;
  border-radius: 4px;
  background-image: url("./assets/img-icon.png");
}
.ks-create-bg-logo {
  background-image: url("./assets/default-logo.png");
}

.ks-create-bg-user {
  background-image: url("./assets/default-avatar.jpg");
}
.ks-create-bg__image {
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  background-repeat: no-repeat;
  background-position: 50% 50%;
  background-size: cover;
}
.ks-create-bg-logo .ks-create-bg__image {
  background-size: contain;
}
</style>


