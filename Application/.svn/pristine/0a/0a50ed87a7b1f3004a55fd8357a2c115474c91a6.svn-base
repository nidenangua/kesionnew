<template>
  <ks-container class="batch-marking" v-if="loaded">
    <div class="ks-breadcrumb">
      <el-breadcrumb separator="/">
        <el-breadcrumb-item>
          <a @click="$router.back()">待批卷列表</a>
        </el-breadcrumb-item>
        <el-breadcrumb-item>批量阅卷</el-breadcrumb-item>
      </el-breadcrumb>
    </div>
    <div class="batch-marking__paper-name">
      {{paperName}}
      <el-tag
        size="small"
        class="ks-ml10"
        v-if="tableDatas.length && tableDatas.length == saved.length"
      >已批阅完成</el-tag>
    </div>
    <div class="batch-marking__mode">
      <div class="ks-fr" v-if="tableDatas.length">
        <div class="batch-marking__progress">
          <span
            class="ks-mr15"
            v-if="batchMode == 2 && tableDatas[current]"
          >当前考生：{{tableDatas[current].username}}</span>
          批卷进度:{{current + 1}}/{{tableDatas.length}} &nbsp; &nbsp;
          <el-popover placement="bottom" width="200" trigger="click">
            <div class="batch-marking-card">
              <el-button
                size="small"
                :type="getCardItemType(count)"
                :plain="getCardItemPlain(count)"
                v-for="count in tableDatas.length"
                :key="count"
                @click="current = count-1"
              >{{count}}</el-button>
            </div>
            <el-button slot="reference">答题卡</el-button>
          </el-popover>
        </div>
      </div>
      <el-radio-group v-model="batchMode">
        <el-radio-button label="1">按题型顺序</el-radio-button>
        <el-radio-button label="2">按人员顺序</el-radio-button>
      </el-radio-group>
    </div>

    <div v-if="tableDatas.length">
      <!--按题型顺序-->
      <div v-if="batchMode == 1">
        <div class="batch-marking__tk-title">
          题目内容：
          <span class="ks-fr ks-color-primary">{{tableDatas[current].score}}分</span>
        </div>
        <div class="batch-marking__tk-content">
          <div v-html="`${current+1} 、 ${tableDatas[current].title}`"></div>
          <div v-if="tableDatas[current].tktype == 6">
            <div
              v-for="(child,i) in tableDatas[current].tkinfo.childtk"
              :key="i"
              v-html="`${i+1})、【${child.type_name}】 ${child.title}`"
            ></div>
          </div>
        </div>
        <marking
          ref="marking"
          class="ks-mt20"
          mark-type="question"
          :table-data="tableDatas[current].answerList"
          v-if="tableDatas[current]"
        />
      </div>

      <!--按人员顺序-->
      <div class="ks-mt20" v-else-if="batchMode == 2">
        <marking
          ref="marking"
          :table-data="tableDatas[current].answerList"
          v-if="tableDatas[current]"
        />
      </div>

      <div class="ks-mt20" align="center">
        <el-button
          @click="prev()"
          v-show="current >= 1"
        >{{(this.batchMode == 1 && '返回上一题') || (this.batchMode == 2 && '返回上一位')}}</el-button>
        <el-button
          type="primary"
          @click="next()"
        >保存{{(this.batchMode == 1 && tableDatas.length > current+1 && '进入下一题') || (this.batchMode == 2 && tableDatas.length > current+1 && '进入下一位') || ''}}</el-button>
      </div>
    </div>
    <div class="ks-empty" v-else>暂无批改内容</div>
  </ks-container>
</template>
<script>
import Marking from "./components/Marking";
import { cloneData } from "@/utils";
import { batchReadOverList, batchReadOver } from "@/api/exam";
export default {
  name: "BatchMarking",
  components: {
    Marking
  },
  data() {
    return {
      /**试卷答题信息请求状态 */
      loaded: false,
      /**阅卷列表索引 */
      current: 0,
      /**阅卷方式 */
      batchMode: 1,
      /**题目列表 */
      tableDatas: [],
      /**按人员阅卷 */
      peopleList: [],
      /**当前试卷id */
      paperid: this.$route.query.paperid,
      /**当前试卷名称 */
      paperName: "",
      /**已保存的题目、人员 */
      saved: []
    };
  },
  methods: {
    /**
     * 数据初始化
     */
    dataInit() {
      this.current = 0;
      this.batchMode = 1;
      this.tableDatas = [];
      this.peopleList = [];
      this.paperid = this.$route.query.paperid;
      this.paperName = "";
      this.saved = [];
    },
    /**
     * 获取试卷批阅信息
     */
    getPaperAnswers() {
      this.loaded = false;
      let params = {
        paperid: this.paperid,
        type: this.batchMode
      };
      batchReadOverList(params).then(res => {
        if (res.result == "success") {
          this.paperName = res.title;
          this.current = (res.saved[res.saved.length - 1] || 1) - 1;
          this.saved = res.saved;
          let _tableDatas = [];
          /**遍历题目，重新构造题目列表数组 */
          res.list.map(tk => {
            let _answerList = [];
            if (this.batchMode == 1) {
              tk.answerList.map((ans, index) => {
                /**将组合题的小题信息加上组合题信息变成一个对象，放至循环列表数组 */
                if (tk.tktype == 6) {
                  let newAns = ans.useranswer.filter(uans => {
                    return uans.tktype;
                  });
                  ans.useranswer = newAns;
                  ans.useranswer.map((uans, i) => {
                    let xt = cloneData(ans);
                    let keys = Object.keys(uans);
                    keys.map(k => {
                      xt[k] = uans[k];
                    });
                    xt.dtinfo = tk.tkinfo
                    xt.tkinfo = cloneData(tk.tkinfo.childtk[i].tkinfo)
              
                    /**小题兄弟数量 */
                    xt.siblings_num = ans.useranswer.length;
                    /**绑定大题类别 */
                    xt.dttype = 6;
                    /**添加解析显示开关 */
                    xt.analysis_flag = false;
                    /**添加大题标题 */
                    xt.dttitle = tk.title;
                    /**当前大题索引值 */
                    xt.tkindex = index;
                    /**当前小题索引值 */
                    xt.xtindex = i;
                    _answerList.push(xt);
                  });
                } else {
                  let _tk = cloneData(tk);
                  let keys = Object.keys(ans);
                  keys.map(k => {
                    _tk[k] = ans[k];
                  });
                  /**当前大题索引值 */
                  _tk.tkindex = index;
                  /**添加解析显示开关 */
                  _tk.analysis_flag = false;
                  _answerList.push(_tk);
                }
              });
              _tableDatas.push({
                title: tk.title,
                tktype: tk.tktype,
                score: tk.score,
                tkinfo: tk.tkinfo,
                answerList: _answerList
              });
            } else if (this.batchMode == 2) {
              tk.answerList.map((ans, index) => {
                if (ans.tktype == 6) {
                  let newAns = ans.useranswer.filter(uans => {
                    return uans.tktype;
                  });
                  ans.useranswer = newAns;
                  ans.useranswer.map((uans, i) => {
                    let xtInfo = ans.tkinfo.childtk[i];
                    let xt = cloneData(ans);
                    let keys = Object.keys(uans);

                    keys.map(k => {
                      xt[k] = uans[k];
                    });
                    xt.dtinfo = tk.tkinfo
                    xt.tkinfo = cloneData(xtInfo.tkinfo)
                    xt.title = xtInfo.title;
                    xt.type_name = xtInfo.type_name;
                    /**小题兄弟数量 */
                    xt.siblings_num = ans.useranswer.length;
                    /**绑定大题类别 */
                    xt.dttype = 6;
                    /**添加解析显示开关 */
                    xt.analysis_flag = false;
                    /**添加大题标题 */
                    xt.dttitle = tk.title;
                    /**当前大题索引值 */
                    xt.tkindex = index;
                    /**当前小题索引值 */
                    xt.xtindex = i;
                    _answerList.push(xt);
                  });
                } else {
                  let _tk = cloneData(ans);
                  /**当前大题索引值 */
                  _tk.tkindex = index;
                  /**添加解析显示开关 */
                  _tk.analysis_flag = false;
                  _answerList.push(_tk);
                }
              });
              _tableDatas.push({
                username: tk.username,
                answerList: _answerList
              });
            }
          });
          this.tableDatas = _tableDatas;
        }
        this.loaded = true;
      });
    },
    /**
     * 添加当前题目选中样式
     * @param {Number}
     */
    getCardItemType(count) {
      if (count - 1 == this.current || this.getCardItemPlain(count)) {
        return "primary";
      }
    },
    /**
     * 添加已保存题目样式
     * @param {Number}
     */
    getCardItemPlain(count) {
      let has = false;
      this.saved.map(id => {
        if (id == count && count - 1 != this.current) {
          has = true;
        }
      });
      return has;
    },
    /**
     * 保存进入下一题
     */
    next() {
      if (this.tableDatas.length >= this.current + 1) {
        if (this.$refs.marking.validate()) {
          let markInfo = this.$refs.marking.getMarkInfo();
          batchReadOver({
            answerList: markInfo,
            paperid: this.paperid
          }).then(res => {
            if (res.result === "success") {
              let has = this.saved.includes(this.current + 1);
              if (!has) {
                this.saved.push(this.current + 1);
              }
              if (this.current + 1 < this.tableDatas.length) {
                this.current++;
              } else if (this.saved.length == this.tableDatas.length) {
                this.$notify({
                  title: "成功",
                  message: "您已批阅完成",
                  type: "success"
                });
                setTimeout(() => {
                  this.$router.back(-1);
                }, 1000);
              }
            }
          });
        }
      }
    },
    /**
     * 返回上一题
     */
    prev() {
      if (this.current <= 0) {
        return false;
      }
      this.current--;
    }
  },
  activated() {
    this.dataInit();
    this.getPaperAnswers();
  },
  watch: {
    batchMode(val) {
      this.getPaperAnswers();
    }
  }
};
</script>
<style scoped>
.batch-marking__paper-name {
  font-size: 16px;
  padding: 20px 0;
}
.batch-marking__mode {
  line-height: 40px;
}
.batch-marking__input {
  max-width: 300px;
}
.batch-marking__progress {
  font-size: 14px;
  line-height: 40px;
  color: #999;
}
.batch-marking__candidate {
  font-size: 14px;
  line-height: 40px;
  margin-right: 60px;
}
.batch-marking__tk-title {
  line-height: 40px;
  font-size: 14px;
  margin-top: 20px;
}
.batch-marking__tk-content {
  font-size: 14px;
  color: #666;
}

.batch-marking-card {
  max-height: 200px;
  overflow-x: hidden;
  overflow-y: auto;
}
.batch-marking-card .el-button {
  margin: 5px;
}
</style>


