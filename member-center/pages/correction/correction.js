return {
  data: function() {
    return {
      state: StorageEvent.state,
      /**当前分页 */
      activeName: "first",
      /**所有记录数据 */
      allList: [],
      allPageCount: null,
      /**已纠正数据 */
      trueList: [],
      truePageCount: null,
      /**未纠正数据 */
      falseList: [],
      falsePageCount: null,
      currentPage: 1
    };
  },
  methods: {
    /**标签页回调 */
    handleClick: function(tab) {
      if (tab.index == 0) {
        this.getUserTkCorrectionAllList();
      } else if (tab.index == 1) {
        this.getUserTkCorrectionTrueList();
      } else if (tab.index == 2) {
        this.getUserTkCorrectionFalseList();
      }
    },
    /**所有记录数据 */
    getUserTkCorrectionAllList: function(p) {
      p = p || 1;
      // this.$showLoading("#userRight");
      var that = this;
      that.allList = [];
      that.currentPage = p;
      GetUserTkCorrectionList({
        showstatus: -1,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.allPageCount = res.pagecount * 10;
        if (res.result == true) {
          that.allList = res.data;
        } else {
        }
      });
    },
    /**已纠正数据 */
    getUserTkCorrectionTrueList: function(p) {
      p = p || 1;
      // this.$showLoading("#userRight");
      var that = this;
      that.trueList = [];
      that.currentPage = p;
      GetUserTkCorrectionList({
        showstatus: 1,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.truePageCount = res.pagecount * 10;
        if (res.result == true) {
          that.trueList = res.data;
        } else {
        }
      });
    },
    /**未纠正数据 */
    getUserTkCorrectionFalseList: function(p) {
      p = p || 1;
      // this.$showLoading("#userRight");
      var that = this;
      that.falseList = [];
      that.currentPage = p;
      GetUserTkCorrectionList({
        showstatus: 0,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.falsePageCount = res.pagecount * 10;
        if (res.result == true) {
          that.falseList = res.data;
        } else {
        }
      });
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.state = state;
      that.getUserTkCorrectionAllList();
    });
  }
};
