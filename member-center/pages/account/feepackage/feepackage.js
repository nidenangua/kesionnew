return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      /**默认支付方式 -1 余额 */
      activePay: -1,
      /**列表页数 */
      pageCount: null,
      currentPage: 1,
      /*余额兑换个数 */
      moneyCount: 0,
      /*积分兑换个数 */
      scoreCount: 0,
      /*当前标签页 */
      activeName: "first",
      /**营销卡列表 */
      feePackageList: [],
      /**购买营销卡列表 */
      buyList: [],
      dialogVisible: false,
      /**购买营销卡*/
      buyDialogVisible: false,
      /**购买营销卡查看详情 */
      buyDetailDialogVisible: false,
      /**我的营销卡使用详情 */
      myDetailDialogVisible: false,
      /**初始化购买页面 */
      initBuyData: {},
      checked: false,
      /**营销卡id */
      packid: 0,
      payId: "0",
      /**支付方式 */
      paymentList: [],
      /**余额支付金额 */
      money: 0,
      /**购买营销卡详情 */
      buyDetailData: {},
      /**我的营销卡详情 */
      myDetailData: {},
      form: {
        /**营销卡号*/
        num: "",
        /**营销卡密码*/
        password: ""
      },
      type: 1,
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
      exchange: false
    };
  },
  watch: {
    money: function(money) {
      if (money - this.initBuyData.price >= 0) {
        this.money = this.initBuyData.price;
        this.activePay = -1;
        this.payId = 0;
      }
      if (money - this.userInfo.Money > 0) {
        this.money = this.userInfo.Money;
      }
      if (this.initBuyData.price > this.userInfo.Money) {
        if (this.activePay == -1) {
          this.activePay = 0;
          this.money = 0;
          this.payId = this.paymentList[0].payid;
        }
      }
    }
  },
  methods: {
    /**标签页回调
     */
    handleClick: function(tab) {
      if (tab.index == 0) {
        this.getUserFeePackageList();
      } else if (tab.index == 1) {
        this.getUserFeePackageBuyList();
      }
    },
    /**返回我的账户
     */
    retrunView: function() {
      this.$router.go(-1);
    },
    /**选择支付类型 */
    payType: function(i) {
      this.activePay = i;
      if (i == -1) {
        this.payId = "0";
        this.money = this.initBuyData.price;
        console.log(this.money);
      } else {
        this.money = 0;
        this.payId = this.paymentList[i].payid;
      }
    },
    /**营销卡列表 */
    getUserFeePackageList: function(p) {
      p = p || 1;
      var that = this;
      this.currentPage = p;
      GetUserFeePackageList({
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.feePackageList = res.data;
        }
      });
    },
    /**购买营销卡列表 */
    getUserFeePackageBuyList: function(p) {
      p = p || 1;
      var that = this;
      this.currentPage = p;
      GetUserFeePackageBuyList({
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.buyList = res.data;
          console.log(that.buyList);
        }
      });
    },
    /**点击购买营销卡信息初始化 */
    initialPayUserFeePackage: function(item) {
      this.buyDetailDialogVisible = false;
      this.myDetailDialogVisible = false;
      this.buyDialogVisible = true;
      this.packid = item.packid;
      var that = this;
      InitialPayUserFeePackage({
        packid: item.packid,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.initBuyData = res.data;
          that.money = that.initBuyData.price;
          that.paymentList = res.data.payment_list;
          if (that.initBuyData.isidentity == 0) {
            that.checked = true;
          }
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**购买营销卡 */
    pay: function() {
      var that = this;
      if (this.activePay == -1) {
        PayUserFeePackage({
          packid: this.packid,
          payid: this.payId,
          userpaymoney: this.money,
          apptoken: this.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.getUserFeePackageBuyList();
            that.$store.dispatch("updateUserInfo");
            that.$store.ready(function(state) {
              that.userInfo = state.userInfo;
            });
            that.buyDialogVisible = false;
            that.$message.success("购买成功");
          } else {
            that.$message.error(res.msg);
          }
        });
      } else {
        PayUserFeePackage({
          packid: this.packid,
          payid: this.payId,
          userpaymoney: this.money,
          apptoken: this.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            location.href = res.pay_url;
          } else {
            that.$message.error(res.msg);
          }
        });
      }
    },
    /**查看购买营销卡详情 */
    openBuyDetailView: function(item) {
      var that = this;
      this.buyDetailDialogVisible = true;
      GetUserFeePackageBuyDetail({
        packid: item.packid,
        apptoken: this.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.buyDetailData = res.data;
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**查看我的营销卡详情 */
    openMyDetail: function(item) {
      console.log(item);
      var that = this;
      this.myDetailDialogVisible = true;
      GetUserFeePackageDetail({
        id: item.id,
        packid: item.packid,
        apptoken: this.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.myDetailData = res.data;
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**打开课程 */
    openCourse: function(item) {
      // location.href = item.view_url
    },
    /**激活营销卡 */
    active: function() {
      var that = this;
      ActivateUserFeePackage({
        couponnum: that.form.num,
        couponpassword: that.form.password,
        apptoken: this.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.$message.success("激活成功");
        } else {
          that.$message.error(res.msg);
        }
      });
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.userInfo = state.userInfo;
      that.state = state;
      that.getUserFeePackageList();
    });
  }
};
