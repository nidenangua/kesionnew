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
class IndexController extends CommonController{
    /**
     *评论数据列表
     */
    public function indexAction(){
    	$setting = $this->cache->GetH('apprelate','appid',$this->appid,'setting',$this->wxid);
    	if(!empty($setting)){$setting = explode('※',$setting);}
		$status = ChkClng(KS_S('status','3'));
	    $where = 'where a.wxid ='.$this->wxid;
	    $where .= ' and a.status!=-1';
		if($status == 0){$where .= ' and a.status=0';}
		elseif($status == 1){$where .= ' and a.status=1';}
		$keyword=ChkSQL(KS_S('keyword'));//搜索
		$keytype=ChkClng(KS_S('keytype'));
        //判断是否输入关键字
		if(!empty($keyword)){

		     if($keytype==1){$where.=" and a.interact like '%$keyword%'";}
		     elseif($keytype==2){$where.=" and a.membername like '%$keyword%'";}
		}
		$common_user   = M('common_user');
		$where         = "as a left join `$common_user->table` as b on a.memberid = b.userid $where";
        $options = $this->AppModel->getOptions('10',$where);//分页参数设置
	    $page    = Page($options);
	    $values  = $this->AppModel->getPage($page,'adddate desc',$where,'b.*,a.*');
		include  CURR_VIEW_PATH . "index.php";
	}
	public function configAction(){
	    $values = $this->cache->GetHCache('smsmodel',$this->userid);
		if(!$values){
			$Data1['uid'] =$this->userid;
			$Data1['model']= '会员注册';
			$Data1['modelname'] = 'Register';
			$Data1['content']= '尊敬的客户,您在{$sitename}网站注册验证码为{$code}。';

			$Data2['modelname'] = 'PassWord';
			$Data2['uid'] =$this->userid;
			$Data2['model']= '取回密码';
			$Data2['content']= '尊敬的客户,您在{$sitename}网站找回密码验证码为{$code}。';

			$Data3['modelname'] = 'Login';
			$Data3['uid'] =$this->userid;
			$Data3['model']= '会员登录';
			$Data3['content']= '尊敬的客户,您在{$sitename}网站会员登录验证码为{$code}。';

			$Data4['modelname'] = 'Validate';
			$Data4['uid'] =$this->userid;
			$Data4['model']= '手机验证';
			$Data4['content']= '尊敬的客户,您在{$sitename}网站手机验证验证码为{$code}。';

		    $websiteModel->doadd($Data1,"id");
		    $websiteModel->doadd($Data2,"id");
		    $websiteModel->doadd($Data3,"id");
		    $websiteModel->doadd($Data4,"id");
		   	$values = $this->cache->GetHCache('smsmodel',$this->userid);
	    }
        include  CURR_VIEW_PATH . "config.php";
	}
	//互动应用配置
	public function settingAction(){
		echo '互动应用配置';exit;
	}
	//批量操作
	public function batchAction(){
		$id = ChkSQL(KS_G("post.id"));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$now_page = ChkClng(KS_S('p',1));
		$batch       = ChkClng(KS_G('post.batch'));
		$url = M_URL($this->AppName.'/Index','Index','',GP('p-'.$now_page));
		if($batch==1){//删除
			foreach($id as $k=>$v){
                if ($v>0){
                    $this->AppModel->delete('interactid ='.ChkClng($v));
                }
		    }
		    KS_INFO('批量删除成功',0,$url);
		}elseif($batch==2){//审核
			 $Data['status']=1;
			 foreach($id as $k=>$v){
                 if ($v>0){
                     $this->AppModel->update($Data,'interactid='.ChkClng($v));
                 }
			 }
			 KS_INFO('审核成功',0,$url);
		}elseif($batch==3){
			 $Data['status']=0;
			 foreach($id as $k=>$v){
                 if ($v>0){
                     $this->AppModel->update($Data,'interactid='.ChkClng($v));
                 }
			 }
			 KS_INFO('取消审核成功',0,$url);
		}
	}
	//删除聊天消息
	public function delinteractAction(){
		$id = ChkClng(KS_G("get.id"));
		if($id<=0){KS_INFO('请选择',0,'','',1);}
		$Data['status']=-1;
		$this->AppModel->update($Data,'interactid ='.ChkClng($id));
		$now_page = ChkClng(KS_S('p',1));
		$url = M_URL($this->AppName.'/Index','Index','',GP('p-'.$now_page));
		ks_header($url);
	}
	//更新聊天状态
	public function updatestatusAction(){
		$id = ChkClng(KS_G("get.id"));
		if($id<=0){KS_INFO('请选择',0,'','',1);}
		$status = $this->AppModel->getOne('status','where interactid ='.$id);
		if($status==1){$Data['status']=0;}elseif($status==0){$Data['status']=1;}
		$this->AppModel->update($Data,'interactid ='.$id);
		echo $Data['status'];
	}
}
  