<template>
    <div class="ks-card">
        <div class="ks-card__title" v-if="title">
            {{title}} <span v-if="desc" class="ks-card__desc">{{desc}}</span>
        </div>
        <div class="ks-card__body">
            <slot />
        </div>
    </div>
</template>
<script>
export default {
    name:'KsCard',
    props:{
        /**标题 */
        title:String,
        /**标题描述 */
        desc:String
    }
}
</script>
<style scoped>
.ks-card{
    background: #fff;   
}
.ks-card__title{
    height:49px;
    line-height: 49px;
    padding: 0 15px 0 28px;
    font-size: 16px;
    position: relative;
}
.ks-card__title::before{
    content: '';
    width: 3px;
    height: 16px;
    position: absolute;
    left:15px;
    top:50%;
    margin-top:-8px;
    background: #2e84ee;
}
.ks-card__desc{
    color:#999;
    margin-left:10px;
    font-size: 12px;
}
.ks-card__body{
    padding: 0 15px 10px 15px;
}
</style>
