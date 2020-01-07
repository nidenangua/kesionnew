import { $post, $get } from './main.entrance'

/**
 * 获取店铺信息
 */
export function getStoreInfo(params) {
    return new Promise(resolve => {
        $post(`Microportal.Common.getWxDetail`, params).then(res => {
            resolve(res)
        })
    })
}

/**
 * 获取店铺相关数据
 */
export function getStoreData(params) {
    return new Promise((resolve) => {
        $post(`Microportal.Common.import`, params).then(res => {
            resolve(res)
        })
    })
}

/**
 * 获取微信配置信息
 */
export function getWechatConfig(params) {
    return new Promise((resolve) => {
        $post(`Microportal.Common.getWXShareSign`, params).then(res => {
            resolve(res)
        })
    })
}


/**
 * 保存模块开关
 */

export function saveModuleSwitch(params) {
    return new Promise((resolve) => {
        $post(`Microportal.Store.saveModuleSwitch`, params).then(data => {
            resolve(data)
        })

    })
}

/**
 * 获取优惠券列表
 */
export function getVoucherList(params) {
    return new Promise((resolve) => {
        $post(`Microportal.Common.getVoucherList`, params).then(data => {
            resolve(data)
        })

    })
}