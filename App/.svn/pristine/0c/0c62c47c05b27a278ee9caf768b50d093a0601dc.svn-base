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
	 //进入系统设置页
     public function indexAction(){
       	 $info = $this->cache->GetHCache('website',$this->wxid);//读出缓存
		 if(empty($info)){
			  $Data['wxid']    = $this->wxid;
			  $Data['userid']  = $this->userid;
			  $Data["signsms"] = '【KESION】';
			  $websiteModel    = M('App/WebsiteModel/common_user_website'); 
			  $websiteModel->websiteAdd($Data);
		      $this->cache->PutHCache('website',$this->wxid);//写入缓存
			  $info = $this->cache->GetHCache('website',$this->wxid);//读出缓存
		 }
		 $setting      =  explode('|',$info['setting']);
		 $ismember     =  $setting[0];//是否开启会员
		 $isregister   =  $setting[1];//是否允许注
		 $isemaillogin =  $setting[2];//是否允许邮箱登
		 $isphonelogin =  $setting[3];//是否允许手机登录
		 $isinfo       =  $setting[4];//是否强制完善信息
		 $isQuestAudit =  $setting[5];//提问是否审核
		 $isshuiyin    =  $setting[6];//提问开启水印
		 if($info['isbos'] !=0){
		 	$isbos    =  $setting[7];//提问开启bos
		 }
		 $tableModel   =  M('common_table');
		 $tableid      =  $tableModel->getOne('tableid',"where tablename='common_user_website'");
         include  CURR_VIEW_PATH . "index.php";
     }
     //系统设置添加
     public function websiteAddAction(){
		$websiteModel            = M('App/WebsiteModel/common_user_website'); 
		$Data['wxid']            = $this->wxid;
		if(!empty(ChkSQL(KS_G('post.logo')))){$Data['logo']        = ChkSQL(KS_G('post.logo'));}
		if(!empty(ChkSQL(KS_G('post.loginlogo')))){$Data['loginlogo']  = ChkSQL(KS_G('post.loginlogo'));}
		if(!empty(ChkSQL(KS_G('post.homelogo')))){$Data['homelogo']  = ChkSQL(KS_G('post.homelogo'));}
		if(!empty(ChkSQL(KS_G('post.shuiyin')))){$Data['shuiyin']      = ChkSQL(KS_G('post.shuiyin'));}
		
		$Data['isbos']        = ChkSQL(KS_G('post.isbos'));
		$Data['sitename']        = ChkSQL(KS_G('post.sitename'));
		$Data['copyright']       = ChkSQL(KS_G('post.copyright'));
		$Data['status']          = ChkClng(KS_G('post.status'));
		$Data['seotitle']        = ChkSQL(KS_G('post.seotitle'));
		$Data['metakeywords']    = ChkSQL(KS_G('post.metakeywords'));
		$Data['metadescription'] = ChkSQL(KS_G('post.metadescription'));
		$setting    = $websiteModel->getOne('setting',"where userid = $this->userid");
		$setting    = explode('|',$setting);
		$setting[0] = ChkClng(KS_G('post.ismember'));//是否开启会员
		$setting[1] = ChkClng(KS_G('post.isregister'));//是否允许注册
		$setting[2] = ChkClng(KS_G('post.isemaillogin'));//是否允许邮箱登录
		$setting[3] = ChkClng(KS_G('post.isphonelogin'));//是否允许手机登录
		$setting[4] = ChkClng(KS_G('post.isinfo'));//是否强制完善信息
		$setting[5] = ChkClng(KS_G('post.isQuestAudit'));//是否提问审核
		$setting[6] = ChkClng(KS_G('post.isshuiyin'));//是否开启水印
		$setting[7]   =   ChkClng(KS_G('post.isbos'));//提问开启bos
		$Data['setting'] = implode('|',$setting);
		/*----------------------字段拼接测试中------------------------------*/
//		$tableModel = M('common_table');
//		$tableid = $tableModel->getOne('tableid',"where tablename='common_user_website'");
//		$fieldModel = M('common_table_field');//实例化字段表
//		$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
//		foreach($Field as $Fk => $Fv){
//			 $fieldname = $Fv['fieldname'];
//			 $Data[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
//			 if($Fv['mustinput']==1)
//			 {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
//		}
		$websiteModel->update($Data,"wxid=$this->wxid");
		$this->cache->PutHCache('website',$this->wxid);//写入缓存
		//$url =  M_URL('config/index','index');
		KS_INFO('更新成功',0);
    }
    //系统设置添加
     public function wxinfoAddAction(){
		$websiteModel            = M('App/WebsiteModel/common_user_website'); 
		$Data['wxid']            = $this->wxid;
		/*----------------------字段拼接测试中------------------------------*/
		$tableModel = M('common_table');
		$tableid = $tableModel->getOne('tableid',"where tablename='common_user_website'");
		$fieldModel = M('common_table_field');//实例化字段表
		$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
		foreach($Field as $Fk => $Fv){
			 $fieldname = $Fv['fieldname'];
			 $Data[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
			 if($Fv['mustinput']==1)
			 {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
		}
		$websiteModel->update($Data,"wxid=$this->wxid");
		$this->cache->PutHCache('website',$this->wxid);//写入缓存
		$url = M_URL($this->AppName.'/Index','wxinfo','',GP(''));
		KS_INFO('更新成功',0,$url);
    }
    //进入网站介绍页
	public function wxinfoAction(){
		$info = $this->cache->GetHCache('website',$this->wxid);//读出缓存
		 if(empty($info)){
			  $Data['wxid']    = $this->wxid;
			  $Data['userid']  = $this->userid;
			  $Data["signsms"] = '【KESION】';
			  $websiteModel    = M('App/WebsiteModel/common_user_website'); 
			  $websiteModel->websiteAdd($Data);
		      $this->cache->PutHCache('website',$this->wxid);//写入缓存
			  $info = $this->cache->GetHCache('website',$this->wxid);//读出缓存
		 }
		 $setting      =  explode('|',$info['setting']);
		 $ismember     =  $setting[0];//是否开启会员
		 $isregister   =  $setting[1];//是否允许注
		 $isemaillogin =  $setting[2];//是否允许邮箱登
		 $isphonelogin =  $setting[3];//是否允许手机登录
		 $isinfo       =  $setting[4];//是否强制完善信息
		 $isQuestAudit =  $setting[5];//提问是否审核
		 $isshuiyin    =  $setting[6];//提问开启水印
		 if($info['isbos'] !=0){
		 	$isbos    =  $setting[7];//提问开启bos
		 }
		 $tableModel   =  M('common_table');
		 $tableid      =  $tableModel->getOne('tableid',"where tablename='common_user_website'");
		
	 	//$appuserrelate      = new IndexModel('common_app');
		//$nustchooseapp      = $appuserrelate->getMustChoose();
		include  CURR_VIEW_PATH . "wxinfo.php";  
	}
	//进入开发者中心
	public function liveSecretAction(){
		$model=M('app_live_secret');
		$values=$model->getRow(' where wxid='.$this->wxid.' limit 1' );
		include  CURR_VIEW_PATH . "liveSecret.php"; 
	}
	//开通开发者账号
	public function dosecretAction(){
		$Data['wxid']=$this->wxid;
		$Data['isenable']=1;
		$Data['appid']=md5($this->wxid.time());
		$Data['appsecret']=md5($Data['appid'].time().$this->wxid);
		$model=M('app_live_secret');
		$model->doAdd($Data,'id');
		$url = M_URL($this->AppName.'/Index','liveSecret','',GP(''));
		KS_INFO('开通成功',0,$url);	
	}
	//秘钥重置
	public function resetSecretAction(){
        $model=M('app_live_secret');
		$values=$model->getRow(' where wxid='.$this->wxid.' limit 1' );
		$Data['appsecret']=md5($values['appid'].time().$this->wxid);
		$Data['token']='';
		$model->update($Data,'wxid='.$this->wxid);
		$url = M_URL($this->AppName.'/Index','liveSecret','',GP(''));
		KS_INFO('更新成功',0,$url);		
	}
}