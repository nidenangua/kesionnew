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
      /**默认支付方式 0 微信 */
      activePay: 0,
      /**历史充值列表 */
      rechargeList: [],
      /**列表页数 */
      pageCount: null,
      currentPage: 1,
      /** 0 余额兑换点券 1 积分兑换点券 */
      activeExchangepoint: 0,
      /*余额兑换数据 */
      moneyData: {},
      /*积分兑换数据 */
      scoreData: {},
      /*余额兑换个数 */
      moneyCount: 0,
      /*积分兑换个数 */
      scoreCount: 0
    };
  },
  methods: {
    /**返回我的账户
     */
    retrunView: function() {
      this.$router.go(-1);
    },
    /**切换标签页 */
    changeTabs: function(index) {
      this.activeExchangepoint = index;
      console.log(this.activeExchangepoint);
      if (index == 0) {
        this.moneyExchangePoint();
      } else if (index == 1) {
        this.scoreExchangePoint();
      }
    },
    /**初始化余额兑换点券信息接口 */
    moneyExchangePoint: function(item) {
      var that = this;
      MoneyExchangePoint({
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.moneyData = res.data;
          that.moneyCount = Math.floor(that.moneyData.available_balance);
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**初始化积分兑换点券信息接口 */
    scoreExchangePoint: function(item) {
      var that = this;
      ScoreExchangePoint({
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.scoreData = res.data;
          that.scoreCount = Math.floor(that.scoreData.available_balance);
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**保存余额兑换点券接口 */
    saveMoneyExchangePoint: function() {
      var that = this;
      this.$confirm("确认兑换点券吗？").then(function(_) {
        SaveMoneyExchangePoint({
          point: that.moneyCount,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("兑换成功");
            that.moneyExchangePoint();
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    },
    /**保存积分兑换点券接口 */
    saveScoreExchangePoint: function() {
      var that = this;
      this.$confirm("确认兑换点券吗？").then(function(_) {
        SaveScoreExchangePoint({
          scorepoint: that.scoreCount,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("兑换成功");
            that.scoreExchangePoint();
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    },
    /**打开页面 */
    openView: function(url) {
      this.$router.push(url);
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.userInfo = state.userInfo;
      that.state = state;
      that.moneyExchangePoint();
    });
  }
};
