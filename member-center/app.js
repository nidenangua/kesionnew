(function() {
    /**
     * 请求文件
     * @param {String} 相对路径
     */
    var styles = {};

    function require(path, name, del) {
      return new Promise(function (resolve) {
        if (del == undefined) {
          del = true;
        } else {
          del = false;
        }

        var hash = Math.ceil(Math.random() * 9999999999);
        axios.get(path + '.html?' + hash).then(function (html) {
          axios.get(path + '.css?' + hash).then(function (css) {
            var style = document.createElement('style');
            var textNode = document.createTextNode(css.data);
            style.appendChild(textNode);

            if (del == true) {
              style.className = 'route-page-style';
              style.id = name;
              styles[name] = style;
            }

            document.head.appendChild(style);
          });
          axios.get(path + '.js?' + hash).then(function (js) {
            var page = new Function(js.data)();
            page.template = html.data;
            resolve(page);
          });
        });
      });
    }
    /**定义 (路由) 组件 */


    var routes = [{
      /**我的首页 */
      path: '/',
      name: "Index",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/index/index', 'Index').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**签到记录 */
      path: '/user/signrecord',
      name: "SignRecord",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/signRecord/signRecord', 'SignRecord').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的课程 */
      path: '/user/course',
      name: "UserCourse",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/course/course', 'UserCourse').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的班级 */
      path: '/user/class',
      name: "UserClass",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/class/class', 'UserClass').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的训练营 */
      path: '/user/train',
      name: "UserTrain",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/train/train', 'UserTrain').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的专栏 */
      path: '/user/column',
      name: "UserColumn",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/column/column', 'UserColumn').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的考试  选择分类 */
      path: '/user/examcategory',
      name: "ExamCategory",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/exam/examCategory/examCategory', 'ExamCategory').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的考试*/
      path: '/user/exam',
      name: "UserExam",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/exam/exam', 'UserExam', false).then(function (page) {
          resolve(page);
        });
      },
      children: [{
        //考试报告
        path: '/user/myexam',
        name: "MyExam",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/exam/myExam/myExam', 'MyExam').then(function (page) {
            resolve(page);
          });
        }
      }, {
        //练习中心
        path: '/user/practice',
        name: "Practice",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/exam/practice/practice', 'Practice').then(function (page) {
            resolve(page);
          });
        }
      }, {
        //套卷练习
        path: '/user/packageexam',
        name: "PackageExam",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/exam/packageExam/packageExam', 'PackageExam').then(function (page) {
            resolve(page);
          });
        }
      }, {
        //练习记录
        path: '/user/practicerecord',
        name: "PracticeRecord",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/exam/practiceRecord/practiceRecord', 'PracticeRecord').then(function (page) {
            resolve(page);
          });
        }
      }, {
        //考试记录
        path: '/user/examrecord',
        name: "ExamRecord",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/exam/examRecord/examRecord', 'ExamRecord').then(function (page) {
            resolve(page);
          });
        }
      }, {
        //错题练习
        path: '/user/errorbank',
        name: "ErrorBank",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/exam/errorBank/errorBank', 'ErrorBank').then(function (page) {
            resolve(page);
          });
        }
      }, {
        //收藏练习
        path: '/user/collectbank',
        name: "CollectBank",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/exam/collectBank/collectBank', 'CollectBank').then(function (page) {
            resolve(page);
          });
        }
      }]
    }, {
      /**考试包 */
      path: '/user/package',
      name: "Package",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/package/package', 'Package').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**试题纠错 */
      path: '/user/correction',
      name: "Correction",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/correction/correction', 'Correction').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的活动 */
      path: '/user/activity',
      name: "UserActivity",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/activity/activity', 'UserActivity').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的社群 */
      path: '/user/community',
      name: "UserCommunity",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/community/community', 'UserCommunity').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的订单 */
      path: '/user/order',
      name: "UserOrder",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/order/order', 'UserOrder').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的账户 */
      path: '/user/account',
      name: "UserAccount",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/account/account', 'UserAccount').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /*账户明细*/
      path: '/user/account/money',
      name: "AccountMoney",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/account/logMoney/logMoney', 'AccountMoney').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /** 点券明细*/
      path: '/user/account/point',
      name: "AccountPoint",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/account/logPoint/logPoint', 'AccountPoint').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /** 积分明细*/
      path: '/user/account/score',
      name: "AccountScore",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/account/logScore/logScore', 'AccountScore').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /** 充值余额*/
      path: '/user/account/recharge',
      name: "AccountRecharge",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/account/recharge/recharge', 'AccountRecharge').then(function (page) {
          resolve(page);
        });
      }
    },
    /** 点券兑换*/
    {
      path: '/user/account/exchangepoint',
      name: "AccountExchangePoint",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/account/exchangePoint/exchangePoint', 'AccountExchangePoint').then(function (page) {
          resolve(page);
        });
      }
    },
    /** 课程返现*/
    {
      path: '/user/account/cash',
      name: "AccountCash",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/account/cash/cash', 'AccountCash').then(function (page) {
          resolve(page);
        });
      }
    },
    /** 优惠券红包*/
    {
      path: '/user/account/coupon',
      name: "AccountCoupon",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/account/coupon/coupon', 'AccountCoupon').then(function (page) {
          resolve(page);
        });
      }
    },
    /** 升级vip*/
    {
      path: '/user/account/vip',
      name: "AccountVip",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/account/vip/vip', 'AccountVip').then(function (page) {
          resolve(page);
        });
      }
    },
    /** 营销卡*/
    {
      path: '/user/account/feepackage',
      name: "AccountFeepackage",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/account/feepackage/feepackage', 'AccountFeepackage').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我要赚钱 */
      path: '/user/earning',
      name: "UserEarning",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/earning/earning', 'UserEarning').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**基本资料 */
      path: '/user/basicinfo',
      name: "UserBasicinfo",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/basicinfo/basicinfo', 'UserBasicinfo').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**站内消息 */
      path: '/user/message',
      name: "UserMessage",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/message/message', 'UserMessage').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**问题互动 */
      path: '/user/interaction',
      name: "UserInteraction",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/interaction/interaction', 'UserInteraction').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的评价 */
      path: '/user/comment',
      name: "UserComment",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/comment/comment', 'UserComment').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的点赞 */
      path: '/user/givezan',
      name: "UserGivezan",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/givezan/givezan', 'UserGivezan').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的收藏 */
      path: '/user/collect',
      name: "UserCollect",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/collect/collect', 'UserCollect').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的文章 */
      path: '/user/article',
      name: "UserArticle",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/article/article', 'UserArticle').then(function (page) {
          resolve(page);
        });
      }
    },{
      /**我的表单 */
      path: '/user/myform',
      name: "UserMyForm",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/myform/myform', 'UserMyForm').then(function (page) {
          resolve(page);
        });
      }
    },{
      /**表单详情 */
      path: '/user/details',
      name: "UserFormDetails",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/myform/details/details', 'UserFormDetails').then(function (page) {
          resolve(page);
        });
      }
    }, {
      /**我的文章iframe */
      path: '/user/articleview',
      name: "UserArticleView",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/articleiframe/articleiframe', 'UserArticleView').then(function (page) {
          resolve(page);
        });
      }
    },{
      /**求职管理 */
      path: '/user/resume',
      name: "UserResume",
      component: function(resolve) {
        require('/ks_inc/member-center/pages/resume/resume', 'UserResume', false).then(function (page) {
          resolve(page);
        });
      },
      children: [{
        /**个人资料 */
        path: '/user/resume/personal',
        name: "ResumePersonal",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/resume/personal/personal', 'ResumePersonal').then(function (page) {
            resolve(page);
          });
        }
      }, {
        /**求职意向 */
        path: '/user/resume/intention',
        name: "ResumeIntention",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/resume/intention/intention', 'ResumeIntention').then(function (page) {
            resolve(page);
          });
        }
      }, {
        /**工作经验 */
        path: '/user/resume/experience',
        name: "ResumeExperience",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/resume/experience/experience', 'ResumeExperience').then(function (page) {
            resolve(page);
          });
        }
      }, {
        /**教育背景 */
        path: '/user/resume/education',
        name: "ResumeEducation",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/resume/education/education', 'ResumeEducation').then(function (page) {
            resolve(page);
          });
        }
      }, {
        /**培训经历 */
        path: '/user/resume/train',
        name: "ResumeTrain",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/resume/train/train', 'ResumeTrain').then(function (page) {
            resolve(page);
          });
        }
      }, {
        /**求职记录 */
        path: '/user/resume/record',
        name: "ResumeRecord",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/resume/record/record', 'ResumeRecord').then(function (page) {
            resolve(page);
          });
        }
      }, {
        /**简历状态 */
        path: '/user/resume/status',
        name: "ResumeStatus",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/resume/status/status', 'ResumeStatus').then(function (page) {
            resolve(page);
          });
        }
      }, {
        /**职位推荐 */
        path: '/user/resume/recommend',
        name: "ResumeRecommend",
        component: function(resolve) {
          require('/ks_inc/member-center/pages/resume/recommend/recommend', 'ResumeRecommend').then(function (page) {
            resolve(page);
          });
        }
      }]
    }];
    /**创建 router 实例 */

    var router = new VueRouter({
      routes: routes
    }); //路由跳转后，页面回到顶部

    router.afterEach(function () {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    });
    var Loading;

    Vue.prototype.$showLoading = function (id) {
      if (id && !document.querySelector(id)) {
        return;
      }

      Loading = this.$loading({
        lock: true,
        background: 'rgba(255, 255, 255, 0.7)'
      });
    };

    Vue.prototype.$hideLoading = function () {
      this.$nextTick(function () {
        if (Loading) {
          Loading.close();
        }
      });
    };
    /**引入实例 */


    Vue.use(MyPlugin);
    /**创建和挂载根实例 */

    new Vue({
      el: '#app',
      router: router,
      store: store,
      data: {
        state: {},

        /**用户信息 */
        userInfo: {},

        /**左侧菜单栏列表 */
        menuNameList: Array,

        /**下拉菜单开启 */
        openeds: ['11', '12', '13']
      },
      watch: {
        '$route.name': function $routeName(name) {
          // this.$hideLoading("#userRight");
          var styleDoms = document.querySelectorAll('.route-page-style');

          for (var i = 0; i < styleDoms.length; i++) {
            var style = styleDoms[i];
            style.parentNode.removeChild(style);
          }

          document.head.appendChild(styles[name]);
        }
      },
      methods: {
        sign: function sign() {
          var that = this;
          DoUserSignIn({
            apptoken: this.state.appToken
          }).then(function (res) {
            if (res.result == true) {
              that.$message.success(res.msg);
              that.$store.dispatch("updateUserInfo").then(function () {
                that.userInfo.sign_data.sign_status = 1;
              });
            } else {
              that.$message.error(res.msg);
            }
          });
        },
        handleOpen: function handleOpen(key, keyPath) {},
        handleClose: function handleClose(key, keyPath) {},
        open: function open(url) {
          console.log(url)
          if (this.$route.path == url) {
            location.reload();
          } else {
            this.$router.push(url);
          }
        }
      },
      mounted: function mounted() {
        var that = this;
        /**强制刷新值的方法 */

        this.$forceUpdate();
        that.$store.ready(function (state) {
          // that.$showLoading();
          that.state = state;
          that.userInfo = state.userInfo;
          GetUserLeft({
            apptoken: state.appToken
          }).then(function (res) {
            // that.$hideLoading();
            that.menuNameList = res.data;
          });
        });
      }
    });
  
})();