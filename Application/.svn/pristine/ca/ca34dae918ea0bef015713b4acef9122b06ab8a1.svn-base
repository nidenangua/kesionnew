import Vue from 'vue'
import ShareBg from './ShareBg';
let ShareBgInstance;
ShareBg.showShareBg = function(type) {
    if (!ShareBgInstance) {
        const ShareBgConstructor = Vue.extend(ShareBg)
        ShareBgInstance = new ShareBgConstructor()
        ShareBgInstance.$mount(document.createElement('div'))
        document.body.appendChild(ShareBgInstance.$el)
    }
    ShareBgInstance.type = type || ''
    ShareBgInstance.shareFlag = true
}
ShareBg.hideShareBg = function() {
    if (ShareBgInstance) {
        ShareBgInstance.shareFlag = false
    }
}
export default ShareBg;