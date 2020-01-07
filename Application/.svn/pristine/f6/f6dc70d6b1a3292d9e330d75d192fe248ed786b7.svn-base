import {$post} from './main.entrance'

/**
 * 新闻列表
 */
export function getNews(params){
    return new Promise((resolve)=>{
        params.act = 'appNews'
        params.callKeyName = 'news'
        $post(`Microportal.Common.import`,[params]).then(res=>{
            resolve(res.news)
        })
    })
}

/**
 * 新闻分类
 */
export function newsCategory(params){
    return new Promise((resolve)=>{
        $post('Home.Common.newsCategory',params).then(res=>{
            resolve(res)
        })
    })
} 

/**
 * 新闻内容页
 */

export function newsDetail(params){
    return new Promise((resolve)=>{
        $post(`Microportal.Common.newsDetail`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 新闻评论
 */

export function newsInteract(params){
    return new Promise((resolve)=>{
		params.act = 'appInteract'
		params.callKeyName = 'interactList'
        $post(`Microportal.import`,[params]).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 添加新闻评论
 */

export function writeComment(params){
    return new Promise((resolve)=>{
        $post(`Microportal.writeComment`,params).then(res=>{
            resolve(res)
        })
    })
}
/**
 * 新闻点赞
 */

export function praiseInteract(params){
    return new Promise((resolve)=>{
        $post(`Microportal.praiseInteract`,params).then(res=>{
            resolve(res)
        })
    })
}

