<template>
  <div>
    <div class="dynamic">
      <div class="dynamic-title line">
        <input type="text" class="dy-text" v-model="title" placeholder="标题（必填）">
      </div>
      <div class="dynamic-text line">
        <textarea class="dy-text dy-textarea" placeholder="分享你想说的..." v-model="content"></textarea>
      </div>
      <div class="dynamic-upload clearfix">
        <ks-create-bg class="file-box" :src="url" v-for="(url,index) in imgList" :key="index"/>
        <div class="file-box" @click="uploadFile">
          <img src="@/m/assets/group/group_btn_add.png">
        </div>
      </div>
      <div class="dynamic-upload__tip">建议上传png，jpg文件</div>
    </div>
    <ks-button type="primary" class="denamic-btn" @click="release">确认发布</ks-button>
  </div>
</template>

<script>
import { teamAddTopic, getTeamDetail } from "@/api/group";
export default {
  name: "GroupDynamics",
  data() {
    return {
      title: "",
      content: "",
      imgList: []
    };
  },
  methods: {
    release() {
      if (!this.title) {
        this.$toast("请先输入标题");
        return false;
      }
      teamAddTopic({
        team_id: this.$route.query.groupid,
        title: this.title,
        content: this.content,
        file_path: this.imgList
      }).then(res => {
        this.$toast("发布成功", "success").then(() => {
          history.back();
        });
      });
    },
    uploadFile() {
      if (this.imgList.length < 9) {
        this.$store.ready(state => {
          this.$uploadImages({
            wxid: state.info.wxid,
            uploaded: res => {
              this.imgList.push(res.defaultpic);
            }
          });
        });
      } else {
        this.$toast("您最多可上传9张图");
      }
    }
  },
  activated() {
    document.title = "发布动态";
    this.title = "";
    this.content = "";
    this.imgList = [];
  }
};
</script>
<style scoped>
.dy-text {
  -webkit-appearance: none;
  background-color: #fff;
  background-image: none;
  border-radius: 4px;
  border: 1px solid #dcdfe6;
  box-sizing: border-box;
  color: #353535;
  display: inline-block;
  font-size: inherit;
  height: 40px;
  line-height: 40px;
  outline: none;
  padding: 0 15px;
  transition: border-color 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
  width: 100%;
  font-size: 15px;
}
.dy-textarea {
  line-height: 28px;
  padding: 10px 15px;
}
.dynamic {
  background: #fff;
}
.dynamic-text {
  height: 220px;
}
.dynamic-title input,
.dynamic-text textarea {
  border: 0;
}
.dynamic-text textarea {
  min-height: 11rem;
}
.file-box {
  width: 60px;
  height: 60px;
  position: relative;
  float: left;
  margin: 10px 10px 0 0;
}

.fileInput {
  height: 100%;
  position: absolute;
  right: 0;
  top: 0;
  opacity: 0;
}
.denamic-btn {
  position: fixed;
  bottom: 0;
  left: auto;
  right: auto;
  margin: 0 auto;
  width: 100%;
  max-width: 480px;
  border-radius: 0px;
}

.file-box img {
  width: 100%;
  height: 100%;
}
.dynamic-upload__tip {
  font-size: 12px;
  color: #b3b3b3;
  padding: 0px 20px 20px 20px;
}
.dynamic-upload {
  padding: 10px 20px 20px 20px;
}
.dy-text::-webkit-input-placeholder {
  color: #b3b3b3;
  font-weight: normal;
  font-size: 14px;
}
</style>

