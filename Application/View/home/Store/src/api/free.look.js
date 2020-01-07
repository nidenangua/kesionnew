import { $post, $get } from './main.entrance'

/**免费请好友看管理 */
export function freeList(params) {
    return new Promise(resolve => {
        $post(`FreeLook.freeList`, params).then(data => {
            resolve(data)
        })
    })
}
/** 免费请好友看订单 */
export function freeOrderList(params) {
    return new Promise(resolve => {
        $post(`FreeLook.freeOrderList`, params).then(data => {
            resolve(data)
        })
    })
}
/**分享 */
export function shareFree(params) {
    return new Promise(resolve => {
        $post(`FreeLook.shareFree`, params).then(data => {
            resolve(data)
        })
    })
}

/**课程列表 */
export function courseList(params) {
    return new Promise(resolve => {
        $post(`FreeLook.courseList`, params).then(data => {
            resolve(data)
        })
    })
}
/**关闭和开启活动状态 */
export function changeFree(params) {
    return new Promise(resolve => {
        $post(`FreeLook.changeFree`, params).then(data => {
            resolve(data)
        })
    })
}
/**添加、编辑活动 */
export function addFree(params) {
    return new Promise(resolve => {
        $post(`FreeLook.addFree`, params).then(data => {
            resolve(data)
        })
    })
}
/**删除活动 */
export function delFree(params) {
    return new Promise(resolve => {
        $post(`FreeLook.delFree`, params).then(data => {
            resolve(data)
        })
    })
}