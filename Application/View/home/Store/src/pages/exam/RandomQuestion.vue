<template>
  <div>
    <el-alert :title="tips" type="warning" :closable="false" v-if="tips"/>
    <div class="random-question">
      <el-row
        :gutter="20"
        class="random-row"
        v-for="(item,i) in tkList"
        :key="i"
        :class="item.tk_num <= 0 && 'ks-color-info'"
      >
        <el-col :span="-1">
          <div class="exam-icon" style="text-align:center">{{item.type_name}}</div>
        </el-col>
        <el-col :span="4">
          <div class="exam-icon">
            <ks-input-number
              @change="handleInputValueChange(item)"
              v-model="item.value"
              :max="item.tk_num"
              :disabled="item.tk_num <= 0"
              unit="题"
            />
          </div>
        </el-col>
        <el-col class="ks-ml10" :span="-1">(可选 {{item.tk_num}}道题)</el-col>
        <el-col class="ks-ml20" :span="-1">每题</el-col>
        <el-col :span="4">
          <ks-input-number
            @change="handleInputValueChange(item)"
            :decimal-places="1"
            v-model="item.tkscore"
            :disabled="item.tk_num <= 0"
            unit="分"
          />
        </el-col>

        <el-col class="ks-ml10" :span="-1">共 {{(item.total)}}分</el-col>
      </el-row>
    </div>
    <div align="center">
      <el-button type="primary" @click="save">确定</el-button>
    </div>
  </div>
</template>
<script>
import { getRandomTk, getRandNum } from "@/api/exam";
export default {
  name: "RandomQuestion",
  props: {
    /**已选择的题目id数组 */
    selectedTkids: {
      type: Array,
      default() {
        return [];
      }
    },
    /**当前试卷分类id */
    categoryid: [Number, String],
    /**提示信息 */
    tips: String
  },
  data() {
    return {
      tkList: []
    };
  },
  methods: {
    /**
     * 保存获取抽取的题目信息
     */
    save() {
      let arrnum = [];
      let arrtype = [];
      this.tkList.map(item => {
        if (item.value && item.tk_num) {
          arrtype.push(item.tk_type);
          arrnum.push(item.value);
        }
      });
      if (!arrnum.length) {
        this.$msg("请先设置抽取题数");
        return;
      }
      getRandomTk({
        categoryid: this.categoryid,
        tmnum: arrnum,
        tkids: this.selectedTkids,
        tmtype: arrtype
      }).then(res => {
        if (res.result == "success") {
          this.$msg("试题设置成功", "success");
          this.tkList.map(item => {
            res.list.map(tk => {
              if (tk.tktype == item.tk_type) {
                tk.score = item.tkscore;
              }
            });
          });
          this.$emit("callback", res.list);
        }
      });
    },
    /**
     * 文本值发生变化，重新计算题目总分
     */
    handleInputValueChange(item) {
      item.total = item.value * item.tkscore || 0;
    },
    /**
     * 获取题库数据信息
     */
    getList() {
      getRandNum({
        categoryid: this.categoryid,
        tkids: this.selectedTkids
      }).then(res => {
        res.list.map(item => {
          item.tk_num = Number(item.tk_num);
          item.tkscore = 0;
          item.value = 0;
          item.total = 0;
        });
        this.tkList = res.list;
      });
    }
  },
  watch: {
    categoryid() {
      this.getList();
    },
    selectedTkids: {
      handler() {
        this.getList();
      },
      deep: true
    }
  },
  mounted() {
    this.getList();
  }
};
</script>
<style scoped>
.random-question {
  padding: 15px;
}
.random-row {
  font-size: 14px;
  padding: 15px;
  line-height: 40px;
}
</style>


