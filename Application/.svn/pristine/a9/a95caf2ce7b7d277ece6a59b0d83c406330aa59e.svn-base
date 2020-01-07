<template>
  <div>
    <el-main align="center">
      <el-row>
        <el-col :span="24" class="exam-wanning">上传前请先下载模板，按照模板要求将内容录入到模板中</el-col>
        <el-col :span="24">
          <el-upload
            class="upload-demo"
            drag
            action="/Json/index.php?act=Exam.store.setExcelUp"
            multiple
            :on-success="uploadSuccess"
            :on-error="uploadError"
          >
            <i class="el-icon-upload"></i>
            <div class="el-upload__text">
              将文件拖到此处，或
              <em>点击上传</em>
            </div>
            <div class="el-upload__tip" slot="tip">格式支持：.xls</div>
          </el-upload>
        </el-col>
      </el-row>
      <el-row>
        <el-button type="primary" plain @click="open">下载excel模板</el-button>
      </el-row>
    </el-main>
  </div>
</template>
<script>
import { setExcelUp } from "@/api/exam";
export default {
  name: "PaperLead",
  data() {
    
    return {};
  },
  methods: {
    open() {
      location.href = "/Public/题库导入模版.xls";
    },
    uploadSuccess(){
       this.$notify({
        title: '成功',
        message: '题库已成功导入',
        type: 'success'
      });
      setTimeout(()=>{
        this.$emit('success')
      },1000)
    },
    uploadError(){
      this.$notify({
        title: '失败',
        message: '题库导入失败，请检查模版规则是否录入正确',
        type: 'error'
      });
    }
  }
};
</script>
<style scoped>
.exam-wanning {
  font-size: 14px;
  color: #666;
  margin-bottom: 30px;
}
.el-upload__tip {
  margin: 10px 0;
}

.el-upload-list__item-name {
  margin-bottom: 20px;
}
</style>



