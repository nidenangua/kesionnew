<template>
    <div class="ks-tab-pane" :style="{display:name === $parent.activeName ? 'block' : 'none'}">
        <slot />
    </div>
</template>
<script>
export default {
    name:'KsTabPane',
    props:{
        label:String,
        name:[String,Number],
        info:[String,Number]
    },
    watch:{
        info(){
            this.$parent.setTabs()
        }
    },
    mounted(){
        this.$parent.setTabs()
    }
}
</script>

