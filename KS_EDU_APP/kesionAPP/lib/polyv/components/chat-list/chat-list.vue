<template>
  <view class="plv-mp-chat-list-wrap" :class="'plv-mp-skin__'+skin">
    <view v-if="hasMore" class="plv-mp-chat-list-show-more" @click="tapSeeMore">查看更多</view>
    <view class="plv-mp-chat-list-list">
      <view class="plv-mp-chat-list-item" v-for="item in chatList" :key="item.id">
        <!-- 是否只看主持人 -->
        <block v-if="!isOnlyHost || (isOnlyHost && (item.system || item.actor || item.user.actor))">
          <!-- 打赏 -->
          <view v-if="item.reward" class="plv-mp-chat-list-msg-flower">
            <view v-if="item.content.gimg">
              {{ item.content.unick }} 赠送了 {{ item.content.rewardContent }}
              <image
                mode="aspectFill"
                :src="item.content.gimg"
                class="plv-mp-chat-list-icon__flower"
              />
            </view>
            <view v-else>
              <image
                mode="aspectFill"
                class="plv-mp-chat-list-reward-cash"
                src="https://livestatic.videocc.net/assets/wimages/icon-redpaper.png"
              />
              {{ item.content.unick }} 打赏了 {{ item.content.rewardContent }} 元
            </view>
          </view>
          <!-- 系统 -->
          <view v-else-if="item.system" class="plv-mp-chat-list-msg-system">{{ item.content }}</view>
          <!-- 送花或点赞 -->
          <view
            v-else-if="item.flowers || item.EVENT === 'LIKES'"
            class="plv-mp-chat-list-msg-flower"
          >
            {{ item.nick }} 赠送了鲜花
            <image
              mode="aspectFill"
              :src="baseUrl + '/static/polyv/chat-icon-flower.png'"
              class="plv-mp-chat-list-icon__flower"
            />
          </view>
          <!-- 自定义消息 -->
          <view v-else-if="item.isCustomMsg" class="plv-mp-chat-list-msg-custom">
            <text>{{ item.content }}</text>
            <image class="plv-mp-chat-list-msg-custom__image" v-if="item.image" :src="item.image" />
          </view>
          <!-- 自己 -->
          <view v-else-if="item.currentUser" class="plv-mp-chat-list-msg-self">
            <view class="plv-mp-chat-list-msg-content">
              <content-parser :content="item.content" />
            </view>
          </view>
          <!-- 他人 -->
          <view v-else class="plv-mp-chat-list-msg-other">
            <image class="plv-mp-chat-list-user-avatar" :src="item.user.pic" />
            <view class="plv-mp-chat-list-user-info">
              <text
                class="plv-mp-chat-list-user-info__actor"
                v-if="item.actor || item.user.actor"
              >{{ item.actor || item.user.actor }}</text>
              <text>{{ item.user.nick || item.user.userName }}</text>
            </view>
            <view class="plv-mp-chat-list-msg-content">
              <content-parser :content="item.content" />
            </view>
          </view>
        </block>
      </view>
    </view>
  </view>
</template>
<script>
import ContentParser from "./content-parser/content-parser";
export default {
  components: {
    ContentParser
  },
  props: {
    chatList: { type: Array, default: [] },
    hasMore: { type: Boolean, default: !1 },
    isOnlyHost: { type: Boolean, default: !1 },
    skin:{type:String,default:"black"}
  },
  data(){
    return {
      baseUrl: this.$store.state.SRC + "/config/app",
    }
  },
  methods: {
    tapSeeMore() {
      this.$emit("seemore");
    }
  }
};
</script>
<style scoped>
.plv-mp-chat-list-show-more {
  padding: 20rpx 0 10rpx;
  font-size: 24rpx;
  text-align: center;
  color: #fff;
}
.plv-mp-chat-list-list {
  padding: 16rpx;
}
.plv-mp-chat-list-item {
  position: relative;
  margin-bottom: 20rpx;
}
.plv-mp-chat-list-user-avatar {
  position: absolute;
  left: 0;
  top: 0;
  width: 48rpx;
  height: 48rpx;
  border-radius: 50%;
}
.plv-mp-chat-list-user-info {
  margin-left: 68rpx;
  max-width: 70%;
  font-size: 22rpx;
  color: #848e99;
  margin-bottom: 14rpx;
}
.plv-mp-chat-list-user-info__actor {
  margin-right: 0.5em;
  background: #2196f3;
  font-size: 24rpx;
  padding: 0 10rpx;
  color: #fff;
  border-radius: 16rpx;
}
.plv-mp-chat-list-msg-content {
  position: relative;
  display: inline-block;
  padding: 16rpx;
  font-size: 26rpx;
  max-width: 70%;
  margin-left: 68rpx;
}
.plv-mp-chat-list-msg-other {
  text-align: left;
  color: #546e7a;
}
.plv-mp-chat-list-msg-other__actor {
  color: #2196f3;
}
.plv-mp-chat-list-msg-other .plv-mp-chat-list-msg-content {
  text-align: left;
  background-color: #fff;
  border-radius: 0 10rpx 10rpx;
}
.plv-mp-chat-list-msg-self {
  text-align: right;
  color: #fff;
}
.plv-mp-chat-list-msg-self .plv-mp-chat-list-msg-content {
  max-width: 100%;
  text-align: right;
  background-color: #8bc34a;
  border-radius: 10rpx 0 10rpx 10rpx;
}
.plv-mp-chat-list-msg-flower {
  text-align: center;
  font-size: 24rpx;
  color: #fff;
}
.plv-mp-chat-list-icon__flower {
  display: inline-block;
  width: 44rpx;
  height: 44rpx;
  vertical-align: middle;
}
.plv-mp-chat-list-msg-custom {
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24rpx;
  color: #fff;
}
.plv-mp-chat-list-msg-custom__image {
  margin-left: 12rpx;
  width: 44rpx;
  height: 44rpx;
}
.plv-mp-chat-list-msg-system {
  text-align: center;
  font-size: 24rpx;
  color: #fff;
}
.plv-mp-chat-list-reward-cash {
  width: 46rpx;
  height: 57rpx;
  vertical-align: middle;
  margin-top: -6rpx;
}
.plv-mp-skin__white .plv-mp-chat-list-show-more {
  color: #757575;
}
.plv-mp-skin__white .plv-mp-chat-list-msg-flower,
.plv-mp-skin__white .plv-mp-chat-list-msg-system {
  color: #000;
}
.plv-mp-skin__white .plv-mp-chat-list-msg-flower > view {
  font-size: 26rpx;
}
.plv-mp-skin__white .plv-mp-chat-list-msg-custom {
  color: #000;
}
</style>