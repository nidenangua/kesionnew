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
      /**班级列表数据 */
      classList: [],
      /**详情数据 */
      /**作业列表 */
      homeworkList: [],
      /**课程列表 */
      courseList: [],
      coursefacelist: [],
      /**训练营列表 */
      trainList: [],
      /**问答列表 */
      askList: [],
      /**公告列表 */
      noticeList: [],
      /**班级详情 */
      classInfo: {},
      /**当前选中项 */
      activeName: "first",
      activeCourse: 0,
      /**总页数 */
      pageCount: null,
      /**当前页 */
      currentPage: 1,
      /**公告详情显示开关 */
      noticeDialogVisible: false,
      /**公告详情 */
      noticeDetail: {},
      /**作业详情开关 */
      homeworkDialogVisible: false,
      /**作业详情 */
      homeworkDetail: {}
    };
  },
  methods: {
    /**选择器的回调 */
    changeSelect: function() {
      this.getUserClassList();
    },
    /**搜索框的回调 */
    changeInput: function() {
      this.getUserClassList();
    },
    /**标签页点击回调 */
    handleClick: function(tab, event) {
      var that = this;
    },
    /**请求班级列表数据
     * @params p页数
     */
    getUserClassList: function(p) {
      p = p || 1;
      // this.$showLoading("#userRight");
      var that = this;
      that.classList = [];
      that.currentPage = p;
      GetUserClassList({
        orderfield: that.sort,
        key: that.key,
        page: p,
        pagesize: 10,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        // that.$hideLoading("#userRight");
        if (res.result == true) {
          that.classList = res.data;
          /**如果只有一个班级，直接进入详情 */
          if (that.classList.length == 1) {
            that.listFalg = false;
            that.getUserClassDetail(that.classList[0]);
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
      that.getUserClassDetail(item);
    },
    /**打开外链
     * @params
     */
    openView: function(url) {
      //location.href = url;
      window.open(url);
    },
    /**请求详情页数据 */
    getUserClassDetail: function(item) {
      // this.$showLoading("#userRight");
      var that = this;
      GetUserClassDetail({
        roomid: item.roomid,
        apptoken: that.state.appToken
      }).then(function(res) {
        // that.$hideLoading("#userRight");
        if (res.result == true) {
          that.classInfo = res.data.room_info;
          that.homeworkList = res.data.homework_List;
          that.courseList = res.data.course_list;
          that.coursefacelist = res.data.courseface_list;
          that.trainList = res.data.train_list;
          that.noticeList = res.data.notice_list;
          that.askList = res.data.ask_list;
        }
      });
    },
    /**下载附件 */
    downloadFile: function(url, id) {
      this.oDownLoad(url, id);
    },
    myBrowser: function() {
      var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
      var isOpera = userAgent.indexOf("Opera") > -1;
      if (isOpera) {
        return "Opera";
      } //判断是否Opera浏览器
      if (userAgent.indexOf("Firefox") > -1) {
        return "FF";
      } //判断是否Firefox浏览器
      if (userAgent.indexOf("Chrome") > -1) {
        return "Chrome";
      }
      if (userAgent.indexOf("Safari") > -1) {
        return "Safari";
      } //判断是否Safari浏览器
      if (
        userAgent.indexOf("compatible") > -1 &&
        userAgent.indexOf("MSIE") > -1 &&
        !isOpera
      ) {
        return "IE";
      } //判断是否IE浏览器
      if (userAgent.indexOf("Trident") > -1) {
        return "Edge";
      } //判断是否Edge浏览器
    },
    oDownLoad: function(url, id) {
      if (this.myBrowser() === "IE" || this.myBrowser() === "Edge") {
        var oPop = window.open(
          url,
          "",
          "width=1, height=1, top=5000, left=5000"
        );
        for (; oPop.document.readyState != "complete"; ) {
          if (oPop.document.readyState == "complete") break;
        }
        oPop.document.execCommand("SaveAs");
        oPop.close();
      } else {
        //!IE

        var odownLoad = document.getElementById(id);

        odownLoad.href = url;
        odownLoad.download = this.homeworkDetail.title;
      }
    },
    /**打开公告 */
    openNotice: function(item) {
      this.noticeDialogVisible = true;
      this.noticeDetail = item;
    },
    /**打开作业 */
    openHomework: function(item) {
      this.homeworkDialogVisible = true;
      this.homeworkDetail = item;
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.state = state;
      that.getUserClassList();
    });
  }
};
