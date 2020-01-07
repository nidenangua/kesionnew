import Vue from 'vue'
import Loading from './Loading'
import PartLoading from './PartLoading'
let LoadingInstance;
/* install component */
Loading.install = function(Vue) {
    Vue.component(PartLoading.name, PartLoading)
}
Loading.showLoading = function() {
    if (!LoadingInstance) {
        const LoadingConstructor = Vue.extend(Loading);
        LoadingInstance = new LoadingConstructor();
        LoadingInstance.$mount(document.createElement('div'));
        document.body.appendChild(LoadingInstance.$el);
    }
    LoadingInstance.visible = true
}
Loading.hideLoading = function() {
    if (LoadingInstance) {
        LoadingInstance.visible = false
    }
}
export default Loading;