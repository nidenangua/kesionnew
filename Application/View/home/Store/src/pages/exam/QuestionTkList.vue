<template>
  <ks-container>
    <ks-title name="考试系统" border="none"></ks-title>
    <question-list/>
  </ks-container>
</template>
<script>
import QuestionList from "./QuestionList";
export default {
  name: "QuestionTkList",
  data() {
    return {};
  },
  components: {
    QuestionList
  }
};
</script>


