import { $post } from './main.entrance'
/**助力信息 */
export function addHelp(params) {
    return new Promise((resolve) => {
        $post(`FriendsHelp.addHelp`, params).then(res => {
            resolve(res)
        })
    })
}
/**显示好友助力情况 */
export function showHelp(params) {
    return new Promise((resolve) => {
        $post(`FriendsHelp.showHelp`, params).then(res => {
            resolve(res)
        })
    })
}
/**为好友助力 */
export function assistance(params) {
    return new Promise((resolve) => {
        $post(`FriendsHelp.assistance`, params, { isErrorCall: true }).then(res => {
            resolve(res)
        })
    })
}
/**生成分享海报 */
export function showBill(params) {
    return new Promise((resolve) => {
        $post(`FriendsHelp.showBill`, params).then(res => {
            resolve(res)
        })
    })
}