return {
  data: function() {
    return {
      state: {},
      /**列表页详情页切换开关 */
      listFalg: true,
      /**搜索关键字 */
      keyWord: "",
      /**排序选择器选项 */
      sortList: [
        {
          value: "b.LastDate desc",
          label: "按学习时间"
        },
        {
          value: "b.adddate desc",
          label: "按更新时间"
        }
      ],
      /**选择器默认值 */
      sort: "b.LastDate desc",
      /**来源选择器选项 */
      fromList: [
        {
          value: "0",
          label: "全部"
        },
        {
          value: "1",
          label: "购买"
        },
        {
          value: "2",
          label: "网校开通"
        }
      ],
      /**选择器默认值 */
      from: "0",
      /** 专栏列表数据 */
      columnList: [],
      /** 总页数*/
      pageCount: null,
      currentPage: 1,
      /**专栏详情信息 */
      columnInfo: {},
      /**课程列表 */
      courseList: [],
      /**商品列表 */
      shopList: [],
      /**试卷列表 */
      paperList: [],
      /**标签页 */
      activeName: "first"
    };
  },
  methods: {
    /**标签页点击回调 */
    handleClick: function(tab, event) {
      var that = this;
    },
    /**跳转页面 */
    open: function(url) {
      // location.href = url
      window.open(url);
    },
    /**选中下拉框或搜索框更新数据 */
    change: function() {
      this.getUserSpecialList();
    },
    /**请求专栏列表数据 */
    getUserSpecialList: function(p) {
      p = p || 1;
      // this.$showLoading("#userRight");
      var that = this;
      that.columnList = [];
      that.currentPage = p;
      GetUserSpecialList({
        key: that.keyWord,
        orderfield: that.sort,
        showsource: that.from,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.columnList = res.data;
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.columnList = res.data;
          /**如果只有一个专栏，直接进入详情 */
          if (that.columnList.length == 1) {
            that.listFalg = false;
            that.getUserSpecialDetail(that.columnList[0]);
          }
        }
      });
    },
    /**打开详情页并且请求详情页数据 */
    openDetail: function(item) {
      var that = this;
      that.listFalg = false;
      that.getUserSpecialDetail(item);
    },
    /**打开外链*/
    openView: function(url, id) {
      location.href = url + "#/PaperInfo?paperid=" + id;
    },
    /**请求详情页数据 */
    getUserSpecialDetail: function(item) {
      var that = this;
      // this.$showLoading("#userRight");
      GetUserSpecialDetail({
        courseid: item.courseid,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        if (res.result == true) {
          that.columnInfo = res.data.special_info;
          that.paperList = res.data.paper_list;
          that.courseList = res.data.course_list;
          that.shopList = res.data.shop_list;
        }
      });
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.state = state;
      that.getUserSpecialList();
    });
  }
};
