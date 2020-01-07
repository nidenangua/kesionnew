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
	 //课程订单
     public function courseAction(){
		check_login($this->memberinfo);//检查是登录权限 
		$option = null !==GF('option') ? GF('option'):0;
		//状态筛选
		if($option==0){$where = 'where (paystatus=0 or paystatus=1)';}
		elseif($option==1){$where = 'where paystatus=1'; }
		elseif($option==2){$where = 'where paystatus=1';}
		elseif($option==3){$where = 'where paystatus=0';}
		elseif($option==4){$where = 'where paystatus=1';}
		elseif($option==5){$where = 'where paystatus=0';}
		
		$where .= ' and wxid='.$GLOBALS['_DoM']['wxid'].' and memberid='.$this->memberid;
		$byname = 'adddate desc';
		//$maxPerPage = $this->getMaxPage('order/course_order.html');
		$options = $this->AppModel->getOptions(5,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page = Page($options);
		$dt = $this->AppModel->getPage($page,$byname,$where); 
	    $this->assign('page',$page);
		$this->assign('dt',$dt);
		$this->assign('option',$option);
		$this->display('order/course_order.html');
	 }
	 //小课程课程订单
	 public function mycourseAction(){
		check_login($this->memberinfo);//检查是登录权限 
		$option = null !==GF('option') ? GF('option'):0;
		//状态筛选
		if($option==0){$where = 'where (paystatus=0 or paystatus=1)';}
		elseif($option==1){$where = 'where paystatus=1'; }
		elseif($option==2){$where = 'where paystatus=1';}
		elseif($option==3){$where = 'where paystatus=0';}
		elseif($option==4){$where = 'where paystatus=1';}
		elseif($option==5){$where = 'where paystatus=0';}
		
		$where .= ' and wxid='.$GLOBALS['_DoM']['wxid'].' and memberid='.$this->memberid;
		$byname = 'adddate desc';
		//$maxPerPage = $this->getMaxPage('order/course_order.html');
		$options = $this->AppModel->getOptions(5,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page = Page($options);
		$dt = $this->AppModel->getPage($page,$byname,$where); 
	    $this->assign('page',$page);
		$this->assign('dt',$dt);
		$this->assign('option',$option);
		$this->display('order/course_order.html',1);
	 }
	 
	 public function accountAction(){
	 	//var_dump($this->memberinfo);exit;
		 check_login($this->memberinfo);//检查是登录权限
		 $pay_log = M('app_pay_log');
		 $option = null !==GF('option') ? GF('option'):0;//状态筛选
		 if($option==0){$where = 'where (type=0 or type=1)';}
		 elseif($option==1){$where = 'where type=1'; }
		 elseif($option==2){$where = 'where type=1';}
		 elseif($option==3){$where = 'where type=0';}
		 elseif($option==4){$where = 'where type=1';}
		 elseif($option==5){$where = 'where type=0';}
		 $where .= ' and memberid='.$this->memberid;
		 //$where .= ' and memberid= 73';
	   	 $byname = 'adddate desc';
		 $maxPerPage = $this->getMaxPage('order/account.html');
		 $options = $pay_log->getOptions($maxPerPage,$where);//分页参数设置
		 $options['now_page'] = null !==GF('p') ? GF('p'):'1';
		 $page = Page($options);
		 $dt = $pay_log->getPage($page,$byname,$where);
		 //var_dump($dt);exit;
		 $this->assign('page',$page);
		 $this->assign('dt',$dt);
		 $this->assign('option',$option);
		 $this->display('order/account.html');
	 }
	 
	 public function deleteAction(){
		 check_login($this->memberinfo);//检查是登录权限
		 $p = ChkClng(null !==GF('p') ? GF('p'):1);
		 $option = ChkClng(null !==GF('option') ? GF('option'):0);
		 $ordersn = ChkSQL(null !==GF('ordersn') ? GF('ordersn'):'');
		 $order_courses = M('app_order_info');
		 $this->AppModel->delete("ordersn=$ordersn and userid=".$GLOBALS['_DoM']['wxid']." and memberid=$this->memberid");
		 $order_courses->delete("ordersn=$ordersn and userid=".$GLOBALS['_DoM']['wxid']." and memberid=".$this->memberid);
		 $url1 = M_URL('order','course','',GP('p-'.$p.',option-'.$option,true));
		 ks_header($url1);
	 }
	 public function buynowAction(){
		 check_login($this->memberinfo);//检查是登录权限
		 $ordersn = ChkSQL(null !==GF('ordersn') ? GF('ordersn'):'');
		 if(empty($ordersn)){KS_INFO('请选择您要支付的订单',4);}
		 $url = M_URL('course','confirm','',GP('ordersn-'.$ordersn,true));
		 ks_header($url);
     }
}