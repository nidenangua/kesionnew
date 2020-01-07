import {
	GET,POST
} from './main.entrance.js'

// 学习记录列表
export function MyCourseList(params) {
	return GET('/webapi/Course/MyCourseList',params,['appToken','userId'])	
}

