<?php

use Kesion\Controller;
class IndexController extends CommonController{

	public function indexAction(){
		$app_wechat_config = M('app_wxapplet_config');
		if(empty($this->appletappid)){
			$info = $app_wechat_config->getRow('where wxid='.$this->wxid);
			if(empty($info)){
				$url=M_URL($this->AppName.'/Index','AppletTemplist','',GP(''));
				KS_INFO("",0,$url,'',1);
			}
		}else{
			$info = $app_wechat_config->getRow('where wxid='.$this->wxid.' and appid="'.$this->appletappid.'"');
			if(empty($info['token'])){
				$url=M_URL($this->AppName.'/Index','bdConfig','',GP(''));
				KS_INFO("",0,$url,'',1);
			}
		}
		$values = $app_wechat_config->getAll('where wxid='.$this->wxid);
		foreach($values as $k=>$v){
			$values[$k]['info'] = M('app_wxapplet_user')->getAll('where wxid='.$this->wxid.' and appid="'.$v['appid'].'"');
			$values[$k]['categories'] = json_decode($values[$k]['categories'])[0];
		}
		include  CURR_VIEW_PATH . "count.php";
	}
	public function bdConfigAction(){
		include CURR_VIEW_PATH .'bdConfig.php';
	}
	//预览 小程序
	public function appiframeAction(){
		$id = KS_G('get.id');
		$common_temp  = M('app_wxapplet_temp');
		$where       = 'where id ='.$id;
		$values      = $common_temp->getRow($where);
		include  CURR_VIEW_PATH . "appiframe.php";
	}
	//小程序模版列表
	public function AppletTemplistAction(){
		$common_temp  = M('app_wxapplet_temp');
    	$where       = 'where template_id !=-1';
    	$options     = $common_temp->getOptions('8',$where);//分页参数设置
		$page        = Page($options); 
		$values      = $common_temp->getPage($page,'',$where);
		include  CURR_VIEW_PATH . "AppletTemp.php";
	}
	//确定小程序模版
	public function AppletTempEnterAction(){
		$id   = KS_G('get.id');
		$Data['tempid']     = $id;
		$Mode = M('app_wxapplet_config');
		if(empty($this->appletappid)){
			$Data['wxid'] = $this->wxid;
			$Data['weixinname'] = '新建小程序'.rand();
			$Data['appid']      = rand();
			$Data['issq']      = 0;
			$Mode->doAdd($Data,'id');
			$url = M_URL($this->AppName.'/Index','index','',GP("appletappid-".$Data['appid']));
			KS_INFO('你还未授权小程序，请先授权小程序',3,$url);
		}else{
			$Data['isaudit'] = 0;
			$Data['iscode']  = 0;
 			$Mode->update($Data,'appid="'.$this->appletappid.'"');
			$url = M_URL($this->AppName.'/Index','index','',GP(""));
			KS_INFO('选择完成',3,$url);
		}
	}
	
	//展现微信配置页面	
	public function wechatConfigAction(){
		$authurl = MY_FULLDOMAIN.'/wechat/wechatauth?wxid-'.$this->wxid.',auth_type-2,Oappid-'.$this->appletappid;
		echo '<script>window.location.href="'.$authurl.'"</script>';
	}
	public function AppletconfigAction(){	
		$app_weixin_config = M('app_wxapplet_config');
		$value =  $app_weixin_config->getRow("where  wxid = $this->wxid");
		include  CURR_VIEW_PATH . "Appletconf.php";
	}
	//小程序上传代码
	public function commitAction(){
		$id = KS_G('get.id');
		$Mode = M('app_wxapplet_temp');
		$access_token = getxcxAccessToken($this->wxid,$this->appletappid);
		$template_id = $Mode->getOne('template_id','where id='.$id);
		$url = 'https://api.weixin.qq.com/wxa/commit?access_token='.$access_token;
		$ext_json = json_encode(array('extEnable'=>true,'extAppid'=>KS_C('ServiceProvider_AppId'),'directCommit'=>false,'ext'=>array('wxid'=>$this->wxid)));
		$msg=array('template_id'=>$template_id,'ext_json'=>$ext_json,'user_version'=>'v1.0','user_desc'=>'科汛V名师开发的小程序');
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
		// 不输出header头信息
		curl_setopt($curl, CURLOPT_HEADER, 0);
		// 伪装浏览器
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
		// 保存到字符串而不是输出
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($curl, CURLOPT_POST, 1);
		// 请求数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($msg));
		$response = curl_exec($curl);
		$response = json_decode($response);
		$str  = '';
		if($response->errcode == 85013){
			$str = '无效的自定义配置';
		}elseif($response->errcode == 85014){
			$str = '无效的模版编号';
		}elseif($response->errcode == 85043){
			$str = '模版错误';
		}elseif($response->errcode == 85044){
			$str = '代码包超过大小限制';
		}elseif($response->errcode == 85044){
			$str = 'ext_json有不存在的路径';
		}elseif($response->errcode == 85045){
			$str = 'tabBar中缺少path';
		}elseif($response->errcode == 85047){
			$str = 'pages字段为空';
		}elseif($response->errcode == 85048){
			$str = 'ext_json解析失败';
		}elseif($response->errcode == -1){
			$str = '系统繁忙';
		}elseif($response->errcode == 0){
			$str = '成功上传代码,请等待审核';
			$Data['iscode'] = 1;
			$Modes = M('app_wxapplet_config');
			$Modes->update($Data,'appid="'.$this->appletappid.'"');
		}elseif($response->errcode == 61007){
			$str = '您的小程序已经在其他第三方平台绑定相关内容，请先去小程序后台解除授权';
		}
		$url = M_URL($this->AppName.'/Index','index','',GP(""));
		KS_INFO($str,3,$url);
	}
	//提交审核
	public function submit_auditAction(){
		$access_token = getxcxAccessToken($this->wxid,$this->appletappid);
		/**
	     * 获取小程序的可选类目
	     */
		$url1 = 'https://api.weixin.qq.com/wxa/get_category?access_token='.$access_token;
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
	    /**
	     * 获取小程序的页面目录
	     */
	    $url1 = 'https://api.weixin.qq.com/wxa/get_page?access_token='.$access_token;
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
	    $page_list = $response->page_list;
	    $item_list = array('');
	    foreach($infos as $k=>$v){
	    	$item_list[$k]['address'] = $page_list[$k];
	    	$item_list[$k]['tag']     = '';
	    	if(isset($v->first_class)){
	    		$item_list[$k]['first_class'] = $v->first_class;
	    		$item_list[$k]['first_id'] = $v->first_id;
	    		$item_list[$k]['tag']     .= $v->first_class;
	    	}
	    	if(isset($v->second_class)){
	    		$item_list[$k]['second_class'] = $v->second_class;
	    		$item_list[$k]['second_id'] = $v->second_id;
	    		$item_list[$k]['tag']     .= ' '.$v->second_class;
	    	}
	    	if(isset($v->third_class)){
	    		$item_list[$k]['third_class'] = $v->third_class;
	    		$item_list[$k]['third_id'] = $v->third_id;
	    		$item_list[$k]['tag']     .= ' '.$v->third_class;
	    	}
	    	$item_list[$k]['title']   = '首页';
	    	
	    }
		$url = 'https://api.weixin.qq.com/wxa/submit_audit?access_token='.$access_token;
		$msg=array('item_list'=>$item_list);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
		// 不输出header头信息
		curl_setopt($curl, CURLOPT_HEADER, 0);
		// 伪装浏览器
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
		// 保存到字符串而不是输出
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($curl, CURLOPT_POST, 1);
		// 请求数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($msg,JSON_UNESCAPED_UNICODE));
		$response = curl_exec($curl); 
		$response = json_decode($response);
		$str  = '';
		if($response->errcode == 86000){
			$str = '不是由第三方代小程序进行调用';
		}elseif($response->errcode == 86001){
			$str = '不存在第三方的已经提交的代码';
		}elseif($response->errcode == 85006){
			$str = '标签格式错误';
		}elseif($response->errcode == 85007){
			$str = '页面路径错误';
		}elseif($response->errcode == 85008){
			$str = '类目填写错误';
		}elseif($response->errcode == 85009){
			$str = '已经有正在审核的版本';
			$Data['iscode'] = 1;
			$Data['isaudit'] = 1;
			$Modes = M('app_wxapplet_config');
			$Modes->update($Data,'appid="'.$this->appletappid.'"');
		}elseif($response->errcode == 85010){
			$str = 'item_list有项目为空';
		}elseif($response->errcode == 85011){
			$str = '标题填写错误';
		}elseif($response->errcode == 85023){
			$str = '审核列表填写的项目数不在1-5以内';
		}elseif($response->errcode == 85077){
			$str = '小程序类目信息失效（类目中含有官方下架的类目，请重新选择到微信后台选择类目）';
		}elseif($response->errcode == 86002){
			$str = '小程序还未设置昵称、头像、简介。请先设置完后再重新提交。';
		}elseif($response->errcode == 85085){
			$str = '近7天提交审核的小程序数量过多，请耐心等待审核完毕后再次提交';
		}elseif($response->errcode == 85086){
			$str = '提交代码审核之前需提前上传代码';
		}elseif($response->errcode == -1){
			$str = '系统繁忙';
		}elseif($response->errcode == 0){
			$str = '成功上传代码,请等待审核结果';
			$Data['iscode'] = 1;
			$Data['isaudit'] = 1;
			$Data['auditid'] = $response->auditid;
			$Modes = M('app_wxapplet_config');
			$Modes->update($Data,'appid="'.$this->appletappid.'"');
		}elseif($response->errcode == 61007){
			$str = '您的小程序已经在其他第三方平台绑定相关内容，请先去小程序后台解除授权';
		}
		
		$url = M_URL($this->AppName.'/Index','index','',GP(""));
		KS_INFO($str,3,$url);
	}
	//删除空模版
	public function delectkongAction(){
		$Mode = M('app_wxapplet_config');
		$Mode->delete('wxid='.$this->wxid.' and appid="'.$this->appletappid.'"');
		$url = M_URL($this->AppName.'/Index','index','',GP("appid-25",true));
		KS_INFO('删除完成',3,$url);
	}
	//添加体验者
	public function bind_testerAction(){
		$access_token = getxcxAccessToken($this->wxid,$this->appletappid);
		$wechatid =  KS_G('post.name');//获取微信账号
		$url = 'https://api.weixin.qq.com/wxa/bind_tester?access_token='.$access_token;
		$msg=array('wechatid'=>$wechatid);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
		// 不输出header头信息
		curl_setopt($curl, CURLOPT_HEADER, 0);
		// 伪装浏览器
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
		// 保存到字符串而不是输出
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($curl, CURLOPT_POST, 1);
		// 请求数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($msg));
		$response = curl_exec($curl);
		$response = json_decode($response);
		$str  = '';
		if($response->errcode == 85001){
			$str = '微信号不存在或微信号设置为不可搜索';
		}elseif($response->errcode == 85002){
			$str = '小程序绑定的体验者数量达到上限';
		}elseif($response->errcode == 85003){
			$str = '微信号绑定的小程序体验者达到上限';
		}elseif($response->errcode == 85004){
			$str = '微信号已经绑定';
		}elseif($response->errcode == -1){
			$str = '系统繁忙';
		}elseif($response->errcode == 0){
			$str = '成功绑定';
			$Data['wechatid'] = $wechatid;
			$Data['wxid']     = $this->wxid;
			$Data['userstr']  = $response->userstr;
			$Data['apppid']   = $this->appletappid;
			$Mode = M('app_wxapplet_user');
			$Mode->doAdd($Data,'id');
		}elseif($response->errcode == 61007){
			$str = '您的小程序已经在其他第三方平台绑定相关内容，请先去小程序后台解除授权';
		}
		$url = M_URL($this->AppName.'/Index','index','',GP(""));
		KS_INFO($str,3,$url);
	}
	//解除绑定小程序体验者
	public function unbind_testerAction(){
		$access_token = getxcxAccessToken($this->wxid,$this->appletappid);
		$wechatid =  KS_G('post.name');//获取微信账号
		$url = 'https://api.weixin.qq.com/wxa/unbind_tester?access_token='.$access_token;
		$msg=array('wechatid'=>$wechatid);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
		// 不输出header头信息
		curl_setopt($curl, CURLOPT_HEADER, 0);
		// 伪装浏览器
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
		// 保存到字符串而不是输出
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($curl, CURLOPT_POST, 1);
		// 请求数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($msg));
		$response = curl_exec($curl);
		$response = json_decode($response);
		$str  = '';
		if($response->errcode == -1){
			$str = '系统繁忙';
		}elseif($response->errcode == 0){
			$str = '成功解除绑定';
			$Mode = M('app_wxapplet_user');
			$Mode->delete('wxid='.$this->wxid.' and wechatid="'.$wechatid.'"');
		}elseif($response->errcode == 61007){
			$str = '您的小程序已经在其他第三方平台绑定相关内容，请先去小程序后台解除授权';
		}
		$url = M_URL($this->AppName.'/Index','index','',GP(""));
		KS_INFO($str,3,$url);
	}
	//设置小程序安全连接
	public function modify_domainAction(){
		$access_token = getxcxAccessToken($this->wxid,$this->appletappid);
		$url = 'https://api.weixin.qq.com/wxa/modify_domain?access_token='.$access_token;
		$msg=array('action'=>'add','requestdomain'=>array('https://store.kesion.com'),'wsrequestdomain'=>array('wss://store.kesion.com'),'uploaddomain'=>array('https://store.kesion.com'),'downloaddomain'=>array('https://store.kesion.com'));
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
		// 不输出header头信息
		curl_setopt($curl, CURLOPT_HEADER, 0);
		// 伪装浏览器
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
		// 保存到字符串而不是输出
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($curl, CURLOPT_POST, 1);
		// 请求数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($msg));
		$response = curl_exec($curl);
		$response = json_decode($response);
		$str  = '';
		if($response->errcode == 85015){
			$str = '该账号不是小程序账号';
		}elseif($response->errcode == 85016){
			$str = '域名数量超过限制';
			
		}elseif($response->errcode == 85017){
			$str = '没有新增域名，请确认小程序已经添加了域名或该域名是否没有在第三方平台添加';
			
		}elseif($response->errcode == 85018){
			$str = '域名没有在第三方平台设置';
			
		}elseif($response->errcode == 61007){
			$str = '您的小程序已经在其他第三方平台绑定相关内容，请先去小程序后台解除授权';
		}elseif($response->errcode == 0){
			$str = '设置完成';
			$array = array('requestdomain'=>array('https://store.kesion.com'),'wsrequestdomain'=>array('wss://store.kesion.com'),'uploaddomain'=>array('https://store.kesion.com'),'downloaddomain'=>array('https://store.kesion.com'));
			$Data['network'] = json_encode($array);
			$app_wechat_config = M('app_wxapplet_config');
			$app_wechat_config->Update($Data,'wxid='.$this->wxid);
		}
		$url = M_URL($this->AppName.'/Index','index','',GP(""));
		KS_INFO($str,3,$url);
	}
	//获取小程序的体验二维码
	public function get_qrcodeAction(){
		$access_token = getxcxAccessToken($this->wxid,$this->appletappid);
		$url = 'https://api.weixin.qq.com/wxa/get_qrcode?access_token='.$access_token;
		$curl = curl_init();
	    //设置抓取的url
	    curl_setopt($curl, CURLOPT_URL,$url);
	    //设置获取的信息以文件流的形式返回，而不是直接输出。
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    //执行命令
	    $data = curl_exec($curl);
	    //关闭URL请求
	    curl_close($curl);
	    $response = json_decode($data);
	    //显示获得的数据	
	    $url1 = M_URL($this->AppName.'/Index','index','',GP(""));
		if(isset($response->errcode) && $response->errcode == -1){
			$str = '系统繁忙，或者您还没设置相关模版';
			KS_INFO($str,3,$url1);
		}elseif(isset($response->errcode) && $response->errcode == 61007){
			$str = '您的小程序已经在其他第三方平台绑定相关内容，请先去小程序后台解除授权';
			KS_INFO($str,3,$url1);
		}else{
			file_put_contents($this->wxid.'xcxqrcode.png',$data);
			$img = ROOT.$this->wxid.'xcxqrcode.png';
			$base64_img = base64EncodeImage($img);
			unlink($img);
			echo '<img src="'.$base64_img.'">';
		}
		
	}
	//小程序模版列表
	public function AppletTempAction(){
		$Mode = M('common_domain');
		$info = $Mode->getRow('where wxid='.$this->wxid);
		if(empty($info['tempAid'])){
			echo '<script>window.location.href="'.M_URL($this->AppName.'/Index','AppletTemplist','',GP("")).'"</script>';exit;
		}else{
			
		}
	}
	
	
	
	//解除绑定
	public function unbindAppletAction(){
		delappletData($this->wxid,$this->appletappid);//清空小程序
		$Mode = M('common_domain');
		$DataTemp['tempAid'] = 0;
		$Mode->update($DataTemp,'wxid='.$this->wxid);//清空用户选定的模版
		$url = M_URL($this->AppName.'/Index','Index','',GP(""));
		KS_INFO('解除成功，详细功能请到微信公众平台后台解除相关授权！',3,$url);
	}
	
	
	
	
	
	public function DragAction(){
		//创建小程序的目录
		$path = ROOT.'Skin/'.$this->wxid.'/XCX/';
        if(!is_dir($path)){
            make_dir($path);
        }
        //读取模版信息。先读取用户模版的数据库看下是否存在页面，如果没有就调用默认的一个模版给用户或者直接为空不调用模版 
        $app_wxapplet_setting =M('app_wxapplet_setting');
        $formid=$app_wxapplet_setting->getRow('where wxid='.$this->wxid);
        if(!empty($formid)){
        	 $app_wxapplet_pages =M('app_wxapplet_pages');
        }
		include  CURR_VIEW_PATH . "Drag.php";
	}
	public function DragPopAction(){
		include  CURR_VIEW_PATH . "DragPop.php";
	}
	/**
	 * 调取课程分类
	 */
	public function GetcategoryAction(){
		$app_category = M('app_category');
		$category = $app_category->getAll('where wxid='.$this->wxid);
		
		$str='';
		foreach($category as $key => $v){
			$str .='<option value="'.$v["categoryid"].'">'.$v['categoryname'].'</option>';
		}
		echo $str;
	}
	/**
	 * 调取label
	 */
	public function GetforMatAction(){
		$labelid = $_POST['id'];
		include ROOT.'Public/dragxcx/label/course.php';
	}
	/**
	 * 设置对接
	 */
	public function  doWechatConfigAction()
	{
		$AppModel = M('app_wxapplet_config');
		$Data['wxid'] = $this->wxid;
		$id = ChkClng(KS_G('post.id'));
		$Data['status'] =ChkClng(KS_G("post.status"));
		$Data['weixintype'] = ChkClng(KS_G('post.weixintype'));
		$Data['weixinname'] = ChkSQL(KS_G('post.weixinname'));
		$Data['weixinid'] = ChkClng(KS_G('post.weixinid'));
		$Data['appid'] = ChkSQL(KS_G('post.appid'));
		$Data['appsecret'] = ChkSQL(KS_G('post.appsecret'));
		$Data['weixinstatus'] = ChkClng(KS_G('post.weixinstatus'));
		$Data['adddate'] = time();
		//var_dump($Data);
		$Rule['weixinname'] = '公众号名称|isEmpty';
		Chkpost($Data,$Rule,$AppModel);
		$Data['access_token'] ="";
		$Data['access_token_adddate'] =0;
		if($AppModel->getRow("  where wxid=".$Data['wxid']. " limit 1")){
			$AppModel->update($Data,'id='.$id);
		}else{
			$AppModel->doAdd($Data,'id');
		}
		$url1= M_URL($this->AppName.'/Index','Appletconfig',"",GP(''));
		KS_INFO('保存成功',0,$url1);
	}
	/**
	 * 接受前台过来的一些数据
	 */
	public function SvaeformatAction(){
		var_dump($_POST);
		//接收前台过来的数据
		$json_string = file_get_contents(ROOT."Skin/2/XCX/Skin01/app.json");
		$data = json_decode($json_string, true);
//		var_dump($data);
		//用户界面配置

		//小程序页面
		
		
		//小程序基础页面
		
		
		//保存文件
		//二次检测小程序的目录，如果没有就创建
		$path = ROOT.'Skin/'.$this->wxid.'/XCX/';
        if(!is_dir($path)){
            make_dir($path);
        }
        //写入数据库
        $app_wxapplet_setting =M('app_wxapplet_setting');
        //根据路径创建文件
        
        //打包文件，存入数据库，方便调用用户下载
	}
	public function createZip($openFile,$zipObj,$sourceAbso,$newRelat = '') {  
	    while(($file = readdir($openFile)) != false){  
	        if($file=="." || $file=="..")  
	            continue;  
	          
	        /*源目录路径(绝对路径)*/  
	        $sourceTemp = $sourceAbso.'/'.$file;  
	        /*目标目录路径(相对路径)*/  
	        $newTemp = $newRelat==''?$file:$newRelat.'/'.$file; 
	        if(is_dir($sourceTemp)) 
	        {  
	            //echo '创建'.$newTemp.'文件夹<br/>';  
	            $zipObj->addEmptyDir($newTemp);/*这里注意：php只需传递一个文件夹名称路径即可*/  
	            $this->createZip(opendir($sourceTemp),$zipObj,$sourceTemp,$newTemp);  
	        }  
	        if(is_file($sourceTemp))  
	        {  
	            //echo '创建'.$newTemp.'文件<br/>';  
	            $zipObj->addFile($sourceTemp,$newTemp);  
	        }   
	    } 
    }
	public function dabaoAction(){
		$zip = new ZipArchive; 
		$path = ROOT.'Skin/'.$this->wxid.'/XCX/';
		if(is_file($path.'xcx.zip')){
   			unlink($path.'xcx.zip');
   		}
		if($zip->open($path.'xcx.zip', ZipArchive::OVERWRITE)=== TRUE){
		   	$this->createZip(opendir($path),$zip,$path); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
		    $zip->close(); //关闭处理的zip文件
		}
	}
	public function AppQRcodeAction(){
		$app_wxapplet_config = M('app_wxapplet_config');
		$weixinstatus = $app_wxapplet_config->getRow('where wxid='.$this->wxid);
		if(empty($weixinstatus)){
			$url=M_URL($this->AppName.'/Index','Appletconfig','',GP(''));
			KS_INFO("对不起你还没绑定微信小程序无法使用该功能",0,$url,'',1);
		}else{
			$access_token = Get_access_token($this->wxid);
			$url ='https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token='.$access_token;//access_token改成你的有效值
			$data = array(
				'scene'=>'1',//最大32个可见字符，只支持数字，大小写英文以及部分特殊字符：!#$&'()*+,/:;=?@-._~，其它字符请自行编码为合法字符（因不支持%，中文无法使用 urlencode 处理，请使用其他编码方式）
				'width'=>430,//宽度
				'auto_color'=>false, //自动配置线条颜色，如果颜色依然是黑色，则说明不建议配置主色调
				'line_color'=>array(
					'r'=>'0',
					'g'=>'255',
					'b'=>'0'
				),
			);
			$outputYcumulate= curlPost($url,json_encode($data));
			$token= (array)json_decode($outputYcumulate);
			include  CURR_VIEW_PATH . "QRcode.php";
		}
	}
	public function getwxmlAction(){
		$dir = ROOT.'Skin/'.$this->wxid.'/XCX/Skin01/pages';
		$file=scandir($dir);
		$newfile = array();
		foreach($file as $key => $v){
			$url = 'pages/'.$v.'/'.$v;
			if($v == '.' || $v=='..' || $v == 'images' || $v == 'logs' || $v =='indexss' || $v == 'courseinfo'){
				
			}else{
				if($v == 'course'){
					$ls = array(
						'name' =>'课程',
						'url' =>$url
					);
				}elseif($v == 'setCourseList'){
					$ls = array(
						'name' =>'课程',
						'url' =>$url
					);
				}elseif($v == 'index'){
					$ls = array(
						'name' =>'首页',
						'url' =>$url
					);
				}elseif($v == 'setQuestionList'){
					$ls = array(
						'name' =>'问答',
						'url' =>$url
					);
				}elseif($v == 'setArticleList'){
					$ls = array(
						'name' =>'新闻',
						'url' =>$url
					);
				}elseif($v == 'setStudentList'){
					$ls = array(
						'name' =>'学生',
						'url' =>$url
					);
				}elseif($v == 'setTeacherList'){
					$ls = array(
						'name' =>'教师',
						'url' =>$url
					);
				}elseif($v == 'user'){
					$ls = array(
						'name' =>'我的',
						'url' =>$url
					);
				}else{
					$ls = array(
						'name' =>$v,
						'url' =>$url
					);
				}
				
				array_push($newfile,$ls);
			}
		}
		echo json_encode($newfile);
	}
	public function SvaebottomAction(){
		$json_string = file_get_contents(ROOT."Skin/".$this->wxid."/XCX/Skin01/app.json");
		$data = json_decode($json_string, true);
		$color =ChkSQL(KS_G("post.color"));
		$selectedColor =ChkSQL(KS_G("post.selectedColor"));
		$borderStyle = ChkSQL(KS_G("post.borderStyle")); 
		$backgroundColor = ChkSQL(KS_G("post.backgroundColor")); 
//		$list = $_POST[''];
		$data['tabBar'] = array();
		$data['tabBar']['color'] = $color;
		$data['tabBar']['selectedColor'] = $selectedColor;
		$data['tabBar']['borderStyle'] = $borderStyle;
		$data['tabBar']['backgroundColor'] = $backgroundColor;
		$data['tabBar']['list'] = array();
		$list = $data['tabBar']['list'];
		
//		var_dump($list);
		var_dump($_POST);
		
	}
}