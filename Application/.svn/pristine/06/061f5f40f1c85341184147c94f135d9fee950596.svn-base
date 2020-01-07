<template>
  <el-table :data="tableData" :span-method="objectSpanMethod">
    <el-table-column label="序号" width="80px">
      <template slot-scope="scope">{{scope.row.tkindex + 1}}</template>
    </el-table-column>
    <el-table-column label="考生" width="150px" v-if="markType === 'question'">
      <template slot-scope="scope">{{scope.row.username}}</template>
    </el-table-column>
    <el-table-column label="题目类别" width="120px" v-else>
      <template slot-scope="scope">{{scope.row.dttype == 6 ? '组合题' : scope.row.type_name}}</template>
    </el-table-column>
    <el-table-column label="题目" v-if="markType !== 'question'">
      <template slot-scope="scope">
        <div
          class="big-question-title"
          v-if="scope.row.dttype == 6 && scope.row.xtindex == 0"
          v-html="scope.row.dttitle"
        ></div>
        {{scope.row.dttype == 6 ? `${scope.row.xtindex + 1})、` : ``}}
        <span
          v-if="scope.row.dttype == 6"
        >【{{scope.row.type_name}}】</span>
        <span v-html="scope.row.title"></span>
        <div
          class="ks-color-info"
          v-if="scope.row.tktype != 1"
        >正确答案：{{scope.row.tkinfo.answer | answer(scope.row.tktype)}}</div>
        <div
          class="ks-color-info ks-mt5"
          v-show="scope.row.analysis_flag"
          v-html="'题目解析：' + scope.row.tkinfo.analysis || '无'"
        ></div>
        <div class="ks-mt5">
          <span
            class="ks-cursor-pointer ks-color-primary"
            @click="scope.row.analysis_flag = !scope.row.analysis_flag"
          >{{scope.row.analysis_flag ? '隐藏解析' : '查看解析'}}</span>
        </div>
      </template>
    </el-table-column>
    <el-table-column label="考生答案">
      <template slot-scope="scope">{{scope.row.useranswer | answer(scope.row.tktype)}}</template>
    </el-table-column>
    <el-table-column width="120px" label="分数" prop="score"></el-table-column>
    <el-table-column label="得分" width="150px">
      <ks-input-number
        :ref="`scoreInput${scope.$index}`"
        slot-scope="scope"
        unit="分"
        :max="Number(scope.row.score)"
        v-model="scope.row.userscore"
      />
    </el-table-column>
    <el-table-column label="点评">
      <el-input slot-scope="scope" v-model="scope.row.comment" placeholder="请输入内容"/>
    </el-table-column>
  </el-table>
</template>
<script>
/**
 * 批卷组卷
 */
export default {
  name: "Marking",
  props: {
    /**批卷类型 */
    markType: {
      type: String,
      default: "person"
    },
    /**可批阅题目列表 */
    tableData: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  methods: {
    /**
     * 用于父亲层验证是否满足提交条件
     */
    validate() {
      for (let i = 0; i < this.tableData.length; i++) {
        let item = this.tableData[i];
        if (!item.userscore && item.userscore != "0") {
          this.$refs[`scoreInput${i}`].focus();
          this.$msg("请先填写得分");
          return false;
        }
      }
      return true;
    },
    /**
     * 用于父亲层获取批卷信息
     * 返回格式 {Array}
     */
    getMarkInfo() {
      let markInfo = [];
      this.tableData.map(item => {
        if (item.dttype == 6) {
          /**遍历是否已存在该组合题的答案数组 */
          let currentMarkItem;
          markInfo.map(markItem => {
            if (markItem.tkid == item.tkid) {
              currentMarkItem = markItem;
            }
          });
          if (!currentMarkItem) {
            /**不存在，增加一条数据 */
            markInfo.push({
              answerid: item.answerid,
              tktype: 6,
              userid: item.userid,
              tkid: item.tkid,
              childtk: [
                {
                  userscore: item.userscore,
                  comment: item.comment
                }
              ]
            });
          } else {
            /**已存在，在组合题的小题数组里增加一条数据 */
            currentMarkItem.childtk.push({
              userscore: item.userscore,
              comment: item.comment
            });
          }
        } else {
          markInfo.push({
            answerid: item.answerid,
            tktype: item.tktype,
            userid: item.userid,
            tkid: item.tkid,
            userscore: item.userscore,
            comment: item.comment
          });
        }
      });
      return markInfo;
    },
    /**
     * 处理表格行列
     */
    objectSpanMethod({ row, column, rowIndex, columnIndex }) {
      if (columnIndex < 2 && row.dttype == 6) {
        if (row.xtindex === 0) {
          return {
            rowspan: row.siblings_num,
            colspan: 1
          }
        } else {
          return {
            rowspan: 0,
            colspan: 0
          }
        }
      }
    }
  },
  filters: {
    /**
     * 考生答案过滤处理
     * @param {Array} 考生答案数组
     * @param {String,Number} 题目类型
     */
    answer(arr, tktype) {
      if (arr !== undefined) {
        let ans = arr.toString();
        if (ans === "") {
          return "--";
        } else {
          if (tktype == 4) {
            return ans === "1" ? "正确" : "错误";
          } else {
            return ans;
          }
        }
      }
    }
  }
};
</script>
<style scoped>
.big-question-title {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 10px;
}
</style>
