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


namespace Kesion\Model\App;
use Kesion\Model;
class UsersModel extends Model{

    /**
     * 初始化
     */
    public  function _initialize(){
        $this->wxid = $GLOBALS['_DoM']['wxid'];
		$this->userinfo       = User_GetUserInfo();
        if ($this->userinfo!=null){
            $this->userid=$this->userinfo['userid'];
        }else{
            $this->userid=0;
        }
    }
    /**
     * 注册机构或老师接口
     * @param mixed $Data007    $isApi 是否是开放的 接口注册 true 是 false 否
     * @return array
     */
    public function doRegister($Data007){
		$usersModel  = M('common_user');
		$domainModel = M('common_domain');
		$isApi = false;
		$code      = ChkClng(isset($Data007['code'])?$Data007['code']:KS_G('post.code'));    //手机验证码
        $domain    = ChkUserName(isset($Data007['domain'])?$Data007['domain']:KS_G('post.domain'));  //二级域名
        if (isset($Data007['isapi'])){
            $isApi=$Data007['isapi'];             //是否来自接口
        }

		$Data['username']      = ChkUserName(isset($Data007['username'])?$Data007['username']:KS_G('post.username'));
		$Data['mobile']        = ChkUserName(isset($Data007['username'])?$Data007['username']:KS_G('post.username'));
		$Data['usertype']      = ChkClng(isset($Data007['usertype'])?$Data007['usertype']:KS_G('post.usertype'));
        $Data['password']      = ChkSQL(isset($Data007['password'])?$Data007['password']:KS_G('post.password'));
        $sitename              = ChkSQL(isset($Data007['sitename'])?$Data007['sitename']:KS_G('post.sitename'));
 
        /*******************************************检测机构名称 begin **********************************/
        if(empty($sitename)){
            if($isApi==true){
                echo '{"result":"error","errcode":"10001","msg":"门户名称不能为空","status":"no"}';
                exit;
            }else{
                KS_Alert('门户名称不能为空','error');
            }
		}
        if (mb_strlen($sitename)>30){
            if($isApi==true){
                echo '{"result":"error","errcode":"10001","msg":"门户名称长度不能超过30","status":"no"}';
                exit;
            }else{
                KS_Alert('门户名称长度不能超过30','error');
            }
        }
        /*******************************************检测机构名称 begin **********************************/

        /*******************************************检测注册类型  begin ***********************************/
        if ($Data['usertype']!=1 && $Data['usertype']!==2){
            if($isApi==true){
                echo '{"result":"error","errcode":"10001","msg":"注册类型不合法，接口只能注册机构账号","status":"no"}';
                exit;
            }else{
                KS_Alert('注册类型不合法，只能注册机构账号','error');
            }
        }
        /*******************************************检测注册类型  begin ***********************************/

       /***************************************** 用户名检测  begin****************************************/
        if (empty($Data['username'])){
            if($isApi==true){
                echo '{"result":"error","errcode":"10001","msg":"用户名称必须输入","status":"no"}';
                exit;
            }else{
                KS_Alert('用户名称必须输入','error');
            }
        }
        if (!is_username($Data['username'])){
            if($isApi==true){
                echo '{"result":"error","errcode":"10001","msg":"用户名称不合法！","status":"no"}';
                exit;
            }else{
                KS_Alert('用户名称不合法！','error');
            }
        }
        if ($usersModel->Exists("where username='".$Data['username']."' and usertype>0")){
            if($isApi==true){
                echo '{"result":"error","errcode":"10001","msg":"账号已存在！","status":"no"}';
                exit;
            }else{
                KS_Alert('账号已存在！','error');
            }
        }
        /***************************************** 用户名检测  end****************************************/

        /******************************************手机号检测  begin**************************************/
        if (empty($Data['mobile'])){
            if($isApi==true){
                echo '{"result":"error","errcode":"10001","msg":"手机必须输入","status":"no"}';
                exit;
            }else{
                KS_Alert('手机号码必须输入','error');
            }
        }
        if (!is_mobile($Data['mobile'])){
            if($isApi==true){
                echo '{"result":"error","errcode":"10001","msg":"手机号不合法！","status":"no"}';
                exit;
            }else{
                KS_Alert('手机号不合法！','error');
            }
        }
        if ($usersModel->Exists("where mobile='".$Data['mobile']."' and usertype>0 and mobilebing=1")){
            if($isApi==true){
                echo '{"errcode":"10001","msg":"手机号已经存在！","status":"no","result":"error"}';
                exit;
            }else{
                KS_Alert('手机号码已经存在！','error');
            }
        }
        /******************************************手机号检测  end****************************************/

        /********************************************密码检测  begin**************************************/
        if(empty($Data['password'])){
            if($isApi==true){
                echo '{"result":"error","errcode":"10001","msg":"密码不能为空！","status":"no"}';
                exit;
            }else{
                KS_Alert('密码不能为空！','error');
            }
		}
        if (!is_password($Data['password'])){
            if($isApi==true){
                echo '{"result":"error","errcode":"10001","msg":"密码格式不正确！","status":"no"}';
                exit;
            }else{
                KS_Alert('密码格式不正确！','error');
            }
        }
        /********************************************密码检测  end**************************************/

        if($Data['befrom']==1||$Data['befrom']==2){  //PC或者公众号 要验证短信验证码是否正确
			$smslog  = M('common_sms_log');
			$content = $smslog->getOne('content',"where mobile='$Data[username]' and logtype=0 and model='Register' and adddate>='".time()."'-10000 order by adddate desc limit 1");
			$content = preg_replace('/\D/s', '', $content);
			if($this->Sms->smsState('Register')){
				if($code!=$content||empty($code)){
                    if($isApi==true){
                        echo '{"result":"error","errcode":"10001","msg":"短信验证码错误"}';exit;
                    }else{
                        KS_Alert('短信验证码错误！','error');
                    }
                }
			}
        }
        /**********************************检测二级域名  begin **************************************/
        if(empty($domain)){  //没有输入域名的情况，自动生成域名
			$wxid         = $domainModel->getMaxValue('wxid')+1;//生成网校id
			$domain       = rand(10000,99999).$wxid;
		}

        $DataTwo['domain']     = strtolower($domain);
        $RuleTwo['domain']  = '二级域名|isEmpty,isEnglish,isDbexis';
		if($isApi==false){
            Chkpost($DataTwo,$RuleTwo,$domainModel);
		}else{
			if(empty($DataTwo['domain'])){
				echo '{"result":"error","errcode":"10001","msg":"二级域名不能为空","status":"no"}';exit;
			}
			if(!preg_match("/^[A-Za-z0-9]+$/",$DataTwo['domain'])){
				echo '{"result":"error","errcode":"10001","msg":"二级域名必须为英文","status":"no"}';exit;
			}
		}
        if(strlen($domain)<5 || strlen($domain)>20)
        {
            if($isApi==true){
                echo '{"result":"error","errcode":"10001","msg":"二级域名5-20字","status":"no"}';
                exit;
            }else{
               KS_Alert('二级域名必须是5-20个字符之间','error');
            }
        }
        $wxnumb = $domainModel->getOne('count(id)',"where predomain='".$DataTwo['domain']."'");
        if($wxnumb>0){
            if ($isApi){
                $result['status'] = 'no';
                $result['errmsg'] = '二级域名云平台已存在';
                $result['errcode'] = '10001';
                return $result;
            }else{
                KS_Alert('二级域名云平台已存在','error');
            }
        }
		$DataTwo['domain']  = $DataTwo['domain'];

        $notAllowRegDomainArr=array(
            'www','bbs','yun','vip','dev','play','vod','live','i','cms','icms','club','imall','edu','medu','demo','course','exam','iexam',
            'shop','eshop','intro','about','xcx','nx','user','home','open','api','class','room','help','wss');
        if (in_array($DataTwo['domain'],$notAllowRegDomainArr)){
            if($isApi==false){
                    KS_Alert('二级域名【'.$DataTwo['domain'].'】为平台保留关键字，不可以使用，请重新输入','error');
            }else{
					$result['status'] = 'no';
					$result['errmsg'] = '二级域名【'.$DataTwo['domain'].'】为平台保留关键字，不可以使用，请重新输入';
					$result['errcode'] = '10001';
					return $result;
            }
        }
        /**********************************检测二级域名  end **************************************/
        $openid = ChkSQL(isset($Data007['openid'])?$Data007['openid']:KS_G('post.openid'));
        $wxopenid = ChkSQL(isset($Data007['wxopenid'])?$Data007['wxopenid']:KS_G('post.wxopenid'));
        $unionid = ChkSQL(isset($Data007['unionid'])?$Data007['openid']:KS_G('post.unionid'));
        $card_openid = ChkSQL(isset($Data007['card_openid'])?$Data007['card_openid']:KS_G('post.card_openid'));
		if($isApi==true&&(!empty($openid)||!empty($wxopenid)||!empty($unionid))){
			if(!empty($openid)) $Data['openid'] = $openid;
			if(!empty($wxopenid)) $Data['wxopenid'] = $wxopenid;
			if(!empty($unionid)) $Data['unionid'] = $unionid;
			$Data['wechatbing']     = 1;
		}
		$Data['rndpasswordc']  = rand(100000,999999);
		$Data['regdate']       = ChkClng(time());
		$Data['powertype']     = 1;
		$Data['mobilebing']    = 1;
		$Data['nickname']      = $sitename;
        if (!empty($card_openid)){
            $Data['card_openid'] = $card_openid;
        }
		$base = $this->cache->GetACache('setting');//读出缓存

		if($Data['usertype'] == '1'){
		    if($base['reviewTeacher'] == '1'){
                $Data['status'] = 0;
            }
			else{
                $Data['status'] = 1;
            }
		}elseif($Data['usertype'] == '2'){
		    if($base['reviewSchool'] == '1'){
                $Data['status'] = 0;
            }
			else{
                $Data['status'] = 1;
            }
		}

		$Data['wxid']       = $domainModel->getMaxValue('wxid')+1;//生成网校id
		if($Data['wxid']<1001)$Data['wxid']=1001;
		if($isApi==true){
            if (!empty($Data['unionid'])){
                $id = $usersModel->getOne('userid','where unionid ="'.$Data007['unionid'].'" and usertype != 0');
                if(!empty($id)){$Data['unionid'] = '';}
            }
			if(!empty($Data['openid'])){
				$id = $usersModel->getOne('userid','where openid ="'.$Data['openid'].'" and usertype != 0');
				if(!empty($id)){$Data['openid'] = '';}
			}elseif(!empty($Data['wxopenid'])){
				$id = $usersModel->getOne('userid','where wxopenid ="'.$Data['wxopenid'].'" and usertype != 0');
				if(!empty($id)){$Data['wxopenid'] = '';}
			}
            $Data['h5token']    = KS_MD5($Data['wxid'].rand(1000,10000),16);
			$Data['tokentime']  = time()+7200;
            $Data['isapi']      = 1;  //api注册
			$Data['isallow'] =1;

		}else{
            $Data['h5token']    = KS_MD5($Data['wxid'].rand(1000,10000),16);
			$Data['tokentime']  = time()+7200;
        }
		$Data['password']   = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));

		if (isset($_SESSION['fxuserid'])) {
			$Data['inviter'] = $_SESSION['fxuserid'];
		}
		/*****************判断是否unionid是否有，有的情况 清空之前的 保存现在的********************/
		if (isset($_SESSION['wxuser'])&&isset(getsession('wxuser')->unionid)&&isset(getsession('wxuser')->openid)) {
			$userids  = $usersModel->getAll('where unionid="'.getsession('wxuser')->unionid.'" and (usertype=1 or usertype=2)');
			foreach ($userids as $k => $v) {
				$Data1012['wechatbing'] = 0;
				$usersModel->update($Data1012,'userid='.$v['userid']);
			}
			$Data['unionid'] = getsession('wxuser')->unionid;
			$Data['openid']  = getsession('wxuser')->openid;
			$Data['wechatbing']  = 1;
		}
		/*****************结束***********************************************************************/
		$result    = $usersModel->doAdd($Data,'userid');
        User_GetUser($result,true);//缓存
		/*****************检查session【fxuserid】判断是否某个用户邀请注册的********************/
		if (isset($_SESSION['fxuserid'])) {
			//然后给邀请人对应的奖励 function待更新
			$Data101['userid'] = $Data['inviter'];
			$Data101['taskid'] =1;
			$Data101['inviteeid'] =$result;
			$Data101['wxname'] = $sitename;
			spreadproof($Data101);
		}
		/*************************************/
		$tempModel = M('common_temp');
		$isdefault = $tempModel->getAll(' where isdefault = 1');
		foreach($isdefault as $k=>$v){
			if($v['temptype']==0){$DataTwo['tempPid']=$v['tempid'];}
			elseif($v['temptype']==1){
				$DataTwo['tempMid'] = $v['tempid'];

			}
			elseif($v['temptype']==2){$DataTwo['tempPxt']=$v['tempid'];}
			elseif($v['temptype']==3){$DataTwo['tempMxt']=$v['tempid'];}
		}
		$DataTwo['userid']  = $result;//绑定二级域名
		$DataTwo['wxid']    = $Data['wxid'];//网校id
		$DataTwo['adddate'] = time();//注册时间
		$uploadtableModel   = M('common_extends_table');
		$DataTwo['uploadtableid'] = $uploadtableModel->getOne('tableid','where Isdefault=1 and type =4');
		$domainModel->doAdd($DataTwo,"id");
		$this->cache->putACache('domaininfo');//写入缓存
		if($Data['usertype'] == '1'){   //插入第二张表老师
			$Datas['name']   = $sitename;
			$Datas['userid'] = $result;
			$user_teacher    = M('common_user_teacher');
			$user_teacher->delete("userid=$Datas[userid]");
			$user_teacher->doEfAdd($Datas);
		}else{                        //插入第二张表机构
			$Datas['name']   = $sitename;
			$Datas['userid'] = $result;
			$user_school = M('common_user_school');
			$user_school->delete("userid=$Datas[userid]");
			$user_school->doEfAdd($Datas);
		}

		/*****************************************插入userwebsite begin********************************************/
		$websiteModel   = M('App/WebsiteModel/common_user_website');
		$websitenum     = $websiteModel->getOne('count(wxid)','where wxid='.$Data['wxid']);//读出缓存
		if(empty($websitenum)){
            if (ChkClng(KS_G('post.salesman'))){
                $Data001['salesman'] = ChkClng(KS_G('post.salesman'));
            }
            if (empty($Data001['salesman'])&&!empty($Data007['salesman'])){
                $Data001['salesman'] = $Data007['salesman'];
            }
            $Data001['salesmantype'] = 1;
            if (!empty($Data001['salesman'])) $Data001['salesmantype'] = 1;
			$Data001['wxid']          = $Data['wxid'];
			$Data001['userid']        = $result;
			$Data001['package']       = "v0"; //新注册通用版
			$Data001['packstartime']  = time();
			if($isApi==true){$Data001['status']=3;}//手机注册微门户
			$Data001['packendtime']   = strtotime("+1 year");
			$Data001["sharetitle"]    = $Data001["wititle"] = $Data001["sitename"] = ChkSQL($sitename);
			$Data001["sharedesc"]     = $Data001["sharetitle"].',超20万大咖在此共享知识';
			$Data001["signsms"]       = '【V名师】';
            $Data001['befrom']        = ChkClng(isset($Data007['befrom'])?$Data007['befrom']:KS_G('post.befrom'));//注册来源1，PC，2公众号，3V名师

            $websiteModel->websiteAdd($Data001);
		    $this->cache->PutHCache('website',$Data['wxid']);//写入缓存
		}
		/*****************************************插入userwebsite end********************************************/

        /***********************************************新注册会员，网站初始化的信息进入数据库 begin**********************/
        if($isApi){
        	$Data010['sitename']  = $sitename;
		}
        $Data010['wxid']                 = $Data['wxid'];
		$Data010['userid']               = $Data001['userid'];
		$Data010['logo']                 = '/Public/admin/images/login/logo.png';
		$Data010['userinfo']['usertype'] = $Data['usertype'];
		$IndexModel  = M('Application/IndexModel');
		$IndexModel  ->initialStoreData($Data010);
        /***********************************************新注册会员，网站初始化的信息进入数据库 end**********************/
        if($Data001['befrom']==1){
//            header("Content-type: application/json");
            echo '{"result":"success","status":"ok","url":"'.wx_Url($Data['wxid']).'/home.html?managetoken='.KS_MD5($Data['h5token'],32).'"}';
            exit;
        }else{
            echo '{"result":"success","succeed":"10001","msg":"注册成功","url":"'.wx_Url($Data['wxid']).'/h5market/wechatlogin?go=store&token='.$Data['h5token'].'"}';
            exit;
        }
//        if($isApi){
//        	$live_secret              = M('app_live_secret');
//        	$Datasecret['wxid']       = $Data['wxid'];
//        	$Datasecret['appid']      = KS_MD5($Data['wxid'].rand(1000,10000),16);
//        	$Datasecret['appsecret']  = KS_MD5($Data['wxid'].rand(1000,10000),32);
//        	$Datasecret['isenable']   = 1;
//        	$live_secret->doAdd($Datasecret,'id');
//        	$Datasecret['status']     = 'ok';
//        	return $Datasecret;
//		}else{

//		}
	}


    /**
     * 通过公众号或小程序注册学员
     * @param mixed $userInfo
     * @param mixed $wxid
     * @param mixed $fromtype  wechat公众号 applet小程序
     */
    public function doWechatRegMember($userInfo,$wxid,$fromtype='wechat'){
        $UserMode = M('common_user');
        $param='';
        if ($userInfo->unionid){
            $param="unionid='".$userInfo->unionid."'";
        }else{
            $param="openid='".$userInfo->openid."'";
        }
        $cache = new \Core\Cache();//缓存类


        $user = $UserMode->getRow('where '.$param.' and wxid='.$wxid.' and usertype=0 order by lastlogintime desc limit 1');
        if (!empty($user)){
            /********************************把一些基本信息放入session   begin *************************************/
            $userinfo['userid']   = $user['userid'];
            $userinfo['username'] = $user['username'];
            $userinfo['usertype'] = $user['usertype'];
            $userinfo['openid']   = $user['openid'];
            $userinfo['wxid']     = $user['wxid'];//网校id
            putsession('member',$userinfo);

            if ($fromtype=='applet'){ //小程序,更新token
                unset($Data);
;               $Data['applet_token']  = KS_MD5(time().$userInfo->openid);
                $Data['applet_tokentime']= (time() +7200);
                $UserMode->update($Data,'userid='.$user['userid']);
                return $Data['applet_token'];  //返回小程序登录token
            }

            /********************************把一些基本信息放入session   end *************************************/

        }else{             //用户首次访问
            $Data['username']      = getRegisterUsername();  //生成网校id
            $Data['mobile']        = '';
            $Data['mobilebing']    = 0;
            $Data['wechatbing']    = 1;
            $Data['usertype']      = 0;
            $Data['unionid']       = $userInfo->unionid;
            $Data['openid']        = $userInfo->openid;
            $Data['inviter']       = $userInfo->inviter;
            $Data['nickname']      = $userInfo->nickname;
            $Data['password']      = '123456';
            $Data['rndpasswordc']  = rand(100000,999999);
            $Data['regdate']       = ChkClng(time());
            $Data['wxid']          = $wxid;
            $Data['lastlogintime'] = time();
            $Data['status']   = 1;

            $Data['h5token']  = KS_MD5(time().$userInfo->openid);
            $Data['tokentime']= (time() +7200);

            if ($fromtype=='wechat'){  //公众号

            }else{ //小程序
                $Data['applet_token']  = KS_MD5(time().$userInfo->openid);
                $Data['applet_tokentime']= (time() +7200);
                $Data['befrom'] = 3;
            }
            $info             = $cache->GetHCache('website',$wxid);//读出缓存
            $Data['parentid'] = $UserMode->getOne('userid','where parentid=0 and wxid = '.$wxid);
            $Data['password'] = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));
            $userid           = $UserMode->doAdd($Data,'userid');

            /********************************把一些基本信息放入session   begin *************************************/
            $userinfo['userid']   = $userid;
            $userinfo['username'] = $Data['username'] ;
            $userinfo['usertype'] = $Data['usertype'];
            $userinfo['openid']   = $Data['openid'];
            $userinfo['wxid']     = $Data['wxid'];//网校id
            putsession('member',$userinfo);                            //把一些基本信息放入session
            /********************************把一些基本信息放入session   end *************************************/


            //插入第二张表
            $Datas['userid']  = $userid;
            $Datas['name']    = $userInfo->nickname;
            $Datas['Sex']     = $userInfo->sex;
            $Datas['address'] = $userInfo->country.$userInfo->province.$userInfo->city;
            $Datas['head']    = $userInfo->headimgurl;

            $user_school      = M('common_user_member');
            $user_school->delete("userid=$Datas[userid]");
            $user_school->doEfAdd($Datas);

            $Dotask  = new \Core\Dotask();
            $Dotask->checkTask($wxid,9);//检查是否完成任务
            $cache->PutHCache('users',$wxid);
            $cache->PutHCache('user',$wxid);


            if ($fromtype=='applet'){ //小程序,返回token
                return $Data['applet_token'];  //返回小程序登录token
            }

        }


    }



    /**
     * 取得用户的已购列表
     * @param mixed $getType        course 课程  column 专栏  team 社群
     * @param mixed $maxPerPage   每页显示条数
     * @param mixed $currPage     当前页码
     * @return array
     */
    public function getMyPurchase($getType,$maxPerPage,$currPage){

        if (empty($getType)) $getType='course';

        $where = 'where paystatus=1 and status !=-1';

        $h5token = ChkSQL(KS_S('request.h5token'));   //公众号菜单授权进来的，我的已购
        if ($h5token==''){         //非官网公众号菜单的我的已购进入，取当前用户ID
            if($this->userid<=0){
                $result2['msg'] = '没登录';
                $result2['result'] = 'error';
                return $result2;
            }else{
                $where.=' and memberid='.$this->userid;   //当前用户的已购
            }
        }else{
            $UserMode      = M('common_user');   //会员表
            $where       .=" and memberid in(select userid From $UserMode->table where h5token='".$h5token."' and tokentime>".time().")";
        }

        //支付类型    0是课程 1是直播 2充值 3试卷打赏 4 （图文 点播 语音 音频)的赞赏 6是直播收益  5购买试卷 7专栏购买 8 专栏打赏 9用户会员购买 10加入社群
        //3,4,6,8 打赏
        switch($getType)
        {
            case "course":
                $where.=' and type in(0,1)'; //课程
                break;
            case "column":
                $where.=' and type=7';     //专栏
                break;
            case "team":
                $where.=' and type=10';    //社群
                break;
        }


//        KSLog('where='.$where);

        $app_order             = M('app_order_info');
		$options['now_page']   = $currPage;
		$options               = $app_order ->getOptions($maxPerPage,$where);//分页参数设置
		$page                  = Page($options);
        $allorder              = $app_order ->getPage($page,'adddate desc',$where,'*');


        $array = array();
        foreach ($allorder as $k => $v) {
            if ($v['courseid']>0){
                if($v['type'] == 0 || $v['type']==1){       //点播、图文、音频、直播等
                    $Db2 = M('app_course');
                    $info = $Db2->getRow('where courseid='.$v['courseid'].' and status !=-1');
                    if ($info){
                        $info['defaultpic'] = !empty($info['defaultpic'])?Img($info['defaultpic']):nopic(12);
                        $info['coursetype'] = $info['courseType'];
                        if($info['coursehour']==1){
                            $info['hourcount'] = M($info['chaptertable'])->getOne('count(chapterid)','where depth=3 and courseid='.$info['courseid'].' and status!=-1');
                        }else{
                            $info['hourcount'] = 1;
                        }
                    }
                }elseif($v['type'] == 7){   //专栏
                    $Db2 = M('app_column');
                    $info = $Db2->getRow('where columnid='.$v['courseid'].' and status !=-1');
                    if ($info){
                        $info['defaultpic'] = !empty($info['defaultpic'])?Img($info['defaultpic']):nopic(12);
                    }
                }
                elseif($v['type'] == 10){   //社群
                    $Db2 = M('app_team');
                    $info = $Db2->getRow('where id='.$v['courseid'].' and status !=-1');
                    if ($info){
                        $info['defaultpic'] = !empty($info['defaultpic'])?Img($info['defaultpic']):nopic(12);
                    }
                }

            }

            if ($info){
                /**店铺信息 begin*/
                $info['type']=$v['type'];
                $info['storeinfo']=wx_GetStoreInfo($info['wxid']);
                /**店铺信息 end*/
               $array[] =  $info;
            }

        }


        $result['result']='success';
        $result['values'] = $array;
        $result['page'] = $page;

        return $result;
    }
    /**
     * 获取用户的订单列表
     * @param mixed $maxPerPage  每页记录数
     * @param mixed $currPage    页码
     * @return array
     */
    public function getOrderList($maxPerPage,$currPage){
        $ispj              = ChkClng(KS_G('request.ispj'));
        $paystatus         = ChkClng(KS_G('request.paystatus'));
        $orderstatus         = ChkClng(KS_G('request.orderstatus'));
        $extuserid         = ChkClng(KS_G('request.extuserid'));

		$tt                = '';
        $tttt = '';
		if($ispj == 1){$tt .= '  and a.ispj = 1';}elseif($ispj == 2){$tt .= '  and a.ispj = 0';}
        if($paystatus == 1){
            $tt .= '  and paystatus = 1';
            $tttt .= '  and orderstatus = 0';
		}elseif($paystatus == 2){
            $tt .= '  and paystatus = 0';
		}
        //订单状态(0：待发货 1：待收货 2：确认收货)
        $ttt                = '';
        $ext = '';
        if($orderstatus == 1){
            $ttt .= '  and orderstatus = 1';
        }elseif ($orderstatus == 2){
            $ttt .= '  and orderstatus = 2';
        }elseif($orderstatus == 3){
            $ttt .= '  and orderstatus = 0 and type in (14,15)';
            $tt .= '  and paystatus = 1';
        }

        if (!empty($extuserid)){//筛选子账号订单
            $commom_user = M('common_user');
            $ext_data = $commom_user->getAll('where inviter = '.$extuserid.'','userid');
            if (!empty($ext_data)){
                foreach ($ext_data as $val) {
                    $val = join(",",$val);
                    $temp_array[] = $val;
                }
                $ext_data = implode(",", $temp_array);
            }else{
                $ext_data = '-1';
            }
            $ext .= '  and memberid in('.$ext_data.')';
        }
        $h5token = ChkSQL(KS_S('request.h5token'));   //公众号菜单授权进来的，我的订单
        if ($h5token==''){         //非官网公众号菜单的我的已购进入，取当前用户ID
            if($this->userid<=0){
                $result2['msg'] = '没登录';
                $result2['result'] = 'error';
                return $result2;
            }else{
                if ($this->userinfo['usertype'] == 0){
                    $where         = 'where memberid = '.$this->userid .' and wxid = '.$this->wxid.' and status !=-1 '.$tt;
                }else{ //订单管理
                    $where         = 'where wxid = '.$this->wxid.' and status !=-1 '.$tt;
                }
            }
        }else{
            $UserMode      = M('common_user');   //会员表
            if ($this->userinfo['usertype'] == 1 || $this->userinfo['usertype'] == 2){//订单管理
                $where         = " where status!=-1 and wxid in(select wxid From $UserMode->table where h5token='".$h5token."' and tokentime>".time().")".$tt;
            }else{
                $where         = " where status!=-1 and memberid in(select userid From $UserMode->table where h5token='".$h5token."' and tokentime>".time().")".$tt;
            }
        }
		$app_order             = M('app_order');
		$app_order_info        = M('app_order_info');

		$options['now_page']   = $currPage;
		$options               = $app_order ->getOptions($maxPerPage,$where.$ttt.$tttt.$ext);//分页参数设置
		$page                  = Page($options);
        $allorder              = $app_order ->getPage($page,'adddate desc',$where.$ttt.$tttt.$ext,'*');
        $detailorder           = array();
		foreach($allorder as $k=>$v){
			$values = array();
		    $values = $app_order_info->getAll('where orderid='.$v['orderid'].' and status!=-1 '.$tt,' adddate,numb,defaultpic,courseid,title,price,paystatus,ispj,type,groupid,json');
		    $all_num = 0;
		    foreach($values as $kt=>$vt){
		        //教辅json
                if ($vt['type']==14 || $vt['type']==15){
                    $order_json = json_decode($vt['json'],true);
                    if (empty($order_json)){
                        $values[$kt]['json'] = [];
                    }
                    $values[$kt]['json'] = $order_json;
                    $values[$kt]['numb'] = $vt['numb'];
                    $all_num = $all_num+$vt['numb'];
                }

                $values[$kt]['buytype']=getStoreOrderType($vt['type']);
                $values[$kt]['defaultpic'] = Img($vt['defaultpic']);
                if(empty($values[$kt]['defaultpic'])){
                    $values[$kt]['defaultpic'] = 'http://store.kesion.com/Public/uploads/common/timg.jpg';
                }
                if($vt['type'] == 0 ||$vt['type'] == 1){        //课程 ，图文、点播、音频、直播
                    $courseModel =M('app_course');
                    $detailorder[$k]['appid'] = 6;
                    $courseinfo  = $courseModel->getRow('where courseid='.$vt['courseid']);
                    $values[$kt]['coursetype'] = $courseinfo['courseType'];
                    $values[$kt]['price_market'] = $courseinfo['price'];
                    if(empty($courseinfo['teacherid'])){
                        $courseinfo['teacherid'] = 0;
                    }
                    $name = M('common_user_teacher')->getOne('name','where userid='.$courseinfo['teacherid']);
                    if($name){
                        $values[$kt]['name'] = $name;
                    }else{
                        $values[$kt]['name'] = '暂无';
                    }
                }elseif($vt['type'] == 5){    //考试
                    $parperModel =M('app_paper');
                    $classinfo  = $parperModel->getRow('where paperid='.$vt['courseid']);
                    $values[$kt]['price_market'] = $classinfo['price'];
                }elseif($vt['type'] == 7){    //专栏
                    $columnModel =M('app_column');
                    $info  = $columnModel->getRow('where columnid='.$vt['courseid']);
                    $values[$kt]['price_market'] = $info['price'];
                    $values[$kt]['defaultpic'] = !empty($info['defaultpic'])?Img($info['defaultpic']):nopic(12);
                }elseif($vt['type'] == 10){    //社群
                    $teamModel = M('app_team');
                    $info = $teamModel->getRow('where id='.$vt['courseid']);

                    if ($info){
                        $values[$kt]['defaultpic'] = !empty($info['defaultpic'])?Img($info['defaultpic']):nopic(12);
                    }
                    $values[$kt]['price_market'] = $info['price'];

                }

            }
		    $detailorder[$k]['payurl'] = MY_FULLDOMAIN.'/Plus/pay.php?wxid='.$this->wxid.'&ordersn='.$v['ordersn'];   //一定要跳到平台域名下支付
		    $detailorder[$k]['qrcode'] = 'https://'.UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',$detailorder[$k]['payurl'],'L',4,'weimenhu');
            if(!empty($v['groupid']) && $v['paystatus'] == 1){
                $app_h5_rulereward = M('app_h5_rulereward');
                $h5id = $app_h5_rulereward->getOne('h5id','where wxid='.$this->wxid.' and groupid="'.$v['groupid'].'"');
                if(!$h5id){
					$h5id = 0;
                }
                $detailorder[$k]['lookurl'] = M_URL('h5market','collage').'?h5id='.$h5id.'&groupid='.$v['groupid'];
                $successful = $app_h5_rulereward->getOne('successful','where wxid='.$this->wxid.' and groupid="'.$v['groupid'].'"');
                if($successful){
                    $detailorder[$k]['successful'] =$successful;
                }else{
                    $h5_rule = M('app_h5_rule');
                    $h5info = $h5_rule->getRow('where wxid='.$this->wxid.' and id='.$h5id.' and isstar!=-1');
                    if($h5info){
                        $h5info['setting'] = unserialize($h5info['setting']);
                        if($h5info['isstar']==1){
                            if($h5info['setting']['timexz']==24){
								$h5info['setting']['endtime'] = M('app_h5_rulereward')->getOne('addtime','where h5id='.$h5id.' and groupid="'.$v['groupid'].'"')+86400;
                            }else{
                                $h5info['setting']['endtime'] = M('app_h5_rulereward')->getOne('addtime','where h5id='.$h5id.' and groupid="'.$v['groupid'].'"')+86400+86400;
                            }
                            if($h5info['setting']['endtime']<time()){//没成功，活动没关，拼团时间到了，
                                $detailorder[$k]['successful'] =0;
                            }else{
                                $detailorder[$k]['successful'] =2;
                            }
                        }else{
                            $detailorder[$k]['successful'] =0;
                        }
                    }else{
                        $detailorder[$k]['successful'] =0;
                    }
                }

            }
	 	   $detailorder[$k]["ordersn"] = $v['ordersn'];
	 	   $detailorder[$k]["orderid"] = $v['orderid'];
	 	   if(isset($values[0])){$detailorder[$k]['type'] = $values[0]['type'];}
	 	   if(isset($values[0])){$detailorder[$k]["ispj"] =  $values[0]['ispj'];}
	 	   $detailorder[$k]["paystatus"] = $v['paystatus'];
	 	   //教辅订单状态和价格、运费
	 	   $detailorder[$k]["orderstatus"] = $v['orderstatus'];
	 	   $detailorder[$k]["order_amount"] = $v['order_amount'];
	 	   $detailorder[$k]["original_amount"] = $v['original_amount'];
	 	   $detailorder[$k]["discount"] = $v['discount'];
	 	   if ($v['type']==14 || $v['type'] == 15){
               $mall_json = json_decode($v['json'],true);
               $detailorder[$k]["freight"] = $mall_json['address_info']['freight'];
               $detailorder[$k]["all_num"] = $all_num;
           }

           $detailorder[$k]['adddate']   = KS_DATE($v['adddate']);
	 	   $detailorder[$k]["paydate"] = KS_DATE($v['paydate']);
	 	   $detailorder[$k]["courseOrder"] =  $values;

            /**店铺信息 begin*/
            $detailorder[$k]['storeinfo']=wx_GetStoreInfo($v['wxid']);
            /**店铺信息 end*/

	 	   if($v['paystatus'] == 0){
                if($v['type'] == 0){
                    $detailorder[$k]['url'] = M_URL('course','confirm','',GP('ordersn-'.$v['ordersn']));
                }elseif($v['type'] == 1){
                    $detailorder[$k]['url'] = M_URL('class','confirm','',GP('ordersn-'.$v['ordersn']));
                }elseif($v['type'] == 2){
                    $detailorder[$k]['url'] = M_URL('course','rechargemoneyM',$v['orderid'].'&type=1',GF(''));
                }
            }
	    }
	    if(ChkClng(KS_G('request.p')) > (int)($page->total_pages)){
			$result['values']            = '';
		}else{
			$result['values']            = $detailorder;
		}
	    $result['page'] = $page;
		return $result;
    }
    /**
     * 取得订单详情
     * @return array
     */
    public function getOrderDetail(){
		$ordersn = ChkSQL(KS_S('request.ordersn'));
        if (empty($ordersn)){
            $result['result']='error';
            $result['msg']='订单编号有误！';
            return $result;
        }

		$Db =  M('app_order');
		$Db2 = M('app_order_info');

        $h5token = ChkSQL(KS_S('request.h5token'));   //公众号菜单授权进来的，我的订单
        $UserMode      = M('common_user');   //会员表
        if ($h5token==''){         //非官网公众号菜单的我的已购进入，取当前用户ID
            if($this->userid<=0){
                $result2['msg'] = '没登录';
                $result2['result'] = 'error';
                return $result2;
            }else{
                if ($this->userinfo['usertype'] == 1 || $this->userinfo['usertype'] == 2){//机构端
                    $param         = ' ';
                }else{
                    $param         = ' and memberid = '.$this->userid;
                }

            }
        }else{
            if ($this->userinfo['usertype'] == 1 || $this->userinfo['usertype'] == 2){
                $param = ' ';
            }else{
                $param         = " and memberid in(select userid From $UserMode->table where h5token='".$h5token."' and tokentime>".time().")";
            }
        }


		$values= $Db2->getALL("where ordersn='".$ordersn."' ".$param);   //子表信息
		$info =  $Db->getRow("where ordersn='".$ordersn."' ".$param);    //订单信息
        $inviter = $UserMode->getOne('inviter','where userid = '.$info['userid'].'');
        $info['name'] = User_GetUser($info['userid'])['name'];
        $info['username'] = User_GetUser($info['userid'])['username'];
        if (!empty($inviter)){
            $username = $UserMode->getOne('username',"where userid='$inviter'");
            $info['order_source'] = empty($username)?'无':$username;
        }else{
            $info['order_source'] = '无';
        }
        //教辅json信息
        if ($info['type'] == 15 || $info['type'] == 14 && !empty($info['json'])){
            $info['json'] = json_decode($info['json'],true);
        }
		foreach ($values as $k => $v) {
			$values[$k]['successful'] = 0;
			$values[$k]['payurl'] = M_URL('h5market','inh5game').'?wxid='.$this->wxid.'&ordersn='.$v['ordersn'];
			$values[$k]["adddate"] = KS_DATE($v['adddate']);
            if(!empty($v['groupid']) && $v['paystatus'] == 1){
                $app_h5_rulereward = M('app_h5_rulereward');
                $h5id = $app_h5_rulereward->getOne('h5id','where wxid='.$this->wxid.' and groupid="'.$v['groupid'].'"');
                $values[$k]['lookurl'] = M_URL('h5market','collage').'?h5id='.$h5id.'&groupid='.$v['groupid'];
                $successful = $app_h5_rulereward->getOne('successful','where wxid='.$this->wxid.' and groupid="'.$v['groupid'].'"');
                if($successful){
                    $values[$k]['successful'] =$successful;
                }else{
                    $values[$k]['successful'] =0;
                }
            }
            //教辅订单json
            if ($v['type'] == 15 || $v['type'] == 14){
                $values[$k]['json'] = empty(json_decode($v['json'],true))? [] :json_decode($v['json'],true);
            }

            if($v['type'] == 0 ||$v['type'] == 1 || $v['type']==4){     //课程 ： 图文、点播、音频、直播
                $courseModel =M('app_course');
                $courseinfo  = $courseModel->getRow('where courseid='.$v['courseid']);
                $values[$k]['coursetype'] = $courseinfo['courseType'];
                if($courseinfo['defaultpic']){
                    $values[$k]['defaultpic'] =Img($courseinfo['defaultpic']);
                }else{
                    $values[$k]['defaultpic'] =nopic(12);
                }
            }elseif($v['type'] == 5){    //试卷
                $parperModel =M('app_paper');
                $classinfo  = $parperModel->getRow('where paperid='.$v['courseid']);
                if($classinfo['defaultpic']){
                    $values[$k]['defaultpic'] = Img($classinfo['defaultpic']);
                }else{
                    $values[$k]['defaultpic'] =nopic(12);
                }
            }elseif($v['type'] == 7){   //专栏
                $columnModel =M('app_column');
                $classinfo  = $columnModel->getRow('where columnid='.$v['courseid']);
                if($classinfo['defaultpic']){
                    $values[$k]['defaultpic'] = Img($classinfo['defaultpic']);
                }else{
                    $values[$k]['defaultpic'] =nopic(12);
                }
            }elseif($v['type'] == 9){   //会员卡
                $columnModel =M('common_user_group');
                $classinfo  = $columnModel->getRow('where id='.$v['courseid']);
                if($classinfo['defaultpic']){
                    $values[$k]['defaultpic'] = Img($classinfo['defaultpic']);
                }else{
                    $values[$k]['defaultpic'] =nopic(12);
                }
            }
            elseif($v['type'] == 10){   //社群
                $teamModel = M('app_team');
                $teamrow = $teamModel->getRow('where id='.$v['courseid'].' and status !=-1');
                if ($teamrow){
                    $values[$k]['defaultpic'] = !empty($teamrow['defaultpic'])?Img($teamrow['defaultpic']):nopic(12);
                }
            }

		}

		$info['adddate']  = KS_DATE($info['adddate']);

        $result['result'] = 'success';
        /**店铺信息 begin*/
        $result['storeinfo']=wx_GetStoreInfo($info['wxid']);
        /**店铺信息 end*/
		$result['info']   = $info;
		$result['values'] = $values;
		return $result;
    }
    /**
     * 删除订单
     * @return string[]
     */
    public function delOrder(){

        $h5token = ChkSQL(KS_S('request.h5token'));   //公众号菜单授权进来的，我的订单
        if ($h5token==''){         //非官网公众号菜单的我的已购进入，取当前用户ID
            if($this->userid<=0){
                $result2['msg'] = '没登录';
                $result2['result'] = 'error';
                return $result2;
            }else{
                if ($this->userinfo['usertype'] == 1 || $this->userinfo['usertype'] == 2){
                    $param         = ' ';
                }else{
                    $param         = ' and memberid ='.$this->userid;
                }
            }
        }else{
            if ($this->userinfo['usertype'] == 1 || $this->userinfo['usertype'] == 2){
                $param         = ' ';
            }else{
                $UserMode      = M('common_user');   //会员表
                $param         = " and memberid in(select userid From $UserMode->table where h5token='".$h5token."' and tokentime>".time().")";
            }
        }

    	$ordersn   = ChkSQL(KS_G('request.ordersn'));
    	$data['status'] = '-1';
    	$AppModel  = M('app_order');
		$AppModels = M('app_order_info');
		$vid = $AppModel->getOne('voucherid',"where ordersn='".$ordersn."' ".$param);
		if(!empty($vid)){
			$Mode = M('app_voucher');
			$datass['isuse'] = 0;
			$Mode->update($datass,'id='.$vid);
		}
		$AppModel->update($data,"ordersn='".$ordersn."' ".$param);
		$AppModels->update($data,"ordersn='".$ordersn."' ".$param);

        $result['result']='success';
        $result['msg']='删除成功';
		return $result;
    }






	/**
     * 进行添加用户的界面(课程页面里的添加学员或教师）
     * @param mixed $Data002
     */
	public function addUser($Data002){
		$courseid = ChkClng(KS_G('get.id'));
		$userinfo = array();
		$usertype = KS_S('usertype',0);
		if($usertype==0){
			include  VIEW_PATH.'transact'.DS.'home.' . "addUserStudent.php";
		}else{
			if(isset($Data002['action'])&&$Data002['action']=='edit'){
			    $userid = null !==GF('userid') ? GF('userid'):0;
				$userModel       = M('common_user');
				$this->wxid      = $Data002['wxid'];
			    $this->AppModel  = M('common_user_teacher');
			    $userinfo = $userModel->getRow("as a left join `".$this->AppModel->table."` as b on a.userid = b.userid WHERE a.userid=$userid limit 1");
			}
		    include  VIEW_PATH.'transact'.DS.'home.' . "addUserTeacher.php";
		}
	}



	/**进行用户的添加的保存
	 * Summary of doaddUsers
     * @param mixed $Data001    *--type:1学生管理的添加
     *  type:2报班添加学员
	 */
	public function doaddUsers($Data001){
		if(isset($Data001['usertype'])){
			$usertype         = $Data001['usertype'];
		}else{
			$usertype         = ChkClng(KS_S('usertype','0'));
		}
		//插入第一张表
        $Data['groupid']  = ChkClng(KS_S('groupid'));

        $Data['indate']  = strtotime(ChkSQL(KS_S('indate')))  ;
        $Data['is_period']  = ChkClng(KS_S('is_period'));
		$Data['username']     = ChkSQL(KS_G('post.username'));
        if (mb_strlen($Data['username'])>20 || mb_strlen($Data['username'])<4){
            KS_Alert('用户名长度不符合,长度限制4-20个字符!','error');
        }
        if (is_mobile($Data['username'])) KS_Alert('用户名不可使用手机号码!','error');
		$Data['password']     = ChkSQL(KS_G('post.password'));
		$Data['rndpasswordc'] = rand(100000,999999);
		$Data['email']        = ChkSQL(KS_G('post.email'));
        $Data['status']       = ChkClng(KS_G('post.status'));
		$Data['regdate']      = ChkClng(time());
		$Data['usertype']     = ChkClng($usertype);
		$Data['powertype']    = ChkClng(KS_G('post.powertype'));
		$Data['wxid']         = $Data001['wxid'];
		$Data['parentid']     = $Data001['userid'];
		$Data['inviter']     = $Data001['userid'];  //子账号添加
		$Rule['password']     = '密码|isEmpty,isPassword';
//		if(!isset($Data001['type']))$Rule['email']        = '邮箱|isEmpty,isEmail';
		$this->userModel = M('common_user');
		if($usertype == 0){
            $count = $this->userModel->getOne('count(*)','where usertype=0 and wxid='.$Data001['wxid']);
            $num =wx_version_itemvalue(23,$Data001['wxid']);  //允许添加的学生人数
            if ($count>=$num){
                if(isset($Data001['type'])&&$Data001['type']==1){
                    $str = "添加失败。当前套餐允许添加".$num."位学员,请升级套餐。网校已有学员".$count."位";
                    echo '<script>alert('.$str.');</script>';exit;
                }
                KS_Alert('添加失败。当前套餐允许添加'.$num.'位学员,请升级套餐。网校已有学员'.$count.'位','error');
            }

            $Data['mobile']       = ChkSQL(KS_G('post.mobile'));
            $Data['mobilebing']   = 0;
            $Rule['username']     = '学员账号|isEmpty,isDbexis';
            //if(isset($Data001['type'])&&$Data001['type']==1){
			if(empty($Data['password'])){echo "<script>alert('密码不能为空');history.go(-1)</script>";exit;}
			if(empty($Data['username'])){echo "<script>alert('用户名不能为空');history.go(-1)</script>";exit;}
			$count = $this->userModel->getOne('count(*)','where usertype=0 and wxid='.$Data001['wxid'].' and username="'.$Data['username'].'"');
			if($count>0){echo "<script>alert('用户名已注册');history.go(-1)</script>";exit;}
            //}else{
            //    $Data['username']     = ((int)$this->userModel->getMaxValue('username','usertype=0 and (username REGEXP "^[0-9]+$")'))+1;//生成网校id
            //    Chkpost($Data,$Rule,$this->userModel);
            //}
            //Chkpost($Data,$Rule,$this->userModel,'usertype=0 and wxid='.$Data001['wxid']);
		}elseif($usertype == 1){
            $count = $this->userModel->getOne('count(*)','where (usertype=1 or usertype=2) and wxid='.$Data001['wxid']);
            $num =wx_version_itemvalue(22,$Data001['wxid']);  //允许添加的老师人数
            if($count>=$num){
                if(isset($Data001['type'])&&$Data001['type']==1){
                    $str = "添加失败。当前套餐允许添加".$num."位老师,请升级套餐。网校已有学员".$count."位";
                    echo '<script>alert('.$str.');</script>';exit;
                }
                KS_Alert('添加失败。当前套餐允许添加'.$num.'位老师,请升级套餐。网校已有老师'.$count.'位','error');
            }
            $Data['mobilebing']   = 0;
            $Data['mobile']       = ChkSQL(KS_G('post.mobile'));
            $Rule['username']     = '老师账号|isEmpty,isDbexis';
            $count1                = $this->userModel->getOne('count(*)','where (usertype=1 or usertype=2) and mobile="'.$Data['username'].'"');
            if($count1>0){ KS_INFO('老师账号云平台已存在'); }
            Chkpost($Data,$Rule,$this->userModel);
            //Chkpost($Data,$Rule,$this->userModel,'(usertype=1 or usertype=2)');
		}
		//Chkpost($Data,$Rule,$this->userModel,'wxid='.$Data001['wxid']);
		$Data['password']     = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));
        $Datas['name']                = isset($Data001['name'])?$Data001['name']:(empty(ChkSQL(KS_G('post.membername')))?$Data['username']:ChkSQL(KS_G('post.membername')));
        $Data['nickname'] = $Datas['name'];
        if (!empty($Datas['name'])){
            if (mb_strlen($Datas['name'])>10){
                KS_Alert('姓名长度不符合,长度限制10个字符内!','error');
            }
        }
        if(isset($Data001['type'])&&$Data001['type']==2){
            $Data['befrom'] = 2;
        }
		$result = $this->userModel->doAdd($Data,'userid');
		if(isset($Data001['type'])&&$Data001['type']==2){
			//把图片存过来
			if(!empty(ChkSQL(KS_G('post.avatar')))){
				$dir1               = ChkSQL(KS_G('post.avatar'));
		        $dir2               = ROOT.'Images/users/'.$result.'/'.KS_MD5($result).'.jpg';
				$this->File->unlinkFile($dir2);
				$this->File->copyFile($dir1,$dir2);
			}
		}
        if(isset($Data001['type'])&&$Data001['type']==1){
			if(!empty($_FILES['defaultpic']['tmp_name'])){
				$dir1               = $_FILES['defaultpic']['tmp_name'];
		        $dir2               = ROOT.'Images/users/'.$userid.'/'.KS_MD5($userid).'.jpg';
				$this->File->unlinkFile($dir2);
				$this->File->copyFile($dir1,$dir2);
			}

		}else{
			//把图片存过来
			if(!empty(ChkSQL(KS_G('post.defaultpic')))){
				$dir1               = ChkSQL(KS_G('post.defaultpic'));
		        $dir2               = ROOT.'Images/users/'.$result.'/'.KS_MD5($result).'.jpg';
				$this->File->unlinkFile($dir2);
				$this->File->copyFile($dir1,$dir2);
			}
		}
		//插入第二张表//地区联动数据
		$Datas['userid'] = $result;
		$areaid = ChkClng(KS_G('post.areaid'));
		$areaModel = M('common_area');
		if($areaid!=0){
			$depth = $areaModel->getOne('depth',"where id=$areaid");
			if($depth==3){
				$Datas['countyid'] = $areaid;
				$Datas['cityid'] = $areaModel->getOne('parentid',"where id=$Datas[countyid]");
				$Datas['provinceid'] = $areaModel->getOne('parentid',"where id=$Datas[cityid]");
			}elseif($depth==2){
				$Datas['countyid'] = 0;
				$Datas['cityid'] = $areaid;
				$Datas['provinceid'] = $areaModel->getOne('parentid',"where id=$Datas[cityid]");
			}elseif($depth==1){
				$Datas['countyid'] = 0;
				$Datas['cityid'] = 0;
				$Datas['provinceid'] = $areaid;
			}
		}
		$usertype = ChkClng(KS_S('usertype',3));
		$tableModel = M('common_table');
		$Datas['schoolid']    = ChkSQL(KS_G('post.schoolid'));//所属校区
		if($usertype == 0){
		    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");

			$Datas['Sex']                 = ChkSQL(KS_G('post.Sex'));
			$Datas['birthday']            = strtotime(KS_G('post.birthday'));//出生日期
			$Datas['emergencyContact']    = ChkSQL(KS_G('post.emergencyContact'));//紧急联系人
		    $Datas['emergencyContactTel'] = ChkSQL(KS_G('post.emergencyContactTel'));//紧急联系人电话
		    $Datas['teacher_name'] = ChkSQL(KS_G('post.teacher_name'));//班主任
		    $Datas['teacher_mobile'] = ChkSQL(KS_G('post.teacher_mobile'));//班主任电话
            if (!empty($Datas['teacher_name'])&&empty($Datas['teacher_mobile'])) KS_Alert('请填写班主任电话','error');
            if (!empty($Datas['teacher_mobile'])&&!is_mobile($Datas['teacher_mobile'])) KS_Alert('请填写正确的手机号码','error');
            if (empty($Datas['teacher_name'])&&!empty($Datas['teacher_mobile'])) KS_Alert('请填写班主任姓名','error');
			/*----------------------字段拼接测试中------------------------------*/
			$fieldModel = M('common_table_field');//实例化字段表
			$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
			foreach($Field as $Fk => $Fv){
			    $fieldname = $Fv['fieldname'];
			    $Datas[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
			    if($Fv['mustinput']==1)
			    {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
			}
		    /*----------------------------------------------------*/

		    $this->AppModel  = M('common_user_member');
			$this->AppModel->doEfAdd($Datas);
		}elseif($usertype == 1){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
			$Datas['name']         = isset($Data001['name'])?$Data001['name']:(empty(ChkSQL(KS_G('post.teachername')))?$Data['username']:ChkSQL(KS_G('post.teachername')));
            if (!empty($Datas['name'])){
                if (mb_strlen($Datas['name'])>10){
                    KS_Alert('姓名长度不符号,长度限制10个字符内!','error');
                }
            }
			$Datas['ename']        = ChkSQL(KS_G('post.teacherename'));
            $Datas['shortIntro']           = ChkSQL(KS_G('post.shortIntro'));
            $Datas['teacherIntro']         = ChkSQL(KS_G('post.teacherIntro'));
            $Datas['position']             = ChkSQL(KS_G('post.position'));
			$Datas['isshow']       = ChkClng(KS_G('post.isshow'));
			if($Data['powertype']  == 2&&!empty(ChkSQL(KS_G('post.powerlist')))){
				$powerlist         = ChkSQL(KS_G('post.powerlist'));
				$Datas['power']    = trim(implode(',',$powerlist));
			}
			$Datas['categoryid'] = ChkSQL(KS_G('post.categoryid'));//应用分类ID
			/*----------------------字段拼接测试中------------------------------*/
			$fieldModel = M('common_table_field');//实例化字段表
			$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
			foreach($Field as $Fk => $Fv){
                $fieldname = $Fv['fieldname'];
                $Datas[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
                if($Fv['mustinput']==1)
                {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
			}
		    /*----------------------------------------------------*/
		    $this->AppModel  = M('common_user_teacher');
			$this->AppModel->doEfAdd($Datas);
		}
	}
















	//注册机构老师操作
	/*--modeltype:
	 * 1说明是web登录.2.Api对外开放接口登录*/
	public function sigin($Data008){
		$courseid = ChkClng(KS_G('get.id'));
		$usertype = null !==GF('usertype') ? GF('usertype'):0;
		if($usertype==0){
			include  VIEW_PATH.'transact'.DS.'home.' . "addUserStudent.php";
		}else{
		    include  VIEW_PATH.'transact'.DS.'home.' . "addUserTeacher.php";
		}
	}

	public function userslist($Data003){
		$this->AppModel  = M("".$Data003['AppModel']."");
		$this->userModel = M('common_user');
		$schoolModel = M('app_schooladdress');
		$schoolAry   = $schoolModel->getAll('where wxid='.$Data003['wxid']);
		$user_category = M('common_user_category');
		$where = "where a.wxid =".$Data003['wxid'];
		if($Data003['appename']=='teacher'){//老师
			$result['usertype'] = 1;
    	    $where.= '  and a.usertype = 1 and isshow=1 and a.parentid != 0 and a.wxid='.$Data003['wxid'];//分类
		    $categoryid=null !==GF('categoryid') ? GF('categoryid'):0;
		    if($categoryid!=0){$where .= " and (c.parentidpath like '%$categoryid,%' or c.categoryid=$categoryid)";}
	        if(!empty($Data003['keyword'])){
	        	$keyword = $Data003['keyword'];
			     if($Data003['keytype']==1){$where.=" and a.username like '%$keyword%'";}
				 elseif($Data003['keytype']==2){$where.=" and b.name like '%$keyword%'";}
				 elseif($Data003['keytype']==3){$where.=" and a.email like '%$keyword%'";}
				 elseif($Data003['keytype']==4){$where.=" and (a.username like '%$keyword%' or b.name like '%$keyword%')" ;}
		    }
		    //状态筛选
			$powertype       = null !==GF('powertype') ? GF('powertype'):'3';
			if($powertype==1){$where .= ' and (a.powertype=1 or a.powertype=2)';}
			elseif($powertype==0){$where .= ' and a.powertype=0';}
			//状态筛选
			$status       = KS_S('status',3);
			if($status    ==2){$where .= ' and a.status=2';}
			elseif($status==1){$where .= ' and a.status=1';}
			elseif($status==0){$where .= ' and a.status=0';}
			$schoolid       = null !==GF('schoolid') ? GF('schoolid'):'all';
			if($schoolid!='all'){
				$where .=' and b.schoolid='.$schoolid;
			}
	        $lastlogintime = null !==GF('lastlogintime') ? GF('lastlogintime'):'1';
	        $adddate       = null !==GF('adddate') ? GF('adddate'):'1';
	        $logintimes    = null !==GF('logintimes') ? GF('logintimes'):'1';

			//排序排序排序非常智能//默认排序放最后一个
			$orderby[GN('lastlogintime')] = 'lastlogintime/a.lastlogintime';
	        $orderby[GN('logintimes')]    = 'logintimes/a.logintimes';
	        $orderby[GN('adddate')]       = 'adddate/a.regdate';
		}else{//学生
			$result['usertype'] = 0;
			$where.= ' and a.usertype = 0';
		    if(!empty($Data003['keyword'])){
		    	$keyword = $Data003['keyword'];
			     if($Data003['keytype']==1){$where.=" and a.username like '%$keyword%'";}
				 elseif($Data003['keytype']==2){$where.=" and b.name like '%$keyword%'";}
				 elseif($Data003['keytype']==3){$where.=" and a.email like '%$keyword%'";}
				 elseif($Data003['keytype']==4){$where.=" and (a.username like '%$keyword%' or b.name like '%$keyword%')" ;}
		    }
		    //状态筛选
			$status       = KS_S('status',3);
			if($status    ==2){$where .= ' and a.status=2';}
			elseif($status==1){$where .= ' and a.status=1';}
			elseif($status==0){$where .= ' and a.status=0';}
            //分组搜索
            $groupid       = ChkClng(KS_S('groupid',0));
            if (!empty($groupid)){
                $where .= ' and a.groupid='.$groupid;
            }
            //状态筛选
            $is_period       = ChkClng(KS_S('is_period',3));
            if($is_period    ==1){$where .= ' and (a.is_period=1 and indate>'.time().' or a.is_period=0)';}
            elseif($is_period==2){$where .= ' and a.is_period=1 and indate<'.time();}

            //报班情况
			$enrollstatus       = null !==GF('enrollstatus') ? GF('enrollstatus'):'3';
			if($enrollstatus    ==2){$where .= ' and b.enrollstatus=2';}
			elseif($enrollstatus==1){$where .= ' and b.enrollstatus=1';}
			elseif($enrollstatus==0){$where .= ' and b.enrollstatus=0';}
			$schoolid       = null !==GF('schoolid') ? GF('schoolid'):'all';
			if($schoolid!='all'){
				$where .=' and b.schoolid='.$schoolid;
			}
	        $lastlogintime = null !==GF('lastlogintime') ? GF('lastlogintime'):'1';
	        $adddate       = null !==GF('adddate') ? GF('adddate'):'1';
	        $money         = null !==GF('money') ? GF('money'):'1';

			//排序排序排序非常智能//默认排序放最后一个
			$orderby[GN('lastlogintime')] = 'lastlogintime/a.lastlogintime';
	        $orderby[GN('money')]         = 'money/a.money';
	        $orderby[GN('adddate')]       = 'adddate/a.regdate';
		}
		$userscategory = $this->cache->getACache('userscategory');//取出缓存
		$where    = "as a left join `".$this->AppModel->table."` as b on a.userid = b.userid left join `$user_category->table` as c on b.categoryid = c.categoryid $where";


        $options  = $this->userModel->getOptions('12',$where);//分页参数设置
		if(isset($Data003['now_page'])){
			$options['now_page'] = $Data003['now_page'];
		}else{
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		}if(isset($Data003['maxPerPage'])){
			$options['maxPerPage'] = $Data003['maxPerPage'];
			if($options['maxPerPage'] == '-1'){
				$options['maxPerPage'] = '99999999';
			}
		}else{
			$options['maxPerPage'] = null !==GF('maxPerPage') ? GF('maxPerPage'):'10';
		}
		$page     = Page($options);

//		echo $Data003['now_page'];

		$UsersAll = $this->userModel->getPage($page,OB($orderby),$where,'*,a.userid');

		$result['page'] = $page;
		if($options['now_page']<=$page->total_pages||!isMobile()){
			if($Data003['appename']=='teacher'){
				foreach($UsersAll as $k=>$v){
					$UsersAll[$k]['defaultpic'] = $this->upload->getHead($v['userid']);
				}
				$result['UsersAll'] = $UsersAll;
				return $result;
			}else{
                $common_user_group = M('common_user_group');
				foreach($UsersAll as $k=>$v){
                    if (!empty($v['groupid'])){
                        $UsersAll[$k]['group_name'] = $common_user_group->getOne('name',"where id=$v[groupid]");
                    }else{
                        $UsersAll[$k]['group_name'] = '未分组';
                    }
                    if ($v['is_period']==0){
                        $UsersAll[$k]['indate_text'] = '未开启';
                    }elseif($v['is_period']==1){
                        if ($v['indate']>time()){
                            $UsersAll[$k]['indate_text'] = '<span style="color: blue">未到期</span>';
                        }else{
                            $UsersAll[$k]['indate_text'] = '<span style="color: red">已到期</span>';
                        }
                    }
					$UsersAll[$k]['defaultpic'] = $this->upload->getHead($v['userid']);
					$UsersAll[$k]['checked'] = false;
				}
				$result['UsersAll'] = $UsersAll;
				return $result;
			}

		}else{
			$result['UsersAll'] = array();
			return $result;
		}
	}
	public function edituser($Data005){
		$usertype        = $Data005['usertype'];
		$this->AppModel  = M("".$Data005['AppModel']."");
		$this->userModel = M('common_user');
		$this->wxid      = $Data005['wxid'];
		$tableModel      = M('common_table');
		$userid          = $Data005['userid'];
		if($usertype == 0){
		     $this->AppModel = M('common_user_member');
		      $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
			 $userinfo = $this->userModel->getRow("as a left join `".$this->AppModel->table."` as b on a.userid =b.userid WHERE a.userid =$userid limit 1");
		}elseif($usertype == 1){
			 $tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
			 $this->AppModel = M('common_user_teacher');
			 $userinfo = $this->userModel->getRow("as a left join `".$this->AppModel->table."` as b on a.userid = b.userid WHERE a.userid =$userid limit 1");
		}elseif($usertype == 2){
			 $tableid = $tableModel->getOne('tableid',"where tablename='common_user_school'");
		}
		$Linkage = Linkage(array());
		$Linkage->cachename  = 'appcategory';
		$Linkage->wxid       = $this->wxid;
 		$Linkage->inputname  = 'categoryid';// <select name='' /> 里的name值
		$Linkage->categoryid =  $userinfo['categoryid'];
		$areaid = 0;
		if($userinfo['provinceid']!=0){
			$areaid = $userinfo['provinceid'];
			if($userinfo['cityid']!=0){
				$areaid = $userinfo['cityid'];
				if($userinfo['countyid']!=0){$areaid = $userinfo['countyid'];}
			}
		}
		$link = Linkage(array());
		$link->cachename      = 'areainfo';
		$link->inputname      = 'areaid';// <select name='' /> 里的name值
		$link->idname         = 'id';
		$link->funcname       = 'getchildtwo';
		$link->childvaluename = 'city';
		$link->childidname    = 'id';
		$link->categoryid     = $areaid;
		$schoolModel = M('app_schooladdress');
		$schoolAry   = $schoolModel->getAll('where wxid='.$this->wxid);
        if($usertype==1){
        	$category  = $this->cache->GetACache('appcategory');//读出缓存
			$apprelate = $this->cache->GetHCache('apprelate',$this->wxid);//读出缓存
			return array('category'=>$category,'apprelate'=>$apprelate,'schoolAry'=>$schoolAry,'link'=>$link,'userinfo'=>$userinfo,'Linkage'=>$Linkage);
		}else{return array('schoolAry'=>$schoolAry,'link'=>$link,'userinfo'=>$userinfo,'Linkage'=>$Linkage);}
	}
	//编辑用户
	public function doeidtuser($Data009){
		$this->userModel = M('common_user');
		if(isset($Data009['wxcode'])){
			$wxcode = $Data009['wxcode'];
		}else{$wxcode = 0;}
		if(!empty(KS_G('post.password'))){
			 $Data['rndpasswordc'] = rand(100000,999999);
			 $Data['password']     = KS_MD5(ChkSQL(KS_G('post.password')).KS_MD5($Data['rndpasswordc']));
		}
		$Data['email']             = ChkSQL(KS_G('post.email'));
		if(!empty(KS_G('post.mobile'))){$Data['mobile'] = ChkSQL(KS_G('post.mobile'));}

		$Data['powertype']  = ChkClng(KS_G('post.powertype'));
		$Data['status']     = ChkClng(KS_G('post.status'));
		if(!empty(ChkSQL(KS_G('post.defaultpic')))){
			$dir1               = ChkSQL(KS_G('post.defaultpic'));
	        $dir2               = ROOT.'Images/users/'.$userid.'/'.KS_MD5($userid).'.jpg';
			$this->File->unlinkFile($dir2);
			$this->File->copyFile($dir1,$dir2);
		}
		$Rule['email'] = '邮箱|isEmpty,isEmail';
		Chkpost($Data,$Rule,$this->userModel,"(usertype=1 or usertype=2) and userid!=$userid");
		$result = $this->userModel->update($Data,"userid=$userid");//更新第二张表
		$areaModel = M('common_area');
		$areaid = ChkClng(KS_G('post.areaid'));
		if($areaid!=0){
			$depth = $areaModel->getOne('depth',"where id=$areaid");
			if($depth==3){
				$Datas['countyid']   = $areaid;
				$Datas['cityid']     = $areaModel->getOne('parentid',"where id=$Datas[countyid]");
				$Datas['provinceid'] = $areaModel->getOne('parentid',"where id=$Datas[cityid]");
			}elseif($depth==2){
				$Datas['countyid']   = 0;
				$Datas['cityid']     = $areaid;
				$Datas['provinceid'] = $areaModel->getOne('parentid',"where id=$Datas[cityid]");
			}elseif($depth==1){
				$Datas['countyid']   = 0;
				$Datas['cityid']     = 0;
				$Datas['provinceid'] = $areaid;
			}
		}
		if(KS_G('post.usertype')){
			$usertype    = KS_G('post.usertype');
		}else{
			$usertype    = ChkClng(KS_S('usertype',3));
		}

		$tableModel  = M('common_table');
		$Datas['schoolid']                 = ChkSQL(KS_G('post.schoolid'));
		if($usertype == 0){
		    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
		    $Datas['Sex']                 = ChkSQL(KS_G('post.Sex'));
		    $Datas['birthday']            = strtotime(KS_G('post.birthday'));//出生日期
		    $Datas['emergencyContact']    = ChkSQL(KS_G('post.emergencyContact'));//紧急联系人
		    $Datas['emergencyContactTel'] = ChkSQL(KS_G('post.emergencyContactTel'));//紧急联系人电话
			$Datas['name'] = ChkSQL(KS_G('post.membername'));
			/*----------------------字段拼接测试中------------------------------*/
			$fieldModel = M('common_table_field');//实例化字段表
			$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
			foreach($Field as $Fk => $Fv){
				  $fieldname = $Fv['fieldname'];
				  $Datas[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
				  if($Fv['mustinput']==1)
				  {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
			}
			/*----------------------------------------------------*/
			$result = $this->AppModel->update($Datas,"userid=$userid");
		}elseif($usertype == 1){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
			$Datas['name']         = ChkSQL(KS_G('post.teachername'));
			$Datas['ename']        = ChkSQL(KS_G('post.teacherename'));
			$Datas['isshow']       = ChkClng(KS_G('post.isshow'));
			if($Data['powertype'] == 2&&!empty(ChkSQL(KS_G('post.powerlist')))){
				$powerlist         = ChkSQL(KS_G('post.powerlist'));
				//因为界面问题，，这个暂时注释下，
				$Datas['power']    = trim(implode(',',$powerlist));
			}elseif($Data['powertype'] == 2&&empty(ChkSQL(KS_G('post.powerlist')))){
				$Datas['power']    = '';
			}
			$Datas['categoryid']   = ChkSQL(KS_G('post.categoryid'));//应用分类ID
			/*----------------------字段拼接测试中------------------------------*/
			$fieldModel = M('common_table_field');//实例化字段表
			$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
			foreach($Field as $Fk => $Fv){
			   $fieldname = $Fv['fieldname'];
			   $Datas[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
			   if($Fv['mustinput']==1)
			   {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
			}
			//var_dump($userid).die;
			/*----------------------------------------------------*/
			$result = $this->AppModel->update($Datas,"userid=$userid");
		}
		$classid = null !==GF('classid') ? GF('classid'):'0';
	    $bappid = null !==GF('bappid') ? GF('bappid'):'0';
	    if($classid !=0){
	   	    $url1=M_URL('class/Index','teacher',$userid,GP('p-'.$now_page.',classid-'.$classid.',appid-'.$bappid));
	    }else{
	     	$url1=M_URL($this->AppName.'/Index','index',$userid,GP('p-'.$now_page));
	    }
	    if(isset($Data009['modeltype'])){
	    	echo '{"succeed":"10000","msg":"修改成功"}';exit;
	    }
		KS_INFO('修改成功',0,$url1);
	}
	//编辑用户1 :班级里的编辑老师
	public function doeidtuser1($Data009){
		$userid = null !==GF('userid') ? GF('userid'):0;
		$this->userModel = M('common_user');
		if(isset($Data009['wxcode'])){
			$wxcode = $Data009['wxcode'];
		}else{$wxcode = 0;}

		$Data['username']     = ChkSQL(KS_G('post.username'));
//		$Data['password']     = ChkSQL(KS_G('post.password'));
//		$Data['rndpasswordc'] = rand(100000,999999);
//		$Data['email']        = ChkSQL(KS_G('post.email'));
//		if(!isset($Data001['type'])){$Data['status']       = ChkSQL(KS_G('post.status'));}
//		else{$Data['status']  = 1;}
//		$Data['regdate']      = ChkClng(time());
//		$Data['usertype']     = ChkClng($usertype);
//		$Data['powertype']    = ChkClng(KS_G('post.powertype'));
//		$Data['wxid']         = $Data001['wxid'];
//		$Data['parentid']     = $Data001['userid'];

		if(!empty(KS_G('post.password'))){
			 $Data['rndpasswordc'] = rand(100000,999999);
			 $Data['password']     = KS_MD5(ChkSQL(KS_G('post.password')).KS_MD5($Data['rndpasswordc']));
		}
		$Data['email']             = ChkSQL(KS_G('post.email'));
		if(!empty(KS_G('post.mobile'))){$Data['mobile'] = ChkSQL(KS_G('post.mobile'));}

		//$Data['powertype']  = ChkClng(KS_G('post.powertype'));
		//$Data['status']     = ChkClng(KS_G('post.status'));
		if(!empty(ChkSQL(KS_G('post.defaultpic')))){
			$dir1               = ChkSQL(KS_G('post.defaultpic'));
	        $dir2               = ROOT.'Images/users/'.$userid.'/'.KS_MD5($userid).'.jpg';
			$this->File->unlinkFile($dir2);
			$this->File->copyFile($dir1,$dir2);
		}
		$Rule['email'] = '邮箱|isEmpty,isEmail';
		Chkpost($Data,$Rule,$this->userModel,"(usertype=1 or usertype=2) and userid!=$userid");

		$result = $this->userModel->update($Data,"userid=$userid");//更新第二张表

		if(KS_G('post.usertype')){
			$usertype    = KS_G('post.usertype');
		}else{
			$usertype    = ChkClng(KS_S('usertype',3));
		}
		$tableModel  = M('common_table');
		//$Datas['schoolid']                 = ChkSQL(KS_G('post.schoolid'));
		if($usertype == 0){
			$this->AppModel  = M('common_user_member');
//		    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
		    $Datas['Sex']                 = ChkSQL(KS_G('post.Sex'));
		    $Datas['birthday']            = strtotime(KS_G('post.birthday'));//出生日期
		    $Datas['emergencyContact']    = ChkSQL(KS_G('post.emergencyContact'));//紧急联系人
		    $Datas['emergencyContactTel'] = ChkSQL(KS_G('post.emergencyContactTel'));//紧急联系人电话
			$Datas['name'] = ChkSQL(KS_G('post.membername'));
			/*----------------------字段拼接测试中------------------------------*/
//			$fieldModel = M('common_table_field');//实例化字段表
//			$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
//			foreach($Field as $Fk => $Fv){
//				  $fieldname = $Fv['fieldname'];
//				  $Datas[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
//				  if($Fv['mustinput']==1)
//				  {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
//			}
			/*----------------------------------------------------*/
			$result = $this->AppModel->update($Datas,"userid=$userid");
		}elseif($usertype == 1){
			$this->AppModel  = M('common_user_teacher');
//			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
			$Datas['name']         = isset($Data009['name'])?$Data009['name']:(empty(ChkSQL(KS_G('post.teachername')))?$Data['username']:ChkSQL(KS_G('post.teachername')));
		    $Datas['teacherzc']    = ChkSQL(KS_G('post.teacherzc'));//职称
//			$Datas['ename']        = ChkSQL(KS_G('post.teacherename'));
//			$Datas['isshow']       = ChkClng(KS_G('post.isshow'));

			/*----------------------字段拼接测试中------------------------------*/
//			$fieldModel = M('common_table_field');//实例化字段表
//			$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
//			foreach($Field as $Fk => $Fv){
//			   $fieldname = $Fv['fieldname'];
//			   $Datas[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
//			   if($Fv['mustinput']==1)
//			   {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
//			}
			//var_dump($userid).die;
			/*----------------------------------------------------*/
			$result = $this->AppModel->update($Datas,"userid=$userid");
		}

		$classid   = isset($Data009['classid'])?$Data009['classid']:(null !==GF('classid') ? GF('classid'):'0');
	    $now_page  = null !==GF('p') ? GF('p'):'0';
	    $appid     = null !==GF('appid') ? GF('appid'):'0';
	    if($classid !=0){
	    	//var_dump($classid);exit;
	   	    $url1=M_URL('class/Index','teacher',$classid,GP('p-'.$now_page.',classid-'.$classid.',appid-'.$appid));
	    }else{
	    	$url1=M_URL('class/Index','teacher',$classid,GP('p-'.$now_page.',classid-'.$classid.',appid-'.$appid));
	     	//$url1=M_URL($this->AppName.'/Index','index',$userid,GP('p-'.$now_page));classlevel
	    }
	    if(isset($Data009['modeltype'])){
	    	echo '{"succeed":"10000","msg":"修改成功"}';exit;
	    }
		KS_INFO('修改成功',3,$url1);
	}
	/*检查图片*/
    public function checkImg($imgindex,$type=1){
    	$str='//'.APP_DOMAIN;
        if(!empty($imgindex)){
       	  	$img        = Img($imgindex,1);
       	  	if($img=='https://test.kesion.com/Public/uploads/common/timg.jpg'){
       	  		$img    = nopic($type);
       	  	}
       	  	if($img){
       	  		if(stristr($img,'//') || stristr($img,'http')){//判断是否有前缀
	       	  	  	$newimg = $img;
	       	 	}else{
	           	  	$newimg=$str.$img;
	       	  	}
       	  	}else{
       	  		$newimg =nopic($type);
       	  	}
	       	if($newimg!='//'.APP_DOMAIN.'/'){$newimg =$newimg;
	       	}else{$newimg =nopic($type);}
        }else{$newimg = nopic($type);}
        return $newimg;
    }

    /*创建班级*/
    public function doaddcourse($Data011){
    	$Data['title']        = ChkSQL(KS_G("post.title"));
		$Data['wxid']         = $Data011['wxid'];
		$Data['status']       =2;
		$Data['classlevel']   = $Data011['classlevel'];
		$this->AppModel       = $Data011['AppModel'];
		if($Data011['classlevel']==2){
			$Data['studentcount'] = 1;
			$Data['defaultpic']   = MY_FULLDOMAIN.'/Images/admin/classlevel2.jpg';
			$Data['resolutionid'] = 1;
			$count           = $this->AppModel->getOne('count(*)','where  wxid='.$Data011['wxid'].' and  classlevel=2  and  status != -1 ');

		}elseif($Data011['classlevel']==1){
			$Data['defaultpic']=MY_FULLDOMAIN.'/Images/admin/classlevel1.jpg';
		    $Data['resolutionid']=2;
		    $Data['studentcount']=6;
			$count           = $this->AppModel->getOne('count(*)','where  wxid='.$Data011['wxid'].' and  classlevel=1  and  status != -1 ');

		}elseif($Data011['classlevel']==0){
		    $Data['resolutionid']=3;
			$Data['studentcount']=20;
			$Data['defaultpic']=MY_FULLDOMAIN.'/Images/admin/classlevel0.jpg';
			$count           = $this->AppModel->getOne('count(*)','where  wxid='.$Data011['wxid'].' and  classlevel=0  and  status != -1 ');

		}

		if(!empty(ChkSQL(KS_G("post.defaultpic")))){
			$Data['defaultpic']   = ChkSQL(KS_G("post.defaultpic"));
			//分享出去的封面
			$Data['sharepic']     = getsharepic($Data['defaultpic']);
		}else{
			$Data['sharepic']     = getsharepic($Data['defaultpic']);
		}
		$Data['adddate']      = time();
		$setting              = $this->cache->GetSubH('apprelate','appid',30,'subappid',0,'setting',$Data011['wxid']);
		$Data['isassociated'] = ChkClng(KS_G("post.associated"));//关联售卖
		$Data['isseparate']   = ChkClng(KS_G("post.separate"));//单独售卖
		if($Data['isassociated']){
		   $columnid = ChkSQL(KS_G('post.columnid'));
		}
		if(!empty($setting)){
			$setting              = explode('※',$setting);

			if($setting[3]==0){
			    $Data['status']         = ChkSQL(KS_G("post.status"));
				$Data['classintro']     = EncodeSQL(KS_G("post.classintro"));
				$Data['shortdesc']      = ChkSQL(KS_G("post.shortdesc"));
				$Data['detailintro']    = ChkSQL(KS_G("post.detailintro"));
				$Data['studentcount']   = ChkSQL(KS_G("post.studentcount"));
				if($Data['isseparate']){//支持单独售卖才接收价格之类的参数
					$Data['chargetype']   = ChkClng(KS_G("post.chargetype"));
					$Data['price_market'] = ChkSQL(KS_G("post.price_market"));
					$Data['price']        = ChkSQL(KS_G("post.price"));
				}
				$Data['iscopy']         = ChkSQL(KS_G("post.iscopy"));
			}else{
				if($setting['1']==1){$Data['status']       = 2;
				}else{$Data['status']       = 0;}
	        }
		}
//		exit;
		if(isset($Data011['modeltype'])){//暂不知道哪个入口，，待记
		 	$Data['title']             = $Data011['title'];
		 	$Data['classintro']        = $Data011['intro'];
		 	$Data['defaultpic']        = $Data011['defaultpic'];
		 	$Data['sharepic']          = getsharepic($Data['defaultpic']);

		 	$Data['chargetype']        = $Data011['chargetype'];
		 	if(isset($Data011['price'])){
		 		$Data['price']        = $Data011['price'];
		 	}
			if(empty($Data['title'])){
				$return['errcode'] = 20004;
				$return['errmsg'] = "添加失败,标题不能为空";
				$return['status']='no';
				return $return;exit;
			}
			$ishave = $this->AppModel->getAll('where title="'.$Data['title'].'" and wxid='.$Data['wxid'].' and classlevel='.$Data011['classlevel'].' and status!=-1');
			if($ishave){
                $return['errcode'] = 20014;
				$return['errmsg'] = "标题已存在相同的";
				$return['status']='no';
				return $return;exit;
			}
		}else{
			$Data['teacherid']        = $Data011['userid'];
			$Rule['title'] = '标题|isDbexis,isEmpty';
		    Chkpost($Data,$Rule,$this->AppModel);
		}
		$classid = $this->AppModel->doadd($Data,'classid');
		if(isset($columnid)){
           $AppModel = M('app_column_link');
			$DataCol['infoid'] = $classid;
			$shopid = explode('|',$columnid);
			foreach ($shopid as $k => $v) {
				if($v){
					$DataCol['type'] =2;
					$DataCol['columnid'] = $v;
		            $AppModel->doadd($DataCol,'id');
		             $db_order_info = M('app_order_info');
					$orderInfo = $db_order_info->getAll('where paystatus=1 and type=7 and courseid='.$v.' and status!=-1','memberid');
					foreach($orderInfo as $k =>$v){
						$this->cache->PutUCache('havecolumn',$v['memberid']);//更新购买者的缓存
					}
				}
			}
		}
		if(isset($Data011['modeltype'])){
			$return['errcode'] = 10000;
			$return['id'] = $classid;
			$return['errmsg'] = "添加成功";
			$return['status']='ok';
			return $return;exit;
		}else{
		    //添加教师
		    $teacherModel      = M('app_class_teacherrelate');
	        $teacher           = $teacherModel->getRow('where classid='.$classid.' and wxid='.$Data['wxid'].' and isspeaker=1  limit 1 ');
			if(empty($teacher)){
	    		  $Datas['teacherid'] = $Data011['userid'];
	    		  $Datas['isspeaker'] = 1;
	    		  $Datas['classid']   = $classid;
	    		  $Datas['wxid']      = $Data011['wxid'];
	    		  $teacherModel->doAdd($Datas,'id');
			}
		    //排课排班
			if($setting[3]==0){
				  $Data002['classid']=$classid;$Data002['year']=date('y');$Data002['week']=date('w');
				  $no=date("H");if ($no>0&&$no<=12){$Data002['dayPm']= 1;
				  }elseif ($no>12&&$no<18){$Data002['dayPm']= 2;
				  }elseif ($no>=12&&$no<=18){$Data002['dayPm']= 3;
				  }
     			  $Data002['day']         = date('d');
     			  $Data002['wxid']        = $Data011['wxid'];
     			  $Data002['teacherid']   = $Data011['userid'];
     			  $Data002['memberid']    = ChkClng(KS_G('post.memberid'));
     			  $Data002['type']        = 2;

     			  $a      = $Data002['timeSlotStart'] = strtotime(ChkSQL(KS_G("post.begindate")));
				  if(empty($a)){KS_INFO('开始时间不能为空',0,'','',1);}

				  $Data002['livehours']  = ChkSQL(KS_G("post.livehours"));
     			  $b      = $Data002['timeSlotEnd']   = $Data002['timeSlotStart']+$Data002['livehours']*3600;
	 			  $model  = M('app_class_schedule');
	 			  //判断同一个班级内时间
	 			  $where  =" ((timeSlotStart>=$a AND timeSlotStart<=$b) or (timeSlotStart<= $a AND timeSlotEnd>=$b) or ( timeSlotStart>=$a  AND  timeSlotEnd<=$b))";
	 			  $istime = $model->getRow(' where wxid='.$Data011['wxid'].' and classid='.$Data002['classid'].' and '.$where);
	 			  if($istime){KS_INFO('该班级在该时段已有课程');}
				  //获取教师信息
				  if($Data002['teacherid']){
		 				$userModel    = M('common_user');
	   					$memberModel  = M('common_user_teacher');
	   					$teacherinfo  = $userModel->getRow(" as a left join $memberModel->table as b on a.userid = b.userid where a.userid=".$Data002['teacherid'],'b.name,a.username');
			 			if($teacherinfo['name']){
			 	 			$Data002['name'] = $teacherinfo['name'];
			 			}else{
			 	 			$Data002['name'] = $teacherinfo['username'];
			 			}
			 			$Data002['username'] = $teacherinfo['username'];
			 			$Data002['headpic']  = $this->upload->getHead($Data002['teacherid'],5);
				  }
				  $id = $model->doAdd($Data002,'id');
	 			  if($Data002['type']==2){
						$resule['type']        = '线上';
						$Data003['wxid']       = $Data011['wxid'];
						$Data003['classlevel'] = $Data011['classlevel'];
						$Data003['teacherid']  = $Data002['teacherid'];
						$Data003['classid']    = $Data002['classid'];
						$UsersModel            = M('App/UsersModel');
		 				$result                = $UsersModel->createRoom($Data003);
				  }
			 }
		}
		return $classid;
   }
   /*------------------创建直播房间------------------*/
   public function createRoom($Data012){
   	    $liveModel = M('app_live_list');
	 	$live      = $liveModel->getRow(' where wxid='.$Data012['wxid'].' and classid='.$Data012['classid'].' limit 1');
   	    if(!$live){
   			   if(isset($Data012['from'])){
					$Data1['from']  = $Data012['from'];
			   }
   	   		   $maxid = $liveModel->getMaxValue('id')+1;
  			   $Data1['channlName'] = str_pad($maxid,6,"0",STR_PAD_LEFT);
  			   $Data1['password']   = rand(10000,99999);
  			   $Data1['adddate']    = time();
	  		   if(isset($Data012['teacherid'])){
	  	      		$Data1['teacherid'] = $Data012['teacherid'];
	  		   }
  			   $Data1['status']       = 1;
	  		   $Data1['wxid']         = $Data012['wxid'];
	  		   $Data1['type']         = 2;
	  		   $Data1['classid']      = $Data012['classid'];
	  		   $Data1['classlevel']   = $Data012['classlevel'];
	  		   $chaptertableModel     = M('common_extends_table');
			   $Data1['studentTable'] = $chaptertableModel->getOne('tablename','where Isdefault=1 and type =3');
	  		   $id = $liveModel->doAdd($Data1,'id');
	  		   $Data1['id'] = $id;
	  		   return $Data1;exit;
   	    }else{
   	    	   return $live;exit;
   	    }
   }

    /**
     * 课程列表
     * @param $courseid 课程id
     * @param $type 类型
     * @param $paytype 订单来源
     * @param $userid 用户
     * @param $wxid  网校id
     */
    public function addCourseList($courseid,$type,$paytype,$userid,$wxid){
        $app_course_rate = M('app_course_rate');
        $rate = $app_course_rate->getRow("where courseid=$courseid and userid=$userid");
        if ($rate) return $rate['id'];
        $data_course['courseid'] = $courseid;
        $data_course['type'] = $type;
        $data_course['paytype'] = $paytype;
        $data_course['userid'] = $userid;
        $data_course['createtime'] = time();
        $data_course['wxid'] = $wxid;
        $data_course['status'] = 1;
        if ($type==2){//直播课
            $model = M('app_course');
            $livetype = $model->getOne('livetype',"where courseid=$courseid");
            if ($livetype==1){//一对一的情况，加进来的学生设置为上课学生
                $res = $app_course_rate->getOne('id',"where courseid=$courseid and status=2");
                if (!$res) $data_course['status'] = 2;
            }
        }
        $id = $app_course_rate->doAdd($data_course,'id');
        $this->cache->PutHCache('appcourserate',$wxid);//写入缓存   app_market
        return $id;
    }
}