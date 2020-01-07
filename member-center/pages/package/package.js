return {
  data:function() {
    return {
      state: {},
      userInfo: {},
      showPopup: false, //显示弹出层开关
      index: 0, //导航显示
      active: 0, //右侧分类当前样式
      pageCountMy: 0, //我的套餐包总页面数
      pageCountBuy: 0, //购买套餐包总页面数
      pageCountDetail: 0, //购买明细总页面数
      detailData: {}, //套餐包详情数据
      buyData: [], //数据
      myData: [], //数据
      type: null, //数据
      price: 0, //价格
      showBuy: false, //显示购买提示
      data: null, //套餐包数据
      /**当前标签页 */
      activeName: "first",
      /**下拉框 */
      statusList: [
        {
          value: 0,
          label: "所有记录"
        },
        {
          value: 1,
          label: "即将要到期"
        },
        {
          value: 2,
          label: "已过期"
        }
      ],
      status: 0,
      /**当前页 */
      currentPage: 1,
      buyDialogVisible: false,
      initBuyData: {},
      money: "",
      /**默认支付方式 -1 余额 */
      activePay: -1,
      payId: 0
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
    /**当前标签页回调 */
    handleClick: function(tab) {
      if (this.activeName == "first") {
        this.myFeeSellList();
      } else if (this.activeName == "second") {
        this.getFeePackagesList();
      } else {
        this.myFeeSellList();
      }
    },
    /**下拉框回调 */
    change: function() {
      if (this.activeName == "second") {
        this.getFeePackagesList();
      } else {
        this.myFeeSellList();
      }
    },
    closeBuy: function() {
      //取消购买套餐包
      this.showBuy = false;
    },
    /**初始化购买套餐包 */
    onBuy: function(data) {
      var that = this;

      InitialPayPaperFeePackage({
        packid: data.id,
        apptoken: this.state.appToken
      }).then(function(res) {
        that.initBuyData = res.data;
        that.paymentList = res.data.payment_list;
        that.money = res.data.price;
        that.showPopup = false;
        that.buyDialogVisible = true;
      });
    },
    /**选择支付类型 */
    payType: function(i) {
      this.activePay = i;
      if (i == -1) {
        this.payId = "0";
        this.money = this.initBuyData.price;
      } else {
        this.money = 0;
        this.payId = this.paymentList[i].payid;
      }
    },
    /**购买套餐包 */
    buyPackage: function(data) {
      var that = this;
      this.showBuy = false;
      BuyFeePackages({
        payid: this.payId,
        user_pay_money: this.money,
        packageid: this.initBuyData.packid,
        apptoken: this.state.appToken
      }).then(function(res) {
        if (that.activePay == -1) {
          /**余额支付 */
          if (res.result == true) {
            that.$message.success("购买成功");
            if (that.activeName == "first") {
              that.myFeeSellList();
            } else if (that.activeName == "second") {
              that.getFeePackagesList();
            }
            that.buyDialogVisible = false;
          } else {
            that.$message.error(res.msg);
          }
        } else {
          /**其他支付 */
          if (res.result == true) {
            location.href = res.pay_url;
          } else {
            that.$message.error(res.msg);
          }
        }
      });
    },
    /**打开套餐包详情页开关并请求数据 */
    openPopup: function(item, type) {
      if (type == "buy") {
        this.getFeePackagesDetail(item);
      } else if (type == "my") {
        this.myFeeSellDetail(item);
      }
      this.type = type;
      this.showPopup = true;
    },
    closePopup: function() {
      //关闭详情页
      this.showPopup = false;
    },
    getData: function(index) {
      if (index == 0) {
        this.myFeeSellList();
      } else if (index == 1) {
        this.getFeePackagesList();
      }
    },
    /**
     * 获取我的套餐包数据
     */
    myFeeSellList: function(p) {
      p = p || 1;
      // this.$showLoading("#userRight");
      var that = this;
      this.currentPage = p;
      this.myData = [];
      MyFeeSellList({
        page: p,
        pagesize: 6,
        showtype: this.status,
        apptoken: this.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.pageCountMy = res.pagecount * 10;
        that.pageCountDetail = res.pagecount * 10;
        if (res.result == true) {
          that.myData = res.data;
        }
      });
    },
    /**
     * 获取购买套餐包数据
     */
    getFeePackagesList: function(p) {
      p = p || 1;
      // this.$showLoading("#userRight");
      var that = this;
      this.currentPage = p;
      this.buyData = [];
      GetFeePackagesList({
        page: p,
        pagesize: 6,
        apptoken: this.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.pageCountBuy = res.pagecount * 10;
        if (res.result == true) {
          that.buyData = res.data;
        }
      });
    },
    /**购买套餐包详情 */
    getFeePackagesDetail: function(item) {
      var that = this;
      that.detailData = {};
      GetFeePackagesDetail({
        id: item.id,
        apptoken: this.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.detailData = res.data;
        }
      });
    },
    /**我的套餐包详情 */
    myFeeSellDetail: function(item) {
      var that = this;
      this.detailData = {};
      MyFeeSellDetail({
        id: item.id,
        apptoken: this.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.detailData = res.data;
        }
      });
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.state = state;
      that.userInfo = state.userInfo;
      that.myFeeSellList();
    });
  }
};
