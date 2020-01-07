<template>
  <div class="wx-msg-list">
    <el-dialog title="消息回复" :visible.sync="visible" width="640px">
      <wx-msg-reply :reply-user="replyUser" v-if="visible"/>
    </el-dialog>
    <div class="ks-mt30 ks-pd20 clearfix">
      <el-input
        @change="getDataList()"
        placeholder="请输入搜索内容"
        v-model="keyword"
        class="ks-max-w-fit"
      >
        <i
          class="el-icon-search el-input__icon ks-cursor-pointer"
          slot="suffix"
          @click="getDataList()"
        ></i>
      </el-input>
    </div>

    <el-table class="wx-msg-list__table" :data="tableData">
      <el-table-column label="选择" width="80">
        <template slot-scope="scope">
          <el-checkbox v-model="scope.row.checked"/>
        </template>
      </el-table-column>
      <el-table-column label="用户头像" width="160">
        <ks-create-bg
          type="user"
          class="wx-msg-list__table__avatar"
          slot-scope="scope"
          :src="scope.row.headimgurl"
        />
      </el-table-column>
      <el-table-column prop="nickname" label="昵称"></el-table-column>

      <el-table-column prop="city" label="城市" width="200"></el-table-column>
      <el-table-column label="消息管理" width="200">
        <template slot-scope="scope">共{{scope.row.readNum}}条 | {{scope.row.noreadNum}}未读</template>
      </el-table-column>
      <el-table-column label="消息管理" width="140">
        <el-button @click="replyMsg(scope.row)" slot-scope="scope">消息回复</el-button>
      </el-table-column>
    </el-table>
    <ks-table-footer
      v-if="tableData.length"
      :pagination="pagination"
      select-key="fromusername"
      :table-data="tableData"
      @current-change="getDataList"
      @trigger="deleteItem"
      delete-call-type="array"
    />
  </div>
</template>
<script>
/**
 * 留言管理
 */
import WxMsgReply from "./WxMsgReply";
import { getManageList, delManageList } from "@/api/wechat";
export default {
  name: "WxMsgList",
  data() {
    return {
      visible: false,
      replyUser: {},
      /**
       * 表格数据
       */
      tableData: [],
      /**
       * 关键词
       */
      keyword: "",

      /**
       * 分页信息
       */
      pagination: {
        total: 0,
        current: 0
      }
    };
  },
  methods: {
    /**
     * 获取数据列表
     */
    getDataList(_p = 1) {
      this.$showLoading();
      getManageList({
        p: _p,
        keyword: this.keyword,
        maxperpage: 10
      }).then(res => {
        res.list.map(item => {
          item.nickname = item.nickname || "游客";
          item.city = item.city || "未知";
          item.checked = false;
        });
        this.tableData = res.list;
        this.pagination.total = res.page.total_pages;
        this.pagination.current = res.page.now_page;
        this.$hideLoading();
      });
    },
    /**
     * 删除数据
     */
    deleteItem(delArray) {
      delManageList({
        fromusername: delArray
      }).then(res => {
        if (res.result === "success") {
          this.$msg("删除成功", "success").then(() => {
            this.getDataList();
          });
        } else {
          this.$msg(res.msg);
        }
      });
    },
    /**
     * 消息回复
     */
    replyMsg(item) {
      this.replyUser = item;
      this.visible = true;
    }
  },
  mounted() {
    this.getDataList();
  },
  components: {
    WxMsgReply
  }
};
</script>
<style scoped>
.wx-msg-list__table {
  width: 100%;
}

.wx-msg-list__table__avatar {
  width: 60px;
  height: 60px;
}
</style>

