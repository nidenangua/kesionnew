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
        $db_order = M('common_order');
        $db_info = M('common_order_info');
        $db_website = M('common_user_website');
        $where = "where a.appid = 19 and b.status!=-1";
        $s =ChkClng(KS_S('status',3));
        $keyword=KS_S('keyword');
		$keytype=KS_S('keytype',1); 
		if($s!=3){
			$where = $where.' and a.paystatus ='.$s;
		}
        if($keyword){
			$where = $where.' and c.sitename like "%'.$keyword.'%"';
		}
		$m =mktime(0,0,0,date('m'),1,date('Y'));
		$day =  mktime(0,0,0,date('m'),date('d'),date('Y'));
		$week =mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"));
		$year =  mktime(0,0,0,1,1,date('Y'));

        $where =' as a left join '.$db_order->table.' as b on a.orderid=b.orderid left join '.$db_website->table .' as c on b.wxid=c.wxid '.$where;
        $now_page   = ChkClng(KS_S('p',1));
        $yearCout = $db_info->getOne('count(a.id)',$where.' and b.adddate>'.$year);
		$mCout = $db_info->getOne('count(a.id)',$where.' and b.adddate>'.$m);
		$weekCount = $db_info->getOne('count(a.id)',$where.' and b.adddate>'.$week);
		$dayCout = $db_info->getOne('count(a.id)',$where.' and b.adddate>'.$day);

        $options = $db_info->getOptions('10',$where);//分页参数设置
        $options['now_page'] = $now_page;
        $page = Page($options);
		$values = $db_info->getPage($page,'a.id desc',$where,'a.*,b.adddate,b.wxid,b.ordersn,c.sitename');
		// var_dump($values);
        include  CURR_VIEW_PATH . "index.php";	
    }
    public function deleteAction(){
    	$now_page   = ChkClng(KS_S('p',1));
    	$id = KS_G('get.id');
    	$db_order = M('common_order');
        $db_info = M('common_order_info');
        $info = $db_info->getRow('where id='.$id);
        $db_order->delete('orderid='.$info['orderid']);
         $db_info->delete('id='.$id);
         $url = M_URL($this->AppName.'/Index','index','',GF('P-'.$now_page));
         KS_INFO('删除成功',0,$url);
    }
}