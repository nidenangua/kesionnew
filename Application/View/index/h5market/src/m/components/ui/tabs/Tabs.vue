<template>
  <div class="ks-tabs">
    <div class="ks-tabs__header" :class="shadow ? 'ks-tabs__header--shadow' : ''">
      <div
        class="ks-tab__item"
        v-for="item in tabs"
        :key="item._uid"
        :class="item.name === activeName && 'active'"
        @click="slideTab(item.name)"
      >
        <span>
          <i class="ks-tab__info" v-if="item.info">{{item.info}}</i>
          <i class="ks-tab__active_line" v-if="item.name === activeName"></i>
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
  name: "KsTabs",
  props: {
    activeName:[String,Number],
    shadow:Boolean
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

<style lang="scss" scoped>

/*选项卡*/
.ks-tabs__header {
    height: 44px;
    line-height: 44px;
    font-size: 16px;
    background: #fff;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}
.ks-tabs__header--shadow{
  box-shadow:0px 2px 8px 0px rgba(60,76,139,0.08);
}
.ks-tab__item {
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    text-align: center;
    color: var(--auxiliary_text-color);
    position: relative;
}

.ks-tab__item span {
    position: relative;
    display: inline-block;
}

.ks-tab__info {
    position: absolute;
    right: -18px;
    top: 3px;
    height: 18px;
    line-height: 18px;
    background: var(--primary-color);
    color: #fff;
    font-size: 12px;
    font-style: normal;
    min-width: 10px;
    padding: 0 4px;
    border-radius: 18px;
}
.ks-tab__item.active{
  color:var(--primary_text-color)
}
.ks-tab__active_line {
    position: absolute;
    bottom: 5px;
    left: 0;
    right: 0;
    height: 3px;
    width: 80%;
    margin: 0 auto;
    border-radius: 3px;
    background: var(--primary-color);
}

</style>