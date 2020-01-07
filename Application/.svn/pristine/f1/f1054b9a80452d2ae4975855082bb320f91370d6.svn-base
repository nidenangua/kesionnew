<template>
    <div class="ks-radio" :class="[value === label && 'ks-radio-checked',disable == true ? 'isdisable' :'']" @click="radioClick">
        <span class="ks-radio__inner"></span>
        <slot />
    </div>
</template>
<script>
export default {
    name:'KsRadio',
    props:[
        'label',
        'value',
        'disable'
    ],
    model:{
        prop:'value',
        event:'change'
    },
    methods:{
        radioClick(){
            if(this.disable) {
                return
            }else {
                this.$emit('change',this.label)
            }
        }
    }
}
</script>
<style scoped>
.ks-radio{
    display: inline-block;
    font-size: 14px;
    line-height: 22px;
    margin-right: 30px;
    cursor: pointer;
    color:#666;
}

.ks-radio__inner{
    width: 13px;
    height: 13px;
    display: inline-block;
    border:1px solid #e3e3e3;
    box-sizing: border-box;
    border-radius: 50%;
    position:relative;
    top: 2px;
    margin-right: 5px;
}
.ks-radio-checked .ks-radio__inner{
    border: 5px solid #e64a3b;
    position: relative;
}
.isdisable .ks-radio__inner{
    border: 5px solid #ccc;
    position: relative;
}
</style>

