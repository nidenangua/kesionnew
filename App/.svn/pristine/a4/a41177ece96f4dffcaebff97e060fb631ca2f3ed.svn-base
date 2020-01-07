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
    public  function _initialize()
    {
        if (null === getsession('admin')) {
            exit("<script>top.location.href='".M_URL('login','index')."'</script>");
        } 
		$this->admininfo  = getsession('admin');
		$this->AppName    = 'live';
		$this->appid=null !==GF('appid') ? GF('appid'):'0';
		$this->userid = null !==GF('userid') ? GF('userid'):'';
		$this->isweb  = null !== GF('isweb') ? GF('isweb'):'';
		if($this->userid!==''){
			$userModel      = M('common_user');
		    $this->userinfo = $userModel->getRow("where userid=$this->userid limit 1");
			$this->wxid     = $this->userinfo['wxid'];//网校id
		}
		$this->app = $this->cache->GetA('appinfo','appid',$this->appid,'',true);
		if($this->app['isweb']==0)
		{
			$this->title = '网站分类';
		}else{
		    $this->title = '应用分类';
		}
		$this->AppModel = M('app_'.$this->app['tableename']);
    }
}