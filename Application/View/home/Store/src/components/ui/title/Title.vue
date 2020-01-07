<template>
    <div class="ks-title" :class="border === 'none' && 'ks-title--noborder'">
        {{name}}
        <slot />
    </div>
</template>
<script>
export default {
    name:'KsTitle',
    props:{
        name:String,
        border:String
    }
}
</script>
<style scoped>
.ks-title{
    padding-bottom: 20px;
    font-size: 18px;
    line-height: 40px;
    border-bottom: 1px solid #eee;
}
.ks-title--noborder{
    border-bottom: 0px;
}
</style>

