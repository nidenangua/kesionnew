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

class IndexController extends CommonController
{
	/**
     * 进入课程首页
	 */
	public function indexAction(){
		$courseType  = ChkClng(KS_S('courseType','1'));
		$setting     = $this->cache->GetSubH('apprelate','appid',$this->appid,'subappid',$courseType,'setting',$this->wxid);
		if(empty($setting)){
		 	$Data['subappid'] = $courseType;
		 	$Data['wxid']     = $this->wxid;
		 	$Data['adddate']  = time();
		 	$Data['appid']    = $this->appid;
		 	$Data['userid']   = $GLOBALS['_DoM']['userid'];
		 	$Data['setting']  = beginSetting(6);
		 	$apprelateModel   = M('common_app_userrelate');
		 	$apprelateModel->doadd($Data,'id');
		    $appcategory = $this->cache->PutHCache('apprelate',$this->wxid);
		    $setting     = beginSetting(6);
		}
        if(!empty($setting)){$setting = explode('※',$setting);}
		$status        = KS_S('status',3);
		$studentModel  = M('app_order_info');
		$commonModel   = M('app_reviews');
        $teacherModel  = M('common_user_teacher');
		$teacherCountModel = M('app_course_teacherrelate');
		$courseModel   = M('app_course');
		$categoryModel = M('app_category');
        $stucount = null !==GF('stucount') ? GF('stucount'):0;
        $commoncount = null !==GF('commoncount') ? GF('commoncount'):0;
        if($stucount == 1){
        	$orderby = 'a.studentcount desc';
        }elseif($commoncount == 1 ){
        	$orderby  = 'a.common desc';
        }else{
        	$orderby = 'a.courseid desc';
        }

        //时间判断
        $timetype=null !==GF('timetype') ? GF('timetype'):4;
        $chaptertime=M('app_chaptertime');
        if($timetype ==2){
			$starttime=strtotime(date('Y-m-d'));
			$endtime=$starttime+3600*24;
			$where =' as a left join '.$categoryModel->table.' as b on a.categoryid = b.categoryid  left join '.$chaptertime->table.' as c on c.courseid=a.courseid  where a.wxid='.$this->wxid;
			$where.=" and ( a.adddate>$starttime && a.adddate<$endtime) ";
		}elseif($timetype ==1){
		    $starttime=strtotime(date('Y-m-d'))-24*3600;
			$endtime=strtotime(date('Y-m-d'));
			$where =' as a left join '.$categoryModel->table.' as b on a.categoryid = b.categoryid  left join '.$chaptertime->table.' as c on c.courseid=a.courseid  where a.wxid='.$this->wxid;
			$where.=" and ( a.adddate>$starttime && a.adddate<$endtime) ";
		}elseif($timetype==3){
			$starttime=strtotime(date('Y-m-d'))+24*3600;
			$endtime=strtotime(date('Y-m-d'))+48*3600;
			$where =' as a left join '.$categoryModel->table.' as b on a.categoryid = b.categoryid  left join '.$chaptertime->table.' as c on c.courseid=a.courseid  where a.wxid='.$this->wxid;
			$where.=" and ( a.adddate>$starttime && a.adddate<$endtime) ";
		}elseif($timetype==5){
			$starttime=null !==GF('starttime') ? GF('starttime'):0;
			$endtime=null !==GF('endtime') ? GF('endtime'):0;
	        $start=date('Y/m/d  h:i:s',$starttime);
	        $end=date('Y/m/d  h:i:s',$endtime);
	        $where =' as a left join '.$categoryModel->table.' as b on a.categoryid = b.categoryid  left join '.$chaptertime->table.' as c on c.courseid=a.courseid  where a.wxid='.$this->wxid;
			$where.=" and ( a.adddate > $starttime && a.adddate < $endtime) ";
		}else{
			$where =' as a left join '.$categoryModel->table.' as b on a.categoryid = b.categoryid  where a.wxid='.$this->wxid;
		}
        $keyword = ChkSQL(KS_S('keyword'));
	    if(!empty($keyword)){
			$where.=" and a.title like '%$keyword%'";
		}
		if ($courseType==2){
			$where .= " and a.livetype=$this->livetype";
		}
		if($status==3){$where.= " and a.status!=-1";}
		elseif($status==1){$where.= " and a.status=1";}
		elseif($status==0){$where .= " and a.status=0";}
		elseif($status==2){$where.= " and a.status=2";}
		if($courseType != 0){
			$where.=' and courseType ='.$courseType;
		}
		$categoryid = null !==GF('categoryid') ? GF('categoryid'):0;
		if($categoryid!=0){$where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}
		$options  = $this->AppModel->getOptions('10',$where);//分页参数设置
		$page     = Page($options);
		$course   = $this->AppModel->getPage($page,$orderby,$where,'a.courseid,a.status,a.defaultpic,a.title,a.teacherid,a.courseType,a.price,a.chargetype,a.livetype,a.coursehour,a.studentcount,a.adddate,a.json');
		$fileModel = M('app_course_file');
		$app_course_sign = M('app_course_sign');
		foreach($course as $k=>$v){
			//字段扩展
			if (!empty($v['json'])){
				$course[$k]['json'] = json_decode($v['json'],true);
				if ($v['courseType']==6){//活动
                    $course[$k]['json'] = jsonUrldecode($course[$k]['json']);
                    $time = time();
                    $begindate = $course[$k]['json']['setting']['begindate']/1000;
                    $enddate = $course[$k]['json']['setting']['enddate']/1000;
                    $ctime = time()+24*60*60;
					if ($begindate>$time&&$begindate<$ctime){
						$course[$k]['json']['status'] = '即将开始';
					}elseif ($begindate>$time){
						$course[$k]['json']['status'] = '报名中';
					}elseif ($time<=$enddate&&$begindate<=$time){
						$course[$k]['json']['status'] = '进行中';
					}elseif($enddate<$time){
                        $course[$k]['json']['status'] = '已结束';
                    }
					$course[$k]['json']['date'] = KS_DATE($course[$k]['json']['setting']['begindate']/1000).' -- '.KS_DATE($course[$k]['json']['setting']['enddate']/1000);
					$course[$k]['json']['all_num'] = $app_course_sign->getOne('count(id)',"where courseid=$v[courseid] and wxid=$this->wxid");
					$course[$k]['json']['success_num'] = $app_course_sign->getOne('count(id)',"where courseid=$v[courseid] and wxid=$this->wxid and status=3");
					$course[$k]['json']['nocheck_num'] = $app_course_sign->getOne('count(id)',"where courseid=$v[courseid] and wxid=$this->wxid and status=0");
				}
				if ($v['courseType']==8){
                    $mall_json =json_decode($v['json'],true);
                    if ($mall_json['goods']['sell'] == 1){
                        $course[$k]['json']['stock'] = $mall_json['goods']['specteam']['stock'];
                    }else{
                        $stock = 0;
                        foreach ($mall_json['goods']['specteam']['info'] as &$mall_item){
                            $stock = $stock+$mall_item['stock'];
                        }
                        $course[$k]['json']['stock'] = $stock;
                    }
                }

			}
			$course[$k]['title'] = ChkSQL_return($v['title']);
		    $course[$k]['speakerteacher'] = $teacherModel->getOne('name','where userid='.$v['teacherid'].' limit 1');
		    $course[$k]['teachercount']   = $teacherCountModel->getOne('count(*)','where wxid='.$this->wxid.' and courseid ='.$v['courseid'].' limit 1');
            //$course[$k]['commoncount']  = $commonModel->getOne('count(*)','where wxid='.$this->wxid.' and infoid='.$v['courseid']);
//		    $course[$k]['studentcount'] = $studentModel->getOne('count(*)','where wxid='.$this->wxid.' and courseid='.$v['courseid'].' and status !=-1');
		    //$course[$k]['examcount']      = $examModel -> getOne('count(*)','where wxid='.$this->wxid.' and courseid='.$v['courseid']);
		    $course[$k]['filecount']      = $fileModel -> getOne('count(*)','where wxid='.$this->wxid.' and courseid='.$v['courseid']);
		    $chaptertable = $courseModel -> getOne('chaptertable','where courseid ='.$v['courseid'].' limit 1');
		    $chapterModel = M($chaptertable);
		    $course[$k]['keshicount']     = $chapterModel->getOne('count(*)','where wxid = '.$this->wxid.' and  courseid ='.$v['courseid'].' and depth = 3');
			if($v['courseType']==1){
				$course[$k]['jumpurl']    = '/?f=pc#/course/'.$v['courseid'];
				//$course[$k]['jumpurl']    = '/h5market/Micoursedetail?id='.$v['courseid'].'&type=1';
				$course[$k]['typetitle']  = '视频';
			}elseif($v['courseType']==2){
				$course[$k]['jumpurl']    = '/?f=pc#/course/'.$v['courseid'];
				$course[$k]['typetitle']  = '直播';
			}elseif($v['courseType']==3){
				$course[$k]['jumpurl']    = '/?f=pc#/course/'.$v['courseid'];
				$course[$k]['typetitle']  = '音频';
			}elseif($v['courseType']==4){
				$course[$k]['jumpurl']    = '/?f=pc#/course/'.$v['courseid'];
				$course[$k]['typetitle']  = '图文';
			}elseif($v['courseType']==6){
				$course[$k]['jumpurl']    = '/?f=m#/activity/'.$v['courseid'];
				$course[$k]['typetitle']  = '活动';
			}elseif($v['courseType']==5){
                $course[$k]['jumpurl']    = '/?f=m#/course/'.$v['courseid'];
                $course[$k]['typetitle']  = '面授';
            }elseif ($v['courseType']==8){
                $course[$k]['jumpurl']    = '/?f=m#/commodity?id='.$v['courseid'];
                $course[$k]['typetitle']  = '教辅周边';
            }
		}
		$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		include  CURR_VIEW_PATH . "coursemanage.php";
	}
	//推广弹窗
	public function shareAction(){
		include  CURR_VIEW_PATH . "share.php";
	}
	//面授签到二维码
    public function share3Action(){
        include  CURR_VIEW_PATH . "share3.php";
    }
	//开始上课弹窗
	public function shangkeAction()
	{
		if ($this->course['livetype']!=3){
			$model = M('app_course_teacherrelate');
			$list = $model->getAll("where wxid=$this->wxid and courseid=$this->courseid order by role asc");
			$isspeaker = false;
			foreach ($list as $k=>$v){
				if (!empty($v['teacherid'])){
					$data['token'] = KS_MD5($this->wxid.rand(1000,10000),32);
					$data['endtime'] = time()+7200;
					$model->update($data,"wxid=$this->wxid and teacherid=$v[teacherid] and courseid=$this->courseid");
					$list[$k]['token'] = $data['token'];
					$list[$k]['endtime'] = $data['endtime'];
					$list[$k]['name'] = User_GetUserName($v['teacherid']);
				}
				if ($v['role']==1) $isspeaker = true;//有主讲老师
			}
		}

		if ($this->course['livetype']==3){//千人直播
			$model_live = new \Kesion\Model\App\LiveModel();
			$channel = $model_live->getChannel($this->courseid);
		}

		if ($this->course['livetype']==1||$this->course['livetype']==2){
			$where = "where wxid=$this->wxid and courseid=$this->courseid";
			if ($this->course['livetype']==1) $where .= " and status=2";
//			$model = M('app_course_studentrelate');
			$model = M('app_course_rate');
			$student_list = $model->getAll($where." order by createtime desc");
			foreach ($student_list as $k=>$v){
				if (!empty($v['userid'])){
					$data1['token'] = KS_MD5($this->wxid.rand(1000,10000),32);

					$data1['endtime'] = time()+7200;
					$model->update($data1,"wxid=$this->wxid and userid='$v[userid]' and courseid=$this->courseid");
					$student_list[$k]['token'] = $data1['token'];
					$student_list[$k]['endtime'] = $data1['endtime'];
					$student_list[$k]['name'] = User_GetUserName($v['userid']);
				}
			}
		}
		include  CURR_VIEW_PATH . "shangke.php";
	}
	//推广弹窗
	public function downloadAction(){
	var_dump('ddd');exit;
		ks_header('https://itunes.apple.com/cn/app/%E8%AF%BE%E5%A0%82%E8%A1%97%E6%95%99%E5%B8%88%E7%AB%AF/id1358204606?mt=8');

		ks_header('http://a.app.qq.com/o/simple.jsp?pkgname=com.kesion.kesionlive');

	}
	//进入直播间
	public function share1Action(){
		$courseModel  = M('app_course');
        $coursetable  = $courseModel->getOne('chaptertable',' where courseid='.$this->courseid);
        $chapterModel = M($coursetable);
        $chapterid    = $chapterModel->getOne('chapterid',' where courseid='.$this->courseid.' and depth=3 and chaptertype=2');
		include  CURR_VIEW_PATH . "share1.php";
	}
	//插入课程appid数据
	public function insertAction(){
	    $oo =  M('common_domain');
		$ii  = $oo->getAll('','wxid,userid');
		$apprelateModel   = M('common_app_userrelate');
		foreach($ii as $k=>$v){
			$sss[] = 1;$sss[] = 2;$sss[] = 3;$sss[] = 4;
			foreach($sss as $kt=>$vt){
				$setting     = $this->cache->GetSubH('apprelate','appid',$this->appid,'subappid',$vt,'setting',$v['wxid']);
				if(empty($setting)){
		 			$Data['subappid'] = $vt;
		 			$Data['wxid']     = $v['wxid'];
		 			$Data['adddate']  = time();
		 			$Data['appid']    = $this->appid;
		 			$Data['userid']   = $v['userid'];
		 			$Data['setting']  = beginSetting(6);
		 			$apprelateModel->doadd($Data,'id');
					$appcategory = $this->cache->PutHCache('apprelate',$v['wxid']);
				}
			}
		}
		var_dump($ii);exit;
	}
	public function addcourseAction(){
		$courseType  = ChkClng(KS_S('courseType','1'));;
		$setting   = $this->cache->GetSubH('apprelate','appid',$this->appid,'subappid',$courseType,'setting',$this->wxid);
		include  CURR_VIEW_PATH . "addcourse.php";
	}
	/**
     * 添加课程（保存）
	 */
	public function doaddcourseAction(){
		$courseType  = ChkClng(KS_S('courseType',1));
        $title       = ChkSQL(KS_G("post.title"));         //课程名称
       if (mb_strlen($title)>50){
        KS_Alert('课程名称长度不合法， 请控制在50个字符内!','error');
       }
		//$setting   = appSetting($this->wxid,$this->appid);//获取App配置
		$setting     = $this->cache->GetSubH('apprelate','appid',$this->appid,'subappid',$courseType,'setting',$this->wxid);
//		if($setting[1] == 1){$Data['status'] =1;
//		}else{$Data['status'] =0;}
		$Data['defaultpic']   = nopic(12);
        $Data['categoryid']   = ChkClng(KS_G("post.categoryid"));
		$Data['isassociated'] = ChkClng(KS_G("post.associated"));//关联售卖
		$Data['isseparate']   = ChkClng(KS_G("post.separate"));//单独售卖
		if($Data['isassociated']){
		   $columnid = ChkSQL(KS_G('post.columnid'));
		}
		if($this->setting[3]==0){
			$courseType  = KS_S('courseType',1);
			$Data['status']       = ChkClng(KS_G("post.status"));
			$Data['keshitotal']   = ChkClng(KS_G("post.keshitotal"));
			$Data['shortdesc']    = ChkSQL(KS_G("post.shortdesc"));
			$Data['studentcount'] = ChkClng(KS_G("post.studentcount"));
			if ($Data['studentcount']<0||$Data['studentcount']>100000) KS_INFO('销量区间在0到10万之间',0);
			$Data['content']      = Src(EncodeSQL(KS_G("post.content")));
            if(empty($Data['content'])){KS_INFO('详情不能为空');}
			$Data['intro']        = Src(ChkSQL(KS_G("post.intro")));
		    $Data['announce']     = Src(EncodeSQL(KS_G("post.announce")));    //试看内容

			if(!empty(ChkSQL(KS_G("post.defaultpic")))){
				$Data['defaultpic']   = ChkSQL(KS_G("post.defaultpic"));
			}

			$Data['iscopy']           = ChkClng(KS_G("post.iscopy"));
			$Data['ispart']           = ChkClng(KS_G("post.ispart"));
			if($Data['isseparate']){//支持单独售卖才接收价格之类的参数
				$Data['chargetype']   = ChkClng(KS_G("post.chargetype"));
				$Data['price_market'] = ChkFloat(KS_G("post.price_market"));
				$Data['discount']     = ChkFloat(KS_G("post.discount"));
				$Data['price']        = ChkClng(KS_G("post.price"));
			}
			$Data['coursehour']   = ChkClng(KS_G("post.coursehour"));

			if(empty($Data['price_market'])){
				$Data['price_market'] = $Data['price'];
			}
		}else{
			$Data['coursehour']   = 0;
			$courseType  = ChkClng(KS_G('post.courseType'));
		}
		$Data['expecthour']       = ChkSQL(KS_G("post.expecthour"));//连载课的预计课时
		//分享出去的封面
		$Data['sharepic']     = getsharepic($Data['defaultpic']);
		$Data['title']        = $title;
		$Data['userid']       = $this->userid;
		$Data['wxid']         = $this->wxid;
		$Data['courseType']   = $courseType;
		$Data['adddate']      = time();

		$chaptertableModel    = new CourseModel('common_extends_table');
		$Data['chaptertable'] = $chaptertableModel->getOne('tablename','where Isdefault=1 and type =1');
		// var_dump($Data['chaptertable']);exit();
		$title='';if($this->courseType==1){$title= '点播';}elseif($this->courseType==2){$title= '直播';}elseif($this->courseType==3){$title= '音频';}elseif($this->courseType==4){$title= '图文';}

		$Rule['title']        = $title.'名称|isDbexis,isEmpty';
		$Rule['chaptertable'] = '章节表出错，请联系管理员|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel,'courseType='.$this->courseType.' and wxid='.$this->wxid.' and status!=-1');
		if($Data['coursehour']==0&&($this->courseType==3||$this->courseType==1||$this->courseType==2)){
			 if($this->courseType!=2){
		     	if(empty(ChkSQL(KS_G("post.fileurl")))&&$this->setting[3]==0){KS_INFO('请先选择文件',0,'','',3);}
		     }
		}
		//插入课程表前，做一下必要参数检查(非高级模式)
		if($this->setting[3]==0 && $Data['coursehour']==0){
			  if ($this->courseType==2){  //直播检查
		  			if(empty(KS_G("post.begindate"))){KS_INFO('开始时间不能为空',0,'','',3);}
					$Data2['begindate']    = strtotime(ChkSQL(KS_G("post.begindate")));
					$Data2['livehours']    = ChkFloat(KS_G("post.livehours"));
					$Data2['enddate']      = $Data2['begindate']+$Data2['livehours']*3600;
					$Rule2['begindate']    = '开始时间|isEmpty';
		   			$Rule2['enddate']      = '结束时间|isEmpty';
					Chkpost($Data2,$Rule2);
					if($Data2['begindate']>$Data2['enddate']){KS_INFO('开始时间不能大于结束时间',6,'','',1);}
			  }
		}
		if($this->courseType==1||$this->courseType==3){
			$Data['slide']  =  ChkClng(KS_G("post.slide"));
			$json_data['is_audition']  =  ChkClng(KS_G("post.is_audition"));
			$json_data['audition_time']  =  ChkClng(KS_G("post.audition_time"));
			$Data['json'] = json_encode($json_data,JSON_UNESCAPED_UNICODE);
		}
        if($this->courseType==2){
			$json_data['setting']['is_form']  = ChkClng(KS_G("post.is_form"));
			$json_data['form']  =  ChkSQL_Array(json_decode(KS_G("post.json"),true),true);
			$Data['json']  =  json_encode($json_data,JSON_UNESCAPED_UNICODE);
        	$Data['livetype']  =  $this->livetype;
			if (empty($Data['livetype'])) KS_INFO('请选择直播类型',0,'','',3);
        }

        /*****************************************************收费信息  begin******************************************************************/
        $Data['chargetype']   = ChkClng(KS_G("post.chargetype"));
        $Data['price_market'] = ChkFloat(KS_G("post.price_market"));
        $Data['price']        = ChkFloat(KS_G("post.price"));
        if(empty($Data['price_market'])){
            $Data['price_market'] = $Data['price'];
        }
        /*****************************************************收费信息  end*******************************************************************/



		/****************************************************************面授  begin***********************************************************/

		if($this->courseType==5){
			$json_data['date1'] = strtotime(ChkSQL(KS_G("post.date1")));//报名开始
			$json_data['date2'] = strtotime(ChkSQL(KS_G("post.date2")));//报名结束
			$json_data['date3'] = strtotime(ChkSQL(KS_G("post.date3")));//开课开始
			$json_data['date4'] = strtotime(ChkSQL(KS_G("post.date4")));//开课结束
			$json_data['address'] = ChkSQL(KS_G("post.address"));//开课地址
			$json_data['people_num'] = ChkClng(KS_G("post.people_num",0));//上课人数
			$json_data['is_dingjin'] = ChkClng(KS_G("post.is_dingjin",0));//是否开启定金
			$json_data['dingjin'] = ChkFloat(KS_G("post.dingjin",0));//是否开启定金
			if (!$json_data['address']||!$json_data['people_num']||!$json_data['date1']||!$json_data['date2']||!$json_data['date3']||!$json_data['date4']) KS_INFO('请填写完整开课信息',0,'','',3);
			if ($json_data['date1']>$json_data['date2']||$json_data['date3']>$json_data['date4'])  KS_INFO('结束时间不能早于开始时间',0,'','',3);
			if ($json_data['date2']>$json_data['date4'])  KS_INFO('报名结束时间不能大于开课时间',0,'','',3);
			$Data['json'] = json_encode($json_data,JSON_UNESCAPED_UNICODE);
            if ($json_data['is_dingjin']==1&&$json_data['dingjin']<=0){
                KS_INFO('定金要大于0元',0,'','',3);
            }
			//$Data['chapterTemplate'] = 4;
			//$Data['coursehour'] = 1;
		}
		/*****************************************************************面授  end**************************************************************/


		/*****************************************************************训练营  begin**********************************************************/
		if($this->courseType==7){
			$json_data['sell'] = ChkClng(KS_G("post.sell",0));
			$Data['json'] = json_encode($json_data,JSON_UNESCAPED_UNICODE);
			$Data['chapterTemplate'] = 6;
		}
		/*****************************************************************训练营  end************************************************************/
		$courseid=$this->AppModel->doadd($Data,'courseid');   //插入课程表
		if(isset($columnid)){
           $AppModel = M('app_column_link');
			$DataCol['infoid'] = $courseid;
			$shopid = explode('|',$columnid);
			foreach ($shopid as $k => $v) {
				if(ChkClng($v)>0){
					$DataCol['type'] =1;
					$DataCol['columnid'] = $v;
		            $AppModel->doadd($DataCol,'id');
		            $db_order_info = M('app_order_info');
					$orderInfo = $db_order_info->getAll('where paystatus=1 and type=7 and courseid='.$v.' and status!=-1','memberid');
					foreach($orderInfo as $k =>$v){
						$this->cache->PutUCache('havecolumn',$v['memberid']);//更新购买者的缓存
					}
				}
			}
		}
		// exit();
		if($Data['coursehour']==0&&($this->courseType==3||$this->courseType==1||$this->courseType==2)){  //单节课 插入到章节表
			$courseModel      = M('app_course');
			$course           = $courseModel->getRow(' where courseid='.$courseid.' limit 1');
			$chapterModel     = M($course['chaptertable']);   //章节存放表
			$chapter          = $chapterModel->getRow('where courseid='.$courseid.' limit 1');
			$Data2['depth']   = 3;
			$Data2['chaptertype'] = $this->courseType;
			$Data2['json'] = $Data['json'];
            $VodModel=M('app_vod_list');
			if($this->courseType!=2){  //非直播课时，需要选择文章
				if(empty(ChkSQL(KS_S("post.fileurl")))&&$this->setting[3]==0){KS_INFO('请先选择文件',0,'','',3);}
				$Data2['videoId'] = ChkSQL(KS_S("post.fileurl"));
				$playtime = $VodModel->getRow("where vdoId = '$Data2[videoId]'",'playtime');
                $Data2['playtime'] = $playtime['playtime'];
			}
			if($chapter){
			 	$chapterModel->update($Data2,'chapterid='.$chapter['chapterid'].' limit 1');
			}else{
			 	$Data['chapterTemplate'] = 3;
			 	$Data2['courseid']       = $courseid;
			 	$Data2['wxid']           = $this->wxid;
			 	$Data2['title']          = $Data['title'];
			 	$Data2['userid']         = $this->userid;
			 	if($this->courseType==2&&$this->setting[3]==0){
					$Data2['livetype']   =  $Data['livetype'];//直播类型：0、视频直播 1、语音直播
					//ChkClng(KS_G('post.livetype'));
					$chapters =$chapterModel->getAll(' where courseid='.$courseid.' and depth =3 and chaptertype=2','begindate,enddate');
					foreach($chapters as $kt=>$vt){
					 	if($Data2['begindate']>=$vt['begindate'] && $Data2['begindate']<=$vt['enddate']){KS_INFO('该时间段，在该课程已经有直播了',6);}
					 	if($Data2['enddate']>=$vt['begindate'] && $Data2['enddate']<=$vt['enddate']){KS_INFO('该时间段，在该课程已经有直播了',6);}
					}
				}
			 	$chapterid = $chapterModel->doAdd($Data2,'chapterid');
			 	if($Data2['chaptertype']==2&&$this->setting[3]==0&&$Data2['livetype']==0){
			 		//插入章节表
			   	    $chapter1          =$chapterModel->getRow('where chapterid='.$chapterid.' limit 1');
				   	$chapterTimeModel  =M('app_chaptertime');
				   	$Datas['courseid'] =$courseid;
				   	$Datas['chapterid']=$chapterid;
				   	$Datas['starttime']=$Data2['begindate'];
				   	$Datas['endtime']  =$Data2['enddate'];
				   	$Datas['parentidpath']=$chapter1['parentidpath'];
				   	$Datas['wxid']=$this->wxid;
				   	$chapterTimeModel->doAdd($Datas,'id');
				   	//插入直播频道表
				   	$liveModel   = M('app_live_list');
			  	    $live= $liveModel->getRow('where wxid='.$this->wxid.' and courseid='.$this->courseid.'  limit 1');
			  	    if($live){
			  	       $Data1['channlName']=$live['channlName'];
			  	       $Data1['password']=$live['password'];
			  	    }else{
			  	   	   $maxid = $liveModel->getMaxValue('id')+1;
			  	       $Data1['channlName']=str_pad($maxid,6,"0",STR_PAD_LEFT);
			  	    }
			  	    $Data1['courseid']=$courseid;
			  	    $Data1['chapterid']=$chapterid;
			  	    $Data1['password']=rand(10000,99999);
			  	    $Data1['adddate']=time();
			  	    $Data1['teacherid'] = $this->userid;
			  	    $Data1['classlevel'] = 0;
			  	    $Data1['status'] = 1;
			  	    $Data1['wxid'] = $this->wxid;
			  	    $Data1['type'] = 1;
			  	    //学生观看记录表
			  	    $chaptertableModel    = new CourseModel('common_extends_table');
			        $Data1['studentTable'] = $chaptertableModel->getOne('tablename','where Isdefault=1 and type =3');
			  	    $liveModel->doAdd($Data1,'id');
					//插入老师排课
					$teacherModel = M('app_course_teacherrelate');
		 			$Data_Docent['courseid']  = $courseid;
		 			$Data_Docent['wxid']      = $this->wxid;
					$Data_Docent['isspeaker'] = 1;
					$Data_Docent['teacherid'] = $this->userid;
					$teacherModel->doAdd($Data_Docent,'id');
			 	}
			}
			$vdo=$VodModel->getRow("where vdoId='".$chapter['videoId']."' limit 1");
		}
		if($this->setting[3]==0){
			$typea    = ChkClng(KS_G('post.typea'));
			if($typea == 2){
				$url = M_URL($this->AppName.'/Index','period',$courseid,GP(''));
			}elseif ($typea==3){
				$url = M_URL($this->AppName.'/Index','period',$courseid,GP(''));
			}else{
				$url = M_URL($this->AppName.'/Index','index',$courseid,GP(''));
			}
	    }else{
			$url = M_URL($this->AppName.'/Index','basics',$courseid,GP(''));
		}
		$Dotask  = new \Core\Dotask();
        $Dotask->checkTask($this->wxid,4);//检查是否完成任务
	    $this->cache->PutHCache('courseinfo',$this->userid);//将课程插入缓存
		KS_INFO('添加成功',3,$url);
	}
	public function basics2Action(){
		$courseType  = KS_S('courseType',1);
		$courseid    = ChkClng(KS_G('get.id'));
		$setting     = $this->cache->GetSubH('apprelate','appid',$this->appid,'subappid',$courseType,'setting',$this->wxid);
        if(!empty($setting)){$setting = explode('※',$setting);}
		if($setting[3]==0&&empty($courseid)){
			include  CURR_VIEW_PATH . "audio.php";exit;
		}
    }
	/**
	 * 进入添加编辑基本信息
	 */
	public function basicsAction(){
		$courseType   = ChkClng(KS_S('courseType',1));
		$courseid     = ChkClng(KS_G('get.id'));
		$setting      = $this->cache->GetSubH('apprelate','appid',$this->appid,'subappid',$courseType,'setting',$this->wxid);
        if(!empty($setting)){$setting = explode('※',$setting);}
	    $Linkage = Linkage(array());
		$Linkage->cachename = 'appcategory';
		$Linkage->wxid      = $this->wxid;
		$Linkage->inputname  = 'categoryid';
		if(!empty($courseid)){
			$course=$this->AppModel->getRow("where wxid=".$this->wxid." and courseid=$courseid limit 1");
			$course['title'] = ChkSQL_return($course['title']);
			if($course['coursehour']==0){
				 $chapterModel = M($course['chaptertable']);
				 $chapter      = $chapterModel->getRow('where courseid='.$courseid.' limit 1');
				 $VodModel     = M('app_vod_list');
				 $vdo          = $VodModel->getRow("where vdoId='".$chapter['videoId']."' limit 1");
			}
			$db_column = M('app_column');
			$db_column_link = M('app_column_link');
			$columAry = $db_column->getAll(' as a left join '.$db_column_link->table.' as b on a.columnid=b.columnid where b.infoid='.$course['courseid'].' and b.type=1','a.columnid,a.title,a.defaultpic,a.chargetype,a.price');
			$columnid = '0';
			foreach ($columAry as $k => $v) {
				$columAry[$k]['defaultpic'] = empty(Img($v['defaultpic']))? nopic(12): Img($v['defaultpic']);
				$columnid.='|'.$v['columnid'];
			}
			if (!empty($course['json'])){
				$course['json'] = json_decode($course['json'],true);
			}
			$Linkage->categoryid = $course['categoryid'];
		}else{
		    $Linkage->inputname  = 'categoryid';
		}

		include  CURR_VIEW_PATH . "knowledge.php";exit;
    }
	/**
     * 保存编辑基本信息
	 */
	public function doeditAction(){
		$courseid             = ChkClng(KS_G('get.id'));
		if($this->setting[3]==0){}
		$Data['status']       = ChkSQL(KS_G("post.status"));

		$Data['status']       = ChkSQL(KS_G("post.status"));
		$Data['shortdesc']    = ChkSQL(KS_G("post.shortdesc"));
		$Data['studentcount'] = ChkSQL(KS_G("post.studentcount"));

		if ($Data['studentcount']<0||$Data['studentcount']>100000) KS_INFO('销量区间在0到10万之间',0);
		$Data['content']      = Src(EncodeSQL(KS_G("post.content")));
        if(empty($Data['content'])){KS_INFO('详情不能为空');}
		$Data['intro']        = ChkSQL(KS_G("post.intro"));
	    $Data['announce']     = Src(EncodeSQL(KS_G("post.announce")));
		$Data['iscopy']       = ChkClng(KS_G("post.iscopy"));
		$Data['isvip']       = ChkClng(KS_G("post.isvip"));//vip
		$Data['expecthour']   = ChkClng(KS_G("post.expecthour"));//连载课的预计课时
		$Data['ispart']       = ChkClng(KS_G("post.ispart"));
		$Data['isassociated'] = ChkClng(KS_G("post.associated"));//关联售卖
		$Data['isseparate']   = ChkClng(KS_G("post.separate"));//单独售卖

		$AppModel = M('app_column_link');
		$delid = $AppModel->getAll('where type=1 and infoid='.$courseid,'columnid');
		$AppModel->delete('type=1 and infoid='.$courseid);

		foreach($delid as $k1 =>$v1){
	  	    $db_order_info = M('app_order_info');
			$orderInfo = $db_order_info->getAll('where paystatus=1 and type=7 and courseid='.$v1['columnid'].' and status!=-1','memberid');
			foreach($orderInfo as $k =>$v){
				$this->cache->PutUCache('havecolumn',$v['memberid']);//更新购买者的缓存
			}
		}
		if($Data['isassociated']){
		    $columnid = ChkSQL(KS_G('post.columnid'));
			$DataCol['infoid'] = $courseid;
			$shopid = explode('|',$columnid);
			foreach ($shopid as $k => $v) {
				if($v){
                    if (ChkClng($v)>0){
                        $DataCol['type'] =1;
                        $DataCol['columnid'] = ChkClng($v);
                        $AppModel->doadd($DataCol,'id');
                        $db_order_info = M('app_order_info');
                        $orderInfo = $db_order_info->getAll('where paystatus=1 and type=7 and courseid='.$v.' and status!=-1','memberid');
                        foreach($orderInfo as $k =>$v){
                            $this->cache->PutUCache('havecolumn',$v['memberid']);//更新购买者的缓存
                        }
                    }
				}
			}
		}

		$Data['title']        = ChkSQL(KS_G("post.title"));
		$Data['categoryid']   = ChkClng(KS_G('post.categoryid'));
		$Data['courselevel']  = ChkClng(KS_G("post.courselevel"));
//		if($Data['isseparate']){//支持单独售卖才接收价格之类的参数
			$Data['chargetype']   = ChkClng(KS_G("post.chargetype"));
			$Data['price_market'] = ChkFloat(KS_G("post.price_market"));
			$Data['price']        = ChkFloat(KS_G("post.price"));
			if(empty($Data['price_market'])){
				$Data['price_market'] = $Data['price'];
		    }
//		}
		$Data['discount']     = ChkFloat(KS_G("post.discount"));


		$Data['validedays']   = ChkClng(KS_G("post.validedays"));
		$Data['coursehour']   = ChkClng(KS_G("post.coursehour"));
		if($this->courseType==1||$this->courseType==3){
			$Data['slide']  =  ChkClng(KS_G("post.slide"));
			$json_data['is_audition']  =  ChkClng(KS_G("post.is_audition"));
			$json_data['audition_time']  =  ChkClng(KS_G("post.audition_time"));
			$Data['json'] = json_encode($json_data,JSON_UNESCAPED_UNICODE);
		}
		if($Data['coursehour']==0&&($this->courseType==3||$this->courseType==1||$this->courseType==2)){
			$courseModel      = M('app_course');
			$course           = $courseModel->getRow(' where courseid='.$courseid.' limit 1');
			$chapterModel     = M($course['chaptertable']);
			$chapter          = $chapterModel->getRow('where courseid='.$courseid.' limit 1');
			$Data2['chaptertype'] = $this->courseType;
			$Data2['json'] = $Data['json'];

			if($this->courseType!=2){
				if(empty(ChkSQL(KS_G("post.fileurl")))){KS_INFO('请先选择文件',0,'','',3);}
				$Data2['videoId'] = ChkSQL(KS_S("post.fileurl"));
                $VodModel=M('app_vod_list');
                $playtime = $VodModel->getRow("where vdoId = '$Data2[videoId]'",'playtime');
                $Data2['playtime'] = $playtime['playtime'];
			}
			if($chapter){
				if($this->courseType==2){
					if(empty(KS_G("post.begindate"))){KS_INFO('开始时间不能为空');}
					$Data2['begindate']    = strtotime(ChkSQL(KS_G("post.begindate")));
					$Data2['livehours']    = ChkSQL(KS_G("post.livehours"));
					$Data2['enddate']      = $Data2['begindate']+$Data2['livehours']*3600;
				}
			 	$chapterModel->update($Data2,'chapterid='.$chapter['chapterid'].' limit 1');
			}else{
			 	$Data['chapterTemplate'] = 3;
			 	$Data2['courseid']       = $courseid;
			 	$Data2['wxid']           = $this->wxid;
			 	$Data2['title']          = $Data['title'];
			 	$Data2['userid']         = $this->userid;
			 	if($this->courseType==2){
			 		if(empty(KS_G("post.begindate"))){KS_INFO('开始时间不能为空');}
					$Data2['begindate']    = strtotime(ChkSQL(KS_G("post.begindate")));
					$Data2['livehours']    = ChkSQL(KS_G("post.livehours"));
					$Data2['enddate']      = $Data2['begindate']+$Data2['livehours']*3600;
				}
			 	$chapterid = $chapterModel->doAdd($Data2,'chapterid');
			}
            $VodModel=M('app_vod_list');
			$vdo=$VodModel->getRow("where vdoId='".$chapter['videoId']."' limit 1");
		}elseif($Data['coursehour']==1&&$this->course['coursehour']==0){
			$chapterData['chapterTemplate'] = 0;
			$this->chapterModel->delete('courseid='.$this->courseid);
			$this->AppModel->update($chapterData,'courseid='.$this->courseid);
		}
		if(!empty(ChkSQL(KS_G("post.defaultpic")))){
			$Data['defaultpic']   = ChkSQL(KS_G("post.defaultpic"));
			//分享出去的封面
			$Data['sharepic']     = getsharepic($Data['defaultpic']);
		}
		$Rule['title']          = '课程名称|isEmpty';
		$Rule['categoryid']     = '分类|isEmpty';
		//$Rule['validedays']   = '剩余天数|isEmpty,isnumber';
		Chkpost($Data,$Rule,$this->AppModel);

		if($this->courseType==2){
			$json_data['setting']['is_form']  = ChkClng(KS_G("post.is_form"));
			$json_data['form']  =  ChkSQL_Array(json_decode(KS_G("post.json"),true),true);
			$Data['json']  =  json_encode($json_data,JSON_UNESCAPED_UNICODE);
			$Data['livetype']  =  $this->livetype;
			if (empty($Data['livetype'])) KS_INFO('请选择直播类型',0,'','',3);
		}
		/*****************面授  begin************************/
		if($this->courseType==5){
			$json_data['date1'] = strtotime(ChkSQL(KS_G("post.date1")));//报名开始
			$json_data['date2'] = strtotime(ChkSQL(KS_G("post.date2")));//报名结束
			$json_data['date3'] = strtotime(ChkSQL(KS_G("post.date3")));//开课开始
			$json_data['date4'] = strtotime(ChkSQL(KS_G("post.date4")));//开课结束
			$json_data['address'] = ChkSQL(KS_G("post.address"));//开课地址
			$json_data['people_num'] = ChkClng(KS_G("post.people_num",0));//上课人数
			$json_data['is_dingjin'] = ChkClng(KS_G("post.is_dingjin",0));//是否开启定金
			$json_data['dingjin'] = ChkFloat(KS_G("post.dingjin",0));//是否开启定金
			if (!$json_data['address']||!$json_data['people_num']||!$json_data['date1']||!$json_data['date2']||!$json_data['date3']||!$json_data['date4']) KS_INFO('请填写完整开课信息',0,'','',3);
			if ($json_data['date2']<$json_data['date1']||$json_data['date4']<$json_data['date3'])  KS_INFO('结束时间不能早于开始时间',0,'','',3);
            if ($json_data['date2']>$json_data['date4'])  KS_INFO('报名结束时间不能大于开课时间',0,'','',3);
			if ($json_data['is_dingjin']==1&&$json_data['dingjin']<=0){
                KS_INFO('定金要大于0元',0,'','',3);
            }
            //$Data['chapterTemplate'] = 4;
			//$Data['coursehour'] = 1;
		}
		/*****************面授  end************************/

		/*****************************************************************训练营  begin**********************************************************/
		if($this->courseType==7){
			$json_data['sell'] = ChkClng(KS_G("post.sell",0));
			$Data['chapterTemplate'] = 5;
			$Data['coursehour'] = 1;
		}
		/*****************************************************************训练营  end************************************************************/
		if (!empty($json_data)) $Data['json'] = json_encode($json_data,JSON_UNESCAPED_UNICODE);
		$this->AppModel->update($Data,"courseid=$courseid");
		$this->cache->PutHCache('courseinfo',$this->userid);//将课程插入缓存
		$typea    = ChkClng(KS_G('post.typea'));
		if($typea == 1){
			$url = M_URL($this->AppName.'/Index','index',$courseid,GP(''));
		}else{
			if($Data['coursehour']==0&&$this->courseType!=4&&$this->courseType!=5){
				if($this->setting[3]==0){
					$url = M_URL($this->AppName.'/Index','index',$courseid,GP(''));
				}else{
					$url = M_URL($this->AppName.'/Index','period',$courseid,GP(''));
				}
			}else{
			    $url = M_URL($this->AppName.'/Index','period',$courseid,GP(''));
			}
		}
	    KS_INFO("保存成功",0,$url);
    }
	//上架
	public function  upAction(){
		$now_page = ChkClng(KS_S('p',1));
		$courseid = ChkClng(KS_G('get.id'));
		$Data['status'] = 2;
		$this->AppModel->update($Data,'courseid='.$courseid);
		$this->cache->PutHCache('courseinfo',$this->wxid);//将课程插入缓存
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO('',0,$url);
    }
	//下架
	public function  downAction(){
		$now_page       = ChkClng(KS_S('p',1));
		$courseid       = ChkClng(KS_G('get.id'));
		$Data['status'] = 0;
		$this->AppModel->update($Data,'courseid='.$courseid);
		$this->cache->PutHCache('courseinfo',$this->wxid);//将课程插入缓存
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO('',0,$url);
    }
    /**
	 * 删除
     */
    public function  delectAction(){
		$now_page = ChkClng(KS_S('p',1));
	    $courseid = ChkClng(KS_G('get.id'));
		$course = $this->AppModel->getRow('where courseid = '.$courseid.' and wxid='.$this->wxid.' limit 1');
		$ChapterModel   = new CourseModel($course["chaptertable"]);
		$Data['status'] = -1;
		$this->AppModel->update($Data,'courseid='.$courseid.' and wxid='.$this->wxid);
		$ChapterModel->update($Data,'courseid='.$courseid.' and wxid='.$this->wxid);
		$defaultpic = $this->AppModel->getOne('defaultpic','where courseid = '.$courseid.' and wxid='.$this->wxid.' limit 1');
		$this->upload->removefile($defaultpic);//删除上传图片
		$this->cache->PutHCache('courseinfo',$this->wxid);//将课程插入缓存
        //删除课程绑定的教师
        M('app_course_teacherrelate')->delete('courseid = '.$courseid.' and wxid = '.$this->wxid.'');

		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		ks_header($url);// KS_INFO('删除成功',0,$url);
    }
    //课程批量
	public function batchAction(){
        $now_page = ChkClng(KS_S('p',1));
		$courseid = ChkClng(KS_G('get.id'));
		$course   = $this->AppModel->getRow('where courseid = '.$courseid.' and wxid='.$this->wxid .' limit 1');
		$ChapterModel = new CourseModel($course["chaptertable"]);
		$courseid = isset($_POST["check"]) ? $_POST["check"]:'';
		$url1 = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		//批量删除
		if(empty($courseid)){KS_INFO("请选择",0,'','',1);}
		if(KS_G('post.batch')==1){
			$Data['status'] = -1;
			foreach ($courseid as $v ){
		        $this->AppModel->update($Data,'courseid='.ChkClng($v).' and wxid='.$this->wxid);
		     	//$ChapterModel->delete("courseid=$v");

		    }
			$this->cache->PutHCache('courseinfo',$this->wxid);//将课程插入缓存
			KS_INFO('删除成功',0,$url1);
		}
		//批量上架
		if(KS_G('post.batch')==2){
			$data['status']=2;foreach ($courseid as $v ){
                if ($v>0){
                    $this->AppModel->update($data, "courseid=".ChkClng($v)." and wxid=".$this->wxid);
                }
            }
			$this->cache->PutHCache('courseinfo',$this->wxid);//将课程插入缓存
			KS_INFO('审核成功',0,$url1);
		}
		//批量下架
		if(KS_G('post.batch')==3){
			$data['status']=0;foreach ($courseid as $v ) {
                if ($v>0){
                    $this->AppModel->update($data, "courseid=".ChkClng($v)." and wxid=".$this->wxid);
                }
            }
			$this->cache->PutHCache('courseinfo',$this->wxid);//将课程插入缓存
			KS_INFO('取审成功',0,$url1);
		}
	}
	//进入添加编辑详细信息
	public function  infoAction(){
		$courseid = ChkClng(KS_G('get.id'));
		$course=$this->AppModel->getRow("where courseid = $courseid limit 1");
		$teacherModel = new CourseModel('common_user_teacher');
		$teacherRelaetModel = new CourseModel('app_course_teacherrelate');
		$speaker = $teacherModel -> getAll("as a left join $teacherRelaetModel->table as b on a.userid=b.teacherid where b.courseid = $courseid");
	    include  CURR_VIEW_PATH . "courseinfo.php";
    }
	//添加讲师
	public function addDocentAction(){
		$UserModel = new CourseModel('common_user');
		$courseid = ChkClng(KS_G('get.id'));
		//读出用户分类缓存
		//$userscategory = $this->cache->GetACache('userscategory');
		//分页查询数据
		$teacherModel = new CourseModel('common_user_teacher');
		$model = M('app_course_teacherrelate');
		$list = $model->getAll("where wxid= $this->wxid and courseid = $courseid");
		$type=KS_S('type',1);
		$keyword = KS_S('keyword');
		$where   = '';
		$where  .= "as a left join $teacherModel->table as b on a.userid = b.userid where a.wxid=$this->wxid  and usertype=1 and b.isshow=1 and a.userid not in (select teacherid from ks_app_course_teacherrelate where wxid= $this->wxid and courseid = $courseid)";
		if(!empty($keyword)){$where.="  and b.name like '%$keyword%'";}
		$options = $UserModel -> getOptions('13',$where);//分页参数设置
		$page = Page($options);
		$teachers = $UserModel -> getPage($page,'a.userid desc',$where);

		include  CURR_VIEW_PATH . "addDocent.php";
	 }
	 //添加详细信息
	 public function  doaddinfoAction(){
		$courseid          = ChkClng(KS_G('get.id'));
		$Data['recommend'] = ChkClng(KS_G('post.recommend'));
		$Data['slide']     = ChkClng(KS_G('post.slide'));
		$Data['content']   = Src(ChkSQL(KS_G("post.content")));
		$Data['announce']  = Src(ChkSQL(KS_G("post.announce")));
		/*Chkpost($Data,$Rule,$this->AppModel);*/
		$this->AppModel->update($Data,"courseid=$courseid");
		$this->cache->PutHCache('courseinfo',$this->wxid);//将课程插入缓存
		$typea    = ChkClng(KS_G('post.typea'));
		if($typea == 1){
			 $url = M_URL($this->AppName.'/Index','index',$courseid,GP(''));
		}else{
			$url = M_URL($this->AppName.'/Index','seo',$courseid,GP(''));
		}
	    KS_INFO("保存成功",0,$url);
    }
	//进入添加编辑seo信息
	public function  seoAction(){
		 $courseid    = ChkClng(KS_G('get.id'));
		 $course      = $this->AppModel->getRow("where courseid = $courseid limit 1");
		 include  CURR_VIEW_PATH . "knowledge.php";exit;
		 include  CURR_VIEW_PATH . "courseseo.php";
    }
	//进行编辑seo信息
	public function doaddseoAction(){
		$courseid                = ChkClng(KS_G('get.id'));
		$Data['seokeywords']     = ChkSQL(KS_G("post.seokeywords"));
		$Data['seodescription']  = ChkSQL(KS_G("post.seodescription"));
		$this->AppModel->update($Data,"courseid=$courseid");
		$typea    = ChkClng(KS_G('post.typea'));
		if($typea == 1){
			 $url = M_URL($this->AppName.'/Index','index',$courseid,GP(''));
		}else{
			$url = M_URL($this->AppName.'/Index','period',$courseid,GP(''));
		}
	    KS_INFO("保存成功",0,$url);
	}
	/*
	 * 面授课时页面
	 */
	public function faceKeShiList()
	{
		include  CURR_VIEW_PATH . "period.php";
	}
	//进入课时页面
	public function periodAction(){
		$courseid = ChkClng(KS_G('get.id'));
		$course   = $this->AppModel->getRow("where courseid = $courseid limit 1");

		$ChapterModel = new CourseModel($course["chaptertable"]);
		$where   = "where  courseid = $courseid and parentid=0";
		$options = $ChapterModel->getOptions('100',$where);//分页参数设置
		$page    = Page($options);
		if($course['chapterTemplate']==1){
			$chapter = $ChapterModel->getPage($page,'chapterid asc',$where);
			foreach($chapter as $k=>$v){
				if($v["child"]>0){
			   	     $chapter[$k]['Section'] = $ChapterModel->getAll("where courseid = $courseid and parentid=$v[chapterid] order by orderid ");
				     foreach($chapter[$k]['Section'] as $kt=>$vt){
					      $keshi = $ChapterModel->getAll("where  courseid = $courseid and parentid=$vt[chapterid] order by orderid ");
					      $chapter[$k]['Section'][$kt]['keshi'] =keshiInfo($keshi);
				     }
			    }
	        }
        }elseif($course['chapterTemplate']==2){
			$chapter = $ChapterModel->getPage($page,'chapterid asc',$where);
			foreach($chapter as $k=>$v){
				if($v["child"]>0){
			   	     $keshi = $ChapterModel->getAll("where courseid = $courseid and parentid=$v[chapterid] order by orderid ");
			   	      $chapter[$k]['keshi']=keshiInfo($keshi);
			    }
	        }
		}elseif($course['chapterTemplate']==3||$course['chapterTemplate']==4){
			$chapter = $ChapterModel->getPage($page,'chapterid asc',$where);
			$chapter=keshiInfo($chapter);
		}
		include  CURR_VIEW_PATH . "knowledge.php";exit;
        include  CURR_VIEW_PATH . "period.php";
    }
    //课时模板
    public function chapterTemplateAction(){
    	$courseid = ChkClng(KS_G('get.id'));
		$course=$this->AppModel->getRow("where courseid = $courseid limit 1");
		include  CURR_VIEW_PATH . "chapterTemplate.php";
    }
    //删除课时模板
    public function changeChapterAction(){
    	$courseid = ChkClng(KS_G('get.id'));
		$Data['chapterTemplate'] = 0;
		$this->chapterModel->delete('courseid='.$courseid);
		$this->AppModel->update($Data,'courseid='.$courseid);
    	$url=M_URL($this->AppName.'/Index','period',$courseid,GP(''));
		KS_INFO('修改成功',3,$url);
    }
    public function dochapterTemplateAction(){
    	$courseid = ChkClng(KS_G('get.id'));
		$Data['chapterTemplate'] = ChkClng(KS_G('post.chapterTemplate'));
		$this->AppModel->update($Data,'courseid='.$courseid);
    	$url=M_URL($this->AppName.'/Index','period',$courseid,GP(''));
		KS_INFO('保存成功',3,$url);
    }
	//进入增加章
	public function addchapterAction(){
		$courseid     = ChkClng(KS_G("get.id"));
		$chaptertable = $this->AppModel->getOne('chaptertable',"where courseid=$courseid");
		$ChapterModel = new CourseModel($chaptertable);
		$chapterid=null !==GF('chapterid') ? GF('chapterid'):'0';
		$chapter=$ChapterModel->getRow("where chapterid=$chapterid limit 1");
		include  CURR_VIEW_PATH . "addchapter.php";
    }
	//增加章
	public function doaddchapterAction(){
		  $courseid = ChkClng(KS_G("get.id"));
		  $chaptertable = $this->AppModel->getOne('chaptertable',"where courseid=$courseid");
		  $ChapterModel = new CourseModel($chaptertable);
		  $Data['userid'] = $this->userid;
		  $Data['wxid'] = $this->wxid;
		  $Data['courseid'] = ChkClng(KS_G('get.id'));
		  $Data['parentid'] = 0;
		  $Data['chaptertype'] = 0;
		  $Data['title'] = ChkSQL(KS_G("post.title"));
		  $Data['Price'] = ChkSQL(KS_G("post.price"));
		  $Rule['title'] = '章节名字|isEmpty';
		  Chkpost($Data,$Rule,$ChapterModel);
		  $ChapterModel->doaddChapter($Data,'chapterid');
		  $url=M_URL($this->AppName.'/Index','period',$courseid,GP(''));
		  KS_INFO('添加成功',3,$url);
	  }
	  //编辑章
	  public function doeditchapterAction(){
          $courseid      = ChkClng(KS_G("get.id"));
		  $chaptertable  = $this->AppModel->getOne('chaptertable',"where courseid=$courseid limit 1");
		  $ChapterModel  = new CourseModel($chaptertable);
		  $chapterid=null !==GF('chapterid') ? GF('chapterid'):'0';
		  $Data['title'] = ChkSQL(KS_G("post.title"));
		  $Rule['title'] = '章节名字|isEmpty';
		  Chkpost($Data,$Rule,$ChapterModel);
		  $ChapterModel->update($Data,"chapterid=$chapterid");
		  $url = M_URL($this->AppName.'/Index','period',$courseid,GP(''));
		  KS_INFO('',3,$url);
	  }
	  //进入增加节
	  public function addsectionAction(){
          $courseid     = ChkClng(KS_G("get.id"));
		  $chaptertable = $this->AppModel->getOne('chaptertable',"where courseid=$courseid");
		  $ChapterModel = new CourseModel($chaptertable);
		  $chapterid    = null !==GF('chapterid') ? GF('chapterid'):'0';
		  $chapterAll   = $ChapterModel->getAll("where courseid = $courseid and depth=1 order by root,orderid ");
		  if(!$chapterAll){KS_INFO('请先添加章');}
		  include  CURR_VIEW_PATH . "addSection.php";
	  }
	  //增加节
	  public function doaddsectionAction(){
          $courseid         = ChkClng(KS_G("get.id"));
		  $chaptertable     = $this->AppModel->getOne('chaptertable',"where courseid=$courseid");
		  $ChapterModel     = new CourseModel($chaptertable);
		  $Data['userid']   = $this->userid;
		  $Data['wxid']   = $this->wxid;
		  $Data['courseid'] = ChkClng(KS_G('get.id'));
		  $Data['chaptertype']=0;
		  $Data['parentid'] = ChkClng(KS_G('post.parentid'));
		  $Data['title']    = ChkSQL(KS_G("post.title"));
		  $Rule['title']    = '章节名字|isEmpty,isDbexis';
		  Chkpost($Data,$Rule,$ChapterModel,'parentid='.$Data['parentid']);
		  $ChapterModel->doaddSection($Data,'chapterid');
		  $url = M_URL($this->AppName.'/Index','period',$courseid,GP(''));
		  KS_INFO('添加成功',3,$url);
      }
	//进入编辑节
	public function editsectionAction(){
          $courseid     = ChkClng(KS_G("get.id"));
		  $chaptertable = $this->AppModel->getOne('chaptertable',"where courseid=$courseid");
		  $ChapterModel = new CourseModel($chaptertable);
		  $chapterid    = ChkClng(KS_S('chapterid'));
		  $ChapterModel = new CourseModel($chaptertable);//实例化云服务表
		  $chapter =$ChapterModel->getRow(' where chapterid='.$chapterid);
		  $chapterAll   = $ChapterModel->getAll("where  courseid = $courseid and depth=1 order by root,orderid ");
		  include  CURR_VIEW_PATH . "addSection.php";
	}
	/**
     * 进入增加课时
	 */
	public function addkeshiAction(){
	 	$setting   = getSet($this->wxid,$this->appid);//获取网站配置
        $now_page  = ChkClng(KS_S('p',1));
		$chapterid = ChkClng(KS_S('chapterid'));
		$typeKeshi = 'add';
		$type      = $this->course['courseType'];
	    $ChapterModel = new CourseModel($this->course['chaptertable']);
		if( $this->course['chapterTemplate']==2){
		 	 $chapterAll = $ChapterModel->getAll('where  courseid = '.$this->courseid.' and depth=1 order by root,orderid ');
		 	 if(!$chapterAll){
		 	 	$url = M_URL($this->AppName.'/Index','period',$this->courseid,GP(''));
		          KS_INFO('请先添加章',0,$url);
		 	 }
		}
		if($this->course['chapterTemplate']==1){
		  	$chapterAll = $ChapterModel->getAll('where  courseid = '.$this->courseid.' and (depth=1 or depth=2) order by root,orderid ');
		 	 if(!$chapterAll){
		 	 	$url = M_URL($this->AppName.'/Index','period',$this->courseid,GP(''));
		        KS_INFO('请先添加节',0,$url);
		 	 }
		}
		$parentid       = $chapterid;
		
		//var_dump($chapterAll);var_dump($this->course['chapterTemplate']);exit;
		$interfaceModel = M('common_managevdo');
		$interfaceid    = $interfaceModel->getOne('id','where type = 1 and isdefault = 1 limit 1' );
		if($interfaceid == 7){
			 $baidu  = new Core\Baiduyun();
		     $result = $baidu->curl_upload();
			 $result = json_decode($result);
		}
		include  CURR_VIEW_PATH . "addkeshi.php";
	}
	//进入地图
	public function addressAction(){
	  	include  CURR_VIEW_PATH . "address.php";
	}
	/**
     * 进入修改课时
	 */
	public function editkeshiAction(){
        $typeKeshi = 'edit';
		$now_page  = ChkClng(KS_S('p',1));
		$setting = getSet($this->wxid,$this->appid);//获取网站配置
		$chapterid = ChkClng(KS_S('chapterid'));
		$courseid  = ChkClng(KS_G("get.id"));
	    $course    = $this->AppModel->getRow('where courseid='.$courseid.' limit 1');
	    $type      = $course['courseType'];
	    $ChapterModel = new CourseModel($course['chaptertable']);
		$chapterAll   = $ChapterModel->getAll('where  courseid = '.$courseid.' and (depth=1 or depth=2) order by root,orderid ');
		$chapter      = $chapter=$ChapterModel->getRow('where chapterid='.$chapterid.' limit 1');
		$chapter['json'] = json_decode($chapter['json'],true);
        $vdoModel = M('app_vod_list');
		$where    = "where  vdoId = '$chapter[videoId]' ";
		$vdo      = $vdoModel->getRow($where);
		$parentid     = $chapter['parentid'];
		$cache  = new \Core\Cache();
		$uploadtableid = $cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		$extends_table = M('common_extends_table');
		$tablename = $extends_table->getOne('tablename','where tableid='.$uploadtableid);
		$fileModel = M($tablename);
		$courseFile =M('app_course_file');
		$files = $courseFile->getAll(" as a left join $fileModel->table as b on a.fileid=b.id where a.courseid =$courseid and a.chapterid = $chapterid",'b.type,b.filename,b.filePath,b.id as fileid,a.id');

		foreach($files as $k=>$v){
			$fileName = explode('.',$v['filename']);
			$ext = isset($fileName[1]) ? $fileName[1] : '0';
			if($ext == 'txt'){
				$files[$k]['src']='/Public/uploads/common/TXT.png';
			}elseif($ext == 'mp4'){
				$files[$k]['src']='/Public/uploads/common/MOV.png';
			}elseif($ext == 'mp3'){
				$files[$k]['src']='/Public/uploads/common/MP3.png';
			}elseif($ext == 'doc' || $ext == 'docx' ){
				$files[$k]['src']='/Public/uploads/common/DOC.png';
			}elseif( $ext == 'pdf' ){
				$files[$k]['src']='/Public/uploads/common/PDF.png';
			}elseif($ext == 'PPT' || $ext == 'pptx'){
				$files[$k]['src']='/Public/uploads/common/PPT.png';
			}else{
				$files[$k]['src']=$v['filePath'];
			}
			$type2 = array('txt','doc','docx','pdf','ppt');
			if(in_array($ext,$type2)){//存入文档
				$Data['type'] = 4;
			}
			$type3 = array('mp3');
			if(in_array($ext,$type3)){//存入音频
				$Data['type'] = 3;
			}
			$type3 = array('mp4');
			if(in_array($ext,$type3)){//存入视频
				$Data['type'] = 2;
			}
				$type3 = array('ppt');
			if(in_array($ext,$type3)){//存入PPT
				$Data['type'] = 4;
			}
		}
		$interfaceModel = M('common_managevdo');
		$interfaceid  = $interfaceModel->getOne('id','where type = 1 and isdefault = 1 limit 1' );
		if($interfaceid == 7){
			 $baidu  = new Core\Baiduyun();
		     $result = $baidu->curl_upload();
			 $result = json_decode($result);
		}
		 include  CURR_VIEW_PATH . "addkeshi.php";
	}
	/**
     * 保存增加课时
	 */
	public function doaddkeshiAction(){
        $title=ChkSQL(KS_G("post.title"));
        if (mb_strlen($title)>50){
            KS_Alert('课时名称长度不合法， 请控制在50个字符内!','error');
        }
	    $ChapterModel        = new CourseModel($this->course['chaptertable']);
		$Data['wxid']        = $this->wxid;
		$Data['courseid']    = $this->courseid;
		$Data['chaptertype'] = $this->courseType;
		$Data['parentid']    = ChkClng(KS_G('post.parentid'));
		$Data['title']       = $title;
		$Data['intro']       = EncodeSQL(KS_G("post.intro"));
		$Data['content']     = EncodeSQL(KS_G("post.content"));
		$Data['chargetype']  = ChkSQL(KS_G("post.chargetype"));
		$Data['serverid']    = ChkClng(KS_G('post.serverid'));
		$Data['freeplay']    = ChkClng(KS_G('post.freeplay'));
		if(ChkSQL(KS_G("post.fileurl"))){
            $Data['videoId']=ChkSQL(KS_S("post.fileurl"));
        }
		$json_data['is_audition']  =  ChkClng(KS_G("post.is_audition"));
		$json_data['audition_time']  =  ChkClng(KS_G("post.audition_time"));
		$Data['json'] = json_encode($json_data,JSON_UNESCAPED_UNICODE);
		if($Data['chaptertype']==1){//章节类型 1点播
		  	if(ChkClng(KS_G("post.freeplay"))){$Data['freeplay'] = ChkClng(KS_G("post.freeplay"));}
		    $Data['validedays'] = ChkClng(KS_G("post.validedays"));
		    $Data['playtype']   = ChkClng(KS_G("post.playtype"));
			$Data['playtime']   = ChkSQL(KS_G("post.playtime1"));
			if(ChkSQL(KS_G("post.fileurl"))){
                $Data['videoId']=ChkSQL(KS_S("post.fileurl"));
                $VodModel=M('app_vod_list');
                $playtime = $VodModel->getRow('where vdoId = '.$Data['videoId'].'','playtime');
                $Data['playtime'] = $playtime['playtime'];
            }
			$Data['begindate']  = time();
		}elseif($Data['chaptertype']==2){//章节类型 2直播
			if(empty(KS_G("post.begindate"))){KS_INFO('开始时间不能为空');}
			$Data['begindate']   = strtotime(ChkSQL(KS_G("post.begindate")));
			$Data['livehours']   = ChkSQL(KS_G("post.livehours"));
			$Data['enddate']     = $Data['begindate']+$Data['livehours']*3600;
			$Data['livetype']    = ChkClng(KS_G("post.livetype"));
			if($Data['begindate']<time()){KS_INFO('该直播已过期',6);}
			if($Data['begindate']>$Data['enddate']){KS_INFO('开始时间不能大于结束时间',6);}
			$chapters =$ChapterModel->getAll(' where courseid='.$this->courseid.' and depth =3 and chaptertype=2','begindate,enddate');
			foreach($chapters as $kt=>$vt){
			 	if($Data['begindate']>=$vt['begindate'] && $Data['begindate']<=$vt['enddate']){KS_INFO('该时间段，在该课程已经有直播了',6);}
			 	if($Data['enddate']>=$vt['begindate'] && $Data['enddate']<=$vt['enddate']){KS_INFO('该时间段，在该课程已经有直播了',6);}
			}
			$Rule['begindate'] = '开始时间|isEmpty';
		    $Rule['enddate'] = '结束时间|isEmpty';
		}elseif($Data['chaptertype']==3){//章节类型 3.音频
		  	 $Data['begindate']  = timeUnix(ChkSQL(KS_G("post.begindate3")));
		  	 $Data['address']   =  ChkSQL(KS_G("post.address"));
		}elseif ($Data['chaptertype']==5){
			$Data['begindate']  = strtotime(ChkSQL(KS_G("post.begindate3")));
			if (empty($Data['begindate'])){
                KS_INFO('请添加开课时间',6);
            }
		}


	    $Rule['title'] = '章节名字|isEmpty';
		Chkpost($Data,$Rule,$ChapterModel);
		$chapterid = $ChapterModel->doaddkeshi($Data,'chapterid');
		//插入章节表
		if($Data['chaptertype']==2){//章节类型2直播
		   	    $chapter1 =$ChapterModel->getRow('where chapterid='.$chapterid.' limit 1');
			   	$chapterTimeModel=M('app_chaptertime');
			   	$Datas['courseid']=$this->courseid;
			   	$Datas['chapterid']=$chapterid;
			   	$Datas['starttime']=$Data['begindate'];
			   	$Datas['endtime']=$Data['enddate'];
			   	$Datas['parentidpath']=$chapter1['parentidpath'];
			   	$Datas['wxid']        =$this->wxid;
			   	$chapterTimeModel->doAdd($Datas,'id');
		}
		$coursefile = ChkSQL(KS_G('post.coursefile'));
        if($coursefile){
          	    $courseFileModel= M('app_course_file');
          		$Dat['wxid']=$this->wxid;
          		$Dat['courseid']=$this->courseid;
          		$Dat['chapterid']=$chapterid;
          		$Dat['adddate']=time();
                foreach($coursefile as $k=>$v){
                    $Dat['fileid']=$v;
                    $courseFileModel->doAdd($Dat,'id');
                }
        }
		//插入直播频道表
	    if($Data['chaptertype'] == 2){//章节类型2直播
		  	   $liveModel=M('app_live_list');
		  	   $live= $liveModel->getRow('where wxid='.$this->wxid.' and courseid='.$this->courseid.'  limit 1');
		  	   if($live){
		  	       $Data1['channlName']=$live['channlName'];
		  	       $Data1['password']=$live['password'];
		  	   }else{
		  	   	   $maxid = $liveModel->getMaxValue('id')+1;
		  	       $Data1['channlName']=str_pad($maxid,6,"0",STR_PAD_LEFT);
		  	   }
		  	   $Data1['courseid']=$this->courseid;
		  	   $Data1['chapterid']=$chapterid;
		  	   $Data1['password']=rand(10000,99999);
		  	   $Data1['adddate']=time();
		  	   $Data1['teacherid'] = $this->course['teacherid'];
		  	   $Data1['classlevel'] = 0;
		  	   $Data1['status'] = 1;
		  	   $Data1['wxid'] = $this->wxid;
		  	   $Data1['type'] = 1;
		  	   //学生观看记录表
		  	   $chaptertableModel    = new CourseModel('common_extends_table');
		       $Data1['studentTable'] = $chaptertableModel->getOne('tablename','where Isdefault=1 and type =3');
		  	   $liveModel->doAdd($Data1,'id');
		  }

		  $url2 = M_URL($this->AppName.'/Index','period',$this->courseid,GP(''));
		  if($this->course['courseType']==4){
		  	   KS_INFO('增加成功',0,$url2);
		  }else{
		  	   KS_INFO('增加成功',3,$url2);
		  }
    }



	//进入直播间
	public function share2Action(){
		 $liveModel=M('app_live_list');
         $courseid=ChkClng(KS_G("get.id"));
         $courseModel =M('app_course');
         $coursetable =$courseModel->getOne('chaptertable',' where courseid='.$courseid);
         $chapterModel=M($coursetable);
         $chapters=$chapterModel->getAll(' where courseid='.$courseid.' and depth=3 and chaptertype=2');
         $chapterid =chapterFirst($chapters);
         $values=array();
	     $live= $liveModel->getRow('where wxid='.$this->wxid.' and courseid='.$courseid.' and chapterid ='.$chapterid.' and status !=-1 limit 1');
	     $Assistant='';//助教
		 $teachetCourse = M('app_course_teacherrelate');
		 $teacherid = $teachetCourse->getAll('where wxid='.$this->wxid.' and courseid='.$courseid.' order by isspeaker desc','teacherid,isspeaker');
		 if($teacherid){
			   $teacherModel =M('common_user_teacher');
			   $user =M('common_user');
			   foreach($teacherid as $k=>$v){
			   		 $teacher =$teacherModel->getRow(" as a left join  $user->table as b on a.userid = b.userid where a.userid =$v[teacherid] ",'a.name,b.username,b.userid,b.secretKey');
		   			   if(empty($teacher['name'])){
				   			$name = $teacher['username'];
						}else{
				    		 $name = $teacher['name'];
						}
					 if($v['isspeaker']==1){
						 $speakerName =  $name;
					 }
					 $values[$k]=$teacher;
			   }
		}
		include  CURR_VIEW_PATH . "share2.php";
	}
	//开始直播
    public function startliveAction(){
        $liveModel=M('app_live_list');
        $courseid=ChkClng(KS_G("get.id"));
        $courseModel =M('app_course');
        $coursetable =$courseModel->getOne('chaptertable',' where courseid='.$courseid);
        $chapterModel=M($coursetable);
        $chapters=$chapterModel->getAll(' where courseid='.$courseid.' and depth=3 and chaptertype=2');
        $chapterid =chapterFirst($chapters);
        $values=array();
	    $live= $liveModel->getRow('where wxid='.$this->wxid.' and courseid='.$courseid.' and chapterid ='.$chapterid.' and status !=-1 limit 1');
	    $Assistant='';//助教
		$teachetCourse = M('app_course_teacherrelate');
		$teacherid = $teachetCourse->getAll('where wxid='.$this->wxid.' and courseid='.$courseid.' order by isspeaker desc','teacherid,isspeaker');
		if($teacherid){
		    $teacherModel = M('common_user_teacher');
		    $user         = M('common_user');
		    foreach($teacherid as $k=>$v){
				$teacher =$teacherModel->getRow(" as a left join  $user->table as b on a.userid = b.userid where a.userid =$v[teacherid] ",'a.name,b.username,b.userid,b.secretKey');
	   	        if(empty($teacher['name'])){
			   	     $name = $teacher['username'];
			    }else{
			    	 $name = $teacher['name'];
			    }
		        if($v['isspeaker']==1){$speakerName =  $name;}
			    $values[$k]=$teacher;
		    }
		}
		include  CURR_VIEW_PATH . "startlive.php";
    }
	/****************************************************************面授/活动 签到 王海松 2019/05/28 begin ***************************************************/
	/*
	 * 签到记录列表
	 */
	public function signListAction()
	{
		$courseid = ChkClng(KS_S("id",0));
		$chapterid = ChkClng(KS_S("chapterid",0));
		$courseType = ChkClng(KS_S("courseType",0));
		$keytype = ChkClng(KS_S("keytype",1));
		$status = ChkClng(KS_S("status",0));
		$keyword = ChkSQL(KS_S("keyword"));
		$where = "where courseid=$courseid and wxid=$this->wxid";
		if (!empty($chapterid)){
			$where .= " and chapterid=$chapterid";
		}
		if ($keytype==1){
			if (!empty($keyword)){
				$where .= " and username like '%$keyword%'";
			}
		}
		if ($status==1){
			$where .= " and status=0";
		}elseif ($status==2){
			$where .= " and status=1";
		}elseif ($status==3){
			$where .= " and status=-1";
		}
		if($courseType==5){
            $where .= " and is_sign=1";
        }
//		var_dump($where);die;
		$app_course_sign = M('app_course_sign');
		$options   = $app_course_sign->getOptions('10',$where);
		$page      = Page($options);
		$values  = $app_course_sign->getPage($page,'adddate desc',$where,'');
		if ($courseType==5){//面授
			$chaptertable = $this->AppModel->getOne('chaptertable','where courseid='.$courseid.' limit 1');
			$ChapterModel = M($chaptertable);
			$chapterList = $ChapterModel->getAll("where courseid=$courseid and chaptertype=5",'chapterid,title');
			foreach ($values as $k=>$v){
				$values[$k]['title'] = $ChapterModel->getOne('title',"where chapterid=$v[chapterid]");
			}
			$app_course = M('app_course');
			$course_data = $app_course->getRow('where courseid ='.$courseid.' ','title,coursehour');
		}elseif ($courseType==6){//活动
			$all_count = $app_course_sign->getOne('count(id)',"where courseid=$courseid and status=1");
			$sign_count = $app_course_sign->getOne('count(id)',"where courseid=$courseid and status=1 and is_sign=1");
			$nosign_count = $all_count-$sign_count;
		}elseif ($courseType==2&&($this->livetype==3||$this->livetype=4)){//直播
			foreach ($values as $k=>$v){
				$values[$k]['json'] = json_decode($v['json'],true);
				$values[$k]['title'] = $this->AppModel->getOne('title','where courseid='.$courseid.' limit 1');
			}
		}

		include  CURR_VIEW_PATH . "sign_list.php";
	}
	/*
	 * 审核
	 */
	public function batchSignAction()
	{
		$id = KS_S("id");
		$batch = KS_S('batch');
		if (empty($id)) KS_INFO('请选择',0,'','',3);
		$app_course_sign = M('app_course_sign');
		$url = KS_ComeUrl();
		if ($batch==1){//删除
			if (is_array($id)){
				foreach ($id as $k=>$v){
                    if($v>0){
                        $app_course_sign->delete("id=$v and wxid=$this->wxid");
                    }
				}
			}else{
				$app_course_sign->delete("id=".ChkClng($id)." and wxid=$this->wxid");
			}
			KS_INFO('删除成功',0,$url);
		}else{
			if ($batch==2){//审核通过
				$data['status'] = 1;
			}elseif ($batch==3){//取消审核
				$data['status'] = 0;
			}elseif ($batch==4){//拒绝
				$data['status'] = -1;
			}
			if (is_array($id)){
				foreach ($id as $k => $v) {
                    if($v>0){
                        $app_course_sign->update($data, "id=$v and wxid=$this->wxid");
                    }
				}
			}else{
				$app_course_sign->update($data, "id=".ChkClng($id)." and wxid=$this->wxid");
			}
			KS_INFO('操作成功',0,$url);
		}



	}
	/****************************************************************面授/活动 签到 王海松 2019/05/28 end ***************************************************/

	/**
     * 保存修改课时
	 */
	public function doeditkeshiAction(){
        $now_page     = ChkClng(KS_S('p',1));
		$chapterid    = ChkClng(KS_S('chapterid'));
        $courseid     = ChkClng(KS_G("get.id"));
        $title=ChkSQL(KS_G("post.title"));
        if (mb_strlen($title)>50){
            KS_Alert('课时名称长度不合法， 请控制在50个字符内!','error');
        }
	    $chaptertable = $this->AppModel->getOne('chaptertable','where courseid='.$courseid.' limit 1');
	    $ChapterModel = new CourseModel($chaptertable);
	    $chargetype= $ChapterModel->getOne('chaptertype',' where chapterid ='.$chapterid);
	    $Data['title']       = $title;
		$Data['intro']       = EncodeSQL(KS_G("post.intro"));
		$Data['content']     = EncodeSQL(KS_G("post.content"));
		$Data['freeplay']    = ChkClng(KS_G('post.freeplay'));
		if(ChkSQL(KS_G("post.fileurl"))){
            $Data['videoId'] = ChkSQL(KS_S("post.fileurl"));
        }
		$json_data['is_audition']  =  ChkClng(KS_G("post.is_audition"));
		$json_data['audition_time']  =  ChkClng(KS_G("post.audition_time"));
		$Data['json'] = json_encode($json_data,JSON_UNESCAPED_UNICODE);
		if($chargetype == 1){
		    if(ChkClng(KS_G("post.freeplay"))){
		  		$Data['freeplay'] = ChkClng(KS_G("post.freeplay"));
		  	}
			$Data['playtime']   = ChkSQL(KS_G("post.playtime1"));
			if(ChkSQL(KS_G("post.fileurl"))){
                $Data['videoId'] = ChkSQL(KS_S("post.fileurl"));
                $VodModel=M('app_vod_list');
                $playtime = $VodModel->getRow('where vdoId = '.$Data['videoId'].'','playtime');
                $Data['playtime'] = $playtime['playtime'];
            }
		}elseif($chargetype == 2){
			if(empty(KS_G("post.begindate"))){KS_INFO('开始时间不能为空');}
			$Data['begindate']   = strtotime(ChkSQL(KS_G("post.begindate")));
			$Data['livehours']   = ChkSQL(KS_G("post.livehours"));
			$Data['enddate']     = $Data['begindate']+$Data['livehours']*3600;
			$Data['livetype']    = ChkClng(KS_G("post.livetype"));
			if($Data['begindate']>$Data['enddate']){
			 	KS_INFO('开始时间不能大于结束时间',6,'','',1);
			}
			$chapters =$ChapterModel->getAll(' where courseid='.$courseid.' and depth =3 and chaptertype=2 and chapterid !='.$chapterid,'begindate,enddate');
			foreach($chapters as $kt=>$vt){
			 	if($Data['begindate']>=$vt['begindate'] && $Data['begindate']<=$vt['enddate']){
			 		 KS_INFO('该时间段，在该课程已经有直播了',6,'','',1);
			 	}
			 	if($Data['enddate']>=$vt['begindate'] && $Data['enddate']<=$vt['enddate']){
			 		 KS_INFO('该时间段，在该课程已经有直播了',6,'','',1);
			 	}
			}
			$Rule['begindate'] = '开始时间|isEmpty';
		    $Rule['enddate']   = '结束时间|isEmpty';
	   }elseif($chargetype==3){
	    	 if(ChkSQL(KS_G("post.fileurl"))){
                 $Data['videoId'] = ChkSQL(KS_S("post.fileurl"));
             }
		  	 $Data['begindate']  = timeUnix(ChkSQL(KS_G("post.begindate3")));
		  	 $Data['address']   =  ChkSQL(KS_G("post.address"));
		}elseif($chargetype==5){
			$Data['begindate']  = strtotime(ChkSQL(KS_G("post.begindate3")));
		}
		$Rule['title']         = '章节名字|isEmpty';
		Chkpost($Data,$Rule,$ChapterModel);
		$ChapterModel->update($Data,"chapterid=$chapterid");
		//插入章节时间表
		if($chargetype==2){
	   	    $chapter1 =$ChapterModel->getRow('where chapterid='.$chapterid.' limit 1');
		   	$chapterTimeModel=M('app_chaptertime');
		   	$Datas['courseid']=$courseid;
		   	$Datas['chapterid']=$chapterid;
		   	$Datas['starttime']=$Data['begindate'];
		   	$Datas['endtime']=$Data['enddate'];
		   	$Datas['parentidpath'] =$chapter1['parentidpath'];
			$chapterTimeModel->update($Datas,'courseid='.$courseid.' and chapterid='.$chapterid);
		}
		$coursefile = ChkSQL(KS_G('post.coursefile'));
        if($coursefile){
      	    $courseFileModel= M('app_course_file');
      		$Data1['wxid']=$this->wxid;
      		$Data1['courseid']=$courseid;
      		$Data1['chapterid']=$chapterid;
      		$Data1['adddate']=time();
            foreach($coursefile as $k=>$v){
                $Data1['fileid']=$v;
                $courseFileModel->doAdd($Data1,'id');
            }
        }
		$url2 = M_URL($this->AppName.'/Index','period',$courseid,GP('p-'.$now_page));
		if($this->course['courseType']==4){
	  	       KS_INFO('编辑成功',0,$url2);
		}else{
		  	   KS_INFO('编辑成功',3,$url2);
		}
	}
	//进入课时知识点选择
	public function addKpointAction(){
		$courseid=ChkClng(KS_G("get.id"));
		setcookie("addKption".$courseid, "", time() - 3600);
		$course=$this->AppModel->getRow('where courseid='.$courseid.' limit 1');
		$kpointModel = new CourseModel('app_knowledge');
		$where = 'where wxid='.$course['wxid'];
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		if(!empty($keyword)){
			 $where.=" and title like '%$keyword%'";
		}
		if($course['kpoint']!=''){
		 	$where.=" and not id in($course[kpoint])";
		}
		$options = $kpointModel->getOptions('10',$where);
		$page    = Page($options);
		$values  = $kpointModel->getPage($page,'id desc',$where);
		include  CURR_VIEW_PATH . "addKpoint.php";
	}
	//查看推流地址
	public function liveaddressAction(){
		 $chapterid = null !==GF('chapterid') ? GF('chapterid'):'0';
	     $courseid  = ChkClng(KS_G("get.id"));
         $course    = $this->AppModel->getRow('where courseid='.$courseid.' limit 1');
	     $ChapterModel = new CourseModel($course['chaptertable']);
	     $chapter   = $chapter=$ChapterModel->getRow('where chapterid='.$chapterid.' limit 1');
		 $liveModel = M('app_live');
		 $domain    = $liveModel->getOne('domain','where userid='.$this->userid);
		 $baidu     = new Baidulive($domain);
	     $tlUrl     = $baidu->creatStream($this->userid,$chapter);
		 include  CURR_VIEW_PATH . "liveaddress.php";
	}
	//预览试听
	public function audioplayAction(){
		$chapterid    = null !==GF('chapterid') ? GF('chapterid'):'0';
	    $course       = $this->AppModel->getRow('where courseid='.$this->courseid.' limit 1');
	    $ChapterModel = new CourseModel($course['chaptertable']);
		$chapter      = $ChapterModel->getRow('where chapterid='.$chapterid.' limit 1');
		//var_dump(Img($chapter['videoId']));exit;
		include  CURR_VIEW_PATH . "audioplay.php";
	}
	//预览视频
	public function viewplayAction(){
		$videoId   = null !==GF('videoId') ? GF('videoId'):'0';
		if(!empty($videoId)){
		 	if(strstr($videoId,'mda-')==false){
		 		$chapter['serverid'] = 6;
		 		$chapter['videoId']  = $videoId;
		 	}else{
		 		$chapter['serverid'] = 7;
		 		$chapter['videoId']  = $videoId;
		 	}
		}else{
			$chapterid=null !==GF('chapterid') ? GF('chapterid'):'0';
			$courseid=ChkClng(KS_G("get.id"));
		    $course=$this->AppModel->getRow('where courseid='.$courseid.' limit 1');
		    $ChapterModel = new CourseModel($course['chaptertable']);
			$chapter=$ChapterModel->getRow('where chapterid='.$chapterid.' limit 1');
			if(strstr($chapter['videoId'],'mda-')==false){
				$chapter['serverid'] = 6;
			}else{
				$chapter['serverid'] = 7;
			}
		}
		if($chapter['serverid'] == 6){
		    if(empty($chapter['videoId'])){ KS_INFO('这门课还没上传视频，到其他课程看看',6);}
		    $ClassModel   = M('App/ClassModel');
	 	    $result       = $ClassModel  ->playVod($chapter['videoId']);

			$player = "var player = TCPlayer('player-container-id',{fileID:'".$result['play']['fileID']."',appID:'".$result['play']['appID']."',t:'".$result['play']['t']."',us:'".$result['play']['us']."',sign:'".$result['play']['sign']."',autoplay:true});";
		}elseif($chapter['serverid'] == 7){
		    if( empty($chapter['videoId']) ){
	              KS_INFO('这门课还没上传视频，到其他课程看看',7,'','',1);
		    }else{
				$vod = new \Core\Baiduyun();//百度视频
				try{
				  $vods = $vod->selectVod($chapter['videoId']);
				  $status=$vods->status;
				  switch($status){
					  case 'PROCESSING' : KS_INFO('视频转码中，到其他课程看看',6);break;
					  case 'FAILED' : KS_INFO('视频转码错误，到其他课程看看',6);break;
					  case 'DISABLED':  KS_INFO('视频被禁用，到其他课程看看',6);break;
					  case 'BANNED' :KS_INFO('视频被禁止，到其他课程看看',6);break;
				  }
				  $play =$vods->playableUrlList;
				  foreach($play as $k=>$v){
					 $playurl[$k]['url'] = $v->url;
					 $playurl[$k]['teblemname'] = $v->transcodingPresetName;
				  }
				  $uservod = M('app_vod');
				  $vod = $uservod->getRow('where wxid = '.$this->wxid);
				  if(!$vod){$vod = $uservod->getRow('where wxid = 2');}
				  $setting = explode('※',$vod['setting']);
				  $player = getplay($playurl,$setting);
			    }catch(Exception $e){
						  KS_INFO('视频出错联系管理员',6,'','',1);
				}
		    }
		}
		include  CURR_VIEW_PATH . "playvdo.php";
	}
	public function liveviewAction(){
		var_dump('功能尚未完善').die;
	}
	//章节删除
	public function delchapterAction(){
          $courseid      = ChkClng(KS_G("get.id"));
          $row=$this->AppModel->getRow("where courseid=$courseid",'chaptertable,courseType');
          if ($row){
              $chaptertable  = $row['chaptertable'];
              $ChapterModel  = new CourseModel($chaptertable);
              $courseFileModel= M('app_course_file');
              $partentidpath = null !==GF('chapterid') ? GF('chapterid'):'0';

              $chapters = $ChapterModel->getAll("where chapterid in($partentidpath)",'courseid,chapterid,depth,chaptertype');
              foreach($chapters as $k=>$v){
                  if($v['depth']==3){
                      $courseFileModel->delete(' courseid ='.$courseid.' and chapterid ='.$v['chapterid']);
                  }
              }


              //删除时间关联表
              $chaptertimeModel=new CourseModel('app_chaptertime');
              $chaptertimeModel->delchapter($partentidpath);
              $ChapterModel->delchapter($partentidpath);

              if ($row['courseType']==5 || $row['courseType']==6){
                  $app_course_sign=M('app_course_sign');
                  $app_course_sign->delete("chapterid=$partentidpath and wxid=$this->wxid");
              }
          }
		  $url2 = M_URL($this->AppName.'/Index','period',$courseid,GP(''));
		  KS_INFO('删除成功',0,$url2);
	}
	//进入课程老师
	public function teacherAction(){
		 $courseid           = ChkClng(KS_G('get.id'));
		 if(!empty($courseid)){
			   $course       = $this->AppModel->getRow("where courseid=$courseid limit 1");
		 }
		 $UserModel          = new CourseModel('common_user');
		 $teacherModel       = new CourseModel('common_user_teacher');
		 $teachercourseModel = new CourseModel('app_course_teacherrelate');
		 //分页查询数据
		 $where     =" as a left join $teacherModel->table as b on a.teacherid = b.userid where a.courseid=$courseid";
		 $options   = $teachercourseModel->getOptions('4',$where);
		 $page      = Page($options);
		 $teachers  = $teachercourseModel->getPage($page,'a.isspeaker desc',$where);
		 foreach($teachers as $k=>$v){
		 	$teachers[$k]['teachercount'] = $teachercourseModel ->getOne('count(*)','where teacherid='.$v['teacherid']);
		 }

		 include  CURR_VIEW_PATH . "knowledge.php";exit;
		 include  CURR_VIEW_PATH . "courseteacher.php";
	}
	public function addteachersAction(){
		 $docent = ChkSQL(KS_G("post.docent"));

		 $courseid      = ChkClng(KS_G("get.id"));
		 $teacherModel = M('app_course_teacherrelate');
		 $teacher = $teacherModel->getOne('teacherid','where courseid='.$courseid.' and role=1');

		 if(!empty($docent)){
		 	$Data_Docent['courseid'] = $courseid;
		 	$Data_Docent['wxid'] = $this->wxid;
		 	if($teacher){
				$Data_Docent['role'] = 2;
				foreach($docent as $k=>$v){
					$v = ChkClng($v);
					$Data_Docent['teacherid'] = $v;
					$teacherModel->doAdd($Data_Docent,'id');
	            }
	         }else{
	         	foreach($docent as $k=>$v){
	         		if($k==0){
	         			$Data_Docent['role'] = 1;
						$Data_Docent['teacherid'] = $v;
						$teacherModel->doAdd($Data_Docent,'id');
						$Data['teacherid']=$v;
					    $this->AppModel->update($Data,'courseid='.$courseid);

					}else{
						$Data_Docent['role'] = 2;
						$Data_Docent['teacherid'] = $v;
					    $teacherModel->doAdd($Data_Docent,'id');

					}
	            }
	         }
      }else{
      	KS_INFO('请选择',4,'','',1);
      }
		$this->cache->PutHCache('courseinfo',$this->wxid);//将课程插入缓存
	    $url = M_URL($this->AppName.'/Index','teacher',$courseid,GP(''));
		KS_INFO('添加成功',3,$url);
	}

	//设置主讲
	public function teacherSpeakAction(){
		$teacherid = ChkClng(KS_G('get.id'));
		$role=null !==GF('role') ? GF('role'):'';
		$courseid=null !==GF('courseid') ? GF('courseid'):'';
		$teacherRelaetModel = new CourseModel('app_course_teacherrelate');
		if ($role==1){
			$speaker = $teacherRelaetModel->getOne('teacherid',"where wxid=$this->wxid and courseid=$courseid and role=1");
			if ($speaker){
				$teacherRelaetModel->update(['role'=>2],"wxid=$this->wxid and courseid=$courseid and teacherid=$speaker");
			}
		}
		$Data['role'] = $role;
		$teacherRelaetModel->update($Data,"wxid=$this->wxid and courseid=$courseid and teacherid=$teacherid");
//		$this->AppModel->update($Data2,'courseid='.$courseid);
//		$this->cache->PutHCache('courseinfo',$this->wxid);//将课程插入缓存
		$url = M_URL($this->AppName.'/Index','teacher',$courseid,GP(''));
		KS_INFO('设置成功',3,$url);
	}
	//删除课程老师信息
	 public function delspeakerAction(){
		$id = ChkClng(KS_G('get.id'));
		$courseid=null !==GF('courseid') ? GF('courseid'):'';
		$teacherRelaetModel = new CourseModel('app_course_teacherrelate');
		$teacherRelaetModel->delete("id=$id");putsession('user_live:'.$courseid,null);
		$this->cache->PutHCache('courseinfo',$this->wxid);//将课程插入缓存
		$url = M_URL($this->AppName.'/Index','teacher',$courseid,GP(''));
		KS_INFO('删除成功',3,$url);
	 }
	/*
	 * 设为上课学生
	 */
	public function shangkeStudentAction()
	{
		$userid = ChkClng(KS_G('get.id'));
		$courseid=null !==GF('courseid') ? GF('courseid'):'';
		$teacherRelaetModel = M('app_course_rate');
		$teacherRelaetModel->update(['status'=>1],"wxid=$this->wxid and courseid=$courseid");
		$teacherRelaetModel->update(['status'=>2],"wxid=$this->wxid and courseid=$courseid and userid=$userid");
		$url = M_URL($this->AppName.'/Index','student',$courseid,GP(''));
		KS_INFO('设置成功',3,$url);
	}
	/**
     * 进入课程里的学员列表
	 */
	public function studentAction(){
		/*$courseid =ChkClng(KS_G('get.id'));
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype= KS_S('keytype');
		$wher="where a.courseid = $courseid and a.status !=-1 and c.usertype=0 and type!=4 and paystatus=1";
		if(!empty($keyword)){
			if($keytype==1){$wher.=" and b.name like '%$keyword%'";}
		}
		if(!empty($courseid)){
			$course=$this->AppModel->getRow("where courseid=$courseid limit 1");
		}

		$UserModel   = M('common_user');
		$userStudent = M('common_user_member');
		$studentrelate = M('app_order_info');
		$course_studentrelate = M('app_course_studentrelate');
		$where = "as a left join $userStudent->table as b on a.memberid = b.userid  left join $UserModel->table as c on c.userid = b.userid  and c.status!=-1 right join $course_studentrelate->table as d on d.memberid=b.userid and d.courseid=$courseid $wher";
		$options = $studentrelate->getOptions('10',$where);
        $page = Page($options);
		$student = $studentrelate->getPage($page,'d.status desc,a.adddate desc',$where,'a.progress,a.paytype,b.*,c.*,d.status');*/

        $courseid =ChkClng(KS_G('get.id'));
        //搜索
        $keyword = ChkSQL(KS_S('keyword'));
        $keytype= KS_S('keytype');
        $wher="where a.courseid = $courseid and c.usertype=0";
        if(!empty($keyword)){
            if($keytype==1){$wher.=" and b.name like '%$keyword%'";}
        }
		$course = $this->course;
        $UserModel   = M('common_user');
        $userStudent = M('common_user_member');
        $studentrelate = M('app_course_rate');
        $where = "as a left join $userStudent->table as b on a.userid = b.userid  left join $UserModel->table as c on c.userid = b.userid  and c.status!=-1  $wher";
        $options = $studentrelate->getOptions('10',$where);
        $page = Page($options);
        $student = $studentrelate->getPage($page,'a.status desc,a.createtime desc',$where,'a.*,a.paytype as paytype,b.name,c.username');
		
		include  CURR_VIEW_PATH . "knowledge.php";  //在knowledge.php里包含home.student/home.studentList.php
	}

	/**
     * 进入添加课程学员页面
	 */
	public function addCourseStudentAction(){
		$courseid      = ChkClng(KS_G('get.id'));
		$UserModel     = M('common_user');
		$userStudent   = M('common_user_member');
		$studentrelate = M('app_order_info');
		$where         ='where a.wxid ='.$this->wxid .' and a.usertype = 0';
		//关键字搜索
		$keyword = KS_S('keyword');
		$keytype = null !==GF('keytype') ? GF('keytype'):0;
	    if(!empty($keyword)){
			    if($keytype==1){
			          $where.=" and a.username like '%$keyword%'";
		        }elseif($keytype==2){
					  $where.=" and b.name ='%$keyword%'";
				}
		}

	    $where = "as a inner join $userStudent->table as b on a.userid = b.userid $where and b.userid not in (select memberid from (select memberid from $studentrelate->table where wxid=$this->wxid and courseid = $courseid and status !=-1) as tbl)";

      //  die($where);

        $options = $UserModel->getOptions('13',$where);
		$page    = Page($options);
		$student = $UserModel->getPage($page,'a.userid desc',$where);
		include  CURR_VIEW_PATH . "student/home.addstudent.php";
	}
    /**
     * 加入课程里的（添加学员）
     */
	public function addUserAction(){
		$Data002['appname'] = $this->AppName;
		$UsersModel = M('App/UsersModel');
	    $UsersModel ->addUser($Data002);
	}
	/**
     * 保存添加学员操作
     */
	public function doAddUserAction(){
		$courseid = ChkClng(KS_G('get.id'));
		$usertype          = null !==GF('usertype')?GF('usertype'):0;
		$Data001['wxid']   = $this->wxid;
        $Data001['userid'] = $this->userid;
        $Data001['name']   = ChkSQL(KS_G('post.name'));
        $Data001['type']   = 2;
	    $UsersModel = M('App/UsersModel');
	    $UsersModel ->doaddUsers($Data001);
	    if($usertype == 0){
			$url=M_URL($this->AppName.'/Index','addCourseStudent',$courseid,GP(''));
			KS_INFO('',5,$url);
		}elseif($usertype == 1){
			$url=M_URL($this->AppName.'/Index','addDocent',$courseid,GP(''));
			echo '<script src="'.UOOT.'Public/common/js/jquery.js"></script>';
			echo '<script src="'.UOOT.'Public/Zpopup/js/Zpopup-2.0.js"></script>';
			echo '<script>
						top.popup.tips("创建成功",
						{
							icon:"success",
							interval:400,
							callBack:function(){
								top.$(".popup-open").find("iframe").attr("src","'.$url.'");
							}
						})
					</script>';
			exit;
		}

	}


	//添加课程学员
	public function doaddCourseStudentAction(){
	    $courseid          = ChkClng(KS_G('get.id'));
		$Data['courseid']  = $courseid;
		$Data['studentid'] = null !==GF('studentid') ? GF('studentid'):'0';
		$Data['wxid']      = $this->wxid;
		$studentrelate = M('app_course_studentrelate');
		$studentrelate->doadd($Data,'id');
	    $url  = M_URL($this->AppName.'/Index','student',$courseid,GP(''));
	    KS_INFO('添加成功',3,$url);
	    $html = "<script>parent.location.href='".$url."';</script>";
		echo $html;
	}
	/**
     * 批量添加学员(报课）
	 */
	public function studentOpenCourseAction(){
		$id       =  ChkSQL(KS_G('post.aid'));
		if(empty($id)){
            KS_INFO('请选择',4,'','',1);
            }
		$now_page = ChkClng(KS_S('p',1));
		$ids      = FilterIds(implode(',',$id));

		$UserModel     = M('common_user');
		$userStudent   = M('common_user_member');
		$studentrelate = M('app_class_studentrelate');
		$where         ='where a.wxid ='.$this->wxid .' and a.usertype = 0';

		$where    = "as a left join $userStudent->table as b on a.userid = b.userid $where and b.userid in ($ids)";
		$students = $UserModel->getAll($where);
		include  CURR_VIEW_PATH . "student/home.studentOpenCourse.php";
	}
	/**
     * 保存学员批量报班操作
	 */
	public function studentOpenCourseDoSaveAction(){
		$id       =  ChkSQL(KS_G('post.aid'));
		if(empty($id)){KS_INFO('请选择',4,'','',1);}
		$now_page = ChkClng(KS_S('p',1));
		//$batch    = ChkClng(KS_G('post.batch'));

		$data['order_amount']= ChkFloat(KS_S('order_amount'));
		$data['courseid']    = $this->courseid;
		if ($this->courseType == 11){
            $data['type']    = 7;    //开通类型 0课程 1直播 7专栏  10社群
        }else{
            $data['type']    = 0;    //开通类型 0课程 1直播 7专栏  10社群
        }
        $data['wxid']    = $this->wxid;

		$url            = M_URL($this->AppName.'/Index','student',$this->courseid,GP('p-'.$now_page));
		$Enrolment      = M('App/OrderModel');////调用唤起传说中的model层

	    foreach($id as $k=>$v){
            if ($v>0){
                $data['userid']    = ChkClng($v);
                $Enrolment->doOpenCourseOrder($data);//对学员进行报课报班
            }
		}
    	KS_INFO('',3,$url);
	}
	/**
     * 删除课程学员(仅限线下付费的）
	 */
	public function delCourseStudentAction(){
		$studentid     = ChkClng(KS_G('get.id'));
		$orderinfo = M('app_order_info');
        $order = M('app_order');
		$studentrelate = M('app_course_rate');
		$courseid =  ChkClng(KS_S('courseid'));
		$orderid = $orderinfo->getRow('where paytype=0 and wxid='.$this->wxid.' and memberid='.$studentid.' and courseid = '.$courseid.'','orderid');
		$Data['status'] =-1;
        $test = $order->update($Data,'orderid = '.$orderid['orderid'].'');
		$orderinfo->update($Data,"paytype=0 and wxid=$this->wxid and memberid=$studentid and courseid = $courseid");
        $studentrelate->delete("courseid=$courseid and wxid=$this->wxid and userid=$studentid");
		 $this->cache->PutUCache('havecourses',$studentid);
		 $this->cache->PutUCache('userorderinfo',$studentid);
		$url = M_URL($this->AppName.'/Index','student',$courseid,GP(''));
	    KS_INFO("删除成功",0,$url);
	}
    /**
     * 批量删除学员(仅限线下付费的）
     */
    public function delStudentAction(){
    	$courseid     = ChkClng(KS_G('get.id'));
    	$id = ChkSQL(KS_G('post.aid'));
		$now_page = ChkClng(KS_S('p',1));
		$orderinfo = M('app_order_info');
        $studentrelate = M('app_course_rate');
//		$studentrelateModel = M('app_course_studentrelate');
		$batch       = ChkClng(KS_G('post.batch'));
		$url = M_URL($this->AppName.'/Index','student',$courseid,GP('p-'.$now_page));
		 if($batch ==1){
		    if(empty($id)){KS_INFO('请选择',0,'','',1);}
			foreach($id as $k=>$v){
                if($v>0){
                    $Data['status'] =-1;
                    $paytype = $studentrelate->getOne('paytype','where courseid='.$courseid.' and wxid='.$this->wxid.' and userid='.$v.'');
                    if ($paytype ==0){
						$orderinfo->update($Data," paytype=0 and wxid=$this->wxid and memberid=$v and courseid = $courseid");
                        $studentrelate->delete("courseid=$courseid and wxid=$this->wxid and userid=$v");
//                        $studentrelateModel->delete("courseid=$courseid and wxid=$this->wxid and memberid=$v");
                        $this->cache->PutUCache('havecourses',$v);
                    }
                }
			}
		}elseif ($batch == 2){
		     if (empty($id)){
                 $rate_data = $studentrelate->getAll('where courseid = '.$courseid.' and wxid = '.$this->wxid.'');
             }else{
		        $id = ChkClng_Array($id);
                $userid = implode(",", $id);
                $rate_data = $studentrelate->getAll('where courseid = '.$courseid.' and wxid = '.$this->wxid.' and userid in ('.$userid.')');
             }
             foreach ($rate_data as $key =>$val){
                 $rate_data[$key]['number'] = $key+1;
                 $rate_data[$key]['username'] = User_GetUser($val['userid'])['username'];
                 $rate_data[$key]['name'] = User_GetUser($val['userid'])['name'];
                 $mobile = User_GetUser($val['userid'])['mobile'];
                 $rate_data[$key]['mobile'] = empty($mobile)? "---" :$mobile;
                 if ($val['is_finish']==1){
                     $rate_data[$key]['rate'] =  '100%';
                 }elseif ($val['total_time']!=0){
                     $info= $val['finish_time']/$val['total_time']*100;
                     if ($info>=100){
                         $rate_data[$key]['rate'] = '100%';
                     }else{
                         $rate_data[$key]['rate'] = sprintf("%01.2f", $info).'%';
                     }
                 }else{
                     $rate_data[$key]['rate'] = '0.00%';
                 }
             }
             $course = M('app_course');
             $title = $course->getOne('title','where courseid = '.$courseid.' ');
             $xlsName     = '学员学习进度'.date("YmdHis").'';//文件名
             $textRun     = $title;//表名
             $xlsCell  = array(
                 array('number','序号'),
                 array('name','学员姓名'),
                 array('username','用户名'),
                 array('mobile','联系电话'),
                 array('rate','学习进度'),
             );
             exportExcel($xlsName,$xlsCell,$rate_data,$textRun);
         }
    	KS_INFO('操作成功',0,$url);
	}
	//进入页面
	public function excelIndexAction(){
		$courseid     = ChkClng(KS_G('get.id'));
		include  CURR_VIEW_PATH . "excelindex.php";
	}
	//批量导入学生
	public function beathaddUsersAction(){
		$courseid =ChkClng(KS_G('get.id'));
		if(!empty($_FILES['execl']['tmp_name'])){
			$this->upload->savePath = 'users/excel/'.$this->wxid.'/'; // 设置附件上传（子）目录
			$this->upload->exts =array('xls','xlsx','csv');// 设置附件上传类型
			$info = $this->upload->uploadOne($_FILES['execl']);
			if(!$info) {// 上传错误提示错误信息
				KS_INFO($this->upload->getError(),0,'','',1);
			}else{
				$execl = ChkSQL($this->upload->rootPath.$info['savepath'].$info['savename']);//应用封面图片
			}
		}else{
			KS_INFO('请选择文件',4,'','',1);
		}
		vendor("PHPExcel.PHPExcel");
		ob_end_clean();
		$extension = strtolower( pathinfo($execl, PATHINFO_EXTENSION) );
		if($extension =='xlsx'){
			$objReader = new PHPExcel_Reader_Excel2007();
		}elseif($extension =='xls') {
			$objReader = new PHPExcel_Reader_Excel5();
		}elseif($extension=='csv') {
			$objReader = new PHPExcel_Reader_CSV();
		}
		$objPHPExcel = $objReader->load($execl,$encode='utf-8');//加载文件
		$sheet = $objPHPExcel->getSheet(0);//取得sheet(0)表
		$highestRow = $sheet->getHighestRow(); // 取得总行数
		$highestColumn = $sheet->getHighestColumn(); // 取得总列数
		$userModel = M('common_user');
		$userMemberModel = M('common_user_member');
		for($i=2;$i<=$highestRow;$i++){
		$data['username']=$objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();

		$password= $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
		if(empty($data['username']) || empty($password)){continue;}
		$data['parentid'] = $this->userid;
		$data['usertype'] = 0;
		$data['status'] = 1;
		$data['mobilebing'] = 1;
		$data['wxid'] = $this->wxid;
		$data['rndpasswordc']  = rand(100000,999999);
		$data['regdate']       = ChkClng(time());
		$data['password'] = KS_MD5($password.KS_MD5($data['rndpasswordc']));
		$user =  $userModel->getRow("where username = '$data[username]' and  wxid = $this->wxid ");
		if($user){
			$userModel->update($data,'userid='.$user['userid']);
			$data1['name']= $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
			$userMemberModel -> update($data1,'userid='.$user['userid']);
			$userid =	 $user['userid'];
		}else{
			$userid = $userModel->doAdd($data,'userid');
			$userMemberModel->delete('userid='.$userid);
			$data1['name']= $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
			$data1['userid'] = $userid;
			$userMemberModel->doEfAdd($data1);
		}
		$Data['studentid']= $userid;
		$Data['courseid']= ChkClng(KS_G('get.id'));
		$Data['wxid']=$this->wxid;
		$studentCourseModel = M('app_course_studentrelate');
		$studentCourseModel->doAdd($Data,'id');
		}
		$url=M_URL($this->AppName.'/Index','student',$courseid,GP(''));
		KS_INFO('添加成功',3,$url);
	}
	//进入房间管理
	public function roomAction(){
		$courseid = ChkClng(KS_G('get.id'));
		$course   = $this->AppModel->getRow("where courseid = $courseid limit 1");
		$chapterModel =M($course['chaptertable']);
		$status=null !==GF('status') ? GF('status'):'4';
		$liveModel = M('app_live_list');
		$teacherModel = M('common_user_teacher');
		$where = "as a  left join $chapterModel->table as b on a.chapterid = b.chapterid left join $teacherModel->table as c on a.teacherid = c.userid where a.wxid =$this->wxid and a.courseid=$courseid";
		if($status !=4){
		 	$where.=' and a.status='.$status;
		}else{
		 	$where.=' and a.status != -1';
		}
		$options = $liveModel -> getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$live= $liveModel -> getPage($page,'',$where,'c.name,b.title,a.*');
		include  CURR_VIEW_PATH . "knowledge.php";exit;
        include  CURR_VIEW_PATH . "roommanage.php";
	}
	//学生观看列表
	public function studentliveAction(){
		$liveid = ChkClng(KS_G('get.id'));
		$courseid= ChkClng(KS_S('courseid',0));
		$course   = $this->AppModel->getRow('where courseid = '.$courseid.' limit 1');
		$liveModel = M('app_live_list');
		$live = $liveModel->getRow('where id ='.$liveid.' limit 1');
		$liveStidentModel = M($live['studentTable']);
		$userModel = M('common_user');
		$memberModel = M('common_user_member');
		$where =" as a left join $userModel->table as b  on a.memberid = b.userid left join $memberModel->table as c on a.memberid = c.userid  where channlid =$liveid";
		$options = $liveStidentModel -> getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values= $liveStidentModel -> getPage($page,'',$where,'c.name,b.username,a.*');
		include  CURR_VIEW_PATH . "studentlive.php";
	}
	//批量删除学员
//  public function delStudentAction(){
//  	$courseid     = ChkClng(KS_G('get.id'));
//  	$id = ChkSQL(KS_G('post.aid'));
//		if(empty($id)){KS_INFO('请选择');}
//		$now_page = ChkClng(KS_S('p',1));
//		$studentrelate = M('app_course_studentrelate');
//		$batch       = ChkClng(KS_G('post.batch'));
//		$url = M_URL($this->AppName.'/Index','student',$courseid,GP('p-'.$now_page));
//		 if($batch ==1){
//			foreach($id as $k=>$v){$studentrelate->delete("id=$v");}
//		}
//  	KS_INFO('删除成功',0,$url);
//	}
	//进入评论
    public function commentAction(){
		$courseid = ChkClng(KS_G('get.id'));
		$course   = $this->AppModel->getRow('where courseid = '.$courseid.' limit 1');
		$commonModel = M('app_reviews');
		$memberModel = M('common_user_member');
		$where = "where wxid=$this->wxid and appid=6 and infoid= $courseid";
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype=null !==GF('keytype') ? GF('keytype'):0;
	    if(!empty($keyword)){
			if($keytype==1){$where.=" and reviews like '%$keyword%'";}
			if($keytype==2){$where.=" and membername like '%$keyword%'";}
		}
		$options = $commonModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$values  = $commonModel->getPage($page,'reviewsid desc',$where);
		include  CURR_VIEW_PATH . "knowledge.php";exit;
		include  CURR_VIEW_PATH . "commentmanage.php";
	}
	//进入考试管理
	public function examAction(){
	    $course       = $this->AppModel->getRow('where courseid = '.$this->courseid.' limit 1');
		$paperModel   = M('App/PaperModel/app_paper');
		$chapterModel = M($course['chaptertable']);
		$where   = " as a left join $chapterModel->table as b on a.chapterid = b.chapterid where a.courseid =$this->courseid";
		$courseid=$this->courseid;
	    $keyword = ChkSQL(KS_S('keyword'));
	    if(!empty($keyword)){
			$where.=" and a.Title like '%$keyword%'";
		}
		$options = $paperModel->getOptions('5',$where);//分页参数设置
		$page    = Page($options);
		$values  = $paperModel->getPage($page,'a.paperid desc',$where,'b.title as chaptertitle,a.*');
		// var_dump($values);
		include  CURR_VIEW_PATH . "knowledge.php";exit;
		include  CURR_VIEW_PATH . "exam.php";
	}
	public function delPaperAction(){
		$courseid = ChkClng(KS_S('courseid',0));
		$paperid =ChkClng(KS_G('get.id'));
		$paperModel = M('App/PaperModel/app_paper');
		$papertypeModel = M('App/PaperModel/app_paper_tmtype');
		$paperModel->delete('paperid='.$paperid);
		$papertypeModel->delete('paperid='.$paperid);
		 $url = M_URL($this->AppName.'/Index','exam',$courseid,GP(''));
		 KS_INFO('删除成功',0,$url);
	}
	//进入添加新试卷
	public function addExamAction(){
		$courseid = null !==GF('courseid') ? GF('courseid'):'';
		if($courseid == ''){
			 $courseid =ChkClng(KS_G('get.id'));
		}
	    $course  = $this->AppModel->getRow('where courseid = '.$courseid.' limit 1');
	    $Intro = ks_editor('Intro');
	    include  CURR_VIEW_PATH . "exam_add.php";
	}
	//绑定是试卷
	public function bindPaperAction(){
		$courseid =ChkClng(KS_G('get.id'));
		$PaperModel =M('app_paper');
		$categoryModel =M('app_category');
		// $where ='as a left join '.$categoryModel->table.'  as b on  a.categoryid = b.categoryid where a.wxid='.$this->wxid.' and courseid !='.$courseid.' and Status=1';
		$where = 'where wxid='.$this->wxid.' and courseid!='.$courseid;
		$keyword = KS_S('keyword');
		if(!empty($keyword)){
		    $where.=" and a.Title like '%$keyword%'";
		}
		$categoryid=null !==GF('categoryid') ? GF('categoryid'):0;
		if($categoryid!=0) {
			$where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";
		}
		$options = $PaperModel->getOptions('5',$where);//分页参数设置
		$page    = Page($options);
		$values  = $PaperModel->getPage($page,'paperid desc',$where);
		include  CURR_VIEW_PATH . "exam_bind.php";
	}
	//进行绑定
	public function dobindPaperAction(){
		$paperid =ChkClng(KS_G('get.id'));
		$courseid = null !==GF('courseid') ? GF('courseid'):0;
		$course  = $this->AppModel->getRow('where courseid = '.$courseid.' limit 1');
		$Data['categoryid'] = $course['categoryid'];
		$Data['courseid']= $courseid;
		$PaperModel =M('app_paper');
		$PaperModel->update($Data,'paperid='.$paperid);
		 $url = M_URL($this->AppName.'/Index','exam',$courseid,GP(''));
		 KS_INFO('添加成功',3,$url);
	}
	//批量绑定
	 public function batchBindPaperAction(){
    	$courseid     = ChkClng(KS_G('get.id'));
    	$id = ChkSQL(KS_G('post.aid'));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$now_page = ChkClng(KS_S('p',1));
		$course  = $this->AppModel->getRow('where courseid = '.$courseid.' limit 1');
		$Data['categoryid'] = $course['categoryid'];
		$Data['courseid']= $courseid;
		$ids= implode(',',$id);
		$PaperModel =M('app_paper');
		$PaperModel->update($Data,"paperid in ($ids)");
		$url = M_URL($this->AppName.'/Index','exam',$courseid,GP(''));
    	KS_INFO('绑定成功',3,$url);
	}
	//进入题库
	public function TkindexAction(){
		$courseid = null !==GF('courseid') ? GF('courseid'):'';
		if($courseid==''){
			$courseid =ChkClng(KS_G('get.id'));
		}
	    $course  = $this->AppModel->getRow('where courseid = '.$courseid.' limit 1');
	    $tkModel       = M('App/PaperModel/app_paper_tk');
		$papertypeModel= M('App/PaperModel/app_paper_type');
		$papertype     = $papertypeModel->getAll('where wxid ='.$this->wxid);
		$category      = $this->cache->GetHCache('appcategory',$this->wxid);//取出缓存
		$where         = 'where wxid ='.$this->wxid.' and courseid ='.$courseid;
		$tktype = null !==GF('tktype') ? GF('tktype'):7;
		if($tktype !=7){
			$where.=' and tktype='.$tktype;
		}
		//类型
//		$papertypeid=null !==GF('papertypeid') ? GF('papertypeid'):0;
//		if($papertypeid!=0) {
//		    $where .= '  and a.paperTypeId='.$papertypeid;
//		}
		//关键字
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype=null !==GF('keytype') ? GF('keytype'):0;
		if(!empty($keyword)){
			 if($keytype==1){$where.=" and options like '%$keyword%'";}
		}
		//分页
		$options = $tkModel->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$tk = $tkModel->getPage($page,'tkid desc',$where);
		include  CURR_VIEW_PATH . "knowledge.php";exit;
		include  CURR_VIEW_PATH . "tk_index.php";
	}
	//导入题目
	//进入excel导入
	public function delTkAction(){
		$courseid = ChkClng(KS_S('courseid',0));
		$now_page = ChkClng(KS_S('p',1));
		$tkModel  = M('App/PaperModel/app_paper_tk');
		$tkid     = ChkClng(KS_G('get.id'));
		$tkModel->delete('tkid='.$tkid);
		$url = M_URL($this->AppName.'/Index','Tkindex','',GP('courseid-'.$courseid.',p-'.$now_page));
	    KS_INFO('删除成功',0,$url);
	}
	//进行导入
	public function beathaddTkAction(){
        $courseid = ChkClng(KS_G('get.id'));
        $type = ChkClng(KS_G('post.type'));
		if(!empty($_FILES['execl']['tmp_name'])){
				$this->upload->savePath = 'school/'.$this->wxid.'/excel/'; // 设置附件上传（子）目录
				$this->upload->exts =array('xls','xlsx','csv');// 设置附件上传类型
				$info = $this->upload->uploadOne($_FILES['execl']);
				if(!$info) {KS_INFO($this->upload->getError(),0,'','',1);}//上传错误提示错误信息
				else{$execl = ChkSQL($this->upload->rootPath.$info['savepath'].$info['savename']);}//应用封面图片
		}else{KS_INFO('请选择文件',4,'','',1);}
		vendor("PHPExcel.PHPExcel");
		ob_end_clean();
		$extension = strtolower( pathinfo($execl, PATHINFO_EXTENSION) );
		if($extension =='xlsx'){
			$objReader = new PHPExcel_Reader_Excel2007();
		}elseif($extension =='xls') {
			$objReader = new PHPExcel_Reader_Excel5();
		}elseif($extension=='csv') {
			$objReader = new PHPExcel_Reader_CSV();
		}
		$objPHPExcel = $objReader->load($execl,$encode='utf-8');//加载文件
		$sheetCount = $objPHPExcel->getSheetCount();
		for($a=0;$a< $sheetCount;$a++){
			$tkModel = M('app_paper_tk');
			$sheet = $objPHPExcel->getSheet( $a );//取得sheet(0)表
			$highestRow = $sheet->getHighestRow(); // 取得总行数
			$highestColumn = $sheet->getHighestColumn(); // 取得总列数
			if($a == 0){$tktype =1;}elseif($a == 1){$tktype=6;}elseif($a == 2 ){ $tktype =3;}elseif($a == 3){$tktype = 2;}elseif($a = 4){$tktype = 4;}
			$Data['userid']   = $this->userid;
			$Data['wxid']     = $this->wxid;
			$Data['tktype']   = $tktype;
			$Data['courseid'] = 0;
			 for($i=2;$i<$highestRow+1;$i++){
				$option1=$sheet->getCellByColumnAndRow(0, $i)->getValue();
				if($a == 0){
					$option1=$sheet->getCellByColumnAndRow(0, $i)->getValue();
					$option2=$sheet->getCellByColumnAndRow(1, $i)->getValue();
					$option3=$sheet->getCellByColumnAndRow(2, $i)->getValue();
					$option4=$sheet->getCellByColumnAndRow(3, $i)->getValue();
					$option5=$sheet->getCellByColumnAndRow(4, $i)->getValue();
					$Data['options']=trim($option1).'$$$'.trim($option2).'|$|'.trim($option3).'|$|'.trim($option4).'|$|'.trim($option5);
					$leve=$sheet->getCellByColumnAndRow(7, $i)->getValue();
					if($leve == '简单'){$lev = 1;}elseif($leve == '普通') {$lev = 2;}else{$lev = 3;}
					$Data['level']=$lev;
					$Data['anser'] = trim($sheet->getCellByColumnAndRow(5, $i)->getValue());
					$Data['analysis'] =trim($sheet->getCellByColumnAndRow(6, $i)->getValue());
					$tkModel->doAdd($Data,'tkid');
				}elseif($a == 1){
					$option1=$sheet->getCellByColumnAndRow(0, $i)->getValue();
					$option2=$sheet->getCellByColumnAndRow(1, $i)->getValue();
					$Data['options']=trim($option1).'$$$'.trim($option2);
					$leve=$sheet->getCellByColumnAndRow(4, $i)->getValue();
					if($leve == '简单'){$lev = 1;}elseif($leve == '普通') {$lev = 2;}else{$lev = 3;}
					$Data['level']=$lev;
					$Data['anser'] =  trim($sheet->getCellByColumnAndRow(2, $i)->getValue());
					$Data['analysis'] =trim($sheet->getCellByColumnAndRow(3, $i)->getValue());
					$tkModel->doAdd($Data,'tkid');
				}elseif($a == 2){
					$Data['options']=trim($sheet->getCellByColumnAndRow(0, $i)->getValue());
					$leve=$sheet->getCellByColumnAndRow(3, $i)->getValue();
					if($leve == '简单'){$lev = 1;}elseif($leve == '普通') {$lev = 2;}else{$lev = 3;}
					$Data['level']=$lev;
					$anser =  $option5=trim($sheet->getCellByColumnAndRow(1, $i)->getValue());
					if($anser == '正确'){$Data['anser'] =1;}else{$Data['anser'] =0;}
					$Data['analysis']=$sheet->getCellByColumnAndRow(2, $i)->getValue();;
					$tkModel->doAdd($Data,'tkid');
				}elseif($a == 3 || $a == 4){
					$Data['options']=trim($sheet->getCellByColumnAndRow(0, $i)->getValue());
					$Data['anser'] = trim($sheet->getCellByColumnAndRow(1, $i)->getValue());
					$Data['analysis'] = trim($sheet->getCellByColumnAndRow(2, $i)->getValue());
					$leve=trim($sheet->getCellByColumnAndRow(3, $i)->getValue());
					if($leve == '简单'){$lev = 1;}elseif($leve == '普通') {$lev = 2;}else{$lev = 3;}
					$Data['level']=$lev;
					$tkModel->doAdd($Data,'tkid');
				}
			 }
		 }
		 $url = M_URL($this->AppName.'/Index','TkIndex',$courseid,GP(''));
		 KS_INFO('添加成功',3,$url);
	}
	//批改
	public function correctAction(){
		 $id = ChkClng(KS_G('get.id'));
		 $courseid = null !==GF('courseid') ? GF('courseid'):0;
		 $course   = $this->AppModel->getRow('where courseid ='.$courseid.' limit 1');
		 include  CURR_VIEW_PATH . "correct.php";
	}
	//批量删除试卷
	public function batchpaperAction(){
		$paperid = ChkSQL(KS_G('post.paperid'));
		$courseid =ChkClng(KS_G('get.id'));
		if(empty($paperid)){KS_INFO('请选择',0,'','',1);}
		$now_page = ChkClng(KS_S('p',1));
		$batch       = ChkClng(KS_G('post.batch'));
		$url = M_URL($this->AppName.'/Index','exam',$courseid,GP('p-'.$now_page));
		$paperModel = M('app_paper');
		if($batch ==1){
			foreach($paperid as $k=>$v){
				    $id = ChkClng($v);
				    $paperModel->delete("paperid=$v");
			}
			KS_INFO('删除成功',0,$url);
		}
	}
	//作业首页
	public function taskAction(){
		$courseid = ChkClng(KS_G('get.id'));
		$course   = $this->AppModel->getRow('where courseid ='.$courseid.' limit 1');
		$where ="where wxid = $this->wxid and courseid = $courseid";
		$keyword = KS_S('keyword');
	    if(!empty($keyword)){
			$where.=" and title like '%$keyword%'";
		}
		$taskstyle = null !==GF('taskstyle') ? GF('taskstyle'):3;//作业类型
		if($taskstyle !=3){
			$where.=' and taskstyle='.$taskstyle;
		}
		$checkstyle = null !==GF('checkstyle') ? GF('checkstyle'):3;//批改类型
		if($checkstyle !=3){
			$where.=' and checkstyle='.$checkstyle;
		}
		$status = KS_S('status',3);//状态
		if($status !=3){
			$where.=' and status='.$status;
		}
	    $taskModel =M('app_task');
		$options = $taskModel->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$task = $taskModel->getPage($page,'adddate desc',$where);
		include  CURR_VIEW_PATH . "knowledge.php";exit;
	    include  CURR_VIEW_PATH . "taskIndex.php";
	}
	//发布作业
	public function addTaskAction(){
		$courseid = ChkClng(KS_G('get.id'));
		$Intro = ks_editor('content','',1);//内容编辑器
		$paperModel = M('app_paper');
		$paper = $paperModel->getAll(' where courseid ='.$courseid);

		  $date=time();



		 include  CURR_VIEW_PATH . "task_add.php";

	}
	//添加作业
	 public function doAddTaskAction(){
	  $courseid = ChkClng(KS_G('get.id'));
	  $course   = $this->AppModel->getRow('where courseid ='.$courseid.' limit 1');
	  $Data['wxid'] = $this->wxid;
	  $Data['courseid'] = $courseid;
	  $Data['categoryid'] = $course['categoryid'];
	  $Data['tasktype'] = 1;
	  $Data['inputer'] = $this->userinfo['username'];
	  $Data['title'] = ChkSQL(KS_G("post.title"));
	   $Data['taskstyle'] = ChkSQL(KS_G("post.taskstyle"));
	  if($Data['taskstyle'] == 2){
	  	$Data['paperid'] = ChkClng(KS_G("post.paperid"));
	  	$Rule['paperid'] = '请选择试卷|isEmpty';

	  }elseif($Data['taskstyle'] == 1){
	  	    $file =   ChkSQL(KS_G("post.coursefile"));
	  	    $Data['file']  = implode(',',$file);
	  	    $Rule['file'] = '请选择文件|isEmpty';
	  }
	    $Data['checkstyle'] = ChkSQL(KS_G("post.checkstyle"));
	  $Data['content'] = ChkSQL(KS_G("post.content"));
	  $Data['enddate'] = strtotime(ChkSQL(KS_G("post.enddate")));
	  $Data['status'] = ChkClng(KS_G('post.status'));
	  $Data['adddate'] = time();
       $Rule['title'] = '作业题目不能为空|isEmpty';
      $taskModel = M('app_task');
	  Chkpost($Data,$Rule,$taskModel);
	  $taskModel->doAdd($Data,'id');
	    $url1=M_URL($this->AppName.'/Index','task',$courseid,GP(''));
	  KS_INFO("添加成功",3,$url1);
  }

  public function correctTaskAction(){
  	  $id = ChkClng(KS_G('get.id'));
  	   $courseid = $this->courseid;
  	    $where = ' where wxid='.$this->wxid.' and courseid='.$courseid.' and status =1';
  	   $taskstyle = null !==GF('taskstyles') ? GF('taskstyles'):3;//作业类型
		if($taskstyle !=3){
			$where.=' and taskstyle='.$taskstyle;
		}
		$checkstyle = null !==GF('checkstyles') ? GF('checkstyles'):3;//批改类型
		if($checkstyle !=3){
			$where.=' and checkstyle='.$checkstyle;
		}
		$status = KS_S('status',3);//状态
		if($status !=3){
			$where.=' and status='.$status;
		}
	    $course   = $this->AppModel->getRow('where courseid ='.$courseid.' limit 1');
        $taskModel =M('app_task');
         $answerModel =M('app_task_answer');
		$options = $taskModel->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$task = $taskModel->getPage($page,'adddate desc',$where);
		foreach($task as $k=>$v){
			$task[$k]['count']=$answerModel->getOne('count(1)',' where taskid='.$v['id'].' limit 1');
			$task[$k]['currectCount']=$answerModel->getOne('count(1)',' where taskid='.$v['id'].' and answerstatus =2 limit 1');
			$task[$k]['nocurrect']=$task[$k]['count']-$task[$k]['currectCount'];
		}
	 include  CURR_VIEW_PATH . "knowledge.php";exit;
  	 include  CURR_VIEW_PATH . "task_correct.php";
  }

  public function memberTaskAction(){
		 $taskid=ChkClng(KS_G('get.id'));
//		$memberModel=M('app_');
		$courseid=$this->courseid;
		 $course   = $this->AppModel->getRow('where courseid ='.$courseid.' limit 1');
		 $taskModel =M('app_task');
		 $task =$taskModel->getRow(' where id='.$taskid.' limit 1');


		 $memberModel=M('common_user_member');
		 $userModel =M('common_user');
		 $taskanswerModel=M('app_task_answer');

		 $where =' where taskid='.$taskid;
		$options = $taskanswerModel->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$answer = $taskanswerModel->getPage($page,'adddate desc',$where);
		foreach($answer as $k=>$v){
			$answer[$k]['memberInfo']=$userModel->getRow(' as a  inner join '.$memberModel->table.' as b on a.userid=b.userid where a.userid='.$v['memberid'], 'b.name,b.Sex');
		}

		include  CURR_VIEW_PATH . "memberTask.php";
	}
    //进入编辑
    public function editTaskAction(){
	    $now_page = ChkClng(KS_S('p',1));
	    $taskModel = M('app_task');
	    $id = ChkClng(KS_G('get.id'));
	    $paperModel = M('app_paper');
	    $task =   $taskModel->getRow('where id ='.$id.' limit 1');

	    $date=$task['enddate'];
	  	$paperModel = M('app_paper');
		$paper = $paperModel->getAll(' where wxid ='.$this->wxid);
		if(!empty($task['file']) && $task['taskstyle']==1){
		   $uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		   $tablename      = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
		   $fileModel      = M($tablename);
		   $files=$fileModel->getAll(" where id in ($task[file])");
		 	foreach($files as $k=>$v){
				$fileName = explode('.',$v['filename']);
				$ext = isset($fileName[1]) ? $fileName[1] : '0';
				if($ext == 'txt'){
					$files[$k]['src']='/Public/uploads/common/TXT.png';
				}elseif($ext == 'mp4'){
					$files[$k]['src']='/Public/uploads/common/MOV.png';
				}elseif($ext == 'mp3'){
					$files[$k]['src']='/Public/uploads/common/MP3.png';
				}elseif($ext == 'doc' || $ext == 'docx' ){
					$files[$k]['src']='/Public/uploads/common/DOC.png';
				}elseif( $ext == 'pdf' ){
					$files[$k]['src']='/Public/uploads/common/PDF.png';
				}elseif($ext == 'PPT' || $ext == 'pptx'){
					$files[$k]['src']='/Public/uploads/common/PPT.png';
				}else{
					$files[$k]['src']=$v['filePath'];
				}
			}
		}
	 	include  CURR_VIEW_PATH . "task_add.php";
    }
    //查看作业
	public function seeTasksAction(){
		  $id = ChkClng(KS_G('get.id'));
		  $courseid = ChkClng(null !==GF('courseid') ? GF('courseid'):'0');
		  $course   = $this->AppModel->getRow('where courseid ='.$this->courseid.' limit 1');
		  $taskModel =M('app_task');
		  $task =$taskModel->getRow('where id='.$id);
		  if($task['taskstyle']==1){
			   $uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
			   $tablename      = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
			   $fileModel      = M($tablename);
			   $files=$fileModel->getAll(" where id in ($task[file])");
			 	foreach($files as $k=>$v){
					$fileName = explode('.',$v['filename']);
					$ext = isset($fileName[1]) ? $fileName[1] : '0';
					if($ext == 'txt'){
						$files[$k]['src']='/Public/uploads/common/TXT.png';
					}elseif($ext == 'mp4'){
						$files[$k]['src']='/Public/uploads/common/MOV.png';
					}elseif($ext == 'mp3'){
						$files[$k]['src']='/Public/uploads/common/MP3.png';
					}elseif($ext == 'doc' || $ext == 'docx' ){
						$files[$k]['src']='/Public/uploads/common/DOC.png';
					}elseif( $ext == 'pdf' ){
						$files[$k]['src']='/Public/uploads/common/PDF.png';
					}elseif($ext == 'PPT' || $ext == 'pptx'){
						$files[$k]['src']='/Public/uploads/common/PPT.png';
					}else{
						$files[$k]['src']=$v['filePath'];
					}
				}

		  	include  CURR_VIEW_PATH . "seedata1.php";
		  }elseif($task['taskstyle']==2){
				  	$paperModel=M('app_paper');
				  	$url = M_URL($this->AppName.'/Index','task','',GP(''));
				  	if(empty($task['paperid'])){
					   	  KS_INFO('无效试卷，请联系管理员',3,$url,'',1);
					   }
				  	$paper = $paperModel->getRow(' where paperid ='.$task['paperid']);
					  if(!$paper){
					  	 KS_INFO('无效试卷，请联系管理员',3,$url,'',1);
					  }

					   $papertypeModel = M('app_paper_type');
					   $tmTypeModel    = M('app_paper_tmtype');
					   $paperModel=M('app_paper');
				       $tmtype         = $tmTypeModel->getAll('where paperid = '.$task['paperid'].' order by orderId');

					   $tkModel        = M('app_paper_tk');
					   foreach($tmtype as $k=>$v){
					   if($paper['exam_type']==1){
				   	       $ids = $tkModel->getAll('where wxid='.$this->wxid.' and tktype='.$v['tktype'].'   ORDER BY RAND()  limit '.$v['number'],'tkid');
				   	       $ids=array_column($ids,'tkid');
				   	       $tkid=implode(',',$ids);
				   	       if(!empty($tkid)){
				   	        $tmtype[$k]['tks']=$tkModel->getAll("where tkid in ($tkid)");
				   	       }else{
				   	       	  $tmtype[$k]['tks']=array();
				   	       }
				       }else{
				       	   if(!empty($v['tkIds'])){
								$tmtype[$k]['tks']=$tkModel->getAll("where tkid in ($v[tkIds])");
							}else{
								 $tmtype[$k]['tks']=array();
							}
				       }
			}
		    include  CURR_VIEW_PATH . "seePaper1.php";
		}else{
			include  CURR_VIEW_PATH . "seedata1.php";
		}
	}
    //批改作业
	public function seeTaskAction(){
		$course   = $this->AppModel->getRow('where courseid ='.$this->courseid.' limit 1');
		$taskanswerModel =M('app_task_answer');
  	    $taskModel=M('app_task');
  	    $answerid=ChkClng(KS_G('get.id'));
  	    $taskanswer =$taskanswerModel->getRow(' where id='.$answerid.' limit 1');
  	    $task=$taskModel->getRow(' where id ='.$taskanswer['taskid'].' limit 1');
  	    if($task['taskstyle']==1){
			   $uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
			   $tablename      = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
			   $fileModel      = M($tablename);
			   $files=$fileModel->getAll(" where id in ($task[file])");
			 	foreach($files as $k=>$v){
					$fileName = explode('.',$v['filename']);
					$ext = isset($fileName[1]) ? $fileName[1] : '0';
					if($ext == 'txt'){
						$files[$k]['src']='/Public/uploads/common/TXT.png';
					}elseif($ext == 'mp4'){
						$files[$k]['src']='/Public/uploads/common/MOV.png';
					}elseif($ext == 'mp3'){
						$files[$k]['src']='/Public/uploads/common/MP3.png';
					}elseif($ext == 'doc' || $ext == 'docx' ){
						$files[$k]['src']='/Public/uploads/common/DOC.png';
					}elseif( $ext == 'pdf' ){
						$files[$k]['src']='/Public/uploads/common/PDF.png';
					}elseif($ext == 'PPT' || $ext == 'pptx'){
						$files[$k]['src']='/Public/uploads/common/PPT.png';
					}else{
						$files[$k]['src']=$v['filePath'];
					}
				}
  	      	 include  CURR_VIEW_PATH . "seeMmebertask.php";
  	    }elseif($task['taskstyle']==2){
  	      	$paperModel=M('app_paper');
		  	$url = M_URL($this->AppName.'/Index','memberTask',$taskanswer['taskid'],GP(''));
		  	if(empty($task['paperid'])){KS_INFO('无效试卷，请联系管理员',3,$url,'',1);}
		  	$paper = $paperModel->getRow(' where paperid ='.$task['paperid']);
			if(!$paper){KS_INFO('无效试卷，请联系管理员',3,$url,'',1);}
            //$papertypeModel = M('app_paper_type');
			$tmTypeModel    = M('app_paper_tmtype');
		    //$tmtype         = $tmTypeModel->getAll('where paperid = '.$task['paperid'].' order by orderId');
			$tkModel        = M('app_paper_tk');
			$paperAnswer=explode('↓◎↑',$taskanswer['answer']);
			$memberanswer=array();
			foreach($paperAnswer as $k=>$v){
			   if(!empty($v)){
			   		$tmty=explode('↓↑',$v);
				  	$tmty1=$tmTypeModel->getRow('where typeId='.$tmty[0].' limit 1');//查找每个大题
				    $n=$k+1;
				  	$memberanswer[$k]['tmtytitle']=isset($tmty1['title']) ? $tmty1['title'] : '第'.$n.'题';
				  	$memberanswer[$k]['score']=$tmty1['score'];
				  	$tks=explode('§№§',$tmty[1]);
				  	$answertk=array();
				  	foreach($tks as $kt=>$vt){
				  	  	if(!empty($vt)){
				  	  	 	$tk=explode('〓',$vt);
					  	  	$answertk[$kt]['answer']=isset($tk[1]) ? $tk[1] : '';//小题回答答案
					  	  	$tk=$tkModel->getRow('where tkid='.$tk[0].' limit 1');
					  	  	$answertk[$kt]['tk']=$tk;
					  	  	$answertk[$kt]['result']=checkTk($tk,$answertk[$kt]['answer'],$tmty1['score'],$tmty1['typeId']);
				  	  	}
				  	}
				  	$memberanswer[$k]['tks']=$answertk;
			    }
	   		}
	   		$stuscoe   = explode(',',$taskanswer['scores']);
  	        include  CURR_VIEW_PATH . "seePaper.php";
  	   	}else{
  	      	include  CURR_VIEW_PATH . "seedata.php";
  	    }
	}
    //批改试卷作业
    public function currert2Action(){
       	$id      = ChkClng(KS_G('get.id'));
      	$taskanswerModel =M('app_task_answer');
      	$score   = ChkSQL(KS_G("post.score"));
       	$Yscore  = ChkSQL(KS_G("post.yscore"));
       	$num     = 0;
       	$correct = 0;
       	$tknum   = 0;
       	foreach($score as $k=>$v){
  	       	if($v>=$Yscore[$k]){$correct++;}
  	       	$num+=$v;
  	       	$tknum++;
       	}
       	$Data['anserstr']     = KS_G('post.anserstr');
       	$Data['scores']       = implode(',',$score);
       	$Data['score']        = $num;
       	$Data['correct']        = $correct;
       	$Data['tknum']        = $tknum;
       	$Data['evaluate']     = ChkSQL(KS_G("post.evaluate"));
       	$Data['answerstatus'] = 2;
       	$taskanswerModel->update($Data,' id='.$id);
       	$url1=M_URL($this->AppName.'/Index','seeTask',$id,GP(''));
       	KS_INFO("保存成功",3,$url1);
    }
    //进行编辑
    public function doeditTaskAction(){
	  	$now_page = ChkClng(KS_S('p'));
	  	$id = ChkClng(KS_G('get.id'));
	  	$courseid = ChkClng(null !==GF('courseid') ? GF('courseid'):'0');
	  	// $Data['ispaper'] = ChkClng(KS_G('post.ispaper'));
	  	if($Data['ispaper'] == 1){
	  		$paperid = ChkSQL(KS_G("post.paperid"));
       	 	$Data['paperid'] = implode(',',$paperid);
	  	}
	  	$Data['title'] = ChkSQL(KS_G("post.title"));
	  	$paperid = ChkSQL(KS_G("post.paperid"));
	  	$Data['content'] = Src(ChkSQL(KS_G("post.content")));
	  	$Data['status'] = ChkClng(KS_G('post.status'));
	  	$taskModel = M('app_task');
	  	$Rule['title']        = '作业名称|isEmpty';
	  	Chkpost($Data,$Rule,$taskModel);
	  	$taskModel->update($Data,'id ='.$id);
	 	$url1=M_URL($this->AppName.'/Index','task',$courseid,GP('p-'.$now_page));
	  	KS_INFO("编辑成功",3,$url1);
    }
    //进行删除
    public function delTaskAction(){
	    $now_page  = ChkClng(KS_S('p'));
	    $courseid  = ChkClng(null !==GF('courseid') ? GF('courseid'):'0');
	    $taskModel = M('app_task');
	    $id = ChkClng(KS_G('get.id'));
	    $taskModel->delete('id ='.$id);
	    $url1=M_URL($this->AppName.'/Index','task',$courseid,GP('p-'.$now_page));
	    KS_INFO("删除成功",0,$url1);
	}
	//批量删除
    public function bathdelTaskAction(){
	    $id = ChkSQL(KS_G("post.taskid"));
	    $taskModel = M('app_task');
	    $courseid = ChkClng(null !==GF('courseid') ? GF('courseid'):'0');
	    if(empty($id)){KS_INFO('请选择',0,'','',1);}
	    $now_page = ChkClng(KS_S('p',1));
	 	foreach($id as $k=>$v){
		    $taskModel->delete('id ='.$v);
	 	}
	  	$url1=M_URL($this->AppName.'/Index','task',$courseid,GP('p-'.$now_page));
	  	KS_INFO("删除成功",0,$url1);
    }
	//进入上传
	public function uploadfileAction(){
		$courseid = ChkClng(KS_G('get.id'));
		$course   = $this->AppModel->getRow('where courseid ='.$courseid.' limit 1');
		include  CURR_VIEW_PATH . "uploadfile.php";
	}
	//进入知识点
	public function kpointAction(){
	   	$courseid     = ChkClng(KS_G('get.id'));
		$course       = $this->AppModel->getRow('where  courseid ='.$courseid);
		$chapterModel = M($course['chaptertable']);
		$chapters     = $chapterModel->getAll('where  courseid ='.$courseid);
		$kption       = array();
		$kpoints      = array();
		foreach($chapters as $k=>$v){
			$kp = explode(',',$v['kpointIds']);
		    if(isset($kp)){
				foreach($kp as $kt=>$vt){
					if(!in_array($vt,$kpoints)){array_push($kpoints,$vt);}
				}
		    }
		}
		$kpoints = implode(',',$kpoints);
		$kptionModel = M('app_knowledge');
		if(!empty($kpoints)){
		   $where   ="where  id in ($kpoints)";
		   $options = $kptionModel->getOptions('5',$where);//分页参数设置
		   $page    = Page($options);
		   $kption  = $kptionModel->getPage($page,'id desc',$where);
		}else{
			$page    = Page();
		}
		include  CURR_VIEW_PATH . "kption.php";
	}
	//删除课程知识点
	public function delKpointAction(){
		$courseid = null !==GF('courseid') ? GF('courseid'):'';
		$now_page = ChkClng(KS_S('p',1));
		$id =ChkClng(KS_G('get.id'));
		$kpointModel =M('app_knowledge');
		$kpointModel->delete('id ='.$id);
		$url = M_URL($this->AppName.'/Index','kpoint',$courseid,GP('p-'.$now_page));
		KS_INFO('删除成功',0,$url);
	}
	//批量删除
	public function batchKpointAction(){
		$now_page = ChkClng(KS_S('p',1));
		$id = ChkClng(KS_G('get.id'));
		$id = ChkSQL(KS_G('post.aid'));
		$courseid =ChkClng(KS_G('get.id'));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$batch       = ChkClng(KS_G('post.batch'));
		$url = M_URL($this->AppName.'/Index','kpoint',$courseid,GP('p-'.$now_page));
		$knowModel = M('app_knowledge');
		 if($batch ==1){
			foreach($id as $k=>$v){
				    $id = ChkClng($v);
				    $knowModel->delete("id=$v");
			}
			KS_INFO('删除成功',0,$url);
		}
	}
	//课程应用配置
	public function settingAction(){
	    $setting = getSet($this->wxid,$this->appid);//获取网站配置
		include  CURR_VIEW_PATH . "setting.php";
	}
	//修改配置
	public function doSettingAction(){
		$setting = getSet($this->wxid,$this->appid);//获取网站配置
		$setting[0] = ChkClng(KS_G('post.setting0'));//是否开启
		$setting[1] = ChkClng(KS_G('post.setting1'));//课程是否需要审核
		$setting[2] = ChkClng(KS_G('post.setting2'));//是否开启分类
		$setting[3] = ChkClng(KS_G('post.setting3'));//是否开启直播
		$setting[4] = ChkClng(KS_G('post.setting4'));//是否开启点播
		$setting[5] = ChkClng(KS_G('post.setting5'));//是否开启混合
		$Data['setting'] = implode('|',$setting);
		$apprelateModel         = M('common_app_userrelate');
	    $apprelateModel->update($Data,'wxid='.$this->wxid.' and appid = '.$this->appid);
		KS_INFO('保存成功',6);
	}
	//进入课程资料
	public function informationAction(){
		$type         = null !== GF('type') ? GF('type'):0;
		$courseid     = ChkClng(KS_G('get.id'));
		$course       = $this->AppModel->getRow('where  courseid ='.$courseid);
		$cache  = new \Core\Cache();
		$uploadtableid = $cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		$extends_table = M('common_extends_table');
		$tablename = $extends_table->getOne('tablename','where tableid='.$uploadtableid);
		$fileModel = M($tablename);
		$courseFile =M('app_course_file');
	    $where= "as a left join $fileModel->table as b on a.fileid=b.id  where  a.wxid = $this->wxid and a.courseid =$courseid  ";
	    $keyword = KS_S('keyword');
        if(!empty($keyword)){
          	$where.=" and b.filename like '%$keyword%'";
        }
		$where.=' group by a.fileid order by a.id desc';
		$file =  $courseFile->getAll($where,'b.*,a.*');
		$options['maxperpage']  = null !=ChkClng(KS_G('request.maxperpage')) ? ChkClng(KS_G('request.maxperpage')):'5';
	    $options['totalput']   = count($file);
		$page    = Page($options);
		$files   = $page->arrayPage($file);
		if(isset($files)){foreach($files as $k=>$v){
					$fileName = explode('.',$v['filename']);
					$ext = isset($fileName[1]) ? $fileName[1] : '0';
					if($ext == 'txt'){
						$files[$k]['src']='/Public/uploads/common/TXT.png';
					}elseif($ext == 'mp4'){
						$files[$k]['src']='/Public/uploads/common/MOV.png';
					}elseif($ext == 'mp3'){
						$files[$k]['src']='/Public/uploads/common/MP3.png';
					}elseif($ext == 'doc' || $ext == 'docx' ){
						$files[$k]['src']='/Public/uploads/common/DOC.png';
					}elseif( $ext == 'pdf' ){
						$files[$k]['src']='/Public/uploads/common/PDF.png';
					}elseif($ext == 'PPT' || $ext == 'pptx'){
						$files[$k]['src']='/Public/uploads/common/PPT.png';
					}elseif($ext == 'rar' || $ext == 'zip'){
						$files[$k]['src']='/Public/app/images/classIcon/zip.png';
					}else{
						$files[$k]['src']=$v['filePath'];
					}
		}
		}
		include  CURR_VIEW_PATH . "knowledge.php";exit;
		include  CURR_VIEW_PATH . "course_file.php";
	}
	//进入添加资料
	public function coursefileAction(){
    	$type   = null !== GF('type') ? GF('type'):'5';
    	$courseid       = null !== GF('courseid') ? GF('courseid'):0;
		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		$tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
		$fileModel     = M($tablename);
        $where ='where wxid = '.$this->wxid;
        $where.=' and  id not in(select fileid from ks_app_course_file  where wxid='.$this->wxid.' and courseid='.$courseid .')';
		if($type == 2){
			$where.=' and type =2';
		}elseif($type == 3){
			$where.=' and  type =3';
		}elseif($type == 4 ){
			$where.=' and  type =4';
		}elseif($type == 5){
			$where.=' and  type =5';
		}elseif($type == 1){
			$where.=' and  type =1';
		}elseif($type == 6){
			$where.=' and  type =6';
		}elseif($type == 7){
			$where.=' and  isMaterial =1';
		}
		$options = $fileModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$values  = $fileModel->getPage($page,'id desc',$where);
    	include  CURR_VIEW_PATH . "class_file.php";
    }
	//添加资料
	public function doAddfileAction(){
		$id = ChkSQL(KS_G('post.file'));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$model =M('app_course_file');
		$Data['courseid']=$this->courseid;
		$Data['wxid']=$this->wxid;
		$Data['adddate']=time();
		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		$tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
		$files         = M($tablename);
		foreach($id as $k=>$v){
			$file = $files->getRow("where id=$v and wxid=$this->wxid");
			$Data['fileid'] = $v;
			$Data['title'] = $file['filename'];
			$Data['file_name'] = $file['filename'];
			$Data['size'] = $file['size'];
			$Data['isopen'] = 0;
			$model->doAdd($Data,'id');
		}
		$url = M_URL($this->AppName.'/Index','information',$this->courseid,GP(''));
		KS_INFO('添加成功',3,$url);
	}
	//删除课程资料
	public function delfileAction(){
		$id        = ChkClng(KS_G('get.id'));
		$courseid  = null !==GF('courseid') ? GF('courseid'):0;
		$fileModel = M('app_course_file');
		$now_page  = ChkClng(KS_S('p',1));
		$fileModel->delete('courseid = '.$courseid.' and fileid ='.$id);
		$url = M_URL($this->AppName.'/Index','information',$courseid,GP('p-'.$now_page));
		KS_INFO('删除成功',0,$url);
	}
	//批量删除
	public function batchfileAction(){
		$id = ChkSQL(KS_G('post.id'));
		if(empty($id)){KS_INFO("请选择",0,'','',1);}
		$courseid = ChkClng(KS_G('get.id'));
		$fileModel= M('app_course_file');
		$now_page = ChkClng(KS_S('p',1));
		foreach($id as $k=>$v){
			$fileModel->delete('courseid = '.$courseid.' and fileid ='.ChkClng($id));
		}
		$url = M_URL($this->AppName.'/Index','information',$courseid,GP('p-'.$now_page));
		KS_INFO('删除成功',0,$url);
	}
}