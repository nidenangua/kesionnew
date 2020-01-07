<template>
    <div class="header" v-if="windowWidth >= 768">
        <div class="header-logo">
            <img src="../../assets/logo.png" v-if="storeType == 1" />
            <img src="../../assets/store-logo.png" v-else-if="storeType == 2" />
        </div>
        <div class="header-tel">
            咨询电话：400-008-0263
        </div>
    </div>
     <div class="header-mobile" v-else-if="windowWidth < 768">
        <img src="../../assets/logo.png" v-if="storeType == 1" />
        <img src="../../assets/store-logo.png" v-else-if="storeType == 2" />
    </div>
</template>
<script>
export default {
    name:'VHeader',
    props:{
        storeType:Number,
        windowWidth:Number
    }
}
</script>
<style lang="scss" scoped>
.header{
    height: 60px;
    line-height: 60px;
    background: #fff;
    box-shadow: 0 3px 15px rgba(0,0,0,0.06);
    box-sizing: border-box;
    padding: 0 35px 0 20px;
}
.header-logo{
    float:left;
}
.header-logo img{
    height: 36px;
    position: relative;
    top: 12px;
}
.header-tel{
    float: right;
    font-size: 14px;
    color:$info-deep-color;
}
.header-tel i{
    color:$primary-color;
    font-size: 18px;
    position: relative;
    top: 2px;
    margin-right: 5px;
}

.header-mobile{
    text-align: center;
    padding: 20px 0;
    background: #fff;
    height: 44px;
    overflow: hidden;
}
.header-mobile img{
    height: 44px;
    display: block;
    margin:  0 auto;
}

</style>