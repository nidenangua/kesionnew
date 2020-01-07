<template>
  <div>
    <div class="paper__answer-area" v-for="(gap,index) in item.tkinfo.answer" :key="index">
      <span>
        答题区{{index+1}}:
        <input
          type="text"
          class="paper__option-input"
          v-model="gap.options"
          @blur="submitAnswer(item)"
        >
      </span>
    </div>
  </div>
</template>
<script>
export default {
  /**填空题 */
  name: "FillBlanks",
  props: {
    /**题目对象 */
    item:{
      type:Object,
      default(){
        return {}
      }
    }
  },
  methods: {
    submitAnswer(arr) {
      this.$emit("callback", arr);
    }
  }
};
</script> 
<style scoped>
.paper__header {
  display: flex;
  align-items: center;
  padding: 15px;
  border-bottom: 1px solid #eee;
}
.paper__header-second,
.paper__header-day {
  font-size: 13px;
  color: #525b67;
  padding-right: 10px;
}
.paper__header-day {
  display: flex;
  flex: 2;
}
.paper__header-card {
  padding-right: 15px;
}
.paper__header-card img {
  width: 20px;
  margin-top: 2px;
}
.paper__header-sumbit {
  padding: 5px 20px;
  background: #5185f7;
  color: #fff;
  font-size: 12px;
  border-radius: 2px;
}
.paper__contianer {
  padding: 20px 15px;
}
.paper__contianer-title {
  font-size: 14px;
  color: #3e4754;
  line-height: 24px;
}
.paper__option,
.paper__answer-area {
  margin: 20px 0;
  line-height: 32px;
  color: #3e4754;
  font-size: 14px;
}
.paper__option span {
  width: 32px;
  height: 32px;
  text-align: center;
  font-size: 15px;
  color: #3e4754;
  display: inline-block;
  border-radius: 50%;
  border: 1px solid #e5e7eb;
  margin-right: 20px;
}
.paper__opear {
  float: right;
}
.paper__sign {
  display: inline-block;
}
.paper__sign img {
  width: 11px;
  padding-right: 5px;
  position: relative;
  top: 2px;
}
.paper__collect {
  display: inline-block;
  margin-left: 10px;
}

.paper__collect img {
  width: 11px;
  padding-right: 5px;
}
.paper__contianer {
  position: relatives;
}
.actived {
  background: #5185f7;
  color: #fff !important;
}
.signed,
.collected {
  color: #5185f7;
}
.paper__option-textarea {
  display: block;
  resize: vertical;
  padding: 5px 15px;
  line-height: 1.5;
  box-sizing: border-box;
  width: 100%;
  height: 10rem;
  font-size: inherit;
  color: #606266;
  background-color: #fff;
  background-image: none;
  border: 1px solid #dcdfe6;
  border-radius: 4px;
  transition: border-color 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
  margin: 10px 0;
}
.paper__option-input {
  margin-left: 10px;
  height: 30px;
  line-height: 30px;
  border: 0px;
  border-bottom: 1px solid #eee;
  font-size: 14px;
  width: 75%;
}
.bg-white {
  background: #fff;
}
</style>

