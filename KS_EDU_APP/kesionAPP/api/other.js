import {GET,POST} from './main.entrance.js'

/*获取url*/
export function GetWebViewUrl(params) {
	return POST('/webapi/other/GetInfo',params,['appToken'])
}
/*关于我们*/
export function About(params) {
	return POST('/webapi/other/About',params,['appToken'])
}
/*秘钥信息*/
export function GetSystemConfig(params) {
	return POST('/webapi/other/GetSystemConfig',params)
}
