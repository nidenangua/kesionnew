<template>
    <div class="ks-list-item" :style="getStyle()" ref="listItem" @click="$emit('click')">
        <div class="ks-list-item__icon" v-if="icon">
            <img :src="icon" />
        </div>
        <div class="ks-list-item__title">
        {{title}}
        </div>
        <div class="ks-list-item__after">
            <slot />
        </div>
        <i class="ks-icon ks-icon-arrow-ios-forward-outline" :style="{color:arrowColor,fontSize:arrowSize}" v-if="showArrow !==undefined && showArrow !== false"></i>
        
    </div>
</template>
<script>
export default {
    name:'KsListItem',
    props:{
        icon:String,
        title:String,
        showArrow:Boolean,
        arrowColor:{
            type:String,
            default:'#b3b3b3'
        },
        arrowSize:{
            type:String,
            default:'16px'
        }
    },
    methods:{
        /**
         * 获取样式
         */
        getStyle(){
            let itemHeight = this.$parent.itemHeight;
            return {
                height:itemHeight,
                lineHeight:itemHeight
            }
        }
    }
}
</script>
<style scoped>

.ks-list-item{
    overflow: hidden;
    background: #fff;
    position: relative;
    font-size: 16px;
    padding: 0 15px;
    color:var(--secondary_text-color);
    display: flex;
    align-items: center;
}
.ks-list-item:active{
    background: var(--background-color)
}
.ks-list-item::after{
    display: block;
	content: " ";
	height: 0px;
	width: 100%;
	box-sizing: border-box;
	border-bottom:1px solid #e3e3e3;
	-webkit-transform: scaleY(0.5);
	-ms-transform: scaleY(0.5);
	transform: scaleY(0.5);
	-webkit-transform-origin: 0 100%;
	-ms-transform-origin: 0 100%;
	transform-origin: 0 100%;
	position: absolute;
	bottom: 0px;
	left: 15px;
	right: 0;
    z-index: 1;
}
.ks-list-item__title{
    flex: 1;
}
.ks-list-item:last-child::after{
    display: none
}
.ks-list-item__after{
    float: right;
    font-size: 14px;
    color: var(--auxiliary_text-color);
}
.ks-list-item .ks-icon-arrow-ios-forward-outline{
    float: right;
    margin-left: 15px;
}
.ks-list-item__icon {
    width: 20px;
    height: 20px;
    line-height: 20px;
    margin-right: 15px;
}

.ks-list-item__icon img {
    width: 100%;
    height: 100%;
}
</style>


