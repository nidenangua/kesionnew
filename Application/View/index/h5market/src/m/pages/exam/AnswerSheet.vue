<template>
  <div class="answer-sheet" :style="{height:answerSheetHeight+'px'}" v-show="visible">
    <div class="answer-sheet__body">
      <div class="answer-sheet__answer">
        <div
          class="answer-sheet__answer-item"
          v-for="(item,i) in answerSheet"
          :key="i"
          @click="skipTm(item.bindSwiperIndex)"
          :class="{active:item.answered,signed:item.sign}"
        >{{item.num}}</div>
      </div>
      <div class="answer-sheet__opear">
        <div class="answer-sheet__sign answer-sheet__sign--color1">
          <i></i>已做
        </div>
        <div class="answer-sheet__sign answer-sheet__sign--color3">
          <i></i>未做
        </div>
        <div class="answer-sheet__sign answer-sheet__sign--color4">
          <i></i>标记
        </div>
      </div>
    </div>
    <div class="answer-sheet__submit" @click="$emit('update:visible',false)">确定</div>
  </div>
</template>
<script>
export default {
  name: "answersheet",
  props: {
    /**答题卡显示开关 */
    visible: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      answerSheetHeight:window.innerHeight - 57,
      /**题数集合 */
      answerSheet: []
    };
  },
  activated() {
    this.answerSheet = [];
  },
  methods: {
    reset(params) {
      this.answerSheet = params.answerList;
    },
    skipTm(index) {
      this.$emit("callback", index);
    },
    submit() {
      this.$emit("submit");
    }
  }
};
</script> 
<style scoped>
.answer-sheet {
  background: #fff;
  position: fixed;
  width: 100%;
  height: 100%;
  left: 0;
  right: 0;
  margin: 0 auto;
  max-width: 480px;
  top:57px;
  z-index: 99;
  overflow-y: auto;
  overflow-x: hidden;
}
.answer-sheet__body {
  padding: 20px 15px;
  box-sizing: border-box;
}

.answer-sheet__answer {
  display: flex;
  flex-wrap: wrap;
}
.answer-sheet__answer-item {
  width: 45px;
  height: 45px;
  line-height: 45px;
  border-radius: 50%;
  border: 1px solid #5185f7;
  color: #5185f7;
  text-align: center;
  font-size: 15px;
  margin: 10px;
}
.answer-sheet__submit {
  line-height: 51px;
  text-align: center;
  background: #5185f7;
  color: #fff;
  width: 100%;
  font-size: 16px;
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  margin:0 auto;
  z-index: 100;
  max-width: 480px;

}
.answer-sheet__sign {
  display: inline-block;
  padding-left: 20px;
  font-size: 15px;
  color: #8f8f8f;
  position: relative;
  margin:0 10px;
}
.answer-sheet__sign i {
  position: absolute;
  left: 0;
  top: 3px;
  width: 14px;
  height: 14px;
  display: block;
  border-radius: 50%;
}
.answer-sheet__sign--color1 i {
  background: #5185f7;
}
.answer-sheet__sign--color2 i {
  background: #ed7c78;
}
.answer-sheet__sign--color3 i {
  background: #fff;
  border: 1px solid #dcdcdc;
}
.answer-sheet__sign--color4 i {
  background: #dcdcdc;
}
.answer-sheet__opear {
  padding-right: 20px;
  margin-top:10px;
  text-align: right;
}

.active {
  background: #5185f7;
  color: #fff;
}
.signed {
  background: #dcdcdc;
  border-color: #dcdcdc;
  color: #8f8f8f;
}
</style>
