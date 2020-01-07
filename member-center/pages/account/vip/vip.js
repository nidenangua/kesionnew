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
      /**默认升级vip 0  */
      activeVip: 0,
      /**历史充值列表 */
      rechargeList: [],
      /**列表页数 */
      pageCount: null,
      currentPage: 1,
      /**会员卡列表 */
      vipCardList: [],
      /**会员卡初始化数据 */
      vipInitData: {},
      /**默认支付方式 -1余额  */
      activePay: -1,
      /**默认支付id 0 */
      payId: 0,
      /**支付方式列表 */
      paymentList: [],
      /**vip id */
      powerId: 0,
      /**升级明细列表 */
      vipDetailList: [],
      /**余额支付金额 */
      money: 0,
      /**商品价格 */
      price: 0
    };
  },
  watch: {
    money: function(money) {
      if (money - this.price >= 0) {
        this.money = this.price;
        this.activePay = -1;
        this.payId = 0;
      }
      if (money - this.userInfo.Money > 0) {
        this.money = this.userInfo.Money;
      }
      if (this.price > this.userInfo.Money) {
        if (this.activePay == -1) {
          this.activePay = 0;
          this.money = 0;
          this.payId = this.paymentList[0].payid;
        }
      }
    }
  },
  methods: {
    /**返回我的账户
     */
    retrunView: function() {
      this.$router.go(-1);
    },
    /**升级支付 */
    pay: function() {
      var that = this;
      if (this.activePay == -1) {
        PayUserUpgradeVIP({
          usertype: this.powerId,
          payid: this.payId,
          user_pay_money: this.money,
          apptoken: this.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.getUserUpgradeVIPDetailList();
            that.$store.dispatch("updateUserInfo").then(function() {
              that.$store.ready(function(state) {
                that.userInfo = state.userInfo;
              });
            });
            that.$message.success("升级vip成功");
          } else {
            that.$message.error(res.msg);
          }
        });
      } else {
        PayUserUpgradeVIP({
          usertype: this.powerId,
          payid: this.payId,
          user_pay_money: this.money,
          apptoken: this.state.appToken
        }).then(function(res) {
          if (res.result == false) {
            location.href = res.pay_url;
          }
        });
      }
    },
    /**切换vip类型 */
    changeVip: function(i) {
      this.activeVip = i;
      this.price = this.vipCardList[i].power_money;
      this.money = this.vipCardList[i].power_money;
      this.powerId = this.vipCardList[i].power_id;
    },
    /**选择支付类型 */
    payType: function(i) {
      this.activePay = i;
      if (i == -1) {
        this.payId = 0;
        this.money = this.price;
      } else {
        this.money = 0;
        this.payId = this.paymentList[i].payid;
      }
    },
    /**vip列表 */
    getUserUpgradeVIP: function() {
      var that = this;
      GetUserUpgradeVIP({
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.vipCardList = res.data;
          that.vipInitData = res;
          that.paymentList = res.payment_list;
          that.powerId = res.data[0].power_id;
          that.price = res.data[0].power_money;
          that.money = res.data[0].power_money;
        }
      });
    },
    /**vip明细 */
    getUserUpgradeVIPDetailList: function(p) {
      p = p || 1;
      var that = this;
      this.currentPage = p;
      GetUserUpgradeVIPDetailList({
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.vipDetailList = res.data;
        }
      });
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.userInfo = state.userInfo;
      that.state = state;
      that.getUserUpgradeVIP();
      that.getUserUpgradeVIPDetailList();
    });
  }
};
