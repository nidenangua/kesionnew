<template>
  <div class="to-gift">
    <div class="togift-wrap">
      <img src="@/m/assets/user/bg_gift.png" class="top-img">

      <div class="topgift-con">
        <div class="item" style="display:block;">
          <ks-create-bg :src="memberinfo.headimg" type="user" class="togiftuser"/>
          <p class="togiftusername">赠送人:{{memberinfo.giftname}}</p>
        </div>
        <div class="item">
          <div class="head">名称:</div>
          <div class="body">{{info.title}}</div>
        </div>
        <div class="item">
          <div class="head">类型:</div>
          <div class="body">
            <span v-if="$route.query.type == 0 && info.courseType == 1">点播课程</span>
            <span v-else-if="$route.query.type == 0 && info.courseType == 2">语音直播</span>
            <span v-else-if="$route.query.type == 0 && info.courseType == 3">音频课程</span>
            <span v-else-if="$route.query.type == 0 && info.courseType == 4">图文课程</span>
            <span v-else-if="$route.query.type == 1">直播课程</span>
            <span v-else-if="$route.query.type == 7">专栏</span>
            <span v-else-if="$route.query.type == 10">社群</span>
          </div>
        </div>
        <div class="item" style="border-bottom: none">
          <div class="head">价格：</div>
          <div class="body">￥{{info.price}}</div>
        </div>
      </div>
    </div>
    <div align="center" v-if="received == 1">
      <ks-button type="primary" :disabled="true" class="gift-btn">已领取赠礼</ks-button>
    </div>
    <div align="center" v-else-if="numb !== null">
      <ks-button
        type="primary"
        @click="receive"
        class="gift-btn"
        v-if="numb > 0"
      >{{isgiftsender == 1 ? '分享给好友' : '领取赠礼'}}</ks-button>
      <ks-button type="primary" :disabled="true" class="gift-btn" v-else>已被领取完</ks-button>
    </div>

    <store-footer/>
  </div>
</template>
<script>
import { getViewRoute } from "@/utils";
import { getGiftShare, receiveGifts } from "@/api/user";
export default {
  name: "ToGift",
  data() {
    return {
      received: -1,
      isgiftsender: -1,
      numb: null,
      info: {},
      memberinfo: {}
    };
  },
  methods: {
    /**
     * 领取赠送
     */
    receive() {
      if (this.isgiftsender == 0) {
        receiveGifts({
          id: this.$route.query.id,
          ordersn: this.$route.query.ordersn
        }).then(res => {
          if (res.result === "success") {
            this.$toast(res.msg).then(() => {
              let route = getViewRoute(
                {
                  type: this.$route.query.type,
                  id: this.$route.query.id
                },
                "id"
              );
              this.$router.push(route);
            });
          }
        });
      } else if (this.isgiftsender == 1) {
        this.$showShareBg("gift");
      }
    }
  },
  activated() {
    this.$showLoading();
    document.title = "领取赠礼";
    this.numb = null;
    this.isgiftsender = -1;
    this.received = -1;
    this.info = {};
    this.memberinfo = {};
    let query = this.$route.query;
    getGiftShare(query).then(res => {
      this.info = res.info;
      res.memberinfo.headimg += "?" + Math.ceil(Math.random() * 100000000);
      this.memberinfo = res.memberinfo;
      this.isgiftsender = res.isgiftsender;
      this.$wxShare({
        title: "请你免费学" + this.info.title,
        desc: "您的好友送您的一份大礼",
        imgUrl: this.info.defaultpic
      });
      this.received = res.islq;
      this.numb = res.numb;
      this.$hideLoading();
    });
  }
};
</script>

<style scoped>
.to-gift {
  padding-top: 15px;
}
.togiftuser {
  width: 40px;
  height: 40px;
  margin: 0 auto 10px;
  top: 10px;
  right: 0;
  border-radius: 50% !important;
  display: block;
}

.togift-wrap .topgift-con {
  padding-top: 95px;
}
.togiftusername {
  font-size: 14px;
  text-align: center;
  line-height: 34px;
}
.togift-wrap {
  position: relative;
}
.togift-wrap .top-img {
  position: relative;
  display: block;
  margin: auto;
  max-width: 95%;
  height: auto;
}
.togift-wrap .topgift-con {
  position: absolute;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  width: 100%;
  height: 100%;
  box-sizing: border-box;
  padding: 110px 35px 30px;
  z-index: 2;
}
.togift-wrap .item {
  display: flex;
  padding-bottom: 10px;
  border-bottom: 1px solid #ead9b1;
  font-size: 14px;
  margin-bottom: 10px;
  color: #888;
}
.togift-wrap .item .head {
  margin-right: 10px;
}
.togift-wrap .item .body {
  flex: 1;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.gift-btn {
  width: 80%;
  margin: 40px auto 20px auto;
}
</style>
