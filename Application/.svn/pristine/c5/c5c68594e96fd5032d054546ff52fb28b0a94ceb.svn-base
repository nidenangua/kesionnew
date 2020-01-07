import {$post} from './main.entrance'

/**
 * 获取班级详情
 */
export function getClassDetail(params){
    return new Promise(resolve=>{
        $post(`Microportal.Common.classDetail`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 获取小程序学习二维码
 */
export function getXCXQRcode(params){
    return new Promise(resolve=>{
        $post(`Microportal.Common.getXCXQRcode`,params).then(res=>{
            resolve(res)
        })
    })
}
