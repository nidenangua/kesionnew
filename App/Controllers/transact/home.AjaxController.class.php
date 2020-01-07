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
		
		 $n = week($year);
		 if($week==0){
		 	$year = (int)$year-1;
		 
		 	$week = week((string)$year);
		 }
		 if($n<$week){
		 	$year = (int)$year+1;
		 	$week =1;
		 }
		 $result = weekday($year,$week);
		 $nowtime =date('m-d',time());
		 $data=array();
		 for($i=0;$i<7;$i++){
		 	 $time =$result['start']+$i*86400;
		 	 $data[$i]['time']=date('m-d',$time);
		 	 $data[$i]['nowtime'] = $time;
		 	 if($num==8){
		 	 	if($nowtime ==$data[$i]['time'] ){
			 	 	$data[$i]['status']=1;
			 	 }else{
			 	 	$data[$i]['status']=0;
			 	 }
		 	 }else{
		 	 	if($i==$num-1){
		 	 		$data[$i]['status']=1;
		 	 	}else{
		 	 		$data[$i]['status']=0;
		 	 	}
		 	 }
		 	
		 }
		 echo json_encode($data);
	}


	/*
	 * 指定日期的代办事件
	 */
	public function getdetailAction(){
		$year = ChkClng(KS_G('post.year'));
		$time = ChkSQL(KS_G('post.time'));
//		$newtime = strtotime($year.'-'.$time);
     	$endtime  = mktime(0, 0 , 0,date("m",$time),date("d",$time)+1,$year);
		$stattime = mktime(23, 59 , 59,date("m",$time),date("d",$time)-1,$year);
		$values   = $this->AppModel->getAll('where (nexttime>'.$stattime.' and nexttime<'.$endtime.') and userid='.$this->userid);
//			var_dump($values);
		foreach($values as $k =>$v){
			$values[$k]['href'] = M_URL($this->AppName.'/Index','consultingdetails',$v['id'],GP(''));
				if($v['coursename']){
					
					if($v['type']==2){
						$app=M('app_class');
						$values[$k]['coursename'] = $app->getOne('title','where classid='.$v['coursename']);
					}else{
						$app=M('app_course');
						$values[$k]['coursename'] = $app->getOne('title','where courseid='.$v['coursename']);
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
			echo json_encode($values);
	}
	
	/*
	 * 我的咨询本首页漏斗图数据
	 */
	public function getAlldataAction(){
		$start = ChkSQL(KS_G('post.start'));
		$end = ChkSQL(KS_G('post.end'));
		$where1= '';
		$where2='';
		if($start!=0&&$end!=0){
			$start= strtotime($start);
			$end= strtotime($end);
			$where1 = ' and (lasttime>'.$start.' and lasttime<'.$end.')';
			$where2 = ' and (b.listentime>'.$start.' and b.listentime<'.$end.')';
		}
		$successCount = $this->AppModel->getOne('count(id)','where (userid='.$this->userid.' or newpeople='.$this->userid.') and (status=3 or status=4)'.$where1);
		$waitCount = $this->AppModel->getOne('count(id)','where (userid='.$this->userid.' or newpeople='.$this->userid.') and status=0'.$where1);
		$moveCount = $this->AppModel->getOne('count(id)','where (userid='.$this->userid.' or newpeople='.$this->userid.') and status=1'.$where1);
		$listen = M('app_consultation_listen');
		$where = 'as a left join '.$listen->table.' as b on a.id=b.memberid where (a.userid='.$this->userid.' or a.newpeople='.$this->userid.') and b.status=3';
		$listenCount = $this->AppModel->getOne('count(a.id)',$where.$where2);
		$sum = $this->AppModel->getOne('count(id)','where (userid='.$this->userid.' or newpeople='.$this->userid.')'.$where1);
		
		$Data['succes'] = $successCount;
		$Data['wait'] = $waitCount;
		$Data['move'] = $moveCount;
		$Data['listen'] = $listenCount;
		$Data['sum'] = $sum;
		echo json_encode($Data);
	}
}
