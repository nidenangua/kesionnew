import Vue from 'vue'
import TipsDialog from './TipsDialog'
let TipsDialogInstance;
TipsDialog.showTipsDialog = function(content, params) {
    if (!TipsDialogInstance) {
        const TipsDialogConstructor = Vue.extend(TipsDialog);
        TipsDialogInstance = new TipsDialogConstructor();
        TipsDialogInstance.$mount(document.createElement('div'));
        document.body.appendChild(TipsDialogInstance.$el);
    }
    TipsDialogInstance.visible = true
    TipsDialogInstance.content = content
    TipsDialogInstance.params = params
}
export default TipsDialog