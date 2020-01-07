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
	//报名首页
    public function index2Action(){
    	include  CURR_VIEW_PATH . "index2.php";
    }
	//报名首页
    public function indexAction(){
    	$hits=null !==GF('hits') ? GF('hits'):'0';
    	$option=null !==GF('option') ? GF('option'):'1';
		//状态筛选
		$where = "where a.wxid = $this->wxid";
//		if($status==3){$where.= " and (a.status=0 or a.status=1 or a.status = 2)";}
//		elseif($status==2){$where.= " and a.status=2"; }
//		elseif($status==1){$where.= " and a.status=1"; }
//		elseif($status==0){$where .= " and a.status=0";}
//		//属性筛选
//		if($recommend==1){$where.=" and a.recommend=1";}
//		if($allowcomment==1){$where.=" and a.allowcomment=1";}
//		if($roll==1){$where.=" and a.roll=1";}
//		if($slide==1){$where.=" and a.slide=1";}
//		if($hot==1){$where.=" and a.hot=1";}
//		//搜索
		$keyword=KS_S('keyword');
		$keytype=KS_S('keytype',1);
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and b.name like '%$keyword%'";}
		   elseif($keytype==2){$where.=" and a.ordersn like '%$keyword%'";}
//		   elseif($keytype==2){$where.=" and a.inputer like '%$keyword%'";}
		   elseif($keytype==3){$where.=" and a.title like '%$keyword%'";}
		}
//		//分类
//		$categoryid=null !==GF('categoryid') ? GF('categoryid'):0;
//		if($categoryid!=0) {$where .= "and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}
//		$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
        $app_order   = M('app_order_info');//排序	
       /// var_dump($ordercount);exit;	
        			
		if($hits==1){$byname = 'hits desc';}
		else{$byname = 'adddate desc';}
		$left_join   = M('common_user_member');
		$where       = "as a left join `$left_join->table` as b on a.memberid = b.userid $where";
		$options     = $app_order->getOptions('10',$where);//分页参数设置
		$page        = Page($options);
		$values      = $app_order->getPage($page,$byname,$where,'b.name,a.*');
		$ordercount  = $app_order->getRow($where.' and paystatus=1','sum(a.price) as price,sum(a.market_price) as market_price');             
    	include  CURR_VIEW_PATH . "index.php";
    }
    //报名续班添加页
    public function addEnrolAction(){
//  	$id = ChkSQL(KS_G("get.id"));
//		if(empty($id)){KS_INFO('请选择');}
        $now_page    = ChkClng(KS_S('p',1));
//		$usertype    = ChkClng(ChkClng(KS_S('usertype',3)));
//		$userinfo    = $this->userModel->getRow('where userid ='.$id.' and wxid='.$this->wxid.' limit 1');
//		$userinfo2   = $this->AppModel->getRow('where userid ='.$id.' limit 1');
//		if($usertype==1){
//			$teacherModel= M('common_user_teacher');
//			$userinfo2   = $teacherModel->getRow('where userid ='.$id.' limit 1');
//		}
		$where       = 'where a.wxid='.$this->wxid.' and a.status!=-1';
		$classid     =  null !==GF('classid') ? GF('classid'):0;
		$student     =  null !==GF('student') ? GF('student'):0;
		if(!empty($student)){
			$student       = str_replace("@",",",$student);
			$UserModel     = M('common_user'); 
			$userStudent   = M('common_user_member');
			$studentrelate = M('app_class_studentrelate');
			$where1         ='where a.wxid ='.$this->wxid .' and a.usertype = 0';
			$where1         = "as a left join $userStudent->table as b on a.userid = b.userid $where1 and b.userid in ($student)";
			$students      = $UserModel->getAll($where1);
			
		}else{$students=array();}
		//分类
		$categoryid=null !==GF('categoryid') ? GF('categoryid'):0;
		if($categoryid!=0) {$where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}
		$left_join   = M('app_category');
		$category    = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		$choicetype  = null !==GF('choicetype') ? GF('choicetype'):0;
		$classtype   = null !==GF('classtype') ? GF('classtype'):0;
		if($choicetype==1){
			$where  .= ' and classlevel=2';
			if(!empty($classtype))$where     .= ' and classType='.$classtype;
			$where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where order by a.classid desc";
			$app_class  = M('app_class');//班级
			$allclass   = $app_class->getAll($where,'a.classid as courseid,a.title,a.price');
		}elseif($choicetype==2){
			if(!empty($classtype))$where     .= ' and courseType='.$classtype;
			$where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where order by a.courseid desc";
			$app_course = M('app_course');//课程
			$allclass   = $app_course->getAll($where,'a.courseid,a.title,a.price');
		}elseif($choicetype==3){
			$where  .= ' and classlevel=1';
			if(!empty($classtype))$where     .= ' and classType='.$classtype;
			$where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where order by a.classid desc";
			$app_class  = M('app_class');//班级
			$allclass   = $app_class->getAll($where,'a.classid as courseid,a.title,a.price');
		}elseif($choicetype==4){
			$where  .= ' and classlevel=0';
			if(!empty($classtype))$where     .= ' and classType='.$classtype;
			$where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where order by a.classid desc";
			$app_class  = M('app_class');//班级
			$allclass   = $app_class->getAll($where,'a.classid as courseid,a.title,a.price');
		}else{$allclass   = array();}
    	include  CURR_VIEW_PATH . "addEnrol.php";
    } 
    //报名续班添加页
    public function addstudentAction(){
    	$UserModel     = M('common_user'); 
		$userStudent   = M('common_user_member');
		$studentrelate = M('app_class_studentrelate');
		$where         ='where a.wxid ='.$this->wxid .' and a.usertype = 0';
		$usertype      = 0;
		 //关键字搜索
		$keyword = KS_S('keyword');
		$keytype = null !==GF('keytype') ? GF('keytype'):0;
	    if(!empty($keyword)){ 
			    if($keytype==1){
			          $where.=" and a.username like '%$keyword%'";
		        }else{
					  $where.=" and b.name ='%$keyword%'";
				}   
		}	
		$classid     =  null !==GF('classid') ? GF('classid'):0;
		if(!empty($classid)){
			$where = "as a left join $userStudent->table as b on a.userid = b.userid $where and b.userid not in (select memberid from $studentrelate->table where wxid=$this->wxid and classid = $classid)";
		}else{
			$where = "as a left join $userStudent->table as b on a.userid = b.userid $where";
		}	
	    
	    $options = $UserModel->getOptions('9',$where);
	    $page    = Page($options); 
	    $values  = $UserModel->getPage($page,'a.userid desc',$where);
    	include  CURR_VIEW_PATH . "addstudent.php";
    } 
    //报名续班添加页
    public function addclassAction(){
    	include  CURR_VIEW_PATH . "addclass.php";
    } 
    //报名续班添加页
    public function doaddEnrolAction(){
    	$student     =  null !==GF('student') ? GF('student'):0; 
    	$classid     =  null !==GF('classid') ? GF('classid'):0;
		if(empty($student)){KS_INFO('请添加学员');}
		if(empty($classid)){KS_INFO('请选择课程');}
		$students    = explode('@',$student);
		$now_page    = ChkClng(KS_S('p',1));
		
		$data['order_amount']= ChkSQL(KS_G('post.order_amount'));
		$data['courseid']    = $classid;
	    $data['choicetype']  = 1;
	    $data['userid']      = $this->userid;
	    if($this->classlevel ==2){
	    	$studentResultModel= M('app_class_studentrelate');
	    	$Datas['status']   =-1;
	    	$studentResultModel->update($Datas,'wxid='.$this->wxid.' and classid='.$classid.' and status=1');
	    	//$url      = M_URL($this->AppName.'/Index','basics',$this->classid,GP('p-'.$now_page));
	    }else{
	    	//$url      = M_URL($this->AppName.'/Index','student',$this->classid,GP('p-'.$now_page));
	    }
		
		$Enrolment      = M('App/OrderModel');////调用唤起传说中的model层 
	    foreach($students as $k=>$v){
			$data['memberid']    = $v;
			$Enrolment->doOpenCourseOrder($data);//对学员进行报课报班
		}
    	$url = M_URL($this->AppName.'/Index','index',$id,GP('p-'.$now_page.',appid-'.$this->appid,true));
		KS_INFO('报班成功',3,$url);
    } 
    //添加老师
	public function addUserAction(){
		$Data002['appname'] = $this->AppName;
		$UsersModel = M('App/UsersModel');
	    $UsersModel ->addUser($Data002);
	}
	public function doAddUserAction(){
		$usertype          = null !==GF('usertype')?GF('usertype'):0;
		$Data001['wxid']   = $this->wxid;
	 	$Data001['userid'] = $this->userid;
	 	$Data001['type']   = 2;
	    $UsersModel = M('App/UsersModel');
	    $UsersModel ->doaddUsers($Data001);
	    if($usertype == 0){
			$url=M_URL($this->AppName.'/Index','addstudent','',GP(''));
		}elseif($usertype == 1){
			$url=M_URL($this->AppName.'/Index','addDocent','',GP(''));		
		}
		KS_INFO('',2,$url); 
	}
	//批量添加学员
	public function doaddStudentAction(){
		$id       =  ChkSQL(KS_G('post.aid'));  
		if(empty($id)){KS_INFO('请选择',4);}
		$ids      = implode('@',$id);
		$url      = M_URL($this->AppName.'/Index','addEnrol','',GP('student-'.$ids));
		//var_dump($url);exit;
		KS_INFO('',3,$url);
	}
}