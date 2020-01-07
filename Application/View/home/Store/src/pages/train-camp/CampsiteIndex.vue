<template>
  <ks-container class="campsite-index">
    <el-breadcrumb separator="/" class="campsite-index__breadcrumb">
      <el-breadcrumb-item :to="{ path: '/traincamp' }">训练营</el-breadcrumb-item>
      <el-breadcrumb-item>营期管理</el-breadcrumb-item>
    </el-breadcrumb>
    <div class="train-camp-box">
      <div class="train-camp-box__name">
        <div class="train-camp-box__title">摄影学习零基础训练营</div>
        <div>
          <el-tooltip class="item" effect="dark" content="编辑" placement="bottom">
            <el-button plain icon="iconfont icon-bianji4" size="mini"></el-button>
          </el-tooltip>
          <el-tooltip class="item" effect="dark" content="删除" placement="bottom">
            <el-button plain icon="iconfont icon-shanchu1" size="mini"></el-button>
          </el-tooltip>
        </div>
      </div>
      <div class="train-camp-box__des">
        知识分类 :
        <span>生活兴趣</span>
        营期数 ：
        <span>7</span>
        报名人数 ：
        <span>65894</span>
      </div>
    </div>
    <div class="train-camp-header">
      <div class="train-camp-header__left">
        <el-select v-model="region" placeholder="训练营营期名称" size="small">
          <el-option v-for="item in tableData.options" :key="item.value" :value="item.label"></el-option>
        </el-select>
        <el-input v-model="key" size="small" class="train-camp-header-left__search"></el-input>
        <i class="iconfont icon-sousuo train-camp-header-left__searchicon"></i>
      </div>
      <div class="train-camp-header__right">
        <el-popover placement="bottom-end" width="400" trigger="click">
          <div class="train-camp-header-right__state">
            <div class="train-camp-header-right-state__title">状态 ：</div>
            <div class="train-camp-header-right-state__content">
              <span class="train-camp-header-right-state-content-actived">不限</span>
              <span>待招生</span>
              <span>待开课</span>
              <span>上课中</span>
              <span>已结束</span>
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
        <el-button
          type="primary"
          icon="el-icon-plus"
          size="small"
          @click="centerDialogVisible = true"
        >添加营期</el-button>
      </div>
    </div>
    <el-dialog title="添加营期" :visible.sync="centerDialogVisible" width="40%" center>
      <!-- <span>需要注意的是内容是默认不居中的</span> -->
      <el-radio v-model="addRadio" label="1">复用已有的营期</el-radio>
      <div class="dialog-select">
        <el-select v-model="region" size="small">
          <el-option v-for="item in tableData.options" :key="item.value" :value="item.label"></el-option>
        </el-select>
      </div>
      <el-radio v-model="addRadio" label="2">不需要，我要新建一个新的营期</el-radio>
      <span slot="footer" class="dialog-footer">
        <el-button @click="centerDialogVisible = false">取 消</el-button>
        <el-button type="primary" @click="handleConfirm">确 定</el-button>
      </span>
    </el-dialog>
    <div class="train-camp-container">
      <el-table
        ref="multipleTable"
        :data="tableDataList"
        tooltip-effect="dark"
        style="width: 100%"
        @selection-change="handleSelectionChange"
      >
        <el-table-column type="selection" width="55"></el-table-column>
        <el-table-column label="营期名称" prop="name"></el-table-column>
        <el-table-column prop="price" label="价格"></el-table-column>
        <el-table-column prop="personNum" label="报名人数"></el-table-column>
        <el-table-column prop="num" label="营期目录"></el-table-column>
        <el-table-column label="上课状态">
          <template slot-scope="scope">
            <div>
              <span v-if="scope.row.state==1">
                <span class="train-camp-container__point" style="background-color:#F28550;"></span>待招生
              </span>
              <span v-if="scope.row.state==2">
                <span class="train-camp-container__point" style="background-color:#E5412C;"></span>待开课
              </span>
              <span v-if="scope.row.state==3">
                <span class="train-camp-container__point" style="background-color:#37A7ED;"></span>上课中
              </span>
              <span v-if="scope.row.state==4">
                <span class="train-camp-container__point" style="background-color:#CCC"></span>已结束
              </span>
            </div>
          </template>
        </el-table-column>
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
                <router-link to="/traincamp/campsitelist">
                  <el-dropdown-item class="train-camp-container-operate__item">营期目录</el-dropdown-item>
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
          name: "摄影学习零基础训练营第1期",
          num: "10",
          state: "1",
          personNum: "26785",
          price: "免费",
          share: "123456",
          issue: false
        }
      ],
      states: ["Alabama", "Alaska", "Arizona"],
      /**营期选择弹框 */
      centerDialogVisible: false,
      /**添加营期方式 */
      addRadio: "1",
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
     * 当选择项发生变化时会触发该事件
     */
    handleSelectionChange() {},
    /**点击确定之后执行的方法 */
    handleConfirm() {
      this.centerDialogVisible = false;
      if (this.addRadio == 2) {
        this.$router.push("/traincamp/addcampsite");
      }
    }
  }
};
</script>

<style scoped>
.campsite-index__breadcrumb {
  border-bottom: 1px solid #eee;
  padding-bottom: 20px;
}
.train-camp-box {
  margin: 20px 0;
  border: 1px solid #eee;
  padding: 12px 15px;
}
.train-camp-box__name {
  width: 100%;
  display: flex;
  justify-content: space-between;
}
.train-camp-box__title {
  font-size: 16px;
  font-weight: bold;
}
.train-camp-box__des {
  margin-top: 20px;
  color: #999;
}
.train-camp-box__des span {
  margin-right: 20px;
}
.train-camp-header {
  display: flex;
  justify-content: space-between;
  padding: 20px 0;
}
.train-camp-header__left {
  position: relative;
}
.train-camp-header-left__search {
  width: 400px;
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
  margin: 0 20px;
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
.train-camp-container__point {
  display: inline-block;
  width: 5px;
  height: 5px;
  border-radius: 50%;
  background-color: #ccc;
  margin-right: 3px;
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
.dialog-select {
  padding-left: 20px;
  margin: 10px 0;
}
.train-camp-header__right .filter {
  height: 32px;
  vertical-align: bottom;
}
</style>
