<template>
  <div>
    <input type="file" id="oss-selectfile" ref="selectfile" @change="fileChange" v-if="show">
    <el-dialog
      width="400px"
      :title="uploadInfo.progress < 100 ? '正在上传' : '上传成功'"
      :visible.sync="uploadInfo.visible"
      v-if="uploadInfo.visible"
      :show-close="false"
      :close-on-click-modal="false"
      :close-on-press-escape="false"
    >
      <div class="uploadInfo__file_name">上传文件：{{uploadInfo.fileName}}</div>
      <el-progress :percentage="uploadInfo.progress" v-if="uploadInfo.progress < 100"></el-progress>
      <el-progress :percentage="uploadInfo.progress" status="success" v-else></el-progress>
    </el-dialog>
  </div>
</template>
<script>
import axios from "axios";
let par = {};
export default {
  name: "AliOSS",
  data() {
    return {
      show: true,
      uploadInfo: {
        fileName: "",
        progress: 0,
        visible: false
      }
    };
  },
  methods: {
    /**
     * 获取文件格式
     */
    getSuffix(filename) {
      let pos = filename.lastIndexOf(".");
      let suffix = "";
      if (pos != -1) {
        suffix = filename.substring(pos);
      }
      return suffix;
    },
    /**
     * 文件进入
     */
    fileChange(e) {
      let file = e.target.files[0];
      let suffix = this.getSuffix(file.name);
      if(!suffix){
        return this.$msg('不支持的文件类型')
      }
      let maxSize = par.maxSize;
      let reg
      switch(par.type){
        case 'data':
          break
        case 'ico':
          if (file.size / 1024 > 200) {
            return this.$msg(`您选择的文件过大，请上传200kb以内的文件`)
          }
          reg = /^(\.ico)$/i;
          if (!reg.test(suffix)) {
            return this.$msg("请选择文件后缀为.ico的文件")
          }
          break
        case 'audio':
        case 'examAudio':
          maxSize = maxSize || 20 * 1024
          if (file.size / 1024 > maxSize) {
            let size = parseInt(maxSize / 1024);
            this.$msg(`您选择的文件过大，请上传${size}mb以内的音频`);
            return false;
          }
          reg = /^(\.mp3|\.wma)$/i;
          if (!reg.test(suffix)) {
            this.$msg("您选择的文件后缀不对");
            return false;
          }
          break
        case 'video':
          maxSize = maxSize || 10 * 1024
          reg =  /^(\.mp4|\.avi|\.flv|\.mov)$/i;
          if(file.size / 1024 > maxSize){
            let size = parseInt(maxSize / 1024);
            this.$msg(`请上传小于${size}MB的视频文件`)
            return false;
          }
          if (!reg.test(suffix)) {
            this.$msg("您选择的文件后缀不对");
            return false;
          }
          break
        default:
          /**默认为图片上传 */
          maxSize = maxSize || 2*1024
          if (file.size / 1024 > maxSize) {
            let size = parseInt(maxSize / 1024);
            this.$msg(`您选择的文件过大，请上传${size}mb以内的图片`);
            return false;
          }
          reg = /^(\.jpg|\.jpeg|\.bmp|\.gif|\.png)$/i;
          if (!reg.test(suffix)) {
            this.$msg("您选择的文件后缀不对");
            return false;
          }
      }
      this.setUploadParam(file);
    },
    /**
     * 配置上传参数
     */
    setUploadParam(_file) {
      this.uploadInfo.fileName = _file.name;
      this.uploadInfo.visible = true;
      /**
       * 获取阿里直传签名
       */
      let _params = {
        wxid: par.wxid,
        filename: _file.name
      };
      if (par.type) {
        switch (par.type) {
          case "audio":
            _params.type = 3;
            break;
          case "data":
            _params.type = 5;
            break;
          case "examAudio":
            _params.type = 6;
            break;
        }
      }
      axios
        .get("/Plus/Kesion.ajax.php?act=uploadAliBos", {
          params: _params
        })
        .then(obj => {
          obj = obj.data;
          let formData = new FormData();
          formData.append("key", obj.dir);
          formData.append("policy", obj.policy);
          formData.append("OSSAccessKeyId", obj.accessid);
          formData.append("success_action_status", "200");
          formData.append("callback", obj.callback);
          formData.append("signature", obj.signature);
          formData.append("file", _file);

          /**
           * 开始上传
           */
          axios
            .post(obj.host, formData, {
              onUploadProgress: progressEvent => {
                let complete =
                  ((progressEvent.loaded / progressEvent.total) * 100) | 0;
                this.uploadInfo.progress = complete;
              }
            })
            .then(res => {
              /**
               * 重新加载上传节点（解决重复文件无法上传问题）
               */
              this.show = false;
              this.$nextTick(() => {
                this.show = true;
              });

              this.callback("uploaded", {
                defaultpic: obj.host + "/" + obj.dir,
                path: obj.host + "/" + obj.dir,
                file: _file
              });
              this.uploadInfo.visible = false;
            });
        });
    },

    /**
     * 回调
     */
    callback(key, res) {
      typeof par[key] === "function" && par[key](res);
    },
    /**
     * 运行
     */
    start(params) {
      par = params;
      this.$refs.selectfile.click();
    }
  }
};
</script>
<style scoped>
#oss-selectfile {
  display: none;
}
</style>

