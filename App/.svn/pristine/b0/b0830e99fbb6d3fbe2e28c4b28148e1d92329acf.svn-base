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
//namespace Kesion\Model\App;


use KESION\Model;
class  CourseModel extends Model{

	public static $liveType = [1=>'一对一视频直播',2=>'小班视频直播',3=>'千人视频直播',4=>'语音直播'];
	public static $courseType = [1=>'视频',2=>'直播',3=>'音频',4=>'图文',5=>'面授',6=>'活动',7=>'训练营',8=>'教辅周边'];

	public function getCourse(){
	    $userid=ChkClng($_SESSION['user']['userid']);
		$sql = "select * from $this->table where userid = $userid";
        $course = $GLOBALS['db']->getAll($sql);
		return $course;
	}
	public function doaddChapter($Data,$prikeyname){
		$prikeyname = ChkSQL($prikeyname);
		$Data["$prikeyname"] = $GLOBALS['db']->getMaxValue($this->table,"$prikeyname")+1;
			$Data["root"] = $GLOBALS['db']->getMaxValue($this->table,"root")+1;
			$Data['orderid'] = 1;
			$Data['depth'] = 1;
			$Data['deepness']=1;
		    $Data['parentidpath'] = $Data["$prikeyname"];
			$result = $GLOBALS['db']->insert($this->table,$Data);
        return $result;
	}
	public function doaddSection($Data,$prikeyname){
		$prikeyname = ChkSQL($prikeyname);
		$Data["$prikeyname"] = $GLOBALS['db']->getMaxValue($this->table,"$prikeyname")+1;
		if($Data['parentid']==0){
			$Data["root"]    = $GLOBALS['db']->getMaxValue($this->table,"root")+1;
			$Data['orderid'] = 1;
			$Data['deepness']=1;
		    $Data['parentidpath'] = $Data["$prikeyname"];
			$result = $GLOBALS['db']->insert($this->table,$Data);
		}else{
			$sql = "select * FROM $this->table where chapterid=$Data[parentid] limit 1";
			$parentcategory = $GLOBALS['db']->getRow($sql);
			$Data['root']   = $parentcategory['root'];
			if($parentcategory['child']==0){
				$Data['orderid'] = $parentcategory['orderid']+1;
			}else{
				$sql ="select * from $this->table where parentid=$Data[parentid] order by orderid desc limit 1";
			    $orderto = $GLOBALS['db']->getRow($sql);

			    $oldorders = $GLOBALS['db']->getOne("select count(*) from `$this->table` where parentidpath like '%$orderto[parentidpath],%' or chapterid=$orderto[chapterid]");

			    $Data['orderid'] = $orderto['orderid']+$oldorders;
			}
			$Data['depth'] = 2;
			$Data['deepness']=$parentcategory['deepness']+1;
			$Data['parentidpath'] = $parentcategory['parentidpath'].','.$Data["$prikeyname"];
			$sql = "update $this->table set orderid=orderid+1 where orderid>=$Data[orderid] and root=$Data[root]";
			$GLOBALS['db']->execSql($sql);
			$GLOBALS['db']->insert($this->table,$Data);
			$sql = "update $this->table set child=child+1 where chapterid=$Data[parentid]";
			$result=$GLOBALS['db']->execSql($sql);
		}
        return $result;
	}
	public function doaddkeshi($Data,$prikeyname){
		$prikeyname          = ChkSQL($prikeyname);
		$Data["$prikeyname"] = $GLOBALS['db']->getMaxValue($this->table,"$prikeyname")+1;
		if($Data['parentid']==0){
			$Data["root"] = $GLOBALS['db']->getMaxValue($this->table,"root")+1;
			$Data['orderid'] = 1;
			$Data['depth'] = 3;
			$Data['deepness']=1;
		    $Data['parentidpath'] = $Data["$prikeyname"];
			$result = $GLOBALS['db']->insert($this->table,$Data);
		}else{
			$sql = "select * FROM $this->table where chapterid=$Data[parentid] limit 1";
			$parentcategory = $GLOBALS['db']->getRow($sql);
			$Data['root']   = $parentcategory['root'];
			if($parentcategory['child']==0){
				$Data['orderid'] = $parentcategory['orderid']+1;
			}else{
				$sql ="select * from $this->table where chapterid=$Data[parentid] order by orderid desc limit 1";
			    $orderto = $GLOBALS['db']->getRow($sql);

			    $oldorders = $GLOBALS['db']->getOne("select count(*) from `$this->table` where parentidpath like '%$orderto[parentidpath],%' or chapterid=$orderto[chapterid]");

			     $Data['orderid'] = $orderto['orderid']+$oldorders;
			}
			$Data['depth'] = 3;
			$Data['deepness']=$parentcategory['deepness']+1;
			$Data['parentidpath'] = $parentcategory['parentidpath'].','.$Data["$prikeyname"];
			$sql = "update $this->table set orderid=orderid+1 where orderid>=$Data[orderid] and root=$Data[root]";
			$GLOBALS['db']->execSql($sql);
			$GLOBALS['db']->insert($this->table,$Data);
			$sql = "update $this->table set child=child+1 where chapterid=$Data[parentid]";
			$result=$GLOBALS['db']->execSql($sql);
		}
        return $GLOBALS['db']->getMaxValue($this->table,"$prikeyname");
	}
	//删除课时
	public function delchapter($prikeyid){
		$sql = "delete from $this->table where parentidpath like '%$prikeyid%'";
		$GLOBALS['db']->execSql($sql);
    }
	public function getSection($parentid,$courseid){
		$userid = $_SESSION['user']['userid'];
		$sql    = "select * from $this->table where userid = $userid and parentid=$parentid and courseid=$courseid";
        return $GLOBALS['db']->getAll($sql);
	}
	//查找老师分页
    public function getTeacherOptions($maxperpage,$userid){
		$maxperpage   = ChkClng($maxperpage);
		$teacherModel = new CourseModel('common_user_teacher');
		$sql   = "select count(*) from $this->table as a left join $teacherModel->table as b on a.userid = b.userid where a.parentid=$userid and usertype=1";
		$total = $GLOBALS['db']->getOne($sql);
		$options = array('totalput' => $total,    //总行数
             'maxperpage'  => $maxperpage,        //每页显示量
        );
        return $options;
   }
   public function getTeacherPage($page,$userid){
		$teacherModel = new CourseModel('common_user_teacher');
		$sql = "select * from $this->table as a left join $teacherModel->table as b on a.userid = b.userid where a.parentid=$userid and usertype=1 limit $page->first_row ,$page->maxperpage";
        $pagevalue = $GLOBALS['db']->getAll($sql);
        return $pagevalue;
    }
    //获取课程老师
    public function getCourseTeacherOptions($maxperpage,$courseid){
		$maxperpage   = ChkClng($maxperpage);
		$teacherModel = new CourseModel('common_user_teacher');
		$teachercourseModel = new CourseModel('app_course_teacherrelate');
		$sql   = "select count(*) from $teachercourseModel->table as a left join $teacherModel->table as b on a.teacherid = b.userid
		        left join $this->table as c on  b.userid = c.userid  where a.courseid=$courseid ";
		$total = $GLOBALS['db']->getOne($sql);
		$options = array('totalput' => $total,    //总行数
		     'maxperpage'  => $maxperpage,        //每页显示量
        );
		return $options;
    }
    public function getCourseTeacherPage($page,$courseid){
		$teacherModel = new CourseModel('common_user_teacher');
		$teachercourseModel = new CourseModel('app_course_teacherrelate');
		$sql = "select * from $teachercourseModel->table as a left join $teacherModel->table as b on a.teacherid = b.userid
		        left join $this->table as c on  b.userid = c.userid  where a.courseid=$courseid";
        $pagevalue = $GLOBALS['db']->getAll($sql);
        return $pagevalue;
    }
    //获取视频播放地址、
    public function playVod($vodid){
		$vodModel=M('app_vod_list');
		$vod=$vodModel->getRow("where vdoId='$vodid' limit 1 ");
		if(!$vod){
			$result['result']='error';
			$result['msg']='系统出错';
			return $result;
		}
		if($vod['vdoService']==7){
		    //获取百度视频
	        $vod = new Core\Baiduyun();//百度视频
			try{
			 	  $vods = $vod->selectVod($vodid);
				  $status=$vods->status;
				  switch($status){
					  case 'PROCESSING' : $result['result']='error';$result['msg']='视频转码中，到其他课程看看';return $result;break;
					  case 'FAILED'     : $result['result']='error';$result['msg']='视频被禁用，到其他课程看看';return $result;break;
					  case 'DISABLED'   : $result['result']='error';$result['msg']='视频被禁用，到其他课程看看';return $result;break;
					  case 'BANNED'     : $result['result']='error';$result['msg']='视频被禁止，到其他课程看看';return $result;break;
				  }
				  $play = $vods->playableUrlList;
				  foreach($play as $k=>$v){
					  $playurl[$k]['url']        = $v->url;
					  $playurl[$k]['teblemname'] = $v->transcodingPresetName;
				  }
				  $uservod         = M('app_vod');
				  $vod             = $uservod->getRow('where wxid = '.$vod['wxid']);
				  $setting         = explode('※',$vod['setting']);
				  $player  = getplay($playurl,$setting,0,0,0,100);
			}catch(Exception $e){
				   $result['result']='error';
		    		$result['msg']='系统出错';
		    		return $result;
			}
			$result['player']=$player;
			$result['vdoService']=7;
			return $result;
	    }else{
			$vod = new Core\Playvdo();
	        $aa =$vod->getPlayAuth($vodid);
		    $result['player']=aliyunplay($aa->PlayAuth);
		    $result['vdoService']=7;
	    	return $result;
	    }
    }

	

}