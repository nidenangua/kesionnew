<hr />
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
class IndexController extends CommonController{

    public function indexAction(){
    	$now_page = ChkClng(KS_S('p',1));
    	$where = 'where 1=1';
		$app_wechat_config = M('app_wxapplet_config');
		$keyword=KS_S('keyword');
	    $keytype=KS_S('keytype',1);
	    if(!empty($keyword)){
	    	$where.=" and weixinname like '%$keyword%'";
		}

		$yearCout = $app_wechat_config->getOne('count(id)',$where.' and isaudit=1');
		$mCout = $app_wechat_config->getOne('count(id)',$where.' and isaudit=0');
		$dCout = $app_wechat_config->getOne('count(id)',$where.' and isaudit=2');

        $status =ChkClng(KS_S('status',3));
        if($status!=3){
        	$where.=' and isaudit='.$status;
        }
		$options = $app_wechat_config->getOptions('10',$where);
		$options['now_page'] = $now_page;
        $page = Page($options);
		$values = $app_wechat_config->getPage($page,'',$where,'');
		foreach($values as $k=>$v){
			$values[$k]['info'] = M('app_wxapplet_user')->getAll('where wxid='.$v['wxid'].' and appid="'.$v['appid'].'"');
			if(!empty($v['categories'])){
				$values[$k]['categories'] = json_decode($v['categories'],true);
				// var_dump($values[$k]['categories']);
			}
			if(!empty($v['network'])){
				$values[$k]['network'] = json_decode($v['network'],true);
				// var_dump($values[$k]['network']);
			}
			
			
		}
			  
			include  CURR_VIEW_PATH . "index.php";  		
	}
	
	  
}
  