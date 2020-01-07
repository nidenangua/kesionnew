import {GET,POST} from './main.entrance.js'

/*获取首页数据*/
export function GetHome() {
	return GET('/webapi/app/home?a=index')
}
/*通用搜索*/
export function Generalquery(params) {
	return POST('/webApi/APP/Generalquery',params)
}
/*获取引导图数据*/
export function Getstartup() {
	return GET('/webapi/app/home?a=getstartup')
}

