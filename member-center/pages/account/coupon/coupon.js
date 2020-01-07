return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      /**优惠券列表 */
      couponList: [],
      /**红包列表 */
      redPacketList: [],
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
          value: 3,
          label: "未过期"
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
    /**打开链接 */
    open: function(url) {
      location.href = url;
    },
    /**返回我的账户
     */
    retrunView: function() {
      this.$router.go(-1);
    },
    /**标签页回调 */
    handleClick: function(tab) {
      this.currentPage = 1;
      if (tab.index == 0) {
        this.getUserCouponList();
      } else if (tab.index == 1) {
        this.getUserRedPacketList();
      }
    },
    /**选择器回调 */
    change: function(e) {
      console.log(e);
      if (this.activeName == "first") {
        this.getUserCouponList();
      } else if (this.activeName == "second") {
        this.getUserRedPacketList();
      }
    },
    /**优惠券列表接口 */
    getUserCouponList: function(p) {
      p = p || 1;
      var that = this;
      this.currentPage = p;
      that.couponList = [];
      GetUserCouponList({
        showstatus: that.value,
        page: p,
        pagesize: 6,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.couponList = res.data;
        }
      });
    },
    /**红包列表接口 */
    getUserRedPacketList: function(p) {
      p = p || 1;
      var that = this;
      this.currentPage = p;
      that.redPacketList = [];
      GetUserRedPacketList({
        showstatus: that.value,
        page: p,
        pagesize: 6,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.redPacketList = res.data;
        }
      });
    },
    /**兑换优惠券*/
    saveUserCouponList: function() {
      var that = this;
      SaveUserCouponList({
        couponnum: this.couponnum,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.$message.success("兑换成功");
          that.value = -1;
          that.getUserCouponList();
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**打开使用详情 */
    openDetail: function(item, title) {
      console.log(item);
      this.detailData = item;
      this.title = title;
      this.dialogVisible = true;
    },
    /**关闭详情 */
    close: function() {
      this.dialogVisible = false;
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.userInfo = state.userInfo;
      that.state = state;
      that.getUserCouponList();
    });
  }
};
