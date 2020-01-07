return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      /**表单数据 */
      form: {
        /**需要转换的参数，行业id，日期，职位id */
        indId: [],
        date: [],
        posId: []
      },
      /**弹窗开关 */
      dialogVisible: false,
      /**行业列表 */
      industryList: [],
      /**职业列表 */
      positionList: [],
      /**公司规模 */
      sizeList: [],
      /**工作经验列表 */
      experienceList: [],
      /**页数 */
      pageCount: null,
      /**会话框 */
      dialogVisible: false,
      /**1添加，2修改 */
      status: 0,
      /**列表id */
      id: ""
    };
  },
  methods: {
    /**选择框回调 */
    handleChange: function() {},
    /**行业分类 */
    getJobIndustryCategory: function() {
      var that = this;
      GetJobIndustryCategory({
        apptoken: that.state.appToken
      }).then(function(res) {
        that.industryList = res.data;
      });
    },
    /**获取工作经验列表 */
    getUserJobExperienceList: function(p) {
      p = p || 1;
      var that = this;
      GetUserJobExperienceList({
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.experienceList = res.data;
        }
      });
    },
    /**获取公司规模 */
    getJobCompanySize: function() {
      var that = this;
      GetJobCompanySize({
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.sizeList = res.data;
        }
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
    /**保存工作经验 */
    save: function() {
      var that = this;
      var beginDate = "";
      var endDate = "";
      var position = "";
      var industryId = "";
      if (this.form.date.length > 0) {
        beginDate = this.form.date[0].replace(/-/g, "年") + "月";
        endDate = this.form.date[1].replace(/-/g, "年") + "月";
      }
      if (this.form.position != "") {
        position = this.form.posId[0];
      }
      if (this.form.industryid != "") {
        industryId = this.form.indId[0];
      }
      if (this.status == 1) {
        SaveAddUserJobExperience({
          begindate: beginDate,
          enddate: endDate,
          position: position,
          company: this.form.company,
          industryid: industryId,
          scale: this.form.scale,
          description: this.form.description,
          department: this.form.department,
          companyaddress: this.form.companyaddress,
          orderid: this.form.orderid,
          leaving: this.form.leaving,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("添加工作经验成功");
            that.dialogVisible = false;
            that.getUserJobExperienceList();
          } else {
            that.$message.error(res.msg);
          }
        });
      } else if (this.status == 2) {
        SaveModifyUserJobExperience({
          id: this.id,
          begindate: beginDate,
          enddate: endDate,
          position: position,
          company: this.form.company,
          industryid: industryId,
          scale: this.form.scale,
          description: this.form.description,
          department: this.form.department,
          companyaddress: this.form.companyaddress,
          orderid: this.form.orderid,
          leaving: this.form.leaving,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("修改工作经验成功");
            that.dialogVisible = false;
            that.getUserJobExperienceList();
          } else {
            that.$message.error(res.msg);
          }
        });
      }
    },
    /**修改工作经验 */
    modify: function(item) {
      var that = this;
      this.status = 2;
      this.id = item.id;
      this.dialogVisible = true;
      ModifyUserJobExperience({
        id: item.id,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.form = res.data;
          that.form.date = [];
          that.form.indId = [];
          that.form.posId = [];
          that.form.indId[0] = res.data.industryid;
          that.form.posId[0] = res.data.position;
          if (that.form.begindate != "") {
            var str = that.form.begindate.replace(/[^0-9]/gi, "");
            that.form.date[0] = str.slice(0, 4) + "-" + str.slice(4);
          }
          if (that.form.enddate != "") {
            var str = that.form.enddate.replace(/[^0-9]/gi, "");
            that.form.date[1] = str.slice(0, 4) + "-" + str.slice(4);
          }
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**删除工作经验 */
    deleteExperience: function(id) {
      var that = this;
      this.$confirm("确认删除吗？").then(function(_) {
        DeleteUserJobExperience({
          ids: id,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("删除工作经验成功");
            that.getUserJobExperienceList();
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.userInfo = state.userInfo;
      that.state = state;
      that.getUserJobExperienceList();
      that.getJobIndustryCategory();
      that.getJobCompanySize();
      that.getPositionCategory();
    });
  }
};
