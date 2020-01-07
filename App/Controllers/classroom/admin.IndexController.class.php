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
	/*
	 * 显示教室管理页面
	 */
    public function indexAction(){	
    	$school    =   M('app_schooladdress');
		$keyword   =   ChkSQL(GF('keyword') ? GF('keyword'):'');
		$keytype   =   ChkSQL(GF('keytype') ? GF('keytype'):1);
		$status    =   ChkClng(GF('status') ? GF('status'):3);
		$byname    =   ChkSQL(GF('byname') ? GF('byname'):'desc');
		if($status==3){ $where= ' where (a.status=1 or a.status=0)';}
	 	if($status==1){ $where= ' where a.status=1';}
	 	if($status==2){ $where= ' where a.status=0';}
	 	if($keytype==1){
	     	$where  = $where.' and a.classroomname like "%'.$keyword.'%"';
		}elseif($keytype==2){
		  	$where  =  $where.' and b.school like "%'.$keyword.'%"';
		}elseif($keytype==3){
		  	$where  =  $where.' and a.wxid='.$keyword;
		}
	    $where      =  "as a left join `$school->table` as b on a.schoolname = b.schoolid ".$where;
	    $options    =  $this->AppModel->getOptions('10',$where);//分页参数设置
		$page       =  Page($options);
		$infoary    =  $this->AppModel->getPage($page,'adddate '.$byname,$where,'a.id,a.wxid,b.school,a.classroomname,a.address,a.adddate,a.galleryful,a.status');
		
		include  CURR_VIEW_PATH . "index.php"; 
	} 
	/*
     * 单个删除教室
     */
    public function deleteAction(){
    	$classId          =  ChkClng(KS_G('request.id'));
    	$Data['status'] =  -1; 
    	$res            =  $this->AppModel->update($Data,'id='.$classId);
		$now_page       =  ChkClng(KS_S('p',1));		
		$url            =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		ks_header($url);
    }
    /*
     * 批量删除教室
     */
    public function deletepartAction(){
    	$idAry          = ChkSQL(KS_G('post.id'));
    	$Data['status'] = -1;
    	foreach($idAry as $key =>$val){
    	  $res          =  $this->AppModel->update($Data,'id = '.$val);	
    	}
		$now_page       =  ChkClng(KS_S('p',1));		
		$url            =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		KS_INFO("批量操作成功",0,$url);
    }
    /*
     * 显示 修改教室页面
     */
    public function showEditAction(){
    	$now_page = ChkClng(KS_S('p',1)); 
		$id       = ChkClng(null !==GF('id') ? GF('id'):'');
		$value    = $this->AppModel->getRow('where id ='.$id);
		if(!empty($value['tempid'])){
			$tempModel=M('app_temp');
			$temp =$tempModel->getRow(' where id ='.$value['tempid']);
			$value['tempsrc']=$temp['defaultpic'];
			$value['tempid']=$temp['id'];
		}
//		var_dump($value);
		$schoolModel= M('app_schooladdress');
		$where      = 'where wxid='.$value['wxid'];
		$school     = $schoolModel -> getAll($where,'*');
		include  CURR_VIEW_PATH . "editClassroom.php";
    }
    	/*
    	 * 显示教室场景
    	 */
	public function classroomSceneAction(){
		$tempModel=M('app_temp');
		$where=' where wxid='.$this->wxid;
		$options     = $tempModel->getOptions('10',$where);//分页参数设置
		$page        = Page($options);
		$values      = $tempModel->getPage($page,'',$where);
		
		
		include CURR_VIEW_PATH . "tempClassroom.php"; 
		
	}
	/**
	 * 修改教室管理
	 */
	public function changeMsgAction(){
		$id                    = ChkSQL(KS_G('request.id'));
	    $Data['classroomname'] = ChkSQL(KS_G("post.classroomname"));
	    if(!empty(ChkSQL(KS_G("post.defaultpic")))){$Data['defaultpic'] = ChkSQL(KS_G("post.defaultpic"));}
	    $Data['schoolname']    = ChkSQL(KS_G("post.schoolname"));
	    $Data['address']       = ChkSQL(KS_G("post.address"));
 	 	$Data['tempid']    = ChkClng(KS_G("post.tempid"));
	  	$Data['galleryful']    = ChkClng(KS_G("post.galleryful"));
	  	$Rule['classroomname'] = '教室名称|isEmpty';
	  	$Rule['schoolname']    = '所在学校|isEmpty';
	  	$Rule['address']       = '地址|isEmpty';
	  	Chkpost($Data,$Rule,$this->AppModel);
		$this->AppModel->update($Data,"id=$id");
		$url1= M_URL($this->AppName.'/Index','index','',GP(''));
		KS_INFO('修改成功',3,$url1);
	}
	/*
	 * 显示校区管理页面
	 */
	public function schoolManageAction(){
		$keyword   =   ChkSQL(GF('keyword') ? GF('keyword'):'');
		$keytype   =   ChkSQL(GF('keytype') ? GF('keytype'):1);
		$byname    =   ChkSQL(GF('byname') ? GF('byname'):'desc');
	 	if($keytype==1){
	     	$where  = ' where a.school like "%'.$keyword.'%"  and a.status=0';
		}elseif($keytype==2){
		  	$where  = ' where b.sitename like "%'.$keyword.'%" and a.status=0';
		}
		$schoolModel=M('app_schooladdress');
		$wxtable=M('common_user_website');
		$where      =  "as a left join `$wxtable->table` as b on a.wxid = b.wxid ".$where;
		$options = $schoolModel -> getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$value = $schoolModel -> getPage($page,'schoolid '.$byname,$where,'a.schoolid,a.school,b.sitename,a.address,a.name,a.tel');
		include CURR_VIEW_PATH . "schoolManage.php";
	}
	/*
	 * 显示编辑校区页面
	 */
	public function editSchoolAction(){
		$schoolModel  =  M('app_schooladdress');
		$id           =  ChkClng(GF('id') ? GF('id'):'');
		 $school      =  $schoolModel->getRow(' where schoolid='.$id);
		include CURR_VIEW_PATH . "addschool.php";
		
	}
	/*
	 * 编辑校区
	 */
	public function doeditSchoolAction(){
		$id               =  ChkClng(GF('id') ? GF('id'):'');
		$schoolModel      =  M('app_schooladdress');
		$Data['name']     =  ChkSQL(KS_G('post.name'));
		$Data['tel']      =  ChkClng(KS_G("post.tel"));
		
		$Data['address']  =  ChkSQL(KS_G('post.address'));
		$Data['school']   =  ChkSQL(KS_G('post.school'));
		$Rule['name']     =  '联系人|isEmpty';
	  	$Rule['tel']      =  '电话|isEmpty';
	  	$Rule['address']  =  '地址|isEmpty';
	  	$Rule['school']   =  '学校|isEmpty';
	  	Chkpost($Data,$Rule,$schoolModel);
	  	$schoolModel->update($Data,'schoolid='.$id);
		$url      =  M_URL($this->AppName.'/Index','schoolManage','',GP(''));
		KS_INFO("编辑成功",3,$url);
		
	}
	/*
     * 单个删除校区
     */
    public function delSchoolAction(){
    	$schoolModel    =  M('app_schooladdress');
    	$schoolid       =  ChkClng(GF('schoolid') ? GF('schoolid'):'');
    	$Data['status'] =  -1; 
    	$res            =  $schoolModel->update($Data,'schoolid='.$schoolid);
		$now_page       =  ChkClng(KS_S('p',1));		
		$url            =  M_URL($this->AppName.'/Index','schoolManage','',GP('p-'.$now_page));		
		ks_header($url);
    }
    /*
     * 批量删除校区
     */
    public function schoolPartAction(){
    	$schoolModel    = M('app_schooladdress');
    	$idAry          = ChkSQL(KS_G('request.id'));
    	$Data['status'] = -1;
    	foreach($idAry as $key =>$val){
    	  $res          =  $schoolModel->update($Data,'schoolid = '.$val);	
    	}
		$now_page       =  ChkClng(KS_S('p',1));		
		$url            =  M_URL($this->AppName.'/Index','schoolManage','',GP('p-'.$now_page));		
		KS_INFO("批量操作成功",0,$url);
    }
}
  