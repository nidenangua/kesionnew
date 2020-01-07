import {$post,$get} from './main.entrance'

/**
 * 发表朋友圈
 */
export function addFriends(params){
    return new Promise((resolve)=>{
        $post(`Social.addFriends`,params).then(data=>{
            resolve(data)
        })
    })
}
