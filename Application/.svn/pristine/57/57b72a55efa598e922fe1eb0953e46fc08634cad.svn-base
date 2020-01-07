import {$post,$get} from './main.entrance'
import {getParams} from '@/utils'
/**
 * 获取课程详情
 */
export function getCourseDetail(params){
    return new Promise((resolve)=>{
        $post(`Microportal.Common.courseDetail`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 获取课程播放
 */
export function getCoursePlayVod(params){
    return new Promise((resolve)=>{
        $get(`Vod.Common.coursePlayVod`,params).then(res=>{
            resolve(res)
        })
    })
   
}

/**
 * 获取图文目录等信息
 */
export function getGraphicInfo(params){
    return new Promise((resolve)=>{
        $post(`Microportal.Common.imgtxtInfo`,params).then(res=>{
            resolve(res)
        })
    })
   
}


/**
 * 获取专栏列表
 */
export function getColumnList(params){
    return new Promise((resolve)=>{
        params.act = 'appColumn';
        params.callKeyName = 'columnList';
        $post(`Microportal.Common.import`,[params]).then(res=>{
            resolve(res.columnList)
        })
    })
}




/**
 * 获取当前订单信息
 */
export function getOrderNow(params){
    return new Promise((resolve)=>{
        /**处理分销订单 */
        if(location.href.split('#')[1]){
            let query = getParams(location.href.split('#')[1])
            if(query.distributeUserId || query.distributeuserid){
                params.distributeUserId = query.distributeUserId || query.distributeuserid
            }
        }
        $post(`Microportal.Common.orderNow`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 获取拼团订单
 */

export function getCollageoOderNow(params){
    return new Promise((resolve)=>{
        $post(`Microportal.Common.collageorderNow`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 获取专栏内容
 */
export function getColumnDetail(params){
    return new Promise((resolve)=>{
        $post(`Microportal.Common.columndetail`,params).then(res=>{
            resolve(res)
        })
    })
}


/**
 * 获取打赏信息
 */
export function getAdmireList(params){
    return new Promise((resolve)=>{
        $post(`Microportal.Common.admirelist`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 获取最新学员
 */
export function courseStudent(params){
    return new Promise((resolve)=>{
        $post(`Microportal.Common.courseStudent`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 获取课程分类
 */
export function courseCategory(params){
    return new Promise((resolve)=>{
        $post(`Home.courseCategory`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 获取收货地址列表
 */
export function addressList(params){
    return new Promise((resolve)=>{
        $post(`Microportal.addressList`,params).then(res=>{
            resolve(res)
        })
    })
}
