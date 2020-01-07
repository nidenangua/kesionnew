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
class AjaxController extends CommonController
{
   
	
	//获取当前周的时间轴
	public function getDateAction(){
		 $year =  ChkSQL(KS_G("post.year"));
		 $week =  ChkSQL(KS_G("post.week"));
		
		 $n = week($year);
		 if($week==0){
		 	$year = (int)$year-1;
		 
		 	$week = week((string)$year);
		 }
		 if($n<$week){
		 	$year = (int)$year+1;
		 	$week =1;
		 }
		 $result = weekday($year,$week);
		 $nowtime =date('Y-m-d',time());
		 $data=array();
		 for($i=0;$i<7;$i++){
		 	 $time =$result['start']+$i*86400;
		 	 $data[$i]['time']=date('m-d',$time);
		 	 
		 	 if($nowtime ==$data[$i]['time'] ){
		 	 	$data[$i]['status']=1;
		 	 }else{
		 	 	$data[$i]['status']=0;
		 	 }
		 }
		 echo json_encode($data);
	}
	//添加时间课程
	function doAddscheduleAction(){
		if (!session_id()) session_start();
		if(isset($_SESSION['expiretime'])){
		 	if($_SESSION['expiretime'] > time()) {
		 		 $resule['result']='error';
		 	     $resule['msg']='您的请求太频繁，请稍后在试一试';
		     	 echo json_encode($resule);exit;
		  	}else{
		  		$_SESSION['expiretime'] = time()+2; 
		  	}
		}else{
			$_SESSION['expiretime'] = time()+2;
		}
		   $classModel=M('app_class');
		   $teacherModel=M('common_user_teacher');
		   $userModel=M('common_user');
		   $starttime  = ChkClng(KS_G('post.startTime'));
     	   $endtime  = ChkClng(KS_G('post.endTime'));
     	   $Data['teacherid']=0;
     	 $day =null !==GF('nowday') ? GF('nowday'):'0';
     	  $Data['dayPm']  =null !==GF('dayPm') ? GF('dayPm'):'0';
     	  $chargetype  =null !==GF('chargetype') ? GF('chargetype'):'0';
     	  
     	   $memberid = ChkClng(KS_G('post.memberid'));
     	  if($chargetype==0){
     	  	  $Data['classid']  =null !==GF('classid') ? GF('classid'):'0';
     	  	  $classlevel  =null !==GF('classlevel') ? GF('classlevel'):'0';
     	  	  if($classlevel==2){
     	  	  	  $teacherrelateModel=M('app_class_teacherrelate');
     	  	  	  $Data['teacherid']=$teacherrelateModel->getOne('teacherid','where classid='.$Data['classid'].' and isspeaker=1');
     	  	  	  $memberModel=M('common_user_member');
     	  	  	  $tea=$userModel->getRow(' as a inner join '.$memberModel->table.' as b on a.userid=b.userid where a.userid='.$memberid.' limit 1','a.username,b.name');
     	  	  }else{
	     	  	  $Data['teacherid'] = ChkClng(KS_G('post.teacherid'));
	     	  	  $tea=$userModel->getRow(' as a inner join '.$teacherModel->table.' as b on a.userid=b.userid where a.userid='.$Data['teacherid'].' limit 1','a.username,b.name');
     	  	  }
     	  	  $resule['name']=!empty($tea['name']) ? $tea['name'] : $tea['username'];
     	  }else{
     	  	   $classlevel  = ChkClng(KS_G('post.classlevel'));
     	  	   if($classlevel==2 && $memberid==0){
     	  	   	 $resule['result']='error';
		 	     $resule['msg']='添加失败，请选择学生';
		     	 echo json_encode($resule);exit;
     	  	   }
     	  	   $Data['teacherid']  =null !==GF('teacherid') ? GF('teacherid'):'0';
     	  	   $Data['classid'] = ChkClng(KS_G('post.classid'));
     	  	   $class=$classModel->getRow(' where classid='. $Data['classid'].' limit 1');
     	  	   $resule['name']=$class['title'];
     	  }
     	
     	  $weektype  =null !==GF('weektype') ? GF('weektype'):'0';
     	 
     	  $Data['wxid'] = $this->wxid;
     	  $Data['assisantid']= ChkClng(KS_G('post.assisantid'));
     	  $Data['memberid']= $memberid;
     	  $Data['classroomid']= ChkClng(KS_G('post.classroomid'));
     	  $Data['type']  = ChkClng(KS_G('post.type'));
     	  $Data['title']=ChkSQL(KS_G("post.title"));
     	  $Data['groupid']=1;
     	  $time=null !==GF('time') ? GF('time'):'0|0';
     	  $times=explode('|',$time);
     	  
     	  if( $Data['teacherid']==0){
     	  	 $resule['result']='error';
	 	     $resule['msg']='添加失败，请选择老师';
	     	 echo json_encode($resule);exit;
     	  }
     	  
     	  
     	$model = M('app_class_schedule');
     	
	    
	    $Data['weektype']=$weektype;
	    $id=0;
	     
	     if($weektype==0){
		     	$thisweek= strtotime(date('Y-m',$times[0]));
		     	$starttime=$thisweek+($day*24*3600)+$starttime;
		        $endtime=$thisweek+($day*24*3600)+$endtime;
		     	  $a=0;
		     	  for($i=1;$i<15;$i++){
						if($starttime>$times[1]){
							break;
						}elseif($starttime>$times[0]){
							$Data['timeSlotStart']=$starttime;
						    $Data['timeSlotEnd']=$endtime;
					 	    $Data['year']=date('Y',$Data['timeSlotStart']);
							$Data['week']=date('W',$Data['timeSlotStart']);//当前是的那一周
							$Data['day']=$day;
							$info = $model ->getAll('where wxid='.$Data['wxid'].'  and  classid='.$Data['classid'].' and timeSlotStart='.$Data['timeSlotStart'].' and timeSlotEnd='.$Data['timeSlotEnd']);
							if($info){
								$resule['result']='error';
						 	    $resule['msg']='该班级该事件已经排课请勿重复排课';
						     	echo json_encode($resule);exit;
							}
							$id=$model->doAdd($Data,'id');
						}
						$starttime=$starttime+(7*24*3600);	
						$endtime=$endtime+(7*24*3600);	
				}
			
	     }else{
	     	   foreach($times as $k=>$v){
	     	   	     if(($k+1)==$day){
	     	   	     	$Data['timeSlotStart']=$starttime+$v;
						$Data['timeSlotEnd']=$endtime+$v;
						$Data['year']=date('Y',$Data['timeSlotStart']);
	    				$Data['week']=date('W',$Data['timeSlotStart']);//当前是的那一周
						$Data['day']=weekdaysnum($Data['timeSlotStart']);
					   	$info = $model ->getAll('where wxid='.$Data['wxid'].'  and  classid='.$Data['classid'].' and timeSlotStart='.$Data['timeSlotStart'].' and timeSlotEnd='.$Data['timeSlotEnd']);
						if($info){
							$resule['result']='error';
					 	    $resule['msg']='课表重复';
					     	echo json_encode($resule);exit;
						}
					   	$id=$model->doAdd($Data,'id');
	     	   	     }
	     	   	    
	     	   }
	     }
	     if($id==0){
	     	 $resule['result']='error';
	 	     $resule['msg']='添加失败,该日期不在选择内';
	     	echo json_encode($resule);exit;
	     }
	     
	     $teacherrelateModel=M('app_class_teacherrelate');
	     $teacherids=$teacherrelateModel->getAll(' where wxid='.$Data['wxid'].'  and  classid='.$Data['classid'],'teacherid');
	     $teacheids = array_column($teacherids, 'teacherid');
	     if(!in_array($Data['teacherid'],$teacheids)){
	     	$Datass['classid']=$Data['classid'];
	     	$Datass['teacherid']=$Data['teacherid'];
	     	$Datass['wxid']=$Data['wxid'];
	     	$teacherrelateModel->doAdd($Datass,'id');
	     }
	     $Data2['groupid']=$id;
     	 $model->update($Data2,' classid='.$Data['classid'].' and groupid=1'); 
	 	   if($Data['type'] == 1){
	 	   	    $roomModel=M('app_classroom');
	 	        $classroom=$roomModel->getOne('classroomname','where id='.$Data['classroomid']);
				$resule['type']='线下  '.$classroom;
	 	   	   
	 	   }elseif($Data['type']==2){
			    $resule['type']='线上  ';
			    $liveModel=M('app_live_list');
	 	   	    $live = $liveModel->getRow(' where wxid='.$this->wxid.' and classid='.$Data['classid'].' limit 1');
	 	   	    if(!$live){  
	 	   	   	   $maxid = $liveModel->getMaxValue('id')+1;
		  	       $Data1['channlName']=str_pad($maxid,6,"0",STR_PAD_LEFT);
		  	       $Data1['password']=rand(10000,99999);
		  	       $Data1['adddate']=time();
		  	       $Data1['teacherid'] = $Data['teacherid']; 
		  	       $Data1['status'] = 1; 
			  	   $Data1['wxid'] = $this->wxid;
			  	   $Data1['type'] = 2;
			  	   $Data1['classid']=$Data['classid'];
			  	   $classlevel=$classModel->getOne('classlevel',' where classid='.$Data['classid'].' limit 1');
			  	   $Data1['classlevel']=$classlevel;
			  	   $chaptertableModel    = new CourseModel('common_extends_table');
			       $Data1['studentTable'] = $chaptertableModel->getOne('tablename','where Isdefault=1 and type =3');
			  	   $liveModel->doAdd($Data1,'id');
	 	   	    }    
			}
	 	   $resule['result']='success';
	 	   $resule['msg']='添加成功';
	 	   $resule['id']=$id;
	 	   if($Data['dayPm']==1){
	 	   	  $zone='a';
	 	   }elseif($Data['dayPm']==2){
	 	   	$zone='b';
	 	   }else{
	 	   	 $zone='c';
	 	   }
	 	   $resule['zone']=$zone.$day;
	 	 
	 	   echo json_encode($resule);
	}
	
	
	function doEditorsAction(){
		  $scheduleid =null !==GF('scheduleid') ? GF('scheduleid'):'0';
		  $Data['classid'] = ChkClng(KS_G('get.id'));
     	  $Data['wxid'] = $this->wxid;
     	  $Data['assisantid']= ChkClng(KS_G('post.assisantid'));
     	  $Data['teacherid']= ChkClng(KS_G('post.teacherid'));
     	  $Data['classroomid']= ChkClng(KS_G('post.classroomid'));
     	  $Data['memberid']= ChkClng(KS_G('post.memberid'));
     	  $Data['type']  = ChkClng(KS_G('post.type'));
     	  $Data['title']=ChkSQL(KS_G("post.title"));
     	  $a=$Data['timeSlotStart']=ChkClng(KS_G("post.startTime"));
     	  $b=$Data['timeSlotEnd']=ChkClng(KS_G("post.endTime"));
	 	   $model = M('app_class_schedule');
	 	  	 //判断同一个班级内时间
	 	  	$where =" ((timeSlotStart>=$a AND timeSlotStart<=$b) or (timeSlotStart<= $a AND timeSlotEnd>=$b) or ( timeSlotStart>=$a  AND  timeSlotEnd<=$b))";
	 		  
	 	  	$istime = $model->getRow(' where wxid='.$this->wxid.' and classid='.$Data['classid'].' and  id !='.$scheduleid.' and '.$where);
	 	  	if($istime){
	 	  		  $resule['result']='error';
			 	   $resule['msg']='该班级在该时段已有课程';
		 	       echo json_encode($resule);exit;
		 	}
		 	$isteacher=$model->getRow(' where wxid='.$this->wxid.' and teacherid='.$Data['teacherid'].' and id !='.$scheduleid.' and '.$where);
		 	
		 	
		 	if($isteacher){
	 	  		  $resule['result']='error';
	 	  		  $classname =$this->AppModel->getRow('  where  wxid='.$this->wxid.' and classid='.$isteacher['classid'].' limit 1');
			 	   $resule['msg']='该老师在该时间段在班级'.$classname['title'].'已经有课了';
		 	       echo json_encode($resule);exit;
		 	} 	
		   if($Data['type'] ==1){
		 		$isclassroom=$model->getRow(' where wxid='.$this->wxid.' and classroomid='.$Data['classroomid'].' and '.$where);
			 	if($isteacher){
		 	  		  $resule['result']='error';
				 	   $resule['msg']='该教室在该时间段 已经有课了';
			 	       echo json_encode($resule);exit;
			 	} 
			 	$classroomModel=M('app_classroom');
		 		$galleryful=$classroomModel->getOne('galleryful','where id='.$Data['classroomid'].' limit 1');
		 		if($galleryful<$this->class['studentnum']){
		 			   $resule['result']='error';
				 	   $resule['msg']='该教室容纳人数不足';
			 	       echo json_encode($resule);exit;
		 		}	
		 	}
	 	   $model->update($Data,'id='.$scheduleid);
			if($Data['type'] == 1){
		 	   	   $liveModel=M('app_live_list');
		 	   	   $live = $liveModel->getRow(' where wxid='.$this->wxid.' and classid='.$Data['classid'].' limit 1');
		 	   	 
		 	   	   if(!$live){  
		 	   	   	   $maxid = $liveModel->getMaxValue('id')+1;
			  	       $Data1['channlName']=str_pad($maxid,6,"0",STR_PAD_LEFT);
			  	       $Data1['password']=rand(10000,99999);
			  	       $Data1['adddate']=time();
			  	       $Data1['teacherid'] = $Data['teacherid']; 
			  	       $Data1['status'] = 1; 
				  	   $Data1['wxid'] = $this->wxid;
				  	   $Data1['type'] = 2;
				  	   $Data1['classid']=$Data['classid'];
				  	   $chaptertableModel    = new CourseModel('common_extends_table');
				       $Data1['studentTable'] = $chaptertableModel->getOne('tablename','where Isdefault=1 and type =3');
				  	   $liveModel->doAdd($Data1,'id');
		 	   	   }
		 	   }
		
		  $resule['result']='success';
	 	   $resule['msg']='添加成功';
	 	   $resule['id']=$scheduleid;
	 	   echo json_encode($resule);	
	}
	
	
	//获取课表
	function getscheduleAction(){
		$year = ChkClng(KS_G('post.year'));
		
		$week = ChkClng(KS_G('post.week'));
		$day = ChkClng(KS_G('post.day'));
		$week = intval($week);
        $type = ChkClng(!empty(KS_G('post.type')) ? KS_G('post.type') : 0 );
        $classlevel = ChkClng(!empty(KS_G('post.classlevel')) ? KS_G('post.classlevel') : 3 );
		$classMModel = M('App/ClassModel');
		$Data001['wxid']=$this->wxid;
		$Data001['year']=$year;
		$Data001['week']=$week;
		$Data001['day']=$day;
		$Data001['classid'] = ChkClng(!empty(KS_G('post.classid')) ? KS_G('post.classid') : 0 );
		$Data001['teacherid'] = ChkClng(!empty(KS_G('post.teacherid')) ? KS_G('post.teacherid') : 0 );
		$Data001['classlevel']=$classlevel;
		$Data001['type']=$type;
		$result=$classMModel->getSchedule($Data001,1);
		$values=$result['values'];
		 echo json_encode($values);
		
	}
	
	
	//获取详细信息
	function scheduleInfoAction(){
		$id= ChkClng(KS_G('get.id'));
		$model = M('app_class_schedule');
		$value = $model->getRow(' where id='.$id,'id,day,dayPm,timeSlotStart,timeSlotEnd,teacherid,classroomid,title,type');
		$roomModel=M('app_classroom');
		$result['time']=timeformat($v['timeSlotStart']).'-'.timeformat($value['timeSlotEnd']);
		$classroom=$roomModel->getOne('classroomname','where id='.$value['classroomid']);
		 $teacherModel = M('common_user_teacher');
		if($v['type']==1){
			$result['type']='线上'.$classroom;
		}else{
			$result['type']='线上'.$classroom;
		}
		$result['name']=$teacherModel->getOne('name','where userid ='.$value['teacherid']);
		$result['title']=$value['title'];
		$result['id']=$value['id'];
		 echo json_encode($values);
		
	}
	//发布
	function ReleaseAction(){
		$id= ChkClng(KS_G('post.id'));
		$taskModel = M('app_task');
		$Data['status']=1;
		$a = $taskModel->update($Data,' id='.$id);
		if($a==1){
			 echo 'success';
		}else{
			 echo 'error';
		}
	}
	
	//获取日期
	function getdatetime(){
		$times = ChkSQL(KS_G("post.yearmonth"));
		
		
	}
	
	//获取学生
	function getstudentAction(){
		$classid=ChkClng(KS_G('post.classid'));
	
		$classModel = M('App/ClassModel');
		$Data001['classid']=$classid;
		$Data001['wxid']=$this->wxid;
		 $result=$classModel->getmember($Data001);
		 $member=$result['values'];
		 echo json_encode($member);
	}
	
	//获取助教     Assistant
	function getAssistantAction(){
		$classid=ChkClng(KS_G('post.classid'));
		$classstudent=M('app_class_teacherrelate');
		$memberModel=M('common_user_teacher');
		$userModel=M('common_user');
		$member=$classstudent->getAll(' as a  inner join '.$memberModel->table.' as b on a.teacherid=b.userid inner join '.$userModel->table.' as c  on a.teacherid=c.userid where  a.wxid='.$this->wxid.' and a.classid='.$classid,'c.username,b.name,b.userid');
		$result=array();
		foreach($member as $k=>$v){
			$result[$k]['name']=!empty($v['name']) ? $v['name'] : $v['username'];
			$result[$k]['userid']=$v['userid'];
		}
		 echo json_encode($result);
	}
	//删除课表
	function delscheduleAction(){
		$id= ChkClng(KS_G('post.scheduleid'));
		$model = M('app_class_schedule');
		$model->delete(' groupid='.$id);
		$values['result'] ='success';
		 echo json_encode($values);
	}
      
	
	
	
	
	
}
