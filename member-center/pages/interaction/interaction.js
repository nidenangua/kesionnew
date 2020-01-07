return {
  data: function() {
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      /**列表页数 */
      pageCount: null,
      currentPage: 1,
      /***************************多选框 ****************************/
      /**选中的列表 */
      checkList: [],
      /**全选状态 */
      checkAll: false,
      /**饿了么提供的不确定状态 */
      isIndeterminate: true,
      /**页面显示的列表id集合 */
      list: [],
      /**转换后台需要参数 */
      checkListStr: null,
      /**搜索值 */
      key: "",
      /**选择器数据 */
      type: -1,
      typeList: [],
      solveList: [
        {
          value: -1,
          label: "全部"
        },
        {
          value: 0,
          label: "未解决"
        },
        {
          value: 1,
          label: "已解决"
        }
      ],
      solve: -1,
      /**数据 */
      data: {
        questions_count: 0,
        solve_count: 0,
        solveing_count: 0,
        recommend_count: 0,
        close_count: 0
      },
      /**咨询问答数据 */
      askTopList: [],
      /**问答详情及追问开关 */
      consultationDialogVisible: false,
      /**当前评价 */
      activeComment: 0
    };
  },
  methods: {
    /**复选框回调 */
    handleCheckAllChange: function(val) {
      this.checkList = val ? this.list : [];
      this.checkListStr = this.checkList.join();
      this.isIndeterminate = false;
    },
    /**复选框回调 */
    handleCheckedlistChange: function(value) {
      var checkedCount = value.length;
      this.checkAll = checkedCount === this.list.length;
      this.isIndeterminate =
        checkedCount > 0 && checkedCount < this.list.length;
      this.checkListStr = this.checkList.join();
    },
    /**获取我的问答列表 */
    getUserAskTopList: function(p) {
      p = p || 1;
      this.askTopList = [];
      this.list = [];
      var that = this;
      this.currentPage = p;
      GetUserAskTopList({
        key: this.key,
        page: p,
        pagesize: 10,
        showstatus: this.type == 10000 && this.solve,
        flag: this.type,
        userid: that.userInfo.UserID,
        channelid:this.type,
        mytype:1,
        apptoken: that.state.appToken
      }).then(function(res) {
        that.pageCount = res.pagecount * 10;
        if (res.result == true) {
          that.data = res;
          that.askTopList = res.data;
          var lists = that.askTopList.map(function(item) {
            if (item.issolve != 1) {
              return item.topicid;
            } else {
              return false;
            }
          });

          /**去重 */
          for (var i = 0, len = lists.length; i < len; i++) {
            if (that.list.indexOf(lists[i]) < 0) {
              that.list.push(lists[i]);
            }
          }
          /**去false */
          if (that.list.indexOf(false) != -1) {
            that.list.splice(that.list.indexOf(false), 1);
          }
        }
      });
    },
    /**下拉框搜索框回调 */
    change: function() {
      this.getUserAskTopList();
    },
    /**删除问答 */
    deleteUserConsultation: function(id) {
      var that = this;
      this.$confirm("确定删除吗？").then(function(_) {
        DeleteUserConsultation({
          topicids: id,
          apptoken: that.state.appToken
        }).then(function(res) {
          if (res.result == true) {
            that.$message.success("操作成功");
            that.getUserAskTopList();
            that.checkList = [];
          } else {
            that.$message.error(res.msg);
          }
        });
      });
    },
    /**跳转页面 */
    open: function(url) {
      location.href = url;
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      var modelList = [
        {
          value: -1,
          label: "全部"
        },
        {
          value: 1,
          label: "文章"
        },
        {
          value: 2,
          label: "图片"
        },
        {
          value: 3,
          label: "下载"
        }
      ];
      if (state.model.mall) {
        modelList.push({
          value: 4,
          label: "商城"
        });
      }
      if (state.model.classroom) {
        modelList.push({
          value: 10001,
          label: "班级"
        });
      }
      if (state.model.teacher) {
        modelList.push({
          value: 10003,
          label: "教师"
        });
      }
      if (state.model.ask) {
        modelList.push({
          value: 10000,
          label: "问答"
        });
      }
      if (state.model.edu) {
        modelList.push(
          {
            value: 10004,
            label: "播放页"
          },
          {
            value: 10002,
            label: "课程"
          }
        );
      }
      that.typeList = modelList;
      that.userInfo = state.userInfo;
      that.state = state;
      that.getUserAskTopList();
    });
  }
};
