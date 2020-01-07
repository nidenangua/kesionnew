import 'swiper/dist/css/swiper.css'
import { swiper, swiperSlide } from 'vue-awesome-swiper'
const Swiper = {
    /* install component */
    install(Vue) {
        Vue.component('KsSwiper', swiper)
        Vue.component('KsSwiperSlide', swiperSlide)
    }
}
export default Swiper