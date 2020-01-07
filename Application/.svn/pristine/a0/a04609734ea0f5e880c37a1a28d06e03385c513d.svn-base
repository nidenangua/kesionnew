<template>
    <div class="ks-box">
        <div class="ks-box__head" v-if="title">
            <span class="ks-box__more ks-color-link" v-if="typeof more === 'object'" @click="goMore">{{more.text || '更多'}}</span>
            {{title}}
        </div>
        <div class="ks-box__body">
            <slot />
        </div>
    </div>
</template>
<script>
export default {
    name:'KsBox',
    props:[
        'title',
        'more'
    ],
    methods:{
        goMore(){
            if(this.more.url){
                if(this.more.target === '_blank'){
                    window.open(this.more.url)
                }else{
                    location.href = this.more.url
                }
            }
        }
    }
}
</script>

<style scoped>
.ks-box{
    background: #fff;
}

.ks-box{
    padding: 5px 15px;
    border-radius: 4px;
}
.ks-box__body{
    padding: 15px 0;
    
}
.ks-box__head{
    height: 40px;
    line-height: 40px;
    overflow: hidden;
    font-size: 14px;
    border-bottom: 1px solid #eee;
}
.ks-box__more{
    float: right;
    font-size: 12px;
    cursor: pointer;
}

</style>

