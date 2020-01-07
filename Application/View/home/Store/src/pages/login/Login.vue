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
                                账号登录
                            </div>
                            <el-form :model="formData" :rules="rules" ref="loginForm">
                                <el-form-item prop="username">
                                    <div class="login-box__cell">
                                        <el-input v-model="formData.username" placeholder="请输入手机号"></el-input>
                                    </div>
                                </el-form-item>
                                <el-form-item prop="password">
                                    <div class="login-box__cell">
                                        <el-input type="password" v-model="formData.password" placeholder="请输入密码"></el-input>
                                    </div>
                                </el-form-item>
                            </el-form>
                            <div class="login-box__cell">
                                <router-link :to="{path:'/forgetpassword',query:$route.query}" class="login-box__link">忘记密码</router-link>
                                <el-checkbox v-model="rememberPassword">记住密码</el-checkbox>
                            </div>
                            <div class="login-box__cell">
                                <el-button type="primary" @click="login" class="login-box__button">立即登录</el-button>
                            </div>
                            
                            <div class="login-box__cell login-box__cell--fot">
                                还没账号？ <router-link :to="{path:'/register',query:$route.query}">立即注册</router-link>
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
import { presigin } from '@/api/user'
import VHeader from '@/components/v-header'
import VFooter from '@/components/v-footer'
export default {
    name:'Login',
    components:{
        VHeader,
        VFooter
    },
    mixins:[entrance],
    data(){
        return {
            rememberPassword:false,
            formData:{
                username:'',
                password:''
            },
            windowWidth:window.innerWidth,
            height:window.innerWidth >= 768 ? window.innerHeight - 180 : window.innerHeight,
            rules:{
                username:[
                    { required: true, message: '请输入手机号', trigger: 'blur' }
                ],
                password:[
                    { required: true, message: '请输入密码', trigger: 'blur' }
                ]
            }
        }
    },
    mounted(){
        /**如果记住过密码，读取记住的密码信息 */
        if(localStorage.VTeacher_HomeAccount){
            let accountInfo = JSON.parse(localStorage.VTeacher_HomeAccount)
            this.formData.username = accountInfo.username
            this.formData.password = accountInfo.password
            this.rememberPassword = true
        }
        this.formData.openid = this.$route.query.openid || ''
        this.formData.unionid = this.$route.query.unionid || ''
        window.onresize = ()=>{
            this.windowWidth = window.innerWidth
            this.height = window.innerWidth >= 768 ? window.innerHeight - 180 : window.innerHeight
        }
    },
    methods:{
        /**
         * 登录
         */
        login(){
            this.$refs.loginForm.validate(valid=>{
                if(valid){
                    presigin(this.formData).then(res=>{
                        if(res.result === 'success'){
                            if(this.rememberPassword){
                                localStorage.VTeacher_HomeAccount = JSON.stringify(this.formData)
                            }else{
                                localStorage.VTeacher_HomeAccount = ''
                            }
                            if(this.$route.query.source === 'website'){
                                window.open(res.url)
                            }else{
                                location.href = res.url
                            }
                            
                        }else{
                            this.$msg(res.msg)
                        }
                    })
                }
            })
        }
    }
}
</script>
<style lang="scss" scoped>
    .header{
        height: 60px;
        line-height: 60px;
        background: #fff;
        box-shadow: 0 3px 15px rgba(0,0,0,0.06);
        box-sizing: border-box;
        padding: 0 35px 0 20px;
    }
    .header-logo{
        float:left;
    }
    .header-logo img{
        height: 36px;
        position: relative;
        top: 12px;
    }
    .header-tel{
        float: right;
        font-size: 14px;
        color:$info-deep-color;
    }
    .header-tel i{
        color:$primary-color;
        font-size: 18px;
        position: relative;
        top: 2px;
        margin-right: 5px;
    }

    .login-box{
        padding-top:60px;
        max-width: 1040px;
        margin: 0 auto;
        box-sizing: border-box;
    }
    .login-box--frame{
        padding: 0px;
        min-height: auto !important;
    }
    .login-box--frame .login-box__inner{
        padding-top: 10px;
    }
    .login-box__inner{
        background: #fff;
        padding:40px 70px 40px 40px;
    }
    .login-box__left{
        margin-right: 30px;
    }
    .login-box__right{
        padding-top: 30px;
    }
    .login-box__title{
        font-size: 18px;
        text-align: center;
        padding-bottom: 20px;
    }
    .login-box__cell{
        margin-top: 20px;
        color:$info-color;
    }
    .login-box__cell .el-input{
        max-width: 100%;
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
    .login-box__cell--fot{
        text-align: center;
        font-size: 14px;
    }
    .login-box__cell--fot a{
        color:$primary-color;
    }
    .login-box__inner-logo{
        text-align: center;
        padding: 20px 0;
    }
    .login-box__inner-logo img{
        height: 44px;
        display: block;
        margin:  0 auto;
    }
    .el-form-item{
        margin-bottom: 0px;
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