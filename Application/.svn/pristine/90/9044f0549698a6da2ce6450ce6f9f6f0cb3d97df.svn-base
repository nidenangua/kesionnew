<template>
    <button type="button" class="ks-button" ref="ktjButton" :style="getStyle()" :class="buttonClass" @click="click">
        <i class="ks-icon" :class="icon" v-if="icon"></i>
        <slot />
        <div v-if="desc" class="ks-button__desc">{{desc}}</div>
    </button>
</template>
<script>
export default {
    name:'KsButton',
    props:{
        type:String,
        desc:String,
        size:String,
        icon:String,
        width:String,
        height:String,
        disabled:Boolean,
        round:Boolean,
        plain:Boolean
    },
    data(){
        return {
            buttonStyle:{},
            buttonClass:''
        }
    },
    watch:{
        size(){
            this.getClass()
        },
        width(){
            this.getClass()
        },
        height(){
            this.getClass()
        },
        icon(){
            this.getClass()
        },
        disabled(){
            this.getClass()
        },
        type(){
            this.getClass()
        },
        plain(){
            this.getClass()
        }
    },
    methods:{
        /**
         * 获取按钮样式名
         */
        getClass(){
            let buttonClass = []
            if(this.size){
                buttonClass.push('ks-button--'+this.size)
            }
            if(this.type){
                buttonClass.push('ks-button--'+this.type)
            }else{
                buttonClass.push('ks-button--default')
            }
            if(this.disabled){
                buttonClass.push('ks-button--disabled')
            }
            if(this.round){
                buttonClass.push('ks-button--round')
            }
            if(this.plain){
                buttonClass.push('ks-button--plain')
            }
            if(this.desc){
                buttonClass.push('ks-button--desc')
            }
            this.buttonClass = buttonClass.join(' ')
        },
        /**
         * 获取额外样式
         */
        getStyle(){
            let style = {};
            if(this.width){
                style.width = this.width
            }
            if(this.height){
                style.height = this.height
            }
            return style
        },
        /**
         * 点击回调
         */
        click(){
            if(!this.disabled){
                this.$emit('click')
            }
        },

    },
    mounted(){
        this.getClass()
    }
    
}
</script>

<style scoped>
.ks-button{
	display: inline-block;
    white-space: nowrap;
    box-sizing: border-box;
    cursor: pointer;
    background-color: #fff;
    border-width: 1px;
    border-style: solid;
    border-color: #ebedf0;
    color: var(--secondary_text-color);
    -webkit-appearance: none;
    text-align: center;
    outline: none;
    transition: .1s;
    font-weight: 500;
    padding: 0 15px;
    font-size: 16px;
    height: 44px;
    line-height: 44px;
    border-radius: 4px;
    opacity: 0.95;
}

.ks-button:focus{
    opacity:1
}
.ks-button--default:focus{
    background: var(--background-color)
}
.ks-button--primary{
    background: var(--primary-color);
    color: #fff;
    border-color: var(--primary-color);
}
.ks-button--success{
    background: #36b04e;
    color: #fff;
    border-color: #36b04e;
}
.ks-button--gray{
    background: var(--auxiliary_text-color);
    color: #fff;
    border-color: var(--auxiliary_text-color);
}
.ks-button--plain{
    background: none;
    color:var(--primary-color);
    border-color: var(--primary-color);
}
.ks-button--success{
    background: var(--primary-color);
    color:#fff;
    border-color: var(--primary-color);
}
.ks-button--white{
    background: #fff;
    color:var(--primary-color);
    border-color: var(--primary-color);
}
.ks-button--upload{
    background: #fff;
    color:var(--primary-color);
    border-color: var(--primary-color) ;
    padding: 0;
    font-size: 14px;
    height: 35px;
    line-height: 35px
}
.ks-button--medium{
    height: 36px;
    line-height: 36px;
    font-size: 14px;
}
.ks-button--small{
    height: 32px;
    line-height: 32px;
    font-size: 13px;
}
.ks-button--mini{
    height: 28px;
    line-height: 28px;
    font-size: 12px;
}

.ks-button--disabled,
.ks-button--disabled:focus{
    opacity: 0.6;
    cursor: no-drop
}
.ks-button .ks-icon{
    font-size: 18px;
    position: relative;
    float: left;
    position: relative;
    top: -1px;
    margin-right: 5px;
}
.ks-button--mini .ks-icon{
    font-size: 16px;
    margin-right: 2px;
}
.ks-button--round{
    border-radius: 44px;
}
.ks-button--desc{
    line-height: 18px;
}
.ks-button__desc{
    font-weight: normal;
    font-size: 12px;
}
</style>

