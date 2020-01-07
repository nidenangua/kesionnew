<template>
    <div class="ks-tab">
        <ul>
            <li
                v-for="(name,i) in tabInfo.options"
                :key="i"
                :class="i == tabInfo.current && 'ks-color-primary'"
                @click="slideTab(i)"
            >
                <span>
                    <i class="ks-bg-primary ks-active__line" v-if="i == tabInfo.current"></i>
                    {{name}}
                </span>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
  name: "KsTab",
  props: {
    tabInfo:{
      type:Object,
      default(){
        return {
          current:0,
          options:[]
        }
      }
    }
  },
  methods: {
    slideTab(i) {
      this.tabInfo.current = i;
      let index = this.tabInfo.values ? this.tabInfo.values[i] : i;
      this.$emit("change", index);
    }
  }
};
</script>
<style scope>
.ks-tab ul {
  height: 40px;
  line-height: 40px;
  font-size: 14px;
  background: #fff;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  color: #666;
}
.ks-tab li {
  -webkit-box-flex: 1;
  -ms-flex: 1;
  flex: 1;
  text-align: center;
  position: relative;
}
.ks-tab li span {
  position: relative;
  display: inline-block;
}

.ks-tab li span .ks-active__line {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 2px;
  width: 100%;
}
</style>
