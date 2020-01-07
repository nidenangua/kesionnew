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
    public function indexAction(){
		$paperurl = "/json/index.php?act=Exam.paperlist";
		$this->assign('paperurl',$paperurl);	
		$this->display('exam/index.html',1); 
    }
	//进入类型
	public function typeAction(){
		$category=null !==GF('category') ? GF('category'):'0';
		$this->display('exam/type.html',1); 
	}
	public function getallpaperAction(){
		header("Access-Control-Allow-Origin: *");
		$maxPerPage = null !=ChkClng(GF('maxPerPage')) ? ChkClng(GF('maxPerPage')):'50';
    	$picth  = ChkSQL(GF('pitch'))!='' ? ChkSQL(GF('pitch')):'';
    	$picth = strlen($picth)==1?intval($picth):$picth;
    	$categoryModel = M('app_category');  
		$key=null !== GF('key') ? GF('key') : '' ; 
		$wxid=null !== GF('wxid') ? GF('wxid') : '0' ; 
		$chargetype=null !== GF('chargetype') ? GF('chargetype') : 3 ; 
		$paper_level =null !== GF('paper_level') ? GF('paper_level') : '0' ; 
		$where = "as a left join $categoryModel->table as b on a.categoryid = b.categoryid where a.wxid = ".$wxid;
		if($key){
			$where .=" and (a.Title like '%$key%')";
		}
		if($paper_level){
			$where .=" and a.paper_level=".$paper_level;
		}
		if($chargetype!=3){
			$where .=" and a.chargetype=".$chargetype;
		}
//  	var_dump($picthcourse);
        $style          = null !==GF('style') ? GF('style'):1;
    	if($picth){
    		$picth = str_replace("@",",",$picth);
    		$where= $where.' and a.paperid in('.$picth.')';
    	}elseif($picth===0){
    		$options['totalput'] = 0;
    		$options['maxperpage'] = 50;
    		
    		$page = Page($options);
    		$result['page'] = $page;
    		$result['style'] = $style;
    		$result['dt'] = array();
    		header("Content-type: application/json"); 
	        echo json_encode($result);exit;
    	}
		$options = $this->AppModel->getOptions($maxPerPage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page = Page($options);
		$dt = $this->AppModel->getPage($page,'a.paperid',$where);
		$answer = M('app_paper_answer');
		foreach($dt as $k =>$v){
			$dt[$k]['paperTime']   = $answer->getOne('count(id)','where paperid='.$v['paperid']);
			$dt[$k]['portalurl']   = '/h5market/examin?id=='.$v['paperid'];
		}
		$result['page'] = $page;
		$result['style'] = $style;
		$result['dt'] = $dt;
		header("Content-type: application/json"); 
        echo json_encode($result);exit;
	}
	//进入列表
	public function listAction(){
		$categoryModel = new  Model('app_category');  
		$categoryid=null !== GF('category') ? GF('category') : '0' ; 
		$where = "as a left join $categoryModel->table as b on a.categoryid = b.categoryid where a.wxid = ".$GLOBALS['_DoM']['wxid']." and (b.parentidpath like '%$categoryid,%' or a.categoryid=$categoryid)";
		$maxPerPage = $this->getMaxPage('exam/list.html');
		$options = $this->AppModel->getOptions($maxPerPage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page = Page($options);
		$dt = $this->AppModel->getPage($page,'a.paperid',$where);
	    $this->assign('page',$page);
		$this->assign('dt',$dt);
		$this->display('exam/list.html'); 
    }
	//进入考试小课堂
	public function examingAction(){
		$paperid    =  ChkClng(KS_G('get.id'));
        $url        ='https://'.APP_DOMAIN.'/Json/index.php?act=Exam.paperinfo&paperid='.$paperid;
		$this->assign('url',$url); 
		$this->display('exam/test.html',1); 
	}
	//进入练习筛选
	public function selectTkAction(){
	    $categoryid=null !==GF('category') ? GF('category'):'0';  
		$type=null !==GF('type') ? GF('type'):'0';
		$courseModel = M('app_course');
		$categoryModel = M('app_category');
		$where = "as a left join $categoryModel->table as b on  a.categoryid = b.categoryid where a.wxid = ".$GLOBALS['_DoM']['wxid']." and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";
		$course = $courseModel->getAll($where,'courseid,title');
        $html='';
		$html.='<option value="0">所有</option>';
		foreach($course as $k=>$v){$html.='<option value="'.$v['courseid'].'">'.$v['title'].'</option>';}
		$this->assign('type',$type);
		$this->assign('course',$html);
		$this->display('exam/selectTk.html'); 
	}
	//进入考试前
	public function testAction(){
		if($this->memberid==''){$url = M_URL('home','Login');ks_header($url);} 
		$paperid = ChkClng(KS_G('get.id'));
		$paperModel = M('app_paper');
		$paper = $paperModel->getRow('where paperid = '.$paperid.' limit 1 ');
		$now   = date("Y-m-d H:i:s");
		$now   = strtotime($now);
		if( $paper['ExamTimeLimit'] == 1  && ($now <= $paper['ExamBeginTime']  ||  $paper['ExamEndTime'] < $now)){//是否在考试时间内
			$url1=M_URL('exam','list');KS_INFO("不在考试时间内",4,$url1,'',1);
		}
		$setting5 =  getSetting(4,$paper['setting'],$GLOBALS['_DoM']['wxid']);//考卷性质  考试或练习
		if($setting5 == 1){
			$papersModel = M('app_paper_answer');
			$count = $papersModel->getOne('count(*)',"where paperid = $paper[paperid] and memberid = $this->memberid and status = 1");
			$this->assign('memberinfo',$this->memberinfo['username']);
			$this->assign('paper',$paper);
			if($paper['ExamTimeLimit'] == 1){
				$begin = date('Y-m-d H:i:s', $paper['ExamBeginTime']);
				$end   = date('Y-m-d H:i:s', $paper['ExamEndTime']);
				$this->assign('begin',$begin);
				$this->assign('end',$end);
			}
			$this->assign('count',$count);
/*		    $examxx = getExamxx($paper,$this->memberinfo);
			$this->assign('examxx',$examxx);
			$this->assign('paperid',$paper['paperid']);  */
			$this->display('exam/examxx.html'); 
		}else{
			$url1=M_URL('exam','dotest',$paper['paperid']);KS_INFO("",2,$url1); 
		}
    }
	//进入试卷
	public function dotestAction(){
		$answerModel = M('app_paper_answer');
		$paperid     = ChkClng(KS_G('get.id'));
		$paperModel  = M('app_paper');
		$paper       = $paperModel->getRow('where paperid = '.$paperid.' limit 1 ');
		$setting2    = getSetting(1,$paper['setting'],$GLOBALS['_DoM']['wxid']);//允许保存答案  
		if($setting2 == 1){
		    $answer = $answerModel->getRow("where paperid = $paperid and memberid = $this->memberid and status = 0 order by id desc limit 1 "); 
			$this->assign('isanswer',$answer);  
		}else{$answer=false;}
		$where = 'where paperid = '.$paperid;
		$tmTypeModel = M('app_paper_tmtype');
        $tmtype = $tmTypeModel->getAll('where paperid = '.$paperid.' order by orderId');
	    $result = testSkin02($tmtype);
		if(!$answer){
			$Data['wxid']  = $GLOBALS['_DoM']['wxid'];
			$Data['memberid'] = $this->memberid;
			$Data['memberName'] = $this->memberinfo['username'];
			$Data['paperid'] = $paperid;
			$Data['Title'] = $paper['Title'];
			$Data['time'] = $paper['exam_time']*60;
			$Data['adddate'] = time();
			$Data['status'] = 0;
			$Data['tkids'] = $result[2];
			$answer['id'] = $answerModel->doadd($Data,'id');
        }
        $this->assign('answerid',$answer['id']);//答题id
		$time = $paper['exam_time']*60;//考试时间
		$this->assign('time',$time);
	    $this->assign('paperid',$paperid); 
		$this->assign('html',$result[0]);		
		$this->assign('tktype',$result[1]);	
		$this->display('exam/test.html');  
	}
	//考生交卷
    public function tjAnswerAction(){
		$paperanswerModel = M('app_paper_answer');
	    $id = ChkClng(KS_G('get.id')); 
		$paperid = ChkSQL(KS_G('post.paperid'));
	    $paperModel = M('app_paper');
		$Data['answer'] = ChkSQL(KS_G("post.answer"));
		$Data['time'] = ChkSQL(KS_G("post.timesecond"));
		$Data['lasttime'] = time();
		$Data['status'] =  1;
		$paperanswerModel->update($Data,'id = '.$id);
		$paper = $paperModel->getRow('where paperid = '.$paperid.' limit 1 ');
		$setting5 =  getSetting(4,$paper['setting'],$GLOBALS['_DoM']['wxid']);//考卷性质  考试或练习
		if($setting5 == 1){
			$count = $paperanswerModel->getOne('count(*)',"where paperid = $paper[paperid] and memberid = $this->memberid and status = 1");
			if($count>=$paper['AnswerNum']){
				  $Data1['endStatus'] = 1;
				  $paperanswerModel->update($Data1,"paperid = $paper[paperid] and memberid = $this->memberid and status = 1");
			}
		}
		$url1=M_URL('exam','complete',$id);
		KS_INFO("成功交卷",2,$url1);
	}
	//考试完成
	public function completeAction(){
		$id          = ChkClng(KS_G('get.id')); 
		$paperModel  = M('app_paper');
		$answerModel = M('app_paper_answer');
		$isanswer    = $answerModel -> getRow('where id = '.$id.' limit 1 '); 
		$paper    = $paperModel->getRow('where paperid = '.$isanswer['paperid'].' limit 1 ');
	    $setting1 =  getSetting(0,$paper['setting'],$GLOBALS['_DoM']['wxid']);//考试心得
	    $setting2 =  getSetting(1,$paper['setting'],$GLOBALS['_DoM']['wxid']);//允许保存答案
	    $setting3 =  getSetting(2,$paper['setting'],$GLOBALS['_DoM']['wxid']);//允许马上提交看答案
	    $setting4 =  getSetting(3,$paper['setting'],$GLOBALS['_DoM']['wxid']);//允许预估得分
		if($setting1 ==1){
			  if(!empty($isanswer['feel'])){
			      $this->assign('feel',$isanswer['feel']); 
				  $this->assign('abc','0'); 
			  }else{
				 $feel = ks_editor('feel','','1');
				 $this->assign('feel',$feel); 
				 $this->assign('abc','1'); 
			  }
		}
		if($setting2 ==1 || $setting3 == 1){
			$score = 0;
		    $issubjective = 0;	
			$exam=array();
			$id = rtrim($isanswer['tkids'], ",");
			$tkModel = M('app_paper_tk'); 
			$tks = $tkModel -> getAll("where tkid in ($id)");
			$tmtk = array_filter(explode('↓◎↑',$isanswer['answer']));
			$tmtypeModel = M('app_paper_tmtype');
			foreach($tmtk as $k=>$v){
				$tm = array_filter(explode('↓↑',$v));
				$tm1 = $tmtypeModel->getRow('where typeId = '.$tm[0].' limit 1');
				$tk = array_filter(explode('§№§',$tm[1]));
				foreach($tk as $kt=>$vt){
					$tk1 =  array_filter(explode('〓',$vt));
					foreach($tks as $ktt=>$vtt){
					    if($vtt['tkid'] == $tk1[0]){
							$tk1[1] = isset($tk1[1]) ? $tk1[1] : '';
							$result = checkTk($vtt,$tk1[1],$tm1['score'],$tm1['typeId']);
							$score = $score + $result['score'];
							if($result['subjective'] == 1){$issubjective=1;}
							array_push($exam,$result);
						}
					}
				}	
			}	 
		}
		if($setting3 == 1){//查看答案
			   $tmTypeModel = M('app_paper_tmtype');
	           $tmtype = $tmTypeModel->getAll('where paperid = '.$isanswer['paperid'].' order by orderId');
		       $html = testSkin02($tmtype);
			   $this->assign('html',$html[0]);
			   $exam = json_encode($exam);
			   $this->assign('analy',$exam);
			   $this->assign('answer',$isanswer['answer']);  
		}
		$this->assign('score',$score); 
		$this->assign('issubjective',$issubjective); 
		$this->assign('isanswer',$isanswer); 
		$this->assign('setting1',$setting1); //考试心得
		$this->assign('setting2',$setting2); //允许保存答案
		$this->assign('setting3',$setting3); //允许马上提交看答案
		$this->assign('setting4',$setting4); //允许预估得分
		$this->display('exam/testComplete.html'); 
	}
	//考试心得
	public function feelAction(){
		$Data['feel'] = ChkSQL(KS_G("post.feel"));
		$id = ChkClng(KS_G('get.id'));
		$answerModel = M('app_paper_answer');
		$paperid = $answerModel->getOne('paperid','where id = '.$id.' limit 1');
		$answerModel->update($Data,'id = '.$id);
		$url1=M_URL('exam','complete',$id);
		KS_INFO("保存成功",2,$url1);
	}
	//考试记录
	public function recordAction(){
		$option = null !==GF('option') ? GF('option'):0;
		//状态筛选
		/*if($option==0){$where = 'where (paystatus=0 or paystatus=1)';}
		elseif($option==1){$where = 'where paystatus=1';}
		elseif($option==2){$where = 'where paystatus=1';}
		elseif($option==3){$where = 'where paystatus=0';}
		elseif($option==4){$where = 'where paystatus=1';}
		elseif($option==5){$where = 'where paystatus=0';}*/
		$answerModel = M('app_paper_answer');
		$where = 'where wxid='.$GLOBALS['_DoM']['wxid'].' and memberid='.$this->memberid;
		$byname = 'lasttime desc';
		$maxPerPage = $this->getMaxPage('exam/record.html');
		$options = $answerModel->getOptions($maxPerPage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page = Page($options);
		$dt = $answerModel->getPage($page,$byname,$where); 
		$this->assign('option',$option);
	    $this->assign('page',$page);
		$this->assign('dt',$dt);
		$this->display('exam/record.html'); 
	}
	//练习
	public function lianxiAction(){
		$number = ChkClng(KS_G("post.number"));
		$courseid =  ChkClng(KS_G("post.courseid"));
		$chapterid =  ChkClng(KS_G("post.chapterid"));
		$selectTktype =  ChkClng(KS_G("post.selectTktype"));
		if($selectTktype == 1){
		  	$tktype = ChkSQL(KS_G("post.tktype"));
		 	$tktype =implode('|',$tktype);
		}else{$tktype = 0;}
	    $url = M_URL('exam','dolianxi','',GP("number-$number,courseid-$courseid,chapterid-$chapterid,tktype-$tktype"));
        KS_INFO('进入练习',5,$url);
   }
   //进入错题练习
   public function doerrorAction(){	
   }
   //进入练习
   public function dolianxiAction(){
        $type=null !==GF('type') ? GF('type'):'0';
		if($type ==2){
			$tkerrorModel = M('app_tk_error');
			$tkids = $tkerrorModel->getAll("where userid = ".$GLOBALS['_DoM']['wxid']." and memberid = $this->memberid", 'tkid');
			foreach($tkids as $k=>$v){$sss[$k] = $v['tkid'];}
			$tkids = implode(',',$sss);
			$tkwhere ="  and a.tkid in ($tkids)";
		}elseif($type == 3){
			$tkerrorModel = M('app_paper_collection');
			$tkids = $tkerrorModel->getAll("where userid = ".$GLOBALS['_DoM']['wxid']." and memberid = $this->memberid", 'tkid');
			foreach($tkids as $k=>$v){$sss[$k] = $v['tkid'];}
			$tkids = implode(',',$sss);
			$tkwhere ="  and a.tkid in ($tkids)";
		}else{$tkwhere='';}	
        $categoryid=null !==GF('category') ? GF('category'):'0';
		$number=null !==GF('number') ? GF('number'):'0';
		$courseid=null !==GF('courseid') ? GF('courseid'):'0';
		$chapterid=null !==GF('chapterid') ? GF('chapterid'):'0';
		$tktype=null !==GF('tktype') ? GF('tktype'):'0';
		$categoryModel = M('app_category');
        if($number ==0){
		   $url1=M_URL('exam','type');
	       KS_INFO("请输入大于0的正整数",4,$url1,'',1);
	    }  		
		$where='';	
		if($courseid != 0 && $chapterid = 0 ){
			$where.= "as a left join $categoryModel->table as c on a.categoryid =c.categoryid   where  a.userid = ".$GLOBALS['_DoM']['wxid']."  $tkwhere  and courseid = $courseid and (c.parentidpath like '%$categoryid,%' or 
c.categoryid=$categoryid)" ;	
		}elseif($courseid != 0 && $chapterid !=0 ){
			$course = M('app_course');
			$chapterTable = getOne('chapterTable','where courseid ='.$courseid);
			$chapterModel = M($chapterTable);
			$where.= " as a left join $chapterModel->table as b on a.chapterid = b.chapterid left join $categoryModel->table as c  on a.categoryid =c.categoryid  where a.userid = ".$GLOBALS['_DoM']['wxid']."  $tkwhere and (b.parentidpath like '%$chapterid,%' or b.chapterid=$chapterid) and (c.parentidpath like '%$categoryid,%' or c.categoryid=$categoryid)";
		}else{
			$where.=  "as a left join $categoryModel->table as c on a.categoryid =c.categoryid  where  a.userid = ".$GLOBALS['_DoM']['wxid']."  $tkwhere and (c.parentidpath like '%$categoryid,%' or c.categoryid=$categoryid)" ;	
		}
		$tkModel = M('app_paper_tk');
		$tktype = str_replace('|',',',$tktype);
		if(isset($tktype) && $tktype !=0){
			$where.= " and tktype in ($tktype) ";
		}
	    $where.= " order by rand() limit $number";  	
		
	   $tk = $tkModel -> getAll($where,'a.*');
	   $collectModel = M('app_paper_collection');
	   $collectTk = $collectModel -> getAll("where userid =".$GLOBALS['_DoM']['wxid']." and memberid = $this->memberid",'tkid');
	   $collectTk = json_encode($collectTk);
	   $this->assign('collectTk',$collectTk);		
	   $tk = json_encode($tk);
	   //var_dump($tk);exit; 
	   $this->assign('tk',$tk);	
	   $this->display('exam/practice.html'); 
   }
   //练习
   public function tjlianxiAction(){
	    $categoryid=null !==GF('category') ? GF('category'):'0'; 
	    $answer = ChkSQL(KS_G('post.answer'));
		$answer  = rtrim($answer,"§№§");
		$tkids = ChkSQL(KS_G('post.tkids'));
		$tkids  = rtrim($tkids,",");
        $Data['wxid'] = $GLOBALS['_DoM']['wxid'];
		$Data['memberid'] = $this->memberid;
		$Data['answer'] = $answer;
		$Data['adddate'] = time();
		$Data['tkids'] = $tkids;
		$Data['type'] = 2;
		$answerModel = M('app_paper_answer');
		$tkModel = M('app_paper_tk'); 
		$tks = $tkModel->getAll("where userid =".$GLOBALS['_DoM']['wxid']." and tkid in ($tkids)");
		$answerModel->doadd($Data,'id');
		$url1=M_URL('exam','type','',GP(''));	
		KS_INFO("练习完成",2,$url1);
   }
   //收藏题目
   public function collectAjaxAction(){
	    $ststus = ChkSQL(KS_G('post.status'));
		$Data['tkid'] = $tkid = ChkClng(KS_G("post.tkid"));
		$Data['wxid'] =  $userid =$GLOBALS['_DoM']['wxid'];
		$Data['memberid'] = $memberid = $this->memberid;
		$collectModel = M('app_paper_collection');
		if($ststus == 'true'){
			$collectModel->doadd($Data,'id');echo 1; //添加
		}else{
			$collectModel->delete("tkid = $tkid  and userid = $userid and memberid = $memberid ");echo 2; //删除
		}
   }
   //进入试卷
   public function listpaperAction(){
      /*$where      = " where wxid = $this->wxid";
		$maxPerPage = $this->getMaxPage('exam/list.html',1);
		$options    = $this->AppModel->getOptions($maxPerPage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page = Page($options);
		$dt   = $this->AppModel->getPage($page,'a.paperid',$where);*/
		$paperurl = "/Json/index.php?act=Exam.paperlist";
		
		$this->assign('paperurl',$paperurl);	
		$this->display('exam/list.html',1); 
	}
	public function readAction(){
		$answerid =ChkClng(KS_G("get.id"));
		$type=KS_S('type',1);
		$paperurl = "/Json/index.php?act=Exam.seeErrorTk&answerid=$answer&type=&type";
		$this->assign('url',$paperurl);	
		$this->display('exam/read.html',1); 
	}
	public function practiceAction(){
		$chapterid = ChkClng(KS_G("get.id"));
		$courseid  = null !==GF('coursrid') ? GF('coursrid'):'1';
		$url =  "/Json/index.php?act=Exam.chapterPractice&chapterid=$chapterid&courseid=$courseid";
		$this->assign('url',$url);
		$this->display('exam/practice.html',1); 
	}
	public function showTrainingEverydaysAction(){
        $courseid  = ChkClng(KS_G("request.id"));
        $url =  "/Json/index.php?act=Exam.showTrainingEverydayTK&courseid=$courseid";
     	$this->assign('url',$url);
        $this->display('exam/practice.html',1);
    }
    public function randomTrainingDetailAction(){
        $courseid  = ChkClng(KS_G("request.id"));
        $url =  "/Json/index.php?act=Exam.randomTrainingTK&courseid=$courseid";
     	$this->assign('url',$url);
        $this->display('exam/test.html',1);
    }
}