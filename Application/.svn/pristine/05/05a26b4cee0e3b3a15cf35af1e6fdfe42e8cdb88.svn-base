<template>
  <div v-if="item.tkinfo">
    <div class="multiple-choice" v-if="item.tktype == 2 || item.tktype == 3">
      <div class="multiple-choice__item" v-for="(option,index) in item.tkinfo.content" :key="index">
        <!--单选、多选-->
        <div
          class="multiple-choice__inner"
          :class="isRight(item,letters[index])"
          @click="mult(item,letters[index])"
        >
          <div class="multiple-choice__letter">{{letters[index]}}</div>
          <div class="multiple-choice__option" v-html="option"></div>
        </div>
      </div>
    </div>
    <div class="multiple-choice" v-else-if="item.tktype == 4">
      <!--判断题-->
      <div class="multiple-choice__item">
        <div class="multiple-choice__inner" @click="mult(item,'1')" :class="isRight(item,'1')">
          <div class="multiple-choice__letter">A</div>正确
        </div>
      </div>
      <div class="multiple-choice__item">
        <div class="multiple-choice__inner" @click="mult(item,'0')" :class="isRight(item,'0')">
          <div class="multiple-choice__letter">B</div>错误
        </div>
      </div>
    </div>
  </div>
</template>

<script>
/**letters 来自examMixins*/
import examMixins from "@/mixins/exam";
export default {
  name: "MultipleChoice",
  props: {
    /**题目对象 */
    item: {
      type: Object
    },
    /**是否是组合题 */
    isCombinationQuestion: {
      type: Boolean,
      default: false
    },
    /**单选回答内容 */
    aloneAnswer: {
      type: String,
      default: ""
    },
    /**多选回答内容 */
    userAnswer: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  data() {
    return {
      /**单选选择 */
      aloneActived: this.userAnswer.toString(),
      /**多选选择 */
      multipleActived: this.userAnswer
    };
  },
  mixins: [examMixins],
  methods: {
    /**
     * 是否选中
     * @param {String} 选项值，字母
     */
    isActived(option) {
      let is = false;
      this.selected.map(letter => {
        if (letter === option) {
          is = true;
        }
      });
      return is;
    },
    /**
     * 选修点击
     * @param {Object} 题目对象
     * @param {String} 选项值，字母
     */
    mult(item, option) {
      /**changeAnswer 为false 禁止作答 */
      if (item.changeAnswer === false) {
        return;
      }
      if (item.tktype == 2 || item.tktype == 4) {
        this.aloneActived = this.aloneActived === option ? "" : option;
        this.$emit(
          "change",
          item,
          [this.aloneActived],
          this.isCombinationQuestion
        );
      } else if (item.tktype == 3) {
        let selected = [];
        if (this.multipleActived.length) {
          let isRepeat = false;
          this.multipleActived.map(letter => {
            if (letter === option) {
              isRepeat = true;
            } else {
              selected.push(letter);
            }
          });
          if (!isRepeat) {
            selected.push(option);
          }
        } else {
          selected.push(option);
        }
        this.multipleActived = selected;
        this.$emit(
          "change",
          item,
          this.multipleActived,
          this.isCombinationQuestion
        );
      }
    },

    /**
     * 判断题是否正确
     * @param {Object} 题目对象
     * @param {String} 当前选项值
     */
    isRight(item, option) {
      if (item.showAnswerStatus) {
        if (item.tktype == 2 || item.tktype == 4) {
          let answer = item.tkinfo.answer.toString();
          if (this.aloneActived === option) {
            return answer === option ? "right" : "error";
          } else if (this.aloneActived !== "") {
            return answer === option ? "right" : "";
          }
        } else if (item.tktype == 3) {
          let answer = item.tkinfo.answer;
          if (this.multipleActived.includes(option)) {
            return answer.includes(option) ? "right" : "error";
          } else if (this.multipleActived.length) {
            return answer.includes(option) ? "miss" : "";
          }
        }
      } else {
        if (item.tktype == 2 || item.tktype == 4) {
          return this.aloneActived === option ? "done" : "";
        } else if (item.tktype == 3) {
          return this.multipleActived.includes(option) ? "done" : "";
        }
      }
    }
  }
};
</script> 
<style scoped>
.multiple-choice {
  margin-top: 10px;
}
.multiple-choice__inner {
  padding: 10px 0;
  line-height: 28px;
  color: #3e4754;
  font-size: 14px;
  display: flex;
  align-items: center;
}
.multiple-choice__letter {
  width: 28px;
  height: 28px;
  text-align: center;
  font-size: 15px;
  color: #3e4754;
  border-radius: 50%;
  border: 1px solid #e5e7eb;
  margin-right: 15px;
  background-size: 24px;
  background-repeat: no-repeat;
  background-position: 50% 50%;
}
.multiple-choice__option img{
  max-width: 80%;
}

/*回答样式*/
.right {
  color: #80c269;
}
.right .multiple-choice__letter {
  background-color: #80c269;
  border: 1px solid #80c269;
  color: #fff;
  text-indent: 64px;
  background-image: url(../../../assets/exam/checkmark.png);
}
.error {
  color: #f95d5d;
}
.error .multiple-choice__letter {
  background-color: #f95d5d;
  border: 1px solid #f95d5d;
  color: #fff;
  text-indent: 64px;
  background-image: url(../../../assets/exam/close.png);
}
.miss {
  color: #80c269;
  position: relative;
}
.miss .multiple-choice__letter {
  background-color: #80c269;
  border: 1px solid #80c269;
  color: #fff;
  text-indent: 64px;
  position: relative;
  overflow: hidden;
  background-image: url(../../../assets/exam/checkmark.png);
}
.miss::after {
  content: "漏选";
  color: #80c269;
  position: absolute;
  background: #fff;
  border: 1px solid #80c269;
  line-height: 1;
  border-radius: 15px;
  padding: 1px 0;
  width: 28px;
  text-align: center;
  left: 10px;
  top: 3px;
  font-size: 10px;
}
.done .multiple-choice__letter {
  background-color: #5185f7;
  border: 1px solid #5185f7;
  color: #fff;
}
</style>

