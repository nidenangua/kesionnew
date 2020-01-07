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
      /**消息列表 */
      dataList: [],
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
      /**详情窗口开关 */
      dialogVisible: false,
      /**面试通知窗口开关 */
      interviewDialogVisible: false,
      /**详情页面数据 */
      detailData: {},
      form: {
        toUserName: "",
        msgTitle: "",
        msgContent: ""
      }
    };
  },
  methods: {
    /**标签页回调
     */
    handleClick: function(tab) {
      this.checkList = [];
      this.checkAll = false;
      if (tab.index == 0) {
        this.getUserJobdataList();
      } else if (tab.index == 1) {
        this.getUserJobInterviewNoticeList();
      } else if (tab.index == 2) {
        this.getUserJobHasLookList();
      } else if (tab.index == 3) {
        this.getUserJobHasEnterpriseLookList();
      }
    },
    /**职位申请列表 */
    getUserJobdataList: function(p) {
      p = p || 1;
      this.dataList = [];
      this.list = [];
      this.pageCount = 0;
      var that = this;
      this.currentPage = p;
      GetUserJobApplyList({
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
    /**面试通知列表 */
    getUserJobInterviewNoticeList: function(p) {
      p = p || 1;
      this.dataList = [];
      this.list = [];
      this.pageCount = 0;
      var that = this;
      this.currentPage = p;
      GetUserJobInterviewNoticeList({
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
    /**面试通知详情 */
    openInterview: function(item) {
      this.interviewDialogVisible = true;
      var that = this;
      LookUserJobInterviewNotice({
        id: item.id,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.detailData = res.data;
          that.getUserJobInterviewNoticeList();
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**申请职位详情 */
    openDetail: function(item) {
      this.dialogVisible = true;
      var that = this;
      LookUserJobApply({
        id: item.id,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.detailData = res.data;
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**浏览记录 */
    getUserJobHasLookList: function(p) {
      p = p || 1;
      this.dataList = [];
      this.list = [];
      this.pageCount = 0;
      var that = this;
      this.currentPage = p;
      GetUserJobHasLookList({
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
    /**删除浏览记录
     * 参数ids，id集合
     */
    deleteUserJobHasLook: function() {
      var that = this;
      this.$confirm("确定删除吗？").then(function(_) {
        DeleteUserJobHasLook({
          ids: that.checkListStr,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("操作成功");
            this.checkList = [];
            that.getUserJobHasLookList();
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    },
    /**被企业查看记录 */
    getUserJobHasEnterpriseLookList: function(p) {
      p = p || 1;
      this.dataList = [];
      this.list = [];
      this.pageCount = 0;
      var that = this;
      this.currentPage = p;
      GetUserJobHasEnterpriseLookList({
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
    /**删除被企业查看记录
     * 参数ids，id集合
     */
    deleteUserJobHasEnterpriseLook: function() {
      var that = this;
      this.$confirm("确定删除吗？").then(function(_) {
        DeleteUserJobHasEnterpriseLook({
          ids: that.checkListStr,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("操作成功");
            this.checkList = [];
            that.getUserJobHasEnterpriseLookList();
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
    /**删除申请记录
     * 参数ids，id集合
     */
    deleteUserJobApply: function() {
      var that = this;
      this.$confirm("确定删除吗？").then(function(_) {
        DeleteUserJobApply({
          ids: that.checkListStr,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("操作成功");
            this.checkList = [];
            that.getUserJobdataList();
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.userInfo = state.userInfo;
      that.state = state;
      that.getUserJobdataList();
    });
  }
};
