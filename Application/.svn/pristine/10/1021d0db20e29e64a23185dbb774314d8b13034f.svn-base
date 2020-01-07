<template>
  <div>
    <div class="form-row clearfix">
      <div class="name">标题</div>
      <div class="form-limit">
        <input type="text" v-model="managementData.title.name" class="form-textbox">
      </div>
    </div>
    <div class="form-row clearfix">
      <div class="name">
        标题链接设置
        <span class="add-btn" @click="addMoreClass()">+</span>
      </div>
      <div class="more-text" v-for="(item,i) in managementData.title.more" :key="i">
        <div class="ks-bt ks-link-bt fr" @click="$selectLink(item)"></div>
        <div class="ks-bt ks-del-bt" @click="deleteMoreClass(i)"></div>
        <input
          type="text"
          class="form-textbox"
          style="width:110px;"
          v-model="item.text"
          placeholder="链接文字"
        >
        <input
          type="text"
          class="form-textbox"
          style="width:210px; padding-right:45px;"
          placeholder="链接地址"
          v-model="item.url"
        >
      </div>
    </div>
  </div>
</template>
<script>
import { domap, cloneData, deleteArray } from "@/utils";
export default {
  name: "Title",
  props: ["managementData"],
  methods: {
    /**
     * 添加导航栏目
     */
    addMoreClass() {
      if (this.managementData.title.more.length > 2) {
        this.$msg("为了美观，限制最多可设置3个标题导航");
        return false;
      }
      let more = cloneData(this.managementData.title.more);
      more.push({
        text: "链接文字",
        url: "#"
      });
      this.managementData.title.more = more;
    },
    /**
     * 删除导航栏目
     */
    deleteMoreClass(index) {
      this.managementData.title.more = deleteArray(
        this.managementData.title.more,
        index
      );
    }
  },
  mounted() {
    /**
     * 初始化标题配置
     */
    let title = cloneData(this.managementData.title);
    title.name = title.name || "";
    title.more = title.more || [];
    this.managementData.title = title;
  }
};
</script>
<style scoped>
.more-text {
  position: relative;
  padding-right: 30px;
  margin-top: 10px;
}
.more-text .ks-del-bt {
  position: absolute;
  right: 0;
}
.more-text .ks-link-bt {
  position: absolute;
  right: 38px;
  top: 1px;
  height: 32px;
  line-height: 32px;
  border: 0px;
  border-left: 1px solid #e0e0e0;
  border-radius: 0px;
}
.add-btn {
  width: 24px;
  height: 24px;
  border: 1px solid #e0e0e0;
  text-align: center;
  line-height: 24px;
  border-radius: 4px;
  cursor: pointer;
  margin: 5px 0 0 10px;
  display: inline-block;
}
.add-btn:hover {
  color: #e5412c;
  border: 1px solid #e5412c;
}
</style>
