<template>
    <div class="sign-form">
        <div class="sign-form__title">请先填写报名表单</div>
        <div class="sign-form__item" v-for="(item,i) in formData" :key="i">
            <div class="sign-form__label">
                <i class="sign-form__required ks-color--error" v-if="item.required">*</i>
                {{item.name}}
            </div>
            <div v-if="item.type === 'text'">
                <input type="text" class="ks-input" :id="'sign-form-text'+i" v-model="item.value" :placeholder="item.placeholder" />
            </div>
            <div v-else-if="item.type === 'textarea'">
                <textarea class="ks-textarea" :id="'sign-form-text'+i" v-model="item.value" :placeholder="item.placeholder" />
            </div>
            <div v-else-if="item.type === 'radio'">
                <span class="sign-form__radio" :class="item.value === opt && 'sign-form__radio--checked'" v-for="(opt,ii) in item.content" :key="ii" @click="item.value = opt">
                    {{opt}}
                </span>
            </div>
            <div v-else-if="item.type === 'checkbox'">
                <span class="sign-form__checkbox" v-for="(opt,ii) in item.content" :key="ii" :class="isChecked(item.value,opt)" @click="addCheck(item.value,opt)">
                    {{opt}}
                </span>
            </div>
        </div>
        <div class="sign-form__button ks-button ks-button--primary" @click="submit">提交</div>
    </div>
</template>
<script>
import {addApply} from "@/api/live"
export default {
    /**报名表单 */
    name:'SignForm',
    props:{
        formData:{
            type:Array,
            default(){
                return []
            }
        }
    },
    methods:{
        /**
         * 当前值是否选中
         */
        isChecked(val,opt){
            let has = false;
            val.map(str=>{
                if(str === opt){
                    has = true
                }
            })
            return has ? 'sign-form__checkbox--checked' : ''
        },
        /**
         * 添加多选值
         */
        addCheck(val,opt){
            let has = false;
            val.map((str,i)=>{
                if(str === opt){
                    has = true
                    val.splice(i,1)
                }
            })
            if(!has){
                val.push(opt)
            }

        },
        /**
         * 提交
         */
        submit(){
            let _mobile = "";
            for(let i=0;i<this.formData.length;i++){
                let item = this.formData[i];
                if(item.required){
                    if(!item.value){
                        this.$layer.msg(`请先填写${item.name}`);
                        if(item.type === 'text' || item.type === 'textarea'){
                            document.getElementById(`sign-form-text${i}`).focus();
                        }
                        return
                    }else if(item.field === 'mobile'){
                        let reg = /^1[345789]\d{9}$/;
                        if(!reg.test(item.value)){
                            this.$layer.msg(`请输入正确的手机号码`);
                            document.getElementById(`sign-form-text${i}`).focus();
                            return
                        }
                        _mobile = item.value;
                    }
                }

            }
            let formResult = [];
            this.formData.map(item=>{
                formResult.push({
                    name:item.name,
                    key_value:item.value,
                    type:item.type,
                    field:item.field
                })
            })
            addApply({
                courseid:this.$route.query.id,
                chapterid:this.$route.query.chapterid,
                mobile:_mobile,
                json:formResult
            }).then(res=>{
                if(res.result === 'success'){
                    location.reload()
                }else{
                    this.$layer.msg(res.msg)
                }
            })
        }
    }
}
</script>

<style scoped>
.sign-form{
    width: 360px;
    background: #fff;
    margin:0 auto;
    padding: 40px;
    margin-top: 60px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.06)
}
.sign-form__title{
    font-size: 18px;
    line-height: 32px;   
    font-weight: bold;
    color:#565656;
    padding-bottom: 10px;
}
.sign-form__item{
    margin-top:10px;
    position: relative;
    line-height: 40px;
}
.sign-form__item .ks-input,
.sign-form__item .ks-textarea{
    width: 100%;
}
.sign-form__label{
    left:0;
    top:0;
    font-size: 14px;
}
.sign-form__required{
    display: inline-block;
    font-style: normal;
}
.sign-form__radio,
.sign-form__checkbox{
    height: 36px;
    line-height: 36px;
    display: inline-block;
    margin-right: 10px;
    border:1px solid #eee;
    padding: 0 15px 0 35px;
    font-size: 14px;
    border-radius: 4px;
    cursor: pointer;
    position: relative;
}
.sign-form__radio--checked,
.sign-form__checkbox--checked{
    border:1px solid #3c7cef;
    background: #edf2fb;
    color:#3c7cef;
}
.sign-form__radio::before,
.sign-form__checkbox::before{
    content: '';
    width: 12px;
    height: 12px;
    border:1px solid #ccc;
    border-radius: 50%;
    position: absolute;
    left: 10px;
    top:50%;
    margin-top:-7px;
}
.sign-form__checkbox::before{
    border-radius: 3px;
}
.sign-form__radio--checked::before{
    background: #3c7cef url(../assets/small-icon/icon-dot.png) no-repeat 50% 50%;
    background-size: 100% 100%;
    border:1px solid #3c7cef;
}
.sign-form__checkbox--checked::before{
    background: #3c7cef url(../assets/small-icon/icon-yes.png) no-repeat 50% 50%;
    background-size: 100% 100%;
    border:1px solid #3c7cef;
}

.sign-form__button{
    margin-top:30px;
    width: 100%;
    text-align: center;
    font-size: 16px;
}

</style>

