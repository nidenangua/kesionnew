return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      /**列表页数 */
      pageCount: null,
      currentPage: 1,
      /*当前标签页 */
      activeName: "first",
      checked: false,
      /**文章列表 */
      articleList: [],
      /***************************收到多选框 ****************************/
      /**选中的列表 */
      checkList: [],
      /**全选状态 */
      checkAll: false,
      /**饿了么提供的不确定状态 */
      isIndeterminate: true,
      /**页面显示的列表id集合 */
      list: [],
      /**转换后台需要参数 */
      checkListStr: null,
      articleVisible: false,
      /**参数 */
      showstatus: -1,
      timer:null,
    };
  },
  methods: {
    openView(name){
      this.$router.push({
        name:name,
        query:{
          classId:0,
          InfoID:0
        }
      });
    },
    /**跳转页面 */
    open: function(url) {
      location.href = url;
    },
/**
 * 跳出新窗口
 * @param {any} url
 */
      openNew: function (url) {
          window.open(url);
      },
    /**标签页回调
     */
    handleClick: function(tab) {
      this.checkList = [];
      this.checkAll = false;
      if (tab.index == 0) {
        this.showstatus = -1;
        this.getUserArticleList();
      } else if (tab.index == 1) {
        this.showstatus = 0;
        this.getUserArticleList();
      } else if (tab.index == 2) {
        this.showstatus = 1;
        this.getUserArticleList();
      } else if (tab.index == 3) {
        this.showstatus = 2;
        this.getUserArticleList();
      } else if (tab.index == 4) {
        this.showstatus = 3;
        this.getUserArticleList();
      }
    },
    /**文章列表 */
    getUserArticleList: function(p) {
      p = p || 1;
      // this.$showLoading("#userRight");
      this.articleList = [];
      this.list = [];
      var that = this;
      this.currentPage = p;
      GetUserArticleList({
        showstatus: this.showstatus,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.articleList = res.data;
          that.list = that.articleList.map(function(item) {
            return item.infoid;
          });
        }
      });
    },
    /**删除文章列表 */
    deleteUserArticle: function(id) {
      var that = this;
      console.log(id);
      this.$confirm("确定删除吗？").then(function(_) {
        DeleteUserArticle({
          infoids: id,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result === true) {
            that.$message.success("删除文章成功");
            that.checkList = [];
            that.getUserArticleList();
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    },
    /**复选框回调 */
    handleCheckAllChange: function(val) {
      this.checkList = val ? this.list : [];
      this.checkListStr = this.checkList.join();
      this.isIndeterminate = false;
    },
    /**复选框回调 */
    handleCheckedlistChange: function(value) {
      var checkedCount = value.length;
      this.checkAll = checkedCount === this.list.length;
      this.isIndeterminate =
        checkedCount > 0 && checkedCount < this.list.length;
      this.checkListStr = this.checkList.join();
    },

    
    /**修改文章 */
    modify: function(item) {
      this.$router.push({
        name:'UserArticleView',
        query:{
          classId:item.classid,
          InfoID:item.infoid
        }
      })
      
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.userInfo = state.userInfo;
      that.state = state;
      that.getUserArticleList();
    });
  },
  activeted:function() {
    this.getUserArticleList();
  }
};
