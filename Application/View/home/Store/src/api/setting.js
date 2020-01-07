import { $post } from './main.entrance'
/**
 * 系统设置
 */
export function checkModuleHasOpen(params) {
    return new Promise((resolve) => {
        $post(`Microportal.Store.checkModuleHasOpen`, params, {
            isErrorCall: true
        }).then(data => {
            resolve(data)
        })
    })
}
/**
 * 设置微信独立收款插件的状态
 */
export function setStorePayStatus(params) {
    return new Promise((resolve) => {
        $post(`Microportal.Store.setStorePayStatus`, params, {
            isErrorCall: true
        }).then(data => {
            resolve(data)
        })
    })
}
