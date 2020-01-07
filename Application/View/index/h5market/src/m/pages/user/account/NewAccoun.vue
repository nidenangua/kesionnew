<template>
    <div class="page">
        <form action="accounmsg">
        <div class="accoun">
            <div class="accoun-name">名称</div>
            <input class="input" required="required" v-model="msg.name"  placeholder="请填写" />
        </div>
        <div class="accoun">
            <div class="accoun-name">登录账号</div>
            <input class="input" required="required" v-model="msg.username"  placeholder="请填写" />
        </div>
        <div class="accoun">
            <div class="accoun-name">登录密码</div>
            <input class="input" required="required" v-model="msg.password" type="password"  placeholder="请填写" />
        </div>
        <div class="accoun">
            <div class="accoun-name">职称</div>
            <input class="input" v-model="msg.position"  placeholder="请填写" />
        </div>
        <div class="accoun" @click="role">
            <div class="accoun-name">角色</div>
            <span :class="roles == '请选择' ? 'role' :'roless'">{{roles}}</span>
        </div>
        <div class="accoun">
            <div class="accoun-name">简短描述</div>
            <textarea placeholder="请输入" class="describe" v-model="msg.shortIntro"></textarea>
        </div>
        </form>
        <div class="save">
            <ks-button type="primary" width="100%" @click="onSubmit()">保存</ks-button>
        </div>
    </div>
</template>

<script>
import {addAccount,roleList} from '@/api/user'
export default {
    data() {
        return {
            roles:'请选择',
            msg:{
                name:"",
                username:'',
                password:'',
                position:'',
                shortIntro:'',
                /**角色id */
                roleid:'',
            },
            /**角色列表 */
            list:[]
        }
    },
    methods: {
        onSubmit() {
            if(this.msg.name == '' || this.msg.text == ''||this.msg.password == "") {
                return this.$toast('请将信息补全')
            }else {
                let formData  = new FormData();
                for(var key in this.msg){
                    formData.append(key,this.msg[key]);
                }
                addAccount(formData).then(res=>{
                    if(res.result == "success") {
                        this.$toast("添加成功",'success')
                        this.msg = {}
                        this.roles='请选择',
                        setTimeout(() => {
                            this.$router.go(-1)
                        }, 1000);
                    }
                })
            }
        }, 
        role() {
            if(this.list.length) {
                this.$actionSheet({
                    list:this.list
                }).then(res=>{
                    this.roles = res.name
                    this.msg.roleid = res.id
                })
            }else {
                return this.$toast("暂无角色，请到PC上操作")
            }
        }
    },
    created() {
        roleList().then(res=>{
            res.data.map(item=>{
                this.list.push({id:item.id,name:item.title})
            })
        })
    },
}
</script>

<style scoped>
.page{
    padding: 10px 0;
    background-color: #fff;
    font-size: 16px;
}
.accoun{
    padding: 10px 15px;
    background-color: #fff;
    border-top: .5px solid #f2f2f2;
    border-bottom: .5px solid #f2f2f2;
    margin-bottom: 10px;
}
.accoun-name{
    margin-bottom: 15px;
}
.role{
    font-size: 16px;
    color: #bfb0c2;
}
.roless{
    font-size: 16px;
    color: black;
}
.describe{
    width: 100%;
    height: 100px;
    font-size: 16px;
    border:none;
    position: static !important;
}
.save{
    padding: 5px 10px;
}
.input{
    font-size: 16px;
    height: 20px;
    line-height: 20px;
    /* padding: 7px 0; */
    border: 0px;
    width: 100%;
    background-color: #fff !important;
}
</style>
