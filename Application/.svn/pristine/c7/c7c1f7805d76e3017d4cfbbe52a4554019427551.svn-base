<template>
<!-- 推广中心 -->
    <div>
        <ks-container>
            <ks-title name="推广中心"/>
            <el-row>
                <el-col :span="10" class="expand-box">    
                    <el-row>
                        <el-col :span="8" class="expand">
                            <div class="expand-money">{{all_salesincome}}</div>
                            <span>推广总收益(元)</span>
                        </el-col>
                        <el-col :span="8" class="expand">
                            <div class="expand-money">{{have_withdrawal}}</div>
                            <span>已提现(元)</span>
                        </el-col>
                        <el-col :span="8" class="expand">
                            <div class="expand-money">{{no_withdrawal}}</div>
                            <span>待提现(元)</span>
                            <a @click="open()" class="expand-cash">提现</a>
                        </el-col>
                    </el-row>
                </el-col>
                <el-col :span="14" class="expandright">
                    <el-row class="expandright-line">
                        <el-col :span="6" class="expandright-box">
                            <el-input :value="url" ref="storeUrl">{{url}}</el-input>
                            <img class="expandright-qrcode" :src="qrcode">
                        </el-col>
                        <el-col :span="6" >
                            <el-button size="medium" type="primary" @click="copyStoreUrl()">复制推广链接</el-button>
                            <a :href="dowQrcode" download="推广二维码">
                                <el-button size="medium" type="primary" class="ks-mt20">下载推广二维码</el-button>
                            </a>
                        </el-col>
                        <el-col :span="12" class="expandright-explain">
                            <ul>
                                <li>推广说明：</li>
                                <li>1、每推广一家机构入驻并购买服务，则能获得该机构购买服务定金金额的{{salesincome2}}收益</li>
                                <li>2、每推广一位名师进入名师扶持计划，则能获得名师与平台结算金额的{{salesincome1}}收益</li>
                            </ul>
                        </el-col>
                    </el-row>
                </el-col>
            </el-row>
        </ks-container>
        <ks-container style="paddingTop: 0px;">
            <el-tabs v-model="activeName">
                <el-tab-pane label="推广明细" name="first">
                     <!-- 下拉、搜索 -->
                    <template class="ks-mt10">
                        <el-select v-model="value" placeholder="机构/名师名称">
                            <el-option
                            v-for="item in options"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value">
                            </el-option>
                        </el-select>
                    </template>
                    <el-input placeholder="请输入内容" v-model="searchVal" @change="onSalesCurrentChange" class="input-with-select">
                        <el-button slot="append" icon="el-icon-search"></el-button>
                    </el-input>
                    <!-- 表格 -->
                    <template>
                     <el-table
                        class="ks-mt20"
                        :data="tableData"
                        stripe
                        style="width: 100%">
                        <el-table-column
                        prop="sitename"
                        label="机构/名师名称"
                        width="180">
                        </el-table-column>
                        <el-table-column
                        prop="version"
                        label="使用版本"
                        width="180">
                        </el-table-column>
                        <el-table-column
                        prop="packtime"
                        label="有效期">
                        </el-table-column>
                        <el-table-column
                        prop="server_money"
                        label="服务金额(元)">
                        </el-table-column>
                        <el-table-column
                        prop="market_money"
                        label="总销售额(元)">
                        </el-table-column>
                        <el-table-column
                        prop="salesincome"
                        label="推广收益(元)">
                        </el-table-column>
                    </el-table>
                    <!-- 分页 -->
                    <el-pagination
                        background=""
                        layout="prev, pager, next"
                        :page-count="salesPagecount"
                        :current-page="salesCurrentPage"
                        @current-change="onSalesCurrentChange"
                        class="table-page"
                    ></el-pagination>
                    </template>
                </el-tab-pane>
                <!-- 下拉、搜索 -->
                <el-tab-pane label="提现记录" name="second">
                     <el-table
                        class="ks-mt20"
                        :data="recordDate"
                        stripe
                        style="width: 100%">
                        <el-table-column
                        size="200"
                        prop="name"
                        label="提现姓名">
                        </el-table-column>
                        <el-table-column
                        prop="adddate"
                        label="提现时间">
                        </el-table-column>
                        <el-table-column
                        prop="cmoney"
                        label="提现金额"
                        width="180">
                        </el-table-column>
                        <el-table-column
                        prop="poundage"
                        label="提现手续费"
                        width="180">
                        </el-table-column>
                        <el-table-column
                        prop="actualmoney"
                        label="扣除手续费，实际到账金额">
                        </el-table-column>
                        <el-table-column
                        prop="userip"
                        label="操作IP">
                        </el-table-column>
                       <el-table-column
                        prop="mark"
                        label="备注">
                       </el-table-column>
                    </el-table>
                     <el-pagination
                        background=""
                        layout="prev, pager, next"
                        :page-count="withdrawPagecount"
                        :current-page="withdrawCurrentPage"
                        class="table-page"
                    ></el-pagination>
                </el-tab-pane>
            </el-tabs>
        </ks-container>
    </div>
</template>

<script>
import { salesList, withdrawList} from "@/api/applyfor";
 export default {
    data() {
      return {
        activeName: 'first',
        qrcode:'',
        all_salesincome:'',
        have_withdrawal:'',
        no_withdrawal:'',
        url:'',
        dowQrcode:'',
        tableData: [],
        recordDate:[],
        options: [{
          value: '选项1',
          label: '机构/名师名称'
        }],
        /**推广分页设置 */
        salesPagecount: 1,
        salesCurrentPage:1,
        /**推广分页设置 */
        withdrawCurrentPage: 1,
        withdrawPagecount:1,
        total:0,
        value: '',
        searchVal:'',
        salesincome1:'',//名师
        salesincome2:'',//机构
      }
    },
    computed: {
      
    },
    methods:{
        onSalesCurrentChange(p=1) {
            this.salesCurrentPage = p;
            //获取推广数据
            salesList({
                p:p,
                keyword:this.searchVal
            }).then(res => {
                this.salesincome1 = res.salesincome1;
                this.salesincome2 = res.salesincome2;
                this.qrcode = res.qrcode;
                this.all_salesincome = res.all_salesincome;
                this.have_withdrawal = res.have_withdrawal;
                this.no_withdrawal = res.no_withdrawal;
                this.tableData = res.list;
                this.url = res.url;
                this.salesPagecount = Number(res.page.total_pages);
                this.salesCurrentPage = Number(res.page.now_page);
                var url = this.qrcode;
                this.dowQrcode = url.replace(/^https:\/\/[^/]+/, "");
                console.log(this.dowQrcode)
            });
        },
        withdrawCurrent(p=1) {
            this.withdrawCurrentPage = p;
            //获取推广数据
            salesList({
                p:p
            }).then(res => {
                this.withdrawPagecount = Number(res.page.total_pages);
                this.withdrawCurrentPage = Number(res.page.now_page);
            });
        },
        /**
         * 复制链接
         */
        copyStoreUrl() {
            var Url = this.$refs.storeUrl.$refs.input;     
            Url.select(); // 选择对象
            document.execCommand("Copy"); // 执行浏览器复制命令
            this.$msg("复制成功！您可在微信或浏览器打开", "success");
        },
        /**
         * 跳转
         */
        open() {
        this.$router.push('/?url=/home.html/default/Capital/salesWithdrawapply')
        },
    },
    mounted() {
        this.onSalesCurrentChange();
        
        withdrawList().then(res =>{
            this.recordDate = res.list;
            this.withdrawPagecount = Number(res.page.total_pages);
            this.withdrawCurrentPage = Number(res.page.now_page);
        });
    },
  }
</script>
<style scoped>
    /* 顶部 */
    .expand{padding: 10px;text-align: center;}
    .expand span{font-size: 16px;color: #666}
    .expand-cash{font-size: 16px;color:#488bff;line-height: 38px;display: block;cursor:pointer}
    .expand-money{font-size: 32px;font-weight: normal;}
    .expandright{padding-top: 30px}
    .expandright-qrcode{width: 100%;padding-top: 20px;height: 160px;}
    .expandright-box{padding:0 30px 0 45px;}
    .expandright-line{border-left: 0.5px solid #6666;}
    .expandright-explain{font-size: 14px;color: #999;}
    .expand-box{padding-top: 80px;}
    .el-button+.el-button {margin-left: 0px;}
    .expandright-line .el-button{width: 140px;}
    /* 表单部分 */
    .expand-pagination{text-align: right;margin-top: 20px;}
    
    .table-page {text-align: right;margin-top: 25px;}
</style>