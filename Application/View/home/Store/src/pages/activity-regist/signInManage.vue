<template>
  <ks-container v-if="loading">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item>活动报名</el-breadcrumb-item>
      <el-breadcrumb-item>签到管理</el-breadcrumb-item>
    </el-breadcrumb>
    <el-row class="search-row">
      <el-col :span="15">
        <el-select v-model="region" size="small" class="search-select">
          <el-option v-for="(item,index) in regionList" :key="index" :value="item"></el-option>
        </el-select>
        <el-input v-model="key" size="small" class="search-input" @change="search">
          <i slot="suffix" class="el-input__icon iconfont icon-sousuo" @click="search"></i>
        </el-input>
      </el-col>
      <el-col :span="9" class="plus-col">
        <div
          class="sign-state"
        >报名成功 : {{success_num}} &nbsp; 已签到 : {{sign_num}} &nbsp; 未签到 : {{nosign_num}}</div>
        <el-popover placement="bottom-end" width="330" trigger="click" v-model="showPopover">
          <div class="state">
            <div class="state__title">状态 :</div>
            <div class="state__content">
              <span :class="stateActive==-1?'state__actived':''" @click="changeStateActive(-1)">不限</span>
              <span :class="stateActive==0?'state__actived':''" @click="changeStateActive(0)">未审核</span>
              <span :class="stateActive==1?'state__actived':''" @click="changeStateActive(1)">已审核</span>
              <span :class="stateActive==2?'state__actived':''" @click="changeStateActive(2)">被拒绝</span>
              <span :class="stateActive==3?'state__actived':''" @click="changeStateActive(3)">已出票</span>
            </div>
          </div>
          <div class="state">
            <div class="state__title">签到 :</div>
            <div class="state__content">
              <span
                :class="signStateActive==-1?'state__actived':''"
                @click="changeSignStateActive(-1)"
              >不限</span>
              <span
                :class="signStateActive==0?'state__actived':''"
                @click="changeSignStateActive(0)"
              >未签到</span>
              <span
                :class="signStateActive==1?'state__actived':''"
                @click="changeSignStateActive(1)"
              >已签到</span>
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
        <el-button type="primary" size="small" @click="dialogTableVisible=true">二维码签到</el-button>
      </el-col>
    </el-row>
    <div>
      <el-table ref="multipleTable" :data="tableDataList" style="width: 100%">
        <el-table-column label="头像昵称" min-width="100">
          <template slot-scope="scope">
            <div class="avatar">
              <img :src="scope.row.head">
              <span>{{scope.row.name}}</span>
            </div>
          </template>
        </el-table-column>
        <el-table-column prop="json.form[0].content" label="姓名" align="center" min-width="60"></el-table-column>
        <el-table-column prop="json.form[1].content" label="手机号" align="center" min-width="120"></el-table-column>
        <el-table-column prop="ticket_info.title" label="票种" align="center"></el-table-column>
        <el-table-column prop="deposit" label="价格" align="center" min-width="120">
          <template slot-scope="scope">
            <div>
              <span>{{scope.row.ticket_info.chargetype==0?'0.00':scope.row.ticket_info.price}}</span>
              <span style="color:#E64A3B;">( 定金 : ￥ {{scope.row.json.cash_deposit || "0.00"}} )</span>
            </div>
          </template>
        </el-table-column>
        <el-table-column prop="json.number" label="票号" align="center" min-width="120">
          <!-- <template slot-scope="scope">
            <div v-for="(item,index) in scope.row.json.number" :key="index">{{item}}</div>
          </template>-->
          <template slot-scope="scope">
            <el-dropdown placement="bottom">
              <span class="el-dropdown-link">
                {{scope.row.json.num}} 张票
                <i class="el-icon-arrow-down el-icon--right"></i>
              </span>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item v-for="(item,index) in scope.row.json.number" :key="index">{{item}}</el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </template>
        </el-table-column>
        <el-table-column label="报名时间" min-width="150" align="center">
          <template slot-scope="scope">
            <div
              v-if="scope.row.adddate"
            >
            <!-- {{formatTimestamp(scope.row.ticket_info.order_date[0])}} {{formatTimestamp(scope.row.ticket_info.order_date[1])}} -->
            {{formatTimestamp(scope.row.adddate*1000)}}
            </div>
            <div v-else>---</div>
          </template>
        </el-table-column>
        <el-table-column label="签到时间" min-width="150" align="center">
          <template slot-scope="scope">
            <div
              v-if="scope.row.sign_date != 0"
            >{{formatTimestamp(scope.row.sign_date*1000)}}</div>
            <div v-else>---</div>
          </template>
        </el-table-column>
        <el-table-column label="签到状态" align="center">
          <template slot-scope="scope">
            <div>
              <span v-if="scope.row.is_sign==1">已签到</span>
              <span v-else style="color:#E64A3B;">未签到</span>
            </div>
          </template>
        </el-table-column>
        <el-table-column label="审核状态" align="center">
          <template slot-scope="scope">
            <div>
              <span v-if="scope.row.status==0" style="color:#E64A3B;">未审核</span>
              <span v-else-if="scope.row.status==1 && scope.row.ticket_info.check == 1">已审核</span>
              <span v-else-if="scope.row.status==1 && scope.row.ticket_info.check == 0">不需要审核</span>
              <span v-else-if="scope.row.status==2" style="color:#E64A3B;">被拒绝</span>
              <span v-else-if="scope.row.status==3 && scope.row.ticket_info.check == 1">已审核</span>
              <span v-else-if="scope.row.status==3 && scope.row.ticket_info.check == 0">不需要审核</span>
            </div>
          </template>
        </el-table-column>
        <el-table-column label="报名状态" align="center">
          <template slot-scope="scope">
            <div>
              <div v-if="scope.row.ticket_info.chargetype == 1">
                <span v-if="scope.row.paystatus == 1">报名成功</span>
                <span v-else>未支付</span>
              </div>
              <div v-else>
                <span v-if="scope.row.status==3">报名成功</span>
                <span v-else-if="scope.row.status==0">---</span>
                <span v-if="scope.row.status==2" style="color:#E64A3B;">报名失败</span>
              </div>
            </div>
          </template>
        </el-table-column>
        <el-table-column label="操作" align="center">
          <template slot-scope="scope">
            <el-dropdown trigger="click" placement="bottom">
              <span class="table-operation">...</span>
              <el-dropdown-menu slot="dropdown">
                <span @click="setSignIn(scope.row)" v-if="scope.row.is_sign==1">
                  <el-dropdown-item>取消签到</el-dropdown-item>
                </span>
                <span @click="setSignIn(scope.row)" v-else>
                  <el-dropdown-item>恢复签到</el-dropdown-item>
                </span>
                <template v-if="scope.row.status==0">
                  <span @click="passCheck(scope.row.id)">
                    <el-dropdown-item>通过审核</el-dropdown-item>
                  </span>
                  <span @click="rejectCheck(scope.row.id)">
                    <el-dropdown-item>拒绝审核</el-dropdown-item>
                  </span>
                </template>
              </el-dropdown-menu>
            </el-dropdown>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <div class="footer">
      <el-pagination
        layout="prev, pager, next"
        background=""
        :total="+page.totalput"
        :current-page.sync="currentPage"
        @current-change="handleCurrentChange"
      ></el-pagination>
    </div>
    <el-dialog title="二维码签到" :visible.sync="dialogTableVisible" width="40%" center>
      <div class="qr-code">
        <img :src="qrcode">
        <div class="save">
          <p>用于线下扫码签到 , 右键保存图片</p>
          <p>
            <a :href="qrcode" download="qrcode">点击下载可打印大图</a>
          </p>
        </div>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogTableVisible = false" size="small">取 消</el-button>
      </span>
    </el-dialog>
  </ks-container>
</template>

<script>
import {
  getActivityList,
  activitySignStatus,
  activityCheck
} from "@/api/microportal";
export default {
  name: "signInManage",
  data() {
    return {
      loading: false,
      /**搜索类型 */
      region: "昵称",
      /**搜索类型列表 */
      regionList: ["昵称", "手机号"],
      /**搜索关键字 */
      key: "",
      /**报名成功 */
      success_num: "",
      /**已签到 */
      sign_num: "",
      /**未签到 */
      nosign_num: "",
      /**是否显示选择状态弹出框 */
      showPopover: false,
      /**搜索状态 */
      stateActive: -1,
      /** 签到状态 */
      signStateActive: -1,
      /**表格显示数据 */
      tableDataList: [],
      /**是否出现二维码签到弹窗 */
      dialogTableVisible: false,
      /**分页数据 */
      page: null,
      /**当前页数 */
      currentPage: 1,
      /**二维码地址 */
      qrcode: ""
    };
  },
  computed: {
    /**格式化时间 */
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
        return y + "-" + m + "-" + d + " " + h + ":" + mm + ":" + s;
      };
    }
  },
  activated() {
    this.getSignList();
  },
  methods: {
    /**搜索 */
    search() {
      let params = {
        keywordtype: this.regionList.indexOf(this.region) + 1,
        keyword: this.key
      };
      this.getSignList(params);
    },
    /**选择搜索状态 */
    changeStateActive(index) {
      this.stateActive = index;
      index == -1 ? (index = "") : index;
    },
    /**选择签到状态 */
    changeSignStateActive(index) {
      this.signStateActive = index;
      index == -1 ? (index = "") : index;
      this.getSignList({
        is_sign: index,
        status: this.stateActive != -1 || ""
      });
      this.showPopover = false;
    },
    /**取消签到/设置签到 */
    setSignIn(item) {
      activitySignStatus({ id: item.id }).then(res => {
        if ((res.result = "success")) {
          this.getSignList({ p: this.currentPage });
        }
      });
    },
    /**通过审核 */
    passCheck(id) {
      activityCheck({ id, status: 1 }).then(res => {
        if ((res.result = "success")) {
          this.getSignList({ p: this.currentPage });
        }
      });
    },
    /**拒绝审核 */
    rejectCheck(id) {
      activityCheck({ id, status: 2 }).then(res => {
        if ((res.result = "success")) {
          this.getSignList({ p: this.currentPage });
        }
      });
    },
    /**当前页发生改变时触发 */
    handleCurrentChange(val) {
      this.getSignList({ p: val });
    },
    /**获取签到列表 */
    getSignList(params) {
      let paramsDefault = {
        p: 1,
        maxperpage: 10,
        courseid: this.$route.query.id,
        is_home: 1
      };
      getActivityList({ ...paramsDefault, ...params }).then(res => {
        // console.log(res.list);
        this.success_num = res.success_num;
        this.sign_num = res.sign_num;
        this.nosign_num = res.nosign_num;
        this.tableDataList = res.list;
        this.page = res.page;
        this.qrcode = res.qrcode;
        this.loading = true;
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
.sign-state {
  display: inline-block;
  height: 32px;
  line-height: 32px;
  padding: 0 10px;
  font-size: 13px;
  color: #686a6c;
}
.state {
  display: flex;
  line-height: 1.5;
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
  justify-content: flex-end;
}
.qr-code {
  display: flex;
  justify-content: center;
}
.qr-code img {
  width: 200px;
  height: 200px;
  margin-right: 30px;
  background-color: #686a6c;
}
.qr-code .save {
  display: flex;
  flex-direction: column;
  justify-content: center;
  flex-wrap: wrap;
}
.qr-code .save p {
  width: 100%;
  color: #686a6c;
  font-size: 12px;
  line-height: 40px;
}
.qr-code .save p a {
  color: #e64a3b;
  text-decoration: underline;
}
</style>
