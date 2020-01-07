<template>
<transition name="fade-down">
  <div class="audio-live-bullet" v-show="visible">
    <div class="audio-live-bullet__item" :class="currentTime < Number(item.time) + 10 && 'audio-live-bullet__item--new'" v-for="(item,i) in bulletList" :key="i">
      <div class="audio-live-bullet__text-bg" v-if="item.content">
        <div
          class="audio-live-bullet__text"
          v-if="item.content.msg_type === 'text' && item.content.msg_action === 'reply'"
        >@{{item.content.reply_source.membername}}：{{item.content.msg}}</div>
        <div class="audio-live-bullet__text" v-else-if="item.content.msg_type === 'text'">{{item.content.msg}}</div>
        <div v-else-if="item.content.msg_type === 'reward'">{{item.membername}}打赏了{{item.content.reward_number}}元红包</div>
      </div>
      <div v-else>内容格式错误</div>
      <ks-image :src="item.avatar" type="user"/>
    </div>
  </div>
</transition>
</template>
<script>
export default {
  /*弹幕*/
  name: "AudioLiveBullet",
  props: {
    /**弹幕显示开关 */
    visible: {
      type: Boolean,
      default: true
    },
    /**当前时间（时间戳，单位：秒） */
    currentTime: {
      type: Number,
      required: true
    },
    /**弹幕列表 */
    bulletList: {
      type: Array,
      default() {
        return [];
      }
    }
  }
};
</script>
<style scoped>
.audio-live-bullet {
  position: fixed;
  right: 10px;
  bottom: 105px;
}
.audio-live-bullet__item {
  display: flex;
  margin-top: 10px;
  justify-content: flex-end;
}
.audio-live-bullet__item .ks-image {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-left: 10px;
}
.audio-live-bullet__text-bg {
  background: rgba(0, 0, 0, 0.2);
  color: #fff;
  border-radius: 4px;
  padding: 5px;
  max-width: 140px;
}
.audio-live-bullet__item--new .audio-live-bullet__text-bg {
    background: rgba(0, 0, 0, 0.4);
}
.audio-live-bullet__text {
  font-size: 10px;
  line-height: 18px;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  overflow: hidden;
  max-height: 36px;
}
</style>
