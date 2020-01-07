<template>
    <div class="ks-image" :style="{position:position}">
        <img :src="imgSrc" @error="onerror" />
        <slot />
    </div>
</template>
<script>
export default {
    name:'KsImage',
    props:{
        src:String,
        type:String,
        position:{
            type:String
        }
    }, 
    data(){
        let _defaultImg = require('../../../assets/default/image/default-img.png')
        switch(this.type){
            case 'user':
                _defaultImg = require('../../../assets/default/image/default-avatar.jpg')
                break
            case 'logo':
                _defaultImg = require('../../../assets/default/image/default-logo.png')
                break
        }
        return {
            imgSrc:this.src,
            defaultImg:_defaultImg
        }
    },
    methods:{
        /**
         * 处理图片加载出错
         */
        onerror(){
            this.imgSrc = this.defaultImg
        }
    },
    watch:{
        src(_imgSrc){
            this.imgSrc = _imgSrc
        }
    }
}
</script>
<style scoped>
/*image*/
.ks-image {
    max-width: 100%;
    overflow: hidden;
    position: relative;
}
.ks-image img {
    object-fit: cover;
    width: 100%;
    height: 100%;
    display: block;
}
</style>