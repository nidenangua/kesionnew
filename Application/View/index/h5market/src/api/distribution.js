import {$post,$get} from './main.entrance'
/**
 * 获取我的分销
 */
export function myDistributeList(params){
    return new Promise((resolve)=>{
        $post(`Distribution.Common.myDistributeList`,params).then(data=>{
            resolve(data)
        })
        
    })
}

/**
 * 可分销列表
 */
export function distributionList(params){
    return new Promise((resolve)=>{
        $post(`Distribution.Common.distributionList`,params).then(data=>{
            resolve(data)
        })
        
    })
}

/**
 * 提现，检查微信是否绑定
 */
export function checkApplyBindWechat(params){
    return new Promise((resolve)=>{
        $post(`Distribution.Common.checkApplyBindWechat`,params,{
            isErrorCall:true
        }).then(data=>{
            resolve(data)
        })
        
    })
}
/**
 * 申请提现
 */
export function applyDistributeWithdrawal(params){
    return new Promise((resolve)=>{
        $post(`Distribution.Common.applyDistributeWithdrawal`,params).then(data=>{
            resolve(data)
        })
        
    })
}

/**
 * 我的提现记录
 */
export function myDistributeWithdrawalRecord(params){
    return new Promise((resolve)=>{
        $post(`Distribution.Common.myDistributeWithdrawalRecord`,params).then(data=>{
            resolve(data)
        })
        
    })
}

