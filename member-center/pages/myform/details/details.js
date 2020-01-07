return {
  data: function() {
    return {
      /**评价列表 */
      formData: []
    };
  },
  watch: {
    '$route.query':{
        handler(query){
            /**监听加载页面新数据 */
            if(query.formid&&query.recordid){
              this.loadPage()
            }
            
        },
        deep:true
    },
  },
  methods: {
    loadPage(){
      var that = this;
     
      that.$store.ready(function(state) {
        MyFormView({
          userid: state.userId,
          apptoken: state.appToken,
          formid:that.$route.query.formid,
          recordid:that.$route.query.recordid
        }).then(function(res) {
          if(res.result){
            that.formData = res.data
          }else{
            that.$message({
              message: res.msg,
              type: 'error',
              duration:'1000'
            });
            setTimeout(()=>{
              history.back()
            }, 1500)
          }
        });
      });
      
    }
  },
  mounted: function() {
    this.loadPage()
    
  }
};
