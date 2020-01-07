return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      /**表单数据 */
      form: {
        status_str: "还没有简历,请填写简历",
        audition_total: 0,
        look_total: 0,
        eplook_total: 0,
        audition_total: 0,
        basicinfo_status: "未完成",
        educate_status: "未完成",
        training_status: "未完成",
        experience_status: "未完成",
        uploadphoto_status: "未完成",
        jobintension_status: "未完成",
        resume_hits: 0
      },
      /**页数 */
      pageCount: null,
      /**会话框 */
      dialogVisible: false,
      /**1添加，2修改 */
      status: 0,
      /**列表id */
      id: "",
      /***保密设置 */
      passData: {},
      dataList: []
    };
  },
  methods: {
    /**选择框回调 */
    handleChange: function() {},
    /**获取简历状态信息 */
    getUserJobResumeStatus: function() {
      var that = this;
      GetUserJobResumeStatus({
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.form = res.data;
        }
      });
    },
    /**页面跳转 */
    open: function(name) {
      this.$router.push({
        name: name
      });
    },
    /**获取保密设置 */
    setPass: function() {
      var that = this;
      this.dialogVisible = true;
      ModifyUserResumeStatus({
        id: this.form.id,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.passData = res.data;
        }
      });
    },
    /**保存保密设置 */
    savePass: function() {
      var that = this;
      that.dialogVisible = false;
      SaveUserResumeStatus({
        id: this.passData.id,
        photostatus: this.passData.photo_status,
        contactstatus: this.passData.contact_status,
        resumestatus: this.passData.resume_status,
        idcardstatus: this.passData.idcard_status,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.$message.success("设置成功");
          that.getUserJobResumeStatus();
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**简历刷新 */
    refresh: function() {
      var that = this;
      GetUserJobRefreshResume({
        id: this.form.id,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.$message.success("刷新成功");
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**跳出页面 */
    openView: function(url) {
      location.href = url;
    },
    /**获取推荐职位列表 */
    getUserJobRecommendList: function() {
      var that = this;
      GetUserJobIntensionList({
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.dataList = res.data;
        }
      });
    },
    /**收藏职位 */
    collect: function(item) {
      var that = this;
      DoUserJobCollect({
        id: item.id,
        username: item.inputer,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.$message.success("收藏成功");
        } else {
          that.$message.error(res.msg);
        }
      });
    }
  },
  activated: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.userInfo = state.userInfo;
      that.state = state;
      that.getUserJobResumeStatus();
      that.getUserJobRecommendList();
    });
  }
};
