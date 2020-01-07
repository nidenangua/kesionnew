<template>
  <ks-container v-if="loaded">
    <ks-title name="试卷添加" border="none" v-if="paperId == 0"></ks-title>
    <el-row>
      <el-col :span="24">
        <el-form label-width="80px" :model="formLabelAlign">
          <el-form-item label="试卷类别" v-show="showCategoryid">
            <paper-classfiy
              v-if="formLabelAlign.categoryid !== null"
              :categoryid="formLabelAlign.categoryid"
              :parentid-path="parentidPath"
              @change="handleClassfiyChange"
              :visible.sync="showCategoryid"
            />
          </el-form-item>
          <el-form-item label="试卷名称">
            <el-input placeholder="请输入内容" v-model="formLabelAlign.title"></el-input>
          </el-form-item>
          <el-form-item label="组卷方式">
            <el-radio v-model="formLabelAlign.exam_type" label="2" :disabled="paperId > 0">手动组卷</el-radio>
            <el-radio v-model="formLabelAlign.exam_type" label="1" :disabled="paperId > 0">随机组卷</el-radio>
          </el-form-item>
          <el-form-item label="批阅方式">
            <el-radio v-model="formLabelAlign.scoreout" label="2">教师批卷</el-radio>
            <el-radio v-model="formLabelAlign.scoreout" label="1">自主批卷</el-radio>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" @click="onSubmit">保存</el-button>
          </el-form-item>
        </el-form>
      </el-col>
    </el-row>
  </ks-container>
</template>
<script>
import { getDefaultValue } from "@/utils";
import { getExamDetail, addExamOne } from "@/api/exam";
import PaperClassfiy from "./PaperClassfiy";

export default {
  name: "PaperAdd",
  props: {
    /**试卷id */
    paperId: {
      type: [String, Number],
      default: "0"
    }
  },
  watch: {
    paperId() {
      this.dataInit();
    }
  },
  data() {
    return {
      /**试卷信息加载状态 */
      loaded: false,
      /**显示分类id开关，有分类将变为true */
      showCategoryid: false,
      /**试卷信息对象 */
      formLabelAlign: {},
      /**试卷分类联动关系 */
      parentidPath: []
    };
  },
  methods: {
    /**
     * 保存
     */
    onSubmit() {
      addExamOne(this.formLabelAlign).then(res => {
        if (res.result === "success") {
          this.$msg(res.msg, "success");
          if (this.formLabelAlign.paperid == 0) {
            this.$router.push({
              path: "/exam/addlist",
              query: {
                paperId: res.paperid,
                type: this.formLabelAlign.exam_type,
                scoreout: this.formLabelAlign.scoreout
              }
            });
            setTimeout(() => {
              this.dataInit();
            }, 1000);
          } else {
            this.$emit("saved", this.formLabelAlign);
          }
        }
      });
    },
    /**
     * 分类变化
     * @param {String} 分类id
     */
    handleClassfiyChange(id) {
      this.formLabelAlign.categoryid = id;
    },
    /**
     * 数据重置
     * @param {Object}
     */
    reset(data = {}) {
      this.showCategoryid = false;
      this.formLabelAlign = {
        paperid: getDefaultValue(data.paperid, "0"),
        title: getDefaultValue(data.title),
        exam_type: getDefaultValue(data.exam_type, "2"),
        scoreout: getDefaultValue(data.scoreout, "1"),
        categoryid: getDefaultValue(data.categoryid, "0")
      };
      this.parentidPath = getDefaultValue(data.parentidpath, []);
    },

    /**
     * 数据初始化
     */
    dataInit() {
      this.loaded = false;
      this.$nextTick(() => {
        if (this.paperId > 0) {
          getExamDetail({
            paperid: this.paperId
          }).then(res => {
            this.reset(res.list);
            this.loaded = true;
          });
        } else {
          this.reset();
          this.loaded = true;
        }
      });
    }
  },
  created() {
    this.dataInit();
  },
  components: {
    PaperClassfiy
  }
};
</script>

