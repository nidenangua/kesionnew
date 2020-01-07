<template>
  <ks-container>
    <ks-title name="批改试卷" border="none"/>
    <el-row class="ks-bo20">
      <el-col :span="16">
        <el-select v-model="screening" placeholder="请选择难度" class="ks-w150" @change="golist">
          <el-option
            v-for="item in searchType"
            :key="item.value"
            :label="item.label"
            :value="item.value"
          ></el-option>
        </el-select>
        <el-input
          placeholder="请输入搜索关键词"
          v-model="searchContent"
          @change="getList"
          class="input-with-select"
        >
          <el-button slot="append" icon="el-icon-search"></el-button>
        </el-input>
      </el-col>
      <el-col :span="8" align="right">
        <el-button type="primary" @click="bathMark">批量阅卷</el-button>
        <!-- <el-button type="primary" @click="comment">批量写评语</el-button> -->
        <el-button type="primary" @click="allDel(tkidArr)">批量删除</el-button>
        <!-- <el-button type="primary">导出</el-button> -->
      </el-col>
    </el-row>
    <el-row>
      <el-col :span="24">
        <el-table
          :data="tableData"
          tooltip-effect="dark"
          style="width: 100%"
          @selection-change="handleSelectionChange"
        >
          <el-table-column type="selection" width="55"></el-table-column>
          <el-table-column type="index" width="55" label="序号"></el-table-column>
          <el-table-column prop="username" label="考生" width="150"></el-table-column>
          <el-table-column prop="adddate" label="考试时间"></el-table-column>
          <el-table-column prop="time" label="用时"></el-table-column>
          <el-table-column label="是否已阅卷">
            <template slot-scope="scope" width="150">
              <span
                :class="{'ks-color-success':scope.row.iscorrect=='已阅卷'}"
              >{{scope.row.iscorrect}}</span>
            </template>
          </el-table-column>
          <el-table-column label="总分" prop="paper_score"></el-table-column>
          <el-table-column label="得分">
            <span class="ks-color-primary" slot-scope="scope">{{scope.row.sumscore}}</span>
          </el-table-column>

          <el-table-column label="操作" width="80">
            <template slot-scope="scope">
              <el-dropdown trigger="click" @command="handleCommand">
                <span class="el-dropdown-link">
                  <i class="el-icon-more"></i>
                </span>
                <el-dropdown-menu slot="dropdown">
                  <el-dropdown-item :command="{type:'1',arr:scope.row}">批改试卷</el-dropdown-item>
                  <el-dropdown-item :command="{type:'2',arr:scope.row,index:scope}">删除</el-dropdown-item>
                </el-dropdown-menu>
              </el-dropdown>
            </template>
          </el-table-column>
        </el-table>
      </el-col>
    </el-row>

    <div align="right" class="ks-mt20">
      <el-pagination
        background
        layout="prev, pager, next"
        :current-page="p"
        :page-count="pageCount"
        @current-change="handleCurrentChange"
      ></el-pagination>
    </div>
  </ks-container>
</template>
<script>
import { getExamRecordList, del } from "@/api/exam";
export default {
  name: "ParperMarkingList",
  data() {
    return {
      /**搜索关键词 */
      searchContent: "",
      /**当前页数 */
      p: 1,
      /**总页数 */
      pageCount: null,

      /**列表数据 */
      tableData: [],
      totalPut: 0,
      /**搜索类型 */
      searchType: [
        {
          value: "0",
          label: "用户名"
        }
      ],
      /**当前搜索类型 */
      screening: "用户名",
      /**已选择列表 */
      multipleSelection: [],
      /**已选tkid */
      tkidArr: [],
      /**当前试卷id */
      paperid: 0
    };
  },
  activated() {
    this.searchContent = "";
    this.p = 1;
    this.paperid = this.$route.query.paperId
    this.pageCount = null;
    this.tableData = [];
    this.totalPut = 0;
    this.getList();
  },
  methods: {
    getList() {
      this.$showLoading();
      let params = {
        p: this.p,
        paperid: this.paperid,
        maxperpage: 10
      };

      if (this.searchContent) {
        params.keyword = this.searchContent;
      }
      getExamRecordList(params).then(res => {
        res.list.map(data => {
          data.time == 0 ? "1" : data.time;
          if (data.iscorrect == 0) {
            data.iscorrect = "未阅卷";
          } else {
            data.iscorrect = "已阅卷";
          }
          if (data.time == 0) {
            data.time = "1" + "分";
          } else {
            data.time = data.time + "分";
          }
        });
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
          tkidarr.push(res.id);
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
      this.tableData = [];
      this.getList();
    },
    /**
     * 下拉菜单
     */
    handleCommand(command) {
      if (command.type == 1) {
        this.$router.push({
          path: "/exam/marking",
          query: {
            id: command.arr.id,
            paperid: this.paperid
          }
        });
      } else if (command.type == 2) {
        this.del(command.arr.id, command.$index);
      }
    },
    /**
     * 批量阅卷
     */
    bathMark() {
      this.$router.push({
        path: "/exam/BatchMark",
        query: {
          paperid: this.paperid
        }
      });
    },
    /**
     * 批量写评语
     */
    comment() {
      this.$router.push({
        path: "/exam/BatchComment",
        query: {
          paperid: this.paperid
        }
      });
    },

    del(id, index) {
      del({
        type: 3,
        id: id
      }).then(res => {
        if (res.result == "success") {
          this.tableData.splice(index, 1);
        }
      });
    },

    /**
     * 批量删除
     * @param {Array}
     */
    allDel(ids = []) {
      if (!ids.length) {
        this.$msg("请先选择要删除项");
        return;
      }
      del({
        type: 3,
        id: ids
      }).then(res => {
        if (res.result == "success") {
          this.$msg("删除成功", "success")
          this.getList()
        }
      })
    }
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
.iscorrect {
  color: #1edc1e;
}
</style>


