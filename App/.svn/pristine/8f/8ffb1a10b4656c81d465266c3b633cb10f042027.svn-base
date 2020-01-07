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
class IndexController extends CommonController
{
     public function indexAction(){
     	 $userModel =   M('common_user');
		 $webModel  =   M('common_user_website');
//		 $menModel  =   M('common_user_member');
       if($this->app['appename']=='users'){
       	       
				$keyword   =   ChkSQL(GF('keyword') ? GF('keyword'):'');
				$keytype   =   ChkSQL(GF('keytype') ? GF('keytype'):1);
				$status    =   ChkClng(GF('status') ? GF('status'):3);
				$byname    =   ChkSQL(GF('byname') ? GF('byname'):'desc');
				$where     =   'where usertype=0';
				if($status==3){ $where= $where.' and (a.status=1 or a.status=0)';}
			 	if($status==1){ $where= $where.' and a.status=1';}
			 	if($status==2){ $where= $where.' and a.status=0';}
			 	if($keytype==1){
			     	$where  = $where.' and a.username like "%'.$keyword.'%"';
				}elseif($keytype==2){
				  	$where  =  $where.' and b.sitename like "%'.$keyword.'%"';
				}
			    $where      =  "as a left join `$webModel->table` as b on a.wxid = b.wxid ".$where;
			    $options    =  $userModel->getOptions('10',$where);//分页参数设置
				$page       =  Page($options);
				$infoary    =  $userModel->getPage($page,'regdate '.$byname,$where,'a.userid,a.wxid,b.sitename,a.username,a.mobile,a.regdate,a.powertype,a.status');
	       	    include  CURR_VIEW_PATH . "userlist.php";
	    }else{
	    	    $userModel =   M('common_user');
		        $webModel  =   M('common_user_website');
				$keyword   =   ChkSQL(GF('keyword') ? GF('keyword'):'');
				$keytype   =   ChkSQL(GF('keytype') ? GF('keytype'):1);
				$status    =   ChkClng(GF('active') ? GF('active'):3);
				$byname    =   ChkSQL(GF('byname') ? GF('byname'):'desc');
				$where     =   'where usertype=1';
				if($status==3){ $where= $where.' and (a.status=1 or a.status=0)';}
			 	if($status==1){ $where= $where.' and a.status=1';}
			 	if($status==2){ $where= $where.' and a.status=0';}
			 	if($keytype==1){
			     	$where  = $where.' and a.username like "%'.$keyword.'%"';
				}elseif($keytype==2){
				  	$where  =  $where.' and b.sitename like "%'.$keyword.'%"';
				}
			    $where      =  "as a left join `$webModel->table` as b on a.wxid = b.wxid ".$where;
			    $options    =  $userModel->getOptions('10',$where);//分页参数设置
				$page       =  Page($options);
				$infoary    =  $userModel->getPage($page,'regdate '.$byname,$where,'a.userid,a.wxid,b.sitename,a.username,a.mobile,a.regdate,a.powertype,a.status');
		        include  CURR_VIEW_PATH . "teacherlist.php";
        }
     }
     /*
      * 改变账号状态
      */
     public function changeStatusAction(){
     	$userModel =   M('common_user');
     	$now_page = ChkClng(KS_S('p',1)); 
		$id       = ChkClng(GF('userid'));
		$statuschange   = ChkClng(GF('status'));
//		var_dump($id);
//		var_dump($status);
		if($statuschange==1){
			$Data['status'] = 0;
		}else{
			$Data['status'] = 1;
		}
		$userModel->update($Data,'userid='.$id);
		$url            =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		ks_header($url);
     }
     /*
      * 显示教师的详细信息
      */
    public function showDetailAction(){
    	$now_page = ChkClng(KS_S('p',1)); 
		$id       = ChkClng(GF('userid'));
    	$userModel =   M('common_user');
    	$areaModel =   M('common_area');
        $teacherModel  =   M('common_user_teacher');
        $memberModel  =   M('common_user_member');
        if($this->app['appename']=='users'){//学生
        	$classroom  =  M('app_classroom');
        	$where      =  "as a left join `$memberModel->table` as b on a.userid = b.userid where a.userid=".$id;
	        $info        =  $userModel->getRow($where);
	//      var_dump($info);exit;
	        if($info['provinceid']){
	        	$info['provinceid']=$areaModel->getOne('city','where id='.$info['provinceid']);
	        }else{
	        	$info['provinceid'] = '';
	        }
	        if($info['countyid']){
	        	$info['countyid']=$areaModel->getOne('city','where id='.$info['countyid']);
	        }else{
	        	$info['countyid'] = '';
	        }
	        if($info['cityid']){
	        	$info['cityid']=$areaModel->getOne('city','where id='.$info['cityid']);
	        }else{
	        	$info['cityid'] = '';
	        }
	        $info['classroom'] = $classroom -> getOne('classroomname','where id='.$info['classroomid']);
	        $info['detailadd']= $info['provinceid'].$info['cityid'].$info['countyid'];
	    	include  CURR_VIEW_PATH . "showmember.php";
        }else{//教师
	        $where      =  "as a left join `$teacherModel->table` as b on a.userid = b.userid where a.userid=".$id;
	        $info        =  $userModel->getRow($where);
	//      var_dump($info);exit;
	        if($info['provinceid']){
	        	$info['provinceid']=$areaModel->getOne('city','where id='.$info['provinceid']);
	        }else{
	        	$info['provinceid'] = '';
	        }
	        if($info['countyid']){
	        	$info['countyid']=$areaModel->getOne('city','where id='.$info['countyid']);
	        }else{
	        	$info['countyid'] = '';
	        }
	        if($info['cityid']){
	        	$info['cityid']=$areaModel->getOne('city','where id='.$info['cityid']);
	        }else{
	        	$info['cityid'] = '';
	        }
	        $info['detailadd']= $info['provinceid'].$info['cityid'].$info['countyid'];
	    	include  CURR_VIEW_PATH . "showteacher.php";
        }
        
    }
    
    public  function deleteAction(){
    	$userModel =   M('common_user');
     	$now_page = ChkClng(KS_S('p',1)); 
		$id       = ChkClng(GF('userid'));
		$status   = ChkClng(GF('status'));
//		var_dump($id);
//		var_dump($status);
			$Data['status'] = -1;
		$userModel->update($Data,'userid='.$id);
		$url            =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		ks_header($url);
    }
    /*
     * 批量操作，审核，删除，取消审核
     */
     public  function someDelAction(){
    	$userModel =   M('common_user');
     	$now_page = ChkClng(KS_S('p',1)); 
		$idAry=ChkSQL(KS_G('post.id'));
		$type=ChkSQL(KS_G('post.batch'));
		
		$status   = ChkClng(GF('status'));
		if($type==1){
			$Data['status'] = -1;
		}elseif($type==2){
			$Data['status'] = 1;
		}elseif($type==3){
			$Data['status'] = 0;
		}
			
			foreach($idAry as $k => $v){
				$userModel->update($Data,'userid='.$v);
			}
		$url            =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		ks_header($url);
    }
}
?>