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
	    //if($setting[1]==0){echo '未开启独立登录';exit;}
	    $loginconf = $this->cache->GetHCache('loginconf',$this->wxid);//读出缓存
		if(empty($loginconf)){
			  $Data['userid']       = $this->userid;
			  $Data['wxid']         = $this->wxid;
			  $Data['loginname']    = 'qq';
			  $Data['login']        = 'QQ登录';
              $Data['defaultpic']   = '/Public/app/images/icon-qq.png';
			  $Data['apiID']        = '203307';
			  $Data['apiKey']       = 'f86b816942fa2659395cb08db842c4fa';
			  //$Data['backurl']    = 'http://www.kesion.com/Plus/Login/loginback.php';
			  $Data['applyurl']     = 'https://connect.qq.com/';
			  $Data['issys']        = 1;
			  
			  $DataTwo['userid']    = $this->userid;
			  $DataTwo['wxid']      = $this->wxid;
			  $DataTwo['loginname'] = 'weixin';
			  $DataTwo['login']     = '微信登录';
			  $DataTwo['defaultpic']= '/Public/app/images/icon-wechat.png';
			  $DataTwo['apiID']     = 'wx6cc19d28b934cd36';
			  $DataTwo['apiKey']    = '16bff523a4f64003c6bd677f9bd61139';
			  //$DataTwo['backurl']   = 'http://tt.kesion.com/user/api/qq/callback.aspx';
			  $DataTwo['applyurl']  = 'https://open.weixin.qq.com/';
			  $DataTwo['issys']     = 1;
			  $loginModel = new LoginModel('app_login_content');
			  $loginModel->doAdd($Data,'id');
			  $loginModel->doAdd($DataTwo,'id');
		      $this->cache->PutHCache('loginconf',$this->wxid);//写入缓存
			  $loginconf = $this->cache->GetHCache('loginconf',$this->wxid);//读出缓存
		}
        include  CURR_VIEW_PATH . "config.php";	
   }
   //独立登录开关
   public function LoginswitchAction(){
        $loginstyle      = ChkClng(KS_G("post.loginstyle"));
        $setting         = $this->cache->GetH('apprelate','appid',$this->appid,'setting',$this->wxid);
	    $setting         = explode('※',$setting);
        $setting[1]      = $loginstyle; 
        $Data['setting'] = implode('※',$setting);
	    $apprelateModel  = M('common_app_userrelate');
	    $apprelateModel->update($Data,'wxid='.$this->wxid.' and appid = '.$this->appid);
	    $appcategory = $this->cache->PutHCache('apprelate',$this->wxid);  
        echo 'succeed';exit;
   }
   //独立登录配置
   public function settingAction(){
   	    $setting = $this->cache->GetH('apprelate','appid',$this->appid,'setting',$this->wxid);
	    $setting = explode('※',$setting);
		$type = ChkClng(KS_S('type')); 
		$where = '  where a.wxid ='.$this->wxid;
		if($type == 0){$where .= ' and a.type=0';}
		elseif($type == 1){$where .= ' and a.type=1';}
		
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and a.memberid like '%$keyword%'";}
		   elseif($keytype==2){$where.=" and b.username like '%$keyword%'";}
		   elseif($keytype==3){$where.=" and b.mobile like '%$keyword%'";}
		   elseif($keytype==4){$where.=" and a.memberip like '%$keyword%'";}
		}
		
		$common_user   = M('common_user');
		$where = "as a left join `$common_user->table` as b on a.memberid = b.userid $where";
		
		$options = $this->AppModel->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $this->AppModel->getPage($page,'adddate desc',$where,'b.username,b.mobile,a.*');
        include  CURR_VIEW_PATH . "index.php";
    }
    //登录列表页的批量删除
	public function loginbatchAction(){
		$id         = ChkSQL(KS_G('post.id'));
		if(empty($id)){KS_INFO('请选择');}
		foreach($id as $k=>$v){
		       $this->AppModel->delete('id ='.$v);	
		}
        $url1 = M_URL($this->AppName.'/Index','setting','',GP(""));
		KS_INFO("批量删除成功",0,$url1);		
	}
    //删除
    public function delLoginAction(){
   	    $id             = ChkSQL(KS_G("get.id"));
		$now_page       = ChkClng(KS_S('p',1));
		$this->AppModel->delete('id ='.$id);	
		$url = M_URL($this->AppName.'/Index','setting','',GP('p-'.$now_page));
		ks_header($url);
    }
    public function batchAction(){
		//$Datas['loginState'] = ChkClng(KS_G('post.loginState'));
		//$Rule['loginState']  = '首次登录是否创建设置|isEmpty';
		//$settingModel = new settingModel('common_setting');
		//Chkpost($Datas,$Rule,$settingModel);
		//$settingModel->updateSetting($Datas);
		//$this->cache->PutACache('setting');//存入缓存
		$loginModel = new LoginModel('app_login_content');
		$loginModel->status0($this->wxid);
		$statusid = null!==ChkSQL(KS_G('post.status')) ? ChkSQL(KS_G('post.status')): "";
		if(!empty($statusid)){$loginModel->status1($statusid,$this->wxid);}
		$id = ChkSQL(KS_G('post.id'));
		$login   = ChkSQL(KS_G('post.login'));
		$apiID   = ChkSQL(KS_G('post.apiID'));
		$apiKey  = ChkSQL(KS_G('post.apiKey'));
		//$backurl = ChkSQL(KS_G('post.backurl'));
		foreach ($id as $k => $v){   
		    $Data['login']   = $login[$k];
			$Data['apiID']   = $apiID[$k];
			$Data['apiKey']  = $apiKey[$k];
			//$Data['backurl'] = $backurl[$k];
		    $loginModel->update($Data,"id = $v");
		}
		$this->cache->PutHCache('loginconf',$this->wxid);//存入缓存
		$url = M_URL($this->AppName.'/Index','index','',GP(''));
		KS_INFO("更新成功",0,$url);
	}	
}