<template>
  <div class="ks-editor">
    <div :id="`KsEditor${id}`"></div>
  </div>
</template>
<script>
let editorIndex = 0;
let editorJsLoaded = false;
export default {
  name: "KsEditor",
  props: {

    /**编辑器内容 */
    content: String,
    /**编辑器高度 */
    height: {
      type: Number,
      default: 100
    },
    /**字数限制 */
    maximumWords: {
      type: Number,
      default: 10000
    },
    /**是否开启字数统计 */
    wordCount: {
      type: Boolean,
      default: false
    },
    /**编辑器浮层高度 */
    zIndex:{
      type: Number,
      default: 9999
    }
  },
  model: {
    prop: "content",
    event: "change"
  },
  data() {
    editorIndex++;
    return {
      editorContent:'',
      id: editorIndex
    };
  },
  mounted() {
    this.createEditor(this.id);
  },
  watch: {
    content(content) {
      if(content !== this.editorContent){
        this.setContent(content)
      }
    }
  },
  methods: {
    /**
     * 创建编辑器
     */
    createEditor(id) {
      this.editor = UE.getEditor(`KsEditor${id}`, {
        initialFrameWidth: "100%",
        initialFrameHeight: this.height,
        maximumWords: this.maximumWords,
        wordCount: this.wordCount,
        zIndex: this.zIndex,
        toolbars: [
          [
            "fullscreen",
            "myinsertimage",
            "|",
            // "fontsize",
            // "forecolor",
            "bold",
            "italic",
            "underline",
            "strikethrough",
            "|",
            "superscript",
            "subscript",
            "removeformat"
          ]
        ]
      });
      /**修改图片点击操作 */
      this.editor.commands["myinsertimage"] = {
        execCommand: () => {
          this.$uploadImages(res => {
            this.editor.setContent(`<img src="${res.defaultpic}" />`, true);
            this.editorContent = this.editor.getContent();
            this.$emit("change", this.editorContent);
          });
        }
      };
      this.editor.addListener("ready", e => {
        this.isReady = true
        this.editor.setContent(this.content);
        this.editor.addListener("contentChange", e => {
          this.editorContent = this.editor.getContent();
          this.$emit("change", this.editorContent);
        });
      });
    },
    setContent(content){
      if(this.isReady){
        this.editor.setContent(content)
      }else{
        setTimeout(()=>{
          this.setContent(content)
        },100)
      }
    }
  },
};
</script>
<style scoped>
</style>
