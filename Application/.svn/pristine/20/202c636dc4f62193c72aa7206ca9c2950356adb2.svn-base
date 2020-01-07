<template>
  <ks-container v-if="loading">
    <ks-title name="商品规格设置"/>
    <el-row class="add-group">
      <router-link to="/addgroup">
        <el-button type="primary" icon="iconfont icon-plus" size="small">添加规格组</el-button>
      </router-link>
    </el-row>
    <div>
      <el-table
        ref="multipleTable"
        :data="tableDataList"
        tooltip-effect="dark"
        style="width: 100%"
        @selection-change="handleSelectionChange"
      >
        <el-table-column type="selection" width="55"></el-table-column>
        <el-table-column prop="name" label="规格组名称"></el-table-column>
        <el-table-column prop="specail_name" label="规格组属性"></el-table-column>
        <el-table-column label="操作" align="center" width="100">
          <template slot-scope="scope">
            <el-dropdown trigger="click" placement="bottom">
              <span class="table-operation">...</span>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item>复制</el-dropdown-item>
                <router-link :to="{name:'AddGroup',query:{id:scope.row.id}}">
                  <el-dropdown-item>编辑</el-dropdown-item>
                </router-link>
                <span @click="deleteGroup(scope.row.id)">
                  <el-dropdown-item>删除</el-dropdown-item>
                </span>
              </el-dropdown-menu>
            </el-dropdown>
          </template>
        </el-table-column>
      </el-table>
      <el-button plain size="mini" class="delete-btn" @click="deleteGroup">
        <i class="iconfont icon-shanchu1"></i>
      </el-button>
    </div>
    <footer>
      <el-pagination
        layout="prev, pager, next"
        background=""
        :total="+page.totalput"
        :current-page.sync="currentPage"
        :page-size="+page.maxperpage"
        @current-change="handleCurrentChange"
      ></el-pagination>
    </footer>
  </ks-container>
</template>

<script>
import { commodityList, delCommodity } from "@/api/microportal";
export default {
  name: "GoodsSet",
  data() {
    return {
      loading: false,
      /**表格数据信息 */
      tableDataList: [],
      /**分页信息 */
      page: null,
      /**当前页数 */
      currentPage: 1,
      /**选中的表格项 */
      multipleSelection: []
    };
  },
  activated() {
    this.loading = false;
    this.multipleSelection = [];
    this.currentPage = 1;
    this.getCommodityList();
  },
  methods: {
    /**删除规格组 */
    deleteGroup(id) {
      if (id > 0) {
        this.delCommodityList({ id: [id] });
        return;
      }
      if (this.multipleSelection.length > 0) {
        let delArr = [];
        this.multipleSelection.forEach(el => {
          delArr.push(el.id);
        });
        this.delCommodityList({ id: delArr });
      }
    },
    /**表格选项发生变化时触发 */
    handleSelectionChange(arr) {
      this.multipleSelection = arr;
    },

    /**页数发生变化时触发 */
    handleCurrentChange(index) {
      this.currentPage = index;
      this.getCommodityList({ p: index });
    },

    /**获取规格组列表 */
    getCommodityList(params) {
      let defaultParams = {
        p: 1,
        maxperpage: 10
      };
      commodityList({ ...defaultParams, ...params }).then(res => {
        this.tableDataList = res.list;
        this.page = res.page;
        this.loading = true;
      });
    },
    /**删除规格组 */
    delCommodityList(params) {
      delCommodity(params).then(res => {
        this.getCommodityList({ p: this.currentPage });
      });
    }
  }
};
</script>

<style scoped>
.add-group {
  text-align: right;
  margin: 10px 0;
}
.table-operation {
  display: inline-block;
  width: 50px;
  font-size: 16px;
  font-weight: bold;
}
.delete-btn {
  margin-top: 10px;
}
footer {
  text-align: right;
}
</style>
