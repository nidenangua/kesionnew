<template>
    <div>
        
    </div>
</template>
<script>
import { joinLive } from "@/api/live";
export default {
    name:'EndLive',
    created(){
        joinLive({
            courseid: this.$route.query.id,
            chapterid: this.$route.query.chapterid,
            userid: this.$route.query.uid,
            type: 2 //1进入 2离开
        }).then(res=>{
            window.close();
        })
    }
}
</script>

<style scoped>

</style>
