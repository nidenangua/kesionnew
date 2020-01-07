<template>
    <div class="kd-big-title">
        <div class="kd-big-title__name">
            {{title}}
        </div>
        <div class="kd-big-title__search" v-if="showSearch">
            <div class="kd-big-title__search-inner" :style="{maxWidth:isFocus ? '100%' : '100px'}">
                <kd-search padding="0px" @focus="onSearchInputFocus" @blur="onSearchInputBlur" bg="gray" placeholder="搜索" />
            </div>
            
        </div>
    </div>
</template>
<script>
export default {
    name:'KdBigTitle',
    props:{
        title:String,
        showSearch:Boolean
    },
    data(){
        return {
            isFocus:false
        }
    },
    methods:{
        /**
         * 搜索框焦点事件
         */
        onSearchInputFocus(){
            this.isFocus = true
        },
        /**
         * 搜索框离开焦点事件
         */
        onSearchInputBlur(){
            this.isFocus = false
        }
    }
}
</script>
<style lang="scss" scoped>
    .kd-big-title{
        display: flex;
        padding:  30px 15px;
        height: 36px;
        align-items: center;
    }
    .kd-big-title__name{
        font-size: 30px;
        font-weight: bold;
        margin-right: 20px;
        line-height: 36px;
    }
    .kd-big-title__search{
        flex: 1;
    }
    .kd-big-title__search-inner{
        transition: .3s;
        -webkit-transition: .3s;
        float: right;
        width: 100%;
    }
    .kd-big-title__search-inner .ks-search{
        padding: 0px;
        
    }
</style>