import Vue from 'vue'
import ActionSheet from './ActionSheet'
let actionSheetInstance;
ActionSheet.showActionSheet = function(params = {}) {
    return new Promise(resolve => {
        if (!actionSheetInstance) {
            const actionSheetConstructor = Vue.extend(ActionSheet)
            actionSheetInstance = new actionSheetConstructor()
            actionSheetInstance.$mount(document.createElement('div'))
            document.body.appendChild(actionSheetInstance.$el);
        }
        actionSheetInstance.visible = true
        actionSheetInstance.list = params.list || []
        actionSheetInstance.change = (info) => {
            actionSheetInstance.visible = false
            resolve(info)

        }
    })
}
export default ActionSheet