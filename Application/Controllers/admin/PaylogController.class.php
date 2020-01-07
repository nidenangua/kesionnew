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
class PaylogController extends CommonController
{
	public function indexAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$pay_log    = M('Application/PayModel/common_pay_log');
		$usersModel = M('Application/PayModel/common_user');
		$sitenameModel = M('Application/PayModel/common_user_website');
		$where      = "as a left join `$usersModel->table` as b on a.userid = b.userid left join $sitenameModel->table as c on a.wxid=c.wxid where a.cmoney!=0";
		$keyword=KS_S('keyword');
		$keytype=KS_S('keytype',1);
		$status=KS_S('status',3);
		$byname=null !==GF('byname') ? GF('byname'):'a.id desc';//排序

		if(!empty($keyword)){
			if($keytype==1){$where.=" and b.username like '%$keyword%'";}
			if($keytype==2){$where.=" and a.wxid=$keyword";}
			if($keytype==3){$where.=" and c.sitename like '%$keyword%'";}
		}

		//$allcomoney = $pay_log->getOne('sum(a.cmoney)',$where);
		$successcomoney = $pay_log->getOne('sum(a.cmoney)',$where.' and a.type=1');  //支出
		$outmoney = $pay_log->getOne('sum(a.cmoney)',$where.' and a.type=0');    //收入

		$allcomoney = $pay_log->getOne('sum(a.cmoney)',$where.' and a.type=1  and a.linepaytype!=0');


		if($status==3){ $where.= ' and (a.type=1 or a.type=0)';}
		if($status==1){ $where.= ' and a.type=1';}
		if($status==0){ $where.= ' and a.type=0';}

		$options    = $pay_log->getOptions('10',$where);
		$page       = Page($options);
		$pagelogs   = $pay_log->getPage($page,$byname,$where,'a.*,b.username,c.sitename');
		include  CURR_VIEW_PATH . "Paylog/admin.paylog.php";
	}
	public function delectAction(){
		$NewsModel = new NewsModel('app_news');
		$NewsModel ->delete('newsid='.KS_G('get.id'));
		KS_INFO("删除成功");
	}
	//平台消费明细列表
	public function excelAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$pay_log    = M('Application/PayModel/common_pay_log');
		$usersModel = M('Application/PayModel/common_user');
		$sitenameModel = M('Application/PayModel/common_user_website');
		$where      = "as a left join `$usersModel->table` as b on a.userid = b.userid left join $sitenameModel->table as c on a.wxid=c.wxid where a.cmoney!=0";
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		$status=KS_S('status',3);

		$byname=null !==GF('byname') ? GF('byname'):'a.id desc';//排序
		$paperid = ChkClng(KS_G('post.outtime'));
		if(empty($paperid)){
			$url=M_URL('home/Paylog','index','',GP('p-'.$now_page));
			KS_INFO("请选择导出的类型",0,$url);
		}
		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
		if($status==3){ $where.= ' and (a.type=1 or a.type=0)';}
		if($status==1){ $where.= ' and a.type=1';}
		if($status==0){ $where.= ' and a.type=0';}
		if(!empty($keyword)){
			if($keytype==1){$where.=" and b.username like '%$keyword%'";}
			if($keytype==2){$where.=" and a.wxid=$keyword";}
			if($keytype==3){$where.=" and c.sitename like '%$keyword%'";}
		}
		if($paperid==1){
			$options = $pay_log->getOptions('10',$where);//分页参数设置
			$page = Page($options);
			$infoary = $pay_log->getPage($page,$byname,$where,'a.*,b.username,c.sitename');

		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $pay_log->getAll($where.' order by '.$byname,'a.*,b.username,c.sitename');
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $pay_log->getAll($where.' order by '.$byname,'a.*,b.username,c.sitename');
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and a.adddate > '.$strtime.' and a.adddate < '.$endtime;
			$infoary = $pay_log->getAll($where.' order by '.$byname,'a.*,b.username,c.sitename');
		}
		foreach($infoary as $key =>$val){
			$infoary[$key]['number'] = $key+1;
			date_default_timezone_set("PRC");
			$infoary[$key]['adddate']=date('Y-m-d H:i:s',$val['adddate']);
			if($val['type']==1){
				$infoary[$key]['type'] = '支出';
			}else{
				$infoary[$key]['type'] = '收入';
			}
			if($val['linepaytype']==0){$infoary[$key]['linepaytype']= '后台充值';}elseif($val['linepaytype']==1){$infoary[$key]['linepaytype']=  '支付宝支付';}elseif($val['linepaytype']==2){$infoary[$key]['linepaytype']=  '微信支付';}
		}
		$xlsName     = '平台消费明细列表';//文件名
		$textRun     = $xlsName;//表名
		$xlsCell  = array(
			array('number','序号'),
			array('wxid','网校ID'),
			array('sitename','网校名称'),
			array('username','用户账号'),
			array('type','类型'),
			array('cmoney','数值'),
			array('linepaytype','支付方式'),
			array('balance','余额'),
			array('adddate','消费时间'),
			array('userip','使用的ip地址'),
			array('mark','备注'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}
	//网校流水记录
	public function wxpaylogAction(){
		$now_page      =  ChkClng(KS_S('p',1));
		$pay_log       = M('Application/PayModel/app_pay_log');
		$usersModel    = M('Application/PayModel/common_user_member');
		$sitenameModel = M('Application/PayModel/common_user_website');
		$where         = "as a left join `$usersModel->table` as b on a.memberid = b.userid left join $sitenameModel->table as c on a.wxid=c.wxid where a.cmoney!=0 and a.linepaytype!=0";
		$keyword       = KS_S('keyword');
		$keytype       = KS_S('keytype',1);
		$status        = KS_S('status',3);
		$byname        = null !==GF('byname') ? GF('byname'):'a.id desc';//排序
		if(!empty($keyword)){
			if($keytype==1){$where.=" and b.name like '%$keyword%'";}
			if($keytype==2){$where.=" and a.wxid=$keyword";}
			if($keytype==3){$where.=" and c.sitename like '%$keyword%'";}
		}
		$allcomoney = $pay_log->getOne('sum(a.cmoney)',$where);
		$successcomoney = $pay_log->getOne('sum(a.cmoney)',$where.' and a.type=1');
		$outmoney = $pay_log->getOne('sum(a.cmoney)',$where.' and a.type=0');

		if($status==3){ $where.= ' and (a.type=1 or a.type=0)';}
		if($status==1){ $where.= ' and a.type=1';}
		if($status==0){ $where.= ' and a.type=0';}

		$options    = $pay_log->getOptions('10',$where);
		$page       = Page($options);
		$pagelogs   = $pay_log->getPage($page,$byname,$where,'a.*,b.name as username,c.sitename');
		include  CURR_VIEW_PATH . "Paylog/wxpay_log.php";
	}
	//网校流水导出
	public function wxpaylogexcelAction(){
		$now_page =  ChkClng(KS_S('p',1));
//		var_dump($now_page);die;
		$pay_log    = M('Application/PayModel/app_pay_log');
		$usersModel    = M('Application/PayModel/common_user_member');
		$sitenameModel = M('Application/PayModel/common_user_website');
		$where         = "as a left join `$usersModel->table` as b on a.memberid = b.userid left join $sitenameModel->table as c on a.wxid=c.wxid where a.cmoney!=0 and a.linepaytype!=0";
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		$status=KS_S('status',3);
		$byname=null !==GF('byname') ? GF('byname'):'a.id desc';//排序
		$paperid = ChkClng(KS_G('post.outtime'));

		if(empty($paperid)){
			$url=M_URL('home/Paylog','index','',GP('p-'.$now_page));
			KS_INFO("请选择导出的类型",0,$url);
		}
		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
		if($status==3){ $where.= ' and (a.type=1 or a.type=0)';}
		if($status==1){ $where.= ' and a.type=1';}
		if($status==0){ $where.= ' and a.type=0';}
		if(!empty($keyword)){
			if($keytype==1){$where.=" and b.name like '%$keyword%'";}
			if($keytype==2){$where.=" and a.wxid=$keyword";}
			if($keytype==3){$where.=" and c.sitename like '%$keyword%'";}
		}
		if($paperid==1){
			$options = $pay_log->getOptions('10',$where);//分页参数设置
			$options['now_page'] = $now_page;
			$page = Page($options);
			$infoary = $pay_log->getPage($page,$byname,$where,'a.*,b.name as username,c.sitename');
		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $pay_log->getAll($where.' order by '.$byname,'a.*,b.name as username,c.sitename');
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $pay_log->getAll($where.' order by '.$byname,'a.*,b.name as username,c.sitename');
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and a.adddate > '.$strtime.' and a.adddate < '.$endtime;
			$infoary = $pay_log->getAll($where.' order by '.$byname,'a.*,b.name as username,c.sitename');
		}
		foreach($infoary as $key =>$val){
			$infoary[$key]['number'] = $key+1;
			date_default_timezone_set("PRC");
			$infoary[$key]['adddate']=date('Y-m-d H:i:s',$val['adddate']);
			if($val['type']==1){
				$infoary[$key]['type'] = '支出';
			}else{
				$infoary[$key]['type'] = '收入';
			}
			if($val['linepaytype']==0){
				$infoary[$key]['linepaytype']= '后台充值';
			}elseif($val['linepaytype']==1){
				$infoary[$key]['linepaytype']=  '支付宝支付';
			}elseif($val['linepaytype']==2){
				$infoary[$key]['linepaytype']=  '微信支付';
			}
		}

		$xlsName     = '网校消费明细列表';//文件名
		$textRun     = $xlsName;//表名
		$xlsCell  = array(
			array('number','序号'),
			array('wxid','网校ID'),
			array('sitename','网校名称'),
			array('username','用户名'),
			array('type','类型'),
			array('cmoney','数值'),
			array('linepaytype','支付方式'),
			array('balance','余额'),
			array('adddate','消费时间'),
			array('userip','使用的ip地址'),
			array('mark','备注'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}
	//直播币记录
	public function livecurrencyAction(){
		$order         = M('common_order');
		$orderInfo     = M('common_order_info');

		$sitenameModel = M('common_user_website');

		$where         = ' as a  left join '.$orderInfo->table.' as b on a.orderid=b.orderid 
		left join '.$sitenameModel->table.' as c on a.wxid=c.wxid 
		where a.type=2  and a.paystatus=1 and b.appid=5';




		$status        = KS_S('status',3);
		//if($status==3){ $where.= ' and (a.paystatus=1 or a.paystatus=0)';}
		if($status==1){ $where.= ' and a.order_amount!=0';}
		if($status==0){ $where.= ' and a.order_amount=0';}

		$keyword       = KS_S('keyword');
		$keytype       = KS_S('keytype',1);
		if(!empty($keyword)){
			if($keytype==1){$where.=" and a.ordersn like '%$keyword%'";}
			if($keytype==2){$where.=" and a.wxid=$keyword";}
			if($keytype==3){$where.=" and c.sitename like '%$keyword%'";}
		}
		$allmoney      = $order->getOne('sum(b.numb*b.market_price)',$where.' and a.paystatus=1');
		$songmoney     = $order->getOne('sum(b.numb*b.market_price)',$where.' and a.order_amount=0 and a.paystatus=1');

		$success       = $order->getOne('sum(a.order_amount)',$where.' and a.paystatus=1 and a.paytype!=0');
		//$success2      = $order->getOne('sum(b.numb*b.market_price)',$where.' and a.paystatus=1 and a.paytype=0');

		$outmoney      = $order->getOne('sum(a.order_amount)',$where.' and a.paystatus=0');
		$byname        = null !==GF('byname') ? GF('byname'):'a.orderid desc';//排序
		$options        = $order->getOptions('10',$where);//分页参数设置
		$page          = Page($options);
		$pagelogs      = $order->getPage($page,$byname,$where,'a.*,b.numb,b.appname,b.appid,b.price,b.starttime,b.endtime,b.market_price,c.sitename');
		include  CURR_VIEW_PATH . "Paylog/live_currency.php";
	}
	//直播币记录
	public function livecurrencyExcelAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$order         = M('common_order');
		$orderInfo     = M('common_order_info');

		$sitenameModel = M('common_user_website');

		$where         = ' as a  left join '.$orderInfo->table.' as b on a.orderid=b.orderid 
		left join '.$sitenameModel->table.' as c on a.wxid=c.wxid 
		where a.type=2  and a.paystatus=1 and b.appid=5';

		$status        = KS_S('status',3);
		//if($status==3){ $where.= ' and (a.paystatus=1 or a.paystatus=0)';}
		if($status==1){ $where.= ' and a.order_amount!=0';}
		if($status==0){ $where.= ' and a.order_amount=0';}

		$keyword       = KS_S('keyword');
		$keytype       = KS_S('keytype',1);
		if(!empty($keyword)){
			if($keytype==1){$where.=" and a.ordersn like '%$keyword%'";}
			if($keytype==2){$where.=" and a.wxid=$keyword";}
			if($keytype==3){$where.=" and c.sitename like '%$keyword%'";}
		}
		$paperid = ChkClng(KS_G('post.outtime'));
		if(empty($paperid)){
			$url=M_URL('home/Paylog','livecurrency','',GP('p-'.$now_page));
			KS_INFO("请选择导出的类型",0,$url);
		}
		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';

		$byname        = null !==GF('byname') ? GF('byname'):'a.orderid desc';//排序
		if($paperid==1){
			$options        = $order->getOptions('10',$where);//分页参数设置
			$page          = Page($options);
			$infoary      = $order->getPage($page,$byname,$where,'a.*,b.numb,b.appname,b.appid,b.price,b.starttime,b.endtime,b.market_price,c.sitename');

		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $order->getAll($where.' order by '.$byname,'a.*,b.numb,b.appname,b.appid,b.price,b.starttime,b.endtime,b.market_price,c.sitename');
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $pay_log->getAll($where.' order by '.$byname,'a.*,b.numb,b.appname,b.appid,b.price,b.starttime,b.endtime,b.market_price,c.sitename');
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and a.adddate > '.$strtime.' and a.adddate < '.$endtime;
			$infoary = $pay_log->getAll($where.' order by '.$byname,'a.*,b.numb,b.appname,b.appid,b.price,b.starttime,b.endtime,b.market_price,c.sitename');
		}
		foreach($infoary as $key =>$val){
			$infoary[$key]['number'] = $key+1;
			date_default_timezone_set("PRC");
			$infoary[$key]['adddate']=date('Y-m-d H:i:s',$val['adddate']);
			switch($val['appid']){case 1:$infoary[$key]['numb']= ($v['numb']*1000).'条';break;
				case 2:$infoary[$key]['numb']= ($v['numb']*1000).'封';break;
				case 3:$infoary[$key]['numb']= floor($val['numb']).'G';break;
				case 4:$infoary[$key]['numb']= floor($val['numb']).'G';break;
				case 6:$infoary[$key]['numb']= floor($val['numb']).'人';break;
				case 5:$infoary[$key]['numb']= floor($val['numb']).'个';break;
			}
			if($val['paytype']==0){$infoary[$key]['paytype']= '后台充值';}elseif($val['paytype']==1){$infoary[$key]['paytype']= '支付宝支付';}elseif($val['paytype']==2){$infoary[$key]['paytype']= '微信支付';}
			if($val['paytype']==0){
				$infoary[$key]['paytype']= '后台充值';
			}elseif($val['paytype']==1){
				$infoary[$key]['paytype']=  '支付宝支付';
			}elseif($val['paytype']==2){
				$infoary[$key]['paytype']=  '微信支付';
			}
			if($val['paystatus']==1){
				$infoary[$key]['paystatus']='已支付';
			}else{
				$infoary[$key]['paystatus']='未支付';
			}
		}
		$xlsName     = '连麦币购买记录列表';//文件名
		$textRun     = $xlsName;//表名
		$xlsCell  = array(
			array('number','序号'),
			array('ordersn','订单号'),
			array('wxid','网校ID'),
			array('sitename','网校名称'),
			array('numb','数量（个）'),
			array('market_price','单价（个/元）'),
			array('paytype','支付方式'),
			array('price','实际支付（元）'),
			array('adddate','消费时间'),
			array('paystatus','支付状态'),
			array('userip','使用的ip地址'),
			array('appname','备注'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}
	//消费记录
	public function livepayAction(){
		$livelog       = M('common_live_log');
		$sitenameModel = M('common_user_website');
		$classModel    = M('app_course');

		$where         = 'as a left join '.$sitenameModel->table.' as b on a.wxid=b.wxid 
		left join '.$classModel->table.' as c on a.infoid=c.courseid where ';
		




		$status        = KS_S('status',3);
		if($status==3){ $where.= ' (a.status=0 or a.status=2)';}
		if($status==1){ $where.= ' a.status=2';}
		if($status==0){ $where.= ' a.status=0';}


		$keyword       = KS_S('keyword');
		$keytype       = KS_S('keytype',1);
		if(!empty($keyword)){
			if($keytype==1){$where.=" and c.title like '%$keyword%'";}
			if($keytype==2){$where.=" and a.wxid=$keyword";}
			if($keytype==3){$where.=" and b.sitename like '%$keyword%'";}
		}
		$byname        = null !==GF('byname') ? GF('byname'):'a.id desc';//排序
		$options     = $livelog->getOptions('10',$where);//分页参数设置
		$page        = Page($options);
		$pagelogs    = $livelog->getPage($page,$byname,$where,'a.*,b.sitename,c.title');

		$outtime       = $livelog->getOne('sum(a.time)',$where.' and a.status=2');
		$outmoney      = $livelog->getOne('sum(a.cost)',$where.' and a.status=2');

		/*$now_page      = ChkClng(KS_S('p',1));
       $pay_log       = M('Application/PayModel/app_pay_log');
       $usersModel    = M('Application/PayModel/common_user_member');
       $sitenameModel = M('Application/PayModel/common_user_website');
       $where         = "as a left join `$usersModel->table` as b on a.memberid = b.userid left join $sitenameModel->table as c on a.wxid=c.wxid where a.cmoney!=0 and a.linepaytype!=0";
       $keyword       = KS_S('keyword');
       $keytype       = KS_S('keytype',1);
       $status        = KS_S('status',3);
       $byname        = null !==GF('byname') ? GF('byname'):'a.id desc';//排序
       if(!empty($keyword)){
           if($keytype==1){$where.=" and b.name like '%$keyword%'";}
           if($keytype==2){$where.=" and a.wxid=$keyword";}
           if($keytype==3){$where.=" and c.sitename like '%$keyword%'";}
       }
       $allcomoney = $pay_log->getOne('sum(a.cmoney)',$where);
       $successcomoney = $pay_log->getOne('sum(a.cmoney)',$where.' and a.type=1');
       $outmoney = $pay_log->getOne('sum(a.cmoney)',$where.' and a.type=0');

       if($status==3){ $where.= ' and (a.type=1 or a.type=0)';}
        if($status==1){ $where.= ' and a.type=1';}
        if($status==0){ $where.= ' and a.type=0';}

       $options    = $pay_log->getOptions('10',$where);
       $page       = Page($options);
       $pagelogs   = $pay_log->getPage($page,$byname,$where,'a.*,b.name as username,c.sitename');*/
		include  CURR_VIEW_PATH . "Paylog/live_pay.php";
	}
	public function studentListAction()
	{
		$id = KS_S('id');
		$livelog = M('common_live_log');
		$list = $livelog->getOne('json',"where id=$id");
		if (!empty($list)) $list = json_decode($list,true);
		include  CURR_VIEW_PATH . "Paylog/student_list.php";
	}
	public function livepayExcelAction(){
		$livelog       = M('common_live_log');
		$sitenameModel = M('common_user_website');
		$classModel    = M('app_course');

		$where         = 'as a left join '.$sitenameModel->table.' as b on a.wxid=b.wxid 
		left join '.$classModel->table.' as c on a.infoid=c.courseid where a.status =2 and a.classlevel !=0';



		$outtime       = $livelog->getOne('sum(a.time)',$where.' and a.status=2');
		$outmoney      = $livelog->getOne('sum(a.cost)',$where.' and a.status=2');

		$status        = KS_S('status',3);
		if($status==3){ $where.= ' and (a.status=1 or a.status=2)';}
		if($status==1){ $where.= ' and a.status=2';}
		if($status==0){ $where.= ' and a.status=1';}


		$keyword       = KS_S('keyword');
		$keytype       = KS_S('keytype',1);
		if(!empty($keyword)){
			if($keytype==1){$where.=" and c.title like '%$keyword%'";}
			if($keytype==2){$where.=" and a.wxid=$keyword";}
			if($keytype==3){$where.=" and b.sitename like '%$keyword%'";}
		}
		$byname        = null !==GF('byname') ? GF('byname'):'a.id desc';//排序

		$paperid = ChkClng(KS_G('post.outtime'));
		if(empty($paperid)){
			$url=M_URL('home/Paylog','livecurrency','',GP('p-'.$now_page));
			KS_INFO("请选择导出的类型",0,$url);
		}
		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
		if($paperid==1){
			$options     = $livelog->getOptions('10',$where);//分页参数设置
			$page        = Page($options);
			$infoary    = $livelog->getPage($page,$byname,$where,'a.*,b.sitename,c.title');

		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $order->getAll($where.' order by '.$byname,'a.*,b.sitename,c.title');
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $pay_log->getAll($where.' order by '.$byname,'a.*,b.sitename,c.title');
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and a.adddate > '.$strtime.' and a.adddate < '.$endtime;
			$infoary = $pay_log->getAll($where.' order by '.$byname,'a.*,b.sitename,c.title');
		}
		foreach($infoary as $key =>$val){
			$infoary[$key]['number'] = $key+1;
			date_default_timezone_set("PRC");
			$infoary[$key]['endtime']=date('Y-m-d H:i:s',$val['endtime']);
			$infoary[$key]['starttime']=date('Y-m-d H:i:s',$val['starttime']);
			$infoary[$key]['settlement']=date('Y-m-d H:i:s',$val['settlement']);
			if($val['classlevel']==1){ $infoary[$key]['classlevel']= '小班'; }elseif($val['classlevel']==2){ $infoary[$key]['classlevel']= '一对一'; }
			if($val['status']==2){
				$infoary[$key]['status']='已结算';
			}else{
				$infoary[$key]['status']='未结算';
			}
		}
		$xlsName     = '连麦币消费记录列表';//文件名
		$textRun     = $xlsName;//表名
		$xlsCell  = array(
			array('number','序号'),
			array('wxid','网校ID'),
			array('sitename','网校名称'),
			array('title','课程或班级名'),
			array('time','总时长（包括学生）（单位：秒/s）'),
			array('cost','花费直播币（元）'),
			array('starttime','开始时间'),
			array('endtime','结束时间'),
			array('settlement','结算时间'),
			array('status','结算状态'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}
}
