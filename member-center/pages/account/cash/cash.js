return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      /**所有返现列表 */
      cashList: [],
      /**未使用返现列表 */
      cashNotUsedList: [],
      /**已使用返现列表 */
      cashUsedList: [],
      /**列表页数 */
      pageCount: null,
      /**当前页数 */
      currentPage: 1,
      activeName: "first",
      /**type -1 默认所有 0未使用 1 已使用*/
      type: -1,
      /**饿了么提供的不确定状态 */
      isIndeterminate: true,
      /**全选状态 */
      checkAll: false,
      /**选中的列表 */
      checkList: [],
      /**页面显示的列表id集合 */
      list: [],
      /**转换后台需要参数 */
      checkListStr: null
    };
  },
  methods: {
    /**返回我的账户
     */
    retrunView: function() {
      this.$router.go(-1);
    },
    /**标签页回调 */
    handleClick: function(tab) {
      this.currentPage = 1;
      if (tab.index == 0) {
        this.getUserCashAllList();
      } else if (tab.index == 1) {
        this.getUserCashNotUsedList();
      } else if (tab.index == 2) {
        this.getUserCashUsedList();
      }
    },
    /**收藏复选框回调 */
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
    /**课程返现已使用列表接口 */
    getUserCashUsedList: function(p) {
      p = p || 1;
      var that = this;
      this.currentPage = p;
      GetUserCashList({
        showstatus: 1,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.cashUsedList = res.data;
        }
      });
    },
    /**课程返现未使用列表接口 */
    getUserCashNotUsedList: function(p) {
      p = p || 1;
      var that = this;
      this.currentPage = p;
      that.list = [];
      GetUserCashList({
        showstatus: 0,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.cashNotUsedList = res.data;
          that.list = that.collectList.map(function(item) {
            return item.id;
          });
        }
      });
    },
    /**课程返现所有列表接口 */
    getUserCashAllList: function(p) {
      p = p || 1;
      var that = this;
      that.list = [];
      GetUserCashList({
        showstatus: -1,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.cashList = res.data;
          var lists = that.cashList.map(function(item) {
            if (item.checkbox_status != "disabled") {
              return item.id;
            } else {
              return false;
            }
          });
          /**去重 */
          for (var i = 0, len = lists.length; i < len; i++) {
            if (that.list.indexOf(lists[i]) < 0) {
              that.list.push(lists[i]);
            }
          }
          /**去false */
          if (that.list.indexOf(false) != -1) {
            that.list.splice(that.list.indexOf(false), 1);
          }
        }
      });
    },
    /**删除课程返现 */
    deleteUserCash: function(id) {
      var that = this;
      this.$confirm("确认删除吗？").then(function(_) {
        DeleteUserCash({
          ids: id,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result === true) {
            that.$message.success("删除返现成功");
            that.checkList = [];
            that.getUserCashList();
            that.getUserCashNotUsedList();
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
      that.getUserCashAllList();
    });
  }
};
