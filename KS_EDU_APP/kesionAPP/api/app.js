
import {GET,POST} from './main.entrance.js'

/*订单状态查询*/
export function CheckOrder(params) {
	return POST('/webapi/app/CheckOrder',params,['appToken','userId'])
}
