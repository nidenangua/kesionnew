import Vue from 'vue'
import Confirm from './Confirm'
let confirmInstance;
Confirm.showConfirm = function(msg, config = {}) {
    return new Promise(resolve => {
        if (!confirmInstance) {
            const confirmConstructor = Vue.extend(Confirm)
            confirmInstance = new confirmConstructor()
            confirmInstance.$mount(document.createElement('div'))
            document.body.appendChild(confirmInstance.$el);
        }
        this.$showMask({
            click: () => {
                confirmInstance.visible = false
                this.$hideMask()
            }
        })
        config.type = 'confirm'
        config.visible = true
        config.title = config.title || '提示'
        config.msg = msg
        let keys = Object.keys(config);
        keys.map(key=>{
            confirmInstance[key] = config[key]
        })
        confirmInstance.sure = (() => {
            confirmInstance.visible = false
            this.$hideMask()
            resolve()
        })
        confirmInstance.cancel = (() => {
            confirmInstance.visible = false
            this.$hideMask()
        })
    })
}
Confirm.showAlert = function(msg, config = {}) {
    return new Promise(resolve => {
        if (!confirmInstance) {
            const confirmConstructor = Vue.extend(Confirm)
            confirmInstance = new confirmConstructor()
            confirmInstance.$mount(document.createElement('div'))
            document.body.appendChild(confirmInstance.$el);
        }
        this.$showMask({
            click: () => {
                confirmInstance.visible = false
                this.$hideMask()
            }
        })
        config.type = 'alert'
        config.visible = true
        config.title = config.title || '提示'
        config.msg = msg
        let keys = Object.keys(config);
        keys.map(key=>{
            confirmInstance[key] = config[key]
        })
        confirmInstance.sure = (() => {
            confirmInstance.visible = false
            this.$hideMask()
            resolve()
        })
        
    })
}

export default Confirm