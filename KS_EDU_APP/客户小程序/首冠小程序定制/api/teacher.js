import {
	GET,POST
} from './main.entrance.js'

// 名师列表
export function GetAllTeacherList(params) {
	return GET('/webapi/app/GetAllTeacherList',params)	
}

// 名师详情
export function GetTeacherInfo(params) {
	return GET('/webapi/app/GetTeacherInfo',params,['appToken','userId'])	
}

// 名师评价
export function SaveTeacherEvaluate(params) {
	return POST('/webapi/app/SaveTeacherEvaluate',params,['appToken','userId'])
}

// 留言列表
export function GetWordsList(params) {
	return GET('/webapi/app/GetWordsList',params,['appToken','userId'])
}

// 留言
export function SaveTeacherWords(params) {
	return GET('/webapi/app/SaveTeacherWords',params,['appToken','userId'])
}

// 收藏
export function DoCollect(params) {
	return POST('/webapi/app/DoCollect',params,['appToken','userId'])
}