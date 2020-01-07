<template>
  <ks-container v-if="loaded">
    <el-breadcrumb class="ks-breadcrumb" separator="/">
      <el-breadcrumb-item :to="{ path: '/?url=/home.html/exam/Index?appid-10' }">试卷管理</el-breadcrumb-item>
      <el-breadcrumb-item>添加试卷</el-breadcrumb-item>
    </el-breadcrumb>
    <div class="paper-title">
      <div class="ks-fr">
        <el-button type="primary" @click="set">高级设置</el-button>
        <el-button @click="$router.back()">返回</el-button>
      </div>基础配置
    </div>
    <el-row class="paper-info ks-mt10">
      <el-col :span="24">
        <el-col :span="16">
          <div class="paper-info__head">
            <span class="paper-info__title">{{detail.title}}</span>
            <span class="ks-color-primary">共{{totalQuestionNumber}}题</span>
            <span
              class="ks-color-primary"
            >{{(detail.exam_type==2 && '手动组卷') || (detail.exam_type==1 && '随机组卷') }}</span>
          </div>
          <div class="ks-color-info ks-fz12 ks-mt20">创建时间：{{detail.adddate}}</div>
        </el-col>
        <el-col align="right" :span="8">
          <div class="paper-info__count ks-color-warning">{{totalScore}}分</div>
          <el-button class="ks-mt15" type="primary" plain @click="editPaperVisible = true">编辑</el-button>
        </el-col>
      </el-col>
    </el-row>

    <div class="paper-title">题目列表</div>
    <el-row v-if="detail.exam_type==2">
      <div v-if="questions.length">
        <div class="ks-mt20" v-for="(dryItem,index) in questions" :key="index">
          <el-row :gutter="20">
            <el-col :span="16">
              <div class="paepr-text">第{{index+1}}大题</div>
              <el-input
                class="paepr-input ks-ml10"
                v-model="dryItem.title"
                placeholder="请输入大题名称"
                :ref="`bigTitle${index}`"
              />
              <el-input class="paepr-input ks-ml10" v-model="dryItem.intro" placeholder="请输入大题说明"/>
            </el-col>

            <el-col :span="8" align="right">
              <el-dropdown @command="multiple">
                <el-button type="primary" icon="el-icon-plus">添加小题</el-button>
                <el-dropdown-menu slot="dropdown">
                  <el-dropdown-item
                    :command="{dtindex:index,tktype:tkTypeItem.id}"
                    v-for="tkTypeItem in tkTypes"
                    :key="tkTypeItem.id"
                  >{{tkTypeItem.name}}</el-dropdown-item>
                </el-dropdown-menu>
              </el-dropdown>

              <el-button class="ks-ml10" type="primary" @click="random(index)">随机抽题</el-button>
              <el-button @click="delBigQuestion(index)" type="danger">删除</el-button>
            </el-col>
          </el-row>
          <el-row class="paper-questions">
            <div v-if="dryItem.tklist.length">
              <el-row
                class="paper-question-item"
                :class="item.showFlag && 'active'"
                v-for="(item,tkindex) in dryItem.tklist"
                :key="tkindex"
              >
                <el-col :span="24">
                  <el-col :span="6">
                    <div class="paper-question-item__tit">
                      <span>{{tkindex+1}}、</span>
                      <span>难度：{{item.level}}</span>
                      <span class="ks-ml20">题型：{{item.type_name}}</span>
                    </div>
                  </el-col>
                  <el-col :span="18" align="right">
                    <div class="paper-question-item__opeart">
                      <ks-input-number
                        :disabled="item.tktype == 6"
                        v-model="item.score"
                        placeholder="填写分数"
                        :decimal-places="1"
                        unit="分"
                        @change="calculateBigQuestionScore(index)"
                      />
                    </div>
                    <div class="paper-question-item__opeart">
                      <el-button
                        type="primary"
                        plain
                        size="small"
                        :disabled="tkindex === 0"
                        icon="el-icon-arrow-up"
                        circle
                        @click="upFieldOrder(tkindex,dryItem.tklist)"
                      ></el-button>
                      <el-button
                        type="primary"
                        plain
                        size="small"
                        :disabled="tkindex ===  dryItem.tklist.length - 1"
                        icon="el-icon-arrow-down"
                        circle
                        @click="downFieldOrder(tkindex,dryItem.tklist)"
                      ></el-button>
                    </div>
                    <div class="paper-question-item__opeart">
                      <el-button-group>
                        <el-button @click="dropMeun(item)">{{item.showFlag ? '收起' : '展开'}}</el-button>
                        <el-button
                          class="paper-question-item__del"
                          icon="el-icon-delete"
                          @click="del(index,tkindex)"
                        />
                      </el-button-group>
                    </div>
                  </el-col>
                </el-col>

                <el-col :span="24" class="paper-question-item__intro">
                  <div v-html="item.title"></div>
                  <div class="paper-question-item__info" v-show="item.showFlag">
                    <div v-if="item.tktype == 6">
                      <!--组合题小题列表-->
                      <div
                        class="paper-question-item paper-question-item--s"
                        v-for="(mark,markindex) in item.tkinfo.childtk"
                        :key="markindex"
                      >
                        <el-row>
                          <el-col :span="6">
                            <div class="paper-question-item__tit">
                              <span>{{tkindex+1}}-{{markindex+1}}</span>
                              <span>题型：{{mark.type_name}}</span>
                            </div>
                          </el-col>
                          <el-col :span="18" align="right">
                            <div class="paper-question-item__opeart">
                              <ks-input-number
                                v-model="mark.score"
                                placeholder="填写分数"
                                :decimal-places="1"
                                @change="calculateBigQuestionScore(index)"
                                unit="分"
                              />
                            </div>
                            <el-button @click="dropMeun(mark)">{{mark.showFlag ? '收起' : '展开'}}</el-button>
                          </el-col>
                          <el-col :span="24" class="paper-question-item__intro">
                            <div v-html="mark.title"></div>
                            <div class="paper-question-item__info" v-show="mark.showFlag">
                              <p v-if="mark.tktype != 1">答案：{{mark.tkinfo.answer | filterAnswer(mark.tktype)}}</p>
                              <p>解析：{{mark.tkinfo.analysis | filterHtml}}</p>
                            </div>
                          </el-col>
                        </el-row>
                      </div>
                    </div>
                    <div v-else>
                      <p v-if="item.tktype != 1">答案：{{item.tkinfo.answer | filterAnswer(item.tktype)}}</p>
                      <p>解析：{{item.tkinfo.analysis | filterHtml}}</p>
                    </div>
                  </div>
                </el-col>
              </el-row>
            </div>
          </el-row>
        </div>
      </div>
      <div class="ks-empty" v-else>暂无题型</div>
    </el-row>
    <el-row v-if="detail.exam_type == 1">
      <!--随机组卷-->
      <div v-if="questions.length">
        <el-row class="radom-item" :gutter="20" v-for="(item,index) in questions" :key="index">
          <el-col :span="-1">第{{index+1}}大题</el-col>
          <el-col :span="3">
            <el-input v-model="item.title" placeholder="请输入大题名称" :ref="`bigTitle${index}`"/>
          </el-col>
          <el-col :span="4">
            <el-input class="paepr-input" v-model="item.intro" placeholder="请输入大题说明"/>
          </el-col>
          <el-col :span="3">
            <el-select
              v-model="item.tktype"
              class="radom-item__select"
              placeholder="选择题型"
              @change="getRadomItemData(item)"
            >
              <el-option
                v-for="option in questionTypes"
                :key="option.tk_type"
                :label="option.type_name"
                :value="option.tk_type"
                :disabled="option.tk_num == 0"
              ></el-option>
            </el-select>
          </el-col>
          <el-col :span="-1" class="ks-ml20">选取</el-col>
          <el-col :span="-1">
            <ks-input-number
              @change="calculateBigQuestionScore(index);calculateTotalQuestionNumber()"
              v-model="item.tk_num"
              :max="item.total"
              :disabled="item.total == 0"
              unit="题"
            />
          </el-col>
          <el-col :span="-1">共{{item.total}}题</el-col>
          <el-col :span="-1" class="ks-ml20">每小题</el-col>
          <el-col :span="-1">
            <ks-input-number
              v-model="item.score"
              @change="calculateBigQuestionScore(index);calculateTotalQuestionNumber()"
              :disabled="item.tk_num == 0"
              unit="分"
            />
          </el-col>

          <el-col :span="-1">
            <el-button type="danger" @click="delBigQuestion(index)">删除</el-button>
          </el-col>
        </el-row>
      </div>
      <div class="ks-empty" v-else>暂无题型</div>
    </el-row>

    <el-button type="primary" icon="el-icon-plus" @click="addTkType()">添加大题</el-button>

    <div class="ks-mt20 ks-fz14">
      发布状态 &nbsp;
      <el-switch
        v-model="is_open"
        active-value="1"
        inactive-value="0"
        :active-color="$store.state.switch_on"
        :inactive-color="$store.state.switch_off"
      ></el-switch>
    </div>

    <div class="paper-footer ks-mt20">
      <el-button type="primary" @click="submit()">确认保存</el-button>
      <el-button @click="back">取消</el-button>
    </div>

    <!--试卷编辑窗口-->
    <el-dialog title="编辑试卷" :visible.sync="editPaperVisible" width="900px">
      <paper-add :paper-id="paperId" @saved="paperSavedCall"/>
    </el-dialog>

    <!--选择题目窗口-->
    <el-dialog
      :title="getTkTypeName(typeValue)"
      :visible.sync="selectQuestionVisible"
      width="1100px"
    >
      <question-list
        action="selectQuestion"
        :tips="detail.categoryid > 0 ? `当前仅显示该试卷所属分类【${detail.categoryname}】下的题目` : ``"
        :selected-list="selectedTkids"
        :parentid-path="detail.parentidpath"
        :filter-type="typeValue"
        @callback="questionSelectedCall"
      />
    </el-dialog>

    <!--随机抽题窗口-->
    <el-dialog title="随机抽题" width="950px" :visible.sync="randomQuestionVisible">
      <random-question
        @callback="randomSelectedCall"
        :tips="detail.categoryid > 0 ? `当前仅可抽取该试卷所属分类【${detail.categoryname}】下的题目，且已选题目无法重复抽取` : ``"
        :categoryid="detail.categoryid"
        :selected-tkids="selectedTkids"
      />
    </el-dialog>

    <!--高级设置窗口-->
    <el-dialog width="950px" title="高级设置" :visible.sync="advancedSettingsVisible">
      <paper-set :paper-id="paperId" @callback="advancedSettingsVisible = false"/>
    </el-dialog>
  </ks-container>
</template>
<script>
import examMixins from "@/mixins/exam";
import { cloneData } from "@/utils";
import { getExamDetail, addExamTwo, getRandNum } from "@/api/exam";
import PaperAdd from "./PaperAdd";
import PaperChoice from "./PaperChoice";
import PaperSet from "./paperSet";
import RandomQuestion from "./RandomQuestion";
import QuestionList from "./QuestionList";
export default {
  name: "PaperAddList",
  components: {
    PaperChoice,
    PaperAdd,
    PaperSet,
    RandomQuestion,
    QuestionList
  },
  mixins: [
    /**包含tkTypes, getTkTypeName */
    examMixins
  ],
  data() {
    return {
      /**试卷详情信息请求状态 */
      loaded: false,
      /**试卷总分 */
      totalScore: 0,
      /**题目数量（不包括组合题小题） */
      totalQuestionNumber: 0,
      /**是否上架 */
      is_open: "1",
      /**试卷编辑窗口开关*/
      editPaperVisible: false,
      /**手动选题窗口开关*/
      selectQuestionVisible: false,
      /**随机选题窗口开关 */
      randomQuestionVisible: false,
      /**高级设置窗口开关 */
      advancedSettingsVisible: false,
      /**当前选择的小题id数组*/
      selectedTkids: [],
      /**题目类别数组 */
      questionTypes: [],
      /**试卷id*/
      paperId: this.$route.query.paperId,

      /**试卷详情 */
      detail: {},
      /**添加题型传入的题目类别*/
      typeValue: "1",

      /**当前选中的大题index*/
      currentSelected: 0,
      /**大题数组*/
      questions: [],
      /*默认分数*/
      defaultScore: 10
    };
  },
  methods: {
    /**
     * 编辑试卷保存回调，更新试卷基本信息
     */
    paperSavedCall(data) {
      this.editPaperVisible = false;
      this.detail.title = data.title;
      this.detail.categoryid = data.categoryid;
      this.detail.scoreout = data.scoreout;
    },
    /**
     * 随机抽题回调
     */
    randomSelectedCall(data) {
      this.questionSelectedCall(data);
      this.randomQuestionVisible = false;
    },
    /**
     * 题库回调的数组
     * @param {Array}
     */
    questionSelectedCall(data) {
      let tkArr = cloneData(data);
      tkArr.map((item, index) => {
        item.showFlag = false;
        if (item.tktype == 6) {
          item.tkinfo.childtk.map(child => {
            child.showFlag = false;
            if (!child.score) {
              child.score = this.defaultScore;
            }
          });
        } else if (!item.score) {
          item.score = this.defaultScore;
        }
        this.questions[this.currentSelected].tklist.push(item);
      });
      this.selectQuestionVisible = false;
      /**重新计算题目数量 */
      this.calculateTotalQuestionNumber();
      /**重新计算大题分数 */
      this.calculateBigQuestionScore(this.currentSelected);
    },
    /**
     * 计算题目数量
     */
    calculateTotalQuestionNumber() {
      let total = 0;
      if (this.detail.exam_type == 1) {
        this.questions.map(dt => {
          total += dt.tk_num;
        });
      } else if (this.detail.exam_type == 2) {
        this.questions.map(dt => {
          total += dt.tklist.length;
        });
      }
      this.totalQuestionNumber = total;
    },

    /**
     * 计算试卷总分
     */
    calculateTotalScore() {
      let total = 0;
      this.questions.map(dt => {
        total += Number(dt.dtscore);
      });
      this.totalScore = total;
    },
    /**
     * 计算大题总分
     * @param {Number} 大题index
     */
    calculateBigQuestionScore(index) {
      let total = 0;
      let bigQuestion = this.questions[index];
      if (this.detail.exam_type == 1) {
        total = bigQuestion.score * bigQuestion.tk_num || 0;
      } else {
        bigQuestion.tklist.map(item => {
          /**更新组合题分数 */
          if (item.tktype == 6) {
            let _score = 0;
            let childtk = item.tkinfo.childtk;
            childtk.map(child => {
              if (child.score) {
                _score += Number(child.score);
              }
            });
            item.score = _score;
          }
          if (item.score) {
            total += Number(item.score);
          }
        });
      }
      bigQuestion.dtscore = total;
      /**重新计算总分 */
      this.calculateTotalScore();
    },
    /**
     * 【随机组卷】获取当前题型的题目总数
     * @param {String} 题目类型
     */
    getTkTotalNum(type) {
      let total = 0;
      this.questionTypes.map(tk => {
        if (tk.tk_type == type) {
          total = tk.tk_num;
        }
      });
      return total;
    },
    /**
     * 【随机组卷】题目类型切换
     * @param {Object} 大题对象
     */
    getRadomItemData(item) {
      this.questionTypes.map(option => {
        if (option.tk_type == item.tktype) {
          item.total = option.tk_num;
          if (item.tk_num > option.tk_num) {
            item.tk_num = option.tk_num;
          }
        }
      });
    },
    /**
     * 保存试卷
     */
    submit() {
      let tkInfo = [];

      for (let i = 0; i < this.questions.length; i++) {
        let item = this.questions[i];
        if (!item.title) {
          this.$msg(`请先输入第${i + 1}大题名称`);
          this.$refs[`bigTitle${i}`][0].focus();
          return false;
        }
        if (this.detail.exam_type == 2) {
          let questionList = [];
          item.tklist.map(child => {
            let scoreParam = child.score;

            /**将组合题小题分数构造为数组 */
            if (child.tktype == 6) {
              let scoreArr = [];
              child.tkinfo.childtk.map(sub => {
                scoreArr.push(sub.score);
              });
              scoreParam = scoreArr;
            }
            questionList.push({
              tkid: child.tkid,
              score: scoreParam,
              tktype: child.tktype
            });
          });
          tkInfo.push({
            title: item.title,
            intro: item.intro || "",
            dtscore: item.dtscore,
            tklist: questionList
          });
        } else {
          tkInfo.push({
            title: item.title,
            intro: item.intro || "",
            dtscore: item.dtscore,
            score: item.score,
            tktype: item.tktype,
            tk_num: item.tk_num
          });
        }
      }
      /**
       * 执行保存
       */
      addExamTwo({
        title: this.detail.title,
        paperid: this.paperId,
        sumscore: this.totalScore,
        tk_num: this.totalQuestionNumber,
        is_open: this.is_open,
        tmlist: tkInfo
      }).then(res => {
        if (res.result == "success") {
          this.$msg("保存成功", "success");
          this.$router.push("/?url=/home.html/exam/Index?appid-10");
        }
      });
    },
    /**
     * 获取试卷详情
     */
    getDetail() {
      this.loaded = false;
      getExamDetail({
        paperid: this.paperId
      }).then(res => {
        if (res.result === "success") {
          let list = res.list;
          this.is_open = list.is_open;
          if (list.exam_type == 1) {
            /**【随机组卷】 */

            /**
             * 获取题型信息
             */
            getRandNum({
              categoryid: list.categoryid
            }).then(res => {
              res.list.map(item => {
                item.tk_type = item.tk_type.toString()
                item.tk_num = Number(item.tk_num)
              });
              this.questionTypes = res.list
              /**
               * 处理保存的数字过大（可能是题目被删除，导致之前设置的题数大于当前题库的总数）
               */
              list.tmlist.map(item => {
                let total = this.getTkTotalNum(item.tktype);
                item.total = total;
                if (item.tk_num > total) {
                  item.tk_num = total;
                }
              });
              this.questions = list.tmlist;
            });
          } else {
            /**【手工组卷】 */
            list.tmlist.map(item => {
              item.tklist.map(child => {
                if (child.tktype == 6) {
                  child.tkinfo.childtk.map(sub => {
                    sub.showFlag = false;
                  });
                }
                child.showFlag = false;
              });
            });
            this.questions = list.tmlist;
          }
          this.totalQuestionNumber = list.tk_num;
          this.totalScore = list.sumscore;
          this.detail = list;
        }
        this.loaded = true;
      });
    },

    /**
     * 查看题目详情
     * @param {Object} 题目对象
     */
    dropMeun(item) {
      item.showFlag ? (item.showFlag = false) : (item.showFlag = true);
    },
    /**
     * 删除小题
     * @param {Number} 大题index
     * @param {Number} 小题index
     */
    del(dryIndex, subIndex) {
      this.questions[dryIndex].tklist.splice(subIndex, 1);
      this.calculateBigQuestionScore(dryIndex);
      this.calculateTotalQuestionNumber();
    },
    /**
     * 跳转高级设置
     */
    set() {
      this.advancedSettingsVisible = true;
    },
    /**
     * 退回上一步
     */
    back() {
      history.back();
    },

    /**
     * 触发添加题目
     * @param {Object} 包括大题index以及要添加的题目类别
     */
    multiple(obj) {
      this.updateTkids();
      this.typeValue = obj.tktype;
      this.currentSelected = obj.dtindex;
      this.selectQuestionVisible = true;
    },
    /**
     * 更新已选的题目id数组
     */
    updateTkids() {
      let ids = [];
      this.questions.map(item => {
        item.tklist.map(tk => {
          ids.push(tk.tkid);
        });
      });
      this.selectedTkids = ids;
    },
    /**
     * 随机抽题
     * @param {Number} 大题index
     */
    random(index) {
      this.updateTkids();
      this.currentSelected = index;
      this.randomQuestionVisible = true;
    },
    /**
     * 添加题型
     */
    addTkType() {
      if (this.detail.exam_type == 1) {
        this.questions.push({
          title: "",
          dtscore: 0,
          intro: "",
          tk_num: 0,
          total: 0,
          tklist: []
        });
      } else if (this.detail.exam_type == 2) {
        this.questions.push({
          title: "",
          dtscore: 0,
          intro: "",
          tklist: []
        });
      }
    },
    /**
     * 删除大题
     * @param {Number} 大题index
     */
    delBigQuestion(index) {
      this.questions.splice(index, 1);
    },
    /**
     * 单行向上移动
     */
    upFieldOrder(index, row) {
      let temp = row[index - 1];
      this.$set(row, index - 1, row[index]);
      this.$set(row, index, temp);
    },
    /**
     * 单行向下移动
     */
    downFieldOrder(index, row) {
      let i = row[index + 1];
      this.$set(row, index + 1, row[index]);
      this.$set(row, index, i);
    },
    /**
     * 分数判断不能小于0
     */
    fraction(score) {
      if (score < 0) {
        this.$message({
          message: "数字不能小于0",
          type: "warning"
        });
        score = "";
      } else {
        score = score.toFixed(1);
      }
    }
  },
  activated() {
    this.paperId = this.$route.query.paperId;
    this.detail = {};
    this.questions = [];
    this.getDetail();
  }
};
</script>
<style scoped>
.paper-title {
  height: 44px;
  line-height: 44px;
  overflow: hidden;
  margin-top: 20px;
  font-size: 14px;
  position: relative;
  color: #666;
}

.paper-info {
  background: #fff;
  padding: 20px;
  border-radius: 4px;
  font-size: 14px;
  border: 1px solid #e6e6e6;
  background: #f6f6f6;
  line-height: 34px;
}
.paper-info__head {
  height: 40px;
  line-height: 40px;
}
.paper-info__title {
  font-size: 22px;
  font-weight: normal;
}
.paper-info .el-input {
  max-width: 300px;
}

.paper-info span {
  margin-right: 20px;
}
.paper-info__count {
  font-size: 30px;
}
.paper-questions {
  padding-bottom: 20px;
  border-bottom: 1px solid #eee;
  margin-bottom: 30px;
}

.paper-question-item {
  padding: 15px 25px;
  border: 1px solid #eee;
  border-radius: 10px;
  margin-top: 15px;
}
.paper-question-item.active {
  border: 1px dashed #488bff;
}
.paper-question-item--s {
  border: 1px dashed #e3e3e3;
}

.paper-question-item__tit {
  line-height: 40px;
  color: #999;
}
.paper-question-item__tit span {
  font-size: 14px;
}

.paper-question-item__intro {
  font-size: 14px;
  margin-top: 10px;
  padding-left: 25px;
}
.paper-question-item__opeart {
  position: relative;
  display: inline-block;
  line-height: 38px;
  margin: 0 10px;
}
.paper-question-item__del {
  background: #f9f9f9;
}

.paper-question-item__opeart-rep {
  right: inherit;
  left: 1px;
  border-right: 1px solid #dcdfe6;
  border-left: 0;
  border-radius: 0 0px 4px 4px;
  line-height: 37px;
}
.paper-question-item__info {
  margin: 15px 0;
}

.paper-question-item__info p {
  line-height: 24px;
}

.paepr-text {
  height: 40px;
  line-height: 40px;
  font-size: 14px;
  display: inline-block;
}
.paepr-input {
  max-width: 300px;
}
.paepr-input--short {
  max-width: 180px;
}
.paper-footer {
  border-top: 1px solid #eee;
  padding-top: 20px;
  text-align: center;
}

/*随机组卷*/
.radom-item {
  font-size: 14px;
  line-height: 40px;
  padding-bottom: 20px;
}

.radom-item__select {
  width: 100%;
}
</style>



