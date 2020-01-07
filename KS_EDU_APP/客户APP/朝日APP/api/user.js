import {GET,POST} from './main.entrance.js'

/*获取登录状态*/
export function checkIsLogin(params) {
	return POST('/webapi/APP/CheckUser',params)
}
/*获取小程序加密信息 openid、access_token 等*/
export function GetMiniProgramOpenID(params) {
	return GET('/webapi/user/GetMiniProgramOpenID',params)
}

/*退出登录*/
export function LoginOut(params) {
	return POST('/webapi/user/LoginOut',params,['appToken'])
}
/*手机验证码*/
export function SendSmsCode(params) {
	return GET('/webapi/user/SendSmsCode',params)
}
/*用户注册*/
export function UserReg(params) {
	return GET('/webapi/user/UserReg',params)
}
/*修改密码*/
export function ModifyPass(params) {
	return GET('/webapi/user/ModifyPass',params,['appToken'])
}
/*用户登录*/
export function Login(params) {
	return GET('/webapi/user/Login',params)
}
/*获取用户信息*/
export function GetUserInfo(params) {
	return GET('/webapi/user/GetUserInfo',params,['appToken'])
}
/*获取省市区数据*/
export function GetArea(params) {
	return GET('/webapi/user/GetArea',params)
}
/*找回密码*/
export function GetPassByMobile(params) {
	return GET('/webapi/user/GetPassByMobile',params)
}
/*修改头像*/
export function ModifyUserFace(params) {
	return GET('/webapi/user/ModifyUserFace',params,['appToken','userId'])
}
/*修改基本资料*/
export function SaveUesrBasicInfo(params) {
	return GET('/webapi/user/SaveUesrBasicInfo',params,['appToken'])
}
/**我的订单 课程订单列表*/
export function GetUserCourseOrderList(params) {
    return GET('/webapi/user/GetUserCourseOrderList',params,['appToken'])
}
/**我的订单 课程订单支付初始化*/
export function InitialUserPayCourse(params) {
    return GET('/webapi/user/InitialUserPayCourse',params,['appToken'])
}
/**我的订单 课程订单支付*/
export function DoUserPayCourse(params) {
    return GET('/webapi/user/DoUserPayCourse',params,['appToken'])
}
/**我的订单 删除课程订单*/
export function DeleteUserCourseOrder(params) {
    return GET('/webapi/user/DeleteUserCourseOrder',params,['appToken'])
}
/**我的收藏列表*/
export function GetUserFavoriteList(params) {
    return POST('/webapi/user/GetUserFavoriteList',params,['appToken'])
}
/**问题收藏列表*/
export function GetUserAskFavriteList(params) {
    return POST('/webapi/user/GetUserAskFavriteList',params,['appToken'])
}
/**我收到的消息*/
export function GetUserMessageReciveList(params) {
    return POST('/webapi/user/GetUserMessageReciveList',params,['appToken'])
}
/**消息详情*/
export function GetOneSiteMsgInfo(params) {
    return POST('/webapi/user/GetOneSiteMsgInfo',params,['appToken'])
}
/**删除消息*/
export function DoUserSiteMsg(params) {
    return POST('/webapi/user/DoUserSiteMsg',params,['appToken'])
}
/**升级vip*/
export function GetUserUpgradeVIP(params) {
    return POST('/webapi/user/GetUserUpgradeVIP',params,['appToken'])
}
/**购买vip*/
export function PayUserUpgradeVIP(params) {
    return POST('/webapi/user/PayUserUpgradeVIP',params,['appToken'])
}
/**优惠券列表*/
export function GetUserCouponList(params) {
    return POST('/webapi/user/GetUserCouponList',params,['appToken'])
}
/**红包列表*/
export function GetUserRedPacketList(params) {
    return POST('/webapi/user/GetUserRedPacketList',params,['appToken'])
}
/**我的问答*/
export function GetUserAskTopList(params) {
	return GET('/webapi/User/GetUserAskTopList',params,['userId'])	
}
/**我的课程*/
export function GetUserCourseList(params) {
	return POST('/webapi/User/GetUserCourseList',params,['appToken'])	
}

/**审核状态*/
export function GetIsVerify(params) {
	return GET('/webapi/Other/GetIsVerify',params)	
}
/**我的专栏*/
export function GetUserSpecialList(params) {
	return POST('/webapi/user/GetUserSpecialList',params,['appToken'])	
}
/**建议、举报*/
export function Pasttrial(params) {
	return POST('/webapi/app/Pasttrial',params,['appToken'])	
}
/**我的学习卡*/
export function GetUserFeePackageList(params) {
	return POST('/webapi/user/GetUserFeePackageList',params,['appToken'])	
}
/**学习卡列表*/
export function GetUserFeePackageBuyList(params) {
	return POST('/webapi/user/GetUserFeePackageBuyList',params,['appToken'])	
}
/**激活学习卡*/
export function ActivateUserFeePackage(params) {
	return POST('/webapi/user/ActivateUserFeePackage',params,['appToken'])	
}
/**初始化购买学习卡数据*/
export function InitialPayUserFeePackage(params) {
	return POST('/webapi/user/InitialPayUserFeePackage',params,['appToken'])	
}
/**购买支付学习卡*/
export function PayUserFeePackage(params) {
	return POST('/webapi/user/PayUserFeePackage',params,['appToken'])	
}
/**我的营销卡详情*/
export function GetUserFeePackageDetail(params) {
	return POST('/webapi/user/GetUserFeePackageDetail',params,['appToken'])	
}
/**所有营销卡详情*/
export function GetUserFeePackageBuyDetail(params) {
	return POST('/webapi/user/GetUserFeePackageBuyDetail',params,['appToken'])	
}
/**我的班级*/
export function GetMyRoomList(params) {
	return POST('/webapi/user/GetMyRoomList',params,['appToken'])	
}


