<template>
  <div>
    <div class="paper-favorite">
      <!-- <div class="paper-favorite__tabs">
        <ul>
          <li :class="type == 2 && 'actived'" @click="type = 2">题目</li>
          <li :class="type == 1 && 'actived'" @click="type = 1">试卷</li>
        </ul>
      </div> -->
      <paper-medal name="累计收藏" :value="count"/>
    </div>
    <div class="paper-favorite-list">
      <div class="paper-favorite-list__item" @click="goFavTest">
        <div class="paper-favorite-list__title">{{categoryname.join('、') || '收藏夹'}}</div>
        <div class="paper-favorite-list__num">{{count}}</div>
      </div>
    </div>
    <div
      class="clearall-button"
      :class="count <= 0 && 'clearall-button--disabled'"
      @click="clearAll"
    >清空我的收藏</div>
  </div>
</template>
<script>
import PaperMedal from "./PaperComponent/PaperMedal";
import { getMyCollect, delAllTk } from "@/api/exam";
export default {
  name: "PaperFavorite",
  components: {
    PaperMedal
  },
  data() {
    return {
      /**1试卷 2题目 */
      type: 2,
      /**当前分类id */
      categoryid: 0,
      /**分类名称 */
      categoryname: [],
      /**收藏数量 */
      count: 0
    };
  },
  activated() {
    this.categoryid = this.$route.query.categoryid;
    this.getList();
  },
  methods: {
    /**
     * 从收藏本抽取题目做题
     */
    goFavTest() {
      if (this.count > 0) {
        this.$router.push({
          path: "/exam/DoFavtest",
          query: {
            categoryid: this.categoryid
          }
        });
      } else {
        this.$toast("无收藏的题目");
      }
    },
    /**
     * 获取数据列表
     * @param {Number} 页码
     */
    getList(p = 1) {
      getMyCollect({
        type: this.type,
        categoryid: this.categoryid,
        p: p
      }).then(res => {
        console.log(res);
        this.categoryname = res.categoryname;
        this.count = res.count;
        // this.list = this.list.concat(res.list);
        // this.p = res.page.now_page;
        // this.pageCount = res.total_pages;
        // this.loaded = true;
        // this.$hideLoading();
      });
    },
    /**
     * 清除我的收藏
     */
    clearAll() {
      if (this.count > 0) {
        this.$confirm("确认清空收藏记录吗").then(() => {
          delAllTk({
            type: 2,
            categoryid: this.categoryid
          }).then(res => {
            if (res.result === "success") {
              this.$toast("清除成功", "success");
              this.getList();
            }
          });
        });
      }
    }
  }
};
</script>
<style scoped>
.paper-favorite {
  background: #fff;
  padding: 15px 0;
  position: relative;
}
.paper-favorite__tabs {
  text-align: center;
}
.paper-favorite__tabs ul {
  display: inline-block;
  height: 34px;
  border: 1px solid #5185f7;
  border-radius: 4px;
  line-height: 34px;
  overflow: hidden;
}
.paper-favorite__tabs li {
  padding: 0 20px;
  float: left;
  font-size: 14px;
  color: #5185f7;
}
.paper-favorite__tabs .actived {
  background: #5185f7;
  color: #fff;
}
.paper-favorite-list {
  background: #fff;
  margin-top: 10px;
}
.paper-favorite-list__item {
  padding: 12px 15px;
  font-size: 14px;
  position: relative;
  line-height: 22px;
  display: flex;
}
.paper-favorite-list__title {
  flex: 1;
}
.paper-favorite-list__num {
  color: #5185f7;
  background: url(../../assets/exam/exam_right.png) no-repeat 100% 50%;
  background-size: auto 10px;
  padding-right: 12px;
}
.clearall-button {
  height: 44px;
  line-height: 44px;
  background: #5185f7;
  color: #fff;
  text-align: center;
  font-size: 14px;
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  margin: 0 auto;
  width: 100%;
  max-width: 480px;
}
.clearall-button--disabled {
  opacity: 0.7;
  cursor: no-drop;
}
</style>
