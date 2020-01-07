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



namespace Kesion\Model\App;
use Kesion\Model;
class PayModel extends Model{
	public function status0($wxid){
		 $sql = "UPDATE $this->table SET status=0 where wxid=$wxid";
		 $GLOBALS['db']->execSql($sql);
	}
	public function status1($id,$wxid){
		 foreach($id as $key =>$v){
		    $sql = "UPDATE $this->table SET status=1 where id=$v and wxid=$wxid";
		    $GLOBALS['db']->execSql($sql);
		 }
	}
	public function Isdefault0($wxid){
		 $sql = "UPDATE $this->table SET Isdefault=0 where wxid=$wxid";
		 $GLOBALS['db']->execSql($sql);
	}
	public function Isdefault1($id,$wxid){
		 $sql = "UPDATE $this->table SET Isdefault=1 where id=$id and wxid=$wxid";
		 $GLOBALS['db']->execSql($sql);
    }	
    public function pay($Data){
    	$app_course     = M('app_course');
    	$this->AppModel = $app_course;
    	$payid = ChkClng(KS_G('post.payid'));
    	if($payid == 0){$payid = 1;}
    	$left_price = floatval(ChkSQL(KS_G('post.left_price')));
		$usersModel = M('common_user');
	    $Money = $usersModel->getOne('money',"where userid=$Data[memberid] limit 1");
		if(($left_price-$Money>0)){KS_INFO('金额不足',4);}
		$course_info   = M('app_order');//创建订单模型表  
		$ordersn       = ChkSQL(KS_G('post.ordersn'));
		if(!empty($ordersn)){
			$orderinfo = $course_info->getRow("where wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']." and ordersn='$ordersn' and paystatus=0 and abatestatus=0 limit 1",'order_amount,orderid');//创建加入订单
			if(empty($orderinfo)){$url = M_URL('home','class');ks_header($url);}
			$orderid = $orderinfo['orderid'];
			$courseid = '';//避免页面有人作弊，同时传进订单号和课程号，所以放进else里接收
		}else{
			list($usec, $sec)  = explode(" ", microtime());
			$DataOne['ordersn']   = $Data['memberid'].((float)$usec + (float)$sec)*10000;
			$DataOne['wxid']      = $GLOBALS['_DoM']['wxid'];
			$DataOne['userid']    = $Data['parentid'];
			$DataOne['memberid']  = $Data['memberid'];
			$DataOne['memberip']  = $_SERVER['REMOTE_ADDR'];
			if($payid==1){$DataOne['paytype']=1;}elseif($payid==2){$DataOne['paytype']=2;}
			$DataOne['adddate']   = time();
			$DataOne['paystatus'] = 0;
			$courseid = ChkClng(KS_G('post.classid'));//避免页面有人作弊，同时传进订单号和课程号，所以放进else里接收
		}
		$order_courses = M('app_order_info');//创建订单副表即订单课程部分
		$cart_course   = M('app_cart_course');//创建购物车模型表
		$red_packetnum = M('app_red_packetnum');
		$red_packet    = M('app_red_packet');
		$redpacketnum  = ChkSQL(KS_G('post.Redpacket')); 
	    $sumMoney 	   = 0;  
		//这里开始分了三种情况：1.有传进订单号，前面没支付成功的.
		//2.传进课程id,直接购买，不加入购物车.
		//3.直接从购物车里选中的商品进行结算
		if(!empty($ordersn)){
			//计算订单总金额
			$sumMoney = $orderinfo['order_amount'];
			//检查红包和总金额之间是否矛盾
			if(!empty($redpacketnum)){
			$facevalue   = $red_packetnum->getOne('b.facevalue',"as a left join `$red_packet->table` as b on a.redpacketid = b.id where a.wxid=".$GLOBALS['_DoM']['wxid']." and a.memberid=".$Data['memberid']." and b.facevalue<=".$sumMoney." and b.startime<".time()." and b.endtime>".time()." and a.isuse=0 and a.redpacketnum='".$redpacketnum."' limit 1");
			if(empty($facevalue)){KS_INFO('红包错误');};
			}
			//
			$DataOne['ordersn'] = $ordersn;
			$order_courses_courseid = $order_courses->getAll("where ordersn='$ordersn' and wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']." and paystatus=0",'courseid');
			foreach($order_courses_courseid as $k=>$v){
				 $checkcourseinfo = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid='.$v['courseid'].' limit 1','status,title');
				 if($checkcourseinfo['status']!=2){
					 $this->assign('getMessage','<a href="'.M_URL('course').'">'.$checkcourseinfo['title'].'已被下架,去看看别的课程吧</a>');
	                 $this->display('404.html');
				 }
			}
		}elseif(!empty($courseid)){
			$paystatus = $this->cache->GetU('havecourses','courseid',$courseid,'paystatus',$Data['memberid']);//读出缓存
			if($paystatus==1){$url = M_URL('course','view',$courseid);ks_header($url);}
			$order_info_orderid = $order_courses->getAll("where wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']." and courseid=$courseid and paystatus=0",'orderid');
			$biaoji = 0;//标记，一旦发现就变成1跳出
//			foreach($order_info_orderid as $k=>$v){
//				$repeat_order_count = $order_courses->getOne('count(*)',"where wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']." and orderid=$v[orderid] and paystatus=0");
//				if($repeat_order_count == 1){$DataOneThree['adddate']=time();$course_info->update($DataOneThree,"wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']." and orderid=$v[orderid] and paystatus=0");$biaoji = 1;break;}
//			}
			if($biaoji == 1){$url = M_URL('home','class');ks_header($url);}
			
		    $courseinfo = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid='.$courseid.' limit 1');
			//检查红包和总金额之间是否矛盾
			if(!empty($redpacketnum)){
			$facevalue   = $red_packetnum->getOne('b.facevalue',"as a left join `$red_packet->table` as b on a.redpacketid = b.id where a.wxid=".$GLOBALS['_DoM']['wxid']." and a.memberid=".$Data['memberid']." and b.facevalue<=".$courseinfo['price']." and b.startime<".time()." and b.endtime>".time()." and a.isuse=0 and a.redpacketnum='".$redpacketnum."' limit 1");
			if(empty($facevalue)){KS_INFO('红包错误');};
			}
			//为了不让在校验前加入数据库，所以在判断是否有传入课程id完成校验后加入订单 
			if(empty($courseinfo)){
				$this->assign('getMessage','没有该课程');
	            $this->display('404.html');
			}
			elseif($courseinfo['status']!=2){$url = M_URL('course','view',$courseid);ks_header($url);}
			$orderid = $course_info->doAdd($DataOne,'orderid');//创建加入订单
			
			$DataOnes['wxid']       = $GLOBALS['_DoM']['wxid'];
			$DataOnes['userid']     = $Data['parentid'];
			$DataOnes['memberid']   = $Data['memberid'];
			$order_courses_courseid['0'] = $DataOnes['courseid'] = $courseinfo['courseid'];
		    $DataOnes['title']      = $courseinfo['title'];
		    $DataOnes['price']      = $courseinfo['price'];
		    $DataOnes['market_price'] = $courseinfo['price_market'];
		    $DataOnes['defaultpic'] = $courseinfo['defaultpic'];
		    $DataOnes['ordersn']    = $DataOne['ordersn'];
		    $DataOnes['orderid']    = $orderid;
		    if($payid==1){$DataOnes['paytype']=1;}elseif($payid==2){$DataOnes['paytype']=2;}
			$DataOnes['adddate']    =  time();
		    $order_courses->doAdd($DataOnes,'id');//添加单个课程信息
			//删除购物车
			$cart_course->delete("wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']." and courseid=$courseid");
			$this->cache->PutUCache('cartcourse',$Data['memberid']);
			//计算订单总金额
			$sumMoney = $DataOnes['price'];
		}else{
			$coursecartinfo = $cart_course->getAll('where wxid='.$GLOBALS['_DoM']['wxid'].' and memberid='.$Data['memberid'].' and status=1');
			if(empty($coursecartinfo)){$url = M_URL('home','class');ks_header($url);} 
			foreach($coursecartinfo as $k=>$v){
				 $checkcourseinfo = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid='.$v['courseid'].' limit 1','status,title');
				 if($checkcourseinfo['status']!=2){
					 $this->assign('getMessage','<a href="'.M_URL('course').'">'.$checkcourseinfo['title'].'已被下架,去看看别的课程吧</a>');
	                 $this->display('404.html');
				 }
				 //计算订单总金额
			     $sumMoney = $sumMoney+$v['price'];
			}
			//检查红包和总金额之间是否矛盾
			if(!empty($redpacketnum)){
			$facevalue   = $red_packetnum->getOne('b.facevalue',"as a left join `$red_packet->table` as b on a.redpacketid = b.id where a.wxid=".$GLOBALS['_DoM']['wxid']." and a.memberid=".$Data['memberid']." and b.facevalue<=".$sumMoney." and b.startime<".time()." and b.endtime>".time()." and a.isuse=0 and a.redpacketnum='".$redpacketnum."' limit 1");
			if(empty($facevalue)){KS_INFO('红包错误');};
			}
			//为了不让在校验前加入数据库，所以在判断是否有传入课程id完成校验后加入订单 
		    $orderid = $course_info->doAdd($DataOne,'orderid');//创建加入订单
			foreach($coursecartinfo as $k=>$v){
			   //$courseinfo = $this->cache->GetH('courseinfo','courseid',$v,'',$GLOBALS['_DoM']['wxid'],true);
			   $DataOnes['wxid']       = $GLOBALS['_DoM']['wxid'];
			   $DataOnes['userid']     =  $Data['parentid'];
			   $DataOnes['memberid']   = $Data['memberid'];
			   $order_courses_courseid[$k] = $DataOnes['courseid'] = $v['courseid'];
			   $DataOnes['title']      = $v['title'];
			   $DataOnes['price']      = $v['price'];
			   $DataOnes['price_market'] = $v['price_market'];
			   $DataOnes['defaultpic'] = $v['defaultpic'];
			   $DataOnes['ordersn']    = $DataOne['ordersn'];
			   $DataOnes['orderid']    = $orderid;
			   $DataOnes['adddate']    =  time();
			   $order_courses->doAdd($DataOnes,'id');//添加单个课程信息,循环着添加
			 }
			 //删除购物车
			 $cart_course->delete('wxid='.$GLOBALS['_DoM']['wxid'].' and memberid='.$Data['memberid'].' and status=1');
			 $this->cache->PutUCache('cartcourse',$Data['memberid']);
		}
		$pay_log = M('app_pay_log');
		//sum_Money暂存扣除红包后的总金额
	    //sumMoney没有扣除红包后的总金额
		if(!empty($facevalue)){$sum_Money = round($sumMoney-$facevalue,2);}
		else{$sum_Money = $sumMoney;}
		if(round($sum_Money-$left_price,2)==0){
			  $DataOnepl['wxid']     =  $GLOBALS['_DoM']['wxid'];
			  $DataOnepl['userid']   =  $Data['parentid'];
			  $DataOnepl['memberid'] =  $Data['memberid'];
			  $DataOnepl['adddate']  =  time();
			  $DataOnepl['cmoney']   =  $sum_Money;
			  $DataOnepl['balance']  =  $Money-$sum_Money;
			  $DataOnepl['type']     =  1;
			  $DataOnepl['memberip'] =  $_SERVER['REMOTE_ADDR'];
			  $DataOnepl['mark']     =  '用户余额充足，直接余额扣款'.$sum_Money;
			  $pay_log->doAdd($DataOnepl,'id');
			  
			  $DataOneu['money'] = round($Money-$sum_Money,2);
			  $usersModel->update($DataOneu,"userid=$Data[memberid]");
			  if(!empty($facevalue)){
				$DataOnePacket['isuse'] = 1;  
				$red_packetnum->update($DataOnePacket,"wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']." and isuse=0 and redpacketnum='".$redpacketnum."'");  
			  }//更新红包，使用红包
			  
			  $DataOneod['paystatus']    = 1;
			  $DataOneod['order_amount'] = $sumMoney;
			  $DataOneod['adddate']      =  time();
			  $course_info->update($DataOneod,"orderid=$orderid limit 1");
			  
			  $DataOnecouse['paystatus'] = 1;
			  $order_courses->update($DataOnecouse,"wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']." and orderid=$orderid");
			  foreach($order_courses_courseid as $k=>$v){
				  if(!empty($ordersn)){$order_courses_orderid = $order_courses->getAll("where courseid=$v[courseid] and wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']." and paystatus=0",'orderid');}
				  else{$order_courses_orderid = $order_courses->getAll("where courseid=$v and wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']." and paystatus=0",'orderid');}
				  if(!empty($order_courses_orderid)){
				      $DataOneTwo['abatestatus'] = 1;
					  foreach($order_courses_orderid as $kt=>$vt)
					  {$course_info->update($DataOneTwo,"orderid=$vt[orderid] and wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']);}
				  }
			  }
			  $this->cache->PutUCache('havecourses',$Data['memberid']);
			  $url = M_URL('home','class');
		      ks_header($url);
	  }else{
			if(round($sum_Money-$left_price,2)>0){
			   $DataOneod['order_amount'] = $sumMoney;	
			   $total_fee = round($sum_Money-$left_price,2);
			   //var_dump($total_fee);exit;
			}else{KS_INFO('金额不足',4);}
		    $course_info->update($DataOneod,"ordersn=$DataOne[ordersn]");
		    $Kspay = new \Core\Kspay(array('payid' => $payid));
			$Kspay->out_trade_no = $DataOne['ordersn'];
			$Kspay->total_fee = $total_fee;
			if($payid==2){
				$Kspay->notify_url   = MY_FULLDOMAIN.'/course/wxcourseback';
				$url2 = $Kspay->pay();$type = 2;
				include  ROOT . "Plus/native.php";
			}else{
				$Kspay->return_url   = M_URL('course','courseback');
				$Kspay->pay(); 
			}
			//$Kspay->return_url = 'http://'.APP_DOMAIN.M_URL('course','back');
			//$Kspay->pay();
	    }
    }
    public function confirm($Data){
    	$app_course     = M('app_course');
	    $this->AppModel = $app_course;
		$ordersn = ChkSQL(null !==GF('ordersn') ? GF('ordersn'):'');
		if(!empty($ordersn)){
			$course_info = M('app_order');//创建订单模型表   
		    $orderinfo = $course_info->getRow("where wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']." and ordersn='$ordersn' and paystatus=0 and abatestatus=0 limit 1",'order_amount');//创建加入订单
			if(empty($orderinfo)){$url = M_URL('home','class');ks_header($url);}
			$sumMoney = $orderinfo['order_amount'];
			$order_courses = M('app_order_info');
			$dt = $order_courses->getAll("where wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']." and ordersn='$ordersn' and paystatus=0");
			foreach($dt as $k=>$v){
				$checkcourseinfo = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid='.$v['courseid'].' limit 1','status,title');
				if($checkcourseinfo['status']!=2){
					$result['situation']     = 2;//课程被下架
					$result['getMessage']    = '<a href="'.M_URL('course').'">'.$checkcourseinfo['title'].'已被下架,去看看别的课程吧</a>';
					return $result;
				}
			}
			//$this->assign('ordersn',$ordersn);
		}else{
			$courseid = ChkClng(KS_G('request.id'));
			if(!empty($courseid)){
				$paystatus = $this->cache->GetU('havecourses','courseid',$courseid,'paystatus',$Data['memberid']);//读出缓存
				if($paystatus==1){$url = M_URL('course','view',$courseid);ks_header($url);}
				$order_courses = M('app_order_info');
				$course_info = M('app_order');//创建订单模型表   
				$order_info_orderid = $order_courses->getAll("where wxid=".$GLOBALS['_DoM']['wxid']." and memberid=".$Data['memberid']." and courseid=$courseid and paystatus=0",'orderid');
				$biaoji = 0;//标记，一旦发现就变成1跳出
				if($biaoji == 1){$url = M_URL('home','class');ks_header($url);}
				$courseinfo = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid='.$courseid.' limit 1');
				if(empty($courseinfo)){
					$result['situation']     = 2;//没有该课程
					$result['getMessage']    = '<a href="'.M_URL('course').'">'.$checkcourseinfo['title'].'已被下架,去看看别的课程吧</a>';
					return $result;
				}elseif($courseinfo['status']!=2)
				{$url = M_URL('course','view',$courseid);ks_header($url);}
				$dt[0]['userid'] = $Data['memberid'];
				$dt[0]['courseid']  = $courseinfo['courseid'];
				$dt[0]['title'] = $courseinfo['title'];
				$dt[0]['defaultpic'] = $courseinfo['defaultpic'];
				$dt[0]['price'] = $courseinfo['price'];
				$dt[0]['price_market'] = $courseinfo['price_market'];
				$dt[0]['adddate'] = time();
				$sumMoney = $courseinfo['price'];
				$result['courseid']= $courseid;
			}else{
				$cart_course = M('app_cart_course');
				$dt = $this->cache->GetU('cartcourse','status',1,'',$Data['memberid']);
				if(empty($dt)){$url = M_URL('home','class');ks_header($url);}
				foreach($dt as $k=>$v){
				   $checkcourseinfo = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid='.$v['courseid'].' limit 1','status,title');
				   if($checkcourseinfo['status']!=2){
				   	   $result['situation']     = 2;//没有该课程
					   $result['getMessage']    = '<a href="'.M_URL('course').'">'.$checkcourseinfo['title'].'已被下架,去看看别的课程吧</a>';
					   return $result;
				   }
			    }
				$sumMoney = $cart_course->getOne('sum(price)',' WHERE wxid='.$GLOBALS['_DoM']['wxid'].' and memberid='.$Data['memberid'].' and status=1');
			}
		}
		$usersModel = M('common_user');
		$Money      = $usersModel->getOne('money',"where userid=$Data[memberid] limit 1");//学员的余额
		$dx_money   = $Money-$sumMoney;//余额减去总金额，$dx_money为差价。
		if($dx_money>=0){$linepay_money = $dx_money;}//如果大于0说明够钱。在线付款的金额就是为0
		else{$linepay_money = $sumMoney-$Money;}//如果小于0说明钱不够。在线付款的金额就是为总金额减去余额
		
		if($dx_money>=0){$left_price = $sumMoney;}//如果大于0说明够钱。可支付就为商品总金额就行了
		else{$left_price = $Money;}//如果小于0说明钱不够。钱不够就把余额全部付出去
		$result['situation']     = 1;//正常情况
		$result['dt']            = $dt;
		$result['Money']         = $Money;
		$result['sumMoney']      = $sumMoney;
		$result['linepay_money'] = $linepay_money;
		$result['left_price']    = $left_price;
		$result['dx_money']      = $dx_money;
		return $result;
    }
    //订单创建
    public function ordercreation($Data009){
    	if(!empty($Data009['wxid'])){$GLOBALS['_DoM']['wxid']=$Data009['wxid'];}
    	$userid = $Data009['userid'];
		$orderid                 = $Data009['orderid'];
	 	if(!empty($orderid)){//有订单了还创建个鬼呀
	 		$pays                = $orderid;
		    $order_info          = M('app_order_info');
			$orderinfo           = $order_info->getRow("where orderid=$orderid limit 1",'courseid,price,type,ordersn');
		    $shopid          	 = $orderinfo['courseid'];
		    $money        		 = $orderinfo['price'];
		    $Datass['ordersn']     = $orderinfo['ordersn'];
	 	}else{
	 		$shopid           = $Data009['shopid'];
		    $money      	  = $Data009['money'];
		    list($usec, $sec)    = explode(" ", microtime());
			$Datass['ordersn']     = $userid.((float)$usec + (float)$sec)*10000;
			$shopModel           = M('app_order');
		    $Datass['memberid']      = $userid;
		   	$Dataso['userid']=$Datass['userid']        = M('common_user')->getOne('parentid','where userid='.$userid);
		    $Datass['wxid']        = $GLOBALS['_DoM']['wxid'];
		    $Datass['memberip']      = $_SERVER['SERVER_ADDR'];
		    $Datass['type']        = $Data009['type'];
		    $Datass['order_amount']= $money;
		    $Datass['adddate']     = time();
		    $Datass['paystatus']   = 0;
		    $orderid             = $shopModel->doAdd($Datass,'orderid');
		    //订单详情
		    $order_apps          = M('app_order_info');
		    $Dataso['memberid']      = $userid;
		    $Dataso['wxid']       = $GLOBALS['_DoM']['wxid'];
		    $Dataso['type']        = $Data009['type'];
		    $Dataso['courseid']   = $shopid;
		    $Dataso['title']      = $Data009['title'];
		    $Dataso['price']      = $money;
		    $Dataso['defaultpic'] = $Data009['defaultpic'];
		    $Dataso['orderid']    = $orderid;
		    $Dataso['ordersn']    = $Datass['ordersn'];
		    $Dataso['adddate']    = time();
			$order_apps->doAdd($Dataso,'id');//添加单个app信息
	 	}
	 	return $Datass['ordersn'];
    }
    //修改订单状态
    public function orderedit($Data009){
    	if(!empty($Data009['wxid'])){$GLOBALS['_DoM']['wxid']=$Data009['wxid'];}
    	$userid = $Data009['userid'];
		$ordersn                = $Data009['ordersn'];
	    $order_info          = M('app_order_info');
	    $order          	 = M('app_order');
		$paystatus           = $order_info->getRow("where ordersn=$ordersn limit 1",'paystatus');
		$price          = $order_info->getRow("where ordersn=$ordersn limit 1",'price');
		if($paystatus==1){
			return array('errcode'=>'404','msg'=>'已经购买过订单');
		}else{
			$usersModel = M('common_user');
			$usermoney = $usersModel->getOne('money','where userid='.$userid);
			if($usermoney<$price){
				return array('errcode'=>'404','msg'=>'你的余额不足');
			}else{
				$Data['money'] = $usermoney-$price;
				$usersModel->update($Data,'userid='.$userid);
				$Datas['paystatus'] =1;
				$order_info->update($Datas,'ordersn='.$ordersn);
				$order->update($Datas,'ordersn='.$ordersn);
				return array('errcode'=>'200','msg'=>'购买成功');
			}
		}
    }
    /*
     * 教师端确认支付学员订单
     */
    public function surePay($Data010){
    	$orderModel         = M('app_order');
        	$orderinfoModel     = M('app_order_info');
        	$userfoModel        = M('common_user');
        	$payModel           = M('app_pay_log');
        	$classMode = M('app_course');
        	$postStr=json_decode(file_get_contents("php://input"));
        	$orderid = $Data010['orderid'];
        	$classid = $orderinfoModel ->getAll('where orderid='.$orderid,'courseid,type,memberid,wxid,numb');
        	foreach($classid as $k =>$v){
        	    if($v['type']==1||$v['type']==14||$v['type']==15){
        			$info = $classMode->getRow('where courseid='.$v['courseid'],'studentcount');
//      			var_dump($info);exit;
//        			if(intval($info['studentcount'])==intval($info['studentnum'])){
//        				return false;
//        			}
        		}elseif($v['type']==9){
                    User_addUserGroupBuy($v['courseid'],$v['memberid'],1,$v['wxid']);//调用myhan里的方法加入会员关联表
        		}
        	}
        	$mark               = $Data010['mark'];
        	$data['paystatus']  =  1;
        	$data['paytype']    =  0;
        	$data['agent']    =  $Data010['userid'];
        	$data['paydate'] = time();
        	if(isset($Data010['money'])){
        		$data['order_amount'] = $Data010['money'];
        	}
        	$datainfo['paystatus']  =  1;
        	$datainfo['paytype']    =  0;
        	if(isset($Data010['money'])){
        		$datainfo['sumprice'] = $Data010['money'];
        	}
        	$res                =  $orderModel->update($data,' orderid='.$orderid);
        	$orderinfoModel->update($datainfo,' orderid='.$orderid);
        	$paymoney           =  $orderModel->getRow('where orderid='.$orderid,'memberid,wxid,memberip,type,order_amount');
        	$summoney           =  $userfoModel->getOne('money','where userid='.$paymoney['memberid']);
        	$this->cache->PutUCache('havecolumn',$paymoney['memberid']);//更新购买者的缓存
			$this->cache->PutUCache('userorderinfo',$paymoney['memberid']);   //更新学员的已购订单缓存
        	if(isset($Data010['money'])){
        		$data['order_amount'] = $Data010['money'];
        	}
        	$balance            =  $summoney+$paymoney['order_amount'];
        	$Datas['wxid']      =  $paymoney['wxid'];
        	$Datas['memberid']  =  $paymoney['memberid'];
        	$Datas['memberip']  =  $paymoney['memberip'];
        	$Datas['paytype']   =  2;
        	$Datas['cmoney']    =  $paymoney['order_amount'];
        	$Datas['balance']   =  $balance;	
        	$Datas['adddate']   =  time();
//      	var_dump($paymoney);
        	if($paymoney['type']==1){
        		$Datas['mark']  =  '为报名班级充值'.$paymoney['order_amount'];
        	}elseif($paymoney['type']==0){
        		$Datas['mark']  =  '为报名课程充值'.$paymoney['order_amount'];
        	}elseif ($paymoney['type']==14 || $paymoney['type']==15){
                $Datas['mark']  =  '教辅周边充值'.$paymoney['order_amount'];
            }
        	elseif($paymoney['type']==2){
        		$Datas['mark']  =  '充值'.$paymoney['order_amount'];
        		$res            =   $payModel->doAdd($Datas,'id');
        		$mont['money']  =  $balance;
        		$userfoModel->update($mont,' userid='.$paymoney['memberid']);
        		$result['success']='支付成功';
        		return $result;
        		exit;
        	}
        	$res               =   $payModel->doAdd($Datas,'id');
        	$balance           =   $summoney+$paymoney['order_amount']-$paymoney['order_amount'];
        	$Datas['paytype']  =   $paymoney['type'];
        	$Datas['type']     =   1;
        	$Datas['cmoney']   =   $paymoney['order_amount'];
        	$Datas['balance']  =   $balance;	
        	$Datas['mark']     =   $mark;
        	$res               =   $payModel->doAdd($Datas,'id');
        	$mont['money']     =   $balance;
        	$userfoModel->update($mont,' userid='.$paymoney['memberid']);
        	foreach($classid as $k =>$v){
        		if($v['type']==1||$v['type']==14||$v['type']==15){
	        		$Data2['studentcount'] = $info['studentcount']+$v['numb'];
	        		$classMode->update($Data2,' courseid='.$v['courseid']);
	        	}
        	}
        	return true;
    }
}