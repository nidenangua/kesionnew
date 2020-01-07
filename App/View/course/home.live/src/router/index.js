import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

export default new Router({
    routes: [{
            path: '/videolive',
            name: 'VideoLive',
            component: resolve => {
                require(['@/pages/video-live/Index.vue'], resolve)
            }
        },
        {
            path: '/audiolive',
            name: 'AudioLive',
            component: resolve => {
                require(['@/pages/audio-live/Index.vue'], resolve)
            }
        },
        {
            path: '/endlive',
            name: 'EndLive',
            component: resolve => {
                require(['@/pages/video-live/EndLive.vue'], resolve)
            }
        }
    ]
})