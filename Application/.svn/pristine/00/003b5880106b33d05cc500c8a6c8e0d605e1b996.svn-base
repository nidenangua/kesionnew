<template>
  <div class="paper" :style="{minHeight:windowHeight+'px'}">
    <div class="paper-category-name">
      {{categoryname || '考试中心'}}
      <div class="paper-category-change" @click="visible=true">戳我切换科目</div>
    </div>
    
    <div class="paper-data">
      <ks-swiper :options="swiperOption">
        <ks-swiper-slide>
          <div class="paper-data__item">
            <div class="paper-data__count">
              <ks-count class="paper-data__bule" :number="Number(information.do_num)" />道
              <div class="paper-data__name">做题总数</div>
            </div>
          </div>
        </ks-swiper-slide>
        <ks-swiper-slide>
          <div class="paper-data__item">
            <div class="paper-data__count">
              <ks-count class="paper-data__green" :number="Number(information.accuracy)" />%
              <div class="paper-data__name">正确率</div>
            </div>
          </div>
        </ks-swiper-slide>
        <ks-swiper-slide>
          <div class="paper-data__item">
            <div class="paper-data__count">
              <ks-count class="paper-data__red" :number="Number(information.error_num)" />道
              <div class="paper-data__name">错题数</div>
            </div>
          </div>
        </ks-swiper-slide>
      </ks-swiper>
    </div>
    <div class="paper-bar">
      <div class="paper-bar__item" @click="error">
        <img src="@/m/assets/exam/exam_error.png">错题集
      </div>
      <div class="paper-bar__item" @click="collect">
        <img src="@/m/assets/exam/exam_collect.png">收藏夹
      </div>
      <div class="paper-bar__item" @click="recode">
        <img src="@/m/assets/exam/exam_edit.png">做题记录
      </div>
    </div>

    <div class="paper-menu">
      <div class="ks-line"></div>
      <div class="paper-menu__item" @click="Random()">
        <div class="paper-menu__num">1</div>
        <div class="paper-menu__txt">
          <h3>随机练习</h3>
          <p>颗粒度测试，以练为学，各个击破</p>
        </div>
        <div class="paper-menu__right">
          <img src="@/m/assets/exam/exam_right.png">
        </div>
      </div>
      <div class="ks-line"></div>
      <div class="paper-menu__item" @click="open()">
        <div class="paper-menu__num paper-menu__num2">2</div>
        <div class="paper-menu__txt">
          <h3>整卷练习</h3>
          <p>颗粒度测试，以练为学，各个击破</p>
        </div>
        <div class="paper-menu__right">
          <img src="@/m/assets/exam/exam_right.png">
        </div>
      </div>
      <div class="ks-line"></div>
    </div>

    <ve-line class="paper-chart" height="15.5rem" :data="chartData"></ve-line>
    <!-- 选择分类 -->

    <ks-popup width="80%" :visible.sync="visible">
      <paper-classi-fication @getId="setCatagrryId"></paper-classi-fication>
    </ks-popup>
    <store-footer/>
  </div>
</template>

<script>
import PaperClassiFication from "./PaperClassification";
import { categoryAll, subjectStatistics } from "@/api/exam";
export default {
  name: "PaperIndex",
  data() {
    this.exerciseChartSettings = {
      stack: { 完成情况: ["已完成", "总数"] }
    };
    return {
      menuData: [],
      windowHeight: window.innerHeight,
      visible: false,
      categoryid: 0,
      categoryname: "",
      swiperOption: {
        slidesPerView: 3,
        spaceBetween: 15
      },
      information: {},
      chartData: {}
    };
  },
  methods: {
    /**
     * 整卷练习
     */
    open() {
      this.$router.push({
        path: "/exam/PaperList",
        query: {
          categoryid: this.categoryid
        }
      });
    },
    /**
     * 收藏记录
     */
    collect() {
      this.$router.push({
        path: "/exam/favorite",
        query: {
          categoryid: this.categoryid
        }
      });
    },
    /**
     * 错题集
     */
    error() {
      this.$router.push({
        path: "/exam/WrongEntry",
        query: {
          categoryid: this.categoryid
        }
      });
    },
    /**
     * 做题记录
     */
    recode() {
      this.$router.push({
        path: "/exam/record",
        query: {
          categoryid: this.categoryid
        }
      });
    },
    /**
     * 随机练习
     */
    Random() {
      this.$router.push({
        path: "/exam/DoRadom",
        query: {
          categoryid: this.categoryid,
          type: 1
        }
      });
    },
    /**
     * 获取分类id
     */
    setCatagrryId(id, name) {
      /**更新本地存储 */
      this.$store.ready(state=>{
        let userid = state.userInfo.userid
        if(state.userInfo.userid){
          localStorage[`EXAM_CATEGORYID_${userid}`] = id
          localStorage[`EXAM_CATEGORYNAME_${userid}`] = name
        }
      })
      this.categoryid = localStorage.EXAM_CATEGORYID;
      this.categoryname = localStorage.EXAM_CATEGORYNAME;
      this.visible = false;
    },
    reset() {
      this.$store.ready(state=>{
        let userid = state.userInfo.userid
        if(localStorage[`EXAM_CATEGORYID_${userid}`] && localStorage[`EXAM_CATEGORYNAME_${userid}`]){
          this.categoryid = localStorage[`EXAM_CATEGORYID_${userid}`];
          this.categoryname = localStorage[`EXAM_CATEGORYNAME_${userid}`]
        }
      })
      this.information = {};
      subjectStatistics({
        categoryid: this.categoryid
      }).then(res => {
        this.information = res.detail;
        if (res.detail.day_record.length == 0) {
        } else {
          let _chartData = {
            columns: ["date", "练习时间(分)", "做题数"],
            rows: []
          };
          res.detail.day_record.map(item => {
            _chartData.rows.push({
              date: item.date,
              做题数: item.tk_num,
              "练习时间(分)": item.time
            });
          });

          this.chartData = _chartData;
        }
      });
    }
  },
  activated() {
    /**
     * 首页信息
     */
    this.menuData = [];
    this.reset();
    document.title = "考试中心";
  },
  watch: {
    categoryid() {
      this.reset();
    }
  },
  components: {
    PaperClassiFication
  }
};
</script>
<style scoped>
.paper {
  background: #fff;
}
.paper-category-name {
  font-size: 24px;
  font-weight: bold;
  color: #46536f;
  padding:25px 20px 10px 20px;
  line-height: 32px;
  min-height: 32px;
  position: relative;
}
.paper-category-change {
  line-height: 32px;
  background: #5185f7;
  border-radius: 32px 0 0 32px;
  text-align: center;
  color: #fff;
  font-size: 13px;
  width: 160px;
  position: absolute;
  right: 0;
  top: 25px;
  font-weight: normal;
}
.paper-menu,
.paper-data {
  padding: 25px 0;
}
.paper-data__item {
  text-align: center;
  color: #666;
  font-size: 14px;
}
.paper-data__item .ks-count {
  font-size: 45px;
  display: inline-block;
  padding-right: 5px;
}
.paper-data__bule {
  color: #5185f7;
}
.paper-data__green {
  color: #80c269;
}
.paper-data__red {
  color: #f55959;
}
.paper-data__name {
  font-size: 13px;
  color: #999;
}
.paper-menu__item {
  display: flex;
  padding: 20px 0;
  justify-content: space-between;
  position: relative;
}
.paper-menu__num {
  display: flex;
  flex: 20%;
  align-items: center;
  justify-content: center;
}
.paper-menu__txt {
  flex: 70%;
}
.paper-menu__txt h3 {
  font-size: 20px;
  color: #333;
  font-weight: normal;
  margin-bottom: 10px;
}
.paper-menu__txt p {
  font-size: 13px;
  color: #999;
}
.paper-menu__right {
  flex: 10%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.paper-menu__right img {
  width: 10px;
}
.paper-menu__num {
  font-size: 45px;
  color: #5185f7;
}
.paper-menu__num2 {
  color: #80c269;
}

.paper-bar {
  display: flex;
  align-items: center;
  justify-content: center;
}
.paper-bar__item {
  display: flex;
  flex: 1;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  color: #666;
}
.paper-bar__item img {
  padding-right: 8px;
  width: 20px;
}

.paper-bar__item i {
  padding-left: 20px;
  font-size: 13px;
  color: #666;
}

.paper-chart {
  margin: 15px 15px 0 15px;
}
</style>