<template>
    <div>
        <div class="store-info-style">
            <div class="bg"></div>
            <div class="info">
                <ks-create-bg class="logo" type="logo" :src="$store.state.info.logo" />
                <div class="msg">
                    <div class="name">{{$store.state.info.wititle}}</div>
                    <div class="tel">联系电话：{{$store.state.info.tel}}</div>
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>
export default {
    name:'KdStoreInfo'
}
</script>
<style scoped>
.store-info-style .bg{
    height: 9rem;
    background: url('./assets/20190223165754.png') no-repeat 50% 50%;
    background-size: cover
}
.store-info-style .info{
    height: 35px;
    background: #fff;
    position: relative;
    padding: 0 40px 0 120px;
}
.store-info-style .logo{
    width: 85px;
    height: 85px;
    border-radius: 3px;
    position: absolute;
    left: 20px;
    top:-65px;
    background:#fff !important;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1)

}
.store-info-style .msg{
    position: relative;
    top:-60px;
    color:#fff;
}
.store-info-style .name{
    font-size: 16px;
    font-weight: bold;
    position: relative;
    line-height: 26px;
    height: 26px;
    overflow: hidden;
}
.store-info-style .tel{
    position: relative;
    line-height: 24px;
    font-size: 12px;
   
}
</style>


