<template>
  <div>
    <div class="ks-mt15">
      <el-select class="ks-mr10" v-model="trendList" placeholder="成员名称">
        <el-option
          v-for="item in options"
          :key="item.value"
          :label="item.label"
          :value="item.value"
        ></el-option>
      </el-select>
      <el-input @change="getList" placeholder="请输入内容" v-model="trendSearch" class="ks-max-w-fit">
        <i class="el-icon-search el-input__icon ks-cursor-pointer" slot="suffix" @click="getList"></i>
      </el-input>

      <el-button type="primary" class="ks-ml20 ks-fr" @click="memberAdd()">添加成员</el-button>
    </div>

    <el-table class="ks-mt30" :data="tableData" @selection-change="handleSelectionChange">
      <el-table-column type="selection" width="55"></el-table-column>

      <el-table-column label="成员">
        <template slot-scope="scope">
          <div class="group-member">
            <ks-create-bg class="group-head" :src="scope.row.userinfo.head" type="user"/>
            {{scope.row.realname || scope.row.userinfo.realname || scope.row.userinfo.username }}
          </div>
        </template>
      </el-table-column>
      <el-table-column label="成员性质" width="120">
        <template slot-scope="scope">
          <span :class="{active:scope.row.role == 2}">{{ scope.row.role == 1 ? '成员': '群主' }}</span>
        </template>
      </el-table-column>
      <el-table-column label="状态" width="120">
        <template slot-scope="scope">
          <span>{{ scope.row.status == 2 ? '黑名单': '正常' }}</span>
        </template>
      </el-table-column>
      <el-table-column label="加入时间" width="200" prop="create_time"></el-table-column>
      <el-table-column label="联系电话" prop="mobile" width="200"></el-table-column>
      <el-table-column label="动态数" prop="topics_num" width="100"></el-table-column>

      <el-table-column label="操作" width="80">
        <template slot-scope="scope">
          <el-dropdown trigger="click" @command="handleCommand">
            <span class="el-dropdown-link">
              <i class="el-icon-more"></i>
            </span>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item
                :command="{type:'1',userId:scope.row.userid}"
              >{{ scope.row.role == 1 ? '设为群主' : ' 取消群主'}}</el-dropdown-item>
              <el-dropdown-item :command="{type:'3',id:scope.row.id}">加入黑名单</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </template>
      </el-table-column>
    </el-table>

    <div class="ks-mt20" v-if="tableData.length">
      <el-button @click="allUpData">移入黑名单</el-button>
      <div class="ks-fr">
        <el-pagination
          background
          layout="prev, pager, next"
          @current-change="getList"
          :current-page="p"
          :page-count="pageCount"
        ></el-pagination>
      </div>
    </div>

    <el-dialog width="700px" :visible.sync="addMemberVisble">
      <group-member-add
        v-if="addMemberVisble"
        @change="addMemberVisble = false; getList()"
        @cancel="addMemberVisble = false"
      />
    </el-dialog>
  </div>
</template>
<script>
import GroupMemberAdd from "./GroupMemberAdd";
import { getTeamMemberList, updateStatus, setRole } from "@/api/group";
export default {
  name: "TopList",
  data() {
    return {
      /**
       * 搜索选项
       */
      trendList: "成员名称",
      trendSearch: null,
      options: [
        {
          value: "选项1",
          label: "成员名称"
        }
      ],
      /**
       * 选择成员窗口
       */
      addMemberVisble: false,
      /**
       * 数据列表
       */
      tableData: [],
      /**
       * 社群id
       */
      grouopId: this.$route.params.id,
      /**
       * 分页信息
       */
      pageCount: null,
      p: 1
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
     * 下拉菜单
     */
    handleCommand(item) {
      if (item.type == 3) {
        this.upData(item.type, item.id);
      } else if (item.type == 1) {
        this.setUp(item.userId);
      }
    },
    /**
     * 设置黑名单
     */
    upData(type, id) {
      this.$confirm(
        "移入黑名单后，该用户只能查看动态，不能发表、点赞和评论?",
        "提示",
        {
          confirmButtonText: "确定",
          cancelButtonText: "取消",
          type: "warning"
        }
      ).then(() => {
        updateStatus({
          type: type,
          id: id
        }).then(res => {
          this.$msg(res.msg, res.result);
          if (res.result === "success") {
            this.getList();
          }
        });
      });
    },
    /**
     * 设置群主
     */
    setUp(userId) {
      setRole({
        userid: userId,
        team_id: this.grouopId
      }).then(res => {
        this.$msg("设置成功", "success");
        this.getList();
      });
    },
    /**
     * 获取成员列表
     */
    getList(p = 1) {
      this.p = p;
      let params = {
        p: p,
        id: this.grouopId,
        maxperpage: 10
      };
      if (this.searchKey) {
        params.keyword = this.searchKey;
      }
      getTeamMemberList(params).then(res => {
        if (res.result === "error") {
          this.$msg(res.msg);
        } else {
          res.list.map(item => {
            item.mobile = item.mobile || "暂无";
          });
          this.tableData = res.list;
          this.pageCount = res.page.total_pages;
        }
      });
    },
    /**
     * 批量移入黑名单
     */
    allUpData() {
      let setArr = [];
      this.multipleSelection.map(item => {
        setArr.push(item.id);
      });
      this.upData(3, setArr);
    },
    /**
     * 添加成员
     */
    memberAdd() {
      this.addMemberVisble = true;
    }
  },
  mounted() {
    this.getList();
  },
  components: {
    GroupMemberAdd
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
  padding-left: 60px;
}
.group-member .group-head {
  width: 50px;
  height: 50px;

  border-radius: 50%;
  position: absolute;
  left: 0;
  top: 5px;
}

.active {
  color: red;
}
</style>


