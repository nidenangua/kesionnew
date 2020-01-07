import { $post } from './main.entrance'
/**教辅主页 */
export function teachMall(params) {
    return new Promise((resolve) => {
        $post(`Microportal.teachMall`, params).then(res => {
            resolve(res)
        })
    })
}
/**添加、编辑收货地址 */
export function editAddress(params) {
    return new Promise((resolve) => {
        $post(`Microportal.editAddress`, params).then(res => {
            resolve(res)
        })
    })
}
/**商品列表 */
export function mallList(params) {
    return new Promise((resolve) => {
        $post(`Microportal.mallList`, params).then(res => {
            resolve(res)
        })
    })
}
/**购物车列表 */
export function cartList(params) {
    return new Promise((resolve) => {
        $post(`Microportal.cartList`, params).then(res => {
            resolve(res)
        })
    })
}
/**收货地址列表 */
export function addressList(params) {
    return new Promise((resolve) => {
        $post(`Microportal.addressList`, params).then(res => {
            resolve(res)
        })
    })
}
/**物流信息 */
export function showLogistics(params) {
    return new Promise((resolve) => {
        $post(`Microportal.showLogistics`, params).then(res => {
            resolve(res)
        })
    })
}
/**删除收货地址 */
export function delAddress(params) {
    return new Promise((resolve) => {
        $post(`Microportal.delAddress`, params).then(res => {
            resolve(res)
        })
    })
}
/**确认订单 */
export function confirmOrder(params) {
    return new Promise((resolve) => {
        $post(`Microportal.confirmOrder`, params).then(res => {
            resolve(res)
        })
    })
}
/**确认订单 */
export function courseDetail(params) {
    return new Promise((resolve) => {
        $post(`Microportal.Common.courseDetail`, params).then(res => {
            resolve(res)
        })
    })
}

/**移除购物车 */
export function delCart(params) {
    return new Promise((resolve) => {
        $post(`Microportal.delCart`, params).then(res => {
            resolve(res)
        })
    })
}

/**加入购物车*/
export function addCart(params) {
    return new Promise((resolve) => {
        $post(`Microportal.addCart`, params).then(res => {
            resolve(res)
        })
    })
}

/**收货地址显示 */
export function showAddress(params) {
    return new Promise((resolve) => {
        $post(`Microportal.showAddress`, params).then(res => {
            resolve(res)
        })
    })
}

/**三级联动 */
export function getArea(params) {
    return new Promise((resolve) => {
        $post(`Home.getArea`, params).then(res => {
            resolve(res)
        })
    })
}
/**教辅分类 */
export function mallCate(params) {
    return new Promise((resolve) => {
        $post(`Home.mallCate`, params).then(res => {
            resolve(res)
        })
    })
}
/**设置默认收货地址 */
export function defaultAddress(params) {
    return new Promise((resolve) => {
        $post(`Microportal.defaultAddress`, params).then(res => {
            resolve(res)
        })
    })
}