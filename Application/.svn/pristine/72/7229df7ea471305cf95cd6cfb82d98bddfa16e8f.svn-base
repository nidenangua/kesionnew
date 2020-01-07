<template>
    <div class="ks-form-item ks-line" ref="ktjFormItem" :style="{paddingLeft:labelWidth}">
        <div class="ks-form-item__label">
            <i class="ks-color-primary" v-if="required !== undefined && required !== false" >*</i>
            {{label}}
        </div>
        <slot />
    </div>
</template>
<script>
export default {
    name:'KsFormItem',
    props:['label','required'],
    data(){
        return {
            labelWidth:'100px'
        }
    },
    watch:{
        '$parent.labelWidth':{
            handler(v){
                this.labelWidth = v || '100px'
            },
            immediate:true
        }
    }
}
</script>
<style scoped>

.ks-form-item{
    min-height: 44px;
    position: relative;
    background: #fff;
    line-height: 44px;
    font-size: 14px;
    
}
.ks-form-item__label{
    position: absolute;
    left: 0;
    top: 0;
    
}
.ks-form-item__label i{
    position: absolute;
    left: -10px;
    top:0;
    font-style: normal
}
</style>


