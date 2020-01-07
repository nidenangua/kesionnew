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
	 //用户和老师之间的交流
	 public function InteractAjaxAction(){
		$appid = ChkClng(KS_G("post.appid")); 
		$infoid = ChkClng(KS_G("post.infoid")); 
		if($appid==6)
		{
			$app_course = M('app_course');
			$value = $app_course->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid ='.$infoid.' limit 1');
			if(empty($value)){echo '{"errcode":"10001"}';exit;}
		}
		
		$where = 'where wxid='.$GLOBALS['_DoM']['wxid'].' and infoid='.$infoid;
		$byname = 'adddate desc';
		$options = $this->AppModel->getOptions('5',$where);//分页参数设置
		$options['now_page'] = ChkClng(KS_G("post.now_page"))!== 0 ? ChkClng(KS_G("post.now_page")):'1';
		$page = Page($options);
		$interact = $this->AppModel->getPage($page,$byname,$where); 
		foreach($interact as $k=>$v)
		{
			$headurl = $this->upload->getHead($v['memberid']);
			$interact[$k]['headurl'] = $headurl ? $headurl :'';
			$interact[$k]['interact'] = ShowEmot($v['interact'],$this->getInstall());
			$interact[$k]['adddate'] = KS_DATE($v['adddate']);
		}
		$result['data'] =  $interact; 
		$result['page'] =  $page; 
		
		
		header("Content-type: application/json");
	    echo json_encode($result);exit;
     }
	 //用户和老师之间的交流
	 public function doaddInteractAjaxAction(){
		 
		$appid = ChkClng(KS_G("post.appid")); 
		if(intval($appid-100)<0)check_login($this->memberinfo);//验证登录 
		
		$infoid = ChkClng(KS_G("post.infoid"));
		if($appid==6)
		{
			$app_course = M('app_course');
			$value = $app_course->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid ='.$infoid.' limit 1');
			if(empty($value)){echo '{"errcode":"10001"}';exit;}
		}
		$Data['appid']      = $appid;
		$Data['infoid']     = $infoid;
		$Data['userid']     = $GLOBALS['_DoM']['wxid'];
		if($this->memberinfo  != null) {
		    $Data['memberid']   = $this->memberid;
		    $Data['membername'] = $this->memberinfo['username'];
		}elseif(intval($appid-100)>=0)
		{
		    $Data['membername'] = ChkSQL(KS_G("post.username"));
		}
		$Data['adddate']    = time();
		$Data['interact']   = ChkSQL(KS_G("post.interact"));
		
		$Rule['interact']   = '问题内容|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);
		$result = $this->AppModel->doadd($Data,'interactid');
		header("Content-type: application/json");
	    echo json_encode($result);exit;
     }
	 //用户和老师之间的交流
	 public function doaddImageAjaxAction(){
		 
		 //header('HTTP/1.1 404 Not Found');
		 $this->upload->savePath = 'users/'.$this->memberid.'/'; // 设置附件上传（子）目录
		 //$this->upload->subName  = ''; //子目录创建方式，采用数组或者字符串方式定义
		 //$this->upload->saveName = KS_MD5($this->userid);
		 $this->upload->replace = true;
		 $info = $this->upload->upload();
		 if(!$info) {
			$this->error($upload->getError());// 上传错误提示错误信息
		 }else{// 分离缩略图和轮播图
		    header("Content-type: application/json");
	        echo json_encode(ChkSQL($this->upload->uootPath.$info['file']['savepath'].$info['file']['savename']));exit;
		 }	
     }
	 public function ReplayAjaxAction(){
		
		$interactid = ChkClng(KS_G("post.interactid")); 
		$value = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and interactid ='.$interactid.' limit 1');
		if(empty($value)){echo '{"errcode":"10001"}';exit;}
		
		$interact_reply = M('app_interact_reply');
		$where = 'where wxid='.$GLOBALS['_DoM']['wxid'].' and interactid='.$interactid;
		$byname = 'adddate desc';
		$options = $interact_reply->getOptions('5',$where);//分页参数设置
		$options['now_page'] = ChkClng(KS_G("post.now_page"))!== 0 ? ChkClng(KS_G("post.now_page")):'1';
		$page = Page($options);
		$interact = $interact_reply->getPage($page,$byname,$where); 
		foreach($interact as $k=>$v)
		{
			$headurl = $this->upload->getHead($v['memberid']);
			$interact[$k]['headurl'] = $headurl ? $headurl :'';
			$interact[$k]['reply'] = ShowEmot($v['reply'],$this->getInstall());
			$interact[$k]['adddate'] = KS_DATE($v['adddate']);
		}
		$result['data'] =  $interact; 
		$result['page'] =  $page; 
		header("Content-type: application/json");
	    echo json_encode($result);exit;
     }
	 public function moreReplayAjaxAction(){
		
		$interactid = ChkClng(KS_G("post.interactid")); 
		$value = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and interactid ='.$interactid.' limit 1');
		if(empty($value)){echo '{"errcode":"10001"}';exit;}
		
		$interact_reply = M('app_interact_reply');
		$where = 'where wxid='.$GLOBALS['_DoM']['wxid'].' and interactid='.$interactid;
		$byname = 'adddate desc';
		$options = $interact_reply->getOptions('5',$where);//分页参数设置
		$options['now_page'] = ChkClng(KS_G("post.now_page"))!== 0 ? ChkClng(KS_G("post.now_page")):'1';
		$page = Page($options);
		$interact = $interact_reply->getPage($page,$byname,$where); 
		foreach($interact as $k=>$v)
		{
			$headurl = $this->upload->getHead($v['memberid']);
			$interact[$k]['headurl'] = $headurl ? $headurl :'';
			$interact[$k]['reply'] = ShowEmot($v['reply'],$this->getInstall());
			$interact[$k]['adddate'] = KS_DATE($v['adddate']);
		}
		$result['data'] =  $interact; 
		$result['page'] =  $page; 
		
		
		header("Content-type: application/json");
	    echo json_encode($result);exit;
     }
	 //用户和老师之间的交流
	 public function doaddReplyAjaxAction(){
		 
		check_login($this->memberinfo);//验证登录  
		$interactid = ChkClng(KS_G("post.interactid")); 
		$value = $this->AppModel->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and interactid ='.$interactid.' limit 1');
		if(empty($value)){echo '{"errcode":"10001"}';exit;}
		
		$interact_reply = M('app_interact_reply');
		$Data['interactid'] = $interactid;
		$Data['userid']     = $GLOBALS['_DoM']['wxid'];
		$Data['adddate']    = time();
		$Data['reply']      = ChkSQL(KS_G("post.reply"));
		if($this->memberinfo  != null) {
		    $Data['memberid']   = $this->memberid;
		    $Data['membername'] = $this->memberinfo['username'];
		}
		$Rule['reply']   = '问题内容|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);
		$result = $interact_reply->doadd($Data,'replyid');
		header("Content-type: application/json");
		
		$headurl = $this->upload->getHead($this->memberid);
		$Data['headurl'] = $headurl ? $headurl :'';
		$Data['reply'] = ShowEmot($Data['reply'],$this->getInstall());
		$Data['adddate'] = KS_DATE($Data['adddate']);
	    echo json_encode($Data);exit;
     }
}