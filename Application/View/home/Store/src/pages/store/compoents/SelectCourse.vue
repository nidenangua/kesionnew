<template>
  <div>
    <ks-loading v-show="loading"/>
    <div class="select-course">
      <el-row :gutter="20">
        <el-col :span="8" v-for="item in list" :key="item.$id">
          <course-item class="ks-mt20" :type="type" :item="item" @click="selectItem(item)">
            <div class="ks-select-mask" v-show="item.$id == current" slot="prepend">
              <i class="el-icon-check"></i>
            </div>
          </course-item>
        </el-col>
      </el-row>
    </div>

    <div class="select-course-footer clearfix">
      <div class="ks-fl">
        <el-button type="primary" :disabled="current === null" @click="sure">确定</el-button>
        <el-button @click="$emit('update:visible',false)">取消</el-button>
      </div>
      <div class="ks-fr">
        <el-pagination
          @current-change="getList"
          :current-page.sync="page"
          :page-count="pageCount"
          layout="prev, pager, next"
          background
        ></el-pagination>
      </div>
    </div>
  </div>
</template>
<script>
import CourseItem from "./CourseItem";
import { getStoreData } from "@/api/store";
export default {
  name: "SelectCourse",
  props: ["type", "currentId"],
  data() {
    return {
      current: this.currentId,
      loading: true,
      selected: {},
      list: [],
      page: 1,
      pageCount: 1
    };
  },
  methods: {
    /**
     * 选择
     */
    selectItem(item) {
      if (this.current === item.$id) {
        this.current = null;
        this.selected = {};
      } else {
        this.current = item.$id;
        this.selected = item;
      }
    },

    /**
     * 获取数据列表
     */
    getList(page = 1) {
      let params = {
        callKeyName: "course",
        maxperpage: 10,
        p: page
      };

      switch (this.type) {
        case "course":
          params.act = "appCourse";
          break;
        case "column":
          params.act = "appColumn";
          break;
        case "live":
          params.act = "appClass";
          break;
      }
      if (params.act) {
        getStoreData([params]).then(res => {
          res.course.list.map(item => {
            switch (this.type) {
              case "course":
                item.$id = item.courseid;
                break;
              case "column":
                item.$id = item.columnid;
                break;
              case "live":
                item.$id = item.classid;
                break;
            }
          });
          this.loading = false;
          this.list = res.course.list;
        });
      }
    },
    /**
     * 确认选择
     */
    sure() {
      this.$emit("update:visible", false);
      this.$emit("selected", this.selected);
    }
  },
  mounted() {
    this.getList();
  },
  components: {
    CourseItem
  }
};
</script>
<style scoped>
/*课程*/
.select-course {
  margin-top: -40px;
  height: 500px;
  overflow-x: hidden;
  overflow-y: auto;
  padding: 20px;
}

.select-course-footer {
  border-top: 1px solid #eee;
  padding-top: 20px;
}
</style>

