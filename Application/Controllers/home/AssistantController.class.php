<?php

use Kesion\Controller;
class AssistantController extends Controller
{
    public  function _initialize(){
    	$userinfo         = getsession('assistant');
		$this->userinfo   = User_GetUserInfo();
		//var_dump($this->userinfo);exit;
		//check_homelogin($this->userinfo);//检查home端是否有初始化
		$this->userid     = $this->userinfo['userid'];//用户id
		$this->wxid       = $this->userinfo['wxid'];//网校id
		$this->powertype  = $this->userinfo['powertype'];//权限类型
    }
    //助教进入
	public function AssistantAction(){
		$teacherModel = M('app_course_teacherrelate');
		$courseModel  = M('app_course');
		$where ='as a left join '.$courseModel->table.' as b on a.courseid = b.courseid where a.wxid='.$this->wxid.' and  (b.courseType =2 or b.courseType =4)  and a.teacherid='.$this->userid;
		$options = $teacherModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$course  = $teacherModel->getPage($page,'b.courseid desc',$where);
		//班级
	    $classModel = M('app_class');
        $teacherClassModel = M('app_class_teacherrelate');
        $liveModel =M('app_live_list');
        $where =" as a left join $classModel->table as b on a.classid=b.classid  left join $liveModel->table as d on a.classid = d.classid where a.teacherid =$this->userid  and b.status !=-1";
	    $options = $teacherClassModel->getOptions('10',$where);//分页参数设置
	    $page    = Page($options);
	    $class  = $teacherClassModel->getPage($page,'b.classid desc',$where);
		include  CURR_VIEW_PATH . "Assistant_course.php";	
	}
	public function startLiveAction(){
        $courseModel = M('app_course');
        $moduletype  = 0;
        $courseid    = ChkClng(KS_G("request.id")); 
        $infoid      = $courseid;
        $value       = $courseModel->getRow('where courseid ='.$courseid.' limit 1'); 
        $chapteModel = M($value['chaptertable']);
		$teacherModel= M('common_user_teacher');
		$teacherName = $teacherModel->getOne('name','where userid='.$value['teacherid'].' limit 1');
		$liveChapters= $chapteModel->getAll('where  courseid = '.$courseid.' and chaptertype =2 and depth = 3 order by root,orderid ');
		$chapterid  = chapterFirst($liveChapters); //正在直播的课程
		$chapter    = $chapteModel->getRow('where  courseid = '.$courseid.' and depth = 3 and chapterid='.$chapterid.' limit 1');
		if(!$chapter){
			$this->assign('getMessage','暂无可课时');$this->display('404.html');exit;
		}
        $chapters    = getChapters($value['chapterTemplate'],$courseid,$chapteModel);
		$uid         =  $this->userid;
      	$liveModel   =  M('app_live_list');
		$channl      =  $liveModel->getRow('where courseid ='.$courseid.' and chapterid ='.$chapterid.' limit 1');
		$live        =  new Core\AgoraLive($channl['wxid']);  
	 	$channelName =  $channl['channlName'];
	  	$expiredTs   =  0;
	  	$token       =  $live -> generateMediaChannelKey($channelName, $uid, $expiredTs);
	  	$SignKey     =  $live ->generateSignKey(time(),$uid);
	  	//加入学生观看表
	  	$studentModel = M($channl['studentTable']);
	  	$student      = $studentModel->getRow('where wxid= '.$this->wxid.' and memberid = '.$uid.' and channlid ='.$channl['id'].' limit 1');
	  	if($student){
	  		if($student['status'] == 2){
	  			  $Data['status']    = 1;
	  			  $Data['starttime'] = time();
	  		      $studentModel->update($Data,'id = '.$student['id']);
	  		}
	  	}else{
	  		$Data['status']    = 1;
	  		$Data['starttime'] = time();
	  		$Data['wxid']      = $GLOBALS['_DoM']['wxid'];
	  		$Data['channlid']  = $channl['id'];
	  		$Data['memberid']  = $uid;
	  		$Data['type']  = 1;
	  		$studentModel->doAdd($Data,'id');
	  	}
		include  CURR_VIEW_PATH . "Assistant_live.php";		
	}
	public function startLiveClassAction(){
        $classid = ChkClng(KS_G("request.id")); 
        $infoid=$classid;
        $scheduleModel= M('app_class_schedule');
        $schedules=$scheduleModel->getAll(' where wxid='.$this->wxid.' and classid='.$classid);
        $classModel=M('app_class');
        $class =$classModel->getRow(' where wxid='.$this->wxid.' and classid='.$classid.' limit 1');
        $schedule=getSchedule($schedules); 
        $value['title']=$class['title'];
        $value['teacherid']=$schedule['teacherid'];
    	$moduletype=1;
    	$liveModel =M('app_live_list');
    	$channl = $liveModel->getRow(' where  classid='.$classid.' limit 1');
    	$uid  = $this->userid ;
   	    $channelName  = $channl['channlName'];
   	    $channelId = $channl['id']; 
   	    $liveType=2;//1课程2班级    //直播类型
   	    $live = new Core\AgoraLive();  
	 	$channelName= $channl['channlName'];
	  	$expiredTs = 0;
      	$token =$live -> generateMediaChannelKey($channelName, $this->userid, $expiredTs);
      	$SignKey =$live ->generateSignKey(time(),$this->userid);
   	    $appId =$live->getAppid();
   	    include  CURR_VIEW_PATH . "Assistant_live.php";		
	}
	public function  problemAction(){
	    $id =ChkClng(KS_G("request.id")); 
	    $chapModel= M('app_course_problem');
        $replyModel=M('app_interact_reply');
        $problem =$chapModel->getRow(' where wxid='.$this->wxid.' and interactid='.$id.' limit 1');
        $replay =$replyModel->getAll(' where interactid='.$id);
	    include  CURR_VIEW_PATH . "Assistant_replay.php";	
	}
	public function loginAction(){
	    $secretKey  = null !==GF('secretKey') ? GF('secretKey'):'';
	    $userid     = ChkClng(KS_G("get.id")); 
	    $usersModel = M('common_user');
		$user       = $usersModel->getRow("WHERE userid=$userid  and secretKey ='$secretKey' limit 1",'password,rndpasswordc,usertype,userid,username,status,wxid,email');
		if(!$user){KS_INFO('登录失败',0,'','',1);
		}elseif($user['status']==2){KS_INFO('该账户已被锁定',0,'','',1);
		}elseif($user['status']==0){KS_INFO('该账户未通过审核',0,'','',1);}
	    $Data['secretKey']= md5(time().rand(10000,99999).$userid);
		$usersModel->update($Data,'userid='.$userid);
	    putsession('assistant',$user);
	    $url=M_URL('Assistant','Assistant');
	    echo "<script>location.href='$url'</script>";    
	}
	public function problemSearchAction(){
		$courseid =ChkClng(KS_G("request.id"));
		$questionSearch = ChkSQL(KS_G("post.questionSearch")) ;
	    $uid =$this->userid; 
	    $channelName = null !==GF('channelName') ? GF('channelName'):'';
	    $chapterid = null !==GF('chapterid') ? GF('chapterid'):'';
	    $live        =  new Core\AgoraLive();  
	  	$expiredTs   =  0;
	  	$SignKey     =  $live ->generateSignKey(time(),$uid);
	    include  CURR_VIEW_PATH . "Assist_question_search.php";
	}
	public function problemDetailAction(){
		$courseid =ChkClng(KS_G("request.courseid"));
		$questionSearch = ChkSQL(KS_G("post.questionSearch"));
		$chapModel= M('app_course_problem');
        $replyModel=M('app_interact_reply');
        $where = 'where wxid='.$this->wxid.' and infoid='.$courseid; 
        if(!empty($questionSearch)){
          	  $where.=" and interact like '%$questionSearch%'";
        }
        $options = $chapModel->getOptions('10',$where);//分页参数设置
        $options['now_page']   = ChkClng(KS_G('request.p'))!=0 ? ChkClng(KS_G('request.p')):'1';
	    $options['maxperpage']  = null !=ChkClng(KS_G('request.maxpage')) ? ChkClng(KS_G('request.maxpage')):'10';
	    $page    = Page($options); 
	    $problem  = $chapModel->getPage($page,'adddate desc',$where,'interactid,interact,membername');
        foreach($problem as $k=>$v){
         	$problem[$k]['totalput']=$page->totalput;
         	$problem[$k]['url']=M_URL('Assistant','replay',$v['interactid'],GP(''));
         	$problem[$k]['count']=$replyModel->getOne('count(*)','where interactid ='.$v['interactid']);
        }
        if($options['now_page']>$page->total_pages){
         	$problem='';
        }
        $result='';
		$result = json_encode($problem);
		echo $result;
	}
	public function replayAction(){
		$interactid =ChkClng(KS_G("request.id"));
		include  CURR_VIEW_PATH . "Assistant_replay.php";
	}
}