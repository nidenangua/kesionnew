import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
import config from '${dir}/config'
import { getStoreInfo } from '@/api/store'
import { getUserInfo } from '@/api/user'
import { getParams } from '@/utils'
const store = new Vuex.Store({
    state: {
        /**小程序审核 */
        miniProgramReview: -1,
        /**
         * 店铺状态
         */
        storeInfoReady: false,
        module: [],
        moduleSwitch: [],
        is_register:false,
        is_rlogon:false,
        is_onloginbrowse:-1,
        info: {},
        headjson: {},
        footjson: {},
        configjson: [],
        style:{
            color:{}
        },
        stylecolor: null,
        /**会员状态 */
        userReady: false,
        /**用户登录状态 0未登录 1已登录 */
        isLogin: -1,
        userInfo: {},
        drag: false,
        temporaryData:{},
        contentmsg:null
        
    },
    mutations: {
        /**
         * 设置店铺基本信息
         */
        setStoreInfo(state, data) {
            let stylejson = JSON.parse(data.storeConfig.stylejson || '{}')
            // stylejson = {
            //     "id":4,
            //     "course_list_style":9,
            //     "color":{
            //         "primary":"#fd7d36",
            //         "page_background":"#F8F7FA",
            //         "background":"#F8F7FA",
            //         "primary_text":"#313033",
            //         "secondary_text":"#626166",
            //         "auxiliary_text":"#939199",
            //         "title":"#313033",
            //         "prompt":"#C6C4CC",
            //         "ornament":"#FF502D"
            //     }
            // }
            let _color = stylejson.color || {}
            
             /**更新当前风格颜色规范 */
            let style = {
                id: stylejson.id || 1,
                course_list_style:stylejson.course_list_style || 1,
                color:{
                    primary:_color.primary || '#E8553F', //主色
                    page_background:_color.page_background || '#f5f5f5', //页面背景
                    background:_color.background || '#f5f5f5', //背景色
                    primary_text:_color.primary_text || '#444444', //主要文字颜色
                    secondary_text:_color.secondary_text || '#666666', //次要文字颜色
                    auxiliary_text:_color.auxiliary_text || '#999999', //辅助文字颜色
                    title:_color.title || '#222222', //标题颜色
                    prompt:_color.prompt || '#aaaaaa', //辅助提示颜色
                    ornament:_color.ornament || '#E8553F', //点缀色
                }
            }
            let colorKeys = Object.keys(style.color)
            let varcss = ''
            colorKeys.map(k=>{
                varcss += `--${k}-color:${style.color[k]};`
            })
            varcss = `:root{${varcss}}`
            if(document.getElementById('COLOR_CONFIG')){
                document.getElementById('COLOR_CONFIG').innerHTML = varcss
            }else{
                let styleNode = document.createElement('style')
                styleNode.id = 'COLOR_CONFIG'
                let textNode = document.createTextNode(varcss)
                styleNode.appendChild(textNode)
                document.head.appendChild(styleNode)
            }
            state.style = style

            /**配置网校已开通的模块 */
            let arr = new Array();
            data.moduleSwitch.map(item => {
                if (item.isopen && item.type != 3 && item.type != 4 && item.type != 5) {
                    arr.push(item)
                }
            })
            arr.push({
                courseType: 6,
                isopen: true,
                name: "活动",
                type: 2
            })
            /**
             * 设置配置config
             */
            if (data.storeConfig.configjson && typeof data.storeConfig.configjson === 'string') {
                state.configjson = JSON.parse(data.storeConfig.configjson)
            }
            if (data.storeConfig.footjson && typeof data.storeConfig.footjson === 'string') {
                state.footjson = JSON.parse(data.storeConfig.footjson)
            }
            if (data.storeConfig.headjson && typeof data.storeConfig.headjson === 'string') {
                state.headjson = JSON.parse(data.storeConfig.headjson)
            }
            state.stylecolor = data.storeConfig.stylecolor
            state.module = arr
            state.moduleSwitch = data.moduleSwitch
            state.info = data.websiteInfo
            state.is_register = data.is_register
            state.is_rlogon = data.is_rlogon
            state.is_onloginbrowse = data.is_onloginbrowse ? 1 : 0
            state.is_wechatlogin = data.is_wechatlogin
            state.storeInfoReady = true
        },
        setTemporaryData(state,data = {}){
            state.temporaryData = {
                action:data.action,
                value:data.value,
                content:data.content,
                ticket:data.ticket,
                starttime:data.starttime,
                endtime:data.endtime
            }
        },
        setContentmsg(state,data) {
            state.contentmsg = data
        },
        /**
         * 设置状态
         */
        setState(state, data) {
            let keys = Object.keys(data)
            keys.map(k=>{
                state[k] = data[k]
            })
        }
    },
    actions: {
        /**
         * 更新店铺信息
         */
        updateStoreInfo(store) {
            return new Promise(resolve => {
                store.commit('setState', {
                    storeInfoReady: false
                })
                let routeParams = getParams();
                let params = {}
                if (routeParams.drag === 'on') {
                    store.commit('setState', {
                        drag: true
                    })
                    params.drag = 'on'
                } else {
                    store.commit('setState', {
                        drag:false
                    })
                }
                if (routeParams.temptype) {
                    params.type = routeParams.temptype;
                } else {
                    params.type = config.action === 'pc' ? 2 : 1;
                }
                getStoreInfo(params).then(res => {
                    store.commit('setStoreInfo', res)
                    resolve(store.state)
                })
            })
        },
        /**
         * 更新会员信息
         */
        updateUserInfo(store) {
            return new Promise(resolve => {
                store.commit('setState', {
                    userReady:false
                })
                getUserInfo().then(res => {
                    if (res.result === 'success') {
                        if(res.memberinfo.mobile){
                            let mobile = res.memberinfo.mobile
                            let encryptMobile = mobile.substr(0,3) + '****' + mobile.substr(7,10)
                            res.memberinfo.encrypt_mobile = encryptMobile
                        }else{
                            res.memberinfo.encrypt_mobile = '未绑定手机号'
                        }
                        res.memberinfo.is_mobile = res.is_mobile;
                        res.memberinfo.is_note = res.is_note;
                        res.memberinfo.is_teacher = res.is_teacher;
                        store.commit('setState', {
                            isLogin:1,
                            userInfo: res.memberinfo
                        })

                    } else {

                        store.commit('setState', {
                            isLogin:0,
                            userInfo: {}
                        })
                    }
                    store.commit('setState', {
                        userReady: true
                    })
                    resolve(res)
                })
            })
        },


    }
})

/**
 * 添加ready事件
 */
store.ready = function (callback) {
    if (this.state.storeInfoReady && this.state.userReady) {
        callback(this.state)
    } else {
        setTimeout(() => {
            this.ready(callback)
        }, 100)
    }
}

store.dispatch('updateStoreInfo').then(state => {
    if (state.info.wxid == 2 && window.__wxjs_environment === 'miniprogram') {
        store.commit('setState', {
            miniProgramReview: 1
        })
    } else {
        store.commit('setState', {
            miniProgramReview: 0
        })
    }
})
store.dispatch('updateUserInfo')
export default store