<template>
  <div class="select-data">
    <div class="select-data__head clearfix">
      <el-button class="ks-fr" type="primary" icon="el-icon-upload" @click="uploadData">本地上传</el-button>
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
    <div v-if="list.length">
      <ks-loading v-show="loading"/>
      <div class="select-data__list" v-if="action === 'list'">
        <el-table :data="list">
          <el-table-column label="选择" width="60">
            <div slot-scope="scope" style="margin-left:5px;">
              <el-checkbox v-model="scope.row.checked"/>
            </div>
          </el-table-column>
          <el-table-column label="标题">
            <data-format :file-name="scope.row.file_name" slot-scope="scope"/>
          </el-table-column>
          <el-table-column prop="size" label="文件大小" width="150px"></el-table-column>
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
      <div v-else>
        <div class="select-data__container ks-mt20">
          <el-row class="select-data__headrow">
            <el-col :span="20">标题</el-col>
            <el-col :span="4">文件大小</el-col>
          </el-row>
          <el-row
            class="select-data__row"
            v-for="item in list"
            :class="item.checked && 'select-data__row--selected'"
            :key="item.id"
          >
            <div @click="selectItem(item)">
              <el-col :span="20">
                <data-format :file-name="item.file_name"/>
              </el-col>
              <el-col :span="4">{{item.size}}</el-col>
            </div>
          </el-row>
        </div>
        <div class="ks-mt20 clearfix">
          <div class="ks-fl">
            <el-button type="primary" :disabled="disabled" @click="sure">确定</el-button>
            <el-button @click="cancel">取消</el-button>
          </div>
          <div class="ks-fr">
            <el-pagination
              @current-change="getDataList"
              :current-page="page"
              :page-count="pageCount"
              layout="prev, pager, next"
              background
            ></el-pagination>
          </div>
        </div>
      </div>
    </div>
    <div class="ks-empty" v-else-if="loaded">没有找到任何资料~</div>
  </div>
</template>
<script>
import DataFormat from "./DataFormat";
import { getFileList, delFile } from "@/api/data";
export default {
  name: "SelectData",
  props: {
    action: String,
    type: String //为multiple 为多选
  },
  data() {
    return {
      loading: true,
      page: 1,
      pageCount: 1,
      keyword: "",
      loaded: false,
      disabled: true,
      list: []
    };
  },
  methods: {
    getDataList(page = 1) {
      this.page = page;
      this.loading = true;
      getFileList({
        p: page,
        maxperpage: 12,
        keyword: this.keyword,
        type: 5
      }).then(res => {
        res.list.map(item => {
          item.checked = false;
        });
        this.list = res.list;
        this.pageCount = res.page.total_pages;
        this.loaded = true;
        this.loading = false;
      });
    },
    sure() {
      let selected = [];
      this.list.map(item => {
        if (item.checked) {
          selected.push(item);
        }
      });
      this.$emit("sure", selected);
    },
    cancel() {
      this.$emit("cancel");
    },
    /**
     * 选择
     */
    selectItem(item) {
      if (this.type !== "multiple") {
        this.list.map(a => {
          if (a.id != item.id && a.checked) {
            a.checked = false;
          }
        });
      }
      item.checked = !item.checked;
      let is = true;
      this.list.map(a => {
        if (a.checked) {
          is = false;
        }
      });
      this.disabled = is;
    },
    /**
     * 删除资料
     */
    deleteData(ids) {
      delFile({
        id: ids
      }).then(res => {
        if (res.result === "success") {
          this.$msg(res.msg, res.result);
          let startIndex = 0;
          this.list.map((item, index) => {
            if (item.id == ids[0]) {
              startIndex = index;
            }
          });
          this.list.splice(startIndex, ids.length);
          if (this.list.length) {
            this.getDataList(this.page);
          } else {
            let _page = Math.max(this.page - 1, 1);
            this.getDataList(_page);
          }
        }
      });
    },
    /**
     * 上传资料
     */
    uploadData() {
      this.$store.ready(state => {
        this.$aliUpload({
          wxid: state.info.wxid,
          type: "data",
          uploaded: info => {
            this.getDataList();
          }
        });
      });
    }
  },
  created() {
    this.getDataList();
  },
  components: {
    DataFormat
  }
};
</script>

<style scoped>
.select-data__list {
  margin-top: 20px;
}
.select-data__container {
  height: 400px;
  overflow-x: hidden;
  overflow-y: auto;
  padding-bottom: 20px;
}

.select-data__headrow {
  background: #f6f6f6;
}
.select-data__headrow,
.select-data__row {
  height: 44px;
  line-height: 44px;
  overflow: hidden;
}
.select-data__headrow .el-col,
.select-data__row .el-col {
  padding: 0 15px;
}
.select-data__row {
  cursor: pointer;
}
.select-data__row:hover {
  background: #f9f9f9;
}
.select-data__row--selected,
.select-data__row--selected:hover {
  background: #e1f0ff;
}
.select-data__list .select-data__format {
  margin-top: 0px;
}
.select-data__del {
  cursor: pointer;
  margin-left: 5px;
}
.select-data__del:hover {
  color: #e5412c;
}
</style>

