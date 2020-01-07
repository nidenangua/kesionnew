return {
  data:function() {
    return {
      state: {},
      name: null, //
      active: 0, //当前样式
      showMenu: false, //显示二级菜单栏
      onshow: false, //显示切换课程页面开关
      url: null, //跳转链接
      showSub: null, //显示二级分类
      showSub2: null, //显示三级分类
      allData: [], //全部数据列表
      showSort: false, //考试顺序开关
      sectionId: null, //章节id
      knowledge: null, //知识点开关
      chaper: null, //章节开关
      schoolid: store.state.schoolId, //学校机构id
      knowledgeNodata: true, //知识点无内容提示
      chaperNodata: false //章节无内容提示
    };
  },
  watch: {
    "$route.query": function() {
      if (this.$route.name == "Practice") {
        this.active = 0;
        this.getSubjectStatistics();
        this.getPaperSection();
        this.getPaperKnowledge();
      }
    }
  },
  methods: {
    nav: function(i) {
      this.active = i;
    },
    /*
     * 章节、知识点开关
     * */
    toggle: function(chaper, knowledge) {
      this.chaper = chaper;
      this.knowledge = knowledge;
    },
    openExamAll: function(isrand) {
      var that = this;
      //前往全部试卷进行考试
      this.$store.ready(function(state) {
        window.open(
          that.url+"#/exam/Exercise?type=1&categoryid=" +
            that.$route.query.categoryid +
            "&schoolid=" +
            state.schoolId +
            "&isrand=" +
            isrand,
          "_blank"
        );
      });
    },
    openExam: function(isrand) {
      var that = this;
      //前往试卷进行考试
      this.showSort = false;
      if (this.active == 0) {
        this.$store.ready(function(state) {
          window.open(
            that.url+"#/exam/Exercise?type=4&categoryid=" +
              that.$route.query.categoryid +
              "&schoolid=" +
              that.state.schoolId +
              "&isrand=" +
              isrand +
              "&sectionid=" +
              that.sectionId,
            "_blank"
          );
        });
      } else {
        this.$store.ready(function(state) {
          window.open(
            that.url+"#/exam/Exercise?type=5&categoryid=" +
              that.$route.query.categoryid +
              "&schoolid=" +
              that.state.schoolId +
              "&isrand=" +
              isrand +
              "&knowledgeid=" +
              that.sectionId,
            "_blank"
          );
        });
      }
    },
    openSort: function(id) {
      //显示选择考试顺序
      this.sectionId = id;
      this.showSort = true;
    },
    closeSort: function() {
      //关闭选择考试顺序
      this.showSort = false;
    },
    openSub: function(i) {
      //打开二级试卷
      if (this.showSub == i) {
        this.showSub = null;
      } else {
        this.showSub = i;
      }
    },
    openSub2: function(n) {
      //打开三级试卷
      if (this.showSub2 == n) {
        this.showSub2 = null;
      } else {
        this.showSub2 = n;
      }
    },
    change: function() {
      //切换课程重新请求更新数据
      this.getPaperSection();
      this.getPaperKnowledge();
    },
    showmenu: function() {
      //显示切换考试菜单
      this.onshow = true;
    },
    closemenu: function() {
      this.onshow = false;
    }, //关闭切换考试菜单
    getPaperSection: function() {
      //请求章节数据
      var that = this;
      this.onshow = false;
      if (localStorage.childsClass) {
        this.childsClass = JSON.parse(localStorage.childsClass);
      } else {
        this.childsClass = null;
      }
      GetPaperSection({
        categoryid: this.$route.query.categoryid,
        userid: that.state.userId,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.allData = res.data;
          that.url = res.get_viewurl;
        } else {
          that.allData = null;
        }
      });
    },
    getPaperKnowledge: function() {
      var that = this;
      this.knowledgeList = [];
      this.onshow = false;
      if (localStorage.childsClass) {
        this.childsClass = JSON.parse(localStorage.childsClass);
      } else {
        this.childsClass = null;
      }
      GetPaperKnowledge({
        categoryid: this.$route.query.categoryid,
        userid: that.state.userId,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.knowledgeList = res.data;
          that.url = res.get_viewurl;
        } else {
          that.knowledgeList = [];
        }
      });
    },
    /*获取模块数据 **/
    getSubjectStatistics: function() {
      var that = this;
      GetSubjectStatistics({
        categoryid: that.$route.query.categoryid,
        apptoken: that.state.appToken
      }).then(function(res) {
		  that.url = res.get_viewurl
        for (var i in res.module) {
          if (res.module[i].module_id == "0") {
            that.chaper = res.module[i].isopen_chaper;
            that.knowledge = res.module[i].isopen_knowledge;
          }
        }
      });
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {

      that.state = state;
      that.getSubjectStatistics();
      that.getPaperSection();
      that.getPaperKnowledge();
    });
  }
};
