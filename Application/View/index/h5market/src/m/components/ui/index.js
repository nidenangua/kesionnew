import ActionSheet from './action-sheet'
import Button from './button'
import Checkbox from './checkbox'
import Confirm from './confirm'
import Count from './count'
import CreateBg from './create-bg'
import Dialog from './dialog'
import Empty from './empty'
import Form from './form'
import Field from './field'
import Image from './image'
import Input from './input'
import List from './list'
import Masked from './masked'
import PageScrollContainer from './page-scroll-container'
import Popup from './popup'
import Preview from './preview'
import Radio from './radio'
import Swiper from './swiper'
import Switch from './switch'
import SelectCity from './select-city'
import Tab from './tab'
import Tabs from './tabs'
import Text from './text'
import Toast from './toast'
import Progress from './progress'
import SelectCate from './select-cate'

const components = {
    install(Vue) {
        Vue.use(Button)
        Vue.use(Checkbox)
        Vue.use(Count)
        Vue.use(CreateBg)
        Vue.use(Dialog)
        Vue.use(Empty)
        Vue.use(Form)
        Vue.use(Field)
        Vue.use(Image)
        Vue.use(Input)
        Vue.use(List)
        Vue.use(Masked)
        Vue.use(PageScrollContainer)
        Vue.use(Popup)
        Vue.use(Radio)
        Vue.use(Swiper)
        Vue.use(Switch)
        Vue.use(SelectCity)
        Vue.use(Tab)
        Vue.use(Tabs)
        Vue.use(Text)
        Vue.use(Progress)
        Vue.use(SelectCate)
    },
    ActionSheet,
    Confirm,
    Preview,
    Toast
}
export default components