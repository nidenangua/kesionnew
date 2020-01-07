/**
 * 引入微信js sdk
 */
import store from '@/store'
import weixinJsSDK from 'weixin-js-sdk'
import { getWechatConfig } from '@/api/store'

export const wx = weixinJsSDK
/**
 * 微信分享
 */
export const wxShare = basicinfo => {
    getWechatConfig({
        url: location.href.split('#')[0]
    }).then(res => {
        if (!res) {
            return false
        }
        /** 配置微信基本信息 */
        wx.config({
            debug: false,
            appId: res.appId,
            timestamp: res.timestamp,
            nonceStr: res.nonceStr,
            signature: res.signature,
            jsApiList: [
                'onMenuShareAppMessage', 'onMenuShareTimeline', 'onMenuShareQQ'
            ]
        })
        wx.ready(() => {
            let link = basicinfo.link || location.href
            store.ready(state=>{
                let href = link.split('#')[0]
                if(href.indexOf('?') === -1){
                    href += `?inviter=${state.info.userid}`
                }else{
                    href += `&inviter=${state.info.userid}`
                }
                if(link.split('#')[1]){
                    href += '#'+link.split('#')[1]
                }
                basicinfo.link = href
                wx.onMenuShareAppMessage(basicinfo)
                wx.onMenuShareTimeline(basicinfo)
                wx.onMenuShareQQ(basicinfo)
            })
           
        })
    })
}
