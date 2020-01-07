<template>
    <div class="pt10" v-if="dataSrc">
        <div class="banner" @click="open()">
            <img :src="dataSrc" />
        </div>
    </div>
</template>
<script>
export default {
    name:'KdBanner',
    props:[
        "dataSrc",
        "dataUrl"
    ],
    methods:{
        open(){
            let url = this.dataUrl
            if(url){
                location.href = url
            }
        }
    }
}
</script>
<style scoped>
.banner{
    background: #fff;
}
.banner img{
    width: 100%;
    display: block;
}
</style>


