return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      /**签到列表 */
      signInList: [],
      /**签到排名列表 */
      signInRankList: [],
      /**列表页数 */
      pageCount: null,
      /**当前页数 */
      currentPage: 1,
      activeName: "first",
      /**type -1 默认所有 0未使用 1 已使用*/
      type: -1,
      /**选择器选项 */
      options: [
        {
          value: -1,
          label: "全部"
        },
        {
          value: 0,
          label: "未使用"
        },
        {
          value: 1,
          label: "已用完"
        },
        {
          value: 2,
          label: "未用完"
        },
        {
          value: 3,
          label: "已过期"
        }
      ],
      /**选择器选中值 */
      value: -1,
      /**详情开关 */
      dialogVisible: false,
      /**详情标题 */
      title: "",
      /**详情数据 */
      detailData: {},
      /**兑换码 */
      couponnum: ""
    };
  },
  methods: {
    /**标签页回调 */
    handleClick: function(tab) {
      this.currentPage = 1;
      if (tab.index == 0) {
        this.getSignInList();
      } else if (tab.index == 1) {
        this.getUserSignInRanking();
      }
    },
    /**签到记录列表 */
    getSignInList: function(p) {
      var that = this;
      p = p || 1;
      this.currentPage = p;
      that.signInList = [];
      GetUserSignInList({
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.signInList = res.data;
        }
      });
    },
    /**签到排名列表接口 */
    getUserSignInRanking: function(p) {
      p = p || 1;
      var that = this;
      this.currentPage = p;
      this.signInRankList = [];
      GetUserSignInRanking({
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.signInRankList = res.data;
        }
      });
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.userInfo = state.userInfo;
      that.state = state;
      that.getSignInList();
    });
  }
};
