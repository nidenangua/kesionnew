<template >
  <div class="page">
    <ks-page-scroll-container :page="page" :page-count="pageCount" @page-change="onPageChange">
      <div class="friend" v-for="item in msglist" :key="item.id" @click="godel(item.socialid)">
        <div class="friend-name">{{item.name}}</div>
        <p class="friend-time">{{item.adddate}}</p>
        <ks-image :src="item.head" class="content-nav__head friend-head"/>
        <p class="friend-content">{{item.content}}</p>
        <img :src="item.json.info[0]" alt="" class="friend-img" v-if="item.json.type === 1">
        <img
          src="../../assets/friend/audio.png"
          alt=""
          class="friend-img"
          v-if="item.json.type === 3"
        >
        <span class="friend-img friend-type0" v-if="item.json.type === 0">{{item.json.content}}</span>
        <div class="friend-img friend-video" v-if="item.json.type === 2">
         <media-Preview :type="item.json.$type" :info="item.json.$info"/>
          <!-- <video  width="65px" height="65px">
            <source :src="item.json.info[0]" type="video/mp4">
          </video> -->
          <span class="start"></span>
          <span class="triangle"></span>
        </div>
      </div>
      <div class="gridClass"></div>
    </ks-page-scroll-container>
    <store-footer/>
    
  </div>
</template>
<script>
import { msgList } from "@/api/friend";
import MediaPreview from "../../components/media-preview";
export default {
  components: {
    MediaPreview
  },
  data() {
    return {
      /**p:分页 maxperpage:一页几条 */
      page: 1,
      pageCount: 1,
      /**消息列表数据*/
      msglist: []
    };
  },
  activated() {
    document.title = "回复列表"
    this.getlist();
  },
  methods: {
    getlist(page = 1) {
      this.$showLoading();
      this.page = page;
      msgList({ p: page, maxperpage: 10 }).then(res => {
        this.pageCount = res.page.total_pages;
        this.msglist = page == 1 ? res.list : this.msglist.concat(res.list);
        this.msglist.map(item => {
          this.resetJson(item.json);
        });
        this.$hideLoading();
      });
    },
    /**判断 */
    resetJson(json = {}) {
      json.$info = {};
      switch (Number(json.type)) {
        case 1:
          json.$type = "image";
          let _list = [];
          if (json.info instanceof Array) {
            json.info.map(src => {
              _list.push({
                src: src
              });
            });
          }
          // 给list加json.$info节点
          json.$info = {
            list: _list
          };
          break;
        case 2:
          json.$type = "video";
          json.$info = {
            src: json.info[0] || ""
          };
          break;
        case 3:
          json.$type = "audio";
          json.$info = {
            src: json.info[0] || ""
          };
          break;
      }
    },
    onPageChange: function(page) {
      this.getlist(page);
    },
    /**跳转详情页 */
    godel(socialid) {
      this.$router.push(`/friend/${socialid}`)
    }
  }
};
</script>
<style scoped>
.friend {
  padding: 20px 20px 20px 60px;
  position: relative;
}
.friend-name {
  font-size: 14px;
}
.friend-head {
  border-radius: 50%;
  width: 35px;
  position: absolute;
  top: 24px;
  left: 15px;
}
.friend-left {
  width: 60px;
  height: 60px;
  position: absolute;
  right: 20px;
  top: 25px;
  font-size: 14px;
  overflow: hidden;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 3;
  background-color: #eee;
}
.friend-time {
  font-size: 12px;
  padding-top: 5px;
  color: #999;
}
.friend-content {
  font-size: 14px;
  text-align: justify;
  padding-top: 8px;
  padding-right: 5px;
}
.friend-tool {
  font-size: 14px;
  margin-top: 10px;
}
.friend-tool__delete {
  color: #999;
}
.critic-tool {
  font-size: 14px;
  margin-top: 6px;
}
.critic {
  color: var(--primary-color);
}
.critic-tool__delete {
  float: right;
  color: #999;
}
.gridClass {
  position: relative;
  width: 90%;
  margin: 0 auto;
}
.gridClass:after {
  content: " ";
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 1px;
  border-top: 1px solid #e9e9e9 !important;
  -webkit-transform: scaleY(0.5);
  transform: scaleY(0.5);
}
.friend-head {
  width: 35px;
  height: 35px;
}
.friend-img {
  position: absolute;
  right: 20px;
  top: 20px;
  width: 64px;
  height: 64px;
}
.friend-type0 {
  background-color: #eeeeee;
  padding: 5px;
  box-sizing: border-box;
  font-size: 14px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: normal;
  line-height: 20px;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
}
.friend-content {
  width: 70%;
}
.friend-video {
  width: 65px;
  height: 65px;
}
.start{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  border-radius: 50%;
  width: 28px;
  height: 28px;
  border: 2px solid #fff; 
}
.triangle{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-15%,-50%);
  border: 8px solid ;
  border-color: transparent transparent transparent #fff;
}
.ks-image /deep/ img {
  border-radius: 50%;
}
.friend-img /deep/ img {
  height: 65px !important;
}
div /deep/ .video-play {
  display: none !important;
}
.preview-video {
  height: 3rem !important;
}
</style>