const friendsCircleRouters = [
    {
        path: '/friedscircle',
        name: 'FriedsCircle',
        component: resolve => {
            require(['@/pages/friends/FriendsCircle.vue'], resolve)
        }
    }
]
export default friendsCircleRouters
// 朋友圈路由模块