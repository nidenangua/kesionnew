<template>
  <div>
    <ks-container v-if="loaded">
      <el-row class="ks-bo20 paper__detail">试卷名称：2019英文阅读</el-row>
      <el-row>
        <el-col :span="24">
          <el-table ref="multipleTable" :data="tableData" tooltip-effect="dark" style="width: 100%">
            <el-table-column type="index" width="55" label="序号"></el-table-column>
            <el-table-column prop="tkinfo.title" label="考生"></el-table-column>
            <el-table-column prop="tkinfo.tkinfo.answer" label="考生答案"></el-table-column>

            <el-table-column label="得分" width="150">
              <template slot-scope="scope">
                <span v-if="scope.row.tkinfo.tktype ==2 || scope.row.tkinfo.tktype ==4">
                  <el-input v-model="scope.row.grade" type="number"></el-input>
                </span>
              </template>
            </el-table-column>
            <el-table-column label="点评">
              <template
                slot-scope="scope"
                v-if="scope.row.tkinfo.tktype == 2||scope.row.tkinfo.tktype == 4 "
              >
                <el-input v-model="scope.row.comment" placeholder="请输入内容"></el-input>
              </template>
            </el-table-column>
          </el-table>
        </el-col>
      </el-row>
      <el-row class="ks-mt20" v-if="tableData.length">
        <el-col :span="2" style="font-size:14px">教师评语：</el-col>
        <el-col :span="22">
          <el-input type="textarea" :rows="2" placeholder="请输入内容" v-model="teacherComment"></el-input>
        </el-col>
      </el-row>
      <el-footer class="ks-mt20">
        <div class="paper__align-center">
          <el-button type="primary" @click="save()">返回上一题</el-button>
          <el-button>保存下一题</el-button>
        </div>
      </el-footer>
    </ks-container>
  </div>
</template>
<script>
import { getExamRecordList, readOver } from "@/api/exam";
export default {
  name: "ParperMarking",
  data() {
    return {
      loaded: true,
      tableData: [],
      id: this.$route.query.id,
      multipleSelection: [],
      /**
       * 教师评语
       */
      teacherComment: "",
      /**
       * 只看未评分题
       */
      justLook: "",
      /**
       * 试卷详情
       */
      paperDetail: "",
      /**
       * 试卷名称
       */
      title: "",
      paperid: this.$route.query.paperId
    };
  },
  methods: {
    getList() {
      this.$showLoading();
      /**
       * 试卷解析请求
       */
      let params = {
        iscorrect: 1,
        paperid: this.paperid
      };
      getExamRecordList(params).then(res => {
        console.log(res);
        let tkList = [];
        res.list.map((data, dtIndex) => {
          console.log(data);
          if (data.tklist) {
            data.tklist.map(arr => {
              arr.right = "";
              /**
               * 主观题点评
               */
              arr.comment = "";
              /**
               * 主题题评分
               */
              arr.grade = "";
              arr.dtIndex = dtIndex;
              tkList.push(arr);
            });
          }
        });

        this.tableData = tkList;
        this.paperDetail = res.detail;
        this.$hideLoading();
      });
    },
    /**
     * 下拉菜单
     */
    handleCommand(command) {
      if (command.type == 2) {
        this.del(command.id);
      }
    },
    /**
     * 保存
     */
    save() {
      let data = [];
      let sumscore = 0;
      this.tableData.map(item => {
        if (item.tkinfo.tktype == 2 || item.tkinfo.tktype == 4) {
          item.scored = item.grade;
        }
        sumscore += Number(item.scored);
        if (!data[item.dtIndex]) {
          data[item.dtIndex] = {
            tmtype: item.tkinfo.tktype,
            list: []
          };
        }
        data[item.dtIndex].list.push({
          grade: item.grade,
          comment: item.comment,
          tkid: item.tkid,
          doing: item.doing,
          reply: item.reply,
          score: item.score,
          signed: item.signed,
          tkid: item.tkid,
          tktype: item.tkinfo.tktype,
          useranswer: item.useranswer,
          batch: 1
        });
      });
      readOver({
        sumscore: sumscore,
        answer: data,
        id: this.id,
        comment: this.teacherComment
      }).then(res => {
        if (res.result == "success") {
          this.$message(res.msg);
        }
      });
    }
  },
  activated() {
    this.teacherComment = "";
    this.justLook = "";
    (this.paperDetail = ""), (this.title = "");
    this.getList();
  }
};
</script>
<style scoped>
.exam-title {
  font-size: 16px;
  color: #454545;
  margin-bottom: 30px;
}
.exam-topic > span {
  padding-right: 15px;
  color: #999;
  font-size: 14px;
  line-height: 40px;
}
.ks-bo20 {
  margin-bottom: 20px;
}
.ks-w150 {
  width: 150px;
  margin-right: 10px;
}
.input-with-select {
  max-width: 300px;
}
.exam-topic {
  float: right;
}
.fl {
  float: left;
}
.fr {
  float: right;
}
.exam-icon {
  padding: 6px 20px 0 10px;
  border-radius: 4px;
  border: 1px solid #dcdfe6;
  box-sizing: border-box;
  height: 40px;
  float: right;
  margin-right: 10px;
  font-size: 14px;
  color: #666;
  cursor: pointer;
}
.exam-icon i {
  padding-right: 5px;
}
.activeed {
  color: #3bde3b;
}
body .el-input,
body .el-textarea {
  max-width: 100%;
}
.paper__detail {
  font-size: 14px;
}
.paper__align-center {
  text-align: center;
}
</style>


