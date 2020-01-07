<?php
// +----------------------------------------------------------------------
// | KesionPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2019 https://www.kesion.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 厦门科汛软件有限公司　 版权所有 © 2006-2017
// +----------------------------------------------------------------------
// | Advice: 好的编程习惯是成功的一半，对齐，注释  你可以的！
// +----------------------------------------------------------------------



use Kesion\Controller;
class WeChatController extends CommonController
{
	//帮助中心
    public function IndexAction(){


     }
     //个人中心
     public function userindexAction(){
     	include CURR_VIEW_PATH . "WeChat/userindex.php";
     }
     //选择微门户
     public function ChooseAction(){
     	include CURR_VIEW_PATH . "WeChat/Choose.php";
     }
     //招生秀
     public function admissionsShowAction(){
        include  CURR_VIEW_PATH . "WeChat/admissionsShow.php";
     }
     //bannerset设置
     public function bannersetAction(){
        include  CURR_VIEW_PATH . "WeChat/bannerset.php";
     }
     /*微门户管理页*/
     public function gatewaylistAction(){
        include  CURR_VIEW_PATH . "WeChat/gatewaylist.php";
     }
     //
     public function MiindexAction(){
     	putsession('member',null);
     	echo '<script>window.location.href =" https://'.APP_DOMAIN.'/h5market/Miindex?redirect=teacher";</script>';
     }
      /* 签到相关控制器开始 */
     //签到
    public function signinAction(){

    	 include  CURR_VIEW_PATH . "WeChat/signin.php";
    }
    //上课签到创建
    public function signinstausAction(){
	    $classroomModel = M('app_class');
	    $AppModel  = M('common_user_teacher');
		$where     =' where wxid='.$this->wxid;
		$classinfo = $classroomModel->getRow($where.' and classid='.KS_G('get.classid'));
		$name      = $AppModel->getOne('name','where userid='.$classinfo['teacherid']);
		$ClassModel         = M('App/ClassModel');
	    $Data001['wxid']    = $this->wxid;
	    $Data001['classid'] = ChkClng(KS_G('get.classid'));
	    $schedule      =$ClassModel->getSchedule($Data001,1);
	    $str = '';
	    $staus = 0;
	   foreach($schedule['values'] as $k =>$v){
	    	if(!empty(KS_G('get.scheduleid'))){
	    		if($v['id'] == KS_G('get.scheduleid')){
	    			$str .= '<option value ="'.$v['id'].'">'.date('Y-m-d H:i',$v['timeSlotStart']).'-'.date('H:i',$v['timeSlotEnd']).'&nbsp;&nbsp;&nbsp;'.$v['title'].'</option>';
	   			}
	    	}else{
	    		$str .= '<option value ="'.$v['id'].'">'.date('Y-m-d H:i',$v['timeSlotStart']).'-'.date('H:i',$v['timeSlotEnd']).'&nbsp;&nbsp;&nbsp;'.$v['title'].'</option>';
	    	}
	    }
     	include  CURR_VIEW_PATH . "WeChat/signinstaus.php";
    }
    //do
    public function doaddsigninstausAction(){
     	$url                   = M_URL('WeChat','signin');
     	$Data007['class']      = '';
	    $Data007['classid']    = ChkClng(KS_G('post.classid'));
	    $Data007['wxid']       = $this->wxid;
	    $Data007['userid']     = $this->userid;
	    $Data007['name']       = $this->userinfo['name'];
	    $Data007['scheduleid'] = ChkClng(KS_G('post.scheduleid'));
	    $Data007['wx']         = 1;
	    if($Data007['scheduleid']==0){
	    	echo "<script>alert('请选择课时');history.go(-1)</script>";exit;
	    }
		$ClassModel         = M('App/ClassModel');
		$ClassModel->doAddSign($Data007);
		echo "<script>alert('签到成功');window.location.href='".$url."'</script>";
    }
    //编辑签到
    public function editsigninstausAction(){
	    $classroomModel = M('app_class');
	    $AppModel = M('common_user_teacher');
		$where =' where wxid='.$this->wxid;
		$classinfo = $classroomModel->getRow($where.' and classid='.KS_G('get.classid'));
		$name = $AppModel->getOne('name','where userid='.$classinfo['teacherid']);
		$ClassModel         = M('App/ClassModel');
	    $Data001['wxid']    = $this->wxid;
	    $Data001['classid'] = ChkClng(KS_G('get.classid'));
	    $schedule      =$ClassModel->getSchedule($Data001,1);
	    $str = '';
	    foreach($schedule['values'] as $k =>$v){
	    	if(!empty(KS_G('get.scheduleid'))){
	    		if($v['id'] == KS_G('get.scheduleid')){
	    			$str .= '<option value ="'.$v['id'].'">'.date('Y-m-d H:i',$v['timeSlotStart']).'-'.date('H:i',$v['timeSlotEnd']).'&nbsp;&nbsp;&nbsp;'.$v['title'].'</option>';
	   			}
	    	}else{
	    		$str .= '<option value ="'.$v['id'].'">'.date('Y-m-d H:i',$v['timeSlotStart']).'-'.date('H:i',$v['timeSlotEnd']).'&nbsp;&nbsp;&nbsp;'.$v['title'].'</option>';
	    	}

	    }
	    $staus = 1;
     	include  CURR_VIEW_PATH . "WeChat/signinstaus.php";
    }
    //do
    public function doeditsigninstausAction(){
    	$url     = M_URL('WeChat','signin');
	    $classid = ChkClng(KS_G('post.classid'));
	    $signid  = ChkClng(KS_G('post.signid'));
		$userid  = $_POST['userid'];
		$staus   = $_POST['staus'];
		$remake  = $_POST['remake'];
		if(empty($userid)){
			echo "<script>alert('非法数据包');history.go(-1)</script>";exit;
		}
		$signRecondModel    = M('app_class_sign_record');
		$IndexModel         = M('Application/IndexModel');
		foreach($userid as $k=>$v){
			$Datas['status']   = $staus[$k];
			$Datas['remake']   =$remake[$k];
			$signRecondModel->update($Datas,'classid='.$classid.' and signid='.$signid.' and memberid='.$v);
			//发送签到----只发送微信和站内信
			$Data2['type']       = 4;
			$Data2['modelname']  = 'Signclass';
			$Data2['date']       ='老师修改了你的签到状态';
			$Data2['memberid']   = $v;
			if($Datas['status']==1){$Data2['content'] ='签到';
		    }elseif($Datas['status']==2){$Data2['content'] ='请假';
		    }elseif($Datas['status']==3){$Data2['content'] ='旷课';
			}elseif($Datas['status']==4){$Data2['content'] ='补课';}
			$messagetype        = array('0'=>'3','1'=>'4');
			$IndexModel    ->SendEx($messagetype,$Data2,$userid);
		}
		echo "<script>alert('修改成功');history.go(-2)</script>";
    }
    //历史记录-签到列表
    public function signinlstAction(){
     	include  CURR_VIEW_PATH . "WeChat/signinlst.php";
    }
    //历史记录-签到详情
    public function signininfoAction(){
     	$classroomModel = M('app_class');
	    $AppModel = M('common_user_teacher');
		$where =' where wxid='.$this->wxid;
		$classinfo = $classroomModel->getRow($where.' and classid='.KS_G('get.classid'));
		$name = $AppModel->getOne('name','where userid='.$classinfo['teacherid']);
		$ClassModel         = M('App/ClassModel');
	    $Data001['wxid']    = $this->wxid;
	    $Data001['classid'] = KS_G('get.classid');
	    $schedule      =$ClassModel->getSchedule($Data001,1);
	    $str = '';
	   	foreach($schedule['values'] as $k =>$v){
	    	if(!empty(KS_G('get.scheduleid'))){
	    		if($v['id'] == KS_G('get.scheduleid')){
	    			$str .= '<option value ="'.$v['id'].'">'.date('Y-m-d H:i',$v['timeSlotStart']).'-'.date('H:i',$v['timeSlotEnd']).'&nbsp;&nbsp;&nbsp;'.$v['title'].'</option>';
	   			}
	    	}else{
	    		$str .= '<option value ="'.$v['id'].'">'.date('Y-m-d H:i',$v['timeSlotStart']).'-'.date('H:i',$v['timeSlotEnd']).'&nbsp;&nbsp;&nbsp;'.$v['title'].'</option>';
	    	}

	    }
     	include  CURR_VIEW_PATH . "WeChat/signininfo.php";
    }
    /* 签到相关控制器结束 */
    //查看活动方案详情
    public function schemeinfoAction(){
        include  CURR_VIEW_PATH . "WeChat/schemeinfo.php";
    }
    //意向通
    public function intentionAction(){
        include  CURR_VIEW_PATH . "WeChat/intention.php";
    }
    //详情页
    public function intentDetailAction(){
        include  CURR_VIEW_PATH . "WeChat/indentDetail.php";
    }
    //创建H5
    public function createH5Action(){
     	$staus = 0;$id = ChkClng(KS_G("get.id"));//接受用户需要创建的活动ID
		$app_h5_market = M('app_h5_market');
		$h5            = $app_h5_market->getRow('where id ='.$id);
		$flag = 0;$flagnum = 0;$str = '免费活动，不限制次数使用';
		if($h5['marketing'] == 1){
			//这时候是收费模式的H5，先去订单表查询是否有这个东西
			$order = M('common_order_info');
			$infos = $order->getAll('where wxid='.$this->wxid.' and type =5 and paystatus=1');
			foreach($infos as $key =>$v){
				if($v['appid'] = $id){$flag++;$flagnum = $v['number'];}
			}
			if($flag ==0){KS_INFO ('对不起你没购买该活动');
			}else{
				if($flagnum <=0){KS_INFO ('对不起你可使用次数不足，请充值');exit;}
			}
			$str = '剩余使用次数:'.$flagnum;
		}elseif($h5['marketing'] == 2){
			$website           = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);
        	$package           = $website['package'];
        	if($package<$h5['package']){
        		KS_INFO ('对不起你的套餐等级不足，请先升级套餐');
        	}else{
        		$str = $h5['package'].'以上用户免费使用';
        	}
		}
		//分割规则，奖励规则由后台录入数据库控制,XML为基础规则
		$reward = explode('|',$h5['reward']);
		//通过XML文件读取活动配置
		$xml_array=simplexml_load_file(ROOT.$h5['xml']);
		//拆分内容一下 由于XML admin 是写入数据库的所以无视只要home下的内容
		$home = $xml_array->home;
		$gy = $home->gy;//获取相关功能介绍
		$zd = $home->zd;//活动需要的字段；
		//读取完毕，加载页面，对页面进行填充！，这里需要封装一个方法来判断input框是什么类型
		$rewards = array();
		$rewardNumber  = array();
		$Rsetting = array();
        include  CURR_VIEW_PATH . "WeChat/createH5.php";
    }
    //意向通任务
    public function taskAction(){
        include  CURR_VIEW_PATH . "WeChat/task.php";
    }
    //咨询统计
    public function intentcountAction(){
        include  CURR_VIEW_PATH . "WeChat/intentcount.php";
    }
    //咨询池
    public function intentpoundAction(){
        include  CURR_VIEW_PATH . "WeChat/intentpound.php";
    }
    //渠道
    public function channelAction(){
        include  CURR_VIEW_PATH . "WeChat/channel.php";
    }

	public function chooseloginAction(){
		echo '你有多个账号，选择绑定';exit;
	}

	public function loginAction(){
		$actindex = ChkSQL(KS_G('get.actindex'));
		$openId   = '';
		if(empty($actindex)){$actindex = 'Index';}
		if(getsession('wxuser')){
		    $openId    = isset(getsession('wxuser')->openid)?getsession('wxuser')->openid:'';
		    $unionid   = isset(getsession('wxuser')->unionid)?getsession('wxuser')->unionid:'';
		}else{
			$openId    = ChkSQL(KS_G('get.openid'));
			$unionid   = ChkSQL(KS_G('get.unionid'));
		}
		$wxopenId = ChkSQL(KS_G('get.wxopenid'));
	    $h5token  = ChkSQL(KS_G('get.token'));
    	if(!empty($h5token)){
			$UserMode = M('common_user');
			//.' and wxid='.$GLOBALS['_DoM']['wxid']
			$info     = $UserMode->getRow('where h5token="'.$h5token.'" and tokentime>'.time());
			//var_dump($info);exit;
			if(!empty($info)){
				$userinfo['userid']   = $info['userid'];
				$userinfo['username'] = $info['username'];
				$userinfo['usertype'] = $info['usertype'];
				$userinfo['wxid']     = $info['wxid'];//网校id
				$userinfo['openid']   = $info['openid'];//网校id
				putsession('user',$userinfo);
				$flag                 = 1;
			}else{$flag=0;}
		}else{
			if(getsession('user')){$flag   = 1;}else{$flag = 0;}
    		if(getsession('member')){$flag = 2;}
    		if(getsession('parent')){$flag = 3;}
    		//var_dump($flag);exit;
		}
	    if($flag==0){
	    	if(!isMobile()){
	    		echo "<script>location.href='https://".APP_DOMAIN."/h5market/wechatlogin'</script>";
	    	}
		     $websiteinfo  =  $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);
		     $logo         = isset($websiteinfo['logo'])?$websiteinfo['logo']:$websiteinfo['wilogo'];
			 include  CURR_VIEW_PATH . "newPoplogin.php";
		}else{
			if($flag==1){
				echo "<script>location.href='".M_URL('WeChat','index')."'</script>";
			}elseif($flag==2){
				echo "<script>location.href='https://".APP_DOMAIN."/h5market/index'</script>";
			}else{
				echo "<script>location.href='https://".APP_DOMAIN."/h5market/pindex'</script>";
			}
		}
	}
	//home端登录
	public function siginAction(){
		$username   = ChkSQL(KS_G('post.username'));
		$password   = ChkSQL(KS_G('post.password'));
		$unionid    = ChkSQL(KS_G('request.unionid'));
		$openid     = ChkSQL(KS_G('request.wxopenid'));


        $usersModel = M('common_user');
		$base       = $this->cache->GetACache('setting');//读出缓存
		$user       = $usersModel->getRow("WHERE mobile='$username' and powertype!=0 and usertype!=0 limit 1",'password,rndpasswordc,usertype,userid,username,status,wxid,email,openid,wxopenid');
		if(!$user){$user = $usersModel->getRow("WHERE  username='$username' and mobilebing=1 and powertype!=0 and usertype!=0 limit 1",'password,username,rndpasswordc,usertype,userid,status,wxid,mobilebing,openid,wxopenid');}
		if(!$user){echo '{"errcode":"10001"}';exit;
	    }elseif($user['status']==2){echo '{"errcode":"10002"}';exit;
	   	}elseif($user['status']==0){echo '{"errcode":"10003"}';exit;}
		if($user['password']==KS_MD5($password.KS_MD5($user['rndpasswordc']))){
			$lastlogintime = time();
			$lastloginip   = $_SERVER['REMOTE_ADDR'];
			$GLOBALS['db']->execSql("UPDATE `$usersModel->table` SET `lastlogintime`='$lastlogintime', `lastloginip`='$lastloginip', `logintimes`=logintimes+1 WHERE userid=$user[userid]");
			if (!empty($unionid)){
    			$param="unionid='".$unionid."'";
    		}else{
    			$param="openid='".$openid."'";
    		}
			$usernum = $usersModel->getOne('count(userid)','where '.$param.' and (usertype=1 or usertype=2) and wechatbing=1');
			$Datas['h5token']    = '';
			$Datas['openid']     = null !==KS_G('post.openid') ? KS_G('post.openid'):null; // 防止数据库出现0这个数据
			$Datas['unionid']    = null !==KS_G('post.unionid') ? KS_G('post.unionid'):null; // 防止数据库出现0这个数据
			$Datas['wxopenid']   = null !==KS_G('post.wxopenid') ? KS_G('post.wxopenid'):null; // 防止数据库出现0这个数据

			if(!empty($usernum)){
			     //exit("<script>top.location.href='https://649521685.kesion.com/h5market/wechatlogin?from1=teacher&token=5b6bc2b19d4e0c670a2624b8da547e6f'</script>");
				 echo '{"errcode":"10010","msg":"该微信已经绑定相关账号"}';exit;
			}else{
				if(empty($user['openid'])||$user['openid']!=KS_G('post.openid')){
					$Datas['openid']     = null !==KS_G('post.openid') ? KS_G('post.openid'):null; // 防止数据库出现0这个数据
					if(empty($Datas['openid'])){$Datas['openid'] = KS_G('post.wxopenid');}
					if(empty($Datas['openid'])){$Datas['openid'] = null;}
					$userinfo['openid']  = $Datas['openid'];// 防止数据库出现0这个数据
					$Datas['h5token']    = KS_MD5(time().KS_G('post.wxopenid'));
				}elseif(empty($user['wxopenid'])){
					$Datas['wxopenid']   = null !==KS_G('post.wxopenid') ? KS_G('post.wxopenid'):null;// 防止数据库出现0这个数据
					if(empty($Datas['wxopenid'])){$Datas['wxopenid'] = null;}
					$userinfo['wxopenid']  = $Datas['wxopenid'];// 防止数据库出现0这个数据
					$Datas['h5token']    = KS_MD5(time().KS_G('post.wxopenid'));
				}else{
					$Datas['h5token']    = KS_MD5(time().$user['userid']);
				}
       		}
        	$userinfo['openid']       = $user['openid'];
        	$userinfo['wxopenid']     = $user['wxopenid'];
        	$userinfo['wechatbing']   = 1;
	        $Datas['tokentime']    = (time() +7200);
			$Datas['wechatbing']   = 1;
        	$usersModel->update($Datas,'userid='.$user['userid']);
			$userinfo['userid']   = $user['userid'];
			$userinfo['username'] = $user['username'];
			$userinfo['usertype'] = $user['usertype'];
			$userinfo['wxid']     = $user['wxid'];//网校id
			$Data001['userid']    = $user['userid'];
			$Data001['wxid']      = $user['wxid'];
			$Data001['type']      = 0;
			$LoginModel   =  M('Application/LoginModel');$LoginModel->loginlog($Data001);//登记登录用户信息
			$mydomain     = MY_FULLDOMAIN.'';
			$domains      = $this->cache->GetA('domaininfo','wxid',$userinfo['wxid']);
			if(!empty($domains)){
				if($domains[0]['status']==2){
					$mydomain = $domains[0]['predomain'];
					if(empty($domain) || $domain =='localhost'){
						$mydomain = $domains[0]['domain'];
					}
				}else{
					$mydomain = $domains[0]['domain'];
				}
			}
			if($mydomain == APP_DOMAIN){
				putsession('user',$userinfo);
			}
			//$mydomain      = $this->cache->GetA('domaininfo','wxid',$userinfo['wxid'],'',true);
			//域名为空，有问题，，删除所有，回去
			if(empty($mydomain)){
				cookie('indoor',null); // 清空当前设定前缀的所有cookie值
                putsession('user',null);
                echo '{"errcode":"10009"}';exit;
			}
			echo '{"succeed":"10001","id":"'.$user['userid'].'","token":"'.$Datas['h5token'].'","domain":"'.$mydomain.'"}';
		}else{
			echo '{"errcode":"10008","msg":"密码有误"}';exit;
	    }
    }

    //找回密码
    public function getPassAction(){
    	$openId   = ChkSQL(KS_G('request.openid'));
    	$actindex = ChkSQL(KS_G('request.actindex'));
    	$wxopenId = ChkSQL(KS_G('request.wxopenid'));
    	$unionid  = ChkSQL(KS_G('request.unionid'));
    	include  CURR_VIEW_PATH . "newgetPass.php";
    }
    /*学员管理相关开始   */
    //学员管理
	public function stuadminAction(){
		include  CURR_VIEW_PATH . "WeChat/stuadmin.php";
	}
	//学员详情
	public function stuinfoAction(){
		//获取userid
		$userid     = ChkClng(KS_G('request.userid'));
		$usertype   = 0;
		$tablename  = 'common_user_member';
		if(empty($userid)){echo '<script>alert("id不能为空");history.go(-1);';}
		$Data005['wxid']       = $this->wxid;
		$Data005['AppModel']   = $tablename;
		$Data005['usertype']   = $usertype;
		$Data005['userid']     = $userid;
		$UsersModel            = M('App/UsersModel');
		$result                = $UsersModel->edituser($Data005);
		$userinfo              = $result['userinfo'];
		$link                  = $result['link'];
		$schoolAry             = $result['schoolAry'];
		$province              = $this->cache->GetA('areainfo','id',$userinfo['provinceid'],'city');
		$province              = $province?$province:'';
		$city                  = $this->cache->GetA('areainfo','id',$userinfo['cityid'],'city');
		$city                  = $city?$city:'';
		$county                = $this->cache->GetA('areainfo','id',$userinfo['countyid'],'city');
		$county                = $county?$county:'';
		$userinfo['taddress']  = $province.$city.$county?$province.$city.$county:'未完善';
		include  CURR_VIEW_PATH . "WeChat/stuinfo.php";
	}
	//学员添加
	public function stuinfoaddAction(){
		$usertype = null !==GF('usertype') ? GF('usertype'):'0';
		$tableModel = M('common_table');
		if($usertype == 0){
		    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
		}elseif($usertype == 1){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
		}elseif($usertype == 2){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_school'");
		}
		$Linkage            = Linkage(array());
		$Linkage->cachename = 'appcategory';
		$Linkage->wxid      = $this->wxid;
		$Linkage->inputname = 'categoryid';// <select name='' /> 里的name值

		$link     = Linkage(array());
		$link->cachename      = 'areainfo';
		$link->inputname      = 'areaid';// <select name='' /> 里的name值
		$link->idname         = 'id';
		$link->funcname       = 'getchildtwo';
		$link->childvaluename = 'city';
		$link->childidname    = 'id';
		$schoolModel = M('app_schooladdress');
		$schoolAry   = $schoolModel->getAll('where wxid='.$this->wxid);
		$userinfo = '';
		include  CURR_VIEW_PATH . "WeChat/stuinfo_add.php";
	}
	//do
	public function dostuinfoaddAction(){
		$Data001['wxid']       = $this->wxid;
		$Data001['userid']     = $this->userid;
		$Data001['type']       = 1;
		$UsersModel            = M('App/UsersModel');
		$result                = $UsersModel->doaddUsers($Data001);
		echo '<script>alert("添加完成");history.go(-2);</script>';
	}
	//学员编辑
	public function stuinfoeditAction(){
		$userid   = ChkClng(KS_G('request.userid'));
		$usertype = 0;
		$tablename = 'common_user_member';
		if(empty($userid)){echo '<script>alert("id不能为空");history.go(-1);';}
		$Data005['wxid']=$this->wxid;
		$Data005['AppModel']   =$tablename;
		$Data005['usertype']    =$usertype;
		$Data005['userid']    =$userid;
		$UsersModel            = M('App/UsersModel');
		$result                = $UsersModel->edituser($Data005);

		$userinfo              =$result['userinfo'];
		$link                  =$result['link'];
		$schoolAry             =$result['schoolAry'];
		include  CURR_VIEW_PATH . "WeChat/stuinfo_edit.php";
	}
	//do
	public function dostuinfoeditAction(){
		$this->AppModel = M('common_user_member');
		$this->userModel = M('common_user');
		$userid =  ChkClng(KS_G('request.id'));
		if(empty($userid)){echo '<script>alert("id不能为空");history.go(-1);</script>';exit;}
		if(!empty(KS_G('post.password'))){
			 $Data['rndpasswordc'] = rand(100000,999999);
			 $Data['password']     = KS_MD5(ChkSQL(KS_G('post.password')).KS_MD5($Data['rndpasswordc']));
		}
//		$Data['email']               = ChkSQL(KS_G('post.email'));
		if(!empty(KS_G('post.mobile'))){$Data['mobile']     = ChkSQL(KS_G('post.mobile'));}

		$Data['powertype']  = ChkClng(KS_G('post.powertype'));
		if(!empty($_FILES['defaultpic']['tmp_name'])){
			$dir1               = $_FILES['defaultpic']['tmp_name'];
	        $dir2               = ROOT.'Images/users/'.$userid.'/'.KS_MD5($userid).'.jpg';
			$this->File->unlinkFile($dir2);
			$this->File->copyFile($dir1,$dir2);
		}
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
		$usertype    = ChkClng(KS_S('usertype',3));
		$tableModel  = M('common_table');
		$Datas['schoolid']                 = ChkSQL(KS_G('post.schoolid'));
	    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
	    $Datas['Sex']                 = ChkSQL(KS_G('post.Sex'));
	    $Datas['birthday']            = strtotime(KS_G('post.birthday'));//出生日期
	    $Datas['emergencyContact']    = ChkSQL(KS_G('post.emergencyContact'));//紧急联系人
	    $Datas['emergencyContactTel'] = ChkSQL(KS_G('post.emergencyContactTel'));//紧急联系人电话
		$Datas['name'] = ChkSQL(KS_G('post.name'));
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
	    echo "<script>alert('修改成功');history.go(-2)</script>;";
	}
	public function  stuinfoorderAction(){
		$id  = ChkClng(KS_G('get.userid'));
		$this->userModel = M('common_user');
		$this->AppModel  = M('common_user_member');
		$userinfo    = $this->userModel->getRow('where userid ='.$id.' and wxid='.$this->wxid.' limit 1');
		$userinfo2   = $this->AppModel->getRow('where userid ='.$id.' limit 1');
		include  CURR_VIEW_PATH . "WeChat/stuinfo_order.php";

	}
	public function stupapeclassAction(){
		include CURR_VIEW_PATH.'WeChat/stupapeclass.php';
	}
	//报班信息
	public function stuinfoclassAction(){
		$classid = ChkClng(KS_G('get.classid'));
		$userid  = ChkClng(KS_G('get.userid'));
		include  CURR_VIEW_PATH . "WeChat/stuinfo_class.php";
	}
	/*学员管理相关结束   */
	//我的课表
	public function myCourseAction(){
		$classid = ChkClng(KS_G('get.classid'));
		include  CURR_VIEW_PATH . "WeChat/myCourse.php";
	}
	//记上课
	public function remcourseAction(){
		include  CURR_VIEW_PATH . "WeChat/remcourse.php";
	}
	//已记上课
	public function edcourseAction(){
		include CURR_VIEW_PATH ."WeChat/edcourse.php";
	}
	//课时结算列表页面
	public function settleAction(){
		include CURR_VIEW_PATH ."WeChat/settle.php";
	}
	//课时结算页面
	public function settleinAction(){
		include CURR_VIEW_PATH ."WeChat/settlein.php";
	}
	//显示表单--------测试用
	public function formAction(){
		include CURR_VIEW_PATH ."WeChat/form.php";
	}
	public function orderAction(){
		include CURR_VIEW_PATH ."WeChat/order.php";
	}
	public function orderdetailAction(){
		include CURR_VIEW_PATH ."WeChat/orderdetail.php";
	}
	/******班级相关****/
	//班级首页
	public function classminindexAction(){
		include CURR_VIEW_PATH ."WeChat/classmin_index.php";
	}
	//班级创建
	public function classmincreatAction(){
		include CURR_VIEW_PATH ."WeChat/classmin_creat.php";
	}
	//选择教师
	public function classmincsteacherAction(){
		include CURR_VIEW_PATH."WeChat/classmin_csteacher.php";
	}
	//班级课表
	public function classmintableAction(){
		include CURR_VIEW_PATH."WeChat/classmin_table.php";
	}
	//do
	public function doclassaddAction(){
		$this->AppModel       = M('app_class');
		$Data['title']        = ChkSQL(KS_G("post.title"));
		$Data['userid']       = $this->userid;
		$Data['wxid']         = $this->wxid;
		$Data['classType']    = ChkClng(KS_G('post.classType'));
		$Data['classlevel']   = ChkClng(KS_G("post.classlevel"));
		if($Data['classlevel']==2){
			$Data['studentcount']=1;
			$Data['defaultpic']=MY_FULLDOMAIN.'/Images/admin/classlevel2.jpg';

			$count           = $this->AppModel->getOne('count(*)','where  wxid='.$this->wxid.' and  classlevel=2  and  status != -1 ');
			$num=wx_version_itemvalue(25,'',2);
			if($count>=$num){
			    echo '<script>alert("添加失败。当前套餐允许添加一对一'.$num.'班,请升级套餐。网校已有一对一'.$count.'人");history.go(-1);</script>';
			}
		}elseif($Data['classlevel']==1){
			$Data['defaultpic']=MY_FULLDOMAIN.'/Images/admin/classlevel1.jpg';

			$count           = $this->AppModel->getOne('count(*)','where  wxid='.$this->wxid.' and  classlevel=1  and  status != -1 ');
			$num=wx_version_itemvalue(26,'',2);
			if($count>=$num){
			    echo '<script>alert("添加失败。当前套餐允许添加小班'.$num.'班,请升级套餐。网校已有小班'.$count.'人");history.go(-1);</script>';
			}
		}elseif($Data['classlevel']==0){
			$Data['defaultpic']=MY_FULLDOMAIN.'/Images/admin/classlevel0.jpg';
			$count           = $this->AppModel->getOne('count(*)','where  wxid='.$this->wxid.' and  classlevel=0  and  status != -1 ');
			$num=wx_version_itemvalue(27,'',2);
			if($count>=$num){
			    echo '<script>alert("添加失败。当前套餐允许添加大班'.$num.'班,请升级套餐。网校已有大班'.$count.'人");history.go(-1);</script>';
			}
		}
		if(empty($Data['title'])){
			echo '<script>alert("标题不能为空");history.go(-1);</script>';
		}
		$Data['adddate']      = time();
		$Data['status']       = 0;
		$Data['chargeData']   = ChkClng(KS_G('post.chargeData'));
		$Data['teacherid']    = ChkClng(KS_G('post.teacherid'));
		$Data['price']        = ChkSQL(KS_G('post.price'));
		$Data['hourunit']     = ChkSQL(KS_G('post.hourunit'));
		$Data['studentcount'] = ChkSQL(KS_G('post.studentcount'));
		$courseid=$this->AppModel->doadd($Data,'classid');
		echo '<script>alert("添加成功");history.go(-2);</script>';
	}
	/******班级相关****/
	/*--------------------测试页面----------------------*/
	public function plugtestAction(){
		include CURR_VIEW_PATH."WeChat/plugtest.php";
	}
	/*---------------------微门户设置一系列页面---------------------------------------------*/
	//微门户课程管理
	public function gateCourseAction(){
	    if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')){
			$moblie = 'iPhone';
		}else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
			$moblie = 'Android';
		}else{
			$moblie = 'Android';
		}
		$courseType = null!=GF('request.coursetype') ? KS_G('request.coursetype'):1;
		// var_dump($courseType);
		$websiteModel = M('common_user_website');
		$this->websiteInfo = $websiteModel->getRow('where wxid='.$this->wxid);
		if($this->websiteInfo['wititle']){}else{$this->websiteInfo['wititle'] = $this->websiteInfo['seotitle'];}


		include CURR_VIEW_PATH."WeChat/gateCourse.php";
	}
	/** 微门户班级管理*/
	public function gateClassAction(){
		$websiteModel = M('common_user_website');
		$this->websiteInfo = $websiteModel->getRow('where wxid='.$this->wxid);
		if($this->websiteInfo['wititle']){}else{$this->websiteInfo['wititle'] = $this->websiteInfo['seotitle'];}
		include CURR_VIEW_PATH."WeChat/gateClass.php";
	}
	/** 微门户咨询管理*/
	public function gateNewsAction(){
		$websiteModel = M('common_user_website');
		$this->websiteInfo = $websiteModel->getRow('where wxid='.$this->wxid);
		if($this->websiteInfo['wititle']){}else{$this->websiteInfo['wititle'] = $this->websiteInfo['seotitle'];}
		include CURR_VIEW_PATH."WeChat/gateNews.php";
	}
	/** 微门户风格管理*/
	public function gateStyleAction(){
		include CURR_VIEW_PATH."WeChat/gateStyle.php";
	}
	/* * 微门户设置页面*/
	public function gatesetAction(){
		$websiteModel = M('common_user_website');
		$this->websiteInfo = $websiteModel->getRow('where wxid='.$this->wxid);
		if($this->websiteInfo['wititle']){}else{$this->websiteInfo['wititle'] = $this->websiteInfo['seotitle'];}
		$wxid = $this->wxid;
		include CURR_VIEW_PATH."WeChat/gateset.php";
	}
	/*教务管理列表页面*/
	public function teachingAction(){
		$wxid = $this->wxid;
		include CURR_VIEW_PATH."WeChat/teaching.php";
	}
	/*营销列表页面*/
	public function marketingAction(){
		$wxid = $this->wxid;
		include CURR_VIEW_PATH."WeChat/marketing.php";
	}
	/*修该课程页面*/
	public function gateeditcourseAction(){
		$wxid = $this->wxid;
		include CURR_VIEW_PATH."WeChat/gateeditcourse.php";
	}
	/*添加课程页面*/
	public function addcourseAction(){
		$this->wxid = $this->wxid;
		$interfaceModel = M('common_managevdo');
		$interfaceid    = $interfaceModel->getOne('id','where type = 1 and isdefault = 0 limit 1' );
		include CURR_VIEW_PATH."WeChat/addcourse.php";
	}
	public function addclassAction(){
		include CURR_VIEW_PATH."WeChat/addclass.php";
	}
	public function gateeditclassAction(){
		$wxid = $this->wxid;
		include CURR_VIEW_PATH."WeChat/gateeditclass.php";
	}
	public function editNewsAction(){
		$id = KS_G('request.id');
		if($id){}else{$id=0;}
		include CURR_VIEW_PATH."WeChat/gateNews_add.php";
	}
	public function campusAction(){
		$id = KS_G('request.id');
		if($id){}else{$id=0;}
		include CURR_VIEW_PATH."WeChat/campus.html";
	}
	public function editcampusAction(){
		$schoolModel=M('app_schooladdress');
		$id      = ChkClng(KS_G("get.id"));
		if($id){
			$school=$schoolModel->getRow(' where schoolid='.$id.' limit 1');
		}
		include CURR_VIEW_PATH."WeChat/editcampus.php";
	}
	public function saveEditAction(){
		$id      = ChkClng(KS_G("get.id"));
		echo '<script src="'.UOOT.'Public/common/js/jquery.js"></script>';
		echo '<script src="'.UOOT.'Public/common/js/common.js"></script>';
		echo '<script src="'.UOOT.'Public/common/js/module.js?<?php echo echoHash();?>"></script>';
		$schoolModel=M('app_schooladdress');
        $Data['wxid']     = $this->wxid;
        $Data['name']     = ChkSQL(KS_G('post.name'));
		$Data['tel']      = ChkClng(KS_G("post.tel"));
		$Data['address']  = ChkSQL(KS_G('post.address'));
		$Data['school']  = ChkSQL(KS_G('post.school'));
		$url2      =  M_URL('WeChat','editcampus');
	  	$schoolModel->update($Data,'schoolid='.$id);
		$url      =  M_URL('WeChat','campus');
		KS_INFO("修改成功",3,$url);
	}
	public function doAddschoolAction(){
		echo '<script src="'.UOOT.'Public/common/js/jquery.js"></script>';
		echo '<script src="'.UOOT.'Public/common/js/common.js"></script>';
		echo '<script src="'.UOOT.'Public/common/js/module.js?<?php echo echoHash();?>"></script>';
		echo '<script src="'.UOOT.'Public/wechat/js/microportal/current.js"></script>';
		$schoolModel=M('app_schooladdress');
        $Data['wxid']     = $this->wxid;
        $Data['name']     = ChkSQL(KS_G('post.name'));
		$Data['tel']      = ChkClng(KS_G("post.tel"));
		$Data['address']  = ChkSQL(KS_G('post.address'));
		$Data['school']  = ChkSQL(KS_G('post.school'));
	  	$schoolModel->doAdd($Data,'schoolid');
		$url      =  M_URL('WeChat','campus');
		KS_INFO("添加成功",3,$url);
	}
	public function voucherAction(){
		$id = KS_G('request.id');
		if($id){}else{$id=0;}
		include CURR_VIEW_PATH."WeChat/voucher.html";
	}
	//优惠券
	public function myvoucherAction(){
		include CURR_VIEW_PATH.'WeChat/myvoucher.html';
	}
    //优惠券
	public function voucherdetailAction(){
		include CURR_VIEW_PATH.'WeChat/voucherdetail.html';
	}
	//优惠券
	public function editvoucherAction(){
		include CURR_VIEW_PATH.'WeChat/editvoucher.html';
	}
	//发放代课卷
	public function saveVoucherAction(){
		$ids = KS_G('post.ids');
		if(empty($ids)){echo '<script>alert("请选择一个学员");history.go(-1);</script>';exit;}
		$ids                   = explode(',', $ids);
		$Model                 = M('app_voucher');
		$IndexModel            = M('Application/IndexModel');
		$messagetype           = ChkSQL(KS_G('post.messagetype'));
		$Data001['type']       = 4;
	    $Data001['modelname']  = 'Sendvoucher';
	    $Data001['money']      = $Data['money'] = ChkSQL(KS_G('post.money'));
	    $Data001['date']       = date('Y-m-d H:m:s',time());
	    $wxinfo                = $this->cache->GetHCache('website',$this->wxid);//读出缓存
	    $Data001['sitename']   = $wxinfo['sitename'];
	    $Data['redemptionstarttime'] = time();
		foreach($ids as $k=>$v){
			if($Data['money']<=0){
				echo '<script>alert("请输入一个正确的奖励金额");history.go(-1);</script>';exit;
			}else{
				//发送消息
				$Data001['memberid']   = ChkClng($v);
				$IndexModel    ->SendEx($messagetype,$Data001,$ids);
				//end
				$Data['memberid'] = $v;
				$Data['code']     = 'A'.$this->wxid.time().rand('1000','9999');
				$Data['mark']     = '系统生成';
				$Data['redemptionendtime'] = strtotime(KS_G('post.endtime'));
				$Data['awarddate'] = 1;
				$Data['redemptionmethod'] = 0;
				$Data['wxid'] = $this->wxid;
				$Data['addtime'] = time();
				$Data['title'] = "优惠券".$Data['money'];
				$Model->doAdd($Data,'id');
			}
		}
		echo '<script>alert("发放完成");history.go(-1);</script>';exit;
	}
	public function classroomAction(){
		include CURR_VIEW_PATH."WeChat/classroom.html";
	}
	public function editclassroomAction(){
		$category = M('app_category');
		$categoryAry = $category->getAll('where wxid='.$this->wxid.' and type=1 and depth=1');
		$id=ChkClng(KS_G('get.id'));
		if($id){
			$roomModel = M('app_classroom');
			$tempModel = M('app_temp');
		    $where =' as a left join '.$tempModel->table.' as b on a.tempid=b.id where a.id='.$id;
		    $values = $roomModel->getRow($where,'a.*,b.defaultpic as tempimg');
//		    var_dump($values);
		}
		$schoolModel = M("app_schooladdress");
		$school = $schoolModel->getAll('where wxid='.$this->wxid.' and status!=-1','schoolid,school');
		include CURR_VIEW_PATH."WeChat/editclassroom.php";
	}
	public function withdrawAction(){
		$id = ChkClng(KS_G('request.id'));
		if($id){}else{$id=0;}
		include CURR_VIEW_PATH."WeChat/withdraw.html";
	}
		//添加创建班级
	public function doaddClassroomAction(){
		echo '<script src="'.UOOT.'Public/common/js/jquery.js"></script>';
		echo '<script src="'.UOOT.'Public/common/js/common.js"></script>';
		echo '<script src="'.UOOT.'Public/common/js/module.js?<?php echo echoHash();?>"></script>';
		echo '<script src="'.UOOT.'Public/wechat/js/microportal/current.js"></script>';
		$classroomModel = M('app_classroom');
		$id = KS_G('request.id');
	    $Data['classroomname'] = ChkSQL(KS_G("post.classroomname"));
	    $Data['defaultpic']    = ChkSQL(KS_G("post.defaultimg"));
	    $Data['schoolname']    = ChkSQL(KS_G("post.schoolname"));
	    $Data['address']       = ChkSQL(KS_G("post.address"));
	     $Data['tempid']       = ChkClng(KS_G("post.tempid"));
 	 	$Data['categoryid']    = ChkClng(KS_G("post.categoryid"));
	  	$Data['galleryful']    = ChkClng(KS_G("post.galleryful"));
//	  	var_dump($id);exit;
        if($id){
        	$classroomModel->update($Data,'id='.$id);
        	echo '<script>alert("修改成功");history.go(-2);</script>';exit;
		}else{
			$Data['userid']        = $this->userid;
		    $Data['wxid']          = $this->wxid;
			$Data['adddate']       = time();
			$classroomModel->doadd($Data,'id');
			echo '<script>alert("添加成功");window.history.go(-2);</script>';exit;
		}

	}
	public function dowithdrawAction(){
		$wxinfo               = $this->cache->GetHCache('website',$this->wxid);//读出缓存
        $status               = $wxinfo['status'];
        $wxmoney              = $wxinfo['money'];//网校的总金额
        $withdrawmoney        = $wxinfo['withdrawmoney'];//网校可提现的总金额
        include CURR_VIEW_PATH."WeChat/dowithdraw.php";
	}
	public function savewithdrawAction(){
     	$withdrawmoney       = KS_G('post.withdrawmoney');
     	if($withdrawmoney==0){KS_INFO('提现金额不能为零');}
     	$withdraw_log        = M('common_withdraw_log');//提现记录表部分
        $withdrawnum         = $withdraw_log->getOne('count(*)',"where wxid=".$this->wxid." and date_format(from_UNIXTIME(adddate),'%Y-%m')=date_format(now(),'%Y-%m')");
		$base                = $this->cache->GetACache('setting');//读出缓存
     	if($withdrawnum>=$base['withdrawnum']){echo '<script>alert("超过本月提现次数");history.go(-1);</script>';exit;}
     	if($withdrawmoney<$base['withdrawmoney']){echo '<script>alert("单次至少提现'.$base['withdrawmoney'].'元");history.go(-1);</script>';exit;}
     	$wxinfo              = $this->cache->GetHCache('website',$this->wxid);//读出缓存
        $withdraw            = $wxinfo['withdrawmoney'];//网校的总提现金额
     	if($withdraw<$withdrawmoney){
     		echo '<script>alert("余额不足");history.go(-1);</script>';exit;
     	}
     	//插入订单明细表
		$Data['wxid']        = $this->wxid;
		$Data['userid']      = $this->userid;
		$Data['adddate']     = time();
		$Data['cmoney']      = $withdrawmoney;
		$Data['balance']     = $withdraw-$withdrawmoney;
		$Data['userip']      = $_SERVER['SERVER_ADDR'];
		$Data['paytype']      = KS_G('post.paytype');
		$Data['bank']         = KS_G('post.bank');
		if($Data['paytype'] == 0){
			$Data['banknum'] = $_POST['banknum'][0];
			$Data['name'] = $_POST['name'][0];
		}
		if($Data['paytype'] == 1){
			$Data['banknum'] = $_POST['banknum'][1];
			$Data['name'] = $_POST['name'][1];
		}
		if($Data['paytype'] == 2){
			$Data['banknum'] = $_POST['banknum'][2];
		}
		$Data['usermark']    = KS_G('post.usermark');
		$Data['mark']        = '大佬你提现了'.$withdrawmoney.',请等待审核,三天内到账';
		$withdraw_log->doAdd($Data,'id');

		$Datau['withdrawmoney']= $withdraw-$withdrawmoney;
		$Datau['withdrawsum']  = $wxinfo['withdrawsum']+$withdrawmoney;
		$user_website          = M('common_user_website');
		$user_website->update($Datau,"wxid=$this->wxid");
		$this->cache->PutHCache('website',$this->wxid);
		echo '<script>alert("提现成功，提现金额会在3个工作日之内到账");history.go(-2);</script>';exit;
	}
	//微信数据统计
	public function wechatcountAction(){
		include CURR_VIEW_PATH."WeChat/wechat.html";
	}
	//微信公众号关注回复列表
	public function wechatreplylistAction(){
		include CURR_VIEW_PATH."WeChat/wechatreplyl.html";
	}
	//微信回复编辑
	public function editreplyAction(){
		$id = ChkClng(KS_G('request.id'));
		if($id){
			$app_wechat_reply = M('app_wechat_reply');
	       	$values = $app_wechat_reply->getRow(' where wxid = '.$this->wxid.' and id = '.$id .' and type = 2');
	       	if($values['replyType'] == 0){
	       		$info = M('app_wechat_sucai')->getRow('where id='.$values['sucai']);
	       	}
	       	if($values['replyType'] == 2){
	       		$info = M('app_course')->getRow('where courseid='.$values['courseid']);
	       	}
	       	if($values['replyType'] == 3){
	       		$info = M('app_class')->getRow('where classid='.$values['classid']);
	       	}
		}else{
			$id = 0;
		}
		include CURR_VIEW_PATH."WeChat/editreply.php";
	}
	//关键词修改
	public function doeditReplyAction(){
		$id = ChkClng(KS_G("get.id"));
	    $replyType = ChkClng(KS_G("post.replyType"));
	    if($replyType == 0){
	    	$Data['sucaiid']  = ChkClng(KS_G('post.sucaiid'));
	    	$Data['contents'] =null;
	    	$Data['courseid'] =null;
	    }elseif($replyType == 1){
	    	$Data['contents'] = ChkSQL(KS_G("post.contents"));
	    	$Data['courseid'] =null;
	    	$Data['sucaiid'] =null;
        }else{
	    	$Data['courseid'] = ChkClng(KS_G('post.courseid'));
	    	$Data['sucaiid'] =null;
	    	$Data['contents'] = null;
        }
		$now_page          = ChkClng(KS_S('p'));
        $Data['rule']      = ChkSQL(KS_G("post.rule"));
		$Data['keyword']   = ChkSQL(KS_G("post.keyword"));
		$Data['type']      = 2;
		$Data['replyway']  = ChkClng(KS_G('post.replyway'));
		$Data['replyType']  = ChkClng(KS_G('post.replyType'));
		$Data['create_at'] = time();
		$Data['wxid']      = $this->wxid;
		if(empty($Data['keyword'])){
			echo '<script>alert("请输入关键词");history.go(-1);</script>';exit;
		}
		if(empty($Data['rule'])){
			echo '<script>alert("规则不能为空");history.go(-1);</script>';exit;
		}
		$app_wechat_reply  = M('app_wechat_reply');
		$app_wechat_reply->update($Data,'id='.$id );
		echo '<script>alert("修改成功");history.go(-2);</script>';exit;
	}
	//添加关键字回复
	public function saveReplyAction(){
		$replyType = ChkClng(KS_G("post.replyType"));
	    if($replyType == 0){
	    	$Data['sucaiid']  = ChkClng(KS_G('post.sucaiid'));
	    	$Data['contents'] =null;
	    	$Data['courseid'] =null;
	    	$Data['classid'] = null;
	    }elseif($replyType == 1){
	    	$Data['contents'] = ChkSQL(KS_G("post.contents"));
	    	$Data['courseid'] =null;
	    	$Data['sucaiid'] =null;
	    	$Data['classid'] = null;
       }elseif($replyType == 2){
	    	$Data['courseid'] = ChkClng(KS_G('post.courseid'));
	    	$Data['classid'] = null;
	    	$Data['sucaiid'] =null;
	    	$Data['contents'] = null;
       }elseif($replyType == 3){
	    	$Data['classid'] = ChkClng(KS_G('post.classid'));
	    	$Data['sucaiid'] =null;
	    	$Data['contents'] = null;
	    	$Data['courseid'] =null;
        }
		$now_page = ChkClng(KS_S('p'));
        $Data['rule']     = ChkSQL(KS_G("post.rule"));
		$Data['keyword']  = ChkSQL(KS_G("post.keyword"));
		$Data['type']     = 2;
		$Data['replyway'] = ChkClng(KS_G('post.replyway'));
		$Data['replyType']  = ChkClng(KS_G('post.replyType'));
		$Data['create_at'] = time();
		$Data['wxid'] = $this->wxid;
		if(empty($Data['keyword'])){
			echo '<script>alert("请输入关键词");history.go(-1);</script>';exit;
		}
		if(empty($Data['rule'])){
			echo '<script>alert("规则不能为空");history.go(-1);</script>';exit;
		}
		$app_wechat_reply = M('app_wechat_reply');
		$app_wechat_reply->doadd($Data,'id');
		$url1= M_URL($this->AppName.'/Index','reply',"",GP(""));
		echo '<script>alert("添加成功");history.go(-2);</script>';exit;
	}
	//图文列表页
	public function graphicAction(){
		include CURR_VIEW_PATH."WeChat/graphic.html";
	}
	//添加图文
	public function addgraphicAction(){
		$id = null!=GF('request.id') ? KS_G('request.id'):0;
		include CURR_VIEW_PATH."WeChat/addgraphic.php";
	}

	//生成海报
	public function posterAction(){
		$id = KS_G('get.id');
		$type = GF('courseType');
		$courseModel = M('app_course');
		$teacher = M('common_user_teacher');
		$where = 'as a left join '.$teacher->table.' as b on a.teacherid=b.userid where a.courseid='.$id;
		if($type==4){
			$codeImg = UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','https://'.APP_DOMAIN.'/h5market/imgInfo?id='.$id,'L',4,'qrcode');
			$info = $courseModel->getRow($where,'a.courseid,a.defaultpic,a.title,a.price,a.announce as intr,a.chargetype,b.name');
			if(strlen($info['title'])>8){
				$info['title'] =  mb_substr($info['title'],0,7,"UTF-8").'...';
			}
			$info['intr'] = strip_tags($info['intr']);
			$info['time'] = '';
		}
		if($info['price']=='0.00'){
			$info['price'] = '免费';
		}else{
			$info['price'] = '￥'.$info['price'];
		}
		if($info['defaultpic']){
			$info['defaultpic'] =checkImg($info['defaultpic']);
            if(stristr($info['defaultpic'],'bcebos.com')){
            	$res = getoutFile($info['defaultpic'],$this->wxid,2,1);//参数2的作用是删除掉文件夹中的文件
            	$info['defaultpic'] = UOOT.$res['save_path'];
            }else{

				if($info['defaultpic']=='"//'.APP_DOMAIN.'/"'||$info['defaultpic']=='https://store.kesion.com/'){
					$info['defaultpic'] = nopic(1);
				}
            }
		}else{
			$info['defaultpic'] = nopic(1);
		}
		//取出网站logo
         $webModel = M('common_user_website');
		$logoInfo = $webModel->getRow('where wxid='.$this->wxid,'logo,wilogo');
		if(empty($logoInfo['wilogo'])){
			$logo = $logoInfo['logo'];
		}else{
			$logo = $logoInfo['wilogo'];
		}
		if($logo){
			$logo =Img($logo);
             if(stristr($logo,'bcebos.com')){
             	$res2 = getoutFile($logo,$this->wxid,1,1);
            	$logo = UOOT.$res2['save_path'];
             }else{
             	if($logo=='"//'.APP_DOMAIN.'/"'||$logo=='https://store.kesion.com/'){
					$logo = nopic(1);
				}else{
					if(strstr($logo,APP_DOMAIN)){
	             		$logo = $logo;
	             	}elseif(strstr($logo,'store.kesion.com')){
	             		$logo =  str_replace("store.kesion.com",APP_DOMAIN,$logo);
	             	}
				}

           }




		}else{
			$logo = nopic(1);
		}
		$model = M('app_carousel');
		$values = $model->getAll('where type=6');
		include CURR_VIEW_PATH."WeChat/poster.php";
	}

	public function vermicelliListAction(){
		$userModel = M("app_weixin_user");
		$where = 'where wxid='.$this->wxid;
   	    $options = $userModel->getOptions(10,$where);//分页参数设置
		$options['now_page'] = (null!=GF('p')?ChkClng(GF('p')):1);
	    $page = Page($options);
	    $values = $userModel->getPage($page,'',$where,'');
		include CURR_VIEW_PATH."WeChat/vermicelliList.php";
	}

	/**消息页面**/
	public function fanswordAction(){
		$newsModel = M("app_wechat_news");
		$where = 'where wxid='.$this->wxid.' and isread=0 and replystatus=0';
		$options     = $newsModel->getOptions(10,$where);//分页参数设置
		$options['now_page'] =1;
		$page        = Page($options);
	    $values      = $newsModel->getPage($page,'',$where,'id,wxid,nickname,city,headimgurl,content,createtime');
	    foreach($values as $k=>$v){
	    	$values[$k]['createtime'] = date('Y-m-d',$v['createtime']);
	    }
		include CURR_VIEW_PATH."WeChat/fansword.php";
	}
	/****收入明细*****/
	public function incomedetailsAction(){
		include CURR_VIEW_PATH."WeChat/incomedetails.php";
	}
	//教师管理
	public function tmlistAction(){
		include CURR_VIEW_PATH."WeChat/tmlist.php";
	}

	public function paperListAction(){
		include CURR_VIEW_PATH."WeChat/paperList.php";
	}
    //语音直播
	public function audioLiveAction(){
		include CURR_VIEW_PATH."WeChat/audioLive.html";
	}
	//编辑语音直播
	public function editaudioLiveAction(){
		$id = null!=KS_G('request.id') ? KS_G('request.id'):0;
		$livetype = null!=KS_G('request.livetype') ? KS_G('request.livetype'):'';
		include CURR_VIEW_PATH."WeChat/editaudioLive.html";
	}

	public function audioAddAction(){
		$id = null!=KS_G('request.id') ? KS_G('request.id'):0;

		include CURR_VIEW_PATH."WeChat/audioAddition.php";
	}
	public function addbounchAction(){
		$id = null!=GF('request.id') ? KS_G('request.id'):0;
		include CURR_VIEW_PATH."WeChat/addbounch.php";
	}
	//增加打赏
	public function rewordAction(){
		$id = null!=GF('request.id') ? KS_G('request.id'):0;
		include CURR_VIEW_PATH."WeChat/reword.php";
	}
}   