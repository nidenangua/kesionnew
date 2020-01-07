<template>
  <div class="fight-group-view" v-if="loaded">
    <div class="goods">
      <div class="goods__info">
        <ks-create-bg class="goods__image" :ratio="9/16" :src="info.defaultpic"/>
        <div class="goods__title">{{info.title}}</div>
        <div class="goods__price">
          ￥{{sellInfo.teammoney}}
          <span class="goods__discount">￥{{info.price_market}}</span>
        </div>
        <div class="goods__price">团长价：￥{{sellInfo.leadmoney}}</div>
        <div class="ks-tag ks-mt10">拼团</div>
      </div>
      <ks-button class="goods__button" type="primary" @click="openGroup">我要开团</ks-button>
    </div>
    <div class="collage-play ks-mt10">
      <div class="fight-group-view__head">拼团玩法</div>
      <div class="collage-play__inner">
        <div class="collage-play__item">
          <div class="collage-play__item_l">
            <img src="//test.ketangjie.com/Public/wechat/images/collage/choice.png" alt>
          </div>
          <div class="collage-play__item_r">
            选择课程
            <br>拼团/参团
          </div>
        </div>
        <div class="collage-play__icon">·····</div>
        <div class="collage-play__item">
          <div class="collage-play__item_l">
            <img src="//test.ketangjie.com/Public/wechat/images/collage/invite.png">
          </div>
          <div class="collage-play__item_r">
            邀请好友
            <br>参团支付
          </div>
        </div>
        <div class="collage-play__icon">·····</div>
        <div class="collage-play__item">
          <div class="collage-play__item_l">
            <img src="//test.ketangjie.com/Public/wechat/images/collage/full.png" alt>
          </div>
          <div class="collage-play__item_r">
            人满开团
            <br>一起听课
          </div>
        </div>
      </div>
    </div>
    <div class="collage-note">
      <div class="fight-group-view__head">拼团须知</div>
      <p>1.拼团是指由多人一起拼单购买的团购活动，通过拼团买家可以享受低价听课优惠；</p>
      <p>2.在商家设置的拼团时限内（如果活动剩余时间少于拼团时限以活动剩余时间为准）找到满足人数的好友参加拼团，即可算拼团成功开始听课；</p>
      <p>3.在商家设置的拼团时限内（如果活动剩余时间少于拼团时限以活动剩余时间为准）没有满足拼团人数要求，即算作拼团失败，系统会自动在24小时内将您支付的钱款退回；</p>
      <p>4.注意：一旦开始拼团，在倒计时结束前，不支持原价购买和退款操作。</p>
    </div>
    <store-info class="ks-mt10" v-if="$route.query.miniprogram != 1"/>
    <store-footer/>
  </div>
</template>
<script>
import { getCourseDetail } from "@/api/course";
export default {
  name: "FightGroupView",
  data() {
    return {
      loaded: false,
      sellid: this.$route.query.sellid,
      infoid: this.$route.params.id,
      h5id: null,
      info: {},
      sellInfo: {}
    };
  },
  methods: {
    /**
     * 开团
     */
    openGroup() {
      this.$fightGroupPay({
        groupid: this.sellid,
        id: this.infoid,
        price: this.sellInfo.leadmoney,
        h5id: this.h5id
      });
    }
  },
  activated() {
    this.$showLoading();
    let sellid = this.$route.query.sellid;
    let infoid = this.$route.params.id;
    this.sellid = sellid;
    this.infoid = infoid;
    let type = this.$route.path.match(/\w+/)[0];

    if (type === "course") {
      getCourseDetail({
        id: infoid
      }).then(res => {
        this.info = res.courseinfo;
        this.h5id = res.h5info.h5id;
        this.sellInfo = res.h5info.setting;
        this.loaded = true;
        this.$hideLoading();
      });
    } else {
      this.$toast("拼团不存在");
      this.$hideLoading();
      history.back();
    }
  }
};
</script>
<style scoped>
.fight-group-view__head {
  font-size: 16px;
  margin-bottom: 5px;
  height: 36px;
  line-height: 36px;
  overflow: hidden;
}

.goods {
  padding: 15px;
  background: #fff;
}
.goods__info {
  position: relative;
  min-height: 80px;
  padding: 0 0 15px 155px;
  border-bottom: 1px solid #eee;
}
.goods__info .goods__image {
  width: 140px;
  position: absolute;
  height: 78px;
  left: 0;
  top: 0;
}
.goods__title {
  font-size: 14px;
  max-height: 44px;
  line-height: 22px;
  overflow: hidden;
}
.goods__price {
  font-size: 16px;
  color: var(--ornament-color);
}
.goods__discount {
  font-size: 12px;
  color: #999;
  text-decoration: line-through;
  margin-left: 10px;
}
.goods__button {
  width: 100%;
  margin-top: 15px;
}

.collage-note {
  padding: 10px 10px 15px 10px;
  background: #fff;
  margin-top: 10px;
}

.collage-note p {
  font-size: 12px;
  color: #666;
  line-height: 22px;
}

.collage-play {
  padding: 10px 10px 15px 10px;
  background: #fff;
}

.collage-play__inner {
  display: flex;
  align-items: center;
  justify-content: center;
}
.collage-play__item {
  flex: 1;
  display: flex;
  align-items: center;
  overflow: hidden;
  justify-content: center;
}
.collage-play__icon {
  margin: 0 10px;
  color: #999;
}
.collage-play__item_l img {
  width: 30px;
  height: 30px;
  display: block;
  margin-right: 5px;
}
.collage-play__item_r {
  font-size: 12px;
  line-height: 18px;
  color: #999;
}
</style>
