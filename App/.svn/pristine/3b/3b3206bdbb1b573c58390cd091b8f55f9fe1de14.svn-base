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
class CommonController extends Controller
{
   public  function _initialize(){
	   if(GF('tocken')!=NULL&&empty(getsession('user'))){
		   $live_secret   = M('app_live_secret');
		   $tockenval     = $live_secret->getRow('where wxid='.$GLOBALS['_DoM']['wxid']);
		   if(!empty($tockenval)){
			   if(KS_MD5($tockenval['token'])==GF('tocken')){
				   if(time()-$tockenval['endtime']<=7200){
					   $usersModel = M('common_user');
					   $user       = $usersModel->getRow("where wxid=".$tockenval['wxid']." and parentid=0 and powertype!=0 and usertype!=0 limit 1",'usertype,userid,username,wxid,status');
					   if(!empty($user)){
						   $userinfo['userid']   = $user['userid'];
						   $userinfo['username'] = $user['username'];
						   $userinfo['usertype'] = $user['usertype'];
						   $userinfo['wxid']     = $user['wxid'];//网校id
						   putsession('user',$userinfo);
					   }else{
						   echo '该用户权限不够';exit;
					   }
				   }else{
					   echo 'tocken时间过期';exit;
				   }
			   }else{
				   echo 'tocken错误';exit;
			   }
		   }else{
			   echo '该网校没有开通接口功能';exit;
		   }
	   }
		$this->userinfo    = User_GetUserInfo();
		check_homelogin($this->userinfo);//检查home端是否登录
		$this->userid      = $this->userinfo['userid'];//用户id
		$this->wxid        = $this->userinfo['wxid'];//网校id
		$this->powertype   = $this->userinfo['powertype'];//权限类型
		$this->rdbpower    = $this->userinfo['rdbpower'];//内容管理权限
		$this->AppName     = 'course';
		$this->appid       = KS_G('appid',6);
		if(empty($this->appid)){echo '应用id不能为空';exit;}
		$this->courseType  = null !==GF('courseType') ? GF('courseType'):'1';
		$this->livetype  = null !==GF('livetype') ? GF('livetype'):'1';
	   	$key_type = ['1'=>'video','3'=>'audio','4'=>'text_img','2'=>'live','6'=>'activity','5'=>'face','8'=>'shop'];
		$this->key = $key_type[$this->courseType];
	   
		check_power($this->userinfo,$this->key,'addUser,doaddUser,share');//检查管理员权限
	   
		$this->app         = $this->cache->GetA('appinfo','appid',$this->appid,'',true);
		if($this->app['isweb']==0){
			$this->title   = '网站分类';
		}else{
		    $this->title   = '应用分类';
		}

		$this->AppModel    = M('app_'.$this->app['tableename']);
		$websiteinfo       = $this->cache->GetHCache('website',$this->wxid);//读出缓存
		$this->module      = explode('|',$websiteinfo['module']);
		$this->courseid    = null !==GF('courseid') ? GF('courseid'):'0';
		if($this->courseid == 0){
			$this->courseid=ChkClng(KS_G('get.id'));
		}
		if($this->courseid!=0){
			  $this->course       = $this->AppModel->getRow(' where wxid='.$this->wxid.' and courseid ='.$this->courseid.' limit 1');
              if(!empty($this->course)){
	              $app_order_info     = M('app_order_info');
	              $this->studentCount = $app_order_info ->getOne('count(*)','where wxid='.$this->wxid.' and courseid='.$this->courseid.' and status!=-1');
	              $this->chapterModel = M($this->course['chaptertable']);
	              $this->keshiCount   =  $this->chapterModel ->getOne('count(*)','where wxid='.$this->wxid.' and courseid='.$this->courseid.' and depth =3');
              }
		}

		$this->setting     = $this->cache->GetSubH('apprelate','appid',$this->appid,'subappid',$this->courseType,'setting',$this->wxid);
		if(empty($this->setting)&&!empty($this->appid)){
		 	$Data['subappid'] = $this->courseType;
		 	$Data['wxid']     = $this->wxid;
		 	$Data['adddate']  = time();
		 	$Data['appid']    = $this->appid;
		 	$Data['userid']   = $GLOBALS['_DoM']['userid'];
		 	$Data['setting']  = '1※0※0※0※1※1※1※※※※※※※※※※※※※※※※※※※※※※※※※※';
		 	$apprelateModel   = M('common_app_userrelate');
		 	$apprelateModel->doadd($Data,'id');
		    $appcategory = $this->cache->PutHCache('apprelate',$this->wxid);
		    $this->setting     = '1※0※0※0※1※1※1※※※※※※※※※※※※※※※※※※※※※※※※※※';
		}

        if(!empty($this->setting)){$this->setting = explode('※',$this->setting);}
    }
}