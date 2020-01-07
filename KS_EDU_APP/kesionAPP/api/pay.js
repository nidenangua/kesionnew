import {GET,POST} from './main.entrance.js'

/*获取微信支付状态*/
export function GetWeiPaySign(params) {
	return GET('/webapi/Pay/GetWeiPaySign',params,['appToken'])
}
/*微信支付（APP版）*/
export function WechatPay(params) {
	return GET('/webapi/Pay/WechatPay',params,['appToken'])
}
/*微信小程序支付下单*/
export function XiaDanWeiPay(params) {
	return GET('/webapi/Pay/XiaDanWeiPay',params,['appToken'])
}

/*支付宝支付下单*/
export function XiaDanAliPay(params) {
	return GET('/webapi/Pay/XiaDanAliPay',params,['appToken'])
}
