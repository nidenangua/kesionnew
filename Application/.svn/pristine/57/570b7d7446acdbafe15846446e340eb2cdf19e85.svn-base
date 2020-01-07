<template>
  <div class="ks-pt30">
    <div class="clearfix">
      <el-input
        @change="getMaterialList()"
        placeholder="请输入搜索内容"
        v-model="keyword"
        class="ks-max-w-fit ks-fl"
      >
        <i
          class="el-icon-search el-input__icon ks-cursor-pointer"
          slot="suffix"
          @click="getMaterialList()"
        ></i>
      </el-input>
      <div class="ks-fr">
        <el-button type="primary" @click="updateWechatMater">从微信更新素材</el-button>
      </div>
    </div>
    <el-row
      v-masonry
      item-selector=".material-list__col"
      class="material-list"
      :gutter="20"
      v-if="list.length"
    >
      <el-col
        v-masonry-tile
        class="material-list__col"
        :span="6"
        v-for="item in list"
        :key="item.id"
      >
        <div class="material-list__item">
          <material-item :list="item.list" @click="selectMaterialItem(item)"></material-item>
          <div class="material-list__update_time">更新于{{item.update_time}}</div>
          <el-row class="material-list__operate">
            <el-col :span="12">
              <el-checkbox v-model="item.checked">选择</el-checkbox>
            </el-col>

            <el-col :span="12">
              <el-tooltip effect="dark" content="删除" placement="top">
                <i class="iconfont icon-shanchu1 ks-fz18" @click="deleteMaterial(item.id)"></i>
              </el-tooltip>
            </el-col>
          </el-row>
        </div>
      </el-col>
    </el-row>
    <div class="ks-empty" v-else-if="!list.length && loaded">没有找到任何数据</div>
    <div class="material-list__footer">
      <ks-table-footer
        v-if="list.length"
        :pagination="pagination"
        :table-data="list"
        @current-change="getMaterialList"
        @trigger="deleteMaterial"
      />
    </div>
  </div>
</template>
<script>
import MaterialItem from "./compoents/MaterialItem";
import { domap } from "@/utils";
import {
  wechatMaterialList,
  wechatMaterialCount,
  synchroMaterialList,
  deleteWechatMaterial
} from "@/api/wechat";
export default {
  name: "MaterialList",
  data() {
    return {
      keyword: "",
      pagination: {
        total: 0,
        current: 0
      },
      loaded: false,
      list: []
    };
  },
  methods: {
    /**
     * 获取素材列表
     */
    getMaterialList(p = 1) {
      this.loaded = false;
      this.$showLoading();
      wechatMaterialList({
        page: p,
        maxperpage: 12,
        keyword: this.keyword
      }).then(res => {
        if (res.result === "success") {
          domap(res.item, item => {
            item.checked = false;
          });
          this.list = res.item;
          this.pagination.total = res.page.total_pages;
          this.pagination.current = res.page.now_page;
        }
        this.loaded = true;
        this.$hideLoading();
      });
    },

    /**
     * 更新素材到本地
     */
    updateWechatMater() {
      wechatMaterialCount().then(res => {
        let count = 10; //每页数量
        let total_pages = Math.ceil(res.count.news_count / count);
        this.synchroMater(count, 0, total_pages, 1);
      });
    },
    /**
     * 轮询请求更新素材
     */
    synchroMater(count, offset, total, p) {
      synchroMaterialList({
        offset: offset,
        count: count
      }).then(res => {
        if (p < total) {
          this.$showProgress("正在更新", Math.ceil((100 / total) * p));
          this.synchroMater(count, offset + count, total, p + 1);
        } else {
          this.$showProgress("更新完成", 100);
          setTimeout(() => {
            this.$hideProgress();
            /**
             * 更新列表数据
             */
            this.getMaterialList();
          }, 500);
        }
      });
    },
    /**
     * 编辑
     */
    edit(id) {
      location.href = `/home.html/wechat/Index/tuWen/${id}?appid-23`;
    },
    /**
     * 打开链接
     */
    open(url) {
      location.href = url;
    },
    /**
     * 删除素材
     */
    deleteMaterial(ids) {
      this.$confirm("此操作将永久删除该素材, 是否继续?", "提示", {
        type: "warning"
      }).then(() => {
        deleteWechatMaterial({
          id: ids
        }).then(res => {
          if (res.result === "success") {
            this.$msg("删除成功", "success");
            /**
             * 更新素材列表
             */
            this.getMaterialList();
          } else {
            this.$msg(res.result);
          }
        });
      });
    }
  },
  mounted() {
    this.getMaterialList();
  },
  components: {
    MaterialItem
  }
};
</script>
<style scoped>
.material-list {
  overflow-x: hidden;
}

.material-list__item {
  margin-top: 20px;
  border: 1px solid #eee;
  border-radius: 4px;
  overflow: hidden;
}

.material-list__update_time {
  font-size: 14px;
  padding: 0 15px;
}
.material-list__update_time {
  color: #999;
  margin-top: 5px;
}

.material-list__operate {
  text-align: center;
  height: 40px;
  line-height: 40px;
  border-top: 1px solid #eee;
  margin-top: 10px;
  overflow: hidden;
}
.material-list__operate .el-col {
  border-left: 1px solid #eee;
}
.material-list__operate .el-col:first-child {
  border-left: 0px;
}
.material-list__operate .iconfont {
  display: block;
  cursor: pointer;
  color: #999;
}
.material-list__operate .iconfont:hover {
  color: #e5412c;
}

.material-list__footer {
  margin-top: 20px;
  border-top: 1px solid #eee;
  padding-top: 20px;
}
</style>


