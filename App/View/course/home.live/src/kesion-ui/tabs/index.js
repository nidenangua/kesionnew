import Tabs from './Tabs'
import TabPane from './TabPane'
const tabs = {
    install(Vue){
        Vue.component('KsTabs',Tabs)
        Vue.component('KsTabPane',TabPane)
    }
}
export default tabs