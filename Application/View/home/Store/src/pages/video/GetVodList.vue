<template>
  <div>
    <ks-container v-if="$route.query.action === 'list'">
      <ks-title name="媒资库" border="none">
        <div class="ks-fr ks-fz14 ks-info-color">
          剩余空间
          <span class="ks-color-primary">{{space}}</span>，剩余流量
          <span class="ks-color-primary">{{traffic}}</span>，剩余转码时间
          <span class="ks-color-primary">{{vodtrancode}}</span>
          <el-popover placement="top-start" title="说明" width="200" trigger="hover">
            <p class="vod-popover">
              空间详情：用于存储视频、图片等的空间。高级运营版空间无限时，建议及时升级。
              <br>流量：用于点播产生的视频流量
              <br>转码：用于视频上传后的转码费用
            </p>
            <i class="el-icon-info ks-color-warning ks-ml10" slot="reference"></i>
          </el-popover>
          <el-button
            class="ks-ml10"
            size="medium"
            @click="$router.push('/?url=/home.html/default/Shop/coludmanage/3')"
          >获空间扶持</el-button>
          <el-button
            size="medium"
            @click="$router.push('/?url=/home.html/default/Shop/coludmanage/4')"
          >购买流量</el-button>
          <el-button
            size="medium"
            @click="$router.push('/?url=/home.html/default/Shop/coludmanage/7')"
          >购买转码时长</el-button>
        </div>
      </ks-title>
      <div class="clearfix">
        <el-button class="ks-fr" type="primary" @click="handleCommand('tencent')" icon="el-icon-upload">本地上传</el-button>
        <!-- <el-dropdown class="ks-fr" @command="handleCommand">
          <el-button type="primary" icon="el-icon-upload">本地上传<i class="el-icon-arrow-down el-icon--right"></i></el-button>
          <el-dropdown-menu slot="dropdown">
            <el-dropdown-item command="tencent">腾讯云</el-dropdown-item>
            <el-dropdown-item command="polyv">保利威视</el-dropdown-item>
          </el-dropdown-menu>
        </el-dropdown> -->
        
        <el-input
          @change="getDataList()"
          placeholder="请输入视频标题搜索"
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
        <el-table
          class="ks-mt20"
          ref="listTable"
          :data="list"
          @selection-change="handleSelectionChange"
        >
          <el-table-column type="selection" width="55"></el-table-column>
          <el-table-column label="视频封面" width="160">
            <ks-create-bg width="120px" :ratio="9/16" slot-scope="scope" :src="scope.row.vdoImg"/>
          </el-table-column>
          <el-table-column prop="vdoName" label="视频标题"></el-table-column>
          <el-table-column width="120" prop="playtime" label="时长"></el-table-column>

          <el-table-column prop="vdoSize" label="大小" width="100"></el-table-column>
          <el-table-column prop="addDate" label="添加时间" width="200"></el-table-column>
          <el-table-column label="状态" width="120">
            <template slot-scope="scope">{{scope.row.status === 'normal' ? '正常' : '视频转码中'}}</template>
          </el-table-column>
          <el-table-column label="操作" width="80">
            <el-tooltip effect="dark" content="删除" placement="top" slot-scope="scope">
              <i class="iconfont icon-shanchu1 ks-cursor-pointer" @click="delVod(scope.row.id)"></i>
            </el-tooltip>
          </el-table-column>
        </el-table>
        <div class="vod-list-footer clearfix" style="padding:30px 14px 0 14px;">
          <div class="ks-fl">
            <el-checkbox v-model="selectAll" @change="$refs.listTable.toggleAllSelection()">全选</el-checkbox>
            <el-button @click="deleteItem">删除数据</el-button>
          </div>
          <div class="ks-fr">
            <el-pagination
              @current-change="getDataList"
              :current-page.sync="page"
              :page-count="pageCount"
              layout="prev, pager, next"
              background
            ></el-pagination>
          </div>
        </div>
      </div>
      <div class="ks-empty" v-else-if="loaded && !list.length">没有找到任何视频~</div>
    </ks-container>

    <div class="vod-list-container" v-else>
      <div class="vod-list-head clearfix">
        <el-button class="ks-fr" type="primary" @click="handleCommand('tencent')" icon="el-icon-upload">本地上传</el-button>
        <!-- <el-dropdown class="ks-fr" @command="handleCommand">
          <el-button type="primary" icon="el-icon-upload">本地上传<i class="el-icon-arrow-down el-icon--right"></i></el-button>
          <el-dropdown-menu slot="dropdown">
            <el-dropdown-item command="tencent">腾讯云</el-dropdown-item>
            <el-dropdown-item command="polyv">保利威视</el-dropdown-item>
          </el-dropdown-menu>
        </el-dropdown> -->
        <el-input
          @change="getDataList()"
          placeholder="请输入视频标题搜索"
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
        <div class="vod-list" :style="{height:windowHeight-185+'px'}">
          <el-row :gutter="25">
            <el-col :span="8" v-for="item in list" :key="item.id">
              <div class="vod-list__item" @click="current = item.id === current.id ? {} : item">
                <div class="ks-select-mask" v-show="item.id == current.id">
                  <i class="el-icon-check"></i>
                </div>
                <ks-create-bg :ratio="9/16" :src="item.vdoImg">
                  <div class="vod-list__tip" v-if="item.status !== 'normal'">视频转码中</div>
                  <div class="vod-list__time" v-else>{{item.playtime}}</div>
                </ks-create-bg>
                <div class="ks-fz14 vod-list__vdo_name">
                  <div class="ks-text-nowrap"><el-tag size="mini" effect="plain">腾讯云</el-tag> &nbsp; {{item.vdoName}}</div>
                </div>
              </div>
            </el-col>
          </el-row>
        </div>

        <div class="vod-list-footer clearfix">
          <div class="ks-fl">
            <el-button type="primary" :disabled="!current.id" @click="sure">确定</el-button>
            <el-button @click="cancel">取消</el-button>
          </div>
          <div class="ks-fr">
            <el-pagination
              @current-change="getDataList"
              :current-page.sync="page"
              :page-count="pageCount"
              layout="prev, pager, next"
              background
            ></el-pagination>
          </div>
        </div>
      </div>
      <div class="ks-empty" v-else-if="loaded && !list.length">没有找到任何视频~</div>
    </div>
  </div>
</template>
<script>

import {
  getVodList,
  updateVodListStatus,
  deleteVod,
  getVodSpaceAndTraffic
} from "@/api/tcvod";
export default {
  name: "GetVodList",
  data() {
    return {
      vodtrancode:"",
      /**
       * 列表加载状态
       */
      loaded: false,
      /**
       * 视频上传信息
       */
      vod: {
        fileName: "",
        progress: 0,
        visible: false
      },
      /**
       * 当前剩余空间和流量
       */
      space: "",
      traffic: "",
      /**
       * 当前选择的item
       */
      current: {},
      /**
       * 关键词
       */
      keyword: "",
      /**
       * 分页信息
       */
      page: 1,
      pageCount: 1,
      /**
       * 全选状态
       */
      selectAll: false,
      /**
       * 数据列表
       */
      list: [],
      /**
       * 窗口高度
       */
      windowHeight: window.innerHeight,
      /**
       * 已选列表
       */
      selectedList: []
    };
  },

  methods: {
    /**
     * 选择变化
     */
    handleSelectionChange(data) {
      if (data.length === this.list.length) {
        this.selectAll = true;
      } else {
        this.selectAll = false;
      }
      this.selectedList = data;
    },
    /**
     * 获取数据列表
     */
    getDataList(p = 1) {
      this.$showLoading();
      getVodList({
        p: p,
        maxperpage: 9,
        keyword: this.keyword
      }).then(res => {
        this.list = res.list;
        this.page = res.page.now_page;
        this.pageCount = res.page.total_pages;
        this.loaded = true;
        this.updateVod();
        this.$hideLoading();
      });
    },
    /**
     * 取消关闭窗口
     */
    cancel() {
      /**
       * 兼容旧版popup
       */
      if (this.$route.query.from === "popup") {
        top.closePopup(window.name);
      } else {
        this.$emit("cancel");
      }
    },

    /**
     * 更新视频
     */
    updateVod() {
      let ids = [];
      this.list.map(item => {
        let reg = /^PROCESSING$/i;
        if (reg.test(item.status)) {
          ids.push(item.id);
        }
      });

      if (!ids.length) {
        return false;
      }

      updateVodListStatus({
        vdoService: 10,
        ids: ids.join(",")
      }).then(res => {
        if (res.result === "success") {
          let reg = /^NORMAL$/i;
          res.list.map(a => {
            if (reg.test(a.status)) {
              this.list.map(b => {
                if (b.id == a.id) {
                  b.status = a.status;
                  b.playtime = a.playtime;
                  b.vdoImg = a.vdoImg;
                  b.vdoSize = a.vdoSize;
                }
              });
            }
          });
          setTimeout(() => {
            this.updateVod();
          }, 5000);
        }
      });
    },
    /**
     * 确定
     */
    sure() {
      /**
       * 兼容旧版popup
       */
      if (this.$route.query.from === "popup") {
        let fn = top.popup.data(window.name);
        if (typeof fn === "function") {
          fn(this.current.vdoName, this.current.vdoId);
        }
        top.closePopup(window.name);
      } else {
        this.$emit("sure", this.current);
      }
    },
    handleCommand(e){
      switch(e){
        case 'tencent':
          top.KS_UploadVideoFile({
            type:'tencent',
            onUploaded:res=>{
              this.$msg("上传成功", "success");
              this.getDataList();
            }
          })
          break
        case 'polyv':
          this.$msg('正在整合中，即将开放')
          return
          top.KS_UploadVideoFile({
            type:'polyv',
            onUploaded:res=>{
              console.log(res)
            }
          })
          break
      }
    },

    /**
     * 删除视频
     */
    delVod(ids) {
      this.$confirm("此操作将永久删除该文件, 是否继续?", "提示", {
        type: "warning"
      }).then(() => {
        this.$showLoading();
        deleteVod({
          ids: ids
        }).then(res => {
          this.$msg(res.msg, res.result);
          if (res.result === "success") {
            this.$hideLoading();
            this.getDataList();
          }
        });
      });
    },
    /**
     * 删除
     */
    deleteItem() {
      let ids = [];
      this.selectedList.map(item => {
        ids.push(item.id);
      });
      if (ids.length) {
        this.delVod(ids.join());
      } else {
        this.$msg("请先选择要删除的视频");
      }
    },
    /**
     * 打开连接
     */
    open(url) {
      location.href = url;
    }
  },
  mounted() {
    this.getDataList();
    if (this.$route.query.action === "list") {
      /**
       * 获取空间与流量
       */
      getVodSpaceAndTraffic().then(res => {
        this.space = res.space;
        this.traffic = res.traffic;
        this.vodtrancode = res.vodtrancode
      });
    }
    window.addEventListener("resize", () => {
      this.windowHeight = window.innerHeight;
    });
  }
};
</script>
<style scoped>
.vod-popover {
  line-height: 22px;
  font-size: 14px;
  color: #666;
}

.vod-list-container {
  padding: 20px 0;
  background: #fff;
}
.vod-list-head,
.vod-list-footer {
  padding: 0 20px;
}
.vod-list-footer {
  padding-top: 25px;
}
.vod-list {
  overflow-x: hidden;
  overflow-y: auto;
  padding: 0 20px 20px 20px;
  margin-top: 20px;
}
.vod-list__item {
  box-shadow: 0 1px 12px rgba(0, 0, 0, 0.06);
  position: relative;
  margin-top: 20px;
}
.vod-list__item .ks-create-bg {
  border-radius: 0px;
}
.vod-list__tip,
.vod-list__time {
  height: 20px;
  line-height: 20px;
  position: absolute;
  bottom: 0;
  right: 0;
  color: #fff;
  padding: 0 6px;
}
.vod-list__tip {
  background: #4280e6;
}
.vod-list__time {
  background: rgba(0, 0, 0, 0.6);
}
.vod-list__vdo_name {
  padding: 10px;
}
.ks-color-primary {
  color: #fc6b32!important;
}
</style>
