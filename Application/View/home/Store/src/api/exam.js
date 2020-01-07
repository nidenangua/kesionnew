import { $post } from './main.entrance'

/**
 * 试卷分类列表
 */
export function category(params) {
    return new Promise((resolve) => {
        $post(`Exam.category`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 添加试卷第一步
 */
export function addExamOne(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.addExamOne`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 选择 题库列表 
 */

export function getTkList(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.getTkList`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 试卷详情
 */
export function getExamDetail(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.getExamDetail`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 试卷添加第二步
 */

export function addExamTwo(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.addExamTwo`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 高级设置
 */

export function updateSetting(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.updateSetting`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 添加题库
 */
export function addTk(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.addTk`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 随机组卷
 */
export function getRandomTk(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.getRandomTk`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * word导入题库
 */
export function setExcelUp(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.setExcelUp`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 新 - 随机组卷
 */
export function getRandNum(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.getRandNum`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 题库删除
 */
export function del(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.del`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 修改题库
 */
export function getTkdetail(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.getTkdetail`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 阅卷列表
 */
export function getExamRecordList(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.getExamRecordList`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 批改阅卷
 */
export function getPaperGradeDetail(params) {
    return new Promise((resolve) => {
        $post(`Exam.common.getPaperGradeDetail`, params).then(data => {
            resolve(data)
        })
    })
}


/**
 * 试卷批量阅卷
 */
export function batchReadOverList(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.batchReadOverList`, params).then(data => {
            resolve(data)
        })
    })
}


/**
 * 试卷批量阅卷保存
 */
export function batchReadOver(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.batchReadOver`, params).then(data => {
            resolve(data)
        })
    })
}

/**
 * 组合题提交
 */
export function saveCombination(params) {
    return new Promise((resolve) => {
        $post(`Exam.store.saveCombination`, params).then(data => {
            resolve(data)
        })
    })
}
/**
 * 批量写评语
 */
// export function saveCombination(params) {
//     return new Promise((resolve) => {
//         $post(`Exam.store.saveCombination`, params).then(data => {
//             resolve(data)
//         })
//     })
// }