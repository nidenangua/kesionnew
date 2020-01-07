<template>
  <div>
    <reply-keywords v-if="$route.query.action === 'smartreply'"/>
    <reply-received v-else-if="$route.query.action === 'autoreply'"/>
    <reply-follow v-else-if="$route.query.action === 'beadded'"/>
  </div>
</template>
<script>
import ReplyReceived from "./ReplyReceived";
import ReplyFollow from "./ReplyFollow";
import ReplyKeywords from "./ReplyKeywords";
export default {
  name: "KeyWordsReply",
  components: {
    ReplyReceived,
    ReplyKeywords,
    ReplyFollow
  }
};
</script>


