<template>
  <div class="select-file">
    <div class="select-file__body">
      <div v-if="fileList.length">
        <div align="right">
          <div class="ks-button ks-button--medium ks-button--plain" @click="uploadFile">
          上传{{fileType | getTypeName}}
        </div>
        </div>
        <div class="ks-row select-file__rowhead">
          <div class="ks-col-18">标题</div>
          <div class="ks-col-6">文件大小</div>
        </div>
        <div
          class="ks-row select-file__row"
          @click="selected = selected == item.id ? 0 : item.id"
          :class="selected == item.id && 'selected'"
          v-for="item in fileList"
          :key="item.id"
        >
          <div class="ks-col-3" v-if="fileType === 'img'">
            <div class="ks-image">
              <img :src="item.file_path">
            </div>
          </div>
          <div class="ks-col-15" v-if="fileType === 'img'">{{item.title}}</div>
          <div class="ks-col-18 select-file__title" v-else-if="fileType === 'audio'">
            <img src="@/assets/data/file_music.png">
            {{item.title}}
          </div>
          <div class="ks-col-6">{{item.size}}</div>
        </div>
      </div>
      <div class="ks-empty" v-else-if="loaded">
        没有找到任何文件
        <div class="select-file__upload" v-if="!uploading">
          <div class="ks-button ks-button--primary" @click="uploadFile">上传{{fileType | getTypeName}}</div>
          <div class="select-file__limit" v-if="fileType === 'img'">限制文件大小2MB以内</div>
          <div class="select-file__limit" v-else-if="fileType === 'audio'">限制文件大小50MB以内</div>
        </div>
      </div>
      <div align="center" v-if="uploading">
        <div class="select-file__schedule">
          <div class="select-file__schedule--complete" :style="{width:complete+'%'}"></div>
        </div>
        <div class="select-file__file-name">正在上传：{{fileName}}</div>
      </div>
    </div>

    <div align="center" v-if="fileList.length">
      <div class="ks-button ks-button--primary" @click="sure">确定</div>
      <div class="ks-button" @click="cancel">取消</div>
    </div>
  </div>
</template>
<script>
import { getMaterialsList, addMaterials } from "@/api/microportal";
export default {
  /**选择文件 */
  name: "SelectFile",
  filters: {
    getTypeName(v) {
      return (v === "img" && "图片") || (v === "audio" && "音频") || "";
    }
  },
  props: {
    /**文件类型 */
    fileType: {
      type: String,
      default: "img"
    },
    /**课程id */
    courseid: [Number, String]
  },
  data() {
    return {
      /**材料标题 */
      fileName: "",
      /**接口请求状态 */
      loaded: false,
      /**上传中 */
      uploading: false,
      /**当前选择的文件id */
      selected: 0,
      /**文件列表 */
      fileList: [],
      /**上传进度 */
      complete: 0
    };
  },
  mounted() {
    this.getFileList();
  },
  methods: {
    /**
     * 获取材料列表
     */
    getFileList() {
      getMaterialsList({
        type: this.fileType,
        courseid: this.courseid,
        maxperpage: 100,
        p: 1
      }).then(res => {
        this.fileList = res.list;
        this.loaded = true;
      });
    },
    /**
     * 上传材料
     */
    uploadFile() {
      this.$store.ready(state => {
        this.$aliUpload({
          wxid: state.info.wxid,
          type: this.fileType,
          uploadProgress: info => {
            this.uploading = true;
            this.fileName = info.file.name;
            this.complete = info.progress;
          },
          uploaded: info => {
            this.uploading = false;
            addMaterials({
              title: info.file.name,
              isopen: 0,
              courseid: this.courseid,
              chargetype: "0",
              file_path: info.path,
              file_name: info.file.name,
              size: info.file.size
            }).then(res => {
              if (res.result === "success") {
                this.getFileList();
              } else {
                this.$layer.alert(res.msg);
              }
            });
          }
        });
      });
    },
    /**
     * 确定
     */
    sure() {
      if (!this.selected) {
        this.$layer.msg("请先选择图片");
        return;
      }
      let selectedItem = this.fileList.filter(item => {
        return item.id == this.selected;
      });
      this.$parent.selectServerCall(selectedItem, this.fileType);
    },
    /**
     * 取消
     */
    cancel() {
      this.$layer.closeAll();
    },
    /**
     * 上传图片
     */
    uploadImg() {}
  }
};
</script>
<style scoped>
.select-file {
  width: 100%;
  box-sizing: border-box;
  padding: 15px;
}
.select-file__title img {
  height: 30px;
  margin: 0px 10px 0 0;
  float: left;
}
.select-file__body {
  height: 480px;
  overflow-x: hidden;
  overflow-y: auto;
}

.select-file__body [class*="ks-col-"] {
  padding: 10px;
}
.select-file__rowhead {
  border-bottom: 1px solid #e9e9e9;
  font-size: 14px;
}
.select-file__row {
  font-size: 14px;
  line-height: 30px;
  cursor: pointer;
  border-bottom: 1px solid #eee;
}
.select-file__row .ks-image {
  height: 55px;
}
.select-file__row:hover {
  background: #f9f9f9;
}
.select-file__row.selected {
  background: #e7f1fb;
}
.select-file__schedule {
  display: inline-block;
  height: 6px;
  background: #e3e3e3;
  border-radius: 20px;
  position: relative;
  width: 150px;
  overflow: hidden;
  margin-left: 20px;
}
.select-file__schedule--complete {
  width: 20%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  border-radius: 20px;
  background: #4687fa;
}
.select-file__file-name {
  color: #999;
}
.select-file__upload {
  margin-top: 20px;
  text-align: center;
}
.select-file__limit {
  font-size: 12px;
  margin-top: 10px;
}
</style>

