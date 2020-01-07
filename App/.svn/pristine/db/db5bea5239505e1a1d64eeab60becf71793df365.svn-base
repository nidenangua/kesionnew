import {$post} from './main.entrance'
/**获取微信扫码登录状态 */
export function doPcLogin(params){
    return new Promise(resolve => {
        $post('Users.doPcLogin', params).then(res => {
            resolve(res)
        })
    })
}