import {$post} from './main.entrance'
/**
 * 获取所有评论
 */
export function getAllComment(params){
    return new Promise((resolve)=>{
        params.callKeyName = 'interactList';
        params.act = 'appInteract';
        $post(`Microportal.Common.import`,[params]).then(data=>{
            resolve(data.interactList)
        })
    })
}


/**
 * 发布评论
 */
export function writeComment(params){
    return new Promise((resolve)=>{
        $post(`Microportal.User.writeComment`,params).then(data=>{
            resolve(data)
        })
    })
}

/**
 * 点赞
 */

export function praiseInteract(params){
    return new Promise((resolve)=>{
        $post(`Microportal.praiseInteract`,params).then(data=>{
            resolve(data)
        })
    })
}
