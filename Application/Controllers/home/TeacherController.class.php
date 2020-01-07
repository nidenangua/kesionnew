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
class TeacherController extends CommonController
{    
     //进入教师管理页面
     public function indexAction(){
	   
	   $userid = $this->userid;
	   
	   $usersModel = M('common_user');
	   
	   $where="where wxid=$this->wxid and usertype = 2";
	   
	   $options = $usersModel->getOptions('5',$where);//分页参数设置
		
	   $page = Page($options);
		
	   $teacher = $usersModel->getPage($page,'regdate',$where);
	   
	     include  CURR_VIEW_PATH . "teacher_list.php";
	 }
	 //进入增加页面
	  public function addteacherAction(){
	    
		$CategoryModel = new UsersCategoryModel('common_user_category');
		//读取缓存
	/*	$cache = new \Core\Cache(DATA_PATH);
		
		$userscategory = $cache->get('userscategory'); 
	     
		 if($userscategory=1){*/
			 
			 $userscategory = $CategoryModel->getCategory();
			 
		/*	 $cache->put('userscategory',$userscategory); 
		  
		  }*/
	   
		 include  CURR_VIEW_PATH . "teacher_add.php";
	 }
	 
	 
}