
import {GET,POST} from './main.entrance.js'

/*获取下载地址*/
export function DownLoadCourse(params) {
	return GET('/webapi/Course/DownLoadCourse', params, ["appToken"])
}