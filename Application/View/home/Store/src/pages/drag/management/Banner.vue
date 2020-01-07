<template>
  <div>
    <div class="banner">
      <img :src="managementData.src">
    </div>
    <div class="clearfix">
      <span class="ks-fl">设置链接：</span>
      <span class="ks-switch ks-fl" @click="flag = flag ? false : true" :class="flag && 'open'"></span>
    </div>
    <div v-show="flag" class="clearfix ks-mt10">
      <input
        class="form-textbox ks-fl"
        style="width:310px;"
        type="text"
        v-model="managementData.url"
      >
      <div class="ks-bt ks-fl ks-link-bt ks-ml10" @click.stop="$selectLink(item)"></div>
    </div>

    <div class="ks-bt ks-bt-pur ks-mt15" @click="$uploadImages(managementData)">修改图片</div>
  </div>
</template>
<script>
export default {
  name: "Banner",
  props: ["managementData"],
  data() {
    return {
      flag: false
    };
  }
};
</script>
<style scoped>
.banner img {
  display: block;
  max-width: 100%;
  margin-bottom: 15px;
  border-radius: 3px;
  max-height: 120px;
}
</style>
