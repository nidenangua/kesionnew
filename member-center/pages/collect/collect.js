return {
  data: function() {
    return {
      state: store.state,

      /**搜索关键字 */
      keyWord: "",
      /**选择器选项 */
      /**当前选中项 */
      activeName: "first",
      /**社群数据列表 */
      communityList: [],
      /**收藏列表 */
      collectList: [],
      /**问题列表 */
      askList: [],
      /**选择器选项 */
      channelidList: [],
      /**选择器默认值 */
      channelid: -1,
      /***************************我的收藏多选框 ****************************/
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
      /*************************收藏问题多选框****************************** */
      /**选中的列表 */
      askCheckList: [],
      /**全选状态 */
      checkAllAsk: false,
      /**页面显示的列表id集合 */
      listAsk: [],
      /**饿了么提供的不确定状态 */
      isIndeterminateAsk: true,
      /**转换后台需要参数 */
      askCheckListStr: null,
      /************** *********** */
      /**我的收藏总页数 */
      myPageCount: null,
      /**问题收藏总页数 */
      askPageCount: null,
      currentPage: 1
    };
  },
  methods: {
    /**标签页点击回调 */
    handleClick: function(tab, event) {
      if (this.activeName == "first") {
        this.getUserFavoriteList();
      } else if (this.activeName == "second") {
        this.getUserAskFavriteList();
      }
    },
    /**跳转页面
     * @params string
     */
    openView: function(item) {
      location.href = item.view_url;
    },

    /**请求问题收藏列表
     *  p:页数
     */
    getUserAskFavriteList: function(p) {
      p = p || 1;
      var that = this;
      // this.$showLoading("#userRight");
      that.askList = [];
      this.currentPage = p;
      GetUserAskFavriteList({
        channelid: this.channelid,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.askPageCount = res.pagecount * 10;
        if (res.result == true) {
          that.askList = res.data;
          that.listAsk = that.askList.map(function(item) {
            return item.id;
          });
        } else {
        }
      });
    },

    /**请求我的收藏列表
     *  p:页数
     */
    getUserFavoriteList: function(p) {
      p = p || 1;
      var that = this;
      // this.$showLoading("#userRight");
      that.collectList = [];
      this.currentPage = p;
      GetUserFavoriteList({
        channelid: this.channelid,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.myPageCount = res.pagecount * 10;
        if (res.result == true) {
          that.collectList = res.data;
          that.list = that.collectList.map(function(item) {
            return item.id;
          });
        }
      });
    },
    /**我的收藏 删除
     *
     */
    deleteUserFavorite: function(id) {
      var that = this;
      this.$confirm("确定删除吗？").then(function(_) {
        DeleteUserFavorite({
          ids: id,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result === true) {
            that.$message.success("删除收藏成功");
            that.checkList = [];
            that.getUserFavoriteList();
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    },
    /**我的收藏 问题删除
     *  p:页数
     */
    deleteUserAskFavorite: function(id) {
      var that = this;
      this.$confirm("确定删除吗？").then(function(_) {
        DeleteUserAskFavorite({
          ids: id,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result === true) {
            that.$message.success("删除问题成功");
            that.askCheckList = [];
            that.getUserAskFavriteList();
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    },

    /**收藏复选框回调 */
    handleCheckAllChange: function(val) {
      this.checkList = val ? this.list : [];
      this.checkListStr = this.checkList.join();
      this.isIndeterminate = false;
    },
    /**收藏复选框回调 */
    handleCheckedlistChange: function(value) {
      var checkedCount = value.length;
      this.checkAll = checkedCount === this.list.length;
      this.isIndeterminate =
        checkedCount > 0 && checkedCount < this.list.length;
      this.checkListStr = this.checkList.join();
    },
    /**问题复选框回调 */
    handleCheckAllAskChange: function(val) {
      this.askCheckList = val ? this.listAsk : [];
      this.askCheckListStr = this.askCheckList.join();
      this.isIndeterminateAsk = false;
    },
    /**问题复选框回调 */
    handleCheckedAskListChange: function(value) {
      var checkedCount = value.length;
      this.checkAllAsk = checkedCount === this.listAsk.length;
      this.isIndeterminateAsk =
        checkedCount > 0 && checkedCount < this.listAsk.length;
      this.askCheckListStr = this.askCheckList.join();
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      var modelList = [
        {
          value: -1,
          label: "全部"
        },

        {
          value: 1,
          label: "文章"
        }
      ];
      if (state.model.mall) {
        modelList.push({
          value: 4,
          label: "商城"
        });
      }
      if (state.model.teacher) {
        modelList.push({
          value: 0,
          label: "教师"
        });
      }
      if (state.model.exam) {
        modelList.push({
          value: 50,
          label: "试卷"
        });
      }
      if (state.model.edu) {
        modelList.push(
          {
            value: -10,
            label: "点播"
          },
          {
            value: -11,
            label: "面授"
          },
          {
            value: -12,
            label: "直播"
          }
        );
      }
      that.channelidList = modelList;
      that.state = state;
      that.getUserFavoriteList();
    });
  }
};
