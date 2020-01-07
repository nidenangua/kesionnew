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
class AjaxController extends CommonController
{
   
	
	//获取当前周的时间轴
	public function getDateAction(){
		 $year =  ChkSQL(KS_G("post.year"));
		 $week =  ChkSQL(KS_G("post.week"));
		 $num =  ChkSQL(KS_G("post.num"));
		 $Data003['year'] = $year;
		 $Data003['week'] = $week;
		 $Data003['num']  = $num;
		 $ConsultModel          = M('App/ConsultModel');
		 $results               = $ConsultModel->getTime($Data003);
		 echo json_encode($results);
	}


	/*
	 * 指定日期的代办事件
	 */
	public function getdetailAction(){
		$year = ChkClng(KS_G('post.year'));
		$time = ChkSQL(KS_G('post.time'));
     	$endtime  = mktime(0, 0 , 0,date("m",$time),date("d",$time)+1,date("Y",$time));
	    $stattime = mktime(23, 59 , 59,date("m",$time),date("d",$time)-1,date("Y",$time));
	    $Model= M('app_consultation');
	    $values   = $Model->getAll('where (nexttime>'.$stattime.' and nexttime<'.$endtime.')and status!=2 and userid='.$this->userid);
		foreach($values as $k =>$v){
			$values[$k]['href'] = M_URL($this->AppName.'/Index','consultingdetails',$v['id'],GP(''));
				if($v['coursename']){
					$app=M('app_course');
					$values[$k]['coursename'] = $app->getOne('title','where courseid='.$v['coursename']);
					
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
			echo json_encode($values);
	}
	
	/*
	 * 我的咨询本首页漏斗图数据
	 */
	public function getAlldataAction(){
		$start = ChkSQL(KS_G('post.start'));
		$end = ChkSQL(KS_G('post.end'));
		 $Data012['start'] = $start;
		 $Data012['end']  = $end;
		 $Data012['userid'] = $this->userid;
		 $ConsultModel          = M('App/ConsultModel');
		 $results               = $ConsultModel->funnelData($Data012);
		echo json_encode($results);
	}
}
