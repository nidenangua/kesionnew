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
class RegisterController extends Controller
{
	 public  function _initialize(){
		 $this->userinfo    = User_GetUserInfo();
	 }
	 public function verifyAction(){
		$Verify            = new Core\Verify();
		$Verify ->length   = 4;
		$Verify ->fontSize = 125;
		$Verify ->useCurve = false;
        $Verify->entry();
     }
     public function verify2Action(){
		if(!isset($_SERVER['HTTP_REFERER'])||empty($_SERVER['HTTP_REFERER'])){
		     echo '黑客进攻1';exit;
	 	}elseif(!isset($_SERVER['HTTP_REFERER'])||(strstr($_SERVER['HTTP_REFERER'],PLATDOMAIN)==false && strstr($_SERVER['HTTP_REFERER'],MY_DOMAIN)==false)){
		     echo '黑客进攻2';exit;
		}
		$getsendsms = ChkSQL(KS_G('post.getsendsms'));
		$verifye    = new Core\Verify();
		if(!$verifye->check($getsendsms)){
			$GetSmsKing['result'] = 'err';
			header("Content-type: application/json");
			echo json_encode($GetSmsKing);
		}else{
			list($usec, $sec)     = explode(" ", microtime());
		    $GetSmsKing['SmsKing']= ((float)$usec + (float)$sec)*1000000;
			$GetSmsKing['result'] = 'ok';
		    putsession('GetSmsKing',$_SERVER['REMOTE_ADDR'].$GetSmsKing['SmsKing']);
		    putsession('GetSmsKingnub',1);
			header("Content-type: application/json");
			echo json_encode($GetSmsKing);
		}
     }

     /**
      * 注册接口
      */
     public function indexAction(){
//        var_dump(1);die;
         $salesman = ChkClng(KS_G('get.salesman'));
         $from = ChkSQL(KS_G('get.from','school'));
         if (is_weixin()){
             $wechat = new \Core\Wechat();
             $info = $wechat->authAction(false);   //调用通用的微信授权函数,并且机构不自动创账号，让其用绑定的方式
             $url = '/home.html#/register?unionid='.$info->unionid.'&openid='.$info->openid;
             if (!empty($salesman)) $url .= '&salesman='.$salesman;
         }else{
             $url = '/home.html#/register';
             if (!empty($salesman)) $url .= '?salesman='.$salesman;
         }
         if (strstr($url,'?')){
             $url .= '&from='.$from;
         }else{
             $url .= '?from='.$from;
         }
         ks_header($url);
     }
	 /**
	 * 保存注册机构、老师操作
	 */
	 public function doRegisterAction(){
         
	 	 $Data['isapi']         = false;                   //标注不是API注册的，是WEB注册的
	 	 $UsersModel            = M('App/UsersModel');
	 	 $UsersModel            ->doRegister($Data); 
     }
	 /**
	  * 忘记密码
	  */
	 public function getPasswordAction(){
         ks_header('/home.html#/forgetpassword');
     }
	 /**
     * 服务协议
	  */
	 public function agreementAction(){
		 include  CURR_VIEW_PATH . "home.register.agreement.php";
     }
     /**
     * 服务协议
	  */
	 public function tcAgreementAction(){
        include  CURR_VIEW_PATH . "home.register.tc.agreement.php";
    }
      /**
     * 万人名师合作协议
	  */
	 public function lecturerAction(){
        include  CURR_VIEW_PATH . "home.register.lecturer.php";
     }
    /**
     * 定价
     */
    public function pricingAction(){
        include  CURR_VIEW_PATH . "home.register.pricing.php";
    }
    /**
     * 合作
     */
    public function cooperationAction()
    {
        include  CURR_VIEW_PATH . "home.register.pricing.php";
    }
	 /**
     * do重置密码页
	  */
	 public function doPasswordAction(){
         $code                  = ChkSQL(KS_G('post.code'));
         $username              = ChkSQL(KS_G('post.username'));
         $Data['password']      = ChkSQL(KS_G('post.password'));
         $pwd_check             = ChkSQL(KS_G('post.pwd_check'));
         $openid                = ChkSQL(KS_G('post.openid'));
         $wxopenid              = ChkSQL(KS_G('post.wxopenid'));
         $wxcode                = ChkSQL(KS_G('post.wxcode'));
         if($Data['password']  != $pwd_check){if($wxcode==2){echo '{"errcode":"10001","msg":"两次密码不一致"}';exit;}KS_INFO('两次密码不一致');}
         $Data['rndpasswordc']  = rand(100000,999999);
         $base    = $this->cache->GetACache('setting');//读出缓存
         $smslog  = M('common_sms_log');
         $content = $smslog->getOne('content',"where mobile='$username' and logtype=0 and model='PassWord' and adddate>='".time()."'-10000 order by adddate desc limit 1");
         $content = preg_replace('/\D/s', '', $content);
         if($this->Sms->smsState('PassWord')){
             if($code!=$content||empty($code)){if($wxcode==2){echo '{"errcode":"10001","msg":"验证码错误"}';exit;}KS_INFO('验证码错误','2');}
         }
         $usersModel         = M('common_user');
         $Data['password']   = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));
         $usersModel->update($Data,'(username="'.$username.'" and usertype!=0) or (mobile="'.$username.'" and mobilebing=1 and usertype!=0)');
         $wxid       = $usersModel->getOne('wxid','where (username="'.$username.'" and usertype!=0) or (mobile="'.$username.'" and mobilebing=1 and usertype!=0)');
         //微信公众号重置后登陆情况
         if($wxcode==2){
             //判断OPEDNID的情况,二次判断反正用户误进入导致
             if(!empty($openid)){
                 $id = $usersModel->getOne('userid','where openid ="'.$openid.'" and usertype != 0');
                 if(!empty($id)){
                     echo '{"errcode":"10010","msg":"该微信已经绑定相关账号"}';exit;
                 }else{
                     $Datas['openid'] = KS_G('post.openid');
                     $Datas['h5token'] = KS_MD5(time().KS_G('post.openid'));
                 }
             }
             if(!empty($wxopenid)){
                 $id = $usersModel->getOne('userid','where openid ="'.$wxopenid.'" and usertype != 0');
                 if(!empty($id)){
                     echo '{"errcode":"10010","msg":"该微信已经绑定相关账号"}';exit;
                 }else{
                     $Datas['wxopenid'] = KS_G('post.wxopenid');
                     $Datas['h5token'] = KS_MD5(time().KS_G('post.wxopenid'));
                 }
             }
             $Datas['tokentime']= (time() +7200);
             $userid = $usersModel->getOne('userid','where (username="'.$username.'" and usertype!=0) or (mobile="'.$username.'" and mobilebing=1 and usertype!=0)');
             $usersModel->update($Datas,'userid='.$userid);
             $Data001['userid'] = $userid;
             $Data001['wxid']   = $wxid;
             $Data001['type']   = 0;
             $LoginModel =  M('Application/LoginModel');$LoginModel->loginlog($Data001);//登记登录用户信息

             $mydomain = 'https://store.kesion.com';
             $domains      = $this->cache->GetA('domaininfo','wxid',$wxid);
             if(empty($domains)){
                 $mydomain = 'store.kesion.com';
             }else{
                 if($domains[0]['status']==2){
                     $mydomain = $domains[0]['predomain'];
                     if(empty($domain) || $domain =='localhost'){
                         $mydomain = $domains[0]['domain'];
                     }
                 }else{
                     $mydomain = $domains[0]['domain'];
                 }
             }
             if(empty($mydomain)){
                 cookie('indoor',null); // 清空当前设定前缀的所有cookie值
                 putsession('user',null);
                 echo '{"errcode":"10009","msg":"系统异常请重试"}';exit;
             }
             echo '{"succeed":"10001","id":"'.$userid.'","token":"'.$Datas['h5token'].'","domain":"'.$mydomain.'","wxid":"'.$wxid.'"}';
         }else{
             //原本home端重置密码后的情况不变动
             header('Content-type: application/json');
             $domain=MY_FULLDOMAIN;
             echo json_encode(array('result'=>'succeed','url'=>''.$domain));

         }

     }
     //邮箱绑定界面
	 public function emailbindAction(){
	    $key               = null !==GF('key') ? GF('key'):'';
		$Data['email']     = ChkSQL(KS_S('email'));
		$userid            = ChkClng(KS_G('request.id'));
		$Data['emailbing'] = 1;
		$base              = $this->cache->GetACache('setting');//读出缓存
		$smslog            = M('common_email_log');
		$mark              = $smslog->getOne('mark',"where email='$Data[email]' and logtype=1 and model='Validate' and adddate>='".time()."'-10000 order by adddate desc limit 1");
		if($key!=$mark||empty($key)){$info = '验证码错误';}
		$usersModel        = M('common_user');
		$emailN            = $usersModel->getOne('count(*)',"where email='$Data[email]' and userid!=$userid");
		if($emailN>0){
			if($base['ebings']=='0'){
				$bemailN = $usersModel->getOne('count(*)',"where mobilebing=1 and email='$Data[email]' and userid!=$userid");
				if($bemailN>0){$info = '该手机号已被绑定,请联系客服';}
			}
		}
		$Rule['email']  = '手机号|isEmpty,isEmail';
		Chkpost($Data,$Rule,$usersModel,"userid!=$userid");
		$usersModel->update($Data,"userid=$userid");
		$info = '绑定成功';
		putsession('user',NULL);
		include  CURR_VIEW_PATH . "emailbind.php";
     }
     public function checksecondAction(){
     	$second = ChkSQL(KS_G('post.secondname'));
     	$DOMAN  =  M('common_domain');
     	$domain = $DOMAN -> getAll('where domain like "%'.$second.'%" or predomain like "%'.strtolower($second).'%"','id,wxid');
     	if($domain){
     		header('Content-Type:application/json;charset=utf-8');
     		$res['errorCode']=1001;
     		$res['msg'] = '该二级域名已存在';
		    echo json_encode($res);
     	} else{
     		header('Content-Type:application/json;charset=utf-8');
     		$res['errorCode']=1000;
		    echo json_encode($res);
     	}
     }
}