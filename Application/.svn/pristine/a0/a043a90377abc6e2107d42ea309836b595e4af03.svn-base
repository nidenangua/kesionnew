import Vue from 'vue'
import Router from 'vue-router'
import groupRouters from './group'
import examRouters from './exam'
import userRouters from './user'
import activityRouters from './activity'
import trainCampRouters from './train-camp'
import friends from './friends'
import mall from './mall'
import courseManage from './course-manage'
Vue.use(Router)
let routes = [
  {
    path: '/',
    name: 'Index',
    component: resolve => {
      require(['@/m/pages/Index.vue'], resolve)
    }
  },
  {
    path: '/news',
    name: 'News',
    component: resolve => {
      require(['@/m/pages/news/News.vue'], resolve)
    }
  },
  {
    path: '/news/:id',
    name: 'NewsContent',
    component: resolve => {
      require(['@/m/pages/news/NewsContent.vue'], resolve)
    }
  },
  {
    path: '/course',
    name: 'CourseList',
    component: resolve => {
      require(['@/m/pages/course/CourseList.vue'], resolve)
    }
  },
  {
    /**课程内容页 */
    path: '/course/:id',
    name: 'CourseView',
    component: resolve => {
      require(['@/m/pages/course/CourseView.vue'], resolve)
    }
  },
  {
    /**课程播放页 */
    path: '/course/:id/courseplay',
    name: 'CoursePlay',
    component: resolve => {
      require(['@/m/pages/course/CoursePlay.vue'], resolve)
    }
  },
  {
    /**音频播放页 */
    path: '/course/:id/playaudio',
    name: 'PlayAudio',
    component: resolve => {
      require(['@/m/pages/course/PlayAudio.vue'], resolve)
    }
  },
  {
    /**为好友助力页 */
    path: '/course/:id/helpfriend',
    name: 'HelpYourFriends',
    component: resolve => {
      require(['@/m/pages/course/HelpYourFriends.vue'], resolve)
    }
  },
  {
    /**送礼页面 */
    path: '/course/:id/showgift',
    name: 'ShowGift',
    component: resolve => {
      require(['@/m/pages/course/ShowGift.vue'], resolve)
    }
  },
  {
    /**面授签到页面 */
    path: "/course/:id/facesign",
    name: "FaceSign",
    component: resolve => {
      require(['@/m/pages/course/FaceSign.vue'], resolve)
    }
  },
  {
    /**音频直播室 */
    path: '/audiolive',
    name: 'AudioLive',
    component: resolve => {
      require(['@/m/pages/course/audio-live/AudioLiveIndex.vue'], resolve)
    }
  },
  {
    path: '/course/:id/graphicLearn',
    name: 'GraphicLearn',
    component: resolve => {
      require(['@/m/pages/course/GraphicLearn.vue'], resolve)
    }
  },
  {
    path: '/videolive',
    name: 'VideoLive',
    component: resolve => {
      require(['@/m/pages/course/video-live/VLiveIndex.vue'], resolve)
    }
  },
  {
    path: '/column',
    name: 'ColumnList',
    component: resolve => {
      require(['@/m/pages/course/ColumnList.vue'], resolve)
    }
  },
  {
    path: '/column/:id',
    name: 'ColumnView',
    component: resolve => {
      require(['@/m/pages/course/ColumnView.vue'], resolve)
    }
  },
  {
    path: '/comment',
    name: 'CommentList',
    component: resolve => {
      require(['@/m/pages/comment/CommentList.vue'], resolve)
    }
  },
  /**资料列表 */
  {
    path: '/data',
    name: 'DataList',
    component: resolve => {
      require(['@/m/pages/data/DataList.vue'], resolve)
    }
  },
  /**资料详情 */
  {
    path: '/data/:id',
    name: 'DataView',
    component: resolve => {
      require(['@/m/pages/data/DataView.vue'], resolve)
    }
  },
  /**教师列表 */
  {
    path: '/teacher',
    name: 'TeacherList',
    component: resolve => {
      require(['@/m/pages/teacher/TeacherList.vue'], resolve)
    }
  },
  /**教师内容 */
  {
    path: '/teacher/:id',
    name: 'TeacherView',
    component: resolve => {
      require(['@/m/pages/teacher/TeacherView.vue'], resolve)
    }
  },
  /**发布页面*/
  {
    path: '/friendIssue',
    name: 'FriendIssue',
    component: resolve => {
      require(['@/m/pages/friend/FriendIssue.vue'], resolve)
    }
  },
  /**讲师答疑*/
  {
    path: '/mentoring',
    name: 'Mentoring',
    component: resolve => {
      require(['@/m/pages/mentoring/Mentoring.vue'], resolve)
    }
  },
  /**讲师答疑*/
  {
    path: '/mentoringreply',
    name: 'MentoringReply',
    component: resolve => {
      require(['@/m/pages/mentoring/MentoringReply.vue'], resolve)
    }
  },
  /**讲师答疑*/
  {
    path: '/mentoringQuiz',
    name: 'MentoringQuiz',
    component: resolve => {
      require(['@/m/pages/mentoring/MentoringQuiz.vue'], resolve)
    }
  },
  /**讲师答疑*/
  {
    path: '/mentoringCollect',
    name: 'MentoringCollect',
    component: resolve => {
      require(['@/m/pages/mentoring/MentoringCollect.vue'], resolve)
    }
  },
  /**讲师答疑-回复状态筛选*/
  {
    path: '/mentoringAudit',
    name: 'MentoringAudit',
    component: resolve => {
      require(['@/m/pages/mentoring/MentoringAudit.vue'], resolve)
    }
  },
  /**讲师答疑-查看回答*/
  {
    path: '/mentoringseereply',
    name: 'MentoringSeereply',
    component: resolve => {
      require(['@/m/pages/mentoring/MentoringSeereply.vue'], resolve)
    }
  },
]
routes = routes.concat(groupRouters)
routes = routes.concat(examRouters)
routes = routes.concat(userRouters)
routes = routes.concat(activityRouters)
routes = routes.concat(trainCampRouters)
routes = routes.concat(friends)
routes = routes.concat(mall)
routes = routes.concat(courseManage)
export default new Router({
  routes: routes
})
