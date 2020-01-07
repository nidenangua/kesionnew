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
    	$status=KS_S('status',3);
		$hits=null !==GF('hits') ? GF('hits'):'0';
		$recommend=null !==GF('recommend') ? GF('recommend'):'0';
		$allowcomment=null !==GF('allowcomment') ? GF('allowcomment'):'0';
		$roll=null !==GF('roll') ? GF('roll'):'0';
		$slide=null !==GF('slide') ? GF('slide'):'0';
		$hot=null !==GF('hot') ? GF('hot'):'0';
		$a=null !==GF('a') ? GF('a'):'0';
		//状态筛选
		if($this->rdbpower==1){
		    $where = "where a.wxid = $this->wxid";
		}else{
			$where = "where a.wxid = $this->wxid";
			//$where = "where a.wxid =$this->wxid and a.usrid=$this->usrid";
		}
		if($status==3){$where.= " and (a.status=0 or a.status=1 or a.status = 2)";}
		elseif($status==1){$where.= " and a.status=1"; }
		elseif($status==0){$where .= " and a.status=0";}
		//属性筛选
		if($recommend==1){$where.=" and a.recommend=1";}
		if($allowcomment==1){$where.=" and a.allowcomment=1";}
		if($roll==1){$where.=" and a.roll=1";}
		if($slide==1){$where.=" and a.slide=1";}
		if($hot==1){$where.=" and a.hot=1";}
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and a.classroomname like '%$keyword%'";}
		   elseif($keytype==2){$where.=" and a.schoolname like '%$keyword%'";}
		   elseif($keytype==3){$where.=" and a.id like '%$keyword%'";}
		}
		//分类
		$categoryid=null !==GF('categoryid') ? GF('categoryid'):0;
		if($categoryid!=0) {$where .= "and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}
		$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		//排序				
		if($hits==1){$byname = 'hits desc';}
		else{$byname = 'adddate desc';}
		$left_join   = M('app_category');
		$where       = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where";
		$options     = $this->AppModel->getOptions('10',$where);//分页参数设置
		$page        = Page($options);
		$values      = $this->AppModel->getPage($page,$byname,$where,'b.*,a.*');
	    $schoolModel=M('app_schooladdress');
		foreach($values as $k=>$v){
		 $values[$k]['schoolname']=$schoolModel->getOne('school','where schoolid='.$v['schoolname'].' limit 1');	
		}
		
		
		include  CURR_VIEW_PATH . "index.php"; 
	} 
	//弹框选择场景
	public function addTempAction(){
		
		include CURR_VIEW_PATH . "addTemp.php"; 
	} 
	//弹框创建班级
	public function addClassroomAction(){
		$link = Linkage(array());
		$link->cachename='appcategory';
		$link->wxid = $this->wxid;
		$link ->inputname  = 'categoryid';
		
		$schoolModel=M('app_schooladdress');
		$where='where wxid='.$this->wxid;
		$school = $schoolModel -> getAll($where);//分页参数设置
		

	
		$describe = ks_editor('describe','','1');
		include CURR_VIEW_PATH . "addClassroom.php"; 
	} 
	//教室场景
	public function classroomSceneAction(){
		$tempModel=M('app_temp');
		$where=' where wxid='.$this->wxid;
		$options     = $tempModel->getOptions('10',$where);//分页参数设置
		$page        = Page($options);
		$values      = $tempModel->getPage($page,'',$where);
		
		
		include CURR_VIEW_PATH . "tempClassroom.php"; 
		
	}
	
	
	
	//添加创建班级
	public function doaddClassroomAction(){
		$Data['userid']        = $this->userid;
	    $Data['wxid']          = $this->wxid;
		$Data['adddate']       = time();
	    $Data['classroomname'] = ChkSQL(KS_G("post.classroomname"));
	    $Data['defaultpic']    = ChkSQL(KS_G("post.defaultpic"));
	    $Data['schoolname']    = ChkSQL(KS_G("post.schoolname"));
	    $Data['address']       = ChkSQL(KS_G("post.address"));
	     $Data['tempid']       = ChkClng(KS_G("post.tempid"));
 	 	$Data['categoryid']    = ChkClng(KS_G("post.categoryid"));
	  	$Data['galleryful']    = ChkClng(KS_G("post.galleryful"));
	  	$Rule['classroomname'] = '教室名称|isEmpty';
	  	$Rule['schoolname']    = '所在学校|isEmpty';
	  	$Rule['address']       = '地址|isEmpty';
	  	Chkpost($Data,$Rule,$this->AppModel);
	  	$this->AppModel->doadd($Data,'id');
	  	$url1= M_URL($this->AppName.'/Index','index','',GP(''));
	  	KS_INFO('添加成功',3,$url1);
	}
    //进入添加编辑班级页面
	public function editClassroomAction(){
		$now_page = ChkClng(KS_S('p')); 
		$id       = ChkClng(KS_G("get.id"));
		
		$value    = $this->AppModel->getRow('where id ='.$id.' limit 1');
		if(empty($value['tempid'])){
			$value['tempid']=0;
		}
		$tempModel=M('app_temp');
		$temp =$tempModel->getRow(' where id ='.$value['tempid']);
	
		$value['tempsrc']=$temp['defaultpic'];
		$value['tempid']=$temp['id'];
		$link     = Linkage(array());
		$link->cachename='appcategory';
		$link->wxid = $this->wxid;
		$link ->inputname  = 'categoryid';
		$link ->categoryid = $value['categoryid'];
		
			$schoolModel=M('app_schooladdress');
		$where='where wxid='.$this->wxid;
		$school = $schoolModel -> getAll($where);//分页参数设置
		
		include  CURR_VIEW_PATH . "addClassroom.php";
	}
	//编辑班级
	public function doeditClassroomAction(){
		$id                    = ChkSQL(KS_G('get.id'));
		$Data['userid']        = $this->userid;
	    $Data['wxid']          = $this->wxid;
		//$Data['adddate']       = time();
	    $Data['classroomname'] = ChkSQL(KS_G("post.classroomname"));
	    if(!empty(ChkSQL(KS_G("post.defaultpic")))){$Data['defaultpic']    = ChkSQL(KS_G("post.defaultpic"));}
	    $Data['schoolname']    = ChkSQL(KS_G("post.schoolname"));
	    $Data['address']       = ChkSQL(KS_G("post.address"));
 	 	$Data['categoryid']    = ChkClng(KS_G("post.categoryid"));
	  	$Data['galleryful']    = ChkClng(KS_G("post.galleryful"));
	  	$Rule['classroomname'] = '教室名称|isEmpty';
	  	$Rule['schoolname']    = '所在学校|isEmpty';
	  	$Rule['address']       = '地址|isEmpty';
	  	Chkpost($Data,$Rule,$this->AppModel);
		$this->AppModel->update($Data,"id=$id");
		$url1= M_URL($this->AppName.'/Index','index','',GP(''));
		KS_INFO('修改成功',3,$url1);
	}
	//删除班级
	public function delclassroomAction(){
		$id             = ChkClng(KS_G("get.id"));
		$now_page       = ChkClng(KS_S('p',1));
		$classroomModel = M('app_classroom');
		$classroomModel -> delete("id = " .$id);
		$url1           = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		ks_header($url1);
	}
	//批量删除班级
	public function batchAction(){
		$batch    = ChkClng(KS_G('post.batch'));
		$id       = isset($_POST["classid"])?$_POST["classid"]:'';
		if(empty($id)){KS_INFO("请选择",0,'','',1);}
		$now_page =  ChkClng(KS_S('p',1));
		if($batch==1){
			foreach ($id as $k=>$v){$this->AppModel->delete("id=$v");}
			$url      =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
			KS_INFO("批量删除成功",0,$url);
		}elseif($batch==2){
			foreach ($id as $k=>$v){$Data['status']=1;$this->AppModel->update($Data,"id=$v");}
			$url      =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
			KS_INFO("批量审核成功",0,$url);
		}elseif($batch==3){
			foreach ($id as $k=>$v){$Data['status']=0;$this->AppModel->update($Data,"id=$v");}
			$url      =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
			KS_INFO("批量审核取消",0,$url);
		}
	}
	public function startClassAction(){
		$liveModel   = M('app_live_list');
		$classroomid = ChkClng(KS_G('get.id'));
		$live =$liveModel->getRow('where wxid ='.$this->wxid.' and classroomid='.$classroomid);
		$classroom = $this->AppModel->getRow('where wxid ='.$this->wxid.' and id='.$classroomid);
		$teacherModel =M('common_user_teacher');
		$teacherName=$teacherModel->getOne('name','where userid='.$classroom['teacherid']);
		include  CURR_VIEW_PATH . "startClass.php";
	}
	//进入班级学员页面
	public function showStudentAction(){
		$memberModel    = M('common_user_member');
		$studentModel   = M('app_classroom_student');
		$classroomid    = ChkClng(KS_G("get.id"));
		$where ="as a left join ".$memberModel->table." as b on a.memberid=b.userid";
		$where.=" where a.classroomid = $classroomid";
		//实现不同要求页面跳转
    	$status=KS_S('status',3);
    	if($status==3){$where .=" and (a.status = 0 or a.status = 1)";}
    	elseif($status==0){$where .=" and a.status = 0";}
    	elseif($status==1){$where .=" and a.status = 1";}
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and b.name like '%$keyword%'";}
		   //elseif($keytype==2){$where.=" and b.Sex like '%$keyword%'";}
		}
		if(!empty($classroomid)){
			$classroominfo = $this->AppModel ->getRow(" where id = $classroomid");
		}else{
			$classroominfo = '';
		}
		
		$options = $studentModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$values  = $studentModel->getPage($page,'a.adddate desc',$where);
		include  CURR_VIEW_PATH . "showStudent.php";
	}
	//进入添加学员页面
	public function addStudentAction(){
		 $classroomid   = ChkClng(KS_G('get.id'));
		 $memberModel   = M('common_user_member');
		 $studentModel  = M('app_classroom_student');
		 $where = "as a left join $studentModel->table as b on a.userid = b.memberid where a.userid not in (select memberid from $studentModel->table where classroomid = $classroomid)"; 
		 //搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and a.name like '%$keyword%'";}
		   elseif($keytype==2){$where.=" and a.Sex like '%$keyword%'";}
		}

		$options = $memberModel->getOptions('9',$where);//分页参数设置
		$page    = Page($options);
		$student = $memberModel->getPage($page,'a.time desc',$where);
		include  CURR_VIEW_PATH . "addStudent.php";
	}

	//添加学员
	public function doaddStudentAction(){
		$now_page            = ChkClng(KS_S('p',1));
		$classroomid         = ChkClng(KS_G("get.id"));
		$studentModel        = M('app_classroom_student');
		$memberModel         = M('common_user_member');
		$classroomid         = ChkClng(KS_G('get.id'));
		$Data['classroomid'] = $classroomid;
		$Data['adddate']     = ChkClng(time());
		$Data['wxid']        = $this->wxid;
		$memberid            = isset($_POST["aid"])?$_POST["aid"]:'';
		if(empty($memberid)){KS_INFO("请选择",0,'','',1);}
		foreach ($memberid as $k=>$v ){
			$Data['memberid'] = $v;
			$studentid = $studentModel->doAdd($Data,"id");
			if(!empty($studentid)){
			$classroomModel = M('app_classroom');
			$count          = $studentModel->getOne('count(*)',"where classroomid = $classroomid");
			$Datas['studentnum'] = $count;
			$classroomModel -> update($Datas,"id = $classroomid");	
		}
		}
	    $url  = M_URL($this->AppName.'/Index','showStudent',$classroomid,GP('p-'.$now_page));
	    KS_INFO('添加成功',3,$url); 
	    $html = "<script>parent.location.href='".$url."';</script>";
		echo $html;
	}
	//删除学员
	public function delStudentAction(){
		$now_page       = ChkClng(KS_S('p',1));
		$classroomid    = ChkClng(null !==GF('classroomid') ? GF('classroomid'):'');
		$id             = ChkClng(KS_G("get.id"));
		$studentModel   = M('app_classroom_student');
		$result = $studentModel -> delete("id = " .$id);
		
		$classroomModel     = M('app_classroom');
		$count              = $studentModel->getOne('count(*)',"where classroomid = $classroomid");
		$Datas['studentnum'] = $count;
		$classroomModel -> update($Datas,"id = $classroomid");
		
		$url1= M_URL($this->AppName.'/Index','showStudent',$classroomid,GP('p-'.$now_page));
		ks_header($url1);
	}
	//批量删除学员
	public function batchStudentAction(){
		$now_page       = ChkClng(KS_S('p',1));
		$classroomid    = ChkClng(null !==GF('classroomid') ? GF('classroomid'):'');
		$studentModel   = M('app_classroom_student');
		$memberid       = isset($_POST["check"])?$_POST["check"]:'';
		if(empty($memberid)){KS_INFO("请选择",0,'','',1);}	
		foreach ($memberid as $k=>$v ){
			$studentModel->delete("id=$v");
			$classroomModel     = M('app_classroom');
			$count              = $studentModel->getOne('count(*)',"where classroomid = $classroomid");
			$Datas['studentnum'] = $count;
			$classroomModel -> update($Datas,"id = $classroomid");
		}
		$url =  M_URL($this->AppName.'/Index','showStudent',$classroomid,GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	
	//进入公告页面
	public function showNoticeAction(){
		$classroomid = ChkClng(KS_G("get.id"));
		$noticeModel = M('app_classroom_notice');
		//实现不同要求页面跳转
    	$status=KS_S('status',3);
    	if($status==3){$where =" where (status = 0 or status = 1)";}
    	elseif($status==0){$where =" where status = 0";}
    	elseif($status==1){$where =" where status = 1";}
		
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and content like '%$keyword%'";}
		   elseif($keytype==2){$where.=" and noticetitle like '%$keyword%'";}
		}
		$where.=" and classroomid = $classroomid";
	    if(!empty($classroomid)){
			$classroominfo = $this->AppModel ->getRow(" where id = $classroomid");
		}else{
			$classroominfo ='';
		}
		$options = $noticeModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$values  = $noticeModel->getPage($page,'adddate asc',$where);
		include  CURR_VIEW_PATH . "showNotice.php";
	}
	//进入添加公告页面
	public function addNoticeAction(){
		$classroomid = ChkClng(KS_G("get.id"));
		if(!empty($classroomid)){
			$classroominfo = $this->AppModel->getRow("where id = $classroomid");
		}else{
			$classroominfo = "";
		}
		$noticeinfo = '';
		$kindeditor = ks_editor('content','','1',"toolbars: [['fullscreen', 'source', 'undo', 'redo', 'bold','italic','underline','fontfamily','fontsize','emotion','spechars','forecolor']]",'1000px','190px');
		include  CURR_VIEW_PATH . "addNotice.php";
	}
	//添加公告
	public function doaddNoticeAction(){
		$now_page       = ChkClng(KS_S('p',1));
		$classroomid    = ChkClng(KS_G("get.id"));
		$noticeModel          = M('app_classroom_notice');
		$Data['noticetitle']  = ChkSQL(KS_G('post.noticetitle'));	
		$Data['classroomid']  = $classroomid;
		$Data['status']       = ChkClng(KS_G('post.status'));
		$Data['content']      = ChkSQL(KS_G('post.content'));
		$Data['adddate']      = ChkSQL(strtotime(KS_G('post.adddate')));
		$Data['wxid']         = $this->wxid;
		$Rule['noticetitle']  = '公告标题|isEmpty';
		$Rule['content']      = '公告内容|isEmpty';
		$Rule['adddate']      = '发布时间|isEmpty';
		Chkpost($Data,$Rule,$noticeModel);
		$noticeid = $noticeModel->doAdd($Data,'id');
		if(!empty($noticeid)){
			$classroomModel = M('app_classroom');
			$count          = $noticeModel->getOne('count(*)',"where classroomid = $classroomid");
			$Datas['noticenum'] = $count;
			$classroomModel -> update($Datas,"id = $classroomid");	
		}
		$url1=M_URL($this->AppName.'/Index','showNotice',$classroomid,GP('p-'.$now_page));
		KS_INFO('添加成功',0,$url1);
	}
	//进入编辑公告页面
	public function editNoticeAction(){
		$noticeid    = ChkClng(null !==GF('noticeid') ? GF('noticeid'):'');
		$classroomid   = ChkSQL(KS_G('get.id'));
		if(!empty($classroomid)){
			$classroominfo = $this->AppModel->getRow("where id = $classroomid");
		}else{
			$classroominfo = "";
		}
		$noticeModel = M('app_classroom_notice');
		$noticeinfo = $noticeModel -> getRow("where id = $noticeid");
		$kindeditor = ks_editor('content',$noticeinfo['content'],'1',"toolbars: [['fullscreen', 'source', 'undo', 'redo', 'bold','italic','underline','fontfamily','fontsize','emotion','spechars','forecolor']]",'1000px','190px');	
		include  CURR_VIEW_PATH . "addNotice.php";
	}
	//编辑公告
	public function doeditNoticeAction(){
		$now_page       = ChkClng(KS_S('p',1));
		$noticeid       = ChkClng(null !==GF('noticeid') ? GF('noticeid'):'');
		$classroomid    = ChkSQL(KS_G('get.id'));
		$noticeModel          = M('app_classroom_notice');
		$Data['noticetitle']  = ChkSQL(KS_G('post.noticetitle'));	
		$Data['status']       = ChkClng(KS_G('post.status'));
		$Data['content']      = ChkSQL(KS_G('post.content'));
		$Data['adddate']      = ChkClng(time());
		$Rule['noticetitle']  = '公告标题|isEmpty';
		$Rule['content']      = '公告内容|isEmpty';
		$Rule['adddate']      = '发布时间|isEmpty';
		Chkpost($Data,$Rule,$noticeModel);
		$noticeid = $noticeModel->update($Data,"id = $noticeid");
		$url1=M_URL($this->AppName.'/Index','showNotice',$classroomid,GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url1);
	}
	//删除公告
	public function delNoticeAction(){
		$id   = ChkSQL(KS_G('get.id'));
		$classroomid    = ChkClng(null !==GF('classroomid') ? GF('classroomid'):'');
		$now_page       = ChkClng(KS_S('p',1));
		$noticeModel    = M('app_classroom_notice')-> delete("id = " .$id);
		$url1= M_URL($this->AppName.'/Index','showNotice',$classroomid,GP('p-'.$now_page));
		ks_header($url1);
	}
	//批量删除公告
	public function batchNoticeAction(){
		$now_page       = ChkClng(KS_S('p',1));
		$classroomid	= ChkSQL(KS_G('get.id'));
		$noticeModel    = M('app_classroom_notice');
		$noticeid       = isset($_POST["check"])?$_POST["check"]:'';
		if(empty($noticeid)){KS_INFO("请选择",0,'','',1);}	
		foreach ($noticeid as $k=>$v ){$noticeModel->delete("id=$v");}
		$url      =  M_URL($this->AppName.'/Index','showNotice',$classroomid,GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
//	//进入批改作业页面
//	public function showTaskAction(){
//		$taskModel = M('app_classroom_task');
//		//实现不同要求页面跳转
//  	$status=KS_S('status',3);
//  	if($status==3){$where =" where (status = 0 or status = 1)";}
//  	elseif($status==0){$where =" where status = 0";}
//  	elseif($status==1){$where =" where status = 1";}
//		
//		//搜索
//		$keyword = ChkSQL(KS_S('keyword'));
//		$keytype = ChkClng(KS_S('keytype',1));
//		
//	    //判断是否输入关键字
//		if(!empty($keyword)){
//		   if($keytype==1){$where.=" and taskname like '%$keyword%'";}
//		  
//		}
//
//		$options = $taskModel->getOptions('10',$where);//分页参数设置
//		$page = Page($options);
//		$values = $taskModel->getPage($page,'adddate desc',$where);
//		include  CURR_VIEW_PATH . "showTask.php";
//	}
//	//进入编辑作业页面
//	  public function editTaskAction(){
//	   $now_page = ChkClng(KS_S('p'));
//	    $courseid = ChkClng(null !==GF('courseid') ? GF('courseid'):'0');
//	    $taskModel = M('app_task');
//	    $id = ChkClng(KS_G('get.id'));
//	    $paperModel = M('app_paper');
//	    $task =   $taskModel->getRow('where id ='.$id.' limit 1');
//	    if($task['ispaper'] == 1 && !empty($task['paperid'])){
//		  $paperids = explode(',',$task['paperid']);
//		  $paperid = $paperModel->getAll('where paperid in ('.$task['paperid'].')');  
//	    }
//	  		
//		$Intro = ks_editor('content',$task['content']);//内容编辑器
//		$paper = $paperModel->getAll(' where courseid ='.$courseid);	
//	    include  CURR_VIEW_PATH . "taskAdd.php";
//	  
//}
	//发布作业
	public function taskAction(){
		
	}
	
	//进入课程页面
	public function showCourseAction(){
		$courseModel = M('app_classroom_course');
		$classroomid    = ChkSQL(KS_G('get.id'));
		//实现不同要求页面跳转
    	$status=KS_S('status',3);
    	if($status==3){$where =" where (a.status = 0 or a.status = 1)";}
    	elseif($status==0){$where =" where a.status = 0";}
    	elseif($status==1){$where =" where a.status = 1";}
		$teacherModel = M('common_user_teacher');
		$where ="as a left join ".$teacherModel->table." as b on a.teacherid=b.userid $where";
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and a.coursename like '%$keyword%'";}
		   elseif($keytype==2){$where.=" and b.name like '%$keyword%'";}
		}
		$where.=" and a.classroomid = $classroomid";
		$options = $courseModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$values  = $courseModel->getPage($page,'a.id asc',$where);
		include CURR_VIEW_PATH . "showCourse.php";
	}
	//进入添加课程界面
	public function addCourseAction(){
		$classroomid    = ChkSQL(KS_G('get.id'));
		$teacherModel   = M('common_user_teacher');
		$teacher 		= $teacherModel -> getAll('',"name,userid");
		$courseinfo = "";
		$kindeditor = ks_editor('content','','1',"toolbars: [['fullscreen', 'source', 'undo', 'redo', 'bold','italic','underline','fontfamily','fontsize','emotion','spechars','forecolor']]",'1000px','190px');
		include CURR_VIEW_PATH . "addCourse.php";
	}
	//添加课程
	public function doaddCourseAction(){
		$now_page      				   = ChkClng(KS_S('p',1));
		$courseModel                   = M('app_classroom_course');
		$classroomid                   = ChkSQL(KS_G('get.id'));
		$Data['coursename']            = ChkSQL(KS_G('post.coursename'));	
		$Data['classplace']            = ChkSQL(KS_G('post.classplace'));
		$Data['starttime']        	   = ChkSQL(strtotime(KS_G('post.starttime')));
		$Data['endtime']               = ChkSQL(strtotime(KS_G('post.endtime')));
		$Data['coursetype']            = ChkClng(KS_G('post.coursetype'));
		$Data['status']                = ChkClng(KS_G('post.status'));
		$Data['teacherid']             = ChkClng(KS_G('post.teacherid'));
		$Data['wxid']                  = $this->wxid;
		$Data['classroomid']           = $classroomid;
		$Rule['coursename']            = '课程名称|isEmpty';
		$Rule['teacherid']             = '上课老师|isEmpty';
		$Rule['classplace']       	   = '上课地点|isEmpty';
		$Rule['starttime']             = '上课时间|isEmpty';
		Chkpost($Data,$Rule,$courseModel);
		$courseid = $courseModel->doAdd($Data,'id');
		if(!empty($courseid)){
			$classroomModel = M('app_classroom');
			$count          = $courseModel->getOne('count(*)',"where classroomid = $classroomid");
			$Datas['coursenum'] = $count;
			$classroomModel -> update($Datas,"id = $classroomid");
		}
		$url1=M_URL($this->AppName.'/Index','showCourse',$classroomid,GP('p-'.$now_page));
		KS_INFO('添加成功',0,$url1);
	}
	//进入编辑课程页面
	public function editCourseAction(){
		$classroomid    = ChkSQL(KS_G('get.id'));
		$teacherModel 	= M('common_user_teacher');
		$teacher 		= $teacherModel -> getAll('',"name,userid");
		$courseid       = ChkClng(null !==GF('courseid') ? GF('courseid'):''); 
		$courseModel	= M('app_classroom_course');
		$courseinfo		= $courseModel -> getRow("where id = $courseid"); 
		include CURR_VIEW_PATH . "addCourse.php";          
	}
	//编辑课程
	public function doeditCourseAction(){
		$now_page       		 = ChkClng(KS_S('p',1));
		$courseModel             = M('app_classroom_course');
		$classroomid             = ChkSQL(KS_G('get.id'));
		$courseid      			 = ChkClng(null !==GF('courseid') ? GF('courseid'):'');
		$Data['coursename']      = ChkSQL(KS_G('post.coursename'));	
		$Data['classplace']      = ChkSQL(KS_G('post.classplace'));
		$Data['starttime']       = ChkSQL(strtotime(KS_G('post.starttime')));
		$Data['endtime']         = ChkSQL(strtotime(KS_G('post.endtime')));
		$Data['coursetype']      = ChkClng(KS_G('post.coursetype'));
		$Data['status']          = ChkClng(KS_G('post.status'));
		$Data['teacherid']       = ChkClng(KS_G('post.teacherid'));
		$Rule['coursename']      = '课程名称|isEmpty';
		$Rule['teacherid']       = '上课老师|isEmpty';
		$Rule['classplace']      = '上课地点|isEmpty';
		$Rule['starttime']       = '上课时间|isEmpty';
		Chkpost($Data,$Rule,$courseModel);
		$courseid = $courseModel->update($Data,"id = $courseid");
		$url1=M_URL($this->AppName.'/Index','showCourse',$classroomid,GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url1);
	}
	//删除课程
	public function delCourseAction(){
		$classroomid        = ChkSQL(KS_G('get.id'));
		$now_page       	= ChkClng(KS_S('p',1));
		$courseid      	    = ChkClng(null !==GF('courseid') ? GF('courseid'):'');
		$courseModel        = M('app_classroom_course') -> delete("id = $courseid");
		$classroomModel     = M('app_classroom');
		$count              = $courseModel->getOne('count(*)',"where classroomid = $classroomid");
		$Datas['coursenum'] = $count;
		$classroomModel -> update($Datas,"id = $classroomid");
		$url1= M_URL($this->AppName.'/Index','showCourse',$classroomid,GP('p-'.$now_page));
		ks_header($url1);
	}
	//批量删除课程
	public function batchCourseAction(){
		$now_page       = ChkClng(KS_S('p',1));
		$classroomid    = ChkSQL(KS_G('get.id'));
		$courseModel    = M('app_classroom_course');
		$courseid       = isset($_POST["check"])?$_POST["check"]:'';
		if(empty($courseid)){KS_INFO("请选择",0,'','',1);}	
		foreach ($courseid as $k=>$v ){
			$courseModel->delete("id=$v");
			$classroomModel     = M('app_classroom');
			$count              = $courseModel->getOne('count(*)',"where classroomid = $classroomid");
			$Datas['coursenum'] = $count;
			$classroomModel -> update($Datas,"id = $classroomid");
		}
		$url      =  M_URL($this->AppName.'/Index','showCourse',$classroomid,GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	//选择学员签到
	public function signStudentAction(){
		$studentModel = M('app_classroom_student');
		$memberModel  = M("common_user_member");
		$classroomid  = ChkClng(KS_G('get.id')); 
		$courseid=null !==GF('courseid') ? GF('courseid'):'';
		$where = "as a left join ".$memberModel->table." as b on a.memberid = b.userid";
		$signModel    = M('app_classroom_sign');
		$signData     = $signModel -> getAll();
		//		$where = " where memberid not in (select memberid from ".$studentModel->table." where classroomid = $classroomid)";
		$where .= " where a.classroomid = $classroomid and memberid not in (select studentid from ".$signModel->table." where courseid = $courseid)";
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and b.name like '%$keyword%'";}
		   elseif($keytype==2){$where.=" and b.Sex like '%$keyword%'";}
		}
		
		$options = $studentModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$values  = $studentModel->getPage($page,'adddate desc',$where);
		
		include CURR_VIEW_PATH . "signStudent.php";
	}
	//学员签到
	public function signAction(){
		$now_page       	   = ChkClng(KS_S('p',1));
		$courseid              = ChkClng(null !==GF('courseid') ? GF('courseid'):'');
		$classroomid     	   = ChkSQL(KS_G('get.id'));
		$studentid             = isset($_POST["student"])?$_POST["student"]:'';
		$signModel      	   = M('app_classroom_sign');
		
		if(empty($studentid)){KS_INFO("请选择",0,'','',1);}
		foreach($studentid as $k=>$v){
			$Data['studentid']     = $v;
			$Data['classroomid']   = $classroomid; 
			$Data['courseid']      = $courseid;
			$Data['signdate']      = ChkClng(time());
			$Data['wxid']          = $this->wxid;
			$signid  = $signModel -> doAdd($Data,"id");
		}
		
		$url  = M_URL($this->AppName.'/Index','showCourse',$classroomid,GP('p-'.$now_page));
	    KS_INFO('签到成功',3,$url); 
	    $html = "<script>parent.location.href='".$url."';</script>";
		echo $html;
	}
	//展示课表
	public function showClasstableAction(){
		$classroomid  = ChkClng(KS_G('get.id'));
		$year  = date('Y');      //获得年份 
		$month = date('n');     //获得月份
		$day   = date('j');       //获得日期
		$daysInMonth  = date("t",mktime(0,0,0,$month,1,$year));//获得当月总天数
		$firstDay     = date("w",mktime(0,0,0,$month,1,$year));//获得每个月的第一天
		$tempDays	  = $firstDay + $daysInMonth;//计算表格数
		$weeksInMonth = ceil($tempDays/7);//算出一个月偶几周
		$counter ='';
		for($j = 0; $j < $weeksInMonth; $j ++) {  
    		for($i = 0; $i < 7; $i ++) {  
        		$counter ++;  
        		$week [$j] [$i] = $counter;  
        		$week [$j] [$i] -= $firstDay;  
        		if (($week [$j] [$i] < 1) || ($week [$j] [$i] > $daysInMonth)) {  
           		 $week [$j] [$i] = "";  
        		}  
    		}  
		}
		include CURR_VIEW_PATH . "showClasstable.php";
	}
	
	//进入添加课表界面
	public function addClasstableAction(){
		$courseModel = M('app_classroom_course');
		$classroomid = ChkClng(KS_G('get.id'));
		//var_dump($classroomid);exit;
		//实现不同要求页面跳转
    	$status=KS_S('status',3);
    	if($status==3){$where =" where (a.status = 0 or a.status = 1)";}
    	elseif($status==0){$where =" where a.status = 0";}
    	elseif($status==1){$where =" where a.status = 1";}
		$teacherModel = M('common_user_teacher');
		$where ="as a left join ".$teacherModel->table." as b on a.teacherid=b.userid $where";
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		
		
		
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and a.coursename like '%$keyword%'";}
		   elseif($keytype==2){$where.=" and b.name like '%$keyword%'";}
		}
		$where.=" and a.classroomid = $classroomid ";
		$options = $courseModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$values  = $courseModel->getPage($page,'a.id asc',$where);
		include CURR_VIEW_PATH . "addClasstable.php";
	}
	//绑定课表
	public function doaddClasstableAction(){
		$classroomid     = ChkSQL(KS_G('get.id'));
		$classtableid    = isset($_POST["classtableid"])?$_POST["classtableid"]:'';
		$classtableModel = M('app_classroom_classtable');
		if(empty($classtableid)){KS_INFO("请选择",0,'','',1);}
		foreach($classtableid as $k=>$v){
			$Data['id']    		   = $v;
			$Data['classroomid']   = $classroomid; 
			$Data['adddate']      = ChkClng(time());
			$Data['wxid']          = $this->wxid;
			$tableid  = $classtableModel -> doAdd($Data,"id");
		}
		
		$url  = M_URL($this->AppName.'/Index','showClasstable',$classroomid,GP('p-'.$now_page));
	    KS_INFO('课程绑定成功',3,$url); 
	    $html = "<script>parent.location.href='".$url."';</script>";
		echo $html;
	}
	//进入老师界面
	public function showTeacherAction(){
		$userModel      = M('common_user_teacher');
		$teacherModel   = M('app_classroom_teacher');
		$classroomid    = ChkClng(KS_G("get.id"));
		if(!empty($classroomid)){
			$classroominfo = $this->AppModel->getRow("where id = $classroomid");
		}else{
			$classroominfo = "";
		}
		$where ="as a left join ".$userModel->table." as b on a.teacherid=b.userid";
		
		$where.=" where a.classroomid = $classroomid";
		//实现不同要求页面跳转
    	$status=KS_S('status',3);
    	if($status==3){$where .=" and (a.status = 0 or a.status = 1)";}
    	elseif($status==0){$where .=" and a.status = 0";}
    	elseif($status==1){$where .=" and a.status = 1";}
		
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and b.name like '%$keyword%'";}
		   elseif($keytype==2){$where.=" and b.Sex like '%$keyword%'";}
		}
		
		$options = $teacherModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$values  = $teacherModel->getPage($page,'a.adddate desc',$where);
		include CURR_VIEW_PATH . "showTeacher.php";
	}
//	$classroomid   = ChkClng(KS_G('get.id'));
//		 $memberModel   = M('common_user_member');
//		 $studentModel  = M('app_classroom_student');
//		 $where = "as a left join $studentModel->table as b on a.userid = b.memberid where a.userid not in (select memberid from $studentModel->table where classroomid = $classroomid)"; 
//		 //搜索
//		$keyword = ChkSQL(KS_S('keyword'));
//		$keytype = ChkClng(KS_S('keytype',1));
//		
//	    //判断是否输入关键字
//		if(!empty($keyword)){
//		   if($keytype==1){$where.=" and a.name like '%$keyword%'";}
//		   elseif($keytype==2){$where.=" and a.Sex like '%$keyword%'";}
//		}
//
//		$options = $memberModel->getOptions('9',$where);//分页参数设置
//		$page    = Page($options);
//		$student = $memberModel->getPage($page,'a.time desc',$where);
//		include  CURR_VIEW_PATH . "addStudent.php";

	//进入添加老师
	public function addTeacherAction(){
		$classroomid  = ChkClng(KS_G('get.id'));
		$userModel    = M('common_user_teacher');
		$teacherModel = M('app_classroom_teacher');
		
		
		$where = "as a left join $teacherModel->table as b on a.userid = b.teacherid where a.userid not in (select teacherid from $teacherModel->table where wxid= $this->wxid and classroomid = $classroomid)";
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and a.name like '%$keyword%'";}
		   elseif($keytype==2){$where.=" and a.Sex like '%$keyword%'";}
		}
		$options = $userModel -> getOptions('9',$where);//分页参数设置
		$page = Page($options);
		$teachers = $userModel -> getPage($page,'a.userid desc',$where);

		include  CURR_VIEW_PATH . "addTeacher.php";
	}
	//添加老师
	public function doaddTeacherAction(){
		$now_page            = ChkClng(KS_S('p',1));
		$classroomid         = ChkClng(KS_G("get.id"));
		$teacherModel        = M('app_classroom_teacher');
		$useModel            = M('common_user_teacher');
		$classroomid         = ChkClng(KS_G('get.id'));
		$Data['classroomid'] = $classroomid;
		$Data['adddate']     = ChkClng(time());
		$Data['wxid']        = $this->wxid;
		$teacherid           = isset($_POST["aid"])?$_POST["aid"]:'';
		if(empty($teacherid)){KS_INFO("请选择",0,'','',1);}
		foreach ($teacherid as $k=>$v ){
			$Data['teacherid'] = $v;
			$teacherid = $teacherModel->doAdd($Data,"id");
			if(!empty($teacherid)){
			$classroomModel = M('app_classroom');
			$count          = $teacherModel->getOne('count(*)',"where classroomid = $classroomid");
			$Datas['teachernum'] = $count;
			$classroomModel -> update($Datas,"id = $classroomid");	
		}
		}
	    $url  = M_URL($this->AppName.'/Index','showTeacher',$classroomid,GP('p-'.$now_page));
	    KS_INFO('添加成功',3,$url); 
	    $html = "<script>parent.location.href='".$url."';</script>";
		echo $html;
	}
	//删除老师
	public function delTeacherAction(){
		$id  				  = ChkClng(KS_G("get.id"));
		$now_page      		  = ChkClng(KS_S('p',1));
		$classroomid   		  = ChkClng(null !==GF('classroomid') ? GF('classroomid'):'');
		$teacherModel  		  = M('app_classroom_teacher');
		$result        		  = $teacherModel->delete("id = $id");
		$classroomModel       = M('app_classroom');
		$count                = $teacherModel->getOne('count(*)',"where classroomid = $classroomid");
		$Datas['teachernum'] = $count;
		$classroomModel -> update($Datas,"id = $classroomid");
		
		$url1= M_URL($this->AppName.'/Index','showTeacher',$classroomid,GP('p-'.$now_page));
		ks_header($url1);
	}
	//批量删除老师
	public function batchTeacherAction(){
		$now_page       = ChkClng(KS_S('p',1));
		$classroomid    = ChkClng(null !==GF('classroomid') ? GF('classroomid'):'');
		$teacherModel   = M('app_classroom_teacher');
		$memberid       = isset($_POST["check"])?$_POST["check"]:'';
		if(empty($memberid)){KS_INFO("请选择",0,'','',1);}	
		foreach ($memberid as $k=>$v ){
			$teacherModel->delete("id=$v");
			$classroomModel       = M('app_classroom');
			$count                = $teacherModel->getOne('count(*)',"where classroomid = $classroomid");
			$Datas['teachernum'] = $count;
			$classroomModel -> update($Datas,"id = $classroomid");
		}
		$url      =  M_URL($this->AppName.'/Index','showTeacher',$classroomid,GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	//展示二维码
	public function showQRcodeAction(){
		include CURR_VIEW_PATH . "showQRcode.php";
	}
	
	/**
	 * 获取二维码生成
	 */
	public function getQRcodeAction(){
		if(empty($_POST['QRtime'])){
			$QRtime=1800;
		}else{
			$QRtime=$_POST['QRtime'];
		}
		$scene_id=10000;
		//获取ticket
		$access_token = getAccessToken($this->wxid);
		$url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token;
		$data = array("expire_seconds"=>$QRtime,"action_name"=>"QR_SCENE",'action_info'=>array("scene"=>array("scene_id"=>$scene_id)));
		$output= curlPost($url,json_encode($data));
		$token= (array)json_decode($output);
		$ticket = $token['ticket'];
		//通过ticket换取二维码
		$QRurl = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$ticket;
		echo $QRurl;
	}
	public function showJiaoshiAction(){
		include CURR_VIEW_PATH . "showJiaoshi.php";
	}
	
	//校区
	public function schoolManageAction(){
		$schoolModel=M('app_schooladdress');
		$where='where wxid='.$this->wxid;
		$options = $schoolModel -> getOptions('9',$where);//分页参数设置
		$page = Page($options);
		$value = $schoolModel -> getPage($page,'schoolid desc',$where);
		include CURR_VIEW_PATH . "schoolManage.php";
	}
	public function addschoolAction(){

		include CURR_VIEW_PATH . "addschool.php";
	}
	public function doaddschoolAction(){
        
        $schoolModel=M('app_schooladdress');
        $Data['wxid']     = $this->wxid;
        $Data['name']     = ChkSQL(KS_G('post.name'));
		$Data['tel']      = ChkClng(KS_G("post.tel"));
		$Data['address']  = ChkSQL(KS_G('post.address'));
		$Data['school']  = ChkSQL(KS_G('post.school'));
		$Rule['name'] = '联系人|isEmpty';
	  	$Rule['tel']    = '电话|isEmpty';
	  	$Rule['address'] = '地址|isEmpty';
	  	$Rule['school'] = '学校|isEmpty';
	  	Chkpost($Data,$Rule,$schoolModel);
	  	$schoolModel->doAdd($Data,'schoolid');
		$url      =  M_URL($this->AppName.'/Index','schoolManage','',GP(''));
		KS_INFO("添加成功",3,$url);
		
	}
	public function editSchoolAction(){
		$schoolModel=M('app_schooladdress');
		$id      = ChkClng(KS_G("get.id"));
		 $school=$schoolModel->getRow(' where schoolid='.$id.' limit 1');
		include CURR_VIEW_PATH . "addschool.php";
		
	}
	public function doeditSchoolAction(){
		$id      = ChkClng(KS_G("get.id"));
		$schoolModel=M('app_schooladdress');
		$Data['name']     = ChkSQL(KS_G('post.name'));
		$Data['tel']      = ChkClng(KS_G("post.tel"));
		
		$Data['address']  = ChkSQL(KS_G('post.address'));
		$Data['school']  = ChkSQL(KS_G('post.school'));
		$Rule['name'] = '联系人|isEmpty';
	  	$Rule['tel']    = '电话|isEmpty';
	  	$Rule['address'] = '地址|isEmpty';
	  	$Rule['school'] = '学校|isEmpty';
	  	Chkpost($Data,$Rule,$schoolModel);
	  	$schoolModel->update($Data,'schoolid='.$id);
		$url      =  M_URL($this->AppName.'/Index','schoolManage','',GP(''));
		KS_INFO("编辑成功",3,$url);
		
	}
	public function delSchoolAction(){
		$schoolModel=M('app_schooladdress');
		$id      = ChkClng(KS_G("get.id"));
		$schoolModel->delete(' schoolid='.$id.' limit 1');
		$url      =  M_URL($this->AppName.'/Index','schoolManage','',GP(''));
		KS_INFO("删除成功",0,$url);
		
	}
	public function batchSchoolAction(){
		
		$schoolModel=M('app_schooladdress');
		$id      = ChkSQL(KS_G("post.aid"));
		foreach($id as $k=>$v){
			$schoolModel->delete(' schoolid='.$v.' limit 1');
		}
		
		$url      =  M_URL($this->AppName.'/Index','schoolManage','',GP(''));
		KS_INFO("删除成功",0,$url);
		
	}
	
	
	
}
  