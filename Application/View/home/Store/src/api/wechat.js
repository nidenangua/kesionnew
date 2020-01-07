import { $post } from './main.entrance'
/**
 * 获取微信菜单
 */
export function getWechatMenu(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.getWechatMenu`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 修改微信栏目菜单
 */
export function saveWechatMenu(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.saveWechatMenu`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 删除微信栏目菜单
 */
export function deleteWechatMenu(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.deleteWechatMenu`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取微信消息关键词
 */
export function getWechatKeyWords(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.getWechatKeyWords`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 自动回复-添加关键词规则
 */
export function addWechatKeyWords(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.addWechatKeyWords`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 自动回复-修改关键词规则
 */
export function modifyWechatKeyWords(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.modifyWechatKeyWords`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 自动回复-删除关键词规则
 */
export function deleteWechatKeyWords(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.deleteWechatKeyWords`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 自动回复-修改自动回复开关
 */
export function setWechatKeyWordStatus(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.setWechatKeyWordStatus`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 自动回复-设置微信公众号的关注或回复
 */
export function setWechatReply(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.setWechatReply`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取微信公众号的关注或回复内容
 */
export function getWechatReply(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.getWechatReply`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 微信栏目上移动
 */
export function upWechatMenu(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.upWechatMenu`, params).then(data => {
            resolve(data)
        })
    })
}


/**
 * 微信栏目下移动
 */
export function downWechatMenu(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.downWechatMenu`, params).then(data => {
            resolve(data)
        })
    })
}


/**
 * 同步菜单到微信
 */
export function synchroWechatMenu(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.synchroWechatMenu`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取微信消息模板
 */
export function getWechatMsgTemplate(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.wechatMsgTemplate`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 微信消息模板启用与关闭
 */
export function wechatMsgTemplateOpen(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.wechatMsgTemplateOpen`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取微信素材列表
 */
export function wechatMaterialList(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.wechatMaterialList`, params).then(data => {
            resolve(data)
        })
    })
}


/**
 * 获取微信素材数量
 */
export function wechatMaterialCount(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.wechatMaterialCount`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取微信accessToken
 */
export function getWechatAccessToken(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.getWechatAccessToken`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 上传微信永久素材
 * 
 */
export function uploadWeachtMaterial(params) {
    return new Promise(resolve => {
        $post(`https://api.weixin.qq.com/cgi-bin/material/add_material`, params, false).then(data => {
            resolve(data)
        })
    })
}

/**
 * 删除微信素材
 */
export function deleteWechatMaterial(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.deleteWechatMaterial`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 更新微信素材到本地
 */
export function synchroMaterialList(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.synchroMaterialList`, params).then(data => {
            resolve(data)
        })
    })
}


/**
 * 获取微信公众号用户留言
 */
export function getManageList(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.getManageList`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 删除微信公众号用户留言
 */
export function delManageList(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.delManageList`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取与用户的详细聊天记录
 */
export function getReplyNews(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.getReplyNews`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 消息回复
 */
export function setReplyNews(params) {
    return new Promise(resolve => {
        $post(`WeChat.Store.setReplyNews`, params).then(data => {
            resolve(data)
        })
    })
}
