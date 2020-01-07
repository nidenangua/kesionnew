import Vue from 'vue'
import SelectLink from './SelectLink'
let selectLinkInstance;

SelectLink.openSelectLinkBox = function(data, key = 'url') {
    if (!selectLinkInstance) {
        const selectLinkConstructor = Vue.extend(SelectLink);
        selectLinkInstance = new selectLinkConstructor();
        selectLinkInstance.$mount(document.createElement('div'));
        document.body.appendChild(selectLinkInstance.$el);
    }
    selectLinkInstance.visible = true;
    if (typeof data === 'function') {
        selectLinkInstance.callback = data
    } else {
        selectLinkInstance.callback = function(title, url) {
            data.title = title;
            data[key] = url
        }
    }
}
export default SelectLink;