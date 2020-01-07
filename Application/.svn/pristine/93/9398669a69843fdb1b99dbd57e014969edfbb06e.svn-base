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
class LoginController extends Controller
{
    public  function _initialize(){
        $this->userinfo   = User_GetUserInfo();
	}


	/**
     * 进入登录界面
	 */
	public function indexAction(){

        $go=KS_S('get.go');

        /******************************************* 来自微信公众号，店铺管理（针对非学员） Create By 自由的飞 at 2019.3.29 begin ***********************************/

        if ($go=='wechat'){
            if (is_weixin()){
                $wechat = new \Core\Wechat();
                $wechatinfo=$wechat->authAction(false);   //调用通用的微信授权函数,并且机构不自动创账号，让其用绑定的方式
                if ($wechatinfo){    //授权成功返回
                    $param='';
                    $UserMode      = M('common_user');
                    if ($wechatinfo->unionid){
                        $param="unionid='".$wechatinfo->unionid."'";
                    }else{
                        $param="openid='".$wechatinfo->openid."'";
                    }
                    $info        = $UserMode->getRow('where '.$param.' and usertype>0 and wechatbing=1 order by lastlogintime desc limit 1');
                    if(!empty($info)){       //有登录绑定过了
                        $usertoken['h5token']    = KS_MD5(time().$wechatinfo->openid);
                        $usertoken['tokentime']  = (time() +7200);
                        $UserMode->update($usertoken,$param.' and usertype>0 and wechatbing=1');
                        $newurl  = wx_Url($info['wxid']).'/h5market/wechatlogin?from=store&token='.$usertoken['h5token'];   //跳到店铺进行鉴权登录
                        ks_header($newurl);

                    }else{                  //未绑定跳到绑定登录
                        ks_header('/home.html#/login?openid='.$wechatinfo->openid.'&unionid='.$wechatinfo->unionid);

                    }
                }else{

				}
            }
        }
        /***************************************************************** 来自微信公众号，店铺管理（针对非学员）  end ***********************************************/
		ks_header('/home.html#/login');
    }











	/**
     * 验证 home端预登录（平台方）
	 */
	public function presiginAction(){
		$username   = ChkSQL(KS_G('post.username'));
		$password   = ChkSQL(KS_G('post.password'));
        $usersModel = M('common_user');
		$user       = $usersModel->getRow("WHERE mobile='$username' and powertype!=0 and usertype!=0 and mobilebing=1 order by userid asc limit 1",'password,rndpasswordc,usertype,userid,username,status,wxid,email');
		if(!$user){
			$user = $usersModel->getRow("WHERE  username='$username' and powertype!=0 and usertype!=0 order by userid asc limit 1",'password,rndpasswordc,usertype,userid,status,wxid,mobilebing');
		}

		if(!$user){
            KS_INFO('没有该账号，请注册！','','','',3);
		}elseif($user['status']==2){
            KS_INFO('该账户已被锁定','','','',3);
	    }elseif($user['status']==0){
            KS_INFO('该账户未通过审核','','','',3);
        }
		if($user['password']==KS_MD5($password.KS_MD5($user['rndpasswordc']))){
			header("Content-type: application/json");

           
            $wxid      =  $user['wxid'];
            $db_user   = M('common_user');
            $Data['h5token']    = KS_MD5($wxid.rand(1000,10000).time(),32);
            $Data['tokentime']  = time()+7200;

            $Data['lastlogintime'] = time();
			$Data['lastloginip']   = KS_IP();
            $Data['logintimes']    = 'logintimes+1';
            $db_user->update($Data,'wxid='.$wxid.' and userid='.$user['userid']);

            $url=wx_Url($wxid).'/home.html?managetoken='.KS_MD5($Data['h5token'],32);


            die (json_encode(array('result'=>'succeed','url'=>$url)));

		}else{
			KS_INFO('密码错误','','','',3);
	    }
	}
    ///**
    // * 验证home端登录 （跳到对应的网校下登录）
    // */
    //public function siginAction(){
    //    $username   = ChkSQL(KS_G('post.username'));
    //    $password   = ChkSQL(KS_G('post.password'));

    //    /*获取从公众号授权进来的openid*/
    //    $openid = ChkSQL(KS_S('post.openid'));
    //    $unionid  = ChkSQL(KS_S('post.unionid'));
    //    $usersModel = M('common_user');
    //    $base       = $this->cache->GetACache('setting');//读出缓存
    //    $user       = $usersModel->getRow("WHERE mobile='$username' and powertype!=0 and usertype!=0 order by userid asc limit 1",'password,rndpasswordc,usertype,userid,username,status,wxid,email');
    //    if(!$user){
    //        $user = $usersModel->getRow("WHERE  username='$username' and powertype!=0 and usertype!=0 order by userid asc limit 1",'password,rndpasswordc,usertype,userid,username,status,wxid,mobilebing');
    //    }
    //    if(!$user){KS_INFO('没有该账号，请注册！');
    //    }elseif($user['status']==2){KS_INFO('该账户已被锁定');
    //    }elseif($user['status']==0){KS_INFO('该账户未通过审核');}
    //    if($user['password']==KS_MD5($password.KS_MD5($user['rndpasswordc']))){
    //        $lastlogintime = time();
    //        $lastloginip   = KS_IP();

    //        $updateSQL="`lastlogintime`='$lastlogintime', `lastloginip`='$lastloginip', `logintimes`=logintimes+1";
    //        if (!empty($openid)){
    //            $updateSQL.=" ,`openid`='$openid',`wechatbing`=1";
    //        }
    //        if (!empty($openid)){
    //            $updateSQL.=" ,`unionid`='$unionid'";
    //        }
    //        $GLOBALS['db']->execSql("UPDATE `$usersModel->table` SET ".$updateSQL." WHERE userid=$user[userid]");
    //        $userinfo['userid']   = $user['userid'];
    //        $userinfo['username'] = $user['username'];
    //        $userinfo['usertype'] = $user['usertype'];  //用户类型
    //        $userinfo['wxid']     = $user['wxid'];      //网校id

    //        putsession('user',$userinfo);
    //        $Data001['userid'] = $user['userid'];
    //        $Data001['wxid']   = $user['wxid'];
    //        $Data001['type']   = 0;
    //        $LoginModel =  M('Application/LoginModel');
    //        $LoginModel->loginlog($Data001);//登记登录用户信息
    //        $mydomain=wx_Url($user['wxid']);
    //        if (isMobile(true)){
    //            $url=$mydomain.'/#/user';
    //        }else{
    //            $url=$mydomain.str_replace(UOOT,RUOOT,M_URL());
    //        }

    //        exit("<script>top.location.href='".$url."'</script>");
    //    }else{
    //        KS_INFO('密码错误');
    //    }
    //}





	//QQ登录界面
	public function apiloginAction(){
		$id        = ChkClng(KS_G('request.id'));
		$loginconf = $this->cache->GetA('loginconf','id',$id,'',true);//取出缓存
		if(empty($loginconf)){KS_INFO('操作失误',4);}
		if($id==1)
		{
		$apiID = $loginconf['apiID'];
		$redirect_uri = urlencode('http://www.kesion.com'.M_URL('Login','apiloginback'));
		$url = "https://graph.qq.com/oauth/show?which=Login&display=pc&response_type=code&client_id=".$apiID."&redirect_uri=".$redirect_uri."&state=565&scope=get_user_info,get_info";
		ks_header($url);
		}else{echo "其他登录还没有开通，先用qq登录测试";}
    }
	//QQ登录返回
	public function apiloginbackAction(){
		$code = ChkSQL(KS_G('request.code'));
		if($code === ''){
			exit("<script>top.location.href='".M_URL('register')."'</script>");
		}
		$loginconf    = $this->cache->GetA('loginconf','id','1','',true);//取出缓存
		$apiID        = $loginconf['apiID'];
		$apiKey       = $loginconf['apiKey'];
		$redirect_uri = 'http://www.kesion.com'.M_URL('Login','apiloginback');
		//获得QQ access_token登录令牌
		$data = array(
		   'grant_type'    => 'authorization_code',
		   'client_id'     => $apiID,
		   'client_secret' => $apiKey,
		   'code'          => $code,
		   'redirect_uri'  => $redirect_uri
		);
		$url = 'https://graph.qq.com/oauth2.0/token';
		$result = curlGet($url,$data);
		parse_str($result,$res);
		$access_token = $res['access_token'];
		//根据access_token获得Openid
		$data    = array('access_token'  => $access_token);
		$url     = 'https://graph.qq.com/oauth2.0/me';
		$result  = curlGet($url,$data);
		$find    = array('callback(',');');
		$replace = array('','');
		$date    = str_replace($find,$replace,$result);
		$res     = json_decode($date,true);
		//根据Openid获得QQ用户信息
		$data = array(
		    'access_token'        => $access_token,
		    'oauth_consumer_key'  => $res['client_id'],
		    'openid'              => $res['openid'],
		);
		$url     = 'https://graph.qq.com/user/get_user_info';
		$result  = curlGet($url,$data);
		$loginfo = array();
		$loginfo['openid']     = $res['openid'];
		$loginfo['user_info']  = $result;
		putsession('loginfo',$loginfo);
		ks_header(M_URL('Login','apibind'));
	}
	//QQ登录界面
	public function apibindAction(){
		$loginfo    = getsession('loginfo');
        if($loginfo === null) {$url = M_URL('register');ks_header($url);}
        $usersModel = M('common_user');
		//先取出session，有的话说明是为了绑定qq才进来的
		$exxxxx     = getsession('user');
		if($exxxxx !== null) {
			$opcount = $usersModel->getOne('count(*)',"WHERE openid='$loginfo[openid]'");
			if($opcount>0)
			{
				$DataOne['qqbing'] = 0;
				$DataOne['openid'] = '';
				$usersModel->update($DataOne,"openid='$loginfo[openid]'");
			}
			$DataTwo['qqbing'] = 1;
			$DataTwo['openid'] = $loginfo['openid'];
			$usersModel->update($DataTwo,"userid='$exxxxx[userid]'");
			cookie('indoor',M_URL('kjlogin'));
			$qqbing = 1;
		}
		//查看该qq用户是否有在user表，没有就要先加到表里（这里还得看admin端首次登入自动创建账号）
		$base  = $this->cache->GetACache('setting');//读出缓存
		$user  = $usersModel->getRow("WHERE openid='$loginfo[openid]' limit 1");
		if(!$user){
			$res   = json_decode($loginfo['user_info'],true);
			//这里还得看admin端首次登入自动创建账号.1是自动创建
			if($base['loginState']==='1')
			{
				$Data['openid']     = $loginfo['openid'];
				$Data['username']   = $res['nickname'];
				$domainModel        = M('common_domain');
				$Data['wxid']       = $domainModel->getMaxValue('wxid')+1;//生成网校id
				//$Data['defaultpic'] = $res['figureurl_qq_2'];
				$Data['regdate']    = time();
				$Data['status']     = 1;
				$DataThree['userid']= $usersModel->doAdd($Data,'userid');
				$DataThree['wxid']  = $Data['wxid'];
		        $domainModel->doadd($DataThree,"id");
		        $this->cache->putACache('domaininfo');//写入缓存

				$userinfo = $usersModel->getRow("WHERE openid='$loginfo[openid]' limit 1");
				putsession('loginfo',null);
				putsession('user',$userinfo);
				if(empty($userinfo['email']))
				{
					cookie('indoor',M_URL('User','editUsers','-2'));
				    KS_INFO('',2,M_URL('User'));
				}else{ks_header(M_URL());}
			}else{
				include  CURR_VIEW_PATH . "apibind.php";
			}
		}else{
		   if($user['usertype'] == '1'){
				$user_teacher = M('common_user_teacher');
				$countNum     = $user_teacher->getOne('count(*)',"where userid=$user[userid]");
				//这个是可有可无的，把副表数据更新下
				if($countNum!=='1'){
					$user_teacher->delete("userid=$user[userid]");
					$Datats['userid'] = $user['userid'];
					$user_teacher->doEfAdd($Datats);}
			}elseif($user['usertype'] == '2'){
				$user_school = M('common_user_school');
				$countNum    = $user_school->getOne('count(*)',"where userid=$user[userid]");
				//这个是可有可无的，把副表数据更新下
				if($countNum!=='1'){
					$user_school->delete("userid=$user[userid]");
					$Datats['userid'] = $user['userid'];
					$user_school->doEfAdd($Datats);}
			}
			$userinfo['userid']   = $user['userid'];
			$userinfo['username'] = $user['username'];
			$userinfo['usertype'] = $user['usertype'];
			$userinfo['wxid']     = $user['wxid'];//网校id
			putsession('loginfo',null);
			putsession('user',$userinfo);
			if($base['registerinfo']==1&&$user['email']==''){
				cookie('indoor',M_URL('User','editUsers','-2'));
				KS_INFO('',2,M_URL('User'));
			}else{exit("<script>top.location.href='".M_URL()."'</script>");}
		}
    }
	//QQ登录后注册绑定
	public function doRegisterAction(){
		if(strlen(ChkSQL(KS_G('post.domain')))<4||strlen(ChkSQL(KS_G('post.domain')))>20)
		{KS_INFO('二级域名4-20字');}
		$DataTwo['domain']     = ChkSQL(KS_G('post.domain'));
		$code                  = ChkSQL(KS_G('post.code'));
		$Data['username']      = ChkSQL(KS_G('post.username'));
		$Data['mobile']        = ChkSQL(KS_G('post.mobile'));
		$Data['openid']        = ChkSQL(KS_G('post.openid'));
		$Data['usertype']      = ChkClng(KS_G('post.usertype'));
		$Data['password']      = ChkSQL(KS_G('post.password'));
		$Data['rndpasswordc']  = rand(100000,999999);
		$Data['regdate']       = ChkClng(time());
		$base = $this->cache->GetACache('setting');//读出缓存
		if($Data['usertype'] == '1')
		{
			if($base['reviewTeacher'] == '1'){$Data['status'] = 0;}
			else{$Data['status']      = 1;}
		}elseif($Data['usertype']     == '2'){
		    if($base['reviewSchool']  == '1'){$Data['status'] = 0;}
			else{$Data['status']      = 1;}
		}
		$smslog  = M('common_sms_log');
		$content = $smslog->getOne('content',"where mobile='$Data[mobile]' and logtype=0 and model='Register' and adddate>='".time()."'-10000 order by adddate desc limit 1");
		$content = preg_replace('/\D/s', '', $content);
		if($this->Sms->smsState('Register')){
			if($code!=$content||empty($code)){KS_INFO('验证码错误','2');}
		}
	    $usersModel  = M('common_user');
		$domainModel = M('common_domain');

		//检测二级域名
		$RuleTwo['domain']  =  '二级域名|isEmpty,isEnglish';
		Chkpost($DataTwo,$RuleTwo,$domainModel);
		$DataTwo['domain']  = ChkSQL(KS_G('post.domain')).'.zuojy.com';
		$RuleTwo['domain']  =  '二级域名|isEmpty,isEnglish,isDbexis';
		Chkpost($DataTwo,$RuleTwo,$domainModel);

		$Rule['mobile']     =  '手机号|isEmpty,isMobile,isDbexis';
		$Rule['password']   =  '密码|isEmpty,isPassword';
		$Rule['usertype']   =  '会员类型|isEmpty';
		Chkpost($Data,$Rule,$usersModel,'parentid=0');

		$Data['wxid']       = $domainModel->getMaxValue('wxid')+1;//生成网校id
		if($Data['wxid']<20)$Data['wxid']=20;

		$Data['password']   = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));
		$result = $usersModel->doAdd($Data,'userid');
		$tempModel = M('common_temp');
		$isdefault = $tempModel->getAll(' where isdefault = 1');
		foreach($isdefault as $k=>$v){
			if($v['temptype'] == 0 ){$DataTwo['tempPid'] =$v['id'];}
			elseif($v['temptype'] == 1){$DataTwo['tempMid'] =$v['id'];}
			elseif($v['temptype'] == 2){$DataTwo['tempPxt'] =$v['id'];}
			elseif($v['temptype'] == 3){$DataTwo['tempMxt'] =$v['id'];}
		}
		$DataTwo['userid']  = $result;//绑定二级域名
		$DataTwo['wxid']    = $Data['wxid'];//网校id
		$domainModel->doAdd($DataTwo,"id");
		$this->cache->putACache('domaininfo');//写入缓存
		//插入第二张表
		if($Data['usertype'] == '1'){
			$Datas['userid'] = $result;
			$user_teacher    = M('common_user_teacher');
			$user_teacher->delete("userid=$Datas[userid]");
			$user_teacher->doEfAdd($Datas);}
		else{
			$Datas['userid'] = $result;
			$user_school = M('common_user_school');
			$user_school->delete("userid=$Datas[userid]");
			$user_school->doEfAdd($Datas);
		}
		$appModel      = new IndexModel('common_app');
        $MoustChoose   = $appModel->getAll('where MustChoose = 1 and status = 1','appid');
	    $appuserrelate = new IndexModel('common_app_userrelate');
		$Data1['userid'] = $result;
		foreach($MoustChoose as $k=>$v){
			$Data1['appid']   = $v['appid'];
			$Data1['adddate'] = time();
			$appuserrelate->doAdd($Data1,'id');
		}
		putsession('loginfo',null);
		$base = $this->cache->GetACache('setting');//读出缓存
		//注册后直接登录
		if($base['registerlogin'] == 1)
		{
			$lastlogintime = time();
			$lastloginip   = $_SERVER['REMOTE_ADDR'];
			$GLOBALS['db']->execSql("UPDATE `$usersModel->table` SET `lastlogintime`='$lastlogintime', `lastloginip`='$lastloginip', `logintimes`=logintimes+1 WHERE userid=$result");
			//把一些基本信息放入session
			$userinfo['userid']   = $result;
			$userinfo['username'] = $Data['username'];
			$userinfo['usertype'] = $Data['usertype'];
			$userinfo['wxid']     = $Data['wxid'];//网校id
			putsession('user',$userinfo);
			if($base['registerinfo']==1){
				cookie('indoor',M_URL('User','editUsers','-1'));
		        KS_INFO('注册成功',2,M_URL('User'));
			}else{
                KS_INFO('注册成功',2,M_URL());
			}
		}else{
		    KS_INFO('注册成功',2,M_URL('Login'));
		}
    }
	//QQ登录后有账号绑定
	public function checkAction(){
		$username   = ChkSQL(KS_G('post.username2'));
		$password   = ChkSQL(KS_G('post.password2'));
		$openid     = ChkSQL(KS_G('post.openid'));
		$usersModel = M('common_user');
		$user       = $usersModel->getRow("WHERE username='$username' and usertype!=0 limit 1",'password,rndpasswordc,usertype,userid,status');
		if(!$user){
			KS_INFO('绑定失败，无该账号');
		}elseif($user['status']==2){
			KS_INFO('绑定失败，该账户已被锁定');
		}elseif($user['status']==0){
			KS_INFO('绑定失败，该账户未通过审核');
		}
		$base      = $this->cache->GetACache('setting');//读出缓存
		if($user['password']==KS_MD5($password.KS_MD5($user['rndpasswordc'])))
		{
			$lastlogintime = time();
			$lastloginip = $_SERVER['REMOTE_ADDR'];
			$GLOBALS['db']->execSql("UPDATE `$usersModel->table` SET `qqbing`=1,`lastlogintime`='$lastlogintime', `lastloginip`='$lastloginip',`openid`='$openid',`logintimes`=logintimes+1 WHERE userid=$user[userid]");
			$userinfo['userid']   = $user['userid'];
			$userinfo['username'] = $user['username'];
			$userinfo['usertype'] = $user['usertype'];
			$userinfo['wxid']     = $user['wxid'];//网校id
			putsession('user',$userinfo);
			if($base['registerinfo']==1&&$user['email']=='')
			{
				cookie('indoor',M_URL('User','editUsers','-1'));
				KS_INFO('绑定成功',2,M_URL('User'));
		    }else{
				KS_INFO('绑定成功',2,M_URL());
			}
		}else{
			KS_INFO('绑定失败');
		}
    }
//   public function honbaoScanAction(){
//   	var_dump(1);exit;
//   	$getwxid = $_GET['wxid'];
//   	$access_token = getAccessToken($getwxid);
//   	$app_weixin_config = M('app_weixin_config');
//		$appid =  $app_weixin_config->getOne('appid',"where  wxid =". $getwxid);
//		$appSecret =  $app_weixin_config->getOne('appSecret',"where  wxid =". $getwxid);
//		$i = rand(3,10);
//		$title = '【课堂节】第'.$i.'个人领取的人红包最大';
//		$desc ='100元学习卡等你来撩，手快有，手慢无~';
//		$maxNum = 10;
//		$maxMoeny = 100;
//		var_dump($_SESSION);
//   	include CURR_VIEW_PATH.'h5/hongbaoScan.php';
//   }



     	public function preRedbaoAction(){
		//echo "wsrfgvef";exit;
	   $getwxid = $_GET['wxid'];
	   // var_dump($getwxid);exit;
//	  $cache = new \Core\Cache();
//	  $config   = $cache->GetH('wxconfig','wxid',$wxid,'',$wxid,true);
//
//	  $appid        =  $config["appid"];
//	  $appsecret    = $config["appsecret"];
       $getwxid = $_GET['wxid'];
     	$access_token = getAccessToken($getwxid);
     	$app_weixin_config = M('app_weixin_config');
		$appid =  $app_weixin_config->getOne('appid',"where  wxid =". $getwxid);
		$appSecret =  $app_weixin_config->getOne('appSecret',"where  wxid =". $getwxid);
	  $code = $_GET['code'];

       $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appSecret.'&code='.$code.'&grant_type=authorization_code';
		$token = json_decode(file_get_contents($token_url));
	    // var_dump($token);exit;

		if (isset($token->errcode)) {
		 echo '<h1>错误：</h1>'.$token->errcode;
		 echo '<br/><h2>错误信息：</h2>'.$token->errmsg;
		 exit;
		}
		$access_token_url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid='.$appid.'&grant_type=refresh_token&refresh_token='.$token->refresh_token;
		//转成对象
		$access_token = json_decode(file_get_contents($access_token_url));
		if (isset($access_token->errcode)) {
		 echo '<h1>错误：</h1>'.$access_token->errcode;
		 echo '<br/><h2>错误信息：</h2>'.$access_token->errmsg;
		 exit;
		}
		$user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token->access_token.'&openid='.$access_token->openid.'&lang=zh_CN'; //开源软件:phpfensi.com
		//转成对象
		$user_info = json_decode(file_get_contents($user_info_url));
       //var_dump($pointValue);exit;
		var_dump($user_info);exit;
        //$h5id = ChkClng(KS_G('get.id'));
        $h5id =3;
	    $app_h5_rule = M('app_h5_rule');
	    $values = $app_h5_rule->getRow('where h5id ='.$h5id ." and wxid = ".$this->wxid);
	   // var_dump($values);exit;
	    $H5name = $values['name'];
		$introduction=$values['introduction'];
		$setting=$values['setting'];
		$introGameVal = json_decode($introduction,TRUE);
		$setGameVal = json_decode($setting,TRUE);
		$pointValue = explode("|", $setGameVal[1]['value']);
		$moneyValue = explode("|", $setGameVal[2]['value']);
		var_dump($pointValue);exit;
        $num = count($pointValue);

		 include  CURR_VIEW_PATH . "preRedbao.php";

	}


    public function AssistantAction(){

    	  include  CURR_VIEW_PATH . "AssistLogin.php";
    }

    public function doAssistantAction(){


	    $username   = ChkSQL(KS_G('post.username'));
		$password   = ChkSQL(KS_G('post.password'));
        $usersModel = M('common_user');
		$base       = $this->cache->GetACache('setting');//读出缓存
		$user       = $usersModel->getRow("WHERE mobile='$username' and powertype!=0 and usertype =1 limit 1",'password,rndpasswordc,usertype,userid,username,status,wxid,email');
		if(!$user){$user = $usersModel->getRow("WHERE  username='$username' and mobilebing=1 and powertype!=0 and usertype=1 limit 1",'password,rndpasswordc,usertype,userid,status,wxid,mobilebing');}

		if(!$user){KS_INFO('登录失败');
	    }elseif($user['status']==2){KS_INFO('该账户已被锁定');
	    }elseif($user['status']==0){KS_INFO('该账户未通过审核');}

		if($user['password']==KS_MD5($password.KS_MD5($user['rndpasswordc']))){
			$lastlogintime = time();
			$lastloginip   = $_SERVER['REMOTE_ADDR'];
			$GLOBALS['db']->execSql("UPDATE `$usersModel->table` SET `lastlogintime`='$lastlogintime', `lastloginip`='$lastloginip', `logintimes`=logintimes+1 WHERE userid=$user[userid]");
			$userinfo['userid']   = $user['userid'];
			$userinfo['username'] = $user['username'];
			$userinfo['usertype'] = $user['usertype'];
			$userinfo['wxid']     = $user['wxid'];//网校id
			$Data['secretKey']= md5(time().rand(10000,99999).$userinfo['userid']);
			$usersModel->update($Data,'userid='.$userinfo['userid']);
			putsession('assistant',$userinfo);
			$common_domain = M('common_domain');
			$mydomain      = $common_domain->getOne('domain','where wxid='.$userinfo['wxid']);
			//域名为空，有问题，，删除所有，回去
			$url =M_URL('Assistant','Assistant',$userinfo['userid'],GP('type-1'));

			KS_INFO('',2,$url);
		}else{
			KS_INFO('登录失败');
	    }
    }
     //推广弹窗
	public function downloadAction(){
	    if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')){
		     ks_header('https://itunes.apple.com/cn/app/%E8%AF%BE%E5%A0%82%E8%A1%97%E6%95%99%E5%B8%88%E7%AB%AF/id1358204606?mt=8');
		}else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
		     ks_header('http://a.app.qq.com/o/simple.jsp?pkgname=com.kesion.kesionlive');
		}else{
		     ks_header('http://a.app.qq.com/o/simple.jsp?pkgname=com.kesion.kesionlive');
		}

	}
	//app下载页
	public function downloadviewAction(){
	   include  CURR_VIEW_PATH . "Login/downloadview.php";
	}
	//app下载页
	public function downloadview2Action(){
	   include  CURR_VIEW_PATH . "Login/downloadview2.php";
	}
}