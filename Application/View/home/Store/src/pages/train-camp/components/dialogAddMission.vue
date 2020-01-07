<template>
  <div>
    <el-dialog
      title="选择添加任务类型"
      :visible.sync="centerDialogVisible"
      width="45%"
      center
      :before-close="dialogClose"
    >
      <div class="select-add-cate">
        <div class="select-add-cate__content" @click="selectAddCate">
          <img src="">
          <div class="title">课程内容</div>
          <div class="des">可添加视频/音频/图文/直播/专栏 , 提供优质教学内容</div>
        </div>
        <div class="select-add-cate__tools">
          <img src="">
          <div class="title">教学工具</div>
          <div class="des">可添加教学工具 , 增强督学效果 , 提高教学质量</div>
        </div>
      </div>
    </el-dialog>
    <el-dialog
      title="选择课程内容"
      :visible.sync="centerDialogVisible2"
      width="55%"
      center
      @open="openHandle"
    >
      <div class="select-class-content">
        <div class="select-class-content__header">
          <el-select v-model="classCate" size="small" clearable @change="classCateChange">
            <el-option v-for="item in options" :key="item" :value="item"></el-option>
          </el-select>
          <el-input
            placeholder="标题"
            v-model="input1"
            size="small"
            class="select-class-content__title"
            @change="classCateChange"
          >
            <i slot="suffix" class="iconfont icon-sousuo select-class-content__search" @click="classCateChange"></i>
          </el-input>
        </div>
        <div class="select-class-content__main">
          <el-table
            ref="multipleTable"
            :data="courseList"
            tooltip-effect="dark"
            style="width: 100%"
            @selection-change="handleSelectionChange"
          >
            <el-table-column type="selection" width="55" :selectable="selectable"></el-table-column>
            <el-table-column label="内容">
              <template slot-scope="scope">
                <div class="select-class-content__column">
                  <img :src="scope.row.defaultpic" alt="" class="select-class-content__img">
                  {{ scope.row.title }}
                </div>
              </template>
            </el-table-column>
          </el-table>
          <el-pagination background small :page-size="5" layout="prev, pager, next" :total="courseList.length" class="courseList-page"></el-pagination>
        </div>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="confirmSave">确定保存</el-button>
        <el-button @click="centerDialogVisible2 = false">取 消</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
import { getStoreData } from "@/api/store";
export default {
  name: "dialogAddMission",
  props: {
    /**是否出现 添加任务类型对话框 */
    centerDialogVisible: {
      type: Boolean,
      default: false
    },
    // 目录内容里已经存在的内容id
    existChapterId: {
      type: Object
    }
  },
  data() {
    return {
      /**选择课程内容对话框 是否出现 */
      centerDialogVisible2: false,
      /**课程类型 */
      classCate: "视频",
      /**可选课程类型列表 */
      options: ["视频", "音频", "图文", "直播", "专栏"],
      /**课程标题 */
      input1: "",
      /**课程类型列表 */
      courseList: [],
      /** 要保存的课程内容 */
      saveCourseList: []
    };
  },
  methods: {
    /**选择添加类型 */
    selectAddCate() {
      this.centerDialogVisible2 = true;
      this.$nextTick(() => {
        this.$emit("changeCenterDialogVisible", false);
      });
    },
    /**添加内容表格 选择项发生变化时触发 */
    handleSelectionChange(selection) {
      if (selection.length > 0) {
        this.saveCourseList = selection;
      }
    },
    /**确定保存 */
    confirmSave() {
      if (this.saveCourseList.length > 0) {
        this.$emit("saveCourseList", this.saveCourseList);
      }
      this.centerDialogVisible2 = false;
    },
    /**通知父组件要关闭对话框 */
    dialogClose() {
      this.$emit("changeCenterDialogVisible", false);
    },
    /**课程内容对话框打开的回调 */ 
    openHandle() {
      this.input1 = "";
      this.courseList = [];
      this.classCateChange();
    },
    /**切换课程分类时触发 */
    classCateChange() {
      let param = [
        {
          act: "appCourse",
          callKeyName: "courseList",
          p: 1,
          data: {
            courseType: 1,
            sql_or_like: {
              title: this.input1
            }
          },
          maxperpage: 5,
          p: 1
        }
      ];
      if (this.classCate == "视频") {
        param[0].data.courseType = 1;
      } else if (this.classCate == "音频") {
        param[0].data.courseType = 3;
      } else if (this.classCate == "图文") {
        param[0].data.courseType = 4;
      } else if (this.classCate == "直播") {
        param = [
          {
            act: "appClass",
            callKeyName: "courseList",
            data: {
              sql_or_like: {
                title: this.input1
              }
            },
            maxperpage: 5,
            p: 1
          }
        ];
      } else if (this.classCate == "专栏") {
        param = [
          {
            act: "appColumn",
            callKeyName: "columnList",
            data: {
              sql_or_like: {
                title: this.input1
              }
            },
            maxperpage: 5,
            p: 1
          }
        ];
      } else {
        return;
      }
      this.getCourseList(param);
    },
    /**获取课程内容 */
    getCourseList(param = []) {
      getStoreData(param).then(res => {
        if (res.courseList) {
          this.courseList = res.courseList.list;
        } else {
          this.courseList = res.columnList.list;
        }
      });
    },
    /**判断表格哪一行不能选择 */
    selectable(row,index){
        if(row.courseid && this.existChapterId.courseIdList.includes(row.courseid)){
            return false;
        }else if(row.columnid && this.existChapterId.columnIdList.includes(row.columnid)){
            return false;
        }
        return true;
    }
  }
};
</script>

<style scoped>
.select-add-cate {
  display: flex;
  justify-content: space-between;
  padding: 0 20px;
}
.select-add-cate img {
  width: 50px;
  height: 50px;
  background-color: #eee;
}
.select-add-cate__content,
.select-add-cate__tools {
  width: 48%;
  border: 1px solid #eee;
  border-radius: 5px;
  text-align: center;
  padding: 30px;
  box-sizing: border-box;
  cursor: pointer;
}
.select-add-cate .title {
  font-size: 14px;
  font-weight: bold;
}
.select-add-cate .des {
  font-size: 12px;
  color: #898c90;
}

.select-class-content__header {
  display: flex;
  margin-bottom: 20px;
}
.select-class-content__title {
  width: 50%;
  margin-left: 10px;
}
.select-class-content__search {
  cursor: pointer;
}
.select-class-content__column {
  display: flex;
  align-items: center;
}
.select-class-content__img {
  display: inline-block;
  margin-right: 10px;
  width: 50px;
  height: 30px;
  background-color: #5e6062;
}
.courseList-page{
  margin-top: 20px;
  text-align: right;
}
</style>
