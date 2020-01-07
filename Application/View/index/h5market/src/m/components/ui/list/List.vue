<template>
    <div class="ks-list">
        <div class="ks-list__title" v-if="title">{{title}}</div>
        <slot />
    </div>
</template>
<script>
export default {
    name:'KsList',
    props:{
        title:String,
        itemHeight:{
            type:String,
            default:'44px'
        }
    }
}
</script>
<style scoped>

.ks-list__title{
    height: 44px;
    line-height: 44px;
    color:var(--secondary_text-color);
    font-size: 14px;
    overflow: hidden;
    padding: 0 15px;
}
</style>
