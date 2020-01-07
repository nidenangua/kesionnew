import Vue from 'vue'
import Progress from './Progress'
let ProgressInstance;

Progress.showProgress = function(title, percentage) {
    if (!ProgressInstance) {
        const ProgressConstructor = Vue.extend(Progress);
        ProgressInstance = new ProgressConstructor();
        ProgressInstance.$mount(document.createElement('div'));
        document.body.appendChild(ProgressInstance.$el);
    }
    ProgressInstance.title = title
    ProgressInstance.percentage = percentage
    ProgressInstance.visible = true
}
Progress.hideProgress = function() {
    if (ProgressInstance) {
        ProgressInstance.visible = false
        ProgressInstance.percentage = 0
    }
}

export default Progress;