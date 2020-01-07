import { $post, $get } from './main.entrance'

/**答疑列表 changeStatus*/
export function answerIndex(params) {
    return new Promise(resolve => {
        $post(`Social.answerIndex`, params).then(data => {
            resolve(data)
        })
    })
}
/**改变审核状态*/
export function changeStatus(params) {
    return new Promise(resolve => {
        $post(`Social.changeStatus`, params).then(data => {
            resolve(data)
        })
    })
}
/**查看回复*/
export function showAnswer(params) {
    return new Promise(resolve => {
        $post(`Social.showAnswer`, params).then(data => {
            resolve(data)
        })
    })
}
/**删除问题*/
export function delAsk(params) {
    return new Promise(resolve => {
        $post(`Social.delAsk`, params).then(data => {
            resolve(data)
        })
    })
}
/**回复问题*/
export function replyTeacher(params) {
    return new Promise(resolve => {
        $post(`Social.replyTeacher`, params).then(data => {
            resolve(data)
        })
    })
}
