<template>
  <div class="couponHome">
    <!-- 头部分页区 -->
    <div class="couponHome-top">
      <h1>领券中心</h1>
    </div>
    <!-- 内容区 -->
    <div class="couponHome-list">
      <el-row :gutter="18">
        <el-col :span="12" v-for="(item,i) in list" :key="i">
          <div class="couponHome-list__box">
            <img src="@/pc/assets/user/me_coupons_bg.png" />
            <div class="couponHome-list__left">
              ¥
              <span>{{item.money}}</span>
            </div>
            <div class="couponHome-list__middle">
              <h2>{{voucherQuota(item.term)}}</h2>
              <h3>{{voucherTime(item.awarddate,item.time)}}</h3>
              <p v-if="item.infoid != 0">限{{voucherTypeName(item.type)}}《{{item.infotitle}}》可用</p>
              <p v-else>全站通用</p>
              
            </div>
            <i></i>
            <div class="couponHome-list__right">
              <el-progress :percentage="Math.floor(item.counts/item.number*100)"></el-progress>
              <el-button size="small" round disabled v-if="item.counts == item.number">已被领完</el-button>
              <el-button size="small" type="primary" round v-else-if="item.lqzt == 0" @click="getVoucher(item)">立即领取</el-button>
              <el-button size="small" type="primary" round v-else-if="item.lqzt < item.oneusers" @click="getVoucher(item)">继续领取</el-button>
              <el-button size="small" round disabled v-else-if="item.lqzt == item.oneusers">已领取</el-button>
			  <p v-if="item.oneusers > 1">已领取{{item.lqzt}}/{{item.oneusers}}张</p>
            </div>
          </div>
        </el-col>
      </el-row>
    </div>
    <div style="text-align: center;">
	  <el-pagination
        background
        layout="prev, pager, next"
        :page-count="pageCount"
        @current-change="getVoucherList"
        v-if="pageCount>0"
      />
      <ks-empty msg="该分类下暂无优惠券" v-else />
    </div>
  </div>
</template>

<script>
import { getVoucherList } from "@/api/store";
import { getVoucher } from "@/api/user";
import { getViewRoute, getTypeName } from "@/utils";
export default {
  name: "CouponHome",
  data() {
    return {
      list: [],
      page: 1,
      pageCount: null,
      loaded: false
    };
  },
  methods: {
    /**
     * 获取时间限制
     */
    voucherTime(type, time) {
      if (type == 1) {
        return time;
      } else {
        return "无时间限制";
      }
    },
    /**
     * 获取消费额度限制
     */
    voucherQuota(type) {
      if (type != 0) {
        return "满￥" + type + ".00元可用";
      } else {
        return "无门槛使用";
      }
    },
    voucherTypeName(type) {
      return getTypeName(type);
    },
    getVoucherList(p = 1) {
      this.$showLoading();
      this.page = p;
      this.loaded = false;
      if (p == 1) {
        this.list = [];
      }
      let params = {
        p: p,
        maxperpage: 6
      };
      let _id = this.$route.query.id;
      if (_id) {
        params.id = _id;
      }
      getVoucherList(params).then(res => {
        res.list.map(item => {
          item.money = parseFloat(item.money).toString();
        });
        this.list = res.list;
        this.pageCount = res.page.total_pages;
        this.loaded = true;
        this.$hideLoading();
      });
    },
    getVoucher(item) {
      getVoucher({
        id: item.id
      }).then(res => {
        if (res.result === "success") {
          this.$toast("领取成功", "success");
          item.lqzt += 1;
          item.counts = Number(item.counts) + 1;
        }
      });
    }
  },
  mounted() {
    this.getVoucherList();
  }
};
</script>

<style scoped>
.couponHome {
  width: 100%;
}
.couponHome-top {
  width: 100%;
  border-bottom: 1px solid #eee;
}
.couponHome-top h1 {
  font-size: 20px;
  color: #2d3336;
  font-weight: 400;
  padding: 21px 24px;
}
/* 内容区 */
.couponHome-list {
  padding: 0 20px 40px 20px;
}
.couponHome-list__box {
  height: 148px;
  width: 100%;
  margin-top: 20px;
  position: relative;
}
.couponHome-list__box img {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}
.couponHome-list__left {
  height: 100%;
  width: 100px;
  line-height: 148px;
  padding-left: 20px;
  text-align: center;
  position: absolute;
  left: 0;
  top: 0;
  color: #ec4a46;
  font-size: 18px;
}
.couponHome-list__left span {
  font-size: 36px;
}
.couponHome-list__middle {
  position: absolute;
  top: 0;
  left: 120px;
  line-height: 22px;
  margin-top: 20px;
  max-width: 180px;
}

.couponHome-list__middle h2 {
  font-size: 16px;
  color: #2d3336;
  font-weight: 400;
  margin-top: 10px;
  overflow: hidden;
  white-space:nowrap;
  text-overflow:ellipsis;
}
.couponHome-list__middle h3 {
  font-size: 12px;
  color: #585e61;
  font-weight: 400;
  margin-top: 5px;
  overflow: hidden;
  white-space:nowrap;
  text-overflow:ellipsis;
}
.couponHome-list__middle p {
  font-size: 12px;
  color: #929a9e;
  margin-top: 5px;
  overflow: hidden;
  white-space:nowrap;
  text-overflow:ellipsis;
}


.couponHome-list__right {
  width: 110px;
  height: 100%;
  position: absolute;
  right: 0;
  top: 0;
  text-align: center;
  margin-right: 15px;
}
.couponHome-list__right .el-progress {
  margin-top: 30px;
  font-size: 12px !important;
}
.couponHome-list__right .el-button{
	margin-top:10px;
}
.couponHome-list__right p{
	color:#999;
	margin-top:5px;
}

.disabled {
  background: #c8c9cc !important;
  cursor: not-allowed !important;
}
</style>
