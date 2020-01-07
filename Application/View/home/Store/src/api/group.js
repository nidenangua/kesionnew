import { $post } from './main.entrance'

/**
 * 社群中心
 */
export function getGroupList(params) {
    return new Promise((resolve) => {
        params.act = 'appTeam';
        params.callKeyName = 'teamList';
        $post('Microportal.Common.import', [params]).then(data => {
            resolve(data.teamList)
        })

    })
}

/**
 * 社群详情
 */
export function getTeamDetail(params) {
    return new Promise((resolve) => {
        $post(`Team.Common.getTeamDetail`, params).then(data => {
            resolve(data)
        })

    })
}
/**
 * 社群动态列表
 */
export function getTeamTopicList(params) {
    return new Promise((resolve) => {
        params.act = 'appTeamTopic';
        params.callKeyName = 'teamList';
        $post('Microportal.Common.import', [params]).then(data => {
            resolve(data.teamList)
        })

    })
}


/**
 * 社群成员列表
 */
export function getTeamMemberList(params) {
    return new Promise((resolve, reject) => {
        $post(`Team.store.getTeamMemberList`, params).then(data => {
            resolve(data)
        })
            .catch(error => {
                reject(error)
            })
    })
}

/**
 * 修改状态
 */
export function setStatus(params) {
    return new Promise((resolve, reject) => {
        $post(`Team.store.setStatus`, params).then(data => {
            resolve(data)
        })
            .catch(error => {
                reject(error)
            })
    })
}


/**
 * 删除评论跟动态
 */
export function teamDel(params) {
    return new Promise((resolve, reject) => {
        $post(`Team.store.teamDel`, params).then(data => {
            resolve(data)
        })
            .catch(error => {
                reject(error)
            })
    })
}


/**
 * 动态列表
 */
export function getTrends(params) {
    return new Promise((resolve, reject) => {
        params.act = 'appTeamChat';
        params.callKeyName = 'chatlist';
        $post(`Microportal.Common.import`, [params]).then(data => {
            resolve(data.chatlist)
        })
            .catch(error => {
                reject(error)
            })
    })
}

/**
 * 动态详情
 */
export function getTopicDetail(params) {
    return new Promise((resolve, reject) => {
        $post(`Team.store.getTopicDetail`, params).then(data => {
            resolve(data)
        })
            .catch(error => {
                reject(error)
            })
    })
}

/**
 * 社群申请列表
 */

export function applicationList(params) {
    return new Promise((resolve, reject) => {
        $post(`Team.store.applicationList`, params).then(data => {
            resolve(data)
        })
            .catch(error => {
                reject(error)
            })
    })
}

/**
 * 打开关闭群，拉黑
 */

export function updateStatus(params) {
    return new Promise((resolve, reject) => {
        $post(`Team.store.updateStatus`, params).then(data => {
            resolve(data)
        })
            .catch(error => {
                reject(error)
            })
    })
}

/**
 * 申请通过/驳回
 */

export function checkMember(params) {
    return new Promise((resolve, reject) => {
        $post(`Team.store.checkMember`, params).then(data => {
            resolve(data)
        })
            .catch(error => {
                reject(error)
            })
    })
}
/**
 * 设置群主
 */


export function setRole(params) {
    return new Promise((resolve, reject) => {
        $post(`Team.store.setRole`, params).then(data => {
            resolve(data)
        })
            .catch(error => {
                reject(error)
            })
    })
}

/**
 * 添加成员
 */
export function showMemberList(params) {
    return new Promise((resolve, reject) => {
        $post(`Team.store.showMemberList`, params).then(data => {
            resolve(data)
        })
            .catch(error => {
                reject(error)
            })
    })
}

/**
 * 提交成员信息
 */
export function teamAddMember(params) {
    return new Promise((resolve, reject) => {
        $post(`Team.store.teamAddMember`, params).then(data => {
            resolve(data)
        })
            .catch(error => {
                reject(error)
            })
    })
}
