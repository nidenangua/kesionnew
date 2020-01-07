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
		check_homelogin($this->userinfo);//检查home端是否登录
		$this->userid     = $this->userinfo['userid'];
		$this->wxid       = $this->userinfo['wxid'];//网校id
		$this->powertype  = $this->userinfo['powertype'];//权限类型
		$this->rdbpower   = $this->userinfo['rdbpower'];//内容管理权限
		$this->AppName    = 'group';
		$this->appid      = ChkClng(KS_G('appid','5'));

        /***************检查是否有购买插件或是否VIP版本  begin  by 自由的飞 at 2019.4.13 **************/
        if (ACTION!='index'){
            checkIsVipModule($this->wxid,$this->appid,true,true);
        }
        /***************检查是否有购买插件或是否VIP版本  end by 自由的飞 at 2019.4.13 **************/


		check_power($this->userinfo,'group');//检查管理员权限
		$this->app        = $this->cache->GetA('appinfo','appid',$this->appid,'',true);
		if($this->app['isweb']==0)
		{
			$this->title  = '网站分类';
		}else{
		    $this->title  = '应用分类';
		}
		$this->AppModel   = M('app_team');
		if (REDIS_ENABLE==true){
            $this->redis = new Redis() or die("Cannot load Redis module.");//启动redis 进行缓存
            $this->redis->connect(REDIS_SERVER,REDIS_PORT);
            $auth = $this->redis->auth(REDIS_PWD);//redis改为你的redis
        }
    }
}