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

namespace Kesion\Model\Application;
use Kesion\Model;
class LogModel extends Model{
	//余额不够的情况，先充值，再扣钱 (对平台)
	public function paylog($loginfo,$type,$orderinfodetail=[]){
		$website                = $this->cache->GetHCache('website',$loginfo['wxid']);
	    $Money                  = $website['money'];
	    //1:支付服务的时候2:支付套餐的时候3:H5支付课程的时候
	    switch($type){
	    	case 1:$Datapl['mark']      = '购买'.$orderinfodetail['appname'].'，用户余额不充足，充值';
	    	       $Dataplt['mark']     = '购买'.$orderinfodetail['appname'].'，用户余额充足，直接余额扣款';break;
	    	case 2:$Datapl['mark']      = '网校升级套餐余额不充足，充值';
	    	       $Dataplt['mark']     = '网校升级套餐余额充足，直接余额扣款';break;
	    	case 3:$Datapl['mark']      = '购买服务，用户余额不充足，充值';
	    	       $Dataplt['mark']     = '购买服务，用户余额充足，直接余额扣款';break;
	    }
		//这个情况就是调用支付接口（先充值）
        $pay_log                = M('common_pay_log');
		$Datapl['linepaytype'] = isset($loginfo['linepaytype'])?$loginfo['linepaytype']:2;
	    $Datapl['userid']       = $loginfo['userid'];
	    $Datapl['wxid']         = $loginfo['wxid'];
	    $Datapl['adddate']      = time();
	    $Datapl['cmoney']       = $loginfo['order_amount'];
	    $Datapl['balance']      = $loginfo['order_amount']+$Money;
	    $Datapl['type']         = 0;
	    $Datapl['userip']       = $loginfo['userip'];

	    //$_SERVER['REMOTE_ADDR'];
	    //这个情况就是调用支付接口（去扣钱咯）
//		if ($loginfo['order_amount']>0&&$website['salesmantype']==1&&!empty(ChkClng($website['salesman']))&&$website['istry']==0&&ChkClng(KS_G('post.is_sales',1))==1){
//			$Dataplt['salesman'] = $website['salesman'];
//			$res = getSalesincome($loginfo['order_amount'],2);
//			
//			$Dataplt['salesincome'] = $res['salesincome'];
//			$Dataplt['salescommission'] = $res['salescommission'];
//		}
		$Dataplt['linepaytype']  = isset($loginfo['linepaytype'])?$loginfo['linepaytype']:2;
	    $Dataplt['userid']      = $loginfo['userid'];
	    $Dataplt['wxid']        = $loginfo['wxid'];
	    $Dataplt['adddate']     = time();
	    $Dataplt['cmoney']      = $loginfo['order_amount'];
	    $Dataplt['balance']     = $Money;
	    $Dataplt['type']        = 1;
	    $Dataplt['userip']      = $loginfo['userip'];
	    $pay_log->doAdd($Datapl,'id');  //充钱
	    $pay_log->doAdd($Dataplt,'id'); //扣钱
	}
	//余额不够的情况，先充值(对平台)
	public function rechargelog($loginfo,$type){
		$website                = $this->cache->GetHCache('website',$loginfo['wxid']);
	    $Money                  = $website['money'];
	    //1:支付服务的时候2:支付套餐的时候3:H5支付课程的时候4.直接充值
	    if(isset($loginfo['mark'])&&!empty($loginfo['mark'])){
	    	    $Data['mark']          = $loginfo['mark'];
	    }else{
	    	switch($type){
		    	case 1:$Data['mark']   = '购买服务，用户余额不充足，充值';break;
		    	case 2:$Data['mark']   = '网校升级套餐余额不充足，充值';break;
		    	case 3:$Data['mark']   = '购买服务，用户余额不充足，充值';break;
		    	case 4:$Data['mark']   = '网校用户直接为自己充值';  break;
		    	default :$Data['mark']   = '';
	        }
	    }
		//这个情况就是调用支付接口（先充值）
        $pay_log              = M('common_pay_log');
	    $Data['linepaytype'] = isset($loginfo['linepaytype'])?$loginfo['linepaytype']:2;
	    $Data['wxid']         = $loginfo['wxid'];
	    $Data['adddate']      = time();
	    $Data['cmoney']       = $loginfo['order_amount'];
	    $Data['balance']      = $loginfo['order_amount']+$Money;
	    $Data['type']         = 0;
	    $Data['userip']       = $loginfo['userip'];
	    $Data['linepaytype']  = $loginfo['linepaytype'];
	    $pay_log->doAdd($Data,'id');
	}
	/**
     * 余额不够的情况，先充值(对学员)
     * @param mixed $loginfo
	 * @param mixed $Money
	 * @param mixed $type
	 */
	public function memberlog($loginfo,$Money,$type){
	    //1:支付服务的时候2:支付套餐的时候3:H5支付课程的时候
	    if(isset($loginfo['mark'])&&!empty($loginfo['mark'])){
	    	    $Data['mark']          = $loginfo['mark'];
	    }else{
	    	switch($type){
		    	case 1:$Data['mark']   = '用户通过小课堂使用支付宝进行充值';break;
		    	case 2:$Data['mark']   = '网校升级套餐余额不充足，充值';break;
		    	case 3:$Data['mark']   = '购买服务，用户余额不充足，充值';break;
		    	case 4:$Data['mark']   =  '购买课程'.$loginfo['title'];break;
		    	case 5:$Data['mark']   =  '使用余额购买'.$loginfo['title'];break;
		    	case 7:$Data['mark']   =  '用户通过微门户使用微信进行充值';break;

	        }
	    }
		//插入订单明细表
		$Data['linepaytype'] = isset($loginfo['linepaytype'])?$loginfo['linepaytype']:0;
		$Data['wxid']        = $loginfo['wxid'];
		$Data['memberid']    = $loginfo['memberid'];
		$Data['adddate']     = time();
		$Data['cmoney']      = $loginfo['order_amount'];
		$Data['balance']     = $loginfo['order_amount']+$Money;
		$Data['type']        = 0;  //1支出 0充值
		$Data['memberip']    = $loginfo['memberip'];
		$pay_log             = M('app_pay_log');
		$pay_log->doAdd($Data,'id');
	}
	/**
     * 余额够的情况，学员支付(对学员)
	 * @param mixed $loginfo
	 * @param mixed $Money
	 * @param mixed $type
	 */
	public function memberpaylog($loginfo,$Money,$type=1){
	    //1:支付服务的时候2:支付套餐的时候3:H5支付课程的时候
	    if(isset($loginfo['mark'])&&!empty($loginfo['mark'])){
	    	    $Data['mark']          = $loginfo['mark'];
	    }else{
	    	switch($type){
		    	case 1:$Data['mark']   = '用户使用通过小课堂使用支付宝进行支付';
		    	case 2:$Data['mark']   = '网校升级套餐余额不充足，支付';
		    	case 3:$Data['mark']   = '购买服务，用户余额不充足，支付';
				case 4:$Data['mark']   =  '购买课程'.$loginfo['title'];break;
		    	case 5:$Data['mark']   =  '使用余额购买'.$loginfo['title'];break;
		    	case 7:$Data['mark']   =  '用户使用通过微门户使用微信进行充值';break;
	        }
	    }
		//插入订单明细表
		$Data['linepaytype'] = isset($loginfo['linepaytype'])?$loginfo['linepaytype']:0;
		$Data['wxid']        = $loginfo['wxid'];
		$Data['memberid']    = $loginfo['memberid'];
		$Data['adddate']     = time();
		$Data['cmoney']      = $loginfo['order_amount'];
		$Data['balance']     = $Money;
		$Data['type']        = 1;   //1支出 0充值
		$Data['memberip']    = $loginfo['memberip'];
		$pay_log             = M('app_pay_log');
		$pay_log->doAdd($Data,'id');
	}
	//查看购物车的数量
	public function cartnum($Data=array()){
		$wxid      = isset($Data['wxid'])?$Data['wxid']:$GLOBALS['_DoM']['wxid'];
		$option    = null !==GF('option') ? GF('option'):'4'; //升序和降序
		$shopModel = M('common_cart');
		$count     = $shopModel->getOne('count(*)',"where wxid=".$wxid);
		return $count;
	}
	//查看购物车的总金额
	public function cartmoney($Data=array()){
		$wxid      = isset($Data['wxid'])?$Data['wxid']:$GLOBALS['_DoM']['wxid'];
		$option    = null !==GF('option') ? GF('option'):'4'; //升序和降序
		$shopModel = M('common_cart');
		$count     = $shopModel->getOne('sum(price)',"where wxid=".$wxid);
		return $count;
	}
	//统计订单
	public function orderdata($Data){
		$Model     = M('app_order');
		$orderinfo = $Model->getAll("where wxid=".$GLOBALS['_DoM']['wxid']." and status !=-1");
		$year       = date('Y');
		$month      = date('n');
		$day        = array();
		$day2       = array();
		switch($Data['type']){
			case 1:
			    if(date("w")==0){$wday = 7;}else{$wday = date("w");}
				for($i = 1 ;$i<=7;$i++){
					$flag = 0;$flag2 = 0;
					$startime = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$wday-7+$i,date("Y")));
					//var_dump($startime);exit;
					foreach($orderinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							if($v['paystatus']==1){//已支付订单数
							   $flag2 +=1;
							   $flag  +=$v['order_amount'];//销售订单金额
							}
						}
					}
					$day[$i-1]  = $flag;
					$day2[$i-1] = $flag2;
					$day3[$i-1] = date("m-d",mktime(0,0,0,date("m"),date("d")-$wday-7+$i,date("Y")));
				}
				$startday   = date("Y/m/d",mktime(0,0,0,date("m"),date("d")-$wday-6,date("Y")));
				$endday     = date("Y/m/d",mktime(0,0,0,date("m"),date("d")-$wday,date("Y")));
				break;
			case 2:
			    if(date("w")==0){$wday = 7;}else{$wday = date("w");}
				$firstday   = date("z",mktime(0,0,0,date("m"),date("d")-$wday+1,date("Y")));
				$lastday    = date("z",mktime(0,0,0,date("m"),date("d")-$wday+7,date("Y")));
				$daysInMnth = $lastday-$firstday;
				for($i = 1 ;$i<=7;$i++){
					$flag = 0;$flag2 = 0;
					$startime = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$wday+$i,date("Y")));
					//var_dump($startime);exit;
					foreach($orderinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							if($v['paystatus']==1){//已支付订单数
							   $flag2 +=1;
							   $flag  +=$v['order_amount'];//销售订单金额
							}
						}
					}
					$day[$i-1]  = $flag;
					$day2[$i-1] = $flag2;
					$day3[$i-1] = date("m-d",mktime(0,0,0,date("m"),date("d")-$wday+$i,date("Y")));
				}
				$startday   = date("Y/m/d",mktime(0,0,0,date("m"),date("d")-$wday+1,date("Y")));
				$endday     = date("Y/m/d",mktime(0,0,0,date("m"),date("d")-$wday+7,date("Y")));
				break;
			case 3:
			    $daysInMnth = date('t',mktime(0,0,0,$month,1,$year));
				for($i = 1 ;$i<=$daysInMnth;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;$flag2 = 0;
					$startime = date("Y-m-".$ii);
					foreach($orderinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							if($v['paystatus']==1){//已支付订单数
							   $flag2 +=1;
							   $flag  +=$v['order_amount'];//销售订单金额
							}
						}
					}
					$day_x[$i-1]  = $flag;
					$day2_x[$i-1] = $flag2;
					$day3_x[$i-1] = date('m-d',mktime(0,0,0,date('m'),$i,date('Y')));
					$startday   = date('Y/m/d',mktime(0,0,0,date('m'),1,date('Y')));
					$endday     = date('Y/m/d',mktime(0,0,0,date('m'),date('t'),date('Y')));
				}
				$day[0] = $day_x[0];
				$day[6] = $day_x[6];
				$day[13] = $day_x[13];
				$day[20] = $day_x[20];
				$day[26] = $day_x[26];
				$day3[0] = $day3_x[0];
				$day3[6] = $day3_x[6];
				$day3[13] = $day3_x[13];
				$day3[20] = $day3_x[20];
				$day3[26] = $day3_x[26];
				$day = array_values($day);
				$day3 = array_values($day3);
//				var_dump($day);die;
//				for ($i=1;$i<=4;$i++){
//					if ($i=1){
//						$key = 1;
//					}else{
//						$key = $i*7;
//					}
//					$day[$i] =  $day_x[$key];
//					$day3[$i] = $day3_x[$key];
//				}
				break;
			case 4:
			    $season     = ceil((date('n'))/3);//当月是第几季度
//			    $firstday   = date('z', mktime(0, 0, 0,$season*3-3+1,1,date('Y')));
//			    $lastday    = date('z', mktime(23,59,59,$season*3,date('t',mktime(0,0,0,$season*3,1,date("Y"))),date('Y')));
//			    $daysInMnth = $lastday-$firstday;
				for($i = 1 ;$i<=3;$i++){
					$flag     = 0;$flag2 = 0;
					$startime = date('Y-m', mktime(0, 0, 0,$season*3-3+$i,1,date('Y')));
					foreach($orderinfo as $k =>$v){
						if(date('Y-m',$v['adddate']) == $startime ){
							if($v['paystatus']==1){//已支付订单数
							   $flag2 +=1;
							   $flag  +=$v['order_amount'];//销售订单金额
							}
						}
					}
					$day[$i-1]  = $flag;
					$day2[$i-1] = $flag2;
					$day3[$i-1] = date('m月', mktime(0, 0, 0,$season*3-3+$i,1,date('Y')));
				}
				$startday   = date('Y/m/d', mktime(0, 0, 0,$season*3-3+1,1,date('Y')));
				$endday     = date('Y/m/d', mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y')));
//				$result['count']       = $day2;
				$result['money']        = $day;
				$result['startday']   = $startday;
				$result['endday']     = $endday;
				$result['day3']       = $day3;
				return $result;
				//echo json_encode(array('payorder'=>$day2,'ordermoney'=>$day,'startday'=>$startday,'endday'=>$endday,'dateHours'=>$day3));exit;
				break;
			case 5:
			    for($i = 1 ;$i<=12;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;$flag2 = 0;
					$startime = date("Y-".$ii);
					foreach($orderinfo as $k =>$v){
						if(date('Y-m',$v['adddate']) == $startime ){
							if($v['paystatus']==1){//已支付订单数
							   $flag2 +=1;
							   $flag  +=$v['order_amount'];//销售订单金额
							}
						}
					}
					$day[$i-1]  = $flag;
					$day2[$i-1] = $flag2;
					$day3[$i-1] = date("Y-".$ii);;
					$startday   = date("Y",time()).'/01/01';
					$endday     = date("Y",time()).'/12/31';;
				}break;
			case 6://按天算
				for($i=0;$i<=23;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag     = 0;$flag2 = 0;
					$startime = date('Y-m-d '.$ii);
					foreach($orderinfo as $k =>$v){
						if(date('Y-m-d H',$v['adddate']) == $startime){
							$flag +=1;//总订单数
							if($v['paystatus']==1){//已支付订单数
							   $flag2 +=1;
							}
						}
					}
					$day[$i] = $flag;
					$day2[$i] = $flag2;
				}break;
		}
//		$result['count']      = $day2;
		$result['money']      = $day;
		$result['date']       = $day3;
		$result['startday']   = $startday;
		$result['endday']     = $endday;
		return $result;
	}


	public function  recombine($sum,$type,$num){
		$year       = date('Y');
		$month      = date('n');
		$day        = array();
		$day2       = array();
		switch($type){
			case 1:
			    if(date("w")==0){$wday = 7;}else{$wday = date("w");}
				for($i = 1 ;$i<=7;$i++){
					$flag = 0;
					$startime = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$wday-7*$num+$i,date("Y")));
					//var_dump($startime);exit;
					foreach($sum as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							   $flag +=1;
						}
					}
					$day[$i-1]  = $flag;
					$day3[$i-1] = date("Y/m/d",mktime(0,0,0,date("m"),date("d")-$wday+1-$num*7+$i,date("Y")));
				}
					$startday   = date("Y/m/d",mktime(0,0,0,date("m"),date("d")-$wday+1-$num*7,date("Y")));
					$endday     = date("Y/m/d",mktime(0,0,0,date("m"),date("d")-$wday+7-$num*7,date("Y")));
					break;

			case 2:
			    $daysInMnth = date('t',mktime(0,0,0,$month-$num,1,$year));
				for($i = 1 ;$i<=$daysInMnth;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;
					$startime = date("Y-m-".$ii);
					foreach($sum as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							   $flag +=1;
						}
					}
					$day[$i-1]  = $flag;
					$day3[$i-1] = $startday   = date('Y/m/d',mktime(0,0,0,date('m')-$num,1+$i,date('Y')));
				}
				$startday   = date('Y/m/d',mktime(0,0,0,date('m')-$num,1,date('Y')));
				$endday     = date('Y/m/d',mktime(0,0,0,date('m')-$num,$daysInMnth,date('Y')));
				break;
			case 3:
			    $season     = ceil((date('n'))/3-$num);//当月是第几季度
			    $firstday   = date('z', mktime(0, 0, 0,$season*3-3+1,1,date('Y')));
			    $lastday    = date('z', mktime(23,59,59,$season*3,date('t',mktime(0,0,0,$season*3,1,date("Y"))),date('Y')));
			    $daysInMnth = $lastday-$firstday;
				for($i = 1 ;$i<=$daysInMnth;$i++){
					$flag     = 0;
					$startime = date('Y-m-d', mktime(0, 0, 0,$season*3-3+1,1+$i,date('Y')));
					foreach($sum as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							   $flag +=1;
						}
					}
					$day[$i-1]  = $flag;
					$day3[$i-1] = date('m/d', mktime(0, 0, 0,$season*3-3+1,1+$i,date('Y')));
					$startday   = date('Y/m/d', mktime(0, 0, 0,$season*3-3+1,1,date('Y')));
			        $endday     = date('Y/m/d', mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y')));
				}

//				$result['day3']       = $day3;
				//echo json_encode(array('payorder'=>$day2,'ordermoney'=>$day,'startday'=>$startday,'endday'=>$endday,'dateHours'=>$day3));exit;
				break;
			case 4:
			    for($i = 1 ;$i<=12;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;
					$startime = date("Y")-$num;
					$startime =$startime.$ii;


					foreach($sum as $k =>$v){
						if(date('Ym',$v['adddate']) == $startime ){
							   $flag+=1;
						}

					}
					$day[$i-1]  = $flag;
					$day3[$i-1] = date('m',mktime(0,0,0,$i,1,date('Y')-$num));
					$startday   = date("Y",time())-$num.'/01/01';
					$endday     = date("Y",time())-$num.'/12/31';
				}break;
		}
		$result['day']        = $day;
		$result['dataX']        = $day3;
		$result['max']        =max($day);
		$result['min']        =min($day);
		$result['startday']   = $startday;
		$result['endday']     = $endday;
		return $result;
	}
}