<template>
  <div class="ks-tabs">
    <div class="ks-tabs__header">
      <div
        class="ks-tab__item"
        v-for="item in tabs"
        :key="item._uid"
        :class="item.name === activeName && 'active'"
        :style="{width:average > 0 ? `${100/average}%` : ''}"
        @click="slideTab(item.name)"
      >
        <span>
          <i class="ks-tab__info" v-if="item.info">{{item.info}}</i>
          {{item.label}}
        </span>
      </div>
    </div>
    <div class="ks-tabs-content">
      <slot/>
    </div>
  </div>
</template>
<script>
export default {
  name: "Tabs",
  props: {
    /**按百分比分开 */
    average:{
      type:Number,
      default:0
    },
    activeName:[String,Number]
  },
  data() {
    return {
      tabs: []
    };
  },

  model: {
    prop: "activeName",
    event: "change"
  },
  methods: {
    slideTab(name) {
      this.$emit("change", name);
      this.$emit("tab-click", name);
    },
    setTabs() {
      let tabs = [];
      this.$children.map(child => {
        tabs.push({
          _uid: child._uid,
          label: child.label,
          name: child.name,
          info: child.info
        });
      });
      this.tabs = tabs;
    }
  },
  mounted() {
    this.setTabs();
  }
};
</script>

