<template>
  <router-link to="/" tag="div" class="md-cross-bar">
    <span class="md-cross-btn">
      <i class="ks-icon ks-icon-arrow-ios-forward-outline"></i>店铺主页
    </span>
    <ks-image class="md-cross-img" :src="$store.state.info.logo" type="logo"/>
    <div class="md-cross-bar-info">
      <div class="md-cross-title">{{$store.state.info.sitename}}</div>
      <div class="md-cross-tel">联系电话：{{$store.state.info.tel}}</div>
    </div>
  </router-link>
</template>
<script>
export default {
  name: "StoreInfo"
};
</script>
<style scoped>
.md-cross-bar {
  padding: 15px;
  background: #fff;
  position: relative;
  min-height: 50px;
}
.md-cross-bar .md-cross-img {
  width: 50px;
  height: 50px;
  overflow: hidden;
  line-height: 50px;
  position: absolute;
  left: 15px;
  top: 15px;
}
.md-cross-bar-info {
  padding: 0 70px 0 65px;
}
.md-cross-bar-info .md-cross-title {
  font-size: 14px;
  font-weight: bold;
  line-height: 24px;
  height: 24px;
  overflow: hidden;
}
.md-cross-bar-info .md-cross-tel {
  color: var(--auxiliary_text-color);
  font-size: 12px;
  line-height: 22px;
}
.md-cross-btn {
  position: absolute;
  right: 10px;
  top: 50%;
  line-height: 20px;
  margin-top: -10px;
  color: var(--auxiliary_text-color);
}
.md-cross-btn .ks-icon {
  position: relative;
  top: 1px;
  width: 18px;
  height: 18px;
  float: right;
}
</style>

