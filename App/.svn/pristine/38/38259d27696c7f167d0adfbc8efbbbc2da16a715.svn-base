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
    public function indexAction(){
    	$setting = $this->cache->GetH('apprelate','appid',$this->appid,'setting',$this->wxid);
  	    if(empty($setting)){//没开通的,帮忙开通
  	    	   $Data001['wxid']    = $this->wxid;
  	    	   $Data001['appid']   = $this->appid;
  	    	   $Data001['userid']  = $this->userid;
               $IndexModel         = M('Application/IndexModel');
               $IndexModel         ->appopen($Data001);
               $setting = $this->cache->GetH('apprelate','appid',$this->appid,'setting',$this->wxid);
     	}
	    $setting = explode('※',$setting);
        $info = $this->cache->GetHCache('website',$this->wxid);//读出缓存
		if(empty($info)){
			 $Data['userid']  = $this->userid;
			 $Data['wxid']    = $this->wxid;
			 $Data["signsms"] = '【科汛V名师】';
			 $websiteModel    = M('App/WebsiteModel/common_user_website'); 
			 $websiteModel->websiteAdd($Data);//写入缓存
		     $this->cache->PutHCache('website',$this->wxid);
			 $info = $this->cache->GetHCache('website',$this->wxid);//读出缓存
		}
		$issms = 1;
		//getSetting(6,$info['setting']);
		//var_dump($info);exit;
		$signvalue = $this->cache->GetHCache('smssign',$this->wxid);
		if(!$signvalue){
			$DataSign['wxid']      = $this->wxid;
			$DataSign['userid']    = $this->userid;
			$DataSign['signsms']   = '【科汛V名师】';
			$DataSign['sitename']  = $info['sitename'];
			$DataSign['logo']      = $info['logo'];
			$DataSign['categoryid']= $info['categoryid'];
			$DataSign['intro']     = $info['intro'];
			$DataSign['setting']   = $info['setting'];
			$signvalue             = M('common_sms_sign'); 
		    $signvalue->doadd($DataSign,"id");
			$this->cache->PutHCache('smssign',$this->wxid);
		   	$signvalue = $this->cache->GetHCache('smssign',$this->wxid);
	    }
 	    $values    = $this->cache->GetHCache('smsmodel',$this->wxid);
//		if(!$values){
//			$Data1['wxid']      = $this->wxid;
//			$Data1['userid']    = $this->userid;
//			$Data1['model']     = '会员注册';
//			$Data1['modelname'] = 'Register';
//			$Data1['content']   = '尊敬的客户,您在{$sitename}网站注册验证码为{$code}。';
//			
//			$Data2['modelname'] = 'PassWord';
//			$Data2['userid']    = $this->userid;
//			$Data2['wxid']      = $this->wxid;
//			$Data2['model']     = '取回密码';
//			$Data2['content']   = '尊敬的客户,您在{$sitename}网站找回密码验证码为{$code}。';
//			
//			$Data3['modelname'] = 'Login';
//			$Data3['userid']    = $this->userid;
//			$Data3['wxid']      = $this->wxid;
//			$Data3['model']     = '会员登录';
//			$Data3['content']   = '尊敬的客户,您在{$sitename}网站会员登录验证码为{$code}。';
//			
//			$Data4['modelname'] = 'Validate';
//			$Data4['userid']    = $this->userid;
//			$Data4['wxid']      = $this->wxid;
//			$Data4['model']     = '手机验证';
//			$Data4['content']   = '尊敬的客户,您在{$sitename}网站手机验证验证码为{$code}。';
//			$SmsModel = M('app_sms_content'); 
//		    $SmsModel->doadd($Data1,"id");
//		    $SmsModel->doadd($Data2,"id");
//		    $SmsModel->doadd($Data3,"id");
//		    $SmsModel->doadd($Data4,"id");
//			$this->cache->PutHCache('smsmodel',$this->wxid);
//		   	$values = $this->cache->GetHCache('smsmodel',$this->wxid);
//	    }
	    $smsmodel = $this->cache->GetACache('smsmodel');
	    $realnamestatus = getRealnameStatus($this->wxid);//获取实名认证的状态
	    $smssignstatus  = getSmssignStatus($this->wxid);//获取签名认证的状态
        include  CURR_VIEW_PATH . "config.php";	 
    }
    //提交标签审核
    public function smssignAction(){
    	$realnamestatus = getRealnameStatus($this->wxid);//获取实名认证的状态
    	if($realnamestatus==0){KS_INFO('还未实名认证');}
		$DataSign['signsms']   =  ChkSQL(KS_G("post.signsms"));
		$DataSign['status']    =  1;
		$DataSign['adddate']   =  time();
		$signvalue             =  M('common_sms_sign');  
		$Rule['signsms']       = '短信签名|isEmpty,isDbexis';
		Chkpost($DataSign,$Rule,$signvalue,'wxid='.$this->wxid);
	    $signvalue->update($DataSign,'wxid='.$this->wxid);
		$this->cache->PutHCache('smssign',$this->wxid);
		$url       = M_URL($this->AppName.'/Index','index','',GP(''));
		KS_INFO('提交审核成功',0,$url);
    }
    //删除
    public function delSmsAction(){
   	    $id = ChkSQL(KS_G("get.id"));
   	    if(empty($id)){KS_INFO('请选择');}
		$now_page = ChkClng(KS_S('p',1));
		$Data['status'] = '-1'; 
		$this->AppModel->update($Data,'id ='.$id);	
		$url= M_URL($this->AppName.'/Index','config','',GP('p-'.$now_page));
		ks_header($url);
    }
    //批量操作
	public function batchAction(){
		$id       = ChkSQL(KS_G("post.id"));
		if(empty($id)){KS_INFO('请选择');}
		$now_page = ChkClng(KS_S('p',1));
		$batch       = ChkClng(KS_G('post.batch')); 
		if($batch==1){//删除
			$Data['status'] =-1;
			foreach($id as $k=>$v){$this->AppModel->update($Data,'id ='.$v);}
		}
		$url = M_URL($this->AppName.'/Index','config','',GP('p-'.$now_page));
		KS_INFO('批量删除成功',0,$url);
	}
    public function configAction(){
    	$smsnum    = $this->cache->GetH('domainbilling','type',1,'number',$this->wxid);
   	    $setting   = getSet($this->wxid,$this->appid);//获取网站配置
		$issuccess = null !==GF('issuccess') ? GF('issuccess'):'3'; 
		$where = 'where a.wxid ='.$this->wxid;
		$where .= ' and a.status!=-1';
		if($issuccess == 0){$where .= ' and a.issuccess=0';}
		elseif($issuccess == 1){$where .= ' and a.issuccess=1';}
		$keyword = ChkSQL(KS_S('keyword'));//搜索
		$keytype = ChkClng(KS_S('keytype',1));
	    //判断是否输入关键字
		if(!empty($keyword)){
		     if($keytype==1){$where.=" and a.memberid like '%$keyword%'";}
		     elseif($keytype==2){$where.=" and b.username like '%$keyword%'";}
		     elseif($keytype==3){$where.=" and a.mobile like '%$keyword%'";}
		     elseif($keytype==4){$where.=" and a.memberip like '%$keyword%'";}
		}
		$common_user   = M('common_user');
		$where = "as a left join `$common_user->table` as b on a.memberid = b.userid $where";
		$options = $this->AppModel->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $this->AppModel->getPage($page,'adddate desc',$where,'b.username,b.mobile,a.*');
        include  CURR_VIEW_PATH . "index.php";	   
	}
	//删除模板
	public function delcontentAction(){
    	$id               = ChkClng(KS_G('get.id'));
    	if(empty($id)){KS_INFO('不能为空');}
    	$SmsModel         = M('app_sms_content');
    	$SmsModel->delete("id=$id and wxid=$this->wxid");
    	$this->cache->PutHCache('smsmodel',$this->wxid);
		$url= M_URL($this->AppName.'/Index','','',GP(''));
		ks_header($url);
    }
    //开通模板
    public function openmodelAction(){
   	    $id = ChkClng(KS_G("get.id"));
   	    if(empty($id)){KS_INFO('请选择');}
   	    $cachemodel = $this->cache->GetA('smsmodel','id',$id,'',true);
   	    $Data['wxid']      = $this->wxid;
        $Data['userid']    = $this->userid;
        $Data['model']     = $cachemodel['model'];
        $Data['modelname'] = $cachemodel['modelname'];
        $Data['content']   = $cachemodel['content'];
        $Data['status']    = 1;
   	    $SmsModel          = M('app_sms_content');
   	    $SmsModel->doadd($Data,"id");
   	    $this->cache->PutHCache('smsmodel',$this->wxid);
   	    $url= M_URL($this->AppName.'/Index','','',GP(''));
		ks_header($url);
    }
    //更新单个模板
	public function modelwitchAction(){
    	$id               = ChkClng(KS_G('get.id'));
    	if(empty($id)){KS_INFO('不能为空');}
    	$status  =  $this->cache->GetH('smsmodel','id',$id,'status',$this->wxid);
    	if($status==1){$Data['status'] = 0;}else{$Data['status'] = 1;}
    	$SmsModel         = M('app_sms_content');
    	$SmsModel->update($Data,"id=$id and wxid=$this->wxid");
    	$this->cache->PutHCache('smsmodel',$this->wxid);exit;
    }
	//批量更新模板
	public function doUpdateSmsAction(){
		 $SmsModel         = M('app_sms_content');
		 $id               = ChkSQL(KS_G('post.id'));
		 //$content          = ChkSQL(KS_G('post.content'));
		 $info             = $this->cache->GetHCache('website',$this->wxid);//读出缓存
		 $setting          = explode('|',$info['setting']);
		 $setting[6]       = ChkClng(KS_G('post.issms'));//是否开启短信
		 $Data2['setting'] = implode('|',$setting);
		 $Data2['signsms'] = ChkSQL(KS_G('post.signsms'));
		 $websiteModel     = M('common_user_website');
		 $websiteModel->update($Data2,"wxid=$this->wxid");
		 $this->cache->PutHCache('website',$this->wxid);
		 $statusid=isset($_POST["status"]) ? $_POST["status"] : "";
		 foreach($id as $k=>$v){
			$Data['status'] =0;
			//$Data['content']=$content[$k];
			$SmsModel->update($Data,"id=$v");	 
	    }
		if(!empty($statusid)){
			 foreach ($statusid as $k=>$v){
				    $Data1['status'] =1;
				    $SmsModel->update($Data1,"id=$v");	 
			 }
		}
	    $this->cache->PutHCache('smsmodel',$this->wxid);
		$url= M_URL($this->AppName.'/Index','','',GP(''));
		KS_INFO("更新成功",0,$url);
	}
	//独立短信开关
    public function SmsswitchAction(){
        $smsstyle        = ChkClng(KS_G("post.smsstyle"));
        $setting         = $this->cache->GetH('apprelate','appid',$this->appid,'setting',$this->wxid);
	    $setting         = explode('※',$setting);
        $setting[1]      = $smsstyle; 
        $Data['setting'] = implode('※',$setting);
	    $apprelateModel  = M('common_app_userrelate');
	    $apprelateModel->update($Data,'wxid='.$this->wxid.' and appid = '.$this->appid);
	    $appcategory = $this->cache->PutHCache('apprelate',$this->wxid);  
        echo 'succeed';exit;
    }
    
}