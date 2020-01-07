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
		$active   =   M('app_h5_rule');
		$wxtable   =   M('common_user_website');
		$keyword   =   ChkSQL(GF('keyword') ? GF('keyword'):'00');
		$keytype   =   ChkSQL(GF('keytype') ? GF('keytype'):1);
//		var_dump($keyword);
//		var_dump($keytype);
		$stype     =   ChkClng(KS_S('type'),6);
		$status    =   ChkClng(GF('status') ? GF('status'):3);
		$now_page  =   ChkClng(GF('p') ? GF('p'):'1');
		$byname    =   ChkSQL(GF('byname') ? GF('byname'):'desc');
		if($status==3){ $where= ' where (a.isstar=1 or a.isstar=2)';}
	 	if($status==1){ $where= ' where a.isstar=1';}
	 	if($status==2){ $where= ' where a.isstar=2';}
	 	if($stype == 1){
			$where .= ' and a.ismode=1';
		}elseif($stype==2){
			$where .= ' and a.ismode=2';
		}elseif($stype==3){
			$where .= ' and a.ismode=3';
		}elseif($stype==6){
			$where .= ' and 1=1';
		}
	 	if($keytype==1 && $keyword !='00'){
	     	$where  = $where.' and a.name like "%'.$keyword.'%"';
		}elseif($keytype==2 && $keyword!='00'){
		  	$where  =  $where.' and b.sitename like "%'.$keyword.'%"';
		}elseif($keytype==3 && $keyword!='00'){
		  	$where  =  $where.' and a.wxid ='.$keyword;
		}

	    $now_page   =  ChkClng(KS_S('p',1));
	    $where      =  "as a left join `$wxtable->table` as b on a.wxid = b.wxid ".$where;
	    $options    =  $active->getOptions('7',$where);//分页参数设置
		$page       =  Page($options);
		$infoary    = $active->getPage($page,'adddate '.$byname,$where,'a.id,b.sitename,a.name,a.introduction,a.isstar,a.adddate,a.partake,a.sign,a.isonline,a.startime,a.endtime,a.number,a.ismode');
//     		var_dump($infoary);
       include  CURR_VIEW_PATH . "index.php";

		}
		/*
		 * 单个删除
		 */
		public function deloneAction(){
			$active   =   M('app_h5_rule');
			$id=ChkSQL(KS_G('request.id'));
			$Data['isstar'] = -1;
	    	$res=$active->update($Data,'id='.$id);
			$now_page =  ChkClng(KS_S('p',1));
			$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
			ks_header($url);
		}
		/*
		 * 批量删除
		 */
	    public function delsomeAction(){
	    	$active   =   M('app_h5_rule');
	    	$idAry=ChkSQL(KS_G('post.id'));
	    	$Data['isstar'] = -1;
	    	foreach($idAry as $key =>$val){
	    	  $res=$active->update($Data,'id = '.$val);
	    	}
			$now_page =  ChkClng(KS_S('p',1));
			$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
			KS_INFO("批量操作成功",0,$url);
	    }
	    /*
	     * 根据时间段批量删除
	     */
	    public  function delpathAction(){
	    	$active   =   M('app_h5_rule');
	    	$now_page =  ChkClng(KS_S('p',1));
			$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
	    	$time=ChkSQL(KS_G('post.anytime'));
	    	if(empty($time)){
	    		KS_INFO("你还没有进行选择",0,$url);
	    	}
	    	if($time==10){
	    		$pathtime=strtotime("-$time day");
	    	}else{
	    		$pathtime=strtotime("-$time month");
	    	}
	//  	var_dump($pathtime);
	//  	var_dump(date('Y-m-d',$pathtime));
	//  	exit;
	    	$Data['isstar'] = -1;
	    	$res=$active->update($Data,'adddate < '.$pathtime);
			KS_INFO("执行成功",0,$url);
	    }
		//成绩导出
    public function activeexcelAction(){
		$paperid = ChkClng(KS_G('post.outtime'));
		$active   =   M('app_h5_rule');
		$wxtable   =   M('common_user_website');
		$keyword   =   ChkSQL(GF('keyword') ? GF('keyword'):'');
		$keytype   =   ChkSQL(GF('keytype') ? GF('keytype'):1);
		$stype     =   ChkClng(KS_S('type'),6);
		$status    =   ChkClng(GF('status') ? GF('status'):3);
		$now_page  =   ChkClng(GF('p') ? GF('p'):'1');
		$byname    =   ChkSQL(GF('byname') ? GF('byname'):'desc');
		if($status==3){ $where= ' where (a.isstar=1 or a.isstar=2)';}
	 	if($status==1){ $where= ' where a.isstar=1';}
	 	if($status==2){ $where= ' where a.isstar=2';}
	 	if($stype == 1){
			$where .= ' and a.ismode=1';
		}elseif($stype==2){
			$where .= ' and a.ismode=2';
		}elseif($stype==3){
			$where .= ' and a.ismode=3';
		}elseif($stype==6){
			$where .= ' and 1=1';
		}
	 	if($keytype==1&&$keyword!='00'){
	     	$where  = $where.' and a.name like "%'.$keyword.'%"';
		}elseif($keytype==2&&$keyword!='00'){
		  	$where  =  $where.' and b.sitename ='.$keyword;
		}elseif($keytype==3&&$keyword!='00'){
		  	$where  =  $where.' and a.wxid ='.$keyword;
		}
		$where      =  "as a left join `$wxtable->table` as b on a.wxid = b.wxid ".$where;
		if($paperid==1){
			$options = $active->getOptions('10',$where);//分页参数设置
		    $page = Page($options);
			$infoary = $active->getPage($page,'adddate '.$byname,$where,'b.sitename,a.name,a.introduction,a.isstar,a.adddate,a.partake,a.sign,a.isonline,a.startime,a.endtime,a.number,a.ismode,a.adddate');

		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and adddate > '.$strtime;
			$infoary = $active->getAll($where.' order by adddate '.$byname,'b.sitename,a.name,a.introduction,a.isstar,a.adddate,a.partake,a.sign,a.isonline,a.startime,a.endtime,a.number,a.ismode,a.adddate');
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and adddate > '.$strtime;
			$infoary = $active->getAll($where.' order by adddate '.$byname,'b.sitename,a.name,a.introduction,a.isstar,a.adddate,a.partake,a.sign,a.isonline,a.startime,a.endtime,a.number,a.ismode,a.adddate');
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and adddate > '.$strtime.' and adddate < '.$endtime;
			$infoary = $active->getAll($where.' order by adddate '.$byname,'b.sitename,a.name,a.introduction,a.isstar,a.adddate,a.partake,a.sign,a.isonline,a.startime,a.endtime,a.number,a.ismode,a.adddate');
		}
		 foreach($infoary as $key =>$val){
		 	date_default_timezone_set("PRC");
		 	$infoary[$key]['adddate']=date('Y-m-d H:i:s',$val['adddate']);
		 	$infoary[$key]['startime']=date('Y-m-d H:i:s',$val['startime']);
		 	$infoary[$key]['endtime']=date('Y-m-d H:i:s',$val['endtime']);
		 }
		$xlsName     = '活动情况';//文件名
		$textRun     = $xlsName;//表名
		foreach($infoary as $k=>$v){$infoary[$k]['num'] = $k+1;}
		$xlsCell  = array(
			array('num','序号'),
			array('name','活动名称'),
			array('sitename','举办者'),
			array('introduction','活动介绍'),
			array('isstar','是否开启（1是，0否）'),
			array('adddate','活动添加日期'),
			array('partake','参加人数'),
			array('isonline','是否线上（1是，0否）'),
			array('startime','开始时间'),
			array('endtime','结束时间'),
			array('number','限制次数'),
			array('ismode','活动类型（1抽奖，2助力，3排行'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}

	public function showEditAction(){
		$id   =   ChkSQL(GF('id') ? GF('id'):'');
		$table=M('app_h5_rule');
		$now_page  =   ChkClng(GF('p') ? GF('p'):'1');
		$h5info=$table->getRow('where id='.$id,'id,name,introduction,startime,endtime,number');
		include  CURR_VIEW_PATH . "editactive.php";
	}

	public function doeditAction(){
		$table=M('app_h5_rule');
		$id = ChkClng(null !==GF('id') ? GF('id'):'');
		$now_page = ChkClng(KS_S('p',1));
		if(!empty($id)){
			$Data['name']    = ChkSQL(KS_G("post.name"));
		    $Data['introduction']       = ChkSQL(KS_G("post.introduction"));
	 	 	$Data['startime']        = strtotime(ChkSQL(KS_G("post.startime")));
	 	 	$Data['endtime']        = strtotime(ChkSQL(KS_G("post.endtime")));
	 	 	$Data['number']        = ChkClng(KS_G("post.number"));
	 	 	$res=$table->update($Data,"id=$id");
	 	 	$url1= M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		    KS_INFO('修改成功',3,$url1);
		}

	}

	//拼团
	public function collageAction(){
		$where = 'where  h5id = 19 and ismode=2';
		$status=KS_S('status',3);//状态筛选
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		if($status!=3){
			$where = $where.' and isstar='.$status;
		}
		if($keyword){
			$where = $where.' and name like "%'.$keyword.'%"';
		}
		$Mode = M('app_h5_rule');
		$options = $Mode->getOptions('10',$where);//分页参数设置
        $page = Page($options);
		$values = $Mode->getPage($page,'',$where);
		// var_dump($values);
		foreach ($values as $k => $v) {

			if($v['type'] == 1 || $v['type'] == 2||$v['type'] == 3||$v['type'] == 4){
				$Mode = M('app_course');
				$info  = $Mode->getRow('where status !=-1 and wxid ='.$v['wxid'].' and courseid='.$v['infoid'],'courseid as id,title,price,defaultpic');
			}elseif($v['type'] == 6){
				$Mode = M('app_paper');
				$info  = $Mode->getRow('where wxid ='.$v['wxid'].' and status !=-1 and paperid='.$v['infoid'],'paperid as id,Title as title,price,defaultpic');
			}
			if(empty($info)){
				$values[$k]['title'] = '课程信息出错';
				// unset($values[$k]);
			}else{
				$values[$k]['title'] = $info['title'];
				}
				$values[$k]['defaultpic'] = $info['defaultpic'];
				if(empty($values[$k]['defaultpic'])){
					$values[$k]['defaultpic']  = nopic(12);
				}

				$values[$k]['setting'] = unserialize($v['setting']);
				$values[$k]['groupnum'] = M('app_h5_rulereward')->getAll('where wxid='.$v['wxid'].' and h5id='.$v['id']);
				$values[$k]['groupnum']  = count($values[$k]['groupnum']);
				$values[$k]['groupnum1'] = M('app_h5_rulereward')->getAll('where wxid='.$v['wxid'].' and h5id='.$v['id'].' and successful = 1');
				$values[$k]['groupnum1']  = count($values[$k]['groupnum1']);
				$values[$k]['groupnum2'] = M('app_h5_rulereward')->getAll('where wxid='.$v['wxid'].' and h5id='.$v['id'].' and successful = 0');
				$values[$k]['groupnum2']  = count($values[$k]['groupnum2']);

			// }

		}
		// var_dump($values);
		include CURR_VIEW_PATH . 'collageList.php';

	}

	public function collagesituationAction(){
	  	$id = KS_G('get.id');
		$h5mode     = M('app_h5_rule');
		$h5info = $h5mode->getRow('where  id='.$id);
		$h5info['setting'] = unserialize($h5info['setting']);
		if($h5info['setting']['timexz'] == 24){
			$addtiem = 86400;
		}else{
			$addtiem = 86400+86400;
		}
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));

		$people = $h5info['setting']['rewardpeple'];
		$s =ChkClng(KS_S('status',3));
		$Db= M('app_h5_rulereward');
		$where = 'where h5id = '.$id;
		if($s!=3){
			$where = $where.' and successful ='.$s;
		}
		if($keyword){
			$where = $where.' and membername like "%'.$keyword.'%"';
		}
		$options = $Db->getOptions('20',$where);//分页参数设置
        $page = Page($options);
		$values = $Db->getPage($page,'id asc',$where);
		foreach ($values as $k=> $v) {
			// var_dump($v);
			$Db2 = M('app_h5_user');
			$values[$k]['num'] = $Db2->getAll('where groupid = "'.$v['groupid'].'"');
			$values[$k]['num'] = count($values[$k]['num']);
		}
	  	include CURR_VIEW_PATH.'collagesituation.php';
	}
	public function checkcollageAction(){
		$groupid = null !==GF('groupid') ? GF('groupid'):'';
		$Db2 = M('app_h5_user');
		$values = $Db2->getAll('where groupid = "'.$groupid.'"');
		include  CURR_VIEW_PATH . "checkcollage.php";
	}

    //删除拼团
	public function deleteCollageAction(){
		$Mode = M('app_h5_rule');
		$id = KS_G('get.id');
		$Db= M('app_h5_rulereward');
		// $db_member = M('app_task_answer');
		$Mode->delete('id='.$id);
		$Db->delete('h5id='.$id);
		$now_page =  ChkClng(KS_S('p',1));
		$url = M_URL($this->AppName.'/Index','collage','',GP('p-'.$now_page));
		ks_header($url);
	}
      //批量删除拼团
	public function bacthCollageAction(){
		$idAry=ChkSQL(KS_G('post.check'));
		// var_dump($idAry);exit();
		$db_rule = M('app_h5_rule');
		$db_rulereward = M('app_h5_rulereward');
    	foreach($idAry as $key =>$val){
    	   $db_rule->delete('id='.$val);
		  $db_rulereward->delete('h5id='.$val);
    	}
		$now_page =  ChkClng(KS_S('p',1));
		$url=M_URL($this->AppName.'/Index','collage','',GP('p-'.$now_page));
		KS_INFO("批量操作成功",0,$url);
	}
	//删除拼团
	public function deletesmallAction(){
		$id = KS_G('get.id');
		$collid = GF('id');
		$Db= M('app_h5_rulereward');
		$Db2 = M('app_h5_user');
		$groupid = null !==GF('groupid') ? GF('groupid'):'';
		$Db2->delete('groupid="'.$groupid.'"');
		$Db->delete('id='.$id);
		$now_page =  ChkClng(KS_S('p',1));
		$url = M_URL($this->AppName.'/Index','collagesituation',$collid,GP('p-'.$now_page));
		ks_header($url);
	}
      //批量删除拼团
	public function bacthsmallAction(){
		$idAry=ChkSQL(KS_G('post.check'));
		$collid = KS_G('get.id');
		// var_dump($idAry);exit();
		$Db= M('app_h5_rulereward');
		$Db2 = M('app_h5_user');
    	foreach($idAry as $key =>$val){
    		$info = $Db->getRow('where id='.$val);
    	    $Db2->delete('groupid="'.$info['groupid'].'"');
		    $Db->delete('id='.$val);
    	}
		$now_page =  ChkClng(KS_S('p',1));
		$url = M_URL($this->AppName.'/Index','collagesituation',$collid,GP('p-'.$now_page));
		KS_INFO("批量操作成功",0,$url);
	}


	public function failurelistAction(){
		$Db       = M('app_h5_rulereward');
		$Db1      = M('app_h5_rule');
		$Db2      = M('app_h5_user');
		$allmoney = 0;
		$where    = ' as a left join '.$Db1->table.' as b on a.h5id=b.id where a.successful = 0 and b.h5id = 19 and b.ismode=2 and b.isstar!=-1 order by a.id desc';
		$values   = $Db->getAll($where,'a.id as rewardid,a.moneystatus,a.addtime as collagetime,a.memberid,groupid,b.*');
		foreach($values as $k =>$v){
    		$v['setting']  = unserialize($v['setting']);
    		$values[$k]['setting'] = $v['setting'];
    		if($v['setting']['timexz']==24){
				$values[$k]['setting']['endtime'] = $v['collagetime']+86400;
   			}else{
   				$values[$k]['setting']['endtime'] = $v['collagetime']+86400+86400;
   			}
   			if($v['isstar']==1 && $v['endtime']>time()){//活动还开着
   				if($values[$k]['setting']['endtime']>time()){
	   				unset($values[$k]);
	   			}else{
	   				$userlist = $Db2->getAll('where groupid="'.$v['groupid'].'" and h5id='.$v['id']);
		   			if(count($userlist)==$v['setting']['rewardpeple']){
		   				unset($values[$k]);
		   			}else{
		   				$values[$k]['haveuser'] = count($userlist);
		   				if($v['type'] == 1 || $v['type'] == 2||$v['type'] == 3||$v['type'] == 4){
							$Mode = M('app_course');
							$info  = $Mode->getRow('where status !=-1  and courseid='.$v['infoid'],'courseid as id,title,price,defaultpic');
						}elseif($v['type'] == 6){
							$Mode = M('app_paper');
							$info  = $Mode->getRow('where status !=-1 and paperid='.$v['infoid'],'paperid as id,Title as title,price,defaultpic');
						}
						if(empty($info)){
							unset($values[$k]);
						}else{
							if($v['moneystatus']==0){
								$allmoney+=(count($userlist)-1)*$v['setting']['teammoney'] +$v['setting']['leadmoney'];
							}
							$values[$k]['title'] = $info['title'];
							$values[$k]['defaultpic'] = $info['defaultpic'];
							if(empty($values[$k]['defaultpic'])){
								$values[$k]['defaultpic']  = nopic(12);
							}else{
								$values[$k]['defaultpic']  = Img($values[$k]['defaultpic']);
							}

						}
		   			}
	   			}
   			}else{//活动关了  直接失败
   				$userlist = $Db2->getAll('where groupid="'.$v['groupid'].'" and h5id='.$v['id']);
   				$values[$k]['haveuser'] = count($userlist);
   				if($v['type'] == 1 || $v['type'] == 2||$v['type'] == 3||$v['type'] == 4){
					$Mode = M('app_course');
					$info  = $Mode->getRow('where status !=-1  and courseid='.$v['infoid'],'courseid as id,title,price,defaultpic');
				}elseif($v['type'] == 6){
					$Mode = M('app_paper');
					$info  = $Mode->getRow('where status !=-1 and paperid='.$v['infoid'],'paperid as id,Title as title,price,defaultpic');
				}
				if(empty($info)){
					unset($values[$k]);
				}else{
					if($v['moneystatus']==0){
						$allmoney+=(count($userlist)-1)*$v['setting']['teammoney'] +$v['setting']['leadmoney'];
					}
					$values[$k]['title'] = $info['title'];
					$values[$k]['defaultpic'] = $info['defaultpic'];
					if(empty($values[$k]['defaultpic'])){
						$values[$k]['defaultpic']  = nopic(12);
					}else{
						$values[$k]['defaultpic']  = Img($values[$k]['defaultpic']);
					}

				}
   			}
    }
        $values = array_values($values);//重置数组下标
		$now_page = ChkClng(KS_S('p',1));
		$options['now_page']   = $now_page;
		$options['maxperpage'] = 6;
	    $options['totalput']   = count($values);
		$page = Page($options);
		$ary_link   = $page->arrayPage($values);
		foreach($ary_link as $k =>$v){
			$ary_link[$k]['membername'] = M('common_user_member')->getOne('name','where userid='.$v['memberid']);
		}
		include  CURR_VIEW_PATH . "failureList.php";
	}
	public function confirmdel1Action(){
	    $groupid = null !==GF('groupid') ? GF('groupid'):'';
	    $db_order = M('app_order_info');
	    $Db2      = M('app_h5_user');
	    $allmoney = $db_order->getAll(' as a left join '.$Db2->table.' as b on a.groupid=b.groupid where a.groupid="'.$groupid.'" and a.paystatus=1');
	    $count = count($allmoney);
	    $money = 0;
	    foreach($allmoney as $k =>$v){
			$money+=$v['price'];
		}
	    include  CURR_VIEW_PATH . "confirmdel1.php";
	}
}
  