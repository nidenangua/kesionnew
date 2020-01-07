import {$post} from './main.entrance'

/**
 * 社群中心
 */
export function getGroupList(params){
    return new Promise((resolve)=>{
        params.act = 'appTeam';
        params.callKeyName = 'getGroupList';
        $post(`Microportal.Common.import`,[params]).then(res=>{
            resolve(res.getGroupList)
        })
    })
}

/**
 * 社群详情
 */
export function getTeamDetail(params){
    return new Promise((resolve)=>{
        $post(`Team.Common.getTeamDetail`,params).then(res=>{
            resolve(res)
        })
    })
}
/**
 * 社群动态列表
 */
export function getTeamTopicList(params){
    return new Promise((resolve)=>{
       
        params.act = 'appTeamTopic';
        params.callKeyName = 'getTeamTopicList';
        $post(`Microportal.Common.import`,[params]).then(res=>{
            resolve(res.getTeamTopicList)
        })
    })
}


/**
 * 社群成员列表
 */
export function getTeamMemberList(params){
    return new Promise((resolve)=>{
        $post(`Team.Common.getTeamMemberList`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 修改状态
 */
export function setStatus(params){
    return new Promise((resolve)=>{
        $post(`Team.User.setStatus`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 *屏蔽动态
 */

export function teamShield(params){
    return new Promise((resolve)=>{
        $post(`Team.Common.teamShield`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 删除评论跟动态
 */
export function teamDel(params){
    return new Promise((resolve)=>{
        $post(`Team.Common.teamDel`,params).then(res=>{
            resolve(res)
        })
    })
}


/**
 * 动态列表
 */
export function getTrends(params){
    return new Promise((resolve)=>{
        params.act = 'appTeamChat';
        params.callKeyName = 'getTrends';
        $post(`Microportal.Common.import`,[params]).then(res=>{
            resolve(res.getTrends)
        })
    })
}

/**
 * 动态详情
 */
export function getTopicDetail(params){
    return new Promise((resolve)=>{
        $post(`Team.Common.getTopicDetail`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 添加回复
 */
export function getTeamAddChat(params){
    return new Promise((resolve)=>{
        $post(`Team.Common.teamAddChat`,params).then(res=>{
            resolve(res)
        })
    })
}
/**
 * 发布动态
 */
export function teamAddTopic(params){
    return new Promise((resolve)=>{
        $post(`Team.Common.teamAddTopic`,params).then(res=>{
            resolve(res)
        })
    })
}
/**
 * 修改发布权限
 * 
 */
export function editJurisdiction(params){
    return new Promise((resolve)=>{
        $post(`Team.Common.editJurisdiction`,params).then(res=>{
            resolve(res)
        })
    })
}

/**
 * 修改昵称
 */
export function editRealName(params){
    return new Promise((resolve)=>{
        $post(`Team.Common.editRealName`,params).then(res=>{
            resolve(res)
        })
    })
}


/**
 * 个人中心 社群列表
 */
export function getMyTeamList(params){
    return new Promise((resolve)=>{
        $post(`Team.User.getMyTeamList`,params).then(res=>{
            resolve(res)
        })
    })
}


/**
 * 个人中心 我的评论列表
 */
export function getMyTeamChat(params){
    return new Promise((resolve)=>{
        $post(`Team.User.getMyTeamChat`,params).then(res=>{
            resolve(res)
        })
    })
}
/**
 *  个人中心 我的点赞列表
 */

export function getMyTeamZan(params){
    return new Promise((resolve)=>{
        $post(`Team.User.getMyTeamZan`,params).then(res=>{
            resolve(res)
        })
    })
}
/**
 * 点赞
 */

export function dianZan(params){
    return new Promise((resolve)=>{
        $post(`Team.Common.dianZan`,params).then(res=>{
            resolve(res)
        })
    })
}
/**
 * 添加社群
 */

export function teamAddMember(params){
    return new Promise((resolve)=>{
        $post(`Team.Common.teamAddMember`,params).then(res=>{
            resolve(res)
        })
    })
}


/**
 * 申请入群
 */
export function application(params){
    return new Promise((resolve)=>{
        $post(`Team.User.application`,params).then(res=>{
            resolve(res)
        })
    })
}
