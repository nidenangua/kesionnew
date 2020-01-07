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
class FlowController extends CommonController
{
	/*	
	 * 显示优惠券管理页面
	 */
	public function indexAction(){
//		$keyword=ChkSQL(GF('keyword') ? GF('keyword'):'');
//		var_dump($keyword);
//		include  CURR_VIEW_PATH . "Coupon/coupon_manage.php";
//		exit;
		$flow = M('app_dayflow');
		$user = M('common_user');
		$keytype=ChkClng(GF('keytype') ? GF('keytype'):'1');
		$keyword=ChkSQL(GF('keyword') ? GF('keyword'):'00');
		$type=ChkClng(GF('type') ? GF('type'):1);
		$now_page=ChkClng(GF('p') ? GF('p'):'1'); 
		$byname = ChkSQL(GF('byname') ? GF('byname'):'desc');
	 	if($type==1){ $where= ' where a.type=1 and a.status=0';}
	 	if($type==4){ $where= ' where a.status=-1';}
		if($keytype==1&& $keyword!='00'){
			$where="$where and b.username like '%$keyword%'";
		}else if($keytype==2 && $keyword!='00'){
			$where="$where and a.wxid=".$keyword;
		}			
		$where = "as a left join `$user->table` as b on a.userid = b.userid $where";
		$now_page =  ChkClng(KS_S('p',1));
		$options = $flow->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$infoary = $flow->getPage($page,'adddate '.$byname,$where,'a.id,b.username,a.flow,a.playcount,a.adddate,a.wxid');
		include  CURR_VIEW_PATH . "Flow/flowmanage.php";
	}
	/**
	 * 单个删除
	 */
	public function delRecAction(){
		$flow = M('app_dayflow');
		$id=ChkSQL(KS_G('request.id'));

		$Data['status'] = -1; 
    	$res=$flow->update($Data,'id='.$id);
		$now_page =  ChkClng(KS_S('p',1));		
		$url=M_URL('Flow','index','',GP('p-'.$now_page));		
		ks_header($url);
	}
	/**
	 * 批量删除
	 */
	public function delsomeAction(){
		$idAry = ChkSQL('' !==KS_G('post.id') ? KS_G('post.id'):array());
    	$Data['status'] = -1;
    	$flow = M('app_dayflow');
    	$now_page =  ChkClng(KS_S('p',1));
    	if(count($idAry)==0){
	    	$url = M_URL('Coupon','index','',GP('p-'.$now_page));			
			KS_INFO("请选择需要删除的数据",0,$url);	
    	}
    	foreach($idAry as $key =>$val){
    	  $res = $flow ->update($Data,'id = '.$val.' and endtime<'.time());	
    	}		
		$url = M_URL('Flow','index','',GP('p-'.$now_page));			
		KS_INFO("批量操作成功",0,$url);
	}
	 
    public function flowexcelAction(){
    	$keytype = ChkClng(null !==GF('keytype') ? GF('keytype'):'1');
    	$keyword =  KS_S('keyword');
    	$byname =  ChkSQL(null !==GF('byname') ? GF('byname'):'desc');
    	$type=ChkClng(GF('type') ? GF('type'):3);
		$paperid = ChkClng(null !==KS_G('post.outtime')? KS_G('post.outtime'):'1');

		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
	 	if($type==1){ $where= ' where type=1 and a.status=0';}
	 	if($type==4){ $where= ' where a.status=-1';}
	 	$flow = M('app_dayflow');
		$user = M('common_user');
		$where = "as a left join `$user->table` as b on a.userid = b.userid $where";
		//根据搜索类型生成查询条件
	    if($keytype==2){
			if($keyword!='00'){$where=$where." and a.wxid=".$keyword;}
		}else if($keytype==1){
			if($keyword!='00'){$where=$where." and b.username like '%$keyword%'";}
		}
		if($paperid==1){
			$options = $flow->getOptions('10',$where);//分页参数设置
		    $page = Page($options);
			$infoary = $flow->getPage($page,'adddate '.$byname,$where,'a.id,b.username,a.flow,a.playcount,a.adddate,a.wxid');
			  
		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and adddate > '.$strtime;
			$infoary = $flow->getAll($where.' order by adddate '.$byname,'a.id,b.username,a.flow,a.playcount,a.adddate,a.wxid');
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and adddate > '.$strtime;
			$infoary = $flow->getAll($where.' order by adddate '.$byname,'a.id,b.username,a.flow,a.playcount,a.adddate,a.wxid');
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and adddate > '.$strtime.' and adddate < '.$endtime;
			$infoary =$flow->getAll($where.' order by adddate '.$byname,'a.id,b.username,a.flow,a.playcount,a.adddate,a.wxid');
		}
		 foreach($infoary as $key =>$val){
		 	date_default_timezone_set("PRC");
		 	$infoary[$key]['adddate']=date('Y-m-d H:i:s',$val['adddate']);
		 	if($infoary[$key]['type']==1){
		 		$infoary[$key]['type']='点播';
		 	}else{
		 		$infoary[$key]['type']='直播';
		 	}
		 }
		$xlsName     = '流量使用情况';//文件名
		$textRun     = $xlsName;//表名
		foreach($infoary as $k=>$v){$infoary[$k]['number'] = $k+1;}
		$xlsCell  = array(
			array('number','序号'),
			array('username','使用人'),
			array('flow','使用流量'),
			array('playcount','播放次数'),
			array('adddate','使用日期'),
			array('type','使用类型'),
			array('wxid','所属网校id'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}
	
	
	public function showSpaceAction(){
		$keytype = ChkClng(null !==GF('keytype') ? GF('keytype'):'1');
    	$keyword =  ChkSQL(null !==GF('keyword') ? GF('keyword'):'00');
    	$type=ChkClng(GF('stype') ? GF('stype'):3);
    	$status=ChkClng(GF('status') ? GF('status'):3);  
		$orderModel  =  M('common_order_info');
		$website     =  M('common_user_website');
		if($type==3){ $where= ' where 1=1';}
		elseif($type==1){
			$where= 'where endtime<'.time();
		}elseif($type==2){
			$where= 'where endtime>'.time();
		}
		if($status==3){ $where= $where .' and 1=1';}
		elseif($status==1){
			$where= $where .' and paystatus=1';
		}elseif($status==2){
			$where= $where .' and paystatus=0';
		}
		if($keyword!='00'){
			if($keytype==1){
				$where= $where .' and a.ordersn='.$keyword;
			}else{
				$where= $where .' and b.sitename like "%'.$keyword.'%"';
			}	
		}

	 	$where =  $where .' and appid=3';
		$where = "as a left join `$website->table` as b on a.wxid = b.wxid $where";
		$options   = $orderModel->getOptions('10',$where);//分页参数设置
		$page      = Page($options);
		$value    = $orderModel->getPage($page,'',$where,'a.orderid,a.ordersn,b.sitename,a.paystatus,a.appname,a.numb,a.summarket,a.sumprice,a.price,a.market_price,a.starttime,a.endtime');
		$Model    =  M('common_order');
		foreach($value as $k => $v){
			$value[$k]['adddate'] = $Model->getOne('adddate','where orderid='.$v['orderid']);
		}
        include  CURR_VIEW_PATH . "Flow/space_manage.php";
	}
    public function spaceExcelAction(){
    	$keytype = ChkClng(null !==GF('keytype') ? GF('keytype'):'1');
    	$keyword =  KS_S('keyword');
    	var_dump($keyword);
    	$type=ChkClng(GF('stype') ? GF('stype'):3);
    	$status=ChkClng(GF('status') ? GF('status'):3);  
		$orderModel  =  M('common_order_info');
		$website     =  M('common_user_website');
		$Model    =  M('common_order');
		if($type==3){ $where= ' where 1=1';}
		elseif($type==1){
			$where= 'where endtime<'.time();
		}elseif($type==2){
			$where= 'where endtime>'.time();
		}
		if($status==3){ $where= $where .' and 1=1';}
		elseif($status==1){
			$where= $where .' and paystatus=1';
		}elseif($status==2){
			$where= $where .' and paystatus=0';
		}
		if($keyword !='00'){
			if($keytype==1){
				$where= $where .' and a.ordersn='.$keyword;
			}else{
				$where= $where .' and b.sitename like "%'.$keyword.'%"';
			}	
		}
		$where =  $where .' and appid=3';
		$where = "as a left join `$website->table` as b on a.wxid = b.wxid $where";
		$infoary=array();
		$paperid = ChkClng(null !==KS_G('post.outtime')? KS_G('post.outtime'):'1');
        $alldata = $orderModel->getAll($where,'a.orderid,a.ordersn,b.sitename,a.paystatus,a.appname,a.numb,a.summarket,a.sumprice,a.price,a.market_price,a.starttime,a.endtime');
		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
		if($paperid==1){
			$options = $orderModel->getOptions('10',$where);//分页参数设置
		    $page = Page($options);
			$infoary = $orderModel->getPage($page,'',$where,'a.orderid,a.ordersn,b.sitename,a.paystatus,a.appname,a.numb,a.summarket,a.sumprice,a.price,a.market_price,a.starttime,a.endtime');
			  
		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and adddate > '.$strtime;
			foreach($alldata as $k =>$v){
				$adddate = $Model->getOne('adddate','where orderid='.$v['orderid']);
				if($adddate>$strtime){
					array_push($infoary,$v);
				}
			}
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			foreach($alldata as $k =>$v){
				$adddate = $Model->getOne('adddate','where orderid='.$v['orderid']);
				if($adddate>$strtime){
					array_push($infoary,$v);
				}
			}
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and adddate > '.$strtime.' and adddate < '.$endtime;
			foreach($alldata as $k =>$v){
				$adddate = $Model->getOne('adddate','where orderid='.$v['orderid']);
				if($adddate>$strtime && $adddate<$endtime){
					array_push($infoary,$v);
				}
			}
		}
		$xlsName     = '用户购买点播空间情况';//文件名
		$textRun     = $xlsName;//表名
		foreach($infoary as $k=>$v){$infoary[$k]['number'] = $k+1;
		if($v['paystatus']==1){
	 		$infoary[$k]['paystatus']='已支付';
	 	}else{
	 		$infoary[$k]['paystatus']='未支付';
	 	}
		$adddate = $Model->getOne('adddate','where orderid='.$v['orderid']);
		$infoary[$k]['adddate'] = date('Y-m-d H:i:s',$adddate);
		$infoary[$k]['validTime'] = date('Y/m',$v['starttime']).'-'.date('Y/m',$v['endtime']);
		}
		$xlsCell  = array(
			array('number','序号'),
			array('ordersn','订单号'),
			array('sitename','网校名称'),
			array('paystatus','支付状态'),
			array('appname','购买内容'),
			array('numb','购买数量'),
			array('sumprice','实际支付金额'),
			array('price','实际支付单价'),
			array('validTime','有效期'),
			array('adddate','下单日期'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}
}

?>