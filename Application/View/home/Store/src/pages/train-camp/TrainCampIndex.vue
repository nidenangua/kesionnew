<template>
  <ks-container class="train-camp">
    <ks-title name="训练营"/>
    <div class="train-camp-header">
      <div class="train-camp-header__left">
        <el-select v-model="region" placeholder="训练营名称" size="small">
          <el-option v-for="item in tableData.options" :key="item.value" :value="item.label"></el-option>
        </el-select>
        <el-input v-model="key" size="small" class="train-camp-header-left__search" @change="search"></el-input>
        <i class="iconfont icon-sousuo train-camp-header-left__searchicon" @click="search"></i>
      </div>
      <div class="train-camp-header__right">
        <el-popover placement="bottom-end" width="400" trigger="click">
          <div class="train-camp-header-right__state">
            <div class="train-camp-header-right-state__title">状态 :</div>
            <div class="train-camp-header-right-state__content">
              <span class="train-camp-header-right-state-content-actived">不限</span>
              <span>已上架</span>
              <span>未上架</span>
            </div>
          </div>
          <el-button
            slot="reference"
            type="primary"
            icon="iconfont icon-filter"
            size="small"
            class="filter"
          ></el-button>
        </el-popover>
        <router-link to="/traincamp/addtraincamp">
          <el-button type="primary" icon="el-icon-plus" size="small">添加训练营</el-button>
        </router-link>
      </div>
    </div>
    <div class="train-camp-container">
      <el-table
        ref="multipleTable"
        :data="tableDataList"
        tooltip-effect="dark"
        style="width: 100%"
        @selection-change="handleSelectionChange"
      >
        <el-table-column type="selection" width="55"></el-table-column>
        <el-table-column label="训练营名称" prop="name"></el-table-column>
        <el-table-column prop="num" label="营期数"></el-table-column>
        <el-table-column prop="personNum" label="报名人数"></el-table-column>
        <el-table-column prop="price" label="价格"></el-table-column>
        <el-table-column prop="share" label="分享">
          <i class="train-camp__share iconfont icon-fen-xiang" @click="dialogVisible=true"></i>
        </el-table-column>
        <el-table-column label="是否发布">
          <template slot-scope="scope">
            <div>
              <el-switch v-model="scope.row.issue" active-color="#13ce66"></el-switch>
            </div>
          </template>
        </el-table-column>
        <el-table-column label="操作">
          <template slot-scope="scope">
            <el-dropdown trigger="click">
              <span class="el-dropdown-link train-camp-container__operate">...</span>
              <el-dropdown-menu slot="dropdown">
                <router-link to="/traincamp/campsiteindex">
                  <el-dropdown-item class="train-camp-container-operate__item">营期管理</el-dropdown-item>
                </router-link>
                <el-dropdown-item class="train-camp-container-operate__item">编辑</el-dropdown-item>
                <el-dropdown-item class="train-camp-container-operate__item">删除</el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <div class="train-camp-footer">
      <div class="train-camp-footer__left">
        <el-button plain size="small" class="train-camp-footer__delete">
          <i class="iconfont icon-shanchu1"></i>
        </el-button>
      </div>
      <div class="train-camp-footer__rigth">
        <el-pagination background="" layout="prev, pager, next" :total="10"></el-pagination>
      </div>
    </div>
    <dialogShare
      :dialogVisible="dialogVisible"
      :shareObj="shareObj"
      @closeShare="dialogVisible=false"
    ></dialogShare>
  </ks-container>
</template>
<script>
import dialogShare from "./components/dialogShare.vue";
export default {
  /**训练营列表 */
  name: "TrainCampIndex",
  components: {
    dialogShare
  },
  data() {
    return {
      /**
       * 训练营名称
       */
      region: "",
      /**
       * 搜索关键字
       */
      key: "",
      /**训练营数据列表 */
      tableData: {
        options: [
          {
            value: "选项1",
            label: "黄金糕"
          },
          {
            value: "选项2",
            label: "双皮奶"
          },
          {
            value: "选项3",
            label: "蚵仔煎"
          },
          {
            value: "选项4",
            label: "龙须面"
          },
          {
            value: "选项5",
            label: "北京烤鸭"
          }
        ]
      },
      tableDataList: [
        {
          name: "摄影学习",
          num: "3",
          personNum: "26785",
          price: "按期购买",
          share: "123456",
          issue: false
        }
      ],
      states: ["Alabama", "Alaska", "Arizona"],
      /**是否出现分享弹窗 */
      dialogVisible: false,
      /**分享方法 */
      shareObj: {
        way: "link",
        link: "http://t.cn/AipKRRyB",
        qrCode: ""
      }
    };
  },
  methods: {
    /**
     * 获取数据列表
     * @param {Number} 页码
     */
    getList(p = 1) {},
    /**
     * 当表格选择项发生变化时会触发该事件
     */
    handleSelectionChange() {},
    /**搜索 */
    search(){
      console.log("搜索");
    }
  }
};
</script>
<style scoped>
.train-camp-header {
  display: flex;
  justify-content: space-between;
  padding: 20px 0;
}
.train-camp-header__left {
  position: relative;
}
.train-camp-header-left__search {
  width: 350px;
}
.train-camp-header-left__searchicon {
  position: absolute;
  right: 5px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 14px;
  cursor: pointer;
  color: #c3c6ce;
}
.train-camp-header-right__state {
  display: flex;
}
.train-camp-header-right-state__title {
  margin: 0 30px;
}
.train-camp-header-right-state__content span {
  margin-right: 20px;
  cursor: pointer;
}
.train-camp-header-right-state-content-actived {
  color: #409eff;
}
.train-camp__share {
  font-size: 22px;
  color: #fc6b32;
  cursor: pointer;
}
.train-camp-container__operate {
  display: inline-block;
  width: 50px;
  font-size: 16px;
  font-weight: bold;
}
.train-camp-container-operate__item {
  text-align: center;
}
.train-camp-footer {
  margin: 20px 0;
  display: flex;
  justify-content: space-between;
}
.train-camp-footer__delete i {
  color: #606266;
  font-weight: bold;
  font-size: 14px;
}
.train-camp-header__right .filter {
  height: 32px;
  vertical-align: bottom;
}
</style>
