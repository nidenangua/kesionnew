import { $post, $get } from './main.entrance'

/**
 * 个人会员 我的已购
 */
export function getMyPurchase(params) {
    return $get(`Users.getMyPurchase`, params)
}

/**
 * 个人会员 我的订单
 */
export function getUserCourseOrder(params) {
    return $get(`Users.getOrderList`, params)

}

/**
 * 个人会员 订单详情
 */
export function getOrderDetail(params) {
    return $get(`Users.getOrderDetail`, params)

}

/**
 * 个人会员 删除订单
 */
export function deleteOrder(params) {
    return $get(`Users.delOrder`, params)

}

/**
 * 申请退款
 */
export function refundOrder(params) {
    return $get(`Users.Common.refundOrder`, params)

}


/**
 * 我的优惠券
 */
export function getUserVouceher(params) {
    return $post(`Users.myVoucherList`, params)

}

/**
 * 领取优惠券
 */
export function getVoucher(params) {
    return $post(`Users.getVoucher`, params)

}

/**
 * 赠送记录
 */
export function getGiftRecord(params) {
    return $post(`Users.myGiftList`, params)

}


/**
 * 获取礼物信息
 */
export function getGiftShare(params) {
    return $post(`Users.getGiftShare`, params)

}

/**
 * 领取赠礼
 */
export function receiveGifts(params) {
    return $post(`Users.receiveGifts`, params)

}

/**
 * 个人会员 我的消息
 */
export function getInformationList(params) {
    return $post(`Users.getInformationList`, params)

}

/**
 * 个人会员 我的消息详情
 */
export function getInformationDetail(params) {
    return $post(`Users.getInformationDetail`, params)

}


/**
 * 我的公告
 */
export function getNoticeList(params) {
    return $post(`Users.getNoticeList`, params)

}

/**
 * 公告详情
 */
export function getNoticeDetail(params) {
    return $post(`Users.getNoticeDetail`, params)

}

/**
 * 获取消息数量
 */
export function getMessageNum(params) {
    return $post(`Users.getMessageNum`, params, {
            isErrorCall: true
        })

}


/**
 * 基本信息
 */
export function getUserInfo(params) {
    return $post(`Users.getUserInfo`, params)

}

/**
 * 个人设置
 */
export function savePersonMsg(params) {
    return $post(`Users.savePersonMsg`, params)

}


/**
 * 修改头像
 */
export function changeHead(params) {
    return $post(`Users.changeHead`, params, {
            headers: 'form'
        })

}

/**
 * 获取我的优惠券，带账户余额
 */
export function getUserWealth(params) {
    return $post(`Users.getUserWealth`, params)

}

/**
 * 用户登录
 */
export function checkLogin(params) {
    return $post(`Users.Common.checkLogin`, params)

}
/**
 * 用户退出
 */
export function loginOut(params) {
    return $post(`Users.Common.loginOut`, params)

}
/**
 * 获取会员卡列表
 */
export function getUserCards(params) {
    return $post(`Users.getUserGroupList`, params)

}

/**获取微信扫码登录状态 */
export function doPcLogin(params, config) {
    return $post('Users.doPcLogin', params, config)
}

/**手机登录成功发送通知 */
export function doPhoneLogin(params) {
    return $post('Users.doPhoneLogin', params)
}


/**扫描微信二维码 */
export function scanQrCode(params) {
    return $post('Users.scanQrCode', params)
}

/** 课程进度显示 */
export function showCourse(params) {
    return $post('Users.showCourse', params,{
            isErrorCall:true
        })
}

/**课时进度写入 */
export function chapterRate(params) {
    return $post('Users.chapterRate', params,{
            isErrorCall:true
        })
}

/**五分钟更新 */
export function updateCourse(params) {
    return $post('Users.updateCourse', params,{
            isErrorCall:true
        })
}

/**发送短信验证码 */
export function register(params) {
    return $post('Users.register', params)
}

/**发送短信验证码 */
export function sendSms(params) {
    return $post('Users.sendSms', params)
}

/**绑定手机 */
export function popupMobile(params) {
    return $post('Users.popupMobile', params)
}
/**确认收货 */
export function confirmReceip(params) {
    return $post('Microportal.confirmReceip', params)
}
/**修改价格 */
export function editPrice(params) {
    return $post('Microportal.editPrice', params)
}
/**确认支付 */
export function orderPayment(params) {
    return $post('Microportal.orderPayment', params)
}
/**确认发货 */
export function mallSend(params) {
    return $post('Microportal.mallSend', params)
}
/**提现管理 */
export function cashManage(params) {
    return $post('Users.cashManage', params)
}
/**提现 */
export function carryCash(params) {
    return $post('Users.carryCash', params)
}
/**实名认证 */
export function dorealName(params) {
    return $post('Home.dorealName', params)
}
/**实名认证 */
export function saveTeacher(params) {
    return $post('Home.saveTeacher', params)
}
/**收入明细 */
export function payLog(params) {
    return $post('Users.payLog', params)
}

/**查看网校子账号 */
export function showSub(params) {
    return $post('Users.showSub', params)
}
/**查看角色列表 */
export function roleList(params) {
    return $post('Users.roleList', params)
}
/**子账号管理列表 */
export function subAccount(params) {
    return $post('Users.subAccount', params)
}
/**子账号删除 */
export function delAccount(params) {
    return $post('Users.delAccount', params)
}
/**是否启用子账号 */
export function isEnable(params) {
    return $post('Users.isEnable', params)
}
/**版本显示 */
export function showVersion(params) {
    return $post('Users.showVersion', params)
}
/**添加子账号 */
export function addAccount(params) {
    return $post('Users.addAccount', params)
}
/**学员管理 */
export function manageStudent(params) {
    return $post('Users.manageStudent', params)
}
/**学员审核 */
export function isExamine(params) {
    return $post('Users.isExamine', params)
}
/**学员分组 */
export function groupShow(params) {
    return $post('Users.groupShow', params)
}
/**版本支付 */
export function upVersion(params) {
    return $post('Users.upVersion', params)
}
/**版本支付 */
export function weChat(params) {
    return $post('Users.weChat', params)
}
/**导航列表 */
export function userPower(params) {
    return $post('Users.userPower', params)
}
/**VIP中心 */
export function vipInfo(params) {
    return $post('Users.vipInfo', params)
}
/**证书列表 */
export function getMyCertificate(params) {
    return new Promise(resolve => {
        $post('Users.getMyCertificate', params).then(res => {
            resolve(res)
        })
    })
}