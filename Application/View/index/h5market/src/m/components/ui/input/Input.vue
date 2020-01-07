<template>
    <div v-if="type === 'textarea'">
        <textarea type="textarea" v-model="inputValue" @change="onTextInputChange" id="" cols="30" rows="10"></textarea>
    </div>
    <div v-else>
        <input type="text" v-model="inputValue" ref="input" @change="onTextInputChange" class="ks-input" :class="'ks-input--'+style" :placeholder="placeholder" />
    </div>
</template>
<script>
export default {
    name:'KsInput',
    props:{
        value:String,
        placeholder:String,
        line:Boolean,
        type:{
            type:String,
            default:'text'
        },
        maxLength:Number
    },
    data() {
        return {
            style:'default',
            inputValue:this.value
        }
    },
    watch:{
        value(val){
            this.inputValue = val
        }
    },
    model:{
        prop:"value",
        event:"change"
    },
    methods:{
        /**
         * 文本区域焦点事件,兼容微信浏览器焦点事件离开后页面位置错位问题
         */
        onTextInputFocus() {
            this.WINDOW_TOP = document.body.scrollTop;
        },
        /**
         * 文本区域焦点离开,兼容微信浏览器焦点事件离开后页面位置错位问题
         */
        onTextInputBlur() {
            window.scrollTo(0, this.WINDOW_TOP);
        },
        /**
         * 文本内容发生变化
         */
        onTextInputChange(e){
            let _value = e.target.value || ''
            if(_value && this.type === 'number'){
                _value = _value.match(/\d+/) 
                _value = _value ? _value[0] : ''
            }
            this.inputValue =  _value
            this.$emit('change',_value)
        },
        /**
         * 触发文本框焦点事件
         */
        focus(){
            this.$refs.input.focus();
        }
    },
    mounted() {
        if(this.line){
            this.style = 'line'
        }
    },
}
</script>
<style scoped>
.ks-input--line{
    border: 1px solid #eee;
    height: 36px;
    font-size: 15px;
    margin: 0px 10px;
    float: left;
    padding-left: 8px;
    width: calc(100% - 90px);
};
</style>