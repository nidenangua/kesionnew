<template>
  <div class="paper-medal">
    <div class="paper-medal__img">
      <div class="paper-medal__value">
        <span>{{value}}<i>{{unit}}</i></span>
      </div>
      <div class="paper-medal__info">{{name}}</div>
    </div>
  </div>
</template>
<script>
export default {
  /**勋章样式 */
  name: "PaperMedal",
  props: {
    /**勋章中间内容 */
    value: [String, Number],
    /**勋章标题 */
    name: [String, Number],
    unit: {
      type: String,
      default: ""
    }
  }
};
</script>

<style scoped>
.paper-medal {
  background: #fff;
  padding: 20px 0;
}
.paper-medal__img {
  background: url(../../../assets/exam/exam_sheet_bg.png) no-repeat center;
  height: 160px;
  padding: 20px 0;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  background-size: contain;
  position: relative;
}
.paper-medal__value {
  text-align: center;
  padding-top: 22px;
  font-weight: bold;
}
.paper-medal__value span {
  font-size: 36px;
  color: #ff7827;
}
.paper-medal__value i{
    font-size: 18px;
    font-style: normal;
}
.paper-medal__info {
  position: absolute;
  bottom: 35px;
  text-align: center;
  width: 100%;
  color: #fff;
  font-size: 13px;
}
</style>
