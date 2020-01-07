const friends =   [
    /**朋友圈*/
    {
      path: '/friend',
      name: 'Friend',
      component: resolve => {
        require(['@/m/pages/friend/Friend.vue'], resolve)
      }
    },
    {
      path: '/friend/:id',
      name: 'FriendDetails',
      component: resolve => {
        require(['@/m/pages/friend/FriendDetails.vue'], resolve)
      }
    },
    {
      path: '/friendList',
      name: 'FriendList',
      component: resolve => {
        require(['@/m/pages/friend/FriendList.vue'], resolve)
      }
    },
    /**发布页面*/
    {
      path: '/friendIssue',
      name: 'FriendIssue',
      component: resolve => {
        require(['@/m/pages/friend/FriendIssue.vue'], resolve)
      }
    },
]
export default friends