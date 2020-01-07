<template>
  <div class="paper" :style="{minHeight:windowHeight+'px'}">
    <div class="paper-header ks-line">
      <div class="paper-header__second">{{time}} &nbsp; &nbsp; {{pageTuning}}/{{recode.length}}</div>
      <div class="paper-header__card" @click="sheetclick">
        <img src="@/m/assets/exam/exam_card.png">
      </div>
      <div class="paper-header-sumbit" @click="save">交卷</div>
    </div>
    <div class="paper-contianer" v-if="paperTkList.length">
      <transition name="fade">
        <div class="paper-slide-tips" v-if="showPaperSlideTips">
          <div class="paper-slide-tips__inner">
            <img src="@/m/assets/exam/icon-slide.png">
            滑动切换上下题
            <ks-button @click="iKnow">我知道啦</ks-button>
          </div>
        </div>
      </transition>
      <ks-swiper :options="swiperOption" ref="choice">
        <ks-swiper-slide
          v-for="(item,i) in paperTkList"
          :key="i"
          :style="{minHeight:windowHeight-97+'px'}"
        >
          <div v-if="item.type == 'dt'">
            <div class="paper-contianer__bigtitle">{{item.title}}</div>
            <div
              class="paper-contianer__desc"
              v-if="$route.name === 'DoExercise'"
            >本大题下有{{item.tklist.length}}小题，共{{item.dtscore}}分</div>
            <div class="paper-contianer__intro" v-html="item.intro"></div>
          </div>
          <div v-else-if="item.type == 'xt'">
            <question-title :type-name="item.type_name" :title="item.title"/>
            <div class="paper-option-box" v-if="item.tktype == 1">
              <!--简答题-->
              <short-answer :item="item" @callback="handleShortAnswer"/>
            </div>
            <div
              class="paper-option-box"
              v-else-if="item.tktype == 2 || item.tktype == 3 || item.tktype == 4"
            >
              <!--单选、多选、判断-->
              <multiple-choice :item="item" @change="handleChoiced"/>
            </div>

            <div class="paper-option-box" v-if="item.tktype == 5">
              <!--填空题-->
              <fill-blanks :item="item" @callback="handleFillBlankAnswer"/>
            </div>

            <div v-if="item.tktype == 6">
              <!--组合题-->
              <div
                class="paper-xt"
                :class="xtindex < item.tkinfo.childtk.length-1 && 'line'"
                v-for="(make,xtindex) in item.tkinfo.childtk"
                :key="xtindex"
              >
                <div class="paper-xt__title">{{xtindex+1}})、 {{make.title}}</div>
                <div v-if="make.tktype == 1">
                  <short-answer :item="make" @callback="handleShortAnswer"/>
                </div>
                <div v-else-if="make.tktype == 2 || make.tktype == 3 || make.tktype == 4">
                  <multiple-choice
                    :is-combination-question="true"
                    :item="make"
                    @change="handleChoiced"
                  />
                </div>

                <div v-else-if="make.tktype == 5">
                  <fill-blanks :content="make" @callback="handleFillBlankAnswer"/>
                </div>
                <!--题目解析-->

                <div
                  class="tk-analysis"
                  v-if="$route.name === 'DoError' || $route.name === 'DoFavtest'"
                >
                  <div align="right">
                    <div
                      class="tk-analysis__button"
                      v-if="!make.analysis_flag"
                      @click="viewAnalysis(make)"
                    >查看解析</div>
                  </div>
                  <analysis-info :item="make" v-if="make.analysis_flag"/>
                </div>
                <!--题目解析结束-->
              </div>
            </div>
            <div
              class="tk-analysis"
              v-else-if="$route.name === 'DoError' || $route.name === 'DoFavtest'"
            >
              <!--题目解析-->
              <div align="right">
                <div
                  class="tk-analysis__button"
                  v-if="!item.analysis_flag"
                  @click="viewAnalysis(item)"
                >查看解析</div>
              </div>
              <analysis-info :item="item" v-if="item.analysis_flag"/>

              <!--题目解析结束-->
            </div>
            <div class="paper-opear">
              <div class="paper-opear__sign" @click="sign(i)" :class="{signed:item.signed}">
                <img src="@/m/assets/exam/exam_sign.png" v-if="item.signed==false">
                <img src="@/m/assets/exam/exam_active_sign.png" v-else-if="item.signed==true">标记此题
              </div>
              <div
                class="paper-opear__collect"
                @click="collect(item)"
                :class="{collected:item.is_collection}"
              >
                <img src="@/m/assets/exam/exam_collected.png" v-if="item.is_collection==false">
                <img src="@/m/assets/exam/exam_active_collected.png" v-if="item.is_collection==true">
                {{item.is_collection ? '已收藏' : '收藏此题'}}
              </div>
            </div>
          </div>
        </ks-swiper-slide>
      </ks-swiper>
      <answer-sheet :visible.sync="cardVisabled" ref="sheet" @callback="handleCardClick"/>
    </div>
  </div>
</template>
<script>
import { isArrayOrObject } from "@/utils";
import {
  getExamDetail,
  setCollect,
  setPaperAnswer,
  getTestTk,
  endTest,
  getTest
} from "@/api/exam";
/**答题卡组件 */
import AnswerSheet from "./AnswerSheet";
/**题目标题组件 */
import QuestionTitle from "./PaperComponent/QuestionTitle";
/**解析内容组件 */
import AnalysisInfo from "./PaperComponent/AnalysisInfo";
/**多选、单选、判断组件 */
import MultipleChoice from "./PaperComponent/MultipleChoice";
/**填空题组件 */
import FillBlanks from "./PaperComponent/FillBlanks";
/**简答题组件 */
import ShortAnswer from "./PaperComponent/ShortAnswer";
export default {
  name: "PaperDoexercise",
  components: {
    AnswerSheet,
    MultipleChoice,
    FillBlanks,
    ShortAnswer,
    QuestionTitle,
    AnalysisInfo
  },
  filters: {
    /**
     * 参考答案内容过滤
     */
    answer(val, tktype) {
      val = val.toString();
      if (val === "") {
        return "无";
      } else {
        if (tktype == 4) {
          return val === "1" ? "正确" : "错误";
        } else {
          return val;
        }
      }
    }
  },
  data() {
    return {
      isSwiperFirsetEnd: false,
      windowHeight: window.innerHeight,
      /**轮播参数 */
      swiperOption: {
        slidesPerView: 1,
        spaceBetween: 15,
        autoHeight: true,
        on: {
          transitionEnd: () => {
            this.slideFlag = true;
            /**是否已滑动最后一条 */
            let isLast = this.pageTuning == this.recode.length;
            let _tkids = [];
            let swiperRealIndex = this.getSwiper().realIndex;
            this.paperTkList.map((item, index) => {
              if (item.type === "xt") {
                _tkids.push(item.tkid);
                if (index === swiperRealIndex) {
                  this.pageTuning = item.num;
                }
              }
            });

            if (
              isLast &&
              this.$route.name === "DoRadom" &&
              !this.isSwiperFirsetEnd
            ) {
              this.isSwiperFirsetEnd = true;

              this.$showLoading("加载更多题目中");
              getTestTk({
                categoryid: this.categoryid,
                tkids: _tkids
              }).then(res => {
                this.$hideLoading();
                if (res.result === "success") {
                  let tmlist = res.list.tmlist[0];
                  if (tmlist) {
                    let tkindex = this.paperTkList.length;
                    let xtArr = [];
                    tmlist.tklist.map(item => {
                      let xt = this.tkItemInit(item, 0, tkindex + xtArr.length);
                      xtArr.push(xt);
                    });
                    this.paperTkList = this.paperTkList.concat(xtArr);
                  }
                  this.isSwiperFirsetEnd = false;
                } else {
                  this.$toast(res.msg);
                }
              });
            }
          }
        }
      },
      /**是否显示告知用户滑动切换上下题的提示 */
      showPaperSlideTips: false,
      /**试卷题目列表 */
      paperTkList: [],
      /**试卷id */
      paperId: 0,
      /**显示答题卡 */
      cardVisabled: false,
      /**记录题目选中数组*/
      recode: [],
      /**试卷翻页记录长度 */
      pageTuning: 0,

      /**考试时间 */
      time: "00:00:00",
      /**当前秒数，用于计时 */
      second: 0,
      /**
       * 阅卷类型
       * 1自动阅卷
       * 2手动阅卷
       */
      scoreout: null,
      /**当前分类id */
      categoryid: 0,
      /**小题数量（递增） */
      xtnum: 0,
      /**自动滑到一下题的状态，当处于滑动状态开关将关闭，滑动结束开启 */
      slideFlag:true,
    };
  },
  mounted() {
    this.start();
  },
  activated() {
    this.dataInit();
    document.title = "";
    let API = getExamDetail;
    let params = {};
    switch (this.$route.name) {
      case "DoExercise":
        API = getExamDetail;
        params = {
          paperid: this.paperId,
          type: 2 //接口用于学生端，type需传2
        };
        break;
      case "DoRadom":
        API = getTestTk;
        params = {
          categoryid: this.categoryid
        };
        break;
      case "DoError":
        API = getTest;
        params = {
          categoryid: this.categoryid,
          type: 1
        };
        break;
      case "DoFavtest":
        API = getTest;
        params = {
          categoryid: this.categoryid,
          type: 2
        };
        break;
    }
    if (API) {
      this.$showLoading();
      API(params).then(res => {
        if (res.result === "success") {
          this.$hideLoading();
          let paperTkList = res.list.tmlist;
          if (paperTkList.length) {
            let _tkList = [];
            paperTkList.map((dt, index) => {
              dt.type = "dt";
              dt.prentKey = index;
              _tkList.push(dt);
              dt.tklist.map((xt, xtIndex) => {
                let _xt = this.tkItemInit(xt, dt.prentKey, _tkList.length);
                _tkList.push(_xt);
              });
            });
            this.pageTuning = 1;
            this.paperTkList = _tkList;
          } else {
            this.$toast("未找到任何题目").then(() => {
              this.$router.back();
            });
          }
          this.scoreout = res.list.scoreout;
        } else {
          this.$toast(res.msg).then(() => {
            this.$router.back();
          });
        }
      });
    }
  },
  methods: {
    /**
     * 数据初始化
     */
    dataInit() {
      this.pageTuning = 0;
      this.xtnum = 0;
      this.categoryid = this.$route.query.categoryid;
      this.paperId = this.$route.query.paperId;
      this.paperTkList = [];
      this.recode = [];
      this.time = "00:00:00";
      this.second = 0;
      this.$store.ready(state => {
        let userid = state.userInfo.userid;
        if (localStorage[`EXAM_SLIDE_TIPS_${userid}`] != 1) {
          this.showPaperSlideTips = true;
        }
      });
    },
    /**
     * 初始化题目字段
     * @param {Object} 题目对象
     * @param {Number} 归属大题的索引值
     * @param {Number} 绑定轮播图的索引值，用于快速滑到对应题号
     */
    tkItemInit(tkItem, dtIndex, swiperIndex) {
      this.xtnum++;
      /**小题标志 */
      tkItem.type = "xt";

      /**是否已标记 */
      tkItem.signed = false;

      /**储存当前选中的答案 */
      tkItem.useranswer = [];
      /**即时显示答题对错状态 */
      tkItem.showAnswerStatus = false;
      /**用于找到答题卡对应的题号，增加标志、已做等样式 */
      tkItem.num = this.xtnum;

      /**当前大题的索引值*/
      tkItem.subKey = dtIndex;
      /**增加解析开关 */
      tkItem.analysis_flag = false;

      if (tkItem.tktype == 5) {
        tkItem.tkinfo.answer.map(arrItems => {
          arrItems.options = "";
        });
      } else if (tkItem.tktype == 6) {
        tkItem.tkinfo.childtk.map(child => {
          child.analysis_flag = false;
          child.showAnswerStatus = false;
          child.num = this.xtnum;
          child.useranswer = [];
        });
      }

      /**
       * 答题卡
       */
      this.recode.push({
        bindSwiperIndex: swiperIndex,
        num: this.xtnum,
        sign: false,
        answered: false
      });

      return tkItem;
    },
    /**
     * 获取当前轮播对象
     */
    getSwiper() {
      return this.$refs.choice.swiper || {};
    },
    /**
     * 单选、多选、判断选择触发回调
     * @param {Object} 题目对象
     * @param {Array} 选项值数组
     * @param {Boolean} 是不是组合题
     */
    handleChoiced(item, optionArr, isCombinationQuestion) {
      this.recode[item.num - 1].answered = true;
      item.useranswer = optionArr;
      if (item.tktype == 2 || item.tktype == 4) {
        if (!isCombinationQuestion) {
          this.goNext();
        }
      }
    },
    /**
     * 切换到下一题
     */
    goNext() {
      if(this.slideFlag){
        this.slideFlag = false;
        setTimeout(() => {
          this.getSwiper().slideNext(400);
        }, 400);
      }
    },
    /**
     * 填空题提交答案
     * @param {Object} 题目对象
     */
    handleFillBlankAnswer(item) {
      let anserArr = [];
      item.tkinfo.answer.map(res => {
        anserArr.push(res.options);
      });
      this.recode[item.num - 1].answered = true;
      item.useranswer = anserArr;
    },
    /**
     * 简答题提交答案
     * @param {Object} 简答题对象
     **/
    handleShortAnswer(item) {
      this.recode[item.num - 1].answered = true;
    },

    /**
     * 答题卡信息传值
     */
    sheetclick() {
      if (this.cardVisabled) {
        this.cardVisabled = false;
      } else {
        this.cardVisabled = true;
        this.$nextTick(() => {
          this.$refs.sheet.reset({
            answerList: this.recode,
            swiperChoice: this.$refs.choice
          });
        });
      }
    },
    /**
     * 答题卡回调跳转当前选中题
     * @param {Number} 题目索引值
     */
    handleCardClick(index) {
      this.getSwiper().slideTo(index, 500, false);
      this.cardVisabled = false;
    },
    /**
     * 标记当前题目
     * @param {Number} 当前题目索引值
     */
    sign(index) {
      let signItem;
      this.recode.map(item=>{
        if(item.num == index){
          signItem = item
        }
      })
      if(!signItem) {
        return
      }
      if (signItem.sign == false) {
        signItem.sign = true;
        this.paperTkList.map((item, i) => {
          if (i == index) {
            item.signed = true;
          }
        });
      } else {
        signItem.sign = false;
        this.paperTkList.map((item, i) => {
          if (i == index) {
            item.signed = false;
          }
        });
      }
    },
    /**
     * 收藏题目
     * @param {Object} 题目对象
     */
    collect(item) {
      setCollect({
        type: 2, //1试卷 2题目
        categoryid: this.categoryid,
        infoid: item.tkid
      }).then(res => {
        if (res.result == "success") {
          item.is_collection = !item.is_collection;
        }
      });
    },
    /**
     * 查看解析
     * @param {Object} 题目对象
     */
    viewAnalysis(item) {
      item.analysis_flag = true;
      item.showAnswerStatus = true;
    },
    /**
     * 触发滑动提示的我知道按钮
     */
    iKnow() {
      this.$store.ready(state => {
        let userid = state.userInfo.userid;
        localStorage[`EXAM_SLIDE_TIPS_${userid}`] = 1;
      });
      this.showPaperSlideTips = false;
    },
    /**
     * 交卷
     */
    save() {
      /**构造大题数组 */
      let answerResult = [];
      this.paperTkList.map((item, i) => {
        if (item.type == "dt") {
          answerResult.push({
            title: item.title,
            tklist: []
          });
        }
      });
      /**填充小题 */
      this.paperTkList.map((item, i) => {
        if (item.type == "xt") {
          let answerItem = [];
          if (item.tktype == 6) {
            item.tkinfo.childtk.map((child, i) => {
              answerItem.push({
                tktype: child.tktype,
                score: child.score,
                useranswer:
                  isArrayOrObject(child.useranswer) !== "Array"
                    ? [child.useranswer]
                    : child.useranswer
              });
            });
          } else {
            answerItem =
              isArrayOrObject(item.useranswer) !== "Array"
                ? [item.useranswer]
                : item.useranswer;
          }
          answerResult[item.subKey].tklist.push({
            tkid: item.tkid,
            useranswer: answerItem,
            tktype: item.tktype,
            score: item.score
          });
        }
      });
      let API;
      let params = {};
      switch (this.$route.name) {
        case "DoExercise":
          API = setPaperAnswer;
          params = {
            categoryid: this.categoryid,
            paperid: this.paperId,
            answer: answerResult,
            time: this.second
          };
          break;
        case "DoRadom":
        case "DoError":
        case "DoFavtest":
          /**1随机练习 2错题练习 */
          let _type =
            (this.$route.name === "DoRadom" && 1) ||
            (this.$route.name === "DoError" && 2) ||
            (this.$route.name === "DoFavtest" && 3);
          API = endTest;
          params = {
            categoryid: this.categoryid,
            answer: answerResult,
            time: this.second,
            type: _type
          };
          break;
      }
      if (API) {
        this.$showLoading("正在交卷");
        API(params).then(res => {
          this.$hideLoading();
          if (res.result === "success") {
            this.$toast("交卷成功", "success").then(() => {
              switch (this.$route.name) {
                case "DoExercise":
                  this.$router.push({
                    path: "/exam/result",
                    query: {
                      id: res.id,
                      type: 1
                    }
                  });
                  break;
                case "DoRadom":
                case "DoFavtest":
                case "DoError":
                  this.$router.push({
                    path: "/exam/result",
                    query: {
                      type: 2,
                      id: res.id
                    }
                  });
                  break;
              }
            });
          }
        });
      }
    },
    /**
     * 获取时间 格式 hh:mm:ss
     * @param {Number} 秒
     */
    getTime(second) {
      let hour, minute;
      hour = Math.floor(second / 3600);
      second = second - hour * 3600;
      minute = Math.floor(second / 60);
      second = second - minute * 60;
      let _hour = hour < 10 ? "0" + hour : hour;
      let _minute = minute < 10 ? "0" + minute : minute;
      let _second = second < 10 ? "0" + second : second;
      this.time = _hour + ":" + _minute + ":" + _second;
    },
    /**
     * 启动计时器
     */
    start() {
      let timer = setInterval(() => {
        this.second += 1;
        this.getTime(this.second);
      }, 1000);
    }
  }
  
};
</script>
<style scoped>
.paper {
  background: #fff;
}
.paper-slide-tips {
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  z-index: 9;
  background: rgba(0, 0, 0, 0.5);
  color: #fff;
  font-size: 16px;
  line-height: 34px;
  display: flex;
  align-items: center;
}
.paper-slide-tips img {
  height: 160px;
}

.paper-slide-tips .ks-button {
  background: none;
  color: #fff;
  border: 1px solid #fff;
  margin-top: 80px;
}

.paper-slide-tips__inner {
  display: flex;
  flex-direction: column;
  margin: 0 auto;
  text-align: center;
}

.paper-header {
  display: flex;
  align-items: center;
  padding: 0 15px;
  height: 57px;
  font-size: 13px;
}
.paper-header__second {
  color: #525b67;
  padding-right: 10px;
  flex: 1;
}
.paper-header__card {
  padding-right: 15px;
  line-height: 20px;
}
.paper-header__card img {
  height: 20px;
  float: left;
  margin-right: 5px;
}
.paper-header-sumbit {
  padding: 0 20px;
  background: #5185f7;
  color: #fff;
  height: 26px;
  line-height: 26px;
  font-size: 12px;
  border-radius: 2px;
}
.paper-contianer {
  padding: 20px 15px;
}

.paper-xt__title {
  font-size: 14px;
  color: #3e4754;
  line-height: 1.6;
}

.paper-contianer__bigtitle {
  font-size: 16px;
  font-weight: bold;
}
.paper-contianer__desc {
  line-height: 24px;
  color: #999;
  margin-top: 5px;
}
.paper-contianer__intro {
  font-size: 14px;
  line-height: 24px;
  padding-top: 10px;
}
.paper-xt,
.paper-option-box {
  padding: 15px 0;
}
.paper-option,
.paper__answer-area {
  padding: 10px 0;
  line-height: 32px;
  color: #3e4754;
  font-size: 14px;
}
.paper-option span {
  width: 32px;
  height: 32px;
  text-align: center;
  font-size: 15px;
  color: #3e4754;
  display: inline-block;
  border-radius: 50%;
  border: 1px solid #e5e7eb;
  margin-right: 15px;
}
.paper-opear {
  text-align: right;
}
.paper-opear__sign {
  display: inline-block;
}
.paper-opear__sign img {
  width: 11px;
  padding-right: 5px;
  position: relative;
  top: 2px;
}
.paper-opear__collect {
  display: inline-block;
  margin-left: 10px;
}

.paper-opear__collect img {
  width: 11px;
  padding-right: 5px;
}
.paper-contianer {
  position: relatives;
}
.actived {
  background: #5185f7;
  color: #fff !important;
}
.signed,
.collected {
  color: #5185f7;
}
.paper-option-textarea {
  display: block;
  resize: vertical;
  padding: 5px 15px;
  line-height: 1.5;
  box-sizing: border-box;
  width: 100%;
  height: 10rem;
  font-size: inherit;
  color: #606266;
  background-color: #fff;
  background-image: none;
  border: 1px solid #dcdfe6;
  border-radius: 4px;
  transition: border-color 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
  margin: 10px 0;
}
.paper-option-input {
  margin-left: 10px;
  height: 30px;
  line-height: 30px;
  border: 0px;
  border-bottom: 1px solid #eee;
  font-size: 14px;
  width: 75%;
}
/**解析*/
.tk-analysis {
  padding: 15px 0;
}
.tk-analysis__button {
  height: 30px;
  line-height: 30px;
  background: #eceff7;
  display: inline-block;
  border: 1px solid #bacbf9;
  border-radius: 4px;
  color: #5185f7;
  padding: 0 15px;
}
</style>
<style>
.paper-contianer__intro p {
  margin-top: 10px;
}
</style>