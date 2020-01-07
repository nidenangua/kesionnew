return {
  data: function() {
    return {
      state: {},
      /**搜索关键字 */
      keyWord: "",
      /**选择器选项 */
      /**当前选中项 */
      activeName: "first",
      /**活动数据列表 */
      activityList: [],
      /**所有活动数据列表 */
      allActivityList: [],
      /**总页数 */
      pageCount: null,
      /**当前页 */
      currentPage: 1,
      /**选择器选项 */
      sortList: [
        {
          value: "adddate desc",
          label: "按更新时间"
        },
        {
          value: "effective_end desc",
          label: "按有效期"
        }
      ],
      /**选择器默认值 */
      sort: "adddate desc",
      /**筛选 */
      chargetype: false,
      isexprise: false,
      /**支付 */
      dialogVisible: false,
      iframeUrl: ""
    };
  },
  methods: {
    /**自适应iframe的高度 */
    changeFrameHeight: function() {
      var ifm = document.getElementById("iframe");
      var subWeb = document.frames
        ? document.frames["iframe"].document
        : ifm.contentDocument;
      if (ifm != null && subWeb != null) {
        ifm.height = "auto"; //取消掉之前iframe设置的高度
        ifm.height = subWeb.body.scrollHeight + "px";
      }
    },
    /**搜索框，选中框回调 */
    change: function() {
      this.getUserAllActivityList();
    },
    /**打开页面 */
    open: function(url) {
      location.href = url;
    },
    /**标签页点击回调 */
    handleClick: function(tab) {
      if (tab.index == 0) {
        this.getUserActivityList();
      } else {
        this.getUserAllActivityList();
      }
    },
    /**请求获取活动数据列表
     *  p:页数
     */
    getUserActivityList: function(p) {
      p = p || 1;
      // this.$showLoading("#userRight");
      var that = this;
      that.activityList = [];
      that.currentPage = p;
      GetUserActivityList({
        page: p,
        pagesize: 5,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.activityList = res.data;
        }
      });
    },
    /**取消报名订单
     *  item 删除项
     */
    delUserActivity: function(id) {
      var that = this;
      this.$confirm("确定取消报名吗？").then(function(_) {
        DelUserActivity({
          signids: id,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result === true) {
            that.$message.success("取消报名成功");
            that.getUserAllActivityList();
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    },
    /**删除订单
     *  item 删除项
     */
    deleteOrder: function(item) {
      var that = this;
      this.$confirm("确定删除吗？").then(function(_) {
        DelUserActivity({
          signids: item.signid,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result === true) {
            that.$message.success("删除成功");
            that.getUserAllActivityList();
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    },
    /**请求获取所有活动数据列表
     *  p:页数
     */
    getUserAllActivityList: function(p) {
      p = p || 1;
      // this.$showLoading("#userRight");
      var that = this;
      that.allActivityList = [];
      that.currentPage = p;
      GetUserAllActivityList({
        isexprise: that.isexprise,
        chargetype: that.chargetype,
        key: that.keyWord,
        orderfield: that.sort,
        page: p,
        pagesize: 5,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.allActivityList = res.data;
        }
      });
    },

    /**
     * 复制票号
     */
    copyText: function(item) {
      var input = document.createElement("input"); // 直接构建input
      input.value = item; // 设置内容
      document.body.appendChild(input); // 添加临时实例
      input.select(); // 选择实例内容
      document.execCommand("Copy"); // 执行复制
      document.body.removeChild(input);
      this.$message.success("复制票号成功");
    },
    /**打开支付框 */
    openPay: function(item) {
      this.dialogVisible = true;
      this.payData = item;
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.state = state;
      that.getUserActivityList();
    });
  }
};
