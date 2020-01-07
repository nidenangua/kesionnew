return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      /**表单数据 */
      form: {
        /**需要转换的参数，专业id，日期，学历id */
        majorId: [],
        date: []
      },
      /**学历列表 */
      educationList: [],
      /**专业列表 */
      majorList: [],
      /**公司规模 */
      sizeList: [],
      /**教育背景列表 */
      backgroundList: [],
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
    /**获取教育背景列表 */
    getUserJobBackgroundList: function(p) {
      p = p || 1;
      var that = this;
      that.backgroundList = [];
      GetUserJobBackgroundList({
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.backgroundList = res.data;
        }
      });
    },

    /**获取专业类别 */
    getJobMajor: function() {
      var that = this;
      GetJobMajor({
        apptoken: that.state.appToken
      }).then(function(res) {
        that.majorList = res.data;
      });
    },
    /**获取学历类别 */
    getJobEducation: function() {
      var that = this;
      GetJobEducation({
        apptoken: that.state.appToken
      }).then(function(res) {
        that.educationList = res.data;
      });
    },
    /**保存教育背景 */
    save: function() {
      var that = this;
      var beginDate = "";
      var endDate = "";
      var majorId = [];
      if (this.form.date.length > 0) {
        beginDate = this.form.date[0].replace(/-/g, "年") + "月";
        endDate = this.form.date[1].replace(/-/g, "年") + "月";
      }
      if (this.form.majorId.length) {
        majorId = this.form.majorId[this.form.majorId.length - 1];
      }

      this.dialogVisible = false;
      if (this.status == 1) {
        SaveAddUserJobBackground({
          begindate: beginDate,
          enddate: endDate,
          professionaltype: majorId,
          professional: this.form.professional,
          school: this.form.school,
          qualifications: this.form.qualifications,
          schooladdress: this.form.schooladdress,
          certificate: this.form.certificate,
          orderid: this.form.orderid,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("添加教育背景成功");
            that.dialogVisible = false;
            that.getUserJobBackgroundList();
          } else {
            that.$message.error(res.msg);
          }
        });
      } else if (this.status == 2) {
        SaveModifyUserJobBackground({
          id: this.id,
          begindate: beginDate,
          enddate: endDate,
          professionaltype: majorId,
          professional: this.form.professional,
          school: this.form.school,
          qualifications: this.form.qualifications,
          schooladdress: this.form.schooladdress,
          certificate: this.form.certificate,
          orderid: this.form.orderid,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("修改教育背景成功");
            that.dialogVisible = false;
            that.getUserJobBackgroundList();
          } else {
            that.$message.error(res.msg);
          }
        });
      }
    },
    /**修改教育背景 */
    modify: function(item) {
      var that = this;
      this.status = 2;
      this.id = item.id;
      this.dialogVisible = true;
      ModifyUserJobBackground({
        id: item.id,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.form = res.data;
          that.form.date = [];
          that.form.majorId = res.data.professionaltype;
          that.form.educationId = res.data.qualifications;
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
    /**删除教育背景 */
    deleteBackground: function(id) {
      var that = this;
      this.$confirm("确认删除吗？").then(function(_) {
        DeleteUserJobBackground({
          ids: id,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("删除教育背景成功");
            that.getUserJobBackgroundList();
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
      that.getUserJobBackgroundList();
      that.getJobMajor();
      that.getJobEducation();
    });
  }
};
