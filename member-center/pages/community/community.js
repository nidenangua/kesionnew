return {
  data: function() {
    return {
      state: {},
      /**筛选框数据 */
      checkList: ["b"],
      /**搜索关键字 */
      keyWord: "",
      /**选择器选项 */
      /**当前选中项 */
      activeName: "first",
      /**社群数据列表 */
      communityList: [],
      /**我的帖子 */
      postList: [],
      /**我的话题数据列表 */
      topicList: [],
      /**选择器选项 */
      options: [
        {
          value: "选项1",
          label: "全部"
        },
        {
          value: "选项2",
          label: "按学习时间"
        },
        {
          value: "选项3",
          label: "按更新时间"
        }
      ],
      /**选择器默认值 */
      value: "全部",
      topicPageCount: null,
      communityPageCount: null,
      postPageCount: null,
      currentPage: 1
    };
  },
  methods: {
    /**选中下拉框或搜索框更新数据 */
    change: function() {
      this.getUserCommunityList();
    },
    /**标签页点击回调 */
    handleClick: function(tab, event) {
      if (tab.index == 0) {
        this.getUserCommunityList();
      } else if (tab.index == 1) {
        this.getUserPostList();
      } else {
        this.getUserTopicList();
      }
    },
    /**跳转页面
     * @params string
     */
    open: function(url) {
      location.href = url;
    },
    /**我的社群数据列表
     *  p:页数
     */
    getUserCommunityList: function(p) {
      p = p || 1;
      // this.$showLoading("#userRight");
      var that = this;
      that.communityList = [];
      that.currentPage = p;
      GetUserCommunityList({
        key: that.keyWord,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.communityPageCount = res.pagecount * 10;
        if (res.result == true) {
          that.communityList = res.data;
        }
      });
    },
    /**请求我的帖子
     *  p:页数
     */
    getUserPostList: function(p) {
      p = p || 1;
      // this.$showLoading("#userRight");
      var that = this;
      that.postList = [];
      that.currentPage = p;
      GetUserPostList({
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.postPageCount = res.pagecount * 10;
        if (res.result == true) {
          that.postList = res.data;
        }
      });
    },

    /**请求我的话题列表
     *  p:页数
     */
    getUserTopicList: function(p) {
      p = p || 1;
      // this.$showLoading("#userRight");
      var that = this;
      that.topicList = [];
      that.currentPage = p;
      GetUserTopicList({
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.topicPageCount = res.pagecount * 10;
        if (res.result == true) {
          that.topicList = res.data;
        }
      });
    },

    /**删除我参与的话题
     *
     */
    delUserTopic: function(item) {
      var that = this;
      this.$confirm("确定删除吗？").then(function(_) {
        // that.$showLoading("#userRight");
        DelUserTopic({
          topicid: item.topicid,
          ids: item.postid,
          apptoken: that.state.appToken
        }).then(function(res) {
          // that.$hideLoading("#userRight");
          if (res.result === true) {
            that.$message.success("删除成功");
            that.getUserTopicList();
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    },
    /**删除我的帖子
     *
     */
    delUserPost: function(item) {
      var that = this;
      this.$confirm("确定删除吗？").then(function(_) {
        // that.$showLoading("#userRight");
        DelUserPost({
          ids: item.topicid,
          apptoken: that.state.appToken
        }).then(function(res) {
          // that.$hideLoading("#userRight");
          if (res.result === true) {
            that.$message.success("删除成功");
            that.getUserPostList();
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
      that.state = state;
      that.getUserCommunityList();
    });
  }
};
