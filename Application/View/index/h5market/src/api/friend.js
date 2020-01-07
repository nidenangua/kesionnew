import {$post} from './main.entrance'

// 话题列表

export function friendsList(params){
    return new Promise((resolve)=>{
        $post(`Social.getFriendsList`,params).then(res=>{
            resolve(res)
        })
    })
}

// 发表评论

export function friendsaddReply(params) {
    return new Promise((resolve)=>{
        $post(`Social.addReply`,params).then(res=>{
            resolve(res)
        })
    })
}

// 发表朋友圈

export function friendsaddFriends(params) {
    return new Promise((resolve)=>{
        $post(`Social.addFriends`,params).then(res=>{
            resolve(res)
        })
    })
}

// 删除朋友圈

export function friendsDel(params) {
    return new Promise((resolve)=>{
        $post(`Social.del`,params).then(res=>{
            resolve(res)
        })
    })
}

// 朋友圈点赞

export function friendsZan(params) {
    return new Promise((resolve)=>{
        $post(`Social.zan`,params).then(res=>{
            resolve(res)
        })
    })
}

// 话题详情

export function friendsDet(params) {
    return new Promise((resolve)=>{
        $post(`Social.getFriendsDetail`,params).then(res=>{
            resolve(res)
        })
    })
}

//消息列表

export function msgList(params) {
    return new Promise((resolve)=>{
        $post(`Social.getMyReplyList`,params).then(res=>{
            resolve(res)
        })
    })
}