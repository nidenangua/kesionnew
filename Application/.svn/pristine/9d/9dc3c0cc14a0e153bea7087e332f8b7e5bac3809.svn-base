<template>
  <div>
    <div class="course-item" @click="$emit('click')">
      <slot name="prepend"/>
      <div class="course-item__title ks-text-nowrap">{{item.title}}</div>
      <div class="course-item__desc">{{item.shortdesc}}</div>
      <ks-create-bg :ratio="9/16" :src="item.defaultpic">
        <div
          class="course-item__type"
          v-if="type === 'course'"
        >{{(item.courseType == 1 && '点播') || (item.courseType == 2 && '语音') || (item.courseType == 3 && '音频') || (item.courseType == 4 && '图文')}}</div>
        <div class="course-item__type" v-else-if="type === 'column'">专栏</div>
        <div class="course-item__type" v-else-if="type === 'live'">直播</div>
      </ks-create-bg>
    </div>
  </div>
</template>
<script>
export default {
  name: "CourseItem",
  props: ["item", "type"]
};
</script>
<style scoped>
.course-item {
  padding: 15px;
  position: relative;
  box-shadow: 0 1px 20px 0 #e4e8eb;
}
.course-item .ks-create-bg {
  border-radius: 0px;
}

.course-item__title {
  font-size: 18px;
  margin-top: 5px;
}
.course-item__desc {
  margin-bottom: 15px;
  line-height: 22px;
  height: 44px;
  overflow: hidden;
  margin-top: 10px;
  color: #999;
}

.course-item__type {
  width: 100%;
  height: 30px;
  line-height: 30px;
  text-align: right;
  background: rgba(0, 0, 0, 0.6);
  position: absolute;
  bottom: 0;
  left: 0;
  color: #fff;
  padding: 0 15px;
  box-sizing: border-box;
}
</style>


