<template>
  <div class="media-upload">
    <div v-if="!info.length">
      <el-dropdown trigger="click" @command="handleCommand">
        <span class="el-dropdown-link">
          <div class="media-upload__box media-upload__item ks-image">
            <!-- <img class="media-upload__bgi" ref="file_avatar" /> -->
            <div class="media-upload__bgi" ref="file_avatar"></div>
          </div>
        </span>
        <el-dropdown-menu slot="dropdown">
          <el-dropdown-item command="image" @click="runUpload">添加图片</el-dropdown-item>
          <el-dropdown-item command="video" @click="runUpload">添加视频</el-dropdown-item>
          <el-dropdown-item command="audio" @click="runUpload">添加音频</el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
    </div>
    <div v-else-if="this.type == 'image'">
      <div class="media-upload__item ks-image">
        <div class="media-upload__box" v-for="(src,i) in info" :key="i">
          <i class="el-icon-error ks-icon-close-circle" @click="wipe(i)"></i>
          <img :src="src">
        </div>
        <div class="media-upload__box" v-if="info.length < 9">
          <!-- <img class="media-upload__bgi" @click="runUpload(type)" ref="file_avatar"> -->
          <div class="media-upload__bgi" @click="runUpload(type)" ref="file_avatar"></div>
        </div>
      </div>
    </div>
    <div v-else-if="this.type == 'video' && info[0]" class="ks-video">
      <i class="el-icon-error ks-icon-close-circle" @click="wipe()"></i>
      <video controls="controls" :src="info[0]"></video>
    </div>
    <div v-else-if="this.type == 'audio' && info[0]" class="ks-video">
      <i class="el-icon-error ks-icon-close-circle" @click.stop="wipe(0)"></i>
      <media-preview :type="type" :info="{src:info[0]}"/>
    </div>
  </div>
</template>
<script>
import MediaPreview from "../media-preview";
export default {
  name: "MediaUpload",
  components: {
    MediaPreview
  },
  data() {
    return {
      type: "",
      info: []
    };
  },
  watch: {
    info: {
      handler(info) {
        this.$emit("change", {
          info: info,
          type: this.type
        });
      },
      deep: true
    },
    type(v) {
      this.$emit("change", {
        info: this.info,
        type: v
      });
    }
  },
  methods: {
    /**
     * 触发上传按钮
     */
    handleCommand(data) {
      this.runUpload(data);
    },
    runUpload(data) {
      this.type = data;
      this.$store.ready(state => {
        switch (data) {
          case "video":
            this.$aliUpload({
              wxid: state.info.wxid,
              type: "video",
              maxSize: 10240,
              uploaded: res => {
                this.info.push(res.defaultpic);
              }
            });
            break;
          case "audio":
            this.$aliUpload({
              wxid: state.info.wxid,
              type: "audio",
              maxSize: 10240,
              uploaded: res => {
                this.info.push(res.defaultpic);
              }
            });
            break;
          case "image":
            if (this.info.length < 9) {
              this.$aliUpload({
                wxid: state.info.wxid,
                type: "image",
                uploaded: res => {
                  this.info.push(res.defaultpic);
                }
              });
            }
            if (this.info.length >= 9) {
              this.$toast("最多上传九张图片", "warning");
            }
            break;
        }
        //res.defaultpic 上传成功返回的文件地址
      });
    },
    //去除
    wipe(i) {
      this.info.splice(i, 1);
    },
  }
};
</script>
<style scoped>
/* 添加按钮 */
.media-upload__button {
  padding: 10px 20px;
}
.media-upload__button img {
  width: 100px;
}
/* 底部弹框 */
.ks-action-sheet__list {
  border-radius: 5px;
  overflow: hidden;
}
.ks-action-sheet {
  width: 96%;
  left: 2%;
}
.ks-action-sheet__cancel {
  border-radius: 5px;
  overflow: hidden;
  margin-bottom: 10px;
}
/* 图片 */
.media-upload__item img {
  width: 100px;
  height: 100px;
  margin-right: 3%;
  border-radius: 5px;
  object-fit: cover;
}
.media-upload__box {
  position: relative;
  width: 100px;
  height: 100px;
  display: -webkit-inline-box;
  margin-right: 3%;
  margin-top: 4%;
}
.ks-icon-close-circle {
  position: absolute;
  margin-top: 0;
  right: -9px;
  top: -9px;
  color: #999;
  opacity: 0.8;
  z-index: 999;
}
/* 视频 */
.ks-video {
  margin: 10px 0;
  text-align: center;
  position: relative;
}
.ks-video video {
  border-radius: 5px;
  width: 100%;
}
video::-internal-media-controls-download-button {
  display: none;
}
video::-webkit-media-controls-enclosure {
  overflow: hidden;
}
video::-webkit-media-controls-panel {
  width: calc(120%);
}
/* .media-upload__bgi {
  background: url(./assets/group_btn_add.png )  no-repeat;
  background-size: 100% 100%;
} */
/* 音频 */
.media-upload {
  width: 400px !important;
}
.media-upload__bgi {
  width: 100px;
  height: 100px;
  border: 1px dashed #ccc;
}
.media-upload__bgi:before,
.media-upload__bgi:after {
  content: "";
  position: absolute;
  background: #ccc;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.media-upload__bgi:before {
  width: 20px;
  height: 2px;
}
.media-upload__bgi:after {
  width: 2px;
  height: 20px;
}
.el-icon-error:before {
  font-size: 20px;
  opacity: 0.8;
}
</style>