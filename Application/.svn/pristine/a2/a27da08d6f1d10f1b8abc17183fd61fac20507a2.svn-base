<template>
  <ks-container>
    <div class="ks-breadcrumb">
      <el-breadcrumb separator="/">
        <el-breadcrumb-item>
          <a href="javascript:;" @click="back()">课程列表</a>
        </el-breadcrumb-item>
        <el-breadcrumb-item>课程资料</el-breadcrumb-item>
      </el-breadcrumb>
    </div>
    <div class="ks-mt20 clearfix">
      <el-button class="ks-fr" type="primary" icon="el-icon-plus" @click="addData">添加</el-button>
      <el-input
        @change="getDataList()"
        placeholder="请输入资料标题搜索"
        v-model="keyword"
        class="ks-max-w-fit"
      >
        <i
          class="el-icon-search el-input__icon ks-cursor-pointer"
          slot="suffix"
          @click="getDataList()"
        ></i>
      </el-input>
    </div>
    <div class="course-data ks-mt20">
      <el-table :data="list">
        <el-table-column label="选择" width="60">
          <div slot-scope="scope" style="margin-left:5px;">
            <el-checkbox v-model="scope.row.checked"/>
          </div>
        </el-table-column>
        <el-table-column label="标题">
          <data-format slot-scope="scope" :file-name="scope.row.file_name"/>
        </el-table-column>
        <el-table-column prop="size" label="文件大小" width="150px"></el-table-column>

        <el-table-column label="是否公开" width="100px">
          <el-switch
            slot-scope="scope"
            v-model="scope.row._isopen"
            :active-color="$store.state.switch_on"
            :inactive-color="$store.state.switch_off"
            @change="changeOpen(scope.row)"
          ></el-switch>
        </el-table-column>
        <el-table-column label="操作" width="100px">
          <span slot-scope="scope">
            <el-tooltip class="item" effect="dark" content="删除" placement="top">
              <i
                class="iconfont icon-shanchu1 select-data__del"
                @click="deleteData([scope.row.id])"
              ></i>
            </el-tooltip>
          </span>
        </el-table-column>
      </el-table>
      <ks-table-footer
        class="ks-mt20 ks-pl15"
        v-if="list.length"
        :pagination="{current:page,total:pageCount}"
        :table-data="list"
        @current-change="getDataList"
        @trigger="deleteData"
        call-type="array"
      />
    </div>
    <el-dialog title="选择资料" width="920px" :visible.sync="visible" @closed="loadSelectData = false">
      <select-data
        type="multiple"
        @cancel="visible = false"
        v-if="loadSelectData"
        @sure="selectDataCallback"
      />
    </el-dialog>
  </ks-container>
</template>
<script>
import {
  getMaterialsList,
  changeMaterialsOpen,
  delMaterials,
  addCourseMaterials
} from "@/api/data";
import SelectData from "../data/SelectData";
import DataFormat from "../data/DataFormat";
export default {
  name: "CourseData",
  data() {
    return {
      visible: false,
      loadSelectData: true,
      list: [],
      page: 1,
      pageCount: 1,
      keyword: ""
    };
  },
  methods: {
    back() {
      history.back();
    },
    /**
     * 添加资料
     */
    addData() {
      this.loadSelectData = true;
      this.visible = true;
    },
    /**
     * 获取资料列表
     * @param {Number} 页码
     */
    getDataList(page = 1) {
      getMaterialsList({
        p: page,
        courseid: this.$route.params.id,
        keyword: this.keyword,
        maxperpage: 10
      }).then(res => {
        res.list.map(item => {
          item.checked = false;
          item._isopen = item.isopen == 1;
        });
        this.list = res.list;
        this.pageCount = res.page.total_pages;
      });
    },
    /**
     * 删除资料
     * @param {Array} 要删除的资料id数组
     */
    deleteData(ids) {
      delMaterials({
        id: ids
      }).then(res => {
        if (res.result === "success") {
          this.$msg(res.msg, "success");
          this.getDataList();
        }
      });
    },
    /**
     * 选择资料回调
     * @param {Array} 选择返回的资料数组
     */
    selectDataCallback(selected) {
      this.visible = false;
      let ids = [];
      selected.map(item => {
        ids.push(item.id);
      });
      addCourseMaterials({
        fileid: ids,
        courseid: this.$route.params.id
      }).then(res => {
        if (res.result === "success") {
          this.$msg(res.msg, "success");
          this.getDataList();
        }
      });
    },
    /**
     * 修改公开状态
     * @param {Object}
     */
    changeOpen(item) {
      changeMaterialsOpen({
        id: item.id
      }).then(res => {
        //...
      });
    }
  },
  activated() {
    this.visible = false;
    this.loadSelectData = true;
    this.list = [];
    this.page = 1;
    this.pageCount = 1;
    this.keyword = "";
    this.getDataList();
  },
  components: {
    DataFormat,
    SelectData
  }
};
</script>
<style scoped>
</style>

