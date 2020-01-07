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
class ConsultModel extends Model{
	/**
	 * 意向记录管理
	 * @param mixed $Data001
	 * @return array
	 */
	public function manageindex($Data001){
		$where='where userid='.$Data001['userid'];
	    if(isset($Data001['address'])){
	    	$address = $Data001['address'];
	    }else{
	    	$address = ChkClng(null !==GF('address') ? GF('address'):'0');
	    }
	    if($address!=0){$where.=' and schoolroomid='.$address;}

	    if(isset($Data001['channelid'])){
	    	$channelid = $Data001['channelid'];
	    }else{
	    	$channelid = ChkClng(null !==GF('channelid') ? GF('channelid'):'0');
	    }
		if($channelid!=0){$where.=' and channel='.$channelid;}

		if(isset($Data001['classify'])){
	    	$classify = $Data001['classify'];
	    }else{
	    	$classify = ChkClng(null !==GF('classify') ? GF('classify'):'0');
	    }
		if($classify!=0){if($classify==4){$where.=' and type=1';}else{$where.=' and classify='.$classify;}}

		if(isset($Data001['intentionality'])){
	    	$intentionality = $Data001['intentionality'];
	    }else{
	    	$intentionality = ChkClng(null !==GF('intentionality') ? GF('intentionality'):'5');
	    }
		if($intentionality!=5){$where.=' and intentionality='.$intentionality;}
		if(isset($Data001['status'])){
	    	$status = $Data001['status'];
	    }else{
	    	$status = ChkClng(null !==GF('status') ? GF('status'):'6');
	    }
		if($status!=6){$where.=' and  status='.$status;}else{$where.=' and status!=2 ';}

		if(isset($Data001['keyword'])){
		    $keyword = $Data001['keyword'];
		}else{
			$keyword = KS_S('keyword');
		}
		$keytype = ChkClng(KS_S('keytype'));
		$timetype = ChkClng(null !==GF('timetype') ? GF('timetype'):'0');

		if(isset($Data001['result'])){
	    	$result = $Data001['result'];
	    }else{
	    	$result = ChkClng(null !==GF('result') ? GF('result'):'6');
	    }
		if($result!=6){$where.=' and  restult='.$result;}

		if($timetype==1){
			$endtime = mktime(0, 0 , 0,date("m"),date("d")+1,date("Y"));
			$stattime = mktime(23, 59 , 59,date("m"),date("d")-1,date("Y"));
		}elseif($timetype==2){
			$endtime = mktime(0, 0 , 0,date("m"),date("d")+2,date("Y"));
			$stattime = mktime(23, 59 , 59,date("m"),date("d"),date("Y"));
		}elseif($timetype==3){
			$endtime = mktime(0, 0 , 0,date("m"),date("d")+3,date("Y"));
			$stattime = mktime(23, 59 , 59,date("m"),date("d")-1,date("Y"));
		}elseif($timetype==4){
			$endtime = mktime(0, 0 , 0,date("m"),date("d")+7,date("Y"));
			$stattime = mktime(23, 59 , 59,date("m"),date("d")-1,date("Y"));
		}elseif($timetype==5){
			$stattime = ChkSQL(GF('starttime'));
			$endtime = ChkSQL(GF('endtime'));
		}
		if($timetype!=0){
			$where.= ' and (nexttime<'.$endtime.' and nexttime >'.$stattime.')';
		}
		if($keyword){
			$where.=' and membername like "%'.$keyword.'%"';
		}
		$Model= M('app_consultation');
		$now_page = ChkClng(KS_S('p'));
		$options = $Model->getOptions($Data001['maxPerPage'],$where);//分页参数设置
		if(isset($Data001['now_page'])){
			$options['now_page'] = $Data001['now_page'];
		}else{
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		}
		$page    = Page($options);
		$values  = $Model->getPage($page,'id desc',$where);
		foreach($values as $k =>$v){
			$values[$k]['url'] = '/home.html/default/WeChat/intentDetail/'.$v['id'];
			if($v['nexttime']){
				$values[$k]['nexttime'] = date('Y-m-d H:i:s',$v['nexttime']);
			}
			if($v['coursename']){
				if($v['type']==2){
					$app=M('app_column');
					$values[$k]['coursename'] = '【专栏】'.$app->getOne('title','where columnid='.$v['coursename']);
				}else{
					$app=M('app_course');
					$values[$k]['coursename'] = '【课程】'.$app->getOne('title','where courseid='.$v['coursename']);
				}
			}
			$shoolMoel =M('app_schooladdress');
			if($v['schoolroomid']){
				$values[$k]['schoolroomid'] = $shoolMoel->getOne('school','where schoolid='.$v['schoolroomid']);
			}

			if($v['channel']){
				$channelModel = M('app_consultation_channel');
			     $values[$k]['channel'] = $channelModel->getOne('channel','where id='.$v['channel']);
			}
		}
		$results['page']    = $page;
		$results['values']  = $values;
		return $results;
	}
	/*
	 * 获取详情
	 */
	public function getDetail($data002){
		$Model= M('app_consultation');
           $userinfo2 = $Model->getRow('where id='.$data002['id']);
           if($userinfo2['coursename']){
			if($userinfo2['type']==2){
				$app=M('app_column');
				$userinfo2['coursename'] ='【专栏】'. $app->getOne('title','where columnid='.$userinfo2['coursename']);
			}else{
				$app=M('app_course');
                $userinfo2['coursename'] = '【课程】'.$app->getOne('title','where courseid='.$userinfo2['coursename']);
				}
			}else{
				$userinfo2['coursename'] = '暂无';
			}
			$shoolMoel =M('app_schooladdress');
			if($userinfo2['schoolroomid']){
				$userinfo2['schoolroomid'] = $shoolMoel->getOne('school','where schoolid='.$userinfo2['schoolroomid']);
			}
			if($userinfo2['channel']){
				$channelModel = M('app_consultation_channel');
			     $userinfo2['channel'] = $channelModel->getOne('channel','where id='.$userinfo2['channel']);
			}

//		    $areainfo = $this->cache->getACache('areainfo');
              $areainfo =M('common_area');
		    	if($userinfo2['pid']!=0){
						$userinfo2['pid'] = $areainfo->getOne('city','where id='.$userinfo2['pid']);
				}
				if($userinfo2['cid']!=0){
						$userinfo2['cid'] = $areainfo->getOne('city','where id='.$userinfo2['cid']);
				}
				if($userinfo2['counid']!=0){
					$userinfo2['counid'] = $areainfo->getOne('city','where id='.$userinfo2['counid']);
				}
		$appmodel = M('app_consultation_record');
		$teacher = M('common_user_teacher');
		$where = 'as a left join '.$teacher->table.' as b on a.teacherid=b.userid where a.userid='.$data002['id'];
		$now_page = ChkClng(KS_S('p'));
		$options = $appmodel->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$wordAry = $appmodel->getPage($page,'id desc',$where,'a.*,b.name');
		foreach($wordAry as $k =>$v){
			$wordAry[$k]['addtime'] = date("Y-m-d H:i:s",$v['addtime']);
			$wordAry[$k]['startime'] = date("Y-m-d H:i:s",$v['startime']);
		}
		$result['wordAry']=$wordAry;
		$result['userinfo2']=$userinfo2;
		return $result;
	}
	/*
	 * 获取一周的时间
	 */
	public function getTime($Data003){
		$n = week($Data003['year']);
		if($Data003['week']==0){$year = (int)$Data003['year']-1;$week = week((string)$year);}
		if($n<$Data003['week']){	$year = (int)$year+1;$week =1; }
		 $result = weekday($Data003['year'],$Data003['week']);
		 $nowtime =date('m-d',time());
		 $data=array();
		 for($i=0;$i<7;$i++){
		 	 $time             = $result['start']+$i*86400;
		 	 $data[$i]['time'] = date('m-d',$time);
		 	 $data[$i]['nowtime'] = $time;
		 	 if($Data003['num']==8){
		 	 	if($nowtime ==$data[$i]['time'] ){$data[$i]['status']=1;}else{$data[$i]['status']=0;}
		 	 }else{if($i==$Data003['num']-1){$data[$i]['status']=1;}else{$data[$i]['status']=0;} }

		 }
		 return $data;

	}
	/*
	 * 咨询池数据
	 */
	public function consultingPool($Data004){
		    $Model= M('app_consultation');
		    $where='where status=2 and wxid='.$Data004['wxid'];

			$address = ChkClng(null !==GF('address') ? GF('address'):'0');
			if(isset($Data004['address'])){
		    	$address = $Data004['address'];
		    }else{
		    	$address = ChkClng(null !==GF('address') ? GF('address'):'0');
		    }
		    if($address!=0){$where.=' and schoolroomid='.$address;}

		    if(isset($Data004['channelid'])){
		    	$channelid = $Data004['channelid'];
		    }else{
		    	$channelid = ChkClng(null !==GF('channelid') ? GF('channelid'):'0');
		    }
			if($channelid!=0){$where.=' and channel='.$channelid;}

			if(isset($Data004['classify'])){
		    	$classify = $Data004['classify'];
		    }else{
		    	$classify = ChkClng(null !==GF('classify') ? GF('classify'):'0');
		    }
			if($classify!=0){if($classify==4){$where.=' and type=1';}else{$where.=' and classify='.$classify;}}

			if(isset($Data004['intentionality'])){
		    	$intentionality = $Data004['intentionality'];
		    }else{
		    	$intentionality = ChkClng(null !==GF('intentionality') ? GF('intentionality'):'5');
		    }
			if($intentionality!=5){$where.=' and intentionality='.$intentionality;}
			if(isset($Data004['keyword'])){
			    $keyword = $Data004['keyword'];
			}else{
				$keyword = KS_S('keyword');
			}
			$keytype = ChkClng(KS_S('keytype'));
			$timetype = ChkClng(null !==GF('timetype') ? GF('timetype'):'0');
			$result = ChkClng(null !==GF('result') ? GF('result'):'4');
			if($result!=4){$where.=' and restult='.$result;}
			if($keyword){$where.=' and membername like "%'.$keyword.'%"';}
			$options = $Model->getOptions($Data004['maxPerPage'],$where);//分页参数设置
			if(isset($Data004['now_page'])){
				$options['now_page'] = $Data004['now_page'];
			}else{
				$options['now_page'] = null !==GF('p') ? GF('p'):'1';
			}
			$page = Page($options);
			$values = $Model->getPage($page,'id desc',$where);
			foreach($values as $k =>$v){
				if($v['type']==1){
					$app = M('app_column');
					$values[$k]['coursename'] ='【专栏】'. $app->getOne('title','where columnid='.$v['coursename']);
				}else{
					$app = M('app_course');
					$values[$k]['coursename'] ='【课程】'. $app->getOne('title','where courseid='.$v['coursename']);
				}
				if($v['schoolroomid']){
					$shoolMoel =M('app_schooladdress');
				    $values[$k]['schoolroomid'] = $shoolMoel->getOne('school','where schoolid='.$v['schoolroomid']);
				}
				if($v['channel']){
					$channelModel = M('app_consultation_channel');
				    $values[$k]['channel'] = $channelModel->getOne('channel','where id='.$v['channel']);
				}

			}
			$results['page']    = $page;
		    $results['values']  = $values;
		    return $results;
	}
	/*
	 * 更改记录状态
	 */
	public function changeStatus($Data005){
		$Model= M('app_consultation');
		$data['status'] = $Data005['status'];
		$data['lasttime'] = time();
		$Model->update($data,'id='.$Data005['id']);
		return true;
	}
	/*
	 * 咨询池领取
	 */
	public function receive($Data006){
		$Model= M('app_consultation');
		$data['status']=0;
		$data['userid'] = $Data006['userid'];
		$res = $Model->update($data,'id='.$Data006['id']);
		if($res){return true;}else{return false;}

	}
	/*
	 * 渠道页面数据
	 */
	public function channelShow($Data007){
		$Model = M('app_consultation_channel');
		$userModel = M('common_user');
		$teacherModel = M('common_user_teacher');
		$schoolModel = M('common_user_school');
		$where = 'as a left join '.$userModel->table.' as b on a.userid=b.userid';
		if(isset($Data007['maxPerPage'])){
			$maxPerPage = $Data007['maxPerPage'];
		}else{$maxPerPage=10;}
		$options = $Model->getOptions($maxPerPage,$where.' where a.wxid='.$Data007['wxid']);//分页参数设置
		$options['now_page'] =$Data007['now_page'];
		$page = Page($options);
		$values = $Model->getPage($page,'id desc',$where.' where a.wxid='.$Data007['wxid'],'a.id,a.channel,a.adddate,a.userid,b.usertype');
		foreach($values as $k =>$v){
			if($v['usertype']==1){
				$values[$k]['name'] = $teacherModel->getOne('name','where userid='.$v['userid']);
			}elseif($v['usertype']==2){
				$values[$k]['name'] = $schoolModel->getOne('name','where userid='.$v['userid']);
			}
		}
		$results['page']    = $page;
		    $results['values']  = $values;
		    return $results;
	}
	/*
	 * 删除渠道
	 */
	public function deleteChannel($Data008){
		$Model = M('app_consultation_channel');
		$res = $Model->delete(' id='.$Data008['id']);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	/*
	 * 添加回访记录
	 */
	public function addReturnvisit($Data009){
		$Model = M('app_consultation');
		$count = $Model->getOne('number','where id='.$Data009['id']);
		$data['lasttime']=$Data009['lasttime'];
		$data['nexttime']=$Data009['nexttime'];
		$data['number']=intval($count)+1;

		$data['restult']=$Data009['restult'];
		if($data['restult']==1||$data['restult']==4){
			$data['status']=3;
		}else{
			$data['status']=1;
		}
		$data['mark']=$Data009['mark'];

		$Model->update($data,'id='.$Data009['id']);
		$Datas['startime']=$Data009['lasttime'];
		$Datas['restult']=$Data009['restult'];
		$Datas['mark']=$Data009['mark'];
		$Datas['userid']=$Data009['id'];
		$Datas['addtime']=time();
		$Datas['teacherid']=$Data009['userid'];
		$appmodel = M('app_consultation_record');
		$appmodel->doadd($Datas,'id');
		if($Datas['restult']==3){
			$Data['memberid'] = $Data009['id'];
			$Data['adddate']  = time();
			$listion = M('app_consultation_listen');
			$Rule['memberid'] = '会员用户名|isDbexis';
			$checkfinal=Chkpost($Data,$Rule,$listion);//检测账号是否存在；
			$listion->doadd($Data,'id');
		}
		return true;
	}
	/*
	 * 添加渠道
	 */
    public function addChannel($Data010){
    	$data['channel'] =$Data010['channel'];
		$data['adddate'] = time();
		$data['wxid'] = $Data010['wxid'];
		$data['userid'] = $Data010['userid'];
		$Model = M('app_consultation_channel');
		$res = $Model ->getAll('where channel="'.$Data010['channel'].'" and wxid='.$Data010['wxid'],'id');
		if($res){
			return false;
		}
		$Model->doadd($data,'id');
		return true;
    }

    public function editChannel($Data013){
    	$Model = M('app_consultation_channel');
    	$data['channel'] = $Data013['channel'];
    	$res1 = $Model ->getAll('where channel="'.$Data013['channel'].'" and wxid='.$Data013['wxid'],'id');
		if($res1){
			return false;
		}
		$res = $Model->update($data,'id='.$Data013['id']);
		return true;
    }
    /*
     * 获取成交，待办，新增等数据
     */
    public function getUpdata($Data011){
    	if($Data011['timetype']==1){
    		 $stattime= mktime(23, 59 , 59,date("m"),date("d")-1,date("Y"));
		     $endtime= mktime(0, 0 , 0,date("m"),date("d")+1,date("Y"));
    	}elseif($Data011['timetype']==2){
           $week     = date('W',time());//当前是的那一周
     	   $year     = date('Y',time());
     	   $ee=weekday($year,$week);
     	   $endtime = $ee['end'];
     	   $stattime = $ee['start'];
    	}elseif($Data011['timetype']==3){
    		 $date = date("Y-m-d");
             $firstday = date('Y-m-01', strtotime($date));;  //本月第一天
             $stattime = strtotime($firstday);
             $endtime = strtotime("$firstday +1 month -1 day"); //本月最后一天
    	}
    	$Model = M('app_consultation');
		$successCount = $Model->getOne('count(id)','where userid='.$Data011['userid'].' and (nexttime>='.$stattime.' and nexttime<='.$endtime.') and (status=1 or status=0)');
		$todayaddCount = $Model->getOne('count(id)','where userid='.$Data011['userid'].' and (adddate>='.$stattime.' and adddate<='.$endtime.')');
		$todaysucceCount = $Model->getOne('count(id)','where userid='.$Data011['userid'].' and (lasttime>='.$stattime.' and lasttime<='.$endtime.') and status=3');
		$result['waitcount'] = $successCount;
		$result['todayadd'] = $todayaddCount;
		$result['todaysucc'] = $todaysucceCount;

	    return $result;
    }
    /*
     * 获取漏斗数据统计
     */
    public function funnelData($Data012){
    	$where1= '';
    	$where2= '';
    	$where3= '';
    	if(isset($Data012['start']) && isset($Data012['end'])){
			if($Data012['start']!=0&&$Data012['end']!=0){
				$start= strtotime($Data012['start']);
				$end= strtotime($Data012['end']);
				$where1 = ' and (lasttime>='.$start.' and lasttime<='.$end.')';
				$where2=	' and (nexttime>='.$stattime.' and nexttime<='.$endtime.')';
				$where3=	' and (adddate>='.$stattime.' and adddate<='.$endtime.')';
			}
    	}
        if(isset($Data012['timetype'])){
	    	if($Data012['timetype']==1){
	    		$endtime = mktime(0, 0 , 0,date("m"),date("d")+1,date("Y"))+1;
			    $stattime = mktime(23, 59 , 59,date("m"),date("d")-1,date("Y"))-1;
	    	}elseif($Data012['timetype']==2){
	           $week     = date('W',time());//当前是的那一周
	     	   $year     = date('Y',time());
	     	   $ee=weekday($year,$week);
	     	   $endtime = $ee['end']+1;
	     	   $stattime = $ee['start']-1;
	    	}elseif($Data012['timetype']==3){
	    		 $date = date("Y-m-d");
	             $firstday = date('Y-m-01', strtotime($date));  //本月第一天
	             $stattime = strtotime($firstday)-1;
	             $endtime = strtotime("$firstday +1 month -1 day")+1; //本月最后一天
	    	}
	    	$where1 = ' and (lasttime>='.$stattime.' and lasttime<='.$endtime.')';
				$where2=	' and (nexttime>='.$stattime.' and nexttime<='.$endtime.')';
	    	$where3=	' and (adddate>='.$stattime.' and adddate<='.$endtime.')';
        }
        $Model = M('app_consultation');
		$successCount = $Model->getOne('count(id)','where userid='.$Data012['userid'].' and (status=3 or status=4)'.$where1);
		$waitCount = $Model->getOne('count(id)','where userid='.$Data012['userid'].' and (status=0 or status=1)'.$where2);
		$moveCount = $Model->getOne('count(id)','where userid='.$Data012['userid'].' and status=1'.$where1);
		$listen = M('app_consultation_listen');
		$where = ' where userid='.$Data012['userid'].' and restult=5 and status!=2';
		$listenCount = $Model->getOne('count(id)',$where.$where1);
		$sum = $Model->getOne('count(id)','where userid='.$Data012['userid'].' and status!=2 '.$where3);

		$Data['succes'] = $successCount;
		$Data['wait'] = $waitCount;
		$Data['move'] = $moveCount;
		$Data['listen'] = $listenCount;
		$Data['sum'] = $sum;
		return $Data;
    }
}
