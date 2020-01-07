<template>
    <div class="ks-form">
        <slot />
    </div>
</template>
<script>
export default {
    name:'KsForm',
    props:['labelWidth']
}
</script>
<style scoped>
.ks-form{
    padding-left: 15px;
    background: #fff;
}
</style>

