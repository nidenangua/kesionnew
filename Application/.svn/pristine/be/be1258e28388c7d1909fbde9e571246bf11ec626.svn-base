<template>
  <div>
    <div class="upload-text clearfix">
      <el-button @click="upload">本地文件上传</el-button>
      <span class="ks-ml15">建议尺寸：64*64</span>
    </div>
    <el-tabs v-model="activeName" class="ks-mt15">
      <el-tab-pane
        class="select-icon-list"
        :label="name"
        :name="name"
        v-for="(name,index) in folders"
        :key="index"
      >
        <ul>
          <li
            v-for="(item,index) in list[name]"
            :key="index"
            :class="current == index && 'active'"
            @click="current = index"
          >
            <div class="icon">
              <img :src="item.src">
              <p>{{item.name}}</p>
            </div>
          </li>
        </ul>
      </el-tab-pane>
    </el-tabs>

    <div align="center" class="ks-mt20">
      <el-button @click="cancel">取 消</el-button>
      <el-button type="primary" @click="sure">确 定</el-button>
    </div>
  </div>
</template>
<script>
import { getSysIcoList } from "@/api/drag";
export default {
  name: "SelectIcon",
  data() {
    return {
      activeName: null,
      current: null,
      folders: [],
      list: {}
    };
  },
  methods: {
    sure(src) {
      let selectedSrc = this.list[this.activeName][this.current].src;
      this.$emit("sure", selectedSrc);
    },
    cancel() {
      this.$emit("cancel");
    },
    upload() {
      this.$uploadImages(info => {
        this.$emit("sure", info.defaultpic);
      });
    }
  },
  mounted() {
    getSysIcoList().then(res => {
      let _folders = Object.keys(res);
      this.folders = _folders;
      this.activeName = this.folders[0];
      this.list = res;
    });
  }
};
</script>
<style scoped>
.upload-text {
  line-height: 40px;
  color: #999;
}
.select-icon-list {
  height: 220px;
  overflow-y: auto;
}
.select-icon-list li {
  width: 16.6%;
  float: left;
}
.select-icon-list li .icon {
  text-align: center;
  border: 1px solid #eee;
  margin: 5px;
  padding: 10px;
  cursor: pointer;
  transition: 0.3s;
  border-radius: 3px;
}
.select-icon-list li .icon:hover,
.select-icon-list li.active .icon {
  border: 1px solid #e5412c;
  color: #e5412c;
}
.select-icon-list li .icon img {
  height: 44px;
  display: block;
  margin: 0 auto;
}
.select-icon-list li p {
  display: block;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  line-height: 34px;
}
</style>


