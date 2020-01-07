<template>
  <!-- 提问页 -->
  <div :style="{minHeight:minHeight+'px',background:'#fff'}" v-if="addAsk !== null">
    <div class="ks-border">
      <div class="ks-alert ks-alert--error" v-if="is_buy === 0">
        你还不是答疑会员，只能提问一次
        <span @click="jumpvip">立即开通会员>></span>
      </div>
      <div class="ks-textarea ks-pt10">
        <textarea
          autocomplete="off"
          v-model="addAsk.title"
          placeholder="请输入问题"
          maxlength="50"
          class="ks-textarea__inner"
          style="height: 80px;"
        ></textarea>
        <span class="ks-input__count">{{addAsk.title.length}}/50</span>
      </div>
      <div class="ks-textarea ks-pt10">
        <textarea
          autocomplete="off"
          v-model="addAsk.content"
          placeholder="添加问题描述（选填）"
          maxlength="300"
          class="ks-textarea__inner"
          style="height: 160px;"
        ></textarea>
        <span class="ks-input__count">{{addAsk.content.length}}/300</span>
      </div>
      <div>
        <media-upload :info="addAsk.info" @change="onMediaUploadChange" />
      </div>
      <div>
        <span class="ks-word ks-fl">是否前台展示</span>
        <ks-switch v-model="addAsk.is_show" class="ks-fl"></ks-switch>
      </div>
      <div class="ks-word--lightgray ks-pt10">选择关闭，则该问题仅自己和老师可见</div>
      <ks-button class="ks-mt30" type="primary" width="100%" @click="publish">发表</ks-button>
    </div>
  </div>
</template>
<script>
import MediaUpload from "../../components/media-upload";
import { askAnswer, showVip, showAnswer } from "@/api/teacher.answer.js";
import { type } from "os";
export default {
  components: {
    MediaUpload
  },
  name: "MentoringQuiz",
  data() {
    return {
      minHeight: window.innerHeight,
      is_buy: "0",
      addAsk: null,
      status: ""
    };
  },
  methods: {
    onMediaUploadChange(data) {
      if (data.type == "image") {
        this.addAsk.type = "1";
      }
      if (data.type == "video") {
        this.addAsk.type = "2";
      }
      if (data.type == "audio") {
        this.addAsk.type = "3";
      }
      this.addAsk.info = data.info;
      if(this.addAsk.info.length == 0){
        this.addAsk.type = "";
      }
    },
    /**发表 */
    publish() {
      let params = {
        type: this.addAsk.type,
        title: this.addAsk.title,
        content: this.addAsk.content,
        info: this.addAsk.info,
        is_show: this.addAsk.is_show
      };
      askAnswer(params).then(res => {
        if (res.result === "success") {
          if (this.status == 1) {
            this.$toast("提问发表成功", "success");
            setTimeout(() => {
              //跳转
              this.$router.push({ path: "/Mentoring" });
            }, 2000);
          } else {
            this.$toast("提问发表成功,请等待审核", "success");

            setTimeout(() => {
              //跳转
              this.$router.push({ path: "/Mentoring" });
            }, 2000);
          }
        }
      });
    },
    /**开通答疑会员*/
    jumpvip() {
      this.$router.push("/user/mycard");
    }
  },
  activated() {
    let id = this.$route.query.id;
    this.addAsk = {
      title: "",
      content: "",
      info: [], //存放视频或图片或音频地址的
      type: "",
      is_show: true
    };
    document.title = "提问";
    showVip().then(res => {
      this.is_buy = res.is_buy;
      this.status = res.status;
    });
  },
  deactivated() {
    this.addAsk = null;
  }
};
</script>
<style scoped>
.ks-alert {
  width: 100%;
  padding: 8px 16px;
  margin: 0;
  box-sizing: border-box;
  border-radius: 4px;
  position: rksative;
  background-color: #fff;
  overflow: hidden;
  opacity: 1;
  display: flex;
  align-items: center;
  transition: opacity 0.2s;
}
.ks-alert--error {
  background-color: #fef0f0;
  color: #f56c6c;
}
.ks-alert--warning {
  background-color: #fdf6ec;
  color: #e6a23c;
}
.ks-alert span {
  float: right;
  margin-left: 30px;
  color: red;
}
.ks-border {
  padding: 10px;
}
.ks-textarea__inner {
  display: block;
  resize: vertical;
  padding: 5px 15px;
  line-height: 1.5;
  box-sizing: border-box;
  width: 100%;
  font-size: inherit;
  color: #606266;
  background-color: #fff;
  background-image: none;
  border: 1px solid #dcdfe6;
  border-radius: 4px;
  transition: border-color 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
}
.ks-textarea .ks-input__count {
  color: #909399;
  background: #fff;
  position: absolute;
  font-size: 12px;
  bottom: 5px;
  right: 10px;
}
.ks-textarea {
  position: relative;
  display: inline-block;
  width: 100%;
  vertical-align: bottom;
  font-size: 14px;
}
.ks-textarea__inner:focus {
  outline: none;
  border-color: #409eff;
}
.tips,
textarea {
  position: inherit;
  font-size: 14px;
}
.ks-word {
  color: #888;
  font-size: 14px;
  line-height: 20px;
}
.ks-word--lightgray {
  color: #bdbdbd;
  font-size: 14px;
  clear: both;
}
</style>