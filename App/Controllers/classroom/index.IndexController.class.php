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
     	
     	$this->AppModel  =M('app_course');
		$where       = 'where a.wxid='.$GLOBALS['_DoM']['wxid'].' and a.status=2';
		$style       = null !==GF('style') ? GF('style'):1;	
		$prise       = null !==GF('prise') ? GF('prise'):'0';
		if($prise!=='0'){//价格筛选
			$priseArr = explode('-',$prise.'--');
			if(ChkClng($priseArr[0])===0&&ChkClng($priseArr[1])===0){
				$where    .= ' and price=0';
			}elseif(ChkClng($priseArr[1])===0){
				$where    .= ' and price>='.ChkClng($priseArr[0]);
			}else{
				$where    .= ' and price>='.ChkClng($priseArr[0]).' and price<='.ChkClng($priseArr[1]);
			}
		} 
		$studentcount       = null !==GF('studentcount') ? GF('studentcount'):'0';
		if($studentcount!=='0'){//价格筛选
			$studentcountArr = explode('-',$studentcount.'--');
			if(ChkClng($studentcountArr[0])===0&&ChkClng($studentcountArr[1])===0){
				$where    .= ' and studentcount=0';
			}elseif(ChkClng($studentcountArr[1])===0){
				$where    .= ' and studentcount>='.ChkClng($studentcountArr[0]);
			}else{
				$where    .= ' and studentcount>='.ChkClng($studentcountArr[0]).' and studentcount<='.ChkClng($studentcountArr[1]);
			}
		}
		$key           =null !==GF('key') ? GF('key'):'0';
		if(!empty($key)){$where.=" and title like '%$key%'";} 
		$categoryid  = null !==GF('categoryid') ? GF('categoryid'):0;	
		$GLOBALS['_DoM']['categoryid'] = $categoryid;
		if($categoryid!=0){$where .= " and (c.parentidpath like '%$categoryid,%' or c.categoryid=$categoryid)";}	
		$appcategory = $this->cache->GetHCache('appcategory',$GLOBALS['_DoM']['wxid']);//取出缓存
		$sort = null !==GF('sort') ? GF('sort'):1;//升降序
	    switch($sort){
	    	case 1:$byname = 'a.adddate desc';break;
	    	case 2:$byname = 'a.adddate asc';break;
	    	case 3:$byname = 'a.adddate desc';break;
	    	case 4:$byname = 'a.adddate asc';break;
	    	case 5:$byname = 'a.adddate desc';break;
	    	case 6:$byname = 'a.adddate asc';break;
	    	case 7:$byname = 'a.adddate desc';break;
	    	case 8:$byname = 'a.adddate asc';break;
	    	default:$byname = 'a.adddate desc';break;
	    } 
		$left_join     = M('app_category');//需要连表的在最后left join
		$user_teacher  = M('common_user_teacher');
		$where      = "as a left join `".$user_teacher->table."` as b on a.teacherid = b.userid left join `$left_join->table` as c on a.categoryid = c.categoryid $where";
		$maxPerPage = $this->getMaxPage('classroom/index.html');
		$options    = $this->AppModel->getOptions($maxPerPage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page = Page($options);
		$dt   = $this->AppModel->getPage($page,$byname,$where,'c.*,b.*,a.*'); 
		foreach($dt as $k=>$v){
			  if($v['price']==0){$dt[$k]['price'] = '免费';}else{$dt[$k]['price'] = '￥'.$v['price'];}
			  $dt[$k]['head'] = $this->upload->getHead($v['teacherid']);
		}
//		$Linkage = Linkage(array());$Linkage->cachename  = 'appcategory';//读出缓存$Linkage->wxid       = $GLOBALS['_DoM']['wxid'];//读出缓存$Linkage->categoryid = $categoryid;$this->assign('Linkage',$Linkage->Linkage(5));
	    $this->assign('page',$page);
		$this->assign('style',$style);
		$this->assign('dt',$dt);	
		$this->display('classroom/index.html'); 
     }
     public function viewAction(){
		//$paperurl = "/json/index.php?act=Exam.paperlist";
		//$this->assign('paperurl',$paperurl);	
		$this->display('classroom/view.html'); 
     }
     public function workAction(){ 
		//$paperurl = "/json/index.php?act=Exam.paperlist";
		//$this->assign('paperurl',$paperurl);	
		$this->assign('uid',$this->memberid);	
		$this->display('classroom/work.html',1); 
     }
     public function syllabusAction(){ 
		//$paperurl = "/json/index.php?act=Exam.paperlist";
		//$this->assign('paperurl',$paperurl);	
		$this->display('classroom/syllabus.html',1); 
     }
     public function answerAction(){ 
     	$tkid  = ChkClng(KS_G("request.id"));	
		$this->display('classroom/answer.html',1); 
     }
     public function answerRecordAction(){ 
		//$paperurl = "/json/index.php?act=Exam.paperlist";
		//$this->assign('paperurl',$paperurl);	
		$this->display('classroom/answerRecord.html',1); 
     }
     public function voteAction(){ 	
     	$id = ChkClng(KS_G("request.id"));
		$this->display('classroom/vote.html',1); 
     }
     public function praiseviewAction(){ 	
     	$id = ChkClng(KS_G("request.id"));
		$this->display('classroom/praiseview.html',1); 
     }
     public function dataAction(){
		//$paperurl = "/json/index.php?act=Exam.paperlist";
		//$this->assign('paperurl',$paperurl);	
		$this->display('classroom/data.html',1); 
     }
     public function messageAction(){
		$classid=ChkClng(KS_G("request.id"));
		$this->assign('classid',$classid);	
		$this->display('classroom/message.html',1); 
     }
	 //进入类型
	 public function typeAction(){
		 $category=null !==GF('category') ? GF('category'):'0';
		 $this->display('exam/type.html',1); 
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

		 $url        ='http://hcl.zuojy.com/json/index.php?act=Exam.paperinfo&paperid='.$paperid;
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
		 foreach($course as $k=>$v){
			 $html.='<option value="'.$v['courseid'].'">'.$v['title'].'</option>';
		 }
		 $this->assign('type',$type);
		 $this->assign('course',$html);
		 $this->display('exam/selectTk.html'); 
	 }
	 //进入考试前
	  public function testAction(){
		  
		  if($this->memberid==''){
			  $url = M_URL('home','Login');
			  ks_header($url);
		  } 
		  $paperid = ChkClng(KS_G('get.id'));
		  $paperModel = M('app_paper');
		  $paper = $paperModel->getRow('where paperid = '.$paperid.' limit 1 ');
		  $now =date("Y-m-d H:i:s");
		  $now = strtotime($now);
		  if( $paper['ExamTimeLimit'] == 1  && ($now <= $paper['ExamBeginTime']  ||  $paper['ExamEndTime'] < $now)){//是否在考试时间内
			   $url1=M_URL('exam','list');
		       KS_INFO("不在考试时间内",4,$url1,'',1);
		  }
		  $setting5 =  getSetting(4,$paper['setting']);//考卷性质  考试或练习
		  if($setting5 == 1){
			  $papersModel = M('app_paper_answer');
			  $count = $papersModel->getOne('count(*)',"where paperid = $paper[paperid] and memberid = $this->memberid and status = 1");
			  $this->assign('memberinfo',$this->memberinfo['username']);
			  
			  $this->assign('paper',$paper);
			  
			  if($paper['ExamTimeLimit'] == 1){
				 
				 $begin = date('Y-m-d H:i:s', $paper['ExamBeginTime']);
				 
				 $end = date('Y-m-d H:i:s', $paper['ExamEndTime']);
				 
				 $this->assign('begin',$begin);
				 
				 $this->assign('end',$end);
				  
			  }
			  
			  $this->assign('count',$count);
/*		      $examxx = getExamxx($paper,$this->memberinfo);
			  
			  $this->assign('examxx',$examxx);
			  
			  $this->assign('paperid',$paper['paperid']);  */
			  
			  $this->display('exam/examxx.html'); 
		   
		   }else{
			     
				$url1=M_URL('exam','dotest',$paper['paperid']);
				 
				KS_INFO("",2,$url1); 
		   }
     }
	 //进入试卷
	 public function dotestAction(){
		  
		   $answerModel = M('app_paper_answer');
		   
		   $paperid = ChkClng(KS_G('get.id'));
		   
		   $paperModel = M('app_paper');
		  
		   $paper = $paperModel->getRow('where paperid = '.$paperid.' limit 1 ');
		   
		   $setting2 =  getSetting(1,$paper['setting']);//允许保存答案  
		   
		   if($setting2 == 1){
		   
			   $answer = $answerModel->getRow("where paperid = $paperid and memberid = $this->memberid and status = 0 order by id desc limit 1 "); 
			  
			   $this->assign('isanswer',$answer);  
			   
		   }else{
			   $answer=false;
			}
		   
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
		  //考试时间
		  $time = $paper['exam_time']*60;
		  
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
		//ChkSQL(KS_G("post.endtime"));
		$Data['status'] =  1;
		
		$paperanswerModel->update($Data,'id = '.$id);
		
	
		$paper = $paperModel->getRow('where paperid = '.$paperid.' limit 1 ');
	
		$setting5 =  getSetting(4,$paper['setting']);//考卷性质  考试或练习
		 
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
	
		$id = ChkClng(KS_G('get.id')); 
		
		$paperModel = M('app_paper');
		
		$answerModel = M('app_paper_answer');
		
		$isanswer = $answerModel -> getRow('where id = '.$id.' limit 1 '); 
		
		$paper = $paperModel->getRow('where paperid = '.$isanswer['paperid'].' limit 1 ');
	
	    $setting1 =  getSetting(0,$paper['setting']);//考试心得
	   
	    $setting2 =  getSetting(1,$paper['setting']);//允许保存答案
	   
	    $setting3 =  getSetting(2,$paper['setting']);//允许马上提交看答案
	    
	    $setting4 =  getSetting(3,$paper['setting']);//允许预估得分
	
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
							if($result['subjective'] == 1){
								 $issubjective=1;
							}
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
		//var_dump($dt);exit;
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
			  
			}else{
			  $tktype = 0;	
			}
		
			
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
				foreach($tkids as $k=>$v){
					$sss[$k] = $v['tkid'];
				}
				$tkids = implode(',',$sss);
				$tkwhere ="  and a.tkid in ($tkids)";
			}elseif($type == 3){
				$tkerrorModel = M('app_paper_collection');
				$tkids = $tkerrorModel->getAll("where userid = ".$GLOBALS['_DoM']['wxid']." and memberid = $this->memberid", 'tkid');
				foreach($tkids as $k=>$v){
					$sss[$k] = $v['tkid'];
				}
				$tkids = implode(',',$sss);
				$tkwhere ="  and a.tkid in ($tkids)";
			}else{
				$tkwhere='';
			}	
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
			$collectModel->doadd($Data,'id');
			echo 1; //添加
		}else{
			$collectModel->delete("tkid = $tkid  and userid = $userid and memberid = $memberid ");
			echo 2; //删除
		}
   }
   //进入试卷
   public function listpaperAction(){
/*		$where      = " where wxid = $this->wxid";
		$maxPerPage = $this->getMaxPage('exam/list.html',1);
		$options    = $this->AppModel->getOptions($maxPerPage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page = Page($options);
		$dt   = $this->AppModel->getPage($page,'a.paperid',$where);*/
		$paperurl = "/json/index.php?act=Exam.paperlist";
		
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
		$chapterid =ChkClng(KS_G("get.id"));
		$courseid=null !==GF('coursrid') ? GF('coursrid'):'1';
		$url =  "/Json/index.php?act=Exam.chapterPractice&chapterid=$chapterid&courseid=$courseid";
		
		$this->assign('url',$url);
		$this->display('exam/practice.html',1); 
	}
	public function classSignAction(){
		
		$this->display('classroom/classSign.html',1); 
	}
	//班级设置
	public function setClassAction(){
		$wxid =  $userid =$GLOBALS['_DoM']['wxid'];
		$value = $this->cache->GetA('domaininfo','wxid',$wxid,'tempPxt');//写入缓存
		//用户设置的音量
		$Mode = M('common_user_member');
		//var_dump('6666');exit;
		$Modes  = M('app_roomsetting');
		if(isset($this->memberid)){//用户是否登录
			$backgroundStyle = $Mode->getOne('backgroundStyle','where userid='.$this->memberid);
			$backgroundStyle = explode('※',$backgroundStyle);
			if(empty($backgroundStyle[0])){
				$background = $Modes->getOne('fileurl','where tempid='.$backgroundStyle['3'].' and ism=1');
			}else{
				$background = $Modes->getOne('fileurl','where id='.$backgroundStyle['0'].' and tempid='.$backgroundStyle['3']);
				if(empty($background)){
					$background = $Modes->getOne('fileurl','where tempid='.$backgroundStyle['3'].' and ism=1');
				}
			}
			if(empty($backgroundStyle[1])){
				$backmusic = '/Tp/PCXT/Skin01/Public/live/muxue.mp3';
			}else{
				$backmusic = $Modes->getOne('fileurl','where id='.$backgroundStyle['1']);
			}
			if(empty($backgroundStyle[2])){
				$volume = 0;
			}else{
				$volume = $backgroundStyle[2];
			}
		}else{
			$backgroundStyle['0'] = -1;
			$backgroundStyle['1'] = -1;
			$backgroundStyle['3'] = -1;
			$background  = $Modes->getOne('fileurl','where tempid='.$value.' and ism=1');
			$backmusic   = '/Tp/PCXT/Skin01/Public/live/muxue.mp3';
			$volume      = 50;
		}
		$this->assign('tempPxt',$value);
		$this->assign('background',$background);//默认背景图片
		$this->assign('bid',$backgroundStyle['0']);
		$this->assign('bgmid',$backgroundStyle['1']);
		$this->assign('themeid',$backgroundStyle['3']);//用户使用的模版ID
		$this->assign('backmusic',$backmusic);//默认背景音乐
		$this->assign('volume',$volume);//默认背景音量
		$this->display('classroom/setClass.html',1);  
	}
	
}