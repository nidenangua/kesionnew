<template>
    <div class="ks-loading"></div>
</template>
<script>
export default {
    name:'KsLoading'
}
</script>
<style scoped>
.ks-loading{
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    background:rgba(255,255,255,0.5) url(./assets/loading.gif) no-repeat 50% 50%;
    z-index: 99;
    background-size: 48px;
}

</style>


