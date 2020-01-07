// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'
import layer from 'vue-layer'
require('./kesion-ui/kesion-ui.css')
import KesionUI from './kesion-ui'
import AliOSS from '@/plugins/alioss'
Vue.prototype.$layer = layer(Vue);

Vue.use(KesionUI)
Vue.use(AliOSS)
Vue.config.productionTip = false

/**阻止冒泡 */
Vue.prototype.$stop = function(e) {
    e = window.event || e
    e.stopPropagation()
}

/**消息提示 */
Vue.prototype.$msg = function(msg) {
    this.$layer.msg(msg)
}

/**
 * 复制链接
 */
Vue.prototype.$copyUrl = function(id) {
    var Url = document.getElementById(id);
    Url.select(); //选择对象
    document.execCommand("Copy"); //执行浏览器复制命令
    this.$msg("复制成功！您可在微信或浏览器打开")

}
new Vue({
    el: '#app',
    store,
    router,
    components: { App },
    template: '<App/>'
})