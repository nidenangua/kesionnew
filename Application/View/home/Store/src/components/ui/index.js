import box from './box'
import container from './container'
import createBg from './create-bg'
import editor from './editor'
import image from './image'
import inputNumber from './input-number'
import loading from './loading'
import progress from './progress'
import tableFooter from './table-footer'
import tipsDialog from './tips-dialog'
import title from './title'
const components = {
    install(Vue) {
        Vue.use(box)
        Vue.use(container)
        Vue.use(createBg)
        Vue.use(editor)
        Vue.use(image)
        Vue.use(inputNumber)
        Vue.use(loading)
        Vue.use(tableFooter)
        Vue.use(title)
    }
}
components.loading = loading;
components.progress = progress;
components.tipsDialog = tipsDialog;
export default components