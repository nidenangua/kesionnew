import {$post} from './main.entrance'

/**
 * 获取试卷详情
 */
export function getPaperInfo(params) {
    return new Promise((resolve) => {
        $post(`Microportal.common.paperInfo`, params).then(data => {
            resolve(data)
        })
        
    })
}

/**
 * 试卷分类
 */
export function categoryAll(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.categoryAll`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 试卷首页做题数据
 */
export function subjectStatistics(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.subjectStatistics`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 试卷列表
 */
export function getPaperList(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.getPaperList`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 试卷收藏
 */
export function getMyCollect(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.getMyCollect`, params).then(data => {
                resolve(data)
            })
    })
}
/**
 * 试卷做题
 */
export function getExamDetail(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.getExamDetail`, params,{
            isErrorCall:true
        }).then(data => {
            resolve(data)
        })
    })
}

/**
 *加入收藏
 */
export function setCollect(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.setCollect`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 做题保存
 */
export function setPaperAnswer(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.setPaperAnswer`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 获取考试结果
 */
export function getPerformance(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.getPerformance`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 *考试记录
 */
export function getExamRecord(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.getExamRecord`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 消除错题
 */
export function moveError(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.moveError`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 随机练习
 */
export function RandomTest(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.RandomTest`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 随机练习
 */
export function getTestTk(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.getTestTk`, params,{
            isErrorCall:true
        }).then(data => {
            resolve(data)
        })
    })
}
/**
 * 随机结束交卷
 */
export function endTest(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.endTest`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 *查看解析
 */
export function getAnalysis(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.getAnalysis`, params).then(data => {
            resolve(res.data.getAnalysis)
        })
    })
}

/**
 * 试卷错题、收藏题
 */
export function getTest(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.getTest`, params,{
            isErrorCall:true
        }).then(data => {
            resolve(data)
        })
    })
}

/**
 * 清空收藏/错题
 */
export function delAllTk(params){
    return new Promise((resolve) => {
        $post(`Exam.common.delAllTk`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 错题路口
 */
export function errorHome(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.errorHome`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 *随机练习记录
 */
export function getTestRecordList(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.getTestRecordList`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 *整卷练习记录
 */
export function getExamRecordList(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.getExamRecordList`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 *整卷练习记录
 */
export function getPaperGradeDetail(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.getPaperGradeDetail`, params).then(data => {
            resolve(data)
        })
    })
}
