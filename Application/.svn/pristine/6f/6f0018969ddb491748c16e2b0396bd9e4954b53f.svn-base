<template>
  <ks-container class="activity-regist">
    <ks-title name="活动报名"/>
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
        <el-popover placement="bottom-end" width="400" trigger="click">
          <div class="state">
            <div class="state__title">状态 :</div>
            <div class="state__content">
              <span :class="stateActive==0?'state__actived':''" @click="changeStateActive(0)">不限</span>
              <span :class="stateActive==1?'state__actived':''" @click="changeStateActive(1)">已发布</span>
              <span :class="stateActive==2?'state__actived':''" @click="changeStateActive(2)">未发布</span>
              <span :class="stateActive==3?'state__actived':''" @click="changeStateActive(3)">报名中</span>
              <span :class="stateActive==4?'state__actived':''" @click="changeStateActive(4)">进行中</span>
              <span :class="stateActive==5?'state__actived':''" @click="changeStateActive(5)">已结束</span>
            </div>
          </div>
          <el-button slot="reference" type="primary" icon="iconfont icon-filter" size="small"></el-button>
        </el-popover>
        <router-link to="/activityregist/addactivity" class="plus-link">
          <el-button type="primary" icon="iconfont icon-plus" size="small">添加活动</el-button>
        </router-link>
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
        <el-table-column label="活动名称" min-width="255">
          <template slot-scope="scope">
            <div>{{scope.row.name}}</div>
          </template>
        </el-table-column>
        <el-table-column prop="activityTime" label="活动时间" min-width="300" align="center"></el-table-column>
        <el-table-column prop="registrationNum" label="报名人数" align="center"></el-table-column>
        <el-table-column prop="registrationSuccess" label="报名成功" align="center"></el-table-column>
        <el-table-column prop="pending" label="待审核" align="center"></el-table-column>
        <el-table-column prop="share" label="分享" align="center">
          <i class="iconfont icon-fen-xiang table-share" @click="dialogVisible=true"></i>
        </el-table-column>
        <el-table-column label="状态" align="center">
          <template slot-scope="scope">
            <div>
              <span v-if="scope.row.state==1">已发布</span>
              <span v-else-if="scope.row.state==2" style="color:#E64A3B;">未发布</span>
              <span v-else-if="scope.row.state==3" style="color:#CCCCCC;">已结束</span>
              <span v-else-if="scope.row.state==4">报名中</span>
              <span v-else-if="scope.row.state==5">进行中</span>
            </div>
          </template>
        </el-table-column>
        <el-table-column label="操作" align="center">
          <template slot-scope="scope">
            <el-dropdown trigger="click" placement="bottom">
              <span class="table-operation">...</span>
              <el-dropdown-menu slot="dropdown">
                <router-link to="/activityregist/registrationmanage">
                  <el-dropdown-item class="dropdown-item">报名管理</el-dropdown-item>
                </router-link>
                <router-link to="/activityregist/signinmanage">
                  <el-dropdown-item class="dropdown-item">签到管理</el-dropdown-item>
                </router-link>
                <el-dropdown-item class="dropdown-item">取消活动</el-dropdown-item>
                <el-dropdown-item class="dropdown-item">预览</el-dropdown-item>
                <el-dropdown-item class="dropdown-item">编辑</el-dropdown-item>
                <el-dropdown-item class="dropdown-item">删除</el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <div class="footer">
      <el-button plain size="mini" class="delete-btn">
        <i class="iconfont icon-shanchu1"></i>
      </el-button>
      <el-pagination background layout="prev, pager, next" :total="10"></el-pagination>
    </div>
    <dialogShare
      :dialogVisible="dialogVisible"
      :shareObj="shareObj"
      @closeShare="dialogVisible=false"
    ></dialogShare>
  </ks-container>
</template>

<script>
import dialogShare from "./components/dialogShare";

export default {
  name: "ActivityRegistIndex",
  components: {
    dialogShare
  },
  
  data() {
    return {
      /**搜索类型 */
      region: "活动名称",
      /**搜索类型列表 */
      regionList: ["活动名称", "状态"],
      /**搜索关键字 */
      key: "",
      /**搜索状态 */
      stateActive: 0,
      /**表格显示数据 */
      tableDataList: [
        {
          name: "UCAN 2019 设计大会",
          activityTime: "2019-04-27 09:00:00—2019-04-28 09:00:00",
          registrationNum: 1158,
          registrationSuccess: 1100,
          pending: 50,
          share: "asdasdasd",
          state: "1" //1已发布 2未发布 3已结束 4报名中 5进行中
        },
        {
          name: "UCAN 2019 设计大会",
          activityTime: "2019-04-27 09:00:00—2019-04-28 09:00:00",
          registrationNum: 1158,
          registrationSuccess: 1100,
          pending: 50,
          share: "asdasdasd",
          state: "2" //1已发布 2未发布 3已结束 4报名中 5进行中
        },
        {
          name: "UCAN 2019 设计大会",
          activityTime: "2019-04-27 09:00:00—2019-04-28 09:00:00",
          registrationNum: 1158,
          registrationSuccess: 1100,
          pending: 50,
          share: "asdasdasd",
          state: "3" //1已发布 2未发布 3已结束 4报名中 5进行中
        }
      ],
      /**是否出现分享弹出框 */
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
    /**改变当前查询状态 */
    changeStateActive(index) {
      this.stateActive = index;
    },
    /**
     * 当选择项发生变化时会触发该事件
     */
    handleSelectionChange() {}
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
  text-align: right;
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
.plus-link {
  margin-left: 10px;
}
.table-share {
  font-size: 22px;
  color: #fc6b32;
  cursor: pointer;
}
.table-operation {
  display: inline-block;
  width: 50px;
  font-size: 16px;
  font-weight: bold;
}
.dropdown-item {
  text-align: center;
}

.footer {
  margin-top: 20px;
  display: flex;
  justify-content: space-between;
}
</style>
