import {$post,$get} from './main.entrance'

/**
 * 获取教师详细信息
 */
export function getTeacherDetail(params){
    return new Promise((resolve)=>{
        $post(`Microportal.common.getTeacherDetail`,params).then(data=>{
            resolve(data)
        })
    })
}

/**
 * 获取教师相关课程
 */
export function getTeacherLinkCourse(params){
    return new Promise((resolve)=>{
        $post(`Microportal.common.getTeacherLinkCourse`,params).then(data=>{
            resolve(data)
        })
    })
}

/**
 * 教师列表
 */
export function getTeacher(params){
    return new Promise((resolve)=>{
        params.act = 'appTeacher'
        params.callKeyName = 'teacher'
        $post(`Microportal.Common.import`,[params]).then(res=>{
            resolve(res.teacher)
        })
    })
}