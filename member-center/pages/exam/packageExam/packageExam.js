return {
  data:function() {
    return {
      state: {},
      showList: true, //内容列表开关
      showNodata: false, //无内容提示页面开关
      typeData: null, //套卷分类导航数据
      typeId: 0, //套卷分类id
      showSort: false, //做题顺序开关
      allData: [], //接口数据
      childsclass: null, //二级菜单分类
      onshow: false, //切换课程页面开关
      pageCount: null, //总页数
      paperId: null, //试卷id
      get_viewurl: null, //试卷链接地址
      schoolid: store.state.schoolId, //学校机构id
      currentPage: 1
    };
  },
  watch: {
    "$route.query": function(query) {
      if (this.$route.name == "PackageExam") {
        this.getPaperList();
      }
    }
  },
  methods: {
    slideTab: function(id) {
      this.typeId = id;
      this.getPaperList();
    },
    openExam: function(id, url) {
      //前往试卷进行考试
      var that = this;
      this.$store.ready(function(state) {
        window.open(
          url,
          "_blank"
        );
      });
    },
    againExam: function(id, url) {
      //继续考试
      var that = this;
      this.$store.ready(function(state) {
        window.open(
          url,
          "_blank"
        );
      });
    },
    openSort: function(id, url) {
      //打开选择考试顺序
      this.showSort = true;
      this.paperId = id;
      this.get_viewurl = url;
    },
    closeSort: function() {
      //关闭考试选择显示
      this.showSort = false;
    },
    getPaperList: function(p) {
      p = p || 1;
      var that = this;
      this.currentPage = p;
      //获取套卷练习分类名称
      GetAllPaperType({
        categoryid: this.$route.query.categoryid,
        schoolid: that.state.schoolId,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.typeData = res.data;

        that.onshow = false;

        if (localStorage.childsclass) {
          that.childsclass = JSON.parse(localStorage.childsclass);
        } else {
          that.childsclass = null;
        }
        that.allData = [];
        //获取套卷练习数据
        GetPaperList({
          categoryid: that.$route.query.categoryid,
          typeid: that.typeId,
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
      });
    }
  },
  created: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.state = state;
      that.getPaperList();
    });
  }
};
