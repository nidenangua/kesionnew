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
        <el-button
          type="primary"
          icon="el-icon-plus"
          @click="open('/home.html/wechat/Index/tuWen?appid-23')"
        >新增素材</el-button>
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
        :span="8"
        v-for="item in list"
        :key="item.id"
      >
        <div class="material-list__item">
          <material-item :list="item.list" @click="selectMaterialItem(item)">
            <div class="ks-select-mask" v-show="item.checked" slot="prepend">
              <i class="el-icon-check"></i>
            </div>
          </material-item>
        </div>
      </el-col>
    </el-row>
    <div class="ks-empty" v-else-if="!list.length && loaded">没有找到任何数据</div>

    <div class="clearfix">
      <div class="ks-fl">
        <el-button type="primary" @click="sure" :disabled="chooice ? false : true">确定</el-button>
        <el-button @click="$emit('cancel')">取消</el-button>
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
import MaterialItem from "./MaterialItem";
import {
  wechatMaterialList,
  wechatMaterialCount,
  synchroMaterialList
} from "@/api/wechat";
export default {
  name: "SelectMaterial",
  data() {
    return {
      /**
       * 加载情况
       */
      loaded: false,
      chooice: null,
      keyword: "",
      /**
       * 分页
       */
      pageCount: 1,
      page: 1,
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
          res.item.map(item => {
            item.checked = false;
          });
          this.list = res.item;
          this.pageCount = res.page.total_pages;
          this.page = res.page.now_page;
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
     * 打开链接
     */
    open(url) {
      location.href = url;
    },
    /**
     * 选择素材
     */
    selectMaterialItem(item) {
      this.list.map(material => {
        material.checked = false;
      });
      this.chooice = item;
      item.checked = true;
    },
    /**
     * 确认选择
     */
    sure() {
      this.$emit("selected", this.chooice);
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
.material-list-select {
  margin-top: 20px;
  border-top: 1px solid #eee;
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
</style>


