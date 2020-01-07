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

      /**选择器数据 */
      channelid: -1,
      channelidList: [],
      /**点赞列表 */
      givezanList: []
    };
  },
  methods: {
    /**标签页回调
     */
    handleClick: function(tab) {
      this.checkList = [];
      this.checkAll = false;
      this.queryType = tab.index;
      this.getList();
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
    /**点赞列表 */
    getList: function(p) {
      p = p || 1;
      this.givezanList = [];
      var that = this;
      this.currentPage = p;
      GetUserFabulousList({
        page: p,
        pagesize: 10,
        channelid: this.channelid,
        userid: that.userInfo.UserID,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.givezanList = res.data;
          that.list = that.givezanList.map(function(item) {
            return item.id;
          });
        }
      });
    },
    /**选中下拉框回调 */
    changeSelect: function() {
      this.getList();
    },
    /**删除点赞 */
    deleteUserGivezan: function(id) {
      var that = this;
      this.$confirm("确定删除吗？").then(function(_) {
        DeleteUserFabulous({
          ids: id,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("删除成功");
            this.checkList = [];
            that.getList();
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
      that.userInfo = state.userInfo;
      var modelList = [
        {
          value: -1,
          label: "全部"
        },{
          value: 0,
          label: "教师"
        },{
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
        },{
          value: -15,
          label: "个人主页"
        },{
          value: -16,
          label: "社群"
        }
      ];
      // if (state.model.teacher) {
      //   modelList.push({
      //     value: 0,
      //     label: "教师"
      //   });
      // }
      // if (state.model.edu) {
      //   modelList.push(
      //     {
      //       value: -10,
      //       label: "点播"
      //     },
      //     {
      //       value: -11,
      //       label: "面授"
      //     },
      //     {
      //       value: -12,
      //       label: "直播"
      //     }
      //   );
      // }

      // if (state.model.space) {
      //   modelList.push({
      //     value: -15,
      //     label: "个人主页"
      //   });
      // }
      // if (state.model.group) {
      //   modelList.push({
      //     value: -16,
      //     label: "社群"
      //   });
      // }
      that.channelidList = modelList;
      that.getList();
    });
  }
};
