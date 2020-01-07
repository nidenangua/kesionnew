<template>
  <div v-if="loading">
    <ks-tabs v-model="tabActive" @tab-click="handleClick">
      <ks-tab-pane
        v-for="(item,index) in tabList"
        :key="index"
        :label="item.label"
        :name="item.name"
      ></ks-tab-pane>
    </ks-tabs>
    <ks-page-scroll-container
      :page="p"
      :page-count="pageCount"
      @page-change="getPageList"
      v-if="list.length"
    >
      <div class="myactivity" v-for="(item,index) in list" :key="index">
        <div class="ks-bg-white myactivity-list">
          <div class="ks-row">
            <!-- 订单头部 -->
            <img class="myactivity-list__img ks-col-8" :src="item.defaultpic">
            <div class="ks-col-13 ks-fz14">
              课程活动：{{item.course_title}}
              <div v-if="!item.ticket_info" style="color:red;">该活动已被删除</div>
            </div>
            <div v-if="item.ticket_info">
              <img
                v-if="activeProcess(item.ticket_info.order_date)==0"
                class="ks-col-3"
                src="@/m/assets/activity/activestate2.png"
              >
              <img
                v-else-if="activeProcess(item.ticket_info.order_date)==1"
                class="ks-col-3"
                src="@/m/assets/activity/activestate1.png"
              >
              <img
                v-else-if="activeProcess(item.ticket_info.order_date)==2"
                class="ks-col-3"
                src="@/m/assets/activity/activestate3.png"
              >
            </div>
          </div>
        </div>
        <!-- 圆角分割线 -->
        <div v-if="item.ticket_info" class="myactivity-split__line">
          <div class="myactivity-left__cirle"></div>
          <div class="myactivity-right__cirle"></div>
          <div class="myactivity-middle__line ks-line"></div>
        </div>
        <div class="myactivity-info" v-if="item.ticket_info">
          <div class="myactivity-info__title">
            {{item.ticket_info.title}}
            <span>{{item.ticket_info.chargetype==0?"免费":"￥"+item.ticket_info.price}} {{item.is_pledge==1?`(保证金￥${item.ticket_info.cash_deposit})`:""}}</span>
          </div>
          <div class="ks-pt10">报名时间：{{formatTimestamp(item.adddate*1000)}}</div>
          <div
            class="ks-pt10"
          >有效时间：{{formatTimestamp(item.ticket_info.effective_date[0],"style2")}} - {{formatTimestamp(item.ticket_info.effective_date[1],"style2")}}</div>
          <div
            class="ks-pt10"
          >参加人：{{item.json.form[0].content}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{item.json.form[1].content}}</div>
          <div class="ks-pt10">张数：{{item.json.num}} 张</div>
        </div>
        <div class="myactivity-split__line">
          <div class="myactivity-left__cirle"></div>
          <div class="myactivity-right__cirle"></div>
          <div class="myactivity-middle__line ks-line"></div>
        </div>
        <div class="myactivity-state">
          <div>
            状态：
              <span v-if="item.status==0" class="check-pedding">未审核</span>
              <!-- <span v-else-if="item.status==1 && item.paystatus==0">已审核</span> -->
              <span v-else-if="item.status==2" class="check-pedding">被拒绝</span>
              <span v-else-if="item.status==3" class="check-pedding">成功</span>
              <span class="check-pedding" v-else>待支付</span>
          </div>
          <div class="myactivity-state__btnright" v-if="item.ticket_info">
            <div v-if="item.status==0">
              <ks-button size="small" @click="cancelRegistration(item)" round>取消报名</ks-button>
            </div>
            <router-link
              :to="{name:'CheckTickets',query:{id:item.id}}"
              v-if="(item.status==1 && item.paystatus==1)||item.status==3"
            >
              <ks-button size="small" round>查看票券</ks-button>
            </router-link>
            <div v-if="item.status==1 && item.paystatus==0">
              <ks-button size="small" round @click="deleteOrder(item)">删除订单</ks-button>
              <ks-button
                v-if="item.ticket_info"
                type="primary"
                size="small"
                @click="payNow(item)"
                round
              >立即支付</ks-button>
            </div>
          </div>
        </div>
      </div>
    </ks-page-scroll-container>
    <ks-empty type="nolesson" :msg="'没有任何活动哦~'" v-else/>
  </div>
</template>
<script>
import { getActivityList, delSign, delSignOrder } from "@/api/microportal";
export default {
  name: "MyActivity",
  data() {
    return {
      loading: false,
      tabList: [
        {
          label: "全部",
          name: "-1"
        },
        {
          label: "未审核",
          name: "4"
        },
        {
          label: "已审核",
          name: "1"
        },
        {
          label: "被拒绝",
          name: "2"
        },
        {
          label: "成功",
          name: "3"
        }
      ],
      /**列表数据 */
      list: [],
      /**当前选中的tab */
      tabActive: "-1",
      /**当前页数 */
      p: 1,
      /**总页数 */
      pageCount: null
    };
  },
  computed: {
    /**通过传入的时间戳数组来判断活动进行情况 */
    activeProcess: function() {
      return function(date) {
        let time = new Date().getTime();
        if (date[0] > time) {
          return "0"; //即将开始
        } else if (time >= date[0] && time <= date[1]) {
          return "1"; //活动正在进行
        } else if (time > date[1]) {
          return "2"; //活动已结束
        }
      };
    },
    /**格式化时间 */
    formatTimestamp: function() {
      /**
       * @param {Number} 时间戳
       * @param {String} 需要返回的格式
       */
      return function(time, style = "style1") {
        let data = new Date(parseInt(time));
        let y = data.getFullYear();
        let m = data.getMonth() + 1;
        let d = data.getDate();
        let h = data.getHours();
        let mm = data.getMinutes();
        m = m < 10 ? "0" + m : m;
        d = d < 10 ? "0" + d : d;
        h = h < 10 ? "0" + h : h;
        mm = mm < 10 ? "0" + mm : mm;
        if (style == "style1") {
          return y + "." + m + "." + d + " " + h + ":" + mm;
        } else if (style == "style2") {
          return m + "." + d + " " + h + ":" + mm;
        }
      };
    }
  },
  activated() {
    this.loading = false;
    this.$showLoading();
    this.list = [];
    this.getList();
  },
  methods: {
    /**选项卡选项发生变化 */
    handleClick(name) {
      let status;
      if (name != -1) {
        status = name;
      }
      this.$showLoading();
      this.list = [];
      this.p = 1;
      this.pageCount = null;
      this.getList({ status });
    },
    /**删除订单 */
    deleteOrder(item) {
      this.$confirm(item.course_title, {
        title: "是否确定删除订单"
      }).then(res => {
        delSignOrder({ id: item.id }).then(res => {
          if (this.tabActive != -1) {
            this.$showLoading();
            this.list = [];
            this.p = 1;
            this.pageCount = null;
            this.getList({ status: this.tabActive });
          } else {
            this.$showLoading();
            this.list = [];
            this.p = 1;
            this.pageCount = null;
            this.getList();
          }
        });
      });
    },
    /**立即支付 */
    payNow(item) {
      this.$showPay({
        id: item.courseid,
        price: item.ticket_info.price,
        type: "activity",
        json: {
          id: item.id
        },
        url: `${location.href.split("#")[0]}#/activity/${
          item.courseid
        }/payresult?id=${item.id}`
      });
    },
    /**取消报名 */
    cancelRegistration(item) {
      this.$confirm(item.course_title, {
        title: "是否确定取消报名活动"
      }).then(res => {
        delSign({ id: item.id }).then(res => {
          if (this.tabActive != -1) {
            this.$showLoading();
            this.list = [];
            this.p = 1;
            this.pageCount = null;
            this.getList({ status: this.tabActive });
          } else {
            this.$showLoading();
            this.list = [];
            this.p = 1;
            this.pageCount = null;
            this.getList();
          }
        });
      });
    },
    /**下拉到底 */
    getPageList() {
      this.getList({ p: this.p + 1 });
      this.p = this.p + 1;
    },
    /**
     * 请求数据 */
    getList(
      { p = "", maxperpage = "10", status = "" } = {
        p: "",
        maxperpage: "10",
        status: ""
      }
    ) {
      let params = {
        p,
        maxperpage,
        status
      };
      getActivityList(params).then(res => {
        if (this.list.length > 0) {
          this.list = this.list.concat(...res.list);
        } else {
          this.list = res.list;
        }
        this.pageCount = res.page.total_pages;
        this.loading = true;
        this.$hideLoading();
      });
    }
  }
};
</script>

<style scoped>
.myactivity {
  padding: 10px;
}
.myactivity-list {
  padding: 10px;
  border-radius: 5px;
}
.myactivity-list__img {
  border-radius: 5px;
  margin-right: 10px;
  height: 75px;
}
/*圆角分割线*/
.myactivity-split__line {
  position: relative;
  margin-top: -1px;
  margin-bottom: -1px;
  overflow: hidden;
  position: relative;
  z-index: 10;
  height: 18px;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
}
.myactivity-split__line .myactivity-left__cirle {
  float: left;
  width: 16px;
  height: 18px;
  background-repeat: no-repeat;
  background-size: 100% auto;
  background-position: 50%;
  background-image: url(../../assets/activity/yleft.svg);
}
.myactivity-split__line .myactivity-right__cirle {
  float: right;
  width: 16px;
  height: 18px;
  background-repeat: no-repeat;
  background-size: 100% auto;
  background-position: 50%;
  background-image: url(../../assets/activity/yright.svg);
}
.myactivity-split__line .myactivity-middle__line {
  left: 15px;
  right: 15px;
  background-color: #fff;
  height: 18px;
  top: 50%;
  margin-top: -9px;
  position: absolute;
}

.myactivity-info,
.myactivity-state {
  background-color: #fff;
  padding: 10px;
  padding-bottom: 15px;
  font-size: 14px;
  color: #888;
}
.myactivity-info__title {
  color: #424242;
}
.myactivity-info__title span {
  margin-left: 50px;
  color: #e5412c;
}
.myactivity-state span {
  color: #57bc5a;
}
.myactivity-state .check-pedding {
  color: #e5412c;
}
.myactivity-state .expired {
  color: #cccccc;
}
.myactivity-state__btnright {
  position: absolute;
  top: 4px;
  right: 15px;
}
.myactivity-state__btnright .ks-button {
  font-weight: normal;
  position: relative;
}
.myactivity-state {
  position: relative;
  border-radius: 0 0 5px 5px;
}
.ks-row {
  position: relative;
}
.ks-col-3 {
  position: absolute;
  top: -10px;
  width: 38px;
}
.ks-line::after {
  content: "";
  display: block;
  position: absolute;
  border-bottom: 1px dashed #e2e2e2;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}
</style>
