<template>
  <div>
    <el-table :data="tableData" @selection-change="handleSelectionChange">
      <el-table-column type="selection" width="55"></el-table-column>

      <el-table-column label="申请成员">
        <template slot-scope="scope">
          <div class="group-member">
            <ks-create-bg class="group-head" :src="scope.row.userinfo.head" type="user"/>
            {{ scope.row.userinfo.name }}
          </div>
        </template>
      </el-table-column>
      <el-table-column label="申请内容" prop="content"></el-table-column>
      <el-table-column label="加入时间" prop="create_time"></el-table-column>
      <el-table-column label="联系电话" prop="mobile"></el-table-column>

      <el-table-column label="操作">
        <template slot-scope="scope">
          <span class="group-bule ks-cursor-pointer" @click="setStatue(scope.row.id,1)">通过</span>
          <span class="ks-cursor-pointer" @click="setStatue(scope.row.id,-1)">驳回</span>
        </template>
      </el-table-column>
    </el-table>

    <div class="ks-mt20" v-if="tableData.length">
      <el-button @click="allsetStatue(1)">批量通过</el-button>
      <el-button @click="allsetStatue(-1)">批量驳回</el-button>

      <div class="ks-fr" v-if="tableData.lenght < 1">
        <el-pagination background layout="prev, pager, next" :total="pageCount"></el-pagination>
      </div>
    </div>
  </div>
</template>
<script>
import { applicationList, checkMember } from "@/api/group";
import { domap } from "@/utils";
export default {
  name: "ApplyList",
  data() {
    return {
      tableData: [],
      grouopId: this.$route.params.id, //社群详情id,
      pageCount: null
    };
  },
  methods: {
    /**
     * 全选
     */
    toggleSelection(rows) {
      if (rows) {
        rows.forEach(row => {
          this.$refs.multipleTable.toggleRowSelection(row);
        });
      } else {
        this.$refs.multipleTable.clearSelection();
      }
    },
    /**
     * 取消全选
     */
    handleSelectionChange(val) {
      this.multipleSelection = val;
    },
    /**
     * 申请通过/驳回
     */
    setStatue(id, status) {
      checkMember({
        team_id: this.grouopId,
        id: id,
        status: status
      }).then(res => {
        this.$msg("设置成功", "success");
        this.getApplist();
      });
    },
    /**
     * 全申通过
     */
    allsetStatue(status) {
      let setArr = [];
      let type = status;
      domap(this.multipleSelection, item => {
        setArr.push(item.id);
      });
      console.log(type, setArr);
      this.setStatue(setArr, type);
    },
    /**
     * 申请列表
     */
    getApplist() {
      applicationList({
        team_id: this.grouopId
      }).then(res => {
        this.tableData = res.list;
        this.pageCount = res.page.total_pages;
      });
    }
  },
  mounted() {
    this.getApplist();
  }
};
</script>

<style scoped>
.is-top {
  padding: 2px;
  border: 1px solid #e5412c;
  color: #e5412c;
}
.is-hot {
  padding: 2px;
  border: 1px solid #44d58e;
  color: #44d58e;
}
.group-member {
  position: relative;
  height: 60px;
  line-height: 60px;
  padding-left: 70px;
}
.group-member .group-head {
  width: 60px;
  height: 60px;

  border-radius: 50%;
  position: absolute;
  left: 0;
}
.group-bule {
  color: #4cb0ee;
  padding-right: 15px;
}
</style>


