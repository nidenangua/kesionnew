// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import store from '@/store'
import Vue from 'vue'
import App from './App'
import router from './router'
import './assets/reset/reset.css'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
/**支付方法 */
import OrderPay from './components/order-pay'
/**用户扫码登录 */
import LoginQrcode from './components/login-qrcode'
/**ui components */
import KesionUI from './components/ui'
/**drag components */

import KesionDragUI from './components/drag'

Vue.use(ElementUI)
Vue.use(KesionUI)
Vue.use(KesionDragUI)
Vue.config.productionTip = false
Vue.prototype.$showPay = OrderPay.showPay
Vue.prototype.$pay = OrderPay.pay
Vue.prototype.$order = OrderPay.order
Vue.prototype.$showLogin = LoginQrcode.showLogin
let Loading;
Vue.prototype.$showLoading = function(id) {
    Loading = this.$loading({
        lock: true,
        background: 'rgba(255, 255, 255, 0.7)'
            //target: id
    });
};
Vue.prototype.$hideLoading = function() {
    if (Loading) {
        Loading.close()
    }
}
Vue.prototype.$confirms = function(msg, tip = "提示", _type = "warning") {
    return new Promise(rosolve => {
        this.$confirm(msg, tip, {
            confirmButtonText: '确定',
            cancelButtonText: '取消',
            type: _type
        })
    })
}
function msg(msg, _type = 'error', _duration = 2000) {
    return new Promise(rosolve => {
        this.$message({
            message: msg,
            type: _type,
            duration: _duration
        });
        setTimeout(() => {
            rosolve()
        }, _duration)
    })
}
Vue.prototype.$msg = msg
Vue.prototype.$toast = msg

/**
 * 防复制
 */
function antiCopyFn() {
    return false
}
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
const main = new Vue({
    el: '#app',
    router,
    store,
    components: { App },
    template: '<App/>'
})
main.action = 'PC'
export default main