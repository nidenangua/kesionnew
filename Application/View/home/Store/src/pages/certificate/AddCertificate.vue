<template>
    <ks-container class="page">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item :to="{ path: '/certificate' }">证书管理</el-breadcrumb-item>
            <el-breadcrumb-item>编辑证书</el-breadcrumb-item>
        </el-breadcrumb>
        <div class="tips">请您遵守国家相关规定，切勿上传低俗色情、暴力恐怖、谣言诈骗、侵权盗版等相关内容，课堂街保有依据国家规定及平台规则进行处理的权利。</div>
        <div class="certhead">
            <!-- <div>
                <ks-image src='https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=3815069140,3927461064&fm=26&gp=0.jpg' class="certhead-img"></ks-image>
            </div> -->
            <div class="certhead-msg">
                <p class="certhead-title">{{relevance.title}}</p>
                <p class="certhead-sen">试卷总分：<span class="certhead-title__total">{{relevance.sumscore}}</span></p>
                <p class="">创建时间：{{relevance.adddate}}</p>
            </div>
        </div>
        <div class="certopen">
            <div>
                <span>是否开启考试证书</span>
                <el-switch
                    v-model="value"
                    active-color="#2a75ed"
                    >
                </el-switch>
            </div>
            <p class="certopen-over">考试结束后，可以给用户发放考试证书。生成后，用户可在个人中心-我的成就查看已生成证书</p>
        </div>
        <div class="certcon">
            <!-- 左侧证书信息 -->
            <div class="certcon-tem">
                <div class="certcon-tem__con" :style="{background:'url('+backImg+') center center / contain no-repeat'}">
                    <p :class="['certcon-tem__con--title',activenum == 1 ? 'bgactive' :'']">{{ruleForm.title}}</p>
                    <div class="certcon-tem__msg">
                        <img src="../../assets/certificate/logo.png" alt="" class="certcon-tem__msg--image">
                        <p :class="['certcon-tem__msg--name',activenum == 1 ? 'bgactive' :'']">松仔</p>
                        <p :class="['certcon-tem__msg--grade',activenum == 1 ? 'bgactive' :'']"> 在《测试考试》获得了90分</p>
                        <p :class="['certcon-tem__msg--com',activenum == 1 ? 'bgactive' :'']">
                            <span  v-if="remarkMsg && remarkMsg.length">{{remarkMsg[0].comment}}</span>
                            <span v-else>“坚持做自己，坚持进步，坚持进步，坚持进步对知识点掌握非常不错，继续加油，相信会取得更大的成就！”</span>
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
            <!-- 右侧证书信息 -->
            <div class="certcon-set">
                    <p class="certcon-rule">发放证书规则</p>
                    <div class="send-rule">
                        <div class="send-rule__grade">
                            考试成绩 <span class="must">*</span>
                        </div>
                        <div>
                            <span>大于等于</span>
                            <el-input class="scoreInput" v-model="ruleForm.score" oninput="value=value.replace(/[^\d]/g,'')" placeholder="输入分数"></el-input>
                            (当前试卷总分为 <span class="scoreInput-total">{{relevance.sumscore}}</span> 分)
                        </div>
                    </div>


                    <p class="certcon-rule">证书设置</p>
                    <div class="certificate-set">
                        <div class="send-rule__grade">
                            证书名称 <span class="must">*</span>
                        </div>
                        <div>
                            <el-input v-model="ruleForm.title" placeholder="请输入证书名称"></el-input>
                        </div>
                    </div>

                    <div class="certificate-set">
                        <div class="send-rule__grade">
                            证书背景 <span class="must">*</span>
                        </div>
                        <div>
                            <p class="certcon-bg">证书图片建议尺寸 750*1334px 或 9:16，jpg/png 格式，大小不超过 2MB</p>
                            <el-button
                                @click="$uploadImages(ruleForm,'imgurl')"
                            >上传底图</el-button>
                            <div class="certcon-select">
                                <div :class="['certcon-select__change',activenum == -1 ? 'active':'']" @click="active(-1)">
                                    <ks-image :src="ruleForm.imgurl" class="certcon-select__change--img"></ks-image>
                                    <img src="../../assets/certificate/select.png" alt="" class="selectimg" v-if="activenum == -1">
                                </div>
                                <div :class="['certcon-select__fix',activenum == index ? 'active':'']" v-for="(item,index) in bgimg" :key="item.id" @click="active(index,item)">
                                    <img :src="item.url" alt="" class="certcon-select__fix--img">
                                    <img src="../../assets/certificate/select.png" alt="" class="selectimg" v-if="activenum == index">
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="certificate-set">
                        <div class="send-rule__grade">
                            得分设置 <span class="must">*</span>
                        </div>
                        <div class="set-right">
                            <el-row class="scoreset">
                                <el-col :span="4">得分范围</el-col>
                                <el-col :span="16">点评内容 </el-col>
                                <el-col :span="4">操作</el-col>
                            </el-row>
                            <!-- 点评内容 -->
                            <el-row class="remark-conetent" v-for="(item,i) in remarkMsg" :key="i">
                                <el-col :span="4">{{item.num_start}}-{{item.num_end}}</el-col>
                                <el-col :span="16">{{item.comment}} </el-col>
                                <el-col :span="4" class="compile"><span @click="compileRemark(item,i)">编辑</span> | <span @click="delremark(i)">删除</span></el-col>
                            </el-row>
                            <!-- 添加点评 -->
                            <div class="addremark" v-if="flag">
                                <div class="addremark-scope">
                                    <span>得分范围<span class="must">*</span></span>
                                    <el-input class="scoreInput" v-model="ruleForm.num_start" oninput="value=value.replace(/[^\d]/g,'')" placeholder="输入分数"></el-input> - 
                                     <el-input class="scoreInput" v-model="ruleForm.num_end" oninput="value=value.replace(/[^\d]/g,'')" placeholder="输入分数"></el-input> 分
                                </div>
                                <div class="addremark-scope">
                                    <span>点评内容<span class="must">*</span></span>
                                    <el-input
                                        type="textarea"
                                        resize="none"
                                        placeholder="请输入内容"
                                        v-model="ruleForm.comment"
                                        class="remarktext">
                                    </el-input>
                                </div>
                                <div class="addremark-btn">
                                    <el-button @click="cancel">取消</el-button>
                                    <el-button @click="saveRemark" type="primary">保存</el-button>
                                </div>
                            </div>
                            <p class="addset" @click="addremark">添加点评</p>
                        </div>
                    </div>
                    <!-- 二维码设置 -->
                    <div class="certificate-set">
                        <div class="send-rule__grade">
                            二维码设置 <span class="must">*</span>
                        </div>
                        <div class="upload-code">
                            <div class="upload-code__img">
                                <!-- <img src="../../assets/certificate/code.jpg" alt=""> -->
                                <ks-image :src="ruleForm.qrcode" class="ewm-img"></ks-image>
                            </div>
                            <div class="upload-code__msg">
                                <el-button @click="$uploadImages(ruleForm,'qrcode')">选择二维码</el-button>
                                <p>点击上传图片，建议尺寸750*750px的正方形二维码图片，您可选取公众号二维码等，jpg/png格式，图片小于1MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="certificate-set">
                        <div class="send-rule__grade">
                            分享语 
                            <!-- <span class="must">*</span> -->
                        </div>
                        <div>
                            <el-input v-model="ruleForm.share" placeholder="请输入分享语" class="certificate-share"></el-input>
                        </div>
                    </div>
            </div>
        </div>
        <div class="add-data-footer" align="center">
            <el-button type="primary" @click="saveset()" >保存设置</el-button>
            <el-button @click="$router.push('/certificate')">取消</el-button>
        </div>
    </ks-container>
</template>

<script>
import {addCertificate,getCertificate,getLinkDetail} from '@/api/certificate'
export default {
    data() {
        return {
            /**判断是添加还是编辑 */
            add:-1,
            /**关联数据 */
            relevance:{},
            /**背景 */
            activenum:'0',
            backImg:'/Public/app/images/certificate_bg1.png',
            bgimg:[
                {url:'/Public/app/images/certificate_bg1.png',id:1},
                {url:'/Public/app/images/certificate_bg2.png',id:2},
                {url:'/Public/app/images/certificate_bg3.png',id:3},
                {url:'/Public/app/images/certificate_bg4.png',id:4},
                {url:'/Public/app/images/certificate_bg5.png',id:5},
            ],
            /**判断是编辑还是添加 */
            handleFlag:false,
            compileIndex:'',
            flag:false,
            /**是否上架 */
            value:true,
            ruleForm:{
                /**图片地址 */
                imgurl:'',
                /**分数 */
                score:'',
                title:'',
                sharepic:'',
                /**点评分数 */
                num_start:'',
                num_end:'',
                /**点评内容 */
                comment:'',
                /**分享语 */
                share:'',
                /**二维码 */
                qrcode:'',
                /**关联id */
                infoid:'',
                /**点评内容 */
                remarkcontent:''
            },
            /**点评数据 */
            remarkMsg:[]
        }
    },
    methods: {
        /**切换背景 */
        active(i,item) {
            if(i>=0) {
                this.backImg = item.url
            }else {
                if(!this.ruleForm.imgurl) return this.$message.error("请先上传图片")
                this.backImg = this.ruleForm.imgurl
            }
            this.activenum = i
        },
        /**添加点评 */
        addremark() {
            this.flag = true
            this.handleFlag = true
            this.add = -1
        },
        cancel() {
            this.flag = false
            this.clearnmsg()
        },
        clearnmsg() {
            this.ruleForm.num_start =""
            this.ruleForm.num_end =""
            this.ruleForm.comment =""
        },
        /**保存点评 */
        saveRemark() {
            let {ruleForm}  = this
            let flag = true
            if(!ruleForm.num_start || !ruleForm.num_end) return this.$message.error("请填写得分范围")
            if(!ruleForm.comment) return this.$message.error("请填写点评内容")
            if(Number(ruleForm.num_start) > Number(ruleForm.num_end)) return this.$message.error("下限分数必须小于上限分数，请检查")
            if(this.add == -1) {
                this.remarkMsg.map(item=>{
                if((Number(ruleForm.num_start) >= Number(item.num_start) && Number(ruleForm.num_start) <= Number(item.num_end))||(Number(ruleForm.num_end) >= Number(item.num_start) && Number(ruleForm.num_end) <= Number(item.num_end))){
                    flag = false
                }
            })
            }else {
                this.remarkMsg.map((item,i)=>{
                    if(i != this.add) {
                        if((Number(ruleForm.num_start) >= Number(item.num_start) && Number(ruleForm.num_start) <= Number(item.num_end))||(Number(ruleForm.num_end) >= Number(item.num_start) && Number(ruleForm.num_end) <= Number(item.num_end))){
                            flag = false
                        }
                    }
                })
            }
            if(!flag) return this.$message.error('得分范围有重合，请检查')
            let obj = {
                num_start:ruleForm.num_start,
                num_end:ruleForm.num_end,
                comment:ruleForm.comment
            }
            if(this.handleFlag){
                this.remarkMsg.push(obj)
            }else {
                this.remarkMsg[this.compileIndex].num_start = this.ruleForm.num_start
                this.remarkMsg[this.compileIndex].num_end = this.ruleForm.num_end
                this.remarkMsg[this.compileIndex].comment = this.ruleForm.comment
            }
            this.clearnmsg()
            this.flag = false
        },
        /**删除点评 */
        delremark(i) {
            this.remarkMsg.splice(i,1)
        },
        /**编辑点评 */
        compileRemark(item,i){
            this.add = i
            this.compileIndex = i
            this.handleFlag = false
            this.flag = true
            this.ruleForm.num_start = item.num_start
            this.ruleForm.num_end = item.num_end
            this.ruleForm.comment = item.comment
        },
        /**获取证书详情 */
        async getCertificateMsg() {
            let {ruleForm}  = this
            const {msg:data}  = await getCertificate({id:this.$route.query.id})
            ruleForm.title = data.title
            ruleForm.imgurl = data.cover
            ruleForm.score = data.sumscore
            this.remarkMsg = data.json
            ruleForm.qrcode = data.qrcode
            ruleForm.share = data.share_title
            ruleForm.infoid = data.infoid
            if(data.cover) {
                this.activenum = -1
            }else {
                this.activenum = 0
            }
            if(this.activenum == -1) {
                this.backImg = data.cover
            }else {
                this.backImg = require('../../assets/certificate/certificate1.png')
            }
            this.value = data.status == 1 ? true : false
            this.getlink()
        },
        /**关联数据 */
        async getlink() {
            let infoid
            if(this.$route.query.infoid !=  undefined) {
                infoid = this.$route.query.infoid
            }else {
                infoid = this.ruleForm.infoid
            }
            const relevance = await getLinkDetail({infoid})
            this.relevance = relevance.detail
        },
        /**保存设置 */
        async saveset() {
            if(this.flag) return this.$message.error("请先保存得分设置")
            let {ruleForm} = this
            let status = this.value == true ? 1 :0
            let obj = {
                infoid:ruleForm.infoid || this.$route.query.infoid,
                type:1,
                id:this.$route.query.id,
                title:ruleForm.title,
                share_title:ruleForm.share,
                sumscore:ruleForm.score,
                status:status,
                // cover:ruleForm.imgurl,
                cover:this.backImg,
                qrcode:ruleForm.qrcode,
                json:this.remarkMsg
            }
            const res = await addCertificate(obj)
            if(res.result === "success"){
                this.$message.success("保存成功")
                setTimeout(() => {
                    this.$router.push('/certificate')
                }, 800);
            }
        }
    },
    created() {
        if(this.$route.query.id != undefined) {
            this.getCertificateMsg()
        }
        if(this.$route.query.infoid != undefined) {
            this.getlink()
            this.remarkMsg = []
            Object.keys(this.ruleForm).forEach(key => {
                    this.ruleForm[key] = ''
            })
        }
    },
    computed: {
        id(){
            return this.$route.query.id
        },
        score() {
            let score = this.ruleForm.score
            let num_start = this.ruleForm.num_start
            let num_end = this.ruleForm.num_end
            return {score,num_start,num_end}
        },
        infoid() {
            return this.$route.query.infoid
        }
    },
    watch: {
        id() {
            if(this.$route.name == 'AddCertificate' && this.$route.query.id !== undefined) {
                this.getCertificateMsg()
            }
        },
        infoid() {
            if(this.$route.name == 'AddCertificate' && this.$route.query.infoid !== undefined) {
                this.activenum = '0'
                this.backImg = '/Public/app/images/certificate_bg1.png',
                this.getlink()
                this.remarkMsg = []
                Object.keys(this.ruleForm).forEach(key => {
                    this.ruleForm[key] = ''
                })
            }
        },
        score() {
            if(this.score.score>this.relevance.sumscore){
                this.ruleForm.score = parseInt(this.relevance.sumscore)
            }
            if(this.score.num_start > 100) {
                this.ruleForm.num_start = 100
            }
            if(this.score.num_end > 100) {
                this.ruleForm.num_end = 100
            }
        },
        deep:true
    },
}
</script>

<style scoped>
.page{
    font-size: 14px
}
.tips {
  background-color: #fdf6ec;
  color: #e6a23c;
  line-height: 22px;
  padding: 12px 15px;
  border-radius: 4px;
  margin: 20px 0;
}
.certhead{
    height: 112px;
    padding: 20px;
    background-color: #f5f7fa;
    display: flex;
    align-items: flex-start;
    box-sizing: border-box;
    font-size: 14px;
}
.certhead-img{
    width: 128px;
    height: 72px;
    border-radius: 2px;
    margin-right: 15px;
}
.certhead-title{
    font-weight: 500;
    line-height: 22px;
    margin-bottom: 9px;
    color: #353535 !important
}
.certhead-msg p {
    color: #888;
    font-size: 12px;
    line-height: 18px;
}
.certhead-sen{
    margin-bottom: 5px;
}
.certhead-title__total{
    color: #fb6161;
}
.certopen{
    margin: 15px 0;
}
.certopen span {
    margin-right: 15px;
    font-size: 14px;
}
.certopen-over{
    color: #888;
    margin-top: 10px;
    font-size: 14px
}
.certcon{
    display: flex;
    align-items: flex-start;
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
.certcon-set{
    margin-left: 32px;
}
.certcon-rule{
    line-height: 1;
    color: #353535;
    font-weight: 600;
    font-size: 16px;
    padding-left: 8px;
    border-left: 2px solid #2a75ed;
}
.scoreInput{
    width: 95px;
}
.scoreInput /deep/ .el-input__inner {
    height: 35px !important;
    line-height: 35px
}
.scoreInput-total{
    color: #fb6161
}
.certcon-score{
    margin: 20px 0 50px 0;
}
.certcon-bg{
    color: #888;
    margin-bottom: 4px;
}
.certcon-select{
    display: flex;
    margin-top: 20px
}
.selectimg{
    position: absolute;
    right: 0;
    top: 0;
    width: 24px;
    height: 24px;
}
.active{
    border: 1px solid #2a75ed !important;
}
.certcon-select__change {
    width: 40px;
    height: 70px;
    cursor: pointer;
    position: relative;
    border: 1px solid transparent;
}
.certcon-select__change--img{
    width: 100%;
    height: 100%;
}
.certcon-select__fix{
    width: 40px;
    height: 70px;
    margin-left: 20px;
    cursor: pointer;
    border: 1px solid transparent;
    position: relative;
}
.certcon-select__fix--img{
    width: 100%;
    height: 100%;
}
.scoreset{
    background-color: #fafbfc;
    text-align: center;
    border-bottom: 1px solid #eee;
}
.must{
    color: #e64340
}
.send-rule{
    display: flex;
    margin: 20px 0 50px 0;
    align-items: center;
}
.send-rule__grade{
    margin-right: 20px;
    width: 100px;
}
.certificate-set{
    display: flex;
    margin: 20px 0;
}
.set-right{
    box-sizing: border-box;
    width: 600px;
    border: 1px solid #eee;
}
.scoreset{
    padding: 10px;
    box-sizing: border-box;
}
.addset{
    text-align: center;
    padding: 10px 0;
    cursor: pointer;
}
.addremark{
    padding:15px 30px;
    border-bottom: 1px solid #eee;
}
.addremark-scope{
    margin-bottom: 15px;
}
.remarktext{
    margin-top: 10px;
}
.addremark-btn{
    text-align: right
}
.compile{
    color: #eeeeee;
}
.compile span {
    color: #2a75ed;
    cursor: pointer;
}
.remark-conetent{
    text-align: center;
    border-bottom: 1px solid #eee;
    height: 42px;
    line-height: 42px;
}
.upload-code{
    display: flex
}
.upload-code__img{
    width: 120px;
    height: 120px;
    margin-right: 20px
}
.upload-code__img img{
    width: 100%;
    height: 100%;
}
.upload-code__msg p {
    color: #888;
    width: 400px;
    margin-top: 10px;
}
.certificate-share{
    width: 500px;
}
.add-data-footer {
  border-top: 1px solid #eee;
  padding-top: 20px;
}
.bgactive{
    color: #fff
}
.ewm-img{
    height: 120px;
}
</style>
