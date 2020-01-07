<template>
  <div class="page">
    <ks-page-scroll-container :page="page" :page-count="pageCount" @page-change="onPageChange">
    <div class="manageTitle">
      <div class="manageTitle-num">报名列表(人数)</div>
      <div v-if="$route.query.type == 2"  @click="visible = !visible">签到二维码</div>
    </div>
    <div class="manageSearch">
      <van-dropdown-menu v-if="$route.query.type == 1">
        <van-dropdown-item v-model="value1" :options="option1" @change="dropdown"/>
      </van-dropdown-menu>
      <van-dropdown-menu v-if="$route.query.type == 2">
        <van-dropdown-item v-model="value2" :options="option2" @change="dropdowns"/>
      </van-dropdown-menu>
      <kd-search style="width: 251px;" :placeholder="'请输入要搜索的手机号码~'"></kd-search>
    </div>
    <ks-empty msg="当前没有任何内容~" type="nogift" v-if="!list.length"/>
    <!-- 人数列表 -->
    <div class="mPeople" v-for="(item,i) in list" :key='i'>
      <div class="mangePeople">
        <div class="mangePeople-img">
          <ks-image :src="item.head"></ks-image>
        </div>
        <div class="mangePeople-msg">
          <span>姓名: {{item.json.form[0].content}}</span>
          <span>票型: {{item.ticket_info.chargetype == 1 ? "收费票" : "免费票"}}</span>
          <span>手机号: {{item.mobile}}</span>
          <span>价格: {{item.ticket_info.chargetype == 1 ? item.ticket_info.price : "免费"}}</span>
          <!-- <span v-if="$route.query.type == 1">申请理由：1111</span> -->
          <span v-if="$route.query.type == 2">
              <i class="examine" v-if="item.is_sign == 0 " @click="studentList(item.id)">未签到</i>
              <i class="examine" v-else @click="studentList(item.id)">已签到</i>
          </span>
        </div>
      </div>
      <p>
          <!-- <span v-if="item.status == 3">报名成功</span>
          <span v-if="item.status == 1">已审核</span>
          <span v-if="item.status == 2">报名拒绝</span>
          <span v-if="item.status == 0">未审核</span> -->
          
          <span v-if="item.status==0">审核状态：<span style="color:#E64A3B;">未审核</span></span>
          <span v-else-if="item.status==1">审核状态：已审核</span>
          <span v-else-if="item.status==2">审核状态：被拒绝</span>
          <span v-else-if="item.status==3">审核状态：成功</span>
          <span v-if="item.status == 0">
            <ks-button class="ks-ml5" @click="pass(item.id,i)">通过</ks-button>
            <ks-button class="ks-ml5" @click="turn(item.id,i)">拒绝</ks-button>
          </span>
      </p>
      <div v-if="item.ticket_info.chargetype == 1">
          <span v-if="item.paystatus == 1" >支付状态：<span style="color:#409eff;">已支付</span></span>
          <span v-else >支付状态：<span style="color:#E64A3B;">未支付</span></span>
      </div>
    </div>
    <ks-dialog width="70%" :visible.sync="visible">
      <img width="100%" style="display:block;" :src="qrcode">
    </ks-dialog>
    </ks-page-scroll-container>
  </div>
</template>

<script>
import {getActivityList,activityCheck} from '@/api/activity'
export default {
  data() {
    return {
      value1: 0,
      value2: 0,
      option1: [
        { text: "全部", value: 0 },
        { text: "报名成功", value: 3 },
        { text: "未审核", value: 4 },
        { text: "报名拒绝", value: 2 }
      ],
      option2:[
        { text: "全部", value: 0 },
        { text: "已验票", value: 1 },
        { text: "未验票", value: 2 },
      ],
      visible:false,
      /**列表数据 */
      list:[],
      /**二维码地址 */
      qrcode:'',
      /**分页 */
      page: 1,
      /**总条数 */
      pageCount: 1,
      /**选取的值 */
      status:0,
      /**是否验票 */
      isaffirm:0
    };
  },
  methods: {
    pass(id,i) {
      activityCheck({id:id,status:1}).then(res=>{
        if(res.result == "success") {
          this.$toast("操作成功",'success')
          this.list[i].status = 3
        }
      })
    },
    turn(id,i){
      activityCheck({id:id,status:2}).then(res=>{
        this.$toast("操作成功",'success')
        this.list[i].status = 2
      })
    },
    dropdowns(value) {
      this.isaffirm = value
      this.getlist()
    },
    dropdown(value) {
      this.status = value
      this.getlist()
    },
    getlist(page=1) {
      this.page = page
      let params = {
        courseid:this.$route.query.id,
        p: page,
        maxperpage: 10,
        status:this.status,
        is_home:1,
        keywordtype:2,
        keyword:this.$route.query.key,
        is_sign:this.isaffirm
      }
      getActivityList(params).then(res=>{
        console.log(res)
        this.qrcode = res.qrcode
        this.pageCount = res.page.total_pages;
        this.list = page == 1 ? res.list : this.list.concat(res.list);
      })
    },
    onPageChange(page) {
      this.getlist(page)
    },
    /**跳转学员列表页面 */
    studentList(id) {
      this.$router.push(`/activityUserdet?id=${id}`)
    }
  },
  created() {
    this.getlist()
  },
  computed: {
    key() {
      return this.$route.query.key
    },
    id() {
      return this.$route.query.id
    }
  },
  watch: {
    key() {
      this.getlist()
    },
    id() {
      this.getlist()
    }
  },
};
</script>

<style scoped>
i {
  font-style: normal;
}
* {
  font-size: 14px;
}
body{
  background-color: #fff;
}
.page {
  padding: 10px;
  box-sizing: border-box;
  background-color: #fff;
  min-height: 100vh;
}
.manageTitle {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.manageTitle-num {
  font-size: 16px;
  font-weight: 700;
}
.van-dropdown-menu {
  max-width: 30%;
  height: 40px;
}
.page /deep/ .van-ellipsis {
  color: #1989fa !important;
}
.manageSearch {
  display: flex;
  align-items: center;
}
.page /deep/ .van-dropdown-menu__title {
  padding: 0 15px;
}
.mangePeople-img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  overflow: hidden;
  margin-right: 10px;
}
.ks-image {
  height: 40px;
}
.mPeople {
  padding: 10px;
  box-sizing: border-box;
  margin-bottom: 10px;
}
.mangePeople {
  display: flex;
  margin-bottom: 8px;
}
.mangePeople-msg {
  position: relative;
  flex: 1;
}
.mangePeople-msg {
  display: inline-flex;
  flex-wrap: wrap;
}
.mangePeople-msg span {
  width: 50%;
  margin-bottom: 2px;
}
.mPeople {
  border: 1px solid #f2f2f2;
}
.mPeople p {
  padding: 10px 0 5px 0;
  border-top: 1px solid #f2f2f2;
  display: flex;
  justify-content: space-between;
}
.ks-button {
  height: 26px !important;
  line-height: 26px !important;
}
.examine {
  position: absolute;
  right: 5px;
  top: 13px;
}
.page /deep/ .ks-dialog__body{
  padding: 0 10px 20px 10px !important;
  margin: 0 auto;
  width: 180px;
  height: 180px;
}
.page /deep/ .ks-dialog__body img{
  width: 100%;
  height: 100%;
}
</style>
