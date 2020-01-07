import { $post, $get } from './main.entrance'
/**
 * 获取店铺信息
 */
export function getWxDetail(params) {
    return new Promise(resolve => {
        $post(`Microportal.Common.getWxDetail`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取店铺相关数据
 */
export function getStoreData(params) {
    return new Promise(resolve => {
        $post(`Microportal.Common.import`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取店铺装修配置
 */
export function getStoreViewConfig(params) {
    return new Promise(resolve => {
        $post(`Drag.Common.wx_GetStoreViewConfig`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取微信配置信息
 */
export function getWechatConfig() {
    return new Promise(resolve => {
        $get(`Microportal.Common.getWXShareSign`).then(data => {
            resolve(data)
        })
    })
}


/**
 * 保存店铺设置
 */
export function saveSiteConfig(params) {
    return new Promise(resolve => {
        $post(`Users.Store.saveSiteConfig`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 保存店铺分享设置
 */
export function saveSiteShare(params) {
    return new Promise(resolve => {
        $post(`Users.Store.saveSiteShare`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 保存店铺banner
 */
export function saveMobileBanner(params) {
    return new Promise(resolve => {
        $post(`Users.Store.saveMobileBanner`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 保存pc banner
 */
export function savePcBanner(params) {
    return new Promise(resolve => {
        $post(`Users.Store.savePcBanner`, params).then(data => {
            resolve(data)
        })
    })
}

/**保存教辅周边banner */
export function saveLearnBanner(params) {
    return new Promise(resolve => {
        $post(`Users.Store.saveLearnBanner`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 保存店铺介绍
 */
export function saveSiteIntro(params) {
    return new Promise(resolve => {
        $post(`Users.Store.saveSiteIntro`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 保存店铺介绍
 */
export function checkModuleHasOpen(params) {
    return new Promise(resolve => {
        $post(`Microportal.Store.checkModuleHasOpen`, params, {
            isErrorCall: true
        }).then(data => {
            resolve(data)
        })
    })
}