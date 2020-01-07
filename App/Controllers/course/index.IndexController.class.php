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
	 * 进入直播间
	 */
	public function liveAction(){
		$token = ChkSQL(KS_S("get.token"));
		$courseid = ChkClng(KS_S("get.courseid",0));
		$type = ChkClng(KS_S("get.type",2));//1老师2学生
		if ($token) {
			if (!getsession('user_' . $token)) {
				if ($type==1){
					$app_course_teacherrelate = M('app_course_teacherrelate');
					$relate = $app_course_teacherrelate->getRow("where wxid=$this->wxid and token='$token' and courseid=$courseid", 'token,endtime,teacherid');
				}else{
					$app_course_studentrelate = M('app_course_rate');
					$relate = $app_course_studentrelate->getRow("where wxid=$this->wxid and token='$token' and courseid=$courseid", 'token,endtime,userid as teacherid,name');
				}
				if ($relate && time() <= $relate['endtime']){
					if (strstr($relate['teacherid'],'API_')){
						$userinfo['name'] = $relate['name'];
						$userinfo['avatar'] = $relate['headpic'];
						$userinfo['usertype'] = 0;
					}else{
						$user = User_GetUser($relate['teacherid']);
						$userinfo['head'] = $user['head'];
						$userinfo['name'] = $user['name'];
						$userinfo['usertype'] = $user['usertype'];
					}
					$userinfo['userid'] = $relate['teacherid'];
					putsession('user_' . $token, $userinfo);
				}else{
					echo '链接已过期，请重新联系管理员';exit;
				}
			}
			putsession("user_live:$courseid",getsession('user_' . $token));
		}
		if (is_weixin()){
			$newurl  = wx_Url($this->wxid).'/?f=m#/course/'.$courseid;   
			ks_header($newurl);
		}
		include  VIEW_PATH . MODULE . DS  . "home.live/dist/index.html";
	}
	
	
	 //课程列表页
     public function indexAction(){ 
     	$Data['maxPerPage'] = $this->getMaxPage('course/index.html');
		$ClassModel         = M('App/ClassModel');
	 	$result             = $ClassModel  ->courselist($Data);
//		$Linkage = Linkage(array());$Linkage->cachename  = 'appcategory';//读出缓存$Linkage->wxid       = $GLOBALS['_DoM']['wxid'];//读出缓存$Linkage->categoryid = $categoryid;$this->assign('Linkage',$Linkage->Linkage(5));
	    $this->assign('page',$result['page']);
		$this->assign('style',$result['style']);
		$this->assign('dt',$result['dt']);
		$this->display('course/index.html');
     }
     //课程列表页（ajax版）
     public function indexAjaxAction(){ 
     	$Data['maxPerPage'] = null !=ChkClng(KS_G('request.maxperpage')) ? ChkClng(KS_G('request.maxperpage')):'50';
    	$Data['now_page']   = ChkClng(KS_G('request.p'))!=0 ? ChkClng(KS_G('request.p')):'1';
		$ClassModel         = M('App/ClassModel');
	 	$result             = $ClassModel  ->courselist($Data);
	    header("Content-type: application/json"); 
	    echo json_encode($result);exit;
     }
     //课程内容页
	 public function viewAction(){
		$id    = ChkClng(KS_G("request.id"));
		if(empty($id)){$id = $this->AppModel->getOne('courseid','where wxid='.$GLOBALS['_DoM']['wxid'].' limit 1');} 
		$value = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid ='.$id.' limit 1');
		if(empty($value)){
			$this->assign('getMessage','没有该课程');
	        $this->display('404.html');
		}
		if($value['defaultpic']==''){$value['defaultpic'] = $this->getInstall().'Public/images/list_1.jpg';}
		if($value['price']==0){$value['price'] = '免费';}else{$value['price'] = '￥'.$value['price'];}
		$value['attribute0'] = number_format(getAB(0,$value['attribute']), 2);
		$value['attribute1'] = number_format(getAB(1,$value['attribute']), 2);
		$value['attribute2'] = number_format(getAB(2,$value['attribute']), 2);
//      var_dump($value);exit;
//		$category = $this->cache->GetHCache('appcategory',$GLOBALS['_DoM']['wxid']);//读出缓存
//		$Linkage = Linkage(array());	
//		$Linkage->categoryid = $value['categoryid'];
		$GLOBALS['_DoM']['categoryid'] = $value['categoryid'];
		if($this->memberinfo  != null) {
		   $havecourses = $this->cache->GetU('havecourses','courseid',$id,'',$this->memberid,true);//读出缓存
		   $this->assign('havecourses',$havecourses);
		}
		$question = ks_editor('describe','','1');
		$this->assign('describe',$question);
		$this->assign('emot',getEmot());
		$this->assign('field',$value);
		$this->display('course/view.html');
     }
     public function view2Action(){
     	//var_dump('666');exit;
		$id    = ChkClng(KS_G("request.id"));
		if(empty($id)){$id = $this->AppModel->getOne('courseid','where wxid='.$GLOBALS['_DoM']['wxid'].' limit 1');} 
		$value = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid ='.$id.' limit 1');
		if(empty($value)){
			$this->assign('getMessage','没有该课程');
	        $this->display('404.html');
		}
		if($value['defaultpic']==''){$value['defaultpic'] = $this->getInstall().'Public/images/list_1.jpg';}
		if($value['price']==0){$value['price'] = '免费';}else{$value['price'] = '￥'.$value['price'];}
		$value['attribute0'] = number_format(getAB(0,$value['attribute']), 2);
		$value['attribute1'] = number_format(getAB(1,$value['attribute']), 2);
		$value['attribute2'] = number_format(getAB(2,$value['attribute']), 2);
		$GLOBALS['_DoM']['categoryid'] = $value['categoryid'];
		if($this->memberinfo  != null) {
		   $havecourses = $this->cache->GetU('havecourses','courseid',$id,'',$this->memberid,true);//读出缓存
		   $this->assign('havecourses',$havecourses);
		}
		$question = ks_editor('describe','','1');
		$this->assign('describe',$question);
		$this->assign('emot',getEmot());
		$this->assign('field',$value);
		include  CURR_VIEW_PATH . "view.php";
    }
	 //课程底下的课程章节列表
	 public function ContentsAjaxAction(){
	 	$type = ChkClng(KS_G("post.type")); 
		$courseid = ChkClng(KS_G("post.courseid")); 
		$value = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid ='.$courseid.' limit 1');
		if(empty($value)){echo '{"errcode":"10001"}';exit;}
		$course_chapter = M($value['chaptertable']);
		$byname      = 'root,orderid';  
		$maxperpage  = null !=ChkClng(KS_G('post.maxperpage')) ? ChkClng(KS_G('post.maxperpage')):'4';
		$left_join   = M('app_vod_list');//需要连表的在最后left join
		$where       = 'where a.wxid='.$GLOBALS['_DoM']['wxid'].' and a.courseid='.$courseid;
		$where       = "as a left join `$left_join->table` as b on a.videoId = b.vdoId $where";
		$options = $course_chapter->getOptions(500,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page    = Page($options); 
		$chapter = $course_chapter->getPage($page,$byname,$where); 
		foreach($chapter as $k=>$v){
			if($v['depth']==3){
				if(!empty($type)){
					$chapter[$k]['liveurl'] = M_URL('course','getVdo',$v['courseid'],GP('chapterid-'.$v['chapterid']));
				}else{
					$chapter[$k]['liveurl'] = M_URL('course','ClassPlay',$v['courseid'],GP('chapterid-'.$v['chapterid']));
				}
				$chapter[$k]['playtime'] =secToTime($v['playtime']);
			}
			if($v['chaptertype']==2&&$v['depth']==3){
				$chapter[$k]['begindate'] = date('Y-m-d',$v['begindate']);
				$chapter[$k]['enddate']   = date('Y-m-d',$v['enddate']);
			}
			if($v['chaptertype']==1&&$v['depth']==3){
				$chapter[$k]['begindate'] = date('Y-m-d',$v['begindate']);
			}
		}
		$result['values']            =  $chapter; 
		$result['page']              =  $page; 
		$result['chapterTemplate']   =  $value['chapterTemplate']; 
		header("Content-type: application/json"); 
	    echo json_encode($result);exit;
     }
	 //课程底下的课程考卷列表
	 public function CourseExamAjaxAction(){
		$courseid = ChkClng(KS_G("post.courseid")); 
		$value = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid ='.$courseid.' limit 1');
		if(empty($value)){echo '{"errcode":"10001"}';exit;}
		$app_paper = M('app_paper');
		$where = 'where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid='.$courseid;
		$byname = 'paperid desc';
		$maxperpage          = null !=ChkClng(KS_G('post.maxperpage')) ? ChkClng(KS_G('post.maxperpage')):'4';
		$options = $app_paper->getOptions($maxperpage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page = Page($options);
		$paper = $app_paper->getPage($page,$byname,$where); 
		foreach($paper as $k=>$v){
		    $paper[$k]['url'] = M_URL('exam','test',$v['paperid']);
		}
		$result['values'] =  $paper; 
		$result['page']   =  $page; 
		header("Content-type: application/json");
	    echo json_encode($result);exit;
     }
	 //课程底下购买用户的评价
	 public function ReviewsAjaxAction(){
		$courseid = ChkClng(KS_G("post.courseid")); 
		$grade    = ChkClng(KS_G("post.grade"));
		if($grade==0){$where = " where (grade=1 or grade=2 or grade = 3)";}
		elseif($grade==1){$where = "where grade=1"; }
		elseif($grade==2){$where = "where grade=2"; }
		elseif($grade==3){$where = "where grade=3";}
		$value    = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid ='.$courseid.' limit 1');
		if(empty($value)){echo '{"errcode":"10001"}';exit;}
		$app_reviews = M('app_reviews');
		$where   .= ' and appid=6 and wxid='.$GLOBALS['_DoM']['wxid'].' and infoid='.$courseid;
		$byname  = 'adddate desc';
		$maxperpage          = null !=ChkClng(KS_G('post.maxperpage')) ? ChkClng(KS_G('post.maxperpage')):'4';
		$options = $app_reviews->getOptions($maxperpage,$where);//分页参数设置
		$options['now_page'] = ChkClng(KS_G("post.now_page"))!== 0 ? ChkClng(KS_G("post.now_page")):'1';
		$page = Page($options);
		$reviews = $app_reviews->getPage($page,$byname,$where); 
		foreach($reviews as $k=>$v){
			$headurl = $this->upload->getHead($v['memberid']);
			$reviews[$k]['headurl'] = $headurl ? $headurl :'';
			$reviews[$k]['adddate'] = KS_DATE($v['adddate']);
		}
		$result['allgrade']  =  $app_reviews->getOne('count(*)','where (grade=1 or grade=2 or grade = 3) and appid=6 and wxid='.$GLOBALS['_DoM']['wxid'].' and infoid='.$courseid);//全部
		$result['goodgrade'] =  $app_reviews->getOne('count(*)','where grade=1 and appid=6 and wxid='.$GLOBALS['_DoM']['wxid'].' and infoid='.$courseid);//好评
		$result['midgrade']  =  $app_reviews->getOne('count(*)','where grade=2 and appid=6 and wxid='.$GLOBALS['_DoM']['wxid'].' and infoid='.$courseid);//中评
		$result['badgrade']  =  $app_reviews->getOne('count(*)','where grade=3 and appid=6 and wxid='.$GLOBALS['_DoM']['wxid'].' and infoid='.$courseid);//差评
		$result['values']    =  $reviews; 
		$result['page']      =  $page; 
		header("Content-type: application/json");
	    echo json_encode($result);exit;
     }
     //课程底下课程资料
	 public function MaterialAjaxAction(){
	 	$type          = null !== GF('type') ? GF('type'):0;
		$courseid      = ChkClng(KS_G("post.courseid")); 
		$course        = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid ='.$courseid.' limit 1');
		$fileModel     = M('app_course_file');
		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$GLOBALS['_DoM']['wxid'],'uploadtableid');
		$extends_table = M('common_extends_table');
		$tablename     = $extends_table->getOne('tablename','where tableid='.$uploadtableid);
		$fileModel     = M($tablename);
		$courseFile    = M('app_course_file');
	    $where         = "as a left join $fileModel->table as b on a.fileid=b.id  where  a.wxid = ".$GLOBALS['_DoM']['wxid']." and a.courseid =$courseid  ";
		if($type == 1){$where.=' and b.type =1';
		}elseif($type == 2){$where.=' and  b.type =2';
	    }elseif($type == 3){$where.=' and  b.type =3';
	    }elseif($type == 4){$where.=' and  b.type =4';
	    }elseif($type == 5){$where.=' and  b.type =5';}
		//$where   .=' group by a.fileid';
		$maxperpage          = null !=ChkClng(KS_G('post.maxperpage')) ? ChkClng(KS_G('post.maxperpage')):'4';
		$options             = $courseFile->getOptions($maxperpage,$where);//分页参数设置
		$options['now_page'] = null != ChkClng(KS_G('post.now_page'))? ChkClng(KS_G('post.now_page')):'1';
		$page    = Page($options);
		$values  = $courseFile->getPage($page,'a.id desc',$where);
		foreach($values as $k=>$v){$values[$k]['adddate']  = date("Y-m-d",$v['adddate']);}
		$result['page']      = $page;
		$result['values']    = $values;
		header("Content-type: application/json");
	    echo json_encode($result);exit; 
    }
    //进入播放页
    public function ClassPlayAction(){
    	
		$chapterid   = null !==GF('chapterid') ? GF('chapterid'):0;
	
		$courseid    = ChkClng(KS_G("request.id")); 
		$value       = $this->AppModel->getRow('where courseid ='.$courseid.' limit 1');
		$memberinfo  = getsession('member');//用来判断是否登录
	    check_login($this->memberinfo);//检查是登录权限  
		if($value['price'] != 0){//判断课程不是免费的，检查启动
			   check_login($this->memberinfo);//检查是登录权限  
			   $paystatus = $this->cache->GetU('havecourses','courseid',$courseid,'paystatus',$this->memberid);//读出缓存
               if($paystatus!=1){$this->assign('getMessage','您没有观看该视频的权限，到其他课程看看');$this->display('404.html');exit;}
		}else{//判断课程免费，检查是否登录，没有登录直接看，登录了插入到订单信息，为了记录观看进度
 	       if(!empty($memberinfo)){
 	       	    $paystatus = $this->cache->GetU('havecourses','courseid',$courseid,'paystatus',$this->memberid);//读出缓存
                if($paystatus!=1){//var_dump($paystatus);exit;
                	 $app_order_info        = M('app_order_info');
                	 $Datas['wxid']         = $GLOBALS['_DoM']['wxid'];
					 $Datas['userid']       = $this->parentid;
					 $Datas['memberid']     = $this->memberid;
					 $Datas['courseid']     = $courseid;
					 $Datas['paystatus']    = 1;
				     $Datas['title']        = $value['title'];
				     $Datas['price']        = $value['price'];
				     $Datas['market_price'] = $value['price_market'];
				     $Datas['defaultpic']   = $value['defaultpic'];
					 $Datas['adddate']      = time();
				     $app_order_info->doAdd($Datas,'id');//添加单个课程信息
                     $this->cache->PutUCache('havecourses',$this->memberid);
                }
 	       }else{//check_login($this->memberinfo);
 	       }
		}
		
		$chapteModel     = M($value['chaptertable']);
		if($chapterid==0){
			$chapter = $chapteModel->getRow('where  courseid = '.$courseid.' and depth = 3 order by root,orderid limit 1');$chapterid=$chapter['chapterid'];
			
		}else{
			$chapter    = $chapteModel->getRow('where  courseid = '.$courseid.' and depth = 3 and chapterid='.$chapterid);
		}
			
		if(!$chapter){$chapter['chaptertype']=1;$chapter['videoId']=0;}
		
		if($chapter['chaptertype']==1){//点播//获取章节
			$chapters=getChapters($value['chapterTemplate'],$courseid,$chapteModel);
	        
			if(isset($this->memberid)){
			    $uid         =  $this->memberid;
			}else{
				$uid   =  '419'.rand(1000000,9999999);
			    $this->memberinfo['username']='游客';
			}
          
            $ClassModel        = M('App/ClassModel');
		 	$result             = $ClassModel  ->playVod($chapter['videoId']);
			$teacherhead = $this->upload->getHead($value['teacherid']);
		    $Mode = M('common_user_teacher');
		    $teachername = $Mode->getOne('name','where userid='.$value['teacherid']);
		    $this->assign('sign',$value['title']);
		    $this->assign('title',$this->memberinfo['Sex']);
		    $this->assign('Sex',$this->memberinfo['Sex']);
		    $this->assign('teachername',$teachername);
		    $this->assign('teacherhead',$teacherhead);
			$this->assign('chapters',$chapters);
			$this->assign('username',$this->memberinfo['username']);
			$this->assign('uid',$uid);
			$this->assign('wxid',$GLOBALS['_DoM']['wxid']);
			$this->assign('courseid',$courseid);
	        $this->assign('chapterid',$chapterid);
	        $this->assign('courseType',1);//点播
	        $this->assign('vdourl', M_URL('course','getVdo',$courseid,GP('chapterid-'.$chapterid)));
//	        $this->assign('videoId', $chapters['videoId']);
			$this->assign('field',$value);
			$this->assign('emot',getEmot());
			$this->assign('avatar',$this->upload->getHead($uid,4,5));
			
			
			$live        =  new Core\AgoraLive($GLOBALS['_DoM']['wxid']); 
			$SignKey     =  $live ->generateSignKey(time(),$uid); 
		
			//旁路
	 	    $playUrl['flv']      =''; 
	 	    $playUrl['m3u8']     =''; 

			$pushlive            =  new Core\TencentLive($GLOBALS['_DoM']['wxid']); 
			$channelName         =  'a'.$courseid;
 	        $playUrl             =  $pushlive->getPlayUrl($channelName); 
			$expiredTs             =  0;
			$ChannelKey          =  $live -> generateMediaChannelKey($channelName, $this->memberid, $expiredTs);
			$this->assign('ChannelKey',$ChannelKey); 
	        $this->assign('playurl',$playUrl); 
			$this->assign('channelName',$channelName);
			$this->assign('SignKey',$SignKey);
			$liveappid       =  $live->getAppid(); 
			$this->assign('liveappid',$liveappid);
			//---------------------默认背景加载-----------------------
			$IndexModel           = M('Application/IndexModel');
		    $Data007['memberid']  = $this->memberid; 
	        $result               = $IndexModel->backgroup($Data007); 
	        //---------------------end-----------------------
			$name        = empty($this->memberinfo['name']) ?  $this->memberinfo['username'] :$this->memberinfo['name'];
			$this->assign('name',$name); 
			$this->assign('tempPxt',$result['tempPxt']);
			$this->assign('background',$result['background']);//默认背景图片
			$this->assign('bid',$result['backgroundStyle']['0']);
			$this->assign('backmusic',$result['backmusic']);//默认背景音乐
			$this->assign('volume',$result['volume']);//默认背景音量
			//==============================================================
			$this->display('course/view.html',1);
		}elseif($chapter['chaptertype']==2){//直播
			$url='https://'.firstdomain().'/course/getLive/'.$courseid.'?chapterid='.$chapterid;
			ks_header($url);	
		}elseif($chapter['chaptertype']==3){
			$this->display('course/playFace.html',1);
		}
    }
    //进入直播
    public function getLiveAction(){
    	check_login($this->memberinfo);//检查是登录权限   
        $chapterid = null !==GF('chapterid') ? GF('chapterid'):0;
        $courseid = ChkClng(KS_G("request.id")); 
        $value       = $this->AppModel->getRow('where courseid ='.$courseid.' limit 1'); 
        $chapteModel     = M($value['chaptertable']);
		if($chapterid==0){
			$liveChapters = $chapteModel->getAll('where  courseid = '.$courseid.' and chaptertype =2 and depth = 3 order by root,orderid ');
			$chapterid =chapterFirst($liveChapters); //正在直播的课程
			$chapter    = $chapteModel->getRow('where  courseid = '.$courseid.' and depth = 3 and chapterid='.$chapterid);
		}else{
			$chapter    = $chapteModel->getRow('where  courseid = '.$courseid.' and depth = 3 and chapterid='.$chapterid);
		}
//		if(!$chapter){
//			$this->assign('getMessage','暂无可课时');$this->display('404.html');exit;
//		}
		//判断最大并发
		//if(!concurrent($GLOBALS['_DoM']['wxid'])){$this->assign('getMessage','当前并发数达最大');$this->display('404.html');exit;}
		
        $chapters=getChapters($value['chapterTemplate'],$courseid,$chapteModel);
		if(isset($this->memberid)){
		     $uid   =  $this->memberid;
		}else{
			 $uid   =  '419'.rand(1000000,9999999);
			 $this->memberinfo['username']='游客';
		}
		$teacherhead = $this->upload->getHead($value['teacherid']);
		$Mode = M('common_user_teacher');
		$teachername = $Mode->getOne('name','where userid='.$value['teacherid']);
		$this->assign('teachername',$teachername);
		$this->assign('teacherhead',$teacherhead);
        $this->assign('chapters',$chapters);
		$this->assign('username',$this->memberinfo['username']);
		$this->assign('uid',$uid);
		$this->assign('wxid',$GLOBALS['_DoM']['wxid']);
		$this->assign('courseid',$courseid);
        $this->assign('chapterid',$chapterid);
		$this->assign('field',$value);
		$this->assign('title',$value['title']);
		$this->assign('emot',getEmot());
		$this->assign('avatar',$this->upload->getHead($uid,4,5));
		$this->assign('courseType',$value['courseType']);//点播
      	$liveModel   =  M('app_live_list');
		$channl      =  $liveModel->getRow('where courseid ='.$courseid.'  limit 1');

		$live        =  new Core\AgoraLive($GLOBALS['_DoM']['wxid']);  
	 	$channelName =  !empty($channl['channlName'])?$channl['channlName']:'a'.$courseid;
	  	$expiredTs   =  0;
	  	$acken       =  $live -> generateMediaChannelKey($channelName, $uid, $expiredTs);
	  	$SignKey     =  $live ->generateSignKey(time(),$uid);
	  	$liveappid       =  $live->getAppid(); 
	    $this->assign('liveappid',$liveappid); 
	  	//加入学生观看表
//	  	$studentModel = M($channl['studentTable']);
//	  	$student      = $studentModel->getRow('where wxid= '.$GLOBALS['_DoM']['wxid'].' and memberid = '.$uid.' and channlid ='.$channl['id'].' limit 1');
//	  	if($student){
//	  		if($student['status'] == 2){
//	  			  $Data['status']    = 1;
//	  			  $Data['starttime'] = time();
//	  		      $studentModel->update($Data,'id = '.$student['id']);
//	  		}
//	  	}else{
//	  		$Data['status']    = 1;
//	  		$Data['starttime'] = time();
//	  		$Data['wxid']      = $GLOBALS['_DoM']['wxid'];
//	  		$Data['channlid']  = $channl['id'];
//	  		$Data['memberid']  = $uid;
//	  		$studentModel->doAdd($Data,'id');
//	  	}
        
		$expiredTs           =  0;
		$ChannelKey          =  $live -> generateMediaChannelKey($channelName, $this->memberid, $expiredTs);
		$this->assign('ChannelKey',$ChannelKey); 

	  	$this->assign('SignKey',$SignKey); 
		$this->assign('channelName',$channelName);
		$this->assign('channelid',$channl['id']);



		$this->assign('token',$acken);//$channelKey
		$this->assign('roomname',$chapter['videoId']);
		//旁路
		$pushlive = new Core\TencentLive($GLOBALS['_DoM']['wxid']); 
 	    $playUrl  = $pushlive->getPlayUrl($channelName); 
        $this->assign('playurl',$playUrl); 
		//---------------------默认背景加载-----------------------
		$IndexModel           = M('Application/IndexModel');
		
	    $Data007['memberid']  = $this->memberid; 
	
        $result               = $IndexModel->backgroup($Data007); 
        //---------------------end-----------------------
		$name        = empty($this->memberinfo['name']) ?  $this->memberinfo['username'] :$this->memberinfo['name'];
	    $this->assign('name',$name); 
	    $this->assign('tempPxt',$result['tempPxt']);
		$this->assign('background',$result['background']);//默认背景图片
		$this->assign('bgmid',$result['backgroundStyle']['1']);
		$this->assign('bid',$result['backgroundStyle']['0']);
		$this->assign('backmusic',$result['backmusic']);//默认背景音乐
		$this->assign('volume',$result['volume']);//默认背景音量\
		//==============================================================
		$this->display('course/view.html',1);
     }
     //获取点播视频
     public function getVdoAction(){
     	$chapterid   = null !==GF('chapterid') ? GF('chapterid'):0;
		$courseid    = ChkClng(KS_G("request.id"));   
		$value       = $this->AppModel->getRow('where courseid ='.$courseid.' limit 1'); 
		$memberinfo  = getsession('member');//用来判断是否登录
		if($value['price'] != 0){//判断课程不是免费的，检查启动
			   check_login($this->memberinfo);//检查是登录权限  
			   $paystatus = $this->cache->GetU('havecourses','courseid',$courseid,'paystatus',$this->memberid);//读出缓存
               if($paystatus!=1){$this->assign('getMessage','您没有观看该视频的权限，到其他课程看看');$this->display('404.html');exit;}
		}else{//判断课程免费，检查是否登录，没有登录直接看，登录了插入到订单信息，为了记录观看进度
 	       if(!empty($memberinfo)){
 	       	    $paystatus = $this->cache->GetU('havecourses','courseid',$courseid,'paystatus',$this->memberid);//读出缓存
                if($paystatus!=1){//var_dump($paystatus);exit;
                	 $app_order_info        = M('app_order_info');
                	 $Datas['wxid']         = $GLOBALS['_DoM']['wxid'];
					 $Datas['userid']       = $this->parentid;
					 $Datas['memberid']     = $this->memberid;
					 $Datas['courseid']     = $courseid;
					 $Datas['paystatus']    = 1;
				     $Datas['title']        = $value['title'];
				     $Datas['price']        = $value['price'];
				     $Datas['market_price'] = $value['market_price'];
				     $Datas['defaultpic']   = $value['defaultpic'];
					 $Datas['adddate']      = time();
				     $app_order_info->doAdd($Datas,'id');//添加单个课程信息
                     $this->cache->PutUCache('havecourses',$this->memberid);
                }
 	       }
		}
		$chapteModel     = M($value['chaptertable']);
		if($chapterid==0){
			$chapter = $chapteModel->getRow('where  courseid = '.$courseid.' and depth = 3 order by root,orderid limit 1');$chapterid=$chapter['chapterid'];
		}else{
			$chapter    = $chapteModel->getRow('where  courseid = '.$courseid.' and depth = 3 and chapterid='.$chapterid);
		}
		
//		$courseModel        = M('App/CourseModel');
//	 	$result             = $courseModel  ->playVod($chapter['videoId']);
//		 $this->assign('player',$result);
//   	//获取百度视频
//      $vod = new Core\Baiduyun();//百度视频
//		try{ 
//		 	  $vods = $vod->selectVod($chapter['videoId']);
//			  $status=$vods->status;
//			  switch($status){
//				  case 'PROCESSING' : $this->assign('getMessage','视频转码中，到其他课程看看');$this->display('404.html');break;
//				  case 'FAILED'     : $this->assign('getMessage','视频转码错误，到其他课程看看');$this->display('404.html');break;
//				  case 'DISABLED'   : $this->assign('getMessage','视频被禁用，到其他课程看看');$this->display('404.html');break;
//				  case 'BANNED'     : $this->assign('getMessage','视频被禁止，到其他课程看看');$this->display('404.html');break;
//			  }
//			  $play = $vods->playableUrlList;  
//			  foreach($play as $k=>$v){
//				  $playurl[$k]['url']        = $v->url;
//				  $playurl[$k]['teblemname'] = $v->transcodingPresetName;
//			  }
//			  $uservod         = M('app_vod');
//			  $vod             = $uservod->getRow('where wxid = '.$GLOBALS['_DoM']['wxid']);
//			  $setting         = explode('※',$vod['setting']);
//			  if(!empty($memberinfo)){
//			  	  $app_vod_list          = M('app_vod_list');
//			      $Datacouse['sumtime'] = $chapteModel->getOne('sum(b.playtime)','as a left join `'.$app_vod_list->table.'` as b on a.videoId=b.vdoId where  courseid = '.$courseid.' and depth = 3');
//			      $app_order_info        = M('app_order_info');
//			      $app_order_info->update($Datacouse,'courseid='.$courseid.' and wxid = '.$GLOBALS['_DoM']['wxid']); 
//			      $this->cache->PutUCache('havecourses',$this->memberid);
//			      $allchapte             = $this->cache->GetU('havecourses','courseid',$courseid,'allchapte',$this->memberid);//读出缓存
//			      $allchapteArr          = explode('#',$allchapte);$position=0;
//		     	  foreach($allchapteArr as $k=>$v){$info      = explode(',',$v);if($info[0]==$chapterid){$position=$info[1];}}
//			  	  $player  = getplay($playurl,$setting,1,$courseid,$chapterid,$position);
//			  }else{
//			  	  $player  = getplay($playurl,$setting,0,$courseid,$chapterid,100);
//			  } 
//			  $this->assign('player',$player);
//		 }catch(Exception $e){
//			  $this->assign('getMessage','视频出错，请联系管理员');$this->display('404.html');       
//		 }
         $this->display('course/vdo.html',1); 
    }
    //记录时间长短
    public function PlayTimeAction(){
     	$memberinfo      = getsession('member');
     	if(empty($memberinfo)){echo 'unlogin';exit;}
     	$courseid        = ChkClng(KS_G("request.courseid")); 
     	$chapterid       = ChkClng(KS_G("request.chapterid")); 
     	$position        = ChkSQL(KS_G("request.position")); 
     	$duration        = ChkSQL(KS_G("request.duration")); 
     	$courseinfo      = $this->AppModel->getRow('where courseid ='.$courseid.' and wxid = '.$GLOBALS['_DoM']['wxid'].' limit 1');
     	$chapteModel     = M($courseinfo['chaptertable']);
     	//判断总时长为0，就说明错误，重新算下
     	$Data['sumtime'] = $this->cache->GetU('havecourses','courseid',$courseid,'sumtime',$this->memberid);//读出缓存
     	if(empty($Data['sumtime'])){
	     	$app_vod_list    = M('app_vod_list');
		    $Data['sumtime'] = $chapteModel->getOne('sum(b.playtime)','as a left join `'.$app_vod_list->table.'` as b on a.videoId=b.vdoId where  courseid = '.$courseid.' and depth = 3');
	    }
     	$app_order_info  = M('app_order_info');
     	$allchapte       = $this->cache->GetU('havecourses','courseid',$courseid,'allchapte',$this->memberid);//读出缓存
     	
     	if(!empty($allchapte)){
     		$allchapteArr = explode('#',$allchapte);$i = 0; 
     		foreach($allchapteArr as $k=>$v){
     			$info      = explode(',',$v);
     			if($info[0]==$chapterid){$i = 1;if($position>$info[1]||$duration!=$info[2]){$allchapteArr[$k] = $info[0].','.$position.','.$duration;}}
     		}
     		if($i==0){$Data['allchapte'] = $allchapte.'#'.$chapterid.','.$position.','.$duration;}else{$Data['allchapte'] = implode('#',$allchapteArr);}
     	}else{
	     	$Data['allchapte']  = $chapterid.','.$position.','.$duration;
     	}
     	$resultchapteArr = explode('#',$Data['allchapte']);$studytime = 0;
     	foreach($resultchapteArr as $k=>$v){
     			$info      = explode(',',$v);
     			$studytime = $studytime+$info[1];
     	}
     	$Data['progress']   = $studytime/$Data['sumtime'];
     	$app_order_info->update($Data,'courseid='.$courseid.' and wxid = '.$GLOBALS['_DoM']['wxid']);
     	$this->cache->PutUCache('havecourses',$this->memberid);echo 'ok';exit;
     }
	
	 public function cartAction(){
		check_login($this->memberinfo);//检查是登录权限
		if(null !==cookie('KESION_TWO')){
		    cookie('KESION_TWO',null);
			$url = M_URL('course','cart');
			KS_INFO('',2,$url);
		}
		$dt = $this->cache->GetUCache('cartcourse',$this->memberid);
		$this->assign('dt',$dt);
	    $this->display('course/cart.html');
     }
	 public function buynowAction(){
		check_login($this->memberinfo);//检查是登录权限
		$courseid = ChkClng(KS_G('request.id'));
		if(empty($courseid)){KS_INFO('请选择您要购买的课程',0,'','',1);}
		$url = M_URL('course','confirm',$courseid);
		KS_INFO('',2,$url);
     }
	 public function batchAction(){
		check_login($this->memberinfo);//检查是登录权限
		$batch       = ChkSQL(KS_G('post.batch'));
		$courseids   = ChkSQL(KS_G('post.courseid'));
		$cart_course = M('app_cart_course');
		if($batch==1){
			if(empty($courseids)){KS_INFO('请选择您要删除的课程',0,'','',1);}
			foreach($courseids as $k=>$v){$cart_course->delete('wxid='.$GLOBALS['_DoM']['wxid'].' and memberid='.$this->memberid.' and courseid='.$v);}
			$this->cache->PutUCache('cartcourse',$this->memberid);
			$url = M_URL('course','cart');
			KS_INFO('删除成功',2,$url);
		}else{
			if(empty($courseids)){KS_INFO('请选择您要购买的课程',0,'','',1);}
			$Data['status'] = 0;
			$cart_course->update($Data,'wxid='.$GLOBALS['_DoM']['wxid'].' and memberid='.$this->memberid);
			$Data['status'] = 1;
			foreach($courseids as $k=>$v){$cart_course->update($Data,'wxid='.$GLOBALS['_DoM']['wxid'].' and memberid='.$this->memberid.' and courseid='.$v);}
			$this->cache->PutUCache('cartcourse',$this->memberid);
			$url = M_URL('course','confirm');
			KS_INFO('',2,$url);
		}
     }
	 public function RedpacketAjaxAction(){
		$sum_money    = floatval(ChkSQL(KS_G('post.sum_money')));
		$Redpacketnum = M('app_red_packetnum');
		$Redpacket    = M('app_red_packet');
		$values       = $Redpacketnum->getAll("as a left join `$Redpacket->table` as b on a.redpacketid = b.id where a.wxid=".$GLOBALS['_DoM']['wxid']." and a.memberid=".$this->memberid." and b.facevalue<=".$sum_money." and b.startime<".time()." and b.endtime>".time()." and a.isuse=0");
		header("Content-type: application/json");
	    echo empty($values)?'{"errcode":"10001"}':json_encode($values);exit;
     }
     //订单确认页
	 public function confirmAction(){
	 	check_login($this->memberinfo);//检查是登录权限
	    cookie('KESION_TWO',date("YmdHis"),3600);
	 	$Data['memberid']   = $this->memberid;
	 	$Data['parentid']   = $this->parentid;
		$PayModel           = M('App/PayModel');
	 	$result             = $PayModel  ->confirm($Data);
	 	if($result['situation']==2){
	 		$this->assign('getMessage',$result['getMessage']);
       		$this->display('404.html');exit;
	 	}
	 	$ordersn = ChkSQL(null !==GF('ordersn') ? GF('ordersn'):'');
	 	if(!empty($ordersn)){
			$this->assign('ordersn',$ordersn);
		}
	 	if(isset($result['courseid'])&&!empty($result['courseid'])){
	 		$this->assign('classid',$result['courseid']);
	 	}
		$this->assign('paytitle','购课程车');
		$this->assign('posturl',M_URL('course','pay'));
		$this->assign('dt',$result['dt']);
		$this->assign('Money',$result['Money']);//用户总余额
		$this->assign('sumMoney',$result['sumMoney']);//商品总金额
		$this->assign('linepay_money',$result['linepay_money']);//在线支付还需要金额
		$this->assign('left_price',$result['left_price']);//可用余额付款
		$this->assign('dx_money',$result['dx_money']);//用户总余额和商品总金额的差价
	    $this->display('class/confirm.html');
     }
     //订单支付页
	 public function payAction(){
	 	$Data['memberid']   = $this->memberid;
	 	$Data['parentid']   = $this->parentid;
	 	$PayModel           = M('App/PayModel');
	 	$PayModel  ->pay($Data);
     }
     //服务的详情
	 public function wxbackAction(){
	    $ordersn             = ChkClng(KS_G('request.ordersn'));
	    $shopModel           = M('app_order');
		$paystatus           = $shopModel->getOne('paystatus',"where wxid=".$GLOBALS['_DoM']['wxid']." and ordersn='$ordersn' limit 1");
	    if($paystatus==1){
	    	echo 'succeed';exit;
	    }
	 }
     public function wxcoursebackAction(){
		$Kspay                      = new \Core\Kspay(array('payid' => 2));
		$result                     = $Kspay->wx_return();
		//获取通知的数据
	    $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
	    /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
         the best way is to check the validity of xml by yourself */
	    // 使用simplexml技术对xml进行解析
	    // libxml_disable_entity_loader(true), 是从安全性考虑，为了防止xml外部注入，
	    //只对xml内部实体内容进行解析
	    libxml_disable_entity_loader(true);
	    //加载 postStr 字符串
	    $postObj      = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
		if($result&&$postObj->return_code == "SUCCESS"&&$postObj->result_code == "SUCCESS"){
			$out_trade_no           = $postObj->out_trade_no; //商户订单号
			$total_fee              = $postObj->total_fee;    //支付宝交易号
			$trade_type             = $postObj->trade_type;;  //交易状态
			
			$shopModel    = M('app_order');
			$order_info   = M('app_order_info');
			$orderinfo    = $shopModel->getRow("where ordersn='$out_trade_no' limit 1",'orderid,userid,memberid,wxid,memberip,order_amount');
			$usersModel   = M('common_user');
			$Money        = $usersModel->getOne('money'," WHERE userid=$orderinfo[userid] limit 1");
			//插入订单明细表
			$Datapl['wxid']    = $orderinfo['wxid'];
			$Datapl['userid']  = $orderinfo['userid'];
			$Datapl['adddate'] = time();
			$Datapl['cmoney']  = $orderinfo['order_amount'];
			$Datapl['balance'] = $orderinfo['order_amount']+$Money;
			$Datapl['type']    =  0;
			$Datapl['memberip']= $orderinfo['memberip'];
			$Datapl['mark']    = '用户余额不充足，充值'.$orderinfo['order_amount'];
			$pay_log           = M('app_pay_log');
			$pay_log->doAdd($Datapl,'id');
			
			//插入订单明细表
			$Dataplt['wxid']    = $orderinfo['wxid'];
			$Dataplt['userid']  = $orderinfo['userid'];
			$Dataplt['adddate'] = time();
			$Dataplt['cmoney']  = $orderinfo['order_amount']+$Money;
			$Dataplt['balance'] = 0;
			$Dataplt['type']    = 1;
			$Dataplt['memberip']= $orderinfo['memberip'];
			$Dataplt['mark']    = '用户余额充足，直接余额扣款'.$Dataplt['cmoney'];
			$pay_log->doAdd($Dataplt,'id');
			$Datau['money']     = 0;
			$usersModel->update($Datau,"userid=$orderinfo[userid]");
			$Data['paystatus']  = 1;
			$order_info->update($Data,"orderid=$orderinfo[orderid] limit 1");
			$shopModel->update($Data,"orderid=$orderinfo[orderid] limit 1");
			
			$this->cache->PutUCache('havecourses',$orderinfo['memberid']);
			
			$wxinfo             = $this->cache->GetHCache('website',$orderinfo['wxid']);//读出缓存
			$Datawx['withdrawmoney'] = $wxinfo['withdrawmoney']+$orderinfo['order_amount'];
		    $user_website            = M('common_user_website');
		    $user_website->update($Datawx,"wxid=$orderinfo[wxid]");
		    $this->cache->PutHCache('website',$orderinfo['wxid']);
		 }
     }
	 public function coursebackAction(){
		 $Kspay  = new \Core\Kspay();
		 $result = $Kspay->alipay_return();
		 if($result){
			$out_trade_no = $_GET['out_trade_no'];//商户订单号
			$trade_no     = $_GET['trade_no'];//支付宝交易号
			$trade_status = $_GET['trade_status']; //交易状态
			$shopModel    = M('app_order');
			$order_info   = M('app_order_info');
			$orderinfo    = $shopModel->getRow("where ordersn='$out_trade_no' limit 1",'orderid,userid,memberid,wxid,memberip,order_amount');
			$usersModel   = M('common_user');
			$Money        = $usersModel->getOne('money'," WHERE userid=$orderinfo[userid] limit 1");
			//插入订单明细表
			$Datapl['wxid']    = $orderinfo['wxid'];
			$Datapl['userid']  = $orderinfo['userid'];
			$Datapl['adddate'] = time();
			$Datapl['cmoney']  = $orderinfo['order_amount'];
			$Datapl['balance'] = $orderinfo['order_amount']+$Money;
			$Datapl['type']    =  0;
			$Datapl['memberip']= $orderinfo['memberip'];
			$Datapl['mark']    = '用户余额不充足，充值'.$orderinfo['order_amount'];
			$pay_log           = M('app_pay_log');
			$pay_log->doAdd($Datapl,'id');
			
			//插入订单明细表
			$Dataplt['wxid']    = $orderinfo['wxid'];
			$Dataplt['userid']  = $orderinfo['userid'];
			$Dataplt['adddate'] = time();
			$Dataplt['cmoney']  = $orderinfo['order_amount']+$Money;
			$Dataplt['balance'] = 0;
			$Dataplt['type']    = 1;
			$Dataplt['memberip']= $orderinfo['memberip'];
			$Dataplt['mark']    = '用户余额充足，直接余额扣款'.$Dataplt['cmoney'];
			$pay_log->doAdd($Dataplt,'id');
			$Datau['money']     = 0;
			$usersModel->update($Datau,"userid=$orderinfo[userid]");
			$Data['paystatus']  = 1;
			$order_info->update($Data,"orderid=$orderinfo[orderid] limit 1");
			$shopModel->update($Data,"orderid=$orderinfo[orderid] limit 1");
			
			$this->cache->PutUCache('havecourses',$orderinfo['memberid']);
			
			$wxinfo                  = $this->cache->GetHCache('website',$orderinfo['wxid']);//读出缓存
			$Datawx['withdrawmoney'] = $wxinfo['withdrawmoney']+$orderinfo['order_amount'];
		    $user_website            = M('common_user_website');
		    $user_website->update($Datawx,"wxid=$orderinfo[wxid]");
		    $this->cache->PutHCache('website',$orderinfo['wxid']);
			$url = M_URL('home','class');ks_header($url);
		 }
     }
	 //进入章
	 public function chapterAction(){
		 $courseModel = M('app_course');
		 $courseid = ChkClng(KS_G('request.id'));
		 $chapterTable = $courseModel->getOne('chaptertable','where courseid ='.$courseid.' limit 1 ');
		 $chapterModel = M($chapterTable);
		 $where = 'where courseid = '.$courseid .' and  parentid = 0';
		 $byname = 'root,orderid';
		 $maxPerPage = $this->getMaxPage('course/chapter.html',1);
		 $options =  $chapterModel ->getOptions($maxPerPage,$where);//分页参数设置
		 $options['now_page'] = null !==GF('p') ? GF('p'):'1';
		 $page = Page($options);
		 $dt =  $chapterModel ->getPage($page,$byname,$where); 
		 $this->assign('page',$page);
		 $this->assign('dt',$dt);
         $this->display('course/chapter.html',1);
	 }
	 //进入节
	 public function sectionAction(){
		 $chapterid    = ChkClng(KS_G('request.id'));
		 $courseid     = null !==GF('courseid') ? GF('courseid'):'0';
		 $courseModel  = M('app_course');
		 $chapterTable = $courseModel->getOne('chaptertable','where courseid ='.$courseid.' limit 1 ');
		 $chapterModel = M($chapterTable);
		 $chapter = $chapterModel -> getRow('where chapterid ='.$chapterid);
		 $where   = 'where courseid = '.$courseid .' and  parentid = '.$chapterid ;
		 $byname  = 'root,orderid';
		 $maxPerPage = $this->getMaxPage('course/section.html',1);
		 $options =  $chapterModel ->getOptions($maxPerPage,$where);//分页参数设置
		 $options['now_page'] = null !==GF('p') ? GF('p'):'1';
		 $page    = Page($options);
		 $dt      =  $chapterModel ->getPage($page,$byname,$where); 
		 $this->assign('page',$page);
		 $this->assign('dt',$dt);
         $this->display('course/section.html',1); 
	 }
	 //进入课时
	 public function keshiAction(){
	     $chapterid = ChkClng(KS_G('request.id'));
		 $courseid = null !==GF('courseid') ? GF('courseid'):'0';
		 $courseModel = M('app_course');
		 $chapterTable = $courseModel->getOne('chaptertable','where courseid ='.$courseid.' limit 1 ');
		 $chapterModel = M($chapterTable);
		 $where = 'where courseid = '.$courseid .' and  parentid = '.$chapterid ;
		 $byname = 'root,orderid';
		 $maxPerPage = $this->getMaxPage('course/keshi.html',1);
		 $options =  $chapterModel ->getOptions($maxPerPage,$where);//分页参数设置
		 $options['now_page'] = null !==GF('p') ? GF('p'):'1';
		 $page = Page($options);
		 $dt =  $chapterModel ->getPage($page,$byname,$where); 
		 $this->assign('page',$page);
		 $this->assign('dt',$dt);
         $this->display('course/keshi.html',1); 	 
	}
	
	//进入签到
	public function signAction(){
		
		
		 $this->display('sign/sign.html',1); 
	}
	
	
	
	 //课程应用配置
	public function settingAction(){
		echo '课程应用配置';exit;
	}
	public function rechargemoneyMAction(){
     	$orderid                 = ChkClng(KS_G('get.id'));
		if(!empty($orderid)){
			$app_order        = M('app_order');
			$orderinfo           = $app_order->getRow('where orderid='.$orderid,'ordersn,order_amount');
			$Data['ordersn']     = $orderinfo['ordersn'];
			$rechargemoney       = $orderinfo['order_amount'];
		}else{
			$rechargemoney       = ChkSQL(KS_G('post.money'));
	     	list($usec, $sec)    = explode(" ", microtime());
			$Data['ordersn']     = $this->memberid.((float)$usec + (float)$sec)*10000;
			$shopModel           = M('app_order');
		    $Data['memberid']    = $this->memberid;
		    $Data['wxid']        = $GLOBALS['_DoM']['wxid'];
		    $Data['memberip']      = $_SERVER['SERVER_ADDR'];
		    $Data['type']        = 2;
		    $Data['order_amount']= $rechargemoney;
		    $Data['adddate']     = time();
		    $Data['paystatus']   = 0;
		    $orderid             = $shopModel->doAdd($Data,'orderid');
		    //订单详情
		    $order_apps          = M('app_order_info');
		    $Datas['wxid']       = $GLOBALS['_DoM']['wxid'];
		    $Datas['ordersn']    =  $Data['ordersn'];
		    $Datas['orderid']    = $orderid;
		    $Datas['paystatus']  = 0;
		    $Datas['type']       = 2;
		    $Datas['memberid']   = $this->memberid;
	    	$Datas['title']    	 = '充值余额'.$rechargemoney;
		    $Datas['adddate']    = time();
		    $Datas['price']      = $rechargemoney;
		    $Datas['defaultpic'] = '/Images/images/201707/14994809769188.png';
		    $Datas['orderid']    = $orderid;
			$order_apps->doAdd($Datas,'id');//添加单个app信息
		}
		$type =ChkSQL(KS_G('post.type'));
     	if($type==1){//支付宝支付
			$payid               = 1;
	     	$Kspay               = new \Core\Kspay();
			$Kspay->out_trade_no = $Data['ordersn'];
			$Kspay->total_fee    = $rechargemoney;
			$Kspay->payid        = $payid;
			$Kspay->return_url   = 'http://'.firstdomain().'/course/rechargebackM';
			$Kspay->pay();
		}else{//微信支付
			$Kspay               = new \Core\Kspay(array('payid' => 2));
			$Kspay->out_trade_no = $Data['ordersn'];
			$Kspay->total_fee    = $rechargemoney; 
			$Kspay->notify_url   = 'https://store.kesion.com/home.html/default/Payback/wxrechargemoneyback';
			$url2 = $Kspay->pay();$type=3;
			include  ROOT . "Plus/native.php";exit;  
		}
     }
     public function rechargebackMAction(){
     	$Kspay                   = new \Core\Kspay();
		$result                  = $Kspay->alipay_return();
		if($result){
			$out_trade_no        = $_GET['out_trade_no']; //商户订单号
			$trade_no            = $_GET['trade_no'];     //支付宝交易号
			$trade_status        = $_GET['trade_status']; //交易状态
			
			$order_info          = M('app_order_info');
			$shopModel           = M('app_order');
			$orderinfo           = $shopModel->getRow("where ordersn='$out_trade_no' limit 1",'orderid,wxid,memberid,memberip,order_amount');
			$user                = M('common_user');
			$Money               = $user->getOne('money',"where userid=".$orderinfo['memberid']);
			//调用唤起传说中的model层 
			$apnlog      = M('Application/LogModel');
			$apnlog->memberlog($orderinfo,$Money,1);//用户使用通过小课堂使用支付宝进行充值
			
			$Datau['money']      = $orderinfo['order_amount']+$Money;
			$user->update($Datau,"userid=".$orderinfo['memberid']);
			
			$Data['paystatus']   = 1;
			$shopModel->update($Data,"ordersn='$out_trade_no' limit 1");	
			$order_info->update($Data,"wxid=$orderinfo[wxid] and orderid=$orderinfo[orderid] limit 1");
			noticeSend($orderinfo['wxid'],$orderinfo['memberid'],$orderinfo['orderid'],'恭喜你使用支付宝成功充值'.$orderinfo['order_amount'],'用户使用通过小课堂使用支付宝进行充值',2,'系统');
			//echo "<script>window.close();</script>";exit;
			ks_header(M_URL('home','class'));
		}	
     }
    
      public function rechargebackWAction(){
	    $ordersn             = ChkClng(KS_G('request.ordersn'));
	    $shopModel           = M('app_order');
		$paystatus           = $shopModel->getOne('paystatus',"where wxid=".$GLOBALS['_DoM']['wxid']." and ordersn='$ordersn' limit 1");
	    if($paystatus==1){
	    	echo 'succeed';exit;
	    }else{
	    	echo 'err';exit;
	    }
	 }
}















   //进入播放界面
//	 public function playAction(){
//		$chapterid   = null !==GF('chapterid') ? GF('chapterid'):'';
//		$id          = ChkClng(KS_G("request.id"));   
//		$value       = $this->AppModel->getRow('where courseid ='.$id); 
//		$memberinfo  = getsession('member');//用来判断是否登录
//		if($value['price'] != 0){//判断课程不是免费的，检查启动
//			   check_login($this->memberinfo);//检查是登录权限  
//			   $paystatus = $this->cache->GetU('havecourses','courseid',$id,'paystatus',$this->memberid);//读出缓存
//             if($paystatus!=1){$this->assign('getMessage','您没有观看该视频的权限，到其他课程看看');$this->display('404.html');exit;}
//		}else{//判断课程免费，检查是否登录，没有登录直接看，登录了插入到订单信息，为了记录观看进度
// 	       if(!empty($memberinfo)){
// 	       	    $paystatus = $this->cache->GetU('havecourses','courseid',$id,'paystatus',$this->memberid);//读出缓存
//              if($paystatus!=1){//var_dump($paystatus);exit;
//              	 $app_order_info        = M('app_order_info');
//              	 $Datas['wxid']         = $GLOBALS['_DoM']['wxid'];
//					 $Datas['userid']       = $this->parentid;
//					 $Datas['memberid']     = $this->memberid;
//					 $Datas['courseid']     = $id;
//					 $Datas['paystatus']    = 1;
//				     $Datas['title']        = $value['title'];
//				     $Datas['price']        = $value['price'];
//				     $Datas['price_market'] = $value['price_market'];
//				     $Datas['defaultpic']   = $value['defaultpic'];
//					 $Datas['adddate']      = time();
//				     $app_order_info->doAdd($Datas,'id');//添加单个课程信息
//                   $this->cache->PutUCache('havecourses',$this->memberid);
//              }
// 	       }
//		}
//		$chapteModel     = M($value['chaptertable']);
//		if(empty($chapterid)){$chapter = $chapteModel->getRow('where  courseid = '.$id.' and depth = 3 order by root,orderid limit 1');$chapterid=$chapter['chapterid'];}
//		else{$chapter    = $chapteModel->getRow('where  courseid = '.$id.' and depth = 3 and chapterid='.$chapterid);}
//		if($chapter['chaptertype']==2){//直播
//			check_login($this->memberinfo);//检查是登录权限  
//			$liveModel   =  M('app_live_list');
//			$channl      =  $liveModel->getRow('where courseid ='.$id.' and chapterid ='.$chapterid.' limit 1');
//			$live        =  new Core\AgoraLive();  
//		  	$uid         =  $this->memberid;
//		 	$channelName =  $channl['channlName'];
//		  	$expiredTs   =  0;
//        	$acken       =  $live -> generateMediaChannelKey($channelName, $uid, $expiredTs);
//        	$SignKey     =  $live ->generateSignKey(time(),$uid);
//        	//加入学生观看表
//        	$studentModel = M($channl['studentTable']);
//        	$student      = $studentModel->getRow('where wxid= '.$GLOBALS['_DoM']['wxid'].' and memberid = '.$this->memberid.' and channlid ='.$channl['id'].' limit 1');
//        	if($student){
//        		if($student['status'] == 2){
//        			  $Data['status']    = 1;
//        			  $Data['starttime'] = time();
//        		      $studentModel->update($Data,'id = '.$student['id']);
//        		}
//        	}else{
//        		$Data['status']    = 1;
//        		$Data['starttime'] = time();
//        		$Data['wxid']      = $GLOBALS['_DoM']['wxid'];
//        		$Data['channlid']  = $channl['id'];
//        		$Data['memberid']  = $this->memberid;
//        		$studentModel->doAdd($Data,'id');
//        	}
//        	$this->assign('SignKey',$SignKey); 
//			$this->assign('channelName',$channelName);
//			$this->assign('channelid',$channl['id']);
//			$this->assign('username',$this->memberinfo['username']);
//			$this->assign('uid',$uid);
//			$this->assign('avatar','http:'.$this->upload->getHead($uid));
//			$this->assign('token',$acken);//$channelKey
//			$this->assign('roomname',$chapter['videoId']);
//			//https://hcl.zuojy.com/index.php/course/play2/75
//			$this->display('course/liveplay.html');
//		}else{//点播           
//           if(empty($chapter['videoId'])){$this->assign('getMessage','这门课还没上传视频，到其他课程看看');$this->display('404.html');}
//		     $vod = new Core\Baiduyun();//百度视频
//			 try{ 
//			 	  $vods = $vod->selectVod($chapter['videoId']);
//				  $status=$vods->status;
//				  switch($status){
//					  case 'PROCESSING' : $this->assign('getMessage','视频转码中，到其他课程看看');$this->display('404.html');break;
//					  case 'FAILED'     : $this->assign('getMessage','视频转码错误，到其他课程看看');$this->display('404.html');break;
//					  case 'DISABLED'   : $this->assign('getMessage','视频被禁用，到其他课程看看');$this->display('404.html');break;
//					  case 'BANNED'     : $this->assign('getMessage','视频被禁止，到其他课程看看');$this->display('404.html');break;
//				  }
//				  $play = $vods->playableUrlList;  
//				  foreach($play as $k=>$v){
//					  $playurl[$k]['url']        = $v->url;
//					  $playurl[$k]['teblemname'] = $v->transcodingPresetName;
//				  }
//				  $uservod         = M('app_vod');
//				  $vod             = $uservod->getRow('where wxid = '.$GLOBALS['_DoM']['wxid']);
//				  $setting         = explode('※',$vod['setting']);
//				  if(!empty($memberinfo)){
//				  	  $app_vod_list          = M('app_vod_list');
//				      $Datacouse['sumtime'] = $chapteModel->getOne('sum(b.playtime)','as a left join `'.$app_vod_list->table.'` as b on a.videoId=b.vdoId where  courseid = '.$id.' and depth = 3');
//				      $app_order_info        = M('app_order_info');
//				      $app_order_info->update($Datacouse,'courseid='.$id.' and wxid = '.$GLOBALS['_DoM']['wxid']); 
//				      $this->cache->PutUCache('havecourses',$this->memberid);
//				      $allchapte             = $this->cache->GetU('havecourses','courseid',$id,'allchapte',$this->memberid);//读出缓存
//				      $allchapteArr          = explode('#',$allchapte);$position=0;
//			     	  foreach($allchapteArr as $k=>$v){$info      = explode(',',$v);if($info[0]==$chapterid){$position=$info[1];}}
//				  	  $player  = getplay($playurl,$setting,1,$id,$chapterid,$position);
//				  }else{
//				  	  $player  = getplay($playurl,$setting,0,$id,$chapterid,100);
//				  } 
//				  $this->assign('player',$player);
//			 }catch(Exception $e){
//				  $this->assign('getMessage','视频出错，请联系管理员');$this->display('404.html');       
//			 }
//           $this->assign('vdoId',$chapter['videoId']);
//			 $this->assign('field',$value);
//			 $this->assign('emot',getEmot());
//		     $this->display('course/playVdo.html',1);
//		}	    
//   }