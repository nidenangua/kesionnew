import { $post, $get } from './main.entrance'

/**
 * 保存视图配置文件
 */
export function getHomeData(params) {
    return new Promise(resolve => {
        $post('Home.Store.getHomeData', params).then(res => {
            resolve(res)
        })
    })
}

/**
 * 数据统计信息
 */
export function orderStatistics(params) {
    return new Promise(resolve => {
        $post('Home.store.orderStatistics', params).then(res => {
            resolve(res)
        })
    })
}

/**
 * 保存
 */
export function saveNav(params) {
    return new Promise(resolve => {
        $post('Home.store.saveNav', params).then(res => {
            resolve(res)
        })
    })
}

/**
 * 获取模块应用开关信息
 */
export function getAppInfo() {
    return new Promise(resolve => {
        $get(`Home.Store.getAppInfo`).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取网校相关信息
 */
export function getWxDomainInfo(params) {
    return new Promise(resolve => {
        $post('Home.Store.getWxDomainInfo', params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 修改网校相关信息
 */
export function editWxDomain(params) {
    return new Promise(resolve => {
        $post('Home.Store.editWxDomain', params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取应用设置信息
 */
export function getAppSetting(params) {
    return new Promise(resolve => {
        $post('Home.getAppSetting', params).then(data => {
            resolve(data)
        })
    })
}

/**教辅周边分类 */
export function mallCategory(params) {
    return new Promise(resolve => {
        $post('Home.mallCategory', params).then(data => {
            resolve(data)
        })
    })
}