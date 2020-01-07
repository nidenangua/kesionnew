
import {GET,POST} from './main.entrance.js'

/*获取课程类型*/
export function GetCourseTypeList(params) {
	return GET('/webapi/app/GetCourseTypeList',params,['appToken'])
}
/*获取课程分类*/
export function GetCourseClass(params) {
	return GET('/webapi/Course/GetCourseClass',params)
}
/*获取课程列表*/
export function GetVodList(params) {
	return GET('/webapi/Course/GetVodList',params)
}
/*获取课时列表*/
export function GetcosInfo(params) {
	return GET('/plus/ajaxs.ashx?a=getcosInfo',params,['appToken'])
}

/*获取课时播放*/
export function PlayVod(params) {
	return GET('/webapi/Course/PlayVod',params,['appToken'])
}

/*获取直播信息*/
export function PlayLive(params) {
	return GET('/webapi/Course/PlayLive',params,['appToken'])
}

/*获取课时列表(数据重构)*/
export function getCourseCatalog(props = {}){
	return new Promise(resolve=>{
		/**
		 * 将秒数转换 mm:ss 格式
		 * @param ss 秒
		 */
		let secondsConversion = function(ss) {
		    var time = Number(ss);
		    var hour = Math.floor(time / 3600);
		    var minute = Math.floor((time - hour * 3600) / 60);
		    var second = time - hour * 3600 - minute * 60
		    hour = hour.toString().length < 2 ? '0' + hour : hour
		    minute = minute.toString().length < 2 ? '0' + minute : minute
		    second = second.toString().length < 2 ? '0' + second : second
		    return hour === '00' ? minute + ':' + second : hour + ':' + minute + ':' + second
		}
		let courseType = props.courseType;
		let url = courseType === 'face' ? '/plus/ajaxs.ashx?a=getcosInfo&isface=1' : '/plus/ajaxs.ashx?a=getcosInfo';
		GET(url+'&courseid='+props.courseid,{
			schoolid:props.schoolid
		},['appToken']).then(data=>{
			
		    let coursebuyurl = data.Course.coursebuyurl;
		    let teachway = data.Course.teachway;
		    /**课程购买情况*/
			let courseFree = data.Course.isfree == 0
		    let specialPermission = false;
		    let buyallcos_isCanLearn = false;
		    let myPeriodids = [];
		    let Pay = data.Pay;
			let isloginplay = data.isloginplay;
		    let ispower = data.ispower;
			let timespan = data.timespan
		    /**判断是否有特殊权限*/
		    if (ispower == 1) {
		        specialPermission = true
		
		    } else if (Pay) {
		
		        /**是否购买了整个课程*/
		        let isbuyallcos = Pay.isbuyallcos;
		        let shixian = Pay.shixian;
		        if (isbuyallcos == 1) {
		            if (shixian == 0) {
		                /**该课程未限制时间*/
		                buyallcos_isCanLearn = true;
		            } else {
		                /**限制了时间，检查课程是否已过期*/
		                let enddate = new Date(Pay.enddate).getTime();
		                if (enddate > timespan) {
		                    buyallcos_isCanLearn = true
		                }
		            }
		
		        } else {
		            let periodlist = Pay.periodlist;
		            periodlist.map(function(period_item) {
		                let enddate = period_item.enddate ? new Date(period_item.enddate).getTime() : null;
		                let ids = period_item.periodids.split(',');
		                for (let p = 0; p < ids.length; p++) {
		                    myPeriodids.push({
		                        id: ids[p],
		                        shixian: period_item.shixian,
		                        enddate: enddate
		                    });
		                }
		            });
		        }
		    }
		    /**
		     * 课程学习情况
		     */
		    let periodlist = data.Course.periodlist || [];
		    let periods = [];
		    let periodArr = [];
		    let chapterIndex = 0;
		    let sectionIndex = 0;
		    let periodIndex = 0;
		    /*重新构造目录结构*/
		    periodlist.map(function(item){
		        let addtype = Number(item.addtype);
		        let parentid = item.parentid;
		        switch(addtype){
		            case 0:
		                /**章*/
		                chapterIndex++;
		                item.$id = chapterIndex;
		                item.$unit = '第 '+chapterIndex+' 章';
		                item.$textID = '第 '+chapterIndex+' 章';
		                item.$enname = 'chapter';
		                periods.push(item);
		                break
		            case 2:
		                /**节*/
		                item.$enname = 'section';
		                if(parentid == 0){
		                    sectionIndex++;
		                    item.$id = sectionIndex;
		                    item.$unit = '第 '+sectionIndex+' 节';
		                    item.$textID = '第 '+sectionIndex+' 节';
		                    periods.push(item);
		                }else{
		                    periods.map(function(cpt,i){
		                        if(cpt.periodid == parentid){
		                            if(!cpt.$childs){
		                                cpt.$childs = [];
		                            }
		                            item.$id = (i+1)+'.'+(cpt.$childs.length + 1);
		                            item.$unit = '第 '+(cpt.$childs.length + 1)+' 节';
		                            item.$textID = '第'+(i+1)+'章 '+ (cpt.$childs.length + 1) + '节';
		                            cpt.$childs.push(item);
		                        }
		                    })
		                }
		                break
		            case 1:
		            case 4:
		                /**
		                 * isCanLearn
		                 * 0 不可观看
		                 * 1 可观看
		                 * 2 已过期
		                 * 3 可试听
		                 */
		                item.$enname = 'period';
		                let isCanLearn = 0;
		                if (specialPermission || courseFree || item.isfree == 0 || buyallcos_isCanLearn) {
		                    /**该课时免费*/
		                    isCanLearn = 1
		                } else if (item.islistening == 1) {
		                    isCanLearn = 3
		                } else if (Pay) {
		                    if (Pay.isbuyallcos == 1 && buyallcos_isCanLearn) {
		                        /**
		                         * 购买了整个课程，并且课程未到期
		                         */
		                        isCanLearn = 1;
		                    } else {
		                        /**
		                         * 按课时购买
		                         * 遍历当前课时是否存在购买队列，并且课时未到期
		                         */
		                        for (let p = 0; p < myPeriodids.length; p++) {
		                            let period_item = myPeriodids[p];
		                            if (period_item.id == item.periodid) {
		                                if (period_item.shixian == 0) {
		                                    isCanLearn = 1;
		                                    break
		                                } else {
		                                    if (period_item.enddate > timespan) {
		                                        /**课时未到期，已满足学习条件，直接跳出循环*/
		                                        isCanLearn = 1;
		                                        break
		                                    } else {
		                                        /**
		                                         * 当前课时已过期，但不跳出循环，继续查找是否有重复购买同课时并且满足学习条件
		                                         */
		                                        if (period_item.islistening == 1) {
		                                            isCanLearn = 3
		                                        } else {
		                                            isCanLearn = 2
		                                        }
		                                    }
		                                }
		                            }
		                        }
		                    }
		                }
		                
		                switch(Number(item.type)){
		                    case 0:
		                        item.$type_name = '视频';
		                        break
		                    case 1:
		                        item.$type_name = '音频';
		                        break
		                    case 2:
		                        item.$type_name = '图文';
		                        break
		                    case 3:
		                        item.$type_name = 'PDF';
		                        break
		                    default:
		                        item.$type_name = '';
		                }
		                /**课时时间处理 */
		                if(item.type > 1){
		                    item.$duration = '';
		                }else if (item.timecount) {
		                    let time = secondsConversion(item.timecount);
		                    item.$duration = time;
		                }
		                /**直播时间 */
		                if(teachway == 5 && item.livetime && item.invaliddate){
		                    let timestamp_liveTime = new Date(item.livetime);
		                    let timestamp_invaliddate = new Date(item.invaliddate);
		                    if(timestamp_liveTime > timespan){
		                        item.$liveStateText = '直播未开始';
		                        item.$liveState = 0;
		                    }else if(timestamp_liveTime < timespan && timestamp_invaliddate > timespan){
		                        item.$liveStateText = '正在直播';
		                        item.$liveState = 1;
		                    }else if(timestamp_invaliddate < timespan){
		                        item.$liveStateText = '直播已结束';
		                        item.$liveState = 2;
		                    }
		                    item.$livetime = timestamp_liveTime.getFullYear() + '/' + (timestamp_liveTime.getMonth() + 1) + '/' + timestamp_liveTime.getDate() + ' ' + timestamp_liveTime.getHours() + ':' + timestamp_liveTime.getMinutes();
		                    
		                    if(timestamp_liveTime.getFullYear() === timestamp_invaliddate.getFullYear() && timestamp_liveTime.getMonth() === timestamp_invaliddate.getMonth() && timestamp_liveTime.getDate() === timestamp_invaliddate.getDate()){
		                        item.$invaliddate = timestamp_invaliddate.getHours() + ':' + timestamp_invaliddate.getMinutes()
		                    }else{
		                        item.$invaliddate = timestamp_invaliddate.getFullYear() + '/' + (timestamp_invaliddate.getMonth() + 1) + '/' + timestamp_invaliddate.getDate() + ' ' + timestamp_invaliddate.getHours() + ':' + timestamp_invaliddate.getMinutes();
		                    }
		                    item.$showLiveTime = true;
		                }
		
		                /**课时状态*/
		                let stateText = '去购买';
		                
		                switch(isCanLearn){
		                    case 1:
		                        if(teachway == 5){
		                            stateText = '进入直播';
		                        }else{
		                            if(item.haslearnpercent > 0){
		                                stateText = '继续学习';
		                            }else{
		                                stateText = '开始学习';
		                            }
		                        }
		                        break
		                    case 2:
		                        stateText = '已过期';
		                        break
		                    case 3:
		                        if(teachway == 5){
		                            stateText = '进入直播';
		                        }else{
		                            stateText = '免费观看';
		                        }
		                        break
		                }
		                item.$stateText = stateText;
		                item.$isCanLearn = isCanLearn;
		                /**更多按钮 */
		                let btns = [];
		                /**课时存在题库 */
		                if(item.haspapertk){
		                    btns.push({
		                        text:'题库练习',
		                        url:item.exerciseinfo.exercise_url,
		                        className:'ks-catalog-title__btn-lx',
		                        type:0
		                    },{
		                        text:'练习记录',
		                        url:item.exerciseinfo.exercise_record_url,
		                        className:'ks-catalog-title__btn-record',
		                        type:1
		                    });
		                }
		                /**课时存在资料 */
		                if(item.hasmaterial){
		                    let obj = {
		                        text:'课时资料',
		                        url:item.zlurl,
		                        className:'ks-catalog-title__btn-down',
		                        type:2
		                    };
		                    btns.push(obj);
		                }
		                item.$btns = btns;
		                item.$state = (isCanLearn === 1 || isCanLearn === 3) ? true : false;
		                let url = (isCanLearn === 1 || isCanLearn === 3) ? item.url : coursebuyurl;
		                if(item.periodlock !== 'true'){
		                    item.$url = url;
		                }
		                if(item.money){
		                    item.$money = parseFloat(item.money) ? parseFloat(item.money).toFixed(2) : false;
		                }
		                if(parentid == 0){
		                    periodIndex++;
		                    item.$unit = '课时 '+periodIndex;
		                    item.$textID = '课时 '+periodIndex;
		                    periods.push(item);
		                }else{
		                    periods.map(function(cpt,c){
		                        if(cpt.periodid == parentid){
		                            if(!cpt.$childs){
		                                cpt.$childs = [];
		                            }
		                            let _unit = cpt.addtype == 0 ? '章' : '节';
		                            item.$unit = '课时 '+(cpt.$childs.length+1);
		                            item.$textID = '第'+(c+1)+_unit;
		                            cpt.$childs.push(item);
		                        }else if(cpt.$childs){
		                            cpt.$childs.map(function(sec,s){
		                                if(sec.periodid == parentid){
		                                    if(!sec.$childs){
		                                        sec.$childs = [];
		                                    }
		                                    item.$unit = '课时 '+(sec.$childs.length+1);
		                                    item.$textID = '第'+(c+1)+'章 第'+(s+1)+'节';
		                                    sec.$childs.push(item);
		                                }
		                            });
		                        }
		                    });
		                }
		                periodArr.push(item);
		                break
		        }
			})
			resolve({
				periods:periodArr,
				catalogData:data
			})
		})
	})
}
/*获取课时笔记*/
export function GetBj(params) {
	return POST('/webapi/course/GetBj',params,['appToken'])
}
/*保存提交笔记*/
export function SaveBj(params) {
	return POST('/index.aspx?c=course&a=play&action=savebj',params,['appToken'])
}
/*获取课程试卷*/
export function GetPaper(params) {
	return POST('/WebApi/course/GetPaper',params,['appToken','userId'])
}
/*提交提问数据*/
export function SaveAskTopic(params) {
	return POST('/webapi/user/SaveAskTopic',params,['appToken','userId'])
}
/*获取提问数据列表*/
export function GetUserAskTopList(params) {
	
	return GET('/webapi/user/GetUserAskTopList',params,['appToken','userId'])
}

/*保存学习进度*/
export function SaveLearnProgress(params){
	return GET('/index.aspx?c=course&a=play&action=save',params,['appToken'])
}