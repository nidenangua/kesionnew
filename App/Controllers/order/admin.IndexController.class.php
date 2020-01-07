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
	 * 网校的订单管理
	 */
	public function indexAction(){

		$paystatus = ChkClng(KS_S('paystatus'),3);
		$stype = ChkClng(KS_S('type'),6);
        $where = '';
		if($paystatus == 1){
			$where = 'where a.paystatus=1 and (a.status=0 or a.status=1) and a.price!=0';
		}elseif($paystatus==2){
			$where = 'where a.paystatus=0 and (a.status=0 or a.status=1) and a.price!=0';
		}elseif($paystatus==3){
			$where = 'where (a.paystatus=1 or a.paystatus=0) and (a.status=0 or a.status=1) and a.price!=0';
		}
		if($stype == 1){$where .= ' and a.type=1';
		}elseif($stype==2){$where .= ' and a.type=2';
		}elseif($stype==3){$where .= ' and a.type=0';
		}elseif($stype==6){$where .= ' and 1=1';
		}

		$byname        = KS_S('byname','a.adddate desc');//排序


		$db_order_info = M("app_order_info");
		$app_order     = M("app_order");

		$where         = "as a inner join `$app_order->table` as b on a.orderid = b.orderid ".$where;

        $keyword     = KS_S('keyword');
		$keytype     = KS_S('keytype',1);
		if($keyword){
			if($keytype==2){$where.=" and b.name like '%$keyword%'";}
			elseif($keytype==1){$where.=" and a.ordersn='$keyword'";}
			elseif($keytype==3){$where.=" and a.wxid='$keyword'";}
		}
		$m    =  mktime(0,0,0,date('m'),1,date('Y'));
		$day  =  mktime(0,0,0,date('m'),date('d'),date('Y'));

		if(date("w")==0){$wday = 7;}else{$wday = date("w");}
		$week =  mktime(0,0,0,date("m"),date("d")-$wday+1,date("Y"));
		$year =  mktime(0,0,0,1,1,date('Y'));

		$yearCout     = $db_order_info->getOne('count(a.orderid)',$where.' and a.adddate>'.$year);
		$mCout        = $db_order_info->getOne('count(a.orderid)',$where.' and a.adddate>'.$m);
		$weekCount    = $db_order_info->getOne('count(a.orderid)',$where.' and a.adddate>'.$week);
		$dayCout      = $db_order_info->getOne('count(a.orderid)',$where.' and a.adddate>'.$day);
		$allcount     = $db_order_info->getOne('sum(a.price)',$where. ' and a.paystatus=1 and (a.status=0 or a.status=1) ');
		$onlinecount  = $db_order_info->getOne('sum(a.price)',$where .' and b.paytype!=0 and a.paystatus=1 and (a.status=0 or a.status=1) ');
		$poundage  = $db_order_info->getOne('sum(b.poundage)',$where .' and b.paytype!=0 and a.paystatus=1 and (a.status=0 or a.status=1) ');
		$options    =  $db_order_info->getOptions('10',$where);//分页参数设置
		$page       =  Page($options);
		$OrderAll   =  $db_order_info->getPage($page,$byname,$where,'a.*,b.paytype,b.poundage,b.discount,b.actual_amount,b.order_amount,b.original_amount,b.salesincome,b.ispaytoplat');
		
		include  CURR_VIEW_PATH . "index.php";
	}
	public function indexexcelAction(){
		$paystatus = ChkClng(KS_S('paystatus'),3);
		$stype = ChkClng(KS_S('type'),6);
		if($paystatus == 1){
			$where = 'where a.paystatus=1 and (a.status=0 or a.status=1) and a.price!=0';
		}elseif($paystatus==2){
			$where = 'where a.paystatus=0 and (a.status=0 or a.status=1) and a.price!=0';
		}elseif($paystatus==3){
			$where = 'where (a.paystatus=1 or a.paystatus=0) and (a.status=0 or a.status=1) and a.price!=0';
		}
		if($stype == 1){$where .= ' and a.type=1';
		}elseif($stype==2){$where .= ' and a.type=2';
		}elseif($stype==3){$where .= ' and a.type=0';
		}elseif($stype==6){$where .= ' and 1=1';
		}
		/*$userscategory = $this->cache->getACache('userscategory');//取出缓存*/
		$byname        = null !==GF('byname') ? GF('byname'):'a.adddate desc';//排序

		$userModel     = M('common_user_member');

		$db_order_info = M("app_order_info");
		$app_order     = M("app_order");

		$where         = "as a left join `$userModel->table` as b on a.memberid = b.userid left join `$app_order->table` as c on a.orderid = c.orderid $where";

		$keyword     = KS_S('keyword');
		$keytype     = KS_S('keytype',1);
		if($keyword){
			if($keytype==2){$where.=" and b.name like '%$keyword%'";}
			elseif($keytype==1){$where.=" and a.ordersn='$keyword'";}
			elseif($keytype==3){$where.=" and a.wxid='$keyword'";}
		}
		$paperid = ChkClng(null !==KS_G('post.outtime')? KS_G('post.outtime'):'1');
		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
		if($paperid==1){
			$options    =  $db_order_info->getOptions('10',$where);//分页参数设置
			$page       =  Page($options);
			$infoary   =  $db_order_info->getPage($page,$byname,$where,'b.name,a.*,c.paytype,c.poundage,c.actual_amount');

		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $db_order_info->getAll($where.' order by  '.$byname,'b.name,a.*,c.paytype,c.poundage,c.actual_amount');
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $db_order_info->getAll($where.' order by  '.$byname,'b.name,a.*,c.paytype,c.poundage,c.actual_amount');
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and a.adddate > '.$strtime.' and a.adddate < '.$endtime;
			$infoary =$db_order_info->getAll($where.' order by  '.$byname,'b.name,a.*,c.paytype,c.poundage,c.actual_amount');
		}
		$db_user = M("common_user");
		foreach($infoary as $key =>$val){
			$infoary[$key]['number'] = $key+1;
			date_default_timezone_set("PRC");
			$infoary[$key]['adddate']=date('Y-m-d H:i:s',$val['adddate']);
			if($val['paystatus']==1){
				$infoary[$key]['paystatus']='已支付';
			}else{
				$infoary[$key]['paystatus']='未支付';
			}
			if($val['paytype']==0){$infoary[$key]['paytype']= '线下支付';}elseif($val['paytype']==1){$infoary[$key]['paytype']=  '支付宝';}elseif($val['paytype']==2){$infoary[$key]['paytype']=  '微信';}
			if($val['type'] == 1){
				$infoary[$key]['type']= '购买班级';
			}elseif($val['type'] ==2){
				$infoary[$key]['type']= '购买充值';
			}elseif($val['type'] ==0){
				$infoary[$key]['type']= '购买课程';
			}
			if($val['islq']){
				$infoary[$k]['mobile'] ='';
			}else{
				$infoary[$k]['mobile'] = $db_user->getOne('mobile','where userid='.$val['memberid']);

			}
		}
		$xlsName     = '订单表';//文件名
		$textRun     = $xlsName;//表名
		$xlsCell  = array(
			array('number','序号'),
			array('wxid','网校ID'),
			array('ordersn','订单号'),
			array('name','购买人'),
			array('paystatus','支付状态'),
			array('mobile','联系电话'),
			array('type','花费类型'),
			array('price','订单金额'),
			array('poundage','手续费'),
			array('actual_amount','实际到账'),
			array('paytype','支付方式'),
			array('adddate','下单日期'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}
	/*
     * 显示订单的详细信息
     */
	public function showdetailAction(){
		$orderId   = ChkSQL(KS_S('orderid'));
		$ordermsg  = $this->AppModel->getRow('where orderid='.$orderId);
		$userModel = M('app_order_info');
		$orderdetail=$userModel->getAll('where orderid='.$orderId,'courseid,title,numb,price,adddate,ispj,type');

		$wxmsg     = wx_GetStoreInfo($ordermsg['wxid'])['storename'];
		include  CURR_VIEW_PATH . "index_detail.php";

	}

	public function flowexcelAction(){
		$paystatus = ChkClng(KS_S('paystatus'),3);
		$stype = ChkClng(KS_S('type'),6);
		if($paystatus == 1){
			$where = 'where a.paystatus=1 and (a.status=0 or a.status=1)';
		}elseif($paystatus==2){
			$where = 'where a.paystatus=0 and (a.status=0 or a.status=1)';
		}elseif($paystatus==3){
			$where = 'where (a.paystatus=1 or a.paystatus=0) and (a.status=0 or a.status=1)';
		}

		if($stype == 1){
			$where .= ' and a.type=1';
		}elseif($stype==2){
			$where .= ' and a.type=2';
		}elseif($stype==3){
			$where .= ' and a.type=0';
		}elseif($stype==6){
			$where .= ' and 1=1';
		}
		/*$userscategory = $this->cache->getACache('userscategory');//取出缓存*/
		$byname      = null !==GF('byname') ? GF('byname'):'a.adddate asc';//排序
		$paperid = ChkClng(null !==KS_G('post.outtime')? KS_G('post.outtime'):'1');
		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
		$userModel   = M('common_user');
		$where       = "as a left join `$userModel->table` as b on a.memberid = b.userid $where";
		$keyword     = KS_S('keyword');
		$keytype     = KS_S('keytype',1);
		if($keyword){
			if($keytype==2){$where.=" and b.username like '%$keyword%'";}
			elseif($keytype==1){$where.=" and a.ordersn='$keyword'";}
		}
		if($paperid==1){
			$options = $this->AppModel->getOptions('10',$where);//分页参数设置
			$page = Page($options);
			$infoary = $this->AppModel->getPage($page,$byname,$where,'a.orderid,a.ordersn,b.username,b.mobile,a.order_amount,a.adddate,a.paystatus,a.type,a.wxid,a.memberid');

		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and adddate > '.$strtime;
			$infoary = $this->AppModel->getAll($where.' order by  '.$byname,'a.orderid,a.ordersn,b.username,b.mobile,a.order_amount,a.adddate,a.paystatus,a.type,a.wxid,a.memberid');
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and adddate > '.$strtime;
			$infoary = $this->AppModel->getAll($where.' order by  '.$byname,'a.orderid,a.ordersn,b.username,b.mobile,a.order_amount,a.adddate,a.paystatus,a.type,a.wxid,a.memberid');
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and adddate > '.$strtime.' and adddate < '.$endtime;
			$infoary =$this->AppModel->getAll($where.' order by  '.$byname,'a.orderid,a.ordersn,b.username,b.mobile,a.order_amount,a.adddate,a.paystatus,a.type,a.wxid,a.memberid');
		}
		foreach($infoary as $key =>$val){
			date_default_timezone_set("PRC");
			$infoary[$key]['adddate']=date('Y-m-d H:i:s',$val['adddate']);
			if($infoary[$key]['paystatus']==1){
				$infoary[$key]['paystatus']='已支付';
			}else{
				$infoary[$key]['paystatus']='未支付';
			}
			if($infoary[$key]['type'] == 1){
				$infoary[$key]['type']= ' 购买班级';
			}elseif($infoary[$key]['type'] ==2){
				$infoary[$key]['type']= '购买充值';
			}elseif($infoary[$key]['type'] ==0){
				$infoary[$key]['type']= ' 购买课程';
			}
		}
		$xlsName     = '订单表';//文件名
		$textRun     = $xlsName;//表名
		foreach($infoary as $k=>$v){$infoary[$k]['number'] = $k+1;}
		$xlsCell  = array(
			array('number','序号'),
			array('ordersn','订单号'),
			array('username','购买人'),
			array('paystatus','支付状态'),
			array('mobile','联系电话'),
			array('type','花费类型'),
			array('order_amount','订单金额'),
			array('adddate','下单日期'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}
	//确认删除
	public function confirmdelAction(){
		$id          =  ChkClng(KS_G('get.id'));
		$now_page    =  ChkClng(KS_S('p',1));
		include  CURR_VIEW_PATH . "confirmdel.php";
	}
	//确认删除
	public function doconfirmdelAction(){
		$password      = ChkSQL(KS_G('password'));
		// var_dump($password);
		if($password=='654321'){
			$id          =  ChkClng(KS_G('get.id'));
			$now_page    =  ChkClng(KS_S('p',1));
			$info_Model = M('app_order_info');
			$info_Model->delete('orderid='.$id);
			$this->AppModel->delete('orderid='.$id);

			$url         =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
			KS_INFO('删除成功',3,$url);
		}else{
			KS_INFO('密码错误',0,'','',1);
		}
	}
}
?>