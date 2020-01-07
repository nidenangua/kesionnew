return {
  data: function() {
    return {
      state: {},
      showList: true, //显示内容开关
      showNodata: false, //无内容提示开关
      allData: [], //全部数据列表
      onshow: false, //切换考试显示开关
      pageCount: null, //总页面数
      childsclass: null, //切换考试二级分类
      page: 1
    };
  },
  watch: {
    "$route.query": function() {
      if (this.$route.name == "PracticeRecord") {
        this.getTestRecordList();
      }
    }
  },
  methods: {
    openExam: function(url, type, isrand, sectionid, knowledgeid) {
      //前往试卷进行考试
      var that = this;
      this.$store.ready(function(state) {
        window.open(
          url +
            "#/exam/Exercise?type=" +
            type +
            "&categoryid=" +
            that.$route.query.categoryid +
            "&schoolid=" +
            that.state.schoolId +
            "&isrand=" +
            isrand +
            "&sectionid=" +
            sectionid +
            "&knowledgeid=" +
            knowledgeid,
          "_blank"
        );
      });
    },
    showmenu: function() {
      //显示切换考试开关
      this.onshow = true;
    },
    closemenu: function() {
      this.onshow = false;
    }, //关闭切换考试开关
    openAnswer: function(url, id, title, tknum, time, donum) {
      //查看解析

      window.open(
        url +
          "#/exam/ParsingPage?type=2&id=" +
          id +
          "&categoryid=" +
          this.$route.query.categoryid +
          "&title=" +
          title +
          "&tknum=" +
          tknum +
          "&answertime=" +
          time +
          "&dtnum=" +
          donum,
        "_blank"
      );
    },
    deletePaperTest: function(id) {
      //删除练习记录
      var that = this;
      DeletePaperTest({
        ids: id,
        categoryid: this.$route.query.categoryid,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.getTestRecordList(this.page);
      });
    },
    getTestRecordList: function(p) {
      p = p || 1;
      //请求接口数据
      var that = this;
      this.page = p;
      this.onshow = false;
      if (localStorage.childsclass) {
        this.childsclass = JSON.parse(localStorage.childsclass);
      } else {
        this.childsclass = null;
      }
      GetTestRecordList({
        sectionid: 1,
        categoryid: this.$route.query.categoryid,
        page: p,
        pagesize: 5,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.allData = res.data;
          that.pageCount = res.pagecount * 10;
          that.showList = true;
          that.showNodata = false;
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
      that.getTestRecordList();
    });
  }
};
