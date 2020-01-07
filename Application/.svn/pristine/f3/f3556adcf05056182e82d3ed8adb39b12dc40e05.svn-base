
import {$post} from './main.entrance'
/**
 * 获取风格列表
 */
export function getTemplist(params){
    return new Promise(resolve=>{
        $post(`Drag.Store.wx_GetTemplist`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 切换店铺风格
 */
export function saveChangeTemp(params){
    return new Promise(resolve=>{
        $post(`Drag.Store.wx_SaveChangeTemp`,params,{
            isErrorCall:true
        }).then(res=>{
            resolve(res)
        })
    })
}