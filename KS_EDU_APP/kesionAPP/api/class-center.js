import {
	GET,POST
} from './main.entrance.js'

// 课间列表
export function GetDataList(params) {
	return GET('/webapi/app/home',params)	
}
// 作品详情页
export function GetWorksView(params) {
	return GET('/webapi/APP/GetWorksView',params)	
}
// 资讯详情页
export function GetInfoView(params) {
	return GET('/webapi/APP/GetInfoView',params)
}
// 问答详情页
export function GetAskView(params) {
	return GET('/webapi/APP/GetAskView',params,['appToken','userId'])
}

// 回复问答
export function ReplyAskTopic(params) {
	return POST('/webapi/APP/ReplyAskTopic',params,['appToken','userId'])
}

// 关闭问题
export function CloseAsk(params) {
	return POST('/webapi/APP/CloseAsk',params,['appToken','userId'])
}

// 增加悬赏分接口
export function AddReward(params) {
	return POST('/webapi/APP/AddReward',params,['appToken','userId'])
}

// 设置回答为最佳答案
export function SetAskSatisfied(params) {
	return POST('/webapi/APP/SetAskSatisfied',params,['appToken','userId'])
}

// 删除回复
export function DeleteAnswer(params) {
	return POST('/webapi/APP/DeleteAnswer',params,['appToken','userId'])
}

// 发布问题
export function PublishAskTopic(params) {
	return POST('/webapi/APP/PublishAskTopic',params,['appToken','userId'])
}

// 小组详情
export function GetGroupListView(params) {
	return GET('/webapi/app/GetGroupListView',params,['appToken','userId'])
}

// 申请加入小组
export function JoinGroup(params) {
	return POST('/webapi/app/JoinGroup',params,['appToken','userId'])
}

// 发表话题
export function PublishTopic(params) {
	return POST('/webapi/app/PublishTopic',params,['appToken','userId'])
}

// 回复话题
export function ReplyTopic(params) {
	return POST('/webapi/app/ReplyTopic',params,['appToken','userId'])
}

// 话题详情
export function GetTopicView(params) {
	return POST('/webapi/app/GetTopicView',params,['appToken','userId'])
}

// 话题详情
export function GetAskClass(params) {
	return GET('/webapi/app/GetAskClass',params,['appToken','userId'])
}

// 班级列表
export function GetAllClassList(params) {
	return GET('/webapi/app/GetAllClassList',params)
}
