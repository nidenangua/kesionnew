import Vue from 'vue'
import Toast from './Toast'
let toastInstance;

function createToastInstance() {
    if (!toastInstance) {
        const toastConstructor = Vue.extend(Toast)
        toastInstance = new toastConstructor()
        toastInstance.$mount(document.createElement('div'))
        document.body.appendChild(toastInstance.$el)
    }
}
Toast.showToast = function(msg, type = 'tips', duration = 1500) {
    return new Promise(resolve => {
        createToastInstance()
        toastInstance.duration = duration
        toastInstance.msg = msg
        toastInstance.show = true
        toastInstance.type = type
        setTimeout(() => {
            toastInstance.duration = 0
            toastInstance.show = false
            resolve()
        }, duration)
    })
}
Toast.showLoading = function(msg = '加载中') {
    createToastInstance()
    toastInstance.duration = 0
    toastInstance.msg = msg
    toastInstance.show = true
    toastInstance.type = 'loading'
}
Toast.hideLoading = function() {
    if (toastInstance && toastInstance.duration === 0) {
        toastInstance.show = false
    }
}

export default Toast