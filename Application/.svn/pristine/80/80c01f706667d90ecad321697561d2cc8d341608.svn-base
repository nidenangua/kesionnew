<template>
  <div>
    <ks-tab :tab-info="tabInfo"/>
    <user-group v-if="tabInfo.current === 0"/>
    <user-topic v-else-if="tabInfo.current === 1"/>
    <user-zan v-else-if="tabInfo.current === 2"/>
    <store-footer/>
  </div>
</template>

<script>
import UserGroup from "./UserGroup";
import UserZan from "./UserZan";
import UserTopic from "./UserTopic";
export default {
  name: "GroupIndex",
  data() {
    return {
      tabInfo: {
        options: ["加入的社群", "我的评论", "我的点赞"],
        current: 0,
        values: ["list", "comment", "zan"]
      }
    };
  },

  activated() {
    document.title = "我的社群";
  },
  components: {
    UserGroup,
    UserZan,
    UserTopic
  }
};
</script>



