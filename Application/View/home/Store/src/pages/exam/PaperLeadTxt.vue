<template>
  <div>
    <el-main style="text-align:center">
      <el-row>
        <el-col :span="24" class="exam-wanning">
          提交前，按照模板内容格式录入
          <span class="ks-color-link ks-cursor-pointer" @click="download">[模板下载]</span>
        </el-col>
        <el-col :span="24">
          <el-input
            type="textarea"
            :rows="2"
            placeholder="请输入内容"
            v-model="textarea"
            class="exam-txt"
          ></el-input>
        </el-col>
      </el-row>
      <el-row>
        <el-button type="primary" @click="save">保存</el-button>
      </el-row>
    </el-main>
  </div>
</template>
<script>
import { setExcelUp, getExamDetail } from "@/api/exam";
export default {
  name: "PaperLeadTxt",
  data() {
    return {
      textarea: ""
    };
  },
  methods: {
    download() {
      location.href = "/Public/题库导入模版.xls";
    },
    save() {
      setExcelUp({
        file: this.textarea
      }).then(res => {
        if (res.result === "success") {
          this.$emit("saved");
        }
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
  margin: 10px 0 20px;
}

.el-upload-list__item-name {
  margin-bottom: 10px;
}
.exam-txt {
  height: 200px;
  margin-bottom: 20px;
}
</style>





