import { $post } from './main.entrance'

/**
 * 上传视频
 * 检查是否有可用空间 
 */
export function isVodUpload(params) {
    return new Promise((resolve) => {
        $post('Vod.Store.isVodUpload', params).then(res => {
            resolve(res)
        })
    })
}
/**
 * 获取上传凭证
 */
export function uploadTencent(params) {
    return new Promise((resolve) => {
        $post('Vod.Store.uploadTencent', params).then(res => {
            resolve(res)
        })
    })
}

/**
 * 上传成功，写入数据库
 */
export function addVodList(params) {
    return new Promise((resolve) => {
        $post('Vod.Store.vodSaveToDB', params).then(res => {
            resolve(res)
        })
    })
}

/**
 * 获取视频列表
 */
export function getVodList(params) {
    return new Promise(resolve => {
        $post('Vod.Store.getVodList', params).then(res => {
            resolve(res)
        })
    })
}

/**
 * 同步指定视频 (转码状态、图片等)
 */
export function updateVodListStatus(params) {
    return new Promise(resolve => {
        $post('Vod.Store.updateVodStatus', params).then(res => {
            resolve(res)
        })
    })
}

/**
 * 删除视频
 */
export function deleteVod(params) {
    return new Promise(resolve => {
        $post('Vod.Store.deleteVod', params).then(res => {
            resolve(res)
        })
    })
}

/**
 * 获取当前网校可用的空间及流量
 */
export function getVodSpaceAndTraffic(params) {
    return new Promise(resolve => {
        $post('Vod.Store.getVodSpaceAndTraffic', params).then(res => {
            resolve(res)
        })
    })
}