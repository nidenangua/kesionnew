<template>
    <div class="ks-text" :style="{height:lineHeight * lineClamp + 'px',lineHeight:lineHeight + 'px',lineClamp:lineClamp,fontSize:fontSize,color:color}">
        <slot />
    </div>
</template>
<script>
export default {
    name:'KsText',
    props:{
        lineClamp:{
            type:Number,
            default:1
        },
        lineHeight:{
            type:Number,
            default:22
        },
        color:String,
        fontSize:{
            type:String,
            default:'12px'
        }
    }
}
</script>
<style scoped>
.ks-text{
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
}

</style>

