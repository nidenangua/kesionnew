<template>
  <div class="gift-record">
    <ks-tab :tab-info="tab" @change="slideTab"/>
    <ks-page-scroll-container
      v-if="datalist.length"
      :page="page"
      :page-count="pageCount"
      @page-change="getGiftList"
    >
      <div class="gift__item line" v-for="(item,i) in datalist" :key="i">
        <ks-create-bg :src="item.defaultpic" class="img"/>
        <div class="info">
          <div class="name">{{item.title}}</div>
          <div
            class="type"
            v-if="item.type == 0"
          >{{(item.courseType == 1 && '点播课程') || (item.courseType == 2 && '语音直播') || (item.courseType == 3 && '音频课程') || (item.courseType == 4 && '图文课程')}}</div>
          <div class="type" v-else-if="item.type == 7">专栏</div>
          <div class="type" v-else-if="item.type == 10">社群</div>
          <div class="time" v-if="tab.current == 0">{{item.paydate}}</div>
          <div class="lqr" v-else>领取人：{{item.name}}</div>
        </div>
        <ks-button
          type="small"
          @click="onShare(item.courseid,item.type,item.ordersn)"
          v-if="tab.current == 0"
        >送好友</ks-button>
      </div>
    </ks-page-scroll-container>

    <ks-empty type="nogift" msg="暂时没有赠送记录~" v-else-if="loaded"/>

    <store-footer/>
  </div>
</template>

<script>
import { getGiftRecord } from "@/api/user";
export default {
  name: "GiftRecord",
  data() {
    return {
      datalist: [],
      tab: {
        current: 0,
        options: ["未赠出", "已赠出"]
      },
      page: 1,
      loaded: false,
      shareFlag: false,
      pageCount: null
    };
  },

  methods: {
    slideTab(val) {
      this.getGiftList();
    },
    getGiftList(page = 1) {
      this.$showLoading();
      this.page = page;
      if (page === 1) {
        this.loaded = false;
        this.datalist = [];
      }
      getGiftRecord({
        type: this.tab.current,
        p: page,
        maxperpage: 10
      }).then(res => {
        this.pageCount = res.page.total_pages;
        this.datalist = this.datalist.concat(res.values);
        this.loaded = true;
        this.$hideLoading();
      });
    },
    /**
     * 送好友
     */
    onShare(_id, _type, _ordersn) {
      this.$router.push({
        name: "ToGift",
        query: {
          id: _id,
          type: _type,
          ordersn: _ordersn
        }
      });
    }
  },
  mounted() {
    this.getGiftList();
  },
  activated() {
    document.title = "赠送记录";
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.gift__item {
  background: #fff;
}
.gift__item {
  display: flex;
  align-items: center;
  padding: 15px;
}
.gift__item .img {
  width: 120px;
  height: 68px;
}

.gift__item .info {
  flex: 1;
  position: relative;
  overflow: hidden;
  margin-left: 15px;
}
.gift__item .info .name {
  font-size: 16px;
  white-space: nowrap;
  font-weight: bold;
  overflow: hidden;
  text-overflow: ellipsis;
}
.gift__item .info .time {
  font-size: 12px;
  color: #666;
  margin-top: 5px;
}
.gift__item .type {
  margin-top: 10px;
  color: #666;
}

.gift__item .lqr {
  color: #666;
  margin-top: 4px;
}
.gift__item .btn {
  display: inline-block;
  padding: 10px 15px;
  background: #37a7ed;
  color: #fff;
  border-radius: 5px;
  font-size: 14px;
}

.gift__item .numb {
  color: #d84c29;
}
</style>
