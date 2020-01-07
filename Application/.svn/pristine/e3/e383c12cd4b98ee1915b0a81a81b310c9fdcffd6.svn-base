<template>
    <div v-if="storeType > 0">
        <v-header :store-type="storeType" :window-width="windowWidth" v-if="$route.query.source !== 'website'" />
        <div class="login-box" :class="$route.query.source === 'website' && 'login-box--frame'"  :style="{minHeight:windowWidth >= 768 ? height+'px' : height-84+'px'}">
            <div class="login-box__inner">

                <el-row>
                    <el-col :span="14" v-if="windowWidth >= 768">
                        <div class="login-box__left">
                            <img src="../../assets/login/4EEAACD9218CD63CE2026893FFACD9EC.png" v-if="$route.query.from === 'teacher'" style="width:100%;display:block;" />
                            <img src="../../assets/login/E65DAB23F647A123EA7206CCDCB02944.png" v-else style="width:100%;display:block;" />
                        </div>
                    </el-col>
                    <el-col :span="windowWidth >= 768 ? 10 : 24">
                        <div class="login-box__right">
                            <div class="login-box__title">
                                重置密码
                            </div>
                            <el-form :model="formData" :rules="rules" ref="form">
                                <el-form-item prop="mobile">
                                    <div class="login-box__cell">
                                        <el-input @input="handlerMobile" v-model="formData.mobile" placeholder="手机号"></el-input>
                                    </div>
                                </el-form-item>
                                <el-form-item prop="code">
                                    <div class="login-box__cell login-box__cell--code">
                                        <el-button type="primary" @click="getCode" :disabled="second > 0 && buttonText !== '获取验证码'" size="medium" plain>{{buttonText}}</el-button>
                                        <el-input maxlength="6" v-model="formData.code" placeholder="验证码"></el-input>
                                    </div>
                                </el-form-item>
                                <el-form-item prop="password">
                                    <div class="login-box__cell">
                                        <el-input v-model="formData.password" type="password" placeholder="新密码，6-20个字符"></el-input>
                                    </div>
                                </el-form-item>
                                <el-form-item prop="pwd_check">
                                    <div class="login-box__cell">
                                        <el-input v-model="formData.pwd_check" type="password" placeholder="确认密码"></el-input>
                                    </div>
                                </el-form-item>
                            </el-form>
                            <div class="login-box__cell">
                                <el-button type="primary" @click="getPassword" class="login-box__button">重置密码</el-button>
                            </div>
                            <div class="login-box__cell login-box__cell--fot">
                                <router-link :to="{path:'/login',query:$route.query}">返回登陆</router-link>
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
import { fundPassWord,sendSms } from '@/api/user'
import { isPoneAvailable } from '@/utils'
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
            second:60,
            buttonText:'获取验证码',
            formData:{
                mobile:'',
                code:'',
                password:'',
                pwd_check:''
            },
            rules:{
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
                        validator:function(rule,value,callback){
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
                ],
                pwd_check:[
                    { 
                        validator:(rule,value,callback)=>{
                            if(value !== this.formData.password){
                                callback(new Error('两次输入的密码不一致'))
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
    },
    methods:{
        /**
         * 找回密码
         */
        getPassword(){
            this.$refs.form.validate(valid=>{
                if(valid){
                    fundPassWord(this.formData).then(res=>{
                        if(res.result === 'success'){
                            this.$msg('密码重置成功，请重新登录','success').then(()=>{
                                this.formData.mobile = ''
                                this.formData.code = ''
                                this.formData.password = ''
                                this.formData.pwd_check = ''
                                this.$router.push('/login')
                            })
                        }else{
                            this.$msg(res.msg)
                        }
                    })
                }
            })
        },
        /**
         * 获取验证码
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
                type:2, //1注册，2取回密码 3登录 4 实名
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
        padding:20px 30px 20px 0;
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
        font-size: 14px;
        color:$info-color;
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
    .login-box__cell--code{
        position: relative;
    }
    .login-box__cell--code .el-button{
        position:absolute;
        right: 0;
        top: 0;
        z-index: 9;
    }
   .login-box__cell--fot{
        text-align: center;
        font-size: 14px;
    }
    .login-box__cell--fot a{
        color:$info-color;
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