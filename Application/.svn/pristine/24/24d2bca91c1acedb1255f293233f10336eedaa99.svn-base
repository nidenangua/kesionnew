import Vue from 'vue';
import Preview from './Preview';
let PreviewInstance;
Preview.showPreview = function(imgList = [], index = 0) {
    if (!PreviewInstance) {
        const PreviewConstructor = Vue.extend(Preview)
        PreviewInstance = new PreviewConstructor()
        PreviewInstance.$mount(document.createElement('div'))
        document.body.appendChild(PreviewInstance.$el)
    }
    PreviewInstance.dataList = imgList
    PreviewInstance.current = parseInt(index) + 1
    PreviewInstance.swiperOption.initialSlide = index
    PreviewInstance.visible = true
}

Preview.setPreview = function(el) {
    let imgs = el.querySelectorAll('img')
    let imgArr = []
    for (var i = 0; i < imgs.length; i++) {
        let imgItem = imgs[i]
        imgArr.push({
            src: imgItem.src
        })
        imgItem.setAttribute('preview-index', i)
        imgItem.onclick = () => {
            this.showPreview(imgArr, imgItem.getAttribute('preview-index'))
        }
    }
}

export default Preview;