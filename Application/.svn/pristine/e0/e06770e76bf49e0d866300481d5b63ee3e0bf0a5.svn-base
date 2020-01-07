import { $post } from './main.entrance'
/**
 * 获取小程序二维码
 */
export function generateCode(params) {
    return new Promise((resolve) => {
        $post(`Api.generateCode`, params).then(res => {
            resolve(res)
        })
    })
}