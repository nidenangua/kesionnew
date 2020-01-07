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
class OrderController extends CommonController
{
	public function indexAction(){
		//状态筛选
		$status = ChkClng(KS_S('paystatus',3));
		$stype  = ChkClng(KS_S('type'),6);
		$option = ChkClng(KS_S('option','5'));
		$num    = ChkClng(KS_S('numb'));
		$where  = 'where a.status!=-1 and a.order_amount!=0 and a.paytype!=0';
		if($status == 2){$where .= ' and a.paystatus=2';
	    }elseif($status==1){$where .= ' and a.paystatus=1';
	    }elseif($status==0){$where .= ' and a.paystatus=0';
        }
		if($stype == 1){$where .= ' and a.type=1';
	    }elseif($stype==2){$where .= ' and a.type=2';
	    }elseif($stype==3){$where .= ' and a.type=3';
	    }elseif($stype==4){$where .= ' and a.type=4';
	    }elseif($stype==5){$where .= ' and a.type=5';
	    }elseif($stype==0){$where .= ' and a.type=0';}
		$year = date('Y');$month   = date('n');
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
		if($option!=5){$where .= " and (a.adddate>$startday and a.adddate<$endday)";}
		$byname     = null !==GF('byname') ? GF('byname'):'a.adddate desc';//排序
		$shopModel  = M('common_order');
		$usersModel = M('common_user');
		$websiteModel = M('common_user_website');
		$where      = "as a left join `$usersModel->table` as b on a.userid = b.userid left join $websiteModel->table as c on a.wxid=c.wxid  $where";
		$keyword=KS_S('keyword');
		$keytype=KS_S('keytype',1);
		if(!empty($keyword)){
			if($keytype==1){$where.=" and a.ordersn like '%$keyword%'";}
			elseif($keytype==3){$where.=" and a.wxid=$keyword";}
			elseif($keytype==2){$where.=" and b.username like '%$keyword%'";}
			elseif($keytype==4){$where.=" and c.sitename like '%$keyword%'";}
		}
		$options    = $shopModel->getOptions('50',$where);//分页参数设置
		$page       = Page($options);
		$OrderAll   = $shopModel->getPage($page,$byname,$where,'a.*,b.username,c.sitename');
		$ordercount = $shopModel->getAll($where,'count(orderid) as sum')[0]['sum'];
		$paycount   = $shopModel->getAll($where.' and a.paystatus=1','count(orderid) as sum')[0]['sum'];
		$nopaycount = $shopModel->getAll($where.' and a.paystatus=0','count(orderid) as sum')[0]['sum'];
		$summoney   = $shopModel->getAll($where.' and a.paystatus=1','sum(order_amount) as sum')[0]['sum'];
		if($summoney){$summoney=$summoney;}else{$summoney=0.00;}
		include  CURR_VIEW_PATH . "Order/admin.orderlist.php";
	}
    public function flowexcelAction(){
     	$status = ChkClng(KS_S('paystatus'),3);
		$stype  = ChkClng(KS_S('type'),6);
		$option = null !==GF('option') ? GF('option'):'5';
		$num    = null !==GF('numb') ? GF('numb'):'0';
		$where  = 'where a.status!=-1 and a.order_amount!=0 and a.paytype!=0';
		if($status == 2){$where .= ' and a.paystatus=2';
	    }elseif($status==1){$where .= ' and a.paystatus=1';
	    }elseif($status==0){$where .= ' and a.paystatus=0';
        }
		if($stype == 1){$where .= ' and a.type=1';
	    }elseif($stype==2){$where .= ' and a.type=2';
	    }elseif($stype==3){$where .= ' and a.type=3';
	    }elseif($stype==4){$where .= ' and a.type=4';
	    }elseif($stype==5){$where .= ' and a.type=5';
	    }elseif($stype==0){$where .= ' and a.type=0';}
		$year = date('Y');$month   = date('n');
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
		if($option!=5){$where .= " and (a.adddate>$startday and a.adddate<$endday)";}
		$byname     = null !==GF('byname') ? GF('byname'):'a.adddate desc';//排序
		$shopModel  = M('common_order');
		$usersModel = M('common_user');
		$websiteModel = M('common_user_website');
		$where      = "as a left join `$usersModel->table` as b on a.userid = b.userid left join $websiteModel->table as c on a.wxid=c.wxid  $where";
		$keyword=KS_S('keyword');
		$keytype=KS_S('keytype',1);
		if(!empty($keyword)){
			if($keytype==1){$where.=" and a.ordersn like '%$keyword%'";}
			elseif($keytype==3){$where.=" and a.wxid=$keyword";}
			elseif($keytype==2){$where.=" and b.username like '%$keyword%'";}
			elseif($keytype==4){$where.=" and c.sitename like '%$keyword%'";}
		}
		$paperid = ChkClng(null !==KS_G('post.outtime')? KS_G('post.outtime'):'1');
		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
		if($paperid==1){
			$options = $shopModel->getOptions('10',$where);//分页参数设置
		    $page = Page($options);
			$infoary = $shopModel->getPage($page,$byname,$where,'a.*,b.username,c.sitename');

		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $shopModel->getPage($page,$byname,$where,'a.*,b.username,c.sitename');
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and a.adddate > '.$strtime;
			$infoary = $shopModel->getPage($page,$byname,$where,'a.*,b.username,c.sitename');
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and a.adddate > '.$strtime.' and a.adddate < '.$endtime;
			$infoary =$shopModel->getPage($page,$byname,$where,'a.*,b.username,c.sitename');
		}
		 foreach($infoary as $key =>$val){
		 	$infoary[$key]['number'] = $key+1;
		 	date_default_timezone_set("PRC");
		 	$infoary[$key]['adddate']=date('Y-m-d H:i:s',$val['adddate']);
		 	if($infoary[$key]['paystatus']==1){
		 		$infoary[$key]['paystatus']='已支付';
		 	}else{
		 		$infoary[$key]['paystatus']='未支付';
		 	}
		 	if($val['type']==0){
				$infoary[$key]['type'] ='购买应用';
			}elseif($val['type']==1){
				$infoary[$key]['type']= '购买套餐';
			}elseif($val['type']==2){
				$infoary[$key]['type'] ='购买服务';
			}elseif($val['type']==3){
				$infoary[$key] ['type']='购买模版';
			}elseif($val['type']==4){
				$infoary[$key]['type']= '用户充值';
			}elseif($val['type']==5){
				$infoary[$key]['type'] ='购买营销';
			}
		 }
//		 var_dump($infoary);exit;
		$xlsName     = '平台订单列表';//文件名
		$textRun     = $xlsName;//表名
		$xlsCell  = array(
			array('number','序号'),
			array('wxid','网校ID'),
			array('ordersn','订单号'),
			array('sitename','网校名称'),
			array('username','购买人'),
			array('paystatus','支付状态'),
			array('type','花费类型'),
			array('order_amount','订单金额'),
			array('original_amount','订单原价'),
			array('adddate','下单日期'),
			array('mark','备注'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
     }
	/**
	 * 显示订单的详细信息
	 */
	public function OrderdetailAction(){
	   $orderModel =M('common_order');
	   $shopModel = M('common_order_info');
	   $orderid = ChkSQL(KS_S('orderid'));
	   $where = "where orderid=".$orderid;
	   $info=$orderModel->getRow($where,'ordersn,adddate,mark,paystatus,order_amount,paydate');//获取订单基本信息
	   $detail=$shopModel->getAll($where,'appname,price,numb,type,appid');
	   include  CURR_VIEW_PATH . "Order/admin.orderdetail.php";
	}
	public function OrderdataAction(){
	   include  CURR_VIEW_PATH . "Order/order_data.php";
	}
	public function delOrderAction(){
	    $now_page   = ChkClng(KS_S('p'));
		$orderid    = ChkClng(KS_G('request.id'));
		$order_info = M('common_order');
		$order_apps = M('common_order_info');
		$order_info->delete("orderid=$orderid");
		$order_apps->delete("orderid=$orderid");
		$url = M_URL('Order','index','',$now_page);
		ks_header($url);
	}
	public function beachAction(){
		$SmsModel = M('Application/SmsModel/common_sms_content');
		$SmsModel->status0();
		$statusid=isset($_POST["status"]) ? $_POST["status"] : "";
		if(!empty($statusid)){$SmsModel->status1($statusid);}
		$id      = $_POST["id"];
		$smsnum  = $_POST["smsnum"];
		$content = $_POST["content"];
		$SmsModel->beachupdate($id,$smsnum,$content);
		$this->cache->PutACache('smsmodel');//存入缓存
		$url=M_URL('smscontent');
		KS_INFO("更新成功",0,$url);
	}
	/*网校数据*/
	public function wxcountAction(){
		$Model      = M('common_user_website');
		$areaModel  = M('common_area');
		$prenAry    = $areaModel->getAll('where parentid=0','id,city');
		$wxinfo     = $Model->getAll('','wxid,packstartime,package,provinceid');
		$option     =  KS_G('post.option');
		$year       = date('Y');
		$month      = date('n');
		$day        = array();
		$day2       = array();
		$day3       = array();
		switch($option){
			case 1:
			   if(date("w")==0){$wday = 7;}else{$wday = date("w");}
			    foreach($prenAry as $key =>$val){
			        $flag = 0;$flag2 = 0;$flag3 = 0;
			        $fg = 0;$fg2 = 0;$fg3 = 0;
			        $day4[$key] = $val['city'];
				    for($i = 1 ;$i<=7;$i++){
					    $startime = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$wday+$i,date("Y")));
						foreach($wxinfo as $k =>$v){
							if($v['provinceid']==$val['id']){
								if(date('Y-m-d',$v['packstartime']) == $startime ){
//									var_dump(date('Y-m-d',$v['packstartime']));
									$flag +=1;
									if($v['package']=='v2'){//普通版网校
									   $flag2 +=1;
									}elseif($v['package']=='v3'){//vip版
										$flag3 +=1;
									}
								}
							}
							if($key==count($prenAry)-1){
								if($v['provinceid']==0){
								if(date('Y-m-d',$v['packstartime']) == $startime ){
//									var_dump(date('Y-m-d',$v['packstartime']));
									$fg +=1;
									if($v['package']=='v2'){//普通版网校
									   $fg2 +=1;
									}elseif($v['package']=='v3'){//vip版
										$fg3 +=1;
									}
								}
							}
							}
						}
					}
					$day[$key]  = $flag;
					$day2[$key] = $flag2;
					$day3[$key] = $flag3;
				}
				$day[count($prenAry)]  = $fg;
				$day2[count($prenAry)] = $fg2;
				$day3[count($prenAry)] = $fg3;
				$day4[count($prenAry)] = '其他';
				$startday   = date("Y/m/d",mktime(0,0,0,date("m"),date("d")-$wday+1,date("Y")));
				$endday     = date("Y/m/d",mktime(0,0,0,date("m"),date("d")-$wday+7,date("Y")));
				break;
			case 2:
			    foreach($prenAry as $key =>$val){
			        $flag = 0;$flag2 = 0;$flag3 = 0;
			        $fg = 0;$fg2 = 0;$fg3 = 0;
			        $day4[$key] = $val['city'];
				    $daysInMnth = date('t',mktime(0,0,0,$month,1,$year));
				   for($i = 1 ;$i<=$daysInMnth;$i++){
					   if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					    $startime = date("Y-m-".$ii);
						foreach($wxinfo as $k =>$v){

							if($v['provinceid']==$val['id']){
								if(date('Y-m-d',$v['packstartime']) == $startime ){
//									var_dump(date('Y-m-d',$v['packstartime']));
									$flag +=1;
									if($v['package']=='v2'){//普通版网校
									   $flag2 +=1;
									}elseif($v['package']=='v3'){//vip版
										$flag3 +=1;
									}
								}
							}
							if($key==count($prenAry)-1){
								if($v['provinceid']==0){
								if(date('Y-m-d',$v['packstartime']) == $startime ){
//									var_dump(date('Y-m-d',$v['packstartime']));
									$fg +=1;
									if($v['package']=='v2'){//普通版网校
									   $fg2 +=1;
									}elseif($v['package']=='v3'){//vip版
										$fg3 +=1;
									}
								}
							}
							}
						}
					}
					$day[$key]  = $flag;
					$day2[$key] = $flag2;
					$day3[$key] = $flag3;
				}
				$day[count($prenAry)]  = $fg;
				$day2[count($prenAry)] = $fg2;
				$day3[count($prenAry)] = $fg3;
				$day4[count($prenAry)] = '其他';
				$startday   = date('Y/m/d',mktime(0,0,0,date('m'),1,date('Y')));
				$endday     = date('Y/m/d',mktime(0,0,0,date('m'),date('t'),date('Y')));
				break;
			case 3:
	       	    $daysInMnth = date('t',mktime(0,0,0,$month,1,$year));
			    $season     = ceil((date('n'))/3);//当月是第几季度
			    $firstday   = date('z', mktime(0, 0, 0,$season*3-3+1,1,date('Y')));
			    $lastday    = date('z', mktime(23,59,59,$season*3,date('t',mktime(0,0,0,$season*3,1,date("Y"))),date('Y')));
			    $daysInMnth = $lastday-$firstday;
			    foreach($prenAry as $key =>$val){
			        $flag = 0;$flag2 = 0;$flag3 = 0;
			        $fg = 0;$fg2 = 0;$fg3 = 0;
			        $day4[$key] = $val['city'];

					for($i = 1 ;$i<=$daysInMnth;$i++){
					   if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					    $startime = date('Y-m-d', mktime(0, 0, 0,$season*3-3+1,1+$i,date('Y')));
						foreach($wxinfo as $k =>$v){

							if($v['provinceid']==$val['id']){
								if(date('Y-m-d',$v['packstartime']) == $startime ){
//									var_dump(date('Y-m-d',$v['packstartime']));
									$flag +=1;
									if($v['package']=='v2'){//普通版网校
									   $flag2 +=1;
									}elseif($v['package']=='v3'){//vip版
										$flag3 +=1;
									}
								}
							}
							if($key==count($prenAry)-1){
								if($v['provinceid']==0){
								if(date('Y-m-d',$v['packstartime']) == $startime ){
//									var_dump(date('Y-m-d',$v['packstartime']));
									$fg +=1;
									if($v['package']=='v2'){//普通版网校
									   $fg2 +=1;
									}elseif($v['package']=='v3'){//vip版
										$fg3 +=1;
									}
								}
							}
							}
						}
					}
					$day[$key]  = $flag;
					$day2[$key] = $flag2;
					$day3[$key] = $flag3;
				}
				$day[count($prenAry)]  = $fg;
				$day2[count($prenAry)] = $fg2;
				$day3[count($prenAry)] = $fg3;
				$day4[count($prenAry)] = '其他';
				$startday   = date('Y/m/d', mktime(0, 0, 0,$season*3-3+1,1,date('Y')));
			    $endday     = date('Y/m/d', mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y')));
				break;
			case 4:
			    foreach($prenAry as $key =>$val){
			        $flag = 0;$flag2 = 0;$flag3 = 0;
			        $fg = 0;$fg2 = 0;$fg3 = 0;
			        $day4[$key] = $val['city'];

					for($i = 1 ;$i<=12;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					    $startime = date("Y-".$ii);
						foreach($wxinfo as $k =>$v){

							if($v['provinceid']==$val['id']){
								if(date('Y-m',$v['packstartime']) == $startime ){
//									var_dump(date('Y-m-d',$v['packstartime']));
									$flag +=1;
									if($v['package']=='v2'){//普通版网校
									   $flag2 +=1;
									}elseif($v['package']=='v3'){//vip版
										$flag3 +=1;
									}
								}
							}
							if($key==count($prenAry)-1){
								if($v['provinceid']==0){
								if(date('Y-m-d',$v['packstartime']) == $startime ){
//									var_dump(date('Y-m-d',$v['packstartime']));
									$fg +=1;
									if($v['package']=='v2'){//普通版网校
									   $fg2 +=1;
									}elseif($v['package']=='v3'){//vip版
										$fg3 +=1;
									}
								}
							}
							}
						}
					}
					$day[$key]  = $flag;
					$day2[$key] = $flag2;
					$day3[$key] = $flag3;
				}
				$day[count($prenAry)]  = $fg;
				$day2[count($prenAry)] = $fg2;
				$day3[count($prenAry)] = $fg3;
				$day4[count($prenAry)] = '其他';
				$startday   = date("Y",time()).'/01/01';
				$endday     = date("Y",time()).'/12/31';
				break;
		}
		$result['day2']       = $day2;
		$result['day']        = $day;
		$result['day3']        = $day3;
		$result['day4']        = $day4;
		$result['startday']   = $startday;
		$result['endday']     = $endday;
		header('Content-Type:application/json;charset=utf-8');
		echo json_encode($result);
	}
	/*套餐收入*/
	public function wxpackageAction(){
		$Model = M('common_order_info');
		$Modelinfo = M('common_order');
		$wxinfo = $Model->getAll(' as a left join '.$Modelinfo->table.' as b on a.orderid = b.orderid where (b.type=1 or b.type=7) and (a.appname="普通用户版" or a.appname="VIP版")','b.type,b.adddate,a.sumprice,a.appname');
		$option         =  KS_G('post.option');
		$year       = date('Y');
		$month      = date('n');
		$day        = array();
		$day2       = array();
		$day3       = array();
		switch($option){
			case 1:
			    if(date("w")==0){$wday = 7;}else{$wday = date("w");}
				for($i = 1 ;$i<=7;$i++){
					$flag = 0;$flag2 = 0;$flag3 = 0;
					$startime = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$wday+$i,date("Y")));
					//var_dump($startime);exit;
					foreach($wxinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$flag +=$v['sumprice'];
							if($v['appname']=='普通用户版'||$v['type']==7){//普通版网校
							   $flag2 +=$v['sumprice'];
							}elseif($v['appname']=='VIP版'){//vip版
								$flag3 +=$v['sumprice'];
							}
						}
					}
					$day[$i-1]  = $flag;
					$day2[$i-1] = $flag2;
					$day3[$i-1] = $flag3;
					$day4[$i-1] = $i;
				}
				$startday   = date("Y/m/d",mktime(0,0,0,date("m"),date("d")-$wday+1,date("Y")));
				$endday     = date("Y/m/d",mktime(0,0,0,date("m"),date("d")-$wday+7,date("Y")));
				break;
			case 2:
			    $daysInMnth = date('t',mktime(0,0,0,$month,1,$year));
				for($i = 1 ;$i<=$daysInMnth;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;$flag2 = 0;$flag3 = 0;
					$startime = date("Y-m-".$ii);
					foreach($wxinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$flag +=$v['sumprice'];
							if($v['appname']=='普通用户版' ||$v['type']==7){//普通版网校
							   $flag2 +=$v['sumprice'];
							}elseif($v['appname']=='VIP版'){//vip版
								$flag3 +=$v['sumprice'];
							}
						}
					}
					$day[$i-1]  = $flag;
					$day2[$i-1] = $flag2;
					$day3[$i-1] = $flag3;
					$day4[$i-1] = $i;
					$startday   = date('Y/m/d',mktime(0,0,0,date('m'),1,date('Y')));
					$endday     = date('Y/m/d',mktime(0,0,0,date('m'),date('t'),date('Y')));
				}break;
			case 3:
			    $season     = ceil((date('n'))/3);//当月是第几季度
			    $firstday   = date('z', mktime(0, 0, 0,$season*3-3+1,1,date('Y')));
			    $lastday    = date('z', mktime(23,59,59,$season*3,date('t',mktime(0,0,0,$season*3,1,date("Y"))),date('Y')));
			    $daysInMnth = $lastday-$firstday;
				for($i = 1 ;$i<=$daysInMnth;$i++){
					$flag = 0;$flag2 = 0;$flag3 = 0;
					$startime = date('Y-m-d', mktime(0, 0, 0,$season*3-3+1,1+$i,date('Y')));
					foreach($wxinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$flag +=$v['sumprice'];
							if($v['appname']=='普通用户版'||$v['type']==7){//普通版网校
							   $flag2 +=$v['sumprice'];
							}elseif($v['appname']=='VIP版'){//vip版
								$flag3 +=$v['sumprice'];
							}
						}
					}
					$day[$i-1]  = $flag;
					$day2[$i-1] = $flag2;
					$day3[$i-1] = $flag3;
					$day4[$i-1] = $i;
					$startday   = date('Y/m/d', mktime(0, 0, 0,$season*3-3+1,1,date('Y')));
			        $endday     = date('Y/m/d', mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y')));
				}
				//echo json_encode(array('payorder'=>$day2,'ordermoney'=>$day,'startday'=>$startday,'endday'=>$endday,'dateHours'=>$day3));exit;
				break;
			case 4:
			    for($i = 1 ;$i<=12;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;$flag2 = 0;$flag3 = 0;
					$startime = date("Y-".$ii);
					foreach($wxinfo as $k =>$v){
						if(date('Y-m',$v['adddate']) == $startime ){
							$flag +=$v['sumprice'];
							if($v['appname']=='普通用户版'||$v['type']==7){//普通版网校
							   $flag2 +=$v['sumprice'];
							}elseif($v['appname']=='VIP版'){//vip版
								$flag3 +=$v['sumprice'];
							}
						}
					}
					$day[$i-1]  = $flag;
					$day2[$i-1] = $flag2;
					$day3[$i-1] = $flag3;
					$day4[$i-1] = $i;
					$startday   = date("Y",time()).'/01/01';
					$endday     = date("Y",time()).'/12/31';
				}break;
		}
		$result['day2']       = $day2;
		$result['day']        = $day;
		$result['day3']        = $day3;
		$result['day4']        = $day4;
		$result['startday']   = $startday;
		$result['endday']     = $endday;
		header('Content-Type:application/json;charset=utf-8');
		echo json_encode($result);
	}

	public function salesAction(){
		$Model = M('common_order_info');
		$Modelinfo = M('common_order');
		$wxinfo = $Model->getAll(' as a left join '.$Modelinfo->table.' as b on a.orderid = b.orderid where b.type=2','a.sumprice,b.adddate,a.appid');
		$option         =  KS_G('post.option');
		$year       = date('Y');
		$month      = date('n');
		$day        = array();
		$day2       = array();
		$day3       = array();
		$summoney=0;
//		var_dump($wxinfo);
//		exit;
//
		switch($option){
			case 1:
			$flag = 0;$flag2 = 0;$flag3 = 0;$flag4 = 0;$flag5 = 0;$flag6 = 0;
			    if(date("w")==0){$wday = 7;}else{$wday = date("w");}
				for($i = 1 ;$i<=7;$i++){

					$startime = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$wday+$i,date("Y")));
					//var_dump($startime);exit;
					foreach($wxinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$summoney += $v['sumprice'];
							if($v['appid']==1){
								$flag+=$v['sumprice'];
							}elseif($v['appid']==2){
								$flag2+=$v['sumprice'];
							}elseif($v['appid']==3){
								$flag3+=$v['sumprice'];
							}elseif($v['appid']==4){
								$flag4+=$v['sumprice'];
							}elseif($v['appid']==5){
								$flag5+=$v['sumprice'];
							}elseif($v['appid']==6){
								$flag6+=$v['sumprice'];
							}

						}
					}

				}
				$day  = $flag;
				$day2 = $flag2;
				$day3 = $flag3;
				$day4 = $flag4;
				$day5 = $flag5;
				$day6 = $flag6;
				$startday   = date("Y/m/d",mktime(0,0,0,date("m"),date("d")-$wday+1,date("Y")));
				$endday     = date("Y/m/d",mktime(0,0,0,date("m"),date("d")-$wday+7,date("Y")));
				break;
			case 2:
			$flag = 0;$flag2 = 0;$flag3 = 0;$flag4 = 0;$flag5 = 0;$flag6 = 0;
			    $daysInMnth = date('t',mktime(0,0,0,$month,1,$year));
				for($i = 1 ;$i<=$daysInMnth;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}

					$startime = date("Y-m-".$ii);
					foreach($wxinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$summoney += $v['sumprice'];
							if($v['appid']==1){
								$flag+=$v['sumprice'];
							}elseif($v['appid']==2){
								$flag2+=$v['sumprice'];
							}elseif($v['appid']==3){
								$flag3+=$v['sumprice'];
							}elseif($v['appid']==4){
								$flag4+=$v['sumprice'];
							}elseif($v['appid']==5){
								$flag5+=$v['sumprice'];
							}elseif($v['appid']==6){
								$flag6+=$v['sumprice'];
							}
						}
					}

				}
				$day  = $flag;
				$day2 = $flag2;
				$day3 = $flag3;
				$day4 = $flag4;
				$day5 = $flag5;
				$day6 = $flag6;
				$startday   = date('Y/m/d',mktime(0,0,0,date('m'),1,date('Y')));
				$endday     = date('Y/m/d',mktime(0,0,0,date('m'),date('t'),date('Y')));
				break;
			case 3:
			$flag = 0;$flag2 = 0;$flag3 = 0;$flag4 = 0;$flag5 = 0;$flag6 = 0;
			    $season     = ceil((date('n'))/3);//当月是第几季度
			    $firstday   = date('z', mktime(0, 0, 0,$season*3-3+1,1,date('Y')));
			    $lastday    = date('z', mktime(23,59,59,$season*3,date('t',mktime(0,0,0,$season*3,1,date("Y"))),date('Y')));
			    $daysInMnth = $lastday-$firstday;
				for($i = 1 ;$i<=$daysInMnth;$i++){
					$startime = date('Y-m-d', mktime(0, 0, 0,$season*3-3+1,1+$i,date('Y')));
					foreach($wxinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$summoney += $v['sumprice'];
							if($v['appid']==1){
								$flag+=$v['sumprice'];
							}elseif($v['appid']==2){
								$flag2+=$v['sumprice'];
							}elseif($v['appid']==3){
								$flag3+=$v['sumprice'];
							}elseif($v['appid']==4){
								$flag4+=$v['sumprice'];
							}elseif($v['appid']==5){
								$flag5+=$v['sumprice'];
							}elseif($v['appid']==6){
								$flag6+=$v['sumprice'];
							}
						}
					}

				}
				$day  = $flag;
				$day2 = $flag2;
				$day3 = $flag3;
				$day4 = $flag4;
				$day5 = $flag5;
				$day6 = $flag6;
					$startday   = date('Y/m/d', mktime(0, 0, 0,$season*3-3+1,1,date('Y')));
			        $endday     = date('Y/m/d', mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y')));
				//echo json_encode(array('payorder'=>$day2,'ordermoney'=>$day,'startday'=>$startday,'endday'=>$endday,'dateHours'=>$day3));exit;
				break;
			case 4:
			$flag = 0;$flag2 = 0;$flag3 = 0;$flag4 = 0;$flag5 = 0;$flag6 = 0;
					$startime = date("Y",time());
					foreach($wxinfo as $k =>$v){
						if(date('Y',$v['adddate']) == $startime ){
							$summoney += $v['sumprice'];
							if($v['appid']==1){
								$flag+=$v['sumprice'];
							}elseif($v['appid']==2){
								$flag2+=$v['sumprice'];
							}elseif($v['appid']==3){
								$flag3+=$v['sumprice'];
							}elseif($v['appid']==4){
								$flag4+=$v['sumprice'];
							}elseif($v['appid']==5){
								$flag5+=$v['sumprice'];
							}elseif($v['appid']==6){
								$flag6+=$v['sumprice'];
							}
						}
					}

				$day  = $flag;
				$day2 = $flag2;
				$day3 = $flag3;
				$day4 = $flag4;
				$day5 = $flag5;
				$day6 = $flag6;
				$startday   = date("Y",time()).'/01/01';
				$endday     = date("Y",time()).'/12/31';
				break;
		}
		$result['day2']       = $day2;
		$result['day']        = $day;
		$result['day3']        = $day3;
		$result['day4']        = $day4;
		$result['day5']        = $day5;
		$result['day6']        = $day6;
		$result['startday']   = $startday;
		$result['endday']     = $endday;
		$result['summoney']   = $summoney;
 		header('Content-Type:application/json;charset=utf-8');
		echo json_encode($result);
	}
}