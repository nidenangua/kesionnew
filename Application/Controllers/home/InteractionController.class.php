<?php
// +----------------------------------------------------------------------
// | 科汛教育微门户
// +----------------------------------------------------------------------
// | Copyright (C) 2017-2019 kesion.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 厦门科汛软件有限公司
// +----------------------------------------------------------------------
// | Advice: 好的编程习惯是成功的一半，对齐，注释  你可以的！
// +----------------------------------------------------------------------



use Kesion\Controller;
class InteractionController 
{
	/*
	 * 保利威直播状态回调
	 */
	public function polyvBackAction()
	{
		$channelId    =  ChkClng(KS_G('request.channelId'));
		$status       =  ChkSQL(KS_G('request.status'));
		$timestamp    =  ChkClng(KS_G('request.timestamp'));
		$sign         =  ChkSQL(KS_G('request.sign'));
		if (empty($channelId)||empty($status)||empty($timestamp)||empty($sign)) exit();
		$model_live = new \Kesion\Model\App\LiveModel();
//		$aa = $model_live->service_model->checkSign($sign,$timestamp);
//		if (!$aa) exit();//签名验证
		$channelModel = M('app_course_channel');
		$channel = $channelModel->getRow("where channelid=$channelId");	if (!$channel) exit();
		$redis = new \Redis() or die("Cannot load Redis module.");//启动redis 进行缓存
		$redis->connect(REDIS_SERVER,REDIS_PORT);
		$redis->auth(REDIS_PWD);//redis改为你的redis密码
		if ($status=='live'){
			$model_live->addLiveLog($channel['courseid'],0,$channel['wxid']);
			$redis->set("live_status:$channel[courseid]:0",1);
		}else{
			$redis->set("live_status:$channel[courseid]:0",0);
			$model_live->lianMaiSettlement($channel['courseid'],0,$channel['wxid']);//结算扣钱
		}
	}
    public function chatAction(){ 
   	    $type       =  ChkClng(KS_G('request.type'));
   	    if($type==2){
   	     	include  CURR_VIEW_PATH . "Interaction/ask.php";	
   	    }else{
   	     	include  CURR_VIEW_PATH . "Interaction/chat.php";	
   	    }
    }
    public function PadScheduleAction(){
   	    $week = date('W',time());//当前是的那一周
     	$year = date('Y',time());
     	$classid=ChkClng(KS_G('get.id'));
     	$teacherModel = M('common_user_teacher');
		$teacherClassModel = M('app_class_teacherrelate');
     	$where =" as a left join $teacherModel->table as b on a.teacherid = b.userid where a.classid=$classid order by a.isspeaker desc";
		$teachers = $teacherClassModel->getAll($where);
     	include  CURR_VIEW_PATH . "Interaction/PadSchedule.php";	
    }
    //安卓学生课表
    public function studentScheduleAction(){
    	$week = date('W',time());
     	$year = date('Y',time());
     	$userid=ChkClng(KS_G('get.id'));
     	$wxid=ChkClng(KS_G('get.wxid'));
     	include  CURR_VIEW_PATH . "Interaction/studentSchedule.php";	
    }
    //安卓学生课表
    public function testUploadAction(){
    	 $vod = new Core\Playvdo();  
		 $aa =$vod -> getUploadAuth();
		 $UploadAuth=json_decode($aa);
//       $aa =$vod ->getPlayAddress('572f4c29342b4c5ca79d3f73784e3c66');
//       $aa =$vod ->getPlayAuth('572f4c29342b4c5ca79d3f73784e3c66');
//       var_dump($aa).die;
   	     include  CURR_VIEW_PATH . "Interaction/testUpload.php";	
    }
    //获取当前周的时间轴
	public function getDateAction(){
		 $year  =  ChkSQL(KS_G("post.year"));
		 $week  =  ChkSQL(KS_G("post.week"));
		 $n     =  week($year);
		 if($week==0){$year = (int)$year-1;$week = week((string)$year);}
		 if($n<$week){$year = (int)$year+1;$week =1;}
		 $result = weekday($year,$week);
		 $nowtime =date('Y-m-d',time());
		 $data=array();
		 for($i=0;$i<7;$i++){
		 	 $time =$result['start']+$i*86400;
		 	 $data[$i]['time']=date('Y-m-d',$time);
		 	 if($nowtime ==$data[$i]['time'] ){$data[$i]['status']=1;
		 	 }else{$data[$i]['status']=0;}
		 }
		 echo json_encode($data);
	}
	//获取课表
	function getscheduleAction(){
		$year = date('Y',time());
		$week = date('W',time());
		$Data001['year']=$year;
		$Data001['week']=$week;
		
		$wxid = ChkClng(KS_G('post.wxid'));
		$week = intval($week);
		$classid = ChkClng(KS_G('post.classid'));
//	    $teacherModel = M('common_user_teacher');
//	    $roomModel=M('app_classroom');
//		$model = M('app_class_schedule');
		$teacherid = ChkClng(KS_G('post.teacherid'));
		
		
		$Data001['wxid']=$wxid;
		$classMModel = M('App/ClassModel');
	
		$values=$classMModel->getSchedule($Data001,1);
		
		
		
		
		
		
		
//		if($teacherid==0){
//			$values = $model->getAll(' where  classid='.$classid.' and year ='.$year.' and week ='.$week,'id,day,dayPm,timeSlotStart,timeSlotEnd,teacherid,type,title,classroomid');
//		}else{
//			$values = $model->getAll(' where  classid='.$classid.' and year ='.$year.' and week ='.$week.' and teacherid ='.$teacherid,'id,day,dayPm,timeSlotStart,timeSlotEnd,teacherid,type,title,classroomid');
//		}
//		foreach($values as $k=>$v){
//			if($v['dayPm']==1){
//			    $values[$k]['element']='a'.$v['day'];
//			}elseif($v['dayPm']==2){
//				$values[$k]['element']='b'.$v['day'];
//			}elseif($v['dayPm']==3){
//				$values[$k]['element']='c'.$v['day'];
//			}
//			$values[$k]['time'] = timeformat($v['timeSlotStart']).'~'.timeformat($v['timeSlotEnd']);
//			$values[$k]['name'] = $teacherModel->getOne('name','where userid ='.$v['teacherid']);
//			$classroom          = $roomModel->getOne('classroomname','where id='.$v['classroomid']);
//			if($v['type']==2){
//			    $values[$k]['type']='线上  '.$classroom;
//			}else{
//				$values[$k]['type']='线下  '.$classroom;
//			}
//			$value[$k]['title']=$v['title'];
//		}
		echo json_encode($values);
	}
	//获取学生课表
	function getStudentScheduleAction(){
		$wxid   = ChkClng(KS_G('post.wxid'));
		$postStr=json_decode(file_get_contents("php://input"));
		$memberid =$postStr->memberid;
		$wxid =$postStr->wxid;
		$nowtime =  $postStr->nowtime;
		$stattime = mktime(0, 0 , 0,date("m",$nowtime),date("d",$nowtime),date("Y",$nowtime));
	    $endtime = mktime(23, 59 , 59,date("m",$nowtime),date("d",$nowtime),date("Y",$nowtime));
		$roomModel=M('app_classroom');
		$model = M('app_class_schedule');
		$classrelasteModel=M('app_class_studentrelate');
		$classids= $classrelasteModel->getAll('where wxid='.$wxid.' and memberid='.$memberid);
		$values=array();
		foreach($classids as $k=>$v){
			$value = $model->getAll(' where  classid='.$v['classid'].' and (timeSlotStart>='.$stattime.' and timeSlotStart<='.$endtime.')','id,day,dayPm,timeSlotStart,timeSlotEnd,teacherid,type,title,classroomid');
			$values = array_merge($values,$value);
		}
		$teacherModel=M('common_user_teacher');
		foreach($values as $k=>$v){
			if($v['dayPm']==1){
			    $values[$k]['element']='a'.$v['day'];
			}elseif($v['dayPm']==2){
				$values[$k]['element']='b'.$v['day'];
			}elseif($v['dayPm']==3){
				$values[$k]['element']='c'.$v['day'];
			}
			$values[$k]['time'] = timeformat($v['timeSlotStart']).'~'.timeformat($v['timeSlotEnd']);
			$values[$k]['name'] = $teacherModel->getOne('name','where userid ='.$v['teacherid']);
			$classroom          = $roomModel->getOne('classroomname','where id='.$v['classroomid']);
			if($v['type']==2){
			    $values[$k]['type']='线上  '.$classroom;
			}else{
				$values[$k]['type']='线下  '.$classroom;
			}
			$value[$k]['title']=$v['title'];
		}
		echo json_encode($values);
	}
	/*获取我的课表中的一周的时间*/
    public function studentDateAction(){
    	$postStr=json_decode(file_get_contents("php://input"));
		 $nowtime =  $postStr->nowtime;
		 $Data003['year'] = date('Y',$nowtime);
		 $Data003['week'] = date('W',$nowtime);
		 $Data003['num'] = 8;
		 $ConsultModel          = M('App/ConsultModel');
		 $results               = $ConsultModel->getTime($Data003);
		 foreach($results as $k=>$v){
		 	switch($k){
		 		case 0:$results[$k]['texttime']='周一';break;
		 		case 1:$results[$k]['texttime']='周二';break;
		 		case 2:$results[$k]['texttime']='周三';break;
		 		case 3:$results[$k]['texttime']='周四';break;
		 		case 4:$results[$k]['texttime']='周五';break;
		 		case 5:$results[$k]['texttime']='周六';break;
		 		case 6:$results[$k]['texttime']='周日';break;}
		   
		 }
		 $results[$k]['ishave'] = 1;
		echo json_encode($results);
    }
    //互动工具
    function InteractiveAction(){
    	$id   = ChkClng(KS_G('get.id'));
    	if($id==3){
    		include  CURR_VIEW_PATH . "Interaction/announce.php";	
    	}elseif($id==2){
    		include  CURR_VIEW_PATH . "Interaction/signIn.php";	
    	}elseif($id==1){
    		include  CURR_VIEW_PATH . "Interaction/vote.php";	
    	}elseif($id==4){
    		include  CURR_VIEW_PATH . "Interaction/examination.php";	
    	}elseif($id==5){
    		include  CURR_VIEW_PATH . "Interaction/answer.php";	
    	}elseif($id==6){
    		include  CURR_VIEW_PATH . "Interaction/praise.php";	
    	}elseif($id==7){
    		include  CURR_VIEW_PATH . "Interaction/criticism.php";	
    	}
    }
    //签到详情
    function signInDetailsAction(){
    	$id      = ChkClng(KS_G('get.id'));
    	include  CURR_VIEW_PATH . "Interaction/signInDetails.php";	
    }
    //公告
    function announceAction(){
    	$id      = ChkClng(KS_G('get.id'));
    	include  CURR_VIEW_PATH . "Interaction/announce.php";	
    }
    //公告记录
    function announceRecordsAction(){
    	$id      = ChkClng(KS_G('get.id'));
    	include  CURR_VIEW_PATH . "Interaction/announceRecords.php";	
    }
    //公告详情
    function announceViewAction(){
    	$id      = ChkClng(KS_G('get.id'));
    	include  CURR_VIEW_PATH . "Interaction/announceView.php";	
    }
    //答题
    function answerAction(){
    	$id      = ChkClng(KS_G('get.id'));
    	include  CURR_VIEW_PATH . "Interaction/answer.php";	
    }
    //答题记录
    function answerRecordAction(){
    	$id      = ChkClng(KS_G('get.id'));
    	include  CURR_VIEW_PATH . "Interaction/answerRecord.php";	
    }
    //题库选择
    function tkselectionAction(){
    	include  CURR_VIEW_PATH . "Interaction/tkselection.php";	
    }
    //教师端考试
    function examinationAction(){
    	$id      = ChkClng(KS_G('get.id'));
    	include  CURR_VIEW_PATH . "Interaction/examination.php";	
    }
    //试卷选择
    function examselectAction(){
    	include  CURR_VIEW_PATH . "Interaction/examselect.php";	
    }
    //试卷设置
    function examsettingAction(){
    	include  CURR_VIEW_PATH . "Interaction/examsetting.php";	
    }
    //试卷批改
    function examcorrectAction(){
    	include  CURR_VIEW_PATH . "Interaction/examcorrect.php";	
    }
    //考试记录
    function examRecordAction(){
    	include  CURR_VIEW_PATH . "Interaction/examRecord.php";	
    }
    //添加投票
    function addavoteAction(){
    	include  CURR_VIEW_PATH . "Interaction/addavote.php";	
    }
    //投票列表
    function voteListAction(){
    	include  CURR_VIEW_PATH . "Interaction/voteList.php";	
    }
    //表扬
    function praiseAction(){
    	include  CURR_VIEW_PATH . "Interaction/praise.php";	
    }
    //批评
    function criticismAction(){
    	include  CURR_VIEW_PATH . "Interaction/criticism.php";	
    }
    //表扬详情
    public function seePraiseAction(){	
     	$id = ChkClng(KS_G("request.id"));
		include  CURR_VIEW_PATH . "Interaction/seePraiseOrCriticism.php";	
    }
}