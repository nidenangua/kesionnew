return {
  data: function() {
    return {
      state: {},
      /**列表页详情页切换开关 */
      listFalg: true,
      /**搜索关键字 */
      key: "",
      /**排序选择器选项 */
      sortList: [
        {
          value: "b.LastDate Desc",
          label: "按学习时间"
        },
        {
          value: "b.addDate Desc",
          label: "按更新时间"
        }
      ],
      /**选择器默认值 */
      sort: "b.LastDate Desc",
      /**来源选择器选项 */
      fromList: [
        {
          value: -1,
          label: "全部"
        },
        {
          value: 0,
          label: "未通过"
        },
        {
          value: 1,
          label: "已通过"
        }
      ],
      /**选择器默认值 */
      from: -1,
      /**班级列表数据 */
      classList: [],
      /**详情数据 */
      /**作业列表 */
      homeworkList: [],
      /**课程列表 */
      courseList: [],
      /**训练营列表 */
      trainList: [],
      /**问答列表 */
      askList: [],
      /**公告列表 */
      noticeList: [],
      /**班级详情 */
      classInfo: [],
      /**当前选中项 */
      activeName: "first",
      /**选中营期序号 */
      swiperNum: 0,
      /**定位 */
      mlCount: 0,
      /**营期列表 */
      campList: [],
      /**选中营期详情 */
      campDetail: {},
      itemList: [],
      /**总页数 */
      pageCount: null,
      /**当前页 */
      currentPage: 1,
      /**训练营详情数据 */
      initDetailData: {},
      /**训练营id */
      trainId: 0
    };
  },
  methods: {
    /**选择器的回调 */
    changeSelect: function() {
      this.getUserTrainList();
    },
    /**搜索框的回调 */
    changeInput: function() {
      this.getUserTrainList();
    },
    /**定位 */
    slideSwiper: function(i, item) {
      if (i > 4) {
        this.mlCount = 4 - i;
      } else {
        this.mlCount = 0;
      }
      this.swiperNum = i;
      this.getUserCampDetail(item.campid);
    },
    /**标签页点击回调 */
    handleClick: function(tab, event) {
      var that = this;
    },
    /**跳转页面
     * @params string
     */
    open: function(url) {
      window.open(url);
    },
    /**请求训练营列表数据
     * @params p页数
     */
    getUserTrainList: function(p) {
      p = p || 1;
      var that = this;
      // this.$showLoading("#userRight");
      that.trainList = [];
      this.currentPage = p;
      GetUserTrainList({
        showstatus: that.from,
        orderfield: that.sort,
        key: that.key,
        page: p,
        pagesize: 10,
        apptoken: this.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.trainList = res.data;
          /**如果只有一个训练营，直接进入详情 */
          if (that.trainList.length == 1) {
            that.listFalg = false;
            that.getUserTrainDetail(that.trainList[0]);
          }
        } else {
        }
      });
    },
    /**打开详情页并且请求详情页数据
     * @params item object 要打开的详情项
     */
    openDetail: function(item) {
      var that = this;
      that.listFalg = false;
      that.getUserTrainDetail(item);
    },
    /**训练营详情页数据 */
    getUserTrainDetail: function(item) {
      var that = this;
      that.trainId = item.courseid;
      GetUserTrainDetail({
        trainid: that.trainId,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.initDetailData = res.data;
          that.campList = res.data.camplist;
          that.getUserCampDetail(that.campList[0].campid);
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**营期详情 */
    getUserCampDetail: function(subId) {
      var that = this;
      GetUserCampDetail({
        trainid: that.trainId,
        campid: subId,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.campDetail = res.data;
        } else {
          that.$message.error(res.msg);
        }
      });
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.state = state;
      that.getUserTrainList();
    });
  }
};
