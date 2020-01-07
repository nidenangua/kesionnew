<template>
  <div>
    <div class="whiteboard" :style="{height:height-50+'px'}" ref="whiteboard">
      <div class="whiteboard-loading" v-show="loading"></div>
      <div v-for="(item,i) in canvasList" :key="i">
        {{item.file_path}}
        <div
          v-if="item.fileType === 'blank' || item.fileType === 'img'"
          class="whiteboard-img"
          v-show="selected == item.id && item.width && item.height"
          :style="{top:item.top+'px',left:item.left+'px'}"
        >
        
          <div
            class="whiteboard-canvas"
            :style="{top:item.canvas.y+'px',left:item.canvas.x+'px',transform:'scale('+item.scale+')',cursor:cursor,width:item.canvas.width+'px',height:item.canvas.height+'px'}"
          >
          
            <canvas
              @mousedown="canvasMousedown($event)"
              @mousemove="canvasMousemove($event)"
              :id="'canvas'+item.id"
              :height="item.canvas.height"
              :width="item.canvas.width"
            ></canvas>
            
            <img
              :src="item.src"
              :width="item.width"
              :height="item.height"
              @load="canvasImgLoaded(item)"
              @error="canvasImgError(item)"
              :ref="`canvas_img${item.id}`"
              :style="{position:'relative',left:(item.canvas.width - item.width)/2+'px',top:(item.canvas.height-item.height)/2+'px'}"
            >
          </div>
        </div>

        <div
          v-else-if="item.fileType === 'word' || item.fileType === 'pdf'"
          v-show="selected == item.id"
        >
          <!--img存在width与height说明已加载完成-->
          <div
            class="whiteboard-img"
            v-show="img.width && img.height && item.current == index+1"
            v-for="(img,index) in item.list"
            :key="'img'+index"
            :style="{top:img.top+'px',left:img.left+'px'}"
          >
            <div
              class="whiteboard-canvas"
              :style="{top:img.canvas.y+'px',left:img.canvas.x+'px',transform:'scale('+img.scale+')',cursor:cursor,width:img.canvas.width+'px',height:img.canvas.height+'px'}"
              v-if="img.flag"
            >
              <canvas
                @mousedown="canvasMousedown($event)"
                @mousemove="canvasMousemove($event)"
                :id="'canvas'+img.id"
                :height="img.canvas.height"
                :width="img.canvas.width"
              ></canvas>
              <img
                :src="img.src"
                :width="img.width"
                :height="img.height"
                :style="{position:'relative',left:(img.canvas.width - img.width)/2+'px',top:(img.canvas.height-img.height)/2+'px'}"
                :ref="`canvas_img${img.id}`"
                @load="canvasImgLoaded(img)"
                @error="canvasImgError(img)"
              >
            </div>
          </div>
        </div>
      </div>
      <whiteboard-tool
        v-if="toolAuthority"
        :tool="tool"
        :pen.sync="pen"
        :color.sync="color"
        class="main-whiteboard-tool"
        @change="handleToolChange"
      />
    </div>

    <div class="canvas-state">
      <div class="tool-wrap" :class="isTeacher && 'teacher-tool-wrap'">
        <span class="icon-bt" @click="slideCanvas('prev')">
          <i class="iconfont icon-left"></i>
        </span>
        <span>{{state.current}}/{{state.max}}</span>
        <span class="icon-bt" @click="slideCanvas('next')">
          <i class="iconfont icon-right"></i>
        </span>
        <span
          title="抓手"
          class="icon-bt"
          :class="tool === 'grab' && 'on' "
          @click="handleToolChange('grab')"
          v-if="isTeacher"
        >
          <i class="iconfont icon-zhuashou"></i>
        </span>
        <span title="放大" class="icon-bt" @click="zoom(true)" v-if="isTeacher">
          <i class="iconfont icon-fangda"></i>
        </span>
        <span title="缩小" class="icon-bt" @click="zoom(false)" v-if="isTeacher">
          <i class="iconfont icon-suoxiao"></i>
        </span>
        <span title="复位" class="icon-bt" @click="canvasRestoration" v-if="isTeacher">
          <i class="iconfont icon-fuwei"></i>
        </span>
        <span title="全屏" class="icon-bt icon-full-bt" @click="fullScreen()">
          <i class="iconfont icon-fullscreen-exit" v-if="isFullScreen"></i>
          <i class="iconfont icon-full_screen" v-else></i>
        </span>
      </div>
    </div>
  </div>
</template>
<script>
import WhiteboardTool from "./WhiteboardTool";
import { cloneData } from "@/utils";
import { courseware } from "@/api/live";
export default {
  name: "Whiteboard",
  props: {
    /**白板高度 */
    height: Number,
    /**当前选中的画布 */
    selected: {
      type: Number,
      default: 0
    },
    /**是否是老师 */
    isTeacher: {
      type: Boolean,
      default: false
    },
    /**画布列表 */
    canvasList: {
      type: Array,
      default() {
        return [];
      }
    },
    /**工具权限 */
    toolAuthority: {
      type: Boolean,
      default: false
    },
    /**是否全屏 */
    isFullScreen: {
      type: Boolean,
      default: false
    }
  },
  components: {
    WhiteboardTool
  },
  data() {
    return {
      loading: false,
      /**
       * 当前画布的context, 通过context进行绘图
       */
      ctx: {},
      /**
       * 当前画布的详细信息
       */
      canvas: {},
      /**
       * 当前画布的缩放比例
       */
      scale: 1,
      /**
       * 记录当前画布触发时的坐标
       */
      startX: 0,
      startY: 0,
      /**
       * 当前画布的进度
       */
      state: {
        current: 1,
        max: 1
      },
      /**
       * 绘图开关
       * 鼠标按住画布后会将此开关打开，此时鼠标移动将会进行绘图，鼠标松开后则关闭开关，绘图结束。
       */
      drawFlag: false,
      /**
       * 记录每张画布的绘图记录
       */
      drawingRecord: {},
      /**
       * 记录每一笔的坐标
       */
      coordinate: [],
      //白板光标图片
      cursor: null,
      tool: null,
      /**当前画笔颜色 */
      color: "ff0000",
      /**当前画笔粗细 */
      pen: 4
    };
  },
  mounted() {
    document.addEventListener("mouseup", e => {
      this.canvasMouseup();
    });

    /**捕捉键盘事件 */
    document.addEventListener("keydown", e => {
      if (e.keyCode === 122) {
        /**捕捉F11键盘动作，阻止F11默认动作 */
        e.preventDefault();
      }
    });

    var zoom = e => {
      var e = e || window.event;
      if (e.wheelDelta && event.ctrlKey) {
        event.returnValue = false;
      } else if (e.detail) {
        event.returnValue = false;
      }
    };
    if (document.addEventListener) {
      document.addEventListener("DOMMouseScroll", zoom, false);
    }
    window.onmousewheel = document.onmousewheel = zoom;

    /**
     * 监听不同浏览器的全屏事件，并件执行相应的代码
     */
    document.addEventListener(
      "webkitfullscreenchange",
      () => {
        if (document.webkitIsFullScreen) {
          //全屏后要执行的代码
          this.$emit("update:isFullScreen", true);
        } else {
          this.$emit("update:isFullScreen", false);
        }
      },
      false
    );
    document.addEventListener(
      "fullscreenchange",
      () => {
        if (document.fullscreen) {
          //全屏后执行的代码
          this.$emit("update:isFullScreen", true);
        } else {
          //退出全屏后要执行的代码
          this.$emit("update:isFullScreen", false);
        }
      },
      false
    );
    document.addEventListener(
      "mozfullscreenchange",
      () => {
        if (document.mozFullScreen) {
          //全屏后要执行的代码
          this.$emit("update:isFullScreen", true);
        } else {
          //退出全屏后要执行的代码
          this.$emit("update:isFullScreen", false);
        }
      },
      false
    );
    document.addEventListener(
      "msfullscreenchange",
      () => {
        if (document.msFullscreenElement) {
          //全屏后要执行的代码
          this.$emit("update:isFullScreen", true);
        } else {
          //退出全屏后要执行的代码
          this.$emit("update:isFullScreen", false);
        }
      },
      false
    );
  },
  methods: {
    setPageArea() {},
    /**
     * 获取body dom
     */
    getBody() {
      return document.body || document.getElementsByTagName("body")[0];
    },
    /**
     * 画布触发
     */
    canvasMousedown(e) {
      this.getBody().setAttribute("onselectstart", "return false");
      let errY = this.errY;
      let selectedCanvas = this.getSelectedCanvas();
      this.ctx = selectedCanvas.ctx;
      this.canvas = selectedCanvas.canvas;
      this.startX = e.offsetX;
      this.startY = e.offsetY;
      switch (this.tool) {
        case "grab":
          this.drawFlag = true;
          break;
        case "pen":
          this.prevX = e.offsetX;
          this.prevY = e.offsetY + errY;
          this.drawFlag = true;
          break;
        case "eraser":
          this.drawFlag = true;
          break;
      }
    },
    /**
     * 开始绘图
     */
    canvasMousemove(e) {
      var ctx = this.ctx;
      if (this.drawFlag) {
        switch (this.tool) {
          case "grab":
            this.canvas.x += e.offsetX - this.startX;
            this.canvas.y += e.offsetY - this.startY;
            break;
          case "pen":
            ctx.beginPath();
            ctx.strokeStyle = `#${this.color}`;
            ctx.lineWidth = this.pen / 2;
            ctx.moveTo(this.startX, this.startY);
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
            this.coordinate.push([
              this.startX,
              this.startY,
              e.offsetX,
              e.offsetY
            ]);
            this.startX = e.offsetX;
            this.startY = e.offsetY;
            break;
          case "eraser":
            ctx.clearRect(e.offsetX, e.offsetY, 30, 30);
            this.coordinate.push([e.offsetX, e.offsetY, 30, 30]);
            break;
        }
      }
    },

    /**
     * 鼠标松开
     */
    canvasMouseup() {
      this.getBody().setAttribute("onselectstart", "return true");
      let tool = this.tool,
        coordinate = this.coordinate;
      switch (tool) {
        case "grab":
          this.drawFlag = false;
          this.setWhiteboardChange("grab", {
            left: this.canvas.x,
            top: this.canvas.y
          });
          break;
        case "pen":
        case "eraser":
          if (this.drawFlag) {
            /**
             * 由于消息大小限制，分次发送
             */
            if (coordinate.length > 550) {
              var n = Math.ceil(coordinate.length / 550);
              for (var i = 0; i < n; i++) {
                var maxN = (i + 1) * 550;
                var arr = new Array();
                for (var s = i * 550; s < maxN; s++) {
                  if (coordinate[s]) {
                    arr.push(coordinate[s]);
                  } else {
                    break;
                  }
                }
                this.sortOutWhiteboardMsg(tool, arr);
              }
            } else {
              this.sortOutWhiteboardMsg(tool, coordinate);
            }
            this.coordinate = new Array();
            this.drawFlag = false;
          }
          break;
      }
    },
   
    /**
     * 操作画布，放大或缩小
     */
    zoom(flag) {
      if (this.isTeacher) {
        let selectedCanvas = this.getSelectedCanvas(),
          canvasItem = selectedCanvas.canvasItem,
          scale = selectedCanvas.scale;
        let newScale = flag
          ? Math.min(scale + 0.2, 3)
          : Math.max(scale - 0.2, 1);
        this.$layer.msg(`${(100 * newScale).toFixed(0)}%`);
        if (`${scale}` !== `${newScale}`) {
          canvasItem.scale = newScale;
          this.setWhiteboardChange("zoom", {
            scale: newScale
          });
        }
      }
    },
    /**
     * 清除所有画布
     */
    clearAllCanvas() {
      this.canvasList.map(item => {
        if (
          typeof item.list === "object" &&
          typeof item.current !== "undefined"
        ) {
          item.list.map(obj => {
            if (obj.flag && obj.width && obj.height) {
              let ctx = window[`canvas${obj.id}`].getContext("2d");
              ctx.clearRect(0, 0, obj.canvas.width, obj.canvas.height);
            }
          });
        } else {
          let ctx = document.getElementById(`canvas${item.id}`).getContext("2d");
          ctx.clearRect(0, 0, item.canvas.width, item.canvas.height);
        }
      });
    },
    /**
     * 整理画布消息
     * @param {String}
     * @param {Array}
     */
    sortOutWhiteboardMsg(type, arr) {
      var obj = {
        coordinate: arr
      };
      switch (type) {
        case "pen":
          obj.lineWidth = this.pen / 2;
          obj.color = this.color;
          break;
      }
      this.setWhiteboardChange(type, obj);
    },
    /**
     * 获取当前画布信息
     * @param {Number} 画布id（选传，默认是当前画布id）
     */
    getSelectedCanvas(id) {
      let selectedCanvasId = typeof id !== "undefined" ? id : this.selected,
        canvasItem = {},
        canvas = {},
        canvasId,
        current,
        ctx,
        scale;

      this.canvasList.map(item => {
        if (`${item.id}` === `${selectedCanvasId}`) {
          if (
            typeof item.list === "object" &&
            typeof item.current !== "undefined"
          ) {
            current = item.current;
            canvasId = `${item.id}_${current}`;
            item.list.map(obj => {
              if (`${obj.id}` === `${canvasId}`) {
                canvas = obj.canvas;
                canvasItem = obj;
                scale = obj.scale;
              }
            });
          } else {
            canvasId = item.id;
            canvasItem = item;
            current = 1;
            canvas = item.canvas;
            scale = item.scale;
          }
        }
      });

      if (document.getElementById(`canvas${canvasId}`)) {
        ctx = document.getElementById(`canvas${canvasId}`).getContext("2d");
      }

      let offset = this.getOffset(canvas);
      return {
        selectedId: selectedCanvasId,
        ctx: ctx,
        canvas: canvas,
        canvasId: canvasId,
        canvasItem: canvasItem,
        scale: scale,
        current: current,
        offsetTop: offset.top,
        offsetLeft: offset.left
      };
    },

    /**
     * 获取dom坐标信息
     */
    getOffset(el) {
      let offsetTop = el.offsetTop;
      let offsetLeft = el.offsetLeft;
      if (el.parentNode) {
        get(el.parentNode);
      }
      function get(el) {
        if (el.offsetTop) {
          offsetTop += el.offsetTop;
          offsetLeft += el.offsetLeft;
        }
        if (el.parentNode) {
          get(el.parentNode);
        }
      }
      return {
        left: offsetLeft,
        top: offsetTop
      };
    },
    /**
     * 操作画布
     * @param {Object}
     */
    drawCanvas(msg) {
      this.canvasList.map((canvas, i) => {
        if (
          `${canvas.id}` === `${msg.selectedId}` &&
          canvas.current !== undefined
        ) {
          canvas.current = msg.current;
        }
      });
      let selectedCanvas = this.getSelectedCanvas(msg.selectedId),
        ctx = selectedCanvas.ctx,
        width = selectedCanvas.canvas.width,
        height = selectedCanvas.canvas.height,
        canvasItem = selectedCanvas.canvasItem,
        ratio = width / msg.width,
        canvasId = selectedCanvas.canvasId;

      switch (msg.type) {
        case "pen":
          msg.coordinate.map(obj => {
            ctx.beginPath();
            ctx.lineWidth = msg.lineWidth * ratio;
            ctx.strokeStyle = "#" + msg.color;
            ctx.moveTo(obj[0] * ratio, obj[1] * ratio);
            ctx.lineTo(obj[2] * ratio, obj[3] * ratio);
            ctx.stroke();
          });
          this.addDrawingRecord(canvasId, msg);
          break;
        case "eraser":
          msg.coordinate.map(obj => {
            ctx.clearRect(
              obj[0] * ratio,
              obj[1] * ratio,
              obj[2] * ratio,
              obj[3] * ratio
            );
          });
          if (msg.isEmpty) {
            this.addDrawingRecord(canvasId, "clear");
          } else {
            this.addDrawingRecord(canvasId, msg);
          }
          break;
        case "clearRect":
          ctx.clearRect(0, 0, width, height);
          this.addDrawingRecord(canvasId, "clear");
          break;
        case "selectedCanvasId":
          this.addFile(msg);
          break;
        case "slideCanvas":
          this.canvasList.map(item => {
            if (item.id == msg.selectedId) {
              item.list.map((obj, i) => {
                if (i + 1 == msg.current) {
                  obj.flag = true;
                }
              });
              item.current = msg.current;
              this.whiteboard.state.current = msg.current;
            }
          });
          break;
        case "photoProblem":
          let confirmId = this.$layer.confirm(
            "接收到学生的问题图片，是否展示到白板上？",
            () => {
              let id = this.files.list.length;
              let file = {
                id: id,
                fileid: msg.fileid,
                fileType: "img",
                name: msg.filename,
                src: msg.src
              };
              this.files.list.push(file);
              this.addFile(file);
              this.$layer.close(confirmId);
            }
          );
          break;
        case "zoom":
          canvasItem.scale = msg.scale;
          break;
        case "grab":
          canvasItem.canvas.x = msg.left * ratio;
          canvasItem.canvas.y = msg.top * ratio;
          break;
      }
    },
    /**
     * 画布切换
     */
    slideCanvas(type) {
      if (!this.isTeacher) {
        return false;
      }
      let canvasItem = {};
      this.canvasList.map(item => {
        if (`${item.id}` === `${this.selected}`) {
          canvasItem = item;
        }
      });
      if (!canvasItem.current && !canvasItem.list) {
        return false;
      }
      let max = canvasItem.list.length;
      switch (type) {
        case "prev":
          canvasItem.current = Math.max(canvasItem.current - 1, 1);
          break;
        case "next":
          canvasItem.current = Math.min(canvasItem.current + 1, max);
          break;
      }
      canvasItem.list.map((item, i) => {
        if (canvasItem.current == i + 1) {
          if (!item.flag) {
            item.flag = true;
            this.loading = true;
          }
        }
      });
      this.state.current = canvasItem.current;
      this.setWhiteboardChange("slideCanvas");
    },

    /**
     * 添加在线文件，生成画布
     * @param {Object} 文件对象
     * 说明：支持图片、word、pdf
     */
    addFile(item) {
      this.$emit("update:selected", Number(item.id));
      let isRepeat = false;
      this.canvasList.map(canvas => {
        if (`${canvas.id}` === `${item.id}`) {
          isRepeat = true;
          /**
           * 设置当前选中画布信息，确保底图一致
           */
          if (
            typeof canvas.current !== "undefined" &&
            typeof item.current !== "undefined"
          ) {
            canvas.current = item.current;
          }
          this.state.current = canvas.current || 1;
          this.state.max = canvas.list ? canvas.list.length : 1;
        }
      });
      switch (item.fileType) {
        case "blank":
        case "img":
          if (!isRepeat) {
            this.loading = true;
            this.canvasList.push({
              id: item.id,
              fileid: item.fileid,
              fileType: item.fileType,
              src: item.src,
              width: null,
              height: null,
              canvas: {
                x: 0,
                y: 0,
                width: null,
                height: null
              },
              left: 0,
              top: 0,
              scale: 1
            });
          }
          this.setWhiteboardChange("selectedCanvasId", item);
          break;
        case "word":
        case "pdf":
          item.current = item.current || 1;
          if (!isRepeat) {
            this.loading = true;
            courseware({
              courseid:this.$route.query.id,
              fileid: item.fileid
            }).then(res => {
              let list = [];
              res.value.map((img, imgIndex) => {
                list.push({
                  id: `${item.id}_${imgIndex + 1}`,
                  flag: false,
                  src: img.urls,
                  width: null,
                  height: null,
                  canvas: {
                    x: 0,
                    y: 0,
                    width: null,
                    height: null
                  },
                  left: 0,
                  top: 0,
                  scale: 1
                });
              });

              /**默认加载第一张 */
              list[item.current - 1].flag = true;
              this.canvasList.push({
                id: item.id,
                fileid: item.fileid,
                fileType: item.fileType,
                current: item.current,
                list: list
              });
              this.state.current = item.current;
              this.state.max = list.length;
              this.setWhiteboardChange("selectedCanvasId", item);
            });
          } else {
            this.setWhiteboardChange("selectedCanvasId", item);
          }
          break;
      }
    },
    /**
     * 检测画布是否为空
     * @param {Object} 画布对象
     */
    isCanvasBlank(canvas) {
      var blank = document.createElement("canvas");
      blank.width = canvas.width;
      blank.height = canvas.height;
      return canvas.toDataURL() == blank.toDataURL();
    },
    /**
     * 图片白板加载完成
     * @param {Object} 图片白板对象
     */
    canvasImgLoaded(item) {
      let _width = this.$refs.whiteboard.offsetWidth;

      let img = this.$refs[`canvas_img${item.id}`][0];
      let area = this.getSuitableArea(
        {
          width: this.$refs.whiteboard.offsetWidth,
          height: this.height
        },
        {
          width: img.width,
          height: img.height
        },
        600
      );
      item.width = area.width;
      item.height = area.height;
      item.canvas.width = area.width * 2;
      item.canvas.height = area.height + area.width;
      item.left = (_width - area.width * 2) / 2;
      item.top = (this.height - area.width - area.height) / 2;
      this.loading = false;
      this.$emit("canvasLoaded", item.id);
    },
    /**
     * 图片白板加载失败
     */
    canvasImgError(item) {
      this.$layer.msg("图片加载出错");
      this.loading = false;
    },
    /**
     * 添加绘图记录
     */
    addDrawingRecord(key, data) {
      if (!this.drawingRecord[key] || data === "clear") {
        this.drawingRecord[key] = new Array();
      }
      if (data !== "clear") {
        this.drawingRecord[key].push(data);
      }
    },
    /**
     * 清除画布
     */
    clearCanvas() {
      let canvasInfo = this.getSelectedCanvas();
      canvasInfo.ctx.clearRect(
        0,
        0,
        canvasInfo.canvas.width,
        canvasInfo.canvas.height
      );
      this.setWhiteboardChange("clearRect");
    },
    /**
     *获取合适的大小
     *@param {Object} 容器宽高
     *@param {Object} 内容宽高
     */
    getSuitableArea(containerArea, contentArea, minWidth) {
      let scale = contentArea.width / contentArea.height,
        w,
        h,
        containerScale = containerArea.width / containerArea.height;

      if (scale > containerScale) {
        w = containerArea.width;
        h = contentArea.height * (containerArea.width / contentArea.width);
      } else {
        h = containerArea.height;
        w = contentArea.width * (containerArea.height / contentArea.height);
      }
      if (minWidth) {
        if (w < minWidth) {
          scale = w / minWidth;
          w = w / scale;
          h = h / scale;
        }
      }
      return {
        width: w,
        height: h
      };
    },
    /**
     * 得到画布基础消息
     */
    getWhiteboardBaseMsg(selectedCanvasInfo) {
      let msg = {
        action: "whiteboard",
        selectedId: selectedCanvasInfo.selectedId,
        width: selectedCanvasInfo.canvas.width,
        current: selectedCanvasInfo.current
      };
      return msg;
    },
    /**
     * 发送画布信息
     */
    setWhiteboardChange(type, data) {
      let selectedCanvasInfo = this.getSelectedCanvas();
      let msg = this.getWhiteboardBaseMsg(selectedCanvasInfo);
      msg.type = type;
      if (typeof data === "object") {
        let keys = Object.keys(data);
        keys.map(k => [(msg[k] = data[k])]);
      }
      switch (type) {
        case "pen":
        case "eraser":
          var canvasId = selectedCanvasInfo.canvasId,
            canvas = document.getElementById(`canvas${canvasId}`);

          /**
           * 检查画布是否为空，为空则清除存储记录
           */
          if (type === "eraser" && this.isCanvasBlank(canvas)) {
            msg["isEmpty"] = true;
            this.addDrawingRecord(canvasId, "clear");
          } else {
            msg["isEmpty"] = false;
            this.addDrawingRecord(canvasId, msg);
          }
          break;
        case "clearRect":
          var canvasId = selectedCanvasInfo.canvasId;
          this.addDrawingRecord(canvasId, "clear");
          break;
      }
      this.$emit("change", msg);
    },

    /**
     * 处理直播工具切换
     */
    handleToolChange(name) {
      if (name === "clear") {
        this.clearCanvas();
      } else {
        this.tool = name;
        switch (name) {
          case "pen":
            this.cursor = `url(${require("@/assets/video-live/pen.png")}), auto`;
            break;
          case "eraser":
            this.cursor = `url(${require("@/assets/video-live/eraser.png")}), auto`;
            break;
          case "grab":
            this.cursor = "-webkit-grab";
            break;
          default:
            this.cursor = `inherit`;
        }
      }
    },
    /**
     * 全屏
     */
    fullScreen() {
      if (this.isFullScreen) {
        this.exitFullScreen();
      } else {
        this.setFullScreen();
      }
    },
    /**
     * 浏览器全屏
     */
    setFullScreen() {
      var el = document.documentElement,
        rfs =
          el.requestFullScreen ||
          el.webkitRequestFullScreen ||
          el.mozRequestFullScreen ||
          el.msRequestFullScreen,
        wscript;
      if (typeof rfs != "undefined" && rfs) {
        rfs.call(el);
        return;
      }

      if (typeof window.ActiveXObject != "undefined") {
        wscript = new ActiveXObject("WScript.Shell");
        if (wscript) {
          wscript.SendKeys("{F11}");
        }
      }
    },
    /**
     * 画布复位
     */
    canvasRestoration() {
      if (this.isTeacher) {
        let canvasItem = this.getSelectedCanvas().canvasItem;
        canvasItem.scale = 1;
        canvasItem.canvas.x = 0;
        canvasItem.canvas.y = 0;
        this.setWhiteboardChange("zoom", {
          scale: 1
        });
        this.setWhiteboardChange("grab", {
          left: 0,
          top: 0
        });
      }
    },
    /**
     * 浏览器退出全屏
     */
    exitFullScreen() {
      var el = document,
        cfs =
          el.cancelFullScreen ||
          el.webkitCancelFullScreen ||
          el.mozCancelFullScreen ||
          el.exitFullScreen,
        wscript;

      if (typeof cfs != "undefined" && cfs) {
        cfs.call(el);
        return;
      }

      if (typeof window.ActiveXObject != "undefined") {
        wscript = new ActiveXObject("WScript.Shell");
        if (wscript != null) {
          wscript.SendKeys("{F11}");
        }
      }
    }
  }
};
</script>
<style scoped>
.whiteboard {
  position: relative;
  overflow: hidden;
  background: #eceff5;
}
.whiteboard--full {
  width: 100%;
  height: 100% !important;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 1000;
}
.whiteboard-loading {
  width: 100px;
  height: 100px;
  background: #fff url(../../assets/video-live/loading.gif) no-repeat 50% 50%;
  background-size: 50px 50px;
  position: absolute;
  left: 50%;
  top: 50%;
  margin-left: -50px;
  margin-top: -50px;
  z-index: 99;
  border-radius: 10px;
}

/*画布*/
.whiteboard-img {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
}
.whiteboard-canvas {
  position: relative;
  background: #fff;
}
.whiteboard-img canvas {
  position: absolute;
  left: 0;
  top: 0;
  z-index: 1;
}

.canvas-state {
  height: 50px;
  overflow: hidden;
  font-size: 14px;
  text-align: center;
  line-height: 50px;
  position: relative;
}
.canvas-state .button {
  position: absolute;
  height: 36px;
  line-height: 36px;
  background: #e6412d;
  color: #fff;
  width: 110px;
  text-align: center;
  right: 15px;
  border-radius: 3px;
  top: 50%;
  margin-top: -18px;
  font-size: 14px;
  cursor: pointer;
}
.canvas-state .button_on,
.canvas-state .button:hover {
  background: #e1341f;
}
.canvas-state .tool-wrap {
  display: inline-block;
}
.canvas-state .teacher-tool-wrap .icon-bt,
.canvas-state .icon-full-bt {
  cursor: pointer;
}

.canvas-state span {
  float: left;
}
.canvas-state span i {
  font-size: 18px;
}
.canvas-state .icon-full_screen {
  font-size: 22px;
}
.canvas-state .icon-bt {
  width: 36px;
  height: 36px;
  line-height: 36px;
  border-radius: 4px;
  margin: 7px 5px 0 5px;
}
.canvas-state .teacher-tool-wrap .icon-bt:hover,
.canvas-state .icon-full-bt:hover,
.canvas-state .icon-bt.on {
  background: rgba(0, 0, 0, 0.1);
}
.canvas-state-black {
  background: #212429;
  color: #fff;
}
</style>
