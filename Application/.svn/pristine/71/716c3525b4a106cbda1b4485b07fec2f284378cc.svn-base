import { $post } from './main.entrance'

/**VIP数据查询 */
export function getprivilege(params) {
    return new Promise(resolve => {
        $post(`Users.vipList`, params).then(data => {
            resolve(data)
        })
    })
}

/**VIP数据操作 */
export function editprivilege(params) {
    return new Promise(resolve => {
        $post(`Users.editVip`, params).then(data => {
            resolve(data)
        })
    })
}

/**VIP数据删除 */
export function delprivilege(params) {
    return new Promise(resolve => {
        $post(`Users.delVip`, params).then(data => {
            resolve(data)
        })
    })
}

/**VIP说明查询 */
export function explainShow(params) {
    return new Promise(resolve => {
        $post(`Users.explainShow`, params).then(data => {
            resolve(data)
        })
    })
}

/**VIP说明保存 */
export function explainVip(params) {
    return new Promise(resolve => {
        $post(`Users.explainVip`, params).then(data => {
            resolve(data)
        })
    })
}