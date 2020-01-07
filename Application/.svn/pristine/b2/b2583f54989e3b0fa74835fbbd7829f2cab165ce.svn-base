<template>
    <div class="ks-container" :style="{marginTop:marginTop}">
        <div class="ks-container__title" v-if="title">
            <div class="ks-container__title-right">
                <slot name="title-right" />
            </div>
            {{title}}
        </div>
        <slot />
    </div>
</template>
<script>
export default {
    name:'KsContainer',
    props:{
        /**容器标题 */
        title:"",
        /**容器 */
        marginTop:{
            type:String,
            default:"20px"
        }
    }
}
</script>

<style scoped>
.ks-container{
    width:1200px;
    margin:0 auto;
    box-sizing: border-box;
    position: relative;
}
.ks-container::after{
    content: '';
    clear: both;
    display: block;
}
.ks-container__title{
    height: 44px;
    line-height: 44px;
    font-size: 24px;
    padding:20px 0 15px 0;
}
.ks-container__title-right{
    float:right;
}
</style>
