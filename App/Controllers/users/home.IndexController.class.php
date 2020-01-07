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
    public function indexAction(){

    	$where = '';
	 	$keyword= KS_S('keyword');
	    $keytype= KS_S('keytype',1);
    	$Data003['wxid'] = $this->wxid;
    	$Data003['appename'] = $this->app['appename'];
    	$Data003['keyword']  = $keyword;
		$Data003['keytype']  = $keytype;
		$Data003['AppModel'] = $this->AppModel->tablename;

		$setting = $this->cache->GetH('apprelate','appid',$this->appid,'setting',$this->wxid);
        if(!empty($setting)){$setting = explode('※',$setting);}
		$UsersModel            = M('App/UsersModel');
		$result                = $UsersModel->userslist($Data003);
	    $usertype = $result['usertype'];
		$UsersAll = $result['UsersAll'];
		$page     = $result['page'];
		$schoolModel = M('app_schooladdress');
		$schoolAry   = $schoolModel->getAll('where wxid='.$this->wxid);
		if($usertype == 1){     //老师管理
			 //状态筛选
			$powertype       = KS_S('powertype',3);
			if($powertype==1){$where .= ' and (a.powertype=1 or a.powertype=2)';}
			elseif($powertype==0){$where .= ' and a.powertype=0';}
			//状态筛选
			$status       = KS_S('status',3);
			if($status    ==2){$where .= ' and a.status=2';}
			elseif($status==1){$where .= ' and a.status=1';}
			elseif($status==0){$where .= ' and a.status=0';}
			$schoolid       = KS_S('schoolid','all');
			if($schoolid!='all'){
				$where .=' and b.schoolid='.$schoolid;
			}
	        $lastlogintime = KS_S('lastlogintime','1');
	        $adddate       = KS_S('adddate','1');
	        $logintimes    = KS_S('logintimes','1');
			include  CURR_VIEW_PATH . "teacher_list.php";
		}else{
			$userModel    = M('common_user');
			$where1 = 'where usertype=0 and parentid!=0 and wxid='.$this->wxid;
			//分组搜索
			$groupid       = ChkClng(KS_S('groupid',0));
			if (!empty($groupid)){
				$where1 .= ' and groupid='.$groupid;
			}
			//状态筛选
			$is_period       = KS_S('is_period',3);
			if($is_period    ==1){$where1 .= ' and (is_period=1 and indate>'.time().' or is_period=0)';}
			elseif($is_period==2){$where1 .= ' and is_period=1 and indate<'.time();}
			$usernumb     = $userModel->getOne('count(userid)',$where1);
			$group_list   = M('common_user_group')->getAll("where wxid=$this->wxid and type=0",'id,name');
			//状态筛选
			$status       = KS_S('status',3);
			if($status    ==2){$where .= ' and a.status=2';}
			elseif($status==1){$where .= ' and a.status=1';}
			elseif($status==0){$where .= ' and a.status=0';}

			//报班情况
			$enrollstatus       = null !==GF('enrollstatus') ? GF('enrollstatus'):'3';
			if($enrollstatus    ==2){$where .= ' and b.enrollstatus=2';}
			elseif($enrollstatus==1){$where .= ' and b.enrollstatus=1';}
			elseif($enrollstatus==0){$where .= ' and b.enrollstatus=0';}
			$schoolid       = null !==GF('schoolid') ? GF('schoolid'):'all';
			if($schoolid!='all'){
				$where .=' and b.schoolid='.$schoolid;
			}

	        $lastlogintime = null !==GF('lastlogintime') ? GF('lastlogintime'):'1';
	        $adddate       = null !==GF('adddate') ? GF('adddate'):'1';
	        $money         = null !==GF('money') ? GF('money'):'1';
			include  CURR_VIEW_PATH . "member_list.php";
		}
     }
    public function showvipAction(){
        $userid            = ChkClng(GF('userid'));
        $cache = new \Core\Cache();//缓存类
        $ca_vip = $cache->GetUCache('uservip',$userid);//vip
        if (!empty($ca_vip)){
            $ca_vip1 = array_filter($ca_vip, function ($item) {
                return $item['type'] == 0;
            });
            if (!empty($ca_vip1)){
                $ca_vip1 = array_reduce($ca_vip1, 'array_merge', array());
                $vipex = date('Y-m-d',$ca_vip1['expiretime']);
            }else{
                $vipex = '未开通';
            }
            $ca_vip2 = array_filter($ca_vip, function ($item1) {
                return $item1['type'] == 1;
            });

            if (!empty($ca_vip2)){
                $ca_vip2=array_reduce($ca_vip2, 'array_merge', array());
                $svipex = date('Y-m-d',$ca_vip2['expiretime']);
            }else{
                $svipex = '未开通';
            }
        }else{
            $vipex = '未开通';
            $svipex = '未开通';
        }
        include  CURR_VIEW_PATH . "showvip.php";
    }
    public function uservipAction(){
        $userid = ChkClng(GF('userid'));
        $time = ChkClng(KS_G('post.time'));
        $type = ChkClng(KS_G('post.type'));
        $vip_buy = M('common_vip_buy');
        $vip_buy_data = $vip_buy->getRow('where userid = '.$userid.' and type = '.$type.'');
        $etime = strtotime(date("Y-m-d",time()));
        if (!empty($vip_buy_data)&&$etime<$vip_buy_data['expiretime']){
            $data['expiretime'] = strtotime("+$time day",$vip_buy_data['expiretime']);
        }else{
            $data['expiretime'] = strtotime("+$time day",$etime);
        }
        if (!empty($vip_buy_data)){
            $vip_buy->update($data,'id='.$vip_buy_data['id'].'');
        }else{
            $data['userid'] = $userid;
            $userModel = M('common_user');
            $wxid = $userModel->getOne('wxid','where userid = '.$userid.'');
            $data['wxid'] = $wxid;
            $data['type'] = $type;
            $data['buytime'] = time();
            $vip_buy->doAdd($data,'id');
        }
        $cache     = new \Core\Cache();
        $cache->PutUCache('uservip',$userid);
        $url= M_URL($this->AppName.'/Index','index','',GP(''));
        KS_INFO('添加成功',3,$url);
    }
	/*
	 * 添加老师
	 */
	public function doTeacherAddAction()
	{
		$Data1['name'] = ChkSQL(KS_G('post.teachername'));
		$Data1['position'] = ChkSQL(KS_G('post.position'));
		$Data1['categoryid'] = ChkClng(KS_G('post.categoryid'));
		$Data1['ename'] = ChkSQL(KS_G('post.teacherename'));
		$Data1['shortIntro'] = ChkSQL(KS_G('post.shortIntro'));
		$Data1['teacherIntro'] = EncodeSQL(KS_G('post.teacherIntro'));
		$Data1['head'] =  Img(ChkSQL(KS_G('post.defaultpic')));

		$Data1['schoolid'] = ChkClng(KS_G('post.schoolid'));
		$Data1['isshow'] = 1;
		$areaid = ChkClng(KS_G('post.areaid'));
		$areaModel = M('common_area');
		if($areaid!=0){
			$depth = $areaModel->getOne('depth',"where id=$areaid");
			if($depth==3){
				$Data1['countyid'] = $areaid;
				$Data1['cityid'] = $areaModel->getOne('parentid',"where id=$Data1[countyid]");
				$Data1['provinceid'] = $areaModel->getOne('parentid',"where id=$Data1[cityid]");
			}elseif($depth==2){
				$Data1['countyid'] = 0;
				$Data1['cityid'] = $areaid;
				$Data1['provinceid'] = $areaModel->getOne('parentid',"where id=$Data1[cityid]");
			}elseif($depth==1){
				$Data1['countyid'] = 0;
				$Data1['cityid'] = 0;
				$Data1['provinceid'] = $areaid;
			}
		}
		if (empty($Data1['head'])) KS_INFO('请上传头像',0,'','',1);
		$userModel = M('common_user');
		$teacherModel = M('common_user_teacher');
		$Data['powertype'] = ChkSQL(KS_G('post.powertype'));
		$Data['wxid'] = $this->wxid;
		$Data['parentid'] = $this->userid;
		$Data['usertype'] = 1;
		$Data['regdate'] = time();
		$Data['status'] = ChkClng(KS_G('post.status'));
		$Data['nickname'] = $Data1['name'];
		if (is_email(ChkSQL(KS_G('post.email')))){
			$Data['email'] = ChkSQL(KS_G('post.email')) ;
		}
		if ($Data['powertype']==2){
			$userid = ChkClng(KS_G('post.userid'));
			$userModel->update($Data,'userid='.$userid.' and wxid='.$this->wxid);
			$teacherModel->update($Data1,'userid='.$userid);
		}else {
			$userid = $userModel->doAdd($Data, 'userid');
			if ($userid) {
				$Data1['userid'] = $userid;
				$teacherModel->doEfAdd($Data1);
			}
		}
		$url = M_URL($this->AppName.'/Index','Index','',GP(''));
		KS_INFO('添加成功',3,$url);
	}
	 /**
     * 进入添加会员界面
	  */
	 public function addUsersAction(){
	 	$now_page = ChkClng(KS_S('p'));
		$usertype = ChkClng(KS_S('usertype',3));
		$tableModel = M('common_table');

        //得到自定义表的ID号
		if($usertype == 0){
		    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
		}elseif($usertype == 1){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
		}elseif($usertype == 2){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_school'");
		}
		 $group_list = M('common_user_group')->getAll("where wxid=$this->wxid and type=0",'id,name');
		 $teacherModel = M('common_user_teacher');
		 $role_list = $this->userModel->getAll(" as a left join $teacherModel->table as b on a.userid=b.userid where a.wxid=$this->wxid and a.powertype=2 and b.isshow=0",'a.userid,b.name');
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
		$schoolModel = M('app_schooladdress');
		$schoolAry   = $schoolModel->getAll('where wxid='.$this->wxid);
		$userinfo = '';
		if($usertype==1){
		$category  = $this->cache->GetACache('appcategory');//读出缓存
		$apprelate = $this->cache->GetHCache('apprelate',$this->wxid);//读出缓存
		include  CURR_VIEW_PATH . "teacher_add.php";}
		else{include  CURR_VIEW_PATH . "member_add.php";}
     }
	 /**
	  * 保存添加学员
	  */
	 public function doaddUsersAction(){
	 	$usertype          = ChkClng(KS_S('usertype'));
		$Data001['wxid']   = $this->wxid;
	 	$Data001['userid'] = $this->userid;
	 	$Data001['type']   = 2;
	    $UsersModel = M('App/UsersModel');
	    $UsersModel ->doaddUsers($Data001);
		$url1 = M_URL($this->AppName.'/Index','index','',GP(''));
		KS_INFO('添加成功',0,$url1);exit;
     }
    /**
     * 进入会员信息编辑页面
     */
    public function editUsersAction(){
		$now_page = ChkClng(KS_S('p'));
		$userid   = ChkClng(KS_G('request.id'));
		if(empty($userid)){KS_INFO('id不能为空',0,'','',1);}
		$usertype = ChkClng(KS_S('usertype',3));
		$tableModel = M('common_table');
		if($usertype == 0){
		     $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
			 $userinfo = $this->userModel->getRow("as a left join `".$this->AppModel->table."` as b on a.userid =b.userid WHERE a.userid =$userid limit 1");
		}elseif($usertype == 1){
			 $tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
			 $userinfo = $this->userModel->getRow("as a left join `".$this->AppModel->table."` as b on a.userid = b.userid WHERE a.userid =$userid limit 1");
		}elseif($usertype == 2){
			 $tableid = $tableModel->getOne('tableid',"where tablename='common_user_school'");
		}
		$group_list = M('common_user_group')->getAll("where wxid=$this->wxid and type=0",'id,name');

		$Linkage = Linkage(array());
		$Linkage->cachename  = 'appcategory';
		$Linkage->wxid       = $this->wxid;
 		$Linkage->inputname  = 'categoryid';// <select name='' /> 里的name值
		$Linkage->categoryid =  $userinfo['categoryid'];
		$areaid = 0;
		if($userinfo['provinceid']!=0){
			$areaid = $userinfo['provinceid'];
			if($userinfo['cityid']!=0){
				$areaid = $userinfo['cityid'];
				if($userinfo['countyid']!=0){$areaid = $userinfo['countyid'];}
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
		$schoolModel = M('app_schooladdress');
		$schoolAry   = $schoolModel->getAll('where wxid='.$this->wxid);
        if($usertype==1){
        	$category  = $this->cache->GetACache('appcategory');//读出缓存
			$apprelate = $this->cache->GetHCache('apprelate',$this->wxid);//读出缓存
			//var_dump($userinfo['power']);
			include  CURR_VIEW_PATH . "teacher_add.php";
		}else{include  CURR_VIEW_PATH . "member_add.php";}
    }
    /**
     * 编辑会员
     */
    public function doeditUsersAction(){
		$now_page       = ChkClng(KS_S('p'));
		$userid         = ChkSQL(KS_G('get.id'));
		if(empty($userid)){KS_INFO('id不能为空',0,'','',1);}
		$Data['email']               = ChkSQL(KS_G('post.email'));
		if(!empty(KS_G('post.mobile'))){
            $Data['mobile']     = ChkSQL(KS_G('post.mobile'));
//            $Rule['mobile']     ='手机|isMobile';
        }
		if (!empty(ChkSQL(KS_G('post.password')))){
			if (!is_password(ChkSQL(KS_G('post.password')))) KS_INFO('密码长度6-20',0,'','',1);
			$Data['rndpasswordc'] = rand(100000,999999);
			$Data['password'] = KS_MD5(ChkSQL(KS_G('post.password')).KS_MD5($Data['rndpasswordc']));
		}
		$Data['groupid']  = ChkClng(KS_S('groupid'));
		$Data['indate']  = strtotime(ChkSQL(KS_S('indate')))  ;
		$Data['is_period']  = ChkClng(KS_S('is_period'));
		$Data['status']     = ChkClng(KS_G('post.status'));
		if(!empty(ChkSQL(KS_G('post.defaultpic')))){
			$dir1               = ROOT.strstr(XImg(ChkSQL(KS_G('post.defaultpic'))),'Images/');
	        $dir2               = ROOT.'Images/users/'.$userid.'/'.KS_MD5($userid).'.jpg';
			$this->File->unlinkFile($dir2);
			$this->File->copyFile($dir1,$dir2);
			$Datas['head']     = ChkSQL(KS_G('post.defaultpic'));
		}
//		$Rule['email'] = '邮箱|isEmpty,isEmail';
//		Chkpost($Data,$Rule,$this->userModel,"(usertype=1 or usertype=2) and userid!=$userid");
	
		$areaModel = M('common_area');
		$areaid = ChkClng(KS_G('post.areaid'));
		if($areaid!=0){
			$depth = $areaModel->getOne('depth',"where id=$areaid");
			if($depth==3){
				$Datas['countyid']   = $areaid;
				$Datas['cityid']     = $areaModel->getOne('parentid',"where id=$Datas[countyid]");
				$Datas['provinceid'] = $areaModel->getOne('parentid',"where id=$Datas[cityid]");
			}elseif($depth==2){
				$Datas['countyid']   = 0;
				$Datas['cityid']     = $areaid;
				$Datas['provinceid'] = $areaModel->getOne('parentid',"where id=$Datas[cityid]");
			}elseif($depth==1){
				$Datas['countyid']   = 0;
				$Datas['cityid']     = 0;
				$Datas['provinceid'] = $areaid;
			}
		}
		$usertype    = ChkClng(KS_S('usertype',3));
		$tableModel  = M('common_table');
		$Datas['schoolid']                 = ChkSQL(KS_G('post.schoolid'));
		if($usertype == 0){
		    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
		    $Datas['Sex']                 = ChkSQL(KS_G('post.Sex'));
		    $Datas['birthday']            = strtotime(KS_G('post.birthday'));//出生日期
		    $Datas['emergencyContact']    = ChkSQL(KS_G('post.emergencyContact'));//紧急联系人
		    $Datas['emergencyContactTel'] = ChkSQL(KS_G('post.emergencyContactTel'));//紧急联系人电话
			$Datas['teacher_name'] = ChkSQL(KS_G('post.teacher_name'));//班主任
			$Datas['teacher_mobile'] = ChkSQL(KS_G('post.teacher_mobile'));//班主任电话
			if (!empty($Datas['teacher_name'])&&empty($Datas['teacher_mobile'])) KS_Alert('请填写班主任电话','error');
			if (!empty($Datas['teacher_mobile'])&&!is_mobile($Datas['teacher_mobile'])) KS_Alert('请填写正确的手机号码','error');
			if (empty($Datas['teacher_name'])&&!empty($Datas['teacher_mobile'])) KS_Alert('请填写班主任姓名','error');
			$Datas['name'] = ChkSQL(KS_G('post.membername'));
			/*----------------------字段拼接测试中------------------------------*/
			$fieldModel = M('common_table_field');//实例化字段表
			$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
			foreach($Field as $Fk => $Fv){
				  $fieldname = $Fv['fieldname'];
				  $Datas[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
				  if($Fv['mustinput']==1)
				  {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
			}
			/*----------------------------------------------------*/
			$result = $this->AppModel->update($Datas,"userid=$userid");
		}elseif($usertype == 1){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
			$Datas['shortIntro']               = ChkSQL(KS_G('post.shortIntro'));
			$Datas['teacherIntro']             = ChkSQL(KS_G('post.teacherIntro'));
			$Datas['position']             = ChkSQL(KS_G('post.position'));
			$Datas['name']         = ChkSQL(KS_G('post.teachername'));
			$Datas['ename']        = ChkSQL(KS_G('post.teacherename'));
			$Datas['categoryid']   = ChkSQL(KS_G('post.categoryid'));//应用分类ID
			/*----------------------字段拼接测试中------------------------------*/
			$fieldModel = M('common_table_field');//实例化字段表
			$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
			foreach($Field as $Fk => $Fv){
			   $fieldname = $Fv['fieldname'];
			   $Datas[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
			   if($Fv['mustinput']==1)
			   {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
			}
			/*----------------------------------------------------*/
			$result = $this->AppModel->update($Datas,"userid=$userid");
		}
		$Data['nickname'] = $Datas['name'];
		$result = $this->userModel->update($Data,"userid=$userid");//更新第二张表

		User_GetUser($userid,true);
		$classid = null !==GF('classid') ? GF('classid'):'0';
	    $bappid = null !==GF('bappid') ? GF('bappid'):'0';
	    if($classid !=0){
	   	    $url1=M_URL('class/Index','teacher',$userid,GP('p-'.$now_page.',classid-'.$classid.',appid-'.$bappid));
	    }else{
	     	$url1=M_URL($this->AppName.'/Index','index',$userid,GP('p-'.$now_page));
	    }
		KS_INFO('修改成功',0,$url1);
    }
	//删除会员
    public function deluserAction(){
		$userid = ChkClng(KS_G('id'));
		$now_page = ChkClng(KS_S('p'));
		$usertype = ChkClng(KS_S('usertype',3));
		$this->AppModel->delete("userid=$userid");//删除第二张表的数据
		if($usertype == '1'){
			$this->userModel->delete("userid=$userid");//删除第三张表的数据
			$app_userrelate = M('common_app_userrelate');
			$app_userrelate->delete("userid=$userid");
	    }else{
		    $this->userModel->delete("userid=$userid");
			M('app_team_member')->delete("userid=$userid");
			M('app_course_rate')->delete("userid=$userid");
            M('common_user_group_buy')->delete("userid=$userid");
		}
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		User_GetUser($userid,true);
		ks_header($url);
	}
	//批量删除
	public function bathdeluserAction(){
		$userid      = KS_G('post.userid');
		if(empty($userid)){KS_INFO('请选择',0,'','',1);}
		$now_page    = ChkClng(KS_S('p',1));
		$batch       = ChkClng(KS_G('post.batch'));
		$url         = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		$teamModel = M('app_team_member');
		$rateModel = M('app_course_rate');
	    if($batch ==1){
			foreach($userid as $k=>$v){
			    $id = ChkClng($v);
			    $this->userModel->delete("userid=$id");
			    $this->AppModel->delete("userid=$id");
				$teamModel->delete("userid=$id");
				$rateModel->delete("userid=$id");
				User_GetUser($id,true);
			}
			KS_INFO('删除成功',0,$url);
		}elseif($batch ==2){
			foreach($userid as $k=>$v){
				   $id = ChkClng($v);
				   $Data['status']=1;
				   $this->userModel->update($Data,"userid=$id");
				User_GetUser($id,true);
			}
			KS_INFO('审核成功',0,$url);
		}elseif($batch ==3){
			foreach($userid as $k=>$v){
				   $id = ChkClng($v);
				   $Data['status']=0;
				   $this->userModel->update($Data,"userid=$id");
				User_GetUser($id,true);
			}
			KS_INFO('取消审核成功',0,$url);
		}
		//删除第二张表的数据
	}
    //进入页面
	public function excelIndexAction(){
		 include  CURR_VIEW_PATH . "excelindex.php";
	}
	//批量导入学生
	public function beathaddUsersAction(){
		if(!empty($_FILES['execl']['tmp_name'])){
				$this->upload->savePath = 'users/excel/'.$this->userid.'/'; // 设置附件上传（子）目录
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
		 $data['wxid'] = $this->wxid;
		 $data['status'] = 1;
		 $data['mobilebing'] = 1;
		 $data['rndpasswordc']  = rand(100000,999999);
		 $data['regdate']       = ChkClng(time());
		 $data['password'] = KS_MD5($password.KS_MD5($data['rndpasswordc']));
			   $user =  $userModel->getRow("where username = '$data[username]' and  parentid = $this->userid ");
		 if($user){
			 $userModel->update($data,'userid='.$user['userid']);
			 $data1['name']= $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
			 $userMemberModel -> update($data1,'userid='.$user['userid']);
		 }else{
			 $userid = $userModel->doAdd($data,'userid');
			 $data1['name']= $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
			 $data1['userid'] = $userid;
			 $userid = $userMemberModel->doEfAdd($data1);
		 }
		}
		$url=M_URL($this->AppName.'/Index','index','',GP(''));
		KS_INFO('添加成功',3,$url);
	}
	public function doExceluserAction(){
		$paperid = ChkClng(KS_G('post.outtime'));
		if(empty($paperid)){
			$url=M_URL('home/Paylog','index','',GP('p-'.$now_page));
		    KS_INFO("请选择导出的类型",0,$url,'',1);
		}

		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';

		$where = 'where  a.usertype = 0 and a.wxid='.$this->wxid;
		if($paperid==1){
			if(date("w")==0){$wday = 7;}else{$wday = date("w");}
			$week =  mktime(0,0,0,date("m"),date("d")-$wday+1,date("Y"));
			$where=$where.' and a.regdate > '.$week;

		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and a.regdate > '.$strtime;
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and a.regdate > '.$strtime;
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and a.regdate > '.$strtime.' and a.regdate < '.$endtime;
		}

		$where    = "as a left join `".$this->AppModel->table."` as b on a.userid = b.userid  $where";
		$infoary = $this->userModel->getAll($where.' order by a.userid desc','a.username,a.email,b.name,a.mobile,a.regdate,a.lastlogintime,a.money,a.status');
		if(empty($infoary)){
			$url=M_URL($this->AppName.'/Index','index','',GP(''));
		    KS_INFO('该时间段没有学员数据',0,$url,'',1);
		}
		 foreach($infoary as $key =>$val){
		 	$infoary[$key]['number'] = $key+1;
		 	date_default_timezone_set("PRC");
		 	$infoary[$key]['regdate']=date('Y-m-d H:i:s',$val['regdate']);
		 	$infoary[$key]['lastlogintime']=date('Y-m-d H:i:s',$val['lastlogintime']);
		 	if($val['status']==0){
		 		$infoary[$key]['status'] = '未审核';
		 	}else{
		 		$infoary[$key]['status'] = '已审核';
		 	}
		 }
        $xlsName     = '学员列表';//文件名
		$textRun     = $xlsName;//表名
		$xlsCell  = array(
			array('number','序号'),
			array('username','用户账号'),
			array('name','姓名'),
			array('email','邮箱'),
			array('mobile','联系电话'),
			array('money','余额'),
			array('regdate','注册时间'),
			array('lastlogintime','最后登录时间'),
			array('status','是否已审核'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}
	//用户应用配置
	public function settingAction(){
		$setting = getSet($this->wxid,$this->appid);//获取网站配置
		include  CURR_VIEW_PATH . "setting.php";
	}
	public function doSettingAction(){
		$setting = getSet($this->wxid,$this->appid);//获取网站配置
		$setting[0] = ChkClng(KS_G('post.setting0'));//是否开启
		$Data['setting'] = implode('|',$setting);
		$apprelateModel         = M('common_app_userrelate');
	    $apprelateModel->update($Data,'wxid='.$this->wxid.' and appid = '.$this->appid);
		KS_INFO('保存成功',6);
	}
    ////学员充值
    //public function rechargeAction(){
    //    $skip     = ChkClng(null !==GF('skip') ? GF('skip'):'0');
    //    $userid   = ChkClng(KS_G('request.id'));
    //    if(empty($userid)){KS_INFO('err',0,'','',1);}
    //    $now_page = ChkClng(KS_S('p'));
    //    $tableModel = M('common_table');
    //    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
    //    $userinfo = $this->userModel->getRow("as a left join `".$this->AppModel->table."` as b on a.userid =b.userid WHERE a.userid =$userid limit 1");
    //    include  CURR_VIEW_PATH . "recharge.php";
    //}
    ////进行学员充值操作
    //public function dorechargeAction(){
    //    $skip          = ChkClng(null !==GF('skip') ? GF('skip'):'0');
    //    $userid        = ChkClng(KS_G('request.id'));
    //    $money         = ChkSQL(KS_G('post.money'));
    //    if(empty($userid)){KS_INFO('err',0,'','',1);}
    //    $Data['money'] = 'money+'.$money;
    //    $this->userModel->update($Data,'wxid='.$this->wxid.' and usertype=0 and userid='.$userid,1);

    //    $MMoney = $this->userModel->getOne('money',"where userid=".$userid);

    //    $name          = ChkSQL(KS_G('post.name'));
    //    $username      = ChkSQL(KS_G('post.username'));
    //    $netreceipts   = ChkSQL(KS_G('post.netreceipts'));

    //    $loginfo['order_amount'] = $money;
    //    $loginfo['memberid']     = $userid;
    //    $loginfo['wxid']         = $this->wxid;
    //    $loginfo['memberip']     = $_SERVER['REMOTE_ADDR'];
    //    $loginfo['mark']         = $username.'收取现金'.$netreceipts.'为'.$name.'充值了'.$money;
    //    //调用唤起传说中的model层
    //    $apnlog      = M('Application/LogModel');
    //    $apnlog->memberlog($loginfo,$MMoney,1);//用户使用通过小课堂使用支付宝进行充值
    //    if($skip==0){
    //        $url1 = M_URL($this->AppName.'/Index','index','',GP(''));
    //        KS_INFO('充值成功',3,$url1);
    //    }else{
    //        $url1 = M_URL($this->AppName.'/Index','details',$userid,GP(''));
    //        KS_INFO('充值成功',3,$url1);
    //    }
    //}
	//更新用户状态
	public function updatestatusAction(){
		$id = ChkSQL(KS_G("get.id"));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$status = $this->userModel->getOne('status','where userid ='.$id.' and wxid='.$this->wxid);
		if($status==1){$Data['status']=0;}elseif($status==0){$Data['status']=1;}
		$this->userModel->update($Data,'userid ='.$id);
		echo $Data['status'];
	}

    ////学员报班
    //public function enrolmentAction(){
    //    $id = ChkSQL(KS_G("get.id"));
    //    if(empty($id)){KS_INFO('请选择',0,'','',1);}
    //    $now_page    = ChkClng(KS_S('p',1));
    //    $usertype    = ChkClng(ChkClng(KS_S('usertype',3)));
    //    $userinfo    = $this->userModel->getRow('where userid ='.$id.' and wxid='.$this->wxid.' limit 1');
    //    $userinfo2   = $this->AppModel->getRow('where userid ='.$id.' limit 1');
    //    if($usertype==1){
    //        $teacherModel= M('common_user_teacher');
    //        $userinfo2   = $teacherModel->getRow('where userid ='.$id.' limit 1');
    //    }
    //    $where       = 'where a.wxid='.$this->wxid.' and a.status!=-1';
    //    //分类
    //    $categoryid=null !==GF('categoryid') ? GF('categoryid'):0;
    //    if($categoryid!=0) {$where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}
    //    $left_join   = M('app_category');
    //    $category    = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
    //    $choicetype  = null !==GF('choicetype') ? GF('choicetype'):0;
    //    $classtype   = null !==GF('classtype') ? GF('classtype'):0;
    //    if($choicetype==1){
    //        $where  .= ' and classlevel=2';
    //        if(!empty($classtype))$where     .= ' and classType='.$classtype;
    //        $where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where order by a.classid desc";
    //        $app_class  = M('app_class');//班级
    //        $allclass   = $app_class->getAll($where,'a.classid as courseid,a.title,a.price');
    //    }elseif($choicetype==2){
    //        if(!empty($classtype))$where     .= ' and courseType='.$classtype;
    //        $where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where order by a.courseid desc";
    //        $app_course = M('app_course');//课程
    //        $allclass   = $app_course->getAll($where,'a.courseid,a.title,a.price');
    //    }elseif($choicetype==3){
    //        $where  .= ' and classlevel=1';
    //        if(!empty($classtype))$where     .= ' and classType='.$classtype;
    //        $where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where order by a.classid desc";
    //        $app_class  = M('app_class');//班级
    //        $allclass   = $app_class->getAll($where,'a.classid as courseid,a.title,a.price');
    //    }elseif($choicetype==4){
    //        $where  .= ' and classlevel=0';
    //        if(!empty($classtype))$where     .= ' and classType='.$classtype;
    //        $where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where order by a.classid desc";
    //        $app_class  = M('app_class');//班级
    //        $allclass   = $app_class->getAll($where,'a.classid as courseid,a.title,a.price');
    //    }else{$allclass   = array();}
    //    if($usertype==1){
    //      include  CURR_VIEW_PATH . "teacherclass.php";exit;
    //    }
    //    include  CURR_VIEW_PATH . "enrolment.php";exit;
    //}

	public function showteacherclassAction(){
		$id = ChkSQL(KS_G("get.id"));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$now_page    = ChkClng(KS_S('p',1));
		$usertype    = ChkClng(ChkClng(KS_S('usertype',3)));
		$userinfo    = $this->userModel->getRow('where userid ='.$id.' and wxid='.$this->wxid.' limit 1');
		$userinfo2   = $this->AppModel->getRow('where userid ='.$id.' limit 1');
		if($usertype==1){
			$teacherModel= M('common_user_teacher');
			$userinfo2   = $teacherModel->getRow('where userid ='.$id.' limit 1');
		}
		$where       = 'where a.wxid='.$this->wxid.' and a.status!=-1';
		//分类
		$categoryid=null !==GF('categoryid') ? GF('categoryid'):0;
		if($categoryid!=0) {$where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}
		$left_join   = M('app_category');
		$category    = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		$choicetype  = null !==GF('choicetype') ? GF('choicetype'):0;
		$classtype   = null !==GF('classtype') ? GF('classtype'):0;
		if($choicetype==1){
			$where  .= ' and classlevel=2';
			if(!empty($classtype))$where     .= ' and classType='.$classtype;
			$where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where order by a.classid desc";
			$app_class  = M('app_class');//班级
			$allclass   = $app_class->getAll($where,'a.classid as courseid,a.title,a.price');
		}elseif($choicetype==2){
			if(!empty($classtype))$where     .= ' and courseType='.$classtype;
			$where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where order by a.courseid desc";
			$app_course = M('app_course');//课程
			$allclass   = $app_course->getAll($where,'a.courseid,a.title,a.price');
		}elseif($choicetype==3){
			$where  .= ' and classlevel=1';
			if(!empty($classtype))$where     .= ' and classType='.$classtype;
			$where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where order by a.classid desc";
			$app_class  = M('app_class');//班级
			$allclass   = $app_class->getAll($where,'a.classid as courseid,a.title,a.price');
		}elseif($choicetype==4){
			$where  .= ' and classlevel=0';
			if(!empty($classtype))$where     .= ' and classType='.$classtype;
			$where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where order by a.classid desc";
			$app_class  = M('app_class');//班级
			$allclass   = $app_class->getAll($where,'a.classid as courseid,a.title,a.price');
		}else{$allclass   = array();}
		include  CURR_VIEW_PATH . "teacherclass.php";
	}
	//do学员报班
    //public function doenrolmentAction(){
    //    $id = ChkSQL(KS_G("get.id"));
    //    if(empty($id)){KS_INFO('请选择',0,'','',1);}
    //    $choicetype        = ChkClng(KS_G('post.choicetype'));//避免页面有人作弊，同时传进订单号和课程号，所以放进else里接收
    //    $courseid          = ChkClng(KS_G('post.courseid'));//避免页面有人作弊，同时传进订单号和课程号，所以放进else里接收

    //    $data['courseid']    = $courseid;
    //    $data['choicetype']  = $choicetype;
    //    $data['memberid']    = $id;
    //    $data['userid']      = $this->userid;
    //    $data['order_amount']= ChkSQL(KS_G('post.order_amount'));

    //     ////调用唤起传说中的model层
    //    $Enrolment      = M('App/OrderModel');
    //    $Enrolment->doOpenCourseOrder($data);//对学员进行报课报班
    //    $url = M_URL($this->AppName.'/Index','enrolment',$id,GP(''));
    //    KS_INFO('报班成功',3,$url);
    //}
	//do教师排班
	public function doteacheraddclassAction(){
		$id = ChkSQL(KS_G("get.id"));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$choicetype        = ChkClng(KS_G('post.choicetype'));//避免页面有人作弊，同时传进订单号和课程号，所以放进else里接收
		$courseid          = ChkClng(KS_G('post.courseid'));//避免页面有人作弊，同时传进订单号和课程号，所以放进else里接收
		$isspacker          = ChkClng(KS_G('post.isspacker'));//避免页面有人作弊，同时传进订单号和课程号，所以放进else里接收

 		////调用唤起传说中的model层
		$Enrolment      = M('App/ClassModel');
		$Enrolment->teacherClass($this->wxid,$id,$courseid,$isspacker);//对学员进行报课报班
	    $url = M_URL($this->AppName.'/Index','enrolment',$id,GP('usertype-1'));
		KS_INFO('排班成功',3,$url);
	}
	/**
     * 报课详情
	 */
	public function detailsAction(){
		$id = ChkSQL(KS_G("get.id"));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$userinfo  = $this->userModel->getRow('where userid ='.$id.' and wxid='.$this->wxid.' limit 1');
		$userinfo2 = $this->AppModel->getRow('where userid ='.$id.' limit 1');
		$province                      = $this->cache->GetA('areainfo','id',$userinfo2['provinceid'],'city');
		$province                      = $province?$province:'';
		$city                          = $this->cache->GetA('areainfo','id',$userinfo2['cityid'],'city');
		$city                          = $city?$city:'';
		$county                        = $this->cache->GetA('areainfo','id',$userinfo2['countyid'],'city');
		$county                        = $county?$county:'';
		$userinfo2['taddress']         = $province.$city.$county?$province.$city.$county:'未完善';
	    $where       = "where wxid = $this->wxid and memberid=$id and status != -1";
	    $type        = ChkClng(KS_S('type'));
		if($type    ==3){$where .= ' and (type=0 or type=1 )';}
		elseif($type==1){$where .= ' and type=1';}
		elseif($type==0){$where .= ' and type=0';}
	    $app_order   = M('app_order_info');
		$options     = $app_order->getOptions('10',$where);//分页参数设置
		$page        = Page($options);
		$orders      = $app_order->getPage($page,'adddate desc',$where);
		$courseModel = M('app_course');
		$classModel = M('app_class');
		$course_rate = M('app_course_rate');
		foreach($orders as $k =>$v){
			if($v['type']==0){
				$orders[$k]['market_price'] = $courseModel->getOne('price','where courseid='.$v['courseid']);
			}elseif($v['type']==1){
				$orders[$k]['market_price'] = $classModel->getOne('price','where classid='.$v['courseid']);
			}
			//课程进度
            $course_rate_data = $course_rate->getRow('where userid = '.$v['memberid'].' and courseid = '.$v['courseid'].'','type,is_finish,total_time,finish_time');
            if (!empty($course_rate_data)){
                if ($course_rate_data['is_finish']==1){
                    $rate_data = '100%';
                }elseif ($course_rate_data['total_time']!=0){
                    $info= $course_rate_data['finish_time']/$course_rate_data['total_time']*100;
                    if ($info>=100){
                        $rate_data = '100%';
                    }else{
                        $rate_data = sprintf("%01.2f", $info).'%';
                    }
                }else{
                    $rate_data = '0.00%';
                }
            }else{
                $rate_data = '0.00%';
            }

			$orders[$k]['speed'] = $rate_data;
		}
		include  CURR_VIEW_PATH . "details.php";
	}
	//学员前台是否展示
	public function isshowswitchAction(){
		$usersstyle        = ChkClng(KS_G("post.usersstyle"));
		$id                = ChkSQL(KS_G("get.id"));
    	$isshow            = $this->AppModel->getOne('isshow',"where userid=$id limit 1");
    	if($isshow==1){$Data['isshow'] = 0;}else{$Data['isshow'] = 1;}
	    $this->AppModel->update($Data,"userid=$id");
	}


    /******************************************************************* 用户分组（VIP）  begin ***********************************/
	/**
	 * 分组列表
	 */
	public function showgroupAction(){

		$where = 'where wxid='.$this->wxid.' and status!=-1 and type in (1,2,3)';
		$db_user_group = M('common_user_group');
		$keyword = KS_S('keyword');
	    $keytype = ChkClng(KS_S('keytype',1));
	    if($keyword){
	    	$where = $where.' and name like "%'.$keyword.'%"';
	    }
	    $options     = $db_user_group->getOptions('10',$where);//分页参数设置
		$page        = Page($options);
		$values      = $db_user_group->getPage($page,'addtime desc',$where);
		foreach ($values as $k => $v) {
			$values[$k]['count'] = M('common_user_group_buy')->getOne('count(id)','where wxid='.$this->wxid.' and grouplevel='.$v['id']);
		}
		include  CURR_VIEW_PATH . "group/grouplist.php";
	}
	/**
	 * 添加会员分组
	 */
	public function groupAddAction(){

		$db_user_group = M('common_user_group');
		$id = ChkClng(KS_G('get.id'));
		if($id){
			$value = $db_user_group->getRow('where wxid='.$this->wxid.' and id='.$id);
		}

		include  CURR_VIEW_PATH . "group/groupadd.php";
	}
	/**
	 * 保存修改、添加分组
	 */
	public function doGroupAddAction(){
		$id                   = ChkClng(KS_G('get.id'));
		$Data['name']         = ChkSQL(KS_G('post.name'));
		$Data['costlevel']    = ChkSQL(KS_G('post.costlevel'));
		$Data['type']         = ChkClng(KS_S('post.type'));
		if($Data['type']==1){
            $Data['discount'] = ChkSQL(KS_S('post.discount'));
            $Data['other']    = ChkClng(KS_S('post.other'));
            if ($Data['discount']>=10 || $Data['discount']<=0){
                KS_INFO("折扣只能0-10之间",0,'','',1);
            }
		}
		$Data['price']        = ChkSQL(KS_G('post.price'));
	    $Data['price_market'] = ChkSQL(KS_G('post.price_market'));

		$Data['detailintro']  = ChkSQL(KS_G('post.detailintro'));
		if(KS_G('post.defaultpic')){
		   $Data['defaultpic'] = ChkSQL(KS_G('post.defaultpic'));
		}
		$Data['shortdesc']     = ChkSQL(KS_G('post.shortdesc'));
		$Data['effectivetime'] = ChkClng(KS_G('post.effectivetime'));
		$Data['status']        = ChkClng(KS_G('post.status'));
		$url                   = M_URL($this->AppName.'/Index','showgroup','',GP(''));
		$db_user_group         = M('common_user_group');
		$Rule['name']          = '名称|isEmpty,isDbexis';
		if (empty($Data['name'])){
            KS_INFO("名称不能为空",0,'','',1);
        }
		if ($Data['price']<=0 || $Data['price_market']<0){
            KS_INFO("价格要大于0",0,'','',1);
        }

		// var_dump($Data);exit();
		if(empty($id)){//添加
			$Data['wxid']    = $this->wxid;
			$Data['addtime'] = time();
//			Chkpost($Data,$Rule,$db_user_group,'wxid='.$this->wxid);
			$db_user_group->doAdd($Data,'id');
			KS_INFO('添加成功',3,$url);
		}else{//修改
//			Chkpost($Data,$Rule,$db_user_group,'wxid='.$this->wxid.' and id!='.$id);
			$db_user_group->update($Data,'id='.$id);
			$this->cache->PutHCache('usergroup',$this->wxid);//更新会员组的缓存
			KS_INFO('修改成功',3,$url);
		}

	}
	/**
     * 删除分组
	 */
	public function delGroupAction(){
		$id                  = ChkClng(KS_G('get.id'));
		$db_user_group       = M('common_user_group');
		$user_member         = M('common_user_group_buy');
		$db_user_group->delete('wxid='.$this->wxid.' and id='.$id);
		$user_member->delete('grouplevel='.$id.' and wxid='.$this->wxid);
		$this->cache->PutHCache('usergroup',$this->wxid);//更新会员组的缓存
		$url = M_URL($this->AppName.'/Index','showgroup','',GP(''));
		KS_INFO('删除成功',3,$url);
	}
	/**
     * 批量删除分组
	 */
	public function batchdelAction(){
		$id              = ChkSQL(KS_G('post.id'));
		$db_user_group   = M('common_user_group');
		$user_member     = M('common_user_group_buy');
		$Datas['status'] = -1;
		foreach($id as $k =>$v){
            if ($v>0){
                $db_user_group->update($Datas,'id='.ChkClng($v));
                $user_member->delete('grouplevel='.ChkClng($v).' and wxid='.$this->wxid);
            }
		}
		$this->cache->PutHCache('usergroup',$this->wxid);//更新会员组的缓存
		$url = M_URL($this->AppName.'/Index','showgroup','',GP(''));
		KS_INFO('删除成功',3,$url);
	}
	/**
     * 显示会员组对应的用户列表
	 */
	public function showGroupUserAction(){
		$id = ChkClng(KS_S('id'));
		$db_user_group = M('common_user_group');
		$db_group_user = M('common_user_group_buy');
	    $db_user_member = M('common_user_member');
	    $db_user = M('common_user');
		$title = $db_user_group->getOne('name','where id='.$id);
		$keyword = ChkSQL(KS_S('keyword'));
	    $keytype = ChkClng(KS_S('keytype',1));
	    $where ='as a inner join '.$db_user->table.' as b on a.userid=b.userid inner join '.$db_group_user->table.' as c on a.userid=c.userid where c.grouplevel='.$id.' and b.usertype=0 and c.wxid='.$this->wxid;
	    if($keyword){
	    	if($keytype==1){  //账号
	    		$where = $where." and b.username like '%$keyword%'";
	    	}else{
                $where = $where." and a.name like '%$keyword%'";
	    	}
	    }

	    $options     = $db_user_member->getOptions('10',$where);//分页参数设置
		$page        = Page($options);
		$values      = $db_user_member->getPage($page,'a.userid desc',$where,'a.*,b.username,b.mobile,b.regdate,c.grouplevel,c.buytime,c.grouptype,c.expiretime');
		include  CURR_VIEW_PATH . "group/groupuserlist.php";
	}
	/**
     * 显示添加会员页面
	 */
	public function addGroupUserAction(){
		$id                = ChkClng(KS_G('get.id'));
	    //$db_user_member    = M('common_user_member');
	    $db_user           = M('common_user');
	    $db_user_group     = M('common_user_group');
	    $common_user_group_buy = M('common_user_group_buy');
		$keyword           = ChkSQL(KS_S('keyword'));
	    $keytype           = ChkClng(KS_S('keytype',1));
	    //$where             = 'as a left join '.$db_user->table.' as b on a.userid=b.userid left join '.$common_user_group_buy->table.' as c on a.userid=c.userid where a.userid not in(select userid from '.$common_user_group_buy->table.' where grouplevel='.$id.') and  b.usertype=0 and b.wxid='.$this->wxid;
	    $where             = 'as a left join '.$common_user_group_buy->table.' as c on a.userid=c.userid where a.userid not in(select userid from '.$common_user_group_buy->table.' where grouplevel='.$id.') and  a.usertype=0 and a.wxid='.$this->wxid;
	    if($keyword){
	    	if($keytype==1){
	    		$where = $where.' and a.nickname like "%'.$keyword.'%"';
	    	}else{
	    		$where = $where.' and a.username like "%'.$keyword.'%"';
	    	}
	    }
	    $options     = $db_user->getOptions('8',$where);//分页参数设置
		$page        = Page($options);
        $where=$where.' '.'GROUP BY a.userid';
		$values      = $db_user->getPage($page,'a.userid desc',$where,'a.*,c.grouplevel,c.grouptype');

		foreach ($values as $k => $v) {
			if($v['grouplevel']){
				$values[$k]['groupname'] =  $db_user_group->getOne('name','where id='.$v['grouplevel']);
			}else{
				$values[$k]['groupname'] = '普通用户';
			}
		}
		include  CURR_VIEW_PATH . "group/groupadduser.php";
	}
	/**
     * 进行会员的添加
	 */
	public function doGroupAddUserAction(){
		$userlist = KS_S('ueserlist');
		$id = ChkClng(KS_S('get.id'));
		if($id<=0){
			$url = M_URL($this->AppName.'/Index','showgroup','',GP(''));
		    KS_INFO('出错了','','');
		}
		$ary = explode('|',$userlist);
		foreach ($ary as $k => $v) {
            if ($v>0){
                User_addUserGroupBuy($id,ChkClng($v),3,$this->wxid);
            }
		}
		// $this->cache->PutHCache('usergroup',$this->wxid);//更新会员组的缓存
		$url = M_URL($this->AppName.'/Index','showGroupUser',$id,GP(''));
		KS_INFO('添加成功',3,$url);
	}
	/**
     * 删除会员组里面的用户
	 */
	public function delGroupUserAction(){

		$type= KS_S('type',1);
		$id =  ChkClng(KS_G('get.id'));
		$db_user_member = M('common_user_group_buy');
		if($type==1){
			$userid = ChkClng(KS_S('userid'));
		    $db_user_member->delete('wxid='.$this->wxid.' and userid='.$userid.' and grouplevel='.$id);
		}else{

			$userid = FilterIds(implode(KS_G('post.userid'),','));
			if($userid==0){
		       KS_INFO('没有选择学员！','','');
			}
			$db_user_member->delete('wxid='.$this->wxid.' and userid in('.$userid.') and grouplevel='.$id);
		}
		$this->cache->PutHCache('usergroup',$this->wxid);//更新会员组的缓存
        $this->cache->PutUCache('uservipgroup',$userid);//更新会员组的缓存
		$url = M_URL($this->AppName.'/Index','showGroupUser',$id,GP(''));
		KS_INFO('批量操作成功',3,$url);
	}
    //改变分组显示状态
	public function groupauditedAction(){
	    $id =  ChkClng(KS_S('get.id'));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$status        =  ChkSQL(KS_S('status'));
		$db_user_group = M('common_user_group');
		if($status==0){$Data['status'] = 0;
			$db_user_group->update($Data,"id=$id");echo "0";
		}elseif($status==1){$Data['status'] = 1;
		    $db_user_group->update($Data,"id=$id");echo "1";
		}
	}
    /*************************************************************分组管理 end ****************************************/
}