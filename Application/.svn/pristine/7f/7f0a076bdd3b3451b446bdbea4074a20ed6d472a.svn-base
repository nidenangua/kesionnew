<template>
    <div class="container" v-if="show">
      <div class="nav">
        <el-breadcrumb separator="/">
          <el-breadcrumb-item :to="{path:'/?url=/home.html/friends/Index/Index'}" class="nav-friend">朋友圈动态</el-breadcrumb-item>
          <el-breadcrumb-item>添加动态</el-breadcrumb-item>
        </el-breadcrumb>
      </div>
      <div class="tips">请您遵守国家相关规定，切勿上传低俗色情、暴力恐怖、谣言诈骗、侵权盗版等相关内容，课堂街保有依据国家规定及平台规则进行处理的权利。</div>
      <div class="content">
        <el-input
          maxlength="589"
          :show-word-limit="showword"
          resize="none"
          type="textarea"
          :rows="10"
          placeholder="请输入动态内容"
          v-model="textarea"
        ></el-input>
      </div>
      <media-upload @change="onMediaUploadChange" class="uploadd" />
      <span class="hint">点击添加图片,视频,音频</span>
      <div class="submit">
        <el-button type="primary" @click="pubsish">发表</el-button>
        <el-button @click="clear()">取消</el-button>
      </div>
    </div>
</template>

<script>
import { addFriends } from "@/api/social";
import MediaUpload from "@/components/media-upload";
export default {
  components: {
    MediaUpload
  },
  data() {
    return {
      show:false,
      /**发表内容 */
      textarea: "",
      /**地址 */
      info: [],
      /**类型 */
      type: "",
      /**显示 */ 
      showword: true
    };
  },
  methods: {
    onMediaUploadChange(info) {
      this.info = info.info;
      if (info.type == "image") {
        this.type = "1";
      } else if (info.type == "video") {
        this.type = "2";
      } else if (info.type == "audio") {
        this.type = "3";
      } else {
        this.type = "0";
      }
    },
    /**发表操作 */
    pubsish() {
      addFriends({
        type: this.type,
        content: this.textarea,
        info: this.info
      }).then(res => {
        if (res.result == "success") {
          this.$message({ message: "发表成功", type: "success" });
          this.clear();
        }
      });
    },
    /**清除操作 */
    clear() {
      this.textarea = "";
      this.$router.push('/?url=/home.html/friends/Index/Index')
    }
  },
  activated() {
    this.show = true
  },
  deactivated(){
    this.show = false
  }
};
</script>
<style scoped>
.container {
  background-color: #fff;
  margin-top: 20px;
  margin-left: 20px;
  border-radius: 10px;
  padding-bottom: 100px;
}

.nav {
  padding: 20px;
}
.tips {
  background-color: #fdf6ec;
  color: #e6a23c;
  line-height: 22px;
  padding: 12px 15px;
  border-radius: 4px;
  margin: 0 20px;
}

.submit,
.content {
  font-size: 12px;
  margin: 30px 0 0 60px;
}
.uploadd {
  width: 60px;
  margin-left: 80px !important;
  border: 1px pink;
}
.upload__btn {
  padding: 18px 30px;
  border: 1px dashed black;
}
.uploadd {
  margin-left: 60px;
}
.content {
  margin-bottom: 20px;
}
.nav-friend /deep/ .el-breadcrumb__inner:hover {
  cursor: pointer;
  color: #3c81f9;
}
.el-textarea /deep/ .el-textarea__inner{
  height: 140px ;
}
.content,
.upload,
.submit,
.hint{
  margin-left: 80px
}
.hint {
  color: #ababab;
  line-height: 42px;
}
.submit {
  margin-top: 0
}
</style>