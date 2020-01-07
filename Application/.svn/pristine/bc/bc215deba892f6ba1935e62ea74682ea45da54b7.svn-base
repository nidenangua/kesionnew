<template>
  <div class="wx-editor clearfix">
    <div
      class="wx-editor__content"
      :style="{height:height || '220px'}"
      contenteditable="true"
      ref="replyEditorContent"
    ></div>
    <div class="wx-editor__bar">
      <emotion
        top="40px"
        class="wx-editor__emotion"
        ref="emotion"
        :visible.sync="visible_emotion"
        @select="appendEmotion"
      >
        <span class="ks-fl ks-cursor-pointer" slot="switch">
          <i class="iconfont icon-Ovalx"></i>
        </span>
      </emotion>
      <span class="wx-editor__tip">请注意文明发言，按下Enter键换行</span>
    </div>
  </div>
</template>
<script>
import Emotion from "@/plugins/emotion";
export default {
  name: "WxEditor",
  props: ["height"],
  data() {
    return {
      visible_emotion: false,
      length
    };
  },
  methods: {
    /**
     * 添加表情
     */
    appendEmotion(emotion) {
      this.$refs.replyEditorContent.appendChild(emotion);
    },
    /**
     * 获取内容
     */
    getContent() {
      let content = this.$refs.emotion.emotionReplaceToCode(
        this.$refs.replyEditorContent.innerHTML
      );

      /**
       * 替换换行符
       */
      content = content.replace(/\<br\s*\/?>/gi, "\\n");
      content = content.replace(/\<(div|h[1,2,3,4,5,6]|p)[^>]*\>/i, "\\n");
      content = content.replace(/\<\/(div|h[1,2,3,4,5,6]|p)\>/gi, "\\n");

      /**
       * 清除html标签
       */
      content = content.replace(/\<\/?[^>]*\>/gi, "");
      return content;
    },
    codeReplaceToEmotion(content) {
      return this.$refs.emotion.codeReplaceToEmotion(content);
    },
    /**
     * 设置内容
     */
    setContent(content) {
      if (content) {
        let _content = this.codeReplaceToEmotion(content);
        _content = _content.replace(/\n/g, "<br />");
        this.$refs.replyEditorContent.innerHTML = _content;
      } else {
        this.$refs.replyEditorContent.innerHTML = "";
      }
    }
  },
  mounted() {},
  components: {
    Emotion
  }
};
</script>
<style scoped>
.wx-editor {
  border: 1px solid #e0e0e0;
}
.wx-editor__content {
  width: 100%;
  border: 0px;
  overflow-y: auto;
  box-sizing: border-box;
  padding: 20px;
  outline: none;
  font-size: 14px;
}

.wx-editor__bar {
  height: 40px;
  line-height: 40px;
  border-top: 1px solid #e0e0e0;
  padding: 0 20px;
  position: relative;
}
.wx-editor__emotion {
  top: 40px;
}

.wx-editor__bar .ks-fl i {
  color: #aaa;
  font-size: 22px;
}
.wx-editor__bar .ks-fl:hover i {
  color: #555;
}
.wx-editor__tip {
  float: right;
  color: #999;
  font-size: 14px;
}
</style>

