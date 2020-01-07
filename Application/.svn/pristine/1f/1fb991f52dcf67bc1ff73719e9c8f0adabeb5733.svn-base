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
class AppLabelController extends CommonController
{
	public function LabelAddAction(){
		
		$labeltype   = ChkClng(KS_S('labeltype'));
		$tempid      = ChkClng(KS_S('tempid'));
		$common_temp = M('common_temp');//实例化云服务表
		$tempval     = $common_temp->getRow("where tempid=$tempid limit 1");
		$common_user = M('common_user');//实例化云服务表
		//$userinfo    = $common_user->getRow('where userid=0');
		$appcategory = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		$value       = '';
		$common_app  = M('common_app');
		$values      = $common_app->getAll('where basictype='.$labeltype,'appid,appname');
		switch($labeltype){
			case  0:include  CURR_VIEW_PATH . "Label/Label_static.php";break;  
			case  1:include  CURR_VIEW_PATH . "Label/Label_article.php";break;
			case  3:include  CURR_VIEW_PATH . "Label/Label_course.php";break;
			case  5:include  CURR_VIEW_PATH . "Label/Label_users.php";break;
			case  7:include  CURR_VIEW_PATH . "Label/Label_exam.php";break;
			case  9:include  CURR_VIEW_PATH . "Label/Label_question.php";break;
			case 25:include  CURR_VIEW_PATH . "Label/Label_carousel.php";break; 
			default:include  CURR_VIEW_PATH . "Label/Label_article.php";  
		}
	}
	public function LabeldoAddAction(){
		$app_label             = M('app_label');//实例化云服务表
		$Data['wxid']          = $this->wxid;
		$Data['tempid']        = ChkClng(ChkClng(KS_S('tempid')));
		$Data['labeltype']     = ChkClng(ChkClng(KS_S('labeltype')));
		$Data['labelid']       = $app_label->getMaxValue('labelid','wxid='.$this->wxid)+1;
		$Data['labelname']     = 'drag'.$Data['labelid'];
		$Data['adddate']       = time();
		$Data['labelcontent']  = KS_G('post.labelcontent');
		$Rule['labelname']     = '标签名称|isEmpty,isDbexis';
		$Rule['labelcontent']  = '样式循环体|isEmpty';
		Chkpost($Data,$Rule,$app_label,"tempid=$Data[tempid] and wxid=$this->wxid");
		$app_label->doAdd($Data,'id');
		$this->cache->PutLCache('labelinfo',$Data['tempid']);
		$result =  array('state'=>'succeed','labelName'=>'{KS_'.$Data['labelname'].'}','labelType'=>$Data['labeltype']);
		//$result = '{"state":"succeed","labelName":"{KS_'.$Data['labelname'].'}","labelType":"'.$Data['labeltype'].'","windowName":"window.name"}';
		header("Content-type: application/json");
		echo json_encode($result);exit;
	}
	public function LabelEditAction(){
		$labeltype    = ChkClng(KS_S('labeltype'));
		$tempid       = ChkClng(KS_S('tempid'));
		$common_temp  = M('common_temp');//实例化云服务表
		$tempval      = $common_temp->getRow("where tempid=$tempid limit 1");
		$Label        = new \Core\Label();
		$now_page     = ChkClng(KS_S('p')); //表ID
		$common_user  = M('common_user');//实例化云服务表
		$userinfo     = $common_user->getRow('where userid=0');
		$appcategory  = $this->cache->GetHCache('appcategory',$userinfo);//读出缓存
		$labelid      = ChkSQL(KS_G('request.id'));
		$now_page     = ChkClng(KS_S('p')); 
		$value        = $this->cache->GetL('labelinfo',$tempid,'',$labelid,1);
		//$rr = $Label->GetLoopBody($value['labelcontent']);//var_dump($rr);exit;
		if($labeltype == 3){$courseType = $Label->GetParam($value['labelcontent'],'courseType');}
		if($labeltype != 0)
		{
			 $appid   = $Label->GetParam($value['labelcontent'],'Appid');
			 $appname = $this->cache->GetA('appinfo','appid',$appid,'appname'); 
		}
		$basictype = $Label->GetParam($value['labelcontent'],'Basictype');
        switch($labeltype)
		{
			case  0:include  CURR_VIEW_PATH . "Label/Label_static.php";break; 
			case  1:include  CURR_VIEW_PATH . "Label/Label_article.php";break;
			case  3:include  CURR_VIEW_PATH . "Label/Label_course.php";break;
			case  5:include  CURR_VIEW_PATH . "Label/Label_users.php";break;
			case  7:include  CURR_VIEW_PATH . "Label/Label_exam.php";break;
			case  9:include  CURR_VIEW_PATH . "Label/Label_question.php";break; 
			default:include  CURR_VIEW_PATH . "Label/Label_article.php";  
		}
	}
	public function LoopAddAction(){
		$fieldname = null !==GF('fieldname') ? GF('fieldname'):'0';//表ID
		$fieldtype = null !==GF('fieldtype') ? GF('fieldtype'):'0';//表ID
		$appid     = null !==GF('appid') ? GF('appid'):'0';//表ID
		$appename  = $this->cache->GetA('appinfo','appid',$appid,'appename');
        include  CURR_VIEW_PATH . "Label/Loop_add.php";
	}
	public function LabeldoEditAction(){
		$labelid              = ChkClng(KS_G('request.id'));//表ID
		$now_page             = ChkClng(KS_S('p')); //表ID
		$Data['tempid']       = ChkClng(KS_S('tempid'));
		$Data['labelname']    = ChkSQL(KS_G('post.labelname'));
		$Data['adddate']      = time();
		$Data['labelcontent'] = KS_G('post.labelcontent');
		$common_label         = M('common_label');//实例化云服务表
		$Rule['labelname']    = '标签名称|isEmpty,isDbexis';
		$Rule['labelcontent'] = '样式循环体|isEmpty';
		Chkpost($Data,$Rule,$common_label,"tempid=$Data[tempid] and labelid!=$labelid");
		$common_label->update($Data,'labelid='.$labelid);
		$this->cache->PutLCache('labelinfo',$Data['tempid']);
		$url = M_URL('Label','','',GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url);
	}
	public function deleteLabelAction(){
		$tempid = ChkClng(KS_S('tempid'));
		$labelid = ChkSQL(KS_G('request.id'));
		$now_page = ChkClng(KS_S('p')); 
		$common_label = M('common_label');//实例化云服务表
		$common_label->delete("labelid=$labelid");
		$this->cache->PutLCache('labelinfo',$tempid);
		$url = M_URL('Label','','',GP('p-'.$now_page));
		ks_header($url);
	}
	public function batchdelLabelAction(){
		$Labelcheck    = cookie('Labelcheck');
		$now_page      = ChkClng(KS_S('p')); 
		if(empty($Labelcheck)){KS_INFO('请选择要克隆的标签',4,'','',1);}
		$tempid        = ChkClng(KS_S('tempid'));
		if(empty($tempid)){KS_INFO('模板为空，错误',4,'','',1);}
		$common_label  = M('common_label');//实例化云服务表
		$common_label->delete("tempid=$tempid and labelid in($Labelcheck)");
		$this->cache->PutLCache('labelinfo',$tempid);
		cookie('Labelcheck',null);
		$url = M_URL('Label','','',GP('p-'.$now_page));
		ks_header($url);
	}
	public function LabelpageAction(){
		$values = $this->cache->GetACache('labelpage');
		include  CURR_VIEW_PATH . "Label/Labelpage_list.php";
	}
	public function PageAddAction(){
		include  CURR_VIEW_PATH . "Label/Labelpage_add.php";
	}
	public function PagedoAddAction(){
		$common_label_page    = M('common_label_page');
		$Data['labelname']    = ChkSQL(KS_G('post.labelname'));
		$Data['labelcontent'] = ChkSQL(KS_G('post.labelcontent'));
		$pageid = $common_label_page->doAdd($Data,'pageid');
		$Datat['labelename'] = '[KS:PageStr'.$pageid.']';
		$common_label_page->update($Datat,"pageid = $pageid");
		$this->cache->PutACache('labelpage');//存入缓存
		$url=M_URL('Label','Labelpage','',GP(''));
		KS_INFO("添加成功",0,$url);
	}
	public function PagedoEditAction(){
		$pageid       = ChkSQL(KS_G('post.pageid'));
		$labelname    = ChkSQL(KS_G('post.labelname'));
		$labelcontent = ChkSQL(KS_G('post.labelcontent'));
		$common_label_page = M('common_label_page');
		foreach ($pageid as $k => $v)
		{   
		    $Data['labelname']    = $labelname[$k];
			$Data['labelcontent'] = $labelcontent[$k];
		    $common_label_page->update($Data,"pageid = $v");
		}
		$this->cache->PutACache('labelpage');//存入缓存
		$url = M_URL('Label','Labelpage','',GP(''));
		KS_INFO("更新成功",0,$url);
	}
	//删除分页样式
	public function deletePageAction(){
		$pageid = ChkSQL(KS_G('request.id'));
		//$now_page = ChkClng(KS_S('p')); 
		$common_label_page = M('common_label_page');
		$common_label_page->delete("pageid=$pageid");
		$this->cache->PutACache('labelpage');//存入缓存
		$url = M_URL('Label','Labelpage','',GP(''));
		ks_header($url);
	}
	
	
	
	
	
	
	
	
}
?>