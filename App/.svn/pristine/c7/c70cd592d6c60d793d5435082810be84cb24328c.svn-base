<?php

use Kesion\Controller;
class IndexController extends Controller{
	public  function _initialize()
    {
		$this->wxid        = $_GET['wxid'];//网校id
		$this->AppName     = 'applet';
		$this->appid       = null !==GF('appid') ? GF('appid'):'0';
		check_power($this->userinfo,$this->appid);//检查管理员权限
		$this->app         = $this->cache->GetA('appinfo','appid',$this->appid,'',true);
		if($this->app['isweb']==0)
		{
			$this->title   = '网站分类';
		}else{
		    $this->title   = '应用分类';
		}
		$this->AppModel    = M('app_'.$this->app['tableename']);
    }
    
	public function indexAction(){
		var_dump($this->wxid);
	}
}