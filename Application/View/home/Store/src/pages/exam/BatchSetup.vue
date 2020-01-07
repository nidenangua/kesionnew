<template>
  <div>
    <div v-if="tktypes.length">
      <el-row :gutter="20" class="ks-mb30" v-for="(item,i) in tktypes" :key="i">
        <el-col :span="2">
          <div
            class="exam-icon"
          >{{(item.tp == 1 && '单选题') || (item.tp == 2 && '填空题') || (item.tp == 3 && '判断题') ||(item.tp == 4 && '简答题')||(item.tp == 5 && '组合题')||(item.tp== 6 && '多选题')}}</div>
        </el-col>
        <el-col :span="2">
          <div class="exam-icon">{{tknums[item.tp]}}道题</div>
        </el-col>
        <el-col :span="4">
          <div class="exam-icon">
            <el-input placeholder="5.0" v-model="item.score"></el-input>
          </div>
        </el-col>
        <el-col :span="2">
          <div class="exam-icon">共{{ item.score * tknums[item.tp]}}分</div>
        </el-col>
      </el-row>
    </div>
    <el-row>
      <el-button type="primary" @click="save">保存</el-button>
    </el-row>
  </div>
</template>
<script>
import { checkModuleHasOpen } from "@/api/store";

export default {
  name: "BatchSetup",
  props: ["list", "dialogTableVisible"],
  data() {
    return {
      score: null,
      tktypes: [],
      tknums: {}
    };
  },
  methods: {
    save() {
      this.$emit("callback", this.tktypes);
      this.$emit("update:dialogTableVisible", false);
    }
  },
  activated() {
    score = null;
    tktypes = [];
    tknums = {};
    let tktypes = [];
    let tknums = {};
    this.list.map(function(item) {
      let has = false;
      if (tknums[item.tktype]) {
        tknums[item.tktype]++;
      } else {
        tknums[item.tktype] = 1;
      }
      tktypes.map(a => {
        if (a.tp === item.tktype) {
          has = true;
        }
      });
      if (!has) {
        tktypes.push({
          tp: item.tktype,
          score: ""
        });
      }
    });
    this.tktypes = tktypes;
    this.tknums = tknums;
  }
};
</script>
<style scoped>
.exam-title {
  font-size: 16px;
  color: #454545;
  margin-bottom: 30px;
}
.exam-icon {
  height: 40px;
  line-height: 40px;
  font-size: 14px;
}
.ks-mb30 {
  margin-bottom: 30px;
}
</style>


