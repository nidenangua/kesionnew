import Vue from 'vue'
import Router from 'vue-router'
import userRouters from './user'

Vue.use(Router)

let routes = [{ //首页
        path: '/',
        name: 'Index',
        component: resolve => {
            require(['@/pc/pages/Index.vue'], resolve)
        }
    },
    { //课程页列表
        path: '/course',
        name: 'CourseList',
        component: resolve => {
            require(['@/pc/pages/course/CourseList.vue'], resolve)
        }
    },
    { //专栏页列表
        path: '/column',
        name: 'ColumnList',
        component: resolve => {
            require(['@/pc/pages/course/CourseList.vue'], resolve)
        }
    },
    { //专栏页详情
        path: '/column/:id',
        name: 'ColumnDetail',
        component: resolve => {
            require(['@/pc/pages/column/ColumnDetail.vue'], resolve)
        }
    },
    { //教师列表
        path: '/teacher',
        name: 'Teacher',
        component: resolve => {
            require(['@/pc/pages/teacher/Teacher.vue'], resolve)
        }
    },
    { //教师详情
        path: '/teacher/:id',
        name: 'TeacherDetail',
        component: resolve => {
            require(['@/pc/pages/teacher/TeacherDetail.vue'], resolve)
        }
    },
    { //新闻资讯
        path: '/news',
        name: 'News',
        component: resolve => {
            require(['@/pc/pages/news/News.vue'], resolve)
        }
    },
    { //新闻资讯详情
        path: '/news/:id',
        name: 'NewsDetail',
        component: resolve => {
            require(['@/pc/pages/news/NewsDetail.vue'], resolve)
        }
    },
    { //课程详情
        path: '/course/:id',
        name: 'CourseDetail',
        component: resolve => {
            require(['@/pc/pages/course/CourseDetail.vue'], resolve)
        }
    },
    { //资料下载
        path: '/data',
        name: 'Data',
        component: resolve => {
            require(['@/pc/pages/data/Data.vue'], resolve)
        }
    },
    { //社群
        path: '/group',
        name: 'Group',
        component: resolve => {
            require(['@/pc/pages/group/Group.vue'], resolve)
        }
    },
    { //社群详情
        path: '/group/:id',
        name: 'GroupDetail',
        component: resolve => {
            require(['@/pc/pages/group/GroupDetail.vue'], resolve)
        }
    },
    { //教辅列表
        path: '/mallindex',
        name: 'MallIndex',
        component: resolve => {
            require(['@/pc/pages/mall/MallIndex.vue'], resolve)
        }
    },
    { //教辅购物车
        path:'/mall/shopcar',
        name:'shopcar',
        component: resolve =>{
            require(['@/pc/pages/mall/MyShopcar.vue'],resolve)
        }
    },
    {
        path:'/mall/confirm',
        name:'confirm',
        component: resolve =>{
            require(['@/pc/pages/mall/Confirm.vue'],resolve)
        }
    },
    { //教辅详情
        path: '/commodity',
        name: 'malldel',
        component: resolve =>{
            require(['@/pc/pages/mall/MallDetails.vue'],resolve)
        }
    }
]


routes = routes.concat(userRouters)
export default new Router({
    routes: routes
})