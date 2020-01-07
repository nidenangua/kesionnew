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
			
			  include  CURR_VIEW_PATH . "index.php"; 
	}
	//统计用户
	public function coutUserAction(){
		$type = KS_G('post.type');
		if(empty($type)){$type =1;}
		//1 年 2 月 3 周 4 日
		//获取用户注册的缓存
		$user      = $this->cache->GetHCache('users',$this->wxid);//读取缓存
		//获取微信公众号的数据
		$Model     = M('app_weixin_user');
		$fansinfo  = $Model->getAll("where wxid=$this->wxid and subscribe = 1");
		$year      = date('Y');
		$month     = date('n');
		switch($type){
			case 1:
				$day = array();$day2 = array();
				for($i = 1 ;$i<=12;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;$flag2 = 0;
					$startime = date("Y-".$ii);
					foreach($user as $k =>$v){
						if(date('Y-m',$v['regdate']) == $startime ){
							if($v['usertype'] == 0){$flag++;}
						}
					}
					foreach($fansinfo as $k =>$v){
						if(date('Y-m',$v['subscribe_time']) == $startime ){$flag2++;}
					}
					$day[$i-1] = $flag2;
					$day2[$i-1] = $flag;
				}break;
			case 2:
				$day = array();$day2 = array();
				$daysInMnth = date('t',mktime(0,0,0,$month,1,$year));
				for($i = 1 ;$i<=$daysInMnth;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;$flag2 = 0;
					$startime = date("Y-m-".$ii);
					foreach($user as $k =>$v){
						if(date('Y-m-d',$v['regdate']) == $startime ){
							if($v['usertype'] == 0){$flag++;}
						}
					}
					foreach($fansinfo as $k =>$v){
						if(date('Y-m-d',$v['subscribe_time']) == $startime ){$flag2++;}
					}
					$day[$i-1] = $flag2;
					$day2[$i-1] = $flag;
				}break;
			case 3:
				$day = array();$day2 = array();
				if(date("w")==0){$wday = 7;}else{$wday = date("w");}
				for($i = 1 ;$i<=7;$i++){
					$flag = 0;$flag2 = 0;
					$startime = date("Y-m-d",mktime(0, 0 , 0,date("m"),date("d")-$wday+$i,date("Y")));
					foreach($user as $k =>$v){
						if(date('Y-m-d',$v['regdate']) == $startime ){
							if($v['usertype'] == 0){$flag++;}
						}
					}
					foreach($fansinfo as $k =>$v){
						if(date('Y-m-d',$v['subscribe_time']) == $startime ){$flag2++;}
					}
					$day[$i-1] = $flag2;
					$day2[$i-1] = $flag;
				}break;
			case 4:
				$day = array();$day2 = array();
				for($i=0;$i<=23;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag     = 0;$flag2 = 0;
					$startime = date('Y-m-d '.$ii);
					foreach($user as $k =>$v){
						if(date('Y-m-d H',$v['regdate']) == $startime){
							if($v['usertype'] == 0){$flag++;}
						}
					}
					foreach($fansinfo as $k =>$v){
						if(date('Y-m-d H',$v['subscribe_time']) == $startime ){$flag2++;}
					}
					$day[$i]  = $flag;
					$day2[$i] = $flag2;
				}break;
		}
		echo json_encode(array('students'=>$day,'fans'=>$day2));exit;
	}
	//统计订单
	public function coutOrderAction(){
		$type = KS_G('post.type');
		if(empty($type)){$type =2;}
		//1 年 2 月 3 周 4 日
		//获取订单的数据
		$Model     = M('app_order');
		$orderinfo = $Model->getAll("where wxid=$this->wxid");
		$year       = date('Y');
		$month      = date('n');
		$day        = array();
		$day2       = array();
		switch($type){
			case 1:
				for($i = 1 ;$i<=12;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;$flag2 = 0;
					$startime = date("Y-".$ii);
					foreach($orderinfo as $k =>$v){
						if(date('Y-m',$v['adddate']) == $startime ){
							$flag +=1;//总订单数
							if($v['paystatus']==1){//已支付订单数
							   $flag2 +=1;
							}
						}
					}
					$day[$i-1] = $flag;
					$day2[$i-1] = $flag2;
				}break;
			case 2:
				$daysInMnth = date('t',mktime(0,0,0,$month,1,$year));
				for($i = 1 ;$i<=$daysInMnth;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;$flag2 = 0;
					$startime = date("Y-m-".$ii);
					foreach($orderinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$flag +=1;//总订单数
							if($v['paystatus']==1){//已支付订单数
							   $flag2 +=1;
							}
						}
					}
					$day[$i-1]  = $flag;
					$day2[$i-1] = $flag2;
				}break;
			case 3:
			    if(date("w")==0){$wday = 7;}else{$wday = date("w");}
				for($i = 1 ;$i<=7;$i++){
					$flag = 0;$flag2 = 0;
					$startime = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-$wday+$i,date("Y")));
					//var_dump($startime);exit;
					foreach($orderinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$flag +=1;//总订单数
							if($v['paystatus']==1){//已支付订单数
							   $flag2 +=1;
							}
						}
					}
					$day[$i-1] = $flag;
					$day2[$i-1] = $flag2;
				}break;
			case 4:
				for($i=0;$i<=23;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag     = 0;$flag2 = 0;
					$startime = date('Y-m-d '.$ii);
					foreach($orderinfo as $k =>$v){
						if(date('Y-m-d H',$v['adddate']) == $startime){
							$flag +=1;//总订单数
							if($v['paystatus']==1){//已支付订单数
							   $flag2 +=1;
							}
						}
					}
					$day[$i] = $flag;
					$day2[$i] = $flag2;
				}break;
		}
		echo json_encode(array('sumorder'=>$day,'payorder'=>$day2));exit;
	}
	//统计资金
	public function coutCapitalAction(){
		$type = KS_G('post.type');
		if(empty($type)){$type =1;}
		//1 年 2 月 3 周 4 日//获取缓存
		//获取收入的数据
		$Model         = M('app_pay_log');
		$incomeinfo    = $Model->getAll("where wxid=$this->wxid and type=1");
		//获取支出的数据
		$Model         = M('common_pay_log');
		$expendinfo    = $Model->getAll("where wxid=$this->wxid and type=1");
		$year          = date('Y');
		$month         = date('n');
		switch($type){
			case 1:
				$day = array();$day2 = array();
				for($i = 1 ;$i<=12;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;$flag2= 0;
					$startime = date("Y-".$ii);
					foreach($incomeinfo as $k =>$v){
						if(date('Y-m',$v['adddate']) == $startime ){
							$flag += $v['cmoney'];
						}
					}
					foreach($expendinfo as $k =>$v){
						if(date('Y-m',$v['adddate']) == $startime ){
							$flag2 += $v['cmoney'];
						}
					}
					$day[$i-1]  = $flag;
					$day2[$i-1] = $flag2;
				}break;
			case 2:
				$day = array();$day2 = array();
				$daysInMnth = date('t',mktime(0,0,0,$month,1,$year));
				for($i = 1 ;$i<=$daysInMnth;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;$flag2= 0;
					$startime = date("Y-m-".$ii);
					foreach($incomeinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$flag += $v['cmoney'];
						}
					}
					foreach($expendinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$flag2 += $v['cmoney'];
						}
					}
					$day[$i-1]  = $flag;
					$day2[$i-1] = $flag2;
				}break;
			case 3:
				$day = array();$day2 = array();
				if(date("w")==0){$wday = 7;}else{$wday = date("w");}
				for($i = 1 ;$i<=7;$i++){
					$flag = 0;$flag2= 0;
					$startime = date("Y-m-d",mktime(0, 0 , 0,date("m"),date("d")-$wday+$i,date("Y")));
					foreach($incomeinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$flag += $v['cmoney'];
						}
					}
					foreach($expendinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$flag2 += $v['cmoney'];
						}
					}
					$day[$i-1]  = $flag;
					$day2[$i-1] = $flag2;
				}break;
			case 4:
				$day = array();$day2 = array();
				for($i=0;$i<=23;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;$flag2= 0;
					$startime = date('Y-m-d '.$ii);
					foreach($incomeinfo as $k =>$v){
						if(date('Y-m-d H',$v['adddate']) == $startime){
							$flag += $v['cmoney'];
						}
					}
					foreach($expendinfo as $k =>$v){
						if(date('Y-m-d H',$v['adddate']) == $startime){
							$flag2 += $v['cmoney'];
						}
					}
					$day[$i]  = $flag;
					$day2[$i] = $flag2;
				}break;
		}
		echo json_encode(array('incomeinfo'=>$day,'expendinfo'=>$day2));exit;
	}
	//统计数据
	public function coutDataAction(){
		$type = KS_G('post.type');
		if(empty($type)){$type =1;}
		//1 年 2 月 3 周 4 日//获取缓存
		//获取用户注册的缓存
		$student       = $this->cache->GetH('users','usertype','0','',$this->wxid);//读取学生数量缓存
		$teacher       = $this->cache->GetH('users','usertype','1','',$this->wxid);//读取老师数量缓存
		switch($type){
			case 1:
			$day[0]    = count($student);
			$day[1]    = count($teacher);
			//微信公众号关注人数
		    $weixin_user   = M('app_weixin_user');
			$day[2]        = ChkClng($weixin_user->getOne('count(*)',"where wxid=$this->wxid"));
			//班级人数
		    $app_class     = M('app_class');
			$day[3]        = ChkClng($app_class->getOne('count(*)',"where wxid=$this->wxid"));
			//课程人数
		    $app_course    = M('app_course');
			$day[4]        = ChkClng($app_course->getOne('count(*)',"where wxid=$this->wxid"));
			//考卷数
		    $app_paper     = M('app_paper');	
			$day[5]        = ChkClng($app_paper->getOne('count(*)',"where wxid=$this->wxid"));
			//作业数
		    $app_task      = M('app_task');
			$day[6]        = ChkClng($app_task->getOne('count(*)',"where wxid=$this->wxid"));
			//剩余短信
			$day[7]        = getLimitService(1)/1000;
			//剩余邮箱
			$day[8]        = getLimitService(2)/1000;
			//剩余流量
			$day[9]        = getLimitService(3)/1024;
			//剩余点播空间
			$day[10]       = getLimitService(5)/1024;
			//剩余连麦分钟数
			$day[11]       = getLimitService(2)/1000;
			break;
		}
		echo json_encode(array('datainfo'=>$day));exit;
	}
	public function coutPaperAction(){
		$type = KS_G('post.type');
		if(empty($type)){
			$type =1;
		}
		//1 年 2 月 3 周 4 日
		//获取缓存
		$paper = $this->cache->GetHCache('paper',$this->wxid);//读取缓存
		$paper_tk = $this->cache->GetHCache('paper_tk',$this->wxid);//读取缓存
		$year = date('Y');
		$month = date('n');
		switch($type){
			case 1:
				$day = array();
				$day2 = array();
				for($i = 1 ;$i<=12;$i++){
					if($i<10){
						$ii = '0'.$i;
					}else{
						$ii = $i;
					}
					$flag = 0;
					$flag2= 0;
					$startime = date("Y-".$ii);
					foreach($paper as $k =>$v){
						if(date('Y-m',$v['adddate']) == $startime ){
							$flag ++;
						}
					}
					foreach($paper_tk as $k =>$v){
						if(date('Y-m',$v['adddate']) == $startime ){
							$flag2 ++;
						}
					}
					$day[$i-1] = $flag;
					$day2[$i-1] = $flag2;
				}
				echo json_encode(array('k'=>$day,'t'=>$day2));exit;
			case 2:
				$day = array();
				$day2 = array();
				$daysInMnth = date('t',mktime(0,0,0,$month,1,$year));
				for($i = 1 ;$i<=$daysInMnth;$i++){
					if($i<10){
						$ii = '0'.$i;
					}else{
						$ii = $i;
					}
					$flag = 0;
					$flag2= 0;
					$startime = date("Y-m-".$ii);
					foreach($paper as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$flag ++;
						}
					}
					foreach($paper_tk as $k =>$v){
						if(date('Y-m',$v['adddate']) == $startime ){
							$flag2 ++;
						}
					}
					$day[$i-1] = $flag;
					$day2[$i-1] = $flag2;
				}
				echo json_encode(array('k'=>$day,'t'=>$day2));exit;
			case 3:
				$day = array();
				$day2 = array();
				for($i = 1 ;$i<=7;$i++){
					$flag = 0;
					$flag2= 0;
					$startime = date("Y-m-d",mktime(0, 0 , 0,date("m"),date("d")-date("w")+$i,date("Y")));
					foreach($paper as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							$flag ++;
						}
					}
					foreach($paper_tk as $k =>$v){
						if(date('Y-m',$v['adddate']) == $startime ){
							$flag2 ++;
						}
					}
					$day[$i-1] = $flag;
					$day2[$i-1] = $flag2;
				}
				echo json_encode(array('k'=>$day,'t'=>$day2));exit;
			case 4:
				$day = array();
				$day2 = array();
				for($i=0;$i<=23;$i++){
					if($i<10){
						$ii = '0'.$i;
					}else{
						$ii = $i;
					}
					$flag = 0;
					$flag2= 0;
					$date = date('Y-m-d '.$ii);
					foreach($paper as $k =>$v){
						if(date('Y-m-d H',$v['adddate']) == $date){
							$flag ++;
						}
					}
					foreach($paper_tk as $k =>$v){
						if(date('Y-m',$v['adddate']) == $startime ){
							$flag2 ++;
						}
					}
					$day[$i-1] = $flag;
					$day2[$i-1] = $flag2;
				}
				echo json_encode(array('k'=>$day,'t'=>$day2));exit;
				exit;
		}
		
	}
	public function coutCourseAction(){
		$type = KS_G('post.type');
		if(empty($type)){
			$type =4;
		}
		//1 年 2 月 3 周 4 日
		//获取缓存
		$courseinfo = $this->cache->GetHCache('courseinfo',$this->wxid);//读取缓存
		switch($type){
			case 1:
				$day = array();
				$flag = 0;
				$flag2= 0;
				$flag3= 0;
				$flag4= 0;
				$startime = date("Y");
				foreach($courseinfo as $k =>$v){
					if(date('Y',$v['adddate']) == $startime ){
						if($v['courseType'] == 1){
							$flag++;
						}elseif($v['courseType'] == 2){
							$flag2++;
						}elseif($v['courseType'] == 3){
							$flag3++;
						}elseif($v['courseType'] == 4){
							$flag4++;
						}
					}
				}
				$day[] = array('点播',$flag);
				$day[] = array('直播',$flag2);
				$day[] = array('面授',$flag3);
				$day[] = array('混合',$flag4);
				if($flag == 0 && $flag2 == 0 && $flag3==0 && $flag4==0){
					$day  = array();
					$day[] = array('暂无数据',100);
				}
				echo json_encode($day);exit;
			case 2:
				$day = array();
				$flag = 0;
				$flag2= 0;
				$flag3= 0;
				$flag4= 0;
				$startime = date("Y-m");
				foreach($courseinfo as $k =>$v){
					if(date('Y-m',$v['adddate']) == $startime ){
						if($v['courseType'] == 1){
							$flag++;
						}elseif($v['courseType'] == 2){
							$flag2++;
						}elseif($v['courseType'] == 3){
							$flag3++;
						}elseif($v['courseType'] == 4){
							$flag4++;
						}
					}
				}
				$day[] = array('点播',$flag);
				$day[] = array('直播',$flag2);
				$day[] = array('面授',$flag3);
				$day[] = array('混合',$flag4);
				if($flag == 0 && $flag2 == 0 && $flag3==0 && $flag4==0){
					$day  = array();
					$day[] = array('暂无数据',100);
				}
				echo json_encode($day);exit;
			case 3:
				
				$startime = date("Y-m-d",mktime(0, 0 , 0,date("m"),date("d")-date("w")+$i,date("Y")));
				exit;
			case 4:
				$day = array();
				$flag = 0;
				$flag2= 0;
				$flag3= 0;
				$flag4= 0;
				$date = date('Y-m-d');
				foreach($courseinfo as $k =>$v){
					if(date('Y-m-d',$v['adddate']) == $date){
						if($v['courseType'] == 1){
							$flag++;
						}elseif($v['courseType'] == 2){
							$flag2++;
						}elseif($v['courseType'] == 3){
							$flag3++;
						}elseif($v['courseType'] == 4){
							$flag4++;
						}
					}
				}
				$day[] = array('点播',$flag);
				$day[] = array('直播',$flag2);
				$day[] = array('面授',$flag3);
				$day[] = array('混合',$flag4);
				if($flag == 0 && $flag2 == 0 && $flag3==0 && $flag4==0){
					$day  = array();
					$day[] = array('暂无数据',100);
				}
				echo json_encode($day);exit;
				exit;
		}
	}
	
}
  