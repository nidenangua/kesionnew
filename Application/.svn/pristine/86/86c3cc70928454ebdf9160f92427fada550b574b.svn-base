<template>
  <div class="my-reply ks-mt10">
    <ks-page-scroll-container
      :page="p"
      :page-count="pageCount"
      v-if="list.length > 0 "
      @page-change="getToplist"
    >
      <div class="my-reply__item line" v-for="(item,i) in list" :key="i">
        <div class="my-reply__content">{{item.content}}</div>
        <div class="topic-info" @click="open(item.topic_id,item.team_id)">
          <ks-create-bg v-if="item.file_path && item.file_path[0]" :src="item.file_path[0]"/>
          <div class="topic-info_flex">
            <div class="topic-info_title ks-nowrap">{{item.title}}</div>
            <div class="topic-info_desc ks-nowrap">{{item.topic_content}}</div>
          </div>
        </div>
        <div class="my-reply__opeart">
          <span class="ks-fr" @click="deleteReply(4,item.id)">
            <i class="ks-icon ks-icon-trash--outline"></i>
          </span>
          <i class="ks-icon ks-icon-clock-outline"></i>
          {{item.create_time}}
        </div>
      </div>
    </ks-page-scroll-container>
    <ks-empty class="ks-bg-white" msg="暂时相关的评论~" type="notest" v-else-if="loaded"/>
  </div>
</template>

<script>
import { getMyTeamChat, teamDel } from "@/api/group";
export default {
  name: "UserGroupTopic",
  data() {
    return {
      list: [],
      pageCount: null,
      p: 1,
      loaded: false,
      headimg: this.$store.state.userInfo.headimg,
      name: this.$store.state.userInfo.name
    };
  },
  methods: {
    /**
     * 查看话题详情
     */
    open(topicId, teamId) {
      this.$router.push({
        name: "GroupTopic",
        query: {
          id: topicId,
          team_id: teamId
        }
      });
    },
    getToplist(p = 1) {
      this.$showLoading();
      if (p == 1) {
        this.loaded = false;
        this.list = [];
      }
      this.p = p;
      getMyTeamChat({
        p: this.p,
        maxperpage: 10
      }).then(res => {
        this.loaded = true;
        this.list = this.list.concat(res.list);
        this.pageCount = res.page.total_pages;
        this.$hideLoading();
      });
    },

    /**
     * 删除动态
     */
    deleteReply(type, id) {
      this.$confirm("您确定要删除该评论吗？").then(() => {
        teamDel({
          id: id,
          type: type
        }).then(res => {
          this.dynamic = [];
          this.getToplist();
        });
      });
    }
  },
  mounted() {
    this.getToplist();
  }
};
</script>

<style scoped>
.my-reply__item {
  background: #fff;
  padding: 15px;
}

.my-reply__content {
  font-size: 16px;
  line-height: 24px;
  margin-bottom: 10px;
}

.my-reply__opeart {
  height: 40px;
  line-height: 40px;
  color: #999;
}
.my-reply__opeart i {
  font-size: 14px;
  position: relative;
  top: 1px;
  margin-right: 5px;
}
.my-reply__opeart .ks-icon-trash--outline {
  font-size: 16px;
  color: #666;
}

.topic-info {
  background: #f6f6f6;
  height: 60px;
  position: relative;
  overflow: hidden;
  display: flex;
}
.topic-info_flex {
  padding: 0 10px;
  flex: 1;
}
.topic-info .ks-icon {
  position: absolute;
  right: 0;
  top: 50%;
  height: 24px;
  line-height: 24px;
  width: 30px;
  text-align: center;
  color: #aaa;
  margin-top: -12px;
}

.topic-info .ks-create-bg {
  width: 50px;
  height: 50px;
  margin: 5px 0 0 5px;
  border-radius: 0px;
}
.topic-info_title {
  margin-top: 8px;
  font-weight: bold;
  font-size: 14px;
}
.topic-info_desc {
  color: #999;
  margin-top: 5px;
}
</style>




