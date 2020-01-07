<template>
  <div>
    <auto-reply-alert v-if="loaded" :auto-reply-switch.sync="autoReplySwitch" :type="2"/>
    <div class="reply-received ks-mt30" v-show="autoReplySwitch">
      <wx-reply-select ref="wxReplySelect"/>
      <div class="ks-mt30">
        <el-button type="primary" @click="save">保存</el-button>
      </div>
    </div>
  </div>
</template>
<script>
import WxReplySelect from "./compoents/WxReplySelect";
import AutoReplyAlert from "./compoents/AutoReplyAlert";
import { getWechatReply, setWechatReply } from "@/api/wechat";
export default {
  name: "ReplyReceived",
  data() {
    return {
      /**
       * 界面加载状态
       */
      loaded: false,
      /**
       * 收到消息回复开关
       */
      autoReplySwitch: false
    };
  },
  methods: {
    /**
     * 保存
     */
    save() {
      let info = this.$refs.wxReplySelect.getInfo();
      if (!info) {
        return false;
      }
      let params = {
        type: 2,
        contents: JSON.stringify([info])
      };

      setWechatReply(params).then(res => {
        this.$msg(res.msg, res.result);
      });
    }
  },
  mounted() {
    this.$showLoading();
    getWechatReply({
      type: 2
    }).then(res => {
      this.loaded = true;
      if (res.result === "success") {
        this.autoReplySwitch = res.isfocus == 1 ? true : false;
        let contents = res.contents;
        if (contents && contents[0]) {
          this.$refs.wxReplySelect.setInfo(contents[0]);
        }
      }

      this.$hideLoading();
    });
  },
  components: {
    WxReplySelect,
    AutoReplyAlert
  }
};
</script>
<style scoped>
.reply-received {
  min-height: 520px;
}
</style>


