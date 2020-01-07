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
class PaybackController extends Controller
{

    /******************************************************************支付返回处理  begin ******************************************
	/**
     * home端购买APP返回处理(机构订购服务）
     */
	public function getAppbackAction(){
		$Kspay                   = new \Core\Kspay();
		$result                  = $Kspay->alipay_return();
		if($result){
			$Data006['out_trade_no']  = $_REQUEST['out_trade_no']; //商户订单号
			$Data006['trade_no']      = $_REQUEST['trade_no'];     //支付宝交易号
			$Data006['trade_status']  = $_REQUEST['trade_status']; //交易状态
			$Data006['total_fee']     = $_REQUEST['total_fee']; //交易状态
			$Data006['linepaytype']       = 1;                  //支付宝支付
			$PayModel            = M('Application/PayModel');
            $PayModel  ->getAppback($Data006);
			cookie('indoor',M_URL('Service','orderList'));
			ks_header(M_URL());
		}else{
			$result = $Kspay->alipay_notify();
			if($result){//支付宝异步验证
			    $Data006['out_trade_no']  = $_REQUEST['out_trade_no']; //商户订单号
				$Data006['trade_no']      = $_REQUEST['trade_no'];     //支付宝交易号
				$Data006['trade_status']  = $_REQUEST['trade_status']; //交易状态
				$Data006['total_fee']     = $_REQUEST['total_fee']; //交易状态
				$Data006['linepaytype']       = 1;             //支付宝支付
				$PayModel            = M('Application/PayModel');
                $PayModel  ->getAppback($Data006);
				echo 'success';exit;
			}else{
				$Kspay                   = new \Core\Kspay(array('payid' => 2));
				$result                  = $Kspay->wx_return();
				//获取通知的数据
			    $xml = file_get_contents('php://input');
                if(empty($xml)){
                    $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
                }
			    /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                the best way is to check the validity of xml by yourself */
			    // 使用simplexml技术对xml进行解析
			    // libxml_disable_entity_loader(true), 是从安全性考虑，为了防止xml外部注入，
			    //只对xml内部实体内容进行解析
			    libxml_disable_entity_loader(true);
			    //加载 postStr 字符串
			    $postObj      = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
				if($result&&$postObj->return_code == "SUCCESS"&&$postObj->result_code == "SUCCESS"){//微信异步验证
					$Data006['out_trade_no']  = $postObj->out_trade_no; //商户订单号
					$Data006['trade_no']      = $postObj->out_trade_no; //商户订单号
					$Data006['trade_status']  = $postObj->trade_type;  //交易状态
					$Data006['total_fee']     = $postObj->total_fee/100;    //微信交易号
					$Data006['linepaytype']       = 2;                 //微信支付
					$PayModel            = M('Application/PayModel');
                    $PayModel  ->getAppback($Data006);
				}
			}
		}
    }


	/**
     * 扩容服务付费后的回调函数
     */
	public function getServicebackAction(){
		$Kspay                   = new \Core\Kspay();
		$result                  = $Kspay->alipay_return();
		if($result){//支付宝同步验证
			$out_trade_no            = $_REQUEST['out_trade_no']; //商户订单号
			$trade_no                = $_REQUEST['trade_no'];     //支付宝交易号
			$trade_status            = $_REQUEST['trade_status']; //交易状态
			$total_fee               = $_REQUEST['total_fee']; //交易状态
			$Data002['out_trade_no'] = $out_trade_no;
			$PayModel            = M('Application/PayModel');
            $PayModel  ->Serviceback($out_trade_no,1);
			cookie('indoor',M_URL('Service','orderList'));
			ks_header(M_URL());
		}else{
			$result = $Kspay->alipay_notify();
			if($result){//支付宝异步验证
			    $out_trade_no            = $_REQUEST['out_trade_no']; //商户订单号
				$trade_no                = $_REQUEST['trade_no'];     //支付宝交易号
				$trade_status            = $_REQUEST['trade_status']; //交易状态
				$total_fee               = $_REQUEST['total_fee']; //交易状态
				$PayModel            = M('Application/PayModel');
                $PayModel  ->Serviceback($out_trade_no,1);
				echo 'success';exit;
			}else{
				$Kspay                      = new \Core\Kspay(array('payid' => 2));
				$result                     = $Kspay->wx_return();
				//获取通知的数据
			    $xml = file_get_contents('php://input');
                if(empty($xml)){
                    $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
                }
			    /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                the best way is to check the validity of xml by yourself */
			    // 使用simplexml技术对xml进行解析
			    // libxml_disable_entity_loader(true), 是从安全性考虑，为了防止xml外部注入，
			    //只对xml内部实体内容进行解析
			    libxml_disable_entity_loader(true);
			    //加载 postStr 字符串
			    $postObj      = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
				if($result&&$postObj->return_code == "SUCCESS"&&$postObj->result_code == "SUCCESS"){
					$out_trade_no            = $postObj->out_trade_no; //商户订单号
					$total_fee               = $postObj->total_fee;    //支付宝交易号
					$trade_type              = $postObj->trade_type;;  //交易状态
					$PayModel            = M('Application/PayModel');
                    $PayModel  ->Serviceback($out_trade_no,2);
				}
			}
		}
	}



    /**
     * 店铺的微信支付成功回调（入驻的网校）
     */
    function storePayBackAction(){

		$xml = file_get_contents('php://input');
		if(empty($xml)){
			$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
		}
		libxml_disable_entity_loader(true);
		$postObj      = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
		if($postObj->return_code == "SUCCESS"&&$postObj->result_code == "SUCCESS"){
			$out_trade_no           = $postObj->out_trade_no; //商户订单号
			$total_fee              = $postObj->total_fee*0.01;  //微信实际支付
			$trade_type             = $postObj->trade_type;;  //交易状态
			$paytype = M('app_order_info')->getOne('paytype',"where ordersn=$out_trade_no");
			$Kspay      = new \Core\Kspay(array('payid' => $paytype,'wxid'=>$this->wxid));
			$result     = $Kspay->wx_return();
//			KSLog('这里验证签名'.$result);
			if ($result){
				$PayModel            = M('Application/PayModel');
				$PayModel->storeOrderProcess($out_trade_no,2,$total_fee);  //处理订单
			}
		}
    }





 /******************************************************************支付返回处理  end ******************************************/











    //home端的充值
    public function rechargebackAction(){
     	$Kspay                   = new \Core\Kspay();
		$result                  = $Kspay->alipay_return();
		if($result){//支付宝同步验证
			$out_trade_no        = $_GET['out_trade_no']; //商户订单号
			$trade_no            = $_GET['trade_no'];     //支付宝交易号
			$trade_status        = $_GET['trade_status']; //交易状态
			$total_fee           = $_REQUEST['total_fee']; //交易状态
			$Data003['out_trade_no'] = $out_trade_no;
			$Data003['linepaytype']       = 1;
			$PayModel            = M('Application/PayModel');
 		    $PayModel  ->rechargeback($Data003);
			cookie('indoor',M_URL('Capital','capitalbill'));
			ks_header(M_URL());
		}else{
			$result = $Kspay->alipay_notify();
			if($result){//支付宝异步验证
			    $out_trade_no        = $_REQUEST['out_trade_no']; //商户订单号
				$trade_no            = $_REQUEST['trade_no'];     //支付宝交易号
				$trade_status        = $_REQUEST['trade_status']; //交易状态
				$total_fee           = $_REQUEST['total_fee']; //交易状态
				$Data003['out_trade_no'] = $out_trade_no;
				$Data003['linepaytype']       = 1;
				$PayModel            = M('Application/PayModel');
	   		    $PayModel  ->rechargeback($Data003);
				echo 'success';exit;
			}else{
				$Kspay                   = new \Core\Kspay(array('payid' => 2));
				$result                  = $Kspay->wx_return();
				//获取通知的数据
			    $xml = file_get_contents('php://input');
				if(empty($xml)){
					$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
				}
			    /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
		         the best way is to check the validity of xml by yourself */
			    // 使用simplexml技术对xml进行解析
			    // libxml_disable_entity_loader(true), 是从安全性考虑，为了防止xml外部注入，
			    //只对xml内部实体内容进行解析
			    libxml_disable_entity_loader(true);
			    //加载 postStr 字符串
			    $postObj      = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
				if($result&&$postObj->return_code == "SUCCESS"&&$postObj->result_code == "SUCCESS"){//微信异步验证
					$out_trade_no        = $postObj->out_trade_no; //商户订单号
					$total_fee           = $postObj->total_fee;    //支付宝交易号
					$trade_type          = $postObj->trade_type;;  //交易状态
					$Data003['out_trade_no'] = $out_trade_no;
					$Data003['linepaytype']       = 2;
					$PayModel            = M('Application/PayModel');
		 		    $PayModel  ->rechargeback($Data003);
				}
			}
		}
    }


    /**
     * 独立收款插件配置支付，测试返回
     */
    public function wxRechargeMoneybackAction(){
		$Kspay                      = new \Core\Kspay(array('payid' => 2,'wxid'=>$this->wxid,'cs'=>1));
//		KSLog('wxid'.$this->wxid);
		$result                     = $Kspay->wx_return();                   //微信返回
//		$result                     = true;                   //微信返回
		$xml = file_get_contents('php://input');
		if(empty($xml)){
			$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
		}
		libxml_disable_entity_loader(true);
		$postObj      = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

		if($result&&$postObj->return_code == "SUCCESS"&&$postObj->result_code == "SUCCESS"){

			$out_trade_no           = $postObj->out_trade_no; //商户订单号
			$total_fee              = $postObj->total_fee;    //支付宝交易号
			$trade_type             = $postObj->trade_type;;  //交易状态
			$shopModel              = M('app_order');
			$orderinfo              = $shopModel->getRow("where ordersn='$out_trade_no' limit 1",'orderid,wxid,memberid,memberip,order_amount');
			$order_info             = M('app_order_info');
			$user                   = M('common_user');
			$Money                  = $user->getOne('money',"where userid=".$orderinfo['memberid']);
			$apnlog      = M('Application/LogModel');
			$apnlog->memberlog($orderinfo,$Money,7);                  //用户使用通过小课堂使用支付宝进行充值
			$Datau['money']      = $orderinfo['order_amount']+$Money;
			$user->update($Datau,"userid=".$orderinfo['memberid']);

			$Data['paystatus']   = 1;
			$shopModel->update($Data,"ordersn='$out_trade_no' limit 1");
			$order_info->update($Data,"wxid=$orderinfo[wxid] and orderid=$orderinfo[orderid] limit 1");
			noticeSend($orderinfo['wxid'],$orderinfo['memberid'],$orderinfo['orderid'],'恭喜你成功充值'.$orderinfo['order_amount'],$Datapl['mark'] ,2,'系统');
		}
	}
	public function H5classbackAction(){
		$Kspay                      = new \Core\Kspay(array('payid' => 2));
		$result                     = $Kspay->wx_return();
		$xml = file_get_contents('php://input');
		if(empty($xml)){
			$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
		}
		libxml_disable_entity_loader(true);
		$postObj      = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
		if($result&&$postObj->return_code == "SUCCESS"&&$postObj->result_code == "SUCCESS"){
			$out_trade_no           = $postObj->out_trade_no; //商户订单号
			$total_fee              = $postObj->total_fee;    //支付宝交易号
			$trade_type             = $postObj->trade_type;;  //交易状态
			$shopModel              = M('app_order');
			$orderinfo              = $shopModel->getRow("where ordersn='$out_trade_no' limit 1",'orderid,wxid,memberid,memberip,order_amount');

			$order_info             = M('app_order_info');
			$orderinfodetail        = $order_info->getRow("where ordersn='$out_trade_no' limit 1",'courseid,price,ordersn');
	        $Money                  = $orderinfodetail['price'];
		    //$servicemoney           = $orderinfo['numb']*wx_version_itemvalue($serviceinfo['seriesid']);
			//调用唤起传说中的model层
			$apnlog = M('Application/LogModel');
			$apnlog->paylog($orderinfo,3);//H5买课程余额不够的情况，先充值，再扣钱

			$Dataod['paystatus']    =  1;
			$shopModel->update($Dataod,"wxid=$orderinfo[wxid] and ordersn='$out_trade_no' limit 1");
			$order_info->update($Dataod,"wxid=$orderinfo[wxid] and ordersn='$out_trade_no' limit 1");
			//班级多一步就是把学生加入对应的班级
			$classMode = M('app_class');
			$classinfo = $classMode->getRow('where wxid='.$orderinfo['wxid'].' and classid='.$orderinfodetail['courseid']);
			$app_class_studentrelate = M('app_class_studentrelate');
			$classData['wxid'] = $orderinfo['wxid'];
			$classData['classid'] = $orderinfodetail['courseid'];
			$classData['memberid'] = $orderinfo['memberid'];
			$classData['adddate'] = time();
			if($classinfo['chargeData'] == 1){
				$classData['enddate'] = strtotime('+1 month');
			}elseif($classinfo['chargeData'] == 2){
				$classData['enddate'] = strtotime("+3 month");
			}else{
				$classData['enddate'] = strtotime("+1 year");
			}
			$classData['addtype'] = 3;
			$classData['comments'] = 'H5营销';
			$app_class_studentrelate->doAdd($classData,'id');
		}
	}


}