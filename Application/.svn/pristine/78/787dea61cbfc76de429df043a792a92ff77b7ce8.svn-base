// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from '@/store'
import VeLine from 'v-charts/lib/line.common'
import Distpicker from 'v-distpicker'
Vue.component('v-distpicker', Distpicker)
/**
 * 安装组件
 */
import './components/ui/kesion-ui.css'
import KS_UI from './components/ui'
import StoreComponents from './components/store'
import OrderPay from './components/order-pay'
import ShareBg from './components/share-bg'
import DragComponents from './components/drag-ui'

/**
 * vant时间选择器
 */
import { Popup,DatetimePicker,DropdownMenu, DropdownItem,Overlay } from 'vant';
Vue.use(Popup)
Vue.use(DatetimePicker);
Vue.use(Overlay);
Vue.use(DropdownMenu).use(DropdownItem);
import 'vant/lib/index.css';


/**
 * 阿里云上传（用于图片、音频上传）
 */
import AliOSS from '@/plugins/alioss'
/**
 * 微信js sdk （用于微信分享）
 */
import {wx,wxShare} from '@/plugins/wxjs'
Vue.use(KS_UI)
Vue.prototype.$actionSheet = KS_UI.ActionSheet.showActionSheet;
Vue.prototype.$confirm = KS_UI.Confirm.showConfirm;
Vue.prototype.$alert = KS_UI.Confirm.showAlert;
Vue.prototype.$preview = KS_UI.Preview.showPreview;
Vue.prototype.$setPreview = KS_UI.Preview.setPreview;
Vue.prototype.$showLoading = KS_UI.Toast.showLoading;
Vue.prototype.$hideLoading = KS_UI.Toast.hideLoading;
Vue.prototype.$toast = KS_UI.Toast.showToast;
Vue.prototype.$msg = KS_UI.Toast.showToast;
Vue.prototype.$showPay = OrderPay.showPay;
Vue.prototype.$hidePay = OrderPay.hidePay;
Vue.prototype.$pay = OrderPay.pay;
Vue.prototype.$showShareBg = ShareBg.showShareBg;
Vue.prototype.$hideShareBg = ShareBg.hideShareBg;
Vue.prototype.$wxShare = wxShare
Vue.prototype.$wx = wx;
Vue.use(DragComponents)
Vue.use(StoreComponents)
Vue.use(AliOSS)
Vue.config.productionTip = false
Vue.component(VeLine.name, VeLine)

/**
 * 数组遍历 (增加遍历条件，避免报错)
 * @param {Array} arr
 * @param {Function} fn
 */
Vue.prototype.$map = function(arr, fn) {
    if (arr && arr.length) {
        arr.map((item, i) => {
            if (typeof fn === 'function') {
                fn(item, i)
            }
        })
    } else {
        return
    }
}
/**
 * 防复制
 * @param {Boolean} 
 */
Vue.prototype.$antiCopy = function(flag) {
    let antiCopyStyle = document.getElementById('antiCopyStyle');
    let body = document.body;
    if (flag && !antiCopyStyle) {
        let style = document.createElement('style');
        style.id = "antiCopyStyle";
        let css = document.createTextNode('*{-webkit-touch-callout:none; -webkit-user-select:none;-khtml-user-select:none; -moz-user-select:none; -ms-user-select:none;   user-select:none;}input{ -webkit-user-select: auto;}img{  -webkit-user-select: none;-moz-user-select: none; -webkit-user-select:none; -o-user-select:none; user-select:none;}');
        style.appendChild(css);
        body.appendChild(style);
        body.addEventListener('contextmenu', antiCopyFn)
        body.addEventListener('dragstart', antiCopyFn)
        body.addEventListener('selectstart', antiCopyFn)
    } else if (!flag && antiCopyStyle) {
        antiCopyStyle.remove()
        body.removeEventListener('contextmenu', antiCopyFn)
        body.removeEventListener('dragstart', antiCopyFn)
        body.removeEventListener('selectstart', antiCopyFn)
    }
}

function antiCopyFn() {
    return false
}

/**
 * 路由返回，与小程序做兼容
 */
Vue.prototype.$navigateBack = function(delta = 1) {
    if (window.__wxjs_environment === 'miniprogram') {
        wx.miniProgram.navigateBack({
            delta: delta
        })
    } else {
        history.back(-delta)
    }
}



/**
 * 导航守卫
 */
router.beforeEach((to, from, next) => {
    /**
     * 判断是否是在微信小程序环境
     */
    if (window.__wxjs_environment === 'miniprogram') {
        if (to.query.miniprogram == 1) {
            next()
        } else if (to.name === 'FriendDetails') {
            store.ready(state => {
                wx.miniProgram.navigateTo({
                    url: '/pages/friend/detail/detail?wxid=' + state.info.wxid + '&id=' + to.params.id
                })
            })
        } else {
            store.ready(state => {
                let url = encodeURIComponent('#' + to.fullPath)
                if (to.name === 'ConfirmTicket' || to.name === 'PayResult') {
                    wx.miniProgram.redirectTo({
                        url: '/pages/web/web?wxid=' + state.info.wxid + '&url=' + url
                    })
                } else {
                    wx.miniProgram.navigateTo({
                        url: '/pages/web/web?wxid=' + state.info.wxid + '&url=' + url
                    })
                }
            })
        }
    } else {
        next()

    }
})


/**
 * 创建vue实例
 */
const main = new Vue({
    el: '#app',
    router,
    store,
    components: { App },
    template: '<App/>'
})
export default main