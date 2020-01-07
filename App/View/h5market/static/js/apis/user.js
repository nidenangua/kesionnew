

/**
 * 获取订单列表
 */
function getOrderList(params){
    return new Promise(function(resolve){
        $get('Users.Common.getOrderList',params).then(function(res){
            resolve(res)
        })
    })
}

/**
 * 个人会员 删除订单
 */
function deleteOrder(params){
    return new Promise((resolve)=>{
        $get(`Users.Common.delOrder`,params).then(function(data){
            resolve(data)
        })
        
    })
}