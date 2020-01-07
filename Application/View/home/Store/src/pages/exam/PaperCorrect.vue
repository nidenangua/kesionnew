<template>
  <div>
    <ks-container v-if="loaded">
      <el-main>
        <el-row class="ks-bo20">
          <el-col :span="4">试卷名称：2019英文六级模拟试卷一</el-col>
          <el-row :span="2">考试：sky1011</el-row>
          <el-col :span="2">用时：10分16秒</el-col>
          <el-row :span="2">得分: 20(客观题得分20分)</el-row>
          <el-row></el-row>
        </el-row>
        <el-row>
          <el-col :span="24">
            <el-table
              ref="multipleTable"
              :data="tableData"
              tooltip-effect="dark"
              style="width: 100%"
              @selection-change="handleSelectionChange"
            >
              <el-table-column type="index" width="55" label="序号"></el-table-column>
              <el-table-column prop="level" label="题目"></el-table-column>
              <el-table-column prop="typeName" label="考试答案"></el-table-column>
              <el-table-column prop="title" label="是否正确" width="120"></el-table-column>
              <el-table-column prop="inputer" label="得分"></el-table-column>
              <el-table-column prop="adddate" label="点评"></el-table-column>
            </el-table>
          </el-col>
        </el-row>
      </el-main>
    </ks-container>
  </div>
</template>
<script>
import { getExamRecord } from "@/api/exam";
export default {
  name: "ParperMarking",
  data() {
    return {
      loaded: true,
      searchContent: "",
      select: "",
      selectedList: [],
      p: 1,
      pageCount: null,
      tableData: [],
      totalPut: 0,
      currpage: 0,
      //
      UserType: [
        {
          value: "0",
          label: "用户名"
        }
      ],

      multipleSelection: []
    };
  },
  methods: {
    getList() {
      this.$showLoading();
      let params = {
        p: this.p,
        categoryid: "2019"
      };

      if (this.searchContent) {
        params.keyword = this.searchContent;
      }
      getExamRecord(params).then(res => {
        this.tableData = res.list;
        this.p = res.page.now_page;
        this.pageCount = res.page.total_pages;
        this.totalPut = parseInt(res.page.totalput);
        this.$hideLoading();
      });
    },
    handleSelectionChange(val) {
      this.multipleSelection = val;

      if (this.multipleSelection) {
        let tkidarr = [];
        this.multipleSelection.map(res => {
          tkidarr.push(res.tkid);
        });
        this.tkidArr = tkidarr;
      }
    },
    handleCurrentChange(currpage) {
      this.tableData = [];
      this.p = currpage;
      this.getList();
    },
    golist(val) {
      this.tkhard = val;
      this.tableData = [];
      this.getList();
    },
    /**
     * 下拉菜单
     */
    handleCommand(command) {
      if (command.type == 2) {
        this.del(command.id);
      } else {
        this.tkidparames = command.arr.tkid;
        console.log(this.tkidparames);
        if (command.arr.tktype == 1 || command.arr.tktype == 6) {
          this.TkChoice = true;
          this.typesValue = command.arr.tktype;
        } else {
          this.TkVisible = true;
          this.typesValue = command.arr.tktype;
        }
      }
    }
  },
  activated() {
    this.activeName = "second";
    this.searchContent = "";
    this.select = "";
    this.selectedList = [];
    this.p = 1;
    this.pageCount = null;
    this.tableData = [];
    this.totalPut = 0;
    this.currpage = 0;
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
</style>


