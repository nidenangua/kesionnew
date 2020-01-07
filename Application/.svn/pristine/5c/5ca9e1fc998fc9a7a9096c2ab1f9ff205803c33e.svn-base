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
class UserController extends Controller
{
	 public  function _initialize(){
		 $userinfo              = getsession('user');
		 $this->userinfo        = User_GetUserInfo();
		 if($this->userinfo == null) {
              exit("<script>top.location.href='".M_URL('Login')."'</script>");
         }else{
			  $this->userid     = $this->userinfo['userid'];//用户id
		      $this->wxid       = $this->userinfo['wxid'];//网校id
		      $this->powertype  = $this->userinfo['powertype'];//权限类型
			  $usersModel       = M('common_user');
			  $countNum         = $usersModel->getOne('count(*)',"where userid=".$this->userinfo['userid']);
			  if($countNum!=='1'){
				  putsession('user',null);
				  exit("<script>top.location.href='".M_URL('Register')."'</script>");
			  }
		 }
	 }
	 public function indexAction(){
		 $base          = $this->cache->GetACache('setting');//读出缓存
		 if(cookie('indoor')!==null){
			$indoorurl  = cookie('indoor');
		 }elseif($base['registerinfo']==1&&$this->userinfo['email']==''){
			$indoorurl  = M_URL('User','editUsers','-1');
		 }else{
			$indoorurl  = M_URL('Index','mainfirst');
		 }
		 $websiteinfo   = $this->cache->GetHCache('website',$this->wxid);//读出缓存
		 $package       = $websiteinfo['package'];
		 $versionname   = $this->cache->GetA('commonpackageversion','versionename',$package,'versionname');
		 $base          = $this->cache->GetACache('setting');//读出缓存
         $appuserrelate = M('Application/IndexModel/common_app_userrelate');
         $appcategory   = $this->cache->GetA('appcategory','parentid',0);//读取缓存
		 $appshort      = $appuserrelate->getshort();
		 $info          = $this->cache->GetA('domaininfo','wxid',$this->wxid,'',true);//读出缓存
         include  CURR_VIEW_PATH . "index.php";
    }
	/**
     * HOME进入编辑机构页面
	 */
	public function editUsersAction(){
		 $status     = ChkSQL(KS_G('request.id'));
		 $tableModel = M('common_table');
		 //if($this->userinfo['mobile'] !== null){
		 if($this->userinfo['usertype'] == 0){
			 $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
		 }elseif($this->userinfo['usertype'] == 1){
			 $tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
		 }elseif($this->userinfo['usertype'] == 2){
			 $tableid = $tableModel->getOne('tableid',"where tablename='common_user_school'");
		 }
		 //$userscategory = $this->cache->getACache('userscategory');//取出缓存
		 $Linkage = Linkage(array());
		 $Linkage->cachename  = 'userscategory';
		 $Linkage->inputname  = 'categoryid';
		 $Linkage->categoryid = $this->userinfo['categoryid'];
		 $areaid = 0;
		 if($this->userinfo['provinceid']!=0){
			 $areaid = $this->userinfo['provinceid'];
			 if($this->userinfo['cityid']!=0){
				$areaid = $this->userinfo['cityid'];
				if($this->userinfo['countyid']!=0)
				{$areaid = $this->userinfo['countyid'];}
			 }
		 }
		 //$areainfo = $this->cache->getACache('areainfo');//取出缓存
		 $link     = Linkage(array());
		 $link->cachename      = 'areainfo';
		 $link->inputname      = 'areaid';// <select name='' /> 里的name值
		 $link->idname         = 'id';
		 $link->funcname       = 'getchildtwo';
		 $link->childvaluename = 'city';
		 $link->childidname    = 'id';
		 $link->categoryid     = $areaid;
		 //}
		 include  CURR_VIEW_PATH . "user_add.php";
	 }
	 /**
     * 保存编辑机构资料操作
	  */
	 public function doeditUsersAction(){
		 $status           = ChkSQL(KS_G('request.id'));
		 $tableModel       = M('common_table');
		 if(!empty($this->userinfo['mobile'])&&($this->userinfo['username']==$this->userinfo['mobile'])){
             $username =  ChkUserName(KS_G('post.username'));
             if (!empty($username)){

                 if (mb_strlen($username)<5 ||mb_strlen($username)>20){
                     KS_Alert('出错啦，登录用户名长度必须是4-20字之间。','error');
                 }
                 $Data['username'] =$username;
             }
		 }
		 $Data['email']      = ChkSQL(KS_G('post.email'));
//		 $Data['realname']   = ChkUserName(KS_G('post.name'));
		 //$Data['usertype'] = ChkSQL(KS_G('post.usertype'));
		 $Data['usertype'] = $this->userinfo['usertype'];
		 //$Data['mobile']   = ChkSQL(KS_G('post.mobile'));
		 $usersModel       = M('common_user');
		 if(!empty($this->userinfo['mobile'])&&($this->userinfo['username']==$this->userinfo['mobile'])){
		     $Rule['username'] = '用户名|isEmpty,isDbexis';
		 }
		 $Rule['email']    = '邮箱|isEmpty,isEmail';
		 //$Rule['mobile']   = '手机|isEmpty,isMobile';
		 if(!empty(ChkSQL(KS_G('post.defaultpic')))){
	         $dir1             = Img(ChkSQL(KS_G('post.defaultpic')));
	         $dir2             = ROOT.'Images/users/'.$this->userid.'/'.KS_MD5($this->userid).'.jpg';
	         $this->File->unlinkFile($dir2);
	         $content = file_get_contents($dir1);
			 file_put_contents($dir2, $content);
			 $Datas['head']  = Img(ChkSQL(KS_G('post.defaultpic')));
		 }
		 //Chkpost($Data,$Rule,$usersModel,"userid!=$this->userid and parentid=0");
		 Chkpost($Data,$Rule,$usersModel,"userid!=$this->userid and (usertype=1 or usertype=2)");
		 //插第二张表
		 $areaModel = M('common_area');
		 $areaid    = ChkClng(KS_G('post.areaid'));
		 if($areaid!=0){
			$depth = $areaModel->getOne('depth',"where id=$areaid limit 1");
			if($depth==3){
				$Datas['countyid']   = $areaid;
				$Datas['cityid']     = $areaModel->getOne('parentid',"where id=$Datas[countyid] limit 1");
				$Datas['provinceid'] = $areaModel->getOne('parentid',"where id=$Datas[cityid] limit 1");
			}elseif($depth==2){
				$Datas['countyid']   = 0;
				$Datas['cityid']     = $areaid;
				$Datas['provinceid'] = $areaModel->getOne('parentid',"where id=$Datas[cityid] limit 1");
			}elseif($depth==1){
				$Datas['countyid']   = 0;
				$Datas['cityid']     = 0;
				$Datas['provinceid'] = $areaid;
			}
		 }
         $schoolname= ChkUserName(KS_G('post.name'));
		 $Datas['name']  = $schoolname;
		 $Datas['ename'] =  ChkUserName(KS_G('post.ename'));
		 if($Data['usertype'] == '1'){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
			$Datas['categoryid'] = ChkClng(KS_G('post.categoryid'));//应用分类ID
			$Datas['Sex'] = ChkSQL(KS_G('post.Sex'));
			$Datas['shortIntro'] = ChkSQL(KS_G('post.shortIntro'));
			/*----------------------字段拼接测试中------------------------------*/
			$fieldModel = M('common_table_field');//实例化字段表
			$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
			foreach($Field as $Fk => $Fv){
			     $fieldname = $Fv['fieldname'];
			     $Datas[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
			     if($Fv['mustinput']==1)
			     {
                     $Rule[$fieldname]  = $Fv['title'].'|isEmpty';
                 }
			}
			/*----------------------------------------------------*/
			$user_teacher = M('common_user_teacher');
			$countNum = $user_teacher->getOne('count(*)',"where userid=$this->userid");
			if($countNum!=='1'){
				 $user_teacher->delete("userid=$this->userid");
				 $Datats['userid'] = $this->userid;
				 $user_teacher->doEfAdd($Datats);
			}
			$result = $user_teacher->update($Datas,"userid=$this->userid");
			$userinfo = $usersModel->getRow("as a left join `$user_teacher->table` as b on a.userid = b.userid WHERE a.userid =$this->userid limit 1");
		 }else{
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
			$user_school = M('common_user_school');
			$countNum = $user_school->getOne('count(*)',"where userid=$this->userid");
			if($countNum!=='1'){
				 $user_school->delete("userid=$this->userid");
				 $Datats['userid'] = $this->userid;
				 $user_school->doEfAdd($Datats);
			}
			$result = $user_school->update($Datas,"userid=$this->userid");
			$userinfo = $usersModel->getRow("as a left join `$user_school->table` as b on a.userid =b.userid WHERE a.userid =$this->userid limit 1",'b.*,a.*');

			$Data001["sharetitle"]=$Data001["wititle"]=$Data001["sitename"]= $schoolname;
			$websiteModel=M('common_user_website');
			$websiteModel->update($Data001,'wxid='.$this->wxid);
		    $this->cache->PutHCache('website',$this->wxid);//写入缓存
		 }
		 $status = ChkSQL(KS_G('request.id'));
		 $Data['nickname'] = $Datas['name'];
		 $result = $usersModel->update($Data,"userid=$this->userid");
		 $userinfo = User_GetUser($this->userid,true);
		 putsession('user',$userinfo);
		 
         if($status == -1){
             cookie('indoor',null);
             KS_Alert('修改成功！','success',M_URL);
		 }elseif($status == -2){
             KS_Alert('修改成功！','success',M_URL);
		 }else{
             KS_Alert('修改成功！','success',M_URL('User','editUsers'));
            // KS_INFO('修改成功!',0,M_URL('User','editUsers'));
         }
	 }
	 /**
	  * 注销登录
	  */
	 public function logoutAction(){
	 	 $Data001['userid'] = $this->userid;
		 $Data001['wxid']   = $this->wxid;
		 $Data001['type']   = 1;
		 $LoginModel        = M('Application/LoginModel');
         $LoginModel->loginlog($Data001); //登记登录用户信息
		 cookie('indoor',null);           // 清空当前设定前缀的所有cookie值
         putsession('user',null);
         die("<script>top.location.href='".MY_FULLDOMAIN."'</script>");
       //  die("<script>top.location.href='".MY_FULLDOMAIN."/login'</script>");
	 }
	 /**
     * 进入实名认证
	  */
	 public function realNameAction(){
//		 die ("<script>top.location.href='/home.html#/ApplyFor';</script>");
		 $from=KS_S('from');   //是否申请扶持计划，是的话为 apply
		 $realModel = M('common_realname');
		 $real = $realModel->getRow(' where wxid =  '.$this->wxid.' order by id desc limit 1');
		 if($real['usertype']==1){
			die ("<script>top.location.href='/home.html#/ApplyFor';</script>");
		 }
//		 var_dump($this->userinfo);die;
		 if (!$real&&$this->userinfo['usertype']==1){
			 die ("<script>top.location.href='/home.html#/ApplyFor';</script>");
		 }
		 $areainfo = $this->cache->getACache('areainfo');//取出缓存
		 $link = Linkage(array());
		 $link->cachename      = 'areainfo';
		 $link->inputname      = 'areaid';// <select name='' /> 里的name值
		 $link->idname         = 'id';
		 $link->funcname       = 'getchildtwo';
		 $link->childvaluename = 'city';
		 $link->childidname    = 'id';
		 if($real){
			 $link->categoryid = $real['areaid'];
		 }else{
			 $real['status']   = 3;//未进行认证
		 }
		 include  CURR_VIEW_PATH . "realName.php";
	}
	/**
     * 进行实名认证
	 */
	public function dorealNameAction(){
         $from             = ChkSQL(KS_S('from'));
         $usertype         = ChkClng(KS_G('post.usertype'));
         if ($from=='apply') $usertype=1;

		 $realModel        = M('common_realname');
		 $real             = $realModel->getRow('where wxid = '.$this->wxid.' limit 1');
         if ($real){
             if ($real['from']=='apply') $from='apply';
         }
		 $Data['wxid']     = $this->wxid;
		 $Data['usertype'] = $usertype;
         $Data['from']     = $from;
		 $Data['status']   = 0;
		 $Data['userid']   = $this->userid;
		 if($Data['usertype'] == 1){
		     $Data['realName'] = ChkSQL(KS_G('post.realName1'));
			 $Data['numberId'] = ChkSQL(KS_G('post.numberId1'));
			 $Data['tel']      = ChkSQL(KS_G('post.tel1'));
			 $Data['address']  = ChkSQL(KS_G('post.address1'));
			 $Data['areaid']   = ChkClng(KS_G('post.areaid'));
			 $Rule['realName'] = '会员用户名|isEmpty';
			 $Rule['numberId'] = '身份证号|isEmpty,isDbexis';
			 $Rule['tel']      = '电话|isEmpty';
			 $Rule['address']  = '具体地址|isEmpty';
			 if(!empty(ChkSQL(KS_G('post.realPhoto11')))){
		 		 $Data['realPhoto1']      = ChkSQL(KS_G('post.realPhoto11'));//身份证正面
		 		 $Rule['realPhoto1']         = '身份证正面|isEmpty';
			 }
			 if(!empty(ChkSQL(KS_G('post.realPhoto21')))){
		 		 $Data['realPhoto2']      = ChkSQL(KS_G('post.realPhoto21'));//身份证反面
		 		 $Rule['realPhoto2']         = '身份证反面|isEmpty';
			 }
		 }else{
		     $Data['realName'] = ChkSQL(KS_G('post.realName'));
			 $Data['numberId'] = ChkSQL(KS_G('post.numberId'));
			 $Data['tel']      = ChkSQL(KS_G('post.tel'));
			 $Data['address']  = ChkSQL(KS_G('post.address'));
			 $Data['areaid']   = ChkClng(KS_G('post.areaid'));
			 $Rule['realName'] = '会员用户名|isEmpty';
			 $Rule['numberId'] = '营业证件号|isEmpty';
			 $Rule['tel']      = '电话|isEmpty';
			 $Rule['address']  = '具体地址|isEmpty';
			 $Rule['realPhoto1'] = '身份证正面|isEmpty';
			 $Rule['realPhoto2'] = '身份证反面|isEmpty';

			 if(!empty(ChkSQL(KS_G('post.realPhoto1')))){
		 		 $Data['realPhoto1']      = ChkSQL(KS_G('post.realPhoto1'));//身份证正面

			 }
			 if(!empty(ChkSQL(KS_G('post.realPhoto2')))){
		 		 $Data['realPhoto2']      = ChkSQL(KS_G('post.realPhoto2'));//身份证反面
			 }
		 }

		 if($Data['usertype'] == 1){
			 $Rule['teacherPhoto']      = '教师资格|isEmpty';
			 if(!empty(ChkSQL(KS_G('post.teacherPhoto11')))){
		 	    $Data['teacherPhoto'] = ChkSQL(KS_G('post.teacherPhoto11'));//教师资格
		     }
		 }elseif($Data['usertype'] == 2){
			 $Rule['teacherPhoto']      = '营业执照|isEmpty';
		 	 if(!empty(ChkSQL(KS_G('post.teacherPhoto')))){
		 	    $Data['teacherPhoto'] = ChkSQL(KS_G('post.teacherPhoto'));//营业执照
		     }
			 $Data['contacts'] = ChkSQL(KS_G('post.contacts'));
			 $Data['range'] = ChkSQL(KS_G('post.range'));
		 }
		 $Data['adddate'] = time();

		 Chkpost($Data,$Rule,$realModel,'wxid!='.$this->wxid);
		 if(!$real['id']){$realModel->doAdd($Data,'id');}
		 else{$realModel->update($Data,'id ='.$real['id']);}

		 //插入第二张表
		if($Data['usertype'] == '1'){
			$Datas['userid'] = $this->userid;
			$user_teacher    = M('common_user_teacher');
			$usercount       = $user_teacher->getOne('count(userid)','where userid='.$this->userid);
			if($usercount==0){echo '8888';$user_teacher->doEfAdd($Datas);}
		}else{
			$Datas['userid'] = $this->userid;
			$user_school     = M('common_user_school');
			$usercount       = $user_school->getOne('count(userid)','where userid='.$this->userid);
			if($usercount==0){$user_school->doEfAdd($Datas);}
		}

		 $userModel        = M('common_user');
		 $userData['usertype'] = $Data['usertype'];
		 $userModel->update($userData,'wxid ='.$this->wxid.' and userid='.$this->userid);

		 $this->cache->PutHCache('realname',$this->wxid);

         

		 $url =  M_URL('User','realName');
		 KS_INFO('提交成功，等待审核',0,$url);
	}
}