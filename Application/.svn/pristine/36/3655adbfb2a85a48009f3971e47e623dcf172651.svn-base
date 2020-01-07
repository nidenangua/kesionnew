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
class LabelController extends CommonController
{
	//进入添加标签页
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
		$filename    = BC($labeltype);
		include  CURR_VIEW_PATH . $filename;
	}
	//添加标签
	public function LabeldoAddAction(){
		$Data['labeltype']     = ChkClng(ChkClng(KS_S('labeltype')));
		$Num   = $this->Label->GetParam(ChkSQL(KS_G('post.labelcontent')),'Num');
		$Data['labelcontent']  = str_replace('{{n}}',$Num,ChkSQL(KS_G('post.labelcontent')));
		cookie(KS_MD5('drag'),'drag');
		$tmplContent = Img($this->Label->ReplaceBasicLabel($Data['labelcontent']));
		$result =  array('state'=>'succeed','content'=>$tmplContent,'labelType'=>$Data['labeltype']);
		echo '<script>parent.labelSuccessBack('.json_encode($result).')</script>';exit;
	}
	//进入编辑标签页
	public function LabelEditAction(){
		$labeltype    = ChkClng(KS_S('labeltype'));
		$tempid       = ChkClng(KS_S('tempid'));
		$appcategory  = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
        $filename     = BC($labeltype);
		include  CURR_VIEW_PATH . $filename;
	}
	public function LabeldoEditAction(){
		$labelid              = ChkClng(KS_G('request.id'));//表ID
		$now_page             = ChkClng(KS_S('p')); //表ID
		$labeltype            = ChkClng(ChkClng(KS_S('labeltype')));
		$tempid               = ChkClng(KS_S('tempid'));
		$labelname            = ChkSQL(KS_G('post.labelname'));
		$Data['adddate']      = time();
		$Data['labelcontent'] = KS_G('post.labelcontent');
		$common_label         = M('common_label');//实例化云服务表
		$Rule['labelcontent'] = '样式循环体|isEmpty';
		Chkpost($Data,$Rule,$common_label,"tempid=$tempid and labelid!=$labelid");
		$common_label->update($Data,'labelid='.$labelid);
		$this->cache->PutLCache('labelinfo',$tempid);
		$result =  array('state'=>'succeed','labelName'=>'{KS_'.$labelname.'}','labelType'=>$labeltype);
		echo '<script>parent.labelSuccessBack('.json_encode($result).')</script>';exit;
	}
	//进入添加标签页
	public function NavigationAddAction(){
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
		$filename    = BC($labeltype);
		include  CURR_VIEW_PATH . $filename;
	}
	//添加标签
	public function NavigationdoAddAction(){
		$Data['labeltype']     = ChkClng(ChkClng(KS_S('labeltype')));
		$Data['labelcontent']  = KS_G('post.labelcontent');
		$app_label             = M('app_label');//实例化云服务表
		$Data['labelid']       = $app_label->getMaxValue('labelid','wxid='.$GLOBALS['_DoM']['wxid'])+1;
		$Data['tempid']        = ChkClng(KS_S('tempid'));
		$Data['wxid']          = $this->wxid;
		$Data['labelname']     = ChkSQL(KS_G('post.labelname'));
		$Data['adddate']       = time();
		$Data['labelcontent']  = KS_G('post.labelcontent');

		$Rule['labelname']     = '标签名称|isEmpty,isDbexis';
		$Rule['labelcontent']  = '样式循环体|isEmpty';
		Chkpost($Data,$Rule,$app_label,"tempid=$Data[tempid] and wxid=$this->wxid",-2);
		$app_label->doAdd($Data,'id');
		$this->cache->PutLCache('labelinfo',$Data['tempid']);

		cookie(KS_MD5('drag'),'drag');
		$tmplContent = $this->Label->ReplaceBasicLabel($Data['labelcontent']);
		$result =  array('state'=>'succeed','content'=>$tmplContent,'labelType'=>$Data['labeltype']);
		echo '<script>parent.labelSuccessBack('.json_encode($result).')</script>';exit;
	}
	//位置编辑页
	public function NavigationEditAction(){
		$labelid      = ChkClng(KS_G('request.id'));//表ID
		$labeltype    = ChkClng(KS_S('labeltype'));
		$tempid       = ChkClng(KS_S('tempid'));
		$value        = $this->cache->GetL('labelinfo',$tempid,'',$labelid);
        $filename     = BC($labeltype);
		include  CURR_VIEW_PATH . $filename;
	}
	//位置编辑页
	public function NavigationdoEditAction(){
		$labelid              = ChkClng(KS_G('request.id'));//表ID
		$labeltype            = ChkClng(ChkClng(KS_S('labeltype')));
		$tempid               = ChkClng(KS_S('tempid'));
		$labelname            = ChkSQL(KS_G('post.labelname'));
		$Data['adddate']      = time();
		$Data['labelcontent'] = ChkSQL(KS_G('post.labelcontent'));
		$app_label         = M('app_label');//实例化云服务表
		$Rule['labelcontent'] = '样式循环体|isEmpty';
		Chkpost($Data,$Rule,$app_label,"tempid=$tempid and labelid!=$labelid");
		$app_label->update($Data,'labelid='.$labelid);
		$this->cache->PutLCache('labelinfo',$tempid);


		cookie(KS_MD5('drag'),'drag');
		$tmplContent = $this->Label->ReplaceBasicLabel($Data['labelcontent']);
		$result =  array('state'=>'succeed','content'=>$tmplContent,'labelType'=>$Data['labeltype']);
		echo '<script>parent.labelSuccessBack('.json_encode($result).')</script>';exit;
	}
	public function LoopAddAction(){
		$fieldname = null !==GF('fieldname') ? GF('fieldname'):'0';//表ID
		$fieldtype = null !==GF('fieldtype') ? GF('fieldtype'):'0';//表ID
		$appid     = null !==GF('appid') ? GF('appid'):'0';//表ID
		$appename  = $this->cache->GetA('appinfo','appid',$appid,'appename');
        include  CURR_VIEW_PATH . "Label/Loop_add.php";
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
		foreach ($pageid as $k => $v){
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
	//标签列表
	public function myLabelAction(){
		$now_page = ChkClng(KS_S('p'));
		$tempid   = ChkClng(KS_G('request.id'));
		if(empty($tempid)){
			echo '小坤程序员，你好，请把模板id传给我，例如：https://ks.kesion.com/home.html/default/Label/myLabel/9';exit;
		}
		$option       = null !==GF('option') ? GF('option'):'0';
		$where        = 'where tempid='.$tempid.' and wxid='.$this->wxid;
		///$values = $this->cache->getACache('appcategory');//取出缓存
		$app_temp     = M('app_temp');//实例化云服务表
		$tempval      = $app_temp->getRow("where tempid=$tempid and wxid=$this->wxid limit 1");
		$app_label    = M('app_label');//实例化云服务表
		$options      = $app_label->getOptions('10',$where);//分页参数设置
		$page         = Page($options);
		$values       = $app_label->getPage($page,'adddate desc',$where);
		include  CURR_VIEW_PATH . 'Label/Lable_list.php';
	}
	//进入程序员编辑标签页
	public function LabelEdit2Action(){
		$labelid      = ChkClng(KS_G('request.id'));//表ID
		$labeltype    = ChkClng(KS_S('labeltype'));
		$tempid       = ChkClng(KS_S('tempid'));
		$now_page     = ChkClng(KS_S('p'));
		$app_temp     = M('app_temp');//实例化云服务表
		$tempval      = $app_temp->getRow("where tempid=$tempid and wxid=$this->wxid limit 1");
		$app_label    = M('app_label');//实例化云服务表
		$value        = $app_label->getRow("where tempid=$tempid and labelid=$labelid");
		include  CURR_VIEW_PATH . 'Label/Label_static2.php';
	}
	//进入程序员编辑标签页
	public function LabeldoEdit2Action(){
		$labelid              = ChkClng(KS_G('request.id'));//表ID
		$now_page             = ChkClng(KS_S('p')); //表ID
		$labeltype            = ChkClng(ChkClng(KS_S('labeltype')));
		$tempid               = ChkClng(KS_S('tempid'));
		$Data['adddate']      = time();
		$Data['labelcontent'] = KS_G('post.labelcontent');
		$app_label            = M('app_label');//实例化云服务表
		$Rule['labelcontent'] = '样式循环体|isEmpty';
		Chkpost($Data,$Rule,$app_label,"tempid=$tempid and labelid!=$labelid");
		$app_label->update($Data,'labelid='.$labelid);
		$this->cache->PutLCache('labelinfo',$tempid);
		//$url = M_URL('Label','myLabel','',GP(''));
		KS_INFO('修改成功');exit;
	}
	/**
	 * 开通微门户DIY功能
	 */
	public function PortaldecorationAction(){

		include  CURR_VIEW_PATH . 'Portaldecoration/index.html';
	}
	//开通微门户DIY功能
	public function OpendiyAction(){
		$isdiy       = $this->cache->GetA('domaininfo','wxid',$this->wxid,'isdiy');//自定义界面
		//$Data['isdiy']        = 1;
		$Data['mydiyid']      = $this->cache->GetA('domaininfo','wxid',$this->wxid,'tempMid');

		$Data001['wxid']      = $this->wxid;//开通微门户DIY功能
		$Data001['modeltype'] = 'Opendiy';
		$DragModel            = M('Application/DragModel');
		$DragModel->inidrag($Data001);
		//if($isdiy==0){}else{
		//    $Data['isdiy']    = 0;
		//	$Data['mydiyid']  = $this->cache->GetA('domaininfo','wxid',$this->wxid,'tempMid');
		//}
		$Model            = M('common_domain');
		$Model->update($Data,'wxid='.$this->wxid);
		$this->cache->PutACache('domaininfo');//读出缓存
		$url = M_URL('Label','Portaldecoration');
		ks_header($url);
	}
}