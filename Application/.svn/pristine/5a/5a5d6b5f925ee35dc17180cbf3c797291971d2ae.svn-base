<template>
  <div>
    <div class="recepit__info">
      {{opeartArr.msg}}
      <div class="recepit__btn">
        <el-button type="primary" @click="sure">去升级</el-button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "set",
  props: ["opeartArr"],
  data() {
    return {
      loaded: true
    };
  },
  methods: {
    confirm(val) {
      if (this.checked) {
        this.disabled = false;
      } else {
        this.disabled = true;
      }
    },
    sure() {
      this.$router.push({
        path: "/",
        query: {
          url: this.opeartArr.url
        }
      });
      this.$emit("update:ProptVisible", false);
    }
  }
};
</script>
<style scoped>
.recepit__title {
  font-size: 14px;
  color: #000;
  margin-bottom: 20px;
}
.recepit__info {
  font-size: 14px;
  color: #666;
  text-align: center;
}
.recepit__btn {
  margin-top: 30px;
  text-align: center;
}
.recepit__checkbox {
  text-align: center;
}
</style>


