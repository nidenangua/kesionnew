<template>
<transition name="slide-left">
    <div class="ks-popup" :style="{width:width,zIndex:zIndex}" v-if="visible">
        <slot />
    </div>
</transition>
</template>
<script>
let POPUP_Z_INDEX = 2000;
export default {
    name:'KsPopup',
    props:{
        width:{
            type:String,
            default:'100%'
        },
        visible:Boolean
    },
    watch:{
        visible(bool){
            if(bool){
                this.$showMask({
                    click:()=>{
                        this.$emit('update:visible',false)

                    }
                })
            }else{
                this.$hideMask()
            }
        }
    },
    data(){
        return {
            zIndex:2000
        }
    },
    created(){
        POPUP_Z_INDEX ++
        this.index = POPUP_Z_INDEX
    }
}
</script>
<style scoped>
.ks-popup{
    height: 100%;
    position: fixed;
    right: 0;
    top: 0;
    background: #fff;
    overflow-y: auto;
    -webkit-overflow-scrolling:touch;
}
</style>

