<template>
  <div class="ks-input-number" :class="disabled && 'ks-input-number--disabled'" :style="{'max-width':maxWidth}">
    <el-input
      ref="input"
      :placeholder="placeholder"
      :disabled="disabled"
      
      v-model="inputValue"
      @change="handleInputChange"
    />
    <span class="ks-input-number__unit" v-if="unit">{{unit}}</span>
  </div>
</template>
<script>
export default {
  name: "KsInputNumber",
  props: {
    /**文本值 */
    value: {
      type: [Number, String],
      default: ""
    },
    /**最小数 */
    min: {
      type: Number,
      default: 0
    },
    /**最大数 */
    max: Number,
    /**默认提示文字 */
    placeholder: {
      type: String,
      default: ""
    },
    /**保留小位数 */
    decimalPlaces: {
      type: Number,
      default: 0
    },
    /**单位 */
    unit: String,
    /**文本禁止输入 */
    disabled: Boolean,
    /**设置最大宽度 */
    maxWidth:{
      type:String,
      default:"140px"
    }
    
  },
  model: {
    prop: "value",
    event: "change"
  },
  data() {
    return {
      inputValue: this.value
    };
  },
  watch: {
    value(val) {
      this.inputValue = val;
      this.$emit("change", this.inputValue);
    }
  },
  methods: {
    /**
     * 处理文本值
     * @param {String} 当前文本值
     */
    handleInputChange(val) {
      if (val !== "") {
        let _val = parseFloat(val) || 0;
        _val = Math.max(_val, this.min);
        if (this.max) {
          _val = Math.min(_val, this.max);
        }
        this.inputValue = parseFloat(_val.toFixed(this.decimalPlaces));
        
      }

      /**更新值 */
      this.$emit("change", this.inputValue);
    },
    /**
     * 焦点事件
     */
    focus() {
      this.$refs.input.focus();
    }
  }
};
</script>
<style scoped>
.ks-input-number {
  max-width: 140px;
  position: relative;
}

.ks-input-number__unit {
  position: absolute;
  z-index: 1;
  top: 1px;
  width: 40px;
  height: auto;
  text-align: center;
  background: #f5f7fa;
  cursor: pointer;
  font-size: 13px;
  display: block;
  right: 1px;
  border-radius: 0 4px 4px 0;
  border-left: 1px solid #dcdfe6;
  line-height: 38px;
}
.ks-input-number--disabled {
  color: #999;
}
</style>

