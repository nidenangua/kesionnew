<template>
    <div class="page" v-if="pageflag">
        <ks-page-scroll-container :page="page" :page-count="pageCount" @page-change="onPageChange" v-if="flag">
            <div class="account">
                <kd-search placeholder="搜索子账号"/>
                <ks-tabs v-model="tabActive" @tab-click="handleClick">
                    <ks-tab-pane :label="item.name" :name="item.val" v-for="(item,i) in tabList" :key='i'></ks-tab-pane>
                </ks-tabs>
                <!-- 列表 -->
                <div class="accountList" v-for="(item,i) in list" :key='i' >
                    <div class="accountList-msg">
                        <div class="accountList-msg__left">
                            <ks-image :src="item.head" class="head-img"></ks-image>
                            <span class="accountList-msg__left--big">
                                <span class="accountList-msg__left--name">{{item.username}}</span>
                                <span class="accountList-msg__left--role">{{item.role_name}}</span>
                            </span>
                        </div>
                        <div class="accountList-list">
                           <img src="../../../assets/mall/address_btn_delet.png" alt="" @click="del(item.userid,i)" class="listdel">
                        </div>
                    </div>
                    <div class="accountList-info">
                        <span>收益：{{item.total_order ==  null ? 0 :item.total_order}}元</span>                               
                    </div>
                    <div class="accountList-info">
                        <span>订单：{{item.order_num}}个</span>                    
                        <span>学员：{{item.student_num}}</span> 
                    </div>
                    <div class="operation">
                        <div class="operation-del" style="height:20px"  @click="change(item.userid)">
                                <ks-switch v-model="item.flag" class="ks-fl"></ks-switch>
                        </div>
                        <div class="operation-look">
                            <ks-button  class="ks-ml5" @click="seeyield(item.userid)">查看收益</ks-button>
                            <ks-button  class="ks-ml5" @click="seeOrder(item.userid)">查看订单</ks-button>
                        </div>
                    </div>
                </div>
                <ks-empty msg="当前没有任何数据~" v-if="list.length == 0"/>
            </div>
            <div class="newcourse">
                <ks-button type="success" width="95%" class="ks-btn" @click="newaccoun">添加子账号</ks-button>
            </div>
        </ks-page-scroll-container>
    </div>
</template>

<script>
import {subAccount,roleList,delAccount,isEnable} from '@/api/user'
export default {
    data() {
        return {
            flag:false,
            pageflag:false,
            tabActive: "0",
            tabList:[{name:"全部",val:'0'}],
             /**分页 */
            page:1,
            /**总条数 */
            pageCount:1,
            list:[],
            type:0,
            /**能否添加子账号 */
            version:''
        }
    },
    methods: {
        handleClick(val) {
            this.type = val
            this.getList()
        },
        getList(page = 1) {
            this.page = page;
            subAccount({p:page,maxperpage:10,courseType:this.courseType,roleid:this.type,keyword:this.$route.query.key}).then(res=>{
                this.version = res.version
                res.list.map(item=>{
                    item.status == 0 ? item.flag = false : item.flag = true
                })
                this.pageCount = res.page.total_pages;
                this.list = (page == 1 ? res.list : this.list.concat(res.list))
                this.flag = true
            })
        },
        onPageChange(page) {
            this.getList(page)
        },
        /**子账号删除 */
        del(id,i) {
            this.$confirm("是否确认删除？").then(()=>{
                delAccount({userid:id}).then(res=>{
                    if(res.result == "success") {
                        this.list.splice(i,1)
                        this.$toast('删除成功','success')
                    }
                })
            })
        },
        /**子账号是否开启 */
        change(id) {
            isEnable({userid:id})
        },
        /**添加子账号 */
        newaccoun() {
            let {version} = this
            if(version != 0 && version != 1 && version !=2 && version!=3 && version!=100) {
                return this.$toast("该功能需要在开通基础版或开通插件权限后方可使用,建议尽快开通服务")
            }else {
                this.$router.push('/user/newAccoun')
            }
        },
        /**查看收益 */
        seeyield(id) {
            this.$router.push(`/user/accounIncome?id=${id}`)
        },
        /**查看订单 */
        seeOrder(id) {
            this.$router.push(`/user/order?id=${id}`)
        }
    },
    created() {
        roleList().then(res=>{
            res.data.map(item=>{
                this.tabList.push({name:item.title,val:item.id})
            })
            this.getList()
            this.pageflag = true
        })
    },
    computed: {
        key() {
            return this.$route.query.key
        }
    },
    watch: {
        key() {
            this.getList()
        }
    },
}
</script>

<style scoped>
.page{
    background-color: #fff;
    font-size: 14px
}
.page /deep/ .ks-tabs__header {
  overflow: auto;
}
.page /deep/ .ks-tabs__header::-webkit-scrollbar {
    display: none;
}
.page /deep/ .ks-tab__item{
    margin-right: 27px;
    flex: 1 0 auto;
}
.page /deep/ .ks-tabs__header{
    padding-left: 27px;
}
.accountList{
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
.accountList-info{
    margin-left: 57px;
}
.accountList-info span {
    display: inline-block;
    width: 32%;
}
.operation{
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}
.ks-ml5{
    font-size: 14px !important;
    height: 35px !important;
    line-height: 35px !important;
}
.ks-ml6{
    font-size: 14px !important;
    height: 32px !important;
    line-height: 32px !important;
}
.newcourse{
    background-color: #fff;
    position: fixed;
    bottom: 0;
    text-align: center;
    width: 100%;
}
.head-img{
    border-radius: 50%
}
.accountList-info{
    color: #a0a0a0
}
.listdel{
    width: 18px;
}
.accountList-list{
    margin-right: 15px;
    padding-top: 8px
}
.accountList-msg__left--name{
    margin-left: 12px;
    display: inline-block;
    max-width: 100px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    font-size: 15px
}
.accountList-msg__left--role{
    padding: 2px 8px;
    color: #fff;
    background-color: #669eff;
    font-size: 12px;
    border-radius: 15px;
    max-width: 76px;
    display: inline-block;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.accountList-msg__left--big{
    padding-top: 5px;
}
.page /deep/ .ks-bg-primary{
    background-color: #699efb;
}
.page /deep/ .ks-color-primary{
    color: #699efb;
}
</style>
