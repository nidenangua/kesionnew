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
		$this->admininfo = getsession('admin');
		$this->AppName   = 'sms';
		$this->appid     = null !== GF('appid') ? GF('appid'):'0';
		$this->isweb     = null !== GF('isweb') ? GF('isweb'):'';
		$this->wxid      = null !== GF('wxid') ? GF('wxid'):'';
		$this->app = $this->cache->GetA('appinfo','appid',$this->appid,'',true);
		if($this->app['isweb']==0){
			$this->title = '网站分类';
		}else{
		    $this->title = '应用分类';
		}
		$this->AppModel = M('app_'.$this->app['tableename']);
    }
}
