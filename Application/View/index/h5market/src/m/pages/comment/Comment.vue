<template>
  <div>
    <div v-if="showType === 'page'">
      <ks-page-scroll-container
        :page="page"
        :page-count="pageCount"
        v-if="list.length > 0"
        @page-change="getComment"
      >
        <div class="comment-box all-comment-box">
          <ul>
            <li class="line" v-for="(item,i) in list" :key="i">
              <ks-create-bg class="comment-box__avatar" :src="item.headpic" type="user"/>
              <div class="inner-icon">
                <div class="name">
                  <span class="time">
                    <span
                      class="zan"
                      @click="zan(item)"
                      :class="item.isdz==1 && 'zaned'"
                    >{{item.zannumber}}</span>
                  </span>

                  {{item.membername}}
                </div>
                <div class="interact" v-html="item.interact"></div>
              </div>
            </li>
          </ul>
        </div>
      </ks-page-scroll-container>
      <ks-empty type="nocomment" msg="暂无学员发表评论~" v-else-if="loaded"/>
      <div class="commnet-footer" @click="commentFlag = true" v-if="$route.query.comment_switch">
        <div class="comment-button">
          <i class="icon-pen"></i>写评论
        </div>
      </div>
    </div>
    <div v-else>
      <div class="comment-title">
        学员评论
        <span class="write-comment" @click="commentFlag = true" v-if="commentSwitch">写评论</span>
      </div>
      <div class="comment-box" v-if="topFive.length > 0">
        <ul>
          <li v-for="(item,i) in topFive" :key="i">
            <ks-create-bg class="comment-box__avatar" :src="item.headpic" type="user"/>
            <div class="inner-icon">
              <div class="name">
                <span class="time">
                  <span
                    class="zan"
                    @click="zan(item)"
                    :class="item.isdz==1 && 'zaned'"
                  >{{item.zannumber}}</span>
                </span>

                {{item.membername}}
              </div>
              <div class="interact" v-html="item.interact"></div>
            </div>
          </li>
        </ul>
        <div class="show-more line line-top" @click="showMore">查看更多 &gt;</div>
      </div>
      <ks-empty type="nocomment" msg="暂无学员发表评论~" v-else-if="loaded"/>
    </div>
    <ks-dialog :visible.sync="commentFlag" title="写评论">
      <textarea
        class="comment-textarea"
        maxlength="200"
        placeholder="请输入您的评价，200字以内"
        id="intextarea"
        v-model="commentContent"
      ></textarea>
      <div class="comment-release" @click="release">提交</div>
    </ks-dialog>
  </div>
</template>
<script>
import { getAllComment, writeComment, praiseInteract } from "@/api/comment";
import { getIsScrolltolower } from "@/utils";
export default {
  name: "Comment",
  props: ["appid", "infoId", "showType", "commentSwitch"],
  data() {
    return {
      topFive: [],
      list: [],
      loaded: false,
      commentContent: "",
      commentFlag: false,
      zanFlag: true,
      page: 1,
      pageCount: null
    };
  },
  methods: {
    /**
     * 获取课程评论
     */
    getComment(page = 1) {
      this.$showLoading();
      this.page = page;
      getAllComment({
        data: {
          infoid: this.infoId,
          appid: this.appid
        },
        p: page,
        maxperpage: 15
      }).then(res => {
        this.pageCount = res.page.total_pages;
        let first5 = [];
        res.list.map((item, i) => {
          if (i < 5) {
            first5.push(item);
          }
        });
        if (this.page == 1) {
          this.list = res.list;
        } else {
          this.list = this.list.concat(res.list);
        }
        this.topFive = first5;
        this.loaded = true;
        this.$hideLoading();
      });
    },
    /**
     * 发布评论
     */
    release() {
      if (!this.commentContent) {
        this.$toast("请先输入内容");
        return false;
      }
      writeComment({
        interact: this.commentContent,
        courseid: this.infoId,
        appid: this.appid
      }).then(res => {
        if (res) {
          this.$toast("评论成功", "success").then(() => {
            this.commentContent = "";
            this.commentFlag = false;
            this.getComment();
          });
        } else {
          this.$toast("评论失败");
        }
      });
    },
    /**
     * 点赞
     */
    zan(item) {
      if (this.zanFlag) {
        this.zanFlag = false;
        praiseInteract({
          interactid: item.interactid
        }).then(res => {
          if (res.errcode == 404) {
            this.$toast("请先登录").then(() => {
              this.$router.push({
                name: "UserLogin"
              });
            });
            return false;
          }
          var zanNumber = Number(item.zannumber);
          if (item.isdz == 0) {
            item.isdz = 1;
            item.zannumber = zanNumber + 1;
          } else {
            item.isdz = 0;
            item.zannumber = zanNumber - 1;
          }
          this.zanFlag = true;
        });
      }
    },
    /**
     * 查看更多
     */
    showMore() {
      this.$router.push({
        path: "/comment",
        query: {
          appid: this.appid,
          id: this.infoId,
          /** 判断是否出现评论按钮 */
          comment_switch:this.commentSwitch
        }
      });
    }
  },
  mounted() {
    this.getComment();
  },
  activated() {
    this.getComment();
    document.title = "全部评论";
  },
  deactivated() {
    this.topFive = []
  }
};
</script>
<style scoped>
.comment-title {
  height: 44px;
  line-height: 44px;
  font-size: 14px;
  padding: 5px 20px 0 20px;
  font-weight: bold;
  overflow: hidden;
  position: relative;
}

.comment-title .write-comment {
  float: right;
  font-weight: normal;
  color: #e64a3b;
}

.comment-box {
  background: #fff;
}
.comment-box li {
  padding: 15px 15px 15px 3.25rem;
  position: relative;
  min-height: 40px;
}
.comment-box li:last-child::after {
  display: none;
}
.comment-box .name .time {
  float: right;
  font-weight: normal;
  color: #999;
  font-size: 12px;
}
.comment-box .comment-box__avatar {
  height: 2rem;
  width: 2rem;
  position: absolute;
  top: 15px;
  left: 15px;
  border-radius: 50%;
}
.comment-box li .zan {
  background-image: url(../../assets/comment/zan.png);
  background-repeat: no-repeat;
  background-position: 0 50%;
  background-size: 14px;
  padding-left: 0.9rem;
}
.comment-box li .zaned {
  background-image: url(../../assets/comment/zaning.png);
  color: #e64a3b;
}
.comment-box .head {
  margin: 15px 0 1rem;
  font-weight: 700;
  color: #424242;
  font-size: 0.7rem;
}
.comment-box .name {
  margin-bottom: 0.3rem;
  font-size: 14px;
  line-height: 1rem;
  height: 1rem;
  width: 100%;
  font-weight: bold;
  overflow: hidden;
  text-overflow: ellipsis;
}
.comment-box .show-more {
  text-align: center;
  height: 44px;
  line-height: 44px;
  font-size: 14px;
  color: #999;
  margin-top: 0.5rem;
}
.comment-box .interact {
  font-size: 14px;
  color: #555;
}

.comment-textarea {
  font-size: 14px;
  line-height: 20px;
  box-sizing: border-box;
  width: 100%;
  min-height: 120px;
  padding: 10px;
  background: #f3f5f9;
  border: none;
  border-radius: 4px;
  color: #999;
}
.comment-textarea::-webkit-input-placeholder {
  color: #999;
}
.comment-release {
  font-size: 16px;
  text-align: center;
  line-height: 44px;
  color: #e64a3b;
  font-weight: bold;
}
.commnet-footer {
  height: 44px;
  line-height: 44px;
  overflow: hidden;
}
.commnet-footer .comment-button {
  height: 44px;
  line-height: 44px;
  position: fixed;
  left: auto;
  bottom: 0;
  width: 100%;
  max-width: 480px;
  text-align: center;
  background: #e64a3b;
  z-index: 9;
  font-size: 16px;
  color: #fff;
  font-weight: bold;
}
.commnet-footer .comment-button .icon-pen {
  display: inline-block;
  width: 20px;
  height: 20px;
  background: url(../../assets/comment/edit-2-outline.png) no-repeat;
  background-size: 100%;
  position: relative;
  top: 4px;
  margin-right: 10px;
}
textarea{
  position: static !important;
}
</style>

