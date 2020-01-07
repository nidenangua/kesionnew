<template>
  <div>
       <textarea
        v-model="item.useranswer"
        class="short-answer"
        placeholder="请输入答案"
        @blur="handleBlur"
      ></textarea>
  </div>
</template>

<script>
export default {
  name: "ShortAnswer",
  props:{
    /**题目对象 */
    item:{
      type:Object,
      default(){
        return {}
      }
    }
  },
  methods: {
    handleBlur(){
      this.$emit("callback", this.item);
    }
  },
};
</script> 
<style scoped>
.short-answer {
  display: block;
  position: static !important;
  resize: vertical;
  padding: 10px 15px;
  line-height: 1.5;
  box-sizing: border-box;
  width: 100%;
  height: 10rem;
  font-size: 14px;
  color: #606266;
  background-color: #fff;
  background-image: none;
  border: 1px solid #dcdfe6;
  border-radius: 4px;
  transition: border-color 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
  margin-top:10px;
}
.short-answer:focus{
  border: 1px solid #9fb9f3;
}
</style>

