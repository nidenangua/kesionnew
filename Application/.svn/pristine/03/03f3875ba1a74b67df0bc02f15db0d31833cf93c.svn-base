<template>
    <div>
        <div class="login">
            <div class="title">用户注册</div>
            <ks-field line v-model="nickname" maxlength="20" placeholder="请输入昵称" ref="nickname" />
            <ks-field line type="number" v-model="mobile" maxlength="11" placeholder="请输入手机号码" ref="mobile" />
            <ks-field line v-model="code" ref="code" maxlength="6" placeholder="请输入验证码">
                <ks-button slot="button" class="getcode" plain size="mini" @click="getCode" :disabled="second > 0">
                    {{(second == -1 && '获取验证码') || (second == 0 && '重新获取') || (second > 0 && second + '秒后重新获取')}}
                </ks-button>
            </ks-field>
            <ks-field line v-model="password" type="password" maxlength="20" ref="password" placeholder="请输入登录密码" />
            <ks-field v-model="repassword" type="password" maxlength="20" ref="repassword" placeholder="请再次输入登录密码" />
        </div>
        <div class="buttons">
            <ks-button type="primary" @click="reg">确认注册</ks-button>
        </div>
        <div class="buttons">
            <ks-button  @click="$router.push('/user/login')">返回登录</ks-button>
        </div>
        <store-footer/>
    </div>
</template>
<script>
import {isPoneAvailable} from '@/utils'
import {sendSms,register,checkLogin} from '@/api/user'
export default {
    name:'UserReg',
    data(){
        return {
            second:-1,
            mobile:'',
            code:'',
            nickname:'',
            password:'',
            repassword:''
        }
    },
    methods:{
        /**
         * 注册
         */
        reg(){
            if(!this.nickname){
                this.$msg('请输入昵称')
                this.$refs.nickname.focus()
                return
            }
            if(!this.verifyPhone()){
                return
            }
            if(!this.code){
                this.$msg('请输入验证码')
                return
            }
            if(!this.password){
                this.$msg('请输入登录密码')
                this.$refs.password.focus()
                return
            }
            if(!this.repassword){
                this.$msg('请再次输入登录密码')
                this.$refs.repassword.focus()
                return
            }
            if(this.password !== this.repassword){
                this.$msg('两次输入的密码不一致')
                return
            }
            register({
                mobile:this.mobile,
                code:this.code,
                nickname:this.nickname,
                password:this.password,
                repassword:this.repassword
            }).then(res=>{
                if(res.result === 'success'){
                    this.$store.ready(state=>{
                        this.$msg('注册成功','success')
                        if(state.is_rlogon){
                            checkLogin({
                                username: this.mobile,
                                password: this.password
                            }).then(res => {
                                this.$store.dispatch("updateUserInfo").then(() => {
                                    this.$router.push('/user')
                                })
                            })
                        }else{
                            this.$router.push('/user/login')
                        }
                    })
                }else{
                    this.$msg(res.msg)
                }
            })
        },
        /**
         * 校验手机号码
         */
        verifyPhone(){
            if(!this.mobile){
                this.$msg('请输入手机号')
                this.$refs.mobile.focus()
                return false
            }
            if(this.mobile.length < 11){
                this.$msg('请输入11位手机号')
                this.$refs.mobile.focus()
                return false
            }
            if(!isPoneAvailable(this.mobile)){
                this.$msg('请输入有效的手机号')
                this.$refs.mobile.focus()
                return false
            }
            return true
        },
        /**
         * 获取验证码
         */
        getCode(){
            if(this.timer){
                return
            }
            if(this.verifyPhone()){
                sendSms({
                    mobile:this.mobile,
                    type:5
                }).then(res=>{
                    if(res.result === 'success'){
                        this.second = 60
                        this.timer = setInterval(()=>{
                            this.second--
                            if(this.second == 0){
                                clearInterval(this.timer)
                                this.timer = null
                            }
                        },1000)
                    }
                    
                })
                
            }
        }
    }
}
</script>
<style scoped>
.login .title {
  height: 49px;
  line-height: 49px;
  overflow: hidden;
  padding: 0 15px;
  font-size: 16px;
}
.login li {
  height: 49px;
  background: #fff;
  padding: 0 15px;
  position: relative;
}
.login li .eva-icon {
  width: 49px;
  height: 49px;
  position: absolute;
  left: 0;
  top: 0;
  background-repeat: no-repeat;
  background-size: 24px;
  background-position: 50% 50%;
}

.login li input {
  width: 100%;
  height: 39px;
  position: relative;
  top: 5px;
  background: none;
  font-size: 14px;
  border: 0px;
}

.buttons {
  margin: 15px;
}
.buttons .ks-button{
    width: 100%;
}
.getcode{
    position: relative;
    right: 10px;
    top: 10px;
}
</style>


