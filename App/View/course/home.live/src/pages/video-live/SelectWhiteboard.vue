<template>
  <div class="select-whiteboard">
    <input
      class="select-whiteboard__input"
      v-model="whiteboardName"
      type="text"
      ref="whiteboardInput"
      placeholder="请输入白板名称"
    >
    <ul class="clearfix">
      <li
        @click="selectStyle(item.name,i)"
        v-for="(item,i) in styleList"
        :key="'item'+i"
        :class="selected === i && 'on'"
      >
        <div class="inner">
          <img :src="item.bg">
          <p>{{item.name}}</p>
        </div>
      </li>
    </ul>
    <div class="select-whiteboard__button" @click="sure">确认</div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      whiteboardName: "默认白板",
      selected: 0,
      styleList: [
        {
          bg: require("@/assets/video-live/bg1.jpg"),
          name: "默认"
        },
        {
          bg: require("@/assets/video-live/bg2.jpg"),
          name: "插画"
        },
        {
          bg: require("@/assets/video-live/bg3.jpg"),
          name: "科技"
        },
        {
          bg: require("@/assets/video-live/bg4.jpg"),
          name: "梦幻"
        },
        {
          bg: require("@/assets/video-live/bg5.jpg"),
          name: "卡通"
        },
        {
          bg: require("@/assets/video-live/bg6.jpg"),
          name: "水墨"
        }
      ]
    };
  },
  methods: {
    /**
     * 切换白板
     * @param {String} 白板名称
     * @param {Number} 索引值
     */
    selectStyle(name, i) {
      if (
        this.whiteboardName === "默认白板" ||
        this.whiteboardName === "插画白板" ||
        this.whiteboardName === "科技白板" ||
        this.whiteboardName === "梦幻白板" ||
        this.whiteboardName === '卡通白板' ||
        this.whiteboardName === '水墨白板'
      ){
        this.whiteboardName = name+'白板'
      }
      this.selected = i;
    },
    /**
     * 确认
     */
    sure() {
      if (!this.whiteboardName) {
        this.$refs.whiteboardInput.focus();
        this.$layer.msg("请输入白板名称");
        return;
      }
      this.$parent.addWhiteboardFile(
        this.styleList[this.selected].bg,
        this.whiteboardName
      );
      this.$parent.$layer.closeAll();
    }
  }
};
</script>
<style scoped>
.select-whiteboard {
  padding-bottom: 78px;
}
.select-whiteboard__input {
  height: 40px;
  line-height: 40px;
  margin: 20px;
  border: 1px solid #ddd;
  width: 300px;
  border-radius: 4px;
  padding: 0 15px;
}

.select-whiteboard li {
  width: 25%;
  float: left;
}
.select-whiteboard .inner {
  margin: 10px;
  text-align: center;
  cursor: pointer;
}
.select-whiteboard li img {
  width: 100%;
  display: block;
  border: 1px solid #e6e6e6;
}
.select-whiteboard li p {
  font-size: 14px;
  line-height: 34px;
}
.select-whiteboard .on {
  color: #e6412c;
}
.select-whiteboard .on img {
  border: 1px solid #e6412c;
}
.select-whiteboard__button {
  width: 90px;
  height: 38px;
  background: #4687fa;
  color: #fff;
  text-align: center;
  line-height: 38px;
  font-size: 14px;
  border-radius: 4px;
  cursor: pointer;
  position: absolute;
  bottom: 20px;
  left: 50%;
  margin-left: -45px;
}
</style>

