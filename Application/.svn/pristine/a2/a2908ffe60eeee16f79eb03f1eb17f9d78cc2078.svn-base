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
/**
 * 订购服务中心
 */
class ServiceController extends CommonController
{
    /******************************************************购物车 begin **************************************************/
    /**
     * 购物车
     */
    public function cartAction(){
		$by   = null !==GF('by') ? GF('by'):'0'; //升序和降序
		if($by==0){ $order = 'desc';}
		else{$order = 'asc';}//排序
		$orderby=null !==GF('orderby') ? GF('orderby'):'0';
		if($orderby==0){$byname = 'appid '.$order;}
		elseif($orderby==1){$byname = 'installs '.$order;}
		elseif($orderby==2){$byname = 'appid '.$order;}
		elseif($orderby==3){$byname = 'hits '.$order;}
		$shopModel = M('common_cart');
		$pagecarts = $shopModel->getAll("where wxid=$this->wxid");
		cookie('TOKEN',null);
		include  CURR_VIEW_PATH . "Service/home.cartlist.php";
    }

    /**
     * 删除购物车操作
     */
    public function delCartAction(){
	    $now_page  = ChkClng(KS_S('p'));
		$appid     = ChkClng(KS_G('request.id'));
		$shopModel = M('common_cart');
		$shopModel->delete("wxid=$this->wxid and appid=$appid");
		$url       = M_URL('Service','Cart');
		ks_header($url);
    }
    /******************************************************购物车 end **************************************************/


    /******************************************************购买服务 begin **************************************************/
    /**
     * 升级套餐服务(第一步：选购APP)
     */
	public function upgradeAction(){
        $voucher               = $this->cache->GetHCache('voucher',$this->wxid);//代金卷
		$common_voucher        = M('common_voucher');
		$db_task_reward = M('common_task_reward');
        $taskVoucher = $db_task_reward->getAll('where wxid='.$this->wxid.' and status=0 and effectivetime>'.time());
		$appcategory           = $this->cache->GetACache('appcategory');//读取缓存
		$websiteinfo           = $this->cache->GetHCache('website',$this->wxid);//读出缓存
		$package               = $websiteinfo['package'];
		$status                = $websiteinfo['status'];
        $wxmoney               = $websiteinfo['money'];//网校的总金额
        $withdrawmoney         = $websiteinfo['withdrawmoney'];//网校的总金额
		//$versionname           = $this->cache->GetA('commonpackageversion','versionename',$package,'versionname');
        $versionname             = wx_version($this->wxid); //当前在用的版本
        $version                 = getVersionNumber($this->wxid); //当前在用的版本，v1,testv1等


        $common_app = M('common_app');
        $appinfo    = $common_app ->getAll('where isprice=1 and status!=0 and appid not in('.KS_C("V1_APPID").','.KS_C("V2_APPID").','.KS_C("V3_APPID").',111,19,23)');  //过滤104运营版高级运营版，107高级版 111钻石版，23公众号绑定、19独立收款插件等
        $shopModel = M('common_cart');
		$pagecarts = $shopModel->getAll("where wxid=$this->wxid");

        $appuserrelate  = M('common_app_userrelate');
		foreach($appinfo as $k=>$v){
			$appNum = $shopModel ->getOne('count(*)',"where wxid=$this->wxid and appid=$v[appid]");
			if($appNum>0){$appinfo[$k]['isopen'] = 1;}else{$appinfo[$k]['isopen'] = 0;}
		}
		include  CURR_VIEW_PATH . "Service/home.upgrade.php";
    }

    /**
     * 删除或是提交确认支付
     */
    public function doBatchAction(){
		$batch  = ChkSQL(KS_G('post.batch'));
		$appids = ChkSQL(KS_G('post.appid'));
		if(empty($appids)){KS_INFO('请选择',4,'','',1);}
		$numb   = ChkClng(KS_G('request.numb'))!=0 ?  ChkClng(KS_G('request.numb')) : 1;
		if($batch==1){
			$shopModel = M('common_cart');
			foreach($appids as $k=>$v){$shopModel->delete("wxid=$this->wxid and appid=$v");}
			$url = M_URL('Cart','index');KS_INFO('删除成功',0,$url);
		}else{       //确认支付
			$appids = implode('@',$appids);
			ks_header(M_URL('Service','confirmService','',GP('numb-'.$numb.',appids-'.$appids.',batch-'.$batch)));
		}
    }


    /**
     * 购买进入订单确认页(第二步：确定选购的APP)
     */
    public function confirmServiceAction(){
        $batch  = ChkClng(null !==GF('batch') ? GF('batch'):'0');
		$appids = ChkSQL(null !==GF('appids') ? GF('appids'):'0');
		$appids = explode('@',$appids);
		if(empty($appids)){
            KS_Alert('请选择要开通的应用','error',KS_ComeUrl());
        }
		$numb = ChkClng(KS_S('numb','1'));
        if ($numb<=0){
            KS_Alert('购买数量必须大于0','error',KS_ComeUrl());
        }
		if($batch==1){
			$shopModel = M('common_cart');
			foreach($appids as $k=>$v){$shopModel->delete("wxid=$this->wxid and appid=$v");}
			$url = M_URL('Service','Cart');
            KS_Alert('删除成功','error',$url);
		}else{
			foreach($appids as $k=>$v){
                if ($v>0){
                    $applist[$k] = $this->cache->GetA('appinfo','appid',$v,'',true);
                    if (empty($applist[$k])){   //缓存取到，删除掉
                        unset($applist[$k]);
                    }
                }
            }
            if (count($applist)<=0){
                KS_Alert('没有APP应用，请选择要购买的应用!','error',KS_ComeUrl());
            }

			$sumMoney   = 0;
			$usersModel = M('common_user');
			$Money      = getWxinfo($this->wxid,'money');  //可用余额

			$common_task_link = M('common_task_link');
			$allye       = $common_task_link->getOne('sum(money)','where wxid='.$this->wxid.' and complete=1 and status=0 and effectivetime>'.time());//查找可使用的任务奖励
    	    $allye     = empty($allye)?'0':$allye;
			$payconfig = $this->cache->GetACache('payconfig');//取出缓存
			include  CURR_VIEW_PATH . "Service/home.confirmService.php";
		}
    }

    /**
     * 购买app的进入支付流程(第三步：生成订单并发起支付)
     */
	public function payAction(){
	    cookie('TOKEN',date("YmdHis"));
	    $appids    = ChkSQL(KS_G('post.appid'));
	    $shopModel = M('common_order');                        //订单主表
	    $Porderid  = ChkClng(KS_G('post.Porderid'));
	    $taskmoney = ChkClng(KS_G('post.taskmoney'));
	    if($Porderid!==0){
		    $Data['ordersn']   = $shopModel->getOne('ordersn',"where orderid=$Porderid");
	    }else{
		    list($usec, $sec)  = explode(" ", microtime());
		    $Data['ordersn']   = $this->wxid.((float)$usec + (float)$sec)*10000;
		    $Data['userid']    = $this->userid;
		    $Data['wxid']      = $this->wxid;
		    $Data['userip']    = KS_IP();
		    $Data['adddate']   = time();
		    $Data['paystatus'] = 0;
		    $orderid = $shopModel->doAdd($Data,'orderid');   //插入主表
	    }
	    $order_apps = M('common_order_info');                //订单副表
	    $cartModel  = M('common_cart');
	    $sumMoney   = 0;                                     //订单金额
	    $subject    = '';
        $hasOrderItem = false;
	    foreach($appids as $k=>$v){
            if ($v>0){
                $applist             = $this->cache->GetA('appinfo','appid',$v,'',true);
                if (!empty($applist)){
                    $hasOrderItem=true;
                    if($subject===''){
                        $subject   .= $applist['appname'];
                    }
                    else{
                        $subject   .= ','.$applist['appname'];
                    }
                    $Datas['appid']      = $v;
                    $Datas['appname']    = $applist['appname'];
                    $Datas['price']      = $applist['price'];
                    $Datas['defaultpic'] = $applist['defaultpic'];
                    $Datas['numb']       = ChkClng(KS_G('post.numb_'.$v));
                    if ($Datas['numb']<=0){
                        $Datas['numb']=1;
                    }
                    if($Porderid!==0) {
                        $orderid = $Porderid;
                    }else{
                        $Datas['orderid'] = $orderid;
                        $order_apps->doAdd($Datas,'id');//添加单个app信息
                        $cartModel->delete("wxid=$this->wxid and appid=$v"); //删除购物车
                    }
                    $sumMoney = $sumMoney+$Datas['numb']*$Datas['price'];    //订单金额累加
                }
            }
	    }

        $orderData['order_amount']=$sumMoney;     //更新订单的总金额
        if ($hasOrderItem){
            $shopModel->update($orderData,"ordersn='".$Data['ordersn']."'");
        }else{
            $shopModel->delete("ordersn='".$Data['ordersn']."' and wxid=".$this->wxid);
            KS_Alert('没有选择购买的应用！','error',KS_ComeUrl());
        }

	    $usersModel = M('common_user');
	    $Money      = getWxinfo($this->wxid,'money');                 //可用余额
        if($Porderid!==0){//查找订单中的任务奖励金额
            $allye = $shopModel->getOne('taskreward',"where orderid=$Porderid");
            $sumMoney = $sumMoney-$allye;//扣掉任务的奖励(没有奖励金额则减去0)
        }else{
        	//没有订单则查找没使用过的任务奖励金额
            $common_task_link = M('common_task_link');
            $where = 'wxid='.$this->wxid.' and complete=1 and status=0 and effectivetime>'.time();
			$allye       = $common_task_link->getOne('sum(money)','where '.$where);//查找可使用的任务奖励
		    $allye     = empty($allye)?'0':$allye;
		    if($allye>0){
                if($taskmoney==1){//选择使用任务奖励
                    $sumMoney = $sumMoney-$allye;//扣掉任务的奖励
                    $taskData['status'] = 1;
                    $common_task_link->update($taskData,$where);
                    $Data111['taskreward'] = $allye;
                    $orderid = $shopModel->update($Data111,'orderid='.$orderid);
                }
		    }
        }
        if ($sumMoney<=0){
            KS_Alert('无效提交！','error',KS_ComeUrl());
        }

	    if(($sumMoney-$Money)<=0){                       //余额充足的情况，直接支付掉，并写入APP关联表

            $PayModel            = M('Application/PayModel');
            $PayModel->ServiceOrderProcess($Data['ordersn'],0);  //调用扣费，并处理订单逻辑
		    ks_header(M_URL('Service','orderList'));

	    }else{                                          //余额不足，走在线支付充值流程
			if(round($sumMoney-$Money,2)>0){
                $Dataod['order_amount'] = $sumMoney;
                $total_fee = round($sumMoney-$Money,2);
			}else{
                KS_INFO('金额不足',4);
            }
		    $shopModel->update($Dataod,"ordersn=$Data[ordersn]");

		    $payid               = ChkClng(KS_G('post.payid'));                        //支付方式 1 alipay 2微信
			$Kspay               = new \Core\Kspay(array('payid' => $payid));
			$Kspay->out_trade_no = $Data['ordersn'];
			$Kspay->subject      = $subject;
			$Kspay->total_fee    = $total_fee;//$total_fee;
			$Kspay->payid        = $payid;
			if($payid==2){        //微信
				$Kspay->notify_url   = MY_FULLDOMAIN.'/home.html/default/Payback/getAppback';
				$url2 = $Kspay->pay();
                $type = 4;
				include  ROOT . "Plus/native.php";
			}else{               //支付宝
				$Kspay->return_url   =  wx_Url($this->wxid).M_URL('Payback','getAppback');
				$Kspay->notify_url   = MY_FULLDOMAIN.'/home.html/default/Payback/getAppback';

				$Kspay->pay();
			}
	    }
    }

	/**
     * 续费App
	 */
	public function renewAction(){
	    $appid      = ChkClng(KS_G('request.id'));
	    $numb       = ChkClng(KS_S('numb',1));
	    $applist[0] = $this->cache->GetA('appinfo','appid',$appid,'',true);
	    $sumMoney   = 0;
	    $usersModel = M('common_user_website');
	    $Money      = $usersModel->getOne('money'," WHERE wxid =$this->wxid limit 1");
	    //防止重复提交 如果重复提交跳转至相关页面
		if(cookie('TOKEN')!==null){cookie('TOKEN',null);$url = M_URL('Service','orderList');ks_header($url);}
	    $payconfig = $this->cache->GetACache('payconfig');//取出缓存
	    include  CURR_VIEW_PATH . "Service/home.confirmService.php";
	}
    /******************************************************购买服务 end**************************************************/






    /*****************************************************我的订单 begin ****************************************************/
    /**
     * 订单列表
     */
    public function orderListAction(){
	    $paystatus   = ChkClng(KS_S('paystatus',3));
		if($paystatus==3){$where = "where wxid=$this->wxid and (paystatus=0 or paystatus=1)";}
		elseif($paystatus==1){$where = "where wxid=$this->wxid and paystatus=1"; }
		elseif($paystatus==0){$where = "where wxid=$this->wxid and paystatus=0";}
        $where .= ' and isgive=0';
		$by = null !==GF('by') ? GF('by'):'0'; //升序和降序
		if($by==0){$order = 'desc';}else{$order = 'asc';}
		$orderby= ChkClng(KS_S('orderby')); //排序
		if($orderby==0){$byname = 'adddate '.$order;}
		elseif($orderby==1){$byname = 'installs '.$order;}
		elseif($orderby==2){$byname = 'appid '.$order;}
		elseif($orderby==3){$byname = 'hits '.$order;}
		$shopModel = M('common_order');
		//$shopModel = M('common_order');
		//$where = "as a left join `$Model->table` as b on a.userid = b.userid left join `$user_category->table` as c on b.categoryid = c.categoryid $where";
		$options = $shopModel->getOptions('4',$where);//分页参数设置
		$page = Page($options);
		$pageorders = $shopModel->getPage($page,$byname,$where);
		$orderInfo=M('common_order_info');

		foreach($pageorders as $k=>$v){
			$pageorders[$k]['orderinfo']=$orderInfo->getRow(' where orderid='.$v['orderid'].' limit 1','numb,appid');
		}

		cookie('TOKEN',null);
		include  CURR_VIEW_PATH . "Service/home.orderlist.php";
    }
    /**
     * 订单批量操作
     */
    public function orderBatchAction(){
		$batch    = ChkSQL(KS_G('post.batch'));
		$orderids = ChkSQL(KS_G('post.orderid'));
		if($batch==1)
		{
			$order_info = M('common_order');
            $order_apps = M('common_order_info');
			foreach($orderids as $k=>$v){
				$order_info->delete("orderid=".ChkClng($v));
		        $order_apps->delete("orderid=".ChkClng($v));
			}
			ks_header(M_URL('Service','orderList'));
		}else{
			foreach($appids as $k=>$v){
                $applist[$k] = $this->cache->GetA('appinfo','appid',$v,'',true);
            }
			include  CURR_VIEW_PATH . "Service/home.confirmService.php";
        }
    }
    /**
     * 删除订单
     */
    public function delOrderAction(){
	    $now_page = ChkClng(KS_S('p'));
		$orderid  = ChkClng(KS_G('request.id'));
		$order_info = M('common_order');
		$order_apps = M('common_order_info');
		$order_info->delete("orderid=$orderid");
		$order_apps->delete("orderid=$orderid");
		ks_header(M_URL('Service','orderList','',GP('p-'.$now_page)));
    }
    /**
     * 订单来的立刻购买
     */
    public function buyNowAction(){
		$orderid    = ChkClng(KS_G('request.id'));
		$Pays       = null !==GF('Pays') ? GF('Pays'):'';
		$order_apps = M('common_order_info');
		$appids     = $order_apps->getAll("where orderid=$orderid",'appid');
		foreach($appids as $k=>$v){
            $applist[$k] = $this->cache->GetA('appinfo','appid',$v['appid'],'',true);
            if (empty($applist[$k])){  //无效APP，删除
                unset($applist[$k]);
            }
            if (wx_checkappisallow($v['appid'],$this->wxid)){
                $app=$this->cache->GetA('appinfo','appid',$v['appid'],'',true);
                KS_Alert('您使用的套餐可以免费使用【'.$app['appname'].'】,将跳转到APP中心开通！','error',M_URL('Shop','index','',GP('option-0,appid-'.$v['appid'])));
            }
		}
        if (count($applist)<=0){
            KS_Alert('请选择购买的APP应用','error',KS_ComeUrl());
        }
	    $numb       = ChkClng(KS_G('request.numb'))!=0 ?  ChkClng(KS_G('request.numb')) : 1;
        if ($numb<=0){
            KS_Alert('购买数量必须大于0','error',KS_ComeUrl());
        }
	    $sumMoney   = 0;
	    $order = M('common_order')->getRow('where orderid='.$orderid);
	    $allye =  $order['taskreward'];
	    $usersModel = M('common_user');
	    $Money      = getWxinfo($this->wxid,'money');
	    //防止重复提交 如果重复提交跳转至相关页面
		if(cookie('TOKEN')!==null){
		    cookie('TOKEN',null);
			ks_header(M_URL('Service','orderList'));
		}
		$payconfig = $this->cache->GetACache('payconfig');//取出缓存
		include  CURR_VIEW_PATH . "Service/home.confirmService.php";
    }
    /*****************************************************我的订单 end ****************************************************/









    /******************************************************我的应用 begin **************************************************/
    /**
     * 我的应用管理中心
     */
	public function myappAction(){
		$appuserrelate = M('Application/IndexModel/common_app_userrelate');
		$options       = $appuserrelate->getappOptions('300');
		$page          = Page($options);
		$values        = $appuserrelate->getappPage($page);
        foreach($values as $k=>$v){
            switch ($v['appid']){
                case 3:$model             = M('common_user');
                    $values[$k]['count']      = $model->getOne('count(1)',"where wxid=$this->wxid and usertype = 0 ");
                    $time                     = strtotime(date('Y-m-d',time()));
                    $values[$k]['todaycount'] = $model->getOne('count(1)',"where wxid=$this->wxid and usertype = 0 and regdate > $time");break;
                case 6:$teacherModel      = M('app_'.$v['tableename'].'');
                    $values[$k]['count']      = $teacherModel->getOne('count(1)',"where wxid=$this->wxid");
                    $time                     = strtotime(date('Y-m-d',time()));
                    $values[$k]['todaycount'] = $teacherModel->getOne('count(1)',"where wxid=$this->wxid and adddate > $time");
                    $values[$k]['status0']    = $teacherModel->getOne('count(1)',"where wxid=$this->wxid and status = 0");break;
                case 11:$model            = M('common_user');
                    $values[$k]['count']      = $model->getOne('count(1)',"where wxid=$this->wxid and usertype = 1 ");
                    $time                     = strtotime(date('Y-m-d',time()));
                    $values[$k]['todaycount'] = $model->getOne('count(1)',"where wxid=$this->wxid and usertype = 1 and regdate > $time");break;
                case 10:$model            = M('app_'.$v['tableename'].'');
                    $values[$k]['count']      = $model->getOne('count(1)',"where wxid=$this->wxid ");
                    $time                     = strtotime(date('Y-m-d',time()));
                    $values[$k]['status0']    = $model->getOne('count(1)',"where wxid=$this->wxid and status = 0");break;
                case 100:$model           = M('app_'.$v['tableename'].'');
                    $values[$k]['count']      = $model->getOne('count(1)',"where wxid=$this->wxid ");
                    $time                     = strtotime(date('Y-m-d',time()));
                    $values[$k]['todaycount'] = $model->getOne('count(1)',"where wxid=$this->wxid and adddate > $time");
                    $values[$k]['status0']    = $model->getOne('count(1)',"where wxid=$this->wxid and status = 0");break;
                case 101:$model           = M('app_'.$v['tableename'].'');
                    $values[$k]['count']      = $model->getOne('count(1)',"where wxid=$this->wxid ");
                    $time                     = strtotime(date('Y-m-d',time()));
                    $values[$k]['todaycount'] = $model->getOne('count(1)',"where wxid=$this->wxid and adddate > $time");
                    $values[$k]['status0']    = $model->getOne('count(1)',"where wxid=$this->wxid and status = 0");break;
            }
		}
		$recommend     = $appuserrelate->getremycommend();
		$appcategory   = $this->cache->GetA('appcategory','parentid',0);//读取缓存
	    include  CURR_VIEW_PATH . "Service/home.myapp.php";
    }
    /******************************************************我的应用 end **************************************************/













}

