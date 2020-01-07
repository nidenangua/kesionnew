<template>
  <div>
    <el-row v-if="action !== 'selectQuestion'">
      <template>
        <el-tabs v-model="activeName" @tab-click="handleTabClick">
          <el-tab-pane label="试卷" name="first"></el-tab-pane>
          <el-tab-pane label="题库" name="second"></el-tab-pane>
        </el-tabs>
      </template>
    </el-row>
    <el-alert :title="tips" type="warning" :closable="false" v-if="tips"></el-alert>
    <el-row class="ks-pt20 ks-pd20">
      <el-col :span="18">
        <el-select v-model="tkhard" placeholder="请选择难度" class="ks-w150" @change="getList()">
          <el-option
            v-for="item in difficult"
            :key="item.value"
            :label="item.label"
            :value="item.value"
          ></el-option>
        </el-select>
        <el-select
          v-model="currentTkType"
          placeholder="请选择题目类型"
          class="ks-w150"
          @change="getList()"
          v-if="action !== 'selectQuestion'"
        >
          <el-option label="不限" value="0"></el-option>
          <el-option v-for="item in tkTypes" :key="item.id" :label="item.name" :value="item.id"></el-option>
        </el-select>
        <el-input
          placeholder="请输入内容"
          v-model="keyword"
          @change="getList()"
          class="input-with-select"
        >
          <i
            class="el-icon-search el-input__icon ks-cursor-pointer"
            slot="suffix"
            @click="getList()"
          ></i>
        </el-input>
      </el-col>
      <el-col :span="6" align="right">
        <el-button
          class="ks-mr10"
          type="primary"
          @click="paperLeadVisible = true"
          v-if="action !== 'selectQuestion'"
        >题目导入</el-button>
        <el-button
          type="primary"
          v-if="action === 'selectQuestion'"
          @click="addQuestion(currentTkType)"
        >添加{{getTkTypeName(currentTkType)}}</el-button>
        <el-dropdown @command="addQuestionCommand" v-else>
          <el-button type="primary">
            添加题目
            <i class="el-icon-arrow-down el-icon--right"></i>
          </el-button>
          <el-dropdown-menu slot="dropdown">
            <el-dropdown-item v-for="item in tkTypes" :key="item.id" :command="item">
              <div @click="addQuestion(item.id)">{{item.name}}</div>
            </el-dropdown-item>
          </el-dropdown-menu>
        </el-dropdown>
      </el-col>
    </el-row>
    <el-row>
      <el-col :span="24">
        <el-table :data="tableData" tooltip-effect="dark" style="width: 100%">
          <el-table-column label="选择" width="55">
            <template slot-scope="scope">
              <el-checkbox v-model="scope.row.checked" :disabled="scope.row.disabled"/>
            </template>
          </el-table-column>
          <el-table-column type="index" width="55" label="序号"></el-table-column>
          <el-table-column prop="level" label="难度" width="100"></el-table-column>
          <el-table-column label="题目类型" prop="type_name" width="120"></el-table-column>
          <el-table-column label="题目分类" prop="categoryname" width="120"></el-table-column>
          <el-table-column label="题目">
            <template slot-scope="scope">
              <div class="item-content">
                {{scope.row.title | filterHtml}}
                <span @click="spread(scope.row)">
                  <i class="expand ks-color-link">{{scope.row.showFlag ? '【关闭】' : '【展开】'}}</i>
                </span>
                <span v-if="scope.row.tktype == 6">
                  <el-dropdown @command="addChildQuestion">
                    <el-button type="primary" size="mini">
                      添加小题
                      <i class="el-icon-arrow-down el-icon--right"></i>
                    </el-button>
                    <el-dropdown-menu slot="dropdown">
                      <el-dropdown-item
                        v-for="item in tkTypes"
                        :key="item.id"
                        v-show="item.id != 6"
                        :command="{info:scope.row,tktype:item.id}"
                      >{{item.name}}</el-dropdown-item>
                    </el-dropdown-menu>
                  </el-dropdown>
                </span>
                <div class="analysis" v-if="scope.row.showFlag">
                  <div>
                    <div class="black-box">
                      <div v-if="scope.row.tktype != 1 && scope.row.tktype != 6">
                        答案：{{scope.row.tkinfo.answer | filterAnswer(scope.row.tktype)}}
                      </div>

                      <div class="black-title" v-if="scope.row.tktype != 6">解析：{{scope.row.tkinfo.analysis | filterHtml}}</div>
                    </div>
                  </div>
                  <div v-if="scope.row.tkinfo.childtk">
                    <div
                      class="small-question"
                      v-for="(make,i) in scope.row.tkinfo.childtk"
                      :key="i"
                    >
                      <div class="black-box">
                        <div class="black-font">第{{i+1}}小题</div>
                        <div class="black-title">【{{getTkTypeName(make.tktype)}}】{{make.title | filterHtml}}</div>
                      </div>
                      <div class="black-box">
                        <div v-if="make.tktype != 1">
                          <!--单选-->
                          答案：{{make.tkinfo.answer | filterAnswer(make.tktype)}}
                        </div>
                      </div>
                      <div class="black-title">解析：{{make.tkinfo.analysis | filterHtml}}</div>
                      <div class="black-box">
                        <span class="black-font">操作</span>
                        <span
                          class="expand ks-color-link"
                          @click="editCombinationQuestion(scope.row,make.tktype,i)"
                        >【编辑】</span>
                        <span
                          class="expand ks-color-link"
                          @click="makeDel(scope.row.tkinfo.childtk,i,scope.row.tkid)"
                        >【删除】</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </template>
          </el-table-column>
          <el-table-column prop="adddate" label="添加时间" width="200"></el-table-column>
          <el-table-column label="操作" width="80">
            <template slot-scope="scope">
              <el-dropdown trigger="click" @command="handleCommand">
                <span class="el-dropdown-link">
                  <i class="el-icon-more"></i>
                </span>
                <el-dropdown-menu slot="dropdown">
                  <el-dropdown-item :command="{type:'1',data:scope.row}">编辑</el-dropdown-item>
                  <el-dropdown-item :command="{type:'2',id:scope.row.tkid}">删除</el-dropdown-item>
                </el-dropdown-menu>
              </el-dropdown>
            </template>
          </el-table-column>
        </el-table>
      </el-col>
    </el-row>

    <el-dialog :visible.sync="paperLeadVisible" :append-to-body="true">
      <paper-lead @success="paperLeadVisible = false;getList()" />
    </el-dialog>
    <el-dialog
      width="950px"
      :title="getTkTypeName(typeValue)"
      :visible.sync="choiceQuesionVisible"
      :append-to-body="true"
    >
      <choice-question
        :update.sync="choiceQuesionVisible"
        :question-info="questionInfo"
        :type-value="typeValue"
        :child-question-index="childQuestionIndex"
        :default-parentid-path="parentidPath"
        @saved="handleTkSaved"
      />
    </el-dialog>
    <div class="ks-mt20 ks-pl10">
      <ks-table-footer
        v-if="action !== 'selectQuestion'"
        :pagination="pagination"
        :table-data="tableData"
        @current-change="getList"
        call-type="array"
        select-key="tkid"
        @trigger="del"
      />
      <ks-table-footer
        v-else
        :customize-button="{text:'确定'}"
        :pagination="pagination"
        :table-data="tableData"
        @current-change="getList"
        call-type="array"
        select-key="tkid"
        @trigger="save"
      />
    </div>
  </div>
</template>
<script>
import examMixins from "@/mixins/exam";
import { getTkList, del, saveCombination, addTk } from "@/api/exam";
import { cloneData } from "@/utils";
import PaperLead from "./PaperLead";
import ChoiceQuestion from "./ChoiceQuestion";
export default {
  name: "TKList",
  components: {
    ChoiceQuestion,
    PaperLead
  },
  mixins: [
    /**包含tkTypes, getTkTypeName */
    examMixins
  ],
  props: {
    /**action值为selectQuestion表示被试卷添加题目时调用 */
    action: String,
    /**当前题目类型 */
    filterType: {
      type: [String, Number],
      default: "0"
    },
    /**信息提示 */
    tips: String,
    /**分类的联动关系 */
    parentidPath: {
      type: Array,
      default() {
        return ["0"];
      }
    },
    /**已选列表 */
    selectedList: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  data() {
    return {
      loaded: true,
      /**试卷导入窗口开关 */
      paperLeadVisible: false,
      /**分页信息 */
      pagination: {
        total: 1,
        current: 1
      },
      /**当前选项卡选中值 */
      activeName: "second",
      /**搜索关键词 */
      keyword: "",
      /**当前的题库类别 */
      currentTkType: this.filterType,
      /**数据列表 */
      tableData: [],

      /**要添加或编辑的题目类型 */
      typeValue: "",
      /**添加、编辑题目窗口开关 */
      choiceQuesionVisible: false,
      /**难度系数 */
      difficult: [
        {
          value: "0",
          label: "不限"
        },
        {
          value: "1",
          label: "低"
        },
        {
          value: "2",
          label: "中"
        },
        {
          value: "3",
          label: "高"
        }
      ],
      /**当前选中的难度 */
      tkhard: "0",

      /**当前编辑的题目信息 */
      questionInfo: {},

      /**
       * 【组合题】的子题index
       * 当值为-2时，表示添加普通题目，当值为-1时，表示添加【组合题】的小题，当值为 >=0 时，表示编辑【组合题】对应的小题
       */
      childQuestionIndex: -2
    };
  },
  methods: {
    /**
     * 获取题目列表
     */
    getList(p=1) {
      this.$showLoading();
      let params = {
        p: p,
        level: this.tkhard,
        tktype: this.currentTkType,
        maxperpage: 10,
        keyword: this.keyword
      };
      params.categoryid =
        this.parentidPath[this.parentidPath.length - 1] || "0";
      getTkList(params).then(res => {
        res.list.map(item => {
          item.checked = false;
          item.disabled = false;
          item.showFlag = false;
        });
        this.tableData = res.list;
        this.setSelectedDisabled();
        this.pagination.current = res.page.now_page;
        this.pagination.total = res.page.total_pages;
        this.$hideLoading();
      });
    },
    /**
     * 设置已选项为不可选
     */
    setSelectedDisabled() {
      this.tableData.map(item => {
        let has = false;
        this.selectedList.map(tkid => {
          if (tkid == item.tkid) {
            has = true;
          }
        });
        if (has) {
          item.checked = true;
          item.disabled = true;
        } else {
          item.checked = false;
          item.disabled = false;
        }
      });
    },
    /**
     * 题目保存成功回调
     */
    handleTkSaved(data = {}) {
      this.choiceQuesionVisible = false;
      if (data.action === "addChildQuestion") {
        this.tableData.map(item => {
          if (item.tkid == data.tkid) {
            item.showFlag = true;
            item.tkinfo.childtk = data.childtk;
          }
        });
      } else if (data.action === "editQuestion") {
        this.getList(this.pagination.current);
      } else {
        this.getList();
      }
    },

    /**
     * 下拉菜单触发
     */
    handleCommand(command) {
      if (command.type == 2) {
        this.del([command.id]);
      } else {
        this.questionInfo = cloneData(command.data);
        this.childQuestionIndex = -2;
        this.typeValue = command.data.tktype;
        this.choiceQuesionVisible = true;
      }
    },
    /**
     * 删除题目
     * @param {Array} 题目id数组
     */
    del(tkids) {
      del({
        type: 2,
        id: tkids
      }).then(res => {
        if (res.result == "success") {
          this.$msg("删除成功", "success");
          this.getList(this.pagination.current);
        } else {
          this.$msg("删除失败");
        }
      });
    },

    /**
     * 添加小题
     * @param {Object} 包含组合题信息以及要添加的题目类型
     */
    addChildQuestion(data) {
      this.questionInfo = data.info;
      this.childQuestionIndex = -1;
      this.typeValue = data.tktype;
      this.choiceQuesionVisible = true;
    },
    /**
     * 添加题目的下拉菜单点击触发
     */
    addQuestionCommand(data) {
      this.addQuestion(data.id);
    },
    /**
     * 添加题目
     * @param {Number} 题目类型
     */
    addQuestion(typeId) {
      this.childQuestionIndex = -2;
      this.questionInfo = {};
      this.typeValue = typeId;
      this.choiceQuesionVisible = true;
    },
    /**
     * 选项卡点击
     */
    handleTabClick(tab) {
      if (tab.label == "试卷") {
        this.$router.push("/?url=/home.html/exam/Index?appid-10");
      }
    },

    /**
     * 保存
     */
    save() {
      let arr = [];
      this.tableData.map(item => {
        if (item.checked && item.disabled === false) {
          arr.push(item);
        }
      });
      this.$emit("callback", arr);
    },

    /**
     * 展开或关闭
     * @param {Object}
     */
    spread(item) {
      if (item.showFlag) {
        item.showFlag = false;
      } else {
        item.showFlag = true;
      }
    },
    /**
     * 组合小题删除
     * @param {Array}  组合题的小题数组
     * @param {Number} 小题index
     * @param {String} 组合题id
     */
    makeDel(childtk, index, id) {
      let _childtk = cloneData(childtk);
      _childtk.splice(index, 1);
      saveCombination({
        tkid: id,
        tklist: _childtk
      }).then(res => {
        if (res.result === "success") {
          this.$msg("删除成功", "success");
          childtk.splice(index, 1);
        }
      });
    },
    /**
     * 组合小题编辑
     * @param {String} 组合题信息
     * @param {String} 小题类型
     * @param {Number} 小题index
     */
    editCombinationQuestion(info, tktype, index) {
      this.questionInfo = info;
      this.typeValue = tktype;
      this.childQuestionIndex = index;
      this.choiceQuesionVisible = true;
    }
  },
  created() {
    this.getList();
  },
  activated() {
    this.activeName = "second";
  },
  watch: {
    filterType(val) {
      this.currentTkType = val;
      this.getList();
    },
    selectedList: {
      handler() {
        this.setSelectedDisabled();
      },
      deep: true
    }
  }
};
</script>
<style scoped>
.exam-title {
  font-size: 16px;
  color: #454545;
  margin-bottom: 30px;
}
.exam-topic > span {
  padding-right: 15px;
  color: #999;
  font-size: 14px;
  line-height: 40px;
}

.ks-w150 {
  width: 150px;
  margin-right: 10px;
}
.input-with-select {
  max-width: 300px;
}
.exam-topic {
  float: right;
}
.exam-icon {
  padding: 6px 20px 0 10px;
  border-radius: 4px;
  border: 1px solid #dcdfe6;
  box-sizing: border-box;
  height: 40px;
  float: right;
  margin-right: 10px;
  font-size: 14px;
  color: #666;
  cursor: pointer;
}
.exam-icon i {
  padding-right: 5px;
}
.el-header {
  color: #333;
  line-height: 60px;
  font-size: 16px;
}
body .el-tab-pane {
  padding: 0;
}
.small-question {
  padding: 5px 10px;
  border: 1px dashed #ddd;
  margin-top: 10px;
  border-radius: 5px;
}
.small-question .black-box {
  margin-top: 5px;
}
.expand {
  margin-left: 5px;
  cursor: pointer;
  font-style: normal;
}
</style>


