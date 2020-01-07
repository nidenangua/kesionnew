import AliOSS from './AliOSS'
const ossUpload = {
    install(Vue) {
        const OSS = Vue.extend(AliOSS)
        const OSSModel = new OSS()
        OSSModel.$mount(document.createElement('div'))
        document.body.appendChild(OSSModel.$el)

        Vue.prototype.$aliUpload = function (params) {
            OSSModel.start(params)
        }
    }
}

export default ossUpload