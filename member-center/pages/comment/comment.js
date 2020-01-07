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
      /***************************多选框 ****************************/
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
      /*接口参数,0 我的评价 ，1我收到的评价**/
      queryType: 0,
      /**选择器数据 */
      flag: -1,
      flagList: [],
      /**评价列表 */
      commentList: []
    };
  },
  methods: {
    /**标签页回调
     */
    handleClick: function(tab) {
      this.checkList = [];
      this.checkAll = false;
      this.queryType = tab.index;
      this.getUserCommentList();
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
    /**评价列表 */
    getUserCommentList: function(p) {
      p = p || 1;
      this.commentList = [];
      var that = this;
      this.currentPage = p;
      GetUserCommentList({
        page: p,
        pagesize: 10,
        querytype: this.queryType,
        flag: this.flag,
        userid: that.userInfo.UserID,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.commentList = res.data;
          that.list = that.commentList.map(function(item) {
            return item.id;
          });
        } else {
        }
      });
    },
    /**选中下拉框回调 */
    changeSelect: function() {
      this.getUserCommentList();
    },
    /**删除评价 */
    deleteUserComment: function(id) {
      var that = this;
      this.$confirm("确定删除吗？").then(function(_) {
        DeleteUserComment({
          querytype: that.queryType,
          ids: id,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("删除成功");
            this.checkList = [];
            that.getUserCommentList();
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    },
    open: function(url) {
      location.href = url;
    }
  },
  mounted: function() {
    var that = this;

    that.$store.ready(function(state) {
      var modelList = [
        {
          value: -1,
          label: "全部"
        }
      ];
      if (state.model.edu) {
        modelList.push({
          value: 10002,
          label: "课程"
        });
      }
      if (state.model.classroom) {
        modelList.push({
          value: 10001,
          label: "班级"
        });
      }
      if (state.model.teacher) {
        modelList.push({
          value: 10003,
          label: "教师"
        });
      }
      if (state.model.mall) {
        modelList.push({
          value: 4,
          label: "商城"
        });
      }
      that.flagList = modelList;
      that.userInfo = state.userInfo;
      that.state = state;
      that.getUserCommentList();
    });
  }
};
