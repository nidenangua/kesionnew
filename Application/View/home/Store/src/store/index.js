import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
import { getWxDetail } from '@/api/store'
import { getUserInfo } from '@/api/user'
const store = new Vuex.Store({
    state: {
        storeReady: false,
        userReady: false,
        switch_on: '#13ce66',
        switch_off: '#cccccc',
        /**店铺信息 */
        info: {},
        /**左侧管理菜单 */
        menu: [],
        /**账户下拉菜单 */
        accountMenu: [],
        /**是否登录 0 未登录 1 已登录 */
        isLogin: -1,
        /**个人信息 */
        userInfo: {}
    },
    mutations: {
        /**
         * 设置State
         */
        setStoreState(state, data) {
            if(data.websiteInfo.wechat_qrcode){
                data.websiteInfo.wechat_qrcode = data.websiteInfo.wechat_qrcode + '?'+Math.ceil(Math.random()*100000000)
            }
            state.info = data.websiteInfo;
            
            let menu = [];
            let accountMenu = [];
            if(data.getMenu.result !== 'error'){
                data.getMenu.map(item => {
                    if (item.type === 'left') {
                        menu.push(item)
                    } else if (item.type === 'top') {
                        accountMenu = item.subtopic
                    }
                })
            }
            state.menu = menu;
            state.accountMenu = accountMenu;
            state.storeReady = true
        },
        /**
         * 设置会员state
         */
        setUserState(state, res) {
            if (res.result === 'success') {
                state.isLogin = 1
                state.userInfo = res.memberinfo
            } else {
                state.isLogin = 0
                state.userInfo = {}
            }
            state.userReady = true
        }
    },
    actions: {
        /**
         * 更新机构State
         */
        updateStoreState(store, params) {
            return new Promise(resolve => {
                getWxDetail(params).then(res => {
                    store.commit('setStoreState', res)
                    resolve(store.state)
                })
            })
        },
        /**
         * 更新会员信息
         */
        updateUserState(store) {
            return new Promise(resolve => {
                getUserInfo().then(res => {
                    if(res.result === 'success'){
                        let rand = Math.ceil(Math.random() * 10000000000)
                        res.memberinfo.headimg = `${res.memberinfo.headimg}?${rand}`
                    }
                    store.commit('setUserState', res)
                    resolve(store.state.userInfo)
                })
            })
        }
    }
})

store.onStoreReady = function() {
    return new Promise(resolve=>{
        if(this.state.storeReady){
            resolve(this.state.info)
        }else{
            setTimeout(()=>{
                this.onStoreReady().then(info=>{
                    resolve(info)
                })
            },200)
        }
    })
}
store.ready = function(callback) {
    if (this.state.storeReady && this.state.userReady) {
        callback(this.state);
    } else {
        setTimeout(() => {
            this.ready(callback)
        }, 100)
    }
}
store.dispatch('updateStoreState')
store.dispatch('updateUserState')
export default store