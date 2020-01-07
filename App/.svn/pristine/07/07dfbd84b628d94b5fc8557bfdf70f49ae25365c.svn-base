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
	/*
	 * 咨询本记录
	 */
	public function manageindexAction(){
			$schooladdress = M('app_schooladdress');
			$schoolary = $schooladdress->getAll('where wxid='.$this->wxid,'schoolid,school');
			$channel = M('app_consultation_channel');
			$channelary=$channel->getAll('where wxid='.$this->wxid);
		    $channelid = ChkClng(null !==GF('channelid') ? GF('channelid'):'0');
		    $address   = ChkClng(null !==GF('address') ? GF('address'):'0');
		    $classify  = ChkClng(null !==GF('classify') ? GF('classify'):'0');
		    $intentionality = ChkClng(null !==GF('intentionality') ? GF('intentionality'):'5');
		    $status = ChkClng(null !==GF('status') ? GF('status'):'6');
		    $keyword = KS_S('keyword');
			$keytype = ChkClng(KS_S('keytype'));
			$timetype = ChkClng(null !==GF('timetype') ? GF('timetype'):'0');
			$result = ChkClng(null !==GF('result') ? GF('result'):'6');
			$now_page = ChkClng(KS_S('p',1));
		    if($timetype==5){
				$stattime = ChkSQL(GF('starttime'));
				$endtime = ChkSQL(GF('endtime'));
			}
		    $Data001['maxPerPage'] = 10;
		    $Data001['wxid']       = $this->wxid;
			$Data001['userid']     = $this->userid;
			$ConsultModel          = M('App/ConsultModel');
			$results               = $ConsultModel->manageindex($Data001);
			$page                  = $results['page'];
			$values                = $results['values'];
			include  CURR_VIEW_PATH . "index.php";
	}
   /*
    * 显示添加记录页面
    */
	public function addrecordAction(){
		$values='';

		$Linkage            = Linkage(array());
		$Linkage->cachename = 'appcategory';
		$Linkage->wxid      = $this->wxid;
		$Linkage->inputname = 'categoryid';// <select name='' /> 里的name值

		$link     = Linkage(array());
		$link->cachename      = 'areainfo';
		$link->inputname      = 'areaid';// <select name='' /> 里的name值
		$link->idname         = 'id';
		$link->funcname       = 'getchildtwo';
		$link->childvaluename = 'city';
		$link->childidname    = 'id';
		$channel = M('app_consultation_channel');
		$channelary=$channel->getAll('where wxid='.$this->wxid);
		$schooladdress = M('app_schooladdress');
		$school = $schooladdress->getAll('where wxid='.$this->wxid,'schoolid,school');
		$url = M_URL($this->AppName.'/Index','adduserRecord','',GP(''));
		$text='确认添加';
		include  CURR_VIEW_PATH . "addrecord.php";
	}
	/*
	 * 搜索课程或者专栏
	 */
	public function searchAction(){
		$type=ChkCLng(KS_S('key'));
		if($type==2){
			$app=M('app_column');
			$res = $app->getAll('where wxid='.$this->wxid.' and status!=-1','columnid,title');
		}elseif($type==1){
			$app=M('app_course');
			$res = $app->getAll('where wxid='.$this->wxid.' and status!=-1','courseid,title');
		}
		echo json_encode($res);
	}
	/*
	 * 显示修改
	 */
	public function editRedAction(){

		$channel = M('app_consultation_channel');
		$channelary=$channel->getAll('where wxid='.$this->wxid);
		$schooladdress = M('app_schooladdress');
		$school = $schooladdress->getAll('where wxid='.$this->wxid,'schoolid,school');
		$id=ChkClng(KS_G('request.id'));
		$values = $this->AppModel->getRow('where id='.$id);
		$areaid = 0;
		if($values['pid']!=0){
			$areaid = $values['pid'];
			if($values['cid']!=0){
				$areaid = $values['cid'];
				if($values['counid']!=0){$areaid = $values['counid'];}
			}
		}
		$link = Linkage(array());
		$link->cachename      = 'areainfo';
		$link->inputname      = 'areaid';// <select name='' /> 里的name值
		$link->idname         = 'id';
		$link->funcname       = 'getchildtwo';
		$link->childvaluename = 'city';
		$link->childidname    = 'id';
		$link->categoryid     = $areaid;
		$str='';
//		var_dump($values['coursename']);
		if($values['type']==2){
			$app=M('app_column');
			$res = $app->getAll('where wxid='.$this->wxid.' order by columnid desc','columnid,title');
			foreach($res as $k =>$v){
				if($v['columnid']==$values['coursename']){
					$str=$str.'<option value="'.$v['columnid'].'" selected>'.$v['title'].'</option>';
				}else{
					$str=$str.'<option value="'.$v['columnid'].'">'.$v['title'].'</option>';
				}

			}
		}elseif($values['type']==1){
			$app=M('app_course');
			$res = $app->getAll('where wxid='.$this->wxid.' order by courseid desc','courseid,title');
			foreach($res as $k =>$v){
				if($v['courseid']==$values['coursename']){
					$str=$str.'<option value="'.$v['courseid'].'" selected>'.$v['title'].'</option>';
				}else{
					$str=$str.'<option value="'.$v['courseid'].'">'.$v['title'].'</option>';
				}

			}
		}
//		var_dump($str);

		$text='确认修改';
		$url = M_URL($this->AppName.'/Index','doedit',$values['id'],GP(''));
		include  CURR_VIEW_PATH . "addrecord.php";
	}
	/*
	 * 修改咨询记录
	 */
	public function doeditAction(){
		$user=M('common_user_teacher');
		$id = ChkClng(KS_G('request.id'));
		$Datas['membername']=ChkSQL(KS_G('post.membername'));
		$Datas['mobile']=ChkSQL(KS_G('post.mobile'));
		$Datas['email']=ChkSQL(KS_G('post.email'));
		$Datas['sex']=ChkClng(KS_G('post.Sex'));
		$Datas['wxnumber']=ChkSQL(KS_G('post.wxnumber'));
		$Datas['classify']=ChkClng(KS_G('post.classify'));
		$Datas['type']=ChkClng(KS_G('post.type'));
		$Datas['coursename']=ChkClng(KS_G('post.coursename'));
		$Datas['relationship']=ChkClng(KS_G('post.relationship'));
		$Datas['channel']=ChkClng(KS_G('post.channel'));
		$Datas['schoolroomid']=ChkClng(KS_G('post.schoolroomid'));
		$Datas['active']=ChkClng(KS_G('post.isactive'));
		$Datas['intentionality']=ChkClng(KS_G('post.intentionality'));
		$Datas['status']=ChkClng(KS_G('post.status'));
		$Datas['emergency']=ChkSQL(KS_G('post.parentname'));
		$Datas['emergencymobile']=ChkClng(KS_G('post.parentmobile'));
		$Datas['nexttime']=strtotime(KS_G('post.nexttime'));
		$Datas['mark']=ChkSQL(KS_G('post.mark'));
		$Datas['wxid']=$this->wxid;
		$Datas['userid']=$this->userid;
		if(ChkSQL(KS_G('post.teachername'))){
			$Datas['teachername']=ChkSQL(KS_G('post.teachername'));
		}else{
			if($Datas['coursename']){
				if($Datas['type']==1){
					$app=M('app_course');
		        	$Datas['teachername'] = $app->getOne('b.name','as a left join '.$user->table.' as b on a.teacherid=b.userid where a.courseid='.$Datas['coursename']);

				}elseif($Datas['type']==2){
			        $Datas['teachername'] = '-';

				}
			}
		}
		$areaModel = M('common_area');
		$areaid = ChkClng(KS_G('post.areaid'));
		if($areaid!=0){
			$depth = $areaModel->getOne('depth',"where id=$areaid");
			if($depth==3){
				$Datas['counid']   = $areaid;
				$Datas['cid']     = $areaModel->getOne('parentid',"where id=$Datas[counid]");
				$Datas['pid'] = $areaModel->getOne('parentid',"where id=$Datas[cid]");
			}elseif($depth==2){
				$Datas['counid']   = 0;
				$Datas['cid']     = $areaid;
				$Datas['pid'] = $areaModel->getOne('parentid',"where id=$Datas[cid]");
			}elseif($depth==1){
				$Datas['counid']   = 0;
				$Datas['cid']     = 0;
				$Datas['pid'] = $areaid;
			}
		}
		$Rule['mobile'] = '会员电话|isEmpty,isDbexis,isMobile';
		$Rule['membername'] = '姓名|isEmpty';
		Chkpost($Datas,$Rule,$this->AppModel,'wxid='.$this->wxid.' and id!='.$id);//检测账号是否存在；
		$this->AppModel->update($Datas,'id='.$id);
		$url=M_URL($this->AppName.'/Index','manageindex','',GP(''));
		KS_INFO("修改成功",0,$url);
	}
	/*
	 * 添加咨询记录
	 */
	public function adduserRecordAction(){
		 $user=M('common_user_teacher');
		$Datas['membername']=ChkSQL(KS_G('post.membername'));
		$Datas['mobile']=ChkSQL(KS_G('post.mobile'));
		$Datas['email']=ChkSQL(KS_G('post.email'));
		$Datas['sex']=ChkClng(KS_G('post.Sex'));
		$Datas['wxnumber']=ChkSQL(KS_G('post.wxnumber'));
		$Datas['classify']=ChkClng(KS_G('post.classify'));
		$Datas['type']=ChkClng(KS_G('post.type'));
		$Datas['coursename']=ChkClng(KS_G('post.coursename'));
		$Datas['relationship']=ChkClng(KS_G('post.relationship'));
		$Datas['channel']=ChkClng(KS_G('post.channel'));
		$Datas['schoolroomid']=ChkClng(KS_G('post.schoolroomid'));
		$Datas['active']=ChkClng(KS_G('post.isactive'));
		$Datas['intentionality']=ChkClng(KS_G('post.intentionality'));
		$Datas['status']=ChkClng(KS_G('post.status'));
		$Datas['emergency']=ChkSQL(KS_G('post.parentname'));
		$Datas['emergencymobile']=ChkClng(KS_G('post.parentmobile'));
		$Datas['nexttime']=strtotime(KS_G('post.nexttime'));
		$Datas['mark']=ChkSQL(KS_G('post.mark'));
		$Datas['wxid']=$this->wxid;
		$Datas['userid']=$this->userid;
		$Datas['adddate']=time();
		if(ChkSQL(KS_G('post.teachername'))){
			$Datas['teachername']=ChkSQL(KS_G('post.teachername'));
		}else{
			if($Datas['coursename']){
				if($Datas['type']==1){
					$app=M('app_course');
		        	$Datas['teachername'] =$app->getOne('b.name','as a left join '.$user->table.' as b on a.teacherid=b.userid where a.courseid='.$Datas['coursename']);

				}elseif($Datas['type']==2){
                    $Datas['teachername'] = '-';

				}
			}
		}
		$areaModel = M('common_area');
		$areaid = ChkClng(KS_G('post.areaid'));
		if($areaid!=0){
			$depth = $areaModel->getOne('depth',"where id=$areaid");
			if($depth==3){
				$Datas['counid']   = $areaid;
				$Datas['cid']     = $areaModel->getOne('parentid',"where id=$Datas[counid]");
				$Datas['pid'] = $areaModel->getOne('parentid',"where id=$Datas[cid]");
			}elseif($depth==2){
				$Datas['counid']   = 0;
				$Datas['cid']     = $areaid;
				$Datas['pid'] = $areaModel->getOne('parentid',"where id=$Datas[cid]");
			}elseif($depth==1){
				$Datas['counid']   = 0;
				$Datas['cid']     = 0;
				$Datas['pid'] = $areaid;
			}
		}
		$Rule['mobile'] = '电话号码|isEmpty,isDbexis,isMobile';
		$Rule['membername'] = '姓名|isEmpty';
		Chkpost($Datas,$Rule,$this->AppModel,'wxid='.$this->wxid);//检测账号是否存在；
		$this->AppModel->doadd($Datas,'id');
		$url=M_URL($this->AppName.'/Index','manageindex','',GP(''));
		KS_INFO("添加成功",3,$url);
	}
	/*
	 * 放弃咨询
	 */
	public function delRecAction(){

		$now_page = ChkClng(KS_S('p',1));
		$id = ChkClng(KS_G('request.id'));
		$Datas['status']=2;
		$this->AppModel->update($Datas,'id='.$id);
		$url=M_URL($this->AppName.'/Index','manageindex','',GP('p-'.$now_page));
		ks_header($url);
	}
	/*
	 * 批量放弃咨询
	 */
	public function forgivesomeAction(){
		$now_page = ChkClng(KS_S('p'));
		$id=ChkSQL(KS_G('post.id'));
		$Datas['status']=2;
		foreach($id as $k=>$v){
		  	$this->AppModel->update($Datas,'id='.$v);
		}
		$url=M_URL($this->AppName.'/Index','manageindex','',GP( 'p-'.$now_page));
		KS_INFO("操作成功",3,$url);
	}
	/*渠道管理页面*/
	public function showchannelAction(){
		$now_page = ChkClng(KS_S('p'));
		$Data007['wxid']       = $this->wxid;
		$Data007['now_page']   = $now_page;
		$ConsultModel          = M('App/ConsultModel');
		$results               = $ConsultModel->channelShow($Data007);
		$page                  = $results['page'];
		$infoary               = $results['values'];
        include  CURR_VIEW_PATH . "channel.php";
	}
	/*添加渠道页面*/
	public function showchanneladdAction(){
		$id=ChkClng(KS_G('request.id'));
		$Model = M('app_consultation_channel');
		if($id){
			$values = $Model->getRow('where id='.$id);
		}
        include  CURR_VIEW_PATH . "channel_add.php";
	}
	/*添加渠道*/
	public function doAddChannelAction(){
		$channel = ChkSQL(KS_G('post.channel'));
		$Data010['channel'] =$channel;
		$Data010['wxid'] = $this->wxid;
		$Data010['userid'] = $this->userid;
		$ConsultModel          = M('App/ConsultModel');
		$results               = $ConsultModel->addChannel($Data010);
		$url=M_URL($this->AppName.'/Index','showchannel','',GP(''));
		if($results){KS_INFO("添加成功",3,$url);}
		KS_INFO("添加失败，名字已存在",0,$url,'',1);
	}
	/*修改渠道*/
	public function doEditChannelAction(){
		$now_page = ChkClng(KS_S('p'));
		$channel = ChkSQL(KS_G('post.channel'));
		$id=ChkClng(KS_G('request.id'));
		$Data013['channel']    = $channel;
		$Data013['id']         = $id;
		$Data013['wxid']       = $this->wxid;
		$ConsultModel          = M('App/ConsultModel');
		$results               = $ConsultModel->editChannel($Data013);
		$url=M_URL($this->AppName.'/Index','showchannel','',GP('p-'.$now_page));
		if($results){KS_INFO("修改成功",3,$url);}
		KS_INFO("修改失败，名字已存在",0,$url,'',1);
	}
	/*删除渠道*/
	public function deletechannelAction(){
		$now_page = ChkClng(KS_S('p'));
		$id=ChkClng(KS_G('request.id'));
		$Data008['id']       = $id;
		$ConsultModel          = M('App/ConsultModel');
		$results               = $ConsultModel->deleteChannel($Data008);
		$url=M_URL($this->AppName.'/Index','showchannel','',GP('p-'.$now_page));
		ks_header($url);
	}
	public function batchAction(){
		$now_page = ChkClng(KS_S('p'));
		$id=ChkSQL(KS_G('post.id'));
		$Model = M('app_consultation_channel');

		foreach($id as $k =>$v){
			$res = $Model->delete('id='.$v);
		}
		$url=M_URL($this->AppName.'/Index','showchannel','',GP('p-'.$now_page));
		KS_INFO('批量操作成功',0,$url);
	}
	/*咨询池页面*/
	public function consultingPoolAction(){
	    $schooladdress = M('app_schooladdress');
		$schoolary = $schooladdress->getAll('where wxid='.$this->wxid,'schoolid,school');
		$channel = M('app_consultation_channel');
		$channelary=$channel->getAll('where wxid='.$this->wxid);
		$address = ChkClng(null !==GF('address') ? GF('address'):'0');
		$channelid = ChkClng(null !==GF('channelid') ? GF('channelid'):'0');
		$classify = ChkClng(null !==GF('classify') ? GF('classify'):'0');
		$intentionality = ChkClng(null !==GF('intentionality') ? GF('intentionality'):'5');
		$keyword = KS_S('keyword');
		$keytype = ChkClng(KS_S('keytype'));
		$result = ChkClng(null !==GF('result') ? GF('result'):'4');
		$now_page = ChkClng(KS_S('p'));

	    $Data004['maxPerPage'] = 10;
	    $Data004['wxid']       = $this->wxid;
		$ConsultModel          = M('App/ConsultModel');
		$results               = $ConsultModel->consultingPool($Data004);
		$page                  = $results['page'];
		$values                = $results['values'];
		include  CURR_VIEW_PATH . "consultingPool.php";
	}
	/*
	 * 咨询池领取
	 */
	public function receiveAction(){
		$id=ChkClng(KS_G('request.id'));
		$now_page = ChkClng(KS_S('p'));
		$type = ChkClng(GF('type'));
	    $Data006['userid']       = $this->userid;
	    $Data006['id']       = $id;
		$ConsultModel          = M('App/ConsultModel');
		$results               = $ConsultModel->receive($Data006);
		$url=M_URL($this->AppName.'/Index','consultingPool','',GP('p-'.$now_page));
		if($type){
			$url=M_URL($this->AppName.'/Index','invalidpool','',GP('p-'.$now_page));
		}
		ks_header($url);
	}
	/*批量领取*/
	public function getsomeAction(){
		$now_page = ChkClng(KS_S('p'));
		$id=ChkSQL(KS_G('post.id'));
		$Datas['status']=0;
		$data['userid'] = $this->userid;
		foreach($id as $k=>$v){
		  	$this->AppModel->update($Datas,'id='.$v);
		}
		$url=M_URL($this->AppName.'/Index','consultingPool','',GP('p-'.$now_page));
		KS_INFO("批量操作成功",3,$url);
	}
	/*加入试听，改变回访结果*/
	public function addlestionAction(){
		$id=ChkClng(KS_G('request.id'));
		$now_page = ChkClng(KS_S('p'));

		$data['restult']=3;
		$data['status']=1;
		$this->AppModel->update($data,'id='.$id);
		$userinfo['memberid']= $id;
		$userinfo['adddate'] = time();
		$listion = M('app_consultation_listen');
		$Rule['memberid'] = '该咨询人试听记录|isDbexis';
		$checkfinal=Chkpost($userinfo,$Rule,$listion,'',4);//检测账号是否存在；
		$listion ->doadd($userinfo,'id');
		$url=M_URL($this->AppName.'/Index','manageindex','',GP('p-'.$now_page));
		KS_INFO('加入成功',0,$url);
	}
	/*试听管理页面*/
	public function listenManagementAction(){
		$schooladdress = M('app_schooladdress');
		$schoolary = $schooladdress->getAll('where wxid='.$this->wxid,'schoolid,school');
		$address = ChkClng(null !==GF('address') ? GF('address'):'0');

		$listion = M('app_consultation_listen');
		$where = 'as a left join '.$this->AppModel->table.' as b on a.memberid=b.id where b.wxid='.$this->wxid;
		if($address!=0){
			$where.=' and b.schoolroomid='.$address;
		}
		$classify = ChkClng(null !==GF('classify') ? GF('classify'):'0');
		if($classify!=0){
			$where.=' and b.classify='.$classify;
		}
		$status = ChkClng(null !==GF('status') ? GF('status'):'4');
		if($status!=4){
			$where.=' and a.status='.$status;
		}
		$keyword = KS_S('keyword');
		$keytype = ChkClng(KS_S('keytype'));
		$timetype = ChkClng(null !==GF('timetype') ? GF('timetype'):'0');
		if($keyword){
				$where.=' and b.membername like "%'.$keyword.'%"';
		}
		if($timetype==1){
			$endtime = mktime(0, 0 , 0,date("m"),date("d")+1,date("Y"));
			$stattime = mktime(0, 0 , 0,date("m"),date("d"),date("Y"));

		}elseif($timetype==2){
			$endtime = mktime(0, 0 , 0,date("m"),date("d")+2,date("Y"));
			$stattime = mktime(0, 0 , 0,date("m"),date("d")+1,date("Y"));
		}elseif($timetype==3){
			$endtime = mktime(0, 0 , 0,date("m"),date("d")+4,date("Y"));
			$stattime = mktime(0, 0 , 0,date("m"),date("d"),date("Y"));
		}elseif($timetype==4){
			$endtime = mktime(0, 0 , 0,date("m"),date("d")+8,date("Y"));
			$stattime = mktime(0, 0 , 0,date("m"),date("d"),date("Y"));
		}elseif($timetype==5){
			$stattime = ChkSQL(GF('starttime'));
			$endtime = ChkSQL(GF('endtime'));
		}
		if($timetype!=0){
			$where.= ' and (a.listentime<'.$endtime.' and a.listentime >'.$stattime.')';
		}
		$now_page = ChkClng(KS_S('p'));
		$options = $listion->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $listion->getPage($page,'id desc',$where,'a.*,b.membername,b.mobile,b.coursename,b.schoolroomid,b.channel,b.classify,b.type');
		foreach($values as $k =>$v){
			if($v['type']==2){
				$app=M('app_column');
				$values[$k]['coursename'] ='【专栏】'. $app->getOne('title','where columnid='.$v['coursename']);
			}else{
				$app=M('app_course');
				$values[$k]['coursename'] ='【课程】'. $app->getOne('title','where courseid='.$v['coursename']);
			}
			if($v['teacherid']){
				$teacher = M('common_user_teacher');
				$values[$k]['teacherid'] = $teacher->getOne('name','where userid='.$v['teacherid']);
			}
			if($v['classroomid']){
				$roomaddress = M('app_classroom');
		        $values[$k]['classroomid'] = $roomaddress->getOne('classroomname','where id='.$v['classroomid']);
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

		include  CURR_VIEW_PATH . "listenmanagement.php";
	}
	/*
	 * 显示安排试听页面
	 */
	public function arrangeAction(){
		$id=ChkClng(KS_G('request.id'));
		$listenid=ChkClng(GF('listenid'));
		$now_page = ChkClng(KS_S('p'));
		$type = ChkClng(KS_S('type',1));
		$usernfo = $this->AppModel->getRow('where id='.$id);
			if($usernfo['type']==2){
				$app=M('app_class_teacherrelate');
				$userModel = M('common_user_teacher');
				$where = 'as a left join '.$userModel->table.' as b on a.teacherid=b.userid';
				$teacher = $app->getAll($where.' where a.classid='.$usernfo['coursename'],'a.teacherid,b.name');
			}else{
				$app=M('app_course_teacherrelate');
				$userModel = M('common_user_teacher');
				$where = 'as a left join '.$userModel->table.' as b on a.teacherid=b.userid';
				$teacher = $app->getAll($where.' where a.courseid='.$usernfo['coursename'],'a.teacherid,b.name');
			}
		if($usernfo['schoolroomid']){
			$roomaddress = M('app_classroom');
		    $roomAry = $roomaddress->getAll('where schoolname='.$usernfo['schoolroomid'] .' and wxid='.$this->wxid);
		}
		$oldinfo=array();
		if($type==2){
		   $listion = M('app_consultation_listen');
		   $oldinfo = $listion->getRow('where id='.$listenid);
		}

		include CURR_VIEW_PATH.'arrange.php';
	}
	/*
	 * 安排听课添加数据库
	 */
    public function arrangedataAction(){
    	$id=ChkClng(KS_G('request.id'));
    	$type = ChkClng(KS_S('type',1));
    	$data['classroomid'] = ChkClng(KS_G('post.classroomid'));
    	$data['listentime'] = strtotime(ChkSQL(KS_G('post.listentime')));
    	if($type==1){
    		$data['status'] = 1;
    	}
     	$data['teacherid'] = ChkClng(KS_G('post.teacherid'));
    	$listion = M('app_consultation_listen');
		$listion->update($data,'id='.$id);
		$now_page = ChkClng(KS_S('p'));
		$url=M_URL($this->AppName.'/Index','listenmanagement','',GP('p-'.$now_page));
		KS_INFO("添加成功",3,$url);
    }
	/*
	 * 显示添加试听结果页面
	 */
	public function addauditionAction(){
		$id=ChkClng(KS_G('request.id'));

		include  CURR_VIEW_PATH . "audition.php";
	}
	/*
	 * 添加试听结果
	 */
	public function addresultredAction(){
		$id=ChkClng(KS_G('request.id'));
		$now_page = ChkClng(KS_S('p'));
		$satisfaction = ChkClng(KS_G('post.satisfaction'));
		$mark = ChkSQL(KS_G('post.mark'));
		$status = ChkSQL(KS_G('post.status'));
		$Data['mark'] = $mark;
		$Data['status'] = $status;
		$Data['satisfaction'] = $satisfaction;
		$listion = M('app_consultation_listen');
		$listion->update($Data,'id='.$id);
		$url=M_URL($this->AppName.'/Index','listenmanagement','',GP('p-'.$now_page));
		KS_INFO("添加成功",3,$url);
	}
	/*
	 * 单个删除试听记录
	 */
	public function deleteListenAction(){
		$id=ChkClng(KS_G('request.id'));
		$listion = M('app_consultation_listen');
		$listion->delete('id='.$id);
		$now_page = ChkClng(KS_S('p'));
		$url=M_URL($this->AppName.'/Index','listenmanagement','',GP('p-'.$now_page));
		ks_header($url);
	}
	public function delpartAction(){
		$id = ChkSQL(KS_G('post.id'));
		$listion = M('app_consultation_listen');
		foreach($id as $k =>$v){
		   $listion->delete('id='.$v);
		}
		$now_page = ChkClng(KS_S('p'));
		$url=M_URL($this->AppName.'/Index','listenmanagement','',GP('p-'.$now_page));
		KS_INFO('批量操作成功',0,$url);
	}
	 /*
	  * 显示添加回访页面
	  */
	public function returnvisitAction(){
		$id=ChkClng(KS_G('request.id'));

		$now_page = ChkClng(KS_S('p'));
		$res = $this->AppModel->getOne('membername','where id='.$id);
		include  CURR_VIEW_PATH . "returnvisit.php";
	}
	/*
	 * 添加回访记录
	 */
	public function addreturnredAction(){

		$now_page = ChkClng(KS_S('p'));
		$id=ChkClng(KS_G('request.id'));
		$Data009['lasttime']=strtotime(KS_G('post.lasttime'));
		$Data009['nexttime']=strtotime(KS_G('post.nexttime'));
		$Data009['mark']=ChkSQL(KS_G('post.mark'));
		$Data009['id']       = $id;
		$Data009['restult']       = KS_G('post.restult');
		$Data009['userid']       = $this->userid;
		$ConsultModel          = M('App/ConsultModel');
		$results               = $ConsultModel->addReturnvisit($Data009);
		$url=M_URL($this->AppName.'/Index','manageindex','',GP('p-'.$now_page));
		KS_INFO("保存成功",3,$url);
	}
	/*
	 * 查看回访的沟通记录
	 */
	public function returnlistAction(){
		$id=ChkClng(KS_G('request.id'));
		$appmodel = M('app_consultation_record');
		$teacher = M('common_user_teacher');
		$where = 'as a left join '.$teacher->table.' as b on a.teacherid=b.userid where a.userid='.$id;
		$now_page = ChkClng(KS_S('p'));
		$options = $appmodel->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $appmodel->getPage($page,'id desc',$where,'a.*,b.name');
		include  CURR_VIEW_PATH . "returnlist.php";
	}
	/*
	 * 查看详细信息
	 */
	public function consultingdetailsAction(){
		$now_page = ChkClng(KS_S('p'));
		$id=ChkClng(KS_G('request.id'));
		$Data002['id']=$id;
		$ConsultModel          = M('App/ConsultModel');
			$results               = $ConsultModel->getDetail($Data002);
			$userinfo2                  = $results['userinfo2'];
			$wordAry                = $results['wordAry'];
		include  CURR_VIEW_PATH . "consultingdetails.php";
	}
//	/*
//	 * 成单 更改状态
//	 */
//	public function orderFormAction(){
//
//		$now_page = ChkClng(KS_S('p'));
//		$id = ChkClng(KS_G('request.id'));
//		$data['status'] = 3;
//		$userinfo = $this->AppModel->update($data,' id='.$id);
//		$url=M_URL($this->AppName.'/Index','manageindex','',GP( 'p-'.$now_page));
//		ks_header($url);
//	}

	/*
	 * 咨询成单，添加进user表
	 */
	public function signupAction(){

		$now_page = ChkClng(KS_S('p'));
		$id = ChkClng(KS_G('request.id'));
		//更改状态
		$data['status'] = 3;
		$data['restult'] = 4;
		$data['lasttime'] = time();
	    $this->AppModel->update($data,' id='.$id);
		//加入学员表
		$userinfo = $this->AppModel->getRow('where id='.$id);
		$Data['username']     = $userinfo['mobile'];
			$Data['password']     = '123456';
			$Data['rndpasswordc'] = rand(100000,999999);
			$Data['email']        = $userinfo['email'];
			$Data['mobile']       = $userinfo['mobile'];
			$Data['status']       = 1;
			$Data['regdate']      = ChkClng(time());
			$Data['usertype']     = 0;
			$Data['powertype']    = 0;
			$Data['wxid']         = $this->wxid;
			$Data['password']     = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));
			$userModel = M('common_user');
			$Rule['username'] = '该学员|isDbexis,isEmpty';
		    Chkpost($Data,$Rule,$userModel,'wxid='.$this->wxid);//检测账号是否存在；
			$count = $userModel->getOne('count(*)','where usertype=0 and wxid='.$this->wxid);
			$num=wx_version_itemvalue(23,'',2);
			if($count>=$num){
				$result['errcode'] = '0';//token 出错，请重新登录
        	    $result['errmsg']  = '添加失败。当前套餐允许添加'.$num.'人,请升级套餐。网校已有学员'.$count.'人';
        	    return $result;
			}
			$result = $userModel->doAdd($Data,'userid');
			//插入第二张表//地区联动数据
			$Datas['userid'] = $result;
			$Datas['countyid'] = $userinfo['counid'];
			$Datas['cityid'] = $userinfo['cid'];
			$Datas['provinceid'] = $userinfo['pid'];
			$tableModel = M('common_table');
		    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
			$Datas['name'] = $userinfo['membername'];
				$Datas['Sex'] = $userinfo['sex'];
			/*----------------------字段拼接测试中------------------------------*/
			$fieldModel = M('common_table_field');//实例化字段表
			$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
			foreach($Field as $Fk => $Fv){
			    $fieldname = $Fv['fieldname'];
			    $Datas[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
			    if($Fv['mustinput']==1)
			    {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
			}
		   	$Datas['emergencyContact']  = $userinfo['emergency'];
			$Datas['emergencyContactTel'] = $userinfo['emergencymobile'];
			$AppModel = M('common_user_member');
			$AppModel->doEfAdd($Datas);
			$url=M_URL($this->AppName.'/Index','manageindex','',GP('p-'.$now_page));
		    KS_INFO('加入成功',0,$url);
	}
	/*显示批量导入页面*/
    public function ImportAction(){
		$now_page = ChkClng(KS_S('p'));
    	include  CURR_VIEW_PATH . "excel.php";
    }
	/*批量导入*/
    public function doExcelAction(){
		$now_page = ChkClng(KS_S('p'));
        if(!empty($_FILES['execl']['tmp_name'])){
			$this->upload->savePath = 'users/excel/'.$this->wxid.'/'; // 设置附件上传（子）目录
			$this->upload->exts =array('xls','xlsx','csv');// 设置附件上传类型
			$info = $this->upload->uploadOne($_FILES['execl']);
			if(!$info) {// 上传错误提示错误信息
				KS_INFO($this->upload->getError(),0,'','',1);
			}else{
				$execl = ChkSQL($this->upload->rootPath.$info['savepath'].$info['savename']);//应用封面图片
			}
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
        //excel导入学员
        $sheet           = $objPHPExcel->getSheet(0);  //取得sheet(0)表
		$highestRow      = $sheet->getHighestRow();    // 取得总行数
		$highestColumn   = $sheet->getHighestColumn(); // 取得总列数
		$userModel       = M('common_user');
		$userMemberModel = M('common_user_member');
     //  var_dump($highestRow.'dfdf');
		for($i=2;$i<=$highestRow;$i++){

			$data1['membername']  = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();

//			var_dump($objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue());

			$data1['mobile']          = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();

			if(empty($data1['membername'])){KS_INFO('导入失败。excel学员,序号'.($highestRow-2).'。姓名为空,请改正后再批量导入',4,'','',1);}
			if(empty($data1['mobile'])){KS_INFO('导入失败。excel学员,序号'.($highestRow-2).'。电话号码为空,请改正后再批量导入',4,'','',1);}
			if(strlen($data1['mobile'])!=11||!preg_match("/^1[34578]{1}\d{9}$/",$val)){KS_INFO('导入失败。excel学员,序号'.($highestRow-1).'的手机号格式不正确',4,'','',1);};
			$count1 = $this->AppModel->getOne('count(*)','where wxid='.$this->wxid.' and  mobile="'.$data1['mobile'].'"');
			if($count1>0){KS_INFO('导入失败。excel学员,序号'.($highestRow-1).'。咨询人号码'.$data1['mobile'].'云平台已存在',4,'','',1);}
		}
		for($i=2;$i<=$highestRow;$i++){
			 $data['membername']  = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
			 $data['mobile']    = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
			 $data['email']     = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
			 $data['wxnumber']     = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
			 $data['relationship']     = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
			 $data['active']     = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
			 $data['mark']     = $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
			 $data['sex']     = $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
			 //if(empty($data['username']) || empty($password)){continue;}
//			 var_dump($data);
//			 exit;
			 $data['userid']      = $this->userid;
			 $data['wxid']      = $this->wxid;
			 $data['adddate']      = time();
			 $userid = $this->AppModel->doAdd($data,'id');
		}
		$url=M_URL($this->AppName.'/Index','manageindex','',GP('p-'.$now_page));
		KS_INFO('导入成功',3,$url);
    }
    /*显示页面*/
    public function invalidateAction(){
		$now_page = ChkClng(KS_S('p'));
		$id= ChkClng(KS_G('request.id'));
		$res = $this->AppModel->getOne('membername','where id='.$id);
    	include  CURR_VIEW_PATH . "invalidate.php";
    }
    /*将数据设置为无效*/
    public function addinvaliAction(){
		$now_page = ChkClng(KS_S('p'));
		$id= ChkClng(KS_G('request.id'));
		$invalidatetype= ChkClng(KS_G('post.invalidatetype'));
		$mark= ChkSQL(KS_G('post.mark'));
		$Data['status']=5;
		$Data['invalidatetime'] = time();
		$Data['invalidatetype'] = $invalidatetype;
		$Data['mark'] = $mark;
		$this->AppModel->update($Data,'id='.$id);
		$url=M_URL($this->AppName.'/Index','manageindex','',GP('p-'.$now_page));
		KS_INFO('设置成功',3,$url);
    }
    /*创建无效池*/
    public function invalidpoolAction(){
		$schooladdress = M('app_schooladdress');
		$schoolary = $schooladdress->getAll('where wxid='.$this->wxid,'schoolid,school');
		$channel   = M('app_consultation_channel');
		$channelary= $channel->getAll('where wxid='.$this->wxid);
		$where     = 'where userid='.$this->userid;
		$address = ChkClng(null !==GF('address') ? GF('address'):'0');
		if($address!=0){
			$where.=' and schoolroomid='.$address;
		}
		$channelid = ChkClng(null !==GF('channelid') ? GF('channelid'):'0');
		if($channelid!=0){
			$where.=' and channel='.$channelid;
		}
		$classify = ChkClng(null !==GF('classify') ? GF('classify'):'0');
		if($classify!=0){$where.=' and classify='.$classify;}
		$keyword = KS_S('keyword');
		$keytype = ChkClng(KS_S('keytype'));
		$timetype = ChkClng(null !==GF('timetype') ? GF('timetype'):'0');
		$result = ChkClng(null !==GF('result') ? GF('result'):'6');
		$where.=' and status=5';
		if($keyword){
			$where.=' and membername like "%'.$keyword.'%"';
		}
		$now_page = ChkClng(KS_S('p'));
		$options = $this->AppModel->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $this->AppModel->getPage($page,'id desc',$where);
		foreach($values as $k =>$v){
			if($v['schoolroomid']){
				$shoolMoel =M('app_schooladdress');
			    $values[$k]['schoolroomid'] = $shoolMoel->getOne('school','where schoolid='.$v['schoolroomid']);
			}
			if($v['channel']){
				$channelModel = M('app_consultation_channel');
			    $values[$k]['channel'] = $channelModel->getOne('channel','where id='.$v['channel']);
			}
		}
    	include  CURR_VIEW_PATH . "invalidpool.php";
    }
    /*我的咨询本*/
    public function indexAction(){
    	$week      = date('W',time());//当前是的那一周
     	$year      = date('Y',time());
     	$timetypes = ChkClng(null !==GF('timetypes') ? GF('timetypes'):1);
     	$Data011['userid']    = $this->userid;
		$Data011['timetype']  = $timetypes;
		$ConsultModel         = M('App/ConsultModel');
		$result               = $ConsultModel->getUpdata($Data011);
		$waitCount=$result['waitcount'];
		$todayaddCount=$result['todayadd'];
		$todaysucceCount=$result['todaysucc'];
    	include  CURR_VIEW_PATH . "manageindex.php";
    }
    /*改变状态*/
    public function changestatusAction(){
    	$now_page = ChkClng(KS_S('p'));
    	$status   = ChkClng(GF('newstatus'));
		$id = ChkClng(KS_G('request.id'));
		$Data005['id']        = $id;
		$Data005['status']     = $status;
		$ConsultModel          = M('App/ConsultModel');
		$results               = $ConsultModel->changeStatus($Data005);
		$url=M_URL($this->AppName.'/Index','manageindex','',GP('p-'.$now_page));
		ks_header($url);
    }
    /*导出到列表*/
    public function outExcelAction(){
    	$where='where userid='.$this->userid;
		$address = ChkClng(null !==GF('address') ? GF('address'):'0');
		if($address!=0){$where.=' and schoolroomid='.$address;}
		$channelid = ChkClng(null !==GF('channelid') ? GF('channelid'):'0');
		if($channelid!=0){$where.=' and channel='.$channelid;}
		$classify = ChkClng(null !==GF('classify') ? GF('classify'):'0');
		if($classify!=0){$where.=' and classify='.$classify;}
		$intentionality = ChkClng(null !==GF('intentionality') ? GF('intentionality'):'5');
		if($intentionality!=5){$where.=' and intentionality='.$intentionality;}
		$status = ChkClng(null !==GF('status') ? GF('status'):'6');
		if($status!=6){$where.=' and  status='.$status;}else{$where.=' and status!=2 ';}
		if($Data001['keyword']){
		    $keyword = $Data001['keyword'];
		}else{
			$keyword = KS_S('keyword');
		}
		$keytype = ChkClng(KS_S('keytype'));
		$timetype = ChkClng(null !==GF('timetype') ? GF('timetype'):'0');
		$result = ChkClng(null !==GF('result') ? GF('result'):'6');
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
		$values  = $Model->getAll($where.' group by id desc','membername,mobile,coursename,schoolroomid,intentionality,channel,active,adddate,number,status,lasttime,nexttime,restult,type,classify,sex');
		foreach($values as $k =>$v){
			if($v['nexttime']){
				$values[$k]['nexttime'] = date('Y-m-d H:i:s',$v['nexttime']);
			}else{
				$values[$k]['nexttime'] = '';
			}
			if($v['lasttime']){
				$values[$k]['lasttime'] = date('Y-m-d H:i:s',$v['lasttime']);
			}else{
				$values[$k]['lasttime'] = '';
			}
			$values[$k]['adddate'] = date('Y-m-d H:i:s',$v['adddate']);
			if($v['coursename']){
				if($v['type']==2){
					$app=M('app_column');
					$values[$k]['coursename'] = '【专栏】'.$app->getOne('title','where columnid='.$v['coursename']);
				}else{
					$app=M('app_course');
					$values[$k]['coursename'] = '【课程】'.$app->getOne('title','where courseid='.$v['coursename']);
				}
			}else{$values[$k]['coursename'] = '';}

			$shoolMoel =M('app_schooladdress');
			if($v['schoolroomid']){
				$values[$k]['schoolroomid'] = $shoolMoel->getOne('school','where schoolid='.$v['schoolroomid']);
			}

			if($v['channel']){
				$channelModel = M('app_consultation_channel');
			     $values[$k]['channel'] = $channelModel->getOne('channel','where id='.$v['channel']);
			}
			if($v['intentionality']==0){$values[$k]['intentionality'] = '无';
			}elseif($v['intentionality']==1){$values[$k]['intentionality'] = '高';
			}elseif($v['intentionality']==2){$values[$k]['intentionality'] = '低';
			}elseif($v['intentionality']==3){$values[$k]['intentionality'] = '中';}

			if($v['type']==1){$values[$k]['type'] = '课程';
			}elseif($v['type']==2){$values[$k]['type'] = '班级';
			}else{$values[$k]['type'] = '';}

			if($v['sex']==1){$values[$k]['sex'] = '男';
			}elseif($v['sex']==2){$values[$k]['sex'] = '女';
			}else{$values[$k]['sex'] = '';}

			if($v['active']==1){$values[$k]['active'] = '是';
			}else{$values[$k]['active'] = '否';}

			if($v['classify']==1){$values[$k]['classify'] = '小班';
			}elseif($v['classify']==2){$values[$k]['classify'] = '一对一';
			}elseif($v['classify']==3){$values[$k]['classify'] = '大班';
			}else{$values[$k]['classify'] = '';}

			if($v['status']==0){$values[$k]['status'] = '待跟进';
			}elseif($v['status']==1){$values[$k]['status'] = '跟进中';
			}elseif($v['status']==2){$values[$k]['status'] = '已放弃';
			}elseif($v['status']==3){$values[$k]['status'] = '已成单';
			}elseif($v['status']==4){$values[$k]['status'] = '已报名';
			}elseif($v['status']==5){$values[$k]['status'] = '已失效';}

			if($v['restult']==0){$values[$k]['restult'] = '考虑中';
			}elseif($v['restult']==1){$values[$k]['restult'] = '已成单';
			}elseif($v['restult']==2){$values[$k]['status'] = '无意向';
			}elseif($v['restult']==3){$values[$k]['restult'] = '想试听';
			}elseif($v['restult']==4){$values[$k]['restult'] = '已加入学员档案';
			}elseif($v['restult']==5){$values[$k]['restult'] = '已听课';
			}elseif($v['restult']==7){$values[$k]['restult'] = '未听课';}
			$values[$k]['num'] = $k+1;
		}
		$xlsName     = '咨询列表';//文件名
		$textRun     = $xlsName;//表名
		$xlsCell  = array(
			array('num','序号'),
			array('membername','咨询人姓名'),
			array('mobile','联系电话'),
			array('type','咨询类型'),
			array('classify','咨询分类'),
			array('coursename','课程/班级名称'),
			array('schoolroomid','咨询校区'),
			array('intentionality','意向程度'),
			array('active','是否主动联系'),
			array('channel','来源'),
			array('status','跟进状态'),
			array('number','跟进次数'),
			array('restult','跟进结果'),
			array('sex','性别'),
			array('adddate','录入时间'),
			array('lasttime','最后跟进时间'),
			array('nexttime','下次回访时间'),
		);
		exportExcel($xlsName,$xlsCell,$values,$textRun);
    }
}