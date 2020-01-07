<template>
  <div class="whiteboard-files" ref="whiteboardFiles">
    <div class="whiteboard-files__title">{{title}}</div>
    <div class="whiteboard-files__body" :style="{height:$refs.whiteboardFiles && $refs.whiteboardFiles.offsetHeight - 110 + 'px'}">
      <ul>
        <li
          :class="item.id == selected ? 'on file--' + item.fileType : 'file--'+item.fileType"
          v-for="(item,i) in fileList"
          :key="i"
          @click="selectFile(item)"
        >
          <div class="opr" v-if=" i > 0">
            <i
              @click.stop="deleteLiveFile(item)"
              class="iconfont icon-shanchu_o"
              :class="item.id == selected && 'icon-shanchu--disabled'"
            ></i>
          </div>
          {{item.name}}
        </li>
      </ul>
    </div>
    <div class="foot">
      <div class="ks-button ks-button--primary" @click="addCosFile">添加材料</div>
      <div class="ks-button ks-button--primary" @click="addWhiteboardFile(null)">添加白板</div>
    </div>
  </div>
</template>
<script>
import AddFile from "./AddFile";
import SelectWhiteboard from "./SelectWhiteboard";
import { getMaterialsList, delMaterials } from "@/api/microportal";
export default {
  name: "WhiteboardFiles",
  props: {
    /**窗口标题 */
    title: String,
    /**当前选中的 */
    selected: {
      type: Number,
      default: 0
    }
  },
  data() {
    return {
      /**文件列表 */
      fileList: [
        {
          id: 0,
          fileType: "blank",
          name: "主白板",
          src: require("@/assets/video-live/bg1.jpg")
        }
      ]
    };
  },
  mounted() {
    /**
     * 获取图文材料数据
     */
    getMaterialsList({
      type: "image_text",
      courseid: this.$route.query.id
    }).then(res => {
      res.list.map((item, i) => {
        item.fileid = item.id;
        item.id = this.fileList.length + i;
        item.src = item.file_path;
        item.name = item.title;
        item.fileType = this.getSuffix(item.file_path);
      });
      this.fileList = this.fileList.concat(res.list);
    });
  },
  methods: {
    /**
     * 添加课程材料
     */
    addCosFile() {
      this.$layer.iframe({
        content: {
          content: AddFile,
          parent: this,
          data: {}
        },
        area: ["600px", "360px"],
        title: "添加材料"
      });
    },
    /**
     * 获取后缀
     * @param {String} 文件路径
     */
    getSuffix(path) {
      let fileType = "unknown";
      if (path) {
        let suffixs = path.match(/\.\w+/g);
        let suffix = suffixs[suffixs.length - 1];
        let imgReg = /^(\.jpg|\.jpeg|\.bmp|\.gif|\.png)$/i;
        if (imgReg.test(suffix)) {
          fileType = "img";
        } else if (suffix === ".pdf") {
          fileType = "pdf";
        } else if (suffix === ".doc" || suffix === ".docx") {
          fileType = "word";
        }
      }
      return fileType;
    },
    /**
     * 选择文件
     */
    selectFile(item) {
      this.$emit("item-click", item);
    },
    /**
     * 添加白板文件
     */
    addWhiteboardFile(bg, name) {
      if (bg && name) {
        let item = {
          id: this.fileList.length,
          fileType: "blank",
          src: bg,
          name: name
        };
        this.fileList.push(item);
      } else {
        this.$layer.iframe({
          content: {
            content: SelectWhiteboard, //传递的组件对象
            parent: this, //当前的vue对象
            data: {} //props
          },
          area: ["800px", "500px"],
          title: "选择白板主题"
        });
      }
    },
    /**
     * 删除材料文件
     */
    deleteLiveFile(item) {
      if (`${item.id}` === `${this.selected}`) {
        return false;
      }
      if (item.fileType === "blank") {
        let confirmId = this.$layer.confirm("您确定要删除该白板吗？", () => {
          this.$layer.close(confirmId);
          this.fileList.map((obj, i) => {
            if (`${obj.id}` === `${item.id}`) {
              //从数组中移除对应文件
              this.fileList.splice(i, 1);
            }
          });
        });
      } else {
        let confirmId = this.$layer.confirm("您确定要删除该文件吗？", () => {
          delMaterials({
            id: item.fileid
          }).then(res => {
            if (res.result === "success") {
              this.$layer.close(confirmId);
              this.fileList.map((obj, i) => {
                if (`${obj.id}` === `${item.id}`) {
                  //从数组中移除对应文件
                  this.fileList.splice(i, 1);
                }
              });
            } else {
              this.$layer.alert(res.msg);
            }
          });
        });
      }
    }
  }
};
</script>
<style scoped>
.whiteboard-files {
  width: 300px;
  background: #2b3038;
  
}
.whiteboard-files__body{
  overflow-y: auto;
}
.whiteboard-files__body::-webkit-scrollbar-thumb {
  border-radius: 10px;
  background: rgba(255,255,255,0.2);
}
.whiteboard-files__title {
  height: 40px;
  line-height: 40px;
  border-bottom: 1px solid #2d3037;
  color: #e1e3e4;
  padding: 0 15px;
  font-size: 14px;
}
.whiteboard-files li {
  height: 50px;
  line-height: 50px;
  padding: 0 10px 0 50px;
  color: #e4e7e7;
  overflow: hidden;
  background-repeat: no-repeat;
  background-position: 15px 50%;
  cursor: pointer;
}
.whiteboard-files li .opr {
  float: right;
}
.whiteboard-files li .opr i {
  cursor: pointer;
  display: block;
  width: 30px;
  float: left;
  text-align: center;
}
.whiteboard-files li .opr .icon-shanchu--disabled,
.whiteboard-files li .opr .icon-shanchu--disabled:hover {
  cursor: no-drop;
  opacity: 0.4;
  color: #fff;
}
.whiteboard-files li .opr i:hover {
  color: #e6412d;
}
.whiteboard-files li.file--blank {
  background-image: url(../../assets/video-live/blank.png);
}
.whiteboard-files li.file--img {
  background-image: url(../../assets/video-live/img.png);
}
.whiteboard-files li.file--word {
  background-image: url(../../assets/video-live/word.png);
}
.whiteboard-files li.file--pdf {
  background-image: url(../../assets/video-live/pdf.png);
}
.whiteboard-files li.file--video {
  background-image: url(../../assets/video-live/media.png);
}

.whiteboard-files li:hover,
.whiteboard-files li.on {
  background-color: #14191d;
}
.whiteboard-files li .icon-yanjing {
  font-size: 18px;
  color: #5f6871;
}
.whiteboard-files li.on .icon-yanjing,
.whiteboard-files li.on .icon-yanjing:hover {
  color: #e4e7e7;
}
.whiteboard-files li.on .icon-shanchu:hover,
.whiteboard-files li.on .icon-shanchu {
  color: #5f6871;
  cursor: no-drop;
}

.whiteboard-files .foot {
  position: absolute;
  bottom: 15px;
  left: 0;
  width: 100%;
  text-align: center;
}
</style>
