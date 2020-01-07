<template>
    <div class="ks-container">
        <div class="ks-container__box">
            <slot />
        </div>
    </div>
</template>
<script>
export default {
    name:'KsContainer'
}
</script>

<style scoped>

.ks-container{
    padding: 25px;
    position: relative;
    overflow-y: auto;
}
.ks-container__box{
    padding: 25px;
    background: #fff;
    border-radius: 10px;
}
</style>

