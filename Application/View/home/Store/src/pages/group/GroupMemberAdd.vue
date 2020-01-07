<template>
  <div>
    <el-input @change="search" placeholder="请输入内容" v-model="memberSearch" class="ks-max-w-fit">
      <i class="el-icon-search el-input__icon ks-cursor-pointer" slot="suffix" @click="search"></i>
    </el-input>

    <div class="member-box ks-mt20">
      <div class="member-item" v-if="list.length">
        <div class="member-count" v-for="(item,i) in list" :key="i">
          <el-checkbox v-model="item.checkbox" @change="setSelected(item)"></el-checkbox>
          <ks-create-bg class="member-head" :src="item.head" type="user"/>
          {{item.name || item.username}}
        </div>
      </div>
      <div class="ks-empty" v-else-if="!list.length && loaded">没有相关内容</div>
    </div>

    <div class="clearfix">
      <div class="ks-fl">
        <el-button type="primary" @click="onSubmit">确定</el-button>
        <el-button @click="$emit('cancel')">取消</el-button>
      </div>
      <div class="ks-fr">
        <el-pagination
          background
          layout="prev, pager, next"
          @current-change="getMemberList"
          :current-page="p"
          :page-count="pageCount"
        ></el-pagination>
      </div>
    </div>
  </div>
</template>
<script>
import { getIsScrolltolower } from "@/utils";
import { showMemberList, teamAddMember } from "@/api/group";

export default {
  name: "MemberAdd",
  data() {
    return {
      selectedList: [],
      id: this.$route.params.id,
      loaded: false,
      /**
       * 搜索关键词
       */
      memberSearch: "",

      /**
       * 学员数据列表
       */
      list: [],
      /**
       * 分页信息
       */
      p: 1,
      pageCount: null
    };
  },
  methods: {
    /**
     * 设置当前选择的会员
     */
    setSelected(item) {
      let userId = item.userid;
      let isRepeat = false;
      this.selectedList.map(value => {
        if (value === userId) {
          isRepeat = true;
        }
      });
      if (!isRepeat) {
        this.selectedList.push(userId);
      }
    },
    /**
     * 获取学员列表
     */
    getMemberList(p = 1) {
      this.p = p;
      let params = {
        team_id: this.id,
        p: p,
        maxperpage: 7
      };
      if (this.memberSearch) {
        params.keyword = this.memberSearch;
      }
      showMemberList(params).then(res => {
        if (res.result === "error") {
          this.$msg(res.msg);
        } else {
          res.list.map(item => {
            let has = false;
            this.selectedList.map(value => {
              if (value === item.userid) {
                has = true;
              }
            });
            item.checkbox = has;
          });
          this.list = res.list;
          this.p = res.page.now_page;
          this.pageCount = res.page.total_pages;
        }
        this.loaded = true;
        this.$hideLoading();
      });
    },
    onSubmit() {
      teamAddMember({
        id: this.id,
        userid: this.selectedList
      }).then(res => {
        this.$msg(res.msg, res.result);
        if (res.result === "success") {
          this.$emit("change");
        }
      });
    },
    search() {
      this.list = [];
      this.getMemberList();
    }
  },
  mounted() {
    this.$showLoading();
    this.getMemberList();
  }
};
</script>
<style scoped>
.member-box {
  height: 450px;
  overflow-x: hidden;
  overflow-y: auto;
}
.member-box .member-item {
  margin: 0;
}
.member-count .member-head {
  width: 45px;
  height: 45px;
  display: block;
  border-radius: 50%;
  position: absolute;
  left: 30px;
  top: 50%;
  margin-top: -22px;
}

.member-count {
  font-size: 14px;
  padding-left: 90px;
  line-height: 60px;
  position: relative;
  height: 60px;
  overflow: hidden;
}
.member-count .el-checkbox {
  position: absolute;
  left: 0;
  top: 0;
}
</style>
