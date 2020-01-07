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
    //进入试卷管理
    public function indexAction(){
		$wxModel = M('common_user_website');
		$papertypeModel = M('app_paper_type');
		//状态
		$stat=KS_S('status',3);
		
		if($stat==3){$where = 'where a.Status!=-1';}
		elseif($stat==1){$where = 'where (a.Status=1 or a.Status=2)';}
		elseif($stat==0){$where = 'where a.Status=0';}
		// if($this->isweb !== ''){
		//     // $where.=' and a.userid ='.$this->userid;//分类
		// 	$categoryid=null !==GF('categoryid') ? GF('categoryid'):0;
		// 	if($categoryid!=0){$where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}
		// 	$category = $this->cache->GetACache('appcategory',$this->userid);//读出缓存
		// }
		// 判断是否是分销
		$distr = null !==GF('distr') ? GF('distr'):'0';
		if($distr){
			$db_user = M('common_user');
			$wxid = $db_user->getAll('where inviter!="" and parentid=0','wxid');
			$str=0;
			foreach ($wxid as $k => $v) {
				$str.=','.$v['wxid'];
			}
			$where = $where.' and a.wxid in ('.$str.') and a.wxid!=0';
		}
		//关键字搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		if(!empty($keyword)){ 
			if($keytype==1){$where.=" and a.Title like '%$keyword%'";
			}elseif($keytype==2){$where.=" and c.typeName ='%$keyword%'";
			}elseif($keytype==3){$where.=" and a.inputer like '%$keyword%'";
			}elseif($keytype==0){$where.='';}		   
		}	
		$m =mktime(0,0,0,date('m'),1,date('Y'));
		$day =  mktime(0,0,0,date('m'),date('d'),date('Y'));	
		
		$where="  as a left join $wxModel->table as b on a.wxid = b.wxid left join $papertypeModel->table as c on a.paperType = c.id  $where";
		$montncount = $this->AppModel->getOne('count(paperid)',$where.' and a.adddate>'.$m);
		$daycount = $this->AppModel->getOne('count(paperid)',$where.' and a.adddate>'.$day);
		//分页
		$options = $this->AppModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$paper   = $this->AppModel->getPage($page,'a.paperid desc',$where,'a.*,b.sitename');
		$db_type = M('app_paper_tmtype');
		$db_answer = M("app_paper_answer");
		foreach ($paper as $k => $v) {
			$paper[$k]['number'] = $db_type->getOne('number','where paperid='.$v['paperid']);
			$paper[$k]['usesrcount'] = $db_answer->getOne('count(id)','where paperid='.$v['paperid']);
			$paper[$k]['paperTypename'] = M('app_paper_type')->getOne('typeName','where wxid='.$v['wxid'].' and id='.$v['paperType']);
			$paper[$k]['jumpurl'] = '//store.kesion.com/h5market/examin?id='.$v['paperid'];
		}
		include  CURR_VIEW_PATH . "index.php";
	}
	public function changeauditAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$url      = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		$paperid = ChkClng(KS_G('get.id'));
		$info =$this->AppModel->getRow('where paperid='.$paperid);
		$audit = GF('audit');
		$Data['audit'] = $audit;
		$res = $this->AppModel->update($Data,'paperid='.$paperid);
        if($res){
        	$data001['wxid']=$info['wxid'];
        	$data001['taskid']=2;
        	spreadaudit($data001);
        }
		KS_INFO('审核成功',0,$url);
	}
	//上架
	public function  upAction(){
		$now_page       = ChkClng(KS_S('p',1));
		$paperid        = ChkClng(KS_G('get.id'));
		$Data['Status'] = 2;
		$this->AppModel->update($Data,'paperid='.$paperid);
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO('',0,$url);
    }
	//下架
	public function  downAction(){
		$now_page       = ChkClng(KS_S('p',1));
		$paperid        = ChkClng(KS_G('get.id'));
		$Data['Status'] = 0;
		$this->AppModel->update($Data,'paperid='.$paperid);
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO('',0,$url);
    }
   //试卷进行批量处理
	public function paperbatchAction(){
		$type = KS_G('post.batch');
		$id = ChkSQL(KS_G("post.paperid"));
		
		 $now_page = ChkClng(KS_S('p',1));
		 $url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		if($type == 1){
			foreach($id as $v){$this->AppModel->delete('paperid='.$v);}	 
		}elseif($type == 2){
			$Data['Status'] = 2;
			foreach($id as $v){$this->AppModel->update($Data,'paperid='.$v);}	
		}elseif($type == 3){
			$Data['Status'] = 0;
			foreach($id as $v){$this->AppModel->update($Data,'paperid='.$v);}	 
		}elseif (KS_G('post.batch')==4) {
		 	foreach ($id as $v ) {
		 		$info =$this->AppModel->getRow('where paperid='.$v);
		 		if($info){
		 			$Data['audit'] = 1;
					$res = $this->AppModel->update($Data,'paperid='.$v);
			        if($res){
			        	$data001['wxid']=$info['wxid'];
			        	$data001['taskid']=2;
			        	spreadaudit($data001);
			        }
		 		}
		 	}
		 	KS_INFO('分销审核成功',0,$url);
		 }
		
		KS_INFO('修改成功',0,$url);
	}
	//进入添加
	public function paperAddAction(){
	    $paperid = ChkClng(KS_G('get.id'));
		if($this->userid!=''){
		    $where = ' userid='.$this->userid;
			$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存	
		}else{
			$where=' userid= 0';$this->userid = 0;
			$userModel = M('common_user');
		    $this->userinfo = $userModel->getRow('where userid=0 limit 1');
			$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		}	
		$papertypeModel = M('app_paper_type');
	    $papertype = $papertypeModel->getAll('where '.$where.' and isdisplay = 1 order by orderid','id,typeName');
		$paperScoreRank = M('app_paper_scorerank');
		$ScoreRank = $paperScoreRank->getAll("where $where");
		$config    = array('inputname'  =>  'categoryid',);
	    $Linkage   = Linkage($config,$category);
	    $Intro     = ks_editor('Intro');
	    include  CURR_VIEW_PATH . "paper_add.php";
	}
	//进入试卷编辑
	public function editpaperAction(){
	    $paperid  = ChkClng(KS_G('get.id'));
	    // var_dump($paperid);
		$now_page = ChkClng(KS_S('p',1));
		$paper    = $this->AppModel->getRow('where paperid='.$paperid.' limit 1');
		$userid   = $paper['userid'];
		$userModel = M('common_user');
		    $this->userinfo = $userModel->getRow('where userid='.$userid.' limit 1');
		$where          = ' wxid='.$paper['wxid'] ;
		$papertypeModel = M('app_paper_type');
	    $papertype      = $papertypeModel->getAll('where '.$where.' and isdisplay = 1 order by orderid','id,typeName');
		$paperScoreRank = M('app_paper_scorerank');
		$ScoreRank      = $paperScoreRank->getAll('where '.$where);
		$courseModel    = M('app_course');
		$course = $courseModel->getAll('where categoryid='.$paper['categoryid'].' and wxid='.$paper['wxid'],'courseid,title');
		if($paper['courseid']){
			$chaptertable   = $courseModel->getOne('chaptertable','where courseid = '.$paper['courseid'].' limit 1');
		    $chapterModel   = M($chaptertable);
			$chapter  = $chapterModel->getAll('where courseid = '.$paper['courseid'],'chapterid,title,depth');
		}
		
		
	    $config   = array('inputname'  =>  'categoryid','categoryid'  => $paper['categoryid'],);
	    $category = $this->cache->GetHCache('appcategory',$paper['wxid']);//读出缓存
	    $Linkage  = Linkage($config,$category);
	    $Intro    = ks_editor('Intro',$paper['Intro']);
	    include  CURR_VIEW_PATH . "paper_add.php";
	}
	//进行试卷添加
	public function doAddPaperAction(){
		$Data['userid']     = $this->userid;
		$userModel          = M('common_user');
		$Data['inputer']    = $userModel->getOne('username','where userid ='.$this->userid);
		$Data['categoryid'] = ChkClng(KS_G('post.categoryid'));
		$Data['courseid']   = ChkClng(KS_G('post.courseid'));
		$Data['chapterid']  = ChkClng(KS_G('post.chapterid'));
		$Data['Title'] = ChkSQL(KS_G("post.Title"));
		$Data['paperType'] = ChkClng(KS_G('post.paperType'));
		$Data['rankid'] = ChkClng(KS_G('post.rankid'));
		$Data['ExamScore'] = ChkClng(KS_G('post.ExamScore'));
		$Data['exam_time'] = ChkClng(KS_G('post.exam_time'));
		$Data['ExamScore'] = ChkClng(KS_G('post.ExamScore'));
		$Data['sumscore'] = ChkClng(KS_G('post.ExamScore'));
		// $Data['AnswerNum'] = ChkClng(KS_G('post.AnswerNum'));
		$Data['exam_type'] = ChkClng(KS_G('post.exam_type'));
		$Data['ExamTimeLimit'] = ChkClng(KS_G('post.ExamTimeLimit'));
		if($Data['ExamTimeLimit']==1){
		$Data['ExamBeginTime'] = strtotime(ChkClng(KS_G('post.ExamBeginTime')));
		$Data['ExamEndTime'] = strtotime(ChkClng(KS_G('post.ExamEndTime')));
		}
		$Data['Intro'] = ChkSQL(KS_G('post.Intro'));
		$Data['paper_level'] = ChkClng(KS_G('post.paper_level'));
		$Data['Status'] = ChkClng(KS_G('post.Status'));
		$Rule['Title'] = '试卷名称|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);
		$this->AppModel->doadd($Data,'paperid');
		$courseid = null !==GF('courseid') ? GF('courseid'):'0';
		if(!empty($courseid)){
			$appid = null !==GF('bappid') ? GF('bappid'):'0';
			$url1=M_URL('course/index','exam',$courseid,GP('appid-'.$appid));
		    KS_INFO('',3,$url1);
		}
		$url1=M_URL($this->AppName.'/Index','index','',GP(''));
		KS_INFO("添加成功",0,$url1);
	}
	//进行试卷修改
	public function doEditPaperAction(){
		$parperid = ChkClng(KS_G('get.id'));
		$now_page = ChkClng(KS_G('requst.p'));
		$Data['categoryid'] = ChkClng(KS_G('post.categoryid'));
		$Data['courseid'] = ChkClng(KS_G('post.courseid'));
		$Data['chapterid'] = ChkClng(KS_G('post.chapterid'));
		$Data['Title'] = ChkSQL(KS_G("post.Title"));
		$Data['paperType'] = ChkClng(KS_G('post.paperType'));
		$Data['exam_time'] = ChkClng(KS_G('post.exam_time'));
		$Data['ExamScore'] = ChkClng(KS_G('post.ExamScore'));
		$Data['sumscore'] = ChkClng(KS_G('post.ExamScore'));
		// $Data['AnswerNum'] = ChkClng(KS_G('post.AnswerNum'));
		$Data['exam_type'] = ChkClng(KS_G('post.exam_type'));
		$Data['ExamTimeLimit'] = ChkClng(KS_G('post.ExamTimeLimit'));
		if($Data['ExamTimeLimit']==1){
			$Data['ExamBeginTime'] = strtotime(ChkClng(KS_G('post.ExamBeginTime')));
			$Data['ExamEndTime'] = strtotime(ChkClng(KS_G('post.ExamEndTime')));
		}
		$Data['Intro'] = ChkSQL(KS_G("post.Intro"));
		$Data['paper_level'] = ChkClng(KS_G('post.paper_level'));
		$Data['Status'] = ChkClng(KS_G('post.Status'));
		$Rule['Title'] = '试卷名称|isEmpty';
		$Rule['categoryid'] = '分类|isEmpty';
		$Rule['courseid'] = '课程类别|isEmpty';
		$Rule['ExamScore'] = '总分|isEmpty,isnumber';
		$Rule['AnswerNum'] = '答题次数|isEmpty,isnumber';
		Chkpost($Data,$Rule,$this->AppModel);
		$this->AppModel->update($Data,"paperid=$parperid");
		$courseid = null !==GF('courseid') ? GF('courseid'):'0';
		if(!empty($courseid)){
			$appid = null !==GF('bappid') ? GF('bappid'):'0';
			$url1=M_URL('course/index','exam',$courseid,GP('appid-'.$appid));
		    KS_INFO('',3,$url1);
		}
		$url1 = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO('保存成功',3,$url1);
	}
	//进行删除
	public function delPaperAction(){
		$id = KS_G('get.id');
		 $now_page = ChkClng(KS_S('p',1));
		$this->AppModel->delete('paperid='.$id);
		$courseid = null !==GF('courseid') ? GF('courseid'):'0';
		if(!empty($courseid)){
			$appid = null !==GF('bappid') ? GF('bappid'):'0';
			$url1=M_URL('course','index','exam',$courseid,GP('appid-'.$appid.',p-'.$now_page));
		    KS_INFO('删除成功',0,$url1);
		}
		// var_dump($now_page);exit();
	    $url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO('删除成功',0,$url);
	}
	
	//进入试卷类型管理 
	public function paperTypeAction(){
		$papertypeModel = M('app_paper_type');
		if($this->userid ==''){
			$this->userid=0;
			$userModel = M('common_user');
		    $this->userinfo = $userModel->getRow('where userid=0 limit 1');
		}
		$where = 'where userid ='.$this->userid;
		$options = $papertypeModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$paper   = $papertypeModel->getPage($page,'id desc',$where);
		// $paper = $papertypeModel->getAll();
		include  CURR_VIEW_PATH . "papertype_index.php";
	}
	public function typeAddAction(){
		$id = ChkClng(KS_G('get.id'));
		// var_dump($id);
		if(!empty($id)){
		   $papertypeModel = M('app_paper_type');
		   $papertype = $papertypeModel->getRow('where id = '.$id.' limit 1');	
		}
		include  CURR_VIEW_PATH . "papertype_add.php";
	}
    //进行添加试卷类型
	public function dotypeAddAction(){
		$papertypeModel = M('app_paper_type');
		$Data['typeName'] = ChkSQL(KS_G('post.typeName'));
		$Data['isdisplay'] = ChkClng(KS_G('post.isdisplay'));
		$Data['intro'] = ChkSQL(KS_G('post.intro'));
		$Data['orderid'] = ChkClng(KS_G('post.orderid'));
		$Rule['typeName'] = '试卷名称|isEmpty';
		$Rule['orderid'] = '排序名称|isEmpty,isnumber';
		Chkpost($Data,$Rule,$papertypeModel);
		$papertypeModel->doAdd($Data,'id');
		$url1=M_URL($this->AppName.'/Index','paperType','',GP(''));
		KS_INFO("添加成功",0,$url1);
	}
	//进行编辑试卷类型
	public function doEditPaperTypeAction(){
		$papertypeModel = M('app_paper_type');
		$id = KS_G('get.id');
		$Data['typeName'] = ChkSQL(KS_G('post.typeName'));
		$Data['isdisplay'] = ChkClng(KS_G('post.isdisplay'));
		$Data['intro'] = ChkSQL(KS_G('post.intro'));
		$Data['orderid'] = ChkClng(KS_G('post.orderid'));
		$Rule['typeName'] = '试卷名称|isEmpty';
		$Rule['orderid'] = '排序名称|isEmpty,isnumber';
		Chkpost($Data,$Rule,$papertypeModel);
		$papertypeModel->update($Data,"id=$id");
		$url1=M_URL($this->AppName.'/Index','paperType','',GP(''));
		KS_INFO('修改成功',0,$url1);
	}
	//进行删除
	public function delPaperTypeAction(){
		 $now_page = ChkClng(KS_S('p',1));
		$papertypeModel = M('app_paper_type');
		$id = KS_G('get.id');
		$papertypeModel->delete('id='.$id);
		 $url = M_URL($this->AppName.'/Index','paperType','',GP('p-'.$now_page));
		 KS_INFO('删除成功',0,$url);
	}
    //进入分数等级设置
	public function scoreRankAction(){
		$paperScoreRank = M('app_paper_scorerank');
		if($this->userid ==''){
			$this->userid   = 0;
			$userModel      = M('common_user');
		    $this->userinfo = $userModel->getRow('where userid=0 limit 1');
		}
		$ScoreRank=$paperScoreRank -> getAll('where userid = '.$this->userid);
		include  CURR_VIEW_PATH . "paperScoreRank_index.php";
	}
	//进入等级增加,编辑
	public function addScoreRankAction(){
		$id = KS_G('get.id');
		if(!empty($id)){
		   $paperScoreRank = M('app_paper_scorerank');
		   $paperScoreRankItem = M('app_paper_scorerank_item');
		   $ScoreRank = $paperScoreRank->getRow('where rankid = '.$id.' limit 1');
		   $ScoreRankItem = $paperScoreRankItem->getAll('where rankid = '.$id);
		}
		include  CURR_VIEW_PATH . "paperScoreRank_add.php";
	}
	//进行等级增加
	public function doAddScoreRankAction(){
		$paperScoreRank = M('app_paper_scorerank');
		$paperScoreRankItem = M('app_paper_scorerank_item');
		$Data['title'] = ChkSQL(KS_G('post.title'));
		$Data['isDefault'] = ChkClng(KS_G('post.isdisplay'));
		$Data['orderId'] = ChkClng(KS_G('post.orderId'));
		$Data['userid'] = $this->userid;
		$rankid = $paperScoreRank->doAdd($Data,'rankid');
		$itemTitle=ChkSQL(KS_G('post.itemTitle'));
		$minscore=ChkSQL(KS_G('post.minscore'));
		$maxscore=ChkSQL(KS_G('post.maxscore'));
		$score=ChkSQL(KS_G('post.score'));
		$itemOrderId = ChkSQL(KS_G('post.itemOrderId'));
		foreach($itemTitle as $k=>$v){
			  $Data[$k]['itemTitle'] = $v;
			  $Data[$k]['minscore'] = $minscore[$k];
			  $Data[$k]['maxscore'] = $maxscore[$k];
			  $Data[$k]['score'] = $score[$k];
			  $Data[$k]['itemOrderId'] = $itemOrderId[$k];
			  $Data[$k]['rankid'] = $rankid;
			  $paperScoreRankItem->doAdd($Data[$k],'itemId');
		}
		$url1=M_URL($this->AppName.'/Index','scoreRank','',GP(''));
		KS_INFO("添加成功",0,$url1);
	}
	//进行等级修改
	public function doEditScoreRankAction(){
		$paperScoreRank = M('app_paper_scorerank');
		$paperScoreRankItem = M('app_paper_scorerank_item');
		$rankid = ChkSQL(KS_G('get.id'));
		$Data['title'] = ChkSQL(KS_G('post.title'));
		$Data['isDefault'] = ChkClng(KS_G('post.isdisplay'));
		$Data['orderId'] = ChkClng(KS_G('post.orderId'));
		$paperScoreRank->update($Data,"rankid = $rankid");
		$itemTitle=ChkSQL(KS_G('post.itemTitle'));
		$minscore=ChkSQL(KS_G('post.minscore'));
		$maxscore=ChkSQL(KS_G('post.maxscore'));
		$score=ChkSQL(KS_G('post.score'));
		$itemId = ChkSQL(KS_G('post.itemId'));
		$itemOrderId=$_POST['itemOrderId'];
		foreach($itemId as $k=>$v){
			$Data[$k]['itemTitle'] = $itemTitle[$k];
			$Data[$k]['minscore'] = $minscore[$k];
			$Data[$k]['maxscore'] = $maxscore[$k];
			$Data[$k]['score'] = $score[$k];
			$Data[$k]['itemOrderId'] = $itemOrderId[$k];
			$Data[$k]['rankid'] = $rankid;
			$paperScoreRankItem->update($Data[$k],'itemId='.$v);
		}
		$url1=M_URL($this->AppName.'/Index','scoreRank','',GP(''));
		$html = "<script>location.href='".$url1."';</script>";
		echo $html;exit; 
	}
	//进行分数等级删除
	public function delScoreRankRankAction(){
		$id = KS_G('get.id');
		$paperScoreRank = M('app_paper_scorerank');
		$paperScoreRankItem = M('app_paper_scorerank_item');
		$paperScoreRank->delete('rankid='.$id);
		$paperScoreRankItem->delete('rankid='.$id);
		$url1=M_URL($this->AppName.'/Index','scoreRank','',GP(''));
		KS_INFO("删除",0,$url1);
	}
	//进入题库管理
    public function TkIndexAction(){
		$tkModel= M('app_paper_tk');
		$CategoryModel = new CategoryModel('app_category');
		$courseModel = new CourseModel('app_course');
		$papertypeModel = M('app_paper_type');
		$where= ' where 1=1';
		if($this->isweb !==''){
		    $papertype = $papertypeModel->getAll('where  isdisplay = 1 order by orderid','id,typeName');
		    $category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
			//分类
	        $categoryid=null !==GF('categoryid') ? GF('categoryid'):0;
		    if($categoryid!=0) {
		    $where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";
		    }	
		    //类型
		    $papertypeid=null !==GF('papertypeid') ? GF('papertypeid'):0;
		    if($papertypeid!=0) {$where .= ' and  a.paperTypeId='.$papertypeid;}		
	    }
	    //关键字
	    $keyword = ChkSQL(KS_S('keyword'));
		$keytype=null !==GF('keytype') ? GF('keytype'):0;
	    if(!empty($keyword)){if($keytype==1){$where.=" and a.options like '%$keyword%'";}}	
		$where='as a left join  '.$CategoryModel->table.' as b on a.categoryid = b.categoryid'. $where;
		//分页
		$options = $tkModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$tk = $tkModel->getPage($page,'a.tkid desc',$where,'b.*,a.*');
		//课程名
		foreach($tk as $k=>$v){
			$tk[$k]['coursename'] = $courseModel->getOne('title','where courseid='.$v['courseid']);
		}
		include  CURR_VIEW_PATH . "tk_index.php";
	}
	//进入题库
	public function addTkAction(){
		$tkid = ChkClng(KS_G('get.id'));	
		$papertypeModel = M('app_paper_type');
	    if($this->userid!=''){
		    $where=' userid='.$this->userid;	
			$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		}else{
			$this->userid = 0; 
			$where =' userid= 0';
			$userModel = M('common_user');
		    $this->userinfo = $userModel->getRow('where userid=0 limit 1');
			$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		}	
		$papertypeModel = M('app_paper_type');
	    $papertype      = $papertypeModel->getAll('where '.$where.' and isdisplay = 1 order by orderid','id,typeName');
		$paperScoreRank = M('app_paper_scorerank');
		$ScoreRank = $paperScoreRank->getAll('where '.$where);
		$config = array('inputname'  =>  'categoryid',);
	    $Linkage = Linkage($config,$category);
		$stem1 = ks_editor('stem1');
		$stem2 = ks_editor('stem2');
		$analysis2 = ks_editor('$analysis2');
		$stem3 = ks_editor('stem3');
		$stem4 = ks_editor('stem4');
		include  CURR_VIEW_PATH . "tk_add.php";	
	}
	//题库进行增加
	public function doAddTkAction(){
		$tkModel = M('app_paper_tk');
		$Data['tktype'] = ChkClng(KS_G('post.tkType'));
		$Data['userid'] = $this->userid;
		$Data['categoryid'] = ChkClng(KS_G('post.categoryid'));
		$Data['courseid']   = ChkClng(KS_G('post.courseid'));
		$Data['chapterid']  = ChkClng(KS_G('post.chapterid'));
		$Data['level'] = ChkClng(KS_G('post.level'));
		$Data['paperTypeId'] = ChkClng(KS_G('post.paperTypeId'));
		$userModel = M('common_user');
		$Data['inputer'] = $userModel->getOne('username','where userid ='.$this->userid);
		if($Data['tktype'] == 1){
			$stem1  = ChkSQL(KS_G('post.stem1'));
			$select = ChkSQL(KS_G('post.select'));
			$select = implode("|-|", $select); 
			$Data['options'] = $stem1.'$$$'.$select;
			$Data['anser'] = ChkSQL(KS_G('post.anser1'));
		}elseif($Data['tktype'] == 2){
			$Data['options']  = ChkSQL(KS_G('post.stem2'));
			$Data['anser']    = ChkSQL(KS_G('post.anser2'));
			$Data['analysis'] = ChkSQL(KS_G('post.analysis2'));			
		}elseif($Data['tktype'] == 3){
			$Data['options'] = ChkSQL(KS_G('post.stem3'));
			$Data['anser'] = ChkSQL(KS_G('post.anser3'));
			$Data['analysis'] = ChkSQL(KS_G('post.analysis3'));
		}elseif($Data['tktype'] ==4){
			$Data['options'] = ChkSQL(KS_G('post.stem4'));
			$anser =  ChkSQL(KS_G('post.anser4'));
			$keyword = ChkSQL(KS_G('post.keyword'));
			$Data['anser'] = $anser.'$$$'.$keyword;
			$Data['analysis'] = ChkSQL(KS_G('post.analysis4'));
		}
		$Rule['options'] = '题目|isEmpty';
		$Rule['anser'] = '答案|isEmpty';
		Chkpost($Data,$Rule,$tkModel);
		$tkModel->doAdd($Data,'tkid');
		$url1=M_URL($this->AppName.'/Index','TkIndex','',GP(''));
		KS_INFO("添加成功",0,$url1);
	}
	//进入编辑页面
	public function editTkAction(){
		$now_page = ChkClng(KS_S('p',1));
		$tkModel  = M('app_paper_tk');
		$tkid     = ChkClng(KS_G('get.id'));
		$tk       = $tkModel->getRow('where tkid='.$tkid.' limit 1');
		//分类
		$config   = array('inputname'  =>  'categoryid','categoryid'  =>   $tk['categoryid'],);
		$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		$Linkage  = Linkage($config,$category);
		//课程
		$courseModel = new CourseModel('app_course'); 
		$course = $courseModel->getAll('where courseid='.$tk['courseid'],'courseid,title');
		//章节 
		$chaptertable = $courseModel->getOne('chaptertable','where courseid = '.$tk['courseid'].' limit 1');
		$chapterModel = M($chaptertable);
		$chapter = $chapterModel->getAll('where courseid = '.$tk['courseid'],'chapterid,title,depth');
		//类型
		$papertypeModel = M('app_paper_type');
		$papertype = $papertypeModel->getAll('where userid = '.$tk['userid']);
		if($tk['tktype'] == 1){
			$stem1 = explode('$$$',$tk['options']);
			$stem = $stem1[0];$select = $stem1[1];
			$select = explode('|-|',$select);
			$anser1 = $tk['anser'];
			$stem1 = ks_editor('stem1',$stem);
		}elseif($tk['tktype'] == 2){
			$stem2 = $tk['options'];$anser2 = $tk['anser'];
			$analysis2 = ks_editor('$analysis2',$tk['analysis']);
			$stem2 = ks_editor('stem2',$stem2);
		}elseif($tk['tktype'] == 3){
			$stem3 = $tk['options'];$anser3 = $tk['anser'];
			$analysis3 = $tk['analysis'];
			$stem3 = ks_editor('stem1',$stem3);
		}elseif($tk['tktype'] == 4){
			$stem4 = $tk['options'];
			$anser = explode('$$$', $tk['anser']);
			$anser4 = $anser[0];$ketword = $anser[1];
			$analysis4 = $tk['analysis'];
			$stem4 = ks_editor('stem1',$stem4);
		}
		include  CURR_VIEW_PATH . "tk_add.php";	
	}
	//题库的删除
	public function delTkAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$tkModel  = M('app_paper_tk');
		$tkid     = ChkClng(KS_G('get.id'));
		$tkModel->delete('tkid='.$tkid);
		$url = M_URL($this->AppName.'/Index','TkIndex','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	//批量删除
	public function batchDelTkAction(){
		$tkModel = M('app_paper_tk');
		$tkid    = ChkSQL(KS_G('post.id'));
		foreach($tkid as $v){$tkModel->delete('tkid='.$v);}
		KS_INFO("删除成功");
	}
	//进行编辑
	public function doeditTkAction(){
		$tkModel  = M('app_paper_tk');
		$now_page =  ChkClng(KS_S('p',1));
		$tkid     = ChkClng(KS_G('get.id'));
		$Data['tktype']     = ChkClng(KS_G('post.tkType'));
		$Data['categoryid'] = ChkClng(KS_G('post.categoryid'));
		$Data['courseid']   = ChkClng(KS_G('post.courseid'));
		$Data['chapterid']  = ChkClng(KS_G('post.chapterid'));
		$Data['level']      = ChkClng(KS_G('post.level'));
		if($Data['tktype'] == 1){
			$stem1  = ChkSQL(KS_G('post.stem1'));
			$select = ChkSQL(KS_G('post.select'));
			$select = implode("|-|", $select); 
			$Data['options'] = $stem1.'$$$'.$select;
			$Data['anser'] = ChkSQL(KS_G('post.anser1'));		
		}elseif($Data['tktype'] == 2){
			$Data['options']  = ChkSQL(KS_G('post.stem2'));
			$Data['anser']    = ChkSQL(KS_G('post.anser2'));
			$Data['analysis'] = ChkSQL(KS_G('post.analysis2'));
		}elseif($Data['tktype'] == 3){
			$Data['options']  = ChkSQL(KS_G('post.stem3'));
			$Data['anser']    = ChkSQL(KS_G('post.anser3'));
			$Data['analysis'] = ChkSQL(KS_G('post.analysis3'));	
		}elseif($Data['tktype'] ==4){
			$Data['options'] = ChkSQL(KS_G('post.stem4'));
			$anser   = ChkSQL(KS_G('post.anser4'));
			$keyword = ChkSQL(KS_G('post.keyword'));
			$Data['anser'] = $anser.'$$$'.$keyword;
			$Data['analysis'] = ChkSQL(KS_G('post.analysis4'));
		}
		$tkModel->update($Data,"tkid=$tkid");
		$url1=M_URL($this->AppName.'/Index','TkIndex','',GP('p-'.$now_page));
		KS_INFO("保存成功",0,$url1);
	}
	//进入制作试卷
	public function paperAddTkAction(){
		$paperid     = ChkClng(KS_G('get.id'));
		$exam_type   = $this->AppModel->getOne('exam_type','where paperid = '.$paperid);
		$tmTypeModel = M('app_paper_tmtype');
		$tmType = $tmTypeModel->getAll('where paperid ='. $paperid .' order by orderId');
		if($exam_type==1){
			include  CURR_VIEW_PATH . "paper_addTk2.php";	
		}else{
			include  CURR_VIEW_PATH . "paper_addTk1.php";	
		}
    }
	//添加题型
	public function addTmtypeAction(){
		$paperid = ChkClng(KS_G('get.id'));
		$tmTypeModel = M('app_paper_tmtype');
		$orderid = $tmTypeModel -> getMaxValue('orderId','paperid = '.$paperid);
		$Data['orderId'] = $orderid+1;
		$userid = $this->AppModel->getOne('userid','where paperid = '.$paperid);
		$Data['userid']  = $this->userid;
		$Data['paperid'] = $paperid;
		$Data['tktype']  = ChkClng(KS_G('post.tktype'));
		$Data['score']   = ChkClng(KS_G('post.score'));
		$Data['title']   = ChkSQL(KS_G('post.title'));
		$Data['score']   = ChkClng(KS_G('post.score'));
		$level           =  KS_G('post.level');
		if(!empty($level)){$Data['level'] = ChkClng($level);}
		$papertype = KS_G('post.papertype');
		if(!empty($papertype)){$Data['papertypeid'] = ChkClng($papertype);}
		$number = KS_G('post.number');
		if(!empty($number)){
			$Data['number'] = ChkClng($number);
			$Rule['number'] = '每题分数|isEmpty,isnumber';
		}
		$Data['intro'] = ChkSQL(KS_G('post.intro'));
		$Data['isRnd'] = 0;
		$Rule['title'] = '显示为|isEmpty';
		Chkpost($Data,$Rule,$tmTypeModel);
		$tmTypeModel->doAdd($Data,'typeId');
		$url1 = M_URL($this->AppName.'/Index','paperAddTk',$paperid,GP(''));
		KS_INFO("添加成功",0,$url1);
	}
	//删除题型
	public function delTmtypeAction(){
		$typeid = ChkClng(KS_G('get.id'));
		$tmTypeModel = M('App/PaperModel/app_paper_tmtype');
		$tmType = $tmTypeModel->getRow('where typeId ='. $typeid .' limit 1');
		$tmTypeModel->updateOrderid($tmType);//排在之后的 Orderid -1
		$tmTypeModel->delete('typeId='.$typeid);
		$paperid = null !==GF('paperid') ? GF('paperid'):'';
		$url1=M_URL($this->AppName.'/Index','paperAddTk',$paperid,GP(''));
		KS_INFO("删除成功",0,$url1);
	}
	public function tmtypeBatchAction(){
		$paperid = ChkClng(KS_G('get.id'));
		$title = ChkSQL(KS_G('post.title'));
		$score = ChkSQL(KS_G('post.score'));
		$number = ChkSQL(KS_G('post.number'));
		$id = ChkSQL(KS_G('post.id'));
		$tmTypeModel = M('app_paper_tmtype');
		foreach($id as $k=>$v){
			if(!empty($number)){$Data['number'] = $number[$k];}
			$Data['title'] = $title[$k];
			$Data['score'] = $score[$k];
		    $tmTypeModel->update($Data,'typeId = '.$v);
	    }
		$url1 = M_URL($this->AppName.'/Index','paperAddTk',$paperid,GP(''));
		$html = "<script>location.href='".$url1."';</script>";
	    echo $html;exit;  
	}
	//题型排序上升
    public function upOrderidAction(){
		$typeid  = ChkClng(KS_G('get.id'));
		$paperid = null !==GF('paperid') ? GF('paperid'):'0';
		$tmTypeModel = M('app_paper_tmtype');
		$orderId = $tmTypeModel->getOne('orderId','where typeId ='.$typeid);
		$typeid2 = $tmTypeModel->getOne('typeId','where orderId ='.($orderId-1).' and paperid = '.$paperid);
		$Data2['orderId'] = $orderId;
		$Data['orderId']  = $orderId-1;
		$tmTypeModel->update($Data,'typeId ='.$typeid);
		$tmTypeModel->update($Data2,'typeId = '.$typeid2);
		$url1  = M_URL($this->AppName.'/Index','paperAddTk',$paperid,GP(''));
		$html  = "<script>location.href='".$url1."';</script>";
	    echo $html;exit;  
	}
	//排序下降
	public function downOrderidAction(){
		$typeid  = ChkClng(KS_G('get.id'));
		$paperid = null !==GF('paperid') ? GF('paperid'):'0';
		$tmTypeModel = M('app_paper_tmtype');
		$orderId = $tmTypeModel->getOne('orderId','where typeId = '.$typeid);
		$typeid2 = $tmTypeModel->getOne('typeId','where orderId = '.($orderId+1).' and paperid = '.$paperid);
		$Data2['orderId'] = $orderId;
		$Data['orderId']  = $orderId+1;
		$tmTypeModel->update($Data,'typeId = '.$typeid);
		$tmTypeModel->update($Data2,'typeId = '.$typeid2);
		$url1=M_URL($this->AppName.'/Index','paperAddTk',$paperid,GP(''));
		$html = "<script>location.href='".$url1."';</script>";
		echo $html;exit;  	
	}
	//进入试卷添加试题
	public function tkListAction(){
		$typeid      = ChkClng(KS_G('get.id'));
		$tmTypeModel = M('app_paper_tmtype');
		$tmType = $tmTypeModel->getRow('where typeId ='.$typeid.' limit 1');
		$paper  = $this->AppModel->getRow('where paperid ='.$tmType['paperid'].' limit 1');
		$tkModel= M('app_paper_tk');
		$papertypeModel = M('app_paper_type');
		$papertype = $papertypeModel->getAll('where userid = '.$paper['userid']);
		$selectTk = explode(',',$tmType['tkIds']);
		if(empty($_COOKIE['selectTk'])){
			setcookie("selectTk",$tmType['tkIds'],time()+3600*24);
		}
		//对应章节
		$courseModel  = new CourseModel('app_course');
		$chaptertable = $courseModel->getOne('chaptertable','where courseid = '.$paper['courseid'].' limit 1');
		$chapterModel = M($chaptertable);
		$tktype  = null !==GF('tktype') ? GF('tktype'):'0';
		$tklevel = null !==GF('tklevel') ? GF('tklevel'):'0';
		$papertypeid = null !==GF('papertypeid') ? GF('papertypeid'):'0';
		$keyword = KS_S('keyword');
		$where   = "";
		if(!empty($tktype)){$where.='  and a.tktype = '.$tktype;}
		if(!empty($tklevel)){$where.='  and a.level = '.$tklevel;}
		if(!empty($papertypeid)){$where.='  and a.paperTypeId = '.$papertypeid;}
		if(!empty($keyword)){$where.="  and a.options like '%$keyword%'";}
		$where1 ="as a left join $chapterModel->table as b on a.chapterid = b.chapterid where a.courseid = $paper[courseid] and (a.chapterid = $paper[chapterid] or b.parentidpath like '%$paper[chapterid],%') $where";
		$options = $tkModel->getOptions('5',$where1);//分页参数设置
		$page    = Page($options);
		$tk      = $tkModel->getPage($page,'a.tkId desc',$where1,'a.*');
		include  CURR_VIEW_PATH . "tk_list.php";	
	}
	//试卷预览
	public function previewAction(){
	    $now_page       =  ChkClng(KS_S('p',1));
	    $papertypeModel = M('app_paper_type');
	    $tmTypeModel    = M('app_paper_tmtype');
	    $paperid        = KS_G('get.id');
        $tmtype = $tmTypeModel->getAll('where paperid = '.$paperid.' order by orderId');
	    $tkModel= M('app_paper_tk');$tks='';
	    foreach($tmtype as $k=>$v){
			$tm[$k]['tkIds'] =  $v['tkIds'];
			if(!empty($v['tkIds'])){ $tks=$v["tkIds"].','.$tks;}
		   /* $tk[$k]=$tmtype[$k]["tkIds"];*/  
	    }
	    $tks = rtrim($tks,',');
	    if(empty($tks)){$url1=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO("暂无题目",0,$url1);}
	    $tk = $tkModel->getAll("where tkid in ( $tks )");
	    include  CURR_VIEW_PATH . "previewPaper.php";	
	}
	//试卷添加试题
	public function dopaperAddTkAction(){
		$typeid        = ChkClng(KS_G('get.id'));
		$tkid          = ChkSQL(KS_G('post.tkid'));
		$tmTypeModel   = M('app_paper_tmtype');
		$Data['tkIds'] = $_COOKIE['selectTk'];
		$tmTypeModel->update($Data,'typeId='.$typeid);
		$paperid = $tmTypeModel->getOne('paperid','where typeId='.$typeid);
		$url2=M_URL($this->AppName.'/Index','paperAddTk',$paperid,GP(''));
		$html = "<script>parent.location.href='".$url2."';</script>";
		echo $html;exit;  
	}
	public function selectUserAction(){
		$addtype = null !==GF('addtype') ? GF('addtype'):''; 
		$keyword = KS_S('keyword');
		$keytype = null !==GF('keytype') ? GF('keytype'):'';
		if(!empty($keyword)){$where=" and a.name like '%$keyword%'";}
		else{$where = '';} 
		if($keytype ==1){$userModel = M('common_user_school');}
		else{$userModel = M('common_user_teacher');}
		$Model = M('common_user');
		$where = "as a left join $Model->table as b on a.userid = b.userid where parentid = 0 $where" ;
		//分页
		$options = $userModel->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $userModel->getPage($page,'a.userid desc',$where);
		include  CURR_VIEW_PATH . "selectUser.php";
	}
}