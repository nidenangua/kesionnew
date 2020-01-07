<template>
  <div v-if="loaded && detailLoaded">
    <topic-item
      :role="topicDetail.loginUser.role"
      :is-join="topicDetail.loginUser.is_join"
      :group-id="groupId"
      :item="topicDetail"
    />
    <div class="ks-mt10">
      <div class="group-tit">
        全部评论
        <span v-if="list.length" :class="desc === 'desc' && 'active'" @click="listSort">按最热排序</span>
      </div>
      <div v-if="list.length">
        <topic-item
          type="reply"
          :role="topicDetail.loginUser.role"
          :group-id="groupId"
          :item="item"
          class="i < list.length-1 && 'line'"
          v-for="(item,i) in list"
          :key="i"
        />
        <div class="ks-nomore" v-if="pageCount !== null && p >= pageCount">没有更多动态了~</div>
        <div class="ks-nomore" v-else>上拉加载更多</div>
      </div>
      <ks-empty
        class="ks-bg-white"
        msg="暂时相关的评论~"
        type="notest"
        v-else-if="loaded && !list.length"
      />
    </div>
    <store-footer />
    <div class="reply-footer-blank"></div>
    <div class="reply-footer">
      <div class="reply-input">
        <input type="text" placeholder="发表你的评论吧..." v-model="content">
        <span @click="reply">发送</span>
      </div>
    </div>
  </div>
</template>

<script>
import TopicItem from "./components/TopicItem";
import { getIsScrolltolower } from "@/utils";
import { getTrends, getTopicDetail, getTeamAddChat } from "@/api/group";

export default {
  name: "GroupTopic",
  data() {
    return {
      topicId: this.$route.query.id, //动态id
      groupId: this.$route.query.team_id, //社群id
      desc: "",
      /**
       * 评论列表加载状态
       */
      loaded: false,
      detailLoaded: false,
      list: [],
      content: null,
      pageCount: null,
      p: 1,
      topicDetail: {}
    };
  },
  methods: {
    /**
     * 发布评论
     */
    reply() {
      getTeamAddChat({
        team_id: this.groupId,
        topic_id: this.topicId,
        content: this.content
      }).then(res => {
        this.$toast(res.result, res.msg);
        if (res.result == "success") {
          this.content = "";
          this.getList();
        }
      });
    },
    /**
     * 列表按热门排序
     */
    listSort() {
      this.desc = this.desc === "desc" ? "" : "desc";
      this.getList();
    },
    /**
     * 获取评论列表
     */
    getList(p = 1) {
      this.p = p;
      let params = {
        p: p,
        maxparpage: 10,
        data: {
          topic_id: this.topicId
        }
      };
      if (this.desc === "desc") {
        params.data.sql_order = {
          like_num: "desc"
        };
      }
      this.$showLoading();
      getTrends(params).then(res => {
        if (res.list && res.page) {
          if (p === 1) {
            this.list = res.list;
          } else {
            this.list = this.list.concat(res.list);
          }
          this.pageCount = res.page.total_pages;
        }
        this.loaded = true;
        this.$hideLoading();
      });
    }
  },
  mounted() {
    window.addEventListener("scroll", e => {
      let scrollFlag = getIsScrolltolower();
      if (scrollFlag && this.p < this.pageCount) {
        let page = this.p + 1;
        this.getList(page);
      }
    });
  },
  activated() {
    document.title = "话题详情";
    this.topicId = this.$route.query.id;
    this.groupId = this.$route.query.team_id;
    this.getList();
    getTopicDetail({
      topic_id: this.topicId
    }).then(res => {
      let filePath = [];
      if (res.file_path) {
        res.file_path.map(src => {
          filePath.push({
            src: src
          });
        });
        res.file_path = filePath;
      }
      this.topicDetail = res;
      this.detailLoaded = true;
    });
  },
  components: {
    TopicItem
  }
};
</script>
<style scoped>
.group-topic-reply {
  background: #fff;
}
.group-tit {
  font-size: 16px;
  font-weight: bold;
  height: 49px;
  line-height: 49px;
  overflow: hidden;
  background: #fff;
  padding: 5px 10px 0 10px;
}
.group-tit span {
  float: right;
  font-size: 12px;
  color: #666;
}
.group-tit .active {
  color: #e64a3b;
}

.group-staus span {
  padding-right: 10px;
}
.group-detail .group-info {
  font-size: 14px;
  color: #353535;
  line-height: 21px;
}

.reply-info {
  display: flex;
  justify-content: flex-start;
  position: relative;
  padding-bottom: 10px;
}
.reply-info .reply-img img,
.reply-info .reply-img {
  width: 34px;
  height: 34px;
  border-radius: 50%;
}

.reply-info .reply-name {
  font-size: 15px;
  color: #353535;
}
.reply-info .reply-name span {
  display: inline-block;
  width: 33px;
  height: 15px;
  line-height: 15px;
  text-align: center;
  font-size: 12px;
  margin-left: 5px;
}
.reply-info .reply-name .staus-bule {
  border: 1px solid #2f83ff;
  color: #2f83ff;
  font-size: 11px;
  border-radius: 2px;
}
.reply-info .reply-name .staus-orange {
  border: 1px solid #f35003;
  color: #f35003;
}
.reply-info .staus-green {
  border: 1px solid #42c642;
  color: #42c642;
}
.reply-info .reply-time {
  color: #888;
  margin-top: 4px;
}
.reply-info .reply-txt {
  padding-left: 10px;
  padding-top: 7px;
}

.reply-slide .reply-tit {
  font-size: 16px;
  line-height: 24px;
  font-weight: 500;
}
.reply-slide .reply-intro {
  line-height: 22px;
  font-size: 14px;
  color: #555;
  padding: 6px 0;
}
.reply-slide .comment {
  margin-top: 10px;
  color: #999;
}

.comment span {
  position: relative;
  float: right;
  margin-left: 15px;
  color: #666;
  font-size: 14px;
}
.comment .reply-time {
  float: left;
  color: #888;
}

.reply-footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  padding: 5px 60px 5px 10px;
  box-sizing: border-box;
  background: #fff;
  z-index: 99;
  max-width: 480px;
  box-shadow: 0 1px 12px rgba(0, 0, 0, 0.1);
}
.reply-footer-blank {
  height: 49px;
  overflow: hidden;
}
.reply-footer input {
  -webkit-appearance: none;
  background-color: #f5f7fa;
  background-image: none;
  border-radius: 4px;
  border: 1px solid #f5f7fa;
  box-sizing: border-box;
  display: inline-block;
  font-size: inherit;
  height: 39px;
  line-height: 39px;
  outline: none;
  padding: 0 15px;
  font-size: 14px;
  width: 100%;
}
.reply-footer span {
  position: absolute;
  right: 0;
  width: 60px;
  height: 40px;
  line-height: 40px;
  text-align: center;
  font-size: 15px;
  color: #e64a3b;
  top: 5px;
  z-index: 999;
}
</style>

