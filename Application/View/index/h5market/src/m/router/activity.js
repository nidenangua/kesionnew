const activity = [
  /**
   * 活动票种
   */
  {
    path: '/activity/:id',
    name: 'ActivityDetail',
    component: resolve => {
      require(['@/m/pages/activity/ActivityDetail.vue'], resolve)
    }
  },
  /**
   * 选择票种
   */
  {
    path: '/activity/:id/selectticket',
    name: 'SelectTicket',
    component: resolve => {
      require(['@/m/pages/activity/SelectTicket.vue'], resolve)
    }
  },
  /**报名表单 */
  {
    path: '/activity/:id/registrationform',
    name: 'RegistrationForm',
    component: resolve => {
      require(['@/m/pages/activity/RegistrationForm.vue'], resolve)
    }
  },
  /**
   * 确认票种
   */
  {
    path: '/activity/:id/confirmticket',
    name: 'ConfirmTicket',
    component: resolve => {
      require(['@/m/pages/activity/ConfirmTicket.vue'], resolve)
    }
  },
  /**支付方式 */
  {
    path: '/activity/:id/paymodel',
    name: 'PayModel',
    component: resolve => {
      require(['@/m/pages/activity/PayModel.vue'], resolve)
    }
  },
  /**支付结果 */
  {
    path: '/activity/:id/payresult',
    name: 'PayResult',
    component: resolve => {
      require(['@/m/pages/activity/PayResult.vue'], resolve)
    }
  },
  /**我的活动 */
  {
    path: '/myactivity',
    name: 'MyActivity',
    component: resolve => {
      require(['@/m/pages/activity/MyActivity.vue'], resolve)
    }
  },
  /**查看票券 */
  {
    path: '/checktickets',
    name: 'CheckTickets',
    component: resolve => {
      require(['@/m/pages/activity/CheckTickets.vue'], resolve)
    }
  },
  /**签到 */
  {
    path: '/signin',
    name: 'SignIn',
    component: resolve => {
      require(['@/m/pages/activity/SignIn.vue'], resolve)
    }
  },
  /**签到结果 */
  {
    path: '/signinresult/:id',
    name: 'SignInResult',
    component: resolve => {
      require(['@/m/pages/activity/SignInResult.vue'], resolve)
    }
  },
   /**机构端活动列表*/
   {
    path: '/activityList',
    name: 'activityList',
    component: resolve => {
      require(['@/m/pages/user/activity/activityList.vue'], resolve)
    }
  },
  /**发布活动 */
  {
    path: '/issueActivity',
    name: 'issueActivity',
    component: resolve => {
      require(['@/m/pages/user/activity/issueActivity.vue'], resolve)
    }
  },
  /**活动选择 */
  {
    path: '/activitySelect',
    name: 'activitySelect',
    component: resolve => {
      require(['@/m/pages/user/activity/activitySelect.vue'], resolve)
    }
  },
  /**创建新票种 */
  {
    path: '/acitvityTickets',
    name: 'acitvityTickets',
    component: resolve => {
      require(['@/m/pages/user/activity/acitvityTickets.vue'], resolve)
    }
  },
  /**报名管理 */
  {
    path: '/activityManage',
    name: 'activityManage',
    component: resolve => {
      require(['@/m/pages/user/activity/activityManage.vue'], resolve)
    }
  },
  /**活动用户详情 */
  {
    path: '/activityUserdet',
    name: 'activityUserdet',
    component: resolve => {
      require(['@/m/pages/user/activity/activityUserdet.vue'], resolve)
    }
  }
]
export default activity