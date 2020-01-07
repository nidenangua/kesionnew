return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      activeName: "first",
      key: "",
      /**表单数据 */
      form: {
        /**需要转换的参数，行业id，日期，职位id */
        indId: [],
        date: [],
        posId: []
      },
      /**筛选数据 */
      dateList: [
        {
          value: 1,
          label: "1天内"
        },
        {
          value: 2,
          label: "2天内"
        },
        {
          value: 3,
          label: "3天内"
        }
      ],
      date: 1,
      /**弹窗开关 */
      dialogVisible: false,
      /**页数 */
      pageCount: null,
      currentPage: 1,
      /**会话框 */
      dialogVisible: false,
      /**1添加，2修改 */
      status: 0,
      /**列表id */
      id: "",
      /**批量 */
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
      /**收藏列表 */
      dataList: [],
      /**推荐列表 */
      recommendList: []
    };
  },
  methods: {
    /**标签页回调 */
    handleClick: function(tab) {
      this.checkList = [];
      this.checkAll = false;
      if (tab.index == 0) {
        this.getUserJobRecommendList();
      } else if (tab.index == 1) {
        this.getUserJobCollectList();
      }
    },
    /**筛选回调 */
    change: function() {
      this.getUserJobRecommendList();
    },
    /**获取推荐职位列表 */
    getUserJobRecommendList: function(p) {
      p = p || 1;
      var that = this;
      GetUserJobRecommendList({
        updatedate: this.date,
        key: this.key,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.recommendList = res.data;
        }
      });
    },
    /**删除收藏职位 */
    deleteUserJobCollect: function(id) {
      var that = this;
      this.$confirm("确认删除吗？").then(function(_) {
        DeleteUserJobCollect({
          ids: id,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("删除成功");
            that.getUserJobCollectList();
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
    /**职位收藏列表 */
    getUserJobCollectList: function(p) {
      p = p || 1;
      this.dataList = [];
      this.list = [];
      this.pageCount = 0;
      var that = this;
      this.currentPage = p;
      GetUserJobCollectList({
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.dataList = res.data;
          that.list = that.dataList.map(function(item) {
            return item.id;
          });
        }
      });
    },
    open: function(url) {
      location.href = url;
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.userInfo = state.userInfo;
      that.state = state;
      that.getUserJobRecommendList();
    });
  }
};
