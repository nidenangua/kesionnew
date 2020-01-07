return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      data: {},
      /**表单数据 */
      form: {},
      /**弹窗开关 */
      dialogVisible: false,
      /**省数据 */
      provinceList: [],
      /**市数据 */
      cityList: [],
      /**区数据 */
      areaList: [],
      provinceId: "",
      cityId: "",
      countyId: "",
      /**行业列表 */
      industry: [],
      industryList: [],
      /**职业列表 */
      position: [],
      positionList: [],
      /**期望月薪 */
      salaryList: []
    };
  },
  methods: {
    handleChange: function() {},
    /**打开下拉框获取省级数据
     *  e 回调参数 布尔值
     */
    getProvinceList: function(e) {
      var that = this;
      if (e) {
        if (that.provinceList.length == 0) {
          GetArea({
            areaid: 0
          }).then(function(res) {
            that.provinceList = res.data;
          });
        }
      }
    },
    /**打开下拉框获取市级数据
     *  e 回调参数 布尔值
     */
    getCityList: function(e) {
      var that = this;
      if (e) {
        if (that.cityList.length == 0 && that.provinceId != "") {
          GetArea({
            areaid: that.provinceId
          }).then(function(res) {
            that.cityList = res.data;
          });
        }
      }
    },
    /**打开下拉框获取区级数据
     *  e 回调参数 布尔值
     */
    getAreaList: function(e) {
      var that = this;
      if (e) {
        if (that.areaList.length == 0 && that.cityId != "") {
          GetArea({
            areaid: that.cityId
          }).then(function(res) {
            that.areaList = res.data;
          });
        }
      }
    },
    /**选中省级菜单回调获取市级列表 */
    changeProvince: function(e) {
      var that = this;
      that.provinceId = e;
      GetArea({
        areaid: e
      }).then(function(res) {
        if (res.result == true) {
          that.cityList = res.data;
          that.cityId = res.data[0].id;
          that.form.city = res.data[0].city;
          that.countyId = "";
          that.form.county = "";
          that.areaList = [];
        } else {
          that.form.county = "";
          that.form.city = "";
          that.countyId = "";
          that.cityId = "";
          that.cityList = [];
          that.areaList = [];
        }
      });
    },
    /**选中市级菜单回调获取区县列表 */
    changeCity: function(e) {
      /**强制刷新值的方法 */
      this.$forceUpdate();
      var that = this;
      that.cityId = e;
      GetArea({
        areaid: e
      }).then(function(res) {
        if (res.result == true) {
          that.areaList = res.data;
          that.form.county = res.data[0].city;
          that.countyId = res.data[0].id;
        } else {
          that.areaList = [];
          that.form.county = "";
          that.countyId = "";
        }
      });
    },
    /**选中区县更新区县id */
    changeCounty: function(e) {
      /**强制刷新值的方法 */
      this.$forceUpdate();
      this.countyId = e;
    },
    getUserJobIntention: function() {
      var that = this;
      GetUserJobIntention({
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.form = res.data;
          that.data = res.data;
        }
      });
    },
    /**行业分类 */
    getJobIndustryCategory: function() {
      var that = this;
      GetJobIndustryCategory({
        apptoken: that.state.appToken
      }).then(function(res) {
        that.industryList = res.data;
        console.log(that.industryList);
      });
    },
    /**职业分类 */
    getPositionCategory: function() {
      var that = this;
      GetPositionCategory({
        apptoken: that.state.appToken
      }).then(function(res) {
        that.positionList = res.data;
      });
    },
    /**获取期望月薪 */
    getJobSalary: function() {
      var that = this;
      GetJobSalary({
        apptoken: that.state.appToken
      }).then(function(res) {
        that.salaryList = res.data;
      });
    },
    /**保存修改 */
    save: function() {
      var that = this;

      SaveUserJobIntention({
        jobtype: that.form.jobtype,
        jobposition: that.form.msgTitle,
        industryid:
          that.form.industry_category[that.form.industry_category.length - 1],
        jobid:
          that.form.position_category[that.form.position_category.length - 1],
        provinceid: that.provinceId,
        cityid: that.cityId,
        countyid: that.countyId,
        salary: that.form.salary,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.$message.success("修改成功");
          that.dialogVisible = false;
          that.getUserJobIntention();
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
      that.getUserJobIntention();
      that.getJobIndustryCategory();
      that.getPositionCategory();
      that.getJobSalary();
    });
  }
};
