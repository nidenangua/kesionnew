import { $post } from './main.entrance'
/**
 * 获取店铺信息
 */
export function getWxDetail(params) {
    return new Promise(resolve => {
        $post(`Microportal.getWxDetail`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 获取课程资料
 */
export function getMaterialsList(params) {
    return new Promise(resolve => {
        $post(`Microportal.getMaterialsList`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 添加资料
 */
export function addMaterials(params) {
    return new Promise((resolve) => {
        $post(`Microportal.addMaterials`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 删除课程资料
 */
export function delMaterials(params) {
    return new Promise((resolve) => {
        $post(`Microportal.store.delMaterials`, params).then(data => {
            resolve(data)
        })
    })
}

/**验证打赏订单是否有效 */
export function checkOrdersn(params) {
    return new Promise(resolve => {
        $post('Microportal.checkOrdersn', params, {
            isErrorCall: true
        }).then(res => {
            resolve(res)
        })
    })
}