<template>
  <div>
    <ks-tab :tab-info="tabInfo" @change="changeTab"/>
    <ks-page-scroll-container
      v-if="errorList.length"
      :page="p"
      :page-count="pageCount"
      @page-change="getlist"
    >
      <div class="paper__list">
        <div class="paper__item" v-for="(item,i) in errorList" :key="i">
          <div class="paper__item-icon">
            <img src="@/m/assets/exam/exam_position.png">
          </div>
          <div class="paper__item-txt">
            <div class="paper__item-tit">{{item.title}}</div>
            <div class="paper__item-info">错题数
              <i>1</i>
            </div>
          </div>
          <div class="paper__item-cancle" @click="remove(item,i)">
            <span>消</span>
          </div>
        </div>
      </div>
    </ks-page-scroll-container>
    <ks-empty msg="暂无数据~" v-else-if="!errorList.length && loaded"/>
  </div>
</template>

<script>
import { getExamRecord, moveError } from "@/api/exam";
import { getIsScrolltolower } from "@/utils";
export default {
  data() {
    return {
      tabInfo: {
        options: ["随机练习", "整卷练习"],
        current: 0,
        values: [2, 1]
      },
      p: 1,
      maxperpage: 10,
      pageCount: null,
      categoryid: this.$route.query.categoryid,
      type: 2,
      errorList: [],
      loaded: false
    };
  },
  methods: {
    changeTab(key) {
      this.type = key;
      this.errorList = [];
      this.getlist();
    },
    getlist(p = 1) {
      this.$showLoading();
      this.p = p;
      getExamRecord({
        categoryid: this.categoryid,
        type: this.type,
        p: p,
        maxperpage: this.maxperpage
      }).then(res => {
        this.errorList = this.errorList.concat(res.list);
        this.p = res.page.nowpage;
        this.maxperpage = res.page.maxperpage;
        this.pageCount = res.page.total_pages;
        this.loaded = true;
        this.$hideLoading();
      });
    },
    /**
     * 消除试题
     */
    remove(tkArr, index) {
      moveError({
        answerId: tkArr.id
      }).then(res => {
        if (res.moveError.result == "success") {
          this.errorList.splice(index, 1);
        }
      });
    }
  },
  mounted() {
    this.getlist();
    /**
     * 监听滚动事件
     */
    window.addEventListener("scroll", e => {
      let scrollFlag = getIsScrolltolower();
      if (scrollFlag && this.p < this.pageCount) {
        this.p++;
        this.getList(this.p);
      }
    });
  }
};
</script>
<style scoped>
.paper__list {
  padding: 0 10px;
  background: #fff;
}
.paper__item {
  display: flex;
  justify-content: space-between;
  padding: 20px 0;
}
.paper__item-icon {
  flex: 1;
}
.paper__item-txt {
  flex: 8;
}
.paper__item-cancle {
  flex: 2;
  display: flex;
  align-items: center;
  justify-content: center;
}
.paper__item-cancle span {
  display: inline-block;
  border: 1px solid #5185f7;
  width: 36px;
  height: 36px;
  line-height: 36px;
  text-align: center;
  color: #5185f7;
  border-radius: 50%;
  font-size: 15px;
}
.paper__item-icon img {
  width: 20px;
  float: right;
  padding-right: 10px;
  padding-top: 3px;
}
.paper__item-tit {
  font-size: 16px;
  margin-bottom: 10px;
}
.paper__item-info {
  font-size: 14px;
  color: #999;
}
.paper__item-info i {
  color: rgb(75, 185, 169);
  font-style: normal;
  font-size: 14px;
}
body {
  background: #fff;
}
</style>