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
/**试题纠错*/
export function GetUserTkCorrectionList(params) {
	return POST('/webapi/user/GetUserTkCorrectionList',params,['appToken','userId'])	
}
/**余额充值*/
export function DoPay(params) {
	return POST('/webapi/user/DoPay',params,['appToken','userId'])	
}
/**充值记录*/
export function GetRechargeList(params) {
	return POST('/webapi/user/GetRechargeList',params,['appToken','userId'])	
}
/**点券兑换*/
export function MoneyExchangePoint(params) {
	return POST('/webapi/user/MoneyExchangePoint',params,['appToken','userId'])	
}
/**点券兑换*/
export function SaveMoneyExchangePoint(params) {
	return POST('/webapi/user/SaveMoneyExchangePoint',params,['appToken','userId'])	
}
/**点券兑换*/
export function ScoreExchangePoint(params) {
	return POST('/webapi/user/ScoreExchangePoint',params,['appToken','userId'])	
}
/**点券兑换*/
export function SaveScoreExchangePoint(params) {
	return POST('/webapi/user/SaveScoreExchangePoint',params,['appToken','userId'])	
}
/**点券明细*/
export function GetUserLogPointList(params) {
	return POST('/webapi/user/GetUserLogPointList',params,['appToken','userId'])	
}
/**积分明细*/
export function GetUserLogScoreList(params) {
	return POST('/webapi/user/GetUserLogScoreList',params,['appToken','userId'])	
}
/**账户明细*/
export function GetUserLogMoneyList(params) {
	return POST('/webapi/user/GetUserLogMoneyList',params,['appToken','userId'])	
}
/*****************分销*****************/
/**获取分销状态*/
export function IsDistributor(params) {
	return POST('/webapi/user/IsDistributor',params,['appToken','userId'])	
}
/**校验店铺名称*/
export function ApplyIstitle(params) {
	return POST('/webapi/user/ApplyIstitle',params,['appToken'])	
}
/**提交申请分销商*/
export function ApplyDistributor(params) {
	return POST('/webapi/user/ApplyDistributor',params,['appToken'])	
}
/**我的分销信息*/
export function ApplyDistributorlist(params) {
	return POST('/webapi/user/ApplyDistributorlist',params,['appToken','userId'])	
}
/**小店销售订单*/
export function ApplySalesorder(params) {
	return POST('/webapi/user/ApplySalesorder',params,['appToken','userId'])	
}
/**小店销售订单明细*/
export function ApplySalesorderlist(params) {
	return POST('/webapi/user/ApplySalesorderlist',params,['appToken','userId'])	
}
/**小店会员*/
export function ApplyDistriMember(params) {
	return POST('/webapi/user/ApplyDistriMember',params,['appToken','userId'])	
}
/**获取提现账号信息*/
export function ApplyDrawing(params) {
	return POST('/webapi/user/ApplyDrawing',params,['appToken','userId'])	
}
/**修改提现账号信息*/
export function ApplyDrawingSave(params) {
	return POST('/webapi/user/ApplyDrawingSave',params,['appToken','userId'])	
}
/**佣金提现数据*/
export function ApplyYjSelect(params) {
	return POST('/webapi/user/ApplyYjSelect',params,['appToken','userId'])	
}
/**分销提现记录*/
export function ApplyTxrecord(params) {
	return POST('/webapi/user/ApplyTxrecord',params,['appToken','userId'])	
}
/**子分销商信息*/
export function ApplyDistributorsonlist(params) {
	return POST('/webapi/user/ApplyDistributorsonlist',params,['appToken','userId'])	
}
/**获取店铺资料信息*/
export function ApplyShop(params) {
	return POST('/webapi/user/ApplyShop',params,['appToken','userId'])	
}
/**修改店铺资料信息*/
export function ApplyUpdateShop(params) {
	return POST('/webapi/user/ApplyUpdateShop',params,['appToken','userId'])	
}
/**店铺二维码*/
export function ApplyQRcode(params) {
	return POST('/webapi/user/ApplyQRcode',params,['appToken','userId'])	
}
/**获取分销排名*/
export function ApplyRanking(params) {
	return POST('/webapi/user/ApplyRanking',params,['appToken','userId'])	
}
/**获取子分销排名*/
export function ApplySon(params) {
	return POST('/webapi/user/ApplySon',params,['appToken','userId'])	
}
/**是否实名认证*/
export function ApplyCashwhere(params) {
	return POST('/webapi/user/ApplyCashwhere',params,['appToken','userId'])	
}
/**实名认证提交*/
export function GetRealnameauthentication(params) {
	return POST('/webapi/user/GetRealnameauthentication',params,['appToken','userId'])	
}
/**申请提现*/
export function ApplyCash(params) {
	return POST('/webapi/user/ApplyCash',params,['appToken','userId'])	
}

