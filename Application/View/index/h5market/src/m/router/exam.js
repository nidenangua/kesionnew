const examRouters = [

    //错题集
    {
        path: '/exam/wrong',
        name: 'wrong',
        component: resolve => {
            require(['@/m/pages/exam/PaperWrong.vue'], resolve)
        }
    },
    //收藏夹
    {
        path: '/exam/favorite',
        name: 'favorite',
        component: resolve => {
            require(['@/m/pages/exam/PaperFavorite.vue'], resolve)
        }
    },
    //套卷练习
    {
        path: '/exam/DoExercise',
        name: 'DoExercise',
        component: resolve => {
            require(['@/m/pages/exam/PaperDoexercise.vue'], resolve)
        }
    },
    //随机练习
    {
        path: '/exam/DoRadom',
        name: 'DoRadom',
        component: resolve => {
            require(['@/m/pages/exam/PaperDoexercise.vue'], resolve)
        }
    },
    //答题卡
    {
        path: '/exam/sheet',
        name: 'sheet',
        component: resolve => {
            require(['@/m/pages/exam/AnswerSheet.vue'], resolve)
        }
    },
    //考试说明
    {
        path: '/exam/explain',
        name: 'explain',
        component: resolve => {
            require(['@/m/pages/exam/PaperExplain.vue'], resolve)
        }
    },
    //做题记录
    {
        path: '/exam/record',
        name: 'record',
        component: resolve => {
            require(['@/m/pages/exam/PaperRecord.vue'], resolve)
        }
    },

    //试卷列表
    {
        path: '/exam/PaperList',
        name: 'PaperList',
        component: resolve => {
            require(['@/m/pages/exam/PaperList.vue'], resolve)
        }
    },
    //考试结果
    {
        path: '/exam/result',
        name: 'ExamResult',
        component: resolve => {
            require(['@/m/pages/exam/ExamResult.vue'], resolve)
        }
    },
    //试卷解析
    {
        path: '/exam/analysis',
        name: 'analysis',
        component: resolve => {
            require(['@/m/pages/exam/PaperAnalysis.vue'], resolve)
        }

    },
    //我的错题
    {
        path: '/exam/WrongEntry',
        name: 'WrongEntry',
        component: resolve => {
            require(['@/m/pages/exam/WrongEntry.vue'], resolve)
        }

    },
    //做错题
    {
        path: '/exam/DoError',
        name: 'DoError',
        component: resolve => {
            require(['@/m/pages/exam/PaperDoexercise.vue'], resolve)
        }
    },
    /**做收藏题 */
    {
        path: '/exam/DoFavtest',
        name: 'DoFavtest',
        component: resolve => {
            require(['@/m/pages/exam/PaperDoexercise.vue'], resolve)
        }
    },
    //错题解析
    {
        path: '/exam/ErrorAnaysis',
        name: 'ErrorAnaysis',
        component: resolve => {
            require(['@/m/pages/exam/PaperAnalysis.vue'], resolve)
        }
    },
    //试卷入口
    {
        path: '/exam',
        name: 'PaperIndex',
        component: resolve => {
            require(['@/m/pages/exam/PaperIndex.vue'], resolve)
        }
    }]

export default examRouters