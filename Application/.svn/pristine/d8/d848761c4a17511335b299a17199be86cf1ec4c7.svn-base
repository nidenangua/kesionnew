<template>
  <div v-if="loading">
    <ks-image :src="courseInfo.defaultpic" class="activity-cover"/>
    <div class="activity-info">
      <div class="title">课程活动: {{courseInfo.title}}</div>
      <div class="count">已有 {{courseInfo.json.count_active}}人报名</div>
      <div class="ks-line activity-info__row price">
        <!-- <span><i>￥</i>{{getPrice(courseInfo)}}</span>&nbsp;起 -->
        <span><i>￥</i>{{courseInfo.json.min_price}}</span>&nbsp;起
      </div>
      <div class="ks-line activity-info__row">
        <i class="ks-icon ks-icon-clock-outline"></i>
        {{formatTimestamp(courseInfo.json.setting.begindate,"style4")}} - {{formatTimestamp(courseInfo.json.setting.enddate,"style4")}}
      </div>
      <div class="ks-line activity-info__row">
        <i class="ks-icon ks-icon-pin-outline"></i>
        {{courseInfo.json.setting.address}}
      </div>
      <div class="ks-line activity-info__row">
        <i class="ks-icon ks-icon-flag-outline"></i>
        {{courseInfo.json.setting.sponsor}}
      </div>
    </div>
    <div class="active-produce">
      <div class="name">活动介绍</div>
      <div v-html="courseInfo.content" class="ks-content content" ref="content"></div>
    </div>
    <!--店铺信息-->
    <store-info class="ks-mt10" v-if="$route.query.miniprogram != 1"/>
    <!--底部-->
    <store-footer/>
    <div class="placeholder"></div>
    <router-link :to="{name:'SelectTicket',params:{id:activityId}}" class="activity-enroll">
      <ks-button type="primary" width="100%" class="activity-enroll-btn">活动报名</ks-button>
    </router-link>
  </div>
</template>
<script>
import activity_detail from "@/mixins/activity/activity.detail";
export default {
  name: "ActivityDetail",
  mixins: [activity_detail],
  methods: {
    /**
     * 设置图片点击放大
     */

    onGetDetailSuccess() {
      this.$nextTick(() => {
        this.$hideLoading();
        this.$setPreview(this.$refs.content);
      });
    }
  }
};
</script>
<style scoped>
.activity-cover {
  height: 11.5rem;
}
.activity-info {
  background-color: #fff;
}
.activity-info__row {
  font-size: 14px;
  padding: 14px 10px;
}
.activity-info__row i {
  margin-right: 5px;
  color: #e64a3b;
}
.activity-info .title {
  padding: 15px;
  font-size: 18px;
  font-weight: bold;
}
.activity-info .count {
  padding: 0 10px;
  color: #bebebe;
}
.activity-info .price {
  display: flex;
  align-items: center;
}
.activity-info .price span {
  font-size: 18px;
  color: #e64a3b;
  font-weight: bold;
}
.activity-info .price i{
  font-style: normal;
  font-size: 14px;
}
.active-produce {
  margin: 10px 0;
  padding: 15px 0 0;
  background-color: #fff;
}
.active-produce .name {
  font-size: 14px;
  font-weight: bold;
  padding: 0 10px;
  border-left: 3px solid #e64a3b;
}
.active-produce .content {
  padding: 20px 15px;
}
.placeholder {
  height: 44px;
}
.activity-enroll {
  max-width: 480px;
  width: 100%;
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  margin:0 auto;
}
.activity-enroll-btn{
  border-radius: 0;
}
</style>

