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
		$emailModel = M('app_email_content');
//		$values = $emailModel ->getRow('where wxid = '.$this->wxid.' limit 1');
//		if(!$values){
//        	$Data1['wxid']      = $this->wxid;
//			$Data1['model']     = 'Register';
//			$Data1['modelname'] = '会员注册';
//			$Data1['content']   = '尊敬的客户,您在{$sitename}网站注册验证码为{$code}。';
//			
//			$Data2['modelname'] = '取回密码';
//			$Data2['wxid']      = $this->wxid;
//			$Data2['model']     = 'PassWord';
//			$Data2['content']   = '尊敬的客户,您在{$sitename}网站找回密码验证码为{$code}。';
//			
//			$Data3['modelname'] = '会员登录';
//			$Data3['wxid']      = $this->wxid;
//			$Data3['model']     = 'Login';
//			$Data3['content']   = '尊敬的客户,您在{$sitename}网站会员登录验证码为{$code}。';
//			
//			$Data4['modelname'] = '手机验证';
//			$Data4['wxid']      = $this->wxid;
//			$Data4['model']     = 'Validate';
//			$Data4['content']   = '尊敬的客户,您在{$sitename}网站手机验证验证码为{$code}。';
//			
//			$emailModel->doadd($Data1,"id");
//		    $emailModel->doadd($Data2,"id");
//		    $emailModel->doadd($Data3,"id");
//		    $emailModel->doadd($Data4,"id");
//      }   	
   	    $values     = $emailModel ->getAll('where wxid = '.$this->wxid);	
   	    $emailmodel = $this->cache->GetACache('emailmodel');
		include  CURR_VIEW_PATH . "config.php";	
   }	
   public function configAction(){
   	    $emailnum    = $this->cache->GetH('domainbilling','type',2,'number',$this->wxid);
		$setting     = getSet($this->wxid,$this->appid);//获取网站配置
		$issuccess   = null !==GF('issuccess') ? GF('issuccess'):'3'; 
		$where = '  where a.wxid ='.$this->wxid;
		if($issuccess == 0){$where .= ' and a.issuccess=0';}
		elseif($issuccess == 1){$where .= ' and a.issuccess=1';}
		$keyword = ChkSQL(KS_S('keyword'));//搜索
		$keytype=null !==GF('keytype') ? GF('keytype'):0;
	    //判断是否输入关键字
		if(!empty($keyword)){
		     if($keytype==1){$where.=" and b.username like '%$keyword%'";}
		     elseif($keytype==2){$where.=" and a.content like '%$keyword%'";}
		}
		$common_user   = M('common_user');
		$EmailModel    = M('app_email_log');
		$where   = "as a left join `$common_user->table` as b on a.memberid = b.userid $where";
		$options = $EmailModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$values  = $EmailModel->getPage($page,'adddate desc',$where,'b.username,a.*');
        include  CURR_VIEW_PATH . "index.php";	 	  
	}
	//编辑邮箱模板
	public function editAction(){
		$id         = ChkSQL(KS_G('get.id'));
		$emailModel = M('app_email_content');
   	    $value      = $emailModel ->getRow('where id = '.$id.' limit 1');
		$content    = ks_editor('content',$value['content']);
   	    include  CURR_VIEW_PATH . "modelEdit.php";	 
	}
	//进行邮箱编辑操作
	public function doeditAction(){
		$id = ChkSQL(KS_G('get.id'));
		$emailModel = M('app_email_content');
		//$Data['model']     = ChkSQL(KS_G('post.model'));
		//$Data['modelname'] = ChkSQL(KS_G('post.modelname'));
		$Data['content']   = ChkSQL(KS_G('post.content'));
		$emailModel->update($Data,'id='.$id);
		$this->cache->PutHCache('emailmodel',$this->wxid);
		$url1 = M_URL($this->AppName.'/Index','index','',GP(""));
		KS_INFO("保存成功",3,$url1);
	}
	//删除
    public function delEmailAction(){
   	    $id       = ChkSQL(KS_G("get.id"));
		$now_page = ChkClng(KS_S('p',1));
		$this->AppModel->delete('id ='.$id);	
		$this->cache->PutHCache('emailmodel',$this->wxid);//标题
		$url= M_URL($this->AppName.'/Index','config','',GP('p-'.$now_page));
		ks_header($url);
    }
	//邮箱列表页的批量删除
	public function emailbatchAction(){
		$id         = ChkSQL(KS_G('post.id'));
		if(empty($id)){KS_INFO("请选择",0,'','',1);}
		$email_log  = M('app_email_log');
		foreach($id as $k=>$v){$email_log->delete('id='.$v);}
        $url1 = M_URL($this->AppName.'/Index','config','',GP(""));
		KS_INFO("批量删除成功",0,$url1);		
	}
	//开通模板
    public function openmodelAction(){
   	    $id = ChkClng(KS_G("get.id"));
   	    if(empty($id)){KS_INFO('请选择',0,'','',1);}
   	    $commonemailModel  = M('common_email_content');
   	    $cachemodel        = $commonemailModel->getRow("where id=$id limit 1"); 
   	    $Data['wxid']      = $this->wxid;
        $Data['userid']    = $this->userid;
        $Data['model']     = $cachemodel['model'];
        $Data['modelname'] = $cachemodel['modelname'];
        $Data['content']   = $cachemodel['content'];
        $Data['status']    = 1;
        $emailModel        = M('app_email_content');
   	    $emailModel->doadd($Data,"id");
   	    $this->cache->PutHCache('emailmodel',$this->wxid);//标题
   	    $url= M_URL($this->AppName.'/Index','','',GP(''));
		ks_header($url);
    }
	//删除模板
	public function delcontentAction(){
    	$id               = ChkClng(KS_G('get.id'));
    	if(empty($id)){KS_INFO('不能为空',0,'','',1);}
    	$emailModel      = M('app_email_content');
    	$emailModel->delete("id=$id and wxid=$this->wxid");
    	$this->cache->PutHCache('emailmodel',$this->wxid);
		$url= M_URL($this->AppName.'/Index','','',GP(''));
		ks_header($url);
    }
    //更新单个模板
	public function modelwitchAction(){
    	$id                 = ChkClng(KS_G('get.id'));
    	if(empty($id)){KS_INFO('不能为空',0,'','',1);}
    	//$status  =  $this->cache->GetH('smsmodel','id',$id,'status',$this->wxid);
    	$emailModel         = M('app_email_content');
    	$status             = $emailModel->getOne('status',"where id=$id and wxid=$this->wxid limit 1");
    	if($status==1){$Data['status'] = 0;}else{$Data['status'] = 1;}
    	$emailModel->update($Data,"id=$id and wxid=$this->wxid");
    	$this->cache->PutHCache('emailmodel',$this->wxid);
    	//$this->cache->PutHCache('smsmodel',$this->wxid);exit;
    }
	//邮箱模板页的批量勾选
	public function batchAction(){
		$id              = ChkSQL(KS_G('post.id'));
		$emailModel      = M('app_email_content');
  	    $Datas['status'] = 0;
  	    $emailModel->update($Datas,'wxid='.$this->wxid);
		foreach($id as $k=>$v){
		  	   $Data['status'] = 1;
		  	   $emailModel->update($Data,'id='.$v.' and wxid='.$this->wxid);
		}
		$this->cache->PutHCache('emailmodel',$this->wxid);
        $url1 = M_URL($this->AppName.'/Index','index','',GP(""));
		KS_INFO("保存成功",0,$url1);		
	}
	
	public function doUpdateSmsAction(){
		$url= M_URL($this->AppName.'/Index','','',GP(''));
		//KS_INFO("更新成功",0,$url);
	}
	//邮箱应用配置
	public function settingAction(){
		echo '邮箱应用配置';exit;
	}
	//独立登录开关
    public function EmailswitchAction(){
        $emailstyle      = ChkClng(KS_G("post.emailstyle"));
        $setting         = $this->cache->GetH('apprelate','appid',$this->appid,'setting',$this->wxid);
	    $setting         = explode('※',$setting);
        $setting[1]      = $emailstyle; 
        $Data['setting'] = implode('※',$setting);
	    $apprelateModel  = M('common_app_userrelate');
	    $apprelateModel->update($Data,'wxid='.$this->wxid.' and appid = '.$this->appid);
	    $appcategory = $this->cache->PutHCache('apprelate',$this->wxid);  
        echo 'succeed';exit;
    }	
}