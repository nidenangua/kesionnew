const mall = [
    /**教辅首页*/
    {
        path: '/mallindex',
        name: 'MallIndex',
        component: resolve => {
        require(['@/m/pages/mall/MallIndex.vue'], resolve)
        }
    },
    /**教辅编辑添加收货地址*/
    {
        path: '/editaddress',
        name: 'EditAddress',
        component: resolve => {
        require(['@/m/pages/mall/Editaddress.vue'], resolve)
        }
    },
    /**商品列表*/
    {
        path: '/malist',
        name: 'MallList',
        component: resolve => {
        require(['@/m/pages/mall/MallList.vue'], resolve)
        }
    },
     /**商品列表*/
     {
        path: '/cart',
        name: 'ShoppingCart',
        component: resolve => {
        require(['@/m/pages/mall/ShoppingCart.vue'], resolve)
        }
    },
     /**商品详情*/
     {
        path: '/commodity',
        name: 'ShoppingCart',
        component: resolve => {
        require(['@/m/pages/mall/Commodity.vue'], resolve)
        }
    },
     /**确认订单*/
     {
        path: '/shop/confirm',
        name: 'ShoppingCart',
        component: resolve => {
        require(['@/m/pages/mall/Confirm.vue'], resolve)
        }
    },
    /**地址选择*/
    {
        path: '/shipping',
        name: 'ShoppingCart',
        component: resolve => {
        require(['@/m/pages/mall/Shipping.vue'], resolve)
        }
    },
    /**查看物流*/
    {
        path: '/logistics',
        name: 'ShoppingCart',
        component: resolve => {
        require(['@/m/pages/mall/Logistics.vue'], resolve)
        }
    },
]

export default mall