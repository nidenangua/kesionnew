return {
  data: function() {
    return {
      state: {},
      allData: {},
      /**默认显示tab */
      activeName: "first",
      /**图表的数据 */
      grid: {
        top: "40px",
        bottom: "11%",
        left: "10%",
        right: "17%"
      },
      /**最近学习列表 */
      learnList: [],
      /**最近直播日期 */
      dayList: [],
      /**参数 */
      day: "",
      activeDay: 0,
      /**直播列表 */
      liveList: [],
      /**未读消息 */
      msgList: [],
      /**学习详情 */
      learnInfo: {},
      group: false,
      activity: false,
      exam: false
    };
  },
  methods: {
    handleClick: function(tab, event) {
      console.log(tab, event);
    },
    /**点击我知道了不再提醒 */
    setRead: function(item) {
      var that = this;
      DoUserSiteMsg({
        actiontype: 0,
        do: "readtf",
        ids: item.id,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.$message.success("操作成功");
          that.getUserHome();
        } else {
          that.$message.error(res.msg);
        }
      });
    },
    /**最近学习数据 */
    getUserHome: function() {
      var that = this;
      GetUserHome({
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.learnList = res.data.learn_course;
          that.learnList.map(function(item) {
            item.has_learnpercent = parseFloat(item.has_learnpercent);
          });
          that.learnInfo = res.data.learn_info;
          that.msgList = res.data.message_info.list;
          that.dayList = res.data.week_date;
          for (var i = 0; i < that.dayList.length; i++) {
            if (that.dayList[i].checked) {
              that.activeDay = i;
              that.day = that.dayList[i].day;
            }
          }
        } else {
          that.$message.error(res.msg);
        }

        that.getUserHomeCosLive();
      });
    },
    /**跳转页面 */
    open: function(url) {
      location.href = url;
    },
    /**打开页面 */
    openView: function(url) {
      this.$router.push(url);
    },
    /**打开考试 */
    openExam: function(url) {
      if (localStorage["id_" + this.state.userId]) {
        this.$router.push({
          path: url,
          query: {
            categoryid: localStorage["id_" + this.state.userId]
          }
        });
      } else {
        this.$router.push({
          name: "ExamCategory"
        });
      }
    },
    /**直播课表数据 */
    getUserHomeCosLive: function() {
      var that = this;
      this.liveList = [];
      GetUserHomeCosLive({
        day: that.day,
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.liveList = res.data;
        }
      });
    },
    /**切换课表 */
    changeDay: function(item, index) {
      this.activeDay = index;
      this.day = item.day;
      this.getUserHomeCosLive();
    },

    /**未读消息 */
    openMsg: function() {
      var that = this;
      this.$router.push("user/message");
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.state = state;
      if (state.model.exam) {
        that.exam = true;
      }
      if (state.model.activity) {
        that.activity = true;
      }
      if (state.model.group) {
        that.group = true;
      }
      that.getUserHome();
    });
  }
};
