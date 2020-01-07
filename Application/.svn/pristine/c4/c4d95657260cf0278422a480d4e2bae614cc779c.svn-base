<template>
    <div class="question-title">
        <div class="question-title__type">{{typeName.replace('题','')}}</div>
        <div class="question-title__cont" v-html="title"></div>
    </div>
</template>
<script>
export default {
    name:'QuestionTitle',
    props:{
        /**题目类别 */
        typeName:String,
        /**题目标题 */
        title:String
    }
}
</script>
<style scoped>
.question-title {
  font-size: 16px;
  color: #3e4754;
  line-height: 1.6;
  display: flex
}
.question-title__type{
    display: inline-block;
    padding:1px 6px;
    height: 16px;
    line-height: 16px;
    font-size: 10px;
    overflow: hidden;
    position: relative;
    top:4px;
    margin-right: 10px;
    background: #80c269;
    border-radius: 20px 20px 0 20px;
    color:#fff;

}
.question-title__cont{
    display: inline-block;
    flex: 1
}

</style>
