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
use Core\Tencentvdo;
use Kesion\Model;
class ClassModel extends Model{
	public function classlist($Data){
		$wxid            = ChkClng(KS_S('wxid'));
		$GLOBALS['_DoM']['wxid'] = !empty($wxid)?$wxid:$GLOBALS['_DoM']['wxid'];
		if(!empty($Data['wxid'])){$GLOBALS['_DoM']['wxid']=$Data['wxid'];}
		$app_class      = M('app_class');
    	$this->AppModel = $app_class;
    	if(isset($Data['classlevel'])){
	    	if($Data['classlevel'] === 'max'){
	    		$where          = 'where a.wxid='.$GLOBALS['_DoM']['wxid'].' and a.status =2';
	    	}else{
	    		if(isset($Data['s'])){
	    			$where          = 'where a.wxid='.$GLOBALS['_DoM']['wxid'].' and a.classlevel='.$Data['classlevel'].' and a.status =2';
	    		}else{
	    			if($Data['classlevel']!=3){
	    				$where          = 'where a.wxid='.$GLOBALS['_DoM']['wxid'].' and a.classlevel='.$Data['classlevel'].' and a.status=2';
	    			}else{
	    				$where          = 'where a.wxid='.$GLOBALS['_DoM']['wxid'].' and a.status=2';
	    			}
	    		}
	    	}
    	}else{
    		$where          = 'where a.wxid='.$GLOBALS['_DoM']['wxid'].'  and a.status=2';
    	}
		$style          = null !==GF('style') ? GF('style'):1;
		$prise          = null !==GF('prise') ? GF('prise'):'0';
		if($prise!=='0'){//价格筛选
			$priseArr = explode('-',$prise.'--');
			if(ChkClng($priseArr[0])===0&&ChkClng($priseArr[1])===0){
				$where    .= ' and a.price=0';
			}elseif(ChkClng($priseArr[1])===0){
				$where    .= ' and a.price>='.ChkClng($priseArr[0]);
			}else{
				$where    .= ' and a.price>='.ChkClng($priseArr[0]).' and a.price<='.ChkClng($priseArr[1]);
			}
		}
		$studentcount       = null !==GF('studentcount') ? GF('studentcount'):'0';
		if($studentcount!=='0'){//价格筛选
			$studentcountArr = explode('-',$studentcount.'--');
			if(ChkClng($studentcountArr[0])===0&&ChkClng($studentcountArr[1])===0){
				$where    .= ' and a.studentcount=0';
			}elseif(ChkClng($studentcountArr[1])===0){
				$where    .= ' and a.studentcount>='.ChkClng($studentcountArr[0]);
			}else{
				$where    .= ' and a.studentcount>='.ChkClng($studentcountArr[0]).' and a.studentcount<='.ChkClng($studentcountArr[1]);
			}
		}
//		$pitchcourse     = null !==GF('pitchcourse') ? GF('pitchcourse'):'-1';
//		if($pitchcourse!=-1){
//			$pitchcourse = str_replace('@',',',$pitchcourse);
//			$where .= ' and a.clssid in ('.$pitchcourse.')';
//		}


		if(isset($Data['key'])){
			$key           = $Data['key'];
		}else{
			$key           = null !==GF('key') ? GF('key'):'0';
		}
		if(!empty($key)){$where.=" and a.title like '%$key%'";}
		$categoryid    = null !==GF('categoryid') ? GF('categoryid'):0;
		$GLOBALS['_DoM']['categoryid'] = $categoryid;
		if($categoryid!=0){$where .= " and (c.parentidpath like '%$categoryid,%' or c.categoryid=$categoryid)";}
		$appcategory = $this->cache->GetHCache('appcategory',$GLOBALS['_DoM']['wxid']);//取出缓存
		$sort = null !==GF('sort') ? GF('sort'):1;//升降序
	    switch($sort){
	    	case 1:$byname = 'a.adddate desc';break;
	    	case 2:$byname = 'a.adddate asc';break;
	    	case 3:$byname = 'a.adddate desc';break;
	    	case 4:$byname = 'a.adddate asc';break;
	    	case 5:$byname = 'a.adddate desc';break;
	    	case 6:$byname = 'a.adddate asc';break;
	    	case 7:$byname = 'a.adddate desc';break;
	    	case 8:$byname = 'a.adddate asc';break;
	    	default:$byname = 'a.adddate desc';break;
	    }
		$left_join     = M('app_category');//需要连表的在最后left join
		$user_teacher  = M('common_user_teacher');
		$where      = "as a left join `".$user_teacher->table."` as b on a.teacherid = b.userid left join `$left_join->table` as c on a.categoryid = c.categoryid $where";
		if(isset($Data['maxPerPage'])){
			$Data['maxPerPage'] = $Data['maxPerPage'];
		}else{
			$Data['maxPerPage'] = null !=ChkClng(KS_G('request.maxPerPage')) ? ChkClng(KS_G('request.maxPerPage')):'50';
		}
		if(isset($Data['picth'])){
			$where .=' and a.classid in('.$Data['picth'].')';
		}
		$options    = $this->AppModel->getOptions($Data['maxPerPage'],$where);//分页参数设置
//		var_dump($options);
		if(isset($Data['now_page'])){
			$options['now_page'] = $Data['now_page'];
		}else{
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		}
		$page = Page($options);
		if($options['now_page']<=$page->total_pages){
		$dt   = $this->AppModel->getPage($page,$byname,$where,'c.*,b.*,a.*');
		foreach($dt as $k=>$v){
			  if($v['price']==0){$dt[$k]['price'] = '免费';}else{$dt[$k]['price'] = '￥'.$v['price'];}
			  $dt[$k]['defaultpic'] = empty(Img($v['defaultpic']))? nopic(0): Img($v['defaultpic']);
			  $dt[$k]['head'] = $this->upload->getHead($v['teacherid']);
			  if(isMobile()){$dt[$k]['classurl'] = M_URL('class','view',$v['classid']);}
			  else{$dt[$k]['classurl'] = M_URL('class','view2',$v['classid']);}
			  if(empty($dt[$k]['name'])){
			  	$dt[$k]['name']='暂无';
			  }
		}
		}else{$dt   = array();}
//		$Linkage = Linkage(array());$Linkage->cachename  = 'appcategory';//读出缓存$Linkage->wxid       = $GLOBALS['_DoM']['wxid'];//读出缓存$Linkage->categoryid = $categoryid;$this->assign('Linkage',$Linkage->Linkage(5));
	    $result['page']      = $page;
		$result['style']     = $style;
		$result['dt']        = $dt;
		$result['loginflag'] = getsession('member')!=null?1:0;
		$drag   = null !==GF('drag') ? GF('drag'):'';
		if($drag=='on'){
			foreach($result['dt'] as $k =>$v){
		 		$result['dt'][$k]['portalurl']   = '/h5market/Miclassdetail?id='.$v['classid'];
		 	}
			header("Content-type: application/json");
	        echo json_encode($result);exit;
		}else{
		return $result;
		}
	}
	public function courselist($Data002){
		$wxid            = ChkClng(KS_S('wxid'));
		$GLOBALS['_DoM']['wxid'] = !empty($wxid)?$wxid:$GLOBALS['_DoM']['wxid'];
		if(!empty($Data002['wxid'])){$GLOBALS['_DoM']['wxid']=$Data002['wxid'];}
		$app_course      = M('app_course');
    	$this->AppModel  = $app_course;
		$where           = 'where a.wxid='.$GLOBALS['_DoM']['wxid'].' and a.status=2';
		$style           = null !==GF('style') ? GF('style'):1;
		$prise           = null !==GF('prise') ? GF('prise'):'0';
		$courseType      = ChkClng(KS_S('courseType',0));
		if(!empty($courseType)){$where.=' and a.courseType='.$courseType;}
		$pitch     = null !==GF('pitch') ? GF('pitch'):'-1';
		if($pitch!=-1){
			$pitch = str_replace('@',',',$pitch);
			$where .= ' and a.courseid in ('.$pitch.')';
		}
		$chargetype=null !== GF('chargetype') ? GF('chargetype') : 3 ;
		if($chargetype!=3){
			$where .=" and a.chargetype=".$chargetype;
		}
		if($prise!=='0'){//价格筛选
			$priseArr = explode('-',$prise.'--');
			if(ChkClng($priseArr[0])===0&&ChkClng($priseArr[1])===0){
				$where    .= ' and a.price=0';
			}elseif(ChkClng($priseArr[1])===0){
				$where    .= ' and a.price>='.ChkClng($priseArr[0]);
			}else{
				$where    .= ' and a.price>='.ChkClng($priseArr[0]).' and a.price<='.ChkClng($priseArr[1]);
			}
		}
		$studentcount       = null !==GF('studentcount') ? GF('studentcount'):'0';
		if($studentcount!=='0'){//学生人数筛选
			$studentcountArr = explode('-',$studentcount.'--');
			if(ChkClng($studentcountArr[0])===0&&ChkClng($studentcountArr[1])===0){
				$where    .= ' and a.studentcount=0';
			}elseif(ChkClng($studentcountArr[1])===0){
				$where    .= ' and a.studentcount>='.ChkClng($studentcountArr[0]);
			}else{
				$where    .= ' and a.studentcount>='.ChkClng($studentcountArr[0]).' and studentcount<='.ChkClng($studentcountArr[1]);
			}
		}
		$key           =null !==GF('key') ? GF('key'):'0';
		if(!empty($Data002['key'])){ $key = $Data002['key'];}
		if(!empty($key)){$where.=" and title like '%$key%'";}
		$categoryid  = null !==GF('categoryid') ? GF('categoryid'):0;
		$GLOBALS['_DoM']['categoryid'] = $categoryid;
		if($categoryid!=0){$where .= " and (c.parentidpath like '%$categoryid,%' or c.categoryid=$categoryid)";}
		$appcategory = $this->cache->GetHCache('appcategory',$GLOBALS['_DoM']['wxid']);//取出缓存
		$sort = null !==GF('sort') ? GF('sort'):1;//升降序
	    switch($sort){
	    	case 1:$byname = 'a.adddate desc';break;
	    	case 2:$byname = 'a.adddate asc';break;
	    	case 3:$byname = 'a.adddate desc';break;
	    	case 4:$byname = 'a.adddate asc';break;
	    	case 5:$byname = 'a.adddate desc';break;
	    	case 6:$byname = 'a.adddate asc';break;
	    	case 7:$byname = 'a.adddate desc';break;
	    	case 8:$byname = 'a.adddate asc';break;
	    	default:$byname = 'a.adddate desc';break;
	    }
		$left_join     = M('app_category');//需要连表的在最后left join
		$user_teacher  = M('common_user_teacher');
		$where      = "as a left join `".$user_teacher->table."` as b on a.teacherid = b.userid left join `$left_join->table` as c on a.categoryid = c.categoryid $where";
	 	$maxPerPage      = null !==GF('maxPerPage') ? GF('maxPerPage'):$Data002['maxPerPage'];
		$options    = $this->AppModel->getOptions($maxPerPage,$where);//分页参数设置
		if(isset($Data002['now_page'])){
			$options['now_page'] = $Data002['now_page'];
		}else{
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		}
		$page = Page($options);
		if($options['now_page']<=$page->total_pages){
			$dt   = $this->AppModel->getPage($page,$byname,$where,'c.*,b.*,a.*');
			foreach($dt as $k=>$v){
				  if($v['price']==0){$dt[$k]['price'] = '免费';}else{$dt[$k]['price'] = '￥'.$v['price'];}
				  $dt[$k]['defaultpic'] = empty(Img($v['defaultpic']))? nopic(0): Img($v['defaultpic']);
				  $dt[$k]['head'] = $this->upload->getHead($v['teacherid']);
				  if(isMobile()){$dt[$k]['classurl'] = M_URL('course','view',$v['courseid']);}
				  else{$dt[$k]['classurl'] = M_URL('course','view2',$v['courseid']);}
				  if(empty($dt[$k]['name'])){$dt[$k]['name']='暂无';}
				 if($dt[$k]['score'] == null){ $dt[$k]['score'] = 0;}
			}
		}else{$dt   = array();}
		$result['page']      = $page;
		$result['style']     = $style;
		$result['dt']        = $dt;
		$result['loginflag'] = getsession('member')!=null?1:0;

		$drag   = null !==GF('drag') ? GF('drag'):'';
		if($drag=='on'){
		    foreach($result['dt'] as $k =>$v){
			    if($v['courseType']==1){
				    $result['dt'][$k]['portalurl']   = '/h5market/Micoursedetail?id='.$v['courseid'];
				}elseif($v['courseType']==2){
				    $result['dt'][$k]['portalurl']   = '/h5market/Micoursedetail?id='.$v['courseid'];
				}elseif($v['courseType']==3){
				    $result['dt'][$k]['portalurl']   = '/h5market/musicinfo?id='.$v['courseid'];
				}elseif($v['courseType']==4){
				    $result['dt'][$k]['portalurl']   = '/h5market/imgInfo?id='.$v['courseid'];
				}
		 	}
			header("Content-type: application/json");
	        echo json_encode($result);exit;
		}else{
		return $result;
		}
	}
	public function studentcourse($wxid,$userid,$now_page,$maxperpage){
		$courseModel   = M('app_course');
        $studentCourse = M('app_order_info');
		$tercherModel  = M('common_user_teacher');
        $course = $studentCourse->getAll(" as a left join $courseModel->table as b on a.courseid = b.courseid where b.wxid= $wxid and a.memberid=$userid and a.paystatus=1 and b.status!=-1");
        $options['now_page']   = $now_page;
		$options['maxperpage'] = $maxperpage;
	    $options['totalput']   = count($course);
		$page = Page($options);
		$dt   = $page->arrayPage($course);
	    if(empty($dt)){
		 	$dt =$courseModel->getAll('where wxid='.$wxid.' and status != -1 order by recommend desc limit 4');
		 	foreach($dt as $k=>$v){
		 		    $values[$k]['isbuy']=0;
		 		    $values[$k]['progress']=0;
				 	$values[$k]['teacher']    = $courseModel->getOne('b.name','as a left join '.$tercherModel->table.' as b on a.teacherid = b.userid where a.courseid='.$v['courseid'].' limit 1');
				    $values[$k]['courseid']   = $v['courseid'];
				    $values[$k]['coursename'] = $v['title'];
				    $values[$k]['courseType'] = $v['courseType'];
				    $values[$k]['cousreKind'] = $v['chapterTemplate'];
			        $values[$k]['playurl'] =M_URL('course','view2',$v['courseid']) ;
				    $a=Img($v['defaultpic']);
				    if($a==''){
				    	  $values[$k]['pic']  ='/Public/common/drag/images/nopic.png';
				    }else{
				    	 $values[$k]['pic']   = $a;
				    }
		 	}
		 	$result['type']            = 0;
		 }else{
		     foreach($dt as $k=>$v){
		     	$values[$k]['isbuy']=1;
		        $values[$k]['teacher']    = $courseModel->getOne('b.name','as a left join '.$tercherModel->table.' as b on a.teacherid = b.userid where a.courseid='.$v['courseid'].' limit 1');
			    $values[$k]['courseid']   = $v['courseid'];
			    $values[$k]['coursename'] = $v['title'];
			    $values[$k]['courseType'] = $v['courseType'];
			    $a=Img($v['defaultpic']);
			    if($a==''){
			    	 $values[$k]['pic']='/Public/common/drag/images/nopic.png';
			    }else{
			    	 $values[$k]['pic']        = $a;
			    }
			    $values[$k]['progress']   = $v['progress'];
			    $values[$k]['cousreKind'] = $v['chapterTemplate'];
			    $values[$k]['playurl'] =M_URL('course','ClassPlay',$v['courseid']) ;
			 }
			 $result['type']            = 1;
		 }
		 $result['page']              = $page;
		 $result['values']            = $values;
	     return $result;
	}
	public function teacherClass($wxid,$teacherid,$classid,$teacherstatus){
		 $courseModel            = M('app_class_teacherrelate');
	     $options['wxid']        = $wxid;
		 $options['teacherid']   = $teacherid;
	     $options['classid']     = $classid;
	     $options['isspeaker']   = $teacherstatus;
	     if($teacherstatus==1){
	     	$data['isspeaker'] = 0;
	        $courseModel->update($data,' wxid='.$wxid.' and classid='.$classid);
	     }
         $res=$courseModel->doadd($options,'id');
         if($res){$result['msg']              = '10000';
         }else{$result['msg']              = '10001';
         }
	}
	//获取班级课程
	public function getcourseclass(){

	}
	//获取班级学生   hcl
	public function getmember($Data005,$type=0){
		$classstudent = M('app_class_studentrelate');
		$memberModel  = M('common_user_member');
		$userModel    = M('common_user');
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype=null !==GF('keytype') ? GF('keytype'):'';
		$status=null !==GF('status') ? GF('status'):1;
		$where='as a  inner join '.$memberModel->table.' as b on a.memberid=b.userid inner join '.$userModel->table.' as c  on a.memberid=c.userid where  a.wxid='.$Data005['wxid'].' and a.classid='.$Data005['classid'];
		if($status==1){$where.= ' and a.status =1';
	    }elseif($status==2){$where.= ' and a.status !=1';
		}
		if(!empty($keyword)){if($keytype==1){$where.=" and b.name like '%$keyword%'";}}
		$member       = array();
		if($type==1){
		    $options = $classstudent->getOptions('9',$where);
		    $result['page']      = Page($options);
		    $member = $classstudent->getPage($result['page'],'a.memberid desc',$where,'c.username,c.email,c.mobile,b.emergencyContact,b.emergencyContactTel,b.name,b.userid,a.comments,a.status');
		}else{
		    $member = $classstudent->getAll($where,'c.username,c.email,c.mobile,b.emergencyContact,b.emergencyContactTel,b.name,b.userid,a.comments,a.status');
		}
		foreach($member as $k=>$v){
			$member[$k]['name']=!empty($v['name']) ? $v['name'] : $v['username'];
			$member[$k]['userid']=$v['userid'];
		}
		$result['values']=$member;
		return $result;
	}
	//获取班级老师  0代表整个学校老师  hcl
	public function getClassTeachers($Data004){
		$userModel    = M('common_user');
		$teacherModel = M('common_user_teacher');
		if(isset($Data004['classid']) && $Data004['classid']!=0){
			$teacherrelateModel=M('app_class_teacherrelate');
			$teacher=$teacherrelateModel->getAll('where wxid='.$Data004['wxid'].'  and  classid='.$Data004['classid'],'teacherid');
			$teachers=array();
			foreach($teacher as $k=>$v){
				$teachers[$k]=$userModel->getRow(' as a inner join '.$teacherModel->table.' as b on a.userid =b.userid  where  a.wxid='.$Data004['wxid'].' and a.status=1 and a.userid='.$v['teacherid'],'b.name,a.userid,a.username');
			}
		}else{
			$teachers=$userModel->getAll(' as a inner join '.$teacherModel->table.' as b on a.userid =b.userid  where  a.wxid='.$Data004['wxid'].' and a.status=1 ','b.name,a.userid,a.username');
		}
		return $teachers;
	}
	//获取单个老师   hcl
	public function getOneTeacher($Data001){
		$userModel    = M('common_user');
		$teacherModel = M('common_user_teacher');
	    $teacher      = $userModel->getRow(' as a inner join '.$teacherModel->table.' as b on a.userid=b.userid where a.userid='.$Data001['teacherid'].' limit 1','a.username,b.name');
		return $teacher;
	}
	//获取老师下的班级  hcl
	public function getTeacherClass($Data002){
		$teacherModel = M('app_class_teacherrelate');
	    $classModel   = M('app_class');
	    $where ='as a inner join '.$teacherModel->table.' as b on a.classid=b.classid where a.wxid='.$Data002['wxid'].' and a.status != -1';
	    if(isset($Data002['teacherid']) && $Data002['teacherid']!=0){
	    	$where.=' and b.teacherid='.$Data002['teacherid'];
	    }
		$class = $classModel->getAll($where,'a.classid,a.classlevel,a.title');
		return $class;
	}
	//查询课表  hcl
	public function getSchedule($Data006,$type=0){
	    $teacherModel = M('common_user_teacher');
	    $roomModel=M('app_classroom');
		$model = M('app_class_schedule');
        $classModel=M('app_class');
        $where =' as a inner join '.$classModel->table.' as b on a.classid=b.classid where a.wxid='.$Data006['wxid'];
        if(isset($Data006['teacherid']) && $Data006['teacherid']!=0){
        	$where.=' and a.teacherid='.$Data006['teacherid'];
        }
        if(isset($Data006['classid']) && $Data006['classid']!=0){
        	$where.=' and a.classid='.$Data006['classid'];
        }
        if(isset($Data006['type']) && $Data006['type']!=0){
        	$where.=' and a.type='.$Data006['type'];
        }
        if(isset($Data006['classlevel']) && $Data006['classlevel']!=3){
        	$where.=' and b.classlevel='.$Data006['classlevel'];
        }
        if(isset($Data006['year']) && $Data006['year']!=0){
        	$where.=' and a.year='.$Data006['year'];
        }
        if(isset($Data006['week']) && $Data006['week']!=0){
        	$where.=' and a.week='.$Data006['week'];
        }
        if(isset($Data006['day']) && $Data006['day']!=0){
        	$where.=' and a.day='.$Data006['day'];
        }
        if($type==1){
        	$values     = $model->getAll($where.' order by timeSlotStart desc','b.title as classname,b.classlevel,a.id,a.day,a.dayPm,a.timeSlotStart,a.timeSlotEnd,a.teacherid,a.assisantid,a.type,a.title,a.classroomid,a.classid,a.id');
        }else{
        	$options          = $model->getOptions('10',$where);//分页参数设置
        	if(isset($Data006['now_page'])){
				$options['now_page'] = $Data006['now_page'];
			}else{
				$options['now_page'] = null !==GF('p') ? GF('p'):'1';
			}
			$page = Page($options);
			$result['page']   = $page;
			if($options['now_page']<=$page->total_pages){
				$values  = $model->getPage($result['page'],'',$where,'b.title as classname,b.classlevel,a.id,a.day,a.dayPm,a.timeSlotStart,a.timeSlotEnd,a.teacherid,a.assisantid,a.type,a.title,a.classroomid,a.classid');
			}else{
			 	$values = array();
			}
        }
		foreach($values as $k=>$v){
			if($v['dayPm']==1){$values[$k]['element']='a'.$v['day'];
		    }elseif($v['dayPm']==2){$values[$k]['element']='b'.$v['day'];
			}elseif($v['dayPm']==3){$values[$k]['element']='c'.$v['day'];}
			$values[$k]['time'] =timeformat($v['timeSlotStart']).'~'.timeformat($v['timeSlotEnd']);
			$values[$k]['name'] =$teacherModel->getOne('name','where userid ='.$v['teacherid']);
			$values[$k]['assisant'] =$teacherModel->getOne('name','where userid ='.$v['assisantid']);
			$classroom=$roomModel->getOne('classroomname','where id='.$v['classroomid']);
			$values[$k]['title']=$v['title'];
			if(!isset($Data006['xstatus'])){
				if($v['type']==2){$values[$k]['type']='线上  '.$classroom;
			   }else{$values[$k]['type']='线下  '.$classroom;}
			}else{
				$values[$k]['classroom'] = $classroom;
			}
	    }
	    $result['values'] = $values;
	    return $result;
	}
	//获取记上课
	public function remember($Data006,$status=0){
	    $teacherModel = M('common_user_teacher');
	    $roomModel    = M('app_classroom');
		$model        = M('app_class_schedule');
        $classModel   = M('app_class');
        $signModel    = M('app_class_sign');
        $where        = ' as a inner join '.$classModel->table.' as b on a.classid=b.classid   where a.wxid='.$Data006['wxid'];
        if($status==1){$where.=' and (a.status=0  or  a.status=1)';
        }elseif($status==2){$where.=' and (a.status=2  or  a.status=3)';}
        if(isset($Data006['starttime'])){
        	//var_dump($Data006['starttime']);var_dump($Data006['endtime']);
        	$where.=' and (a.timeSlotStart>'.$Data006['starttime'].' && a.timeSlotStart<'.$Data006['endtime'].')';
        }
        if(isset($Data006['teacherid']) && $Data006['teacherid']!=0){
        	$where.=' and a.teacherid='.$Data006['teacherid'];
        }
        if(isset($Data006['classid']) && $Data006['classid']!=0){
        	$where.=' and a.classid='.$Data006['classid'];
        }
        if(isset($Data006['type']) && $Data006['type']!=0){
        	$where.=' and a.type='.$Data006['type'];
        }
        if(isset($Data006['classlevel']) && $Data006['classlevel']!=3){
        	$where.=' and b.classlevel='.$Data006['classlevel'];
        }
        if(isset($Data006['year']) && $Data006['year']!=0){
        	$where.=' and a.year='.$Data006['year'];
        }
        if(isset($Data006['week']) && $Data006['week']!=0){
        	$where.=' and a.week='.$Data006['week'];
        }
        if(isset($Data006['day']) && $Data006['day']!=0){
        	$where.=' and a.day='.$Data006['day'];
        }
    	$options          = $model->getOptions('10',$where);//分页参数设置
    	if(isset($Data006['now_page'])){$options['now_page'] = $Data006['now_page'];
		}else{$options['now_page'] = null !==GF('p') ? GF('p'):'1';}

		$page = Page($options);
		$result['page']   = $page;
		if($options['now_page']<=$page->total_pages){
			$values  = $model->getPage($result['page'],'a.timeSlotStart asc',$where,'b.title as classname,b.classlevel,a.id,a.day,a.dayPm,a.timeSlotStart,a.timeSlotEnd,a.status,a.teacherid,a.assisantid,a.type,a.title,a.classroomid,a.classid,a.id as scheduleid');
		}else{
		 	$values = array();
		}
        $userModel=M('common_user');
		foreach($values as $k=>$v){
			$sign = $signModel->getRow('where scheduleid='.$v['id'].' limit 1');
			$values[$k]['adddate']=$sign['adddate'];
			if($v['dayPm']==1){$values[$k]['element']='a'.$v['day'];
		    }elseif($v['dayPm']==2){$values[$k]['element']='b'.$v['day'];
			}elseif($v['dayPm']==3){$values[$k]['element']='c'.$v['day'];}
			$values[$k]['time'] =timeformat($v['timeSlotStart']).'~'.timeformat($v['timeSlotEnd']);
			$values[$k]['name'] =$teacherModel->getOne('name','where userid ='.$v['teacherid']);
			if(empty($values[$k]['name'])){
				$values[$k]['name']=$userModel->getOne('username' ,' where userid='.$v['teacherid'].' limit 1');
			}
			$values[$k]['assisant'] =$teacherModel->getOne('name','where userid ='.$v['assisantid']);
			$classroom=$roomModel->getOne('classroomname','where id='.$v['classroomid']);
			$values[$k]['title']=$v['title'];
			if(!isset($Data006['xstatus'])){
				if($v['type']==2){$values[$k]['type']='线上  '.$classroom;
			   }else{$values[$k]['type']='线下  '.$classroom;}
			}else{
				$values[$k]['classroom'] = $classroom;
			}
	    }
	    $result['values'] = $values;
	    $result['page']   = $page;
	    return $result;
	}
	//进入创建签到
	public function addSign($Data003){
		$class         = $Data003['class'];
		$studentModel  = M('app_class_studentrelate');
		$where         = ' where wxid='.$Data003['wxid'].' and classid='.$Data003['classid'].' order by adddate desc';
		$student       = $studentModel->getAll($where);
		if(!$student&&isset($Data003['appname'])){
		 	$url = M_URL($Data003['appname'].'/Index','student',$Data003['classid'],GP(''));
	        KS_INFO('该班级尚未有学员，请添加',3,$url);
		}
		if(!$student&&!isset($Data003['appname'])){
			return 'error';exit;
		}
		$userModel     = M('common_user');
		$memberModel   = M('common_user_member');
		$value = array();
		foreach($student as $k=>$v){
			$userinfo  = $userModel->getRow(' as a left join '.$memberModel->table.' as b on a.userid = b.userid where a.userid='.$v['memberid'],'b.emergencyContact,b.emergencyContactTel,a.email,b.name,a.username,a.userid,a.mobile');
			if($userinfo){
				$value[$k]           = $userinfo;
				$value[$k]['avatar'] = $this->upload->getHead($v['memberid']);
			}
			$cook[$k]['id']      = $v['memberid'];
		    $cook[$k]['v']       = 1;
	    }
	    if(empty($_COOKIE['student'])){
		    $json = json_encode($cook);
		    setcookie('studentsign', $json, time()+3600,'/');
	    }
	    if(isset($Data003['now_page'])){$options['now_page'] = $Data003['now_page'];
		}else{$options['now_page'] = null !==GF('p') ? GF('p'):1;}

	    if(isset($Data003['maxperpage'])){$options['maxperpage'] = $Data003['maxperpage'];
		}else{$options['maxperpage'] = null !==GF('maxperpage') ? GF('maxperpage'):10;}
	    $options['totalput']    = count($value);
		$result['page']         = Page($options);
	    $result['students']     = $result['page']->arrayPage($value);
	    if(!$value&&isset($Data003['appname'])){
		 	$url = M_URL($Data003['appname'].'/Index','student',$Data003['classid'],GP(''));
	        KS_INFO('该班级尚未有学员，请添加',3,$url);
		}
		if(!$value&&!isset($Data003['appname'])){
			return 'error';exit;
		}
		return $result;
	}
	//进行创建签到
	public function doAddSign($Data007){
		$class              = $Data007['class'];
		$signModel          = M('app_class_sign');
		$Data['wxid']       = $Data007['wxid'];
		$Data['classid']    = $Data007['classid'];
		$Data['teacherid']  = $Data007['userid'];
		$Data['scheduleid']  = $Data007['scheduleid'];
		$Data['title']      = ChkSQL(KS_G("post.title"));
		$Data['adddate']    = time();
		$student            = json_decode(KS_G('post.student'));
		if(isset($Data007['wx'])){
			$i =$signModel ->getRow('where wxid='.$Data['wxid'].' and classid='.$Data['classid'].' and scheduleid='.$Data['scheduleid']);
			if(!empty($i)){
				echo "<script>alert('该课时已经添加过');history.go(-1)</script>";exit;
			}
		}else{
			$Rule['scheduleid'] = '该课时已经添加过|isDbexis';
			Chkpost($Data,$Rule,$signModel,'wxid='.$Data['wxid'].' and classid='.$Data['classid'] );
	   }
	    $signid = $signModel->doAdd($Data,'id');
	    $Data01['status']=1;
	    $scheduleModel=M('app_class_schedule');
	    $scheduleModel->update($Data01,'id='.$Data007['scheduleid']);
		$signRecondModel    = M('app_class_sign_record');
		$Datas['signid']    = $signid;
		$IndexModel         = M('Application/IndexModel');
		if(isset($Data007['wx'])){
			$userid = $_POST['userid'];
			$staus =  $_POST['staus'];
			$remake = $_POST['remake'];
			if(empty($userid)){
				echo "<script>alert('非法数据包');history.go(-1)</script>";exit;
			}
			foreach($userid as $k=>$v){
				$Datas['memberid'] = $v;
				$Datas['classid']  = $Data007['classid'];
				$Datas['status']   = $staus[$k];
				$Datas['adddate']  = time();
				$Datas['checkin']  = $Data007['name'];
				$Datas['remake']   =$remake[$k];
				$signRecondModel->doAdd($Datas,'id');
				//发送签到----只发送微信和站内信
				$Data2['type']       = 4;
				$Data2['modelname']  = 'Signclass';
				$Data2['date']       =$Data['title'];
				$Data2['memberid']   = $Datas['memberid'];
				if($Datas['status']==1){$Data2['content'] ='签到';
			    }elseif($Datas['status']==2){$Data2['content'] ='请假';
			    }elseif($Datas['status']==3){$Data2['content'] ='旷课';
				}elseif($Datas['status']==4){$Data2['content'] ='补课';}
				$messagetype        = array('0'=>'3','1'=>'4');
				$IndexModel    ->SendEx($messagetype,$Data2,$userid);
			}
		}else{
			foreach($student as $k=>$v){$userids[] = $v->id;}
			foreach($student as $k=>$v){
				$Datas['memberid'] = $v->id;
				$Datas['classid']  = $Data007['classid'];
				$Datas['status']   = $v->v;
				$Datas['adddate']  = time();
				$Datas['checkin']  = $Data007['name'];
				$signRecondModel->doAdd($Datas,'id');
				//发送签到
				$Data2['type']       = 4;
				$Data2['modelname']  = 'Signclass';
				$Data2['date']       =$Data['title'];
				$Data2['memberid']   = $Datas['memberid'];
				if($Datas['status']==1){$Data2['content'] ='签到';
			    }elseif($Datas['status']==2){$Data2['content'] ='请假';
			    }elseif($Datas['status']==3){$Data2['content'] ='旷课';
				}elseif($Datas['status']==4){$Data2['content'] ='补课';}
				$messagetype        = ChkSQL(KS_G('post.messagetype'));
				$IndexModel    ->SendEx($messagetype,$Data2,$userids);
			}
		}
	}
	//签到列表
	public function classSign($Data008){
		$signModel = M('app_class_sign');
		$where     = ' where wxid='.$Data008['wxid'].' and classid='.$Data008['classid'];
		$keyword   = KS_S('keyword');
		$type      = null !==GF('type') ? GF('type'):3;
	    if(!empty($keyword)){$where.=" and title like '%$keyword%'";}
	    if($type !=3){$where.= ' and type ='.$type;}
		$options = $signModel->getOptions($Data008['maxPerPage'],$where);//分页参数设置
		if(isset($Data008['now_page'])){
			$options['now_page'] = $Data008['now_page'];
		}else{
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		}
		$page    = Page($options);
		$sign    = $signModel->getPage($page,'adddate desc',$where);
		$signRecondModel = M('app_class_sign_record');
		$studenModelt    = M('app_class_studentrelate');
		$Attendance      = 0;
		$userModel       = M('common_user');
		foreach($sign as $k=>$v){
			$sign[$k]['Tobe']        = $v['studentNum'];//应到人数
			$sign[$k]['GoToClass']   = $signRecondModel->getOne('count(*)','where signid='.$v['id'].' and classid='.$v['classid'].' and status=1');//有来上课
			$sign[$k]['leave']       = $signRecondModel->getOne('count(*)','where signid='.$v['id'].' and classid='.$v['classid'].' and status=2');//请假
			$sign[$k]['absenteeism'] = $signRecondModel->getOne('count(*)','where signid='.$v['id'].' and classid='.$v['classid'].' and status=3');//旷课
			$sign[$k]['makeup']      = $signRecondModel->getOne('count(*)','where signid='.$v['id'].' and classid='.$v['classid'].' and status=4');//补课
			$sign[$k]['adddate']     = date('Y-m-d H:i',$v['adddate']);//应到人数
			$usertype                = $userModel->getOne('usertype','where userid='.$v['teacherid']);
			if($usertype ==1){$teacherModel=M('common_user_teacher');}else{$teacherModel=M('common_user_school');}
			$sign[$k]['teachername'] = $teacherModel->getOne('name','where  userid ='.$v['teacherid']);//补课
			if($sign[$k]['Tobe']==0){$sign[$k]['Tobe']=1;}
			$Attendance=round($sign[$k]['GoToClass']/$sign[$k]['Tobe'],4)+$Attendance;
		}
		$class = $Data008['class'];
		if($Attendance != 0){
		    $result['Attendance']=round($Attendance/count($sign),4)*100;
		}else{
			$result['Attendance']=0;
		}
		$result['sign'] = $sign;
		$result['page'] = $page;
		return $result;
	}
	//班级详情
	public function classinfo($Data009){
		if(!empty($Data009['wxid'])){$GLOBALS['_DoM']['wxid']=$Data009['wxid'];}
		$app_class      = M('app_class');
    	$this->AppModel = $app_class;
		$where          = 'where a.wxid='.$GLOBALS['_DoM']['wxid'].' and a.classid='.$Data009['classid'].' and a.status=1';
		$categoryid    = null !==GF('categoryid') ? GF('categoryid'):0;
		$GLOBALS['_DoM']['categoryid'] = $categoryid;
		if($categoryid!=0){$where .= " and (c.parentidpath like '%$categoryid,%' or c.categoryid=$categoryid)";}
		$appcategory = $this->cache->GetHCache('appcategory',$GLOBALS['_DoM']['wxid']);//取出缓存
		$left_join     = M('app_category');//需要连表的在最后left join
		$user_teacher  = M('common_user_teacher');
		$where      = "as a left join `".$user_teacher->table."` as b on a.teacherid = b.userid left join `$left_join->table` as c on a.categoryid = c.categoryid $where";
		$dt   = $this->AppModel->getRow($where,'c.*,b.*,a.*');
		if(!empty($dt)){
		  	if($dt['price']==0){$dt['price'] = '免费';}else{$dt['price'] = '￥'.$dt['price'];}
		  	$dt['defaultpic'] = empty(Img($dt['defaultpic']))? nopic(0): Img($dt['defaultpic']);
		  	$dt['head'] = $this->upload->getHead($dt['teacherid']);
		  	if(isMobile()){$dt['classurl'] = M_URL('class','view',$dt['classid']);}
		  	else{$dt['classurl'] = M_URL('class','view2',$dt['classid']);}
		  	if(empty($dt['name'])){
		  		$dt['name']='暂无';
			}
			$dt['surplus'] = $dt['studentcount']-$dt['studentnum'];
		}else{$dt   = array();}
//		$Linkage = Linkage(array());$Linkage->cachename  = 'appcategory';//读出缓存$Linkage->wxid       = $GLOBALS['_DoM']['wxid'];//读出缓存$Linkage->categoryid = $categoryid;$this->assign('Linkage',$Linkage->Linkage(5));
		$result['dt']        = $dt;
		$result['loginflag'] = getsession('member')!=null?1:0;
		return $result;
	}
	//班级教师详情
	public function classteacher($Data009){
		if(!empty($Data009['wxid'])){$GLOBALS['_DoM']['wxid']=$Data009['wxid'];}
		$app_class      = M('app_class');
    	$this->AppModel = $app_class;
    	$where          = 'where a.wxid='.$GLOBALS['_DoM']['wxid'].' and a.classid='.$Data009['classid'];
    	$user_teacher  = M('common_user_teacher');
    	$where      = "as a left join `".$user_teacher->table."` as b on a.teacherid = b.userid $where";
		$dt   = $this->AppModel->getAll($where,'b.*,a.*');
		if(!empty($dt)){
			foreach($dt as $k=>$v){
			  	$dt[$k]['head'] = $this->upload->getHead($v['teacherid']);
			  	if(empty($dt[$k]['name'])){
			  		$dt[$k]['name']='暂无';
		  		}
			}
		}else{$dt   = array();}
//		$Linkage = Linkage(array());$Linkage->cachename  = 'appcategory';//读出缓存$Linkage->wxid       = $GLOBALS['_DoM']['wxid'];//读出缓存$Linkage->categoryid = $categoryid;$this->assign('Linkage',$Linkage->Linkage(5));
		$result['dt']        = $dt;
		$result['loginflag'] = getsession('member')!=null?1:0;
		return $result;
	}
	//学生连麦
	public function studentlianmai($channelName,$memberid,$Data001=array()){
        $liveModel          = M('app_live_list');
   	    $channl             = $liveModel->getRow(" where channlName='$channelName' limit 1");
   	    if(!empty($channl)){
		    $studenModel        = M($channl['studentTable']);
   			$Data['memberid']   = $memberid;
   			$Data['type']       = 1;
   			$Data['starttime']  = time();
   			$Data['endtime']    = time();
   			if($channl['type']==2){$Data['infoid']=$channl['classid'];
   			}else{$Data['infoid']=$channl['courseid'];}
   			$Data['scheduleid'] = $channl['chapterid'];
   			$Data['status']     = 1;
   			$Data['wxid']       = $channl['wxid'];
   			$Data['channlid']   = $channl['id'];
   			$Data['logid']      = $channl['logid'];//加了一个网校id的判断
   			$student=$studenModel->getRow(' where channlid='.$channl['id'].' and wxid='.$channl['wxid'].' and logid='.$channl['logid'].' and memberid='.$memberid.'  and  status = 1 ');
   			if($student){
   	   		   $times=time()-$student['endtime'];
   	   		   if($times>60){//与上一次间隔少于60秒
   	   	   		  $Data1['status']  = 2;
   	   	   		  $Data1['endtime'] = time();
   	   	   		  $studenModel->update($Data1,'id='.$student['id'].' limit 1');
   	   	   		  $id = $studenModel->doAdd($Data,'id');
   	   		   }else{
   	   	   		  $Data1['endtime']=time();
   	   	   		  $studenModel->update($Data1,'id='.$student['id'].' limit 1');
   	   	   		  $id = $student['id'];
   	   		   }
   			}else{$id = $studenModel->doAdd($Data,'id');}
   			if($id){
   	   	   		   $result['result']='success';
   	   			   $result['id']=$id;
   	   			   $restlt['teacherid']=$channl['teacherid'];
   			}else{
   	    		   $result['result']='error';
   	   			   $result['msg']='出错';
   			}
			return $result;
   	    }else{
			$studenModel        = M('app_live_student1');
   			$Data['memberid']   = $memberid;
   			$Data['type']       = 1;
   			$Data['starttime']  = time();
   			$Data['endtime']    = time();
   			$Data['infoid']     = $Data001['classid'];
   			$Data['scheduleid'] = $Data001['classid'];
   			$Data['status']     = 1;
   			$Data['wxid']       = $Data001['wxid'];
   			$Data['channlid']   = '999999999'.$Data001['classid'];
   			$Data['logid']      = $Data001['logid'];//加了一个网校id的判断
   			$student=$studenModel->getRow('where channlid=999999999'.$Data001['classid'].' and wxid='.$Data001['wxid'].' and logid='.$Data001['logid'].' and memberid='.$memberid.'  and  status = 1 ');
   			if($student){
   	   		   $times = time()-$student['endtime'];
   	   		   if($times>60){//与上一次间隔少于60秒
   	   	   		  $Data1['status']  = 2;
   	   	   		  $Data1['endtime'] = time();
   	   	   		  $studenModel->update($Data1,'id='.$student['id'].' limit 1');
   	   	   		  $id = $studenModel->doAdd($Data,'id');
   	   		   }else{
   	   	   		  $Data1['endtime']=time();
   	   	   		  $studenModel->update($Data1,'id='.$student['id'].' limit 1');
   	   	   		  $id = $student['id'];
   	   		   }
   			}else{$id = $studenModel->doAdd($Data,'id');}
   			if($id){
   	   	   		   $result['result']='success';
   	   			   $result['id']        = $id;
   	   			   $restlt['teacherid'] = $Data001['teacherid'];
   			}else{
   	    		   $result['result']='error';
   	   			   $result['msg']   ='出错';
   			}
			return $result;
		}
	}
	public  function getTeacherSchedule($Data001){
		$classModel    = M('app_class');
		$scheduleModel = M('app_class_schedule');
		$roomModel     = M('app_classroom');
		$where =' as a inner join '.$classModel->table.' as b on a.classid=b.classid  where a.wxid ='.$Data001['wxid'].' and b.status!=-1 and (a.status =2 or a.status=3) ';
		if($Data001['type']==1){
			$where.=' and a.teacherid='.$Data001['teacherid'];
		}else{
			$where.=' and a.assisantid='.$Data001['teacherid'];
		}
        $options          = $scheduleModel->getOptions('10',$where);//分页参数设置
    	if(isset($Data006['now_page'])){$options['now_page'] = $Data006['now_page'];
		}else{$options['now_page'] = null !==GF('p') ? GF('p'):'1';}
		$page             = Page($options);
		$result['page']   = $page;
		$values  = $scheduleModel->getPage($result['page'],'',$where,'b.title as classname,b.classlevel,a.timeSlotStart,a.timeSlotEnd,a.status,a.teacherid,a.assisantid,a.isSettlement,a.isSettlement1,a.type,a.title,a.classroomid,a.classid,a.id as scheduleid');
		$teacherrelate=M('app_class_teacherrelate');
		foreach($values as $k=>$v){
			if($Data001['type']==1){
   	            $values[$k]['Money']=$teacherrelate->getOne('speakercost','where classid='.$v['classid'].' and teacherid='.$v['teacherid'].' limit 1');
       	    }else{
       	    	$values[$k]['Money']=$teacherrelate->getOne('assistantcost','where classid='.$v['classid'].' and teacherid='.$v['teacherid'].' limit 1');
       	    	$values[$k]['isSettlement']=$v['isSettlement1'];
       	    }
       	    if(!$values[$k]['Money']){$values[$k]['Money']=0;}
   	        $classroom=$roomModel->getOne('classroomname','where id='.$v['classroomid']);
			if($v['type']==2){$values[$k]['type']='线上  '.$classroom;
		    }else{$values[$k]['type']='线下  '.$classroom;}
        }
		$result['values'] = $values;
	    return $result;
    }
    /**
     * 获取视频播放地址
     * @param mixed $vodid
     * @param mixed $type
     * @param mixed $isPC
     * @return string[]
     */
    public function playVod($vodid,$type=0,$isPC=1,$autoplay=true){
    	$vodModel = M('app_vod_list');
    	$vod      = $vodModel->getRow("where vdoId='$vodid' limit 1 ");
    	if(!$vod){
    		$result['result']='error';
    		$result['msg']='系统出错,视频不存在!';
    		return $result;
    	}
    	if($vod['vdoService']==10){
			$tencentvod = new Tencentvdo();
			if (true){//开启防倒链
//				if (empty($vod['fileUrl'])){
//					$tencentvod->updateVideoInfo($vodid);
//					$sourceVideoUrl = $vodModel->getOne('fileUrl',"where vdoId='$vodid'");
//				}else{
//					$sourceVideoUrl = $vod['fileUrl'];
//				}
//				$urlArr = explode('/',$sourceVideoUrl);
//				$dir   = '/'.$urlArr[3].'/'.$urlArr[4].'/';
				$t     = dechex(time()+10800); //过期时间戳
				$strs  = "123456789ZXCVBNMASDFGHJKLQWERTYUIOPqwertyuiopasdfghjklzxcvbnm";
				$us    = substr(str_shuffle($strs),mt_rand(0,strlen($strs)-11),10);//随机字符串
				$sign  = md5($tencentvod->key.$tencentvod->appid.$vodid.$t.$us);
//				$result['play'] = "var player = TCPlayer('player-container-id',{fileID:'$vodid',appID:'$tencentvod->appid',t:'$t',us:'$us',sign:'$sign',autoplay:$autoplay});";
				$result['play'] = [
					'fileID'=>$vodid,
					'appID'=>$tencentvod->appid,
					't'=>$t,
					'us'=>$us,
					'sign'=>$sign,
					'autoplay'=>$autoplay
				];
			}else{
				$result['play'] = "var player = TCPlayer('player-container-id',{fileID:'$vodid',appID:'$tencentvod->appid',autoplay:$autoplay}); return player;";
			}
			$result['vdoService'] = 'tencent';
//			$result['url'] = "$sourceVideoUrl?t=$t&us=$us&sign=$sign";
			return $result;

    	}elseif ($vod['vdoService']==11){//保利威
			$configModel = M('app_live_config');
			$config = $configModel->getOne('json',"where wxid=$vod[wxid] and serviceid=11");
			$config = json_decode($config,true);

			$vid = $vodid;
			$secretkey= $config['secretkey'];
			$ts=time()*1000;  //10位的秒级时间戳，后面加多3个0，最后为13位的数值
			$hash = md5($secretkey.$vid.$ts);
			$result['play'] = [
				'width'=>'600',
				'height'=>'485',
				'vid'=>$vid,
				'ts'=>$ts,
				'sign'=>$hash,
			];
			$result['vdoService'] = 'tencent';
			return $result;
		}elseif($vod['vdoService']==7){//获取百度视频
		    $vodModel = new \Core\Baiduyun();//百度视频
			try{
			 	$vods = $vodModel->selectVod($vodid);
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
		        $vodss           = $uservod->getRow('where wxid = '.$vod['wxid'].' limit 1');
				$setting         = explode('※',$vodss['setting']);
				$player  = getplay($playurl,$setting,0,0,0,100);
			}catch(Exception $e){
			    $result['result']='error';
	    		$result['msg']='系统出错';
	    		return $result;
			}
	    	$result['play']=$player;
	    	$result['vdoService']='baidu';
	    	return $result;
	   }else{
		    if($isPC==2){
			    $vods = new \Core\Playvdo();
				$aa   = $vods->getPlayAddress($vodid);
				if(isset($aa->Code)){
					$result['code']  = '10005';
					$result['msg']   = '该视频云端被删除';
					header('Content-Type:application/json;charset=utf-8');
					echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
				}
				$PlayInfo = isset($aa->PlayInfoList->PlayInfo[1])?$aa->PlayInfoList->PlayInfo[1]:$aa->PlayInfoList->PlayInfo[0];

			    $playurl[0]['url']        = $PlayInfo->PlayURL;
			    $playurl[0]['teblemname'] = '66666666';
			    $uservod         = M('app_vod');
			    $vodss           = $uservod->getRow('where wxid = '.$vod['wxid'].' limit 1');
				$setting         = explode('※',$vodss['setting']);
			    $result['play']= 'var player = cyberplayer("playercontainer").setup({
					width: "100%",
					height: "100%",
					title: "'.$vod['vdoName'].'",
					file: "'.$PlayInfo->PlayURL.'",
					image: "'.$aa->VideoBase->CoverURL.'",
					autostart: false,
					stretching: "uniform",
					repeat: true,
					volume: 100,
					controls: true,
					controlbar: {
						barLogo: false,
						barLogoUrl: "https://store.kesion.com/",
						canDrag: true,
					},
					starttime: 0,
					ak: "37aa1221ed7943d58938cd749641d4c0"
				}); return player';
	    		$result['vdoService']='baidu';
	    		return $result;
			}else{
			    $vods = new \Core\Playvdo();
				$aa  = $vods->getPlayAuth($vodid);
				if(isset($aa->Code)){
					$result['code']  = '10005';
					$result['msg']   = '该视频云端被删除';
					header('Content-Type:application/json;charset=utf-8');
					echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
				}
				$result['play']       = [
					'id' => 'playercontainer',
					'autoplay' => true,
					'useH5Prism' => true,
					'useFlashPrism' => true,
					'width' => '100%',
					'height' => '100%',
					'vid' => $vodid,
					'showBarTime' => 300,
					'playauth' => $aa->PlayAuth,
				];
    			$result['vdoService'] = 'aliyun';
	    		return $result;
			}
	    }
    }
    /*获取章节目录或者课时目录*/
    public function playHistory($type,$id,$p,$maxperpage){
    	if($type==1){
    		$courseModel = M('app_course');
    		$table = $courseModel->getOne('chaptertable','where courseid='.$id);
    		$chapterModel = M($table);
    		$options          = $chapterModel->getOptions('10','where courseid='.$id);//分页参数设置
	    	$options['now_page'] = $p;
			$page             = Page($options);
			$chapterList  = $chapterModel->getPage($page,'root desc,orderid desc','where courseid='.$id,'title,chaptertype,enddate,videoId,begindate');
    		foreach($chapterList as $k =>$v){
    			if($v['chaptertype']==3){
    				$chapterList[$k]['review'] = '';//面授课程 无回看
    			}else{
    				if($v['enddate']>time()){
    					$chapterList[$k]['review'] = '';
    				}else{
    					$chapterList[$k]['review'] = '';//时间没过，课程还未开始无回放
    				}
    			}
    		}
    		$result['type'] = $type;
    		$result['page'] = $page;
    		$result['values'] =$chapterList;
    		return $result;
    	}elseif($type==2){
    		$classModel = M('app_class');
    		$schdeule = M('app_class_schedule');
    		$where = 'as a left join '.$classModel->table.' as b on a.classid=b.classid where a.classid='.$id;
    		$options          = $schdeule->getOptions('10',$where);//分页参数设置
	    	$options['now_page'] = $p;
			$page             = Page($options);
			$classList  = $schdeule->getPage($page,'a.timeSlotEnd desc',$where,'b.classType,a.title,a.timeSlotEnd,a.timeSlotStart');
    		foreach($classList as $k =>$v){
    			if($v['classType']==3){
    				$chapterList[$k]['review'] = '';//面授 无回看
    			}else{
    				if($v['timeSlotEnd']>time()){
    					$classList[$k]['review'] = '';
    				}else{
    					$classList[$k]['review'] = '';//时间没过，课程还未开始无回放
    				}
    			}
    		}
    		$result['page'] = $page;
    		$result['type'] = $type;
    		$result['values'] =$classList;
    		return $result;
    	}
    }
    //统计老师人数
    public function countTeacher($Data001){
		$class_teacherrelate = M('app_class_teacherrelate');
		$teachernum = $class_teacherrelate->getOne('count(id)','where wxid='.$Data001['wxid'].' and classid='.$Data001['classid']);
        return $teachernum;
    }
}