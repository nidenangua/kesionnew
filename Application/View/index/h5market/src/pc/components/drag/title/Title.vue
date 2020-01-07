<template>
    <div class="kd-title" :class="'kd-title--style'+dataTitle.style">
        <div class="kd-title__item">
			{{dataTitle.name}}
            <span class="kd-title__more" v-show="dataTitle.more && dataTitle.more.length">
                <a :href="item.url" v-for="(item,i) in dataTitle.more" :key="i">{{item.text}}</a>>
            </span>
        </div>
		
    </div>
</template>
<script>
let $parent;
let position;
let paddingBottom;
export default {
    name:'KdTitle',
    props:{
        dataTitle:{
            type:Object,
            default(){
                return {}
            }
        }
    }
}
</script>
<style scoped>
.kd-title{
	width: 1200px;
    margin: 0 auto;
    padding-top: 20px;
}
.kd-title__item{
    font-size:24px;
    height: 38px;
    line-height: 38px;
    overflow: hidden;
    padding:20px 20px 0 20px;
    background: #fff;
	color: #2d3336;
  
}
.kd-title__more{
    float: right;
    font-size: 14px;
    position: relative;
	color: #585e61;
}
.kd-title__more a{
    margin-left:15px;
    font-weight: normal;
    color: #585e61;
}
.kd-title--style2 .kd-title__item{
    position: relative;
    padding-left: 32px;
}
.kd-title--style2 .kd-title__item::after{
    content: '';
    width: 3px;
    height: 24px;
    background: #2e84ee;
    position: absolute;
    left: 15px;
    top: 27px

}

</style>

