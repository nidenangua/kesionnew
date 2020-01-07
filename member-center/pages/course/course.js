return {
  data: function() {
    return {
      state: {},
      /**搜索关键字 */
      key: "",
      /**排序选择器选项 */
      sortList: [
        {
          value: "b.LastDate Desc",
          label: "按学习时间"
        },
        {
          value: "b.addDate Desc",
          label: "按更新时间"
        }
      ],
      /**选择器默认值 */
      sort: "b.LastDate Desc",
      /**来源选择器选项 */
      fromList: [
        {
          value: 0,
          label: "全部"
        },
        {
          value: 1,
          label: "购买"
        },
        {
          value: 2,
          label: "网校开通"
        }
      ],
      /**选择器默认值 */
      from: 0,
      /**类型选择器选项 */
      typeList: [
        {
          value: -1,
          label: "全部"
        },
        {
          value: 0,
          label: "面授"
        },
        {
          value: 1,
          label: "点播"
        },
        {
          value: 5,
          label: "直播"
        }
      ],
      /**选择器默认值 */
      costype: -1,
      /**默认显示tab */
      activeName: "first",
      /**课程列表数据 */
      courseList: [],
      /**课程总页数*/
      pageCount: null,
      /**当前页 */
      currentPage: 1,
      /**多选框*/
      expirestatus: false,
      learnstatus: false,
      chargetype: false
    };
  },
  methods: {
    /**多选框.选择器.搜索框的回调 */
    changeList: function() {
      this.getUserCourseList();
    },
    /**标签页面的回调 */
    handleClick: function(tab, event) {
      var that = this;
      switch (tab.label) {
        case "点播课程":
          that.costype = 1;
          break;
        case "直播课程":
          that.costype = 5;
          break;
        case "面授课程":
          that.costype = 0;
          break;
        case "全部":
          that.costype = -1;
          break;
      }
      that.getUserCourseList();
    },
    /**跳转页面 */
    open: function(url, newWin) {
      if (newWin == true) {
        window.open(url);
      } else {
        location.href = url;
      }
    },
    getUserCourseList(p) {
      var that = this;
      // this.$showLoading("#userRight");
      p = p || 1
      if(p==1){
        this.courseList = []
      }
      that.currentPage = p;
      console.log(that.currentPage,p)
      GetUserCourseList({
        page: p,
        pagesize: 10,
        costype: that.costype,
        orderfield: that.sort,
        showsource: that.from,
        chargetype: that.chargetype,
        learnstatus: that.learnstatus,
        expirestatus: that.expirestatus,
        key: that.key,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.courseList = res.data;
          that.courseList.map(function(item) {
            item.has_learnpercent = parseFloat(item.has_learnpercent);
          });
        }
      });
    }
  },
  mounted: function() {
    var that = this;
    this.$store.ready(function(state) {
      that.state = state;
      that.getUserCourseList();
    });
  }
};
