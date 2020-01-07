import Banner from './banner'
import Carousel from './carousel'
import Course from './course'
import Group from './group'
import Nav from './nav'
import News from './news'
import Richtext from './richtext'
import Search from './search'
import StoreInfo from './store-info'
import Teacher from './teacher'
import Title from './title'
import BigTitle from './big-title'
import VipCard from './vip-card'
import TeacherIntro from './teacher-intro'
import Leaderboard from './leaderboard'
const components = {
    install(Vue) {
        Vue.use(Banner)
        Vue.use(BigTitle)
        Vue.use(Carousel)
        Vue.use(Course)
        Vue.use(Group)
        Vue.use(Nav)
        Vue.use(News)
        Vue.use(Richtext)
        Vue.use(Search)
        Vue.use(StoreInfo)
        Vue.use(Teacher)
        Vue.use(Title)
        Vue.use(VipCard)
        Vue.use(TeacherIntro)
        Vue.use(Leaderboard)
    }
}
export default components