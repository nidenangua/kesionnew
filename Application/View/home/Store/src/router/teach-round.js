const teachRoundRouters = [
    /**商品规格组列表页 */
    {
        path: '/goodsset',
        name: 'GoodsSet',
        component: resolve => {
            require(['@/pages/teach-round/GoodsSet.vue'], resolve)
        }
    },
    /**添加规格组页面 */
    {
        path: '/addgroup',
        name: 'AddGroup',
        component: resolve => {
            require(['@/pages/teach-round/AddGroup.vue'], resolve)
        }
    },
    /**添加商品页面 */
    {
        path: '/addmerchandise',
        name: 'AddMerchandise',
        component: resolve => {
            require(['@/pages/teach-round/AddMerchandise.vue'], resolve)
        }
    },
]
export default teachRoundRouters