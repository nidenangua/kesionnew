<template>
  <ks-container v-if="loaded">
    <div class="ks-breadcrumb">
      <el-breadcrumb separator="/">
        <el-breadcrumb-item>
          <a @click="$router.back()">待批卷列表</a>
        </el-breadcrumb-item>
        <el-breadcrumb-item>批改试卷</el-breadcrumb-item>
      </el-breadcrumb>
    </div>
    <el-row class="paper-info">
      <el-col :span="6">试卷名称：{{paperDetail.title || '--'}}</el-col>
      <el-col :span="6">考生：{{paperDetail.username||'--'}}</el-col>
      <el-col :span="6">用时：{{paperDetail.time||'0' }}</el-col>
      <el-col :span="6">
        得分：
        <span class="ks-color-primary">{{paperDetail.sumscore||'0'}}分</span>
        <span class="ks-color-info">(客观题由系统自动计算得分)</span>
      </el-col>
    </el-row>
    <div v-if="tableData.length">
      <marking ref="marking" :table-data="tableData"/>
      <div align="center" class="ks-mt20">
        <el-button type="primary" @click="save()">确定保存</el-button>
        <el-button @click="$router.back()">取消返回</el-button>
      </div>
    </div>
    <div v-else>
      <div class="ks-empty">暂无可批阅的题目</div>
    </div>
  </ks-container>
</template>
<script>
import { cloneData } from "@/utils";
import Marking from "./components/Marking";
import { getPaperGradeDetail, batchReadOver } from "@/api/exam";
export default {
  name: "ParperMarking",
  components: {
    Marking
  },
  data() {
    return {
      loaded: false,
      /**阅卷信息 */
      tableData: [],
      /**阅卷id */
      id: 0,
      /**当前试卷id */
      paperid: 0,
      /**试卷详情 */
      paperDetail: {}
    };
  },
  activated() {
    this.dataInit();
    this.getAnswerDetail();
  },
  methods: {
    /**
     * 数据初始化
     */
    dataInit() {
      this.loaded = false;
      this.tableData = [];
      this.id = this.$route.query.id;
      this.paperid = this.$route.query.paperid;
      this.paperDetail = {};
    },
    /**
     * 试卷解析请求
     */
    getAnswerDetail() {
      const params = {
        isadmin: 0,
        id: this.id,
        paperid: this.paperid
      };
      getPaperGradeDetail(params).then(res => {
        if (res.result === "success") {
          this.paperDetail = res.detail;
          let _tableData = [];
          let _tkindex = -1;
          /**遍历大题，重新构造题目列表数组 */
          res.list.map(dt => {
            /**遍历小题 */
            dt.tklist.map(tk => {
              _tkindex++;
              if (tk.tktype == 6) {
                /**遍历组合题小题 */
                tk.useranswer.map((uans, i) => {
                  let xtInfo = tk.tkinfo.childtk[i];
                  let xt = cloneData(tk);
                  let keys = Object.keys(uans);
                  keys.map(k => {
                    xt[k] = uans[k];
                  });
                  xt.dtinfo = tk.tkinfo
                  xt.tkinfo = cloneData(xtInfo.tkinfo)
                  xt.title = xtInfo.title;
                  xt.type_name = xtInfo.type_name;
                  /**小题兄弟数量 */
                  xt.siblings_num = tk.useranswer.length;
                  /**绑定大题类别 */
                  xt.dttype = 6;
                  /**添加解析显示开关 */
                  xt.analysis_flag = false;
                  /**添加大题标题 */
                  xt.dttitle = tk.title;
                  /**当前大题索引值 */
                  xt.tkindex = _tkindex;
                  /**当前小题索引值 */
                  xt.xtindex = i;
                  _tableData.push(xt);
                });
              } else {
                /**添加解析显示开关 */
                tk.analysis_flag = false;
                /**当前题目索引值 */
                tk.tkindex = _tkindex;
                _tableData.push(tk);
              }
            });
          });
          this.tableData = _tableData;
        }
        this.loaded = true;
      });
    },
    /**
     * 下拉菜单
     */
    handleCommand(command) {
      if (command.type == 2) {
        this.del(command.id);
      }
    },
    /**过滤html格式 */
    htmlFilter(val) {
      return val ? val.replace(/<[^>]+>/g, "") : "";
    },
    /**
     * 保存
     */
    save() {
      if (this.$refs.marking.validate()) {
        let markInfo = this.$refs.marking.getMarkInfo();
        batchReadOver({
          answerList: markInfo,
          paperid: this.paperid
        }).then(res => {
          if (res.result === "success") {
            this.$notify({
              title: "成功",
              message: "批阅成功",
              type: "success"
            });
            setTimeout(() => {
              this.$router.back();
            }, 1000);
          }
        });
      }
    }
  }
};
</script>
<style scoped>
.paper-info {
  line-height: 34px;
  font-size: 14px;
  padding: 20px 0;
  border-radius: 4px;
  color: #666;
}
</style>


