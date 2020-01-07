import { $post } from './main.entrance'

/**
 * 保存视图配置文件
 */
export function saveStoreViewConfig(params) {
    return new Promise(resolve => {
        $post('Drag.Store.wx_SaveStoreViewConfig', params, {
            isErrorCall: true
        }).then(res => {
            resolve(res)
        })
    })

}

/**
 * 发布视图配置文件
 */
export function publishStoreViewConfig(params) {
    return new Promise(resolve => {
        $post(`Drag.Store.wx_PublishStoreView`, params, {
            isErrorCall: true
        }).then(res => {
            resolve(res)
        })
    })
}

/**
 * 获取风格列表
 */
export function getTemplist(params) {
    return new Promise(resolve => {
        $post(`Drag.Store.wx_GetTemplist`, params).then(res => {
            resolve(res)
        })
    })
}

/**
 * 恢复列表
 */
export function getPathList(params) {
    return new Promise(resolve => {
        $post(`Drag.Store.wx_GetPathList`, params).then(res => {
            resolve(res)
        })
    })

}

/**
 * 恢复初始化
 */
export function resDefault(params) {
    return new Promise(resolve => {
        $post(`Drag.Store.wx_ResDefault`, params).then(res => {
            resolve(res)
        })
    })
}

/**
 * 恢复指定记录
 */
export function resPath(params) {
    return new Promise(resolve => {
        $post(`Drag.Store.wx_ResPath`, params).then(res => {
            resolve(res)
        })
    })

}

/**
 * 切换店铺风格
 */
export function saveChangeTemp(params) {
    return new Promise(resolve => {
        $post(`Drag.Store.wx_SaveChangeTemp`, params, {
            isErrorCall: true
        }).then(res => {
            resolve(res)
        })
    })
}


/**
 * 获取图标列表
 */
export function getSysIcoList(params) {
    return new Promise(resolve => {
        $post(`Drag.Store.getIcoList`, params).then(res => {
            resolve(res)
        })
    })
}