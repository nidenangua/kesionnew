return {
  data:function() {
    return {
      state: {},
      showSort: false, //显示考试顺序选择页面
      onshow: false, //显示切换考试页面
      allData: null, //所有数据
      allDataList: [], //所有错题列表
      childsclass: null, //切换考试二级菜单列表
      /*type 1题库练习2错题练习,3收藏练习，4章节练习，5知识点练习*/
      type: null,
      /* get_viewurl*/
      url: null,
      schoolid: store.state.schoolId, //学校机构id
      tktype: null //题型分类
    };
  },
  watch: {
    "$route.query": function() {
      if (this.$route.name == "ErrorBank") {
        this.errorTkHome();
      }
    }
  },
  methods: {
    openExam: function(isrand) {
      //前往试卷进行考试
      var that = this;
      this.$store.ready(function(state) {
        window.open(
          that.url +
            "#/exam/Exercise?type=2&categoryid=" +
            that.$route.query.categoryid +
            "&schoolid=" +
            that.state.schoolId +
            "&isrand=" +
            isrand +
            "&tktype=" +
            that.tktype,
          "_blank"
        );
      });
    },
    openSort: function(url, type) {
      //显示选择考试顺序
      this.url = url;
      this.tktype = type;
      this.showSort = true;
    },
    closeSort: function() {
      //关闭选择考试顺序
      this.showSort = false;
    },
    showmenu: function() {
      //显示切换考试二级菜单栏
      this.onshow = true;
    },
    closemenu: function() {
      this.onshow = false;
    }, //关闭切换考试二级菜单栏
    errorTkHome: function() {
      //请求错题页面数据
      var that = this;
      this.onshow = false;
      if (localStorage.childsclass) {
        this.childsclass = JSON.parse(localStorage.childsclass);
      } else {
        this.childsclass = null;
      }
      ErrorTkHome({
        categoryid: this.$route.query.categoryid,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.allData = res.data;
        }
      }),
        GetCountErrorTk({
          //请求错题列表数据
          categoryid: this.$route.query.categoryid,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.allDataList = res.data;
          }
        });
    }
  },

  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.state = state;
      that.errorTkHome();
    });
  }
};
