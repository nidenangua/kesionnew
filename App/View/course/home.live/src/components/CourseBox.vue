<template>
  <div class="course-box">
    <ks-image :src="info.defaultpic" class="course-box__defaultpic" />
    <div class="course-box__info">
      <ks-image class="course-box__qrcode" :src="info.qrcode" />
      <div class="course-box__title">{{info.title}}</div>
      <div class="course-box__intro" v-html="info.content"></div>
      <div class="course-box__price ks-color--error">￥{{info.price}}</div>
    </div>
    <div class="course-box__tips ks-color--error">
        您未购买该课程，请先扫码到手机上进行支付！<br />支付成功后，再刷新页面重试
    </div>
  </div>
</template>
<script>
export default {
  name: "CourseBox",
  props: {
    /**课程的基本信息 */
    info: {
      type: Object,
      default() {
        return {};
      }
    }
  }
};
</script>
<style scoped>
.course-box {
  box-shadow: 0 1px 6px rgba(0, 0, 0, 0.1);
  width: 480px;
  margin: 0 auto;
  margin-top: 60px;
}
.course-box__defaultpic {
  height: 280px;
}
.course-box__info {
  padding: 20px;
  position: relative;
}
.course-box__qrcode {
  width: 130px;
  height: 130px;
  position: absolute;
  right: 15px;
  top: 10px;
}
.course-box__title {
  font-size: 18px;
  color: #565656;
  line-height: 20px;
  height: 20px;
  white-space: nowrap;
  text-overflow: ellipsis;
  font-weight: bold;
}
.course-box__intro {
  height: 44px;
  line-height: 22px;
  color: #999;
  margin-top: 10px;
  overflow: hidden;
}
.course-box__price {
  font-size: 16px;
  margin-top: 10px;
}
.course-box__tips{
    line-height: 20px;
    padding: 10px 20px;
    background: #fdf8ed;
}
</style>


