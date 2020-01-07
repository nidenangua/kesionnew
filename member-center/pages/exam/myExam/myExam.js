return {
  data:function() {
    return {
      state: {},
      allData: {}, //接口数据
      childsClass: null,
      moduleData: null, //模块数据
      showDay: false, //每日一练开关
      url: null //每日一练地址
    };
  },
  watch: {
    "$route.query": function() {
      if (this.$route.name == "MyExam") {
        this.getSubjectStatistics();
      }
    }
  },
  methods: {
    openExam: function(url) {
      //前往每日一练
      var that = this;
      that.$store.ready(function(state) {
        window.open(
          url +
            "#/exam/Exercise?type=6&isrand=0&knowledgeid=0&categoryid=" +
            that.$route.query.categoryid +
            "&schoolid=" +
            state.schoolId,
          "_blank"
        );
      });
    },
    getSubjectStatistics: function() {
      //请求课程的数据
      var that = this;
      that.allData = {};
      // this.$showLoading("#userRight");
      if (localStorage.childsClass) {
        this.childsClass = JSON.parse(localStorage.childsClass);
      } else {
        this.childsClass = null;
      }
      //获取用户学习情况
      GetSubjectStatistics({
        categoryid: this.$route.query.categoryid || 0,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.allData = res.data;
        that.allData.tk_num = parseInt(that.allData.tk_num);
        that.allData.do_num = parseInt(that.allData.do_num);
        that.allData.paper_num = parseInt(that.allData.paper_num);
        that.allData.knowledge_num = parseInt(that.allData.knowledge_num);
        that.allData.user_paper_num = parseInt(that.allData.user_paper_num);
        that.allData.user_knowledge_num = parseInt(
          that.allData.user_knowledge_num
        );
        that.moduleData = res.module;
        that.url = res.get_viewurl;
        for (var i in that.moduleData) {
          if (that.moduleData[i].module_id == 6) {
            that.showDay = true;
          } else {
            that.showDay = false;
          }
        }
      });
    }
  },
  created: function() {
    var that = this;
    that.$store.ready(function(state) {
      
      that.state = state;
      that.getSubjectStatistics();
    });
  },
  activated: function() {}
};
