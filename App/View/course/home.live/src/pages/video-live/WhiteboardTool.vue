<template>
  <div>
    <div class="whiteboard-tool">
      <div
        class="whiteboard-tool__item"
        :class="tool === 'grab' && 'on'"
        @click="slideTool('grab')"
      >
        <i class="iconfont icon-zhuashou"></i>
      </div>
      <!-- <div
        class="whiteboard-tool__item"
        style=" cursor: no-drop;"
        :class="tool === 'text' && 'on'"
        @click="slideTool('text')"
      >
        <i class="iconfont icon-wenzi1"></i>
      </div> -->
      <div class="whiteboard-tool__item" :class="tool === 'pen' && 'on'" @click="slideTool('pen')">
        <i class="iconfont icon-pencil-copy"></i>
      </div>
      <div
        class="whiteboard-tool__item"
        :class="tool === 'eraser' && 'on'"
        @click="slideTool('eraser')"
      >
        <i class="iconfont icon-xiangpica"></i>
      </div>
      <div class="whiteboard-tool__item" @click="slideTool('clear')">
        <i class="iconfont icon-shanchu_o"></i>
      </div>
      <div class="whiteboard-tool__item" @click="$stop($event);isShowSelectColorBox = true">
        <i class="whiteboard-tool__color" :style="{backgroundColor:'#'+color}"></i>
      </div>
    </div>
    <transition name="fade-left">
      <div class="whiteboard-tool__select-color" v-show="isShowSelectColorBox" @click="$stop($event);">
        <div class="whiteboard-tool__name">选择粗细</div>
        <div class="whiteboard-tool__size-list">
          <span
            v-for="(size,i) in penSize"
            :key="'item'+i"
            :class="size === pen && 'on'"
            @click="$emit('update:pen',size)"
          >
            <i
              :style="{width:size+'px',height:size+'px',marginTop:-size/2+'px',marginLeft:-size/2+'px'}"
            ></i>
          </span>
        </div>
        <div class="whiteboard-tool__name">选择颜色</div>
        <div class="whiteboard-tool__color-list">
          <span
            v-for="(color,i) in colorList"
            :key="'item'+i"
            @click="$emit('update:color',color)"
            :style="{backgroundColor:'#'+color}"
          ></span>
        </div>
      </div>
    </transition>
  </div>
</template>
<script>
export default {
  /**白板工具 */
  name: "WhiteboardTool",
  props: {
    /**当前选择的工具 */
    tool: String,
    /**当前画笔颜色 */
    color:{
      type:String,
      default:'ff0000'
    },
    /**当前画笔粗细 */
    pen:{
      type:Number,
      default:4
    }
  },
  data() {
    return {
      /**是否显示画笔颜色选择盒子 */
      isShowSelectColorBox: false,
      /**画笔粗细的可选择列表 */
      penSize: [4, 8, 12, 16],
      /**画笔可选择颜色列表 */
      colorList: [
        "000000",
        "002d00",
        "015b00",
        "028e01",
        "03c501",
        "06ff02",
        "2d0000",
        "2d2d00",
        "2d5b00",
        "2d8e01",
        "2dc501",
        "2eff02",
        "5b0000",
        "5b2d00",
        "5b5b00",
        "5b8e01",
        "5bc501",
        "5cff02",
        "00002d",
        "002d2d",
        "015b2d",
        "028e2d",
        "03c52d",
        "05ff2d",
        "2d002d",
        "2d2d2d",
        "2d5b2d",
        "2d8e2d",
        "2dc52d",
        "2eff2d",
        "5b002d",
        "5b2d2d",
        "5b5b2d",
        "5b8e2d",
        "5bc52d",
        "5cff2d",
        "00015b",
        "002d5b",
        "005b5b",
        "018e5b",
        "02c55b",
        "05ff5b",
        "2d015b",
        "2d2d5b",
        "2d5b5b",
        "2d8e5b",
        "2dc55b",
        "2eff5b",
        "5b005b",
        "5b2d5b",
        "5b5b5b",
        "5b8e5b",
        "5bc55b",
        "5cff5b",
        "00038e",
        "002d8e",
        "005b8e",
        "008ec5",
        "01c58e",
        "03ff8e",
        "2c038e",
        "2d2d8e",
        "2d5b8e",
        "2d8e8e",
        "2dc58e",
        "2dff8e",
        "5b028e",
        "5b2d8e",
        "5b5b8e",
        "5b8e8e",
        "5bc58e",
        "5bff8e",
        "0005c5",
        "002ec5",
        "005bc5",
        "008ec5",
        "00c5c5",
        "01ffc5",
        "2c05c5",
        "2c2ec5",
        "2c5bc5",
        "2c8ec5",
        "2cc5ff",
        "2dffc5",
        "5b04c5",
        "5b2ec5",
        "5b5bc5",
        "5b8ec5",
        "5bc5c5",
        "5bffc5",
        "0009ff",
        "002eff",
        "005cff",
        "008fff",
        "00c5ff",
        "00ffff",
        "2c08ff",
        "2c2eff",
        "2c2eff",
        "2c8fff",
        "2cc5ff",
        "2dffff",
        "5b08ff",
        "5b2eff",
        "5b5cff",
        "5b8fff",
        "5bc5ff",
        "5bffff",
        "8e002d",
        "8e2d00",
        "8e5b01",
        "8e8e01",
        "8fc502",
        "8fff03",
        "c50001",
        "c52c01",
        "c55b01",
        "c58e01",
        "c5c502",
        "c5ff03",
        "ff0001",
        "ff2c01",
        "ff5b01",
        "ff8e02",
        "ffc502",
        "ffff03",
        "8e002d",
        "8e2d2d",
        "8e5b2d",
        "8e8e2d",
        "8fc52d",
        "8fff2d",
        "c5002d",
        "c52c2d",
        "c55b2d",
        "c58e2d",
        "c5c52d",
        "c5ff2d",
        "ff002d",
        "ff2c2d",
        "ff5b2d",
        "ff8e2d",
        "ffc52d",
        "ffff2d",
        "8e005b",
        "8e2d5b",
        "8e5b5b",
        "8e8e5b",
        "8fc55b",
        "8fff5b",
        "c5005b",
        "c52c5b",
        "c55b5b",
        "c58e5b",
        "c5c55b",
        "c5ff5b",
        "ff005b",
        "ff2c5b",
        "ff5b5b",
        "ff8e5b",
        "ffc55b",
        "ffff5b",
        "8e018e",
        "8e2d8e",
        "8e5b8e",
        "8e8e8e",
        "8ec58e",
        "8fff8e",
        "c5008e",
        "c52d8e",
        "c55b8e",
        "c58e8e",
        "c5c58e",
        "c5ff8e",
        "ff008e",
        "ff2c8e",
        "ff5b8e",
        "ff8e8e",
        "ff8e8e",
        "ffff8e",
        "8e03c5",
        "8e2dc5",
        "8e5bc5",
        "8e8ec5",
        "8ec5c5",
        "8effc5",
        "c502c5",
        "c52dc5",
        "c55bc5",
        "c58ec5",
        "c5c5c5",
        "c5ffc5",
        "ff00c5",
        "ff2dc5",
        "ff5bc5",
        "ff8ec5",
        "ffc5c5",
        "ffffc5",
        "8e07ff",
        "8e2eff",
        "8e5cff",
        "8e8fff",
        "8ec5ff",
        "8effff",
        "c505ff",
        "c52eff",
        "c55bff",
        "c58eff",
        "c5c5ff",
        "c5ffff",
        "ff03ff",
        "ff2dff",
        "ff5bff",
        "ff8eff",
        "ffc5ff",
        "ffffff"
      ]
    };
  },
  mounted(){
      document.addEventListener('click',e=>{
          this.isShowSelectColorBox = false
      })
  },
  methods: {
    /**
     * 切换画布工具
     * @param {String} 画布工具名称
     */
    slideTool(name) {
      this.$emit("change", name);
    }
  }
};
</script>
<style scoped>
.whiteboard-tool {
  background: rgba(0, 0, 0, 0.3);
  border-radius: 4px;
  overflow: hidden;
  width: 50px;
  position: absolute;
  right: 30px;
  top: 50%;
  margin-top: -150px;
}

.whiteboard-tool__color {
  width: 18px;
  height: 18px;
  position: absolute;
  left: 50%;
  top: 50%;
  margin-top: -9px;
  margin-left: -9px;
}
.whiteboard-tool__item {
  width: 50px;
  height: 50px;
  display: block;
  text-align: center;
  line-height: 50px;
  cursor: pointer;
  color: #fff;
  position: relative;
}
.whiteboard-tool__item:hover,
.whiteboard-tool__item.hover,
.whiteboard-tool__item.on {
  background: rgba(0, 0, 0, 0.5);
}
.whiteboard-tool__item i {
  font-size: 20px;
}

.whiteboard-tool__select-color {
  width: 240px;
  height: 270px;
  background: #373f4e;
  position: absolute;
  border-radius: 4px;
  right: 90px;
  top: 50%;
  margin-top: -135px;
  text-align: left;
  padding: 10px;
  z-index: 9;
  line-height: 22px;
}
.whiteboard-tool__name {
  margin-bottom: 10px;
  color: #fff;
}
.whiteboard-tool__size-list {
  height: 50px;
}
.whiteboard-tool__size-list span {
  width: 30px;
  height: 30px;
  float: left;
  margin: 0 10px;
  box-sizing: border-box;
  position: relative;
}
.whiteboard-tool__size-list .on {
  border: 1px solid #e6412d;
}
.whiteboard-tool__size-list i {
  background: #fff;
  border-radius: 50%;
  position: absolute;
  left: 50%;
  top: 50%;
}
.whiteboard-tool__color-list span {
  width: 12px;
  height: 12px;
  float: left;
  border: 1px solid #1f242a;
  margin: -1px -1px 0 0;
}
</style>

