import {
	GET,POST
} from './main.entrance.js'

// 名师列表
export function GetSchoolList(params) {
	return GET('/webapi/app/GetSchoolList',params)	
}

// 名师详情
export function GetSchoolInfo(params) {
	return GET('/webapi/app/GetSchoolInfo',params)	
}

// 机构课程查询接口
export function GetSchoolCourseList(params) {
	return GET('/webapi/app/GetSchoolCourseList',params)	
}

// 机构资讯查询接口
export function GetSchoolInfomation(params) {
	return GET('/webapi/app/GetSchoolInfomation',params)	
}

// 机构教师查询接口
export function GetSchoolTeacherList(params) {
	return GET('/webapi/app/GetSchoolTeacherList',params)	
}

// 机构班级查询接口
export function GetSchoolClassList(params) {
	return GET('/webapi/app/GetSchoolClassList',params)	
}
