<template>
  <div class="course_container" v-if="loaded">
    <item-header :info="columnInfo" info-type="column"/>
    <!-- tab -->
    <div class="tab line">
      <div class="tab-item on-log" :class="tab == 0 && 'active'" @click="tab = 0">专栏介绍</div>
      <div class="tab-item on-log" :class="tab == 1 && 'active'" @click="tab = 1">连载内容</div>
    </div>
    <!-- tab -->
    <!-- Anchor -->
    <div class="intro-anchor" v-if="tab == 0">
      <div class="ks-content">
        <div v-html="columnInfo.detailintro"></div>
      </div>

      <!--打赏-->
      <reward type="columnReward" :info-id="columnid" v-if="columnInfo.chargetype == 2"/>
    </div>
    <!-- Anchor -->
    <div class="column-anchor" v-else-if="tab == 1">
      <div class="column-course" v-if="chapter.length">
        <ul>
          <li v-for="(item,index) in chapter" :key="index" @click="open(item)">
            <ks-create-bg class="item-images" :src="item.defaultpic">
              <span class="is-relay" v-if="item.coursehour == 1">连载</span>
            </ks-create-bg>
            <div class="course-name">{{item.title}}</div>
            <div class="course-num">{{item.shortdesc}}</div>
            <div class="course-num">
              <span class="learning-num">{{item.studentnum}}次学习</span>
            </div>
          </li>
        </ul>
      </div>
      <ks-empty msg="暂无连载内容～" type="nolesson" v-else/>
    </div>

    <store-info class="ks-mt10" v-if="$route.query.miniprogram != 1"/>
    <store-footer/>

    <div class="button-container" v-if="!isCanLearn">
      <div class="buy-btn" @click="buy">购买专栏</div>
    </div>
  </div>
</template>

<script>
import Reward from "./components/Reward";
import ItemHeader from "./components/ItemHeader";
import { getColumnDetail } from "@/api/course";
export default {
  name: "ClassView",
  data() {
    return {
      tab: 0,
      loaded: false,
      columnid: this.$route.params.id,
      isCanLearn: false,
      chapter: [],
      columnInfo: {},
      isFree: false
    };
  },
  methods: {
    /**
     * 购买
     */
    buy() {
      this.$showPay({
        payid: this.columnid,
        msg: "购买专栏",
        price: this.columnInfo.price,
        type: "column"
      });
    },
    /**
     * 进入学习
     */
    showWechatCode() {
      this.codeFlag = true;
    },
    /**
     * 打开链接
     */
    open(item) {
      let node = item.courseType == 5 ? "class" : "course";
      this.$router.push(`/${node}/${item.id}`);
    }
  },
  activated() {
    this.$showLoading();
    document.title = "课堂详情";
    this.loaded = false;
    this.columnInfo = {};
    this.isCanLearn = false;
    this.chapter = [];
    this.columnInfo = {};
    this.isFree = false;
    /**
     * 更新columnid
     */
    this.columnid = this.$route.params.id;

    /**
     * 获取课堂详情
     */
    getColumnDetail({
      id: this.columnid
    }).then(res => {
      let columnInfo = res.info;
      /**
       * 开启防复制
       */
      if (columnInfo.iscopy == 1) {
        this.$antiCopy(true);
      }
      columnInfo.soldnum = parseInt(columnInfo.soldnum);
      this.chapter = res.chapter.chapter;
      this.columnInfo = columnInfo;
      if (columnInfo.price == "0.00" || columnInfo.chargetype != 1) {
        this.isFree = true;
      }
      if (
        columnInfo.price == "0.00" ||
        columnInfo.isbuy == 1 ||
        columnInfo.chargetype != 1
      ) {
        this.isCanLearn = true;
      }

      /**
       * 配置微信分享
       */
      this.$wxShare({
        title: columnInfo.title,
        desc: columnInfo.shortdesc,
        imgUrl: columnInfo.defaultpic
      });
      this.loaded = true;
      this.$nextTick(() => {
        this.$hideLoading();
      });
    });
  },
  deactivated() {
    /**
     * 取消防复制
     */
    this.$antiCopy(false);
  },
  components: {
    ItemHeader,
    Reward
  }
};
</script>
<style scoped>
.box_info {
  background-color: #fff;
  padding: 0 15px;
}

/*选项卡*/
.tab {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -moz-box-align: center;
  align-items: center;
  -webkit-justify-content: space-around;
  justify-content: space-around;
  height: 49px;
  background-color: #fff;
}
.tab .tab-item {
  -webkit-box-flex: 1;
  -webkit-flex: 1;
  -moz-box-flex: 1;
  flex: 1;
  color: #424242;
  text-align: center;
  height: 100%;
  position: relative;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -moz-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
  -moz-box-pack: center;
  justify-content: center;
  font-size: 18px;
}
.tab .tab-item.active {
  color: #e64a3b;
  font-weight: bolder;
}
.tab .tab-item.active {
  font-size: 18px;
}
.tab .tab-item.active:after {
  content: "";
  display: block;
  height: 3px;
  border-radius: 3px;
  background-color: #e64a3b;
  width: 40px;
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
}

.intro-anchor,
.column-anchor {
  background: #fff;
}
.intro-anchor {
  padding: 20px;
}
.button-container {
  height: 49px;
  overflow: hidden;
}
.button-container .buy-btn {
  background-color: #e64a3b;
  color: #fff;
  text-align: center;
  width: 100%;
  height: 49px;
  line-height: 49px;
  font-size: 14px;
  position: fixed;
  left: auto;
  max-width: 480px;
  bottom: 0;
  z-index: 9;
}

/*默认样式*/
.column-course {
  background: #fff;
  padding: 10px 0;
}
.column-course li {
  padding: 10px 15px 10px 150px;
  position: relative;
  min-height: 74px;
}

.column-course .item-images {
  height: 74px;
  width: 120px;
  position: absolute;
  left: 15px;
  top: 10px;
}

.column-course .is-relay {
  position: absolute;
  bottom: 0;
  right: 0;
  color: #fff;
  letter-spacing: 0;
  background: rgba(0, 0, 0, 0.5);
  border-radius: 4px 0 0 0;
  padding: 0 5px;
  font-size: 10px;
}

.column-course .course-name {
  line-height: 18px;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  font-weight: bold;
  overflow: hidden;
  font-size: 14px;
  color: #424242;
}
.column-course .course-num {
  white-space: nowrap;
  text-overflow: ellipsis;
}
.column-course .course-num {
  color: #b8b0b0;
  font-size: 12px;
  line-height: 20px;
  height: 20px;
  overflow: hidden;
  margin-top: 3px;
}
</style>
