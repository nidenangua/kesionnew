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
class CapitalController extends CommonController
{
     /**
      * 提现管理列表
      */
     public function indexAction(){
		$common_voucher_log   = M('common_withdraw_log');//订单副表即订单课程部分
		$status               = KS_S('status','3');
		$where                = 'where type=0';

		//搜索
		$keyword     = KS_S('keyword');
		$keytype     = KS_S('keytype',1);
	    //判断是否输入关键字
		if(!empty($keyword)){
		     if($keytype==1){$where.=" and b.sitename like '%$keyword%'";}
		     if($keytype==2){$where.=" and b.wxid=$keyword";}
		}
		$option = KS_S('option','5');
		$num    = KS_S('numb','0');
		$year          = date('Y');
		$month         = date('n');
		switch($option){
				case 1://按周计算
				    if(date("w")==0){$wday = 7;}else{$wday = date("w");}
					$startday   = mktime(0,0,0,date("m"),date("d")-$wday+1-$num*7,date("Y"));
					$endday     = mktime(0,0,0,date("m"),date("d")-$wday+7-$num*7,date("Y"));
					break;
				case 2://按月份
				    $daysInMnth = date('t',mktime(0,0,0,$month-$num,1,$year));
					$startday   = mktime(0,0,0,date('m')-$num,1,date('Y'));
				    $endday     = mktime(0,0,0,date('m')-$num,$daysInMnth,date('Y'));
					break;
				case 3:
				    $season     = ceil((date('n'))/3-$num);//当月是第几季度
					$startday   =  mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
				    $endday     =  mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
					break;
		}
		if($option!=5){
			$where .= " and (a.adddate>$startday and a.adddate<$endday)";
		}

		$common_domain   = M('common_user_website');
		$where1           = "as a left join `$common_domain->table` as b on a.wxid = b.wxid $where";
		$allcomoney = $common_voucher_log->getOne('sum(a.cmoney)',$where1);
		$successcomoney = $common_voucher_log->getOne('sum(a.cmoney)',$where1.' and a.status=1');
		$falsecomoney = $common_voucher_log->getOne('sum(a.cmoney)',$where1.' and a.status=0');


		$adddate=null !==GF('adddate') ? GF('adddate'):1;
		if($adddate == 1){
			$byname  = 'a.adddate desc';
		}else{
			$byname  = 'a.adddate ASC';
		}

		if($status     == 0){$where .= ' and a.status=0';}
		elseif($status == 1){$where .= ' and a.status=1';}
		elseif($status == 3){$where .= ' and (a.status=1 or a.status=0)';}
		$where           = "as a left join `$common_domain->table` as b on a.wxid = b.wxid $where";

		$options         = $common_voucher_log->getOptions('10',$where);//分页参数设置
		$page            = Page($options);
		$values          = $common_voucher_log->getPage($page,$byname,$where,'b.userid as wxuserid,a.*,b.sitename');
		$user =M('common_user');
		foreach($values as $k =>$v){
			$values[$k]['username'] = $user->getOne('username','where userid='.$v['userid']);
			$values[$k]['mobile'] = $user->getOne('mobile','where userid='.$v['userid']);
		}
        include  CURR_VIEW_PATH . "Capital/withdraw_bill.php";
    }
	/**
     * 微信打款到个人（平台自己提现用的）
	 */
	public function topersonAction(){
		$common_voucher_log   = M('app_task_toperson_log');
		$status               = KS_S('status',3);
		$where                = 'where id>0 ';
		//搜索
		$keyword     = KS_S('keyword');
		$keytype     = KS_S('keytype',1);
	    //判断是否输入关键字
		if(!empty($keyword)){
		     if($keytype==1){$where.=" and name like '%$keyword%'";}
		}
		$option = null !==GF('option') ? GF('option'):'5';
		$num = null !==GF('numb') ? GF('numb'):'0';
		$year          = date('Y');
		$month         = date('n');
		switch($option){
			case 1://按周计算
			    if(date("w")==0){$wday = 7;}else{$wday = date("w");}
				$startday   = mktime(0,0,0,date("m"),date("d")-$wday+1-$num*7,date("Y"));
				$endday     = mktime(0,0,0,date("m"),date("d")-$wday+7-$num*7,date("Y"));
				break;
			case 2://按月份
			    $daysInMnth = date('t',mktime(0,0,0,$month-$num,1,$year));
				$startday   = mktime(0,0,0,date('m')-$num,1,date('Y'));
			    $endday     = mktime(0,0,0,date('m')-$num,$daysInMnth,date('Y'));
				break;
			case 3:
			    $season     = ceil((date('n'))/3-$num);//当月是第几季度
				$startday   =  mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
		        $endday     =  mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
				break;
		}
		if($option!=5){
			$where .= " and (adddate>$startday and adddate<$endday)";
		}

		$allcomoney     = $common_voucher_log->getOne('sum(cmoney)',$where);
		$successcomoney = $common_voucher_log->getOne('sum(cmoney)',$where.' and status=1');
		$falsecomoney   = $common_voucher_log->getOne('sum(cmoney)',$where.' and status=0');


		$adddate=null !==GF('adddate') ? GF('adddate'):1;
		if($adddate == 1){
			$byname  = 'adddate desc';
		}else{
			$byname  = 'adddate ASC';
		}

		if($status     == 0){$where .= ' and status=0';}
		elseif($status == 1){$where .= ' and status=1';}
		elseif($status == 3){$where .= ' and (status=1 or status=0)';}

		$options         = $common_voucher_log->getOptions('10',$where);//分页参数设置
		$page            = Page($options);
		$values          = $common_voucher_log->getPage($page,$byname,$where,'*');
        include  CURR_VIEW_PATH . "Capital/withdraw_toperson.php";
    }
    //进入提现申请页
    public function withdrawAction(){
     	//用户的总金额
        $wxinfo               = $this->cache->GetHCache('website',2);//读出缓存
        $status               = $wxinfo['status'];
        $wxmoney              = $wxinfo['money'];//网校的总金额
        $withdrawmoney        = $wxinfo['withdrawmoney'];//网校可提现的总金额
     	include  CURR_VIEW_PATH . "Capital/withdraw.php";
    }
    //绑定微信页
    public function bingweixinAction(){
     	$withdraw_openid = M('common_withdraw_openid');
		$withnum         = $withdraw_openid->getOne('count(id)','where wxid='.$this->wxid);
		if($withnum==0){
			$Data['wxid']    = $this->wxid;
			$Data['status']  = 0;
			$Data['adddate'] = time();
			$withdraw_openid->doAdd($Data,'id');
		}else{
			$Data['status']  = 0;
			$Data['adddate'] = time();
			$withdraw_openid->update($Data,'wxid='.$this->wxid);
		}
     	include  CURR_VIEW_PATH . "Capital/bingweixin.php";
    }
    //getOpenidstatus
    public function getOpenidstatusAction(){
	    $wxid            = ChkClng(KS_G('request.wxid'));
     	$withdraw_openid = M('common_withdraw_openid');
		$openidinfo  = $withdraw_openid->getRow('where wxid='.$wxid.' limit 1','status,openid,nickname');
		if(!empty($openidinfo)&&$openidinfo['status']==1){
		    $result['result']    = 'succeed';
			$result['nickname']  = $openidinfo['nickname'];
			$result['openid']    = $openidinfo['openid'];
		}else{
		     $result['result']   = 'err';
		}
		header('Content-Type:application/json;charset=utf-8');
		echo json_encode($result);exit;
    }
    public function withdrawmoneyAction(){
    	$password      = ChkSQL(KS_G('post.password'));
     	if(KS_MD5($password)!='141e68ce7d6d760f3488ed2bcf10a0bf')
     	{KS_INFO('提现密码不正确',0,'','',1);}
     	$withdrawmoney       = ChkSQL(KS_G('post.withdrawmoney'));
     	if($withdrawmoney<0.3){KS_INFO('提现金额请大于0.3',0,'','',1);}
     	//插入订单明细表
		$Data['adddate']     = time();
		$Data['cmoney']      = $withdrawmoney;

		$Data['balance']      = 0;
		$Data['userip']       = $_SERVER['SERVER_ADDR'];

		$Data['bank']         = KS_G('post.bank');

		$Data['name'] = $_POST['banknum'][2];
		if(empty($Data['name'])){KS_INFO('微信号不能为空',0,'','',1);}
		$Data['banknum'] = KS_G('post.nickname');
		$Data['openid']   = KS_G('post.openid');
		if(empty($Data['openid'])){
			KS_INFO('请绑定微信号',0,'','',1);
		}

		$Data['usermark']    = KS_G('post.usermark');
		$Data['mark']        = '您打款了'.$withdrawmoney.'元，已到账';

		$toperson_log        = M('app_task_toperson_log');//订单副表即订单课程部分
		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';

		$this->webchatObj = new \Core\Wechat();
		$tmp_arr      = $this->webchatObj->getXmlArr();
		$parameters['mch_appid'] = KS_C('Mch_AppId');
		$parameters['mchid']     = KS_C('MchId');
		list($usec, $sec)  = explode(" ", microtime());
		$parameters['partner_trade_no']  = ((float)$usec + (float)$sec)*10000;
		$parameters['nonce_str']         = KS_MD5($parameters['partner_trade_no']);
		$parameters['openid']            = $Data['openid'];
		$parameters['check_name']        = 'FORCE_CHECK';
		$parameters['re_user_name']      = $Data['name'];
		$parameters['amount']            = $Data['cmoney']*100;
		$parameters['desc']              = '您好，您在科汛V名师提现的金额已到账!';
		$parameters['spbill_create_ip']  = '116.62.200.1';
		$parameters['sign']              = $this->SetSign($parameters);
		$resultStr = sprintf($tmp_arr['wxpay'],$parameters['mch_appid']
		,$parameters['mchid'],$parameters['nonce_str'],$parameters['partner_trade_no']
		,$parameters['openid'],$parameters['check_name'],$parameters['re_user_name'],$parameters['amount']
		,$parameters['desc'],$parameters['spbill_create_ip'],$parameters['sign']);

		$response = $this->postXmlCurl($resultStr, $url, true, 30);
		if(!empty($response) ) {
            $data = simplexml_load_string($response, null, LIBXML_NOCDATA);
            $err_code_des = json_encode($data->err_code_des,JSON_UNESCAPED_UNICODE);
            if(strstr($err_code_des,'{}')!=false){
            }else{
            	KS_INFO($err_code_des,0,'','',1);exit;
            }
            //echo json_encode($data->err_code_des,JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode( array('return_code' => 'FAIL', 'return_msg' => 'transfers_接口出错', 'return_ext' => array()) );
        }
        $toperson_log->doAdd($Data,'id');
		$url1 = M_URL('Capital','toperson');
		KS_INFO('提现成功，已到账',0,$url1);
     }
    //编辑域名
	public function editwithdrawAction(){
		$now_page      = ChkClng(KS_S('p',1));
		$id            = ChkClng(KS_G('request.id'));
		$withdraw_log  = M('common_withdraw_log');
		$value         = $withdraw_log->getRow("where id=$id limit 1");
		include  CURR_VIEW_PATH . "Capital/withdraw_edit.php";
	}


    /**
     * 跳窗提示确认打款
     */
	public function confirmdel1Action(){
	    $id          =  ChkClng(KS_G('get.id'));
	    $now_page    =  ChkClng(KS_S('p',1));
	    include  CURR_VIEW_PATH . "Capital/confirmdel1.php";
	}
	/**
	 * 确认打款（客户提现）
	 */
	public function dowxwithdrawAction(){
		$password      = ChkSQL(KS_G('post.password'));
     	if(KS_MD5($password)!='141e68ce7d6d760f3488ed2bcf10a0bf')
     	{
             KS_INFO('打款密码不正确',0,'','',1);
         }
	    /*$code      = KS_G('get.code');
		if(empty($code)){
			$customeUrl   = 'https://'.APP_DOMAIN.$_SERVER['REQUEST_URI'];
	    	//$appid        =  KS_C('Mch_AppId');
			$appid        =  'wx3d73fc4aef554bf3';
			$oauthUrl     =  'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.urlencode($customeUrl).'&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect';
			header('Location:'.$oauthUrl);exit;
		}else{
	        $appid            =  'wx3d73fc4aef554bf3';
			$appsecret        =  '7f05188af735d7fd9c28a09f4f2ac9e5';
	        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
	        $file = geturl($url);
	        $row = json_decode($file);
	        var_dump($row);exit;
	        $access_token = $row->access_token;
	        $openId = $row->openid;
        }*/
        /*$mchPay = new \WxMchPay();oeQR80Wigo1RTuONsfrcIVP7iuK8
        // 用户openid
        $mchPay->setParameter('openid', 'oy2lbszXkgvlEKThrzqEziKEBzqU');
        // 商户订单号
        $mchPay->setParameter('partner_trade_no', 'test-'.time());
        // 校验用户姓名选项
        $mchPay->setParameter('check_name', 'NO_CHECK');
        // 企业付款金额  单位为分
        $mchPay->setParameter('amount', 100);
        // 企业付款描述信息
        $mchPay->setParameter('desc', '开发测试');
        // 调用接口的机器IP地址  自定义
        $mchPay->setParameter('spbill_create_ip', '127.0.0.1'); # getClientIp()
        // 收款用户姓名
        // $mchPay->setParameter('re_user_name', 'Max wen');
        // 设备信息
        // $mchPay->setParameter('device_info', 'dev_server');

        $response = $mchPay->postXmlSSL();
        if( !empty($response) ) {
            $data = simplexml_load_string($response, null, LIBXML_NOCDATA);
            echo json_encode($data);
        }else{
            echo json_encode( array('return_code' => 'FAIL', 'return_msg' => 'transfers_接口出错', 'return_ext' => array()) );
        }*/
		$id            = ChkClng(KS_G('request.id'));
		$withdraw_log  = M('common_withdraw_log');
		$value         = $withdraw_log->getRow("where id=$id limit 1");

        if($value['status']==1){
            KS_INFO('提现申请已经通过',0,'','',1);
		    exit;
		}
		if(empty($value['openid'])){
            KS_INFO('提现未绑定微信号',0,'','',1);
           exit;
		}
        if ($value['actualmoney']<=0){
            KS_INFO('提现金额不正确！',0,'','',1);
            exit;

        }

		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';

		$this->webchatObj = new \Core\Wechat();
		$tmp_arr      = $this->webchatObj->getXmlArr();
		$parameters['mch_appid'] = KS_C('Mch_AppId');
		$parameters['mchid']     = KS_C('MchId');
		//$parameters['mch_appid'] = 'wx3d73fc4aef554bf3';
		//$parameters['mchid']     = 1335752701;
		list($usec, $sec)  = explode(" ", microtime());
		$parameters['partner_trade_no'] = ((float)$usec + (float)$sec)*10000;
		$parameters['nonce_str'] = KS_MD5($parameters['partner_trade_no']);
		$parameters['openid']    = $value['openid'];
		$parameters['check_name']        = 'FORCE_CHECK';
		$parameters['re_user_name']      = $value['name'];
		$parameters['amount']            = $value['actualmoney']*100;
		$parameters['desc']              = '您好，您在科汛V名师提现的金额已到账!';
		$parameters['spbill_create_ip']  = '116.62.200.1';
		$parameters['sign']              = $this->SetSign($parameters);
		$resultStr = sprintf($tmp_arr['wxpay'],$parameters['mch_appid']
		,$parameters['mchid'],$parameters['nonce_str'],$parameters['partner_trade_no']
		,$parameters['openid'],$parameters['check_name'],$parameters['re_user_name'],$parameters['amount']
		,$parameters['desc'],$parameters['spbill_create_ip'],$parameters['sign']);


		$response = $this->postXmlCurl($resultStr, $url, true, 30);
		if( !empty($response) ) {
            $data = simplexml_load_string($response, null, LIBXML_NOCDATA);
            if ($data->result_code=='FAIL'){
                KS_INFO($data->err_code_des,0,'','',1);exit;
            }

            $err_code_des = json_encode($data->err_code_des,JSON_UNESCAPED_UNICODE);
            if(strstr($err_code_des,'{}')!=false){
            }else{
            	KS_INFO($err_code_des,0,'','',1);exit;
            }
            //echo json_encode($data->err_code_des,JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode( array('return_code' => 'FAIL', 'return_msg' => 'transfers_接口出错', 'return_ext' => array()) );
        }
		$id                  = ChkClng(KS_G('request.id'));
		$now_page            = ChkClng(KS_S('p',1));
		$withdraw_log        = M('common_withdraw_log');
		$Data['status']      = 1;
		$withdraw_log->update($Data,"id=$id");
		$Dotask  = new \Core\Dotask();
        $Dotask->checkTask($value['wxid'],5);//检查是否完成任务
		$url1 = M_URL('home/Capital','index','',GP('p-'.$now_page));
		KS_INFO('打款成功，已到账',3,$url1);
		exit;
	}

	public function SetSign($values){
	    //签名步骤一：按字典序排序参数
		ksort($values);
		$buff = "";
		foreach ($values as $k => $v){
			if($k != "sign" && $v != "" && !is_array($v)){
				$buff .= $k . "=" . $v . "&";
			}
		}
		$string = trim($buff, "&");
		//签名步骤二：在string后加入KEY
		$string = $string . "&key=".KS_C('Mch_Key');
		//签名步骤三：MD5加密
		$string = md5($string);
		//签名步骤四：所有字符转为大写
		$sign =  strtoupper($string);
		return $sign;
	}
	/**
	 * 以post方式提交xml到对应的接口url
	 *
	 * @param string $xml  需要post的xml数据
	 * @param string $url  url
	 * @param bool $useCert 是否需要证书，默认不需要
	 * @param int $second   url执行超时时间，默认30s
	 * @throws WxPayException
	 */
	public function postXmlCurl($xml, $url, $useCert = false, $second = 30){
		$ch = curl_init();
		//设置超时
		curl_setopt($ch, CURLOPT_TIMEOUT, $second);

		//如果有配置代理这里就设置代理
		/*if(WxPayConfig::CURL_PROXY_HOST != "0.0.0.0"
			&& WxPayConfig::CURL_PROXY_PORT != 0){
			curl_setopt($ch,CURLOPT_PROXY, WxPayConfig::CURL_PROXY_HOST);
			curl_setopt($ch,CURLOPT_PROXYPORT, WxPayConfig::CURL_PROXY_PORT);
		}*/
		curl_setopt($ch,CURLOPT_URL, $url);
		if(stripos($url,"https://")!==FALSE){
           curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
           curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }else{
           curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
           curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
        }
		//设置header
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		//要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		if($useCert == true){
			//设置证书
			//使用证书：cert 与 key 分别属于两个.pem文件
			curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
			curl_setopt($ch,CURLOPT_SSLCERT, KS_C('ApiClient_Cert'));      //微信apiclient_cert.pem 证书路径
			curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
			curl_setopt($ch,CURLOPT_SSLKEY, KS_C('ApiClient_Key'));  //微信apiclient_key.pem 证书路径
		}
		//post提交方式
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		//运行curl
		$data = curl_exec($ch);
		//返回结果
		if($data){
			curl_close($ch);
			return $data;
		} else {
			$error = curl_errno($ch);
			curl_close($ch);
			throw new WxPayException("curl出错，错误码:$error");
		}
	}
	//进行编辑域名操作
	public function doWithdrawAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$id       = ChkClng(KS_G('request.id'));//表ID
		if(!empty(ChkSQL(KS_G('post.defaultpic')))){
			$Data['defaultpic'] = ChkSQL(KS_G('post.defaultpic'));
			$withdraw_log       = M('common_withdraw_log');
			$withdraw_log->update($Data,"id=$id");
		}
		$url =  M_URL('home/Capital','index','',GP('p-'.$now_page));
		KS_INFO('保存成功',3,$url);
	}
	//确认删除
	public function confirmdelAction(){
	    $id          =  ChkClng(KS_G('get.id'));
	    $now_page    =  ChkClng(KS_S('p',1));
	    include  CURR_VIEW_PATH . "Capital/confirmdel.php";
	}


	//确认结算通过
	public function auditedAction(){
		$id                  = ChkClng(KS_G('request.id'));
		//var_dump($id);exit;
		$now_page            = ChkClng(KS_S('p',1));
		$withdraw_log        = M('common_withdraw_log');
		//$withdrawInfo        = $withdraw_log->getRow("where id=$id limit 1",'predomain,domain');
		//if(empty($domainInfo['predomain'])){KS_INFO('用户还没有申请过独立域名',4);}
		$data['status']      = 1;
		$withdraw_log->update($data,"id=$id");
		$url = M_URL('home/Capital','index','',GP('p-'.$now_page));
		ks_header($url);
	}
	//取消结算通过
	public function unauditedAction(){
	    $password      = ChkSQL(KS_G('password'));
		if($password=='654321'){
			$id                  = ChkClng(KS_G('request.id'));
			$now_page            = ChkClng(KS_S('p',1));
			$withdraw_log        = M('common_withdraw_log');
			//$withdrawInfo        = $withdraw_log->getRow("where id=$id limit 1",'predomain,domain');
			//if(empty($domainInfo['predomain'])){KS_INFO('用户还没有申请过独立域名',4);}
			$data['status']      = 0;
			$withdraw_log->update($data,"id=$id");
			$url = M_URL('home/Capital','index','',GP('p-'.$now_page));
			KS_INFO('取消结算通过',3,$url,'',1);
        }else{
		    KS_INFO('密码错误',0,'','',1);
		}
	}
	//确认结算通过
	public function audited1Action(){
		$id                  = ChkClng(KS_G('request.id'));
		//var_dump($id);exit;
		$now_page            = ChkClng(KS_S('p',1));
		$withdraw_log        = M('app_withdraw_log');
		//$withdrawInfo        = $withdraw_log->getRow("where id=$id limit 1",'predomain,domain');
		//if(empty($domainInfo['predomain'])){KS_INFO('用户还没有申请过独立域名',4);}
		$data['status']      = 1;
		$withdraw_log->update($data,"id=$id");
		$url = M_URL('home/Capital','spreadindex','',GP('p-'.$now_page));
		ks_header($url);
	}
	//取消结算通过
	public function unaudited1Action(){
		$id                  = ChkClng(KS_G('request.id'));
		//var_dump($id);exit;
		$now_page            = ChkClng(KS_S('p',1));
		$withdraw_log        = M('app_withdraw_log');
		//$withdrawInfo        = $withdraw_log->getRow("where id=$id limit 1",'predomain,domain');
		//if(empty($domainInfo['predomain'])){KS_INFO('用户还没有申请过独立域名',4);}
		$data['status']      = 0;
		$withdraw_log->update($data,"id=$id");
		$url = M_URL('home/Capital','spreadindex','',GP('p-'.$now_page));
		ks_header($url);
	}
	//删除独立域名
    public function delectAction(){
		$id = ChkClng(KS_G('request.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$common_domain = M('common_domain');
		//$Data['status']= -1;
		//$common_domain->update($Data,"id = $id");
		$common_domain->delete("id = $id");
		$this->cache->putACache('domaininfo');//写入缓存
		$url=M_URL('home/Domain','index','',GP('p-'.$now_page));
		ks_header($url);
	}
    //批量操作
	public function batchAction(){
		$id = isset($_POST["check"])?$_POST["check"]:'';
		$now_page = ChkClng(KS_S('p',1));
		if(empty($id)){KS_INFO("请选择",0,'','',1);}
		$common_domain = M('common_domain');
		$url = M_URL('home/Capital','index','',GP('p-'.$now_page));
		//批量删除
		if(KS_G('post.batch')==1){
			$Data['status'] = -1;
			foreach ($id as $v ){$common_domain->update($Data,"id=$v");}
			$this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量删除成功',0,$url);
		}
		//批量审核
		elseif(KS_G('post.batch')==2){
		    $data['status'] = 2;
		    foreach ($id as $v ) {$common_domain->update($data, "id=$v");}
			$this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量审核成功',0,$url);
		}
		//批量取消审核
		elseif(KS_G('post.batch')==3){
			$data['status'] = 1;
			foreach ($id as $v ) {$common_domain->update($data, "id=$v");}
			$this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量取消审核成功',0,$url);
		}
	}
	 //批量操作
	public function batch2Action(){
		$id = isset($_POST["check"])?$_POST["check"]:'';
		$now_page = ChkClng(KS_S('p',1));
		if(empty($id)){KS_INFO("请选择",0,'','',1);}
		$common_domain = M('app_task_money_log');
		$url = M_URL('home/Capital','spreadindex','',GP('p-'.$now_page));
		//批量审核
		if(KS_G('post.batch')==2){
		    $data['status'] = 1;
		    foreach ($id as $v ) {$common_domain->update($data, "id=$v");}
			KS_INFO('批量审核成功',0,$url);
		}
		//批量取消审核
		elseif(KS_G('post.batch')==3){
			$data['status'] = 0;
			foreach ($id as $v ) {$common_domain->update($data, "id=$v");}

			KS_INFO('批量取消审核成功',0,$url);
		}
	}


	/**
     * 分销推广提现管理
	 */
	public function spreadindexAction(){
		$common_voucher_log   = M('app_withdraw_log');//订单副表即订单课程部分
		$status               = KS_S('status',3);
		$where                = 'where id>0 and type=1';
		//搜索
		$keyword     = KS_S('keyword');
		$keytype     = KS_S('keytype',1);
	    //判断是否输入关键字
		if(!empty($keyword)){
		     if($keytype==1){$where.=" and b.username like '%$keyword%'";}
		}
		$option = null !==GF('option') ? GF('option'):'5';
		$num = null !==GF('numb') ? GF('numb'):'0';
		$year          = date('Y');
		$month         = date('n');
		switch($option){
			case 1://按周计算
			    if(date("w")==0){$wday = 7;}else{$wday = date("w");}
				$startday   = mktime(0,0,0,date("m"),date("d")-$wday+1-$num*7,date("Y"));
				$endday     = mktime(0,0,0,date("m"),date("d")-$wday+7-$num*7,date("Y"));
				break;
			case 2://按月份
			    $daysInMnth = date('t',mktime(0,0,0,$month-$num,1,$year));
				$startday   = mktime(0,0,0,date('m')-$num,1,date('Y'));
			    $endday     = mktime(0,0,0,date('m')-$num,$daysInMnth,date('Y'));
				break;
			case 3:
			    $season     = ceil((date('n'))/3-$num);//当月是第几季度
				$startday   =  mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
			    $endday     =  mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
				break;
		}
		if($option!=5){
			$where .= " and (a.adddate>$startday and a.adddate<$endday)";
		}
		$common_domain   = M('common_user');
		$where1           = "as a left join `$common_domain->table` as b on a.userid = b.userid $where";
		$allcomoney = $common_voucher_log->getOne('sum(a.cmoney)',$where1);
		$successcomoney = $common_voucher_log->getOne('sum(a.cmoney)',$where1.' and a.status=1');
		$falsecomoney = $common_voucher_log->getOne('sum(a.cmoney)',$where1.' and a.status=0');


		$adddate=null !==GF('adddate') ? GF('adddate'):1;
		if($adddate == 1){
			$byname  = 'a.adddate desc';
		}else{
			$byname  = 'a.adddate ASC';
		}

		if($status     == 0){$where .= ' and a.status=0';}
		elseif($status == 1){$where .= ' and a.status=1';}
		elseif($status == 3){$where .= ' and (a.status=1 or a.status=0)';}
		$where           = "as a left join `$common_domain->table` as b on a.userid = b.userid $where";

		$options         = $common_voucher_log->getOptions('10',$where);//分页参数设置
		$page            = Page($options);
		$values          = $common_voucher_log->getPage($page,$byname,$where,'b.userid as wxuserid,a.*,b.username');
		$user =M('common_user');
		foreach($values as $k =>$v){
			$values[$k]['mobile'] = $user->getOne('mobile','where userid='.$v['userid']);
		}
        include  CURR_VIEW_PATH . "Capital/withdraw_spreadindex.php";
    }
	/**
     * 分销提现管理
	 */
	public function DistributionAction(){
		$common_voucher_log   = M('app_withdraw_log');//订单副表即订单课程部分
		$status               = KS_S('status',3);
		$where                = 'where id>0 and type=0';
		//搜索
		$keyword     = KS_S('keyword');
		$keytype     = KS_S('keytype',1);
	    //判断是否输入关键字
		if(!empty($keyword)){
		     if($keytype==1){$where.=" and b.username like '%$keyword%'";}
		}
		$option = null !==GF('option') ? GF('option'):'5';
		$num = null !==GF('numb') ? GF('numb'):'0';
		$year          = date('Y');
		$month         = date('n');
		switch($option){
			case 1://按周计算
			    if(date("w")==0){$wday = 7;}else{$wday = date("w");}
				$startday   = mktime(0,0,0,date("m"),date("d")-$wday+1-$num*7,date("Y"));
				$endday     = mktime(0,0,0,date("m"),date("d")-$wday+7-$num*7,date("Y"));
				break;
			case 2://按月份
			    $daysInMnth = date('t',mktime(0,0,0,$month-$num,1,$year));
				$startday   = mktime(0,0,0,date('m')-$num,1,date('Y'));
			    $endday     = mktime(0,0,0,date('m')-$num,$daysInMnth,date('Y'));
				break;
			case 3:
			    $season     = ceil((date('n'))/3-$num);//当月是第几季度
				$startday   =  mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
			    $endday     =  mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
				break;
		}
		if($option!=5){
			$where .= " and (a.adddate>$startday and a.adddate<$endday)";
		}
		$common_domain   = M('common_user');
		$where1           = "as a left join `$common_domain->table` as b on a.userid = b.userid $where";
		$allcomoney = $common_voucher_log->getOne('sum(a.cmoney)',$where1);
		$successcomoney = $common_voucher_log->getOne('sum(a.cmoney)',$where1.' and a.status=1');
		$falsecomoney = $common_voucher_log->getOne('sum(a.cmoney)',$where1.' and a.status=0');


		$adddate=null !==GF('adddate') ? GF('adddate'):1;
		if($adddate == 1){
			$byname  = 'a.adddate desc';
		}else{
			$byname  = 'a.adddate ASC';
		}

		if($status     == 0){$where .= ' and a.status=0';}
		elseif($status == 1){$where .= ' and a.status=1';}
		elseif($status == 3){$where .= ' and (a.status=1 or a.status=0)';}
		$where           = "as a left join `$common_domain->table` as b on a.userid = b.userid $where";

		$options         = $common_voucher_log->getOptions('10',$where);//分页参数设置
		$page            = Page($options);
		$values          = $common_voucher_log->getPage($page,$byname,$where,'b.userid as wxuserid,a.*,b.username');
		$user =M('common_user');
		foreach($values as $k =>$v){
			$values[$k]['mobile'] = $user->getOne('mobile','where userid='.$v['userid']);
		}
        include  CURR_VIEW_PATH . "Capital/admin.withdraw_distribution.php";
    }
	/**
     * 店铺分销确认打款
	 */
	public function confirmdel2Action(){
	    $id          =  ChkClng(KS_G('get.id'));
	    $now_page    =  ChkClng(KS_S('p',1));
	    include  CURR_VIEW_PATH . "Capital/admin.confirmdel2.php";
	}
    /**
     * 店铺分销的确认打款
     */
	public function dowxwithdraw2Action(){
		$password      = ChkSQL(KS_G('post.password'));
        if(KS_MD5($password)!='141e68ce7d6d760f3488ed2bcf10a0bf')
        {
            KS_INFO('打款密码不正确',0,'','',1);
        }
		$id            = ChkClng(KS_G('request.id'));
		$withdraw_log  = M('app_withdraw_log');
		$value         = $withdraw_log->getRow("where id=$id limit 1");

        if($value['status']==1){
            KS_INFO('提现申请已经通过',0,'','',1);
		}
		if(empty($value['openid'])){
            KS_INFO('提现未绑定微信号',0,'','',1);
		}

		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';

		$this->webchatObj = new \Core\Wechat();
		$tmp_arr      = $this->webchatObj->getXmlArr();
		$parameters['mch_appid'] = KS_C('Mch_AppId');
		$parameters['mchid']     = KS_C('MchId');
		list($usec, $sec)  = explode(" ", microtime());
		$parameters['partner_trade_no'] = ((float)$usec + (float)$sec)*10000;
		$parameters['nonce_str'] = KS_MD5($parameters['partner_trade_no']);
		$parameters['openid']    = $value['openid'];
		$parameters['check_name']        = 'FORCE_CHECK';
		$parameters['re_user_name']      = $value['name'];
		$parameters['amount']            = $value['actualmoney']*100;
		$parameters['desc']              = '您好，您在科汛V名师提现的金额已到账!';
		$parameters['spbill_create_ip']  = '116.62.200.1';
		$parameters['sign']              = $this->SetSign($parameters);
		$resultStr = sprintf($tmp_arr['wxpay'],$parameters['mch_appid']
		,$parameters['mchid'],$parameters['nonce_str'],$parameters['partner_trade_no']
		,$parameters['openid'],$parameters['check_name'],$parameters['re_user_name'],$parameters['amount']
		,$parameters['desc'],$parameters['spbill_create_ip'],$parameters['sign']);

		$response = $this->postXmlCurl($resultStr, $url, true, 30);
		if(!empty($response) ) {
            $data = simplexml_load_string($response, null, LIBXML_NOCDATA);
            if ($data->result_code=='FAIL'){
                KS_INFO($data->err_code_des,0,'','',1);exit;
            }

            $err_code_des = json_encode($data->err_code_des,JSON_UNESCAPED_UNICODE);
            if(strstr($err_code_des,'{}')!=false){
            }else{
            	KS_INFO($err_code_des,0,'','',1);exit;
            }
        }else{
            echo json_encode( array('return_code' => 'FAIL', 'return_msg' => 'transfers_接口出错', 'return_ext' => array()) );
        }
		$id                  = ChkClng(KS_G('request.id'));
		$now_page            = ChkClng(KS_S('p',1));
		$withdraw_log        = M('app_withdraw_log');
		$Data['status']      = 1;
		$withdraw_log->update($Data,"id=$id");
		$url1 = M_URL('home/Capital','Distribution','',GP('p-'.$now_page));

        //打款成功，更新一下提现存储表的真实姓名
        $db_app = M('app_withdraw_bank');
        $datab['name']=$value['name'];
        $db_app->update($datab,"openid='".$value['openid']."'");

		KS_INFO('打款成功，已到账',3,$url1);
		exit;
	}

	//提现审核通过的通知
	public function sendtxmsgAction(){
		$Db = M('common_kf');
    	$res = $Db->getRow();
		$id = KS_G('get.id');
		$userid               = null !==GF('userid') ? GF('userid'):'0';
		$common_voucher_log   = M('app_task_money_log');
		$cmoney = $common_voucher_log->getOne('cmoney','where id='.$id);
		$openid = M('common_user')->getOne('openid','where userid='.$userid);
		$nickname = M('common_user')->getOne('username','where userid='.$userid);
		if(!empty($openid)){
			$linkurl = 'http://ks.kesion.com/h5market/spreadinfo';
			$tempdata =array(
			    "first" => array("value"=>"你好,提现申请已经通过", "color"=>"#111111"),
			    "keyword1"=>array("value"=>$nickname,"color"=>"#111111"),
			    "keyword2"=> array("value"=>date('Y-m-d H:i:s',time()), "color"=>"#111111"),
			    "keyword3"=>array("value"=>$cmoney, "color"=>"#111111"),
			   	"keyword4"=>array("value"=>'微信转账', "color"=>"#111111"),
			    "remark"=> array("value"=>"请等待工作人员和您联系，有疑问可以添加客服微信号：".$res['wechat'], "color"=>"#111111"),
			);

			sendwxmsg($openid,'ehGY7DbTD4cv_kleEAszmqiXx-UT3OOkpGuD5-Vx76U',$tempdata,$linkurl);

		}
		$url = M_URL('home/Capital','spreadindex','',GP(''));
		KS_INFO('发送成功',0,$url);
	}
	//拼团退款
	public function ptrefundAction(){
		$groupid = null !==GF('groupid') ? GF('groupid'):'';
		$Db       = M('app_h5_rulereward');
		$password      = ChkSQL(KS_G('post.password'));
//   	if(KS_MD5($password)!='141e68ce7d6d760f3488ed2bcf10a0bf')
   	   if($password!='123456')
     	{KS_INFO('打款密码不正确',0,'','',1);}
		$db_order_info = M('app_order_info');
		$db_order = M('app_order');
	    $Db2      = M('app_h5_user');
	    $allmoney = $db_order_info->getAll(' as a left join '.$Db2->table.' as b on a.groupid=b.groupid left join '.$db_order->table.' as c on a.orderid=c.orderid where a.groupid="'.$groupid.'" and a.paystatus=1','c.order_amount,c.ordersn,c.memberid,a.orderid,a.wxid');
	    $money = 0;
		$url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
         foreach($allmoney as $k=>$v){
//       	if($v['openid']){
         		$this->webchatObj = new \Core\Wechat();
				$tmp_arr      = $this->webchatObj->getXmlArr();
				$parameters['appid'] = KS_C('Mch_AppId');
				$parameters['mch_id']     = KS_C('MchId');
				//$parameters['mch_appid'] = 'wx3d73fc4aef554bf3';
				//$parameters['mchid']     = 1335752701;
//				list($usec, $sec)  = explode(" ", microtime());
//				$parameters['partner_trade_no'] = ((float)$usec + (float)$sec)*10000;
				$parameters['out_trade_no'] = $v['ordersn'];
				$parameters['nonce_str'] = KS_MD5($parameters['out_trade_no']);
//				$parameters['openid']    = $v['openid'];
				$parameters['out_refund_no'] = $v['ordersn'];
				$parameters['total_fee']            = $v['order_amount']*100;
				$parameters['refund_fee']            = $v['order_amount']*100;

				$parameters['sign']              = $this->SetSign($parameters);
				$resultStr = sprintf($tmp_arr['ptrefund'],$parameters['appid']
				,$parameters['mch_id'],$parameters['nonce_str'],$parameters['out_refund_no'],$parameters['out_trade_no']
				,$parameters['refund_fee'],$parameters['total_fee'],$parameters['sign']);
				$response = $this->postXmlCurl($resultStr, $url, true, 30);
				if( !empty($response) ) {
		            $data = simplexml_load_string($response, null, LIBXML_NOCDATA);
		            $err_code_des = json_encode($data->err_code_des,JSON_UNESCAPED_UNICODE);
		            if(strstr($err_code_des,'{}')!=false){
		            	//要进行余额的扣除和表状态的改变
						$orderData['paystatus'] =4;
						$db_order->update($orderData,'orderid="'.$v['orderid'].'" and memberid='.$v['memberid']);
						$orderData['paystatus'] =4;
						$db_order_info->update($orderData,'groupid="'.$groupid.'" and memberid='.$v['memberid']);
						$reward['moneystatus'] =1;
						$Db->update($reward,'groupid="'.$groupid.'" and memberid='.$v['memberid']);
		            }else{
		            	KS_INFO($err_code_des,0,'','',1);exit;
		            }
		            //echo json_encode($data->err_code_des,JSON_UNESCAPED_UNICODE);
		        }else{
		            echo json_encode( array('return_code' => 'FAIL', 'return_msg' => 'transfers_接口出错', 'return_ext' => array()) );
		        }
//       	}
         }
		$url1 = M_URL('h5market/Index','failurelist','',GP(''));
		KS_INFO('打款成功，已到账',3,$url1);
		exit;
	}
}