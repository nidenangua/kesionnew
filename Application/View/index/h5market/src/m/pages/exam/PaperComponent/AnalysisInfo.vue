<template>
  <div class="analysis-info">
    <div v-if="item.tktype != 1">
      <div class="analysis-info__title">参考答案</div>
      <div class="analysis-info__content" v-if="item.tkinfo">
        <div v-if="item.tktype == 5">
          <p v-for="(ans,a) in item.tkinfo.answer" :key="a">({{a+1}}) &nbsp; {{ans.toString()}}</p>
        </div>
        <div v-else>{{item.tkinfo.answer | answer(item.tktype)}}</div>
      </div>
      <div class="analysis-info__title">你的答案</div>
      <div class="analysis-info__content">
        <div v-if="item.tktype == 5">
          <p v-for="(ans,a) in item.useranswer" :key="a">({{a+1}}) &nbsp; {{ans.toString()}}</p>
        </div>
        <div v-else>{{item.useranswer | answer(item.tktype)}}</div>
      </div>
    </div>
    <div class="analysis-info__title">题目解析</div>
    <div class="analysis-info__content" v-if="item.tkinfo" v-html="item.tkinfo.analysis || '暂无解析'"></div>
  </div>
</template>
<script>
export default {
  name: "AnalysisInfo",
  props: {
    /**题目对象 */
    item: Object
  },
  data() {
    return {};
  },
  filters: {
    /**
     * 参考答案内容过滤
     */
    answer(val, tktype) {
      val = val.toString();
      if (val === "") {
        return "无";
      } else {
        if (tktype == 4) {
          return val === "1" ? "A" : "B";
        } else {
          return val;
        }
      }
    }
  }
};
</script>
<style scoped>
/*题目解析*/
.analysis-info {
  padding: 15px;
  border-radius: 4px;
  margin-top: 15px;
  background: #f9f9f9;
}
.analysis-info__title {
  font-size: 14px;
}
.analysis-info__content {
  font-size: 14px;
  color: #999;
  padding: 5px 0 10px 0;
  line-height: 22px;
  border-radius: 4px;
}
</style>


