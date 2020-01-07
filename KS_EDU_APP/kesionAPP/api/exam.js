import {GET,POST} from './main.entrance.js'

/*获取试卷分类*/
export function GetAllPaperCategory(params) {
	return GET('/webapi/paper/GetAllPaperCategory',params,['appToken',"userId"])
}
/*获取学习记录数据*/
export function GetSubjectStatistics(params) {
	return POST('/webapi/paper/SubjectStatistics',params,['appToken',"userId"])
}
/*练习知识点*/
export function GetPaperKnowledge(params) {
	return GET('/webapi/paper/GetPaperKnowledge',params,['appToken',"userId"])
}
/*练习章节*/
export function GetPaperSection(params) {
	return POST('/webapi/paper/GetPaperSection',params,['appToken',"userId"])
}
/*获取套卷分类*/
export function GetAllPaperType(params) {
	return GET('/webapi/paper/GetAllPaperType',params,['appToken',"userId"])
}
/*每日一练*/
export function GetPaperList(params) {
	return GET('/webapi/paper/GetPaperList',params,['appToken',"userId"])
}

/*获取练习记录*/
export function GetTestRecordList(params) {
	return POST('/webapi/user/GetTestRecordList',params,['appToken',"userId"])
}
/*获取考试记录*/
export function GetPaperRecordList(params) {
	return POST('/webapi/user/GetPaperRecordList',params,['appToken',"userId"])
}
/*删除考试记录*/
export function DeletePaperRecord(params) {
	return POST('/webapi/user/DeletePaperRecord',params,['appToken',"userId"])
}
/*获取错题数*/
export function GetCountErrorTk(params) {
	return POST('/webapi/user/GetCountErrorTk',params,['appToken',"userId"])
}
/*获取错题数*/
export function ErrorTkHome(params) {
	return GET('/webapi/user/ErrorTkHome',params,['appToken',"userId"])
}
/*获取收藏数*/
export function CollectTkHome(params) {
	return GET('/webapi/user/CollectTkHome',params,['appToken',"userId"])
}
/*获取收藏数*/
export function GetCountCollectTk(params) {
	return POST('/webapi/user/GetCountCollectTk',params,['appToken',"userId"])
}
 /**考试内页 */
export function PaperDesc(params){
    return GET("/webapi/paper/PaperDesc", params, ["appToken","userId"]);
}
  /**加入收藏 */
export function SetPaperCollect(params){
    return POST("/webapi/user/SetPaperCollect", params, ["appToken","userId"]);
}
 /**试题纠错类型 */
 export function GetPaperErrortype(params){
      return POST("/webapi/paper/GetPaperErrortype", params,["appToken","userId"]);
  }
  /**每日一练内容 */
export function GetDailyTestPaper(params){
      return GET("/webapi/paper/GetDailyTestPaper", params, ["appToken","userId"]);
}
   /**每日一练日期 */
export function GetDailyTestDateList(params){
    return GET("/webapi/paper/GetDailyTestDateList", params, ["appToken","userId"]);
}
 /**试卷显示 */
 export function GetPaperDetail(params){
      return GET("/webapi/paper/GetPaperDetail", params, ["appToken","userId"]);
  }
/**获取随机练习题目 */
 export function GetTestTk(params){
      return POST("/webapi/paper/GetTestTk", params, ["appToken","userId"]);
  }
  /**试题纠错 */
  export function SetTkCorrection(params){
       return POST("/webapi/user/SetTkCorrection", params, ["appToken","userId"]);
   }
   /**单题提交接口 */
  export function SubmitPaperAnswer(params){
       return POST("/webapi/paper/SubmitPaperAnswer", params, ["appToken","userId"]);
   }
    /**做题保存 */
   export function SetPaperAnswer(params){
        return POST("/webapi/paper/SetPaperAnswer", params, ["appToken","userId"]);
    }
	/**结束练习 */
	export function EndTest(params){
	      return POST("/webapi/paper/EndTest", params, ["appToken","userId"]);
	  }
  /**每日一练结束练习 */
 export function EndDailyTest(params){
      return POST("/webapi/paper/EndDailyTest", params, ["appToken","userId"]);
  }
  /**购买练习 */
 export function PayPaper(params){
      return POST("/webapi/paper/PayPaper", params, ["appToken","userId"]);
  }
  /**获取考试结果 */
  export function GetPerformance(params){
        return POST("/webapi/paper/GetPerformance", params, ["appToken","userId"]);
 }
 /**学生自己评分 */
  export function PaperSubjective(params){
       return POST("/webapi/paper/PaperSubjective", params, ["appToken","userId"]);
   }
   /**学生提交评分 */
  export function SubmitGrade(params){
       return POST("/webapi/paper/SubmitGrade", params, ["appToken","userId"]);
   }
/**试卷解析 */
 export function GetRecordDetail(params){
      return GET("/webapi/paper/GetRecordDetail", params, ["appToken","userId"]);
  }