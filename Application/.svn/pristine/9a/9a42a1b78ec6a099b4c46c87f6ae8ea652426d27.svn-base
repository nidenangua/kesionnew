<template>
    <div class="ks-create-bg" :style="style" @click="click" ref="defaultImage">
        <div class="ks-create-bg__image" :style="{backgroundImage:'url('+src+')',backgroundSize:type === 'logo' ? 'contain' : 'cover'}">
            <slot />
        </div>
    </div>
</template>
<script>

export default {
    name:'KsCreateBg',
    props:[
        'src',
        'type',
        'ratio',
        'width'
    ],
    data(){
        return {
            style:{},
            defaultImg:require('./assets/default-img.png'),
            defaultLogo:require('./assets/default-logo.png'),
            defaultAvatar:require('./assets/default-avatar.jpg'),
        }
    },
    methods:{
        /**
         * 添加事件
         */
        click(){
            this.$emit('click')
        },
        getDefaultImage(){
            if(this.type === 'logo'){
                return `url(${this.defaultLogo})`
            }else if(this.type === 'user'){
                return `url(${this.defaultAvatar})`
            }else{
                return `url(${this.defaultImg})`
            }
            
        }
    },
    mounted(){
        let style = {
            backgroundImage:this.getDefaultImage()
        }
        if(this.width){
            style.width = this.width
        }
        if(this.ratio){
            let width = this.width ? this.width.match(/\d+/)[0] : this.$refs.defaultImage.offsetWidth;
            style.height = width*this.ratio+'px'
            
        }
        
        this.style = style
        window.addEventListener('resize',e=>{
            let width = this.$refs.defaultImage.offsetWidth;
            this.style.height = width*this.ratio+'px'
        })
    }
}
</script>
<style scoped>
.ks-create-bg{
    position: relative;
    overflow: hidden;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 50% 50%;
    border-radius: 4px;
}
.ks-create-bg__image{
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    background-repeat: no-repeat;
    background-position: 50% 50%;
}
</style>


