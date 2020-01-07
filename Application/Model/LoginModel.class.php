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



namespace Kesion\Model\Application;
use Kesion\Model;
class LoginModel extends Model{
	public function status0(){
		 $sql = "UPDATE $this->table SET status=0";
		 $GLOBALS['db']->execSql($sql);
	}
	public function status1($id){
		 foreach($id as $key =>$v){
		    $sql = "UPDATE $this->table SET status=1 where id=$v";
		    $GLOBALS['db']->execSql($sql);
		 }
	}
	/**
     * index端学生登陆记录
	 * @param mixed $memberid
	 * @param mixed $type
	 * @return boolean
	 */
	public function loginrecord($memberid,$type){

		$usersModel        = M('common_user');
        $user              = $usersModel->getRow("where wxid=".$GLOBALS['_DoM']['wxid']." and userid = ".$memberid." limit 1",'password,rndpasswordc,usertype,parentid,userid,status,wxid,email');
        if ($user){
            if ($user['usertype']>0 && is_weixin()){   //如果是公众号退出且账号是机构，则取消微信绑定  修改于2019.3.29 by 自由的飞
                $Data['openid']='';
                $Data['unionid']='';
                $Data['wechatbing']=0;
                $usersModel->update($Data,"wxid=".$GLOBALS['_DoM']['wxid']." and userid=".$memberid);
                unset($Data);
            }
            return false;           //暂时不记录


            $Data['wxid']      = $GLOBALS['_DoM']['wxid'];
            $Data['memberid']  = $user['userid'];
            $Data['userid']    = $user['parentid'];
            $Data['memberip']  = $_SERVER['REMOTE_ADDR'];
            $Data['adddate']   = time();
            $Data['type']      = $type;
            if($type==0){
                if(isMobile()){$Data['logintype'] = 1;$Data['mark']= '很正常的一次手机端登录';}
                else{$Data['logintype'] = 0;$Data['mark']= '很正常的一次PC端登录';}
            }else{
                if(isMobile()){$Data['logintype'] = 1;$Data['mark']= '很正常的一次手机端退出';}
                else{$Data['logintype'] = 0;$Data['mark']= '很正常的一次PC端退出';}
            }
            $login_log         = M('app_login_log');
            $login_log->doAdd($Data,'id');
        }
	}
	/** loginlog home端机构教师登陆记录
	 * $Data001  'wxid','userid'
	 * type 0登录，1退出*/
	public function loginlog($Data001){
		if(isset($Data001['wxid'])){$GLOBALS['_DoM']['wxid']=$Data001['wxid'];}
		$usersModel        = M('common_user');
        $user              = $usersModel->getRow("where wxid=".$GLOBALS['_DoM']['wxid']." and userid = ".$Data001['userid']." limit 1",'username,password,rndpasswordc,usertype,parentid,userid,status,wxid,email');
	    $Data['wxid']      = $GLOBALS['_DoM']['wxid'];
		$Data['userid']    = $user['userid'];
		$Data['username']  = $user['username'];
		$Data['parentid']  = $user['parentid'];
		$Data['userip']    = $_SERVER['REMOTE_ADDR'];
		$Data['adddate']   = time();
		$Data['type']      = $Data001['type'];
		if($Data001['type']==0){
			if(isMobile()){$Data['logintype'] = 1;$Data['mark']= '很正常的一次手机端登录';}
		    else{$Data['logintype'] = 0;$Data['mark']= '很正常的一次PC端登录';}
		}else{
			if(isMobile()){$Data['logintype'] = 1;$Data['mark']= '很正常的一次手机端退出';}
		    else{$Data['logintype'] = 0;$Data['mark']= '很正常的一次PC端退出';}
		}
		$login_log         = M('common_login_log');
		$login_log->doAdd($Data,'id');
		if($Data001['type']==0){
			$numb                 = $login_log->getOne('count(id)','where wxid='.$GLOBALS['_DoM']['wxid'].' and type=0');
		    $Datas['logintimes']  = $numb;
			$common_user          = M('common_user');
			$common_user          ->update($Datas,'userid='.$user['userid'].' and wxid='.$GLOBALS['_DoM']['wxid']);
			$user_website         = M('common_user_website');
			$user_website         ->update($Datas,'wxid='.$GLOBALS['_DoM']['wxid']);
		}
	}
	/**进行学员登录
	 * id 1 web登录
	 * id 3 Android登录
	 *
	 * **/
	public function login($Data002){
		$id          = isset($Data002['id'])?$Data002['id']:ChkClng(KS_G('request.id'));
		$username    = isset($Data002['username'])?$Data002['username']:ChkSQL(KS_G('post.username'));
		$password    = isset($Data002['password'])?$Data002['password']:ChkSQL(KS_G('post.password'));
		$wxid        = ChkClng(KS_G('post.wxid'));
		$usersModel  = M('common_user');
		if($id==3){$wxid = $usersModel->getOne('wxid',"where usertype=0 and username='$username' limit 1");$GLOBALS['_DoM']['wxid']=0;}
		if(!empty($wxid)){$GLOBALS['_DoM']['wxid'] = $wxid;}
		$code        = ChkSQL(KS_G('post.Logincode'));
		$website     = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		$status=0;$issms=0;
		if(empty($password)){
			$issms       = getSetting(0,17,$GLOBALS['_DoM']['wxid']);//短信验证
			$status      = $this->cache->GetH('smsmodel','modelname','Login','status',$GLOBALS['_DoM']['wxid']);//读出缓存
			if($status==1 && $issms==1){
				$smslog  = M('app_sms_log');
				$content = $smslog->getOne('content',"where mobile='$username' and logtype=0 and model='Login' and wxid = ".$GLOBALS['_DoM']['wxid']." and adddate>='".time()."'-10000 order by adddate desc limit 1");
				$content = preg_replace('/\D/s', '', $content);
				if($code!=$content||empty($code)){KS_INFO("<script>parent.regSuccessBack('验证码错误');</script>",-1);}
		    }
		}
		$user = $usersModel->getRow("where mobile='$username' and mobilebing=1 and wxid = ".$GLOBALS['_DoM']['wxid']." and usertype=0 limit 1",'password,rndpasswordc,usertype,parentid,openid,userid,username,status,wxid,email,openid');
		//这个机构登录是有做的，在有绑定手机或者邮箱的情况下，是允许手机或者邮箱登录的------待做
		/*if(!$user && $website['isphonelogin']==1)*/
		//在有绑定手机或者邮箱的情况下，是允许手机或者邮箱登录的
		if(!$user){$user = $usersModel->getRow("where username='$username' and wxid = ".$GLOBALS['_DoM']['wxid']." and usertype=0 limit 1",'password,rndpasswordc,usertype,parentid,openid,userid,username,status,wxid,email,openid');}
		if(!$user){$user = $usersModel->getRow("where email='$username' and emailbing=1 and wxid = ".$GLOBALS['_DoM']['wxid']." and usertype=0 limit 1",'password,rndpasswordc,usertype,parentid,openid,userid,username,status,wxid,email,openid');}
		if(!$user){
			if($id==3){$result['errcode']='10001';$result['errmsg']='用户不存在';return $result;}//用户不存在
			elseif($id==2){echo '{"errcode":"10001"}';exit;}
			else{KS_INFO("<script>parent.loginSuccessBack('登录失败');</script>",-1);}
		}elseif($user['status']==2){
			if($id==3){$result['errcode']='10002';$result['errmsg']='用户被锁';return $result;}//用户被锁
			else{KS_INFO("<script>parent.loginSuccessBack('该账户已被锁定');</script>",-1);}
		}elseif($user['status']==0){
			if($id==3){$result['errcode']='10003';$result['errmsg']='用户未通过审核';return  $result;} //用户未通过审核
			else{KS_INFO("<script>parent.loginSuccessBack('该账户未通过审核');</script>",-1);}
		}
		//var_dump($user);exit;
		if($user['password']==KS_MD5($password.KS_MD5($user['rndpasswordc']))||($status==1 && $issms==1)){
			$lastlogintime       = time();
			$lastloginip         = $_SERVER['REMOTE_ADDR'];
			$GLOBALS['db']->execSql("UPDATE `$usersModel->table` SET `lastlogintime`='$lastlogintime', `lastloginip`='$lastloginip', `logintimes`=logintimes+1 WHERE userid=$user[userid]");
			//model层记录登录记录
            //$loginModel = M('Application/LoginModel');
	        //$loginModel->loginrecord($user['userid'],0);
	        $this->loginrecord($user['userid'],0);
	        if($id==3){//Android登录
	        	 $result['userid']   = $user['userid'];
				 $result['username'] = $user['username'];
				 if($user['usertype'] == 0){
					 $memberModel    = M('common_user_member');
					 $result['name'] = $memberModel->getOne('name','where userid = '.$user['userid'].' limit 1');
				 }else{$result['errcode']  = '10005'; $result['errmsg'] = '该账号不是学生账号'; return $result;}//密码不正确
				 $result['avatar']   = 'http:'.$this->upload->getHead($user['userid']);
				 $actoken            = KS_MD5(time().$username.rand(1000,9999));
				 $Data['userid']     = $user['userid'];
				 $Data['acctoken']   = $actoken;
				 $Data['adddate']    = time();
				 $tokenModel         = M('common_token');
				 $token = $tokenModel -> getRow('where userid='.$user['userid'].' limit 1');
				 if($token){$tokenModel->update($Data,'id='.$token['id']);}
				 else{$tokenModel->doAdd($Data,'id');}
				 $result['token']     = $actoken;
				 $result['wxid']      = $user['wxid'];
				 return $result;
	        }else{
		        //登陆成功把openid记录进去
		        if(!empty(ChkSQL(KS_G('post.openid')))){
		        	$Datas['openid']         = ChkSQL(KS_G('post.openid'));
		        	$userinfo['openid']      = $Datas['openid'];
		        }else{$userinfo['openid']     = $user['openid'];}
		        //用户token
		        $Datas['h5token']   = KS_MD5(time().KS_G('post.openid'));
				$Datas['tokentime'] = (time() +7200);
	        	$usersModel->update($Datas,'userid='.$user['userid']);
		        //获取用户的域名
                $domain=wx_Url($GLOBALS['_DoM']['wxid']);
				//把一些基本信息放入session
				$userinfo['userid']   = $user['userid'];
				$userinfo['username'] = $user['username'];
				$userinfo['usertype'] = $user['usertype'];
				$userinfo['openid']   = $user['openid'];
				$userinfo['wxid']     = $user['wxid'];//网校id
				putsession('member',$userinfo);
			}
			//这个机构登录是有做的，登录成功，请完善资料------待做
			//if($website['isinfo']==1){$url =  M_URL('Index','addinfo');KS_INFO('登录成功，请完善资料',2,$url);}
			if($id==2){
				$userinfoModel = M('common_user_member');
				$name= $userinfoModel->getOne('name','where userid='.$user['userid']);
				$userhead=$this->memberinfo['userHead']= $this->upload->getHead($user['userid']);
				echo '{"succeed":"10001","id":"'.$user['userid'].'","userhead":"'.$userhead.'","name":"'.$name.'","token":"'.$Datas['h5token'].'","xuankeurl":"'.M_URL('home','xuanke').'","domain":"'.$domain.'"}';
				exit;}
			elseif($id==1){KS_INFO("<script>parent.loginSuccessBack('登录成功');</script>",'-1');}
			else{KS_INFO('登录成功',5,M_URL());}
		}else{
			if($id==3){$result['errcode']='10004';$result['errmsg']='密码不正确';return $result;}//密码不正确
			elseif($id==2){echo '{"errcode":"10001"}';exit;}
			else{KS_INFO("<script>parent.regSuccessBack('密码错误');</script>",-1);}
		}
	}
	/**进行机构网校登录
	 * id 1 web登录
	 * id 3 Android登录
	 *
	 * **/
	public function wxlogin($Data003){

	}
}