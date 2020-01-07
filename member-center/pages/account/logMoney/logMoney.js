return {
  data: function() {
    return {
      state: store.state,
      /**当前选中项 */
      activeName: "first",
      /**用户信息 */
      userInfo: {},
      /**账户明细数据 */
      moneyList: [],
      /**type 0 默认全部 1收入 2 支出*/
      type: 0,
      /**全部总条数 */
      totalNum: 0,
      /**支出总条数 */
      expendNum: 0,
      /**收入总条数 */
      incomeNum: 0,
      /**列表页数 */
      pageCount: null,
      /**当前页数 */
      currentPage: 1
    };
  },
  methods: {
    /**标签页回调
     */
    handleClick: function(tab) {
      this.type = tab.index;
      this.currentPage = 1;
      this.getUserLogMoneyList();
    },
    /**账户明细列表
     */
    getUserLogMoneyList: function(p) {
      p = p || 1;
      var that = this;
      that.moneyList = [];
      this.currentPage = p;
      GetUserLogMoneyList({
        showstatus: that.type,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        that.totalNum = res.total_num;
        that.expendNum = res.expend_num;
        that.incomeNum = res.income_num;
        if (res.result == true) {
          that.moneyList = res.data;
        }
      });
    },
    /**返回我的账户
     */
    retrunView: function() {
      this.$router.go(-1);
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.userInfo = state.userInfo;
      that.state = state;
      that.getUserLogMoneyList();
    });
  }
};
