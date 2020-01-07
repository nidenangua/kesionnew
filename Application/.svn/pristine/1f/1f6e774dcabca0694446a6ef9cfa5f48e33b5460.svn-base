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
class ShopController extends CommonController
{
	 /**
	  * 扩容服务
	  */
	 public function indexAction(){
        $isopen    = KS_S('isopen',0); //升序和降序
		$option    = KS_S('option',0); //升序和降序
		$shopModel = M('common_cart');
	    $count     = $shopModel->getOne('count(*)',"where wxid=$this->wxid limit 1");
		$by        = null !==GF('by') ? GF('by'):'0'; //升序和降序
		if($by==0){$order = 'desc';}else{$order = 'asc';}

		if($option==0){
			$orderby   = null !==GF('orderby') ? GF('orderby'):'0'; //排序
			if($orderby==0){$byname = 'appid '.$order;}
			elseif($orderby==1){$byname = 'installs '.$order;}
			elseif($orderby==2){$byname = 'appid '.$order;}
			elseif($orderby==3){$byname = 'hits '.$order;}

			$shopModel = M('common_app');$appuserrelate  = M('common_app_userrelate');

			$where = 'where  status=1 and appid not in('.KS_C("V1_APPID").','.KS_C("V2_APPID").','.KS_C("V3_APPID").',111,19,23,6)'; //过滤104运营版高级运营版，107高级版 111钻石版，23公众号绑定、19独立收款插件等

            if (ChkClng(KS_S('appid'))>0){
                $where.=' and appid='.ChkClng(KS_S('appid'));
            }

			if($isopen==2){$where .= " and appid not in(select a.appid from $appuserrelate->table as a left join $shopModel->table as b on a.appid = b.appid where a.wxid=$this->wxid and isenabled=1)";}
			elseif($isopen==1){$where .=  " and appid in(select a.appid from $appuserrelate->table as a left join $shopModel->table as b on a.appid = b.appid where a.wxid=$this->wxid and isenabled=1)";}

			$options   = $shopModel->getOptions('10',$where);//分页参数设置
			$page      = Page($options);
			$values    = $shopModel->getPage($page,$byname,$where);
		}elseif($option==5){
			$values                 = $this->cache->GetACache('service');
			$options['now_page']    = ChkClng(KS_G('request.p'))!=0 ? ChkClng(KS_G('request.p')):'1';
			$options['maxperpage']  = 10;
		    $options['totalput']    = count($values);
			$page                   = Page($options);
			$values                 = $page->arrayPage($values);
	    }else{
	    	$app_temp    = M('app_temp');
	    	$mytemp      = $app_temp->getAll('where wxid='.$this->wxid.' and temptype='.($option-1),'tempid');
			$userwebsite = $this->cache->GetA('domaininfo','wxid',$this->wxid);
			if($option == 1){$temp = !empty($userwebsite['tempPid']) ? $userwebsite['tempPid'] : 0;
			}elseif($option == 2){$temp = !empty($userwebsite['tempMid']) ? $userwebsite['tempMid'] : 0;
	    	}
            $value                  = $this->cache->GetA('tempinfo','temptype',($option-1));
            $options['now_page']    = ChkClng(KS_G('request.p'))!=0 ? ChkClng(KS_G('request.p')):'1';
			$options['maxperpage']  = 10;
			if($this->wxid==1||$this->wxid==1049){
		        $options['totalput']    = count($value);
			    $page                   = Page($options);
			    $values                 = $page->arrayPage($value);
			}else{
				$values = array();
				foreach($value as $k=>$v){
					$biaoji = 0;
			    	foreach($mytemp as $kt=>$vt){if($v['tempid'] == $vt['tempid']){$biaoji = 1;break;}}
					if($v['isoffc']!=1&&$biaoji!=1){$values[]=$v;}
				}

				$options['totalput']    = count($values);
			    $page                   = Page($options);
			    $values                 = $page->arrayPage($values);
			}
		}
		include  CURR_VIEW_PATH . "Shop/home.APPList.php";
	 }
     /**
      * 扩容服务(首页）
      */
     public function CapacityServiceAction(){
         include  CURR_VIEW_PATH . "Shop/home.CapacityService.php";
     }

	 /**
     * 马上service购买
	  */
	 public function buyServiceAction(){
	 	$orderid          = ChkClng(KS_S('orderid',0));
		if(!empty($orderid)){
			ks_header(M_URL('Shop','confirmService','',GP('')));
		}else{
			$serviceid    = ChkClng(KS_G('request.id'));
			$serviceinfo  = $this->cache->GetA('service','serviceid',$serviceid,'',true);
			$numb         = ChkClng(ChkSQL(KS_G('request.numb'))!='' ?  ChkSQL(KS_G('request.numb')) : 1);//数量
            if ($numb<=0){
                KS_Alert('购买数量，必须大于0','error');
            }
			$starttime    = ChkClng(KS_G('post.startime'));
    	    $endtime      = ChkClng(KS_G('post.endtime'));
    	    $day          = ChkClng(KS_G('post.day'));
			ks_header(M_URL('Shop','confirmService',$serviceid,GP('numb-'.$numb.',starttime-'.$starttime.',endtime-'.$endtime.',days-'.$day)));
		}
	 }
	 /**
     * 扩展服务的确认页面（如购买短信）
	  */
	 public function confirmServiceAction(){
	 	$orderid               = ChkClng(KS_S('orderid'));
	 	if(!empty($orderid)){
	 		$pays              = ChkClng(KS_S('pays'));
		    $order_info        = M('common_order_info');
			$orderinfo         = $order_info->getRow("where orderid=$orderid limit 1",'appid,numb,starttime,endtime,ordersn,adddate');
			$serviceinfo       = $this->cache->GetA('service','serviceid',$orderinfo['appid'],'',true);
		    $numb              = $orderinfo['numb'];
		    $serviceid         = $orderinfo['appid'];
		    if($serviceid==6){
		    	$starttime         = $orderinfo['starttime'];
		        $endtime           = $orderinfo['endtime'];
		    }
		    $servicemoney      = $orderinfo['numb']*wx_version_itemvalue($serviceinfo['seriesid']);
	    }else{
	   	    $serviceid         = ChkClng(KS_G('request.id'));
		    $numb              = ChkClng(ChkSQL(null !==GF('numb') ? GF('numb'):'1'));
            if ($numb<=0){
                KS_Alert('购买数量，必须大于0','error');
            }
		    $serviceinfo       = $this->cache->GetA('service','serviceid',$serviceid,'',true);
		    $servicemoney      = wx_version_itemvalue($serviceinfo['seriesid'])*$numb;

		    if($serviceid==3){
		    	   $day               = ChkClng(null !==GF('day') ? GF('day'):'1');
		    	   $starttime         = ChkClng(null !==GF('starttime') ? GF('starttime'):time());
		    	   $endtime           = ChkClng(null !==GF('endtime') ? GF('endtime'):time());
		    	   $servicemoney      = wx_version_itemvalue($serviceinfo['seriesid'])*$numb*$day;
		    }elseif($serviceid==6){
//		    	    $starttime=mktime(0,0,0,date('m'),1,date('Y'));
//                  $endtime=mktime(23,59,59,date('m'),date('t'),date('Y'));
		    	   $day               = ChkClng(null !==GF('days') ? GF('days'):'1');
		    	   $starttime         = ChkClng(null !==GF('starttime') ? GF('starttime'):time());
		    	   $endtime           = ChkClng(null !==GF('endtime') ? GF('endtime'):time());
		    	   $servicemoney      = wx_version_itemvalue($serviceinfo['seriesid'])*$numb*$day;
		    }
	    }

	    if($servicemoney<0){
            KS_Alert('系统出错，请联系管理人员','error');
	    }

	    $voucher           = $this->cache->GetHCache('voucher',$this->wxid);
	    $website           = $this->cache->GetHCache('website',$this->wxid);
	    $Money             = $website['money'];//防止重复提交 如果重复提交跳转至相关页面
		if(cookie('TOKEN')!==null){cookie('TOKEN',null);$url = M_URL('Order','index');ks_header($url);}
	    $payconfig = $this->cache->GetACache('payconfig');//取出缓存
	    include  CURR_VIEW_PATH . "Shop/home.confirmorder.php";
	 }
     /**
     * 扩容服务的支付(发起支付）
      */
     public function payServiceAction(){
     	$voucherbalance          = 0;
	 	$voucher                 = ChkClng(KS_G('post.voucher'));
	 	//用户拥有的代金券
	 	if(!empty($voucher)){
	        $voucherbalance          = $this->cache->GetH('voucher','id',$voucher,'balance',$this->wxid);//代金卷余额
	        $vouchername             = $this->cache->GetH('voucher','id',$voucher,'voucher',$this->wxid);//代金卷名称
	 	}
     	$orderid                 = ChkClng(KS_G('post.orderid'));
	 	if(!empty($orderid)){//有订单了
	 		$pays                = ChkClng(KS_G('post.orderid'));
		    $order_info          = M('common_order_info');
			$orderinfo           = $order_info->getRow("where orderid=$orderid limit 1",'appid,numb,ordersn');
			$serviceinfo         = $this->cache->GetA('service','serviceid',$orderinfo['appid'],'',true);
		    $numb                = $orderinfo['numb'];
		    $serviceid           = $orderinfo['appid'];
		    $servicemoney        = $orderinfo['numb']*wx_version_itemvalue($serviceinfo['seriesid']);
		    $Data['ordersn']     = $orderinfo['ordersn'];
	 	}else{
	 		$serviceid           = ChkClng(KS_G('post.serviceid'));
			$serviceinfo         = $this->cache->GetA('service','serviceid',$serviceid,'',true);
			$numb                = ChkClng(KS_G('post.numb'));
            if ($numb<=0){
                KS_Alert('购买数量，必须大于0','error');
            }
		    $servicemoney        = wx_version_itemvalue($serviceinfo['seriesid'])*$numb;
		    if($serviceid==3){
		    		$day               = ChkClng(KS_G('post.day'));
		    		$starttime         = ChkClng(KS_G('post.starttime'));
		    	    $endtime           = ChkClng(KS_G('post.endtime'));
		    	    $servicemoney      = wx_version_itemvalue($serviceinfo['seriesid'])*$numb*$day;
		    }elseif($serviceid==6){
		    	    $day               = ChkClng(KS_G('post.day'));
		    		$starttime         = ChkClng(KS_G('post.starttime'));
		    	    $endtime           = ChkClng(KS_G('post.endtime'));
		    	    $servicemoney      = wx_version_itemvalue($serviceinfo['seriesid'])*$numb*$day;
		    }
		    //var_dump($servicemoney);exit;
		    //$servicemoney          = ChkSQL(KS_G('request.servicemoney'));
			list($usec, $sec)        = explode(" ", microtime());
			$Data['ordersn']         = $this->wxid.((float)$usec + (float)$sec)*10000;
			$shopModel               = M('common_order');
		    $Data['userid']          = $this->userid;
		    $Data['wxid']            = $this->wxid;
		    $Data['userip']          = $_SERVER['SERVER_ADDR'];
		    $Data['type']            = 2;
		    $Data['original_amount'] = $servicemoney;//原价
		    if($servicemoney-$voucherbalance<=0){
		    	$Data['order_amount']= 0;//实际价格
		    	$youhuijin           = $servicemoney;
		    }else{
		    	$Data['order_amount']= $servicemoney-$voucherbalance;//实际价格
		    	$youhuijin           = $voucherbalance;
		    }
		    //用户拥有的代金券
		 	if(!empty($voucher)){
		 		 $Data['voucherid']     = $voucher;
		 		 $Data['vouchername']   = $vouchername;
		 		 $Data['vouchermoney']  = $youhuijin;
		 	}
		    $Data['adddate']     = time();
		    $Data['paystatus']   = 0;
		    $orderid             = $shopModel->doAdd($Data,'orderid');
		    //订单详情
		    $order_apps          = M('common_order_info');
		    $Datas['wxid']       = $this->wxid;
		    //$Datas['starttime']  = time();
		    $Datas['appid']      = $serviceid;
		    $Datas['appname']    = $serviceinfo['servicename'];
		    $Datas['numb']       = $numb;
		    $Datas['price']      = $servicemoney;

		    switch($serviceid){
		    	case 1:
				    $Datas['sumprice']  = 0;
			    	$Datas['summarket'] =$numb/1000*wx_version_itemvalue(14);
			    	$Datas['market_price'] = wx_version_itemvalue(14);
			    break;
			    case 2:
				    $Datas['sumprice']  = 0;
			    	$Datas['summarket'] =$numb/1000*wx_version_itemvalue(15);
			    	$Datas['market_price'] = wx_version_itemvalue(15);
			    break;
			    case 3:
				    $Datas['sumprice']  = 0;
			    	$Datas['summarket'] =$numb*wx_version_itemvalue(40);
			    	$Datas['market_price'] = wx_version_itemvalue(40);
			    break;
			    case 4:
				    $Datas['sumprice']  = 0;
			    	$Datas['summarket'] =$numb*wx_version_itemvalue(12);
			    	$Datas['market_price'] = wx_version_itemvalue(12);
			    break;
			    case 6:
				    $Datas['sumprice']  = 0;
			    	$Datas['summarket'] =$numb/1000*wx_version_itemvalue(11);
			    	$Datas['market_price'] = wx_version_itemvalue(11);
				case 5:
				    $Datas['sumprice']  = 0;
			    	$Datas['summarket'] =$numb/1000*wx_version_itemvalue(13);
			    	$Datas['market_price'] = wx_version_itemvalue(13);
			    break;
				case 7:
					$Datas['sumprice']  = 0;
					$Datas['summarket'] =$numb/1000*wx_version_itemvalue(46);
					$Datas['market_price'] = wx_version_itemvalue(46);
					break;
		    }
		    $Datas['starttime']  = ChkClng(KS_G('post.starttime'));
		    $Datas['endtime']    = ChkClng(KS_G('post.endtime'));
		    $Datas['defaultpic'] = '/Images/images/201707/14994809769188.png';
		    $Datas['orderid']    = $orderid;
		    $Datas['ordersn']    = $Data['ordersn'];
			$order_apps->doAdd($Datas,'id');//添加单个app信息
			//插入明细表
	 	}
	 	$website           = $this->cache->GetHCache('website',$this->wxid);
	    $Money             = $voucherbalance;
	    //$website['money'];
	 	if(($servicemoney-$voucherbalance)<=0){
	 		$shopModel              =  M('common_order');
	 		$order_info             =  M('common_order_info');
	 		//$user_website         =  M('common_user_website');
	        $pay_log                =  M('common_pay_log');
		    $Datapl['userid']       =  $this->userid;
		    $Datapl['wxid']         =  $this->wxid;
		    $Datapl['adddate']      =  time();
		    $Datapl['cmoney']       =  0;
		    $Datapl['balance']      =  $website['money'];
		    $Datapl['type']         =  1;
		    $Datapl['userip']       =  $_SERVER['REMOTE_ADDR'];
		    $Datapl['mark']         =  '购买服务，代金券扣款'.$servicemoney.'元';
		    $pay_log->doAdd($Datapl,'id');
		    if(!empty($voucher)){
	            $voucher_log             =  M('common_voucher_log');
			    $Dataplt['userid']       =  $this->userid;
			    $Dataplt['wxid']         =  $this->wxid;
			    $Dataplt['voucherid']    =  $voucher;
			    $Dataplt['vouchername']  =  $vouchername;
			    $Dataplt['adddate']      =  time();
			    $Dataplt['cmoney']       =  $servicemoney;
			    $Dataplt['balance']      =  $voucherbalance-$servicemoney;
			    $Dataplt['type']         =  1;
			    $Dataplt['userip']       =  $_SERVER['REMOTE_ADDR'];
			    $Dataplt['mark']         =  '购买服务，代金券扣款'.$servicemoney.'元';
			    $voucher_log->doAdd($Dataplt,'id');
			    $common_voucher          =  M('common_voucher');
			    $Datau['balance']        =  $Dataplt['balance'];
   		        $common_voucher->update($Datau,"wxid =$this->wxid and id=$voucher");
   		        $this->cache->PutHCache('voucher',$this->wxid);
	 	    }
//		    $Datau['money']         =  $Money-$servicemoney;
//		    $user_website->update($Datau,"wxid =$this->wxid");
		    $Dataod['paystatus']    =  1;
		    $shopModel->update($Dataod,"wxid=$this->wxid and ordersn='$Data[ordersn]' limit 1");
		    $order_info->update($Dataod,"wxid=$this->wxid and ordersn='$Data[ordersn]' limit 1");
		    //网校的服务费用的充值服务
		    ServiceRecharge($numb,$serviceinfo['seriesid'],$this->wxid);

		   // $this->cache->PutHCache('website',$this->wxid);
		    $this->cache->PutHCache('domainbilling',$this->wxid);
		    ks_header(M_URL('Service','orderList'));
	    }else{
		    $payid               = ChkClng(KS_G('post.payid'));
			$Kspay               = new \Core\Kspay(array('payid' => $payid));
			$Kspay->out_trade_no = $Data['ordersn'];
			$Kspay->total_fee    = $servicemoney;
			if($payid==2){
				$Kspay->notify_url   = MY_FULLDOMAIN.'/home.html/default/Payback/getServiceback';
				$url2 = $Kspay->pay();$type = 4;
				include  ROOT . "Plus/native.php";
			}else{
				$Kspay->return_url   = wx_Url($this->wxid).M_URL('Payback','getServiceback');
				$Kspay->notify_url   = MY_FULLDOMAIN.'/home.html/default/Payback/getServiceback';
				$Kspay->pay();
			}
		}
    }

    ////马上app购买
    //public function buyNowAction(){
    //    $orderid           = ChkClng(KS_G('get.id'));
    //    if(!empty($orderid)){
    //         $appid        = ChkClng(KS_G('request.id'));
    //         $numb         = ChkClng(KS_G('request.numb'))!=0 ?  ChkClng(KS_G('request.numb')) : 1;
    //    }else{
    //         $appid        = ChkClng(KS_G('request.id'));
    //         $numb         = ChkClng(KS_G('request.numb'))!=0 ?  ChkClng(KS_G('request.numb')) : 1;
    //    }
    //    ks_header(M_URL('Shop','confirm',$appid,GP('numb-'.$numb)));
    //}
    ////进入订单确认页
    //public function confirmAction(){
    //    $appid      = ChkClng(KS_G('request.id'));
    //    $numb       = ChkClng(null !==GF('numb') ? GF('numb'):'0');
    //    $applist[0] = $this->cache->GetA('appinfo','appid',$appid,'',true);
    //    $sumMoney   = 0;
    //    $usersModel = M('common_user_website');
    //    $Money      = $usersModel->getOne('money'," WHERE wxid =$this->wxid limit 1");
    //    //防止重复提交 如果重复提交跳转至相关页面
    //    if(cookie('TOKEN')!==null){cookie('TOKEN',null);$url = M_URL('Order','index');ks_header($url);}
    //    $payconfig = $this->cache->GetACache('payconfig');//取出缓存
    //    include  CURR_VIEW_PATH . "Service/home.confirmService.php";
    //}

	/**
     * app的详情
	 */
	public function appDetailAction(){
	    $appid     = ChkClng(KS_G('request.id'));
	    $appinfo   = $this->cache->GetA('appinfo','appid',$appid,'',true);
	    $shopModel = M('common_cart');
	    $count     = $shopModel->getOne('count(*)',"where wxid=$this->wxid limit 1");
	    $appuserrelate  = M('common_app_userrelate');
		$appinfo2       = $appuserrelate ->getRow("where wxid=$this->wxid and appid=$appid");
	    cookie('TOKEN',null);
	    include  CURR_VIEW_PATH . "Shop/home.Appdetail.php";
	}

    //余额支付返回页
	public function payresultAction(){
	     include  CURR_VIEW_PATH . "Shop/payresult.php";
	}
    //服务的详情
	public function wxbackAction(){
	    $ordersn             = ChkClng(KS_G('request.ordersn'));
	    $shopModel           = M('common_order');
		$paystatus           = $shopModel->getOne('paystatus',"where wxid=$this->wxid and ordersn='$ordersn' limit 1");
	    if($paystatus==1){echo 'succeed';exit;}
	}
	/**
     * 购买云服务（点播流量、容量等）
	 */
	public function coludmanageAction(){
	 	$serviceType            = ChkClng(KS_G('request.id'));
	    $serviceinfo            = $this->cache->GetA('service','serviceid',$serviceType,'',true);
	    $voucher                = $this->cache->GetHCache('voucher',$this->wxid);
	    $shopModel              = M('common_cart');
	    $count                  = $shopModel->getOne('count(*)',"where wxid=$this->wxid limit 1");
	    $day                    = 1;
	    if($serviceType==3){  //空间扩容
		    $Expire       = wx_getvip_expiretime($this->wxid);
		    if($Expire){
		    	$day = ceil(($Expire-time())/(3600*24));
		    }else{
		    	$Expire = strtotime("+1 year");
		    	$day    = ceil(($Expire-time())/(3600*24));
		    }
	    }
	    $price = number_format(wx_version_itemvalue($serviceinfo['seriesid']),2);
//		var_dump($serviceinfo['seriesid']);die;
	    include  CURR_VIEW_PATH . "Shop/home.cloudmanage.php";
	}
	/**
     * 购买记录
	 */
	public function serviceRecordAction(){
	 	$serviceType   = ChkClng(KS_G('request.id'));
	 	$order         = M('common_order');
	 	$orderInfo     = M('common_order_info');
	 	$where         = ' as a  left join '.$orderInfo->table.' as b on a.orderid=b.orderid  where a.type=2 and a.wxid ='.$this->wxid.'  and a.paystatus=1 and b.appid='.$serviceType;
        $options       = $order->getOptions('10',$where);//分页参数设置
		$page          = Page($options);
		$values        = $order->getPage($page,'a.orderid desc',$where,'a.orderid,a.original_amount,a.order_amount,a.adddate,a.ordersn,b.numb,b.appname,b.appid,b.price,b.starttime,b.endtime,b.market_price');
		include  CURR_VIEW_PATH . "Shop/home.consumptionRecord.php";
	}
	/**
     * 消费记录    4点播
	 */
	public function consumptionRecordAction(){
 	    $serviceType   = ChkClng(KS_G('request.id'));
		if($serviceType == 7) {
			$vodlist= M('app_vod_list');
			$where = "where wxid=$this->wxid and istranscode=1";
			//die($where);
			$options   = $vodlist->getOptions('10',$where);//分页参数设置
			$page      = Page($options);
			$values    = $vodlist->getPage($page,'id desc',$where);
		} elseif($serviceType == 5){
 	    	    $livelog   = M('common_live_log');
		 	    $where     =' where wxid='.$this->wxid.' and status =2 and classlevel !=0';
				$classid   = null !==GF('classid') ? GF('classid'):'0';
				if(!empty($classid)){
				     $where .= ' and infoid='.$classid;
				}
	            $options   = $livelog->getOptions('10',$where);//分页参数设置
			    $page      = Page($options);
			    $values    = $livelog->getPage($page,'id desc',$where,'');
			    $classModel=M('app_class');
			    foreach($values as $k=>$v){
			    	$values[$k]['title']=$classModel->getOne('title',' where classid ='.$v['infoid'].' limit 1 ');
			    }
 	    }elseif($serviceType == 4){   //播放记录
            //$dayflow=M('app_dayflow');
            // $where =' where wxid='.$this->wxid.' and status =0';
            // $options   = $dayflow->getOptions('10',$where);//分页参数设置
            // $page      = Page($options);
            // $values    = $dayflow->getPage($page,'id desc',$where,'');

 	    	    $vodrec = M('app_vod_rec');
                $vodlist= M('app_vod_list');
                $vodcourse=M('app_course');
 	    	    $where =' as a INNER JOIN '.$vodlist->table.' b ON a.vdoId=b.vdoId INNER JOIN '.$vodcourse->table.' c ON a.courseid=c.courseid WHERE a.wxid='.$this->wxid.'';
                 //die($where);
                 $options   = $vodrec->getOptions('10',$where);//分页参数设置
			    $page      = Page($options);
                $values    = $vodrec->getPage($page,'a.id desc',$where,'a.*,b.vdoSize,c.coursehour,c.title,c.chaptertable');
 	    }elseif($serviceType==1){
 	    	$this->AppModel = M('app_sms_log');
 	    	$smsnum    = $this->cache->GetH('domainbilling','type',1,'number',$this->wxid);
	   	    $setting   = getSet($this->wxid,17);//获取网站配置
			$issuccess = null !==GF('issuccess') ? GF('issuccess'):'3';
			$where = 'where a.wxid ='.$this->wxid;
			$where .= ' and a.status!=-1';
			if($issuccess == 0){$where .= ' and a.issuccess=0';}
			elseif($issuccess == 1){$where .= ' and a.issuccess=1';}
			$keyword = ChkSQL(KS_S('keyword'));//搜索
			$keytype = ChkClng(KS_S('keytype',1));
		    //判断是否输入关键字
			if(!empty($keyword)){
			     if($keytype==1){$where.=" and a.memberid like '%$keyword%'";}
			     elseif($keytype==2){$where.=" and b.username like '%$keyword%'";}
			     elseif($keytype==3){$where.=" and a.mobile like '%$keyword%'";}
			     elseif($keytype==4){$where.=" and a.memberip like '%$keyword%'";}
			}
			$common_user   = M('common_user');
			$where = "as a left join `$common_user->table` as b on a.memberid = b.userid $where";
			$options = $this->AppModel->getOptions('10',$where);//分页参数设置
			$page = Page($options);
			$values = $this->AppModel->getPage($page,'adddate desc',$where,'b.username,b.mobile,a.*');
 	    }elseif($serviceType==2){
 	    	$emailnum    = $this->cache->GetH('domainbilling','type',2,'number',$this->wxid);
			$setting     = getSet($this->wxid,18);//获取网站配置
			$issuccess   = null !==GF('issuccess') ? GF('issuccess'):'3';
			$where = '  where a.wxid ='.$this->wxid;
			if($issuccess == 0){$where .= ' and a.issuccess=0';}
			elseif($issuccess == 1){$where .= ' and a.issuccess=1';}
			$keyword = ChkSQL(KS_S('keyword'));//搜索
			$keytype=null !==GF('keytype') ? GF('keytype'):0;
		    //判断是否输入关键字
			if(!empty($keyword)){
			     if($keytype==1){$where.=" and b.username like '%$keyword%'";}
			     elseif($keytype==2){$where.=" and a.content like '%$keyword%'";}
			}
			$common_user   = M('common_user');
			$EmailModel    = M('app_email_log');
			$where   = "as a left join `$common_user->table` as b on a.memberid = b.userid $where";
			$options = $EmailModel->getOptions('10',$where);//分页参数设置
			$page    = Page($options);
			$values  = $EmailModel->getPage($page,'adddate desc',$where,'b.username,a.*');
 	    }
	 	include  CURR_VIEW_PATH . "Shop/home.consumptionRecord.php";
	}
	//学生连麦情况
	public function wheatisAction(){
 	    $logid        = ChkClng(KS_G('request.id'));
		$livelogModel = M('common_live_log');
		if(!empty($logid)){
		    $livelog      = $livelogModel->getRow('where id ='.$logid.' limit 1');
		}else{
		    $classid      = null !==GF('classid') ? GF('classid'):'0';
		    $livelog      = $livelogModel->getRow('where infoid ='.$classid.' limit 1');
		}
 	    $liveModel    = M('app_live_list');
 	    $live         = $liveModel->getRow(' where id='.$livelog['channlid'].' limit 1');
		if(!empty($live)){
 			$studentModel = M($live['studentTable']);
 			$memberModel  = M('common_user_member');
 			$where        =' where wxid='.$this->wxid.' and  logid='.$logid;
			$options      = $studentModel->getOptions('10',$where);//分页参数设置
			$page         = Page($options);
			$values       = $studentModel->getPage($page,'id desc',$where);
			foreach($values as $k=>$v){
				$values[$k]['membername']=$memberModel->getOne('name','where userid='.$v['memberid']);
			}
			include  CURR_VIEW_PATH . "Shop/wheatis.php";
		}else{
		    $studentModel = M('app_live_student1');
 			$memberModel  = M('common_user_member');
 			$where        =' where wxid='.$this->wxid.' and  logid='.$logid;
			$options      = $studentModel->getOptions('10',$where);//分页参数设置
			$page         = Page($options);
			$values       = $studentModel->getPage($page,'id desc',$where);
			foreach($values as $k=>$v){
				$values[$k]['membername']=$memberModel->getOne('name','where userid='.$v['memberid']);
			}
			include  CURR_VIEW_PATH . "Shop/wheatis.php";
		}
	}
	//连麦
	public function chargingAction(){
	 	include  CURR_VIEW_PATH . "Shop/charging.php";
	}
	//查看每月并发
	public function MonthConcurrentAction(){
	 	$model=M('common_service_log');
	 	$year=date('Y',time());
	 	$month=date('n',time());
	 	$where =' where wxid='.$this->wxid;
 	    $options   = $model->getOptions('10',$where);//分页参数设置
		$page      = Page($options);
		$values    = $model->getPage($page,'year='.$year.' desc ,month='.$month.' desc,year asc,month asc',$where);
		include  CURR_VIEW_PATH . "Shop/Concurrent.php";
	}


    //把小课堂模板导入到私人的模板库
    public function classdownAction(){
		$type                 = null !==GF('type') ? GF('type'):'0';
		$tempid               = ChkClng(KS_G('request.id'));//表ID
		$value                = $this->cache->GetA('tempinfo','tempid',$tempid,'',true);
		$Data['tempid']       = $tempid;
		$Data['wxid']         = $this->wxid;
		$Data['tempname']     = $value['tempname'];
		$Data['temptype']     = $type;
		$Data['installdir']   = $value['installdir'];
		$Data['defaultpic']   = $value['defaultpic'];//应用封面图片
		$Data['author']       = $value['author'];
		$Data['intro']        = $value['intro'];
		$app_temp             = M('app_temp');//实例化云服务表
		$Rule['tempname']     = '模板风格名称|isEmpty,isDbexis';
		$Rule['installdir']   = 'PC模板目录|isEmpty,isEnglish';
		$Rule['defaultpic']   = '预览图片|isEmpty';
		Chkpost($Data,$Rule,$app_temp,'wxid='.$this->wxid);
		$app_temp->doAdd($Data,'id');
		$this->cache->PutHCache('tempinfo',$this->wxid); //把temp信息存入缓存
		$common_label         = M('common_label');//实例化云服务表
		$app_label            = M('app_label');//实例化云服务表
		$Labelarr             = $common_label->getAll("where tempid=$tempid");
		foreach($Labelarr as $k=>$v){
			$DataTwo['tempid']       = $tempid;
			$DataTwo['wxid']         = $this->wxid;
			$DataTwo['labelid']      = $v['labelid'];
			$DataTwo['labelname']    = $v['labelname'];
			$DataTwo['adddate']      = time();
			$DataTwo['labelcontent'] = EncodeSQL($v['labelcontent']);
			$DataTwo['labeltype']    = $v['labeltype'];
			$app_label->doAdd($DataTwo,'id');
		}
		$this->cache->PutLCache('labelinfo',$tempid);
		KS_INFO('导入成功',0,M_URL('Shop','index','',GP('')));
    }

}