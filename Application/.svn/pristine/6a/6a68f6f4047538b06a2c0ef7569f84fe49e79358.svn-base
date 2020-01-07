<template>
    <div class="page" v-if="pageFlag">
        <ks-page-scroll-container :page="page" :page-count="pageCount" @page-change="onPageChange">
            <div class="student">
                <div class="student-head">
                    <kd-search placeholder="搜索学员" class="search"/>
                    <van-dropdown-menu>
                        <van-dropdown-item v-model="value1" :options="option1" @change="dropdown" class="option1"/>
                    </van-dropdown-menu>
                </div>
                <ks-tabs v-model="tabActive" @tab-click="handleClick">
                    <ks-tab-pane :label="item.name" :name="item.value" v-for="(item,i) in tabList" :key="i"></ks-tab-pane>
                </ks-tabs>
            </div>
            <!-- 列表 -->
            <div class="accountList" v-for="(item,i) in list" :key ='i'>
                    <div class="accountList-msg">
                        <div class="accountList-msg__left">
                            <ks-image :src="item.head"></ks-image>
                            <span>{{item.username}}</span>
                        </div>
                        <div style="height:20px" @click="changeFlag(item.userid)">
                            <ks-switch v-model="item.flag" class="ks-fl"></ks-switch>
                        </div>
                    </div>
                    <div class="accountList-info">
                        <span>{{item.group_name}}</span>     
                    </div>
                    <div class="accountList-infos">
                        <span>推荐人：{{item.inviter}}</span>
                    </div>
            </div>
            <ks-empty msg="当前没有任何数据~" v-if="!list.length"></ks-empty>
        </ks-page-scroll-container>
    </div>
</template>

<script>
import {manageStudent,isExamine,showSub,groupShow} from '@/api/user'
export default {
  data() {
    return {
      tabActive: 0,
      /**下拉框默认 */
      value1: 0,
      /**下拉框数据 */
      option1: [
        { text: "全部分类", value: 0 },
      ],
      tabList:[{name:"全部",value:0}],
      pageFlag:false,
      /**列表数据 */
      list:[],
      /**分页 */
      page:1,
      /**总条数 */
      pageCount:1,
      /**组id */
      groupid:0,
      /**分类id */
      classid:0
    };
  },
  methods: {
    handleClick(val) {
    this.groupid= val
    this.studentList()
    },
    /**下拉框的值发生变化 */
    dropdown(val) {
        this.classid = val
        this.studentList()
    },
    /**学员管理列表 */
    studentList(page=1) {
        this.page = page
        manageStudent({p:page,maxperpage:10,keyword:this.$route.query.key,groupid:this.groupid,extuserid:this.classid}).then(res=>{
            console.log(res)
            res.list.map(item=>{
                item.status == 1 ? item.flag = true : item.flag =false
            })
            this.pageCount = res.page.total_pages;
            this.list = (page == 1 ? res.list : this.list.concat(res.list))
            console.log(this.list)
        })
    },
    onPageChange(page) {
            this.studentList(page)
    },
    /**改变子账号状态 */
    changeFlag(id){
        isExamine({userid:id})
    }
  },
  computed: {
        key() {
            return this.$route.query.key
        }
  },
  watch: {
      key(){
          this.studentList()
      }
  },
  created() {
    /**子账号查看 */
    showSub().then(res=>{
        res.list.map(item=>{
            this.option1.push({text:item.username,value:item.userid})
        })
    })
    /**学员分组 */
    groupShow().then(res=>{
        res.data.map(item=>{
            this.tabList.push({name:item.name,value:item.id})
        })
        this.pageFlag = true
    })
    this.studentList()
  },
};
</script>

<style scoped>
.page {
  font-size: 14px;
  background-color: #fff;
}
.page /deep/ .ks-tabs__header {
  overflow: auto;
}
.page /deep/ .ks-tabs__header::-webkit-scrollbar {
  display: none;
}
.page /deep/ .ks-tab__item {
  width: 20%;
  flex: 1 0 auto;
}
.search {
  width: 64% !important;
}
.student-head{
    display: flex;
}
/* .page /deep/ .van-ellipsis {
  color: #1989fa !important;
} */
.page /deep/ .van-dropdown-menu__item{
    background-color: #fff;
}
.accountList{
    background-color: #fff;
    margin-top: 10px;
    padding: 8px;
    border-top: .5px solid #f2f2f2;
    border-bottom: .5px solid #f2f2f2;
}
.accountList-msg{
    display: flex;
    justify-content: space-between;
}
.accountList .ks-image{
    width: 45px;
    height: 45px;
}
.accountList-msg__left{
    display: inline-flex;
}
.accountList-msg__left span {
    margin-left: 12px;
    padding-top: 3px;
}
.accountList-info,
.accountList-infos{
    margin-left: 57px;
}
.accountList-info span {
    display: inline-block;
    width: 32%;
}
</style>
