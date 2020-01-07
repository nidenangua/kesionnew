<template>
  <div>
    <div style="margin:15px 0 30px">
      <el-select v-model="trendList" placeholder="请选择" style="margin-right:10px">
        <el-option
          v-for="item in options"
          :key="item.value"
          :label="item.label"
          :value="item.value"
        ></el-option>
      </el-select>
      <el-input @change="search" placeholder="请输入内容" v-model="trendSearch" class="ks-max-w-fit">
        <i class="el-icon-search el-input__icon ks-cursor-pointer" slot="suffix" @click="search"></i>
      </el-input>
    </div>
    <el-table :data="tableData" @selection-change="handleSelectionChange">
      <el-table-column type="selection" width="55"></el-table-column>
      <el-table-column label="动态内容" prop="content"></el-table-column>
      <el-table-column label="动态类型">
        <div slot-scope="scope">
          <span v-if="scope.row.is_top == 1" class="is-top">置顶</span>
          <span v-if="scope.row.is_hot == 1" class="is-hot">精选</span>
          <span v-if="scope.row.is_notice == 1" class="is-notice">公告</span>
        </div>
      </el-table-column>
      <el-table-column label="成员" prop="userinfo.name"></el-table-column>
      <el-table-column label="发表时间" prop="create_time"></el-table-column>
      <el-table-column label="点赞数" prop="like_num"></el-table-column>
      <el-table-column label="评论数" prop="chat_num"></el-table-column>
      <el-table-column label="是否审核">
        <div slot-scope="scope">
          <el-switch
            v-model="scope.row.is_check"
            active-color="#13ce66"
            inactive-color="#ccc"
            active-value="1"
            inactive-value="0"
            @change="switchflag(scope.row)"
          ></el-switch>
        </div>
      </el-table-column>
      <el-table-column label="操作" width="60">
        <template slot-scope="scope">
          <el-dropdown @command="handleCommand" trigger="click">
            <span class="el-dropdown-link">
              <i class="el-icon-more"></i>
            </span>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item :command="{type:'0',id:scope.row.id}">预览</el-dropdown-item>
              <el-dropdown-item
                :command="{type:'1',id:scope.row.id}"
              >{{ scope.row.is_hot==1 ? '取消精选':'设为精选'}}</el-dropdown-item>
              <el-dropdown-item
                :command="{type:'2',id:scope.row.id}"
              >{{ scope.row.is_top==1 ? '取消置顶':'设为置顶'}}</el-dropdown-item>
              <el-dropdown-item
                :command="{type:'3',id:scope.row.id}"
              >{{ scope.row.is_notice==1 ? '取消群公告':'设为群公告'}}</el-dropdown-item>
              <el-dropdown-item :command="{type:'4',id:scope.row.id}">编辑</el-dropdown-item>
              <el-dropdown-item :command="{type:'5',id:scope.row.id}">删除</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </template>
      </el-table-column>
    </el-table>
    <div class="ks-mt20" v-if="tableData.length">
      <el-button @click="allTeamDel()">
        <i class="el-icon-delete"></i>
      </el-button>
      <div class="ks-fr">
        <el-pagination background="" layout="prev, pager, next" :total="pageCount"></el-pagination>
      </div>
    </div>
    <el-dialog title="动态详情" :visible.sync="dialogFormVisible">
      <div class="descript-box">
        <div class="descript-img">
          <img :src="TopicDetail.head">
        </div>
        <div class="descript-txt">
          <div class="descript-name">{{TopicDetail.name}}</div>
          <div class="descript-time">{{TopicDetail.time}}</div>
          <div class="descript-tit">{{TopicDetail.title}}</div>
          <div class="descript-info">{{TopicDetail.content}}</div>
          <div class="descript-zan clearfix">
            <span>评论 {{TopicDetail.member_num}}</span>
            <span>点赞 {{TopicDetail.like_num }}</span>
          </div>
        </div>
      </div>
      <div class="descript-commit">
        <div class="descript-s-tit">评论列表</div>
        <div class="descript-list">
          <ul class="clearfix">
            <li v-for="(item,i) in list" :key="i">
              <div class="list-box">
                <div class="list-img">
                  <img :src="item.userinfo.head">
                </div>
                <div class="list-txt">
                  <div class="list-name">{{item.userinfo.name}}</div>
                  <div class="list-time">{{item.create_time}}</div>
                  <div class="list-tit">{{item.content}}</div>
                  <div class="list-del" @click="teamDel(4,item.id,i)">删除</div>
                </div>
                <div class="list-zan">点赞 {{item.like_num}}</div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </el-dialog>
  </div>
</template>
<script>
import { domap } from "@/utils";
import {
  getTeamTopicList,
  setStatus,
  teamDel,
  getTopicDetail,
  getTrends
} from "@/api/group";
export default {
  name: "TopList",
  props: ["datatype"],
  data() {
    return {
      trendList: "content",
      trendSearch: "",
      multipleSelection: [],
      options: [{ value: "content", label: "动态内容" }],
      TopicDetail: {
        file_path: null,
        is_notice: null,
        is_top: null,
        is_hot: null,
        like_num: null,
        member_num: null,
        title: null,
        content: null,
        name: null,
        head: null,
        role: null,
        create_time: null,
        id: null
      },
      dialogFormVisible: false,
      tableData: [],
      grouopId: this.$route.params.id, //社群详情id,
      p: 1,
      list: [],
      pageCount: null
    };
  },
  methods: {
    toggleSelection(rows) {
      if (rows) {
        rows.forEach(row => {
          this.$refs.multipleTable.toggleRowSelection(row);
        });
      } else {
        this.$refs.multipleTable.clearSelection();
      }
    },

    handleSelectionChange(val) {
      this.multipleSelection = val;
    },

    /**
     * 搜索
     */
    search() {
      this.p = 1;
      this.getlist({
        sql_or_like:
          this.trendList === "content"
            ? {
                content: this.trendSearch
              }
            : {}
      });
    },
    /**
     * 下拉菜单
     */
    handleCommand(command) {
      if (command.type == 1 || command.type == 2 || command.type == 3) {
        this.updata(command.type, command.id);
      } else if (command.type == 5) {
        this.teamDel(2, command.id);
      } else if (command.type == 0) {
        this.dialog(command.id);
      }
    },
    /**
     * 操作权限
     */
    updata(type, topicId) {
      setStatus({
        team_id: this.$route.params.id,
        topic_id: topicId,
        type: type
      }).then(res => {
        this.$message({
          message: "设置成功",
          type: "success"
        });
      });
    },
    /**
     * 删除
     */
    teamDel: function(type, id,i) {
      teamDel({
        id: id,
        type: type
      }).then(res => {
        if (type == 2) {
          this.tableData = [];
          this.getlist();
        } else if (type == 4) {
          this.list.splice(i,1)
          this.$message({message:"删除成功",type:"success"})
          // this.list = [];
          // this.getTrendsList(id);
        }
      });
    },
    /**
     * 全选删除
     */
    allTeamDel() {
      let selectedids = [];
      domap(this.multipleSelection, item => {
        selectedids.push(item.id);
      });
      this.teamDel(2, selectedids);
    },
    /**
     * 弹窗
     */
    dialog(id) {
      this.dialogFormVisible = true;
      this.getdetail(id);
      this.getTrendsList(id);
    },
    /**
     * 动态列表
     */
    getlist(filter) {
      let data = {};
      if (filter) {
        data = filter;
      }
      if (this.datatype == 1) {
        data.is_notice = 1;
      }
      data.team_id = this.$route.params.id;
      getTeamTopicList({
        p: this.p,
        data: data,
        maxparper: 10
      }).then(res => {
        this.tableData = res.list;
        this.pageCount = res.page.total_pages;
      });
    },
    /**
     * 评论详情
     */
    getdetail(id) {
      getTopicDetail({
        topic_id: id
      }).then(res => {
        this.TopicDetail.file_path = res.file_path;
        this.TopicDetail.is_notice = res.is_notice;
        this.TopicDetail.is_top = res.is_top;
        this.TopicDetail.is_hot = res.is_hot;
        this.TopicDetail.like_num = res.like_num;
        this.TopicDetail.member_num = res.member_num;
        this.TopicDetail.title = res.title;
        this.TopicDetail.content = res.content;
        this.TopicDetail.head = res.userinfo.head;
        this.TopicDetail.name = res.userinfo.name;
        this.TopicDetail.role = res.role;
        this.TopicDetail.create_time = res.create_time;
        this.TopicDetail.id = res.id;
        this.loaded = true;
      });
    },
    /**
     * 动态列表
     */
    getTrendsList(id) {
      getTrends({
        p: this.p,
        maxparper: 10,
        data: {
          topic_id: id
        }
      }).then(res => {
        this.list = res.list;
      });
    },
    /**
     * switch open
     */
    switchflag(item) {
      this.updata(4, item.id);
    }
  },
  mounted() {
    this.getlist();
  }
};
</script>
<style scoped>
.is-top {
  padding: 2px;
  border: 1px solid #e5412c;
  color: #e5412c;
  display: inline-block;
  font-size: 12px;
  line-height: 13px;
}
.is-hot {
  padding: 2px;
  border: 1px solid #44d58e;
  color: #44d58e;
  display: inline-block;
  font-size: 12px;
  line-height: 13px;
}
.is-notice {
  padding: 2px;
  border: 1px solid #70c0f2;
  color: #70c0f2;
  display: inline-block;
  font-size: 12px;
  line-height: 13px;
}
.descript-box {
  position: relative;
  padding-left: 70px;
  border-bottom: 1px solid #eee;
  padding-bottom: 15px;
}
.descript-box .descript-img {
  position: absolute;
  left: 0;
}
.descript-box .descript-img img {
  width: 60px;
  height: 60px;
  border-radius: 50%;
}
.descript-box .descript-name {
  color: #353535;
  font-size: 16px;
}
.descript-box .descript-time {
  font-size: 14px;
  color: #888;
  margin: 10px 0;
}
.descript-box .descript-tit {
  font-size: 16px;
  color: #353535;
  margin-bottom: 10px;
}

.descript-box .descript-info {
  font-size: 14px;
  color: #888;
}
.descript-box .descript-zan {
  margin-top: 15px;
}
.descript-box .descript-zan span {
  float: right;
  font-size: 14px;
  color: #888;
  padding-left: 10px;
}
.descript-commi {
  margin-top: 30px;
}
.descript-commit .descript-s-tit {
  font-size: 16px;
  color: #353535;
}
.descript-commit {
  padding: 20px;
}
.descript-commit .descript-s-tit {
  margin: 20px 0;
  padding-bottom: 15px;
  border-bottom: 1px solid #eee;
}
.descript-commit .list-box {
  position: relative;
  padding-left: 60px;
  margin-bottom: 20px;
}
.descript-commit .list-box .list-img {
  position: absolute;
  left: 0;
}
.descript-commit .list-box .list-img img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
}
.descript-commit .list-box .list-name {
  font-size: 14px;
  color: #353535;
  line-height: 18px;
}
.descript-commit .list-box .list-time {
  font-size: 12px;
  color: #888;
  margin: 10px 0;
}
.descript-commit .list-box .list-del {
  color: #2f83ff;
  margin-top: 10px;
}
.descript-commit .list-box .list-zan {
  font-size: 14px;
  color: #888;
  position: absolute;
  right: 0;
  top: 50%;
}
</style>



