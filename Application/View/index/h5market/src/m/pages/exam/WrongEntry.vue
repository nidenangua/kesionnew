<template>
  <div>
    <paper-medal :value="errorobj.error_num" name="我的错题"/>
    <div class="wrong-entry">
      <div class="wrong-entry__entro">
        <div class="wrong-entry__number">
          今日错题：{{errorobj.today_error}} &nbsp; &nbsp; &nbsp; 正确率：<strong style="color:#80c269">{{errorobj.accuracy}}%</strong>
        </div>
       
      </div>
    </div>
    <div class="wrong-list">
      <div class="wrong-list__item" @click="doexam">
        <div class="wrong-list__title">{{categoryname.join('、') || '错题集'}}</div>
        <div class="wrong-list__num">{{errorobj.error_num}}</div>
      </div>
    </div>
    <div
      class="clearall-button"
      :class="errorobj.error_num <= 0 && 'clearall-button--disabled'"
      @click="clearAll"
    >清空我的错题</div>
  </div>
</template>

<script>
import PaperMedal from "./PaperComponent/PaperMedal";
import { delAllTk, errorHome } from "@/api/exam";
export default {
  /**错题集 */
  name: "WrongEntry",
  components: {
    PaperMedal
  },
  data() {
    return {
      /**当前分类id */
      categoryid: this.$route.query.categoryid,
      errorobj: {},
      /**当前分类 */
      categoryname:[]
    };
  },
  methods: {
    doexam() {
      if (this.errorobj.error_num <= 0) {
        this.$toast("没有找到错题");
        return;
      }
      this.$router.push({
        path: "/exam/DoError",
        query: {
          categoryid: this.categoryid,
          type: 2
        }
      });
    },
    /**
     * 获取我的错题信息
     */
    getMyError() {
      errorHome({
        categoryid: this.categoryid
      }).then(res => {
        this.categoryname = res.categoryname
        this.errorobj = res;
      });
    },
    /**
     * 清除我的错题
     */
    clearAll() {
      if (this.errorobj.error_num > 0) {
        this.$confirm("确认清空错题记录吗").then(() => {
          delAllTk({
            type: 1,
            categoryid: this.categoryid
          }).then(res => {
            if (res.result === "success") {
              this.$toast("清除成功", "success");
              this.getMyError();
            }
          });
        });
      }
    }
  },
  activated() {
    this.categoryid = this.$route.query.categoryid;
    this.errorobj = {};
    this.getMyError();
    document.title = "查看答题情况";
  }
};
</script> 
<style scoped>
.wrong-entry {
  padding: 15px;
  background: #fff;
  box-sizing: border-box;
  text-align: center;
}
.wrong-entry-title {
  font-size: 14px;
  color: #3e4754;
  line-height: 24px;
}

.wrong-entry__entro {
  display: flex;
  justify-content: space-around;
  align-items: center;
  line-height: 30px;
  font-size: 14px;
}
.wrong-entry__btn--radius {
  border-radius: 20px;
  padding: 10px 20px;
}
.wrong-entry-n__mber p {
  margin: 10px 0;
}

.wrong-list {
  background: #fff;
  margin-top: 10px;
}
.wrong-list__item {
  padding: 12px 15px;
  font-size: 14px;
  position: relative;
  line-height: 22px;
  display: flex;
}
.wrong-list__title {
  flex: 1;
}
.wrong-list__num {
  color: #5185f7;
  background: url(../../assets/exam/exam_right.png) no-repeat 100% 50%;
  background-size: auto 10px;
  padding-right: 12px;
}
.clearall-button {
  height: 44px;
  line-height: 44px;
  background: #5185f7;
  color: #fff;
  text-align: center;
  font-size: 14px;
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  margin: 0 auto;
  width: 100%;
  max-width: 480px;
}
.clearall-button--disabled {
  opacity: 0.7;
  cursor: no-drop;
}
</style>
