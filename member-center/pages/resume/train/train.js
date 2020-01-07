return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      /**表单数据 */
      form: {
        /**需要转换的参数，日期 */
        date: []
      },
      /**培训经历列表 */
      TrainingList: [],
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
    /**获取培训经历列表 */
    getUserJobTrainingList: function(p) {
      p = p || 1;
      var that = this;
      that.TrainingList = [];
      GetUserJobTrainingList({
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.TrainingList = res.data;
        }
      });
    },
    /**保存培训经历 */
    save: function() {
      var that = this;
      var beginDate = "";
      var endDate = "";
      var majorId = "";
      if (this.form.date.length > 0) {
        beginDate = this.form.date[0].replace(/-/g, "年") + "月";
        endDate = this.form.date[1].replace(/-/g, "年") + "月";
      }
      this.dialogVisible = false;
      if (this.status == 1) {
        SaveAddUserJobTraining({
          begindate: beginDate,
          enddate: endDate,
          training: this.form.training,
          title: this.form.title,
          certificate: this.form.certificate,
          orderid: this.form.orderid,
          apptoken: that.state.appToken
        }).then(function(res) {
          console.log(res);
          if (res.result == true) {
            that.$message.success("添加培训经历成功");
            that.dialogVisible = false;
            that.getUserJobTrainingList();
          } else {
            that.$message.error(res.msg);
          }
        });
      } else if (this.status == 2) {
        SaveModifyUserJobTraining({
          id: this.id,
          begindate: beginDate,
          enddate: endDate,
          training: this.form.training,
          title: this.form.title,
          certificate: this.form.certificate,
          orderid: this.form.orderid,
          apptoken: that.state.appToken
        }).then(function(res) {
          console.log(res);
          if (res.result == true) {
            that.$message.success("修改培训经历成功");
            that.dialogVisible = false;
            that.getUserJobTrainingList();
          } else {
            that.$message.error(res.msg);
          }
        });
      }
    },
    /**修改培训经历 */
    modify: function(item) {
      var that = this;
      this.status = 2;
      this.id = item.id;
      this.dialogVisible = true;
      ModifyUserJobTraining({
        id: item.id,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.form = res.data;
          that.form.date = [];
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
    /**删除培训经历 */
    deleteTraining: function(id) {
      var that = this;
      this.$confirm("确认删除吗？").then(function(_) {
        DeleteUserJobTraining({
          ids: id,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("删除培训经历成功");
            that.getUserJobTrainingList();
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
      that.getUserJobTrainingList();
    });
  }
};
