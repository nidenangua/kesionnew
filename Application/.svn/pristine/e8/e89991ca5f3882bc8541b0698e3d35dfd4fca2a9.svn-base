const entrance = {
    data() {
        return {
            storeType:0
        }
    },
    watch:{
        "$route.query":{
            handler(){
                this.handlerLogo()
            },
            deep:true
        }
    },
    mounted(){
        this.handlerLogo()
    },
    methods: {
        handlerLogo(){
            if(this.$route.query.from === 'teacher'){
                this.storeType = 1
            }else{
                this.$store.onStoreReady().then(info=>{
                    this.storeType = (info.teacher_info && info.teacher_info.usertype == 1) ? 1 : 2
                })
            }
        }
    }
}
export default entrance