return {
  data: function() {
    return {
      state: {},
      dialogVisible: false,
      title: "",
      data: {},
      url: ""
    };
  },
  methods: {
    /**打开二维码会话框 */
    openDialog: function(index) {
      if (index == 0) {
        this.title = "推荐用户注册";
        this.url = this.data.tuiguang;
      } else if (index == 1) {
        this.title = "课程分销";
        this.url = this.data.user;
      } else {
        this.title = "分享课程";
        this.url = this.data.share;
      }
      this.dialogVisible = true;
    },
    getQrcode: function() {
      var that = this;
      GetQrcode({
        apptoken: this.state.appToken
      }).then(function(res) {
        that.data = res;
      });
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.state = state;
      that.getQrcode();
    });
  }
};
