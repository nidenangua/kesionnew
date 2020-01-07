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
		$info = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		$isquestion=getSetting(7,$info['setting']);
		if($isquestion==0){KS_INFO('未开通',4,'','',1);}
		$where ='where userid ='.$GLOBALS['_DoM']['wxid'];
        $options = $this->AppModel->getOptions('2',$where);//分页参数设置
		$page = Page($options);
		$values = $this->AppModel->getPage($page,'adddate desc',$where);
		$this->assign('id',7);
		$this->display('question/index.html'); 
    }
	public function verifyAction(){
		$Verify = new Verify();
        $Verify->entry();
    }
	//进入问题添加
	public function addQuestionAction(){
		$userModel = M('common_user');
		$category = $this->cache->GetHCache('appcategory',$GLOBALS['_DoM']['wxid']);//读出缓存
		$link = Linkage(array(),$category);
		$link->inputname = 'categoryid';
		$category =$link->Linkage(3);	
	    $this->assign('category',$category);
		$question = ks_editor('describe','','1');
		$this->assign('describe',$question);
		$this->display('question/addQuestion.html'); 
    }
	//进行增加
	public function doaddQuestionAction(){
		//检查是登录权限
		check_login($this->memberinfo);
		$verify  = ChkSQL(KS_G("post.verify")); 
		$verifye = new Verify();
		if(!$verifye->check($verify)){KS_INFO('亲，验证码输错了哦！',0,'','',1);}
		//$this->error("亲，验证码输错了哦！",$this->site_url,9);  
		$info = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		$isaudit = getSetting(8,$info['setting']);
		if($isaudit==1){$Data['status']=1;}
		$Data['userid'] = $GLOBALS['_DoM']['wxid'];
		$Data['memberid'] = $this->memberid;
		$Data['adddate'] = time();
		$tableModel = new CourseModel('common_extends_table');
		$Data['answerTable']=$tableModel->getOne('tablename','where Isdefault=1 and type =2');
		$Data['problem'] = ChkSQL(KS_G("post.problem"));
		$Data['describe'] = ChkSQL(KS_G("post.describe"));
		$Data['points'] = ChkClng(KS_G("post.points"));
		$userModel = M('common_user');
		$user = $userModel -> getRow('where userid = '.$this->memberid);
		$Data['username'] = $user['username'];
		if($user['integral']<0 || $Data['points']>$user['integral']){KS_INFO('积分不够',0,'','',1);}
		$Data['categoryid'] = ChkClng(KS_G("post.categoryid"));
		$Data['anonymous'] = ChkClng(KS_G("post.anonymous"));
		$Rule['problem'] = '问题|isEmpty';
		$Rule['describe'] = '描述|isEmpty';
		$Rule['points'] = '积分|isnumber';
		Chkpost($Data,$Rule,$this->AppModel);
		$this->AppModel->doadd($Data,'id');
		//修改积分
		$addintegral=getSetting(11,$info['setting']);
		$Data2['integral']=$user['integral']+$addintegral-$Data['points'];
		$userModel->update($Data2,'userid ='.$this->memberid);
		//插入积分明细
		if($addintegral!=0){
			$Data3['changeIntegral'] = $addintegral;
			$Data3['userid'] = $GLOBALS['_DoM']['wxid'];
			$Data3['memberid'] = $this->memberid;
			$Data3['adddate'] = time();
			$Data3['integral'] = $user['integral']+$addintegral;
			$Data3['username'] = $user['username'];
			$Data3['mark'] = '提问奖励'.$addintegral;
			$Data3['type'] = 1;
			$integralModel = M('app_integral_log');
			$integralModel->doadd($Data3,'id');
		}
		if($Data['points']!=0){
			$Data4['changeIntegral'] = $Data['points'];
			$Data4['userid'] = $GLOBALS['_DoM']['wxid'];
			$Data4['memberid'] = $this->memberid;
			$Data4['integral'] = $Data2['integral'];
			$Data4['adddate'] = time();
			$Data4['username'] = $user['username'];
			$Data4['mark'] = '悬赏分扣除'.$Data['points'];
			$Data4['type'] = 0;
			$integralModel = M('app_integral_log');
			$integralModel->doadd($Data4,'id');	
		}
		$url1=M_URL('question','list');
		KS_INFO('添加成功',2,$url1);
	}
	public function listAction(){
		$issolve=null !==GF('issolve') ? GF('issolve'):'0';
		$where = 'where a.userid='.$GLOBALS['_DoM']['wxid'];
		//状态筛选
		if($issolve==0){$where .= ' and (a.issolve=0 or a.issolve=1)';}
		elseif($issolve==1){$where .= ' and a.issolve=1'; }
		elseif($issolve==2){$where .= ' and a.issolve=0';}
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		//判断是否输入关键字
		if(!empty($keyword)){
		    if($keytype==1){$where.=" and a.title like '%$keyword%'";}
		    elseif($keytype==2){$where.=" and a.inputer like '%$keyword%'";} 
		}
			//分类
		$categoryid = null !==GF('categoryid') ? GF('categoryid'):0;	
		if($categoryid!=0){$where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}	
		$appcategory = $this->cache->GetHCache('appcategory',$GLOBALS['_DoM']['wxid']);//取出缓存
		//判断是否有用户ID
		$byname = 'adddate desc';
		//需要连表的在最后left join
		$left_join  = M('app_category');
		$where      = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where";
		$maxPerPage = $this->getMaxPage('question/list.html');
		$options    = $this->AppModel->getOptions($maxPerPage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page = Page($options);
		$dt   = $this->AppModel->getPage($page,$byname,$where,'b.*,a.*'); 
		foreach($dt as $k=>$v){
			$answerModel = M($v['answerTable']);
			$dt[$k]['count'] = $answerModel->getOne('count(1)','where questionid = '.$v['id']);
		}
	    $this->assign('page',$page);
		$this->assign('dt',$dt);
		$this->display('question/list.html');
	}
	public function viewAction(){
		$id = ChkClng(KS_G("get.id")); 
		$Data['click']='click+1';
		$this->AppModel->update($Data,'id='.$id,1);
		$value = $this->AppModel->getRow('where id ='.$id);
		$ansewrModel = M($value['answerTable']);
		$maxPerPage = $this->getMaxPage('question/view.html');
		$where = "where questionid =$id";
		$options = $ansewrModel->getOptions($maxPerPage,$where);//分页参数设置
		$page = Page($options);
		$dt = $ansewrModel->getPage($page,'bestAnswerid desc,adddate desc',$where); 
		$value['adddate'] = date('Y-m-d H:i:s',$value['adddate']); 
		$info = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		$isdelquestion=getSetting(9,$info['setting']);
		$this->assign('isdelquestion',$isdelquestion);
		$this->assign('field',$value);
		$this->assign('id',$id);
		$this->assign('page',$page);
		$this->assign('dt',$dt);
		$this->display('question/view.html');
	}
	public function addpointsAction(){
		 
		 $userModel = M('common_user');
		
		 $user = $userModel -> getRow('where userid = '.$this->memberid);
		 
		 $id = ChkClng(KS_G("get.id"));
		 
		 $addintegral = ChkClng(KS_G("post.addintegral"));
		
		 if($addintegral>$user['integral']){
			 
			   KS_INFO('积分不够',0,'','',1);
		 }
		 //修改学员积分
		 $Data['integral'] = $user['integral'] - $addintegral;
		 
		 $userModel->update($Data,'userid ='.$this->memberid);
		 //修改问题积分
		 
		 $Data3['points']="points-$addintegral";
		
		 $this->AppModel->update($Data3,'id='.$id,1);
		
		 //插入积分明细
		 
		 $Data2['changeIntegral'] = $addintegral;
		
		 $Data2['userid'] = $GLOBALS['_DoM']['wxid'];
		
		 $Data2['memberid'] = $this->memberid;
		
		 $Data2['integral'] = $addintegral;
		
		 $Data2['adddate'] = time();
		
		 $Data2['username'] = $user['username'];
		
		 $Data2['mark'] = '提高悬赏分'.$Data['points'];
		
		 $Data2['type'] = 1;
		
		 $integralModel = M('app_integral_log');
		
		 $integralModel->doadd($Data2,'id');	
		
		 $url1=M_URL('question/index','view',$id);
		
		 KS_INFO('提高悬赏成功',2,$url1);
		 
	  }
	
	//进行回答
	 public function doaddanswerAction(){
		 //进行回答
		 $Data['userid'] = $this->memberid;
		 
		 $Data['username'] = $this->memberinfo['username'];
		 
		 $Data['questionid'] = $id = ChkClng(KS_G("post.id"));
		 
		 $Data['answer'] = ChkSQL(KS_G("post.answer"));
		 
		 $Data['adddate'] = time();
		 
		 $Rule['answer'] = '回答内容|isEmpty';
	
		 Chkpost($Data,$Rule,$this->AppModel);
		 
		 $answerTable = $this->AppModel->getOne('answerTable','where id ='.$Data['questionid']);
		 
		 $answerModel = M($answerTable);
		
		 $answerModel->doadd($Data,'answerid');
		 //修改积分
		 $count = $answerModel->getOne('count(*)',"where questionid = $id and userid = $this->memberid ");
		 
		 $info = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		 
		 $addintegral=getSetting(12,$info['setting']);
		 
		 if($count == 1 && $addintegral>0){
			  
			    $userModel = M('common_user');
			 
			    $user = $userModel -> getRow('where userid = '.$this->memberid);
				
				$Data3['integral'] = $user['integral'] + $addintegral;
		 
		        $userModel->update($Data3,'userid ='.$this->memberid);
				//插入积分表
				$Data2['changeIntegral'] = $addintegral;
		
				$Data2['userid'] = $GLOBALS['_DoM']['wxid'];
				
				$Data2['memberid'] = $this->memberid;
				
				$Data2['integral'] = $Data3['integral'];
				
				$Data2['adddate'] = time();
				
				$Data2['username'] = $user['username'];
				
				$Data2['mark'] = '问答问题奖励'.$addintegral;
				
				$Data2['type'] = 1;
				
				$integralModel = M('app_integral_log');
				
				$integralModel->doadd($Data2,'id');	
		}
		$url1=M_URL('question','view',$Data['questionid']);
		
		KS_INFO('添加成功',2,$url1);
		 
	 }
	 
	 public function delquestionAction(){
		 
		   $id = ChkClng(KS_G("get.id"));
		   
		   $answerTable = $this->AppModel->getOne('answerTable','where id = '.$id);
		
		   $answerModel = M($answerTable);
		
		   $this->AppModel->delete('id='.$id);
		
		   $answerModel->delete('questionid = '.$id);
		   
		   $info = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		 
		   $isdelquestion=getSetting(13,$info['setting']);
		   
		   if($isdelquestion>0){
			  
			    $userModel = M('common_user');
			 
			    $user = $userModel -> getRow('where userid = '.$this->memberid);
				
				$Data['integral'] = $user['integral'] - $isdelquestion;
		 
		        $userModel->update($Data,'userid ='.$this->memberid);
				//插入积分表
			    $Data2['changeIntegral'] = $isdelquestion;
		
				$Data2['userid'] = $GLOBALS['_DoM']['wxid'];
				
				$Data2['memberid'] = $this->memberid;
				
				$Data2['integral'] = $Data['integral'];
				
				$Data2['adddate'] = time();
				
				$Data2['username'] = $user['username'];
				
				$Data2['mark'] = '删除问题扣除'.$isdelquestion;
				
				$Data2['type'] = 0;
				
				$integralModel = M('app_integral_log');
				
				$integralModel->doadd($Data2,'id');			
	 
		   }
		
		   $url1=M_URL('question','index','list');
		
		   ks_header($url1);
		  
	}
	public function bestAnswerAction(){
	    $questionid = null !==GF('questionid') ? GF('questionid'):'0';
	    $question = $this->AppModel->getRow('where id ='.$questionid);
	    $answerModel = M($question['answerTable']);
	    $answerid = ChkClng(KS_G("get.id"));
	    $Data['bestAnswerid'] = 1;  
	    $answerModel->update($Data,'answerid ='.$answerid);
	    $answer  =  $answerModel->getRow('where answerid ='.$answerid.' limit 1 ');
	    $Data4['issolve'] = 1;
	    $this->AppModel->update($Data4,'id ='.$questionid);
	    if($question['points']>0){
		     //修改积分
			 $userModel = M('common_user');
			 $Data3['integral'] = 'integral + '.$question['points'];
			 $userModel->update($Data3,'userid='.$answer['userid'],1);
			 $integral=$userModel->getOne('integral','where userid='.$answer['userid'].' limit 1');
		      //插入积分明细
		     $Data2['changeIntegral'] = $question['points'];
			 $Data2['userid'] = $GLOBALS['_DoM']['wxid'];
			 $Data2['memberid'] = $answer['userid'];
			 $Data2['integral'] =  $integral;
			 $Data2['adddate'] = time();
			 $Data2['username'] = $answer['username'];
			 $Data2['mark'] = '最佳答案奖励'.$question['points'];
			 $Data2['type'] = 1;
			 $integralModel = M('app_integral_log');
			 $integralModel->doadd($Data2,'id');	
	    }
	    $url1= M_URL('question','view',$questionid,GP(''));
	    ks_header($url1);
    } 
}