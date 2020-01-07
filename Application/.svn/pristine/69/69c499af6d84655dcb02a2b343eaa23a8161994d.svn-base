<template>
  <div>
    <div class="member-list" v-if="list.length">
      <ul>
        <li :class="i < list.length-1 && 'line'" v-for="(item,i) in list" :key="i">
          <ks-create-bg :src="item.userinfo.head" type="user"/>
          {{item.userinfo.name}}
        </li>
      </ul>
    </div>
    <empty msg="暂时还未有相关学员~" type="notest" v-else-if="loaded"/>
    <div class="ks-nomore" v-if="pageCount !== null && p >= pageCount">没有更多学员了~</div>
    <div class="ks-nomore" v-else>上拉加载更多</div>
  </div>
</template>

<script>
import { getIsScrolltolower } from "@/utils";
import { getTeamMemberList } from "@/api/group";
export default {
  name: "GroupMember",
  data() {
    return {
      groupId: this.$route.query.groupid,
      list: [],
      loaded: false,
      pageCount: null,
      p: 1
    };
  },
  methods: {
    /**
     * 获取数据列表
     */
    getList(p = 1) {
      this.p = p;
      this.$showLoading();
      getTeamMemberList({
        p: p,
        id: this.groupId,
        maxperpage: 15
      }).then(res => {
        if (this.p === 1) {
          this.list = res.list;
        } else {
          this.list = this.list.concat(res.list);
        }
        this.pageCount = res.page.total_pages;
        this.loaded = true;
        this.$hideLoading();
      });
    }
  },

  mounted() {
    window.onscroll = () => {
      let scrollFlag = getIsScrolltolower();
      if (scrollFlag && this.p < this.pageCount) {
        let page = this.p + 1;
        this.getList(page);
      }
    };
  },
  activated() {
    document.title = "成员列表";
    this.groupId = this.$route.query.groupid;
    this.getList();
  }
};
</script>
<style scoped>
.member-list {
  padding: 0 15px;
  background: #fff;
}
.member-list li {
  display: flex;
  justify-content: flex-start;
  padding: 15px 0;
  align-items: center;

  color: #333;
  font-size: 16px;
}
.member-list li .ks-create-bg {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  margin-right: 10px;
}
</style>
