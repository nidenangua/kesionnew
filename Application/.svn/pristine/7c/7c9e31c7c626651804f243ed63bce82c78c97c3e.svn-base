<template>
  <div>
    <el-main>
      <el-form ref="form" :model="form" label-width="160px">
        <el-form-item label="考试时间">
          <el-input v-model="form.EaxmTime" style="width:150px"></el-input>&nbsp;&nbsp;分钟
        </el-form-item>
        <el-form-item label="考试难度">
          <el-select v-model="form.PaperLevel" placeholder="考试难度">
            <el-option label="低" value="1"></el-option>
            <el-option label="中" value="2"></el-option>
            <el-option label="高" value="3"></el-option>
          </el-select>
        </el-form-item>
        <!-- <el-form-item label="考试价格">
          <el-radio v-model="form.chargetype" :label="1">收费</el-radio>
          <el-radio v-model="form.chargetype" :label="0">免费</el-radio>
        </el-form-item>
        <div class="exam-box" v-show="form.chargetype == 1">
          <el-form-item label="试卷价格">
            <el-input class="ks-w180" v-model="form.price"></el-input>元
          </el-form-item>
          <el-form-item label="划线价格">
            <el-input class="ks-w180" v-model="form.price_market"></el-input>元
          </el-form-item>
          <el-form-item label="是否适用用户组优惠">
            <el-switch
              v-model="form.is_vip"
              active-value="1"
              inactive-value="0"
              :active-color="$store.state.switch_on"
              :inactive-color="$store.state.switch_off"
            ></el-switch>
          </el-form-item>
        </div> -->
        <el-form-item label="考试次数">
          <el-radio-group v-model="form.time">
            <el-radio v-model="form.time" :label="1">一次</el-radio>
            <el-radio v-model="form.time" :label="0">无限</el-radio>
          </el-radio-group>
        </el-form-item>
        <el-form-item label="试卷介绍">
          <el-input type="textarea" v-model="form.intro"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit">保存</el-button>
        </el-form-item>
      </el-form>
    </el-main>
  </div>
</template>
<script>
import { updateSetting, getExamDetail } from "@/api/exam";
export default {
  name: "PaperAdd",
  props: {
    paperId: String
  },
  data() {
    return {
      loaded: true,
      form: {
        EaxmTime: "",
        PaperLevel: "",
        chargetype: 0,
        price: "",
        price_market: "",
        paperId: this.paperId,
        is_vip: 0,
        time: 0, //考试测试 默认1 1次 0 不限
        intro: ""
      }
    };
  },
  methods: {
    onSubmit() {
      updateSetting({
        exam_time: this.form.EaxmTime,
        paper_level: this.form.PaperLevel,
        chargetype: this.form.chargetype,
        price: this.form.price,
        price_market: this.form.price_market,
        paperid: this.paperId,
        time: this.form.time,
        shortdesc: this.form.intro,
        is_vip: this.is_vip
      }).then(res => {
        if (res.result === "success") {
          this.$msg("设置成功", "success");
          this.$emit("callback");
        }
      });
    },
    handleSelectionChange(val) {
      this.multipleSelection = val;
    },
    /**
     * 获取试卷详情
     */
    getDetail() {
      getExamDetail({
        paperid: this.paperId
      }).then(res => {
        let data = res.list;
        this.form.EaxmTime = data.exam_time;
        this.form.PaperLevel = data.paper_level;
        this.form.chargetype = Number(data.chargetype);
        this.form.time = Number(data.time);
        this.form.price_market = data.price_market;
        this.form.price = data.price;
        this.form.intro = data.shortdesc;
      });
    }
  },
  created() {
    this.getDetail();
  },

  watch: {
    paperId() {
      this.getDetail();
    }
  }
};
</script>
<style scoped>
.ks-w180 {
  width: 180px;
  margin-right: 10px;
}
.el-header {
  color: #333;
  font-size: 16px;
}
.exam-box {
  background: #f2f5fa;
  padding: 30px;
  box-sizing: border-box;
  margin-bottom: 30px;
}
</style>


