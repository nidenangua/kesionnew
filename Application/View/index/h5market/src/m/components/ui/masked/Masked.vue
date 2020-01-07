<template>
   <div v-show="maskList.length">
            <div class="ks-mask" v-for="(mask,i) in maskList" :key="i" :style="{zIndex:zIndex+i+1}" @click="click(mask,i)">
            </div>
            <div class="ks-masked" :style="{zIndex:zIndex}"></div>
        </div>
</template>
<script>
export default {
    name:'Masked',
    data(){
        return{
            zIndex:100,
            maskList:[]
        }
    },
    methods:{
        click(mask,index){
            if(typeof mask.click === 'function'){
                mask.click()
            }
        }
    }
}
</script>
<style scoped>

.ks-masked,
.ks-mask{
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
}
.ks-masked{
    background: rgba(0,0,0,.5);
}
</style>
