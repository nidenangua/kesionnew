// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'
/**阿里图片上传 */
import AliOSS from '@/plugins/alioss'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import KetangjieUI from './components/ui'
import SelectLink from './components/select-link'
/**瀑布流 */
import { VueMasonryPlugin } from 'vue-masonry'
import UploadVod from './components/upload-vod'

Vue.config.productionTip = true

Vue.use(ElementUI)
Vue.use(KetangjieUI)
Vue.use(AliOSS)
Vue.use(VueMasonryPlugin)

/**显示加载效果 */
Vue.prototype.$showLoading = KetangjieUI.loading.showLoading

/**隐藏加载效果 */
Vue.prototype.$hideLoading = KetangjieUI.loading.hideLoading

/**打开进度条 */
Vue.prototype.$showProgress = KetangjieUI.progress.showProgress

/**关闭进度条 */
Vue.prototype.$hideProgress = KetangjieUI.progress.hideProgress

/**信息提示对话框 */
Vue.prototype.$tipsDialog = KetangjieUI.tipsDialog.showTipsDialog

/**打开链接选择窗口 */
Vue.prototype.$selectLink = SelectLink.openSelectLinkBox

Vue.prototype.$uploadVod = UploadVod.upload

window.KS_UploadVideoFile = UploadVod.upload

/**
 * 消息提示
 * @param {String} 消息内容
 * @param {String} 消息类型 success | info | error | warning
 */
Vue.prototype.$msg = function (msg, _type) {
    return new Promise(resolve => {
        if (_type) {
            this.$message({
                message: msg,
                type: _type
            })
        } else {
            this.$message.error(msg)
        }
        setTimeout(() => {
            resolve()
        }, 1500)
    })
}

/**
 * 图片上传
 * @param {Object,function} 传入对象，上传成功后会根据key值改变对象图片地址的值；传入函数，则将图片信息以对象形式回调
 * @param {String} 对象的key值，默认是src
 */
Vue.prototype.$uploadImages = function (data, key = 'src',type) {
    this.$store.ready(state => {
        this.$aliUpload({
            wxid: state.info.wxid,
            type,
            uploaded: info => {
                if (typeof data === 'function') {
                    data(info)
                } else {
                    data[key] = info.defaultpic
                }
            }
        })
    })
}


/**
 * 根据key获取菜单权限信息
 * @param {String} key 
 */
Vue.prototype.getMenuAuthorityByKey = function (key) {
    return new Promise(resolve => {
        this.$store.ready(state => {
            let menu = state.menu;
            let itemInfo = {};
            menu.map(item => {
                if (item.key === key) {
                    itemInfo = item;
                } else if (item.subtopic && item.subtopic.length) {
                    item.subtopic.map(child => {
                        if (child.key === key) {
                            itemInfo = child;
                        }
                    })
                }
            })
            resolve(itemInfo)
        })
    })
}

/**
 * 复制链接
 * @param {String} 页面dom id
 */
Vue.prototype.$copyUrl = function (id) {
    var Url = document.getElementById(id);
    /**选择对象 */
    Url.select();
    /**执行浏览器复制命令 */
    document.execCommand("Copy");
    this.$msg("复制成功！您可在微信或浏览器打开", 'success')
}

/**
 * 授权认证
 */
Vue.prototype.$checkpower = function () {
    return new Promise(resolve => {
        this.$store.ready(state => {
            let msg;
            /**1、2 vip版本 100体验版本 */
            if (state.info.version == 1 || state.info.version == 2 || state.info.version == 3 || state.info.version == 100) {
                resolve();
            } else if (state.info.version == 0) {
                msg = '该功能需要在开通高级运营版基础上方可使用,建议尽快升级至高级运营版!';
            } else if (state.info.version == -2) {
                msg = '该功能需要在开通高级运营版基础上方可使用。<br/>您的试用期已过，建议尽快升级至高级运营版，升级后可继续使用该功能。';
            } else if (state.info.version == -1) {
                msg = '该功能需要在开通高级运营版基础上方可使用。<br/>您的版本已过期，续费后可继续使用该功能。';
            }
            if (msg) {
                this.$tipsDialog(msg, {
                    buttons: [{
                        name: '前往开通',
                        type: 'primary',
                        url: '/home.html/default/Service/upgrade'
                    }]
                })
            }
        })
    })

}

window.KS = {
    rearr:(val)=>{
        return val || []
    },
    rebl:(val)=>{
        return val == 0 ? false : true
    },
    restr:(val)=>{
        return val || ''
    },
    reobj:(val)=>{
        return val || {}
    }
}
/**
 * 添加全局方法 
 */
window.KTJ_RouteJump = (url) => {
    if (url.indexOf('/home.html') !== -1) {
        KTJ_FrameRouteJump(url)
    } else {
        router.push(url)
    }
}
window.KTJ_FrameRouteJump = (_url) => {
    router.push({
        path: '/',
        query: {
            url: _url
        }
    })
}

window.KTJ_TipsDialog = KetangjieUI.tipsDialog.showTipsDialog

/**
 * 创建vue对象
 */
const Main = new Vue({
    el: '#app',
    router,
    store,
    components: { App },
    template: '<App/>'
})

export default Main