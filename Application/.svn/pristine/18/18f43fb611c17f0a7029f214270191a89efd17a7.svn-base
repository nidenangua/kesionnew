<template>
  <!-- 已报名 -->
  <div v-if="loading && !noSignUp">
    <!-- <div class="sign-top ks-text-center" v-if="signList.length==1">
      <img src="@/m/assets/activity/tick.gif">
      <div class="ks-color-success ks-fz18 ks-mt10">签到成功</div>
      <div class="sign-top__ticket ks-fz14 ks-mt10 ks-color-info">
        您的票种为
        <span class="ks-fz16 ks-color-error">{{signList[0].ticket_info.title}}</span>
      </div>
    </div> -->
    <div class="sign-list">
      <div class="ks-line sign-item" v-for="(item,index) in signList" :key="index">
        <div>
          <div class="ks-fz14 ks-color-info">
            您的票种为
            <span class="ks-fz16 ks-color-error">{{item.ticket_info.title}}</span>
          </div>
          <div class="ks-row ks-mt10 sign-details__title sign-time">
            签到时间：
            <span v-if="item.sign_date>0">{{formatTimestamp(item.sign_date*1000)}}</span>
            <span v-else class="no-sign">未签到</span>
          </div>
        </div>
        <div>
          <div v-if="item.is_sign==0">
              <ks-button
                type="success"
                class="sign-btn"
                size="small"
                @click="signBtn(item.id)"
                v-if="item.status == 3 && item.is_sign == 0"
              >签到</ks-button>
              <span v-if="item.status == 0" class="unrevised">未审核</span>
              <ks-button
                type="primary"
                class="sign-btn"
                size="small"
                @click="signpay(item.json.ordersn,item.url)"
                v-if="item.status == 1 && item.ticket_info.chargetype == 1"
              >支付</ks-button>
              <!-- <span v-if="item.status == 1 && item.ticket_info.chargetype == 1" class="unrevised">未支付</span> -->
          </div>
          <ks-button type="gray" class="sign-btn" size="small" v-else>已签到</ks-button>
        </div>
      </div>
    </div>
    <div class="sign-details ks-fz14 ks-mt10">
      <div class="ks-row ks-mt10">
        <div class="ks-col-6 sign-details__title">活动名称：</div>
        <div class="ks-col-16">{{title}}</div>
      </div>
      <div class="ks-row ks-mt10 sign-details__title" v-if="signList.length==1">
        <div class="ks-col-6">活动时间：</div>
        <div class="sign-details__time ks-col-16">{{formatTimestamp(signList[0].setting.begindate)}}-{{formatTimestamp(signList[0].setting.enddate)}}</div>
      </div>
    </div>
    <router-link :to="{name:'ActivityDetail',params:{id:$route.params.id}}">
      <ks-button class="check-activity" type="success">查看活动详情</ks-button>
    </router-link>
    <store-footer/>
  </div>
  <!-- 未报名 -->
  <div v-else-if="loading && noSignUp">
    <div class="ks-bg-white ks-fz14 activity-tile">
      <div class="name">活动名称:</div>
      <div>&nbsp;{{title}}</div>
    </div>
    <div>
      <ks-empty type="noorder" msg="您还没有可签到的票哦~"></ks-empty>
      <div class="ks-text-center ks-mt10">
        <router-link :to="{name:'ActivityDetail',params:{id:$route.params.id}}">
          <ks-button type="primary" class="go-registed" size="small">去报名</ks-button>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { activitySignList, activitySign } from "@/api/microportal";
export default {
  name: "SignInResult",
  data() {
    return {
      loading: false,
      /**是否报名 */
      noSignUp: false,
      /**课程名称 */
      title: "",
      /**签到列表 */
      signList: []
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
        return y + "." + m + "." + d + " " + h + ":" + mm + ":" + s;
      };
    }
  },
  activated() {
    this.loading = false;
    this.getActivitySignList();
  },
  methods: {
    /**点击签到 */
    signBtn(id) {
      // console.log(id);
      activitySign({ id }).then(res => {
        this.getActivitySignList();
      });
    },
    /**获取签到列表 */
    getActivitySignList() {
      activitySignList({ courseid: this.$route.params.id }).then(res => {
        this.title = res.title;
        if (res.result == "error" && res.msg == "你没有报名") {
          this.noSignUp = true;
        } else {
          this.signList = res.list;
        }
        this.loading = true;
      });
    },
    /**支付 */
    signpay(ordersn,url) {
      this.$router.push('/myactivity')
      // if (window.__wxjs_environment === 'miniprogram') {
      //   this.$store.ready(state=>{
      //     wx.miniProgram.navigateTo({
      //       url: `/pages/pay/pay?wxid=${state.info.wxid}&ordersn=${ordersn}`
      //     });
      //   })
      // } else {
      //   location.href = url;
      // }
    }
  }
};
</script>

<style scoped>
.sign-top,
.sign-details {
  background-color: #fff;
  padding: 10px;
}
.sign-top img {
  width: 130px;
}
.sign-top__ticket {
  margin: 10px;
}

.sign-list {
  padding-top: 20px;
  background-color: #fff;
}
.sign-item {
  min-width: 60px;
  padding: 5px 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.sign-item .sign-btn {
  width: 80px;
  font-weight: normal;
}
.sign-item .sign-time {
  margin-bottom: 10px;
}
.sign-item .no-sign {
  color: #999999;
}
.sign-details__title {
  color: #6a6a6a;
}
.check-activity {
  width: 95%;
  margin: 25px 10px;
  max-width: 480px;
}
.sign-details__time {
  line-height: 23px;
}

.activity-tile {
  padding: 20px;
  display: flex;
}
.activity-tile .name {
  color: #666666;
  flex-shrink: 0;
}
.go-registed {
  font-weight: normal;
  background-color: #333232;
  border: #333232;
}
.unrevised{
  color: #ea4a74;
  font-size: 14px;
  padding-right: 15px;
}
</style>
