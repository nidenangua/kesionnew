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
// application/controllers/home/IndexController.class.php
class IndexController extends Controller{
	public  function _initialize(){

        if (isset($_GET['managetoken'])){   //总后台授权进来的

            $usersModel = M('common_user');
           // $user       = $usersModel->getRow("where wxid=".$this->wxid." and parentid=0 and usertype>0 order by userid asc limit 1",'h5token,tokentime,usertype,userid,username,wxid,status');
            $user       = $usersModel->getAll("where wxid=".$this->wxid." and usertype>0 order by userid asc",'h5token,tokentime,usertype,userid,username,wxid,status');
            if(!empty($user)){
                foreach($user as $k=>$v){
                    if(KS_MD5($v['h5token'],32)==$_GET['managetoken'] && time()-$v['tokentime']<=7200){
                        $userinfo['userid']   = $v['userid'];
                        $userinfo['username'] = $v['username'];
                        $userinfo['usertype'] = $v['usertype'];
                        $userinfo['wxid']     = $v['wxid'];//网校id
                        putsession('user',$userinfo);
                        if (isMobile(true)){
                            $url=wx_Url($this->wxid).'/#/user';
                        }else{
                            $url=wx_Url($this->wxid).'/home.html';
                        }
                        ks_header($url);
                    }
                }
            }else{
                echo '该用户权限不够';exit;
            }
        }
	    else if(isset($_GET['tocken'])&&empty(getsession('user'))){
		    $live_secret   = M('app_live_secret');
		    $tockenval     = $live_secret->getRow('where wxid='.$GLOBALS['_DoM']['wxid']);
			if(!empty($tockenval)){
				 if(KS_MD5($tockenval['token'])==$_GET['tocken']){
				    if(time()-$tockenval['endtime']<=7200){
					    $usersModel = M('common_user');
					    $user       = $usersModel->getRow("where wxid=".$tockenval['wxid']." and parentid=0 and powertype!=0 and usertype!=0 limit 1",'usertype,userid,username,wxid,status');
				        if(!empty($user)){
							$userinfo['userid']   = $user['userid'];
							$userinfo['username'] = $user['username'];
							$userinfo['usertype'] = $user['usertype'];
							$userinfo['wxid']     = $user['wxid'];//网校id
							putsession('user',$userinfo);
						}else{
							echo '该用户权限不够';exit;
						}
					}else{
						echo 'tocken时间过期';exit;
					}
				 }else{
				    echo 'tocken错误';exit;
				 }
			}else{
			     echo '该网校没有开通接口功能';exit;
			}
		}
		$this->userinfo   = User_GetUserInfo();
//		check_homelogin($this->userinfo);//检查home端是否有登录
		$this->userid     = $this->userinfo['userid'];   //用户id
		$this->wxid       = $this->userinfo['wxid'];     //网校id
		$this->powertype  = $this->userinfo['powertype'];//权限类型
    }
    public  function testAction(){
		include  CURR_VIEW_PATH . "test.php";
    }
    ///**
    // * 新路由
    // */
    //public function home1Action(){
    //    if(cookie('indoor')!==null){
    //        $indoorurl = cookie('indoor');cookie('indoor',null);
    //    }elseif(isset($_GET['url'])){
    //        $indoorurl = 'home'.KS_C('URL_SUFFIX').$_GET['url'];
    //    }else{
    //        $indoorurl = M_URL('Index','mainfirst');
    //    }
    //    $websiteinfo   = $this->cache->GetHCache('website',$this->wxid);//读出缓存
    //    if(empty($websiteinfo)){
    //        $Data['wxid']          = $this->wxid;
    //        $Data['userid']        = $this->userid;
    //        $Data['packstartime']  = time();
    //        $Data['packendtime']   = strtotime("+1 year");
    //        $Data["signsms"]       = '【科汛V名师】';
    //        $websiteModel          = M('Application/WebsiteModel/common_user_website');
    //        $websiteModel->websiteAdd($Data);
    //        $this->cache->PutHCache('website',$this->wxid);//写入缓存
    //        $websiteinfo = $this->cache->GetHCache('website',$this->wxid);//读出缓存
    //    }
    //    $package       = $websiteinfo['package'];
    //    $module        = wx_module_arr($this->wxid);
    //    $base          = $this->cache->GetACache('setting');//读出缓存
    //    $appuserrelate = M('Application/IndexModel/common_app_userrelate');
    //    $appcategory   = $this->cache->GetA('appcategory','parentid',0);//读取缓存
    //    $appshort      = $appuserrelate->getshort();
    //    $info          = $this->cache->GetA('domaininfo','wxid',$this->wxid,'',true);//读出缓存
    //    include  CURR_VIEW_PATH . "home.index.php";
    //}
	/**
     * home端首页
	 */
	public function indexAction(){
        include  CURR_VIEW_PATH . "Store/dist/index.html";
    }

    /**
     * 首次进入的iframe界面进入框
     */
    //public function mainfirstAction(){
    //    $IndexModel      = M('Application/IndexModel');
    //    $Data008['wxid'] = $this->wxid;
    //    $result          = $IndexModel->mainfirst($Data008);
    //    //$values          = $result['values'];//套餐的子项详情
    //    $versionname     = $result['versionname'];//当前网校的版本
    //    $websiteinfo     = $result['websiteinfo'];//当前网校的信息
    //    $module          = wx_module_arr($this->wxid);  //当前网校开通的模块
    //    $info            = $this->cache->GetA('domaininfo','wxid',$this->wxid,'',true);//读出缓存

    //    $app_wechat_config = M('app_weixin_config');
    //    $weixinstatus      = $app_wechat_config->getOne('qrcode_url','where wxid='.$this->wxid.' limit 1');

    //    $wxapplet_config   = M('app_wxapplet_config');
    //    $appletstatus      = $wxapplet_config->getOne('count(id)','where wxid='.$this->wxid.' limit 1');

    //    $QRcode = $weixinstatus;
    //    $ordernum        = $result['ordernum'];//今日销售量总额
    //    //$orderMnum       = $result['orderMnum'];//本月销售量总额

    //    $user            = M('common_user');

    //    $dhits           = $user->getOne('count(1)','WHERE DATEDIFF(now(),FROM_UNIXTIME(regdate))=0');//昨日新增学生
    //    $withdrawmoney   = $websiteinfo['withdrawmoney'];//可提现余额
    //    $daypayuser      = $result['daypayuser'];//今日付费学员数
    //    $payorderuser    = $result['payorderuser'];//总付费学员数
    //    $res         = $this->cache->GetACache('helpcategory');//取出缓存
    //    //常见问题
    //    $ress        = $this->cache->GetACache('webquestion');//读出缓存
    //    $app_new     = M('app_news');
    //    $newAry      = $app_new->getAll('where wxid=1519 and status!=-1 and status!=0 order by id desc limit 3');
    //    include  CURR_VIEW_PATH . "home.welcome.php";
    //}

//    //模块开关switch(关)
//    public function moduleswitch2Action(){
//        $IndexModel          = M('Application/IndexModel');
//        $Data008['wxid']     = $this->wxid;
//        $Data008['userid']   = $this->userid;
//        $Data008['switch'] = 'on';
//        $IndexModel->moduleswitch($Data008);
////		$id              = ChkClng(KS_G('get.id'));
////		if($id==0){$Data008['id']=4;$IndexModel->moduleswitch($Data008);}
//        echo '<script>top.location = "'.M_URL().'"</script>';exit;
//        $url1 = M_URL('Index','mainfirst');
//        ks_header($url1);
//    }
//    //模块开关switch（开）
//    public function moduleswitchAction(){
//        $IndexModel          = M('Application/IndexModel');
//        $Data008['wxid']     = $this->wxid;
//        $Data008['userid']   = $this->userid;
//        $IndexModel->moduleswitch($Data008);
////		$id              = ChkClng(KS_G('get.id'));
////		if($id==4){$Data008['id']=0;$IndexModel->moduleswitch($Data008);}
//        echo '<script>top.location = "'.M_URL().'"</script>';exit;
//        $url1 = M_URL('Index','mainfirst');
//        ks_header($url1);
//    }

    ////获取今日上课班级
    //public function getTodayClassAction(){
    //    $starttime=strtotime(date('Y-m-d',time()));
    //    $endtime=$starttime+3600*24;
    //    $classModel=M('app_class');
    //    $scheduleModel=M('app_class_schedule');
    //    $where =' as a inner join '.$scheduleModel->table.' as b on a.classid=b.classid where a.wxid='.$this->wxid.' and a.status!=-1  and b.timeSlotStart>='.$starttime.' and b.timeSlotStart<='.$endtime.' group by classid' ;

    //    $class=$classModel->getAll($where,'b.timeSlotStart,b.timeSlotEnd,b.teacherid,a.title,a.classid,a.classlevel');
    //    $teacherModel=M('common_user_teacher');
    //    foreach($class as $k=>$v){
    //        $class[$k]['teachername']=$teacherModel->getOne('name','where userid='.$v['teacherid'].' limit 1');
    //        $time1=date('H:i',$v['timeSlotStart']);
    //        $time2=date('H:i',$v['timeSlotEnd']);
    //        $class[$k]['time']=$time1.'-'.$time2;
    //        $class[$k]['servicetime']=time();
    //        $class[$k]['startclass']=M_URL('class/Index','startlive',$v['classid'],GP("appid-30"));
    //    }
    //    echo json_encode($class);

    //}
    //班级列表
    //public function getClassListAction(){
    //    $classModel = M('app_class');
    //    $classlevel = ChkClng(KS_G('post.classlevel'));
    //    if(empty(KS_G('post.classlevel'))){$where = '';
    //    }else{$where = ' and classlevel='.$classlevel;}
    //    $class = $classModel->getAll('where wxid='.$this->wxid.' and status !=-1  '.$where.' order by classid desc limit 15','classid,title');
    //    foreach($class as $k=>$v){
    //        $class[$k]['url'] = M_URL('class/Index','basics',$v['classid'],GP('appid-30'));
    //    }
    //    $courseMode = M('app_course');
    //    $course     = $courseMode->getAll('where wxid='.$this->wxid.' and status !=-1  '.$where.'  order by courseid desc limit 15','courseid,title');
    //    foreach($course as $k=>$v){
    //        $course[$k]['url'] = M_URL('course/Index','basics',$v['courseid'],GP('appid-6'));
    //    }
    //    $result['class']  = $class;
    //    $result['course'] = $course;
    //    echo json_encode($result);
    //}

	//添加快捷
	public function shortAction(){
		check_homelogin($this->userinfo);//检查home端是否有初始化
	    $id = ChkClng(KS_G('post.id'));
	    $Data['short'] = 1;
	    $appuserrelate = M('common_app_userrelate');
	    $appuserrelate->update($Data,"id=$id");
	    echo "OK";
	}
	//取消快捷
    //public function noshortAction(){
    //    check_homelogin($this->userinfo);//检查home端是否有初始化
    //    $id            = ChkClng(KS_G('get.id'));
    //    $Data['short'] = 0;
    //    $appuserrelate = M('common_app_userrelate');
    //    $appuserrelate->update($Data,"id=$id");
    //    echo "OK";
    //}
    ////卸载应用
    //public function uninstallAction(){
    //    check_homelogin($this->userinfo);//检查home端是否有初始化
    //    $id   = ChkClng(KS_G('get.id'));
    //    $appuserrelate = M('common_app_userrelate');
    //    $orderid            = $appuserrelate ->getOne('orderid',"where wxid=$this->wxid and id=$id");
    //    $Data['orderid']    = 'orderid-1';
    //    $appuserrelate ->update($Data,"wxid=$this->wxid and orderid>$orderid",1);
    //    $Data1['isenabled'] = 0;
    //    $Data1['short']     = 0;
    //    $Data1['orderid']   =-1;
    //    $appuserrelate->update($Data1,"id=$id");
    //    $url1 = M_URL('Index','mainfirst');
    //    $this->cache->PutHCache('apprelate',$this->wxid);
    //    $this->cache->PutHCache('haveapprelate',$this->wxid);
    //    KS_INFO("",0,$url1);
    //}
	//给app排序
    //public function orderappAction(){
    //    check_homelogin($this->userinfo);//检查home端是否有初始化
    //    $appids             = ChkSQL(KS_G('request.appids'));
    //    if(!empty($appids)){
    //        $appuserrelate  = M('common_app_userrelate');
    //        $appidarr       = explode(',',$appids);
    //        $appnum         = count($appidarr);
    //        foreach($appidarr as $k=>$v){
    //            $Data['orderid']  = $appnum-$k;
    //            $appuserrelate ->update($Data,"wxid=$this->wxid and appid=$v");
    //        }
    //        $this->cache->PutHCache('apprelate',$this->wxid);
    //        $this->cache->PutHCache('haveapprelate',$this->wxid);
    //        header("Content-type: application/json");
    //        echo json_encode('ok');
    //    }else{
    //        header("Content-type: application/json");
    //        echo json_encode('err');
    //    }
    //}

    /**
     * 请你完善信息（网校首次注册初始化）
	 */
	public function initialAction(){
        include  CURR_VIEW_PATH . "Index/home.initail.php";
    }
    /**
     * 判断网校是否已经初始化
     */
    public function checkHasInitialAction(){
	    $wxid            = ChkClng(KS_G('request.wxid'));
	    $websiteModel    = M('common_user_website');
		$initial         = $websiteModel->getOne('initial','where wxid='.$wxid.' limit 1');
		if(!empty($initial)&&$initial==1){
		    $result['result']    = 'succeed';
		}else{
            $result['result']   = 'err';
		}
		header('Content-Type:application/json;charset=utf-8');
		echo json_encode($result);exit;
    }




    ////网站初始化的信息进入数据库
    //public function dobasicAction(){
    //    $Data010['wxid']     = $this->wxid;
    //    $Data010['userid']   = $this->userid;
    //    $Data010['userinfo'] = $this->userinfo;
    //    $IndexModel  = M('Application/IndexModel');
    //    $IndexModel  ->initialStoreData($Data010);
    //    KS_INFO('初始化成功',2,M_URL());
    //}
	//图片管理删除分组
	public function deletedirAction(){
		$nowdirid = ChkSQL(KS_S('nowdirid'));
		$nowdir   = ChkSQL(KS_S('nowdir'));
		$cache    = new \Core\Cache();
		$uploadtableid = $cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		$extends_table = M('common_extends_table');
		$tablename     = $extends_table->getOne('tablename','where tableid='.$uploadtableid);
		$files         = M($tablename);
		$Data['dirid'] = 0;
		$files->update($Data,'dirid='.$nowdirid);
		$dir = M('app_dir');
		$dir->delete('id='.$nowdirid);
		ks_header(M_URL('Index','imageslist','',GP('name-defaultpic,type-other',true)));
	}
    /**
     * 图片列表
     */
    public function imageslistAction(){
    	$info          = $this->cache->GetHCache('website',$this->wxid);//读出缓存
    	$courseid      = ChkClng(KS_S('courseid'));
    	$classid       = ChkClng(KS_S('classid'));
    	$setting       = explode('|',$info['setting']);
    	$isshuiyin     = $setting[6];//提问开启水印
    	$type          = null !== GF('type') ? GF('type'):'parent';
		$name          = ChkSQL(KS_S('name'));
		$chektype      = null !== GF('chektype') ? GF('chektype'):'1';
		$nowdirid      = ChkClng(KS_S('nowdirid'));
		$nowdir        = ChkSQL(KS_S('nowdir'));
		$limit         = null !== GF('limit')  ? GF('limit') :'0_0';
		$limits        = explode("_",$limit);
		$limitx        = $limits[0];
		$limity        = $limits[1];
		$app_dir       = M('app_dir');
		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		//$extends_table = M('common_extends_table');
		//$tablename     = $extends_table->getOne('tablename','where tableid='.$uploadtableid);
		$tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
		$files         = M($tablename);

		$dirname = $app_dir->getAll('where type=1 and wxid ='.$this->wxid.' order by adddate desc','name,id');
		if(!empty($nowdirid)){
			$dir      = $app_dir->getAll('where type=1 and id ='.$nowdirid);
			$nowdir   = $dir[0]['name'];
			$subName  = $dir[0]['file'];
			$filename = $files->getAll('where '." (filename like '%.jpg%' or filename like '%.jpeg%' or filename like '%.bmp%' or filename like '%.gif%' or filename like '%.png%')".' and dirid='.$nowdirid.' order by adddate desc');
		}else{
			$dir = $app_dir->getAll('where type=1 and name='.date('Ym').' and wxid='.$this->wxid);
			if(empty($dir)){
				$dirData['wxid'] = $this->wxid;
				$dirData['name'] = date('Ym');
				$dirData['file'] = date('Ym');
				$dirData['adddate'] = time();
				$dirData['type'] = 1;
				$nowdirid = $app_dir->doAdd($dirData,'id');
			}else{
				$nowdirid = $dir['0']['id'];
			}
			$subName = date('Ym');
			$nowdirid = $nowdirid;
			$filename = $files->getAll('where '." (filename like '%.jpg%' or filename like '%.jpeg%' or filename like '%.bmp%' or filename like '%.gif%' or filename like '%.png%')".' and wxid='.$this->wxid.' order by adddate desc');
		}
		$ico   = '';
		$count = $files->getAll('where '." (filename like '%.jpg%' or filename like '%.jpeg%' or filename like '%.bmp%' or filename like '%.gif%' or filename like '%.png%')".' and wxid='.$this->wxid.' order by adddate desc','count(id) as count');
		$sum   = $count[0]['count'];
		$options['now_page']   = null !==GF('p') ? GF('p'):'1';
		$options['maxperpage'] = 10;
	    $options['totalput']   = count($filename);
		$page = Page($options);
		$filename   = $page->arrayPage($filename);
		if(empty($filename)){$filename = array();}
		include  CURR_VIEW_PATH . "Index/images_list.php";
    }
    /**
     * 选择图标
     */
    public function icolistAction(){
    	$courseid      = ChkClng(KS_S('courseid'));
    	$info          = $this->cache->GetHCache('website',$this->wxid);//读出缓存
    	$courseid      = ChkClng(KS_S('courseid'));
    	$classid       = ChkClng(KS_S('classid'));
    	$setting       =  explode('|',$info['setting']);
    	$isshuiyin     =  $setting[6];//提问开启水印
    	$type          = null !== GF('type') ? GF('type'):'parent';
		$name          = null !== GF('name') ? GF('name'):'';
		$chektype      = null !== GF('chektype') ? GF('chektype'):'1';
		$nowdirid      = ChkClng(KS_S('nowdirid'));
		$nowdir        = ChkSQL(KS_S('nowdir'));
		$limit         = null !== GF('limit')  ? GF('limit') :'0_0';
		$limits        =     explode("_",$limit);
		$limitx        = $limits[0];
		$limity        = $limits[1];
		$subName       = '';
		$ico           = 'Ico';
		$app_dir       = M('app_dir');
		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		$tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
		$files         = M($tablename);
		$dirname       = $app_dir->getAll('where type=1 and wxid ='.$this->wxid,'name,id');
		$dir = ROOT.'Images/images/'.$nowdir.'/';
		$filename = array();
		if (is_dir($dir)) {
			 $filelist = scandir($dir);
			 foreach($filelist as $k=>$v){
			 	if($v !='.' and $v !='..'){
					if (is_dir($dir.$v)) {
					 	$file=scandir($dir.$v);
					 	foreach($file as $key=>$value){
					 		if($value !='.' and $value !='..'){
					 			if(!is_dir($dir.$value)){
					 				if($value !='.svn'){
					 					$filename[]= array('filePath'=>UOOT.'Images/images/'.$v.'/'.$value,'filename'=>$value);
					 				}
					 			}
					 		}
					 	}
					}else{
						$filename[]= array('filePath'=>UOOT.'Images/images/'.$nowdir.'/'.$v,'filename'=>$v);
					}
				}
			}
		}
		//unset($filename[0]);
		$options['now_page']   = null !==GF('p') ? GF('p'):'1';
		$options['maxperpage'] = 10;
	    $options['totalput']   = count($filename);
		$page                  = Page($options);
		$filename              = $page->arrayPage($filename);
		if(empty($filename)){$filename = array();}
		$sum   = $options['totalput'];
//		$count = $files->getAll('where type=1 and wxid='.$this->wxid.' order by adddate desc','count(id) as count');
//		$sum   = $count[0]['count'];
		include  CURR_VIEW_PATH . "Index/images_list.php";
    }
    /**
     * 添加图片分组
     */
    public function TempaddFileAction(){
    	if($_POST){
    		$type = ChkSQL(KS_S('type'));
			$name = ChkSQL(KS_S('name'));
			$courseid = ChkClng(KS_S('courseid')); ;
			$dirData['type'] = ChkSQL(KS_S('dirtype'));
    		$dirname = ChkSQL(KS_S('tempname'));
    		if(empty($dirname)){KS_INFO('名称不能为空',0,'','',1);}
    		$app_dir = M('app_dir');
    		$dirData['wxid'] = $this->wxid;
			$dirData['name'] = $dirname;
			$dirData['file'] = date('YmdHis');
			$dirData['adddate'] = time();
			$dirid = $app_dir->doAdd($dirData,'id');

			if($dirData['type']==1){
			     $url = M_URL('Index','imageslist','',GP('nowdir-'.$dirname.',nowdirid-'.urlencode($dirid).',name-'.$name.',type-'.$type.',courseid-'.$courseid,true));
			}else{
				 $url = M_URL('Index','wxfile','',GP('nowdir-'.$dirname.',nowdirid-'.urlencode($dirid).',name-'.$name.',type-'.$type.' ,type1-'.$dirData['type'],true));
			}
			ks_header($url);
    	}else{
    		include CURR_VIEW_PATH . "Index/tempadd.php";
    	}
    }
    //请你完善信息
	public function oldimageslistAction(){
		$type         = null !== GF('type') ? GF('type'):'parent';
		$name         = null !== GF('name') ? GF('name'):'';
		$tempdir      = null !== GF('tempdir') ? GF('tempdir'):'';
		$nowdir =  ChkSQL(null !== GF('nowdir') ? GF('nowdir'):date('Ym'));
    	$first        = '';
        $arr_filetype = $this->File->fileType_arr(array('jpg','png','jpeg'));//指定可以打开的文件后缀
        if(!empty($tempdir)){
			$back = null !== GF('back') ? GF('back'):'';
			if(!empty($back)){
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				array_pop($tempdir);
				if(count($tempdir)>3)
				{$first = 'on';}
				$tempdir = implode('/',$tempdir);
				$ismatch = strpos($tempdir,'Images/school/'.$this->wxid);
				if($ismatch===false){echo 'err';exit;};
				$dir = ROOT.$tempdir.'/';
			}else{
//				if($value['temptype']==0){$ismatch = strpos($tempdir,'Tp/PC/'.$value['installdir']);}
//				else if($value['temptype']==1){$ismatch = strpos($tempdir,'Tp/M/'.$value['installdir']);}
//				if($ismatch===false){echo 'err';exit;};
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);

				if(empty($nowdir)){
					if(count($tempdir)>3){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $dir = ROOT.$tempdir.'/';
				}else{
					if(count($tempdir)>2){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $tempdir = $tempdir.'/'.$nowdir;
				    $dir = ROOT.$tempdir.'/';
				}
			}
		}else{
			$tempdir      = 'Images/school/'.$this->wxid.'/'.date('Ym');
		    $dir          = ROOT.$tempdir.'/';
		}
		$dir2         = ROOT.'Images/school/'.$this->wxid.'/';
		$dirname2     = array();
		$filename2    = array();
		if (is_dir($dir2)) {
			 $filelist2 = scandir($dir2,1);
			 foreach($filelist2 as $k=>$v){
				 if (is_dir($dir2.$v)) {$dirname2[] = $v;}else{
					$suffix = $this->File->get_file_type($v);
					foreach($arr_filetype as $kt=>$vt){if($suffix == $vt ){$filename2[] = $v;}}
				 }
			 }
			 $dirname2=array_diff($dirname2,array('..','.'));
			 $dirname2=array_values($dirname2);
	    }


		$dirname      = array();
	    $filename     = array();
	    if (is_dir($dir)) {
			 $filelist = scandir($dir,1);
			 foreach($filelist as $k=>$v){
			 	if($v !='.' and $v !='..'){
					if (is_dir($dir.$v)) {
					 	$dirname[] = $v;
//					 	$file=scandir($dir.$v);
//					 	foreach($file as $key=>$value){
//					 		if($value !='.' and $value !='..'){
//					 			if(!is_dir($dir.$value)){
//					 				$filename[] = $v.'/'.$value;
//					 			}
//					 		}
//					 	}
					}else{
						$filename[] = $v;
					}
				}
			 }
			 $dirname=array_diff($dirname,array('..','.'));
			 $dirname=array_values($dirname);
	    }
        include  CURR_VIEW_PATH . "Index/images_list.php";
    }
    /**
     * 剪裁图片
     */
    public function imgcutAction(){
    	if($_POST){
    		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
			//$extends_table = M('common_extends_table');
			//$tablename = $extends_table->getOne('tablename','where tableid='.$uploadtableid);
			$tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
			$files         = M($tablename);
			$imgw          = strstr($_POST['imgw'],'px',TRUE);
			$imgh          = strstr($_POST['imgh'],'px', TRUE);
//			var_dump($_POST);var_dump($imgw);var_dump($imgh);
            $postimg           = ChkSQL($_POST['img']);
    		if($_POST['x'] == 0 && $_POST['y'] == 0 && $_POST['w'] >= $imgw && $_POST['h'] >= $imgh ){
    			$id  = $files->getOne('id','where filePath="'.$postimg.'" or baiduPath="'.$postimg.'"  and wxid='.$this->wxid);
    			$imgurl = $postimg;
    			$img = '{img:'.$this->wxid.','.$id.'}';
    		}elseif($_POST['x'] == 0 && $_POST['y'] == 0 && $_POST['w'] == 0 && $_POST['h'] == 0 ){
    			$id  = $files->getOne('id','where filePath="'.$postimg.'" or baiduPath="'.$postimg.'"  and wxid='.$this->wxid);
    			$imgurl = $postimg;
    			if(empty($id)){
                    $img = $imgurl;
    			}else{
                    $img = '{img:'.$this->wxid.','.$id.'}';
                }
    		}else{
				$src = $postimg;
				$content = file_get_contents($src);
				file_put_contents('./'.date('YmdHis').'.png', $content);
				$src = './'.date('YmdHis').'.png';
				$usrc = $src;
				// var_dump(1);
				$image = new \Core\Image(\Core\Image::IMAGE_IMAGICK);
				$image->open($src);
				// var_dump(1);
				$image->thumb($imgw, $imgh,\Core\Image::IMAGE_THUMB_CENTER)->save('./thumb.png');
				// var_dump(1);
				$image->open('./thumb.png');
				$imgs = rand(10,1000);
				$imgname = date('YmdHis').$imgs.'.jpg';
				if(file_exists('Images/school/'.$this->wxid.'/'.date('Ym'))){}else{
					mkdir('Images/school/'.$this->wxid.'/'.date('Ym'),0777,true);}
				$imgurl = 'Images/school/'.$this->wxid.'/'.date('Ym').'/'.$imgname;

				$image->crop($_POST['w'], $_POST['h'],$_POST['x'],$_POST['y'])->save(ROOT.$imgurl);
				if(empty($_POST['dirid'])){
					$app_dir = M('app_dir');
					$dir = $app_dir->getAll('where name='.date('Ym').' and wxid='.$this->wxid);
					$nowdirid = $dir['0']['id'];
				}else{
					$nowdirid =ChkSQL($_POST['dirid']);
				}
				if($usrc !=''){
					unlink($usrc);
				}
				unlink('./thumb.png');
				$imgurl = UOOT.$imgurl;
				$data['wxid'] = $this->wxid;
				$data['filePath'] = $imgurl;
				$data['filename'] = $imgname;
				$data['adddate'] = time();
				$data['dirid'] = $nowdirid;
				$data['type'] = 1;
				$id = $files->doAdd($data,'id');
				$img = '{img:'.$this->wxid.','.$id.'}';

			}
    		echo json_encode(array('src'=>$imgurl,'img'=>$img));
    	}
    }
    //给图片上水印
    public function imgwaterAction(){
    	if($_POST){
    		$newary = array();
    		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
			//$extends_table = M('common_extends_table');
			//$tablename = $extends_table->getOne('tablename','where tableid='.$uploadtableid);
			$tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
			$files = M($tablename);
			$info = $this->cache->GetHCache('website',$this->wxid);
			foreach($_POST['imgary'] as $key => $v){
				$src = strstr($v, 'Images/');
				$image = new \Core\Image(\Core\Image::IMAGE_IMAGICK);
				$imgs = rand(10,1000);
				$imgname = date('YmdHis').$imgs.'.jpg';
				$imgurl = 'Images/school/'.$this->wxid.'/'.date('Ym').'/'.$imgname;
				$sysrc = strstr(Img($info['shuiyin']),'Images/');
				$image->open(ROOT.$sysrc);
				$image->thumb(40, 40,\Core\Image::IMAGE_THUMB_CENTER)->save('./thumb.png');
				$image->open($src)->water('./thumb.png',\Core\Image::IMAGE_WATER_NORTHWEST,50)->save(ROOT.$imgurl);
				$imgurl = UOOT.$imgurl;
				if(empty($_POST['dirid'])){
					$app_dir = M('app_dir');
					$dir = $app_dir->getAll('where name='.date('Ym').' and wxid='.$this->wxid);
					$nowdirid = $dir['0']['id'];
				}else{
					$nowdirid =$_POST['dirid'];
				}
				unlink('./thumb.png');
				$data['wxid'] = $this->wxid;
				$data['filePath'] = $imgurl;
				$data['filename'] = $imgname;
				$data['adddate'] = time();
				$data['dirid'] = $nowdirid;
				$data['type'] = 1;
				$id = $files->doAdd($data,'id');
				$img = '{img:'.$this->wxid.','.$id.'}';
				$imgary = array('src'=>$imgurl,'img'=>$img);
				$newary[]=$imgary;
			}
			echo json_encode($newary);
    	}
    }
    //给app排序（升序）
	public function myappupAction(){
		check_homelogin($this->userinfo);//检查home端是否有初始化
	    $id                 = ChkClng(KS_G('get.id'));
		$appuserrelate      = M('common_app_userrelate');
		$orderid            = $appuserrelate ->getOne('orderid',"where wxid=$this->wxid and id=$id");
		$Data['orderid']    = 'orderid-1';
	    $appuserrelate ->update($Data,"wxid=$this->wxid and orderid=($orderid+1)",1);
		$DataTwo['orderid'] = 'orderid+1';
		$appuserrelate ->update($DataTwo,"wxid=$this->wxid and id=$id",1);
		$this->cache->PutHCache('apprelate',$this->wxid);
		$this->cache->PutHCache('haveapprelate',$this->wxid);
	    $url1               = M_URL('Service','myapp');
	    KS_INFO("",0,$url1);
	}
	//给app排序（降序）
	public function myappdownAction(){
		check_homelogin($this->userinfo);//检查home端是否有初始化
	    $id                 = ChkClng(KS_G('get.id'));
	    $appuserrelate      = M('common_app_userrelate');
		$orderid            = $appuserrelate ->getOne('orderid',"where wxid=$this->wxid and id=$id");
		$Data['orderid']    = 'orderid+1';
	    $appuserrelate ->update($Data,"wxid=$this->wxid and orderid=($orderid-1)",1);
		$DataTwo['orderid'] = 'orderid-1';
		$appuserrelate ->update($DataTwo,"wxid=$this->wxid and id=$id",1);
		$this->cache->PutHCache('apprelate',$this->wxid);
		$this->cache->PutHCache('haveapprelate',$this->wxid);
	    $url1               = M_URL('Service','myapp');
	    KS_INFO("",0,$url1);
	}
	//卸载应用
	public function myuninstallAction(){
		check_homelogin($this->userinfo);//检查home端是否有初始化
	    $id   = ChkClng(KS_G('get.id'));
	    $appuserrelate = M('common_app_userrelate');
	    $orderid            = $appuserrelate ->getOne('orderid',"where wxid=$this->wxid and id=$id");
	    $Data['orderid']    = 'orderid-1';
	    $appuserrelate ->update($Data,"wxid=$this->wxid and orderid>$orderid",1);
	    $Data1['isenabled'] = 0;
	    $Data1['short'] = 0;
	    $Data1['orderid']=-1;
	    $appuserrelate->update($Data1,"id=$id");
	    $url1 = M_URL('Service','myapp');
	    $this->cache->PutHCache('apprelate',$this->wxid);
	    $this->cache->PutHCache('haveapprelate',$this->wxid);
	    KS_INFO("",0,$url1);
	}
	/**
     * 从应用中心，开通应用
	 */
	public function openAction(){
	    check_homelogin($this->userinfo);//检查home端是否有初始化
        $appid= ChkClng(KS_G('get.id'));
        $appinfo   = $this->cache->GetA('appinfo','appid',$appid,'',true);
        $msg="";
        if (!$appinfo){
            $msg="对不起，应用不存在，开通失败！";
        }
        $allowversion=$appinfo['allowversion'];
        if (!empty($allowversion)){
            if (wx_checkappisallow($appid,$this->wxid)==false){
                $msg="对不起，您当前使用的版本没有权限免费开通此应用！";
            }
        }
        if (!empty($msg)){
            header("Content-type: application/json");
            echo json_encode(array('result'=>'error','msg'=>$msg));
            die("");
        }else{
            $Data001['appid']   = $appid;
            $Data001['wxid']    = $this->wxid;
            $Data001['userid']  = $this->userid;
            $IndexModel       = M('Application/IndexModel');
            $result  = $IndexModel       ->appopen($Data001);
            header("Content-type: application/json");
            echo json_encode(array('result'=>'succeed','id'=>$result));
        }
	}

    //文件列表
	public function filelistAction(){
		$type         = null !== GF('type') ? GF('type'):'parent';
		$name         = ChkSQL(KS_S('name'));
		$tempdir      = ChkSQL(KS_S('tempdir'));
    	$first        = '';
        $arr_filetype = $this->File->fileType_arr(array('pdf'));//指定可以打开的文件后缀
        if(!empty($tempdir)){
			$back = null !== GF('back') ? GF('back'):'';
			if(!empty($back)){
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				array_pop($tempdir);
				if(count($tempdir)>3)
				{$first = 'on';}
				$tempdir = implode('/',$tempdir);
				$ismatch = strpos($tempdir,'Images/schoolfile/'.$this->wxid);
				if($ismatch===false){echo 'err';exit;};
				$dir = ROOT.$tempdir.'/';
			}else{
//				if($value['temptype']==0){$ismatch = strpos($tempdir,'Tp/PC/'.$value['installdir']);}
//				else if($value['temptype']==1){$ismatch = strpos($tempdir,'Tp/M/'.$value['installdir']);}
//				if($ismatch===false){echo 'err';exit;};
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				$nowdir  = ChkSQL(KS_S('nowdir'));
				if(empty($nowdir)){
					if(count($tempdir)>3){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $dir = ROOT.$tempdir.'/';
				}else{
					if(count($tempdir)>2){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $tempdir = $tempdir.'/'.$nowdir;
				    $dir = ROOT.$tempdir.'/';
				}
			}
		}else{
			$tempdir      = 'Images/schoolfile/'.$this->wxid.'/';
		    $dir          = ROOT.$tempdir.'/';
		}
		$dirname      = array();
	    $filename     = array();
	    if (is_dir($dir)) {
			 $filelist = scandir($dir,1);
			 foreach($filelist as $k=>$v){
				 if (is_dir($dir.$v)) {$dirname[] = $v;}else{
					$suffix = $this->File->get_file_type($v);
					foreach($arr_filetype as $kt=>$vt){if($suffix == $vt ){$filename[] = $v;}}
				 }
			 }
			 $dirname=array_diff($dirname,array('..','.'));
			 $dirname=array_values($dirname);
	    }
        include  CURR_VIEW_PATH . "Index/file_list.php";
    }
    //同步图片到百度云
    public function SyncimagesAction(){
    	$this->File->fileType_arr(array('jpg','png'));//指定可以打开的文件后缀
    	$tempdir      = null !== GF('tempdir') ? GF('tempdir'):'Images/';
	    $dir          = ROOT.$tempdir;
	    if (is_dir($dir)) {
	    	 $this->File->read_all_number($dir);
	    }
	    //var_dump($this->File->file_number);exit;

        include  CURR_VIEW_PATH . "Index/images_sync.php";
    }
    //上传课程文件
     //文件列表
	public function coursefileaaAction(){

		$type         = null !== GF('type') ? GF('type'):'parent';
		$name         = ChkSQL(KS_S('name'));
		$tempdir      = ChkSQL(KS_S('tempdir'));
    	$first        = '';
      $arr_filetype = $this->File->fileType_arr(array('pdf'));//指定可以打开的文件后缀
      if(!empty($tempdir)){
			$back = null !== GF('back') ? GF('back'):'';
			if(!empty($back)){
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				array_pop($tempdir);
				if(count($tempdir)>3)
				{$first = 'on';}
				$tempdir = implode('/',$tempdir);
				$ismatch = strpos($tempdir,'Images/schoolfile/'.$this->wxid);
				if($ismatch===false){echo 'err';exit;};
				$dir = ROOT.$tempdir.'/';
			}else{
				if($value['temptype']==0){$ismatch = strpos($tempdir,'Tp/PC/'.$value['installdir']);}
				else if($value['temptype']==1){$ismatch = strpos($tempdir,'Tp/M/'.$value['installdir']);}
				if($ismatch===false){echo 'err';exit;};
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				$nowdir  = ChkSQL(KS_S('nowdir'));
				if(empty($nowdir)){
					if(count($tempdir)>3){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $dir = ROOT.$tempdir.'/';
				}else{
					if(count($tempdir)>2){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $tempdir = $tempdir.'/'.$nowdir;
				    $dir = ROOT.$tempdir.'/';
				}
			}
		}else{
			$tempdir      = 'Images/schoolfile/'.$this->wxid.'/';
		    $dir          = ROOT.$tempdir.'/';
		}
		$dirname      = array();
	    $filename     = array();
	    if (is_dir($dir)) {
			 $filelist = scandir($dir,1);
			 foreach($filelist as $k=>$v){
				 if (is_dir($dir.$v)) {$dirname[] = $v;}else{
					$suffix = $this->File->get_file_type($v);
					foreach($arr_filetype as $kt=>$vt){if($suffix == $vt ){$filename[] = $v;}}
				 }
			 }
			 $dirname=array_diff($dirname,array('..','.'));
			 $dirname=array_values($dirname);
	    }
        include  CURR_VIEW_PATH . "Index/course_file.php";
      }
		public function wxfileAction(){
			$type1         = null !== GF('type1') ? GF('type1'):1;
			$type          = null !== GF('type') ? GF('type'):'parent';
			$name          = null !== GF('name') ? GF('name'):'';
			$chektype      = null !== GF('chektype') ? GF('chektype'):'1';
			$nowdirid      = ChkClng(KS_S('nowdirid'));
			$nowdir        = ChkSQL(KS_S('nowdir'));
			$app_dir       = M('app_dir');
			$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
			$tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
			$files         = M($tablename);
			$dirname       = $app_dir->getAll('where wxid ='.$this->wxid.' and type='.$type1.' order by adddate desc','name,id');
			$where ='where wxid = '.$this->wxid;
			if($type1 == 2){
				$where.=' and type =2';
			}elseif($type1 == 3){
				$where.=' and  type =3';
			}elseif($type1 == 4){
				$where.=' and  type =4';
			}elseif($type1 == 5){
				$where.=' and  type =5';
			}
			$where.=' order by adddate desc';
			if(!empty($nowdirid)){
				$dir = $app_dir->getAll('where id ='.$nowdirid);
				$nowdir = $dir[0]['name'];
				$subName = $dir[0]['file'];
				$filename = $files->getAll(' where dirid='.$nowdirid.' and type = '.$type1.' order by adddate desc');
			}else{
				$dir = $app_dir->getAll('where name='.date('Ym').' and wxid='.$this->wxid);
		//			$nowdir = $dir[0]['name'];
				if(empty($dir)){
					$dirData['wxid'] = $this->wxid;
					$dirData['name'] = date('Ym');
					$dirData['file'] = date('Ym');
					$dirData['adddate'] = time();
					$dirData['type'] = $type1;
					$nowdirid = $app_dir->doAdd($dirData,'id');
				}else{
					$nowdirid = $dir['0']['id'];
				}
				$subName = date('Ym');
				$nowdirid = $nowdirid;

				$filename = $files->getAll($where);

			}

			$count = $files->getAll($where,'count(id) as count');
			$sum = $count[0]['count'];
			$options['now_page']   = null !==GF('p') ? GF('p'):'1';
			$options['maxperpage'] = 10;
			$options['totalput']   = count($filename);
			$page = Page($options);
			$filename   = $page->arrayPage($filename);
			if(empty($filename)){
				$filename = array();
			}

			include  CURR_VIEW_PATH . "Index/wxfiles.php";
		}
		public function delwxfileAction(){
		    $postStr    = json_decode(file_get_contents("php://input"));
    		$fileUrl    = isset($postStr->fileUrl)?$postStr->fileUrl:ChkSQL(KS_G('param.fileUrl'));
			$patten     = '';
			$labelname  = '';
			preg_match_all('/({img:[^{\$}]*})/i',$fileUrl,$patten);
			if(!empty($patten[0])){
				foreach($patten[0] as $k=>$v){
					preg_match('/(?<=\{img:)[ ]*[\w\S ]+[ ]*(?=\})/i',$patten[0][$k],$labelname);
					$ary = array();$filename = '';
					if(!empty($labelname)){
						$ary   = explode(',',$labelname[0]);
						$wxid  = $ary[0];$imgid = $ary[1];
						if(empty($wxid)||empty($imgid)){return $fileUrl;}
						$model = new \Kesion\Model\App\FileModel();
						$model->delByFileId($imgid);
//						$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$wxid,'uploadtableid');
//						$tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
//						$files         = M($tablename);
//						$infos         = $this->cache->GetHCache('website',$wxid);//读出缓存
//						$setting       =  explode('|',$infos['setting']);
//						$baiduname     = $files->getOne('baiduname','where id='.$imgid.' limit 1');
//						//var_dump($baiduname);
//						$files->delete('id='.$imgid);
//
//						$aliOss               = new \Core\Upload(array(),'Oss',array());
//						$Data001['function']  = 'deleteObject';
//						$Data001['baiduname']    = $baiduname;
//						$aliOss->aliOss($Data001);

					}
				}
			}
            echo 'ok';
		}
public function musiclistAction(){
    	$type1         = null !== GF('type1') ? GF('type1'):1;
    	$type          = null !== GF('type') ? GF('type'):'parent';
		$name          = ChkSQL(KS_S('name'));
		$chektype      = null !== GF('chektype') ? GF('chektype'):'1';
		$nowdirid      = ChkClng(KS_S('nowdirid'));
		$nowdir        = ChkClng(KS_S('nowdir'));
		$app_dir       = M('app_dir');
		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		$tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
		$files         = M($tablename);
		$dirname       = $app_dir->getAll('where wxid ='.$this->wxid.' and type='.$type1.' order by adddate desc','name,id');
		$where ='where wxid = '.$this->wxid;
		if($type1 == 2){
			$where.=' and type =2';
		}elseif($type1 == 3){
			$where.=' and  type =3';
		}elseif($type1 == 4){
			$where.=' and  type =4';
		}elseif($type1 == 5){
			$where.=' and  type =5';
		}
	    $where.=' order by adddate desc';
		if(!empty($nowdirid)){
			$dir = $app_dir->getAll('where id ='.$nowdirid);
			$nowdir = $dir[0]['name'];
			$subName = $dir[0]['file'];
			$filename = $files->getAll(' where dirid='.$nowdirid.' and type = '.$type1.' order by adddate desc');
		}else{
			$dir = $app_dir->getAll('where name='.date('Ym').' and wxid='.$this->wxid);
//			$nowdir = $dir[0]['name'];
			if(empty($dir)){
				$dirData['wxid'] = $this->wxid;
				$dirData['name'] = date('Ym');
				$dirData['file'] = date('Ym');
				$dirData['adddate'] = time();
				$dirData['type'] = $type1;
				$nowdirid = $app_dir->doAdd($dirData,'id');
			}else{
				$nowdirid = $dir['0']['id'];
			}
			$subName = date('Ym');
			$nowdirid = $nowdirid;

			$filename = $files->getAll($where);

		}

		$count = $files->getAll($where,'count(id) as count');
		$sum = $count[0]['count'];
		$options['now_page']   = null !==GF('p') ? GF('p'):'1';
		$options['maxperpage'] = 10;
	    $options['totalput']   = count($filename);
		$page = Page($options);
		$filename   = $page->arrayPage($filename);
		if(empty($filename)){
			$filename = array();
		}

    	include  CURR_VIEW_PATH . "Website/music_list.php";
    }
    public function coursefileAction(){
    	$type          = null !== GF('type') ? GF('type'):2;
		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		$tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
		$fileModel     = M($tablename);
        $where ='where wxid = '.$this->wxid;
		if($type == 2){
			$where.=' and type =2';
		}elseif($type == 3){
			$where.=' and  type =3';
		}elseif($type == 4){
			$where.=' and  type =4';
		}elseif($type == 5){
			$where.=' and  type =5';
		}elseif($type == 1){
			$where.=' and  type =1';
		}

		$options = $fileModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$values  = $fileModel->getPage($page,'id desc',$where);

    	include  CURR_VIEW_PATH . "Index/course_file.php";
    }
    public function ImportAction(){
    	$type          = null !== GF('type') ? GF('type'):0;
    	$courseid      = ChkClng(KS_S('courseid'));
    	$classid       = ChkClng(KS_S('classid'));
    	include  CURR_VIEW_PATH . "Index/ImportExcel.php";
    }
    public function doExcelAction(){
    	$type           = null !== GF('type') ? GF('type'):0;
    	$classid        = ChkClng(KS_S('classid'));
    	$courseid       = ChkClng(KS_S('courseid'));
    	$studentrelate  = M('app_class_studentrelate');
        if($courseid!=0){
        	$courseModel = M('app_course');
        	$course      = $courseModel->getRow('where courseid ='.$courseid);
        }
        // var_dump($course);exit();
        if(!empty($_FILES['execl']['tmp_name'])){
			$this->upload->savePath = 'users/excel/'.$this->wxid.'/'; // 设置附件上传（子）目录
			$this->upload->exts =array('xls','xlsx','csv');// 设置附件上传类型
			$info = $this->upload->uploadOne($_FILES['execl']);
			if(!$info) {// 上传错误提示错误信息
				KS_INFO($this->upload->getError(),0,'','',1);
			}else{
				$execl = ChkSQL($this->upload->rootPath.$info['savepath'].$info['savename']);//应用封面图片
			}
		}else{KS_Alert('请选择文件','error','history.back()');}
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
        if($type == 1){//excel导入学员
    	        $sheet           = $objPHPExcel->getSheet(0);  //取得sheet(0)表
				$highestRow      = ($sheet->getHighestRow());// 取得总行数
				$highestColumn   = $sheet->getHighestColumn(); // 取得总列数
				// var_dump($highestRow);exit();
				$userModel       = M('common_user');
				$userMemberModel = M('common_user_member');
				$count           = $userModel->getOne('count(*)','where usertype=0 and wxid='.$this->wxid);
				$num             = wx_version_itemvalue(23,$this->wxid);  //学生数限制
				if($count>=$num){
                    KS_Alert('导入失败。当前套餐允许导入'.$num.'人,请升级套餐。excel学员'.($highestRow-1).'人,网校已有学员'.$count.'人','error','history.back()');
				}
				$groupModel = M('common_user_group');
				for($i=2;$i<=$highestRow;$i++){
					$data['username']  = ((int)$userModel->getMaxValue('username','usertype=0 and (username REGEXP "^[0-9]+$")'))+1;
					//$objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
					$name       = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
					$password   = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
					if (!empty($name)||!empty($password)){
						if(empty($data['username'])){
							KS_Alert('导入失败。excel学员,序号'.($i-1).'。账号为空,请改正后再批量导入','error','history.back()');
						}
						if(empty($password)){
							KS_Alert('导入失败。excel学员,序号'.($i-1).'。密码为空,请改正后再批量导入','error','history.back()');
						}
						$count1 = $userModel->getOne('count(*)','where usertype=0 and username="'.$data['username'].'"');
						if($count1>0){
							KS_Alert('导入失败。excel学员,序号'.($i-1).'。学员账号'.$data['username'].'云平台已存在','error','history.back()');
						}
						$groupid           = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
						if (!empty($groupid)){
							$res = $groupModel->getOne('id',"where wxid=$this->wxid and id=$groupid and type=0");
							if (!$res)  KS_Alert('导入失败。excel学员,序号'.($i-1).'分组ID设置有误','error','history.back()');
						}
					}

				}

				for($i=2;$i<=$highestRow;$i++){
					 $data['username']  = ((int)$userModel->getMaxValue('username','usertype=0 and (username REGEXP "^[0-9]+$")'))+1;
					 //$objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
					 $password          = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
					 $data['mobile']    = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
					 $data['email']     = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
					 $groupid           = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();

					 //if(empty($data['username']) || empty($password)){continue;}
					 $data['parentid']      = $this->userid;
					 $data['usertype']      = 0;
					 $data['status']        = 1;
					 $data['groupid']       = !empty($groupid)?$groupid:0;
					 $data['mobilebing']    = 0;
					 $data['wxid']          = $this->wxid;
					 $data['rndpasswordc']  = rand(100000,999999);
					 $data['regdate']       = ChkClng(time());
					 $data['password']      = KS_MD5($password.KS_MD5($data['rndpasswordc']));
					 $user =  $userModel->getRow("where username = '$data[username]' and  wxid = $this->wxid");
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
			         if($courseid !=0){
					    $paystatus = $this->cache->GetU('havecourses','courseid',$courseid,'paystatus',$userid);//读出缓存
			            if($paystatus!=1){//var_dump($paystatus);exit;
		                	 $userModel =M('common_user');
		                	 $member = $userModel->getRow('where userid = '.$userid.' limit 1');
		                	 $app_order_info        = M('app_order_info');
		                	 $Datas['wxid']         = $this->wxid;
							 $Datas['userid']       = $member['parentid'];
							 $Datas['memberid']     = $userid;
							 $Datas['courseid']     = $courseid;
							 $Datas['paystatus']    = 1;
						     $Datas['title']        = $course['title'];
						     $Datas['price']        = $course['price'];
						     $Datas['market_price'] = $course['price_market'];
						     $Datas['defaultpic']   = $course['defaultpic'];
							 $Datas['adddate']      = time();
						     $app_order_info->doAdd($Datas,'id');//添加单个课程信息
		                     $this->cache->PutUCache('havecourses',$userid);
		                }
						$url=M_URL('course/Index','student',$courseid,GP(''));
					}else{
						$url=M_URL('users/Index','index','',GP('appid-3'));
					}
					if($classid !=0){
						$Datas['wxid']        = $this->wxid;
						$Datas['memberid']    = $userid;
						$Datas['classid']     = $classid;
					    $Datas['status']      = 1;
						$Datas['adddate']     = time();
					    $studentrelate->doAdd($Datas,'id');//添加单个课程信息
						$url = M_URL('class/Index','student',$classid,GP(''));
					}
				}
				KS_INFO('添加成功',3,$url);
      }elseif($type == 2){
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
					if($courseid == 0){
						$Data['courseid'] = 0;
						$url = M_URL('exam/Index','TkIndex','',GP('appid-10'));
					}else{
						$Data['courseid']   = $courseid;
						$courseModel        = M('app_course');
						$Data['categoryid'] = $courseModel->getOne('categoryid',' where courseid='.$courseid.' limit 1');
						$url=M_URL('course/Index','Tkindex',$courseid,GP(''));
					}
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
      	         KS_INFO('添加成功',3,$url);
           }
    }
   //选择题目
   public function selectTkAction(){
   	    $courseModel = M('app_course');
		$course      = $courseModel -> getAll('where wxid ='.$this->wxid .' and status !=-1');
		$tkModel     = M('app_paper_tk');
		$papertypeModel=M('app_paper_type');
		$papertype   = $papertypeModel->getAll('where wxid ='.$this->wxid);
   	     //setcookie("selectTk","",time() - 3600);
   	     $tklist   = null !== GF('tklist') ? GF('tklist'):'';

   	     if(empty($_COOKIE['selectTk'])){
   	       setcookie('selectTk',$tklist,time()+3600,'/');
   	     }
   	     $tmNum       = null !== GF('tmNum') ? GF('tmNum'):0;
   	     $courseid    = ChkClng(KS_S('courseid'));
   	     $tktype      = null !==GF('tktype') ? GF('tktype'):0;
		 $tklevel     = null !==GF('tklevel') ? GF('tklevel'):'0';
		 $papertypeid = null !==GF('papertypeid') ? GF('papertypeid'):'0';
		 $keyword     = KS_S('keyword');
		 $where       = '';
		 $where      .=' where wxid = '.$this->wxid;
	     if($tktype!=0){$where.='  and tktype = '.$tktype;}
		 if(!empty($tklevel)){$where.=' and level = '.$tklevel;}
		 if($courseid !=0 ){$where.=' and courseid = '.$courseid;}
		 if(!empty($papertypeid)){$where.='  and paperTypeId = '.$papertypeid;}
		 if(!empty($keyword)){
		 $where.=" and options like '%$keyword%'";}
		 $options    = $tkModel->getOptions('10',$where);//分页参数设置
		 $page       = Page($options);
		 $tk         = $tkModel->getPage($page,'tkId desc',$where,'*');
   	     include  CURR_VIEW_PATH . "Index/tk_list.php";
   }
    //获取未读消息
    public function noreadAction(){
    	$Massage      = M('app_massage');
		$Massages = $Massage->getAll('where wxid='.$this->wxid.' and (userid=0 or userid='.$this->userid.') and type=1 order by addtime desc','count(*) as sum');
    	echo $Massages[0]['sum'];
    }
    //首页订单统计
    public function orderdataAction(){
    	$type = ChkClng(KS_G('post.type'));
		if(empty($type)){$type =2;}
		//1 上周 2 本周 3 本月 4 本季度5本年
		//获取订单的数据
		$Data['type'] = $type;
		$apnlog       = M('Application/LogModel');
		$result       = $apnlog->orderdata($Data);//首页订单统计
		if($Data['type']==4){
			echo json_encode(array('payorder'=>$result['day2'],'ordermoney'=>$result['day'],'startday'=>$result['startday'],'endday'=>$result['endday'],'dateHours'=>$result['day3']));exit;
		}else{
			echo json_encode(array('payorder'=>$result['day2'],'ordermoney'=>$result['day'],'startday'=>$result['startday'],'endday'=>$result['endday']));exit;
		}

    }

}