return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      /**列表页数 */
      pageCount: null,
      currentPage: 1,

      /**选择器数据 */
      flag: '',
      flagList: [],
      /**评价列表 */
      formList: []
    };
  },
  methods: {
    
    /**表单列表 */
    myFormList: function(p) {
      p = p || 1;
      this.formList = [];
      var that = this;
      this.currentPage = p;
      MyFormList({
        page: p,
        pagesize: 10,
        formid: Number(this.flag),
        userid: that.userInfo.UserID,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.formList = res.data;
        } else {
          that.formList = []
        }
      });
    },
    /**选中下拉框回调 */
    changeSelect: function() {
      this.myFormList();
    },
    /**删除评价 */
    delFormRecord: function(recordid) {
      var that = this;
      this.$confirm("确定删除吗？").then(function(_) {
        DelFormRecord({
          userid: that.userInfo.UserID,
          formid: Number(that.flag),
          recordid: recordid,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("删除成功");
            that.myFormList();
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    },
    /**跳转详情 */
    readFormRecord:function(formid,recordid){
      this.$router.push({
        name:'UserFormDetails',
        query:{
          formid:formid,
          recordid:recordid
        }
      })
    }
  },
  mounted: function() {
    var that = this;

    that.$store.ready(function(state) {
      that.userInfo = state.userInfo;
      that.state = state;
      MyFormHead({
        userid: that.state.userId,
        apptoken: that.state.appToken
      }).then(function(res) {
        if(res.result){
          that.flag = res.head[0].formid
          that.flagList = res.head;
          that.myFormList();
        }else{
          that.flag = ''
          that.flagList = [];
          that.formList = [];
        }
        
      });
      
      
    });
  }
};
