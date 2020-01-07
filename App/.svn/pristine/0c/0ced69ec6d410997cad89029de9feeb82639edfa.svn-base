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
	 /**
	  * 转到微信授权（第三方扫码授权代运营或独立收款插件授权）
	  */
	 public function wechatauthAction(){
	 	$auth_type = ChkClng(KS_S('auth_type',3));
	 	$wxid      = ChkClng(KS_S('wxid','1'));
	 	$wxtype    = ChkClng(KS_S('wxtype','0'));
	 	$Oappid    = KS_S('Oappid');

        $component_appid = KS_C('ServiceProvider_AppId');   //平台方的appid，对应open.weixin.qq.com里获取
        $component_access_token  =  GetOpenAccessToken();   //获得平台方的accesstoken

		//获取预授权码 每个只有20分钟
		$url  = 'https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token='.$component_access_token;
		$msg=array('component_appid'=>$component_appid);
        $response=http_post($url,json_encode($msg));
		$pre_auth_code = json_decode($response)->pre_auth_code;
		$redirect_uri =  M_URL('wechat','wechatBackInsert',$wxid,GP('wxtype-'.$wxtype)).'&Oappid='.$Oappid;
		$redirect_uri='https:'.$redirect_uri;
		$authurl = 'https://mp.weixin.qq.com/cgi-bin/componentloginpage?component_appid='.$component_appid.'&pre_auth_code='.$pre_auth_code.'&redirect_uri='.$redirect_uri.'&auth_type='.$auth_type;
		echo '<script>window.location.href="'.$authurl.'"</script>';
	}
	/**
	 * 授权成功返回(入口）
	 */
     public function wechatBackInsertAction(){

        $component_appid = KS_C('ServiceProvider_AppId');   //平台方的appid，对应open.weixin.qq.com里获取
        $component_access_token  =  GetOpenAccessToken();   //获得平台方的accesstoken

		$wxid = KS_G('get.id');
		$authorization_code =KS_G('get.auth_code');
		$Oappid       = KS_G('get.Oappid');
		$wxtype = $_GET['arr'];
		$wxtype = strstr($_GET['arr'],'wxtype');
		$wxtype = strstr($wxtype,'&',true);

        //根据$authorization_code,换换取公众号基本信息，如公众号appid等
		$url = 'https://api.weixin.qq.com/cgi-bin/component/api_query_auth?component_access_token='.$component_access_token;
		$msg=array('component_appid'=>$component_appid,'authorization_code'=>$authorization_code);
        $response = http_post($url,json_encode($msg));
		$response = json_decode($response);
		$returninfo = $response->authorization_info;

		$Data['wxid'] = $wxid;
		$Data['appid'] = $returninfo->authorizer_appid;
		$Data['access_token'] =  $returninfo->authorizer_access_token;
		$Data['access_token_adddate'] = time();
		$Data['authorizer_refresh_token'] = $returninfo->authorizer_refresh_token;
		$Data['token'] = KS_C('ServiceProvider_Token');          //消息校验Token
		$Data['encodingaeskey'] = KS_C('ServiceProvider_Key');   //消息加密KEY  在KS_cls/Conf/convention.php里配置

		//获取一些公众号信息
		$url = 'https://api.weixin.qq.com/cgi-bin/component/api_get_authorizer_info?component_access_token='.$component_access_token;
		$msg=array('component_appid'=>$component_appid,'authorizer_appid'=>$Data['appid']);
        $response = http_post($url,json_encode($msg));
		$response = json_decode($response);
		$returninfos = $response->authorizer_info;
		$Data['weixintype'] = $returninfos->service_type_info->id;//公众号类型
		$Data['verify_type_info'] = $returninfos->verify_type_info->id;//公众号认证方式
		$Data['weixinid'] =$returninfos->user_name;//公众号原始id
		$Data['open_pay'] = $returninfos->business_info->open_pay;
		$Data['weixinname']= $returninfos->nick_name;
		$Data['qrcode_url'] = $returninfos->qrcode_url;
		//判断是否为小程序或者微信公众号
		$domain = $this->cache->GetA('domaininfo','wxid',$wxid,'',true);
		if(empty($domain)){
			$domain = $cache->GetA('domaininfo','predomain',APP_DOMAIN,'',true);
		    $GLOBALS['_DoM'] = $domain;
		}else{
			$GLOBALS['_DoM'] = $domain;
		}
		if(isset($returninfos->MiniProgramInfo)){
//			delappletData($wxid);//清空小程序
			$Mode = M('common_domain');
			$DataTemp['tempAid'] = 0;
			$Mode->update($DataTemp,'wxid='.$wxid);//清空用户选定的模版
			$backurl = 'https://'.$GLOBALS['_DoM']['domain'].'/home.html/applet/Index?appid-23';
			$app_weixin_config = M('app_wxapplet_config');
			$Data['network'] = json_encode($returninfos->MiniProgramInfo->network);

			$Data008['id']   = 3;
			/**
		     * 获取小程序的可选类目
		     */
			$url1 = 'https://api.weixin.qq.com/wxa/get_category?access_token='.$returninfo->authorizer_refresh_token;
			$curl = curl_init();
		    //设置抓取的url
		    curl_setopt($curl, CURLOPT_URL,$url1);
		    //设置获取的信息以文件流的形式返回，而不是直接输出。
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    //执行命令
		    $data = curl_exec($curl);
		    //关闭URL请求
		    curl_close($curl);
		    $response = json_decode($data);
		    $infos    = $response->category_list;
		    $Data['categories'] = json_encode($infos);
		}else{
            $backurl=wx_Url($wxid).'/home.html#/store?reload=1';
            //delwechatData($wxid);//清空微信公众号数据
			$app_weixin_config = M('app_weixin_config');
			$Data008['id']   = 2;
		}

		//获取结束开始存储
		//先判断是否数据库存过这个东西
		$ispd=$app_weixin_config->getRow('where appid="'.$Data['appid'].'" and wxid !='.$wxid);
		echo '<!DOCTYPE html>
		<html>
			<head>
				<meta charset="UTF-8">
				<title></title>
			</head>
			<body>
			</body>
		</html>';
		echo '<script src="'.UOOT.'Public/common/js/jquery.js"></script>';
		echo '<script src="'.UOOT.'Public/Zpopup/js/Zpopup-2.0.js"></script>';
		if($ispd){
			echo '<script>
						popup.tips("该公众号或小程序已经绑定相关科汛V名师网校,请先解除绑定后在试一试",
						{
							icon:"warning",
							interval:1000,
							callBack:function(){
								top.location.href="'.$backurl.'"
							}
						})
					</script>';
			exit;
		}


        /****************************************来自微信独立收款插件的授权 begin ***************************/
		if($wxtype == 'wxtype-1'){
			$app_weixin_config = M('app_weixin_payconfig');
			$info = $app_weixin_config ->getOne('id','where wxid='.$wxid);

            $backurl=wx_Url($wxid).'/home.html/pay/Index/wechatservice?appid-19,type-wx';

			$Data['open_pay'] = 0;
			if(!empty($info)){
				$app_weixin_config->update($Data,'id='.$info);
			}else{
				$app_weixin_config->doAdd($Data,'id');

			}
            $this->cache->PutHCache('wxconfig',$wxid);
			echo '<script>	top.location.href="'.$backurl.'"</script>';
			exit;
		}
        /****************************************来自微信独立收款插件的授权 end ***************************/







		if(!empty($Oappid)){
			$info = $app_weixin_config ->getOne('id','where wxid='.$wxid.' and appid='.$Oappid);
			$Data['issq'] = 1;
		}else{
			$info = $app_weixin_config ->getOne('id','where wxid='.$wxid);
		}

		if(!empty($info)){
			$app_weixin_config->update($Data,'id='.$info);
		}else{
			$app_weixin_config->doAdd($Data,'id');

		}

		$this->cache->PutHCache('wxconfig',$wxid);

		$IndexModel      = M('Application/IndexModel');
		$Data008['wxid'] = $wxid;
		$IndexModel->moduleswitch($Data008);
		echo '<script>
						popup.tips("绑定成功",
						{
							icon:"success",
							interval:400,
							callBack:function(){
                                //top.KTJ_RouterJump("'.$backurl.'");
								top.location.href="'.$backurl.'"
							}
						})
					</script>';
			exit;
	}
}