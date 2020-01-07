<?php
// +----------------------------------------------------------------------
// | KesionPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2019 http://www.kesion.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 厦门科汛软件有限公司　 版权所有 © 2006-2017
// +----------------------------------------------------------------------
// | Advice: 好的编程习惯是成功的一半，对齐，注释  你可以的！1
// +----------------------------------------------------------------------



use Kesion\Controller;
class IndexController extends CommonController
{   
	
    //进入试卷管理
    public function indexAction(){
		$info        = $this->cache->GetA('domaininfo','wxid',$this->wxid,'',true);//读出缓存
     	$setting = appSetting($this->wxid,$this->appid);//获取App配置
		$category       = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		$CategoryModel  = new CategoryModel('app_category');
//		$papertypeModel = M('app_paper_type');
		$where          = 'where a.status=1 and a.wxid='.$this->wxid;
		//分类
		$categoryid = null !==GF('categoryid') ? GF('categoryid'):0;
		if($categoryid!=0) {
			$where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";
		}	
		//关键字搜索
		$keyword = KS_S('keyword');
		$keytype = null !==GF('keytype') ? GF('keytype'):0;
	    if(!empty($keyword)){ 
		    if($keytype==1){$where.=" and a.title like '%$keyword%'";
//	        }elseif($keytype==2){$where.=" and c.typeName ='%$keyword%'";
			}elseif($keytype==3){$where.=" and a.inputer like '%$keyword%'";
			}elseif($keytype==0){$where.='';}		   
		}
		$status    = KS_S('status',3);	
		$exam_type = null !==GF('exam_type') ? GF('exam_type'):0;	
		if($status ==0 || $status ==2 ){$where.=' and a.status='.$status;}
		if($exam_type!=0){$where.=' and a.exam_type='.$exam_type;}
;
		$where=" as a left join $CategoryModel->table as b on a.categoryid = b.categoryid  $where";
		$options = $this->AppModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$paper   = $this->AppModel->getPage($page,'a.paperid desc',$where);

//		var_dump($paper);
		include  CURR_VIEW_PATH . "index.php";
	}
	//上架
	public function  upAction(){
		$now_page       = ChkClng(KS_S('p',1));
		$paperid        = ChkClng(KS_G('get.id'));
		$Data['is_open'] = 1;
		$this->AppModel->update($Data,'paperid='.$paperid);
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		$model = new \Kesion\Model\App\ExamModel();
		$model->getPaperDetail($paperid,true);
		KS_INFO('',0,$url);
    }
	//下架
	public function  downAction(){
		$now_page       = ChkClng(KS_S('p',1));
		$paperid        = ChkClng(KS_G('get.id'));
		$Data['is_open'] = 0;
		$this->AppModel->update($Data,'paperid='.$paperid);
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		$model = new \Kesion\Model\App\ExamModel();
		$model->getPaperDetail($paperid,true);
		KS_INFO('',0,$url);
    }
	//进入试卷添加
	public function paperAddAction(){
	 	$setting 		= appSetting($this->wxid,$this->appid);//获取App配置
		$papertypeModel = M('app_paper_type');
		$papertype      = $papertypeModel->getAll('where wxid ='.$this->wxid.' and isdisplay = 1 order by orderid','id,typeName');
		$paperScoreRank = M('app_paper_scorerank');
		$ScoreRank      = $paperScoreRank->getAll('where wxid ='.$this->wxid);
		$Linkage  		= Linkage(array());//联动
		$Linkage -> cachename  = 'appcategory';//读出缓存
		$Linkage -> wxid       = $this->wxid;//读出缓存
		$Linkage -> inputname  = 'categoryid';
		//课程
		$courseid=null !==GF('courseid') ? GF('courseid'):0;
		$bappid = null !==GF('bappid') ? GF('bappid'):0;
		$value['courseid']=$courseid;
		$value['chapterid']=0;
		$value['bappid']=$bappid;
		$value['wxid']=$this->wxid;
        $value['categoryid']=0;
        $courseModel = M('app_course');
        $course = $courseModel->getAll('where wxid ='.$this->wxid,'courseid,title,chaptertable');
        if(!empty($course)){
        	$chapterTable = isset($course[0]['chaptertable']) ? $course[0]['chaptertable'] : 'app_course_chapter';
        	$chapterModel = M($chapterTable);
        	$chapter      = $chapterModel->getAll('where courseid ='.$course[0]['courseid'].' order by root,orderid');  
        }
		$Intro     = ks_editor('Intro','','1',editorNum(),'100%','150px');

		include  CURR_VIEW_PATH . "paper_add.php";
	}
	public function addKpointAction(){
		$paperid=ChkClng(KS_G("get.id"));
		setcookie("addKption", time() - 3600);
		$kpointModel = new CourseModel('app_knowledge');
		$where = 'where wxid='.$this->wxid;
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		if(!empty($keyword)){$where.=" and title like '%$keyword%'";}
		$kpoints = null !==GF('kpoint') ? GF('kpoint'):0;
		$kpoints = str_replace("|",",",$kpoints);
		 
		$where  .= " and not id in($kpoints)";
		
		$options = $kpointModel->getOptions('10',$where);
		$page    = Page($options);
		$values  = $kpointModel->getPage($page,'id desc',$where);
		include  CURR_VIEW_PATH . "addKpoint.php";
	}
	//进入编辑
	public function editPaperAction(){
		$setting  = appSetting($this->wxid,$this->appid);//获取App配置
		$paperid  = ChkClng(KS_G('get.id'));
		$paper    = $this->AppModel->getRow('where paperid='.$paperid.'  limit 1 ');
	
		$papertypeModel = M('app_paper_type');
		$papertype      = $papertypeModel->getAll('where wxid ='.$this->wxid.' and isdisplay = 1 order by orderid','id,typeName');
		$paperScoreRank = M('app_paper_scorerank');
		$ScoreRank      = $paperScoreRank->getAll('where wxid ='.$this->wxid);
		$Linkage = Linkage(array());//联动
        $Linkage -> cachename  = 'appcategory';//读出缓存
		$Linkage -> wxid       = $this->wxid;//读出缓存
		$Linkage -> inputname  = 'categoryid';
	    $Linkage -> categoryid = $paper['categoryid'];
		$kpointModel = new CourseModel('app_knowledge');
		if($paper['kpoint']!=''){$kpoint = $kpointModel->getAll("where id in ($paper[kpoint])");}
		$tmtyModel = M('app_paper_tmtype');
		$tmty      = $tmtyModel->getAll('where paperid='.$paperid.' order by orderId');
        $now_page  = ChkClng(KS_S('p',1));
	    $setting1  = getPaperSetting(0,$paper['setting']);//考试心得
	    $setting2  = getPaperSetting(1,$paper['setting']);//允许保存答案
        $courseid  = null !==GF('courseid') ? GF('courseid'):0;
		$bappid    = null !==GF('bappid') ? GF('bappid'):0;
		
		$value['courseid']   = $paper['courseid'];
		$value['chapterid']  = 0;
		$value['bappid']     = $bappid;
		$value['wxid']       = $this->wxid;
        $value['categoryid'] = $paper['categoryid'];
        $Intro     = ks_editor('Intro',$paper['Intro'],'1',editorNum(),'100%','150px');
        // var_dump($tmty);
	    include  CURR_VIEW_PATH . "paper_add.php";
	}
	//进行试卷添加
	public function doAddPaperAction(){
//		 $ary = $_POST;
//		 var_dump($ary);exit();
		$courseid = null !==GF('courseid') ? GF('courseid'):0;
		$bappid   = null !==GF('bappid') ? GF('bappid'):0;
		if($bappid!=0){
			$url = M_URL('course/Index','exam',$courseid,GP('appid-'.$bappid));
		    $Data['courseid']   = $courseid;
		    $courseModel        = M('app_course');
		    $courseCategory     = $courseModel->getOne('categoryid','where courseid ='.$courseid);  
		    $Data['categoryid'] = $courseCategory;
		}else{
			$Data['courseid']   = ChkClng(KS_G('post.courseid'));
			$Data['categoryid'] = ChkClng(KS_G('post.categoryid'));
			$url=M_URL($this->AppName.'/Index','index','',GP(''));
		}
		$Data['wxid']         = $this->wxid;
		$Data['userid']       = $this->userid;
		$Data['chargetype']   = ChkClng(KS_G("post.chargetype"));
		$Data['price_market'] = ChkSQL(KS_G("post.price_market"));
		$Data['price']        = ChkSQL(KS_G("post.price"));
		$Data['Status']       = ChkSQL(KS_G("post.status"));
         // var_dump(floatval($Data['price']));exit();
		$Data['chapterid']    = ChkClng(KS_G('post.chapterid'));
		$Data['Title']        = ChkSQL(KS_G("post.Title"));
		$Data['rankid']        = ChkSQL(KS_G("post.rankid"));
		$Data['scoreout']        = ChkSQL(KS_G("post.scoreout"));
		$Data['paperType']    = ChkClng(KS_G('post.paperType'));
		$Data['exam_time']     = ChkClng(KS_G('post.exam_time'));
		$Data['ExamScore']    = ChkClng(KS_G('post.ExamScore'));
		$Data['AnswerNum']    = ChkClng(KS_G('post.AnswerNum'));
		$Data['exam_type']    = ChkClng(KS_G('post.exam_type'));
		$kpoint         = ChkSQL(KS_G("post.kpoint"));
		if(!empty($kpoint)){
			$Data['kpoint'] = implode(',',$kpoint);
		}
		$Data['ExamTimeLimit'] = ChkClng(KS_G('post.ExamTimeLimit'));
		if($Data['ExamTimeLimit']==1){
			$begin = strtr(KS_G('post.ExamBeginTime'),'/','-');
			$end   = strtr(KS_G('post.ExamEndTime'),'/','-');
			$Data['ExamBeginTime'] = ChkClng(strtotime($begin));
			$Data['ExamEndTime']   = ChkClng(strtotime($end));
		}
		$Data['Intro']      = ChkSQL(KS_G("post.Intro"));
		$Data['adddate']    = time();
		$Data['inputer']    = ChkSQL($this->userinfo['username']);
		$Data['paper_level'] = ChkClng(KS_G('post.paper_level'));
		$Rule['Title']      = '试卷名称|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);
		if($Data['chargetype']==1){
            if(empty($Data['price'])||floatval($Data['price'])==0||!preg_match('/^[0-9]+(.[0-9]{1,2})?$/',$Data['price'])){
            	// exit;
            	KS_INFO('价格不合格',0,'','',1);exit;
            }
            if(empty($Data['price_market'])||floatval($Data['price_market'])==0||!preg_match('/^[0-9]+(.[0-9]{1,2})?$/',$Data['price_market'])){
            	// exit;
            	KS_INFO('划线价格不合格',0,'','',1);exit;
            }
		}
		$tktype  =  ChkSQL(KS_G("post.tkType"));
		if(count($tktype)==0){KS_INFO('请添加题型',0,'','',1);exit;}
		if($Data['exam_type'] ==2){
			$tumary = ChkSQL(KS_G("post.tmadd"));
			foreach ($tumary as $key => $value) {
				if(empty($value)){
					KS_INFO('题目不能为空，请完善',0,'','',1);exit;
				}
			}
		}
		if($Data['scoreout']==1){
			foreach($tktype as $k =>$v){
				if($v==2||$v==5||$v==4){
					KS_INFO('包含了不可批改题型',0,'','',1);exit;
				}
			}
		}
		//判断分值
		$TkScore =  ChkSQL(KS_G("post.TkScore"));
		foreach($TkScore as $k =>$v){
			if($v<=0){
				KS_INFO('分值需大于0',0,'','',1);exit;
			}
		}
		$paperid=$this->AppModel->doadd($Data,'paperid');
		$Data1['paperid'] = $paperid;
		$Data1['wxid']    = $this->wxid;
		$tmtyModel        = M('app_paper_tmtype');
		$TkNum   =  ChkSQL(KS_G("post.TkNum"));
		$sunscore =0;//用来计算总分
		
		if($Data['exam_type'] ==1){
			$tkModel = M('app_paper_tk');//题库表
		    foreach($tktype as $k =>$v){
		    	$tksid = 0;
		    	$Data1['tktype']  = $v;
		    	$Data1['orderId'] = $k;
		    	$Data1['score']   = $TkScore[$k];
		    	$Data1['number']  = $TkNum[$k];
		    	$sunscore+=$TkNum[$k]*$TkScore[$k];
		    	$tks = $tkModel->getAll(" where tktype = $v ORDER BY RAND() LIMIT $TkNum[$k]",'tkid,tktype,options,anser,analysis');
		    	foreach ($tks as $key => $value) {
		    		$tksid .= ','.$value['tkid'];
		    	}
		    	if($v==1){
		    		$Data1['title']='选择题';
		    	}elseif($v==2){
		    		$Data1['title']='填空题';
		    	}elseif($v==3){
		    		$Data1['title']='判断题';
		    	}elseif($v==4){
		    		$Data1['title']='问答题';
		    	}elseif($v==5){
		    		$Data1['title']='材料题';
		    	}elseif($v==6){
		    		$Data1['title']='多选题';
		    	}
		    	$Data1['tkIds'] = $tksid ;
		    	$tmtyModel->doAdd($Data1,'typeId');
		    }
		    $Datachenji['sumscore'] = $sunscore;
		    $this->AppModel->update($Datachenji,'paperid='.$paperid);	
		}else{
			$TmTk  =  ChkSQL(KS_G("post.tmadd"));

			foreach($tktype as $k =>$v){
		    	$Data1['tktype']  = $v;
		    	$Data1['score']   = $TkScore[$k];
		    	$Data1['orderId'] = $k;
		    	if($v==1){$Data1['title']='选择题';}elseif($v==2){$Data1['title']='填空题';}elseif($v==3){$Data1['title']='判断题';}elseif($v==4){$Data1['title']='问答题';}elseif($v==5){$Data1['title']='材料题';}elseif($v==6){$Data1['title']='多选题';}
		    	$tks              = $TmTk[$k];
		    	$aa               = explode('|',$tks);
		    	$Data1['number']  = count($aa)-1;
		    	$sunscore+=$Data1['number']*$Data1['score'];
		    	$Data1['tkIds']   = implode(',',$aa);
		    	$tmtyModel->doAdd($Data1,'typeId');
		    }
		    $Datachenji['sumscore'] = $sunscore;
		    $this->AppModel->update($Datachenji,'paperid='.$paperid);
		}
		KS_INFO("",3,$url);
	}
	//进行试卷修改
	public function doEditPaperAction(){
		$setting   = appSetting($this->wxid,$this->appid);//获取App配置
		$now_page  = ChkClng(KS_S('p',1));
		$paperid   = ChkClng(KS_G('get.id'));
		$Data['chargetype']   = ChkClng(KS_G("post.chargetype"));
		$Data['price_market'] = ChkSQL(KS_G("post.price_market"));
		$Data['price']        = ChkSQL(KS_G("post.price"));
		$Data['Status']       = ChkSQL(KS_G("post.status"));
		// var_dump($Data['Status']);exit();
		$Data['chapterid']  = ChkClng(KS_G('post.chapterid'));
		$Data['Title']      = ChkSQL(KS_G("post.Title"));
		$Data['rankid']        = ChkSQL(KS_G("post.rankid"));
		$Data['paperType']  = ChkClng(KS_G('post.paperType'));
		$Data['exam_time']   = ChkClng(KS_G('post.exam_time'));
		// $Data['ExamScore']  = ChkClng(KS_G('post.ExamScore'));
		// $Data['AnswerNum']  = ChkClng(KS_G('post.AnswerNum'));
		$Data['ExamTimeLimit'] = ChkClng(KS_G('post.ExamTimeLimit'));
		if($Data['ExamTimeLimit']==1){
			$begin = strtr(KS_G('post.ExamBeginTime'),'/','-');
			$end   = strtr(KS_G('post.ExamEndTime'),'/','-');
			$Data['ExamBeginTime'] = ChkClng(strtotime($begin));
			$Data['ExamEndTime'] =ChkClng(strtotime($end));
		}
		$Data['Intro']      = ChkSQL(KS_G("post.Intro"));
		$Data['inputer']    = ChkSQL($this->userinfo['username']);
		$Data['paper_level'] = ChkClng(KS_G('post.paper_level'));
		
		$Rule['Title']      = '试卷名称|isEmpty';
		// $Rule['categoryid'] = '分类|isEmpty';
		// $Rule['courseid']   = '课程类别|isEmpty';
		// $Rule['ExamScore']  = '总分|isEmpty,isnumber';
		// $Rule['AnswerNum']  = '答题次数|isEmpty,isnumber';
		Chkpost($Data,$Rule,$this->AppModel);
		if($Data['chargetype']==1){
            if(empty($Data['price'])||floatval($Data['price'])==0||!preg_match('/^[0-9]+(.[0-9]{1,2})?$/',$Data['price'])){
            	// exit;
            	KS_INFO('价格不合格',0,'','',1);exit;
            }
            if(empty($Data['price_market'])||floatval($Data['price_market'])==0||!preg_match('/^[0-9]+(.[0-9]{1,2})?$/',$Data['price_market'])){
            	// exit;
            	KS_INFO('划线价格不合格',0,'','',1);exit;
            }
		}
		$tmtyModel = M('app_paper_tmtype');
		$Data['exam_type']  = ChkClng(KS_G('post.exam_type'));
		$Data1['paperid']   = $paperid;
		$Data1['wxid']      = $this->wxid;
		$tmtyModel = M('app_paper_tmtype');
		$tktype    =  ChkSQL(KS_G("post.tkType"));
		if(count($tktype)==0){KS_INFO('请添加题型',6,'','',1);exit;}
		if($Data['exam_type'] ==2){
			$TmTk = ChkSQL(KS_G("post.tmadd"));
			foreach ($TmTk as $key => $value) {
				if(empty($value)){
					KS_INFO('题目不能为空，请完善',6,'','',1);exit;
				}
			}
		}else{
			$TkNum    =  ChkSQL(KS_G("post.TkNum"));
			foreach ($tumary as $key => $value) {
				if(!$value){
					KS_INFO('题目不能为空，请完善',6,'','',1);exit;
				}
			}
		}
		//判断分值
		$TkScore =  ChkSQL(KS_G("post.TkScore"));
		foreach($TkScore as $k =>$v){
			if($v<=0){
				KS_INFO('分值需大于0',6,'','',1);exit;
			}
		}
		
		// $TkScore  =  ChkSQL(KS_G("post.TkScore"));
		$Data['scoreout']  = ChkClng(KS_G('post.scoreout'));
		$sunscore =0;//用来计算总分
		if($Data['scoreout']==1){
			foreach($tktype as $k =>$v){
				if($v==2||$v==5||$v==4){
					KS_INFO('包含了不可批改题型',6,'','',1);exit;
				}
			}
		}
		//删除题型
		$tmtyModel->delete(' paperid='.$paperid);
		if($Data['exam_type'] ==1){
		    $tkModel = M('app_paper_tk');//题库表
		    foreach($tktype as $k =>$v){
		    	$tksid = 0;
		    	$Data1['tktype']  = $v;
		    	$Data1['orderId'] = $k;
		    	$Data1['score']   = $TkScore[$k];
		    	$Data1['number']  = $TkNum[$k];
		    	$sunscore+=$TkNum[$k]*$TkScore[$k];
		    	$tks = $tkModel->getAll(" where tktype = $v ORDER BY RAND() LIMIT $TkNum[$k]",'tkid,tktype,options,anser,analysis');
		    	foreach ($tks as $key => $value) {
		    		$tksid .= ','.$value['tkid'];
		    	}
		    	if($v==1){
		    		$Data1['title']='选择题';
		    	}elseif($v==2){
		    		$Data1['title']='填空题';
		    	}elseif($v==3){
		    		$Data1['title']='判断题';
		    	}elseif($v==4){
		    		$Data1['title']='问答题';
		    	}elseif($v==5){
		    		$Data1['title']='材料题';
		    	}elseif($v==6){
		    		$Data1['title']='多选题';
		    	}
		    	$Data1['tkIds'] = $tksid ;
		    	$tmtyModel->doAdd($Data1,'typeId');
		    }
		    $Datachenji['sumscore'] = $sunscore;
		    $this->AppModel->update($Datachenji,'paperid='.$paperid);
		    
		}else{
			  // $TmTk=  ChkSQL(KS_G("post.tmadd"));
			  // var_dump($TmTk);
			 foreach($tktype as $k =>$v){
		    	$Data1['tktype']=$v;
		    	$Data1['score']=$TkScore[$k];
		    	$tks=$TmTk[$k];
		    		$Data1['orderId']=$k;
		    	$aa=explode('|',$tks);
		    
		    	$Data1['number']=count($aa)-1;
		    	$sunscore+=$Data1['score']*$Data1['number'];
		    	$Data1['tkIds']=implode(',',$aa);
		    	if($v==1){$Data1['title']='选择题';}elseif($v==2){$Data1['title']='填空题';}elseif($v==3){$Data1['title']='判断题';}elseif($v==4){$Data1['title']='问答题';}elseif($v==5){$Data1['title']='材料题';}elseif($v==6){$Data1['title']='多选题';}
		    	$tmtyModel->doAdd($Data1,'typeId');
		   }
		   $Datachenji['sumscore'] = $sunscore;
		    $this->AppModel->update($Datachenji,'paperid='.$paperid);
		}
		$courseid = null !==GF('courseid') ? GF('courseid'):'0';
		$bappid=null !==GF('bappid') ? GF('bappid'):0;
		if($bappid!=0){
		    $url = M_URL('course/Index','exam',$courseid,GP('appid-'.$bappid));
		  	$Data['courseid']   = $courseid;
	        $courseModel        = M('app_course');
	        $courseCategory     = $courseModel->getOne('categoryid','where courseid ='.$courseid.' limit 1');  
	        $Data['categoryid'] = $courseCategory;
		}else{
			$Data['courseid']   = ChkClng(KS_G('post.courseid'));
			$Data['categoryid'] = ChkClng(KS_G('post.categoryid'));
			$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		}
		$this->AppModel->update($Data,'paperid='.$paperid);
		KS_INFO("更新成功",3,$url);
	}
	//进行删除
	public function delPaperAction(){
		$id       = KS_G('get.id');
		$now_page = ChkClng(KS_S('p',1));
		$model_Exam = new \Kesion\Model\App\ExamModel();
		$model_Exam->del($id,1);
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
	    KS_INFO('删除成功',0,$url);
	}  
	//批量处理
	public function batchAction(){
		$paperid = ChkSQL(KS_G('paperid'));
	
		if(empty($paperid)){KS_INFO('请选择',0,'','',1);}
		$now_page = ChkClng(KS_S('p',1));
		
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		$model_Exam = new \Kesion\Model\App\ExamModel();
			foreach($paperid as $k=>$v){
				$id = ChkClng($v);
				$model_Exam->del($id,1);
			}
			KS_INFO('删除成功',0,$url);
		
	}
	//题库批量处理
	public function batchTkAction(){
		$tkid = ChkSQL(KS_G('tkid'));
		if(empty($tkid)){KS_INFO('请选择',0,'','',1);}
		$now_page = ChkClng(KS_S('p',1));
		$batch       = ChkClng(KS_G('post.batch')); 
		$url = M_URL($this->AppName.'/Index','TkIndex','',GP('p-'.$now_page));
		 if($batch ==1){
		 	$tkModel = M('app_paper_tk');
			foreach($tkid as $k=>$v){
				    $id = ChkClng($v);
				    $tkModel->delete("tkid=$v");    
			}
			KS_INFO('删除成功',0,$url);
		}
	}
	//进入试卷类型管理
	public function paperTypeAction(){
		$setting = appSetting($this->wxid,$this->appid);//获取App配置
		$papertypeModel = M('app_paper_type');
		$where = ' where wxid ='.$this->wxid;
		
		$keyword = KS_S('keyword');
		$keytype = null !==GF('keytype') ? GF('keytype'):0;
		$disable = null !==GF('disable') ? GF('disable'):2;
		
		if($disable !=2){
			$where.= '  and isdisplay='.$disable;
		}
		
	    if(!empty($keyword)){ 
			    if($keytype==1){
			          $where.=" and typeName like '%$keyword%'";
		        } 
		}		
		$options = $papertypeModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$paper   = $papertypeModel->getPage($page,'orderid asc',$where);
		include  CURR_VIEW_PATH . "papertype_index.php";
	}
	//进入添加试卷类型
	public function typeAddAction(){
		$setting = appSetting($this->wxid,$this->appid);//获取App配置
		include  CURR_VIEW_PATH . "papertype_add.php";
	}
	//进入试卷类型编辑
	public function edittypeAction(){
		$setting = appSetting($this->wxid,$this->appid);//获取App配置
		$id = ChkClng(KS_G('get.id'));
		$papertypeModel = M('app_paper_type');
		if($id){
			$papertype = $papertypeModel->getRow('where id = '.$id.' limit 1');
		}	
		include  CURR_VIEW_PATH . "papertype_add.php";	
	}
	
    //进行添加试卷类型
	public function dotypeAddAction(){
		$papertypeModel    = M('app_paper_type');
		$Data['wxid']      = $this->wxid;
		$Data['typeName']  = ChkSQL(KS_G('post.typeName'));
		$Data['isdisplay'] = ChkClng(KS_G('post.isdisplay'));
		$Data['intro']     = ChkSQL(KS_G('post.intro'));
		$Data['orderid']     =$papertypeModel->getMaxValue('orderid','  wxid='.$this->wxid)+1;
		
		$Rule['typeName']  = '试卷名称|isEmpty';
		Chkpost($Data,$Rule,$papertypeModel);
		$papertypeModel->doAdd($Data,'id');
		$url1 = M_URL($this->AppName.'/Index','paperType','',GP(''));
		KS_INFO("添加成功",0,$url1);
	}
	//进行编辑试卷类型
	public function doEditPaperTypeAction(){
		$papertypeModel    = M('app_paper_type');
		$id                = KS_G('get.id');
		$Data['typeName']  = ChkSQL(KS_G('post.typeName'));
		$Data['isdisplay'] = ChkClng(KS_G('post.isdisplay'));
		$Data['intro']     = ChkSQL(KS_G('post.intro'));
		$Rule['typeName']  = '试卷名称|isEmpty';
		Chkpost($Data,$Rule,$papertypeModel);
		$papertypeModel->update($Data,'id='.$id);
		$url1=M_URL($this->AppName.'/Index','paperType','',GP(''));
		KS_INFO("更新成功",0,$url1);
	}
	//进行删除
	public function delPaperTypeAction(){
		$papertypeModel = M('app_paper_type');
		$id = KS_G('get.id');
		$orderId  = $papertypeModel->getOne('orderid','where id ='.$id.' limit 1');
		$Data['orderid'] = 'orderid-1';
		$papertypeModel->update($Data,'wxid='.$this->wxid.' and orderid>'.$orderId,1);
		$papertypeModel->delete('id='.$id);
		$url1=M_URL($this->AppName.'/Index','paperType','',GP(''));
	    KS_INFO("删除成功",0,$url1);
	}
	//上移
	public function updatetypeAction(){
		$id  = ChkClng(KS_G('get.id'));	
		$papertypeModel = M('app_paper_type');
		$orderId  = $papertypeModel->getOne('orderid','where id ='.$id.' limit 1');
		$url1=M_URL($this->AppName.'/Index','paperType','',GP(''));
		if(!empty($orderId)){
			$typeid2  = $papertypeModel->getOne('id','where orderid = '.($orderId-1).' and wxid='.$this->wxid);
			if($typeid2){
				$Data2['orderid'] = $orderId;
				$Data['orderid']  = $orderId-1;
				$papertypeModel->update($Data2,'id ='.$typeid2);
				$papertypeModel->update($Data,'id ='.$id);
				
				KS_INFO("移动成功",0,$url1);
			}else{
                $url1=M_URL($this->AppName.'/Index','paperType','',GP(''));
		        KS_INFO("移动失败",0,$url1,'',1);
			}
		}else{
            $url1=M_URL($this->AppName.'/Index','paperType','',GP(''));
		    KS_INFO("移动失败",0,$url1,'',1);
		}
	}
	//下移
	public function downtypeAction(){
		$id  = ChkClng(KS_G('get.id'));	
		$papertypeModel = M('app_paper_type');
		$orderId  = $papertypeModel->getOne('orderid','where id ='.$id.' limit 1');
		if(!empty($orderId)){
		    $typeid2  = $papertypeModel->getOne('id','where orderid = '.($orderId+1).' and wxid='.$this->wxid);
			if(!empty($typeid2)){
				$Data2['orderid'] = 'orderid+1';
				$Data['orderid']  = $orderId;
				$papertypeModel->update($Data,'id ='.$typeid2);
				$papertypeModel->update($Data2,'id ='.$id,1);
				$url1=M_URL($this->AppName.'/Index','paperType','',GP(''));
				KS_INFO("移动成功",0,$url1);
             }else{
			    $url1=M_URL($this->AppName.'/Index','paperType','',GP(''));
		    	KS_INFO("移动失败",0,$url1,'',1);
			 }
		}else{
		    $url1=M_URL($this->AppName.'/Index','paperType','',GP(''));
			KS_INFO("移动失败",0,$url1,'',1);
		}
	}
	//进行试卷类型批量处理
	public function batchPapertypeAction(){
		$id       = ChkSQL(KS_G('id'));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$now_page = ChkClng(KS_S('p',1));
		$batch    = ChkClng(KS_G('post.batch')); 
		$url      = M_URL($this->AppName.'/Index','paperType','',GP('p-'.$now_page));
		if($batch ==1){
		 	$papertypeModel = M('app_paper_type');
			foreach($id as $k=>$v){
				$orderId  = $papertypeModel->getOne('orderid','where id ='.ChkClng($v).' limit 1');
				$Data['orderid'] = 'orderid-1';
				$papertypeModel->update($Data,'wxid='.$this->wxid.' and orderid>'.$orderId,1);
				$id = ChkClng($v);$papertypeModel->delete("id=$v");
			}
			KS_INFO('删除成功',0,$url);
		}
	}
	//进入分数等级设置
	public function scoreRankAction(){
		$setting = appSetting($this->wxid,$this->appid);//获取App配置
		$paperScoreRank = M('app_paper_scorerank');
		$ScoreRank=$paperScoreRank -> getAll('where wxid = '.$this->wxid);
		include  CURR_VIEW_PATH . "paperScoreRank_index.php";
	}
	//进入等级增加,编辑
	public function addScoreRankAction(){
		$setting = appSetting($this->wxid,$this->appid);//获取App配置
		include  CURR_VIEW_PATH . "paperScoreRank_add.php";
	}
	//进入分数编辑
	public function editScoreRankAction(){
		$setting = appSetting($this->wxid,$this->appid);//获取App配置
	    $id      = ChkClng(KS_G('get.id'));
	    $paperScoreRank     = M('app_paper_scorerank');
	    $paperScoreRankItem = M('app_paper_scorerank_item');
	    $ScoreRank = $paperScoreRank->getRow('where rankid = '.$id.' limit 1');
	    $ScoreRankItem = $paperScoreRankItem->getAll('where rankid ='. $id);
		include  CURR_VIEW_PATH . "paperScoreRank_add.php";
	}
	//进行等级增加
	public function doAddScoreRankAction(){
		$setting = appSetting($this->wxid,$this->appid);//获取App配置
		$paperScoreRank      = M('app_paper_scorerank');
		$paperScoreRankItem  = M('app_paper_scorerank_item');
		$Data['title']       = ChkSQL(KS_G('post.title'));
		$Data['isDefault']   = ChkClng(KS_G('post.isdisplay'));
	//  $Data['orderid']     = $paperScoreRank->getMaxValue('orderid')+1;
	//	$Data['orderId']    = ChkClng(KS_G('post.orderId'));
		$Data['wxid']       = ChkClng($this->wxid);
		$rankid             = $paperScoreRank->doAdd($Data,'rankid');
		$itemTitle = ChkSQL(KS_G('post.itemTitle'));
		$minscore  = ChkSQL(KS_G('post.minscore'));
		$maxscore  = ChkSQL(KS_G('post.maxscore'));;
		$score     = ChkSQL(KS_G('post.score'));
//		$itemOrderId = ChkSQL(KS_G('post.itemOrderId'));
		foreach($itemTitle as $k=>$v){
			  $Data[$k]['itemTitle']   = $v;
			  $Data[$k]['minscore']    = $minscore[$k];
			  $Data[$k]['maxscore']    = $maxscore[$k];
			  $Data[$k]['score']       = $score[$k];
//			  $Data[$k]['itemOrderId'] = $itemOrderId[$k];
			  $Data[$k]['rankid']      = $rankid;
			  $paperScoreRankItem->doAdd($Data[$k],'itemId');
		}
		$url1=M_URL($this->AppName.'/Index','scoreRank','',GP(''));
		KS_INFO("添加成功",0,$url1);
	}
	//进行等级修改
	public function doEditScoreRankAction(){
		$paperScoreRank     = M('app_paper_scorerank');
		$paperScoreRankItem = M('app_paper_scorerank_item');
		$rankid             = ChkSQL(KS_G('get.id'));
		$Data['title']      = ChkSQL(KS_G('post.title'));
		$Data['isDefault']  = ChkClng(KS_G('post.isdisplay'));
		$Data['orderId']    = ChkClng(KS_G('post.orderId'));
		$paperScoreRank->update($Data,'rankid ='.$rankid);
		$itemTitle = ChkSQL(KS_G('post.itemTitle'));
		$minscore  = ChkSQL(KS_G('post.minscore'));
		$maxscore  = ChkSQL(KS_G('post.maxscore'));
		$score     = ChkSQL(KS_G('post.score'));
		$itemId    = ChkSQL(KS_G('post.itemId'));
		$itemOrderId=$_POST['itemOrderId'];
		foreach($itemId as $k=>$v){
			  $Data[$k]['itemTitle'] = $itemTitle[$k];
			  $Data[$k]['minscore']  = $minscore[$k];
			  $Data[$k]['maxscore']  = $maxscore[$k];
			  $Data[$k]['score']     = $score[$k];
			  $Data[$k]['itemOrderId'] = $itemOrderId[$k];
			  $Data[$k]['rankid']    = $rankid;
			  $paperScoreRankItem->update($Data[$k],'itemId='.$v);
		 }
		$url1=M_URL($this->AppName.'/Index','scoreRank','',GP(''));
		KS_INFO("更新成功",0,$url1); 
	}
	//进行分数等级删除
	public function delScoreRankRankAction(){
		$id = KS_G('get.id');
		$paperScoreRank = M('app_paper_scorerank');
		$paperScoreRankItem = M('app_paper_scorerank_item');
		$paperScoreRank->delete('rankid='.$id);
		$paperScoreRankItem->delete('rankid='.$id);
		$url1=M_URL($this->AppName.'/Index','scoreRank','',GP(''));
		KS_INFO("删除成功",0,$url1);
	}
	//进入题库管理
	public function TkIndexAction(){
		$tkModel       = M('app_paper_tk');
		$CategoryModel = new CategoryModel('app_category');
		$courseModel   = new CourseModel('app_course');
		$papertypeModel= M('app_paper_type');
		$papertype     = $papertypeModel->getAll('where wxid ='.$this->wxid);
		$category      = $this->cache->GetHCache('appcategory',$this->wxid);//取出缓存
		$where         = 'where a.wxid ='.$this->wxid;
		$setting = appSetting($this->wxid,$this->appid);//获取App配置
		//分类
	    $categoryid    = null !==GF('categoryid') ? GF('categoryid'):0;
		if($categoryid!=0) {
			 $where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";
		}	
		//类型
		$papertypeid=null !==GF('papertypeid') ? GF('papertypeid'):0;
		if($papertypeid!=0) {
		    $where .= '  and a.paperTypeId='.$papertypeid;
		}	
		//关键字
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype=null !==GF('keytype') ? GF('keytype'):0;
		$tktype=null !==GF('tktype') ? GF('tktype'):0;
		if($tktype!=0){$where.=' and a.tktype ='.$tktype;}
		if(!empty($keyword)){ 
			 if($keytype==1){$where.=" and a.options like '%$keyword%'";}
		}	
		$where="as a left join  $CategoryModel->table as b on a.categoryid = b.categoryid $where ";
		//分页
		$options = $tkModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$tk      = $tkModel->getPage($page,'a.tkid desc',$where);
		//课程名
		include  CURR_VIEW_PATH . "tk_index.php";
	}
	//进入题库增加
	public function addTkAction(){
		$setting        = appSetting($this->wxid,$this->appid);//获取App配置
		$courseid       = null !==GF('courseid') ? GF('courseid'):0;
		$tkid           = ChkClng(KS_G('request.id'));
		$papertypeModel = M('app_paper_type');
	    $papertype      = $papertypeModel->getAll('where wxid = '.$this->wxid.' and isdisplay = 1 order by orderid','id,typeName');
		$paperScoreRank = M('app_paper_scorerank');
		$ScoreRank      = $paperScoreRank->getAll('where wxid ='.$this->wxid);
		$courseModel    = M('app_course');
        $course = $courseModel->getAll('where wxid ='.$this->wxid,'courseid,title,chaptertable');
        if(!empty($course)){
        	$chapterTable = isset($course[0]['chaptertable']) ? $course[0]['chaptertable'] : 'app_course_chapter';
        	$chapterModel = M($chapterTable);
        	$chapter      = $chapterModel->getAll('where courseid ='.$course[0]['courseid'].' order by root,orderid');

        }
	    $Linkage        = Linkage(array());
	    $Linkage -> cachename  = 'appcategory';//读出缓存
		$Linkage -> wxid       = $this->wxid;//读出缓存
	    $Linkage ->inputname   = 'categoryid';

	    $courseid=null !==GF('courseid') ? GF('courseid'):0;
		$bappid = null !==GF('bappid') ? GF('bappid'):0;
	    
	    $value['courseid']=$courseid;
		$value['chapterid']=0;
		$value['bappid']=$bappid;
		$value['wxid']=$this->wxid;
        $value['categoryid']=0;
	    $stem1     = ks_editor('stem1','','1',editorNum(),'100%');
		$stem2     = ks_editor('stem2','','1',editorNum(),'100%','150px');
		$analysis2 = ks_editor('analysis2','','1',editorNum(),'100%','150px');
		$stem3     = ks_editor('stem3','','1',editorNum(),'100%','150px');
		$stem4     = ks_editor('stem4','','1',editorNum(),'100%','150px');
		$stem5     = ks_editor('stem5','','1',editorNum(),'100%','150px');
		$stem7     = ks_editor('stem7','','1',editorNum(),'100%','150px');
		include  CURR_VIEW_PATH . "tk_add.php";	
	}
	//题库进行增加
	public function doAddTkAction(){
		$courseid    = null !==GF('courseid') ? GF('courseid'):0;
		$bappid     = null !==GF('bappid') ? GF('bappid'):0;
		if($bappid !=0){
			$courseModel = M('app_course');
			$categotyid  = $courseModel->getOne('categoryid',' where courseid ='.$courseid.' limit 1');
			$Data['categoryid'] = $categotyid;
			$Data['courseid']   = $courseid;
			$url = M_URL('course/Index','Tkindex','',GP('appid-'.$bappid ));
		}else{
			$Data['chapterid']  = ChkClng(KS_G('post.chapterid'));
		    $Data['categoryid'] = ChkClng(KS_G('post.categoryid'));
		    $Data['courseid']   = ChkClng(KS_G('post.courseid'));
			$url=M_URL('exam/Index','TkIndex','',GP(''));
		}
		$tkModel            = M('app_paper_tk');
		//知识点
//		$kpoint = ChkSQL(KS_G("post.kpoint"));
//		$Data['kpoint'] = implode(',',$kpoint);
		$Data['tktype']     = ChkClng(KS_G('post.tkType'));
		$Data['userid']     = $this->userid;
		$Data['wxid']       = $this->wxid;
		$Data['level']      = ChkClng(KS_G('post.level'));
		$Data['paperTypeId']= ChkClng(KS_G('post.paperTypeId'));
		$Data['inputer']    = $this->userinfo['name'];
		$Data['isvideo']    = ChkClng(KS_G('post.audio'));
		if($Data['isvideo'] == 1){$Data['uploads'] = ChkClng(KS_G('post.uploads'));}
		if($Data['tktype'] == 1){//选择题
			$stem1            = ChkSQL(KS_G('post.stem1'));
			$select           = ChkSQL(KS_G('post.select1'));
			$select           = implode("|$|", $select);
			$Data['options']  = $stem1.'$$$'.$select;
			$Data['anser']    = ChkSQL(KS_G('post.anser1'));
		}elseif($Data['tktype'] == 2){//填空题
			$Data['options']  = ChkSQL(strip_tags(KS_G('post.stem2')));
			$Data['anser']    = ChkSQL(KS_G('post.anser2'));
			$Data['analysis'] = ChkSQL(KS_G('post.analysis2'));
		}elseif($Data['tktype'] == 3){//判断题
			$Data['options']  = ChkSQL(KS_G('post.stem3'));
			$Data['anser']    = ChkSQL(KS_G('post.anser3'));
			$Data['analysis'] = ChkSQL(KS_G('post.analysis3'));
		}elseif($Data['tktype'] ==4){//问答题
			$Data['options']  = ChkSQL(KS_G('post.stem4'));
			$anser            =  ChkSQL(KS_G('post.anser4'));
			$keyword          = ChkSQL(KS_G('post.keyword'));
			$Data['anser']    = $anser.'$$$'.$keyword;
			$Data['analysis'] = ChkSQL(KS_G('post.analysis4'));
		}elseif($Data['tktype'] ==5){//材料题
			$options5         = ChkSQL(KS_G('post.options5'));
			$stem5            = ChkSQL(KS_G('post.stem5'));
			$anser5           = ChkSQL(KS_G('post.anser5'));
			$options5         = implode("|$|", $options5);
			$Data['options']  =  $stem5.'$$$'.$options5;
			$Data['anser']    = implode("|$|", $anser5);
		}elseif($Data['tktype'] == 6){//多选题
			$stem7            = ChkSQL(KS_G('post.stem7'));
			$select           = ChkSQL(KS_G('post.select2'));
			$select           = implode("|$|", $select); 
			$anser            = ChkSQL(KS_G('post.answer7'));
			$Data['anser']    =  implode(",", $anser);
			$Data['options']  = $stem7.'$$$'.$select;
		}
		var_dump($Data);die;
		$Rule['options']      = '题目|isEmpty';
		$Rule['anser']        = '答案|isEmpty';
		Chkpost($Data,$Rule,$tkModel);
		$tkModel->doAdd($Data,'tkid');
		KS_INFO("添加成功",3,$url);
	}
	//题库的删除
	public function delTkAction(){
		$now_page = ChkClng(KS_S('p',1));
		$tkModel  = M('app_paper_tk');
		$tkid     = ChkClng(KS_G('get.id'));
		$tkModel->delete('tkid='.$tkid);
		$url = M_URL($this->AppName.'/Index','TkIndex','',GP('p-'.$now_page));
	    ks_header($url);
	}
	//进入编辑页面
	public function editTkAction(){
		$setting    = appSetting($this->wxid,$this->appid);//获取App配置
		$now_page   = ChkClng(KS_S('p',1));
		$tkModel    = M('app_paper_tk');
		$tkid       = ChkClng(KS_G('get.id'));
		$tk         = $tkModel->getRow('where tkid='.$tkid.' limit 1');
		$courseid   = null !==GF('courseid') ? GF('courseid'):0;
		$bappid     = null !==GF('bappid') ? GF('bappid'):0;
		//分类课程联动
		$Linkage  = Linkage(array());
		$Linkage  -> cachename  = 'appcategory';//读出缓存
		$Linkage  -> wxid       = $this->wxid;//读出缓存
		$Linkage  ->inputname   = 'categoryid';
		$Linkage  ->categoryid  = $tk['categoryid'];
		$value['courseid']      = $tk['courseid'];
		$value['chapterid']     = $tk['chapterid'];
		$value['bappid']        = $bappid;
		$value['wxid']          = $this->wxid;
        $value['categoryid']    = $tk['categoryid'];
        $stem1     = ks_editor('stem1','','1',editorNum(),'100%','150px');
		$stem2     = ks_editor('stem2','','1',editorNum(),'100%','150px');
		$analysis2 = ks_editor('analysis2','','1',editorNum(),'100%','150px');
		$stem3     = ks_editor('stem3','','1',editorNum(),'100%','150px');
		$stem4     = ks_editor('stem4','','1',editorNum(),'100%','150px');
		$stem5     = ks_editor('stem5','','1',editorNum(),'100%','150px');
		$stem7     = ks_editor('stem7','','1',editorNum(),'100%','150px');
		//知识点
		$kpointModel = new CourseModel('app_knowledge');
		if($tk['kpoint']!=''){
			$kpoint = $kpointModel->getAll("where id in ($tk[kpoint])");
		}
		//课程
		if(!empty($tk['courseid'])){//章节 
			$courseModel  = M('app_course'); 
			$course       = $courseModel->getAll('where courseid='.$tk['courseid'],'courseid,title');
			$chaptertable = $courseModel->getOne('chaptertable','where courseid = '.$tk['courseid'].' limit 1');
			if(!empty($chaptertable)){
				$chapterModel = M($chaptertable);
				$chapter      = $chapterModel->getAll('where courseid = '.$tk['courseid'],'chapterid,title,depth');//类型
			}
		}
		$papertypeModel   = M('app_paper_type');
		$papertype        = $papertypeModel->getAll('where wxid ='.$this->wxid);
		if($tk['tktype'] == 1){
			$stem1     = explode('$$$',$tk['options']);
			$stem      = $stem1[0];
			$select    = $stem1[1];
			$select    = explode('|$|',$select);
			$anser1    = $tk['anser'];
			$stem1     = ks_editor('stem1',$stem,'1',editorNum());
			// var_dump($stem1);
		}elseif($tk['tktype'] == 2){
			$stem2     = $tk['options'];
			$anser2    = $tk['anser'];
			$analysis2 = $tk['analysis'];
			$stem2     = ks_editor('stem2',$stem2,'1',editorNum());
		}elseif($tk['tktype'] == 3){
			$stem3     = $tk['options'];
			$anser3    = $tk['anser'];
			$analysis3 = $tk['analysis'];
			$stem3     = ks_editor('stem3',$stem3,'1',editorNum());
		}elseif($tk['tktype'] == 4){
			$stem4     = $tk['options'];
			$anser     = explode('$$$', $tk['anser']);
			$anser4    = $anser[0];
			$ketword   = isset($anser[1]) ? $anser[1] : "";
			$analysis4 = $tk['analysis'];
			$stem4     = ks_editor('stem4',$stem4,'1',editorNum());
		}elseif($tk['tktype'] == 5){
			$option5   = explode('$$$',$tk['options']);
			$stem5     = $option5[0];
			$stem5     = ks_editor('stem5',$stem5,'1',editorNum());
			$option    = explode('|$|',$option5[1]);
			$selt1     = count($option);
			$anser5    =  explode('|$|',$tk['anser']);
		}elseif($tk['tktype'] == 6){
			$stem7     = explode('$$$',$tk['options']);
			$stem      = $stem7[0];
			$select7   = $stem7[1];
			$select7   = explode('|$|',$select7);
			$selt      = count($select7); 
			$anser7    = explode(',',$tk['anser']);
			$stem7     = ks_editor('stem7',$stem,'1',editorNum());
		}
		include  CURR_VIEW_PATH . "tk_add.php";	
	}
	//进行编辑
	public function doeditTkAction(){
		$bappid      = null !==GF('bappid') ? GF('bappid'):0;
		$courseid    = null !==GF('courseid') ? GF('courseid'):0;
		$now_page    =  ChkClng(KS_S('p',1));
		if($bappid !=0){
			$url=M_URL('course/Index','Tkindex','',GP('appid-'.$bappid ));
		}else{
			$Data['chapterid']  = ChkClng(KS_G('post.chapterid'));
		    $Data['categoryid'] = ChkClng(KS_G('post.categoryid'));
		    $Data['courseid']   = ChkClng(KS_G('post.courseid'));
			$url=M_URL('exam/Index','TkIndex','',GP('p-'.$now_page));
		}
		//知识点
		$kpoint          = ChkSQL(KS_G("post.kpoint"));
		$Data['kpoint']  = implode(',',$kpoint);
		$tkModel         = M('app_paper_tk');
		$tkid            = ChkClng(KS_G('get.id'));
		$Data['tktype']     = ChkClng(KS_G('post.tkType'));
		$Data['level']      = ChkClng(KS_G('post.level'));
		if($Data['tktype']  == 1){
			$stem1            = ChkSQL(KS_G('post.stem1'));
			$select           = ChkSQL(KS_G('post.select1'));
			$select           =  implode("|$|", $select); 
			$Data['options']  = $stem1.'$$$'.$select;
			$Data['anser']    = ChkSQL(KS_G('post.anser1'));		
		}elseif($Data['tktype'] == 2){
			$Data['options']  = ChkSQL(strip_tags(KS_G('post.stem2')));
			$Data['anser']    = ChkSQL(KS_G('post.anser2'));
			$Data['analysis'] = ChkSQL(KS_G('post.analysis2'));
		}elseif($Data['tktype'] == 3){
			$Data['options']  = ChkSQL(KS_G('post.stem3'));
			$Data['anser']    = ChkSQL(KS_G('post.anser3'));
			$Data['analysis'] = ChkSQL(KS_G('post.analysis3'));	
		}elseif($Data['tktype'] ==4){
			$Data['options']  = ChkSQL(KS_G('post.stem4'));
			$anser            = ChkSQL(KS_G('post.anser4'));
			$keyword          = ChkSQL(KS_G('post.keyword'));
			$Data['anser']    = $anser.'$$$'.$keyword;
			$Data['analysis'] = ChkSQL(KS_G('post.analysis4'));
		}elseif($Data['tktype'] == 5){
		    $options5         = ChkSQL(KS_G('post.options5'));
		    $options5         = implode("|$|", $options5); 
		    $stem5            = ChkSQL(KS_G('post.stem5'));
		    $Data['options']  = $stem5.'$$$'.$options5;
		    $anser5           = ChkSQL(KS_G('post.anser5'));
		    $Data['anser']    = implode("|$|", $anser5);	  	
		}elseif($Data['tktype'] == 6){
			$stem7           = ChkSQL(KS_G('post.stem7'));
			$select          = ChkSQL(KS_G('post.select2'));
			$select          = implode("|$|", $select); 
			$anser           = ChkSQL(KS_G('post.answer7'));
			$Data['anser']   = implode(",", $anser);
			$Data['options'] = $stem7.'$$$'.$select;
		}
		$tkModel->update($Data,'tkid='.$tkid);
		KS_INFO("保存成功",0,$url);
	}
	//进入制作试卷
	public function paperAddTkAction(){
		$paperid     = ChkClng(KS_G('get.id'));
		$paper   = $this->AppModel->getRow('where paperid = '.$paperid .' limit 1');
		$tmTypeModel = M('app_paper_tmtype');
		$tmType      = $tmTypeModel->getAll('where paperid = '.$paperid.' order by orderId');
		if($paper['exam_type']==1){
			include  CURR_VIEW_PATH . "paper_addTk2.php";	
		}else{
			include  CURR_VIEW_PATH . "paper_addTk1.php";	
		}
    }
	//添加题型
	public function addTmtypeAction(){
		$paperid         = ChkClng(KS_G('get.id'));
		$tmTypeModel     = M('app_paper_tmtype');
		$orderid         = $tmTypeModel -> getMaxValue('orderId','paperid ='.$paperid);
		$Data['orderId'] = $orderid+1;
		$Data['wxid']    = $this->wxid;
		$Data['userid']  = $this->userid;
		$Data['paperid'] = $paperid;
		$Data['tktype']  = ChkClng(KS_G('post.tktype'));
		$Data['score']   = ChkClng(KS_G('post.score'));
		$Data['title']   = ChkSQL(KS_G('post.title'));
		$Data['score']   = ChkClng(KS_G('post.score'));
		$level           = KS_G('post.level');
		if(!empty($level)){
			$Data['level'] = ChkClng($level);
		}
		$papertype       = KS_G('post.papertype');
		if(!empty($papertype)){
			$Data['papertypeid'] = ChkClng($papertype);
		}
		$number         = KS_G('post.number');
		if(!empty($number)){
			$Data['number'] = ChkClng($number);
			$Rule['number'] = '每题分数|isEmpty,isnumber';
		}
		$Data['intro'] = ChkSQL(KS_G('post.intro'));
		$Data['isRnd'] = 0;
		$Rule['score'] = '每题分数|isEmpty,isnumber';
		Chkpost($Data,$Rule,$tmTypeModel);
		$tmTypeModel->doAdd($Data,'typeId');
		$url1 = M_URL($this->AppName.'/Index','paperAddTk',$paperid,GP(''));
		KS_INFO("添加成功",0,$url1);
	}
	//删除题型
	public function delTmtypeAction(){
		$typeid      = ChkClng(KS_G('get.id'));
		$tmTypeModel = M('App/PaperModel/app_paper_tmtype');
		$tmType      = $tmTypeModel->getRow('where typeId = '.$typeid);
		$tmTypeModel->updateOrderid($tmType);//排在之后的 Orderid -1
		$tmTypeModel->delete('typeId='.$typeid);
		$paperid     = null !==GF('paperid') ? GF('paperid'):'';
		$url1        = M_URL($this->AppName.'/Index','paperAddTk',$paperid,GP(''));
		KS_INFO("删除成功",0,$url1);
	}
	public function tmtypeBatchAction(){
		$paperid     = ChkClng(KS_G('get.id'));
		$title       = ChkSQL(KS_G('post.title'));
		$score       = ChkSQL(KS_G('post.score'));
		$number      = ChkSQL(KS_G('post.number'));
		$id          = ChkSQL(KS_G('post.id'));
		$tmTypeModel = M('app_paper_tmtype');
		$exam_type   = $this->AppModel->getOne('exam_type','where paperid ='.$paperid.' limit 1');
		foreach($id as $k=>$v){
			if($exam_type ==1){$Data['number'] = $number[$k];}
			$Data['title'] = $title[$k];
			$Data['score'] = $score[$k];
		    $tmTypeModel->update($Data,'typeId ='.$v);
	    }
		$url1=M_URL($this->AppName.'/Index','paperAddTk',$paperid,GP(''));
	    KS_INFO("保存成功",0,$url1);
	}
	//题型排序上升
    public function upOrderidAction(){
		$typeid   = ChkClng(KS_G('get.id'));
		$paperid  = null !==GF('paperid') ? GF('paperid'):'0';
		$tmTypeModel = M('app_paper_tmtype');
		$orderId  = $tmTypeModel->getOne('orderId','where typeId ='.$typeid);
		$typeid2  = $tmTypeModel->getOne('typeId','where orderId = '.($orderId-1).' and paperid = '.$paperid);
		$Data2['orderId'] = $orderId;
		$Data['orderId']  = $orderId-1;
		$tmTypeModel->update($Data,'typeId ='.$typeid);
		$tmTypeModel->update($Data2,'typeId ='.$typeid2);
		$url1 = M_URL($this->AppName.'/Index','paperAddTk',$paperid,GP(''));
		$html = "<script>location.href='".$url1."';</script>";
		echo $html;exit;  
	}
	//排序下降
	public function downOrderidAction(){
		$typeid      = ChkClng(KS_G('get.id'));
		$paperid     = null !==GF('paperid') ? GF('paperid'):'0';
		$tmTypeModel = M('app_paper_tmtype');
		$orderId     = $tmTypeModel->getOne('orderId','where typeId ='.$typeid);
		$typeid2     = $tmTypeModel->getOne('typeId','where orderId ='.($orderId+1).' and paperid = '.$paperid);
		$Data2['orderId'] = $orderId;
		$Data['orderId']  = $orderId+1;
		$tmTypeModel->update($Data,'typeId ='.$typeid);
		$tmTypeModel->update($Data2,'typeId ='.$typeid2);
		$url1 = M_URL($this->AppName.'/Index','paperAddTk',$paperid,GP(''));
		$html = "<script>location.href='".$url1."';</script>";
	    echo $html;exit;  
	}
	//进入试卷添加试题
	public function tkListAction(){
		$typeid      = ChkClng(KS_G('get.id'));
		$tmTypeModel = M('app_paper_tmtype');
		$tmType      = $tmTypeModel->getRow('where typeId = '.$typeid.' limit 1');
		//对应试卷
		$paper       = $this->AppModel->getRow('where paperid ='.$tmType['paperid'].' limit 1');
		$courseid    = $paper['courseid'];
		$courseid    = null !==GF('courseid') ? GF('courseid'): $courseid;
		//课程
		$courseModel = M('app_course');
		$course      = $courseModel -> getAll('where wxid ='.$this->wxid);
		$tkModel     = M('app_paper_tk');
		$papertypeModel = M('app_paper_type');
		$papertype   = $papertypeModel->getAll('where wxid ='.$this->wxid);
		$selectTk    = explode(',',$tmType['tkIds']);
		if(empty(cookie('selectTk'))){cookie("selectTk",$tmType['tkIds'],3600);}
		//对应章节
		$tktype      = null !==GF('tktype') ? GF('tktype'):'0';
		$tklevel     = null !==GF('tklevel') ? GF('tklevel'):'0';
		$papertypeid = null !==GF('papertypeid') ? GF('papertypeid'):'0';
		$keyword     = KS_S('keyword');
		$where       = '';
		$where      .=' where wxid = '.$this->wxid;
	    if(!empty($tktype)){$where.='  and tktype = '.$tktype;}
		if(!empty($tklevel)){$where.=' and level = '.$tklevel;}
		if($courseid !=0 ){$where.=' and courseid = '.$courseid;}
		if(!empty($papertypeid)){$where.='  and paperTypeId = '.$papertypeid;}
		if(!empty($keyword)){
		$where.=" and options like '%$keyword%'";}
		/*if($paper['courseid']!=0){
			$courseWhere= " a.courseid = $paper[courseid]";
			$courseModel= new CourseModel('app_course');
		    $chaptertable = $courseModel->getOne('chaptertable',"where courseid = $paper[courseid] limit 1");
		}else{
			$courseWhere= " 1=1 ";
			$chaptertable='app_course_chapter';
		}
		$chapterModel = M($chaptertable);
		$where1 ="as a left join $chapterModel->table as b on a.chapterid = b.chapterid where $courseWhere and (a.chapterid = $paper[chapterid] or b.parentidpath like '%$paper[chapterid],%') $where";*/
		$options    = $tkModel->getOptions('5',$where);//分页参数设置
		$page       = Page($options);
		$tk         = $tkModel->getPage($page,'tkId desc',$where,'*');
		include  CURR_VIEW_PATH . "tk_list.php";	
	}
	//试卷添加试题
	public function dopaperAddTkAction(){
		$typeid        = ChkClng(KS_G('get.id'));
		$tkid          = ChkSQL(KS_G('post.tkid'));
		$tmTypeModel   = M('app_paper_tmtype');
		$Data['tkIds'] = cookie('selectTk');
		$tmTypeModel->update($Data,'typeId='.$typeid);
		$paperid       = $tmTypeModel->getOne('paperid','where typeId='.$typeid);
		$url2          = M_URL($this->AppName.'/Index','paperAddTk',$paperid,GP(''));
		KS_INFO('',3,$url2);
	}
	//试卷预览
	public function previewAction(){
	   $setting = appSetting($this->wxid,$this->appid);//获取App配置
	   $appid          = $this->appid;
	   $papertypeModel = M('app_paper_type');
	   $tmTypeModel    = M('app_paper_tmtype');
	   $paperid        = KS_G('get.id');
	   $paper =$this->AppModel->getRow(' where paperid ='.$paperid.' limit 1');
       $tmtype         = $tmTypeModel->getAll('where paperid = '.$paperid.' order by orderId');
	   $tkModel        = M('app_paper_tk');
	   $tks            = '';
	   foreach($tmtype as $k=>$v){
	   	   if($paper['exam_type']==1){
	   	       $ids  = $tkModel->getAll('where wxid='.$this->wxid.' and tktype='.$v['tktype'].'   ORDER BY RAND()  limit '.$v['number'],'tkid');
	   	       $ids  = array_column($ids,'tkid');
	   	       $tkid = implode(',',$ids);
	   	       $tmtype[$k]['tkIds'] = $tkid;
	   	       $tks  = $tkid.','.$tks;
	       }else{
	       	   if(!empty($v['tkIds'])){
	       	   		$tks=$v["tkIds"].','.$tks;
	       	   }
	       }	
	   }
	   $tks = str_replace(',,',',',$tks);
	   $tks = rtrim($tks,','); 
	   $tks = ltrim($tks,','); 
	   if(!empty($tks)){$tk = $tkModel->getAll('where tkid in ( '.$tks.' )');
	   }else{
	   	    $now_page = ChkClng(KS_S('p',1));
	        $url1=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		    KS_INFO("没有题目",0,$url1,'',1);
	   }
	   include  CURR_VIEW_PATH . "previewPaper.php";	
	}
	//进入execl导入界面
	public function execlAction(){
	    include  CURR_VIEW_PATH . "execl.php";
	}
	//上传音频
	public function videouploadAction(){
		$this->upload->savePath  = 'school/'.$this->wxid.'/'; // 设置附件上传（子）目录
		$this->upload->subName   = 'tk'; //子目录创建方式，采用数组或者字符串方式定义
		$this->upload->saveName  = KS_MD5($this->wxid);
		$this->upload->replace   = true;
		// 上传文件
		//var_dump($this->upload->maxSize);exit;
		$this->upload->maxSize   =     31457280;
		$this->upload->exts      =     array('mp3');// 设置附件上传类型
		$info = $this->upload->upload();
		header ( "Content-Type:text/html; charset=utf-8" );
		if(!$info) {echo 'error:'.$this->upload->getError();}// 上传错误提示错误信息
		else{echo json_encode(ChkSQL($this->upload->uootPath.$info['file']['savepath'].$info['file']['savename']));exit;}// 上传成功
	}
	//查看考试情况
	public function PaperSitAction(){
		$paperid      = ChkClng(KS_G('get.id'));
		$answerModel  = M('app_paper_answer');
		$where        = ' where status=1 and type =1 and wxid='.$this->wxid.' and paperid = '.$paperid;
		$keyword = KS_S('keyword');
		$keytype = null !==GF('keytype') ? GF('keytype'):0;
	    if(!empty($keyword)){ 
			    if($keytype==1){
			          $where.=" and memberName like '%$keyword%'";
		        }	   
		}		
		$options      = $answerModel->getOptions('10',$where);//分页参数设置
		$page         = Page($options);
		$record       = $answerModel->getPage($page,'adddate desc',$where);
		include  CURR_VIEW_PATH . "paper_record.php";	
	}
	//批量操作考试记录
	public function batchRecordAction(){
		$paperid      = ChkClng(KS_G('get.id'));
		$id = ChkSQL(KS_G('recoredid'));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$now_page = ChkClng(KS_S('p',1));
		$batch       = ChkClng(KS_G('post.batch')); 
		$url = M_URL($this->AppName.'/Index','PaperSit',$paperid,GP('p-'.$now_page));
		 if($batch ==1){
		 	$recordModel = M('app_paper_answer');
			foreach($id as $k=>$v){
				    $id = ChkClng($v);
				    $recordModel->delete("id=$v");    
			}
			KS_INFO('删除成功',0,$url);
		}
	}
	//成绩导出
	public function scoreexcelAction(){
		$paperid     = ChkClng(KS_G('get.id'));
		$paperModel  = M('app_paper');
		$paper       = $paperModel -> getRow('where paperid ='.$paperid.' limit 1');
		$xlsName     = $paper['Title'].'成绩';//文件名
		$textRun     = $xlsName;//表名
		$answerModel = M('app_paper_answer');
		$where       = ' where status=1 and type =1 and wxid='.$this->wxid.' and paperid = '.$paperid.' and iscorrect =1';
		$answer      = $answerModel->getAll($where);
		foreach($answer as $k=>$v){$answer[$k]['number'] = $k+1;}
		//var_dump();exit;
		$xlsCell  = array(
			array('number','序号'),
			array('memberName','学生姓名'),
			array('score','分数'),
		);
		exportExcel($xlsName,$xlsCell,$answer,$textRun);
		include  CURR_VIEW_PATH . "paper_correcting.php";
	}
	//进入批改
    public function CorrectingAction(){
		$id          = ChkClng(KS_G('get.id'));
		$answerModel = M('app_paper_answer');
		$answer      = $answerModel->getRow('where id ='.$id.' limit 1');
		$tkModel     = M('app_paper_tk');
		$tks         = $tkModel->getAll("where tkid in ($answer[tkids])");
		$where       = 'where paperid = '.$answer['paperid'];
		$tmTypeModel = M('app_paper_tmtype');
        $tmtype      = $tmTypeModel->getAll('where paperid = '.$answer['paperid'].' order by orderId');
		$result      = testSkin02($tmtype);
		include  CURR_VIEW_PATH . "paper_correcting.php"; 	 
	}
	//进行批改
	public function doCorrectionAction(){
		$paperid           = null !==GF('paperid') ? GF('paperid'):'0';
		$id                = ChkClng(KS_G('get.id'));
		$Data['score']     = ChkSQL(KS_G('post.score'));
		$Data['iscorrect'] = 1;
		$answerModel       = M('app_paper_answer');
		$answerModel->update($Data,'id ='.$id);
		$url1 = M_URL($this->AppName.'/Index','PaperSit',$paperid,GP(''));
		KS_INFO('批改完成',3,$url1);
	}
	//进入excel导入
	public function excelindexAction(){
		include  CURR_VIEW_PATH . "excelindex.php";
	}
	//进行导入
	public function beathaddTkAction(){
		if(!empty($_FILES['execl']['tmp_name'])){
				$this->upload->savePath = 'school/'.$this->wxid.'/excel/'; // 设置附件上传（子）目录
				$this->upload->exts =array('xls','xlsx','csv');// 设置附件上传类型
				$info = $this->upload->uploadOne($_FILES['execl']);
				if(!$info) {KS_INFO($this->upload->getError(),'','',1);}//上传错误提示错误信息
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
		 $url = M_URL($this->AppName.'/Index','TkIndex','',GP(''));
		 KS_INFO('添加成功',3,$url);
	}	
	//进入导入试卷模板
	public function paperwordAction(){	
		 include  CURR_VIEW_PATH . "paperword.php";
	}
	//进行试卷导入
	public function dopaperwordAction(){
		if(!empty($_FILES['word']['tmp_name'])){
				$this->upload->savePath = 'school/'.$this->wxid.'/excel/'; // 设置附件上传（子）目录
				$this->upload->exts =array('docx');// 设置附件上传类型
				$info = $this->upload->uploadOne($_FILES['word']);
				if(!$info) {// 上传错误提示错误信息
					KS_INFO($this->upload->getError(),0,'','',1);
				}else{
					$word = ChkSQL($this->upload->rootPath.$info['savepath'].$info['savename']);//应用封面图片
				}
		}else{
			    KS_INFO('请选择文件',4,'','',1);
		}
		$wordphp = new \Core\Wordphp();
		$text    = $wordphp->readDocument($word);
	    $text    = strip_tags($text);
        $text = preg_replace('/\s/', '', $text);
		$paper   = explode('[PaperNameEnd]',$text);
		//插入paper表
		$paperModel      = M('app_paper');
		$Data['Title']   = trim($paper[0]);
		$Data['exam_type'] = 2;
		$Data['userid']  = $this->userid;
		$Data['wxid']    = $this->wxid;
		$Data['inputer'] = $this->userinfo['username'];
		
		$paper1 = explode('[DifficultyEnd]',$paper[1]);
		$level = $paper1[0];//试卷等级
		
		if($level=='简单'){$level=1;}elseif($level=='一般'){$level=2;}elseif($level=='困难'){$level=3;}else{$level=1;}
		$Data['paper_level'] = $level;
		$paperid = $paperModel->doAdd($Data,'paperid');  
		//插入题型表
		
		$tmtypeModel = M('app_paper_tmtype');
		$tkModel     = M('app_paper_tk');
		$tmtype      = explode('[TypeEnd]',$paper1[1]);
		foreach($tmtype as $k=>$v){
			$tks     = array();
			$tm      = explode('[TypeNameEnd]',$v);
			$tmtitle = explode('[tktype]',$tm[0]);
			$Data1['title']   = preg_replace('/#/', '', trim($tmtitle[0]));
			$scoreary = explode('##',$tmtitle[0]);
			$Data1['score']   = ChkClng($scoreary[1]);
			$Data1['tktype']  = trim($tmtitle[1]);
			$Data1['paperid'] = $paperid;
			$Data1['orderId'] = $k+1;
			$Data1['userid']  = $this->userid;
			$Data1['wxid']    = $this->wxid;
			//题目
//			var_dump($Data1);exit;
			$tk = explode('[end]',$tm[1]);
			$Data1['number'] = count($tk);
            array_pop($tk); 
			foreach($tk as $kt=>$vt){
				$Data2['userid'] = $this->userid;
				$Data2['wxid'] = $this->wxid;
				$Data2['level'] = $level;
				$Data2['inputer'] = $this->userinfo['username'];
				$vt =  preg_replace('/\s/', '', $vt);//去掉空格	
				if($Data1['tktype']=="1"||$Data1['tktype']=="6"){
					$Data2['tktype'] =  $Data1['tktype'];
					$tktm = explode('【答案】',$vt);
					$options = trim($tktm[0]);
	    			$options = preg_replace("/A、/","$$$",$options);
	    			$Data2['options'] =trim(preg_replace("/[A-H]、/","|$|",$options));
	    			$anser = explode('【解析】',$tktm[1]);
	    			$Data2['anser']=trim($anser[0]);
	    			$Data2['analysis'] = trim($anser[1]);
					$tkid = $tkModel->doAdd($Data2,'tkid');
					array_push($tks,$tkid); 
				}elseif($Data1['tktype']=="2"){
					$Data2['tktype'] =  $Data1['tktype'];
					$timu = explode('【答案】', $vt);
	    			// var_dump($timu);
	    			$options = trim($timu[0]);
	    			$Data2['options'] =trim(preg_replace("/_{5,9}/","{#answer}",$options));
	    			$anser = explode('【解析】',$timu[1]);
	    			$Data2['anser']=trim($anser[0]);
	    			$Data2['analysis'] = trim($anser[1]);
					$tkid = $tkModel->doAdd($Data2,'tkid');
					array_push($tks,$tkid);
				}elseif($Data1['tktype']=="4"){//问答题
					$Data2['tktype'] =  $Data1['tktype'];
					$timu = explode('【答案】', $vt);

	    			$Data2['options'] =trim($timu[0]);
	    			$anser = explode('【解析】',$timu[1]);
	    			// var_dump($anser[0]);
	    			$Data2['anser'] = str_replace("【关键词】","$$$",$anser[0]);
	    			$Data2['analysis'] = trim($anser[1]); 
					$tkid = $tkModel->doAdd($Data2,'tkid');
					array_push($tks,$tkid);            
				}elseif($Data1['tktype']=="3"){//判断题
					$Data2['tktype'] =  $Data1['tktype'];
					$timu = explode('【答案】', $vt);
	    			$Data2['options'] =trim($timu[0]);
	    			$anser = explode('【解析】',$timu[1]);
	    			if(trim($anser[0])=='正确'){
	    				$Data2['anser']=1;
	    			}else{
	    				$Data2['anser']=0;
	    			}
	    			$Data2['analysis'] = trim($anser[1]); 
					$tkid = $tkModel->doAdd($Data2,'tkid');
					array_push($tks,$tkid);            
				} 
//				var_dump($Data2);
			}
            $Data1['tkIds'] ='0,'.implode(',',$tks);
			$tmtypeModel -> doAdd($Data1,'typeId');
		}
		$url=M_URL($this->AppName.'/Index','index','',GP(''));
        KS_INFO('添加成功',3,$url);		
	}
	//111
	public function trainingEverydayAction(){
		$keyword = KS_S('keyword');
		$keytype = ChkClng(KS_S('keytype'));
		$courseid     = ChkClng(KS_G('get.id'));
        $ks_app_paper_tk = M('app_paper_tk');
        $where='';
        $where.= ' where wxid='.$this->wxid.' and userid ='.$this->userid.' and courseid ='.$courseid;
        if($keytype==1){
			$where.="  and  inputer like '%".$keyword."%'";
		}elseif($keytype==2){
			$where.="  and  kpoint like '%".$keyword."%'";
		}
		//$where= ' where wxid='.$this->wxid.' and userid ='.$this->userid.' and courseid ='.$courseid.'  order by rand() limit '.$num;
	    //var_dump($courseid);exit;
        $options = $ks_app_paper_tk->getOptions('2',$where);//分页参数设置
	    $page = Page($options);
	    $values = $ks_app_paper_tk->getPage($page,'adddate desc',$where,' options,inputer,courseid,kpoint,level,tkid');
	    $values=isset($values) ? $values:[];
        include  CURR_VIEW_PATH . "trainingEveryday.php";
    }
	public function showTrainingEverydayAction(){
		$setting = appSetting($this->wxid,$this->appid);//获取App配置
		$app_course = M('app_course');
		$keyword = KS_S('keyword');
		$keytype = ChkClng(KS_S('keytype'));
		$where='';
		$where.= ' where a.wxid='.$this->wxid.' and a.userid ='.$this->userid.' and a.status =2';
		$line = "as a left join ks_common_user_teacher as b on a.teacherid = b.userid ";
		if($keytype==1){
			$where.="  and  a.title like '%".$keyword."%'";
		}elseif($keytype==2){
			$where.="  and  b.name like '%".$keyword."%'";
		}
        $options = $app_course->getOptions('15',$line.$where);//分页参数设置
	    $page = Page($options);
	    $values = $app_course->getPage($page,'a.adddate desc',$line.$where,' a.title,a.adddate,a.courseid,b.name,b.sex,b.tel');
	    $values=isset($values) ? $values:[];
	    include  CURR_VIEW_PATH . "showTrainingEveryday.php";
	}
	//挑选每日一练题目
	public function filterTrainingEverydayAction(){
        $app_training_everyday = M('app_training_everyday');
		$Data['adddate'] =date("Ymd",time());
		$Data['courseid'] = ChkClng(KS_G('post.courseid'));
		$Data['userid'] = $this->userid;
		$Data['wxid'] = $this->wxid;
		$Data['courseid'] =878;
		$where ='where wxid = '.$this->wxid.' and  adddate ='.$Data['adddate'].' and courseid = '.$Data['courseid'];
        $value = $app_training_everyday -> getOne(' count(*)',$where);
     	if($value ==1){
     	 	$id = $app_training_everyday -> getOne(' id',$where);
     	 	$app_training_everyday->delete(' id ='.$id);
        }
        $Data['tkids']     = ChkSQL(KS_G('post.tkids'));
        $Data['courseid'] =878;
        $Data['userid'] = $this->userid;
		$Data['wxid'] = $this->wxid;
        $tt = $app_training_everyday->doAdd($Data,'id');
        if($tt){echo "操作成功";}else{echo "操作失败";}
    }
    //批量生成课程每日一练
    public function bathTrainingEverydayAction(){
	    $num = ChkClng(KS_G('post.num'));
	    $app_training_everyday = M('app_training_everyday');
	 	$app_paper_tk    = M('app_paper_tk');
	 	$Data['adddate'] = date("Ymd",time());
	 	$Data['userid']  = $this->userid;
		$Data['wxid']    = $this->wxid;
	 	$courseids       = ChkSQL(KS_G('post.courseid'));
	 	$recycleVal      = 0;
	 	foreach($courseids as $k=>$v){
		    $Data['courseid'] = $v;
		 	$where ='where wxid = '.$this->wxid.' and  adddate ='.$Data['adddate'].' and courseid = '.$v;
		    $value = $app_training_everyday -> getOne(' count(*)',$where);
	        //如果今天已选，删除
	     	if($value ==1){
	     	 	$id = $app_training_everyday -> getOne(' id',$where);
	     	 	$app_training_everyday->delete(' id ='.$id);
	        }
		    $line = ' where wxid='.$this->wxid.' and userid ='.$this->userid.' and courseid = '.$v.'  order by rand() limit '.$num;
		    $tkidArray = $app_paper_tk -> getAll($line,' tkid');
		    $aa='';$tt =1;
		    foreach($tkidArray as $k=>$v){
		     	if($tt ==1){$aa.=$v['tkid'];
		     	}else{$aa.=','.$v['tkid'];}
		     	$tt++;
		    }
		    $Data['tkids'] = $aa;
		    $app_training_everyday->doAdd($Data,'id');
		    $recycleVal++;
	    }
	    $url1= M_URL($this->AppName.'/Index','showTrainingEveryday','',GP(''));
	    if($recycleVal ==count($courseids)){KS_INFO('批量生成成功',0,$url1);
	    }else{KS_INFO('批量生成完成，还有部分没成功，请手动',0,$url1,'',1);}
	}
    //显示所有每日一练记录
    public function showHistoryAction(){
	 	$keyword = KS_S('keyword');
		$keytype = ChkClng(KS_S('keytype'));
	 	$app_training_everyday = M('app_training_everyday');
	 	$courseid    = ChkClng(KS_G('get.id'));
	    $courseid = 878;
	 	$where='';
	 	$where.=' where wxid = '.$this->wxid.' and  userid ='.$this->userid.' and courseid = '.$courseid;
	    if($keytype==1){$where.="  and  adddate like '%".$keyword."%'";}
	    $options = $app_training_everyday->getOptions('1',$where);//分页参数设置
		$page    = Page($options);
		$values  = $app_training_everyday->getPage($page,'adddate desc',$where);
		$values=isset($values) ? $values:[];
	    include  CURR_VIEW_PATH . "showHistory.php";
	}
    //删除历史
	public function bathDelHistoryAction(){
		$ids = ChkSQL(KS_G('post.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$app_training_everyday = M('app_training_everyday');
	    $courseid    = ChkClng(KS_G('get.id'));
		foreach ($ids  as $id){$app_training_everyday->delete("id = $id");}
		$url=M_URL($this->AppName.'/Index','showHistory',$courseid,GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	//显示具体每一天
	public function showTrainingEverydayDetailAction(){
		$app_training_everyday = M('app_training_everyday');
		$id    = ChkClng(KS_G('get.id'));
	   	$where ='where wxid = '.$this->wxid.' and  id ='.$id.' limit 1';
	    $tkids = $app_training_everyday->getOne(' tkids',$where);
	    $app_paper_tk = M('app_paper_tk');
		$line ='where wxid = '.$this->wxid.' and tkid in ('.$tkids.')';
	    $options = $app_paper_tk->getOptions('1',$line);//分页参数设置
		$page = Page($options);
		$values = $app_paper_tk->getPage($page,'adddate desc',$line);
	    foreach($values as $k=>&$v){
			$allvalue[$k]=tkformat($v);
			$allvalue[$k]['answer']='';
		}
		$allvalue=isset($allvalue) ? $allvalue:[];
		include  CURR_VIEW_PATH . "showTrainingEverydayDetail.php";	
	}
	public function createExcelAction(){
	    $app_training_everyday = M('app_training_everyday');
		$id    = ChkClng(KS_G('get.id'));
	   	$where ='where wxid = '.$this->wxid.' and  id ='.$id.' limit 1';
	    $tkids = $app_training_everyday->getOne(' tkids',$where);
	    $app_paper_tk = M('app_paper_tk');
		$line ='where wxid = '.$this->wxid.' and tkid in ('.$tkids.')';
		$values = $app_paper_tk->getAll($line);
	    foreach($values as $k=>&$v){
			$allvalue[$k]=tkformat($v);
			$allvalue[$k]['answer']='';
		}
		foreach($allvalue as $k=>$v){$aa ='';
     	    foreach($v['select'] as $kt=>$vt){$aa .= $vt['xx'];}
	        $tt[$k]['answer']   = $v['answer'];
	        $tt[$k]['analysis'] = $v['analysis'];
	        $tt[$k]['option']   = strip_tags($v['option']);
	        $tt[$k]['choice']   = $aa;
        }
        $xlsName = date('Ymd').'每日一练';//文件名
		$textRun= '每日一练';//表名
		$xlsCell  = array(
			array('option','题目'),
			array('answer','答案'),
			array('analysis','分析'),
			array('choice','选项'),
		);
        exportExcel($xlsName,$xlsCell,$tt,$textRun);
	}
	//进入配置
	public function settingAction(){
	    $setting = getSet($this->wxid,$this->appid);//获取网站配置
		include  CURR_VIEW_PATH . "setting.php";
	}
	//考试应用配置
	public function doSettingAction(){
		$setting = getSet($this->wxid,$this->appid);//获取网站配置
		$setting[0] = ChkClng(KS_G('post.setting0'));//是否开启 
		$setting[1] = ChkClng(KS_G('post.setting1'));//课程是否需要审核
		$setting[2] = ChkClng(KS_G('post.setting2'));//是否开启分类
		$Data['setting'] = implode('|',$setting);
		$apprelateModel         = M('common_app_userrelate');
	    $apprelateModel->update($Data,'wxid='.$this->wxid.' and appid = '.$this->appid); 
		KS_INFO('保存成功',6);
	}
	//查看试卷的用户列表
	public function userPaperAction(){
		$paperid  = KS_G('get.id');;
		// var_dump($paperid);
		$status = ChkClng(KS_S('status',3));
		$keyword =  KS_S('keyword');
		$order =  ChkSQL(null !==GF('order') ? GF('order'):3);
		if($order==3){
          $orderby ='adddate desc';
		}elseif($order==1){
           $orderby ='scoreorder desc';
		}elseif($order==0){
           $orderby ='scoreorder asc';
		}
		$answerModel = M('app_paper_answer');
		$paperModel =M('app_paper');
		$paper =$paperModel->getRow(' where paperid='.$paperid.' limit 1');
		// var_dump($paper);
		$memberModel=M('common_user_member');
		$userModel =M('common_user');
		$where =' where paperid='.$paperid.' and status!=-1';
		if($status!=3){
			$where.=' and iscorrect='.$status;
		}
		if($keyword){
			$where.=' and memberName like "%'.$keyword.'%"';
		}
		$options = $answerModel->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$answer = $answerModel->getPage($page,$orderby,$where);
		foreach($answer as $k=>$v){
			$answer[$k]['memberInfo']=$memberModel->getRow('where userid='.$v['memberid'], 'Sex');
			$score = explode(',', $v['score']);
            array_shift($score);
			$answer[$k]['score']=array_sum($score);
		} 	
		$setting     = $this->cache->GetSubH('apprelate','appid',$this->appid,'subappid',0,'setting',$this->wxid);
        $setting = explode('※', $setting);
		include  CURR_VIEW_PATH . "userPaper.php";
	}
    //显示用户试卷
	public function batchPaperAction(){
		$type = ChkClng(KS_S('type',1));
		$id=ChkClng(KS_G('get.id'));
		$paperModel=M('app_paper');
		$answerModel = M('app_paper_answer');
		$paperanswers =$answerModel->getRow(' where id='.$id.' limit 1');
  	    $paper=$paperModel->getRow(' where paperid ='.$paperanswers['paperid'].' limit 1');
	  	$url = M_URL($this->AppName.'/Index','userPaper',$paperanswers['paperid'],GP(''));	
	  	if(empty($paperanswers['paperid'])){KS_INFO('无效试卷，请联系管理员',3,$url,'',1);}
	  	// $paper = $paperModel->getRow(' where paperid ='.$paperanswer['paperid']);
		if(!$paper){KS_INFO('无效试卷，请联系管理员',3,$url,'',1);}
		$tmTypeModel    = M('app_paper_tmtype');
		$tkModel        = M('app_paper_tk');
		$paperanswer=explode('↓◎↑',$paperanswers['answer']);
		$memberanswer=array();
	    $tmtype         = $tmTypeModel->getAll('where paperid = '.$paperanswers['paperid'].' order by orderId');
		foreach($paperanswer as $k=>$v){
		   
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
   		// var_dump($memberanswer);
   		$stuscoe   = explode(',',$paperanswers['score']);
   		array_shift($stuscoe);
	    include  CURR_VIEW_PATH . "seeMmeberpaper.php";	
	}
    
    //计算试卷总分
	public function reckonAction()
	{
		$id = ChkClng(KS_G('request.id'));
		$nowscore = ChkSQL(KS_G('post.score'));
		$tknum    = ChkSQL(KS_G('post.tknum'));
		$feel    = ChkSQL(KS_G('post.feel'));
		$scorestr=0;
		$errorstr=0;
		$sumscore = 0;
		$Model = M('app_paper_answer');
		$db_Model = M('app_paper');
		$info = $Model->getRow(' as a left JOIN '.$db_Model->table.' as b on a.paperid=b.paperid where a.id='.$id,'a.*,b.rankid');
		$db_scoreModel = M('app_paper_scorerank_item');
		$scorelevel = $db_scoreModel->getAll('where rankid='.$info['rankid']);
		$url = M_URL($this->AppName.'/Index','userPaper',$info['paperid'],GP(''));
		foreach ($nowscore as $key => $value) {
			if($value){
                $scorestr .=','.$value;
                $sumscore+=$value;
			}else{
				$errorstr .=','.$tknum[$key]; 
				$scorestr .=',0';
			}
		}
		// var_dump($scorelevel);exit();
		foreach ($scorelevel as $k => $v) {
			if($v['minscore']<=$sumscore&&$sumscore<=$v['maxscore']){
                 $Data['gradelevel'] = $v['itemTitle'];
			}
		}
		$Data['score'] = $scorestr;
		$Data['errortks'] = $errorstr;
		$Data['iscorrect'] = 1;
		$Data['feel'] = $feel;
		$Data['scoreorder'] = $sumscore;
		
		$Model->update($Data,'id='.$id);
		KS_INFO('批改成功',0,$url);
	}
	//删除试卷用户
	public function delMemberPaperAction(){
	    $idAry = ChkSQL(KS_G('request.aid'));
	     $paperid = ChkClng(KS_G('get.id'));
	    $Data['status'] = -1;
	    $paperModel = M('app_paper_answer');
        foreach ($idAry as $key => $value) {
	    	 $paperModel->update($Data,'id='.$value);
	    }
        $url = M_URL($this->AppName.'/Index','userPaper',$paperid,GP(''));
        KS_INFO('删除成功',3,$url,'',1);
	}
	//推广
	public function shareAction(){
		$paperid = ChkClng(KS_G('get.id'));
		include  CURR_VIEW_PATH . "share.php";
	}
	public function PLexcelAction(){
		$now_page = ChkClng(KS_S('p'));
		include  CURR_VIEW_PATH . "PLexcel.php";
	}
/*批量导入*/
    public function dowordinAction(){
    	$type=ChkClng(KS_G('post.type'));
    	if(empty($type)){
			KS_INFO('请选择上传类型',4,'','',1);
		}
    	if(!empty($_FILES['file']['tmp_name'])){
				$this->upload->savePath = 'school/'.$this->wxid.'/excel/'; // 设置附件上传（子）目录
				$this->upload->exts =array('docx');// 设置附件上传类型
				$info = $this->upload->uploadOne($_FILES['word']);
				if(!$info) {// 上传错误提示错误信息
					KS_INFO($this->upload->getError(),0,'','',1);
				}else{
					$word2 = ChkSQL($this->upload->rootPath.$info['savepath'].$info['savename']);//应用封面图片
				}
		}else{
			    KS_INFO('请选择文件',4,'','',1);
		}
		$wordphp = new \Core\Wordphp();
		$text    = $wordphp->readDocument($word2);
	    $test    = strip_tags($text);
        $test = preg_replace('/\s(?=\s)/', '', $test);//过滤空格
    	$arr = preg_split( "/T[0-9]、/", $test, 0, PREG_SPLIT_NO_EMPTY);
		$Data['wxid'] = $this->wxid;
		$Data['inputer'] = $this->userinfo['username'];
		$Data['tktype'] = $type;
		$Data['adddate'] =time() ;
    	$tkModel = M('app_paper_tk');
    	foreach ($arr as $k => $v) {
    		if($v!=' '){
    			if($type==1||$type==6){
    				$timu = explode('【答案】', $v);
	    			$options = trim($timu[0]);
	    			$options = preg_replace("/A、/","$$$",$options);
	    			$Data['options'] =trim(preg_replace("/[A-H]、/","|$|",$options));
	    			$anser = explode('【解析】',$timu[1]);
	    			$Data['anser']=trim($anser[0]);
	    			$level = explode('【难易程度】',$anser[1]);
	    			$Data['analysis'] = trim($level[0]);
	    			$level2=array_key_exists('1',$level)?trim($level[1]):'简单';
	    			if($level2=='简单'){
	                   $Data['level'] = 1;
	    			}elseif($level2=='一般'){
	                   $Data['level'] = 2;
	    			}elseif($level2=='困难'){
	                   $Data['level'] = 3;
	    			}else{
	    				$Data['level'] = 1;
	    			}
    			}elseif($type==2){//填空题
                   $timu = explode('【答案】', $v);
	    			$options = trim($timu[0]);
	    			$Data['options'] =trim(preg_replace("/_{5,9}/","{#answer}",$options));
	    			$anser = explode('【解析】',$timu[1]);
	    			$Data['anser']=trim($anser[0]);
	    			$level = explode('【难易程度】',$anser[1]);
	    			$Data['analysis'] = trim($level[0]);
	    			$level2=array_key_exists('1',$level)?trim($level[1]):'简单';
	    			if($level2=='简单'){
	                   $Data['level'] = 1;
	    			}elseif($level2=='一般'){
	                   $Data['level'] = 2;
	    			}elseif($level2=='困难'){
	                   $Data['level'] = 3;
	    			}else{
	    				$Data['level'] = 1;
	    			}
    			}elseif($type==3){//判断题
                    $timu = explode('【答案】', $v);
	    			$Data['options'] =trim($timu[0]);
	    			$anser = explode('【解析】',$timu[1]);
	    			if(trim($anser[0])=='正确'){
	    				$Data['anser']=1;
	    			}else{
	    				$Data['anser']=0;
	    			}
	    			$level = explode('【难易程度】',$anser[1]);
	    			$Data['analysis'] = trim($level[0]);
	    			$level2=array_key_exists('1',$level)?trim($level[1]):'简单';
	    			if($level2=='简单'){
	                   $Data['level'] = 1;
	    			}elseif($level2=='一般'){
	                   $Data['level'] = 2;
	    			}elseif($level2=='困难'){
	                   $Data['level'] = 3;
	    			}else{
	    				$Data['level'] = 1;
	    			}
    			}elseif($type==4){//问答题
                    $timu = explode('【答案】', $v);

	    			$Data['options'] =trim($timu[0]);
	    			$anser = explode('【解析】',$timu[1]);
	    			$Data['anser'] = str_replace("【关键词】","$$$",$anser[0]);
	    			$level = explode('【难易程度】',$anser[1]);
	    			$Data['analysis'] = trim($level[0]);
	    			$level2=array_key_exists('1',$level)?trim($level[1]):'简单';
	    			if($level2=='简单'){
	                   $Data['level'] = 1;
	    			}elseif($level2=='一般'){
	                   $Data['level'] = 2;
	    			}elseif($level2=='困难'){
	                   $Data['level'] = 3;
	    			}else{
	    				$Data['level'] = 1;
	    			}
    			}elseif($type==5){//材料题
                    $timu = explode('【答案】', $v);
                    $tg = trim($timu[0]);
                    $options = preg_replace("/t1、/","$$$",$tg);
                    $options = preg_replace("/t[0-9]、/","|$|",$options);
	    			$Data['options'] =trim($options);
	    			$anser = explode('【解析】',$timu[1]);
	    			$newanswer = explode('a1、',$anser[0]);
	    			$Data['anser'] = preg_replace("/a[0-9]、/","|$|",trim($newanswer[1]));
	    			$level = explode('【难易程度】',$anser[1]);
	    			$Data['analysis'] = trim($level[0]);
	    			$level2=array_key_exists('1',$level)?trim($level[1]):'简单';
	    			if($level2=='简单'){
	                   $Data['level'] = 1;
	    			}elseif($level2=='一般'){
	                   $Data['level'] = 2;
	    			}elseif($level2=='困难'){
	                   $Data['level'] = 3;
	    			}else{
	    				$Data['level'] = 1;
	    			}
    			}
      			  $tkModel->doAdd($Data,'tkid');
    		}
    	}
    	$url=M_URL($this->AppName.'/Index','TkIndex','',GP(''));
		 KS_INFO('导入成功',3,$url);
    }
}