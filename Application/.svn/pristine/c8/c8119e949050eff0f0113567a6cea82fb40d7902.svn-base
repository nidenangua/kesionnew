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
class ChangepwdController extends CommonController
{
	 //修改密码操作
	 public function editPwdAction(){
		  include  CURR_VIEW_PATH . "changepwd.php";
     }
	 //修改密码操作
	 public function doeditPwdAction(){
		$oldpassword      = ChkSQL(KS_G('post.oldpassword')); 
		$Data['password'] = ChkSQL(KS_G('post.newpassword'));
		$assertpassword   = ChkSQL(KS_G('post.assertpassword'));
		if($oldpassword == $Data['password']){KS_INFO('新密码与原密码一致',4,'','',1);} 
		if($Data['password'] !=  $assertpassword){KS_INFO ("新密码两次输入不一致",4,'','',1);}
		if($this->userinfo['password'] !== KS_MD5($oldpassword.KS_MD5($this->userinfo['rndpasswordc']))){KS_INFO('原密码错误',4,'','',1);}
		$usersModel = M('common_user');
		$Rule['password'] = '密码|isEmpty,isPassword';
		Chkpost($Data,$Rule,$usersModel,"userid!=$this->userid");
		$Data['password'] = KS_MD5($Data['password'].KS_MD5($this->userinfo['rndpasswordc']));
		$usersModel->update($Data,"userid=$this->userid");
		$lastlogintime = time();
		$lastloginip = $_SERVER['REMOTE_ADDR'];
		$GLOBALS['db']->execSql("UPDATE `$usersModel->table` SET `lastlogintime`='$lastlogintime', `lastloginip`='$lastloginip', `logintimes`=logintimes+1 WHERE userid=$this->userid");
		if($this->userinfo['usertype'] == 1){
			$teacherModel = M('common_user_teacher');
			$userinfo = $usersModel->getRow("as a left join `$teacherModel->table` as b on a.userid = b.userid WHERE a.userid=$this->userid limit 1",'b.*,a.*');
		}else{
			$schoolModel = M('common_user_school');
			$userinfo = $usersModel->getRow("as a left join `$schoolModel->table` as b on a.userid =b.userid WHERE a.userid=$this->userid limit 1",'b.*,a.*');	
		}
		putsession('user',$userinfo);
		KS_INFO('密码修改成功！',4,'','',1);
     }
	 //历史原因所以造成了这里留了一个大空白，用来执行复杂sql语句的执行吧

	 //把用户名称重构一遍
	 public function reusernameAction(){
	     $usersModel            = M('common_user');
		 $menberlist            = $usersModel->getAll('where usertype=0 and (username REGEXP "^[0-9]+$")');
		 foreach($menberlist as $k=>$v){
		     $Data['username']  = 10000+$k;
		     //$usersModel->update($Data,'userid='.$v['userid']);
		     var_dump($v['username']);
		 }
		 exit;
		 
		
		 
     }

}














