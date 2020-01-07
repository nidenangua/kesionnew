<template>
  <div>
    <el-main>
      <el-row class="ks-bo20">
        <el-col :span="16">
          <el-select v-model="tkhard" placeholder="请选择难度" class="ks-w150" @change="golist">
            <el-option
              v-for="item in options1"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            ></el-option>
          </el-select>
          <el-input placeholder="请输入内容" v-model="searchContent" class="input-with-select">
            <el-button slot="append" icon="el-icon-search"></el-button>
          </el-input>
        </el-col>
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
            <el-table-column label="选择" width="55">
              <template slot-scope="scope">
                <el-checkbox v-model="scope.row.checked" :disabled="scope.row.disabled"/>
              </template>
            </el-table-column>
            <el-table-column type="index" width="55" label="序号"></el-table-column>
            <el-table-column prop="level" label="难度系数" width="120"></el-table-column>
            <el-table-column prop="typeName" label="题目类型" width="120"></el-table-column>
            <el-table-column prop="title" label="题目"></el-table-column>
            <el-table-column prop="inputer" label="题目来源"></el-table-column>
            <el-table-column prop="adddate" label="添加时间"></el-table-column>
          </el-table>
        </el-col>
      </el-row>
    </el-main>
    <el-footer>
      <div style="text-align:center">
        <el-button type="primary" class="fl" @click="save">保存</el-button>
        <div class="fr">
          <el-pagination
            background
            layout="prev, pager, next"
            :total="totalPut"
            @current-change="handleCurrentChange"
          ></el-pagination>
        </div>
      </div>
    </el-footer>
  </div>
</template>
<script>
import { checkModuleHasOpen } from "@/api/store";
import { getTkList, getRandomTk } from "@/api/exam";
export default {
  name: "PaperAdd",
  props: ["tkid"],
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
      //选择题型
      options: [
        {
          value: "1",
          label: "单选题"
        },
        {
          value: "2",
          label: "填空题"
        },
        {
          value: "3",
          label: "判断题"
        },
        {
          value: "4",
          label: "简答题"
        },
        {
          value: "5",
          label: "组合题"
        },
        {
          value: "6",
          label: "多选题"
        }
      ],
      //选择难度系数
      options1: [
        {
          value: "0",
          label: "不限"
        },
        {
          value: "1",
          label: "低"
        },
        {
          value: "2",
          label: "中"
        },
        {
          value: "3",
          label: "高"
        }
      ],
      tktype: "1",
      tkhard: "0",
      categoryid: "",
      pretype: ""
    };
  },
  methods: {
    save() {
      let arr = [];
      this.tableData.map(item => {
        if (item.checked && item.disabled === false) {
          arr.push(item);
        }
      });
      this.$emit("callback", arr);
      this.$emit("update:dialogVisible", false);
    },

    getList(tktype) {
      getTkList({
        p: this.p,
        tktype: tktype,
        level: this.tkhard,
        categoryid: this.categoryid
      }).then(res => {
        res.list.map(item => {
          item.checked = false;
          item.disabled = false;
        });
        this.tableData = res.list;
        this.p = res.page.now_page;
        this.pageCount = res.page.total_pages;
        this.totalPut = parseInt(res.page.totalput);
        this.tableData.map(item => {
          this.selectedList.map(selectedItem => {
            if (selectedItem.tkid == item.tkid) {
              item.checked = true;
              item.disabled = true;
            }
          });
        });
      });
    },

    handleSelectionChange(val) {
      this.multipleSelection = val;
    },
    handleCurrentChange(currpage) {
      this.tableData = [];
      this.p = currpage;
      this.getList();
    },
    golist() {
      this.getList();
    },
    consoleBak() {},
    /**
     * 初始化数据
     */
    reset(params) {
      this.p = 1;
      this.categoryid = params.categoryid;
      this.selectedList = params.selectedList;
      this.getList(params.tktype);
      this.pretype = params.pretype;
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
</style>


