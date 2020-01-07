<template>
  <div>
    <input type="file" id="oss-selectfile" ref="selectfile" @change="fileChange" v-if="show">
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

      if (par.type === "data") {
        /**上传资料 */
        
      }else if(par.type === 'image_text'){
        /**上传图文资料 */
        let reg = /^(\.jpg|\.jpeg|\.bmp|\.gif|\.png|\.doc|\.docx|\.pdf)$/i;
        if (suffix && !reg.test(suffix)) {
          this.$msg("您选择的文件后缀不对");
          return false;
        }
        if (file.size / 1024 > 20 * 1024) {
          this.$msg("您选择的文件过大，请上传20mb以内的文件");
          return false;
        }

      } else if (par.type === "audio" || par.type === "examAudio") {
        /**上传音频 */
        let reg = /^(\.mp3|\.wma|\.wav)$/i;
        if (suffix && !reg.test(suffix)) {
          this.$msg("您选择的文件后缀不对");
          return false;
        }
        if (file.size / 1024 > 50 * 1024) {
          this.$msg("您选择的文件过大，请上传50mb以内的音频");
          return false;
        }
      } else {
        /**上传图片 */
        let reg = /^(\.jpg|\.jpeg|\.bmp|\.gif|\.png)$/i;
        if (suffix && !reg.test(suffix)) {
          this.$msg("您选择的文件后缀不对");
          return false;
        }
        if (file.size / 1024 > 2 * 1024) {
          this.$msg("您选择的文件过大，请上传2mb以内的图片");
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
      let _params = {
        wxid: par.wxid,
        filename: _file.name
      };
      if (par.type) {
        switch (par.type) {
          case "audio":
            _params.type = 3;
            break;
          case "recorder":
            _params.type = 4;
          case "data":
          case "image_text":
            _params.type = 5;
            break;
          case "examAudio":
            _params.type = 6;
            break;
        }
      }
      /**获取阿里直传签名 */
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

          /**开始上传 */
          axios
            .post(obj.host, formData, {
              onUploadProgress: progressEvent => {
                let complete =
                  ((progressEvent.loaded / progressEvent.total) * 100) | 0;
                this.callback('uploadProgress',{
                  file:_file,
                  progress:complete
                })
                this.uploadInfo.progress = complete;
              }
            })
            .then(res => {
              /**重新加载上传节点（解决重复文件无法上传问题） */
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
    },
    /**
     * 添加file文件，直接上传
     */
    addFile(params, file) {
      par = params;
      this.setUploadParam(file);
    }
  }
};
</script>
<style scoped>
#oss-selectfile {
  display: none;
}
</style>

