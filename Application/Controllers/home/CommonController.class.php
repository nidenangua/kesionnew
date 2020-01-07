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
    public  function _initialize(){

		if(ACTION!='getOpenid'&&ACTION!='getOpenid2'&&ACTION!='getOpenidstatus'){
		    $h5token = ChkSQL(KS_S('get.token'));
			if(!empty($h5token)){                         //token方式登录
				$UserMode = M('common_user');
				$info = $UserMode->getRow('where h5token="'.$h5token.'" and tokentime>'.time().' and wxid='.$this->wxid);
				if(!empty($info)){
					$userinfo['userid']   = $info['userid'];
					$userinfo['username'] = $info['username'];
					$userinfo['usertype'] = $info['usertype'];
					$userinfo['wxid']     = $info['wxid'];//网校id
					$userinfo['openid']   = $info['openid'];//网校id
					putsession('user',$userinfo);
				}
			}

			$this->userinfo   = User_GetUserInfo();       // 获取详细的用户登录信息
		    if ($this->userinfo==null && ACTION!=='reg' && ACTION!=='login'){                   // 未登录，跳到登录页面
				ks_header('/login');
			}
			
			if(!empty(cookie('tempMid'))){
				$GLOBALS['_DoM']['tempMid'] = cookie('tempMid');
			}
			$tempinfo = $this->cache->GetA('tempinfo','tempid',$GLOBALS['_DoM']['tempMid'],'',true); //取出temp缓存
			if(!empty($tempinfo)){$this->dir = M_PATH.$tempinfo['installdir'].'/';}else{$this->dir = M_PATH.'Skin01'.'/';}
			if(is_weixin()){
				if(empty($this->userinfo)){
					if(ACTION!='auth'&&ACTION!='login'&&ACTION!='sigin'&&ACTION!='reg'&&ACTION!='getPass'){
						exit("<script>top.location.href='".M_URL('WeChat','auth')."?wxid=".$GLOBALS['_DoM']['wxid']."&actindex=".ACTION."'</script>");
					}
				}else{
					$this->userid     = $this->userinfo['userid'];//用户id
					$this->wxid       = $this->userinfo['wxid'];//网校id
					$this->powertype  = $this->userinfo['powertype'];//权限类型
				}
			}else{
				if((ACTION!='auth'&&ACTION!='login'&&ACTION!='sigin'&&ACTION!='reg'&&ACTION!='getPass')&&CONTROLLER=='WeChat'){
					if($this->userinfo == null) {
						exit("<script>top.location.href='".M_URL('WeChat','login')."'</script>");
					}
					$this->userid     = $this->userinfo['userid'];//用户id
					$this->wxid       = $this->userinfo['wxid'];//网校id
					$this->powertype  = $this->userinfo['powertype'];//权限类型
				}else{
					$this->userid     = $this->userinfo['userid'];//用户id
					$this->wxid       = $this->userinfo['wxid'];//网校id
					$this->powertype  = $this->userinfo['powertype'];//权限类型
				}
			}

		}
    }
}