<template>
    <ks-container class="page">
        <ks-title name="VIP中心" border="none"/>
        <div class="privilege">
            <el-button
                type="primary"
                icon="iconfont icon-plus"
                size="small"
                @click="addPrivilege()"
            >新增VIP</el-button>
            <el-button type="info" size="small" class="privilege-msg" @click="$router.push('/setprivilege')">VIP设置</el-button>
        </div>
        <el-table :data="list" tooltip-effect="dark" style="width: 100%" class="main">
            <el-table-column  label="选择" align="center" width="100">
                <template slot-scope="scope">
                    <el-checkbox v-model="scope.row.flag" @change="checkbox"></el-checkbox>
                </template>
            </el-table-column>
            <el-table-column  label="VIP类型" align="center" min-width="100">
                <template slot-scope="scope">
                    <span>{{scope.row.type == 1 ? 'svip' : 'vip'}}</span>
                </template>
            </el-table-column>
            <el-table-column  label="有效时间" align="center" min-width="100">
                <template slot-scope="scope">
                    <span>
                        {{scope.row.time}}
                        <span v-if="scope.row.timetype == 0">天</span>
                        <span v-else-if="scope.row.timetype == 1">个月</span>
                        <span v-else>年</span>
                    </span>
                </template>
            </el-table-column>
            <el-table-column prop="adddate"  label="添加时间" align="center" min-width="100"></el-table-column>
            <el-table-column prop="sort" label="排序" align="center" min-width="100"></el-table-column>
            <el-table-column prop="price" label="价格" align="center" min-width="100"></el-table-column>
            <el-table-column prop="price" label="操作" align="center" width="100">
                <template slot-scope="scope">
					<el-dropdown trigger="click" placement="bottom">
                        <i class="el-icon-more"></i>
						<el-dropdown-menu slot="dropdown">
							<span>
								<el-dropdown-item style="text-align:center;"  @click.native="compile(scope.row)">编辑</el-dropdown-item>
							</span>
							<span>
								<el-dropdown-item style="text-align:center;"  @click.native="del(scope.row,scope.$index)">删除</el-dropdown-item>
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
                     </el-button> -->
                     <el-button icon="el-icon-delete" @click="moredel"></el-button>
                </span>
            </div>
            <div class="pirfooter-right">
                <el-pagination
                    background
                    layout="prev, pager, next"
                    :page-size="page.maxperpage"
                    :total="Number(listpage.totalput)"
                    :current-page="page.p"
                    @current-change="handleCurrentChange"
                >
                </el-pagination>
            </div>
        </div>
        <new-privilege v-if="flagShow" @isshow="isshow" :info="info" @addusers="addusers"></new-privilege>
    </ks-container>
</template>

<script>
import {getprivilege,delprivilege} from '@/api/privilege'
import NewPrivilege from './components/NewPrivilege'
export default {
  components:{
      NewPrivilege
  },
  data() {
    return {
        info:{},
        /**全选 */
        allflag:false,
        /**页面数据 */
        list:[],
        /**分页数据 */
        listpage:{},
        page:{
            p:1,
            maxperpage:10
        },
        listid:[],
        flagShow:false,
        PrivilegeId:''
    };
  },
  methods: {
    addusers() {
        this.flagShow = false
        this.getList()
    },
    addPrivilege() {
        this.flagShow = true
        this.info = {type:'0'}
    },
    isshow(val) {
        this.flagShow = val
    },
    /**页面改变 */
    async getList() {
        const data = await getprivilege(this.page)
        data.list.map(item=>{
            item.flag = false
        })
        this.list = data.list
        this.listpage = data.page
    },
    handleCurrentChange(val){
        this.page.p = val;
        this.getList()
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
    /**编辑 */
    compile(val) {
        this.info = val
        this.flagShow = true
    },
    /**删除 */
    del(val,index) {
        this.$confirm('此操作将永久删除该会员, 是否继续?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(async() => {
        let id = []
        id.push(val.id)
        const msg = await delprivilege({id})
        if(msg.result == "success") {
              this.getList()
              this.$message({
              type: 'success',
              message: '删除成功!'
            });
        } 
        }).catch(()=>{});
    },
    /**多选删除 */
    moredel() {
        if(!this.listid.length) return this.$message({type:'error',message:"请选择要删除的会员"})
        this.$confirm('此操作将永久删除该会员, 是否继续?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(async() => {
        const msg = await delprivilege({id:this.listid})
        if(msg.result == "success") {
              this.getList()
              this.$message({
              type: 'success',
              message: '删除成功!'
            });
        } 
        }).catch(()=>{});
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
      listpage() {
          if(this.listpage.totalput == (this.page.p-1)*this.page.maxperpage&& this.listpage.total!=0) {
              this.page.p -= 1;
              this.getList()
          }
      },
      deep:true
  },
};
</script>

<style scoped>
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
    cursor: pointer;
}
</style>
