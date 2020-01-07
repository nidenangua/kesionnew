import {$post} from './main.entrance'

/**查看课程 */
export function showCourse(params){
    return new Promise((resolve)=>{
        $post(`Course.showCourse`,params).then(res=>{
            resolve(res)
        })
    })
}

/**获取课程列表 */
export function getCourseList(params){
    return new Promise((resolve)=>{
        $post(`Course.getCourseList`,params).then(res=>{
            resolve(res)
        })
    })
}

/**删除课程 */
export function delCourse(params){
    return new Promise((resolve)=>{
        $post(`Course.delCourse`,params).then(res=>{
            resolve(res)
        })
    })
}

/**课程上下架 */
export function downAndUp(params){
    return new Promise((resolve)=>{
        $post(`Course.downAndUp`,params).then(res=>{
            resolve(res)
        })
    })
}

/**查看学员 */
export function getStudentList(params){
    return new Promise((resolve)=>{
        $post(`Course.getStudentList`,params).then(res=>{
            resolve(res)
        })
    })
}

/**课时管理 */
export function hourList(params){
    return new Promise((resolve)=>{
        $post(`Course.hourList`,params).then(res=>{
            resolve(res)
        })
    })
}

/**删除课时 */
export function delHour(params){
    return new Promise((resolve)=>{
        $post(`Course.delHour`,params).then(res=>{
            resolve(res)
        })
    })
}

/**添加课程 */
export function addCourse(params) {
    return new Promise((resolve)=>{
        $post(`Course.addCourse`,params).then(res=>{
            resolve(res)
        })
    })
}

/**获取分类 */
export function courseCategory(params){
    return new Promise((resolve)=>{
        $post(`Home.courseCategory`,params).then(res=>{
            resolve(res)
        })
    })
}

/**添加课时 */
export function editHour(params){
    return new Promise((resolve)=>{
        $post(`Course.editHour`,params).then(res=>{
            resolve(res)
        })
    })
}

/**查看课时 */
export function showHour(params){
    return new Promise((resolve)=>{
        $post(`Course.showHour`,params).then(res=>{
            resolve(res)
        })
    })
}