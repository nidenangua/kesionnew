<template>
  <div class="add-file">
    <div class="add-file__item">
      <div class="add-file__name">材料名称</div>
      <input class="ks-input" ref="title" v-model="title" type="text">
    </div>
    <div class="add-file__item">
      <div class="add-file__name">上传材料</div>
      <div class="ks-button ks-button--plain" @click="uploadFile">上传材料</div>
      <div class="add-file__schedule" v-if="uploading">
        <div class="add-file__schedule--complete" :style="{width:complete+'%'}"></div>
      </div>
      <div class="add-file__tips">仅支持图片、word、pdf格式文件，限20MB内</div>
      <div class="add-file__file-name">{{info.file && info.file.name}}</div>
    </div>
    <div class="add-file__foot">
      <div class="ks-button ks-button--primary" @click="sure">确定</div>
    </div>
  </div>
</template>
<script>
import { addMaterials } from "@/api/microportal";
export default {
  name: "AddFile",
  data() {
    return {
      /**上传中 */
      uploading: false,
      /**材料标题 */
      title: "",
      /**材料文件 */
      info: {},
      /**上传进度 */
      complete: 0
    };
  },
  methods: {
    /**
     * 上传材料
     */
    uploadFile() {
      this.$store.ready(state => {
        this.$aliUpload({
          wxid: state.info.wxid,
          type: "image_text",
          uploadProgress: info => {
            this.uploading = true;
            this.complete = info.progress;
          },
          uploaded: info => {
            this.uploading = false;
            this.info = info;
          }
        });
      });
    },
    /**
     * 确定
     */
    sure() {
      if (!this.title) {
        this.$refs.title.focus();
        this.$layer.msg("请输入材料标题");
        return;
      }
      if (!this.info.file) {
        this.$layer.msg("请先上传材料");
        return;
      }
      addMaterials({
        title: this.title,
        isopen: 0,
        courseid: this.$route.query.id,
        chargetype: "0",
        file_path: this.info.path,
        file_name: this.info.file.name,
        size: this.info.file.size
      }).then(res => {
        if (res.result === "success") {
          this.$parent.fileList.push({
            fileid: res.id,
            id: this.$parent.fileList.length,
            src: this.info.path,
            name: this.title,
            fileType: this.$parent.getSuffix(this.info.path)
          });
          this.$layer.closeAll();
        } else {
          this.$layer.alert(res.msg);
        }
      });
    }
  }
};
</script>
<style scoped>
.add-file {
  width: 100%;
  box-sizing: border-box;
  padding: 20px;
}
.add-file__item {
  position: relative;
  padding: 10px 0 10px 90px;
}
.add-file__name {
  font-size: 14px;
  position: absolute;
  color: #666;
  left: 0;
  top: 10px;
  line-height: 40px;
}
.add-file__tips {
  color: #999;
  line-height: 22px;
  margin-top: 5px;
}
.add-file__file-name {
  font-size: 14px;
  line-height: 24px;
  margin-top: 10px;
  color: #666;
}
.add-file__schedule {
  display: inline-block;
  height: 6px;
  background: #e3e3e3;
  border-radius: 20px;
  position: relative;
  width: 150px;
  overflow: hidden;
  margin-left: 20px;
}
.add-file__schedule--complete {
  width: 20%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  border-radius: 20px;
  background: #4687fa;
}
.add-file__foot {
  border-top: 1px solid #e9e9e9;
  padding-top: 30px;
  margin: 20px 0 0 90px;
}
</style>


