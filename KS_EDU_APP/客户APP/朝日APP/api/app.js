
import {GET,POST} from './main.entrance.js'

/*订单状态查询*/
export function CheckOrder(params) {
	return POST('/webapi/app/CheckOrder',params,['appToken','userId'])
}

/**
 * 获取app其他配置
 */
var AppConf = null
export function GetAppOtherConf(){
	return new Promise(resolve=>{
		if(AppConf){
			resolve(AppConf)
		}else{
			GET('/config/app/config.txt').then(res=>{
				if(typeof res === 'object'){
					AppConf = res
				}else{
					AppConf = {}
				}
				resolve(AppConf)
			}).catch(err=>{
				resolve({})
			})
		}
	})
}