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
/**
 * 前端页面的总入口类
 */
class IndexController extends CommonController
{
    /**
	 * 进入首页
     */
    public function indexAction(){

        $this->wxid = $GLOBALS['_DoM']['wxid'];
		$module     = wx_module_arr($this->wxid);

		if (isMobile()){    //手机风格
            if ($this->wxid==1 && empty(KS_S('iswechatLogin'))){  //官网,并且不是微信授权登录的情况
                //开发动态
                $url='https://www.kesion.com/plus/json.aspx?jid=J132063338099221839';  //微门户开发动态获取URL
                $news_data=geturl($url);
                if ($news_data){
                    $news_data=json_decode($news_data,true);
                    foreach ($news_data as $k=>$v){
                        $news_data[$k]['title']=str_replace('【微门户】','',$news_data[$k]['title']);
                    }
                }
                $this->assign('newAry',$news_data);
				$this->display('index.html','',true);   //第三个参数表示该页面模板是否从数据库里取
			}else{

                //$turnurl=wx_Url($this->wxid).$_SERVER['REQUEST_URI'];  //得到URL信息，以便判断登录成功跳转的URL

                //if (is_weixin() &&  (User_GetUserInfo()==null ||  IS_PLATFORM_DOMAIN) && empty(KS_S('h5token'))) //微信端自动授权登录,没有登录，或是在平台域名下，一定要授权,有传h5token 表示从官网公众号过来的，不进入授权登录步骤
                //{

                //    /****************如果是前端路由来的（标记就是?url=)，就跳转到跳刚才路由页面，不再进去首页了 begin**********************/
                //    /****对应h5market/wechatlogin里会使用到 ********/
                //     if (strstr($turnurl,'url=')){
                //        $turnurl=str_replace('url=','#/',$turnurl);
                //        putsession('turnurl',$turnurl);
                //     }
                //    /****************如果是前端路由来的（标记就是?url=)，就跳转到跳刚才路由页面，不再进去首页了 end**********************/


                //    $wechat = new \Core\Wechat();
                //    $wechatinfo=$wechat->authAction(true,$this->wxid);                //指定要自动创建账号，这里的wxid一定要传，以便将店铺的wxid，授权成功后返回
                //    $this->wxid    = ChkClng(KS_S('get.wxid'));                       //通过微信授权后，这里一定要重新从URL获取wxid
                //    if ($wechatinfo){   //授权成功返回
                //        $param='';
                //        $UserMode      = M('common_user');
                //        if ($wechatinfo->unionid){
                //            $param="unionid='".$wechatinfo->unionid."'";
                //        }else{
                //            $param="openid='".$wechatinfo->openid."'";
                //        }
                //        if (KS_S('get.go')=='store'){   //管理员角色
                //            $param.=' and usertype>0';
                //        }else{                          //学生角色
                //            $param.=' and usertype=0';
                //        }
                //        $info        = $UserMode->getRow('where '.$param.' and wxid='.$this->wxid.' and wechatbing=1 order by lastlogintime desc limit 1');
                //        if(!empty($info)){       //有登录绑定过了
                //            $usertoken['h5token']    = KS_MD5(time().$wechatinfo->openid);
                //            $usertoken['tokentime']  = (time() +7200);
                //            $UserMode->update($usertoken,$param.' and wechatbing=1 and userid='.$info['userid']);
                //            $newurl  = wx_Url($this->wxid).'/h5market/wechatlogin?go='.KS_S('get.go').'&token='.$usertoken['h5token'];   //跳到店铺进行鉴权登录
                //            ks_header($newurl);
                //        }
                //    }
                //}
				if (checkIsVip($this->wxid)<=0){
					echo '店铺已打样';die;
				}
				include  CURR_VIEW_PATH . "h5market/dist/m/index.html";
			}
        }else{//PC电脑
			if ($this->wxid==1){   //官网
                //$AppModel   = M('app_news');
                //$Model      = M('app_h5_scheme');
                //$ktjInformation  = $AppModel ->getAll('where categoryid=798 order by adddate desc limit 0,8 ');
                //$yxInformation  = $Model ->getAll('where marketing=0 and del=1 order by addtime desc limit 0,8');
                //$newAry = $AppModel->getAll('where wxid=1 and status!=-1 and status!=0 order by id  desc limit 4');
                //$this->assign('newAry',$newAry);
                //$this->assign('ktjary',$ktjInformation);
                //$this->assign('yxary',$yxInformation);
			}else{
                //非官网 pc端，暂时跳到公众号
				if (checkIsVip($this->wxid)<=0){
					echo '店铺已打样';die;
				}
				$website = $this->cache->GetHCache('website',$this->wxid);//读出缓存
				$seo_title = !empty($website['seotitle'])?$website['seotitle']:'科汛V名师-教育小程序微门户，网校小程序，简单好用的在线教育平台。';
				$seo_keywords = !empty($website['metakeywords'])?$website['metakeywords']:'科汛V名师，网校小程序，微门户，知识付费，微信平台，朋友圈，在线教育，中小机构，线上教学，在线1对1，互动课堂，云SaaS教学平台，内容付费，课程展示，知识变现，流量变现，知识电商。';
				$seo_description = !empty($website['metadescription'])?$website['metadescription']:'科汛V名师，0门槛在线教育转型解决方案。基于微信平台，为中小机构、个体教师等知识内容方，提供轻便、实用的云SaaS在线教育平台工具。一分钟快速注册，0门槛起步，创建你的微门户，开启在线教育之旅。';
				$favicon = !empty($website['favicon'])?$website['favicon']:'/favicon.ico';
				$teacherinfo = User_GetUser($website['userid']);
				if ($teacherinfo['usertype']==1){
					include  CURR_VIEW_PATH . "h5market/dist/m/index.html";
				}else{
					include  CURR_VIEW_PATH . "h5market/dist/pc/index.html";
				}
                return;
            }
			$this->display('index.html','',true);   //第三个参数表示该页面模板是否从数据库里取
		}
    }

    /**
     * 网校(广告专用）
     */
    public function newAction(){
        $this->wxid = $GLOBALS['_DoM']['wxid'];
		$module     = wx_module_arr($this->wxid);
        if (!isMobile()){    //手机风格
            //开发动态
            $url='https://www.kesion.com/plus/json.aspx?jid=J132063338099221839';  //微门户开发动态获取URL
            $news_data=geturl($url);
            if ($news_data){
                $news_data=json_decode($news_data,true);
                foreach ($news_data as $k=>$v){
                    $news_data[$k]['title']=str_replace('【微门户】','',$news_data[$k]['title']);
                }
            }
            $this->assign('newAry',$news_data);
            $this->display('ad.html','',true);   //第三个参数表示该页面模板是否从数据库里取
        }else{
            include  CURR_VIEW_PATH . "h5market/dist/m/index.html";
        }
    }

    /**
     * 网校
     */
    public function wxAction(){

        $businessModel      = M('web_business');
        $options            = $businessModel->getOptions('8','where 1=1');//分页参数设置
        $option['now_page'] = ChkClng(KS_S('p',1));;
        $page               = Page($options);
        $value              = $businessModel->getPage($page,'level desc','where 1=1');
        $this->assign('business',$value);
        $this->assign('page',$page);
        $this->display('about/wx.html');
    }

    /**
	 * 官网功能详情
     */
    public function portalAction(){
	    $this->display('about/funclist.html');
    }
	/**
	 * 接口测试工具
	 */
	public function apiinfoAction(){
		$db_classify = M("web_interface_classify");
		$db_interface = M("web_interface");
		$db_parameter = M("web_interface_parameter");
		$firstary = $db_classify->getAll('where 1=1 order by id desc');
		$Controller = '';
        $interfaceName = '';
        $postway = '';
        if($firstary){
           	$modelid =ChkClng(GF('modelid') ? GF('modelid'):$firstary[0]['id']);
           	// var_dump($modelid);
             $second = $db_interface->getAll('where parentid='.$modelid.' order by id asc');
        }else{
           	 $second = array();
        }
        if($second){
        	// var_dump($second[0]);
        	$interfaceid =ChkClng(GF('interfaceid') ? GF('interfaceid'):$second[0]['id']);
        	// var_dump(GF('interfaceid'));
        	foreach ($second as $k => $v) {
        		if ($v['id'] == $interfaceid) {
        			$Controller = $v['controller'];
        			$interfaceName = $v['interfaceName'];
        			$postway = $v['postway'];
        		}
        	}

        	$third = $db_parameter->getAll('where interfaceid='.$interfaceid.' order by id asc');
        }else{
        	$third = array();
        }

	 	include  CURR_VIEW_PATH . "Testjk/test.php";
	}
	/**
	 * api文档
	 */
	public function apiwordAction(){
		//读取分类
		$Db = M('web_interface_classify');
		$Db2 = M('web_interface');
		$info = $Db->getAll(' where id!=2 order by orderid desc');
		foreach ($info as $k => $v) {
			$info[$k]['dt'] = $Db2->getAll('where parentid='.$v['id']);
		}
	 	include  CURR_VIEW_PATH . "Testjk/api.html";
	}
	public function apiwordinfoAction(){
		$keyword = KS_G('get.keyword');
		$now_page=ChkClng(GF('p') ? GF('p'):'1');
        $id = KS_G('get.id');
        $Db = M('web_api_wiki');
        $info = $Db->getOne('content','where apiid='.$id);
        if(!$info){
            $info = '文章正在编写中.....';
        }
        echo '<style type="text/css">
			em {
			    font-style: normal;
			    color: #44b549;
			}
			table td {
				border: 1px solid #eee;
				border-color:#ddd!important;
			    min-width: 14%;
			    line-height: 24px;
			    font-size: 14px;
			    padding: 10px !important;
			    word-break: break-all;
			    word-wrap: break-word;
			}
			</style>';
		echo keywordbright($keyword,$info,false);;
	}
	public function apiwordserrchAction(){
		$keyword = KS_G('get.keyword');
		$Db = M('web_api_wiki');
        $info = $Db->getAll('where title  LIKE "%'.$keyword.'%" or content LIKE "%'.$keyword.'%" ');
		include  CURR_VIEW_PATH . "Testjk/apiserrch.html";
	}
    public function hongbaoAction(){
    	$id = isset($_REQUEST['id'])?$_REQUEST['id']:1;
    	$conf =(object)array();
		$conf->sharetitle =  '抽奖大酬宾100%中奖iPhone X等你来拿';
		$conf->shareintr  =  '热烈庆祝3G科技公司正式开业，抽奖大酬宾100%中奖iPhone X等你来拿';
		$conf->url   = 'http://'.APP_DOMAIN.'/home/hongbao/'.$id;

		$conf->defaultpic = 'http://'.APP_DOMAIN.'/Skin/1583/PC/Skin04/Public/img/timg.jpg';
		$share = indexshare($GLOBALS['_DoM']['wxid'],$conf);
		$this->assign('id',$id);
    	$this->assign('share',$share);
		$this->display('share.html');
    }
    public  function testddAction(){
        header("Access-Control-Allow-Origin: *");
		include  CURR_VIEW_PATH . "login.php";
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
		$category = $this->cache->GetHCache('appcategory',$GLOBALS['_DoM']['wxid']);//读出缓存   林波S+B
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
			 echo json_encode(array('result'=>'succeed','username'=>$this->memberinfo['username'],'memberhead'=>$memberhead,'cartNum'=>count($cartcourse),'logouturl'=>M_URL('home','logout'),'classurl'=>M_URL('home','class'),'carturl'=>M_URL('course','cart'),'xuankeurl'=>M_URL('home','xuanke'),'userInfo'=>$this->memberinfo),JSON_UNESCAPED_UNICODE);
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
		$id           = ChkClng(KS_G('request.id'));
		//if($this->memberinfo!== null&&$id!=3){KS_INFO('',2,M_URL());}
		$website      = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		$issms        = getSetting(0,17,$GLOBALS['_DoM']['wxid']);
		$passtatus    = $this->cache->GetH('smsmodel','modelname','PassWord','status',$GLOBALS['_DoM']['wxid']);//读出缓存
		$logintatus   = $this->cache->GetH('smsmodel','modelname','Login','status',$GLOBALS['_DoM']['wxid']);//读出缓存
	    $status       = $this->cache->GetH('smsmodel','modelname','Register','status',$GLOBALS['_DoM']['wxid']);//读出缓存
	    if($status==1&&$issms==1){$this->assign('status',$status);}else{$this->assign('status',0);}
	    if($logintatus==1&&$issms==1){$this->assign('logintatus',$logintatus);}else{$this->assign('logintatus',0);}
	    if($passtatus==1&&$issms==1){$this->assign('passtatus',$passtatus);}else{$this->assign('passtatus',0);}
	    $suiji   = MD5(rand(0,210000500).time().$GLOBALS['_DoM']['wxid']);
	    $codeimg =  UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',$suiji,'L',4,'qrcode');
	    $this->assign('codeimg',$codeimg);
	    $this->assign('suiji',$suiji);
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

		if($id==1){
            $this->display('home/Poplogin.html');
        }
	    else{

            $this->display('home/login.html');
        }
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
    //index跨域单点登录
	public function presiginAction(){
		check_login($this->memberinfo);//检查是登录权限
        $usersModel        = M('common_user');
        $Data['secretKey'] = md5(time().rand(10000,99999).$this->memberinfo['userid']);
		$usersModel->update($Data,"userid=".$this->memberinfo['userid']." and usertype=0 and wxid=".$this->memberinfo['wxid']);
		header("Content-type: application/json");
		$domain      = $this->cache->GetA('domaininfo','wxid',$this->memberinfo['wxid'],'',true);
		if(!strstr($_SERVER["HTTP_HOST"],'.'.PLATDOMAIN.'')){
			echo json_encode(array('result'=>'succeed','url'=>'https://'.$domain['predomain'].'/home/crosigin','wxid'=>$this->memberinfo['wxid'],'userid'=>$this->memberinfo['userid'],'tocken'=>$Data['secretKey']));
		}else{
			echo json_encode(array('result'=>'err'));
		}
	}
	//index跨域单点登录
	public function crosiginAction(){
		header("Access-Control-Allow-Origin: *");
		$tocken    = KS_G('post.tocken');
	    $userid    = KS_G('post.userid');
	    $link      = KS_G('post.link');
		$usersModel  = M('common_user');
		$user = $usersModel->getRow("where userid=".$userid." and wxid = ".$GLOBALS['_DoM']['wxid']." and usertype=0 limit 1",'secretKey,usertype,userid,username,wxid');
        if($user['secretKey']==$tocken){
        	$userinfo['userid']   = $user['userid'];
			$userinfo['username'] = $user['username'];
			$userinfo['usertype'] = $user['usertype'];
			$userinfo['wxid']     = $user['wxid'];//网校id
			putsession('member',$userinfo);
        	$Data['secretKey'] = md5(time().rand(10000,99999).$userid);
		    $usersModel->update($Data,"userid=".$userid." and usertype=0 and wxid=".$GLOBALS['_DoM']['wxid']);
		    $link  = str_replace('//','http://',$link);
		    exit("<script>top.location.href='$link'</script>");
        }else{
        	echo 'err';exit;
        }
	}
	//进行登录
	public function siginAction(){
	    $id          = ChkClng(KS_G('request.id'));
		$username    = KS_G('post.username');
		$password    = KS_G('post.password');
		$wxid    = KS_G('post.wxid');
		if(!empty($wxid)){
			$GLOBALS['_DoM']['wxid'] = $wxid;
		}
		$code        = ChkSQL(KS_G('post.Logincode'));
		$usersModel  = M('common_user');
		$website     = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		$status=0;$issms=0;
		if(empty($password)){
			$issms       = getSetting(0,17,$GLOBALS['_DoM']['wxid']);
			//短信验证
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
			if($id==2){echo '{"errcode":"10001"}';exit;}
			else{KS_INFO("<script>parent.loginSuccessBack('登录失败');</script>",-1);}
		}elseif($user['status']==2){if($id==2){echo '{"errcode":"10001"}';exit;}KS_INFO("<script>parent.loginSuccessBack('该账户已被锁定');</script>",-1);}
		elseif($user['status']==0){if($id==2){echo '{"errcode":"10001"}';exit;}KS_INFO("<script>parent.loginSuccessBack('该账户未通过审核');</script>",-1);}

		//var_dump($user);exit;
		if($user['password']==KS_MD5($password.KS_MD5($user['rndpasswordc']))||($status==1 && $issms==1)){
			$lastlogintime       = time();
			$lastloginip         = $_SERVER['REMOTE_ADDR'];
			$GLOBALS['db']->execSql("UPDATE `$usersModel->table` SET `lastlogintime`='$lastlogintime', `lastloginip`='$lastloginip', `logintimes`=logintimes+1 WHERE userid=$user[userid]");
			//model层记录登录记录
            $loginModel = M('Application/LoginModel');
	        $loginModel->loginrecord($user['userid'],0);
	        //登陆成功把openid记录进去
	        if(!empty(KS_G('post.openid'))){
	        	$Datas['openid'] = null !==KS_G('post.openid') ? KS_G('post.openid'):null; // 防止数据库出现0这个数据
	        	if(empty($Datas['openid'])){
	        		$Datas['openid'] = null;
	        	}
	        	$userinfo['openid']  = $Datas['openid'];
	        }else{
	        	 $userinfo['openid']     = $user['openid'];
	        }
	        //用户token
	        $Datas['h5token'] = KS_MD5(time().KS_G('post.openid'));
			$Datas['tokentime']= (time() +7200);
        	$usersModel->update($Datas,'userid='.$user['userid']);
	        //获取用户的域名
	        $domains = $this->cache->GetA('domaininfo','wxid',$GLOBALS['_DoM']['wxid']);//写入缓存
			$domain = 'store.kesion.com';
			if(empty($domains)){
				$domain = 'store.kesion.com';
			}else{
				if($domains[0]['status']==2){

					$domain = $domains[0]['predomain'];
					if(empty($domain) || $domain =='localhost'){
						$domain = $domains[0]['domain'];
					}
				}else{
					$domain = $domains[0]['domain'];
				}
			}
			//把一些基本信息放入session
			$userinfo['userid']   = $user['userid'];
			$userinfo['username'] = $user['username'];
			$userinfo['usertype'] = $user['usertype'];
			$userinfo['openid']   = $user['openid'];
			$userinfo['wxid']     = $user['wxid'];//网校id

			putsession('member',$userinfo);
			//这个机构登录是有做的，登录成功，请完善资料------待做
			//if($website['isinfo']==1){$url =  M_URL('Index','addinfo');KS_INFO('登录成功，请完善资料',2,$url);}
			if($id==2){
				if(APP_DOMAIN == 'store.kesion.com'){
					$_SESSION['member'] = NULL;
				}
				$userinfoModel = M('common_user_member');
				$name= $userinfoModel->getOne('name','where userid='.$user['userid']);
				$userhead=$this->memberinfo['userHead']= $this->upload->getHead($user['userid']);
				echo '{"succeed":"10001","id":"'.$user['userid'].'","userhead":"'.$userhead.'","name":"'.$name.'","token":"'.$Datas['h5token'].'","xuankeurl":"'.M_URL('home','xuanke').'","domain":"'.$domain.'"}';
				exit;
			}
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
        //model层记录退出记录
        $loginModel = M('Application/LoginModel');
	    $loginModel->loginrecord($this->memberid,1);
		putsession('member',null);
	    ks_header(M_URL());
    }
	//简易版注销登录
    public function simplelogoutAction(){
        check_login($this->memberinfo);//检查是登录权限
        //model层记录退出记录
        $loginModel = M('Application/LoginModel');
	    $loginModel->loginrecord($this->memberid,1);
		putsession('member',null);
	    header("Content-type: application/json");
	    echo json_encode(array('result'=>'succes'));
    }
	//进行注册
	public function doregisterAction(){
		$code             = ChkSQL(KS_G('post.code'));
		$Data['username'] = ChkSQL(KS_G('post.username'));
		$Data['mobile']   = ChkSQL(KS_G('post.mobile'));
		$Data['mobilebing']= 1;
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
	    //$usernum          = $usersModel->getOne('count(*)','where username = "'.$Data['username'].'" and wxid = '.$GLOBALS['_DoM']['wxid']);
		$usernum          = $usersModel->getOne('count(*)','where username = "'.$Data['username'].'" and usertype=0');
		//一个号码只可以注册一次
		//$usernum          = $usersModel->getOne('count(*)','where mobile = '.$Data['username']);
        if($usernum>0){KS_INFO("<script>parent.regSuccessBack('学员账号云平台已存在');</script>",-1);}
		$Data['parentid'] = $usersModel->getOne('userid','where parentid=0 and wxid = '.$GLOBALS['_DoM']['wxid']);
		$Rule['mobile']   = '手机号|isEmpty,isMobile';
		$Rule['password'] = '密码|isEmpty,isPassword';
		Chkpost($Data,$Rule,$usersModel);
		$Data['password'] = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));
		$result           = $usersModel->doAdd($Data,'userid');
		//插入第二张表
		$Datas['userid']  = $result;
		$Datas['name']    = $Data['username'];
		$user_school      = M('common_user_member');
		$user_school->delete("userid=$Datas[userid]");
		$user_school->doEfAdd($Datas);
		$this->cache->PutHCache('users',$GLOBALS['_DoM']['wxid']);
		$this->cache->PutHCache('user',$GLOBALS['_DoM']['wxid']);
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
    //do重置密码页
	public function doPasswordAction(){
		$code                  = ChkSQL(KS_G('post.code'));
		$mobile                = ChkSQL(KS_G('post.mobile'));
		$Data['password']      = ChkSQL(KS_G('post.password'));
		$pwd_check             = ChkSQL(KS_G('post.pwd_check'));
		if($Data['password']  != $pwd_check){KS_INFO('两次密码不一致',0,'','',1);}
		$Data['rndpasswordc']  = rand(100000,999999);

		$status  = $this->cache->GetH('smsmodel','modelname','PassWord','status',$GLOBALS['_DoM']['wxid']);//读出缓存
		$issms   = getSetting(0,17,$GLOBALS['_DoM']['wxid']);
		if($status==1 && $issms == 1){
			$smslog  = M('app_sms_log');
			$content = $smslog->getOne('content',"where mobile='$mobile' and logtype=0 and model='Password' and wxid = ".$GLOBALS['_DoM']['wxid']." and adddate>='".time()."'-10000 order by adddate desc limit 1");
			$content = substr(preg_replace('/\D/s','',$content),-6);

			if($code!=$content||empty($code)){KS_INFO("<script>parent.regSuccessBack('验证码错误');</script>",-1);}
		}
	    $usersModel       = M('common_user');
		$userinfo         = $usersModel->getRow('where mobile = "'.$mobile.'" and wxid = '.$GLOBALS['_DoM']['wxid'].' limit 1','userid,username,usertype,wxid');

		//一个号码只可以注册一次
		//$usernum          = $usersModel->getOne('count(*)','where mobile = '.$Data['username']);
        if(empty($userinfo)){KS_INFO("<script>parent.regSuccessBack('该用户还未注册');</script>",-1);}
		$Rule['password'] = '密码|isEmpty,isPassword';
		Chkpost($Data,$Rule,$usersModel);
		$Data['password'] = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));
		$usersModel->update($Data,'mobile = "'.$mobile.'" and wxid = '.$GLOBALS['_DoM']['wxid']);
		//注册后直接登录
		if(1){
			$lastlogintime = time();
			$lastloginip   = $_SERVER['REMOTE_ADDR'];
			$GLOBALS['db']->execSql("UPDATE `$usersModel->table` SET `lastlogintime`='$lastlogintime', `lastloginip`='$lastloginip', `logintimes`=logintimes+1 WHERE mobile = '".$mobile."' and wxid = ".$GLOBALS['_DoM']['wxid']);
			//把一些基本信息放入session
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
		if(empty($loginconf)){KS_INFO('操作失误',4,'','',1);}
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
		//---------------------默认背景加载-----------------------
		$IndexModel           = M('Application/IndexModel');
	    $Data007['memberid']  = $this->memberid;
        $result               = $IndexModel->backgroup($Data007);
        //---------------------end-----------------------
		$this->assign('tempPxt',$result['tempPxt']);
		$this->assign('background',$result['background']);//默认背景图片
		$this->assign('bid',$result['backgroundStyle']['0']);
		$this->assign('backmusic',$result['backmusic']);//默认背景音乐
		$this->assign('volume',$result['volume']);//默认背景音量
		$this->assign('username',$this->memberinfo['username']);
		$this->assign('name',$this->memberinfo['name']);
        $this->display('class.html',1);
    }
    //科汛V名师关于我们
	public function aboutAction(){
		$id = ChkClng(KS_G('request.id'))!=0?ChkClng(KS_G('request.id')):1;
		if($id==1){
		}elseif($id==2){//查询优秀的新闻

			$Mode    = M('app_news');
		    $hotnews = $Mode->getAll('where status!=-1 and hot=1 and wxid=1 order by adddate desc limit 2');//查询新闻
		    $news    = $Mode->getAll('where status!=-1 and wxid=1  order by adddate desc limit 9');
			$this->assign('hotnews',$hotnews);
	     	$this->assign('news',$news);
		}elseif($id==3){
		}elseif($id==4){//案例精选
			$businessModel      = M('web_business');
			$options            = $businessModel->getOptions('8','where 1=1');//分页参数设置
	        $option['now_page'] = ChkClng(KS_S('p',1));;
			$page               = Page($options);
			$value              = $businessModel->getPage($page,'level desc','where 1=1');
			$this->assign('business',$value);
			$this->assign('page',$page);
		}
		$this->assign('id',$id);
        $this->display('about/index.html');
    }
    //开发详情页
	public function developDetailAction(){
	 	$id                = ChkClng(KS_G("request.id"));
	 	$this->AppModel    = M('common_massage');
		if(empty($id)){$id = $this->AppModel->getOne('id','where wxid='.$GLOBALS['_DoM']['wxid'].' limit 1');}
		if(cookie('develop'.$id)!='develop'.$id){
	 		cookie('develop'.$id,'develop'.$id);
	 		$Data['hits']  = 'hits+1';
	 		$this->AppModel->update($Data,'id='.$id,1);
	    }
//		$left_join = M('web_question_classify');
//		$where = 'as a left join `'.$left_join->table.'` as b on a.classify = b.categoryid where a.id ='.$id;
		$value = $this->AppModel->getRow('where id ='.$id);
		if(empty($value)){$this->assign('getMessage','您没有该资讯，到其他资讯看看哦');$this->display('404.html');exit;}
		$value['adddate'] = date('Y/m/d H:i:s',$value['adddate']);
		$content = explode(KS_C('PAGE_BREAK'),$value['content']);
		$options['now_page']   = null !==GF('p') ? GF('p'):'1';
		$options['maxperpage'] = 1;
	    $options['totalput']   = count($content);
		$page = Page($options);
		$dt   = $page->arrayPage($content);
		if(empty($dt))return null;
		//查询该网校所有新闻ID
		$newsid = $this->AppModel->getAll('','id,title');
		//var_dump($newsid);exit;
		foreach($newsid as $key =>$v){if($v['id'] == $id){$post = $key;}}
		$lastpost = $post-1;
		$nextpost = $post+1;
		if($post == 0){
			$last = '<a class="fc-hei fz-14">没有更多了</a>';
			$next = '<a class="fc-hei fz-14" href="'.M_URL('home','developDetail',$newsid[$nextpost]['id']).'">'.$newsid[$nextpost]['title'].'</a>';
		}elseif($post == (count($newsid)-1)){
			$last = '<a class="fc-hei fz-14" href="'.M_URL('home','developDetail',$newsid[$lastpost]['id']).'">'.$newsid[$lastpost]['title'].'</a>';
			$next = '<a class="fc-hei fz-14">没有更多了</a>';
		}else{
			$last = '<a class="fc-hei fz-14" href="'.M_URL('home','developDetail',$newsid[$lastpost]['id']).'">'.$newsid[$lastpost]['title'].'</a>';
			$next = '<a class="fc-hei fz-14" href="'.M_URL('home','developDetail',$newsid[$nextpost]['id']).'">'.$newsid[$nextpost]['title'].'</a>';
		}
		$this->assign('PreItem',$last);
		$this->assign('NextItem',$next);
		$this->assign('page',$page);
		$this->assign('content',$dt);
		$this->assign('field',$value);
		$this->assign('id',$id);
	 	$this->display('about/developDetail.html');
    }
    //文章详情页
	public function questionDetailAction(){
	 	$id                = ChkClng(KS_G("request.id"));
	 	$this->AppModel    = M('web_question_answer');
		if(empty($id)){$id = $this->AppModel->getOne('id','where wxid='.$GLOBALS['_DoM']['wxid'].' limit 1');}
		if(cookie('question'.$id)!='question'.$id){
	 		cookie('question'.$id,'question'.$id);
	 		$Data['hits']  = 'hits+1';
	 		$this->AppModel->update($Data,'id='.$id,1);
	    }
		$left_join = M('web_question_classify');
		$where = 'as a left join `'.$left_join->table.'` as b on a.classify = b.categoryid where a.id ='.$id;
		$value = $this->AppModel->getRow($where);
		if(empty($value)){$this->assign('getMessage','您没有该资讯，到其他资讯看看哦');$this->display('404.html');exit;}
		$value['adddate'] = date('Y/m/d H:i:s',$value['adddate']);
		$GLOBALS['_DoM']['categoryid'] = $value['categoryid'];
		$content = explode(KS_C('PAGE_BREAK'),$value['content']);
		$options['now_page']   = null !==GF('p') ? GF('p'):'1';
		$options['maxperpage'] = 1;
	    $options['totalput']   = count($content);
		$page = Page($options);
		$dt   = $page->arrayPage($content);
		if(empty($dt))return null;
		//查询该网校所有新闻ID
		$newsid = $this->AppModel->getAll('','id,title');
		//var_dump($newsid);exit;
		foreach($newsid as $key =>$v){if($v['id'] == $id){$post = $key;}}
		$lastpost = $post-1;
		$nextpost = $post+1;
		if($post == 0){
			$last = '<a class="fc-hei fz-14">没有更多了</a>';
			$next = '<a class="fc-hei fz-14" href="'.M_URL('home','questionDetail',$newsid[$nextpost]['id']).'">'.$newsid[$nextpost]['title'].'</a>';
		}elseif($post == (count($newsid)-1)){
			$last = '<a class="fc-hei fz-14" href="'.M_URL('home','questionDetail',$newsid[$lastpost]['id']).'">'.$newsid[$lastpost]['title'].'</a>';
			$next = '<a class="fc-hei fz-14">没有更多了</a>';
		}else{
			$last = '<a class="fc-hei fz-14" href="'.M_URL('home','questionDetail',$newsid[$lastpost]['id']).'">'.$newsid[$lastpost]['title'].'</a>';
			$next = '<a class="fc-hei fz-14" href="'.M_URL('home','questionDetail',$newsid[$nextpost]['id']).'">'.$newsid[$nextpost]['title'].'</a>';
		}
		$this->assign('PreItem',$last);
		$this->assign('NextItem',$next);
		$this->assign('page',$page);
		$this->assign('content',$dt);
		$this->assign('field',$value);
		$this->assign('id',$id);
	 	$this->display('about/questionDetail.html');
    }
    //文章详情页
	public function articleDetailAction(){
	 	$id                = ChkClng(KS_G("request.id"));
	 	$this->AppModel    = M('app_news');
		if(empty($id)){$id = $this->AppModel->getOne('id','where wxid='.$GLOBALS['_DoM']['wxid'].' limit 1');}
		if(cookie('article'.$id)!='article'.$id){
	 		cookie('article'.$id,'article'.$id);
	 		$Data['hits']  = 'hits+1';
	 		$this->AppModel->update($Data,'wxid='.$GLOBALS['_DoM']['wxid'].' and id='.$id,1);
	    }
		$left_join = M('app_category');
		$where = 'as a left join `'.$left_join->table.'` as b on a.categoryid = b.categoryid where a.id ='.$id;
		$value = $this->AppModel->getRow($where);
		if(empty($value)){$this->assign('getMessage','您没有该资讯，到其他资讯看看哦');$this->display('404.html');exit;}
		$value['adddate'] = date('Y/m/d H:i:s',$value['adddate']);
		$GLOBALS['_DoM']['categoryid'] = $value['categoryid'];
		$content = explode(KS_C('PAGE_BREAK'),$value['content']);
		$options['now_page']   = null !==GF('p') ? GF('p'):'1';
		$options['maxperpage'] = 1;
	    $options['totalput']   = count($content);
		$page = Page($options);
		$dt   = $page->arrayPage($content);
		if(empty($dt))return null;
		//查询该网校所有新闻ID
		$post=0;
		$newsid = $this->AppModel->getAll('where wxid='.$GLOBALS['_DoM']['wxid'],'id,title');
		foreach($newsid as $key =>$v){if($v['id'] == $id){$post = $key;}}
		$lastpost = $post-1;
		$nextpost = $post+1;
		if($post == 0){
			$last = '<a class="fc-hei fz-14">没有更多了</a>';
			$next = '<a class="fc-hei fz-14" href="'.M_URL('home','articleDetail',$newsid[$nextpost]['id']).'">'.$newsid[$nextpost]['title'].'</a>';
		}elseif($post == (count($newsid)-1)){
			$last = '<a class="fc-hei fz-14" href="'.M_URL('home','articleDetail',$newsid[$lastpost]['id']).'">'.$newsid[$lastpost]['title'].'</a>';
			$next = '<a class="fc-hei fz-14">没有更多了</a>';
		}else{
			$last = '<a class="fc-hei fz-14" href="'.M_URL('home','articleDetail',$newsid[$lastpost]['id']).'">'.$newsid[$lastpost]['title'].'</a>';
			$next = '<a class="fc-hei fz-14" href="'.M_URL('home','articleDetail',$newsid[$nextpost]['id']).'">'.$newsid[$nextpost]['title'].'</a>';
		}
		$this->assign('PreItem',$last);
		$this->assign('NextItem',$next);
		$this->assign('page',$page);
		$this->assign('content',$dt);
		$this->assign('field',$value);
		$this->assign('id',$id);
	 	$this->display('about/articleDetail.html');
    }
    //查看具体内容
	public function DetailAction(){
		$type = ChkClng(KS_S('type',1));
		$id   = ChkClng(KS_G('request.id'));
		if($type==1){
			$AppModel   = M('app_news');
			//查询该网校所有新闻ID
			$newsid     = $AppModel->getAll('where wxid='.$GLOBALS['_DoM']['wxid'],'id,title');
			foreach($newsid as $key =>$v){if($v['id'] == $id){$post = $key;}}
			$lastpost = $post-1;
			$nextpost = $post+1;
			if($post == 0){
				$last = '<a class="fc-hei fz-14" style="color: #000;">没有更多了</a>';
				$next = '<a class="fc-hei fz-14" href="'.M_URL('home','Detail',$newsid[$nextpost]['id']).'" style="color: #000;">'.$newsid[$nextpost]['title'].'</a>';
			}elseif($post == (count($newsid)-1)){
				$last = '<a class="fc-hei fz-14" href="'.M_URL('home','Detail',$newsid[$lastpost]['id']).'" style="color: #000;">'.$newsid[$lastpost]['title'].'</a>';
				$next = '<a class="fc-hei fz-14">没有更多了</a>';
			}else{
				$last = '<a class="fc-hei fz-14" href="'.M_URL('home','Detail',$newsid[$lastpost]['id']).'" style="color: #000;">'.$newsid[$lastpost]['title'].'</a>';
				$next = '<a class="fc-hei fz-14" href="'.M_URL('home','Detail',$newsid[$nextpost]['id']).'" style="color: #000;">'.$newsid[$nextpost]['title'].'</a>';
			}
		    $res        = $AppModel->getRow('where id='.$id);
		    $this->assign('PreItem',$last);
		    $this->assign('NextItem',$next);
		}else{
			$AppModel   = M('app_h5_scheme');
		    $res              = $AppModel->getRow('where id='.$id);
		}
		$this->assign('infoary',$res);
		$this->assign('type',$type);
        $this->display('about/indexDetail.html');
    }
    //科汛V名师下载
	public function downloadAction(){
        $this->display('about/download.html');
    }
    //动态显示更多
	public function MoreAction(){
		$type = ChkClng(KS_S('type',1));
		if($type==1){
			$categoryid = ChkClng(null !==GF('categoryid') ? GF('categoryid'):'798');
			switch($categoryid){
				case 0:$title='科汛V名师动态';$where='where categoryid=798';break;
				case 800:$title='在线教育资讯动态';$where='where categoryid='.$categoryid;break;
				case 798:$title='科汛V名师动态';$where='where categoryid='.$categoryid;break;
				case 798:$title='科汛V名师动态';$where='where categoryid='.$categoryid;break;
				default:$title='科汛V名师动态';$where='where categoryid=798';break;
			}
			$AppModel           = M('app_news');
			$options            = $AppModel->getOptions('12',$where);//分页参数设置
	        $option['now_page'] = ChkClng(KS_S('p',1));
			$page               = Page($options);
			$res                = $AppModel->getPage($page,'adddate desc',$where);
		}elseif($type==2){
			$title='营销方案';
			$AppModel   = M('app_h5_scheme');
			$options            = $AppModel->getOptions('12','where marketing=0');//分页参数设置
	        $option['now_page'] = ChkClng(KS_S('p',1));
			$page               = Page($options);
			$res              = $AppModel->getPage($page,'addtime desc','where marketing=0');
		}

		$this->assign('title',$title);
        $this->assign('infoary',$res);
        $this->assign('page',$page);
        $this->assign('type',$type);
        $this->display('about/indexMore.html');
    }
    //科汛V名师产品介绍
    public function productAction(){
        $this->display('about/product.html');
    }
    //进入官网登录界面
	 public function OsLoginAction(){
	 	include  CURR_VIEW_PATH . "login.php";
     }
     //进入官方注册界面
	 public function OsRegisterAction(){
	 	include  CURR_VIEW_PATH . "register.php";
     }
     //进入帮助中心
	 public function helpAction(){
	 	$res        = $this->cache->GetACache('helpcategory');//取出缓存
     	$categoryid = null!=ChkClng(KS_G('get.categoryid'))?ChkClng(KS_G('get.categoryid')):0;
     	$textModel  = M('web_help_center');
//   	if($categoryid==0){
//   	for($i=0;$i<100;$i++){
//   		if($res[$i]['depth']==1){continue;}
//   		$categoryid = $res[$i]['categoryid'];
//	     	$help_classify=M('web_help_classify');
//	     	$value=$textModel->getRow('where categoryid='.$categoryid);
//	     	if(!empty($value)){break;}
//   	}}else{
//   		$value=$textModel->getRow('where categoryid='.$categoryid);
//   	}
        $this->assign('classifyary',$res);
        $this->assign('categoryid',$categoryid);
        $this->assign('textModel',$textModel);
	 	$this->display('about/help.html');
     }
//   public function searchtextAction(){
//   	$categoryid = ChkClng(KS_G('post.categoryid'));
////   	var_dump($categoryid);
//   	$textModel = M('web_help_center');
//   	$res = $textModel->getAll('where categoryid='.$categoryid,'');
//   	if($res){
//   		echo json_encode(array('list'=>$res,'errcode'=>'1000'));
//   	}else{
//   		echo json_encode(array('list'=>array(),'errcode'=>'1001'));
//   	}
//
//   }
     //进入虚拟教室
	 public function virtualAction(){
	 	$this->display('about/virtual.html');
     }
     //进入问题解答
	 public function questionAction(){
	 	$question=M('web_question_answer');
	 	$table = M('web_question_classify');
     	$classifyary = $table->getAll();
	 	$categoryid  = ChkClng(null !==GF('categoryid') ? GF('categoryid'):'0');
	 	if($categoryid==0){
	 		$options            = $question->getOptions('4','where classify='.$classifyary[0]['categoryid']);//分页参数设置
	        $option['now_page'] = ChkClng(KS_S('p',1));
			$page               = Page($options);
			$res              = $question->getPage($page,'orderid desc','where classify='.$classifyary[0]['categoryid']);
	 	}else{
	 		$options            = $question->getOptions('4','where classify='.$categoryid);//分页参数设置
	        $option['now_page'] = ChkClng(KS_S('p',1));
			$page               = Page($options);
			$res                = $question->getPage($page,'orderid desc','where classify='.$categoryid);
	 	}
	 	$this->assign('page',$page);
	 	$this ->assign('classifyary',$classifyary);
        $this->assign('questionAry',$res);
	 	$this->display('about/question.html');
     }

     //进入选课页面
     public function  xuankeAction(){
	  	$this->display('xuanke.html');
     }
     //进入选课页面
     public function  regAction(){
	  	$this->display('register.html');
     }
     //进入
     public function  getpwdAction(){
     	$id           = ChkClng(KS_G('request.id'));
		$website      = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		$issms        = getSetting(0,17,$GLOBALS['_DoM']['wxid']);
		$passtatus    = $this->cache->GetH('smsmodel','modelname','PassWord','status',$GLOBALS['_DoM']['wxid']);//读出缓存
		$logintatus   = $this->cache->GetH('smsmodel','modelname','Login','status',$GLOBALS['_DoM']['wxid']);//读出缓存
	    $status       = $this->cache->GetH('smsmodel','modelname','Register','status',$GLOBALS['_DoM']['wxid']);//读出缓存
	    if($status==1&&$issms==1){$this->assign('status',$status);}else{$this->assign('status',0);}
	    if($logintatus==1&&$issms==1){$this->assign('logintatus',$logintatus);}else{$this->assign('logintatus',0);}
	    if($passtatus==1&&$issms==1){$this->assign('passtatus',$passtatus);}else{$this->assign('passtatus',0);}
	  	$this->display('home/getpassword.html');
     }
     //进入招生报
	 public function zhaoshengbaoAction(){
		$app_h5_market = M('app_h5_market');
		$h5_rule = M('app_h5_rule');
		//全部
		$where = 'where del = 1 order by ishot desc,id desc limit 8';
		$h5s = $app_h5_market->getAll($where);
		foreach($h5s as $k =>$v){
			$info  = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$h5s[$k]['h5id'] = $info['id'];
		}
		$this->assign('all',$h5s);

		//节日类
		$where1 ='where del = 1 and istime !=0 order by ishot desc,id desc limit 8';
		$fh5 = $app_h5_market->getAll($where1);
		foreach($fh5 as $k =>$v){
			$info  = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$fh5[$k]['h5id'] = $info['id'];
		}
		$this->assign('fh5',$fh5);

		//抽奖
		$where1 ='where del = 1 and ismode =1 order by ishot desc,id desc limit 8';
		$ch5 = $app_h5_market->getAll($where1);
		foreach($ch5 as $k =>$v){
			$info  = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$ch5[$k]['h5id'] = $info['id'];
		}
		$this->assign('ch5',$ch5);

		//助力
		$where1 ='where del = 1 and ismode =2 order by ishot desc,id desc limit 8';
		$zh5 = $app_h5_market->getAll($where1);
		foreach($zh5 as $k =>$v){
			$info  = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$zh5[$k]['h5id'] = $info['id'];
		}
		$this->assign('zh5',$zh5);

		//排行
		$where1 ='where del = 1 and ismode =3 order by ishot desc,id desc limit 8';
		$ph5 = $app_h5_market->getAll($where1);
		foreach($ph5 as $k =>$v){
			$info  = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$ph5[$k]['h5id'] = $info['id'];
		}
		$this->assign('ph5',$ph5);

	  	//排行
		$where1 ='where del = 1 and ishot !=0 order by ishot desc,id desc limit 6';
		$hoth5 = $app_h5_market->getAll($where1);
		foreach($hoth5 as $k =>$v){
			$info  = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$hoth5[$k]['h5id'] = $info['id'];
		}
//		var_dump($hoth5);
		$this->assign('hoth5',$hoth5);
	  	$this->display('about/zhaoshengbao.html');
    }
    //进入market页面
    public function  marketAction(){
    			$app_h5_market = M('app_h5_market');
		$h5_rule = M('app_h5_rule');
		//全部
		$where = 'where del = 1 order by ishot desc,id desc limit 8';
		$h5s = $app_h5_market->getAll($where);
		foreach($h5s as $k =>$v){
			$info  = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$h5s[$k]['h5id'] = $info['id'];
		}
		$this->assign('all',$h5s);

		//节日类
		$where1 ='where del = 1 and istime !=0 order by ishot desc,id desc limit 8';
		$fh5 = $app_h5_market->getAll($where1);
		foreach($fh5 as $k =>$v){
			$info  = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$fh5[$k]['h5id'] = $info['id'];
		}
		$this->assign('fh5',$fh5);

		//抽奖
		$where1 ='where del = 1 and ismode =1 order by ishot desc,id desc limit 8';
		$ch5 = $app_h5_market->getAll($where1);
		foreach($ch5 as $k =>$v){
			$info  = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$ch5[$k]['h5id'] = $info['id'];
		}
		$this->assign('ch5',$ch5);

		//助力
		$where1 ='where del = 1 and ismode =2 order by ishot desc,id desc limit 8';
		$zh5 = $app_h5_market->getAll($where1);
		foreach($zh5 as $k =>$v){
			$info  = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$zh5[$k]['h5id'] = $info['id'];
		}
		$this->assign('zh5',$zh5);

		//排行
		$where1 ='where del = 1 and ismode =3 order by ishot desc,id desc limit 8';
		$ph5 = $app_h5_market->getAll($where1);
		foreach($ph5 as $k =>$v){
			$info  = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$ph5[$k]['h5id'] = $info['id'];
		}
		$this->assign('ph5',$ph5);

	  	//排行
		$where1 ='where del = 1 and ishot !=0 order by ishot desc,id desc limit 6';
		$hoth5 = $app_h5_market->getAll($where1);
		foreach($hoth5 as $k =>$v){
			$info  = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$hoth5[$k]['h5id'] = $info['id'];
		}
//		var_dump($hoth5);
		$this->assign('hoth5',$hoth5);
	  	$this->display('about/market.html');
    }
    //进入sass页面
    public function  sassAction(){
	  	$this->display('about/sass.html');
    }
    //微门户
    public function  gateAction(){
	  	$this->display('about/gate.html');
    }
    //点播
    public function  dianboAction(){
    	$businessModel      = M('web_business');
		$options            = $businessModel->getOptions('8','where 1=1');//分页参数设置
        $option['now_page'] = ChkClng(KS_S('p',1));;
		$page               = Page($options);
		$value              = $businessModel->getPage($page,'level desc','where 1=1');
		$this->assign('business',$value);
		$this->assign('page',$page);
	  	$this->display('about/dianbo.html');
    }
    //考试
    public function  examAction(){
    	$businessModel      = M('web_business');
		$options            = $businessModel->getOptions('8','where 1=1');//分页参数设置
        $option['now_page'] = ChkClng(KS_S('p',1));;
		$page               = Page($options);
		$value              = $businessModel->getPage($page,'level desc','where 1=1');
		$this->assign('business',$value);
		$this->assign('page',$page);
	  	$this->display('about/exam.html');
    }
    //直播
    public function  zhiboAction(){
    	$businessModel      = M('web_business');
		$options            = $businessModel->getOptions('8','where 1=1');//分页参数设置
        $option['now_page'] = ChkClng(KS_S('p',1));;
		$page               = Page($options);
		$value              = $businessModel->getPage($page,'level desc','where 1=1');
		$this->assign('business',$value);
		$this->assign('page',$page);
	  	$this->display('about/zhibo.html');
    }

    //线上课堂
    public function  onclassAction(){
	  	$this->display('about/onclass.html');
    }
    //课堂+
    public function  classexAction(){
	  	$this->display('about/classex.html');
    }
    //加入我们
    public function  joininAction(){
	  	$this->display('about/joinin.html');
    }
    //微信菜单栏show
    public function  showAction(){
    	$id   = ChkClng(KS_G('request.id'));
	  	$this->display('about/show'.$id.'.html');
    }
    //微信菜单栏show
    public function  popupAction(){
	  	$this->display('about/popup.html');
    }
//  //home端预登录
//	public function presiginAction(){
//		$username   = KS_G('post.username');
//		$password   = KS_G('post.password');
//      $usersModel = M('common_user');
//		$base       = $this->cache->GetACache('setting');//读出缓存
//		$user       = $usersModel->getRow("WHERE mobile='$username' and powertype!=0 and usertype!=0 limit 1",'password,rndpasswordc,usertype,userid,username,status,wxid,email');
//		if(!$user){$user = $usersModel->getRow("WHERE  username='$username' and mobilebing=1 and powertype!=0 and usertype!=0 limit 1",'password,rndpasswordc,usertype,userid,status,wxid,mobilebing');}
//		//if($base['mbings']=='0'){}
//		if(!$user){KS_INFO('没有该账号，请注册！');
//		}elseif($user['status']==2){KS_INFO('该账户已被锁定');
//	    }elseif($user['status']==0){KS_INFO('该账户未通过审核');}
//	    //var_dump(KS_MD5($password.KS_MD5($user['rndpasswordc'])));exit;
//		if($user['password']==KS_MD5($password.KS_MD5($user['rndpasswordc']))){
//			$common_domain = M('common_domain');
//			$mydomain      = $common_domain->getRow('where wxid='.$user['wxid'],'domain,status');
//			//域名为空，有问题，，删除所有，回去
//			if(!empty($mydomain)){
//				header("Content-type: application/json");
//			    echo json_encode(array('result'=>'succeed','url'=>$mydomain['domain'],'status'=>$mydomain['status']));
//			}
//		}else{
//			KS_INFO('登录失败');
//	    }
//	}

	//预览视频
	public function viewplayAction(){
		$videoId   = null !==GF('videoId') ? GF('videoId'):'0';
		if(!empty($videoId)){
		 	if(strstr($videoId,'mda-')==false){
		 		$chapter['serverid'] = 6;
		 		$chapter['videoId']  = $videoId;
		 	}else{
		 		$chapter['serverid'] = 7;
		 		$chapter['videoId']  = $videoId;
		 	}
		}
		if($chapter['serverid'] == 6){
		    if(empty($chapter['videoId'])){ KS_INFO('这门课还没上传视频，到其他课程看看',6);}
		    $ClassModel   = M('App/ClassModel');
	 	    $result       = $ClassModel  ->playVod($chapter['videoId']);
	 	    $player       = $result['play'];
		}
		include  CURR_VIEW_PATH . "playvdo.php";
	}

	public function newpostAction(){

		include  CURR_VIEW_PATH . "newpost.html";
	}
}