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
      * 总平台后台主页
      */
     public function indexAction(){
		$appModel = new AppModel('common_app');
		$app      = $appModel->getAll('where shortcut=1 order by orderid asc');
		$webapp   = $appModel->getAll('where isweb=1 order by orderid asc');
		$realModel = M('common_realname');
		$COUNT = $realModel->getOne('count(id)','where status=0');
	    include  CURR_VIEW_PATH . "Index/admin.index.php";
     }
	 /**
	  *  后台主页右侧框架
	  */
	 public function mainfirstAction(){
		 $array = array('controller'=>'index','action'=>'mainfirst','ruletype'=>$this->admininfo['admintype']);
		if (!checkrule($array)){
			$where = " where a.status!=-1 and b.salesman='".$this->admininfo['username']."'";
			$common_domain  = M('common_domain');
			$common_website = M('common_user_website');
			$common_user = M('common_user');
			$table = 'as a left join '.$common_website->table.' as b on a.wxid = b.wxid left join '.$common_user->table.' as c on b.userid = c.userid';
			$clientCount = $common_domain->getOne('count(1)',$table.$where);
			$todayfollowCount = $common_domain->getOne('count(1)',$table.$where." and b.followdate>=".strtotime(date('Y-m-d'),time()));
			$notfollowCount = $common_domain->getOne('count(1)',$table.$where." and (b.followdate=0 or b.nextdate>=".time().")");
			
		}else{
			$option         = KS_S('option',4);
			if($option==1){
				$month_start=mktime(0, 0 , 0,date("m"),1,date("Y"));
				$where  = 'where adddate>'.$month_start;
				$where1 = 'where regdate>'.$month_start;
				$where2 = 'where a.adddate>'.$month_start;
			}elseif($option==3){
				$year_start=mktime(0,0,0,1,1,date('Y'));
				$where  = 'where adddate>'.$year_start;
				$where1 = 'where regdate>'.$year_start;
				$where2 = 'where a.adddate>'.$year_start;
			}elseif($option==2){
				$season        = ceil((date('n'))/3);//当月是第几季度
				$season_start  = mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
				//$season_end  = mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
				$where         = 'where adddate>'.$season_start;
				$where1        = 'where regdate>'.$season_start;
				$where2        = 'where a.adddate>'.$season_start;
			}elseif($option==0){
				$day_start=mktime(0, 0 , 0,date("m"),date("d"),date("Y"));
				$where  = 'where  adddate>'.$day_start;
				$where1 = 'where regdate>'.$day_start;
				$where2 = 'where a.adddate>'.$day_start;
			}elseif($option==4){
				$where  = 'where 1=1';
				$where1 = 'where 1=1';
				$where2 = 'where 1=1';
			}
			$userModel = new AppModel('common_user');
			$orderModel = new AppModel('app_order');
			$orderinfoModel = new AppModel('app_order_info');

			$newsModel = new AppModel('app_news');
			$courseModel = new AppModel('app_course');
			$appModel = new AppModel('common_app');
			$numappModel = new AppModel('common_app_userrelate');
			$newhere      = "as a left join `$appModel->table` as b on a.appid = b.appid GROUP BY a.appid order by count(a.id) desc LIMIT 8";
			$appary = $numappModel->getAll($newhere,'count(a.id) as sum,b.appname,b.defaultpic');//获取热门应用
			//   var_dump($appary);
			$usernum = $userModel->getAll($where1.' and usertype=0','count(userid) as sum');//计算学员总数

			$wxidnum1 = $userModel->getAll($where1.' and usertype=2','count(userid) as sum');//计算网校总数
			$wxidnum = $userModel->getAll($where1.' and (usertype=2 or usertype=1) and parentid=0','count(userid) as sum');//计算总机构
			$wxidnum2 = $userModel->getAll($where1.' and (usertype=1 and parentid=0)','count(userid) as sum');//计算机构总数

			$teachernum = $userModel->getAll($where1.' and usertype=1','count(userid) as sum');//计算教师总数
			$ordernum   = $orderModel->getAll('as a left join `ks_common_user` as b on a.memberid = b.userid '.$where2.' and (a.paystatus=1 or a.paystatus=0) and (a.status=0 or a.status=1)','count(orderid) as sum');//计算订单总数
			$ordereffnum = $orderModel->getAll($where.' and paystatus=1','count(orderid) as sum,sum(order_amount) as allmoney');//计算订单总数
			$newsnum = $newsModel->getAll($where.' and userid!=4 and userid!=0 and wxid!=1','count(id) as sum');//计算新闻总数
			$coursenum = $courseModel->getAll($where.' and userid!=4 and userid!=0 and wxid!=1','count(courseid) as sum');//计算课程总数

			$common_order        = M('common_order');
			$commoncount         = $common_order->getAll('where status!=-1 and paystatus=1');
			$ordercount          = $orderModel->getAll('where status!=-1 and paystatus=1');
			$m =mktime(0,0,0,date('m'),1,date('Y'));
			$day =  mktime(0,0,0,date('m'),date('d'),date('Y'));
			if(date("w")==0){$wday = 7;}else{$wday = date("w");}
			$week =  mktime(0,0,0,date("m"),date("d")-$wday+1,date("Y"));
			$year =  mktime(0,0,0,1,1,date('Y'));

			$yserflag=0;$monthflag=0;$weekflag=0;$dayflag=0;$lastflag=0;$allcount=0;
			$yserflag1=0;$monthflag1=0;$weekflag1=0;$dayflag1=0;$lastflag1=0;$allcount1=0;
			foreach($ordercount as $k =>$v){
				$lastflag+=$v['order_amount'];
				$allcount++;
				if($v['adddate'] == $year ){$yserflag +=$v['order_amount'];}
				if($v['adddate'] == $m){$monthflag +=$v['order_amount'];}
				if($v['adddate'] == $week){$weekflag +=$v['order_amount'];}
				if($v['adddate'] == $day){$dayflag +=$v['order_amount'];}
			}
			foreach($commoncount as $k =>$v){
				$lastflag1+=$v['order_amount'];
				$allcount1++;
				if($v['adddate'] == $year ){$yserflag1 +=$v['order_amount'];}
				if($v['adddate'] == $m){$monthflag1 +=$v['order_amount'];}
				if($v['adddate'] == $week){$weekflag1 +=$v['order_amount'];}
				if($v['adddate'] == $day){$dayflag1 +=$v['order_amount'];}
			}
		}

	     include  CURR_VIEW_PATH . "Index/admin.mainfirst.php";
     }
     /**
      * 清除缓存
      */
     public function delcacheAction(){
         $this->File->unlinkDir(ROOT.'Runtime/LabelSchool/');
         $this->File->unlinkDir(ROOT.'Runtime/SchoolData/');
         $this->File->unlinkDir(ROOT.'Runtime/TempCache/');
         $this->File->unlinkDir(ROOT.'Runtime/LabelSys/');
         $this->File->unlinkDir(ROOT.'Runtime/SysData/');
         $this->File->unlinkDir(ROOT.'Runtime/UserData/');
         if(!is_dir(ROOT.'Runtime/LabelSchool/')){make_dir(ROOT.'Runtime/LabelSchool/');}
         if(!is_dir(ROOT.'Runtime/SchoolData/')){make_dir(ROOT.'Runtime/SchoolData/');}
         if(!is_dir(ROOT.'Runtime/TempCache/')){make_dir(ROOT.'Runtime/TempCache/');}
         if(!is_dir(ROOT.'Runtime/LabelSys/')){make_dir(ROOT.'Runtime/LabelSys/');}
         if(!is_dir(ROOT.'Runtime/SysData/')){make_dir(ROOT.'Runtime/SysData/');}
         if(!is_dir(ROOT.'Runtime/UserData/')){make_dir(ROOT.'Runtime/UserData/');}
         KS_INFO('缓存清除成功',4);
         exit;
     }

     /**
      * 首页订单数据统计（未完善）
      */
     public function courseOrderAction(){
    	$option         =  KS_G('post.option');
        $appcourseModel = new AppModel('app_course');
	    $apporderModel = new AppModel('app_order');
	    $apporderinfoModel = new AppModel('app_order_info');
	    $where      = "as a left join `$appcourseModel->table` as b on a.courseid = b.courseid left join `$apporderModel->table` as c on a.orderid=c.orderid where c.type=0 and c.paystatus=1";
	    $incomeinfo        =$apporderinfoModel->getAll($where,'a.adddate,b.courseType');
        $data=$data2=$data3=$data4=array();
			if($option==1){//按月份
			    $daysInMnth = date('t',mktime(0,0,0,date("m"),1,date("Y")));
				for($i = 1 ;$i<=$daysInMnth;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;$flag2 = 0;$flag3=0;
					$startime = date("Y-m-".$ii);
					foreach($incomeinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							if($v['courseType']==1){
								$flag += 1;
							}elseif($v['courseType']==2){
								$flag2 += 1;
							}elseif($v['courseType']==3){
								$flag3 += 1;
							}

						}
					}
					$data[$i-1]  = $flag;
					$data2[$i-1] = $flag2;
					$data3[$i-1] = $flag3;
					$data4[$i-1] = $i;
				}
				}
			if($option==2){

			    $season     = ceil((date('n'))/3);//当月是第几季度
			    $firstday   = date('z', mktime(0, 0, 0,$season*3-3+1,1,date('Y')));
			    $lastday    = date('z', mktime(23,59,59,$season*3,date('t',mktime(0,0,0,$season*3,1,date("Y"))),date('Y')));
			    $daysInMnth = $lastday-$firstday;
				for($i = 1 ;$i<=$daysInMnth;$i++){
					$startime = date('Y-m-d', mktime(0, 0, 0,$season*3-3+1,1+$i,date('Y')));
					$flag = 0;$flag2 = 0;$flag3=0;
					foreach($incomeinfo as $k =>$v){
						if(date('Y-m-d',$v['adddate']) == $startime ){
							if($v['courseType']==1){
								$flag += 1;
							}elseif($v['courseType']==2){
								$flag2 += 1;
							}elseif($v['courseType']==3){
								$flag3 += 1;
							}

						}
					}
					$data[$i-1]  = $flag;
					$data2[$i-1] = $flag2;
					$data3[$i-1] = $flag3;
					$data4[$i-1] = date('m/d', mktime(0, 0, 0,$season*3-3+1,1+$i,date('Y')));;
				}
			}
			if($option==3){
			    for($i = 1 ;$i<=12;$i++){
					if($i<10){$ii = '0'.$i;}else{$ii = $i;}
					$flag = 0;$flag2 = 0;$flag3 = 0;
					$startime = date("Y");
				    $startime =$startime.'-'.$ii;
					foreach($incomeinfo as $k =>$v){
						if(date('Y-m',$v['adddate']) == $startime ){
							if($v['courseType']==1){
								$flag += 1;
							}elseif($v['courseType']==2){
								$flag2 += 1;
							}elseif($v['courseType']==3){
								$flag3 += 1;
							}

						}
					}
					$data[$i-1]  = $flag;
					$data2[$i-1] = $flag2;
					$data3[$i-1] = $flag3;
					$data4[$i-1] = $i;
				}

			}
		$result['vod']        = $data;
		$result['live']   = $data2;
		$result['face']     = $data3;
		$result['time']       = $data4;
		header('Content-Type:application/json;charset=utf-8');
		echo json_encode($result);

    }

     /**
      * 选择图片
      */
     public function imageslistAction(){
     	$type         = null !== GF('type') ? GF('type'):'parent';
		$name         = null !== GF('name') ? GF('name'):'';
		$tempdir      = null !== GF('tempdir') ? GF('tempdir'):'';
    	$first        = '';
        $arr_filetype = $this->File->fileType_arr(array('jpg','png','jpeg'));//指定可以打开的文件后缀
        if(!empty($tempdir)){
			$back = null !== GF('back') ? GF('back'):'';
			if(!empty($back)){
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				array_pop($tempdir);
				if(count($tempdir)>2){$first = 'on';}
				$tempdir = implode('/',$tempdir);
				$ismatch = strpos($tempdir,'Images/images');
				if($ismatch===false){echo 'err';exit;};
				$dir = ROOT.$tempdir.'/';
			}else{
//				if($value['temptype']==0){$ismatch = strpos($tempdir,'Tp/PC/'.$value['installdir']);}
//				else if($value['temptype']==1){$ismatch = strpos($tempdir,'Tp/M/'.$value['installdir']);}
//				if($ismatch===false){echo 'err';exit;};
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				$nowdir = null !== GF('nowdir') ? GF('nowdir'):'';
				if(empty($nowdir)){
					if(count($tempdir)>2){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $dir = ROOT.$tempdir.'/';
				}else{
					if(count($tempdir)>1){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $tempdir = $tempdir.'/'.$nowdir;
				    $dir = ROOT.$tempdir.'/';
				}
			}
		}else{
			$tempdir      = 'Images/images/';
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
        include  CURR_VIEW_PATH . "Index/admin.imageslist.php";
    }
     /**
      * 选择歌曲
      */
     public function musiclistAction(){
     	$type         = null !== GF('type') ? GF('type'):'parent';
		$name         = null !== GF('name') ? GF('name'):'';
		$tempdir      = null !== GF('tempdir') ? GF('tempdir'):'';
    	$first        = '';
        $arr_filetype = $this->File->fileType_arr(array('mp3'));//指定可以打开的文件后缀
        if(!empty($tempdir)){
			$back = null !== GF('back') ? GF('back'):'';
			if(!empty($back)){
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				array_pop($tempdir);
				if(count($tempdir)>2){$first = 'on';}
				$tempdir = implode('/',$tempdir);
				$ismatch = strpos($tempdir,'Images/music');
				if($ismatch===false){echo 'err';exit;};
				$dir = ROOT.$tempdir.'/';
			}else{
//				if($value['temptype']==0){$ismatch = strpos($tempdir,'Tp/PC/'.$value['installdir']);}
//				else if($value['temptype']==1){$ismatch = strpos($tempdir,'Tp/M/'.$value['installdir']);}
//				if($ismatch===false){echo 'err';exit;};
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				$nowdir = null !== GF('nowdir') ? GF('nowdir'):'';
				if(empty($nowdir)){
					if(count($tempdir)>2){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $dir = ROOT.$tempdir.'/';
				}else{
					if(count($tempdir)>1){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $tempdir = $tempdir.'/'.$nowdir;
				    $dir = ROOT.$tempdir.'/';
				}
			}
		}else{
			$tempdir      = 'Images/music/';
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
        include  CURR_VIEW_PATH . "Index/admin.musiclist.php";
    }




    //文件列表
	public function filelistAction(){
		$type         = null !== GF('type') ? GF('type'):'parent';
		$name         = null !== GF('name') ? GF('name'):'';
		$tempdir      = null !== GF('tempdir') ? GF('tempdir'):'';
    	$first        = '';
        $arr_filetype = $this->File->fileType_arr(array('zip'));//指定可以打开的文件后缀
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
				$ismatch = strpos($tempdir,'Images/H5ZIP/');
				if($ismatch===false){echo 'err';exit;};
				$dir = ROOT.$tempdir.'/';
			}else{
//				if($value['temptype']==0){$ismatch = strpos($tempdir,'Tp/PC/'.$value['installdir']);}
//				else if($value['temptype']==1){$ismatch = strpos($tempdir,'Tp/M/'.$value['installdir']);}
//				if($ismatch===false){echo 'err';exit;};
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				$nowdir  = null !== GF('nowdir') ? GF('nowdir'):'';
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
			$tempdir      = 'Images/H5ZIP/';
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
    //图片列表
    public function adminimagesAction(){
    	$info          = $this->cache->GetHCache('website',$this->wxid);//读出缓存
    	$courseid      = null !== GF('courseid') ? GF('courseid'):0;
    	$classid       = null !== GF('classid') ? GF('classid'):0;
    	$setting       = explode('|',$info['setting']);
    	$isshuiyin     = $setting[6];//提问开启水印
    	$type          = null !== GF('type') ? GF('type'):'parent';
		$name          = null !== GF('name') ? GF('name'):'';
		$chektype      = null !== GF('chektype') ? GF('chektype'):'1';
		$nowdirid      = null !== GF('nowdirid') ? GF('nowdirid'):'';
		$nowdir        = null !== GF('nowdir') ? GF('nowdir'):'';
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
			$filename = $files->getAll('where type=1 and dirid='.$nowdirid.' order by adddate desc');
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
			$filename = $files->getAll('where type=1 and wxid='.$this->wxid.' order by adddate desc');
		}
		$ico = '';
		$count = $files->getAll('where type=1 and wxid='.$this->wxid.' order by adddate desc','count(id) as count');
		$sum = $count[0]['count'];
		$options['now_page']   = null !==GF('p') ? GF('p'):'1';
		$options['maxperpage'] = 10;
	    $options['totalput']   = count($filename);
		$page = Page($options);
		$filename   = $page->arrayPage($filename);
		if(empty($filename)){
			$filename = array();
		}
		include  CURR_VIEW_PATH . "Index/admin_images.php";
    }
   //安装包上传
	public function padEditionAction(){
		$type         = null !== GF('type') ? GF('type'):'parent';
		$name         = null !== GF('name') ? GF('name'):'';
		$tempdir      = null !== GF('tempdir') ? GF('tempdir'):'';
    	$first        = '';
        $arr_filetype = $this->File->fileType_arr(array('apk'));//指定可以打开的文件后缀
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
				$ismatch = strpos($tempdir,'Images/software/');
				if($ismatch===false){echo 'err';exit;};
				$dir = ROOT.$tempdir.'/';
			}else{
//				if($value['temptype']==0){$ismatch = strpos($tempdir,'Tp/PC/'.$value['installdir']);}
//				else if($value['temptype']==1){$ismatch = strpos($tempdir,'Tp/M/'.$value['installdir']);}
//				if($ismatch===false){echo 'err';exit;};
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				$nowdir  = null !== GF('nowdir') ? GF('nowdir'):'';
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
			$tempdir      = 'Images/software/';
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
        include  CURR_VIEW_PATH . "Index/package_list.php";
    }


}
