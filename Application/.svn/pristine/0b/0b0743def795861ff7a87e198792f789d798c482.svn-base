import { $post } from './main.entrance'

/**
 * 获取基本信息
 */
export function addFriends(params) {
    return new Promise((resolve) => {
        $post(`Social.addFriends`, params).then(data => {
            resolve(data)
        })

    })
}