import axios from 'axios'
import main from '${dir}/main'
import { getParams } from '@/utils'

/**
 * 错误处理
 */
function dealError(res, key) {

    if (key === 'getUserInfo' || key === 'getMyPurchase') {
        return true
    }
    switch (res.code) {
        case 'nologin':
            if (main.action === 'PC') {
                main.$showLogin()
            } else {
                main.$toast('请先登录').then(() => {
                    main.$router.push({
                        name: 'UserLogin'
                    })
                })
            }
            break
        case 'notfound':
            main.$toast(res.msg).then(() => {
                history.back()
            })
            break
        default:
            main.$toast(res.msg)
    }

}

export function $post(act, params = {}, config = {}) {
    return new Promise((resolve) => {
        let wxid = getParams().wxid
        let applet_token = getParams().applet_token
        let h5token = getParams().h5token
        if (wxid) {
            wxid = '&wxid=' + wxid
        } else {
            wxid = ''
        }
        if(h5token){
            applet_token = '&h5token=' + h5token
        }else if (applet_token) {
            applet_token = '&applet_token=' + applet_token
        } else {
            applet_token = ''
        }
        let url = config.isFullUrl ? act : `/Json/index.php?act=${act}${wxid}${applet_token}`;
        let other = {};
        if (config.headers === 'form') {
            other = {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }
        }
        axios.post(url, params, other).then(res => {

                let keys = act.match(/\w+/g);
                let key = keys[keys.length - 1];
                res = res.data[key] ? res.data[key] : res.data;
                if (config.isErrorCall) {
                    resolve(res)
                } else {
                    if (res.result === 'error') {
                        if (dealError(res, key)) {
                            resolve(res)
                        }

                    } else {
                        resolve(res)
                    }
                }
            })
            .catch(error => {
                console.error(error)
            })
    })
}


export function $get(act, params = {}, config = {}) {

    return new Promise(resolve => {
        let wxid = getParams().wxid
        let applet_token = getParams().applet_token
        if (wxid) {
            params.wxid = wxid
        }
        let h5token = getParams().h5token
        if(h5token){
            applet_token = '&h5token=' + h5token
        }else if (applet_token) {
            applet_token = '&applet_token=' + applet_token
        } else {
            applet_token = ''
        }
        let _params = {
            "params": params
        }
        let url = config.isFullUrl ? act : `/Json/index.php?act=${act}${applet_token}`;
        axios.get(url, _params).then(res => {
                let keys = act.match(/\w+/g);
                let key = keys[keys.length - 1];
                res = res.data[key] ? res.data[key] : res.data;

                if (config.isErrorCall) {
                    resolve(res)
                } else {
                    if (res.result === 'error') {
                        if (dealError(res, key)) {
                            resolve(res)
                        }

                    } else {
                        resolve(res)
                    }
                }
            })
            .catch(error => {
                console.error(error)
            })
    })
}