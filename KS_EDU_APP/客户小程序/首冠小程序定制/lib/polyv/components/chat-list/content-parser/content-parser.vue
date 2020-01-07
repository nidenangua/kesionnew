<template>
  <view>
    <image
      v-if="content.type === 'chatImg'"
      class="plv-mp-chat-msg-img"
      mode="widthFix"
      :src="content.uploadImgUrl"
      :style="{width:content.size.width/2+'rpx',height:content.size.height/2+'rpx'}"
      @click="tapImage"
    />
    <block v-else>
      <block v-for="(item,itemIndex) in contentArr" :key="itemIndex">
        <text class="plv-mp-chat-msg-content-title" v-if="item.type === 'text'">{{ item.content }}</text>
        <image v-else :src="item.url" style="width:30px;height:30px;" mode="widthFix" />
      </block>
    </block>
  </view>
</template>
<script>
import emotion from "../../../common/chat/emotionList";
const emotionUrl = {};
emotion.forEach(t => {
  emotionUrl[t.title] = "https:" + t.url;
});
export default {
  props:{
    content: {
      type: [String, Object]
    }
  },
  data(){
	  return {
		  contentArr: []
	  }
  },
  watch:{
    content:{
      handler(t, e){
        t &&
          t !== e &&
          "string" == typeof t && 
          (this.contentArr = this.parseEmotion(t));
      },
      deep:true,
      immediate:true
    }
  },
  methods: {
    tapImage() {
      const t = this.content.uploadImgUrl;
      uni.previewImage({ urls: [t], current: t });
    },
    parseEmotion(t) {
      let e = t;
      if ("string" != typeof e || !e) return [];
      e = e.replace(/&lt;/g, "<").replace(/&gt;/g, ">");
      const n = [];
      for (; -1 !== e.indexOf("["); ) {
        const t = e.indexOf("["),
          o = e.indexOf("]", t + 1);
        if (-1 === o) break;
        n.push({ type: "text", content: e.substring(0, t) });
        const r = e.substring(t + 1, o),
          i = { type: "em", content: r };
        emotionUrl[r]
          ? (i.url = emotionUrl[r])
          : ((i.type = "text"), (i.content = `[${r}]`)),
          n.push(i),
          (e = e.substring(o + 1));
      }
      return n.push({ type: "text", content: e }), n;
    }
  }
}
</script>
<style scoped>
.plv-mp-chat-msg-content {
  text-align: left;
  word-break: break-all;
  font-size: 0;
  min-height: 36rpx;
}
.plv-mp-chat-msg-content-title {
  font-size: 26rpx;
}
.plv-mp-chat-msg-img {
  background-color: #ddd;
}
</style>