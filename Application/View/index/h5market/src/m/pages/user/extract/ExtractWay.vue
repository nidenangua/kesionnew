<template>
    <div>
         <ks-empty type="extract" msg="您还未实名认证，暂不能提现~"/>
         <div class="goauthentication">
             <ks-button type="primary" @click="open()">去认证</ks-button>
         </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            
        }
    },
    methods:{
        open() {
            this.$router.push('/user/extractApprove')
        },
    }
}
</script>

<style scoped>
.goauthentication{
    text-align: center;
}
</style>
