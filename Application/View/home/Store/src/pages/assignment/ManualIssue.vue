<template>
  <div class="container">
    <!-- 导航栏部分 -->
    <div class="nav">
      <el-breadcrumb separator="/">
        <el-breadcrumb-item>朋友圈动态</el-breadcrumb-item>
        <el-breadcrumb-item>添加动态</el-breadcrumb-item>
      </el-breadcrumb>
    </div>
    <!-- 内容部分 -->
    <div class="details">
      <el-form label-width="100px" :rules="rules" :model="ruleForm">
        <el-form-item label="作业名称" prop="name">
          <el-input v-model="ruleForm.name" maxlength="45" show-word-limit></el-input>
        </el-form-item>
        <el-form-item label="关联课程" prop="course">
          <el-button>选择课程</el-button>
          <div>布置作业后,无法更改关联课程</div>
        </el-form-item>
        <el-form-item label="关爱社群">
          <el-button>选择社群</el-button>
        </el-form-item>
        <el-form-item label="作业内容" prop="jobcontent">
          <div class="content">
            <div class="content-header">
              <span class="content-span">内容</span>
              <el-input
                type="textarea"
                resize="none"
                v-model="ruleForm.jobcontent"
                placeholder="请输入作业内容"
              ></el-input>
            </div>
            <div class="content-con">
              <span class="content-span">图片</span>
              <span class="content-max">最多可上传9张图片</span>
              <media-upload @change="onMediaUploadChange()"  class="upload"/>
            </div>
            <div class="content-footer">
              <span class="content-span">音频</span>
              <span class="content-max">仅支持mp3格式，建议上传大小不超过10M</span>
              <media-upload @change="onMediaUploadChange()" class="upload" />              
            </div>
          </div>
        </el-form-item>
      </el-form>
    </div>
    <!-- 底部部分 -->
    <div class="footer">
      <span>是否前台展示</span>
      <el-switch v-model="value" active-color="#13ce66" inactive-color="#ff4949"></el-switch>
      <span>若选择不展示，则学员看不到该作业</span>
    </div>
    <div class="order">
      <el-button type="primary" class="send">布置作业</el-button>
      <el-button>返回</el-button>
    </div>
  </div>
</template>

<script>
import MediaUpload from "@/components/media-upload";
export default {
  components:{
    MediaUpload
  },
  data() {
    return {
      ruleForm: {
        /**作业名称 */
        name: "",
        /**作业内容 */
        jobcontent: ""
      },
      /**from校验 */
      rules: {
        name: [
          { required: true, message: "请输入活动名称", trigger: "blur" }
          // { min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur' }
        ],
        course: [{ required: true, message: "请选择课程", trigger: "blur" }],
        jobcontent: [{ required: true, message: '请输入作业内容', trigger: "blur"}],
      },
      /**开关 */
      value:true
    };
  },
  created() {},
  methods: {}
};
</script>

<style scoped>
.container {
  background-color: #fff;
  margin: 20px;
  border-radius: 5px;
  height: 100vh;
  color: #ababab;
}
.nav {
  width: 95%;
  margin: 0 auto;
  height: 30px;
  padding-top: 18px;
  border-bottom: 1px solid #eee;
}
.details {
  padding: 40px 0 0 110px;
}
.content {
  background-color: #f6f9fb;
  padding: 16px 10px;
}
.content-header {
  display: flex;
}
.content-span {
  margin-right: 10px;
  line-height: 1.2rem;
}
.el-form-item__error /deep/ {
  left: 20px !important;
}
.content-max {
  font-size: 12px;
}
.el-form-item__content .el-input /deep/{
  max-width: 700px;
  width: 700px !important;
}
.el-form {
  width: 800px;
}
.footer{
  padding-left: 110px;
}
.footer span {
  padding: 11px
}
.order{
  padding: 50px 0 0 200px;
}
.send{
  margin-right: 20px;
}
.upload{
  margin-left: 40px;
} 
 .el-form-item /deep/ .el-form-item__error {
  top: 26% !important;
  left: 48px !important
}
.content-con{
  margin-top: 20px
}
</style>
