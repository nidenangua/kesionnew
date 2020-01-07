var store = new Vuex.Store({
  state: {
    /**
     * 会员状态
     */
    userReady: false,
    isLogin: -1, // 0未登录 1已登录
    userInfo: {},
    appToken: "",
    userId: "",
    schoolId: "",
    model: [],
	version:''
  },
  mutations: {
    /**
     * 设置单个状态
     */
    setState: function(state, data) {
      state[data.key] = data.value;
    }
  },
  actions: {
    /**
     * 更新会员信息
     */
    updateUserInfo: function(store) {
      return new Promise(function(resolve) {
        store.commit("setState", {
          key: "userReady",
          value: false
        });
        UserLogin().then(function(res) {
          if (res.islogin === "true") {
            store.commit("setState", {
              key: "model",
              value: res.model
            });
			store.commit("setState", {
			  key: "version",
			  value: res.version
			});
            var rand = Math.ceil(Math.random() * 10000000000);
            res.headimg = res.headimg + "?" + rand;
            GetUserInfo({
              userid: res.userid
            }).then(function(data) {
              store.commit("setState", {
                key: "userInfo",
                value: data.data[0]
              });

              store.commit("setState", {
                key: "isLogin",
                value: 1
              });
              store.commit("setState", {
                key: "userId",
                value: res.userid
              });
              store.commit("setState", {
                key: "schoolId",
                value: res.schoolid
              });
              store.commit("setState", {
                key: "appToken",
                value: res.apptoken
              });
              store.commit("setState", {
                key: "userReady",
                value: true
              });
            });
          } else {
            /**
             * 未登录
             */
            store.commit("setState", {
              key: "isLogin",
              value: 0
            });
            store.commit("setState", {
              key: "userInfo",
              value: {}
            });
          }

          resolve(res);
        });
      });
    }
  }
});

/**
 * 添加ready事件
 */
store.ready = function(callback) {
  var that = this;
  if (this.state.userReady) {
    callback(that.state);
  } else {
    setTimeout(function() {
      that.ready(callback);
    }, 100);
  }
};

store.dispatch("updateUserInfo");
