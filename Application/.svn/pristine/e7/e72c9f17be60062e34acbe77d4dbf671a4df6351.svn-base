<template>
  <ks-container>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/activityregist' }">活动报名</el-breadcrumb-item>
      <el-breadcrumb-item>报名管理</el-breadcrumb-item>
    </el-breadcrumb>
    <el-row class="search-row">
      <el-col :span="16">
        <el-select v-model="region" size="small" class="search-select">
          <el-option v-for="(item,index) in regionList" :key="index" :value="item"></el-option>
        </el-select>
        <el-input v-model="key" size="small" class="search-input">
          <i slot="suffix" class="el-input__icon iconfont icon-sousuo"></i>
        </el-input>
      </el-col>
      <el-col :span="8" class="plus-col">
        <el-popover placement="bottom-end" width="230" trigger="click">
          <div class="state">
            <div class="state__title">状态 :</div>
            <div class="state__content">
              <span :class="stateActive==0?'state__actived':''" @click="changeStateActive(0)">不限</span>
              <span :class="stateActive==1?'state__actived':''" @click="changeStateActive(1)">报名成功</span>
              <span :class="stateActive==2?'state__actived':''" @click="changeStateActive(2)">作废</span>
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
        <el-button type="primary" size="small">导出Excle</el-button>
      </el-col>
    </el-row>
    <div>
      <el-table
        ref="multipleTable"
        :data="tableDataList"
        tooltip-effect="dark"
        style="width: 100%"
        @selection-change="handleSelectionChange"
      >
        <el-table-column type="selection" width="55"></el-table-column>
        <el-table-column label="头像昵称" min-width="150">
          <template slot-scope="scope">
            <div class="avatar">
              <img :src="scope.row.avatar" alt="">
              <span>{{scope.row.nickname}}</span>
            </div>
          </template>
        </el-table-column>
        <el-table-column prop="name" label="姓名" align="center" min-width="60"></el-table-column>
        <el-table-column prop="mobile" label="手机号" align="center" min-width="120"></el-table-column>
        <el-table-column prop="registrationTime" label="报名时间" min-width="150" align="center"></el-table-column>
        <el-table-column prop="ticketCate" label="票种" align="center"></el-table-column>
        <el-table-column label="价格" align="center" min-width="120">
          <template slot-scope="scope">
            <div>
              <span>{{scope.row.price}}</span>
              <span v-if="scope.row.deposit" style="color:#E64A3B;">( 定金 : ￥ {{scope.row.deposit}} )</span>
            </div>
          </template>
        </el-table-column>
        <el-table-column label="状态" align="center">
          <template slot-scope="scope">
            <div>
              <span v-if="scope.row.state==0">报名成功</span>
              <span v-else-if="scope.row.state==1">作废</span>
            </div>
          </template>
        </el-table-column>
        <el-table-column label="操作" align="center">
          <template slot-scope="scope">
            <el-dropdown trigger="click" placement="bottom">
              <span class="table-operation">...</span>
              <el-dropdown-menu slot="dropdown">
                <span @click="recoveryRegistration(scope.row.id)">
                  <el-dropdown-item>恢复</el-dropdown-item>
                </span>
                <span @click="invalidationRegistration(scope.row.id)">
                  <el-dropdown-item>作废</el-dropdown-item>
                </span>
              </el-dropdown-menu>
            </el-dropdown>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <div class="footer">
      <div>
        <el-button plain size="mini" class="delete-btn">
          <i class="iconfont icon-shanchu1" @click="deleteCurrentSelect"></i>
        </el-button>
        <el-button type="primary" size="small" @click="batchRecovery">批量恢复</el-button>
        <el-button plain size="small" @click="batchInvalidation">批量作废</el-button>
      </div>
      <el-pagination background="" layout="prev, pager, next" :total="10"></el-pagination>
    </div>
  </ks-container>
</template>

<script>
export default {
  name: "RegistrationManage",
  data() {
    return {
      /**搜索类型 */
      region: "姓名",
      /**搜索类型列表 */
      regionList: ["姓名", "手机号"],
      /**搜索关键字 */
      key: "",
      /**搜索状态 */
      stateActive: 0,
      /**表格显示数据 */
      tableDataList: [
        {
          id: "1",
          name: "张三",
          nickname: "berterny",
          avatar:
            "https://obj.kesion.com/Images/school/2/201903/823d7a846a613b884080591697c76ac4.jpg",
          mobile: "15999999999",
          registrationTime: "2019-04-27 09:00:00",
          ticketCate: "免费票",
          price: 0.0,
          deposit: 10,
          state: 0 //0成功 1作废
        },
        {
          id: "2",
          name: "张三",
          nickname: "berterny",
          avatar:
            "https://obj.kesion.com/Images/school/2/201903/823d7a846a613b884080591697c76ac4.jpg",
          mobile: "15999999999",
          registrationTime: "2019-04-27 09:00:00",
          ticketCate: "免费票",
          price: 10,
          state: 1 //0成功 1作废
        },
        {
          id: "3",
          name: "张三",
          nickname: "berterny",
          avatar:
            "https://obj.kesion.com/Images/school/2/201903/823d7a846a613b884080591697c76ac4.jpg",
          mobile: "15999999999",
          registrationTime: "2019-04-27 09:00:00",
          ticketCate: "免费票",
          price: 100,
          state: 0 //0成功 1作废
        }
      ],
      currentSelectRowList: []
    };
  },
  methods: {
    /**改变当前查询状态 */
    changeStateActive(index) {
      this.stateActive = index;
    },
    /**
     * 当选择项发生变化时会触发该事件
     */
    handleSelectionChange(val) {
      this.currentSelectRowList = val;
    },
    /**删除当前选中的 */
    deleteCurrentSelect() {
      this.currentSelectRowList.forEach(el => {
        let ind = this.tableDataList.findIndex(tabele => {
          return el.id == tabele.id;
        });
        this.tableDataList.splice(ind, 1);
      });
    },
    /**
     * 恢复报名
     * @param {Number} 判断选择的是哪一行数据
     *  */
    recoveryRegistration(index) {
      let ind = this.tableDataList.findIndex(el => {
        return el.id == index;
      });
      this.tableDataList[ind].state = 0;
    },
    /**
     * 作废报名
     * @param {Number} 判断选择的是哪一行数据
     *  */
    invalidationRegistration(index) {
      let ind = this.tableDataList.findIndex(el => {
        return el.id == index;
      });
      this.tableDataList[ind].state = 1;
    },
    /**批量恢复 */
    batchRecovery() {
      this.currentSelectRowList.forEach(el => {
        let ind = this.tableDataList.findIndex(tabele => {
          return el.id == tabele.id;
        });
        this.tableDataList[ind].state = 0;
      });
    },
    /**批量作废 */
    batchInvalidation() {
      this.currentSelectRowList.forEach(el => {
        let ind = this.tableDataList.findIndex(tabele => {
          return el.id == tabele.id;
        });
        this.tableDataList[ind].state = 1;
      });
    }
  }
};
</script>

<style scoped>
.search-row {
  padding: 20px 0;
}
.search-select {
  width: 120px;
}
.search-input {
  width: 380px;
  position: relative;
  padding-left: 10px;
}
.search-input i {
  cursor: pointer;
}
.plus-col {
  display: flex;
  justify-content: flex-end;
  align-items: flex-end;
}
.state {
  display: flex;
}
.state__content span {
  margin-left: 15px;
}
.state__actived {
  color: #409eff;
}
.filter {
  margin-right: 10px;
  height: 32px;
}
.avatar {
  display: flex;
  align-items: center;
}
.avatar img {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-right: 8px;
}
.table-operation {
  display: inline-block;
  width: 50px;
  font-size: 16px;
  font-weight: bold;
}

.footer {
  margin-top: 20px;
  display: flex;
  justify-content: space-between;
}
</style>
