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
class SmsModel extends Model{
	//批量更新
	public function status0(){
		$sql="UPDATE $this->table SET status=0";
		$GLOBALS['db']->execSql($sql);
	}
	public function status1($id){
		foreach($id as $key =>$v){
		   $sql="UPDATE $this->table SET status=1 where id=$v";
		   $GLOBALS['db']->execSql($sql);
		}
	}
	public function checkmodel($model){
		$sql="select * from $this->table  where model='ss' limit 1";
		$result=$GLOBALS['db']->execSql($sql);
		var_dump($result).die;
	}
	public function beachupdate($id,$smsnum,$content){
		foreach ($id as $key => $value){   
			$sql = "update $this->table set smsnum = '$smsnum[$key]',content = '$content[$key]' where id = $value ";
			$GLOBALS['db']->execSql($sql);
		}
    }
    /** 邮件发送
	 * @param: $name[string]        接收人姓名
	 * @param: $email[string]       接收人邮件地址
	 * @param: $subject[string]     邮件标题
	 * @param: $content[string]     邮件内容
	 * @param: $emailtype[int]      0 普通邮件， 1 HTML邮件
	 * @param: $notification[bool]  true 要求回执， false 不用回执
	 * @return boolean*/
	//2.不知道用户，不知道网校id的情况，只知道电话号码，例如：机构注册（$email,$modelname,'userReg','','',''），
	//3.知道home端用户id，知道网校id的情况，例如：机构手机绑定（$email,$modelname,'userCor','',$wxid,$userid）
	//4.不知道用户，知道网校id的情况，例如：学员注册（$email,$modelname,'memberReg','',$wxid,''），
	//5.知道index用户和home端id，网校id的情况，例如：学员手机绑定（$email,$modelname,'memberCor',$memberid,$wxid,$userid）
	public function send_email($email,$modelname,$type,$memberid='',$wxid='',$userid='',$params=array(),$notification=false,$emailtype=0){
		$GLOBALS['_CFG']['smtp_ssl']     = 1;//邮箱开始ssl
		$GLOBALS['_CFG']['emailSender']  = trim('service@kesion.com');
		$shop_name       = '科汛软件有限公司';
	    $charset         = 'UTF8';
	    $name            = '@kesion';
		$subject         = '我是测试邮件';
		$content         = '欢迎使用科汛软件';
		$Data['email']   = $email;
		$Data['memberip']= $_SERVER['REMOTE_ADDR'];
		$Data['adddate'] = time();
		$Data['logtype'] = 1;
		$Data['model']   = $modelname;
		$code            = rand(100000,999999);
		$setting = $this->cache->GetACache('setting');//读出缓存
		switch($type){
case 'testemail'  :
             $email_log       = M('common_email_log');
             $Data['content'] = $content;
		     $Data['mark']    = $code;
break; 
case 'userReg'    :
//短信是发给总后台的 
case 'userCor'    :
			 $email_log       = M('common_email_log');
			 $base            = $this->cache->GetACache('setting');//读出缓存
			 $content         = $this->cache->GetA('emailmodel','model',$modelname,'content');//取出缓存
			 $subject         = $this->cache->GetA('emailmodel','model',$modelname,'modelname');//取出缓存
			 /* 获得邮件服务器的参数设置 */
			 $params['host']  = trim($base['emailServer']);
			 $params['port']  = trim($base['emailPort']);
			 $params['user']  = trim($base['emailUser']);
			 $params['pass']  = trim($base['emailPassword']);
			 $code    = KS_MD5($code);
			 $url     = "http://store.kesion.com/home.html/default/Register/emailbind/".$userid."?email-".$email.",key-".$code;
		     $find    = array('{$sitename}','{$url}');
	         $replace = array($base['sitename'],$url);
		     $content = str_replace($find,$replace,$content);
			 $Data['model']  = $modelname;
			 $Data['userid'] = $userid;
break; 			 
case 'memberReg' :
             $base              = $this->cache->GetACache('setting');//读出缓存
             $website           = $this->cache->GetHCache('website',$wxid);//读出缓存sitename
			 /* 获得邮件服务器的参数设置 */
			 $params['host']    = trim($base['emailServer']);
			 $params['port']    = trim($base['emailPort']);
			 $params['user']    = trim($base['emailUser']);
			 $params['pass']    = trim($base['emailPassword']);
             $subject           = $this->cache->GetH('emailmodel','model',$modelname,'modelname',$wxid);//标题
			 $content           = $this->cache->GetH('emailmodel','model',$modelname,'content',$wxid);//内容
			 $shop_name         = $website['sitename'];//作者
			 $Tempreplace['content']     = $content;
			 $Tempreplace['modelname']   = $modelname;
			 $Tempreplace['code']        = $code;
			 $Tempreplace['wxid']        = $wxid;
			 $content           = $this->Tempreplace($Tempreplace,$params);
			 //var_dump($content);exit;
			 $email_log         = M('app_email_log');
			 $Data['wxid']      = $wxid;
			 $Data['content']   = $content;
		     $Data['mark']      = $code;
			 $emailnum          = $this->cache->GetH('domainbilling','type',2,'number',$wxid);
			// var_dump($emailnum);exit;
			 if(empty($emailnum)||$emailnum==0){//如果邮件数量为空
			 	  echo '邮件余额不足';exit;  
			 }elseif($emailnum==$setting['emailremind1']){
			 	  $common_user  = M('common_user');
			 	  $email1       = $common_user->getOne('email','where wxid='.$wxid.' and parentid=0 order by regdate asc limit 1');
			 	  $content1     = '尊敬的客户,您在'.$website['sitename'].'网站的邮件不足'.$setting['emailremind1'].'条，请及时充值，以免影响您网站的正常使用。';
			 }elseif($emailnum==$setting['emailremind2']){
			 	  $common_user  = M('common_user');
			 	  $email2       = $common_user->getOne('email','where wxid='.$wxid.' and parentid=0 order by regdate asc limit 1');
			 	  $content1     = '尊敬的客户,您在'.$website['sitename'].'网站的邮件不足'.$setting['emailremind2'].'条，请及时充值，以免影响您网站的正常使用。';
			 }elseif($emailnum==$setting['emailremind3']){
			 	  $common_user  = M('common_user');
			 	  $email3       = $common_user->getOne('email','where wxid='.$wxid.' and parentid=0 order by regdate asc limit 1');
			 	  $content1     = '尊敬的客户,您在{$sitename}网站的邮件不足'.$setting['emailremind3'].'条，请及时充值，以免影响您网站的正常使用。';
			 }
			 $Databill['number']     = $emailnum-1;
			 $Datadomian['emailnum'] = $emailnum-1;
			 $domain_billing         = M('common_domain_billing');
			 $common_domain          = M('common_domain');
			 $domain_billing ->update($Databill,'wxid='.$wxid.' and type=2');   
			 $common_domain  ->update($Datadomian,'wxid='.$wxid);   
			 $this->cache->PutHCache('domainbilling',$wxid);
			 $this->cache->PutACache('domaininfo');

break;
//短信是发给机构的
case 'memberCor' :
             $base            = $this->cache->GetACache('setting');//读出缓存
             $website         = $this->cache->GetHCache('website',$wxid);//读出缓存sitename
			 /* 获得邮件服务器的参数设置 */
			 $params['host']  = trim($base['emailServer']);
			 $params['port']  = trim($base['emailPort']);
			 $params['user']  = trim($base['emailUser']);
			 $params['pass']  = trim($base['emailPassword']);
             $subject         = $this->cache->GetH('emailmodel','model',$modelname,'modelname',$wxid);//标题
			 $content         = $this->cache->GetH('emailmodel','model',$modelname,'content',$wxid);//内容
			 $shop_name       = $website['sitename'];//作者
			 $Tempreplace['content']     = $content;
			 $Tempreplace['modelname']   = $modelname;
			 $Tempreplace['code']        = $code;
			 $Tempreplace['wxid']        = $wxid;
			 $content           = $this->Tempreplace($Tempreplace,$params);
			 $email_log         = M('app_email_log');
			 $Data['wxid']      = $wxid;
			 $Data['memberid']  = $memberid;
			 $Data['userid']    = $userid;
			 $Data['content']   = $content;
		     $Data['mark']      = $code;
			 $emailnum          = $this->cache->GetH('domainbilling','type',2,'number',$wxid);
			// var_dump($emailnum);exit;
			 if(empty($emailnum)||$emailnum==0){//如果邮件数量为空
			 	  echo '邮件余额不足';exit;  
			 }elseif($emailnum==$setting['emailremind1']){
			 	  $common_user  = M('common_user');
			 	  $email1       = $common_user->getOne('email','where wxid='.$wxid.' and parentid=0 order by regdate asc limit 1');
			 	  $content1     = '尊敬的客户,您在'.$website['sitename'].'网站的邮件不足'.$setting['emailremind1'].'条，请及时充值，以免影响您网站的正常使用。';
			 }elseif($emailnum==$setting['emailremind2']){
			 	  $common_user  = M('common_user');
			 	  $email2       = $common_user->getOne('email','where wxid='.$wxid.' and parentid=0 order by regdate asc limit 1');
			 	  $content1     = '尊敬的客户,您在'.$website['sitename'].'网站的邮件不足'.$setting['emailremind2'].'条，请及时充值，以免影响您网站的正常使用。';
			 }elseif($emailnum==$setting['emailremind3']){
			 	  $common_user  = M('common_user');
			 	  $email3       = $common_user->getOne('email','where wxid='.$wxid.' and parentid=0 order by regdate asc limit 1');
			 	  $content1     = '尊敬的客户,您在{$sitename}网站的邮件不足'.$setting['emailremind3'].'条，请及时充值，以免影响您网站的正常使用。';
			 }
			 $Databill['number']     = $emailnum-1;
			 $Datadomian['emailnum'] = $emailnum-1;
			 $domain_billing         = M('common_domain_billing');
			 $common_domain          = M('common_domain');
			 $domain_billing ->update($Databill,'wxid='.$wxid.' and type=2');   
			 $common_domain  ->update($Datadomian,'wxid='.$wxid);   
			 $this->cache->PutHCache('domainbilling',$wxid);
			 $this->cache->PutACache('domaininfo');
break;
default:break;
}
		//这里是发送部分
		/* 邮件的头部信息 */
		$content_type = ($emailtype == 0) ?
			'Content-Type: text/plain; charset=' . $charset : 'Content-Type: text/html; charset=' . $charset;
		$content      =  base64_encode($content);
		//var_dump($content);exit;
		$headers      = array();
		$headers[] = 'Date: ' . gmdate('D, j M Y H:i:s') . ' +0000';
		$headers[] = 'To: "' . '=?' . $charset . '?B?' . base64_encode($name) . '?=' . '" <' . $email. '>';
		$headers[] = 'From: "' . '=?' . $charset . '?B?' . base64_encode($shop_name) . '?='.'" <' . $GLOBALS['_CFG']['emailSender'] . '>';
		$headers[] = 'Subject: ' . '=?' . $charset . '?B?' . base64_encode($subject) . '?=';
		$headers[] = $content_type . '; format=flowed';
		$headers[] = 'Content-Transfer-Encoding: base64';
		$headers[] = 'Content-Disposition: inline';
		if ($notification){
			$headers[] = 'Disposition-Notification-To: ' . '=?' . $charset . '?B?' . base64_encode($shop_name) . '?='.'" <' . $GLOBALS['_CFG']['emailSender'] . '>';
		}
		if (empty($params['host']) || empty($params['port'])){
			// 如果没有设置主机和端口直接返回 false//echo $GLOBALS['_LANG']['smtp_setting_error'];
			echo '没有设置主机和端口';
			return false;
		}else{
			// 发送邮件
			if (!function_exists('fsockopen')){
				//如果fsockopen被禁用，直接返回//echo $GLOBALS['_LANG']['disabled_fsockopen'];
				echo 'fsockopen被禁用';
				$Data['issuccess'] = 0;
				$email_log->doAdd($Data,'id');
				return false;
			}
			$send_params['recipients'] = $email;
			$send_params['headers']    = $headers;
			$send_params['from']       = $GLOBALS['_CFG']['emailSender'];
			$send_params['body']       = $content;
			if($this->sendemail($params,$send_params)){
				$Data['issuccess'] = 1;$email_log->doAdd($Data,'id');return true;
			}else{
				$Data['issuccess'] = 0;$email_log->doAdd($Data,'id');return false;
			}
		}
	}
	/** 邮件发送*/
	public function sendemail($params,$send_params){
		$smtp = new \Core\Smtp($params);
		if ($smtp->connect() && $smtp->send($send_params)){
			return true;
		}else{
			$err_msg = $smtp->error_msg();
			if (empty($err_msg)){
				 echo 'Unknown Error';
			}else{
				if (strpos($err_msg, 'Failed to connect to server') !== false){
					 echo '没有连接上';//echo sprintf($GLOBALS['_LANG']['smtp_connect_failure'], $params['host'] . ':' . $params['port']);
				}else if (strpos($err_msg, 'AUTH command failed') !== false){
					 echo '账号密码有错';//echo $GLOBALS['_LANG']['smtp_login_failure'];
				}elseif (strpos($err_msg, 'bad sequence of commands') !== false){
					 echo 'SMTP拒绝';//echo $GLOBALS['_LANG']['smtp_refuse'];
				}else{echo $err_msg;}
			}
			return false;
		}
	}
	/** 模板替换 */
	public function Tempreplace($Tempreplace,$params){
		if(isset($Tempreplace['wxid'])){$website        = $this->cache->GetHCache('website',$Tempreplace['wxid']);}//读出缓存sitename
		$content        = $Tempreplace['content'];
		switch($Tempreplace['modelname']){
		 	case 'Classnotice'://班级通知
		 	   $find    = array('{$username}','{$classname}','{$content}');
               $replace = array($params['username'],$params['classname'],$params['content']);
	           $content = str_replace($find,$replace,$content);
		 	break;
		 	case 'Validate'://邮箱验证
		 	   $find    = array('{$sitename}','{$code}');
               $replace = array($website['sitename'],$Tempreplace['code']);
               $content = str_replace($find,$replace,$content);
		 	break;
		 	case 'Register'://注册模块
		 	   $find    = array('{$sitename}','{$code}');
               $replace = array($website['sitename'],$Tempreplace['code']);
	           $content = str_replace($find,$replace,$content);
		 	break;
		 	case 'Assignment'://布置作业
		 	   $find    = array('{$username}','{$teacher}','{$homework}');
               $replace = array($params['username'],$params['teacher'],$params['homework']);
	           $content = str_replace($find,$replace,$content);
		 	break;
		 	case 'Sendscore'://成绩公布
		 	   $find    = array('{$username}','{$homework}','{$score}');
               $replace = array($params['username'],$params['homework'],$params['score']);
	           $content = str_replace($find,$replace,$content);
		 	break;
		 	case 'Signclass'://上课签到
		 	   $find    = array('{$username}','{$date}','{$content}');
               $replace = array($params['username'],$params['date'],$params['content']);
	           $content = str_replace($find,$replace,$content);
		 	break;
		 	case 'Sendvoucher'://发放优惠券
		 	   $find    = array('{$username}','{$money}','{$date}','{$sitename}');
               $replace = array($params['username'],$params['money'],$params['date'],$params['sitename']);
	           $content = str_replace($find,$replace,$content);
		 	break;
		}
		return $content;
	}	
	//发送站内信
	public function qqsendmail($Data008,$usrids){
		if(!isset($GLOBALS['_DoM']['qqsendmail'])){
			$data     = array();
		switch($Data008['type']){
case '1'   :break; 	
case '2'   :break; 			 
case '3'   : $website           = $this->cache->GetHCache('website',$Data008['wxid']);//读出缓存sitename
             $data['title']     = $this->cache->GetH('massagemodel','model',$Data008['modelname'],'modelname',$Data008['wxid']);//标题
			 $content           = $this->cache->GetH('massagemodel','model',$Data008['modelname'],'content',$Data008['wxid']);//内容
			 $data['inputer']   = $website['sitename'];//作者
			 $Tempreplace['content']     = $content;
			 $Tempreplace['modelname']   = $Data008['modelname'];
			 $Tempreplace['wxid']        = $Data008['wxid'];
			 $data['content']            = $this->Tempreplace($Tempreplace,$Data008);
			 $Massage           = M('app_information');
	 	     $Rule['content']   = '消息内容|isEmpty';
		     $Rule['title']     = '消息标题|isEmpty';
		     $data['wxid']      = $Data008['wxid'];
		     if(!empty($usrids)){$userresult = array_map(create_function('$usrids','return "a$usrids";'),$usrids);}
		 	 $data['student']   = implode(',', $userresult).',';
		 	 $data['model']     = $Data008['modelname'];
		 	 $data['sendnum']   = count($usrids);
		 	 $data['adddate']   = time();
break;
case '4'  :
             $website            = $this->cache->GetHCache('website',$Data008['wxid']);//读出缓存sitename
             $data['title']      = $this->cache->GetH('massagemodel','model',$Data008['modelname'],'modelname',$Data008['wxid']);//标题
			 $content            = $this->cache->GetH('massagemodel','model',$Data008['modelname'],'content',$Data008['wxid']);//内容
			 $data['inputer']    = $website['sitename'];//作者
			 $Tempreplace['content']     = $content;
			 $Tempreplace['modelname']   = $Data008['modelname'];
			 $Tempreplace['wxid']        = $Data008['wxid'];
			 $data['content']            = $this->Tempreplace($Tempreplace,$Data008);
			 $Massage           = M('app_information');
			 $Rule['content']   = '消息内容|isEmpty';
		     $Rule['title']     = '消息标题|isEmpty';
			 $data['wxid']      = $Data008['wxid'];
		     if(!empty($usrids)){$userresult = array_map(create_function('$usrids','return "a$usrids";'),$usrids);}
		 	 $data['student']   = implode(',', $userresult).',';
		 	 $data['model']     = $Data008['modelname'];
		 	 $data['sendnum']   = count($usrids);
		 	 $data['adddate']   = time();
		 	 //$data['infoid']    = $Data008['infoid'];
break;
default:break;
}
        Chkpost($data,$Rule,$Massage);
	 	$Massage->doAdd($data,'id');
	 	$GLOBALS['_DoM']['qqsendmail'] = 1; 
		}
	}
}