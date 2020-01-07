<template>
    <ks-container>
        <ks-title name="证书管理" border="none"/>
        <el-tabs v-model="activeName">
            <el-tab-pane label="考试" name="first">
                <div class="friend-con-addhelp">
                    <div>
                        <el-input placeholder="请输入搜索内容" prefix-icon="el-icon-search" v-model="page.keyword" @change="searchList()" clearable></el-input>
                    </div>
                    <div>
                        <el-popover placement="bottom" width="200" trigger="click">
                            <div>
                                <span>状态 :</span>
                                <span
                                    :class="['status',activeStatusIndex==0?'active-status':'']"
                                    @click="showStatusList(0)"
                                >不限</span>
                                <span
                                    :class="['status',activeStatusIndex==1?'active-status':'']"
                                    @click="showStatusList(1)"
                                >已开启</span>
                                <span
                                    :class="['status',activeStatusIndex==2?'active-status':'']"
                                    @click="showStatusList(2)"
                                >未开启</span>
                            </div>
                            <el-button
                                slot="reference"
                                type="primary"
                                icon="iconfont icon-filter"
                                size="small"
                            ></el-button>
                        </el-popover>
                        <el-button type="primary" icon="iconfont icon-plus" size="small" @click="addcertificate">添加证书</el-button>
                    </div>
                </div>
                <el-table :data="list" tooltip-effect="dark" style="width: 100%" class="main">
                    <el-table-column label="选择" align="center" width="100">
                        <template slot-scope="scope">
                            <el-checkbox v-model="scope.row.flag" @change="checkbox"></el-checkbox>
                        </template>
                    </el-table-column>
                    <el-table-column label="证书名称" align="center" min-width="100">
                        <template slot-scope="scope">
                            <span>{{scope.row.title}}</span>
                        </template>
                    </el-table-column>
                    <el-table-column label="关联考试" align="center" min-width="100" prop="info_title">
                    </el-table-column>
                    <el-table-column prop="adddate" label="添加时间" align="center" min-width="100"></el-table-column>
                    <el-table-column label="是否开启" align="center" min-width="100">
                        <template slot-scope="scope">
                            <el-switch
                                v-model="scope.row.status"
                                active-color="#13ce66"
                                @change="certificateStatus(scope.row.id)"
                            >
                            </el-switch>
                        </template>
                    </el-table-column>
                    <el-table-column prop="price" label="操作" align="center" width="100">
                        <template slot-scope="scope">
                            <el-dropdown trigger="click" placement="bottom">
                                <i class="el-icon-more"></i>
                                <el-dropdown-menu slot="dropdown">
                                    <span>
                                        <el-dropdown-item
                                            style="text-align:center;"
                                            @click.native="compile(scope.row)"
                                        >编辑</el-dropdown-item>
                                    </span>
                                    <span>
                                        <el-dropdown-item
                                            style="text-align:center;"
                                            @click.native="preview(scope.row)"
                                        >预览</el-dropdown-item>
                                    </span>
                                    <span>
                                        <el-dropdown-item
                                            style="text-align:center;"
                                            @click.native="del(scope.row,scope.$index)"
                                        >删除</el-dropdown-item>
                                    </span>
                                </el-dropdown-menu>
                            </el-dropdown>
                        </template>
                    </el-table-column>
                </el-table>
                <div class="pirfooter">
                    <div class="pirfooter-left">
                        <span>
                            <el-checkbox v-model="allflag" @change="allcheck">全选</el-checkbox>
                            <!-- <el-button plain>
                        <i class="iconfont icon-shanchu1"></i>
                            </el-button>-->
                            <el-button icon="el-icon-delete" @click="moredel"></el-button>
                        </span>
                    </div>
                    <div class="pirfooter-right">
                        <el-pagination
                            background=""
                            layout="prev, pager, next"
                            :page-size="page.maxperpage"
                            :total="Number(listpage.totalput)"
                            :current-page="page.p"
                            @current-change="handleCurrentChange"
                        ></el-pagination>
                    </div>
                </div>
            </el-tab-pane>
        </el-tabs>
        <!-- 选择考试 -->
        <el-dialog
            title="选择考试"
            :visible.sync="dialogVisible"
            width="50%">
                <div class="visiInput">
                    <el-input class="VisibleInput" placeholder="请输入搜索内容" prefix-icon="el-icon-search" v-model="pages.keyword" @change="searchVisiList()" clearable></el-input>
                </div>
                <div class="visiSelect" v-for="(item,i) in visiList" :key="i">
                    <div>
                        <el-radio v-model="radio" :label='item.id' :disabled="item.islink == 1 ? true :false">{{item.title}}</el-radio>
                    </div> 
                    <div>
                        <span class="isset">{{item.islink == 1 ? '已设置证书' :''}}</span>
                    </div>
                </div>
                <div class="visifooter-right">
                    <el-pagination
                        background=""
                        layout="prev, pager, next"
                        :page-size="pages.maxperpage"
                        :total="Number(listpages.totalput)"
                        :current-page="pages.p"
                        @current-change="handleCurrentChanges"
                    ></el-pagination>
                </div>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="dialogVisible = false">取 消</el-button>
                    <el-button type="primary" @click="gotodel">确 定</el-button>
                </span>
        </el-dialog>
        <!-- 证书预览 -->
        <el-dialog
        title="证书预览"
        :visible.sync="certificateShow"
        width="415px">
            <div class="certcon-tem">
                <div class="certcon-tem__con" :style="{background:'url('+ruleForm.imgurl+') center center / contain no-repeat'}">
                    <p :class="['certcon-tem__con--title',ruleForm.imgurl == '/Public/app/images/certificate_bg2.png' ? 'bgactive' :'']">{{ruleForm.title}}</p>
                    <div class="certcon-tem__msg">
                        <img src="../../assets/certificate/logo.png" alt="" class="certcon-tem__msg--image">
                        <p :class="['certcon-tem__msg--name',ruleForm.imgurl == '/Public/app/images/certificate_bg2.png' ? 'bgactive' :'']">松仔</p>
                        <p :class="['certcon-tem__msg--grade',ruleForm.imgurl == '/Public/app/images/certificate_bg2.png' ? 'bgactive' :'']"> 在《测试考试》获得了90分</p>
                        <p :class="['certcon-tem__msg--com',ruleForm.imgurl == '/Public/app/images/certificate_bg2.png' ? 'bgactive' :'']">
                            <span>{{ruleForm.comment}}</span>
                            <!-- <span>“坚持做自己，坚持进步，坚持进步，坚持进步对知识点掌握非常不错，继续加油，相信会取得更大的成就！”</span> -->
                            <!-- <span class="certcon-tem__msg--osur">—吴晓波</span> -->
                        </p>
                    </div>
                    <div class="certcon-tem__focus">
                        <img :src="ruleForm.qrcode" alt="">
                        <div class="certcon-tem__focus--info">
                            <div class="certcon-tem__focus--name">{{ruleForm.share}}</div> 
                            <div class="certcon-tem__focus--desc">长按识别二维码关注</div>
                        </div>
                    </div>
                </div>
            </div>
        </el-dialog>
    </ks-container>
</template>

<script>
import {certificateList,changeStatus,getLinkList,del,getCertificate} from '@/api/certificate'
export default {
  data() {
    return {
        /**证书数据 */
        ruleForm:{
            title:'',
            comment:'',
            qrcode:'',
            share:'',
            imgurl:''
        },
        /**证书预览 */
        certificateShow:false,
        radio:'',
        /**弹框数据 */
        visiList:[],
        /**弹框请求数据 */
        pages:{
            p:1,
            maxperpage:5,
            keyword:'',
        },
        listpages:{},
        radio:true,
        dialogVisible:false,
        activeStatusIndex: "0",
        activeName: "first",
        info:{},
        /**全选 */
        allflag:false,
        /**页面数据 */
        list:[],
        /**分页数据 */
        listpage:{},
        page:{
            p:1,
            maxperpage:10,
            keyword:'',
            status:0
        },
    };
  },
  methods: {
    gotodel() {
        this.dialogVisible = false;
        if(!this.radio) return this.$message.error("请选择关联的考试")
        this.$router.push(`/addcertificate?infoid=${this.radio}`)
    },
    /**证书开关 */
    async certificateStatus(id) {
        const {data}  = await changeStatus({id:id})
    },
    /**搜索列表 */
    searchList() {
        this.getList()
    },
    searchVisiList() {
        this.getSelectList()
    },
    /**编辑 */
    compile(value) {
        this.$router.push('/addcertificate?id='+value.id)
    },
    /**预览 */
    async preview(value) {
        this.certificateShow = true;
        let {ruleForm}  = this
        const {msg:data} = await getCertificate({id:value.id})
        ruleForm.title = data.title
        if(data.json && data.json.length) {
            console.log(111)
            ruleForm.comment = data.json[0].comment
        }else {
            ruleForm.comment = ' “坚持做自己，坚持进步，坚持进步，坚持进步对知识点掌握非常不错，继续加油，相信会取得更大的成就！”'
        }
        ruleForm.qrcode = data.qrcode
        ruleForm.share = data.share_title
        ruleForm.imgurl = data.cover
    },
    /**删除 */
    del(val,index) {
        this.$confirm('此操作将永久删除该证书, 是否继续?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(async() => {
        // let id = []
        // id.push(val.id)
        const msg = await del({id:val.id})
        if(msg.result == "success") {
              this.getList()
              this.$message({
              type: 'success',
              message: '删除成功!'
            });
        } 
        }).catch(()=>{});
    },
    showStatusList(i) {
        this.activeStatusIndex = i;
        this.page.status = i
        this.getList();
    },
    /**页面改变 */
    async getList() {
        const data = await certificateList(this.page)
        data.list.map(item=>{
            item.flag = false
            item.status = item.status == 1 ? true :false
        })
        this.list = data.list
        this.listpage = data.page
    },
    /**全选 */
    allcheck() {
        let id = []
        this.list.map(item=>{
            item.flag = this.allflag  ? true : false
            item.flag ? id.push(item.id) : id = []
        })
        this.listid = id
    },
    /**单选 */
    checkbox() {
        let id = []
        let listlength = 0
        this.list.map(item=>{
            if(item.flag){
                listlength++
                id.push(item.id)
            }
        })
        this.listid = id
        this.allflag = this.list.length == listlength ? true : false
    },
    /**多选删除 */
    moredel() {
        if(!this.listid.length) return this.$message({type:'error',message:"请选择要删除的证书"})
        this.$confirm('此操作将永久删除该证书, 是否继续?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(async() => {
        const msg = await del({id:this.listid})
        if(msg.result == "success") {
              this.getList()
              this.$message({
              type: 'success',
              message: '删除成功!'
            });
        } 
        }).catch(()=>{});
    },
    handleCurrentChange(val){
        this.page.p = val;
        this.getList()
    },
    handleCurrentChanges(val){
        this.pages.p = val;
        this.addcertificate()
    },
    async getSelectList(){
        const data  = await getLinkList(this.pages)
        this.visiList = data.list
        this.listpages = data.page
    },
    /**添加证书 */
    async addcertificate() {
        this.radio = ''
        this.dialogVisible = true
        this.getSelectList()
    }
  },
  created() {
      this.getList()
  },
  watch: {
      list() {
          this.allflag = false;
          this.listid = []
      },
      $route(to,form){
          if(form.name === "AddCertificate") {
              this.getList()
          }
      },
    //   listpage() {
    //       if(this.listpage.totalput == (this.page.p-1)*this.page.maxperpage&& this.listpage.total!=0) {
    //           this.page.p -= 1;
    //           this.getList()
    //       }
    //   },
      deep:true
  },
};
</script>

<style scoped>
.el-tab-pane {
  padding: 0px;
}
.friend-con-addhelp {
  display: flex;
  justify-content: space-between;
}
.active-status {
  color: #409eff;
}
.privilege {
  display: flex;
  flex-direction: row-reverse;
  margin-right: 20px;
}
.privilege-msg {
  margin-right: 10px;
}
.main{
    margin-top: 20px;
}
.pirfooter{
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}
.page /deep/ .el-checkbox__inner{
    width: 16px;
    height: 16px;
}
.el-dropdown{
    font-size: 20px;
}
.status{
    cursor: pointer;
}
.VisibleInput{
    width: 30%;
}
.visiSelect{
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-top: 1px solid #eee
}
.visiInput{
    margin-bottom: 20px
}
.isset{
    margin-right: 20px;
    width: 70px;
    height: 22px;
    font-size: 14px;
    font-weight: 400;
    color: #888888;
    line-height: 22px;
}
.visifooter-right{
    text-align: right
}
.certcon-tem__con{
    width: 375px;
    height: 560px;
    /* background: url(../../assets/certificate/certificate1.png) center center / contain no-repeat; */
    position: relative;
}
.certcon-tem__con--title{
    font-size: 22px;
    color: #434244;
    line-height: 24px;
    padding-top: 105px;
    text-align: center;
    height: 24px;
}
.certcon-tem__msg{
    text-align: center;
}
.certcon-tem__msg{
    padding: 22px 0;
}
.certcon-tem__msg--image{
    width: 40px;
    height: 40px;
}
.certcon-tem__msg--name{
    margin-top: 9px;
    font-size: 14px;
    font-weight: 600;
}
.certcon-tem__msg--grade{
    margin-top: 10px;
    padding: 0 50px;
    font-size: 13px;
    text-align: center;
    color: #333337;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
    word-break: break-all;
    white-space: normal;
}
.certcon-tem__msg--com{
    line-height: 24px;
    text-align: justify;
    color: #333;
    width: 263px;
    font-size: 17px;
    margin: 50px auto 0;
}
.certcon-tem__msg--osur{
    display: block;
    text-align: right;
}
.certcon-tem__focus{
    display: flex;
    position: absolute;
    bottom: 40px;
    left: 25%;
}
.certcon-tem__focus img {
    width: 52px;
    height: 52px;
    margin-right: 17px;
}
.certcon-tem__focus--name{
    width: 120px;
    height: 32px;
    max-height: 32px;
    font-size: 12px;
    font-weight: 500;
    color: #333;
    line-height: 16px;
    overflow: hidden;
    word-break: break-all;
}
.certcon-tem__focus--desc{
    height: 20px;
    font-size: 12px;
    font-weight: 400;
    color: #b2b2b2;
    line-height: 20px;
}
.bgactive{
    color:#fff !important;
}
</style>
