<template>
  <div>
    <auto-reply-alert v-if="loaded" :auto-reply-switch.sync="autoReplySwitch" :type="3"/>
    <div v-show="autoReplySwitch">
      <div v-if="view === 'list'">
        <div class="ks-mt30 ks-pd20 clearfix">
          <el-input
            @change="getRuleList()"
            placeholder="请输入规则名称搜索"
            v-model="keyword"
            class="ks-max-w-fit ks-fl"
          >
            <i
              class="el-icon-search el-input__icon ks-cursor-pointer"
              slot="suffix"
              @click="getRuleList()"
            ></i>
          </el-input>

          <el-button class="ks-fr" type="primary" @click="view = 'add'">添加回复</el-button>
        </div>
        <el-table :data="tableData">
          <el-table-column prop="checked" label="选择" width="80">
            <template slot-scope="scope">
              <el-checkbox v-model="scope.row.checked"/>
            </template>
          </el-table-column>
          <el-table-column prop="rule" label="规则名称" width="280"></el-table-column>
          <el-table-column prop="str_keywords" label="关键词" width="240"></el-table-column>
          <el-table-column label="回复内容" prop="str_contents"></el-table-column>
          <el-table-column label="操作" width="140">
            <template slot-scope="scope">
              <span class="ks-link-color ks-cursor-pointer" @click="editKeyword(scope.row)">编辑</span>
              <span
                class="ks-link-color ks-ml15 ks-cursor-pointer"
                @click="deleteKeyWords(scope.row.id)"
              >删除</span>
            </template>
          </el-table-column>
        </el-table>
        <ks-table-footer
          class="ks-mt20"
          v-if="tableData.length"
          :pagination="pagination"
          :table-data="tableData"
          @current-change="getRuleList"
          @trigger="deleteKeyWords"
        />
      </div>
      <add-keywords :rule-info.sync="ruleInfo" :view.sync="view" @success="getRuleList" v-else/>
    </div>
  </div>
</template>
<script>
import { getWechatKeyWords, deleteWechatKeyWords } from "@/api/wechat";
import AutoReplyAlert from "./compoents/AutoReplyAlert";
import AddKeywords from "./AddKeywords";

export default {
  name: "ReplyKeywords",
  data() {
    return {
      /**
       * 数据加载状态
       */
      loaded: false,
      /**
       * 当前显示视图，列表或添加关键词
       */
      view: "list",
      /**
       * 回复开关
       */
      autoReplySwitch: false,
      ruleInfo: {},
      /**
       * 关键词
       */
      keyword: "",
      /**
       * 表格数据
       */
      tableData: [],
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
    getRuleList(p = 1) {
      /**
       * 获取关键词列表
       */
      this.$showLoading();
      getWechatKeyWords({
        type: 3,
        page: p,
        keyword: this.keyword,
        maxperpage: 10
      }).then(res => {
        if (res.result === "success") {
          this.autoReplySwitch = res.isfocus == 1 ? true : false;
          res.keywords.map(item => {
            let arr_keywords = [];
            item.keywords.map(a => {
              arr_keywords.push(a.keyword);
            });
            item.str_keywords = arr_keywords.join(", ");
            let str_contents = "";
            let contents = item.contents[0];
            if (contents) {
              let replytype = contents.replytype;
              switch (replytype) {
                case "text":
                  str_contents = "文本";
                  break;
                case "course":
                  str_contents = `课程-《${contents.list.title}》`;
                  break;
                case "live":
                  str_contents = `直播-《${contents.list.title}》`;
                  break;
                case "column":
                  str_contents = `专栏-《${contents.list.title}》`;
                  break;
              }
            }

            item.str_contents = str_contents;
            item.checked = false;
          });
          this.tableData = res.keywords;

          this.pagination.total = res.page.total_pages;
          this.pagination.current = res.page.now_page;
          this.$hideLoading();
        } else {
          this.$msg(res.msg);
        }
        this.loaded = true;
      });
    },
    /**
     * 编辑关键词规则
     */
    editKeyword(item) {
      this.ruleInfo = item;
      this.view = "add";
    },
    /**
     * 删除关键词规则
     */
    deleteKeyWords(ids) {
      deleteWechatKeyWords({
        id: ids
      }).then(res => {
        if (res.result === "success") {
          this.$msg("删除成功", "success").then(() => {
            this.getRuleList();
          });
        } else {
          this.$msg(res.msg);
        }
      });
    }
  },
  mounted() {
    this.getRuleList();
  },
  components: {
    AddKeywords,
    AutoReplyAlert
  }
};
</script>
