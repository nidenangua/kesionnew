<template>
  <div class="material-item" v-if="list" @click="$emit('click')">
    <slot name="prepend"/>
    <div
      v-for="(child,index) in list"
      :key="child.id"
      :class="index === 0 ? 'material-item__first_child' : 'material-item__child'"
    >
      <ks-create-bg :ratio="9/16" :src="child.thumb_url" v-if="index === 0"/>
      <ks-create-bg :src="child.thumb_url" v-else/>
      <div
        :class="index === 0 ? 'material-item__first_child__title' : 'material-item__child__title'"
      >
        <span>{{child.title}}</span>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "MaterialItem",
  props: ["list"]
};
</script>
<style scoped>
.material-item {
  position: relative;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
}

.material-item__first_child {
  position: relative;
}
.material-item__first_child__title {
  position: absolute;
  bottom: 0;
  width: 100%;
  left: 0;
  background: rgba(0, 0, 0, 0.6);
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
}
.material-item__first_child__title span,
.material-item__child_title span {
  display: block;
  max-height: 40px;
  line-height: 20px;
  overflow: hidden;
  margin: 0 15px;
}

.material-item__child {
  height: 60px;
  position: relative;
  height: 60px;
  padding: 15px 75px 15px 15px;
}
.material-item__child_title {
  font-size: 14px;
  line-height: 20px;
  height: 60px;
  overflow: hidden;
}
.material-item__child .ks-create-bg {
  width: 60px;
  height: 60px;
  position: absolute;
  right: 15px;
  top: 15px;
  border-radius: 0px;
}
</style>

