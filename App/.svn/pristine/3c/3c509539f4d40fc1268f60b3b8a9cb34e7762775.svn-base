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
		$this->userinfo   = User_GetUserInfo();
		check_homelogin($this->userinfo);//检查home端是否有初始化
		$this->userid     = $this->userinfo['userid'];
		$this->wxid       = $this->userinfo['wxid'];//网校id
		$this->powertype  = $this->userinfo['powertype'];//权限类型
		$this->rdbpower   = $this->userinfo['rdbpower'];//内容管理权限
		$this->AppName    = 'article';
		$this->appid      = ChkClng(KS_S('appid','0'));
		check_power($this->userinfo,'news','share');//检查管理员权限
		$this->app        = $this->cache->GetA('appinfo','appid',$this->appid,'',true);
		if($this->app['isweb']==0)
		{
			$this->title  = '网站分类';
		}else{
		    $this->title  = '应用分类';
		}
		$this->AppModel   = M('App/ArticleModel/app_'.$this->app['tableename']);
		if (REDIS_ENABLE==true){
            $this->redis = new Redis() or die("Cannot load Redis module.");//启动redis 进行缓存
            $this->redis->connect(REDIS_SERVER,REDIS_PORT);
            $auth = $this->redis->auth(REDIS_PWD);//redis改为你的redis
        }
    }
}