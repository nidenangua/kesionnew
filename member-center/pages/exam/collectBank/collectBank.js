return {
  data:function() {
    return {
      state: {},
      showSort: false, //显示考试顺序开关
      onshow: false, //显示切换考试分类开关
      allData: null, //所有数据
      allDataList: [], //所有列表数据
      url: null, //链接地址
      schoolid: store.state.schoolid, //学校机构id
      tktype: null //题型分类
    };
  },
  watch: {
    "$route.query": function() {
      if (this.$route.name == "CollectBank") {
        this.collectTkHome();
      }
    }
  },
  methods: {
    openExam: function(isrand) {
      var that = this;
      //前往试卷进行考试
      this.$store.ready(function(state) {
        window.open(
          that.url +
            "#/exam/Exercise?type=3&categoryid=" +
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
      //显示切换考试分类页面
      this.onshow = true;
    },
    closemenu: function() {
      this.onshow = false;
    }, //关闭切换考试分类页面
    collectTkHome: function() {
      //请求数据
      var that = this;
      this.onshow = false;
      if (localStorage.childsclass) {
        this.childsclass = JSON.parse(localStorage.childsclass);
      } else {
        this.childsclass = null;
      }
      CollectTkHome({
        //请求所有数据
        categoryid: this.$route.query.categoryid,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.allData = res.data;
        }
      }),
        GetCountCollectTk({
          //请求所有列表数据
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
      that.collectTkHome();
    });
  }
};
