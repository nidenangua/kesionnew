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
class PayController extends CommonController
{
	 
	 public function indexAction(){
	   
	   cookie('TOKEN',date("YmdHis"));
	   
	   $appids = ChkSQL(KS_G('post.appid')); 
	   
	   $shopModel = M('common_order');
	   
	   $Porderid = ChkClng(KS_G('post.Porderid'));
	   
	   if($Porderid!==0){
		   
		  $Data['ordersn'] = $shopModel->getOne('ordersn',"where orderid=$Porderid"); 
		  
	   }else{
		   
		  list($usec, $sec) = explode(" ", microtime());
		   
		  $Data['ordersn'] = $this->userid.((float)$usec + (float)$sec)*10000;
		   
		  $Data['userid'] = $this->userid;
		  
		  $Data['wxid'] = $this->wxid;
		   
		  $Data['userip'] = $_SERVER['REMOTE_ADDR'];
		   
		  $Data['adddate'] = time();
		   
		  $Data['paystatus'] = 0;
		   
		  $orderid = $shopModel->doAdd($Data,'orderid');
	   }
	   
	   $order_apps = M('common_order_info');
	   
	   $cartModel = M('common_cart');
	   
	   $sumMoney = 0;  
	   
	   foreach($appids as $k=>$v)
	   {
		   $applist = $this->cache->GetA('appinfo','appid',$v,'',true);
		    
		   $Datas['appid'] = $v;
		   
		   $Datas['appname'] = $applist['appname'];
		   
		   $Datas['price'] = $applist['price'];
		   
		   $Datas['defaultpic'] = $applist['defaultpic'];
		   
		   $Datas['numb'] = ChkClng(KS_G('post.numb_'.$v));
		   
		   if($Porderid!==0)
		   {	   
		       $orderid = $Porderid;
		   }else{
			   $Datas['orderid'] = $orderid;
			   //添加单个app信息
			   $order_apps->doAdd($Datas,'id');
			   //删除购物车
		       $cartModel->delete("wxid=$this->wxid and appid=$v");
		   }
		   $sumMoney = $sumMoney+$Datas['numb']*$Datas['price'];
		   
	   }
	    
		
	   $usersModel = M('common_user');
	   
	   $pay_log = M('common_pay_log');
	   
	   $Money = $usersModel->getOne('money'," WHERE wxid =$this->wxid  and usertype = 1  limit 1");	
	   
	   if(($sumMoney-$Money)<=0)
	   {
		  $Datapl['userid'] =  $this->userid;
		  
		  $Datapl['wxid'] =  $this->wxid;
		  
		  $Datapl['adddate'] =  time();
		  
		  $Datapl['cmoney'] = $sumMoney;
		  
		  $Datapl['balance'] = $Money-$sumMoney;
		  
		  $Datapl['type'] =  1;
		  
		  $Datapl['userip'] = $_SERVER['REMOTE_ADDR'];
		  
		  $Datapl['mark'] = '用户余额充足，直接余额扣款';
		  
		  $pay_log->doAdd($Datapl,'id');
		  
		  $Datau['money'] = $Money-$sumMoney;
		  
		  $usersModel->update($Datau,"wxid =$this->wxid");
		  
		  $Dataod['paystatus'] = 1;
		  
		  $Dataod['order_amount'] = $sumMoney;
		  
		  $shopModel->update($Dataod,"ordersn='$Data[ordersn]' limit 1");
		  //app关联表
		  $app_userrelate = M('common_app_userrelate');
		  
		  $appidall = $order_apps->getAll("where orderid=$orderid");
		  
		  $appidalls = $app_userrelate->getAll("where wxid=$this->wxid");
		  
		  foreach($appidall as $k=>$v)
		  {
			  $biaoji = 0;
			  foreach($appidalls as $kt=>$vt)
			  {
				  if($v['appid'] == $vt['appid']){$biaoji = 1;}
			  }
			  if($biaoji == 1)
			  {
				   $Datar['days'] = $v['numb'];
				   $app_userrelate->update($Datar,"appid=$v[appid] and wxid=$this->wxid");
			  }else{
				   $Datar['wxid'] = $this->wxid;
				   $Datar['appid'] = $v['appid'];
				   $Datar['adddate'] = time();
				   $Datar['days'] = $v['numb'];
				   $app_userrelate->doAdd($Datar,'id');
			  }
		  }
		  $url = UOOT.'Plus/KsPay/KsBack.pay.php';
		  ks_header($url);
		  
	   }else{
		   
		  $payid = ChkClng(KS_G('post.payid'));
		  if($payid == 0){$payid = 1;}
		  //$payid = null !==GF('orderby') ? GF('orderby'):'0';
		  
		  $Dataod['order_amount'] = $sumMoney-$Money;
		  
		  $shopModel->update($Dataod,"ordersn=$Data[ordersn]");
		 
		  $url = UOOT."Plus/KsPay/KsApi.pay.php?ordersn=$Data[ordersn]&payid=$payid";
		  ks_header($url);
		  
	   }
		
	 }
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 	 
}