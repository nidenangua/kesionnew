<template>
  <div class="tc-vod">
    <input class="tc-vod__file" type="file" v-if="fileReset" ref="tcVodFile" @change="fileChange">
  </div>
</template>
<script>
import TcVod from "vod-js-sdk-v6";
import { uploadTencent, isVodUpload, addVodList } from "@/api/tcvod";
import { setTimeout } from 'timers';
export default {
  name: "TcVodUploader",
  props: ["wxId"],
  data() {
    return {
      fileReset: true
    };
  },
  methods: {
    getSignature() {
      return new Promise(resolve => {
        isVodUpload({
          wxid: this.wxId
        }).then(res => {
          if (res.result === "ok") {
            uploadTencent({
              wxid: this.wxId
            }).then(res => {
              resolve(res.data.signature);
            });
          } else {
            this.$msg(res.errmsg);
          }
        });
      });
    },
    createTcVod(videoFile) {
      this.$emit("change", videoFile);

      /**
       * 创建腾讯视频上传实例
       */
      const tcVod = new TcVod({
        getSignature: this.getSignature // 前文中所述的获取上传签名的函数
      });
      const uploader = tcVod.upload({
        videoFile: videoFile // 视频，类型为 File
      });

      // 视频上传完成时
      uploader.on("video_upload", info => {
        //...
      });
      // 视频上传进度
      uploader.on("video_progress", info => {
        this.$emit("progress", info.percent * 100);
      });

      uploader.done().then(doneResult => {
        /**
         * 上传完成记录到数据库
         */
        addVodList({
            vdoService: 10,
            name: videoFile.name,
            mediaId: doneResult.fileId,
            wxid: this.wxId
          }).then(res => {
            if (res.result === "error") {
              console.error(res.msg);
            }
            setTimeout(()=>{
              this.$emit("uploaded", doneResult);            
            },3000)
          });       
      });
    },
    /**
     * 调用上传方法
     */
    start() {
      this.$refs.tcVodFile.click();
    },
    /**
     * 文件进入
     */
    fileChange() {
      /**
       *  常见在线流媒体格式mp4、flv、f4v、webm

          移动设备格式：m4v、mov、3gp、3g2

          RealPlayer ：rm、rmvb

          微软格式 ：wmv、avi、asf

          MPEG 视频 ：mpg、mpeg、mpe、ts

          DV格式 ：div、dv、divx

          其他格式 ：vob、dat、mkv、lavf、cpk、dirac、ram、qt、fli、flc、mod
        */
      let file = this.$refs.tcVodFile.files[0];
      let formatArr = [
        "mp4",
        "flv",
        "f4v",
        "webm",
        "m4v",
        "mov",
        "3gp",
        "3g2",
        "rm",
        "rmvb",
        "wmv",
        "avi",
        "asf",
        "mpg",
        "mpeg",
        "mpe",
        "ts",
        "div",
        "dv",
        "divx",
        "vob",
        "dat",
        "mkv",
        "lavf",
        "cpk",
        "dirac",
        "ram",
        "qt",
        "fli",
        "flc",
        "mod"
      ];

      let fileFormat = file.name.match(/\.\w+/gi);
      if (fileFormat) {
        fileFormat = fileFormat[fileFormat.length - 1];
        fileFormat = fileFormat.toLowerCase();
        fileFormat = fileFormat.split(".")[1];
        let licit = false;
        formatArr.map(format => {
          if (format === fileFormat) {
            licit = true;
          }
        });
        if (!licit) {
          this.$msg("请选择媒体格式文件");
        } else {
          this.createTcVod(this.$refs.tcVodFile.files[0]);
        }
      } else {
        this.$msg("请选择媒体格式文件");
      }

      /**
       * 更新file
       */
      this.fileReset = false;
      this.$nextTick(() => {
        this.fileReset = true;
      });
    }
  },
};
</script>
<style scoped>
.tc-vod__file {
  display: none;
}
</style>
