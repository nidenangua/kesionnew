return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      /**表单值 */
      form: {
        /**默认充值金额 */
        rechargeMoney: 100
      },
      /**默认支付方式*/
      activePay: 0,
      /**历史充值列表 */
      rechargeList: [],
      /**列表页数 */
      pageCount: null,
      /**当前页数 */
      currentPage: 1,
      /**初始化信息 */
      initData: {},
      /**支付方式列表 */
      paymentList: []
    };
  },
  methods: {
    /**返回我的账户
     */
    retrunView: function() {
      this.$router.go(-1);
    },

    /**历史充值记录列表 */
    getRechargeList: function(p) {
      p = p || 1;
      var that = this;
      this.currentPage = p;
      that.rechargeList = [];
      GetRechargeList({
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pageCount * 10;
        if (res.result == true) {
          that.rechargeList = res.data;
        }
      });
    },
    /**删除充值记录 */
    deleteRecharge: function(item) {
      var that = this;
      DeleteRecharge({
        ids: item.id,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.$message.success("删除成功");
          that.getRechargeList();
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**充值初始化 */
    initialUserRecharge: function(item) {
      var that = this;
      InitialUserRecharge({
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.initData = res.data;
          that.paymentList = res.data.payment_list;
          that.form.rechargeMoney = res.data.charge_money;
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**选择支付类型 */
    payType: function(i) {
      this.activePay = i;
    },
    /**充值 */
    recharge: function() {
      var that = this;
      DoPay({
        rechargemoney: this.form.rechargeMoney,
        payid: this.paymentList[this.activePay].payid,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          location.href = res.url;
        } else {
          that.$message.error(res.msg);
        }
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
      that.state = state;
      that.getRechargeList();
      that.initialUserRecharge();
    });
  }
};
