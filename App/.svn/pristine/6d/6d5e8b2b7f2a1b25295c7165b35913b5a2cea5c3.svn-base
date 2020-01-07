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
			$db_website = M('common_user_website');
			$now_page = ChkClng(KS_S('p',1));
	    	$where = 'as a left join '.$db_website->table.' as b on a.wxid=b.wxid where 1=1';
			$app_wechat_config = M('app_weixin_config');
			$keyword = ChkSQL(KS_S('keyword'));
		    $keytype = ChkClng(KS_S('keytype',1));
		    if(!empty($keyword)){
		    	$where.=" and a.weixinname like '%$keyword%'";
			}

			$yearCout = $app_wechat_config->getOne('count(a.id)',$where.' and a.weixinstatus= 1');
			$mCout = $app_wechat_config->getOne('count(a.id)',$where.' and a.weixinstatus=0');

	        $status =ChkClng(KS_S('status',3));
	        if($status!=3){
	        	$where.=' and a.weixinstatus='.$status;
	        }
			$options = $app_wechat_config->getOptions('10',$where);
			$options['now_page'] = $now_page;
	        $page = Page($options);
			$values = $app_wechat_config->getPage($page,'',$where,'a.*,b.sitename');
			foreach($values as $k=>$v){
				$values[$k]['countuser'] = M('app_weixin_user')->getOne('count(id)','where wxid='.$v['wxid']);
				if(!empty($v['network'])){
					$values[$k]['network'] = json_decode($v['network'],true);
					// var_dump($values[$k]['network']);
				}
				
				
			}
			include  CURR_VIEW_PATH . "index.php";	
		}
	    public function userlistAction(){
	    	$id = KS_G('get.id');
			$db_website = M('common_user_website');
			$info = $db_website->getRow('where wxid='.$id);
			$now_page = ChkClng(KS_S('p',1));
	    	$where = 'where wxid='.$id;
			$app_weixin_user = M('app_weixin_user');
			$keyword = ChkSQL(KS_S('keyword'));
		    $keytype = ChkClng(KS_S('keytype',1));
		    if(!empty($keyword)){
		    	$where.=" and nickname like '%$keyword%'";
			}
            $m =mktime(0,0,0,date('m'),1,date('Y'));
			$day =  mktime(0,0,0,date('m'),date('d'),date('Y'));
			$week =mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"));
			$year =  mktime(0,0,0,1,1,date('Y'));

			$yearCout = $app_weixin_user->getOne('count(id)',$where.' and subscribe_time>'.$year);
			$mCout = $app_weixin_user->getOne('count(id)',$where.' and subscribe_time>'.$m);
			$weekCount = $app_weixin_user->getOne('count(id)',$where.' and subscribe_time>'.$week);
			$dayCout = $app_weixin_user->getOne('count(id)',$where.' and subscribe_time>'.$day);

			$options = $app_weixin_user->getOptions('10',$where);
			$options['now_page'] = $now_page;
	        $page = Page($options);
			$values = $app_weixin_user->getPage($page,'',$where,'');
			include  CURR_VIEW_PATH . "userlist.php";	
		}
	  
}
  