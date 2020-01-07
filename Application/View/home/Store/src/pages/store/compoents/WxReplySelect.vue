<template>
  <div class="wx-reply-select clearfix">
    <el-dialog title="选择课程" width="960px" :visible.sync="visible" v-if="visible">
      <select-course
        :visible.sync="visible"
        :current-id="currentId"
        :type="currentTab"
        @selected="courseSelected"
      />
    </el-dialog>

    <div class="wx-reply-select__tab">
      <ul>
        <li
          class="wx-reply-select__tab__li"
          @click="currentTab = item.replytype"
          v-for="item in tab"
          :key="item.replytype"
          :class="item.replytype === currentTab && 'wx-reply-select__tab__active'"
        >
          <i class="iconfont" :class="item.icon"></i>
          {{item.text}}
        </li>
      </ul>
    </div>
    <!--设置文字-->
    <wx-editor ref="editor" v-show="currentTab === 'text'"/>

    <!--设置课程-->
    <div class="wx-reply-select__action" v-if="currentTab === 'course'">
      <div class="wx-reply-select__select" @click="select" v-if="selectedCourse.step === 'select'">
        <i class="el-icon-plus"></i>
        从课程库中选择
      </div>
      <div class="wx-reply-select__selected" v-else-if="selectedCourse.step === 'selected'">
        <course-item class="wx-reply-select__selected__item" :item="selectedCourse.item"/>

        <div class="wx-reply-select__selected__tools">
          <el-tooltip
            class="wx-reply-select__selected__tool"
            effect="dark"
            content="编辑"
            placement="top"
          >
            <i class="iconfont icon-bianji4" @click="reSelect(selectedCourse.item)"></i>
          </el-tooltip>
          <el-tooltip
            class="wx-reply-select__selected__tool"
            effect="dark"
            content="删除"
            placement="top"
          >
            <i class="iconfont icon-shanchu1" @click="delSelected"></i>
          </el-tooltip>
        </div>
      </div>
    </div>
    <!--设置专栏-->
    <div class="wx-reply-select__action" v-else-if="currentTab === 'column'">
      <div class="wx-reply-select__select" @click="select" v-if="selectedColumn.step === 'select'">
        <i class="el-icon-plus"></i>
        从专栏库中选择
      </div>

      <div class="wx-reply-select__selected" v-else-if="selectedColumn.step === 'selected'">
        <course-item class="wx-reply-select__selected__item" :item="selectedColumn.item"/>
        <div class="wx-reply-select__selected__tools">
          <el-tooltip
            class="wx-reply-select__selected__tool"
            effect="dark"
            content="编辑"
            placement="top"
          >
            <i class="iconfont icon-bianji4" @click="reSelect(selectedColumn.item)"></i>
          </el-tooltip>
          <el-tooltip
            class="wx-reply-select__selected__tool"
            effect="dark"
            content="删除"
            placement="top"
          >
            <i class="iconfont icon-shanchu1" @click="delSelected"></i>
          </el-tooltip>
        </div>
      </div>
    </div>
    <!--设置直播课-->
    <div class="wx-reply-select__action" v-else-if="currentTab === 'live'">
      <div class="wx-reply-select__select" @click="select" v-if="selectedLive.step === 'select'">
        <i class="el-icon-plus"></i>
        从直播库中选择
      </div>

      <div class="wx-reply-select__selected" v-else-if="selectedLive.step === 'selected'">
        <course-item class="wx-reply-select__selected__item" :item="selectedLive.item"/>
        <div class="wx-reply-select__selected__tools">
          <el-tooltip
            class="wx-reply-select__selected__tool"
            effect="dark"
            content="编辑"
            placement="top"
          >
            <i class="iconfont icon-bianji4" @click="reSelect(selectedLive.item)"></i>
          </el-tooltip>
          <el-tooltip
            class="wx-reply-select__selected__tool"
            effect="dark"
            content="删除"
            placement="top"
          >
            <i class="iconfont icon-shanchu1" @click="delSelected"></i>
          </el-tooltip>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import SelectCourse from "./SelectCourse";
import CourseItem from "./CourseItem";
import WxEditor from "./WxEditor";
export default {
  name: "WxReplySelect",
  data() {
    return {
      /**
       * 窗口显示开关
       */
      currentId: null,
      visible: false,
      /**
       * 当前选中的信息（课程、专栏、直播课等）
       */
      selectedCourse: {
        step: "select",
        item: {}
      },
      selectedColumn: {
        step: "select",
        item: {}
      },
      selectedLive: {
        step: "select",
        item: {}
      },
      currentTab: "text",
      /**
       * 选项卡
       */
      tab: [
        {
          text: "文字",
          icon: "icon-wenzi",
          replytype: "text"
        },

        {
          text: "课程",
          icon: "icon-shipin",
          replytype: "course"
        },
        {
          text: "专栏",
          icon: "icon-shipin",
          replytype: "column"
        },
        {
          text: "直播课",
          icon: "icon-zhibojianpianhaoshezhi",
          replytype: "live"
        }
      ]
    };
  },
  methods: {
    /**
     * 课程选择回调
     */
    courseSelected(item) {
      switch (this.currentTab) {
        case "course":
          this.selectedCourse.step = "selected";
          this.selectedCourse.item = item;
          break;
        case "column":
          this.selectedColumn.step = "selected";
          this.selectedColumn.item = item;
          break;
        case "live":
          this.selectedLive.step = "selected";
          this.selectedLive.item = item;
          break;
      }
    },
    /**
     * 选择
     */
    select() {
      this.currentId = null;
      this.visible = true;
      console.log(this.currentId);
    },
    /**
     * 重新选择
     */
    reSelect(item) {
      this.currentId = item.$id;
      this.visible = true;
    },
    /**
     * 移除已选择
     */
    delSelected() {
      switch (this.currentTab) {
        case "course":
          this.selectedCourse.item = {};
          this.selectedCourse.step = "select";
          break;
        case "column":
          this.selectedColumn.item = {};
          this.selectedColumn.step = "select";
          break;
        case "live":
          this.selectedLive.item = {};
          this.selectedLive.step = "select";
          break;
      }
    },
    /**
     * 设置内容
     */
    setInfo(info) {
      this.currentTab = info.replytype;
      switch (this.currentTab) {
        case "text":
          if (info.text) {
            this.$refs.editor.setContent(info.text);
          }
          break;
        case "course":
        case "column":
        case "live":
          let key =
            (this.currentTab === "course" && "selectedCourse") ||
            (this.currentTab === "column" && "selectedColumn") ||
            (this.currentTab === "live" && "selectedLive");
          let list = info.list;
          if (list) {
            this[key].step = "selected";
            this[key].item = {
              title: list.title,
              shortdesc: list.description,
              defaultpic: list.picUrl,
              $id: info.id
            };
          }
          break;
      }
    },
    /**
     * 获取设置内容
     */
    getInfo() {
      let data = {
        replytype: this.currentTab
      };
      switch (this.currentTab) {
        case "text":
          let content = this.$refs.editor.getContent();
          if (!content) {
            this.$msg("请先设置内容");
            return false;
          }
          data.text = content;
          break;
        case "course":
          data.id = this.selectedCourse.item.$id;
          if (!data.id) {
            this.$msg("请先选择课程");
            return false;
          }
          break;
        case "column":
          data.id = this.selectedColumn.item.$id;
          if (!data.id) {
            this.$msg("请先选择专栏");
            return false;
          }
          break;
        case "live":
          data.id = this.selectedLive.item.$id;
          if (!data.id) {
            this.$msg("请先选择直播课");
            return false;
          }
          break;
      }
      return data;
    }
  },

  components: {
    WxEditor,
    SelectCourse,
    CourseItem
  }
};
</script>
<style scoped>
.wx-reply-select__tab {
  height: 44px;
  line-height: 44px;
  border: 1px solid #e0e0e0;
  border-bottom: 0px;
}
.wx-reply-select__tab__li {
  float: left;
  font-size: 14px;
  padding: 0 20px;
  color: #999;
  cursor: pointer;
}
.wx-reply-select__tab__active {
  color: #e5412c;
}

.wx-reply-select__action {
  border: 1px solid #e0e0e0;
  padding: 20px;
}

.wx-reply-select__select {
  width: 450px;
  height: 200px;
  border: 2px dashed #e4e8eb;
  text-align: center;
  font-size: 14px;
  color: #999;
  cursor: pointer;
  line-height: 34px;
}
.wx-reply-select__select .el-icon-plus {
  font-size: 40px;
  color: #bbb;
  display: block;
  margin-top: 65px;
}
.wx-reply-select__select:hover {
  border: 2px dashed #d3d3d3;
}
.wx-reply-select__select:hover .el-icon-plus {
  color: #aaa;
}

.wx-reply-select__selected {
  position: relative;
  display: inline-block;
  padding-right: 120px;
}

.wx-reply-select__selected__item {
  width: 300px;
}

.wx-reply-select__selected__tools {
  position: absolute;
  left: 310px;
  top: 50%;
  margin-top: -20px;
  display: none;
}
.wx-reply-select__selected:hover .wx-reply-select__selected__tools {
  display: block;
}
.wx-reply-select__selected__tool {
  width: 36px;
  height: 36px;
  border: 1px solid #eee;
  text-align: center;
  line-height: 36px;
  display: inline-block;
  margin: 0 4px;
  border-radius: 50%;
  color: #999;
  cursor: pointer;
  font-size: 18px;
}
.wx-reply-select__selected__tool:hover {
  color: #666;
}
</style>


