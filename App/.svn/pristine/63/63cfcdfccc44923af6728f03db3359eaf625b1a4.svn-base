<template>
    <div class="ks-image">
        <img :src="imgSrc" @error="onerror" />
    </div>
</template>
<script>
export default {
    name:'ImageComonent',
    props:{
        src:String,
        type:String
    }, 
    data(){
        let _defaultImg = require('./default-img.png')
        switch(this.type){
            case 'user':
                _defaultImg = require('./default-avatar.jpg')
                break
            case 'logo':
                _defaultImg = require('./default-logo.png')
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
