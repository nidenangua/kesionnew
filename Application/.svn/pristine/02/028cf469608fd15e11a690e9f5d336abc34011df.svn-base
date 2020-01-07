<template>
  <div class="auto-reply-alert">
    <el-alert class="ks-mt30 ks-pd20" :closable="false">
      <el-switch
        class="auto-reply-alert__switch"
        @change="slideSwitch"
        v-model="replySwitch"
        :active-color="$store.state.switch_on"
        :inactive-color="$store.state.switch_off"
      ></el-switch>
      <div class="auto-reply-alert__title" v-if="type == 1">被关注回复</div>
      <div class="auto-reply-alert__title" v-else-if="type == 2">收到消息回复</div>
      <div class="auto-reply-alert__title" v-else-if="type == 3">关键词回复</div>
      <p>
        通过编辑内容或关键词规则，快速进行自动回复设置。
        <br>关闭自动回复之后，将立即对所有用户生效。
      </p>
    </el-alert>
  </div>
</template>
<script>
import { setWechatKeyWordStatus } from "@/api/wechat";
export default {
  name: "AutoReplyAlert",
  props: ["autoReplySwitch", "type"],
  data() {
    return {
      replySwitch: this.autoReplySwitch
    };
  },
  methods: {
    slideSwitch(bl) {
      /**
       * 改变自动回复开关
       */
      setWechatKeyWordStatus({
        isfocus: bl ? 1 : 0,
        type: this.type
      }).then(res => {
        this.$emit("update:autoReplySwitch", bl);
      });
    }
  }
};
</script>

<style scoped>
.auto-reply-alert__title {
  font-size: 20px;
  color: #333;
  padding: 10px 0;
}

.auto-reply-alert__switch {
  position: absolute;
  right: 30px;
  top: 40%;
}
</style>

