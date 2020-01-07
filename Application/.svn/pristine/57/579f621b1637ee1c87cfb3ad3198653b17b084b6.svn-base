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
    //进入首页
    public function indexAction(){
		$this->display('index.html');
    }
    //进入首页
    public function searchAction(){
    	$type          =null !==GF('type') ? GF('type'):'course';
    	$key           =null !==GF('key') ? GF('key'):'0';
    	$categoryid    =null !==GF('categoryid') ? GF('categoryid'):0;	
    	if($type=='news'){
    		$AppModel   = M('app_news');
			$where      = 'where a.wxid='.$GLOBALS['_DoM']['wxid'];
			if($categoryid!=0){$where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}	
			if(!empty($key)){$where.=" and a.title like '%$key%'";}
			$byname     = 'adddate desc';
			$left_join  = M('app_category');//需要连表的在最后left join
			$where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where";
			$maxPerPage = $this->getMaxPage('home/search.html','','three');
			$options    = $AppModel->getOptions($maxPerPage,$where);//分页参数设置
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
			$page       = Page($options);
			$dt         = $AppModel->getPage($page,$byname,$where,'b.*,a.*'); 
    	}elseif($type=='teacher'){
    		$userModel = M('common_user');
		    $AppModel  = M('common_user_teacher');
    		$where     = 'where a.wxid='.$GLOBALS['_DoM']['wxid'].' and a.parentid!=0';
    	    $where     .= '  and a.usertype = 1 and b.isshow=1';//分类
		    if($categoryid!=0) {$where .= " and (c.parentidpath like '%$categoryid,%' or c.categoryid=$categoryid)";}
		    if(!empty($key)){$where.=" and b.name like '%$key%'";}
			//判断是否有用户ID
			$byname = 'a.userid desc';
			//需要连表的在最后left join
			$left_join = M('app_category');
			$where = "as a left join `".$AppModel->table."` as b on a.userid = b.userid left join `$left_join->table` as c on b.categoryid = c.categoryid $where";
		    $maxPerPage = $this->getMaxPage('home/search.html','','two');
			$options = $userModel->getOptions($maxPerPage,$where);//分页参数设置
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
			$page    = Page($options);
			$dt      = $userModel->getPage($page,$byname,$where,'b.*,a.*'); 
			foreach($dt as $k=>$v){
				$dt[$k]['defaultpic'] = $this->upload->getHead($v['userid']);
			}
    	}else{
    		$AppModel      = M('app_course');
	    	$where         = 'where a.wxid='.$GLOBALS['_DoM']['wxid'].' and a.status=2';
			if($categoryid!=0){$where .= " and (c.parentidpath like '%$categoryid,%' or c.categoryid=$categoryid)";}	
			$appcategory   = $this->cache->GetHCache('appcategory',$GLOBALS['_DoM']['wxid']);//取出缓存
			if(!empty($key)){$where.=" and a.title like '%$key%'";}
			$byname        = 'adddate desc';
			$left_join     = M('app_category');//需要连表的在最后left join
			$user_teacher  = M('common_user_teacher');
			$where = "as a left join `".$user_teacher->table."` as b on a.teacherid = b.userid left join `$left_join->table` as c on a.categoryid = c.categoryid $where";
			$maxPerPage    = $this->getMaxPage('home/search.html','','one');
			$options       = $AppModel->getOptions($maxPerPage,$where);//分页参数设置
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
			$page          = Page($options);
			$dt            = $AppModel->getPage($page,$byname,$where,'c.*,b.*,a.*'); 
    	}
		$category = $this->cache->GetHCache('appcategory',$GLOBALS['_DoM']['wxid']);//读出缓存
		$Linkage = Linkage(array(),$category);	
		$Linkage->categoryid = $categoryid;
		$this->assign('Linkage',$Linkage->Linkage(5));
    	$this->assign('page',$page);
    	$this->assign('dt',$dt);
    	$this->assign('type',$type);
		$this->display('home/search.html');
    }
	//进入完善信息
    public function addinfoAction(){
		$areainfo             = $this->cache->getACache('areainfo');//取出缓存
		$link                 = Linkage(array(),$areainfo);	
		$link->inputname      = 'areaid';// <select name='' /> 里的name值
		$link->idname         = 'id';
		$link->funcname       = 'getchildtwo';
		$link->childvaluename = 'city';
		$link->childidname    = 'id';
		$area                 = $link->Linkage(3);	
	    $this->assign('area',$area);
	    $this->display('home/memberinfo.html');
	}
    //检查有没有登录的 
	public function checkloginAction(){
        if($this->memberinfo  != null) {
			 $result = $this->upload->getHead($this->memberid);
			 if($result){$memberhead = $result;}
			 else{$memberhead = '{$UOOT}Public/uploads/common/nopic.gif';}
			 $cartcourse = $this->cache->GetUCache('cartcourse',$this->memberinfo['userid']);
			 header("Content-type: application/json");
			 echo json_encode(array('result'=>'succeed','username'=>$this->memberinfo['username'],'memberhead'=>$memberhead,'cartNum'=>count($cartcourse),'logouturl'=>M_URL('home','logout'),'classurl'=>M_URL('home','class'),'carturl'=>M_URL('course','cart')),JSON_UNESCAPED_UNICODE);
		}else{
			 header("Content-type: application/json");
			 echo json_encode(array('result'=>'failed','loginurl'=>M_URL('home','login','1')));
		} 
    }
    //进入404预览界面
	public function pre404Action(){
        $this->assign('getMessage','这个是404预览界面，这里会对应出现提示！');
		$this->display('404.html');
    }
	//进入登录界面
	public function loginAction(){
		$id      = ChkClng(KS_G('request.id'));
		//if($this->memberinfo!== null&&$id!=3){KS_INFO('',2,M_URL());}
		$website = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		$issms   = getSetting(0,17,$GLOBALS['_DoM']['wxid']);
	    $status  = $this->cache->GetH('smsmodel','modelname','Register','status',$GLOBALS['_DoM']['wxid']);//读出缓存
	    if($status==1&&$issms==1){$this->assign('status',$status);}
		else{$this->assign('status',0);}
		//$dt = $this->cache->GetHCache('loginconf',$GLOBALS['_DoM']['wxid']);//读出缓存
		//$this->assign('dt',$dt);
		//$status  = $this->cache->GetH('smsmodel','modelname','Login','status',$GLOBALS['_DoM']['wxid']);//读出缓存
		//$website = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
//		$issms   = getSetting(6,$website['setting']);
//	    if($status==1&&$issms==1){ 
//		    $this->assign('status',$status);     		
//		}else{
//		    $this->assign('status',0);  
//		}
//		$loginsetting  = $this->cache->GetH('apprelate','appid',20,'setting',$GLOBALS['_DoM']['wxid']);//读出缓存
//		$this->assign('loginsetting',$loginsetting); 
		if($id==1){$this->display('home/Poplogin.html');}
	    else{$this->display('home/login.html');} 
     }
     //进入注册界面
	 public function registerAction(){
		if($this->memberinfo !== null){$url =  M_URL();ks_header($url);}  
		$website = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		$issms   = getSetting(0,17,$GLOBALS['_DoM']['wxid']);
	    $status  = $this->cache->GetH('smsmodel','modelname','Register','status',$GLOBALS['_DoM']['wxid']);//读出缓存
	    if($status==1&&$issms==1){$this->assign('status',$status);}
		else{$this->assign('status',0);}
		$isregister = 1;
        $this->display('home/register.html');
    }
    //找回密码
	public function getpasswordAction(){
	 	$code             = ChkSQL(KS_G('post.code'));
		$username         = ChkSQL(KS_G('post.username'));
		$info             = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		$status           = $this->cache->GetH('smsmodel','modelname','Register','status',$GLOBALS['_DoM']['wxid']);//读出缓存
		$issms            = getSetting(0,17,$GLOBALS['_DoM']['wxid']);
		if($status==1 && $issms == 1){
			$smslog  = M('app_sms_log');
			$content = $smslog->getOne('content',"where mobile='$username' and logtype=0 and model='Register' and wxid = ".$GLOBALS['_DoM']['wxid']." and adddate>='".time()."'-10000 order by adddate desc limit 1");
			$content = substr(preg_replace('/\D/s','',$content),-6);
			if($code!=$content||empty($code)){
				KS_INFO("<script>parent.getPassWordCallBack('验证码错误');</script>",-1);
			}else{
				$usersModel  = M('common_user');
				$user        = $usersModel->getRow("where mobile='$username' and wxid = ".$GLOBALS['_DoM']['wxid']." and usertype=0 limit 1",'password,rndpasswordc');
				$password    = KS_MD5($user['password'].KS_MD5($user['rndpasswordc']));
				KS_INFO("<script>parent.getPassWordCallBack({state:'succeed',username:'$username',password:'$password'});</script>",-1);
			}
		}else{KS_INFO("<script>parent.getPassWordCallBack('没有短信功能');</script>",-1);}
    }
    //重置密码
	public function resetpasswordAction(){
		$username         = ChkSQL(KS_G('post.username'));
		$oldpassword      = ChkSQL(KS_G('post.oldpassword'));
		$newpassword      = ChkSQL(KS_G('post.newpassword'));
		$usersModel       = M('common_user');
		$user             = $usersModel->getRow("where mobile='$username' and mobilebing=1 and wxid = ".$GLOBALS['_DoM']['wxid']." and usertype=0 limit 1",'password,rndpasswordc,usertype,parentid,userid,username,status,wxid,email');
		if($oldpassword==KS_MD5($user['password'].KS_MD5($user['rndpasswordc']))){
			$Data['rndpasswordc'] = rand(100000,999999);
			$Data['password']     = KS_MD5($newpassword.KS_MD5($Data['rndpasswordc']));
			$usersModel->update($Data,"mobile='$username' and wxid = ".$GLOBALS['_DoM']['wxid']." and usertype=0 limit 1");
			KS_INFO("<script>parent.resetPassWordCallBack('重置成功');</script>",-1);
		}else{
			KS_INFO("<script>parent.resetPassWordCallBack('重置失败');</script>",-1);
		}
     }
     //进入官网登录界面
	 public function OsLoginAction(){
	 	include  CURR_VIEW_PATH . "login.php";
     }
     //进入官方注册界面
	 public function OsRegisterAction(){
	 	include  CURR_VIEW_PATH . "register.php";
     }
	 //进行登录
	 public function siginAction(){ 
	    $id          = ChkClng(KS_G('request.id'));
		$username    = KS_G('post.username');
		$password    = KS_G('post.password');
		$code        = ChkSQL(KS_G('post.code'));
		$usersModel  = M('common_user');
		$website     = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		$issms       = getSetting(0,17,$GLOBALS['_DoM']['wxid']);
		//短信验证
		$status      = $this->cache->GetH('smsmodel','modelname','Login','status',$GLOBALS['_DoM']['wxid']);//读出缓存
		if($status==1 && $issms==1){
			$smslog  = M('app_sms_log');
			$content = $smslog->getOne('content',"where mobile='$Data[username]' and logtype=0 and model='Login' and wxid = ".$GLOBALS['_DoM']['wxid']." and adddate>='".time()."'-10000 order by adddate desc limit 1");
			$content = preg_replace('/\D/s', '', $content);
			if($code!=$content||empty($code)){KS_INFO("<script>parent.regSuccessBack('验证码错误');</script>",-1);}
	    }
		$user = $usersModel->getRow("where mobile='$username' and wxid = ".$GLOBALS['_DoM']['wxid']." and usertype=0 limit 1",'password,rndpasswordc,usertype,parentid,userid,username,status,wxid,email');
		//这个机构登录是有做的，在有绑定手机或者邮箱的情况下，是允许手机或者邮箱登录的------待做
		/*if(!$user && $website['isphonelogin']==1)*/
		//在有绑定手机或者邮箱的情况下，是允许手机或者邮箱登录的
		if(!$user){$user = $usersModel->getRow("where username='$username' and mobilebing=1 and wxid = ".$GLOBALS['_DoM']['wxid']." and usertype=0 limit 1",'password,rndpasswordc,usertype,parentid,userid,username,status,wxid,email');}
		if(!$user){$user = $usersModel->getRow("where email='$username' and emailbing=1 and wxid = ".$GLOBALS['_DoM']['wxid']." and usertype=0 limit 1",'password,rndpasswordc,usertype,parentid,userid,username,status,wxid,email');}
		if(!$user){
			if($id==2){echo '{"errcode":"10001"}';exit;}
			else{KS_INFO("<script>parent.loginSuccessBack('登录失败');</script>",-1);}
		}elseif($user['status']==2){KS_INFO('该账户已被锁定');}
		elseif($user['status']==0){KS_INFO('该账户未通过审核');}
		if($user['password']==KS_MD5($password.KS_MD5($user['rndpasswordc']))){
			$lastlogintime       = time();
			$lastloginip         = $_SERVER['REMOTE_ADDR'];
			$GLOBALS['db']->execSql("UPDATE `$usersModel->table` SET `lastlogintime`='$lastlogintime', `lastloginip`='$lastloginip', `logintimes`=logintimes+1 WHERE userid=$user[userid]");
			$Data['wxid']        = $GLOBALS['_DoM']['wxid'];
			$Data['memberid']    = $user['userid'];
			$Data['userid']      = $user['parentid'];
			$Data['memberip']    = $_SERVER['REMOTE_ADDR'];
			$Data['adddate']     = time();
			$Data['type']        = 0;
			if(isMobile()){$Data['logintype'] = 1;$Data['mark']= '很正常的一次手机端登录';}
			else{$Data['logintype'] = 0;$Data['mark']= '很正常的一次PC端登录';}
			$login_log         = M('app_login_log');
			$login_log->doAdd($Data,'id');
			//把一些基本信息放入session
			$userinfo['userid']   = $user['userid'];
			$userinfo['username'] = $user['username'];
			$userinfo['usertype'] = $user['usertype'];
			$userinfo['wxid']     = $user['wxid'];//网校id
			putsession('member',$userinfo);
			//这个机构登录是有做的，登录成功，请完善资料------待做
			//if($website['isinfo']==1){$url =  M_URL('Index','addinfo');KS_INFO('登录成功，请完善资料',2,$url);}
			if($id==2){echo '{"succeed":"10001"}';exit;}
			elseif($id==1){KS_INFO("<script>parent.loginSuccessBack('登录成功');</script>",'-1');}
			else{KS_INFO('登录成功',5,M_URL());}
		}else{
			if($id==2){echo '{"errcode":"10001"}';exit;}
			else{KS_INFO("<script>parent.regSuccessBack('密码错误');</script>",-1);}
		} 
     }
	 //注销登录
     public function logoutAction(){   
	        check_login($this->memberinfo);//检查是登录权限 
			$usersModel        = M('common_user'); 
            $user              = $usersModel->getRow("where wxid=".$GLOBALS['_DoM']['wxid']." and userid = ".$this->memberid." limit 1",'password,rndpasswordc,usertype,parentid,userid,status,wxid,email');
		    $Data['wxid']      = $GLOBALS['_DoM']['wxid'];
			$Data['memberid']  = $user['userid'];
			$Data['userid']    = $user['parentid'];
			$Data['memberip']  = $_SERVER['REMOTE_ADDR'];
			$Data['adddate']   = time();
			$Data['type']      = 1;
			if(isMobile()){$Data['logintype'] = 1;$Data['mark']= '很正常的一次手机端退出';}
			else{$Data['logintype'] = 0;$Data['mark']= '很正常的一次PC端退出';}
			$login_log         = M('app_login_log');
			$login_log->doAdd($Data,'id');
			putsession('member',null);
		    ks_header(M_URL());
     }
	 //进行注册
	 public function doregisterAction(){
		$code             = ChkSQL(KS_G('post.code'));
		$Data['username'] = ChkSQL(KS_G('post.username'));
		$Data['mobile']   = ChkSQL(KS_G('post.username'));
		$Data['usertype'] = 0;
		$Data['password'] = ChkSQL(KS_G('post.password'));
		$Data['rndpasswordc'] = rand(100000,999999);
		$Data['regdate']  = ChkClng(time());
		$Data['wxid']     = $GLOBALS['_DoM']['wxid'];
		$Data['status']   = 1;
		$info             = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		//$Data['integral'] = getSetting(15,$info['setting']);
		$status           = $this->cache->GetH('smsmodel','modelname','Register','status',$GLOBALS['_DoM']['wxid']);//读出缓存
		$issms            = getSetting(0,17,$GLOBALS['_DoM']['wxid']);
		if($status==1 && $issms == 1){
			$smslog  = M('app_sms_log');
			$content = $smslog->getOne('content',"where mobile='$Data[mobile]' and logtype=0 and model='Register' and wxid = ".$GLOBALS['_DoM']['wxid']." and adddate>='".time()."'-10000 order by adddate desc limit 1");
			$content = substr(preg_replace('/\D/s','',$content),-6);
			if($code!=$content||empty($code)){KS_INFO("<script>parent.regSuccessBack('验证码错误');</script>",-1);}
		}
	    $usersModel       = M('common_user');
		$usernum          = $usersModel->getOne('count(*)','where mobile = '.$Data['username'].' and wxid = '.$GLOBALS['_DoM']['wxid']); 
		//一个号码只可以注册一次
		//$usernum          = $usersModel->getOne('count(*)','where mobile = '.$Data['username']); 
        if($usernum>0){KS_INFO("<script>parent.regSuccessBack('该用户已注册');</script>",-1);}
		$Data['parentid'] = $usersModel->getOne('userid','where parentid=0 and wxid = '.$GLOBALS['_DoM']['wxid']);
		$Rule['mobile']   = '手机号|isEmpty,isMobile';
		$Rule['password'] = '密码|isEmpty,isPassword';
		Chkpost($Data,$Rule,$usersModel);
		$Data['password'] = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));
		$result           = $usersModel->doAdd($Data,'userid');
		//插入第二张表
		$Datas['userid']  = $result;
		$user_school      = M('common_user_member');
		$user_school->delete("userid=$Datas[userid]");
		$user_school->doEfAdd($Datas);
		//注册后直接登录
		if(1){
			$lastlogintime = time();
			$lastloginip   = $_SERVER['REMOTE_ADDR'];
			$GLOBALS['db']->execSql("UPDATE `$usersModel->table` SET `lastlogintime`='$lastlogintime', `lastloginip`='$lastloginip', `logintimes`=logintimes+1 WHERE userid=$result");
			//把一些基本信息放入session
			$userinfo['userid']   = $result;
			$userinfo['username'] = $Data['username'];
			$userinfo['usertype'] = $Data['usertype'];
			$userinfo['wxid']     = $Data['wxid'];//网校id
			putsession('member',$userinfo);
			KS_INFO("<script>parent.regSuccessBack('注册成功');</script>",-1);
		}else{
		    KS_INFO("<script>parent.regSuccessBack('注册成功');</script>",-1);
		}
     }
     //信息完善
	 public function doaddinfoAction(){}
	 //QQ登录返回
	 public function apiloginbackAction(){
		echo '登录成功，还没记录session';exit;
	 }
	 //QQ登录界面
	 public function apiloginAction(){
		$id = ChkClng(KS_G('request.id'));
		$loginconf = $this->cache->GetH('loginconf','id',$id,'',$GLOBALS['_DoM']['wxid'],true);//取出缓存
		if(empty($loginconf)){KS_INFO('操作失误',4);}
        $apiID = $loginconf['apiID'];
        $redirect_uri = urlencode('http://'.APP_DOMAIN.M_URL('home','apiloginback'));
        $url = "https://graph.qq.com/oauth/show?which=Login&display=pc&response_type=code&client_id=".$apiID."&redirect_uri=".$redirect_uri."&state=565&scope=get_user_info,get_info";
        ks_header($url);
     }	 
	 //进入收藏界面
	 public function favoritesAction(){
		check_login($this->memberinfo);//检查是登录权限 
		$option = null !==GF('option') ? GF('option'):0;
		//状态筛选
		if($option==0){$where = 'where (paystatus=0 or paystatus=1)';}
		elseif($option==1){$where = 'where paystatus=1';}
		elseif($option==2){$where = 'where paystatus=1';}
		elseif($option==3){$where = 'where paystatus=0';}
		elseif($option==4){$where = 'where paystatus=1';}
		elseif($option==5){$where = 'where paystatus=0';}
		$this->assign('option',$option);
        $this->display('home/favorites.html');
     }
     //进入收藏界面
	 public function mypathAction(){
		$id    = ChkClng(KS_G('request.id'));
		if(empty($id)){'没有该页';exit;}
        $this->display('other/myhtml'.$id.'.html');
    }
    //小课堂首页
	public function classAction(){
		check_login($this->memberinfo);//检查是登录权限
        $this->display('class.html',1);
    } 
    //科汛V名师关于我们
	public function aboutAction(){
        $this->display('about/index.html');
    } 
}