import { $post } from './main.entrance'
/**
 * 获取证书列表
 */
export function certificateList(params) {
    return new Promise((resolve) => {
        $post(`Certificate.certificateList`, params).then(res => {
            resolve(res)
        })
    })
}
/**
 * 证书开关
 */
export function changeStatus(params) {
    return new Promise((resolve) => {
        $post(`Certificate.changeStatus`, params).then(res => {
            resolve(res)
        })
    })
}
/**
 * 关联列表
 */
export function getLinkList(params) {
    return new Promise((resolve) => {
        $post(`Certificate.getLinkList`, params).then(res => {
            resolve(res)
        })
    })
}
/**
 * 列表删除
 */
export function del(params) {
    return new Promise((resolve) => {
        $post(`Certificate.del`, params).then(res => {
            resolve(res)
        })
    })
}
/**
 * 关联详情
 */
export function getLinkDetail(params) {
    return new Promise((resolve) => {
        $post(`Certificate.getLinkDetail`, params).then(res => {
            resolve(res)
        })
    })
}
/**
 * 添加证书
 */
export function addCertificate(params) {
    return new Promise((resolve) => {
        $post(`Certificate.addCertificate`, params).then(res => {
            resolve(res)
        })
    })
}
/**
 * 证书详情
 */
export function getCertificate(params) {
    return new Promise((resolve) => {
        $post(`Certificate.getCertificate`, params).then(res => {
            resolve(res)
        })
    })
}
