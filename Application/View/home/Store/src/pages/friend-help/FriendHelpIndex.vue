<template>
  <ks-container v-if="loading">
    <ks-title name="好友助力" border="none"/>
    <div class="help-con">
      <el-tabs v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="好友助力管理" name="helpManage">
          <el-table :data="tableDataList" tooltip-effect="dark" style="width: 100%">
            <el-table-column prop="title" label="活动名称" align="center"></el-table-column>
            <el-table-column label="活动时间" align="center" min-width="170">
              <template slot-scope="scope">
                <span>{{formatTimestamp(scope.row.starttime*1000)}}-{{formatTimestamp(scope.row.endtime*1000)}}</span>
              </template>
            </el-table-column>
            <el-table-column prop="num" label="助力人数" align="center"></el-table-column>
            <el-table-column label="活动商品" align="center" min-width="100">
              <template slot-scope="scope">
                <el-dropdown placement="bottom">
                  <span class="el-dropdown-link">
                    {{scope.row.json.length}} 门课程
                    <i class="el-icon-arrow-down el-icon--right"></i>
                  </span>
                  <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item
                      v-for="(item,index) in scope.row.json"
                      :key="index"
                    >{{item.title}}</el-dropdown-item>
                  </el-dropdown-menu>
                </el-dropdown>
              </template>
            </el-table-column>
            <el-table-column prop="discount" label="折扣/免费" align="center"></el-table-column>
            <el-table-column label="完成任务人数" align="center">
              <template slot-scope="scope">
                <span>{{scope.row.finishnum}}/{{scope.row.initiatenum}}</span>
              </template>
            </el-table-column>
            <el-table-column prop="helpnum" label="参与助力人数" align="center"></el-table-column>
            <el-table-column label="状态" align="center">
              <template slot-scope="scope">
                <span>{{getStatus(scope.row.starttime,scope.row.endtime*1000)}}</span>
              </template>
            </el-table-column>
            <el-table-column label="上架" align="center">
              <template slot-scope="scope">
                <el-switch
                  v-model="scope.row.status"
                  active-value="1"
                  inactive-value="0"
                  active-color="#13ce66"
                  @change="changeStatus(scope.row.id)"
                ></el-switch>
              </template>
            </el-table-column>
            <el-table-column label="操作" align="center">
              <template slot-scope="scope">
                <el-dropdown trigger="click" placement="bottom">
                  <span class="table-operation">...</span>
                  <el-dropdown-menu slot="dropdown">
                    <router-link :to="`/friendhelp/add?id=${scope.row.id}`">
                      <el-dropdown-item>编辑</el-dropdown-item>
                    </router-link>
                    <span @click="handleDelHelp(scope.row.id)">
                      <el-dropdown-item>删除</el-dropdown-item>
                    </span>
                  </el-dropdown-menu>
                </el-dropdown>
              </template>
            </el-table-column>
          </el-table>
          <el-pagination
            background=""
            layout="prev, pager, next"
            :total="+dataListPage.totalput"
            @current-change="dataListHandleCurrentChange"
            class="table-page"
          ></el-pagination>
        </el-tab-pane>
        <el-tab-pane label="好友助力订单" name="helpOrder">
          <el-table :data="orderList" tooltip-effect="dark" style="width: 100%">
            <el-table-column prop="userid" label="用户ID" align="center"></el-table-column>
            <el-table-column prop="username" label="用户昵称" align="center"></el-table-column>
            <el-table-column prop="mobile" label="手机号" align="center"></el-table-column>
            <el-table-column prop="title" label="助力商品" align="center" min-width="220"></el-table-column>
            <el-table-column label="助力情况" align="center">
              <template slot-scope="scope">
                <span>{{scope.row.count}}/{{scope.row.num}}</span>
              </template>
            </el-table-column>
            <el-table-column prop="discount" label="折扣/免费" align="center"></el-table-column>
            <el-table-column label="折扣后是否有购买" align="center">
              <template slot-scope="scope">
                <span>{{scope.row.is_buy==0?"否":"是"}}</span>
              </template>
            </el-table-column>
            <el-table-column label="助力时间" align="center" min-width="170">
              <template slot-scope="scope">
                <span
                  v-if="scope.row.starttime"
                >{{formatTimestamp(scope.row.starttime*1000)}}-{{formatTimestamp(scope.row.endtime*1000)}}</span>
                <span v-else>&nbsp;</span>
              </template>
            </el-table-column>
            <el-table-column label="IP" align="center" min-width="120">
              <template slot-scope="scope">
                <span>{{scope.row.ip}}</span>
              </template>
            </el-table-column>
          </el-table>
          <el-pagination
            v-if="orderListPage"
            background=""
            layout="prev, pager, next"
            :total="+orderListPage.totalput"
            @current-change="orderListHandleCurrentChange"
            class="table-page"
          ></el-pagination>
        </el-tab-pane>
      </el-tabs>
      <div class="help-con-addhelp">
        <el-popover placement="bottom" width="200" trigger="click">
          <div v-if="activeName=='helpManage'">
            <span>状态 :</span>
            <span :class="activeStatusIndex==0?'active-status':''" @click="showStatusList(0)">不限</span>
            <span :class="activeStatusIndex==1?'active-status':''" @click="showStatusList(1)">已上架</span>
            <span :class="activeStatusIndex==2?'active-status':''" @click="showStatusList(2)">未上架</span>
          </div>
          <div v-else-if="activeName=='helpOrder'">
            <span>状态 :</span>
            <span
              :class="activeBuyStatusIndex==0?'active-status':''"
              @click="showBuyStatusList(0)"
            >不限</span>
            <span
              :class="activeBuyStatusIndex==1?'active-status':''"
              @click="showBuyStatusList(1)"
            >已购买</span>
            <span
              :class="activeBuyStatusIndex==2?'active-status':''"
              @click="showBuyStatusList(2)"
            >未购买</span>
          </div>
          <el-button slot="reference" type="primary" icon="iconfont icon-filter" size="small"></el-button>
        </el-popover>
        <el-button
          type="primary"
          icon="iconfont icon-plus"
          size="small"
          @click="addFriendHelp"
        >添加好友助力</el-button>
      </div>
    </div>
  </ks-container>
</template>

<script>
import {
  marketList,
  helpOrderList,
  changeHelp,
  delHelp
} from "@/api/friends.help";
export default {
  name: "FriendHelp",
  data() {
    return {
      loading: false,
      /**当前选项卡选择项 */
      activeName: "helpManage",
      /**当前状态索引 */
      activeStatusIndex: 0, //其它 不限 2未上架，1已上架,
      /**好友助力管理列表 */
      tableDataList: [],
      /**好友助力管理列表分页数据 */
      dataListPage: null,
      dataListCurrentPage: 1,
      /**当前购买状态索引 */
      activeBuyStatusIndex: 0, //其它 不限 2未购买，1已购买,
      /**好友助力订单列表 */
      orderList: [],
      /**好友助力订单列表分页数据 */
      orderListPage: null,
      orderListCurrentPage: 1
    };
  },
  computed: {
    /**格式化时间戳 */
    formatTimestamp() {
      /**
       * @param {Number} 时间戳
       */
      return function(time) {
        let data = new Date(parseInt(time));
        let y = data.getFullYear();
        let m = data.getMonth() + 1;
        let d = data.getDate();
        let h = data.getHours();
        let mm = data.getMinutes();
        let s = data.getSeconds();
        m = m < 10 ? "0" + m : m;
        d = d < 10 ? "0" + d : d;
        h = h < 10 ? "0" + h : h;
        mm = mm < 10 ? "0" + mm : mm;
        s = s < 10 ? "0" + s : s;
        // return y + "-" + m + "-" + d + " " + h + ":" + mm + ":" + s;
        return y + "-" + m + "-" + d;
      };
    },
    /**
     * 根据时间判断状态
     * @param {Number} 活动开始的时间戳
     * @param {Number} 活动结束的时间戳
     *  */
    getStatus() {
      return function(starttime, endtime) {
        let currentTime = new Date().getTime();
        if (starttime > currentTime) {
          return "未开始";
        } else if (currentTime > endtime) {
          return "已结束";
        } else {
          return "进行中";
        }
      };
    }
  },
  activated() {
    this.loading = false;
    this.activeName = "helpManage";
    this.marketList();
  },
  methods: {
    /**添加好友助力 */
    addFriendHelp() {
      this.$checkpower().then(() => {
        this.$router.push({
          name: "FriendHelpAdd"
        });
      });
    },
    /**选项卡选项改变时触发 */
    handleClick(tab, event) {
      if (this.activeName == "helpManage") {
        this.marketList();
      } else if (this.activeName == "helpOrder") {
        this.getHelpOrderList();
      }
    },
    /**根据当前状态显示列表 */
    showStatusList(index) {
      if (this.activeName == "helpManage") {
        this.activeStatusIndex = index;
        this.marketList({ status: index });
      }
    },
    /**根据当前购买状态显示列表 */
    showBuyStatusList(index) {
      if (this.activeName == "helpOrder") {
        this.activeBuyStatusIndex = index;
        this.getHelpOrderList({ is_buy: index });
      }
    },
    /**改变上架状态 */
    changeStatus(id) {
      changeHelp({ id: id }).then(res => {
        // console.log(res);
      });
    },
    /**删除好友助力活动 */
    handleDelHelp(id) {
      delHelp({ id }).then(res => {
        if ((res.result = "success")) {
          this.marketList({ status: this.activeStatusIndex });
        }
      });
    },
    /**好友助力管理列表页数发生变化时触发 */
    dataListHandleCurrentChange(value) {
      this.dataListCurrentPage = value;
      this.marketList({ p: value });
    },
    /** 好友助力订单列表页数发生变化时触发*/
    orderListHandleCurrentChange(value) {
      // console.log(value);
      this.orderListCurrentPage = value;
      this.getHelpOrderList({ p: value });
    },
    /**获取好友助力管理列表 */
    marketList(params) {
      let paramsDefault = {
        state: "",
        p: 1,
        maxperpage: 10
      };
      marketList({ ...paramsDefault, ...params }).then(res => {
        this.tableDataList = res.list;
        this.dataListPage = res.page;
        this.loading = true;
      });
    },
    /**获取好友助力订单列表 */
    getHelpOrderList(params) {
      let paramsDefault = {
        is_buy: "",
        p: 1,
        maxperpage: 10
      };
      helpOrderList({ ...paramsDefault, ...params }).then(res => {
        this.orderList = res.list;
        this.orderListPage = res.page;
      });
    }
  }
};
</script>

<style scoped>
.help-con {
  position: relative;
}
.help-con-addhelp {
  position: absolute;
  right: 0;
  top: -6px;
}
.active-status {
  color: #409eff;
}
.table-operation {
  width: 50px;
  font-size: 16px;
  font-weight: bold;
  position: relative;
  top: -5px;
}
.table-page {
  text-align: right;
  margin-top: 25px;
}
</style>
