<template>
    <div>
      <div class="edit_container">
        <quill-editor
            v-model="content"
            ref="myQuillEditor"
            :options="editorOption"
            @blur="onEditorBlur($event)"
            @focus="onEditorFocus($event)"
            @change="onEditorChange($event)"
        ></quill-editor>
        <!-- <div class="uploadImg" @click="uploadImg">上传图片</div> -->
        <div class="uploadImg" @click="uploadImg"><img src="../../../assets/course/pic.png" alt=""></div>
      </div>
      <div class="newcourse">
              <ks-button type="success" width="95%" class="ks-btn" v-on:click="saveHtml">保存下一步</ks-button>
      </div>
    </div>
</template>

<script>
import {quillEditor} from 'vue-quill-editor'
import 'quill/dist/quill.snow.css'
export default {
  components:{
    quillEditor
  },
  props:{
    actype:Number,
    accontent:''
  },
  name: "App",
  data() {
    return {
      content: '',
      editorOption: {
        modules: {
          toolbar: [
            ["bold", "italic", "underline", "strike"], //加粗，斜体，下划线，删除线
            [{ color: [] }], // 字体颜色
            // ["image"], //上传图片、上传视频
            ["sourceEditor"]
          ]
        },
        theme: "snow"
      },
      imgurl:[]
    };
  },
  computed: {
    editor() {
      return this.$refs.myQuillEditor.quill;
    }
  },
  methods: {
    onEditorReady(editor) {
      // 准备编辑器
    },
    onEditorBlur() {}, // 失去焦点事件
    onEditorFocus() {}, // 获得焦点事件
    onEditorChange() {}, // 内容改变事件
    saveHtml: function(event) {
      if(this.$route.query.type == 1) {
        localStorage.setItem("courseContent", this.content);
        localStorage.setItem("flag", true);
        this.$router.go(-1);
      }else if(this.$route.query.type == 2) {
        localStorage.setItem("imgtext", this.content);
        this.$router.go(-1);
      } else if(this.$route.query.type == 3){
        this.$router.go(-1);
      }
      if(this.actype == 3) {
        this.$emit('accontent',this.content)
      }
    },
    uploadImg() {
      let quill = this.$refs.myQuillEditor.quill
      let length 
      // this.content ==  '' ? length = 0 :length = quill.getSelection().index;
      quill.getSelection() == null ? length = 0:length = quill.getSelection().index;
      // let length = quill.getSelection().index;    // 获取光标所在位置
      this.$store.ready(state => {
        this.$uploadImages({
          wxid: state.info.wxid,
          uploaded: res => {
            this.imgurl = res.defaultpic;
            // this.content += `<img src='${res.defaultpic}' />`
            quill.insertEmbed(length, 'image',res.defaultpic);   // 插入图片  res.url为服务器返回的图片地址  
            quill.setSelection(length + 1);              // 调整光标到最后
          }
        });
      });
    }
  },
  created() {
      if(this.actype == 3) {
        this.content = this.accontent
      }
      switch (this.$route.query.type) {
        case '1':
          this.content = localStorage.getItem('courseContent')
          break;
        case '2':
          this.content = localStorage.getItem('imgtext')
        default:
          break;
      }
  },
  watch: {
    accontent() {
      this.content = this.accontent
    },
    $route:{
      handler(val,old) {
        if(old.name == "newCourse") {
          this.content = localStorage.getItem('courseContent')
        }
        if(old.name == 'addCourse' || old.name == "manageCourse"){
          this.content = localStorage.getItem('imgtext')
        }
      }
    }
  },
};
</script>

<style scoped>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.newcourse {
  background-color: #fff;
  position: fixed;
  bottom: 0;
  text-align: center;
  width: 100%;
}
.edit_container {
  min-height: 100vh;
  background-color: #fff;
}
.quill-editor /deep/ .ql-container {
  border: none !important;
}
.quill-editor /deep/ .ql-toolbar {
  border: none !important;
  border-bottom: 1px solid #f2f2f2 !important;
}
</style>

<style>
.ql-toolbar{
  position: fixed;
  width: 100%;
  background-color: #fff;
  z-index:99;
}
.ql-formats {
  margin-right: 0 !important;
}
.ql-formats button {
  height: 37px !important;
  margin-right: 15px;
}
.ql-color {
  width: 38px !important;
  height: 33px !important;
}
.uploadImg{
  position: fixed;
  z-index:100;
  left: 230px;
  top:15px;
  line-height: 30px;
}
.uploadImg img {
  width: 22px;
  height: 22px;
}
.edit_container{
  position: relative;
  overflow-y:scroll;
}
.ql-editor{
  padding-bottom:70px !important;
  padding-top:60px !important;
  font-size:16px;
}
</style>
