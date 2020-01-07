import {$post} from './main.entrance'

/**
 * 获取资料列表
 */
export function getMaterialsList(params){
    return new Promise((resolve)=>{
        $post(`Microportal.Common.getMaterialsList`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 获取资料详情
 */
export function getMaterialsDetail(params){
    return new Promise((resolve)=>{
        $post(`Microportal.Common.getMaterialsDetail`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 获取资料下载链接
 */
export function getDownPath(params){
    return new Promise((resolve)=>{
        $post(`Microportal.Common.getDownPath`,params).then(res=>{
            resolve(res)
        })
    })
}