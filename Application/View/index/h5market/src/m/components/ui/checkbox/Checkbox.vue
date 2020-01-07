<template>
    <div class="ks-checkbox-outer">
        <div class="ks-checkbox" @click="change" :class="checked && 'ks-checked'">
            <i class="ks-icon ks-icon-checkmark-outline" v-if="checked"></i>
        </div>
        <slot />
    </div>
</template>
<script>
export default {
  name: "KsCheckbox",
  props: {
    checked: Boolean
  },
  model: {
    prop: "checked",
    event: "change"
  },
  methods: {
    change() {
      let v = this.checked ? false : true;
      this.$emit("change", v);
    }
  }
};
</script>
<style lang="scss" scoped>
.ks-checkbox-outer{
    display: inline-block;
}
.ks-checkbox {
  width: 14px;
  height: 14px;
  display: inline-block;
  overflow: hidden;
  background: #ccc;
  border-radius: 3px;
  border: 1px solid #e3e3e3;
  background: none;
  text-align: center;
  line-height: 14px;
  vertical-align: middle;
}
.ks-checkbox.ks-checked {
  background: var(--primary-color);
  border: 1px solid var(--primary-color);
}
.ks-checkbox.ks-checked .ks-icon {
  color: #fff;
  font-size: 14px;
}
</style>

