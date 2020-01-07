const friendsRouters = [
    {
      path: '/friendsdet/:id',
      name: 'Friends',
      component: resolve => {
        require(['@/pages/friends/FriendsDel.vue'], resolve)
      }
    },
    /**添加动态 */
    // {
      
    //   path: '/friends/addfriends',
    //   name: 'AddFriends',
    //   component: resolve => {
    //     require(['@/pages/friends/AddFriends.vue'], resolve)
    //   }
    // }
]
export default friendsRouters