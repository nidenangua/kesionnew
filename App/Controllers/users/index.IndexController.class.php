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
		$where = 'where a.wxid='.$GLOBALS['_DoM']['wxid'].' and a.parentid!=0';
		if(APPENAME == 'teacher'){//老师
		   $thumbsup       = null !==GF('thumbsup') ? GF('thumbsup'):'0';
		   if($thumbsup!=='0'){//价格筛选
				$thumbsupArr = explode('-',$thumbsup.'--');
				if(ChkClng($thumbsupArr[0])===0&&ChkClng($thumbsupArr[1])===0){
					$where    .= ' and b.thumbsup=0';
				}elseif(ChkClng($thumbsupArr[1])===0){
					$where    .= ' and b.thumbsup>='.ChkClng($thumbsupArr[0]);
				}else{
					$where    .= ' and b.thumbsup>='.ChkClng($thumbsupArr[0]).' and b.thumbsup<='.ChkClng($thumbsupArr[1]);
				}
		   }	
    	   $where      .= '  and a.usertype = 1 and b.isshow=1';//分类
		}else{//学生
		   $where      .= ' and a.usertype = 0';	
		}
		$categoryid = null !==GF('categoryid') ? GF('categoryid'):0;
	    $GLOBALS['_DoM']['categoryid'] = $categoryid;
	    if($categoryid!=0) {$where .= " and (c.parentidpath like '%$categoryid,%' or c.categoryid=$categoryid)";}			
	    $keyword = ChkSQL(KS_S('keyword'));
	    $keytype = ChkClng(KS_S('keytype',1));
        if(!empty($keyword)){ 
		     if($keytype==1){$where.=" and a.username like '%$keyword%'";}
			 elseif($keytype==2){$where.=" and b.teachername like '%$keyword%'";}
			 elseif($keytype==3){$where.=" and a.email like '%$keyword%'";}			   
	    } 
	    $sort = null !==GF('sort') ? GF('sort'):1; 
	    switch($sort){
	    	case 1:$byname = 'a.regdate desc';break;
	    	case 2:$byname = 'a.regdate asc';break;
	    	case 3:$byname = 'a.userid desc';break;
	    	case 4:$byname = 'a.userid asc';break;
	    	case 5:$byname = 'a.userid desc';break;
	    	case 6:$byname = 'a.userid asc';break;
	    	case 7:$byname = 'a.userid desc';break;
	    	case 8:$byname = 'a.userid asc';break;
	    	default:$byname = 'a.userid desc';break;
	    }
		$left_join = M('app_category');//需要连表的在最后left join
		$where = "as a left join `".$this->AppModel->table."` as b on a.userid = b.userid left join `$left_join->table` as c on b.categoryid = c.categoryid $where";
	    $maxPerPage = $this->getMaxPage('users/index.html');
		$options    = $this->userModel->getOptions($maxPerPage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page       = Page($options);
		$dt         = $this->userModel->getPage($page,$byname,$where,'b.*,a.*'); 
		foreach($dt as $k=>$v){
			$dt[$k]['defaultpic'] = $this->upload->getHead($v['userid']);
		}
//		$category = $this->cache->GetHCache('appcategory',$GLOBALS['_DoM']['wxid']);//读出缓存
//		$Linkage = Linkage(array(),$category);	
//		$Linkage->categoryid = $categoryid;
//		$this->assign('Linkage',$Linkage->Linkage(5));
	    $this->assign('page',$page);
		$this->assign('dt',$dt);
		$this->display('users/index.html'); 
     }
	 public function viewAction(){
		$userid        = ChkClng(KS_G('request.id'));
		if(empty($userid)){$userid = $this->userModel->getOne('userid','where wxid='.$GLOBALS['_DoM']['wxid'].' and usertype!=0 limit 1');} 
		$usertype      = $this->userModel->getOne('usertype','where userid='.$userid.' limit 1');
		if(empty($usertype)){echo '黑客进攻';exit;}
		$courseType    = null !==GF('courseType') ? GF('courseType'):0;
		$tableModel    = M('common_table');
		if($usertype == 0){
		    $tableid  = $tableModel->getOne('tableid',"where tablename='common_user_member'");
			$userinfo = $this->userModel->getRow("as a left join `".$this->AppModel->table."` as b on a.userid =b.userid WHERE a.userid =$userid limit 1");
		}elseif($usertype == 1){
			$tableid  = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
			$userinfo = $this->userModel->getRow("as a left join `".$this->AppModel->table."` as b on a.userid = b.userid WHERE a.userid =$userid limit 1");
		}elseif($usertype == 2){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_school'");
		}
		$userinfo['defaultpic']        = $this->upload->getHead($userid);
		$province                      = $this->cache->GetA('areainfo','id',$userinfo['provinceid'],'city');
		$province                      = $province?$province:'';
		$city                          = $this->cache->GetA('areainfo','id',$userinfo['cityid'],'city');
		$city                          = $city?$city:'';
		$county                        = $this->cache->GetA('areainfo','id',$userinfo['countyid'],'city');
		$county                        = $county?$county:'';
		$userinfo['taddress']          = $province.$city.$county?$province.$city.$county:'未完善';
		$GLOBALS['_DoM']['categoryid'] = $userinfo['categoryid'];
		$byname           = 'adddate desc';
		$maxPerPage   = $this->getMaxPage('users/view.html');
		if($courseType==0){
			$where        = "where (courseType=1 or courseType=2 or courseType = 3)";
		}elseif($courseType==1){
			$where        = "where courseType=1";
		}elseif($courseType==2){
			$where        = "where courseType=2";
		}elseif($courseType==3){
			$where        = "where courseType=3";
		}
		$where               .= ' and wxid='.$GLOBALS['_DoM']['wxid'].' and teacherid='.$userid;
		$app_course          = M('app_course');
		$options             = $app_course->getOptions($maxPerPage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page                = Page($options);
		$dt                  = $app_course->getPage($page,$byname,$where); 
//		$Linkage             = Linkage(array()); 
//		$Linkage->cachename  = 'appcategory';
//		$Linkage->wxid       = $GLOBALS['_DoM']['wxid'];	
//		$Linkage->categoryid = $userinfo['categoryid'];
//		$this->assign('Linkage',$Linkage->Linkage(5));
		$this->assign('page',$page);
		$this->assign('dt',$dt);
		$this->assign('field',$userinfo);
		$this->assign('courseType',$courseType);
		$this->display('users/view.html'); 
     }
     //根据参数得到相应的老师课程
     public function CourseAjaxAction(){
		$teacherid   = ChkClng(KS_G("post.teacherid")); 
		if(empty($teacherid)){echo '黑客进攻';exit;}
		$courseType  = ChkClng(KS_G("post.courseType"));
		if($courseType==0){$where = " where (courseType=1 or courseType=2 or courseType = 3)";}
		elseif($courseType==1){$where = "where courseType=1"; }
		elseif($courseType==2){$where = "where courseType=2"; }
		elseif($courseType==3){$where = "where courseType=3";}
		$where .= ' and wxid='.$GLOBALS['_DoM']['wxid'].' and teacherid='.$teacherid;
		$byname     = 'adddate desc';
		$app_course = M('app_course');
		$maxperpage = null !=ChkClng(KS_G('post.maxperpage')) ? ChkClng(KS_G('post.maxperpage')):'4';
		$options    = $app_course->getOptions($maxperpage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page       = Page($options);
		$dt         = $app_course->getPage($page,$byname,$where); 
		foreach($dt as $k=>$v){
			$dt[$k]['defaultpic'] = Img($v['defaultpic']);
			$dt[$k]['courseurl']  = M_URL('course','view',$v['courseid']);
		}
		$result['values']    =  $dt; 
		$result['page']      =  $page; 
		header("Content-type: application/json");
	    echo json_encode($result);exit;
     }
	 //个人中心
	 public function personAction(){
		check_login($this->memberinfo);//检查是登录权限
		$course = $this->cache->GetUCache('havecourses',$this->memberid);
	    $options['now_page']   = null !==GF('p') ? GF('p'):'1';
		$options['maxperpage'] = $this->getMaxPage('users/person.html');
	    $options['totalput']   = count($course);
		$page = Page($options);
		$dt   = $page->arrayPage($course); 
		$courseModel  = M('app_course');
		$tercherModel = M('common_user_teacher');
	    foreach($dt as $k=>$v){
			$dt[$k]['teacher']= $courseModel->getOne('b.name','as a left join '.$tercherModel->table.' as b on a.teacherid = b.userid where a.courseid='.$v['courseid'].' limit 1');
		}
	    $this->assign('page',$page);
		$this->assign('dt',$dt);
        $this->display('users/person.html');
     }
	 //用户信息
	 public function editUsersAction(){
		check_login($this->memberinfo);//检查是登录权限
		$category = $this->cache->GetHCache('appcategory',$GLOBALS['_DoM']['wxid']);//读出缓存
		$link = Linkage(array(),$category);
		$link->inputname = 'categoryid';
		$link->categoryid =  $this->memberinfo['categoryid'];
		$category = $link->Linkage(3);	
		$areaid = 0;
		if($this->memberinfo['provinceid']!=0){
			$areaid = $this->memberinfo['provinceid'];
			if($this->memberinfo['cityid']!=0){
				$areaid = $this->memberinfo['cityid'];
				if($this->memberinfo['countyid']!=0){$areaid = $this->memberinfo['countyid'];}
			}
		}
		$areainfo    = $this->cache->getACache('areainfo');//取出缓存
		$linktwo     = Linkage(array(),$areainfo);	
		$linktwo->inputname      = 'areaid';// <select name='' /> 里的name值
		$linktwo->idname         = 'id';
		$linktwo->funcname       = 'getchildtwo';
		$linktwo->childvaluename = 'city';
		$linktwo->childidname    = 'id';
		$linktwo->categoryid     = $areaid;
		$areainfo = $linktwo->Linkage(3);
	    $this->assign('category',$category);
		$this->assign('areainfo',$areainfo);
		$this->assign('memberinfo',$this->memberinfo);
        $this->display('users/editUsers.html');
     }
	 public function UsersAction(){
	 	     $id   =  ChkClng(KS_G('request.id'));
	 	      $this->assign('id',$id);
	 	
		check_login($this->memberinfo);//检查是登录权限
        $this->display('users/editUsers.html',1);
     }
	 public function doeditUsersAction(){
		check_login($this->memberinfo);//检查是登录权限
		if(!empty(ChkSQL(KS_G('post.username'))))
		{$Data['username'] = ChkSQL(KS_G('post.username'));}
		$Data['email']  = ChkSQL(KS_G('post.email'));
		$Data['mobile'] = ChkSQL(KS_G('post.mobile'));
		if(!empty($_FILES['file']['tmp_name'])){
			$info = $this->upload->uploadHead($_FILES['file'],$this->memberid);//上传头像
			if(!$info) {KS_INFO($this->upload->getError(),0,'','',1);}// 上传错误提示错误信息
		}
		$Rule['email']     = '邮箱|isEmpty,isEmail';
		if(!empty(ChkSQL(KS_G('post.username'))))
		{$Rule['username'] = '用户名|isEmpty,isDbexis';}
		Chkpost($Data,$Rule,$this->userModel,"wxid=".$GLOBALS['_DoM']['wxid']." and userid!=$this->memberid");
		$result =$this->userModel->update($Data,"wxid=".$GLOBALS['_DoM']['wxid']." and userid=$this->memberid");
		//更新第二张表
		$areaModel = M('common_area');
		$areaid = ChkClng(KS_G('post.areaid'));
		if($areaid!=0){
			$depth = $areaModel->getOne('depth',"where id=$areaid");
			if($depth==3){
				$Datas['countyid'] = $areaid;
				$Datas['cityid'] = $areaModel->getOne('parentid',"where id=$Datas[countyid]");
				$Datas['provinceid'] = $areaModel->getOne('parentid',"where id=$Datas[cityid]");
			}elseif($depth==2){
				$Datas['countyid'] = 0;
				$Datas['cityid'] = $areaid;
				$Datas['provinceid'] = $areaModel->getOne('parentid',"where id=$Datas[cityid]");
			}elseif($depth==1){
				$Datas['countyid'] = 0;
				$Datas['cityid'] = 0;
				$Datas['provinceid'] = $areaid;
			}
		}
		$Datas['categoryid'] = ChkClng(KS_G('post.categoryid'));//应用分类ID
		$countNum = $this->AppModel->getOne('count(*)',"where userid=$this->memberid");
		if($countNum!=='1'){
			$this->AppModel->delete("userid=$this->memberid");
			$Datats['userid'] = $this->memberid;
			$this->AppModel->doEfAdd($Datats);
		}
		$result = $this->AppModel->update($Datas,"userid=$this->memberid");
		//$userinfo = $this->userModel->getRow("as a left join `".$this->AppModel->table."` as b on a.userid = b.userid WHERE a.userid =$this->memberid limit 1",'b.*,a.*');
		$userinfo = $this->userModel->getRow("WHERE userid =$this->memberid limit 1");
		putsession('member',$userinfo);
		$url = M_URL('users','editUsers');
	    KS_INFO('修改成功',2,$url);
     }
	 public function editPwdAction(){
		check_login($this->memberinfo);//检查是登录权限
        $this->display('users/editPwd.html');
     }
	 //修改密码操作
	 public function doeditPwdAction(){
		check_login($this->memberinfo);//检查是登录权限
		$oldpassword = ChkSQL(KS_G('post.oldpassword')); 
		$Data['password'] = ChkSQL(KS_G('post.newpassword'));
		$assertpassword = ChkSQL(KS_G('post.assertpassword'));
		if($oldpassword == $Data['password']){KS_INFO('新密码与原密码一致',0,'','',1);}
		if($Data['password'] !=  $assertpassword){KS_INFO ("新密码两次输入不一致",0,'','',1);}
		if($this->memberinfo['password'] !== KS_MD5($oldpassword.KS_MD5($this->memberinfo['rndpasswordc']))){KS_INFO('原密码错误',0,'','',1);}
		$Rule['password'] = '密码|isEmpty,isPassword';
		Chkpost($Data,$Rule,$usersModel,"userid!=$this->userid");
		$Data['password'] = KS_MD5($Data['password'].KS_MD5($this->memberinfo['rndpasswordc']));
		$this->userModel->update($Data,"userid=$this->memberid");
		$userinfo = $this->userModel->getRow("WHERE userid =$this->memberid limit 1");
		putsession('member',$userinfo);
		KS_INFO('密码修改成功！');
     } 
	 public function threeloginAction(){
		check_login($this->memberinfo);//检查是登录权限 
        $this->display('users/threelogin.html');
     }
	 public function reviewsAction(){
		check_login($this->memberinfo);//检查是登录权限 
        $this->display('users/threelogin.html');
     }
     //点击点赞操作
     public function doLikeAjaxAction(){
     	$memberinfo          = getsession('member');
     	if(empty($memberinfo)){echo 'unlogin';exit;}
     	$infoid              = ChkClng(KS_G('post.infoid')); 
     	$appid               = ChkClng(KS_G('post.appid')); 
     	$like                = M('common_like');
        $result              = $like->getOne('count(*)','where appid='.$appid.' and memberid='.$this->memberid.' and infoid='.$infoid.' and wxid='.$GLOBALS['_DoM']['wxid']);
        
        if($result>0){
        	if($appid==11){
        		$common_user_teacher = M('common_user_teacher');
        		$thumbsup            = $common_user_teacher->getOne('thumbsup','where userid='.$infoid);
        	    $Datas['thumbsup']    = "thumbsup-1";
                $common_user_teacher->update($Datas,'userid='.$infoid,1);
        	}
        	$like->delete('appid='.$appid.' and infoid='.$infoid.' and wxid='.$GLOBALS['_DoM']['wxid']);
        	//header("Content-type: application/json");
	        echo 'unlike,'.($thumbsup-1);exit;
        }else{
        	if($appid==11){
        		$common_user_teacher = M('common_user_teacher');
	        	$thumbsup             = $common_user_teacher->getOne('thumbsup','where userid='.$infoid);
	        	$Datas['thumbsup']     = "thumbsup+1";
	            $common_user_teacher->update($Datas,'userid='.$infoid,1);
	        }    
        	$Data['wxid']         = $GLOBALS['_DoM']['wxid'];
        	$Data['appid']        = $appid;
        	$Data['infoid']       = $infoid;
        	$Data['userid']       = $this->parentid;
        	$Data['membername']   = $this->username;
        	$Data['memberid']     = $this->memberid;
        	$like->doAdd($Data,'id');
        	echo 'like,'.($thumbsup+1);exit; 
        }
     }
     //判断是否点赞 
     public function isLikeAjaxAction(){
     	$memberinfo  = getsession('member');
     	if(empty($memberinfo)){echo 'unlogin';exit;}
     	$info        = ChkClng(KS_G('post.infoid')); 
     	$appid       = ChkClng(KS_G('post.appid')); 
     	$like        = M('common_like');
        $result      = $like->getOne('count(*)','where appid='.$appid.' and infoid='.$info.' and memberid='.$this->memberid.' and wxid='.$GLOBALS['_DoM']['wxid']);
        if($result>0){
        	echo 'like';exit;
        }else{
        	echo 'unlike';exit;
        }
     }
     public function collectAction(){
     	check_login($this->memberinfo);//检查是登录权限
        $this->display('users/collect.html',1);
     }
     
     //进入签到
	public function signAction(){
		
		
		 $this->display('users/sign.html',1); 
	}
     
     
//   public function inforPersonTAction(){
//      $courseid  = ChkClng(KS_G("request.id"));
//      $url =  "/Json/index.php?act=Users.inforPerson&courseid=$courseid";
//   	$this->assign('url',$url);
//      $this->display('users/editUsers.html',1);
//   }
//   
//        public function myAccountTAction(){
//      $courseid  = ChkClng(KS_G("request.id"));
//      $url =  "/Json/index.php?act=Users.myAccount&courseid=$courseid";
//   	$this->assign('url',$url);
//      $this->display('users/editUsers.html',1);
//   }
//   
//        public function passwordTAction(){
//      $courseid  = ChkClng(KS_G("request.id"));
//      $url =  "/Json/index.php?act=Users.password&courseid=$courseid";
//   	$this->assign('url',$url);
//      $this->display('users/editUsers.html',1);
//   }
//   
//        public function bingingTAction(){
//      $courseid  = ChkClng(KS_G("request.id"));
//      $url =  "/Json/index.php?act=Users.binging&courseid=$courseid";
//   	$this->assign('url',$url);
//      $this->display('users/editUsers.html',1);
//   }
     

     
     
     
     
}