<?php
define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');



/*------------------------------------------------------ */
//-- 微信登录
/*------------------------------------------------------ */
	$code = $_REQUEST['code'];	
	$appid = 'wx6c7966b3993684e3';
	$appsecret = 'b6cc95374a479e94bfb85e0103800bca';
	$weixn_refresh_token = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."&code=".$code."&grant_type=authorization_code");
	$weixn_refresh_token =json_decode($weixn_refresh_token);
	$refresh_token =$weixn_refresh_token->{'refresh_token'};//json
	$access_token = file_get_contents("https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=".$appid."&grant_type=refresh_token&refresh_token=".$refresh_token ." ");
	$access_token =json_decode($access_token);
	$openid =$access_token->{'openid'};
//	$access_token =$access_token->{'access_token'};
	//$user_info = file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN");
//	$user_info =json_decode($user_info);
	
	$access_token = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret."");
	$access_token =json_decode($access_token);
	$user_info = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token->access_token."&openid=".$openid."&lang=zh_CN");
	$user_info =json_decode($user_info);
	
	$nickname =$user_info->nickname;
	//echo $nickname;exit;
	$sex =$user_info->{'sex'};
	$headimgurl =$user_info->{'headimgurl'};
	$openid =$user_info->{'openid'};
	$subscribe =$user_info->{'subscribe'};
	//echo $headimgurl;exit;
	if(empty($openid))
	{
		//exit('获取信息失败。');
		ecs_header("Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6c7966b3993684e3&redirect_uri=http://www.61aitao.com/hrmy/privilege.php?act=home&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect\n");	
	}
 
	$is_users = $db->getOne("select count(*) from ecs_users where openid ='".$openid."'");
	//获取ip
	$onlineip =''; 
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) { 
	$onlineip = getenv('HTTP_CLIENT_IP'); 
	}
	 elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) { 
	$onlineip = getenv('HTTP_X_FORWARDED_FOR'); 
	} 
	elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) { 
	$onlineip = getenv('REMOTE_ADDR'); 
	} 
	elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))   { 
	$onlineip = $_SERVER['REMOTE_ADDR']; 
	} 

	$now =time();
	if($is_users ==0)
	{
		
		$db->query("insert into ecs_users (user_name,nickname,sex,openid,user_img,reg_time,last_login,last_ip,is_validated) values ('".$nickname."','".$nickname."','".$sex."','".$openid."','".$headimgurl."','".$now."','".$now."','".$onlineip.",'".$subscribe."')");	
		//$buy_id = mysql_insert_id();
	}
	else
	{
		$db->query("update ecs_users set nickname='".$nickname."',sex='".$sex."',is_validated='".$subscribe."',user_img='".$headimgurl."',last_login='".$now."',last_ip='".$onlineip."' where openid='$openid'");
	}
	 
	$row = $db->getRow("select * from ecs_users where openid='".$openid."'");
	session_start();	
	set_tb_session($row['user_id'], $row['user_name'], $row['action_list'], $row['last_login']);
    //var_dump($_SESSION['buy_id']);exit;


/*penid	用户的唯一标识
nickname	用户昵称
sex	用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
province	用户个人资料填写的省份
city	普通用户个人资料填写的城市
country	国家，如中国为CN
headimgurl	用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效。
privilege	用户特权信息，json 数组，如微信沃卡用户为（chinaunicom）
unionid	只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。详见：获取用户个人信息（UnionID机制）


/* act操作项的初始化 */
if (empty($_REQUEST['act']))
{
	//var_dump($_SESSION['buy_id']);exit;

    $_REQUEST['act'] = 'home';
}
else
{
    $_REQUEST['act'] = trim($_REQUEST['act']);
}



/*------------------------------------------------------ */
//-- 公众号菜单跳转
/*------------------------------------------------------ */
 if ($_REQUEST['act'] == 'home')//投宝首页
{
	ecs_header("Location: index.php\n");
}

/*elseif ($_REQUEST['act'] == 'tb_my_record')//投宝记录
{
	ecs_header("Location:mine.php?act=record\n");
}

elseif ($_REQUEST['act'] == 'tb_my_winning')//我的 中奖记录
{
	ecs_header("Location:mine.php?act=winning\n");
}

elseif ($_REQUEST['act'] == 'tb_my_info')//个人中心
{
	ecs_header("Location:mine.php?act=my_info\n");
}

elseif ($_REQUEST['act'] == 'tb_about_us')//新手指导
{
	ecs_header("Location:mine.php?act=about_us\n");
}

elseif ($_REQUEST['act'] == 'tb_question')//了解投保
{
	ecs_header("Location:mine.php?act=question\n");
}*/



function set_tb_session($user_id, $user_name, $action_list, $last_time)
{
    $_SESSION['buy_id']     = $user_id;
    $_SESSION['user_name']   = $user_name;
    $_SESSION['action_list'] = $action_list;
    $_SESSION['last_check']  = $last_time; // 用于保存最后一次检查订单的时间
	//session_start();
}

?>