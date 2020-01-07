<template>
    <div v-if="storeType > 0">
        <v-header :store-type="storeType" :window-width="windowWidth" v-if="$route.query.source !== 'website'" />
        <div class="login-box" :class="$route.query.source === 'website' && 'login-box--frame'" :style="{minHeight:windowWidth >= 768 ? height+'px' : height-84+'px'}">
            
            <div class="login-box__inner">
                <el-row>
                    <el-col :span="14" v-if="windowWidth >= 768">
                        <div class="login-box__left">
                            <img src="../../assets/login/4EEAACD9218CD63CE2026893FFACD9EC.png" v-if="storeType == 1" style="width:100%;display:block;" />
                            <img src="../../assets/login/E65DAB23F647A123EA7206CCDCB02944.png" v-else-if="storeType == 2" style="width:100%;display:block;" />
                        </div>
                    </el-col>
                    <el-col :span="windowWidth >= 768 ? 10 : 24">
                        <div class="login-box__right">
                            <div class="login-box__title">
                                {{$route.query.source === 'website' ? '科汛云开店注册' : '账号注册'}}
                                
                            </div>
                            <el-form :model="formData" :rules="rules" ref="regForm">  
                                <!-- <el-form-item>
                                    <div class="login-box__cell">
                                        <el-radio-group v-model="formData.usertype">
                                            <el-radio :label="1">个体讲师</el-radio>
                                            <el-radio :label="2">学校机构</el-radio>
                                        </el-radio-group>
                                    </div>
                                </el-form-item> -->
                                <el-form-item prop="sitename">
                                    <div class="login-box__cell">
                                        <el-input v-model="formData.sitename" placeholder="学校名称/教师姓名/大V名称等"></el-input>
                                    </div>
                                </el-form-item>
                                <el-form-item prop="mobile">
                                    <div class="login-box__cell">
                                        <el-input @input="handlerMobile" v-model="formData.mobile" placeholder="手机号"></el-input>
                                    </div>
                                </el-form-item>
                                <el-form-item prop="code">
                                    <div class="login-box__cell login-box__cell--code">
                                        <el-button type="primary" @click="getCode" :disabled="second > 0 && buttonText !== '获取验证码'" size="medium" plain>{{buttonText}}</el-button>
                                        <el-input v-model="formData.code" maxlength="6" placeholder="验证码"></el-input>
                                    </div>
                                </el-form-item>
                                <el-form-item prop="password">
                                    <div class="login-box__cell">
                                        <el-input type="password" v-model="formData.password" placeholder="设置密码"></el-input>
                                    </div>
                                </el-form-item>
                            </el-form>
                            <div class="login-box__cell" style="line-height:25px;">
                                <el-checkbox v-model="agree">我已阅读并同意</el-checkbox>
                                <a :href="'//store.kesion.com/home.html/default/Register/' + (storeType == 1 ? 'tcAgreement' : 'agreement')" target="_blank">《{{storeType == 1 ? '科汛V名师' : '科汛云开店'}}服务协议》</a>
                            </div>
                            <div class="login-box__cell">
                                <el-button type="primary" class="login-box__button" @click="register">立即注册</el-button>
                            </div>
                            <div class="login-box__cell login-box__cell--fot">
                                已有账号？ <router-link :to="{path:'/login',query:$route.query}">马上登陆</router-link>
                            </div>
                        </div>
                    </el-col>
                </el-row>
            </div>
            
        </div>
        <v-footer v-if="windowWidth >= 768 && $route.query.source !== 'website'" />
    </div>
</template>
<script>
import entrance from '@/mixins/entrance'
import { storeRegister,sendSms } from '@/api/user'
import { isPoneAvailable } from '@/utils'
import VHeader from '@/components/v-header'
import VFooter from '@/components/v-footer'
export default {
    name:'Register',
    components:{
        VHeader,
        VFooter
    },
    mixins:[entrance],
    data(){
        return {
            agree:false,
            buttonText:'获取验证码',
            second:60,
            formData:{
                code:'',
                usertype: 0, //注册类型，1老师2机构
                sitename:'',
                password:'',
                mobile:''
            },
            rules:{
                sitename: [
                    { required: true, message: '学校名称/教师姓名/大V名称等', trigger: 'blur' }
                ],
                mobile:[
                    {
                        validator:(rule,value,callback)=>{
                            if(value.length < 11){
                                callback(new Error('请输入11位数手机号'))
                            }else if(!isPoneAvailable(value)){
                                callback(new Error('手机号码无效'))
                            }else{
                                callback()
                            }
                        },
                        trigger: 'blur'
                    }
                ],
                code:[
                    { required: true, message: '请输入验证码', trigger: 'blur' }
                ],
                password:[
                    { 
                        validator:(rule,value,callback)=>{
                            if(value.length < 6){
                                callback(new Error('密码不得小于6位数'))
                            }else if(value.length > 20){
                                callback(new Error('请输入6-20位数密码'))
                            }else{
                                callback()
                            }
                        },
                        trigger: 'blur'
                    }
                ]
            },
            windowWidth:window.innerWidth,
            height: window.innerWidth >= 768 ? window.innerHeight - 180 : window.innerHeight
        }
    },
    mounted(){
        window.onresize = ()=>{
            this.windowWidth = window.innerWidth
            this.height = window.innerWidth >= 768 ? window.innerHeight - 180 : window.innerHeight
        }
        //注册来源，1PC  2公众号 3V名师
        if(this.isWeiXin()){
            this.formData.befrom = 2
        }else{
            this.formData.befrom = 1
        }
        this.formData.usertype = this.$route.query.from === 'teacher' ? 1 : 2
        this.formData.salesman = this.$route.query.salesman || ''
        this.formData.openid = this.$route.query.openid || ''
        this.formData.unionid = this.$route.query.unionid || ''
    },
    methods:{
        /**
         * 判断是否是在微信环境
         */
        isWeiXin() {
            var ua = window.navigator.userAgent.toLowerCase();
            if (ua.match(/MicroMessenger/i) == "micromessenger") {
                return true;
            } else {
                return false;
            }
        },
        /**
         * 注册
         */
        register(){
            this.$refs.regForm.validate(valid=>{
                if(valid){
                    if(!this.agree){
                        this.$msg('请先同意《科汛V名师服务协议》')
                        return
                    }
                    storeRegister(this.formData).then(res=>{
                        if(res.result === 'success'){
                            this.formData.code = ''
                            this.formData.usertype = 1
                            this.formData.sitename = ''
                            this.formData.password = ''
                            this.formData.mobile = ''
                            this.$msg('注册成功','success').then(()=>{
                                if(this.$route.query.source === 'website'){
                                    window.open(res.url)
                                }else{
                                    location.href = res.url
                                }
                            })
                        }else{
                            this.$msg(res.msg)
                        }
                    })
                }
            })
            
        },
        /**
         * 验证码
         */
        getCode(){
            let _mobile = this.formData.mobile
            if(_mobile.length < 11){
                this.$alert('请输入11位数手机号', '提示', {
                    type:'warning'
                })
                return
            }else if(!isPoneAvailable(_mobile)){
                this.$alert('手机号码无效', '提示', {
                    type:'warning'
                })
                return
            }
            if(this.second > 0 && this.buttonText !== '获取验证码'){
                return
            }
            if(this.sending){
                /**防止快速点击 */
                return
            }
            this.sending = true
            sendSms({
                type:1, //1注册，2取回密码 3登录 4 实名
                mobile:_mobile
            }).then(res=>{
                if(res.result === 'success'){
                    this.updateButtonText()
                }else{
                    this.$msg(res.msg)
                }
                this.sending = false
            })
            
        },
        /**
         * 更新按钮文字
         */
        updateButtonText(){
            if(this.second > 0){
                this.buttonText = `${this.second}秒后重新获取`
                setTimeout(()=>{
                    this.second -= 1
                    this.updateButtonText()
                },1000)
            }else{
                this.buttonText = '获取验证码'
                this.second = 60
            }
            
        },
        /**
         * 处理手机号
         */
        handlerMobile(){
            if(this.formData.mobile){
                let _mobile = this.formData.mobile.match(/[0-9]+/)
                if(_mobile && _mobile[0]){
                    this.formData.mobile = _mobile[0]
                }else{
                    this.formData.mobile = ''
                }
                
            }
            
        }
    }
}
</script>
<style lang="scss" scoped>
    
    .login-box{
        padding:60px 0;
        max-width: 1040px;
        margin: 0 auto;
        box-sizing: border-box;
    }
    
    .login-box__inner{
        background: #fff;
        padding:40px 70px 40px 40px;
    }
    .login-box--frame{
        padding: 0px;
        min-height: auto !important;
    }
    .login-box--frame .login-box__inner{
        padding-top: 10px;
    }
    .login-box--frame .login-box__title{
        text-align: left;
        padding-bottom: 0px;
    }
    .login-box__left{
        padding:40px 30px 30px 0;
    }
    .login-box__right{
        padding-top: 30px;
    }
    .login-box__title{
        font-size: 18px;
        text-align: center;
        padding-bottom: 20px;
    }
    .el-form-item{
        margin-bottom: 0px;
    }
    .login-box__cell{
        margin-top: 20px;
        color:$info-color;
    }
    .login-box__cell a{
        color:$info-color;
    }
    .login-box__cell--code{
        position: relative;
    }
    .login-box__cell--code .el-button{
        position:absolute;
        right: 0;
        top: 0;
        z-index: 9;
    }
     .login-box /deep/ .el-input__inner{
        border-top: 0px !important;
        border-left: 0px !important;
        border-right: 0px !important;
        border-radius: 0px !important;
        height: 50px !important;
        padding:0px !important;
    }
    .login-box /deep/ .el-input__icon{
        font-size: 18px;
    }
    .login-box /deep/ .el-input__prefix {
        left: 0px;
        top:2px;
    }
    .login-box /deep/ .el-checkbox__label{
        font-size: 12px;
        color:$info-color;
        font-weight: normal;
    }
    .login-box__link{
        float: right;
        color:$info-color;
    }
    .login-box__button{
        width: 100%;
        height: 50px;
    }
    .login-box__cell .el-input{
        max-width: 100%;
    }
    .login-box__cell--fot{
        text-align: center;
        font-size: 14px;
    }
    .login-box__cell--fot a{
        color:$primary-color;
    }
    
    @media screen and (max-width: 768px) {
        .login-box{
            background: #fff;
            padding-top: 0px;
        }
        .login-box__title{
            display: none;
        }
       .login-box__inner{
           padding: 20px 30px;
       }
       .login-box__right{
           padding-top: 0px;
       }
    }

    
</style>