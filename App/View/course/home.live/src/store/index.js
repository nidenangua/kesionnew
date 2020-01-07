import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
import { getWxDetail } from '@/api/microportal'
const store = new Vuex.Store({
    state: {
        storeReady: false,
        info: {}
    },
    mutations: {
        /**
         * 设置State
         */
        setStoreState(state, data) {
            state.info = data.websiteInfo;
            state.storeReady = true
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
        }
    }
})

/**
 * 添加ready事件
 */
store.ready = function(callback) {
    if (this.state.storeReady) {
        callback(this.state);
    } else {
        setTimeout(() => {
            this.ready(callback)
        }, 100)
    }
}
store.dispatch('updateStoreState')
export default store