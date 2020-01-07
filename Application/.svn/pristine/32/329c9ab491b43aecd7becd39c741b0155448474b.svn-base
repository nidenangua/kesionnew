<template>
  <div>
    <el-form :model="form" :rules="rules" ref="form" class="ks-mt30" label-width="100px">
      <el-form-item label="规则名称" prop="rule">
        <el-input v-model="form.rule"></el-input>
      </el-form-item>
      <el-form-item label="关键词">
        <div class="ks-pd10" v-for="(item,index) in form.keywords" :key="index">
          <el-select v-model="item.ruletype" placeholder="请选择">
            <el-option label="半匹配" value="1"></el-option>
            <el-option label="全匹配" value="0"></el-option>
          </el-select>
          <el-input v-model="item.keyword" style="max-width:408px;"></el-input>
          <span
            class="add-keyword-iconbtn"
            @click="addKeyword"
            v-if="index == form.keywords.length-1"
          >
            <i class="el-icon-plus"></i>
          </span>
          <span
            class="add-keyword-iconbtn"
            v-if="form.keywords.length > 1"
            @click="minusKeyword(index)"
          >
            <i class="el-icon-minus"></i>
          </span>
        </div>
      </el-form-item>
      <el-form-item class="reply-content" label="回复内容">
        <wx-reply-select ref="wxReplySelect"/>
      </el-form-item>
      <el-form-item label="回复方式">
        <el-radio v-model="form.replyway" label="0">回复全部</el-radio>
        <el-radio v-model="form.replyway" label="1">随机回复一条</el-radio>
      </el-form-item>
      <el-form-item class="ks-mt30">
        <el-button type="primary" @click="save">{{ruleInfo.id ? '保存' : '添加'}}</el-button>
        <el-button @click="cancel">取消</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>
<script>
import { cloneData } from "@/utils";
import WxReplySelect from "./compoents/WxReplySelect";
import { addWechatKeyWords, modifyWechatKeyWords } from "@/api/wechat";
export default {
  name: "AddKeywords",
  props: ["view", "ruleInfo"],
  data() {
    return {
      form: {
        type: 3,
        keywords: this.ruleInfo.keywords || [
          {
            ruletype: "1",
            keyword: ""
          }
        ],
        rule: this.ruleInfo.rule || "",
        replyway: this.ruleInfo.replyway || "0"
      },
      rules: {
        rule: [{ required: true, message: "请输入规则名称", trigger: "blur" }]
      }
    };
  },
  methods: {
    /**
     * 选择素材回调
     */
    selectMaterialCallback(item) {
      this.materialVisible = false;
      this.form.contents.push({
        replytype: 0,
        list: item.list,
        id: item.id
      });
    },
    /**
     * 添加关键词
     */
    addKeyword() {
      this.form.keywords.push({
        ruletype: "1",
        keyword: ""
      });
    },
    /**
     * 删除关键词
     */
    minusKeyword(index) {
      this.form.keywords.splice(index, 1);
    },
    /**
     * 保存
     */
    save() {
      this.$refs.form.validate(valid => {
        if (valid) {
          let form = cloneData(this.form);
          let info = this.$refs.wxReplySelect.getInfo();
          if (!info) {
            return false;
          }
          form.contents = JSON.stringify([info]);
          form.keywords = JSON.stringify(form.keywords);
          if (this.ruleInfo.id) {
            form.id = this.ruleInfo.id;
          }
          let api = form.id ? modifyWechatKeyWords : addWechatKeyWords;
          api(form).then(res => {
            if (res.result === "success") {
              this.$msg(res.msg, "success").then(res => {
                this.$emit("success");
                this.cancel();
              });
            } else {
              this.$msg(res.msg);
            }
          });
        }
      });
    },
    cancel() {
      this.$emit("update:ruleInfo", {});
      this.$emit("update:view", "list");
    }
  },
  mounted() {
    let contents = this.ruleInfo.contents;
    if (contents && contents[0]) {
      this.$refs.wxReplySelect.setInfo(contents[0]);
    }
  },
  components: {
    WxReplySelect
  }
};
</script>
<style scoped>
/*添加关键词*/
.add-keyword-iconbtn {
  width: 22px;
  height: 22px;
  border: 1px solid #eee;
  border-radius: 50%;
  display: inline-block;
  text-align: center;
  line-height: 22px;
  margin-left: 10px;
  cursor: pointer;
}
.add-keyword-iconbtn i {
  font-size: 14px;
}
</style>

