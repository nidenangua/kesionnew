<template>
  <div class="page" v-if="flag">
    <ks-tabs v-model="tabActive" @tab-click="handleClick">
      <ks-tab-pane label="全部" :name="0"></ks-tab-pane>
      <ks-tab-pane label="学员支出" :name="1"></ks-tab-pane>
      <ks-tab-pane label="学员充值" :name="2"></ks-tab-pane>
    </ks-tabs>
    <div class="student-head">
      <div>总收入：￥{{icomemoney}}元</div>
      <van-dropdown-menu>
        <van-dropdown-item v-model="value1" :options="option1" @change="dropdown" class="option1" />
      </van-dropdown-menu>
    </div>
    <ks-page-scroll-container :page="page" :page-count="pageCount" @page-change="onPageChange">
    <div class="list" v-for="(item,i) in list" :key="i">
      <div class="list-time">{{item.adddate}}</div>
      <div class="list-student">
        <div class="list-student__way">学员<a v-if="item.type == 1">支出</a><a v-if="item.type == 0">充值</a></div>
        <div class="list-student__price">￥{{item.cmoney}}</div>
      </div>
      <div class="list-some">
        <span class="list-some__name">{{item.name}}</span> <a v-if="item.mark != ''">{{item.mark}}</a><a v-if="item.mark == null">充值</a>
      </div>
    </div>
    </ks-page-scroll-container>
  </div>
</template>

<script>
import { payLog,showSub } from "@/api/user";
export default {
  data() {
    return {
      flag:false,
      tabActive: 0,
      value1: 0,
      icomemoney:'',
      /**分页 */
      page: 1,
      /**总条数 */
      pageCount: 1,
      loaded: false,
      /**列表数据 */
      list: [],
      /**下拉框数据 */
      option1: [
        { text: "全部明细", value: 0 },
      ],
      extuserid:'0'
    };
  },
  mounted() {
  showSub().then(res=>{
    res.list.map(item=>{
      this.option1.push({text:item.username,value:item.userid})
    })
  })
  },
  activated() {
    this.$route.query.id == undefined ? this.value1 = 0 : this.value1 = this.$route.query.id
    this.$route.query.id == undefined ? this.extuserid = '0' : this.extuserid = this.$route.query.id
    this.getList();
  },
  methods: {
      /**获取列表数据 */
    getList(page = 1) {
      this.page = page;
      payLog({
        p: page,
        maxperpage: 10,
        type:this.tabActive,
        extuserid:this.extuserid,
      }).then(res => {
        this.pageCount = res.page.total_pages;
        this.list = page == 1 ? res.list : this.list.concat(res.list);
        this.flag = true
        this.icomemoney = res.icomemoney
      });

    },
    onPageChange(page) {
      this.getList(page);
    },
    handleClick(val) {
      this.tabActive = val;
      this.pageCount = null;
      this.loaded = false;
      this.getList();
    },
    dropdown(val) {
      this.extuserid = val
      this.getList();
    }
  },
  computed: {
    id(){
      return this.$route.query.id
    }
  },
  watch: {
    id(){
      this.$route.query.id == undefined ? this.value1 = 0 : this.value1 = this.$route.query.id
      this.$route.query.id == undefined ? this.extuserid = '0' : this.extuserid = this.$route.query.id
    }
  },
};
</script>

<style scoped>
* {
  font-size: 14px;
}
.page {
  background-color: #fff;
}
.student-head {
  display: flex;
  justify-content: space-between;
  line-height: 50px;
  padding: 0 10px;
}
.list {
  padding: 10px;
  border-top: 0.5px solid #f2f2f2;
  border-bottom: 0.5px solid #f2f2f2;
  margin-bottom: 10px;
}
.list-student {
  display: flex;
  justify-content: space-between;
  margin: 10px 0;
  padding-right: 5px;
}
.list-some__name {
  color: #1989f8;
}
</style>
