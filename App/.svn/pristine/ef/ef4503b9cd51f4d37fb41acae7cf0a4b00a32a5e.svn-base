<?php
	$start=date('Y-m-01 00:00:00');  
    $end = date('Y-m-d H:i:s'); 
    $startW =date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y")));
	$app_wechat_count = M('app_wechat_count');
	$count = $app_wechat_count->getAll("where wxid = " .$this->wxid." and add_time = '".date("Y-m-d 00:00:00")."'");
	if(empty($count)){
		$countdata['new_user'] =0;
		$countdata['cancel_user']=0;
		$countdata['cumulate_user']=0;
	}else{
		//有就数据库直接取
		$countdata = $count[0];
	}
	$t = time();
	$start_now = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
	$end_now = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
	$app_wechat_news = M('app_wechat_news');
	$news = $app_wechat_news->getOne('count(*)',"where wxid = " .$this->wxid."  AND createtime>='".$start_now."' and createtime <= '".$end_now."'");
?>
