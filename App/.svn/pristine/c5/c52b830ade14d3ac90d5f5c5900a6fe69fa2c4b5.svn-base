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
		$teacherModel = M('common_user_teacher');
		$wxModel = M('common_user_website');
		//状态
		$stat=KS_S('status',3);
		if($stat==3){$where= 'where a.userid!=4 and a.userid!=0 and a.wxid!=1 and a.status !=-1';}
		elseif($stat==4){$where= 'where a.userid!=4 and a.userid!=0 and a.wxid!=1 and (a.status=1 or a.status=2)';} //已审核
		elseif($stat==0){$where= 'where a.userid!=4 and a.userid!=0 and a.wxid!=1 and a.status=0';}                 //未审核
        elseif($stat==5){$where= 'where a.userid!=4 and a.userid!=0 and a.wxid!=1 and a.status=-1';}                //回收站

        if($stat==6){  //分销
			$db_user = M('common_user');
			$wxid    = $db_user->getAll('where inviter!="" and parentid=0','wxid');
			$str     = 0;
			foreach($wxid as $k => $v){$str.=','.$v['wxid'];}
			$where = $where.' and a.wxid in ('.$str.')  and a.wxid!=0';
		}
        //课程类型
		$coursetype=null !==GF('coursetype') ? GF('coursetype'):0;
		if($coursetype != 0){$where.=" and courseType =$coursetype ";}
		$m   = mktime(0,0,0,date('m'),1,date('Y'));
		$day =  mktime(0,0,0,date('m'),date('d'),date('Y'));

		$keyword = KS_S('keyword');
		$keytype = null !==GF('keytype') ? GF('keytype'):0;
        if(!empty($keyword)){
			if($keytype==1){$where.=" and a.title like '%$keyword%'";}
			elseif($keytype==2){$where.=" and a.wxid=$keyword";}
		}
 		$where = "as a left join $teacherModel->table as b on a.userid = b.userid left join $wxModel->table as c on a.wxid=c.wxid $where ";

 		$montncount = $this->AppModel->getOne('count(courseid)',$where.' and adddate>'.$m);
		$daycount = $this->AppModel->getOne('count(courseid)',$where.' and adddate>'.$day);

		$options = $this->AppModel->getOptions('50',$where);//分页参数设置
		$page    = Page($options);
		$values  = $this->AppModel->getPage($page,'courseid desc',$where,'b.name,a.*,c.sitename');
		//计算老师数量
		$db_teacher = M('app_course_teacherrelate');
		foreach($values as $key => $value) {
			$chapterModel = M($value['chaptertable']);
		    $values[$key]['keshicount']   = $chapterModel->getOne('count(*)','where  courseid ='.$value['courseid'].' and depth = 3');
			$values[$key]['defaultpic']   = empty(Img($value['defaultpic']))?nopic(12):Img($value['defaultpic']);
			$values[$key]['teachercount'] = $db_teacher->getOne('count(id)','where courseid='.$value['courseid']);
			if($value['courseType']==1){
				$values[$key]['typetitle'] = '点播';
			}elseif($value['courseType']==2){
				$values[$key]['typetitle'] = '直播';
			}elseif($value['courseType']==3){
				$values[$key]['typetitle'] = '音频';
			}elseif($value['courseType']==4){
				$values[$key]['typetitle'] = '图文';
			}
            $values[$key]['jumpurl']   = wx_Url($value['wxid']).'/?f=m#/course/'.$value['courseid'];
		}
        include  CURR_VIEW_PATH . "index.php";
	}
	public function addcourseAction(){
		include  CURR_VIEW_PATH . "addcourse.php";
	}
	//添加课程
	public function doaddcourseAction(){
		$Data['title']        = ChkSQL(KS_G("post.title"));
		$Data['intro']        = ChkSQL(KS_G("post.intro"));
		$userid = null !==GF('userid') ? GF('userid'):'0';
		$Data['userid']       = $userid;
		$Data['courseType']   = ChkClng(KS_G('post.courseType'));
		$Data['chargetype']   = ChkClng(KS_G('post.chargetype'));
		$Data['price']   = ChkClng(KS_G('post.price'));
		$Data['price_market']   = ChkClng(KS_G('post.price_market'));
		$Data['adddate']      = time();
		$chaptertableModel    = new CourseModel('common_extends_table');
		$Data['chaptertable'] = $chaptertableModel->getOne('tablename','where Isdefault=1 and type =1');
		Chkpost($Data,$Rule,$this->AppModel);
		$Rule['title']        = '课程名称|isEmpty';
		$Rule['chaptertable'] = '章节表出错，请联系管理员|isEmpty';
		$courseid = $this->AppModel->doadd($Data,'courseid');
		$url      = M_URL($this->AppName.'/Index','basics',$courseid,GP(''));
		KS_INFO('添加成功',3,$url);
	}
	//审核
	public function auditedAction(){
		$now_page       = ChkClng(KS_S('p',1));
		$courseid       = ChkClng(KS_G('get.id'));
		$Data['status'] = 2;
		$this->AppModel->update($Data,'courseid='.$courseid);
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO('审核成功',0,$url);
     }
	 //取消审核
	 public function unauditedAction(){
		 $now_page = ChkClng(KS_S('p',1));
         $courseid = ChkClng(KS_G('get.id'));
		 $Data['status'] = 0;
	     $this->AppModel->update($Data,'courseid='.$courseid);
		 $url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		 KS_INFO('取消审核成功',0,$url);
     }
	//删除
	public function  delectAction(){
		 $now_page = ChkClng(KS_S('p',1));
		 $courseid = ChkClng(KS_G('get.id'));
		 $course   = $this->AppModel->getRow('where courseid = '.$courseid.'  limit 1');
		 if($course["chaptertable"]){
		 	$ChapterModel = M($course["chaptertable"]);
		 }

		 //删除上传图片
		 $defaultpic   = $this->AppModel->getOne('defaultpic','where courseid = '.$courseid.'  limit 1');
		 $this->AppModel->delete('courseid='.$courseid);
		 if(isset($ChapterModel)){
		 	 $ChapterModel->delete('courseid='.$courseid);
		 }

		 $this->upload->removefile($defaultpic);
		 $url        = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		 KS_INFO('删除成功',0,$url);
	}
	//批量处理
	public function batchAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$url      = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		$courseid = ChkClng(KS_G('get.id'));
		$courseid = isset($_POST["check"])?$_POST["check"]:'';
		//批量删除
		if(empty($courseid)){KS_INFO('请选择',0,$url,'',1);}
		if(KS_G('post.batch')==1){
			foreach ($courseid as $v ){
				$course   = $this->AppModel->getRow("where courseid = $v limit 1");
		        $ChapterModel = M($course["chaptertable"]);
				$defaultpic=$this->AppModel->getOne('defaultpic',"where courseid = $v limit 1");
				$this->AppModel->delete("courseid=$v");
				$ChapterModel->delete("courseid=$v");
				//删除上传图片

				$this->upload->removefile($defaultpic);
		    }
		    KS_INFO('删除成功',0,$url);
		}
		//通过审核
		if(KS_G('post.batch')==2){
		    $data['status']=2;
		    foreach ($courseid as $v ) {$this->AppModel->update($data, "courseid=$v");}
			KS_INFO('审核成功',0,$url);
		}
		//批量取消审核
		if(KS_G('post.batch')==3){
			$data['status']=0;
			foreach ($courseid as $v ) {$this->AppModel->update($data, 'courseid='.$v);}
			KS_INFO('取消审核成功',0,$url);
		 }
		 if (KS_G('post.batch')==4) {
		 	foreach ($courseid as $v ) {
		 		$info =$this->AppModel->getRow('where courseid='.$v);
		 		if($info){
		 			$Data['audit'] = 1;
					$res = $this->AppModel->update($Data,'courseid='.$v);
			        if($res){
			        	$data001['wxid']=$info['wxid'];
			        	$data001['taskid']=2;
			        	spreadaudit($data001);
			        }
		 		}
		 	}
		 	KS_INFO('分销审核成功',0,$url);
		 }
	}

	// public function changeauditAction(){
	// 	$now_page =  ChkClng(KS_S('p',1));
	// 	$url      = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
	// 	$courseid = ChkClng(KS_G('get.id'));
	// 	$info =$this->AppModel->getRow('where courseid='.$courseid);
	// 	$audit = GF('audit');
	// 	$Data['audit'] = $audit;
	// 	$res = $this->AppModel->update($Data,'courseid='.$courseid);
 //        if($res){
 //        	$data001['wxid']=$info['wxid'];
 //        	$data001['taskid']=2;
 //        	spreadaudit($data001);
 //        }
	// 	KS_INFO('审核成功',0,$url);
	// }
	//进入编辑页面
	public function basicsAction(){
	    $UserModel = M('common_user');
	    // var_dump($this->wxid);exit();
	    $courseid  = ChkClng(KS_G('get.id'));
	    if($this->userid!=''){
			$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		}else{
			$userModel = M('common_user');
		    $this->userinfo = $userModel->getRow('where userid=0 limit 1');
			$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		}
		$Linkage   = Linkage(array(),$category);
	    if(!empty($courseid)){
	        $course = $this->AppModel->getRow('where courseid='.$courseid.' limit 1');
			$Linkage ->inputname  = 'categoryid';
			$Linkage ->categoryid = $course['categoryid'];
	        $user=$UserModel->getRow('where userid='.$course['userid'].' limit 1');
	    }else{
		    $Linkage ->inputname  = 'categoryid';
		}
	    	// var_dump($course);exit();
        include  CURR_VIEW_PATH . "coursebasics.php";
	}
	//添加基本信息
	public function doaddAction(){
        $userid                = null !==GF('userid') ? GF('userid'):'0';
		$Data['userid']        = $userid;
		$Data['title']         = ChkSQL(KS_G("post.title"));
		$Data['categoryid']    = ChkClng(KS_G('post.categoryid'));
		// $Data['enablechapter'] = ChkClng(KS_G('post.enablechapter'));
		$Data['courseType']    = ChkClng(KS_G('post.courseType'));
		$Data['intro']         = ChkSQL(KS_G("post.intro"));
		$Data['chargetype']    = ChkClng(KS_G("post.chargetype"));
		$Data['price_market']  = ChkSQL(KS_G("post.price_market"));
		$Data['discount']      = ChkSQL(KS_G("post.discount"));
		$Data['price']         = ChkSQL(KS_G("post.price"));
		$Data['validedays']    = ChkSQL(KS_G("post.validedays"));
		if(!empty($_FILES['defaultpic']['tmp_name'])){
			$this->upload->savePath = 'school/'.$this->wxid.'/'; // 设置附件上传（子）目录
			$info = $this->upload->uploadOne($_FILES['defaultpic']);
			if(!$info) {KS_INFO($this->upload->getError(),0,'','',1);}// 上传错误提示错误信息
			else{$Data['defaultpic'] = ChkSQL($this->upload->uootPath.$info['savepath'].$info['savename']);}//应用封面图片
		}
		$chaptertableModel    = new CourseModel('common_extends_table');
		$Data['chaptertable'] = $chaptertableModel->getOne('tablename','where Isdefault=1 and type =1');
		$Rule['title']        = '课程名称|isEmpty';
	    $Rule['categoryid']   = '分类|isEmpty';
		$Rule['discount']     = '折扣|isEmpty,isnumber';
		$Rule['price']        = '价格|isEmpty,isnumber';
		$Rule['validedays']   = '剩余天数|isEmpty,isnumber';
		Chkpost($Data,$Rule,$this->AppModel);
		$courseid             = $this->AppModel->doadd($Data,'courseid');
		$url2 = M_URL($this->AppName.'/Index','basics',$courseid,GP(''));
		$url1 = M_URL($this->AppName.'/Index','info',$courseid,GP(''));
		KS_INFO("添加成功,是否继续完善详细信息",1,$url1,$url2);
	}
	//进行修改
	public function doeditAction(){
		$courseid      = ChkClng(KS_G('get.id'));
		$Data['title'] = ChkSQL(KS_G("post.title"));
		$Data['categoryid']    = ChkClng(KS_G('post.categoryid'));
		// $Data['enablechapter'] = ChkClng(KS_G('post.enablechapter'));
		$Data['courseType']    = ChkClng(KS_G('post.courseType'));
		$Data['intro']         = ChkSQL(KS_G("post.intro"));
		$Data['chargetype']    = ChkClng(KS_G("post.chargetype"));
		$Data['price_market']  = ChkSQL(KS_G("post.price_market"));
		$Data['discount']      = ChkSQL(KS_G("post.discount"));
		$Data['price']         = ChkSQL(KS_G("post.price"));
		$Data['validedays']    = ChkSQL(KS_G("post.validedays"));
		if(!empty($_FILES['defaultpic']['tmp_name'])){
			$defaultpic = $this->AppModel->getOne('defaultpic','where courseid = '.$courseid.' limit 1');
			$this->upload->removefile($defaultpic);
			$this->upload->savePath = 'school/'.$this->wxid.'/'; // 设置附件上传（子）目录
			$info = $this->upload->uploadOne($_FILES['defaultpic']);
			if(!$info) {KS_INFO($this->upload->getError(),0,'','',1);}// 上传错误提示错误信息
			else{$Data['defaultpic'] = ChkSQL($this->upload->uootPath.$info['savepath'].$info['savename']);}//应用封面图片
		}
		$Rule['title']      = '课程名称|isEmpty';
		$Rule['categoryid'] = '分类|isEmpty';
		$Rule['discount']   = '折扣|isEmpty';
		$Rule['price']      = '价格|isEmpty';
		$Rule['validedays'] = '剩余天数|isEmpty,isnumber';
		Chkpost($Data,$Rule,$this->AppModel);
		$this->AppModel->update($Data,"courseid=$courseid");
		KS_INFO('保存成功');
	}
	//进入添加编辑详细信息
	public function  infoAction(){
		$courseid     = ChkClng(KS_G('get.id'));
		$course       = $this->AppModel->getRow("where courseid = $courseid limit 1");
		// var_dump($course );
		$teacherModel = new CourseModel('common_user_teacher');
		$teacherRelaetModel = new CourseModel('app_course_teacherrelate');
		$speaker = $teacherModel -> getAll("as a left join $teacherRelaetModel->table as b on a.userid=b.teacherid where b.courseid = $courseid");
	    include  CURR_VIEW_PATH . "courseinfo.php";
	}
	//添加详细信息
	public function  doaddinfoAction(){
		$courseid          = ChkClng(KS_G('get.id'));
		$course            = $this->AppModel->getRow('where courseid ='.$courseid.' limit 1');
		$Data['recommend'] = ChkClng(KS_G('post.recommend'));
		$Data['slide']     = ChkClng(KS_G('post.slide'));
		$Data['content']   = ChkSQL(KS_G("post.content"));
		$Data['announce']  = ChkSQL(KS_G("post.announce"));
		$Data['teacherid'] = ChkClng(KS_G('post.speaker'));
		$Rule['teacherid'] = '主讲老师|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);
		$this->AppModel->update($Data,"courseid=$courseid");
		$teachers          = new CourseModel('app_course_teacherrelate');
		$teachers->delete('courseid='.$courseid);
		//添加主讲老师
		$Data_speaker['teacherid'] = $Data['teacherid'];
		$Data_speaker['userid']    = $course['userid'];
		$Data_speaker['courseid']  = $courseid;
		$Data_speaker['isspeaker'] = 1;
		$teachers->doadd($Data_speaker,'id');
		//添加讲师
		$docent = ChkSQL(KS_G("post.docent"));
		if(!empty($docent)){
			$Data_Docent['courseid'] = $courseid;
			$Data_Docent['userid'] = $course['userid'];
			$Data_Docent['isspeaker'] = 0;
			foreach($docent as $k=>$v){
				ChkClng($v);
				$Data_Docent['teacherid'] = $v;
				$teachers->doadd($Data_Docent,'id');
            }
        }
        KS_INFO("保存成功");
	}
	//添加讲师
	public function addDocentAction(){
		$courseid      = ChkClng(KS_G('get.id'));
		$userid        = $this->AppModel->getOne('userid','where courseid ='.$courseid);
		$UserModel     = new CourseModel('common_user');
		//读出用户分类缓存
		$userscategory = $this->cache->GetACache('userscategory');
		//分页查询数据
		$options       = $UserModel->getTeacherOptions('5',$userid);
		$page          = new page($options);
		$teachers      = $UserModel->getTeacherPage($page,$userid);
		include  CURR_VIEW_PATH . "addDocent.php";
	}
	//进入添加编辑seo信息
	public function  seoAction(){
		$fieldModel  = new CourseModel('common_table_field');
		$Field       = $fieldModel->getAll("where appid=$this->appid and mustinput = 1 and status=1 order by orderid");
		$Linkage     ='';
		$courseid    = ChkClng(KS_G('get.id'));
		$courseModel = new CourseModel('app_course');
		if(!empty($courseid)){
		     $course=$this->AppModel->getRow("where courseid=$courseid limit 1");
		}
        include  CURR_VIEW_PATH . "courseseo.php";
	}
	//进入课时页面
	public function periodAction(){
		$courseid     =  ChkClng(KS_G('get.id'));
		$course       = $this->AppModel->getRow("where courseid = $courseid limit 1");
		$ChapterModel = new CourseModel($course["chaptertable"]);
		$where        = "where  courseid = $courseid and parentid=0";
		$options      = $ChapterModel->getOptions('5',$where);//分页参数设置
		$page         = Page($options);
		$chapter      = $ChapterModel->getPage($page,'root',$where);
		foreach($chapter as $k=>$v){
			 if($v["child"]>0){
				 $chapter[$k]['Section'] = $ChapterModel->getAll("where  courseid = $courseid and parentid=$v[chapterid] order by orderid ");
				 foreach($chapter[$k]['Section'] as $kt=>$vt){
				     $chapter[$k]['Section'][$kt]['keshi'] = $ChapterModel->getAll("where courseid = $courseid and parentid=$vt[chapterid] order by orderid ");
				 }
		     }
		}
        include  CURR_VIEW_PATH . "period.php";
	}
	//进入增加章
	public function addchapterAction(){
		$now_page     = ChkClng(KS_S('p',1));
		$courseid     = ChkClng(KS_G("get.id"));
		$chaptertable = $this->AppModel->getOne('chaptertable',"where courseid=$courseid");
		$ChapterModel = new CourseModel($chaptertable);
		$chapterid    = null !==GF('chapterid') ? GF('chapterid'):'0';
		$chapter      = $ChapterModel->getRow("where chapterid=$chapterid limit 1");
		include  CURR_VIEW_PATH . "addchapter.php";
	}
	//增加章
	public function doaddchapterAction(){
		$userid           = null !==GF('userid') ? GF('userid'):'0';
		$courseid         = ChkClng(KS_G("get.id"));
		$chaptertable     = $this->AppModel->getOne('chaptertable',"where courseid=$courseid");
		$ChapterModel     = new CourseModel($chaptertable);
		$Data['userid']   = ChkClng($userid);
		$Data['courseid'] = ChkClng(KS_G('get.id'));
		$Data['parentid'] = 0;
		$Data['chaptertype'] = 0;
		$Data['title'] = ChkSQL(KS_G("post.title"));
		$Data['Price'] = ChkSQL(KS_G("post.price"));
		$Rule['title'] = '章节名字|isEmpty';
		Chkpost($Data,$Rule,$ChapterModel);
		$ChapterModel->doaddChapter($Data,'chapterid');
		$url2 = M_URL($this->AppName.'/Index','period',$courseid,GP(''));
		KS_INFO('添加成功',3,$url2);
	}
    //编辑章/节
    public function doeditchapterAction(){
	    $now_page      =  ChkClng(KS_S('p',1));
	    $courseid      = ChkClng(KS_G("get.id"));
	    $chaptertable  = $this->AppModel->getOne('chaptertable',"where courseid=$courseid");
	    $ChapterModel  = new CourseModel($chaptertable);
		$chapterid     = null !==GF('chapterid') ? GF('chapterid'):'0';
		$Data['title'] = ChkSQL(KS_G("post.title"));
		$Rule['title'] = '章节名字|isEmpty';
	    Chkpost($Data,$Rule,$ChapterModel);
		$ChapterModel->update($Data,"chapterid=$chapterid");
		$url2 = M_URL($this->AppName.'/Index','period',$courseid,GP('p-'.$now_page));
		KS_INFO('保存成功',3,$url2);
	}
	//进入增加节
	public function addsectionAction(){
		$now_page     =  ChkClng(KS_S('p',1));
		$chapterid    = null !==GF('chapterid') ? GF('chapterid'):'0';
		$courseid     = ChkClng(KS_G("get.id"));
		$chaptertable = $this->AppModel->getOne('chaptertable',"where courseid=$courseid");
		$ChapterModel = new CourseModel($chaptertable);
		$chapterAll   = $ChapterModel->getAll("where  courseid = $courseid and depth=1 order by root,orderid ");
		$chapter      = $ChapterModel->getRow("where chapterid=$chapterid limit 1");
		$chapterid    = $chapter["parentid"];
		include  CURR_VIEW_PATH . "addSection.php";
	}
	//增加章节
	public function doaddsectionAction(){

		$courseid=ChkClng(KS_G("get.id"));
		$chaptertable=$this->AppModel->getOne('chaptertable',"where courseid=$courseid");
		$ChapterModel = new CourseModel($chaptertable);
		$userid=null !== GF('userid') ? GF('userid'):'0';
		$Data['userid'] = ChkClng($userid);
		$Data['courseid'] = ChkClng(KS_G('get.id'));
		$Data['chaptertype'] = 0;
		$Data['parentid']=ChkClng(KS_G('post.parentid'));
		$Data['title']=ChkSQL(KS_G("post.title"));
		$Rule['title'] = '章节名字|isEmpty';
		Chkpost($Data,$Rule,$ChapterModel);
		$ChapterModel->doaddSection($Data,'chapterid');
		$url2=M_URL($this->AppName.'/Index','period',$courseid,GP(''));
		KS_INFO('添加成功',3,$url2);
	}
	//进入编辑 节
	public function editsectionAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$chapterid=null !==GF('chapterid') ? GF('chapterid'):'0';
		$courseid=ChkClng(KS_G("get.id"));
		$chaptertable=$this->AppModel->getOne('chaptertable',"where courseid=$courseid");
		$ChapterModel = new CourseModel($chaptertable);
		$chapterAll = $ChapterModel->getAll("where  courseid = $courseid and depth=1 order by root,orderid ");
		include  CURR_VIEW_PATH . "addSection.php";
	}
	//进入增加课时
	public function addkeshiAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$chapterid=null !==GF('chapterid') ? GF('chapterid'):'';
		$courseid=ChkClng(KS_G("get.id"));
		$typeKeshi = 'add';
		$course=$this->AppModel->getRow('where courseid='.$courseid.' limit 1');
		$type = $course['courseType'];
		$ChapterModel = new CourseModel($course['chaptertable']);
		$chapterAll = $ChapterModel->getAll('where  courseid = '.$courseid.' and (depth=1 or depth=2) order by root,orderid ');
		$parentid = $chapterid;
		/* if(!empty($chapterid)){
		$chapter= $chapter=$ChapterModel->getRow('where chapterid='.$chapterid.' limit 1');
		$type = $chapter['chaptertype'];
		$chapterid=$chapter["parentid"];
		$kptionModel = M('app_knowledge');
		$values= $kptionModel->getAll('where id in ('.$chapter['kpointIds'].')','id,title');
		}*/
		include  CURR_VIEW_PATH . "addkeshi.php";
	}
	//进入修改课时
	public function editkeshiAction(){
		$typeKeshi = 'edit';
		$now_page  =  ChkClng(KS_S('p',1));
		$chapterid=null !==GF('chapterid') ? GF('chapterid'):'0';
		$courseid=ChkClng(KS_G("get.id"));
		$course=$this->AppModel->getRow('where courseid='.$courseid.' limit 1');
		$type=$course['courseType'];
		$ChapterModel = new CourseModel($course['chaptertable']);
		$chapterAll = $ChapterModel->getAll('where  courseid = '.$courseid.' and (depth=1 or depth=2) order by root,orderid ');
		$chapter= $chapter=$ChapterModel->getRow('where chapterid='.$chapterid.' limit 1');
		$parentid = $chapter['parentid'];
		$kptionModel = M('app_knowledge');
		$values= $kptionModel->getAll('where id in ('.$chapter['kpointIds'].')','id,title');
		include  CURR_VIEW_PATH . "addkeshi.php";
	}
	//修改课时
	public function doeditkeshiAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$chapterid = null !==GF('chapterid') ? GF('chapterid'):'0';
		$courseid = ChkClng(KS_G("get.id"));
		$chaptertable = $this->AppModel->getOne('chaptertable','where courseid='.$courseid.' limit 1');
		$ChapterModel = new CourseModel($chaptertable);
		$Data['chaptertype'] =ChkClng(KS_G('post.chaptertype'));
		$Data['parentid']=ChkClng(KS_G('post.parentid'));
		$Data['title']=ChkSQL(KS_G("post.title"));
		$Data['intro']=ChkSQL(KS_G("post.intro"));
		$kpoint = ChkSQL(KS_G('post.kpoint'));
		if(!empty($kpoint)){$Data['kpointIds'] = implode(',',$kpoint);}
		if($Data['chaptertype']==1){
			$Data['validedays']=ChkClng(KS_G("post.validedays"));
			$Data['playtype']=ChkClng(KS_G("post.playtype"));
			$Data['playtime']=ChkSQL(KS_G("post.playtime1"));
			$Data['videoId']=ChkSQL(KS_G("post.playurl1"));
		}elseif($Data['chaptertype']==2){
			$Data['validedays']=ChkClng(KS_G("post.playtime2"));
			$Data['serverid']=ChkClng(KS_G("post.serverid"));
			$Data['begindate']=ChkSQL(KS_G("post.begindate2"));
			$Data['enddate']=ChkSQL(KS_G("post.enddate2"));
		}elseif($Data['chaptertype']==3){
			$Data['begindate']=ChkSQL(KS_G("post.begindate2"));
			$Data['enddate']=ChkSQL(KS_G("post.begindate2"));
		}
		$Rule['title'] = '章节名字|isEmpty';
		Chkpost($Data,$Rule,$ChapterModel);
		$ChapterModel->update($Data,"chapterid=$chapterid");
		$url2 = M_URL($this->AppName.'/Index','period',$courseid,GP('p-'.$now_page));
		$html = "<script>parent.location.href='".$url2."';</script>";
		echo $html;exit;
	}
	//增加课时
	public function doaddkeshiAction(){
		$courseid=ChkClng(KS_G("get.id"));
		$chaptertable=$this->AppModel->getOne('chaptertable','where courseid='.$courseid.' limit 1');
		$ChapterModel = new CourseModel($chaptertable);
		$Data['userid'] = $this->userid;
		$Data['courseid'] =$courseid;
		$Data['chaptertype'] =ChkClng(KS_G('post.chaptertype'));
		$Data['parentid']=ChkClng(KS_G('post.parentid'));
		$Data['title']=ChkSQL(KS_G("post.title"));
		$Data['intro']=ChkSQL(KS_G("post.intro"));
		$kpoint = ChkSQL(KS_G('post.kpoint'));
		if(!empty($kpoint)){$Data['kpointIds'] = implode(',',$kpoint);}
		if($Data['chaptertype']==1){
			$Data['validedays']=ChkClng(KS_G("post.validedays"));
			$Data['playtype']=ChkClng(KS_G("post.playtype"));
			$Data['playtime']=ChkSQL(KS_G("post.playtime1"));
			$Data['videoId']=ChkSQL(KS_G("post.playurl1"));
		}elseif($Data['chaptertype']==2){
			$Data['validedays']=ChkClng(KS_G("post.playtime2"));
			$Data['serverid']=ChkClng(KS_G("post.serverid"));
			$Data['begindate']=ChkSQL(KS_G("post.begindate2"));
			$Data['enddate']=ChkSQL(KS_G("post.enddate2"));
		}elseif($Data['chaptertype']==3){
			$Data['begindate']=ChkSQL(KS_G("post.begindate2"));
			$Data['enddate']=ChkSQL(KS_G("post.begindate2"));
		}
		$Rule['title'] = '章节名字|isEmpty';
		Chkpost($Data,$Rule,$ChapterModel);
		$ChapterModel->doaddkeshi($Data,'chapterid');
		$url2=M_URL($this->AppName.'/Index','period',$courseid,GP(''));
		KS_INFO('增加成功',0,$url2);
	}
	//预览视频
	public function viewplayAction(){
		$chapterid=null !==GF('chapterid') ? GF('chapterid'):'0';
		$courseid=ChkClng(KS_G("get.id"));
		$course=$this->AppModel->getRow('where courseid='.$courseid.' limit 1');
		$ChapterModel = new CourseModel($course['chaptertable']);
		$playurl = $chapter=$ChapterModel->getOne('videoId','where chapterid='.$chapterid.' limit 1');
		$playvdo = new Core\Playvdo();
		$result  = $playvdo->getPlayAuth($playurl);
		include  CURR_VIEW_PATH . "playvdo.php";
	}
	//获取视频列表
	public function getVodListAction(){
		$vdoModel = M('common_vdo');
		$values = $vdoModel->getAll('where userid ='.$this->userid );
		include  CURR_VIEW_PATH . "vod_list.php";
	}
	//删除视屏
	public function delvdoAction(){
		$vdoid=ChkSQL(KS_G("get.id"));
		$playvdo = new Core\Playvdo();
		$values = $playvdo->deleteVideo($vdoid);
		$url = M_URL($this->AppName.'/Index','getVodList','',GP(''));
		ks_header($url);
	}
	//章节删除
	public function delchapterAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$courseid=ChkClng(KS_G("get.id"));
		$chaptertable=$this->AppModel->getOne('chaptertable','where courseid='.$courseid);
		$ChapterModel = new CourseModel($chaptertable);
		$partentidpath=null !==GF('chapterid') ? GF('chapterid'):'0';
		$ChapterModel->delchapter($partentidpath);
		$url = M_URL($this->AppName.'/Index','period',$courseid,GP('p-'.$now_page));
		ks_header($url);
	}
	//进入课程老师
	public function teacherAction(){
		$courseid =ChkClng(KS_G('get.id'));
		$course=$this->AppModel->getRow("where courseid=$courseid limit 1");
		$UserModel = new CourseModel('common_user');
		// var_dump($UserModel);
		//分页查询数据
		$options = $UserModel->getCourseTeacherOptions('4',$courseid);
		$page = Page($options);
		$teachers = $UserModel->getCourseTeacherPage($page,$courseid);
		include  CURR_VIEW_PATH . "coureseteacher.php";
	}
	//删除课程老师
	public function delspeakerAction(){
		$id = ChkClng(KS_G('get.id'));
		$teacherRelaetModel = new CourseModel('app_course_teacherrelate');
		$teacherRelaetModel->delete('id='.$id);
		KS_INFO("删除成功");
	}
	//进入课程学员
	public function studentAction(){
		$courseid =ChkClng(KS_G('get.id'));
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype=null !==GF('keytype') ? GF('keytype'):'';
		$wher="where a.courseid = $courseid and a.type=0";
		if(!empty($keyword)){
			if($keytype==1){$wher.=" and b.name like '%$keyword%'";}
		}
		$course=$this->AppModel->getRow("where courseid=$courseid limit 1");
		$UserModel = new CourseModel('common_user');
		$userStudent = new CourseModel('common_user_member');
		$db_order = new CourseModel('app_order_info');
		$where = "as a left join $userStudent->table as b on a.memberid = b.userid  left join $UserModel->table as c on c.userid = b.userid $wher";
		$options = $db_order->getOptions('10',$where);
		$page = Page($options);
		$student = $db_order->getPage($page,'c.regdate desc',$where);
		include  CURR_VIEW_PATH . "student.php";
	}
	//进入添加课程学员页面
	public function addCourseStudentAction(){
		$courseid =ChkClng(KS_G('get.id'));
		$UserModel = new CourseModel('common_user');
		$userStudent = new CourseModel('common_user_member');
		$studentrelate = new CourseModel('app_order_info');
		$userid = $this->AppModel->getOne('userid',"where courseid = $courseid limit 1");
		$where ="where parentid = $this->userid and usertype = 0";
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		if(!empty($keyword)){$where.=" and name like '%$keyword%'";}
		$where = "as a left join $userStudent->table as b on a.userid = b.userid $where and b.userid not in (select memberid from $studentrelate->table where courseid = $courseid and type=0)";
		$options = $UserModel->getOptions('10',$where);
		$page = Page($options);
		$student = $UserModel->getPage($page,'a.userid',$where);
		include  CURR_VIEW_PATH . "addstudent.php";
	}
	//添加课程学员
	public function doaddCourseStudentAction(){
		$courseid =ChkClng(KS_G('get.id'));
		$Data['courseid'] = $courseid;
		$Data['studentid'] = null !==GF('studentid') ? GF('studentid'):'0';
		$studentrelate = new CourseModel('app_course_studentrelate');
		$studentrelate->doadd($Data,'id');
	    $url = M_URL($this->AppName.'/Index','student',$courseid,GP(''));
	    $html = "<script>parent.location.href='".$url."';</script>";
		echo $html;
	}
	//批量添加学员
	public function doaddStudentAction(){
		$courseid = ChkClng(KS_G('get.id'));
		if(empty($_POST['aid'])){KS_INFO("请选择",0,'','',1);}
		else{
			  $studentrelate = new CourseModel('app_course_studentrelate');
			  $userid = $_POST['aid'];
			  foreach($userid as $k=>$v){
				 $Data['studentid']=$v;
				 $Data['courseid'] = $courseid;
				 $studentrelate->doadd($Data,'id');
			  }
		}
		$url = M_URL($this->AppName.'/Index','student',$courseid,GP(''));
		$html = "<script>parent.location.href='".$url."';</script>";
		echo $html;
	}
	//删除课程学员
	public function delCourseStudentAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$courseid= null !==GF('courseid') ? GF('courseid'):'0';
		$studentid = ChkClng(KS_G('get.id'));
		$studentrelate = new CourseModel('app_course_studentrelate');
		$studentrelate->delete('id='.$studentid);
		$url = M_URL($this->AppName.'/Index','student',$courseid,GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	//批量删除学员
	public function delStudentAction(){
		$courseid= null !==GF('courseid') ? GF('courseid'):'0';
        $now_page =  ChkClng(KS_S('p',1));
		if(empty($_POST['id'])){KS_INFO("请选择",0,'','',1);}
		else{
		    $studentrelate = new CourseModel('app_course_studentrelate');
		    $id = $_POST['id'];
		    foreach($id as $k=>$v){$studentrelate->delete('id='.$v);}
		    $url = M_URL($this->AppName.'/Index','student',$courseid,GP('p-'.$now_page));
		    KS_INFO("删除成功",0,$url);
		}
	}
	//进入课程评论管理
	public function commentAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$courseid =ChkClng(KS_G('get.id'));
		$course=$this->AppModel->getRow("where courseid=$courseid limit 1");
		$db_interact = M('app_interact');
		$where = 'as a left join '.$this->AppModel->table.' as b on b.courseid=a.infoid where a.appid=6 and a.infoid='.$courseid;
		$options = $db_interact->getOptions('10',$where);
		$options['now_page'] = $now_page;
		$page = Page($options);
		$values = $db_interact->getPage($page,'a.interactid',$where);
		include  CURR_VIEW_PATH . "commentmanage.php";
	}
	//删除评论
	public function delCommentAction(){
		$interactid =ChkClng(KS_G('get.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$courseid = null !==GF('courseid') ? GF('courseid'):'';
		$db_interact = M('app_interact');
		$db_interact->delete('interactid='.$interactid);
		$url = M_URL($this->AppName.'/Index','comment',$courseid,GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	//进入房间管理
	public function roomAction(){
		$courseid =ChkClng(KS_G('get.id'));
		$course=$this->AppModel->getRow("where courseid=$courseid limit 1");
		include  CURR_VIEW_PATH . "roommanage.php";
	}
	//进入考试
	public function examAction(){
		$courseid = null !==GF('courseid') ? GF('courseid'):'';
		//var_dump(M_URL($this->AppName.'/Index','kpoint',$courseid,GP(''))).die;
		if($courseid===''){$courseid =ChkClng(KS_G('get.id'));}
		$course=$this->AppModel->getRow("where courseid = $courseid limit 1");
		$paperModel = M('app_paper');
		$where      = 'where courseid ='.$courseid.'';
		//分页
		$options    = $paperModel->getOptions('5',$where);//分页参数设置
		$page       = Page($options);
		$values     = $paperModel->getPage($page,'paperid desc',$where);
		include  CURR_VIEW_PATH . "exam.php";
	}
	//进入上传
	public function uploadfileAction(){
		$courseid=ChkClng(KS_G("get.id"));
		$course=$this->AppModel->getRow('where courseid='.$courseid.' limit 1');
		include  CURR_VIEW_PATH . "uploadfile.php";
	}
	//进入课时知识点选择
	public function addKpointAction(){
		$courseid=ChkClng(KS_G("get.id"));
		$course=$this->AppModel->getRow('where courseid='.$courseid.' limit 1');
		$kpointModel = new CourseModel('app_knowledge');
		$where = 'where userid='.$course['userid'] .' and categoryid = '.$course['categoryid'];
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		if(!empty($keyword)){$where.=" and title like '%$keyword%'";}
		if(empty($_COOKIE['addKption'])){
			$chapterid=null !==GF('chapterid') ? GF('chapterid'):0;
			$chapterModel = new CourseModel($course['chaptertable']);
			$kption = $chapterModel->getOne('kpointIds','where chapterid = '.$chapterid.' limit 1');
			cookie("addKption",$kption,time()+3600*24);
		}
		$options = $kpointModel->getOptions('2',$where);
		$page = Page($options);
		$values =$kpointModel->getPage($page,'id desc',$where);
		include  CURR_VIEW_PATH . "addKpoint.php";
	}
	//进入课程知识点管理
	public function kpointAction(){
		$courseid=ChkClng(KS_G("get.id"));
		$course=$this->AppModel->getRow('where courseid='.$courseid.' limit 1');
		$chapterModel = new CourseModel($course['chaptertable']);
		$chapter = $chapterModel->getAll('where courseid='.$courseid );
		$kpoint= '';
		$kp = array();
		foreach($chapter as $k=>$v){
		$array =explode(',',$v['kpointIds']);
		foreach($array as $kt=>$vt){
			if(in_array($vt,$kp)){
			}else{
				$a = array($vt=>$v['title']);
				array_push($kp,$a);
			}
		} /*     $kpoint.= ','.$v['kpointIds'];*/
		}
		if(empty($kpoint)){$kpoint = 0;}
		$kpoint = array_unique(explode(',',$kpoint));
		$kpointid = ltrim(implode(',',$kpoint),',');
		$kpointModel = new CourseModel('app_knowledge');
		$kpoints = $kpointModel->getAll("where id in ($kpointid)");
		/*foreach($kpoint as $k=>$v){
		 foreach($chapter as $vt){$kpoints[$k]['chaptername'] = $chapterModel -> getAll('where courseid='.$courseid.' and $v in ');
		 }
		}*/
		include  CURR_VIEW_PATH . "kpointIndex.php";
	}
	//选择用户
	public function selectUserAction(){
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype=null !==GF('keytype') ? GF('keytype'):'';
		if(!empty($keyword)){$where=" and a.name like '%$keyword%'";}
		else{$where = '';}
		if($keytype ==1){
		   $userModel = M('common_user_school');
		}else{
		   $userModel = M('common_user_teacher');
		}
		$Model = M('common_user');
		$where = "as a left join $Model->table as b on a.userid = b.userid where parentid = 0 $where" ;
		//分页
		$options = $userModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$values  = $userModel->getPage($page,'a.userid desc',$where);
		include  CURR_VIEW_PATH . "selectUser.php";
	}
}