<template>
  <div class="drag-frame">
    <ks-loading type="partial" v-show="loading" />
    <div class="wmh-header">
      <div class="ks-fl logo">
        <img src="../../assets/logo.png" />
      </div>
      <router-link to="/" class="wmh-header-home ks-fz14 ks-ml20">
        <i class="el-icon-s-home"></i>后台主页
      </router-link>
      <div class="ks-fr">
        <div
          class="ks-bt ks-bt-pue ks-bt-medium"
          @click="save()"
          :class="saveText != '保存' && 'ks-bt-disabled'"
        >{{saveText}}</div>
        <div
          class="ks-bt ks-bt-pue ks-bt-medium"
          @click="release()"
          :class="releaseText != '发布' && 'ks-bt-disabled'"
        >{{releaseText}}</div>
        <div
          class="ks-bt ks-bt-pue ks-bt-medium bt-reset"
          :class="resetFlag && 'on'"
          @click.stop="resetFlag = resetFlag ? false : true"
        >恢复至</div>
        <div
          class="ks-bt ks-bt-pur ks-bt-medium"
          @click="templistFlag = true"
          v-if="$route.name === 'Drag' || $route.name === 'DragPC'"
        >切换风格</div>
      </div>
      <div class="reset-list" v-show="resetFlag">
        <ul>
          <li
            v-for="(item,index) in resetList"
            :class="index == 0 && 'on'"
            :key="index"
            @click="resViewConfig(item.id)"
          >
            <span>{{item.adddate}}</span>店铺首页
          </li>
          <li @click="resViewDefaultConfig()">
            <span class="init">初始化</span>店铺首页
          </li>
        </ul>
      </div>
    </div>

    <el-dialog title="切换门户风格" :visible.sync="templistFlag" width="1300px">
      <div class="wmh-style clearfix">
        <ul>
          <li v-for="(item,index) in templist.values" :key="'item'+index">
            <div class="m-phone">
              <img src="@/assets/drag/phone.png" class="phone" v-if="$route.name !== 'DragPC'"/>
              <div :class="['style-img',$route.name == 'DragPC' ? 'style-image' : '']">
                <img :src="item.defaultpic" />
                <div :class="['selected',$route.name == 'DragPC' ? 'selectedpc': '']" v-if="item.tempid == templist.mydiyid"></div>
                <div class="isedit" v-if="item.isedit == 1">已编辑</div>
              </div>
            </div>
            <div class="tempname" align="center">{{item.tempname}}</div>

            <el-button type="primary" v-if="item.tempid == templist.mydiyid" disabled>正在使用</el-button>
            <el-button type="primary" @click="slideStyle(item.tempid)" v-else>切换风格</el-button>
          </li>
        </ul>
      </div>
    </el-dialog>

    <!--手机模块管理菜单-->
    <div class="wmh-fn" v-show="$route.name=== 'Drag' || $route.name === 'DragApplet'">
      <div class="title">模块管理</div>
      <div class="wmh-module">
        <div class="item" v-for="(item,index) in module" :key="'item'+index">
          <div
            class="name"
            :class="item.flag === true && 'on'"
            @click="item.flag = item.flag === true ? false : true"
          >{{item.name}}</div>
          <div class="inner" v-show="item.flag">
            <ul>
              <li v-for="(sub,i) in item.list" :key="'sub'+i" @click="selectModule(sub)">
                <img :src="getModuleImg(sub.type,sub.style)" />
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!--pc模块管理菜单-->
    <div
      class="wmh-module__icon"
      @click="showPcModule ? showPcModule=false : showPcModule=true"
      v-if="$route.name === 'DragPC'"
    >
      <img src="../../assets/dragpc/pcd_btn_model@2x.png" />
    </div>
    <transition name="fade-left">
      <div class="wmhpc-fn" v-if="$route.name=== 'DragPC' && showPcModule">
        <div class="title">模块管理</div>
        <div class="wmh-module">
          <div class="item" v-for="(item,index) in modulepc" :key="'item'+index">
            <div
              class="name"
              :class="item.flag === true && 'on'"
              @click="item.flag = item.flag === true ? false : true"
            >{{item.name}}</div>
            <div class="inner" v-show="item.flag">
              <ul>
                <li v-for="(sub,i) in item.list" :key="'sub'+i" @click="selectModule(sub)">
                  <img :src="getModulePCImg(sub.type,sub.style)" />
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </transition>

    <!--手机预览-->
    <div class="wmh-content" v-if="$route.name === 'Drag'">
      <div class="mphone">
        <ks-loading v-show="frameLoading" />
        <iframe name="mphone" class="mphone" src="/Application/View/index/h5market/dist/m/index.html?drag=on" @load="frameLoaded"></iframe>
      </div>
    </div>
    <!--小程序预览-->
    <div class="wmh-content" v-else-if="$route.name === 'DragApplet'">
      <div class="mphone">
        <ks-loading v-show="frameLoading" />
        <iframe name="mphone" class="mphone" src="/Application/View/index/h5market/dist/m/index.html?drag=on&temptype=3" @load="frameLoaded"></iframe>
      </div>
    </div>
    <!-- pc预览 -->
    <div class v-else>
      <iframe
        name="mphone"
        frameborder="0"
        style="width:100%;z-index: 1999;overflow: hidden;min-height: 100vh;"
        src="/Application/View/index/h5market/dist/pc/index.html?f=pc&drag=on"
        @load="frameLoaded"
      ></iframe>
    </div>

    <!--PC模块配置-->

    <transition name="fade-left">
      <div class="wmhpc-management" v-if="$route.name=== 'DragPC' && management">
        <div class="title">
          配置模块
          <img src="../../assets/common/close.png" @click="management = false" />
        </div>
        <div class="cont">
          <!--标题配置-->
          <title-management v-if="moduleManagement.title" :management-data="moduleManagement" />
          <!--导航配置-->
          <nav-management
            v-if="moduleManagement.type === 'header'"
            :other="moduleManagement.other"
            :list.sync="moduleManagement.navList"
          />
          <!--轮播图配置-->
          <swiper-management
            v-else-if="moduleManagement.type === 'swiper'"
            :list="moduleManagement.list"
          />

          <!--banner-->
          <banner-management
            v-else-if="moduleManagement.type === 'banner'"
            :management-data="moduleManagement"
          />

          <!--课程、专栏、新闻配置-->
          <label-management
            v-else-if="moduleManagement.type === 'course' || moduleManagement.type === 'column' || moduleManagement.type === 'news'"
            :management-data="moduleManagement"
          />
          <richtext-management
            v-else-if="moduleManagement.type === 'richtext'"
            :management-data="moduleManagement"
          />
          <div class="no-management" v-else-if="!moduleManagement.type">
            暂无可配置内容！
            请先选择功能模块~
          </div>
        </div>
      </div>
    </transition>

    <!--手机模块配置-->
    <div class="wmh-management" v-if="$route.name=== 'Drag' || $route.name === 'DragApplet'">
      <div class="title">配置模块</div>
      <div class="cont">
        <!--标题配置-->
        <title-management v-if="moduleManagement.title" :management-data="moduleManagement" />
        <!--导航配置-->

        <nav-management v-if="moduleManagement.type === 'nav'" :list.sync="moduleManagement.list" />

        <!--轮播图配置-->
        <swiper-management
          v-else-if="moduleManagement.type === 'swiper'"
          :list="moduleManagement.list"
        />

        <!--banner-->
        <banner-management
          v-else-if="moduleManagement.type === 'banner'"
          :management-data="moduleManagement"
        />

        <!--课程、班级、专栏、新闻配置-->
        <label-management
          v-else-if="moduleManagement.type === 'course' || moduleManagement.type === 'mall' || moduleManagement.type === 'class' || moduleManagement.type === 'column' || moduleManagement.type === 'news'"
          :management-data="moduleManagement"
        />
        <richtext-management
          v-else-if="moduleManagement.type === 'richtext'"
          :management-data="moduleManagement"
        />

        <div class="no-management" v-else-if="!moduleManagement.type">
          暂无可配置内容！
          请先选择功能模块~
        </div>
      </div>
    </div>
  </div>
</template>
<script>
require("../../assets/drag/drag.css");
import {
  getPathList,
  getTemplist,
  saveStoreViewConfig,
  publishStoreViewConfig,
  resDefault,
  resPath,
  saveChangeTemp
} from "@/api/drag";
import { getStoreData } from "@/api/store";
import { domap, cloneData, deleteArray } from "@/utils";
import moduleList from "./drag.module.js";
import modulePCList from "./dragpc.module.js";
import managements from "./management";
let dragFrame, dragDocument, $dragDocument;

export default {
  name: "DragIndex",
  data() {
    return {
      management: false,
      loading: true,
      frameLoading: false,
      releaseText: "发布",
      saveText: "保存",
      /**
       * 风格列表
       */
      templistFlag: false,
      templist: {},
      /**
       * 可恢复列表
       */
      resetFlag: false,
      resetList: [],
      /**
       * 模块管理
       */
      module: moduleList,
      appendComponentFlag: true,
      /**
       * 当前配置的模块信息
       */
      moduleManagementIndex: 0,
      moduleManagement: {},
      /**********************************pc部分*******************************************/
      showPcModule: false,
      modulepc: modulePCList
    };
  },
  watch: {},
  methods: {
    /**
     * 配置显示开关
     */
    toggle() {
      this.management = true;
    },
    getJsonResult() {
      let dragComponents = this.getDragComponents(true);
      let config = [];
      let headConfig = {};
      domap(dragComponents, comp => {
        let item = cloneData(comp);
        let keys = Object.keys(item);
        let itemtwo = {};
        if (item.type === "header" || item.type === "footer") {
          if (item.type === "header") {
            headConfig = item;
          }
          itemtwo = {
            type: item.type
          };
        } else {
          
          domap(keys, key => {
            if (
              (item.type === "swiper" && key === "api") ||
              (item.type !== "swiper" && (item.api || item.api_list) && key === "list")
            ) {
              //跳过
            } else {
              itemtwo[key] = item[key];
            }
          });
        }
        config.push(itemtwo);
      });
      return {
        configjson: JSON.stringify(config),
        headjson: JSON.stringify(headConfig)
      };
    },
    /**
     * 设置参数的type值
     * @param {Object} 
     */
    setParamsType(params){
      if (this.$route.name === "DragPC") {
        params.type = 2;
      }else if(this.$route.name === "DragApplet"){
        params.type = 3;
      }
    },
    /**
     * 保存配置config
     */
    savePageConfig() {
      return new Promise(resolve => {
        let params = this.getJsonResult();
        this.setParamsType(params);
        saveStoreViewConfig(params).then(res => {
          resolve(res);
        });
      });
    },
    /**
     * 保存
     */
    save() {
      if (this.saveText !== "保存") {
        return false;
      }
      this.saveText = "正在保存...";
      this.savePageConfig().then(res => {
        let text = res.result === "success" ? "保存成功" : "保存失败";
        if(res.result === "success"){
          this.$notify({
            title: "成功",
            message: "保存成功",
            type: "success"
          });
        }else{
          this.$notify({
            title: "失败",
            message: "保存失败",
            type: "error"
          });
        }
        this.saveText = text;
        setTimeout(() => {
          this.saveText = "保存";
        }, 1000);
      });
    },
    /**
     * 切换风格
     */
    slideStyle(tempid) {
      this.$confirm(
        "提示，您即将切换风格，建议先做好保存！是否确定切换风格？",
        "提示",
        {
          type: "warning"
        }
      ).then(() => {
        let params = {
          tempid: tempid
        }
        this.setParamsType(params);
        
        saveChangeTemp(params).then(res => {
          if (res.result === "success") {
            this.$msg("切换成功", "success").then(() => {
              location.reload();
            });
          } else {
            this.$tipsDialog(res.msg, {
              buttons: [
                {
                  name: "去升级",
                  url: res.url,
                  type: "primary"
                }
              ]
            });
          }
        });
      });
    },
    /**
     * 发布
     */
    release() {
      if (this.releaseText !== "发布") {
        return false;
      }
      this.releaseText = "正在发布...";

      this.savePageConfig().then(() => {
        let params = {
          tempid: this.templist.mydiyid
        };
        this.setParamsType(params);
        publishStoreViewConfig(params).then(res => {
          let text = res.result === "success" ? "发布成功" : "发布失败";
          if (res.result === "error") {
            this.$tipsDialog(res.msg, {
              buttons: [
                {
                  name: "去升级",
                  url: res.url,
                  type: "primary"
                }
              ]
            });
          }else{
            this.$notify({
              title: "成功",
              message: "发布成功",
              type: "success"
            });
          }
          this.releaseText = text;
          setTimeout(() => {
            this.releaseText = "发布";
          }, 1000);
        });
      });
    },

    /**
     * 获取手机模块图片
     */
    getModuleImg(type, style) {
      if (type === "class" || type === "column") {
        type = "course";
      }
      return require(`@/assets/drag/${type}_v${style || 1}.png`);
    },
    /**
     * 获取PC模块图片
     */
    getModulePCImg(type, style) {
      if (type === "class" || type === "column") {
        type = "course";
      }
      return require(`@/assets/dragpc/${type}_v${style || 1}.png`);
    },
    /**
     * iframe 加载结束
     */
    frameLoaded() {
      /**
       * 更新拖拽页面文档
       */
      dragFrame = frames["mphone"];
      dragDocument = dragFrame.document;

      /**
       * 在iframe页面创建脚本
       * 禁止浏览器的图片默认拖动事件
       */
      let frameImgs = dragDocument.getElementsByTagName("img");
      dragDocument.onmousemove = e => {
        let ev = e || event;
        ev.cancelBubble = true;
        ev.returnValue = false;
      };
      domap(frameImgs, el => {
        el.mousedown = function(event) {
          event.preventDefault();
          event.stopPropagation();
          this.onmousemove = function() {
            //something
          };
        };
      });
      /**
       * 加载css依赖
       */
      let dragRelyCss = `.drag-move{ position:relative}
                            .drag-move .drag-move-dashed{width: 100%;height: 100%; position: absolute;left: 0;top: 0;border: 1px dashed #488bff;box-sizing: border-box; z-index:89990;cursor: move;}
                            .drag-move .drag-delete{width:30px;height:30px;position:absolute;right:0;top:0;background:#e6412d url(/Public/wechat/images/icon-delete.png) no-repeat 50% 50%; z-index:99999; cursor:pointer;}
														.drag-move .drag-edit{position:absolute;left:0;top:0;color:#2e84ee; font-size:20px;z-index:99999; cursor:pointer;}
                            .drag-selected{ position:relative}
                            .drag-selected:before{content:"";width:100%;height:100%;position:absolute;left:0;top:0; z-index:9;border: 2px solid #5eb0ef;box-sizing: border-box;}`;
      let frameDragStyleNode = dragDocument.createElement("style");
      frameDragStyleNode.id = "drag-style";
      frameDragStyleNode.appendChild(dragDocument.createTextNode(dragRelyCss));
      dragDocument
        .getElementsByTagName("head")[0]
        .appendChild(frameDragStyleNode);

      //加载js依赖
      let frameDragRelyScript = dragDocument.createElement("script");
      frameDragRelyScript.src = "/Public/common/js/jquery.js";
      dragDocument
        .getElementsByTagName("head")[0]
        .appendChild(frameDragRelyScript);
      frameDragRelyScript.onload = () => {
        frameDragRelyScript.outerHTML = null;
        this.frameDragRelyLoadedCallback(dragFrame.$);
      };
    },
    /**
     * 拖拽依赖脚本加载完毕
     */
    frameDragRelyLoadedCallback($) {
      let pageX = 0;
      let pageY = 0;
      let posX = 0;
      let posY = 0;
      let moveFlag = false;
      let $deleteTarget;
      let $moveTarget;
      let $selectTarget;
      let $dragPosBox;

      $dragDocument = $(dragDocument);
      $dragDocument.on("click", "*", function() {
          return false;
        })
        .on("mousedown", "[drag]", function(e) {
          $moveTarget = $(this);
          moveFlag = true;
          pageX = e.pageX;
          pageY = e.pageY;
          posX = $moveTarget.position().left;
          posY = $moveTarget.position().top;
          let w = $moveTarget.width();
          let h = $moveTarget.outerHeight(true);
          $moveTarget.attr("style") &&
            $moveTarget.attr("dragstyle", $moveTarget.attr("style"));
          $moveTarget.css({
            position: "absolute",
            width: w + "px",
            zIndex: "99999",
            top: posY + "px",
            left: posX + "px"
          }).after(`
              <div style="height:${h}px;box-sizing:border-box;border:1px solid #5eb0ef;color:#7fbded; text-align:center;line-height:${h}px;font-size:14px;" id="dragPosBox">放在这里</div>
            `);
          $dragPosBox = $moveTarget.next();
        })
        .on("mousemove", "[drag]", function(e) {
          let $this = $(this);
          $this.addClass("drag-move");
          if (!$this.find(".drag-move-dashed").length) {
            $this.append(
              '<div class="drag-move-dashed"></div><a href="javascript:void(0)" class="drag-delete"></a>'
            );
          }
        })
        .on("mouseleave", "[drag]", function(e) {
          $(this)
            .removeClass("drag-move")
            .find(".drag-move-dashed,.drag-delete,.drag-edit")
            .remove();
        })
        .on("mousedown", ".drag-delete", function(e) {
          e.stopPropagation();
          $deleteTarget = $(this)
            .parents("[drag]")
            .first();
        })
        .on("mousedown", "[drag]", e => {
          this.toggle();
        })
        .mousemove(e => {
          if (moveFlag && !$deleteTarget) {
            let x = e.pageX - pageX + posX;
            let y = e.pageY - pageY + posY;
            $moveTarget.css({
              left: `${x}px`,
              top: `${y}px`
            });
            //位置匹对
            $("[drag]").each(function() {
              let $this = $(this);
              var top = $this.offset().top;
              var h = $this.outerHeight();

              if (y > top + h / 2 && y < top + h) {
                $dragPosBox.insertAfter($this);
              } else if (y < top + h / 2 && y > top) {
                $dragPosBox.insertBefore($this);
              }
            });
          }
        })
        .mouseup(e => {
          if (moveFlag) {
            moveFlag = false;
            let newComponents = new Array();
            let components = this.getDragComponents(true);

            let current = $moveTarget.attr("drag-index");
            let currentItem = components[current];
            let moveIndex = $dragPosBox.prev().attr("drag-index");

            /**
             * 改变数组顺序
             */
            if (current != moveIndex) {
              domap(components, (item, i) => {
                if (i != current) {
                  if (moveIndex === undefined) {
                    if (i == 0) {
                      newComponents.push(currentItem);
                    }
                    newComponents.push(item);
                  } else {
                    newComponents.push(item);
                    if (i == moveIndex) {
                      newComponents.push(currentItem);
                    }
                  }
                }
              });
              dragFrame.APP.components = newComponents;
            }

            if (
              !$deleteTarget &&
              $moveTarget.position().left === posX &&
              $moveTarget.position().top === posY
            ) {
              /**
               * 位置没有发生变化，视为点击效果
               */
              this.setSelectedDragTarget($moveTarget);
            }
            let originalStyle = $moveTarget.attr("dragstyle");
            if (originalStyle) {
              $moveTarget.attr("style", originalStyle);
            } else {
              $moveTarget.removeAttr("style");
            }
            $moveTarget.removeAttr("dragstyle");
            $dragPosBox.remove();
          }

          /**
           * 删除版块
           */
          if ($deleteTarget) {
            let deleteIndex = $deleteTarget.attr("drag-index");
            let newComponents = deleteArray(
              this.getDragComponents(),
              parseInt(deleteIndex)
            );
            dragFrame.APP.components = newComponents;
            $deleteTarget = null;
          }
        });
      this.loading = false;
    },
    getDragComponents(clone) {
      return clone
        ? cloneData(dragFrame.APP.components)
        : dragFrame.APP.components;
    },
    /**
     * 设置选中编辑的模块
     */
    setSelectedDragTarget($selectTarget) {
      $dragDocument.find(".drag-selected").removeClass("drag-selected");
      $selectTarget.addClass("drag-selected");
      let type = $selectTarget.attr("drag");
      let index = $selectTarget.attr("drag-index");

      /**
       * 更新正在编辑的模块
       */
      this.moduleManagement = {};
      this.$nextTick(() => {
        this.moduleManagementIndex = index;
        this.moduleManagement = this.getDragComponents()[index];
      });
    },

    /**
     * 恢复默认视图配置文件
     */
    resViewDefaultConfig() {
      this.$confirm("您确定恢复到默认效果吗？", "提示", {
        type: "warning"
      }).then(() => {
        let params = {};
        this.setParamsType(params);
        resDefault(params).then(res => {
          if (res.result === "success") {
            this.$notify({
              title: "成功",
              message: "恢复成功",
              type: "success"
            });
            setTimeout(() => {
              location.reload();
            }, 1000);
          } else {
            this.$notify({
              title: "失败",
              message: "恢复失败",
              type: "error"
            });
          }
        });
      });
    },
    /**
     * 恢复视图指定历史配置
     */
    resViewConfig(id) {
      this.$confirm("您确定恢复到这个时间点吗？", "提示", {
        type: "warning"
      }).then(() => {
        let params = {
          pathid: id
        }
        this.setParamsType(params);
        resPath(params).then(res => {
          if (res.result === "success") {
            this.$notify({
              title: "成功",
              message: "恢复成功",
              type: "success"
            });
            setTimeout(() => {
              location.reload();
            }, 1000);
          } else {
            this.$notify({
              title: "失败",
              message: "恢复失败",
              type: "error"
            });
          }
        });
      });
    },

    selectModule(item) {
      this.frameLoading = true;
      let module = cloneData(item);
      if (module.api) {
        module.api.callKeyName =
          module.type + Math.ceil(Math.random() * 999999999999);
        getStoreData([module.api]).then(res => {
          let data = res[module.api.callKeyName];
          module.list = data.list;
          this.appendComponent(module);
          this.frameLoading = false;
        });
      } else {
        this.appendComponent(module);
        this.frameLoading = false;
      }
    },
    /**
     * 追加模块
     */
    appendComponent(module) {
      if (!this.appendComponentFlag) {
        return false;
      }

      this.appendComponentFlag = false;
      let components = this.getDragComponents(true);
      let newComponents = new Array();
      domap(components, (item, i) => {
        if (i == this.moduleManagementIndex) {
          newComponents.push(module);
        }
        newComponents.push(item);
      });
      dragFrame.APP.components = newComponents;
      this.$nextTick(() => {
        this.setSelectedDragTarget(
          dragFrame
            .$(dragDocument)
            .find(`[drag-index="${this.moduleManagementIndex}"]`)
            .first()
        );
        setTimeout(() => {
          this.appendComponentFlag = true;
        }, 1000);
      });
    },
    /**
     * 打开连接
     */
    open(url) {
      location.href = url;
    }
  },
  mounted() {
    
    /**
     * 获取门户风格列表
     */
    let params = {};
    this.setParamsType(params);
    /**
     * 获取可恢复列表
     */
    getPathList(params).then(res => {
      if (res.result === "success") {
        this.resetList = res.value;
      }
    });
    getTemplist(params).then(res => {
      this.templist = res;
    });
  },
  components: managements
};
</script>
<style scoped>
/*头部*/
.wmh-header {
  height: 59px;
  line-height: 59px;
  padding: 0 20px;
  border-bottom: 1px solid #dfe4e7;
  position: relative;
  z-index: 10;
  background: #fff;
}
.wmh-header-home {
  height: 36px;
  line-height: 36px;
  border-radius: 36px;
  border: 1px solid #e9e9e9;
  display: inline-block;
  padding: 0 15px;
  color: #576071;
}
.wmh-header-home i {
  margin-right: 10px;
  border-right: 1px solid #e9e9e9;
  height: 22px;
  line-height: 22px;
  display: inline-block;
  padding-right: 10px;
  font-size: 16px;
}
.wmh-header-home:hover {
  background: #f9f9f9;
  color: #33476c;
  border: 1px solid #ddd;
}
.wmh-header-home:hover i {
  border-right: 1px solid #ddd;
}
.wmh-header .logo {
  position: relative;
  top: 12px;
}
.wmh-header .logo img {
  height: 32px;
}
.wmh-header .ks-bt {
  margin: 10px 0 0 10px;
}
.wmh-header .switch-style {
  font-size: 14px;
  margin-left: 40px;
  color: #666;
  padding: 0 20px 0 15px;
  position: relative;
}
.wmh-header .switch-style::after,
.wmh-header .bt-reset::after {
  content: "";
  width: 20px;
  height: 100%;
  position: absolute;
  right: 0;
  top: 0;
  transition: 0.3s;
  -webkit-transition: 0.3s;
  -o-transition: 0.3s;
}
.wmh-header .switch-style::after {
  background: url(../../assets/drag/arr-bt-2.png) no-repeat 50% 50%;
}
.wmh-header .bt-reset {
  position: relative;
  padding-right: 35px;
}
.wmh-header .bt-reset::after {
  background: url(../../assets/drag/arr-bt.png) no-repeat 50% 50%;
}
.wmh-header .bt-reset.on::after,
.wmh-header .switch-style.on::after {
  transform: rotate(-180deg);
  -ms-transform: rotate(-180deg);
  -moz-transform: rotate(-180deg);
  -webkit-transform: rotate(-180deg);
  -o-transform: rotate(-180deg);
}
.wmh-header .bt-reset::before {
  content: "";
  width: 18px;
  height: 40px;
  border-left: 1px solid #fff;
  position: absolute;
  right: 0;
  top: 0;
}
.wmh-header .ks-icon-link {
  color: #666;
  font-weight: bold;
}
/*风格列表*/
.wmh-style {
  padding-bottom: 30px;
}
.wmh-style li {
  width: 25%;
  float: left;
  text-align: center;
  position: relative;
}
.wmh-style .style-img {
  width: 175px;
  height: 295px;
  position: absolute;
  left: 50%;
  margin-left: -87px;
  top: 51px;
}
.wmh-style .style-img img {
  width: 100%;
}
.wmh-style .style-img .isedit {
  height: 20px;
  position: absolute;
  right: 0;
  top: 20px;
  background: #f98879 url(../../assets/drag/pen.png) no-repeat 10px 50%;
  color: #fff;
  border-radius: 30px 0 0 30px;
  padding: 0 10px 0 25px;
  font-size: 12px;
  line-height: 20px;
}
.wmh-style .phone {
  width: 196px;
  height: 400px;
}
.wmh-style .selected {
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  background: rgba(0, 0, 0, 0.3) url(../../assets/drag/yes.png) no-repeat 50%
    50%;
}
.wmh-style .tempname {
  font-size: 16px;
  padding: 10px 0;
}

/*可恢复列表*/
.reset-list {
  width: 200px;
  position: absolute;
  right: 30px;
  top: 60px;
  background: #fff;
  padding: 0 15px;
  z-index: 999;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}
.reset-list ul {
  padding: 10px 0;
}
.reset-list li {
  font-size: 14px;
  line-height: 34px;
  cursor: pointer;
}
.reset-list li:hover,
.reset-list li.on {
  color: #fc6b32;
}
.reset-list li span {
  float: right;
  font-size: 12px;
  color: #999;
}
.reset-list li .init {
  border: 1px solid #fc6b32;
  color: #fc6b32;
  height: 20px;
  line-height: 20px;
  padding: 0px 5px;
  border-radius: 4px;
  margin-top: 5px;
}
.wmh-content {
  width: 375px;
  height: 667px;
  margin: 0 auto;
  padding: 70px 20px 100px 20px;
  background: #fff;
  border-radius: 40px;
  border: 1px solid #e3e3e3;
  margin-top: 30px;
  position: relative;
}
.wmh-content:before {
  content: "";
  width: 70px;
  height: 10px;
  border-radius: 10px;
  background: #eef2f5;
  position: absolute;
  left: 50%;
  margin-left: -35px;
  top: 30px;
}
.wmh-content:after {
  content: "";
  width: 50px;
  height: 50px;
  background: #eef2f5;
  border-radius: 50%;
  position: absolute;
  bottom: 25px;
  left: 50%;
  margin-left: -25px;
}
.mphone {
  width: 375px;
  height: 667px;
  display: block;
  margin: 0 auto;
  background: #fff;
  border: 1px solid #e3e3e3;
}

.wmh-module__icon {
  position: absolute;
  left: 50px;
  top: 420px;
  width: 56px;
  height: 56px;
  border-radius: 50%;
  overflow: hidden;
  background: #fff;
  text-align: center;
  box-shadow: 0px 0px 8px 0px rgba(4, 30, 50, 0.1);
}
.wmh-module__icon img {
  margin-top: 14.5px;
  width: 27px;
  height: 27px;
}
.wmh-fn {
  position: absolute;
  left: 50%;
  top: 120px;
  width: 320px;
  margin-left: -640px;
  border-radius: 10px;
  background: #fff;
  overflow: hidden;
}
.wmhpc-fn {
  position: absolute;
  left: 130px;
  top: 120px;
  width: 320px;
  border-radius: 10px;
  background: #fff;
  overflow: hidden;
  box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
}
.wmhpc-fn .title,
.wmh-fn .title {
  height: 50px;
  background: #33476c;
  line-height: 50px;
  color: #fff;
  padding: 0 15px;
}

.wmhpc-management {
  position: absolute;
  right: 50px;
  top: 120px;
  width: 400px;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
}
.wmh-management {
  position: absolute;
  right: 50%;
  top: 120px;
  width: 400px;
  margin-right: -720px;
  border-radius: 10px;
  overflow: hidden;
}
.wmhpc-management .title,
.wmh-management .title {
  height: 50px;
  background: #33476c;
  line-height: 50px;
  padding-left: 20px;
  color: #fff;
  font-size: 16px;
}

.wmhpc-management .title img,
.wmh-management .title img {
  width: 16px;
  height: 16px;
  float: right;
  margin-top: 17px;
  margin-right: 20px;
  cursor: pointer;
}

@media (max-width: 1360px) {
  .wmh-management {
    margin-right: -630px;
  }
  .wmh-fn {
    margin-left: -570px;
  }
}
.wmhpc-management .cont,
.wmh-management .cont {
  padding: 15px 20px;
}
.wmhpc-management .list,
.wmh-management .list {
  margin-left: -15px;
}
.wmhpc-management .list li,
.wmh-management .list li {
  width: 33.3%;
  float: left;
}
.wmhpc-management .list .inner,
.wmh-management .list .inner {
  margin: 15px 0 0 15px;
  border: 1px solid #eef2f5;
  height: 105px;
  position: relative;
}
.wmhpc-management .list .images,
.wmh-management .list .images {
  height: 80px;
  background-size: contain;
  background-repeat: no-repeat;
  background-position: 50% 50%;
}
.wmhpc-management .list .close,
.wmh-management .list .close {
  width: 20px;
  height: 20px;
  background: #e56352;
  text-align: center;
  line-height: 20px;
  position: absolute;
  right: -10px;
  top: -10px;
  color: #fff;
  border-radius: 50%;
  font-size: 16px;
  cursor: pointer;
}
.wmhpc-management .list .close:hover,
.wmh-management .list .close:hover {
  background: #488bff;
}
.wmhpc-management .list .name,
.wmh-management .list .name {
  height: 24px;
  line-height: 24px;
  overflow: hidden;
  padding: 0 5px;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.wmhpc-management .list .add .inner,
.wmh-management .list .add .inner {
  text-align: center;
  line-height: 32px;
  cursor: pointer;
  color: #aaa;
}
.wmhpc-management .list .add .inner:hover,
.wmh-management .list .add .inner:hover {
  color: #488bff;
}
.wmhpc-management .list .add i,
.wmh-management .list .add i {
  font-size: 48px;
  display: block;
  font-family: simsun;
  margin-top: 24px;
}

.no-management {
  text-align: center;
  color: #999;
  font-size: 14px;
  line-height: 64px;
}

.wmh-module,
.wmh-page,
.wmh-management .cont {
  height: 600px;
  background: #fff;
  overflow-y: auto;
}
.wmh-module,
.wmh-page,
.wmhpc-management .cont {
  height: 600px;
  background: #fff;
  overflow-y: auto;
}
.wmh-module li {
  padding: 10px;
  border: 1px solid #eee;
  margin: 15px 15px 0 15px;
  cursor: pointer;
}
.wmh-module li img {
  width: 100%;
  display: block;
}
.wmh-module .name {
  height: 44px;
  line-height: 44px;
  overflow: hidden;
  padding: 0 15px 0 25px;
  font-size: 14px;
  border-bottom: 1px solid #eee;
  position: relative;
  cursor: pointer;
}
.wmh-module .name::before {
  content: "";
  width: 11px;
  height: 11px;
  background: url(../../assets/drag/arrow.png) no-repeat;
  position: absolute;
  left: 10px;
  top: 50%;
  margin-top: -6px;
}
.wmh-module .name.on {
  color: #488bff;
}
.wmh-module .name.on::before {
  background: url(../../assets/drag/arrow.png) no-repeat -28px 0;
}
.wmh-module li:hover {
  border: 1px solid #488bff;
}

.wmh-page .item {
  margin: 15px 20px 0 20px;
  font-size: 14px;
  height: 36px;
  line-height: 36px;
  border: 1px solid #e6e6e6;
  padding: 0 15px;
  border-radius: 4px;
}
.wmh-page .operation {
  color: #999;
  font-size: 12px;
}
.wmh-page .operation span {
  margin-left: 15px;
  color: #33476c;
  cursor: pointer;
}
.wmh-page .ks-bt {
  margin: 15px 20px 0 20px;
}
.wmh-page .add {
  text-align: center;
  cursor: pointer;
}
.wmh-page .add:hover {
  color: #488bff;
}

.link-box {
  width: 260px;
  position: absolute;
  left: 0;
  top: 0;
  background: #fff;
  border-radius: 4px;
  padding-left: 100px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  font-size: 13px;
}
.link-box .lk-left {
  width: 80px;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  background: #fff;
  border-right: 1px solid #eee;
}
.link-box .lk-left .lk-item {
  text-align: center;
  height: 40px;
  line-height: 40px;
  cursor: pointer;
  border-left: 2px solid #fff;
  border-bottom: 1px solid #eee;
}
.link-box .lk-left .on {
  background: #fff;
  color: #488bff;
  border-left: 2px solid #488bff;
  position: relative;
}
.link-box .lk-left .on::after {
  content: "";
  width: 1px;
  height: 100%;
  position: absolute;
  right: -1px;
  top: 0;
  background: #fff;
}
.link-box .lk-right {
  padding: 10px 0;
  height: 200px;
  overflow-y: auto;
}
.link-box .lk-right .lk-item {
  height: 36px;
  line-height: 36px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.link-box .lk-column-wrap {
  margin-left: -5px;
}
.link-box .lk-column {
  height: 26px;
  line-height: 26px;
  display: inline-block;
  border: 1px solid #e3e3e3;
  border-radius: 4px;
  background: #fafafa;
  padding: 0 10px;
  margin: 5px;
  color: #666;
}
.link-box .lk-column:hover {
  background: #fff;
  border: 1px solid #488bff;
}
.link-box span {
  cursor: pointer;
}
.link-box span:hover {
  color: #488bff;
}

.select-data {
  width: 280px;
  height: 100%;
  background: #fff;
  position: fixed;
  right: 0;
  top: 0;
  z-index: 99;
  box-sizing: border-box;
  padding: 20px;
  border-left: 1px solid #eee;
}
.select-data .title {
  font-size: 18px;
  line-height: 38px;
  position: relative;
}
.select-data .title .close {
  width: 38px;
  height: 38px;
  text-align: center;
  position: absolute;
  right: 0;
  top: 0;
  font-size: 22px;
  font-family: simsun;
  cursor: pointer;
}
.select-data .title .close:hover {
  color: #488bff;
}
.select-data .tab {
  height: 34px;
  margin-top: 10px;
}
.select-data .tab li {
  float: left;
  width: 25%;
  font-size: 14px;
  height: 34px;
  line-height: 34px;
  cursor: pointer;
}
.select-data .tab .on {
  color: #488bff;
  position: relative;
}
.select-data .tab .on::after {
  content: "";
  width: 30px;
  height: 2px;
  background: #488bff;
  position: absolute;
  bottom: 0;
  left: 0;
}
.select-data .list {
  overflow-y: auto;
}
.select-data .list ul {
  padding: 10px 0;
}
.select-data .list li {
  height: 34px;
  line-height: 34px;
  font-size: 14px;
  padding: 10px 0;
  border-top: 1px solid #eee;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.select-data .list li:first-child {
  border-top: 0px;
}
.select-data .sc {
  margin-top: 15px;
}
.select-data .sc input {
  width: 100%;
  height: 32px;
  line-height: 32px;
  border-radius: 40px;
  border: 0px;
  background: #eef2f5 url(../../assets/drag/icon-sc.png) no-repeat 15px 50%;
  box-sizing: border-box;
  padding-left: 40px;
}

.banner img {
  display: block;
  width: 100%;
  margin-bottom: 15px;
}
.style-image{
  position: relative !important;
  height: 200px !important;
}
.selectedpc{
  height: 95% !important;
}
</style>

