import { $post } from './main.entrance'
/**分享课时 */
export function addGive(params) {
    return new Promise((resolve) => {
        $post(`FreeLook.addGive`, params).then(res => {
            resolve(res)
        })
    })
}
/**我要送礼页面和领取状况 */
export function showGift(params) {
    return new Promise((resolve) => {
        $post(`FreeLook.showGift`, params).then(res => {
            resolve(res)
        })
    })
}
/**好友领取页面 */
export function getFreeShare(params) {
    return new Promise((resolve) => {
        $post(`FreeLook.getFreeShare`, params).then(res => {
            resolve(res)
        })
    })
}
/**好友领取课时下订单 */
export function orderFree(params) {
    return new Promise((resolve) => {
        $post(`FreeLook.orderFree`, params).then(res => {
            resolve(res)
        })
    })
}