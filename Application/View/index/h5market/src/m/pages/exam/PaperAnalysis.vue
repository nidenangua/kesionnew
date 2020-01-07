<template>
  <div class="analysis-contianer" :style="{minHeight:windowHeight+'px'}" v-if="loaded">
    <ks-swiper :options="swiperOption" v-if="anliysisList.length">
      <ks-swiper-slide v-for="(item,i) in anliysisList" :key="i">
        <analysis-item :iscorrect="iscorrect" :item="item" :level="1"/>
        <div v-if="item.tktype==6">
          <div v-for="(child,c) in item.tkinfo.childtk" :key="c">
            <!--组合题部分-->
            <analysis-item
              :item="child"
              :iscorrect="iscorrect"
              :number="`${c+1})`"
              :class="c < item.tkinfo.childtk.length-1 && 'ks-line'"
            />
          </div>
        </div>
      </ks-swiper-slide>
    </ks-swiper>
    <ks-empty msg="暂无解析" v-else/>
  </div>
</template>

<script>
import { getPaperGradeDetail, getTest } from "@/api/exam";
import AnalysisItem from "./PaperComponent/AnalysisItem";

export default {
  /**试卷解析 */
  name: "PaperAnalysis",
  components: {
    AnalysisItem
  },
  data() {
    return {
      loaded: false,
      windowHeight: window.innerHeight,
      swiperOption: {
        slidesPerView: 1,
        spaceBetween: 0,
        autoHeight: true
      },
      /**答题id */
      answerId: this.$route.query.id,
      /**阅卷状态 */
      iscorrect: -1,
      /**
       * 解析列表
       */
      anliysisList: [],

      /**收藏解析 做题解析*/
      moduleName: this.$route.name
    };
  },
  activated() {
    document.title = "查看试卷解析";
    this.answerId = this.$route.query.id;
    this.anliysisList = [];
    this.moduleName = this.$route.name;
    let API;
    let params = {};
    if (this.moduleName == "analysis") {
      API = getPaperGradeDetail;
      params = {
        id: this.answerId,
        type: this.$route.query.type || 1 //1整卷 2随机、错题
      };
    } else if (this.moduleName == "ErrorAnaysis") {
      API = getTest;
      params = {
        categoryid: this.$route.query.categoryid
      };
    }
    if (!API) {
      return;
    }
    this.$showLoading();
    API(params).then(res => {
      if (res.result === "success") {
        let _anliysisList = [];
        res.list.map(item => {
          item.tklist.map(tk => {
            if (tk.tktype == 6) {
              tk.tkinfo.childtk.map(child => {
                /**即时显示答题对错状态 */
                child.showAnswerStatus = true;
                /**禁止改变答案 */
                child.changeAnswer = false;
              });
            }
            /**即时显示答题对错状态 */
            tk.showAnswerStatus = true;
            /**禁止改变答案 */
            tk.changeAnswer = false;
            _anliysisList.push(tk);
          });
        });
        this.iscorrect = res.detail.iscorrect;
        this.anliysisList = _anliysisList;
      }
      this.loaded = true;
      this.$hideLoading();
    });
  }
};
</script>
<style scoped>
.analysis-contianer {
  background: #fff;
  padding: 0 15px;
}
</style>