import { $post } from './main.entrance'
/**获取媒体key */
export function getLiveKey(params) {
    return new Promise(resolve => {
        $post('Live.getLiveKey', params, { isErrorCall: true }).then(res => {
            resolve(res)
        })
    })
}
/**获取聊天记录*/
export function getKeepChat(params) {
    return new Promise(resolve => {
        $post('Live.getKeepChat', params).then(res => {
            resolve(res)
        })
    })
}
/**获取学员信息*/
export function studentList(params) {
    return new Promise(resolve => {
        $post('Live.studentList', params).then(res => {
            resolve(res)
        })
    })
}
/**通过信令id数组获取学员信息*/
export function getStudentListBySID(params) {
    return new Promise(resolve => {
        $post('Live.getStudentListBySID', params).then(res => {
            resolve(res)
        })
    })
}


/**保存聊天消息*/
export function addChat(params) {
    return new Promise(resolve => {
        $post('Live.addChat', params).then(res => {
            resolve(res)
        })
    })
}
/**修改音频直播室配置*/
export function editLiveSetting(params) {
    return new Promise(resolve => {
        $post('Live.editLiveSetting', params).then(res => {
            resolve(res)
        })
    })
}
/**撤回消息*/
export function delChat(params) {
    return new Promise(resolve => {
        $post('Live.delChat', params).then(res => {
            resolve(res)
        })
    })
}

/**设置直播状态*/
export function liveStatus(params) {
    return new Promise(resolve => {
        $post('Live.liveStatus', params).then(res => {
            resolve(res)
        })
    })
}

/**阿里word、pdf转换为图片接口*/
export function courseware(params) {
    return new Promise(resolve => {
        $post('Live.courseware', params).then(res => {
            resolve(res)
        })
    })
}

/**学生加入/断开视频流*/
export function joinLive(params) {
    return new Promise(resolve => {
        $post('Live.joinLive', params).then(res => {
            resolve(res)
        })
    })
}

/**教师轮询请求（教师停止轮询，即表示意外断开，后端自动结算）*/
export function poll(params) {
    return new Promise(resolve => {
        $post('Live.poll', params).then(res => {
            resolve(res)
        })
    })
}
/**禁言 */
export function editBanned(params) {
    return new Promise(resolve => {
        $post('Live.editBanned', params).then(res => {
            resolve(res)
        })
    })
}
/**报名-表单信息收集 */
export function addApply(params) {
    return new Promise(resolve => {
        $post('Live.addApply', params).then(res => {
            resolve(res)
        })
    })
}
/**获取直播状态 */
export function getLiveStatus(params) {
    return new Promise(resolve => {
        $post('Live.getLiveStatus', params).then(res => {
            resolve(res)
        })
    })
}
/**用户心跳（检测是否在线） */
export function pollThousand(params) {
    return new Promise(resolve => {
        $post('Live.pollThousand', params).then(res => {
            resolve(res)
        })
    })
}