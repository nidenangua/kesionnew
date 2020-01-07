
function $post(act, params) {
    return new Promise(function(resolve) {
        params = params || {};
        params.from = 'student';
        var url = act;
        axios.post(url, params).then(function(res) {
                resolve(res)
            })
            .catch(function(error) {
                console.error(error)
            })


    })
}

function $get(act, params) {
    return new Promise(function(resolve) {
        var url = act;
        params = params || {};
        params.from = 'student';
        axios.get(url, {
            params:params
        }).then(function(res) {
            resolve(res)
        }).catch(function(error) {
            console.log(error)
        })
    })
}
/**
 * 
 * @param {*} params 
 * 检查登录
 */
function UserLogin(params) {
    return new Promise(function(resolve) {
        $post('/plus/ajaxs.ashx?a=checkislogin&json=1', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * 
 * @param {*} params 
 * 获取用户登录信息
 */
function GetUserInfo(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserInfo', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 * 
 * @param {*} params 
 * 请求个人中心左侧菜单栏
 */
function GetUserLeft(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserLeft', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * 
 * @param {*} params 
 * 签到
 */
function DoUserSignIn(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DoUserSignIn', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * 
 * @param {*} params 
 * 签到记录
 */
function GetUserSignInList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserSignInList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * 
 * @param {*} params 
 * 签到排名
 */
function GetUserSignInRanking(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserSignInRanking', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * @param {*} params 
 * 首页
 */
function GetUserHome(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserHome', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * @param {*} params 
 * 首页课表
 */
function GetUserHomeCosLive(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserHomeCosLive', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * @param {*} params 
 * 首页通告
 */
function GetUserMessageReciveList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserMessageReciveList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * 
 * @param {*} params 
 * 我的课程
 */
function GetUserCourseList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserCourseList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * 
 * @param {*} params 
 * 我的班级
 */
function GetUserClassList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserClassList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * 
 * @param {*} params 
 * 我的班级详情
 */
function GetUserClassDetail(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserClassDetail', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * 
 * @param {*} params 
 * 我的训练营
 */
function GetUserTrainList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserTrainList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * 
 * @param {*} params 
 * 我的训练营详情
 */
function GetUserTrainDetail(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserTrainDetail', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * 
 * @param {*} params 
 * 我的训练营营期详情
 */
function GetUserCampDetail(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserCampDetail', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 * 
 * @param {*} params 
 * 我的专栏
 */
function GetUserSpecialList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserSpecialList', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 * 
 * @param {*} params 
 * 我的专栏详情
 */
function GetUserSpecialDetail(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserSpecialDetail', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的活动列表
 * 
 */
function GetUserActivityList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserActivityList', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/*
 *我的所有活动列表
 * 
 */
function GetUserAllActivityList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserAllActivityList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *删除我的活动
 * 
 */
function DelUserActivity(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DelUserActivity', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的社群列表
 * 
 */
function GetUserCommunityList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserCommunityList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的帖子
 * 
 */
function GetUserPostList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserPostList', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/*
 *我参与的话题列表
 * 
 */
function GetUserTopicList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserTopicList', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/*
 *删除我参与的话题列表
 * 
 */
function DelUserTopic(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DelUserTopic', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *删除我的帖子
 * 
 */
function DelUserPost(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DelUserPost', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/*
 *我的订单 课程订单列表
 * 
 */
function GetUserCourseOrderList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserCourseOrderList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 商城订单列表
 * 
 */
function GetUesrShopOrderList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUesrShopOrderList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 商城支付信息
 * 
 */
function InitialUserPayShop(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/InitialUserPayShop', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 课程支付信息
 * 
 */
function InitialUserPayCourse(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/InitialUserPayCourse', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 课程支付
 * 
 */
function DoUserPayCourse(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DoUserPayCourse', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 商城支付
 * 
 */
function DoUserPayShop(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DoUserPayShop', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 我的拼团
 * 
 */
function GetUserGroupOrderList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserGroupOrderList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 砍价列表
 * 
 */
function GetBargainList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetBargainList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 我的砍价
 * 
 */
function GetUserBargainList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserBargainList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 我的试卷订单
 * 
 */
function GetUserPaperOrderList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserPaperOrderList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 订单详情
 * 
 */
function GetUserCourseOrderDetail(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserCourseOrderDetail', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 课程订单退款申请
 * 
 */
function ReturnUserCourseOrder(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ReturnUserCourseOrder', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 课程订单退款保存
 * 
 */
function SaveReturnUserCourseOrder(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveReturnUserCourseOrder', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 删除课程订单
 * 
 */
function DeleteUserCourseOrder(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserCourseOrder', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 课程订单确认收货
 * 
 */
function ReceiptUserCourseOrder(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ReceiptUserCourseOrder', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 删除商城订单
 * 
 */
function DeleteUserShopOrder(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserShopOrder', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 商城订单确认收货
 * 
 */
function ReceiptUserShopOrder(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ReceiptUserShopOrder', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 商城订单再次购买
 * 
 */
function ReBuyUserShop(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ReBuyUserShop', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 商城订单详情
 * 
 */
function GetUesrShopOrderDetail(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUesrShopOrderDetail', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 商城订单退款申请
 * 
 */
function ReturnUserShopOrder(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ReturnUserShopOrder', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 保存商城订单退款申请
 * 
 */
function SaveReturnUserShopOrder(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveReturnUserShopOrder', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 上传图片凭证
 * 
 */
function UploadFile(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/UploadFile', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的订单 保存订单评价
 * 
 */
function SaveUserComment(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveUserComment', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 账户明细
 * 
 */
function GetUserLogMoneyList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserLogMoneyList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 点券明细
 * 
 */
function GetUserLogPointList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserLogPointList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 积分明细
 * 
 */
function GetUserLogScoreList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserLogScoreList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 历史充值记录列表
 * 
 */
function GetRechargeList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetRechargeList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 余额充值初始化
 * 
 */
function InitialUserRecharge(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/InitialUserRecharge', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 余额充值
 * 
 */
function DoPay(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DoPay', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 删除充值记录
 * 
 */
function DeleteRecharge(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteRecharge', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 初始化余额兑换点券信息接口
 * 
 */
function MoneyExchangePoint(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/MoneyExchangePoint', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 初始化积分兑换点券信息接口
 * 
 */
function ScoreExchangePoint(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ScoreExchangePoint', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 保存余额兑换点券接口
 * 
 */
function SaveMoneyExchangePoint(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveMoneyExchangePoint', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/*
 *我的账户 保存积分兑换点券接口
 * 
 */
function SaveScoreExchangePoint(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveScoreExchangePoint', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 课程返现列表
 * 
 */
function GetUserCashList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserCashList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 删除课程返现
 * 
 */
function DeleteUserCash(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserCash', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 优惠券列表
 * 
 */
function GetUserCouponList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserCouponList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 兑换优惠券
 * 
 */
function SaveUserCouponList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveUserCouponList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 红包列表
 * 
 */
function GetUserRedPacketList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserRedPacketList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 升级vip
 * 
 */
function GetUserUpgradeVIP(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserUpgradeVIP', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 升级vip 支付
 * 
 */
function PayUserUpgradeVIP(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/PayUserUpgradeVIP', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 升级vip 明细
 * 
 */
function GetUserUpgradeVIPDetailList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserUpgradeVIPDetailList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 营销卡
 * 
 */
function GetUserFeePackageList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserFeePackageList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 购买营销卡列表
 * 
 */
function GetUserFeePackageBuyList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserFeePackageBuyList', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/*
 *我的账户 购买营销卡页面初始信息
 * 
 */
function InitialPayUserFeePackage(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/InitialPayUserFeePackage', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/*
 *我的账户 购买营销卡
 * 
 */
function PayUserFeePackage(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/PayUserFeePackage', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 购买营销卡详情
 * 
 */
function GetUserFeePackageBuyDetail(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserFeePackageBuyDetail', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 我的营销卡详情
 * 
 */
function GetUserFeePackageDetail(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserFeePackageDetail', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的账户 激活营销卡
 * 
 */
function ActivateUserFeePackage(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ActivateUserFeePackage', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/*
 *基本资料 获取省市区三级联动数据
 * 
 */
function GetArea(params) {
    return new Promise(function(resolve) {
        $post('/webapi/school/GetArea', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 设置标签
 * 
 */
function GetKeyTagsList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetKeyTagsList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 初始化个人信息
 * 
 */
function InitializateUesrBasicField(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/InitializateUesrBasicField', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 修改保存资料
 * 
 */
function SaveUesrBasicInfo(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveUesrBasicInfo', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 修改头像
 * 
 */
function ModifyUserFace(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ModifyUserFace', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 修改密码
 * 
 */
function ModifyPass(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ModifyPass', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 账户安全
 * 
 */
function ModifyQuestion(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ModifyQuestion', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 账户绑定
 * 
 */
function GetUserBindList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserBindList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 解除账户绑定
 * 
 */
function DelUserBind(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DelUserBind', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 发送短信验证码
 * 
 */
function SendSmsCode(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SendSmsCode', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 绑定手机号
 * 
 */
function MobileBind(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/MobileBind', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 收货地址列表
 * 
 */
function GetUserReciveAddressList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserReciveAddressList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 添加收货地址
 * 
 */
function SaveAddUserReciveAddres(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveAddUserReciveAddres', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 修改收货地址信息
 * 
 */
function ModifyUserReciveAddress(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ModifyUserReciveAddress', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 修改保存收货地址
 * 
 */
function SaveModifyUserReciveAddres(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveModifyUserReciveAddres', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 删除收货地址
 * 
 */
function DeleteUserReciveAddress(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserReciveAddress', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/*
 *基本资料 设置默认收货地址
 * 
 */
function SetUserReciveAddress(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SetUserReciveAddress', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 获取发票列表
 * 
 */
function GetUserInvoiceList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserInvoiceList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 添加发票
 * 
 */
function SaveAddUserInvoice(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveAddUserInvoice', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 修改发票
 * 
 */
function ModifyUserInvoice(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ModifyUserInvoice', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 保存修改发票
 * 
 */
function SaveModifyUserInvoice(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveModifyUserInvoice', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *基本资料 删除发票
 * 
 */
function DeleteUserInvoice(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserInvoice', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 我收到的消息
 * 
 */
function GetUserMessageReciveList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserMessageReciveList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 我发送的消息
 * 
 */
function GetUserMessageSendList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserMessageSendList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 垃圾消息
 * 
 */
function GetUserMessageGarbageList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserMessageGarbageList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 垃圾消息转回我收到的消息
 * 
 */
function SetUserMessageGarbage(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SetUserMessageGarbage', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 消息详情
 * 
 */
function GetOneSiteMsgInfo(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetOneSiteMsgInfo', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 删除、设置已读，转为垃圾消息
 * 
 */
function DoUserSiteMsg(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DoUserSiteMsg', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 发送消息
 * 
 */
function SaveUserSendMessage(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveUserSendMessage', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 咨询问答列表
 * 
 */
function GetUserAskTopList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserAskTopList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 删除咨询问答
 * 
 */
function DeleteUserConsultation(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserConsultation', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 评价列表
 * 
 */
function GetUserCommentList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserCommentList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 删除评价
 * 
 */
function DeleteUserComment(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserComment', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 我的点赞列表
 * 
 */
function GetUserFabulousList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserFabulousList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 删除我的点赞
 * 
 */
function DeleteUserFabulous(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserFabulous', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 我的文章
 * 
 */
function GetUserArticleList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserArticleList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的互动 删除我的文章
 * 
 */
function DeleteUserArticle(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserArticle', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的收藏
 * 
 */
function GetUserFavoriteList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserFavoriteList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *问题收藏
 * 
 */
function GetUserAskFavriteList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserAskFavriteList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的收藏 删除
 * 
 */
function DeleteUserFavorite(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserFavorite', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *我的收藏 问题删除
 * 
 */
function DeleteUserAskFavorite(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserAskFavorite', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 基本资料
 * 
 */
function GetUserJobBasicInfo(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobBasicInfo', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 保存基本资料
 * 
 */
function SaveUserJobBasicInfo(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveUserJobBasicInfo', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 求职意向列表
 * 
 */
function GetUserJobIntensionList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobIntensionList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 获取求职意向信息
 * 
 */
function GetUserJobIntention(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobIntention', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 修改保存求职意向信息
 * 
 */
function SaveUserJobIntention(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveUserJobIntention', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 获取行业分类信息
 * 
 */
function GetJobIndustryCategory(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetJobIndustryCategory', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 获取公司规模信息
 * 
 */
function GetJobCompanySize(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetJobCompanySize', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 获取职位分类信息
 * 
 */
function GetPositionCategory(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetPositionCategory', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 获取期望月薪
 * 
 */
function GetJobSalary(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetJobSalary', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 获取学历设置
 * 
 */
function GetJobEducation(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetJobEducation', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 获取工作经验列表
 * 
 */
function GetUserJobExperienceList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobExperienceList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 工作经验选项
 * 
 */
function GetJobWorkingLife(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetJobWorkingLife', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 保存添加工作经验列表
 * 
 */
function SaveAddUserJobExperience(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveAddUserJobExperience', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 修改工作经验信息
 * 
 */
function ModifyUserJobExperience(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ModifyUserJobExperience', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 保存修改工作经验信息
 * 
 */
function SaveModifyUserJobExperience(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveModifyUserJobExperience', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 删除工作经验信息
 * 
 */
function DeleteUserJobExperience(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserJobExperience', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 获取教育背景
 * 
 */
function GetUserJobBackgroundList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobBackgroundList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 修改教育背景
 * 
 */
function ModifyUserJobBackground(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ModifyUserJobBackground', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 删除教育背景
 * 
 */
function DeleteUserJobBackground(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserJobBackground', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 获取学校专业
 * 
 */
function GetJobMajor(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetJobMajor', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 添加教育背景
 * 
 */
function SaveAddUserJobBackground(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveAddUserJobBackground', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 保存修改教育背景
 * 
 */
function SaveModifyUserJobBackground(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveModifyUserJobBackground', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 获取培训经历
 * 
 */
function GetUserJobTrainingList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobTrainingList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 修改培训经历
 * 
 */
function ModifyUserJobTraining(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ModifyUserJobTraining', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 添加培训经历
 * 
 */
function SaveAddUserJobTraining(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveAddUserJobTraining', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 保存修改培训经历
 * 
 */
function SaveModifyUserJobTraining(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveModifyUserJobTraining', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 删除培训经历
 * 
 */
function DeleteUserJobTraining(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserJobTraining', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 职位申请记录
 * 
 */
function GetUserJobApplyList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobApplyList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 查看职位详情
 * 
 */
function LookUserJobApply(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/LookUserJobApply', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 删除职位申请
 * 
 */
function DeleteUserJobApply(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserJobApply', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 收到面试邀请
 * 
 */
function GetUserJobInterviewNoticeList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobInterviewNoticeList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 查看面试邀请
 * 
 */
function LookUserJobInterviewNotice(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/LookUserJobInterviewNotice', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 浏览记录列表
 * 
 */
function GetUserJobHasLookList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobHasLookList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 删除浏览记录
 * 
 */
function DeleteUserJobHasLook(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserJobHasLook', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 被企业查看记录列表
 * 
 */
function GetUserJobHasEnterpriseLookList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobHasEnterpriseLookList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 删除被企业查看记录
 * 
 */
function DeleteUserJobHasEnterpriseLook(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserJobHasEnterpriseLook', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 获取简历状态数据
 * 
 */
function GetUserJobResumeStatus(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobResumeStatus', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 修改保密设置
 * 
 */
function ModifyUserResumeStatus(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/ModifyUserResumeStatus', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 保存修改保密设置
 * 
 */
function SaveUserResumeStatus(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/SaveUserResumeStatus', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 刷新简历
 * 
 */
function GetUserJobRefreshResume(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobRefreshResume', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 职位推荐
 * 
 */
function GetUserJobRecommendList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobRecommendList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 职位收藏列表
 * 
 */
function GetUserJobCollectList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobCollectList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 职位收藏
 * 
 */
function DoUserJobCollect(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DoUserJobCollect', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *求职管理 求职意向职位推荐
 * 
 */
function GetUserJobIntensionList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserJobIntensionList', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/*
 *求职管理 删除职位收藏
 * 
 */
function DeleteUserJobCollect(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeleteUserJobCollect', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/******************************我的考试部分**************************** */
/*
 *我的考试课程分类列表
 * 
 */
function GetAllPaperCategory(params) {
    return new Promise(function(resolve) {
        $get('/webapi/paper/GetAllPaperCategory', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *考试首页模块列表
 * 
 */
function GetSubjectStatistics(params) {
    return new Promise(function(resolve) {
        $post('/webapi/paper/SubjectStatistics', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *请求课程列表
 * 
 */
function GetAllPaperCategory(params) {
    return new Promise(function(resolve) {
        $get('/webapi/paper/GetAllPaperCategory', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *请求考试题库列表
 * 
 */
function GetPaperList(params) {
    return new Promise(function(resolve) {
        $get('/webapi/paper/GetPaperList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *请求首页模块列表
 * 
 */
function GetSubjectStatistics(params) {
    return new Promise(function(resolve) {
        $post('/webapi/paper/SubjectStatistics', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *请求二维码接口
 * 
 */
function GetQrcode(params) {
    return new Promise(function(resolve) {
        $post('/plus/other/other.aspx?action=geturl', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 *获取我的考试套餐包列表
 */
function MyFeeSellList(params) { //获取我的考试套餐包列表
    return new Promise(function(resolve) {
        $post('/webapi/user/MyFeeSellList', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 *获取我的考试套餐包详情
 */
function MyFeeSellDetail(params) { //获取我的考试套餐包详情
    return new Promise(function(resolve) {
        $post('/webapi/user/MyFeeSellDetail', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 *获取所有套餐包详情
 */
function GetFeePackagesDetial(params) { //获取所有套餐包详情
    return new Promise(function(resolve) {
        $post('/webapi/user/GetFeePackagesDetial', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 *初始化套餐包购买页面
 */
function InitialPayPaperFeePackage(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/InitialPayPaperFeePackage', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *请求套卷列表
 * 
 */
function GetPaperList(params) {
    return new Promise(function(resolve) {
        $get('/webapi/paper/GetPaperList', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/*
 *请求套卷列表分类名称
 * 
 */
function GetAllPaperType(params) {
    return new Promise(function(resolve) {
        $get('/webapi/paper/GetAllPaperType', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/*
 *请求练习中心章节列表
 * 
 */
function GetPaperSection(params) {
    return new Promise(function(resolve) {
        $post('/webapi/paper/GetPaperSection', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/*
 *请求知识点列表
 * 
 */
function GetPaperKnowledge(params) {
    return new Promise(function(resolve) {
        $post('/webapi/paper/GetPaperKnowledge', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 *获取错题首页
 */
function ErrorTkHome(params) {
    return new Promise(function(resolve) {
        $get('/webapi/user/ErrorTkHome', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 *获取收藏首页
 */
function CollectTkHome(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/CollectTkHome', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 *获取收藏分类数
 */
function GetCountCollectTk(params) { //获取收藏分类数
    return new Promise(function(resolve) {
        $post('/webapi/user/GetCountCollectTk', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 *获取错题分类数
 */
function GetCountErrorTk(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetCountErrorTk', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 *获取用户练习记录
 */
function GetTestRecordList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetTestRecordList', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 *删除用户练习记录
 */
function DeletePaperTest(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeletePaperTest', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 *获取用户考试记录
 */
function GetPaperRecordList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetPaperRecordList', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 *删除用户考试记录
 */
function DeletePaperRecord(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/DeletePaperRecord', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 *获取我的考试套餐包列表
 */
function MyFeeSellList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/MyFeeSellList', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 *获取我的考试套餐包详情
 */
function GetFeePackagesList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetFeePackagesList', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 *获取所有套餐包详情
 */
function GetFeePackagesDetail(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetFeePackagesDetail', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 *购买套餐包
 */
function BuyFeePackages(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/BuyFeePackages', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 *我的套餐包详情
 */
function MyFeeSellDetail(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/MyFeeSellDetail', params).then(function(res) {
            resolve(res.data)
        })
    })
}
/**
 *试题纠错
 */
function GetUserTkCorrectionList(params) {
    return new Promise(function(resolve) {
        $post('/webapi/user/GetUserTkCorrectionList', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 *我的表单
 */
function MyFormList(params) {
    return new Promise(function(resolve) {
        $get('/webapi/user/MyFormList', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 *我的表单类型
 */
function MyFormHead(params) {
    return new Promise(function(resolve) {
        $get('/webapi/user/MyFormHead', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 *我的表单数据详情
 */
function MyFormView(params) {
    return new Promise(function(resolve) {
        $get('/webapi/user/MyFormView', params).then(function(res) {
            resolve(res.data)
        })
    })
}

/**
 *我的表单数据删除
 */
function DelFormRecord(params) {
    return new Promise(function(resolve) {
        $get('/webapi/user/DelFormRecord', params).then(function(res) {
            resolve(res.data)
        })
    })
}