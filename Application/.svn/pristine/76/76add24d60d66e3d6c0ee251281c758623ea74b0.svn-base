<?php
// +----------------------------------------------------------------------
// | KesionPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2019 http://www.kesion.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 厦门科汛软件有限公司　 版权所有 © 2006-2017
// +----------------------------------------------------------------------
// | Advice: 好的编程习惯是成功的一半，对齐，注释  你可以的！
// +----------------------------------------------------------------------



use Kesion\Controller;
class UsersController extends CommonController
{
    /**
     * 进入会员列表页
     */
    public function indexAction(){
		$usertype    = ChkClng(KS_S('usertype',0));
        if ($usertype==3) $usertype=0;
		$usersModel = M('common_user');
		$adddate    = null !==GF('adddate') ? GF('adddate'):'1';
		$money    = null !==GF('money') ? GF('money'):'1';
		if($usertype == 0){
			$maxpage = 10;
			$where = "where a.userid!=0 and usertype=0";

			$wxid    = null !==GF('wxid') ? GF('wxid'):'';
			if(!empty($wxid)){
				$where.=" and a.wxid=$wxid";
			}
			$Model = M('common_user_member');
			$categoryid=null !==GF('categoryid') ? GF('categoryid'):0;//分类
			if($categoryid!=0){$where .= " and (c.parentidpath like '%$categoryid,%' or c.categoryid=$categoryid)";}
			$keyword=KS_S('keyword');
			$keytype=KS_S('keytype',1);
			if(!empty($keyword)){
				if($keytype==1){$where.=" and a.username like '%$keyword%'";
				}elseif($keytype==2){$where.=" and b.name like '%$keyword%'";
				}elseif($keytype==3){$where.=" and a.email like '%$keyword%'";
				}elseif($keytype==4){$where.=" and a.wxid=$keyword";}elseif($keytype==5){$where.=" and a.userid=$keyword";}
			}
		}elseif($usertype == 1){
			$maxpage = 10;
			$where = "where a.userid!=0 and a.usertype=1";
			$Model = M('common_user_teacher');
			$categoryid=null !==GF('categoryid') ? GF('categoryid'):0;//分类
			if($categoryid!=0){$where .= " and (c.parentidpath like '%$categoryid,%' or c.categoryid=$categoryid)";}
			$keyword=KS_S('keyword');
			$keytype=KS_S('keytype',1);
			if(!empty($keyword)){
				if($keytype==1){$where.=" and a.username like '%$keyword%'";
				}elseif($keytype==2){$where.=" and b.name like '%$keyword%'";
				}elseif($keytype==3){$where.=" and a.email like '%$keyword%'";
				}elseif($keytype==4){$where.=" and a.wxid=$keyword";}elseif($keytype==5){$where.=" and a.userid=$keyword";}
			}
			$teachers= $usersModel->getAll('where usertype = 1','count(*) as sum');
		}elseif($usertype == 2){
			$maxpage = 10;
			$where = "where a.userid!=0 and a.usertype=2";
			$Model = M('common_user_school');
			$categoryid=null !==GF('categoryid') ? GF('categoryid'):0;//分类
			if($categoryid!=0){$where .= " and (c.parentidpath like '%$categoryid,%' or c.categoryid=$categoryid)";}
			$keyword = ChkSQL(KS_S('keyword'));
			$keytype = ChkClng(KS_S('keytype',1));
			if(!empty($keyword)){
				if($keytype==1){$where.=" and a.username like '%$keyword%'";
				}elseif($keytype==2){$where.=" and b.name like '%$keyword%'";
				}elseif($keytype==3){$where.=" and a.email like '%$keyword%'";
				}elseif($keytype==4){$where.=" and a.wxid=$keyword";}elseif($keytype==5){$where.=" and a.userid=$keyword";}
			}
			$wx = $usersModel->getAll('where usertype = 2','count(*) as sum');
		}
		//状态筛选
		$status = KS_S('status',3);
		// if($status == 2){$where .= ' and a.status=2';}
		if($status==1){$where .= ' and a.status=1';}
		elseif($status==0){$where .= ' and (a.status=0 or a.status=2)';}
		$userscategory = $this->cache->getACache('userscategory');//取出缓存

		$orderby[GN('money')] = 'money/a.money';
		$orderby[GN('adddate')]         = 'adddate/a.regdate';

		$m =mktime(0,0,0,date('m'),1,date('Y'));
		$day =  mktime(0,0,0,date('m'),date('d'),date('Y'));
		if(date("w")==0){$wday = 7;}else{$wday = date("w");}
		$week =  mktime(0,0,0,date("m"),date("d")-$wday+1,date("Y"));
		$year =  mktime(0,0,0,1,1,date('Y'));

//		var_dump($byname);exit;
		$user_category = M('common_user_category');
		$where = "as a left join `$Model->table` as b on a.userid = b.userid left join `$user_category->table` as c on b.categoryid = c.categoryid $where";

		$yearCout = $usersModel->getOne('count(a.userid)',$where.' and a.regdate>'.$year);
		$mCout = $usersModel->getOne('count(a.userid)',$where.' and a.regdate>'.$m);
		$weekCount = $usersModel->getOne('count(a.userid)',$where.' and a.regdate>'.$week);
		$dayCout = $usersModel->getOne('count(a.userid)',$where.' and a.regdate>'.$day);

		$weekHYCount = $usersModel->getOne('count(a.userid)',$where.' and a.lastlogintime>'.$week);
		$dayHYCout = $usersModel->getOne('count(a.userid)',$where.' and a.lastlogintime>'.$day);

		$options  = $usersModel->getOptions($maxpage,$where);//分页参数设置
		$page     = Page($options);
		$UsersAll = $usersModel->getPage($page,OB($orderby),$where,'b.*,a.*,c.categoryname');
		$orderMode = M('app_order_info');
		if($usertype==0 || $usertype==3){
			foreach($UsersAll as $k=>$v){
				$sum = $orderMode->getAll('where memberid='.$v['userid'].' and type =0','count(*) as sum');
				$UsersAll[$k]['sum'] = $sum[0]['sum'];
			}
			include  CURR_VIEW_PATH . "Users/member_list.php";
		}else{
			include  CURR_VIEW_PATH . "Users/users_list.php";
		}
    }
    //查看用户详情
    public function detailsAction(){
		$id = ChkSQL(KS_G("get.id"));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$this->userModel = M('common_user');
		$this->AppModel = M('common_user_member');
		$userinfo  = $this->userModel->getRow('where userid ='.$id.' limit 1');
		$userinfo2 = $this->AppModel->getRow('where userid ='.$id.' limit 1');
		$province                      = $this->cache->GetA('areainfo','id',$userinfo2['provinceid'],'city');
		$province                      = $province?$province:'';
		$city                          = $this->cache->GetA('areainfo','id',$userinfo2['cityid'],'city');
		$city                          = $city?$city:'';
		$county                        = $this->cache->GetA('areainfo','id',$userinfo2['countyid'],'city');
		$county                        = $county?$county:'';
		$userinfo2['taddress']         = $province.$city.$county?$province.$city.$county:'未完善';
	    $where       = "where wxid =".$userinfo['wxid']." and memberid=$id";
	    $type        = ChkClng(KS_S('type'));
		if($type    ==3){$where .= ' and (type=0 or type=1 )';}
		elseif($type==1){$where .= ' and type=1';}
		elseif($type==0){$where .= ' and type=0';}
	    $app_order   = M('app_order_info');
		$options     = $app_order->getOptions('10',$where);//分页参数设置
		$page        = Page($options);
		$orders      = $app_order->getPage($page,'adddate desc',$where);
//		foreach($orders as $k =>$v){
//			if($v['type']==0){
//
//			}elseif($v['type']==1){
//
//			}
//		}
		include  CURR_VIEW_PATH . "Users/memberDetail.php";
	}
   public function userdetailsAction(){
		$id = ChkSQL(KS_G("get.id"));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$this->userModel = M('common_user');

		$userinfo  = $this->userModel->getRow('where userid ='.$id.' limit 1');
		if($userinfo['usertype']==1){
			$this->AppModel = M('common_user_teacher');
		}else{
			$this->AppModel = M('common_user_school');
		}
		$userinfo2 = $this->AppModel->getRow('where userid ='.$id.' limit 1');
		$province                      = $this->cache->GetA('areainfo','id',$userinfo2['provinceid'],'city');
		$province                      = $province?$province:'';
		$city                          = $this->cache->GetA('areainfo','id',$userinfo2['cityid'],'city');
		$city                          = $city?$city:'';
		$county                        = $this->cache->GetA('areainfo','id',$userinfo2['countyid'],'city');
		$county                        = $county?$county:'';
		$userinfo2['taddress']         = $province.$city.$county?$province.$city.$county:'未完善';
		include  CURR_VIEW_PATH . "Users/userdetail.php";
	}

    	//更新用户状态
	public function updatestatusAction(){
		$id = ChkSQL(KS_G("get.id"));
		$this->userModel = M('common_user');
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$wxid   = ChkClng(null !==GF('wxid') ? GF('wxid'):'1');
		$status = $this->userModel->getOne('status','where userid ='.$id);

		if($status==1){$Data['status']=0;}elseif($status==0){$Data['status']=1;}elseif($status==2){$Data['status']=1;}
		$this->userModel->update($Data,'userid ='.$id);
		echo $Data['status'];
	}
    public function deleteAction(){
    	$id            = ChkClng(KS_G('request.id'));
    	$now_page   = ChkClng(KS_S('p',1));
    	$usertype = ChkClng(KS_S('usertype',3));
    	// var_dump($id);exit();
    	$usersModel = new UsersModel('common_user');
    	if($usertype == 1){
		   $user_teacher = new UsersModel('common_user_teacher');
		   $app_userrelate = new UsersModel('common_app_userrelate');
		   $user_teacher->delete("userid=$id");
		   $app_userrelate->delete("userid=$id");
		   $usersModel->delete("userid=$id");
		}elseif($usertype == 0 || $usertype==3){
		   $user_member = new UsersModel('common_user_member');
		   $user_member->delete("userid=$id");
		   $usersModel->delete("userid=$id");
		}elseif($usertype == 2){
		   $user_school = new UsersModel('common_user_school');
		   $app_userrelate = new UsersModel('common_app_userrelate');
		   $user_school->delete("userid=$id");
		   $app_userrelate->delete("userid=$id");
		   $usersModel->delete("userid=$id");
		}
		$url = M_URL('Users','','',GP('p-'.$now_page));
		 KS_INFO('删除成功',0,$url);
    }
	//进入添加会员页
	public function addUsersAction(){
		$usertype=ChkClng(KS_S('usertype',3));
		$tableModel = new UsersModel('common_table');
		if($usertype == 0){
		    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
		}elseif($usertype == 1){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
		}elseif($usertype == 2){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_school'");
		}
		$Linkage = Linkage(array());
		$Linkage->inputname   = 'categoryid';
		$Linkage->cachename  = 'userscategory';
		$link = Linkage(array());
		$link->cachename      = 'areainfo';
		$link->inputname      = 'areaid';
		$link->idname         = 'id';
		$link->funcname       = 'getchildtwo';
		$link->childvaluename = 'city';
		$link->childidname    = 'id';
		$userinfo = '';
		include  CURR_VIEW_PATH . "Domain/wxpersonal.php";
//      include  CURR_VIEW_PATH . "Users/users_add.php";
    }
	//添加会员操作
	public function doaddUsersAction(){
	    $usertype   = ChkClng(KS_S('usertype',3));
		$tableModel = new UsersModel('common_table');
		//插入第一张表
		$Data['username']     = ChkSQL(KS_G('post.username'));
		$Data['password']     = ChkSQL(KS_G('post.password'));
		$Data['rndpasswordc'] = rand(100000,999999);
		$Data['email']        = ChkSQL(KS_G('post.email'));
		$Data['mobile']       = ChkSQL(KS_G('post.mobile'));
		$Data['regdate']      = ChkClng(time());
		$Data['usertype']     = ChkClng($usertype);
		$Data['status']       = ChkSQL(KS_G('post.status'));
		$usersModel = new UsersModel('common_user');
		$userid = $usersModel->getMaxValue('userid')+1;
		if(!empty($_FILES['file']['tmp_name'])){//上传头像
			$info = $this->upload->uploadHead($_FILES['file'],$userid);
			if(!$info) {KS_INFO($this->upload->getError());}// 上传错误提示错误信息
		}
		$Rule['username']  = '会员用户名|isEmpty,isDbexis';
		$Rule['password']  = '密码|isEmpty,isPassword';
		$Rule['email']     = '邮箱|isEmpty,isEmail';
		Chkpost($Data,$Rule,$usersModel);
		$Data['password'] = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));
		$result = $usersModel->doAdd($Data,'userid');
		//插入第二张表//地区联动数据
		$Datas['userid'] = $result;
		$areaid = ChkClng(KS_G('post.areaid'));
		$areaModel = new UsersModel('common_area');
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
		$Datas['name']  = ChkSQL(KS_G('post.name'));
		$Datas['ename'] = ChkSQL(KS_G('post.ename'));
		$Datas['Sex']   = ChkSQL(KS_G('post.Sex'));
		if($usertype == 0){
		    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
			$Datas['categoryid'] = ChkSQL(KS_G('post.categoryid'));//应用分类ID
			/*----------------------字段拼接测试中------------------------------*/
			$fieldModel = M('common_table_field');//实例化字段表
			$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
			foreach($Field as $Fk => $Fv)
			{
			    $fieldname = $Fv['fieldname'];
			    $Datas[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
			    if($Fv['mustinput']==1)
			    {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
			}
			/*----------------------------------------------------*/
			$user_member = new UsersModel('common_user_member');
			$user_member->doEfAdd($Datas);
		}elseif($usertype == 1){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
			$Datas['categoryid'] = ChkSQL(KS_G('post.categoryid'));//应用分类ID
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
			$user_teacher = new UsersModel('common_user_teacher');
			$user_teacher->doEfAdd($Datas);
		}elseif($usertype == 2){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_school'");
			$Datas['categoryid'] = ChkSQL(KS_G('post.categoryid'));//应用分类ID
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
			$user_school = new UsersModel('common_user_school');
			$user_school->doEfAdd($Datas);
		}
		$url1=M_URL('Users','','',GP(''));
		KS_INFO('添加成功',0,$url1);
    }
	//进入编辑会员页
	public function editUsersAction(){
		$urltype    = ChkClng(null !==GF('urltype') ? GF('urltype'):'0');
		$now_page   = ChkClng(KS_S('p'));
		$userid     = ChkClng(KS_G('get.id'));
		$usertype   = ChkClng(KS_S('usertype',3));
		$tableModel = new UsersModel('common_table');
		$usersModel = new UsersModel('common_user');
		if($usertype == 0 || $usertype == 3){
		    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
			$memberModel = new UsersModel('common_user_member');
			$userinfo = $usersModel->getRow("as a left join `$memberModel->table` as b on a.userid = b.userid WHERE a.userid =$userid limit 1");
		}elseif($usertype == 1){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
			$teacherModel = new UsersModel('common_user_teacher');
			$userinfo = $usersModel->getRow("as a left join `$teacherModel->table` as b on a.userid = b.userid WHERE a.userid =$userid limit 1");
		}elseif($usertype == 2){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_school'");
			$schoolModel = new UsersModel('common_user_school');
			$userinfo = $usersModel->getRow("as a left join `$schoolModel->table` as b on a.userid =b.userid WHERE a.userid =$userid limit 1");
		}
		$Linkage  = Linkage(array());
		$Linkage->inputname  = 'categoryid';
		$Linkage->cachename  = 'userscategory';
		$Linkage->categoryid = $userinfo['categoryid'];

		$areaid   = 0;
		if($userinfo['provinceid']!=0){
			$areaid = $userinfo['provinceid'];
			if($userinfo['cityid']!=0){
				$areaid = $userinfo['cityid'];
				if($userinfo['countyid']!=0){$areaid = $userinfo['countyid'];}
			}
		}
		$link = Linkage(array());
		$link ->cachename      = 'areainfo';
		$link ->inputname      = 'areaid';
		$link ->idname         = 'id';
		$link ->funcname       = 'getchildtwo';
		$link ->childvaluename = 'city';
		$link ->childidname    = 'id';
		$link ->categoryid     =  $areaid;
		include  CURR_VIEW_PATH . "Domain/wxpersonal.php";
//      include  CURR_VIEW_PATH . "Users/users_add.php";
    }
	//编辑会员操作
	public function doeditUsersAction(){
		$urltype    = ChkClng(null !==GF('urltype') ? GF('urltype'):'0');
	    $usertype         = ChkClng(KS_S('usertype',3));
		$now_page         = ChkClng(KS_S('p'));
		$userid           = ChkSQL(KS_G('request.id'));
		$Data['username'] = ChkSQL(KS_G('post.username'));

		$Data['email']    = ChkSQL(KS_G('post.email'));
		$Data['mobile']   = ChkSQL(KS_G('post.mobile'));
		$Data['status']   = ChkSQL(KS_G('post.status'));
		if(!empty($_FILES['file']['tmp_name'])){//上传头像
			$info = $this->upload->uploadHead($_FILES['file'],$userid);
			if(!$info) {KS_INFO($this->upload->getError());}// 上传错误提示错误信息
		}
		if(!empty(KS_G('post.password'))){
			 $Data['rndpasswordc'] = rand(100000,999999);
			 $Data['password']     = KS_MD5(ChkSQL(KS_G('post.password')).KS_MD5($Data['rndpasswordc']));
		}
		$Rule['email']    = '邮箱|isEmpty,isEmail';
		$usersModel       = new UsersModel('common_user');
		Chkpost($Data,$Rule,$usersModel,"userid!=$userid");
		$result = $usersModel->update($Data,"userid=$userid");
		//插第二张表
		$areaModel = new UsersModel('common_area');
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
		$tableModel     = M('common_table');
		$Datas['name']  = ChkSQL(KS_G('post.name'));
		$Datas['ename'] = ChkSQL(KS_G('post.ename'));
		if($usertype == '0'){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
			$Datas['categoryid'] = ChkSQL(KS_G('post.categoryid'));//应用分类ID
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
			$user_member = new UsersModel('common_user_member');
			$result = $user_member->update($Datas,"userid=$userid");
		}elseif($usertype == '1'){
			$Datas['Sex']   = ChkSQL(KS_G('post.Sex'));
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
			$Datas['categoryid'] = ChkSQL(KS_G('post.categoryid'));//应用分类ID
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
			$user_teacher = new UsersModel('common_user_teacher');
			$result = $user_teacher->update($Datas,"userid=$userid");
		}elseif($usertype == '2'){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_school'");
			$Datas['categoryid'] = ChkSQL(KS_G('post.categoryid'));//应用分类ID
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
			$user_school = new UsersModel('common_user_school');
			$result = $user_school->update($Datas,"userid=$userid");
		}
		if($urltype==0){
			$url1=M_URL('Users','','',GP("usertype-$usertype,p-$now_page"));
		}else{
			$url1=M_URL('Domain','wxlist','',GP("usertype-$usertype,p-$now_page"));
		}
		KS_INFO('修改成功',0,$url1);
    }
    //删除会员操作
	public function deleteUsersAction(){
		$now_page   = ChkClng(KS_S('p'));
		$userid     = ChkClng(KS_G('id'));
		$usertype   = ChkClng(KS_S('usertype',3));
		$usersModel = new UsersModel('common_user');
		$userinfo   = $usersModel->getRow("where userid=$userid limit 1",'parentid,usertype,wxid');
		if($userinfo['wxid']==1||$userinfo['wxid']==2){KS_INFO('创始人数据,不允许删除');};
		if($userinfo['parentid']==0&&$userinfo['usertype']!=0){//根据网校id删除表里的数据，这里删的都是创始人的数据
		$tablename     = "";
		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$userinfo['wxid'],'uploadtableid');
		if(!empty($uploadtableid)){
			$extends_table = M('common_extends_table');
			$tablename     = $extends_table->getOne('tablename','where tableid='.$uploadtableid);
		}
		if(!empty($tablename)){$tablename = ','.$tablename;}

		$chaptertablename     = "";
		$chaptertableModel    = M('common_extends_table');
		$chaptertablename     = $chaptertableModel->getOne('tablename','where Isdefault=1 and type =1');
		if(!empty($chaptertablename)){$chaptertablename= ','.$chaptertablename;}

		//app_article
        $deletetable ='app_team,app_team_chat,app_team_link,app_team_member,app_team_topic,common_user_group,common_user_group_buy,common_user_website,common_domain,common_app_userrelate,common_domain_billing,common_voucher,common_service_log,app_answer,app_dir,app_answer_down,app_answer_top,app_cart_course,app_category,app_course,app_course_teacherrelate,app_dayflow,app_email_content,app_email_log,app_file,app_integral_log,app_interact,app_knowledge,app_label,app_live,app_live_list,app_login_content,app_login_log,app_news,common_order,common_order_info,app_order,app_order_info,app_paper,app_paper_answer,app_paper_collection,app_paper_record,app_paper_scorerank,app_paper_test,app_paper_tk,app_paper_tk,app_pay_content,app_pay_log,app_practice_answer,app_questions,app_red_packet,app_red_packetnum,app_reviews,app_sms_content,app_sms_log,app_study_card,app_study_cardnum,app_task,app_task_answer,app_task_paper,app_temp,app_paper_collection,app_vod,app_vod_list,app_wechat_count,app_wechat_menu,app_wechat_news,app_wechat_qunfa,app_wechat_reply,app_wechat_rnews,app_wechat_sucai,app_wechat_tag,app_wechat_template,app_wechat_user_group,app_weixin_applet,app_weixin_config,app_weixin_material,app_weixin_user,app_wxapplet_config,app_wxapplet_pages,app_wxapplet_setting,app_live_secret,app_roomsetting,common_login_log,common_pay_log,app_temp_path,app_dir'.$tablename.$chaptertablename;
			$tablearr = explode(',',$deletetable);
			foreach($tablearr as $k=>$v){
				 if(!empty($v)){$tablemodel = M($v);$tablemodel->delete("wxid=".$userinfo['wxid']);}
			}
			$usersModel->delete("wxid=".$userinfo['wxid']);
			$this->File->unlinkDir(ROOT.'Images/courseware/'.$userinfo['wxid'].'/');
			$this->File->unlinkDir(ROOT.'Images/school/'.$userinfo['wxid'].'/');
			$this->File->unlinkDir(ROOT.'Images/schoolfile/'.$userinfo['wxid'].'/');
			$this->File->unlinkDir(ROOT.'Skin/'.$userinfo['wxid'].'/');
			$this->File->unlinkDir(ROOT.'Runtime/LabelSchool/'.$userinfo['wxid'].'/');
			$this->File->unlinkDir(ROOT.'Runtime/SchoolData/'.$userinfo['wxid'].'/');
			$this->File->unlinkDir(ROOT.'Runtime/TempCache/'.$userinfo['wxid'].'/');
			$this->cache->putACache('domaininfo');//写入缓存
		}else{
			//删除第二张表的数据
			if($userinfo['usertype'] == '1'){
			   $user_teacher = new UsersModel('common_user_teacher');
			   $user_teacher->delete("userid=$userid");
			}elseif($userinfo['usertype']=='2'){
			   $user_school = new UsersModel('common_user_school');
			   $result      = $user_school->delete("userid=$userid");
			}
			//删除第一张表的数据
			$usersModel->delete("userid=$userid");
		}
		$url = M_URL('Users','','',GP('p-'.$now_page));
		ks_header($url);
    }
    /**
     * 删除店铺
     */
    public function deleteUserswxAction(){
		$now_page   = ChkClng(KS_S('p'));
		$userid     = ChkClng(KS_G('id'));
		$usertype   = ChkClng(KS_S('usertype',3));
		$usersModel = new UsersModel('common_user');
		$userinfo   = $usersModel->getRow("where userid=$userid limit 1",'parentid,usertype,wxid');
		if(empty($userinfo['wxid'])){
			$userinfo['wxid']     = ChkClng(KS_S('wxid'));
			$userinfo['parentid'] = 0;
			$userinfo['usertype'] = 1;
		}
		if($userinfo['wxid']==1||$userinfo['wxid']==2){KS_INFO('创始人数据,不允许删除');};
		if($userinfo['parentid']==0&&$userinfo['usertype']!=0){//根据网校id删除表里的数据，这里删的都是创始人的数据
            $tablename     = "";
            $uploadtableid = $this->cache ->GetA('domaininfo','wxid',$userinfo['wxid'],'uploadtableid');
            if(!empty($uploadtableid)){
                $extends_table = M('common_extends_table');
                $tablename     = $extends_table->getOne('tablename','where tableid='.$uploadtableid);
            }
            if(!empty($tablename)){$tablename = ','.$tablename;}


            $chaptertablename     = "";
            $chaptertableModel    = M('common_extends_table');
            $chaptertablename     = $chaptertableModel->getOne('tablename','where Isdefault=1 and type =1');
            if(!empty($chaptertablename)){$chaptertablename= ','.$chaptertablename;}


            $deletetable ='common_user_website,common_domain,common_app_userrelate,common_domain_billing,common_voucher,common_service_log,app_answer,app_dir,app_answer_down,app_answer_top,app_cart_course,app_category,app_course,app_course_teacherrelate,app_dayflow,app_email_content,app_email_log,app_file,app_integral_log,app_interact,app_knowledge,app_label,app_live,app_live_list,app_login_content,app_login_log,app_news,common_order,common_order_info,app_order,app_order_info,app_paper,app_paper_answer,app_paper_scorerank,app_paper_tk,app_pay_content,app_pay_log,app_practice_answer,app_questions,app_red_packet,app_red_packetnum,app_reviews,app_sms_content,app_sms_log,app_study_card,app_study_cardnum,app_task,app_task_answer,app_task_paper,app_temp,app_paper_collection,app_vod,app_vod_list,app_wechat_count,app_wechat_menu,app_wechat_news,app_wechat_qunfa,app_wechat_reply,app_wechat_rnews,app_wechat_sucai,app_wechat_tag,app_wechat_template,app_wechat_user_group,app_weixin_applet,app_weixin_config,app_weixin_material,app_weixin_user,app_wxapplet_config,app_wxapplet_pages,app_wxapplet_setting,app_live_secret,app_roomsetting,common_login_log,common_pay_log,app_temp_path,app_dir,app_column,app_carousel,app_team'.$tablename.$chaptertablename;
			$tablearr = explode(',',$deletetable);
			foreach($tablearr as $k=>$v){
                if(!empty($v)){
                    $tablemodel = M($v);
                    if ($tablemodel->checkTable()){
                        $tablemodel->delete("wxid=".$userinfo['wxid']);
                    }
                }
			}

            $users=M('common_user_member');
            $users->delete('userid in(select userid from '.$usersModel->table.' where wxid='.$userinfo['wxid'].')');
            $users=M('common_user_teacher');
            $users->delete('userid in(select userid from '.$usersModel->table.' where wxid='.$userinfo['wxid'].')');
            $users=M('common_user_school');
            $users->delete('userid in(select userid from '.$usersModel->table.' where wxid='.$userinfo['wxid'].')');
			$users=M('common_user_browsing');//名片收藏夹
			$users->delete('teacherid in(select userid from '.$usersModel->table.' where wxid='.$userinfo['wxid'].')');
			$users=M('common_user_cardgroup');//名片组成员
			$users->delete('userid in(select userid from '.$usersModel->table.' where wxid='.$userinfo['wxid'].')');
			$users=M('common_user_cardgroup_relate');//名片组成员
			$users->delete('userid in(select userid from '.$usersModel->table.' where wxid='.$userinfo['wxid'].')');
			$users=M('app_column_link');
            $users->delete('columnid not in(select columnid from ks_app_column where wxid='.$userinfo['wxid'].')');
			$users=M('common_realname');
			$users->delete('wxid='.$userinfo['wxid']);

			$usersModel->delete("wxid=".$userinfo['wxid']);



			$this->File->unlinkDir(ROOT.'Images/courseware/'.$userinfo['wxid'].'/');
			$this->File->unlinkDir(ROOT.'Images/school/'.$userinfo['wxid'].'/');
			$this->File->unlinkDir(ROOT.'Images/schoolfile/'.$userinfo['wxid'].'/');
			$this->File->unlinkDir(ROOT.'Skin/'.$userinfo['wxid'].'/');
			$this->File->unlinkDir(ROOT.'Runtime/LabelSchool/'.$userinfo['wxid'].'/');
			$this->File->unlinkDir(ROOT.'Runtime/SchoolData/'.$userinfo['wxid'].'/');
			$this->File->unlinkDir(ROOT.'Runtime/TempCache/'.$userinfo['wxid'].'/');
			$this->cache->putACache('domaininfo');//写入缓存
		}else{
			//删除第二张表的数据
			if($userinfo['usertype'] == '1'){
                $user_teacher = new UsersModel('common_user_teacher');
                $user_teacher->delete("userid=$userid");
			}elseif($userinfo['usertype']=='2'){
                $user_school = new UsersModel('common_user_school');
                $result      = $user_school->delete("userid=$userid");
			}
			//删除第一张表的数据
			$usersModel->delete("userid=$userid");
		}
		$url =  M_URL('home/Domain','wxlist','',GP('p-'.$now_page));
		ks_header($url);
    }
    //批量操作
	public function batchAction(){
		$id = ChkSQL(KS_G('request.id'));
		if(empty($id)){KS_INFO("请选择");}
		$now_page = ChkClng(KS_S('p'));
		$batch = $_POST['batch'];
		$usersModel = new UsersModel('common_user');
		$usertype = ChkClng(KS_S('usertype',3));
		if($batch == 0){
		   foreach ($id as $v ){$Data['status'] = 2;$usersModel->update($Data,"userid=$v");}
		   $url = M_URL('Users','','',GP('p-'.$now_page));
		   KS_INFO('锁定成功',0,$url);}
        elseif($batch == 1){
		   foreach ($id as $v ){$Data['status'] = 1;$usersModel->update($Data,"userid=$v");}
		   $url = M_URL('Users','','',GP('p-'.$now_page));
		   KS_INFO('解锁成功',0,$url);}
	    elseif($batch == 2){
		   foreach ($id as $v ){$Data['status'] = 1;$usersModel->update($Data,"userid=$v");}
		   $url = M_URL('Users','','',GP('p-'.$now_page));
		   KS_INFO('审核成功',0,$url);}
	    elseif($batch == 3){
		   foreach ($id as $v ){$Data['status'] = 0;$usersModel->update($Data,"userid=$v");}
		   $url = M_URL('Users','','',GP('p-'.$now_page));
		   KS_INFO('取消审核成功',0,$url);}
	    elseif($batch == 4){
			if($usertype == 1){
			   $user_teacher = new UsersModel('common_user_teacher');
			   $app_userrelate = new UsersModel('common_app_userrelate');
			   foreach($id as $k=>$v){
				   $user_teacher->delete("userid=$v");
				   $app_userrelate->delete("userid=$v");
				   $usersModel->delete("userid=$v");
				}
			}elseif($usertype == 0 || $usertype==3){
				$user_member = new UsersModel('common_user_member');
				foreach($id as $k=>$v){
				   $user_member->delete("userid=$v");
				   $usersModel->delete("userid=$v");
				}
			}elseif($usertype == 2){
			   $user_school = new UsersModel('common_user_school');
			   $app_userrelate = new UsersModel('common_app_userrelate');
			   foreach($id as $k=>$v){
				   $user_school->delete("userid=$v");
				   $app_userrelate->delete("userid=$v");
				   $usersModel->delete("userid=$v");
			   }
		    }
		 $url = M_URL('Users','','',GP('p-'.$now_page));
		 KS_INFO('删除成功',0,$url);
		}
	}
	/**
     * 进入实名认证列表
	 */
	public function realNameAction(){
        $keyword   = ChkSQL(KS_G('post.keyword'));
        $keytype   = ChkClng(KS_G('post.keytype'));


		$stat             = ChkClng(KS_S('stat',3));
		$common_domain    = M('common_domain');
		$where ='';
		$where   .= 'as a inner join '.$common_domain->table.' as b on a.wxid = b.wxid';
		if($stat != 3){ $where.= ' where a.status ='.$stat; }

        if (!empty($keyword)){
            if ($keytype==1){
                $where.=' and a.tel="'.$keyword.'"';
            }else if ($keytype==2){
                $where.=' and a.wxid="'.$keyword.'"';
            }else if ($keytype==3){
                $where.=' and a.realName="'.$keyword.'"';
            }
        }

		$realModel = M('common_realname');
		$options   = $realModel->getOptions('10',$where);//分页参数设置
		$page      = Page($options);
		$realNames = $realModel->getPage($page,'a.adddate desc',$where,'b.*,a.*');
		include  CURR_VIEW_PATH . "Users/realNamelist.php";
	}
    /**
     * 删除实名认证
     */
    public function deleteRealNameAction(){
        $id=ChkClng(KS_S("id"));
        $realModel = M('common_realname');
        $realModel->delete('id='.$id);
        KS_Alert('删除成功！','success',KS_ComeUrl());
    }
	/**
     * 进入详细信息
	 */
	public function dorealAction(){
		$id        = ChkClng(KS_G('get.id'));
		$realModel = M('common_realname');
		$real      =  $realModel->getRow('where id ='.$id);
		if ($real['usertype']==1){
			$area = json_decode($real['areaid'],true);
			$real['areaid'] = $area[count($area)-1];
			$real['course_content'] = json_decode($real['course_content'],true);
			$real['teacherPhoto'] = json_decode($real['teacherPhoto'],true);
			$real['course_type'] = json_decode($real['course_type'],true);
		}

		$link = Linkage(array());
		$link ->cachename      = 'areainfo';//取出缓存
		$link ->inputname      = 'areaid';
		$link ->idname         = 'id';
		$link ->funcname       = 'getchildtwo';
		$link ->childvaluename = 'city';
		$link ->childidname    = 'id';
		$link ->categoryid     =  $real['areaid'];
		include  CURR_VIEW_PATH . "Users/realName.php";
	}
	//进入详细信息
	public function NorealAction(){
		$id        = ChkClng(KS_G('get.id'));
		$realModel = M('common_realname');
		$real      =  $realModel->getRow('where wxid ='.$id);
		$link = Linkage(array());
		$link ->cachename      = 'areainfo';//取出缓存
		$link ->inputname      = 'areaid';
		$link ->idname         = 'id';
		$link ->funcname       = 'getchildtwo';
		$link ->childvaluename = 'city';
		$link ->childidname    = 'id';
		$link ->categoryid     =  $real['areaid'];
		include  CURR_VIEW_PATH . "Users/falseName.php";
	}
	//进入详细信息
	public function dorealwxAction(){
		$now_page   = ChkClng(KS_S('p'));
		$id        = ChkClng(KS_G('get.id'));
		$realModel = M('common_realname');
		$real      =  $realModel->getRow('where wxid ='.$id);
		if(empty($real)){
			KS_INFO('该网校还没提交相关认证材料',3,M_URL('home/Domain','wxlist','',GP('p-'.$now_page)));
		}
		if ($real['usertype']==1){
			$arecount = count(json_decode($real['areaid'],true));
			$real['areaid'] = $real['areaid'][$arecount-1];
		}
		$link = Linkage(array());
		$link ->cachename      = 'areainfo';//取出缓存
		$link ->inputname      = 'areaid';
		$link ->idname         = 'id';
		$link ->funcname       = 'getchildtwo';
		$link ->childvaluename = 'city';
		$link ->childidname    = 'id';
		$link ->categoryid     =  $real['areaid'];
		include  CURR_VIEW_PATH . "Users/realName.php";
	}
	/**
     * 进行编辑，审核
	 */
	public function dorealNameAction(){
		 $id= ChkClng(KS_G('get.id'));
		 $realModel = M('common_realname');
		 $real = $realModel->getRow('where id = '.$id.' limit 1');
		 $Data['realName'] =  ChkSQL(KS_G('post.realName'));
		 $Data['numberId'] = ChkSQL(KS_G('post.numberId'));
		 $Data['tel'] = ChkSQL(KS_G('post.tel'));
		 $Data['address'] = ChkSQL(KS_G('post.address'));
		 $Data['status'] = 0;
//		 $Data['areaid'] = ChkClng(KS_G('post.areaid'));
		 if(!empty($_FILES['realPhoto1']['tmp_name'])){
				$this->upload->removefile($real['photo']);
				$this->upload->savePath = 'users/'.$real['userid'].'/'; // 设置附件上传（子）目录
				$info = $this->upload->uploadOne($_FILES['realPhoto1']);
				if(!$info) {// 上传错误提示错误信息
					KS_INFO($this->upload->getError());
				}else{
					$Data['realPhoto1'] = ChkSQL($this->upload->uootPath.$info['savepath'].$info['savename']);//应用封面图片
				}
		 }
//		 if(!empty($_FILES['teacherPhoto']['tmp_name'])){
//				$this->upload->removefile($real['photo']);
//				$this->upload->savePath = 'users/'.$real['userid'].'/'; // 设置附件上传（子）目录
//				$info = $this->upload->uploadOne($_FILES['teacherPhoto']);
//				if(!$info) {// 上传错误提示错误信息
//					KS_INFO($this->upload->getError());
//				}else{
//					$Data['teacherPhoto'] = ChkSQL($this->upload->uootPath.$info['savepath'].$info['savename']);//应用封面图片
//			    }
//		 }
		 if($real['usertype'] == 1){
				if(!empty($_FILES['realPhoto2']['tmp_name'])){
					$this->upload->removefile($real['photo']);
					$this->upload->savePath = 'users/'.$real['userid'].'/'; // 设置附件上传（子）目录
					$info = $this->upload->uploadOne($_FILES['realPhoto2']);
					if(!$info) {// 上传错误提示错误信息
						KS_INFO($this->upload->getError());
					}else{
						$Data['realPhoto2'] = ChkSQL($this->upload->uootPath.$info['savepath'].$info['savename']);//应用封面图片
					}
				}
		 }
		 if($real['usertype'] == 2){
				$Data['contacts'] = ChkSQL(KS_G('post.contacts'));
				$Data['range'] = ChkSQL(KS_G('post.range'));
			 	$Data1['usertype'] = 2;
		 }
		 $Data['status'] = ChkClng(KS_G('post.status'));
		 $Data['result'] = ChkSQL(KS_G('post.result'));
		 $realModel->update($Data,'id ='.$real['id']);
		 $this->cache->PutHCache('realname','',$real['wxid']);//存入缓存
		 if(ChkClng(KS_G('post.status'))==1){
             if($real['usertype'] == '1' && $Data['status']=='1'){         //扶持版通过审核
                 unset($Data);
                 $db = M('common_user_website');
                 $Data['istry']     = 1;
                 $Data['package']   = 'v0';
                 $db->update($Data,'wxid='.$real['wxid']);
                 $this->cache->PutHCache('website',$real['wxid']);//写入缓存

                 initialStoreService($real['wxid']);  //开通扶持版，赠送相关操作
             }
		 	 $user              =  M('common_user');
		 	 $Data1['realname'] =  ChkSQL(KS_G('post.realName'));
		 	 $Data1['nickname'] =  ChkSQL(KS_G('post.realName'));
		 	 $user->update($Data1,'userid='.$real['userid']);
			 User_GetUser($real['userid'],true);
		 	 $Dotask  = new \Core\Dotask();
      		 $Dotask->checkTask($real['wxid'],1);
			 //短信通知
			 if (ChkClng(KS_G('post.is_sms'))==1){
				 $smsModel = new \Core\Sms();
				 if ($real['usertype'] == '1'){
					 $content = '亲爱的'.$Data1['realname'].'老师，您在科汛V名师的实名认证已通过，您正获得万人名师扶持计划的支持，您的店铺地址：'.shortchain(wx_Url($real['wxid'])).'，请及时登录管理您的店铺！';
				 }else{
					 $content = $Data1['realname'].'机构您好，您在科汛V名师提交的店铺实名认证已通过，您的店铺地址：'.shortchain(wx_Url($real['wxid'])).'，请及时登录管理您的店铺！';
				 }
				 $userInfo = User_GetUser($real['userid']);
				 $smsModel->SendSms($userInfo['username'],$content,'userCor','',$real['wxid'],$real['userid']);
			 }
		 }
		$this->cache->PutHCache('realname',$real['wxid']);//写入缓存
		 KS_INFO('保存成功',0,M_URL('Users','realName'));
	}
	public function userrechargeAction(){
		$userid=KS_G('get.id');//wxid
		include  CURR_VIEW_PATH . "Users/wxrecharge.php";
	}
	public function dorechargeAction(){
		$userid=KS_G('get.id');//wxid
		$common_website = M('common_user');
		$money = KS_G('post.money');
		if(KS_G('post.type')==1){
			$Data['money'] = 'money+'.$money;
		}else{
			$Data['money'] = 'money-'.$money;
		}
		$common_website->update($Data,'userid='.$userid,1);
		 KS_INFO('充值成功');
	}
	public function massageAction(){
     	$id = ChkClng(KS_G('request.id'));
     	$usertype   = ChkClng(KS_S('usertype',3));
     	$userid   = null !==GF('userid') ? GF('userid'):'0';
     	include CURR_VIEW_PATH . "Users/reply_news.php";
     }
     public function massageSendAction(){
     	massageSend(KS_G('post.wxid'),KS_G('post.userid'),0,KS_G('post.massage'),KS_G('post.massage'));
     	$url =M_URL('Users','index','',GP('usertype-'.KS_G('post.usertype')));
     	KS_INFO('发送成功！',3,$url);
     }

    /*名片组管理*/
    public function cardGroupAction(){
        $keytype = ChkClng(KS_S('keytype',1));
        $keyword = ChkSQL(KS_S('keyword'));
        $where ='where id >0';
        if (!empty($keyword)){
            if($keytype==1){$where.=" and title like '%$keyword%'";}
        }
        $user_cardgroup    = M('common_user_cardgroup');
        $options = $user_cardgroup->getOptions('10',$where);
        $page      = Page($options);
        $values = $user_cardgroup->getPage($page,'adddate desc',$where,'id,userid,title,adddate,switch_code');
        foreach ($values as &$item){
            $item['username'] = User_GetUser($item['userid'])['name'];
        }
        $datasum =  count($user_cardgroup->getAll());
        //查询本日
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        $dayCout = $user_cardgroup->getOne('count(id)',"where adddate>=$beginToday && adddate<=$endToday");
        include  CURR_VIEW_PATH . "Users/cardGroup.php";
    }
    /*删除名片组*/
    public function groupdelAction(){
        $id     = ChkClng(KS_G('id'));
        $user_cardgroup = M('common_user_cardgroup');
        $user_cardgroup->delete('id = '.$id.'');
        $user_browsing = M('common_user_cardgroup_relate');
        $user_browsing->delete('groupid = '.$id.'');

        $redis = new \Redis() or die("Cannot load Redis module.");//启动redis 进行缓存
        $redis->connect(REDIS_SERVER,REDIS_PORT);
        $redis->auth(REDIS_PWD);//redis改为你的redis密码
        $redis->del("card_list:$id");
        KS_INFO('删除成功',3,M_URL('Users','cardGroup'));
    }
    /*批量删除组*/
    public function delGroupAllAction(){
        $id = isset($_POST["check"])?$_POST["check"]:'';
        $now_page = ChkClng(KS_S('p',1));
        if(empty($id)){KS_INFO("请选择");}
        $user_cardgroup = M('common_user_cardgroup');
        $user_browsing = M('common_user_cardgroup_relate');
        $url = M_URL('home/Users','cardGroup','',GP('p-'.$now_page));
        $redis = new \Redis() or die("Cannot load Redis module.");//启动redis 进行缓存
        $redis->connect(REDIS_SERVER,REDIS_PORT);
        $redis->auth(REDIS_PWD);//redis改为你的redis密码
        if(KS_G('post.batch')==2){
            $data['json'] = '';
            $data['is_card'] = 0;
            foreach ($id as $v){
                $user_cardgroup->delete('id = '.ChkClng($v).'');
                $user_browsing->delete('groupid = '.ChkClng($v).'');
                $redis->del("card_list:$v");
            }
            KS_INFO('批量删除成功',0,$url);
        }
    }
    /*名片用户管理*/
    public function cardUserAction(){
        $keytype = ChkClng(KS_S('keytype',1));
        $keyword = ChkSQL(KS_S('keyword'));
        $where ='where is_card = 1';
        if (!empty($keyword)){
            if($keytype==1){$where.=" and (realname like '%$keyword%' or nickname like '%$keyword%')";}
            elseif($keytype==2){$where.=" and mobile like '%$keyword%'";}
        }
        $user = M('common_user');
        $options = $user->getOptions('10',$where);
        $page      = Page($options);
        $values = $user->getPage($page,'userid desc',$where,'userid,realname,username,mobile,usertype,nickname');
        foreach ($values as &$item){
            $item['head'] = User_GetUserNameAndHead($item['userid'])['head'];
        }
        //总名片
        $datasum = count($user->getAll('where is_card = 1'));
        //查询本日
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        $dayCout = $user->getOne('count(userid)',"where regdate>=$beginToday && regdate<=$endToday");
        include  CURR_VIEW_PATH . "Users/cardUser.php";
    }
    /*删除用户*/
    public function delCardUserAction(){
        $userid     = ChkClng(KS_G('id'));
        $usersModel = new UsersModel('common_user');
        $data['json'] = '';
        $data['is_card'] = 0;
        $usersModel->update($data,"userid=$userid");
        KS_INFO('删除成功',3,M_URL('Users','cardUser'));
    }
    /*批量删除用户*/
    public function delallAction(){
        $id = isset($_POST["check"])?$_POST["check"]:'';
        $now_page = ChkClng(KS_S('p',1));
        if(empty($id)){KS_INFO("请选择");}
        $common_domain = M('common_user');
        $url = M_URL('home/Users','cardUser','',GP('p-'.$now_page));
        if(KS_G('post.batch')==2){
            $data['json'] = '';
            $data['is_card'] = 0;
            foreach ($id as $v){
                $common_domain->update($data, 'userid='.ChkClng($v).'');
            }
            KS_INFO('批量删除成功',0,$url);
        }
    }
    /*名片查看*/
    public function showCardAction(){
        $id       =  ChkClng(KS_G('request.id'));
        $user = M('common_user');
        $data = $user->getRow('where userid='.$id.'','userid,json,usertype,mobile,username,is_card');
        if ($data['is_card']==1){
            $json = json_decode($data['json'],true);
            if (!empty($json)){
                $data['text_intro'] = $json['text_intro'];
                if (!empty($json['title_tag'])){
                    $data['title_tag'] = implode(",", $json['title_tag']);
                }else{
                    $data['title_tag'] = '';
                }
                $data['weixin'] = $json['weixin'];
                $data['company'] = $json['company'];
                $data['position'] = $json['position'];
                $data['age'] = $json['age'];
            }
        }
        $data['head'] = User_GetUser($data['userid'])['head'];
        include  CURR_VIEW_PATH . "Users/showCard.php";
    }
}
