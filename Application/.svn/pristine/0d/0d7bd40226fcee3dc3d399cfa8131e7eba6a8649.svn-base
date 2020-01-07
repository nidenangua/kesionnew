import Masked from './Masked'
Masked.install = function(Vue) {
    const maskedConstructor = Vue.extend(Masked)
    const maskedInstance = new maskedConstructor()
    maskedInstance.$mount(document.createElement('div'))
    document.body.appendChild(maskedInstance.$el);
    Vue.prototype.$showMask = function(params = {}) {
        maskedInstance.maskList.push(params)
    }
    Vue.prototype.$hideMask = function() {
        maskedInstance.maskList.splice(maskedInstance.maskList.length - 1, 1)
    }
}

export default Masked