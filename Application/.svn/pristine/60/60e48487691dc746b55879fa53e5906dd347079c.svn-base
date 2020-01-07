import Vue from 'vue'
import UploadVod from './UploadVod'
let UploadVodInstance
UploadVod.upload = function(options){
    if(!UploadVodInstance){
        let UploadVodConstructor = Vue.extend(UploadVod)
        UploadVodInstance = new UploadVodConstructor()
        UploadVodInstance.$mount(document.createElement('div'))
        document.body.appendChild(UploadVodInstance.$el)
    }
    UploadVodInstance.uploadVideoFile(options)
}
export default UploadVod