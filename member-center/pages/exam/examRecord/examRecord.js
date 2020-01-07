return {
  data:function() {
    return {
      state: {},
      showNodata: false, //无内容提示开关
      showList: true, //显示内容开关
      allData: [], //全部数据
      pageCount: null, //总页面数
      childsclass: null, //切换考试二级分类数据
      onshow: false, //切换开始显示开关
      page: 1,
      currentPage: 1
    };
  },
  watch: {
    "$route.query": function() {
      if (this.$route.name == "ExamRecord") {
        this.getPaperRecordList();
      }
    }
  },
  methods: {
    openExam: function(id, url) {
      //前往试卷进行考试
      var that = this;
      this.$store.ready(function(state) {
        window.open(
          url +
            "#/exam/PaperInfo?paperid=" +
            id +
            "&categoryid=" +
            that.$route.query.categoryid +
            "&schoolid=" +
            state.schoolId,
          "_blank"
        );
      });
    },
    againExam: function(id, url) {
      //继续考试
      var that = this;
      this.$store.ready(function(state) {
        window.open(
          url +
            "#/exam/TestPage?paperid=" +
            id +
            "&categoryid=" +
            that.$route.query.categoryid +
            "&schoolid=" +
            state.schoolId,
          "_blank"
        );
      });
    },
    openAnswer: function(url, id, title, dtnum, time, xtnum, paperid, score) {
      //查看解析
      window.open(
        url +
          "#/exam/ParsingPage?type=1&id=" +
          id +
          "&categoryid=" +
          this.$route.query.categoryid +
          "&title=" +
          title +
          "&tknum=" +
          xtnum +
          "&answertime=" +
          time +
          "&dtnum=" +
          dtnum +
          "&paperid=" +
          paperid +
          "&sumscore=" +
          score,
        "_blank"
      );
    },
    showmenu: function() {
      //显示切换考试菜单栏
      this.onshow = true;
    },
    closemenu: function() {
      this.onshow = false;
    }, //关闭切换考试菜单栏
    deletePaperRecord: function(id) {
      //删除考试记录
      var that = this;
      DeletePaperRecord({
        ids: id,
        categoryid: this.$route.query.categoryid,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.getPaperRecordList(this.page);
      });
    },
    getPaperRecordList: function(p) {
      p = p || 1;
      //获取考试记录
      var that = this;
      this.page = p;
      this.currentPage = p;
      if (localStorage.childsclass) {
        this.childsclass = JSON.parse(localStorage.childsclass);
      } else {
        this.childsclass = null;
      }
      GetPaperRecordList({
        categoryid: this.$route.query.categoryid,
        page: p,
        pagesize: 5,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.allData = res.data;
          that.pageCount = res.pagecount * 10;
          that.showNodata = false;
          that.showList = true;
        } else {
          that.showList = false;
          that.showNodata = true;
        }
      });
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.state = state;
      that.getPaperRecordList();
    });
  }
};
