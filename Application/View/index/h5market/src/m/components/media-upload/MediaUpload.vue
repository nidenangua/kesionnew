<template>
  <div class="media-upload">
    <div v-if="!info.length">
      <div class="media-upload__box media-upload__item ks-image">
        <img src="@/m/assets/mentoring/group_btn_add.png" @click="upload" ref="file_avatar" />
      </div>
    </div>
    <div v-else-if="this.type == 'image'">
      <div class="media-upload__item ks-image">
        <div class="media-upload__box" v-for="(src,i) in info" :key="i">
          <i class="ks-icon ks-icon-close-circle" @click="wipe(i)"></i>
          <img :src="src" />
        </div>
        <div class="media-upload__box" v-if="info.length < 9">
          <img src="@/m/assets/mentoring/group_btn_add.png" @click="upload" ref="file_avatar" />
        </div>
      </div>
    </div>
    <div v-else-if="this.type == 'video' && info[0]" class="ks-video">
      <i class="ks-icon ks-icon-close-circle" @click="wipe(0)"></i>
      <video controls="controls" :src="info[0]"></video>
    </div>
    <div v-else-if="this.type == 'audio' && info[0]" class="ks-video">
      <i class="ks-icon ks-icon-close-circle" @click="wipe(0)"></i>
      <media-preview :type="type" :info="{src:info[0]}" />
    </div>
  </div>
</template>
<script>
import MediaPreview from "../../components/media-preview";
export default {
  name: "MediaUpload",
  components: {
    MediaPreview
  },
  props: {
    /**传入地址 */
    // linfo: {
    //   type: Object,
    //   default() {
    //     return {};
    //   }
    // }
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
    upload() {
      if (this.info.length === 0) {
        this.$actionSheet({
          list: [
            {
              name: "添加图片",
              type: "image"
            },
            {
              name: "添加视频",
              type: "video"
            },
            {
              name: "添加音频",
              type: "audio"
            }
          ]
        }).then(item => {
          this.type = item.type;
          this.runUpload();
        });
      } else {
        this.runUpload();
      }
    },
    runUpload() {
      this.$store.ready(state => {
        switch (this.type) {
          case "video":
            this.$upload({
              wxid: state.info.wxid,
              type: "video",
              uploaded: res => {
                this.info.push(res.defaultpic);
              }
            });
            break;
          case "audio":
            this.$upload({
              wxid: state.info.wxid,
              type: "audio",
              uploaded: res => {
                this.info.push(res.defaultpic);
              }
            });
            break;
          case "image":
            if (this.info.length < 9) {
              this.$upload({
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
    }
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
}
.media-upload__box {
  position: relative;
  width: 100px;
  height: 100px;
  display: -webkit-inline-box;
  margin-right: 3%;
  margin-top: 3%;
}
.ks-icon-close-circle {
  position: absolute;
  margin-top: 0;
  right: -7px;
  top: -5px;
  color: #999;
  z-index: 10;
}
/* 视频 */
.ks-video {
  margin: 10px 0;
  text-align: center;
  position: relative;
}
.ks-video video {
  /* height: 300px; */
  border-radius: 5px;
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
video{
  width: 100%;
}
/* 音频 */
</style>