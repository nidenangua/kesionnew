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
class IndexController extends CommonController{
	public function indexAction(){
		$week = date('W',time());//当前是的那一周
     	$year = date('Y',time());
		include  CURR_VIEW_PATH . "index.php";
	}
    public function periodAccountAction(){//课时结算
		include  CURR_VIEW_PATH . "periodAccount.php";
	}
	public function schedulelistAction(){//日程列表
		
        $nowday  = null !==GF('nowday') ? GF('nowday'):date('Y-m',time());
        $date    = get_day($nowday,2);  
        $classMModel = M('App/ClassModel');
        $teacherid   = null !==GF('teacherid') ? GF('teacherid'):'0';
        $classid     = null !==GF('classid') ? GF('classid'):'0';
        $classlevel  = null !==GF('classlevel') ? GF('classlevel'):'3';
        $date        = null !==GF('date') ? GF('date'):date('Y-m',time());
        $dates       = get_day($date,2);
        $datetime    = null !==GF('datetime') ? GF('datetime'):strtotime(date('Y-m-d',time()));
        $Data001['wxid']      = $this->wxid;
        
        $Data001['teacherid'] = 0;
        $class = $classMModel->getTeacherClass($Data001);
        $Data001['classid']   = $classid;
        $teachers = $classMModel->getClassTeachers($Data001);
        $Data001['teacherid'] = $teacherid;
        $result = $classMModel->getSchedule($Data001);
        $values = $result['values'];
	    $page   = $result['page'];
	    $Data002['wxid']      = $this->wxid;
	    $class = $classMModel->getTeacherClass($Data002);
	    include  CURR_VIEW_PATH . "schedulelist.php";
	}
	public function addscheduleAction(){//新增排课弹窗
		$classModel=M('app_class');
		$class=$classModel->getAll('where wxid='.$this->wxid.' and status != -1','classid,classlevel,title');
		$userModel=M('common_user');
		$teacherModel=M('common_user_teacher');
		$teacher=$userModel->getAll(' as a inner join '.$teacherModel->table.' as b on a.userid =b.userid  where  a.wxid='.$this->wxid.' and a.status=1','b.name,a.userid,a.username' );
		include  CURR_VIEW_PATH . "addschedule.php";
	}
	public function addschedule2Action(){//新增排课列表
        $url = M_URL($this->AppName.'/Index','index','',GP('')); 
		$chargetype             = ChkClng(KS_G('post.chargetype'));
        $classMModel = M('App/ClassModel');
		if($chargetype == 0){//按班级
			$classid                = ChkClng(KS_G('post.classid'));
			$classModel=M('app_class');
			$class=$classModel->getRow(' where classid='.$classid.' limit 1');
			$classlevel             = ChkClng(KS_G('post.classlevel'));
			if($classlevel==2){
				$Data001['wxid']=$this->wxid;
				$Data001['classid']=$classid;
				$classstudent=$classMModel->getmember($Data001);	
				if(count($classstudent['values'])==0){KS_INFO('该班级暂无学生',3,$url);}
			}
		}else{
			$teacherid   = ChkClng(KS_G('post.teacherid'));
			$Data001['teacherid']=$teacherid;
			$teacher=$classMModel->getOneTeacher($Data001);    
		}
		$weektype      = ChkClng(KS_G('post.weektype'));
		if($weektype==0){//按周
			$starttime = ChkClng(KS_G('post.starttime'));
			$endtime   = ChkClng(KS_G('post.endtime'));
			if($starttime==0 || $endtime==0){
				KS_INFO('请添加开始时间或结束时间',3,$url);
			}
			$thisweek=date('Y-m',$starttime);
			$weekstarttime=strtotime($thisweek);
			$endtime= ChkClng(KS_G('post.endtime'));
			$week=numweeka($starttime,$endtime);
			$time=$starttime.'|'.$endtime;
			include  CURR_VIEW_PATH . "addschedule2.php";
		}else{
			$times = ChkSQL(KS_G("post.time"));
			if($times==''){
				KS_INFO('请添加排课时间',3,$url);
			}
			$time=implode('|',$times);
			include  CURR_VIEW_PATH . "addschedule4.php";
		}
	}
	public function addschedule3Action(){//新增排课下面的添加课表
        $chargetype  = null !==GF('chargetype') ? GF('chargetype'):'0';
		$dayPm       = null !==GF('dayPm') ? GF('dayPm'):'0';
	    $classMModel = M('App/ClassModel');
        $Data001['wxid']=$this->wxid;
		if($chargetype == 0){//按班级
			$classid     = null !==GF('classid') ? GF('classid'):'0';
		 	$classlevel  = null !==GF('classlevel') ? GF('classlevel'):'0';
		 	$teachers    = $classMModel->getClassTeachers($Data001);
		 	$Data001['classid']=$classid;
		 	if($classlevel == 2){	
		 		$result=$classMModel->getmember($Data001);
		 		$member=$result['values'];
		 	}
		}else{
			$teacherid            = ChkClng(KS_G('post.teacherid'));
			$Data001['teacherid'] = $teacherid;
			$class = $classMModel->getTeacherClass($Data001);    
		}
		$weektype      = ChkClng(KS_G('post.weektype'));
		if($weektype==0){//按周
			$starttime = ChkClng(KS_G('post.starttime'));
			$endtime   = ChkClng(KS_G('post.endtime'));
			$time      = $starttime.'|'.$endtime;
		}else{
			$times = ChkSQL(KS_G("post.time"));
			$time  = implode('|',$times);
		}
		$schoolModel = M('app_schooladdress');
		$where       = 'where wxid='.$this->wxid;
		$school      = $schoolModel -> getAll($where,'schoolid,school');
		$classroomModel = M('app_classroom');
		$classroom   = $classroomModel -> getAll($where,'id,schoolname,classroomname');
		include  CURR_VIEW_PATH . "addschedule3.php";
	}
	public function doaddscheduleAction(){
		$chargettype  = ChkClng(KS_G('request.chargettype'));
		$model = M('app_class_schedule');
		$Data['classid']         = ChkClng(KS_G('request.classid'));
		$Data['classroomid']     = ChkClng(KS_G('request.classroomid'));
		$Data['assisantid']    = ChkClng(KS_G('request.assisantid'));
		$Data['type']          = ChkClng(KS_G('request.type'));
		$Data['teacherid']     = ChkClng(KS_G('request'));
		$Data['memberid']      = ChkClng(KS_G('request.memberid'));
		$Data['title']         = ChkSQL(KS_G('request.title'));
		$weektype    = ChkClng(KS_G('request.weektype'));
		$starttime   = ChkClng(KS_G('request.starttime'));
		$endtime     = ChkClng(KS_G('request.endtime'));
		$time    = ChkSQL(KS_G('request.time'));
		$times   = explode('|',$time);
		if($weektype == 0){//按周
			for($i=1;$i<15;$i++){
				if($starttime>$times[1]){break;
				}elseif($starttime>$times[0]){
					$Data['year']=date('Y',$starttime);
					$Data['week']=date('W',$starttime);//当前是的那一周
					$Data['day']=weekdays($starttime);
					$Data['dayPm']=getHours($starttime);
					$Data['timeSlotStart']=$starttime;
					$Data['timeSlotEnd']=$endtime;
					$model->doAdd($Data,'id');
					$startsecond=$starttime+(7*24*3600);
					$endsecond=$endtime+(7*24*3600);
				}	
			}
		}else{
			foreach($times as $k=>$v){
				$starttime=$v+$startsecond;
			    $endtime=$v+$endsecond;
			    $Data['year']=date('Y',$starttime);
				$Data['week']=date('W',$starttime);//当前是的那一周
				$Data['day']=weekdays($starttime);
				$Data['dayPm']=getHours($starttime);
				$Data['timeSlotStart']=$starttime;
				$Data['timeSlotEnd']=$endtime;
				$model->doAdd($Data,'id');
			}
		}
	}
	public function courseclosingAction(){//新增排课下面
		$classMModel = M('App/ClassModel');
		$teacherid   = ChkClng(KS_G('get.id'));
		$Data002['teacherid']=$teacherid;
		$teacher=$classMModel->getOneTeacher($Data002);
	    $classModel=M('app_class');
        $Data001['wxid']=$this->wxid;
        $Data001['teacherid'] =$teacherid;
        $class=$classMModel->getTeacherClass($Data001); 
        $Data001['classid'] =null !==GF('classid') ? GF('classid'):'0';
        $type=null !==GF('type') ? GF('type'):1;
        $Data001['type']=$type;
        $result= $classMModel->getTeacherSchedule($Data001);
	    $values=$result['values'];
	    $page = $result['page'];
	    $Data002['wxid']=$this->wxid;
	    $class=$classMModel->getTeacherClass($Data002);
		include  CURR_VIEW_PATH . "courseclosing.php";
	}
	//进入记上课
	public function rememberClassAction(){
        $timetype=null !==GF('timetype') ? GF('timetype'):4;
        if($timetype==1){
      		$Data001['starttime']=strtotime(date('Y-m-d',time()));
      		$Data001['endtime']  =$Data001['starttime']+(3600*24);
        }elseif($timetype==2){
      		$Data001['starttime']=strtotime(date('Y-m-d',time()))-(3600*24);
      		$Data001['endtime']  =strtotime(date('Y-m-d',time()));
        }elseif($timetype==5){
        	$Data001['starttime']=null !==GF('starttime') ? GF('starttime'):0;
      		$Data001['endtime']  =null !==GF('endtime') ? GF('endtime'):0;
        }
	    $nowday  =null !==GF('nowday') ? GF('nowday'):date('Y-m',time());
        $date =get_day($nowday,2);  
        $classModel = M('App/ClassModel');
        $teacherid  =null !==GF('teacherid') ? GF('teacherid'):'0';
        $classid  =null !==GF('classid') ? GF('classid'):'0';
        $classlevel  =null !==GF('classlevel') ? GF('classlevel'):'3';
        $date=null !==GF('date') ? GF('date'):date('Y-m',time());
        $Data001['wxid']=$this->wxid;
        $Data001['teacherid']=0;
        $class = $classModel->getTeacherClass($Data001);
        $Data001['classid']=$classid;
        $teachers=$classModel->getClassTeachers($Data001);
        $Data001['teacherid']=$teacherid;
        $Data001['status']=0;
        $result=$classModel->remember($Data001,1);
        $values=$result['values'];
	    $page = $result['page'];
	    $Data002['wxid']=$this->wxid;
	    $class=$classModel->getTeacherClass($Data002);
		include  CURR_VIEW_PATH . "rememberClass.php";
	}
	//进行记上课
	public function dorememberClassAction(){
		$scheduleid = ChkClng(KS_G('get.id'));
		$scheduleModel=M('app_class_schedule');
		$Data['status']=2;
		$scheduleModel->update($Data,'id='.$scheduleid);
		$url= M_URL($this->AppName.'/Index','rememberClass','',GP('')); 
		KS_INFO('',0,$url);
	}
	//进入结算
	public function settlementAction(){
       $classMModel = M('App/ClassModel');
       $teacherid  =null !==GF('teacherid') ? GF('teacherid'):'0';
       $classid  =null !==GF('classid') ? GF('classid'):'0';
       $classlevel  =null !==GF('classlevel') ? GF('classlevel'):'3';
       $date=null !==GF('date') ? GF('date'):date('Y-m',time());
       $Data001['wxid']=$this->wxid;
       $Data001['teacherid']=0;
       $Data001['classid']=$classid;
       $teachers=$classMModel->getClassTeachers($Data001);
       $Data001['teacherid']=$teacherid;
       $Data001['status']=2;
       $result=$classMModel->remember($Data001,2);
       $teacherrealateModel=M('app_class_teacherrelate');
       $value=$result['values'];
       foreach($value as $k=>$v){
       	   $value[$k]['speakerMoney']=$teacherrealateModel->getOne('speakercost','where classid='.$v['classid'].' and teacherid='.$v['teacherid'].' limit 1');
       	   $value[$k]['assistantcost']=$teacherrealateModel->getOne('assistantcost','where classid='.$v['classid'].'  and  teacherid='.$v['assisantid'].' limit 1');
       }
       
       $values=$value;
	   $page = $result['page'];
	   $Data002['wxid']=$this->wxid;
	   $class=$classMModel->getTeacherClass($Data002);
	   include  CURR_VIEW_PATH . "settlement.php";
		
	}
	//进行结算
    public function scheduleSettlementAction(){
	    $scheduleid = ChkClng(KS_G('get.id'));
	    $scheduleModel=M('app_class_schedule');
	    $schedule=$scheduleModel->getRow(' where id='.$scheduleid.' limit 1');
	    $userModel=M('common_user');
	    $teacherModel=M('common_user_teacher');
	    $teacher =$userModel->getRow(' as a inner join '.$teacherModel->table.' as b on a.userid=b.userid where a.wxid='.$this->wxid.' and  a.userid='.$schedule['teacherid'].' limit 1', 'a.username,b.name');
	    $teacherrealateModel=M('app_class_teacherrelate');
	    
	    $teacherrelate=M('app_class_teacherrelate');
	    $teacherMoney=$teacherrelate->getOne('speakercost','where teacherid='.$schedule['teacherid'].' and classid='.$schedule['classid'].' limit 1');
	    $assisant=$userModel->getRow(' as a inner join '.$teacherModel->table.' as b on a.userid=b.userid where a.wxid='.$this->wxid.' and  a.userid='.$schedule['assisantid'].' limit 1', 'a.username,b.name');
	    if($assisant){
	    	$assisantMoney=$teacherrelate->getOne('assistantcost','where teacherid='.$schedule['assisantid'].' and classid='.$schedule['classid'].' limit 1');	
	    }
	    include  CURR_VIEW_PATH . "scheduleSettlement.php";
			
	}
	//结算
	public function doSettlementAction(){
		 $settlementModel=M('app_teacher_settlement');
		 $Data['teacherid']=ChkClng(KS_G('post.teacherid'));
		 $Data['type']=1;
		 $Data['scheduleid']=ChkClng(KS_G('post.scheduleid'));
		 $Data['money']=ChkClng(KS_G('post.money1'));
		 $Data['wxid']=$this->wxid;
		 $Data['remarks']=ChkSQL(KS_G('post.remarks1'));
		 $Data2['isSettlement']=1;
		 $settlementModel->doAdd($Data,'id');
		  $Data1['assisantid']=ChkClng(KS_G('post.assisantid'));
		  if($Data1['assisantid']!=0){
		  	     $Data1['type']=2;
		  	     $Data1['wxid']=$this->wxid;
				 $Data1['scheduleid']=ChkClng(KS_G('post.scheduleid'));
				 $Data1['money']=ChkClng(KS_G('post.money1'));
				 $Data1['remarks']=ChkSQL(KS_G('post.remarks1'));
				 $Data2['isSettlement1']=1;
				 $settlementModel->doAdd($Data1,'id');
		  }
		$scheduleModel=M('app_class_schedule');
		$Data2['status']=3;
		$scheduleModel->update($Data2,'id='.$Data['scheduleid']);
		$url= M_URL($this->AppName.'/Index','settlement','',GP('')); 
		KS_INFO('',3,$url);
	}
	//批量结算
	public function dobatchSettlementAction(){
		$scheduleid=ChkSQL(KS_G('post.scheduleid'));
		$teacherid = ChkSQL(KS_G('post.teacherid'));
		$assisantid= ChkSQL(KS_G('post.assisantid'));
		$teacherMoney= ChkSQL(KS_G('post.teacherMoney'));
		$assisantMoney= ChkSQL(KS_G('post.assisantMoney'));
		$settlementModel=M('app_teacher_settlement');
		foreach($scheduleid as $k=>$v){
			$Data['teacherid']=$teacherid[$k];
			$Data['type']=1;
			$Data['scheduleid']=$v;
			$Data['money']=$teacherMoney[$k];
			$Data['wxid']=$this->wxid;
			$Data['remarks']='';
			$Data2['isSettlement']=1;
			$settlementModel->doAdd($Data,'id');
			$Data1['assisantid']=$assisantid[$k];
			if($Data1['assisantid']!=0){
			  	     $Data1['type']=2;
			  	     $Data1['wxid']=$this->wxid;
					 $Data1['scheduleid']=$v;
					 $Data1['money']=$assisantMoney[$k];
					 $Data1['remarks']='';
					 $Data2['isSettlement1']=1;
					 $settlementModel->doAdd($Data1,'id');
			}
			$scheduleModel=M('app_class_schedule');
			$Data2['status']=3;
			$scheduleModel->update($Data2,'id='.$v);
		}
		$url= M_URL($this->AppName.'/Index','settlement','',GP('')); 
		KS_INFO('',3,$url);
	}
	//批量结算
	public function dobatchAction(){
		$scheduleid=ChkSQL(KS_G('post.scheduleid'));
	    $url= M_URL($this->AppName.'/Index','settlement','',GP('')); 
		if($scheduleid==''){KS_INFO('请选择',0,$url);}
		$money = 0;
		$teacherrelate=M('app_class_teacherrelate');
		$scheduleModel=M('app_class_schedule');
		$settlementModel=M('app_teacher_settlement');
		$ids=implode(',',$scheduleid);
		$classModel = M('app_class');
		$where      = ' as a inner join '.$classModel->table.' as b on a.classid=b.classid   where a.wxid='.$this->wxid.' and id in('.$ids.')';
		$values     = $scheduleModel->getAll($where,'b.title as classname,b.classlevel,a.id,a.day,a.dayPm,a.timeSlotStart,a.timeSlotEnd,a.teacherid,a.assisantid,a.type,a.title,a.classroomid,a.classid');
		$userModel    = M('common_user');
	    $teacherModel = M('common_user_teacher');
		foreach($values as $k=>$v){
			$teacher =$userModel->getRow(' as a inner join '.$teacherModel->table.' as b on a.userid=b.userid where a.wxid='.$this->wxid.' and  a.userid='.$v['teacherid'].' limit 1', 'a.username,b.name');
			$values[$k]['teachername']= !empty($teacher['name']) ? $teacher['name'] : $teacher['username'];
		    $values[$k]['teacherMoney']=$teacherrelate->getOne('speakercost','where teacherid='.$v['teacherid'].' and classid='.$v['classid'].' limit 1');
		   $assisant=$userModel->getRow(' as a inner join '.$teacherModel->table.' as b on a.userid=b.userid where a.wxid='.$this->wxid.' and  a.userid='.$v['assisantid'].' limit 1', 'a.username,b.name');
		   $values[$k]['assisantname']='';
		   $values[$k]['assisantMoney']='';
		    if($assisant){
		    	$values[$k]['assisantname']=!empty($teacher['name']) ? $teacher['name'] : $teacher['username'];
		    	$values[$k]['assisantMoney']=$teacherrelate->getOne('assistantcost','where teacherid='.$v['assisantid'].' and classid='.$schedule['classid'].' limit 1');	
		    }
		}
		include  CURR_VIEW_PATH . "batchSettlement.php";
//		foreach($scheduleid as $k=>$v){
//		    $schedule=$scheduleModel->getRow(' where id='.$v.' limit 1');
//		    $teacherMoney=$teacherrelate->getOne('speakercost','where teacherid='.$schedule['teacherid'].' and classid='.$schedule['classid'].' limit 1');
//		    $Data['teacherid']=$schedule['teacherid'];
//			$Data['type']=1;
//			$Data['scheduleid']=$v;
//			$Data['money']=$teacherMoney;
//			$Data['wxid']=$this->wxid;
//			$Data2['isSettlement']=1;
//			$settlementModel->doAdd($Data,'id');
//		    if($schedule['assisantid'] !=0){
//		    	 $assisantMoney=$teacherrelate->getOne('assistantcost','where teacherid='.$schedule['assisantid'].' and classid='.$schedule['classid'].' limit 1');
//		    	 $Data1['type']=2;
//		  	     $Data1['wxid']=$this->wxid;
//				 $Data1['scheduleid']=$v;
//				 $Data1['money']=$assisantMoney;
//				 $Data2['isSettlement1']=1;
//				 $settlementModel->doAdd($Data1,'id');
//		    }
//		    $Data2['status']=3;
//		    $scheduleModel->update($Data2,'id='.$v);
//		}
//		KS_INFO('',0,$url);
	}
	function teachersettlementAction(){
		$settlementModel   = M('app_teacher_settlement');
		$Data['teacherid'] = null !==GF('teacherid') ? GF('teacherid'):'0';
		$Data['type']  = null !==GF('type') ? GF('type'):1;
		$Data['money'] = null !==GF('money') ? GF('money'):1;
		$Data['scheduleid'] = ChkClng(KS_G('get.id'));
		$Data['wxid'] = $this->wxid;
        $settlementModel->doAdd($Data,'id');
        $Data2['status']=3;
        if($Data['type']==1){$Data2['isSettlement']=1;
	    }else{$Data2['isSettlement1']=1;}	 
        $scheduleModel=M('app_class_schedule');
		$scheduleModel->update($Data2,'id='.$Data['scheduleid']);
		$url= M_URL($this->AppName.'/Index','courseclosing',$Data['teacherid'],GP('')); 
		KS_INFO('',0,$url);
	}
	//批量记上课
	function dorememberbatchAction(){
		$scheduleid=ChkSQL(KS_G('post.scheduleid'));
		if($scheduleid==''){KS_INFO('请选择',0,$url);}
		$scheduleModel=M('app_class_schedule');
		foreach($scheduleid as $k=>$v){
			$Data['status']=2;
		    $scheduleModel->update($Data,'id='.$v);
		}
		$url= M_URL($this->AppName.'/Index','rememberClass','',GP('')); 
		KS_INFO('',0,$url);
	}
	//删除课时
	function delscheduleAction(){
		$scheduleid = ChkSQL(KS_G('get.id'));
		$model      = M('app_class_schedule');
		$model->delete(' id='.$scheduleid);
		$url= M_URL($this->AppName.'/Index','schedulelist','',GP('')); 
		KS_INFO('',0,$url);
	}
	//批量删除课时
	function  delschedulebatchAction(){
		$scheduleid=ChkSQL(KS_G('post.scheduleid'));
		if($scheduleid==''){KS_INFO('请选择',0,$url);}
		$scheduleModel=M('app_class_schedule');
		foreach($scheduleid as $k=>$v){
			$Data['status']=2;
		    $scheduleModel->delete('id='.$v);
		}
		$url = M_URL($this->AppName.'/Index','schedulelist','',GP('')); 
		KS_INFO('',0,$url);
	}
}