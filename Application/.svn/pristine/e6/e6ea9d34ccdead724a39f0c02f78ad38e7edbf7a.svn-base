<template>
    <transition name="fade-up">
        <div class="ks-confirm" v-if="visible">
            <div class="ks-confirm-title">
                {{title}}
            </div>
            <div class="ks-confirm-text">
                {{msg}}
            </div>
            <div class="ks-confirm-button-group ks-line ks-line--top">
                <div class="ks-confirm-button ks-color-primary" @click="sure">
                    {{sureButtonText || '确定'}}
                </div>
                <div class="ks-confirm-button" @click="cancel" v-if="type !== 'alert'">{{cancelButtonText || '取消'}}</div>
            </div>
        </div>
    </transition>
</template>
<script>
import Vue from 'vue'
export default {
    name:'KsConfirm',
    data(){
        return {
            type:'',
            title:'',
            sureButtonText:'',
            cancelButtonText:'',
            visible:false,
            msg:'您确定要这样做吗？'
        }
    },
    methods:{
        sure(){
            //...
        },
        cancel(){
            //...
        }
    }
}
</script>

<style scoped>

.ks-confirm{
    width: 80%;
    max-width: 400px;
    left: 0;
    right: 0;
    margin: 0 auto;
    top: 20%;
    background: #fff;
    border-radius: 4px;
    position: fixed;
    z-index: 999;
    box-sizing: border-box;
    padding-top: 10px;
}
.ks-confirm-title{
    font-size: 16px;
    text-align: center;
    font-weight: bold;
    height: 44px;
    line-height: 44px;
    overflow: hidden;
}
.ks-confirm__close{
    width: 32px;
    text-align: center;
    color:var(--prompt-color);
}

.ks-confirm-text{
    font-size: 16px;
    line-height: 24px;
    color:var(--secondary_text-color);
    padding: 10px 20px 30px 20px;
    text-align: center;
}
.ks-confirm-button-group{
    height: 49px;
    line-height: 49px;
    display: flex;
    color:var(--secondary_text-color);
}
.ks-confirm-button{
    flex: 1;
    text-align: center;
    font-size: 16px;
    
}
.ks-confirm-button + .ks-confirm-button {
    position: relative;
}
.ks-confirm-button + .ks-confirm-button::after{
    content: '';
    width: 1px;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    background: #e6e6e6;
    transform: scaleX(0.5);

}
</style>
