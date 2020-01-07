import { $post } from './main.entrance'
/**验证打赏订单是否有效 */
export function checkOrdersn(params) {
    return new Promise(resolve => {
        $post('Microportal.checkOrdersn', params, {
            isErrorCall: true
        }).then(res => {
            resolve(res)
        })
    })
}

/**
 * 活动报名表单提交
 */
export function addSign(params) {
    return new Promise((resolve) => {
        $post(`Microportal.addSign`, params).then(res => {
            resolve(res)
        })
    })
}

/**查看票券 */
export function getTicketDetail(params) {
    return new Promise((resolve) => {
        $post(`Microportal.getTicketDetail`, params).then(res => {
            resolve(res)
        })
    })
}

/**我的活动列表 */
export function getActivityList(params) {
    return new Promise((resolve) => {
        $post(`Microportal.getActivityList`, params).then(res => {
            resolve(res)
        })
    })
}

/**取消报名 */
export function delSign(params) {
    return new Promise((resolve) => {
        $post(`Microportal.delSign`, params).then(res => {
            resolve(res)
        })
    })
}

/**删除订单 */
export function delSignOrder(params) {
    return new Promise((resolve) => {
        $post(`Microportal.delSignOrder`, params).then(res => {
            resolve(res)
        })
    })
}

/**取消签到/设置签到 */
export function activitySignStatus(params) {
    return new Promise(resolve => {
        $post(`Microportal.activitySignStatus`, params).then(data => {
            resolve(data)
        })
    })
}

/**获取签到列表 */
export function activitySignList(params) {
    return new Promise(resolve => {
        $post(`Microportal.activitySignList`, params, { isErrorCall: true }).then(data => {
            resolve(data)
        })
    })
}

/**签到 */
export function activitySign(params) {
    return new Promise(resolve => {
        $post(`Microportal.activitySign`, params).then(data => {
            resolve(data)
        })
    })
}

/**获取订单支付状态 */
export function checkOrderPay(params) {
    return new Promise(resolve => {
        $post(`Microportal.checkOrderPay`, params, { isErrorCall: true }).then(data => {
            resolve(data)
        })
    })
}

/**验证订单限购 */
export function checkBuy(params) {
    return new Promise(resolve => {
        $post(`Microportal.checkBuy`, params, { isErrorCall: true }).then(data => {
            resolve(data)
        })
    })
}

/**面授手机端签到 */
export function faceSign(params) {
    return new Promise(resolve => {
        $post(`Microportal.faceSign`, params, { isErrorCall: true }).then(data => {
            resolve(data)
        })
    })
}

/** 免费面授报名 */
export function addTutorial(params) {
    return new Promise(resolve => {
        $post(`Microportal.addTutorial`, params).then(data => {
            resolve(data)
        })
    })
}

/** 直播类型加入学习 */
export function joinLearning(params) {
    return new Promise(resolve => {
        $post(`Microportal.joinLearning`, params).then(data => {
            resolve(data)
        })
    })
}

