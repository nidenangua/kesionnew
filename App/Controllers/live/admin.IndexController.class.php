
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
	public function indexAction(){
//      $flow = M('app_dayflow');
		$website = M('common_user_website');
		$domain = M('common_domain');
		$keytype=ChkClng(GF('keytype') ? GF('keytype'):'1');
		$keyword=ChkSQL(GF('keyword') ? GF('keyword'):'00');
//		var_dump($keyword);
//		include  CURR_VIEW_PATH . "index.php";
//		exit;
//		$type=ChkClng(GF('type') ? GF('type'):1);
		$webid       = null !==GF('webid') ? GF('webid'):'1';
	    $sumlivemoney        = null !==GF('sumlivemoney') ? GF('sumlivemoney'):'1';
	    $sumconcurrent        = null !==GF('sumconcurrent') ? GF('sumconcurrent'):'1';
	    $orderby[GN('sumconcurrent')]         = 'sumlivemoney/a.sumconcurrent';
	    $orderby[GN('sumlivemoney')]         = 'sumlivemoney/a.sumlivemoney';
	    $orderby[GN('webid')]       = 'webid/a.wxid';
//	 	if($type==1){ $where= ' where a.type=2 and a.status=0';}
//	 	if($type==4){ $where= ' where a.status=-1';}
        $where =' as a  left join '.$website->table.' as b on a.wxid=b.wxid ';
		if($keytype==1&& $keyword!='00'){
			$where="$where and b.sitename like '%$keyword%'";
		}else if($keytype==2 && $keyword!='00'){
			$where="$where and b.wxid=".$keyword;
		}
//		$where = "as a left join `$user->table` as b on a.userid = b.userid $where";
		$now_page =  ChkClng(KS_S('p',1));
		$options = $domain->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$infoary = $domain->getPage($page,OB($orderby),$where,'a.wxid,b.sitename,a.sumlivemoney,a.sumconcurrent');
		// var_dump('ddd');
        include  CURR_VIEW_PATH . "index.php";
     }
	 /*
	  * 连麦币购买记录
	  */
	 public function serviceRecordAction(){
	 	 $adddate        = null !==GF('adddate') ? GF('adddate'):'1';
	      $numb        = null !==GF('numb') ? GF('numb'):'1';
	      $orderby[GN('numb')]         = 'numb/b.numb';
	      $orderby[GN('adddate')]         = 'adddate/a.adddate';
	 	  $wxid=ChkClng(GF('wxid'));
 	  	   $order=M('common_order');
	 	   $orderInfo=M('common_order_info');
	 	   $where =' as a  left join '.$orderInfo->table.' as b on a.orderid=b.orderid  where  a.wxid ='.$wxid.'  and a.paystatus=1 and b.appid=5';
           $options   = $order->getOptions('10',$where);//分页参数设置
		   $page      = Page($options);
		   $values    = $order->getPage($page,OB($orderby),$where,'b.id,a.orderid,a.original_amount,a.order_amount,a.adddate,a.ordersn,b.numb,b.appname,b.appid,b.price,b.market_price');
         include  CURR_VIEW_PATH . "record.php";
	 }
	 /*
	  * 导出购买记录
	  */
     public function buyexcelAction(){
//  	$type=ChkClng(GF('type') ? GF('type'):1);
		$paperid = ChkClng(null !==KS_G('post.outtime')? KS_G('post.outtime'):'1');
        $adddate        = null !==GF('adddate') ? GF('adddate'):'1';
	      $numb        = null !==GF('numb') ? GF('numb'):'1';
	      $orderby[GN('numb')]         = 'numb/b.numb';
	      $orderby[GN('adddate')]         = 'adddate/a.adddate';
		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
	       $wxid=ChkClng(GF('wxid'));
	       $websiteModel=M('common_user_website');
	  	    $name=$websiteModel->getOne('sitename','where wxid='.$wxid);
 	  	   $order=M('common_order');
	 	   $orderInfo=M('common_order_info');
	 	   $where =' as a  left join '.$orderInfo->table.' as b on a.orderid=b.orderid  where  a.wxid ='.$wxid.'  and a.paystatus=1 and b.appid=5';
		if($paperid==1){
			$options   = $order->getOptions('10',$where);//分页参数设置
		   $page      = Page($options);
		   $infoary    = $order->getPage($page,OB($orderby),$where,'a.adddate,a.ordersn,b.numb,b.appname,b.price,b.market_price');
		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $order->getAll($where,'a.adddate,a.ordersn,b.numb,b.appname,b.price,b.market_price');
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $order->getAll($where,'a.adddate,a.ordersn,b.numb,b.appname,b.price,b.market_price');
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and a.adddate > '.$strtime.' and a.adddate < '.$endtime;
			$infoary = $order->getAll($where,'a.adddate,a.ordersn,b.numb,b.appname,b.price,b.market_price');
		}
		 foreach($infoary as $key =>$val){
		 	$infoary[$key]['adddate']=date('Y-m-d H:i:s',$val['adddate']);
		 }
//		 var_dump($infoary);exit;
		$xlsName     = $name.'的连麦币购买记录';//文件名
		$textRun     = $xlsName;//表名
		foreach($infoary as $k=>$v){$infoary[$k]['number'] = $k+1;}
		$xlsCell  = array(
			array('number','序号'),
			array('ordersn','订单号'),
			array('numb','购买数量'),
			array('appname','订单内容'),
			array('market_price','单价价格'),
			array('price','实际支付'),
			array('adddate','下单日期'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}
	 /*
	  * 连麦币消费记录
	  */
	 public function consumptionRecordAction(){
		 	$starttime       = null !==GF('starttime') ? GF('starttime'):'1';
		    $time        = null !==GF('time') ? GF('time'):'1';
		    $orderby[GN('starttime')]         = 'starttime/starttime';
		    $orderby[GN('time')]         = 'time/time';
	 	    $wxid=ChkClng(GF('wxid'));
	 	    $livelog=M('common_live_log');
	 	    $where =' where wxid='.$wxid.' and status =2 and classlevel !=0';
            $options   = $livelog->getOptions('10',$where);//分页参数设置
		    $page      = Page($options);
		    $values    = $livelog->getPage($page,OB($orderby),$where,'');
		    $classModel=M('app_course');
		    foreach($values as $k=>$v){
		    	$values[$k]['title']=$classModel->getOne('title',' where courseid ='.$v['infoid'].' limit 1 ');
		    }
//	        var_dump($values);
		 include  CURR_VIEW_PATH . "costRecord.php";
	 }
	 /*
	  * 学生连麦情况
	  */
	 public function wheatisAction(){
	 	    $wxid=ChkClng(GF('wxid'));
	 	    $start       = null !==GF('start') ? GF('start'):'desc';
	 	    $logid   = ChkClng(KS_G('request.id'));
	 	    $livelogModel=M('common_live_log');
	 	    $livelog =$livelogModel->getRow('where id ='.$logid.' limit 1');
	 	    $liveModel=M('app_live_list');
	 	    $live=$liveModel->getRow(' where id='.$livelog['channlid'].' limit 1');
	 	    $studentModel=M($live['studentTable']);
	 	    $memberModel=M('common_user_member');
	 	    $where=' where wxid='.$wxid.' and  logid='.$logid;
	        $options   = $studentModel->getOptions('10',$where);//分页参数设置
		    $page      = Page($options);
		    $values    = $studentModel->getPage($page,'starttime '.$start,$where);
		    foreach($values as $k=>$v){
		    	$values[$k]['membername']=$memberModel->getOne('name','where userid='.$v['memberid']);
		    }

		 include  CURR_VIEW_PATH."wheatis.php";
	 }
     /*
      * 导出具体的学生消耗记录数据
      */
      public function studentexcelAction(){
//  	$type=ChkClng(GF('type') ? GF('type'):1);
		$paperid = ChkClng(null !==KS_G('post.outtime')? KS_G('post.outtime'):'1');
        $start       = null !==GF('start') ? GF('start'):'desc';

		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
	        $wxid=ChkClng(GF('wxid'));
	  	    $websiteModel=M('common_user_website');
	  	    $name=$websiteModel->getOne('sitename','where wxid='.$wxid);
	 	    $logid   = ChkClng(GF('id'));
	 	    $livelogModel=M('common_live_log');
	 	    $livelog =$livelogModel->getRow('where id ='.$logid.' limit 1');
	 	    $liveModel=M('app_live_list');
	 	    $live=$liveModel->getRow(' where id='.$livelog['channlid'].' limit 1');
	 	    $studentModel=M($live['studentTable']);
	 	    $memberModel=M('common_user_member');
	 	    $where=' where wxid='.$wxid.' and  logid='.$logid;
		if($paperid==1){
			$options   = $studentModel->getOptions('10',$where);//分页参数设置
		    $page      = Page($options);
		    $infoary    = $studentModel->getPage($page,'starttime '.$start,$where,'memberid,starttime,endtime');
		    foreach($infoary as $k=>$v){
		    	$infoary[$k]['membername']=$memberModel->getOne('name','where userid='.$v['memberid']);
		    }
		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and starttime > '.$strtime;
			$infoary = $studentModel->getAll($where,'memberid,starttime,endtime');
			foreach($values as $k=>$v){
		    	$values[$k]['membername']=$memberModel->getOne('name','where userid='.$v['memberid']);
		    }
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and starttime > '.$strtime;
			$infoary = $studentModel->getAll($where,'memberid,starttime,endtime');
			foreach($values as $k=>$v){
		    	$values[$k]['membername']=$memberModel->getOne('name','where userid='.$v['memberid']);
		    }
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and starttime > '.$strtime.' and starttime < '.$endtime;
			$infoary = $studentModel->getAll($where,'memberid,starttime,endtime');
			foreach($values as $k=>$v){
		    	$values[$k]['membername']=$memberModel->getOne('name','where userid='.$v['memberid']);
		    }
		}
		 foreach($infoary as $key =>$val){
		 	$infoary[$key]['cost'] =$val['endtime']-$val['starttime'];
		 	$infoary[$key]['starttime']=date('Y-m-d H:i:s',$val['starttime']);
		 	$infoary[$key]['endtime']=date('Y-m-d H:i:s',$val['endtime']);

		 }
//		 var_dump($infoary);exit;
		$xlsName     = $name.'的连麦币具体使用记录';//文件名
		$textRun     = $xlsName;//表名
		foreach($infoary as $k=>$v){$infoary[$k]['number'] = $k+1;}
		$xlsCell  = array(
			array('number','序号'),
			array('membername','使用人'),
			array('starttime','开始时间'),
			array('endtime','结束时间'),
			array('cost','时长'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}

     /*
      * 导出花费数据
      */
      public function costexcelAction(){
//  	$type=ChkClng(GF('type') ? GF('type'):1);
		$paperid = ChkClng(null !==KS_G('post.outtime')? KS_G('post.outtime'):'1');
            $starttime       = null !==GF('starttime') ? GF('starttime'):'1';
		    $time        = null !==GF('time') ? GF('time'):'1';
		    $orderby[GN('starttime')]         = 'starttime/starttime';
		    $orderby[GN('time')]         = 'time/time';
		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
	        $wxid=ChkClng(GF('wxid'));
	  	    $livelog=M('common_live_log');
	  	    $classModel=M('app_course');
	  	    $websiteModel=M('common_user_website');
	  	    $name=$websiteModel->getOne('sitename','where wxid='.$wxid);
	 	    $where =' where wxid='.$wxid.' and status =2 and classlevel !=0';
		if($paperid==1){
			$options = $livelog->getOptions('10',$where);//分页参数设置
		    $page = Page($options);
			$infoary = $livelog->getPage($page,OB($orderby),$where,'infoid,classlevel,time,cost,starttime,endtime');

		    foreach($infoary as $k=>$v){
		    	$infoary[$k]['title']=$classModel->getOne('title',' where courseid ='.$v['infoid'].' limit 1 ');
		    }
		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and starttime > '.$strtime;
			$infoary = $livelog->getAll($where,'infoid,classlevel,time,cost,starttime,endtime');
			foreach($infoary as $k=>$v){
		    	$infoary[$k]['title']=$classModel->getOne('title',' where courseid ='.$v['infoid'].' limit 1 ');
		    }
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and starttime > '.$strtime;
			$infoary = $livelog->getAll($where,'infoid,classlevel,time,cost,starttime,endtime');
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and starttime > '.$strtime.' and starttime < '.$endtime;
			$infoary = $livelog->getAll($where,'infoid,classlevel,time,cost,starttime,endtime');
			foreach($infoary as $k=>$v){
		    	$infoary[$k]['title']=$classModel->getOne('title',' where courseid ='.$v['infoid'].' limit 1 ');
		    }
		}
		 foreach($infoary as $key =>$val){
		 	if($val['classlevel']==1){
		 		$infoary[$key]['classlevel']='小班';
		 	}elseif($val['classlevel']==2){
		 		$infoary[$key]['classlevel']='一对一';
		 	}
		 	$infoary[$key]['starttime']=date('Y-m-d H:i:s',$val['starttime']);
		 	$infoary[$key]['endtime']=date('Y-m-d H:i:s',$val['endtime']);
		 }
//		 var_dump($infoary);exit;
		$xlsName     = $name.'的连麦币消费记录';//文件名
		$textRun     = $xlsName;//表名
		foreach($infoary as $k=>$v){$infoary[$k]['number'] = $k+1;}
		$xlsCell  = array(
			array('number','序号'),
			array('classlevel','类型'),
			array('title','班级或者类型'),
			array('time','总时长'),
			array('cost','花费'),
			array('starttime','开始时间'),
			array('endtime','结束时间'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}
	/*
	 * 显示直播并发的订单管理
	 */
	public function showSuperveneAction(){
		$adddate        = null !==GF('adddate') ? GF('adddate'):'1';
	    $numb        = null !==GF('numb') ? GF('numb'):'1';
	    $orderby[GN('numb')]         = 'numb/b.numb';
	    $orderby[GN('adddate')]         = 'adddate/a.adddate';
 		$wxid=ChkClng(GF('wxid'));
// 		var_dump($wxid);
    	$type=ChkClng(GF('stype') ? GF('stype'):3);
		$order  =  M('common_order');
		$orderModel     =  M('common_order_info');
		if($type==3){ $where= ' where 1=1';}
		elseif($type==1){
			$where= 'where endtime<'.time();
		}elseif($type==2){
			$where= 'where endtime>'.time();
		}
		$where =$where.' and a.wxid='.$wxid;
	 	$where =  $where .' and b.appid=6 and a.paystatus=1';
		$where = "as a left join `$orderModel->table` as b on a.orderid = b.orderid $where";
		$options   = $order->getOptions('8',$where);//分页参数设置
		$page      = Page($options);
		$value    = $order->getPage($page,OB($orderby),$where,'a.orderid,a.ordersn,a.adddate,b.appname,b.numb,b.summarket,b.sumprice,b.price,b.market_price,b.starttime,b.endtime');
        include  CURR_VIEW_PATH . "supervene_manage.php";
	}
	/*
	 * 导出直播并发的数据
	 */
	public function superveneExcelAction(){
		$adddate        = null !==GF('adddate') ? GF('adddate'):'1';
	    $numb        = null !==GF('numb') ? GF('numb'):'1';
	    $orderby[GN('numb')]         = 'numb/b.numb';
	    $orderby[GN('adddate')]         = 'adddate/a.adddate';
		$wxid=ChkClng(GF('wxid'));
    	$type=ChkClng(GF('stype') ? GF('stype'):3);
		$orderModel  =  M('common_order_info');
		$website     =  M('common_user_website');
		$Model    =  M('common_order');
		if($type==3){ $where= ' where 1=1';}
		elseif($type==1){
			$where= 'where endtime<'.time();
		}elseif($type==2){
			$where= 'where endtime>'.time();
		}
		$where =$where.' and a.wxid='.$wxid;
	 	$where =  $where .' and b.appid=6 and a.paystatus=1';
		$where = "as a left join `$orderModel->table` as b on a.orderid = b.orderid $where";
		$paperid = ChkClng(null !==KS_G('post.outtime')? KS_G('post.outtime'):'1');
		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
		if($paperid==1){
			$options = $Model->getOptions('8',$where);//分页参数设置
		    $page = Page($options);
			$infoary = $Model->getPage($page,OB($orderby),$where,'a.orderid,a.ordersn,a.adddate,b.appname,b.numb,b.summarket,b.sumprice,b.price,b.market_price,b.starttime,b.endtime');

		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and adddate > '.$strtime;
			$infoary = $Model->getAll($where,'a.id,a.orderid,a.ordersn,a.adddate,b.appname,b.numb,b.summarket,b.sumprice,b.price,b.market_price,b.starttime,b.endtime');
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$infoary = $Model->getAll($where,'a.id,a.orderid,a.ordersn,a.adddate,b.appname,b.numb,b.summarket,b.sumprice,b.price,b.market_price,b.starttime,b.endtime');
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and adddate > '.$strtime.' and adddate < '.$endtime;
			$infoary = $Model->getAll($where,'a.id,a.orderid,a.ordersn,a.adddate,b.appname,b.numb,b.summarket,b.sumprice,b.price,b.market_price,b.starttime,b.endtime');
		}
		$websiteModel=M('common_user_website');
	  	    $name=$websiteModel->getOne('sitename','where wxid='.$wxid);
		$xlsName     = $name.'购买直播并发情况';//文件名
		$textRun     = $xlsName;//表名
		foreach($infoary as $k=>$v){$infoary[$k]['number'] = $k+1;
		$infoary[$k]['adddate'] = date('Y-m-d H:i:s',$v['adddate']);
		$infoary[$k]['validTime'] = date('Y/m/d',$v['starttime']).'-'.date('Y/m/d',$v['endtime']);
		}
		$xlsCell  = array(
			array('number','序号'),
			array('ordersn','订单号'),
			array('sitename','网校名称'),
			array('appname','购买内容'),
			array('numb','购买数量'),
			array('market_price','原单价'),
			array('sumprice','实际支付金额'),
			array('price','实际支付单价'),
			array('validTime','有效期'),
			array('adddate','下单日期'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}
	/*
	 * 单个删除并发订单
	 */
	public function singledeleteAction(){
		$orderinfoModel  =  M('common_order_info');
		$livelog=M('common_live_log');
		$orderModel  =  M('common_order');
		$type       =  ChkClng(GF('type'));
		$id=ChkClng(KS_G('request.id'));
		if($type==1){
			$Data['paystatus'] =  -1;
    	    $res            =  $orderinfoModel->update($Data,'id="'.$id.'"');
		}elseif($type==2){
            $orderid=ChkClng(KS_G('request.orderid'));
			$Data['paystatus'] =  -1;
    	    $res            =  $orderModel->update($Data,'orderid='.$orderid);
		}elseif($type==3){
			$Data['status'] =  -1;
    	    $res            =  $livelog->update($Data,'id='.$id);
		}elseif($type==4){
			$Data['status'] =  -1;
    	    $res            =  $livelog->update($Data,'id='.$id);
		}


		$now_page       =  ChkClng(KS_S('p',1));
		$url            =  M_URL($this->AppName.'/Index','showSupervene','',GP('p-'.$now_page));
		ks_header($url);

	}
	/*
	 * 批量删除并发订单
	 */
    public function deletepartAction(){
    	$orderModel  =  M('common_order_info');
    	$idAry          = ChkSQL(KS_G('post.id'));
//  	var_dump($idAry);
//  	exit;
    	$Data['paystatus'] = -1;
    	foreach($idAry as $key =>$val){
    	  $res          =  $orderModel->update($Data,'id = '.$val);
    	}
		$now_page       =  ChkClng(KS_S('p',1));
		$url            =  M_URL($this->AppName.'/Index','showSupervene','',GP('p-'.$now_page));
		KS_INFO("批量操作成功",0,$url);
    }
	 	//直播计算
	public function settledFlowAction(){

		$userModel = M('common_user');
		$voucherModel = M('common_voucher');
		$liveModel = M('app_live');
		$livelistModel = M('app_live_list');
		$playLog = M('common_pay_log');
		$dateflowModel = M('app_dayflow');
		$lives =$liveModel -> getAll();
		$time=time();
		$site = $this->cache->GetACache('setting');//读出缓存
		foreach($lives as $k=>$v){
			$baidu = new Baidulive($v['domain']);
			$livelist = $livelistModel -> getAll('where userid = '.$v['userid']);
			$Unsettled=0;//要结算流量；
			$allflow=0;//总流量;
			foreach($livelist as $kt=>$vt){
				try{

					$aa = $baidu->selectStreamDate($vt['stream']);
					$Unsettled+= round(($aa->aggregate->downstreamInByte)/1024/1024,2)-$vt['SettledFlow'];
					$Data['flow']=$Data['SettledFlow'] = round($aa->aggregate->downstreamInByte/1024/1024,2);
					$allflow+=$Data['flow'];
					$Data['playcount'] = $aa->aggregate->playCount;
					$Data['SelledDate'] = time();
					$livelistModel->update($Data,'id='.$vt['id']);

				}catch(Exception $e){

				}
			}
			//更新 app_live数据
			$Data1['number'] =count($lives);
			$Data1['flow'] = $allflow;
			$Data1['SettledFlow'] = $allflow;
			$Data['settlementDate'] = $time;
			$liveModel->update($Data1,'id = '.$v['id']);
			//将付款写入common_pay_log
			 $spend = $Unsettled*$site['liveflowprice'];

			if($spend !=0){

				    $Date2['userid'] = $v['userid'];
					$Date2['appid'] = $this->userid;
					$Date2['adddate'] =$time;
					$Date2['cmoney'] = $spend ;
					$Date2['type'] = 2 ;
					$Date2['mark'] = '直播流量扣除'.$spend;

					$Date3['userid'] = $v['userid'];
					$Date3['type'] = 2;
					$Date3['flow'] =  $Unsettled;
					$Date3['spend'] = $spend;
					$Date3['adddate'] = $time;
					$Date3['countdate'] = date('Y-m-d',$time);
					$dateflowModel -> doAdd($Date3,'id');

					$voucher = $voucherModel -> getAll("where appid = $this->userid and balance > 0 and EndDate > $time and userid = $v[userid]");
					$a = 0;
					if($voucher){

						foreach($voucher as $ktt=>$vtt){

							if($vtt['balance']>$spend){
								$dae['balance']=$vtt['balance']-$spend;
								$a =$spend;
								$spend = 0;
								$dae['status'] = 0;

							}elseif($vtt['balance']=$spend){
								$dae['balance']=0;
								$dae['status'] = 1;
								$a =$spend;
								$spend = 0;

							}else{
								$dae['balance']=0;
								$dae['status'] = 1;
								$spend=$spend-floatval($vtt['balance']);
								$a =$spend+$a;

							}
							$voucherModel -> update($dae,'id ='.$vtt['id']);
						}

						$Date2['mark'] .='，其中代金券扣除'.$a;

					}
				   if($spend != 0){

						$da['money'] = "money - $spend" ;

						$userModel ->update($da,"userid = $v[userid]",1);
				   }
				   $playLog->doAdd($Date2,'id');
			}
		 $balance = $userModel->getOne('money','where userid = '.$v['userid']);//账户余额
		  if($balance<0){
			  $Date1['status'] = 2; //当欠费时 点播直播不能使用
		  }
		  $liveModel->update($Data1,'id = '.$v['id']);
		}

		$url=M_URL($this->AppName.'/Index','index','',GP(''));

		KS_INFO('结算成功',3,$url);

	}
//   public function indexAction(){
//      $flow = M('app_dayflow');
//		$user = M('common_user');
//		$keytype=ChkClng(GF('keytype') ? GF('keytype'):'1');
//		$keyword=ChkSQL(GF('keyword') ? GF('keyword'):'00');
//		$type=ChkClng(GF('type') ? GF('type'):1);
//		$now_page=ChkClng(GF('p') ? GF('p'):'1');
//		$byname = ChkSQL(GF('byname') ? GF('byname'):'desc');
//	 	if($type==1){ $where= ' where a.type=2 and a.status=0';}
//	 	if($type==4){ $where= ' where a.status=-1';}
//		if($keytype==1&& $keyword!='00'){
//			$where="$where and b.username like '%$keyword%'";
//		}else if($keytype==2 && $keyword!='00'){
//			$where="$where and a.wxid=".$keyword;
//		}
//		$where = "as a left join `$user->table` as b on a.userid = b.userid $where";
//		$now_page =  ChkClng(KS_S('p',1));
//		$options = $flow->getOptions('10',$where);//分页参数设置
//		$page = Page($options);
//		$infoary = $flow->getPage($page,'adddate '.$byname,$where,'a.id,b.username,a.flow,a.adddate,a.wxid');
//
//      include  CURR_VIEW_PATH . "index.php";
//   }


}
?>