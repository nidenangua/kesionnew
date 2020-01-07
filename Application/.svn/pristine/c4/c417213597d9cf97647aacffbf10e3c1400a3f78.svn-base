<template>
  <div>
    <input type="file" id="oss-selectfile" ref="selectfile" @change="fileChange" v-if="show">
    <div v-if="rate > 0 " class="mask">
      <div class="mask-box">
          <div class="mask-box__title">正在上传文件：</div>
          <div style="margin-top: 25px;font-size: 16px;">{{rate}}%</div>
          <progress data-v-0537c997="" max="100" :value=rate style="width: 100%;"></progress>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios'
import { getSignature } from "@/api/alioss";
let par = {};
export default {
  name: "OssWebUpload",
  data() {
    return {
      show: true,
      rate:0
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
      let reg = '';
      
      if(par.type === 'video'){
        reg =  /^(\.mp4|\.avi|\.flv|\.mov)$/i;
        if(file.size / 1024 > 10*1024){
          this.$msg('请上传小于10MB的视频文件')
          return
        }
      }else if(par.type === 'audio'){
        reg =  /^(\.mp3)$/i;
        if(file.size / 1024 > 10*1024){
          this.$msg('请上传小于10MB的音频文件')
          return
        }
      }else{
        reg = /^(\.jpg|\.jpeg|\.bmp|\.gif|\.png|\.jepg)$/i
        if(file.size / 1024 > 10*1024){
          this.$msg('请上传小于10MB的图片文件')
          return
        }
      }
      if (suffix && !reg.test(suffix)) {
        this.$msg("您选择的文件后缀不对");
        return false;
      }
      this.setUploadParam(file);
    },
    /**
     * 配置上传参数
     */
    setUploadParam(file) {
      /**
       * 获取阿里直传签名
       */
      let params = {
        wxid: par.wxid,
        filename: file.name
      };
      getSignature(params).then(obj => {
        let formData = new FormData();
        formData.append("key", obj.dir);
        formData.append("policy", obj.policy);
        formData.append("OSSAccessKeyId", obj.accessid);
        formData.append("success_action_status", "200");
        formData.append("callback", obj.callback);
        formData.append("signature", obj.signature);
        formData.append("file", file);
        /**
         * 开始上传
         */
        axios
          .post(obj.host, formData, {
            onUploadProgress: progressEvent => {
              let complete =
                ((progressEvent.loaded / progressEvent.total) * 100) | 0;
                if(complete < 100){
                   this.rate = complete;
                }else if(complete == 100){
                   this.rate = 0;
                }
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
              file: file
            });

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
.mask{
  position: fixed;
  top: 0;
  background: rgba(0,0,0,.5);
  height: 100%;
  width: 100%;
}
.mask-box{
  width: 70%;
  height: 100px;
  border-radius: 5px;
  background-color: #fff;
  position: fixed;
  left: 10%;
  top: 25%;
  padding: 20px;
}
.mask-box__title{
  font-size: 16px;
}
</style>

