<template>
    <div class="ks-action-sheet" v-if="visible">
        <div class="ks-action-sheet__list" v-if="list.length">
            <div class="ks-action-sheet__item" :class="index < list.length-1 && 'line'" v-for="(item,index) in list" :key="index" @click="change(item)">
                {{item.name}}
            </div>
        </div>
        <div class="ks-action-sheet__cancel ks-color-primary ks-mt10" @click="cancel">
            取消
        </div>
    </div>
</template>
<script>
export default {
    name:'KsActionSheet',
    data(){
        return {
            visible:false,
            list:[]
        }
    },
    watch:{
        visible(bool){
            if(bool){
                this.$showMask({
                    click:()=>{
                        this.visible = false
                    }
                })
            }else{
                this.$hideMask()
            }
        }
    },
    /**
     * 预留函数，核心函数控制在ketangjie-ui index.js
     */
    methods:{
        change(item){
            //...
        },
        cancel(){
            this.visible = false
        }
    }
}
</script>
<style scoped>
.ks-action-sheet{
    position: fixed;
    width: 96%;
    left: 2%;
    bottom: 0;
    z-index: 999;
}
.ks-action-sheet__item,
.ks-action-sheet__cancel{
    height: 49px;
    line-height: 49px;
    overflow: hidden;
    font-size: 16px;
    text-align: center;
    background: #fff;
}
.ks-action-sheet__list{
    border-radius: 5px;
    overflow: hidden;
}
.ks-action-sheet__cancel{
    border-radius: 5px;
    overflow: hidden;
    margin-bottom: 10px;
}
</style>

